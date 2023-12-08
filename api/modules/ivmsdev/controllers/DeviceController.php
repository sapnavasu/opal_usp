<?php



namespace api\modules\ivmsdev\controllers;

use api\components\Drive;
use api\components\Ivmsdevice;
use api\components\Security;
use api\components\Vehicle;
use api\modules\mst\controllers\MasterController;
use app\models\AppdeviceinfomainTbl;
use app\models\ApprasvehinspcatmainTbl;
use app\models\OpalmemberregmstTbl;
use app\models\OpalusermstTbl;
use app\models\RasvehicleownerdtlsTbl;
use app\models\RasvehicleregdtlsTbl;
use app\models\ReferencemstTbl;
use app\models\VehiclesubcatmstTbl;
use Da\QrCode\QrCode;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\redis\ActiveRecord;
use yii\web\Response;
use function GuzzleHttp\json_decode;



class DeviceController extends MasterController
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
    
    
    
    public function actionGetDeviceInfoByAppPk()
    {
        $appPk = isset($_GET['appPk']) ? $_GET['appPk'] : 0;
        $excludepk = isset($_GET['exclPk']) ? $_GET['exclPk'] : 0;
        $decryptedId = Security::decrypt($appPk);
        
        
     $data = AppdeviceinfomainTbl::getDeviceInfoByAppPk($decryptedId,$excludepk);

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    
    
    public function actionGetVehicleSubcatListByCatpk()
    {
        $catPk = isset($_GET['catPk']) ? $_GET['catPk'] : 0;
        $decryptedId = Security::decrypt($catPk);
        
        
     $data = VehiclesubcatmstTbl::getVehicleSubcatListByCatpk($decryptedId);

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    

    public function actionGetivmsdevicegriddata(){
       
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        $result = Ivmsdevice::getIVMSDeviceGridData($data);
        
        return $result;

    }
    
    public function actionIvmscertificate()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
//        $logo = Ivmsdevice::ChkiflogoExists($request['pk']);
//        if($logo)
//        {
            $generateSticker = Ivmsdevice::ivmsCertificate($request['pk'],$request['isregen']);
        if($generateSticker['status'] == 1)
         {
             
             return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $generateSticker];  
         }
       
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
//        }
//        
//        return ['msg' => 'nologo', 'status' => 3, 'flag' => 'l', 'data' => ''];
    }
    
    public function actionGetnumberofinstalations()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $decryptedId = Security::decrypt($request['pk']);
        
        $result = Ivmsdevice::getnumberofinstallations($decryptedId);
        
        if($result)
        {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
           return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];     
    }
    
