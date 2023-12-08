<?php
namespace api\modules\pm\controllers;

use api\modules\mst\models\MemcompprodmarketpresenceTbl;
use api\modules\mst\models\MemcompprofilesectoractivitydtlsTbl;
use api\modules\mst\models\MemcompprofilesectordtlsTbl;
use api\modules\pd\models\ProjfaqdtlsTbl;
use api\modules\pd\models\ProjfaqhstyTbl;
use common\models\AssettypemstTbl;
use common\models\BusinesssourcemstTbl;
use common\models\FactorytypemstTbl;
use common\models\MctbrsecgrddtlsTbl;
use common\models\MemcompfctycertTbl;
use common\models\MemcompfctydtlsTbl;
use common\models\MemcompfctyinfradtlsTbl;
use common\models\MemcompmplocationdtlsTbl;
use common\models\MemcompproddtlsTbl;
use common\models\MemcompsectoractivitydtlsTbl;
use common\models\MemcompservicedtlsTbl;
use common\models\MemcompbussrcdtlsTbl;
use common\models\MemcompservmarketpresenceTbl;
use common\models\MemcompservspecdtlsTbl;
use common\models\MemcompspecprodvaldtlsTbl;
use common\models\MemcompspecservvaldtlsTbl;
use common\models\MemcomptradingdtlsTbl;
use common\models\SuppcertformpartrntmpTbl;
use common\models\UsermstTbl;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\Url;
use \common\models\DepartmentmstTbl;
use \common\models\SpecificationmstTbl;
use \api\modules\mst\models\ActivitiesmstTbl;
use \api\modules\mst\models\ClassmstTbl;
use \api\modules\mst\models\FamilymstTbl;
use \api\modules\mst\models\IndustrymstTbl;
use \api\modules\mst\models\ProductmstTbl;
use \api\modules\mst\models\SegmentmstTbl;
use Yii;
use common\components\Common;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use \common\models\MemcompprofcertfdtlsTbl;
use common\components\Sessionn;
use common\components\Profile;
use common\components\Products;
use common\components\Services;
use \common\models\MemcompstakeholderdtlsTbl;
use \common\models\MemcompprofachvdtlsTbl;
use \common\models\MemcompmarketpresencedtlsTbl;
use \api\modules\mst\models\SectormstTbl;
use \common\models\MemcompsectordtlsTbl;
use \common\models\MemcompprodspecdtlsTbl;
use \common\models\MemcompprofsuppattdtlsTbl;
use  common\components\Configuration;
use common\components\Configsession;
use common\components\CommonDb;
use \common\models\MogprodservcodemstTbl;
use common\components\Search;
use \api\modules\mst\models\ServicemstTbl;
use \common\models\MemcompprodservagentsprncpTbl;
use common\components\User;
use \common\components\Security;
use common\models\MemcompfiledtlsTbl;
use common\components\Drive;
use api\modules\mst\models\BgiindcodecategTblQuery;
use api\modules\mst\models\BgiindcodesubcategTblQuery;
use api\modules\mst\models\BgiinduscodeprodmstTblQuery;
use api\modules\mst\models\BgiinduscodeservmstTblQuery;
use api\modules\mst\models\UnspcbipcmappingTbl;
use \api\modules\mst\models\UnsscbiscmappingTbl;
use \app\models\MemcompbranchdtlstempTbl;
use \yii\data\ActiveDataProvider;


//use yii\base\ErrorException;

