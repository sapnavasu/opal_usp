<?php

namespace api\modules\svf\controllers;
use common\components\Drive;
use api\modules\drv\models\MemcompfiledtlsTbl;
use api\modules\mst\controllers\MasterController;
use api\modules\mst\models\BussourcemstTbl;
use api\modules\mst\models\ClassificationmstTbl;
use api\modules\mst\models\CountrymstTbl;
use api\modules\mst\models\MembercompanymstTbl;
use api\modules\mst\models\MemberregistrationmstTbl;
use api\modules\mst\models\CertapprovaldtlsTbl;
use api\modules\mst\models\ProductmstTbl;
use api\modules\mst\models\ApprovalworkflowuserconfigTblQuery;
use api\modules\pms\models\MemcompprodmstmapTblQuery;
use api\modules\pms\models\MemcompservmstmapTblQuery;
use api\modules\pd\models\MemcompmplocationdtlsTbl;
use common\components\Configsession;
use common\components\Products;
use common\components\Sessionn;
use common\models\BgivaldoccatmstTbl;
use common\models\BgivaldoccatparvaldtlsTbl;
use common\models\BgivaldocsubcatpardtlsTbl;
use common\models\BgivaldocformcomppercallcnTbl;
use common\models\BgivaldocformdescmstTbl;
use common\models\BgivaldocsubcatmstTbl;
use common\models\BgivaldocsubcatparvaldtlsTbl;
use common\models\MemcompacomplishdtlsTbl;
use common\models\MemcompbankerdetailsTbl;
use common\models\MemcompbussrcdtlsTbl;
use common\models\MemcomphsescfTbl;
use common\models\MemcompownersdtlTbl;
use common\models\MemcompproddtlsTbl;
use common\models\MemcompservicedtlsTbl;
use common\models\MemcompshareholderdtlsTbl;
use common\models\MemcompsubsidcompTbl;
use common\models\MemprodservrevdtlsTblQuery;
use common\models\MemshareholdcompdisclTbl;
use common\models\MemshareholdrelpdisclTbl;
use common\models\MinistofmanpowerTbl;
use common\models\ScficvbreakdowntmpTbl;
use common\models\ScfpdocatdtlsTbl;
use common\models\ServicemstTbl;
use common\models\SuppcertformcattmpTbl;
use common\models\SuppcertformmembtmpTbl;
use common\models\SuppcertformpartrntmpTbl;
use common\models\SuppcertformtrntmpTbl;
use common\models\SuppcertformmembdtlsTbl;
use common\models\UsermstTbl;
use common\models\WalivlgblockmapTbl;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use \common\components\Suppcertform;
use \common\components\Suppcertformtrn;
use \common\components\Suppcertformparmtrn;
use \common\components\Suppcertformprodpar;
use \common\components\Suppcertformservpar;
use \common\components\Security;
use Yii;
use \app\models\MemcompbranchdtlstempTblQuery;
use \app\models\MemcompbranchdtlstempTbl;
use  \app\models\IndustrialzonemstTbl;
use  \app\models\IndustrialestatemstTbl;
use  \app\models\OfficetypemstTbl;
use DateTime;
use \api\modules\mst\models\CertcatsubcatapprovaldtlsTbl;
use \api\modules\mst\models\CountryMasterQuery;
class SvfController extends MasterController
{
    public $companyPkScf;
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
    public function actions()
    {
        return [];
    }
    public function beforeAction($action)
    {
        header('Content-type: application/json; charset=utf-8');
        Configsession::setConfigsession();
        Sessionn::setSession();
        try {
            return parent::beforeAction($action);
        }
        catch (BadRequestHttpException $e){}
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    public  function convertreactive($fulldata){
        $jsonCnc=[];
        if(!empty($fulldata)){
            foreach ($fulldata as $formdata)
            {
                $jsonCnc[]=$this->whattypearr($formdata);
            }
            return $jsonCnc;
        }
    }
    public function whattypearr($formdata){

        switch ($formdata['bvdscpd_parametertype']){

            case "D":
                $dataretn['controlName']=str_replace(' ','',$formdata['bvdscpd_parametername']);
                $dataretn['fieldname']=str_replace(' ','',$formdata['bvdscpd_parametername'])."bgi".$formdata['bgivaldocsubcatpardtls_pk'];
                $dataretn['controlType']='date';
                $dataretn['valueType']='date';
                $dataretn['layout']='40';
                $dataretn['offset']='0';
                $dataretn['placeholder']=$formdata['bvdscpd_parametername'];
                $dataretn['pattern']='';
                $dataretn['validators'][0]['required']=$formdata['bvdscpd_mandatorystatus']=='Y'?1:0;
                $dataretn['validators'][0]['minlength']=100;
                break;
            case "F":
                $dataretn['controlName']=str_replace(' ','',$formdata['bvdscpd_parametername']);
                $dataretn['controlType']='file';
                $dataretn['fieldname']=str_replace(' ','',$formdata['bvdscpd_parametername'])."bgi".$formdata['bgivaldocsubcatpardtls_pk'];
                $dataretn['valueType']='file';
                $dataretn['layout']='40';
                $dataretn['offset']='0';
                $dataretn['placeholder']=$formdata['bvdscpd_parametername'];
                $dataretn['pattern']='';
                $dataretn['validators'][0]['required']=$formdata['bvdscpd_mandatorystatus']=='Y'?1:0;
                $dataretn['validators'][0]['minlength']=100;
                break;

            case "AF":
                $dataretn['controlName']=str_replace(' ','',$formdata['bvdscpd_parametername']);
                $dataretn['controlType']='select';
                $dataretn['fieldname']=str_replace(' ','',$formdata['bvdscpd_parametername'])."bgi".$formdata['bgivaldocsubcatpardtls_pk'];
                $dataretn['valueType']='select';
                $dataretn['layout']='40';
                $dataretn['placeholder']=$formdata['bvdscpd_parametername'];
                $dataretn['pattern']='';
                $dataretn['validators'][0]['required']=$formdata['bvdscpd_mandatorystatus']=='Y'?1:0;
                $dataretn['validators'][0]['minlength']=100;
                break;
            case "C":
                $dataretn['controlName']=str_replace(' ','',$formdata['bvdscpd_parametername']);
                $dataretn['controlType']='select';
                $dataretn['label']=$formdata['bvdscpd_parametername'];
                $dataretn['fieldname']=str_replace(' ','',$formdata['bvdscpd_parametername'])."bgi".$formdata['bgivaldocsubcatpardtls_pk'];
                $dataretn['valueType']='select';
                $dataretn['layout']='40';
                $dataretn['offset']='0';
                $dataretn['placeholder']=$formdata['bvdscpd_parametername'];
                $dataretn['pattern']='';
                $dataretn['validators'][0]['required']=$formdata['bvdscpd_mandatorystatus']=='Y'?1:0;
                if($formdata['bvdscpd_parametertype']=='C'){
                    $word='*';
                    if(strpos($formdata['bvdscpvd_parametervalue'], $word) !== false) {
                        $firslvl_replace=str_replace(['*','}','{'],'',$formdata['bvdscpvd_parametervalue']);
                        $dataforselect=$this->getselectarr($firslvl_replace);
                        $dataretn['options']=$dataforselect;
                    }
                }
                break;
            case "T":
                $dataretn['controlName']=str_replace(' ','',$formdata['bvdscpd_parametername']);
                $dataretn['fieldname']=str_replace(' ','',$formdata['bvdscpd_parametername'])."bgi".$formdata['bgivaldocsubcatpardtls_pk'];
                $dataretn['controlType']='text';
                $dataretn['valueType']='text';
                $dataretn['layout']='40';
                $dataretn['offset']='0';
                $dataretn['placeholder']=$formdata['bvdscpd_parametername'];
                $dataretn['pattern']='';
                $dataretn['validators'][0]['required']=$formdata['bvdscpd_mandatorystatus']=='Y'?1:0;
                $dataretn['validators'][0]['minlength']=100;
                break;
            default:
                $dataretn=[];

        }
        return $dataretn;
    }
    public function getselectarr($dbQuery){
        $resultcombo=[];
        if($dbQuery){
            $runQueryResult=\Yii::$app->db->createCommand($dbQuery)->queryAll();
            $columnlist=array_keys($runQueryResult[0]);
            foreach ($runQueryResult as $key=>$queryrow){
                $resultcombo[$key]['optionName']=$queryrow[$columnlist[1]];
                $resultcombo[$key]['value']=$queryrow[$columnlist[0]];
            }
        }
        return $resultcombo;
    }
    public function actionFormstatusget(){
        $formpk=$_GET['form'];
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $statusArr=[];
        if(!empty($formpk)){
            $formStatus=['I'=>'Inprogess','A'=>'Approved','D'=>'Declined','RS'=>'ReSubmitted','R'=>'Reopened',
                'U'=>'Updated','DI'=>'Decline InProgress','OSD'=>'Overall VB decline','OVD'=>'Overall SVF Decline'];
            $formMemtmp=SuppcertformmembtmpTbl::find()
                ->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company',
                    [':formpk'=>$formpk,':company'=>$companypk])->one();

            if(!empty($formMemtmp)){
                $statusArr['formstatus']=$formStatus[$formMemtmp->scfmt_scfstatus];
                $statusArr['formcomments']=  html_entity_decode($formMemtmp->scfmt_appdeclcomments);
            }
        }
        return $this->asJson($statusArr);
    }
    public function statussection($SCFWholeStatus,$value,$column){
        $dataModel=[];
        if(is_null($value[$column])){
            $dataModel['finalstatus']='Saved as Draft';              
            $dataModel['class']='Incomplete';
            $dataModel['svg']='incomplete.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='Product creation is inprogress.';
            }else{
                $dataModel['popupcontent']='Service creation is inprogress.';
            }          
        }else if($value[$column] =='Yettoapply'){
            $dataModel['finalstatus']='Yet to Submit for RABT Certification';
            $dataModel['class']='yettoapply';
            $dataModel['svg']='Yet_to_apply.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='You have not added your Product for Validation.';
            }else{
                $dataModel['popupcontent']='You have not added your Service for Validation.';
            }          
        }
        else if(in_array($value[$column],['New','Updated']) && in_array($SCFWholeStatus['scfmt_scfstatus'],['S','RS','U'])){
            $dataModel['finalstatus']='Posted for RABT Certification';
            $dataModel['class']='posted_for_validation';
            $dataModel['svg']='posted_for_validation.svg';
             if($column == 'prductstatus'){
                $dataModel['popupcontent']='The RABT Validation Team is yet to validate your Product.';
            }else{
                $dataModel['popupcontent']='The RABT Validation Team is yet to validate your Service.';
            }    
        } else if((in_array($value[$column],['New','Updated']) && !in_array($SCFWholeStatus->scfmt_scfstatus,['S','RS','D','A','U'])) ||
            (in_array($value[$column],['New','Updated']) && in_array($SCFWholeStatus->scfmt_scfstatus,['A','D']))){
            $dataModel['finalstatus']='Posted for RABT Certification';
            $dataModel['class']='posted_for_validation';
            $dataModel['svg']='posted_for_validation.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='You have not submitted your Product for Validation.';
            }else{
                $dataModel['popupcontent']='You have not submitted your Service for Validation.';
            }   
        }
        else if(in_array($value[$column],['New','Updated']) && !in_array($SCFWholeStatus->scfmt_scfstatus,['S','RS','U'])){
            $dataModel['finalstatus']='Posted for RABT Certification';
            $dataModel['class']='posted_for_validation';
            $dataModel['svg']='posted_for_validation.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='You have not submitted your Product for Validation.';
            }else{
                $dataModel['popupcontent']='You have not submitted your Service for Validation.';
            }   
        } else if($value[$column]=='Approved'){
            //&&  in_array($SCFWholeStatus->scfmt_scfstatus,['S','RS','D','A','U'])
            $dataModel['finalstatus']='RABT Certified';
            $dataModel['class']='approved';
            $dataModel['svg']='Approved.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='Your Product has been approved by the RABT validation Team.';
            }else{
                $dataModel['popupcontent']='Your Service has been approved by the RABT validation Team.';
            }   
        } else if($value[$column]=='RABT Approved'){
            //&&  in_array($SCFWholeStatus->scfmt_scfstatus,['S','RS','D','A','U'])
           
            if($column == 'prductstatus'){
                $dataModel['finalstatus']='RABT Certified';
            }else{
                $dataModel['finalstatus']='RABT Certified';
            }  
            $dataModel['class']='approved';
            $dataModel['svg']='JSRS.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='Your Product has been approved by the RABT validation Team.';
            }else{
                $dataModel['popupcontent']='Your Service has been approved by the RABT validation Team.';
            }   
        }  else if($value[$column]=='Incomplete'){
            $dataModel['finalstatus']='Saved as Draft';
            $dataModel['class']='incomplete';
            $dataModel['svg']='incomplete.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='Product creation is inprogress.';
            }else{
                $dataModel['popupcontent']='Service creation is inprogress.';
            }          
        }else if($value[$column]=='Declined' ){
            //&& in_array($SCFWholeStatus->scfmt_scfstatus,['S','RS','D','A','U'])
            $dataModel['finalstatus']='Declined for RABT Certification';
            $dataModel['class']='declined';
            $dataModel['svg']='Declined.svg';
            if($column == 'prductstatus'){
                $dataModel['popupcontent']='Your Product approval has been declined by the RABT validation Team.';
            }else{
                $dataModel['popupcontent']='Your Service approval has been declined by the RABT validation Team.';
            }          
        }
        return $dataModel;
    }
    public function actionDeleteprdservice(){
        $returnvar = 3;
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
            $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        }
        $formdesc=\common\components\Security::sanitizeInput($_REQUEST['formdesc'],"number");
        $category=\common\components\Security::sanitizeInput($_REQUEST['category'],"number");
        $subcategory=\common\components\Security::sanitizeInput($_REQUEST['subcat'],"number");
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $valdt=\common\components\Security::sanitizeInput($_REQUEST['value'],"number");
        if(!empty($subcategory) && !empty($companypk)){
            if(in_array($subcategory, [9,11])){
                $approvedprdcnt = MemcompproddtlsTbl::find()
                ->where('MCPrD_MemberCompMst_Fk=:company and  mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus ="A"',
                [':company'=>$companypk])
                ->count();
                $approvedservcnt = MemcompservicedtlsTbl::find()
                ->where('MCSvD_MemberCompMst_Fk=:company and  mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus ="A"',
                [':company'=>$companypk])
                ->count();
                $prdDel=MemcompproddtlsTbl::find()
                ->where('MCPrD_MemberCompMst_Fk=:company and MemCompProdDtls_Pk=:val and mcprd_isdeleted = 2', 
                [':company'=>$companypk,':val'=>$valdt])->one();
                if(($approvedprdcnt == 1 || $approvedservcnt ==1) && $prdDel->MCPrD_SVFAdminApprovalStatus == 'A'){
                     $returnvar = 2;
                }else{
                    $formMemtmp=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company', [
                        ':formpk'=>$formpk,
                        ':company'=>$companypk
                    ])->one();
                    if(in_array($formMemtmp->scfmt_scfstatus,['D','OSD'])){
                        $formMemtmp->scfmt_scfstatus='DI';
                    }elseif($formMemtmp->scfmt_scfstatus == 'A'){
                        $formMemtmp->scfmt_scfstatus='UI';
                    }
                    $formMemtmp->scfmt_updatedon=date('Y-m-d H:i:s');
                    $formMemtmp->scfmt_updatedby=$userpk;
                    $formMemtmp->scfmt_formmst_fk=$formpk;
                    $formMemtmp->scfmt_membercompmst_fk=$companypk; 
                    if($formMemtmp->save(false)){
                        $SupCatModel=SuppcertformcattmpTbl::find()
                            ->where('scfct_suppcertformmembtmp_fk=:membtmp and scfct_bgivaldoccatmst_fk=:cat', [
                                ':membtmp'=>$formMemtmp->suppcertformmembtmp_pk,
                                ':cat'=>$category
                            ])->one();
                        $SupCatModel->scfct_submittedon=date('Y-m-d H:i:s');
                        $SupCatModel->scfct_submittedby=$userpk;
                        if(in_array($SupCatModel->scfct_status,[2,3])){
                            $SupCatModel->scfct_status=4;
                        }
                        else{
                            $SupCatModel->scfct_status=1; 
                        }
                        $SupCatModel->scfct_appdeclcomments = NULL;
                        if($SupCatModel->save(false)){
                            $suppcertForm=SuppcertformtrntmpTbl::find()
                                ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc and scftt_isdeleted=2', [
                                    ':cattbl'=>$SupCatModel->suppcertformcattmp_pk,
                                    ':formdesc'=>$formdesc
                                ])->one();
                            $suppcertForm->scftt_submittedon=date('Y-m-d H:i:s');
                            $suppcertForm->scftt_submittedby=$userpk;
                            $suppcertForm->scftt_appdeclcomments=NULL;
                            if(in_array($suppcertForm->scftt_status,[2,3])){
                                $suppcertForm->scftt_status=4;
                            }
                            else{
                                $suppcertForm->scftt_status=1; 
                            }
                            if($suppcertForm->save(false)){
                                $MemcompPrd=MemcompproddtlsTbl::findOne($valdt);
                                $MemcompPrd->mcprd_appdeclcomments=NULL;
                                $MemcompPrd->MCPrD_SVFAdminApprovalStatus=NULL;
                                $MemcompPrd->MCPrD_UpdatedOn=date('Y-m-d H:i:s');
                                $MemcompPrd->mcprd_updatedby=$userpk;
                                if($MemcompPrd->save(false)){
                                    $returnvar = 1;
                                    $busformdesc = $formpk == 1 ? 34 : 33 ;
                                    $businesssourcemodel = \common\models\MemcompprodbussrcmapTbl::find()
                                    ->where('mcpbsm_memcompproddtls_fk=:prdpk ',[':prdpk'=>$valdt])
                                    ->all();
                                    if(!empty($businesssourcemodel) && count($businesssourcemodel) > 0){
                                        $businesssourcepk = array_column($businesssourcemodel, 'mcpbsm_memcompbussrcdtls_fk');
                                        foreach ($businesssourcepk as $bkey => $bvalue) {
                                            $MemCombusMdl= MemcompbussrcdtlsTbl::findOne($bvalue);
                                            $isdeletebusinesssrc = \common\models\MemcompprodbussrcmapTblQuery::getbusinesssrctrakercnt($bvalue,$valdt,1);
                                            if(in_array($MemCombusMdl->mcbsd_scfadminstatus,['N','U','A','D']) && $isdeletebusinesssrc){
                                                $bussuppcertForm=SuppcertformtrntmpTbl::find()
                                                ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc and scftt_isdeleted=2', [
                                                    ':cattbl'=>$SupCatModel->suppcertformcattmp_pk,
                                                    ':formdesc'=>$busformdesc
                                                ])->one();
                                                $bussuppcertForm->scftt_submittedon=date('Y-m-d H:i:s');
                                                $bussuppcertForm->scftt_submittedby=$userpk;
                                                $bussuppcertForm->scftt_appdeclcomments=NULL;
                                                if(in_array($bussuppcertForm->scftt_status,[2,3])){
                                                    $bussuppcertForm->scftt_status=4;
                                                }
                                                else{
                                                    $bussuppcertForm->scftt_status=1; 
                                                }
                                                if($bussuppcertForm->save(false)){
                                                    $MemCombusMdl->mcbsd_scfadminstatus = NULL;
                                                    $MemCombusMdl->mcbsd_appdeclcomments = NULL;
                                                    $MemCombusMdl->mcbsd_updatedon = date('Y-m-d H:i:s');
                                                    $MemCombusMdl->mcbsd_updatedby = $userpk;
                                                    $MemCombusMdl->save(false);
                                                }                                                
                                            }
                                        }
                                    }
                                }                                
                            }
                        }
                    }
                }
            }else{
                $approvedprdcnt = MemcompproddtlsTbl::find()
                ->where('MCPrD_MemberCompMst_Fk=:company and  mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus ="A"',
                [':company'=>$companypk])
                ->count();
                $approvedservcnt = MemcompservicedtlsTbl::find()
                ->where('MCSvD_MemberCompMst_Fk=:company and  mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus ="A"',
                [':company'=>$companypk])
                ->count();
                $prdDel=MemcompservicedtlsTbl::find()
                ->where('MCSvD_MemberCompMst_Fk=:company and MemCompServDtls_Pk=:val and mcsvd_isdeleted = 2', 
                [':company'=>$companypk,':val'=>$valdt])->one();
                if(($approvedprdcnt == 1 || $approvedservcnt ==1) && $prdDel->MCSvD_SVFAdminApprovalStatus == 'A'){
                    $returnvar = 2;
                }else{
                    $formMemtmp=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company', [
                        ':formpk'=>$formpk,
                        ':company'=>$companypk
                    ])->one();
                    if(in_array($formMemtmp->scfmt_scfstatus,['D','OSD'])){
                        $formMemtmp->scfmt_scfstatus='DI';
                    }elseif($formMemtmp->scfmt_scfstatus == 'A'){
                        $formMemtmp->scfmt_scfstatus='UI';                        
                    }
                    $formMemtmp->scfmt_updatedon=date('Y-m-d H:i:s');
                    $formMemtmp->scfmt_updatedby=$userpk;
                    $formMemtmp->scfmt_formmst_fk=$formpk;
                    $formMemtmp->scfmt_membercompmst_fk=$companypk; 
                    if($formMemtmp->save(false)){
                        $SupCatModel=SuppcertformcattmpTbl::find()
                            ->where('scfct_suppcertformmembtmp_fk=:membtmp and scfct_bgivaldoccatmst_fk=:cat', [
                                ':membtmp'=>$formMemtmp->suppcertformmembtmp_pk,
                                ':cat'=>$category
                            ])->one();
                        $SupCatModel->scfct_submittedon=date('Y-m-d H:i:s');
                        $SupCatModel->scfct_submittedby=$userpk;
                        $SupCatModel->scfct_appdeclcomments = NULL;
                        if(in_array($SupCatModel->scfct_status,[2,3])){
                            $SupCatModel->scfct_status=4;
                        }
                        else{
                            $SupCatModel->scfct_status=1; 
                        }
                        $SupCatModel->scfct_appdeclcomments = NULL;
                        if($SupCatModel->save(false)){
                            $suppcertForm=SuppcertformtrntmpTbl::find()
                                ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc and scftt_isdeleted=2', [
                                    ':cattbl'=>$SupCatModel->suppcertformcattmp_pk,
                                    ':formdesc'=>$formdesc
                                ])->one();
                            $suppcertForm->scftt_submittedon=date('Y-m-d H:i:s');
                            $suppcertForm->scftt_submittedby=$userpk;
                            if(in_array($suppcertForm->scftt_status,[2,3])){
                                $suppcertForm->scftt_status=4;
                            }
                            else{
                            $suppcertForm->scftt_status=1; 
                            }
                            $suppcertForm->scftt_appdeclcomments=NULL;
                            if($suppcertForm->save(false)){
                                $MemcompServ=MemcompservicedtlsTbl::findOne($valdt);
                                $MemcompServ->mcsvd_appdeclcomments=NULL;
                                $MemcompServ->MCSvD_SVFAdminApprovalStatus=NULL;
                                $MemcompServ->MCSvD_UpdatedOn=date('Y-m-d H:i:s');
                                $MemcompServ->mcsvd_updatedby=$userpk;
                                if($MemcompServ->save(false)){
                                    $returnvar = 1;
                                    $busformdesc = $formpk == 1 ? 34 : 33 ;
                                    $businesssourcemodel = \common\models\MemcompservbussrcmapTbl::find()
                                    ->where('mcsbsm_memcompservdtls_fk=:prdpk ',[':prdpk'=>$valdt])
                                    ->all();
                                    if(!empty($businesssourcemodel) && count($businesssourcemodel) > 0){
                                        $businesssourcepk = array_column($businesssourcemodel, 'mcsbsm_memcompbussrcdtls_fk');
                                        foreach ($businesssourcepk as $bkey => $bvalue){
                                            $MemCombusMdl= MemcompbussrcdtlsTbl::findOne($bvalue);
                                            $isdeletebusinesssrc = \common\models\MemcompprodbussrcmapTblQuery::getbusinesssrctrakercnt($bvalue,$valdt,2);
                                            if(in_array( $MemCombusMdl->mcbsd_scfadminstatus,['N','U','A','D']) && $isdeletebusinesssrc){
                                                $bussuppcertForm=SuppcertformtrntmpTbl::find()
                                                ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc and scftt_isdeleted=2', [
                                                    ':cattbl'=>$SupCatModel->suppcertformcattmp_pk,
                                                    ':formdesc'=>$busformdesc
                                                ])->one();
                                                $bussuppcertForm->scftt_submittedon=date('Y-m-d H:i:s');
                                                $bussuppcertForm->scftt_submittedby=$userpk;
                                                $bussuppcertForm->scftt_appdeclcomments=NULL;
                                                if(in_array($bussuppcertForm->scftt_status,[2,3])){
                                                    $bussuppcertForm->scftt_status=4;
                                                }
                                                else{
                                                    $bussuppcertForm->scftt_status=1; 
                                                }
                                                if($bussuppcertForm->save(false)){
                                                    $MemCombusMdl->mcbsd_scfadminstatus = NULL;
                                                    $MemCombusMdl->mcbsd_appdeclcomments = NULL;
                                                    $MemCombusMdl->mcbsd_updatedon = date('Y-m-d H:i:s');
                                                    $MemCombusMdl->mcbsd_updatedby = $userpk;
                                                    $MemCombusMdl->save(false);  
                                                }                                                                                          
                                            }
                                        }
                                     }
                                }                                
                            }
                        }
                    }
                }                
            }   
        }
        \common\components\Suppcertform::datainsertionsfmenu($companypk,$formpk);
        return $returnvar;
    }    
    public function actionRelationshiplist(){
        $returnrelationshiplist=BgivaldoccatparvaldtlsTbl::find()->select(['bvdcpvd_parametervalue','bgivaldoccatparvaldtls_pk'])->where('bvdcpvd_bgivaldoccatpardtls_fk=44')->asArray()->all();
        return $this->asJson($returnrelationshiplist);
    }    
    public function actionSavenonmandatory(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $subcategory=\common\components\Security::sanitizeInput($_REQUEST['subcat'],"number");
        if($subcategory == 10){
            $savesection=SuppcertformmembtmpTbl::savehseprocess($data);            
        }else{
            $savesection=SuppcertformmembtmpTbl::nonsaveprocess($data);
        }        
        return $this->asJson([
            'data' => $savesection,
            'msg' => 'S',
            'status' => 200,
        ]);
    }    
    public  function actionGetautocompletescf(){
        $AutoReturn=\common\models\MembercompanymstTbl::getautocompletedatas();
        return $this->asJson($AutoReturn);
    }
    public function actionDeletedisrelsh(){
        $pk=trim($_GET['pk']);
        $type=trim($_GET['type']);
        if($type==1){
            $DMdel=MemshareholdcompdisclTbl::findOne($pk);
            $DMdel->delete();
        }else if($type==2){
            $RelMdl=MemshareholdrelpdisclTbl::findOne($pk);
            $RelMdl->delete();
        }
    }
    public function actionGetclassificationlist(){
          $response['headcountlist'] = array_column(\api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg('ClM_HeadCount'),'ClM_HeadCount');
          $response['annualsaleslist'] =array_column(\api\modules\mst\models\MemsubscriptionmstTbl::getSubscriptionTblDtlsForReg('ClM_AnnualSales'),'ClM_AnnualSales');
        return $this->asJson($response);
    }
    public function actionUlinkreference(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
            $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        }
        $formdesc=\common\components\Security::sanitizeInput($_REQUEST['formdesc'],"number");
        $category=\common\components\Security::sanitizeInput($_REQUEST['category'],"number");
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $pk= \common\components\Security::decrypt($_GET['pk']);
        if(!empty($pk)){
            $formMemtmp=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company',
            [':formpk'=>$formpk,':company'=>$companypk])->one();
                if(in_array($formMemtmp->scfmt_scfstatus,['D','OSD'])){
                    $formMemtmp->scfmt_scfstatus='DI';
                    $formMemtmp->scfmt_submittedon=date('Y-m-d H:i:s');
                    $formMemtmp->scfmt_submittedby=$userpk;
                }elseif($formMemtmp->scfmt_scfstatus == 'A'){
	$formMemtmp->scfmt_scfstatus='UI';
	$formMemtmp->scfmt_submittedon=date('Y-m-d H:i:s');
	$formMemtmp->scfmt_submittedby=$userpk;
                }
                $formMemtmp->scfmt_formmst_fk=$formpk;
                $formMemtmp->scfmt_membercompmst_fk=$companypk; 
                if($formMemtmp->save(false)){
                    $SupCatModel=SuppcertformcattmpTbl::find()
                        ->where('scfct_suppcertformmembtmp_fk=:membtmp and scfct_bgivaldoccatmst_fk=:cat',
                            [':membtmp'=>$formMemtmp->suppcertformmembtmp_pk,':cat'=>$category])->one();
                    $SupCatModel->scfct_submittedon=date('Y-m-d H:i:s');
                    $SupCatModel->scfct_submittedby=$userpk;
                    if($SupCatModel->save(false)){
                        $suppcertForm=SuppcertformtrntmpTbl::find()
                        ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc',
                            [':cattbl'=>$SupCatModel->suppcertformcattmp_pk,':formdesc'=>$formdesc])
                        ->one();
                        $suppcertForm->scftt_submittedon=date('Y-m-d H:i:s');
                        $suppcertForm->scftt_submittedby=$userpk;
                         if($suppcertForm->save(false)){
                                $modelprt=SuppcertformpartrntmpTbl::findOne($pk);
                                if(!empty($modelprt)){
                                    if(in_array($modelprt->scfptt_scfstatus,[3,4,2])){
                                        $modelprt->scfptt_isdeleted=1;
                                            $modelprt->scfptt_updatedon=date('Y-m-d H:i:s');
                                            $modelprt->scfptt_updatedby=$userpk;
                                        $modelprt->save(false);
                                    }else{
                                        $modelprt->delete();
                                    }
                                    $returnbank=SuppcertformpartrntmpTbl::find()
                                    ->where('scfptt_membercompmst_fk=:company and scfptt_bgivaldocsubcatpardtls_fk=:sbcatpart and scfptt_isdeleted=2',
                                        [':company'=>$companypk,':sbcatpart'=>437])
                                    ->asArray()
                                    ->count();
                                    if($returnbank == 0){
                                        $yesornoopt=SuppcertformpartrntmpTbl::find()
                                        ->where('scfptt_membercompmst_fk=:company and scfptt_bgivaldocsubcatpardtls_fk=:sbcatpart and scfptt_isdeleted=2',
                                            [':company'=>$companypk,':sbcatpart'=>449])
                                        ->asArray()
                                        ->one();
                                        if(!empty($yesornoopt)){
                                            if(in_array($yesornoopt->scfptt_scfstatus,[3,4,2])){
                                                $yesornoopt->scfptt_isdeleted=1;
                                                $yesornoopt->scfptt_updatedon=date('Y-m-d H:i:s');
                                                $yesornoopt->scfptt_updatedby=$userpk;
                                                $yesornoopt->save(false);
                                            }else{
                                                $yesornomodel=SuppcertformpartrntmpTbl::findOne($yesornoopt['suppcertformpartrntmp_pk']);
                                                $yesornomodel->delete();
                                            }
                                            $subcattrcmodel = SuppcertformtrntmpTbl::find()
                                                    ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc and scftt_isdeleted=2',
                                                        [':cattbl'=>$SupCatModel->suppcertformcattmp_pk,':formdesc'=>$formdesc])->one();
                                                if(!empty($subcattrcmodel)){
                                                       $subcattrcmodel->scftt_isdeleted = 1;
                                                       $subcattrcmodel->save();                                                     
                                                }
                                        }
                                    }
                                }
                                \common\components\Suppcertform::datainsertionsfmenu($companypk,$formpk);
                         }
                    }
                }
        }        
        return ['status'=>200,'msg'=>'Deleted Successfully'];
    }
    public function actionGetlod(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $MNLOdData=MinistofmanpowerTbl::find()
            ->where('momp_membercompmst_fk=:company',[":company"=>$companypk])->one();

        $LODArr=[];
        $lastUpdatedOn = "-";
        if(!empty($MNLOdData)){
            $LODArr[0]['name']='Specialist';
            $LODArr[0]['expatriates']=$MNLOdData->momp_specialistexpats;
            $LODArr[0]['omanis']=$MNLOdData->momp_specialistomani;
            $specOmn=round(($MNLOdData->momp_specialistomani /$MNLOdData->momp_totalspecialist) * 100,2);
            $LODArr[0]['omanisation']=$specOmn==0?'-':($specOmn.' %');
            $LODArr[0]['total']=$MNLOdData->momp_totalspecialist;

            $LODArr[1]['name']='Technician';
            $LODArr[1]['expatriates']=$MNLOdData->momp_techexpats;
            $LODArr[1]['omanis']=$MNLOdData->momp_techomani;
            $Technician=round(($MNLOdData->momp_techomani /$MNLOdData->momp_totaltech) * 100,2);
            $LODArr[1]['omanisation']=$Technician==0?'-':($Technician.' %');
            $LODArr[1]['total']=$MNLOdData->momp_totaltech;

            $LODArr[2]['name']='Occupant';
            $LODArr[2]['expatriates']=$MNLOdData->momp_occupantexpat;
            $LODArr[2]['omanis']=$MNLOdData->momp_occupantomani;
            $Occupant=round(($MNLOdData->momp_occupantomani /$MNLOdData->momp_totaloccupant) * 100,2);
            $LODArr[2]['omanisation']=$Occupant==0?'-':($Occupant.' %');
            $LODArr[2]['total']=$MNLOdData->momp_totaloccupant;

            $LODArr[3]['name']='Skilled';
            $LODArr[3]['expatriates']=$MNLOdData->momp_skilledexpat;
            $LODArr[3]['omanis']=$MNLOdData->momp_skilledomani;
            $Skilled=round(($MNLOdData->momp_skilledomani /$MNLOdData->momp_totalskilled) * 100,2);
            $LODArr[3]['omanisation']=$Skilled==0?'-':($Skilled. ' %');
            $LODArr[3]['total']=$MNLOdData->momp_totalskilled;

            $LODArr[4]['name']='Low Skilled';
            $LODArr[4]['expatriates']=$MNLOdData->momp_lowskilledexpat;
            $LODArr[4]['omanis']=$MNLOdData->momp_lowskilledomani;
            $LSkilled=round(($MNLOdData->momp_lowskilledomani /$MNLOdData->momp_totallowskilled) * 100,2);
            $LODArr[4]['omanisation']=$LSkilled==0?'-':($LSkilled.' %');
            $LODArr[4]['total']=$MNLOdData->momp_totallowskilled;

            $LODArr[5]['name']='Total';
            $LODArr[5]['expatriates']=$MNLOdData->momp_totalexpat;
            $LODArr[5]['omanis']=$MNLOdData->momp_totalomani;
            $LODArr[5]['omanisation']=$MNLOdData->momp_omanisation. ' %';
            $LODArr[5]['total']=$MNLOdData->momp_totemployee;
            $lastUpdatedOn=!empty($MNLOdData->momp_createdon) ? date('d-m-Y', strtotime($MNLOdData->momp_createdon)) : "-";
        }        
        $crnumber=MembercompanymstTbl::findOne($companypk)->MCM_crnumber;
        $isdataava= !empty($MNLOdData) ? 2 :1;
        $FinalArrLod=['lod'=>$LODArr,'updatedon'=>$lastUpdatedOn,'crnumber'=>$crnumber,'isdata'=>$isdataava];
        return $this->asJson($FinalArrLod);
    }
    public function actionCorpsumlog(){
        $url= Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        $log_msg = 'Saved Corporate Summary.';
        $action = 1;
        \common\components\UserActivityLog::logUserActivity($action, $log_msg, $url,22);
    }
    public function actionMenulogdat(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $log_msg = 'Visited '.$data['menudata']['bvdcm_categoryname'].' page.';
        $url= Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        $action = 4;
        \common\components\UserActivityLog::logUserActivity($action, $log_msg, $url,22);
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $origin=\yii\db\ActiveRecord::getTokenData('MCM_Origin',true);

        $SCFWholeStatus=SuppcertformmembtmpTbl::find()
            ->where('scfmt_formmst_fk=2 and scfmt_membercompmst_fk=:company',[':company'=>$companypk])->one();
        $mandatorypks=$origin=="N"?'7,4,2,3,24,13':'7,4,2,3,24';
        
        if($SCFWholeStatus){
        $mandatorysql="SELECT scfct_bgivaldoccatmst_fk,bvdcm_categoryname,scfct_isapplicable,suppcertformcattmp_pk,
    count(distinct C.suppcertformtrntmp_pk) as filled, count(distinct E.bgivaldocsubcatmst_pk) as actual,
     (count(distinct E.bgivaldocsubcatmst_pk) -count(distinct C.suppcertformtrntmp_pk)) as rem   
FROM	bgivaldoccatmst_tbl as D
    join bgivaldocsubcatmst_tbl as E ON E.bvdscm_bgivaldoccatmst_fk = D.bgivaldoccatmst_pk and E.bvdscm_status = 'A'
    left join suppcertformcattmp_tbl as B ON D.bgivaldoccatmst_pk = B.scfct_bgivaldoccatmst_fk
	left join suppcertformtrntmp_tbl as C ON C.scftt_suppcertformcattmp_fk = B.suppcertformcattmp_pk
    left join suppcertformmembtmp_tbl as A on b.scfct_suppcertformmembtmp_fk = A.suppcertformmembtmp_pk
 where
    A.scfmt_formmst_fk = 2 and A.scfmt_membercompmst_fk = {$companypk}   and B.scfct_bgivaldoccatmst_fk in ($mandatorypks) 
   and bvdcm_status='A'
GROUP By bgivaldoccatmst_pk
order by  scfct_bgivaldoccatmst_fk desc";

        $nonmandatorysql="SELECT scfct_isapplicable,bvdcm_categoryname,suppcertformcattmp_pk,scfct_bgivaldoccatmst_fk 
FROM `suppcertformcattmp_tbl` LEFT JOIN bgivaldoccatmst_tbl on bgivaldoccatmst_pk=scfct_bgivaldoccatmst_fk 
WHERE `scfct_suppcertformmembtmp_fk` = {$SCFWholeStatus->suppcertformmembtmp_pk} AND `scfct_bgivaldoccatmst_fk` not in ($mandatorypks)";

//        $nonmandatorysql="SELECT scfct_bgivaldoccatmst_fk,bvdcm_categoryname,scfct_isapplicable,suppcertformcattmp_pk,
//    count(distinct C.suppcertformtrntmp_pk) as filled, count(distinct E.bgivaldocsubcatmst_pk) as actual,
//     (count(distinct E.bgivaldocsubcatmst_pk) -count(distinct C.suppcertformtrntmp_pk)) as rem
//FROM	bgivaldoccatmst_tbl as D
//    join bgivaldocsubcatmst_tbl as E ON E.bvdscm_bgivaldoccatmst_fk = D.bgivaldoccatmst_pk and E.bvdscm_status = 'A'
//    left join suppcertformcattmp_tbl as B ON D.bgivaldoccatmst_pk = B.scfct_bgivaldoccatmst_fk
//	left join suppcertformtrntmp_tbl as C ON C.scftt_suppcertformcattmp_fk = B.suppcertformcattmp_pk
//    left join suppcertformmembtmp_tbl as A on b.scfct_suppcertformmembtmp_fk = A.suppcertformmembtmp_pk
// where
//    A.scfmt_formmst_fk = 2 and A.scfmt_membercompmst_fk = {$companypk}   and B.scfct_bgivaldoccatmst_fk not in ($mandatorypks)
//   and scfct_isapplicable <>2 and bvdcm_status='A'
//GROUP By bgivaldoccatmst_pk
//order by  scfct_bgivaldoccatmst_fk desc";
            $MAndatoryRunQuery=Yii::$app->db->createCommand($mandatorysql)->queryAll();
        $NonMAndatoryRunQuery=Yii::$app->db->createCommand($nonmandatorysql)->queryAll();             
         }
        $nullcheck= in_array(null,array_column($NonMAndatoryRunQuery,'scfct_isapplicable'));
        $manipulationdata=!empty($MAndatoryRunQuery)?array_sum(array_values(array_column($MAndatoryRunQuery,'rem'))):0;
        $Nonmanipulationdata=!empty($NonMAndatoryRunQuery)?array_sum(array_values(array_column($NonMAndatoryRunQuery,'rem'))):0;
        $submitButtonReturn=($manipulationdata ==0 || $manipulationdata >0 || $nullcheck || $NonMAndatoryRunQuery<5 )?true:false;

        return $this->asJson($submitButtonReturn);

    }
    public function actionLogdata()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $url= Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;

        if($data['logtype']==2){
            $log_msg = 'Deleted '.$data['logname'];
            $action = 3;
            \common\components\UserActivityLog::logUserActivity($action, $log_msg, $url,22);
        }

        if($data['logtype']==1){
            $log_msg = 'Uploaded '.$data['logname'];
            $action = 1;
            \common\components\UserActivityLog::logUserActivity($action, $log_msg, $url,22);
        }
    }
    public function actionLogmsgdata()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $url= Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;

        if($data['logtype']==3){
            $action = 3;
            \common\components\UserActivityLog::logUserActivity($action, $data['logmsg'], $url,22);
        }

        if($data['logtype']==2){
            $action = 2;
            \common\components\UserActivityLog::logUserActivity($action, $data['logmsg'], $url,22);
        }

        if($data['logtype']==1){
            $action = 1;
            \common\components\UserActivityLog::logUserActivity($action, $data['logmsg'], $url,22);
        }
    }

    public function actionWilyatdata(){
        $MapWilyatData=WalivlgblockmapTbl::listofWilayatbasedOntype();
        return $this->asJson($MapWilyatData);
    }
    const SPECIAl_STATUS=10;
    public function actionRabtsupdashboard(){
        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        $formid=$_REQUEST['formid'];
        $origin=\yii\db\ActiveRecord::getTokenData('MCM_Origin',true);
       $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
//        echo "<pre>";
//        print_r($company_id);
//        exit;
        $encrptypk = base64_encode($company_id);
        $trackerBlock=BgivaldoccatmstTbl::gettrackerdatacount();
        $specialStatus=MemcompownersdtlTbl::getspecialstatuscount(self::SPECIAl_STATUS);
        
        // $categoryWiseTracker=BgivaldoccatmstTbl::scftracker();
        $categoryWiseTracker=BgivaldoccatmstTbl::scftrackerdetails($categoryWiseTracker);
        $categorywiseTrakerstatus = BgivaldoccatmstTbl::scftrackercnt($categoryWiseTracker);
        //$returndata = \common\models\MemcompsitevisithstyTblQuery::getsitevisitstatustracker($compk);
        $productInsight=Products::insight(1);
        $serviceInsight=Products::insight(2);
        $memregvalsub = \common\models\MembercompanymstTbl::find()
            ->select(['MRM_ValSubStatus','mcm_accexpirydate','MCM_MemberRegMst_Fk','DATEDIFF(mcm_accexpirydate,DATE_ADD(NOW(), INTERVAL -1 DAY)) as days'])
            ->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
            ->where("MemberCompMst_Pk=:company",[':company'=>$company_id])->asArray()->one();
        $scfcertgent = \common\models\SuppcertformmembdtlsTbl::find()
            ->where('scfmd_membercompmst_fk=:company',
                [':company'=>$company_id])->asArray()->one();
        
        $scfStatusMdl=SuppcertformmembtmpTbl::find()
            ->select(['case WHEN `scfmt_scfstatus`="I" then "In-Progress"
              WHEN `scfmt_scfstatus`="A" then "Approved"   
              WHEN `scfmt_scfstatus`="D" then "Declined"  
              WHEN `scfmt_scfstatus`="RS" then "Resubmitted for validation"  
              WHEN `scfmt_scfstatus`="U" then "Updated"
              WHEN `scfmt_scfstatus`="UI" then "Update-Inprogess"
              WHEN `scfmt_scfstatus`="DI" then "Declined-Inprogess" 
              WHEN `scfmt_scfstatus`="S" then "Posted for validation" ELSE "" END as scfstatus,
              scfmt_certgenerated,scfmt_scfstatus,DATE_FORMAT(scfmt_updatedon,"%d-%m-%Y") as updated,
              DATE_FORMAT(scfmt_appdeclon,"%d-%m-%Y") as declined,concat_ws(" ",decby.um_firstname, decby.um_middlename, decby.um_lastname) as declinebyname,
              DATE_FORMAT(scfmt_submittedon,"%d-%m-%Y") as submitted,
              concat_ws(" ",upby.um_firstname, upby.um_middlename, upby.um_lastname) as updatedbyname,
              concat_ws(" ",subby.um_firstname, subby.um_middlename, subby.um_lastname) as submittedbyname'])
              
            ->leftJoin('usermst_tbl decby','decby.Usermst_Pk = scfmt_appdeclby')    
            ->leftJoin('usermst_tbl upby','upby.UserMst_Pk = scfmt_updatedby')
            ->leftJoin('usermst_tbl subby','subby.UserMst_Pk = scfmt_submittedby') 
//            ->leftJoin('usermst_tbl siterejon','siterejon.UserMst_Pk = mcsv_decrejon') 
            ->where('scfmt_formmst_fk=:formid and scfmt_membercompmst_fk=:company',[':company'=>$company_id,':formid'=>$formid])->asArray()->one();
        $onofflinestatus = 2;
        
        $spc=!empty($memregvalsub['MRM_ValSubStatus']) && $memregvalsub['MRM_ValSubStatus'] == 'A' ? TRUE :FALSE;
        
        $icn= \common\models\SuppcertformauditlogTbl::find()->where('scfal_membercompmst_fk = :companypk', [':companypk' => $company_id])->exists();
        
        $memcompinvoicedtlstbl = \common\models\MemcompinvoicedtlsTbl::find()  
            ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = mcid_membercompmst_fk')
            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk' )    
            ->leftJoin('memcomppymtinfodtls_tbl', 'mcpid_memcompinvoicedtls_fk = memcompinvoicedtls_pk and mcid_membercompmst_fk = mcpid_membercompmst_fk')
            ->where("MemberCompMst_Pk=:compk and mcid_module = 2 and mcpid_pymtstatus = 1 and MRM_MemberStatus = 'A' and MRM_RenewalStatus ='RW'",[':compk'=>$company_id]) 
            ->orderBy('memcompinvoicedtls_pk desc')
            ->groupBy('MemberCompMst_Pk,memcompinvoicedtls_pk')
            ->exists(); // For payment approved from backend
        $regencrptypk = base64_encode($memregvalsub['MCM_MemberRegMst_Fk']);
        $isExpired = 2; // not expired
        $currentdate = date('Y-m-d');
        if(!empty($memregvalsub['mcm_accexpirydate']) && $memregvalsub['mcm_accexpirydate'] < $currentdate){
            $isExpired = 1; // expired
        }       
        if($spc){
            $showcert = 1;//After approved the certificate dont show the dummy certificte even after it is decline
        } else{
            $showcert = 2;//
        }  
         if($icn){
            $showicn = 1;//After approved the certificate dont show the dummy certificte even after it is decline
        } else{
            $showicn = 2;//
        } 
        
     
         
        $productsercnt =  \Yii::$app->db->createCommand("call sp_prodserv_dashboard_count(:p1)")
            ->bindValue(':p1' , $company_id)
            ->queryAll();
        
        
        $formstatusarr = ['A'=>"Approved",'D'=>"Declined",'U'=>"Updated",'RS'=>"Resubmitted for validation",'S'=>"Posted for validation",'DI'=>"Decline-Inprogess"];
        $formstatuscolorarr = ['A'=>"scfsts-approved",'D'=>"scfsts-declined",'RS'=>"scfsts-resubmitted",'U'=>"scfsts-updated",'S'=>"scfsts-inprogress",'DI'=>'scfsts-declined'];
        if(!empty($scfStatusMdl) && !empty($scfStatusMdl['scfmt_scfstatus'])){
            $formstatus = $formstatusarr[$scfStatusMdl['scfmt_scfstatus']];
            $formstatusclass = $formstatuscolorarr[$scfStatusMdl['scfmt_scfstatus']];
        }
        if(!empty($scfStatusMdl) && $scfStatusMdl['scfmt_scfstatus'] != null ){
            $showviewdet = false;
        }else{
            $showviewdet = true;
        }        
        $rewpaymensucess = 2;//already submitted
        if($memcompinvoicedtlstbl && !empty($scfStatusMdl) && !in_array($scfStatusMdl['scfmt_scfstatus'],['RS','U','DI'])){
            $rewpaymensucess = 1;//paid the certification fee for renewal submit SCF Form
        }
        $jsrscertificatearray = [];
        $jsrscertificate = \common\components\Suppcertform::getsuppliercertificate($company_id);
        $jsrscertificatearray[0]['imagepath'] = $jsrscertificate; 
        $cumulativeArr=[
            'scftracker'=>$trackerBlock,
            'additionalcert'=>$specialStatus,
            //'categorytracker'=>$categoryWiseTracker,
            'productinsight'=>$productInsight,
            'serviceinsight'=>$serviceInsight,
            'categoryWiseTrackersp'=>$categoryWiseTracker,
//            'rejectedon'=>(!empty($scfStatusMdl) && !empty($scfStatusMdl['mcsv_decrejon'])) ? date('d-m-Y',strtotime($scfStatusMdl['mcsv_decrejon'])) : "-",
            'scfformstatus'=>$scfStatusMdl['scfstatus'],
            'scfformstatusval'=>!empty($scfStatusMdl['scfmt_scfstatus']) ? $scfStatusMdl['scfmt_scfstatus'] : "I",
            'scfformstatusapp'=>!empty($scfStatusMdl['scfmt_scfstatus']) ? $scfStatusMdl['scfmt_scfstatus'] : "A",
            'scfformsstaussub'=>!empty($scfStatusMdl['scfmt_scfstatus']) ? $scfStatusMdl['scfmt_scfstatus'] : "S",
            'categorywiseTrakerstatus'=>$categorywiseTrakerstatus,
            'showcert'=>$showcert,
            'Lastupdateon'=>(!empty($scfStatusMdl['updated'])? $scfStatusMdl['updated'] :  $scfStatusMdl['submitted']),
            'Lastupdateby'=>(!empty($scfStatusMdl['updatedbyname'])? ($scfStatusMdl['updatedbyname']) :  ($scfStatusMdl['submittedbyname'])),
            'sitesubmittedby'=>(!empty($scfStatusMdl['siteupdatebynames'])? ($scfStatusMdl['siteupdatebynames']) :  ($scfStatusMdl['submittedbyname'])),
            'declineOn'=>($scfStatusMdl['declined']),
            'showviewdet'=>$showviewdet,
            'generated'=>$scfStatusMdl['scfmt_certgenerated']==1?false:true,
            'expirydateshow'=>$memregvalsub['days'],
            'jsrscertificate'=>$jsrscertificate,
            'jsrscertificatearray'=>$jsrscertificatearray,
            'validtill'=>!empty($memregvalsub['mcm_accexpirydate']) ? date('d-m-Y',strtotime($memregvalsub['mcm_accexpirydate'])) : "-",
            'approvedon' => (!empty($scfcertgent['scfmd_approvedon']) ? date('d-m-Y',strtotime($scfcertgent['scfmd_approvedon'])) : "-"), 
            'jsrsebadge'=> \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getjsrsebadge?id=']).$regencrptypk,
            'downloadjsrscertificate'=>\Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getjsrscertificate?id=']).$encrptypk,
            'viewjsrscertificate'=>\Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getviewjsrscertificate?id=']).$encrptypk,
            'productsercnt'=>$productsercnt,
            'sitevisiststs'=>$sitevisiststs,
            'isExpired'=>$isExpired,
            'rewpaymensucess'=>$rewpaymensucess,
            'sitevisiststsclass'=>$sitevisiststsclass,
            'formstatusclass'=>$formstatusclass,
            'certstatus'=>$certstatus,
            'memregvalsub'=>$memregvalsub['MRM_ValSubStatus'],
            'onofflinestatus'=>$onofflinestatus,
            'showicn'=>$showicn,
        ];
        return $this->asJson($cumulativeArr);
    }   
    public function actionSaveswitch(){
        if(isset($_REQUEST['category'])){
            // check first suppcertformmembtmp_tbl
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $category=$_REQUEST['category'];
            $status=!isset($_REQUEST['status'])?null:$_REQUEST['status'];
            $suppcertmemtbl=SuppcertformmembtmpTbl::find()
                ->where('scfmt_membercompmst_fk=:company and scfmt_formmst_fk=:form',[':form'=>2,':company'=>$companypk])->one();
            if(empty($suppcertmemtbl)){
                $suppcertmemtbl=new SuppcertformmembtmpTbl();
                $suppcertmemtbl->scfmt_formmst_fk=2;
                $suppcertmemtbl->scfmt_membercompmst_fk=$companypk;
                $suppcertmemtbl->scfmt_scfstatus='I';
                $suppcertmemtbl->scfmt_submittedon=date('Y-m-d H:i:s');
                $suppcertmemtbl->scfmt_submittedby=$userpk;
                if($suppcertmemtbl->save(false)){
                    $this->saveCategory($suppcertmemtbl);
                }
            }else{
                if(in_array($suppcertmemtbl->scfmt_scfstatus,['D','OSD'])){
                    $suppcertmemtbl->scfmt_scfstatus='DI';
                    $suppcertmemtbl->scfmt_submittedon=date('Y-m-d H:i:s');
                    $suppcertmemtbl->scfmt_submittedby=$userpk;
                    $suppcertmemtbl->save(false);
                }elseif($suppcertmemtbl->scfmt_scfstatus == 'A'){
	$suppcertmemtbl->scfmt_scfstatus='UI';
	$suppcertmemtbl->scfmt_submittedon=date('Y-m-d H:i:s');
	$suppcertmemtbl->scfmt_submittedby=$userpk;
                }
                $SuppCatModel=SuppcertformcattmpTbl::find()
                    ->where('scfct_bgivaldoccatmst_fk=:category and scfct_suppcertformmembtmp_fk=:membertbl',
                        [':category'=>$category,':membertbl'=>$suppcertmemtbl->suppcertformmembtmp_pk])->one();
                if(empty($SuppCatModel)){
                    $this->saveCategory($suppcertmemtbl);
                }else{
                    $SuppCatModel->scfct_isapplicable=$status;
                    $SuppCatModel->scfct_submittedon=date('Y-m-d H:i:s');
                    $SuppCatModel->save(false);
                }
            }
        }
        return $this->asJson(['status'=>200]);
    }    
    public function actionDeletecheckprdservice(){
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $scfWholeStatus=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk=:company',
            [':form'=>2,':company'=>$companypk])->one();

        $SupFormParttmpMdl=SuppcertformpartrntmpTbl::find()
            ->where('scfptt_bgivaldoccatmst_fk=:cat and scfptt_bgivaldocsubcatmst_fk in(114,115) and
             scfptt_membercompmst_fk=:company and scfptt_bgivaldocsubcatpardtls_fk in(405,406) and scfptt_scfstatus=3',
                [':cat'=>4,':company'=>$companypk])->asArray()->all();

        $resDelete=($scfWholeStatus->scfmt_scfstatus =='A' &&  count($SupFormParttmpMdl)==1)?false:true;

        return $this->asJson($resDelete);
    }
    Const StatusArr=["I" => "In-progress","A"=>"Approved","D"=>"Declined","RS"=>"Resubmitted",
        "R"=>"Reopened","U"=>"Updated","DI"=>"Declined In Progress",
        "OSD" => "Overall VB Declined","OVD"=>"Overall SVF Decline",
        "S"=>"Submitted","F"=>"Filled","C"=>"Created", "N"=>"New","M"=>"Mapped"];
    public function actionHistoryscf(){
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $formdesc=\common\components\Security::sanitizeInput($_REQUEST['formdesc'],"number");

        // call sp_scf_activity_tracker(6,134)
        $resultOfHistory = \Yii::$app->db->createCommand("call sp_scf_activity_tracker(:p1,:p2)")
            ->bindValue(':p1' , $companypk )
            ->bindValue(':p2' , $formdesc)
            ->queryAll();

        $FormDesc=BgivaldocformdescmstTbl::find()->select(['bvdfdm_bgivaldoccatmst_fk','bvdfdm_bgivaldocsubcatmst_fk','bvdscm_subcategoryname'])
            ->leftJoin(BgivaldocsubcatmstTbl::tableName(),'bvdfdm_bgivaldocsubcatmst_fk=bgivaldocsubcatmst_pk')
            ->where('bgivaldocformdescmst_pk=:pk',[':pk'=>$formdesc])->asArray()->one();
        if(!empty($resultOfHistory)){
            $HistoryArr=[];
            $HistoryArr['history_head']=$FormDesc['bvdscm_subcategoryname'];
            $HistoryArr['history_catid']=$FormDesc['bvdfdm_bgivaldoccatmst_fk'];
            $HistoryArr['history_subcatid']=$FormDesc['bvdfdm_bgivaldocsubcatmst_fk'];
            foreach ($resultOfHistory as $key =>$val){
                $HistoryArr['history'][$key]['scf_id']=$val['scf_id'];
                $HistoryArr['history'][$key]['scf_status']=self::StatusArr[$val['scf_status']];
                $HistoryArr['history'][$key]['flag']=$val['scf_status'];
                $HistoryArr['history'][$key]['scf_date']=$val['scf_date'];
                $HistoryArr['history'][$key]['user_pk']=$val['user_pk'];
                $HistoryArr['history'][$key]['user_name']=$val['user_name'];
                $HistoryArr['history'][$key]['scf_appdec_date']=$val['scf_appdec_date'];
                $HistoryArr['history'][$key]['appdec_user_pk']=$val['appdec_user_pk'];
                $HistoryArr['history'][$key]['appdec_user_name']=$val['appdec_user_name'];
                $HistoryArr['history'][$key]['scf_appdec_comments']=$val['scf_appdec_comments'];
            }
            $countHistory=count($HistoryArr['history']);
            $lastdataisDeclined= $HistoryArr['history'][$countHistory-1]['scf_status'] =="Declined"?true:false;
            $HistoryArr['history_resubmit']=$lastdataisDeclined;
        }
        return $this->asJson($HistoryArr);
    }
    public function actionPrdservicehistory(){
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $type=\common\components\Security::sanitizeInput($_REQUEST['type'],"number");
        $subcatprtdtlspk=\common\components\Security::sanitizeInput($_REQUEST['spartdtlpk'],"number");
        $Itempk=\common\components\Security::sanitizeInput($_REQUEST['itempk'],"number");

        // call sp_prodserv_activity_tracker(2,1,405,1338)
        // 2,1,405,1338
        $subcatprtdtlspk=$type==1?405:406;
        $resultOfHistory = \Yii::$app->db->createCommand("call sp_prodserv_activity_tracker(:p1,:p2,:p3,:p4)")
            ->bindValue(':p1' , $companypk )
            ->bindValue(':p2' , $type)
            ->bindValue(':p3' , $subcatprtdtlspk)
            ->bindValue(':p4' , $Itempk)
            ->queryAll();
     // echo "<pre>";print_r($resultOfHistory);die;
        if(!empty($resultOfHistory)){
            $HistoryArr=[];
            if($type==1){
                $PrdMdl=MemcompproddtlsTbl::findOne($Itempk);
                $HistoryArr['name']=$PrdMdl->MCPrD_DisplayName;
                $HistoryArr['code']=$PrdMdl->mcprd_prodrefno;
            }else{
                $SrMdl=MemcompservicedtlsTbl::findOne($Itempk);
                $HistoryArr['name']=$SrMdl->MCSvD_DisplayName;
                $HistoryArr['code']=$SrMdl->mcsvd_servrefno;
            }
            foreach ($resultOfHistory as $key =>$val){
                $HistoryArr['history'][$key]['status']=self::StatusArr[$val['scf_status']];
                $HistoryArr['history'][$key]['flag']=$val['scf_status'];
                $HistoryArr['history'][$key]['statuslabel']=self::StatusArr[$val['scf_status']]." On";
                $HistoryArr['history'][$key]['date']=$val['scf_date'];
                $HistoryArr['history'][$key]['by']=$val['user_pk'];
                $HistoryArr['history'][$key]['byname']=$val['user_name'];
                $HistoryArr['history'][$key]['apdecdate']=$val['scf_appdec_date'];
                $HistoryArr['history'][$key]['apdecby']=$val['appdec_user_pk'];
                $HistoryArr['history'][$key]['apdecbyname']=$val['appdec_user_name'];
                $HistoryArr['history'][$key]['comments']=$val['scf_appdec_comments'];
            }
        }
        return $this->asJson($HistoryArr);
    }        
    public function actionGetfinacsampletemp(){
        $response['bankletterLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getsampletempfinlink?id=1']);
        $response['annualturnoverLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getsampletempfinlink?id=2']);
        $response['cmlccLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getsampletempfinlink?id=3']);
        $response['duqumLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getsampletempfinlink?id=4']);
        $response['ocominLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getsampletempfinlink?id=5']);
        $response['pdoLink'] = \Yii::$app->urlManager->createAbsoluteUrl(['/al/afterlogin/getsampletempfinlink?id=6']);
          return $response;
    }
        public function actionGetmapscfproductlist() {
            $result = [];
            if(!empty($_REQUEST['prodmapid']) && $_REQUEST['prodmapid'] != "undefined") {
                $data_id = \common\components\Security::decrypt($_REQUEST['prodmapid']);
                
                $result = MemcompprodmstmapTblQuery::getMapScfProductlist($data_id);
            }

            return $this->asJson(['datasets'=> $result]);
        }

        public function actionDelinkprodmap(){
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $data['dataPk'] = \common\components\Security::decrypt($data['dataPk']);
            $savesection=MemcompprodmstmapTblQuery::deLinkProdMap($data);

            return $this->asJson([
                'data' => $savesection,
                'msg' => 'S',
                'status' => 200,
            ]);
        }

        public function actionExportmultiprodnservmap(){
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $data['dataPk'] = \common\components\Security::decrypt($data['dataPk']);
            if($data['type'] == 1) {
                $savesection=MemcompprodmstmapTblQuery::exportProdMap($data);
            } else {
                $savesection=MemcompservmstmapTblQuery::exportServMap($data);
            }

            return $this->asJson($savesection);
        }

        public function actionDelinkprodserv(){
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $data['dataPk'] = \common\components\Security::decrypt($data['dataPk']);
            if($data['type'] == 1) {
                $savesection=MemcompproddtlsTbl::deLinkProd($data['dataPk']);
            } else {
                $savesection=MemcompservicedtlsTbl::deLinkServ($data['dataPk']);
            }

            return $this->asJson($savesection);
        }
        public function actionGetmapscfservicelist() {
            $result = [];
            if(!empty($_REQUEST['servmapid']) && $_REQUEST['servmapid'] != "undefined") {
                $data_id = \common\components\Security::decrypt($_REQUEST['servmapid']);
                
                $result = MemcompservmstmapTblQuery::getMapScfServicelist($data_id);
            }

            return $this->asJson(['datasets'=> $result]);
        }

        public function actionDelinkservicemap(){
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $data['dataPk'] = \common\components\Security::decrypt($data['dataPk']);
            $savesection=MemcompservmstmapTblQuery::deLinkServiceMap($data);
            
            return $this->asJson([
                'data' => $savesection,
                'msg' => 'S',
                'status' => 200,
            ]);
        }
        public function actionGeneratecertify(){
            $compk = $_REQUEST['compk'];
            $formid = $_REQUEST['formid']; 
             $ghg = \common\components\Suppcertform::generatecertificate($compk,$formid);
        }
        public function actionViewjsrscetify()
    {
        $dscode = $_REQUEST['scode'];
        $scode = \common\components\Security::base64_decrypt_str($dscode, 'BGIINDIA');
        $membercompanyDtls = \api\modules\mst\models\MembercompanymstTbl::find()
         ->leftJoin('Memberregistrationmst_tbl', 'MCM_Memberregmst_Fk = MemberRegMst_Pk')
        ->andWhere('MCM_SupplierCode=:scode and MRM_MemberStatus !="I"',array(':scode' =>  $scode))->one();
        $cerfyDtls= \common\models\T2ecertitrackingTbl::find()
        ->andWhere('tct_membercompmst_fk=:comppk',array(':comppk' =>  $membercompanyDtls->MemberCompMst_Pk ))
        ->orderBy('t2ecertitracking_pk DESC')
        ->asArray()->one();
        if (count($membercompanyDtls) > 0) {
            $record = $membercompanyDtls;
//            $Expiry = $membercompanyDtls->mcm_accexpirydate;
//            $Expiry = VAcchst::model()->find("MCAAH_MemberRegMst_Fk=:regpk",array(':regpk'=>$membercompanyDtls->MCM_MemberRegMst_Fk));
            $path = dirname(__FILE__)."/../../backend/jsrscertificate/";
            $expirydate = $membercompanyDtls->mcm_accexpirydate;
            $expDate=new DateTime($expirydate);
            $today = new DateTime('now');
            $expirstate=date_diff($today,$expDate);
            if($expirstate->format("%R%a")<0) {
                $returndata['status'] = 'Expired';
                $returndata['color'] = 'red';
            } else {
                $returndata['status'] = 'Active';
                $returndata['color'] = 'green';
            }
            if($record->MCM_Origin=='N')
            {
                if (\common\models\MemcomplcccerthdrTblQuery::isLccCertificateIssued($record)) {
                    $lccStatusval= \common\models\MemcomplcccerthdrTblQuery::getLccStatus($record);
                }else{
                    $lccStatusval="Nil";
                }
                $MemCompgendDtls= \common\models\MemcompgendtlsTbl::find()->where('MemberCompMst_Fk=:companypk', [':companypk' => $record->MemberCompMst_Pk])->one();            
                $classfyarra = ['SM'=>'MSME - Micro','SS'=>'MSME - Small','MS'=>'MSME - Medium','L'=>'Large','VL'=>'Very Large'];
                $Classfication= $classfyarra[$MemCompgendDtls->MCGD_Classification]; 
            }else{
                $lccStatusval="Not Applicable";
                $Classfication="Not Applicable";
            }            
           
            if(count($record->memcompproddtlsTbls) > 0 && count($record->memcompservicedtlsTbls) > 0){
                $title = 'View Product & Service';
            }elseif(count($record->memcompproddtlsTbls) > 0 ){            
                $title = 'View Product';
            }elseif(count($record->memcompservicedtlsTbls) > 0 ){
                $title = 'View Service';
            }else{
                 $title = 'View Products';
            }
            $returndata['jsrsregno'] = $record->mcm_RegistrationNo;
            $returndata['suppliercode'] = $record->MCM_SupplierCode;
            $returndata['crno'] = $record->MCM_crnumber;
            $returndata['crexpiry'] = date('d-m-Y',strtotime($record->MCM_RegistrationExpiry)); 
            $returndata['registereddate'] =  date('d-m-Y',  strtotime($record->mCMMemberRegMstFk->mrm_approvedon)); 
            $returndata['issedon'] =  empty($cerfyDtls->tct_issuedon)?'Nil':date('d-m-Y',  strtotime($cerfyDtls->tct_issuedon));
            $returndata['validtill'] =  date('d-m-Y',  strtotime($expirydate)); 
            $returndata['jsrsstatus'] =  $returndata['status'];
            $returndata['classification'] =  $Classfication;
            $returndata['lccStatusval'] =  $lccStatusval;
            $returndata['certificate'] =  $path.$cerfyDtls->tct_crtfilepath;
            $returndata['title'] =  $title;
            $returndata['companyname'] =  $record->MCM_CompanyName;
            $returndata['Unknown User']=0;
        } else {
            $returndata['Unknown User']=1;
        }
         $cumlativeArr=['cetifydet'=>$returndata];
        return $this->asJson($cumlativeArr);
    }
        public function actionViewjsrspands()
    {
        $dscode = $_REQUEST['scode'];
        $scode = \common\components\Security::base64_decrypt_str($dscode, 'BGIINDIA');
        $membercompanyDtls = \api\modules\mst\models\MembercompanymstTbl::find()
         ->leftJoin('Memberregistrationmst_tbl', 'MCM_Memberregmst_Fk = MemberRegMst_Pk')
        ->andWhere('MCM_SupplierCode=:scode and MRM_MemberStatus !="I"',array(':scode' =>  $scode))->one();
        $productdetails = [];
        $servicesdetails = [];
        $productservarray = [];
        $compdet = [];
        if (count($membercompanyDtls) > 0) {
            $compdet['companyname'] = $membercompanyDtls->MCM_CompanyName;
            $compdet['suppliercode'] = $membercompanyDtls->MCM_SupplierCode;
            $prddet = \common\models\MemcompprodbussrcmapTbl::find()->select(['PrdM_ProductCode as code','PrdM_ProductName as name',
                'GROUP_CONCAT(bsm_bussrcname) as bstype', 'CASE WHEN (`MCPrD_CreatedOn` is null or `MCPrD_SVFAdminApprovalStatus` is null) THEN "Not Applied" WHEN `MCPrD_SVFAdminApprovalStatus`="N" THEN "New" WHEN `MCPrD_SVFAdminApprovalStatus`="A" THEN "JSRS Approved" WHEN `MCPrD_SVFAdminApprovalStatus`="D" THEN "Declined" END as status'])
                    ->leftJoin('memcompproddtls_tbl', 'MemCompProdDtls_Pk = mcpbsm_memcompproddtls_fk')
                    ->leftJoin('productmst_tbl', 'MCPrD_ProductMst_Fk = productmst_pk')
                    ->leftJoin(\common\models\MemcompbussrcdtlsTbl::tableName(), 'mcpbsm_memcompbussrcdtls_fk=memcompbussrcdtls_pk')
                    ->leftJoin(\common\models\BusinesssourcemstTbl::tableName(), 'businesssourcemst_pk = mcbsd_businesssourcemst_fk')
                    ->Where(['is not', 'MCPrD_CreatedOn', null])
                    ->andWhere(['=', 'MCPrD_MemberCompMst_Fk', $membercompanyDtls->MemberCompMst_Pk])
                    ->groupBy(['mcpbsm_memcompproddtls_fk'])
                    ->asArray()->all();
            if(count($prddet) > 0){
                foreach ($prddet as $key => $value) {
                    $productdetails[$key]['prodservcode'] = $value['code'];
                    $productdetails[$key]['prodservname'] = $value['name'];
                    $productdetails[$key]['prodservbusinesssrc'] = $value['bstype'];
                    $productdetails[$key]['prodservstatus'] =  $value['status'];
                    $productdetails[$key]['prodservtype'] =  "Product Code";
                }
            }
            $servdet = \common\models\MemcompservbussrcmapTbl::find()->select(['SrvM_ServiceCode as code', 'SrvM_ServiceName as name',
                'GROUP_CONCAT(bsm_bussrcname) as bstype','CASE WHEN (`MCSvD_CreatedOn` is null or `MCSvD_SVFAdminApprovalStatus` is null) THEN "Not Applied" WHEN `MCSvD_SVFAdminApprovalStatus`="N" THEN "New" WHEN `MCSvD_SVFAdminApprovalStatus`="A" THEN "JSRS Approved" WHEN `MCSvD_SVFAdminApprovalStatus`="D" THEN "Declined" END as status'])
                    ->leftJoin('memcompservicedtls_tbl', 'MemCompServDtls_Pk = mcsbsm_memcompservdtls_fk')
                    ->leftJoin('servicemst_tbl', 'MCSvD_ServiceMst_Fk = ServiceMst_Pk')
                    ->leftJoin(\common\models\MemcompbussrcdtlsTbl::tableName(), 'memcompbussrcdtls_pk=mcsbsm_memcompbussrcdtls_fk')
                    ->leftJoin(\common\models\BusinesssourcemstTbl::tableName(), 'businesssourcemst_pk = mcbsd_businesssourcemst_fk')
                    ->Where(['is not', 'MCSvD_CreatedOn', null])
                    ->andWhere(['=', 'MCSvD_MemberCompMst_Fk', $membercompanyDtls->MemberCompMst_Pk])
                    ->groupBy(['mcsbsm_memcompservdtls_fk'])
                    ->asArray()->all();
            if(count($servdet) > 0){
                foreach ($servdet as $key => $value) {
                    $servicesdetails[$key]['prodservcode'] = $value['code'];
                    $servicesdetails[$key]['prodservname'] = $value['name'];
                    $servicesdetails[$key]['prodservbusinesssrc'] = $value['bstype'];
                    $servicesdetails[$key]['prodservstatus'] =  $value['status'];
                    $servicesdetails[$key]['prodservtype'] =  "Service Code";
                }
            }
            if(count($productdetails) > 0 && count($servicesdetails) >0 ){
                   $productservarray = array_merge($productdetails,$servicesdetails);
//                   $productservarray = array_map("unserialize", array_unique(array_map("serialize", $prdserdet)));
            }elseif(count($productdetails) > 0 && count($servicesdetails)  ==0){
                $productservarray = $productdetails;
            }elseif(count($productdetails) == 0 && count($servicesdetails)  >0){
                $productservarray = $servicesdetails;
            }else{
                $productservarray = [];
            }            
        } 
        $cumlativeArr=['productservarray'=>$productservarray,'compdet'=>$compdet];
        return $this->asJson($cumlativeArr);
    }
    public function actionGetprimaryformsts(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
                 $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
//           $companypk = $_REQUEST['compid'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        }        
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $SuppMemtbl=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company',
                [':company'=>$companypk,':formpk'=>$formpk])->one();
        $returndatacertdata=[];
        $privalidation = 2;
        $pvsts = '';
        $pyvcomments = '';
        $pvappordecby = '';
        $pvappordecon = '';
        if(!empty($SuppMemtbl)){
            $privalidation = (!empty($SuppMemtbl->scfmt_isprivalid) && $SuppMemtbl->scfmt_isprivalid != null ? $SuppMemtbl->scfmt_isprivalid : 2);
            $pvsts = (!empty($SuppMemtbl->scfmt_privalidstatus) && $SuppMemtbl->scfmt_privalidstatus != null ? $SuppMemtbl->scfmt_privalidstatus : '');
            $pyvcomments = (!empty($SuppMemtbl->scfmt_privalidcomment) && $SuppMemtbl->scfmt_privalidcomment != null ? $SuppMemtbl->scfmt_privalidcomment : '');
            $pvappordecby = (!empty($SuppMemtbl->scfmt_privalidby) && $SuppMemtbl->scfmt_privalidby != null ? $SuppMemtbl->privalidationappby->um_firstname : '');
            $pvappordecon = (!empty($SuppMemtbl->scfmt_privalidon) && $SuppMemtbl->scfmt_privalidon != null ? date('d-m-Y', strtotime($SuppMemtbl->scfmt_privalidon))  : '');
        }        
        $returndatacertdata['isprimaryvalidationdone']= $privalidation;
        $returndatacertdata['pvsts']= $pvsts;
        $returndatacertdata['pyvcomments']= $pyvcomments;
        $returndatacertdata['pvappordecby']= $pvappordecby;
        $returndatacertdata['pvappordecon']= $pvappordecon;
        return $this->asJson($returndatacertdata);
    }
    public function actionDownloadcomplist(){
        $dataModel =  \common\models\SuppcertformmembtmpTblQuery::getscfexportlist();
        $filename = "scfcompanylist". date('Ymdhis').".csv";
        ob_clean();
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);      
        header('Pragma: no-cache');
        header("Expires: 0");
        $fp = fopen('php://output', 'w');
         fputcsv($fp, ['Registration No.', 'Supplier Code', 'Company Name', 'SCF Status', 'Special Status','Site Visit Status',
             'Renewal', 'Last updated on', 'Last updated by', 'Validated on', 'Validated by']);
         if (count($dataModel) > 0) {
            foreach ($dataModel as $result) {
                fputcsv($fp, $result);
            }
        }
        exit;
    }
    public function actionGetscfformtracker(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      $compk = \common\components\Security::decrypt($data['compk']);
      $returndata = \common\models\CertformmenudataTblQuery::getscfformtracker($compk);   
      $cumlativeArr=['scfformtrackerarray'=> $returndata];
      return $this->asJson($cumlativeArr);
    }
    public function actionGetscfauditlog(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      $compk = \common\components\Security::decrypt($data['compk']);
      $returndata = \common\models\SuppcertformauditlogTblQuery::getscfauditlog($compk);   
      $cumlativeArr=['scfauditarray'=> $returndata];
      return $this->asJson($cumlativeArr);
    }
    public function actionGetscfdetails(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($data['compk']);
        $categoryWiseTracker=BgivaldoccatmstTbl::scftracker($compk);
        $expirearray = array_column($categoryWiseTracker, 'expiry_count');
        $expirecount = array_sum($expirearray);
        $upcommingexpirarray = array_column($categoryWiseTracker, 'upcoming_expiry_count');
        $upcommingexpirecount = array_sum($upcommingexpirarray);
        $getcompanydet = \common\models\MembercompanymstTbl::findOne($compk);
        $Origin = $getcompanydet->MCM_Origin;
        $scfStatusMdl=SuppcertformmembtmpTbl::find()
            ->select(['scfmt_scfstatus,DATE_FORMAT(scfmt_updatedon,"%d-%m-%Y") as updated,DATE_FORMAT(scfmt_submittedon,"%d-%m-%Y") as submitted
             '])
            ->where('scfmt_membercompmst_fk=:company',
                [':company'=>$compk])->asArray()->one();
        $lastupdateon =  (!empty($scfStatusMdl['updated'])? $scfStatusMdl['updated'] :  $scfStatusMdl['submitted']);
        $cumulativeArr=[
            'categorytracker'=>$categoryWiseTracker,
            'lastupdateon'=>$lastupdateon,
            'expirecount'=>$expirecount,
            'upcommingexpirecount'=>$upcommingexpirecount,
        ];
        return $this->asJson($cumulativeArr);
    }
    public function actionGetcertificatedet(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($data['compk']);
        $certificatedet = \common\components\Suppcertform::getcertificatedetails($compk);        
        $cumulativeArr=[
            'certificatedet'=>$certificatedet,
        ];
        return $this->asJson($cumulativeArr);        
    }
    public function actionGethistorycomments(){
       $request_body = file_get_contents('php://input');
       $data = json_decode($request_body, true);
       $compk = \common\components\Security::decrypt($data['compid']);
       $returndata = \common\models\MemcompbackendinfohstyTblQuery::gethistorycommentstracker($compk);      
       $cumlativeArr=['histrycomtstracker'=> $returndata];
       return $this->asJson($cumlativeArr);   
    }
    public function actionCheckscfcomments(){
       $request_body = file_get_contents('php://input');
       $data = json_decode($request_body, true);
       $compk = \common\components\Security::decrypt($data['compid']);
       
        $cache = new \api\common\services\CacheBGI();
        try{
            $cacheKey = 'scfcomments'.$compk;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = \common\models\MemcompbackendinfoTblQuery::memcompinfoCountQueryCache();
                $returndata= \common\models\MemcompbackendinfoTbl::find()->where("mcbei_membercompmst_fk =:compk",[':compk'=>$compk])->count();
                $cache->store($cacheKey, $returndata, $duration = 0 , $cacheQuery);
            } else {
                $returndata = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $returndata= \common\models\MemcompbackendinfoTbl::find()->where("mcbei_membercompmst_fk =:compk",[':compk'=>$compk])->count();
        }
      
       $cumlativeArr=['iscommentexits'=> $returndata];
       return $this->asJson($cumlativeArr);   
    }    
    public function actionCheckdatastatusdash(){
        $formid = $_REQUEST['formid'];
        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        $comppk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        \common\components\Suppcertform::datainsertionsfmenu($comppk,$formid);
        $isdatafilled = SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formid and scfmt_membercompmst_fk=:company',[':company'=>$comppk,':formid'=>$formid])->asArray()->one();
        $isformfilled = 2;
        if(!empty($isdatafilled)){
            $isformfilled = 1;
        }
        $cumulativeArr=[
            'isformfilled'=>$isformfilled,
        ];
        return $this->asJson($cumulativeArr);
    }   
    public function actionUpdatescfclassification(){
        $request_body = file_get_contents('php://input');
        $data1 = json_decode($request_body, true);
        $data = $data1['scfformdata'];        
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $compModel = \common\models\MembercompanymstTbl::findOne($companypk);
        $compregModel = \common\models\MemberregistrationmstTbl::findone($compModel->MCM_MemberRegMst_Fk);
        $comppaymentModel = \common\models\MemcomppymtdtlsTbl::find()->where("MCPD_MemberCompMst_Fk=:compk",[':compk'=>$companypk])->orderBy('MemCompPymtDtls_Pk desc')->one();
        $compModel->mcm_classificationmst_fk = $data['ClassificationReferencebgi435'];
        $compregModel->mrm_memsubscriptionmst_fk=$data['subsrciption'];
        if(!empty($comppaymentModel)){
            $comppaymentModel->mcpd_memsubsbyclassif_fk=$data['ClassificationReferencebgi435'];
            $comppaymentModel->MCPD_TotalMembershipAmt=(string)$data['MembershipAmt'];
            $comppaymentModel->MCPD_YrsOfSubs=$data['membershipyear'];
            $comppaymentModel->save();
        }
        $compregModel->save();
        if($compModel->save()){
            return $this->asJson([
                'data' => $compModel,
                'msg' => 'S',
                'status' => 200,
            ]);
        }else{
            return $this->asJson([
                'data' => $compModel,
                'msg' => 'F',
                'status' => 100,
            ]);
        }      
    }
    public function actionGetregistrationyear(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $hideorshowfinacialdoc = 1;  //hide financial report
        $compdettable = \common\models\MembercompanymstTbl::findOne($companypk);
        if(!empty($compdettable) && !empty($compdettable->MCM_RegistrationYear)){
            $registrationdate = date('Y-m-d', strtotime($compdettable->MCM_RegistrationYear. ' + 365 day'));
            $currentdate = date('Y-m-d');
            if($registrationdate <= $currentdate){
                $hideorshowfinacialdoc = 2;  //show financial report
            }
        }
        $cumlativeData=['hideorshowfinacialdoc'=>$hideorshowfinacialdoc];
        return $this->asJson($cumlativeData) ;
    }
    public function actionGetriyadadata()
    {
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
            $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        }
        $formdesc = \common\components\Security::sanitizeInput($_REQUEST['formdesc'], "number");
        $category = \common\components\Security::sanitizeInput($_REQUEST['category'], "number");
        $formpk = \common\components\Security::sanitizeInput($_REQUEST['form'], "number");
        $subcategory = \common\components\Security::sanitizeInput($_REQUEST['subcat'], "number");
        $stktype=\common\components\Security::sanitizeInput($_REQUEST['stktype'],"number");
        if(in_array($stktype, [1,6])){
            $returndata = SuppcertformpartrntmpTbl::find()
            ->leftJoin('suppcertformtrntmp_tbl', 'suppcertformtrntmp_pk=scfptt_suppcertformtrntmp_fk')
            ->where('scfptt_bgivaldoccatmst_fk=:cat and scfptt_bgivaldocsubcatmst_fk=:subcat and 
                scfptt_membercompmst_fk=:company and scfptt_isdeleted=2', [':cat' => $category, ':subcat' => $subcategory,
                ':company' => $companypk])->all();
        }else{                
        $returndata = \common\models\SuppcertformpartrnTbl::find()
            ->leftJoin('suppcertformtrn_tbl', 'suppcertformtrn_pk=scfpt_suppcertformtrn_fk')
            ->where('scfpt_bgivaldoccatmst_fk=:cat and scfpt_bgivaldocsubcatmst_fk=:subcat and 
                scfpt_membercompmst_fk=:company', [':cat' => $category, ':subcat' => $subcategory,
                ':company' => $companypk])->all();
        }
        $returndatacertdata = [];
        $subcatstatus = [];
        $Riyadaswitchdata = "";
        $statusInd=[1=>'New',2=>'Updated',3=>'Approved',4=>'Declined'];
        $orwithDecline=[];
        $countofparamerter = count($returndata);
        foreach ($returndata as $key => $txval) {
            if(in_array($stktype, [1,6])){
                $keyofarr = str_replace(' ', '', $txval->scfpttBgivaldocsubcatpardtlsFk->bvdscpd_parametername) . 'bgi' . $txval->scfptt_bgivaldocsubcatpardtls_fk;
            }else{
                $keyofarr = str_replace(' ', '', $txval->scfptBgivaldocsubcatpardtlsFk->bvdscpd_parametername) . 'bgi' . $txval->scfpt_bgivaldocsubcatpardtls_fk;
            }         
            if(in_array($stktype, [1,6])){
                if($txval->scfpttBgivaldocsubcatpardtlsFk->bvdscpd_parametertype =='F'){
                    $keyofarr = str_replace(' ', '', $txval->scfpttBgivaldocsubcatpardtlsFk->bvdscpd_parametername).'bgi'.$txval->scfptt_bgivaldocsubcatpardtls_fk;
                    $Fildtls=MemcompfiledtlsTbl::findOne($txval->scfptt_paramvalue);
                    $arrFile=pathinfo($Fildtls->mcfd_origfilename)['extension'];
                    $filedocup = !empty($txval->scfptt_paramvalue) ? explode(',', $txval->scfptt_paramvalue) : [];
                    $returndatacertdata['filedoccnt'] =  count($filedocup);
                    $bankdoc = [];
                    if(count($filedocup) > 0){
                            foreach ($filedocup as $upkey => $upvalue) {
                                    $bankdoc[$upkey]['docUrl'] = \common\components\Drive::generateUrl($upvalue,$companypk,$userpk);
                                    $bankdoc[$upkey]['fileName'] = \common\components\Drive::getFileName(\common\components\Security::encrypt($upvalue));
                                    $bankdoc[$upkey]['ext'] =  pathinfo($bankdoc[$upkey]['fileName'],PATHINFO_EXTENSION);
                            }
                    }
                    $returndatacertdata['filedocarr'] = $bankdoc;
                }   
            }else{
                if($txval->scfptBgivaldocsubcatpardtlsFk->bvdscpd_parametertype =='F'){
                    $keyofarr = str_replace(' ', '', $txval->scfptBgivaldocsubcatpardtlsFk->bvdscpd_parametername).'bgi'.$txval->scfpt_bgivaldocsubcatpardtls_fk;
                    $Fildtls=MemcompfiledtlsTbl::findOne($txval->scfpt_paramvalue);
                    $arrFile=pathinfo($Fildtls->mcfd_origfilename)['extension'];
                    $filedocup = !empty($txval->scfpt_paramvalue) ? explode(',', $txval->scfpt_paramvalue) : [];
                    $returndatacertdata['filedoccnt'] =  count($filedocup);
                    $bankdoc = [];
                    if(count($filedocup) > 0){
                            foreach ($filedocup as $upkey => $upvalue) {
                                    $bankdoc[$upkey]['docUrl'] = \common\components\Drive::generateUrl($upvalue,$companypk,$userpk);
                                    $bankdoc[$upkey]['fileName'] = \common\components\Drive::getFileName(\common\components\Security::encrypt($upvalue));
                                    $bankdoc[$upkey]['ext'] =  pathinfo($bankdoc[$upkey]['fileName'],PATHINFO_EXTENSION);
                            }
                    }
                    $returndatacertdata['filedocarr'] = $bankdoc;
                } 
            } 
            if(!empty($arrFile)){   
                if(in_array($stktype, [1,6])){
                    $returndatacertdata['filelink']= Drive::generateUrl($txval->scfptt_paramvalue, $companypk, $userpk);
                    $returndatacertdata['filename']= $Fildtls->mcfd_origfilename;
                    $returndatacertdata['ext']=strtolower($arrFile);
                    $returndatacertdata['extTXT']='View '.strtoupper($arrFile);
                }else{
                  $returndatacertdata['filelink']= Drive::generateUrl($txval->scfpt_paramvalue, $companypk, $userpk);
                  $returndatacertdata['filename']= $Fildtls->mcfd_origfilename;
                  $returndatacertdata['ext']=strtolower($arrFile);
                  $returndatacertdata['extTXT']='View '.strtoupper($arrFile);  
               }                
            }
             if(in_array($stktype, [1,6])){
                   $returndatacertdata[$keyofarr] = $txval->scfptt_paramvalue;               
            }else{
                   $returndatacertdata[$keyofarr] = $txval->scfpt_paramvalue;
            }    
            $indiuvalstatus='status'.$keyofarr;
            $indiuvalcomments='comment'.$keyofarr;
             if(in_array($stktype, [1,6])){
                 $status=$txval->scfptt_scfstatus;
                 $orwithDecline[]=$statusInd[$status];
                 $comments=$txval->scfptt_appdeclcomments;
                 $statustext=$statusInd[$status];
                 $returndatacertdata[$indiuvalstatus]=$statustext;
                 $returndatacertdata[$indiuvalcomments]=$comments;
             }else{
                 $returndatacertdata[$indiuvalstatus]='';
                 $returndatacertdata[$indiuvalcomments]='';
             }            
        }
        if (!empty($returndatacertdata)) {
            $Riyadaswitchdata = $returndatacertdata['RiyadaClassificationSwitchbgi465'];
            unset($returndatacertdata['RiyadaClassificationSwitchbgi465']);
            unset($returndatacertdata['statusRiyadaClassificationSwitchbgi465']);
            unset($returndatacertdata['commentRiyadaClassificationSwitchbgi465']);
            if(in_array($stktype, [1,6])){
                $formMemtmp=SuppcertformmembtmpTbl::find()->joinWith('suppcertcattmp')
                ->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company
                 and scfct_bgivaldoccatmst_fk=:category',
                    [':formpk'=>$formpk,':company'=>$companypk,':category'=>$category])->one();

                $formStatus=['I'=>'Inprogess','A'=>'Approved','D'=>'Declined','RS'=>'ReSubmitted','R'=>'Reopened',
                    'U'=>'Updated','DI'=>'Decline InProgress','OSD'=>'Overall VB decline','OVD'=>'Overall SVF Decline'];

                $overallformModel=SuppcertformtrntmpTbl::find()->where('scftt_suppcertformcattmp_fk =:cattbl and 
                scftt_bgivaldocformdescmst_fk=:destbl and scftt_isdeleted = 2',
                    [':destbl'=>$formdesc,':cattbl'=>$formMemtmp->suppcertcattmp[0]->suppcertformcattmp_pk])->asArray()->one();
                $returndatacertdata['overallcomments']=$overallformModel['scftt_appdeclcomments'];
                $returndatacertdata['overallstatus']=$overallformModel['scftt_status'];
                $returndatacertdata['formstatus']=$formStatus[$formMemtmp->scfmt_scfstatus];
                $returndatacertdata['formcomments']=$formMemtmp->scfmt_appdeclcomments;
                $returndatacertdata['categorystatus']=$formMemtmp->suppcertcattmp[0]->scfct_status;            
                $returndatacertdata['categorycomments']=$formMemtmp->suppcertcattmp[0]->scfct_appdeclcomments;
                $returndatacertdata['rightcornerError']=in_array('Declined',$orwithDecline);
            }else{
                $returndatacertdata['overallcomments']='';
                $returndatacertdata['overallstatus']='';
                $returndatacertdata['formstatus']='';
                $returndatacertdata['formcomments']='';
                $returndatacertdata['categorystatus']='';            
                $returndatacertdata['categorycomments']='';
                $returndatacertdata['rightcornerError']=FALSE;
            }            
            $returndatacertdata['subcategory']=$subcategory;
            $returndatacertdata['category']=$category;    
            if($Riyadaswitchdata != 'Yes'  || ($countofparamerter == 1 && $Riyadaswitchdata == 'Yes' )){
                $subcatstatus['overallstatus'] = $returndatacertdata['overallstatus'];
                $subcatstatus['overallcomments'] = $returndatacertdata['overallcomments'];
                $returndatacertdata = [];
            }
        }
         return $this->asJson(['data'=>$returndatacertdata,'Riyadaswitchdata'=>$Riyadaswitchdata,'subcatstatus'=>$subcatstatus]);
    }
    public function actionSaveriyadaswitch(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
            $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        }
        $formdesc = \common\components\Security::sanitizeInput($_REQUEST['formdesc'], "number");
        $category = \common\components\Security::sanitizeInput($_REQUEST['category'], "number");
        $formpk = \common\components\Security::sanitizeInput($_REQUEST['form'], "number");
        $subcategory = \common\components\Security::sanitizeInput($_REQUEST['subcat'], "number");
        $formMemtmp=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company',
            [':formpk'=>$formpk,':company'=>$companypk])->one();
        if(empty($formMemtmp)){
            $formMemtmp=new SuppcertformmembtmpTbl();
            $formMemtmp->scfmt_scfstatus='I';
            $formMemtmp->scfmt_submittedon=date('Y-m-d H:i:s');
            $formMemtmp->scfmt_submittedby=$userpk;
        }else{
            if(in_array($formMemtmp->scfmt_scfstatus,['D','OSD'])){
                $formMemtmp->scfmt_scfstatus='DI';
                $formMemtmp->scfmt_submittedon=date('Y-m-d H:i:s');
                $formMemtmp->scfmt_submittedby=$userpk;
            }elseif($formMemtmp->scfmt_scfstatus == 'A'){
	$formMemtmp->scfmt_scfstatus='UI';
	$formMemtmp->scfmt_submittedon=date('Y-m-d H:i:s');
	$formMemtmp->scfmt_submittedby=$userpk;
            }
        }
        $formMemtmp->scfmt_formmst_fk=$formpk;
        $formMemtmp->scfmt_membercompmst_fk=$companypk;
        if($formMemtmp->save(false)){
            $SupCatModel=SuppcertformcattmpTbl::find()
            ->where('scfct_suppcertformmembtmp_fk=:membtmp and scfct_bgivaldoccatmst_fk=:cat',
                    [':membtmp'=>$formMemtmp->suppcertformmembtmp_pk,':cat'=>$category])->one();
            if(empty($SupCatModel)){
                $SupCatModel=new SuppcertformcattmpTbl();
                $SupCatModel->scfct_isapplicable=null;
            }else{
                $SupCatModel->scfct_isapplicable=$SupCatModel->scfct_isapplicable;
            }
            $SupCatModel->scfct_appdeclcomments=null;
            $SupCatModel->scfct_status=1;
            $SupCatModel->scfct_suppcertformmembtmp_fk=$formMemtmp->suppcertformmembtmp_pk;
            $SupCatModel->scfct_bgivaldoccatmst_fk=$category;            
            $SupCatModel->scfct_submittedon=date('Y-m-d H:i:s');
            $SupCatModel->scfct_submittedby=$userpk;
            if($SupCatModel->save(false)){
                $suppcertForm=SuppcertformtrntmpTbl::find()
                ->where('scftt_suppcertformcattmp_fk=:cattbl and scftt_bgivaldocformdescmst_fk=:formdesc and scftt_isdeleted = 2',
                        [':cattbl'=>$SupCatModel->suppcertformcattmp_pk,':formdesc'=>$formdesc])
                ->one();
                if(empty($suppcertForm)){
                    $suppcertForm=new SuppcertformtrntmpTbl();
                    $suppcertForm->scftt_status=1;
                    $suppcertForm->scftt_appdeclcomments='';
                    $suppcertForm->scftt_submittedon=date('Y-m-d H:i:s');
                    $suppcertForm->scftt_submittedby=$userpk;
                }
                $suppcertForm->scftt_suppcertformcattmp_fk=$SupCatModel->suppcertformcattmp_pk;
                $suppcertForm->scftt_bgivaldocformdescmst_fk=$formdesc;
                if($suppcertForm->save(false)){
                    if($_REQUEST['id'] ==0){
                        $yesornooptcheck =SuppcertformpartrntmpTbl::find()
                            ->where('scfptt_membercompmst_fk=:company and scfptt_bgivaldocsubcatpardtls_fk=:sbcatpart and scfptt_bgivaldoccatmst_fk = :category
                                    and scfptt_bgivaldocsubcatmst_fk = :subcategory and scfptt_isdeleted=2',
                                [':company'=>$companypk,':sbcatpart'=>465,':category'=>10,':subcategory'=>124])
                            ->one();
                        if(!empty($yesornooptcheck)){
                            $yesornooptcheck->scfptt_paramvalue='No';
                            $yesornooptcheck->scfptt_updatedon=date('Y-m-d H:i:s');
                            $yesornooptcheck->scfptt_updatedby=$userpk;
                            if(in_array($yesornooptcheck->scfptt_scfstatus,[3,4,2])){
                                $yesornooptcheck->scfptt_scfstatus=2;
                                $yesornooptcheck->scfptt_appdeclcomments=null;
                            }else{
                                $yesornooptcheck->scfptt_scfstatus=1;
                            }
                            $yesornooptcheck->scfptt_isupdated=1;
                            $yesornooptcheck->scfptt_appdeclcomments=null;
                            if($yesornooptcheck->save(false)){
                                     SuppcertformpartrntmpTbl::deleteAll('scfptt_membercompmst_fk=:company and 
                                        scfptt_bgivaldoccatmst_fk=10 and scfptt_bgivaldocsubcatmst_fk=124 and
                                             scfptt_bgivaldocsubcatpardtls_fk !=:subcatparpk and  scfptt_scfstatus=1',
                                                 [':company'=>$companypk,':subcatparpk'=>465]);
                                    Yii::$app->db->createCommand('update suppcertformpartrntmp_tbl set scfptt_isdeleted=1 
                                     where scfptt_bgivaldoccatmst_fk=10 and scfptt_bgivaldocsubcatmst_fk=124 and scfptt_bgivaldocsubcatpardtls_fk != 465 and 
                                     scfptt_membercompmst_fk='.$companypk.' and  scfptt_scfstatus in(2,3,4)')
                                       ->execute();
                                    $savesection =  $yesornooptcheck;
                            }                
                        } else{
                            $yesornoopt=new SuppcertformpartrntmpTbl();
                            $yesornoopt->scfptt_membercompmst_fk=$companypk;
                            $yesornoopt->scfptt_paramvalue='No';
                            $yesornoopt->scfptt_suppcertformtrntmp_fk=$suppcertForm->suppcertformtrntmp_pk;
                            $yesornoopt->scfptt_bgivaldoccatmst_fk=$category?$category:null;
                            $yesornoopt->scfptt_bgivaldocsubcatmst_fk=$subcategory?$subcategory:null;
                            $yesornoopt->scfptt_bgivaldocsubcatpardtls_fk=465;
                            $yesornoopt->scfptt_bgivaldoccatpardtls_fk=null;
                            $yesornoopt->scfptt_submittedon=date('Y-m-d H:i:s');
                            $yesornoopt->scfptt_submittedby=$userpk;
                            $yesornoopt->scfptt_appdeclcomments=null;
                            if(in_array($yesornoopt->scfptt_scfstatus,[3,4,2])){
                                $yesornoopt->scfptt_scfstatus=2;
                            }else{
                                $yesornoopt->scfptt_scfstatus=1;
                            }
                            $yesornoopt->scfptt_isupdated=1;
                            if($yesornoopt->save(false)){                   
                                $savesection =  $yesornoopt;
                            }
                        }               
                    } elseif($_REQUEST['id'] ==1){
                        $yesornooptcheck =SuppcertformpartrntmpTbl::find()
                            ->where('scfptt_membercompmst_fk=:company and scfptt_bgivaldocsubcatpardtls_fk=:sbcatpart and scfptt_bgivaldoccatmst_fk = :category
                                    and scfptt_bgivaldocsubcatmst_fk = :subcategory and scfptt_isdeleted=2',
                                [':company'=>$companypk,':sbcatpart'=>465,':category'=>10,':subcategory'=>124])
                            ->one();
                        if(!empty($yesornooptcheck)){
                            $yesornooptcheck->scfptt_paramvalue='Yes';
                            $yesornooptcheck->scfptt_updatedon=date('Y-m-d H:i:s');
                            $yesornooptcheck->scfptt_updatedby=$userpk;
                            if(in_array($yesornooptcheck->scfptt_scfstatus,[3,4,2])){
                                $yesornooptcheck->scfptt_scfstatus=2;
                                $yesornooptcheck->scfptt_appdeclcomments=null;
                            }else{
                                $yesornooptcheck->scfptt_scfstatus=1;
                            }
                            $yesornooptcheck->scfptt_isupdated=1;
                            $yesornooptcheck->scfptt_appdeclcomments=null;
                            if($yesornooptcheck->save(false)){
                                    $savesection =  $yesornooptcheck;
                            }                
                        } else{
                            $yesornoopt=new SuppcertformpartrntmpTbl();
                            $yesornoopt->scfptt_membercompmst_fk=$companypk;
                            $yesornoopt->scfptt_paramvalue='Yes';
                            $yesornoopt->scfptt_suppcertformtrntmp_fk=$suppcertForm->suppcertformtrntmp_pk;
                            $yesornoopt->scfptt_bgivaldoccatmst_fk=$category?$category:null;
                            $yesornoopt->scfptt_bgivaldocsubcatmst_fk=$subcategory?$subcategory:null;
                            $yesornoopt->scfptt_bgivaldocsubcatpardtls_fk=465;
                            $yesornoopt->scfptt_bgivaldoccatpardtls_fk=null;
                            $yesornoopt->scfptt_submittedon=date('Y-m-d H:i:s');
                            $yesornoopt->scfptt_submittedby=$userpk;
                            $yesornoopt->scfptt_appdeclcomments=null;
                            if(in_array($yesornoopt->scfptt_scfstatus,[3,4,2])){
                                $yesornoopt->scfptt_scfstatus=2;
                            }else{
                                $yesornoopt->scfptt_scfstatus=1;
                            }
                                $yesornoopt->scfptt_isupdated=1;
                            if($yesornoopt->save(false)){                   
                                $savesection =  $yesornoopt;
                            }
                        }
                    }
                }
                \common\components\Suppcertform::datainsertionsfmenu($companypk,$formpk);
            }
        }        
         return $this->asJson([
            'data' => $savesection,
            'msg' => 'S',
            'status' => 200,
        ]);
    }            
     // RABT
    public function actionScfmenulist(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
           $company_id = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
           $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $formid = $_REQUEST['formid'];
        $Returnlist = \common\models\CertformmenudataTblQuery::getmenulistquery($company_id,$userpk);
        return $this->asJson($Returnlist);
    }
    public function actionGetscfleveluserdata(){
        $request_body = file_get_contents('php://input');
        $compdata = json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($compdata['compk']);
        $form = !empty($compdata['form']) ? $compdata['form'] : 1;
        $data = ApprovalworkflowuserconfigTblQuery::getLevelOfAuthorityUserdata($form,$compk);
        return $this->asJson($data);
    }
    public function actionGetvalidatehistory(){
        $request_body = file_get_contents('php://input');
        $formData = json_decode($request_body, true);
        $data = ApprovalworkflowuserconfigTblQuery::getValidateHistory($formData);
        return $this->asJson($data);
    }
    public function actionGetparameterlevelvalue() {
        $dataArray = $_REQUEST;
        $dataArray['subcat'] = \common\components\Security::sanitizeInput($dataArray['subcat'], "number");
        $dataArray['cat'] = \common\components\Security::sanitizeInput($dataArray['cat'], "number");
        $dataArray['compid'] = \common\components\Security::decrypt($dataArray['compid']);
        if($dataArray){
            $data = \common\models\BgivaldocsubcatpardtlsTblQuery::getParameters($dataArray);
        }
        return $this->asJson($data);
    }

    public function actionGetscfbackendauditlog(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $compK= \common\components\Security::decrypt($data['compk']);
        
        $scflistdata = $dataModel['data'];
        $ownarray = [];
        $auditlog = \common\models\SuppcertformauditlogTbl::find()
                ->select([ 'DATE_FORMAT(scfal_updatedon,"%d-%m-%Y") as updationdatime','DATE_FORMAT(scfal_updatedon,"%h:%i %p") as updatetime','MCM_CompanyName','MCM_SupplierCode','mcm_RegistrationNo', "if(scfal_status<>6 , CONCAT_WS(' ', sb.um_firstname, sb.um_middlename, sb.um_lastname), CONCAT_WS(' ', vb.um_firstname, vb.um_middlename, vb.um_lastname)) as username","if(scfal_status=6 ,awfct_level,null) as leveldata","scfal_status as status","awfct_level"])
                ->leftJoin('certapprovaldtls_tbl','certapprovaldtls_pk = scfal_certapprovaldtls_fk')
                ->leftJoin('approvalworkflowuserconfig_tbl', 'approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk')
                ->leftJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk = awfuc_approvalworkflowconfigtrns_fk')
                ->leftJoin('membercompanymst_tbl', 'scfal_membercompmst_fk = MemberCompMst_Pk')
                ->leftJoin('usermst_tbl as vb', 'vb.UserMst_Pk=awfuc_usermst_fk')
                ->leftJoin('usermst_tbl as sb', 'sb.UserMst_Pk=scfal_updatedby')
                ->where('scfal_membercompmst_fk=:company', [':company' => $compK])
                ->orderBy(['suppcertformauditlog_pk' => SORT_DESC])
                ->asArray()
                ->all();
//        echo "<pre>";
//        print_r($auditlog);
//        exit;
         $cumulativeArr = [
           'companyname'=>$auditlog[0]['MCM_CompanyName'],
           'supplierCode'=>$auditlog[0]['MCM_SupplierCode'],
           'registrationNo'=>$auditlog[0]['mcm_RegistrationNo'],
           'certstatus'=>$auditlog[0]['certstatus'],
           'owenerdata'=>$auditlog,
         ];
        return $cumulativeArr;
    }
    public function actionGetscfapprovallisting(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $dataModel =  \common\models\SuppcertformmembtmpTblQuery::getscflist($data);
        $scflistdata = $dataModel['data'];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $togetuserpk = [];
        if(!empty($scflistdata)){
            foreach ($scflistdata as $key => $value) {
                $compk =$value['cmpk'];                
                $levelApproval = CertapprovaldtlsTbl::find()
                    ->select([
                        'certapprovaldtls_pk',
                        'cad_membercompanymst_fk',
                        'cad_status',
                        'cad_comments',
                        'cad_actioncompleted as actionCompleted',
                        'cad_updatedon as actionDoneOn',
                        'certcatsubcatapprovaldtls_pk',
                        "ccscad_level",
                        "ccscad_nxtlevel as currlevel",
                        'ccscad_isvalidated',
                        'DATE_FORMAT(cad_updatedon, "%d-%m-%Y") as validateon',
                        'cad_approvalworkflowuserconfig_fk','group_concat(ccscad_apprdclnby) as appdecby'
                    ])                        
                    ->leftJoin('certcatsubcatapprovaldtls_tbl', 'ccscad_certapprovaldtls_fk = certapprovaldtls_pk')
                    ->where(['cad_suppcertformmembtmp_fk' => $value['suppcertformmembtmp_pk'], 'cad_membercompanymst_fk' => $compk])
                    ->andWhere('ccscad_suppcertformtrntmp_fk IS NULL')
                   ->groupBy("certapprovaldtls_pk")
                    ->orderBy('certapprovaldtls_pk DESC')
                    ->asArray()
                    ->one();
                if(!empty($levelApproval) && !empty($levelApproval['cad_approvalworkflowuserconfig_fk'])){
                    $isuserconfpk = $levelApproval['cad_approvalworkflowuserconfig_fk'];                    
                    $togetuserpk = \api\modules\mst\models\ApprovalworkflowuserconfigTbl::find()
                    ->select("group_concat(awfuc_usermst_fk) as userpk , awfuc_isfinalapprauthority")
                    ->where("approvalworkflowuserconfig_pk in ($isuserconfpk)")
                    ->groupBy("awfuc_approvalworkflowconfigtrns_fk")
                    ->asArray()
                    ->one();
                    $isuserarr = explode(',', $togetuserpk['userpk']);
                }            
                if(($value['scfstatus'] == 'S'  && $value['certappcnt'] < 1) || ($levelApproval['actionCompleted'] == 1 && empty($levelApproval['appdecby']))){
                    $validationsts = 1; // yet to validate
                } elseif(!empty($levelApproval) && !empty($levelApproval['appdecby']) && $levelApproval['actionCompleted'] == 1 &&  $levelApproval['cad_status'] == 0){
                    $validationsts = 2; // validation in-progress
                } elseif(!empty($levelApproval) && !empty($levelApproval['appdecby']) && $levelApproval['actionCompleted'] == 2 &&  $levelApproval['cad_status'] == 1){
                    $validationsts = 3; // Approved
                } elseif(!empty($levelApproval) && !empty($levelApproval['appdecby']) && $levelApproval['actionCompleted'] == 2 &&  $levelApproval['cad_status'] == 2){
                    $validationsts = 4; // Declined
                }
                if($value['scfstatus'] == 'S'  && $value['certappcnt'] == 0){
                    $scflistdata[$key]['toshowvalidate'] = 1; // to show validate button 
                    $scfvalidateby = '-';
                    $lastvalidatedon = "-";                    
                } elseif($value['certappcnt'] >= 1 && !empty($levelApproval) && $levelApproval['actionCompleted'] == 1  && in_array($userPK,$isuserarr)){
                    $scflistdata[$key]['toshowvalidate'] = 1; // to show validate button 
                    if($value['certappcnt'] == 1  && count($isuserarr)  == 1 && $value['scfstatus'] == 'S'){
                        $curruservalidated = $isuserarr[0];
                        $lastvalidatedon = $levelApproval['validateon'];
                    } elseif($value['certappcnt'] > 1 && !empty($levelApproval) && count($isuserarr)  >= 1){
                        if(empty($levelApproval['valuserpk'])){
                            if(in_array($value['scfstatus'], ['RS','U']) && $levelApproval['ccscad_level'] == 1){
                                $curruservalidated = $value['validateby'];
                                $lastvalidatedon = $value['validateon'];
                            }else{
                                $lastvalidateddetials = CertapprovaldtlsTbl::find()
                                    ->select(['certapprovaldtls_pk','awfuc_usermst_fk  as userpk','DATE_FORMAT(cad_updatedon, "%d-%m-%Y") as validateon'])                        
                                    ->innerJoin('approvalworkflowuserconfig_tbl', 'approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk')
                                    ->where(['cad_suppcertformmembtmp_fk' => $value['suppcertformmembtmp_pk'], 'cad_membercompanymst_fk' => $compk])
                                    ->andWhere('cad_actioncompleted = 2')
                                    ->orderBy('certapprovaldtls_pk DESC')
                                    ->asArray()
                                    ->one();
                                $curruservalidated = $lastvalidateddetials['userpk'];
                                $lastvalidatedon = $lastvalidateddetials['validateon'];
                            }
                        } else{
                            $curruservalidated = $levelApproval['valuserpk'];
                            $lastvalidatedon = $levelApproval['validateon'];                         
                        }                                             
                    }
                    $scfvalidatedet = \common\models\UsermstTbl::findOne($curruservalidated);
                    $scfvalidateby = $scfvalidatedet->um_firstname . " " . $scfvalidatedet->um_middlename . " ". $scfvalidatedet->um_lastname;
                } else{
                    $scflistdata[$key]['toshowvalidate'] = 2; // to show view button 
                    if($value['certappcnt'] == 1  && !empty($levelApproval) && count($isuserarr)  == 1 && $value['scfstatus'] == 'S'){
                        $curruservalidated = $isuserarr[0];
                        $lastvalidatedon = $levelApproval['validateon'];
                        $scfvalidatedet = \common\models\UsermstTbl::findOne($curruservalidated);
                        $scfvalidateby = $scfvalidatedet->um_firstname . " " . $scfvalidatedet->um_middlename . " ". $scfvalidatedet->um_lastname;
                    } elseif($value['certappcnt'] > 1 && !empty($levelApproval) && count($isuserarr)  >= 1){
                        if(empty($levelApproval['valuserpk'])){
                            if(in_array($value['scfstatus'], ['RS','U']) && $levelApproval['ccscad_level'] == 1){
                                $curruservalidated = $value['validateby'];
                                $lastvalidatedon = $value['validateon'];
                            }else{
                                $lastvalidateddetials = CertapprovaldtlsTbl::find()
                                    ->select(['certapprovaldtls_pk','awfuc_usermst_fk  as userpk','DATE_FORMAT(cad_updatedon, "%d-%m-%Y") as validateon'])                        
                                    ->innerJoin('approvalworkflowuserconfig_tbl', 'approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk')
                                    ->where(['cad_suppcertformmembtmp_fk' => $value['suppcertformmembtmp_pk'], 'cad_membercompanymst_fk' => $compk])
                                    ->andWhere('cad_actioncompleted = 2')
                                    ->orderBy('certapprovaldtls_pk DESC')
                                    ->asArray()
                                    ->one();
                                $curruservalidated = $lastvalidateddetials['userpk'];
                                $lastvalidatedon = $lastvalidateddetials['validateon'];
                            }
                        } else{
                            $curruservalidated = $levelApproval['valuserpk'];
                            $lastvalidatedon = $levelApproval['validateon'];                         
                        }                              
                        $scfvalidatedet = \common\models\UsermstTbl::findOne($curruservalidated);
                        $scfvalidateby = $scfvalidatedet->um_firstname . " " . $scfvalidatedet->um_middlename . " ". $scfvalidatedet->um_lastname;
                    }else{
                        $scfvalidateby = '-';
                        $lastvalidatedon = "-";
                    }
                }
                $scflistdata[$key]['isfinalapprauthority'] =  !empty($togetuserpk) && !empty($togetuserpk['awfuc_isfinalapprauthority']) ? $togetuserpk['awfuc_isfinalapprauthority'] : 2;
                $scflistdata[$key]['last_validated_by'] = $scfvalidateby;
                $scflistdata[$key]['apprdclnby'] = $levelApproval['apprdclnby'];
                $scflistdata[$key]['currlevel'] = !empty($levelApproval['ccscad_level'])?$levelApproval['ccscad_level']:1;
                $scflistdata[$key]['nxtlevel'] = $levelApproval['ccscad_level'] + 1;
                $scflistdata[$key]['last_validated_on'] = $lastvalidatedon;
                $scflistdata[$key]['validationstatusval'] = $validationsts;
                $scflistdata[$key]['catsubcatPk'] = $levelApproval['certcatsubcatapprovaldtls_pk'];
                $scflistdata[$key]['actionCompleted'] = $levelApproval['actionCompleted'];
                $scflistdata[$key]['ccscad_movedtonxtlevel'] = $levelApproval['ccscad_movedtonxtlevel'];
                $scfupdatedon = $levelApproval['updateon'] ?: $value['updateon'] ?: $value['submittedon'];
                $curDate = date('d-m-Y');
                $datediff = abs(strtotime($curDate) - strtotime($scfupdatedon));
                $pendingday = round($datediff / (60 * 60 * 24)) ;
                $updatedby = (!empty($value['updateby']) ? $value['updateby'] : $value['submittedby']);
                $scfupdateddet = \common\models\UsermstTbl::findOne($updatedby);
                $scflistdata[$key]['scfupdatedon'] = $scfupdatedon;
                $scflistdata[$key]['pendingday'] = $pendingday;
                $scflistdata[$key]['scfupdatedby'] = $scfupdateddet->um_firstname . " " . $scfupdateddet->um_middlename . " ". $scfupdateddet->um_lastname ;    
                $scflistdata[$key]['suppliercode'] = (!empty($value['suppcode'])) ? $value['suppcode']: 'NIL';
                $scflistdata[$key]['enccmpk'] = \common\components\Security::encrypt($value['cmpk']);  
            }            
            $totallevel = \api\modules\mst\models\ApprovalworkflowconfigtrnsTbl::find()->select(['awfct_level as totalLevels'])->asArray()->all();
        }
        $exportlink = \Yii::$app->urlManager->createAbsoluteUrl(['svf/svf/downloadcomplist']);
        $cumlativeArr=['overallcount'=>$dataModel['overallcnt'],'count'=> $dataModel['count'],'datasets'=> $scflistdata,'exportlink'=>$exportlink,'totallevelsconfigured'=>max($totallevel)];
        return $this->asJson($cumlativeArr);
    }
    public function actionGetcategorycompletion(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($data['compid']);
        if(isset($compk) && !empty($compk) && $compk != "undefined"){
            $companypk = $compk;
            $compdet =  \common\models\MembercompanymstTbl::findOne($companypk);
            if(!empty($compdet)){
                $origin = $compdet['MCM_Origin'];
            }
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $origin=\yii\db\ActiveRecord::getTokenData('MCM_Origin',true);
        }
       $querydata = \Yii::$app->db->createCommand("SELECT count(1) as total, sum(if(cfmd_statusforsupp in ('Completed','Approved','Declined'), 1, 0)) as filled FROM certformmenudata_tbl WHERE cfmd_membercompmst_fk =:p1")
        ->bindValue(':p1' , $companypk)->queryOne();
       if(!empty($querydata)){
           $completioncount = $querydata['filled'];
           $totalcount = $querydata['total'];
       }
        return $this->asJson([
            'completioncount' => $completioncount,
            'totalcount' => $totalcount,
            'msg' => 'S',
            'status' => 200,
        ]);
    }        
    public function actionGetcommercialregno(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        }
        $BasicInfo=\common\models\MembercompanymstTbl::find()->select(['MCM_crnumber'])
        ->where("MemberCompMst_Pk=:company",[':company'=>$companypk])->asArray()->one();
        return $this->asJson(['basic'=>$BasicInfo]);
    }
    public function actionGetcorporatesummary(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        }        
        $BasicInfo=\common\models\MembercompanymstTbl::getcoporatedetails($companypk);
        return $this->asJson($BasicInfo);
    }    
    public function actionGetcertformdetails(){
        $returndatacertdata=\common\models\SuppcertformpartrntmpTbl::fetchcertformdetails();        
       return $this->asJson($returndatacertdata);
    }    
    public function actionGetprdservicedata(){
        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        if(!empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
            $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
            $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
            $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        }    
        $origin=\yii\db\ActiveRecord::getTokenData('MCM_Origin',true);
         $stkholdertype=\yii\db\ActiveRecord::getTokenData('reg_type',true);
        $formdesc=\common\components\Security::sanitizeInput($_REQUEST['formdesc'],"number");
        $category=\common\components\Security::sanitizeInput($_REQUEST['category'],"number");
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $type=\common\components\Security::sanitizeInput($_REQUEST['type'],"number");
        $SCFWholeStatus=SuppcertformmembtmpTbl::find()                
        ->select(['scftt_status','scftt_appdeclcomments','scfmt_scfstatus'])
        ->leftJoin(SuppcertformcattmpTbl::tableName(),'scfct_suppcertformmembtmp_fk=suppcertformmembtmp_pk')
        ->leftJoin(\common\models\SuppcertformtrntmpTbl::tableName(),'scftt_suppcertformcattmp_fk=suppcertformcattmp_pk')
        ->where('scfmt_formmst_fk=:formid and scfmt_membercompmst_fk=:company and scfct_bgivaldoccatmst_fk=:categoryid '
        . 'and scftt_bgivaldocformdescmst_fk=:formdesc',
        [':company'=>$companypk,':formid'=>$formpk,':categoryid'=>$category,':formdesc'=>$formdesc])->asArray()->one();                
        if($type==1){            
            $returndatapks=MemcompproddtlsTbl::find()->select('group_concat(MemCompProdDtls_Pk) as pks')
            ->where('MCPrD_MemberCompMst_Fk=:company and mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus is not null', [ ':company'=>$companypk])->asArray()->one(); 
            $stringPks=!empty($returndatapks['pks'])?$returndatapks['pks']:0;   
            if(!empty($stringPks)){
                $product =  MemcompproddtlsTbl::getProdlist($companypk,'YES',$stringPks);
                $dataModel=$product->getModels();
                foreach($dataModel as $key => $value){
                    $reportOFprdSer =$this->statussection($SCFWholeStatus,$value,'prductstatus');
                    if($stkholdertype==15 || ($stkholdertype==6 && $origin=='N')){
                        $divsector = MemcompbussrcdtlsTbl::getbsdivsecbybr($value['branchpk']);
                        if(count($divsector['actarr']) == 1) {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0];
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0];
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0] . " (+" . (count($divsector['actarr'])-1) . ")";
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0] . " (+" . (count($divsector['actarr_ar'])-1) . ")";
                        }
                        $dataModel[$key]['division_name']=$divsector['divname'];
                        $dataModel[$key]['sector_name_arr'] = $divsector['actarr'];
                        $dataModel[$key]['sector_name_val'] = implode(",",$divsector['actarr']);
                        $dataModel[$key]['sector_name_ar_arr'] = $divsector['actarr_ar'];
                    }
                    else{
                        $buspk = $value['group_bsourcepk'];
                        $sector_mapped = \app\models\MemcompbussrcsectormapTbl::find()->select(['*'])
                        ->leftJoin('sectormst_tbl','SectorMst_Pk = mcbssm_sectormst_fk')
                        ->leftJoin('memcompbussrcdtls_tbl', 'memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk')
                        ->leftJoin('memcompsectordtls_tbl', 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk')
                        ->where("mcbssm_memcompbussrcdtls_fk in ($buspk)")
                        ->groupBy("SectorMst_Pk")
                        ->asArray()
                        ->all();
                        $sector_name = [];
                        foreach($sector_mapped as $key1 => $val) {
                            $sector_name[] = $val['SecM_SectorName'];
                        }
                        $dataModel[$key]['sector_name_arr'] = $sector_name;
                        $dataModel[$key]['sector_name_val'] = implode(",",$sector_name);
                        $dataModel[$key]['sector_name_ar_arr'] = $sector_name_ar;
                        if(count($sector_name) > 0) {
                            if(count($sector_name) == 1) {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0];
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0];
                            } else {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0] . " (+" . (count($sector_name)-1) . ")";
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0] . " (+" . (count($sector_name_ar)-1) . ")";
                            }
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = "-";
                            $dataModel[$key]['sector_name_ar_minimal'] = "-";
                        }
                    }
                    $dataModel[$key]['finalstatus']=$reportOFprdSer['finalstatus'];
                    $dataModel[$key]['popupcontent']=$reportOFprdSer['popupcontent'];
                    $dataModel[$key]['class']=$reportOFprdSer['class'];
                    $dataModel[$key]['svg']=$reportOFprdSer['svg'];
                    $memcompfile_pk = Security::encrypt($value['filedetails']);
                    $user_pk = Security::encrypt($value['uploadby']);             
                    $img_path = \common\components\Drive::generateUrl($value['cover_id'],$value['cover_comp_id'],$value['cover_uploadedby']);
                    $dataModel[$key]['docurl'] =\common\components\Drive::generateUrl($value['mcmppd_permitfile'],$companypk,$userpk,1);
                    $bsValid = \common\models\MemcompbussrcdtlsTbl::find()
                        ->where('mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2 and memcompbussrcdtls_pk=:busid',
                            [':company'=>$companypk,':busid'=>$value['memcompbussrcdtls_pk']])->asArray()->one();
                    $dataModel[$key]['bs_comments']=$bsValid['mcbsd_appdeclcomments'];
                    $dataModel[$key]['bs_status']=$bsValid['mcbsd_scfadminstatus'];
                    $dataModel[$key]['comments']=$value['mcprd_appdeclcomments'];
                    $dataModel[$key]['status']=$value['MCPrD_SVFAdminApprovalStatus'];
                    $dataModel[$key]['overallstatus']=$SCFWholeStatus['scftt_status'];
                    $dataModel[$key]['overallcomments']=$SCFWholeStatus['scftt_appdeclcomments'];
                    $dataModel[$key]['image_url'] = $img_path;
                }
            }
        }elseif($type==2){
            $returndatapks=MemcompservicedtlsTbl::find()->select('group_concat(MemCompServDtls_Pk) as pks')
            ->where('MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus is not null', [ ':company'=>$companypk])->asArray()->one(); 
            $stringPks=!empty($returndatapks['pks'])?$returndatapks['pks']:0;   
            if(!empty($stringPks)){
                $service = MemcompservicedtlsTbl::getServicelist($companypk,'YES',$stringPks);
                $dataModel=$service->getModels();
                foreach($dataModel as $key => $value){
                    $reportOFprdSer =$this->statussection($SCFWholeStatus,$value,'servicestatus');
                    if($stkholdertype==15 || ($stkholdertype==6 && $origin=='N')){
                        $divsector = MemcompbussrcdtlsTbl::getbsdivsecbybr($value['branchpk']);
                        if(count($divsector['actarr']) == 1) {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0];
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0];
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0] . " (+" . (count($divsector['actarr'])-1) . ")";
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0] . " (+" . (count($divsector['actarr_ar'])-1) . ")";
                        }
                        $dataModel[$key]['division_name']=$divsector['divname'];
                        $dataModel[$key]['sector_name_arr'] = $divsector['actarr'];
                        $dataModel[$key]['sector_name_val'] = implode(",",$divsector['actarr']);
                        $dataModel[$key]['sector_name_ar_arr'] = $divsector['actarr_ar'];
                    }
                    else{
                        $buspk = $value['group_bsourcepk'];
                        $sector_mapped = \app\models\MemcompbussrcsectormapTbl::find()->select(['*'])
                        ->leftJoin('sectormst_tbl','SectorMst_Pk = mcbssm_sectormst_fk')
                        ->leftJoin('memcompbussrcdtls_tbl', 'memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk')
                        ->leftJoin('memcompsectordtls_tbl', 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk')
                        ->where("mcbssm_memcompbussrcdtls_fk in ($buspk)")
                        ->groupBy("SectorMst_Pk")
                        ->asArray()
                        ->all();
                        $sector_name = [];
                        foreach($sector_mapped as $key1 => $val) {
                            $sector_name[] = $val['SecM_SectorName'];
                        }
                        $dataModel[$key]['sector_name_arr'] = $sector_name;
                        $dataModel[$key]['sector_name_val'] = implode(",",$sector_name);
                        $dataModel[$key]['sector_name_ar_arr'] = $sector_name_ar;
                        if(count($sector_name) > 0) {
                            if(count($sector_name) == 1) {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0];
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0];
                            } else {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0] . " (+" . (count($sector_name)-1) . ")";
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0] . " (+" . (count($sector_name_ar)-1) . ")";
                            }
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = "-";
                            $dataModel[$key]['sector_name_ar_minimal'] = "-";
                        }
                    }
                    $dataModel[$key]['finalstatus']=$reportOFprdSer['finalstatus'];
                    $dataModel[$key]['popupcontent']=$reportOFprdSer['popupcontent'];
                    $dataModel[$key]['class']=$reportOFprdSer['class'];
                    $dataModel[$key]['svg']=$reportOFprdSer['svg'];
                    $dataModel[$key]['docurl'] =\common\components\Drive::generateUrl($value['mcmppd_permitfile'],$companypk,$userpk,1);
                    $memcompfile_pk = Security::encrypt($value['filedtls']);
                    $user_pk = Security::encrypt($value['uploadby']);
                    $img_path = \common\components\Drive::generateUrl($value['cover_id'],$value['cover_comp_id'],$value['cover_uploadedby']);
                    $bsValid = \common\models\MemcompbussrcdtlsTbl::find()
                    ->where('mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2 and memcompbussrcdtls_pk=:busid',
                    [':company'=>$companypk,':busid'=>$value['memcompbussrcdtls_pk']])->asArray()->one();
                    $dataModel[$key]['comments']=$value['mcsvd_appdeclcomments'];
                    $dataModel[$key]['status']=$value['MCSvD_SVFAdminApprovalStatus'];
                    $dataModel[$key]['bs_comments']=$bsValid['mcbsd_appdeclcomments'];
                    $dataModel[$key]['bs_status']=$bsValid['mcbsd_scfadminstatus'];
                    $dataModel[$key]['overallstatus']=$SCFWholeStatus['scftt_status'];
                    $dataModel[$key]['overallcomments']=$SCFWholeStatus['scftt_appdeclcomments'];
                    $dataModel[$key]['image_url'] = $img_path;
                }
            }
        }
        $dataModelret=empty($stringPks)?[]:$dataModel;                   
        $cumlativePrServArr=['pks'=>$stringPks,'datasets'=> $dataModelret,'scfstatus'=>$SCFWholeStatus->scfmt_scfstatus];
        return $this->asJson($cumlativePrServArr);
    }
    public function actionGetbussrcdata(){
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $data = SuppcertformpartrntmpTbl::getScfmapBusinesssrc($companypk);        
        return $this->asJson([
            'datasets'=> $data
        ]);
    }
    public function actionValidationcontact(){
        $userdetreturn = UsermstTbl::getvalidationcontactdet();        
        return $this->asJson($userdetreturn);
    }
    public function actionGetsharedetdata(){
        $shreturn=MemcompshareholderdtlsTbl::getShareholderscf();
        return $this->asJson($shreturn);
    }    
    public function actionGetomantenderdata(){
        $omantenderreturn=\common\models\MemcomptendbrdtempTblQuery::getomantenderdet();
        return $this->asJson($omantenderreturn);
    }
    public function actionGetomantendermaplist(){
        $omantenderreturn=\common\models\MemcomptendbrdtempTblQuery::getomantendermaplist();
        return $this->asJson($omantenderreturn);
    }
    public function actionGetbranchdetdata(){
        $branchdetreturn= MemcompbranchdtlstempTblQuery::getbranchdet();
        return $this->asJson($branchdetreturn);
    }
    public function actionGetbranchmaplist(){
        $branchdetreturn= MemcompbranchdtlstempTblQuery::getbranchmaplist();
        return $this->asJson($branchdetreturn);
    }
    public function actionGetbsbranchmaplist(){
        $branchdetreturn= MemcompbranchdtlstempTblQuery::getbsbranchmaplist();
        return $this->asJson($branchdetreturn);
    }
    public function actionGetfinancialdata(){
        $financialetreturn=\common\models\MemcompfinancialtempTblQuery::getfinancialdata();
        return $this->asJson($financialetreturn);
    }
    public function actionGetcompbasicdet(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
        if(!empty($getdata)){
            $compdata['origin'] = $getdata['MCM_Origin'];
            $compdata['companyPk'] = $getdata['MemberCompMst_Pk'];
            $compdata['userPk'] = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
            $compdata['extprofile'] = $getdata['mcm_externalproflink'];
        }
        return $compdata;
    }   
    public function actionSavecertformdetails(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $savesection=\common\models\SuppcertformpartrntmpTbl::saveparamdetprocess($data);
        return $this->asJson([
            'data' => ($savesection ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);
    }
    public function actionSavecertformcategorydetails(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $savesection=\common\models\SuppcertformmembtmpTbl::savecategorymultiplsdetprocess($data);
        return $this->asJson([
            'data' => ($savesection ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);
    }
    public function actionGetstatuscategorylevel(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != undefined){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
           $RegPk=$getdata->MCM_MemberRegMst_Fk;
        }else{
            $RegPk=\yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk',true);
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        }        
        $category = \common\components\Security::sanitizeInput($_REQUEST['category'],"number");
        $formpk = \common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $stktype = \common\components\Security::sanitizeInput($_REQUEST['stktype'],"number");
        if(in_array($stktype, [1,6,15])){
            $formMemtmp = SuppcertformmembtmpTbl::find()->joinWith('suppcertcattmp')
                ->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company and scfct_bgivaldoccatmst_fk=:category',
                [':formpk'=>$formpk,':company'=>$companypk,':category'=>$category])->one();
        }else{
             $formMemtmp= \common\models\SuppcertformmembdtlsTbl::find()->joinWith('suppcertformcatdtls')
                ->where('scfmd_formmst_fk=:formpk and scfmd_membercompmst_fk=:company and scfcd_bgivaldoccatmst_fk=:category',
                [':formpk'=>$formpk,':company'=>$companypk,':category'=>$category])->one();
        }
        $returndatacertdata=[];
        if(in_array($stktype, [1,6,15])){
            $switchvalue=$formMemtmp->suppcertcattmp[0]->scfct_isapplicable;
            $returndatacertdata['categorystatus']=$formMemtmp->suppcertcattmp[0]->scfct_status;
        }else{
            $switchvalue=$formMemtmp->suppcertformcatdtls[0]->scfcd_isapplicable;
            $returndatacertdata['categorystatus']='';
        }    
        if(is_null($switchvalue)){
            $returndatacertdata['switchtext']='none';
        }else if($switchvalue==1 || $switchvalue==2) {
            $returndatacertdata['switchtext'] = $switchvalue==1?'Yes':'No';
        }else if($switchvalue==0) {
            $returndatacertdata['switchtext'] = 'No';
        }
        if(is_null($switchvalue)){
            $returndatacertdata['switchstatus']='';
        }else if($switchvalue ==1){
            $returndatacertdata['switchstatus']='1';
        }else{
            $returndatacertdata['switchstatus']='0';
        }
        if(in_array($stktype, [1,6,15])){
            $returndatacertdata['suppformid'] = $formMemtmp->suppcertformmembtmp_pk;
            $returndatacertdata['suppcatid'] =  $formMemtmp->suppcertcattmp[0]->suppcertformcattmp_pk;
            $returndatacertdata['categorycomments']=$formMemtmp->suppcertcattmp[0]->scfct_appdeclcomments;
            $returndatacertdata['infocontent']=$formMemtmp->suppcertcattmp[0]->scfct_comment;
            if($stktype == 1){
                $levelSubCatValidation = CertcatsubcatapprovaldtlsTbl::find()
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk=ccscad_certapprovaldtls_fk')
                ->innerJoin('suppcertformcattmp_tbl', 'ccscad_suppcertformcattmp_fk=suppcertformcattmp_pk')
                ->where([
                    'cad_membercompanymst_fk' => $companypk,
                    'scfct_bgivaldoccatmst_fk' => $category
                ])
                ->andWhere('ccscad_suppcertformtrntmp_fk IS NULL')
                ->orderby('certapprovaldtls_pk desc')
                ->one();
                $showvalidationsumm = \api\modules\mst\models\ApprovalworkflowuserconfigTbl::find()
                ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                ->innerJoin('certcatsubcatapprovaldtls_tbl', 'ccscad_certapprovaldtls_fk=certapprovaldtls_pk')
                ->innerJoin('suppcertformcattmp_tbl', 'ccscad_suppcertformcattmp_fk=suppcertformcattmp_pk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')            
                ->where(['awfcd_formmst_fk' => $formpk,'cad_membercompanymst_fk' => $companypk,'scfct_bgivaldoccatmst_fk' => $category,
                    'frm_isworkflowapprapplicable' => 1])->groupBy("scfct_bgivaldoccatmst_fk")
                ->andWhere('ccscad_suppcertformtrntmp_fk IS NULL')->count();
                $returndatacertdata['leveluserstatus'] = (!empty($levelSubCatValidation) && $levelSubCatValidation['ccscad_status'] ) ? $levelSubCatValidation['ccscad_status']  : null;
                $returndatacertdata['levelusercomments'] = (!empty($levelSubCatValidation) && $levelSubCatValidation['ccscad_comments'] ) ? $levelSubCatValidation['ccscad_comments']  : null;
                $returndatacertdata['showvalidationsumm'] = !empty($showvalidationsumm) && $showvalidationsumm >= 1 ? 1 : 0;
            }
        }else{
            $returndatacertdata['categorycomments']='';
            $returndatacertdata['infocontent']=$formMemtmp->suppcertformcatdtls[0]->scfcd_comment;
        }
        return $returndatacertdata;
    }
    public function actionSavecategorycomments(){
        $SaveCommentsCategory=SuppcertformcattmpTbl::savecomments();
        return $this->asJson($SaveCommentsCategory);
    }
    public function actionDeletecategorycomments(){
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $category=\common\components\Security::sanitizeInput($_REQUEST['category'],"number");
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $MemCompModel=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk =:company',
            [":form"=>$formpk,":company"=>$companypk])->one();
        if(!empty($MemCompModel)){
            $CatTmpModel=SuppcertformcattmpTbl::find()->where('scfct_suppcertformmembtmp_fk=:memtmp and scfct_bgivaldoccatmst_fk=:category',
                [':memtmp'=>$MemCompModel->suppcertformmembtmp_pk,':category'=>$category])->one();
            if(!empty($CatTmpModel)){
                $CatTmpModel->scfct_comment=NULL;
                $CatTmpModel->save(false);
            }
            if(in_array($CatTmpModel->scfct_status,[2,3])){
             $CatTmpModel->scfct_status=4;
            }
            else{
            $CatTmpModel->scfct_status=1;
            }
            $CatTMpModel->scfct_submittedon=date('Y-m-d H:i:s');
            $CatTMpModel->scfct_submittedby=$userpk;
            \common\components\Suppcertform::datainsertionsfmenu($companypk,$formpk);
        }
        return $this->asJson($CatTmpModel);
    }
    public function actionSavenonmantswitch(){
        $SaveCategory=SuppcertformcattmpTbl::saveswitchdet();
        return $this->asJson([
            'data' => ($SaveCategory ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);    
    }
    public function actionSavenonmantswitchcomments(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);   
        $SaveCategory=SuppcertformcattmpTbl::saveswitchwithcommentsdet($data);
        return $this->asJson([
            'data' => ($SaveCategory ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);    
    }
    public function actionDeleteswitchdata(){
        $deleteCategory=SuppcertformcattmpTbl::changeswitchdet();
        return $this->asJson([
            'data' => ($deleteCategory ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);    
    }
    public function actionDeletecatwisemutipledata(){
        $deleteCategory=SuppcertformcattmpTbl::deletecatwisemutipledata();        
        return $this->asJson([
            'data' => ($deleteCategory ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);  
    }
    public function actionDeletesubcatwisemutipledata(){
        $deletesubCategory=\common\models\SuppcertformpartrntmpTbl::deletesubcatwisemutipledata();        
        return $this->asJson([
            'data' => ($deletesubCategory ? 1 : 2),
            'msg' => 'S',
            'status' => 200,
        ]);  
    }
    public function actionGetsmedata(){
        $isMandatory = \common\components\Suppcertform::getsmedata();
        return $this->asJson([
            'data' => $isMandatory,
            'msg' => 'S',
            'status' => 200,
        ]);  
    }
    public function actionGetisiccateg(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);   
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id']) && $_REQUEST['id'] != 'undefined'){
           $companypk = \common\components\Security::decrypt($_REQUEST['id']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $branchid = $data['branchdetid'];
        $returndata = MemcompbranchdtlstempTblQuery::getisicactlistdata($branchid,$companypk);
        return $this->asJson([
            'data' => $returndata,
            'msg' => 'S',
            'status' => 200,
        ]);  
    }
    public function actionGetcocgradedet(){
        $grademst =  \common\models\CocgrademstTbl::find()
        ->select(['cocgrademst_pk as id','cgm_gradename_en as gradename_en',
            'cgm_gradename_ar as gradename_ar'])
        ->where("cgm_status=1")->asArray()->all();
        return $this->asJson([
            'data' => $grademst,
            'msg' => 'S',
            'status' => 200,
        ]);  
    }
    public function actionScfcheck(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $stakeholdertype=\yii\db\ActiveRecord::getTokenData('reg_type', true);
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $errorList=[];
        $status=[];
        $pos=0;
        $formdec=2;
        $origin=\yii\db\ActiveRecord::getTokenData('MCM_Origin',true);
        $MemCompModel=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk =:company',
            [":form"=>$formpk,":company"=>$companypk])->one();        
        if($MemCompModel->scfmt_scfstatus == 'A'){
            $errorList[$pos]['msg']="You have not updated any Categories. Update at least one Category.";
            $errorList[$pos]['cat']='';
        }else{
            if($stakeholdertype == 15 || ($stakeholdertype == 6 && $origin == 'N')){
                // Certification Contact
                $cercontactContact=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>1])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                $deccercontactContact=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_scfstatus=4 and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>1])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                // corporate
                $Corporate=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2 and scfptt_bgivaldocsubcatmst_fk in(5,6)',
                [':company'=>$companypk,':cat'=>2])->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                $decCorporate=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_scfstatus=4 and scfptt_isdeleted=2 and scfptt_bgivaldocsubcatmst_fk in(5,6)',
                [':company'=>$companypk,':cat'=>2])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                // Oman Tender
                $omantendercat=  SuppcertformcattmpTbl::find()
                ->select(['scfct_isapplicable','scfct_status'])
                ->where('scfct_suppcertformmembtmp_fk=:formmembtmp and scfct_bgivaldoccatmst_fk=3 ',
                [':formmembtmp'=>$MemCompModel->suppcertformmembtmp_pk])->asArray()->one(); 
                $omantender=\common\models\MemcomptendbrdtempTbl::find()
                ->where('mctbt_membcompmst_fk=:comp and mctbt_isdeleted=2 and mctbt_scfstatus is not null',[':comp'=>$companypk])->count();
                // branch details
                $branchdetcat=  SuppcertformcattmpTbl::find()
                ->select(['scfct_isapplicable','scfct_status'])
                ->where('scfct_suppcertformmembtmp_fk=:formmembtmp and scfct_bgivaldoccatmst_fk=4',
                [':formmembtmp'=>$MemCompModel->suppcertformmembtmp_pk])->asArray()->one(); 
                $branchdet=MemcompbranchdtlstempTbl::find()
                ->where('mcbdt_memcompmst_fk=:comp and mcbdt_isdeleted=2 and mcbdt_scfstatus is not null',[':comp'=>$companypk])->count();
                $branchheadqutdet=MemcompbranchdtlstempTbl::find()
                ->where('mcbdt_memcompmst_fk=:comp and mcbdt_isdeleted=2 and mcbdt_scfstatus is not null and  mcbdt_officetypemst_fk = 12',
                [':comp'=>$companypk])->count();
                // Financial
                $finacialvatCat=  SuppcertformcattmpTbl::find()
                ->select(['scfct_isapplicable','scfct_status'])
                ->where('scfct_suppcertformmembtmp_fk=:formmembtmp and scfct_bgivaldoccatmst_fk=5',
                [':formmembtmp'=>$MemCompModel->suppcertformmembtmp_pk])->asArray()->one(); 
                $finacialsubcat=\common\models\MemcompfinancialtempTbl::find()
                ->where('mcft_membcompmst_fk=:comp and mcft_isdeleted=2 and mcft_scfstatus is not null',[':comp'=>$companypk])->count();
                $vatsubcat = SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat and scfptt_bgivaldocsubcatmst_fk =:subcat
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>5,':subcat'=>8])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                $prd= \common\models\MemcompproddtlsTbl::find()
                ->where('MCPrD_MemberCompMst_Fk=:company and mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus is not null',
                [':company'=>$companypk])->count();
                $Service= \common\models\MemcompservicedtlsTbl::find()
                ->where('MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus is not null',
                [':company'=>$companypk])->count();
                $decprd=\common\models\MemcompproddtlsTbl::find()
                ->where('MCPrD_MemberCompMst_Fk=:company and mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus= "D" ',
                [':company'=>$companypk])->count();
                $decService=\common\models\MemcompservicedtlsTbl::find()
                ->where('MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus= "D" ',
                [':company'=>$companypk])->count();
                $decbusiness=\common\models\MemcompbussrcdtlsTbl::find()
                  ->where('mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2 and mcbsd_scfadminstatus= "D" ',
                  [':company'=>$companypk])->count();
                // Ministry of Labour
                $mol=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>8])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                $decmol=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_scfstatus=4 and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>8])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                // Riyada
                $Riyadacat=  SuppcertformcattmpTbl::find()
                ->select(['scfct_isapplicable','scfct_status'])
                ->where('scfct_suppcertformmembtmp_fk=:formmembtmp and scfct_bgivaldoccatmst_fk=9',
                [':formmembtmp'=>$MemCompModel->suppcertformmembtmp_pk])->asArray()->one(); 
                $Riyada =SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>9])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                // shareholder
                $shareholddetcat=  SuppcertformcattmpTbl::find()
                ->select(['scfct_isapplicable','scfct_status'])
                ->where('scfct_suppcertformmembtmp_fk=:formmembtmp and scfct_bgivaldoccatmst_fk=10',
                [':formmembtmp'=>$MemCompModel->suppcertformmembtmp_pk])->asArray()->one(); 
                $shareholddet=\common\models\MemcompshareholderdtlsTbl::find()
                ->where('mcshd_memcompmst_fk=:comp and mcshd_isdeleted=2',[':comp'=>$companypk])->count();
                $smefinmand = \common\components\Suppcertform::getsmedata();
                if($deccercontactContact > 0){
                    $errorList[$pos]['msg']='RABT Certification Contact has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/1' : '/cert/sccert/1';
                    $pos++;
                }
                if($cercontactContact == 0){
                    $errorList[$pos]['msg']='RABT Certification Contact is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/1' : '/cert/sccert/1';
                    $pos++;
                }
                if($decCorporate > 0 ){
                    $errorList[$pos]['msg']='Corporate Summary has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/2' : '/cert/sccert/2';
                    $pos++;
                }
                if($Corporate<2 || empty($Corporate)){
                    $errorList[$pos]['msg']='Corporate Summary is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/2' : '/cert/sccert/2';
                    $pos++;
                }
                if($omantendercat['scfct_status'] == '3'){
                    $errorList[$pos]['msg']='Oman Tender Board Registration has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/3' : '/cert/sccert/3';
                    $pos++;
                }
                if(empty($omantendercat) || ($omantendercat['scfct_isapplicable'] ==1 && $omantender == 0)){
                    $errorList[$pos]['msg']='Oman Tender Board Registration is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/3' : '/cert/sccert/3';
                    $pos++;
                }     
                if($branchdetcat['scfct_status'] == '3'){
                    $errorList[$pos]['msg']='Branch Details has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/4' : '/cert/sccert/4';
                    $pos++;
                }
                if(empty($branchdetcat) || $branchdet == 0){
                    $errorList[$pos]['msg']='Branch Details is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/4' : '/cert/sccert/4';
                    $pos++;
                }  
                if(!empty($branchdetcat) && $branchdet > 0 && $branchheadqutdet == 0){
                    $errorList[$pos]['msg']='Kindly map Headquarters in Branch Details';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/4' : '/cert/sccert/4';
                    $pos++;
                }  
                if($finacialvatCat['scfct_status'] == '3'){
                    $errorList[$pos]['msg']='Financials has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/5' : '/cert/sccert/5';
                    $pos++;
                }
                if(empty($finacialvatCat) || ($finacialsubcat == 0 && $smefinmand == 1) || $vatsubcat == 0){
                    $errorList[$pos]['msg']='Financials is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/5' : '/cert/sccert/5';
                    $pos++;
                }  
                if($decprd > 0 || $decService > 0 ) {
                    $errorList[$pos]['msg'] = $stakeholdertype == 6 ? 'Products/Services has been declined.' : 'Finished Goods/Services has been declined.';
                    $errorList[$pos]['cat']= $stakeholdertype == 15 ? '/cert/oissrcert/7' : '/cert/sccert/6';
                    $pos++;
                }
                if($decbusiness > 0) {
                    $errorList[$pos]['msg'] = 'Business Source has been declined';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/7' : '/cert/sccert/6';
                    $pos++;
                }
                if($Service == 0 && $prd == 0) {
                    $errorList[$pos]['msg'] = $stakeholdertype == 6 ? 'Products/Services is not yet filled.' : 'Finished Goods/Services is not yet filled.';
                    $errorList[$pos]['cat']= $stakeholdertype == 15 ? '/cert/oissrcert/7' : '/cert/sccert/6';
                    $pos++;
                }
                if($decmol > 0){
                    $errorList[$pos]['msg']='Ministry of Labour - Employee Details has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/8' : '/cert/sccert/8';
                    $pos++;
                }
                if($mol == 0){
                    $errorList[$pos]['msg']='Ministry of Labour - Employee Details is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/8' : '/cert/sccert/8';
                    $pos++;
                }
                if($Riyadacat['scfct_status'] == '3'){
                    $errorList[$pos]['msg']='Riyada Certificate has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/9' : '/cert/sccert/9';
                    $pos++;
                }
                if(empty($Riyadacat) || ($Riyadacat['scfct_isapplicable'] ==1 && $Riyada == 0)){
                    $errorList[$pos]['msg']='Riyada Certificate is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/9' : '/cert/sccert/9';
                    $pos++;
                }
                if($shareholddetcat['scfct_status'] == '3'){
                    $errorList[$pos]['msg']='Shareholder Information has been declined.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/10' : '/cert/sccert/10';
                    $pos++;
                }
                if(empty($shareholddetcat) || ($shareholddetcat['scfct_isapplicable'] ==1 && $shareholddet == 0)){
                    $errorList[$pos]['msg']='Shareholder Information is not yet filled.';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/10' : '/cert/sccert/10';
                    $pos++;
                }     
            } elseif($stakeholdertype == 6 && $origin == 'I'){
                $cercontactContact=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>1])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                $deccercontactContact=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_scfstatus=4 and scfptt_isdeleted=2',[':company'=>$companypk,':cat'=>1])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                // corporate
                $Corporate=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_isdeleted=2 and scfptt_bgivaldocsubcatmst_fk =5',
                [':company'=>$companypk,':cat'=>2])->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                $decCorporate=SuppcertformpartrntmpTbl::find()->where('scfptt_bgivaldoccatmst_fk=:cat 
                and scfptt_membercompmst_fk=:company and scfptt_scfstatus=4 and scfptt_isdeleted=2 and scfptt_bgivaldocsubcatmst_fk =5',
                [':company'=>$companypk,':cat'=>2])
                ->groupBy('scfptt_bgivaldocsubcatmst_fk')->count();
                // product and service
                  $prd= \common\models\MemcompproddtlsTbl::find()
                  ->where('MCPrD_MemberCompMst_Fk=:company and mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus is not null',[':company'=>$companypk])->count();
                  $Service= \common\models\MemcompservicedtlsTbl::find()
                  ->where('MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus is not null',[':company'=>$companypk])->count();
                  $decprd=\common\models\MemcompproddtlsTbl::find()
                  ->where('MCPrD_MemberCompMst_Fk=:company and mcprd_isdeleted=2 and MCPrD_SVFAdminApprovalStatus= "D" ',
                  [':company'=>$companypk])->count();
                  $decService=\common\models\MemcompservicedtlsTbl::find()
                  ->where('MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2 and MCSvD_SVFAdminApprovalStatus= "D" ',
                  [':company'=>$companypk])->count();
                  $decbusiness=\common\models\MemcompbussrcdtlsTbl::find()
                  ->where('mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2 and mcbsd_scfadminstatus= "D" ',
                  [':company'=>$companypk])->count();
                  if($deccercontactContact > 0){
                    $errorList[$pos]['msg']='RABT Certification Contact is declined';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/1' : '/cert/sccert/1';
                    $pos++;
                }
                if($cercontactContact== 0){
                    $errorList[$pos]['msg']='RABT Certification Contact is not yet filled';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/1' : '/cert/sccert/1';
                    $pos++;
                }
                if($decCorporate > 0 ){
                    $errorList[$pos]['msg']='Corporate Summary is declined';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/2' : '/cert/sccert/2';
                    $pos++;
                }
                if($Corporate == 0){
                    $errorList[$pos]['msg']='Corporate Summary is not yet filled';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/2' : '/cert/sccert/2';
                    $pos++;
                }
                if($decprd > 0 || $decService > 0) {
                    $errorList[$pos]['msg'] = 'Products / Services has been declined';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/2' : '/cert/sccert/2';
                    $pos++;
                }
                if($decbusiness > 0) {
                    $errorList[$pos]['msg'] = 'Business Source has been declined';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/2' : '/cert/sccert/2';
                    $pos++;
                }
                if($Service == 0 && $prd == 0) {
                    $errorList[$pos]['msg'] = 'Products / Services is not yet filled';
                    $errorList[$pos]['cat']=$stakeholdertype == 15 ? '/cert/oissrcert/6' : '/cert/sccert/6';
                    $pos++;
                }
            }                   
        }        
        $errorList1=!empty($errorList)?$errorList:'';
        if(in_array($MemCompModel->scfmt_scfstatus,['D','DI']) && !empty($errorList1)){
            $formdec=1;
        } elseif($MemCompModel->scfmt_scfstatus == 'A'){
            $formdec=4;
        } elseif(!in_array($MemCompModel->scfmt_scfstatus,['D','DI','A']) && !empty($errorList1)){
            $formdec=2;
        }  else{
            $formdec=3;
        }
         return $this->asJson(['errorList'=>$errorList1,'status'=>$formdec]);
    }
    public function actionSubmitscf(){        
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != 'undefined'){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $MemCompModel=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk =:company',
            [":form"=>$formpk,":company"=>$companypk])->one();
        if($MemCompModel->scfmt_scfstatus =='I'){   
            $MemCompModel->scfmt_scfstatus='S';
            $MemCompModel->scfmt_submittedon=date('Y-m-d H:i:s');
            $MemCompModel->scfmt_submittedby=$userpk;
            $MemCompModel->save(false);    
            \common\components\Suppcertform::scfauditloginsertion($companypk,3,'',$userpk);  
            \common\components\Suppcertform::scfsendMailRabt($userpk,'suppTobackendapproval');//2.1  
        }elseif($MemCompModel->scfmt_scfstatus =='UI'){
            $MemCompModel->scfmt_scfstatus='U';
            $MemCompModel->scfmt_updatedon=date('Y-m-d H:i:s');
            $MemCompModel->scfmt_updatedby=$userpk;
            $MemCompModel->save(false);
            $level1userpk = \common\components\Suppcertform::getleveloneuserid($formpk);
            \common\components\Suppcertform::datainsertiontoapprovaltable($companypk,$formpk,$level1userpk);
            \common\components\Suppcertform::mainhistytableinsertion($companypk,1,0);
            \common\components\Suppcertform::scfauditloginsertion($companypk,5,'',$userpk);
            \common\components\Suppcertform::scfsendMailRabt($userpk,'suppTobackendUpdateApproval');//5.1  
        }elseif($MemCompModel->scfmt_scfstatus == 'DI'){
            $MemCompModel->scfmt_scfstatus='RS';
            $MemCompModel->scfmt_submittedon=date('Y-m-d H:i:s');
            $MemCompModel->scfmt_submittedby=$userpk;
            $MemCompModel->save(false);
            $level1userpk = \common\components\Suppcertform::getleveloneuserid($formpk);
            \common\components\Suppcertform::datainsertiontoapprovaltable($companypk,$formpk,$level1userpk);
         \common\components\Suppcertform::mainhistytableinsertion($companypk,1,0); 
            \common\components\Suppcertform::scfauditloginsertion($companypk,4,'',$userpk);
            if(empty($MemCompModel->scfmt_certgenerated)){
                \common\components\Suppcertform::scfsendMailRabt($userpk,'suppTobackendRSapproval');//4.1   
            }else{
                \common\components\Suppcertform::scfsendMailRabt($userpk,'suppTobackendCertAfterDecline');//8.1   
            }            
        }
        return $this->asJson($MemCompModel);
    }    
    public function actionGetproductsummaryexport(){
        $compPk = \common\components\Security::decrypt($_REQUEST['cid']);
        $userPk = \common\components\Security::decrypt($_REQUEST['uid']);
        $formid = $_REQUEST['form'];
         \common\components\Suppcertform::getproductsummaryexp($formid,$compPk,$userPk,1);
    }
    public function actionGetservicessummaryexport(){
        $compPk = \common\components\Security::decrypt($_REQUEST['cid']);
        $userPk = \common\components\Security::decrypt($_REQUEST['uid']);
        $formid = $_REQUEST['form'];
         \common\components\Suppcertform::getservicessummaryexp($formid,$compPk,$userPk,1);
    }   
    public function actionCheckformstatus(){
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regtype = \yii\db\ActiveRecord::getTokenData('reg_type', true);
        $formpk=$_GET['form'];
        $isaccessava = 1;//  allow supplier to access SCF form 
        if($regtype == 6 ||$regtype == 15 ){
            $formMemtmp=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk =:formid and scfmt_membercompmst_fk=:company',
            [':company'=>$companypk,':formid'=>$formpk])->one();
            if(!empty($formMemtmp) && in_array($formMemtmp->scfmt_scfstatus, ['S','U','RS'])){
                $isaccessava = 2;// not to allow supplier to access SCF form 
            }
        }        
        return $this->asJson([
            'isaccessava' => $isaccessava,
            'msg' => 'S',
            'status' => 200,
        ]);
    }
    public function actionTocheckstatusforintropage(){
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $formpk=$_GET['form'];
        $jsrscertbtnname = 2;// apply button name
        \common\components\Suppcertform::datainsertionsfmenu($companypk,$formpk);
        $formMemtmp=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk =:formid and scfmt_membercompmst_fk=:company',
        [':company'=>$companypk,':formid'=>$formpk])->one();
        if(!empty($formMemtmp) && $formMemtmp->scfmt_scfstatus != 'I'){
            $jsrscertbtnname = 1;//view
        }
        return $this->asJson([
            'jsrscertbtnname' => $jsrscertbtnname,
            'msg' => 'S',
            'status' => 200,
        ]);
    }
    public function actionGetvatorriyadano(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);   
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $type = $data['type'];
        $certnumb = \app\models\MemcompadditonalinfoTbl::find()->select(['mcai_certnumber','mcai_yesno'])
        ->where("mcai_membercompanymst_fk=:company and mcai_certtype =:type",[':company'=>$companypk,'type'=>$type])->asArray()->one();
        $retdata = (!empty($certnumb) && !empty($certnumb['mcai_certnumber']) ? $certnumb['mcai_certnumber'] : NULL);
        $optdata = (!empty($certnumb) && !empty($certnumb['mcai_yesno']) ? $certnumb['mcai_yesno'] : NULL);
        return $this->asJson(['numb'=>$retdata,'option'=>$optdata]);
    }
    public function actionGetuservalidationaccess(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != undefined){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $levelaccess = [];
        $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        $leveluser = \api\modules\mst\models\FormmstTbl::find()
            ->select(['awfuc_approvallevel as approvalaccess','group_concat(awfs_bgivaldoccatmst_fk) as categoryaccespk',
                'group_concat(awfs_bgivaldocsubcatmst_fk) as subcategoryaccespk','group_concat(awfs_bgivaldoccatpardtls_fk) as categparamaccespk',
                'group_concat(awfs_bgivaldoccatpardtls_fk) as subcategparamaccespk','awfct_level','awfuc_orderofapp','approvalworkflowuserconfig_pk'])
            ->leftJoin('approvalworkflowconfigdtls_tbl','awfcd_formmst_fk=formmst_pk and awfcd_status =1')
            ->leftJoin('approvalworkflowconfigtrns_tbl','awfct_approvalworkflowconfigdtls_fk=approvalworkflowconfigdtls_pk')
            ->leftJoin('approvalworkflowuserconfig_tbl','awfuc_approvalworkflowconfigtrns_fk=approvalworkflowuserconfigtrns_pk')
            ->leftJoin('approvalworkflowspec_tbl','awfs_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
            ->where("awfuc_usermst_fk=:userpk and formmst_pk=:formpk and frm_isworkflowapprapplicable=:workflowapp",
            [':userpk'=>$userpk,'formpk'=>$formpk,'workflowapp'=>1])
            ->groupBy("awfs_approvalworkflowuserconfig_fk")->asArray()->one();
        $MemCompModel=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk =:company',
        [":form"=>$formpk,":company"=>$companypk])->one();
        $userconfid = $leveluser['approvalworkflowuserconfig_pk'];
        $levelSuppMemtbl = CertapprovaldtlsTbl::find()
                    ->where("cad_suppcertformmembtmp_fk=:suppcert  and find_in_set($userconfid, cad_approvalworkflowuserconfig_fk)", 
                    [':suppcert'=> $MemCompModel->suppcertformmembtmp_pk])->orderBy("certapprovaldtls_pk desc")->one();
        $approvaldettbl = CertapprovaldtlsTbl::find()                
        ->where(['cad_suppcertformmembtmp_fk' => $MemCompModel->suppcertformmembtmp_pk])->orderBy("certapprovaldtls_pk desc")->one();
        $currentlevelval = 1;
        if(!empty($approvaldettbl)){
            $levelSuppparttmptbl = CertcatsubcatapprovaldtlsTbl::find()
            ->where('ccscad_certapprovaldtls_fk=:crtapd and ccscad_suppcertformtrntmp_fk is NULL',[':crtapd'=> $approvaldettbl->certapprovaldtls_pk])->orderBy("certcatsubcatapprovaldtls_pk desc")->one();
            $currentlevelval = !empty($levelSuppparttmptbl)  ? ($levelSuppparttmptbl->ccscad_movedtonxtlevel  == 2 ? (int)$levelSuppparttmptbl->ccscad_level +1 : (int)$levelSuppparttmptbl->ccscad_level ) : 1;
        }
        $Isusrvalcompeted = 2;
        if(!empty($MemCompModel) && $MemCompModel->scfmt_scfstatus == 'S' && (($leveluser['awfct_level'] == $currentlevelval && empty($approvaldettbl)) || ($leveluser['awfct_level'] == $currentlevelval && !empty($approvaldettbl) && !empty($levelSuppMemtbl) &&$levelSuppMemtbl->cad_actioncompleted == 1))){
            $Isusrvalcompeted = 1;
        } elseif(!empty($MemCompModel) && in_array($MemCompModel->scfmt_scfstatus,['U','RS']) && (!empty($levelSuppMemtbl) && $levelSuppMemtbl->cad_actioncompleted == 1)){
                $Isusrvalcompeted = 1;
        }
        $levelaccess['approvallevelaccess'] = $Isusrvalcompeted;
        if(!empty($leveluser)){
            $levelaccess['approvalaccess'] = (int)$leveluser['approvalaccess'];
            $levelaccess['categoryaccesid'] = !empty($leveluser['categoryaccespk']) ? array_map('intval', explode(",", $leveluser['categoryaccespk'])) : [];
            $levelaccess['subcategoryaccesid'] = !empty($leveluser['subcategoryaccespk']) ? array_map('intval', explode(",", $leveluser['subcategoryaccespk'])) : [];
            $levelaccess['categparamaccesid'] = !empty($leveluser['categparamaccespk']) ? array_map('intval', explode(",", $leveluser['categparamaccespk'])) : [];
            $levelaccess['subcategparamaccesid'] = !empty($leveluser['subcategparamaccespk']) ? array_map('intval', explode(",", $leveluser['subcategparamaccespk'])) : [];
        }else{
            $levelaccess['approvalaccess'] = 2;
            $levelaccess['categoryaccesid'] = [];
            $levelaccess['subcategoryaccesid'] = [];
            $levelaccess['categparamaccesid'] = [];
            $levelaccess['subcategparamaccesid'] = [];
        }
        return $this->asJson([
            'data' => $levelaccess,
            'msg' => 'S',
            'status' => 200,
        ]);
    }
    public function actionDownloadsummary(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $ComPk = \common\components\Security::decrypt($_REQUEST['ComPk']);
        $UserPk = \common\components\Security::decrypt($_REQUEST['UserPk']);
        $Formid = $_REQUEST['Formid'];
        $proddetails = \common\components\Suppcertform::getproductsummaryexp($Formid,$ComPk,$UserPk,2);
        $servdetails = \common\components\Suppcertform::getservicessummaryexp($Formid,$ComPk,$UserPk,2);
        if($Formid == 1){
            $fileProdserv='finishedGoods'.$ComPk.date('dmy');
            $folder=dirname(__FILE__).'/../../backend/documents/finishedGoods/';
        }
        elseif($Formid == 2){
            $fileProdserv='prodserv'.$ComPk.date('dmy');
            $folder=dirname(__FILE__).'/../../backend/documents/prodserv/';
        }
        $retdata = \common\components\Suppcertform::prdsercreatezip($proddetails,$servdetails,$fileProdserv,$folder,$Formid);
        if($retdata == 1){   
            if (file_exists($folder .$fileProdserv.'.zip')){                                 
                header("Content-Length:". filesize($folder .$fileProdserv.'.zip'));
                header('Content-Type: application/zip'); 
                header('Content-Type: application/octet-stream');
                header("Content-Disposition: attachment; filename = $fileProdserv.zip");
                header('Content-Transfer-Encoding: binary');
                @readfile($folder .$fileProdserv.'.zip');
                exit;
            }
            else{
                echo "File doesn't exist";exit;
            }
        }
        else{
            echo "File doesn't exist there";exit;
        }
    }
    public function actionGetscfcompanyinformation(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($data['compk']);
        $stkholder = $data['formid'] == 1? 15 : 6;
        $dataModel =  \common\models\SuppcertformmembtmpTblQuery::getscfcompanyinformation($compk,$stkholder);
        $totallevel = \api\modules\mst\models\ApprovalworkflowconfigtrnsTbl::find()->select(['awfct_level as totalLevels'])->asArray()->all();
        $cumlativeArr=['dataModel'=>$dataModel,'totallevelsconfigured'=>max($totallevel)];
        return $this->asJson($cumlativeArr);
    }    
    public function actionGetuserslist(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $level = $data['level'];
        $formid = $data['formid'];
        $users = \api\modules\mst\models\ApprovalworkflowuserconfigTblQuery::getusers($level,$formid);
        return $this->asJson([
            'users' => $users,
            'flag' => 'S',
            'status' => 200,
        ]);
    }
    public function actionGetbusinesssourceval(){
            $valuserpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
            $category=\common\components\Security::sanitizeInput($_REQUEST['category'],"number");
            if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
                $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
                $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
                $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
            }else{
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
                $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            }
            $businesrcpk = $_REQUEST['bid'];
            $businesrcnamepk = $_REQUEST['bnid'];
            $businessret = \common\models\MemcompbussrcdtlsTbl::getvalidateBusinesssouceprdser($companypk,$businesrcpk,$businesrcnamepk);
            if(!empty($businessret)){
                foreach ($businessret as $key => $value) {
                    $prdcount =  \common\models\MemcompbussrcdtlsTbl::find()
                    ->select("memcompbussrcdtls_pk, count(distinct MemCompProdDtls_Pk) as 'mapped_products'")
                    ->innerJoin("businesssourcemst_tbl","mcbsd_businesssourcemst_fk = businesssourcemst_pk")
                    ->leftJoin("memcompprodbussrcmap_tbl","memcompbussrcdtls_pk = mcpbsm_memcompbussrcdtls_fk")
                    ->leftJoin("memcompservbussrcmap_tbl","memcompbussrcdtls_pk = mcsbsm_memcompbussrcdtls_fk")
                    ->leftJoin("memcompproddtls_tbl","mcpbsm_memcompproddtls_fk = MemCompProdDtls_Pk and mcprd_isdeleted = 2")
                    ->where('memcompbussrcdtls_pk =:bid and MCPrD_MemberCompMst_Fk=:company and mcprd_isdeleted=2 '
                            . 'and MCPrD_SVFAdminApprovalStatus is not null', 
                    [':company'=>$companypk,'bid'=> $value['bid']])
                    ->asArray()->one();
                    $sercount =  \common\models\MemcompbussrcdtlsTbl::find()
                    ->select("memcompbussrcdtls_pk, count(distinct MemCompServDtls_Pk) as 'mapped_services'")
                    ->innerJoin("businesssourcemst_tbl","mcbsd_businesssourcemst_fk = businesssourcemst_pk")
                    ->leftJoin("memcompprodbussrcmap_tbl","memcompbussrcdtls_pk = mcpbsm_memcompbussrcdtls_fk")
                    ->leftJoin("memcompservbussrcmap_tbl","memcompbussrcdtls_pk = mcsbsm_memcompbussrcdtls_fk")
                   ->leftJoin("memcompservicedtls_tbl","mcsbsm_memcompservdtls_fk = MemCompServDtls_Pk and mcsvd_isdeleted = 2")
                    ->where('memcompbussrcdtls_pk =:bid and MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2 '
                            . 'and MCSvD_SVFAdminApprovalStatus is not null', 
                    [':company'=>$companypk,'bid'=> $value['bid']])
                    ->asArray()->one();
                    if(((int)$prdcount['mapped_products'] + (int)$sercount['mapped_services']) == 0) {
                        unset($businessret[$key]);
                        continue;
                    }
                    $businessret[$key]['canvalidateprdser'] = 2;
                    $businessret[$key]['Ncertfilepath'] = '';
                    $businessret[$key]['NcertfileName'] = '';
                    $businessret[$key]['Ncertfileext'] = '';
                    $businessret[$key]['NcertfileextTXT'] = '';
                    $businessret[$key]['certfilepath'] = '';
                    $businessret[$key]['certfileName'] = '';
                    $businessret[$key]['certfileext'] = '';
                    $businessret[$key]['certfileextTXT'] = '';
                    $businessret[$key]['productcnt'] = $prdcount['mapped_products'];
                    $businessret[$key]['servicescnt'] = $sercount['mapped_services'];
                    if(!empty($value['ndocs'])){
                        $businessret[$key]['Ncertfilepath'] = Drive::generateUrl($value['ndocs'], $companypk, $userpk);
                        $Fildtls=MemcompfiledtlsTbl::findOne($value['ndocs']);
                        $arrFile=pathinfo($Fildtls->mcfd_origfilename)['extension'];
                        $businessret[$key]['NcertfileName'] = $Fildtls->mcfd_origfilename;
                        $businessret[$key]['Ncertfileext'] = strtolower($arrFile);
                        $businessret[$key]['NcertfileextTXT'] = 'View';
                    }
                    if(!empty($value['permitdocs'])){
                        $businessret[$key]['certfilepath'] = Drive::generateUrl($value['permitdocs'], $companypk, $userpk);
                        $Fildtls=MemcompfiledtlsTbl::findOne($value['permitdocs']);
                        $arrFile=pathinfo($Fildtls->mcfd_origfilename)['extension'];
                        $businessret[$key]['certfileName'] = $Fildtls->mcfd_origfilename;
                        $businessret[$key]['certfileext'] = strtolower($arrFile);
                        $businessret[$key]['certfileextTXT'] = 'View';
                    }
                    $isshowvalsumy = \api\modules\mst\models\MemcompbussrcapprovaldtlsTbl::find()
                    ->where("mcbsad_memcompbussrcdtls_fk = :busdet",[':busdet'=>$value['bid']])->exists();
                    $businessret[$key]['isshowvalsumy'] = $isshowvalsumy ? 1 : 2;
                    $levelbusinessValidation = \api\modules\mst\models\MemcompbussrcapprovaldtlsTbl::find()
                        ->innerJoin('memcompbussrcapprovalmain_tbl', 'memcompbussrcapprovalmain_pk=mcbsad_memcompbussrcapprovalmain_fk')
                        ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk=mcbsam_certapprovaldtls_fk')
                        ->innerJoin('memcompbussrcdtls_tbl', 'mcbsad_memcompbussrcdtls_fk=memcompbussrcdtls_pk')
                        ->where([
                            'mcbsad_memcompbussrcdtls_fk'=> $value['bid'],
                            'cad_membercompanymst_fk' => $companypk,
                        ])->orderBy("certapprovaldtls_pk desc")->asArray()->one();
                    if(!empty($levelbusinessValidation) && $levelbusinessValidation['mcbsad_status'] == 1){
                        $businessret[$key]['canvalidateprdser'] = 1;
                    }                    
                   // $statusarr = [1=>,2=>];
                    $businessret[$key]['busscfsts'] = !empty($levelbusinessValidation) &&  !empty($levelbusinessValidation['mcbsad_status']) ? $levelbusinessValidation['mcbsad_status'] : 0 ;
                    $businessret[$key]['busscomts'] = !empty($levelbusinessValidation) &&  !empty($levelbusinessValidation['mcbsad_comments']) ? $levelbusinessValidation['mcbsad_comments'] : '' ;
                    $businessret[$key]['isnatprd'] = (empty($value['mcbsd_hasnatprod']) ? 2: $value['mcbsd_hasnatprod']);
                }
            }
            $cumlativeArr=['datasets'=> $businessret];
            return $this->asJson($cumlativeArr);
        }
        public function actionGetmasterbusinesssorce(){
            if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
                $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
            }else{
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            }
            $returndata= \common\models\BusinesssourcemstTbl::find()
                ->select(['businesssourcemst_pk as bid', 'bsm_bussrcname as bsname_en','bsm_bussrcname_ar as bsname_ar'])
                    ->leftJoin('memcompbussrcdtls_tbl', 'mcbsd_businesssourcemst_fk = businesssourcemst_pk')
                ->where('mcbsd_scfadminstatus is not null and mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2', [':company'=>$companypk])
                ->orderBy('bsm_bussrcname ASC')
                    ->groupBy(['businesssourcemst_pk'])
                ->asArray()
                ->all();  
            $cumlativeArr=['datasets'=> $returndata];
            return $this->asJson($cumlativeArr);
        }
        public function actionGetmstbusinesssorcename(){
            if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
                $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
            }else{
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            }
            $businesrcpk = $_REQUEST['brcid'];
             if(!empty($businesrcpk)){
                 $returndata= \common\models\MemcompbussrcdtlsTbl::find()
                    ->select(['memcompbussrcdtls_pk as bid', 'mcbsd_refname as bsname'])
                    ->where('mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2 and mcbsd_scfadminstatus is not null',[':company'=>$companypk])
                    ->andWhere('mcbsd_businesssourcemst_fk=:bussorcpkpks',[':bussorcpkpks'=>$businesrcpk])
                    ->orderBy('mcbsd_refname ASC')
                    ->groupBy(['memcompbussrcdtls_pk'])
                    ->asArray()
                    ->all();  
             }else{
                $returndata= \common\models\MemcompbussrcdtlsTbl::find()
                    ->select(['memcompbussrcdtls_pk as bid', 'mcbsd_refname as bsname'])
                    ->where('mcbsd_membercompanymst_fk=:company and mcbsd_isdeleted=2 and mcbsd_scfadminstatus is not null',[':company'=>$companypk])
                    ->orderBy('mcbsd_refname ASC')
                    ->groupBy(['memcompbussrcdtls_pk'])
                    ->asArray()
                    ->all();  
             }
            $cumlativeArr=['datasets'=> $returndata];
            return $this->asJson($cumlativeArr);
        }
        public function actionGetbusinessrcsproduct(){
            if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
                $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
            }else{
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            }
            $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
            $businesssorpk = $_REQUEST['brcid'];
            $SCFWholeStatus=SuppcertformmembtmpTbl::find()
            ->where('scfmt_formmst_fk=:formid and scfmt_membercompmst_fk=:company',[':company'=>$companypk,':formid'=>$formpk])->one();            
            $productreturndatapks=MemcompproddtlsTbl::find()->select('group_concat(MemCompProdDtls_Pk) as pks')
            ->where('MCPrD_SVFAdminApprovalStatus is not null and MCPrD_MemberCompMst_Fk=:company  and mcprd_isdeleted=2',
                [':company'=>$companypk])->asArray()->one();
            $stringPks=!empty($productreturndatapks['pks'])?$productreturndatapks['pks']:0;
            if(!empty($stringPks)){
                $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                $levelUser = \api\modules\mst\models\CertapprovaldtlsTbl::find()
                ->select(['certapprovaldtls_pk'])            
                ->where('cad_membercompanymst_fk=:compk',[':compk' => $companypk])->orderBy("certapprovaldtls_pk desc")->asArray()->one();   
                $product = MemcompproddtlsTbl::getBusinesssrcProdlist($companypk,$stringPks,$businesssorpk,$levelUser['certapprovaldtls_pk']);
                $dataModel=$product->getModels();
                foreach($dataModel as $key => $value){            
                    if($value['origin']=='N'){
                        $divsector = MemcompbussrcdtlsTbl::getbsdivsecbybr($value['branchpk'],$companypk);
                        if(count($divsector['actarr']) == 1) {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0];
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0];
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0] . " (+" . (count($divsector['actarr'])-1) . ")";
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0] . " (+" . (count($divsector['actarr_ar'])-1) . ")";
                        }
                        $dataModel[$key]['division_name']=$divsector['divname'];
                        $dataModel[$key]['sector_name_arr'] = $divsector['actarr'];
                        $dataModel[$key]['sector_name_val'] = implode(",",$divsector['actarr']);
                        $dataModel[$key]['sector_name_ar_arr'] = $divsector['actarr_ar'];
                    }
                    else{
                        $buspk = $value['group_bsourcepk'];
                        $sector_mapped = \app\models\MemcompbussrcsectormapTbl::find()->select(['*'])
                        ->leftJoin('sectormst_tbl','SectorMst_Pk = mcbssm_sectormst_fk')
                        ->leftJoin('memcompbussrcdtls_tbl', 'memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk')
                        ->leftJoin('memcompsectordtls_tbl', 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk')
                        ->where("mcbssm_memcompbussrcdtls_fk in ($buspk)")
                        ->groupBy("SectorMst_Pk")
                        ->asArray()
                        ->all();
                        $sector_name = [];
                        foreach($sector_mapped as $key1 => $val) {
                            $sector_name[] = $val['SecM_SectorName'];
                        }
                        $dataModel[$key]['sector_name_arr'] = $sector_name;
                        $dataModel[$key]['sector_name_val'] = implode(",",$sector_name);
                        $dataModel[$key]['sector_name_ar_arr'] = $sector_name_ar;
                        if(count($sector_name) > 0) {
                            if(count($sector_name) == 1) {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0];
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0];
                            } else {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0] . " (+" . (count($sector_name)-1) . ")";
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0] . " (+" . (count($sector_name_ar)-1) . ")";
                            }
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = "-";
                            $dataModel[$key]['sector_name_ar_minimal'] = "-";
                        }
                    }
                    $isshowvalsumy = \api\modules\mst\models\MemcompprodapprovaldtlsTbl::find()
                    ->where("mcpad_memcompproddtls_fk = :prddet",[':prddet'=>$value['MemCompProdDtls_Pk']])->exists();
                    $dataModel[$key]['isshowvalsumy'] = $isshowvalsumy ? 1 : 2;
                    $dataModel[$key]['prductstatus']=!empty($value['prductstatus']) ? $value['prductstatus'] : 0;
                    $dataModel[$key]['prductcmts']=!empty($value['mcpad_comments']) ? $value['mcpad_comments'] : '';
                    $img_path = \common\components\Drive::generateUrl($value['cover_id'],$value['cover_comp_id'],$value['cover_uploadedby']);
                    $dataModel[$key]['docurl'] =\common\components\Drive::generateUrl($value['mcmppd_permitfile'],$companypk,$value['uploadby'],1);
                    $dataModel[$key]['comments']=$value['mcprd_appdeclcomments'];
                    $dataModel[$key]['status']=$value['MCPrD_SVFAdminApprovalStatus'];
                    $dataModel[$key]['image_url'] = $img_path;
                }                
            }
            $dataModelret =empty($stringPks)?[]:$dataModel;            
            $cumlativePrServArr=['pks'=>$stringPks,'datasets'=> $dataModelret,'scfstatus'=>$SCFWholeStatus->scfmt_scfstatus];
            return $this->asJson($cumlativePrServArr);
        }
        public function actionGetbusinessrcservices(){
            if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
                $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
            }else{
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            }
            $businesssorpk = $_REQUEST['brcid'];
            $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
            $SCFWholeStatus=SuppcertformmembtmpTbl::find()
            ->where('scfmt_formmst_fk=:formid and scfmt_membercompmst_fk=:company',[':company'=>$companypk,':formid'=>$formpk])->one();
            $sroductreturndatapks=MemcompservicedtlsTbl::find()->select('group_concat(MemCompServDtls_Pk) as pks')
            ->where('MCSvD_SVFAdminApprovalStatus is not null and MCSvD_MemberCompMst_Fk=:company and mcsvd_isdeleted=2',
                [':company'=>$companypk])->asArray()->one();
            $stringPks=!empty($sroductreturndatapks['pks'])?$sroductreturndatapks['pks']:0;            
            if(!empty($stringPks)){
                $levelUser = \api\modules\mst\models\CertapprovaldtlsTbl::find()
                ->select(['certapprovaldtls_pk'])            
                ->where('cad_membercompanymst_fk=:compk',[':compk' => $companypk])->orderBy("certapprovaldtls_pk desc")->asArray()->one();                 
                $service = MemcompservicedtlsTbl::getbussinessService($companypk,$stringPks,$businesssorpk,$levelUser['certapprovaldtls_pk']);
                $dataModel=$service->getModels();
                foreach($dataModel as $key => $value){
                    if($value['origin']=='N'){
                        $divsector = MemcompbussrcdtlsTbl::getbsdivsecbybr($value['branchpk'],$companypk);
                        if(count($divsector['actarr']) == 1) {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0];
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0];
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = $divsector['actarr'][0] . " (+" . (count($divsector['actarr'])-1) . ")";
                            $dataModel[$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0] . " (+" . (count($divsector['actarr_ar'])-1) . ")";
                        }
                        $dataModel[$key]['division_name']=$divsector['divname'];
                        $dataModel[$key]['sector_name_arr'] = $divsector['actarr'];
                        $dataModel[$key]['sector_name_val'] = implode(",",$divsector['actarr']);
                        $dataModel[$key]['sector_name_ar_arr'] = $divsector['actarr_ar'];
                    }
                    else{
                        $buspk = $value['group_bsourcepk'];
                        $sector_mapped = \app\models\MemcompbussrcsectormapTbl::find()->select(['*'])
                        ->leftJoin('sectormst_tbl','SectorMst_Pk = mcbssm_sectormst_fk')
                        ->leftJoin('memcompbussrcdtls_tbl', 'memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk')
                        ->leftJoin('memcompsectordtls_tbl', 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk')
                        ->where("mcbssm_memcompbussrcdtls_fk in ($buspk)")
                        ->groupBy("SectorMst_Pk")
                        ->asArray()
                        ->all();
                        $sector_name = [];
                        foreach($sector_mapped as $key1 => $val) {
                            $sector_name[] = $val['SecM_SectorName'];
                        }
                        $dataModel[$key]['sector_name_arr'] = $sector_name;
                        $dataModel[$key]['sector_name_val'] = implode(",",$sector_name);
                        $dataModel[$key]['sector_name_ar_arr'] = $sector_name_ar;
                        if(count($sector_name) > 0) {
                            if(count($sector_name) == 1) {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0];
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0];
                            } else {
                                $dataModel[$key]['sector_name_minimal'] = $sector_name[0] . " (+" . (count($sector_name)-1) . ")";
                                $dataModel[$key]['sector_name_ar_minimal'] = $sector_name_ar[0] . " (+" . (count($sector_name_ar)-1) . ")";
                            }
                        } else {
                            $dataModel[$key]['sector_name_minimal'] = "-";
                            $dataModel[$key]['sector_name_ar_minimal'] = "-";
                        }
                    }
                    $isshowvalsumy = \api\modules\mst\models\MemcompserviceapprovaldtlsTbl::find()
                    ->where("mcsad_memcompservicedtls_fk = :servdet",[':servdet'=>$value['MemCompServDtls_Pk']])->exists();
                    $dataModel[$key]['isshowvalsumy'] = $isshowvalsumy ? 1 : 2;
                    $dataModel[$key]['appservicestatus'] = !empty($value['appservicestatus']) ? $value['appservicestatus'] : 0;
                    $dataModel[$key]['appservicecmts'] = !empty($value['mcsad_comments']) ? $value['mcsad_comments'] : '';
                    $dataModel[$key]['docurl'] =\common\components\Drive::generateUrl($value['mcmppd_permitfile'],$companypk,$value['uploadby'],1);                    
                    $img_path = \common\components\Drive::generateUrl($value['cover_id'],$value['cover_comp_id'],$value['cover_uploadedby']);
                    $dataModel[$key]['comments']=$value['mcsvd_appdeclcomments'];
                    $dataModel[$key]['status']=$value['MCSvD_SVFAdminApprovalStatus'] ;
                    $dataModel[$key]['image_url'] = $img_path;
                }
            }            
            $dataModelret =empty($stringPks)?[]:$dataModel;
            $cumlativePrServArr=['pks'=>$stringPks,'datasets'=> $dataModelret,'scfstatus'=>$SCFWholeStatus->scfmt_scfstatus];
            return $this->asJson($cumlativePrServArr);
        }
}
