<?php
namespace api\modules\tend\controllers;

use app\filters\auth\HttpBearerAuth;
use Yii;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException; 
use api\modules\tend\models\OpentendersTbl;
use \common\components\Security;

class TenderController extends MasterController {
    use TenderFunctions; 
    use CommonController;
	public $current_basepath;

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);  
		$this->current_basepath = Yii::$app->basePath;
    }

    public function actions() {
        return [];
    }

    public function actionTendercreate() {   
        $uploaddir = $this->current_basepath . '/../common/tenderxmls/';
		$oldmask = umask(0);
        mkdir($uploaddir, 0777);
        umask($oldmask); 
		
        $uploadfile = $uploaddir . basename($_FILES['imageFile']['name']);
        move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadfile); 
        $the_content_type = mime_content_type($uploadfile);
		
        if($the_content_type != 'text/xml') {
            return $return_arr = ['uplload_status' => 'Error', 'message' => 'Pleas upload only xml files'];
        } else { 
             
            $url = $uploadfile;
            $data_type = $this->findOutputType($url); 

           if($data_type == 'xml') {   
               $tender_data = $this->getXMLValue($url);   
               if($tender_data['Table'][0] == 0) {
                 $tender_data_new[] = $tender_data['Table'];
               }  else {
                 $tender_data_new = $tender_data['Table'];   
               } 
           } elseif($data_type == 'json') {
               $tender_data = $this->getJSONValue($url);  
               $tender_data_new = $tender_data;
           }   
           $company_name = "test_company"; 
           $sanitized_tender_values = [];   
           foreach($tender_data_new as $ten_key => $ten_value) { 
               $curr_tender = [];
               $curr_tender['Id'] = Security::sanitizeInput($ten_value['id'],"number");
               $curr_tender['TenderNo'] = $ten_value['TenderNo'];
               $curr_tender['TenderName'] = Security::sanitizeInput($ten_value['TenderName'],"string");
               $curr_tender['Status'] = Security::sanitizeInput($ten_value['Status'],"string");
               $curr_tender['DocumentPrice'] = Security::sanitizeInput($ten_value['DocumentPrice'],"string");
               $curr_tender['TenderingDate'] = $ten_value['TenderingDate'];
               $curr_tender['SubmissionDate'] = $ten_value['SubmissionDate'];

               $curr_tender['FileName'] = $ten_value['FileName']['TenderFileName'];
               $curr_tender['File'] = $ten_value['FileName']['File']; 

               if(count($ten_value['FileName']['File']) > 1) {
                    foreach($FileName as $file_key => $file_val) {
                      $fileListArr[$ten_key][$file_key]['id'] = $Id;
                      $fileListArr[$ten_key][$file_key]['TenderNo'] = $TenderNo;
                      $fileListArr[$ten_key][$file_key]['TenderFileName'] = $file_val;
                      $fileListArr[$ten_key][$file_key]['File'] = $curr_tender['File'][$file_key];
                    }
                } else {
                    $fileListArr[$ten_key][0]['id'] = $Id;
                    $fileListArr[$ten_key][0]['TenderNo'] = $TenderNo;
                    $fileListArr[$ten_key][0]['TenderFileName'] = $ten_value['FileName']['TenderFileName'];
                    $fileListArr[$ten_key][0]['File'] = $ten_value['FileName']['File'];
                } 

               $curr_tender['Active'] = Security::sanitizeInput($ten_value['Active'],"string");
               $curr_tender['Date'] = $ten_value['Date'];
               $curr_tender['AwardedAmount'] = Security::sanitizeInput($ten_value['AwardedAmount'],"string");
               $curr_tender['AwardedDate'] = $ten_value['AwardedDate'];
               $curr_tender['BidderName'] = Security::sanitizeInput($ten_value['BidderName'],"string"); 
               $sanitized_tender_values[] = $curr_tender;
           } 

           $matchedvalues = $this->matchTenderKey($sanitized_tender_values, $company_name);   
           $validation_res = $this->tenderValidation($matchedvalues); 

           $tenders = new OpentendersTbl;

           $valid_tenders = $validation_res['valid_arr'];
           $invalid_tenders = $validation_res['invalid_arr'];  

           $insert_tenders = $tenders->inserTenders($validation_res); 

           var_dump($insert_tenders);exit;
        }
    }
}