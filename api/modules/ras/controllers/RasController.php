<?php

namespace api\modules\ras\controllers;

use api\components\Drive;
use api\components\RasVehicle;
use api\components\Security;
use api\components\Vehicle;
use api\modules\mst\controllers\MasterController;
use app\models\ApprasvehinspcatmainTbl;
use app\models\OpalmemberregmstTbl;
use app\models\OpalusermstTbl;
use app\models\RasvehicleownerdtlsTbl;
use app\models\RasvehicleregdtlsTbl;
use app\models\ReferencemstTbl;
use Da\QrCode\QrCode;
use Mpdf\Mpdf;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\web\Response;
use app\models\StaffinforepoTbl;

use function GuzzleHttp\json_decode;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class RasController extends MasterController
{
    

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
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }
    
             
    public function actionRassticker(){

        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['pk']? $request['pk'] : $_REQUEST['pk'];
        $isregenerate = $request['isregen']? $request['isregen'] : $_REQUEST['isregen'];
        
        $pk = Security::decrypt($requestdata);
        $regPk =  ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userdata = RasvehicleregdtlsTbl::find()
        ->select(['rasvehicleregdtls_pk','rvrd_opalmemberregmst_fk','rvrd_applicationrefno','appiim_officetype','appiim_branchname_en','appiim_branchname_ar','rvod_ownername_en as owner_en','rvod_ownername_ar as owner_ar','rvrd_vechicleregno','rvrd_chassisno','rcm_coursesubcatname_en as vehtype_en','rcm_coursesubcatname_ar as vehtype_ar',
        'rm_name_en as roadtype_en','rm_name_ar  as roadtype_ar','DATE_FORMAT(rvrd_dateofinsp,"%d-%m-%Y") AS dateofinspetcion',
        'rvrd_applicationtype','rvrd_inspectionstatus','rvrd_permitstatus','DATE_FORMAT(rvrd_dateofexpiry,"%d-%m-%Y") AS dateofexp',
        'rvod_crnumber','rvrd_ivmsserialno','rvrd_speedlimitno','rvrd_vechiclefleetno','DATE_FORMAT(rvrd_firstropregdate,"%d-%m-%Y") AS firstropregdate','rvrd_modelyear',
        'rvrd_verificationno','opalusermst_pk','oum_firstname'])
        ->leftJoin('rasvehicleownerdtls_tbl','rasvehicleownerdtls_pk = rvrd_rasvehicleownerdtls_fk')
        ->leftJoin('rascategorymst_tbl','rascategorymst_pk = rvrd_vechiclecat')
        ->leftJoin('referencemst_tbl','referencemst_pk = rvrd_roadtype')
        ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = rvrd_appinstinfomain_fk')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = rvrd_inspectorname')
        ->where('rasvehicleregdtls_pk = '.$pk)
        ->asArray()
        ->one();
        
        if(!empty($userdata['rvrd_verificationno']) && $userdata['rvrd_verificationno'] != 'NULL'){
            $varificationnumber = $userdata['rvrd_verificationno'];
        }else{
            $varificationnumber = self::generateRandomString();
        }
        
        if($isregenerate == 1)
        {
            $nextinspeciondate = date('d-m-Y', strtotime($userdata['dateofexp'])); 
        }
        else
        {
            $increasedate =   '+'.'1'.' years';
            $nextinspeciondate = date('d-m-Y', strtotime($increasedate, strtotime(date('Y-m-d'))));
        }
        $cmpyPk = $userdata['rvrd_opalmemberregmst_fk'];
        $name = OpalusermstTbl::find()->select(['oum_firstname','omrm_cmplogo','omrm_companyname_en','memcompfiledtls_pk','mcfd_opalmemberregmst_fk','mcfd_uploadedby'])
        ->leftJoin('opalmemberregmst_tbl', 'oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk = omrm_cmplogo')
        ->Where('oum_opalmemberregmst_fk = "' . $cmpyPk . '"  and oum_isfocalpoint = 1')
        ->asArray()
        ->one();

        $proof = Drive::generateUrl($name['memcompfiledtls_pk'],$name['mcfd_opalmemberregmst_fk'],$name['mcfd_uploadedby']);
       
        $userdata['name']=   $userdata['oum_firstname'];
        $userdata['companyname']=  $name['omrm_companyname_en'];
        $userdata['varificationnumber']=   $varificationnumber;
        $userdata['nextinspeciondate']=   $nextinspeciondate;

        $path = "../api/web/rassticker/".$userdata['rvrd_opalmemberregmst_fk']."/";
        $path1 = "/web/rassticker/".$userdata['rvrd_opalmemberregmst_fk']."/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }  
    
          $mPDF1 = new Mpdf([
            'mode' => '',
            'format' => [96.5, 126],
            'margin_left' => '5',
            'margin_right' => '0',
            'margin_top' => '45', 
            'margin_bottom' => '0',
            'margin_header' => '0',
            'margin_footer' => '0',
           // 'default_font_size' => '0', 
           // 'orientation' => 'L',
            'default_font' => 'futurastdmedium']);
        $websiteurl = Yii::$app->params['website_url'];    
        $qrCode = (new QrCode(''))
        ->setText($websiteurl."/verify-product/?verifyras=".$varificationnumber."&value=vehform1#rasvehicle");
        $qrCode->writeFile(__DIR__ .'/../../../web'.'/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '"style="width: 65px; height:65px;float:right">';


        $backendBaseUrl = Yii::$app->params['backendBaseUrl'];
        $cerpath = dirname(__FILE__).'../../../../../certicate/ras_sticker.pdf';
        // $qrcode = '<img src="' . dirname(__FILE__) . '../../views/pdf/qr.jpg" style="width: 65px; height:65px;float:right">';
        if($name['omrm_cmplogo'])
        {
          $comlogo = '<img src="' . $proof.'" style="float:left;width:160px;width: 65px; height:65px">';  
        }
        else
        {
            $comlogo = '';
        }
        
        $pagecount = $mPDF1->SetSourceFile($cerpath);
        $tplId = $mPDF1->ImportPage($pagecount);
        $mPDF1->UseTemplate($tplId);
        $mPDF1->SetDefaultBodyCSS('background', "url('$cerpath')");
       
      
        $mPDF1->WriteHTML($this->renderPartial('../../views/pdf/ras-sticker',['qrcode'=>$qrcode, 'userdata' => $userdata, 'comlogo' => $comlogo,'name'=>$name]));
        $mPDF1->Output($path.$userdata['rasvehicleregdtls_pk'].'sticker'.'.pdf', 'F');
         
        $mPDF2 = new Mpdf([
            'mode' => '',
            'format' => [96.5, 126],
            'margin_left' => '5',
            'margin_right' => '0',
            'margin_top' => '45', 
            'margin_bottom' => '0',
            'margin_header' => '0',
            'margin_footer' => '0',
           // 'default_font_size' => '0', 
           // 'orientation' => 'L',
            'default_font' => 'futurastdmedium']);
        $websiteurl = Yii::$app->params['website_url'];    
        $qrCode = (new QrCode(''))
              //  https://opaloman.om/uat8686/verify-product/?verifyras=1234#rasvehicle
        ->setText($websiteurl."/verify-product/?verifyras=".$varificationnumber."&value=vehform1#rasvehicle");
        $qrCode->writeFile(__DIR__ .'/../../../web'.'/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '"style="width: 65px; height:65px;float:right">';


        $backendBaseUrl = Yii::$app->params['backendBaseUrl'];
        $cerpath = dirname(__FILE__).'../../../../../certicate/ras_sticker.pdf';
        // $qrcode = '<img src="' . dirname(__FILE__) . '../../views/pdf/qr.jpg" style="width: 65px; height:65px;float:right">';
       if($name['omrm_cmplogo'])
        {
          $comlogo = '<img src="' . $proof.'" style="float:left;width:160px;width: 65px; height:65px">';  
        }
        else
        {
            $comlogo = '';
        }
        $pagecount = $mPDF2->SetSourceFile($cerpath);
        $tplId = $mPDF2->ImportPage($pagecount);
        $mPDF2->UseTemplate($tplId);
        $mPDF2->SetDefaultBodyCSS('background', "url('$cerpath')");
        $mPDF2->SetProtection(array('copy'), '', 'OPALUSP');
        $mPDF2->WriteHTML($this->renderPartial('../../views/pdf/ras-sticker',['qrcode'=>$qrcode, 'userdata' => $userdata, 'comlogo' => $comlogo,'name'=>$name]));
        $mPDF2->Output($path.$userdata['rasvehicleregdtls_pk'].'stickerview'.'.pdf', 'F');
        $userPk =  ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = RasvehicleregdtlsTbl::find()->where('rasvehicleregdtls_pk = '.$pk)->one();
        $oldrecord = Vehicle::ChangePermitstatusOnnewsticker($model);
       
        $model->rvrd_verificationno = $varificationnumber;
        $model->rvrd_printstickerpath = $path1.$userdata['rasvehicleregdtls_pk'].'sticker'.'.pdf';
//        $model->rvrd_isstickerprinted = 1;
        $model->rvrd_viewstickerpath = $path1.$userdata['rasvehicleregdtls_pk'].'stickerview'.'.pdf';
        $model->rvrd_inspectionstatus = $isregenerate == 1?$model->rvrd_inspectionstatus:3;
        $model->rvrd_permitstatus = $isregenerate == 1?$model->rvrd_permitstatus:2;
        $model->rvrd_dateofexpiry = $isregenerate == 1?$model->rvrd_dateofexpiry:date("Y-m-d",strtotime($nextinspeciondate));
//        $model->rvrd_printedon = date("Y-m-d H:i:s");
//        $model->rvrd_printedby = $userPk;
        $model->rvrd_firstissuedate = $isregenerate == 1?$model->rvrd_firstissuedate:date("Y-m-d H:i:s");
        $model->rvrd_lastissuedon = $isregenerate == 1?$model->rvrd_lastissuedon:date("Y-m-d H:i:s");
        $model->rvrd_updatedon = date("Y-m-d H:i:s");
        $model->rvrd_updatedby = $userPk;
        if(!$model->save()){
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }else{
            $data = $model;
        }
        
        if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => ''];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
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

    public function actionGetrasgriddata(){
       
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $result = Vehicle::getGridData($data);
        
        return $result;

    }
    
    //export-grid-data
    public function actionExportGridData(){
       
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $result = Vehicle::exportGridDatanew($data);
        
        return $result;

    }
    
    public function actionDownloadgridata(){
        if($_REQUEST['filename']){
            $trackpk = Security::decrypt($_REQUEST['filename']);
            $zipfilename = $trackpk.'.xlsx';
            $dir = \Yii::$app->params['srcDirectory'];
            $zipfilepath = $dir.'web/exports/'.$zipfilename;
            if (file_exists($zipfilepath)) {        
              
//                header('Content-Type', 'application/octet-stream');
                header('mimeType', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="'.$zipfilename.'"');
                header('Content-Type: application/vnd.ms-excel'); 
                header('Pragma', 'no-cache');
                header('Expires', '0');
                header('Content-Transfer-Encoding', 'binary');
                header("Content-Length: ".filesize($zipfilepath));
                // ob_clean();
                // flush();
                @readfile($zipfilepath);
            }else{
                echo 'Source file is not in the directory'; exit;
            }
        }
    }
    
    
    public function actionGetTechevalutioncentres(){
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $prjPk = Security::decrypt($data['prjPk']);

        $model = OpalmemberregmstTbl::getTechnicalEvalutionCentres($data['prjPk']);

         if($model)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
         
    }
    
     public function actionGetbranchlistbyregpk()
    {
        $regpk = isset($_GET['regpk']) ? $_GET['regpk'] : 0;
        $prjPk = isset($_GET['prjPk']) ? $_GET['prjPk'] : 0;
        $decryptedId = Security::decrypt($regpk);
        $branches = OpalmemberregmstTbl::getTechEvalCentresBranchByRegPk($decryptedId,$prjPk);

      if($branches)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $branches];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    
    public function actionGetAllVehicleCategoriesByAppPk()
    {
        $appPk = isset($_GET['appPk']) ? $_GET['appPk'] : 0;
        $decryptedId = Security::decrypt($appPk);
        
        
     $data = ApprasvehinspcatmainTbl::getAllVehicleCategoriesByAppPk($decryptedId);

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    public function actionGetinspectorname()
    {
        $request = isset($_GET['appPk']) ? $_GET['appPk'] : 0;
//        $decryptedId = \api\components\Security::decrypt($appPk);
        
        
     $data = ApprasvehinspcatmainTbl::getinspectoname($request);

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    
    public function actionGetMastersListByType()
    {
        $refpk = isset($_GET['refpk']) ? $_GET['refpk'] : 0;
        $datalist = ReferencemstTbl::getMastersListByTypePk($refpk);
        

        $data['list'] = $datalist;

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }


    public function actionGetrasgridviewdata(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $decryptedId = Security::decrypt($data['pk']);

        
        $datalist = RasvehicleregdtlsTbl::find()
        ->select(['rasvehicleregdtls_pk','appiim_officetype','rvrd_applicationrefno','appiim_branchname_en','appiim_branchname_ar','rvod_ownername_en as owner_en','rvod_ownername_ar as owner_ar','rvrd_vechicleregno','rvrd_chassisno','rcm_coursesubcatname_en as vehtype_en','rcm_coursesubcatname_ar as vehtype_ar','rvrd_viewstickerpath','rvrd_printstickerpath','DATE_FORMAT(rvrd_dateofinsp,"%d-%m-%Y") AS dateofinspetcion','rvrd_ivmsdevicemodel','rvrd_ivmsvendorname',
        'rvrd_applicationtype','rvrd_inspectionstatus','rvrd_permitstatus','DATE_FORMAT(rvrd_dateofexpiry,"%d-%m-%Y") AS dateofexp','rvrd_verificationno',
        'rvod_crnumber','rvrd_ivmsserialno','rvrd_speedlimitno','rvrd_vechiclefleetno','DATE_FORMAT(rvrd_firstropregdate,"%d-%m-%Y") AS firstropregdate','rvrd_modelyear','rvrd_odometerreading',
        'oum_firstname as inspectorname'])
        ->leftJoin('rasvehicleownerdtls_tbl','rasvehicleownerdtls_pk = rvrd_rasvehicleownerdtls_fk')
        ->leftJoin('rascategorymst_tbl','rascategorymst_pk = rvrd_vechiclecat')
        ->leftJoin('referencemst_tbl','referencemst_pk = rvrd_roadtype')
        ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = rvrd_appinstinfomain_fk')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = rvrd_inspectorname')
        ->where('rasvehicleregdtls_pk = '.$decryptedId)
        ->asArray()
        ->one();

        return ['viewdata'=>$datalist];
        
    }
    
    
    public function actionSavevehicledtls() {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['vehicledtls'];

        $transaction = Yii::$app->db->beginTransaction();

        $SaveVehicledtls = Vehicle::saveVehicleDtls($requestdata);
       

        
        if($SaveVehicledtls)
        {
            $model = RasvehicleregdtlsTbl::findOne($SaveVehicledtls['vehiclepk']);
            if($model->rvrd_applicationrefno == 'rasicnumber')
            {
                $model->rvrd_applicationrefno = RasvehicleregdtlsTbl::generatenewvehiclerefno($model->rvrd_opalmemberregmst_fk);
            }
            
            if($model->save() && $model->rvrd_applicationrefno != 'rasicnumber')
            { 
                $transaction->commit();
                 return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model->rasvehicleregdtls_pk];
            }  
        }
             $transaction->rollBack();
              return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
        
        
    }
    
    public function actionGetpreviousownerlist()
    {
        $searchdata = isset($_GET['data']) ? $_GET['data'] : null;
        $type = isset($_GET['type']) ? $_GET['type'] : 1;
        $ownerlist = RasvehicleownerdtlsTbl::getpreviousownerlist($searchdata,$type);
        
         return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $ownerlist];
    }
    
    public function actionPrintorviewrassticker()
    {
         $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['pk'];
        $type = $request['type'];
        $pk = Security::decrypt($requestdata);
        
        $data = Vehicle::printorviewrassticker($pk,$type);
        
         return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
    }
    
    public function actionGetvehicledtlsbypk()
    {
        $vehiclPk = isset($_GET['pk']) ? $_GET['pk'] : null;
        
        $result = Vehicle::getVehicleDtlsByPk($vehiclPk);
        
        return $result;
    }
    
   
    
    public function actionMovetoverifier()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Vehicle::moveToVerifier($requestdata);
        if($result)
        {
            
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];
            
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    
    public function actionMovetosupervisor()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Vehicle::moveToSupervisor($requestdata);
        if($result)
        {  
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    public function actionMovetoinspectorvalidating()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Vehicle::moveToInspectorValidating($requestdata);
        if($result)
        {  
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    public function actionIssueSticker()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
      
        $transaction = Yii::$app->db->beginTransaction();
        $result = Vehicle::issueSticker($requestdata);
        if($result)
        {  
          $_REQUEST['pk'] = $requestdata['vehicleregpk'];
          $_REQUEST['isregen'] = 2;
         $generateSticker = $this->actionRassticker(); 
         if($generateSticker['status'] == 1)
         {
              $transaction->commit();
             return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
         }
         
          
        }
        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
      public function actionGetvhclregstatus()
    {
        $vehiclePk = isset($_GET['pk']) ? $_GET['pk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
         
        $result = Vehicle::getvhclregstatus($vehicleregpk);
       
        
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
     public function actionGetInspectionDtls()
    {
        $vehiclePk = isset($_GET['pk']) ? $_GET['pk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        $result = Vehicle::getInspectionDtls($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
     public function actionGetinspectorlistbyvhclregpk()
    {
        
        
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Vehicle::getInspectorListByVhclregpk($requestdata);
       
       if($result['list'])
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result['list']]; 
        }
        else if($result['status'] == 'F')
        {
            return ['msg' => 'sucess', 'status' => 3, 'flag' => 'R', 'data' => $result['list']]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
    public function actionGetivmsvehicledata()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        echo "<pre>";
        var_dump($request);
        exit;
    }
    
    public function actionCheckvehicleregistered()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
       
        $regpk = $request['regpk'];
        $dataToCheck = $request['data'];
       
        $result = RasvehicleregdtlsTbl::checkIsVehicleNumAlreadyExists($dataToCheck,$regpk);
        
       
        if($result)
        {  
          return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $result,
            
        ]);
        }
        else
        {
            $data = Vehicle::getVehicleDtlsByRefNo($dataToCheck);
            
            
            return $this->asJson([
            'msg' => 'success',
            'status' => 2,
            'available' => $data,
             ]);
            
        }
//        $transaction->rollBack();
         
       
      
    }
    
    public function actionRenewVehicleReg()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Vehicle::renewVehicleRegistration($requestdata);
        if($result)
        {  
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    
    //get-checklist-by-vecl-regpk
    public function actionGetChecklistByVeclRegpk()
    {
       $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        
        $result = Vehicle::getChecklistByVeclCat($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
    public function actionGetInspectionDetailsForEdit()
    {
        $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        $result = Vehicle::getInspectionDetailsForEdit($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
    public function actionGetvehiclregdlsbyvhclpk()
    {
         $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        $result = Vehicle::getvehiclregdlsbyvhclpk($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    
     public function actionCancelvehicle()
    {
         $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata =  Security::decrypt($request['pk']);
        $result = RasvehicleregdtlsTbl::cancelvehicle($requestdata);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    
    //get-all-pass-answers-for-chklist
    public function actionGetAllPassAnswersForChklist()
    {
       $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        
        $result = Vehicle::getAllPassAnswersForChklist($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
public function actionGetsampleurl(){

        $templateurl = Yii::$app->params['baseMailPath'] . 'web\rasuploadurl\rasvehicleuploadsample.xlsx';
       

        
        $url['templateurl'] = $templateurl;
        return $url;
        
        
    }    
    public function actionImportexceldata(){
       
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
       
        $result = RasVehicle::importexceldata($data);
        
        return $result;

    }

public function actionGetstaffdetailsoncompetancyras()
    {
         $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $staffpk =  Security::decrypt($request['pk']);
        $categorypk =  Security::decrypt($request['category']);
        $vehiclepk =  Security::decrypt($request['vehiclepk']);
        
        $result = \app\models\StaffcompetencycardhdrTbl::getstaffdetailsoncompetancyras($staffpk,$categorypk,$vehiclepk);
       

       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
 public function actionGetCivilno()
    {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $user = \app\models\OpalusermstTbl::findOne($userPk);
        $response['status'] =false;
        if($user->oum_staffinforepo_fk){
            $civilno = StaffinforepoTbl::find()->select('sir_idnumber as civilno')->where(['staffinforepo_pk'=>$user->oum_staffinforepo_fk])->asArray()->one();
            if($civilno['civilno']){
                $response['status'] =true;
                $response['civilno'] =$civilno['civilno'];
            }
        }
        return $response;
    }
}