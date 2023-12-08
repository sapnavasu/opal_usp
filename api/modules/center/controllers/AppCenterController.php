<?php

namespace api\modules\center\controllers;

use Yii;

use api\modules\mst\controllers\MasterController;
use app\models\ApplicationdtlstmpTbl;
use app\models\StaffevaluationtmpTbl;use \app\models\AuditscheduleTbl;
use \api\components\AppCenter;
use \api\components\Security;
use yii\data\ActiveDataProvider;
use api\components\Common;
use api\modules\center\components\SiteAudit;
use app\models\ApplicationdtlshstyTbl;
use app\models\AppapprovalhdrTbl;
use app\models\AppoffercoursetmpTbl;
use app\models\AppoffercoursemainTbl;
use app\models\ApplicationdtlsmainTbl;
use app\models\AppstaffinfotmpTbl;
use app\models\CoursecategorymstTbl;
use app\models\ProjapprovalworkflowdtlsTbl;
use app\models\OpalmemberregmstTbl;
use app\models\OpalInvoiceTbl;
use app\models\OpalusermstTbl;
use app\models\RascategorymstTbl;
use Da\QrCode\QrCode;
use Mpdf\Tag\Select;
use Sitemaped\Sitemap;
use app\models\AppstaffscheddtlsTbl;

class AppCenterController extends MasterController
{
    public $modelClass = 'app\models\ApplicationdtlstmpTbl';

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
    
     public function actionGetRegDtls()
    {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $response = [];
        
        $data = \app\models\OpalmemberregmstTbl::getAppRegDtls($request);
        $web_url = Yii::$app->params['website_url'];
        if($data)
        {
            $response = [
                'status' => 1,
                'data' => $data,
                'msg' => 'Success',
                'web_url' => $web_url,
            ];
        }
        else
        {
           $response = [
                'status' => 2,
                'data' => '',
                'msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }
    

    public function actionGetworkexp()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getworkexp();

        return $data;
    }

    public function actionGeteducationqulification()
    {
        $data = \app\models\ApplicationdtlstmpTbl::geteducationqulification();

        return $data;
    }
    
    public function actionAprefid()
    {
        $data = \app\models\ApplicationdtlstmpTbl::aprefid();

        return $data;
    }

    public function actionValidbtnshoworhide()
    {
        $data = \app\models\ApplicationdtlstmpTbl::validbtnshoworhide();

        return $data;    }

    public function actionFinanacevalidbtn()
    {
        $data = \app\models\ApplicationdtlstmpTbl::finanacevalidbtn();

        return $data;    }

    public function actionOverallapprovdec()
    {
        $data = \app\models\ApplicationdtlstmpTbl::overallapprovdec();

        return $data;    }
    
    public function actionShowapprovdec()
    {
        $data = \app\models\ApplicationdtlstmpTbl::showapprovdec();

        return $data;    }    

    public function actionStaffapprodecproce()
    {
        $data = \app\models\ApplicationdtlstmpTbl::staffapprodecproce();

        return $data;    }
    
    public function actionGetstaffassesorloca()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getstaffassesorloca();

        return $data;    }

    public function actionGetstaffavailabledate()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getstaffavailabledate();

        return $data;    }

    public function actionGetvaluestaffview()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getvaluestaffview();

