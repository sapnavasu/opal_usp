<?php

namespace api\modules\mst\models;
use common\components\Security;
use yii\data\ActiveDataProvider;
use common\components\Common;
/**
 * This is the ActiveQuery class for [[LicensinginfoTbl]].
 *
 * @see LicensinginfoTbl
 */
class LicensinginfoTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicensinginfoTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicensinginfoTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function lic_auth_dtls($licinfoPk){
        $query = LicensinginfoTbl::find()
        ->select(['li_referenceno','li_lictitleen','SecM_SectorName'])
        ->leftJoin('sectormst_tbl','SectorMst_Pk=li_sectormst_fk')
        ->where('licensinginfo_pk=:id',[':id' =>  $licinfoPk])
        ->asArray()->one();
        return $query;
    }
    public function noc_listing($data){
        $query = LicensinginfoTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        
        $searchname = $data['searchvalue'];
        $investorname = Security::sanitizeInput($data['investorname'], "number");
        $lictitle = Security::sanitizeInput($data['lictitle'], "number");
        $status = Security::sanitizeInput($data['status'], "number");
        $query->select(['mcm_referenceno','mrm_invidentity','mcm_stakeholderstatus','lic.SecM_SectorName as licsector','prj.SecM_SectorName as prjsector','MCM_CompanyName','mcm_referenceno','prjd_projstatus','prjd_projectid','prjd_referenceno','prjd_projname','li_referenceno','li_lictitleen','lia_applicationno','lia_applsubmon','lia_status','li_memberregmst_fk','lia_createdon','usermst_tbl.um_firstname','usermst_tbl.um_lastname','lia_appdeclcomment','lia_appdeclon','aproved.um_firstname as fname','aproved.um_lastname as lname','licinvapplied_pk','lia_updatedon','update.um_firstname as ufname','update.um_lastname as ulname']);
        $query->leftJoin('licinvapplied_tbl',"lia_licensinginfo_fk=licensinginfo_pk"); 
        $query->leftJoin('memberregistrationmst_tbl',"MemberRegMst_Pk=lia_memregmst_fk");
        $query->leftJoin('membercompanymst_tbl',"MCM_MemberRegMst_Fk=MemberRegMst_Pk");
        $query->leftJoin('sectormst_tbl as lic',"lic.SectorMst_Pk=li_sectormst_fk");
        $query->leftJoin('projectdtls_tbl',"projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk");
        $query->leftJoin('sectormst_tbl as prj',"prj.SectorMst_Pk=prjd_sectormst_fk");
        $query->leftJoin('usermst_tbl','lia_createdby=UserMst_Pk');
        $query->leftJoin('usermst_tbl aproved','lia_appdeclby=aproved.UserMst_Pk');
        $query->leftJoin('usermst_tbl update','lia_updatedby=update.UserMst_Pk');
        // $query->where('licensinginfo_pk=:id',[':id' =>  71]) ;
        $query->orderBy('licinvapplied_tbl.lia_createdon desc');
        if($searchname != '' && $searchname!='null'){
            $query->andFilterWhere(['or',['LIKE','MCM_CompanyName', ':value',array(':value' =>  $searchname)],['LIKE','mcm_referenceno', ':value',array(':value' =>  $searchname)],['LIKE','prjd_projname', ':value',array(':value' =>  $searchname)],['LIKE','prjd_projectid', ':value',array(':value' =>  $searchname)],['LIKE','prjd_referenceno', ':value',array(':value' =>  $searchname)]]);
        }
        if($investorname != ''){
            $query->andFilterWhere(['or',['LIKE','MemberCompMst_Pk', ':value',array(':value' =>  $investorname)]]);
        }
        if($lictitle != ''){
            // $query->andFilterWhere(['or',['LIKE','licensinginfo_pk', ':value',array(':value' =>  $lictitle)]]);
            $query->andFilterWhere(['or',['LIKE','projectdtls_pk', ':value',array(':value' =>  $lictitle)]]);
        }
        if($status != ''){
            if($status==4)
                $status='4,5';
            $query->andWhere("lia_status in ($status)");
//            $query->(['or',['LIKE','lia_status', ':value',array(':value' =>  $status)]]);
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);

        $model = LicensinginfoTbl::find()->select(['licensinginfo_pk'])
        // ->where('licensinginfo_pk=:id',[':id' =>  71])
        ->asArray()->all();

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'total' => count($model)
        ];
    }
    
    public function getlicenselist(){
        $memRepk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $query = LicensinginfoTbl::find()
        ->select(['licensinginfo_pk as licenseid','li_lictitleen licensename','li_referenceno as licenserefno','li_validity as validity'])
        ->where('li_status=1')
        ->asArray()->all();
        return $query;
    }
    public function getlicensereqlist($data){
//        echo "<pre>";
//        print_r($data['licenseinfo']);
//        exit;
        if(empty($data['licenseinfo'])){
        echo "<pre>";
        print_r($data['licenseinfo']);
        exit;
        }else{
            echo 'aaaaaaaaaaa';
        }
        $memRepk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $query = \api\modules\pd\models\ProjreqdlictmpTbl::find()
        ->select(['licensinginfo_pk as licenseid','li_lictitleen licensename','li_referenceno as licenserefno','li_validity as validity'])
        ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=prlt_submittedby')
        ->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=prlt_licensinginfo_fk')
        ->where(['UM_MemberRegMst_Fk'=>$memRepk])
        ->distinct('prlt_licensinginfo_fk')
        ->asArray()->all();
        return $query;
    }
    
    public function addliense($data)
    {
        
        $dataval=$data['licenseinfo'];
        $memRepk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $licensePk=Security::sanitizeInput($dataval['licensePk'],'number');
        if($licensePk == NULL){
            $licensemodel = new LicensinginfoTbl;
            $licensemodel->li_createdon = date('Y-m-d H:i:s');
            $licensemodel->li_createdby = $UserPk;
            $licensemodel->li_createdbyipaddr = $ipAddress;
        }  else {
            $licensemodel= LicensinginfoTbl::find()->where('licensinginfo_pk=:id',array(':id' => $licensePk))->one();
            $licensemodel->li_updatedon = date('Y-m-d H:i:s');
            $licensemodel->li_updatedby = $UserPk;
            $licensemodel->li_updatedbyipaddr = $ipAddress;
        }
        $licensemodel->li_memberregmst_fk=$memRepk;
        $licensemodel->li_lictitleen=Security::sanitizeInput($dataval['licensename'],'string_spl_char');
        $licensemodel->li_referenceno=Security::sanitizeInput($dataval['licenserefno'],'string_spl_char');
        $licensemodel->li_validity=!empty($dataval['licensevalidity'])?Common::convertDateTimeToServerTimezone($dataval['licensevalidity'],'Y-m-d'):"";
        $licensemodel->li_status = 1;
        $licensemodel->li_targetdurationtype = 1;
        $licensemodel->li_targetduration = '10 days';
        if($licensemodel->save())
        {
            $data1['licenseid']=$licensemodel->licensinginfo_pk;
            $data1['licensename']=$licensemodel->li_lictitleen;
            $data1['licenserefno']=$licensemodel->li_referenceno;
            $data1['validity']=!empty($licensemodel->li_validity)?$licensemodel->li_validity:"Nil";
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($licensemodel->getErrors());
        }
        return $result;
    }
    
}
