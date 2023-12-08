<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;
/**
 * This is the ActiveQuery class for [[ProjinvinfotmpTbl]].
 *
 * @see ProjinvinfotmpTbl
 */
class ProjinvinfotmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvinfotmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvinfotmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function addInvestorCiteria($data){
        $proInvCiteriaArray = $data['investorCiteriaData'];
        $projectPk = Security::decrypt($proInvCiteriaArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $i=1;
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');  
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:piit_projectdtls_fk',[':piit_projectdtls_fk'=> $projectPk])->one(); 
        if(!empty($model)){
            $model->piit_updatedon = $date;
            $model->piit_updatedby = $userPk;
            $model->piit_updatedbyipaddr = $ip_address;
        }  else {
            $model = new ProjinvinfotmpTbl();
            $model->piit_submittedon = $date;
            $model->piit_submittedby = $userPk;
            $model->piit_submittedbyipaddr = $ip_address;
            $model->piit_projecttmp_fk= $projectPk;
        }
        $model->piit_targetinvestors= $proInvCiteriaArray['invinvestors'];
        $model->piit_welcomenote= $proInvCiteriaArray['welnote'];
        if ($model->save() === false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        }  else {
            ProjreqdlictmpTbl::deleteAll('prlt_projecttmp_fk=:pk',[':pk'=>Security::sanitizeInput($projectPk,"number")]);
        foreach ($proInvCiteriaArray['permitlicenses'] as $value)
        {
            if(!empty($value['licensename']))
            {
            $modelreqlic = new ProjreqdlictmpTbl;
            $modelreqlic->prlt_projecttmp_fk=$projectPk;
            $modelreqlic->prlt_licensinginfo_fk= Security::sanitizeInput($value['licensename'], "number");
            $modelreqlic->prlt_order= $i;
            $modelreqlic->prlt_submittedon= $date;
            $modelreqlic->prlt_submittedby= $userPk;
            $modelreqlic->prlt_submittedbyipaddr= $ip_address;
            $i=$i+1;    
            if ($modelreqlic->save() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$modelreqlic->getErrors()
                );
            }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Investor Citeria Add / Updated successfully!',
                'returndata' => $model,
            ); }
        }
        }
        }
            return json_encode($result);
    }
    public function getlicenselist()
    {
      return new \yii\data\ActiveDataProvider([
        'query' => \api\modules\mst\models\LicensinginfoTbl::find()
            ->select(['licensinginfo_pk','li_lictitleen'])
            ->where(['=','li_status',1])
            ->orderBy('li_lictitleen ASC'),
        'pagination' => false,
    ]);
    }
    public function getlicenseauthlist($licensePk)
    {
        $model = \api\modules\mst\models\LicensinginfoTbl::find()
                ->select('sectormst_tbl.SecM_SectorName , industrymst_tbl.IndM_IndustryName')
                ->leftJoin('sectormst_tbl','li_sectormst_fk=SectorMst_Pk')
                ->leftJoin('industrymst_tbl','li_industrymst_fk=IndustryMst_Pk')
                ->where('licensinginfo_pk=:pk',array(':pk'=>Security::sanitizeInput($licensePk,"number")))->asArray()->all();
        
        $model1 = \api\modules\mst\models\LicauthdtlsTbl::find()
                ->select('group_concat(lam_licenseauthname_en) as licauthname')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=lad_licensauthoritiesmst_fk')
                ->where('licauthdtls_tbl.lad_licensinginfo_fk=:pk',array(':pk'=>Security::sanitizeInput($licensePk,"number")))->asArray()->all();
        $data[1]=$model;
        $data[2]=$model1;
        return $data;
    }
    public function addInvestmentDtls($data){
        $proInvArray = $data['investmentDtls'];  
        $protype = $data['type'];  
        $projectPk = Security::decrypt($proInvArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        if($protype=='invdtls'){
        $model = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:piit_projectdtls_fk',[':piit_projectdtls_fk'=> $projectPk])->one();
        if(!empty($model)){
            $model->piit_updatedon = $date;
            $model->piit_updatedby = $userPk;
            $model->piit_updatedbyipaddr = $ip_address;
        }  else {
            $model = new ProjinvinfotmpTbl();
            $model->piit_submittedon = $date;
            $model->piit_submittedby = $userPk;
            $model->piit_submittedbyipaddr = $ip_address;
            $model->piit_projecttmp_fk= $projectPk;
        }
        $model->piit_investmentstatus= Security::sanitizeInput($proInvArray['piit_opentoinvest'], "number");
        $model->piit_investtype= Security::sanitizeInput($proInvArray['piit_invparticipation'], "number");
        $model->piit_invprefsrc= Security::sanitizeInput($proInvArray['piit_invprefsrc'], "number");
       $model->piit_totinvrecd= Security::sanitizeInput($proInvArray['projrec'], "number");
        
        }
        if($protype=='projval'){
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        $model->prjt_projcostvalue= Security::sanitizeInput($proInvArray['projcst'], "number");
//        if($proInvArray['projcst']==1){
        $model->prjt_projcost= Security::sanitizeInput($proInvArray['projvalue'], "number");
//        }else{
//        $model->prjt_projcost= null;
//        }
        $model->prjt_debt= Security::sanitizeInput($proInvArray['funddebt'], "number");
        $model->prjt_amtspentsofar= Security::sanitizeInput($proInvArray['fundspentamt'], "number");
        $model->prjt_equity= Security::sanitizeInput($proInvArray['equityusd'], "number");
        $model->prjt_balanceamt= Security::sanitizeInput($proInvArray['balanceamt'], "number");
        $model->prjt_debtequityratio= Security::sanitizeInput($proInvArray['equitratio'], "string");
        
        $model1 = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        if(empty($model1)){
            $model1 = new ProjinvinfotmpTbl();
            $model1->piit_projecttmp_fk = $projectPk;
            $model1->piit_submittedon = $date;
            $model1->piit_submittedby = $userPk;
            $model1->piit_submittedbyipaddr = $ip_address;
        }
        $model1->piit_totinvrecd = Security::sanitizeInput($proInvArray['projrec'], "number");
        $model1->save();
        
    }
        if($protype=='projfund'){
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
//        echo "<pre>";
//        print_r($proInvArray);
//        exit;
        $projfundby=implode(',', $proInvArray['projfundby']);
        $model->prjt_projfundmst_fk= Security::sanitizeInput($projfundby, "string_spl_char");
        if(in_array(6, $proInvArray['projfundby'])){
        $model->prjt_projotherfund= Security::sanitizeInput($proInvArray['projother'], "string_spl_char");
        }else{
        $model->prjt_projotherfund= null ;
        }
        $model->prjt_fundpercent= Security::sanitizeInput($proInvArray['fundper'], "number");
        $model->prjt_fundrefno= Security::sanitizeInput($proInvArray['fundrefno'], "string");
        }
        
        if($protype=='projinvguide'){
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        $model->prjt_projinvproced= Security::sanitizeInput($proInvArray['prjt_projinvproced'], "string");
        }
    
        if($protype=='projvid'){
        $model = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        if(empty($model)){
            $model = new ProjinvinfotmpTbl();
            $model->piit_submittedon = $date;
            $model->piit_submittedby = $userPk;
            $model->piit_submittedbyipaddr = $ip_address;
            $model->piit_projecttmp_fk= $projectPk;
        }
        $model->piit_welcomenote= Security::sanitizeInput($proInvArray['wecomenote'], "string");
        }
        if ($model->save() == false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        } else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Added Successfully!',
                'returndata' => $model
            );
        }
        
            return json_encode($result);
    }
}
