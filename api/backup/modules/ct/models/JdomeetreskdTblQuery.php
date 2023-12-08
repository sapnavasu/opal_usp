<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use \common\components\Drive;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[JdomeetreskdTbl]].
 *
 * @see JdomeetreskdTbl
 */
class JdomeetreskdTblQuery extends \yii\db\ActiveQuery {

    /**
     * save detail
     */
     public function savedetail($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data){
            $ip_address = Common::getIpAddress();
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $targetmemberPK = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $data['jdomodulepk'], 'jdtm_target_usermst_fk' => $userPK])->one()->jdotargetmember_pk;            
            $meetmember = JdomeetskdmemberTbl::find()->where(['jdmsm_jdomeetingskdhdr_fk' => $data['meetingpk'], 'jdmsm_jdotargetmember_fk' => $targetmemberPK])->one();

            $resmeet = new JdomeetreskdTbl();
            $resmeet->jdmrs_jdomeetskdmember_fk = $meetmember->jdomeetskdmember_pk;
            $resmeet->jdmrs_reskddate = date("Y-m-d", strtotime($data['date']));
            $resmeet->jdmrs_reskd_starttime = date("H:i:s", strtotime($data['start_time']));
            $resmeet->jdmrs_reskd_endtime = date("H:i:s", strtotime($data['end_time']));
            $resmeet->jdmrs_status = 1;
            $resmeet->jdmrs_reskd_timezone_fk = $data['timezone'];
            $resmeet->jdmrs_appdecby =  $userPK;
            $resmeet->jdmrs_appdecon = date('Y-m-d h:i:s');
            $resmeet->jdmrs_appdecipaddr = $ip_address;
            $resmeet->jdmrs_createdon = date('Y-m-d h:i:s');
            $resmeet->jdmrs_createdby = $userPK;
            $resmeet->jdmrs_createdbyipaddr = $ip_address;

            if($resmeet->save() == TRUE){
                $meetmember->jdmsm_response = 4;
                $meetmember->save();
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => "Meeting Rescheduled successfully",
                    'moduleData' => $resmeet,
                ); 
            } else {

                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $resmeet->getErrors()
                );
            }
        }
        return $result;
    }

    /**
     * Update reschedule meeting response
     * 
     */
    public function resmeetresponse($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data){
            $ip_address = Common::getIpAddress();
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $resmeet = JdomeetreskdTbl::findOne($data['dataPk']);
          
            if($resmeet){
                $resmeet->jdmrs_status = $data['status'];
                // $resmeet->jdmrs_appdeccomment = $data['comment'];
                $resmeet->jdmrs_updatedon = date('Y-m-d h:i:s');
                $resmeet->jdmrs_updatedby = $userPK;
                $resmeet->jdmrs_updatedbyipaddr = $ip_address;
    
                if($data['status'] == 2){
                    $msg = "Meeting reschedule has been approved";
                } elseif ($data['status'] == 3){
                    $msg = "Meeting reschedule has been declined";
                }
                if($resmeet->save() == TRUE){
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => $msg,
                        'moduleData' => $resmeet,
                    ); 
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $resmeet->getErrors()
                    );
                }
            }
        }
        return $result;
    }

    public function reschedulehistory($data){
        
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'moduledata' => []
        );

        if($data){
            $resmeetings = JdomeetreskdTbl::find()->all();
            $data['list'] = [];
            $data['comments'] = [];
            if(!empty($resmeetings)){
                foreach($resmeetings as $meeting){
                    $data['list'][] = [
                        'date' => $meeting->jdmrs_reskddate,
                        'starttime' => $meeting->jdmrs_reskd_starttime,
                        'endtime' => $meeting->jdmrs_reskd_endtime,
                        'status' => $meeting->jdmrs_status
                    ];
                
                    if($meeting->jdmrs_status == 3) {
                        $data['comments'][] =  $meeting->jdmrs_appdeccomment;
                    }
                }

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'moduleData' => $data,
                );
            }
            
        }
        return $result;
    }
}