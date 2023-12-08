<?php
namespace api\modules\ep\controllers;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Exprofile;
use common\components\Configsession; 
use \common\components\Security;
use \common\components\Common;
use \common\components\Extprof;
use common\models\MembercompanymstTbl;
use common\models\MemcompacomplishdtlsTbl;
use common\models\SupportcollateraldtlsTbl;
use \common\components\Drive;

class ExprofileController extends EpMasterController
{

    public $modelClass = '\common\models\MemcompprofcertfdtlsTbl';
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

    /**
     * @SWG\Post(
     *     path="/ep/exprofile/getproductdetails",
     *     tags={"Get Product Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="product_id", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
    */

    public function actionGetproductdetails() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Exprofile::getproductdetails($data);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/ep/exprofile/getservicedetails",
     *     tags={"Get Product Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="service_id", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
    */

    public function actionGetservicedetails() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Exprofile::getServiceDetails($data);
        return $data;
    }
    

    /**
     * @SWG\Post(
     *     path="/ep/exprofile/getproductdetailstabdata",
     *     tags={"Get Product Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="product_id", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
    */

    public function actionGetproductdetailstabdata() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Exprofile::getproductdetailstabdata($data);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/ep/exprofile/getservicedetailstabdata",
     *     tags={"Get Product Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="service_id", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
    */

    public function actionGetservicedetailstabdata() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Exprofile::getServiceDetailsTabData($data);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/ep/exprofile/getmanufacturerdata",
     *     tags={"Get Product Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="product_id", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
    */

    public function actionGetmanufacturerdata() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Exprofile::getmanufacturerdata($data);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/ep/exprofile/getlogisticinfo",
     *     tags={"Get Product Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get Logistic Info",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="factoryPk", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
    */

    public function actionGetlogisticinfo() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $factoryPk = Security::decrypt($data['factoryPk']);
        $factoryPk = Security::sanitizeInput($factoryPk, "number");
        $data = Exprofile::getLogisticInfoData($factoryPk);
        return $data;
    }
    public function actionGetspecifcation() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Exprofile::getspecifcation($data);
        return $data;
    }

    public function actionGetnumberconverstion() {
        $number = $_REQUEST['num'];
        if($number) {
            $count = Common::numberConversionNew($number);
        }
        return $count;
    }

    public function actionGetproductid() {
        $lypisid = $_REQUEST['lypisid'];

        $data = Exprofile::getproductid($lypisid);
        return $data;
    }

    
    public function actionGetserviceid() {
        $lypisid = $_REQUEST['lypisid'];

        $data = Exprofile::getserviceid($lypisid);
        return $data;
    }
    
    public function actionDivision(){
        $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }     
        if(!empty($extprofname)){
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            return $extprof->getDivision();
        }
        return [];
    }
    
