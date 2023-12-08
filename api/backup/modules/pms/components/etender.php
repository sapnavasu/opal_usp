<?php

namespace api\modules\pms\components;

use Yii;
use common\components\Common;
use api\modules\mst\models\MembercompanymstTbl;
use common\components\Supplier;
use common\models\UsermapdtlTblQuery;
use common\models\UsermaphdrTblQuery;
use common\models\UsermstTbl;

class etender extends Pms {

    public $lang = 'en';
    public $config = array();

    public function __construct(){
        $config = 1;
        if(\yii\db\ActiveRecord::getTokenData('reg_type', true) ==6){
            $access = $config['access']['supplierEnd'];
            unset($config['access']);  
            $config['access']=$access;
            $this->config = $config;
        }elseif(\yii\db\ActiveRecord::getTokenData('reg_type', true) ==7){
            $access = $config['access']['buyerEnd'];
            unset($config['access']);  
            $config['access']=$access;
            $this->config = $config;
        }
        return $this->config;
    }

    public function insertCompanyInfoTo_eT_Intermediate($memberCompPk=NULL,$objComp=array())
    {
        if(!empty($objComp) && is_object($objComp)){
            $memCompDtl = $objComp;
            $memCompPk = $memCompDtl->MemberCompMst_Pk;
        }else{
            if($memberCompPk!=NULL && !empty($memberCompPk) && is_numeric($memberCompPk)){
            $memCompPk =$memberCompPk;
            }else{
            $memCompPk = $_SESSION['company_primary_id'];
            }
            $memCompDtl = MembercompanymstTbl::find()->where("MemberCompMst_Pk=$memCompPk")->one();   
        }
        $memRegDtl = $memCompDtl->mCMMemberRegMstFk;
        $compAdminUser = $memRegDtl->compAdminUser;
        $JP_ContactDetails = $memRegDtl->compJPUser;
        $compAdminUserEmail = $compAdminUser->UM_EmailID;
        $expireDate = $memRegDtl->expireDate;
        // $memCompGenDtl = $memCompDtl->memcompgendtlsTbls[0];
        $compTypeDtl = $memRegDtl->mrmStkholdertypmstFk;
        $compPrimaryContract=$memCompDtl->memcompmplocationdtlsTblsPrimary;
        
        $compData['umph_memberregmst_fk']=$memRegDtl->MemberRegMst_Pk;
        $compData['umph_membercompmst_fk']=$memCompDtl->MemberCompMst_Pk;
        $compData['umph_stkholdertypmst_fk']=$compTypeDtl->stkholdertypmst_pk;
        $compData['umph_mcm_companyname']=$memCompDtl->MCM_CompanyName;
        if($memRegDtl->MRM_ValSubStatus=='A' && $memRegDtl->MRM_ValSubStatus != NULL){
            $compData['umph_mcm_suppliercode']=$memCompDtl->MCM_SupplierCode;
        }
        $compData['umph_RegistrationNo']=$memCompDtl->mcm_RegistrationNo;
        $compData['umph_mcm_registrationyear']=$memCompDtl->MCM_RegistrationYear;
        $compData['umph_mcm_crno']=$memCompDtl->MCM_crnumber;
        
        $compData['umph_mcmpld_emailid']=$compPrimaryContract->mcmpld_emailid;
        
        $compData['umph_um_admin_emailid']=$compAdminUserEmail;
        $compData['umph_um_contact_emailid']=$JP_ContactDetails->MCCD_Email;  
        
        if(!empty($compPrimaryContract->mcmpld_primobno) && $compPrimaryContract->mcmpld_primobno!=''){
            if(empty($compPrimaryContract->mcmpld_primobnocc) || $compPrimaryContract->mcmpld_primobnocc==''){
                $PMobileNo =  $compPrimaryContract->mcmpld_primobno;
            }else{
                $PMobileNo =  $compPrimaryContract->mcmpld_primobnocc."-".$compPrimaryContract->mcmpld_primobno;
            }
            $compData['umph_mcmpld_mobileno']=$PMobileNo;
        }
        
        if(!empty($compPrimaryContract->mcmpld_landlineno) && $compPrimaryContract->mcmpld_landlineno!=''){
            if(empty($compPrimaryContract->mcmpld_landlinenocc) || $compPrimaryContract->mcmpld_landlinenocc==''){
                $landlineNo =  $compPrimaryContract->mcmpld_landlineno;
            }else{
                $landlineNo =  $compPrimaryContract->mcmpld_landlinenocc."-".$compPrimaryContract->mcmpld_landlineno;
            }
            if(!empty($compPrimaryContract->mcmpld_landlineext) && $compPrimaryContract->mcmpld_landlineext!=''){
                $landlineNo =  $landlineNo.'/'.$compPrimaryContract->mcmpld_landlineext;
            }
        $compData['umph_mcmpld_phoneno']=$landlineNo;
        }
        
        $compData['umph_mcmpld_address']=$compPrimaryContract->mcmpld_address; 
       
        $compData['umph_mcm_citymst_fk']=$memCompDtl->MCM_CityMst_Fk;
        $compData['umph_mcm_statemst_fk']=$memCompDtl->MCM_StateMst_Fk;
        $compData['umph_mcm_countrymst_fk']=$memCompDtl->MCM_Source_CountryMst_Fk;
        
        $compData['umph_mcmpld_postaladdress']=$compPrimaryContract->mcmpld_postaladdress; 
        $compData['umph_mcm_classificationmst_fk']=$memCompDtl->mcm_classificationmst_fk;
        
        $compData['umph_mcaah_expirydate']=$expireDate->mcaah_expirydate;
        
        $lcc_CCED=$memCompDtl->memcomplcccerthdrTblsCCED;
        $lcc_DUQM=$memCompDtl->memcomplcccerthdrTblsDUQM;
        $lcc_OXY=$memCompDtl->memcomplcccerthdrTblsOXY;
        $lcc_PDO=$memCompDtl->memcomplcccerthdrTblsPDO;
        $lcc_SEZAD = $memCompDtl->certmaphdrTblSEZAD;
        $lcc_RIYADA = $this->isRiyada($memCompPk);

        if(!empty($lcc_PDO)){
            $compData['umph_pdodate']=$lcc_PDO->mclch_lcccerton;            
        }
        if(!empty($lcc_SEZAD)){
            $compData['umph_sezaddate']=$lcc_SEZAD->cmph_issuedon;            
            $compData['umph_isprioritysme']=$lcc_SEZAD->cmph_isprioritysme;            
        }
        
        if(is_array($lcc_RIYADA) && count($lcc_RIYADA)>0){
            $compData['umph_isriyada']=1;            
        }else{
            $compData['umph_isriyada']=0;            
        }
        
        if(!empty($lcc_DUQM)){
            $duqmwilayat = array();
            if(!empty($lcc_DUQM->memcomplcccertdtlsTbls)){
                foreach($lcc_DUQM->memcomplcccertdtlsTbls as $wilayat){
                    $duqmwilayat[] = $wilayat->mclcd_wilayatmst_fk;
                }
            }
            $compData['umph_isduqm']=1;            
            $compData['umph_duqmdate']=$lcc_DUQM->mclch_lcccerton;            
            $compData['umph_duqmwilayat']=  implode(',',$duqmwilayat);            
        }
        if(!empty($lcc_CCED)){
            $compData['umph_cceddate']=$lcc_CCED->mclch_lcccerton;            
        }
        if(!empty($lcc_OXY)){
            $oxyblock = array();
            if(!empty($lcc_OXY->memcomplcccertdtlsTbls)){
                foreach($lcc_OXY->memcomplcccertdtlsTbls as $block){
                    $oxyblock[] = $block->mclcd_blockno;
                }
            }
            $compData['umph_oxydate']=$lcc_OXY->mclch_lcccerton;            
            $compData['umph_oxyblock']=implode(',',$oxyblock);
            
        }
 
        $productPks =  $this->getApprovedProducts($memCompDtl->MemberCompMst_Pk);
        $compData['umph_productmst_fk']=$productPks[0]['productPks'];
        $servicePks=$this->getApprovedSevice($memCompDtl->MemberCompMst_Pk);
        $compData['umph_servicemst_fk']=$servicePks[0]['servicePks'];
        $compDataPk = UsermaphdrTblQuery::insertData($compData);
        return $compDataPk;
        // echo '<pre>';print_r($compDataPk);exit;
    }