        return $data;    }
    

    public function actionStafftatuschanged()
    {
        $data = \app\models\ApplicationdtlstmpTbl::staffstatuschange();

        return $data;    }

    public function actionDocstatuschanged()
    {
        $data = \app\models\ApplicationdtlstmpTbl::Documentstatuschange();

        return $data;    }

    public function actionInterstatuschanged()
    {
        $data = \app\models\ApplicationdtlstmpTbl::Internationalstatuschange();

        return $data;
    }

    public function actionDesktopreviewstatuschanged()
    {
        $data = \app\models\ApplicationdtlstmpTbl::Desktopstatuschange();

        return $data;
    }


     public function actionGetstaffttab()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getstafftab();

        return $data; 
    }

    public function actionGetstaffttabdata()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getstafftabdata();

        return $data; 
    }
    public function actionGetdocumenttab()
    {
        $data = \app\models\ApplicationdtlstmpTbl::getdocumenttab();

        return $data; 
    }


    //fetch the international tab

    public function actionGetinternational()
    {
       $data = \app\models\ApplicationdtlstmpTbl::getinternationaltab();

       return $data;       


    }


    //fetch the standarad@customize Approval Data
    public function actionStandaradcustomize()
    {

       $data = \app\models\ApplicationdtlstmpTbl::getallstandardcoursesapproval();

       return $data;       

    }


    //fetch the one  standarad@customize Approval Data

    public function actionGetonerecordstandaradcustomize()
    {

        $data = \app\models\ApplicationdtlstmpTbl::getonestandardcoursesapproval();

        return $data;     
        
    }

    public function actionCheckallapprovedornot()
    {

        $data = \app\models\ApplicationdtlstmpTbl::checkallapprovedornot();

        return $data;     
        
    }

   // desktop course  approved or declined


    //save main center company creation
    public function actionSavecompdtls(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $requestdata = $request['comdtls'];
        $requestdata['acdt_opalmemberregmst_fk'] = $regPk;
        $requestdata['acdt_opalusermst_fk'] = $userPk;
        $requestdata['appdt_projectmst_fk'] = \Yii::$app->params['project_array'][1];
        $requestdata['acdt_createdby'] = $userPk;
        
        $response = [];
        
        $data = AppCenter::saveAppCenter($requestdata);
        
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main center institution creation
    public function actionSaveinsdtls(){

        
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['insdtls'];
        $requestdata['appiit_opalmemberregmst_fk'] = $regPk;
        $requestdata['appiit_createdby'] = $userPk;
     
        $response = [];
        $data = AppCenter::saveInsCenter($requestdata);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main center International creation
    public function actionSaveintrdtls(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['insdtls'];
        $requestdata['appintit_createdby'] = $userPk;
        
        $response = [];
        $data = AppCenter::saveInsRecCenter($requestdata);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main center Operator Contractor creation
    public function actionSaveoprcontr(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['oprcontr'];
        $requestdata['appoprct_opalmemberregmst_fk'] = $regPk;
        $requestdata['appoprct_createdby'] = $userPk;
        
        $response = [];
        $data = AppCenter::saveOprContrCenter($requestdata);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main center course creation
    public function actionSavecourse(){

        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['course'];
        $requestdata['appoct_createdby'] = $userPk;
        if($requestdata['slider'] == 1){
            $requestdata['slider']=1;
        }else{
            $requestdata['slider']=2;
        }
        
        $response = [];
      
        $data = AppCenter::saveCourse($requestdata);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main staff creation
    public function actionSavestaff(){

        $memRegPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['staff'];
        $requestdata['sir_createdby'] = $userPk;
        $requestdata['sir_opalmemberregmst_fk'] = $memRegPk;
        
        $response = [];
        $data = AppCenter::saveStaff($requestdata);

        if($data){
            $this->cvGeneration($data);
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main staff edu creation
    public function actionSavestaffedu(){

        $memRegPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['staff'];
        $requestdata['sir_createdby'] = $userPk;
        $requestdata['sir_opalmemberregmst_fk'] = $memRegPk;
        
        $response = [];
        $data = AppCenter::saveStaffedu($requestdata);

        if($data){
            if(!empty($requestdata['stfrepo'])){
                $this->cvGeneration($requestdata['stfrepo']);
            }
            
            if(!empty($requestdata['sacd_staffinforepo_fk'])){
                $this->cvGeneration($requestdata['sacd_staffinforepo_fk']);
            }
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    //save main workexp creation
    public function actionWorkexp(){

        $memRegPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['workexp'];
        $requestdata['sexp_createdby'] = $userPk;
        
        $response = [];
        $data = AppCenter::saveWorkexp($requestdata);

        if($data){
            if(!empty($requestdata['sexp_staffinforepo_fk'])){
                $this->cvGeneration($requestdata['sexp_staffinforepo_fk']);
            }

            if(!empty($requestdata['stafrep_id'])){
                $this->cvGeneration($requestdata['stafrep_id']);
            }
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionStaffcourmoher(){

        $memRegPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        //echo '<pre>';print_r($request);exit;
        $requestdata = $request['courmoher'];
        $requestdata['createdby'] = $userPk;
        
        $response = [];
        $data = AppCenter::saveStaffcourmoher($requestdata);

        if($data){
            $this->cvGeneration($data);
            
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }
    
    public function actionGetinterrecdtls(){
        //echo '<pre>';print_r("sfgfgdfgdg");exit;
        $response = [];
        $data = \app\models\AppintrecogtmpTbl::getInterRecDtls($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetoprdtls(){
        
        $response = [];
        $data = \app\models\AppoprcontracttmpTbl::getOprDtls($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetcourdtls(){
        
        $response = [];
        $data = \app\models\AppoffercoursetmpTbl::getCourDtls($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetcomdtls(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $regPk = $request['regPk'];
        $projecttype = $request['projecttype'];
        $data = \app\models\ApplicationdtlstmpTbl::find()
                    ->leftjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
                    ->where(['appdt_opalmemberregmst_fk' => $regPk, 'appdt_projectmst_fk'=>$projecttype])
                    ->orderBy(['applicationdtlstmp_pk'=>SORT_ASC])
                    ->asArray()->one();
        //  print_r($data);exit; 
        $srcDirectory=Yii::$app->params['srcDirectory'];
        $appStatus=Yii::$app->params['app_status'];
        foreach($appStatus as $key => $status){

            if($key == 18){
                $appStatus[$key] = 'Yet to Pay';

            }
            if($key == 10 || $key == 11 || $key == 12|| $key == 13|| $key == 14|| $key == 15|| $key == 16 ||  $key == 20 ){
                $appStatus[$key] = 'Approval pending';
            }
        }
       
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success','baseUrl' =>  $srcDirectory, 'appStatus' =>  $appStatus,
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }
    

    public function actionGetappdtls(){
     
        $response = [];
        $request_body = file_get_contents('php://input');
      
        $formdata = json_decode($request_body, true);
      
        $apptempPk = Security::decrypt($formdata['apptempPk']);

        $apptempPk = Security::sanitizeInput($apptempPk, "number");

        $data = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:apptempPk", [':apptempPk'=>$apptempPk])
        ->asArray()
        ->one();
        
      
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetallappdtls(){
        $response = [];
        $data = \app\models\ApplicationdtlstmpTbl::getAppDtls();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetinsinfrdtls(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $appDtlsPk = $request['appDtlsPk'];
        
        $data = \app\models\AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->one();
        //echo '<pre>';print_r($data);exit;
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetintrtr(){

        $intnatrecogmst = new ActiveDataProvider([
            'query' => \app\models\IntnatrecogmstTbl::find()
                ->select(['intnatrecogmst_pk','irm_intlrecogname_en','irm_intlrecogname_ar'])
                ->where(['irm_status'=>1]),
            'pagination'=>['pageSize' => false],
        ]);
        
       $data = $intnatrecogmst->getModels();
    return $data;
}



public function actionGetintenational(){
    $resParam = $_GET;
    $pageSize = isset($resParam['size']) && ($resParam['size'] > 5)?$resParam['size']:5;
    $page = isset($resParam['page']) && ($resParam['page'] > 0)?$resParam['page']:0;
    $appid = isset($resParam['appid']) && ($resParam['appid'] > 0)?$resParam['appid']:0;
    $keyword = (isset($resParam['keyword']) && !empty($resParam['keyword']))?$resParam['keyword']:'';
    $sort = (isset($resParam['sort']) && !empty($resParam['sort']))?$resParam['sort']:'';
    $order = (isset($resParam['order']) && !empty($resParam['order']))?$resParam['order']:'';
    $data['data']  = \app\models\AppintrecogtmpTbl::getInterRecDtlsFlt( $appid, $pageSize , $page, $keyword,$resParam['gridsearchValues'],$sort,$order);
    $message = 'Success';
    $status = 100;

    return $this->asJson([
        'data' => $data,
        'msg' => $message,
        'status' => $status,
    ]);
}

public function actionGetinsinfrdtl(){
    $response = [];
    $request_body	= file_get_contents('php://input');
    $request = json_decode($request_body, true);
    $appDtlsPk =Security::decrypt($request['appDtlsPk']);
    $projectpk =Security::decrypt($request['projectpk']);
   
    $data = \app\models\AppinstinfotmpTbl::find()
   ->select(['*','DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','DATE_FORMAT(appiit_appdecon,"%d-%m-%Y") AS appiit_appdecon','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry','DATE_FORMAT(appdt_certificateexpiry,"%m-%d-%Y") AS appdt_certificateexpiry_new'])
    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appinstinfotmp_tbl.appiit_appdecby')
    ->leftJoin('opalmemberregmst_tbl memreg','memreg.opalmemberregmst_pk = appinstinfotmp_tbl.appiit_opalmemberregmst_fk')
    ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
    ->leftJoin('opalstatemst_tbl state','state.opalstatemst_pk = appinstinfotmp_tbl.appiit_statemst_fk')
    ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appinstinfotmp_tbl.appiit_citymst_fk')
    ->Where(['appiit_applicationdtlstmp_fk'=>$appDtlsPk])
   // ->andWhere(['appdt_projectmst_fk'=>$projectpk])
    ->asArray()
    ->one();
   
     $histmodel       =   \app\models\AppinstinfohstyTbl::find()->where("appiih_AppInstInfoTmp_FK =:pk", [':pk' => $data['appinstinfotmp_pk']])->orderBy(["AppInstInfoHsty_PK" => SORT_DESC])->limit(2)->asArray()->all();
     $auditschmodel   =   \app\models\AppauditschedtmpTbl::find()
     ->select(['DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date'])
     ->leftJoin('auditscheddtls_tbl sch','sch.auditscheddtls_pk = appauditschedtmp_tbl.appasdt_auditscheddtls_fk')
     ->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $appDtlsPk])
     ->orderBy(["appauditschedtmp_pk" => SORT_DESC])->asArray()->one();
   
    if($data){
        
        $response = ['status' => 1,'data' => $data,'hisstatus' =>$histmodel[1]['appiih_Status'],'scheduledate' => $auditschmodel['asd_date'],'msg' => 'Success',
        ];
    } else{
       $response = ['status' => 2,'data' => '','msg' => 'Failure',
        ]; 

    }
    return $this->asJson($response);
}

public function actionGetoperator(){
      $formatedData = \app\models\AppoprcontracttmpTbl::getOperatorDtlsFlt();
     return $this->asJson([
            'data' => $formatedData,
            'msg' => 'Success',
            'status' => 100,
        ]);
}

public function actionGetcourse(){
    $formatedData = \app\models\AppoffercoursetmpTbl::getCourseDtlsFlt();
   return $this->asJson([
          'data' => $formatedData,
          'msg' => 'Success',
          'status' => 100,
      ]);
}

public function actionFetchFavouriteResult(){
    $postVar = Yii::$app->request->getRawBody();
    $params = json_decode($postVar);
    $resParam = $params->postParams;
    $data = [];
  

    $courseid = Security::decrypt($resParam->courseid);
    $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
    $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;

    
    $data['favResult'] = \app\models\AppoffercourseunittmpTbl::fetchFavResult($courseid, $pageSize , $page);

    $message = 'Success';
    $status = 100;

    return $this->asJson([
        'data' => $data,
        'msg' => $message,
        'status' => $status,
    ]);
}

public function actionFetchFavouriteTemp(){
    $postVar = Yii::$app->request->getRawBody();
    $params = json_decode($postVar);
    $resParam = $params->postParams;
    $data = [];
  

    $courseid = Security::decrypt($resParam->courseid);
    $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
    $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;

   
    $data['favResult'] = \app\models\AppoffercoursetmpTbl::fetchFavResult($courseid, $pageSize , $page);

    $message = 'Success';
    $status = 100;

    return $this->asJson([
        'data' => $data,
        'msg' => $message,
        'status' => $status,
    ]);
}

public function actionFetchFavouriteStaffacd(){
    $postVar = Yii::$app->request->getRawBody();
    $params = json_decode($postVar);
    $resParam = $params->postParams;
    $data = [];
  

    $courseid = Security::decrypt($resParam->courseid);
    $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
    $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;

    
    $data['favResult'] = \app\models\StaffacademicsTbl::fetchFavResult($courseid, $pageSize , $page);


    $message = 'Success';
    $status = 100;

    return $this->asJson([
        'data' => $data,
        'msg' => $message,
        'status' => $status,
    ]);
}

public function actionFetchFavouriteStaffdata(){
    $postVar = Yii::$app->request->getRawBody();
    $params = json_decode($postVar);
    $resParam = $params->postParams;
    $data = [];
  

    $courseid = Security::decrypt($resParam->courseid);
    $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
    $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;

    
    $data['favResult'] = \app\models\StaffinforepoTbl::fetchFavResult($courseid, $pageSize , $page);


    $message = 'Success';
    $status = 100;

    return $this->asJson([
        'data' => $data,
        'msg' => $message,
        'status' => $status,
    ]);
}

public function actionFetchFavouriteStaffwrk(){
    $postVar = Yii::$app->request->getRawBody();
    $params = json_decode($postVar);
    $resParam = $params->postParams;
    $data = [];
  

    $courseid = Security::decrypt($resParam->courseid);
    $pageSize = isset($resParam->pageSize) && ($resParam->pageSize > 5)?$resParam->pageSize:5;
    $page = isset($resParam->page) && ($resParam->page > 0)?$resParam->page:0;

    
    $data['favResult'] = \app\models\StaffworkexpTbl::fetchFavResult($courseid, $pageSize , $page);


    $message = 'Success';
    $status = 100;

    return $this->asJson([
        'data' => $data,
        'msg' => $message,
        'status' => $status,
    ]);
}

public function actionUpdateinstitute(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $username =  \yii\db\ActiveRecord::getTokenData('oum_firstname', true); 
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );

    $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    
 
    if($interId){
        $model = \app\models\AppinstinfotmpTbl::find()->where("appiit_applicationdtlstmp_fk =:pk", [':pk' => $interId])->one();
        if($model){
                $model->appiit_status =  (int)$formdata['formdata']['select_valitate'];
                $model->appiit_appdeccomment = strval($formdata['formdata']['comments']);
                $model->appiit_appdecon = date("Y-m-d H:i:s");
                $model->appiit_appdecby = $userPk;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'username' => $username,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }


return $result;

}

public function actionUpdatecourse(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);

    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'Please click on the Check Box and proceed further',
    );

    foreach($formdata['formdata']['appdtlstmp_id'] as $interId){
  
    if($interId){
        $model = \app\models\AppoffercoursetmpTbl::find()->where("appoffercoursetmp_pk =:pk", [':pk' => $interId])->one();
       
        if($model){
                $model->appoct_status =  (int)$formdata['formdata']['select_valitate'];
                $model->appoct_appdeccomment = strval($formdata['formdata']['comments']);
                $model->appoct_appdecon = date("Y-m-d H:i:s");
                $model->appoct_appdecby = $userPk;
            if ($model->save() === TRUE) {
               $courseid = $model['appoffercoursetmp_pk'];
               $courseunitmodel = \app\models\AppoffercourseunittmpTbl::find()->where("appocut_appoffercoursetmp_fk =:pk", [':pk' => $courseid])->asArray()
               ->all();
             
               foreach ($courseunitmodel as $course){
                   $coursepk = $course['appoffercourseunittmp_pk'];
                   $coursearary = \app\models\AppoffercourseunittmpTbl::find()->where("appoffercourseunittmp_pk =:pk", [':pk' => $coursepk])->one();
                
                 
                $coursearary->appocut_status =  (int)$formdata['formdata']['select_valitate'];
                $coursearary->appocut_appdeccomment = strval($formdata['formdata']['comments']);
                $coursearary->appocut_appdecon = date("Y-m-d H:i:s");
                $coursearary->appocut_appdecby = $userPk;
                $coursearary->save();
               }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }
}


return $result;

}

    public function actionGetautocompletedata(){
        $term=trim($_GET['term']);
        $autoReturn = \app\models\ReferencemstTbl::find()
                    ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
                    ->where(['like', 'rm_name_en', $term])
                    ->orWhere(['like', 'rm_name_ar', $term])
                    ->andWhere(['rm_mastertype'=>2,'srm_status'=>1])
                    ->asArray()
                    ->all();

        return $this->asJson($autoReturn);
    }

    public function actionGetreference(){
        if($_GET['term'] == '3'){
            $autoReturn = \app\models\ReferencemstTbl::find()
                    ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
                    ->Where(['rm_mastertype'=>$_GET['term'],'srm_status'=>1])
                    ->orderBy('referencemst_pk asc')
                    ->asArray()
                    ->all();
        }else{
            $autoReturn = \app\models\ReferencemstTbl::find()
                    ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
                    ->Where(['rm_mastertype'=>$_GET['term'],'srm_status'=>1])
                    //->orderBy('referencemst_pk asc')
                    ->asArray()
                    ->all();
        }
        
        // if($_GET['term'] == '3'){
        //     $autoReturn->orderBy('rm_name_en asc');
        // }

        return $this->asJson($autoReturn);
    }

    public function actionGetcat(){
        $autoReturn = \app\models\CoursecategorymstTbl::find()
                    ->select(['coursecategorymst_pk','ccm_catname_en','ccm_catname_ar'])
                    ->Where(['ccm_coursecategorymst_pk'=>NULL,'ccm_status'=>1])
                    ->asArray()
                    ->all();

        return $this->asJson($autoReturn);
    }

    public function actionGetsubcat(){
        $autoReturn = \app\models\CoursecategorymstTbl::find()
                    ->select(['coursecategorymst_pk','ccm_catname_en','ccm_catname_ar'])
                    ->Where(['ccm_coursecategorymst_pk'=>$_GET['term'],'ccm_status'=>1])
                    ->asArray()
                    ->all();
        
        return $this->asJson($autoReturn);
    }

    public function actionGetrec(){
        
        $autoReturn = \app\models\AppintrecogtmpTbl::find()
                    ->select(['appintrecogtmp_pk','irm_intlrecogname_en','irm_intlrecogname_ar'])
                    ->leftJoin('intnatrecogmst_tbl rec','rec.intnatrecogmst_pk = appintrecogtmp_tbl.appintit_intnatrecogmst_fk')
                    ->Where(['appintit_applicationdtlstmp_fk'=>$_GET['term']])
                    ->asArray()
                    ->all();

        return $this->asJson($autoReturn);
    }

    public function actionGetcountry(){

        // $countryReturn = \app\models\OpalcountrymstTbl::find()
        //             ->select(['opalcountrymst_pk','ocym_countryname_en','ocym_countryname_ar'])
        //             ->Where(['ocym_status'=>1])
        //             ->asArray()
        //             ->all();
        $countryReturn =   \Yii::$app->db->createCommand(" select opalcountrymst_pk,ocym_countryname_en,ocym_countryname_ar from  opalcountrymst_tbl where ocym_status = 1 order by ocym_countryname_en='Oman' desc, ocym_countryname_en;")
        ->queryAll();

        return $this->asJson($countryReturn);

    }

    public function actionGetstate(){
        $stateReturn = \app\models\OpalstatemstTbl::find()
                    ->select(['opalstatemst_pk','osm_statename_en','osm_statename_ar'])
                    ->Where(['osm_opalcountrymst_fk'=>$_GET['term'],'osm_status'=>1])
                    ->orderBy(['osm_statename_en' => SORT_ASC])
                    ->asArray()
                    ->all();
        return $this->asJson($stateReturn);
    }


    public function actionGetcity(){
        $ctyReturn = \app\models\OpalcitymstTbl::find()
                    ->select(['opalcitymst_pk','ocim_cityname_en','ocim_cityname_ar'])
                    ->Where(['ocim_opalstatemst_fk'=>$_GET['state'],'ocim_opalcountrymst_Fk'=>$_GET['country'],'ocim_status'=>1])
                    ->asArray()
                    ->all();
        return $this->asJson($ctyReturn);
    }

    public function actionGetrole(){
        $ctyReturn = \app\models\RolemstTbl::find()
                    ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                    ->Where(['rm_projectmst_fk'=>1,'rm_status'=>1])
                    ->asArray()
                    ->all();
        return $this->asJson($ctyReturn);
    }

    public function actionGetoffercour(){
        $ctyReturn = \app\models\AppoffercoursetmpTbl::find()
                    ->select(['appoffercoursetmp_pk','appoct_coursename_en','appoct_coursename_ar'])
                    ->Where(['appoct_applicationdtlstmp_fk'=>$_GET['param']])
                    ->asArray()
                    ->all();
        
        return $this->asJson($ctyReturn);
    }

public function actionGetcompany(){
    $response = [];
    $request_body	= file_get_contents('php://input');

    $request = json_decode($request_body, true);
  
    $appDtlsPk = $request['apptempPk'];
    $interId = Security::decrypt($appDtlsPk);
    $projectpk= $request['projectpk'];

      $data= \app\models\AppcompanydtlstmpTbl::find()
    ->select(['*','DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','DATE_FORMAT(acdt_appdecon,"%d-%m-%Y") AS acdt_appdecon','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry'])
    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appcompanydtlstmp_tbl.acdt_appdecby')
    ->leftJoin('opalmemberregmst_tbl memreg','memreg.opalmemberregmst_pk = appcompanydtlstmp_tbl.acdt_opalmemberregmst_fk')
    ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = appcompanydtlstmp_tbl.acdt_applicationdtlstmp_fk')
    ->leftJoin('opalmoherigrademst_tbl grade','grade.opalmoherigradingmst_pk = appcompanydtlstmp_tbl.acdt_gmmoherigrading')
    ->leftJoin('appinstinfotmp_tbl ins','ins.appiit_applicationdtlstmp_fk = appcompanydtlstmp_tbl.acdt_applicationdtlstmp_fk')
    ->leftJoin('opalstatemst_tbl state','state.opalstatemst_pk = appcompanydtlstmp_tbl.acdt_statemst_fk')
    ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appcompanydtlstmp_tbl.acdt_citymst_fk')
    ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = omrm_cractivity')
    ->Where(['acdt_applicationdtlstmp_fk'=>$interId])
  //  ->andWhere(['appiit_officetype'=>'1'])
    ->andWhere(['appdt_projectmst_fk'=> $projectpk])
    ->asArray()
    ->one();
 
    $appuser = \app\models\OpalusermstTbl::find()
    ->select(['*'])
    ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = opalusermst_tbl.oum_opaldesignationmst_fk')
    ->Where(['oum_opalmemberregmst_fk'=>$data['acdt_opalmemberregmst_fk']])
    ->andWhere(['oum_isfocalpoint'=>1])
->andWhere(['oum_status'=>'A'])
    ->andWhere(['oum_projectmst_fk'=>$projectpk])
    ->orderBy(["opalusermst_pk" => SORT_DESC])    ->asArray()
    ->one();
 
    if(!$appuser){
        $appuser = \app\models\OpalusermstTbl::find()
        ->select(['*'])
        ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = opalusermst_tbl.oum_opaldesignationmst_fk')
        ->Where(['oum_opalmemberregmst_fk'=>$data['acdt_opalmemberregmst_fk']])
        ->andWhere(['oum_isfocalpoint'=>1])
        ->andWhere(['oum_status'=>'A'])
        ->andWhere(['IS','oum_projectmst_fk' ,null])
        ->orderBy(["opalusermst_pk" => SORT_DESC])
        ->asArray()
        ->one();

    }
  
 
     $logopk = $data['omrm_cmplogo'];
     $crpk   = $data['omrm_cractivity'];
     $companypk = $data['acdt_opalmemberregmst_fk'];
     $userpk = $data['acdt_opalusermst_fk'];
     if($logopk){
        $driveImg  =   \api\components\Drive::generateUrl($logopk,$companypk,$userpk);
     }else{
        $driveImg = 'noimage';
     }
     if($crpk){
        $crImg  =   \api\components\Drive::generateUrl($crpk,$companypk,$userpk);
     }

     $histmodel     =   \app\models\AppcompanydtlshstyTbl::find()->where("acdh_appcompanydtlstmp_fk =:pk", [':pk' => $data['appcompanydtlstmp_pk']])->orderBy(["appcompanydtlshsty_pk" => SORT_DESC])->limit(2)->asArray()->all();
    
    if($data){
        
        $response = ['status' => 1,'data' => $data,'user' => $appuser ,'logo' => $driveImg ,'crImage' => $crImg ,'hisstatus' =>$histmodel[1]['acdh_status'],  'msg' => 'Success',
        ];
    } else{
       $response = ['status' => 2,'data' => '','msg' => 'Failure',
        ]; 
    }
    return $this->asJson($response);
}

public function actionUpdatecompany(){

    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $username =  \yii\db\ActiveRecord::getTokenData('oum_firstname', true); 
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
    $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    if($interId){
        $model = \app\models\AppcompanydtlstmpTbl::find()->where("acdt_applicationdtlstmp_fk =:pk", [':pk' => $interId])->one();
        if($model){
                $model->acdt_status =  (int)$formdata['formdata']['select_valitate'];
                $model->acdt_appdecComments = strval($formdata['formdata']['comments']);
                $model->acdt_appdecon = date("Y-m-d H:i:s");
                $model->acdt_appdecby = $userPk;
            if ($model->save() === TRUE) {

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'username' =>$username,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }


return $result;

}

public function actionGetdocument(){
   
    $formatedData = \app\models\AppdocsubmissiontmpTbl::getDocument();
   return $this->asJson([
          'data' => $formatedData,
          'msg' => 'Success',
          'status' => 100,
      ]);
}

public function actionGetdesktop(){
    $formatedData = \app\models\ApplicationdtlstmpTbl::getDesktop();
   return $this->asJson([
          'data' => $formatedData,
          'msg' => 'Success',
          'status' => 100,
      ]);
}

public function actionUpdatedocument(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'Please click on the Check Box and proceed further',
    );

    
    foreach($formdata['formdata']['appdtlstmp_id'] as $interId){
  
        if($interId){
        $model = \app\models\AppdocsubmissiontmpTbl::find()->where("appdocsubmissiontmp_pk =:pk", [':pk' => $interId])->one();
        if($model){
                $model->appdst_status =  (int)$formdata['formdata']['select_valitate'];
                $model->appdst_appdeccomment = strval($formdata['formdata']['comments']);
                $model->appdst_appdecon = date("Y-m-d H:i:s");
                $model->appdst_appdecby = $userPk;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }
}


return $result;

}

public function actionUpdatecontract(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'Please click on the Check Box and proceed further',
    );
    $AppId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    $apparray =  \app\models\AppoprcontracttmpTbl::find()->where("appoprct_applicationdtlstmp_fk =:pk", [':pk' => $AppId])->asArray()->All();

    if($apparray){
       foreach($apparray  as $data){
        $model =  \app\models\AppoprcontracttmpTbl::find()->where("appoprcontracttmp_pk =:pk", [':pk' => $data['appoprcontracttmp_pk']])->one();
        if($model){
            $model->appoprct_status =  (int)$formdata['formdata']['select_valitate'];
            $model->appoprct_appdeccomment = strval($formdata['formdata']['comments']);
            $model->appoprct_appdecon = date("Y-m-d H:i:s");
            $model->appoprct_appdecby = $userPk;

            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['select_valitate'],
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }
}

return $result;

} 

public function actionUpdateinternational(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $AppId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    $apparray =  \app\models\AppintrecogtmpTbl::find()->where("appintit_applicationdtlstmp_fk =:pk", [':pk' => $AppId])->asArray()->All();
    if($apparray){
        foreach($apparray  as $data){
            $model =  \app\models\AppintrecogtmpTbl::find()->where("appintrecogtmp_pk =:pk", [':pk' => $data['appintrecogtmp_pk']])->one();
            $model->appintit_status =  (int)$formdata['formdata']['select_valitate'];
            $model->appintit_appdeccomment = strval($formdata['formdata']['comments']);
            $model->appintit_appdecby = $userPk;
            $model->appintit_appdecon =  date("Y-m-d H:i:s");

            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['select_valitate'],
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
             }

       }
        }
    


return $result;

}

public function actionUpdateapplication(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true); 
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );

    $formatedData = \app\models\ApplicationdtlstmpTbl::getappoveral($formdata);
    $array = array_values($formatedData);
   
      if($formdata['formdata']['select_valitate'] == 3){
         
     if(in_array(4,$array)){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the approval process for the certification form, please review and approve the section(s) that were declined.',
        );
        return $result;
        exit;
     }
    
    }

    if($formdata['formdata']['select_valitate'] == 4){
     
     if(in_array(1,$array)){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the decline process for the certification form, please review and decline the section(s) that were new.',
        );
        return $result;
        exit;
     }

     if(in_array(2,$array)){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the decline process for the certification form, please review and decline the section(s) that were updated.',
        );
        return $result;
        exit;
     }
    
    }
      if($formatedData){
            $companystatus   =   $formatedData['acdt_status'];
            $insstatus       = $formatedData['appiit_status'];
            $intstatus       = $formatedData['appintit_status'];
            $contractstatus   = $formatedData['appoprct_status'];
            $submissionstatus   = $formatedData['appdst_status'];
            $coursestatus   = $formatedData['appoct_status'];
            $staffstatus   = $formatedData['appsit_status'];

            if($companystatus == '1' || $companystatus == '2'){
                $this->actionUpdatecompany();
        
            }
            if($insstatus == '1' || $insstatus == '2'){
                $this->actionUpdateinstitute();
        
            }
            if($intstatus == '1' || $intstatus == '2'){
                $this->actionUpdateinternational();
        
            }
            if($contractstatus == '1' || $contractstatus == '2'){
                $this->actionUpdatecontract();
        
            }
            if($submissionstatus == '1' || $submissionstatus == '2'){
                $this->actionUpdatedocAll();
        
            }
            if($coursestatus == '1' || $coursestatus == '2'){
                $this->actionUpdatecourseall();
        
            }
            if($staffstatus == '1' || $staffstatus == '2'){
                $this->actionUpdatestaffall();
        
            }
        
           }

        

    $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
  
    if($interId){
        $model = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
        $companyregpk = $model['appdt_opalmemberregmst_fk'];
        $memcompanymodel = \app\models\OpalmemberregmstTbl::find()->where("opalmemberregmst_pk =:pk", [':pk' => $companyregpk])->one();
        $companycrnumber = $memcompanymodel['omrm_opalmembershipregnumber'];
        $apptype = $model->appdt_apptype;
        if($apptype == 1){
            $approvaltype = 1;
        }else if($apptype == 2){
            $approvaltype = 4;
    
        }else if($apptype == 3){
            $approvaltype = 2;

        }
        if($model){

            if($formdata['formdata']['select_valitate'] == 3){
               
                if($apptype == 1 || $apptype == 2){
                  $status = 5;
                  }
                  if($apptype == 3){
                     if($model->appdt_status == 2 || $model->appdt_status == 4){
                         $status = 10;
                     }
                     if($model->appdt_status == 10 ){
                        $status = 11;
                    }
                     if($model->appdt_status == 20 ){
                        $status = 10;
                      }
                    if($model->appdt_status == 11 ){
                        $status = 17;
                        $appmst = ApplicationdtlsmainTbl::find()->Select('applicationdtlsmain_pk')->where('appdm_applicationdtlstmp_fk = '.$interId)->asArray()->one();
                        if($appmst['applicationdtlsmain_pk']){
                            $coursemst = AppoffercoursemainTbl::find()->Select('group_concat(appocm_coursecategorymst_fk) as cat')->where('appocm_applicationdtlsmain_fk = '.$appmst['applicationdtlsmain_pk'])->asArray()->one();
                          
                         }
                        $course = AppoffercoursetmpTbl::find()->Select('group_concat(appoct_coursecategorymst_fk) as cat')->where('appoct_applicationdtlstmp_fk = '.$interId)->asArray()->one();
                        
                       if($coursemst){
                         if($coursemst['cat'] !== $course['cat']){
                            self::Finalcerificategeneration($interId); 
                         }
                        }
                       
                    }
                  }
                  }else{
                    if($apptype == 1 || $apptype == 2){
                 
                      $status = 3;
                     }
                   
                   if($apptype == 3){
                    if($model->appdt_status == 2 || $model->appdt_status == 4){
                        $status = 3;
                    }
                    if($model->appdt_status == 10 ){
                       $status = 20;
                   }
                   if($model->appdt_status == 11 ){
                       $status = 20;
                   }
                   if($model->appdt_status == 20 ){
                    $status = 3;
                  }
                 }
                }
              
                $model->appdt_status =  $status;
                $model->appdt_appdeccomment = strval($formdata['formdata']['comments']);
                $model->appdt_appdecon = date("Y-m-d H:i:s");
                $model->appdt_appdecby = $userPk;
             
                //update approval
               $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $interId])->orderBy('appapprovalhdr_pk desc')->one();
               if($updatemodel){
                   if($formdata['formdata']['select_valitate'] == 3){
                       $approvalstatus = 1;
                   }else{
                       $approvalstatus = 2;
                   }
               $updatemodel->aah_status = $approvalstatus;
               $updatemodel->aah_appdecComments = strval($formdata['formdata']['comments']);
               $updatemodel->aah_appdecon = date("Y-m-d H:i:s");
               $updatemodel->aah_appdecby = $userPk;
               $updatemodel->aah_formstatus =  $approvaltype;
               $updatemodel->save();
               }

              
            if ($model->save() === TRUE) {
                $secondparam = '';
                $thirdparam = 1;
                $icvReturn  =  \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:i_comppk,:i_formstatus,:i_appform)")
                    ->bindParam(':i_comppk', $interId)
                    ->bindParam(':i_formstatus', $secondparam)
                    ->bindParam(':i_appform', $thirdparam)
                    ->execute();
                       if($status == 5){
                       $feesmodel = \app\models\FeeSubscriptionmstTbl::find()->where(['fsm_projectmst_fk' => $model['appdt_projectmst_fk'], 'fsm_feestype' => 1,'fsm_applicationtype' => $model['appdt_apptype']])->one();
                        $fee  = $feesmodel['fsm_fee'];
                        $vat_charge = (5 / 100) * $fee;
                        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);                     
                        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
                        $crno =   \yii\db\ActiveRecord::getTokenData('omrm_crnumber', true);
                      
                      //save invoice
                        $requestdataI['apid_opalmemberregmst_fk'] = $companyregpk;
                        $requestdataI['apid_applicationdtlstmp_fk'] = $interId;
                        $requestdataI['apid_feesubscriptionmst_fk'] = $feesmodel['feesubscriptionmst_pk'];
                    //    $requestdataI['apid_invoiceno'] = '12345';
                        $requestdataI['apid_raisedon'] =  date("Y-m-d H:i:s");
                        $requestdataI['apid_coursecertfee'] = $feesmodel['fsm_fee'];
                        $requestdataI['apid_vatamount'] = $vat_charge;
                        $requestdataI['apid_vatpercent'] = 5;
                        $requestdataI['apid_invoicestatus'] = 1;
                        $requestdataI['apid_noofstaffeval'] = 0;
                        $data = AppCenter::saveAppInvoice($requestdataI);
                
                        $pk = $data;
                        $year = date("Y");
                        
                        if($apptype == 1){
                            $invoiceno = 'INV-'.$companycrnumber.'-CRI-'.$year.'-'.$pk;
                        }else{
                            $invoiceno = 'INV-'.$companycrnumber.'-CRR-'.$year.'-'.$pk;
                        }
                       
                        $requestdataU['apid_invoiceno'] = $invoiceno;
                        $requestdataU['apppytminvoicedtls_pk'] = $pk;
             
                        $data = AppCenter::updateInvoiceNo($requestdataU);
              
                    
                      //save payment

        
                        $requestdata['apppdt_opalmemberregmst_fk'] = $companyregpk;
                        $requestdata['apppdt_apppytminvoicedtls_fk'] = $data;
                        $requestdata['apppdt_applicationdtlstmp_fk'] = $interId;
                        $requestdata['apppdt_paymenttype'] = 2;
                        $requestdata['apppdt_currency'] = 1;
                        $requestdata['apppdt_amount'] = $feesmodel['fsm_fee'];
                        $requestdata['apppdt_vatchrgs'] = $vat_charge;
                        $requestdata['apppdt_vatpercent'] = 5;
                        $requestdata['apppdt_requesttype'] = $model['appdt_projectmst_fk'];
                        $requestdata['apppdt_orderrefno'] = '12345';
                        $requestdata['apppdt_createdon'] = date("Y-m-d H:i:s");
                        $requestdata['apppdt_createdby'] = $userPk;
                
                        $data = AppCenter::saveAppPayment($requestdata);
                    
             
                    }

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'comments' => 'Status Updated Successfully!'
                );
            
                $appType = $model['appdt_apptype'];
                $appStatus = $model['appdt_status']; 
                $apptmpPk = $model['applicationdtlstmp_pk'];
                $regPk = $model['appdt_opalmemberregmst_fk'];    
              
            
                
               if($appStatus == '3' && $appType == '1'){
                    \api\components\Mail::getCertificatests($apptmpPk, $regPk, 'cerDeclined');
               }elseif($appStatus == '5' && $appType == '1'){                  
                    \api\components\Mail::getCertificatests($apptmpPk, $regPk, 'approvedCr');   
               }
               
                  if($appStatus == '3' && $appType == '2'){
                    \api\components\Mail::getCertificatests($apptmpPk, $regPk, 'recerDeclined');
               }elseif($appStatus == '5' && $appType == '2'){                  
                    \api\components\Mail::getCertificatests($apptmpPk, $regPk, 'reapprovedCr');   
               }
               
               
               
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'In order to complete the approval process for the certification form, please review and approve the section(s) that were declined.',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }


return $result;

}

public function actionUpdatedocAll(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $AppId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    $apparray =  \app\models\AppdocsubmissiontmpTbl::find()->where("appdst_applicationdtlstmp_fk =:pk", [':pk' => $AppId])->asArray()->All();
    if($apparray){
        foreach($apparray  as $data){
            $model =  \app\models\AppdocsubmissiontmpTbl::find()->where("appdocsubmissiontmp_pk =:pk", [':pk' => $data['appdocsubmissiontmp_pk']])->one();
            $model->appdst_status =  (int)$formdata['formdata']['select_valitate'];
            $model->appdst_appdeccomment = strval($formdata['formdata']['comments']);
            $model->appdst_appdecon = date("Y-m-d H:i:s");
            $model->appdst_appdecby = $userPk;

            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['select_valitate'],
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
             }

       }
        }
    


return $result;

}
public function actionUpdatestaffall(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $AppId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    $apparray =  \app\models\AppstaffinfotmpTbl::find()->where("appsit_applicationdtlstmp_fk =:pk", [':pk' => $AppId])->asArray()->All();

    if($apparray){
        foreach($apparray  as $data){
            $model =  \app\models\AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk =:pk", [':pk' => $data['appostaffinfotmp_pk']])->one();
          
            $model->appsit_status =  (int)$formdata['formdata']['select_valitate'];
            $model->appsit_appdeccomment = strval($formdata['formdata']['comments']);
            $model->appsit_appdecon = date("Y-m-d H:i:s");
            $model->appsit_appdecby = $userPk;
          
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['select_valitate'],
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
             }

       }
      


        }
    


return $result;

}
public function actionUpdateinspectionall(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $AppId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    $apparray =  \app\models\ApprasvehinspcattmpTbl::find()->where("arvict_applicationdtlstmp_fk =:pk", [':pk' => $AppId])->asArray()->All();

    if($apparray){
        foreach($apparray  as $data){
            $model =  \app\models\ApprasvehinspcattmpTbl::find()->where("apprasvehinspcattmp_pk =:pk", [':pk' => $data['apprasvehinspcattmp_pk']])->one();
          
            $model->arvict_status =  (int)$formdata['formdata']['select_valitate'];
            $model->arvict_appdecComments = strval($formdata['formdata']['comments']);
            $model->arvict_appdecon = date("Y-m-d H:i:s");
            $model->arvict_appdecby = $userPk;
          
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['select_valitate'],
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
             }

       }
      


        }
    


return $result;

}
public function actionUpdatecourseall(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $AppId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    $apparray =  \app\models\AppoffercoursetmpTbl::find()->where("appoct_applicationdtlstmp_fk =:pk", [':pk' => $AppId])->asArray()->All();
    if($apparray){
        foreach($apparray  as $data){
            $model =  \app\models\AppoffercoursetmpTbl::find()->where("appoffercoursetmp_pk =:pk", [':pk' => $data['appoffercoursetmp_pk']])->one();
            $model->appoct_status =  (int)$formdata['formdata']['select_valitate'];
            $model->appoct_appdeccomment = strval($formdata['formdata']['comments']);
            $model->appoct_appdecon = date("Y-m-d H:i:s");
            $model->appoct_appdecby = $userPk;
            $coursepk = $model->appoffercoursetmp_pk;
            $coureunitarray =  \app\models\AppoffercourseunittmpTbl::find()->where("appocut_appoffercoursetmp_fk =:pk", [':pk' => $coursepk])->asArray()->All();
            foreach($coureunitarray as $coursearray){
                if($coursearray){
                $unitmodel =  \app\models\AppoffercourseunittmpTbl::find()->where("appoffercourseunittmp_pk =:pk", [':pk' => $coursearray['appoffercourseunittmp_pk']])->one();
                $unitmodel->appocut_status =  (int)$formdata['formdata']['select_valitate'];
                $unitmodel->appocut_appdeccomment = strval($formdata['formdata']['comments']);
                $unitmodel->appocut_updatedon = date("Y-m-d H:i:s");
                $unitmodel->appocut_updatedby = $userPk;
                $unitmodel->save() === TRUE;
              }
            }
         

            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['select_valitate'],
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
             }

       }
        }
    


return $result;

}

public function actionGetstaffvalidation(){
    $formatedData = \app\models\AppstaffinfotmpTbl::getStaff();
   return $this->asJson([
          'data' => $formatedData,
          'msg' => 'Success',
          'status' => 100,
      ]);
}


public function actionUpdatestaff(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'Please click on the Check Box and proceed further',
    );

    
    foreach($formdata['formdata']['appdtlstmp_id'] as $interId){
  
        if($interId){
        $model = \app\models\AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk =:pk", [':pk' => $interId])->one();
        if($model){
                $model->appsit_status =  (int)$formdata['formdata']['select_valitate'];
                $model->appsit_appdeccomment = strval($formdata['formdata']['comments']);
                $model->appsit_appdecon = date("Y-m-d H:i:s");
                $model->appsit_appdecby = $userPk;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }
}


return $result;

}


    
    public function actionSavesubdesk(){
        
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userpk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $usercrPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata['appdtlstmp_id'] = $request['appdtlstmp_id'];
        $requestdata['renewalaction'] = $request['renewalaction'];
        $requestdata['userdtls'] = $request['comanydetialsform'];
        $requestdata['opalmemberregmst_fk'] = $regPk;
        $requestdata['user_pk'] = $usercrPk;
        $apptmpPk = $requestdata['appdtlstmp_id'];
      $applicaStatus = \app\models\ApplicationdtlstmpTbl::find()
        ->leftJoin('appinstinfotmp_tbl', 'applicationdtlstmp_tbl.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
        ->select(['appdt_status', 'appdt_apptype','appdt_projectmst_fk']) // Select both columns
        ->andWhere("find_in_set($apptmpPk, applicationdtlstmp_pk)")
        ->asArray()
        ->one();
        $appStatus = $applicaStatus['appdt_status'];  
        $appType = $applicaStatus['appdt_apptype']; 
        $projectpk =  $applicaStatus['appdt_projectmst_fk']; 
        $response = [];
        $data = AppCenter::saveSubDesk($requestdata);
        if($request['diffdoculpoint'] == 'yes'){
            $differnt = AppCenter::differentfoculpoint($requestdata['userdtls']);
        }
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];

        $desrwmail = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
       ->select(['oum_emailid', 'oum_firstname'])
       ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
       ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
       ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
       ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 2])
       ->asArray()
       ->all();
        $id = [];
        $name = [];  

        foreach ($desrwmail as $row) {
             $id = $row['oum_emailid'];
             $name = $row['oum_firstname'];
             if($appStatus==1 && $appType==1 && $projectpk==1){
            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'befcersubmit');
            }elseif($appStatus==3 && $appType==1 && $projectpk==1){
            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'resubmit');     
            }    
        }   
        
        $redesrwmail = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
       ->select(['oum_emailid', 'oum_firstname'])
       ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
       ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
       ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
       ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 2])
       ->asArray()
       ->all();
        $id = [];
        $name = [];  
       
            foreach ($redesrwmail as $rerow) {
                $id = $rerow['oum_emailid'];
                $name = $rerow['oum_firstname'];

               if($appStatus==1 && $appType==2 && $projectpk==1){
                 \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rebefcersubmit');
                 }elseif($appStatus==3 && $appType==2&& $projectpk==1){
                 \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reresubmit');     
                 } 
            }
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    //save main center International creation
    public function actionDelintrdtls(){

        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['insdtls'];
        $response = [];
        $rec_pk=$requestdata['appintrecogtmp_pk'];
        $dataRec = \app\models\AppoffercoursetmpTbl::find()
                        ->select(['*'])
                        ->andWhere("find_in_set($rec_pk,appoct_appintrecogtmp_fk)")
                        ->asArray()->all();
        if(!empty($dataRec)){
            $data = "mapped_course";
        }else{
            Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $data = \app\models\AppintrecogtmpTbl::findOne($requestdata['appintrecogtmp_pk'])->delete();
            \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        }
        

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }


    
    public function actionDelopr(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['oprdtls'];
        
        $response = [];
        Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $data = \app\models\AppoprcontracttmpTbl::findOne($requestdata['appoprcontracttmp_pk'])->delete();
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionDelcour(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['courdtls'];
        //echo '<pre>';print_r($requestdata);exit;
        $cour_pk=$requestdata['appoffercoursetmp_pk'];        
        
        $response = [];
        $dataStaff = \app\models\AppstaffinfotmpTbl::find()
                        ->select(['*'])
                        ->andWhere("find_in_set($cour_pk,appsit_appoffercoursetmp_fk)")
                        ->asArray()->all();
        $datacustomisedcourse = \app\models\AppcoursedtlstmpTbl::find()
        ->select(['*'])
        ->andWhere("find_in_set($cour_pk,appcdt_appoffercoursemain_fk)")
        ->asArray()->all();
        if(!empty($dataStaff)){
            $data = "mapped_staff";
        }else if(!empty($datacustomisedcourse)){
            $data = "mapped_course";
        }else{
            Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            \app\models\AppoffercourseunittmpTbl::deleteAll('appocut_appoffercoursetmp_fk=:app_app_fk',
                            [':app_app_fk'=>$requestdata['appoffercoursetmp_pk']]);
            $data = \app\models\AppoffercoursetmpTbl::findOne($requestdata['appoffercoursetmp_pk'])->delete();
            \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        }

        if($data){
            //update status for re submit starts
            $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appoct_applicationdtlstmp_fk']);
            $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'],$requestdata['appoct_applicationdtlstmp_fk']);
            //update status for re submit ends
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionDelstaff(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['stfdtls'];
        //echo '<pre>';print_r($requestdata['appostaffinfotmp_pk']);exit;
        $response = [];
        \app\models\AppstaffinfohstyTbl::deleteAll('appsih_appostaffinfotmp_fk=:app_staff_fk',
                        [':app_staff_fk'=>$requestdata['appostaffinfotmp_pk']]);

        $data = \app\models\AppstaffinfotmpTbl::findOne($requestdata['appostaffinfotmp_pk'])->delete();

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionDeletestaffedu(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['stfedu'];
        
        $data = \app\models\StaffacademicsTbl::findOne($requestdata['staffacademics_pk'])->delete();

        if($data){
            if($requestdata['appdtlsPk'] != 'learner'){
                //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlsPk']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'],$requestdata['appdtlsPk']);
                //update status for re submit ends
            }
            
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionDeletestaffwork(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['stfwork'];
        //echo '<pre>';print_r($requestdata);exit;
        
        $data = \app\models\StaffworkexpTbl::findOne($requestdata['staffworkexp_pk'])->delete();

        if($data){
            if($requestdata['appdtlsPk'] != 'learner'){
                //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlsPk']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'],$requestdata['appdtlsPk']);
                //update status for re submit ends
            }
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionGetcenterstatus(){
        $stsReturn = \app\models\ApplicationdtlstmpTbl::find()
                    ->select(['appdt_status'])
                    ->Where(['applicationdtlstmp_pk'=>$_GET['param']])
                    ->asArray()
                    ->one();
        return $this->asJson($stsReturn);
    }

    public function actionSavedocuments(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata['appdtlstmp_id'] = $request['formdata']['appdtlstmp_id'];
        $requestdata['opalmemberregmst_fk'] = $regPk;
        $requestdata['user_pk'] = $userPk;
        //echo '<pre>';print_r($request['formdata']['documents']);exit;
        if(!empty($request['formdata']['documents'])){
            //\app\models\AppdocsubmissiontmpTbl::deleteAll('appdst_applicationdtlstmp_fk=:app_app_fk',
                        //[':app_app_fk'=>$requestdata['appdtlstmp_id']]);
                        
            foreach($request['formdata']['documents'] as $formData){
                
                if(!empty($formData['appdocsubmissiontmp_pk'])){
                    
                    //$modelApp = new \app\models\AppdocsubmissiontmpTbl();
                    $doc_pk=$formData['appdocsubmissiontmp_pk'];
                    $modelDoc = \app\models\AppdocsubmissiontmpTbl::find()
                                    ->select(['appdst_status'])
                                    ->where("appdocsubmissiontmp_pk = $doc_pk")
                                    ->andWhere("appdst_status = 2 OR appdst_status = 3 OR appdst_status = 4")
                                    ->asArray()
                                    ->one();
                
                        
                                //    echo '<pre>';print_r($modelDoc);exit;
                    $modelApp = \app\models\AppdocsubmissiontmpTbl::find()->where(['appdocsubmissiontmp_pk' => $formData['appdocsubmissiontmp_pk']])->one();
                    //echo '<pre>';print_r($modelApp);exit;
                    //$modelApp->appdst_opalmemberregmst_fk = $requestdata['opalmemberregmst_fk'];
                    //$modelApp->appdst_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
                    //$modelApp->appdst_documentdtlsmst_fk = $formData['keymap'];
                    
                    if($formData['provided'] == 1){
                        if(!empty($formData['fileName'])){
                            if(count($formData['fileName']) == 2 && is_array($formData['fileName'])){
                                $modelApp->appdst_memcompfiledtls_fk = $formData['fileName'][1];
                            }elseif(count($formData['fileName']) == 1 && is_array($formData['fileName'])){
                                $modelApp->appdst_memcompfiledtls_fk = $formData['fileName'][0];
                            }else{
                                $modelApp->appdst_memcompfiledtls_fk = $formData['fileName'];
                            }

                            if(empty($formData['fileName'])){
                                $modelApp->appdst_memcompfiledtls_fk = "";
                            }
                            
                        }else{
                            $modelApp->appdst_memcompfiledtls_fk = "";
                        }
                        $modelApp->appdst_remarks = "";
                    }
                    
                    if($formData['provided'] == 2){
                        $modelApp->appdst_memcompfiledtls_fk = "";
                        $modelApp->appdst_remarks = $formData['remark_fst'];
                    }

                    $modelApp->appdst_submissionstatus = $formData['provided'];
                    $modelApp->appdst_updatedon = date("Y-m-d H:i:s");
                    $modelApp->appdst_updatedby = $requestdata['user_pk'];
                    
                    if(!empty($modelDoc)){
                        $modelApp->appdst_status = 2;
                        //$modelApp->appdst_appdeccomment = "";
                    }
                    
                    if($modelApp->save()){
                        
                    }else{
                        echo "<pre>";return $modelApp->getErrors();exit;
                    }
                }else{
                    
                    $modelApp = new \app\models\AppdocsubmissiontmpTbl();
                    $modelApp->appdst_opalmemberregmst_fk = $requestdata['opalmemberregmst_fk'];
                    $modelApp->appdst_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
                    $modelApp->appdst_documentdtlsmst_fk = $formData['keymap'];
                    if($formData['provided'] == 1){
                        if(!empty($formData['fileName'])){
                            $modelApp->appdst_memcompfiledtls_fk = $formData['fileName'][0];
                        }
                        $modelApp->appdst_remarks = "";
                    }
                    
                    if($formData['provided'] == 2){
                        $modelApp->appdst_memcompfiledtls_fk = "";
                        $modelApp->appdst_remarks = $formData['remark_fst'];
                    }

                    $modelApp->appdst_submissionstatus = $formData['provided'];
                    $modelApp->appdst_createdon = date("Y-m-d H:i:s");
                    $modelApp->appdst_createdby = $requestdata['user_pk'];
                    $modelApp->appdst_status = 1;
                    if($modelApp->save()){
                        
                    }else{
                        echo "<pre>";return $modelApp->getErrors();exit;
                    }
                }
                
            }
        }
        

        if($modelApp->appdocsubmissiontmp_pk){
            $response = ['status' => 1,'data' => $modelApp->appdocsubmissiontmp_pk,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetdoc(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $doc_id = $request['doc_id'];
        
        $data = \app\models\AppdocsubmissiontmpTbl::find()
                            ->select(['*','DATE_FORMAT(appdst_createdon,"%d-%m-%Y") AS createdon','DATE_FORMAT(appdst_updatedon,"%d-%m-%Y") AS updatedon'])
                            ->leftJoin('documentdtlsmst_tbl docmst','docmst.documentdtlsmst_pk = appdocsubmissiontmp_tbl.appdst_documentdtlsmst_fk')
                            ->where(['appdst_applicationdtlstmp_fk' => $doc_id])
                            ->asArray()
                            ->all();
        //echo '<pre>';print_r($data);exit;
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }
    
      public function actionGetstaffbas(){
        
        $response = [];
        $data = \app\models\StaffinforepoTbl::getstaffbas($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }
    
     public function actionGetstaffwork(){
        
        $response = [];
        $data = \app\models\StaffinforepoTbl::getstaffwork($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }
    
      public function actionGetstaff(){
        
        $response = [];
        $data = \app\models\StaffinforepoTbl::getstaff($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }
    
      public function actionGetcourunt(){

        $response = [];
        $data = \app\models\AppoffercourseunittmpTbl::find()
                    ->select(['appoffercourseunittmp_pk','appocut_unitcode','appocut_unittitle'])
                    ->Where(['appocut_appoffercoursetmp_fk'=>$_GET['param']])
                    ->asArray()
                    ->all();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }
    
      public function actionGetdocumentdtl(){

        $response = [];
        $data = \app\models\DocumentdtlsmstTbl::find()
                    ->select(['*'])
                    ->Where(['ddm_projectmst_fk'=>$_GET['param']])
                    ->asArray()
                    ->all();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetreferance(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $mstPk = $request['mst_pk'];
        $data = \app\models\ReferencemstTbl::find()->where(['rm_mastertype' => $mstPk])->asArray()->orderBy('referencemst_pk asc')->all();
        
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetcoursecategory(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $mstPk = $request['mst_pk'];
        $data = \app\models\CoursecategorymstTbl::find()->where(['ccm_coursecategorymst_pk'=>NULL , 'ccm_status' => 1])->asArray()->all();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetsubcoursecategory(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $mstPk = $request['mst_pk'];
        $data = \app\models\CoursecategorymstTbl::find()->where([ 'ccm_status' => 1])->asArray()->all();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }
    
    public function actionGetappintermst(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $mstPk = $request['mst_pk'];
        //$data = \app\models\IntnatrecogmstTbl::find()->asArray()->all();
        $data = \app\models\AppintrecogtmpTbl::find()
        ->select(['*'])
        ->leftJoin('intnatrecogmst_tbl nat','nat.intnatrecogmst_pk = appintrecogtmp_tbl.appintit_intnatrecogmst_fk')
        //->Where(['appiit_applicationdtlstmp_fk'=>$appDtlsPk])
        ->asArray()
        ->all();
        foreach($data as $key => $value){

            $interarray[$value['appintrecogtmp_pk']] = $value['irm_intlrecogname_en'];
        }
      
        if($data){
            $response = ['status' => 1,'data' => $interarray,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetcoursetmp(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $mstPk = $request['mst_pk'];
        $data = \app\models\AppoffercoursetmpTbl::find()->asArray()->all();
        foreach($data as $key => $value){

            $interarray[$value['appoffercoursetmp_pk']] = $value['appoct_coursename_en'];
        }
        if($data){
            $response = ['status' => 1,'data' => $interarray,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionCheckcivilnumval(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        //echo '<pre>';print_r($request['repo']);exit;
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
       
        if(!empty($request['repo'])){
            $data = \app\models\StaffinforepoTbl::find()
                ->select(['*'])
                ->leftJoin('appstaffinfotmp_tbl  tmp','tmp.appsit_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
                ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = tmp.appsit_applicationdtlstmp_fk')
                ->leftJoin('appinstinfotmp_tbl insmain','insmain.appinstinfotmp_pk = tmp.appsit_appinstinfotmp_fk')
                ->Where(['sir_idnumber'=>$request['civilnumval']])
                ->andWhere(['!=', 'staffinforepo_pk', $request['repo']])
                ->andWhere(['sir_opalmemberregmst_fk' =>  $regPk])
                ->orderBy('appostaffinfotmp_pk desc')
                ->asArray()
                ->one();

                $differentcentre = \app\models\StaffinforepoTbl::find()
                ->select(['*'])
                ->leftJoin('appstaffinfotmp_tbl  tmp','tmp.appsit_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
                ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = tmp.appsit_applicationdtlstmp_fk')
                ->leftJoin('appinstinfotmp_tbl insmain','insmain.appinstinfotmp_pk = tmp.appsit_appinstinfotmp_fk')
                ->Where(['sir_idnumber'=>$request['civilnumval']])
                ->andWhere(['!=', 'staffinforepo_pk', $request['repo']])
                ->asArray()
                ->one();
        }else{
            $data = \app\models\StaffinforepoTbl::find()
                ->select(['*'])
                ->leftJoin('appstaffinfotmp_tbl  tmp','tmp.appsit_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
                ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = tmp.appsit_applicationdtlstmp_fk')
                ->leftJoin('appinstinfotmp_tbl insmain','insmain.appinstinfotmp_pk = tmp.appsit_appinstinfotmp_fk')
                ->Where(['sir_idnumber'=>$request['civilnumval']])
                ->andWhere(['sir_opalmemberregmst_fk' =>  $regPk])
                ->orderBy('appostaffinfotmp_pk desc')
                ->asArray()
                ->one();

                $differentcentre = \app\models\StaffinforepoTbl::find()
                ->select(['*'])
                ->leftJoin('appstaffinfotmp_tbl  tmp','tmp.appsit_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
                ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = tmp.appsit_applicationdtlstmp_fk')
                ->leftJoin('appinstinfotmp_tbl insmain','insmain.appinstinfotmp_pk = tmp.appsit_appinstinfotmp_fk')
                ->Where(['sir_idnumber'=>$request['civilnumval']])
                ->asArray()
                ->one();
                // print_r($differentcentre);exit;
        }

         // return['alreadymapped'=> $arreaymapped,'isstaffavi'=>$isstaffavi,'dataavailable'=>$dataavailable];
         $arreaymapped = '1';
         if($data['appdt_projectmst_fk'] == 1 || $data['appdt_projectmst_fk'] == 4){
            $arreaymapped = '2';
         }
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success','alreadymapped'=> $arreaymapped,
            ];
        } else{
            if($differentcentre){
            $response = ['status' => 3,'data' => $differentcentre,'msg' => 'Failure',
            ];
            }else{
            $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 

            }
        }
        return $this->asJson($response);
    }

    public function cvGeneration($data){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $cv_path = "cv_".$regPk."_".$data.".pdf";
        $stfRepo = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk' => $data])->asArray()->one();

        $stfEdu = \app\models\StaffacademicsTbl::find()->where(['sacd_staffinforepo_fk' => $data])->asArray()->all();
        
        $stfEdu = \app\models\StaffacademicsTbl::find()
                ->select(['*'])
                ->leftJoin('referencemst_tbl ref','ref.referencemst_pk = staffacademics_tbl.sacd_edulevel')
                ->where(['sacd_staffinforepo_fk' => $data])
                ->asArray()
                ->all();

        $stfWork = \app\models\StaffworkexpTbl::find()->where(['sexp_staffinforepo_fk' => $data])->asArray()->all();
        //echo '<pre>';print_r($stfWork);exit;
        $path = "../api/web/cv/$regPk/";

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }             
                
        $baseUrl = \Yii::$app->params['baseUrl'];

        $name=$stfRepo['sir_name_en'];
        $namear=$stfRepo['sir_name_ar'];
        $number=$stfRepo['sir_idnumber'];
        $mail=$stfRepo['sir_emailid'];
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 50,
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_bottom' => 5,
        'autoPageBreak' => true,
        'default_font' => 'segoeregular',
        //'format' => 'A3'
        'format' => [250, 330]]);
        $mpdf->shrink_tables_to_fit = 1;		
        //$mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png',.1, 1, 200, '', '', '', true, true);
       
        $mpdf->SetWatermarkImage($baseUrl.'assets/images/opalimages/opalpdflogo.png',.03, 1, 100, '', '', '', true, true);
        //$mpdf->SetWatermarkImage('http://192.168.1.27:4200/assets/images/jsrs-logo-icon.png');
       
        $mpdf->watermarkImageAlpha = .03;
        $mpdf->showWatermarkImage = true;
        $mpdf->SetHTMLHeader('<div style=" background-color: #F6FAFF;padding: 5px 5px">
                            <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 700;margin:5px 10px 5px 10px"> '.$name.'</h4>
                            <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 700;margin:5px 10px 5px 10px"> '.$namear.'</h4>
                            <div class="contactinfo">
                                <div class="contdetails fs-14 border" style="border-left: 3px solid #0C4B9A;  background-repeat: no-repeat; ">
                                   
                                    <p style="padding-left:20px;margin:5px 10px 5px 10px"> <span class="minwidth" style="margin-left: 30px;color: #848484;font-size: 16px;">Civil Number </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="details" style="color: #262626;font-size: 16px;">'.$number.'</span></p>
                                    <p style="padding-left:20px;margin:5px 10px 5px 10px"> <span class="minwidth" style="margin-left: 30px;color: #848484;font-size: 16px;margin-right: 30px;">Email</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="details" style="color: #262626;font-size: 16px;">'.$mail.'</span></p>
                                </div>

                            </div>
                        </div>');
        $mpdf->WriteHTML($this->renderPartial('../../../al/views/afterlogin/cv',['stfRepo'=>$stfRepo, 'stfEdu'=>$stfEdu, 'stfWork'=>$stfWork]));
        $mpdf->Output("../api/web/cv/$regPk/$cv_path",'F');

        $pdfPath = $regPk."/".$cv_path;
        
        $stfRepoModel = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk' => $data])->one();
        $stfRepoModel->sir_staffcv=$pdfPath;
        if($stfRepoModel->save()){
                
        }else{
            echo "<pre>";var_dump($stfRepoModel->getErrors());exit;
        }
        
    }

    public function actionGetcompanydtls(){

        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $response = [];
        $data = \app\models\AppcompanydtlstmpTbl::find()
                    ->select(['*'])
                    ->Where(['acdt_applicationdtlstmp_fk'=>$request['appDtlsPk']])
                    ->asArray()
                    ->one();
                    
        
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }

    

    public function actionGetpayment(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
      
        $appDtlsPk = $request['apptempPk'];
        $interId = Security::decrypt($appDtlsPk);
    
        $data = \app\models\OpalPaymentTbl::find()
        
        ->select(['*','app.appdt_projectmst_fk,DATE_FORMAT(apppdt_dateofpymt,"%d-%m-%Y") AS apppdt_dateofpymt' ,'DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon','DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon' ,'DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry','DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS apid_raisedon','DATE_FORMAT(apid_raisedon,"%Y-%m-%d") AS apid_raisedonO','DATE_FORMAT(appdt_certificateexpiry,"%m-%d-%Y") AS appdt_certificateexpiry_new'])
        ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = apppymtdtlstmp_tbl.apppdt_applicationdtlstmp_fk')
        ->leftJoin('appinstinfotmp_tbl ins','ins.appiit_applicationdtlstmp_fk = apppymtdtlstmp_tbl.apppdt_applicationdtlstmp_fk')
        ->leftJoin('opalmemberregmst_tbl reg','reg.opalmemberregmst_pk = app.appdt_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = apppymtdtlstmp_tbl.apppdt_appdecby')
        ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = apppdt_pymtproof')
        ->leftJoin('apppytminvoicedtls_tbl invoice','invoice.apppytminvoicedtls_pk = apppymtdtlstmp_tbl.apppdt_apppytminvoicedtls_fk')
        ->Where(['apppdt_applicationdtlstmp_fk'=>$interId])
        ->orderBy('apppymtdtlstmp_pk desc')
        ->asArray()
        ->one();

        if($data['appdt_projectmst_fk']==1){
            $total = $data['apppdt_amount']+$data['apppdt_vatchrgs']+$data['apppdt_addchrgs'];        
        }else{
            $total = $data['apppdt_amount']+$data['apppdt_vatchrgs']+$data['apppdt_addchrgs']+$data['apppdt_staffevafee'];    
            $modelmain = \app\models\AppcoursedtlstmpTbl::find()
                ->select(['appiim_officetype as appiim_officetype','appiim_branchname_en as appiim_branchname_en',
                    'appiim_branchname_ar as appiim_branchname_ar'])
                ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
                ->where(['appcdt_applicationdtlstmp_fk' => $data['apppdt_applicationdtlstmp_fk']])
                ->asArray()
                ->one();
                if(!empty($modelmain)){
                    $data['appiit_officetype'] = $modelmain['appiim_officetype'];
                }
        }
        if($data['apppdt_currency']==1){
            $total = number_format($total,3, '.', '');
            $data['apppdt_amount'] = number_format($data['apppdt_amount'],3, '.', '');
            $data['apppdt_staffevafee'] = ($data['apppdt_staffevafee']>0)? number_format($data['apppdt_staffevafee'],3, '.', ''): '0';
            $data['apppdt_vatchrgs'] = number_format($data['apppdt_vatchrgs'],3, '.', '');
        }else{
            $total = number_format($total,2, '.', '');
            $data['apppdt_amount'] = number_format($data['apppdt_amount'],2, '.', '');
            $data['apppdt_staffevafee'] = ($data['apppdt_staffevafee']>0)? number_format($data['apppdt_staffevafee'],2, '.', ''): '0';
            $data['apppdt_vatchrgs'] = number_format($data['apppdt_vatchrgs'],2, '.', '');
        }
        $data['total_amount'] = $total;       
        $memid = $data['apppdt_pymtproof'];
        $mempk = $data['appdt_opalmemberregmst_fk'];
        $userpk = $data['appdt_submittedon'];
        $filetype = $data['mcfd_filetype'];
        $driveImg  =   \api\components\Drive::generateUrl($memid,$mempk,$userpk);
        $driveurl = $driveImg; 

        
        $auditschmodel   =   \app\models\AppauditschedtmpTbl::find()
        ->select(['*','DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date'])
        ->leftJoin('auditscheddtls_tbl sch','sch.auditscheddtls_pk = appauditschedtmp_tbl.appasdt_auditscheddtls_fk')
        ->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $interId])
        ->orderBy(["appauditschedtmp_pk" => SORT_DESC])->asArray()->one();
        if($data){
          
            $response = ['status' => 1,'data' => $data,'fileurl' =>$driveurl ,'filetype' => $filetype,'schdate' => $auditschmodel['asd_date'] ,  'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }


    public function actionUpdatepayment(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = array(
            'status' => 200,
            'msg' => 'false',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    
        $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
        $apptmpPk = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
        if($interId){
            //'apppdt_status' => 2
            $model = \app\models\OpalPaymentTbl::find()->where(['apppdt_applicationdtlstmp_fk' => $interId])->orderBy('apppdt_apppytminvoicedtls_fk desc')->one();
            $invoicemodel = \app\models\OpalInvoiceTbl::find()->where(['apid_applicationdtlstmp_fk' => $interId])->orderBy('apppytminvoicedtls_pk desc')->one();
            $invoicemodel->apid_invoicestatus =  (int)$formdata['formdata']['select_valitate'];
            $invoicemodel->apid_appdecComments = strval($formdata['formdata']['comments']);
            $invoicemodel->apid_appdecon = date("Y-m-d H:i:s");
            $invoicemodel->apid_appdecby = $userPk;
            $invoicemodel->save();
            if($model){
                   
                $model->apppdt_status =  (int)$formdata['formdata']['select_valitate'];
                $model->apppdt_appdeccomment = strval($formdata['formdata']['comments']);
                $model->apppdt_appdecon = date("Y-m-d H:i:s");
                $model->apppdt_appdecby = $userPk;
                if ($model->save() === TRUE) {
                    $Appmodel = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
                    if($Appmodel){
                        if($formdata['formdata']['select_valitate'] == 3){
                            $scheduledata = \app\models\AuditscheduleTbl::find()
                            ->select(['*'])
                            ->andWhere(['asd_projectmst_fk'=>  1])
                            ->andWhere(['asd_isavailable'=> 1])
                            ->andWhere(['>=', 'asd_date',  date("Y-m-d")]); 
                            if($scheduledata){
                                $status = 8;
                             }else{
                                 $status = 7;
                               } 
                              }else{
                               $status = 18;
                            }
                        
                            $Appmodel->appdt_status =  $status;
                            $Appmodel->appdt_appdeccomment = strval($formdata['formdata']['comments']);
                            $Appmodel->appdt_appdecon = date("Y-m-d H:i:s");
                            $Appmodel->appdt_appdecby = $userPk;
                            $apptype = $Appmodel->appdt_apptype;
                            if($apptype == 1){
                                $approvaltype = 1;
                            }else if($apptype == 2){
                                $approvaltype = 4;
                    
                        }else{
                            $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $Appmodel->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                            $approvaltype = $updatemodel->aah_formstatus;
                        }
                            //update approval
                            $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $interId])->orderBy('appapprovalhdr_pk desc')->one();
                            if($updatemodel){
                            if($formdata['formdata']['select_valitate'] == 3){
                            $approvalstatus = 1;
                            }else{
                            $approvalstatus = 2;
                            }
                            $updatemodel->aah_status = $approvalstatus;
                            $updatemodel->aah_appdecComments = strval($formdata['formdata']['comments']);
                            $updatemodel->aah_appdecon = date("Y-m-d H:i:s");
                            $updatemodel->aah_appdecby = $userPk;
                          //  $updatemodel->aah_formstatus =  $approvaltype;
                            $updatemodel->save();
                            }

                        }

                        if ($Appmodel->save() === TRUE) {
                            if($Appmodel->appdt_projectmst_fk == 1){
                                $secondparam = '';
                                $thirdparam = 1;
                                $icvReturn  =  \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:i_comppk,:i_formstatus,:i_appform)")
                                    ->bindParam(':i_comppk', $interId)
                                    ->bindParam(':i_formstatus', $secondparam)
                                    ->bindParam(':i_appform', $thirdparam)
                                    ->execute();
                            }else{
                                \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
                                ->bindValue(':p1' , $interId)
                                ->bindValue(':p2' , '')
                                ->bindValue(':p3' , 4)
                                ->execute();

                            }
                         
                            $result = array(
                                'status' => 200,
                                'msg' => 'success',
                                'flag' => $formdata['formdata']['select_valitate'],
                                'data' => $model,
                                'comments' => 'Status Updated Successfully!'
                            );
                            
                    
                            $projectpk = $Appmodel->appdt_projectmst_fk;
                            $paymentStatus = $Appmodel->appdt_status;
                            $appType = $Appmodel->appdt_apptype;
                            $regPk = $Appmodel->appdt_opalmemberregmst_fk;
                            
                            if($paymentStatus == 18 && $appType ==1 && $projectpk ==1 ){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'payDecline');  
                            }elseif($paymentStatus == 8 && $appType ==1 && $projectpk ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'paymentrecd');
                        }
                            if($paymentStatus == 18 && $appType == 2 && $projectpk ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'repayDecline');  
                            }elseif($paymentStatus == 8 && $appType ==2 && $projectpk ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'recnfmSiteAudit');
                            }
                            
                            if($projectpk == 2 ||$projectpk == 3 ){
                                if($paymentStatus == 18 && $appType ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'crpayDecline');  
                                }elseif($paymentStatus == 8 && $appType ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'crpaymentrecd');
                                }
                                
                                if($paymentStatus == 18 && $appType ==2){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'rencrpayDecline');  
                                }elseif($paymentStatus == 8 && $appType ==2){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'rencrpaymentrecd');
                                }
                                
                                if($paymentStatus == 18 && $appType ==3){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'updcrpayDecline');  
                                }elseif($paymentStatus == 8 && $appType ==3){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'updcrpaymentrecd');
                                }
                            }
                            
                        }
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'false',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
    
    
    return $result;
    
    }

    public function actionDownloadlist(){
         $projectpk = $_GET['projectpk'];
        $dataModel =  \app\models\ApplicationdtlstmpTbl::getscfexportlist($_GET);   

        // $headerrow = ["Application RefNo", "Office Type", "Company Name", "Training provider Name", "Branch Name","Site location","Application type", "Application Status", "Certification Status", "Grade", 
        // "Site Audit Scheduled on","Date of Expiry", "Added on", "Last Updated on"];
        $headerrow=array();
        $showhide = explode( ',' , $_GET['showCol']);
       
       
        if(in_array('appdt_appreferno', $showhide)){
            array_push($headerrow,"Application Ref. No.");  
        }
        if(in_array('appiit_officetype', $showhide)){
            array_push($headerrow,"Office Type");  
        }
        if(in_array('omrm_companyname_en', $showhide)){
            array_push($headerrow,"Company Name");  
        }
        if(in_array('omrm_tpname_en', $showhide) && $projectpk == 1){
            array_push($headerrow,"Training Provider Name");  
        }
        if(in_array('omrm_branch_en', $showhide) && $projectpk == 4){
            array_push($headerrow,"Centre Name");  
        }
        if(in_array('appiit_branchname_en', $showhide) && $projectpk == 1){
            array_push($headerrow,"Branch Name");  
        }
        if(in_array('sitelocan', $showhide)){
            array_push($headerrow,"Site Location");  
        }
        
        if(in_array('appdt_apptype', $showhide)){
            array_push($headerrow,"Application Type");  
        }
        if(in_array('appdt_status', $showhide)){
            array_push($headerrow,"Application Status");  
        }
        if(in_array('appdt_certificategenon', $showhide)){
            array_push($headerrow,"Certification Status");  
        }
        if(in_array('appdt_grademst_fk', $showhide) && $projectpk == 1){
            array_push($headerrow,"Grade");  
        }
        if(in_array('asd_date', $showhide)){
            array_push($headerrow,"Site Audit Scheduled On");  
        }
        if(in_array('appdt_certificateexpiry', $showhide)){
            array_push($headerrow,"Date Of Expiry");  
        }
        if(in_array('appdt_submittedon', $showhide)){
            array_push($headerrow,"Added On");  
        }
        if(in_array('appdt_updatedon', $showhide)){
            array_push($headerrow,"Last Updated On");  
        }
      
         if($projectpk == 1){
            $filename = "TrainingEvalutionCentreApproval".date('Ymdhis').".csv";
         }else{
            $filename = "RasCentreApproval".date('Ymdhis').".csv";
         }
     
        ob_end_clean();
        header('Content-type: application/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');     
        $fp = fopen('php://output', 'w');
        fputcsv($fp, $headerrow);
         if (count($dataModel) > 0) {
            foreach ($dataModel as $result) {
                fputcsv($fp, $result);
            }
            fclose($fp);
//return ob_get_clean();
        }
        exit;
    }


    public function actionCoursedownloadlist()
    {
       $search= $_REQUEST['search'];
       if($search != 'undefined'){
        $ser = json_decode($search, true);
       }else{
        $ser = [];
       }
       
      $dataModel =  \app\models\ApplicationdtlstmpTbl::getcourseexportlist($ser);
      $headerrow = ['Application Ref. No.', 'Training Provider Name', 'Office Type', 'Branch Name', 'Site Location', 'Course Type', 'Course Title', 'Course Category', 'Course Sub-Categories', 'Application Type', 'Application Status', 'Certification Status','Site Audit Scheduled On', 'Date of Expiry', 'Added On', 'Last Updated On'];
        $filename = "CourseApproval".date('Ymdhis').".csv";
        ob_end_clean();
        header('Content-type: application/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');     
        $fp = fopen('php://output', 'w');
        fputcsv($fp, $headerrow);
         if (count($dataModel) > 0) {
            foreach ($dataModel as $result) {
                fputcsv($fp, $result);
            }
            fclose($fp);
        } 
        exit; 
         
    }

    public function actionGetstaffschedule(){
        $formatedData = \app\models\AuditscheduleTbl::getStaff();
       return $this->asJson([
              'data' => $formatedData,
              'msg' => 'Success',
              'status' => 100,
          ]);
    }


    public function actionSavescheduledate(){
        

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $staffid = $request['data']['staffname'];
        
        $startdate = $request['data']['startString'];
        $enddate   = $request['data']['endString'];
        $project   = $request['data']['projectpk'];
        $projectid = Security::decrypt($project);
        $datePeriod = $this->returnDates($startdate, $enddate);
        foreach ($datePeriod as $date) {
            $data = AuditscheduleTbl::find()->where(['=', 'asd_opalusermst_fk', $staffid])->andWhere(['=', 'asd_projectmst_fk', $projectid])->andWhere(['=', 'asd_date', $date])->count();
           
            if ((int)$data > 0) {
                $response = ['status' => 2, 'data' => '', 'msg' => 'Failure'];
                return $this->asJson($response);
            }
        }
        
        foreach($datePeriod as $date) {
        $requestdata['asd_opalmemberregmst_fk'] = $regPk;
        $requestdata['asd_opalusermst_fk'] = $staffid;
        $requestdata['asd_isavailable'] = 1;
        $requestdata['asd_date'] = $date;
        $requestdata['asd_projectmst_fk'] = $projectid;
        $requestdata['asd_createdby'] = $userPk;
        $requestdata['asd_createdon'] = date("Y-m-d H:i:s");
        $response = [];
        $data = AppCenter::saveAppscheduledate($requestdata);       
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }

       }
   
        
        return $this->asJson($response);
    }


    public function returnDates($strDateFrom, $strDateTo) {

       
        $step = '+1 day';
        $output_format = 'Y-m-d';
        $dates = array();
        $current = strtotime($strDateFrom);
        $last = strtotime($strDateTo);
    
        while( $current <= $last ) {
    
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
            return $dates;
    }

    public function actionChangestatus(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $pk = $request['id'];
        $status = $request['status'];
            $model = \app\models\AuditscheduleTbl::find()->where(['auditscheddtls_pk' => $pk])->one();
            if($model){
                    $model->asd_isavailable =  $status;
                    $model->asd_updatedon = date("Y-m-d H:i:s");
                    $model->asd_updatedby = $userPk;
                if ($model->save() === TRUE) {
                    
                    $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
                } else {
                    $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
                }
            } 
            return $this->asJson($response);
    }

    public function actionGetstaffauditor(){

        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $pk = $request['staffid'];
        $response = [];
        $auditdata =  \app\models\AuditscheduleTbl::find()->where(['auditscheddtls_pk' => $pk])->asArray()->one();
        

        $data = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
        ->select(['*'])
        ->leftJoin('projapprovalworkflowhrd_tbl hrd','hrd.projapprovalworkflowhrd_pk = pawfud_projapprovalworkflowhrd_fk')
        ->leftJoin('projapprovalworkflowdtls_tbl ins','ins.projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk')
        ->leftJoin('opalusermst_tbl  user','user.opalusermst_pk = pawfud_opalusermst_fk')
        ->leftJoin('auditscheddtls_tbl  audit','audit.asd_opalusermst_fk = pawfud_opalusermst_fk')
        ->Where(['pawfd_rolemst_fk'=> 5])
        ->andWhere(['pawfh_projectmst_fk'=>  $auditdata['asd_projectmst_fk']])
        ->andWhere(['pawfh_formstatus'=> 1])
        ->andWhere(['asd_isavailable'=> 1])
        ->andWhere(['asd_date'=> $auditdata['asd_date']])
        ->andWhere(['oum_status'=> 'A'])
        ->andWhere(['<>','pawfud_opalusermst_fk',$auditdata['asd_opalusermst_fk']])
        ->groupBy('opalusermst_pk')
         ->asArray()
         ->all();

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }

    public function  actionChangestaff(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $staffid = $request['staffid']['staffname'];
        
           $pk = $request['pk'];
            $model = \app\models\AuditscheduleTbl::find()->where(['auditscheddtls_pk' => $pk])->one();
           
            $newdata = AuditscheduleTbl::find()
                    ->where(['asd_opalusermst_fk' => $staffid])
                    ->andwhere(['=','asd_projectmst_fk',1])
                    ->andWhere(['asd_date' => $model['asd_date']])
                    ->one();
         
            $tempModel = \app\models\AppauditschedtmpTbl::findOne($model['asd_appauditschedtmp_fk']);
              
            if($model){
                    $model->asd_isavailable =  1;
                    $model->asd_appauditschedtmp_fk =  null;
                    $model->asd_updatedon = date("Y-m-d H:i:s");
                    $model->asd_updatedby = $userPk;
                    if($model->save())
                    {
                        $oldstaff = $model->auditscheddtls_pk;
                    }
                    else
                    {
                        echo "<pre>";
                        var_dump($model->getErrors());
                        exit;
                    }
            }
            
            if($newdata)
            {
                   $newdata->asd_isavailable =  3;
                    $newdata->asd_appauditschedtmp_fk = $tempModel->appauditschedtmp_pk;
                    $newdata->asd_updatedon = date("Y-m-d H:i:s");
                    $newdata->asd_updatedby = $userPk;
                    if($newdata->save())
                    {
                        $newstaff = $newdata->auditscheddtls_pk;
                    }
                    else
                    {
                        echo "<pre>";
                        var_dump($newdata->getErrors());
                        exit;
                    }
            }
         
            if($tempModel)
            {
                    $tempModel->appasdt_auditscheddtls_fk = $newdata->auditscheddtls_pk;
                    $tempModel->appasdt_updatedby = $userPk;
                    $tempModel->appasdt_updatedon = date("Y-m-d H:i:s");
                   
                    if($tempModel->save())
                    {
                        $appschedule = $tempModel->appauditschedtmp_pk;
                    }
                    else
                    {
                        echo "<pre>";
                        var_dump($tempModel->getErrors());
                        exit;
                    }
            }
           
           
            
            if($oldstaff && $newstaff && $appschedule)
            {
                 $response = ['status' => 1,'data' => $model['asd_projectmst_fk'],'msg' => 'Success'];
            }
            else {
                    
                    $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
                }
            
            
            return $this->asJson($response);
    }

    public function actionGetsitedata(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $appDtlsPk = $request['apptempPk'];
        $interId = Security::decrypt($appDtlsPk);
        $username =  \yii\db\ActiveRecord::getTokenData('oum_firstname', true); 
        $data = \app\models\OpalsitecategoryTbl::find()
        
        ->select(['*','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon','DATE_FORMAT(appdt_certificategenon,"%d-%m-%Y") AS appdt_certificategenon','DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon' ,'DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry','DATE_FORMAT(appdt_certificateexpiry,"%m-%d-%Y") AS appdt_certificateexpiry_org','DATE_FORMAT(appdt_appdecon,"%d-%m-%Y") AS appdt_appdecon'])
        ->leftJoin('appauditschedtmp_tbl schedtmp','schedtmp.appauditschedtmp_pk = asarct_appauditschedtmp_fk')
        ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = schedtmp.appasdt_applicationdtlstmp_fk')
        ->leftJoin('appinstinfotmp_tbl ins','ins.appiit_applicationdtlstmp_fk = schedtmp.appasdt_applicationdtlstmp_fk')
        ->leftJoin('opalmemberregmst_tbl mem','mem.opalmemberregmst_pk = app.appdt_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl user','user.opalusermst_pk = appdt_appdecby')
        ->Where(['appasdt_applicationdtlstmp_fk'=>$interId])
        ->orderBy('asarct_order asc')
        ->asArray()
        ->all();

        $auditschmodel   =   \app\models\AppauditschedtmpTbl::find()
        ->select(['DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date'])
        ->leftJoin('auditscheddtls_tbl sch','sch.auditscheddtls_pk = appauditschedtmp_tbl.appasdt_auditscheddtls_fk')
        ->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $interId])
        ->orderBy(["appauditschedtmp_pk" => SORT_DESC])->asArray()->one();
        if($data){
          
            $response = ['status' => 1,'data' => $data,'username' => $data[0]['oum_firstname'],'schdate' => $auditschmodel['asd_date'],'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetsiteauditordata(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = $request['staffid'];
        $data = \app\models\AuditscheduleTbl::find()
        ->select(['*','DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date'])
        ->leftJoin('opalmemberregmst_tbl mem','mem.opalmemberregmst_pk = asd_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl user','user.opalusermst_pk = asd_opalusermst_fk')
        ->leftJoin('appauditschedtmp_tbl dtls','dtls.appauditschedtmp_pk = asd_appauditschedtmp_fk')
        ->Where(['auditscheddtls_pk'=>$id])
        ->asArray()
        ->one();


        $comdata = \app\models\AuditscheduleTbl::find()
        ->select(['*','DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date'])
        ->leftJoin('appauditschedtmp_tbl dtls','dtls.appauditschedtmp_pk = asd_appauditschedtmp_fk')
        ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = appasdt_applicationdtlstmp_fk')
         ->leftJoin('opalmemberregmst_tbl mem','mem.opalmemberregmst_pk = appdt_opalmemberregmst_fk')
        ->Where(['appasdt_applicationdtlstmp_fk'=>$data['appasdt_applicationdtlstmp_fk']])
        ->asArray()
        ->one();
   
        if($data){
            $response = ['status' => 1,'data' => $data,'comdata' => $comdata,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetsitequestionsdata(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = $request['catid'];
        $questiondata = \app\models\OpalsiteanswerTbl::find()
        ->select(['*'])
        ->leftJoin('appsiteauditquestionmsttmp_tbl ques','ques.appsiteauditquestionmsttmp_pk = asaad_auditquestionmst_fk')
        ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = asaqm_fileupload')
        ->leftJoin('appsiteauditreportcattmp_tbl  category','category.appsiteauditreportcattmp_pk = asaqm_appsiteauditreportcattmp_fk')  
        ->Where(['asaqm_appsiteauditreportcattmp_fk'=>$id])
        ->orderBy('asaqm_order asc')
        ->groupBy('asaad_auditquestionmst_fk')
        ->asArray()
        ->all();
      //  print_R($questiondata);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
      
        foreach ($questiondata as $key => $favResData) {
         $driveImg  =   \api\components\Drive::generateUrl($favResData['asaqm_fileupload'],$companypk,$userpk);
         
          $favData[$key] = $favResData;
          $favData[$key]['coverImages'] = $driveImg; 
          $favData[$key]['commentbox'] =  $favResData['asaqm_comments'] == '' ? false : true;
          $favData[$key]['quesview'] = true;
          $favData[$key]['dbcomment'] =  $favResData['asaqm_comments'];
        }
       

        $answerdata = \app\models\OpalsiteanswerTbl::find()
        ->select(['*'])
        ->leftJoin('appsiteauditquestionmsttmp_tbl ques','ques.appsiteauditquestionmsttmp_pk = asaad_auditquestionmst_fk')
        ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = asaqm_fileupload')
        ->leftJoin('appsiteauditreportcattmp_tbl  category','category.appsiteauditreportcattmp_pk = asaqm_appsiteauditreportcattmp_fk') 
        ->Where(['asaqm_appsiteauditreportcattmp_fk'=>$id])
        ->orderBy('asaqm_order asc')
      //  ->groupBy('asaad_auditquestionmst_fk')
        ->asArray()
        ->all();

        foreach ($answerdata as $key => $favResData) {
            $driveImg  =   \api\components\Drive::generateUrl($favResData['asaqm_fileupload'],$companypk,$userpk);
            
             $favDataA[$key] = $favResData;
             $favDataA[$key]['coverImages'] = $driveImg; 
             $favDataA[$key]['commentbox'] =  $favResData['asaqm_comments'] == '' ? false : true;
             $favDataA[$key]['quesview'] = true;
             $favDataA[$key]['dbcomment'] =  $favResData['asaqm_comments'];
           }
           $data = \app\models\Appsiteauditreportcattmptbl::find()
           ->select(['appasdt_applicationdtlstmp_fk','appdt_auditedreport'])
           ->leftJoin('appauditschedtmp_tbl','appauditschedtmp_pk = asarct_appauditschedtmp_fk')
           ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appasdt_applicationdtlstmp_fk')
           ->where('appsiteauditreportcattmp_pk = '.$id)->asArray()->one();

        if($questiondata){
            $response = ['status' => 1,'data' => $favData,'Adata' => $favDataA,'msg' => 'Success','url'=> $data['appdt_auditedreport']
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure','url'=> $data['appdt_auditedreport']
            ]; 
        }

      
        
        // $generate = SiteAudit::generatesiteauditreport($data['appasdt_applicationdtlstmp_fk']);
        
        return $this->asJson($response);
    }
    public function actionGetavailabledate()
    {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = AuditscheduleTbl::getAvailableDate($request['projectpk']);
        if($data)
        {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        }else{
            $response = ['status' => 2,'data' => [],'msg' => 'Failure']; 
        }        
        return $this->asJson($response);
    }
    public function actionSavesiteaudit(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $apptmpPk=$request['apptempPk'];
        $applicadetails = \app\models\ApplicationdtlstmpTbl::find()
        ->leftJoin('appinstinfotmp_tbl', 'applicationdtlstmp_tbl.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
        ->select(['appdt_status', 'appdt_apptype','appdt_projectmst_fk']) // Select both columns
        ->andWhere("find_in_set($apptmpPk, applicationdtlstmp_pk)")
        ->asArray()
        ->one();
    
        $appStatus = $applicadetails['appdt_status'];  
        $appType = $applicadetails['appdt_apptype']; 
        $projpk = $applicadetails['appdt_projectmst_fk']; 

        $data = AuditscheduleTbl::saveSiteAudit($request['data']['request_date'],$request['apptempPk'],$request['projPk']);        
        $response = ['status' => 1,'data' => $data];      
        
       
        if($appStatus==8 && $appType==1 && $projpk == 1 ){
            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'tpconfrimdt');
            }  
      
         
        if($appStatus==8 && $appType==2 && $projpk == 1 ){
            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'retpconfrimdt');     
        }  

         if($projpk==2){ 
        
                $craudcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 1 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 5 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $craudcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $craud = $craudcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                  
                         foreach ($craud as $craudrow) {
                        $id = $craudrow['oum_emailid'];
                        $name = $craudrow['oum_firstname'];     

                 if($projpk==2 || $projpk==3){
                      if($appStatus==8 && $appType==1){
                      \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crconfrimdt');       
                      }
                  } 
               }
           
            } 

        if($projpk==3){
        $craud=\app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                   ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 3 ,'pawfd_rolemst_fk' => 5 ,'oum_status'=>'A'])
            ->groupBy(['opalusermst_pk'])
            ->asArray()
            ->all();
        $id = [];
        $name = [];
        foreach ($craud as $craudrow) {
        $id = $craudrow['oum_emailid'];
        $name = $craudrow['oum_firstname'];     

         if($projpk==2 || $projpk==3){
               if($appStatus==8 && $appType==1){
               \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crconfrimdt');       
               }
           } 
        }
        }
        
         if($projpk==2){ 
        
                $rencraudcommand = \Yii::$app->db->createCommand("SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 4 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 5 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $rencraudcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $rencraud = $rencraudcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                  foreach ($rencraud as $rencraudrow) {
                    $id = $rencraudrow['oum_emailid'];
                    $name = $rencraudrow['oum_firstname'];     

                     if($projpk==2 || $projpk==3){
                           if($appStatus==8 && $appType==2){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrconfrimdt');       
                           }
                       } 
                    }
           
            } 
        
        
        
        
        if($projpk==3){
         $rencraud=\app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 3,'pawfd_rolemst_fk' => 5 ,'oum_status'=>'A'])
            ->groupBy(['opalusermst_pk'])
            ->asArray()
            ->all();
        $id = [];
        $name = [];
        foreach ($rencraud as $rencraudrow) {
        $id = $rencraudrow['oum_emailid'];
        $name = $rencraudrow['oum_firstname'];     

         if($projpk==2 || $projpk==3){
               if($appStatus==8 && $appType==2){
               \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrconfrimdt');       
               }
           } 
        }
        }
        
         if($projpk==2){ 
        
                $updcraudcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 5 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $updcraudcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $updcraud = $updcraudcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                      foreach ($updcraud as $updcraudrow) {
                        $id = $updcraudrow['oum_emailid'];
                        $name = $updcraudrow['oum_firstname'];     

                         if($projpk==2 || $projpk==3){
                               if($appStatus==8 && $appType==3){
                               \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrconfrimdt');       
                               }
                           } 
                        }
            } 
        
        
        if($projpk==3){
         $updcraud=\app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => 3 ,'pawfd_rolemst_fk' => 5 ,'oum_status'=>'A'])
            ->groupBy(['opalusermst_pk'])
            ->asArray()
            ->all();
        $id = [];
        $name = [];
        foreach ($updcraud as $updcraudrow) {
        $id = $updcraudrow['oum_emailid'];
        $name = $updcraudrow['oum_firstname'];     

         if($projpk==2 || $projpk==3){
               if($appStatus==8 && $appType==3){
              \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrconfrimdt');       
               }
           } 
        }
        }
        
        
        
        
        return $this->asJson($response);
        
    }
    public function actionGetsiteauditdate(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = AuditscheduleTbl::getSiteAuditDate($request['apptempPk']);        
        $response = ['status' => 1,'data' => $data];      
        return $this->asJson($response);
    }

    public function actionGetmaindtls(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $temp_pk = $request['temp_pk'];
        $type = $request['type'];

        $data = \app\models\ApplicationdtlsmainTbl::find()
        ->select(['*','DATE_FORMAT(appdm_certificategenon,"%d-%m-%Y") AS certificategenon',
                        'DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") AS certificateexpiry'])
        ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk')
        ->where(['appiit_officetype' => $type])
        ->where(['appdm_applicationdtlstmp_fk' => $temp_pk])
        ->asArray()->one();
        $srcDirectory=Yii::$app->params['srcDirectory'];

        $responseData=Array();
        //echo '<pre>';print_r($data);exit;
        if($data){
            $responseData['cert_status'] = "New";
            if(!empty($data['appdm_certificategenon'])){
                $responseData['cert_status'] = "Active";
            }

            if(date('Y-m-d', strtotime($data['appdm_certificateexpiry'])) < date('Y-m-d', strtotime(date("Y/m/d")))){
                $responseData['cert_status'] = "Expired";
            }
            
            if(empty($data['appdm_certificategenon'])){
                $responseData['cert_status'] = "New";
            } 
        }

        $responseData['exp_date'] = $data['certificateexpiry'];

 $now = time(); // or your date as well
        $your_date = strtotime($data['appdm_certificateexpiry']);
        $datediff = $your_date - $now;
        $renewDate = round($datediff / (60 * 60 * 24));
        $responseData['renew_date']   =  $renewDate + 1;
        $responseData['overdue_date'] =  abs($renewDate + 1);        $srcDirectory=Yii::$app->params['srcDirectory'];

        $cert_path=Yii::$app->params['opal_cert_path'];

        $responseData['opal_cert_path']=$cert_path.'cert.pdf';
        $responseData['dataall']=$data;

        
        if($data){
            $response = ['status' => 1,
                        'data' => $responseData,
                        'msg' => 'Success',
                        'baseUrl' =>  $srcDirectory];
        } else{
           $response = ['status' => 2,
                        'data' => '',
                        'msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }
    public function actionGetmaindtlsras(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $temp_pk = $request['temp_pk'];
        $type = $request['type'];

        $data = \app\models\ApplicationdtlsmainTbl::find()
        ->select(['*','DATE_FORMAT(appdm_certificategenon,"%d-%m-%Y") AS certificategenon',
                        'DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") AS certificateexpiry'])
        ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk')
        ->where(['appdm_applicationdtlstmp_fk' => $temp_pk])
        ->asArray()->one();
        $srcDirectory=Yii::$app->params['srcDirectory'];

        $responseData=Array();
        //echo '<pre>';print_r($data);exit;
        if($data){
            $responseData['cert_status'] = "New";
            if(!empty($data['appdm_certificategenon'])){
                $responseData['cert_status'] = "Active";
            }

            if(date('Y-m-d', strtotime($data['appdm_certificateexpiry'])) < date('Y-m-d', strtotime(date("Y/m/d")))){
                $responseData['cert_status'] = "Expired";
            }
            
            if(empty($data['appdm_certificategenon'])){
                $responseData['cert_status'] = "New";
            } 
        }

        $responseData['exp_date'] = $data['certificateexpiry'];

 $now = time(); // or your date as well
        $your_date = strtotime($data['appdm_certificateexpiry']);
        $datediff = $your_date - $now;
        $renewDate = round($datediff / (60 * 60 * 24));
        $responseData['renew_date']   =  $renewDate + 1;
        $responseData['overdue_date'] =  abs($renewDate + 1);        $srcDirectory=Yii::$app->params['srcDirectory'];

        $cert_path=Yii::$app->params['opal_cert_path'];

        $responseData['opal_cert_path']=$cert_path.'cert.pdf';
        $responseData['dataall']=$data;

        
        if($data){
            $response = ['status' => 1,
                        'data' => $responseData,
                        'msg' => 'Success',
                        'baseUrl' =>  $srcDirectory];
        } else{
           $response = ['status' => 2,
                        'data' => '',
                        'msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionGetappcenterdtls(){
        $response = [];
        //$data = \app\models\AppintrecogtmpTbl::getInterRecDtls($_REQUEST);
        $data = \app\models\ApplicationdtlstmpTbl::getAppbranchDtls($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionDeletequestions(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $model = \app\models\OpalsiteanswerTbl::deleteAll('asaad_auditquestionmst_fk = '.$data['pk']);
        $model = \app\models\OpalsitequestionTbl::deleteAll('appsiteauditquestionmsttmp_pk = '.$data['pk']);
     
        return true;
    }

    public function actionSavequestion(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);



        $requestdt['appsiteauditreportcattmp_pk'] = $request['comdtls']['appsiteauditreportcattmp_pk'];
        $requestdt['asarct_bronze'] = $request['comdtls']['asarct_bronze'];
        $requestdt['asarct_gold'] = $request['comdtls']['asarct_gold'];
        $requestdt['asarct_silver'] = $request['comdtls']['asarct_silver'];
        $requestdt['asarct_totalques'] = $request['comdtls']['asarct_totalques'];
        $requestdt['asarct_grademst_fk'] = $request['comdtls']['asarct_grademst_fk'];

       // save category
      
        $catdata = AppCenter::saveAppCategory($requestdt);
      
      
      
    
        foreach($request['comdtls']['gradearray'] as $key => $value){
            $cur_index = -1;
            $cur_val_pk = 0; 
            foreach( $value as $data){
                // print_r($value);
                $data_array = explode('_', $data);
                if($data_array[0] > $cur_index) {
                    $cur_index = $data_array[0];
                    $cur_val_pk = $data_array[1];
                }
               
             }
           
             $grade[$cur_val_pk] = $cur_index+1;
            // print_R($grade);
   
        }
         //print_R($grade);

 //  print_r($request['comdtls']);
        foreach($request['comdtls']  as $key => $value){
            if($value){
                $requestdata1 = [];
                 $keyexplode =  explode("_", $key);
                  //question tbl save
                 // echo 'file_'.$keyexplode[1].'-----'. $request['comdtls']['file_'.$keyexplode[1]].'</br>';
                   
                    if($keyexplode[0] == 'editquestion'){
                        $requestdata1['asaqm_question_en'] = $value;
                        $requestdata1['appsiteauditquestionmsttmp_pk'] = $keyexplode[1];
                    }
                    if($keyexplode[0] == 'editquestiondesc'){
                        $requestdata1['asaqm_quesdesc_en'] = $value;
                        $requestdata1['appsiteauditquestionmsttmp_pk'] = $keyexplode[1];
                    } 
                    if($keyexplode[0] == 'editcomment'){
                        $requestdata1['asaqm_comments'] = $value;
                        $requestdata1['appsiteauditquestionmsttmp_pk'] = $keyexplode[1];
                    } 
                    if($keyexplode[0] == 'file'){
                       // echo 'file_'.$keyexplode[1];    
                        $requestdata1['asaqm_fileupload'] = $request['comdtls']['file_'.$keyexplode[1]];
                        $requestdata1['appsiteauditquestionmsttmp_pk'] = $keyexplode[1];
                    } 
               
              // print_R($requestdata1);
              
                    $data = AppCenter::saveAppQuestion($requestdata1);

                    //answer tbl sav
                    if($keyexplode[0] == 'checkbox'){
                        AppCenter::resetgrade($keyexplode[1]);
                        $requestdata['appsiteauditanswerdtls_pk'] = $keyexplode[1];
                        $requestdata['asaad_isselected'] = $value;
                      //  $requestdata['asaad_grademst_fk'] =  $grade[$keyexplode[1]]; 
                        $data[] = AppCenter::saveAppAnswer($requestdata);
                       
                    }

                    if($keyexplode[0] == 'radio'){
                        AppCenter::resetanswer($keyexplode[1]);
                        $requestdata['appsiteauditanswerdtls_pk'] = $value;
                        $requestdata['asaad_isselected'] = 1;
                      //  $requestdata['asaad_grademst_fk'] =  $grade[$value]; 
                        $data[] = AppCenter::saveAppAnswer($requestdata);
                       
                    }
                  
                   
                }
               
        }

  //updategrade
         $data = AppCenter::updategrade($grade);
             $response = [];
    
        if(true){
            $response = ['status' => 1,'data' => $catdata+1,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionRoleaccess(){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $usermst =\app\models\OpalusermstTbl::find()
        ->select(['*'])        
        ->Where(['opalusermst_pk'=>$userPk])
        ->andWhere("oum_isfocalpoint = '2'")
        ->andWhere("oum_opalmemberregmst_fk = '1'")
        ->asArray()
        ->one();
    
        // $role = explode(',', $usermst['oum_rolemst_fk']);
       // $status = false;
        $accessadmin = false;
        if($usermst){
            $accessadmin= true;
        }
        // if(in_array(1,$role) || in_array(3,$role) || in_array(5,$role)){
        //     $status = true;
        // }else{
        //     $status = false;

        // }

        $accesssuperadmin = OpalusermstTbl::find()
        ->select(['opalusermst_pk'])
        ->where("opalusermst_pk = '$userPk'")
        ->andWhere("oum_isfocalpoint = '1'")
        ->andWhere("oum_opalmemberregmst_fk = '1'")
        ->andWhere("oum_status = 'A'")
        ->asArray()
        ->one();
        $accesssuperadmin = ($accesssuperadmin)?true:false;

        $response = ['admin' => $accessadmin,'superadmin' => $accesssuperadmin];
        return  $this->asJson($response);
    }


    public function actionUserterevedtls(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);

        $response = [];
        $projecttype =$request['projectType'];

        $dataTmp = \app\models\ApplicationdtlstmpTbl::find()
        ->select(['*'])
        ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
        ->where(['appdt_opalmemberregmst_fk' => $request['memReg']])
        ->andwhere(['appdt_projectmst_fk' =>  $projecttype])
        ->orderBy(['applicationdtlstmp_pk' => SORT_ASC])
        ->asArray()->one();

        $data = \app\models\ApplicationdtlsmainTbl::find()
        ->select(['*','DATE_FORMAT(appdm_certificategenon,"%d-%m-%Y") AS certificategenon',
                        'DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") AS certificateexpiry'])
        ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk')
        ->where(['appdm_opalmemberregmst_fk' => $request['memReg']])
        ->andwhere(['appdm_projectmst_fk' =>$projecttype])
        ->orderBy(['applicationdtlsmain_pk' => SORT_ASC])
        ->asArray()->one();
        
        
        $responseData['cert_status'] = "New";
        if(!empty($data['appdm_certificategenon'])){
            $responseData['cert_status'] = "Active";
        }

        if(date('Y-m-d', strtotime($data['appdm_certificateexpiry'])) < date('Y-m-d', strtotime(date("Y/m/d")))){
            $responseData['cert_status'] = "Expired";
        }
        
        if(empty($data['appdm_certificategenon'])){
            $responseData['cert_status'] = "New";
        } 

        $responseData['exp_date'] = $data['certificateexpiry'];

        $now = time(); // or your date as well
        $your_date = strtotime($data['appdm_certificateexpiry']);
        $datediff = $your_date - $now;
        $renewDate = round($datediff / (60 * 60 * 24));
        $responseData['renew_date'] = $renewDate + 1;
        $responseData['overdue_date'] = abs($renewDate + 1);

        $cert_path=Yii::$app->params['opal_cert_path'];
        //echo '<pre>';print_r($dataTmp);exit;
        //echo $dataTmp->appdt_certificatepath;exit;
        $responseData['opal_cert_path']=$cert_path.$dataTmp['appdt_certificatepath'];
        $responseData['opal_siteaudit_path1']=$cert_path.$dataTmp['appdt_auditedreport'];
        $responseData['opal_siteaudit_path']=$cert_path.$data['appdm_auditedreport'];
        $responseData['appdt_certificatepath']=$dataTmp['appdt_certificatepath'];

        if($data){
            $response = ['status' => 1,
                        'data' => $data,
                        'msg' => 'Success',
                        'dataTmp' => $dataTmp,
                        'response' => $responseData];
        } else {
            $response = ['status' => 2,
                            'data' => '',
                            'data1'=>$dataTmp,
                            'msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionUserbranchdtls(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $response = [];
        
        $dataTmp = \app\models\ApplicationdtlstmpTbl::find()
                                        ->select(['*'])
                                        ->where(['applicationdtlstmp_pk' => $request['apptmppk']])
                                        ->asArray()->one();

        $data = \app\models\ApplicationdtlsmainTbl::find()
                                        ->select(['*','DATE_FORMAT(appdm_certificategenon,"%d-%m-%Y") AS certificategenon',
                                                        'DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") AS certificateexpiry'])
                                        ->where(['appdm_applicationdtlstmp_fk' => $request['apptmppk']])
                                        ->asArray()->one();

        
        $responseData['cert_status'] = "New";
        if(!empty($data['appdm_certificategenon'])){
            $responseData['cert_status'] = "Active";
        }

        if(date('Y-m-d', strtotime($data['appdm_certificateexpiry'])) < date('Y-m-d', strtotime(date("Y/m/d")))){
            $responseData['cert_status'] = "Expired";
        }
        
        if(empty($data['appdm_certificategenon'])){
            $responseData['cert_status'] = "New";
        } 

        $responseData['exp_date'] = $data['certificateexpiry'];

        $now = time(); // or your date as well
        $your_date = strtotime($data['appdm_certificateexpiry']);
        $datediff = $your_date - $now;
        $renewDate = round($datediff / (60 * 60 * 24));
        $responseData['renew_date']   = $renewDate + 1;
        $responseData['overdue_date'] = abs($renewDate + 1);

        $cert_path=Yii::$app->params['opal_cert_path'];
        
        $responseData['opal_cert_path']=$cert_path.$dataTmp['appdt_certificatepath'];
 $responseData['opal_siteaudit_path1']=$cert_path.$dataTmp['appdt_auditedreport']; 
        $responseData['opal_siteaudit_path']=$cert_path.$data['appdm_auditedreport'];        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success', 'dataTmp' => $dataTmp, 'response' => $responseData];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure' , 'dataTmp' => $dataTmp]; 
        }
        
        return $this->asJson($response);
    }
    public function actionGetappliacationdtls(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $app_pk =  $request['apptmppk'];

        
        $model = ApplicationdtlstmpTbl::find()
                ->select(['*','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS certificateexpiry',
                'DATE_FORMAT(appiit_createdon,"%d-%m-%Y") AS createdon',
                'DATE_FORMAT(appiit_updatedon,"%d-%m-%Y") AS updatedon'])
                ->leftJoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
                ->where(["applicationdtlstmp_pk" => $app_pk])
                ->asArray()->one();
        return ['data'=>$model];
    }
    public function actionGetgrademst()
    {
        $response = [];
        $data =  \app\models\GrademstTbl::getGradeMst();
        if($data)
        {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        }else{
            $response = ['status' => 2,'data' => [],'msg' => 'Failure']; 
        }        
        return $this->asJson($response);
    }

    public function actionGetdecstatus(){

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $decStatus = "";
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        // $dataTmp = \app\models\ApplicationdtlstmpTbl::find()
        //                 ->where(['applicationdtlstmp_pk' => $request['apptmppk'] , 'appdt_status' => 3])
        //                 ->asArray()->all();
        $dataTmpComp = \app\models\AppcompanydtlstmpTbl::find()
                        ->where(['acdt_applicationdtlstmp_fk' => $request['apptmppk'] , 'acdt_status' => 4])
                        ->asArray()->all();
        $dataIns = \app\models\AppinstinfotmpTbl::find()
                        ->where(['appiit_applicationdtlstmp_fk' => $request['apptmppk'] , 'appiit_status' => 4])
                        ->asArray()->all(); 
        $dataInterRes = \app\models\AppintrecogtmpTbl::find()
                        ->where(['appintit_applicationdtlstmp_fk' => $request['apptmppk'] , 'appintit_status' => 4])
                        ->asArray()->all(); 
        $dataOpr = \app\models\AppoprcontracttmpTbl::find()
                        ->where(['appoprct_applicationdtlstmp_fk' => $request['apptmppk'] , 'appoprct_status' => 4])
                        ->asArray()->all();
        $dataDoc = \app\models\AppdocsubmissiontmpTbl::find()
                        ->where(['appdst_applicationdtlstmp_fk' => $request['apptmppk'] , 'appdst_status' => 4])
                        ->asArray()->all();
        $dataCour = \app\models\AppoffercoursetmpTbl::find()
                        ->where(['appoct_applicationdtlstmp_fk' => $request['apptmppk'] , 'appoct_status' => 4])
                        ->asArray()->all();
        $dataStaff = \app\models\AppstaffinfotmpTbl::find()
                        ->where(['appsit_applicationdtlstmp_fk' => $request['apptmppk'] , 'appsit_status' => 4])
                        ->asArray()->all();                        
        
        
        if(!empty($dataTmpComp) || !empty($dataIns) || !empty($dataInterRes) || !empty($dataOpr) || !empty($dataDoc) || !empty($dataCour) || !empty($dataStaff)){
            $decStatus = true;
        }
        $response = [];
        if($decStatus){
            $response = ['status' => 1,'data' => $decStatus,'msg' => 'Success'];
        } else {
            $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionDeletelogo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usedp = $this->deleteuserdp($data['filePk']);
        $msg['msg'] = 'failure';
        $msg['status'] = 0;
        if($usedp){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        return $this->asJson($msg);
    }

    public function deleteuserdp($filePk){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $model = \app\models\OpalmemberregmstTbl::findOne($regPk);
        $model->omrm_cmplogo = (count($filePk) > 0) ? end($filePk) : null;
        return $model->save();
    }
     // Api for Standard & Customized Course Approval
        
     public function actionGetstandardcourselist() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = Security::decrypt($request['auditschedtmpid']);
        $data = SiteAudit::siteauditList($id);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetstandardcoursemstlist() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = $request['catid'];
        $data = SiteAudit::siteAuditMstList('2');

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetsccsitedata() {
        $response = [];
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $Id = Security::decrypt($request['apptempPk']);
        $data = SiteAudit::siteauditstatus($Id);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }
    
    public function actionSavescsiteaudit() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $Id = Security::decrypt($request['temp_pk']);

        $data = SiteAudit::saveAppsiteaudit($request);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }
    public function actionDeletecategorywithquestions() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $Id = Security::decrypt($request['categoryId']);
        $data = SiteAudit::deleteAppsiteauditreportcattmp($Id);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);

    }

    public function actionDeletequestionwithrelatedanswers() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $Id = Security::decrypt($request['questionId']);
        $data = SiteAudit::deleteAppsiteauditquestionmst($Id);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);

    }

    public function actionStaffsiteauditlist() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $Id = Security::decrypt($request['app_id']);
        $data = SiteAudit::staffinforepoList($Id);
        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }
    public function actionGetstaffpracticalassessmentlist() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        // $data = SiteAudit::getStaffPracticalAssessment();
        $data = SiteAudit::getStaffPracticalAssessmentData();
        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }
    public function actionSavestaffevaluationtmp() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $id = Security::decrypt($request['staffevaluationtemp_pk']);
        $sitid = Security::decrypt($request['appstaffinfotmp_pk']);
        
        $data = SiteAudit::saveStaffevaluationtmp($request['data'], $id, $sitid);
        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }


    public function actionGetauditdata(){
        $response = [];
        // $request_body	= file_get_contents('php://input');
    
        // $request = json_decode($request_body, true);
        $request = $_GET;
        $appDtlsPk = $request['appid'];
        $type = $request['type'];
        $interId = Security::decrypt($appDtlsPk);
        $projtype = Security::decrypt($type);  
        if($projtype == 1 || $projtype == 4){
            $auditdata = ApplicationdtlstmpTbl::find()->select(['appdt_appreferno','appiit_officetype as officetype','appdt_apptype','appdt_status','appiit_locmapurl as locmapurl','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry','DATE_FORMAT(appdt_certificateexpiry,"%m-%d-%Y") AS appdt_certificateexpiry_org','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon','DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','omrm_tpname_en','omrm_companyname_en','omrm_tpname_ar','omrm_companyname_ar','applicationdtlstmp_pk','appdt_projectmst_fk','appdt_opalmemberregmst_fk','appdt_certificategenon', 'appdm_grademst_fk','asd_date','omrm_branch_en'])
            ->leftJoin('appinstinfotmp_tbl ins','ins.appiit_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
            ->leftJoin('applicationdtlsmain_tbl main','main.appdm_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
            ->leftJoin('opalmemberregmst_tbl memreg','memreg.opalmemberregmst_pk = applicationdtlstmp_tbl.appdt_opalmemberregmst_fk')
            ->leftJoin('appauditschedtmp_tbl' ,'appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('auditscheddtls_tbl' ,'auditscheddtls_pk = appasdt_auditscheddtls_fk')
            ->where(['applicationdtlstmp_pk'=>$interId])
            ->asArray()
            ->one();
        }
        else{
            $auditdata = ApplicationdtlstmpTbl::find()->select(['appdt_appreferno','ins.appiim_officetype as officetype','appdt_apptype','appdt_status','appiim_locmapurl as locmapurl','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon','DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','omrm_tpname_en','omrm_companyname_en','omrm_tpname_ar','omrm_companyname_ar','applicationdtlstmp_pk','appdt_projectmst_fk','appdt_opalmemberregmst_fk','appdt_certificategenon','asd_date'])
            ->leftJoin('appcoursedtlstmp_tbl','applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk')
            ->leftJoin('appinstinfomain_tbl ins','appcdt_appinstinfomain_fk = ins.appinstinfomain_pk')
            ->leftJoin('applicationdtlsmain_tbl main','ins.appiim_applicationdtlsmain_fk = main.applicationdtlsmain_pk')
            ->leftJoin('opalmemberregmst_tbl memreg','memreg.opalmemberregmst_pk = applicationdtlstmp_tbl.appdt_opalmemberregmst_fk')
            ->leftJoin('appauditschedtmp_tbl' ,'appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('auditscheddtls_tbl' ,'auditscheddtls_pk = appasdt_auditscheddtls_fk')
            ->where(['applicationdtlstmp_pk'=>$interId])
            ->asArray()
            ->one();
        }
      
        if($projtype == 4 ){
       $applicationhsty = ApplicationdtlshstyTbl::find()->select(['applicationdtlshsty_pk','appdh_applicationdtlstmp_fk','appdh_applicationdtlsmain_fk','appdh_opalmemberregmst_fk','appdh_projectmst_fk','appdh_status','DATE_FORMAT(appdh_submittedon,"%d-%m-%Y") AS appdh_submittedon','DATE_FORMAT(appdh_updatedon,"%d-%m-%Y") AS appdh_updatedon','DATE_FORMAT(appdh_appdecon,"%d-%m-%Y") AS appdh_appdecon','appdh_gradingreason','appdh_apptype',
        'CASE WHEN `appdh_status` = 1 THEN "Yet to Submit for Desktop Review" 
        WHEN `appdh_status` = 2 THEN "Desktop Review Pending" 
        WHEN `appdh_status`=  3  THEN "Missing Files" 
        WHEN `appdh_status`= 4   THEN "Desktop Review Pending" 
        WHEN `appdh_status`= 5   THEN "Payment Pending" 
        WHEN `appdh_status`= 6   THEN "Confirm Payment"  
        WHEN `appdh_status` = 7 THEN "Yet to schedule for Site Audit" 
        WHEN `appdh_status`= 8  THEN "Audit Date Selection(Inspection Centre)" 
        WHEN `appdh_status`= 9   THEN "Ready for Audit" 
        WHEN `appdh_status`= 10   THEN "Quality Manager Approval Pending" 
        WHEN `appdh_status`= 11   THEN "Authority  Approval Pending"  
        WHEN `appdh_status` = 12 THEN "CEO Approval Pending" 
        WHEN `appdh_status`=  13  THEN "Site Audit Declined" 
        WHEN `appdh_status`= 14   THEN "Quality Manager Approval Pending" 
        WHEN `appdh_status`= 15   THEN "Re-Submitted for Authority Approval" 
        WHEN `appdh_status`= 16   THEN "Re-Submitted for CEO Approval" 
        WHEN `appdh_status`= 17   THEN "Approved"
        WHEN `appdh_status`= 18   THEN "Declined by finance team"
        WHEN `appdh_status`= 20   THEN "Certification Form Declined"
        WHEN `appdh_status`= 19   THEN "Suspended" END as applstatus',
        'if(appdh_status=2,null,if(appdh_status=4,null,if(appdh_status=6,null,if(appdh_status=9,null,appdh_appdecComments)))) as appdh_appdecComments'
        ])->where(['appdh_applicationdtlstmp_fk'=>$interId]);
        }else{

            $applicationhsty = ApplicationdtlshstyTbl::find()->select(['applicationdtlshsty_pk','appdh_applicationdtlstmp_fk','appdh_applicationdtlsmain_fk','appdh_opalmemberregmst_fk','appdh_projectmst_fk','appdh_status','DATE_FORMAT(appdh_submittedon,"%d-%m-%Y") AS appdh_submittedon','DATE_FORMAT(appdh_updatedon,"%d-%m-%Y") AS appdh_updatedon','DATE_FORMAT(appdh_appdecon,"%d-%m-%Y") AS appdh_appdecon','appdh_gradingreason','appdh_apptype',
            'CASE WHEN `appdh_status` = 1 THEN "Yet to Submit for Desktop Review" 
            WHEN `appdh_status` = 2 THEN "Desktop Review Pending" 
            WHEN `appdh_status`=  3  THEN "Missing Files" 
            WHEN `appdh_status`= 4   THEN "Desktop Review Pending" 
            WHEN `appdh_status`= 5   THEN "Payment Pending" 
            WHEN `appdh_status`= 6   THEN "Confirm Payment"  
            WHEN `appdh_status` = 7 THEN "Yet to schedule for Site Audit" 
            WHEN `appdh_status`= 8  THEN "Audit Date Selection(Training Provider)" 
            WHEN `appdh_status`= 9   THEN "Ready for Audit" 
            WHEN `appdh_status`= 10   THEN "Quality Manager Approval Pending" 
            WHEN `appdh_status`= 11   THEN "Authority  Approval Pending"  
            WHEN `appdh_status` = 12 THEN "CEO Approval Pending" 
            WHEN `appdh_status`=  13  THEN "Site Audit Declined" 
            WHEN `appdh_status`= 14   THEN "Quality Manager Approval Pending" 
            WHEN `appdh_status`= 15   THEN "Re-Submitted for Authority Approval" 
            WHEN `appdh_status`= 16   THEN "Re-Submitted for CEO Approval" 
            WHEN `appdh_status`= 17   THEN "Approved"
            WHEN `appdh_status`= 18   THEN "Declined by finance team"
            WHEN `appdh_status`= 20   THEN "Certification Form Declined"
            WHEN `appdh_status`= 19   THEN "Suspended" END as applstatus',
            'if(appdh_status=2,null,if(appdh_status=4,null,if(appdh_status=6,null,if(appdh_status=9,null,appdh_appdecComments)))) as appdh_appdecComments'
            ])->where(['appdh_applicationdtlstmp_fk'=>$interId]);




        }

        if($projtype == 1 ){
            $applicationhsty->andWhere(['appdh_projectmst_fk' => 1]);
        }else if($projtype == 4){
            $applicationhsty->andWhere(['appdh_projectmst_fk' => 4]);
        }else{
            $applicationhsty->andWhere(["IN", "appdh_projectmst_fk", [2, 3]]);
        }

        if($request['gridsearchValues'] != ''){
            $gridsearchValues = json_decode($request['gridsearchValues'],true);  
            $appstatus = $gridsearchValues['applstatus'];
            $createdon = $gridsearchValues['appdh_appdecon'];
            if($appstatus){  // application status filter
           
                if(count($appstatus) >1){
                $appcond ="";
                if(in_array(2, $appstatus)){ 
                $appcond .= "appdh_status='2' ||";
                $appcond .= "appdh_status='4' ||";
                }
                if(in_array(3, $appstatus)){ 
                    $appcond .= "appdh_status='3' ||";
                 }
                 if(in_array(4, $appstatus)){ 
                    $appcond .= "appdh_status='4' ||";
                 }
                 if(in_array(5, $appstatus)){ 
                    $appcond .= "appdh_status='5' ||";
                 }
                 if(in_array(6, $appstatus)){ 
                    $appcond .= "appdh_status='6' ||";
                 }
                 if(in_array(7, $appstatus)){ 
                    $appcond .= "appdh_status='7' ||";
                 }
                 if(in_array(8, $appstatus)){
                    $appcond .= "appdh_status='8' ||";
                 }
                 if(in_array(9, $appstatus)){ 
                    $appcond .= "appdh_status='9' ||";
                 }
                 if(in_array(10, $appstatus)){
                    $appcond .= "appdh_status='10' ||";
                 }
                 if(in_array(11, $appstatus)){
                    $appcond .= "appdh_status='11' ||";
                 }
                 if(in_array(12, $appstatus)){
                    $appcond .= "appdh_status='12' ||";
                 }
                 if(in_array(13, $appstatus)){
                    $appcond .= "appdh_status='13' ||";
                 }
                 if(in_array(14, $appstatus)){
                    $appcond .= "appdh_status='14' ||";
                 }
                 if(in_array(15, $appstatus)){
                    $appcond .= "appdh_status='15' ||";
                 }
                 if(in_array(16, $appstatus)){
                    $appcond .= "appdh_status='16' ||";
                 }
                 if(in_array(17, $appstatus)){
                    $appcond .= "appdh_status='17' ||";
                 }
                 if(in_array(18, $appstatus)){
                    $appcond .= "appdh_status='18' ||";
                 }
                 if(in_array(19, $appstatus)){
                    $appcond .= "appdh_status='19' ||";
                 }
                 if(in_array(20, $appstatus)){
                    $appcond .= "appdh_status='20' ||";
                 }
            
            
            
                $paymentstscond = rtrim($appcond, "||");
                $applicationhsty->andWhere($paymentstscond);
                }else{
                if(in_array($appstatus[0], [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20])){ 
                $pymt_sts = $appstatus[0];
                $applicationhsty->andWhere("appdh_status='$pymt_sts' ");
                }
                }
                }
          
      
        }
        $data['records']  = $applicationhsty->orderBy(['applicationdtlshsty_pk' => SORT_DESC])->asArray()->all();

            $page = (!empty($request['size']) && $request['size'] != 'undefined') ? $request['size'] : 10 ;  
            $provider = new \yii\data\ActiveDataProvider([
            'query' => $applicationhsty,
            'pagination' => [
            'pageSize' => $page,
            'page' => $request['page']
            ]
            ]);
        $data = $provider->getModels();
        foreach($data  as $value){
            $resAry=$value;
            $resAry['appdh_appdecComments'] = strip_tags($value['appdh_appdecComments']);
            if($value['appdh_status']  == '10' ||  $value['appdh_status']  == '14'){
                if($value['appdh_apptype'] == 1 || $value['appdh_apptype'] == 2){
                  $resAry['appdh_appdecComments'] = strip_tags($value['appdh_gradingreason']); 
                }else{
                    $resAry['appdh_appdecComments'] = strip_tags($value['appdh_appdecComments']); 
                }
              }
              if($value['appdh_status']  == '2'  || $value['appdh_status']  == '4' || $value['appdh_status']  == '6' ||  $value['appdh_status']  == '9' ){
                  if($value['appdh_updatedon']){
                    $resAry['appdh_updatedon'] =$value['appdh_updatedon'];
                  }else{
                    $resAry['appdh_updatedon'] = $value['appdh_submittedon'];
                  }
               
              }else{
                $resAry['appdh_updatedon'] = $value['appdh_appdecon'];
              }
             
            $finalAry[]=$resAry;
        }
        $data['records'] = $finalAry;
        $data['auditdata'] = $auditdata;
        $data['totalcount'] = $provider->getTotalCount();

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }
    public function actionGetstaffassessmentstatus() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $id = Security::decrypt($request['staffevaluationtemp_pk']);
        $app_id = Security::decrypt($request['app_id']);
        $asit_id = Security::decrypt($request['asit_id']);
        
        $data = SiteAudit::getStaffAssessmentStatus($id,$app_id,$asit_id);
        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionUpdateapproval(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $result = array(
            'status' => 200,
            'msg' => 'false',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $apptmpPk = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
        $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
    
        if($interId){
            $Appmodel = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
            if($Appmodel){
                    $Appmodel->appdt_status = ($Appmodel->appdt_status == 13)?14:10;
                    $Appmodel->appdt_gradingreason = strval($formdata['formdata']['comments']);
                    $Appmodel->appdt_appdecon = date("Y-m-d H:i:s");
                    $Appmodel->appdt_appdecby = $userPk;
                                        
                  $schedulemodel = \app\models\AppauditschedtmpTbl::find()->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $interId])->one();  
                  $schedulemodel->appasdt_status =  2;
                  $schedulemodel->appasdt_updatedon = date("Y-m-d H:i:s");
                  $schedulemodel->appasdt_updatedby = $userPk;  
                  $schedulemodel->save();

                //insert in application history table
                  // $data = AppCenter::saveAppHistory($Appmodel);

                  $apptype = $Appmodel->appdt_apptype;
                  if($apptype == 1){
                      $approvaltype = 1;
                  }else if($apptype == 2){
                      $approvaltype = 4;
              
                  }
                    if($formdata['formdata']['select_valitate'] == 3){
                    $approvalstatus = 1;
                    }else{
                    $approvalstatus = 2;
                    }
                  //update the existing record
                   $Approvalmodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $interId])->orderBy('appapprovalhdr_pk desc')->one();
                   if($Approvalmodel){
                      $Approvalmodel->aah_status =  1;
                      $Approvalmodel->aah_formstatus =  $approvaltype;
                      $Approvalmodel->save();
        
                    }
                       
                    //insert new recored

                    $info = SiteAudit::getApprovalHdrInfo(1,  $approvaltype , 3);
                    $modelhdr = new AppapprovalhdrTbl;
                    $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
                    $modelhdr->aah_projapprovalworkflowdtls_fk = $info['projapprovalworkflowdtls_pk'];
                    $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
                    $modelhdr->aah_applicationdtlstmp_fk = $interId;
                    if($apptype == 1){
                        $modelhdr->aah_formstatus = 1;
                    }else if($apptype == 2){
                        $modelhdr->aah_formstatus = 4;
                    }else{
                        $modelhdr->aah_formstatus = 2;
                    }
                    $modelhdr->aah_status = null;
                    $modelhdr->save();


                   
                    //store data appapprovalhdr tbl ends  
                if ($Appmodel->save() === TRUE) {
                   //movement from temp to history table
                     $secondparam = '';
                     $thirdparam = 1;
                     $icvReturn  =  \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:i_comppk,:i_formstatus,:i_appform)")
                         ->bindParam(':i_comppk', $interId)
                         ->bindParam(':i_formstatus', $secondparam)
                         ->bindParam(':i_appform', $thirdparam)
                         ->execute();

                            $result = array(
                                'status' => 200,
                                'msg' => 'success',
                                'flag' => $formdata['formdata']['select_valitate'],
                                'data' => $Appmodel,
                                'comments' => 'Submitted for Quality Manager Approval!'
                            );
                        
                 $appliSts = $Appmodel->appdt_status;  
                 $appType = $Appmodel->appdt_apptype; 
                 $projectpk =  $Appmodel->appdt_projectmst_fk; 
              
                
                $qualityman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 3])
                ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($qualityman as $qualitymanrow) {
                        $id = $qualitymanrow['oum_emailid'];
                        $name = $qualitymanrow['oum_firstname'];

                        if($appliSts ==10 && $appType == 1 && $projectpk==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'opalAudApp');    
                        }elseif($appliSts == 14 && $appType == 1 && $projectpk==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'requalityAppro');     
                        }          
                }
                $requalityman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 3])
                ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($requalityman as $requalitymanrow) {
                        $id = $requalitymanrow['oum_emailid'];
                        $name = $requalitymanrow['oum_firstname'];    

                        if($appliSts ==10 && $appType == 2 && $projectpk==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reopalAudApp');    
                        }elseif($appliSts == 14 && $appType == 2 && $projectpk==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'renrequalityAppro');     
                        } 
                }
                
            $author= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 4])
            ->asArray()
            ->all();
            
            $id = [];
            $name = [];
            foreach ($author as $authorrow) {
                $id = $authorrow['oum_emailid'];
                $name = $authorrow['oum_firstname'];
        
                        if($appliSts ==11 && $appType == 1 && $projectpk==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'opalAudApp');   
                        }
            } 
            
            $reauthor= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 4])
            ->asArray()
            ->all();
            
            $id = [];
            $name = [];
            foreach ($reauthor as $reauthorrow) {
                $id = $reauthorrow['oum_emailid'];
                $name = $reauthorrow['oum_firstname'];

                        if($appliSts ==11 && $appType == 2 && $projectpk==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reopalAudApp');   
                        }
                }
                
                
                
                }else{
                    $result = array(
                        'status' => 200,
                        'msg' => 'false',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $Appmodel->getErrors()
                    );
                }
            }
        }
    
        $generate = SiteAudit::generatesiteauditreport($interId);
    return $result;
    
    }
    public function actionUpdateapproval1(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
       
        $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
        if($interId){
            $Appmodel = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
            if($Appmodel){
                    $Appmodel->appdt_gradingreason = strval($formdata['formdata']['comments']);
                    $Appmodel->save();
            }
        }
        $generate = SiteAudit::generatesiteauditreport($interId);
        $application = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->asArray()->one();

return $result = array(
            'url' => $application['appdt_auditedreport']     
        );

    }
    public function actionUpdateapprovalras(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
       
        $interId = $formdata['formdata'];
      

        $generate = SiteAudit::generatesiteauditreportras($interId);
        $application = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->asArray()->one();

       return $result = array(
            'url' => $application['appdt_auditedreport']     
        );

    } 
    public function actionUpdateapprovalrassavemsg(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
       
        $interId = Security::decrypt($formdata['formdata']);
        $applicationdtls = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
        $applicationdtls->appdt_gradingreason = strval($formdata['message']);
        $applicationdtls->save();


    } 
    public function actionApprovaliteauditgetgrade(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $interId = Security::decrypt($formdata['formdata']);

        $applicationdtls = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->asArray()->one();
        return ['message'=>$applicationdtls['appdt_gradingreason']];

    } 
    
    
    
    
    public function actionUpdatesite(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = array(
            'status' => 200,
            'msg' => 'false',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    $apptmpPk = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
        $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
        $approvalid =$formdata['formdata']['approvalid'];
        $categorygrade =$formdata['formdata']['categorygrade'];
       
  
        if($interId){
            $Appmodel = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
            if($Appmodel){
                $fromstatus = (int)$formdata['formdata']['select_valitate'];
                //submitted for next level approval
                if($approvalid == '3'){
                  
                    if($fromstatus == '3'){
                        $approvalstatus = 11;
                        $role = 4;
                    }else{
                        $approvalstatus = 13; 
                        $role = 5;
                    }
                 }
                 if($approvalid == '4'){
                  
                    if($fromstatus == '3'){
                        $approvalstatus = 12;
                        $role = 7;
                    }else{
                        $approvalstatus = 13;
                        $role = 5; 
                    }
                 }
                 if($approvalid == '5'){
                    if($fromstatus == '3'){
                        $approvalstatus = 17;
                    }else{
                        $approvalstatus = 13; 
                        $role = 5; 
                    }
                 }
                    $Appmodel->appdt_status =  $approvalstatus;
                    $Appmodel->appdt_grademst_fk  = $categorygrade;
                    $Appmodel->appdt_appdeccomment = strval($formdata['formdata']['comments']);
                    $Appmodel->appdt_appdecon = date("Y-m-d H:i:s");
                    $Appmodel->appdt_appdecby = $userPk;
                    $apptype = $Appmodel->appdt_apptype;
                    if($apptype == 1){
                        $approvaltype = 1;
                    }else if($apptype == 2){
                        $approvaltype = 4;
            
                    }
               if($approvalstatus == 17){
                  $schedulemodel = \app\models\AppauditschedtmpTbl::find()->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $interId])->one();  
                  $schedulemodel->appasdt_status =  3;
                  $schedulemodel->appasdt_updatedon = date("Y-m-d H:i:s");
                  $schedulemodel->appasdt_updatedby = $userPk;  
                  $schedulemodel->save();


                   // self::Finalcerificategeneration($interId);

               
               }

            
                if ($Appmodel->save() === TRUE) {
                    
                    //update the existing record 
                    $Approvalmodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $interId])->orderBy('appapprovalhdr_pk desc')->one();
                    if($Approvalmodel){
                        $Approvalmodel->aah_status =  ($fromstatus == 3)?1:2;
                        $Approvalmodel->aah_appdecon =  date("Y-m-d H:i:s");
                        $Approvalmodel->aah_appdecby =  $userPk;  
                        $Approvalmodel->aah_appdecComments =  strval($formdata['formdata']['comments']);
                        $Approvalmodel->save();
                       // if($fromstatus == 3){

                            //insert new recored
                       if($role){
                            $info = SiteAudit::getApprovalHdrInfo(1, $approvaltype, $role);
                            $modelhdr = new AppapprovalhdrTbl;
                            $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
                            $modelhdr->aah_projapprovalworkflowdtls_fk = $info['projapprovalworkflowdtls_pk'];
                            $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
                            $modelhdr->aah_applicationdtlstmp_fk = $interId;
                            if($apptype == 1){
                            $modelhdr->aah_formstatus = 1;
                            }else if($apptype == 2){
                            $modelhdr->aah_formstatus = 4;
                            }else{
                            $modelhdr->aah_formstatus = 2;
                            }
                            $modelhdr->aah_status = null;
                            $modelhdr->save();
                        }
                    }
                   
                    if($Appmodel->appdt_status == 17){
                     self::Finalcerificategeneration($interId);
                    
                    }
                            //movement from temp to main table
                            $secondparam = '';
                            $thirdparam = 1;
                            $icvReturn  =  \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:i_comppk,:i_formstatus,:i_appform)")
                            ->bindParam(':i_comppk', $interId)
                            ->bindParam(':i_formstatus', $secondparam)
                            ->bindParam(':i_appform', $thirdparam)
                            ->execute();
                            $result = array(
                                'status' => 200,
                                'msg' => 'success',
                                'flag' => $formdata['formdata']['select_valitate'],
                                'data' => $Appmodel,
                                'comments' => 'Submitted successfully!'
                            );
                            if($Appmodel->appdt_status >= 10 && $Appmodel->appdt_status != 13){
                                $generate = SiteAudit::generatesiteauditreport($interId);
                                if($Appmodel->appdt_status == 17){
                                $del = self::deleteaudit($interId);
                                }
                            }
                        
                            $applicatSts = $Appmodel->appdt_status;
                            $appType = $Appmodel->appdt_apptype; 
                            $projectpk = $Appmodel->appdt_projectmst_fk; 
                            $regPk = $Appmodel->appdt_opalmemberregmst_fk; 
                            
                           
                    
               $author= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 4])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($author as $authorrow) {
                    $id = $authorrow['oum_emailid'];
                    $name = $authorrow['oum_firstname'];            

                            if($applicatSts == 11 && $appType ==1 && $projectpk ==1 ){
                                    \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'qualityAppro');      
                                }
                            }
                        
               $reauthor= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 4])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($reauthor as $reauthorrow) {
                    $id = $reauthorrow['oum_emailid'];
                    $name = $reauthorrow['oum_firstname'];            

                             if($applicatSts == 11 && $appType ==2 && $projectpk ==1){
                                    \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'renewqualityAppro');     
                            }
                }   
                     
                $ceo= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 7])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($ceo as $ceorow) {
                        $id = $ceorow['oum_emailid'];
                        $name = $ceorow['oum_firstname'];        
                                if($applicatSts == 12 && $appType ==1 && $projectpk ==1){
                                 \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'authorityApproforceo');     
                                }
                }
                
                 $receo= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 7])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($receo as $receorow) {
                        $id = $receorow['oum_emailid'];
                        $name = $receorow['oum_firstname'];                                  
                                if($applicatSts == 12 && $appType ==2 && $projectpk ==1){
                                 \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reauthorityApproforceo');     
                                }     
                }
                         
                         
                $aud=\app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 5])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($aud as $audrow) {
                $id = $audrow['oum_emailid'];
                $name = $audrow['oum_firstname']; 
                         
                        if($applicatSts == 13 && $appType ==1 && $projectpk ==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'declineAuditor');      
                        }

                }
                
                $reaud=\app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 5])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($reaud as $reaudrow) {
                $id = $reaudrow['oum_emailid'];
                $name = $reaudrow['oum_firstname']; 
   
                        if($applicatSts == 13 && $appType ==2 && $projectpk ==1){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'redeclineAuditor');     
                        }      
                }

                
                
                        if($applicatSts == 17 && $appType ==2 && $projectpk ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'reapprovedCer');     
                        }

                        if($applicatSts == 17 && $appType ==1 && $projectpk ==1){
                                  \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'approvedCer');      
                        }
                  
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'false',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $Appmodel->getErrors()
                    );
                }
            }
        }
    
    
    return $result;
    
    }
    public  function deleteaudit($app_pk) {
        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $model =  \app\models\AppauditreportlogTbl::deleteAll('aarl_applicationdtlstmp_fk = '.$app_pk);
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
    }
    function generateRandomString($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

   //public function actionFinalcerificategeneration(){
     public function Finalcerificategeneration($appid){
     //   $applicatonpk = 4;
       $applicatonpk = $appid;

        // $ckeckfinalauthorityapproval = appapprovalhdrtbl::find()->where('aah_status =1 and aah_applicationdtlstmp_fk = '.$applicatonpk)
        // ->orderBy(['appapprovalhdr_pk' => SORT_DESC])->asArray()->one();


        // $finalauthoriy = ProjapprovalworkflowdtlsTbl::find()->where('projapprovalworkflowdtls_pk = '.$ckeckfinalauthorityapproval['aah_projapprovalworkflowdtls_fk'])
        //  ->orderBy(['projapprovalworkflowdtls_pk' => SORT_DESC])->asArray()->one(); 
        $websiteurl = \Yii::$app->params['website_url'];

       
        // if($finalauthoriy['pawfh_Isfinalauthority'] == 1){
            if(1){
            $applictioninfo = ApplicationdtlstmpTbl::find()
            ->select(['applicationdtlstmp_tbl.*','appcoursedtlstmp_tbl.*','reqfor.rm_name_en','gm_gradename_en','grademst_pk','appiit_officetype','osm_statename_en','ocim_cityname_en'])
            ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
            ->leftJoin('grademst_tbl','grademst_pk = appdt_grademst_fk')
            ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
            ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk') 
            ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();

            $year  = OpalInvoiceTbl::find()
                ->select(['feesubscriptionmst_tbl.*'])
                ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
                ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
                ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();

                $companyinfo = OpalmemberregmstTbl::find()
                ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
                ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
                ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                    ->asArray()->one();
            $course = AppoffercoursetmpTbl::find()->Select('group_concat(appoct_coursecategorymst_fk) as cat')->where('appoct_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();

            $subcat = CoursecategorymstTbl::find()->Select('group_concat(ccm_catcode) as subcat')->where('coursecategorymst_pk in ('.$course['cat'].')')->asArray()->one();
          
            if(empty($applictioninfo['appdt_verificationno'])){
                $varificationcode = 'TP'.$this->generateRandomString();
            }else{
                $varificationcode = $applictioninfo['appdt_verificationno'];
            }

            $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
         
             if($applictioninfo['appdt_apptype'] == 1 ){
                $end = date('Y-m-d', strtotime($increasedate));
               // $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end));  
             }else if($applictioninfo['appdt_apptype'] == 2){
                 $end=date('Y-m-d', strtotime($increasedate, strtotime($applictioninfo['appdt_certificateexpiry'])) );
                 //$end = date('Y-m-d', strtotime($end . ' -1 day'));
                 $end_format = date("d-m-Y", strtotime($end));  
             }else if($applictioninfo['appdt_apptype'] == 3){
                $end=$applictioninfo['appdt_certificateexpiry'];
                $end_format = date("d-m-Y", strtotime($end));  
            }
           
            
            $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];
           
            $path = "../api/web/centercertificate/$regPk/";
            $path1 = "/web/centercertificate/$regPk/";
            if(!is_dir($path)){
                mkdir($path, 0777, true);
            }  
            $baseUrl = \Yii::$app->params['baseUrl'];
            $mPDF1 = new \Mpdf\Mpdf([
                'mode' => '',
                'format' => [297, 210],
                'margin_left' => '15',
                'margin_right' => '15',
                'margin_top' => '35', 
                'margin_bottom' => '16',
                'margin_header' => '9',
                'margin_footer' => '9',
                'default_font_size' => '0', 
                'orientation' => 'L',
                'default_font' => 'futurastdmedium']);
            $imgpath = dirname(__FILE__).'../../../../../certicate/';
            $cerpath = dirname(__FILE__).'../../../../../certicate/TrainingCentre.pdf';
            $pagecount = $mPDF1->SetSourceFile($cerpath);
            $tplId = $mPDF1->ImportPage($pagecount);
            $mPDF1->UseTemplate($tplId);
            $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_tpname_en']  . '</div>', 25, 144, 150, 20);
            if($applictioninfo['appiit_officetype'] == 1){
                $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$companyinfo['osm_statename_en'].','.$companyinfo['ocim_cityname_en']  .')'. '</div>',  25, 152, 150, 20);
                }else{
                    $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$applictioninfo['osm_statename_en'].','.$applictioninfo['ocim_cityname_en']  .')'. '</div>', 25, 152, 150, 20);
                }
            $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;text-align: center;font-size: 22pt; ">' . 'Is a Recognised OPAL STAR Provider' . ' </div>', 25, 165, 150, 20);

            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">CR No.: <span style="color:#22228B">' . $companyinfo['omrm_crnumber'] . '</span> </div>', 25, 180, 150, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">OPAL Membership No.: <span style="color:#22228B">' . $companyinfo['omrm_opalmembershipregnumber'] . '</span> </div>', 25, 186, 150, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">Verification Code: <span style="color:#22228B">' . $varificationcode . '</span> </div>', 25, 192, 150, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">Expiry Date: <span style="color:#22228B">' . $end_format . '</span> </div>', 25, 198, 150, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 10pt; color:#5B5E5E">Grade: <span style="color:#22228B">' .$applictioninfo['gm_gradename_en']  . '</span> </div>', 140, 180, 50, 20);
                
            if($applictioninfo['grademst_pk'] == 1){
                $mPDF1->WriteFixedPosHTML('<img style="height:52pt" src="' .  $imgpath.'BRONZE.svg' . '">', 145, 187, 50, 20);
            }elseif($applictioninfo['grademst_pk'] == 2){
                $mPDF1->WriteFixedPosHTML('<img style="height:52pt" src="' .  $imgpath.'SILVER.svg' . '">', 145, 187, 50, 20);
            }elseif($applictioninfo['grademst_pk'] == 3){
                $mPDF1->WriteFixedPosHTML('<img style="height:52pt" src="' .  $imgpath.'GOLD.svg' . '">', 145, 187, 50, 20);
            }
            $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;font-size: 10pt; ">Categories: <span style="color:#22228B">' .$subcat['subcat']  . '</span> </div>', 140, 207, 50, 20);

            $info= "To view or verify authenticity please scan QR code with mobile device or refer to  www.usp.opaloman.om";
            $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;font-size: 8.79pt; ">' .$info . ' </div>', 25, 207, 55, 20);
            // $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;font-size: 8.79pt; "> www.opaloman.om </div>', 36, 220, 50, 20);
            $qrCode = (new QrCode(''))
            ->setText($websiteurl."/verify-product/?verificationno=$varificationcode");
            $qrCode->writeFile(__DIR__ . '/code.png'); 
            $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:55pt; height:55pt;">';

           
            $mPDF1->WriteFixedPosHTML($qrcode, 30, 230, 50, 20);
            $mPDF1->Output($path .$applictioninfo['appdt_appreferno'].'.pdf', 'F');

            $model = ApplicationdtlstmpTbl::find() ->where('applicationdtlstmp_pk = '.$applicatonpk)->one();
            $model->appdt_verificationno =  $varificationcode;
            if($applictioninfo['appdt_apptype'] != 3){
            $model->appdt_certificategenon = date("Y-m-d H:i:s");
            }
            $model->appdt_certificatepath = $path1.$applictioninfo['appdt_appreferno'].'.pdf';
           
            if($applictioninfo['appdt_apptype'] != 3){
             $model->appdt_certificateexpiry = $end;
            }
            if(!$model->save()){
            
                return $model->getErrors();
            }else{
               
            return 'success';
            }
        }

    }


    public function actionDeletestaffevaluation() {
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $id = Security::decrypt($request['staffevaluationtemp_pk']);
        $data = SiteAudit::deleteStaffEvaluation($id);
        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }
    
    public function actionGetunitcode()
    {
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = $request['id'];
        // $interId = Security::decrypt($id);
        $data = \app\models\ApplicationdtlstmpTbl::getunitcodedata($id);
        return $data;   
    }

    public function actionSavenextlevelapprovalstatus() {
        $response = []; 
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $id = Security::decrypt($request['app_id']);
        $apptmpPk = Security::decrypt($request['app_id']);
        $data = SiteAudit::saveAppApprovalNextLevel($id,$request['data']);
        $applicadetails = \app\models\ApplicationdtlstmpTbl::find()
        ->leftJoin('appinstinfotmp_tbl', 'applicationdtlstmp_tbl.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
        ->select(['appdt_status', 'appdt_apptype','appdt_projectmst_fk']) // Select both columns
        ->andWhere("find_in_set($apptmpPk, applicationdtlstmp_pk)")
        ->asArray()
        ->one();
        

        $appStatus = $applicadetails['appdt_status'];  
        $appType = $applicadetails['appdt_apptype']; 
        $projpk = $applicadetails['appdt_projectmst_fk']; 
        
                $renqualityman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 3])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($renqualityman as $renqualitymanrow) {
                        $id = $renqualitymanrow['oum_emailid'];
                        $name = $renqualitymanrow['oum_firstname'];    
                    if($projpk ==2 || $projpk==3){
                       if($appStatus == 10 && $appType ==2){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencropalAup');
                    }elseif($appStatus == 14 && $appType ==2){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrreopalAup');
                    }   
                    }
                }
                
                
                
                
                $qualityman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 3])
                ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($qualityman as $qualitymanrow) {
                        $id = $qualitymanrow['oum_emailid'];
                        $name = $qualitymanrow['oum_firstname'];    
                    if($projpk ==2 || $projpk==3){
                       if($appStatus == 10 && $appType ==1){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'cropalAup');
                    }elseif($appStatus == 14 && $appType ==1){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crreopalAup');
                    }   
                    }
                }
                
                $updqualityman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 3])
                ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($updqualityman as $updqualitymanrow) {
                        $id = $updqualitymanrow['oum_emailid'];
                        $name = $updqualitymanrow['oum_firstname'];    
                    if($projpk ==2 || $projpk==3){
                       if($appStatus == 10 && $appType ==3){
                   \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalAupadd');
                    }elseif($appStatus == 14 && $appType ==3){
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrreopalAup');
                    }   
                    }
                }

                
        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionGetappapprovalhrd() {
        $response = []; 
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $id = Security::decrypt($request['app_id']);
        $sts = Security::decrypt($request['app_status']);

        $data = SiteAudit::getAppApprovalHrd($id,$sts);

        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }

    public function actionChangesiteauditstatus() {
        $response = []; 
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
     
        $id = Security::decrypt($request['app_id']);
        $apptmpPk = Security::decrypt($request['app_id']);
        $data = SiteAudit::approveOrDeclineProcess($id,$request['data']);
         $applicadetails = \app\models\ApplicationdtlstmpTbl::find()
        ->leftJoin('appinstinfotmp_tbl', 'applicationdtlstmp_tbl.applicationdtlstmp_pk = appinstinfotmp_tbl.appiit_applicationdtlstmp_fk')
        ->select(['appdt_status', 'appdt_apptype','appdt_projectmst_fk','appdt_opalmemberregmst_fk']) // Select both columns
        ->andWhere("find_in_set($apptmpPk, applicationdtlstmp_pk)")
        ->asArray()
        ->one();

        $appStatus = $applicadetails['appdt_status'];  
        $appType = $applicadetails['appdt_apptype']; 
        $projpk = $applicadetails['appdt_projectmst_fk']; 
        $regPk = $applicadetails['appdt_opalmemberregmst_fk']; 
        
   
             if($projpk==2){ 
        
                $authorcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 1 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $authorcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $author = $authorcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                  
                  foreach ($author as $authorrow) {
                        $id = $authorrow['oum_emailid'];
                        $name = $authorrow['oum_firstname'];
                    if($appStatus == 11 && $appType ==1){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'cropalqualma');
                    }elseif($appStatus == 15 && $appType ==1){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'cropalqualma');
                    }
                }
            } 

        if($projpk==3){
         $author= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
            ->groupBy(['opalusermst_pk'])
           ->asArray()
           ->all();
            $id = [];
            $name = [];
            foreach ($author as $authorrow) {
                $id = $authorrow['oum_emailid'];
                $name = $authorrow['oum_firstname'];
                    if($appStatus == 11 && $appType ==1){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'cropalqualma');
                    }elseif($appStatus == 15 && $appType ==1){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'cropalqualma');
                    }
            }
        }
            
        
        
              if($projpk==2){ 
        
                $renauthorcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 4 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $renauthorcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $renauthor = $renauthorcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                     foreach ($renauthor as $renauthorrow) {
                $id = $authorrow['oum_emailid'];
                $name = $authorrow['oum_firstname'];
                    if($appStatus == 11 && $appType ==2){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencropalqualma');
                    }elseif($appStatus == 15 && $appType ==2){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencropalqualma');
                    }
            }
           
            } 
    
         if($projpk==3){    
           $renauthor= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
            ->groupBy(['opalusermst_pk'])
           ->asArray()
           ->all();
            $id = [];
            $name = [];
            foreach ($renauthor as $renauthorrow) {
                $id = $authorrow['oum_emailid'];
                $name = $authorrow['oum_firstname'];
                    if($appStatus == 11 && $appType ==2){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencropalqualma');
                    }elseif($appStatus == 15 && $appType ==2){
                       \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencropalqualma');
                    }
            }
         }
            
               if($projpk==2){ 
        
                $updauthorcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 2 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $updauthorcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $updauthor = $updauthorcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                   foreach ($updauthor as $updauthorrow) {
                    $id = $updauthorrow['oum_emailid'];
                    $name = $updauthorrow['oum_firstname'];
                        if($appStatus == 11 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalqualma');
                        }elseif($appStatus == 15 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalqualma');
                        }
                    }           
            } 

          if($projpk==3){
              $updauthor= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 2, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
                ->groupBy(['opalusermst_pk'])
               ->asArray()
               ->all();
                $id = [];
                $name = [];
                foreach ($updauthor as $updauthorrow) {
                    $id = $updauthorrow['oum_emailid'];
                    $name = $updauthorrow['oum_firstname'];
                        if($appStatus == 11 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalqualma');
                        }elseif($appStatus == 15 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalqualma');
                        }
                }
          }        
                
      $updauthoradd= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
               ->asArray()
               ->all();
                $id = [];
                $name = [];
                foreach ($updauthoradd as $updauthoraddrow) {
                    $id = $updauthoraddrow['oum_emailid'];
                    $name = $updauthoraddrow['oum_firstname'];
                        if($appStatus == 11 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddcropalqualma');
                        }elseif($appStatus == 15 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddcropalqualma');
                        }
                }
