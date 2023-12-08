<?php

namespace api\modules\pms\controllers;

use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use common\models\SupportcollateraldtlsTbl;
use common\components\Drive;
use Yii;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\pd\models\ProjectdtlsTbl;
use api\modules\pd\models\ProjsusdevelopgoalmstTblQuery;
use api\modules\mst\models\SectormstTbl;
use common\models\PartnermstTbl;
use common\models\ProjinvinfodtlsTbl;
use common\models\ProjectpartnerdtlsTbl;
use \common\models\UsermstTblQuery;
use api\modules\mst\models\SubsectormstTbl;
use api\modules\mst\models\LicensauthoritiesmstTbl;
use api\modules\pd\models\ProjlicpermauthTbl;
use common\components\Security;
use \common\models\UsermstTbl;
use api\modules\pd\models\ProjectdtlsTblQuery;
use api\modules\mst\models\SectormstTblQuery;
use api\modules\mst\models\LicensauthoritiesmstTblQuery;
use \common\models\PartnermstTblQuery;
use api\modules\mst\models\SubsectormstTblQuery;
use \common\models\ProjectpartnerdtlsTblQuery;
use \common\models\ProjectpartnertmpTblQuery;
use api\modules\pd\models\ProjlicpermauthTblQuery;
use api\modules\pd\models\ProjfaqdtlsTblQuery;
use api\modules\pd\models\ProjectteamTblQuery;
use api\modules\mst\models\CurrencymstTbl;
use api\modules\pd\models\ProjtechnicalTblQuery;
use api\modules\pd\models\ProjinvinfodtlsTblQuery;
use api\modules\pd\models\ProjinvmappingTblQuery;
use api\modules\pd\models\MemcompmplocationdtlsTblQuery;
use api\modules\pd\models\MemcompmplocationdtlsTbl;
use api\modules\mst\models\StatemstTblQuery;
use api\modules\pd\models\ProjdiligenceformTblQuery;
use api\modules\pd\models\ProjdiligenceformTbl;
use api\modules\pd\models\ProjdilsubdtlsTblQuery;
use \api\modules\pd\models\ProjecttmpTbl;
use \api\modules\pd\models\ProjecttmpTblQuery;
use api\modules\pd\models\ProjtechnicaltmpTbl;
use api\modules\pd\models\ProjtechnicaltmpTblQuery;
use api\modules\pd\models\ProjfaqtmpTblQuery;
use api\modules\pd\models\ProjinvinfotmpTblQuery;
use api\modules\pd\models\ProjmodeofimplentmstTblQuery;
use api\modules\pd\models\ProjschememstTblQuery;
use api\modules\pd\models\ProjjobtmpTblQuery;
use api\modules\pd\components\Projectdtls;
use api\modules\pms\components\Pmsproject;