    public function insertUserInfo($userPk, $userpermission,$memberCompanyPk, $userType) {
        $compDataPk = $this->insertCompanyInfoTo_eT_Intermediate($memberCompanyPk);
        if (!empty($compDataPk) && $compDataPk != '' && is_numeric($compDataPk)) {
            $userDtls = UsermstTbl::find()->where("UserMst_Pk=:userpk",[":userpk"=>$userPk])->one();
            // $userContactDtls = $userDtls->memcompcontactdtlsTbls[0];
            $userData['umpd_usermst_fk'] = $userDtls->UserMst_Pk;
            $userData['umpd_usermaphdr_fk'] = $compDataPk;
            $userData['umpd_um_loginid'] = $userDtls->UM_LoginId;
            $userData['umpd_um_empname'] = $userDtls->um_firstname.' '.$userDtls->um_middlename.' '.$userDtls->um_lastname.' ';
            if (empty($userDtls->um_primobnocc) || $userDtls->um_primobnocc == ''){
                $PMobileNo = $userDtls->um_primobno;
            }else{
                $PMobileNo = $userDtls->um_primobnocc . "-" . $userDtls->um_primobno;
            }
            if (empty($userDtls->um_secmobnocc) || $userDtls->um_secmobnocc == ''){
                $SMobileNo = $userDtls->um_secmobno;
            }else{
                $SMobileNo = $userDtls->um_secmobnocc . "-" . $userDtls->um_secmobno;
            }
            $userData['umpd_um_primobno'] = $PMobileNo;
            $userData['umpd_um_secmobno'] = $SMobileNo;
            $userData['umpd_um_emailid'] = $userDtls->UM_EmailID;
            // if (is_numeric($userDtls->UM_Designation)) {
            //     $userData['umpd_departmentmst_fk'] = $userDtls->UM_Designation;
            // }
            $userData['umpd_status'] = ($userDtls->UM_Status=='A'?1:0);
            $userData['umpd_usertype'] = $userType;
            $userDataPk = UsermapdtlTblQuery::insertData($userData);
            echo '<pre>';print_r($userDataPk);exit;
        }
    }
    
