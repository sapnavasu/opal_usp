<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use \common\components\Drive;
use common\components\Common;
use api\modules\ct\models\JdonotesmemberTbl;


/**
 * This is the ActiveQuery class for [[JdonotesmemberTbl]].
 *
 * @see JdonotesmemberTbl
 */
class JdonotesmemberTblQuery extends \yii\db\ActiveQuery {

    public static function findBynote($notespk, $targetmember){
        return JdonotesmemberTbl::find()->where(['jdnm_jdonoteshdr_fk' => $notespk, 'jdnm_jdotargetmember_fk' => $targetmember])->one();
    }

    public static function getTargetmemberIds($notespk)
    {
        return JdonotesmemberTbl::find()
            ->select("jdnm_jdotargetmember_fk")
            ->where(['jdnm_jdonoteshdr_fk' => $notespk, 'jdnm_status' => 1])
            ->asArray()
            ->column();
    }

    /**
     * save notes member
     */
    public function savemember($data, $diff){
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($data){
            $model = self::findBynote($data['notespk'], $data['targetmember']);
            if(empty($model)){
                $model = new JdonotesmemberTbl();
                $model->jdnm_jdonoteshdr_fk = $data['notespk'];
                $model->jdnm_jdotargetmember_fk = $data['targetmember'];
                $model->jdnm_status = 1;
                $model->jdnm_createdon = date('Y-m-d H:i:s');
                $model->jdnm_createdbyipaddr = $ip_address;
                $model->jdnm_createdby = $userPK;
            } else {
                $model->jdnm_status = 1;
                $model->jdnm_updatedon = date('Y-m-d H:i:s');
                $model->jdnm_updatedbyipaddr = $ip_address;
                $model->jdnm_updatedby = $userPK;
            }

            if(!empty($diff)){
                JdonotesmemberTbl::updateAll([
                    'jdnm_status' => 2,
                    'jdnm_updatedon' => date('Y-m-d H:i:s'),
                    'jdnm_updatedbyipaddr' => $ip_address,
                    'jdnm_updatedby' => $userPK

                ], ['in', 'jdnm_jdotargetmember_fk', $diff]);
            }
            if($model->save() == TRUE){
                return true;
            }
        }
   
    }

    /**
     * save notes member
     */
    public function saveNotesMembers($notesPk, $targetmemberIds){
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($targetmemberIds){
            $existMemberIds = self::getTargetmemberIds($notesPk);
            $diffMemberIds = array_diff($existMemberIds, $targetmemberIds);

            foreach($targetmemberIds as $targetmemberId) {
                $model = self::findBynote($notesPk, $data['targetmember']);
                if($model) {
                    $model->jdnm_status = 1;
                    $model->jdnm_updatedon = date('Y-m-d H:i:s');
                    $model->jdnm_updatedbyipaddr = $ip_address;
                    $model->jdnm_updatedby = $userPK;
                } else {
                    $model = new JdonotesmemberTbl();
                    $model->jdnm_jdonoteshdr_fk = $notesPk;
                    $model->jdnm_jdotargetmember_fk = $targetmemberId;
                    $model->jdnm_status = 1;
                    $model->jdnm_createdon = date('Y-m-d H:i:s');
                    $model->jdnm_createdbyipaddr = $ip_address;
                    $model->jdnm_createdby = $userPK;
                }
                $model->save();
            }

            if($diffMemberIds) {
                JdonotesmemberTbl::updateAll([
                    'jdnm_status' => 2,
                    'jdnm_updatedon' => date('Y-m-d H:i:s'),
                    'jdnm_updatedbyipaddr' => $ip_address,
                    'jdnm_updatedby' => $userPK

                ], ['in', 'jdnm_jdotargetmember_fk', $diffMemberIds]);
            }
        }   
    }

    /**
     * add notes member
     */
    public function addNotesMembers($notesPk, $targetmemberIds){
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if($targetmemberIds){
            foreach($targetmemberIds as $targetmemberId) {
                $model = self::findBynote($notesPk, $data['targetmember']);
                if($model) {
                    $model->jdnm_status = 1;
                    $model->jdnm_updatedon = date('Y-m-d H:i:s');
                    $model->jdnm_updatedbyipaddr = $ip_address;
                    $model->jdnm_updatedby = $userPK;
                } else {
                    $model = new JdonotesmemberTbl();
                    $model->jdnm_jdonoteshdr_fk = $notesPk;
                    $model->jdnm_jdotargetmember_fk = $targetmemberId;
                    $model->jdnm_status = 1;
                    $model->jdnm_createdon = date('Y-m-d H:i:s');
                    $model->jdnm_createdbyipaddr = $ip_address;
                    $model->jdnm_createdby = $userPK;
                }
                $model->save();
            }
        }   
    }
    
    public function removeMember($dtlsPk, $usersArray){
        $date = date("Y-m-d H:i:s");
        if (count($usersArray) > 0) {
            foreach ($usersArray as $key => $value) {
                $memberTbl = JdonotesmemberTbl::find()->where(['jdnm_jdonoteshdr_fk' => $dtlsPk, 'jdonotesmember_pk' => $value['notesMemberPk']])->one();
                if (!empty($memberTbl)) {                    
                    $memberTbl->jdnm_status = 2;
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
    
    public static function getNotesUser($dataPk) {
        if (!empty($dataPk)) {
            $model = JdonotesmemberTbl::find()
                ->select(['UserMst_Pk','um_firstname','jdotargetmember_pk','jdtm_usertype','MemberCompMst_Pk as compPk','UM_MemberRegMst_Fk','MemberCompMst_Pk','um_userdp'])
                ->leftJoin('jdotargetmember_tbl', 'jdotargetmember_pk = jdnm_jdotargetmember_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where('jdnm_jdonoteshdr_fk=:dataPk and jdnm_status = 1', array(':dataPk' => $dataPk))
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