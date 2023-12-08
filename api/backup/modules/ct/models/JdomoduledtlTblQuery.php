<?php

namespace api\modules\ct\models;

use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use api\modules\ct\models\JdomoduledtlTbl;
use api\modules\ct\models\JdomodulehdrTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;
use yii\db\ActiveRecord;
use common\components\Drive;

/**
 * This is the ActiveQuery class for [[jdomoduledtlTbl]].
 *
 * @see jdomoduledtlTbl
 */
class JdomoduledtlTblQuery extends \yii\db\ActiveQuery {

    /**
     * 
     * create collaborate card
     */
    public function addData($headerPk,$formData)
    {
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $data =date("Y-m-d H:i:s");
        $coldtls= JdomoduledtlTbl::find()
                ->where("jdomoduledtl_pk=:pk and jdmd_jdomodulehdr_fk = :hdrPk",[':pk'=>$formData['dtlsPk'],':hdrPk'=>$headerPk])
                ->one();
        if(empty($coldtls)){
                $coldtls = new JdomoduledtlTbl();
                $coldtls->jdmd_jdomodulehdr_fk = $headerPk;
                $coldtls->jdmd_shared_type = $formData['sharedtype'];
                $coldtls->jdmd_shared_fk = $formData['sharedfk'];
                $coldtls->jdmd_title = $formData['dataTitle'];
                $coldtls->jdmd_subject = $formData['dataSubject'];
                $coldtls->jdmd_type = $formData['dataType'];
                $coldtls->jdmd_uid = Common::getUniqueId('jdo');;
                $coldtls->jdmd_status = 1;
                $coldtls->jdmd_createdon = $data;
                $coldtls->jdmd_createdby = $userPK;
                $coldtls->jdmd_createdbyipaddr = $ip_address;
            if($coldtls->save()){
                    $currentUser = JdotargetmemberTblQuery::addMember($coldtls->jdomoduledtl_pk,1,[],1);
                if (count($formData['internalInvite']) > 0) {
                    $internalUser = JdotargetmemberTblQuery::addMember($coldtls->jdomoduledtl_pk,2,$formData['internalInvite'],1);
                }
                if (count($formData['externalInvite']) > 0) {
                    $externalUser = JdotargetmemberTblQuery::addMember($coldtls->jdomoduledtl_pk,2,$formData['externalInvite'],2);
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Collaboration Added Successfully',
                    'modulePk' => $coldtls->jdomoduledtl_pk
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $coldtls->getErrors()
                );
            }
        }else{
            $coldtls->jdmd_shared_type = Security::sanitizeInput($formData['sharedtype'], "number");
            $coldtls->jdmd_shared_fk = Security::sanitizeInput($formData['sharedfk'], "number");
            $coldtls->jdmd_title = Security::sanitizeInput($formData['dataTitle'], "string");
            $coldtls->jdmd_subject = Security::sanitizeInput($formData['dataSubject'], "string");
            $coldtls->jdmd_type = Security::sanitizeInput($formData['dataType'], "number");
            if($coldtls->save()){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Collaboration updated Successfully',
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $coldtls->getErrors()
                );
            }
        }
        return $result;
    }

    /**
     * get Card list
     */
    public function cardlisting($data)
    {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $masterPk = Security::sanitizeInput($data['masterData'], "number");
        $dataType = Security::sanitizeInput($data['dataType'], "number");
        $statusValue = Security::sanitizeInput($data['statusValue'], "number");
        $viewByValue = Security::sanitizeInput($data['viewByValue'], "string_spl_char");
        $valueStart = Security::sanitizeInput($data['valueStart'], "string_spl_char");
        $valueEnd = Security::sanitizeInput($data['valueEnd'], "string_spl_char");
        $model = JdomoduledtlTbl::find()
                ->select(['jdomoduledtl_pk', 'jdotargetmember_pk', 'jdmd_title', 'jdmd_subject', 'MCM_CompanyName', 'DATE_FORMAT(jdmd_createdon,"%d-%m-%Y %h:%i %p") as jdmd_createdon','jdtm_invitestatus', 'jdomodulemst_pk', 'um_firstname', 'jdmd_type', 'MCM_CompanyName','jdtm_invitestatus','jdtm_acceptedon','jdtm_userstatus','jdmh_jdomodulemst_fk','jdmd_uid',
                    'coalesce(group_concat(IF(jdup_category = 1, 1, null)), 0) as muteNotification',
                    'coalesce(group_concat(IF(jdup_category = 2, 1, null)), 0) as archiveCard',
                    "if(jdomodulemst_pk = 1,'General',if(jdomodulemst_pk = 2,'Project (CMS)',if(jdomodulemst_pk = 4,'Skycard',if(jdomodulemst_pk = 5,'Support (BGI)',if(jdomodulemst_pk = 6,'B2B',null)))))as dataName"
                    ])
                ->leftJoin('jdomodulehdr_tbl', 'jdomodulehdr_pk=jdmd_jdomodulehdr_fk')
                ->leftJoin('jdomodulemst_tbl', 'jdomodulemst_pk=jdmh_jdomodulemst_fk')
                ->leftJoin('jdotargetmember_tbl', 'jdtm_jdomoduledtl_fk=jdomoduledtl_pk')
                ->leftJoin('jdouserpreference_tbl', 'jdup_usermst_fk=jdtm_target_usermst_fk and jdup_shared_type = 1 and jdup_shared_fk = jdomoduledtl_pk and jdup_status = 1')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk=jdmh_memberregmst_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk= jdmd_createdby')
                ->where('jdtm_target_usermst_fk=:userpk and jdomodulemst_pk = :masterPK and jdmd_type=:type and jdmd_status = 1', [':userpk' => $userPK, ':masterPK' => $masterPk, ':type' => $dataType]);
        if (!empty($searchTxt) && $searchTxt != null) {
            $model->andFilterWhere(['or', ['like', 'jdmd_title', $searchTxt], ['like', 'jdmd_subject', $searchTxt]]);
        }
        if (!empty($valueStart) && !empty($valueEnd)) {
            $start_date = date("Y-m-d", strtotime($valueStart));
            $end_date = date("Y-m-d", strtotime($valueEnd));
            $model->andWhere(['between', 'jdmd_createdon', $start_date, $end_date]);
        }
        if (!empty($viewByValue) && $viewByValue != 'null') {
            $model->andWhere(['IN', 'jdtm_invitestatus', explode(',', $viewByValue)]);
        }
        $model->groupBy('jdomoduledtl_pk');
        if ($sortpk == 1) {
            $model->orderBy([new \yii\db\Expression("coalesce(jdmd_createdon) DESC")]);
        } else {
            $model->orderBy([new \yii\db\Expression("coalesce(jdmd_createdon) ASC")]);
        }
        $model->groupBy('jdomoduledtl_pk');
        if (!empty($statusValue) && $statusValue == 1) {
           $model->having('archiveCard = 0');
        }  else {
            $model->having('archiveCard = 1');
        }
        
        $page_size = (!empty($size)) ? $size : 6;
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model, 'pagination' => ['pageSize' => $page_size]]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            $listData['userList'] = [];
            if ($listData['jdomoduledtl_pk'] != NULL && !empty($listData['jdomoduledtl_pk'])) {
                $userData = JdotargetmemberTblQuery::getInvitedUserList($listData['jdomoduledtl_pk']);
                $listData['userList'] = $userData['moduleData'];
            }
            $finalData[] = $listData;
        }
        return [
            'items' => $finalData,
            'total_count' => $provider->getTotalCount(),
            'limit' => $page_size
        ];
    }

    /**
     * get Drive list
     */
    public function driveList($formdata)
    {
        $data = [];
        $dataPk = $formdata['dataPk'];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $targetmemberPK = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $dataPk, 'jdtm_target_usermst_fk' => $userPK])->one()->jdotargetmember_pk;
        $limit = $formdata['size'];
        $offset = ($formdata['page'] - 1) * $limit;
        $shareType = 'CASE  
            WHEN `jdodiscusshdr_pk` then 1
            WHEN `jdotaskhdr_pk` then 2
            WHEN `jdonoteshdr_pk` then 3
        END';
        $shareFk = 'CASE  
            WHEN `jdodiscusshdr_pk` then jdodiscusshdr_pk
            WHEN `jdotaskhdr_pk` then jdotaskhdr_pk
            WHEN `jdonoteshdr_pk` then jdonoteshdr_pk
        END';
        
        $query = MemcompfiledtlsTbl::find()
            ->select([
                'memcompfiledtls_pk',
                'mcfd_origfilename',
                'mcfd_memcompmst_fk',
                'mcfd_uploadedby',
                'mcfd_filetype',
                'mcfd_actualfilesize',
                'mcfd_uploadedon',
                'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                $shareType.' as share_type',
                $shareFk.' as share_fk'
            ])
            ->leftJoin('usermst_tbl', 'mcfd_uploadedby = UserMst_Pk')
            ->leftJoin('jdodiscusshdr_tbl', 'FIND_IN_SET(memcompfiledtls_pk, jddh_filepath)')
            ->leftJoin('jdotaskhdr_tbl', 'FIND_IN_SET(memcompfiledtls_pk, jdth_task_filepath)')
            ->leftJoin('jdonoteshdr_tbl', 'FIND_IN_SET(memcompfiledtls_pk, jdnh_notes_filepath)')
            ->leftJoin('jdojdrivehdr_tbl', 'memcompfiledtls_pk = jdjdh_filepath and jdjdh_jdotargetmember_fk = '.$targetmemberPK.' and jdjdh_shared_type = '.$shareType.' and jdjdh_shared_fk = '.$shareFk)
            ->where(['or',
                ['=', 'jddh_jdomoduledtl_fk', $dataPk],
                ['=', 'jdth_jdomoduledtl_fk', $dataPk],
                ['=', 'jdnh_jdomoduledtl_fk', $dataPk]
            ]);

        if($formdata['search']['file']) {
            $query = $query->andFilterWhere(['like', 'mcfd_origfilename', $formdata['search']['file']]);
        }
        if($formdata['range']['startDate'] && $formdata['range']['endDate']) {
            $query = $query->andWhere(['between', 'mcfd_uploadedon', date('Y-m-d H:i:s', strtotime($formdata['range']['startDate'])), date('Y-m-d H:i:s', strtotime($formdata['range']['endDate']))]);
        }
        if($formdata['sort'] == 'size') {
            $query = $query->orderBy('mcfd_actualfilesize DESC');
        }
        if($formdata['sort'] == 'open') {
            $query = $query->orderBy('jdjdh_lastviewedon DESC');
        }
        $total_count = $query->count();
        $result = $query->limit($limit)->offset($offset)->asArray()->createCommand()->queryAll();
        
        foreach ($result as $val) {
            $userList = [];
            if($val['share_type'] == 1) {
                $userList = JdodiscussmemberTbl::find()
                    ->select([
                        'UserMst_Pk userPk',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'IFNULL(jdjdh_isviewed, 2) seen_status',
                        'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) dp',
                        'jdjdh_lastviewedon datetime'
                    ])
                    ->leftJoin('jdotargetmember_tbl', 'jddm_jdotargetmember_fk = jdotargetmember_pk')
                    ->leftJoin('usermst_tbl', 'jdtm_target_usermst_fk = UserMst_Pk')
                    ->leftJoin('memcompfiledtls_tbl', 'um_userdp = memcompfiledtls_pk')
                    ->leftJoin('jdojdrivehdr_tbl', 'jdotargetmember_pk = jdjdh_jdotargetmember_fk and jdjdh_shared_type = '.$val['share_type'].' and jdjdh_shared_fk = '.$val['share_fk'].' and jdjdh_filepath = '.$val['memcompfiledtls_pk'].' and jdjdh_isdeleted = 2')
                    ->where(['jddm_jdodiscusshdr_fk' => $val['share_fk']])
                    ->asArray()->all();
            } elseif ($val['share_type'] == 2) {
                $userList = JdotaskhdrTbl::find()
                    ->select([
                        'UserMst_Pk userPk',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'IFNULL(jdjdh_isviewed, 2) seen_status',
                        'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) dp',
                        'jdjdh_lastviewedon datetime'
                    ])
                    ->leftJoin('jdotargetmember_tbl', 'jdth_jdomoduledtl_fk = jdtm_jdomoduledtl_fk')
                    ->leftJoin('usermst_tbl', 'jdtm_target_usermst_fk = UserMst_Pk')
                    ->leftJoin('memcompfiledtls_tbl', 'um_userdp = memcompfiledtls_pk')
                    ->leftJoin('jdojdrivehdr_tbl', 'jdotargetmember_pk = jdjdh_jdotargetmember_fk and jdjdh_shared_type = '.$val['share_type'].' and jdjdh_shared_fk = '.$val['share_fk'].' and jdjdh_filepath = '.$val['memcompfiledtls_pk'].' and jdjdh_isdeleted = 2')
                    ->where(['jdotaskhdr_pk' => $val['share_fk']])
                    ->asArray()->all();
            } elseif ($val['share_type'] == 3) {
                $userList = JdonotesmemberTbl::find()
                    ->select([
                        'UserMst_Pk userPk',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'IFNULL(jdjdh_isviewed, 2) seen_status',
                        'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) dp',
                        'jdjdh_lastviewedon datetime'
                    ])
                    ->leftJoin('jdotargetmember_tbl', 'jdnm_jdotargetmember_fk = jdotargetmember_pk')
                    ->leftJoin('usermst_tbl', 'jdtm_target_usermst_fk = UserMst_Pk')
                    ->leftJoin('memcompfiledtls_tbl', 'um_userdp = memcompfiledtls_pk')
                    ->leftJoin('jdojdrivehdr_tbl', 'jdotargetmember_pk = jdjdh_jdotargetmember_fk and jdjdh_shared_type = '.$val['share_type'].' and jdjdh_shared_fk = '.$val['share_fk'].' and jdjdh_filepath = '.$val['memcompfiledtls_pk'].' and jdjdh_isdeleted = 2')
                    ->where(['jdnm_jdonoteshdr_fk' => $val['share_fk']])
                    ->asArray()->all();
            }

            $userList = array_map(function($item) {
                $dp = json_decode($item['dp']);
                $item['dp'] = Drive::generateUrl($dp->pk, $dp->comp_pk, $dp->uploadedby);
                return $item;
            }, $userList);
            $seenByUserList = array_filter($userList, function($item) { return $item['seen_status'] == 1; });
            $unseenByUserList = array_filter($userList, function($item) { return $item['seen_status'] == 2; });

            $data[] = [
                'id' => $val['memcompfiledtls_pk'],
                'title' => $val['mcfd_origfilename'],
                'size' => $val['mcfd_actualfilesize'],
                'exten' => $val['mcfd_filetype'],
                'date' => $val['mcfd_uploadedon'],
                'url' => Drive::generateUrl($val['memcompfiledtls_pk'], $val['mcfd_memcompmst_fk'], $val['mcfd_uploadedby']),
                'attachedBy' => $val['name'],
                'uploadby' => $val['mcfd_uploadedby'],
                'seenByUserList' => array_values($seenByUserList),
                'unseenByUserList' => array_values($unseenByUserList),
            ];
        }
        return [
            'items' => $data,
            'total_count' => $total_count,
            'limit' => $page_size
        ];
    }

    /**
     * get Card detail
     */
    public function cardDetail($cardpk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $data = [];
       
        $card = JdomoduledtlTbl::find()->where("jdomoduledtl_pk=:pk", [':pk' => $cardpk])->one();
     
      if(!empty($card)){
            $createdBy = $card->createdby; 
            $invited = $card->getAllmembers()->where(['jdtm_invitestatus' => 2])->count();
            $accepted = $card->getAllmembers()->where(['jdtm_invitestatus' => 3])->count();
            $pending = $invited-$accepted;
            $externalmembers = $card->getAllmembers()->where(['jdtm_usertype' => 2])->count();
            $userPk = ActiveRecord::getTokenData('UserMst_Pk',true);
            $sentOrRecv = "Received";
            if($card->jdmd_createdby == $userPk) {
                $sentOrRecv = 'Sent';
            }
            $data = array(
                'general_id' => $card->jdmd_shared_fk,
                'name' => $card->jdmd_title,
                'description' => $card->jdmd_subject,
                'type' => $card->jdmd_type,
                'sentOrRecv' => $sentOrRecv,
                'created_by' => !empty($card->createdby) ? [
                    'first_name' => $createdBy->um_firstname,
                    'middle_name' => $createdBy->um_lastname,
                    'last_name' => $createdBy->um_lastname,
                    'company' => $createdBy->membercompany ?  $createdBy->membercompany->MCM_CompanyName : null
                ] : null,
                'created_on' => $card->jdmd_createdon,
                'members' => [
                    'invited' => $invited,
                    'accepted' => $accepted,
                    'pending' => $pending,
                    'externalmembers' => $externalmembers
                ]
            );

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'moduledata' => $data
            );
        }
    
        return $result;
    }    
    /*
    *  get View card Data
    *
    */
    public function getViewCardData($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data'
        );
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $model = JdomoduledtlTbl::find()
                ->select(['jdomoduledtl_pk', 'jdotargetmember_pk', 'jdmd_title', 'jdmd_subject', 'MCM_CompanyName', 'DATE_FORMAT(jdmd_createdon,"%d-%m-%Y %h:%i %p") as jdmd_createdon', 'jdtm_invitestatus', 'um_firstname', 'jdmd_type', 'MCM_CompanyName', 'jdtm_invitestatus', 'jdtm_acceptedon', 'jdtm_userstatus', 'prjd_projimg_fk', 'prjd_createdby', 'jdmh_jdomodulemst_fk','MemberCompMst_Pk','jdmd_uid','um_userdp',
                    'coalesce(group_concat(IF(jdup_category = 1, 1, null)), 0) as muteNotification',
                    'coalesce(group_concat(IF(jdup_category = 2, 1, null)), 0) as archiveCard',
                    "if(jdmh_jdomodulemst_fk = 1,'General',if(jdmh_jdomodulemst_fk = 2,'Project (CMS)',if(jdmh_jdomodulemst_fk = 4,'Skycard',if(jdmh_jdomodulemst_fk = 5,'Support (BGI)',if(jdmh_jdomodulemst_fk = 6,'B2B',null)))))as dataName"
                ])
                ->leftJoin('jdomodulehdr_tbl', 'jdomodulehdr_pk=jdmd_jdomodulehdr_fk')
                ->leftJoin('jdotargetmember_tbl', 'jdtm_jdomoduledtl_fk=jdomoduledtl_pk and jdtm_target_usermst_fk = '.$userPK)
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk=jdmd_shared_fk')
                ->leftJoin('jdouserpreference_tbl', 'jdup_usermst_fk=jdtm_target_usermst_fk and jdup_shared_type = 1 and jdup_shared_fk = jdomoduledtl_pk and jdup_status = 1')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk=jdmh_memberregmst_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk= jdmd_createdby')
                ->where('jdomoduledtl_pk=:dtlsPk ', [':dtlsPk' => $data])
                ->asArray()
                ->one();
        if (!empty($model['prjd_projimg_fk']) && $model['jdmh_jdomodulemst_fk'] == 2) {
            $model['companylogo'] = \common\components\Drive::generateUrl($model['prjd_projimg_fk'], $model['MemberCompMst_Pk'], $model['prjd_createdby']);
        } else {
            $model['companylogo'] = null;
        }
        if (!empty($model['um_userdp'])) {
            $model['creatorImage'] = \common\components\Drive::generateUrl($model['um_userdp'], $model['MemberCompMst_Pk'], $model['jdmd_createdby']);
        } else {
            $model['creatorImage'] = null;
        }
        $model['userList'] = [];
        if ($model['jdomoduledtl_pk'] != NULL && !empty($model['jdomoduledtl_pk'])) {
            $userData = JdotargetmemberTblQuery::getInvitedUserList($model['jdomoduledtl_pk']);
            $model['userList'] = $userData['moduleData'];
        }
        $result = array(
            'status' => 200,
            'flag' => 'S',
            'returndata' => $model
        );

        return $result;
    }

}