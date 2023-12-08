<?php

namespace api\modules\im\controllers;

use Yii;
use yii\rest\Controller;
use app\models\RoyaltyandasmtfeeTbl;
use app\models\FeesubScriptionmstTbl;
use app\models\AppcoursetrnstmpTbl;
use app\models\CoursecategorymstTbl;
use \common\components\Security;
use yii\db\ActiveRecord;
use app\models\RoyaltyandasmtfeehstyTbl;

class RoyaltyFeeController extends Controller
{

    public function behaviors()
    {
        /**/
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

        return $behaviors;
    }

    /**
     *
     * Request: GET/royaltyfeelist
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionRoyaltyfeelist()
    {
        $params = Yii::$app->request->post();
        $response = RoyaltyandasmtfeeTbl::getRoyaltyListingQuery($params);
        
        return $response;
    }

    public static function actionRoyaltyfeeView($roy_pk)
     {
        $model = RoyaltyandasmtfeeTbl::royaltyViewQuery($roy_pk);
        $response['data'] = $model; 
        return $response;
    }

    //add Comment
    public static function actionPaymentComment() 
    {
        $response['status'] = false; 
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $params = Yii::$app->request->post();
        if(!isset($params['roy_pk'])){
            return $response;
        }

        $model = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=>$params['roy_pk']])->one();
        $rasf_appdecon ='rasf_appdecon';
        $rasf_appdecby ='rasf_appdecby';
        $rasf_pymtstatus ='rasf_pymtstatus';
        $rasf_appdecComments ='rasf_appdecComments';

        if(empty($model)){
            $model = RoyaltyandasmtfeehstyTbl::find()->where(['rasfh_royaltyandasmtfee_fk' => $params['roy_pk']])->one();
            $rasf_appdecon ='rasfh_appdecon';
            $rasf_appdecby ='rasfh_appdecby';
            $rasf_pymtstatus ='rasfh_pymtstatus';
            $rasf_appdecComments ='rasfh_appdecComments';
        }
        if($model){
            $model->$rasf_appdecon = date('Y-m-d H:i:s');
            $model->$rasf_appdecby = $userPk;
            $model->$rasf_pymtstatus = $params['rasf_pymtstatus'];
            $model->$rasf_appdecComments = $params['rasf_appdecComments'];
            $model->save();

            $response['status'] = true; 
            $response['data'] = $model; 
        }
        return $response;
    }

    public function actionExportdata(){
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formdata['excel'] = 1;
        $response = [];
        $showColumn = $formdata['showCol'];
        $data = RoyaltyandasmtfeeTbl::getRoyaltyListingQuery($formdata);

        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Royalty_'.$time;        
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Training Evaluation Centre</span></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';

            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:"\@";} .invoice_month{mso-number-format:"mmmm yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ? '<th>Invoice Number</th>' : '';
                $value .= (in_array('company_name',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('trainingprovider',$showColumn)) ? '<th>Training Provider Name</th>' : '';
                $value .= (in_array('coursetitle',$showColumn)) ? '<th>Course Title</th>' : '';
                $value .= (in_array('coursecate',$showColumn)) ? '<th>Course Category</th>' : '';
                $value .= (in_array('officetype',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('branchname',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('locate',$showColumn)) ? '<th>Site Location</th>' : '';
                $value .= (in_array('opalmember',$showColumn)) ? '<th>OPAL Membership Number</th>' : '';
                $value .= (in_array('invoicemonth',$showColumn)) ? '<th>Invoice For The Month</th>' : '';
                $value .= (in_array('totallearner',$showColumn)) ? '<th>Total Learners</th>' : '';
                $value .= (in_array('invoiceamount',$showColumn)) ? '<th>Invoice Amount (OMR)</th>' : '';
                $value .= (in_array('paymentstatus',$showColumn)) ? '<th>Status</th>' : '';
                $value .= (in_array('invoicedate',$showColumn)) ? '<th>Invoice Date</th>' : '';
                $value .= (in_array('invoiceage',$showColumn)) ? '<th>Invoice Age</th>' : '';
                $value .= (in_array('genratedon',$showColumn)) ?'<th>Generated On</th>':'';
                $value .= (in_array('genratedby',$showColumn)) ?'<th>Generated By</th>':'';
                $value .= (in_array('paymentdate',$showColumn)) ? '<th>Payment Date</th>' : '';
                $value .= (in_array('lastupdate',$showColumn)) ?'<th>Last Updated On</th>':'';
                $value .= (in_array('lastupdateby',$showColumn)) ?'<th>Last Updated By</th>':'';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){
                            //Office Type
                            $ofType = $attend['officetype'];

                            //Branch Name.
                            $brName = "";
                            if($attend['officetype'] == 'Main office'){
                                $brName = $attend['appiim_branchname_en'];
                            }

                            //Course Title.
                            $curTle = "";
                            $curcat = "";
                            if(!empty($attend['appcdt_standardcoursemst_fk'])){
                                $curTle = $attend['scm_coursename_en'];
                                // $curcat = $attend['catstden'];
                            }elseif(!empty($attend['appcdt_appoffercoursemain_fk'])){
                                $curTle = $attend['appocm_coursename_en'];
                                // $curcat = $attend['catofren'];
                            }

                            //Status.
                            $status = "";
                            if($attend['paymentstatus'] == '1'){
                                $status = "Pending";
                            }elseif($attend['paymentstatus'] == '2'){
                                $status = "Paid - Confirmation Pending";
                            }elseif($attend['paymentstatus'] == '3'){
                                $status = "Overdue";
                            }elseif($attend['paymentstatus'] == '4'){
                                $status = "Received";
                            }elseif($attend['paymentstatus'] == '5'){
                                $status = "Not Received";
                            }

                            $age = "-";
                           if(!empty($attend["invoiceage"])){
                               if($attend['paymentstatus'] != '2' || $attend['paymentstatus'] != '4'){
                                   $age = $attend["invoiceage"]." days";
                               }
                           }
                           $amount = ($attend["invoiceamount"]?number_format($attend["invoiceamount"],3)." OMR":"-");

                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ? '<td valing="top">'.($attend["invoiceno"] ? $attend["invoiceno"] : "-").'</td>' : '';
                            $value .= (in_array('company_name',$showColumn)) ? '<td valing="top">'.($attend["companyname_en"] ? $attend["companyname_en"] :"-").'</td>' : '';
                            $value .= (in_array('trainingprovider',$showColumn)) ? '<td valing="top">'.($attend["trainingprovider_en"] ? $attend["trainingprovider_en"] : "-").'</td>' : '';
                            $value .= (in_array('coursetitle',$showColumn)) ? '<td valing="top">'.($curTle ? $curTle : "-").'</td>' : '';
                            $value .= (in_array('coursecate',$showColumn)) ? '<td valing="top">'.($attend["subcaten"] ? $attend["subcaten"] : "-").'</td>' : '';
                            $value .= (in_array('officetype',$showColumn)) ? '<td valing="top">'.($ofType ? $ofType : "-").'</td>' : '';
                            $value .= (in_array('branchname',$showColumn)) ? '<td valing="top">'.($attend["branchname_en"] ? $attend["branchname_en"] : "-").'</td>' : '';
                            $value .= (in_array('locate',$showColumn)) ? '<td valing="top">'.($attend["state_en"] ? $attend["state_en"] : "-").', '.$attend["city_en"].'</td>' : '';
                            $value .= (in_array('opalmember',$showColumn)) ? '<td valing="top">'.($attend["opalmember"] ? $attend["opalmember"] : "-").'</td>' : '';
                            $value .= (in_array('invoicemonth',$showColumn)) ? '<td valing="top" class="invoice_month">'.($attend["invoicemonth"] ? $attend["invoicemonth"] : "-").'</td>' : '';
                            $value .= (in_array('totallearner',$showColumn)) ? '<td valing="top">'.($attend["totallearner"] ? $attend["totallearner"] :"-").'</td>' : '';
                            $value .= (in_array('invoiceamount',$showColumn)) ? '<td valing="top">'.$amount.'</td>' : '';
                            $value .= (in_array('paymentstatus',$showColumn)) ? '<td valing="top">'.($status ? $status : "-").'</td>' : '';
                            $value .= (in_array('invoicedate',$showColumn)) ? '<td valing="top">'.($attend["invoicedate"] ? $attend["invoicedate"] : "-").'</td>' : '';
                            $value .= (in_array('invoiceage',$showColumn)) ? '<td valing="top">'.($age).'</td>' : '';
                            $value .= (in_array('genratedon',$showColumn)) ?'<td valing="top">'.($attend["genratedon"]?$attend["genratedon"]:"-").'</td>':"";
                            $value .= (in_array('genratedby',$showColumn)) ?'<td valing="top">'.($attend["genratedby"]?$attend["genratedby"]:"-").'</td>':"";
                            $value .= (in_array('paymentdate',$showColumn)) ? '<td valing="top">'.($attend["paymentdate"] ? $attend["paymentdate"] : "-").'</td>' : '';
                            $value .= (in_array('lastupdate',$showColumn)) ?'<td valing="top">'.($attend["lastupdate"]?$attend["lastupdate"]:"-").'</td>':"";
                            $value .= (in_array('lastupdateby',$showColumn)) ?'<td valing="top">'.($attend["lastupdateby"]?$attend["lastupdateby"]:"-").'</td>':"";
                        $value .= '</tr>';   
                    }
                $value .= '</table>';
            }
            $data1= trim($value) . "\n";
            if(!empty($data1) && !empty($exeFileName)){
                $filename=$exeFileName.'.xls';
                $zip->addFromString($filename,$data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__).'/../web/exports/invice/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/royalty-fee/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    public static function actionDownloadSingleRoyalty($roy_pk)
     {
        $formdata['roy_pk'] = $roy_pk;
        $response = [];
        $data = RoyaltyandasmtfeeTbl::downloadSingleRoyaltyQuery($roy_pk);
        // echo'<pre>';print_r($data);die('test');
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Royalty_'.$id.'_'.$time;     
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            // $value .= '<table><tr><td colspan="1" rowspan="5" align="center"></td><td colspan="3" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr></table>';   
            // $value .= '<table><tr><td></td></tr></table>';  
            // $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Title </td><td colspan="1"> Royalty Fee </td><td colspan="2" rowspan="6" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Training Centre </td><td colspan="1"> '.($data['trainingprovider_en']??"-").' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Office Type </td><td colspan="1"> '.($data['officetype'] ? $data['officetype'] : '-').' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Branch Name </td><td colspan="1"> '.($data['branchname_en'] ? $data['branchname_en'] : '-').' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Invoice Number </td><td colspan="1"> '.($data['invoiceno']??"-").' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
            $value .= '<tr></tr>';
            $value .= '</table>';
            $value .= '<style>.text{mso-number-format:"\@";} .date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';

            $value .= '<tr style="background-color:#E7E7E7;height:40px">';
            $value .= '<th>Learner ID</th>';
            $value .= '<th>Learner Name</th>';
            $value .= '<th>Learner Number (Phone No)</th>';
            $value .= '<th>Learner Email</th>';
            $value .= '<th>Category</th>';
            $value .= '<th>Knowledge Assessment Passing Status </th>';
            $value .= '<th>Practical Assessment Passing Status</th>';
            $value .= '<th>Learner Stage</th>';
            $value .= '<th>Batch Number</th>';
            $value .= '<th>Training Date (Theory)</th>';
            $value .= '<th>Training Date (Practical)</th>';
            $value .= '<th>Assessment Date</th>';
            $value .= '<th>Teaching and Assessment Language</th>';
            $value .= '<th>Batch Type</th>';
            $value .= '<th>Knowledge Assessment Score</th>';
            $value .= '<th>Practical Assessment Score</th>';
            $value .= '<th>Expiry date</th>';
            $value .= '<th>Governorate</th>';
            $value .= '<th>Wilayat</th>';
            $value .= '<th>Training Centre</th>';
            $value .= '<th>Office Type</th>';
            $value .= '<th>Branch Name</th>';
            $value .= '<th>Tutor(Teaching)</th>';
            $value .= '<th>Tutor(Practical)</th>';
            $value .= '<th>Assessment Centre</th>';
            $value .= '<th>Assessor</th>';
            $value .= '<th>IQA</th>';
            $value .= '<th>Verification Number</th>';
           
            $value .= '</tr>';
            // print_r($data); die;
                foreach($data['learner'] as $attend){
                        $dateTheory = $attend["DatePractical"] ? $attend["DatePractical"] : "-";
                        $value .= '<tr>';
                        $value .= '<td valing="top">'.($attend["LearnerID"] ? $attend["LearnerID"] : '-').'</td>';
                        $value .= '<td valing="top">'.($attend["LearnerName"] ? $attend["LearnerName"] : '-').'</td>';
                        $value .= '<td valing="top" class="text">'.($attend["LearnerNumber"] ? $attend["LearnerNumber"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["LearnerEmail"] ? $attend["LearnerEmail"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["Category"] ? $attend["Category"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["KnowledgeAssessmentPassingStatus"] ? $attend["KnowledgeAssessmentPassingStatus"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["PracticalAssessmentPassingStatus"] ? $attend["PracticalAssessmentPassingStatus"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["LearnerStage"] ? $attend["LearnerStage"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["BatchNumber"] ? $attend["BatchNumber"] : "-").'</td>';
                        $value .= '<td valing="top" class="date">'.($attend["DateTheory"] ? $attend["DateTheory"] : "-").'</td>';
                        $value .= '<td valing="top" class="date">'.(string)$dateTheory.'</td>';
                        $value .= '<td valing="top" class="date">'.($attend["bmah_assessmentdate"] ? $attend["bmah_assessmentdate"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["lang_en"] ? $attend["lang_en"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["type_en"] ? $attend["type_en"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["KnowledgeAssessmentScore"] ? $attend["KnowledgeAssessmentScore"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["PracticalAssessmentScore"] ? $attend["PracticalAssessmentScore"] : "-").'</td>';
                        $value .= '<td valing="top">'.($data['invoiceexpiry'] ? $data['invoiceexpiry'] : "-").'</td>';
                        $value .= '<td valing="top">'.($data['state_en'] ? $data['state_en'] : "-").'</td>';
                        $value .= '<td valing="top">'.($data['city_en'] ? $data['city_en'] : "-").'</td>';
                        $value .= '<td valing="top">'.($data["trainingprovider_en"] ? $data["trainingprovider_en"] : "-").'</td>';
                        $value .= '<td valing="top">'.($data["officetype"] ? $data["officetype"] : "-").'</td>';
                        $value .= '<td valing="top">'.($data["branchname_en"] ? $data["branchname_en"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["TutorTeaching"] ? $attend["TutorTeaching"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["TutorPractical"] ? $attend["TutorPractical"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["AssessmentCentre"] ? $attend["AssessmentCentre"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["assessor"] ? $attend["assessor"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["IQA"] ? $attend["IQA"] : "-").'</td>';
                        $value .= '<td valing="top">'.($attend["VerficationNumber"] ? $attend["VerficationNumber"] :"-").'</td>';
                        $value .= '</tr>';   
                }
            $value .= '</table>';
            $data1= trim($value) . "\n";
            if(!empty($data1) && !empty($exeFileName)){
                $filename=$exeFileName.'.xls';
                $zip->addFromString($filename,$data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__).'/../web/exports/invice/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/royalty-fee/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    public function actionDownloaddata(){
        if($_REQUEST['filename']){
            $trackpk = \api\components\Security::decrypt($_REQUEST['filename']);
            $zipfilename = $trackpk.'.zip';
            $dir = \Yii::$app->params['srcDirectory'];
            $zipfilepath = $dir.'web/exports/invice/'.$zipfilename;
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

    public static function actionGenerateInvoice() 
    {
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        \Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $params = Yii::$app->request->get();
        $expiry_days = Yii::$app->params['expiry_days']??60;
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $selectedDate = new \DateTime($params['month']);
        $month = $selectedDate->format("Y-m");
        
        $prevMonth = date('Y-m', strtotime("-1 month", strtotime($month)));
        $prevData = RoyaltyandasmtfeeTbl::find()->where([
            'AND',
            ['LIKE', 'rasf_raisedon', $prevMonth],
            ['rasf_feetype' => 1],
            ['!=','rasf_projectmst_fk',4]
        ])->all();

        $data = RoyaltyandasmtfeeTbl::royaltyBatchLearnerDetails($params);
        if(count($data) > 0){
            $transaction = Yii::$app->db->beginTransaction();
            $expiry_date = new \DateTime(date('Y-m-d H:i:s'));
            $expiry_date->modify("+$expiry_days days");
            try{
                $newFlag = false;
                foreach($data as $dataOne){
                    if(empty($dataOne['rasf_invoicedamount'])){
                        continue;
                    }
                    $checkCourse = RoyaltyandasmtfeeTbl::find()->where([
                        'AND',
                        ['LIKE', 'rasf_raisedon', $month],
                        ['rasf_appcoursedtlsmain_fk'=>$dataOne['rasf_appcoursedtlsmain_fk']],
                        ['rasf_feetype' => 1],
                        ['!=','rasf_projectmst_fk',4]
                    ])->one();
                    if(empty($checkCourse)){
                        $newFlag =true;
                        $model = new RoyaltyandasmtfeeTbl();
                        $model->rasf_projectmst_fk=$dataOne['rasf_projectmst_fk'];
                        $model->rasf_appcoursedtlsmain_fk=$dataOne['rasf_appcoursedtlsmain_fk'];
                        $model->rasf_feesubscriptionmst_fk=$dataOne['rasf_feesubscriptionmst_fk'];
                        $model->rasf_raisedon = $selectedDate->format("Y-m-d");
                        $model->rasf_feetype = 1;
                        $model->rasf_invoiceno = "I";
                        $model->rasf_totrecord =$dataOne['rasf_totrecord'];
                        $model->rasf_invoicedamount=$dataOne['rasf_invoicedamount'];
                        $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                        $model->rasf_vatpercent='5';
                        $model->rasf_invoiceexpiry=$expiry_date->format("Y-m-d H:i:s");
                        $model->rasf_pymtstatus=1;
                        $model->rasf_invoicestatus=1;
                        $model->rasf_paidby=$dataOne['rasf_paidby'];
                        $model->rasf_createdon=date('Y-m-d H:i:s');
                        $model->rasf_createdby=$userPk;
    
                        if(!$model->save()){
                            $response['message'] = $model->getErrors();
                            $response['status'] = false;
                            $transaction->rollBack();
                            return $response;
                        }else{
                            $model->rasf_invoiceno = "INV-".$dataOne['opalMember']."-CRF-".date('Y')."-".$model->royaltyandasmtfee_pk;
                            $model->save();
                            \Yii::$app->db->createCommand()->insert('leanerandvehicledtls_tbl', [
                                'lavd_royaltyandasmtfee_fk' => $model->royaltyandasmtfee_pk,
                                'lavd_rasvehicleregdtls_fk' => '',
                                'lavd_learnerreghrddtls_fk' =>$dataOne['lavd_learnerreghrddtls_fk']
                            ])->execute();
                        }
                    }
                }

                if($newFlag){
                    foreach($prevData as $pData){
                        $hModel = new RoyaltyandasmtfeehstyTbl();
                        $hModel->rasfh_royaltyandasmtfee_fk = $pData->royaltyandasmtfee_pk; 
                        $hModel->rasfh_projectmst_fk = $pData->rasf_projectmst_fk;
                        $hModel->rasfh_appcoursedtlsmain_fk = $pData->rasf_appcoursedtlsmain_fk;
                        $hModel->rasfh_feesubscriptionmst_fk = $pData->rasf_feesubscriptionmst_fk;
                        $hModel->rasfh_feetype = $pData->rasf_feetype;
                        $hModel->rasfh_invoiceno = $pData->rasf_invoiceno;
                        $hModel->rasfh_raisedon = $pData->rasf_raisedon;
                        $hModel->rasfh_totrecord = $pData->rasf_totrecord;
                        $hModel->rasfh_invoicedamount = $pData->rasf_invoicedamount;
                        $hModel->rasfh_vatamount= $pData->rasf_vatamount;
                        $hModel->rasfh_vatpercent= $pData->rasf_vatpercent;;
                        $hModel->rasfh_invoiceexpiry = $pData->rasf_invoiceexpiry;
                        $hModel->rasfh_paymenttype = $pData->rasf_paymenttype;
                        $hModel->rasfh_transuniqueId=$pData->rasf_transuniqueId;
                        $hModel->rasfh_paymentmode=$pData->rasf_paymentmode;
                        $hModel->rasfh_offlinerefno=$pData->rasf_offlinerefno;
                        $hModel->rasfh_bankname=$pData->rasf_bankname;
                        $hModel->rasfh_dateofpymt=$pData->rasf_dateofpymt;
                        $hModel->rasfh_Comments=$pData->rasf_Comments;
                        $hModel->rasfh_payURL=$pData->rasf_payURL;
                        $hModel->rasfh_pymtproof=$pData->rasf_pymtproof;
                        $hModel->rasfh_ressenton=$pData->rasf_ressenton;
                        $hModel->rasfh_opalusermst_fk=$pData->rasf_opalusermst_fk;
                        $hModel->rasfh_reqfrmurl=$pData->rasf_reqfrmurl;
                        $hModel->rasfh_bankrturl=$pData->rasf_bankrturl;
                        $hModel->rasfh_paymenttoken=$pData->rasf_paymenttoken;
                        $hModel->rasfh_cardno=$pData->rasf_cardno;
                        $hModel->rasfh_cardexpiry=$pData->rasf_cardexpiry;
                        $hModel->rasfh_pymtstatus=$pData->rasf_pymtstatus;
                        $hModel->rasfh_invoicestatus=$pData->rasf_invoicestatus;
                        $hModel->rasfh_paidby=$pData->rasf_paidby;
                        $hModel->rasfh_paidto=$pData->rasf_paidto;
                        $hModel->rasfh_updatedon=$pData->rasf_updatedon;
                        $hModel->rasfh_updatedby=$pData->rasf_updatedby;
                        $hModel->rasfh_createdon=$pData->rasf_createdon;
                        $hModel->rasfh_createdby=$pData->rasf_createdby;
                        $hModel->rasfh_appdecon = $pData->rasf_appdecon;
                        $hModel->rasfh_appdecby = $pData->rasf_appdecby;
                        $hModel->rasfh_appdecComments = $pData->rasf_appdecComments;
                        $hModel->save();
                    
                        $pData->delete();
                    }
                    $response['status']= true;
                    $response['message']= "Invoice has been generated for the selected month.";
                }else{
                    $response['status']= false;
                    $response['message']= "There have been no new Invoice to be generated in the selected month.";
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $response['status']= false;
                $response['message']= $e->getMessage();
            }
        }else{
            $response['status']= false;
            $response['message']= "There have been no new Invoice to be generated in the selected month.";
        }
        return $response;
    }

    public static function actionRegenerateInvoice() 
    {
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        \Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();

        $params = Yii::$app->request->get();
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $roy_pk = $params['roy_pk'];
        $oldData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $roy_pk])->asArray()->one();
        $pData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $roy_pk])->one();
        $checkIds = Yii::$app->db->createCommand("SELECT lavd_learnerreghrddtls_fk FROM leanerandvehicledtls_tbl WHERE lavd_royaltyandasmtfee_fk = $roy_pk")->queryOne();
        
        if($oldData){
            $date=date_create($oldData['rasf_raisedon']);
            $params['month']=date_format($date,"Y-m");
            $params['rasf_appcoursedtlsmain_fk'] = $oldData['rasf_appcoursedtlsmain_fk'];
            
            $data = RoyaltyandasmtfeeTbl::royaltyBatchLearnerDetails($params);

            if(empty($data)){
                $response['status']= false;
                $response['message']= "There have been no updates made at the selected Centre's Location to re-generate the invoice.";
                return $response;
            }
            if(isset($checkIds['lavd_learnerreghrddtls_fk']) && $data['lavd_learnerreghrddtls_fk'] == $checkIds['lavd_learnerreghrddtls_fk']){
                $response['status']= false;
                $response['message']= "There have been no updates made at the selected Centre's Location to re-generate the invoice.";
                return $response;
            }

            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model = new RoyaltyandasmtfeeTbl();
                $model->attributes = $oldData; 
                $model->rasf_projectmst_fk=$data['rasf_projectmst_fk'];
                $model->rasf_appcoursedtlsmain_fk=$data['rasf_appcoursedtlsmain_fk'];
                $model->rasf_feesubscriptionmst_fk=$data['rasf_feesubscriptionmst_fk'];
                $model->rasf_totrecord =$data['rasf_totrecord'];
                $model->rasf_invoicedamount=$data['rasf_invoicedamount'];
                $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                $model->rasf_updatedon=date('Y-m-d H:i:s');
                $model->rasf_updatedby=$userPk;

                if(!$model->save()){
                    $response['message'] = $model->getErrors();
                    $response['staus'] = false;
                    $transaction->rollBack();
                    return $response;
                }else{
                    $model->rasf_invoiceno = "INV-".$data['opalMember']."-CRF-".date('Y')."-".$model->royaltyandasmtfee_pk;
                    $model->save();
                    \Yii::$app->db->createCommand()->insert('leanerandvehicledtls_tbl', [
                        'lavd_royaltyandasmtfee_fk' => $model->royaltyandasmtfee_pk,
                        'lavd_rasvehicleregdtls_fk' => '',
                        'lavd_learnerreghrddtls_fk' =>$data['lavd_learnerreghrddtls_fk']
                    ])->execute();
                }
                    $pData->rasf_invoicestatus=2;
                    $pData->save();
                    $response['status']= true;
                    $response['message']= "The Invoice has been re-generated for the selected Centre’s Location.";
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    $response['status']= false;
                    $response['message']= $e->getMessage();
                }
        }else{
            $response['status']= true;
            $response['message']= "Wrong data !!";
        }
        return $response;
    }

    public static function actionLearnerListing() 
    {
        $params = Yii::$app->request->post();
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $response = RoyaltyandasmtfeeTbl::royaltyBatchLearnerListing($params);
        return $response;
    }

     /// Technical Evaluation

    public function actionTechRoyaltyfeelist()
    {
        $params = Yii::$app->request->post();
        $response = RoyaltyandasmtfeeTbl::techRoyaltyListingQuery($params);
        
        return $response;
    }

    /// Technical installation 
    public function actionTechivmslist()
    {
        $params = Yii::$app->request->post();
        $response = RoyaltyandasmtfeeTbl::techIvmsQuery($params);
        
        return $response;
    }

    public function actionGenerateVehicleInvoice() 
    {
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $params = Yii::$app->request->get();
        $expiry_days = Yii::$app->params['expiry_days']??60;
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $selectedDate = new \DateTime($params['month']);
        $month = $selectedDate->format("Y-m");
        
        $prevMonth = date('Y-m', strtotime("-1 month", strtotime($month)));
        $prevData = RoyaltyandasmtfeeTbl::find()->where([
            'AND',
            ['LIKE', 'rasf_raisedon', $prevMonth],
            ['rasf_feetype' => 1],
            ['rasf_projectmst_fk' => 4]
        ])->all();

        $data = RoyaltyandasmtfeeTbl::generateVehicleInvoice($params);
        if(count($data) > 0){
            $transaction = Yii::$app->db->beginTransaction();
            $expiry_date = new \DateTime(date('Y-m-d H:i:s'));
            $expiry_date->modify("+$expiry_days days");
            try{
                $newFlag = false;
                foreach($data as $dataOne){
                    $checkCourse = RoyaltyandasmtfeeTbl::find()->where([
                        'AND',
                        ['LIKE', 'rasf_raisedon', $month],
                        ['rasf_paidby'=>$dataOne['rasf_paidby']],
                        ['rasf_feetype' => 1],
                        ['rasf_projectmst_fk' => 4]
                    ])->one();

                    if(empty($checkCourse)){
                        $newFlag =true;
                        $model = new RoyaltyandasmtfeeTbl();
                        $model->rasf_projectmst_fk=4;
                        // $model->rasf_appcoursedtlsmain_fk=$dataOne['rasf_appcoursedtlsmain_fk'];
                        $model->rasf_feesubscriptionmst_fk=$dataOne['rasf_feesubscriptionmst_fk'];
                        $model->rasf_raisedon = $selectedDate->format("Y-m-d");
                        $model->rasf_feetype = 1;
                        $model->rasf_invoiceno = "I";
                        $model->rasf_totrecord =$dataOne['rasf_totrecord'];
                        $model->rasf_invoicedamount=$dataOne['rasf_invoicedamount'];
                        $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                        $model->rasf_vatpercent='5';
                        $model->rasf_invoiceexpiry=$expiry_date->format("Y-m-d H:i:s");
                        $model->rasf_pymtstatus=1;
                        $model->rasf_invoicestatus=1;
                        $model->rasf_paidby=$dataOne['rasf_paidby'];
                        $model->rasf_createdon=date('Y-m-d H:i:s');
                        $model->rasf_createdby=$userPk;

                        if(!$model->save()){
                            $response['message'] = $model->getErrors();
                            $response['staus'] = false;
                            $transaction->rollBack();
                            return $response;
                        }else{
                            $model->rasf_invoiceno = "INV-".$dataOne['opalmember']."-VRF-".date('Y')."-".$model->royaltyandasmtfee_pk;
                            $model->save();
                            \Yii::$app->db->createCommand()->insert('leanerandvehicledtls_tbl', [
                                'lavd_royaltyandasmtfee_fk' => $model->royaltyandasmtfee_pk,
                                'lavd_rasvehicleregdtls_fk' => $dataOne['lavd_rasvehicleregdtls_fk'],
                                'lavd_learnerreghrddtls_fk' =>' '
                            ])->execute();
                        }
                    }
                }

                if($newFlag){
                    foreach($prevData as $pData){
                        $hModel = new RoyaltyandasmtfeehstyTbl();
                        $hModel->rasfh_royaltyandasmtfee_fk = $pData->royaltyandasmtfee_pk; 
                        $hModel->rasfh_projectmst_fk = $pData->rasf_projectmst_fk;
                        $hModel->rasfh_appcoursedtlsmain_fk = $pData->rasf_appcoursedtlsmain_fk;
                        $hModel->rasfh_feesubscriptionmst_fk = $pData->rasf_feesubscriptionmst_fk;
                        $hModel->rasfh_feetype = $pData->rasf_feetype;
                        $hModel->rasfh_invoiceno = $pData->rasf_invoiceno;
                        $hModel->rasfh_raisedon = $pData->rasf_raisedon;
                        $hModel->rasfh_totrecord = $pData->rasf_totrecord;
                        $hModel->rasfh_invoicedamount = $pData->rasf_invoicedamount;
                        $hModel->rasfh_vatamount= $pData->rasf_vatamount;
                        $hModel->rasfh_vatpercent= $pData->rasf_vatpercent;
                        $hModel->rasfh_invoiceexpiry = $pData->rasf_invoiceexpiry;
                        $hModel->rasfh_paymenttype = $pData->rasf_paymenttype;
                        $hModel->rasfh_transuniqueId=$pData->rasf_transuniqueId;
                        $hModel->rasfh_paymentmode=$pData->rasf_paymentmode;
                        $hModel->rasfh_offlinerefno=$pData->rasf_offlinerefno;
                        $hModel->rasfh_bankname=$pData->rasf_bankname;
                        $hModel->rasfh_dateofpymt=$pData->rasf_dateofpymt;
                        $hModel->rasfh_Comments=$pData->rasf_Comments;
                        $hModel->rasfh_payURL=$pData->rasf_payURL;
                        $hModel->rasfh_pymtproof=$pData->rasf_pymtproof;
                        $hModel->rasfh_ressenton=$pData->rasf_ressenton;
                        $hModel->rasfh_opalusermst_fk=$pData->rasf_opalusermst_fk;
                        $hModel->rasfh_reqfrmurl=$pData->rasf_reqfrmurl;
                        $hModel->rasfh_bankrturl=$pData->rasf_bankrturl;
                        $hModel->rasfh_paymenttoken=$pData->rasf_paymenttoken;
                        $hModel->rasfh_cardno=$pData->rasf_cardno;
                        $hModel->rasfh_cardexpiry=$pData->rasf_cardexpiry;
                        $hModel->rasfh_pymtstatus=$pData->rasf_pymtstatus;
                        $hModel->rasfh_invoicestatus=$pData->rasf_invoicestatus;
                        $hModel->rasfh_paidby=$pData->rasf_paidby;
                        $hModel->rasfh_paidto=$pData->rasf_paidto;
                        $hModel->rasfh_updatedon=$pData->rasf_updatedon;
                        $hModel->rasfh_updatedby=$pData->rasf_updatedby;
                        $hModel->rasfh_createdon=$pData->rasf_createdon;
                        $hModel->rasfh_createdby=$pData->rasf_createdby;
                        $hModel->rasfh_appdecon = $pData->rasf_appdecon;
                        $hModel->rasfh_appdecby = $pData->rasf_appdecby;
                        $hModel->rasfh_appdecComments = $pData->rasf_appdecComments;
                        $hModel->save();
                    
                        $pData->delete();
                    }
                    $response['status']= true;
                    $response['message']= "Invoice has been generated for the selected month.";
                }else{
                    $response['status']= false;
                    $response['message']= "There have been no new Invoice to be generated in the selected month.";
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $response['status']= false;
                $response['message']= $e->getMessage();
            }
        }else{
            $response['status']= false;
            $response['message']= "There have been no new Invoice to be generated in the selected month.";
        }
        return $response;
    }

    public function actionGenerateIvmsinvoice() 
    {
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $params = Yii::$app->request->get();
        $expiry_days = Yii::$app->params['expiry_days']??60;
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $selectedDate = new \DateTime($params['month']);
        $month = $selectedDate->format("Y-m");
        
        $prevMonth = date('Y-m', strtotime("-1 month", strtotime($month)));
        $prevData = RoyaltyandasmtfeeTbl::find()->where([
            'AND',
            ['LIKE', 'rasf_raisedon', $prevMonth],
            ['rasf_feetype' => 1],
            ['rasf_projectmst_fk' => 5]
        ])->all();

        $data = RoyaltyandasmtfeeTbl::generateIvmsInvoice($params);
        if(count($data) > 0){
            $transaction = Yii::$app->db->beginTransaction();
            $expiry_date = new \DateTime(date('Y-m-d H:i:s'));
            $expiry_date->modify("+$expiry_days days");
            try{
                $newFlag = false;
                foreach($data as $dataOne){
                    $checkCourse = RoyaltyandasmtfeeTbl::find()->where([
                        'AND',
                        ['LIKE', 'rasf_raisedon', $month],
                        ['rasf_paidby'=>$dataOne['rasf_paidby']],
                        ['rasf_feetype' => 1],
                        ['rasf_projectmst_fk' => 5]
                    ])->one();

                    if(empty($checkCourse)){
                        $newFlag =true;
                        $model = new RoyaltyandasmtfeeTbl();
                        $model->rasf_projectmst_fk=5;
                        // $model->rasf_appcoursedtlsmain_fk=$dataOne['rasf_appcoursedtlsmain_fk'];
                        $model->rasf_feesubscriptionmst_fk=$dataOne['rasf_feesubscriptionmst_fk'];
                        $model->rasf_raisedon = $selectedDate->format("Y-m-d");
                        $model->rasf_feetype = 1;
                        $model->rasf_invoiceno = "I";
                        $model->rasf_totrecord =$dataOne['rasf_totrecord'];
                        $model->rasf_invoicedamount=$dataOne['rasf_invoicedamount'];
                        $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                        $model->rasf_vatpercent='5';
                        $model->rasf_invoiceexpiry=$expiry_date->format("Y-m-d H:i:s");
                        $model->rasf_pymtstatus=1;
                        $model->rasf_invoicestatus=1;
                        $model->rasf_paidby=$dataOne['rasf_paidby'];
                        $model->rasf_createdon=date('Y-m-d H:i:s');
                        $model->rasf_createdby=$userPk;

                        if(!$model->save()){
                            $response['message'] = $model->getErrors();
                            $response['staus'] = false;
                            $transaction->rollBack();
                            return $response;
                        }else{
                            $model->rasf_invoiceno = "INV-".$dataOne['opalmember']."-DIVRF-".date('Y')."-".$model->royaltyandasmtfee_pk;
                            $model->save();
                            \Yii::$app->db->createCommand()->insert('leanerandvehicledtls_tbl', [
                                'lavd_royaltyandasmtfee_fk' => $model->royaltyandasmtfee_pk,
                                'lavd_rasvehicleregdtls_fk' => $dataOne['lavd_rasvehicleregdtls_fk'],
                                'lavd_learnerreghrddtls_fk' =>' '
                            ])->execute();
                        }
                    }
                }

                if($newFlag){
                    foreach($prevData as $pData){
                        $hModel = new RoyaltyandasmtfeehstyTbl();
                        $hModel->rasfh_royaltyandasmtfee_fk = $pData->royaltyandasmtfee_pk; 
                        $hModel->rasfh_projectmst_fk = $pData->rasf_projectmst_fk;
                        $hModel->rasfh_appcoursedtlsmain_fk = $pData->rasf_appcoursedtlsmain_fk;
                        $hModel->rasfh_feesubscriptionmst_fk = $pData->rasf_feesubscriptionmst_fk;
                        $hModel->rasfh_feetype = $pData->rasf_feetype;
                        $hModel->rasfh_invoiceno = $pData->rasf_invoiceno;
                        $hModel->rasfh_raisedon = $pData->rasf_raisedon;
                        $hModel->rasfh_totrecord = $pData->rasf_totrecord;
                        $hModel->rasfh_invoicedamount = $pData->rasf_invoicedamount;
                        $hModel->rasfh_vatamount= $pData->rasf_vatamount;
                        $hModel->rasfh_vatpercent= $pData->rasf_vatpercent;
                        $hModel->rasfh_invoiceexpiry = $pData->rasf_invoiceexpiry;
                        $hModel->rasfh_paymenttype = $pData->rasf_paymenttype;
                        $hModel->rasfh_transuniqueId=$pData->rasf_transuniqueId;
                        $hModel->rasfh_paymentmode=$pData->rasf_paymentmode;
                        $hModel->rasfh_offlinerefno=$pData->rasf_offlinerefno;
                        $hModel->rasfh_bankname=$pData->rasf_bankname;
                        $hModel->rasfh_dateofpymt=$pData->rasf_dateofpymt;
                        $hModel->rasfh_Comments=$pData->rasf_Comments;
                        $hModel->rasfh_payURL=$pData->rasf_payURL;
                        $hModel->rasfh_pymtproof=$pData->rasf_pymtproof;
                        $hModel->rasfh_ressenton=$pData->rasf_ressenton;
                        $hModel->rasfh_opalusermst_fk=$pData->rasf_opalusermst_fk;
                        $hModel->rasfh_reqfrmurl=$pData->rasf_reqfrmurl;
                        $hModel->rasfh_bankrturl=$pData->rasf_bankrturl;
                        $hModel->rasfh_paymenttoken=$pData->rasf_paymenttoken;
                        $hModel->rasfh_cardno=$pData->rasf_cardno;
                        $hModel->rasfh_cardexpiry=$pData->rasf_cardexpiry;
                        $hModel->rasfh_pymtstatus=$pData->rasf_pymtstatus;
                        $hModel->rasfh_invoicestatus=$pData->rasf_invoicestatus;
                        $hModel->rasfh_paidby=$pData->rasf_paidby;
                        $hModel->rasfh_paidto=$pData->rasf_paidto;
                        $hModel->rasfh_updatedon=$pData->rasf_updatedon;
                        $hModel->rasfh_updatedby=$pData->rasf_updatedby;
                        $hModel->rasfh_createdon=$pData->rasf_createdon;
                        $hModel->rasfh_createdby=$pData->rasf_createdby;
                        $hModel->rasfh_appdecon = $pData->rasf_appdecon;
                        $hModel->rasfh_appdecby = $pData->rasf_appdecby;
                        $hModel->rasfh_appdecComments = $pData->rasf_appdecComments;
                        $hModel->save();
                    
                        $pData->delete();
                    }
                    $response['status']= true;
                    $response['message']= "Invoice has been generated for the selected month.";
                }else{
                    $response['status']= false;
                    $response['message']= "There have been no new Invoice to be generated in the selected month.";
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $response['status']= false;
                $response['message']= $e->getMessage();
            }
        }else{
            $response['status']= false;
            $response['message']= "There have been no new Invoice to be generated in the selected month.";
        }
        return $response;
    }

    public static function actionTechRoyaltyfeeView($roy_pk)
    {
        $model = RoyaltyandasmtfeeTbl::techRoyaltyViewQuery($roy_pk);
        $response['data'] = $model; 
        return $response;
    }

    public static function actionTechRoyaltyviewIvms($roy_pk)
    {
        $model = RoyaltyandasmtfeeTbl::techroyaltyviewIvms($roy_pk);
        $response['data'] = $model; 
        return $response;
    }
    
    public static function actionVehicleListing() 
    {
        $params = Yii::$app->request->post();
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $response = RoyaltyandasmtfeeTbl::vehicleListing($params);
        return $response;
    }

    public static function actionIvmsvehicleListing() 
    {
        $params = Yii::$app->request->post();
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $response = RoyaltyandasmtfeeTbl::ivmsvehicleListing($params);
        return $response;
    }
    
    public static function actionTechRegenerateInvoice() 
    {
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        \Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $params = Yii::$app->request->get();
        $roy_pk = $params['roy_pk'];
        $oldData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $roy_pk])->asArray()->one();
        $pData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $roy_pk])->one();
        $checkIds = Yii::$app->db->createCommand("SELECT lavd_rasvehicleregdtls_fk FROM leanerandvehicledtls_tbl WHERE lavd_royaltyandasmtfee_fk = $roy_pk")->queryOne();

        if($oldData){
            $date=date_create($oldData['rasf_raisedon']);
            $params['month']=date_format($date,"Y-m");
            $params['rasf_paidby'] = $oldData['rasf_paidby'];
            $data = RoyaltyandasmtfeeTbl::generateVehicleInvoice($params);
            if(empty($data)){
                $response['status']= false;
                $response['message']= "There have been no updates made at the selected Centre's Location to re-generate the invoice.";
                return $response;
            }
            if(isset($checkIds['lavd_rasvehicleregdtls_fk']) && $data['lavd_rasvehicleregdtls_fk'] == $checkIds['lavd_rasvehicleregdtls_fk']){
                $response['status']= false;
                $response['message']= "There have been no updates made at the selected Centre's Location to re-generate the invoice.";
                return $response;
            }
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model = new RoyaltyandasmtfeeTbl();
                $model->attributes = $oldData; 
                $model->rasf_feesubscriptionmst_fk=$data['rasf_feesubscriptionmst_fk'];
                $model->rasf_totrecord =$data['rasf_totrecord'];
                $model->rasf_invoicedamount=$data['rasf_invoicedamount'];
                $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                $model->rasf_updatedon=date('Y-m-d H:i:s');
                $model->rasf_updatedby=$userPk;

                if(!$model->save()){
                    $response['message'] = $model->getErrors();
                    $response['staus'] = false;
                    $transaction->rollBack();
                    return $response;
                }else{
                    $model->rasf_invoiceno = "INV-".$data['opalmember']."-VRF-".date('Y')."-".$model->royaltyandasmtfee_pk;
                    $model->save();
                    \Yii::$app->db->createCommand()->insert('leanerandvehicledtls_tbl', [
                        'lavd_royaltyandasmtfee_fk' => $model->royaltyandasmtfee_pk,
                        'lavd_rasvehicleregdtls_fk' => $data['lavd_rasvehicleregdtls_fk'],
                        'lavd_learnerreghrddtls_fk' =>' '
                    ])->execute();
                }

                $pData->rasf_invoicestatus=2;
                $pData->save();
                $response['status']= true;
                $response['message']= "The Invoice has been re-generated for the selected Centre’s Location.";
                    $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $response['status']= false;
                $response['message']= $e->getMessage();
            }
        }else{
            $response['status']= false;
            $response['message']= "wrong Data";
        }
        return $response;
    }

     public static function actionTechRegenerateIvms() 
    {
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        \Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $params = Yii::$app->request->get();
        $roy_pk = $params['roy_pk'];
        $oldData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $roy_pk])->asArray()->one();
        $pData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $roy_pk])->one();
        $checkIds = Yii::$app->db->createCommand("SELECT lavd_rasvehicleregdtls_fk FROM leanerandvehicledtls_tbl WHERE lavd_royaltyandasmtfee_fk = $roy_pk")->queryOne();

        if($oldData){
            $date=date_create($oldData['rasf_raisedon']);
            $params['month']=date_format($date,"Y-m");
            $params['rasf_paidby'] = $oldData['rasf_paidby'];
            $data = RoyaltyandasmtfeeTbl::generateIvmsInvoice($params);
            if(empty($data)){
                $response['status']= false;
                $response['message']= "There have been no updates made at the selected Centre's Location to re-generate the invoice.";
                return $response;
            }
            if(isset($checkIds['lavd_rasvehicleregdtls_fk']) && $data['lavd_rasvehicleregdtls_fk'] == $checkIds['lavd_rasvehicleregdtls_fk']){
                $response['status']= false;
                $response['message']= "There have been no updates made at the selected Centre's Location to re-generate the invoice.";
                return $response;
            }
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model = new RoyaltyandasmtfeeTbl();
                $model->attributes = $oldData; 
                $model->rasf_feesubscriptionmst_fk=$data['rasf_feesubscriptionmst_fk'];
                $model->rasf_totrecord =$data['rasf_totrecord'];
                $model->rasf_invoicedamount=$data['rasf_invoicedamount'];
                $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                $model->rasf_updatedon=date('Y-m-d H:i:s');
                $model->rasf_updatedby=$userPk;

                if(!$model->save()){
                    $response['message'] = $model->getErrors();
                    $response['staus'] = false;
                    $transaction->rollBack();
                    return $response;
                }else{
                    $model->rasf_invoiceno = "INV-".$data['opalmember']."-VRF-".date('Y')."-".$model->royaltyandasmtfee_pk;
                    $model->save();
                    \Yii::$app->db->createCommand()->insert('leanerandvehicledtls_tbl', [
                        'lavd_royaltyandasmtfee_fk' => $model->royaltyandasmtfee_pk,
                        'lavd_rasvehicleregdtls_fk' => $data['lavd_rasvehicleregdtls_fk'],
                        'lavd_learnerreghrddtls_fk' =>' '
                    ])->execute();
                }

                $pData->rasf_invoicestatus=2;
                $pData->save();
                $response['status']= true;
                $response['message']= "The Invoice has been re-generated for the selected Centre’s Location.";
                    $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $response['status']= false;
                $response['message']= $e->getMessage();
            }
        }else{
            $response['status']= false;
            $response['message']= "wrong Data";
        }
        return $response;
    }
    public static function actionExportSingleTechRoyalty($roy_pk)
     {
        $formdata['roy_pk'] = $roy_pk;
        $response = [];
        $data = RoyaltyandasmtfeeTbl::downloadSingleTechRoyalty($roy_pk);
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Royalty_Tech_'.$time;     
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            // $value .= '<table><tr><td colspan="1" rowspan="5" align="center"></td><td colspan="3" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr></table>';   
            // $value .= '<table><tr><td></td></tr></table>';  
            // $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Title </td><td colspan="1"> Royalty Fee </td> <td colspan="2" rowspan="6" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> RASIC Centre </td><td colspan="1"> '.($data['trainingprovider_en']??"-").' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Office Type </td><td colspan="1"> '.($data['officetype'] ? $data['officetype'] : '-').' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Branch Name </td><td colspan="1"> '.($data['branchname_en'] ? $data['branchname_en'] : '-').' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
            $value .= '<tr></tr>';
            $value .= '</table>';
            $value .= '<style>.text{mso-number-format:\"\@\";} </style><table border="1" style="border-collapse:collapse;width:100%;">';

            $value .= '<th>Owner CR Number</th>';
            $value .= '<th>Owner Name</th>';
            $value .= '<th>Vehicle Registration Number</th>';
            $value .= '<th>Chassis Number</th>';
            $value .= '<th>IVMS Serial Number</th>';
            $value .= '<th>Speed Limiter Serial Number</th>';
            $value .= '<th>Vehicle Category</th>';
            $value .= '<th>Vehicle Fleet Number</th>';
            $value .= '<th>Road Type</th>';
            $value .= '<th>First ROP Registration Date</th>';
            $value .= '<th>Model Year</th>';
            $value .= '<th>Inspection Date</th>';
            $value .= '<th>Inspection Timing (From-To)</th>';
            $value .= '<th>Inspector Name</th>';
            $value .= '<th>RASIC Number</th>';
            $value .= '<th>Date Of Expiry</th>';
            $value .= '<th>Status</th>';
           
            $value .= '</tr>';

            $status = [
                1 => 'Inspection Pending',
                2 => 'Verification Pending',
                3 => 'Completed',
                4 => 'Supervisor Approval Pending',
                5 => 'Declined by Verifier',
                6 => 'Declined by Supervisor', 
                7 => 'Re-Inspection Required', 
                8 => 'Rejected', 
                9 => 'Rejected and Cancelled', 
                10 => 'Cancelled(Renewal)' 
            ];
                foreach($data['vehicle'] as $attend){
                        
                        $statusText  = isset($status[$attend['rvrd_inspectionstatus']])?$status[$attend['rvrd_inspectionstatus']]:'-'; 
                        $rvod = $attend["rvod_crnumber"]??'-';
                        $expiry = $attend["rvrd_dateofexpiry"]??'-';
                        $ownername_en = $attend["ownername_en"]??'-';
                        $vehiclenumber = $attend["vehiclenumber"]??'-';
                        $chassisnumber = $attend["chassisnumber"]??'-';
                        $serial_no = $attend["serial_no"]??'-';
                        $speed_limit = $attend["speed_limit"]??'-';
                        $vehicle_cat = $attend["vehicle_cat"]??'-';
                        $vehicle_fleet = $attend["vehicle_fleet"]??'-';
                        $roadtype = $attend["roadtype"]??'-';
                        $rvrd_firstropregdate = $attend["rvrd_firstropregdate"]??'-';
                        $rvrd_modelyear = $attend["rvrd_modelyear"]??'-';
                        $rvrd_dateofinsp = $attend["rvrd_dateofinsp"]??'-';
                        $rvrd_inspstarttime = $attend["rvrd_inspstarttime"]?$attend["rvrd_inspstarttime"]." - ".$attend["rvrd_inspendtime"]:'-';
                        $inspectorname = $attend["inspectorname"]??'-';
                        $rvrd_applicationrefno = $attend["rvrd_applicationrefno"]??'-';

                        $value .= '<tr>';
                        $value .= '<td valing="top">'.$rvod.'</td>';
                        $value .= '<td valing="top">'.$ownername_en.'</td>';
                        $value .= '<td valing="top">'.$vehiclenumber.'</td>';
                        $value .= '<td valing="top">'.$chassisnumber.'</td>';
                        $value .= '<td valing="top">'.$serial_no.'</td>';
                        $value .= '<td valing="top">'.$speed_limit.'</td>';
                        $value .= '<td valing="top">'.$vehicle_cat.'</td>';
                        $value .= '<td valing="top">'.$vehicle_fleet.'</td>';
                        $value .= '<td valing="top">'.$roadtype.'</td>';
                        $value .= '<td valing="top">'.$rvrd_firstropregdate.'</td>';
                        $value .= '<td valing="top">'.$rvrd_modelyear.'</td>';
                        $value .= '<td valing="top">'.$rvrd_dateofinsp.'</td>';
                        $value .= '<td valing="top">'.$rvrd_inspstarttime.'</td>';
                        $value .= '<td valing="top">'.$inspectorname.'</td>';
                        $value .= '<td valing="top">'.$rvrd_applicationrefno.'</td>';
                        $value .= '<td valing="top">'.$expiry.'</td>';
                        $value .= '<td valing="top">'.$statusText.'</td>';
                        $value .= '</tr>';   
                }
            $value .= '</table>';
            $data1= trim($value) . "\n";
            if(!empty($data1) && !empty($exeFileName)){
                $filename=$exeFileName.'.xls';
                $zip->addFromString($filename,$data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__).'/../web/exports/invice/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/royalty-fee/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    public static function actionExportSingleTechIvms($roy_pk)
     {
        $formdata['roy_pk'] = $roy_pk;
        $response = [];
        $data = RoyaltyandasmtfeeTbl::downloadSingleTechIvms($roy_pk);
        // print_r($data['vehicle']); die;
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Royalty_ivms_'.$time;     
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            // $value .= '<table><tr><td colspan="1" rowspan="5" align="center"></td><td colspan="3" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr></table>';   
            // $value .= '<table><tr><td></td></tr></table>';  
            // $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Title </td><td colspan="1"> Royalty Fee </td> <td colspan="2" rowspan="6" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> IVMS Centre </td><td colspan="1"> '.($data['trainingprovider_en']??"-").' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Office Type </td><td colspan="1"> '.($data['officetype'] ? $data['officetype'] : '-').' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Branch Name </td><td colspan="1"> '.($data['branchname_en'] ? $data['branchname_en'] : '-').' </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
            $value .= '<tr></tr>';
            $value .= '</table>';
            $value .= '<style>.text{mso-number-format:\"\@\";} .date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';

            $value .= '<th>Owner CR Number</th>';
            $value .= '<th>Owner Name</th>';
            // $value .= '<th>Contact Person Email ID</th>';
            $value .= '<th>Contact Person Mobile Number</th>';
            $value .= '<th>Vehicle Registration Number</th>';
            $value .= '<th>Chassis Number</th>';
            $value .= '<th>IVMS Device Model Number</th>';
            $value .= '<th>Software Version</th>';
            $value .= '<th>Vehicle Manufacturer</th>';
            $value .= '<th>Device Serial Number</th>';
            $value .= '<th>Device IMEI Number</th>';
            $value .= '<th>Vehicle Category</th>';
            $value .= '<th>Vehicle Sub-Category</th>';
            $value .= '<th>Speed Limiter Serial Number</th>';
            $value .= '<th>Vehicle Fleet Number</th>';
            $value .= '<th>First ROP Registration Date</th>';
            $value .= '<th>Model Year</th>';
            $value .= '<th>Installation Date</th>';
            $value .= '<th>Installation Timing (From - To)</th>';
            $value .= '<th>Installer Name</th>';
            $value .= '<th>Verification Code</th>';
            $value .= '<th>Date of Expiry</th>';
            $value .= '<th>Status</th>';
            $value .= '</tr>';

            $status = [
                1 => 'Inspection Pending',
                2 => 'Verification Pending',
                3 => 'Completed',
                4 => 'Supervisor Approval Pending',
                5 => 'Declined by Verifier',
                6 => 'Declined by Supervisor', 
                7 => 'Re-Inspection Required', 
                8 => 'Rejected', 
                9 => 'Rejected and Cancelled', 
                10 => 'Cancelled(Renewal)' 
            ];
                foreach($data['vehicle'] as $attend){
                        
                        $rvod = $attend["rvod_crnumber"]??'-';
                        $ownername_en = $attend["ownername_en"]??'-';
                        $contactPerson = $attend["ivrd_contpermobno"]??'-';
                        $vehiclenumber = $attend["vehiclenumber"]??'-';
                        $chassisnumber = $attend["chassisnumber"]??'-';
                        $modelNo = $attend["appdim_modelno"]??'-';;
                        $softVersion = $attend["ivrd_softwareversion"]??'-';
                        $vehiceManu = $attend["manufactor"]??'-';
                        $deviceSerial = $attend["serial_no"]??'-';
                        $imei = $attend["ivrd_deviceimeino"]??'-';
                        $vehicle_cat = $attend["vehicle_cat"]??'-';
                        $vehicle_subcat = $attend["vehicle_subcat"]??'-';
                        $speed_limit = $attend["speed_limit"]??'-';
                        $vehicle_fleet = $attend["vehicle_fleet"]??'-';
                        $rvrd_firstropregdate = $attend["rvrd_firstropregdate"]??'-';
                        $rvrd_modelyear = $attend["rvrd_modelyear"]??'-';
                        $installtion = $attend["ivrd_dateoffiiting"]??'-';
                        $installtionTime = $attend["ivrd_inststarttime"]?$attend["ivrd_inststarttime"]." - ".$attend["ivrd_instendtime"]:'-';
                        $inspectorname = $attend["inspectorname"]??'-';
                        $verificationCode = $attend["ivrd_verficationcode"]??'-';
                        $dateOfExpiry = $attend["ivrd_dateofexpiry"]??'-';
                        $statusText  = isset($status[$attend['ivrd_inspectionstatus']])?$status[$attend['ivrd_inspectionstatus']]:'-'; 

                        $value .= '<tr>';
                        $value .= '<td valing="top">'.$rvod.'</td>';
                        $value .= '<td valing="top">'.$ownername_en.'</td>';
                        $value .= '<td valing="top">'.$contactPerson.'</td>';
                        $value .= '<td valing="top">'.$vehiclenumber.'</td>';
                        $value .= '<td valing="top">'.$chassisnumber.'</td>';
                        $value .= '<td valing="top">'.$modelNo.'</td>';
                        $value .= '<td valing="top">'.$softVersion.'</td>';
                        $value .= '<td valing="top">'.$vehiceManu.'</td>';
                        $value .= '<td valing="top">'.$deviceSerial.'</td>';
                        $value .= '<td valing="top">'.$imei.'</td>';
                        $value .= '<td valing="top">'.$vehicle_cat.'</td>';
                        $value .= '<td valing="top">'.$vehicle_subcat.'</td>';
                        $value .= '<td valing="top">'.$speed_limit.'</td>';
                        $value .= '<td valing="top">'.$vehicle_fleet.'</td>';
                        $value .= '<td valing="top">'.$rvrd_firstropregdate.'</td>';
                        $value .= '<td valing="top">'.$rvrd_modelyear.'</td>';
                        $value .= '<td valing="top" class="date">'.$installtion.'</td>';
                        $value .= '<td valing="top">'.$installtionTime.'</td>';
                        $value .= '<td valing="top">'.$inspectorname.'</td>';
                        $value .= '<td valing="top">'.$verificationCode.'</td>';
                        $value .= '<td valing="top" class="date">'.$dateOfExpiry.'</td>';
                        $value .= '<td valing="top">'.$statusText.'</td>';
                        $value .= '</tr>';   
                }
            $value .= '</table>';
            $data1= trim($value) . "\n";
            if(!empty($data1) && !empty($exeFileName)){
                $filename=$exeFileName.'.xls';
                $zip->addFromString($filename,$data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__).'/../web/exports/invice/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/royalty-fee/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    //  export 
    public function actionExportTechdata(){
        
        $params = Yii::$app->request->post();
        $response = [];
        $showColumn = $params['showCol'];
        $params['excel']= true;
        $data = RoyaltyandasmtfeeTbl::techRoyaltyListingQuery($params);
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Royalty_Tech_'.$time;        
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Technical Inspection Centre</span></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';

            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:\"\@\";} .invoice_month{mso-number-format:"mmmm yyyy";}</style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ?'<th>Invoice Number</th>':'';
                $value .= (in_array('companyname',$showColumn)) ?'<th>Company Name</th>':'';
                $value .= (in_array('centrename',$showColumn)) ?'<th>Centre Name</th>':'';
                $value .= (in_array('officetype',$showColumn)) ?'<th>Office Type</th>':'';
                $value .= (in_array('branchname',$showColumn)) ?'<th>Branch Name</th>':'';
                $value .= (in_array('locate',$showColumn)) ?'<th>Site Location</th>':'';
                $value .= (in_array('opalmember',$showColumn)) ?'<th>OPAL Membership Number</th>':'';
                $value .= (in_array('projectname',$showColumn)) ?'<th>Project</th>':'';
                $value .= (in_array('invoicemonth',$showColumn)) ?'<th>Invoice For The Month</th>':'';
                $value .= (in_array('totalVehicle',$showColumn)) ?'<th>Total Vehicle</th>':'';
                $value .= (in_array('invoiceamount',$showColumn)) ?'<th>Invoice Amount (OMR)</th>':'';
                $value .= (in_array('paymentstatus',$showColumn)) ?'<th>Status</th>':'';
                $value .= (in_array('invoicedate',$showColumn)) ?'<th>Invoice Date</th>':'';
                $value .= (in_array('invoiceage',$showColumn)) ?'<th>Invoice Age</th>':'';
                $value .= (in_array('genratedon',$showColumn)) ?'<th>Generated On</th>':'';
                $value .= (in_array('genratedby',$showColumn)) ?'<th>Generated By</th>':'';
                $value .= (in_array('paymentdate',$showColumn)) ?'<th>Payment Date</th>':'';
                $value .= (in_array('lastupdate',$showColumn)) ?'<th>Last Updated On</th>':'';
                $value .= (in_array('lastupdateby',$showColumn)) ?'<th>Last Updated By</th>':'';
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){

                            //Branch Name.
                            $brName = "-";
                            if($attend['officetype'] == 'Branch Office'){
                                $brName = $attend['branchname_en'];
                            }

                            //Course Title.
                            $curTle = "-";
                            $curcat = "-";
                            if(!empty($attend['appcdt_standardcoursemst_fk'])){
                                $curTle = $attend['scm_coursename_en'];
                                // $curcat = $attend['catstden'];
                            }elseif(!empty($attend['appcdt_appoffercoursemain_fk'])){
                                $curTle = $attend['appocm_coursename_en'];
                                // $curcat = $attend['catofren'];
                            }

                            //Status.
                            $status = "-";
                            if($attend['paymentstatus'] == '1'){
                                $status = "Pending";
                            }elseif($attend['paymentstatus'] == '2'){
                                $status = "Paid - Confirmation Pending";
                            }elseif($attend['paymentstatus'] == '3'){
                                $status = "Overdue";
                            }elseif($attend['paymentstatus'] == '4'){
                                $status = "Received";
                            }elseif($attend['paymentstatus'] == '5'){
                                $status = "Not Received";
                            }

                            $age = "-";
                            if(!empty($attend["invoiceage"])){
                                if($attend['paymentstatus'] != '2' || $attend['paymentstatus'] != '4'){
                                    $age = $attend["invoiceage"]." days";
                                }
                            }
                            $trainingprovider_en =!empty($attend["trainingprovider_en"])?$attend["trainingprovider_en"]:'-';
                            $amount = ($attend["invoiceamount"]?number_format($attend["invoiceamount"],3)." OMR":"-");
                            $site = empty($attend['city_en']) && empty($attend['state_en'])?"-":$attend['state_en'].", ".$attend['city_en'];
                            
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ?'<td valing="top">'.($attend["invoiceno"]??"-").'</td>':'';
                            $value .= (in_array('companyname',$showColumn)) ?'<td valing="top">'.($attend["companyname_en"]??"-").'</td>':"";
                            $value .= (in_array('centrename',$showColumn)) ?'<td valing="top">'.($trainingprovider_en).'</td>':"";
                            $value .= (in_array('officetype',$showColumn)) ?'<td valing="top">'.($attend["officetype"]??"-").'</td>':"";
                            $value .= (in_array('branchname',$showColumn)) ?'<td valing="top">'.(string)$brName.'</td>':"";
                            $value .= (in_array('locate',$showColumn)) ?'<td valing="top">'.$site.'</td>':"";
                            $value .= (in_array('opalmember',$showColumn)) ?'<td valing="top">'.($attend["opalmember"]??"-").'</td>':"";
                            $value .= (in_array('projectname',$showColumn)) ?'<td valing="top">'.($attend["pm_projectname_en"]??"-").'</td>':"";
                            $value .= (in_array('invoicemonth',$showColumn)) ?'<td valing="top" class="invoice_month">'.($attend["invoicemonth"]??"-").'</td>':"";
                            $value .= (in_array('totalVehicle',$showColumn)) ?'<td valing="top">'.($attend["totalVehicle"]??"-").'</td>':"";
                            $value .= (in_array('invoiceamount',$showColumn)) ?'<td valing="top">'.(string)$amount.'</td>':"";
                            $value .= (in_array('paymentstatus',$showColumn)) ?'<td valing="top">'.(string)$status.'</td>':"";
                            $value .= (in_array('invoicedate',$showColumn)) ?'<td valing="top">'.($attend["invoicedate"]??"-").'</td>':"";
                            $value .= (in_array('invoiceage',$showColumn)) ?'<td valing="top">'.($age).'</td>':"";
                            $value .= (in_array('genratedon',$showColumn)) ?'<td valing="top">'.($attend["genratedon"]?$attend["genratedon"]:"-").'</td>':"";
                            $value .= (in_array('genratedby',$showColumn)) ?'<td valing="top">'.($attend["genratedby"]?$attend["genratedby"]:"-").'</td>':"";
                            $value .= (in_array('paymentdate',$showColumn)) ?'<td valing="top">'.($attend["paymentdate"]??"-").'</td>':"";
                            $value .= (in_array('lastupdate',$showColumn)) ?'<td valing="top">'.($attend["lastupdate"]?$attend["lastupdate"]:"-").'</td>':"";
                            $value .= (in_array('lastupdateby',$showColumn)) ?'<td valing="top">'.($attend["lastupdateby"]?$attend["lastupdateby"]:"-").'</td>':"";
                        $value .= '</tr>';  
                    }
                $value .= '</table>';
            }
            $data1= trim($value) . "\n";
            if(!empty($data1) && !empty($exeFileName)){
                $filename=$exeFileName.'.xls';
                $zip->addFromString($filename,$data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__).'/../web/exports/invice/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/royalty-fee/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    public function actionExportTechIvms(){
        
        $params = Yii::$app->request->post();
        $response = [];
        $showColumn = $params['showCol'];
        $params['excel']= true;
        $data = RoyaltyandasmtfeeTbl::techRoyaltyListingQuery($params);
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Royalty_ivms_'.$time;        
        $trackpk = '';
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Technical Installation Centre</span></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';

            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:\"\@\";} .invoice_month{mso-number-format:"mmmm yyyy";}</style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ?'<th>Invoice Number</th>':'';
                $value .= (in_array('companyname',$showColumn)) ?'<th>Company Name</th>':'';
                $value .= (in_array('centrename',$showColumn)) ?'<th>Centre Name</th>':'';
                $value .= (in_array('officetype',$showColumn)) ?'<th>Office Type</th>':'';
                $value .= (in_array('branchname',$showColumn)) ?'<th>Branch Name</th>':'';
                $value .= (in_array('locate',$showColumn)) ?'<th>Site Location</th>':'';
                $value .= (in_array('opalmember',$showColumn)) ?'<th>OPAL Membership Number</th>':'';
                $value .= (in_array('projectname',$showColumn)) ?'<th>Project</th>':'';
                $value .= (in_array('invoicemonth',$showColumn)) ?'<th>Invoice For The Month</th>':'';
                $value .= (in_array('totalVehicle',$showColumn)) ?'<th>Total Vehicle</th>':'';
                $value .= (in_array('invoiceamount',$showColumn)) ?'<th>Invoice Amount (OMR)</th>':'';
                $value .= (in_array('paymentstatus',$showColumn)) ?'<th>Status</th>':'';
                $value .= (in_array('invoicedate',$showColumn)) ?'<th>Invoice Date</th>':'';
                $value .= (in_array('invoiceage',$showColumn)) ?'<th>Invoice Age</th>':'';
                $value .= (in_array('genratedon',$showColumn)) ?'<th>Generated On</th>':'';
                $value .= (in_array('genratedby',$showColumn)) ?'<th>Generated By</th>':'';
                $value .= (in_array('paymentdate',$showColumn)) ?'<th>Payment Date</th>':'';
                $value .= (in_array('lastupdate',$showColumn)) ?'<th>Last Updated On</th>':'';
                $value .= (in_array('lastupdateby',$showColumn)) ?'<th>Last Updated By</th>':'';
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){

                            //Branch Name.
                            $brName = "-";
                            if($attend['officetype'] == 'Branch Office'){
                                $brName = $attend['branchname_en'];
                            }

                            //Course Title.
                            $curTle = "-";
                            $curcat = "-";
                            if(!empty($attend['appcdt_standardcoursemst_fk'])){
                                $curTle = $attend['scm_coursename_en'];
                                // $curcat = $attend['catstden'];
                            }elseif(!empty($attend['appcdt_appoffercoursemain_fk'])){
                                $curTle = $attend['appocm_coursename_en'];
                                // $curcat = $attend['catofren'];
                            }

                            //Status.
                            $status = "-";
                            if($attend['paymentstatus'] == '1'){
                                $status = "Pending";
                            }elseif($attend['paymentstatus'] == '2'){
                                $status = "Paid - Confirmation Pending";
                            }elseif($attend['paymentstatus'] == '3'){
                                $status = "Overdue";
                            }elseif($attend['paymentstatus'] == '4'){
                                $status = "Received";
                            }elseif($attend['paymentstatus'] == '5'){
                                $status = "Not Received";
                            }

                            $age = "-";
                            if(!empty($attend["invoiceage"])){
                                if($attend['paymentstatus'] != '2' || $attend['paymentstatus'] != '4'){
                                    $age = $attend["invoiceage"]." days";
                                }
                            }
                            $trainingprovider_en =!empty($attend["trainingprovider_en"])?$attend["trainingprovider_en"]:'-';
                            $amount = ($attend["invoiceamount"]?number_format($attend["invoiceamount"],3)." OMR":"-");
                            $site = empty($attend['city_en']) && empty($attend['state_en'])?"-":$attend['state_en'].", ".$attend['city_en'];
                            
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ?'<td valing="top">'.($attend["invoiceno"]??"-").'</td>':'';
                            $value .= (in_array('companyname',$showColumn)) ?'<td valing="top">'.($attend["companyname_en"]??"-").'</td>':"";
                            $value .= (in_array('centrename',$showColumn)) ?'<td valing="top">'.($trainingprovider_en).'</td>':"";
                            $value .= (in_array('officetype',$showColumn)) ?'<td valing="top">'.($attend["officetype"]??"-").'</td>':"";
                            $value .= (in_array('branchname',$showColumn)) ?'<td valing="top">'.(string)$brName.'</td>':"";
                            $value .= (in_array('locate',$showColumn)) ?'<td valing="top">'.$site.'</td>':"";
                            $value .= (in_array('opalmember',$showColumn)) ?'<td valing="top">'.($attend["opalmember"]??"-").'</td>':"";
                            $value .= (in_array('projectname',$showColumn)) ?'<td valing="top">'.($attend["pm_projectname_en"]??"-").'</td>':"";
                            $value .= (in_array('invoicemonth',$showColumn)) ?'<td valing="top" class="invoice_month">'.($attend["invoicemonth"]??"-").'</td>':"";
                            $value .= (in_array('totalVehicle',$showColumn)) ?'<td valing="top">'.($attend["totalVehicle"]??"-").'</td>':"";
                            $value .= (in_array('invoiceamount',$showColumn)) ?'<td valing="top">'.(string)$amount.'</td>':"";
                            $value .= (in_array('paymentstatus',$showColumn)) ?'<td valing="top">'.(string)$status.'</td>':"";
                            $value .= (in_array('invoicedate',$showColumn)) ?'<td valing="top">'.($attend["invoicedate"]??"-").'</td>':"";
                            $value .= (in_array('invoiceage',$showColumn)) ?'<td valing="top">'.($age).'</td>':"";
                            $value .= (in_array('genratedon',$showColumn)) ?'<td valing="top">'.($attend["genratedon"]?$attend["genratedon"]:"-").'</td>':"";
                            $value .= (in_array('genratedby',$showColumn)) ?'<td valing="top">'.($attend["genratedby"]?$attend["genratedby"]:"-").'</td>':"";
                            $value .= (in_array('paymentdate',$showColumn)) ?'<td valing="top">'.($attend["paymentdate"]??"-").'</td>':"";
                            $value .= (in_array('lastupdate',$showColumn)) ?'<td valing="top">'.($attend["lastupdate"]?$attend["lastupdate"]:"-").'</td>':"";
                            $value .= (in_array('lastupdateby',$showColumn)) ?'<td valing="top">'.($attend["lastupdateby"]?$attend["lastupdateby"]:"-").'</td>':"";
                        $value .= '</tr>';  
                    }
                $value .= '</table>';
            }
            $data1= trim($value) . "\n";
            if(!empty($data1) && !empty($exeFileName)){
                $filename=$exeFileName.'.xls';
                $zip->addFromString($filename,$data1);
            }
            $zip->close();
            $zipfilename = $exeFileName . '.zip';
            $zipfilepath = dirname(__FILE__).'/../web/exports/invice/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/royalty-fee/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }
}
