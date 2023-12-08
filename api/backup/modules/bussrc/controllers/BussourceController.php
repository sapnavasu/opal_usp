<?php
namespace api\modules\bussrc\controllers;

use api\modules\mst\models\SectormstTbl;
use common\models\BusinesssourcemstTbl;
use common\models\MemcompbussrcdtlsTbl;
use common\models\MemcompfctydtlsTbl;
use \common\components\Bussource;
use common\models\MemcompsectordtlsTbl;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\Url;

use Yii;
use common\components\Common;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use  common\components\Configuration;
use common\components\Configsession;
use common\components\CommonDb;
use common\components\Search;
use common\components\User;
use \common\components\Security;
use \common\models\MembercompanymstTbl;
use \common\models\MemcompmpmfrdtlsTbl;
use common\models\UsermstTbl;
use common\models\SupportcollateraldtlsTbl;
use common\models\MemcomptradingdtlsTbl;
use \app\models\MemcompbranchdtlsmainTbl;
use \yii\data\ActiveDataProvider;
use \app\models\IndustrialestatemstTbl;
use \app\models\IndustrialzonemstTbl;
use \app\models\BusinesslicensemstTbl;
use \app\models\OfficetypemstTbl;
use \app\models\MemcompbranchdtlstempTbl;
use \common\models\IsicactivitymstTbl;
use \common\models\MemcompfiledtlsTbl;
use common\components\Drive;
use \common\models\HssectionmstTbl;
use \common\models\HschaptermstTbl;
use \common\models\HsheadingmstTbl;
use \common\models\HssubheadingmstTbl;
use \common\models\HssectionmstTblQuery;
use \common\models\HschaptermstTblQuery;
use \common\models\HsheadingmstTblQuery;
use \common\models\HsgroupingsubheadingTblQuery;
use \common\models\HssubheadingmstTblQuery;

class BussourceController extends BussrcMasterController
{

