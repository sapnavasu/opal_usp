<?php

namespace api\modules\st\controllers;

use app\models\StaffcompetencycarddtlshstyTbl;
use Yii;
use yii\rest\Controller;
use app\models\BatchmgmtdtlsTbl;
use app\models\AppstaffinfomainTbl;
use app\models\LearnerreghrddtlsTbl;
use app\models\OpalusermstTbl;
use app\models\AppinstinfomainTbl;
use app\models\StaffcompetencycardhdrTbl;
use app\models\RolemstTbl;
use app\models\StaffcompetencycardhdrhstyTbl;
use Da\QrCode\QrCode;
use DateTime;
use yii\db\ActiveRecord;
use api\components\Drive;

class StaffTechnicalController extends Controller
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

    public function actionTechnicalList(){

        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::technicalListingQuery($params);
        
        return $response;
    } 
    
    public function actionExportTechnical(){
        
        $params = Yii::$app->request->post();
        $params['excel'] = 1;
        $showColumn = $params['showCol'];
        $response = [];
        $data = AppstaffinfomainTbl::technicalListingQuery($params);
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/staff-mangement/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Technical Centre Staff_Grid';        
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
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Title </td><td colspan="1"> Technical Evaluation Centre Staff </td></tr>';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td></tr>';
            $value .= '<tr></tr>';
            $value .= '<tr></tr>';
            $value .= '</table>';
            
            if(!empty($showColumn)){
                $value .= '<style>.text{mso-number-format:"\@";} .date{mso-number-format:"dd-mm-yyyy";} </style><table border="1" style="border-collapse:collapse;width:100%;">';
                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                $value .= '<th>Sl. No.</th>';
                $value .= (in_array('project_name',$showColumn)) ? '<th>Project Name</th>' : '';
                $value .= (in_array('centre_name',$showColumn)) ? '<th>Centre Name</th>' : '';
                $value .= (in_array('member_number',$showColumn)) ? '<th>OPAL Membership No.</th>' : '';
                $value .= (in_array('company_name',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('office_type',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('branch_name',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('site_locaton',$showColumn)) ? '<th>Site Location</th>' : '';
                $value .= (in_array('civil_number',$showColumn)) ? '<th>Civil Number</th>' : '';
                $value .= (in_array('staff_name',$showColumn)) ? '<th>Staff Name</th>' : '';
                $value .= (in_array('email_id',$showColumn)) ? '<th>Email ID</th>' : '';
                $value .= (in_array('roles',$showColumn)) ? '<th>Roles</th>' : '';
                $value .= (in_array('categories',$showColumn)) ? '<th>Categories</th>' : '';
                $value .= (in_array('competency_card',$showColumn)) ? '<th>Competency Card Status</th>' : '';
                $value .= (in_array('dateofexp',$showColumn)) ? '<th>Date of Expiry</th>' : '';
                $value .= (in_array('last_approved',$showColumn)) ? '<th>Last Approved On</th>' : '';
                $value .= (in_array('account_status',$showColumn)) ? '<th>Account Status</th>' : '';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){

                            $site = empty($attend['city_en']) && empty($attend['state_en'])?"-":$attend['state_en'].", ".$attend['city_en'];
                            
                            $competencyStatus ='-';
                            if($attend['cpmstatus'] == 1){
                                $competencyStatus = 'Active';
                            }else if($attend['cpmstatus'] == 2){
                                $competencyStatus = 'Expired';
                            }
                            
                            $accoundStatus = '-';
                            if($attend['accountstatus'] == 'I'){
                                $accoundStatus = 'In-Active';
                            }else if($attend['accountstatus'] == 'E'){
                                $accoundStatus = 'Email Confirmation Pending';
                            }
                            else if($attend['accountstatus'] == 'A'){
                                $accoundStatus = 'Active';
                            }
                            else if($attend['accountstatus'] == null){
                                $accoundStatus = 'Yet to Create Account';
                            }
                            
                            $value .= '<tr>';
                            $value .= '<td valing="top">'.$i++.'</td>';
                            $value .= (in_array('project_name',$showColumn)) ? '<td valing="top">'.($attend["projectName_en"] ? $attend["projectName_en"] : "-").'</td>' : '';
                            $value .= (in_array('centre_name',$showColumn)) ? '<td valing="top">'.($attend["centreName_en"] ? $attend["centreName_en"] : "-").'</td>' : '';
                            $value .= (in_array('member_number',$showColumn)) ? '<td valing="top">'.($attend["opalmember"] ? $attend["opalmember"] :"-").'</td>' : '';
                            $value .= (in_array('company_name',$showColumn)) ? '<td valing="top">'.($attend["companyname_en"] ? $attend["companyname_en"] :"-").'</td>' : '';
                            $value .= (in_array('office_type',$showColumn)) ? '<td valing="top">'.($attend["officetype"] ? $attend["officetype"] : "-").'</td>' : '';
                            $value .= (in_array('branch_name',$showColumn)) ? '<td valing="top">'.($attend["branchName_en"] ? $attend["branchName_en"] :"-").'</td>' : '';
                            $value .= (in_array('site_locaton',$showColumn)) ? '<td valing="top">'.($site).'</td>' : '';
                            $value .= (in_array('civil_number',$showColumn)) ? '<td valing="top">'.($attend["civilNumber"] ? $attend["civilNumber"] : "-").'</td>' : '';
                            $value .= (in_array('staff_name',$showColumn)) ? '<td valing="top">'.($attend["staffName_en"] ? $attend["staffName_en"] : "-").'</td>' : '';
                            $value .= (in_array('email_id',$showColumn)) ? '<td valing="top">'.($attend["email_id"] ? $attend["email_id"] : "-").'</td>' : '';
                            $value .= (in_array('roles',$showColumn)) ? '<td valing="top">'.($attend["role_en"] ? $attend["role_en"] : "-").'</td>' : '';
                            $value .= (in_array('categories',$showColumn)) ? '<td valing="top">'.($attend["categories_en"] ? $attend["categories_en"] : "-").'</td>' : '';
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

    public function actionDownloaddata(){
        if($_REQUEST['filename']){
            $trackpk = \api\components\Security::decrypt($_REQUEST['filename']);
            $zipfilename = $trackpk.'.zip';
            $dir = \Yii::$app->params['srcDirectory'];
            $zipfilepath = $dir.'web/exports/staff-mangement/'.$zipfilename;
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

    public function actionView($id)
    {
        $response = AppstaffinfomainTbl::technicalView($id);
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
        $response = AppstaffinfomainTbl::techCalendarScheduleList($params);
        return $response;
    }
    
    public function actionBookingListing()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::technicalBookingListingQuery($params);
        return $response;
    }
    
    public function actionSaveBooking()
    {
        $params = Yii::$app->request->post();
        $response = AppstaffinfomainTbl::saveScheduleTime($params);
        return $response;
    }

    //Remove from the centre
    public function actionRemoveFromCentre(){
        
        \Yii::$app->db->createCommand("SET FOREIGN_KEY_CHECKS=0")->execute();
        $params = Yii::$app->request->post();
        $response['status'] = false;
        $user = OpalusermstTbl::find()->where(['oum_staffinforepo_fk'=>$params['repo_pk']])->one();
        
        $inspectionStatus = OpalusermstTbl::find()->select('rvrd_inspectionstatus')
        ->leftjoin('rasvehicleregdtls_tbl rvrd','rvrd_inspectorname = opalusermst_pk')
        ->where(['oum_staffinforepo_fk'=>$params['repo_pk']])
        ->andWhere([
            'NOT IN',
            'rvrd_inspectionstatus',
            [3,8,9,10],
        ])->asArray()->all();
        // echo $model->createCommand()->getRawSql(); die;

        if(!empty($inspectionStatus)){
            $response['message'] = "You cannot remove the staff from the list, as this staff has been assigned to a Vehicle Inspection which is not yet Completed.";
            return $response;
        }
        
        $staffMain = AppstaffinfomainTbl::find()->where(['appsim_StaffInfoRepo_FK'=>$params['repo_pk']])->all();
        $transcation = Yii::$app->db->beginTransaction();
        try{
            foreach($staffMain as $staffMainOne){
                if($staffMainOne->appsimAppStaffInfotmpFK){
                    $staffMainOne->appsimAppStaffInfotmpFK->delete();
                }
            }
            $staffMainOne->delete();
            if(!empty($user)){
                $user->oum_status = "I";
                $user->save();
            }
            $transcation->commit();
            $response['message'] = "The Staff has been removed from this Centre.";
            $response['status'] = true;
        } catch(\yii\base\Exception $e) {
            $response['message'] = $e->getMessage();
            $transcation->rollback();
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
        
         $model = StaffcompetencycardhdrTbl::find()->where([
             'scch_staffinforepo_fk' => $params['staffinfo'],
         ])->one(); 
         
         $filenamePrint = 'Competent_Inspector'.$params['staffinfo'].'_p.pdf';
         $filenameView = 'Competent_Inspector'.$params['staffinfo'].'_v.pdf';
 
         $model->scch_verificationcode = \Yii::$app->security->generateRandomString(8);
         $model->scch_plaincardpath = $filenamePrint;
         $model->scch_viewcardpath = $filenameView;
         $model->scch_cardissuedate = date('Y-m-d H:i:s');
         $model->save();

         $rolesArr = explode(',',$model->scch_rolemst_fk);
         $roles =[];
         foreach ($rolesArr as $role) {
             $roleModel = RolemstTbl::find()->where(['rolemst_pk'=>$role])->one();
             $roles[] = $roleModel->rm_rolename_en;
         }
         $roles = implode(', ',$roles);
 
        foreach ($model->staffcompetencycarddtlsTbls as $value) {
        
            if($value->sccdRascategorymstFk->rcm_coursesubcatname_en){
                $courseData['course'] = $value->sccdRascategorymstFk->rcm_coursesubcatname_en;
            }
            $courseData['expiry'] = date_format(date_create($value->sccd_cardexpiry),"d-m-Y");
            $courseData['roles'] = $roles;
            $course[] = $courseData;
         }
             
 
         $cardData['name'] = $data['sir_name_en'];
         $cardData['code'] = $model->scch_verificationcode;
         $cardData['issuedate'] = date('d-m-Y'); 
         $cardData['id_number'] = $data['sir_idnumber'];
         $cardData['course'] = $course;
         $cardData['training'] = false;
         /////
        //  print_r($value->sccdRascategorymstFk); die;
 
         $websiteurl = \Yii::$app->params['website_url'];
         $path = "../api/web/staffTechnical/";
         $path1 = "/web/staffTechnical/";
 
         $qrCode = (new QrCode(''))
             ->setText($websiteurl."/verify-product/?verificationno=");
         $qrCode->writeFile(__DIR__.'/../web/staffTechnical/comcard.png'); 
         $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="padding-left:30pt; padding-top:20pt; width:65pt; height:65pt; border-radius: 30%;">';

         if(!is_dir($path)){
             mkdir($path, 0777, true);
         }  
         $baseUrl = \Yii::$app->params['baseUrl'];
         $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
         //$mpdf->SetProtection(array());
         $mpdf->WriteHTML($this->renderPartial('../../pdf/competency',['qrcode'=>$qrcode, 'data' => $cardData]));
 
        $mpdf->Output($path .$filenamePrint, 'F');
        
        $mpdf1 = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        $mpdf1->SetProtection(array());
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
            $zipfilepath = $dir.'web/staffTechnical/'.$filename;
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
            $response['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/st/staff-technical/view-card?filename='.\api\components\Security::encrypt($model->scch_plaincardpath)]);
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
            $response['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/st/staff-technical/view-card?filename='.\api\components\Security::encrypt($model->scch_viewcardpath)]);
            $response['status'] = true;
         }
         $response['status'] = false;
         return $response;
     }

     public function actionViewCard(){

        if($_REQUEST['filename']){
           $filename = \api\components\Security::decrypt($_REQUEST['filename']);
           $dir = \Yii::$app->params['srcDirectory'];
           $zipfilepath = $dir.'web/staffTechnical/'.$filename;
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

        $model = StaffcompetencycardhdrTbl::find()->where([
            'scch_staffinforepo_fk' => $params['staffinfo'],
        ])->one(); 
        
        $filenamePrint = 'Competent_Trainer'.$params['staffinfo'].'_pReg.pdf';
        $filenameView = 'Competent_Trainer'.$params['staffinfo'].'_vReg.pdf';

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

        $rolesArr = explode(',',$model->scch_rolemst_fk);
        $roles =[];
        foreach ($rolesArr as $role) {
            $roleModel = RolemstTbl::find()->where(['rolemst_pk'=>$role])->one();
            $roles[] = $roleModel->rm_rolename_en;
        }
        $roles = implode(', ',$roles);

       foreach ($model->staffcompetencycarddtlsTbls as $value) {
       
           if($value->sccdRascategorymstFk->rcm_coursesubcatname_en){
               $courseData['course'] = $value->sccdRascategorymstFk->rcm_coursesubcatname_en;
           }

            $comDtls = new StaffcompetencycarddtlshstyTbl();
            $comDtls->sccdh_staffcompetencycarddtls_fk = $value->staffcompetencycarddtls_pk;
            $comDtls->sccdh_staffcompetencycardhdr_fk = $value->sccd_staffcompetencycardhdr_fk;
            $comDtls->sccdh_standardcoursedtls_fk = $value->sccd_standardcoursedtls_fk;
            $comDtls->sccdh_appcoursetrnstmp_fk = $value->sccd_appcoursetrnstmp_fk;
            $comDtls->sccdh_rascategorymst_fk = $value->sccd_rascategorymst_fk;
            $comDtls->sccdh_cardexpiry = $value->sccd_cardexpiry;
            $comDtls->sccdh_status = $value->sccd_status;
            $comDtls->sccdh_createdon = $value->sccd_createdon;
            $comDtls->sccdh_createdby = $value->sccd_createdby;
            $comDtls->save();

           $courseData['expiry'] = date_format(date_create($value->sccd_cardexpiry),"d-m-Y");
           $courseData['roles'] = $roles;
           $course[] = $courseData;
        }

        $cardData['name'] = $data['sir_name_en'];
        $cardData['code'] = $model->scch_verificationcode;
        $cardData['issuedate'] = date('d-m-Y'); 
        $cardData['id_number'] = $data['sir_idnumber'];
        $cardData['course'] = $course;
        $cardData['training'] = false;
        /////
        $websiteurl = \Yii::$app->params['website_url'];
        $path = "../api/web/staffTechnical/";
        $path1 = "/web/staffTechnical/";

        $qrCode = (new QrCode(''))
            ->setText($websiteurl."/verify-product/?verificationno=");
        $qrCode->writeFile(__DIR__.'/../web/staffTechnical/comcard.png'); 
        // $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:55pt; height:55pt;">';
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="padding-left:30pt; padding-top:20pt; width:65pt; height:65pt; border-radius: 30%;">';

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }  
        $baseUrl = \Yii::$app->params['baseUrl'];

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
}