//    export-grid-data
    public function actionExportIvmsGridData(){
       
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);


        $result = Ivmsdevice::exportGridData($data);

        return $result;

    }
    
    public function actionDownloadgridata(){
        if($_REQUEST['filename']){
            $trackpk = Security::decrypt($_REQUEST['filename']);
            $zipfilename = $trackpk.'.zip';
            $dir = Yii::$app->params['srcDirectory'];
            $zipfilepath = $dir.'web/exports/'.$zipfilename;
            
            if (file_exists($zipfilepath)) {        
                header('Content-Type: application/zip'); // ZIP file
                header('Content-Disposition: attachment; filename="'.$zipfilename.'"');
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
        

        $model = OpalmemberregmstTbl::getTechnicalEvalutionCentres();

         if($model)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
         
    }
    
     public function actionGetbranchlistbyregpk()
    {
        $regpk = isset($_GET['regpk']) ? $_GET['regpk'] : 0;
        $decryptedId = Security::decrypt($regpk);
        $branches = OpalmemberregmstTbl::getTechEvalCentresBranchByRegPk($decryptedId);

      if($branches)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $branches];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    
    
    public function actionGetAllVehicleCategoriesIVMS()
    {
     $data = ApprasvehinspcatmainTbl::getAllVehicleCategoriesIVMS();

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    public function actionGetInstationTechnician()
    {
        $request = isset($_GET['appPk']) ? $_GET['appPk'] : 0;
        
     $data = AppdeviceinfomainTbl::getInstationTechnician($request);

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    
    public function actionGetMastersListByType()
    {
        $refpk = isset($_GET['refpk']) ? $_GET['refpk'] : 0;
        $roadtypeList = ReferencemstTbl::getMastersListByTypePk($refpk);
        

        $data['roadtype'] = $roadtypeList;

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }


    
    public function actionSavevehicledtls() {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['vehicledtls'];

        $transaction = Yii::$app->db->beginTransaction();

        $SaveVehicledtls = Ivmsdevice::saveIvmsVehicleDtls($requestdata);
        
        if($SaveVehicledtls)
        {
             
                 $transaction->commit();
                 $mailsend = Ivmsdevice::sendVehicleRegistrationMail($SaveVehicledtls['ivmsvehiclepk']);
                 return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $SaveVehicledtls['ivmsvehiclepk']];
              
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
    
    public function actionPrintorviewcertificate()
    {
         $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['pk'];
        $type = $request['type'];
        $pk = Security::decrypt($requestdata);
        
        $data = Ivmsdevice::printorviewcertificate($pk,$type);
        
         return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
    }
    
    public function actionRemovedevice()
    {
         $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['pk'];
        $pk = Security::decrypt($requestdata);
        
        $data = Ivmsdevice::removedevice($pk,6);
        
         return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
    }
    public function actionCancelregistration()
    {
         $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['reg_pk'];
        $pk = Security::decrypt($requestdata);
        
        $data = Ivmsdevice::removedevice($pk,4);
        
         return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
    }
    
    public function actionGetivmsvehicledtlsbypk()
    {
        $vehiclPk = isset($_GET['pk']) ? $_GET['pk'] : null;
        
        $result = Ivmsdevice::getIVMSVehicleDtlsByPk($vehiclPk);
        
        return $result;
    }
    
   
    
    public function actionSubmitforapproval()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Ivmsdevice::submitForApproval($requestdata);
        if($result)
        {
            
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];
            
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    
    public function actionApprovalSubmit()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Ivmsdevice::approvalSubmit($requestdata);
        if($result)
        {  
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    public function actionDeclinesubmit()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
       
        
        
        $result = Ivmsdevice::declineSubmit($requestdata);
        if($result)
        {  
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    public function actionIssueCertificate()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
      
        $transaction = Yii::$app->db->beginTransaction();
        
//        $logo = Ivmsdevice::ChkiflogoExists($requestdata['vehicleregpk']);
//        
//        if($logo)
//        {
            
        $result = Ivmsdevice::issueCertificate($requestdata );
        
        if($result)
        {  
          $_REQUEST['pk'] = $requestdata['vehicleregpk'];
          $_REQUEST['isregen'] = 2;
         $generateSticker = Ivmsdevice::ivmsCertificate($requestdata['vehicleregpk'],2);
         if($generateSticker['status'] == 1)
         {
              $transaction->commit();
              Ivmsdevice::sendApprovedMail($requestdata['vehicleregpk']);
             return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
         }
         
          
        }
        $transaction->rollBack();
        
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
//        }
//         return ['msg' => 'nologo', 'status' => 3, 'flag' => 'l', 'data' => ''];
        
    }
      public function actionGetivmsvhclregstatus()
    {
        $vehiclePk = isset($_GET['pk']) ? $_GET['pk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
         
        $result = Ivmsdevice::getivmsvhclregstatus($vehicleregpk);
       
        
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
     public function actionGetInstallationDtls()
    {
        $vehiclePk = isset($_GET['pk']) ? $_GET['pk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        $result = Ivmsdevice::getInstallationDtls($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
     public function actionGetinstallerlistbyvhclregpk()
    {
        
        
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Ivmsdevice::getInstallerListByVhclregpk($requestdata);
       
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
    
    public function actionCheckvehicleregistered()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
       
        $regpk = $request['regpk'];
        $dataToCheck = $request['data'];
       
        $result = \app\models\IvmsvehicleregdtlsTbl::checkIsVehicleNumAlreadyExists($dataToCheck,$regpk);
        
       
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
            $data = Ivmsdevice::getVehicleDtlsByRefNo($dataToCheck);
            
            
            return $this->asJson([
            'msg' => 'success',
            'status' => 2,
            'available' => $data,
             ]);
            
        }
//        $transaction->rollBack();
         
       
      
    }
    
    public function actionRenewIvmsVehicleReg()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['formData'];
        
        $result = Ivmsdevice::renewIvmsVehicleRegistration($requestdata);
        if($result)
        {  
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result];  
        }
//        $transaction->rollBack();
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
      
    }
    
    //get-checklist-by-vecl-regpk
    public function actionGetIvmsChecklistByVeclRegpk()
    {
       $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        
        $result = Ivmsdevice::getIVMSChecklistByVeclPk($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
    public function actionGetIvmsinspectionDetailsForEdit()
    {
        $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        $result = Ivmsdevice::getInspectionDetailsForEdit($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
    public function actionGetivmsvehiclregdlsbyvhclpk()
    {
         $vehiclePk = isset($_GET['vclrgpk']) ? $_GET['vclrgpk'] : null;
        $vehicleregpk = Security::decrypt($vehiclePk);
        $result = Ivmsdevice::getivmsvehiclregdlsbyvhclpk($vehicleregpk);
       
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
        
        $result = Ivmsdevice::getAllPassAnswersForChklist($vehicleregpk);
       
       if($result)
        {
          return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $result]; 
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }
    
    public function actionGetsampleurl(){

        $templateurl = Yii::$app->params['baseMailPath'] . 'web\ivmsuploadurl\ivmsvehicleuploadsample.xlsx';
       
        $url['templateurl'] = $templateurl;
        return $url;
        
        
    } 
    
    public function actionImportivmsexceldata(){
       
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
       
        $result = Ivmsdevice::importivmsexceldata($data);
        
        return $result;

    }
    
    public function actionMailcheck()
    {
        $data = [
            'vehiclePk' => 1,
        ];
         $ddata = json_encode($data);
//       $result = Ivmsdevice::sendMailtoSrTechinicians(72);
       $result = Ivmsdevice::sendIvmsDeviceMail(72,'ivmsvehiclereginst',$ddata);
       
       echo "<pre>";
       var_dump($result);
       exit;
    }
    
       
       
}