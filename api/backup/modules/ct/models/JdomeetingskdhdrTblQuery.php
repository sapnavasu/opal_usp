<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use \common\components\Drive;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[JdomeetingskdhdrTbl]].
 *
 * @see JdomeetingskdhdrTbl
 */
class JdomeetingskdhdrTblQuery extends \yii\db\ActiveQuery {
    
    /**
     * Create meeting
     */
    public function addmeeting($data)
    {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data){
            $meetingpk = $data['meetingpk'];
        
            $meetdtls= JdomeetingskdhdrTbl::find()
                    ->where("jdomeetingskdhdr_pk=:pk",[':pk'=>$meetingpk])
                    ->one();
            $ip_address = Common::getIpAddress();
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        
            if(empty($meetdtls)){
                $targetmemberPK = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $data['jdomodulepk'], 'jdtm_target_usermst_fk' => $userPK])->one()->jdotargetmember_pk;

                $meetdtls = new JdomeetingskdhdrTbl();
                $meetdtls->jdmsh_jdomoduledtl_fk = Security::sanitizeInput($data['jdomodulepk'], "number");
                $meetdtls->jdmsh_creator_jdotargetmember_fk = $targetmemberPK;
                $meetdtls->jdmsh_title = Security::sanitizeInput($data['title'], "string");
                $meetdtls->jdmsh_type = Security::sanitizeInput($data['meeting_status'], "number");
                $meetdtls->jdmsh_presencetype = Security::sanitizeInput($data['Meeting_type'], "number");
                $meetdtls->jdmsh_meetingurl = $data['meeting_url'];
                $meetdtls->jdmsh_meetingdate = date("Y-m-d", strtotime($data['date']));
                $meetdtls->jdmsh_meeting_timezone_fk = Security::sanitizeInput($data['timezone'], 'number');
                $meetdtls->jdmsh_starttime = date("H:i:s", strtotime($data['start_time']));
                $meetdtls->jdmsh_endtime = date("H:i:s", strtotime($data['end_time']));
                // $meetdtls->jdmsh_meetlocation = Security::sanitizeInput($data['location'], "string");
                $meetdtls->jdmsh_meetingpurpose = Security::sanitizeInput($data['purpose'], "string");
                $meetdtls->jdmsh_notifybefore = Security::sanitizeInput($data['notify_before'], "string");
                $meetdtls->jdmsh_tomeet_mcm_fk = 1;//$data['whome'];
                $meetdtls->jdmsh_createdon = date('Y-m-d H:i:s');
                $meetdtls->jdmsh_createdbyipaddr = $ip_address;
                $meetdtls->jdmsh_createdby = $userPK;
                $msg = "Meeting details inserted successfully";

            } elseif($data['shedule']) {
                $meetdtls->jdmsh_meetingdate = date("Y-m-d", strtotime($data['date']));
                $meetdtls->jdmsh_meeting_timezone_fk = Security::sanitizeInput($data['timezone'], 'number');
                $meetdtls->jdmsh_starttime = date("H:i:s", strtotime($data['start_time']));
                $meetdtls->jdmsh_endtime = date("H:i:s", strtotime($data['end_time']));
                $meetdtls->jdmsh_updatedon = date('Y-m-d H:i:s');
                $meetdtls->jdmsh_updatedbyipaddr = $ip_address;
                $meetdtls->jdmsh_updatedby = $userPK;
                $msg = "Meeting re-sheduled successfully";                
            } else{
                $meetdtls->jdmsh_title = Security::sanitizeInput($data['title'], "string");
                $meetdtls->jdmsh_type = Security::sanitizeInput($data['meeting_status'], "number");
                $meetdtls->jdmsh_presencetype = Security::sanitizeInput($data['Meeting_type'], "number");
                $meetdtls->jdmsh_meetingurl = $data['meeting_url'];
                $meetdtls->jdmsh_meetingdate = date("Y-m-d", strtotime($data['date']));
                $meetdtls->jdmsh_meeting_timezone_fk = Security::sanitizeInput($data['timezone'], 'number');
                $meetdtls->jdmsh_starttime = date("H:i:s", strtotime($data['start_time']));
                $meetdtls->jdmsh_endtime = date("H:i:s", strtotime($data['end_time']));
                // $meetdtls->jdmsh_meetlocation = Security::sanitizeInput($data['location'], "string");
                $meetdtls->jdmsh_meetingpurpose = Security::sanitizeInput($data['purpose'], "string");
                $meetdtls->jdmsh_notifybefore = Security::sanitizeInput($data['notify_before'], "string");
                $meetdtls->jdmsh_tomeet_mcm_fk = $data['whome'];
                $meetdtls->jdmsh_updatedon = date('Y-m-d H:i:s');
                $meetdtls->jdmsh_updatedbyipaddr = $ip_address;
                $meetdtls->jdmsh_updatedby = $userPK;
                $msg = "Meeting details updated successfully";
            }

            if($meetdtls->save() == TRUE){
                if(!$data['meetingpk']) {
                    if($data['internalInvite']) {
                        $array = $data['internalInvite'];
                    } elseif($data['externalInvite']) {
                        $array = $data['externalInvite'];
                    } elseif($data['internalInvite'] && $data['externalInvite']) {
                        $array = array_merge($data['internalInvite'], $data['externalInvite']);
                    }
                    JdomeetskdmemberTblQuery::saveMeetingMembers($meetdtls->jdomeetingskdhdr_pk, array_map(function($v) {
                        return $v['jdoTargerPk'];
                    }, $array));
                }
                
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => $msg,
                    'moduleData' => $meetdtls,
                ); 
            
            }else{
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $meetdtls->getErrors()
                );
            }
        }

        return $result;
    }

    public function deletemeeting($data){
        $colmeetpk = Security::sanitizeInput($data['colmeetpk'], "number");
        $colmeetdtls= ColmeetingdtlsTbl::find()
                ->where("colmeetingdtls_pk=:pk",[':pk'=>$colmeetpk])
                ->one();
        if(!empty($colmeetdtls)){
            //$colmeetdtls->delete();
            $msg = "Meeting details deleted successfully";
        }else{
            $msg = "Something went wrong";
        }
        return $msg;
    }
    public function pinmeeting($data){
        $colmeetpk = Security::sanitizeInput($data['colmeetpk'], "number");
        $status = Security::sanitizeInput($data['pin_status'], "number");
        $colmeetdtls= ColmeetingdtlsTbl::find()
                ->where("colmeetingdtls_pk=:pk",[':pk'=>$colmeetpk])
                ->one();
        if(!empty($colmeetdtls)){
            $colmeetdtls->cmd_pinit = $status;
            if($colmeetdtls->save()){
                $msg = "Meeting Pinned";
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }

    /**
     * Meeting list
     */
    public function meetinglisting($data)
    {   
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);        
        $targetmember = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $data['moduledtlpk'], 'jdtm_target_usermst_fk' => $userPK])->one();
        $model = JdomeetingskdhdrTbl::find()
            ->select([
                'jdomeetingskdhdr_pk',
                'jdomeetskdmember_pk',
                'memcompfiledtls_pk',
                'jdmsh_meeting_timezone_fk',
                'mcfd_memcompmst_fk',
                'mcfd_uploadedby',
                'jdmsh_meetlocation',
                'jdmsh_notifybefore',
                'jdmsh_presencetype',
                'jdmsh_meetingdate',
                'tz_utcoffset',
                'jdmsh_starttime',
                'jdmsh_endtime',
                'jdmsh_title',
                'jdmsh_meetingpurpose',
                'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) created_by',
                'jdmsh_createdon',
                'jdmsh_meetingurl',
                'jdmsh_type',
                'CASE  
                    WHEN `jdup_category` = 2 then "Archived"
                    WHEN `jdmsh_createdby` = '.$userPK.' then "Requested"
                    WHEN `jdmsm_jdotargetmember_fk` = '.$targetmember->jdotargetmember_pk.' then "Received"
                    ELSE "" 
                END as status',
                'CASE  
                    WHEN `jdmsm_response` = 1 then "Invited"
                    WHEN `jdmsm_response` = 2 then "Attending"
                    WHEN `jdmsm_response` = 3 then "Not Attending"
                    WHEN `jdmsm_response` = 4 then "Rescheduled"
                    ELSE "Requested" 
                END as response',
                'MCM_CompanyName',
                'jdmsm_responsecomment',
            ])            
            ->leftJoin('timezone_tbl', 'jdmsh_meeting_timezone_fk = timezone_pk')
            ->leftJoin('membercompanymst_tbl','jdmsh_tomeet_mcm_fk=MemberCompMst_Pk')
            ->leftJoin('memcompfiledtls_tbl','mcm_complogo_memcompfiledtlsfk=memcompfiledtls_pk')
            ->leftJoin('usermst_tbl','jdmsh_createdby=UserMst_Pk')
            ->leftJoin('jdomeetskdmember_tbl','jdomeetingskdhdr_pk=jdmsm_jdomeetingskdhdr_fk and jdmsm_jdotargetmember_fk = '.$targetmember->jdotargetmember_pk)
            ->leftJoin('jdouserpreference_tbl', 'jdomeetingskdhdr_pk = jdup_shared_fk and jdup_shared_type = 5 and jdup_status = 1 and jdup_usermst_fk = '.$userPK)
            ->leftJoin('jdomeetreskd_tbl','jdomeetskdmember_pk=jdmrs_jdomeetskdmember_fk')
            ->Where(['jdmsh_jdomoduledtl_fk' => $data['moduledtlpk']]);

        // if(!empty($data['search'])){
        //     $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('jdmsh_title', true), ':value',array(':value' =>  $data['search'])]]);
        // }
        $model->orderBy('jdomeetingskdhdr_pk DESC');
        $model->groupBy('jdomeetingskdhdr_pk');
        $model->asArray();
        $provider = new ActiveDataProvider(['query' => $model]);
        
        $list = [];
        $MEETING_TYPE = [1 => 'Skype', 2 => 'Zoom', 3 => 'Google Meet'];
        $MEETING_STATUS = [1 => 'Online', 2 => 'Offline'];
        foreach($provider->getModels() as $data){
            $meetduration = strtotime($data['jdmsh_endtime']) - strtotime($data['jdmsh_starttime']);
            $h = (int)$meetduration/3600;
            $m = (int)$meetduration/60 - $h*60;
            $meetduration = $h . ($h > 1 ? ' hours ' : ' hour ') . ($m ? $m . ($m > 1 ? ' minutes' : ' minute'): '');
            $users = JdomeetskdmemberTblQuery::getMeetingUser($data['jdomeetingskdhdr_pk'])['moduleData'];
            $people = array_merge($users['internalUser'], $users['externalUser']);
            if($targetmember->jdtm_invitestatus == 1) {
                $comments = JdomeetskdmemberTbl::find()
                    ->select([
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'jdmsm_responsecomment comment',
                    ])
                    ->leftJoin('jdotargetmember_tbl', 'jdmsm_jdotargetmember_fk = jdotargetmember_pk')
                    ->leftJoin('usermst_tbl', 'jdtm_target_usermst_fk = UserMst_Pk')
                    ->where(['jdmsm_jdomeetingskdhdr_fk' => $data['jdomeetingskdhdr_pk']])
                    ->andWhere('jdmsm_responsecomment IS NOT NULL')
                    ->asArray()->all();

                $shedule_meetings = JdomeetreskdTbl::find()
                    ->select([
                        'jdomeetreskd_pk id',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'jdmrs_reskddate date',
                        'CONCAT(jdmrs_reskddate, " ", jdmrs_reskd_starttime, tz_utcoffset) starttime',
                        'CONCAT(jdmrs_reskddate, " ", jdmrs_reskd_endtime, tz_utcoffset) endtime',
                        'CASE  
                            WHEN `jdmrs_status` = 1 then "Confirmation Pending"
                            WHEN `jdmrs_status` = 2 then "Approved"
                            WHEN `jdmrs_status` = 3 then "Declined"
                            WHEN `jdmrs_status` = 4 then "Meeting Overdue"
                            ELSE "" 
                        END as status'
                    ])
                    ->leftJoin('timezone_tbl', 'jdmrs_reskd_timezone_fk = timezone_pk')
                    ->leftJoin('jdomeetskdmember_tbl', 'jdmrs_jdomeetskdmember_fk = jdomeetskdmember_pk')
                    ->leftJoin('jdotargetmember_tbl', 'jdmsm_jdotargetmember_fk = jdotargetmember_pk')
                    ->leftJoin('usermst_tbl', 'jdtm_target_usermst_fk = UserMst_Pk')
                    ->where(['jdmsm_jdomeetingskdhdr_fk' => $data['jdomeetingskdhdr_pk']])
                    ->asArray()->all();
            } else {
                $comments = ['comment' => $data['jdmsm_responsecomment']];
                $shedule_meetings = JdomeetreskdTbl::find()
                    ->select([
                        'jdomeetreskd_pk id',
                        'jdmrs_reskddate date',
                        'CONCAT(jdmrs_reskddate, " ", jdmrs_reskd_starttime, tz_utcoffset) starttime',
                        'CONCAT(jdmrs_reskddate, " ", jdmrs_reskd_endtime, tz_utcoffset) endtime',
                        'CASE  
                            WHEN `jdmrs_status` = 1 then "Confirmation Pending"
                            WHEN `jdmrs_status` = 2 then "Approved"
                            WHEN `jdmrs_status` = 3 then "Declined"
                            WHEN `jdmrs_status` = 4 then "Meeting Overdue"
                            ELSE "" 
                        END as status'
                    ])
                    ->leftJoin('timezone_tbl', 'jdmrs_reskd_timezone_fk = timezone_pk')
                    ->where(['jdmrs_jdomeetskdmember_fk' => $data['jdomeetskdmember_pk']])
                    ->asArray()->all();
            }

            $list[] = [
                'id' => $data['jdomeetingskdhdr_pk'],
                'logo' => Drive::generateUrl($data['memcompfiledtls_pk'], $data['mcfd_memcompmst_fk'], $data['mcfd_uploadedby']),
                'location' => $data['jdmsh_meetlocation'],
                'notify_before' => $data['jdmsh_notifybefore'],
                'meeting_type' => $MEETING_TYPE[$data['jdmsh_presencetype']],
                'date' => $data['jdmsh_meetingdate'],
                'start_time' => date('Y-m-d H:i:s', strtotime($data['jdmsh_meetingdate'].' '.$data['jdmsh_starttime'])),
                'end_time' => date('Y-m-d H:i:s', strtotime($data['jdmsh_meetingdate'].' '.$data['jdmsh_endtime'])),
                'title' => $data['jdmsh_title'],
                'meetduration' => $meetduration,
                'people' => $people,
                'userList' => $users,
                'purpose' => $data['jdmsh_meetingpurpose'],
                'created_by' => $data['created_by'],
                'created_at' => $data['jdmsh_createdon'],
                'meeting_url' => $data['jdmsh_meetingurl'],
                'meeting_status' => $MEETING_STATUS[$data['jdmsh_type']],
                'whome' => $data['MCM_CompanyName'],
                'fresh' => 'new',
                'status' => $data['status'],
                'response' => $data['response'],
                'timezone' => $data['jdmsh_meeting_timezone_fk'],
                'timezoneOffset' => $data['tz_utcoffset'],
                'shedule_meetings' => $shedule_meetings,
                'not_attending_reason' => $comments
            ];
        }
        
        return [
            'list' => $list,
            'total_count' => $provider->getTotalCount()
        ];
    }
    
    /**
     * Meeting info
     */
    public function getmeetinginfo($data)
    {
        $model = JdomeetingskdhdrTbl::find()
        ->select(['jdomeetingskdhdr_pk','jdmsh_title','jdmsh_meetlocation','jdmsh_meetingpurpose','CASE WHEN `jdmsh_type` = 1 then "Online" WHEN `jdmsh_type` = 2 then "Offline" ELSE "" END as meetingtype','CASE WHEN `jdmsh_presencetype` = 1 then "Skype" WHEN `jdmsh_presencetype` = 2 then "Zoom" WHEN `jdmsh_presencetype` = 3 then "Google Meet" ELSE "" END as presencetype','DATE_FORMAT(jdmsh_meetingdate,"%d-%m-%Y") as jdmsh_meetingdate','DATE_FORMAT(jdmsh_starttime,"%h:%i %p") as jdmsh_starttime','DATE_FORMAT(jdmsh_endtime,"%h:%i %p") as jdmsh_endtime','UserMst_Pk','MemberCompMst_Pk','MCM_CompanyName','usermst_tbl.um_userdp as um_userdp'])
        ->leftJoin('jdotargetmember_tbl','jdotargetmember_tbl.jdotargetmember_pk=jdomeetingskdhdr_tbl.jdmsh_creator_jdotargetmember_fk')
        ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=jdotargetmember_tbl.jdtm_target_usermst_fk')
        ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=usermst_tbl.UM_MemberRegMst_Fk')
        ->where('jdomeetingskdhdr_pk=:meetingpk',array(':meetingpk' =>  $data['meetpk']))
        ->andWhere('jdotargetmember_tbl.jdtm_target_usermst_fk=:userpk',array(':userpk' =>  $data['userpk']))
        ->asArray()->one();
        
        $info=[];
        if(!empty($model)){    
            $file_pk = $model['um_userdp'];
            $file_path='';
            if(!empty($file_pk)){
                $file_path = Drive::generateUrl($file_pk, $model['MemberCompMst_Pk'], $model['UserMst_Pk']);
            }

            $info['jdomeetingskdhdr_pk']  =   $data['jdomeetingskdhdr_pk'];      
            $info['jdmsh_title']  =   $data['jdmsh_title'];      
            $info['meetingtype']  =   $data['meetingtype'];      
            $info['presencetype']  =   $data['presencetype'];      
            $info['jdmsh_meetlocation']  =   $model['jdmsh_meetlocation'];      
            $info['jdmsh_meetingdate']  =   $data['jdmsh_meetingdate'];      
            $info['jdmsh_starttime']  =   $data['jdmsh_starttime'];      
            $info['jdmsh_endtime']  =   $data['jdmsh_endtime'];    
            $info['jdmsh_notifybefore']  =   $data['jdmsh_notifybefore'];
            $info['MCM_CompanyName']  =   $data['MCM_CompanyName'];      
            $info['file_path']  =   $file_path;
            

            // $members = JdomeetskdmemberTbl::find()->where(['in', 'colprojaudience_pk', $model["cmd_colprojaudience_fk"]])->all();
            // $model->members
            $discussmembers = [];
            $mcpPk =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            if(!empty($members)){
                foreach($members as $member){
                    $image_link = Drive::generateUrl($member->user->um_userdp,$mcpPk,$member->user->UserMst_Pk);
                    $discussmembers[] = [
                        'fisrt_name' => $member->user->um_firstname,
                        'middle_name' => $member->user->um_middlename,
                        'last_name' => $member->user->um_lastname,
                        'user_dp' => $image_link
                    ];
                }
            }
            $info['members'] =  $discussmembers;
        }
        
        return $info;
    }

    /**
     * Reschedulemeeting
     */
    public function reschedulemeeting($data){
      
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data){
            $meeting = \api\modules\ct\models\JdomeetingskdhdrTbl::findOne($data['meetingpk']);
            if($meeting){   
                $result = \api\modules\ct\models\JdomeetreskdTblQuery::savedetail($data);
            }
        }
        return  $result;
    }
}