if($projpk==2){ 
                $updauthoraddcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $updauthoraddcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $updauthoradd = $updauthoraddcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                        
                    foreach ($updauthoradd as $updauthoraddrow) {
                    $id = $updauthoraddrow['oum_emailid'];
                    $name = $updauthoraddrow['oum_firstname'];
                        if($appStatus == 11 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddcropalqualma');
                        }elseif($appStatus == 15 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddcropalqualma');
                        }
                }
    
            } 
          
   
           if($projpk==3){
                 $updauthoradd= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
               ->asArray()
               ->all();
                $id = [];
                $name = [];
                foreach ($updauthoradd as $updauthoraddrow) {
                    $id = $updauthoraddrow['oum_emailid'];
                    $name = $updauthoraddrow['oum_firstname'];
                        if($appStatus == 11 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddcropalqualma');
                        }elseif($appStatus == 15 && $appType ==3){
                           \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddcropalqualma');
                        }
                }
           }
           
           
            if($projpk==2){ 
        
                $audcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 1 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 5 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $audcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $aud = $audcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                foreach ($aud as $audrow) {
                $id = $audrow['oum_emailid'];
                $name = $audrow['oum_firstname']; 
        
                if($appStatus == 13 && $appType ==1){
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crdecline');
                }
                }
           
            } 
           
           
           
           
            if($projpk==3){
                $aud= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
               ->select(['oum_emailid', 'oum_firstname'])
               ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
               ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
               ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
               ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 5,'oum_status'=>'A'])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($aud as $audrow) {
                $id = $audrow['oum_emailid'];
                $name = $audrow['oum_firstname']; 
        
                if($appStatus == 13 && $appType ==1){
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crdecline');
                }
                }
            }
                
            
                 if($projpk==2){ 
        
                $renaudcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 4 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 5 AND oum_status = 'A' AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk");
                    $renaudcommand ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
                    $renaud = $renaudcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                    foreach ($renaud as $renaudrow) {
                $id = $renaudrow['oum_emailid'];
                $name = $renaudrow['oum_firstname']; 
        
                if($appStatus == 13 && $appType ==2){
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrdecline');
                }
                }
           
            } 
            
            
            

            if($projpk==3){  
                $renaud= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
               ->select(['oum_emailid', 'oum_firstname'])
               ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
               ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
               ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
               ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 5,'oum_status'=>'A'])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($renaud as $renaudrow) {
                $id = $renaudrow['oum_emailid'];
                $name = $renaudrow['oum_firstname']; 
        
                if($appStatus == 13 && $appType ==2){
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrdecline');
                }
                }
            }
                
        if($appStatus==17 && $appType ==3){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'updcourapprovedno');  
       }       
        
        
        
        if($appStatus == 17 && $appType ==1){
           \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'courapproved');
        }
        
         if($appStatus == 17 && $appType ==2){
           \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'rencourapproved');
        }


       

        if($data) {
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else {
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }
    public function actionGetapprovalsitedata() {
        $response = [];
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $project_id =  (!empty($request['data']['project_id']))? Security::decrypt($request['data']['project_id']): 2;
        $formstatus = (!empty($request['data']['formstatus']))? $request['data']['formstatus']: 1;
      
        $data = SiteAudit::getAppApprovalworkFlow($project_id,$formstatus);

        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        
        return $this->asJson($response);
    }

    public function actionGetmainrole(){
        $response = [];
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $mstPk = $request['mst_pk'];
        $data = \app\models\RolemstTbl::find()->where(['rm_projectmst_fk' => 1])->asArray()->all();
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        return $this->asJson($response);
    }

    public function actionGetcurbranch(){
        $stsReturn = \app\models\ApplicationdtlstmpTbl::find()
                    ->select(['*'])
                    ->Where(['applicationdtlstmp_pk'=>$_GET['param']])
                    ->asArray()
                    ->one();
        
        return $this->asJson($stsReturn);
    }

    public function actionGetviewdetails(){


        $companyPk = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        //$mem_reg=$ipArray['mem_reg'];
        $appMainId =  Security::decrypt($_GET['param']);
        $provider="";
        //echo '<pre>';print_r($appMainId);exit;
        $appMainDtls = \app\models\ApplicationdtlsmainTbl::find()
                    ->select(['*'])
                    ->Where(['applicationdtlsmain_pk'=>$appMainId])
                    ->orderBy('applicationdtlsmain_pk desc')
                    ->asArray()
                    ->one();
        

        $appTmpDtls = \app\models\ApplicationdtlstmpTbl::find()
                    ->select(['*'])
                    ->Where(['applicationdtlstmp_pk'=>$appMainDtls['appdm_applicationdtlstmp_fk']])
                    ->asArray()
                    ->one();
        
                    
        //$appId=$appMainDtls['appdm_applicationdtlstmp_fk'];
          
 
        //echo '<pre>';print_r($appMainDtls);exit;
        
 
        $ofCourDtls = \Yii::$app->db->createCommand("SELECT *, branchst.osm_statename_en as branchstate , mainst.osm_statename_en as mainstate, branch.ocim_cityname_en as branchcity , maincenter.ocim_cityname_en as maincity  FROM applicationdtlsmain_tbl 
                                                     left join appinstinfomain_tbl on applicationdtlsmain_tbl.applicationdtlsmain_pk = appinstinfomain_tbl.appiim_applicationdtlsmain_fk
                                                     left JOIN opalmemberregmst_tbl on applicationdtlsmain_tbl.appdm_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk
                                                     LEFT JOIN memcompfiledtls_tbl ON opalmemberregmst_tbl.omrm_cmplogo = memcompfiledtls_tbl.memcompfiledtls_pk
                                                     left JOIN opalusermst_tbl on memcompfiledtls_tbl.mcfd_opalmemberregmst_fk  = opalusermst_tbl.oum_opalmemberregmst_fk
                                                     left join opalstatemst_tbl as branchst on appinstinfomain_tbl.appiim_statemst_fk = branchst.opalstatemst_pk
                                                     left join opalstatemst_tbl as mainst on opalmemberregmst_tbl.omrm_opalstatemst_fk = mainst.opalstatemst_pk
                                                     left join opalcitymst_tbl as branch on appinstinfomain_tbl.appiim_citymst_fk = branch.opalcitymst_pk
                                                     left join opalcitymst_tbl as maincenter on opalmemberregmst_tbl.omrm_opalcitymst_fk = maincenter.opalcitymst_pk
                                                     left join projectmst_tbl on applicationdtlsmain_tbl.appdm_projectmst_fk = projectmst_tbl.projectmst_pk
                                                     LEFT JOIN appoffercoursemain_tbl on applicationdtlsmain_tbl.applicationdtlsmain_pk = appoffercoursemain_tbl.appocm_applicationdtlsmain_fk
                                                     LEFT JOIN coursecategorymst_tbl on appoffercoursemain_tbl.appocm_coursecategorymst_fk   =  coursecategorymst_tbl.coursecategorymst_pk
                                                     LEFT JOIN standardcoursemst_tbl on coursecategorymst_tbl.coursecategorymst_pk = standardcoursemst_tbl.scm_coursecategorymst_fk
                                                     left join referencemst_tbl on referencemst_tbl.referencemst_pk = appoffercoursemain_tbl.appocm_courselevel
                                                     WHERE applicationdtlsmain_pk = '$appMainId' GROUP BY appocm_coursename_en order by appoffercoursemain_pk asc")->queryAll();
 
        // $stdCourDtls = \Yii::$app->db->createCommand("SELECT * FROM applicationdtlsmain_tbl 
        //                                              left join appinstinfomain_tbl on applicationdtlsmain_tbl.applicationdtlsmain_pk = appinstinfomain_tbl.appiim_applicationdtlsmain_fk
        //                                              left JOIN opalmemberregmst_tbl on applicationdtlsmain_tbl.appdm_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk
        //                                              LEFT JOIN memcompfiledtls_tbl ON opalmemberregmst_tbl.omrm_cmplogo = memcompfiledtls_tbl.memcompfiledtls_pk
        //                                              left JOIN opalusermst_tbl on memcompfiledtls_tbl.mcfd_opalmemberregmst_fk  = opalusermst_tbl.oum_opalmemberregmst_fk
        //                                              left join opalcitymst_tbl on appinstinfomain_tbl.appiim_citymst_fk = opalcitymst_tbl.opalcitymst_pk
        //                                              left join opalstatemst_tbl on appinstinfomain_tbl.appiim_statemst_fk = opalstatemst_tbl.opalstatemst_pk
        //                                              left join projectmst_tbl on applicationdtlsmain_tbl.appdm_projectmst_fk = projectmst_tbl.projectmst_pk
        //                                              left join appcoursedtlsmain_tbl on applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk = appcoursedtlsmain_tbl.appcdm_applicationdtlsmain_fk
        //                                              left join standardcoursemst_tbl on appcoursedtlsmain_tbl.appcdm_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk
        //                                              left join referencemst_tbl on appcoursedtlsmain_tbl.appcdm_RequestFor= referencemst_tbl.referencemst_pk
        //                                              WHERE applicationdtlsmain_pk = '$appMainId' and appdm_issuspended='2' GROUP BY applicationdtlsmain_pk")->queryAll();

        $stdCourDtls = \Yii::$app->db->createCommand("SELECT * FROM
        appcoursedtlsmain_tbl
           LEFT JOIN
       standardcoursemst_tbl ON appcoursedtlsmain_tbl.appcdm_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk
           LEFT JOIN
       referencemst_tbl ON appcoursedtlsmain_tbl.appcdm_RequestFor = referencemst_tbl.referencemst_pk
            LEFT JOIN
       applicationdtlsmain_tbl as a ON a.applicationdtlsmain_pk = appcoursedtlsmain_tbl.appcdm_applicationdtlsmain_fk
           LEFT JOIN
       appinstinfomain_tbl ON appcoursedtlsmain_tbl.appcdm_appinstinfomain_fk = appinstinfomain_tbl.appinstinfomain_pk
           LEFT JOIN
       opalmemberregmst_tbl ON a.appdm_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk
       LEFT JOIN
       applicationdtlsmain_tbl as b ON b.applicationdtlsmain_pk = appinstinfomain_tbl.appiim_applicationdtlsmain_fk and b.applicationdtlsmain_pk = '$appMainId'
    WHERE
       opalmemberregmst_pk = '$companyPk' and a.appdm_projectmst_fk = '2'
    GROUP BY a.applicationdtlsmain_pk")->queryAll();
 
         // $compDtls = \app\models\OpalmemberregmstTbl::find()
         //             ->select(['*'])
         //             ->Where(['opalmemberregmst_pk'=>$companyPk])
         //             ->asArray()
         //             ->one();
 
         // $appInsDtls = \app\models\AppinstinfotmpTbl::find()
         //             ->select(['*'])
         //             ->Where(['appiit_opalmemberregmst_fk'=>$companyPk])
         //             ->andWhere(['appiit_applicationdtlstmp_fk'=>$appMainDtls['appdm_applicationdtlstmp_fk']])
         //             ->asArray()
         //             ->one();
         // $oftype=$appInsDtls['appiit_officetype']; 
    
         // $courDtlsData = \Yii::$app->db->createCommand("SELECT appcdt_appoffercoursemain_fk,appcdt_standardcoursemst_fk from appcoursedtlstmp_tbl
         //                                                 left join appinstinfomain_tbl on(appcoursedtlstmp_tbl.appcdt_appoffercoursemain_fk = appinstinfomain_tbl.appinstinfomain_pk)
         //                                                 where appcdt_applicationdtlstmp_fk = '$appId' and appiim_officetype = '$oftype'")->queryAll();
 
                     
 
         
         // echo '<pre>';print_r($courDtlsData);exit;
         // $format_issDt = "";
         // if(!empty($appMainDtls['appdm_recognisedon'])){
         //     $format_issDt = date("d-m-Y", strtotime($appMainDtls['appdm_recognisedon']));
         // }
 
         // $format_dtofExp = "";
         // if(!empty($appMainDtls['appdm_certificateexpiry'])){
         //     $format_dtofExp = date("d-m-Y", strtotime($appMainDtls['appdm_certificateexpiry']));
         // }
         //echo '<pre>';print_r($ofCourDtls);exit;
         $data['ofrcour']=$ofCourDtls;
         $data['stdcour']=$stdCourDtls;
         $data['appstatus']=$appTmpDtls['appdt_status'];
         $data['comp']="";
         if(!empty($ofCourDtls)){
             $data['comp']=$ofCourDtls[0];
         }
         
         // $data['comp']['memreg']=$compDtls;
         // $data['comp']['appIns']=$appInsDtls;
         // $data['comp']['appIssue']=$format_issDt;
         // $data['comp']['appIssue']=$format_issDt;
         // $data['comp']['appExp']=$format_dtofExp;
         // $data['comp']['cour']=$format_dtofExp;
         
         
         if($stdCourDtls || $ofCourDtls){
             $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
         } else{
            $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
         }
         
         return $this->asJson($response);
     }
     public function actionGetviewdetailsras(){


        $companyPk = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $appMainId =  Security::decrypt($_GET['param']);
        $provider="";

        $appMainDtls = \app\models\ApplicationdtlsmainTbl::find()
                    ->select(['*'])
                    ->Where(['applicationdtlsmain_pk'=>$appMainId])
                    ->orderBy('applicationdtlsmain_pk desc')
                    ->asArray()
                    ->one();
        

        $appTmpDtls = \app\models\ApplicationdtlstmpTbl::find()
                    ->select(['*'])
                    ->Where(['applicationdtlstmp_pk'=>$appMainDtls['appdm_applicationdtlstmp_fk']])
                    ->asArray()
                    ->one();
        
        $ofCourDtls = \Yii::$app->db->createCommand("SELECT *, branchst.osm_statename_en as branchstate , mainst.osm_statename_en as mainstate, branch.ocim_cityname_en as branchcity , maincenter.ocim_cityname_en as maincity  FROM applicationdtlsmain_tbl 
                                                     left join appinstinfomain_tbl on applicationdtlsmain_tbl.applicationdtlsmain_pk = appinstinfomain_tbl.appiim_applicationdtlsmain_fk
                                                     left JOIN opalmemberregmst_tbl on applicationdtlsmain_tbl.appdm_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk
                                                     LEFT JOIN memcompfiledtls_tbl ON opalmemberregmst_tbl.omrm_cmplogo = memcompfiledtls_tbl.memcompfiledtls_pk
                                                     left JOIN opalusermst_tbl on memcompfiledtls_tbl.mcfd_opalmemberregmst_fk  = opalusermst_tbl.oum_opalmemberregmst_fk
                                                     left join opalstatemst_tbl as branchst on appinstinfomain_tbl.appiim_statemst_fk = branchst.opalstatemst_pk
                                                     left join opalstatemst_tbl as mainst on opalmemberregmst_tbl.omrm_opalstatemst_fk = mainst.opalstatemst_pk
                                                     left join opalcitymst_tbl as branch on appinstinfomain_tbl.appiim_citymst_fk = branch.opalcitymst_pk
                                                     left join opalcitymst_tbl as maincenter on opalmemberregmst_tbl.omrm_opalcitymst_fk = maincenter.opalcitymst_pk
                                                     left join projectmst_tbl on applicationdtlsmain_tbl.appdm_projectmst_fk = projectmst_tbl.projectmst_pk
                                                     LEFT JOIN appoffercoursemain_tbl on applicationdtlsmain_tbl.applicationdtlsmain_pk = appoffercoursemain_tbl.appocm_applicationdtlsmain_fk
                                                     LEFT JOIN coursecategorymst_tbl on appoffercoursemain_tbl.appocm_coursecategorymst_fk   =  coursecategorymst_tbl.coursecategorymst_pk
                                                     LEFT JOIN standardcoursemst_tbl on coursecategorymst_tbl.coursecategorymst_pk = standardcoursemst_tbl.scm_coursecategorymst_fk
                                                     left join referencemst_tbl on referencemst_tbl.referencemst_pk = appoffercoursemain_tbl.appocm_courselevel
                                                     WHERE applicationdtlsmain_pk = '$appMainId' GROUP BY appocm_coursename_en order by appoffercoursemain_pk asc")->queryAll();


        $category =  \app\models\ApprasvehinspcatmainTbl::find()  
        ->select(['apprasvehinspcatmain_pk','rascategorymst_pk','rcm_coursesubcatname_ar','rcm_coursesubcatname_en'])
        ->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvicm_rascategorymst_fk')
        ->where(['arvicm_applicationdtlsmain_fk'=>$appMainId])->asArray()->all(); 

        $stdCourDtls = \Yii::$app->db->createCommand("SELECT * FROM
        appcoursedtlsmain_tbl
           LEFT JOIN
       standardcoursemst_tbl ON appcoursedtlsmain_tbl.appcdm_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk
           LEFT JOIN
       referencemst_tbl ON appcoursedtlsmain_tbl.appcdm_RequestFor = referencemst_tbl.referencemst_pk
            LEFT JOIN
       applicationdtlsmain_tbl as a ON a.applicationdtlsmain_pk = appcoursedtlsmain_tbl.appcdm_applicationdtlsmain_fk
           LEFT JOIN
       appinstinfomain_tbl ON appcoursedtlsmain_tbl.appcdm_appinstinfomain_fk = appinstinfomain_tbl.appinstinfomain_pk
           LEFT JOIN
       opalmemberregmst_tbl ON a.appdm_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk
       LEFT JOIN
       applicationdtlsmain_tbl as b ON b.applicationdtlsmain_pk = appinstinfomain_tbl.appiim_applicationdtlsmain_fk and b.applicationdtlsmain_pk = '$appMainId'
    WHERE
       opalmemberregmst_pk = '$companyPk' and a.appdm_projectmst_fk = '2'
    GROUP BY a.applicationdtlsmain_pk")->queryAll();

         $data['ofrcour']=$ofCourDtls;
         $data['stdcour']=$stdCourDtls;
         $data['appstatus']=$appTmpDtls['appdt_status'];
         $data['comp']="";
         $data['category'] = $category;
         if(!empty($ofCourDtls)){
             $data['comp']=$ofCourDtls[0];
         }

   
         if($stdCourDtls || $ofCourDtls){
             $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
         } else{
            $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
         }
         
         return $this->asJson($response);
     }
 
     public function actionChangebanner(){
         $companyPk = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
         
         $bannerimage = $_REQUEST['bannerimageid'];
         $companybanner = \app\models\OpalmemberregmstTbl::findOne($companyPk);  
         $msg['status'] = 0;
         $companybanner->omrm_cmpbanner  = $bannerimage;
         if($companybanner->save()){
             $retbanner = $companybanner->omrm_cmpbanner;
             if(!empty($retbanner)){
                 $msg['retbannerimage']  = $retbanner;
             }else{
                 $msg['retbannerimage']  = "";
             }
             $msg['status'] = 1;
         }else{
             $msg['retbannerimage'] = "";
         }
         return $msg;
     }
 
     public function actionRemoveextbanner(){
         $companyPk = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
         
         $bannerimage = $_REQUEST['bannerimageid'];
         $companybanner = \app\models\OpalmemberregmstTbl::findOne($companyPk);  
         $msg['status'] = 0;
         $companybanner->omrm_cmpbanner  = NULL;
         if($companybanner->save()){
             if($companybanner->save()){
                 $msg['status'] = 1;
             }
             return $msg;
         }
     }

     public static function actionGetappstatus() {

        $offerInt   =  \app\models\AppoffercoursetmpTbl::find()->select(['appoct_status'])->where(['appoct_applicationdtlstmp_fk' => $_GET['param']])->asArray()->all();   
       foreach($offerInt as $key => $status){
        $offerarray[] = $status['appoct_status'];
   
        }
   
        if(in_array('3' , $offerarray)){
        $model['appoct_status'] = 3; 
        }
         if(in_array('4' , $offerarray)){
        $model['appoct_status'] = 4;
   
        }
        if(in_array('1' , $offerarray)){
   
        $model['appoct_status'] = 1; 
        }
         if(in_array('2' , $offerarray)){
        $model['appoct_status'] = 2; 
        }
   
        $staffInt   =  \app\models\AppstaffinfotmpTbl::find()->select(['appsit_status'])->where(['appsit_applicationdtlstmp_fk' => $_GET['param']])->asArray()->all();   
         foreach($staffInt as $key => $status){
           $staffarray[] = $status['appsit_status'];
   
        }
   
        if(in_array('3' , $staffarray)){
        $model['appsit_status'] = 3; 
        }
         if(in_array('4' , $staffarray)){
        $model['appsit_status'] = 4;
   
        }
        if(in_array('1' , $staffarray)){
   
        $model['appsit_status'] = 1; 
        }
        if(in_array('2' , $staffarray)){
        $model['appsit_status'] = 2; 
        }

     //international tab
       $interreg   =  \app\models\AppintrecogtmpTbl::find()->select(['appintit_status'])->where(['appintit_applicationdtlstmp_fk' => $_GET['param']])->asArray()->all();   
         foreach($interreg as $key => $status){
           $interregarray[] = $status['appintit_status'];
   
        }
   
        if(in_array('3' , $interregarray)){
        $model['appintit_status'] = 3; 
        }
         if(in_array('4' , $interregarray)){
        $model['appintit_status'] = 4;
   
        }
        if(in_array('1' , $interregarray)){
   
        $model['appintit_status'] = 1; 
        }
        if(in_array('2' , $interregarray)){
        $model['appintit_status'] = 2; 
        }
  

        //company tab
        $modelComp   = \app\models\AppcompanydtlstmpTbl::find()->select(['acdt_status'])->where(['acdt_applicationdtlstmp_fk' => $_GET['param']])->one();
        $model['acdt_status'] = $modelComp['acdt_status'];

        //institute tab
        $modelIns   =  \app\models\AppinstinfotmpTbl::find()->select(['appiit_status'])->where(['appiit_applicationdtlstmp_fk' => $_GET['param']])->one();
        $model['appiit_status'] = $modelIns['appiit_status'];

        //operator tab
        $modelCont   =  \app\models\AppoprcontracttmpTbl::find()->select(['appoprct_status'])->where(['appoprct_applicationdtlstmp_fk' => $_GET['param']])->asArray()->all(); 
         
        foreach($modelCont as $key => $status){
           $contractarray[] = $status['appoprct_status'];

        }
    
        if(in_array('3' , $contractarray)){
            $model['appoprct_status'] = 3; 
        }
        if(in_array('4' , $contractarray)){
        $model['appoprct_status'] = 4;

       }
       if(in_array('1' , $contractarray)){
     
        $model['appoprct_status'] = 1; 
       }
       if(in_array('2' , $contractarray)){
        $model['appoprct_status'] = 2; 
       }
       ///document reuqired tab
       $docInt   =  \app\models\AppdocsubmissiontmpTbl::find()->select(['appdst_status'])->where(['appdst_applicationdtlstmp_fk' => $_GET['param']])->asArray()->all();   
       foreach($docInt as $key => $status){
        $docarray[] = $status['appdst_status'];

        }
 
        if(in_array('3' , $docarray)){
        $model['appdst_status'] = 3; 
        }if(in_array('4' , $docarray)){
        $model['appdst_status'] = 4;

        }
        if(in_array('1' , $docarray)){

        $model['appdst_status'] = 1; 
        }
        if(in_array('2' , $docarray)){
        $model['appdst_status'] = 2; 
        }

            return $model;
   
   }

   public function actionUpdatesuspend(){

    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $username =  \yii\db\ActiveRecord::getTokenData('oum_firstname', true); 
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );
   
    $interId = $formdata['appdtlstmp_id'];
    $status = $formdata['status'];
    $apptmpPk = $formdata['appdtlstmp_id'];
   
    if($interId){
        $model = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
        if($model){
                $model->appdt_status =  $status;
                $model->appdt_updatedon = date("Y-m-d H:i:s");
                $model->appdt_updatedby = $userPk;
            if ($model->save() === TRUE) {
                \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                ->bindValue(':p1' , $interId)
                ->bindValue(':p2' , '')
                ->bindValue(':p3' , 1)
                ->execute();
                
               
                $appStatus = $model->appdt_status;
                $appType = $model->appdt_apptype;
            
                if($appStatus == 19 && $appType ==2 ){
                    \api\components\Mail::getCertificatests($apptmpPk,$regPk,'resuspendmail');   
                }elseif($appStatus == 17 && $appType ==2 ){
                    \api\components\Mail::getCertificatests($apptmpPk,$regPk,'reactivamail');   
                }
                
                
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $status,
                    'data' => $model,
                    'username' =>$username,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }


return $result;

}
public function actionGetUpdateData()
{
    $params = Yii::$app->request->post();
    $response['status'] = false;
    
    $model = AppstaffscheddtlsTbl::find()->where(['appstaffscheddtls_pk'=>$params['id']])->one();
    if($model){
        $response['status'] = true;
        $response['data'] = $model;
    }
    return $response;
}
public function actionUpdaterasapplication(){
    
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true); 
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'No Data',
    );

    $formatedData = \app\models\ApplicationdtlstmpTbl::getappoveralras($formdata);
    $array = array_values($formatedData);
  
 
      if($formdata['formdata']['select_valitate'] == 3){
         
       if(in_array(4,$array)){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the approval process for the certification form, please review and approve the section(s) that were declined.',
        );
        return $result;
        exit;
     }

     if($formatedData['appsit_status'] == '1' || $formatedData['appsit_status'] == '2'){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the approval process for the certification form, please review and approve the staff section(s) Individually.',
        );
        return $result;
        exit;

    }
    
    }

    if($formdata['formdata']['select_valitate'] == 4){
     
     if(in_array(1,$array)){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the decline process for the certification form, please review and decline the section(s) that were new.',
        );
        return $result;
        exit;
     }

     if(in_array(2,$array)){
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => '5',
            'comments' => 'In order to complete the decline process for the certification form, please review and decline the section(s) that were updated.',
        );
        return $result;
        exit;
     }
    
    }
      if($formatedData){
            $companystatus   =   $formatedData['acdt_status'];
            $insstatus       = $formatedData['appiit_status'];
            $submissionstatus   = $formatedData['appdst_status'];
            $inspectiontatus   = $formatedData['arvict_status'];
            $staffstatus   = $formatedData['appsit_status'];

            if($companystatus == '1' || $companystatus == '2'){
                $this->actionUpdatecompany();
        
            }
            if($insstatus == '1' || $insstatus == '2'){
                $this->actionUpdateinstitute();
        
            }
           
            if($submissionstatus == '1' || $submissionstatus == '2'){
                $this->actionUpdatedocAll();
        
            }
            if($inspectiontatus == '1' || $inspectiontatus == '2'){
                $this->actionUpdateinspectionall();
        
            }
            if($staffstatus == '1' || $staffstatus == '2'){
                $this->actionUpdatestaffall();
        
            }
        
           }

        

    $interId = Security::decrypt($formdata['formdata']['appdtlstmp_id']);
 
    if($interId){
        $model = \app\models\ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk =:pk", [':pk' => $interId])->one();
        $companyregpk = $model['appdt_opalmemberregmst_fk'];
        $memcompanymodel = \app\models\OpalmemberregmstTbl::find()->where("opalmemberregmst_pk =:pk", [':pk' => $companyregpk])->one();
        $companycrnumber = $memcompanymodel['omrm_opalmembershipregnumber'];
        $apptype = $model->appdt_apptype;
        if($apptype == 1){
            $approvaltype = 1;
        }else if($apptype == 2){
            $approvaltype = 4;
    
        }else if($apptype == 3){
            $approvaltype = 2;

        }
        if($model){
            if($formdata['formdata']['select_valitate'] == 3){
                if($apptype == 1 || $apptype == 2){
                  $status = 5;
                  }
                  if($apptype == 3){
                    $staffcountdata =  \app\models\AppstaffinfotmpTbl::find()
                    ->select(['staffevaluationtmp_pk'])
                    ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
                    ->where(['appsit_applicationdtlstmp_fk' => $model->applicationdtlstmp_pk])
                    ->andWhere(['IS NOT', 'set_staffevanfee', null])
                    ->andWhere(['set_asmttype' => 1])
                    ->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])
                    ->groupBy('set_appstaffinfotmp_fk')
                    ->asArray()
                    ->count();

                    if(($staffcountdata > 0)&&  ($model->appdt_status == 2 ||  $model->appdt_status == 4)){
                        $approvaltype = 3;
                        $status = 5;
        
                    }else{
                        if($model->appdt_status == 2 || $model->appdt_status == 4){
                            $status = 10;
                            $info = SiteAudit::getApprovalHdrInfo(4,  $approvaltype , 3);  
                        }
                        if($model->appdt_status == 10 ){
                           $status = 11;
                           $info = SiteAudit::getApprovalHdrInfo(4,  $approvaltype , 4); 
                        
                       }
                       if($model->appdt_status == 11 ){
                           $status = 17;
                       }
                       if($model->appdt_status == 20 ){
                        $status = 10;
                    }
                       $model->appdt_status = $status;
                  
                    }
                  
                  }
                  }else{
                    if($apptype == 1 || $apptype == 2){
                 
                      $status = 3;
                     }
                   
                   if($apptype == 3){
                    if($model->appdt_status == 2 || $model->appdt_status == 4){
                        $status = 3;
                    }
                    if($model->appdt_status == 10 ){
                       $status = 20;
                   }
                   if($model->appdt_status == 11 ){
                       $status = 20;
                   }
                   if($model->appdt_status == 20 ){
                    $status = 3;
                  }
                 }
                }
              
                $model->appdt_status =  $status;
                $model->appdt_appdeccomment = strval($formdata['formdata']['comments']);
                $model->appdt_appdecon = date("Y-m-d H:i:s");
                $model->appdt_appdecby = $userPk;

                if($status == 17){
                    //SiteAudit::appstaffinfomain($model->applicationdtlstmp_pk,4);
                    $appsta =  \app\models\AppstaffinfotmpTbl::find()
                    ->where(['appsit_applicationdtlstmp_fk' => $model->applicationdtlstmp_pk])
                    ->asArray()->all();
                    if(!empty($appsta)){
                    foreach($appsta as $app){
                        $appstaf =  \app\models\AppstaffinfotmpTbl::find()
                        ->where(['appostaffinfotmp_pk' => $app['appostaffinfotmp_pk']])
                        ->one();
                        $appstaf->appsit_iscarddetails = 2;
                        $appstaf->save();
            
                    }
                }
                }
             
                //update approval
               $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $interId])->orderBy('appapprovalhdr_pk desc')->one();
  //             print_R($updatemodel);
               if($updatemodel){
                   if($formdata['formdata']['select_valitate'] == 3){
                       $approvalstatus = 1;
                   }else{
                       $approvalstatus = 2;
                   }
               $updatemodel->aah_status = $approvalstatus;
               $updatemodel->aah_appdecComments = strval($formdata['formdata']['comments']);
               $updatemodel->aah_appdecon = date("Y-m-d H:i:s");
               $updatemodel->aah_appdecby = $userPk;
              // $updatemodel->aah_formstatus =  $approvaltype;
               $updatemodel->save();
               }

               //insert approval

            if($status == 10 || $status == 11){
               $modelhdr = new AppapprovalhdrTbl;
               $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
               $modelhdr->aah_projapprovalworkflowdtls_fk = $info['projapprovalworkflowdtls_pk'];
               $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
               $modelhdr->aah_applicationdtlstmp_fk = $interId;
               $modelhdr->aah_formstatus =$approvaltype;
               $modelhdr->aah_status = null;
               $modelhdr->save(); 
             }

              
            if ($model->save() === TRUE) {
                    \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $interId)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 4)
                    ->execute();

                       if($status == 5){
                        $feesmodel = \app\models\FeeSubscriptionmstTbl::find()->where(['fsm_projectmst_fk' => $model['appdt_projectmst_fk'],'fsm_applicationtype' => $model['appdt_apptype']])->one();
                        
                        $fsmfee = 0;
                        if($apptype != 3){
                            $fsmfee  = $feesmodel['fsm_fee'];
                        }
                        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);                     
                        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
                        $crno =   \yii\db\ActiveRecord::getTokenData('omrm_crnumber', true);
                      

                        //staff count 


                        $staffcountdata = \app\models\AppstaffinfotmpTbl::find()
                        ->select(['staffevaluationtmp_pk'])
                        ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
                        ->where(['appsit_applicationdtlstmp_fk' => $interId])
                        ->andWhere(['IS NOT', 'set_staffevanfee', null])
                       // ->andWhere(['set_asmttype' => 1])
                        ->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])
                        ->groupBy('set_appstaffinfotmp_fk')
                        ->asArray()
                        ->count();
                        
                 

                        //fee data
                        $staffdata = \Yii::$app->db->createCommand(" select staffevaluationtmp_pk, set_staffevanfee,set_appstaffinfotmp_fk
                        from( select staffevaluationtmp_pk, set_staffevanfee,set_appstaffinfotmp_fk, ROW_NUMBER() OVER(PARTITION BY set_appstaffinfotmp_fk ORDER BY staffevaluationtmp_pk desc) as rn
                        FROM `appstaffinfotmp_tbl` LEFT JOIN `staffevaluationtmp_tbl` ON set_appstaffinfotmp_fk = appostaffinfotmp_pk WHERE (`appsit_applicationdtlstmp_fk`='$interId')   AND (`set_apppytminvoicedtls_fk` IS  NULL)  ) as a
                        ")->queryAll();
                     
                        if(!empty($staffdata)) {
                            foreach($staffdata as $stafffee) {
                                if(!empty($stafffee['set_staffevanfee']) && $stafffee['set_staffevanfee'] != null){
                                    $steval_fee = $steval_fee + $stafffee['set_staffevanfee'];
                                }
                            }
                           
                            $vatamount =   (($fsmfee + $steval_fee) * (5 / 100));
                        } else {
                            $vatamount =   ($fsmfee * (5 / 100));
                        }
                        

                      //save invoice
                        $requestdataI['apid_opalmemberregmst_fk'] = $companyregpk;
                        $requestdataI['apid_applicationdtlstmp_fk'] = $interId;
                        $requestdataI['apid_feesubscriptionmst_fk'] = ($feesmodel['feesubscriptionmst_pk'])?$feesmodel['feesubscriptionmst_pk']:0;
                    //    $requestdataI['apid_invoiceno'] = '12345';
                        $requestdataI['apid_raisedon'] =  date("Y-m-d H:i:s");
                        $requestdataI['apid_coursecertfee'] = ($apptype != 3)?$feesmodel['fsm_fee']:0;
                        $requestdataI['apid_vatamount'] = $vatamount;
                        $requestdataI['apid_vatpercent'] = 5;
                        $requestdataI['apid_invoicestatus'] = 1;
                        $requestdataI['apid_noofstaffeval'] =$staffcountdata;
                        $requestdataI['apid_staffevalfee'] = $steval_fee;
                       
                        $data = AppCenter::saveAppInvoice($requestdataI);
                
                        $pk = $data;
                        $year = date("Y");
                        
                        if($apptype == 1){
                            $invoiceno = 'INV-'.$companycrnumber.'-CRI-'.$year.'-'.$pk;
                        }else if($apptype == 2){
                            $invoiceno = 'INV-'.$companycrnumber.'-CRR-'.$year.'-'.$pk;
                        }else{
                            $invoiceno = 'INV-'.$companycrnumber.'-CRU-'.$year.'-'.$pk; 
                        }
                       
                        $requestdataU['apid_invoiceno'] = $invoiceno;
                        $requestdataU['apppytminvoicedtls_pk'] = $pk;
             
                        $data = AppCenter::updateInvoiceNo($requestdataU);
              
                    
                      //save payment

        
                        $requestdata['apppdt_opalmemberregmst_fk'] = $companyregpk;
                        $requestdata['apppdt_apppytminvoicedtls_fk'] = $data;
                        $requestdata['apppdt_applicationdtlstmp_fk'] = $interId;
                        $requestdata['apppdt_paymenttype'] = 2;
                        $requestdata['apppdt_currency'] = 1;
                        $requestdata['apppdt_amount'] = ($apptype != 3)?$feesmodel['fsm_fee']:0;
                        $requestdata['apppdt_vatchrgs'] = $vatamount;
                        $requestdata['apppdt_vatpercent'] = 5;
                        $requestdata['apppdt_requesttype'] = $model['appdt_projectmst_fk'];
                        $requestdata['apppdt_orderrefno'] = '12345';
                        $requestdata['apppdt_createdon'] = date("Y-m-d H:i:s");
                        $requestdata['apppdt_createdby'] = $userPk;
                        $requestdata['apppdt_noofstaffeval'] =$staffcountdata;
                        $requestdata['apppdt_staffevalfee'] = $steval_fee;
                        $data = AppCenter::saveAppPayment($requestdata);

                    $staffinvdata =  \app\models\AppstaffinfotmpTbl::find()
                    ->select(['staffevaluationtmp_pk','set_staffevanfee'])
                    ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
                    ->where(['appsit_applicationdtlstmp_fk' => $interId]) 
                    ->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])
                    ->asArray()
                    ->all();
              

                    if(!empty($staffinvdata)){
                    foreach($staffinvdata as $staffinvval){
                    $staffevalpk = $staffinvval['staffevaluationtmp_pk'];
                    $staffevaltbl =  \app\models\StaffevaluationtmpTbl::findOne($staffevalpk);
                    if(!empty($staffevaltbl)) {
                    $staffevaltbl->set_apppytminvoicedtls_fk = $pk;
                    $staffevaltbl->save();
                    }
                    }
                    }
                    
             
                    }

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'In order to complete the approval process for the certification form, please review and approve the section(s) that were declined.',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }
    /*if($userdata_other['pks']){
        $model_other = AppstaffscheddtlsTbl::find()->where('assd_appstaffinfotmp_fk in ('.$userdata_other['pks'].')')->andWhere([
            'assd_date' => date('Y-m-d', strtotime($data['selectedDate']['startDate'])),
            'assd_dayschedule' => 32
        ])->asArray()->all();
    }
    foreach ($model_other as $schedule) {
        $startTime = strtotime($schedule['assd_starttime']);
        $endTime = strtotime($schedule['assd_endtime']);
        if (strtotime($newInputTime) >= $startTime && strtotime($newInputTime) < $endTime || strtotime($newInputTime) < $endTime && strtotime($EndTime) > $startTime) {
            $response['status'] = false;
            $response['message'] = "This Staff member is already booked for the selected date and time with different course. Kindly select a different date and time.";
            return $response;
        }
    }*/
}

    public function actionEditBooking()
{
    $data = Yii::$app->request->post();
    $data = $data['data'];
    $response['status'] = false;
    $model = AppstaffscheddtlsTbl::find()->where([
        'assd_appstaffinfotmp_fk' => $data['staffinfo'],
        'assd_date' => date('Y-m-d', strtotime($data['selectedDate']['startDate']))
    ])->asArray()->all();


    $userdata =  AppstaffinfotmpTbl::find()->where('appostaffinfotmp_pk = '.$data['staffinfo'])->asArray()->one();
    $userdata_other =  AppstaffinfotmpTbl::find()->select(['group_concat(appostaffinfotmp_pk) as pks'])->where('appsit_staffinforepo_fk = '.$userdata['appsit_staffinforepo_fk'].' and appostaffinfotmp_pk != '.$data['staffinfo'])->asArray()->one();

    
    $newInputTime =date('Y-m-d', strtotime($data['selectedDate']['startDate'])).' '.$data['startDate'];
    $EndTime =date('Y-m-d', strtotime($data['selectedDate']['startDate'])).' '.$data['EndDate'];
    $isTimeAvailable = true;
    foreach ($model as $schedule) {
        if($data['id'] == $schedule['appstaffscheddtls_pk']){
            continue;
        }
        $startTime = strtotime($schedule['assd_starttime']);
        $endTime = strtotime($schedule['assd_endtime']);

        if (strtotime($newInputTime) >= $startTime && strtotime($newInputTime) < $endTime || strtotime($newInputTime) < $endTime && strtotime($EndTime) > $startTime) {
            $response['status'] = false;
            $response['message'] = "The selected date and time is already scheduled for the staff. Please Choose a different date and time.";
            return $response;
        }
    }
    if($userdata_other['pks']){
        $model_other = AppstaffscheddtlsTbl::find()->where('assd_appstaffinfotmp_fk in ('.$userdata_other['pks'].')')->andWhere([
            'assd_date' => date('Y-m-d', strtotime($data['selectedDate']['startDate'])),
            'assd_dayschedule' => 32
        ])->asArray()->all();
    }
    foreach ($model_other as $schedule) {
        $startTime = strtotime($schedule['assd_starttime']);
        $endTime = strtotime($schedule['assd_endtime']);
        if (strtotime($newInputTime) >= $startTime && strtotime($newInputTime) < $endTime || strtotime($newInputTime) < $endTime && strtotime($EndTime) > $startTime) {
            $response['status'] = false;
            $response['message'] = "This Staff member is already booked for the selected date and time with different course. Kindly select a different date and time.";
            return $response;
        }
    }

    $model = AppstaffscheddtlsTbl::find()->where(['appstaffscheddtls_pk'=>$data['id']])->one();
    // $datePeriod = AppstaffinfomainTbl::dates($data['selectedDate']['startDate'],$data['selectedDate']['endDate']);
    if($model){
        $starttime = date('Y-m-d', strtotime($data['selectedDate']['startDate'])).' '.$data['startDate'];
        $endtime = date('Y-m-d', strtotime($data['selectedDate']['startDate'])).' '.$data['EndDate'];
        // 
        $model->assd_date=  date('Y-m-d', strtotime($data['selectedDate']['startDate']));
        $model->assd_starttime=  $starttime;
        $model->assd_endtime = $endtime;
        if($model->save()){
            $response['status'] = true;
            $response['message'] = "The time slot has been updated successfully.";
        }
    }

    return $response;
    }
   
