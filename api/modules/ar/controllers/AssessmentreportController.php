<?php

namespace api\modules\ar\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use app\models\BatchmgmtdtlsTbl;
use app\models\LearnerasmthdrTbl;
use app\models\LearnerreghrddtlsTbl;
use DateTime;
use yii\db\ActiveRecord;
use Da\QrCode\QrCode;
use Da\QrCode\Format\BookmarkFormat;
use app\models\BatchmgmtpracthdrTbl;
use app\models\OpalusermstTbl;
use Exception;
use app\models\BatchmgmtthyhdrTbl;


class AssessmentreportController extends MasterController
{

    public $modelClass = 'app\models\BatchmgmtdtlsTbl';

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


    public function actionGetbatchdata($batchID = NULL){

        $model = BatchmgmtdtlsTbl::find()->where(['bmd_Batchno'=>$batchID])->one();
        $scourse = $model->getBmdStandardcoursedtlsFk()->one();
        $company = $model->getBmdOpalmemberregmstFk()->one();
        $batchType = \app\models\BatchmgmtdtlsTblQuery::referenceType($model->bmd_batchtype);
        $appinstinfo=\app\models\AppinstinfomainTbl::find()->where(['appinstinfomain_pk' =>$model->bmd_appinstinfomain_fk])->one();
        $learnercount = \app\models\LearnerreghrddtlsTbl::find()->where(['lrhd_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->count();

        $istutor = false;
        $moveto = '';
        $duration = '';
        if($model->bmd_status == 1 || $model->bmd_status == 2 || $model->bmd_status == 7){
            $duration = \app\models\BatchmgmtthyhdrTbl::find()
            ->select(['batchmgmtthyhdr_tbl.bmth_startdate as start','batchmgmtthyhdr_tbl.bmth_enddate as end'])
            ->leftJoin('batchmgmtthydtls_tbl','batchmgmtthydtls_tbl.bmtd_batchmgmtdtls_fk = batchmgmtthyhdr_tbl.batchmgmtthyhdr_pk')
            ->where(['batchmgmtthyhdr_tbl.bmth_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->asArray()->one();
        }else if($model->bmd_status == 3){
            $duration = \app\models\BatchmgmtpracthdrTbl::find()->select(['batchmgmtpracthdr_tbl.bmph_startdate as start','batchmgmtpracthdr_tbl.bmph_enddate as end'])
            ->leftJoin('batchmgmtpractdtls_tbl','batchmgmtpractdtls_tbl.bmpd_batchmgmtpracthdr_fk = batchmgmtpracthdr_tbl.batchmgmtpracthdr_pk')
            ->where(['batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->asArray()->one();
        } else{
            $duration = \app\models\BatchmgmtasmthdrTbl::find()->select(['batchmgmtasmthdr_tbl.bmah_assessmentdate as start','bmah_assessstarttime as starttime', 'bmah_assessendtime as endtime'])
            ->leftJoin('batchmgmtasmtdtls_tbl','batchmgmtasmtdtls_tbl.bmad_batchmgmtasmthdr_fk = batchmgmtasmthdr_tbl.batchmgmtasmthdr_pk')
            ->where(['batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->asArray()->one();
        }

        if(!empty($model)){//theory
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

                $tutor = BatchmgmtthyhdrTbl::find()
                ->where(['bmth_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])
                ->andwhere(['bmth_tutor'=>$userPk])
                ->one();
                if(!empty($tutor)){
                    // $userrecord = OpalusermstTbl::find()->where(['opalusermst_pk'=>$tutor->bmth_tutor])->one();
                    // if(!empty($userrecord)){
                        if($model->bmd_status != 3){
                            $isthytutor = true;
                        }
                        $moveto = 'assesst';
                        if($scourse->scd_ispratclass== 1){
                            if($model->bmd_batchtype == 25 && $scourse->scd_ispratclassrefresher == 1){
                                $moveto = 'practical';
                            } else if($model->bmd_batchtype == 25 && $scourse->scd_ispratclassrefresher == 2){
                                $moveto = 'assesst';
                            } else{
                                $moveto = 'practical';
                            }
                         }
                    // }
                }   
             //  if(!$istutor){

                   $ptutor = BatchmgmtpracthdrTbl::find()
                   ->where(['bmph_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])
                   ->andwhere(['bmph_tutor'=>$userPk])
                    ->one();
                   if(!empty($ptutor)){
                           $ispratutor = true;
                           if($model->bmd_status==3){
                               $moveto = 'assesst';
                           }
                           if($model->bmd_status==2 && $scourse->scd_ispratclass==2){
                               $moveto = 'assesst';
                            }
                   }
              // }
        }

        $assessor = \app\models\BatchmgmtasmthdrTbl::find()
        ->where(['bmah_assessor'=>$userPk])
        ->andwhere(['bmah_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->one();
        if(!empty($assessor)){
            $isassessor = true;
        }
        $ivqastaff = \app\models\BatchmgmtasmthdrTbl::find()
        ->where(['bmah_ivqastaff'=>$userPk])
        ->andwhere(['bmah_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->one();
        if(!empty($ivqastaff)){
            $isivqastaff = true;
        }

        $attendaccess = \api\components\Batch::getAttendanceDetailInfo($batchID);

        $praflag = false;
        if($scourse->scd_ispratasmt == 1){
            if($model->bmd_batchtype == 25 && $scourse->scd_ispratclassrefresher == 1){
                $praflag = true;
            } else if($model->bmd_batchtype == 25 && $scourse->scd_ispratclassrefresher == 2){
                $praflag = false;
            } else{
                $praflag = true;
            }
        }else{
            $praflag = false;
        }

        $assessmentcetrepk = \app\models\BatchmgmtasmthdrTbl::find()->select(['opalusermst_tbl.oum_opalmemberregmst_fk as pk'])->leftJoin('opalusermst_tbl','opalusermst_tbl.opalusermst_pk = batchmgmtasmthdr_tbl.bmah_assessor')->where(['bmah_batchmgmtdtls_fk'=>$model->batchmgmtdtls_pk])->asArray()->one();

        $batch_details = [
            'batchmgmtdtls' => $model->batchmgmtdtls_pk,
            'bmd_opalmemberregmst_fk' => $model->bmd_opalmemberregmst_fk,
            'batach_no' => $model->bmd_Batchno,
            'course' => $model->bmd_standardcoursedtls_fk,
            'btype' => $model->bmd_batchtype,
            'batch_type'=> $batchType['rm_name_en'],
            'standardCourse' =>$batchType['bmd_standardcoursemst_fk'],
            'status' => $model->bmd_status,
            'traning_center'=> $company?$company->omrm_companyname_en:null,
            'branch_name'=>$company?$company->omrm_branch_en:null,
            'office_type'=>$appinstinfo?$appinstinfo->appiim_officetype:null,
            'start_date'=>$duration?$duration['start']:null,
            'end_date'=>$duration?$duration['end']:null,
            'starttime'=>$duration?$duration['starttime']:null,
            'endtime'=>$duration?$duration['endtime']:null,
            'total_learners'=>$learnercount,
            'reamaining_learners'=>$model->bmd_batchcount-$learnercount,
            'total'=>$model->bmd_batchcount,
            'isknw'=> $scourse->scd_isknwlasmt,
            'ispra'=>$scourse->scd_ispratasmt,
            'printcard'=>$scourse->scd_printfinalpermitcard,
            'isthytutor'=> $isthytutor,
            'ispratutor'=> $ispratutor,
            'moveto'=> $moveto,
            'req_status'=>$model->bmd_reqstatus,
            'attenddwldaccess'=>(count($attendaccess)>0)? true: false,
            'isassessor'=> $isassessor,
            'isivqastaff'=> $isivqastaff,
            'regpk' =>$model->bmd_opalmemberregmst_fk,
            'ispraflag' => $praflag,
            'ispraclass'=> $scourse->scd_ispratclass,
            'assessmentcentre'=>$assessmentcetrepk['pk'],

        ];
       
        if($model)
        {
             return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $batch_details];
        }
        
         return [ 'msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => '' ];       
    }

    public function actionGetlearnerdata($id){
        $learnerdata = \app\models\LearnerreghrddtlsTblQuery::getlearnerdata($id);
        $kassessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnerdata['kstatus']])->one();
        $passessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnerdata['pstatus']])->one();
        $datetime1 = new DateTime($learnerdata['sir_dob']);
        $datetime2 = new DateTime();
        $diff = $datetime1->diff($datetime2);
        $age = $diff->y;
        $kstatus = '';
        $pstatus = '';
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $ivqastaff = \app\models\BatchmgmtasmthdrTbl::find()
        ->where(['bmah_ivqastaff'=>$userPk])
        ->andwhere(['bmah_batchmgmtdtls_fk'=>$learnerdata['batchmgmtdtls_pk']])->one();
        if(!empty($ivqastaff)){
            $isivqastaff = true;
        }
        $stafflince = \app\models\StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk'=>$learner_update->lrhd_staffinforepo_fk])->one();
         $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
         $url = Null;
         if($learnerdata['sir_photo'])
            $url = \api\components\Drive::generateUrl($learnerdata['sir_photo'],$companyPk,$userPk);
        $model = BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learnerdata['batchmgmtdtls_pk']])->one();
        $scourse = $model->getBmdStandardcoursedtlsFk()->one();
        $maincourse = \app\models\StandardcoursemstTbl::find()->where(['standardcoursemst_pk'=>$scourse->scd_standardcoursemst_fk])->one();
        $praflag = false;
        if($learnerdata['scd_ispratasmt'] == 1){
            if($model->bmd_batchtype == 25 && $learnerdata['scd_ispratclassrefresher'] == 1){
                $praflag = true;
            } else if($model->bmd_batchtype == 25 && $learnerdata['scd_ispratclassrefresher'] == 2){
                $praflag = false;
            } else{
                $praflag = true;
            }
        }else{
            $praflag = false;
        }
        $stafflince = \app\models\StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk'=>$learnerdata['staffinforepo_pk']])->one();
        $learnerData = [
            'learnerPK'=> $learnerdata['learnerreghrddtls_pk'],
            'batckPK'=> $learnerdata['batchmgmtdtls_pk'],
            'standcoursePK'=>$learnerdata['bmd_standardcoursedtls_fk'],
            'maincourse'=>$maincourse->scm_coursename_en,
            'batchassessor'=> $learnerdata['batchmgmtasmtdtls_pk'],
            'staffPK'=> $learnerdata['staffinforepo_pk'],
            'batchNo' => $learnerdata['bmd_Batchno'],
            'civilNumber' => $learnerdata['sir_idnumber'],
            'name' =>  $learnerdata['sir_name_en'],
            'status' => $learnerdata['lrhd_status'],
            'kStatus' => $kassessmentstatus['rm_name_en'],
            'pStatus' => $passessmentstatus['rm_name_en'],
            'emailId' => $learnerdata['sir_emailid'],
            'age' =>  $age ,
            'gender' =>  $learnerdata['sir_gender'],
            'isknw' =>  $learnerdata['scd_isknwlasmt'],
            'ispra' =>  $learnerdata['scd_ispratasmt'],
            'kminmark' =>  $learnerdata['scd_minmarkfrknwlasmt'],
            'pminmark' =>  $learnerdata['scd_partasmtminmark'],
            'ispramark' => $learnerdata['scd_ispartasmtmark'],
            'comment'=> $learnerdata['lrhd_appdeccomments'],
            'commentBy'=> $learnerdata['lrhd_appdecby'],
            'commentOn'=>$learnerdata['lrhd_appdecon'],
            'ispraflag'=>$praflag,
            'ktotalmark' => $learnerdata['scd_totalmarkfrknwlasmt'],
            'ptotalmark' => $learnerdata['scd_partasmttotalmark'],
            'profileurl' =>$url,
            'isIVQAstaff'=> $ivqastaff,       
            'stafflince'=> $stafflince->sld_ROPlicense ? $stafflince->sld_ROPlicense : Null,   
            'regpk' =>$model->bmd_opalmemberregmst_fk,  
         ];

        return $learnerData;
    }

    public function actionSaveassessmentreport(){
        $request_body = file_get_contents('php://input');
       $data =    json_decode($request_body, true);      
        $save = \app\models\LearnerasmthdrTblQuery::assessmentreprt($data);
       if($save){
            $result = array(
               'status' => 200,
               'msg' => 'Sucess',
               'flag' => 'S',
               'data' => $save
           );
           return $result; 
       }else{
           $result = array(
                'status' => 500,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
               'returndata' => $save->getErrors()
            );
            return $result;
        }
      
    }


    public function actionUpdatelearnerstatus($id){
        $transaction = Yii::$app->db->beginTransaction();
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $id])->one();
        if($learner_update){

            $learnerhistvalue = [
                'lrhh_learnerreghrddtls_fk' => $id,
                'lrhh_opalmemberregmst_fk' => $learner_update->lrhd_opalmemberregmst_fk,
                'lrhh_batchmgmtdtls_fk' => $learner_update-> lrhd_batchmgmtdtls_fk,
                'lrhh_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk,
                'Irhh_emailid' => $learner_update->Irhd_emailid,
                'Irhh_projectmst_fk' => $learner_update->Irhd_projectmst_fk,
                'lrhh_leanerfee' => $learner_update->lrhd_learnerfee,
                'lrhh_feestatus' => $learner_update->lrhd_feestatus,
                'lrhh_paidby' => $learner_update->lrhd_paidby,
                'lrhh_operatorname' => $learner_update->lrhd_operatorname,
                'lrhh_status' => $learner_update->lrhd_status,
                'lrhh_createdon' => $learner_update->lrhd_createdon,
                'lrhh_createdby' => $learner_update->lrhd_createdby,
                'lrhh_updatedby' => $learner_update->lrhd_updatedby,
                'lrhh_updatedon' => $learner_update-> lrhd_updatedon,
                'lrhh_appdecon' => $learner_update->lrhd_appdecon,
                'lrhh_appdecby' => $learner_update->lrhd_appdecby,
                'lrhh_appdeccomments' => $learner_update->lrhd_appdeccomments,
            ];
            $learnerhist = new \app\models\LearnerreghrddtlshstyTbl($learnerhistvalue);
            if($learnerhist->save()) {
                $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
                if($learner_update->lrhd_status == 6){
                    $learner_update->lrhd_status = 7;
                }else{
                    $learner_update->lrhd_status = 9;
                }
                $learner_update->lrhd_updatedon = date('Y-m-d H:i:s');
                $learner_update->lrhd_updatedby = $userPk;
                if($learner_update->save()) {
                    $count = \app\models\LearnerreghrddtlsTbl::find()->where(['lrhd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])->andwhere(['lrhd_status' => 6])->count();
                    $batch = BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
                    $batchpk = $batch['batchmgmtdtls_pk'];  
                    $learnerpk = $learner_update['learnerreghrddtls_pk'];
                    $learnerdet = \app\models\LearnerreghrddtlsTbl::find() 
                    ->select(['lrhd_status'])
                    ->where(['learnerreghrddtls_pk'=>$learnerpk])
                    ->asArray()->one();
                    $lrnsts= $learnerdet['lrhd_status'];
                    
             

                    if($lrnsts==7){
                     \api\components\Mail::learnaccess($batchpk,$learnerpk,'movetoqc');      
                    }elseif($lrnsts==9){
                     \api\components\Mail::learnaccess($batchpk,$learnerpk,'resubmitted');   
                    }
                    if($count == 0 && $batch->bmd_status == 4){
                        $batch->bmd_reqstatus = $batch->bmd_reqstatus == 5 ? null : $batch->bmd_reqstatus;
                        $batch->bmd_status = 6;
                        if($batch->save()) {
                        }else{
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($batch->getErrors());
                            die;
                        }
                    }
                    $transaction->commit();
                    return $learner_update;
                }else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($learner_update->getErrors());
                    die;
                }
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($learnerhist->getErrors());
                die;
            }
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = "Learner doesn't exist";
            $response->setStatusCode(422, "Learner doesn't exist");
            return $response;
        }
    }

    public function actionGetassessmentreport($id){
        $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
       $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $data =  \app\models\LearnerasmthdrTbl::find()
        ->select(['*'])
        ->leftJoin('assessmentmst_tbl','AssessmentMst_PK = lasmth_AssessmentMst_FK')
        ->where('lasmth_learnerreghrddtls_fk=:id',array(':id' => $id))
        ->asArray()->all();
        $result = [];
        foreach($data as $d){
            $url = \api\components\Drive::generateUrl($d['lasmth_AsmtUpload'],$companyPk,$userPk);
            $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()->where(['memcompfiledtls_pk'=>$d['lasmth_AsmtUpload']])->one();
            $aa = [
                'data' => $d,
                'url'=>$url,
                'filetype'=>$file_info['mcfd_filetype'],
            ];
            array_push( $result, $aa);
        }
        return $result;
    }

    public function actionGetlearnerstatus(){
        return \app\models\ReferencemstTbl::find()->where(['rm_mastertype' => 15])->all();
    }
    
    public function actionSavequalitycheckstatus(){
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $request_body = file_get_contents('php://input');
            $data =	json_decode($request_body, true); 
			$learnerPK=$data['learnerPK'];
            $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $data['learnerPK']])->one();
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $learnermaster  = \app\models\LearnerasmthdrTbl::find()
            ->where(['lasmth_LearnerRegHrdDtls_FK'=>$learner_update->learnerreghrddtls_pk])->asArray()->all();
            $status = 0;
            if($data['status'] == 3 ){
                if(count($learnermaster)==2){
                    $kassessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnermaster[0]['lasmth_Status']])->one();
                    $passessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnermaster[1]['lasmth_Status']])->one();
                    if(($kassessmentstatus->rm_name_en == 'Pass' || $kassessmentstatus->rm_name_en == 'Competent') && ($passessmentstatus->rm_name_en == 'Pass' || $passessmentstatus->rm_name_en == 'Competent')){
                        $status = 10;
                    }else{
                        $status = 12;
                    }
                } else{

                    $kassessmentstatus = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $learnermaster[0]['lasmth_Status']])->one(); 
                    $status = $kassessmentstatus->rm_name_en == 'Pass' || $kassessmentstatus->rm_name_en == 'Competent'  ? 10 :  12 ;

                }
               
            } else{
                $status = 8;
            }

            if($learner_update){
                $learnerhistvalue = [
                    'lrhh_learnerreghrddtls_fk' => $data['learnerPK'],
                    'lrhh_opalmemberregmst_fk' => $learner_update->lrhd_opalmemberregmst_fk,
                    'lrhh_batchmgmtdtls_fk' => $learner_update-> lrhd_batchmgmtdtls_fk,
                    'lrhh_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk,
                    'Irhh_emailid' => $learner_update->Irhd_emailid,
                    'Irhh_projectmst_fk' => $learner_update->Irhd_projectmst_fk,
                    'lrhh_leanerfee' => $learner_update->lrhd_learnerfee,
                    'lrhh_feestatus' => $learner_update->lrhd_feestatus,
                    'lrhh_paidby' => $learner_update->lrhd_paidby,
                    'lrhh_operatorname' => $learner_update->lrhd_operatorname,
                    'lrhh_status' => $learner_update->lrhd_status,
                    'lrhh_createdon' => $learner_update->lrhd_createdon,
                    'lrhh_createdby' => $learner_update->lrhd_createdby,
                    'lrhh_updatedby' => $learner_update->lrhd_updatedby,
                    'lrhh_updatedon' => $learner_update-> lrhd_updatedon,
                    'lrhh_appdecon' => $learner_update->lrhd_appdecon,
                    'lrhh_appdecby' => $learner_update->lrhd_appdecby,
                    'lrhh_appdeccomments' => $learner_update->lrhd_appdeccomments,
                ];
                $learnerhist = new \app\models\LearnerreghrddtlshstyTbl($learnerhistvalue);
                if($learnerhist->save()) {
                    //update quality check status
                    $learner_update->lrhd_status= $status;
                    $learner_update->lrhd_appdeccomments=$data['comments'] ? $data['comments'] : null;
                    $learner_update->lrhd_appdecon=date('Y-m-d H:i:s');          
                    $learner_update->lrhd_appdecby=$userPk;          
                    if($learner_update->save()) {
                        $count = \app\models\LearnerreghrddtlsTbl::find()
                        ->orwhere(['lrhd_status' => 10])
                        ->orwhere(['lrhd_status' => 11])
                        ->orwhere(['lrhd_status' => 12])
                        ->orwhere(['lrhd_status' => 4])
                        ->orwhere(['lrhd_status' => 5])
                        ->orwhere(['lrhd_status' => 13])
                        ->groupBy('learnerreghrddtls_pk')
                        ->andwhere(['lrhd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])
                        ->count();
                        $learnercount =  \app\models\LearnerreghrddtlsTbl::find()->where(['lrhd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])->count();
                        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
                        if($count == $learnercount && $batch->bmd_status == 6){
                            $batch->bmd_status = 8;
                            $batch->save();
                        }
                        $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$batch->bmd_standardcoursedtls_fk])->one();
                        $standardcoursemst = \app\models\StandardcoursemstTbl::find()->where(['standardcoursemst_pk'=>$standardcourse->scd_standardcoursemst_fk])->one();
                        $staffinfo = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk'=>$learner_update->lrhd_staffinforepo_fk])->one();
                        $course = \app\models\CoursecategorymstTbl::find()->where(['coursecategorymst_pk' => $standardcourse->scd_subcoursecategorymst_fk])->one();
                        $title = '';
                        $scoures = null;
                        if($course->ccm_coursecategorymst_pk == Null){
                            $title = $course->ccm_catname_en;
                        }else{
                            $scoures = \app\models\CoursecategorymstTbl::find()->where(['coursecategorymst_pk' => $course->ccm_coursecategorymst_pk])->one();
                            $title = $scourse->ccm_catname_en;
                        }
                        $subtitle = $scoures == null ? null : $course->ccm_catname_en;
                        if($learner_update->lrhd_status == 10){
                            $expiryDate = null;
                            $assessmentdate = \app\models\BatchmgmtasmthdrTbl::find()->select(['batchmgmtasmthdr_tbl.bmah_assessmentdate'])
                            ->where(['bmah_batchmgmtdtls_fk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
                            
                            if($standardcourse->scd_iscertexpiry == 1){
    
                                if($standardcourse->scd_iscertexpirybasedonmarks == 1){
                                   
                                    $markprecetage = 0;
                                    foreach($learnermaster as $item){
                                        
                                        $markprecetage = $markprecetage + $item['lasmth_percentage'];
                                    }
    
                                    $markprecetageava = $markprecetage / count($learnermaster);
                                    foreach($standardcourse->scd_markpercent as $item){
                                        if($item['max'] >= $markprecetageava && $item['min'] <= $markprecetageava){
                                            $expiryDate = date('Y-m-d', strtotime(date('Y-m-d'). ' + '. $item['expinmonth'].' months'));
                                        }
                                    }
                                }else{
    
                                    $expiryDate = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$standardcourse->scd_certexpiryinmonths.' months'));
                                }
                            }
                          
                            // $learnercard = \app\models\LearnercarddtlsTbl::find()->where(['lcd_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk])->asArray()->all();
                            // $verification = '';
                            // if(count($learnercard) == 0){
                            //     $flag = false;
                            //     while(!$flag){
                            //         $verification = 'LC'.substr(sha1(time()), 0, 8);
                            //         $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                            //         if($isexist == 0){
                            //             $flag = true;
                            //         }
                            //     }
                            // }else{
                                
                            //     $verification = $learnercard[0]['lcd_verificationno'];
                            // }
    
                            $learnercard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $learner_update->lrhd_staffinforepo_fk])->andwhere(['=','lcd_standardcoursemst_fk', $standardcoursemst->standardcoursemst_pk])
                            ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
    
                            $verification = '';
                            if(count($learnercard) == 0){
                                $learnercard1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk',  $learner_update->lrhd_staffinforepo_fk])
                                ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
                                if(count($learnercard1) == 0){
                                    $flag = false;
                                    while(!$flag){
                                        $verification = 'LC'.substr(sha1(time()), 0, 8);
                                        $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                                        if($isexist == 0){
                                            $flag = true;
                                        }
                                    }
                                }else{
                                    $verification = $learnercard1[0]['lcd_verificationno'];
                                }
                            }else{
                                $verification = $learnercard[0]['lcd_verificationno'];
                            }
    
                            
                            $activelearnercard = \app\models\LearnercarddtlsTbl::find()
                            ->orwhere(['lcd_status' => 1])
                            ->orwhere(['lcd_status' => 3])
                            ->andwhere(['lcd_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk])
                            ->asArray()->all();
        
                            
                            $stafflince = \app\models\StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk'=>$learner_update->lrhd_staffinforepo_fk])->one();
                            
                            // $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
                            // $url = \api\components\Drive::generateUrl($d['lasmth_AsmtUpload'],$companyPk,$userPk);
    
                            $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
                            ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
                            ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
                            ->where(['memcompfiledtls_pk'=>$staffinfo->sir_photo])->asArray()->one();
                            $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
                            $userPkf = $file_info['mcfd_uploadedby'];
                            $img_name = $file_info['mcfd_sysgenerfilename'];
                            $org_name = $file_info['mcfd_origfilename'];
                            $phy_filepath = $file_info['fm_phyfilepath'];
                            $uploadPath = \Yii::$app->params['uploadPath'];
                            $srcDirectory=Yii::$app->params['srcDirectory']; 
                            $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
                            $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;
    
                            $alreadyexistinglearnercard = \app\models\LearnercarddtlsTbl::find()
                            ->where(['lcd_status' => 1])
                            ->orwhere(['lcd_status' => 2])
                            ->andwhere(['lcd_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk])
                            ->andwhere(['lcd_standardcoursedtls_fk' => $batch->bmd_standardcoursedtls_fk])
                            ->one();
                            
                            
                            $learnercardactive = \app\models\LearnercarddtlsTbl::find()
                            ->where(['lcd_status'=>1])
                            ->orwhere(['lcd_status'=>2])
                            ->andwhere(['lcd_isprinted'=>1])
                            ->andwhere(['lcd_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk])
                            ->andwhere(['lcd_standardcoursemst_fk'=>$standardcourse->scd_standardcoursemst_fk]);
    
                            if($alreadyexistinglearnercard){
                                $learnercardactive->andwhere(['!=','learnercarddtls_pk', $alreadyexistinglearnercard->learnercarddtls_pk]);
                            }
    
                            $learnercardactive =  $learnercardactive->orderBy(['lcd_standardcoursedtls_fk'=>SORT_ASC])->asArray()->all();
    
                            // print_r($learnercardactive);
                            // exit;
                            
                            $category = [];
                            $expiryDatesub = [];
                            foreach($learnercardactive as $item){
                                $aa = [
                                    'cate' => $item['lcd_subcategoryname'],
                                    'id' => $item['lcd_standardcoursedtls_fk'],
                                ];
                                array_push($category, $aa);
                                if($item['lcd_cardexpiry']){
                                    $bb = [
                                        'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                                        'id' => $item['lcd_standardcoursedtls_fk'],
                                    ];
                                    array_push($expiryDatesub,$bb);
                                } else{
                                    $bb = [
                                        'date' => 'N/A',
                                        'id' => $item['lcd_standardcoursedtls_fk'],
                                    ];
                                    array_push($expiryDatesub,$bb);
                                }
                            }
                            $aa1 = [
                                'cate' => $subtitle,
                                'id' => $batch->bmd_standardcoursedtls_fk,
                            ];
                            array_push($category, $aa1);
                            if($expiryDate){
                                $bb = [
                                    'date' => date("d-m-Y", strtotime( $expiryDate)),
                                    'id' => $batch->bmd_standardcoursedtls_fk,
                                ];
                                array_push($expiryDatesub,$bb);
                            } else{
                                $bb = [
                                    'date' => 'N/A',
                                    'id' => $batch->bmd_standardcoursedtls_fk,
                                ];
                                array_push($expiryDatesub,$bb);
    
                            }
                            usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                            usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                            $titlesub = $scoures == null ? null : $course->ccm_catname_en;
                            if($titlesub == 'Heavy Vehicle'){
                                $k = 0;
                                foreach($category as $item){
                                    if($item['cate'] == 'Light Vehicle'){
                                        $expiryDatesub[$k]['date'] = $expiryDate ? date("d-m-Y", strtotime($expiryDate)) : 'N/A';
                                    }
                                    $k++;
                                }
                                
                            }
                            // print_r($category);
                            // print_r($expiryDatesub);
                            // exit;
    
                            $userdata=[
                                'name'=>$staffinfo->sir_name_en ? $staffinfo->sir_name_en : 'Nil',
                                'imgurl' =>$target_path,
                                'issuedata'=> date('d-m-Y'),   
                                'licNo'=> $stafflince->sld_ROPlicense ? $stafflince->sld_ROPlicense : 'Nil',
                                'cattable'=>$category,
                                'expirytable'=>$expiryDatesub,
                                'title' => $standardcoursemst->standardcoursemst_pk != 1 ? $standardcoursemst->scm_coursename_en : '',
                                'nolice' => $standardcoursemst->standardcoursemst_pk == 1 ? 1 : 0,
                                'civilno'=> $staffinfo->sir_idnumber,
                                'verificationcode'=> $verification,
                            ];
                            // echo $img_name.'</br>';
                            // echo $target_path;
                          
                            $regPk = $batch->bmd_opalmemberregmst_fk;
                            $filename = 'card_'.$standardcoursemst->standardcoursemst_pk.'_'.$learner_update->lrhd_staffinforepo_fk.'_'.$learner_update->learnerreghrddtls_pk.'_print.pdf';
                            $path = "../api/web/learnercard/$regPk/";
    
                           
                            
                            if(!is_dir($path)){
                                mkdir($path, 0777, true);
                            }
        
                             //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
                             $qrCode = (new QrCode(''))
                             ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
                             $qrCode->writeFile(__DIR__ . '/code.png'); 
                             $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
                             $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
                             //PDF generate
                             $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                             //$mpdf->SetProtection(array());
                             $mpdf->WriteHTML($this->renderPartial('../../views/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                             $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
                            $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";
                            //VIEW FILE GENERATE
                            $filenameview = 'card_'.$standardcoursemst->standardcoursemst_pk.'_'.$learner_update->lrhd_staffinforepo_fk.'_'.$learner_update->learnerreghrddtls_pk.'_view.pdf';
    
                            $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                            $mpdfview->SetProtection(array());
                            $mpdfview->WriteHTML($this->renderPartial('../../views/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                            $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
                            $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
    
                           
                            
                            if($titlesub == 'Heavy Vehicle'){
                                $carddata = \app\models\LearnercarddtlsTbl::find()
                                ->orwhere(['lcd_status' => 1])
                                ->orwhere(['lcd_status' => 2])
                                ->andwhere(['lcd_subcategoryname' => 'Light Vehicle'])
                                ->andwhere(['lcd_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk])
                                ->one();
                                
                                if($carddata){
                                    $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($carddata->learnercarddtls_pk);
                                    $lightcard1 = [
                                        'lcd_staffinforepo_fk' => $carddata->lcd_staffinforepo_fk,
                                        'lcd_batchmgmtdtls_fk' => $carddata->lcd_batchmgmtdtls_fk,
                                        'lcd_learnerreghrddtls_fk' => $carddata->lcd_learnerreghrddtls_fk,
                                        'lcd_standardcoursemst_fk' => $carddata->lcd_standardcoursemst_fk,
                                        'lcd_standardcoursedtls_fk' => $carddata->lcd_standardcoursedtls_fk,
                                        'lcd_categoryname' => $carddata->lcd_categoryname,
                                        'lcd_subcategoryname' => $carddata->lcd_subcategoryname,
                                        'lcd_isprinted' =>  $carddata->lcd_isprinted,
                                        'lcd_serialno' => $carddata->lcd_serialno,
                                        'lcd_cardexpiry' => $expiryDate ? $expiryDate : null,
                                        'lcd_cardissuedate' => date('Y-m-d'),
                                        'lcd_plaincard' => $carddata->lcd_isprinted == 1 ?   $url : null,
                                        'lcd_viewcardpath' => $carddata->lcd_isprinted == 1 ?  $viewurl : null,
                                        'lcd_verificationno' => $verification,
                                        'lcd_status' => $expiryDate ? (strtotime($expiryDate) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                        'lcd_createdon' => date('Y-m-d H:i:s'),
                                        'lcd_createdby' => $userPk,
                                    ];
                                    $ligncard = new \app\models\LearnercarddtlsTbl($lightcard1);
                                    if($ligncard->save()){
                                        
                                    }else{
                                        $transaction->rollBack();
                                        echo "<pre>";
                                        print_r($ligncard->getErrors());
                                        die;
                                    }
                                }
                            }
    
                           
                            if($alreadyexistinglearnercard){
                                //$card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($alreadyexistinglearnercard->learnercarddtls_pk);
    
                                $alreadyexistinglearnercard->lcd_status = 4;
                                if($alreadyexistinglearnercard->save()){
        
                                    //add new learner card record
                                    $lcard = new \app\models\LearnercarddtlsTbl;
                                    $lcard->lcd_staffinforepo_fk = $learner_update->lrhd_staffinforepo_fk;
                                    $lcard->lcd_batchmgmtdtls_fk = $batch->batchmgmtdtls_pk;
                                    $lcard->lcd_learnerreghrddtls_fk = $learner_update->learnerreghrddtls_pk;
                                    $lcard->lcd_standardcoursemst_fk = $standardcourse->scd_standardcoursemst_fk;
                                    $lcard->lcd_standardcoursedtls_fk = $batch->bmd_standardcoursedtls_fk;
                                    $lcard->lcd_categoryname = $standardcoursemst->scm_coursename_en;
                                    $lcard->lcd_subcategoryname = $scoures == null ? null : $course->ccm_catname_en;
                                    $lcard->lcd_isprinted = $standardcourse->scd_printfinalpermitcard == 1 ? 1 : 2;
                                    $lcard->lcd_serialno = null;
                                    $lcard->lcd_cardexpiry =  $expiryDate ? $expiryDate : null ;
                                    $lcard->lcd_cardissuedate = date('Y-m-d');
                                    $lcard->lcd_plaincard = $standardcourse->scd_printfinalpermitcard == 1 ? $url : null ;
                                    $lcard->lcd_viewcardpath = $standardcourse->scd_printfinalpermitcard == 1 ? $viewurl : null ;
                                    $lcard->lcd_verificationno = $verification;
                                    $lcard->lcd_status = 1;
                                    $lcard->lcd_printedon = null;
                                    $lcard->lcd_printedby = null;
                                    $lcard->lcd_createdon = date('Y-m-d H:i:s');
                                    $lcard->lcd_createdby = $userPk;
                                    
                                    if($lcard->save()){
                
                                    }
                                    else{
                                        $transaction->rollBack();
                                        echo "<pre>2";
                                        print_r($lcard->getErrors());
                                        die;
                                    }
                                }
                                else{
                                    $transaction->rollBack();
                                    echo "<pre>3";
                                    print_r($alreadyexistinglearnercard->getErrors());
                                    die;
                                }
    
                            }
                            else{
                                  //add new learner card record
                                  $lcard = new \app\models\LearnercarddtlsTbl;
                                  $lcard->lcd_staffinforepo_fk = $learner_update->lrhd_staffinforepo_fk;
                                  $lcard->lcd_batchmgmtdtls_fk = $batch->batchmgmtdtls_pk;
                                  $lcard->lcd_learnerreghrddtls_fk = $learner_update->learnerreghrddtls_pk;
                                  $lcard->lcd_standardcoursemst_fk = $standardcourse->scd_standardcoursemst_fk;
                                  $lcard->lcd_standardcoursedtls_fk = $batch->bmd_standardcoursedtls_fk;
                                  $lcard->lcd_categoryname = $standardcoursemst->scm_coursename_en;
                                  $lcard->lcd_subcategoryname = $scoures == null ? null : $course->ccm_catname_en;
                                  $lcard->lcd_isprinted = $standardcourse->scd_printfinalpermitcard == 1 ? 1 : 2;
                                  $lcard->lcd_serialno = null;
                                  $lcard->lcd_cardexpiry = $expiryDate ? $expiryDate : null ;
                                  $lcard->lcd_cardissuedate = date('Y-m-d');
                                  $lcard->lcd_plaincard = $standardcourse->scd_printfinalpermitcard == 1 ? $url : null ;
                                  $lcard->lcd_viewcardpath = $standardcourse->scd_printfinalpermitcard == 1 ? $viewurl : null ;
                                  $lcard->lcd_verificationno = $verification;
                                  $lcard->lcd_status = 1;
                                  $lcard->lcd_printedon = null;
                                  $lcard->lcd_printedby = null;
                                  $lcard->lcd_createdon = date('Y-m-d H:i:s');
                                  $lcard->lcd_createdby = $userPk;
                                  
                                  if($lcard->save()){
              
                                  }
                                  else{
                                      $transaction->rollBack();
                                      echo "<pre>5";
                                      print_r($lcard->getErrors());
                                      die;
                                  }
                            }
                        }
                        if($data['status'] == 3 ){
                            //save feedback for learner
                            $feedbackmst = \app\models\FeedbackmstTbl::find()
                            ->where(['fdbkm_standardcoursedtls_fk'=>null])->one();
                            if($feedbackmst == null){
                                $feedbackmst = \app\models\FeedbackmstTbl::find()
                                ->where(['fdbkm_standardcoursedtls_fk'=>$standardcourse->standardcoursedtls_pk])->one();
                            }
                            $learnerfeedback = new  \app\models\LearnerfdbkhdrTbl;
                            $learnerfeedback->lfh_LearnerRegHrdDtls_FK =  $learner_update->learnerreghrddtls_pk;
                            $learnerfeedback->lfh_feedbackmst_fk =  $feedbackmst->FeedbackMst_PK;
                            $learnerfeedback->lfh_FdbbkStatus = 1;
                            $learnerfeedback->lfh_Comments = null;
                            $learnerfeedback->lfh_submittedOn = null;
                            $learnerfeedback->lfh_SubmittedVia = null;
                            $learnerfeedback->save();
                            if($learnerfeedback->save()){
        
                            }
                            else{
                                $transaction->rollBack();
                                echo "<pre>";
                                print_r($learnerfeedback->getErrors());
                                die;
                            }
                        }
                            $learnerpk=$data['learnerPK'];
                           $batchpk=$batch['batchmgmtdtls_pk'];
                 
                        //assesssment center name
                        $assessor = \app\models\BatchmgmtasmtdtlsTbl::find() 
                                ->select(['omrm_tpname_en','omrm_tpname_ar'])
                                ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk')
                                ->leftJoin('opalusermst_tbl','bmah_assessor = opalusermst_pk')
                                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                                ->where(['bmad_learnerreghrddtls_fk'=>$learnerPK])
                                ->asArray()->all();
                         
                        $transaction->commit();
                            if($status == 10){
                            \api\components\Mail::sendLearnerFeedback($learnerPK,$batchpk,'passedlearnerFeedback'); //5.1
                            }else if($status == 12){
                            \api\components\Mail::sendLearnerFeedback($learnerPK,$batchpk,'faillearnerFeedback');//5.2
                            }
                    
                            if($status == 8){
                                \api\components\Mail::learnaccess($batchpk,$learnerpk,'qcdeclined');  
                            }
                    
                    $learnerdet = \app\models\LearnerreghrddtlsTbl::find() 
                    ->select(['lrhd_status'])
                    ->where(['lrhd_batchmgmtdtls_fk'=>$batchpk])
                    ->asArray()->one();
                    $lrnsts= $learnerdet['lrhd_status'];
                    
                 
                    

                      
                        return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Quality check status updated successfully" ];
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($learner_update->getErrors());
                        die;
                    }
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($learnerhist->getErrors());
                    die;
                }

            }else{
                $response = Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = "Learner doesn't exist";
                $response->setStatusCode(422, "Learner doesn't exist");
                return $response;
            }
        }catch(Exception $e){
            echo "<pre>";
            print_r($e->getMessage());
            $transaction->rollBack();
        }
    }

    public function actionGetbatchdetails($batchID){
        $model = BatchmgmtdtlsTbl::find()->where(['bmd_Batchno'=>$batchID])->one();
        $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$model->bmd_standardcoursedtls_fk])->one();
        $batchType = \app\models\BatchmgmtdtlsTblQuery::referenceType($model->bmd_batchtype);
        $appinstinfo=\app\models\AppinstinfomainTbl::find()->where(['appinstinfomain_pk' =>$model->bmd_appinstinfomain_fk])->one();
        $assessmenttime = \app\models\BatchmgmtasmthdrTbl::find()->where(['bmah_batchmgmtdtls_fk' => $model->batchmgmtdtls_pk])->one();
        $company = $model->getBmdOpalmemberregmstFk()->one();
        $city = \app\models\OpalcitymstTbl::find()->where(['opalcitymst_pk'=>$appinstinfo->appiim_citymst_fk])->one();
        if($appinstinfo->appiim_officetype == '1'){
            $citymain = \app\models\AppcompanydtlsmainTbl::find()->where(['acdm_applicationdtlsmain_fk'=>$appinstinfo->appiim_applicationdtlsmain_fk])->one();
            $city =\app\models\OpalcitymstTbl::find()->where(['opalcitymst_pk'=> $citymain->acdm_citymst_fk])->one();
        }
        $subcateg = \app\models\CoursecategorymstTbl::find()->where(['coursecategorymst_pk'=>$standardcourse->scd_subcoursecategorymst_fk])->one();
        $coursecat = \app\models\StandardcoursemstTbl::find()->where(['standardcoursemst_pk'=>$standardcourse->scd_standardcoursemst_fk])->one();
        $lang = \app\models\ReferencemstTbl::find()->where(['referencemst_pk' => $model->bmd_traininglang])->one();
      
        $batchData = [
            'batchNo' =>  $model->bmd_Batchno,
            'batchPk' =>  $model->batchmgmtdtls_pk,
            'assType' =>  $coursecat->scm_assessmentin,
            'coursepk' =>  $model->bmd_standardcoursedtls_fk,
            'subcate' =>  $standardcourse->scd_subcoursecategorymst_fk,
            'lang' =>  $model->bmd_traininglang,
            'wilayat' =>  $model->bmd_citymst_fk,
            'batchType'=> $batchType['rm_name_en'],
            'assessmentcentre'=>$company->opalmemberregmst_pk,
            'branchName'=>$company?$company->omrm_tpname_en:null,
            'branchName_ar'=>$company?$company->omrm_tpname_ar:null,
            'status' => $model->bmd_status,
            'totalLearners'=> $appinstinfo->appiim_noofcurlearners,
            'total'=> $appinstinfo->appiim_maxcapacity,
            'aDate'=> $assessmenttime->bmah_assessmentdate,
            'aStartTime'=>$assessmenttime->bmah_assessstarttime,
            'aendTime'=>$assessmenttime->bmah_assessendtime,
            'city_en'=>$city->ocim_cityname_en,
            'city_ar'=>$city->ocim_cityname_ar,
            'elang'=>$lang->rm_name_en,
            'alang'=>$lang->rm_name_ar,
            'cat_en'=>$subcateg->ccm_catname_en,
            'cat_ar'=>$subcateg->ccm_catname_ar,
        ];
        return $batchData;
    }

    public function actionGetassessordetails($batchNo){
        $batch = BatchmgmtdtlsTbl::find()->where(['bmd_Batchno'=>$batchNo])->one();
            
     
        $model = \app\models\BatchmgmtasmthdrTbl::find()
                ->select(['a.opalusermst_pk as assesorpk','c.opalusermst_pk as ivqastaffpk','a.oum_firstname as assessorname','c.oum_firstname as ivstaffname','b.opalmemberregmst_pk as assessmentcentre','b.omrm_companyname_en as assessmentcentrename'])
                ->leftJoin('opalusermst_tbl a','a.opalusermst_pk = bmah_assessor')
                ->leftJoin('opalmemberregmst_tbl b','a.oum_opalmemberregmst_fk = b.opalmemberregmst_pk')
                 ->leftJoin('opalusermst_tbl c','c.opalusermst_pk = bmah_ivqastaff')
                ->leftJoin('opalmemberregmst_tbl d','c.oum_opalmemberregmst_fk = d.opalmemberregmst_pk')
                ->where(['bmah_batchmgmtdtls_fk' => $batch->batchmgmtdtls_pk])
                ->asArray()
                ->all();
       
        if($model)
        {
             return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model ];
        }
        
        return [ 'msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => '' ];       
    }
    
    public function actionPrintcard($serialno = 1, $learnerid){
        $transaction = Yii::$app->db->beginTransaction();
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $learnerid])->one();
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
        $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$batch->bmd_standardcoursedtls_fk])->one();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        if($learner_update->lrhd_status==11){
            $learnercard = \app\models\LearnercarddtlsTbl::find()
            ->orwhere(['lcd_status' => 1])
            ->orwhere(['lcd_status' => 2])
            ->andwhere(['lcd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])
            ->andwhere(['lcd_learnerreghrddtls_fk' => $learnerid])
            ->andwhere(['lcd_standardcoursedtls_fk' => $batch->bmd_standardcoursedtls_fk])
            ->one();
            $newlearnercard = $learnercard;
            if($learnercard){
                $card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($learnercard->learnercarddtls_pk);
                if($card){
                    $lcard = new \app\models\LearnercarddtlsTbl;
                    $lcard->lcd_staffinforepo_fk = $learnercard->lcd_staffinforepo_fk;
                    $lcard->lcd_batchmgmtdtls_fk =$learnercard->lcd_batchmgmtdtls_fk;
                    $lcard->lcd_learnerreghrddtls_fk =$learnercard->lcd_learnerreghrddtls_fk;
                    $lcard->lcd_standardcoursemst_fk = $learnercard->lcd_standardcoursemst_fk;
                    $lcard->lcd_standardcoursedtls_fk = $learnercard->lcd_standardcoursedtls_fk;
                    $lcard->lcd_categoryname =$learnercard->lcd_categoryname;
                    $lcard->lcd_subcategoryname = $learnercard->lcd_subcategoryname;
                    $lcard->lcd_isprinted = $learnercard->lcd_isprinted;
                    $lcard->lcd_serialno = $learnercard->lcd_serialno;
                    $lcard->lcd_cardexpiry =  $learnercard->lcd_cardexpiry;
                    $lcard->lcd_cardissuedate = $learnercard->lcd_cardissuedate;
                    $lcard->lcd_plaincard = $learnercard->lcd_plaincard;//need to upload pdf and save.
                    $lcard->lcd_viewcardpath = $learnercard->lcd_viewcardpath;//need to upload pdf and save.
                    $lcard->lcd_verificationno = $learnercard->lcd_verificationno;
                    $lcard->lcd_status = $learnercard->lcd_cardexpiry ? (strtotime($learnercard->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1;
                    $lcard->lcd_createdon = $learnercard->lcd_createdon;
                    $lcard->lcd_createdby = $learnercard->lcd_createdby;
                    $lcard->lcd_printedon = date('Y-m-d H:i:s');
                    $lcard->lcd_printedby = $userPk;
                    if($lcard->save()){
                        // echo $newlearnercard->lcd_status;
                        // exit;
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";return $lcard->getErrors();exit;
                    }
                }else{
                    $transaction->rollBack();
                    echo "<pre>";return $card->getErrors();exit;
                }
            }

        }
        if($learner_update->lrhd_status==10){
            $learnercard = \app\models\LearnercarddtlsTbl::find()
            ->orwhere(['lcd_status' => 1])
            ->orwhere(['lcd_status' => 1])
            ->where(['lcd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])
            ->andwhere(['lcd_learnerreghrddtls_fk' => $learnerid])
            ->andwhere(['lcd_standardcoursedtls_fk' => $batch->bmd_standardcoursedtls_fk])
            ->one();
            if($learnercard){

                $learnercard->lcd_printedon = date('Y-m-d H:i:s');
                $learnercard->lcd_printedby = $userPk;
                if($learnercard->save()){
                    $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                    $query = \Yii::$app->db->createCommand("INSERT INTO learnerreghrddtlshsty_tbl (lrhh_learnerreghrddtls_fk,lrhh_opalmemberregmst_fk,lrhh_batchmgmtdtls_fk, lrhh_staffinforepo_fk, Irhh_emailid, Irhh_projectmst_fk,lrhh_leanerfee, lrhh_feestatus, lrhh_paidby, lrhh_operatorname, lrhh_status, lrhh_createdon, lrhh_createdby, lrhh_updatedby,lrhh_updatedon,
                    lrhh_appdecon,lrhh_appdecby,lrhh_appdeccomments ) VALUES (:lrhh_learnerreghrddtls_fk,:lrhh_opalmemberregmst_fk,:lrhh_batchmgmtdtls_fk, :lrhh_staffinforepo_fk, :Irhh_emailid,
                    :Irhh_projectmst_fk, :lrhh_leanerfee, :lrhh_feestatus, :lrhh_paidby, :lrhh_operatorname, :lrhh_status, :lrhh_createdon, :lrhh_createdby, :lrhh_updatedby, :lrhh_updatedon,
                    :lrhh_appdecon, :lrhh_appdecby, :lrhh_appdeccomments)")
                    ->bindValue(':lrhh_learnerreghrddtls_fk', $learnerid)
                    ->bindValue(':lrhh_opalmemberregmst_fk', $learner_update->lrhd_opalmemberregmst_fk)
                    ->bindValue(':lrhh_batchmgmtdtls_fk', $learner_update-> lrhd_batchmgmtdtls_fk)
                    ->bindValue(':lrhh_staffinforepo_fk', $learner_update->lrhd_staffinforepo_fk)
                    ->bindValue(':Irhh_emailid',  $learner_update->Irhd_emailid)
                    ->bindValue(':Irhh_projectmst_fk', $learner_update->Irhd_projectmst_fk)
                    ->bindValue(':lrhh_feestatus', $learner_update->lrhd_feestatus)
                    ->bindValue(':lrhh_paidby', $learner_update->lrhd_paidby)
                    ->bindValue(':lrhh_operatorname', $learner_update->lrhd_operatorname)
                    ->bindValue(':lrhh_status', $learner_update->lrhd_status)
                    ->bindValue(':lrhh_leanerfee', $learner_update->lrhd_learnerfee)
                    ->bindValue(':lrhh_createdon', $learner_update->lrhd_createdon)
                    ->bindValue(':lrhh_createdby', $learner_update->lrhd_createdby)
                    ->bindValue(':lrhh_updatedby', $learner_update->lrhd_updatedby)
                    ->bindValue(':lrhh_updatedon', $learner_update-> lrhd_updatedon)
                    ->bindValue(':lrhh_appdecon', $learner_update->lrhd_appdecon)
                    ->bindValue(':lrhh_appdecby', $learner_update->lrhd_appdecby)
                    ->bindValue(':lrhh_appdeccomments', $learner_update->lrhd_appdeccomments)
                    ->execute();
                    $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                    if($query) {
                        $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                        $query1 = \Yii::$app->db->createCommand("UPDATE learnerreghrddtls_tbl SET lrhd_status = :lrhd_status,lrhd_updatedby = :lrhd_updatedby, lrhd_updatedon = :lrhd_updatedon WHERE learnerreghrddtls_pk = $learnerid ")
                        ->bindValue(':lrhd_status', 11)
                        ->bindValue(':lrhd_updatedby', $userPk)
                        ->bindValue(':lrhd_updatedon', date('Y-m-d H:i:s'))
                        ->execute();
                        $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                        if($query1) {
                            $count = \app\models\LearnerreghrddtlsTbl::find()
                                ->where(['lrhd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])
                                ->orwhere(['lrhd_status' => 10])
                                ->orwhere(['lrhd_status' => 11])
                                ->orwhere(['lrhd_status' => 12])
                                ->orwhere(['lrhd_status' => 4])
                                ->orwhere(['lrhd_status' => 5])
                                ->orwhere(['lrhd_status' => 13])
                                ->count();
                                $learnercount =  \app\models\LearnerreghrddtlsTbl::find()->where(['lrhd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])->count();
                                $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
                                if($count == $learnercount && $batch->bmd_status == 6){
                                    $batch->bmd_status = 8;
                                    $batch->save();
                                }
                            
                        }else{
                            $transaction->rollBack();
                            echo "<pre>";
                            print_r($learner_update->getErrors());
                            die;
                        }
                    }
                    else{
                        $transaction->rollBack();
                        echo "<pre>";return $learnerhist->getErrors();exit;
                    }
                }else{
                    $transaction->rollBack();
                    echo "<pre>";return $learnercard->getErrors();exit;
                }
            }               
        }
        $learnercard = \app\models\LearnercarddtlsTbl::find()
        ->orwhere(['lcd_status' => 1])
        ->orwhere(['lcd_status' => 2])
        ->andwhere(['lcd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])
        ->andwhere(['lcd_learnerreghrddtls_fk' => $learnerid])
        ->andwhere(['lcd_standardcoursedtls_fk' => $batch->bmd_standardcoursedtls_fk])
        ->one();
        if($learnercard){
            $regPk = $batch->bmd_opalmemberregmst_fk;
            $path = "../api/web/learnercard/$regPk/lcd_plaincard";
            $url =$learnercard['lcd_plaincard'];
            $path = strstr($url, 'web');
            if (file_exists($path)) {
            // echo "<br>The File $path Exists";
            } else {
            // echo "<br>The File $path Do Not Exist";
                $response = Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = "The file doesn't exist, so please try again later to download the file.";
                $response->setStatusCode(422, "The file doesn't exist, so please try again later to download the file.");
                return $response;
            }
            
            $transaction->commit();
            return [ 'msg' => 'Sucessfull', 'status' => 1, 'flag' => 'S', 'data' => $url ];     
        }else {
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = "Learner card doesn't exist";
            $response->setStatusCode(422, "Learner card doesn't exist.");
            return $response;
        }
    } 
    
    public function actionViewcard($learnerid){
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $learnerid])->one();
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner_update->lrhd_batchmgmtdtls_fk])->one();
        $learnercard = \app\models\LearnercarddtlsTbl::find()
        ->orwhere(['lcd_status' => 1])
        ->orwhere(['lcd_status' => 2])
        ->andwhere(['lcd_batchmgmtdtls_fk' => $learner_update->lrhd_batchmgmtdtls_fk])
        ->andwhere(['lcd_learnerreghrddtls_fk' => $learnerid])
        ->andwhere(['lcd_standardcoursedtls_fk' => $batch->bmd_standardcoursedtls_fk])
        ->one();
        if($learnercard){
            $url = $learnercard['lcd_viewcardpath'];
            $path = strstr($url, 'web');
            if (file_exists($path)) {
               // echo "<br>The File $path Exists";
            } else {
               // echo "<br>The File $path Do Not Exist";
                $response = Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = "The file doesn't exist, so please try again later to download the file.";
                $response->setStatusCode(422, "The file doesn't exist, so please try again later to download the file.");
                return $response;
            }
            return [ 'msg' => 'Sucessfull', 'status' => 1, 'flag' => 'S', 'data' => $url ]; 
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = "Learner card doesn't exist";
            $response->setStatusCode(422, "Learner card doesn't exist");
            return $response;
        }
    } 

    public function actionGetuser($userid){
        return \app\models\OpalusermstTbl::find()->where(['opalusermst_pk'=>$userid])->one();
    }

    public function actionRegistrationcancel($id){
        $transaction = Yii::$app->db->beginTransaction();
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $id])->one();
        $learnerhistvalue = [
            'lrhh_learnerreghrddtls_fk' => $id,
            'lrhh_opalmemberregmst_fk' => $learner_update->lrhd_opalmemberregmst_fk,
            'lrhh_batchmgmtdtls_fk' => $learner_update-> lrhd_batchmgmtdtls_fk,
            'lrhh_staffinforepo_fk' => $learner_update->lrhd_staffinforepo_fk,
            'Irhh_emailid' => $learner_update->Irhd_emailid,
            'Irhh_projectmst_fk' => $learner_update->Irhd_projectmst_fk,
            'lrhh_leanerfee' => $learner_update->lrhd_learnerfee,
            'lrhh_feestatus' => $learner_update->lrhd_feestatus,
            'lrhh_paidby' => $learner_update->lrhd_paidby,
            'lrhh_operatorname' => $learner_update->lrhd_operatorname,
            'lrhh_status' => $learner_update->lrhd_status,
            'lrhh_createdon' => $learner_update->lrhd_createdon,
            'lrhh_createdby' => $learner_update->lrhd_createdby,
            'lrhh_updatedby' => $learner_update->lrhd_updatedby,
            'lrhh_updatedon' => $learner_update-> lrhd_updatedon,
            'lrhh_appdecon' => $learner_update->lrhd_appdecon,
            'lrhh_appdecby' => $learner_update->lrhd_appdecby,
            'lrhh_appdeccomments' => $learner_update->lrhd_appdeccomments,
        ];
        $learnerhist = new \app\models\LearnerreghrddtlshstyTbl($learnerhistvalue);
        if($learnerhist->save()) {
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $learner_update->lrhd_status = 13;
            $learner_update->lrhd_updatedon = date('Y-m-d H:i:s');
            $learner_update->lrhd_updatedby = $userPk;
            if($learner_update->save()) {
                $transaction->commit();
                return $learner_update;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($learner_update->getErrors());
                die;
            }
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($learnerhist->getErrors());
            die;
        }
    }

    public function actionDeletelearner($id){
        $transaction = Yii::$app->db->beginTransaction();
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $id])->one();
        $hisdata = $learner_update;
        $hisdata->learnerreghrddtls_pk = Null;
        $learnerhist = \app\models\LearnerreghrddtlshstyTbl::movetohistory($learner_update);
        if($learnerhist) {
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $thydata = \app\models\BatchmgmtthydtlsTbl::find()->where(['bmtd_learnerreghrddtls_fk' => $id])->one();
            if($thydata){
                $thytrianer = \app\models\BatchmgmtthyhdrTbl::find()->where(['batchmgmtthyhdr_pk' => $thydata->bmtd_batchmgmtthyhdr_fk])->one();
                $thytrianer->bmth_status = 1;
                $thytrianer->bmth_updatedon = date('Y-m-d H:i:s');
                $thytrianer->bmth_updatedby = $userPk;
                if($thytrianer->save()) {
                    if($thydata->delete()) {
                        
                    }
                    else{
                        echo "<pre>";
                        $transaction->rollBack();
                        print_r($thydata->getErrors());
                        die;
                    }
                }
                else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($thytrianer->getErrors());
                    die;
                }
            }
            $pradata = \app\models\BatchmgmtpractdtlsTbl::find()->where(['bmpd_learnerreghrddtls_fk' => $id])->one();
            if($pradata){
                $pratrianer = \app\models\BatchmgmtpracthdrTbl::find()->where(['batchmgmtpracthdr_pk' => $pradata->bmpd_batchmgmtpracthdr_fk])->one();
                $pratrianer->bmph_status = 1;
                $pratrianer->bmph_updatedon = date('Y-m-d H:i:s');
                $pratrianer->bmph_updatedby = $userPk;
                if($pratrianer->save()) {
                    if($pradata->delete()) {
                        
                    }
                    else{
                        echo "<pre>";
                        $transaction->rollBack();
                        print_r($pradata->getErrors());
                        die;
                    }
                }
                else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($pratrianer->getErrors());
                    die;
                }
            }
            $assessmentdata = \app\models\BatchmgmtasmtdtlsTbl::find()->where(['bmad_learnerreghrddtls_fk' => $id])->one();
            if($assessmentdata){
                $assessmenttrianer = \app\models\BatchmgmtasmthdrTbl::find()->where(['batchmgmtasmthdr_pk' => $assessmentdata->bmad_batchmgmtasmthdr_fk])->one();
                $assessmenttrianer->bmah_status = 1;
                $assessmenttrianer->bmah_updatedon = date('Y-m-d H:i:s');
                $assessmenttrianer->bmah_updatedby = $userPk;
                if($assessmenttrianer->save()) {
                    if($assessmentdata->delete()) {
                        
                    }
                    else{
                        echo "<pre>";
                        $transaction->rollBack();
                        print_r($assessmentdata->getErrors());
                        die;
                    }
                }
                else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($assessmenttrianer->getErrors());
                    die;
                }
            }

            $attendancelist = \app\models\TrngattdntdtlsTbl::find()->where(['tad_learnerreghrddtls_fk' => $id])->all();
            foreach($attendancelist as $d){
                if( $d->delete()) {
                    
                }
                else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($d->getErrors());
                    die;
                }
            }
            $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query = \Yii::$app->db->createCommand("DELETE FROM learnerreghrddtls_tbl WHERE learnerreghrddtls_pk = $id;")->execute();
            $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            if($query) {
                $transaction->commit();
                return [ 'msg' => 'Successfull', 'status' => 1, 'flag' => 'S', 'data' => 'Learner delete successfully' ]; 
            }
            else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($learner_update->getErrors());
                die;
            }

        } else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($learnerhist->getErrors());
            die;
        }
    }
}