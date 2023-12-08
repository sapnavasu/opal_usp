<?php

namespace api\models;

/**
 * This is the ActiveQuery class for [[SuppchangereqhdrTbl]].
 *
 * @see SuppchangereqhdrTbl
 */
class SuppchangereqhdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SuppchangereqhdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SuppchangereqhdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function insertable($data,$compModel) {
        $renewal_status = $compModel->mCMMemberRegMstFk->MRM_RenewalStatus;
        $suppchangehrd= new SuppchangereqhdrTbl();
        $suppchangehrd->scrh_memberregmst_fk=$compModel->MCM_MemberRegMst_Fk;
        $suppchangehrd->scrh_basemodulemst_fk=154;
        if($renewal_status==Null){
            $suppchangehrd->scrh_updatedfor=1; // for Registration
        }else{
            $suppchangehrd->scrh_updatedfor=2; // for Renewal
        }
        if(!empty($data['updatefileupload'])){
            $suppchangehrd->scrh_upload=$data['updatefileupload'][0];            
        }
        $suppchangehrd->scrh_comments=$data['comments'];
        $suppchangehrd->scrh_createdon=date('Y-m-d H:i:s');
        $suppchangehrd->scrh_createdby= \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $suppchangehrd->scrh_createdbyipaddr= \common\components\Common::getIpAddress();
        if($suppchangehrd->save())
        {
            return $suppchangehrd;
        }else{
            print_r($suppchangehrd->getErrors());exit;
        }
        return [];
    }
}