class ProfileController extends NbfMasterController
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
     * @param respective table fields
     * This method is used to insert single tables
     * @return Json
     */
    public function actionSingleinsertion()
    {
        $profile = new Profile();
        $profile_data = $profile->homeprofile();
        return json_encode($profile_data);
    }

    /**
     * @param string CompanyName in header, Company Name
     * @param file CompLogoFilePath in header, Company Logo
     * @param string RegistrationNo in header, Registration Number
     * @param string RegistrationYear in header, Registration Year
     * @param file ImgUploadFilePath in header, the toke
     * This method is used to insert single tables
     */

    public function actionCreatecorporate()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if(!empty($data['membercompanymst'])){
            $membercompanymst  = CommonDb::singleInsertion($data['membercompanymst'], 'membercompanymst');
            $create = $membercompanymst['modelname']::insertData($membercompanymst['data']);
        }
        if($data['memcompgendtls']){
            $memcompgendtls = CommonDb::singleInsertion($data['memcompgendtls'], 'memcompgendtls');
            $memcompgendtls_create = $memcompgendtls['modelname']::insertData($memcompgendtls['data']);
        }
        if($data['privacy']){
            $memcompgendtls_create = \common\models\MembercompanymstTbl::form_privacy_certificate_json($data['privacy']);
        }

        if(!empty($data['turnover'])){
            $data = json_encode($data);
            $add_turnover = \common\models\MemcompgendtlsTbl::insert_turnover($data);
        }
        $decodedData=json_decode($data);
        if(!empty($decodedData->documents)){
            $decodedData=json_decode($data);
            $crFiles=$decodedData->documents->cr_cert[0]->selectedFiles;
            if(count($crFiles)>0){
                foreach($crFiles as $file){
                    $saveFileDtls = \common\models\MemcompprofcertfdtlsTblQuery::saveCertificateDtls($file,'Commercial Certificate');
                    $saveFile = \common\models\MemcompprofcertimgdtlsTblQuery::saveCertficatePk(
                        $saveFileDtls['filePk'],
                        $saveFileDtls['pk']
                    );
                }
            }
            $cocFiles=$decodedData->documents->coc_cert[0]->selectedFiles;
            if(count($cocFiles)>0){
                foreach($cocFiles as $file){
                    $saveFileDtls = \common\models\MemcompprofcertfdtlsTblQuery::saveCertificateDtls($file,'Chamber Certificate');
                    $saveFile = \common\models\MemcompprofcertimgdtlsTblQuery::saveCertficatePk(
                        $saveFileDtls['filePk'],
                        $saveFileDtls['pk']
                    );
                }
            }
            $mlFiles=$decodedData->documents->ml_cert[0]->selectedFiles;
            if(count($mlFiles)>0){
                foreach($mlFiles as $file){
                    $saveFileDtls = \common\models\MemcompprofcertfdtlsTblQuery::saveCertificateDtls($file,'Municipality license');
                    $saveFile = \common\models\MemcompprofcertimgdtlsTblQuery::saveCertficatePk(
                        $saveFileDtls['filePk'],
                        $saveFileDtls['pk']
                    );
                }
            }
        }
        
        if(!empty($decodedData->logo)){
            $data=\yii\db\ActiveRecord::getTokenData();
            $logo=$decodedData->logo->orgLogo[0]->selectedFiles;
            $membCompany= \common\models\MembercompanymstTbl::find()
                 ->where(['MemberCompMst_Pk' => $data->MemberCompMst_Pk])->one();
            if(count($membCompany)>0){
                $membCompany->mcm_complogo_memcompfiledtlsfk=$logo[0]->filePk;
                $membCompany->save();
            }
            
            
        }

        if($create['status'] == 1 || $memcompgendtls_create['status'] == 1 || $add_turnover['status'] == 1 || $saveFile){
            return json_encode([
                "msg" => "success",
                "status" => 1
            ]);
        }
    }


    /**
     * This method is used to fetch homeprofile details
     * @param  int  company_id in header, Company pk
     */

    public function actionGethomeprofile()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $token=ActiveRecord::getTokenData();
        $profile_data = $profile->getHomeprofile($id,$this->getTokenData());
        return json_encode($profile_data);
    }


    /**
     * This method is used to fetch homeprofile details
     * @param  int  reg_id in header, memberregistrationmst_pk
     */

    public function actionGetcorporateprofile()
    {
        $id = $_REQUEST['reg_id'];
        $profile = new Profile();
        $profile_data = $profile->getCorporateProfile($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to insert single upload in the db
     * @param string key in header, file key
     *
     */
    public function actionFileupload()
    {
        $key = $_REQUEST['key'];
        $filename = $_REQUEST['file_name'];
        $jsonarr = Configuration::getfilekeyvalue("DMS", $key);
        if (!empty($_REQUEST['key']) && !empty($_REQUEST['file_name'])) {
            !empty($jsonarr) ? $upload = Common::file_upload_temp($jsonarr, $filename) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        } else {
            !empty($jsonarr) ? $upload = Common::fileupload($jsonarr, $_FILES) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        }
        return json_encode($upload);
    }

    /**
     * This method is used to insert Accomplishment data
     * @param int type in header, Accomplishment
     * @param string title in header, Title of the Accomplishment
     * @param file file in header, File if any available
     * @param date issued_on in header, Date of Issue
     * @param int issued_by in header, Name of the Person who issued this
     * @param date achvyear in header, the toke
     * @param string desc in header, Description of the Accomplishment
     * @return Json|string
     */

    public function actionCreateaccomplishment()
    {
        $profile = new Profile();
        $create = $profile->createAccomplishment();
        return json_encode($create);
    }

    /**
     * This method is used to get Accomplishment details
     * @param int company_id key in header, company pk
     *
     */

    public function actionGetaccomplishment()
    {
        $profile = new Profile();
        $profile_data = $profile->getAccomplishment($this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to get certificate details
     * @param int company_id key in header, company pk
     *
     */

    public function actionGetcertfdtls()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getCertfdtls($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to get certificate details
     * @param int company_id key in header, company pk
     *
     */

    public function actionAccomplishmentpriority()
    {
        $arr = explode(",", $_REQUEST['orderlist']);
        $profile_data = MemcompprofachvdtlsTbl::acmplishPriority(($arr));
        return json_encode($profile_data);
    }

    /**
     * This method is used to delete Accomplishment
     * @param int id in header, pk of the row that has to be deleted
     */
    public function actionDeleteaccomplishment()
    {
        if (!empty($_REQUEST['pk'])) {
            $delete = MemcompprofachvdtlsTbl::deleteAccomplishment($_REQUEST['pk']);
        } else {
            $delete =  [
                'msg' => "invalid parameters",
                'status' => 0,
            ];
        }
        return json_encode($delete);
    }

    /**
     * This method is used to create certificates
     * @param string name in header, Certificate/Award Name
     * @param string type in header, Type
     * @param enum imgstatus in header,'Y' or 'N'
     */

    public function actionCreatecertf()
    {
        $profile = new Profile();
        $profile_data = $profile->createCertf($this->getTokenData());
        return json_encode($profile_data);
    }
    /**
     * This method is used to delete certificate
     * @param int id in header, pk of the row that has to be deleted
     */
    public function actionDeletecertf($id)
    {
        if (!empty($id)) {
            $delete = MemcompprofcertfdtlsTbl::deleteCertf($id);
        } else {
            $delete =  [
                'msg' => "invalid parameters",
                'status' => 0,
            ];
        }
        return json_encode($delete);
    }

    /**
     * This method is used to Create Tender Board Registration
     * @param int regno in header, Registration Number of the oman registration
     * @param date expiry in header, Expiry date of the Oman Registration
     * @param int grade in header, TBGrademst_pk
     */
    public function actionCreatetnbrd()
    {
        $profile = new Profile();
        $profile_data = $profile->createTnbrd($this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch Tender Registration Details
     * @param int company_id in header, company pk
     */
    public function actionGettnbrd()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getTnbrd($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to delete Tender Registration
     * @param int id in header, mctbrsecgrddtls_pk
     */

    public function actionDeletetnbrd($id)
    {
        if (!empty($id)) {
            $delete = MctbrsecgrddtlsTbl::deleteTnbrd($id);
        } else {
            $delete = [
                'msg' => "invalid parameters",
                'status' => 0,
            ];
        }
        return json_encode($delete);
    }

    /**
     * This method is used to Create Stakeholders
     * @param String name in header, Name of the Stakeholder
     * @param String designation in header, Designation of the Stakeholder
     */
    public function actionCreatestkholder()
    {
        $profile = new Profile();
        $profile_data = $profile->createStkholder($this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch stakeholders
     * @param int company_id in header, company pk
     */
    public function actionGetstkholder()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getStkholder($id,$this->getTokenData());
        return json_encode($profile_data);
    }


    /**
     * This method is used to delete Stakeholders
     * @param int id in header, memcompstakeholderdtls_pk
     */
    public function actionDeletestkholder($id)
    {
        $pk = $id;
        $delete = MemcompstakeholderdtlsTbl::deleteStkhold($pk);
        return json_encode($delete);
    }

    /**
     * This method is used to create market presence
     * @param String title in header, Achievement Title
     * @param String client in header, Achievement Client
     * @param String desc in header, Description of the Achievement
     */
    public function actionCreateachvmt()
    {
        $profile = new Profile();
        $profile_data = $profile->createAchvmt($this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch Achievements
     * @param int company_id in header, company pk
     */
    public function actionGetachvmt()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getAchvmt($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to delete Achievements
     * @param int id in header, memcompprofachvdtls_pk
     */
    public function actionDeleteachvmt($id)
    {
        $pk = $id;
        $delete = MemcompprofachvdtlsTbl::deleteAchvmt($pk);
        return json_encode($delete);
    }

    /**
     * This method is used to create market presence
     * @param String name in header, Name of the Company
     * @param String address in header, Address of the Company
     * @param String compdesc in header, Description of the Company
     * @param enum category in header, Category B - Branch R - Representative Office  C - Clientele
     * @param int country in header, countrymst_pk
     * @param int state in header, statemst_pk
     * @param int city in header, citymst_pk
     * @param enum location in header, Location N - National  I - International
     * @param int businessscope in header, Business Scope T -Trade P - Project I - Investment S - Strategic Partner
     * @param int repdesc in header, Representaion Description of the company
     */
    public function actionCreatemrktprsnce()
    {
        $profile = new Profile();
        $profile_data = $profile->createMrktprsnce($this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch market presence details
     * @param int company_id in header, company pk
     */
    public function actionGetmrktprsnce()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getMrktprsnce($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to delete market presence
     * @param int id in header, memcompmarketpresencedtls_pk
     */
    public function actionDeletemrktprsnce()
    {
        $pk = $_GET['pk'];
        $delete = MemcompmarketpresencedtlsTbl::deletemrktprsence($pk);
        return json_encode($delete);
    }

    /**
     * This method is used to fetch Industries based on a sector
     * @param int sector_id in header, sectormst_pk
     */
    public function actionGetindustries()
    {
        $profile = new Profile();
        $profile_data = $profile->getIndustries();
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch sectors
     * No parameters required
     */
    public function actionGetsectors()
    {
        $sector = SectormstTbl::getSectors();
        return json_encode($sector);
    }

    /**
     * This method is used to fetch Incorporation Style
     * @param int country_id in header, countrymst_pk
     */
    public function actionGetincorpstyle()
    {
        
        $id = $_REQUEST['country_id'];
        $stktype = $_REQUEST['stkholdertype'];
        $profile = new Profile();
        $profile_data = $profile->getIncorpStyle($id, $stktype);
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch activites based on a sector
     * @param int sectorid in header, sectormst_pk
     * @param int industryid in header, industrymst_pk
     */
    public function actionGetactivityfromsector()
    {
        $profile = new Profile();
        $profile_data = $profile->getActivityfromsector();
        return json_encode($profile_data);
    }

    /**
     * This method is used to create activities
     * @param int industry in header, sectormst_pk
     * @param int sector in header, industrymst_pk
     * @param int activities in header, activities count
     */
    public function actionCreateactivities()
    {
        $profile = new Profile();
        $profile_data = $profile->createActivities($this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch activities
     * @param int company_id in header, company pk
     */
    public function actionGetactivities()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getActivities($id,$this->getTokenData());
        return json_encode($profile_data);
    }


    /**
     * This method is used to delete activities
     * @param int id in header, memcompprodspecdtls_pk
     */
    public function actionDeleteactivities($id)
    {
        $pk = $id;
        $delete = MemcompsectordtlsTbl::deleteActivities($pk);
        return json_encode($delete);
    }

    /**
     * This method is used to create a product specification
     * @param int productpk in header, memcompproddtls_pk
     * @param int spec in header, Specificationmst_pk
     * @param String desc in header, Description
     */
    public function actionCreateprodspec()
    {
        $profile = new Products();
        $profile_data = $profile->createProdspec();
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch product specification
     * @param int company_id in header, company pk
     */
    public function actionGetprodspec()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Products();
        $profile_data = $profile->getProdspec($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to delete product specification
     * @param int id in header, memcompprodspecdtls_pk
     */
    public function actionDeleteprodspec($id)
    {
        $pk = $id;
        $delete = MemcompprodspecdtlsTbl::deleteProdSpec($pk);
        return json_encode($delete);
    }

    /**
     * This method is used to create support collateral
     * @param String title in header, Presentation Title
     */
    public function actionCreatesuppcollateral()
    {
        $profile = new Profile();
        $profile_data = $profile->createSuppCollateral($this->getTokenData());
        return json_encode($profile_data);
    }
    
    public function actionCreateBusinessSource() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        if(!empty($company_id)) {
            $company_id = $session->MemberCompMst_Pk;
        }
        
        $data['mcbsd_businessrc'] = \common\components\Security::sanitizeInput($_REQUEST['mcbsd_businessrc'],"number");
        $data['mcbsd_refname'] = \common\components\Security::sanitizeInput($_REQUEST['mcbsd_refname'],"string");
        $data['type'] = 'insert';
        $bussource_data = MemcompbussrcdtlsTbl::insertBusinesssource($data);
        
        $return = ['error' => 'Error in data save'];
        if($bussource_data->memcompbussrcdtls_pk) {
            $return = ['memcompbussrcdtls_pk' => $bussource_data->memcompbussrcdtls_pk];
        } 
        return json_encode($bussource_data);
    }


    /**
     * This method is used to fetch support collateral
     * @param int company_id in header, company pk
     */
    public function actionGetsuppcollateral()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Profile();
        $profile_data = $profile->getSuppCollateral($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to delete support collateral
     * @param int id in header, memcompprofsuppattdtls_pk
     */
    public function actionDeletesuppcollateral($id)
    {
        $pk = $id;
        $delete = MemcompprofsuppattdtlsTbl::deleteProdSpec($pk);
        return json_encode($delete);
    }

    /**
     * @SWG\Post(
     *     path="/pm/profile/getprodlist",
     *     tags={"Get Product List"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get a Product List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompproddtls", type="object",
        *                  @SWG\Property(property="MCPrD_DisplayName", type="string", example=""),
        *                  @SWG\Property(property="PrdM_ProductName", type="string", example=""),
        *                  @SWG\Property(property="MCPrD_SearchKeyword", type="integer", example=""),
        *                  @SWG\Property(property="MCPrD_CreatedOn", type="date", example=""),
        *                  @SWG\Property(property="MCPrD_UpdatedOn", type="date", example=""),
        *                  @SWG\Property(property="PrdM_Status", type="string", example=""),
        *                  @SWG\Property(property="MPSRD_RevPoint", type="string", example=""),
        *                  @SWG\Property(property="MCPrD_BusSource", type="string", example=""),
        *                  @SWG\Property(property="PrdM_ProductCode", type="string", example=""),
        *                  @SWG\Property(property="MCPrD_ProdPercent", type="integer", example=""),
	*                  @SWG\Property(property="MCPrD_NationalProdStatus", type="integer", example=""),
        *          ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprodlist()
    { //print_r("expression");die();
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        $extprof = false;
        $id = $_REQUEST['company_id'];
        $profile = new Products();
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
        }
        
        $profile_data = $profile->getProdlist($id,$extprof); 
        return json_encode($profile_data);
        echo "<pre>";
        print_r($profile_data);
        exit;
    }
    
    public function actionGetinsight() {  
        $insight = new Products();
        $insight_data = $insight->getinsight(); 
        return json_encode($insight_data);
    }


     /**
     * @SWG\Get(
     *     path="/pm/profile/getservicelist",
     *     tags={"Product & Service"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Its used to get the list of service added by supplier",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "string",default="MemCompServDtls_Pk"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "string",default="asc"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer",default="1"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer",default="10"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
    *      @SWG\Property(property="MCSvD_DisplayName", type="string", example=""),
    *      @SWG\Property(property="SrvM_ServiceName", type="string", example=""),
    *      @SWG\Property(property="MCSvD_ServSearchKeyword", type="integer", example=""),
    *      @SWG\Property(property="MCSvD_CreatedOn", type="date", example=""),
    *      @SWG\Property(property="MCSvD_UpdatedOn", type="date", example=""),
    *      @SWG\Property(property="MCSvD_SVFAdminApprovalStatus", type="string", example=""),
    *      @SWG\Property(property="MPSRD_RevPoint", type="string", example=""),
    *      @SWG\Property(property="MCSvD_BusSource", type="string", example=""),
    *      @SWG\Property(property="SrvM_ServiceCode", type="string", example=""),
    *      @SWG\Property(property="MCSvD_ServPercent", type="integer", example=""),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetservicelist()
    {       
        // Input Sanitize for all the request
        $_REQUEST['company_id'] = \common\components\Security::sanitizeInput($_REQUEST['company_id'],"number");
        $_REQUEST['sort'] = \common\components\Security::sanitizeInput($_REQUEST['sort'],"string");
        $_REQUEST['order'] = \common\components\Security::sanitizeInput($_REQUEST['order'],"string");
        $_REQUEST['page'] = \common\components\Security::sanitizeInput($_REQUEST['page'],"number");
        $_REQUEST['size'] = \common\components\Security::sanitizeInput($_REQUEST['size'],"number");
        $_REQUEST['search'] = \common\components\Security::sanitizeInput($_REQUEST['search'],"string_spl_char");
        $extprof = false;
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $profile = new Services();
        $profile_data = $profile->getServicelist($company_id, $extprof);
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch product look out list
     * @param int company_id in header, company pk
     */
    public function actionGetprodlookoutlist()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Products();
        $profile_data = $profile->getProdLookOutlist($id,$this->getTokenData());
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch service look out list
     * @param int company_id in header, company pk
     */
    public function actionGetservicelookoutlist()
    {
        $id = $_REQUEST['company_id'];
        $profile = new Services();
        $profile_data = $profile->getServiceLookOutlist($id);
        return json_encode($profile_data);
    }

    /**
     * This method is used to fetch contact info
     * @param int company_id in header, company pk
     * @param string department in header, Department of the user
     */
//    public function actionGetcontactinfo()
//    {
//        $id = $_REQUEST['company_id'];
//        $profile = new Profile();
//        $profile_data = $profile->getContactInfo($id,$this->getTokenData());
//        return json_encode($profile_data);
//    }

    /**
     * This method is used to fetch the backend json files
     * This API don't pass any parameters
     */
    public function actionLocalstoragefiles()
    {
        date_default_timezone_set('Asia/Kolkata');
        $jsondecode = Common::getfilemod();
        return json_encode($jsondecode);
    }

    /**
     * This method is used to fetch the backend json files, if the file modification date gets changed.
     * This will pass a json request which has a filename and filedate
     * @param string filename & filedate in header, filename &f filedate
     *
     */
    public function actionFilemdate()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $request = $data['check_date'];
        date_default_timezone_set('Asia/Kolkata');
        $dir = getcwd() . '/modules/backend/json/*';
        // $fileList = glob($dir);
        $jsondecode = [];
        if (!empty($request)) {
            $keys = array_keys($request);
            foreach ($keys as $filename) {
                //echo $request[$filename]."<br>";
                $file = $dir . $filename . ".json";
                if (is_file($file)) {
                    $filedate = date('d-m-y H:i', filemtime($file));
                    //echo $filedate .'-----'. $request[$filename];
                    if ($filedate < $request[$filename]) {
                        break;
                    } else {
                        $jsondecode['msg'] = "failure";
                        $jsondecode['flag'] = "F";
                        return json_encode($jsondecode);
                    }
                }
            }

            $jsondecode = Common::getfilemod();
            return json_encode($jsondecode);
        } else {
            return json_encode([
                'msg' => "Invalid Parameters",
                'status' => 0
            ]);
        }
    }


    /**
     * This method is used to fetch Segment list based on type
     * @param int type in header, Refers to Type Product 'P' or Service 'S'
     */

    public function actionGetsegmentlist()
    {
        $category = $_REQUEST['type'];
        $segmentlist = SegmentmstTbl::getlist($category);
        return json_encode($segmentlist);
    }

    public function actionGetcategorylist($request =  null) {
        if($_REQUEST['type'] != '' && $_REQUEST['type'] != null) {
            $type = $_REQUEST['type'];
        } else {
            $type = $request['type'];
        }
        $searchkey = $_REQUEST['searchkey'];
        $categorylist = BgiindcodecategTblQuery::getlist($type, $searchkey);
        return json_encode($categorylist);
    }


    /**
     * This method is used to Add Product
     * @param respective table fields as follows
     * memcompproddtls_tbl - Products Table
     * Memcompprodservagentsprncp_tbl - Agents/Principal Table
     * memcompprodspecdtls_tbl - Product Specification Table
     * memcompsectordtls_tbl - Activities Table
     */

    public function actionAddproduct()
    {
        $product = new Products();
        $create = $product->addProduct($this->getTokenData());
        return json_encode($create);
    }

    public function actionGetagentprncpdtls(){
        $type = $_GET['category'];
        $agentprncpdtls = MemcompprodservagentsprncpTbl::getAllagentprncpdtls($type);
        $data = [
            "msg" => "success",
            "status" => 1,
            "items" => !empty($agentprncpdtls)?$agentprncpdtls:[]
        ];
        return json_encode($data);
    }

    /**
     * This method is used to get family list details from the Database
     * @param int segement in header, pk of the segement selected
     * @param String type in header, Product or Serive (i.e) 'P' or 'S'
     */
    public function actionGetfamilylist()
    {
        $famiiylist = FamilymstTbl::getfamilylist();
        return json_encode($famiiylist); exit;
    }

    public function actionGetsubcategory($catval = null)
    {
        // echo"<pre>request \n";
        // print_r($_REQUEST);
        $subcatlist = BgiindcodesubcategTblQuery::getfamilylist($catval);
        return json_encode($subcatlist);
    }

    public function actionGetbgiproduct($subcat = null) {
        $bgiproduct = BgiinduscodeprodmstTblQuery::getbgiproductlist($subcat);
        return json_encode($bgiproduct);
    }

    public function actionGetbgiservice() {
        $bgiproduct = BgiinduscodeservmstTblQuery::getbgiservicelist();
        return json_encode($bgiproduct);
    }

    public function actionGetproductunpsc($proval =  null) {
        $productmstlist = UnspcbipcmappingTbl::getproductmstlist($proval);
        return json_encode($productmstlist);
    }

    public function actionGetserviceunpsc() {
        $servicemstlist = UnsscbiscmappingTbl::getservicemstlist();
        return json_encode($servicemstlist);
    }

    public function actionGetproductonsearch() {
        $keyword = $_GET['searchkey'];
        $type = $_GET['searchtype'];
        $productmstlist = BgiindcodecategTblQuery::getproductonsearch($keyword, $type);
        return $productmstlist;
    }

    public function actionGetserviceonsearch() {
        $keyword = $_GET['searchkey'];
        $type = $_GET['searchtype'];
        $servicemstlist = ServicemstTbl::getserviceonsearch($keyword, $type);
        return $servicemstlist;
    }

    /**
     * This method is used to get class list details from the Database
     * @param int segement in header, pk of the segement selected
     * @param int family in header, pk of the family selected
     * @param String type in header, Product or Service (i.e) 'P' or 'S'
     */
    public function actionGetclass()
    {
        $classlist = ClassmstTbl::getclasslist();
        return json_encode($classlist);
    }

    /**
     * This method is used to Get Product Details
     * @param memcompproddtls_pk in header, Pk of the Product Details Table
     */
    public function actionGetproduct()
    {
        $pk = $_REQUEST['pk'];
        $product = new Products();
        $getProducts = $product->getProduct($pk);
        return json_encode($getProducts);
    }

    

    /**
     * This method is used to Delete the Product
     * @param pk in header, Pk of the Product Details Table
     */
    public function actionDeleteproduct(){
        $pk = filter_input(INPUT_GET, 'pk',FILTER_SANITIZE_NUMBER_INT);
        $deleteProduct = \common\models\MemcompproddtlsTbl::deleteProduct($pk);
        return json_encode($deleteProduct);
    }
    /**
     * This method is used to Get Service Details
     * @param memcompservicedtls_pk in header, Pk of the Service Details Table
     */
    public function actionGetservice()
    {
        $pk = $_REQUEST['pk'];
        $service = new Services();
        $getServices = $service->getService($pk);
        return json_encode($getServices);
    }
    
    /**
     * @SWG\Get(
     *     path="/pm/profile/deleteservice",
     *     tags={"Delete Service"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete a Service",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "pk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteservice(){
        $pk = filter_input(INPUT_GET, 'pk',FILTER_SANITIZE_NUMBER_INT);
        $deleteService = \common\models\MemcompservicedtlsTbl::deleteService($pk);
        return json_encode($deleteService);
    }
    /**
     * This method is used to get product list details from the Database
     * @param int segement in header, pk of the segement selected
     * @param int family in header, pk of the family selected
     * @param int class in header, pk of the class selected
     */
    public function actionGetproductlist()
    {
        $productlist = ProductmstTbl::getproductlisting();
        return json_encode($productlist);
    }
    /**
     * This method is used to get product list details from the Database
     * @param int segement in header, pk of the segement selected
     * @param int family in header, pk of the family selected
     * @param int class in header, pk of the class selected
     */
    public function actionGetservlist()
    {
        $servicelist = ServicemstTbl::getservicelisting();
        return json_encode($servicelist);
    }
    /**
     * This method is used to get sector list details from the Database
     */
    public function actionGetsectorlist()
    {
        $sectorlist = SectormstTbl::getsectordata();
        return json_encode($sectorlist);
    }
    /**
     * This method is used to get industry list details from the Database
     * @param int sector in header, pk of the selected sector
     */
    public function actionGetindustrylist()
    {
        $industrylist = IndustrymstTbl::getdataindustry();
        return json_encode($industrylist);
    }
    /**
     * This method is used to Add Product
     * @param respective table fields as follows
     * memcompservicedtls_tbl - Products Table
     * Memcompprodservagentsprncp_tbl - Agents/Principal Table
     * memcompservspecdtls_tbl - Product Specification Table
     * memcompsectordtls_tbl - Activities Table
     */
    public function actionAddservice()
    {
        $service = new Services();
        $create = $service->addService($this->getTokenData());
        return json_encode($create);
    }
    /**
     * This method is used to get industry list details from the Database
     * @param int sector in header, pk of the selected sector
     * @param int industry in header, pk of the selected industry
     */
    public function actionActivitylist()
    {
        $activitylist = ActivitiesmstTbl::getactivity();
        return json_encode($activitylist);


    }
    /**
     * This method is used to get lookup list details from the Database
     */
    public function actionGetlookup()
    {
        $getlookup = MogprodservcodemstTbl::getLookup();
        return json_encode($getlookup); exit;
    }

    /**
     * This method is used to Get Autocomplete Suggestions
     * @param int searchby in header, it refers to search by
     * @param string term in header, search term
     * @param string type in header, refers to product or service
     */
    public function actionGetsugglist()
    {
        $searchby = trim($_REQUEST['searchby']);
        $request = trim($_REQUEST['term']);
        $type = trim($_REQUEST['type']);
        $getsugglist = Search::autoCompleteList($searchby, $request, $type);
        return json_encode($getsugglist);
    }
    /**
     * This method is used to get specification list details from the Database
     */
    public function actionGetspecification()
    {
        $category = $_REQUEST['type'];
        $specfication = SpecificationmstTbl::getspec($category);
        return json_encode($specfication);
    }
    /**
     * This method is used to search family,class,product,service from the Database
     * @param int searchby in header, 1 - Segment 2 - Family 3 - Class 4 - Product / Service
     * @param int termid in header, pk of the selected category
     * @param String type in header, product or service
     */
    public function actionSearchclick()
    {
        if (isset($_REQUEST['searchby'])) {
            $searchby = $_REQUEST['searchby'];
            $termid = $_REQUEST['termid'];
            $type = $_REQUEST['type'];

            if ($type == "product")
                $category = "P";
            else if ($type == "service")
                $category = "S";


            $pk = search::searchprofile($searchby, $termid, $type);

            return json_encode([
                "msg" => "success",
                "status" => 1,
                "items" => !empty($pk) ? $pk : []
            ]);
        }
    }

    /**
     * This method is used to get product / service from the Wikipedia
     * @param int iname  in header, pk of the product / service
     */
    public function actionGetwikipedia()
    {
        if (isset($_REQUEST['iname']) && $_REQUEST['iname'] != '') {
            $product_orservice_model = ProductmstTbl::find()
                     ->where(['LIKE','PrdM_ProductName',$_REQUEST['iname']])->one();
            $type=$_REQUEST['type'];
            $prod_serv_name = $product_orservice_model['PrdM_ProductName'];
            $product_service_pk = $product_orservice_model['ProductMst_Pk'];
            if($type =='S'){
                $prod_serv_name = $product_orservice_model['PrdM_ProductName'];
                $product_service_pk = $product_orservice_model['ProductMst_Pk'];
            }

            $iname = str_replace(' ', '_', $prod_serv_name);
            $url = 'https://en.wikipedia.org/wiki/' . $iname; 
            
            $profile = new Profile();
            $getriskfactor = $profile->getriskfactor($product_service_pk);
            
            $handle = @fopen($url, 'r');
            if ($handle !== false) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                $html = curl_exec($curl);
                curl_close($curl);
    
                $dom = new \domDocument;
                $dom->loadHTML($html);
                $finder = new \DomXPath($dom);
                $classname = "thumbimage";
                $nodes = $finder->query("//*[contains(@class, '$classname')]");
                $image = '';
                $content = '';
                foreach ($nodes as $node) {
                    $image = $node->getAttribute('src');
                    break;
                }
                foreach ($dom->getElementsByTagName('p') as $d) {
                    $content = $d->nodeValue;
                    if($content != '↵') {
                      break;   
                    } 
                }
                if (strtolower($content) == "$iname may refer to:") {
                    $contentul = $dom->getElementsByTagName('ul');
                    $content .= '<ul style="list-style-type: disc; margin-left: 15px;">';
                    foreach ($contentul->item(0)->getElementsByTagName('li') as $b) {
                        $content .= '<li>' . $b->nodeValue . '</li>';
                    }
                    $content .= '</ul>';
                }
                
                if($image == '' || $image == NULL) {
                    $image = 'assets/images/wikinoimg.png';
                }
                
                $dom->preserveWhiteSpace = false;
                return json_encode(array('risk_details' => $getriskfactor, 'status' => 1, 
                'Name' => end(explode(' - ', $_REQUEST['iname'])), 'img' => $image,
                'content' => $content, 'url' => 'https://en.wikipedia.org/wiki/' . end(explode(' - ', $prod_serv_name))));
            } else {
                return json_encode(array('status' => 0, 'risk_details' => $getriskfactor));
            }
        } else
            return json_encode(array('status' => 0));

    }

    /**
     * This method is used to get sector,industry,activity list from the Database
     * @param int searchby in header, 1 - Sector 2 - Industry 3 - Activity
     * @param String term in header, Search Text
     */

    public function actionGetsectorsugglist()
    {
        $searchby = trim($_GET['searchby']);
        $request = trim($_GET['term']);
        $getsectorsugglist = Search::autocompleteBizSearch($searchby, $request);
        return json_encode($getsectorsugglist);
    }

    /**
     * This method is used to search sector,industry,activity service from the Database
     * @param int searchby in header, 1 - Sector 2 - Industry 3 - Activity
     * @param int termid in header, pk of the sector / industry / activity
     */
    public function actionActivitysearchclick()
    {
        if (isset($_REQUEST['searchby'])) {
            $searchby = $_REQUEST['searchby'];
            $termid = $_REQUEST['termid'];
        }
        $pk = search::searchprofileBizSearch($searchby, $termid);
        return json_encode([
            "msg" => "success",
            "status" => 1,
            "items" => !empty($pk) ? $pk : []
        ]);
    }

    /**
     * This method is used to delete files in the temp folder, if it's creation date exceeds more than 2 days
     */
    public function actionDeletetempfiles()
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . "../gbf/src/assets/temp/*";
        $dir = dirname(__FILE__);
        $dir = \Yii::$app->basePath . '/../gbf/src/assets/temp/*'; // temp path location

        $now = time(); // or your date as well

        opendir($dir);
        $fileList = glob($dir); //getting all the files on the directory

        foreach ($fileList as $filename) {
            $mod_date = (filemtime($filename)); //getting file modification time for the file
            $datediff = $now - $mod_date;
            $diff =  round($datediff / (60 * 60 * 24));    // getting round modified days of the file
            if ($diff > 2) { // if the file modified date is more than 2 days, then we delete them
                unlink($filename);
                return json_encode([
                    "msg" => "success",
                    "status" => 1
                ]);
            } else {
                return json_encode([
                    "msg" => "failure",
                    "status" => 0
                ]);
            }
        }
    }

    public function actionGetdeparmentlist()
    {

        $departmentlist = DepartmentmstTbl::getdeptlist();
        return json_encode($departmentlist);
    }
    public function actionGetuserlist()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $user = new User();
        $session=$this->getTokenData();
        $create = $user->getUser($session->MemberRegMst_Pk);
        return json_encode($create);
    }

    public function actionLogout()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = Security::decrypt($data['id']);
        // J2 app logout process
        $JSRS_v2_Logout_URL = Yii::$app->params['JSRS_v2_baseURL']."index.php?r=site/logout&from=J3";
        // $return= file_get_contents($JSRS_v2_Logout_URL);
        $curl = curl_init($JSRS_v2_Logout_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        //\common\models\UserlogintrackTbl::changeLogoutStatus($userpk);
	    \common\models\UserlogintrackTbl::changeLogoutStat($userpk);
       

//print_r("expression");die();
        //print_r();die();
       
        return ['status' => 1, 'msg' => 'Logout Successfully'];
    }
    public function actionMapdepartment()
    {
        $userPk=$_REQUEST['userpk'];
        $dep=$_REQUEST['dep'];
        \common\models\MemcompcontactdtlsTbl::saveFromUser($userPk,$dep);

    }

    /**
     * This method is used to save contact information
     * @Request  json  header
     */
    public function actionSavecontactinfo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $save_contact_info = \common\models\MembercompanymstTbl::save_contact_info($data['contactinfo']);
        return json_encode($save_contact_info);
    }

    /**
     * This method is used to get contact information
     * @Request  json  header
     */
    public function actionGetcontactinfo(){
        $get_contact_info = \common\models\MembercompanymstTbl::get_contact_info();
        return json_encode($get_contact_info);
    }

    /**
     * This method is used to check whether the Countr/State/City is already exists in db or not
     * @param int country in header, country name
     * @param int countrypk in header, country Primary Key
     * @param int state in header, state name
     * @param int statepk in header, state pk
     * @param int city in header, city name
     */
    public function actionIsregionexist(){
        $country = $_GET['country'];
        $countrypk = $_GET['countrypk'];
        $state = $_GET['state'];
        $statepk = $_GET['statepk'];
        $city = $_GET['city'];
        if(!empty($country)){
            $response = \api\modules\mst\models\CountryMasterQuery::chkCountry($country);
        }elseif(!empty($state)){
            $response = \api\modules\mst\models\StateMstTbl::chkState($state,$countrypk);
        }else{
            $response = \api\modules\mst\models\CityMstTbl::chkCity($city,$statepk);
        }
        return json_encode($response);
    }

    /**
     * This method is used to store Social Media Information of a Company
     * @example request as below
     * {
     *    "socialmedia":{
     *      "facebook":"www.facebook.com/usesrname",
     *      "whatsapp": "7010889587",
     *      "twitter": "www.twitter.com/username",
     *      "instagram":"www.instagram.com/username"
     *    }
     * }
     *
     * @return success json response
     * {
     *    "msg":"success",
     *    "status":1
     * }
     */
    public function actionSavesocialmedia(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $saveSocialMedia = \common\models\MembercompanymstTbl::saveSocialMedia($data['socialmedia']);
        return json_encode($saveSocialMedia);
    }
    /**
     * This method is used to get the list of Social Media
     *
     * @return success json response
     * {
     *    "msg":"success",
     *    "status":1
     * }
     */
    public function actionGetsocialmedialist(){
        $socialMediaList = \common\models\SocialmediamstTblQuery::getSocialMediaList();
        return json_encode($socialMediaList);
    }

    /**
     * This method is used to get the no of Suppliers reigstered the product
     * @param int product_category in header
     * @return success json response
     * {
     *    "msg":"success",
     *    "status":1
     * }
     */
    public function actionSuppcountbyproduct(){
        $prod_category = filter_input(INPUT_GET, 'product_category',FILTER_SANITIZE_NUMBER_INT);
        if(!empty($prod_category))
        {
            $suppCount = \common\models\MemcompproddtlsTbl::getSupplierCountByProduct($prod_category);
            return json_encode($suppCount);
        }
        else
        {
            return json_encode([
                "msg" => "Parameter value required",
                "status" => 0
            ]);
        }
    }
    /**
     * This method is used to get total and individual no of Product Counts
     *
     * @return success json response
     * {
     *    "msg":"success",
     *    "status":1
     * }
     */
    public function actionProductcount(){

        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);

        $supplierProductCount = \common\models\MemcompproddtlsTbl::getProductCount($companypk);
        $totalProductCount = \common\models\MemcompproddtlsTbl::getProductCount();
        return json_encode([
            "msg" => "success",
            "status" => 1,
            "totalcount" =>  $totalProductCount,
            "individualcount" =>  $this->addOrdinalNumberSuffix($supplierProductCount)
        ]);
    }

    /**
     * This method is used to get total and individual no of Product Counts
     *
     * @return success json response
     * {
     *    "msg":"success",
     *    "status":1
     * }
     */
    public function actionServicecount(){

        $token = \yii\db\ActiveRecord::getTokenData();
        $companypk = $token->MemberCompMst_Pk;
        $supplierServiceCount = \common\models\MemcompservicedtlsTbl::getServiceCount($companypk);
        $totalServiceCount = \common\models\MemcompservicedtlsTbl::getServiceCount();

        return json_encode([
            "msg" => "success",
            "status" => 1,
            "totalcount" => $totalServiceCount,
            "individualcount" =>  $this->addOrdinalNumberSuffix($supplierServiceCount)
        ]);
    }

    public function addOrdinalNumberSuffix($num) {
        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }
        return $num.'th'; exit;
    }

    public function actionCkeditor()
    {
        if($_FILES['upload']['name'])
        {
            $filename = round(microtime(true)).$_FILES['upload']['name'];
            $tempnname =$_FILES['upload']['tmp_name'];
            $filePath = Yii::$app->request->post('filePath');
            if(!empty($filePath)){
                $path = \Yii::getAlias('@webroot').'/../'.$filePath.'/';
            }else{
                $path = \Yii::getAlias('@webroot').'/../ckeditor/';
                $filePath = 'ckeditor/';
            }
            $file_extension = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
            $extensions = ['jpg', 'png', 'jpeg', 'gif', 'doc', 'pdf', 'flv'];
            $temp_path = $path . basename($filename);
            if(in_array($file_extension, $extensions)) {
                if (!is_dir($path)) {
                    mkdir($path);
                }
                $currentenv = Yii::$app->params['baseurl']['env'].$filePath.$filename;
                if (move_uploaded_file($tempnname, $temp_path)) {
                    return json_encode([
                        "default" => \Yii::$app->params['backendBaseUrl'].$filePath.$filename
                    ]);
                } else {
                    return [
                        "msg" => "Error in uploading",
                        "status" => 0
                    ];
                }
            }
           // echo $file_extension;
        }
    }

    public function actionMessagefrom()
    {
         $messageform=Profile::savemessageform();
        return json_encode($messageform,true);
    }

    public function actionCreatecorporateprofile()
    {
        $organizationmodel=Profile::organizationdetails();
        return json_encode($organizationmodel);
    }

    public function actionV3addservice()
    {
        $addservice=Profile::saveservicedatas();
        return $addservice;
    }

    /*
     * profile management add product
     *
     *
     */

    public  function actionV3addproduct()
    {
        $addproduct=Profile::saveproductdatas();
        return $addproduct;
    }
    
     public function actionGetsectorlistvalue()
    {
       $memsector= SectormstTbl::find()->asArray()->all();

         return $memsector;
//        $sectorlist = SectormstTbl::getsectordata();
    }

    /**
     * @SWG\Post(
     *     path="/pm/profile/partisionsave",
     *     tags={"Add Product"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a Product type wise",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompproddtls", type="object",
        *                  @SWG\Property(property="memcompproddtls_pk", type="integer", example="MTEw"),
        *                  @SWG\Property(property="DisplayName", type="integer", example=2),
        *                  @SWG\Property(property="ProdSegmentMst_Fk", type="string", example=""),
        *                  @SWG\Property(property="ProdFamilyMst_Fk", type="integer", example=""),
        *                  @SWG\Property(property="ProdClassMst_Fk", type="integer", example=""),
        *                  @SWG\Property(property="ProductMst_Fk", type="integer", example=""),
        *                  @SWG\Property(property="activitiesmst_fk", type="integer", example=""),
        *                  @SWG\Property(property="businesssource", type="string", example=""),
        *                  @SWG\Property(property="product_desc", type="string", example=""),
        *                  @SWG\Property(property="national_product", type="string", example=""),
        *                  @SWG\Property(property="show_in_external", type="integer", example=""),
       *                  @SWG\Property(property="prod_quantity", type="string", example=""),
       *                  @SWG\Property(property="prod_units", type="string", example=""),
       *                  @SWG\Property(property="prod_mode", type="integer", example=""),
       *                  @SWG\Property(property="order_minimum", type="string", example=""),
       *                  @SWG\Property(property="order_maximum", type="string", example=""),
        *             
        *              @SWG\Property(property="socialmediapage", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="mediatype", type="string", example=""),
        *                      @SWG\Property(property="mediatypeurl", type="string", example=""),
        *                  )  
        *              ),
        *              @SWG\Property(property="lookup", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="MOGProdServCodeMst_Pk", type="numbers", example=2),
        *                      @SWG\Property(property="MPSCM_ProdServCode", type="string", example="00002"),
        *                      @SWG\Property(property="MPSCM_ProdServName", type="string", example="ACOUSTIC ENGINEERING SERVICES"),
        *                      @SWG\Property(property="checked", type="boolean", example=true),
        *                  )  
        *              ),
        *              @SWG\Property(property="agentprinciple", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="agentprncpname", type="sring", example="karthick"),
        *                      @SWG\Property(property="countrymst_fk", type="integer", example="143"),
        *                      @SWG\Property(property="email", type="string", example="jk@jk.com"),
        *                      @SWG\Property(property="mobile", type="number", example="987456321"),
        *                      @SWG\Property(property="phoneno", type="number", example="044563125"),
        *                      @SWG\Property(property="ext", type="number", example=123),
        *                      @SWG\Property(property="mkaspublic", type="integer", example=1),
        *                      @SWG\Property(property="memcompprodservagentsprncp_pk", type="number"),
        *                      @SWG\Property(property="category", type="string", example="P"),
        *                      @SWG\Property(property="type", type="integer", example=7),
        *                      @SWG\Property(property="Country", type="string", example="Algeria"),
        *                  )  
        *              ),
        *              @SWG\Property(property="tradespecification", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="TradeSpecification_Fk", type="integer", example=3),
        *                      @SWG\Property(property="TradeSpecDesc", type="string", example=""),
        *                      @SWG\Property(property="type", type="string", example="4"),
        *                  ),
        *              ),
        *              @SWG\Property(property="productspecfication", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="ProdSpecification_Fk", type="numbers", example=2),
        *                      @SWG\Property(property="ProdSpecDesc", type="string", example=""),
        *                      @SWG\Property(property="type", type="string", example="4"),
        *                  ),
        *              ),
        *          ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionPartisionsave()
    {
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data_return=Profile::addproduct($data);
       
        return $data_return;


        $success_return=['error'=>'Error in data save'];
        if($data_return->MemCompProdDtls_Pk)
        {
            $success_return=['MemCompProdDtls_Pk'=>$data_return->MemCompProdDtls_Pk];
        }
        return $success_return;
    }

   
     /**
     * @SWG\Post(
     *     path="/pm/profile/servicepartision",
     *     tags={"Add Service"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add a Service type wise",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
        *              @SWG\Property(property="memcompservdtls", type="object",
        *                  @SWG\Property(property="memcompservdtls_pk", type="integer", example="MTEw"),
        *                  @SWG\Property(property="DisplayName", type="integer", example=2),
        *                  @SWG\Property(property="ServSegmentMst_Fk", type="string", example=""),
        *                  @SWG\Property(property="ServFamilyMst_Fk", type="integer", example=""),
        *                  @SWG\Property(property="ServClassMst_Fk", type="integer", example=""),
        *                  @SWG\Property(property="ServiceMst_Fk", type="integer", example=""),
        *                  @SWG\Property(property="activitiesmst_fk", type="integer", example=""),
        *                  @SWG\Property(property="businesssource", type="string", example=""),
        *                  @SWG\Property(property="service_desc", type="string", example=""),
        *                  @SWG\Property(property="show_in_external", type="integer", example=""),
        *             
        *              @SWG\Property(property="socialmediapage", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="mediatype", type="string", example=""),
        *                      @SWG\Property(property="mediatypeurl", type="string", example=""),
        *                  )  
        *              ),
        *              @SWG\Property(property="lookup", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="MOGProdServCodeMst_Pk", type="numbers", example=2),
        *                      @SWG\Property(property="MPSCM_ProdServCode", type="string", example="00002"),
        *                      @SWG\Property(property="MPSCM_ProdServName", type="string", example="ACOUSTIC ENGINEERING SERVICES"),
        *                      @SWG\Property(property="checked", type="boolean", example=true),
        *                  )  
        *              ),
        *              @SWG\Property(property="tradespecification", type="array",     
        *                  @SWG\items(
        *                      @SWG\Property(property="TradeSpecification_Fk", type="integer", example=3),
        *                      @SWG\Property(property="TradeSpecDesc", type="string", example=""),
        *                      @SWG\Property(property="type", type="string", example="4"),
        *                  ),
        *              ),
        *          ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
                
    public function actionServicepartitionsave()
    {
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        
        $data_return=Profile::addservice($data);
        $success_return=['error'=>'Error in data save'];
        if($data_return->MemCompServDtls_Pk)
        {
            $success_return=['MemCompServDtls_Pk'=>$data_return->MemCompServDtls_Pk, 
            'ref_no' => $data_return->mcsvd_servrefno, 
            'servcoverimgfile' => $data_return->mcsvd_servcoverimgfile];
        }
        return $success_return;
    }
    /**
     * @SWG\Get(
     *     path="/pm/profile/getproductlistkey",
     *     tags={"Product View/Update"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to update /view",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "pk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetproductlistkey()
    {
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $return_data=['status'=>'Error','msg'=>"Error in received Key"];
       if($pk)
        {
            $product_data= Products::getProductkey($pk);
            $return_data= json_encode($product_data);
        }
        return $return_data;
    }
    /**
     * @SWG\Get(
     *     path="/pm/profile/getservicelistkey",
     *     tags={"Service View/Update"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to update /view",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "pk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetservicelistkey()
    {   
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $return_data=['status'=>'Error','msg'=>"Error in received Key"];
        if($pk){
        $service_data=Services::getServicekey($pk);
        return json_encode($service_data);
        }
        return $return_data;
    }
    
    public function actionGetallProducts($company_id,$session) { 
        if(!empty($company_id)) {
            $company_id = $session->MemberCompMst_Pk;
        }
        $proudct = ProductmstTbl::getallProduct($company_id); 
        $proudct_list = $proudct['items']; 
        return json_encode($proudct_list);
    }
    
    public function actionGetsegments($company_id,$session) { 
        if(!empty($company_id)) {
            $company_id = $session->MemberCompMst_Pk;
        }   
        
        if(!empty($category)){
            $cat_type = 'S';
        } else {
            $cat_type = 'P';
        }
        
        $segments = SegmentmstTbl::getSegmentsList($company_id, $cat_type); 
        $segment_list = $segments['items']; 
        
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($segment_list)?$segment_list:[],
            'total_count' => count($segment_list),
            'limit' => 5,
        ];
    }
    
    public function actionGetfamily($segment_ids,$cat_type) { 
        
        $family = FamilymstTbl::getFamily($segment_ids, $cat_type); 
        $family_list = $family['items']; 
        
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($segment_list)?$segment_list:[],
            'total_count' => count($segment_list),
            'limit' => 5,
        ];
    }
    
    public function actionGetclassList($segment_ids,$cat_type) { 
        
        $class = ClassmstTbl::getClass($segment_ids, $cat_type); 
        $class_list = $class['items']; 
        
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($class_list) ? $class_list : [],
            'total_count' => count($class_list),
            'limit' => 5,
        ];
    }
    
    public function actionGetbusinesssource() {
        if(empty($company_id)) {
            $company_id = $session->MemberCompMst_Pk;
        }
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        $extprof = false;
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $businessSource = \common\models\MemcompproddtlsTbl::getbusinesssource($company_id);
        return  !empty($businessSource)?json_encode($businessSource):[];
    }

    public function actionGetproductbusunitlisting() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $businessUnit = \common\models\MemcompproddtlsTbl::getBusunitProducatlisting($company_id);
        return  !empty($businessUnit)?json_encode($businessUnit):[];
    }
    public function actionGetservicebusunitlisting() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $businessUnit = \common\models\MemcompservicedtlsTbl::getBusunitServicelisting($company_id);
        return  !empty($businessUnit)?json_encode($businessUnit):[];
    }
    public function actionGetbusinesssourcelist() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $businessSource = \common\models\MemcompproddtlsTbl::getbusinesssourcelist($company_id);
        return  !empty($businessSource)?$businessSource:[];
    }
    
    public function actionGetbusinesssourceforservice() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $businessSource = \common\models\MemcompservicedtlsTbl::getbusinesssource($company_id);
        return $businessSource; 
    }
    

    public function actionGetbusinesssourcserviceelist() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $businessSource = \common\models\MemcompservicedtlsTbl::getbusinesssourcelist($company_id);
        return $businessSource; 
    }
    
    public function actionGetunpsc() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $unpsclist = \common\models\MemcompproddtlsTbl::getunpsc($company_id);
        return $unpsclist; 
    }
    
    public function actionGetunpscforservice() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $unpsclist = \common\models\MemcompservicedtlsTbl::getunpsc($company_id);
        return $unpsclist; 
    }
    
    public function actionGetsector() {
        return json_encode(array()); 
        if(empty($company_id)) {
            $company_id = $session->MemberCompMst_Pk;
        }
        $activitylist = \common\models\MemcompproddtlsTbl::getactivity($company_id);
        $activity = [];
        
        foreach ($activitylist as $key => $value) {
            if($value['mcprd_activitiesmst_fk'] != null) {
                $activity[] = $value['mcprd_activitiesmst_fk'];
            }
        }
       
        $sectorlist = \api\modules\mst\models\ActivitiesmstTbl::getsectorlist($activity); 
        $sectornamelist = \api\modules\mst\models\SectormstTbl::getsectorlistforactivity($sectorlist);
        return json_encode($sectornamelist); 
    }
    
    public function actionGetsectorforservice() {
        $extprof = false;
        $company_id = '';
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $company_id = 6;
        $activitylist = \common\models\MemcompservicedtlsTbl::getactivity($company_id);
        $activity = [];
        
        foreach ($activitylist as $key => $value) {
            if($value['mcsvd_activitiesmst_fk'] != null) {
                $activity[] = $value['mcsvd_activitiesmst_fk'];
            }
        }
       
        $sectorlist = \api\modules\mst\models\ActivitiesmstTbl::getsectorlist($activity); 
        $sectornamelist = \api\modules\mst\models\SectormstTbl::getsectorlistforactivity($sectorlist);
        return $sectornamelist ? $sectornamelist:[]; 
    }
    
    public function actionGetactivity() { 
        $sectors = $_REQUEST['sectors'];
        $activitylist = \api\modules\mst\models\ActivitiesmstTbl::getactivityforsector($sectors,'product'); 
        return json_encode($activitylist); 
    }
    
    public function actionGetactivityforservice() { 
        $sectors = $_REQUEST['sectors'];
        $activitylist = \api\modules\mst\models\ActivitiesmstTbl::getactivityforsector($sectors,'service'); 
        return json_encode($activitylist); 
    }
    /**
     * @SWG\Get(
     *     path="/pm/profile/sectormaping",
     *     tags={"Sector Mapping"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get mapped sectors for the vompsny",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSectormaping() {
        $sector_mapping = MemcompprofilesectordtlsTbl::getsectormapping();
        return $sector_mapping;
    }

    public function actionBusinesssourcewithtrade()
    {
        $mapped_bus_trade_data=MemcompbussrcdtlsTbl::getallmappeddata();
        return $this->asJson($mapped_bus_trade_data);
    }

    public function actionBusinesssourceforservice(){

        $mapped_bus_trade_data=MemcompbussrcdtlsTbl::getallmappeddataforservice();
        return $this->asJson($mapped_bus_trade_data);
    }

    public function actionBasedonbss()
    {
      //  1 - Primary, 2 - Branch, 3 - Representative, 4 - Factory / Manufacture, 5 - Trading, 6 - Wholesale / Distributor,
      //  7 - Retailer, 8 - Agent, 9 - Government Agency / Organization,10 - Stockist, 11 - Trade House, 12 - Others, 13 - Port, 14 - Clientele
        $bss_data=MemcompmplocationdtlsTbl::getmycompdata();
        return $this->asJson($bss_data);
    }

          /**
     * @SWG\Post(
     *     path="/pm/profile/map",
     *     tags={"Map Contact Details in Add Product"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to add business source manufacturer details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="contactdtls", type="object",
        *                  @SWG\Property(property="prd_pk", type="string", example=""),
        *                  @SWG\Property(property="user_fk", type="array", example=""),
        *              )
     *          ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionMap(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['contactdtls']['prd_pk'] = Security::decrypt($data['contactdtls']['prd_pk']);
        $data['contactdtls']['prd_pk'] = Security::sanitizeInput($data['contactdtls']['prd_pk'],'number');
        $data = Profile::mapcontactdetails($data);
        return $data; 
    }
    
        /**
     * @SWG\Post(
     *     path="/pm/profile/mapservice",
     *     tags={"Map Contact Details in Add Product"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to add business source manufacturer details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="contactdtls", type="object",
        *                  @SWG\Property(property="service_pk", type="string", example=""),
        *                  @SWG\Property(property="user_fk", type="array", example=""),
        *              )
     *          ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionMapservice(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['contactdtls']['service_pk'] = Security::decrypt($data['contactdtls']['service_pk']);
        $data['contactdtls']['service_pk'] = Security::sanitizeInput($data['contactdtls']['service_pk'],'number');
        $data = Profile::mapservicecontactdetails($data);
        return $data; 
    }
    /**
     * @SWG\Get(
     *     path="/pm/profile/getcontactdetails",
     *     tags={"Sector Mapping"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get contact details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetcontactdetails(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $contact_data = Profile::getcontactdata($pk);
        return $contact_data;
    }

    public function actionGetcontactdetailsforservice(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $contact_data = Profile::getcontactdataforservice($pk);
        return $contact_data;
    }

    public function actionDeletemapping()
    {
        $product_pk=Security::decrypt($_REQUEST['product']);
        $sntze_prd=Security::sanitizeInput($product_pk,'number');
        if($sntze_prd){
            MemcompprodmarketpresenceTbl::deleteAll('mcpmp_memcompproddtls_fk=:prod',[':prod'=>$sntze_prd]);
        }
        return 'S';
    }
    public function actionDeletemappingservice(){
        $service_pk=Security::decrypt($_REQUEST['service']);
        $sntze_ser=Security::sanitizeInput($service_pk,'number');
        if($sntze_ser){
            MemcompservmarketpresenceTbl::deleteAll('mcsmp_memcompservdtls_fk=:serv',[':serv'=>$sntze_ser]);
        }
        return "S";
    }

    public function actionBsource(){
        $bs_Data=MemcompbussrcdtlsTbl::getallbusdata();
        return $this->asJson($bs_Data);
    }
    
    public function actionCurrencylist()
    {
        $currency_data = Profile::getCurrencylist();
        return $currency_data;
    }
    public function actionUnitlist() {
        $unit_data = Profile::getUnitlist();
        return $unit_data;
    }

    public function actionTradelist(){

        $trade_List=MemcomptradingdtlsTbl::gettradelist();
        return $this->asJson($trade_List);
    }

        /**
     * @SWG\Post(
     *     path="/pm/profile/addproductdocs",
     *     tags={"Add Product Document Upload"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save document details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="product_pk", type="string", example=""),
     *                  @SWG\Property(property="procover", type="array", example=""),
     *                  @SWG\Property(property="probrochure", type="array", example=""),
     *                  @SWG\Property(property="prootherfiles", type="array", example=""),
     *                  @SWG\Property(property="proinnerimg", type="array", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletecoverimage(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['product_pk'] = Security::decrypt($data['product_pk']);
        $data['product_pk'] = Security::sanitizeInput($data['product_pk'],'number');
        $data = Profile::deletecoverimage($data);
        return $data;
    }

    public function actionAddproductdocs(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['product_pk'] = Security::decrypt($data['product_pk']);
        $data['product_pk'] = Security::sanitizeInput($data['product_pk'],'number');
        $data = Profile::addproductdocs($data);
        return $data;
    }
        /**
     * @SWG\Post(
     *     path="/pm/profile/saveadditionalinfo",
     *     tags={"Add Save Transport"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Save Additional Info",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataType", type="string", example=""),
     *                  @SWG\Property(property="companyPk", type="string", example=""),
     *                  @SWG\Property(property="address", type="string", example=""),
     *                  @SWG\Property(property="othertype", type="string", example=""),
     *                  @SWG\Property(property="companyName", type="string", example=""),
     *                  @SWG\Property(property="country", type="string", example=""),
     *                  @SWG\Property(property="state", type="string", example=""),
     *                  @SWG\Property(property="city", type="string", example=""),
     *                  @SWG\Property(property="landline_cc", type="string", example=""),
     *                  @SWG\Property(property="landline_no", type="string", example=""),
     *                  @SWG\Property(property="landline_ext", type="string", example=""),
     *                  @SWG\Property(property="emailid", type="string", example=""),
     *                  @SWG\Property(property="website", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionSaveadditionalinfo(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data=$data['additionalValue'];
        $data['companyPk'] = Security::decrypt($data['companyPk']);
        $data['companyPk'] = Security::sanitizeInput($data['companyPk'],'number');
        $data = Profile::addAdditionalInfo($data);
        return $data;
    }

            /**
     * @SWG\Post(
     *     path="/pm/profile/addservicedocs",
     *     tags={"Add Service Document Upload"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save document details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="service_pk", type="string", example=""),
     *                  @SWG\Property(property="servcover", type="array", example=""),
     *                  @SWG\Property(property="servbrochure", type="array", example=""),
     *                  @SWG\Property(property="servotherfiles", type="array", example=""),
     *                  @SWG\Property(property="servinnerimg", type="array", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionAddservicedocs(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['service_pk'] = Security::decrypt($data['service_pk']);
        $data['service_pk'] = Security::sanitizeInput($data['service_pk'],'number');
        $data = Profile::addservicedocs($data);
        return $data;
    }

    public function actionExportcsv(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $arr = $data['excelarray'];
        $type = $data['type'];
        $search_by = $data['search_by']; 
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        if($type == 'P') { 
            $data = Memcompproddtlstbl::excelgeneration($companypk, $arr, $search_by, $type);
        } else if($type == 'S') {
            $data = Memcompproddtlstbl::serviceexcelgeneration($companypk, $arr, $search_by, $type);
        }

        return $data;
    }

    public function actionExportproductdata($companypk, $fieldarr) {
        $data = Memcompproddtlstbl::productexcelexport($companypk, $fieldarr);
    }   

    public function actionGetattrlabel(){
        $type = $_REQUEST['type'];
        $data = Memcompproddtlstbl::getattrlebels($type);
        return $data;
    }

    /*
     * save r&D,hse,quality control
     *
     */
     public function actionCertsave(){
         $crtModel=MemcompfctycertTbl::savecertdetails();
         return $this->asJson($crtModel);
     }
     /*
      * Infrastructure details
      */
    public function actionInfrstr(){
        $infModel=MemcompfctyinfradtlsTbl::saveinfra();
        return $this->asJson($infModel);
    }
    public function actionGetcertdata(){
        $certdata=MemcompfctycertTbl::getfactrycertdata();
        return $this->asJson($certdata);
    }
    public function actionGetfactoryinfo()
    {
        $buspk=Security::decrypt($_GET['pk']);     
        if($buspk){
            $fctinfo=MemcompfctydtlsTbl::find()
                ->select(['mcfd_facname','mcfd_facid','factm_factytypename','mcmpld_address','memcompfctydtls_pk','mcfd_memcompbussrcdtls_fk'])
                ->leftJoin(FactorytypemstTbl::tableName(),'mcfd_factorytypemst_fk=factorytypemst_pk')
                ->leftJoin(MemcompmplocationdtlsTbl::tableName(),'mcfd_memcompmplocationdtls_fk=memcompmplocationdtls_pk')
                ->where('mcfd_memcompbussrcdtls_fk =:bus',[':bus'=>$buspk])->asArray()->all();
            return $this->asJson($fctinfo);
        }

    }

    public function actionDeletefactory(){
        $dec_fct=$_GET['pk'];
        $log_action = 3;
        $log_msg = 'Deleted Asset Details.';
        if($dec_fct){
            MemcompfctycertTbl::deleteAll('mcfc_memcompfctydtls_fk=:fac',[':fac'=>$dec_fct]);
            MemcompfctyinfradtlsTbl::deleteAll('mcfid_memcompfctydtls_fk=:fac',[':fac'=>$dec_fct]);
            \common\models\MemcomptradingdtlsTbl::deleteAll('mctd_memcompfctydtls_fk=:fac',[':fac'=>$dec_fct]);
            \common\models\SupportcollateraldtlsTbl::deleteAll('scd_shared_fk=:fac and scd_type = 2',[':fac'=>$dec_fct]);
            MemcompfctydtlsTbl::deleteAll('memcompfctydtls_pk=:fac',[':fac'=>$dec_fct]);
            \common\components\UserActivityLog::logUserActivity($log_action, $log_msg, 'rabt/api/pm/profile/deletefactory',22);
        }
    }

    public function actionDeletefactoryonbschange(){
        if(!empty($_GET['bsid']) && $_GET['bsid']!='undefined'){
        $bussrid=Security::decrypt($_GET['bsid']);
        $fctinfo=MemcompfctydtlsTbl::find()
            ->select(['memcompfctydtls_pk','mcfd_memcompmplocationdtls_fk'])
            ->where('mcfd_memcompbussrcdtls_fk =:bus',[':bus'=>$bussrid])->asArray()->all();
            
        \common\models\MemcompmppermitdtlsTbl::deleteAll('mcmppd_memcompbussrcdtls_fk=:fac',[':fac'=>$bussrid]);
        if($fctinfo){
            foreach ($fctinfo as $fct) {
                $remove_location = [];
                array_push($remove_location, $fct['mcfd_memcompmplocationdtls_fk']);
                MemcompfctycertTbl::deleteAll('mcfc_memcompfctydtls_fk=:fac',[':fac'=>$fct['memcompfctydtls_pk']]);
                MemcompfctyinfradtlsTbl::deleteAll('mcfid_memcompfctydtls_fk=:fac',[':fac'=>$fct['memcompfctydtls_pk']]);
                
                $logistic_loc = MemcomptradingdtlsTbl::find()->select(['mctd_memcompmplocationdtls_fk'])
                ->where('mctd_memcompfctydtls_fk =:fct',[':fct'=>$fct['memcompfctydtls_pk']])->asArray()->all();
                if($logistic_loc) {
                    foreach($logistic_loc as $logloc ) {
                        array_push($remove_location,$logloc['mctd_memcompmplocationdtls_fk']);
                    }
                }
                
                \common\models\MemcomptradingdtlsTbl::deleteAll('mctd_memcompfctydtls_fk=:fac',[':fac'=>$fct['memcompfctydtls_pk']]);
                \common\models\SupportcollateraldtlsTbl::deleteAll('scd_shared_fk=:fac and scd_type=2',[':fac'=>$fct['memcompfctydtls_pk']]);
                //\common\models\MemcompprodbussrcmapTbl::deleteAll('mcpbsm_memcompfctydtls_fk=:fac',[':fac'=>$fct['memcompfctydtls_pk']]);
                //\common\models\MemcompservbussrcmapTbl::deleteAll('mcsbsm_memcompfctydtls_fk=:fac',[':fac'=>$fct['memcompfctydtls_pk']]);
                MemcompfctydtlsTbl::deleteAll('memcompfctydtls_pk=:fac',[':fac'=>$fct['memcompfctydtls_pk']]);
                //MemcompmplocationdtlsTbl::deleteAll(['IN', 'memcompmplocationdtls_pk',$remove_location]);
            }
        }
        }
    }

    public function actionAssettype(){
        //0- inactive 1-Active
       $assMdl=AssettypemstTbl::find()
           ->select(['assettypemst_pk','atm_assettypename'])
           ->where('atm_assettypestatus=:status',[':status'=>1])
           ->orderBy('atm_assettypename asc')
           ->asArray()
           ->all();

       return $this->asJson($assMdl);
    }

    public function actionFaqsave(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        if($data['faqdata']){
            $faqInput=$data['faqdata']['faqspecifications'];
            $sharedpk = Security::decrypt($data['faqdata']['faqsharedpk']);
            $faqtype=$data['type'];
            $log_url = '/j3/api/pm/profile/faqsave';
            foreach ($faqInput as $key => $value) {
                $faqModel=new ProjfaqdtlsTbl();
                $faqpk=$value['faqpk'];
                if(isset($faqpk) && !empty($faqpk)){
                    if($faqtype == 3) {
                        $log_msg = 'Edited Product FAQ';
                    } else if($faqtype == 4){
                        $log_msg = 'Edited Service FAQ';
                    }
                    $log_action = 2;
                    $faqModel=ProjfaqdtlsTbl::findOne($faqpk);
                    if(($faqModel->pfd_question != $value['faqquestion']) || ($faqModel->pfd_answer != $value['faqanswer'])) {
                        $faqHistory=new ProjfaqhstyTbl();
                        $faqHistory->pfh_appdeclby = $userpk;
                        $faqHistory->pfh_submittedby = $faqModel->pfd_submittedby;
                        $faqHistory->pfh_appdeclon =  date('Y-m-d H:i:s');
                        $faqHistory->pfh_submittedon = $faqModel->pfd_submittedon;
                        $faqHistory->pfh_question = $faqModel->pfd_question;
                        $faqHistory->pfh_answer = $faqModel->pfd_answer;
                        $faqHistory->pfh_appdeclbyipaddr = $faqModel->pfd_approvedbyipaddr;
                        $faqHistory->pfh_submittedbyipaddr = $faqModel->pfd_submittedbyipaddr;
                        $faqHistory->pfh_status = $faqModel->pfd_status;
                        $faqHistory->pfh_type = $faqModel->pfd_type;
                        $faqHistory->pfh_submittedbyipaddr = \common\components\Common::getIpAddress();
                        $faqHistory->pfh_projecthsty_fk = $faqModel->projfaqdtls_pk;
                        $faqHistory->pfh_index = $faqModel->pfd_index;
                        
                        $faqHistory->pfh_index = $faqModel->pfd_index;
                        $faqHistory->pfh_histcreatedon = date('Y-m-d H:i:s');
                        if(!$faqHistory->save(false)) {
                            return $faqHistory->getErrors();
                        }
                    }
                }
                if($log_action != 2) {
                    if($faqtype == 3) {
                        $log_msg = 'Saved Product FAQ';
                    } else if($faqtype == 4){
                        $log_msg = 'Saved Service FAQ';
                    }
                    $log_action = 1;
                }
                $faqModel->pfd_projectdtls_fk = $sharedpk;
                $faqModel->pfd_question = $value['faqquestion'];
                $faqModel->pfd_answer = $value['faqanswer'];
                $faqModel->pfd_type = $faqtype;
                $faqModel->pfd_status = 1;
                $faqModel->pfd_submittedby = $faqModel->pfd_approvedby = $userpk;
                $faqModel->pfd_submittedon = $faqModel->pfd_approvedon = date('Y-m-d H:i:s');
                $faqModel->pfd_submittedbyipaddr = $faqModel->pfd_approvedbyipaddr = \common\components\Common::getIpAddress();
                $faqModel->pfd_index = $key+1;
                // $faqModel->pfd_approvedon=$userpk;
                // $faqModel->pfd_approvedon=date('Y-m-d H:i:s');
               if(!$faqModel->save(false)) {
                   return $faqModel->getErrors();
               }
            }
            \common\components\UserActivityLog::logUserActivity($log_action, $log_msg, $log_url,22);

            return $this->asJson($faqModel);
        }
    }

    public function actionGetfaqdata(){

        $module=Security::decrypt($_GET['module']);
        $detailpk=Security::decrypt($_GET['detail']);
        $snmodule=Security::sanitizeInput($module,"number");
        $sndetail=Security::sanitizeInput($detailpk,"number");
        $ReturnFaq=ProjfaqdtlsTbl::find()
            ->select(['pfd_question as question','pfd_index as id','pfd_answer as answer'])
            ->where('pfd_projectdtls_fk=:detail and pfd_type=:module and pfd_status=1',[':detail'=>$sndetail,':module'=>$snmodule])
            ->orderBy('pfd_index asc')
            ->asArray()
            ->all();
        return $this->asJson($ReturnFaq);
    }

    public function actionGetrelatedproduct(){
        $detailpk=Security::decrypt($_GET['detailpk']);
        if(isset($_GET['type']) && $_GET['type']==1){
            $relatedProducts=$this->relatedproducts($detailpk);
        }else{
            $relatedProducts=$this->relatedservice($detailpk);
        }
        return $this->asJson($relatedProducts);
   }
   public function relatedproducts($detailpk){
       $productModel=MemcompproddtlsTbl::findOne($detailpk);
       $searchkeyword=$productModel->MCPrD_SearchKeyword;
       $searchkeywordUser=$productModel->mcprd_usersearchkeyword;
       $finalresultstring=[];
       Yii::$app->db->createCommand('SET group_concat_max_len = 50000000')->execute();
       if(!empty($searchkeyword) || !empty($searchkeywordUser)){
            $explodesearchkeyword=[];
            $explodesearchkeywordUser=[];
            $explodesearchkeywordUser=explode(',',$searchkeywordUser);
            $explodesearchkeyword=explode(',',$searchkeyword);
           if(!empty($searchkeyword) &&!empty($searchkeywordUser)){
                $allKeyWords=  array_merge($explodesearchkeyword,$explodesearchkeywordUser);
           }elseif (!empty($searchkeyword)) {
                $allKeyWords= $explodesearchkeyword;                
            }elseif (!empty($searchkeywordUser)) {
                $allKeyWords= $explodesearchkeyword;
            }
           $loginonly='';
           $headers = Yii::$app->request->headers;
           $authorization = $headers->get('Authorization');
           if($authorization != null && $authorization != '' && $authorization != 'Bearer null') {
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
                $loginonly=' and MCPrD_MemberCompMst_Fk='.$companypk;
           }
           foreach ($allKeyWords as $keyval){
               $findinisetModel=MemcompproddtlsTbl::find()
                   ->select('group_concat(MemCompProdDtls_Pk) as pks')
                   ->where("MemCompProdDtls_Pk !=$detailpk $loginonly")
                   ->andWhere(['!=', 'mcprd_isdeleted', 1])
                    ->andFilterWhere(['or',
                         ['OR LIKE', 'MCPrD_SearchKeyword', $keyval],
                         ['OR LIKE', 'mcprd_usersearchkeyword', $keyval],
                     ])
                   ->asArray()
                   ->all();
               if(!empty($findinisetModel)){
                   $finalresultstring[]=$findinisetModel[0]['pks'];
               }
               $stringof_pksArr=array_filter(array_unique(array_values($finalresultstring)));
               $stringof_pks=implode(',',$stringof_pksArr);
           }
       }
       $relatedProducts=[];
       if($stringof_pks !='' && !empty($stringof_pksArr)){
           $date_format='%d-%m-%Y';
           $relatedProducts=MemcompproddtlsTbl::find()
               ->select(['MCPrD_DisplayName as display','MemCompProdDtls_Pk as pk',
                   'mcprd_prodrefno','MCPrD_Createdby','MCPrD_SVFAdminApprovalStatus as status',
                   'MCPrD_MemberCompMst_Fk as company','mcprd_createdby as createdby',
                   'mcprd_prodviewcount as view',
                   'MCM_CompanyName as cname',
                   'PrdM_ProductCode as unpsc',
                   "COALESCE(date_format(MCPrD_CreatedOn,'$date_format'),'N/A') as createdon",
                   "COALESCE(date_format(MCPrD_UpdatedOn,'$date_format'),'N/A') as updatedon",
                   'COALESCE(mcprd_prodrefno,"NA") as refno', "COALESCE(mcprd_prodmodelno,'NA') as model",
                   'memcompfiledtls_pk as filepk','mcor_overallrating as starCount',
                   'mcor_ratingcount as ratingCount', 'mcor_reviewcount as reviewCount'
               ])
               ->leftJoin(MemcompfiledtlsTbl::tableName(), 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
               ->leftJoin('memcompoverallreview_tbl', 'mcor_shared_fk=MemCompProdDtls_Pk and mcor_type = 1')
               ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk=MCPrD_MemberCompMst_Fk')
               ->leftJoin('productmst_tbl', 'ProductMst_Pk=MCPrD_ProductMst_Fk')
               ->where('MemCompProdDtls_Pk in('.$stringof_pks.') and  MCPrD_CreatedOn is not null  and MCPrD_Createdby is not null')
               ->andWhere(['!=', 'mcprd_isdeleted', 1])
               ->orderBy('MemCompProdDtls_Pk desc ')->asArray()
               ->all();
           foreach ($relatedProducts as $productVal){
                if ($productVal['view'] != null && $productVal['view'] != 0) {
                    $productVal['view'] = Common::numberConversionNew($productVal['view']);
                }
                if(empty($session->MemberRegMst_Pk)){
                    $productVal['exUrl']= Profile::viewPageUrlGenerator($productVal['pk'],1);
                }else{
                    $productVal['exUrl']='/#/external/service/'.Security::encrypt($productVal['pk']);
                }
                $relProduct[]= $productVal;
            }
       }
       return $relProduct;
   }
   public function relatedservice($detailpk){
        $ServiceModel=MemcompservicedtlsTbl::findOne($detailpk);
       $searchkeyword=$ServiceModel->MCSvD_ServSearchKeyword;
       $searchkeywordUser=$ServiceModel->mcsvd_usersearchkeyword;
       $finalresultstring=[];
       Yii::$app->db->createCommand('SET group_concat_max_len = 50000000')->execute();
       if(!empty($searchkeyword) || !empty($searchkeywordUser)){
           $explodesearchkeyword=[];
            $explodesearchkeywordUser=[];
            $explodesearchkeywordUser=explode(',',$searchkeywordUser);
            $explodesearchkeyword=explode(',',$searchkeyword);
           if(!empty($searchkeyword) &&!empty($searchkeywordUser)){
                $allKeyWords=array_merge($explodesearchkeyword,$explodesearchkeywordUser);
           }elseif (!empty($searchkeyword)) {
                $allKeyWords= $explodesearchkeyword;                
            }elseif (!empty($searchkeywordUser)) {
                $allKeyWords= $explodesearchkeywordUser;
            }
           $loginonly='';
           $headers = Yii::$app->request->headers;
           $authorization = $headers->get('Authorization');
           if($authorization != null && $authorization != '' && $authorization != 'Bearer null') {
                $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
               $loginonly=' and MCSvD_MemberCompMst_Fk='.$companypk;
           }
           foreach ($allKeyWords as $keyval){
               $findinisetModel=MemcompservicedtlsTbl::find()
                   ->select('group_concat(MemCompServDtls_Pk) as pks')
                   ->where("MemCompServDtls_Pk !=$detailpk $loginonly")
                   ->andWhere(['!=', 'mcsvd_isdeleted', 1])
                    ->andFilterWhere(['or',
                         ['OR LIKE', 'MCSvD_ServSearchKeyword', $keyval],
                         ['OR LIKE', 'mcsvd_usersearchkeyword', $keyval],
                     ])
                   ->asArray()
                   ->all();
               if(!empty($findinisetModel)){
                   $finalresultstring[]=$findinisetModel[0]['pks'];
               }
               $stringof_pksArr=array_filter(array_unique(array_values($finalresultstring)));
               $stringof_pks=implode(',',$stringof_pksArr);
           }
       }
       $relatedService=[];
       if(!empty($stringof_pksArr) && $stringof_pks!=''){
           $date_format='%d-%m-%Y';
           $relatedService=MemcompservicedtlsTbl::find()
               ->select(['MCSvD_DisplayName as display','MemCompServDtls_Pk as pk',
                   'MCSvD_MemberCompMst_Fk as company','mcsvd_servfavcount as fav','mcsvd_servviewcount as view',
                   'mcsvd_createdby as createdby',
                   'SrvM_ServiceCode as unpsc',
                    'MCM_CompanyName as cname',
                   "COALESCE(date_format(MCSvD_CreatedOn,'$date_format'),'N/A') as createdon",
                   "COALESCE(date_format(MCSvD_UpdatedOn,'$date_format'),'N/A') as updatedon",
                   'COALESCE(mcsvd_servrefno,"NA") as refno', "COALESCE(mcsvd_servmodelno,'NA') as model",
                   'MCSvD_SVFAdminApprovalStatus as status','memcompfiledtls_pk as filepk','mcor_overallrating as starCount',
                   'mcor_ratingcount as ratingCount', 'mcor_reviewcount as reviewCount'
               ])
               ->leftJoin(MemcompfiledtlsTbl::tableName(), 'memcompfiledtls_pk=mcsvd_servcoverimgfile')
               ->leftJoin('memcompoverallreview_tbl', 'mcor_shared_fk=MemCompServDtls_Pk and mcor_type = 2')
               ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk=MCSvD_MemberCompMst_Fk')
               ->leftJoin('servicemst_tbl', 'ServiceMst_Pk=MCSvD_ServiceMst_Fk')
               ->where('MemCompServDtls_Pk in('.$stringof_pks.') and MCSvD_CreatedOn is not null and mcsvd_createdby is not null')
               ->andWhere(['!=', 'mcsvd_isdeleted', 1])
               ->orderBy('MemCompServDtls_Pk desc ')->asArray()
               ->all();
           foreach ($relatedService as $serviceVal){
                if ($serviceVal['view'] != null && $serviceVal['view'] != 0) {
                    $serviceVal['view'] = Common::numberConversionNew($serviceVal['view']);
                }
                if(empty($session->MemberRegMst_Pk)){
                    $serviceVal['exUrl']= Profile::viewPageUrlGenerator($serviceVal['pk'],2);
                }else{
                    $serviceVal['exUrl']='/#/external/service/'.Security::encrypt($serviceVal['pk']);
                }
                $relService[]= $serviceVal;
            }
       }
return $relService;
   }


   public function actionDeleteprice()
   {
       $price_pk = Security::decrypt($_REQUEST['pricepk']);
       $santized_pk = Security::sanitizeInput($price_pk, 'number');
       if ($santized_pk) {
           $delete_price = Profile::deleteprice($santized_pk);
       }
       return $delete_price;
   }

   public function actionDeletefaq() {
       $faq_pk = Security::decrypt($_REQUEST['faqpk']);
       $santized_pk = Security::sanitizeInput($faq_pk, 'number');
       if ($santized_pk) {
           $delete_faq = Profile::deletefaq($santized_pk);
       }
       return $delete_faq;
   }

   public function actionViewanalysis(){
        $AnalysisReturn=Common::analysisforlypis();
        return  $this->asJson($AnalysisReturn);
   }


   public function actionGetquantityprice() {
       $price_pk = Security::decrypt($_REQUEST['pricepk']);
       $type = Security::decrypt($_REQUEST['type']);

       $santized_pk = Security::sanitizeInput($price_pk, 'number');
       if ($santized_pk) {
           $get_price = Profile::getquantityprice($santized_pk, $type);
       }
       return $get_price;
}
   public function actionClearadditionalinfo(){
        $ReturnAdditionalinfo=MemcompproddtlsTbl::clearadditionalinfo();
        return $this->asJson($ReturnAdditionalinfo);
   }
   public function actionProdspecdtbgi(){
       $proudct=Security::decrypt($_GET['product']);
       $prodspec=MemcompprodspecdtlsTbl::getspeclist($proudct);
       return $this->asJson($prodspec);
   }
   public function actionGetuserdefspecmst(){
        $category=$_GET['category'];
        $sharedpk=Security::decrypt($_GET['shared']);
        $match_val = $_GET['match_val'];
        $specDesc = $_GET['specDesc'];
        $productmst = $_GET['productmst'];

        $match_sql = '';

        // if($match_val != '' && $match_val != null) {
        //     $match_sql = ' and mcspvd_parvalue like "%' . $match_val . '%"';
        // }

        if($specDesc != '' && $specDesc != 'null') {
            $match_sql = ' and SpM_SpecDesc like "%' . $specDesc . '%"';
        }

        // if($productmst != '' && $productmst != null) {
        //     $match_sql .= ' and mcspvd_productmst_fk=' . $productmst;
        // }

        if($category=='P'){
            $prdmodel=MemcompproddtlsTbl::findOne($sharedpk);
            $prdsermstpk=$prdmodel->MCPrD_ProductMst_Fk;
            $returnSpecMSt=SpecificationmstTbl::find()
                ->select(['SpecificationMst_Pk','SpM_Specification','SpM_SpecDesc', 'mcspvd_parvalue as spcValue'])
                ->leftJoin(MemcompspecprodvaldtlsTbl::tableName(),'SpecificationMst_Pk=mcspvd_specificationmst_fk')
                ->where('SpM_SpecCategory="P" and SpM_Status="A"')
                ->orderBy('SpM_Specification asc')
                ->asArray()->all();
                // and mcspvd_parvalue != null' . $match_sql and SpM_SpecDesc !=""
        }else if($category=='S'){
            $servmodel=MemcompservicedtlsTbl::findOne($sharedpk);
            $prdsermstpk=$servmodel->MCSvD_ServiceMst_Fk;
            $returnSpecMSt=SpecificationmstTbl::find()
                ->select(['SpecificationMst_Pk','SpM_Specification','SpM_SpecDesc', 'mcssvd_parvalue as spcValue'])
                ->leftJoin(MemcompspecservvaldtlsTbl::tableName(),'SpecificationMst_Pk=mcssvd_specificationmst_fk')
                ->where('SpM_SpecCategory="S" and SpM_Status="A"')
                ->orderBy('SpM_Specification asc')
                ->asArray()->all();
                // and mcssvd_parvalue != null' . $match_sql and SpM_SpecDesc !=""

        }
  return $returnSpecMSt ? $returnSpecMSt : [] ;
   }
    public function actionDeletemapspec(){
        $valdtls=Security::decrypt($_GET['valtbl']);
        $spctblpk=Security::decrypt($_GET['sptbl']);
        $productServicepk=Security::decrypt($_GET['productandservice']);
        $type=$_GET['type'];
        $log_url = '/j3/api/pm/profile/deletemapspec';
        $log_action = 3;
        if(!empty($valdtls) && !empty($spctblpk)) {
            if ($type == 'P') {
                $log_msg = 'Deleted Product Specification.';
                MemcompprodspecdtlsTbl::deleteAll('MemCompProdSpecDtls_Pk=:dtpk and 
                MCPSD_MemCompProdDtls_Fk=:prd and mcpsd_memcompspecprodvaldtls_fk=:valpk',
                [':dtpk' => $spctblpk, ':valpk' => $valdtls, ':prd' => $productServicepk]);
                //MemcompspecprodvaldtlsTbl::deleteAll('memcompspecprodvaldtls_pk=:valpk', [':valpk' => $valdtls]);
            } else if ($type == 'S') {
                $log_msg = 'Deleted Service Specification.';
                MemcompservspecdtlsTbl::deleteAll('MemCompServSpecDtls_Pk=:dtpk and 
            MCSSD_MemCompServDtls_Fk=:prd and mcssd_memcompspecservvaldtls_fk=:valpk',
                    [':dtpk' => $spctblpk, ':valpk' => $valdtls, ':prd' => $productServicepk]);
                //MemcompspecservvaldtlsTbl::deleteAll('memcompspecservvaldtls_pk=:valpk', [':valpk' => $valdtls]);
            }
            \common\components\UserActivityLog::logUserActivity($log_action, $log_msg, $log_url,22);
        }
        return $this->asJson(['flag'=>'S','code'=>200]);
    }
   public function actionServicespec(){
        $data=MemcompspecservvaldtlsTbl::getservicespecdata();
        return $this->asJson($data);
   }
    public function actionGetfilepathc(){
        $pk = $_GET['pk'];
        $loggedin_user = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $track = 1;
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $data = Drive::generateUrl($pk, $companypk, $loggedin_user, $track);
        return $this->asJson($data);
    }

    public function actionDeletecontactinfo() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $data['service_id'] = Security::decrypt($data['service_pk']);
        $data['contact_id'] = $data['contact_id'];
        if($data['service_id']) {
           $delete_contact = Profile::deleteservicecontact($data);
        }
        return $delete_contact;
    }

    public function actionDeleteproductcontactinfo() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $data['product_pk'] = Security::decrypt($data['product_pk']);
        $data['contact_id'] = $data['contact_id'];
        if($data['service_id']) {
           $delete_contact = Profile::deleteproductcontact($data);
        }
        return $delete_contact;
    }
    public function actionClearallspec()
    {
        $sharedpk = Security::decrypt($_GET['shared']);
        $typeofprocess = $_GET['type'];
        if (!empty($typeofprocess) && !empty($sharedpk)) {
            if ($typeofprocess == 'P') {
                MemcompprodspecdtlsTbl::deleteAll('MCPSD_MemCompProdDtls_Fk=:prd', [':prd' => $sharedpk]);
            } else if ($typeofprocess == 'S') {
                MemcompservspecdtlsTbl::deleteAll('MCSSD_MemCompServDtls_Fk=:serv', [':serv' => $sharedpk]);
            }
            $data = ['code' => 200, 'msg' => 'Deleted Successfully'];
            return $this->asJson($data);
        }
    }

    function actionGeneratekeywords() {
        $request_body = file_get_contents('php://input');
        $str_arr = json_decode($request_body, true);

        $min_word_length = 2;
        $avoid = ['i', 'me', 'my', 'myself', 'we', 'our', 'ours', 'ourselves', 'you', 'your', 'yours', 'yourself', 'yourselves', 
        'he', 'him', 'his', 'himself', 'she', 'her', 'hers', 'herself', 'it', 'its', 'itself', 'they', 'them', 'their', 'theirs', 
        'themselves', 'what', 'which', 'who', 'whom', 'this', 'that', 'these', 'those', 'am', 'is', 'are', 'was', 'were', 'be', 
        'been', 'being', 'have', 'has', 'had', 'having', 'do', 'does', 'did', 'doing', 'a', 'an', 'the', 'and', 'but', 'if', 'or', 
        'because', 'as', 'until', 'while', 'of', 'at', 'by', 'for', 'with', 'about', 'against', 'between', 'into', 'through', 'during', 
        'before', 'after', 'above', 'below', 'to', 'from', 'up', 'down', 'in', 'out', 'on', 'off', 'over', 'under', 'again', 'further', 
        'then', 'once', 'here', 'there', 'when', 'where', 'why', 'how', 'all', 'any', 'both', 'each', 'few', 'more', 'most', 'other', 
        'some', 'such', 'no', 'nor', 'not', 'only', 'own', 'same', 'so', 'than', 'too', 'very', 's', 't', 'can', 'will', 'just', 'don', 
        'should', 'now', 'also', 'search', 'using', 'give'];
        $strip_arr = ["," ,"." ,";" ,":", "\"", "'", "“","”","(",")", "!","?"];
        $strip_arr_new = [ "-","_"];
        $clean_arr = [];
        $lypis_id = \yii\db\ActiveRecord::getTokenData('lypis_id', true);
        array_push($lypis_id, $clean_arr);

        foreach($str_arr as $key => $string) {
            if($key == 'unspc') {
                $unpsc_arr = explode('-', $string);
                $unpsc_code = $unpsc_arr[0];
                $clean_arr[] = $unpsc_code;
            }
            $str_clean = str_replace($strip_arr, "", $string);
            $str_clean = str_replace($strip_arr_new, " ", $str_clean);
            $str_clean = strip_tags($str_clean);
            $str_arr_new = explode(' ', $str_clean);
            foreach($str_arr_new as $word) {
                if(strlen($word) > $min_word_length) {
                    $word = strtolower($word);
                    if(!in_array($word, $avoid) && !in_array($word, $clean_arr) && !is_numeric($word)) {
                        $clean_arr[] = $word;
                    }
                }
            }
        }
        return implode(',', $clean_arr);
    }
    function actionUnmappingbussrc() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $bsdata['pk'] = Security::decrypt($data['bussrcdet']['pk']);
        $bsdata['bussrc'] = $data['bussrcdet']['bussrc'];
        $bsdata['fact'] = $data['bussrcdet']['fact'];
        $bsdata['type'] = $data['bussrcdet']['type'];
        if($bsdata['bussrc']) {
           $unmap_bs = Profile::unmapbusinesssrc($bsdata);
        }
        return $unmap_bs;
    }

    function actionGetmappedbus() {
        $data['pk'] = Security::decrypt($_REQUEST['pk']);
        $data['type'] = $_REQUEST['type'];
        $get_bs = Profile::getmapbusinesssrc($data);
        return $get_bs;
    }

    function actionAddproductgroup() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pgdata = $data['prodgroup'];

        if($data) {
           $addproductgroup = Profile::addproductgroup($pgdata);
        }
        return $addproductgroup;
    }

    function actionGetproductgroup() {
        $extprof = false;
        $isForExternalProfile = strrpos($_SERVER['HTTP_CURRENTURL'],'externalprofile/');
        if($isForExternalProfile){
            $extproflink = substr($_SERVER['HTTP_CURRENTURL'],17);
            $linkdet = explode('/', $extproflink);
            if(count($linkdet) > 1){
                $iscompanypk = 1;
                $extprofname = base64_decode($linkdet[0]);
            }else{
                $iscompanypk = 2;
                $extprofname = $linkdet[0];
            }
            $extprof = new \common\components\Extprof($extprofname,$iscompanypk);
            $company_id = $extprof->comppk;
        }
        $addproductgroup = Profile::getproductgroup($company_id);
        return $addproductgroup;
    }

    function actionGetproductgroupforid() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $id = $data['id'];
        $getbreadscrump = Profile::getproductgroupforid($id);
        return $getbreadscrump;
    }

    
    function actionDeletegroupid() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $id = $data['id'];
        $deletegroup = Profile::deletegroupid($id);
        return $deletegroup;
    }

    function actionGetrelatedproductsugg() {
        $subcatid = $_GET['subcat'];
        $currentPk = $_GET['currentPk'];
        $getrelatedproduct = Profile::getrelatedproduct($subcatid,$currentPk);
        return $getrelatedproduct;
    }

    function actionGetrelatedservicesugg() {
        $subcatid = $_GET['subcat'];
        $currentPk = $_GET['currentPk'];
        $getrelatedservice = Profile::getrelatedservice($subcatid,$currentPk);
        return $getrelatedservice;
    }
    function actionGetbusiesssource() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $dataPk = $data['dataPk'];
        $type = $data['type'];
        $dataPk = Security::decrypt($dataPk);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $getBusinessSource = Profile::getBSData($dataPk,$type);
        return $getBusinessSource;
    
    }
        /**
     * @SWG\Post(
     *     path="/pm/profile/addproductdocs",
     *     tags={"Add Product Document Upload"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to save document details of the product",
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="product_pk", type="string", example=""),
     *                  @SWG\Property(property="procover", type="array", example=""),
     *                  @SWG\Property(property="probrochure", type="array", example=""),
     *                  @SWG\Property(property="prootherfiles", type="array", example=""),
     *                  @SWG\Property(property="proinnerimg", type="array", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public function actionGetsupportfile(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Profile::getSupportFile($data);
        return $data;
    }

    public function actionGetproductgroupid() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Profile::getproductgroupid($data);
        return $data;
    }

    public function actionGetproductdetails() {
        $pk = $_REQUEST['propk'];
        $data = Profile::getproductdetails($pk);
        return $data;
    }

    public function actionGetservicedetails() {
        $pk = $_REQUEST['servpk'];
        $data = Profile::getservicedetails($pk);
        return $data;
    }

    public function actionGetproductbasedoncategory() {
        $request['type'] = $_REQUEST['forpage'];
        $category_group_val = BgiindcodecategTblQuery::getcatlistforcompany($request['type']);

        $categories = $category_group_val['items'];

        foreach($categories as $key =>  $val) {
            $cvalue = (array) $val;
            $catval['category'] = $cvalue['bgiindcodecateg_pk'];
            $catval['type'] = $request['type'];

            $final_array[$key]['id'] = $cvalue['bgiindcodecateg_pk'];
            $final_array[$key]['parent_id'] = null;
            $final_array[$key]['name'] = $cvalue['bicc_categoryname'];

            $main_categroy_val = BgiindcodesubcategTblQuery::getsubcategorylist($catval);
        
            $main_cat = $main_categroy_val['items'];
            foreach($main_cat as $ckey => $cval) {
                $scvalue = (array) $cval;
                $scatval['category'] = $scvalue['bicsc_bgiindcodecateg_fk'];
                $scatval['subcategory'] = $scvalue['bgiindcodesubcateg_pk'];
                $scatval['type'] = $request['type'];
                
                $subcat_parent = $final_array[$key]['children'][$ckey]['id'] = $scvalue['bgiindcodesubcateg_pk'];
                $final_array[$key]['children'][$ckey]['parent_id'] = $scvalue['bicsc_bgiindcodecateg_fk'];
                $final_array[$key]['children'][$ckey]['name'] = $scvalue['bicsc_subcategoryname'];

                $bgiproduct_list = BgiinduscodeprodmstTblQuery::getbgiproductlistforcompany($scatval);

                $bgiproductval = $bgiproduct_list['items'];

                foreach($bgiproductval as $pkey => $pval) {
                    $pvalue = (array) $pval;

                    $proval['type'] = $request['type'];
                    
                    if($proval['type'] == 'P') {
                        $proval['proservid'] = $pvalue['bgiinduscodeprodmst_pk'];
                        $product_parent_id = $final_array[$key]['children'][$ckey]['children'][$pkey]['id'] = $pvalue['bgiinduscodeprodmst_pk'];
                        $final_array[$key]['children'][$ckey]['children'][$pkey]['name'] = $pvalue['bicpm_productname'];
                    } else {
                        $proval['proservid'] = $pvalue['bgiinduscodeservmst_pk'];
                        $product_parent_id = $final_array[$key]['children'][$ckey]['children'][$pkey]['id'] = $pvalue['bgiinduscodeservmst_pk'];
                        $final_array[$key]['children'][$ckey]['children'][$pkey]['name'] = $pvalue['bicsm_servicename'];
                    }

                    $final_array[$key]['children'][$ckey]['children'][$pkey]['parent_id'] = $subcat_parent;

                    $product_list = UnspcbipcmappingTbl::getproductmstlistforcompany($proval);

                    $unpscproductsval = $product_list['items'];

                    foreach($unpscproductsval as $upkey => $upval) {
                        $upvalue = (array) $upval;
                        $unpscproductsval[$upkey] = $upvalue;
                        if($request['type'] == 'P') {
                            $final_array[$key]['children'][$ckey]['children'][$pkey]['children'][$upkey]['id'] = $upvalue['ProductMst_Pk'];
                            $final_array[$key]['children'][$ckey]['children'][$pkey]['children'][$upkey]['parent_id'] = $product_parent_id;
                            $final_array[$key]['children'][$ckey]['children'][$pkey]['children'][$upkey]['name'] = $upvalue['PrdM_ProductCode'] . '-' . $upvalue['PrdM_ProductName']; 
                        } else {
                            $final_array[$key]['children'][$ckey]['children'][$pkey]['children'][$upkey]['id'] = $upvalue['ServiceMst_Pk'];
                            $final_array[$key]['children'][$ckey]['children'][$pkey]['children'][$upkey]['parent_id'] = $product_parent_id;
                            $final_array[$key]['children'][$ckey]['children'][$pkey]['children'][$upkey]['name'] = $upvalue['SrvM_ServiceCode'] . '-' . $upvalue['SrvM_ServiceName'];
                        }

                    }
                }

            }
            
        }
        return $final_array;
    }

    public function actionMoveproductgroup() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        $data = Profile::moveproductgroup($data);
        return $data;
    }

    public function actionGetgroupcategory() {
        $data = Profile::getgroupcategory();
        return $data;
    }

    public function actionGetcmsmaincategory() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        $data = Profile::getcmsmaingategory($data);
        return $data;
    }

    public function actionGetcmssubcategory() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);

        $data = Profile::getcmsubgategory($data);
        return $data;
    }

    public function actionSavecmscategroydetails() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data['req_pk'] = Security::decrypt($data['req_pk']);

        $data = Profile::savecmscategroydetails($data);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/pm/profile/submitfaqdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit FAQ Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="dataPk", type="string"),
     *                      @SWG\Property(property="question", type="string"),
     *                      @SWG\Property(property="email", type="string"),
     *                      @SWG\Property(property="name", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitfaqdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['formData']['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $formdata['formData']['dataPk']=$contractPk;
        if ($formdata) {
            echo '<pre>';
                        print_r($formdata);exit;
            return $data;
        }
    }

    public function actionGetcmscategroydetails() {
        $req_id = $_REQUEST['id'];
        $type = $_REQUEST['type'];
        $data['req_id'] = Security::decrypt($req_id);
        $data['type'] = $type;

        $data = Profile::getcmscategroydetails($data);
        return $data;
    }
    public function actionGetproductperctage()
    {
        $maximumPoints  = 100;
        $response = 0;
        $hasCompleteddisplanme = 0;
        $hasCompletedcategoryingo = 0;
        $hasCompletedbusinesssrc = 0;
        $hasCompletedcontactname = 0;
        $hasCompletedsupportcoll = 0;
        $hasCompletedproductdesc = 0;
        $hasCompletedproductorgin = 0;
        $hasCompletedproductordermode = 0;
        $hasCompletedordercapcty = 0;
        $hasCompletedminordercap = 0;
        $hasCompletedmaxordercap = 0;
        $request_body	= file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $prodpk_dec=$data['memcompproddtls']['memcompproddtls_pk'];
        $inital=$data['memcompproddtls']['type'];
        $pk_dec = Security::decrypt($prodpk_dec);
        $pk=Security::sanitizeInput($pk_dec,'number');
       if(!empty($pk))
        {
            $product_data= \common\models\MemcompproddtlsTbl::find() ->where('MemCompProdDtls_Pk=:product_pk',[':product_pk'=>$pk])->one();
            if($inital == 1 && !empty($product_data)){
                $response = $product_data['MCPrD_ProdPercent'];
            }else{
                if(!empty($product_data)){
                    $businessrc =  \common\models\MemcompprodbussrcmapTbl::find() ->where('mcpbsm_memcompproddtls_fk=:product_pk',[':product_pk'=>$pk])->count();
                    if(!empty($product_data['MCPrD_DisplayName'])){
                        $hasCompleteddisplanme =  \Yii::$app->params['Productspoints']['displayname'];
                    }
                    if(!empty($product_data['mcprd_contactinfo'])){
                        $hasCompletedcontactname =  \Yii::$app->params['Productspoints']['contactinfo'];
                    }
                    if(!empty($product_data['mcprd_prodcoverimgfile'])){
                        $hasCompletedsupportcoll =  \Yii::$app->params['Productspoints']['supportcoll'];
                    }
                    if(!empty($product_data['MCPrD_ProdDesc'])){
                        $hasCompletedproductdesc=  \Yii::$app->params['Productspoints']['productdesc'];
                    }
                    if(!empty($product_data['mcprd_prodorigin'])){
                        $hasCompletedproductorgin=  \Yii::$app->params['Productspoints']['productorgin'];
                    }
                    if(!empty($product_data['mcprd_ordermode'])){
                        $hasCompletedproductordermode =  \Yii::$app->params['Productspoints']['productmode'];
                    }
                    if(!empty($product_data['mcprd_ordercapacityunit'])){
                        $hasCompletedordercapcty =  \Yii::$app->params['Productspoints']['productordercap'];
                    }
                    if(!empty($product_data['mcprd_minordercapacity'])){
                        $hasCompletedminordercap =  \Yii::$app->params['Productspoints']['productminorder'];
                    }
                    if(!empty($product_data['mcprd_maxordercapacity'])){
                        $hasCompletedmaxordercap =  \Yii::$app->params['Productspoints']['productmaxorder'];
                    }
                    if(!empty($product_data['mcprd_bgiindcodecateg_fk']) && !empty($product_data['mcprd_bgiindcodesubcateg_fk']) && !empty($product_data['mcprd_bgiinduscodeprodmst_fk'])){
                        $hasCompletedcategoryingo =  \Yii::$app->params['Productspoints']['categoryinfo'];
                    }
                    if($businessrc > 0){
                         $hasCompletedbusinesssrc =  \Yii::$app->params['Productspoints']['businesssrc'];
                    }
                    $response = ($hasCompleteddisplanme+$hasCompletedcategoryingo+$hasCompletedbusinesssrc+$hasCompletedcontactname+$hasCompletedsupportcoll+$hasCompletedproductdesc+$hasCompletedproductorgin+$hasCompletedproductordermode+$hasCompletedordercapcty+$hasCompletedminordercap+$hasCompletedmaxordercap)*$maximumPoints/100;
                    $product_data->MCPrD_ProdPercent = (string)$response;
                    $product_data->save();
                }
            }            
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }    
    public function actionGetservicesperctage()
    {
        $maximumPoints  = 100;
        $response = 0;
        $hasCompleteddisplanme = 0;
        $hasCompletedcategoryingo = 0;
        $hasCompletedbusinesssrc = 0;
        $hasCompletedcontactname = 0;
        $hasCompletedservicesdesc = 0;
        $request_body	= file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $prodpk_dec=$data['servicedet']['serdtpk'];
        $inital=$data['servicedet']['type'];
        $pk_dec = Security::decrypt($prodpk_dec);
        $pk=Security::sanitizeInput($pk_dec,'number');
       if(!empty($pk))
        {
            $services_data= \common\models\MemcompservicedtlsTbl::find() ->where('MemCompServDtls_Pk=:services_pk',[':services_pk'=>$pk])->one();
              if($inital == 1 && !empty($services_data)){
                  $response = $services_data['MCSvD_ServPercent'];
              }else{
                if(!empty($services_data)){
                    $businessrc =  \common\models\MemcompservbussrcmapTbl::find() ->where('mcsbsm_memcompservdtls_fk =:services_pk',[':services_pk'=>$pk])->count();
                    if(!empty($services_data['MCSvD_DisplayName'])){
                        $hasCompleteddisplanme =  \Yii::$app->params['Servicesspoints']['displayname'];
                    }
                    if(!empty($services_data['MCSvD_ServDesc'])){
                        $hasCompletedservicesdesc =  \Yii::$app->params['Servicesspoints']['servicesdesc'];
                    }
                    if(!empty($services_data['mcsvd_contactinfo'])){
                        $hasCompletedcontactname =  \Yii::$app->params['Servicesspoints']['contactinfo'];
                    }
                    if(!empty($services_data['mcsvd_bgiindcodecateg_fk']) && !empty($services_data['mcsvd_bgiindcodesubcateg_fk']) && !empty($services_data['mcsvd_bgiinduscodeservmst_fk'])){
                        $hasCompletedcategoryingo =  \Yii::$app->params['Servicesspoints']['servicescategory'];
                    }
                    if($businessrc > 0){
                        $hasCompletedbusinesssrc =  \Yii::$app->params['Servicesspoints']['bussinessrc'];
                    }
                    $response = ($hasCompleteddisplanme+$hasCompletedservicesdesc+$hasCompletedcontactname+$hasCompletedcategoryingo+$hasCompletedbusinesssrc)*$maximumPoints/100;
                    $services_data->MCSvD_ServPercent = (string)$response;
                    $services_data->save();
                }  
            }              
        }
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $response
        ];
    }   
    
    public function actionDownloadexcel() {
        $filetrackpk = base64_decode($_REQUEST['id']);
        $userpk = base64_decode($_REQUEST['user']);
        //if local
        // $baseurl = 'http://localhost:4200/';
        $baseurl = Yii::$app->params['baseUrl'];
        if($filetrackpk) {
            $model = \api\modules\pms\models\JsrchdwnldtrackTbl::findOne(['jsrchdwnldtrack_pk' => $filetrackpk, 'jsdt_usermst_fk' => $userpk]); 
            if($model) {
                $now = $date = date('Y-m-d H:i:s');
                $expiry_date = date("Y-m-d H:i:s", strtotime($model->jsdt_expirydate));           
                if($model->jsdt_xlspath) {
                    if($model->jsdt_expirydate >= $now) { 
                        $srcPath = Yii::$app->params['srcDirectory'];
                        $file_url = $model->jsdt_xlspath;
                        $link_array = explode('/', $model->jsdt_xlspath);
                        $file_name = end($link_array);
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/vnd.ms-excel');
                        header('Content-Disposition: attachment; filename="'.$file_name.'"');
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($srcPath . '/exceltemplates/' . $file_name)); //Absolute URL  
                        ob_clean();
                        flush();
                        readfile($srcPath . '/exceltemplates/' . $file_name); //Absolute URL
                        exit();
                    } else {
                        $srcPath = Yii::$app->params['srcDirectory']; 
                        $link_array = explode('/', $model->jsdt_xlspath);
                        $file_name = end($link_array); 
                        unlink($srcPath . '/exceltemplates/' . $file_name); 
                        $url = $baseurl . 'transaction/transactionlandingpage?type=1';
                        Yii::$app->getResponse()->redirect($url); 
                    }
                } 
            } else { 
                $url = $baseurl . 'transaction/transactionlandingpage?type=2';
                Yii::$app->getResponse()->redirect($url); 
            }
        }

    }

    public function actionDeleteexpiredfiles() {
        $now = date('Y-m-d H:i:s'); 
        $srcPath = Yii::$app->params['srcDirectory']; 
        $expired_files = \api\modules\pms\models\JsrchdwnldtrackTbl::find()->select(['jsrchdwnldtrack_pk']) 
            ->where('jsdt_expirydate < :expdate', [':expdate' => $now])
            ->asArray()
            ->all(); 
        foreach($expired_files as $key => $value) {
            $model = \api\modules\pms\models\JsrchdwnldtrackTbl::findOne($value['jsrchdwnldtrack_pk']); 
            if($model->jsdt_xlspath) {
                $link_array = explode('/', $model->jsdt_xlspath);
                $file_name = end($link_array);  
                unlink($srcPath . '/exceltemplates/' . $file_name);
            }
        }
        return [
            'status' => 'success', 
            'msg' => 'Expired files are removed successfully'
        ];

    }

    public function actionProdBranchList(){
        $prodpk = Security::decrypt($_REQUEST['prodpk']);
        $type = $_REQUEST['type'];

        return Profile::prodbranchlist($prodpk,$type);
      
    }

    public function actionSerBranchList(){
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        
        $serpk = Security::decrypt($_REQUEST['serpk']);
        $type = $_REQUEST['type'];
        $bssrbranchpks='';
        $bssrpks='';

        $business_src_det = \common\models\MemcompservbussrcmapTbl::find()->select(['GROUP_CONCAT(DISTINCT(mcbsd_memcompbranchdtlstemp_fk)) as bssrbranchpk','GROUP_CONCAT(DISTINCT(memcompbussrcdtls_pk)) as memcompbussrcdtls_pk'])
        ->leftJoin('memcompbussrcdtls_tbl','memcompbussrcdtls_pk = mcsbsm_memcompbussrcdtls_fk')
        ->where('mcsbsm_memcompservdtls_fk=:pk',[':pk'=>$serpk])
        ->asArray()
        ->all();
        //echo '<pre>';print_r($_REQUEST);exit;
       if(!empty($business_src_det)){
            $bssrbranchpks=array_map('intval', explode(',', $business_src_det[0]['bssrbranchpk']));
            $bssrpks=array_map('intval', explode(',', $business_src_det[0]['memcompbussrcdtls_pk']));
       }
        $branchids='';
        $factidss='';
        $selectedbranchfinal_data=[];
        if($type=='S'){
            if(!empty($serpk) && $serpk!=null && $serpk!="undefined"){
                $proddtls_model = MemcompservicedtlsTbl::find()->where(['MemCompServDtls_Pk'=> $serpk])->one();
    
                if(!empty($proddtls_model) && $proddtls_model->mcsvd_memcompbranchdtlstemp_fk!=null && $proddtls_model->mcsvd_memcompbranchdtlstemp_fk!=''){
                    $branchids=$proddtls_model->mcsvd_memcompbranchdtlstemp_fk;
                }
                // if(!empty($proddtls_model) && $proddtls_model->mcprd_memcompfctydtls_fk!=null && $proddtls_model->mcprd_memcompfctydtls_fk!=''){
                //     $factidss=$proddtls_model->mcprd_memcompfctydtls_fk;
                // }
            }
        }
        if($branchids!=''){
            $br_idss=array_map('intval', explode(',', $branchids));
            $selectedbranchlistData=MemcompbranchdtlstempTbl::find()->select([
                'mcbdt_scfstatus as scfstatus',
                'memcompbranchdtlstemp_pk as brtemp_pk',
                'mcbdt_branchname as br_name',
                'mcbdt_branchnumber as br_number',
                "COALESCE(mcbdt_indzoneregno, 'N/A') as indszone_regno",
                'mcbdt_isicactivitymst_fk as isicactvpks',
                'mcbdt_upload as actvlicensepk',
                "COALESCE(izm_zonename_en,'N/A') as izm_zonename_en",
                "COALESCE(izm_zonename_ar,'N/A') as izm_zonename_ar",
                "COALESCE(iem_estatename_en,'N/A') as iem_estatename_en",
                "COALESCE(iem_estatename_ar,'N/A') as iem_estatename_ar",
                'mcbdt_officetypemst_fk  as officetype','mcbdt_industrialzonemst_fk as industrialzonemst_fk','mcbdt_industrialestatemst_fk as industrialestatemst_fk','mcbdt_officenumber as officenumber','mcbdt_floor as floor','mcbdt_buildingname as buildingname','mcbdt_waynumber as waynumber','mcbdt_streetname as streetname','mcbdt_town as town','mcbdt_statemst_fk','mcbdt_citymst_fk','mcbdt_poboxno',
                'mcbdt_postalcode','mcbdt_postalstatemst_fk','SM_StateName_en as postalgovernate','mcbdt_postalcitymst_fk','CM_CityName_en as postalcity','mcfd.mcfd_origfilename','SM_StateName_en as offstate_en','CM_CityName_en as offcity','otm_officename_en as officetypename'
                
                ])
            ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
            ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
            ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = mcbdt_upload')
            ->leftJoin('statemst_tbl stmst', 'mcbdt_statemst_fk = stmst.StateMst_Pk')
            ->leftJoin('citymst_tbl ctmst', 'mcbdt_citymst_fk = ctmst.CityMst_Pk')
            ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
            ->where(['in','memcompbranchdtlstemp_pk',$br_idss])
            ->orderBy('mcbdt_branchname asc')->asArray();
            $selectBranch=new ActiveDataProvider([ 'query' => $selectedbranchlistData]);
            $br_isicact_idss = [];
            $sectidss=[];
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

                foreach ($activitieslist as $key => $value) {
                    $actarr = [];
                    foreach ($activitieslist as $key => $actval) {
                        if ($value['ActM_SectorMst_Fk'] == $actval['ActM_SectorMst_Fk']) {
                            $actarr[] = $actval;
                        }
                    }
                    if (!in_array($value['ActM_SectorMst_Fk'], $sectidss)) {
                        $isic_activitiesdata[] = ['SecM_SectorName' => $value['SecM_SectorName'],'ActM_SectorMst_Fk'=>$value['ActM_SectorMst_Fk'], 'actarr' => $actarr];
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
                $brval['tot_isicCnt']=count($activitieslist);
                $brval['isicactivities']=$isic_activitiesdata;
                $selectedbranchfinal_data[]=$brval;
            }
        }
        $branchfinal_data=[];
        $branchlistData=MemcompbranchdtlstempTbl::find()->select([
            'mcbdt_scfstatus as scfstatus',
            'memcompbranchdtlstemp_pk as brtemp_pk',
            'mcbdt_branchname as br_name',
            'mcbdt_branchnumber as br_number',
            "COALESCE(mcbdt_indzoneregno, 'N/A') as indszone_regno",
            'mcbdt_isicactivitymst_fk as isicactvpks',
            'mcbdt_upload as actvlicensepk',
            "COALESCE(izm_zonename_en,'N/A') as izm_zonename_en",
            "COALESCE(izm_zonename_ar,'N/A') as izm_zonename_ar",
            "COALESCE(iem_estatename_en,'N/A') as iem_estatename_en",
            "COALESCE(iem_estatename_ar,'N/A') as iem_estatename_ar",
            'otm_officename_en as officetypename'
            ])
        ->leftJoin('industrialzonemst_tbl', 'industrialzonemst_pk=mcbdt_industrialzonemst_fk')
        ->leftJoin('industrialestatemst_tbl',' industrialestatemst_pk=mcbdt_industrialestatemst_fk')
        ->leftJoin('officetypemst_tbl otm', 'mcbdt_officetypemst_fk = otm.officetypemst_pk')
        // ->where(['mcbdt_memcompmst_fk'=>$compPK])
        ->where(['in','memcompbranchdtlstemp_pk',$bssrbranchpks])
        ->orderBy('mcbdt_branchname asc')->asArray();
        $provider=new ActiveDataProvider([ 'query' => $branchlistData]);
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
            $activitieslist= \api\modules\mst\models\ActivitiesmstTbl::find()
            ->select(['ActivitiesMst_Pk','ActM_SectorMst_Fk','ActM_ActivityCode','ActM_ActivityCode_ar','ActM_ActivityName','ActM_ActivityName_ar','SecM_SectorName','SecM_SectorName_ar','SecM_SectorCode'])
            ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
            ->where(['in','ActivitiesMst_Pk', explode(',',$proVal['isicactvpks']) ])
            ->andWhere(['ActM_Status'=>'A'])
            ->asArray()->all();
            foreach ($activitieslist as $key => $value) {
                $actarr = [];
                foreach ($activitieslist as $key => $actval) {
                    if ($value['ActM_SectorMst_Fk'] == $actval['ActM_SectorMst_Fk']) {
                        $actarr[] = $actval;
                    }
                }
                if (!in_array($value['ActM_SectorMst_Fk'], $sectidss)) {
                    $isic_activitiesdata[] = ['SecM_SectorName' => $value['SecM_SectorName'],'ActM_SectorMst_Fk'=>$value['ActM_SectorMst_Fk'], 'actarr' => $actarr];
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
            $proVal['isicactivities']=$isic_activitiesdata;
            $branchfinal_data[]=$proVal;

        }

        

        $result = array(
            'status' => 200,
            'msg' => 'success',
            //'flag' => 'S',
            'branch_count'=>$provider->getTotalCount(),
            'branchList'=>$branchfinal_data,
            //'limit' => $page_size,
            'selectedbranches'=>$selectedbranchfinal_data
        );

        return $result;
      
    }

    public function actionRemovebranchfactory(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        // $model_prod = MemcompproddtlsTbl::find()->where([
        //     'MemCompProdDtls_Pk' => Security::decrypt($data['prodid'])
        //     ])->andWhere(['!=', 'mcprd_isdeleted', 1])->one();

        $prodid=Security::decrypt($data['prodid']);
        $productModel=MemcompproddtlsTbl::findOne($prodid);

        if($data['type']=='branch_product'){
            // Get product branch details from table 
            $mgs="Branch deleted successfully";
            if($productModel->mcprd_memcompbranchdtlstemp_fk!=""){
                $mcprd_memcompbranchdtlstemp_fk=explode(",",$productModel->mcprd_memcompbranchdtlstemp_fk);
                $mcprd_memcompbranchdtlstemp_fk_updates=array_diff($mcprd_memcompbranchdtlstemp_fk,[$data['selec_pk']]);
                $update_value=implode(",",array_unique($mcprd_memcompbranchdtlstemp_fk_updates));
                $updatedOndtls = Yii::$app->db->createCommand('UPDATE memcompproddtls_tbl SET mcprd_memcompbranchdtlstemp_fk="'.$update_value.'" WHERE MemCompProdDtls_Pk="'.$prodid.'" ');
                $updatedOndtls_result=$updatedOndtls->execute();
                if(!$updatedOndtls_result)
                {
                    $result= ["msg" => "Something went wrong!!","status" => 2,'productModel'=>$productModel];
                    return $result;
                }
            }
           

        }else if($data['type']=='factory_product'){
            // Get product branch details from table 
            $mgs="Factory deleted successfully";
            if($productModel->mcprd_memcompfctydtls_fk!=""){
                $mcprd_memcompfctydtls_fk=explode(",",$productModel->mcprd_memcompfctydtls_fk);
                $mcprd_memcompfctydtls_fk_updates=array_diff($mcprd_memcompfctydtls_fk,[$data['selec_pk']]);
                $update_value=implode(",",array_unique($mcprd_memcompfctydtls_fk_updates));
                $updatedOndtls = Yii::$app->db->createCommand('UPDATE memcompproddtls_tbl SET mcprd_memcompfctydtls_fk="'.$update_value.'" WHERE MemCompProdDtls_Pk="'.$prodid.'" ');
                $updatedOndtls_result=$updatedOndtls->execute();
                if(!$updatedOndtls_result)
                {
                    $result= ["msg" => "Something went wrong!!","status" => 2,'productModel'=>$productModel];
                    return $result;
                }
            }
           

        }
        else if($data['type']=='branch'){
            // $model_prod->mcprd_memcompbranchdtlstemp_fk=!empty($data['selec_pk'])?$data['selec_pk'][0]:null;

            $selbrpk=(!empty($data['selec_pk']))?implode(',',$data['selec_pk']):null;
            $updatedOndtls = Yii::$app->db->createCommand('UPDATE memcompproddtls_tbl SET mcprd_memcompbranchdtlstemp_fk="'.$selbrpk.'" WHERE MemCompProdDtls_Pk="'.$prodid.'" ');
            $updatedOndtls_result=$updatedOndtls->execute();
            $mgs="Branch deleted successfully";
            if(!$updatedOndtls_result)
            {
                $result= ["msg" => "Something went wrong!!","status" => 2,'productModel'=>$productModel];
                return $result;
            }
           
        }else{
            // $model_prod->mcprd_memcompfctydtls_fk=!empty($data['selec_pk'])?$data['selec_pk'][0]:null;
            $mgs="Factory deleted successfully";
            $selfack=(!empty($data['selec_pk']))?implode(',',$data['selec_pk']):null;
            $updatedOndtls = Yii::$app->db->createCommand('UPDATE memcompproddtls_tbl SET mcprd_memcompfctydtls_fk="'.$selfack.'" WHERE MemCompProdDtls_Pk="'.$prodid.'" ');
            $fatory_delete=$updatedOndtls->getRawSql();
            $updatedOndtls_result=$updatedOndtls->execute();
            if(!$updatedOndtls_result)
            {
                $result= ["msg" => "Something went wrong!!","status" => 2,'fatory_delete'=>$fatory_delete,'productModel'=>$productModel];
                return $result;
            }
        }

        // if(!$model_prod->save()){
        //     $result= ["msg" => "Something went wrong!!","status" => 2];
        // }else{
        //     $result= ["msg" => $msg,"status" => 1];
        // }
        $result= ["msg" => $mgs,"status" => 1,'productModel'=>$productModel];
        return $result;
    }



    public function actionRemovebranchfactoryser(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $serid=Security::decrypt($data['serid']);
        if($data['type']=='branch'){
            $selbrpk=(!empty($data['selec_pk']))?implode(',',$data['selec_pk']):null;
            $updatedOndtls = Yii::$app->db->createCommand('UPDATE memcompservicedtls_tbl SET mcsvd_memcompbranchdtlstemp_fk="'.$selbrpk.'" WHERE MemCompServDtls_Pk="'.$serid.'" ');
            $updatedOndtls_result=$updatedOndtls->execute();
            $mgs="Branch deleted successfully";
            if(!$updatedOndtls_result)
            {
                $result= ["msg" => "Something went wrong!!","status" => 2];
                return $result;
            }
        }

        $result= ["msg" => $mgs,"status" => 1];
        return $result;
    }

    public function actionUpdatecompanyenable(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $updatedStatus = Yii::$app->db->createCommand('UPDATE memcompadditonalinfo_tbl SET mcai_yesno="'.$data['status'].'" WHERE mcai_membercompanymst_fk ="'.$data['mem_com'].'" AND mcai_certtype= 1');
        $updatedResult=$updatedStatus->execute();
        $mgs="Status Updated successfully";
        $result= ["msg" => $mgs,"status" => 1];
        return $result;
    }
}
