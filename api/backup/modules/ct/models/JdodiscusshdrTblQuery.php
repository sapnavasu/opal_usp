<?php

namespace api\modules\ct\models;

use Exception;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use common\components\Drive;
use api\modules\ct\models\JdodiscussdtlTbl;
use api\modules\ct\models\JdodiscussmsgreadTblQuery;
use api\modules\ct\models\JdodiscussmemberTbl;
use Yii;

/**
 * This is the ActiveQuery class for [[JdodiscusshdrTbl]].
 *
 * @see JdodiscusshdrTbl
 */
class JdodiscusshdrTblQuery extends \yii\db\ActiveQuery {
    /*
     * add discussion
     *
     */

    public function adddiscussion($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        $jdodishdrpk = $data['discussionPk'];
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $date = date('Y-m-d H:i:s');
        if (!empty($jdodishdrpk)) {
            $jdodishdrdtls = JdodiscusshdrTbl::find()
                    ->where("jdodiscusshdr_pk=:pk", [':pk' => $jdodishdrpk])
                    ->one();
            $msg = "Discussion updated successfully";
            $flag = "U";
            $jdodishdrdtls->jddh_updatedon = $date;
            $jdodishdrdtls->jddh_updatedby =$userPK;
            $jdodishdrdtls->jddh_updatedbyipaddr = $ip_address;
        } else {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $jdoTargetTbl = JdotargetmemberTbl::find()
                    ->where("jdtm_jdomoduledtl_fk=:pk and jdtm_target_usermst_fk = :userPk and jdtm_target_membercompmst_fk = :memcomPk", [':pk' => $data['dtlsPk'], ':userPk' => $userPK, ':memcomPk' => $compPK])
                    ->one();
            $jdodishdrdtls = new JdodiscusshdrTbl();
            $jdodishdrdtls->jddh_jdomoduledtl_fk = Security::sanitizeInput($data['dtlsPk'], "number");
            $jdodishdrdtls->jddh_creator_jdotargetmember_fk = $jdoTargetTbl->jdotargetmember_pk;
            $jdodishdrdtls->jddh_status = 1;
            $jdodishdrdtls->jddh_createdby = $userPK;
            $jdodishdrdtls->jddh_createdon = $date;
            $jdodishdrdtls->jddh_createdbyipaddr = $ip_address;
            $msg = "Discussion created successfully";
            $flag = "C";
        }
        $jdodishdrdtls->jddh_topic = Security::sanitizeInput($data['title'], "string");
        $jdodishdrdtls->jddh_desc = Security::sanitizeInput($data['description'], "string");
        $jdodishdrdtls->jddh_filepath = $data['discussionUpload'] > 0 ? implode(',', $data['discussionUpload']) : null;
        if ($jdodishdrdtls->save()) {
            if ($flag == 'C') {
                $currentUser = JdodiscussmemberTblQuery::savediscussionmember($jdodishdrdtls->jdodiscusshdr_pk, 1, $jdoTargetTbl->jdotargetmember_pk);
                if ($currentUser['flag'] == 'E') {
                    return $currentUser;
                }
            }
            if (count($data['internalInvite']) > 0) {
                $internalUser = JdodiscussmemberTblQuery::savediscussionmember($jdodishdrdtls->jdodiscusshdr_pk, 2, $data['internalInvite']);
                if ($internalUser['flag'] == 'E') {
                    return $internalUser;
                }
            }
            if (count($data['externalInvite']) > 0) {
                $externalUser = JdodiscussmemberTblQuery::savediscussionmember($jdodishdrdtls->jdodiscusshdr_pk, 2, $data['externalInvite']);
                if ($externalUser['flag'] == 'E') {
                    return $externalUser;
                }
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => $flag,
                'comments' => $msg,
            );
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $jdodishdrdtls->getErrors()
            );
        }
        return $result;
    }

    /**
     * change card status
     */
    public function discussionStatusChange($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $formData = $data['dataArray'];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        if (count($formData) > 0) {
            foreach ($formData as $key => $value) {
                $moduledtl = JdodiscusshdrTbl::find()
                        ->where("jdodiscusshdr_pk=:pk", [':pk' => $value['jdodiscusshdr_pk']])
                        ->one();
                if (!empty($moduledtl)) {
                    $moduledtl->jddh_status = 3;
                    $moduledtl->jddh_closedon = $date;
                    $moduledtl->jddh_closedby = $userPK;
                    $moduledtl->jddh_closedbyipaddr = $ip_address;
                }
                if (!$moduledtl->save()) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'error',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $moduledtl->getErrors()
                    );
                    return $result;
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Card status changed successfully',
                );
            }
        }

        return $result;
    }

    /*
     * Discussion Listing
     *
     */

    public function discussionlisting($data) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $dataType = Security::sanitizeInput($data['dataType'], "number");
        $model = JdodiscusshdrTbl::find()
                ->select(['jdodiscusshdr_pk', 'jddh_topic', 'jddh_desc', 'UserMst_Pk', 'MemberCompMst_Pk', 'MCM_CompanyName', 'um_userdp', 'um_firstname', 'jddh_creator_jdotargetmember_fk as creatorMemberPk', 'user.jdtm_target_usermst_fk as currentUserPk','jddh_filepath',
                    'DATE_FORMAT(jddh_createdon,"%d-%m-%Y") as jddh_createdon', 'jddh_jdomoduledtl_fk', 'jddh_status', 'DATE_FORMAT(jddh_closedon,"%d-%m-%Y") as closedOn',
                    'coalesce(group_concat(IF(jdup_category = 2, 1, null)), 0) as archiveCard',
                ])
                ->leftJoin('jdodiscussmember_tbl', 'jddm_jdodiscusshdr_fk=jdodiscusshdr_pk and jddm_status = 1')
                ->leftJoin('jdotargetmember_tbl as user', 'user.jdotargetmember_pk=jddm_jdotargetmember_fk and jdtm_userstatus = 2 and user.jdtm_jdomoduledtl_fk = jddh_jdomoduledtl_fk')
                ->leftJoin('jdotargetmember_tbl as creator', 'creator.jdotargetmember_pk=jddh_creator_jdotargetmember_fk and creator.jdtm_jdomoduledtl_fk = jddh_jdomoduledtl_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk=creator.jdtm_target_usermst_fk')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk=UM_MemberRegMst_Fk')
                ->leftJoin('jdouserpreference_tbl', 'jdup_usermst_fk=user.jdtm_target_usermst_fk and jdup_shared_type = 2 and jdup_shared_fk = jdodiscusshdr_pk and jdup_status = 1')
                // ->Where('jddh_jdomoduledtl_fk=:moduledtlpk', array(':moduledtlpk' => $data['dtlsPK']));
                ->Where('jddh_jdomoduledtl_fk=:moduledtlpk and user.jdtm_target_usermst_fk=:userpk', array(':moduledtlpk' => $data['dtlsPK'], ':userpk' => $userPK));
        if (!empty($searchTxt) && $searchTxt != null) {
            $model->andFilterWhere(['or', ['like', 'jddh_topic', $searchTxt]]);
        }
        $model->orderBy([new \yii\db\Expression("coalesce(jddh_updatedon,jddh_createdon) DESC")]);
        $model->groupBy('jdodiscusshdr_pk');
        if (!empty($dataType) && $dataType == 1) {
            $model->having('archiveCard = 0');
        } else {
            $model->having('archiveCard = 1');
        }
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        $finalData = [];

        foreach ($provider->getModels() as $val) {
            if (!empty($val['um_userdp'])) {
                $val['userImg'] = Drive::generateUrl($val['um_userdp'], $val['MemberCompMst_Pk'], $val['UserMst_Pk']);
            } else {
                $val['userImg'] = 'assets/images/lypis_noimg.svg';
            }
            if (!empty($val['jddh_filepath'])) {
                $dataExpload = explode(',',$val['jddh_filepath']);
                $fileArray = [];
                foreach ($dataExpload as $filePk){
                    $file = Drive::getfiledetails($filePk, $val['MemberCompMst_Pk']);
                    $file['filePk'] = $filePk;
                    $fileArray[] = $file;                    
                }
                $val['fileArray'] = $fileArray;
            } else {
                $val['fileArray'] = [];
            }
            $userArray = [];
            $userArray = JdodiscussmemberTblQuery::getDiscussionUser($val['jdodiscusshdr_pk']);
            $val['userList'] = $userArray['moduleData'];
            $finalData[] = $val;
        }