      public  function getApprovedProducts($id){
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $proData =  Yii::$app->db
            ->createCommand("select group_concat(mcprdm_productmst_fk) as productPks from memcompproddtlsmain_tbl as p where p.mcprdm_membercompmst_fk=:Id ")
            ->bindValues(array(':Id' => $id))
            ->queryAll();  
        return $proData;
    }



    
    public static function getApprovedSevice($id){
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $serData =  Yii::$app->db
            ->createCommand("select group_concat(mcsvdm_servicemst_fk) as servicePks from memcompservicedtlsmain_tbl as s where s.mcsvdm_membercompmst_fk=:Id")
            ->bindValues(array(':Id' => $id))
            ->queryAll(); 
        return $serData;
    }

    public static function isRiyada($compPk){
        $record = array();
        if(is_numeric($compPk) && !empty($compPk)){
            $record = \common\models\SuppcertformmembdtlsTbl ::find()
                    ->select('*')
                    ->leftJoin('suppcertformcatdtls_tbl','scfcd_suppcertformmembdtls_fk=suppcertformmembdtls_pk and scfcd_bgivaldoccatmst_fk=10')
                    ->leftJoin('suppcertformtrn_tbl','scft_suppcertformcatdtls_fk=suppcertformtrn_pk and scft_bgivaldocformdescmst_fk=168')
                    ->leftJoin('suppcertformpartrn_tbl','scfpt_suppcertformtrn_fk=suppcertformpartrn_pk and scfpt_isdeleted=2')
                    ->where('scfmd_membercompmst_fk = :compPk',[':compPk' => $compPk])
                    ->asArray()
                    ->all();
            return  $record;
        }
    }

