<?php

namespace api\modules\im\controllers;

use Yii;
use yii\rest\Controller;
use app\models\RoyaltyandasmtfeeTbl;
use app\models\RoyaltyandasmtfeehstyTbl;
use common\components\Security;
use yii\db\ActiveRecord;

class AssessmentFeeController extends Controller
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
     * Request: GET/assessmentfeelist
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionAssessmentfeelist()
    {
        $response = [];
        $params = Yii::$app->request->post();
        $data = RoyaltyandasmtfeeTbl::getAssesmentFeeQuery($params);
        return $data;

    }

    public static function actionAssessmentfeeView($asmnt_pk) {
        
        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $asmnt_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';
            $paidTo = 'rasf_paidto';
            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $appdecon = 'rasfh_appdecon';
            $appdecComments =  'rasfh_appdecComments';
            $appdecby = 'rasfh_appdecby';
            $paidTo = 'rasfh_paidto';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');
 
        }

        $model = $model->select(["$invoiceno as invoiceno",
        // 'apcourdtlsTmp.appcoursedtlstmp_pk',
        "$royaltyandasmtfee_pk as asmnt_pk",
        'appcdt_standardcoursemst_fk',
        'opalmem.omrm_opalmembershipregnumber as opalmember',
        "DATE_FORMAT($raisedon,'%M %Y') as invoicemonth",
        // 'appcdt_appoffercoursemain_fk',
        'gov.osm_statename_en as state_en','gov.osm_statename_ar as state_ar',
        'city.ocim_cityname_en as city_en','city.ocim_cityname_ar as city_ar',
        'as_gov.osm_statename_en as as_state_en','as_gov.osm_statename_ar as as_state_ar',
        'as_city.ocim_cityname_en as as_city_en','as_city.ocim_cityname_ar as as_city_ar',
        "$pymtstatus as paymentstatus",
        '(CASE WHEN f.omrm_officetype = 1 THEN "Main Office" WHEN f.omrm_officetype = 2 THEN "Branch Office" ELSE "-" END) as assessorofficetype',
        'f.omrm_companyname_en as as_companyname_en','f.omrm_companyname_ar as as_companyname_ar',
        'f.omrm_branchname_en as as_branchname_en','f.omrm_branchname_ar as as_branchname_ar',
        'opalmem.omrm_companyname_en as companyname_en','opalmem.omrm_companyname_ar as companyname_ar',
        'opalmem.omrm_tpname_en as trainingprovider_en','opalmem.omrm_tpname_ar as trainingprovider_ar',
        'opalmem.omrm_branchname_en as branchname_en','opalmem.omrm_branchname_ar as branchname_ar',
        '(CASE WHEN appinsinfo.appiim_officetype = 1 THEN "Main Office" WHEN appinsinfo.appiim_officetype = 2 THEN "Branch Office" ELSE "-" END) as officetype',
        "$totrecord as totallearner",
        "$vatamount", "$invoicedamount",
        "(COALESCE($invoicedamount, 0) + COALESCE($vatamount, 0)) AS invoiceamount",
        "(CASE WHEN $pymtstatus != 2 AND $pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, $createdon) ELSE ' -' END) as invoiceage",
        "DATE_FORMAT($createdon, '%d-%m-%Y') as invoicedate",
        "DATE_FORMAT($dateofpymt,'%d-%m-%Y') as paymentdate",$pymtstatus,
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as rasf_appdecon","$appdecComments as rasf_appdecComments","$pymtstatus as rasf_pymtstatus",'oum_firstname as confirmedBy'
        ])
        ->leftJoin('appcoursedtlsmain_tbl apcourdtls',"apcourdtls.AppCourseDtlsMain_PK = $appcoursedtlsmain_fk")
        ->leftJoin('appcoursedtlstmp_tbl apcourdtlsTmp','apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK')
        ->leftJoin('standardcoursemst_tbl stdcour','stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK')
        ->leftJoin('appinstinfomain_tbl appinsinfo','appinsinfo.appinstinfomain_pk = apcourdtls.appcdm_appinstinfomain_fk')
        ->leftJoin('appoffercoursemain_tbl appoffer','appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk')
        ->leftJoin('coursecategorymst_tbl courcatstd','courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk')
        ->leftJoin('coursecategorymst_tbl courcatofr','courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")
        ->leftJoin('opalmemberregmst_tbl f', "f.opalmemberregmst_pk = $paidTo")
        ->leftJoin('opalstatemst_tbl as_gov','as_gov.opalstatemst_pk = f.omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl as_city','as_city.opalcitymst_pk = f.omrm_opalcitymst_fk')
        ->andWhere([$royaltyandasmtfee_pk => $asmnt_pk, $feetype => 2])
        ->asArray()->one();
    //    echo $model->createCommand()->rawSql; die;
        
        // if(!empty($model)){
        //     //$resAry=$dataInfo;
        //     $modelcat = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk =:cour", [':cour' => $model['appcoursedtlstmp_pk']])->all();
        //     //$modelcat = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk =:cour", [':cour' => 29])->all();
        //     $carArrayen=$carArrayar=array();
        //     foreach($modelcat as $modelcatInfo){
        //         $modelcatname = CoursecategorymstTbl::find()->where("coursecategorymst_pk =:courcat", [':courcat' => $modelcatInfo->appctt_coursecategorymst_fk])->one();
        //         $carArrayen[]=$modelcatname->ccm_catname_en;
        //         $carArrayar[]=$modelcatname->ccm_catname_ar;
        //     }
        //     $model['subcaten']= implode(",",$carArrayen);
        //     $model['subcatar']= implode(",",$carArrayar);
        //     //$finalAry[]=$model;
        // }
            
        $response['data'] = $model; 
        return $response;
    }

    //add Comment
   public static function actionPaymentComment() 
   {
    
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $response['status'] = false; 
        $params = Yii::$app->request->post();
        if(!isset($params['asmnt_pk'])){
            return $response;
        }
        $model = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=>$params['asmnt_pk']])->one();

        if($model){
            $model->rasf_appdecon = date('Y-m-d H:i:s');
            $model->rasf_appdecby = $userPk;
            $model->rasf_pymtstatus = $params['rasf_pymtstatus'];
            $model->rasf_appdecComments = $params['rasf_appdecComments'];
            $model->save();
            $response['status'] = true; 
            $response['data'] = $model; 
        }
        return $response;
   }

    public function actionExportassessmentdata(){
            
        $formdata = Yii::$app->request->post();
        $showColumn = $formdata['showCol'];
        $response = [];
        $formdata['excel'] =1;
        $data = RoyaltyandasmtfeeTbl::getAssesmentFeeQuery($formdata);
        // echo'<pre>';print_r($data);die('test');
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='AssessmentFee_'.$time;        
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
            $value .= '<table><tr><td colspan="1" rowspan="5" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td><td colspan="3" rowspan="5" align="center"><span style="font-size: 30px;">Assessment Fee</span></td></tr></table>';   
            $value .= '<table><tr><td></td></tr></table>'; 
            $value .= '<table><tr><td></td></tr></table>';  
            $value .= '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table><tr><td></td></tr></table>';  
            
            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:\"\@\";} .invoice_month{mso-number-format:"mmmm yyyy";}</style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('invoiceno',$showColumn)) ?'<th>Invoice Number</th>':"";
                $value .= (in_array('trainingprovider',$showColumn)) ?'<th>Training Provider Name</th>':"";
                $value .= (in_array('officetype',$showColumn)) ?'<th>Training Centre Office Type</th>':"";
                $value .= (in_array('branchname',$showColumn)) ?'<th>Training Centre Branch Name</th>':"";
                $value .= (in_array('centrelocat',$showColumn)) ?'<th>Training Centre Location</th>':"";
                $value .= (in_array('assessmentcentre',$showColumn)) ?'<th>Assessment Centre</th>':"";
                $value .= (in_array('invoicemonth',$showColumn)) ?'<th>Invoice for the month</th>':"";
                $value .= (in_array('totallearner',$showColumn)) ?'<th>Total Learners</th>':"";
                $value .= (in_array('invoiceamount',$showColumn)) ?'<th>Invoice Amount (OMR)</th>':"";
                $value .= (in_array('paymentstatus',$showColumn)) ?'<th>Status</th>':"";
                $value .= (in_array('invoicedate',$showColumn)) ?'<th>Invoice Date</th>':"";
                $value .= (in_array('genratedon',$showColumn)) ?'<th>Generated On</th>':'';
                $value .= (in_array('genratedby',$showColumn)) ?'<th>Generated By</th>':'';
                $value .= (in_array('lastupdate',$showColumn)) ?'<th>Last Updated On</th>':'';
                $value .= (in_array('lastupdateby',$showColumn)) ?'<th>Last Updated By</th>':'';
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){
                            $invoiceamount = (string) number_format((float)$attend["invoiceamount"], 3, '.', '')." ";
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
                            $amount = ($attend["invoiceamount"]?number_format($attend["invoiceamount"],3)." OMR":"-");
                           
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('invoiceno',$showColumn)) ?'<td valing="top">'.(string)($attend["invoiceno"] ? $attend["invoiceno"] : '-').'</td>':"";
                            $value .= (in_array('trainingprovider',$showColumn)) ?'<td valing="top">'.(string)($attend["trainingprovider_en"] ? $attend["trainingprovider_en"] : '-').'</td>':"";
                            $value .= (in_array('officetype',$showColumn)) ?'<td valing="top">'.(string)($attend["officetype"] ? $attend["officetype"] : '-' ).'</td>':"";
                            $value .= (in_array('branchname',$showColumn)) ?'<td valing="top">'.(string)($attend["branchname_en"] ? $attend["branchname_en"] : '-').'</td>':"";
                            $value .= (in_array('centrelocat',$showColumn)) ?'<td valing="top">'.(string)$attend["state_en"].','.(string)$attend["city_en"].'</td>':"";
                            $value .= (in_array('assessmentcentre',$showColumn)) ?'<td valing="top">'.(string)($attend["as_companyname_en"] ? $attend["as_companyname_en"] : '-').'</td>':"";
                            $value .= (in_array('invoicemonth',$showColumn)) ?'<td valing="top" class="invoice_month">'.(string)($attend["invoicemonth"] ? $attend["invoicemonth"] : '-').'</td>':"";
                            $value .= (in_array('totallearner',$showColumn)) ?'<td valing="top">'.(string)($attend["totallearner"] ? $attend["totallearner"] : '-').'</td>':"";
                            $value .= (in_array('invoiceamount',$showColumn)) ?'<td valing="top">'.(string)($amount).'</td>':"";
                            $value .= (in_array('paymentstatus',$showColumn)) ?'<td valing="top">'.(string)($status ? $status : '-').'</td>':"";
                            $value .= (in_array('invoicedate',$showColumn)) ?'<td valing="top">'.(string)($attend["invoicedate"] ? $attend["invoicedate"] : '-').'</td>':"";
                            $value .= (in_array('genratedon',$showColumn)) ?'<td valing="top">'.($attend["genratedon"]?$attend["genratedon"]:"-").'</td>':"";
                            $value .= (in_array('genratedby',$showColumn)) ?'<td valing="top">'.($attend["genratedby"]?$attend["genratedby"]:"-").'</td>':"";
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
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/assessment-fee/downloadassesmentdata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        
        return $this->asJson($response);
    }

    public function actionDownloadassesmentdata(){
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

    public static function actionLearnerListing() 
    {
        Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $params = Yii::$app->request->post();
        $response = RoyaltyandasmtfeeTbl::batchLearnerListing($params);
        
        return $response;
    }
    public static function actionDownloadSingleAssessment($asmnt_pk)
    {
        // echo'<pre>';print_r($asmnt_pk);die('inital');
    //    $formdata['asmnt_pk'] = $asmnt_pk;
       $response = [];
       $data = RoyaltyandasmtfeeTbl::downloadSingleAssesmentRecord($asmnt_pk);
    //    echo'<pre>';print_r($data); die;
       $srcUrl = \Yii::$app->params['srcDirectory'];
       $folder=$srcUrl.'web/exports/invice/';
       if(!is_dir($folder)){
           mkdir($folder, 0777, true);
       }
       
       $date = date('Y-m-d H:i:s');
       $time = strtotime($date);
       $exeFileName='AssessmentFee_'.$asmnt_pk.'_'.$time;        
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
           $value .= '<table border="1">';
           $value .= '<tr><td colspan="1" style="font-weight:bold;"> Title </td><td colspan="1">Assessment Fee </td><td colspan="2" rowspan="6" align="center"><img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr>';
           $value .= '<tr><td colspan="1" style="font-weight:bold;"> Training Centre </td><td colspan="1"> '.$data['trainingprovider_en'].' </td></tr>';
           $value .= '<tr><td colspan="1" style="font-weight:bold;"> Office Type </td><td colspan="1"> '.($data['officetype'] ? $data['officetype'] : '-').' </td></tr>';
           $value .= '<tr><td colspan="1" style="font-weight:bold;"> Branch Name </td><td colspan="1"> '.($data['branchname_en'] ? $data['branchname_en'] : '-').' </td></tr>';
           $value .= '<tr><td colspan="1" style="font-weight:bold;"> Invoice Number </td><td colspan="1"> '.$data['invoiceno'].' </td></tr>';
           $value .= '<tr><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
           $value .= '<tr><td colspan="1"></td></tr>';
           $value .= '</table>';
           $value .= '<style> .text{mso-number-format:"\@";} .date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';



           $value .= '<tr style="background-color:#E7E7E7;height:40px">';
           $value .= '<th>Learner ID</th>';
           $value .= '<th>Learner Name</th>';
           $value .= "<th class='text'>Learner Number (Phone No)</th>";
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
        //    $value .= '<th>Office Type</th>';
        //    $value .= '<th>Branch Name</th>';
           $value .= '<th>Tutor(Teaching)</th>';
           $value .= '<th>Tutor(Practical)</th>';
           $value .= '<th>Assessment Centre</th>';
           $value .= '<th>Assessor</th>';
           $value .= '<th>IQA</th>';
           $value .= '<th>Verfication Number</th>';
       
           $value .= '</tr>';
               $i=1;
               foreach($data['batches'] as $attend){

                       //Payment Type
                       $payType = "";
                       if($attend['apid_paymenttype'] == '1'){
                           $payType = "Online";
                       }elseif($attend['apid_paymenttype'] == '2'){
                           $payType = "Offline";
                       }

                    $value .= '<tr>';
                    $value .= '<td valing="top">'.($attend["LearnerID"]?$attend["LearnerID"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["LearnerName"]?$attend["LearnerName"]:"-").'</td>';
                    $value .= '<td valing="top" class="text">'.((string) $attend["LearnerNumber"]).'</td>';
                    $value .= '<td valing="top">'.($attend["LearnerEmail"]?$attend["LearnerEmail"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["Category"]?$attend["Category"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["KnowledgeAssessmentPassingStatus"]?$attend["KnowledgeAssessmentPassingStatus"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["PracticalAssessmentPassingStatus"]?$attend["PracticalAssessmentPassingStatus"]:"-").'</td>';
                //    $value .= '<td valing="top">'.$attend["state_en"].','.$attend["state_en"].'</td>';
                //    $value .= '<td valing="top">'.''.'</td>';
                    $value .= '<td valing="top">'.($attend["LearnerStage"]?$attend["LearnerStage"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["BatchNumber"]?$attend["BatchNumber"]:"-").'</td>';
                    $value .= '<td valing="top" class="date">'.($attend["DateTheory"]?$attend["DateTheory"]:"-").'</td>';
                    $value .= '<td valing="top" class="date">'.($attend["DatePractical"]?$attend["DatePractical"]:"-").'</td>';
                    $value .= '<td valing="top" class="date">'.($attend["bmah_assessmentdate"] ?$attend["bmah_assessmentdate"]: "-").'</td>';
                    $value .= '<td valing="top">'.($attend["lang_en"]?$attend["lang_en"]: "-").'</td>';
                    $value .= '<td valing="top">'.($attend["type_en"] ?$attend["type_en"]: "-").'</td>';
                    $value .= '<td valing="top">'.($attend["KnowledgeAssessmentScore"] ?$attend["KnowledgeAssessmentScore"]: "-").'</td>';
                    $value .= '<td valing="top">'.($attend["PracticalAssessmentScore"] ?$attend["PracticalAssessmentScore"]: "-").'</td>';
                    $value .= '<td valing="top">'.($data["invoiceexpiry"]?$data["invoiceexpiry"]:"-").'</td>';
                    $value .= '<td valing="top">'.($data["state_en"]?$data["state_en"]:"-").'</td>';
                    $value .= '<td valing="top">'.($data["city_en"]?$data["city_en"]:"-").'</td>';
                    $value .= '<td valing="top">'.($data['trainingprovider_en'] ? $data['trainingprovider_en'] : "-").'</td>';
                    // $value .= '<td valing="top">'.($data['officetype'] ? $data['officetype'] : '-').'</td>';
                    // $value .= '<td valing="top">'.($data['branchname_en'] ? $data['branchname_en'] : '-').'</td>';
                    $value .= '<td valing="top">'.($attend["TutorTeaching"]?$attend["TutorTeaching"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["TutorPractical"]?$attend["TutorPractical"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["AssessmentCentre"]?$attend["AssessmentCentre"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["assessor"]?$attend["assessor"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["IQA"]?$attend["IQA"]:"-").'</td>';
                    $value .= '<td valing="top">'.($attend["VerficationNumber"]?$attend["VerficationNumber"]:"-").'</td>';
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
           $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/im/assessment-fee/downloadassesmentdata?filename='.\api\components\Security::encrypt($exeFileName)]);
           return $return;
       }else{
           $return['status'] = 2;    
           return $return; 
       }
       
       return $this->asJson($response);
    }
    public static function actionGenerateInvoice() 
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
            ['rasf_feetype' => 2],
            ['rasf_invoicestatus' => 1],
            ['!=','rasf_projectmst_fk',4]
        ])->all();

        $data = RoyaltyandasmtfeeTbl::getAssesmentLearnerDtlsQuery($params);
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
                        ['rasf_paidto'=>$dataOne['rasf_paidto']],
                        ['rasf_feetype' => 2],
                        ['rasf_invoicestatus' => 1],
                        ['!=','rasf_projectmst_fk',4]
                    ])->one();
                    if(empty($checkCourse)){
                        $newFlag = true;
                        $model = new RoyaltyandasmtfeeTbl();
                        $model->rasf_projectmst_fk=$dataOne['rasf_projectmst_fk'];
                        $model->rasf_appcoursedtlsmain_fk=$dataOne['rasf_appcoursedtlsmain_fk'];
                        $model->rasf_feesubscriptionmst_fk=$dataOne['rasf_feesubscriptionmst_fk'];
                        $model->rasf_raisedon = $selectedDate->format("Y-m-d");
                        $model->rasf_feetype = 2;
                        $model->rasf_totrecord =$dataOne['rasf_totrecord'];
                        $model->rasf_invoicedamount=$dataOne['rasf_invoicedamount'];
                        $model->rasf_vatamount= ($model->rasf_invoicedamount*5)/100;
                        $model->rasf_vatpercent='5';
                        $model->rasf_invoiceno = "I";
                        $model->rasf_invoiceexpiry=$expiry_date->format("Y-m-d H:i:s");
                        $model->rasf_pymtstatus=1;
                        $model->rasf_invoicestatus=1;
                        $model->rasf_paidby=$dataOne['rasf_paidby'];
                        $model->rasf_paidto = $dataOne['rasf_paidto'];
                        $model->rasf_createdon=date('Y-m-d H:i:s');
                        $model->rasf_createdby=$userPk;

                        if(!$model->save()){
                            $response['message'] = $model->getErrors();
                            $response['staus'] = false;
                            $transaction->rollBack();
                            return $response;
                        }else{
                            $model->rasf_invoiceno = "INV-".$dataOne['opalMember']."-CAF-".date('Y')."-".$model->royaltyandasmtfee_pk;
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
        $asmnt_pk = $params['asmnt_pk'];
        $oldData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $params['asmnt_pk']])->asArray()->one();
        $pData = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk'=> $params['asmnt_pk']])->one();
        $checkIds = Yii::$app->db->createCommand("SELECT lavd_learnerreghrddtls_fk FROM leanerandvehicledtls_tbl WHERE lavd_royaltyandasmtfee_fk = $asmnt_pk")->queryOne();

        if($oldData){
            $date=date_create($oldData['rasf_raisedon']);
            $params['month']=date_format($date,"Y-m");
            $params['rasf_paidby'] = $oldData['rasf_paidby'];
            $params['rasf_paidTo'] = $oldData['rasf_paidto'];
            $data = RoyaltyandasmtfeeTbl::getAssesmentLearnerDtlsQuery($params);
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
                    $model->rasf_invoiceno = "INV-".$data['opalMember']."-CAF-".date('Y')."-".$model->royaltyandasmtfee_pk;
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
    

}
