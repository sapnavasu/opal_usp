<?php

namespace api\modules\im\controllers;

use Yii;
use yii\rest\Controller;
use app\models\ApppytminvoicedtlsTbl;


class CenterCertificationController extends Controller
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
     * Handle the Center Certification listing
     *
     * Request: POST/getcentercertidtls
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionGetcentercertidtls()
    {
        $request = Yii::$app->request->post();

        $data = ApppytminvoicedtlsTbl::getInvCenterCertiDtls($request);
        $data['status'] = true;
        
        return $this->asJson($data);

    }

    /**
     * Handle the Technical Evalution Certification listing
     */
    public function actionGettechnicalcentercertidtls()
    {
        $request = Yii::$app->request->post();

        $data = ApppytminvoicedtlsTbl::getTechnicalCenterCertiDtls($request);
        $data['status'] = true;
        
        return $this->asJson($data);

    }

    public function actionGettechnicalIvms()
    {
        $request = Yii::$app->request->post();

        $data = ApppytminvoicedtlsTbl::getTechnicalIvms($request);
        $data['status'] = true;
        
        return $this->asJson($data);

    }

    /**
     * Handle the view part of Training Evalution
     */
    public function actionGettraingcenterdtls(){
        $id = $_GET['id'];
        $centertraingdata = ApppytminvoicedtlsTbl::getTraingCenterDtl($id);
        $centertraingdata['status'] = true;
        
        return $this->asJson($centertraingdata);
    }

    /**
     * Handle the view part of Technical Evalution
     */
    public function actionViewtechnicalcenterdtls(){
        $id = $_GET['id'];
        $centertraingdata = ApppytminvoicedtlsTbl::getTraingCenterDtl($id);
        $centertraingdata['status'] = true;
        
        return $this->asJson($centertraingdata);
    }

    public function actionViewtechnicalIvms(){
        $id = $_GET['id'];
        $centertraingdata = ApppytminvoicedtlsTbl::viewTechnicalIvms($id);
        $centertraingdata['status'] = true;
        
        return $this->asJson($centertraingdata);
    }

    /**
     * Handle the export functionality of training Evalution listing
     */
    public function actionExporttrainingdata(){
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formdata['excel'] = 1;
        $response = [];
        $showColumn = $formdata['showColumn'];
        $data = \app\models\ApppytminvoicedtlsTbl::getInvCenterCertiDtls($formdata);
        
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='TrainingCentreInvoice_'.$time;        
        $trackpk = '';
        // $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($date);
        $dateString = date("d F, Y - h:i A", $timestamp);
        // $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            // $value .= '<table><tr ><td colspan="10" rowspan="5" align="center"><img style="height:130px" alt="rabt_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/excelheader.png"></td></tr></table>';   
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Training Evaluation Centre</span></td></tr></table>';   
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:\"\@\";} .date{mso-number-format:"dd-mm-yyyy";}</style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ? '<th>Invoice Number</th>' : '';
                $value .= (in_array('compannyname',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('trainingprovider',$showColumn)) ? '<th>Training Provider Name</th>' : '';
                $value .= (in_array('officetype',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('branchname',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('opalmember',$showColumn)) ? '<th>OPAL Membership Number</th>' : '';
                $value .= (in_array('Feetype',$showColumn)) ? '<th>Fee Type</th>' : '';
                // $value .= '<th>No. of staff Evaluated</th>';
                $value .= (in_array('invoiceamount',$showColumn)) ? '<th>Invoice Amount (OMR)</th>' : '';
                $value .= (in_array('paymentstatus',$showColumn)) ? '<th>Status</th>' : '';
                $value .= (in_array('paymenttype',$showColumn)) ? '<th>Payment Type</th>' : '';
                $value .= (in_array('invoicedate',$showColumn)) ? '<th>Invoice Date</th>' : '';
                $value .= (in_array('invoiceage',$showColumn)) ? '<th>Invoice Age</th>' : '';
                $value .= (in_array('paymentdate',$showColumn)) ? '<th>Payment Date</th>' : '';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){

                            //Payment Type
                            $agedate = "";
                            if($attend['apid_invoicestatus'] == '1'){
                                $agedate = $attend["agedate"];
                            }elseif($attend['apid_invoicestatus'] == '4'){
                                $agedate = $attend["agedate"];
                            }

                            $amtVal = number_format((float)$attend["total"], 3, '.', '');
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_invoiceno"] ? $attend["apid_invoiceno"] : "-").'</td>' : '';
                            $value .= (in_array('compannyname',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_companyname_en"] ? $attend["omrm_companyname_en"] : "-").'</td>' : '';
                            $value .= (in_array('trainingprovider',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_tpname_en"] ? $attend["omrm_tpname_en"] : "-").'</td>' : '';
                            // $value .= '<td valing="top">'.(string)$attend["pm_projectname_en"].'</td>';
                            $value .= (in_array('officetype',$showColumn)) ? '<td valing="top">'.(string)($attend["appiim_officetype"] ? $attend["appiim_officetype"] : "-").'</td>' : '';
                            $value .= (in_array('branchname',$showColumn)) ? '<td valing="top">'.(string)($attend["appiim_branchname_en"] ? $attend["appiim_branchname_en"] : "-").'</td>' : '';
                            $value .= (in_array('opalmember',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_opalmembershipregnumber"] ? $attend["omrm_opalmembershipregnumber"] : "-").'</td>' : '';
                            $value .= (in_array('Feetype',$showColumn)) ? '<td valing="top">'.(string)($attend["fsm_feestype"] ? $attend["fsm_feestype"] : "-").(string)$attend["fsm_applicationtype"].'</td>' : '';
                            $value .= (in_array('invoiceamount',$showColumn)) ? '<td valing="top">'.$amtVal.' &nbsp</td>' : '';
                            $value .= (in_array('paymentstatus',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_invoicestatus"] ? $attend["apid_invoicestatus"] : "-").'</td>' : '';
                            $value .= (in_array('paymenttype',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_paymenttype"] ? $attend["apid_paymenttype"] : "-").'</td>' : '';
                            $value .= (in_array('invoicedate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["invdate"] ? $attend["invdate"] : "-").'</td>' : '';
                            $value .= (in_array('invoiceage',$showColumn)) ? '<td valing="top">'.(string)($attend["agedate"] ? $attend["agedate"] : "-").'</td>' : '';
                            $value .= (in_array('paymentdate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["pymtdate"] ? $attend["pymtdate"] : "-").'</td>' : '';
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
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/center-certification/downloadtrainingdata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        
        return $this->asJson($response);
    }

    /**
     * Handle the export functionality of Technical Evalution listing
     */
    public function actionExporttechnicaldata(){
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $showColumn = $formdata['showColumn'];
        // echo'<pre>';print_r($formdata['showColumn']);die('test');

        $formdata['excel'] = 1;
        $response = [];
        $data = \app\models\ApppytminvoicedtlsTbl::getTechnicalCenterCertiDtls($formdata);
        
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='TechnicalCentreInvoice_'.$time;        
        $trackpk = '';
        // $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($date);
        $dateString = date("d F, Y - h:i A", $timestamp);
        // $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Technical Evaluation Centre</span></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table><tr><td></td></tr></table>';  

            if(!empty($showColumn)){

                $value .= '<style>.text{mso-number-format:\"\@\";} .date{mso-number-format:"dd-mm-yyyy";}</style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ? '<th>Invoice Number</th>' : '';
                $value .= (in_array('compannyname',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('trainingprovider',$showColumn)) ? '<th>Training Provider Name</th>' : '';
                $value .= (in_array('officetype',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('branchname',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('opalmember',$showColumn)) ? '<th>OPAL Membership Number</th>' : '';
                $value .= (in_array('Feetype',$showColumn)) ? '<th>Fee Type</th>' : '';
                // $value .= '<th>No. of staff Evaluated</th>';
                $value .= (in_array('invoiceamount',$showColumn)) ? '<th>Invoice Amount (OMR)</th>' : '';
                $value .= (in_array('paymentstatus',$showColumn)) ? '<th>Status</th>' : '';
                $value .= (in_array('paymenttype',$showColumn)) ? '<th>Payment Type</th>' : '';
                $value .= (in_array('invoicedate',$showColumn)) ? '<th>Invoice Date</th>' : '';
                $value .= (in_array('invoiceage',$showColumn)) ? '<th>Invoice Age</th>' : '';
                $value .= (in_array('paymentdate',$showColumn)) ? '<th>Payment Date</th>' : '';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){
                            
                            //Payment Type
                            $agedate = "";
                            if($attend['apid_invoicestatus'] == '1'){
                                $agedate = $attend["agedate"];
                            }elseif($attend['apid_invoicestatus'] == '4'){
                                $agedate = $attend["agedate"];
                            }

                            $amtVal = number_format((float)$attend["total"], 3, '.', '');
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_invoiceno"] ? $attend["apid_invoiceno"] : "-").'</td>' : '';
                            $value .= (in_array('compannyname',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_companyname_en"] ? $attend["omrm_companyname_en"] : "-").'</td>' : '';
                            $value .= (in_array('trainingprovider',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_tpname_en"] ? $attend["omrm_tpname_en"] : "-").'</td>' : '';
                            $value .= (in_array('officetype',$showColumn)) ? '<td valing="top">'.(string)($attend["appiim_officetype"] ? $attend["appiim_officetype"] : "-").'</td>' : '';
                            $value .= (in_array('branchname',$showColumn)) ? '<td valing="top">'.(string)($attend["appiim_branchname_en"] ? $attend["appiim_branchname_en"] : "-").'</td>' : '';
                            $value .= (in_array('opalmember',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_opalmembershipregnumber"] ? $attend["omrm_opalmembershipregnumber"] : "-").'</td>' : '';
                            $value .= (in_array('Feetype',$showColumn)) ? '<td valing="top">'.(string)$attend["fsm_feestype"].(string)$attend["fsm_applicationtype"].'</td>' : '';
                            $value .= (in_array('invoiceamount',$showColumn)) ? '<td valing="top">'.(string)($attend["total"] ? $amtVal : "-").' &nbsp</td>' : '';
                            $value .= (in_array('paymentstatus',$showColumn)) ? '<td valing="top">'.(string)$attend["apid_invoicestatus"].'</td>' : '';
                            $value .= (in_array('paymenttype',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_paymenttype"] ? $attend["apid_paymenttype"] : "-").'</td>' : '';
                            $value .= (in_array('invoicedate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["invdate"] ? $attend["invdate"] : "-").'</td>' : '';
                            $value .= (in_array('invoiceage',$showColumn)) ? '<td valing="top">'.(string)($attend["agedate"] ?$attend["agedate"] : "-").'</td>' : '';
                            $value .= (in_array('paymentdate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["pymtdate"] ? $attend["pymtdate"] : "-").'</td>' : '';
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
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/center-certification/downloadtrainingdata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        
        return $this->asJson($response);
    }

    public function actionExporttechnicalIvms(){
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $showColumn = $formdata['showColumn'];
        // echo'<pre>';print_r($formdata['showColumn']);die('test');

        $formdata['excel'] = 1;
        $response = [];
        $data = \app\models\ApppytminvoicedtlsTbl::getTechnicalIvms($formdata);
        
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder = $srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='TechnicalInstallation_'.$time;        
        $trackpk = '';
        // $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($date);
        $dateString = date("d F, Y - h:i A", $timestamp);
        // $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            //style="mso-number-format:'.$dateformat.'"
            $value = '';
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Technical Evaluation Centre</span></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table><tr><td></td></tr></table>';  

            if(!empty($showColumn)){

                $value .= '<style>.text{mso-number-format:\"\@\";} .date{mso-number-format:"dd-mm-yyyy";}</style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ? '<th>Invoice Number</th>' : '';
                $value .= (in_array('compannyname',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('trainingprovider',$showColumn)) ? '<th>Training Provider Name</th>' : '';
                $value .= (in_array('modelno',$showColumn)) ? '<th>Device Model Number</th>' : '';
                $value .= (in_array('officetype',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('branchname',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('opalmember',$showColumn)) ? '<th>OPAL Membership Number</th>' : '';
                $value .= (in_array('Feetype',$showColumn)) ? '<th>Fee Type</th>' : '';
                // $value .= '<th>No. of staff Evaluated</th>';
                $value .= (in_array('invoiceamount',$showColumn)) ? '<th>Invoice Amount (OMR)</th>' : '';
                $value .= (in_array('paymentstatus',$showColumn)) ? '<th>Status</th>' : '';
                $value .= (in_array('paymenttype',$showColumn)) ? '<th>Payment Type</th>' : '';
                $value .= (in_array('invoicedate',$showColumn)) ? '<th>Invoice Date</th>' : '';
                $value .= (in_array('invoiceage',$showColumn)) ? '<th>Invoice Age</th>' : '';
                $value .= (in_array('paymentdate',$showColumn)) ? '<th>Payment Date</th>' : '';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){
                            
                            //Payment Type
                            $agedate = "";
                            if($attend['apid_invoicestatus'] == '1'){
                                $agedate = $attend["agedate"];
                            }elseif($attend['apid_invoicestatus'] == '4'){
                                $agedate = $attend["agedate"];
                            }

                            $amtVal = number_format((float)$attend["total"], 3, '.', '');
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_invoiceno"] ? $attend["apid_invoiceno"] : "-").'</td>' : '';
                            $value .= (in_array('compannyname',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_companyname_en"] ? $attend["omrm_companyname_en"] : "-").'</td>' : '';
                            $value .= (in_array('trainingprovider',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_tpname_en"] ? $attend["omrm_tpname_en"] : "-").'</td>' : '';
                            $value .= (in_array('modelno',$showColumn)) ? '<td valing="top">'.(string)($attend["modelno"] ? $attend["modelno"] : "-").'</td>' : '';
                            $value .= (in_array('officetype',$showColumn)) ? '<td valing="top">'.(string)($attend["appiim_officetype"] ? $attend["appiim_officetype"] : "-").'</td>' : '';
                            $value .= (in_array('branchname',$showColumn)) ? '<td valing="top">'.(string)($attend["appiim_branchname_en"] ? $attend["appiim_branchname_en"] : "-").'</td>' : '';
                            $value .= (in_array('opalmember',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_opalmembershipregnumber"] ? $attend["omrm_opalmembershipregnumber"] : "-").'</td>' : '';
                            $value .= (in_array('Feetype',$showColumn)) ? '<td valing="top">'.(string)$attend["fsm_feestype"].(string)$attend["fsm_applicationtype"].'</td>' : '';
                            $value .= (in_array('invoiceamount',$showColumn)) ? '<td valing="top">'.(string)($attend["total"] ? $amtVal : "-").' &nbsp</td>' : '';
                            $value .= (in_array('paymentstatus',$showColumn)) ? '<td valing="top">'.(string)$attend["apid_invoicestatus"].'</td>' : '';
                            $value .= (in_array('paymenttype',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_paymenttype"] ? $attend["apid_paymenttype"] : "-").'</td>' : '';
                            $value .= (in_array('invoicedate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["invdate"] ? $attend["invdate"] : "-").'</td>' : '';
                            $value .= (in_array('invoiceage',$showColumn)) ? '<td valing="top">'.(string)($attend["agedate"] ?$attend["agedate"] : "-").'</td>' : '';
                            $value .= (in_array('paymentdate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["pymtdate"] ? $attend["pymtdate"] : "-").'</td>' : '';
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
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/center-certification/downloadtrainingdata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        
        return $this->asJson($response);
    }
    /**
     * Handle the exported download link
     */
    public function actionDownloadtrainingdata(){
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
}