    public function actionBussrcdtl(){
        $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
        $bussrc_pk = (!empty($_REQUEST['bsid']) && is_numeric($_REQUEST['bsid'])) ? $_REQUEST['bsid'] : '';
        if(!empty($extprofname) && !empty($bussrc_pk)){
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            return $extprof->getBusSrcDtl($bussrc_pk);
        }
        return [];
    }
    public function actionGethomepagedata(){
        
        ini_set('max_execution_time', 0);
        $ipaddress = Common::getIpAddress();
        $islogin = (!empty($_REQUEST['id']) && is_string($_REQUEST['id'])) ? $_REQUEST['id'] : '';
        $logincompk = '';
        if($islogin == 1){
            $logincompk =  \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        }       
        $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
        $extprof = new Extprof($extprofname,$iscompanypk,6);
        $contrCount = \api\modules\pms\models\CmsawarddtlsTbl::find()
            ->where('cmsad_isprimarycontractor=:contr and cmsad_memcompmst_fk=:compk',[':contr'=>'1',':compk'=>$extprof->comppk])->count();
         
        if(!empty($extprof->compdata)){
            $sc_bannerpath=Yii::$app->params['baseUrl']."assets/images/SupplierBanner.jpg";
            $sc_link=Yii::$app->params['baseUrl'].'externalprofile/'.$extprof->compdata->mcm_externalproflink;
            $ymd=date('Ymd');
            $hitcount = \common\models\HitcountmstTbl::find()
            ->where('hcm_ipaddress=:ipaddress and hcm_pageviewed=:pageview and hcm_viewed_mcm_fk=:compk and 
               date_format(hcm_vieweddate,"%Y%m%d")=:datetoday',[':ipaddress'=>$ipaddress,':pageview'=>'EP',':compk'=>$extprof->comppk,':datetoday'=>$ymd])->one();
            if(empty($hitcount)){
               \common\models\HitcountmstTblQuery::insertdatahitcounttbl($extprof->comppk,$logincompk);
            }
            $counts = \common\models\MembercompanymstTbl::getProductServCountForHomePage($extprof->comppk);
            $products = \common\models\MembercompanymstTbl::getLastFourApprovedProducts($extprof->comppk);
            $services = \common\models\MembercompanymstTbl::getLastFourApprovedServices($extprof->comppk);
            $pdosts = \common\models\MembercompanymstTbl::getpdolccststus($extprof->comppk);

            $tenderboard = \common\models\MemcomptendbrdsecgrddtlsTbl::extproftenderlist($extprof->comppk);
             
            $userpk = $extprof->userpk;
            $validTill = "NIL";
            $editorchangebanner = 1;
            if(!empty($extprof->compdata->mcm_accexpirydate)){
                $validTill = date('d-m-Y',strtotime($extprof->compdata->mcm_accexpirydate));
            }
            foreach($products as $key => $val){
                $memcompfile_pk = Security::encrypt($val['coverPk']);
                $memcomp_pk = Security::encrypt($val['compk']);
                $user_pk = Security::encrypt($val['userpk']);                
                $products[$key]['coverImage'] = Drive::generateUrl($val['coverPk'],$val['compk'],$val['userpk']);
                $products[$key]['defrating'] = (!empty($val['rating']) ? $val['rating'] : '') ;
            }

            foreach($services as $key1 => $val1){
                $memcompfile_pk = Security::encrypt($val1['coverPk']);
                $memcomp_pk = Security::encrypt($val1['compk']);
                $user_pk = Security::encrypt($val1['userpk']);
                $services[$key1]['coverImage'] =  Drive::generateUrl($val1['coverPk'],$val1['compk'],$val1['userpk']);
                $products[$key1]['defrating'] = (!empty($val1['rating']) ? $val1['rating'] : '') ;
            }
             $retbanner = $extprof->compdata->mcm_externalprofbanner;
            if(!empty($retbanner)){
                $editorchangebanner = 2;
                $bannerimgarr = explode(',', $retbanner);
                foreach ($bannerimgarr as $key => $value) {
                    $bannerimage[$key]['imagepath'] = Drive::generateUrl($value,$extprof->comppk,$extprof->userpk);
                }
                $retbannerimage = $bannerimage;
            }else{
                $editorchangebanner = 1;
                $retbannerimage = [];
            }
            $chksupplier360 = 2;
            $showjsrscerticate = false; 
            $isSezdCertified = false; 
            $sezdCertPath='';
            if(!empty($extprof->regdata->MRM_ValSubStatus) && $extprof->regdata->MRM_ValSubStatus == 'A' && $extprof->regdata->MRM_MemberStatus != 'I' ){
                $chksupplier360 = 1;
                $showjsrscerticate = true; 
                $sezdDtl=$extprof->compdata->sezddtl;
                if(!empty($sezdDtl)){
                    $imgPath=Yii::$app->params['JSRS_v2_baseURL']."images/sezad/cert/".$sezdDtl->srd_regcertificate; // sezd we don't have image file in j2 in j3 we have to convert pdf as img 
                    $isSezdCertified=true;
                    $sezdCertPath=$imgPath;
                }
                
            }

            $certificatearray = [];
            if($showjsrscerticate){
                $certifgen = \common\components\Suppcertform::getsuppliercertificate($extprof->comppk);                
                if(!empty($certifgen)){
                $certificatearray[0]['name'] = "JSRS Certificate";
                $certificatearray[0]['imagepath'] = $certifgen;
                $certificatearray[0]['certinfo'] = "Primary Certification";
                if($isSezdCertified){ 
                    $certificatearray[1]['name'] = "SEZD Certificate"; 
                    $pathLink="";
                    if(!empty($sezdCertPath)){
                        $pathLink=substr($sezdCertPath, 0, -4);
                    }
                    //$certificatearray[1]['imagepath'] = $pathLink.".jpg";
                    $certificatearray[1]['imagepath'] = $sezdCertPath;
                    $certificatearray[1]['certinfo'] = "Additional Certification";
                    $certificatearray[1]['imagepathsezd'] = Yii::$app->params['JSRS_v2_baseURL']."images/email/images/sezdtemp.png";;

                }
            }elseif($sezdCertPath){
                $certificatearray[0]['name'] = "SEZD Certificate";
                $pathLink="";
                if(!empty($sezdCertPath)){
                    $pathLink=substr($sezdCertPath, 0, -4);
                }
                $certificatearray[0]['imagepath'] = $sezdCertPath;
                $certificatearray[0]['certinfo'] = "Additional Certification";
                $certificatearray[0]['imagepathsezd'] = Yii::$app->params['JSRS_v2_baseURL']."images/email/images/sezdtemp.png";;
            }            
            }          

            $totalview = \common\models\HitcountmstTbl::find()
            ->where('hcm_pageviewed=:pageview and hcm_viewed_mcm_fk=:compk',[':pageview'=>'EP',':compk'=>$extprof->comppk])->count();
            $response = [];
            $response['smbanner'] = $sc_bannerpath;  
            $response['sc_link'] = $sc_link;  
            $response['counts'] = $counts;
            $response['products'] = $products;
            $response['services'] = $services;

            $response['tenderboard'] = $tenderboard;
            $response['retbannerimage'] = $retbannerimage;
            $response['companyDetails']['sezd'] = $isSezdCertified;
            $response['companyDetails']['totalview'] = $totalview;
            $response['companyDetails']['companyName'] = $extprof->compdata->MCM_CompanyName;
            $response['companyDetails']['origin']  = $extprof->compdata->MCM_Origin;
            $response['companyDetails']['companyLogo'] = \common\components\Drive::generateUrl($extprof->compdata->mcm_complogo_memcompfiledtlsfk,$extprof->comppk,$userpk); 

            $response['companyDetails']['rating'] = (!empty($extprof->compdata->mcm_supplierrating) && $extprof->compdata->mcm_supplierrating != 0.0 ? $extprof->compdata->mcm_supplierrating : '');

            $response['companyDetails']['companyid'] = $extprof->comppk;
            $response['companyDetails']['contrCount'] = $contrCount;
            $response['companyDetails']['rid'] = base64_encode($extprof->compdata->MCM_MemberRegMst_Fk);
            $response['companyDetails']['supplier360sts'] = $chksupplier360;
            $response['companyDetails']['specialsts'] = $pdosts;
            $response['companyDetails']['riyada']['sts'] = false;
    
    
            // if(count($extprof->compdata->memcompRiyada)>0){

            //     $response['companyDetails']['riyada']['sts'] = true;
            //     $response['companyDetails']['riyada']['certifiedon'] = $extprof->compdata->memcompRiyada->mclch_lcccerton;
            // }
           

            $response['companyDetails']['JSRSValSubStatus'] = $extprof->regdata->MRM_ValSubStatus;
            $response['companyDetails']['JSRSRegistrationNo'] = $extprof->compdata->mcm_RegistrationNo;
            $response['companyDetails']['countryPk'] = $extprof->compdata->MCM_Source_CountryMst_Fk;
            $response['companyDetails']['countryname'] = $extprof->compdata->country->CyM_CountryName_en;
            $response['companyLogo'] = \common\components\Drive::generateUrl($extprof->compdata->mcm_complogo_memcompfiledtlsfk,$extprof->comppk,$extprof->userpk);
            $response['companyDetails']['dateofEst'] = !empty($extprof->compdata->MCM_RegistrationYear) ? date('d-m-Y', strtotime($extprof->compdata->MCM_RegistrationYear)) : "";
            $response['companyDetails']['classification'] = $extprof->compdata->classification->ClM_ClassificationType;

            $busdetcount = \common\models\MemcompsectordtlsTbl::getBusinessUnitCounts($extprof->comppk);
            $response['companyDetails']['businessUnitCount'] = $busdetcount;
            $busdet = \common\models\MemcompsectordtlsTbl::getBusinessUnit($extprof->comppk);        
            $response['companyDetails']['businessUnit'] = $busdet;
            $response['companyDetails']['certificateimage'] = $certificatearray;
            if($busdet != 'NIL' && !empty($busdet)){
                $valbus = explode(',', $busdet);        
                if(count($valbus) > 2){
                        $sectcnt = (int)count($valbus) - 2 ;
                        $sectorcntval = "(+". $sectcnt . ")";        
                        $response['companyDetails']['businessunitwithcnt'] = $valbus[0] . ", ".$valbus[1]." " . $sectorcntval ;
                }elseif(count($valbus) != 0 && count($valbus) <= 2){
                    $response['companyDetails']['businessunitwithcnt'] = $busdet;
                } else{
                    $response['companyDetails']['businessunitwithcnt'] = "NIL";
                }    
            }else{
                $response['companyDetails']['businessunitwithcnt'] = "NIL";
            }
             $response['companyDetails']['incorpStyle'] = !empty($extprof->regdata->incorpStyle->ISM_IncorpStyleEntity) ? $extprof->regdata->incorpStyle->ISM_IncorpStyleEntity : "NIL";        
    //        $response['companyDetails']['sectors'] = $extprof->regdata->sector->SecM_SectorName ?? 'NIL';
            $response['companyDetails']['supplierCode'] = !empty($extprof->compdata->MCM_SupplierCode) ? $extprof->compdata->MCM_SupplierCode : "NIL";  
            $response['companyDetails']['memberSince'] = !empty($extprof->regdata->MRM_CreatedOn) ? date('d-m-Y', strtotime($extprof->regdata->MRM_CreatedOn)) : "";
            $response['companyDetails']['validTill'] = !empty($validTill) ? $validTill : "NIL";
            $response['companyDetails']['validity'] = "";
            $response['companyDetails']['aboutus'] = !empty($extprof->compdata->mcm_aboutus) ? html_entity_decode($extprof->compdata->mcm_aboutus) : 'NIL';
            $response['companyDetails']['comdesc'] = strip_tags($response['companyDetails']['aboutus']) ;
            $response['companyDetails']['pathLink'] = $pathLink;

            //get member company master details starts
            
            $response['companyDetails']['mcm'] = \common\models\MembercompanymstTbl::find()
            ->select([
                'MCM_crnumber as crregno',
                'DATE_FORMAT(MCM_RegistrationYear, "%d-%m-%Y") as regYear',
                'mrm_incorpstylemst_fk',
                'ISM_IncorpStyleEntity_en'
            ])
            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
            ->leftJoin('incorpstylemst_tbl','mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
            ->where('membercompmst_pk = :membercompmst_pk',[ ':membercompmst_pk' => $extprof->comppk])
            ->asArray()->one();


            //get member company master details ends
            
            $response['businessUnitList'] = \common\models\MemcompsectordtlsTbl::getSectorDtlInformation($extprof->comppk);
            $response['editorchangebanner'] = $editorchangebanner;
            $instragram = '';
            $facebook = '';
            $twitter = '';
            $linkedin = '';
            $issocialmedia = 2;
            if(!empty($extprof->compdata->mcm_socialmedia)){
                $datamcm_socialmedia = json_decode($extprof->compdata->mcm_socialmedia);
                if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->facebook)){
                    $issocialmedia = 1;
                    $facebook = $datamcm_socialmedia->facebook;
                }
                if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->twitter)){
                    $issocialmedia = 1;
                    $twitter = $datamcm_socialmedia->twitter;
                }
                if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->instagram)){
                    $issocialmedia = 1;
                    $instragram = $datamcm_socialmedia->instagram;
                }
                if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->linkedin)){
                    $issocialmedia = 1;
                    $linkedin = $datamcm_socialmedia->linkedin;
                }
            }
            $response['socialmedia']['issocialmedia']=$issocialmedia;
            $response['socialmedia']['facebook']=$facebook;
            $response['socialmedia']['twitter']=$twitter;
            $response['socialmedia']['instagram']=$instragram;
            $response['socialmedia']['linkedin']=$linkedin;
            $status = 100;
            $message = 'Success';
        }else{
            $response = [];
            $message = 'Mandatory fields are missing';
            $status = 101; 
        }  
        
        return $this->asJson([
            'data' => $response,
            'msg' => $message,
            'status' => $status,
        ]);
        
    }
    
    public function actionGetsuppcolateraldata(){
        $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk =   base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }      
        $extprof = new Extprof($extprofname,$iscompanypk,6);
        $response['supportCollateral'] = \common\models\SupportcollateraldtlsTbl::getSupportCollateralDetails($extprof->comppk, $extprof->userpk);
        return $response;
    }
    
    public function actionSavecontactus() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $iscompanypk = (!empty($data['from'])) ? $data['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
        $extprof = new Extprof($extprofname,$iscompanypk,6);
        $compk = $extprof->comppk;
        $companyname =  $extprof->compdata->MCM_CompanyName;
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        $savedContact = \common\models\ContactusdtlsTbl::saveContactUs($data,$compk,$companyname);
        if($savedContact){
            $extprof->sendContactUsMail($compk);
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }

    public function actionGetAboutCompany(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof = new Extprof($extprofname,$iscompanypk,6);

            $stkFields = ['MemberCompMst_Pk','mcm_aboutus','mcm_vision','mcm_mission','MCM_CompanyName','MCM_crnumber','mcm_complogo_memcompfiledtlsfk'];
            $stkCondition = ['MemberCompMst_Pk'=>$extprof->comppk];
            $fetchData = MembercompanymstTbl::fetchCc($stkCondition, $stkFields, 'one');

            if(!empty($fetchData)){
                $data = [
                    'aboutus'=> (!empty($fetchData->mcm_aboutus) ? html_entity_decode($fetchData->mcm_aboutus) : 'NIL'),
                    'vision'=> (!empty($fetchData->mcm_vision) ? html_entity_decode($fetchData->mcm_vision) : ''),
                    'mission'=>  (!empty($fetchData->mcm_mission) ? html_entity_decode($fetchData->mcm_mission) : ''),
                    'companyName'=>$fetchData->MCM_CompanyName,
                    'regNo'=>$fetchData->MCM_crnumber,
                    'mcpPk'=>$mcpPk,
                    'logo_url' => \common\components\Drive::generateUrl($fetchData->mcm_complogo_memcompfiledtlsfk,$fetchData->MemberCompMst_Pk,$userpk)
                ];
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'No data available';
                $status = 104;
            }
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionGetSupportCollateral(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            $data = SupportcollateraldtlsTbl::getSupportCollateralDetails($extprof->comppk, $extprof->userpk);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }


    public function actionGetAccomplishmentDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            if(!empty($resParam->type)) {
                $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAccomplismentByType($extprof->comppk,$resParam->type,$resParam->size, $resParam->page,$resParam->search);
                $data = $this->arrayFormationwithrelateddocs($accomplishmentDetails, $extprof->userpk);
                if($resParam->type == 1){
                    $data['certificateoverallcount'] = $accomplishmentDetails['overallcount'];
                    $data['certificateCount'] = $accomplishmentDetails['count'];
                    $data['certificateArr'] = $data['certificateArr'];
                }elseif($resParam->type == 2){
                    $data['awardoverallcount'] = $accomplishmentDetails['overallcount'];
                    $data['awardCount'] = $accomplishmentDetails['count'];
                    $data['awardArr'] = $data['awardArr'];
                }elseif($resParam->type == 3){
                    $data['achievementoverallcount'] = $accomplishmentDetails['overallcount'];
                    $data['achievementCount'] = $accomplishmentDetails['count'];
                    $data['achievementArr'] = $data['achievementArr'];
                }
            }else{
                $arr = ['1' => 'certificate', '2' => 'award', '3' => 'achievement'];
                foreach ($arr as $key => $val) {
                    $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAllAccomplisment($extprof->comppk, $key,10);
                    $d = $this->arrayFormationwithrelateddocs($accomplishmentDetails, $extprof->userpk);
                    $data[$val."Arr"] = $d[$val."Arr"];
                    $data[$val."Count"] = $d[$val."Count"];
                    $data[$val."overallcount"] = $d[$val."overallcount"];
                }
            }
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }


    function arrayFormation($accomplishmentDetails, $userpk){
        $userPk = $userpk;
        foreach ($accomplishmentDetails['data'] as $key => $accomplishmentDtl) {
            $uploadUrl = Drive::generateUrl($accomplishmentDtl['mcad_uploadpath'],$accomplishmentDtl['mcad_membercompmst_fk'],$userPk);
            if($accomplishmentDtl['mcad_type'] == 1){
                $data['certificateCount'] = $accomplishmentDetails['count'];
                $data['certificateArr'][] = [
                    'acmpPk'=>$accomplishmentDtl['memcompacomplishdtls_pk'],
                    'title'=>$accomplishmentDtl['mcad_title'],
                    'country'=>$accomplishmentDtl['mcad_countrymst_fk'],
//                    'countryName'=>$accomplishmentDtl['country']->CyM_CountryName_en,
                    'uploadPath'=>$accomplishmentDtl['mcad_uploadpath'],
                    'issuedOn'=>$accomplishmentDtl['mcad_issuedon'],
                    'issuedBy'=>$accomplishmentDtl['mcad_issuedby'],
                    'desc'=>$accomplishmentDtl['mcad_desc'],
                    'type'=>$accomplishmentDtl['mcad_type'],
                    'privacy'=>$accomplishmentDtl['mcad_view'],
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl['mcad_newsurl'],
                    'newsImageUrl'=> $accomplishmentDtl['mcad_newsupload'],
                ];
            }
            if($accomplishmentDtl['mcad_type'] == 2){
                $data['awardCount'] = $accomplishmentDetails['count'];
                $data['awardArr'][] = [
                    'acmpPk'=>$accomplishmentDtl['memcompacomplishdtls_pk'],
                    'title'=>$accomplishmentDtl['mcad_title'],
                    'uploadPath'=>$accomplishmentDtl['mcad_uploadpath'],
                    'issuedOn'=>$accomplishmentDtl['mcad_issuedon'],
                    'issuedBy'=>$accomplishmentDtl['mcad_issuedby'],
                    'desc'=>$accomplishmentDtl['mcad_desc'],
                    'type'=>$accomplishmentDtl['mcad_type'],
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl['mcad_newsurl'],
                    'newsImageUrl'=> $accomplishmentDtl['mcad_newsupload'],
                ];
            }
            if($accomplishmentDtl['mcad_type'] == 3){
                $data['achievementCount'] = $accomplishmentDetails['count'];
                $data['achievementArr'][] = [
                    'acmpPk'=>$accomplishmentDtl['memcompacomplishdtls_pk'],
                    'title'=>$accomplishmentDtl['mcad_title'],
                    'uploadPath'=>$accomplishmentDtl['mcad_uploadpath'],
                    'issuedOn'=>$accomplishmentDtl['mcad_issuedon'],
                    'issuedBy'=>$accomplishmentDtl['mcad_issuedby'],
                    'desc'=>$accomplishmentDtl['mcad_desc'],
                    'type'=>$accomplishmentDtl['mcad_type'],
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl['mcad_newsurl'],
                    'newsImageUrl'=> $accomplishmentDtl['mcad_newsupload'],
                ];
            }
        }

        return $data;
    }

    public function actionGetMarketPresence(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            if(!empty($resParam->type)) {
                $requestdata['compk'] = $extprof->comppk;
                $requestdata['type'] = $resParam->type;
                $requestdata['search'] = $resParam->search;
                $requestdata['size'] = $resParam->size;          
                $requestdata['page'] = $resParam->page;          
            }else{
                $requestdata['compk'] = $extprof->comppk;
            }
            $data = \common\models\MemcompmplocationdtlsTbl::getMarketpresenceListwithpage($requestdata, $extprof->userpk);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionGetBoardOfDirectors(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            if(!empty($resParam->type)) {
                $panel = $resParam->type;
                $search = $resParam->search;
                $size = $resParam->size;          
                $page = $resParam->page;       
                $data = \common\models\BoardmemberdtlsTbl::getBoardOfDirectorswitsearch($extprof->comppk,  $extprof->userpk,$search,$size,$panel,$page);                
            }else{
               $data = \common\models\BoardmemberdtlsTbl::getBoardOfDirectorswitsearch($extprof->comppk,  $extprof->userpk,'',10,'',0);
            }
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionGetWebPresence(){
        ini_set('max_execution_time', 0);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $extprof = new Extprof($resParam->companyProfileId);
            $data = \common\models\MembercompanymstTbl::getExtprofWebPresenceDetails($extprof->comppk);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
     public function actionGetbuyerhomepagedata(){
         $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
         $islogin = (!empty($_REQUEST['id']) && is_string($_REQUEST['id'])) ? $_REQUEST['id'] : '';
         $ipaddress = Common::getIpAddress();
         $ymd=date('Ymd');
         $editorchangebanner = 1;
         $prequalink = '';
          $logincompk = '';         
         $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }       
        $stktyp = \yii\db\ActiveRecord::getTokenData('reg_type',true); 
        $type = ($stktyp == 8) ? 8 : 7 ;
        
        $compdata = \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,$type);
         
         if(!empty($compdata)){
             if($islogin == 1){
                $JSRS_v2_baseURL = \yii\db\ActiveRecord::getTokenData('j2UserEncryptLink',true);   
                $prequalink= $JSRS_v2_baseURL.'&afterlogin=EOI';  
                $logincompk =  \yii\db\ActiveRecord::getTokenData('comp_pk',true);
            }
            $response['boardmemberdet'] = [];
            $response['companyDetails'] = [];
            $response['retbannerimage'] = [];
            $rfxaccess = 2;
            $oprclassification = 'NIL';
            $oprexpire = 'NIL';
            $oprorbuy = 2;
                $hitcount = \common\models\HitcountmstTbl::find()->where('hcm_ipaddress=:ipaddress and hcm_pageviewed=:pageview and 
                    hcm_viewed_mcm_fk=:compk and date_format(hcm_vieweddate,"%Y%m%d")=:datetoday',[':ipaddress'=>$ipaddress,':pageview'=>'EP',
                        ':compk'=>$compdata->MemberCompMst_Pk,':datetoday'=>$ymd])->one();
                if(empty($hitcount)){
                   \common\models\HitcountmstTblQuery::insertdatahitcounttbl($compdata->MemberCompMst_Pk,$logincompk);
                }
                $regdata = $compdata->register;
                $regpk = $regdata->MemberRegMst_Pk;
                $operatorcerti = \common\models\OprjsrscertitrackingTbl::find()->where('ojct_membercompmst_fk =:cmppk',[':cmppk'=>$compdata->MemberCompMst_Pk])->one();
                if(!empty($operatorcerti)){
                    $oprorbuy = 1;
                    $oprclassifarray = [1=> 'Upstream',2=>'Downstream',3=>'Midstream'];
                    $oprclassification = !empty( $operatorcerti->ojct_classification) ?  $oprclassifarray[$operatorcerti->ojct_classification] : "NIL";  
                    $oprexpire =  !empty($operatorcerti->ojct_expiryon) ? date('d-m-Y', strtotime($operatorcerti->ojct_expiryon)) : "NIL";
                }
                if($compdata->register->mrm_stkholdertypmst_fk != 8){
                $buyermoduleaccess = \common\models\OprjsrsaccallocdtlsTbl::find()->where('ojaad_membercompmst_fk=:compk',[':compk'=>$compdata->MemberCompMst_Pk])->one();
                if(!empty($buyermoduleaccess->ojaad_basemodulemst_fk)){
                    $cmsAcc=explode(',',$buyermoduleaccess->ojaad_basemodulemst_fk);
                    if(in_array(7, $cmsAcc)){
                        $rfxaccess = 1;
                    }                    
                }                
                }             
                $userdata = $compdata->register->primaryuser;
                $userpk = $compdata->register->primaryuser->UserMst_Pk;
                if(!empty($compdata->city->CM_CityName_en) && !empty($compdata->state->SM_StateName_en)  && !empty($compdata->mCMCountryMstFk->CyM_CountryName_en) ){
                    $location = $compdata->city->CM_CityName_en . ", ". $compdata->state->SM_StateName_en .", ". $compdata->mCMCountryMstFk->CyM_CountryName_en;
                }elseif( !empty($compdata->state->SM_StateName_en)  && !empty($compdata->mCMCountryMstFk->CyM_CountryName_en)){
                    $location =  $compdata->state->SM_StateName_en .", ". $compdata->mCMCountryMstFk->CyM_CountryName_en;
                } elseif( !empty($compdata->mCMCountryMstFk->CyM_CountryName_en)){
                    $location =  $compdata->mCMCountryMstFk->CyM_CountryName_en;
                }else{
                    $location = "NIL";
                }
                $stockmarket = \common\models\MembcompstokmardtlsTbl::getStockMarketname($compdata->MemberCompMst_Pk);
                $cmpstockname = "NIL";
                $exchangelisted= "NIL";
                if(!empty($stockmarket)){
                    $cmpstockname = !empty($stockmarket["Stockmarketname"]) ? $stockmarket["Stockmarketname"] : "NIL"; 
                    $exchangelisted = !empty($stockmarket["Stockmarketlist"]) ? $stockmarket["Stockmarketlist"] : "NIL"; 
                } 
                
                $domain = $compdata->domain;
                $response['companyDetails']['domainname'] = $domain['DoM_DomainName'];
                $boardmembers = $compdata->boardmemberdtlsTblslimit;
                $response['companyDetails']['aboutus'] = html_entity_decode( !empty($compdata->mcm_aboutus) ? $compdata->mcm_aboutus : "NIL");
                $response['companyDetails']['comdesc'] = strip_tags($response['companyDetails']['aboutus']) ;
                $response['companyDetails']['companyName'] = $compdata->MCM_CompanyName;         
                $response['companyDetails']['companyid'] =$compdata->MemberCompMst_Pk;         
                $response['companyDetails']['rid'] = base64_encode($compdata->MCM_MemberRegMst_Fk);
                $response['companyDetails']['buyercode'] = !empty($regdata->mrm_buyerid) ? $regdata->mrm_buyerid : "NIL";                      
                $response['companyDetails']['brandname'] = !empty($compdata->mcm_brandname) ? $compdata->mcm_brandname : "NIL";  
               
                $response['companyDetails']['omanlngid'] = \Yii::$app->params['operatorDetials']['omanlng']['compPk'];         
                $response['companyDetails']['location'] = $location;         
                $response['companyDetails']['oprorbuy'] = $oprorbuy;  
                $response['companyDetails']['stakeholdertype'] =   $regdata->mrm_stkholdertypmst_fk;  
                $response['companyDetails']['prequallink'] =   $prequalink;
                $response['companyDetails']['oprclassification'] =   $oprclassification;
                $response['companyDetails']['oprexpire'] =   $oprexpire;
                $response['companyDetails']['vatinid'] =   !empty($compdata->mcm_vatinno) ? $compdata->mcm_vatinno : "NIL";    
                $response['companyDetails']['crnumber'] = $compdata->MCM_crnumber;         
                $response['companyDetails']['incorpStyle'] = !empty($regdata->incorpStyle->ISM_IncorpStyleEntity) ? $regdata->incorpStyle->ISM_IncorpStyleEntity : "NIL";         
                $response['companyDetails']['dateofEst'] = !empty($compdata->MCM_RegistrationYear) ? date('d-m-Y', strtotime($compdata->MCM_RegistrationYear)) : "NIL";
                $response['companyDetails']['crnumvalidtill'] = !empty($compdata->MCM_RegistrationExpiry) ? date('d-m-Y', strtotime($compdata->MCM_RegistrationExpiry)) : "NIL";
                $response['companyDetails']['countryPk'] = $compdata->MCM_Source_CountryMst_Fk;
                $response['companyDetails']['companyLogo'] = \common\components\Drive::generateUrl($compdata->mcm_complogo_memcompfiledtlsfk,$compdata->MemberCompMst_Pk,$userpk);   
                 $response['companyDetails']['cmpstockname'] = $cmpstockname;
                 $response['companyDetails']['exchangelisted'] = $exchangelisted;
                 $response['companyDetails']['rfxaccess'] = $rfxaccess ;
                 if(count($boardmembers)>0){
                     foreach ($boardmembers as $key => $value) {
                         $returnData[$key]['name'] = $value['bmd_name'];
                         $returnData[$key]['imageurl'] = \common\components\Drive::generateUrl($value['bmd_memberdisppic'],$value['bmd_memcompmst_fk'],$userpk);
                         $returnData[$key]['designation'] = !empty($value->designation->dsg_designationname) ? $value->designation->dsg_designationname : "NIL";
                         $returnData[$key]['nationality'] = $value->nationality->CyM_CountryName_en;
                         $returnData[$key]['cntypk'] = $value['bmd_nationality'];
                         $returnData[$key]['linkedin'] = !empty($value['bmd_linkedin']) ? $value['bmd_linkedin'] : "NIL";
                         $returnData[$key]['shortbio'] = !empty($value['bmd_shortbio']) ? $value['bmd_shortbio'] : "NIL";
                     }              
                     $response['boardmemberdet'] = $returnData;
                 }
                 $retbanner = $compdata->mcm_externalprofbanner;
                if(!empty($retbanner)){
                    $editorchangebanner = 2;
                    $bannerimgarr = explode(',', $retbanner);
                    $bannerimages = Drive::generateUrl($bannerimgarr[0],$compdata->MemberCompMst_Pk,$userpk);
                    foreach ($bannerimgarr as $key => $value) {
                        $bannerimage[$key]['imagepath'] = Drive::generateUrl($value,$compdata->MemberCompMst_Pk,$userpk);
                    }
                    $retbannerimage = $bannerimage;
                }else{
                    $editorchangebanner = 1;
                    $bannerimages = "assets/images/SupplierBanner.jpg";
                    $retbannerimage = [];
                }
                // $currentenv = Yii::$app->params['baseurl']['env'];
                $url = Yii::$app->params['baseUrl'].'buyerprofile/'.$compdata->mcm_externalproflink;
                $response['retbannerimage'] = $retbannerimage;                 
                $response['bannerimage'] = $bannerimages;
                $response['editorchangebanner'] = $editorchangebanner;                 
                $response['exlink'] = $url;
                $instragram = '';
                $facebook = '';
                $twitter = '';
                $linkedin = '';
                $issocialmedia = 2;
                if(!empty($compdata->mcm_socialmedia)){
                    $datamcm_socialmedia = json_decode($compdata->mcm_socialmedia);
                    if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->facebook)){
                        $issocialmedia = 1;
                        $facebook = $datamcm_socialmedia->facebook;
                    }
                    if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->twitter)){
                        $issocialmedia = 1;
                        $twitter = $datamcm_socialmedia->twitter;
                    }
                    if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->instagram)){
                        $issocialmedia = 1;
                        $instragram = $datamcm_socialmedia->instagram;
                    }
                    if(!empty($datamcm_socialmedia) && !empty($datamcm_socialmedia->linkedin)){
                        $issocialmedia = 1;
                        $linkedin = $datamcm_socialmedia->linkedin;
                    }
                }
                $response['socialmedia']['issocialmedia']=$issocialmedia;
                $response['socialmedia']['facebook']=$facebook;
                $response['socialmedia']['twitter']=$twitter;
                $response['socialmedia']['instagram']=$instragram;
                $response['socialmedia']['linkedin']=$linkedin; 
                $message = 'Success';
                $status = 100;
         }else{
             $message = 'Mandatory fields are missing';
            $status = 101;    
            $response = [];
         }
         return $this->asJson([
            'data' => $response,
            'msg' => $message,
            'status' => $status,
        ]);
     }
     public function actionBuyeraboutuscompany(){
         $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            if(!empty($extprof)){
                $data = [
                    'aboutus'=> html_entity_decode(!empty($extprof->mcm_aboutus) ? $extprof->mcm_aboutus : ""),
                    'vision'=>html_entity_decode(!empty($extprof->mcm_vision) ? $extprof->mcm_vision : ""),
                    'mission'=>html_entity_decode(!empty($extprof->mcm_mission) ? $extprof->mcm_mission: ""),
                ];
                $message = 'Success';
                $status = 100;
            }else{
                $message = 'No data available';
                $status = 104;
            }
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
     }
     public function actionBuyersupportcollateral(){
         $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            $userpk = $extprof->register->primaryuser->UserMst_Pk;
            $data = SupportcollateraldtlsTbl::getSupportCollateralDetails($extprof->MemberCompMst_Pk, $userpk);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
     }
     public function actionByeraccomplishmentdetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
             $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $compdata = \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            $userpk = $compdata->register->primaryuser->UserMst_Pk;
            if(!empty($resParam->type)) {
                $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAccomplismentByType($compdata->MemberCompMst_Pk,$resParam->type,$resParam->size, $resParam->page,$resParam->search);
                $data = $this->arrayFormationwithrelateddocs($accomplishmentDetails, $userpk);
                if($resParam->type == 1){
                    $data['certificateoverallcount'] = $accomplishmentDetails['overallcount'];
                    $data['certificateCount'] = $accomplishmentDetails['count'];
                    $data['certificateArr'] = $data['certificateArr'];
                }elseif($resParam->type == 2){
                    $data['awardoverallcount'] = $accomplishmentDetails['overallcount'];
                    $data['awardCount'] = $accomplishmentDetails['count'];
                    $data['awardArr'] = $data['awardArr'];
                }elseif($resParam->type == 3){
                    $data['achievementoverallcount'] = $accomplishmentDetails['overallcount'];
                    $data['achievementCount'] = $accomplishmentDetails['count'];
                    $data['achievementArr'] = $data['achievementArr'];
                }
            }else{
                $arr = ['1' => 'certificate', '2' => 'award', '3' => 'achievement'];
                foreach ($arr as $key => $val) {
                    $accomplishmentDetails = MemcompacomplishdtlsTbl::fetchAllAccomplisment($compdata->MemberCompMst_Pk, $key,10);
                    $d = $this->arrayFormationwithrelateddocs($accomplishmentDetails, $userpk);
                    $data[$val."Arr"] = $d[$val."Arr"];
                    $data[$val."Count"] = $d[$val."Count"];
                    $data[$val."overallcount"] = $d[$val."overallcount"];
                }
            }
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionByermarketpresence(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            $userpk = $extprof->register->primaryuser->UserMst_Pk;
            if(!empty($resParam->type)) {
                $requestdata['compk'] = $extprof->MemberCompMst_Pk;
                $requestdata['type'] = $resParam->type;
                $requestdata['search'] = $resParam->search;
                $requestdata['size'] = $resParam->size;          
                $requestdata['page'] = $resParam->page;          
            }else{
                $requestdata['compk'] = $extprof->MemberCompMst_Pk;
            }
            $data = \common\models\MemcompmplocationdtlsTbl::getMarketpresenceListwithpage($requestdata, $userpk);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionBuyerboarddirectors(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            $userpk = $extprof->register->primaryuser->UserMst_Pk;
            $data = \common\models\BoardmemberdtlsTbl::getBoardOfDirectorswitsearch($extprof->MemberCompMst_Pk, $userpk,'',10,'',0);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionBuyerboarddirectorswithpage(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }   
            $size = $resParam->perpage;
            $search = $resParam->search;
            $page = $resParam->pageno;
            $panel = $resParam->panel;
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            $userpk = $extprof->register->primaryuser->UserMst_Pk;
            $data = \common\models\BoardmemberdtlsTbl::getBoardOfDirectorswitsearch($extprof->MemberCompMst_Pk, $userpk,$search,$size,$panel,$page);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionBuyerwebpresence(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($resParam->companyProfileId);
            $data = \common\models\MembercompanymstTbl::getbuyersocialmedia($extprof->MemberCompMst_Pk);
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;
        }
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionSavebuyercontactus() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $extprofname = (!empty($data['rid']) && is_string($data['rid'])) ? $data['rid'] : '';
        $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
        if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
            $compdecypk = base64_decode($resParam->companyProfileId);
            $extprofname = $compdecypk;
        }else{
            $extprofname = $resParam->companyProfileId;
        } 
        $compdata =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
        $compk = $compdata->MemberCompMst_Pk;
        $companyname =  $compdata->MCM_CompanyName;
        $msg['msg'] = 'failure';
        $msg['status'] = "0";
        $savedContact = \common\models\ContactusdtlsTbl::saveContactUs($data,$compk,$companyname);
        if($savedContact){
//            $content = "Dear {$compdata->MCM_CompanyName}, <br> {$data['name']} has a message for you <br> Email: {$data['emailid']} <br> Subject: {$data['subject']} <br> Message: {$data['message']} <br> <br>  Thanks,";
//         \Yii::$app->mailer->compose()
//                ->setFrom('noreply@businessgateways.com')
////                ->setTo('prithi@businessgateways.com')
//                ->setTo(\Yii::$app->params['testMailIDs'])
//                ->setSubject('Contact Us Mail')
//                ->setHTMLBody($content)
//                ->send();
            $email_to ='oman@businessgateways.com';
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data1=[
                'email'=>$email_to,
                'template_id'=>233,
                'table_ref_key'=>'MemberCompMst_Pk',
                'table_ref_value'=>$compk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data1),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $msg['msg'] = 'success';
            $msg['status'] = "1";
        }
        return $this->asJson($msg);
    }
    public function actionBuyerdivision(){
        if(!empty($_REQUEST['rid'])){
            $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
            if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
                $compdecypk = base64_decode($_REQUEST['rid']);
                $extprofname = $compdecypk;
            }else{
                $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
            }  
            $response = [];
            $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
            $divisionArr = \common\models\MemcompsectordtlsTbl::getSectorDtlInformation($extprof->MemberCompMst_Pk);
            foreach($divisionArr['data'] as $key => $val) {
                $mappedValues = \common\models\MemcompsectordtlsTbl::getMappedValues($val['sectordtls_pk']);
                $divisionArr['data'][$key]['mappedBussrc'] = $mappedValues['total_bussrc'];
                $divisionArr['data'][$key]['mappedProduct'] = $mappedValues['total_products'];
                $divisionArr['data'][$key]['mappedService'] = $mappedValues['total_services'];
                $divisionArr['data'][$key]['businessList'] = \common\models\MemcompsectordtlsTbl::getMappedBussrcDtls($val['sectordtls_pk']);
            }
            $response['divisionList'] = $divisionArr['data'];
            $response['divisionCount'] = $divisionArr['totalcount'];
            return $response;
         }
        return [];
    }
    public function actionBuyerdetailprequalification(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $data['prequalification'] = [];
        $data['registrationlink'] = '';
        if($params->ischeck){            
            if(!empty($resParam->companyProfileId)){
                    $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($resParam->companyProfileId);
                    $compk = $extprof->MemberCompMst_Pk;
                    $regdata = $extprof->register;
                    $regpk = $regdata->MemberRegMst_Pk;
                    $query = \common\models\PrequalifyhdrTblQuery::getprequlafication($regpk,3,'','','','',1);
                    $data['prequalification'] = $query;
                $message = 'Success';
                $status = 100;
           }else{
               $message = 'Mandatory fields are missing';
            $status = 101;
           }
        }else{
            $currentenv = Yii::$app->params['baseurl']['env'];
            $url = Yii::$app->params['registrationurl'][$currentenv];
            $data['registrationlink'] = $url;
            $message = 'Success';
            $status = 100;            
        }
        
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionBuyerprequalificationpage(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $data['prequalification'] = [];
        if(!empty($resParam->companyProfileId)){
            $size = $resParam->perpage;
            $search = $resParam->search;
            if(!empty($resParam->filter->datefilter->closingon->startDate)){
                $startdate = date('Ymd', strtotime($resParam->filter->datefilter->closingon->startDate));
            }else{
                $startdate = '';
            }
            if(!empty($resParam->filter->datefilter->closingon->endDate)){
                $enddate = date('Ymd', strtotime($resParam->filter->datefilter->closingon->endDate));
            }else{
                $enddate = '';
            }
            if(!empty($resParam->filter->statusfilter)){
                $status = implode(',', $resParam->filter->statusfilter);
            }else{
                $status = '';
            }
            $sort = $resParam->sort;
                $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($resParam->companyProfileId);
                $regdata = $extprof->register;
                $regpk = $regdata->MemberRegMst_Pk;
                $query = \common\models\PrequalifyhdrTbl::getprequlafication($regpk,$size,$search,$status,$startdate,$enddate,$sort);
                $data['prequalification'] = $query;
            $message = 'Success';
            $status = 100;
       }else{
           $message = 'Mandatory fields are missing';
        $status = 101;
       }                
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionBuyerdetailrfx(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $data['rfx'] = [];
        if(!empty($resParam->companyProfileId)){
                $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($resParam->companyProfileId);
                $regdata = $extprof->register;
                $regpk = $regdata->MemberRegMst_Pk;
                $query = \api\modules\pms\models\CmstenderhdrTblQuery::getbuyerrfx($regpk,3,'','','','','','',1);
                $data['rfx'] = $query;
            $message = 'Success';
            $status = 100;
       }else{
           $message = 'Mandatory fields are missing';
        $status = 101;
       }
        
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
     public function actionBuyerdetailrfxpage(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $data['rfx'] = [];
        if(!empty($resParam->companyProfileId)){
            $size = $resParam->perpage;
            $search = $resParam->search;
            if(!empty($resParam->filter->datefilter->closingon->startDate)){
                $startdate = date('Ymd', strtotime($resParam->filter->datefilter->closingon->startDate));
            }else{
                $startdate = '';
            }
            if(!empty($resParam->filter->datefilter->closingon->endDate)){
                $enddate = date('Ymd', strtotime($resParam->filter->datefilter->closingon->endDate));
            }else{
                $enddate = '';
            }
            if(!empty($resParam->filter->statusfilter)){
                $status = implode(',', $resParam->filter->statusfilter);
            }else{
                $status = '';
            }
            if(!empty($resParam->filter->subcontractfilter)){
                $subcont= implode(',', $resParam->filter->subcontractfilter);
            }else{
                $status = '';
            }
            if(!empty($resParam->filter->noticetypestatusfilter)){
                $noticetype = implode(',', $resParam->filter->noticetypestatusfilter);
            }else{
                $status = '';
            }
            $sort = $resParam->sort;
                $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($resParam->companyProfileId);
                $regdata = $extprof->register;
                $regpk = $regdata->MemberRegMst_Pk;
                $query = \api\modules\pms\models\CmstenderhdrTblQuery::getbuyerrfx($regpk,$size,$search,$status,$subcont,$noticetype,$startdate,$enddate,$sort);
                $data['rfx'] = $query;
            $message = 'Success';
            $status = 100;
       }else{
           $message = 'Mandatory fields are missing';
        $status = 101;
       }                
        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    function arrayFormationwithrelateddocs($accomplishmentDetails, $userpk){
        $userPk = $userpk;
        foreach ($accomplishmentDetails['data'] as $key => $accomplishmentDtl) {
            $uploadUrl = Drive::generateUrl($accomplishmentDtl['mcad_uploadpath'],$accomplishmentDtl['mcad_membercompmst_fk'],$userPk);
            $data['certificateCount'] = 0;
            $data['awardCount'] = 0;
            $data['achievementCount'] = 0;
            $data['certificateoverallcount'] = 0;
            $data['awardoverallcount'] = 0;
            $data['achievementoverallcount'] = 0;
            if($accomplishmentDtl['mcad_type'] == 1){
                $data['certificateCount'] = (!empty($accomplishmentDetails['count']) ? $accomplishmentDetails['count'] : 0);
                $data['certificateoverallcount'] = (!empty($accomplishmentDetails['overallcount']) ? $accomplishmentDetails['overallcount'] : 0);  
                $relateddocs = [];
                $reldoc = [];
                $relateddocurl = [];
                if(!empty($accomplishmentDtl['mcad_newsupload'])){
                        $relateddoc = explode(',', $accomplishmentDtl['mcad_newsupload']);
                        $relateddocs = array_map('intval', explode(',', $accomplishmentDtl['mcad_newsupload']));
                        foreach($relateddoc as $vl => $value){
                            $reldoc[$vl]['fileurl'] = Drive::generateUrl($value, $accomplishmentDtl['mcad_membercompmst_fk'], $userPk);
                            $reldocfilename =Drive::getFileName(Security::encrypt($value));
                            $filenamearray = explode('.', $reldocfilename);
                            $reldoc[$vl]['filename'] = $filenamearray[0];
                            $reldoc[$vl]['fileType'] =end($filenamearray);      
                        }                            
                        $relateddocurl = $reldoc;
                }
                $data['certificateArr'][] = [
                    'acmpPk'=>$accomplishmentDtl['memcompacomplishdtls_pk'],
                    'title'=>(!empty($accomplishmentDtl['mcad_title']) ?html_entity_decode($accomplishmentDtl['mcad_title'], ENT_QUOTES) : '-' ),
                    'country'=> (!empty($accomplishmentDtl['mcad_countrymst_fk']) ? $accomplishmentDtl['mcad_countrymst_fk'] : ''),
                    'countryName'=>(!empty($accomplishmentDtl['country']->CyM_CountryName_en) ? $accomplishmentDtl['country']->CyM_CountryName_en : ''),
                    'uploadPath'=>$accomplishmentDtl['mcad_uploadpath'],
                    'issuedOn'=>date('d-m-Y', strtotime($accomplishmentDtl['mcad_issuedon'])),
                    'issuedBy'=>$accomplishmentDtl['mcad_issuedby'],
                    'desc'=>(!empty($accomplishmentDtl['mcad_desc']) ? $accomplishmentDtl['mcad_desc'] : 'NIL' ),
                    'type'=>$accomplishmentDtl['mcad_type'],
                    'privacy'=>$accomplishmentDtl['mcad_view'],
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl['mcad_newsurl'],
                    'newsImageUrl'=> $accomplishmentDtl['mcad_newsupload'],
                    'relateddocurl'=>$relateddocurl,
                ];
            }
            if($accomplishmentDtl['mcad_type'] == 2){                
                $data['awardCount'] = $accomplishmentDetails['count'];
                $data['awardoverallcount'] = (!empty($accomplishmentDetails['overallcount']) ? $accomplishmentDetails['overallcount'] : 0);
                $relateddocs = [];
                $reldoc = [];
                $relateddocurl = [];
                if(!empty($accomplishmentDtl['mcad_newsupload'])){
                        $relateddoc = explode(',', $accomplishmentDtl['mcad_newsupload']);
                        $relateddocs = array_map('intval', explode(',', $accomplishmentDtl['mcad_newsupload']));
                        foreach($relateddoc as $vl => $value){
                            $reldoc[$vl]['fileurl'] = Drive::generateUrl($value, $accomplishmentDtl['mcad_membercompmst_fk'], $userPk);
                            $reldocfilename =Drive::getFileName(Security::encrypt($value));
                            $filenamearray = explode('.', $reldocfilename);
                            $reldoc[$vl]['filename'] = $filenamearray[0];
                            $reldoc[$vl]['fileType'] =end($filenamearray);      
                        }                            
                        $relateddocurl = $reldoc;
                }
                $data['awardArr'][] = [
                    'acmpPk'=>$accomplishmentDtl['memcompacomplishdtls_pk'],
                    'title'=>(!empty($accomplishmentDtl['mcad_title']) ?html_entity_decode($accomplishmentDtl['mcad_title'], ENT_QUOTES) : '-' ),
                    'country'=>$accomplishmentDtl['mcad_countrymst_fk'],
                    'countryName'=>$accomplishmentDtl['country']->CyM_CountryName_en,
                    'uploadPath'=>$accomplishmentDtl['mcad_uploadpath'],
                    'issuedOn'=> date('d-m-Y', strtotime($accomplishmentDtl['mcad_issuedon'])),
                    'issuedBy'=>$accomplishmentDtl['mcad_issuedby'],
                    'desc'=>(!empty($accomplishmentDtl['mcad_desc']) ? $accomplishmentDtl['mcad_desc'] : 'NIL' ),
                    'type'=>$accomplishmentDtl['mcad_type'],
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl['mcad_newsurl'],
                    'newsImageUrl'=> $accomplishmentDtl['mcad_newsupload'],
                    'relateddocurl'=>$relateddocurl
                ];
            }
            if($accomplishmentDtl['mcad_type'] == 3){
                $data['achievementCount'] = $accomplishmentDetails['count'];
                $data['achievementoverallcount'] = (!empty($accomplishmentDetails['overallcount']) ? $accomplishmentDetails['overallcount'] : 0);            
                $data['achievementArr'][] = [
                    'acmpPk'=>$accomplishmentDtl['memcompacomplishdtls_pk'],
                    'title'=>(!empty($accomplishmentDtl['mcad_title']) ?html_entity_decode($accomplishmentDtl['mcad_title'], ENT_QUOTES) : '-' ),
                    'uploadPath'=>$accomplishmentDtl['mcad_uploadpath'],
                    'issuedOn'=>date('d-m-Y', strtotime($accomplishmentDtl['mcad_issuedon'])),
                    'issuedBy'=>$accomplishmentDtl['mcad_issuedby'],
                    'desc'=>$accomplishmentDtl['mcad_desc'],
                    'type'=>$accomplishmentDtl['mcad_type'],
                    'uploadUrl'=>$uploadUrl,
                    'newsUrl'=>$accomplishmentDtl['mcad_newsurl'],
                    'newsImageUrl'=> $accomplishmentDtl['mcad_newsupload'],
                ];
            }
        }

        return $data;
    }
    public function actionChangebanner(){
        $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
        $extprof = new Extprof($extprofname,$iscompanypk,6);
        $compk = $extprof->comppk;
        $userpk = $extprof->userpk;
        $bannerimage = $_REQUEST['bannerimageid'];
        $companybanner = \common\models\MembercompanymstTbl::findOne($compk);  
        $msg['status'] = 0;
        $companybanner->mcm_externalprofbanner  = $bannerimage;
        if($companybanner->save()){
            $retbanner = $companybanner->mcm_externalprofbanner;
            if(!empty($retbanner)){
                $bannerimgarr = explode(',', $retbanner);
                foreach ($bannerimgarr as $key => $value) {
                    $retbannerimage[$key]['imagepath'] = Drive::generateUrl($value,$compk,$userpk);
                }
                $msg['retbannerimage']  = $retbannerimage;
            }else{
                $msg['retbannerimage']  = [];
            }
            $msg['status'] = 1;
        }else{
            $msg['retbannerimage'] = [];
        }
        return $msg;
    }
    public function actionRemoveextbanner(){
          $msg['status'] = 0;
         $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
         $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,6);
         $compk = $extprof->MemberCompMst_Pk;
        $companybanner = \common\models\MembercompanymstTbl::findOne($compk);  
        $companybanner->mcm_externalprofbanner  = NULL;
        if($companybanner->save()){
            $msg['status'] = 1;
        }
        return $msg;
    }
    public function actionRemovebuyerextbanner(){
          $msg['status'] = 0;
         $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
         $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
         $compk = $extprof->MemberCompMst_Pk;
        $companybanner = \common\models\MembercompanymstTbl::findOne($compk);  
        $companybanner->mcm_externalprofbanner  = NULL;
        if($companybanner->save()){
            $msg['status'] = 1;
        }
        return $msg;
    }
     public function actionChangebuyerbanner(){
         $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
         $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,7);
         $compk = $extprof->MemberCompMst_Pk;
         $userpk = $extprof->register->primaryuser->UserMst_Pk;
        $bannerimage = $_REQUEST['bannerimageid'];
        $companybanner = \common\models\MembercompanymstTbl::findOne($compk);  
        $msg['status'] = 0;
        $companybanner->mcm_externalprofbanner  = $bannerimage;
        if($companybanner->save()){
            $retbanner = $companybanner->mcm_externalprofbanner;
            if(!empty($retbanner)){
                $bannerimgarr = explode(',', $retbanner);
                foreach ($bannerimgarr as $key => $value) {
                    $retbannerimage[$key]['imagepath'] = Drive::generateUrl($value,$compk,$userpk);
                }
                $msg['retbannerimage']  = $retbannerimage;
            }else{
                $msg['retbannerimage']  = [];
            }
            $msg['status'] = 1;
        }else{
            $msg['retbannerimage'] = [];
        }
        return $msg;
    }
    public function actionTenderList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $tenderParams['sort_type'] = SORT_DESC;

        $data['tenderList'] = MemcomptendbrdsecgrddtlsTbl::getTenderList($tenderParams);
        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionSavecomments() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($data['compid']);
        $formdata = $data['formdata'];
        $cmmts = html_entity_decode($formdata['comment']);
        $returndata =\common\models\MemcompbackendinfoTblQuery::savecomments($compk,$cmmts);
        if($returndata == 1){
            $response['msg'] = 'success';
            $response['status'] = 1;
            $response['data'] = 'Successfully saved';
        }else{
            $response['msg'] = 'failure';
            $response['status'] = 0;
            $response['data'] = 'Something went wrong';            
        }
        return json_encode($response); 
    }
    public function actionGetvisitorsloungedet(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $response = [];
        ini_set('max_execution_time', 0);
       if(isset($resParam->companyProfileId) && !empty($resParam->companyProfileId)){
           $iscompanypk = (!empty($resParam->from)) ? $resParam->from : 2;
            if($iscompanypk == 1 && !empty($resParam->companyProfileId)){
                $compdecypk = base64_decode($resParam->companyProfileId);
                $extprofname = $compdecypk;
            }else{
                $extprofname = $resParam->companyProfileId;
            }        
            $extprof = new Extprof($extprofname,$iscompanypk,6);
            $productcounts = $extprof->getproductcount($extprof->comppk);
            $servicescounts = $extprof->getservicescount($extprof->comppk);
            $busdetcount = \common\models\MemcompsectordtlsTbl::getBusinessUnitCounts($extprof->comppk);
            $supportcort = SupportcollateraldtlsTbl::getSupportCollateralDetails($extprof->comppk, $extprof->userpk);
            $retbanner = $extprof->compdata->mcm_visitorloungebanner;
            $editorchangebanner = 1;
            if(!empty($retbanner)){
                $editorchangebanner = 2;
                $retbannerimage = Drive::generateUrl($retbanner,$extprof->comppk,$extprof->userpk);
                $response['vistorsDetails']['retbannerimage']  = $retbannerimage;                
            }else{
                $editorchangebanner = 1;
                $response['vistorsDetails']['retbannerimage']  = 'assets/images/loungebanner.png';
            }
            $response['vistorsDetails']['editorchangebanner'] = $editorchangebanner;
            $response['vistorsDetails']['companyid'] = $extprof->comppk;
            $response['vistorsDetails']['companyName'] = $extprof->compdata->MCM_CompanyName;
            $response['vistorsDetails']['dateofEst'] =  !empty($extprof->compdata->MCM_RegistrationYear) ? date('d-m-Y', strtotime($extprof->compdata->MCM_RegistrationYear)) : "NIL";        
            $response['vistorsDetails']['businessUnitCount'] = $busdetcount;
            $response['vistorsDetails']['aboutus'] = !empty($extprof->compdata->mcm_aboutus) ? html_entity_decode($extprof->compdata->mcm_aboutus) : 'NIL';
            $response['vistorsDetails']['producttotcnt'] = !empty($productcounts['totalcount']) ? $productcounts['totalcount'] : 0;
            $response['vistorsDetails']['jsrsproduct'] = !empty($productcounts['totalaprocount']) ? $productcounts['totalaprocount'] : 0;
            $response['vistorsDetails']['servicestotcnt'] = !empty($servicescounts['totalcount']) ? $servicescounts['totalcount'] : 0;
            $response['vistorsDetails']['jsrsservices'] = !empty($servicescounts['totalaprocount']) ? $servicescounts['totalaprocount'] : 0;
            $response['supportcollateral'] = $supportcort;
            $message = 'Success';
            $status = 100;
        }else{
            $message = 'Mandatory fields are missing';
            $status = 101;            
        }
        return $this->asJson([
            'data' => $response,
            'msg' => $message,
            'status' => $status,
        ]);
    }
    public function actionChangevistorslngbanner(){
         $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
        $extprof = new Extprof($extprofname,$iscompanypk,6);
        $compk = $extprof->comppk;
        $userpk = $extprof->userpk;        
        $companybanner = \common\models\MembercompanymstTbl::findOne($compk);  
        $msg['status'] = 0;
        if(!empty($companybanner->mcm_visitorloungebanner)){
            $bannid = explode(",", $_REQUEST['bannerimageid']);
            if(count($bannid) > 1){                
                $bannerimage = $bannid[1];
            }else{
                $bannerimage = $_REQUEST['bannerimageid'];
            }
        }else{
            $bannerimage = $_REQUEST['bannerimageid'];
        }
        $companybanner->mcm_visitorloungebanner  = $bannerimage;
        if($companybanner->save()){
            $retbanner = $companybanner->mcm_visitorloungebanner;
            if(!empty($retbanner)){
                $retbannerimage = Drive::generateUrl($retbanner,$compk,$userpk);
                $msg['retbannerimage']  = $retbannerimage;
            }else{
                $msg['retbannerimage']  = 'assets/images/loungebanner.png';
            }
            $msg['status'] = 1;
        }else{
            $msg['retbannerimage'] = 'assets/images/loungebanner.png';
        }
        return $msg;
    }
    public function actionRemovevistorslngbanner(){
          $msg['status'] = 0;
         $iscompanypk = (!empty($_REQUEST['from'])) ? $_REQUEST['from'] : 2;
        if($iscompanypk == 1 && !empty($_REQUEST['rid'])){
            $compdecypk = base64_decode($_REQUEST['rid']);
            $extprofname = $compdecypk;
        }else{
            $extprofname = (!empty($_REQUEST['rid']) && is_string($_REQUEST['rid'])) ? $_REQUEST['rid'] : '';
        }        
         $extprof =  \common\models\MembercompanymstTbl::getCompanyDtlByExtProfName($extprofname,$iscompanypk,6);
         $compk = $extprof->MemberCompMst_Pk;
        $companybanner = \common\models\MembercompanymstTbl::findOne($compk);  
        $companybanner->mcm_visitorloungebanner  = NULL;
        if($companybanner->save()){
            $msg['status'] = 1;
        }
        return $msg;
    }
}
