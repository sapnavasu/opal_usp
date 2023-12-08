<?php

namespace api\modules\ct\models;

use Exception;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use common\components\Drive;
use api\modules\ct\models\JdotargetmemberTbl;
use api\modules\ct\models\JdodiscusshdrTbl;

/**
 * This is the ActiveQuery class for [[JdodiscussmemberTbl]].
 *
 * @see JdodiscussmemberTbl
 */
class JdodiscussmemberTblQuery extends \yii\db\ActiveQuery {
    /*
     * add discussion member
     *
     */

    public static function getTargetmemberIds($meetpk) {

        $memberIds = JdotargetmemberTbl::find()->where(['jddm_jdodiscusshdr_fk' => $meetpk])->select("jddm_jdotargetmember_fk")->asArray()->column();
        return $memberIds;
    }

    /*
     * add discussion member
     *
     */

    public function savediscussionmember($disscussionPk, $dataType, $usersArray) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $date = date("Y-m-d H:i:s");
        if ($dataType == 1) {
            // foreach($usersArray as $key => $user) {
                $model = new JdodiscussmemberTbl();
                $model->jddm_jdodiscusshdr_fk = $disscussionPk;
                $model->jddm_jdotargetmember_fk = $usersArray;
                $model->jddm_status = 1;
                $model->jddm_createdon = $date;
                $model->jddm_createdby = $userPK;
                $model->jddm_createdbyipaddr = $ip_address;
                if (!$model->save()) {
                    return array(
                        'status' => 200,
                        'msg' => 'error',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }                
            // }
        } else {
            if (count($usersArray) > 0) {
                foreach ($usersArray as $key => $value) {
                    $jdoTargetTbl = JdodiscussmemberTbl::find()
                            ->where("jddm_jdodiscusshdr_fk=:pk and jddm_jdotargetmember_fk = :userPk", [':pk' => $disscussionPk, ':userPk' => $value['jdoTargerPk']])
                            ->one();
                    if (empty($jdoTargetTbl)) {
                        $model = new JdodiscussmemberTbl();
                        $model->jddm_jdodiscusshdr_fk = $disscussionPk;
                        $model->jddm_jdotargetmember_fk = $value['jdoTargerPk'];
                        $model->jddm_status = 1;
                        $model->jddm_createdon = $date;
                        $model->jddm_createdby = $userPK;
                        $model->jddm_createdbyipaddr = $ip_address;
                        if (!$model->save()) {
                            return array(
                                'status' => 200,
                                'msg' => 'error',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'returndata' => $model->getErrors()
                            );
                        }
                    }elseif (!empty($jdoTargetTbl) && $jdoTargetTbl->jddm_status == 2) {
                         $jdoTargetTbl->jddm_status = 1;
                         $jdoTargetTbl->jddm_rejoinedon = $date;
                         if (!$jdoTargetTbl->save()) {
                            return array(
                                'status' => 200,
                                'msg' => 'error',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'returndata' => $jdoTargetTbl->getErrors()
                            );
                        }
                    }
                }
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'comments' => 'Members added successfully',
        );
        return $result;
    }
    public function removeMember($dtlsPk,$usersArray){
        $date = date("Y-m-d H:i:s");
        if (count($usersArray) > 0) {
            foreach ($usersArray as $key => $value) {
                $memberTbl = JdodiscussmemberTbl::find()->where(['jddm_jdodiscusshdr_fk' => $dtlsPk, 'jdodiscussmember_pk' => $value['discussionMemberPk']])->one();
                if (!empty($memberTbl)) {                    
                    $memberTbl->jddm_status = 2;
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
    public function updateStatus($targetMem, $status) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        JdodiscussmemberTbl::updateAll([
            'jddm_status' => $status,
            'jddm_updatedon' => date('Y-m-d H:i:s'),
            'jddm_updatedbyipaddr' => $ip_address,
            'jddm_updatedby' => $userPK
                ], ['in', 'jddm_jdotargetmember_fk', $targetMem]);
        return true;
    }
    public static function getDiscussionUser($dataPk) {
        if (!empty($dataPk)) {
            $model = JdodiscussmemberTbl::find()
                    ->select(['UserMst_Pk','um_firstname','jdotargetmember_pk','jdtm_usertype','MemberCompMst_Pk as compPk','UM_MemberRegMst_Fk','MemberCompMst_Pk','um_userdp'])
                    ->leftJoin('jdotargetmember_tbl', 'jdotargetmember_pk = jddm_jdotargetmember_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->where('jddm_jdodiscusshdr_fk=:dataPk and jddm_status = 1', array(':dataPk' => $dataPk))
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