class PmsprojectController extends ActiveController
{
   public $modelClass = 'api\modules\pd\models\ProjectdtlsTbl';
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
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


        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }
    
     /**
     * @SWG\Get(
     *     path="/pd/projectdtls/",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of project details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionIndex(){
        return ProjecttmpTblQuery::index($_REQUEST);
    }
         
    public function actionProjsuccessindex(){
        return \api\modules\pd\models\ProjownersuccessstoryTblQuery::index($_REQUEST);
    }
           
            
     /**
     * @SWG\Get(
     *     path="/pd/projectdtls/index",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of project details in Investor End.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionInvestorindex(){
        return ProjectdtlsTblQuery::investorindex($_REQUEST);
    }
    
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/index",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of project details in Investor End.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionProjectlisting(){
        return ProjectdtlsTblQuery::projectlisingnoc($_REQUEST);
    }

    
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/{id}",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of project details using index .",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(parameter="id", name="id", type="integer", in="path"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionView($id){
        return ProjectdtlsTblQuery::view($id);
    }
    
     public function actionProjectlicencelist(){
      
        $resultval= \api\modules\lic\models\LicinvappliedTblQuery::projectlicenselist($_REQUEST);
        $resulttotalcout= \api\modules\lic\models\LicinvappliedTblQuery::projectlicenselist();
        $arrayval['totalcount']=$resultval['total_count'];
        $arrayval['totalgridcount']=$resulttotalcout['items'][0]['projectpk'];
        foreach ($resultval['items'] as $key => $value) {
            $projetpk[]=$value['projectpk'];
        }
        $result= \api\modules\lic\models\LicinvappliedTblQuery::getlicenselist($_REQUEST,$projetpk);
        
         foreach ($result as $key => $value) {
             $arraylist["'{$value['projectdtls_pk']}'"]['prjd_projectid']=$value['prjd_projectid'];
             $arraylist["'{$value['projectdtls_pk']}'"]['prjd_referenceno']=$value['prjd_referenceno'];
             $arraylist["'{$value['projectdtls_pk']}'"]['prjd_projname']=$value['prjd_projname'];
             $arraylist["'{$value['projectdtls_pk']}'"]['projectdtls_pk']=$value['projectdtls_pk'];
             $arraylist["'{$value['projectdtls_pk']}'"][$key]=$value;
         }
//         echo "<pre>";print_r($arraylist);exit;
         $arrayval['data']=$arraylist;
         return $arrayval;
    }
     public function actionProjectlicencedtls(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\lic\models\LicinvappliedTblQuery::getlicdtls($data);
    }

    /**
    *   @SWG\Delete(
     *     path="/pd/projectdtls/{ids}",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Delete",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(parameter="ids", name="ids", type="integer", in="path"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDelete($id) {
        return ProjectdtlsTblQuery::delete($id);
    }

     /**
     * @SWG\Get(
     *     path="/pd/projectdtls/sectorlist",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of sector details.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSectorlist(){
        return SectormstTblQuery::activesector();

    }
    public function actionCurrcountry(){
        return ProjecttmpTblQuery::currcountry();

    }
    public function actionFunderlist(){
        return \api\modules\pd\models\ProjfundmstTblQuery::activefunder();

    }
    public function actionProjlist(){
        return ProjectdtlsTblQuery::projlist();
    }
    public function actionCompprojlist(){
        return ProjectdtlsTblQuery::compprojlist();
    }
    public function actionLiclist(){
        return ProjectdtlsTblQuery::liclist();
    }

     /**
     * @SWG\Get(
     *     path="/pd/projectdtls/orgtypelist",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of organitation details.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionOrgtypelist(){
        return PartnermstTblQuery::activepartner();
    }

    public function actionSdglist(){
        return ProjsusdevelopgoalmstTblQuery::list();
    }

     /**
     * @SWG\Put(
     *     path="/pd/projectdtls/getsubsector",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Sub Sector list",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="sectorPk", type="string", example=""),
     *              ),
     *          ),
     *     @SWG\Response(response = 200, description = "Response"),
     *     ),
     * )
     */
    public function actionGetsubsector(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $sectorPk = Security::sanitizeInput($data['sectorPk'],"number");
        return SubsectormstTblQuery::getsubsectorlist($sectorPk);
        
    }
    public function actionGetlicenselist(){
        return ProjinvinfotmpTblQuery::getlicenselist();
    }
    public function actionGetlicenseauthlist(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $licensePk = Security::sanitizeInput($data['licensePk'],"number");
        return ProjinvinfotmpTblQuery::getlicenseauthlist($licensePk);
        
    }

    
    public function actionAddprojectdtls(){ 
        
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::addproject($data);
    }

    
    public function actionGetopdtls() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectPk'];
        return ProjectpartnerdtlsTblQuery::opdtls($projectPk);
    } 
    public function actionGetfaqdtls() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectPk'];
        return ProjfaqdtlsTblQuery::faqdtls($projectPk);
    } 

  
    public function actionEditproject() { 
        $licensePk = $_REQUEST['projectId'];
        return ProjectdtlsTblQuery::authoritieslist($licensePk);
    }

  
    public function actionGetauthorities() { 
        return LicensauthoritiesmstTblQuery::activelicenseauthorities();

    }

   
    public function actionEditauthorities() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return LicensauthoritiesmstTblQuery::editauthoritiesprj($data);
    }

   
    public function actionViewprojecdtls() { 
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $stakeholdertype=\yii\db\ActiveRecord::getTokenData('reg_type', true);
        $projectdtls = new Projectdtls($data['projectpk']);
        if($stakeholdertype==11)
        $projectdata=$projectdtls->gettempprojectview();
        else
        $projectdata=$projectdtls->getmainprojectview();
        return $projectdata;
    }

    public function actionProjectauthdtls() { 
        $projecdtlsPk = $_REQUEST['projecdtlsId'];
        return ProjlicpermauthTblQuery::authorities($projecdtlsPk);
    }

    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/details",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get total and completed projects.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDetails() { 
        return ProjectdtlsTblQuery::projdetails();
    }

    
 /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojectinfo",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Info",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectInfoData", type="object",
     *                  @SWG\Property(property="prjd_summary", type="string"),
     *                  @SWG\Property(property="prjd_projtype", type="integer"),
     *                  @SWG\Property(property="prjd_projstage", type="integer"),
     *                  @SWG\Property(property="prjd_sectormst_fk", type="integer"),
     *                  @SWG\Property(property="prjd_subsectormst_fk", type="integer"),
     *                  @SWG\Property(property="prjd_proptype", type="integer"),
     *                  @SWG\Property(property="prjd_natureofprop", type="string"),
     *                  @SWG\Property(property="opdtls", type="string",example="{array}"),
     *                  @SWG\Property(property="organisName", type="string"),
     *                  @SWG\Property(property="organisType", type="integer"),
     *                  @SWG\Property(property="projrec", type="float"),
     *                  @SWG\Property(property="projreq", type="float"),
     *                  @SWG\Property(property="prjd_reqcur", type="integer"),
     *                  @SWG\Property(property="prjd_reccur", type="integer"),
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojectinfo() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);  
        return ProjecttmpTblQuery::addProjectInfo($data);
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addprohighlights",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add New Project Highlights.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="highlightData", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="prjd_projdesc", type="string", example=""),
     *                      @SWG\Property(property="prjd_benefeat", type="string", example=""),
     *                      @SWG\Property(property="piid_investorbenefits", type="string", example=""),
     *                      @SWG\Property(property="piid_invtoinvestors", type="string", example=""),
     *                      @SWG\Property(property="proAccreditation", type="array",
     *                          @SWG\items(
     *                              @SWG\Property(property="accreditation_pk", type="integer", example=""),
     *                              @SWG\Property(property="acr_accreditationname", type="string", example=""),
     *                              @SWG\Property(property="acr_governingbody", type="string", example=""),
     *                              @SWG\Property(property="acr_regno", type="string", example=""),
     *                              @SWG\Property(property="acr_regdate", type="string", example=""),
     *                          )
     *                      ),getcerti
     *                      @SWG\Property(property="proAchievement", type="array",
     *                          @SWG\items(
     *                              @SWG\Property(property="achievement_pk", type="integer", example=""),
     *                              @SWG\Property(property="achv_title", type="string", example=""),
     *                              @SWG\Property(property="achv_upload", type="string", example=""),
     *                              @SWG\Property(property="achv_description", type="string", example=""),
     *                              @SWG\Property(property="achv_year", type="string", example=""),
     *                          )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddprohighlights() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addProHighlights($data);
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addinvestmentdtls",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add Investment Details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="investmentDtls", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="piid_opentoinvest", type="integer", example=""),
     *                      @SWG\Property(property="piid_invparticipation", type="integer", example=""),
     *                      @SWG\Property(property="piid_invprefsrc", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddinvestmentdtls() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjinvinfotmpTblQuery::addInvestmentDtls($data);
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addinviteinvestors",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add Invite Investor.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="inviteinvestor", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="inviteInvArray", type="array",
     *                          @SWG\items(
     *                              @SWG\Property(property="projinvmapping_pk", type="integer", example=""),
     *                              @SWG\Property(property="pim_name", type="string", example=""),
     *                              @SWG\Property(property="pim_emailid", type="string", example=""),
     *                          )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddinviteinvestors() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjinvmappingtmpTblQuery::addInviteInvestors($data);
    }
    public function actionGetinvlistedit() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjinvmappingtmpTblQuery::getinvlistedit($data);
    }
    public function actionGetfaqlistedit() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjfaqtmpTblQuery::getfaqlistedit($data);
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addinvestmentguide",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add Investment Guide.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="investmentGuideData", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="prjd_projinvproced", type="string", example=""),
     *                      @SWG\Property(property="plpa_licensauthoritiesmst_fk", type="integer", example=""),
     *                      @SWG\Property(property="projlicpermauth_pk", type="integer", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddinvestmentguide() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addInvestmentGuide($data);
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addinvestorciteria",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add Investor Citeria.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="investorCiteriaData", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="piid_targetinvestors", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddinvestorciteria() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjinvinfotmpTblQuery::addInvestorCiteria($data);
    }
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/getlicpermitauth",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Get License Permit Authorities List.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetlicpermitauth() {
        return LicensauthoritiesmstTblQuery::activelicenseauthorities();
    }
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/getcounterlist",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Get Country List without Libya.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcounterlist() {
        return \api\modules\mst\models\CountryMasterQuery::getCountryWithoutLibya();
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addfinancial",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add Financial Details.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="financialData", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="prjd_financindic", type="string", example=""),
     *                      @SWG\Property(property="prjd_roi", type="string", example=""),
     *                      @SWG\Property(property="prjd_riskfactors", type="string", example=""),
     *                      @SWG\Property(property="prjd_riskdisclosure", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddfinancial() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addFinancial($data);
    }
    public function actionAddtenderdtl() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addtenderdtl($data);
    }
    /**
     * @SWG\Post(
     *     path="/pd/projectdtls/addprocontactinfo",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to Add Project Contact Info.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "body", name = "body", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="contactInfoData", type="object",
     *                      @SWG\Property(property="projectdtls_pk", type="string", example=""),
     *                      @SWG\Property(property="prjd_contactinfo", type="string", example=""),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddprocontactinfo() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjectdtlsTblQuery::addContactInfo($data);
    }
    // Achievement File Upload 
    public function actionUploadachievement() { 
        $fileData = $_FILES;    
        $file_extension = strtolower(pathinfo($fileData['file']['name'],PATHINFO_EXTENSION)); 
        $extensions = ['jpg', 'png', 'jpeg']; 
        if (in_array($file_extension, $extensions)) {
            if($fileData['file']['size'] < 4500000){           
                $upload_dir = getcwd() . '/../backend/assets/images/achievement/';
                $fileName= date('YmdHis').'.'.$file_extension;
                $file = $upload_dir.basename($fileName);
                if (Common::chkMime($file_extension,$fileData['file']["tmp_name"])) {
                    if (move_uploaded_file($fileData['file']["tmp_name"], $file)) {                     
                        return [
                            'status' => 200,
                            'statusmsg' => 'success',
                            'flag'=>'S',
                            'msg'=>'File add successfully!',
                            'returndata' => $fileName,                
                        ];
                    }
                }  else {
                    return [
                        'status' => 200,
                        'statusmsg' => 'File Error',
                        'flag'=>'E',
                        'msg'=>'Something went wrong!',
                        'returndata' => $fileData['file']['name'],               
                    ];
                }
            }else {        
                return [
                    'status' => 200,
                    'statusmsg' => 'Error',
                    'flag'=>'E',
                    'msg'=>'File Size too Large',
                    'returndata' => $fileData['file']['name'],               
                ];
            }
        }  else {
            return [
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'W',
                'msg'=>'File Format',
                'returndata' => $fileData['file']['name'],                
            ];
        }
    }  
     /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojectteam",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Team",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectteam", type="object",
     *                  @SWG\Property(property="id", type="integer", example="10"),
     *                  @SWG\Property(property="role", type="string", example="sample"),
     *                  @SWG\Property(property="bio", type="string", example="sample"),
     *                  @SWG\Property(property="user", type="integer", example="10")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojectteam(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectteamTblQuery::addprojectteam($data);
    }
    public function actionCurrencylist(){
        return CurrencymstTbl::activecurrency();
    }


    public function actionEditprojectteam(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectteamTblQuery::editprojectteam($data);
    }

        /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojectcard",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Card",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectCardData", type="object",
     *                  @SWG\Property(property="projectdtls_pk", type="integer", example="10"),
     *                  @SWG\Property(property="prjd_referenceno", type="string", example="Proj1212"),
     *                  @SWG\Property(property="prjd_projname", type="string", example="ProjSample")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojectcard() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addProjectCard($data);
    }
    public function actionGetuserbymem(){
        return UsermstTblQuery::getuserbymem();
    }
 /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojecttechinfo",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Technical Info",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="technicalinfo", type="object",
     *                  @SWG\Property(property="projtecinfo", type="string", example="sample"),
     *                  @SWG\Property(property="projtecapp", type="string", example="sample")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojecttechinfo(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjtechnicaltmpTblQuery::addprojtecinfo($data);
    }
 /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojectsocio",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Socio Economics",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projsocio", type="object",
     *                  @SWG\Property(property="projsocemp", type="string", example="sample"),
     *                  @SWG\Property(property="projsocin", type="string", example="sample"),
     *                  @SWG\Property(property="projsocto", type="string", example="sample"),
     *                  @SWG\Property(property="projsocinc", type="string", example="sample"),
     *                  @SWG\Property(property="projsocen", type="string", example="sample")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojectsocio(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjtechnicaltmpTblQuery::addprojectsocio($data);
  }
 /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addbusinesscase",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Business",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="businesscase", type="object",
     *                  @SWG\Property(property="overview", type="string", example="sample"),
     *                  @SWG\Property(property="needs", type="string", example="sample"),
     *                  @SWG\Property(property="trends", type="string", example="sample"),
     *                  @SWG\Property(property="refs", type="string", example="sample")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddbusinesscase(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjtechnicaltmpTblQuery::addbusinesscase($data);
    }
//    public function actionAddfinancial(){
//      $request_body = file_get_contents('php://input');
//      $data =	json_decode($request_body, true); 
//      return ProjectdtlsTblQuery::addFinancial($data);
//    }
 /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addtimeline",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Timeline",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="timeline", type="object",
     *                  @SWG\Property(property="inception", type="date"),
     *                  @SWG\Property(property="start", type="date"),
     *                  @SWG\Property(property="end", type="date")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddtimeline(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjecttmpTblQuery::addtimeline($data);
    }
/**
      * @SWG\Post(
     *     path="/pd/projectdtls/addlocation",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Location",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectloc", type="object",
     *                  @SWG\Property(property="proj_gov", type="integer"),
     *                  @SWG\Property(property="proj_cty", type="integer"),
     *                  @SWG\Property(property="proj_zon", type="integer"),
     *                  @SWG\Property(property="sez", type="integer"),
     *                  @SWG\Property(property="proj_line", type="string")
     *                  
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
      public function actionAddlocationinfo(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjecttmpTblQuery::addlocation2($data);
    }
    public function actionAddlocation(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjecttmpTblQuery::addlocation($data);
    }

    /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojectwebinar",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Webinar",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectwebinar", type="object",
     *                  @SWG\Property(property="linkedin", type="string"),
     *                  @SWG\Property(property="facebook", type="string"),
     *                  @SWG\Property(property="twitter", type="string"),
     *                  @SWG\Property(property="instagram", type="string"),
     *                  @SWG\Property(property="website", type="string"),
     *                  @SWG\Property(property="seotag", type="string")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojectwebinar(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjectdtlsTblQuery::addprojectwebinar($data);
      
    }
   /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addprojectfaq",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project FAQ",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectfaq", type="object",
     *                  @SWG\Property(property="frequentArray", type="object",
     *                  @SWG\Property(property="ques", type="string"),
     *                  @SWG\Property(property="ans", type="string")
     *                  )
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddprojectfaq(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjfaqtmpTblQuery::addprojectfaq($data);
    }
    
    public function actionGetbydepartmentuser(){
       
     $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
    
      return ProjectdtlsTblQuery::getdepartuser($data);
    }
     /**
      * @SWG\Post(
     *     path="/pd/projectdtls/submitproject",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Submittion",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *     @SWG\Property(property="projectpk", type="object", type="integer", example=""),),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionSubmitproject(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
    
      return ProjecttmpTblQuery::submitproject($data);
    }
    public function actionFinalsubmit(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
      
        return ProjectdtlsTblQuery::finalsubmit($data);
      }
    public function actionGetstate(){
        return StatemstTblQuery::statelist();
      }
    public function actionGetcountry(){
        return \api\modules\mst\models\CountrymstTblQuery::countrylist();
      }
      
    public function actionGetachiveacred(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjecttmpTblQuery::getachiveacred($data);
    } 
     /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addpartner",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Add Project Partner",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="addpartner", type="object",
     *                  @SWG\Property(property="consulnme", type="integer"),
     *                  @SWG\Property(property="oraname", type="string")
     *              ),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddpartner() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectpartnertmpTblQuery::addpartner($data);
    } 
    public function actionUpdatepartner() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectpartnertmpTblQuery::updatepartner($data);
    } 
     /**
      * @SWG\Post(
     *     path="/pd/projectdtls/mappartner",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Map Project Partner",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="mappartner", type="object"),
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionMappartner() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectpk'];
        return ProjectpartnertmpTblQuery::mappartner($data,$projectPk);
    } 
 /**
      * @SWG\Post(
     *     path="/pd/projectdtls/partnerlist",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Partner List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionPartnerlist() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectpk'];
        return ProjectpartnertmpTblQuery::partnerlist($projectPk);
    }
         /**
      * @SWG\Post(
     *     path="/pd/projectdtls/partnerviewlist",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Partner View List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
      public function actionPartnerviewlist() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectpk'];
        return ProjectpartnertmpTblQuery::partnerviewlist($projectPk);
    }
      public function actionLicbyproj() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projpk'];
        return ProjectdtlsTblQuery::licbyproj($projectPk);
    }
    /**
      * @SWG\Post(
     *     path="/pd/projectdtls/deletemap",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Remove Project Partner",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="deletemap", type="object" ),
     *                 @SWG\Property(property="projectpk", type="object"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     * */

    public function actionDeletemap() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectpk'];
        $key = $data['deletemap'];
        return ProjectpartnertmpTblQuery::deletemap($key,$projectPk);
    }
    public function actionDeletemaplic() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $projectPk = $data['projectpk'];
        $key = $data['deletemap'];
        return ProjectdtlsTblQuery::deletemaplic($key,$projectPk);
    }

    public function actionPartnerbyid(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $pk = $data['partnerpk'];
        return ProjectpartnertmpTblQuery::partnerbyid($pk);
    }
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/getacred",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Project Get Accreditation",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetacred(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::getcompacred($data);
    }
    public function actionGetcerti(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::getcompacerti($data);
    }
    public function actionGetawar(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::getcompaawar($data);
    }
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/getachive",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Project Getachivement",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetachive(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::getcompachive($data);
    }
     /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addaccreations",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Add Project Addaccreations",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="accreationsinfo", type="object",
     *                  @SWG\Property(property="acceriationname", type="string"),
     *                  @SWG\Property(property="governingbody", type="integer"),
     *                  @SWG\Property(property="createon", type="date")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddaccreations(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addaccretation($data);
    }
    public function actionAddcertificates(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addcertificates($data);
    }
    public function actionAddawards(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addawards($data);
    }
    /**
      * @SWG\Post(
     *     path="/pd/projectdtls/addachivemens",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Add Project Addachivemens",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="achivementsinfo", type="object",
     *                  @SWG\Property(property="achievementname", type="string"),
     *                  @SWG\Property(property="achivedescp", type="string"),
     *                  @SWG\Property(property="acievementdate", type="date")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
    public function actionAddachivemens(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addachivements($data);
    }
    public function actionAddtechdocs(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addtechdocs($data);
    }
    public function actionAddlic(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addlic($data);
    }
    public function actionAddfinancialdocs(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjectdtlsTblQuery::addfinancialdocs($data);
    }
    public function actionAddtenderdocs(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjecttmpTblQuery::addtenderdocs($data);
    }
    public function actionAddpromotordtls(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjecttmpTblQuery::addprojpromotor($data);
    }
    public function actionAddinvestordtls(){
      $request_body = file_get_contents('php://input'); 
      $data =	json_decode($request_body, true); 
       return ProjecttmpTblQuery::addinvestors($data);
    }
    public function actionGetinv(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjecttmpTblQuery::getprojinvestors($data);
    }
    public function actionPromotsref(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjecttmpTblQuery::promotsref($_REQUEST);
    }
    public function actionAddprojectwebpresence(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjecttmpTblQuery::addprojectwebpresence($data);
    }
    public function actionSociallist(){
        return \common\models\SocialmediamstTblQuery::getSocialMediaList();

    }
 
    public function actionAddofflocation(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return MemcompmplocationdtlsTblQuery::addofflocation($data);
    }
    public function actionMapofflocation(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return ProjecttmpTblQuery::mapofflocation($data);
    }
    public function actionGetoffloc(){
        return MemcompmplocationdtlsTblQuery::getoffloc();
    }
    public function actionGetviewoffloc(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return MemcompmplocationdtlsTblQuery::getviewoffloc($data);
    }
    public function actionGetprojectbyid(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
         return ProjecttmpTblQuery::getprojectbyid($data);
    }
    public function actionGetofflocbyid(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
         return MemcompmplocationdtlsTblQuery::getofflocbyid($data);
    }
    public function actionUpdateoffloc(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
         return MemcompmplocationdtlsTblQuery::updateoffloc($data);
    }
    public function actionShortlistproject() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjshortlistTblQuery::shortlistproj($data);
    }
    public function actionCancelshortlistproject() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjshortlistTblQuery::cancelshortlistproj($data);
    }
    public function actionInvprojstatus(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjectdtlsTblQuery::invprojstatus($data);
    }
    public function actionGetteamlist(){
        return UsermstTblQuery::getuserdepbymem();
    }
    public function actionGetteamview(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return UsermstTblQuery::getuserdepbymemview($data);
    }
    public function actionGetcontactview(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return UsermstTblQuery::getuserdepbymeminfo($data);
    }
    public function actionEoisubmit(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjeoisubdtlsTblQuery::eoisubmit($data);  
        }
    public function actionWithdraweoi(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjeoisubdtlsTblQuery::withdraweoi($data);  
        }
    public function actionInvest(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::invest($data);  
        }
    public function actionReinvest(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::reinvest($data);  
        }
        
    public function actionShortlistindex(){
        return ProjectdtlsTblQuery::shortlistindex($_REQUEST);
    }
    public function actionDeclareinvestmentindex(){
        return ProjectdtlsTblQuery::declareinvestmentindex($_REQUEST);
    }
    public function actionEoiindex(){
        return ProjectdtlsTblQuery::eoiindex($_REQUEST);
    }
    public function actionEoicount(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjectdtlsTblQuery::counteoi($data);
    }
    public function actionMapteam(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjecttmpTblQuery::mapteam($data);
    }
    public function actionMapcontact(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::mapcontact($data);
      }
    public function actionDeleteteam(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::deleteteam($data);
      }
    public function actionDeletecontact(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::deletecontact($data);
      }
      public function actionGetselectedteam(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::getselectedteam($data);
      }
      public function actionAddmember(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::addteammember($data);  
      }
      public function actionAddcontactmember(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::addcontmember($data);  
      }

      public function actionGetselectedcontact(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        return ProjecttmpTblQuery::getselectedcontact($data);
      }
    public function actionInvestorbyid(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $pk = $data['investorpk'];
        return \api\modules\pd\models\ProjinvmappingtmpTblQuery::investorbyid($pk);
    }
    public function actionUpdateinvestor() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjinvmappingtmpTblQuery::updateinvestor($data);
    } 
    public function actionValidateeoi(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return \api\modules\pd\models\ProjeoisubdtlsTblQuery::validateeoi($data);  
        }
    public function actionRegisterlicense() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::registerlicense($data);
    }
    public function actionDuplic() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::duplic($data);
    }
    public function actionAudittrial() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::audittrial($data);
    }
    public function actionDecinvaudittrial() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::decinvaudittrial($data);
    }
    public function actionDiligenceview(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $prid = Security::decrypt($data['projPk']);
        $id = Security::sanitizeInput($prid,"number");
        return ProjectdtlsTblQuery::diligenceview($id);
    }
    public function actionDiligencepreview(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = Security::sanitizeInput($data['projPk'],"number");
        return ProjectdtlsTblQuery::diligencepreview($id);
    }
    public function actionAddsstory(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = $data['value'];
        return \api\modules\pd\models\ProjownersuccessstoryTblQuery::addsstory($id);
    }
    public function actionGetprojval(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = Security::sanitizeInput($data['projPk'],"number");
        return ProjectdtlsTblQuery::getprojval($id);
    }
    public function actionEditssval(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = Security::sanitizeInput($data['projPk'],"number");
        return ProjectdtlsTblQuery::editssval($id);
    }
    public function actionActivsslog(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $id = Security::sanitizeInput($data['pk'],"number");
        return ProjectdtlsTblQuery::activsslog($id);
    }
    public function actionGetvalidationdata(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $prid = $data['projPk'];
        $id = Security::sanitizeInput($prid,"number");
        return ProjectdtlsTblQuery::getvalidationdata($id);
    }
    public function actionFollowpo(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::followpo($data);
    }
    public function actionSubmitdiligence(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjdiligenceformTblQuery::submitdigigence($data);
    }
    public function actionInvdilsubmit(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return ProjectdtlsTblQuery::invdilsubmit($data);
    }
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/getdiligence",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get diligence list.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetdiligence(){
        return ProjdilsubdtlsTblQuery::getdiligence($_REQUEST);
    }
    /**
     * @SWG\Get(
     *     path="/pd/projectdtls/getdiligencecount",
     *     tags={"Project"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get diligence count.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetdiligencecount(){
        return ProjdilsubdtlsTblQuery::diligencecount($_GET['pk']);
    }
    public function actionGetdiligencepk()
    {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjdilsubdtlsTblQuery::getdigigence($data);
    }
    public function actionValidatediligence(){
        
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjdilsubdtlsTblQuery::validateupdate($data['diligencedtls']);
    }
    public function actionAckinvest(){
        
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjdilsubdtlsTblQuery::ackinvest($data['ackdtls']);
    }
    public function actionGetvalidatedtls(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjdilsubdtlsTblQuery::getvalidatedtls($data);
    }
    public function actionEditoverallproject(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      return ProjecttmpTblQuery::Editoverallproject($data);
    }
    public function actionProjbene(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      return ProjecttmpTblQuery::projbene($data);
    }
    public function actionViewproject(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      return ProjecttmpTblQuery::viewproject($data);
    }
    
    public function actionGetschemedetails(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      return ProjschememstTblQuery::getprrojscheme($data);
    }
    
    public function actionGetmodedetails(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      return ProjmodeofimplentmstTblQuery::getmodeofdetails($data);
    }
    public function actionAddfinancialdetails() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addprojectFinancial($data);
    }
    public function actionAddprojectjob(){
        $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
      return ProjjobtmpTblQuery::addprojectjob($data);
    }

    public function actionInvdetails(){
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::invdetails($_REQUEST);
    }

    public function actionGetinvdetailsbyid(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::getinvdetailsbyid($pk);
    }

    public function actionInvdethistory(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return \api\modules\pd\models\ProjinvestmenthstyTblQuery::history($pk);
    }
    public function actionLicform(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::licform($data['form']);
    }
    public function actionInvestedindex(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::investedindex($_REQUEST);
    }
    public function actionGetinvhist(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return \api\modules\pd\models\ProjinvestmenthstyTblQuery::getinvhist($pk);
    }
    public function actionGetinvlist(){
        return \api\modules\mst\models\MembercompanymstTblQuery::getcompanyinv();
    }
    public function actionInvdeclare(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::invDeclare($data);
    }
    public function actionInvredeclare(){
        $request_body	=	file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return \api\modules\pd\models\ProjinvestmentdtlsTblQuery::invRedeclare($data);
    }
    
    public function actionGetlicenseinfo(){
        return \api\modules\mst\models\LicensinginfoTblQuery::getlicenselist();
    }
    
    public function actionAddlicense(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true); 
       return \api\modules\mst\models\LicensinginfoTblQuery::addliense($data);
    }


    public function actionAddemployment() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjtechnicaltmpTblQuery::addemployment($data);
    }

    public function actionGetrequirments(){
        return \api\modules\mst\models\ProjrequirementmstTblQuery::getrequiments();
    }
    
    public function actionInvsubon(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return \api\modules\pd\models\ProjinvestmenthstyTblQuery::invsubon($pk);
    }


    public function actionFetchSupportCollateral(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $scDetails = ProjectdtlsTblQuery::fetchSc($resParam);
        $data['photos'] = $data['broucher'] = $data['advertisement'] = $data['videos'] = $data['presentation'] = [];

        foreach ($scDetails as $key => $scDetail) {
            //echo'<pre>';print_r($scDetail);exit;
            if($scDetail['scDocType'] == 6){
                $data['broucher'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk,1),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 7){
                $data['photos'][] = [
                    'pk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 9){
                $data['advertisement'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk,1),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 10){
                /*$data['presentation'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scVideo'=>$scDetail['scVideo'],
                    'scCreatedBy'=>$scDetail['scCreatedBy']
                ];*/

                $data['presentation'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scDoc'=>$scDetail['scDoc'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'filePath' => Drive::generateUrl($scDetail['scDoc'],$scDetail['compMstPk'],$userPk,1),
                    'fileType' => $scDetail['fileType'],
                    'fileName' => $scDetail['orgFileName']
                ];
            }elseif($scDetail['scDocType'] == 5){
                $videoType = $this->actionVideotype($scDetail['scVideo']);
                if($videoType == 'youtube'){
                    $link = explode('/', $scDetail['scVideo']);
                    $link = end($link);
                    $link = explode('?', $link);

                    $link2 = explode('/', $scDetail['scVideo']);
                    $link2 = end($link2);
                    $link2 = explode('v=', $link2);

                    if(isset($link2[1]) && !empty($link2[1])){
                        $linkKey = $link2[1];
                    }else{
                        $linkKey = $link[0];
                    }
                    

                    $youtubeDetail = $this->actionYoutubedetail($scDetail['scVideo']);
                    $youtubeDetails = $this->actionYoutubedetails($linkKey);
                    $ytVmDet = $this->actionYtformation($youtubeDetails, $youtubeDetail);
                }elseif($videoType == 'vimeo'){
                    $vimeoDetails = $this->actionVimeodetails($scDetail['scVideo']);
                    $ytVmDet = $this->actionVmformation($vimeoDetails);
                }else{
                    $ytVmDet['title'] = $ytVmDet['description'] = $ytVmDet['from'] = $ytVmDet['thumbnail'] = '';
                }


                $data['videos'][] = [
                    'scPk'=>$scDetail['scPk'],
                    'scMcmPk'=>$scDetail['scMcmPk'],
                    'scDocType'=>$scDetail['scDocType'],
                    'scVideo'=>$scDetail['scVideo'],
                    'scCreatedBy'=>$scDetail['scCreatedBy'],
                    'title' => $ytVmDet['title'], 
                    'description' => $ytVmDet['description'], 
                    'from' => $ytVmDet['from'], 
                    'thumbnail' => $ytVmDet['thumbnail'], 
                ];
            }
        }
        
        $data['supportCollateralNoteText'] = Yii::$app->params['supportCollateralNoteText'];
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => '100',
        ]);
    }

    public function actionVideotype($url) {
        
        if ((strpos($url, 'youtube') > 0) || (strpos($url, 'youtu.be') > 0)) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

    public function actionSaveSc(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $ret = 1;
        if(isset($resParam->docType) && !empty($resParam->docType) && ((isset($resParam->uploadDoc) && !empty($resParam->uploadDoc)) || (isset($resParam->uploadVideo) && !empty($resParam->uploadVideo)) )){

            $save['docType'] = Security::sanitizeInput($resParam->docType,'number');
            $uploadDoc = $resParam->uploadDoc;
            $save['projpk'] = Security::decrypt($resParam->projpk);
            if($save['docType'] > 0){
                if($save['docType'] == 5){
                    $videoType = $this->actionVideotype($resParam->uploadVideo);

                    if(isset($resParam->fact_fk) && !empty($resParam->fact_fk)){
                        $save['fact_fk'] = Security::decrypt($resParam->fact_fk);
                    }

                    if(isset($resParam->product_fk) && !empty($resParam->product_fk)) {
                        $save['product_fk'] = Security::decrypt($resParam->product_fk);
                    }

                    if(isset($resParam->shared_fk_type) && !empty($resParam->shared_fk_type)) {
                        $save['shared_fk_type'] = $resParam->shared_fk_type;
                    }

                    if($videoType != 'unknown'){
                        $save['uploadVideo'] = $resParam->uploadVideo;
                        $save['uploadDoc'] = '';
                        if($save['shared_fk_type'] != 3 && $save['shared_fk_type'] != 4) {
                            $afterSave = ProjectdtlsTblQuery::saveSupportCollateral($save);
                        } else {
                            $afterSave = ProjectdtlsTblQuery::savePackageVideo($save);
                        }
                        
                    }else{
                        $ret = 0;
                    }
                }else{
                    foreach ($uploadDoc as $key => $upDoc) {
                        $save['uploadDoc'] = $upDoc;
                        $save['uploadVideo'] = '';
                        // return $resParam->fact_fk;
                        if(isset($resParam->fact_fk) && !empty($resParam->fact_fk)){
                            $save['fact_fk'] = Security::decrypt($resParam->fact_fk);
                        }
                        $afterSave = ProjectdtlsTblQuery::saveSupportCollateral($save);
                    }
                }

                if($ret == 1){
                    if($afterSave == 1){
                        $message = $this->baseErrorMessage('success');
                        $status = 100;
                    }elseif($afterSave == 2){
                        $message = $this->baseErrorMessage('vaAvailable');
                        $status = 104;
                        $title="Alert";
                    }elseif($afterSave == 3){
                        $message = $this->baseErrorMessage('greaterCount');
                        $status = 104;
                        $title="Alert";
                    }else{
                        $message = $this->baseErrorMessage('dbError');
                        $status = 103;
                        $title="Alert";
                    }
                }else{
                    $message = $this->baseErrorMessage('notMatch');
                    $status = 105;
                        $title="Alert";
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
                        $title="Alert";
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
                        $title="Alert";
        }

    	return $this->asJson([
            'title'=>$title,
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionYoutubedetails($url){
        //echo'<pre>';print_r($url);exit;
        // $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";
        $youtube = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$url."&key=AIzaSyBqdoF_XgI9XGQI6ZxhayD4BtUxtxjVVMI";
        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }
    public function actionYoutubedetail($url){
        $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";
        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }
    public function actionVimeodetails($url=''){
        $vimeo = "https://vimeo.com/api/oembed.json?url=". $url ."&width=480&height=360";

        $curl = curl_init($vimeo);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }

    public function actionYtformation($youtubeDetails, $youtubeDetail){
        $ytDetails['title'] = $youtubeDetails['items'][0]['snippet']['title'];
        $ytDetails['description'] = $youtubeDetails['items'][0]['snippet']['description'];
        $ytDetails['from'] = isset($youtubeDetail['provider_url'])?$youtubeDetail['provider_url']:'https://www.youtube.com';
        $ytDetails['thumbnail'] = $youtubeDetails['items'][0]['snippet']['thumbnails']['high']['url'];
        return $ytDetails;
    }

    public function actionVmformation($vimeoDetails){
        $vmDetails['title'] = $vimeoDetails['title'];
        $vmDetails['description'] = $vimeoDetails['description'];
        $vmDetails['from'] = $vimeoDetails['provider_url'];
        $vmDetails['thumbnail'] = $vimeoDetails['thumbnail_url'];
        return $vmDetails;
    }

    /*Error message creation*/
    function baseErrorMessage($type){
        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Success';
                break;
            case 'notAvailable':
                $resMessage = 'Data is not available towards this';
                break;
            case 'missingFields':
                $resMessage = 'Mandatory Fields are missing';
                break;
            case 'dbError':
                $resMessage = 'Database error occurs';
                break;
            case 'smAlreadyAvailable':
                $resMessage = 'This data is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
            case 'notMatch':
                $resMessage = 'Trying to add invalid URL';
                break;
            case 'vaAvailable':
                $resMessage = 'This video URL is already available';
                break;
            case 'greaterCount':
                $resMessage = 'Maximum upload count is reached';
                break;
        }
        return $resMessage;
    }
    
    public function actionFetchVideo(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $scDetails = ProjectdtlsTblQuery::fetchvid($resParam);
        $datavalue=explode(',', $scDetails->piit_invinvestorsvideo);
        $data['videos']=[];
        foreach (array_filter($datavalue) as $key => $scDetail) {
                $videoType = $this->actionVideotype($scDetail);
                if($videoType == 'youtube'){
                    $link = explode('/', $scDetail['scVideo']);
                    $link = end($link);
                    $link = explode('?', $link);

                    $link2 = explode('/', $scDetail['scVideo']);
                    $link2 = end($link2);
                    $link2 = explode('v=', $link2);

                    if(isset($link2[1]) && !empty($link2[1])){
                        $linkKey = $link2[1];
                    }else{
                        $linkKey = $link[0];
                    }
                    

                    $youtubeDetail = $this->actionYoutubedetail($scDetail);
                    $youtubeDetails = $this->actionYoutubedetails($linkKey);
                    $ytVmDet = $this->actionYtformation($youtubeDetails, $youtubeDetail);
                }elseif($videoType == 'vimeo'){
                    $vimeoDetails = $this->actionVimeodetails($scDetail);
                    $ytVmDet = $this->actionVmformation($vimeoDetails);
                }else{
                    $ytVmDet['title'] = $ytVmDet['description'] = $ytVmDet['from'] = $ytVmDet['thumbnail'] = '';
                }


                $data['videos'][] = [
                    'scPk'=>$scDetail,
                    'scMcmPk'=>$scDetail,
                    'docType'=>5,
                    'scVideo'=>$scDetail,
                    'scCreatedBy'=>$scDetail,
                    'title' => $ytVmDet['title'], 
                    'description' => $ytVmDet['description'], 
                    'from' => $ytVmDet['from'], 
                    'thumbnail' => $ytVmDet['thumbnail'], 
                ];
        }
        
        $data['supportCollateralNoteText'] = Yii::$app->params['supportCollateralNoteText'];
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => '100',
        ]);
    }

    public function actionSaveVideo(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $ret = 1;
        if(isset($resParam->docType) && !empty($resParam->docType) && (isset($resParam->uploadVideo) && !empty($resParam->uploadVideo)) ){

            $save['docType'] = Security::sanitizeInput($resParam->docType,'number');
            $uploadDoc = $resParam->uploadDoc;
            $save['projpk'] = Security::decrypt($resParam->projpk);
            
            if($save['docType'] > 0){
                if($save['docType'] == 5){
                    $videoType = $this->actionVideotype($resParam->uploadVideo);
                    
                    if($videoType != 'unknown'){
                        $save['uploadVideo'] = $resParam->uploadVideo;
                        $save['uploadDoc'] = '';
                            $afterSave = ProjectdtlsTblQuery::saveVideo($save);
                    }else{
                        $ret = 0;
                    }
                }
                if($ret == 1){
                    if($afterSave == 1){
                        $message = $this->baseErrorMessage('success');
                        $status = 100;
                    }elseif($afterSave == 2){
                        $message = $this->baseErrorMessage('vaAvailable');
                        $status = 104;
                        $title="Alert";
                    }elseif($afterSave == 3){
                        $message = $this->baseErrorMessage('greaterCount');
                        $status = 104;
                        $title="Alert";
                    }else{
                        $message = $this->baseErrorMessage('dbError');
                        $status = 103;
                    }
                }else{
                    $message = $this->baseErrorMessage('notMatch');
                    $status = 105;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

    	return $this->asJson([
            'title' => $title,
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionDeleteVideo(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->scPk) && !empty($resParam->scPk)){
                $afterDelete = ProjectdtlsTblQuery::deletevideo($resParam);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }else{
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
                }
                else{
                    $message = $this->baseErrorMessage('missingFields');
                    $status = 101;
                }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    public function actionGetprojtempdetailsbyid(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return \api\modules\pd\models\ProjecttmpTblQuery::getprojtempbyid($pk);
    }
    public function actionGetprofiledata(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::getprofiledata($data);
    }
    public function actionAddreqdlic(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);    
        return ProjecttmpTblQuery::addreqdlic($data);
    }

    public function actionProjectownershiplist(){
        return \api\modules\pd\models\ProjownershipmstTblQuery::projownerlist();
    }

    public function actionLilist(){
      $request_body = file_get_contents('php://input');
      $data =	json_decode($request_body, true);
      return \api\modules\lic\models\LicinvappliedTblQuery::lilist($data);
    }
    public function actionGetinvhistory(){
    $pk_dec = Security::decrypt($_REQUEST['pk']);
    $pk=Security::sanitizeInput($pk_dec,'number');
    return \api\modules\pd\models\ProjecthstyTblQuery::projhistory($pk);
    }


    public function actionFetchVideoss(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $scDetails = \api\modules\pd\models\ProjownersuccessstoryTblQuery::fetchvid($resParam);
        $scDetail=$scDetails->poss_youtubelink;
        $data['videos']=[];
                $videoType = $this->actionVideotype($scDetail);
                if($videoType == 'youtube'){
                    $link = explode('/', $scDetail['scVideo']);
                    $link = end($link);
                    $link = explode('?', $link);

                    $link2 = explode('/', $scDetail['scVideo']);
                    $link2 = end($link2);
                    $link2 = explode('v=', $link2);

                    if(isset($link2[1]) && !empty($link2[1])){
                        $linkKey = $link2[1];
                    }else{
                        $linkKey = $link[0];
                    }

                    $youtubeDetail = $this->actionYoutubedetail($scDetail);
                    $youtubeDetails = $this->actionYoutubedetails($linkKey);
                    $ytVmDet = $this->actionYtformation($youtubeDetails, $youtubeDetail);
                }elseif($videoType == 'vimeo'){
                    $vimeoDetails = $this->actionVimeodetails($scDetail);
                    $ytVmDet = $this->actionVmformation($vimeoDetails);
                }else{
                    $ytVmDet['title'] = $ytVmDet['description'] = $ytVmDet['from'] = $ytVmDet['thumbnail'] = '';
                }

                $data['videos'][] = [
                    'scPk'=>$scDetail,
                    'scMcmPk'=>$scDetail,
                    'docType'=>5,
                    'scVideo'=>$scDetail,
                    'scCreatedBy'=>$scDetail,
                    'title' => $ytVmDet['title'], 
                    'description' => $ytVmDet['description'], 
                    'from' => $ytVmDet['from'], 
                    'thumbnail' => $ytVmDet['thumbnail'], 
                ];
        $data['supportCollateralNoteText'] = Yii::$app->params['supportCollateralNoteText'];
        return $this->asJson([
            'data' => $data,
            'msg' => 'success',
            'status' => '100',
        ]);
    }

    public function actionSaveVideoss(){
    	$postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $ret = 1;
            $save['docType'] = Security::sanitizeInput($resParam->docType,'number');
            $uploadDoc = $resParam->uploadDoc;
            $save['projpk'] = Security::decrypt($resParam->projpk);
            $save['pk'] = Security::decrypt($resParam->pk);
            
            if($save['docType'] > 0){
                if($save['docType'] == 5){
                    $videoType = $this->actionVideotype($resParam->uploadVideo);
                    
                    if($videoType != 'unknown'){
                        $save['uploadVideo'] = $resParam->uploadVideo;
                        $save['uploadDoc'] = '';
                            $afterSave = \api\modules\pd\models\ProjownersuccessstoryTblQuery::saveVideo($save);
                    }else{
                        $ret = 0;
                    }
                }
                if($ret == 1){
                    if($afterSave == 1){
                        $message = $this->baseErrorMessage('success');
                        $status = 100;
                    }elseif($afterSave == 2){
                        $message = $this->baseErrorMessage('vaAvailable');
                        $status = 104;
                        $title="Alert";
                    }elseif($afterSave == 3){
                        $message = $this->baseErrorMessage('greaterCount');
                        $status = 104;
                        $title="Alert";
                    }else{
                        $message = $this->baseErrorMessage('dbError');
                        $status = 103;
                    }
                }else{
                    $message = $this->baseErrorMessage('notMatch');
                    $status = 105;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }

    	return $this->asJson([
            'title' => $title,
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /**
      * @SWG\Post(
     *     path="/pms/pmsproject/contractlist",
     *     tags={"Project"},
     *     produces={"application/json"},
     *     summary="Project Contract List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="projectpk", type="object", type="integer", example=""),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
      */
      public function actionContractlist() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $data = Pmsproject::getContracts($data);
        return json_encode($data);
    }

    public function actionIcvprogressprojectdata() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = Pmsproject::getContractsForIcvProgress($data);
        return json_encode($data);   
    }
}
