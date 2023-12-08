<?php

namespace api\modules\ct\models;

use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use api\modules\ct\models\JdomodulehdrTbl;


/**
 * This is the ActiveQuery class for [[JdomodulehdrTbl]].
 *
 * @see JdomodulehdrTbl
 */
class JdomodulehdrTblQuery extends \yii\db\ActiveQuery {

    /*
    *  get collaboratecountlist
    *
    */
    public function collaborateCountlisting(){        
        $RegPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $model = JdomodulemstTbl::find()
            ->select([
                'jdomodulemst_pk dataPk',
                'jdmm_modulename name',
                'count(jdomoduledtl_pk) cardcount',
                'jdmm_createdon createdon'
            ])
            ->leftJoin('jdomodulehdr_tbl','jdomodulemst_pk = jdmh_jdomodulemst_fk and jdmh_memberregmst_fk = '.$RegPK)
            ->leftJoin('jdomoduledtl_tbl','jdmd_jdomodulehdr_fk=jdomodulehdr_pk')
            ->where(['jdmm_status' => 1])
            ->groupBy('jdomodulemst_pk')
            // ->orderBy('jdmd_createdon DESC')
            ->asArray()
            ->all(); 
      
        return array(
            'status' => 200,
            'flag' => 'S',
            'returndata' => $model
        );
    }
    /**
     * 
     * create collaborate card
     */
    public function addcollaborate($data)
    {
        $formData = $data['dataArray'];
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $RegPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        $date =date("Y-m-d H:i:s");
        
        $jdmoduelhdr= JdomodulehdrTbl::find()
                ->where("jdmh_memberregmst_fk=:pk and jdmh_jdomodulemst_fk = :dataType",[':pk'=>$RegPK,':dataType'=>$formData['dataType']])
                ->one();
        if(empty($jdmoduelhdr)){
            $jdmoduelhdr = new JdomodulehdrTbl();
            $jdmoduelhdr->jdmh_memberregmst_fk = $RegPK;
            $jdmoduelhdr->jdmh_jdomodulemst_fk = $formData['masterModule'];
            $jdmoduelhdr->jdmh_createdon = $date;
            $jdmoduelhdr->jdmh_createdby = $userPK;
            $jdmoduelhdr->jdmh_createdbyipaddr = $ip_address;         
            if($jdmoduelhdr->save()){
                $moduleDtls = JdomoduledtlTblQuery::addData($jdmoduelhdr->jdomodulehdr_pk,$formData);
                if(!empty($moduleDtls)){
                    $result = $moduleDtls;
                }
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $jdmoduelhdr->getErrors()
                );
            }

        }else{
            $moduleDtls = JdomoduledtlTblQuery::addData($jdmoduelhdr->jdomodulehdr_pk,$formData);
            if (!empty($moduleDtls)) {
                $result = $moduleDtls;
            }
        }

        return $result;
    }
}