    public $modelClass = '\common\models\MemcompbussrcdtlsTbl';
    
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
     *     path="/bussrc/bussource/createbusinesssource",
     *     tags={"create business source"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a business source",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *                  @SWG\Property(property="mcbsd_businessrc", type="integer", example="1"),
        *                  @SWG\Property(property="mcbsd_refname", type="string", example="test"),
        *                  @SWG\Property(property="mcbsd_others", type="string", example="test")          
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionCreatebusinesssource() { 
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

//        $company_id = $session->MemberCompMst_Pk;
        $data['mcbsd_businessrc'] = \common\components\Security::sanitizeInput($data['bussrcval']['srctype'],"number");
        $data['mcbsd_refname'] = \common\components\Security::sanitizeInput($data['bussrcval']['refname'],"string_spl_char");
        $data['mcbsd_others'] = \common\components\Security::sanitizeInput($data['bussrcval']['otherbsname'],"string_spl_char");
        $data['mcbsd_memcompsecdtls_fk'] = \common\components\Security::sanitizeInput($data['bussrcval']['bsrcunit'],"number");
        $data['memcompbussrcdtls_pk'] = $data['bussrcval']['memcompbussrcdtls_pk'];
        $data['type'] = 'first_card';
        
        $data['mcbsd_membercompanymst_fk'] = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $data['mcbsd_usermst_fk'] = null;
        $data['mcbsd_createdby'] = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $data['bsrcrefupdate'] = $data['bussrcval']['bsrcrefupdate'];
        
        $bussource = new Bussource();
        $bussource_data = $bussource->createBusinessSource($data);
        return $bussource_data;
    }

    /*
     * input bspk
     * output json
     */

    public function actionGetbusinessrow(){
        $bs_pk=Security::decrypt($_GET['bs']);
        // echo"\nbs_pk $bs_pk";
        if($bs_pk){
            $bus_mdl=MemcompbussrcdtlsTbl::find()->select(['bsm_bussrcname','mcbsd_uid','mcbsd_refname','SecM_SectorName', 'SecM_SectorCode'])
                ->leftJoin(MemcompsectordtlsTbl::tableName(),'mcbsd_memcompsecdtls_fk=MemCompSecDtls_Pk')
                ->leftJoin(SectormstTbl::tableName(),'MCSD_SectorMst_Fk=SectorMst_Pk')
                ->leftJoin(BusinesssourcemstTbl::tableName(),'businesssourcemst_pk=mcbsd_businesssourcemst_fk')
                ->where('memcompbussrcdtls_pk=:bus',[':bus'=>$bs_pk])
                ->andWhere(['!=','mcbsd_isdeleted', 1])
                ->asArray()
                ->one();

            return $this->asJson($bus_mdl);
        }
    }

      /**
     * @SWG\Post(
     *     path="/bussrc/bussource/savebussrcunitsectoractivty",
     *     tags={"save business source unit sector activity"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a business source",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *                  @SWG\Property(property="memcompsectordtsid", type="integer", example="1"),
        *                  @SWG\Property(property="selected_act", type="string", example="['1','2']"),
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionSavebussrcunitsectoractivty() { 
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        //print_r($data);die();
        $data['mcbsa_memcompbussrcdtls_fk'] =  \common\components\Security::sanitizeInput($data['bussrcact']['bs_pk'],"string_spl_char");
        $data['mcbsa_memcompbussrcdtls_fk'] =  \common\components\Security::decrypt($data['mcbsa_memcompbussrcdtls_fk']);
        $data['mcbsa_activitiesmst_fk'] = $data['bussrcact']['selected_act'];
        
        $bussourcesecact = new Bussource();
        $bussourcesecact_data = $bussourcesecact->savebussrcunitsectoractivty($data);
        return $bussourcesecact_data;
    }
   
      /**
     * @SWG\Post(
     *     path="/bussrc/bussource/getbusinesssource",
     *     tags={"get business source"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a business source",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompbussrcdtls_tbl", type="item",
        *                  @SWG\Property(property="bussource_pk", type="integer", example="1"),
     *          )
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    
    public function actionGetbusinesssource() {
        $bussourcepk_edit = Security::decrypt($_REQUEST['bussrcid']); 
       
        $id = Security::sanitizeInput($bussourcepk_edit,'number'); 
        $bussource = new Bussource();
        $bussource_data = $bussource->getBusinesssource($id);
        return json_encode($bussource_data);
    }

    /**
     * @SWG\Post(
     *     path="/bussrc/bussource/getbusinesssourceunitcode",
     *     tags={"get business source"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a business source",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompbussrcdtls_tbl", type="item",
        *                  @SWG\Property(property="sectdetid", type="integer", example="1"),
     *          )
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    
    public function actionGetbusinesssourceunitcode() {
        // $sectdetid = Security::decrypt($_REQUEST['sectdetid']); 
        $sectdetid = $_REQUEST['sectdetid']; 
       
        // $id = Security::sanitizeInput($bussourcepk_edit,'number'); 
        $bussource = new Bussource();
        $sectorunit_code = $bussource->getbusinesssourceunitcode($sectdetid);
        return json_encode($sectorunit_code);
    }

    /**
     * @SWG\Post(
     *     path="bussrc/bussource/addmanufactdtls",
     *     tags={"Businesssource Manufacturer Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to add business source manufacturer details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="manufactdtls", type="object",
        *                  @SWG\Property(property="mfname", type="string", example=""),
        *                  @SWG\Property(property="cpname", type="integer", example=""),
        *                  @SWG\Property(property="mfphone", type="integer", example=""),
        *                  @SWG\Property(property="mfphoneext", type="integer", example=""),
        *                  @SWG\Property(property="mfemail", type="integer", example=""),
        *                  @SWG\Property(property="bussrcdtls_fk", type="string", example=""),
        *              )
     *          ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    //Manufacturer details adding business source
    public function actionAddmanufactdtls(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['mcmpmd_mfrname'] = Security::sanitizeInput($data['manufactdtls']['mfname'],'string');
        $data['mcmpmd_cntperson'] = Security::sanitizeInput($data['manufactdtls']['cpname'],'string');
        $data['mcmpmd_landlinecc'] = Security::sanitizeInput($data['manufactdtls']['landline_cc'],'string_spl_char');
        $data['mcmpmd_landline'] = Security::sanitizeInput($data['manufactdtls']['mfphone'],'string');
        $data['mcmpmd_landlineext'] = Security::sanitizeInput($data['manufactdtls']['mfphoneext'],'string');
        $data['manufactdtls']['countries'] = Security::sanitizeInput($data['manufactdtls']['countries'],'string');
        $data['manufactdtls']['bussrcdtls_fk'] = Security::decrypt($data['manufactdtls']['bussrcdtls_fk']);
        $data['mcmpmd_memcompbussrcdtls_fk'] = Security::sanitizeInput($data['manufactdtls']['bussrcdtls_fk'],'number');
        $data['mcmpmd_memcompbussrcdtls_fk'] = Security::sanitizeInput($data['manufactdtls']['bussrcdtls_fk'],'number');
        $data['mcmpmd_emailid'] = Security::sanitizeInput($data['manufactdtls']['mfemail'],'string_spl_char');
        $data['mcmpmd_memcompmst_fk'] = Security::sanitizeInput($data['manufactdtls']['compmst'],'number');
        $data['mcmpmd_usermst_fk'] = Security::sanitizeInput($data['manufactdtls']['usermst'],'number');
        $data['mcmpmd_emailinvitelink'] = Security::sanitizeInput($data['manufactdtls']['sentinv'],'number');
       
        if($data['mcmpmd_emailinvitelink'] != 1) {
            $data['mcmpmd_emailinvitelink'] = 2;
        }

        if($data['mcmpmd_memcompmst_fk'] == '') {
            $data['mcmpmd_memcompmst_fk'] = null;
        }

        if($data['mcmpmd_usermst_fk'] == '') {
            $data['mcmpmd_usermst_fk'] = null;
        }

        if($data['mcmpmd_cntperson'] == '') {
            $data['mcmpmd_cntperson'] = null;
        }

        if($data['mcmpmd_landline'] == '') {
            $data['mcmpmd_landline'] = null;
        }

        if($data['mcmpmd_landlineext'] == '') {
            $data['mcmpmd_landlineext'] = null;
        }

        if($data['mcmpmd_emailid'] == '') {
            $data['mcmpmd_emailid'] = null;
        }

        if($data['mcmpmd_landline'] == '') {
            $data['mcmpmd_landline'] = null;
        }

        $data = Bussource::addmanufacturerdetails($data);
        return $data;        
    }

    /**
     * @SWG\Post(
     *     path="bussrc/bussource/updatemanufactmailstatus",
     *     tags={"Update Invitation Mail Sent Status Update"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Update Invitation Mail Sent Status Update",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="manufactdtls", type="object",
        *                  @SWG\Property(property="mfname", type="string", example=""),
        *                  @SWG\Property(property="cpname", type="integer", example=""),
        *                  @SWG\Property(property="mfphone", type="integer", example=""),
        *                  @SWG\Property(property="mfphoneext", type="integer", example=""),
        *                  @SWG\Property(property="mfemail", type="integer", example=""),
        *                  @SWG\Property(property="bussrcdtls_fk", type="string", example=""),
        *              )
     *          ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionUpdatemanufactmailstatus(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        $data = Bussource::updatemanufactmailstatus($data);
        return $data;        
    }
    
    /**
     * @SWG\Post(
     *     path="/bussrc/bussource/createfactorydetails",
     *     tags={"Add Factory Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a factory details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *                  @SWG\Property(property="mcfd_memcompbussrcdtls_fk", type="integer", example="1"),
        *                  @SWG\Property(property="mcfd_fctnooflines", type="integer", example="1"),
        *                  @SWG\Property(property="mcfd_fctnoofprodstaff", type="integer", example="1"),          
     *                     @SWG\Property(property="mcfd_totannpurcvol", type="integer", example="1"),         
     *                     @SWG\Property(property="mcfd_annuoutputvalue", type="integer", example="1"),         
     *                     @SWG\Property(property="mcfd_annuprodcap", type="integer", example="1"),          
     *                     @SWG\Property(property="mcfd_qltycontrol", type="integer", example="1"),          
     *                     @SWG\Property(property="mcfd_rsrchdvlp", type="integer", example="1"),          
     *                     @SWG\Property(property="mcfd_abtqlty", type="string", example="test"),          
     *                     @SWG\Property(property="mcfd_qltycntlsuppordocs", type="string", example="test"),          
     *                     @SWG\Property(property="mcfd_abtrsrchdvlp", type="string", example="test"),
     *                     @SWG\Property(property="mcfd_rsrchdvlpsuppordocs", type="string", example="test"), 
     *     ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCreatefactorydetails() { 
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $qcissuedate = date('Y-m-d', strtotime($data['factdetval']['qcissuedate']));
        $qcexpirydate = date('Y-m-d', strtotime($data['factdetval']['qcexpirydate']));
        
        $data['mcfd_fctnooflines'] = \common\components\Security::sanitizeInput($data['factdetval']['productionline'],"number");
        $data['mcfd_fctnoofprodstaff'] = \common\components\Security::sanitizeInput($data['factdetval']['productionstaff'],"number");
        // $data['mcfd_totannpurcvol'] = \common\components\Security::sanitizeInput($data['factdetval']['purchasevolume'],"number");
        $data['mcfd_annuoutputvalue'] = \common\components\Security::sanitizeInput($data['factdetval']['outputvalue'],"number");
        $data['mcfd_annuprodcap'] = \common\components\Security::sanitizeInput($data['factdetval']['productioncapacity'],"number");
        // $data['mcfd_qltycontrol'] = \common\components\Security::sanitizeInput($data['factdetval']['qualitycontrol'],"string");
        // $data['mcfd_rsrchdvlp'] = \common\components\Security::sanitizeInput($data['factdetval']['research'],"string");
        // $data['mcfd_abtqlty'] = \common\components\Security::sanitizeInput($data['factdetval']['aboutquality'],"string_spl_char");
        // $data['mcfd_qltycntlsuppordocs'] = \common\components\Security::sanitizeInput($data['factdetval']['file_uploaded_pk'],"string_spl_char");        
        // $data['mcfd_abtrsrchdvlp'] = \common\components\Security::sanitizeInput($data['factdetval']['aboutresearch'],"string_spl_char");
        $data['mcfd_memcompmplocationdtls_fk'] = \common\components\Security::sanitizeInput($data['factdetval']['address_pk'],"number");
        // $data['mcfd_rsrchdvlpsuppordocs'] = \common\components\Security::sanitizeInput($_REQUEST['mcfd_rsrchdvlpsuppordocs'],"string_spl_char");
        // $data['mcfd_annucurrency'] =  \common\components\Security::sanitizeInput($data['factdetval']['aovcurrency'],"number");
        // $data['mcfd_annuprodcapunit'] = \common\components\Security::sanitizeInput($data['factdetval']['apcmeasurement'],"number");
        // $data['mcfd_qltydateofissue'] = $qcissuedate;
        // $data['mcfd_qltydateofexpiry'] = $qcexpirydate;
        // $data['mcfd_qltycntlsuppordocs'] = $data['factdetval']['procover'];
        $data['type'] = 'insert'; 
        
        $data['mcfd_memcompbussrcdtls_fk'] = \common\components\Security::sanitizeInput($data['factdetval']['bussrcpk'],"string_spl_char");
        $data['mcfd_memcompbussrcdtls_fk'] = \common\components\Security::decrypt($data['mcfd_memcompbussrcdtls_fk']);
        $data['memcompfctydtls_pk'] = \common\components\Security::sanitizeInput($data['factdetval']['busrcfactorypk'],"number");
        $bussource = new Bussource();
        $bussource_data = $bussource->createFactorydetails($data);
        
        return $bussource_data;
    }

    /**
     * @SWG\Post(
     *     path="/bussrc/bussource/createfactoryinfo",
     *     tags={"Add Factory Info"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a factory info",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *                  @SWG\Property(property="mcfd_memcompmplocationdtls_fk", type="integer", example="1"),
        *                  @SWG\Property(property="mcfd_factorytypemst_fk", type="integer", example="1"),
        *                  @SWG\Property(property="mcfd_facname", type="integer", example="1"),          
     *                     @SWG\Property(property="mcfd_facid", type="integer", example="1"),         
     *                     @SWG\Property(property="mcfd_facbrief", type="integer", example="1"),         
     *                     @SWG\Property(property="mcfd_facestyear", type="integer", example="1"),          
     *     ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCreatefactoryinfo() { 
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        

        $data['mcfd_memcompmplocationdtls_fk'] =\common\components\Security::sanitizeInput($data['factinfoval']['factlocationpk'],"number");
        $data['mcfd_factorytypemst_fk'] = \common\components\Security::sanitizeInput($data['factinfoval']['facttype'],"number");
        $data['mcfd_facname'] = \common\components\Security::sanitizeInput($data['factinfoval']['factname'],"string_spl_char");
        $data['mcfd_facid'] = \common\components\Security::sanitizeInput($data['factinfoval']['factid'],"string_spl_char");
        $data['mcfd_facbrief'] = $data['factinfoval']['factshort_sum'];
        $data['mcfd_facestyear'] = \common\components\Security::sanitizeInput($data['factinfoval']['factyoe'],"number");
        $data['mcfd_facbusscope'] = \common\components\Security::sanitizeInput($data['factinfoval']['factscope'],"string_spl_char");
        
        $data['mcfd_memcompbussrcdtls_fk'] = \common\components\Security::sanitizeInput($data['factinfoval']['busdetpk'],"string_spl_char");
        $data['mcfd_memcompbussrcdtls_fk'] = \common\components\Security::decrypt($data['mcfd_memcompbussrcdtls_fk']);
        
        $data['memcompfctydtls_pk'] = \common\components\Security::sanitizeInput($data['factinfoval']['factdetpk'],"string_spl_char");
        $data['memcompfctydtls_pk'] = \common\components\Security::decrypt($data['memcompfctydtls_pk']);
        // $data['mcfd_fctnoofprodstaff'] = \common\components\Security::sanitizeInput($data['factinfoval']['manpower'], "number");

        $data['mcfd_fctnooflines'] = \common\components\Security::sanitizeInput($data['factinfoval']['Prod_Lines'], "number");
        $data['mcfd_fctnoofprodstaff'] = \common\components\Security::sanitizeInput($data['factinfoval']['Prod_Staff'], "number");
        $data['mcfd_fctnoofprodstaffnonomani'] = \common\components\Security::sanitizeInput($data['factinfoval']['Prod_Staff_NO'], "number");

        $data['mcfd_factoryownership'] = \common\components\Security::sanitizeInput($data['factinfoval']['fproptype'], "number");

        $data['mcmpld_leasetype'] = \common\components\Security::sanitizeInput($data['factinfoval']['proptype'], "number");
        $data['mcmpld_leasestartdt'] = $data['factinfoval']['issuedon'];
        $data['mcmpld_leaseenddt'] = $data['factinfoval']['expireson'];
        $data['mcmpld_leasedoc'] = $data['factinfoval']['leasedoc'];
        
        if($data['mcfd_factorytypemst_fk'] == 0) {
            $data['mcfd_factorytypemst_fk'] = null;
        }

        if($data['mcfd_facestyear'] == 0) {
            $data['mcfd_facestyear'] = null;
        }

        if($data['mcfd_facname'] == '') {
            $data['mcfd_facname'] = null;
        }
        
        if($data['mcfd_facbrief'] == '') {
            $data['mcfd_facbrief'] = null;
        }

        if($data['mcfd_facid'] == '') {
            $data['mcfd_facid'] = null;
        }

        if($data['mcfd_busscope'] == '') {
            $data['mcfd_busscope'] = null;
        }

        // echo"<pre>data\n\n ";
        // print_r($data);
        // exit;
        $bussource = new Bussource();
        $factoryinfo_data = $bussource->createFactoryinfo($data);
        
        return $factoryinfo_data;
    }
    
      /**
     * @SWG\Post(
     *     path="/bussrc/bussource/getfactorydetails",
     *     tags={"get factory details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get a factory details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompfctydtls_tbl", type="item",
        *                  @SWG\Property(property="memcompfctydtls_pk", type="string", example="Mzl="),
     *          )
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    
    public function actionGetfactorydetails() { 
        $factdet_edit = Security::decrypt($_REQUEST['id']);
        $id = Security::sanitizeInput($factdet_edit,'number');    
        $token = ActiveRecord::getTokenData();
        
        $bussource = new Bussource();
        $factory_data = $bussource->getFactorydetails($id, $token);
        return json_encode($factory_data);
    }
    
    /**
     * @SWG\Post(
     *     path="/bussrc/bussource/getfactoryinfo",
     *     tags={"get factory details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get a factory details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompfctydtls_tbl", type="item",
        *                  @SWG\Property(property="memcompfctydtls_pk", type="string", example="Mzl="),
     *          )
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetfactoryinfo() { 
        $factdet_edit = Security::decrypt($_REQUEST['id']);
        $id = Security::sanitizeInput($factdet_edit,'number');    
        $token = ActiveRecord::getTokenData();
        
        $bussource = new Bussource();
        $factory_data = $bussource->getFactoryinfo($id, $token);
        return $factory_data;
    }

    /**
     * @SWG\Post(
     *     path="/bussrc/bussource/getfactoryinfoforbs",
     *     tags={"get factory details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get a factory details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompfctydtls_tbl", type="item",
        *                  @SWG\Property(property="memcompfctydtls_pk", type="string", example="Mzl="),
     *          )
     *     ),
       * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetfactoryinfoforbs() { 
        $factdet_edit = Security::decrypt($_REQUEST['id']);
        $id = Security::sanitizeInput($factdet_edit,'number');    
        $token = ActiveRecord::getTokenData();
        
        $bussource = new Bussource();
        $factory_data = $bussource->getFactoryinfoforbs($id, $token);
        return $factory_data;
    }


    public function actionGetcontactdetails(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = UsermstTbl::getUserData($pk);  
        return $data;
    }

              /**
     * @SWG\Post(
     *     path="bussrc/bussource/getcontactdetailsmultiple",
     *     tags={"Get Contact Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to add business source manufacturer details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="contactdtls", type="object",
        *                  @SWG\Property(property="details", type="array", example=""),
        *              )
     *          ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionGetcontactdetailsmultiple(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = UsermstTbl::getUserDatamultiple($data);  
        return $data;
    }


      /**
     * @SWG\Post(
     *     path="bussrc/bussource/addmanufactdtls",
     *     tags={"Businesssource Manufacturer Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to add business source manufacturer details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="contactdtls", type="object",
        *                  @SWG\Property(property="bussrc_pk", type="string", example=""),
        *                  @SWG\Property(property="user_fk", type="string", example=""),
        *              )
     *          ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionMapcontactdetails(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['contactdtls']['bussrc_pk'] = Security::decrypt($data['contactdtls']['bussrc_pk']);
        $data['contactdtls']['bussrc_pk'] = Security::sanitizeInput($data['contactdtls']['bussrc_pk'],'number');
        $data['contactdtls']['user_fk'] = Security::decrypt($data['contactdtls']['user_fk']);
        $data['contactdtls']['user_fk'] = Security::sanitizeInput($data['contactdtls']['user_fk'],'number');
        $data = Bussource::mapcontactdetails($data);
        return $data; 
    }
    
    /**
     * @SWG\Post(
     *     path="/bussrc/bussource/savebspermit",
     *     tags={"Add Permit Details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To save permit details to permit table",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *              @SWG\Property(property="bussrcPermit", type="object",
     *                  @SWG\Property(property="memcompbussrcdtls_fk", type="string", example="Mzl="),
     *                  @SWG\Property(property="permitfile", type="string", example="Mzl="),
     *                  @SWG\Property(property="issuedate", type="date", example="2020-04-20"),          
     *                  @SWG\Property(property="expirydate", type="date", example="2020-04-20"),         
     *              )
     *            ),
     * ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSavebspermit()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);

        // Decrypt fields
        $BSPdata['memcompbussrcdtls_fk'] = Security::decrypt($data['bussrcPermit']['memcompbussrcdtls_fk']);
//        $data['bussrcPermit']['permitfile'] = Security::decrypt($data['bussrcPermit']['permitfile']);
        //sanitize the input
        $BSPdata['mcmppd_memcompbussrcdtls_fk'] = $BSPdata['memcompbussrcdtls_fk'];
        $BSPdata['mcmppd_memcompfctydtls_fk'] = Security::sanitizeInput($data['bussrcPermit']['mcmppd_memcompfctydtls_fk'],'number')  ;    
        $BSPdata['mcmppd_permitfile'] = Security::sanitizeInput($data['bussrcPermit']['permitfile'],'number')  ;    
        $BSPdata['mcmppd_permitdateofissue'] = Security::isDateValid($data['bussrcPermit']['issuedate'],'Y-m-d');    
        if($data['bussrcPermit']['lifetime'] == null){
            $BSPdata['mcmppd_permitdateofexpiry'] = Security::isDateValid($data['bussrcPermit']['expirydate'],'Y-m-d');    
        }
        // Calling class file for validation and get the response 
        $bs_obj = new Bussource();
        return $bs_obj->SaveBS_permit($BSPdata);
    }
    
   
    /**
     * @SWG\Get(
     *     path="/bussrc/bussource/getbspermitdetails",
     *     tags={"get Permit details"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="To get permit details from table",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "bussrcid", type = "string", example="Mzl=" ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetbspermitdetails()
    {
        $bsid = Security::sanitizeInput(Security::decrypt($_REQUEST['bsid']),'number')  ;    
        $bs_obj = new Bussource();
        return $bs_obj->Getbspermitdetails($bsid);
    }

    public function actionGetmanufacturerdetails()
    {
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = MemcompmpmfrdtlsTbl::getmanufacturerdata($pk);  
        return $data;
    }

         /**
     * @SWG\Post(
     *     path="/bussrc/listbusinesssource",
     *     tags={"Businesssource listing"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Its used to get the list of service added by supplier",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer",default="1"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer",default="10"),
    *      @SWG\Property(property="businesssource", type="string", example=""),
    *      @SWG\Property(property="issuedate", type="object", example=""),
    *      @SWG\Property(property="expirydate", type="object", example=""),
    *      @SWG\Property(property="sort", type="string", example=""),
    *      @SWG\Property(property="search", type="string", example=""),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionListbusinesssource(){
       
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $search = $data['search'];
        $data = MemcompbussrcdtlsTbl::getbslist($data,$_REQUEST);
        $stkholdertype=\yii\db\ActiveRecord::getTokenData('reg_type',true);
        $origin=\yii\db\ActiveRecord::getTokenData('MCM_Origin',true);

            foreach ($data['items'] as $key => $value) {
                $sector_mapped = \app\models\MemcompbussrcsectormapTbl::find()->select(['*'])
                    ->leftJoin('sectormst_tbl','SectorMst_Pk = mcbssm_sectormst_fk')
                    ->where('mcbssm_memcompbussrcdtls_fk = :mcbssm_memcompbussrcdtls_fk',['mcbssm_memcompbussrcdtls_fk' => $value['memcompbussrcdtls_pk']])
                    ->asArray()
                    ->all();
                    //print_r($sector_mapped); exit;
                    $sectos_ids = [];
                    $sector_name = [];
                    $sector_name_ar = [];
                foreach($sector_mapped as $key1 => $val) {
                    $sectos_ids[$key1] = $val['mcbssm_sectormst_fk'];
                    $sector_name[$key1] = $val['SecM_SectorName'];
                    $sector_name_ar[$key1] = $val['SecM_SectorName_ar'];
                }

            // $data['items'][$key]['sector_name_arr'] = $sector_name;
            $data['items'][$key]['sector_name_string'] = implode(', ',$sector_name);
            $data['items'][$key]['sector_name_ar_string'] = implode(', ',$sector_name_ar);
            // if(count($sector_name) > 0) {
            //     if(count($sector_name) == 1) {
            //         $data['items'][$key]['sector_name_minimal'] = $sector_name[0];
            //     } else {
            //         $data['items'][$key]['sector_name_minimal'] = $sector_name[0] . " (+" . (count($sector_name)-1) . ")";
            //     }
            // } else {
            //     $data['items'][$key]['sector_name_minimal'] = "-";
            // }
            $data['items'][$key]['sector_data'] = $sectos_ids;
            $data['items'][$key]['sector_mapped'] = $sector_mapped;

            $data['items'][$key]['activities'] = \common\models\MemcompbussrcactivityTbl::getbussrcsectoractivity($value['memcompbussrcdtls_pk']);

            $isicactivities_data=\common\models\MemcompbussrcactivityTbl::getbsbranchactivity($value['bssr_branchpk']);

            $data['items'][$key]['isic_activities'] = $isicactivities_data['isic_act'];
            $data['items'][$key]['isicact_cnt'] = $isicactivities_data['isic_act_cnt'];
            if($stkholdertype==15 || ($stkholdertype==6 && $origin=='N')){
                $divsector = MemcompbussrcdtlsTbl::getbsdivsec($value['memcompbussrcdtls_pk']);
                if(!empty($divsector)){
                        if(count($divsector['actarr']) == 1) {
                            $data['items'][$key]['sector_name_minimal'] = $divsector['actarr'][0];
                            $data['items'][$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0];
                        } else {
                            $data['items'][$key]['sector_name_minimal'] = $divsector['actarr'][0] . " (+" . (count($divsector['actarr'])-1) . ")";
                            $data['items'][$key]['sector_name_ar_minimal'] = $divsector['actarr_ar'][0] . " (+" . (count($divsector['actarr_ar'])-1) . ")";
                        }
                        $data['items'][$key]['division_name']=$divsector['divname'];
                        $data['items'][$key]['sector_name_arr'] = $divsector['actarr'];
                        $data['items'][$key]['sector_name_ar_arr'] = $divsector['actarr_ar'];                       
                }
            }else{
                $data['items'][$key]['sector_name_arr'] = $sector_name;
                $data['items'][$key]['sector_name_ar_arr'] = $sector_name_ar;
                if(count($sector_name) > 0) {
                    if(count($sector_name) == 1) {
                        $data['items'][$key]['sector_name_minimal'] = $sector_name[0];
                        $data['items'][$key]['sector_name_ar_minimal'] = $sector_name_ar[0];
                    } else {
                        $data['items'][$key]['sector_name_minimal'] = $sector_name[0] . " (+" . (count($sector_name)-1) . ")";
                        $data['items'][$key]['sector_name_ar_minimal'] = $sector_name_ar[0] . " (+" . (count($sector_name_ar)-1) . ")";
                    }
                } else {
                    $data['items'][$key]['sector_name_minimal'] = "-";
                    $data['items'][$key]['sector_name_ar_minimal'] = "-";
                }
            }    
        }       
        return $data;
    }
       

         /**
     * @SWG\Get(
     *     path="/bussrc/deletebs",
     *     tags={"Delete Businesssource"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete a product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", pk = "id", type = "int"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionDeletebs() {
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = Bussource::Deletebs($pk);
        return $data; 
    }

    public function actionBussrcfinalsubmit() {
        $bs_pk = $_REQUEST['bsid'];
        $bs_type = $_REQUEST['type'];
        $final_submit = Bussource::bussrcfinalsubmit($bs_pk, $bs_type);
        return $final_submit;
    }

    public function actionGetcontactdata(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = MemcompbussrcdtlsTbl::getcontactdata($pk);
        return $data; 
    }

    public function actionGetbusrclist(){
        $bs_for = $_REQUEST['bs_for'] ? $_REQUEST['bs_for'] : ''; 
        $data = Bussource::getbusinesssourcelist($bs_for);
        return $data;
    }

    public function actionGetbusrcunitlist(){
        $data = Bussource::getbusinesssourceunitlist();
        return $data;
    }

    public function actionGetbusrcunitlistfordivision(){
        $sector_pk = $_REQUEST['id'];
        $data = Bussource::Getbusinesssourceunitlistfordiv($sector_pk);
        return $data;
    }

    public function actionGetsectorlist(){
        $data = Bussource::getsectorlist();
        return $data;
    }

    public function actionGetdivisionlist($type){
        $data = Bussource::getdivisionlist($type);
        return $data;
    }
    
    public function actionAddfactphotos(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['factphotos']['fact_fk'] = Security::decrypt($data['factphotos']['fact_fk']);
        $data = Bussource::addfactphotos($data);
        return $data;
    }

    public function actionGetfactoryimage(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = SupportcollateraldtlsTbl::getfactoryimagedetails($pk);
        return $data; 
    }

    public function actionAddcapacity(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['capacity']['fact_pk'] = Security::decrypt($data['capacity']['fact_pk']);
        $data['capacity']['fact_pk']=Security::sanitizeInput($data['capacity']['fact_pk'],'number');
        $data = Bussource::addcapacity($data);
        return $data;
    }

    public function actionAddtradelocation() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        $new_data['mctd_memcompmplocationdtls_fk'] = Security::sanitizeInput($data['trade_loc_id'],'number');
        $new_data['mctd_memcompfctydtls_fk'] = Security::sanitizeInput(Security::decrypt($data['factdet_pk']),'number');
        $new_data['mctd_modeoftrans'] = Security::sanitizeInput($data['transporttype'],'number');
        $data = Bussource::addtradelocation($new_data);
        
        return $data;
    }

    public function actionGetbussrcunitsector(){
        $data = Bussource::getbussrcunitsector($_REQUEST['bussrcunit'], $_REQUEST['bspk']);
        return $data;
    }

    public function actionGetbussrcunitsectoractlist(){
        $data = [];
        if(!empty($_REQUEST['actids'])){
            $data = Bussource::getbussrcunitsectoractlist($_REQUEST['bussrcunit'], explode(',',$_REQUEST['actids']), $_REQUEST['bspk']);
        }
        return $data;
    }

    public function actionGetbussrcsectoractivity(){
        $bussrc_id = Security::decrypt($_REQUEST['bussrcunit']);
        $data = Bussource::getbussrcsectoractivity($bussrc_id);
        return $data;
    }

    public function actionGetbussrcsectoractivitylist(){
        $data = Bussource::getbussrcsectoractivitylist(explode(',',$_REQUEST['actids']));
        return $data;
    }

    public function actionGetbussrcunitname(){
        $data = Bussource::getbussrcunitname($_REQUEST['bussrcunit']);
        return $data;
    }
    
    public function actionGetcapacity(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = MemcompfctydtlsTbl::getcapacity($pk);
        return $data; 
    }
    
    public function actionFactorytypelist(){
        $data = Bussource::getfactorytypelist();
        return $data; 
    }

    public function actionSavefactpermit()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);
        
        $BSPdata['mcmppd_memcompbussrcdtls_fk'] = Security::sanitizeInput(Security::decrypt($data['bussrcPermit']['memcompbussrcdtls_fk']),'number');
        $BSPdata['mcmppd_permitfile'] = implode(',', $data['bussrcPermit']['procover']);    
        $BSPdata['mcmppd_permitdateofissue'] = Security::isDateValid($data['bussrcPermit']['issuedate'],'Y-m-d');   
        $BSPdata['memcompmppermitdtls_pk'] =  Security::sanitizeInput($data['bussrcPermit']['memcompmppermitdtls_pk'],'number');
        if($data['bussrcPermit']['lifetime'] == null && !$data['bussrcPermit']['lifetime']){
            if($data['bussrcPermit']['expirydate']){
                $BSPdata['mcmppd_permitdateofexpiry'] = Security::isDateValid($data['bussrcPermit']['expirydate'],'Y-m-d');    
            }else{
                $BSPdata['mcmppd_permitdateofexpiry'] = '';
            }
        }
        $content = Security::sanitizeInput($data['content'],'string_spl_char');
        // Calling class file for validation and get the response 
        $bs_obj = new Bussource();
        return $bs_obj->Savefact_permit($BSPdata, $content);
    }

    public function actionAddexport(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['export']['fact_pk'] = Security::decrypt($data['export']['fact_pk']);
        $data['export']['fact_pk'] = Security::sanitizeInput($data['export']['fact_pk'],'number');
        $data = Bussource::addexport($data);
        return $data;
    }

    public function actionGetfactpermitdetails()
    {
        $bsid = Security::sanitizeInput(Security::decrypt($_REQUEST['bsid']),'number');
        $bs_obj = new Bussource();
        return $bs_obj->Getfactpermitdetails($bsid);
    }
    public function actionGetomanorgcert()
    {
        $bsid = Security::sanitizeInput(Security::decrypt($_REQUEST['bsid']),'number');
        $data = MemcompbussrcdtlsTbl::getomanorgcert($bsid);
        return $data; 
    }

    public function actionGetexport(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = MemcompfctydtlsTbl::getexport($pk);
        return $data; 
    }

    public function actionGetlogesticinfo(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $data = MemcomptradingdtlsTbl::getlogesticinfo($pk);
        return $data; 
    }

    public function actionGetbsunitsector() {

        $comp_pk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $mbsdtMdl = MemcompbussrcdtlsTbl::find()->select('group_concat(distinct mcbsd_memcompsecdtls_fk) as pksector')->where('mcbsd_membercompanymst_fk=:company', [':company' => $comp_pk])->andWhere(['!=','mcbsd_isdeleted', 1])->asArray()->all();
        //$mbsdtMdl = MemcompbussrcdtlsTbl::find()->select('group_concat(distinct mcbsd_memcompbranchdtlstemp_fk) as pksector')->where('mcbsd_membercompanymst_fk=:company', [':company' => $comp_pk])->andWhere(['!=','mcbsd_isdeleted', 1])->asArray()->all();
        $mbreturnMdl = [];
        if(!empty($mbsdtMdl[0]['pksector'])){
        $mbreturnMdl = MemcompbussrcdtlsTbl::find()->select(['sec.SectorMst_Pk','sec.SecM_SectorName','SecM_SectorName_ar','sec.SecM_SectorCode','mcbsd_memcompsecdtls_fk'])
            ->leftJoin(MemcompsectordtlsTbl::tableName(),'mcbsd_memcompsecdtls_fk=MemCompSecDtls_Pk')
            ->leftJoin('sectormst_tbl as sec','find_in_set(sec.SectorMst_Pk, MCSD_SectorMst_Fk)')
            ->where('mcbsd_memcompsecdtls_fk in('.$mbsdtMdl[0]['pksector'].')')->andWhere(['!=','mcbsd_isdeleted', 1])->groupBy('sec.SectorMst_Pk')->orderBy('sec.SecM_SectorName asc')->asArray()->all();
        }
         
        return $this->asJson($mbreturnMdl);
    }
    public function actionRemovebusselectedactivties() {
        $pk_dec = Security::decrypt($_REQUEST['bsid']);
        $bs_pk=Security::sanitizeInput($pk_dec,'number');
        $final_submit = Bussource::bussrcremoveactivity($bs_pk);
        return $final_submit;
    }

    public function actionDeletelocation() {
        $location_id = $_REQUEST['locid'];

        $data['loc_id'] = $location_id;
        
        $final_submit = Bussource::deletelocation($data);
        return $final_submit;
    }

    public function actionFactoryfinalsubmit() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $final_submit = Bussource::factoryfinalsubmit($data);
        return $final_submit;
    }

    public function actionRemovemanufacturerdet() {
        $bus_id = Security::decrypt($_REQUEST['bsid']);
        
        $final_submit = Bussource::removemanufacturerdet($bus_id);
        return $final_submit;
    }

    public function actionGetautocompletescf() {
        $get_sugg = \common\models\MembercompanymstTbl::getautocompletedatas();
        return $get_sugg;
    }

    public function actionGetuserdetails() {
        $user_pk = Security::decrypt($_REQUEST['pk']);
        if($user_pk) {
            $user_det = UsermstTbl::getUserData($user_pk);
        }
        return $user_det;
    }

    public function actionSaveomanorgcert()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);
        $data['bussrcPermit']['memcompbussrcdtls_pk'] = Security::decrypt($data['bussrcPermit']['memcompbussrcdtls_pk']);
        $BSPdata= MemcompbussrcdtlsTbl::find()->where('memcompbussrcdtls_pk=:id',array(':id' => $data['bussrcPermit']['memcompbussrcdtls_pk']))->andWhere(['!=','mcbsd_isdeleted', 1])->one();
        
        $BSPdata->mcbsd_hasnatprod = Security::sanitizeInput($data['bussrcPermit']['mcbsd_hasnatprod'],'number');
        if($BSPdata->mcbsd_hasnatprod==1){
        $BSPdata->mcbsd_natprodissuedate = Security::isDateValid($data['bussrcPermit']['issuedate'],'Y-m-d');
        $BSPdata->mcbsd_natprodexpirydate = Security::isDateValid($data['bussrcPermit']['expirydate'],'Y-m-d');
        $BSPdata->mcbsd_natprodcertdoc = implode(',', $data['bussrcPermit']['orgcert']);
        }else{
        $BSPdata->mcbsd_natprodissuedate = NULL;
        $BSPdata->mcbsd_natprodexpirydate = NULL;
        $BSPdata->mcbsd_natprodcertdoc = NULL;
        }
        if($BSPdata->save())
        {
            $data1['mcbsd_hasnatprod']=$BSPdata->mcbsd_hasnatprod;
            $data1['mcbsd_natprodissuedate']=$BSPdata->mcbsd_natprodissuedate;
            $data1['mcbsd_natprodexpirydate']=$BSPdata->mcbsd_natprodexpirydate;
            $data1['mcbsd_natprodcertdoc']=$BSPdata->mcbsd_natprodcertdoc;
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($BSPdata->getErrors());
        }
    }
    public function actionDeleteomanorgcert()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        if($data['bussrcPk']){
        $data['bussrcPk'] = Security::decrypt($data['bussrcPk']);
        
        $BSPdata= MemcompbussrcdtlsTbl::find()->where('memcompbussrcdtls_pk=:id',array(':id' => $data['bussrcPk']))->andWhere(['!=','mcbsd_isdeleted', 1])->one();
        $BSPdata->mcbsd_hasnatprod = NULL;
        $BSPdata->mcbsd_natprodissuedate = NULL;
        $BSPdata->mcbsd_natprodexpirydate = NULL;
        $BSPdata->mcbsd_natprodcertdoc = NULL;
        if($BSPdata->save())
        {
             $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($BSPdata->getErrors());
        }
        }
    }

    public function actionBranchList(){
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        
        $bus_id = Security::decrypt($_REQUEST['bs_pk']);
        $branchids='';
        $selectedbranchfinal_data=[];

        if(!empty($bus_id) && $bus_id!=null && $bus_id!="undefined"){
            $bussourceModel = MemcompbussrcdtlsTbl::find()->where([
                'memcompbussrcdtls_pk'    =>  $bus_id
            ])->andWhere(['!=','mcbsd_isdeleted', 1])->one();

            if(!empty($bussourceModel) && $bussourceModel->mcbsd_memcompbranchdtlstemp_fk!=null && $bussourceModel->mcbsd_memcompbranchdtlstemp_fk!=''){
                $branchids=$bussourceModel->mcbsd_memcompbranchdtlstemp_fk;
            }
    
        }
       
        if($branchids!=''){
            $br_idss=array_map('intval', explode(',', $branchids));
            $selectedbranchlistData=MemcompbranchdtlstempTbl::find()->select([
                'memcompbranchdtlstemp_pk as brtemp_pk',
                'mcbdt_branchname as br_name',
                'mcbdt_branchnumber as br_number',
                'mcbdt_scfstatus as scfstatus',
                "mcbdt_indzoneregno as indszone_regno",
                'mcbdt_isicactivitymst_fk as isicactvpks',
                'mcbdt_upload as actvlicensepk',
                "izm_zonename_en as izm_zonename_en",
                "izm_zonename_ar as izm_zonename_ar",
                "iem_estatename_en as iem_estatename_en",
                "iem_estatename_ar as iem_estatename_ar",'otm_officename_ar as officetypename_ar',
                'mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
                'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename','blm_licesename_en as busslicense_en','blm_licensename_ar as busslicense_ar'
                
                ])
            ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
            ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
            ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
            ->leftJoin('businesslicensemst_tbl',' businesslicensemst_pk=mcbdt_businesslicensemst_fk')
            ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
            ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
            ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
            ->where(['in','memcompbranchdtlstemp_pk',$br_idss])
            ->orderBy('mcbdt_branchname asc')->asArray();
            $selectBranch=new ActiveDataProvider([ 'query' => $selectedbranchlistData]);
    
    
            $br_isicact_idss = [];
            $finactdata=[];
            $activitieslist=[];
            
            foreach($selectBranch->getModels() as $brval) {
    
                if($brval['isicactvpks']!='' && $brval['isicactvpks']!=null){
                    $brval['isicact_cnt']=count(explode(',',$brval['isicactvpks']));
                }else{
                    $brval['isicact_cnt']=0;
                }

                $activitieslist= \api\modules\mst\models\ActivitiesmstTbl::find()
                ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
                ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                ->where(['in','ActivitiesMst_Pk', explode(',',$brval['isicactvpks']) ])
                ->andWhere(['ActM_Status'=>'A'])
                ->asArray()->all();
                $isic_activitiesdata=[];
                $sectidss=[];
                foreach ($activitieslist as $key => $value) {
                    $actarr = [];
                    foreach ($activitieslist as $key => $actval) {
        
                        
                        if ($value['ActM_SectorMst_Fk'] == $actval['ActM_SectorMst_Fk']) {
                            $actarr[] = $actval;
                        }
                    }
                    if (!in_array($value['ActM_SectorMst_Fk'], $sectidss)) {
                        $isic_activitiesdata[] = ['SecM_SectorName' => $value['SecM_SectorName'],'SecM_SectorName_ar' => $value['SecM_SectorName_ar'],'ActM_SectorMst_Fk'=>$value['ActM_SectorMst_Fk'], 'actarr' => $actarr];
                        $sectidss[] = $value['ActM_SectorMst_Fk'];
                    }
                }

                $files = [];
                if($brval['actvlicensepk'] ) {
                    foreach(explode(',', $brval['actvlicensepk']) as $filePk) {
                        $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                        $files[] = [
                            'name' => $fileObj->mcfd_origfilename,
                            'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                            'size' => $fileObj->mcfd_actualfilesize,
                            'type' => $fileObj->mcfd_filetype
                        ];
                    }
                    // $brval['license_files'] = $files;
                }

                $brval['license_files'] = $files;
                $proVal['tot_isicCnt']=count($activitieslist);
                $brval['isicactivities']=$isic_activitiesdata;
                

    
                $selectedbranchfinal_data[]=$brval;
   
            }
        }

        $branchfinal_data=[];
        $branchlistData=MemcompbranchdtlstempTbl::find()->select([
            'memcompbranchdtlstemp_pk as brtemp_pk',
            'mcbdt_branchname as br_name',
            'mcbdt_branchnumber as br_number',
            "mcbdt_indzoneregno as indszone_regno",
            'mcbdt_scfstatus as scfstatus',
            'mcbdt_isicactivitymst_fk as isicactvpks',
            'mcbdt_upload as actvlicensepk',
            "izm_zonename_en as izm_zonename_en",
            "izm_zonename_ar as izm_zonename_ar",
            "iem_estatename_en as iem_estatename_en",
            "iem_estatename_ar as iem_estatename_ar",
            'otm_officename_en as officetypename',
            'otm_officename_ar as officetypename_ar',
            'blm_licesename_en as busslicense_en','blm_licensename_ar as busslicense_ar'
            ])
        ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
        ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
        ->leftJoin('businesslicensemst_tbl',' businesslicensemst_pk=mcbdt_businesslicensemst_fk')
        ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
        ->where(['mcbdt_memcompmst_fk'=>$compPK])
        ->andWhere(['mcbdt_isdeleted'=>2])
        ->orderBy('mcbdt_branchname asc')->asArray();
        $provider=new ActiveDataProvider([ 'query' => $branchlistData]);
        
        $br_isicact_idss = [];
        $finactdata=[];
        $activitieslist=[];
        //$isic_activitiesdata=[];

        foreach($provider->getModels() as $proVal) {

            if($branchids!=''){
                $selbrnachpk=explode(',',$branchids);
                if(in_array($proVal['brtemp_pk'],$selbrnachpk)){
                    $proVal['sel_brnach']=1;
                }else{
                    $proVal['sel_brnach']=0;
                }
            }

            if($proVal['isicactvpks']!='' && $proVal['isicactvpks']!=null){
                $proVal['isicact_cnt']=count(explode(',',$proVal['isicactvpks']));
            }else{
                $proVal['isicact_cnt']=0;
            }
            $isic_activitiesdata1 =[];
            $sectidss=[];
            $activitieslist= \api\modules\mst\models\ActivitiesmstTbl::find()
            ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
            ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
            ->where(['in','ActivitiesMst_Pk', explode(',',$proVal['isicactvpks']) ])
            ->andWhere(['ActM_Status'=>'A'])
            ->asArray()->all();            
            foreach ($activitieslist as $key => $value) {
                $actarr1 = [];
                foreach ($activitieslist as $key => $actval) {
    
                    
                    if ($value['ActM_SectorMst_Fk'] == $actval['ActM_SectorMst_Fk']) {
                        $actarr1[] = $actval;
                    }
                }
                if (!in_array($value['ActM_SectorMst_Fk'], $sectidss)) {
                    $isic_activitiesdata1[] = ['SecM_SectorName' => $value['SecM_SectorName'],'SecM_SectorName_ar' => $value['SecM_SectorName_ar'],'ActM_SectorMst_Fk'=>$value['ActM_SectorMst_Fk'], 'actarr' => $actarr1];
                    $sectidss[] = $value['ActM_SectorMst_Fk'];
                }
            }

            $files = [];
            if($proVal['actvlicensepk'] ) {
                foreach(explode(',', $proVal['actvlicensepk']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
                // $proVal['license_files'] = $files;
            }

            $proVal['license_files'] = $files;
            $proVal['tot_isicCnt']=count($activitieslist);
            $proVal['isicactivities']=$isic_activitiesdata1;

            $branchfinal_data[]=$proVal;

        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'branch_count'=>$provider->getTotalCount(),
            'branchList'=>$branchfinal_data,
            'limit' => $page_size,
            'selectedbranches'=>$selectedbranchfinal_data,
            'bssr_refname'=>$bussourceModel->mcbsd_refname,
            'bssr_uid'=>$bussourceModel->mcbsd_uid
        );

        return $result;
       
        

    }
    public function actionBranchescount(){
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $branchlistData=MemcompbranchdtlstempTbl::find()->select(['mcbdt_isicactivitymst_fk'])
        ->where(['mcbdt_memcompmst_fk'=>$compPK])
        ->orderBy(['memcompbranchdtlstemp_pk'=>SORT_DESC])->asArray()->all();
        $isic_count = 1;
        if(count($branchlistData)==1){
            if($branchlistData[0]['mcbdt_isicactivitymst_fk']=='' || $branchlistData[0]['mcbdt_isicactivitymst_fk']==null){
                $isic_count= 0;
            }
        }
        return $isic_count;
    }
    public function actionAddbussrBranch(){

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $addbranchdata = MemcompbussrcdtlsTbl::addbussr_branchpk($data);

        return $addbranchdata;

    }

    public function actionHsSectionList(){

        $hs_sectiondata=HssectionmstTbl::find()->where(['hssm_status'=>1])->asArray()->all();
        return  $hs_sectiondata; 

    }

    public function actionHsChapterList(){

        $sec_id=Security::decrypt($_GET['secval']);

        // $sec_id=$_GET['secval'];
        $hs_chapterdata=HschaptermstTbl::find()
        ->where(['hscm_hssectionmst_fk'=>$sec_id])
        ->andwhere(['hscm_status'=>1])
        ->orderby('hscm_chaptername_en asc')
        ->asArray()->all();
        return  $hs_chapterdata; 

    }


    public function actionHsHeadingList(){

        $chap_id=Security::decrypt($_GET['chaptval']);
        $hs_headingdata=HsheadingmstTbl::find()
        ->where(['hshm_hschaptermst_fk'=>$chap_id])
        ->andwhere(['hshm_status'=>1])
        ->orderby('hshm_headingname_en asc')
        ->asArray()->all();
        return  $hs_headingdata; 

    }

    public function actionHsSubheadingList(){

        $head_id=Security::decrypt($_GET['headval']);
        $hs_sub_headingdata=HssubheadingmstTbl::find()
        ->where(['hsshm_hsheadingmst_fk'=>$head_id])
        ->andwhere(['hsshm_status'=>1])
        ->orderby('hsshm_subheadingname_en asc')
        ->asArray()->all();
        return  $hs_sub_headingdata; 

    }

    public function actionBsunitid(){
        $bspk=$head_id=Security::decrypt($_GET['bs_pk']);
        $business_srcunit = MemcompbussrcdtlsTbl::find()->select(['mcbsd_businesssourcemst_fk as sectype'])
        ->where('memcompbussrcdtls_pk=:bus',[':bus'=>$bspk])
        ->andWhere(['!=','mcbsd_isdeleted', 1])
        ->asArray()
        ->one();
        
        return $business_srcunit;

    }

    public function actionCompanyinformation(){
        $response = [];
        $id = Security::decrypt(Security::sanitizeInput($_REQUEST['companypk'], "string_spl_char")); 
        if(!empty($id)){
            $response = MembercompanymstTbl::getCompanyInformation($id);
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }

    public function actionBsourceBranchsectordivision(){

        $bus_id = Security::decrypt($_REQUEST['bs_pk']);
        $isic_activitiesdata=MemcompbussrcdtlsTbl::getbsdivsec($bus_id); 
        return $isic_activitiesdata;
      

    }
    public function actionGetsectionlist($request =  null) {
        $searchkey = $_REQUEST['searchkey'];
        $sectionlist = HssectionmstTblQuery::getlist($searchkey);
        return json_encode($sectionlist);
    }
    public function actionGetchapter($chapval = null)
    {
        $chapterlist = HschaptermstTblQuery::getchapter($chapval);
        return json_encode($chapterlist);
    }
    public function actionGetheadinglist($request = null)
    {
        $chapterlist = HsheadingmstTblQuery::getheadinglist($request);
        return json_encode($chapterlist);
    }
    public function actionGetgroupsubheadinglist($request = null)
    {
        $chapterlist = HsgroupingsubheadingTblQuery::getgroupsubheadinglist($request);
        return json_encode($chapterlist);
    }
    public function actionGetsubheadinglist($request = null)
    {
        $chapterlist = HssubheadingmstTblQuery::getsubheadinglist($request);
        return json_encode($chapterlist);
    }
    public function actionSaveexpinfo()
    {
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['fatory_pk'] = Security::decrypt($data['fatory_pk']);
        if($data['editexportinfoPk']!=null){
            $data['editexportinfoPk'] = Security::decrypt($data['editexportinfoPk']);
        }
        $data_return=Bussource::saveExpinfo($data);
        
        return $data_return;
    }
    public function actionGetoverallsearch(){
        $searchkey = $_REQUEST['searchkey'];
        $allsectionlist = Bussource::getoverallsearch($searchkey);
        return json_encode($allsectionlist);
    }
    public function actionGetexportinfo(){
        $fatoryid = Security::decrypt($_REQUEST['fatoryid']);
        $exportdata = Bussource::getexportinfo($fatoryid);
        return json_encode($exportdata);
    }
    public function actionRemoveexportinfo(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['expoinfoid'] = Security::decrypt($data['expoinfoid']);
        $data['factory_pk'] = Security::decrypt($data['factory_pk']);
        $removexportdata = Bussource::removeexportinfo($data);
        return json_encode($removexportdata);
    }
    public function actionUpdateexporttatus(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['factory_pk'] = Security::decrypt($data['factory_pk']);
        $updateexportstatus = Bussource::updateexporttatus($data);
        return json_encode($updateexportstatus);
    }
    public function actionDeletefactgallery(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['fact_pk'] = Security::decrypt($data['fact_pk']);
        $deletestatus = Bussource::deleteFactoryGallery($data);
        return json_encode($deletestatus);
    }
}