//        $val = ['active' => $active, 'archive' => $archive];
//        $moduledtl = JdomoduledtlTbl::findOne($data['moduledtlpk']);
//        $cardDetail = [
//            'referenceno' => $moduledtl->jdmd_shared_fk,
//            // 'projectname' => $moduledtl->cpm_projectname,
//            'type' => $moduledtl->jdmd_type
//        ];
//        $members = [];
//
//        if (!empty($moduledtl->allmembers)) {
//            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
//            foreach ($moduledtl->allmembers as $member) {
//                $image_link = Drive::generateUrl($member->user->um_userdp, $mcpPk, $member->user->UserMst_Pk);
//                $members[] = [
//                    'fisrt_name' => $member->user->um_firstname,
//                    'middle_name' => $member->user->um_middlename,
//                    'last_name' => $member->user->um_lastname,
//                    'user_dp' => $image_link
//                ];
//            }
//        }
//        $cardDetail['members'] = $members;
        return [
            'items' => $finalData,
            'total_count' => $provider->getTotalCount()
        ];
    }

    /*
     * Discussion Detail
     *
     */

    public function discussioninfo($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $model = JdodiscusshdrTbl::find()
                        ->select(['jddh_topic', 'jddh_desc', 'usermst_tbl.um_userdp', 'usermst_tbl.um_firstname', 'DATE_FORMAT(jddh_createdon,"%d-%m-%Y") as jddh_createdon, jddh_jdomoduledtl_fk, jdodiscusshdr_pk'])
                        ->leftJoin('jdotargetmember_tbl', 'jdotargetmember_tbl.jdotargetmember_pk=jdodiscusshdr_tbl.jddh_creator_jdotargetmember_fk')
                        ->leftJoin('usermst_tbl', 'usermst_tbl.UserMst_Pk=jdotargetmember_tbl.jdtm_target_usermst_fk')
                        ->Where('jdodiscusshdr_pk=:jdodishdrpk', array(':jdodishdrpk' => $data['jdodishdrpk']))
                        ->asArray()->one();

        if ($model) {
            $members = JdodiscussmemberTbl::find()->where(['jddm_jdodiscusshdr_fk' => $model['jdodiscusshdr_pk']])->all();

            $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            if (!empty($members)) {
                foreach ($members as $member) {
                    $image_link = Drive::generateUrl($member->targetmember->user->um_userdp, $mcpPk, $member->targetmember->user->UserMst_Pk);
                    $discussmembers[] = [
                        'first_name' => $member->targetmember->user->um_firstname,
                        'middle_name' => $member->targetmember->user->um_middlename,
                        'last_name' => $member->targetmember->user->um_lastname,
                        'user_dp' => $image_link
                    ];
                }
            }

            $commentsCount = JdodiscussdtlTbl::find()->where(['jddd_jdodiscusshdr_fk' => $model['jdodiscusshdr_pk']])->count();

            $data = array(
                'items' => $model,
                'members' => $discussmembers,
                'commentsCount' => $commentsCount
            );
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'returndata' => $data
            );
        }
        return $result;
    }

    /*
     * Update discussion Title
     *
     */

    public function updateTopic($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $model = JdodiscusshdrTbl::find()->where("jdodiscusshdr_pk =:pk", [':pk' => $data['formData']['discusshdrpk']])->one();

            if ($model) {
                $model->jddh_topic = $data['formData']['topic'];
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Topic Updated Successfully!'
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
        return $result;
    }

    /*
     * Update discussion Title
     *
     */

    public function changeStatus($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            try {
                $ids = $data['formData']['discussionpk'];
                ColdiscusshdrTbl::updateAll([
                    'cdh_status' => $data['formData']['status']
                        ], ['in', 'coldiscusshdr_pk', $ids]);

                $discussion = ColdiscusshdrTbl::find()->where(['in', 'coldiscusshdr_pk', $ids])->one();

                $msg = "Status changed to Active";
                if ($data['formData']['status'] == 2) {
                    if ($userPK)
                        $msg = "Status changed to Archive";
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => $msg
                );
            } catch (\Exception $e) {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                );
            }
        }
        return $result;
    }

    /*
     * Close Discussion
     */

    public function updateDiscusStatus($data) {
        $discusshdrpk = Security::sanitizeInput($data['discusshdrpk'], "number");
        $status = Security::sanitizeInput($data['status'], "number");
        $discusshdr = JdodiscusshdrTbl::find()
                ->where("jdodiscusshdr_pk=:pk", [':pk' => $discusshdrpk])
                ->one();

        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if (!empty($discusshdr) && $status) {
            $discusshdr->jddh_status = $status;
            $discusshdr->jddh_updatedon = date('Y-m-d h:i:s');
            $discusshdr->jddh_updatedby = $userPK;
            $discusshdr->jddh_updatedbyipaddr = $ip_address;
            if ($status == 3) {
                $discusshdr->jddh_closedon = date('Y-m-d h:i:s');
                $discusshdr->jddh_closedby = $userPK;
                $discusshdr->jddh_closedbyipaddr = $ip_address;
            }

            if ($discusshdr->save()) {
                $msg = "Discussion status updated successfully";
            } else {
                $msg = "Something went wrong";
            }
        } else {
            $msg = "No record found";
        }
        return $msg;
    }

}