public function actionGetrasinspectioncategory(){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    //,'rcm_projectmst_fk'=>$data['projecttype']
    $inspectioncategory = RascategorymstTbl::find()->where(['rcm_status'=>1])->asArray()->all();
    return  $inspectioncategory;
}
public function actionSaveinspectioncategory(){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

    $applicationpk =  $data['appliationpk'];
        $institueinffotmp = \app\models\AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' =>$applicationpk])->one();
        foreach($data['formvalue']['inspectionSelect'] as $rascategorypk){
            $rascategorytmp = \app\models\ApprasvehinspcattmpTbl::find()->where(['arvict_applicationdtlstmp_fk'=>$applicationpk,'arvict_rascategorymst_fk'=>$rascategorypk])->one();

            if(empty($rascategorytmp)){
                $rascategorytmp = new \app\models\ApprasvehinspcattmpTbl();
                $rascategorytmp->arvict_applicationdtlstmp_fk =$applicationpk;
                $rascategorytmp->arvict_appinstinfotmp_fk = $institueinffotmp->appinstinfotmp_pk;
                $rascategorytmp->arvict_rascategorymst_fk =  $rascategorypk;
                $rascategorytmp->arvict_createdon = date("Y-m-d H:i:s");
                $rascategorytmp->arvict_createdby = $userPk;
                $rascategorytmp->arvict_status = 1;

            }else{
                $rascategorytmp->arvict_applicationdtlstmp_fk =$applicationpk;
                $rascategorytmp->arvict_appinstinfotmp_fk = $institueinffotmp->appinstinfotmp_pk;
                $rascategorytmp->arvict_rascategorymst_fk =  $rascategorypk;
                $rascategorytmp->arvict_updatedon = date("Y-m-d H:i:s");
                $rascategorytmp->arvict_updatedby = $userPk;
                // $rascategorytmp->arvict_status = 5;
            }
           if(!$rascategorytmp->save()){
             return $rascategorytmp->getErrors();
           }
        }

    return  true;
}
public function actionGetrascategorydata(){
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $pageSize =empty($data['limit'])?10:$data['limit'];
    $page =empty($data['page'])?0:$data['page'];;
    $applicationpk = $data['applicationpk'];
   

    $datalist = \app\models\ApprasvehinspcattmpTbl::find()  
    ->select(['apprasvehinspcattmp_pk','rascategorymst_pk','rcm_coursesubcatname_ar','rcm_coursesubcatname_en','arvict_status','DATE_FORMAT(arvict_createdon,"%d-%m-%Y") as  inspectcreatedon','DATE_FORMAT(arvict_updatedon,"%d-%m-%Y") as  inspectlastupdate'])
    ->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvict_rascategorymst_fk')
    ->where(['arvict_applicationdtlstmp_fk'=>$applicationpk]);
    // $datalist->andwhere("applicationdtlstmp_pk in (626,533,648,1147,1253) ");
    // $a =  $datalist->createCommand()->getRawSql();
    // print($a);exit;
   
        if(!empty($data['serachkey']['inspectcat_serch'])){
            $datalist->andwhere("arvict_rascategorymst_fk in (".implode(",",$data['serachkey']['inspectcat_serch']).")");
        }
        if(!empty($data['serachkey']['InspectStatus_serch'])){
            $datalist->andwhere("arvict_status in (".implode(",",$data['serachkey']['InspectStatus_serch']).")");
        }
        if(!empty($data['serachkey']['inspectAddedon_serch']['startDate'])){
            $datalist->andwhere("arvict_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['inspectAddedon_serch']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['inspectAddedon_serch']['endDate']))."'");
        }
        if(!empty($data['serachkey']['inpectLastUpdated_serch']['startDate'])){
            $datalist->andwhere("arvict_updatedon  between '".date("Y-m-d", strtotime($data['serachkey']['inpectLastUpdated_serch']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['inpectLastUpdated_serch']['endDate']))."'");
        }
        
    
    $datalist->asArray();
//  $a =  $datalist->createCommand()->getRawSql();
// print_r( $a);exit;

    $dataProvider = new ActiveDataProvider([
        'query' =>  $datalist,
        'pagination' => [
                            'pageSize' =>$pageSize,
                            'page'=>$page
                        ]
            ]);
    $rascat = \app\models\ApprasvehinspcattmpTbl::find()  
    ->select(['group_concat(arvict_rascategorymst_fk) as catergorypk'])
    ->where(['arvict_applicationdtlstmp_fk'=>$applicationpk])->asArray()->one();

    $allrecords = $dataProvider->getModels();
    $recodsset =[];
    $recodsset['applydata'] = $allrecords;
    $recodsset['pagesize'] = $pageSize;
    $recodsset['totalcount'] = $dataProvider->getTotalCount();
    $recodsset['rascaregory'] = explode(',',$rascat['catergorypk']);

   
    return ['record' => $recodsset];
}

public function actionGetrasrole(){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $rasrole = \app\models\RolemstTbl::find()
                ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                ->Where(['rm_projectmst_fk'=>$data['projecttype'],'rm_status'=>1])
                ->asArray()
                ->all();
    return ['role'=>$rasrole];
}

public function actionStaffconfigurationcheckinras(){
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $applioctionpk =  $data['staff']['appdtlstmp_id'];
    $rascat = \app\models\ApprasvehinspcattmpTbl::find()  
    ->select(['group_concat(arvict_rascategorymst_fk) as catergorypk','group_concat(apprasvehinspcattmp_pk) as rascatpk'])
    ->where(['arvict_applicationdtlstmp_fk'=>$applioctionpk])->asArray()->one();
    $stafftmp =  \app\models\AppstaffinfotmpTbl::find()
    ->select(['appostaffinfotmp_pk','appsit_roleforcourse','appsit_apprasvehinspcattmp_fk'])
    ->where('appsit_applicationdtlstmp_fk = '.$applioctionpk)->asArray()->all();
    $datalist = \app\models\ApprasvehinspcattmpTbl::find()  
    ->select(['apprasvehinspcattmp_pk','rascategorymst_pk','rcm_coursesubcatname_ar','rcm_coursesubcatname_en','arvict_status','DATE_FORMAT(arvict_createdon,"%d-%m-%Y") as  inspectcreatedon','DATE_FORMAT(arvict_updatedon,"%d-%m-%Y") as  inspectlastupdate'])
    ->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvict_rascategorymst_fk')
    ->where(['arvict_applicationdtlstmp_fk'=>$applioctionpk])->asArray()->all();
    $array1 =explode(',',$rascat['rascatpk']);
    $roles = array(16 => 'Inspector', 17 => 'Verifier', 18 => 'Supervisor');

    $result = array();

    foreach ($array1 as $value) {
        $result[$value] = array(
            'Inspector_count' => 0,
            'Verifier_count' => 0,
            'Supervisor_count' => 0
        );
    }

        foreach ($stafftmp as $element) {
            // Get the appsit_apprasvehinspcattmp_fk value from the element
            $appsit_apprasvehinspcattmp_fk = $element['appsit_apprasvehinspcattmp_fk'];
            $apprasvehinspcattmp_fk_array = explode(',', $appsit_apprasvehinspcattmp_fk);

            // Check if the value from Array 1 is present in appsit_apprasvehinspcattmp_fk
            foreach ($array1 as $value) {
                foreach ($apprasvehinspcattmp_fk_array as $roleId) {
                    if ($roleId == $value) {
                        // Increment the corresponding count based on the role
                        $appsit_roleforcourse = $element['appsit_roleforcourse'];
                        $role_array = explode(',', $appsit_roleforcourse);
                        foreach ($role_array as $roleId) {
                            if (isset($roles[$roleId])) {
                                $roleName = $roles[$roleId];
                                $result[$value][$roleName . '_count']++;
                            }
                        }
                    }
                }
            }
        }
 
    //16-Inspector 17-Verifier 18-Supervisor
    $inspector = 1;
    $verifer = 1;
    $superviser = 1;
    foreach($result as $key=>$value){
                
        if($result[$key]['Inspector_count'] >=  $inspector){
           
            $result[$key]['status'.'_16'] = 'ok';

        }else{
            $result[$key]['remain'.'_16'] = abs($result[$key]['Inspector_count']-$inspector);
            $result[$key]['status'.'_16'] = 'notok';
        }
        if($result[$key]['Verifier_count'] >= $verifer){
            $result[$key]['status'.'_17'] = 'ok';

        }else{
            $result[$key]['remain'.'_17'] = abs($result[$key]['Verifier_count']-$verifer);
            $result[$key]['status'.'_17'] = 'notok';
        }
        if($result[$key]['Supervisor_count'] >= $superviser){
            $result[$key]['status'.'_18'] = 'ok';

        }else{
            $result[$key]['remain'.'_18'] = abs($result[$key]['Supervisor_count']-$superviser);
            $result[$key]['status'.'_18'] = 'notok';
        }
    }
    $isNotOkPresent = false;

    foreach($result as $key=>$value){
        if ($value['status_16'] === 'notok' || $value['status_17'] === 'notok' || $value['status_18'] === 'notok') {
            $isNotOkPresent = true;
            break;
        }
    }
    foreach ($datalist as $data) {
        $pk = $data['apprasvehinspcattmp_pk'];
        if (isset($result[$pk])) {
            $result[$pk]['rcm_coursesubcatname_en'] = $data['rcm_coursesubcatname_en'];
            $result[$pk]['rcm_coursesubcatname_ar'] = $data['rcm_coursesubcatname_ar'];
        }
    }

    if ($isNotOkPresent) {
        $string_en = '';
        $string_ar = '';
        $string_en .='
        <p style="min-height: 140px;">To proceed with the Desktop Review, it is necessary to ensure that the minimum required staff are added for all the selected course sub-categories. The table below displays the number of staff yet to be added under each category, based on the minimum staff requirements. Kindly add the required staff members before proceeding further.</p>
        <table border="1"  style="border-collapse: collapse; width: 100%;text-align: left;">';
      
            $ins = 'Inspector';
            $veri = 'Verifier';
            $super = 'Supervisor';
            $two_ar = '??????';
            $three_ar = '???????';
            $four_ar = '???? ????????';
            foreach ($result as $key => $value) { 
                $ccmCatnameEn = '<tr>'.'<td style="padding:5px 10px">'.$value['rcm_coursesubcatname_en'].'</td>';
                $string_en .=$ccmCatnameEn;
            if ($value['status_16'] === 'notok') {
                $string_en .= '<td style="padding:5px 10px">'.$value['remain_16'] . ' ' . $ins .'</td>';
                $string_ar .= $value['remain_16'] . ' ' . $four_ar . ', ';
            }
            if ($value['status_17'] === 'notok') {
                $string_en .= '<td style="padding:5px 10px">'.$value['remain_17'] . ' ' . $veri .'</td>';
                $string_ar .= $value['remain_17'] . ' ' . $two_ar . ', ';

            }
            if ($value['status_18'] === 'notok') {
                $string_en .= '<td style="padding:5px 10px">'.$value['remain_18'] . ' ' . $super . '</td>';
                $string_ar .= $value['remain_17'] . ' ' . $three_ar . ', ';

            }
            $string_en .="</tr>";
       
        }
        $string_en .='</table>';

        $string_en = rtrim($string_en, ', ');
        $string_ar = rtrim($string_en, ', ');
        $status = 'notok';
        
    } else {
        
        $counts = array();
// print_r($stafftmp);
        foreach ($stafftmp as $item) {
            $values = explode(',', $item['appsit_apprasvehinspcattmp_fk']);
            foreach ($values as $value) {
                $value = trim($value);
                if (!isset($counts[$value])) {
                    $counts[$value] = array('staff_count' => 0);
                }
                $counts[$value]['staff_count']++;
            }
        }

        $no_of_staff = 2;
         foreach($counts as $key =>$value){
            if($value['staff_count'] <  $no_of_staff){
                $counts[$key]['status'] = 'notok';
                $counts[$key]['remain'] = abs($value['staff_count']-$no_of_staff);

            }
         }
         $isNotOkPresent_2 = false;
         foreach($counts as $key=>$value){
            if ($value['status'] === 'notok') {
                $isNotOkPresent_2 = true;
                break;
            }
        }
    if($isNotOkPresent_2){
        foreach ($datalist as $data) {
            $pk = $data['apprasvehinspcattmp_pk'];
            if (isset($result[$pk])) {
                $counts[$pk]['rcm_coursesubcatname_en'] = $data['rcm_coursesubcatname_en'];
                $counts[$pk]['rcm_coursesubcatname_ar'] = $data['rcm_coursesubcatname_ar'];
            }
        }

        $string_en = '';
        $string_ar = '';
        $string_en .='
        <p style="min-height: 140px;display: flex;text-align: left;">To proceed with the Desktop Review, it is necessary to ensure that the minimum required staff are added for all the selected Inspection Categories. The table below displays the number of staff yet to be added under each category, based on the minimum staff requirements. Kindly add the required staff members before proceeding further.</p>
        <table border="1"  style="border-collapse: collapse; width: 100%;text-align: left;">';
      
            foreach ($counts as $key => $value) { 
                $ccmCatnameEn = '<tr>'.'<td style="padding:5px 10px">'.$value['rcm_coursesubcatname_en'].'</td>';
                $string_en .=$ccmCatnameEn;
            if ($value['status'] === 'notok') {
                $string_en .= '<td style="padding:5px 10px">'.$value['remain'] . ' ' . 'Staff needed' .'</td>';
                $string_ar .= $value['remain'] . ' ' . 'Staff needed' . ', ';
            }
           
            $string_en .="</tr>";
       
        }
        $string_en .='</table>';

        $string_en = rtrim($string_en, ', ');
        $string_ar = rtrim($string_en, ', ');
        $status = 'notok';
    }else{
        $status = 'ok';
    }
        // print_r($counts);exit;
    $staffdocumentdata = AppstaffinfotmpTbl::find()->select(['appsit_roleforcourse','sir_civilidfront','sir_moheridoc','sld_ROPlicenseupload'])
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk= appsit_staffinforepo_fk')
                ->leftJoin('Stafflicensedtls_Tbl','sld_staffinforepo_fk = appsit_staffinforepo_fk')
                ->where('appsit_roleforcourse in (16) and appsit_applicationdtlstmp_fk = '.$applioctionpk)
                ->asArray()->all();

                $allfilled = 'yes';
        if(!empty($staffdocumentdata)){
            foreach($staffdocumentdata as $staffdata){
                if(empty($staffdata['sir_civilidfront']) || empty($staffdata['sir_moheridoc']) || empty($staffdata['sld_ROPlicenseupload'])){
                    $allfilled = 'no';
                    break;
                }
            }
        }


    }
  
return['status'=>$status,'msg_en'=>$string_en,'msg_ar'=>$string_ar,'allfilled'=>$allfilled];
}

function isValuePresent($element, $value) {
    $appsit_apprasvehinspcattmp_fk = $element['appsit_apprasvehinspcattmp_fk'];
    $values_array = explode(',', $appsit_apprasvehinspcattmp_fk);
    return in_array($value, $values_array);
}

public function actionRascheckvehicalcateforymap(){

    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $applicationpk = $data['formValue']['appdtlstmp_id'];
    $rascategorypk = $data['formValue'] ['rascatpk'];
    $stafftmp =  \app\models\AppstaffinfotmpTbl::find()->where('appsit_applicationdtlstmp_fk = '.$applicationpk)->asArray()->all();
    
    // Configurable value to check
    $valueToCheck = $rascategorypk;
    
    // Check if the configurable value is present in any of the elements
    $hasValue = false;
    foreach ($stafftmp as $element) {
        if ($this->isValuePresent($element, $valueToCheck)) {
            $hasValue = true;
            break;
        }
    }
    
    // Output the result
    if ($hasValue) {
        $mapped = 'yes';
    } else {
        $mapped = 'no';    
        
        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        \app\models\ApprasvehinspcattmpTbl::deleteAll(['IN', 'apprasvehinspcattmp_pk', $rascategorypk]);
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
    }
   
    return['mapped'=>$mapped];
}
public function actionCheckmainofficealreadyapplied(){
    $memRegPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);

    $institiuedata =  \app\models\AppinstinfotmpTbl::find()
    ->select(['group_concat(appiit_officetype) as officetype'])
    ->leftjoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appiit_applicationdtlstmp_fk')
    ->where('appdt_projectmst_fk = 4 and appiit_opalmemberregmst_fk = '.$memRegPk)->asArray()->one();

    $tmpdata =  ApplicationdtlstmpTbl::find()->Select('*')->where(['appdt_projectmst_fk' =>4 ,'appdt_opalmemberregmst_fk'=>$memRegPk,'appdt_isprimarycert'=>1])->asArray()->one();

    $maindata = ApplicationdtlsmainTbl::find()->Select('applicationdtlsmain_pk')->where(['appdm_applicationdtlstmp_fk' =>$tmpdata['applicationdtlstmp_pk'] ])->asArray()->one();

    $tmpdata_center =  ApplicationdtlstmpTbl::find()->Select('*')->where(['appdt_projectmst_fk' =>1 ,'appdt_opalmemberregmst_fk'=>$memRegPk])->asArray()->one();

    $maindata_center = ApplicationdtlsmainTbl::find()->Select('applicationdtlsmain_pk')->where(['appdm_applicationdtlstmp_fk' =>$tmpdata_center['applicationdtlstmp_pk'] ])->asArray()->one();
     // main office already appliied or not
    $officedata = explode(',',$institiuedata['officetype']);
    if(in_array('1',$officedata)){
        $check = 'yes';
    }else{
        $check = 'no';
    }

    if(empty($maindata)){
        $aleradycerified = 'no';
        
    }else{
        $aleradycerified = 'yes';

    }
    if(empty($maindata_center)){
        $aleradycerified_center = 'no';
        
    }else{
        $aleradycerified_center = 'yes';

    }
 
    return['checked'=>$check,
    'aleradycerified'=>$aleradycerified,'applied'=>$tmpdata['appdt_status'],'applieddata'=>$tmpdata,
    'aleradycerified_center'=>$aleradycerified_center,'applied_center'=>$tmpdata_center['appdt_status'],'applieddata_center'=>$tmpdata_center
     ];
}