    public function call_eTenderUserInsertSP($interMediateUserPk,$userType,$memRegPk='')
    {
        // \Yii::$app->params['backendBaseUrl']
        if($this->config['access']['eTender'] == 1 || $this->config['access']['eAuction'] == 1){
            if(!empty($memRegPk))
                $executionType = 3; //1->bulk, 2->single user exchange, 3->update the header details, 4->Map Non JSRS user from JSRS to eTendering
            else
                $executionType = 2; //1->bulk, 2->single user exchange, 3->update the header details, 4->Map Non JSRS user from JSRS to eTendering
           
            $EDB=$this->config['DB_Name']; // eTender DB pack
            if($userType == 4 && !empty($memRegPk)){
              $sql="call sp_ins_bidder_officer('$executionType','$interMediateUserPk','$userType','$EDB',$memRegPk)";
            } else if($userType != 4){
                if(empty($memRegPk))
                    $sql="call sp_ins_bidder_officer('$executionType','$interMediateUserPk','$userType','$EDB','')";
                else
                    $sql="call sp_ins_bidder_officer('$executionType','$interMediateUserPk','$userType','$EDB',$memRegPk)";
            }
            $record = Yii::$app->db->createCommand($sql)->query();
        } 

    }


    public function createUrl($type='OT') {
        $params= \common\components\Configuration::getEncryptedUserKey('e-T_e-A');
        if($this->config['folderName'] != ''){
            $eTenderUrl = $this->config['baseLink'] . '/' . $this->config['folderName'];
        }else{  
            $eTenderUrl = $this->config['baseLink'];
        }
        $eTenderUrl.='/submitJSRSLogin?refUrl='.$params.'&type='.$type.'&tid=0&multiParam=';
        return $eTenderUrl;
    }

