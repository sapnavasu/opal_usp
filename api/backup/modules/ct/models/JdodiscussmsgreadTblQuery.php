<?php

namespace api\modules\ct\models;
use Exception;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[JdodiscussmsgreadTbl]].
 *
 * @see JdodiscussmsgreadTbl
 */
class JdodiscussmsgreadTblQuery extends \yii\db\ActiveQuery {

     /*
    * save detail
    *
    */
    public static function saveDetail($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $model = new JdodiscussmsgreadTbl();
        if($data){
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);   
            $ip_address = Common::getIpAddress();
            $model->jddmr_jdodiscussdtl_fk = $data['discussdtlId'];
            $model->jddmr_received_jdodiscussmember_fk = $data['memberId'];
            $model->jddmr_isread = 2;
            $model->jddmr_isdeleted = 2;
            $model->jddmr_createdon = date('Y-m-d H:i:s');
            $model->jddmr_createdby = $userPK;
            $model->jddmr_createdbyipaddr = $ip_address;
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'comments' => 'Record saved successfully',
                'moduleData' => $model,
            ); 
        }else{
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        }
        return $result;
    }
}