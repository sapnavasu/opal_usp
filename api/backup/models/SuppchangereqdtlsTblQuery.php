<?php

namespace api\models;

/**
 * This is the ActiveQuery class for [[SuppchangereqdtlsTbl]].
 *
 * @see SuppchangereqdtlsTbl
 */
class SuppchangereqdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SuppchangereqdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SuppchangereqdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function inserttable($supchangehrd,$type,$data,$compregModel,$compModel,$usermst,$classification=false,$comppaymentModel=false) {
        if($type==1)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=$compModel->MCM_CompanyName;
        $suppchangedtls->scrd_newvalue=$data['companyname'];
        $suppchangedtls->save();
        }
        if($type==2)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;    
        $suppchangedtls->scrd_oldvalue=$usermst->UM_EmailID;
        $suppchangedtls->scrd_newvalue=$data['companyemail'];
        $suppchangedtls->save();
        }
         
        if($type==3)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        // if($data['updatein']){
        //     $suppchangedtls->scrd_classupdin=$data['updatein'];
        // }
        $suppchangedtls->scrd_oldvalue=(string)$classification->ClassificationMst_Pk;
        $suppchangedtls->scrd_newvalue=(string)$data['classificationpk'];
        $suppchangedtls->save();
                
        }
        
        if($type==4)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=(string)$compregModel->mrm_memsubscriptionmst_fk;
        $suppchangedtls->scrd_newvalue=(string)$data['subcriptionpk'];
        $suppchangedtls->save();
        }
        
        if($type==5)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=(!empty($classification->ClM_HeadCount))? (string)$classification->ClM_HeadCount: 'Nil';
        $suppchangedtls->scrd_newvalue=(string)$data['headcount'];
        if(!$suppchangedtls->save()){
            print_r($suppchangedtls->getErrors()); exit;
        }
        
        }
        
        if($type==6)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=(string)$comppaymentModel->MCPD_TotalMembershipAmt;
        $suppchangedtls->scrd_newvalue=(string)$data['subscriptionfee'];
        $suppchangedtls->save();
        }
        if($type==7)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=(string)$data['exuserpk'];
        $suppchangedtls->scrd_newvalue=(string)$data['userpk'];
        $suppchangedtls->save();
        }
        if($type==8) //style of incorporation 
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=(string)$compregModel->mrm_incorpstylemst_fk;
        $suppchangedtls->scrd_newvalue=(string)$data['incorpstyle'];
        $suppchangedtls->save();
        }
        if($type==9)
        {
        $suppchangedtls=new SuppchangereqdtlsTbl();
        $suppchangedtls->scrd_suppchangereqhdr_fk=$supchangehrd->suppchangereqhdr_pk;
        $suppchangedtls->scrd_flag=$type;
        $suppchangedtls->scrd_oldvalue=$compModel->MCM_CompanyName_ar;
        $suppchangedtls->scrd_newvalue=$data['companyname_ar'];
        $suppchangedtls->save();
        }
    }
}