    public function userAuth() {
        $suppstatus = FALSE;
        if (isset($_REQUEST['amp;key'])) {
            $_REQUEST['key'] = $_REQUEST['amp;key'];
            unset($_REQUEST['amp;key']);
        }

        if (isset($_REQUEST['amp;type'])) {
            $_REQUEST['type'] = $_REQUEST['amp;type'];
            unset($_REQUEST['amp;type']);
        }

        $key = $_REQUEST['key'];
        $type = $_REQUEST['type'];
        $param = array('key', 'type');
        $notEmptyParam = array('key');
        if (Common::requestCount(2) == 'false') {
            $Status_Code = 'JSRS002';
            $message = 'Parameter Missmatching, Kindly Provide Requested Parameter alone';
        } elseif (Common::requestParam($param) == 'false') {
            $Status_Code = 'JSRS003';
            $message = 'Given Parameter Key is Wrong';
        } elseif (Common::requestedParamIsEmpty($notEmptyParam) == 'false') {
            $Status_Code = 'JSRS004';
            $message = 'Requested Parameter(s) should not be Empty';
        } else {
            $deStatus= \common\components\Configuration::getDecryptedUserKey($key,'e-T_e-A');
        if ($deStatus['status']==1) {
                    $record = $deStatus['userObj'];
                    $userPk = $record['attributes']['UserMst_Pk'];
                    $userName = $record['attributes']['UM_LoginId'];
                    $userEmail = $record['attributes']['UM_EmailID'];
                    $CompType = $record['memberRegMaster']['mrm_stkholdertypmst_fk'];
                    $regId = $record['attributes']['UM_MemberRegMst_Fk'];
                    $regObj = $record->registrationDetailsFromUser;
                    $eTenderPageGoesTo = '';
                    if ($type == 'BT' || $type == 'BA' || $type == 'NM') { // BT-Bidder Tender List, BA-Bidder Auction List,NM - Notification Module page  
                        $eTenderPageGoesTo = ' AND umpd_usrtype=1 ';
                        $userType = 1;
                    } elseif ($type == 'CT' || $type == 'CV' || $type == 'NM') { // BT-Bidder Tender List, BA-Bidder Auction List,NM - Notification Module
                        $eTenderPageGoesTo = ' AND umpd_usrtype IN (2,3) ';
                        $userType = 2;
                    } elseif ($type == 'OT' || $type == 'OA') { // OT-Operator Tender page, OA-Operator Auction List
                        $userType = 4;
                    }
                    if ($CompType == 6) {
                        $record = Etender::supplierHaseTenderAcc($regId, $userPk, $userType);
                        if (empty($record) && $type == 'NM') { // NM
                            $record = Etender::supplierHaseTenderAcc($regId, $userPk, 2);
                        }
                    } elseif ($CompType == 14) {
                        $record = Etender::bidderHaseTenderAcc($regId, $userPk, $userType);
                    } elseif ($CompType == 7) {
                        $record = Etender::operatorHasTenderAcc($regId, $userPk, $userType);
                    }
                    if ($record) {
                        $_params = session_get_cookie_params();
                        setcookie("tenderingLogin", "Yes", time() + (86400 * 30), $_params['path'], $_params['domain'], $_params['secure'], $_params['httonly']);
                        $Status_Code = 'JSRS000';
                        $message = 'Success';
                        if ($CompType == 6) {
                            $JSONdata['Code'] = $record['umph_RegistrationNo'];
                            $JSONdata['eTenderLoginPk'] = $record['umpd_userlogin_fk'];
                        } elseif ($CompType == 14) {
                            $JSONdata['eTenderLoginPk'] = $record['umpd_userlogin_fk'];
                        } elseif ($CompType == 7) {
                            $JSONdata['eTenderLoginPk'] = $record['umpd_userlogin_fk'];
                            if ($record['mrm_industrytype'] == 1)
                                $JSONdata['Code'] = 'OPR' . $record['OprCompMst_Pk'];
                            elseif ($record['mrm_industrytype'] == 2)
                                $JSONdata['Code'] = 'BUY' . $record['OprCompMst_Pk'];
                        }
                        $JSONdata['User_Name'] = $userName;
                        $JSONdata['User_Email'] = $userEmail;
                    } else  {
                        $Status_Code = 'JSRS001';
                        $message = 'Record Not Found';
                    }
                } else {
                    $Status_Code = $deStatus['Status_Code'];
                    $message = $deStatus['msg'];
                }
            if (Supplier::isValidJsrsCertificate(null,$regObj) || Supplier::ispaymentconfirmed(null,$regObj)) {
                $suppstatus = TRUE;
            }
        } 
        $JSONdata['Status_Code'] = $Status_Code;
        $JSONdata['message'] = $message;
        $JSONdata['procurementInvitesStatus'] = $suppstatus;
        $JSONdata['gracePeriod'] = Yii::$app->params['Payment_grace_period'];
        echo json_encode($JSONdata);
    }


    public static function supplierHaseTenderAcc($regId,$userPk,$userType)
    {
        if($userType==1){
            $eTenderPageGoesTo = ' AND umpd_usertype=1 ';
        }
        elseif($userType==2 || $userType==3){
            $eTenderPageGoesTo = ' AND umpd_usertype IN (2,3) ';  
        }elseif($userType==4){
            $eTenderPageGoesTo = ' AND umpd_usertype=4';  
        }
        $record=Yii::$app->db->createCommand()
            ->select("umph_RegistrationNo,umpd_userlogin_fk")
            ->from("memberregistrationmst_tbl t")
            ->join("usermaphdr_tbl UMH", "UMH.umph_memberregmst_fk= t.MemberRegMst_Pk AND umph_ispushed=1")
            ->join("usermapdtl_tbl UMD", "UMD.umpd_usermaphdr_fk= UMH.usermaphdr_pk AND umpd_ispushed=1 AND umpd_status=1 AND umpd_userlogin_fk IS NOT NULL  $eTenderPageGoesTo")
            ->where(" mrm_stkholdertypmst_fk = :supplier", array(':supplier'=>6))
            ->andwhere("MemberRegMst_Pk =:regId AND UMD.umpd_usermst_fk=:userPk", array(':regId'=>$regId,':userPk'=>$userPk)) 
            ->queryRow();
        return $record;
    }

