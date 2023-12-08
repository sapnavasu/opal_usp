<?php

namespace api\modules\lf\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use app\models\BatchmgmtdtlsTbl;
use app\models\LearnerreghrddtlsTbl;
use DateTime;
use yii\db\ActiveRecord;


class LearnerfeedbackController extends MasterController
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

    // public function actionGetfeedbackquestion($learnerId){

    //     $isrecordthere = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_learnerreghrddtls_fk'=>$learnerId])->one();
    //     if($isrecordthere){
    //         if( $isrecordthere->lfh_FdbbkStatus == 1){

    //             $learner = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk'=>$learnerId])->one();
    //             $learnerfeedback = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_LearnerRegHrdDtls_FK'=>$learnerId])->one();
    //             $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner->lrhd_batchmgmtdtls_fk])->one();
    //             $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$batch->bmd_standardcoursedtls_fk])->one();
    //             $feedbackmst = \app\models\FeedbackmstTbl::find()
    //             ->where(['FeedbackMst_PK'=>$learnerfeedback->lfh_feedbackmst_fk])->one();
                
    //             $feedcatgetory = \app\models\FeedbackctgytypeTbl::find()
    //             ->where(['fdbkct_feedbackmst_fk'=>$feedbackmst->FeedbackMst_PK])
    //             ->asArray()->all();
    //             $questions = [];
    //             foreach($feedcatgetory as $d)
    //             {
    //                 $question = \app\models\FdbkquestmstTbl::find()
    //                 ->where(['fdbkqm_feedbackctgytype_fk'=>$d['feedbackctgytype_pk']])
    //                 ->andwhere(['fdbkqm_FeedbackMst_FK'=>$feedbackmst->FeedbackMst_PK])
    //                 ->andwhere(['fdbkqm_status'=> 1])
    //                 ->asArray()->all();
    //                 $d['questions'] = $question;
    //                 array_push($questions, $d);
    //             }
    //             $assessor = \app\models\BatchmgmtasmtdtlsTbl::find()
    //             ->select(['omrm_tpname_en','omrm_tpname_ar'])
    //              ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk')
    //              ->leftJoin('opalusermst_tbl','bmah_assessor = opalusermst_pk')
    //              ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
    //             ->where(['bmad_learnerreghrddtls_fk'=>$learnerId])
    //             ->asArray()->all();
    //             $trainer = \app\models\OpalmemberregmstTbl::find()
    //             ->select(['omrm_tpname_en','omrm_tpname_ar'])
    //             ->where(['opalmemberregmst_pk' =>$batch->bmd_opalmemberregmst_fk])
    //             ->asArray()->one();
    //             $learnerdata = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk'=>$learner->lrhd_staffinforepo_fk])->one();
    //             $bool = false;
    //             if($standardcourse->scd_isknwlasmt == 1 || $standardcourse->scd_ispratasmt ==1){
    //                 $bool = true;
    //             }

    //             $data=[
    //                 'batchNo'=>$batch->bmd_Batchno,
    //                 'trainer'=>$trainer[0]['omrm_tpname_en'],
    //                 'assessor'=>$assessor[0]['omrm_tpname_en'],
    //                 'name'=>$learnerdata->sir_name_en,
    //                 'civilnumber'=>$learnerdata->sir_idnumber,
    //                 'feedback'=> $questions,
    //                 'isassessment'=> $bool
    //             ];
    //             return $data;
    //         }
    //         else{
    //             return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'r', 'data' => 'You had already provide feedback for this batch' ];
    //         }
    //     } else{
    //         return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'f', 'data' => 'There is no feedback record for you' ];
    //     }
    // }

    // public function actionSavefeedbackquestion(){
    //     $request_body = file_get_contents('php://input');
    //     $data =	json_decode($request_body, true); 
    //     $learner = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_learnerreghrddtls_fk'=>$data['learnerId']])->one();

    //     foreach($data['questions'] as $d)
    //     {
    //         foreach($d['questions'] as $dd)
    //         {
               
    //             $value = new \app\models\LearnerfdbkansdtlsTbl;
    //             $value->lfdbkansd_learnerfdbkhdr_fk = $learner->LearnerFdbkHdr_PK;
    //             $value->lfdbkansd_fdbkquestmst_fk = $dd['FdbkQuestMst_PK'];
    //             $value->lfdbkansd_agree =  $dd['value'] == 1 ? 1 : 0;
    //             $value->lfdbkansd_disagree = $dd['value'] == 2 ? 1 : 0;
    //             $value->lfdbkansd_stronglyagree = $dd['value'] == 3 ? 1 : 0;
    //             if($value->save()){
    //                 //return $catTable->LearnerAsmtHdr_PK;
    //             }else{
    //                 return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'r', 'data' => $value->getErrors() ];
    //                // echo "<pre>";return $value->getErrors();exit;
    //             } 
    //         }
    //     }

    //     $learner->lfh_FdbbkStatus  = 2;
    //     $learner->lfh_Comments = $data['comments'];

    //     if($learner->save()){
    //         return [ 'msg' => 'success', 'status' => 100, 'flag' => 's', 'data' => "Saved Successfully" ];
    //     }else{
    //         return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'r', 'data' => $learner->getErrors() ];
    //         //echo "<pre>";return $learner->getErrors();exit;
    //     }   
    // }


    public function actionGetfeedbackquestionanswer($learnerid){
        $learnerreg = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk'=>$learnerid])->one();
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learnerreg->lrhd_batchmgmtdtls_fk])->one();
        $trainer = \app\models\BatchmgmtthydtlsTbl::find()
                ->select(['omrm_tpname_en','omrm_tpname_ar'])
                 ->leftJoin('batchmgmtthyhdr_tbl','batchmgmtthyhdr_pk = bmtd_batchmgmtthyhdr_fk')
                 ->leftJoin('opalusermst_tbl','bmth_tutor = opalusermst_pk')
                 ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['bmtd_learnerreghrddtls_fk'=>$learnerid])
                ->asArray()->all();
        $assessor = \app\models\BatchmgmtasmtdtlsTbl::find()
                ->select(['omrm_tpname_en','omrm_tpname_ar'])
                 ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk')
                 ->leftJoin('opalusermst_tbl','bmah_assessor = opalusermst_pk')
                 ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['bmad_learnerreghrddtls_fk'=>$learnerid])
                ->asArray()->all();
        $learnerdata = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk'=>$learnerreg->lrhd_staffinforepo_fk])->one();

        $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$batch->bmd_standardcoursedtls_fk])->one();
     
        // $feedbackmst = \app\models\FeedbackmstTbl::find()
        // ->orwhere(['fdbkm_standardcoursemst_fk'=>$standardcourse->scd_standardcoursemst_fk])
        // ->orwhere('fdbkm_standardcoursemst_fk IS NULL')
        // ->andwhere(['fdbkm_standardcoursedtls_fk'=>$standardcourse->standardcoursedtls_pk])
        // ->orwhere('fdbkm_standardcoursedtls_fk IS NULL')
        // ->createCommand()->getRawSql();//->one();
        $query = "SELECT * FROM `feedbackmst_tbl`WHERE((`fdbkm_standardcoursemst_fk`=$standardcourse->scd_standardcoursemst_fk)OR(fdbkm_standardcoursemst_fk IS NULL))AND((`fdbkm_standardcoursedtls_fk`=$standardcourse->standardcoursedtls_pk) OR (`fdbkm_standardcoursedtls_fk` IS NULL))";

        $feedbackmst = Yii::$app->db->createCommand($query)->queryAll();
        //return $result[0];
        
        //
        $feedcatgetory = \app\models\FeedbackctgytypeTbl::find()
        ->where(['fdbkct_feedbackmst_fk'=>$feedbackmst[0]['FeedbackMst_PK']])
        ->asArray()->all();
        $questions = [];
        foreach($feedcatgetory as $d)
        {
            $question = \app\models\FdbkquestmstTbl::find()
            ->where(['fdbkqm_feedbackctgytype_fk'=>$d['feedbackctgytype_pk']])
            ->andwhere(['fdbkqm_FeedbackMst_FK'=>$feedbackmst[0]['FeedbackMst_PK']])
            ->andwhere(['fdbkqm_status'=> 1])->orderBy('fdbkqm_Order')
            ->asArray()->all();
            $d['questions'] = $question;
            array_push($questions, $d);
        }
        

        $learner = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_learnerreghrddtls_fk'=>$learnerid])->one();
        $learnerQA = \app\models\LearnerfdbkansdtlsTbl::find()->where(['lfdbkansd_learnerfdbkhdr_fk'=> $learner->LearnerFdbkHdr_PK])->asArray()->all();

        $data=[
            'batchNo'=>$batch->bmd_Batchno,
            'trainer'=>$trainer[0]['omrm_tpname_en'],
            'assessor'=>$assessor[0]['omrm_tpname_en'],
            'name'=>$learnerdata->sir_name_en,
            'civilnumber'=>$learnerdata->sir_idnumber,
            'feedback'=> $questions,
            'feedbackans'=>$learnerQA,
            'comments'=>$learner->lfh_Comments
        ];

        return $data;

    }
    public function actionGetfeedbacklist(){
        $data = \app\models\LearnerfdbkhdrTblQuery::getfeedbackdatalist($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success'];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure']; 
        }
        return $this->asJson($response);
    }      
}