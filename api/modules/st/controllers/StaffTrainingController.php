<?php

namespace api\modules\st\controllers;

use app\models\StaffcompetencycarddtlshstyTbl;
use Yii;
use yii\rest\Controller;
use app\models\BatchmgmtdtlsTbl;
use app\models\AppstaffinfomainTbl;
use app\models\LearnerreghrddtlsTbl;
use app\models\AppstafflocationtmpTbl;
use app\models\OpalusermstTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\AppinstinfomainTbl;
use app\models\StaffcompetencycardhdrTbl;
use app\models\StaffcompetencycarddtlsTbl;
use app\models\FeesubscriptionmstTbl;
use app\models\StandardcoursemstTbl;
use app\models\RolemstTbl;
use app\models\StaffcompetencycardhdrhstyTbl;
use DateTime;
use Da\QrCode\QrCode;
use api\components\Drive;
use yii\db\ActiveRecord;


class StaffTrainingController extends Controller
{

    public $modelClass = 'app\models\AppstaffinfomainTbl';

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

    public function actionTrainingList(){

        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::trainingListingQuery($params);
        
        return $response;
    } 

    public function actionExportTraining(){
        
        $params = Yii::$app->request->post();
        $params['excel'] = 1;
        $showColumn = $params['showCol'];
        $response = [];
        $data = AppstaffinfomainTbl::trainingListingQuery($params);
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/staff-mangement/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Training Centre Staff_Grid';        
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
            $value .= '<table border="1">';
            $value .= '<tr><td colspan="2"></td><td colspan="2" rowspan="5" align="center"><img width="90" height="90" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Title </td><td colspan="1"> Training Evaluation Centre Staff </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
            $value .= '<tr></tr>';
            $value .= '<tr></tr>';
            $value .= '</table>';

            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:"\@";} .date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('member_number',$showColumn)) ? '<th>OPAL Membership No.</th>' : '';
                $value .= (in_array('company_name',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('training_centre',$showColumn)) ? '<th>Training Centre Name</th>' : '';
                $value .= (in_array('office_type',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('branch_name',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('site_locaton',$showColumn)) ? '<th>Site Location</th>' : '';
                $value .= (in_array('course',$showColumn)) ? '<th>Course</th>' : '';
                $value .= (in_array('civil_number',$showColumn)) ? '<th>Civil Number</th>' : '';
                $value .= (in_array('staff_name',$showColumn)) ? '<th>Staff Name</th>' : '';
                $value .= (in_array('email_id',$showColumn)) ? '<th>Email ID</th>' : '';
                $value .= (in_array('roles',$showColumn)) ? '<th>Roles</th>' : '';
                $value .= (in_array('language',$showColumn)) ? '<th>Languages</th>' : '';
                $value .= (in_array('approvewilayat',$showColumn)) ? '<th>Approved Wilayat</th>' : '';
                $value .= (in_array('course_sub',$showColumn)) ? '<th>Course Sub-categories</th>' : '';
                $value .= (in_array('competency_card',$showColumn)) ? '<th>Competency Card Status</th>' : '';
                $value .= (in_array('dateofexp',$showColumn)) ? '<th>Date of Expiry</th>' : '';
                $value .= (in_array('last_approved',$showColumn)) ? '<th>Last Approved On</th>' : '';
                $value .= (in_array('account_status',$showColumn)) ? '<th>Account Status</th>' : '';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){

                        $site = empty($attend['city_en']) && empty($attend['state_en'])?"-":$attend['state_en'].", ".$attend['city_en'];

                        $competencyStatus ='-';
                        if($attend['competency_card'] == 1){
                            $competencyStatus = 'Active';
                        }else if($attend['competency_card'] == 2){
                            $competencyStatus = 'Expired';
                        }
                        $accoundStatus = '-';
                        if($attend['account_status'] == 'I'){
                            $accoundStatus = 'In-Active';
                        }else if($attend['account_status'] == 'E'){
                            $accoundStatus = 'Email Confirmation Pending';
                        }
                        else if($attend['account_status'] == 'A'){
                            $accoundStatus = 'Active';
                        }
                        else if($attend['account_status'] == null){
                            $accoundStatus = 'Yet to Create Account';
                        }
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('member_number',$showColumn)) ? '<td valing="top">'.($attend["opalmember"] ? $attend["opalmember"] :"-").'</td>' : '';
                            $value .= (in_array('company_name',$showColumn)) ? '<td valing="top">'.($attend["companyname_en"] ? $attend["companyname_en"] :"-").'</td>' : '';
                            $value .= (in_array('training_centre',$showColumn)) ? '<td valing="top">'.($attend["trainigCentre_en"] ? $attend["trainigCentre_en"] : "-").'</td>' : '';
                            $value .= (in_array('office_type',$showColumn)) ? '<td valing="top">'.($attend["officetype"] ? $attend["officetype"] :"-").'</td>' : '';
                            $value .= (in_array('branch_name',$showColumn)) ? '<td valing="top">'.($attend["branchName_en"] ? $attend["branchName_en"] :"-").'</td>' : '';
                            $value .= (in_array('site_locaton',$showColumn)) ? '<td valing="top">'.($site).'</td>' : '';
                            $value .= (in_array('course',$showColumn)) ? '<td valing="top">'.($attend["categories_en"] ? $attend["categories_en"] :"-").'</td>' : '';
                            $value .= (in_array('civil_number',$showColumn)) ? '<td valing="top" class="text">'.($attend["civil_number"] ? $attend["civil_number"] : "-").'</td>' : '';
                            $value .= (in_array('staff_name',$showColumn)) ? '<td valing="top">'.($attend["staffName_en"] ? $attend["staffName_en"] : "-").'</td>' : '';
                            $value .= (in_array('email_id',$showColumn)) ? '<td valing="top">'.($attend["email_id"] ? $attend["email_id"] : "-").'</td>' : '';
                            $value .= (in_array('roles',$showColumn)) ? '<td valing="top">'.($attend["role_en"] ? $attend["role_en"] : "-").'</td>' : '';
                            $value .= (in_array('language',$showColumn)) ? '<td valing="top">'.($attend["language_en"] ? $attend["language_en"] : "-").'</td>' : '';
                            $value .= (in_array('approvewilayat',$showColumn)) ? '<td valing="top">'.($attend["approvewilayat_en"] ? $attend["approvewilayat_en"] : "-").'</td>' : '';
                            $value .= (in_array('course_sub',$showColumn)) ? '<td valing="top">'.($attend["sub_categories_en"] ? $attend["sub_categories_en"] : "-").'</td>' : '';
                            $value .= (in_array('competency_card',$showColumn)) ? '<td valing="top">'.($competencyStatus).'</td>' : '';
                            $value .= (in_array('dateofexp',$showColumn)) ? '<td valing="top" class="date">'.($attend["sccd_cardexpiry"] ? $attend["sccd_cardexpiry"] : "-").'</td>' : '';
                            $value .= (in_array('last_approved',$showColumn)) ? '<td valing="top" class="date">'.($attend["sccd_createdon"] ? $attend["sccd_createdon"] : "-").'</td>' : '';
                            $value .= (in_array('account_status',$showColumn)) ?'<td valing="top">'.($accoundStatus).'</td>':"";
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
            $zipfilepath = dirname(__FILE__).'/../web/exports/staff-mangement/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/st/staff-technical/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    public function actionExportSingleTraining(){
        
        \Yii::$app->db->createCommand("SET SESSION group_concat_max_len=18446744073709547520")->execute();
        $params = Yii::$app->request->post();
        $id = $params['id'];
        $staffinfo = $params['staffinfo'];
        $params['download_id'] = $id;
        $params['id'] = $staffinfo;
        $response = [];
        $data = AppstaffinfomainTbl::trainingListingQuery($params);
        $data = $data['data'];
        $params['excel'] = true;
        $timeSlot = AppstaffinfomainTbl::bookingListingQuery($params);
        
        if(count($timeSlot) == 0){
            $return['status'] = 3;    
            return $return; 
        }
        // print_r($timeSlot); die;
        $startDate = $params['date']['startDate'];
        $startDate = date('d-m-Y',strtotime($startDate));
        $endDate = $params['date']['endDate'];
        $endDate = date('d-m-Y',strtotime($endDate));
        // $minMax = AppstaffscheddtlsTbl::find()->select([
        //     "CONCAT(DATE_FORMAT(MIN(assd_date),'%d-%m-%Y'),' - ',DATE_FORMAT(MAX(assd_date),'%d-%m-%Y')) as fromTo",
        // ])
        // ->leftJoin('referencemst_tbl','referencemst_pk = assd_dayschedule AND rm_mastertype=11')
        // ->where(['assd_appstaffinfotmp_fk'=>$params['id']])
        // ->andWhere(['between', "assd_date", date('Y-m-d',strtotime($startDate)), date('Y-m-d',strtotime($endDate))])->asArray()->one();

        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/staff-mangement/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Training Centre Staff_Availability';        
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

            $site = empty($data['city_en']) && empty($data['state_en'])?"-":$data['state_en'].", ".$data['city_en'];
            $competencyStatus ='-';
                        if($data['competency_card'] == 1){
                            $competencyStatus = 'Active';
                        }else if($data['competency_card'] == 2){
                            $competencyStatus = 'Expired';
                        }
                        $accoundStatus = '-';
                        if($data['account_status'] == 'I'){
                            $accoundStatus = 'In-Active';
                        }else if($data['account_status'] == 'E'){
                            $accoundStatus = 'Email Confirmation Pending';
                        }
                        else if($data['account_status'] == 'A'){
                            $accoundStatus = 'Active';
                        }
                        else if($data['account_status'] == null || $data['account_status'] == 'null'){
                            $accoundStatus = 'Yet to Create Account';
                        }

            $value = '';
            $value .= '<style>.date{mso-number-format:"dd-mm-yyyy";} .text{mso-number-format:"\@";} </style><table border="1" style="border-right:none;">';
            $value .= '<tr ><td colspan="5"></td><td style="border:none;" colspan="2" rowspan="5" align="center"><img width="90" height="90" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png"></td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Title </td><td colspan="1">Training Evaluation Centre Staff</td><td colspan="1" style="font-weight:bold;"> Civil Number </td><td colspan="1" class="text"> '.($data['civil_number']?$data['civil_number']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> OPAL Membership No. </td><td colspan="1"> '.($data['opalmember']?$data['opalmember']:"-").' </td><td colspan="1" style="font-weight:bold;"> Staff Name </td><td colspan="1"> '.($data['staffName_en']?$data['staffName_en']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Training Centre Name </td><td colspan="1"> '.($data['trainigCentre_en']?$data['trainigCentre_en']:"-").' </td><td colspan="1" style="font-weight:bold;"> Email ID </td><td colspan="1"> '.($data['email_id']?$data['email_id']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Site Location </td><td colspan="1"> '.($site).' </td><td colspan="1" style="font-weight:bold;"> Roles </td><td colspan="1"> '.($data['role_en']?$data['role_en']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Course </td><td colspan="1"> '.($data['categories_en']?$data['categories_en']:"-").' </td><td colspan="1" style="font-weight:bold;"> Languages </td><td colspan="1"> '.($data['language_en']?$data['language_en']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Course Sub-Categories </td><td colspan="1"> '.($data['sub_categories_en']?$data['sub_categories_en']:"-").' </td><td colspan="1" style="font-weight:bold;"> Approved Wilayat </td><td colspan="1"> '.($data['approvewilayat_en']?$data['approvewilayat_en']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Competency Card Status </td><td colspan="1"> '.($competencyStatus).' </td><td colspan="1" style="font-weight:bold;"> Date of Expiry </td><td class="date" colspan="1"> '.($data['dateofexp']?$data['dateofexp']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Account Status </td><td colspan="1"> '.($accoundStatus).' </td><td colspan="1" style="font-weight:bold;"> Last Approved on </td><td class="date" colspan="1"> '.($data['last_approved']?$data['last_approved']:"-").' </td></tr>';
            $value .= '<tr><td colspan="2" style="font-weight:bold;"> Availability (From - To) </td><td colspan="1"> '.($startDate.' - '.$endDate).' </td><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
            $value .= '<tr></tr>';
            $value .= '</table>';

            if(!empty($timeSlot)){

                $value .= '<style>.text{mso-number-format:"\@";} .date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th colspan="2" >Sl. No.</th>';
                $value .= '<th colspan="2" >Date</th>';
                $value .= '<th colspan="2">Time Slot</th>';
                $value .= '<th colspan="2">Status</th>';
                $value .= '<th colspan="2">Booked For</th>';
                $value .= '<th colspan="2">Booked Batch</th>';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($timeSlot as $attend){

                        $value .= '<tr>';
                        $value .= '<td colspan="2" valing="top">'.$i++.'</td>';
                        $value .= '<td colspan="2" valing="top" class="date">'.($attend["assd_date"] ? $attend["assd_date"] : "-").'</td>';
                        $value .= '<td colspan="2" valing="top">'.($attend["time"] ? $attend["time"] : "-").'</td>';
                        $value .= '<td colspan="2" valing="top">'.($attend["status_en"] ? $attend["status_en"] : "-").'</td>';
                        $value .= '<td colspan="2" valing="top">'.($attend["booked_for"] ? $attend["booked_for"] : "-").'</td>';
                        $value .= '<td colspan="2" valing="top">'.($attend["batchno"] ? $attend["batchno"] : "-").'</td>';
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
            $zipfilepath = dirname(__FILE__).'/../web/exports/staff-mangement/'.$exeFileName. '.zip';
            
            $return['status'] = 1;
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/st/staff-technical/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
            return $return;
        }else{
            $return['status'] = 2;    
            return $return; 
        }
        
        return $this->asJson($response);
    }

    public function actionView($id,$course)
    {
        $response = AppstaffinfomainTbl::trainingView($id,$course);
        return $response;
    }

    public function actionEducationDetail()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::educationDetail($params);
        return $response;
    }
    
    public function actionWorkDetail()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::workDetail($params);
        return $response;
    }

    public function actionCalendarScheduleList()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::calendarScheduleList($params);
        return $response;
    }
    
    public function actionBookingListing()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::bookingListingQuery($params);
        return $response;
    }

    // save booking
    public function actionSaveBooking()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::saveScheduleTime($params);
        return $response;
    }

    //Change Status
    public function actionChangeStatus(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $date = date("Y-m-d H:i:s");

        $model =  AppstaffscheddtlsTbl::find()->where('appstaffscheddtls_pk = '.$data['pk'])->one();
        $model->assd_dayschedule =$data['value']; 
        $model->assd_updatedon =  $date;
        $model->assd_updatedby =  $userPk;
        
        if(!$model->save()){
            $response['message'] = $model->getErrors();
            $response['status'] = false;
        } else{
            $response['message'] = "Data Saved";
            $response['status'] = true;
        }
        return $response;
    }

    //Remove from the centre
    public function actionRemoveFromCentre(){
        
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        $params = Yii::$app->request->post();
        $response['status'] = false;
        $user = OpalusermstTbl::find()->where(['oum_staffinforepo_fk'=>$params['repo_pk']])->one();
        
        $batchStatus = OpalusermstTbl::find()->select([
            'assessorStatus.bmd_status as assessorStatus',
            'tutorStatus.bmd_status as tutorStatus'
        ])
        ->leftjoin('batchmgmtasmthdr_tbl assessor','bmah_assessor = opalusermst_pk')
        ->leftjoin('batchmgmtdtls_tbl assessorStatus','assessorStatus.batchmgmtdtls_pk = assessor.bmah_batchmgmtdtls_fk')
        ->leftjoin('batchmgmtthyhdr_tbl tutor','bmth_tutor = opalusermst_pk')
        ->leftjoin('batchmgmtdtls_tbl tutorStatus','tutorStatus.batchmgmtdtls_pk = tutor.bmth_batchmgmtdtls_fk')
        ->where(['oum_staffinforepo_fk'=>$params['repo_pk']])
        ->andWhere([
            'OR',
            ['NOT IN','assessorStatus.bmd_status',[7,8]],
            ['NOT IN','tutorStatus.bmd_status',[7,8]],
        ])->asArray()->all();
        // echo $model->createCommand()->getRawSql(); die;

        if(!empty($batchStatus)){
            $response['message'] = "You cannot remove the staff from the list as this staff having Active batches. It is mandatory to move all the assigned Batches to move to Print Status for removing the staff from the Centre.";
            return $response;
        }
        $staffMain = AppstaffinfomainTbl::find()->where(['appsim_StaffInfoRepo_FK'=>$params['repo_pk']])->all();
        $transaction = Yii::$app->db->beginTransaction();
        try{
            foreach($staffMain as $staffMainOne){
                $loctMain = \Yii::$app->db->createCommand("SELECT `aslm_appstaffLocationtmp_fk` FROM `appstafflocationmain_tbl` WHERE `aslm_appstaffinfomain_fk`= $staffMainOne->AppStaffInfoMain_PK")->queryOne();

                if($loctMain['aslm_appstaffLocationtmp_fk']){
                    $loctTemp = AppstafflocationtmpTbl::find()->where(['appstaffLocationtmp_pk'=>$loctMain['aslm_appstaffLocationtmp_fk']])->one();
                    $loctTemp->delete();
                }
                $staffSched = AppstaffscheddtlsTbl::find()->where(['assd_appstaffinfotmp_fk'=>$staffMainOne->appsim_AppStaffInfotmp_FK])->andWhere('assd_date >= CURDATE()')->all();
                foreach($staffSched as $schedOne){
                    $schedOne->assd_status = 2;
                    $schedOne->save();
                }
                $loctMain = \Yii::$app->db->createCommand()->delete('appstafflocationmain_tbl', ['aslm_appstaffinfomain_fk' => $staffMainOne->AppStaffInfoMain_PK])->execute();

                if($staffMainOne->appsimAppStaffInfotmpFK){
                    $staffMainOne->appsimAppStaffInfotmpFK->delete();
                }
                $staffMainOne->delete();
            }
            if(!empty($user)){
                $user->oum_status = "I";
                $user->save();
            }
           
            $transaction->commit();
            $response['message'] = "The Staff has been removed from this Centre.";
            $response['status'] = true;
        } catch(\yii\base\Exception $e) {
            $response['message'] = $e->getMessage();
            $transaction->rollback();
        }
        return $response;
    }

    public function actionUpdateStatus()
    {
        $params = Yii::$app->request->post();
        $response['status'] = false;
        
        $model = AppstaffscheddtlsTbl::find()->where(['appstaffscheddtls_pk'=>$params['id']])->one();
        if($model){
            $model->assd_dayschedule = $params['status'];
            $model->save();
            $response['status'] = true;
            $response['message'] = "The status has been changed successfully.";
        }
        
        return $response;
    }

    public function actionDeleteBooking()
    {
        $params = Yii::$app->request->post();
        $response['status'] = false;
        $response['message'] = "Having issue while deleting !!";
        
        $model = AppstaffscheddtlsTbl::find()->where(['appstaffscheddtls_pk'=>$params['id']])->one();
        if($model){
            $model->delete();
            $response['status'] = true;
            $response['message'] = "The time slot has been deleted.";
        }

        return $response;
    }

    public function actionUpdateData()
    {
        $params = Yii::$app->request->post();
        $response['status'] = false;
        
        $model = AppstaffscheddtlsTbl::find()->select(['assd_appstaffinfotmp_fk','assd_date','appstaffscheddtls_pk'])->where(['appstaffscheddtls_pk'=>$params['id']])->one();
        if($model){
            $response['status'] = true;
            $response['data'] = $model;
        }
        
        return $response;
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
                $response['message'] = "This time slot is already booked. Please select a different time slot.";
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

    // generate competency card
    public function actionGenerateCompetency()
    {
        $params = Yii::$app->request->post();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $data = AppstaffinfomainTbl::find()
            ->select([
                'sir_name_en','sir_idnumber',
                'memcompfiledtls_pk','mcfd_uploadedby','mcfd_opalmemberregmst_fk',
            ])
            ->leftJoin('staffinforepo_tbl staff', 'staff.staffinforepo_pk = appsim_StaffInfoRepo_FK')
            ->leftJoin('opalusermst_tbl user','oum_staffinforepo_fk = appsim_StaffInfoRepo_FK')
            ->leftjoin('memcompfiledtls_tbl as photo','photo.memcompfiledtls_pk = sir_photo')
            ->where(['appsim_StaffInfoRepo_FK' => $params['staffinfo']])
            ->asArray()->one();
        
        if($data['memcompfiledtls_pk']){
            $cardData['profile'] = Drive::generateUrl($data['memcompfiledtls_pk'], $data['mcfd_opalmemberregmst_fk'],$data['mcfd_uploadedby']);
        }else{
            $response['message'] = "The Profile photo is not uploaded. Please upload to generate the Competency Card.";
            $response['status'] = false;
            return $response;
        } 

        if(empty($data['sir_idnumber'])){
            $response['message'] = "There is no Civil Number available for this staff. Please update the Civil Number to generate the Competency Card.";
            $response['status'] = false;
            return $response;
        } 

        $models = StaffcompetencycardhdrTbl::find()->where([
            'scch_staffinforepo_fk' => $params['staffinfo'],
        ])->all(); 
        
        $filenamePrint = 'Competent_Trainer'.$params['staffinfo'].'_p.pdf';
        $filenameView = 'Competent_Trainer'.$params['staffinfo'].'_v.pdf';
        $verificationCode = \Yii::$app->security->generateRandomString(8);
        foreach($models as $k => $model){
            $model->scch_verificationcode = $verificationCode;
            $model->scch_plaincardpath = $filenamePrint;
            $model->scch_viewcardpath = $filenameView;
            $model->scch_cardissuedate = date('Y-m-d H:i:s');
            $model->save();

            $rolesPk = $model->scch_rolemst_fk;
            $rolesArr = explode(',',$rolesPk);
            $roles =[];
            foreach ($rolesArr as $role) {
                $roleModel = RolemstTbl::find()->where(['rolemst_pk'=>$role])->one();
                $roles[] = $roleModel->rm_rolename_en;
            }
            $roles = implode(', ',$roles);
            $dtls = StaffcompetencycarddtlsTbl::find()->where(['sccd_staffcompetencycardhdr_fk'=>$model->staffcompetencycardhdr_pk])->one();
            
            if($model->scchStandardcoursemstFk->scm_coursename_en){
                $courseData[$k]['course'] = $model->scchStandardcoursemstFk->scm_coursename_en;
                $courseData[$k]['expiry'] = !empty($dtls)?date_format(date_create($dtls->sccd_cardexpiry),"d-m-Y"):"";
                $courseData[$k]['roles'] = $roles;
            }
        }
        $cardData['name'] = $data['sir_name_en'];
        $cardData['code'] = $verificationCode;
        $cardData['issuedate'] = date('d-m-Y'); 
        $cardData['id_number'] = $data['sir_idnumber'];
        $cardData['course'] = $courseData;
        $cardData['training'] = true;
        /////
        $websiteurl = \Yii::$app->params['website_url'];
        $path = "../api/web/staffTraining/";
        $path1 = "/web/staffTraining/";

        $qrCode = (new QrCode(''))->setText($websiteurl."verify-product/?verificationno=$verificationCode&value=form3");
        $qrCode->writeFile(__DIR__.'/../web/staffTraining/comcard.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="padding-left:30pt; padding-top:20pt; width:65pt; height:65pt; border-radius: 30%;">';        

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }  
        $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        //$mpdf->SetProtection(array());
        $mpdf->WriteHTML($this->renderPartial('../../pdf/competency',['qrcode'=>$qrcode, 'data' => $cardData]));

        $mpdf->Output($path .$filenamePrint, 'F');

        $mpdf1 = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        $mpdf1->SetProtection(array('print'));
        $mpdf1->WriteHTML($this->renderPartial('../../pdf/competency',['qrcode'=>$qrcode, 'data' => $cardData]));

        $mpdf1->Output($path .$filenameView, 'F');

        $response['message'] = "Competency card has been generated successfully.";
        $response['status'] = true;
        return $response;
    }

    //
    public function actionDownload(){

        if($_REQUEST['filename']){
           $filename = \api\components\Security::decrypt($_REQUEST['filename']);
           $dir = \Yii::$app->params['srcDirectory'];
           $zipfilepath = $dir.'web/staffTraining/'.$filename;
           if (file_exists($zipfilepath)) {                
               header('Content-Type: application/pdf'); // ZIP file
               header('Content-Disposition: attachment; filename="'.$filename.'"');
               header("Content-Length: ".filesize($zipfilepath));
               // ob_clean();
               // flush();
               @readfile($zipfilepath);
           }else{
               echo 'Source file is not in the directory'; exit;
           }
       }
    }

    public function actionDownloadFile(){

        $params = Yii::$app->request->post();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = StaffcompetencycardhdrTbl::find()->where([
            'scch_staffinforepo_fk' => $params['staffinfo'],
        ])->one(); 
        
        $model->scch_iscardprinted = 1;
        $model->scch_printedon = date('Y-m-d');
        $model->scch_printedby = $userPk;
        $model->save();

        if(!empty($model->scch_plaincardpath)){
            $response['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/st/staff-training/view-card?filename='.\api\components\Security::encrypt($model->scch_plaincardpath)]);
            $response['status'] = true;
        }
        $response['status'] = false;

        return $response;
    }

    public function actionViewFile(){

        $params = Yii::$app->request->post();
        $model = StaffcompetencycardhdrTbl::find()->where([
           'scch_staffinforepo_fk' => $params['staffinfo'],
       ])->one(); 
        
        $model->scch_iscardviewed = 1;
        $model->save();
        if(!empty($model->scch_viewcardpath)){
           $response['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/st/staff-training/view-card?filename='.\api\components\Security::encrypt($model->scch_viewcardpath)]);
           $response['status'] = true;
        }
        $response['status'] = false;
        return $response;
    }

    public function actionViewCard(){

       if($_REQUEST['filename']){
          $filename = \api\components\Security::decrypt($_REQUEST['filename']);
          $dir = \Yii::$app->params['srcDirectory'];
          $zipfilepath = $dir.'web/staffTraining/'.$filename;
          if (file_exists($zipfilepath)) {                
              $path = dirname(__FILE__)."/../../../../backend/invoice/";
               header("Content-type: application/pdf");
               header("Content-Disposition: inline; filename = $filename");
               @readfile($zipfilepath);
          }else{
              echo 'Source file is not in the directory'; exit;
          }
      }
   }

    public function actionRegenerateCompetency()
    {
        $params = Yii::$app->request->post();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $data = AppstaffinfomainTbl::find()
            ->select([
                'sir_name_en','sir_idnumber',
                'memcompfiledtls_pk','mcfd_uploadedby','mcfd_opalmemberregmst_fk',
            ])
            ->leftJoin('staffinforepo_tbl staff', 'staff.staffinforepo_pk = appsim_StaffInfoRepo_FK')
            ->leftJoin('opalusermst_tbl user','oum_staffinforepo_fk = appsim_StaffInfoRepo_FK')
            ->leftjoin('memcompfiledtls_tbl as photo','photo.memcompfiledtls_pk = sir_photo')
            ->where(['appsim_StaffInfoRepo_FK' => $params['staffinfo']])
            ->asArray()->one();
        
        if($data['memcompfiledtls_pk']){
            $cardData['profile'] = Drive::generateUrl($data['memcompfiledtls_pk'], $data['mcfd_opalmemberregmst_fk'],$data['mcfd_uploadedby']);
        }else{
            $response['message'] = "The Profile photo is not uploaded. Please upload to generate the Competency Card.";
            $response['status'] = false;
            return $response;
        } 

        if(empty($data['sir_idnumber'])){
            $response['message'] = "There is no Civil Number available for this staff. Please update the Civil Number to generate the Competency Card.";
            $response['status'] = false;
            return $response;
        } 
        
        $models = StaffcompetencycardhdrTbl::find()->where([
            'scch_staffinforepo_fk' => $params['staffinfo'],
        ])->all(); 
        
        $filenamePrint = 'Competent_Trainer'.$params['staffinfo'].'_pReg.pdf';
        $filenameView = 'Competent_Trainer'.$params['staffinfo'].'_vReg.pdf';

        foreach($models as $k => $model){
            
            $newModel = new StaffcompetencycardhdrhstyTbl();

            $newModel->scchh_staffcompetencycardhdr_fk = $model->staffcompetencycardhdr_pk;
            $newModel->scchh_staffinforepo_fk = $model->scch_staffinforepo_fk;
            $newModel->scchh_projectmst_fk = $model->scch_projectmst_fk;
            $newModel->scchh_standardcoursemst_fk = $model->scch_standardcoursemst_fk;
            $newModel->scchh_appoffercoursemain_fk = $model->scch_appoffercoursemain_fk;
            $newModel->scchh_rolemst_fk = $model->scch_rolemst_fk;
            $newModel->scchh_language = $model->scch_language;
            // $newModel->scch_cardexpiry = $model->schc_cardexpiry;
            $newModel->scchh_cardissuedate = $model->scch_cardissuedate;
            $newModel->scchh_status = $model->scch_status;
            $newModel->scchh_verificationcode = $model->scch_verificationcode;
            $newModel->scchh_plaincardpath = $model->scch_plaincardpath;
            $newModel->scchh_viewcardpath = $model->scch_viewcardpath;
            $newModel->scchh_iscardprinted = $model->scch_iscardprinted;
            $newModel->scchh_iscardviewed = $model->scch_iscardviewed;
            $newModel->scchh_printedon = $model->scch_printedon;
            $newModel->scchh_printedby = $model->scch_printedby;
            $newModel->scchh_createdon = $model->scch_createdon;
            $newModel->scchh_createdby = $model->scch_createdby;
            $newModel->save();

            $model->scch_plaincardpath = $filenamePrint;
            $model->scch_viewcardpath = $filenameView;
            $model->scch_iscardprinted = 2;
            $model->scch_iscardviewed = 2;
            $model->scch_printedon = '';
            $model->scch_printedby = '';
            $model->scch_cardissuedate = date('Y-m-d H:i:s');
            $model->save();
// print_r($newModel); die;
            $rolesPk = $model->scch_rolemst_fk;
            $rolesArr = explode(',',$rolesPk);
            $roles =[];
            foreach ($rolesArr as $role) {
                $roleModel = RolemstTbl::find()->where(['rolemst_pk'=>$role])->one();
                $roles[] = $roleModel->rm_rolename_en;
            }
            $roles = implode(', ',$roles);
            $dtlsAll = StaffcompetencycarddtlsTbl::find()->where(['sccd_staffcompetencycardhdr_fk'=>$model->staffcompetencycardhdr_pk])->all();
            
            foreach ($dtlsAll as $dtls) {
                $comDtls = new StaffcompetencycarddtlshstyTbl();
                $comDtls->sccdh_staffcompetencycarddtls_fk = $dtls->staffcompetencycarddtls_pk;
                $comDtls->sccdh_staffcompetencycardhdr_fk = $dtls->sccd_staffcompetencycardhdr_fk;
                $comDtls->sccdh_standardcoursedtls_fk = $dtls->sccd_standardcoursedtls_fk;
                $comDtls->sccdh_appcoursetrnstmp_fk = $dtls->sccd_appcoursetrnstmp_fk;
                $comDtls->sccdh_rascategorymst_fk = $dtls->sccd_rascategorymst_fk;
                $comDtls->sccdh_cardexpiry = $dtls->sccd_cardexpiry;
                $comDtls->sccdh_status = $dtls->sccd_status;
                $comDtls->sccdh_createdon = $dtls->sccd_createdon;
                $comDtls->sccdh_createdby = $dtls->sccd_createdby;
                $comDtls->save();
            }
            
            if($model->scchStandardcoursemstFk->scm_coursename_en){
                $courseData[$k]['course'] = $model->scchStandardcoursemstFk->scm_coursename_en;
                $courseData[$k]['expiry'] = !empty($dtls)?date_format(date_create($dtls->sccd_cardexpiry),"d-m-Y"):"";
                $courseData[$k]['roles'] = $roles;
            }
        }
        $cardData['name'] = $data['sir_name_en'];
        $cardData['code'] = $model->scch_verificationcode;
        $cardData['issuedate'] = date('d-m-Y'); 
        $cardData['id_number'] = $data['sir_idnumber'];
        $cardData['course'] = $courseData;
        $cardData['training'] = true;
        
        /////
        $websiteurl = \Yii::$app->params['website_url'];
        $path = "../api/web/staffTraining/";
        $path1 = "/web/staffTraining/";

        $qrCode = (new QrCode(''))->setText($websiteurl."verify-product/?verificationno=$model->scch_verificationcode&value=form3");
        $qrCode->writeFile(__DIR__.'/../web/staffTraining/comcard.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="padding-left:30pt; padding-top:20pt; width:65pt; height:65pt; border-radius: 30%;">';

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }  
        $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        //$mpdf->SetProtection(array());
        $mpdf->WriteHTML($this->renderPartial('../../pdf/competency',['qrcode'=>$qrcode, 'data' => $cardData]));

        $mpdf->Output($path .$filenamePrint, 'F');
        
        $mpdf1 = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        $mpdf1->SetProtection(array());
        $mpdf1->WriteHTML($this->renderPartial('../../pdf/competency',['qrcode'=>$qrcode, 'data' => $cardData]));

        $mpdf1->Output($path .$filenameView, 'F');

        $response['message'] = "Competency card has been re-generated successfully.";
        $response['status'] = true;
        return $response;
    }

    public function actionGetbatchids(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $repopk = \app\models\AppstaffinfotmpTbl::find()
        ->where('appostaffinfotmp_pk = '.$data['staffinfotmppk'])
        ->asArray()->one();
        $userpk =  OpalusermstTbl::find()
        ->where('oum_staffinforepo_fk = '.$repopk['appsit_staffinforepo_fk'])
        ->asArray()->one();

        $usrpk =  $userpk['opalusermst_pk'];

        $BatchmgmtasmthdrTbl = \app\models\BatchmgmtasmthdrTbl::find()
        ->where('bmah_status != 3 and  bmah_assessor = '. $usrpk.' and bmah_assessmentdate = '.'"'.$data['date'].'"')
        ->asArray()->all();
        
        $BatchmgmtthyhdrTbl = \app\models\BatchmgmtthyhdrTbl::find()
        ->where('bmth_status != 3 and  bmth_tutor = '. $usrpk.' and bmth_startdate = '.'"'.$data['date'].'"')
        ->asArray()->all();

        $BatchmgmtpracthdrTbl = \app\models\BatchmgmtpracthdrTbl::find()
        ->where('bmph_status != 3 and  bmph_tutor = '. $usrpk.' and bmph_startdate = '.'"'.$data['date'].'"')
        ->asArray()->all();

        $str = "";
        foreach ($BatchmgmtasmthdrTbl as $item) {
            $str .= $item["bmah_batchmgmtdtls_fk"] . ", ";
        }
        foreach ($BatchmgmtthyhdrTbl as $item) {
            $str .= $item["bmth_batchmgmtdtls_fk"] . ", ";
        }
        foreach ($BatchmgmtpracthdrTbl as $item) {
            $str .= $item["bmph_batchmgmtdtls_fk"] . ", ";
        }

        $str = rtrim($str, ", "); // remove the trailing comma and space
        $str = str_replace(' ', '', $str);

        return ['batchpk'=>$str];
    }

    public function actionGetCategorylist(){
        
        $list = StandardcoursemstTbl::find()->select([
                'scm_coursename_en',
                'scm_coursename_ar',
                'standardcoursemst_pk',
        ])
        ->where([
        'scm_projectmst_fk'=>2,
        'scm_status'=>1
        ])->orderBy('scm_coursename_en')->asArray()->all();
        
        return $list;
    }
}

