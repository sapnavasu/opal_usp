<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use \common\components\Drive;
use common\components\Common;
use api\modules\ct\models\JdonoteshdrTbl;

/**
 * This is the ActiveQuery class for [[JdomeetskdmemberTbl]].
 *
 * @see JdomeetskdmemberTbl
 */
class JdomeetskdmemberTblQuery extends \yii\db\ActiveQuery {

    public static function findByMeeting($meetpk, $targetmember){
        $meetmember = JdomeetskdmemberTbl::find()->where(['jdmsm_jdomeetingskdhdr_fk' => $meetpk, 'jdmsm_jdotargetmember_fk' => $targetmember])->one();
        return $meetmember;
    }

    public static function getTargetmemberIds($meetpk)
    {
       
        $memberIds = JdomeetskdmemberTbl::find()->where(['jdmsm_jdomeetingskdhdr_fk' => $meetpk]) ->select("jdmsm_jdotargetmember_fk")->asArray()->column();
        return $memberIds;
    }
    /**
     * save notes member
     */
    public function savemember($data, $diff){
       
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($data){
            $model = self::findByMeeting($data['meetpk'], $data['targetmember']);
            if(empty($model)){
                $model = new JdomeetskdmemberTbl();
                $model->jdmsm_jdomeetingskdhdr_fk = $data['meetpk'];
                $model->jdmsm_jdotargetmember_fk = $data['targetmember'];
                $model->jdmsm_response = 1;
                $model->jdmsm_status = 1;
                $model->jdmsm_createdon = date('Y-m-d H:i:s');
                $model->jdmsm_createdbyipaddr = $ip_address;
                $model->jdmsm_createdby = $userPK;
            } else {
                $model->jdmsm_status = 1;
                $model->jdmsm_response = 1;
                $model->jdmsm_updatedon = date('Y-m-d H:i:s');
                $model->jdmsm_updatedbyipaddr = $ip_address;
                $model->jdmsm_updatedby = $userPK;
            }

            if(!empty($diff)){
                JdomeetskdmemberTbl::updateAll([
                    'jdmsm_status' => 2,
                    'jdmsm_updatedon' => date('Y-m-d H:i:s'),
                    'jdmsm_updatedbyipaddr' => $ip_address,
                    'jdmsm_updatedby' => $userPK

                ], ['in', 'jdmsm_jdotargetmember_fk', $diff]);
            }
         
            if($model->save() == TRUE){
                return true;
            } else {
                // echo  '<pre>';
                // print_r($model->getErrors());
                // die;
            }

        }
   
    }

    /**
     * save notes member
     */
    public function saveMeetingMembers($meetingPk, $targetmemberIds){
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($targetmemberIds){
            $existMemberIds = self::getTargetmemberIds($meetingPk);
            $diffMemberIds = array_diff($existMemberIds, $targetmemberIds);

            foreach($targetmemberIds as $targetmemberId) {
                $model = self::findByMeeting($meetingPk, $targetmemberId);
                if($model) {
                    $model->jdmsm_status = 1;
                    $model->jdmsm_response = 1;
                    $model->jdmsm_updatedon = date('Y-m-d H:i:s');
                    $model->jdmsm_updatedbyipaddr = $ip_address;
                    $model->jdmsm_updatedby = $userPK;
                } else {                    
                    $model = new JdomeetskdmemberTbl();
                    $model->jdmsm_jdomeetingskdhdr_fk = $meetingPk;
                    $model->jdmsm_jdotargetmember_fk = $targetmemberId;
                    $model->jdmsm_response = 1;
                    $model->jdmsm_status = 1;
                    $model->jdmsm_createdon = date('Y-m-d H:i:s');
                    $model->jdmsm_createdbyipaddr = $ip_address;
                    $model->jdmsm_createdby = $userPK;
                }
                $model->save();
            }

            if($diffMemberIds) {
                JdomeetskdmemberTbl::updateAll([
                    'jdmsm_status' => 2,
                    'jdmsm_updatedon' => date('Y-m-d H:i:s'),
                    'jdmsm_updatedbyipaddr' => $ip_address,
                    'jdmsm_updatedby' => $userPK
                ], ['in', 'jdmsm_jdotargetmember_fk', $diffMemberIds]);
            }
        }   
    }

