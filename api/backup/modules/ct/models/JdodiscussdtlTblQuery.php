<?php

namespace api\modules\ct\models;
use common\components\Security;
use common\components\Common;
use yii\data\ActiveDataProvider;
use Yii;
use api\modules\ct\models\JdodiscussmsgreadTblQuery;
use common\components\Drive;
use api\modules\drv\models\MemcompfiledtlsTbl;

/**
 * This is the ActiveQuery class for [[JdodiscussdtlTbl]].
 *
 * @see JdodiscussdtlTbl
 */
class JdodiscussdtlTblQuery extends \yii\db\ActiveQuery {

    /**
     * Save discussion message
     * 
     */
    public function adddiscussionmsg($data)
    {
        $jdodishdrpk = Security::sanitizeInput($data['jdodishdrpk'], "number");
        $message = Security::sanitizeInput($data['message'], "string");
        $filepks = $data['filepk'];
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $discussMemberPK = JdodiscussmemberTbl::find()
            ->leftJoin('jdotargetmember_tbl', 'jddm_jdotargetmember_fk = jdotargetmember_pk')
            ->where(['jddm_jdodiscusshdr_fk' => $jdodishdrpk, 'jdtm_target_usermst_fk' => $userPK])
            ->one()->jdodiscussmember_pk;

        if($jdodishdrpk) {
            $model = new JdodiscussdtlTbl();
            $model->jddd_jdodiscusshdr_fk = $jdodishdrpk;
            $model->jddd_jdodiscussmember_fk = $discussMemberPK;
            $model->jddd_reply_message = $message;
            $model->jddd_reply_filepath = implode(',', $filepks);          
            $model->jddd_createdbyipaddr = $ip_address;
            $model->jddd_createdby = $userPK;
            $model->jddd_createdon = date('Y-m-d H:i:s');
            $model->jddd_isdeleted = 2;

            if($model->save()) {
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Message sent Successfully!',
                    'moduelData' => $model
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
        
        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }

    /*
    * Update discussion Title
    *
    */
    public function editMessage($data){
        if($data){
            $ip_address = Common::getIpAddress();
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $dataPk = Security::sanitizeInput($data['dataPk'], "number");
            $message = Security::sanitizeInput($data['message'], "string");
            $filepks = $data['filepk'];
            $model = JdodiscussdtlTbl::findOne($dataPk);

            if($model){
                $model->jddd_reply_message = $message;
                // $model->jddd_reply_filepath = implode(',', $filepks);       
                $model->jddd_updatedbyipaddr = $ip_address;
                $model->jddd_updatedby = $userPK;
                $model->jddd_updatedon = date('Y-m-d H:i:s');
            
                if ($model->save() === TRUE) {
                    return array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Message Updated Successfully!'
                    );
                } else {
                    return array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }

    public function updatemessagestatus($data){
        $coldiscdtlspk = Security::sanitizeInput($data['coldiscdtlspk'], "number");
        $msg_status = Security::sanitizeInput($data['msg_status'], "number");
        $coldiscdtls= ColdiscussdtlsTbl::find()
                ->where("coldiscussdtls_pk=:pk",[':pk'=>$coldiscdtlspk])
                ->one();
        if(!empty($coldiscdtls)){
            $coldiscdtls->cdd_isread=$msg_status;
            if($coldiscdtls->save()){
                if($msg_status==1){
                    $msg = "Message Read";
                }elseif($msg_status==2){
                    $msg = "Message Deleted";
                } 
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }

     /*
    * Get discussion message detail
    *
    */
    public function discussionmsginfo($data)
    {
        $model = JdodiscussdtlTbl::find()
            ->select(['jddd_reply_message','usermst_tbl.um_userdp','usermst_tbl.um_firstname','DATE_FORMAT(jddd_createdon,"%d-%m-%Y") as jddd_createdon'])
            ->leftJoin('jdodiscusshdr_tbl','jdodiscusshdr_tbl.jdodiscusshdr_pk=jdodiscussdtl_tbl.jddd_jdodiscusshdr_fk')
            ->leftJoin('jdotargetmember_tbl','jdotargetmember_tbl.jdotargetmember_pk=jdodiscusshdr_tbl.jddh_creator_jdotargetmember_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=jdodiscusshdr_tbl.jddh_creator_jdotargetmember_fk')
            ->Where('jddd_jdodiscusshdr_fk=:dishdrpk',array(':dishdrpk' =>  $data['jdodishdrpk']));
        $model->orderBy('jdodiscusshdr_pk DESC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount()
        ];
    }

    /*
    * Get discussion message detail
    *
    */
    public function discussionmsglist($dataPk)
    {
        $data = [];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $model = JdodiscussdtlTbl::find()
            ->select([
                'IF(jddd_createdby = '.$userPK.' and jddd_createdon >= DATE_SUB(NOW(), INTERVAL 1 HOUR), jdodiscussdtl_pk, null) id',
                'jddd_createdon date',
                'CONCAT_WS(" ", creator.um_firstname, creator.um_middlename, creator.um_lastname) name',
                'creator.um_userdp userImg',
                'jddd_reply_filepath files',
                'MemberCompMst_Pk',
                'creator.UserMst_Pk',
                'dsg_designationname position',
                'MCM_CompanyName company',
                'jddd_reply_message comment',                ])
            ->leftJoin('jdodiscusshdr_tbl','jddd_jdodiscusshdr_fk = jdodiscusshdr_pk')
            ->leftJoin('jdodiscussmember_tbl','jddd_jdodiscussmember_fk = jdodiscussmember_pk')
            ->leftJoin('jdotargetmember_tbl','jddm_jdotargetmember_fk = jdotargetmember_pk')
            ->leftJoin('usermst_tbl targator', 'jdtm_target_usermst_fk = targator.UserMst_Pk')
            ->leftJoin('usermst_tbl creator', 'jddd_createdby = creator.UserMst_Pk')
            ->leftJoin('designationmst_tbl', 'creator.UM_Designation = designationmst_pk')
            ->leftJoin('membercompanymst_tbl', 'jdtm_target_membercompmst_fk = MemberCompMst_Pk')
            ->Where(['jddd_jdodiscusshdr_fk' => $dataPk, 'jddd_isdeleted' => 2]);
        $model->orderBy('jdodiscussdtl_pk DESC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);

        $isFirst = true;
        foreach($provider->getModels() as $proVal) {
            if($isFirst) {
                $isFirst = false;
            } else {
                $proVal['id'] = null;
            }
            if ($proVal['userImg']) {
                $proVal['userImg'] = Drive::generateUrl($proVal['userImg'], $proVal['MemberCompMst_Pk'], $val['UserMst_Pk']);
            } else {
                $proVal['userImg'] = 'assets/images/lypis_noimg.svg';
            }
            $files = [];
            if($proVal['files']) {
                foreach(explode(',', $proVal['files']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
            }
            $proVal['files'] = $files;
            $data[] = $proVal;
        }

        return $data;
    }

     /*
    * delete discussion Message
    *
    */
    public function deleteMessage($messagepk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
       
        if($messagepk){
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = JdodiscussdtlTbl::find()->where(['jdodiscussdtl_pk' => $messagepk, 'jddd_createdby' => $userPK])->one();
           
            if($model){
                $model->jddd_isdeleted = 1;
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Message deleted Successfully!'
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

}