    public static function bidderHaseTenderAcc($regId,$userPk,$userType)
    {
        if($userType==1){
            $eTenderPageGoesTo = ' AND umpd_usrtype=1 ';
        }
        elseif($userType==2 || $userType==3){
            $eTenderPageGoesTo = ' AND umpd_usrtype IN (2,3) ';  
        }elseif($userType==4){
            $eTenderPageGoesTo = ' AND umpd_usrtype=4';  
        }
        $record=Yii::$app->db->createCommand()
            ->select("umph_RegistrationNo,umpd_userlogin_fk")
            ->from("memberregistrationmst_tbl t")
            ->join("usermaphdr_tbl UMH", "UMH.umph_memberregmst_fk= t.MemberRegMst_Pk AND umph_ispushed=1")
            ->join("usermapdtl_tbl UMD", "UMD.umpd_usermaphdr_fk= UMH.usermaphdr_pk AND umpd_ispushed=1 AND umpd_status=1 AND umpd_userlogin_fk IS NOT NULL $eTenderPageGoesTo")
            ->where(" mrm_stkholdertypmst_fk = :supplier OR mrm_stkholdertypmst_fk = :bidder", array(':bidder'=>14,':supplier'=>6))
            ->andwhere("MemberRegMst_Pk =:regId AND UMD.umpd_usermst_fk=:userPk", array(':regId'=>$regId,':userPk'=>$userPk)) 
            ->queryRow();
        return $record;
    }

    public static function operatorHasTenderAcc($regId, $userPk, $userType){
        if($userType==1){
            $eTenderPageGoesTo = ' AND umpd_usrtype=1 ';
        }
        elseif($userType==2 || $userType==3){
            $eTenderPageGoesTo = ' AND umpd_usrtype IN (2,3) ';  
        }elseif($userType==4){
            $eTenderPageGoesTo = ' AND umpd_usrtype=4';  
        }
        $record=Yii::$app->db->createCommand()
            ->select("umph_RegistrationNo,umpd_userlogin_fk,OprCompMst_Pk,mrm_industrytype")
            ->from("memberregistrationmst_tbl t")
            ->join("usermaphdr_tbl UMH", "UMH.umph_memberregmst_fk= t.MemberRegMst_Pk AND umph_ispushed=1")
            ->join("usermaphdr_tbl UMH", "UMH.umph_memberregmst_fk= t.MemberRegMst_Pk AND umph_ispushed=1")
            ->join("usermapdtl_tbl UMD", "UMD.umpd_usermaphdr_fk= UMH.usermaphdr_pk AND umpd_ispushed=1 AND umpd_status=1 AND umpd_userlogin_fk IS NOT NULL $eTenderPageGoesTo")
            ->where("MRM_MemberStatus = :active AND mrm_stkholdertypmst_fk = :OPR  ", array(':active'=>'A',':OPR'=>7))
            ->andwhere("MemberRegMst_Pk =:regId AND UMD.umpd_usermst_fk=:userPk", array(':regId'=>$regId,':userPk'=>$userPk)) 
            ->queryRow();
        return $record;
    } 

    public function activeDeactiveIn_eTenderTable($intermediateUserDataPk,$changeStatus)
    {
        if($this->config['access']['eTender'] == 1 || $this->config['access']['eAuction'] == 1){
            $EDB=$this->config['DB_Name'];
            $userdata = Yii::$app->db
                ->createCommand("select userId from $EDB.tbl_userlogin WHERE usrmapdtl_fk=:userIdFK")
                ->bindValues(array(':userIdFK'=>$intermediateUserDataPk))
                ->queryRow();
            $userPk=$userdata['userId'];
            if(!empty($userPk) && $userPk !='' && is_numeric($userPk))
            {
                Yii::$app->db
                    ->createCommand("UPDATE $EDB.tbl_userlogin SET cstatus =:cstatus  WHERE usrmapdtl_fk=:userIdFK")
                    ->bindValues(array(':cstatus' =>$changeStatus,':userIdFK'=>$intermediateUserDataPk))
                    ->execute();
                Yii::$app->db
                    ->createCommand("UPDATE $EDB.tbl_officer SET cstatus =:cstatus  WHERE userId=:userId")
                    ->bindValues(array(':cstatus' =>$changeStatus,':userId'=>$userPk))
                    ->execute();
            }
        }
    }
}
