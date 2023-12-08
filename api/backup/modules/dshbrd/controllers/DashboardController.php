<?php
namespace api\modules\dshbrd\controllers;

use api\modules\pm\controllers\NbfMasterController;
use yii\web\Response;
use common\components\Products;
use common\components\AfterLogin;
use Yii;
class DashboardController extends NbfMasterController
{
    
    public $modelClass = 'app\modules\nbf\models\MemcompprofcertfdtlsTbl';
    public $reg_id;
    public $companypk;
    public $userpk;
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
//        $reg_id = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
//        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
//        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
//        self::setSession($reg_id,$companypk,$userpk);
        header('Content-type: application/json; charset=utf-8');
        return parent::beforeAction($action);
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
     * This method is set company session values 
     * @param int reg_id in header, registerpk
     * @param int companypk in header, copanypk
     * @param int userpk in header, userpk
     */
    public function setSession($reg_id,$companypk,$userpk) {
        $this->reg_id = $reg_id;
        $this->companypk = $companypk;
        $this->userpk = $userpk;
    }
    
    /**
     * This method is get company details
     * @param int reg_id in header, registerpk
     * @return Response
     */
    public function actionGetcompanydetails(){
        $companydtls = \common\models\MemberregistrationmstTbl::getCompanyDetails($this->reg_id,  $this->companypk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $companydtls
        ]);
    }
    
    /**
     * This method is get products/service count
     * @param int companypk in header, companypk
     * @return Response
     */
    public function actionGetprodservcount(){
        $prodcount = \common\models\MemcompproddtlsTbl::getProductCount($this->companypk);
        $servcount = \common\models\MemcompservicedtlsTbl::getServiceCount($this->companypk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "product_count" => ($prodcount > 0)?(int)$prodcount:0,
            "service_count" => ($servcount > 0)?(int)$servcount:0,
            "total" => $prodcount + $servcount
        ]);
    }
    
    /**
     * This method is get certificate info
     * @param int reg_id in header, registerpk
     * @return Response
     */
    public function actionCertificateinfo() {
        $ceritficate_info = \common\models\MemberregistrationmstTbl::getCertifcateInfo($this->reg_id);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $ceritficate_info
        ]);
    }
    
    /**
     * This method is get workspace widget
     * @param int userpk in header, userpk
     * @return Response
     */
    public function actionWorkspacewidget(){
        $workspace_dtls = \common\models\WorkspacemstTblQuery::getWorkspaceWidgetDtls($this->userpk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => !empty($workspace_dtls)?$workspace_dtls:[]
        ]);
    }
    
    /**
     * This method is get profile completeness details
     * @param int companypk in header, companypk
     * @return Response
     */
    public function actionProfilecompleteness(){
        $profile_completeness = \common\models\MembercompanymstTbl::getProfileCompleteness($this->companypk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => !empty($profile_completeness)?$profile_completeness:[]
        ]);
    }
    
    /**
     * This method is get Enterprise Admin Widgets
     * @param int companypk in header, companypk
     * @return Response
     */
    public function actionEntadminwidget(){
        $entadminwidget = \app\modules\nbf\components\Dashboard::getEntAdmindtls($this->companypk,$this->reg_id);
        return $this->asJson($entadminwidget);
    }
    
    /**
     * This method is get notification widget
     * @param int companypk in header, companypk
     * @return Response
     */
    public function actionNotificationwidget(){
        $notifcation_widget = \common\models\NotifdtlsTblQuery::getNotificationList();
        return $this->asJson([
            "msg" =>"success",
            "status" => 1,
            "items" => !empty($notifcation_widget)?$notifcation_widget:[]
        ]);
    }
    
    public function actionPrimaryworkspacedtls() {
        $workspace_pk = $_GET['workspace_pk'];
        if(!empty($workspace_pk))
        {
            $primarywrkspcedtls = \common\models\WorkspacetrnsTblQuery::getPrimaryWorkspaceDtls(null,$workspace_pk,false);
        }
        else
        {
            $primarywrkspcedtls = \common\models\WorkspacetrnsTblQuery::getPrimaryWorkspaceDtls($this->userpk);
        }
        
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "isdefault" => $primarywrkspcedtls['isdefault'],
            "items" => !empty($primarywrkspcedtls)?$primarywrkspcedtls:[]
        ]);
    }
    
    /**
     * This method is get dept and user counts widget
     * @return Response
     */
    public function actionDeptusercount(){
        $deptCount = \common\models\DepartmentmstTbl::getDeptCount($this->companypk);
        $userCount = \common\models\UsermstTbl::getUserCount($this->reg_id);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "deptCount" => ($deptCount)? $deptCount :0,
            "userCount" => ($userCount)? $userCount :0
        ]);
    }
    
    /**
     * This method is get drive usage size by company
     * @return Response
     */
    public function actionDriveusagesize(){
        $driveSize = \common\models\MemcompfiledtlsTbl::getDriveUsageSizeTowardsCompany($this->companypk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "driveSize" => ($driveSize)? $driveSize :0,
        ]);
    }
    
    /**
     * This method is get supplier dashboard data
     */
    public function actionSupplierdashboard() {
        $dashboard = new \common\components\Dashboard();
        $data = $dashboard->getDashboardData();
        $recentviewdtls = \common\models\UsermonitorlogTbl::getRecentViewedDetails($data['contact']['pk']);
        
        $data['sezdData'] = \common\models\SezadecertitrackingTbl::findAll(['szct_membercompmst_fk' => $data['contact']['pk']]);
        
        return $this->asJson([
            "msg" => "success",
            "status" => 1,            
            "recent_viewed" => $recentviewdtls,
            "data" => $data,
        ]);
    }
    
    public function actionCertificationdata(){
        $dashboard = new \common\components\Dashboard();
        $data = $dashboard->getCertifiedData(); 
        return $this->asJson([
            "msg" => "success",
            "status" => 1,           
            "data" => $data,
        ]);  
    }

    public function actionAdvisorydata(){
        $dashboard = new \common\components\Dashboard();
        $data = $dashboard->getAdvisoryData(); 
        return $this->asJson([
            "msg" => "success",
            "status" => 1,           
            "data" => $data,
        ]);  
    }
    /**
     * This method is get supplier dashboard data
     */
    public function actionOperatordashboard() {
        $dashboard = new \common\components\Dashboard();
        $data = $dashboard->getDashboardData();
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "data" => $data,
        ]);
    }
    public function actionGetcompbasicdetails(){
       $request_body = file_get_contents('php://input');
       $data = json_decode($request_body, true);
       $compk = \common\components\Security::decrypt($data['compid']);
       $getcompanydet = \common\models\MembercompanymstTbl::findOne($compk);
       $userpk = $getcompanydet->mCMMemberRegMstFk->primaryuser->UserMst_Pk;
       $pdosts = \common\models\MembercompanymstTbl::getpdolccststus($compk);
       $isriyadata = \common\models\MemcomplcccerthdrTblQuery::getriyadadata($compk);
       $busdetcount = \common\models\MemcompsectordtlsTbl::getBusinessUnitCounts($compk);
       $bussrccnt = \common\models\MemcompbussrcdtlsTbl::find()->where(['mcbsd_membercompanymst_fk' => $compk,'mcbsd_isdeleted' => 2])->count();
       $bussrc = \common\models\MemcompbussrcdtlsTbl::getBusinesssrc($compk);
       $busdet = \common\models\MemcompsectordtlsTbl::getBusinessUnit($compk);
       $productcnt = Products::insight(1,$compk);
       $servicescnt = Products::insight(2,$compk);       
       $encrptcompk = \common\components\Security::encrypt($compk);
        $companyDetails['externalproflink'] =\Yii::$app->params['baseUrl']."externalprofile/";
        $companyDetails['externalprofname'] =$getcompanydet->mcm_externalproflink ;
       $companyDetails['companyName'] = $getcompanydet->MCM_CompanyName;
       $companyDetails['orgin'] = $getcompanydet->MCM_Origin;
       $companyDetails['companyLogo'] = \common\components\Drive::generateUrl($getcompanydet->mcm_complogo_memcompfiledtlsfk,$compk,$userpk); 
       $companyDetails['rating'] = (!empty($getcompanydet->mcm_supplierrating) && $getcompanydet->mcm_supplierrating != 0.0 ? $getcompanydet->mcm_supplierrating : '');
       $companyDetails['JSRSRegistrationNo'] = $getcompanydet->mcm_RegistrationNo;
       $companyDetails['countryPk'] = $getcompanydet->MCM_Source_CountryMst_Fk;
       $companyDetails['countryname'] = $getcompanydet->country->CyM_CountryName_en;
       $companyDetails['classification'] = $getcompanydet->classification->ClM_ClassificationType;
       $companyDetails['supplierCode'] = !empty($getcompanydet->MCM_SupplierCode) ? $getcompanydet->MCM_SupplierCode : "NIL";  
       $companyDetails['specialsts'] = $pdosts;       
       $companyDetails['businessUnit'] = $busdet;
       $companyDetails['businessUnitCount'] = $busdetcount;
       $companyDetails['businesrccnt'] = $bussrccnt;
       $companyDetails['bussrc'] = $bussrc;
       $companyDetails['incorpStyle'] = !empty($getcompanydet->mCMMemberRegMstFk->incorpStyle->ISM_IncorpStyleEntity) ? $getcompanydet->mCMMemberRegMstFk->incorpStyle->ISM_IncorpStyleEntity : "NIL"; 
       $totcnt = $productcnt[0]['total_pro_count'] + $servicescnt[0]['total_pro_count'];
       $totappcnt = $productcnt[0]['total_apro_count'] + $servicescnt[0]['total_apro_count'];
        if(!empty($totcnt)  && $totcnt != 0 && !empty($totappcnt) && $totappcnt != 0){
            $totalper = (($totappcnt/$totcnt) * 100);
            $totalpercent = round($totalper,2);
        }else{
            $totalpercent = 0;
        }       
       if(!empty($productcnt[0]['total_apro_count']) && $productcnt[0]['total_apro_count'] != 0&& !empty($productcnt[0]['total_pro_count']) && $productcnt[0]['total_pro_count'] != 0){
           $prdper = (($productcnt[0]['total_apro_count']/$productcnt[0]['total_pro_count']) * 100);
            $productpercent = round($prdper,2);      
       }else{
           $productpercent = 0;
       }        
       if(!empty($servicescnt[0]['total_apro_count']) && $servicescnt[0]['total_apro_count'] != 0 && !empty($servicescnt[0]['total_pro_count']) && $servicescnt[0]['total_pro_count'] != 0 ){
           $srcper = (($servicescnt[0]['total_apro_count']/$servicescnt[0]['total_pro_count']) * 100);
           $servicescount = round($srcper,2);    
       }else{
           $servicescount = 0;    
       }          
       $productsercount['productcount'] = (!empty($productcnt[0]['total_pro_count']) ? $productcnt[0]['total_pro_count'] : 0);
       $productsercount['approvedproductcount'] = (!empty($productcnt[0]['total_apro_count']) ? $productcnt[0]['total_apro_count'] : 0);
       $productsercount['productpercent'] = $productpercent;
       $productsercount['servicescount'] =  (!empty($servicescnt[0]['total_pro_count']) ? $servicescnt[0]['total_pro_count'] : 0);
       $productsercount['approvedservicescount'] = (!empty($servicescnt[0]['total_apro_count']) ? $servicescnt[0]['total_apro_count'] : 0);
       $productsercount['servicespercent'] = $servicescount;
       $productsercount['totalapprovedcount'] = $productcnt[0]['total_apro_count'] + $servicescnt[0]['total_apro_count'];
       $productsercount['totalcount'] = $totcnt;
       $productsercount['totalpercent'] = $totalpercent;       
       $addtionalcert = \common\models\MemcomplcccerthdrTblQuery::getadditionalcert($compk);
       $zonal = \common\models\MemcomplcccerthdrTblQuery::getzonal($compk);
       $prequal = \common\models\PrequalifieddtlsTblQuery::prequaldet($getcompanydet->MCM_MemberRegMst_Fk);
       $cmseng =  \api\modules\pms\models\CmscontracthdrTblQuery::getCmsEngagements($compk);
       $cmscount['received']= $cmseng['received'];
       $cmscount['responded']= $cmseng['responded'];
       $cmscount['bidsSubmitted']= $cmseng['bidsSubmitted'];
       $cmscount['awarded']= $cmseng['awarded'];
       $cmscount['awardcontvalue']= $cmseng['awardcontvalue'];
       $cumlativeArr=['comapnydetails'=> $companyDetails,'productsercount'=>$productsercount,'addtionalcert'=>$addtionalcert,'zonal'=>$zonal,'prequal'=>$prequal,'cmscount'=>$cmscount,'riyadadata'=>$isriyadata];
       return $this->asJson($cumlativeArr);   
   }
   /**
     * @SWG\Get(
     *     path="/pms/pms/getstatistics",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    function actionGetclsfichangeinfo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $compk = $data['compid'];

        $info = \common\models\MemcomppymttrackerTbl::find()
                 ->leftJoin("memcompinvoicedtls_tbl","memcompinvoicedtls_pk = mcpt_memcompinvoicedtls_fk")
                 ->where('mcpt_membercompmst_fk =:compk and mcpt_module = 2 and mcid_invoicestatus = "G"',[':compk'=>$compk])
                 ->orderBy(['memcompinvoicedtls_pk' => SORT_DESC])
                //  ->createCommand()->getRawSql();
                 ->asArray()->one();
               
        $text = "notshow";
        if(!empty($info)){
            $text = "show";
        }

        return $this->asJson($text); 
      
    }
    public function actionGetstatistics() {
       return \api\modules\pms\models\CmscontracthdrTblQuery::getCmsEngagements();
    }
    public function actionGcctenderintrodata(){
        $data= \common\models\gccsubstrnsdtlsTblQuery::getgccintrodata();
        return $this->asJson([
            "msg" => "success",
            "status" => 1,            
            "data" => $data,
        ]);
    }
    /**
     * @SWG\Get(
     *     path="/dshbrd/dashboard/getobgreportdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetobgreportdata() {
       return \api\modules\mst\models\AccessreportdtlsTblQuery::getOBGReport();
    }
    /**
     * @SWG\Post(
     *     path="/dshbrd/dashboard/accessreport",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataType", type="number"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAccessreport() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
       return \api\modules\mst\models\AccessreportdtlsTblQuery::accessReport($formdata['dataType']);
    }
    /**
     * @SWG\Post(
     *     path="/dshbrd/dashboard/getpdolccdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataType", type="number"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetpdolccdata() {
       return \api\modules\mst\models\MembercompanymstTblQuery::getPdoLccExport();
    }
    /**
     * @SWG\Post(
     *     path="/dshbrd/dashboard/getshareholdersdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataType", type="number"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetshareholdersdata() {
       return \api\modules\mst\models\MembercompanymstTblQuery::getShareholdersData();
    }
    public function actionGetpopupdata() {
        $data =  AfterLogin::getclassificationchangepopupdtls();



        return $this->asJson([
            "msg" => "success",
            "status" => 1,            
            "data" => $data,
        ]);
    
     
      }
    public function actionSpresponse() {
        echo '<pre>';print_r($_POST );exit;
    }
}
