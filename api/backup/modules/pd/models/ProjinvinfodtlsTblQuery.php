<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjinvinfodtlsTbl]].
 *
 * @see ProjinvinfodtlsTbl
 */
class ProjinvinfodtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvinfodtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvinfodtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addInvestorCiteria($data){
        $proInvCiteriaArray = $data['investorCiteriaData'];  
        $projectPk = Security::decrypt($proInvCiteriaArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjinvinfodtlsTbl::find()->where('piid_projectdtls_fk=:piid_projectdtls_fk',[':piid_projectdtls_fk'=> $projectPk])->one(); 
        if(!empty($model)){
            $model->piid_updatedon = $date;
            $model->piid_updatedby = $userPk;
            $model->piid_updatedbyipaddr = $ip_address;
        }  else {
            $model = new ProjinvinfodtlsTbl();
            $model->piid_createdon = $date;
            $model->piid_createdby = $userPk;
            $model->piid_createdbyipaddr = $ip_address;
            $model->piid_projectdtls_fk= $projectPk;
        }
        $model->piid_targetinvestors= $proInvCiteriaArray['piid_targetinvestors'];
        if ($model->save() === false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        }  else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Investor Citeria Add / Updated successfully!',
                'returndata' => $model,
            ); 
        }
            return json_encode($result);
    }
    public function addInvestmentDtls($data){
        $proInvArray = $data['investmentDtls'];  
        $projectPk = Security::decrypt($proInvArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjinvinfodtlsTbl::find()->where('piid_projectdtls_fk=:piid_projectdtls_fk',[':piid_projectdtls_fk'=> $projectPk])->one(); 
        if(!empty($model)){
            $model->piid_updatedon = $date;
            $model->piid_updatedby = $userPk;
            $model->piid_updatedbyipaddr = $ip_address;
        }  else {
            $model = new ProjinvinfodtlsTbl();
            $model->piid_createdon = $date;
            $model->piid_createdby = $userPk;
            $model->piid_createdbyipaddr = $ip_address;
            $model->piid_projectdtls_fk= $projectPk;
        }
        $model->piid_investmentstatus= Security::sanitizeInput($proInvArray['piid_opentoinvest'], "number");
        $model->piid_investtype= Security::sanitizeInput($proInvArray['piid_invparticipation'], "number");
        $model->piid_invprefsrc= Security::sanitizeInput($proInvArray['piid_invprefsrc'], "number");
        $model->piid_totinvreqd= Security::sanitizeInput($proInvArray['projreq'], "number");
        $model->piid_totinvrecd= Security::sanitizeInput($proInvArray['projrec'], "number");
        if ($model->save() === false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        }  else {
        $modelprojcost = ProjectdtlsTbl::find()->where('projectdtls_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        $modelprojcost->prjd_projcost= Security::sanitizeInput($proInvArray['total_cost'], "number");
        $modelprojcost->save();
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Investment Details Add / Updated successfully!',
                'returndata' => $model,
            ); 
        }
            return json_encode($result);
    }
}