    /**
     * add notes member
     */
    public function addMeetingMembers($meetingPk, $targetmemberIds){
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($targetmemberIds){
            foreach($targetmemberIds as $targetmemberId) {
                $model = self::findByMeeting($meetingPk, $targetmemberId);
                if($model) {
                    $model->jdmsm_status = 1;
                    $model->jdmsm_response = 1;
                    $model->jdmsm_updatedon = date('Y-m-d H:i:s');
                    $model->jdmsm_updatedbyipaddr = $ip_address;
                    $model->jdmsm_updatedby = $userPK;
                } else {                    
                    $model = new JdomeetskdmemberTbl();
                    $model->jdmsm_jdomeetingskdhdr_fk = $meetingPk;
                    $model->jdmsm_jdotargetmember_fk = $targetmemberId;
                    $model->jdmsm_response = 1;
                    $model->jdmsm_status = 1;
                    $model->jdmsm_createdon = date('Y-m-d H:i:s');
                    $model->jdmsm_createdbyipaddr = $ip_address;
                    $model->jdmsm_createdby = $userPK;
                }
                $model->save();
            }
        }   
    }
    
    public function removeMember($dtlsPk, $usersArray){
        $date = date("Y-m-d H:i:s");
        if (count($usersArray) > 0) {
            foreach ($usersArray as $key => $value) {
                $memberTbl = JdomeetskdmemberTbl::find()->where(['jdmsm_jdomeetingskdhdr_fk' => $dtlsPk, 'jdomeetskdmember_pk' => $value['notesMemberPk']])->one();
                if (!empty($memberTbl)) {                    
                    $memberTbl->jdmsm_status = 2;
                    if (!$memberTbl->save()) {
                        return array(
                            'status' => 200,
                            'msg' => 'error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $memberTbl->getErrors()
                        );
                    }
                }  else {
                    return array(
                        'status' => 200,
                        'msg' => 'error',
                        'flag' => 'E',
                        'comments' => 'No Data Found',
                        'returndata' => $memberTbl->getErrors()
                    );
                }
            }
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'comments' => 'Members removed successfully!',
        );
        return $result;
    }
    
    public function updateResponse($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data){
            $members = JdomeetskdmemberTbl::find()
                ->where([
                    'jdmsm_jdomeetingskdhdr_fk' => $data['meetPk']
                ] )->all();

            $ip_address = Common::getIpAddress();
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if(!empty($members)){
                foreach($members as $member){
                    if(!empty($member->targetmember->jdtm_target_usermst_fk) && $member->targetmember->jdtm_target_usermst_fk == $userPK){
                        $member->jdmsm_response = $data['response'];
                        $member->jdmsm_responsecomment = !empty($data['responsecomment']) ? $data['responsecomment'] : null;
                        $member->jdmsm_updatedon = date('Y-m-d H:i:s');
                        $member->jdmsm_updatedbyipaddr = $ip_address;
                        $member->jdmsm_updatedby = $userPK;
                       
                        if($member->save() == TRUE){
                            $result = array(
                                'status' => 200,
                                'msg' => 'success',
                                'flag' => 'U',
                                'comments' => 'Member response updated Successfully',
                                'moduleData' => $member,
                            ); 
                        } else {

                            $result = array(
                                'status' => 200,
                                'msg' => 'warning',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'returndata' => $member->getErrors()
                            );
                        }
                    break;
                    }
                }
            }
        }
        return  $result;
    }

    public static function getMeetingUser($dataPk) {
        if (!empty($dataPk)) {
            $model = JdomeetskdmemberTbl::find()
                    ->select(['UserMst_Pk','um_firstname','jdotargetmember_pk','jdtm_usertype','MemberCompMst_Pk as compPk','UM_MemberRegMst_Fk','MemberCompMst_Pk','um_userdp'])
                    ->leftJoin('jdotargetmember_tbl', 'jdotargetmember_pk = jdmsm_jdotargetmember_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->where('jdmsm_jdomeetingskdhdr_fk=:dataPk and jdmsm_status = 1', array(':dataPk' => $dataPk))
                    ->asArray()
                    ->all();
        }
        $user = [];
        $user['internalUser'] = [];
        $user['externalUser'] = [];
        foreach ($model as $userData) {
            if (!empty($userData['um_userdp'])) {
                $userData['imageUrl'] = \common\components\Drive::generateUrl($userData['um_userdp'], $userData['MemberCompMst_Pk'], $userData['UserMst_Pk']);
            } else {
                $userData['imageUrl'] = null;
            }
            if($userData['jdtm_usertype'] == 1){
                $user['internalUser'][] = $userData;
            }  else {
                $user['externalUser'][] = $userData;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $user,
        );
        return $result;
    }
}