public function actionGetinspection(){
   
    $formatedData = \app\models\ApprasvehinspcattmpTbl::getInspection();
   return $this->asJson([
          'data' => $formatedData,
          'msg' => 'Success',
          'status' => 100,
      ]);
}


public function actionUpdateinspection(){
    $request_body = file_get_contents('php://input');
    $formdata = json_decode($request_body, true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $result = array(
        'status' => 200,
        'msg' => 'warning',
        'flag' => 'E',
        'comments' => 'Please click on the Check Box and proceed further',
    );

    
    foreach($formdata['formdata']['appdtlstmp_id'] as $interId){
  
        if($interId){
        $model = \app\models\ApprasvehinspcattmpTbl::find()->where("apprasvehinspcattmp_pk =:pk", [':pk' => $interId])->one();
        if($model){
                $model->arvict_status =  (int)$formdata['formdata']['select_valitate'];
                $model->arvict_appdecComments = strval($formdata['formdata']['comments']);
                $model->arvict_appdecon = date("Y-m-d H:i:s");
                $model->arvict_appdecby = $userPk;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $formdata['formdata']['select_valitate'],
                    'data' => $model,
                    'comments' => 'Status Updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
        }
    }
}


return $result;

}

public function actionGetinspectiondata(){
    
        $formatedData = \app\models\ApprasvehinspcattmpTbl::getInspectiondata();
        return $this->asJson([
        'data' => $formatedData,
        'msg' => 'Success',
        'status' => 100,
        ]);
}

public function actionGetinspectionstaffdata(){
    $response = [];
    $request_body	= file_get_contents('php://input');

    $request = json_decode($request_body, true);
  
    $appDtlsPk = $request['inspectionpk'];
    $staffid = $request['staffid'];
    $assessmenttype = $request['assessmenttype'];

 

      $data= \app\models\ApprasvehinspcattmpTbl::find()
    ->select(['*'])
    ->leftJoin('rascategorymst_tbl category','category.rascategorymst_pk = apprasvehinspcattmp_tbl.arvict_rascategorymst_fk')
    ->leftJoin('appstaffinfotmp_tbl stafftmp','find_in_set(apprasvehinspcattmp_tbl.apprasvehinspcattmp_pk,stafftmp.appsit_apprasvehinspcattmp_fk)')
    //->leftJoin('staffevaluationtmp_tbl staffevaluation','staffevaluation.set_appstaffinfotmp_fk = stafftmp.appostaffinfotmp_pk')
     ->leftJoin('staffevaluationtmp_tbl  staffevaluation','staffevaluation.set_rascategorymst_fk = apprasvehinspcattmp_tbl.arvict_rascategorymst_fk')
   // ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = apprasvehinspcattmp_tbl.arvict_applicationdtlstmp_fk')
    ->leftJoin('staffinforepo_tbl repo','repo.staffinforepo_pk = stafftmp.appsit_staffinforepo_fk')
    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = apprasvehinspcattmp_tbl.arvict_appdecby')
    ->Where(['appostaffinfotmp_pk'=>$staffid])
    ->andWhere(['apprasvehinspcattmp_pk'=>$appDtlsPk])
    ->asArray()
    ->one();

    $staffeval = \app\models\StaffevaluationtmpTbl::find()
    ->select(['*'])
    ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = set_asmtupload')
    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = staffevaluationtmp_tbl.set_createdby')
    ->leftJoin('appstaffinfotmp_tbl staff','staff.appostaffinfotmp_pk = staffevaluationtmp_tbl.set_appstaffinfotmp_fk')
    ->where("set_appstaffinfotmp_fk =:set_appstaffinfotmp_fk", [':set_appstaffinfotmp_fk' => $staffid])
    ->andwhere("set_rascategorymst_fk =:set_rascategorymst_fk", [':set_rascategorymst_fk' => $data['arvict_rascategorymst_fk']])
    ->andwhere("set_asmttype =:set_asmttype", [':set_asmttype' =>1])
    ->orderBy(["staffevaluationtmp_pk" => SORT_DESC])->asArray()->one();


    if( $staffeval){
        $invoicedata  = OpalInvoiceTbl::find()
        ->select(['*'])
        ->where('apid_applicationdtlstmp_fk = '.$staffeval['appsit_applicationdtlstmp_fk'])
        ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();

    }
  
    $staffevalpracticalcheck = \app\models\StaffevaluationtmpTbl::find()
    ->where("set_appstaffinfotmp_fk =:set_appstaffinfotmp_fk", [':set_appstaffinfotmp_fk' => $staffid])
    ->andwhere("set_rascategorymst_fk =:set_rascategorymst_fk", [':set_rascategorymst_fk' => $data['rascategorymst_pk']])
    ->andwhere("set_asmttype =:set_asmttype", [':set_asmttype' => 2])
    ->orderBy(["staffevaluationtmp_pk" => SORT_DESC])->asArray()->one();



    // $staffevalpractical = \app\models\StaffevaluationtmpTbl::find()
    // ->select(['*'])
    // ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = set_asmtupload')
    // ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = staffevaluationtmp_tbl.set_createdon')
    // ->where("set_appstaffinfotmp_fk =:set_appstaffinfotmp_fk", [':set_appstaffinfotmp_fk' => $staffid])
    // ->andwhere("set_rascategorymst_fk =:set_rascategorymst_fk", [':set_rascategorymst_fk' => $data['rascategorymst_pk']])
    // ->andwhere("set_asmttype =:set_asmttype", [':set_asmttype' => 2]);
    // if($staffevalpracticalcheck['appsit_iscarddetails'] == 1 && $staffevalpracticalcheck['set_apppytminvoicedtls_fk']){
    //     $staffevalpractical->andWhere(['set_apppytminvoicedtls_fk'=>$invoicedata['apppytminvoicedtls_pk']]);
    // }
    // $staffevalpractical->orderBy(['staffevaluationtmp_pk' => SORT_DESC]);
    // $staffevalpractical =  $staffevalpractical->asArray()->one();


    $staffevalpractical = \app\models\StaffevaluationtmpTbl::find()
    ->select(['*'])
    ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = set_asmtupload')
    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = staffevaluationtmp_tbl.set_createdon')
    ->where(['set_appstaffinfotmp_fk' => $staffid,'set_asmttype' =>'2', 'set_rascategorymst_fk' => $data['rascategorymst_pk']]);
    if($staffeval['appsit_iscarddetails'] == 1 && $staffevalpracticalcheck['set_apppytminvoicedtls_fk']){
        $staffevalpractical->andWhere(['set_apppytminvoicedtls_fk'=>$invoicedata['apppytminvoicedtls_pk']]);
    }
    $staffevalpractical->orderBy(['staffevaluationtmp_pk' => SORT_DESC]);
    $staffevalpractical =  $staffevalpractical->asArray()->one();
   

    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
     $driveImg  =   \api\components\Drive::generateUrl($staffeval['set_asmtupload'],$companypk,$userpk);
     $driveImgP  =   \api\components\Drive::generateUrl($staffevalpractical['set_asmtupload'],$companypk,$userpk);
    if($data){
        
        $response = ['status' => 1,'data' => $data, 'staffdata' => $staffeval , 'staffevalpractical' => $staffevalpractical ,  'driveimg' => $driveImg , 'driveimgp' => $driveImgP , 'msg' => 'Success',
        ];
    } else{
       $response = ['status' => 2,'data' => '','msg' => 'Failure',
        ]; 
    }
    return $this->asJson($response);
}

public function actionInspectionapprodecproce()
{
    $request_body	= file_get_contents('php://input');

    $request = json_decode($request_body, true);
    if($request['assessmenttype'] == 1){
        $data = \app\models\ApplicationdtlstmpTbl::inspectionapprodecproce();
    }else{
        $data = \app\models\ApplicationdtlstmpTbl::inspectionpractical();
    }

    return $data;   
 }

 public function actionDownloadlistras(){
    $dataModel =  \app\models\ApplicationdtlstmpTbl::getscfexportlist($_GET);
    $headerrow = ["Application RefNo", "Office Type", "Company Name", "Centre Name", "Branch Name","Site location","Application type", "Application Status", "Certification Status",  
    "Site Audit Scheduled on","Date of Expiry", "Added on", "Last Updated on"];
    $filename = "TrainingEvalutionCentreApproval".date('Ymdhis').".csv";
    ob_end_clean();
    header('Content-type: application/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Pragma: no-cache');     
    $fp = fopen('php://output', 'w');
    fputcsv($fp, $headerrow);
     if (count($dataModel) > 0) {
        foreach ($dataModel as $result) {
            fputcsv($fp, $result);
        }
        fclose($fp);
//return ob_get_clean();
    }
    exit;
}
public function actionGetroleaccess(){
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $model = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
    ->select(['pawfd_rolemst_fk'])
    ->leftJoin('projapprovalworkflowdtls_tbl', 'projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')
    ->leftJoin('projapprovalworkflowhrd_tbl', 'projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')
    ->where("pawfud_opalusermst_fk = $userPk")
    ->andWhere("projapprovalworkflowhrd_tbl.pawfh_status = 1")
    ->andWhere("pawfh_projectmst_fk = 1")
    ->andWhere("pawfh_formstatus = 1")
    ->asArray()
    ->all();
    
    $accessdesktop = false;
    $accesspayement = false;
    $accessauditor = false;
    $accessqualitymanager = false;
    $accessAuthority =false;
    $accessceo = false;

 
    $opalusermst_tbl = OpalusermstTbl::find()
    ->select(['oum_rolemst_fk'])
               ->where("opalusermst_pk = '$userPk'")
               ->andWhere('FIND_IN_SET("1", oum_rolemst_fk)')
               ->asArray()
               ->one();
    $accessproject = OpalusermstTbl::find()
    ->select(['opalusermst_pk'])
    ->where("opalusermst_pk = '$userPk'")
    ->andWhere("FIND_IN_SET('1', oum_allocatedproject)")
    ->andWhere("oum_status = 'A'")
    ->asArray()
    ->one();
               
               foreach($model as $role){
               if($role['pawfd_rolemst_fk'] == 2){
                   $accessdesktop = true;
               }
               if($role['pawfd_rolemst_fk'] == 6){
                   $accesspayement = true;
               }  
               if($role['pawfd_rolemst_fk'] == 5){
                   $accessauditor = true;
               } 
               if($role['pawfd_rolemst_fk'] == 3){
                   $accessqualitymanager = true;
               } 
               if($role['pawfd_rolemst_fk'] == 4){
                   $accessAuthority = true;
               }
               if($role['pawfd_rolemst_fk'] == 7){
                   $accessceo = true;
               } 
           
                   
               }
               $favData['accessdesktop'] = $accessdesktop;
               $favData['accesspayment'] = $accesspayement;
               $favData['accessauditor'] = $accessauditor;
               $favData['accessAuthority'] = $accessAuthority;
               $favData['accessqualitymanager'] = $accessqualitymanager;
               $favData['accessceo'] = $accessceo;
               $favData['accessadmin'] = ($opalusermst_tbl['oum_rolemst_fk'])?true:false;
               $favData['accessproject'] = ($accessproject)?true:false;

   return ['access'=>$favData];
   }
   public function actionGetroleaccesscourse(){
       $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       $model = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
       ->select(['pawfd_rolemst_fk'])
       ->leftJoin('projapprovalworkflowdtls_tbl', 'projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')
       ->leftJoin('projapprovalworkflowhrd_tbl', 'projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')
       ->where("pawfud_opalusermst_fk = $userPk")
       ->andWhere("projapprovalworkflowhrd_tbl.pawfh_status = 1")
       ->andWhere("pawfh_projectmst_fk in (2,3)")
       ->andWhere("pawfh_formstatus = 1")
       ->asArray()
       ->all();
       
       $accessdesktop = false;
       $accesspayement = false;
       $accessauditor = false;
       $accessqualitymanager = false;
       $accessAuthority =false;
       $accessceo = false;
   
    
       $opalusermst_tbl = OpalusermstTbl::find()
               ->select(['oum_rolemst_fk'])
               ->where("opalusermst_pk = '$userPk'")
               ->andWhere('FIND_IN_SET("1", oum_rolemst_fk)')
               ->asArray()
               ->one();
            $accessproject = OpalusermstTbl::find()
            ->select(['opalusermst_pk' , 'oum_standcoursemst_fk' , 'oum_allocatedproject'])
            ->where("opalusermst_pk = '$userPk'")
            ->andWhere("FIND_IN_SET('2', oum_allocatedproject) OR FIND_IN_SET('3', oum_allocatedproject)")
            ->andWhere("oum_status = 'A'")
            ->asArray()
            ->one();
            $pro_arary =  explode(",", $accessproject['oum_allocatedproject']);
            if(in_array('2',$pro_arary)  && $accessproject['oum_standcoursemst_fk'] == ''){
            $accessproject  = '';
            }

            foreach($model as $role){
            if($role['pawfd_rolemst_fk'] == 2){
            $accessdesktop = true;
            }
            if($role['pawfd_rolemst_fk'] == 6){
            $accesspayement = true;
            }  
            if($role['pawfd_rolemst_fk'] == 5){
            $accessauditor = true;
            } 
            if($role['pawfd_rolemst_fk'] == 3){
            $accessqualitymanager = true;
            } 
            if($role['pawfd_rolemst_fk'] == 4){
            $accessAuthority = true;
            }
            if($role['pawfd_rolemst_fk'] == 7){
            $accessceo = true;
            } 


            }
            $favData['accessdesktop'] = $accessdesktop;
            $favData['accesspayment'] = $accesspayement;
            $favData['accessauditor'] = $accessauditor;
            $favData['accessAuthority'] = $accessAuthority;
            $favData['accessqualitymanager'] = $accessqualitymanager;
            $favData['accessceo'] = $accessceo;
            $favData['accessproject'] =  ($accessproject)?true:false;
            $favData['accessadmin'] = ($opalusermst_tbl['oum_rolemst_fk'])?true:false;

return ['access'=>$favData];
}
public function actionGetroleaccessras(){
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $model = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
    ->select(['pawfd_rolemst_fk'])
    ->leftJoin('projapprovalworkflowdtls_tbl', 'projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')
    ->leftJoin('projapprovalworkflowhrd_tbl', 'projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')
    ->where("pawfud_opalusermst_fk = $userPk")
    ->andWhere("projapprovalworkflowhrd_tbl.pawfh_status = 1")
    ->andWhere("pawfh_projectmst_fk in (4)")
    ->andWhere("pawfh_formstatus = 1")
    ->asArray()
    ->all();
    
    $accessdesktop = false;
    $accesspayement = false;
    $accessauditor = false;
    $accessqualitymanager = false;
    $accessAuthority =false;
    $accessceo = false;

 
    $opalusermst_tbl = OpalusermstTbl::find()
            ->select(['oum_rolemst_fk'])
            ->where("opalusermst_pk = '$userPk'")
            ->andWhere('FIND_IN_SET("1", oum_rolemst_fk)')
            ->asArray()
            ->one();
    
    $accessproject = OpalusermstTbl::find()
    ->select(['opalusermst_pk'])
    ->where("opalusermst_pk = '$userPk'")
    ->andWhere("FIND_IN_SET('4', oum_allocatedproject)")
    ->andWhere("oum_status = 'A'")
    ->asArray()
    ->one();
                      
            foreach($model as $role){
            if($role['pawfd_rolemst_fk'] == 2){
                $accessdesktop = true;
            }
            if($role['pawfd_rolemst_fk'] == 6){
                $accesspayement = true;
            }  
            if($role['pawfd_rolemst_fk'] == 5){
             $accessauditor = true;
         } 
         if($role['pawfd_rolemst_fk'] == 3){
             $accessqualitymanager = true;
         } 
         if($role['pawfd_rolemst_fk'] == 4){
             $accessAuthority = true;
         }
         if($role['pawfd_rolemst_fk'] == 7){
             $accessceo = true;
         } 
     
             
         }
         $favData['accessdesktop'] = $accessdesktop;
         $favData['accesspayment'] = $accesspayement;
         $favData['accessauditor'] = $accessauditor;
         $favData['accessAuthority'] = $accessAuthority;
         $favData['accessqualitymanager'] = $accessqualitymanager;
         $favData['accessceo'] = $accessceo;
         $favData['accessproject'] =  ($accessproject)?true:false;
         $favData['accessadmin'] = ($opalusermst_tbl['oum_rolemst_fk'])?true:false;

return ['access'=>$favData];
}

public function actionGetaccessproject()
{
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $request_body	= file_get_contents('php://input');
    $request = json_decode($request_body, true);
    $projectpk = $request['projectpk'];
    $accessproject = OpalusermstTbl::find()
    ->select(['opalusermst_pk'])
    ->where("opalusermst_pk = '$userPk'")
    ->andWhere("FIND_IN_SET('$projectpk', oum_allocatedproject)")
    ->andWhere("oum_status = 'A'")
    ->asArray()
    ->one();
     $data = ($accessproject)?true:false;
    return $data;   
 }
}