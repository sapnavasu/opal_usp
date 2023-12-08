<?php

namespace api\modules\bm\controllers;

use api\components\Batch;
use api\components\Security;
use api\modules\mst\controllers\MasterController;
use app\models\AppstaffinfomainTbl;
use app\models\BatchattdntdwldtrackTbl;
use app\models\BatchmgmtdtlsTbl;
use app\models\CoursecategorymstTbl;
use app\models\FeeSubscriptionmstTbl;
use app\models\LearnerreghrddtlsTbl;
use app\models\OpalmemberregmstTbl;
use app\models\ReferencemstTbl;
use app\models\StaffacademicsTbl;
use app\models\StaffinforepoTbl;
use app\models\StaffworkexpTbl;
use app\models\StandardcoursedtlsTbl;
use app\models\StandardcoursemstTbl;
use app\models\TrngattdntdtlsTbl;
use app\models\LearnercarddtlsTbl;
use app\models\BatchmgmtasmthdrTbl;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\web\Response;
use app\models\AppinstinfomainTbl;


class BatchmanagementController extends MasterController
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


    public function actionGetBatchDtls(){

        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $regpk = isset($request['regpk'])? $request['regpk'] : null;
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $sort = isset($request['sort'])? $request['sort'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $decryptedId = Security::decrypt($regpk);
        
        $batches = BatchmgmtdtlsTbl::getBatchdataByRegPk($decryptedId,$limit,$index,$searchkey,$sort);
        
       
        return $batches;
    }
    
    public function actionFetchBatchdetails(){

        $bid = isset($_GET['bid'])? $_GET['bid'] : 0;
        $decryptedId = Security::decrypt($bid);
        $batch = BatchmgmtdtlsTbl::fetchBatchdetailsByBatchno($decryptedId);
        
        
          
        return $batch;
    }
    
    public function actionCheckavailabilityassessor(){

        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $assdate = isset($request['assdate'])? $request['assdate'] : null;
        $starttime = isset($request['start'])? $request['start'] : null;
        $endtime = isset($request['end'])? $request['end'] : null;
        $coursepk = isset($request['coursepk'])? $request['coursepk'] : null;
        $language = isset($request['languagepk'])? $request['languagepk'] : null;
        $regpk = isset($request['regpk'])? $request['regpk'] : null;
        $wilayat = isset($request['wilayat'])? $request['wilayat'] : null;
        $subcate = isset($request['subcate'])? $request['subcate'] : null;
        $numberofassessor = isset($request['numberofassessor'])? $request['numberofassessor'] : null;
        $decrdate = Security::decrypt($assdate);

        
       
        $batch = Batch::checkavailabilityassessor($decrdate,$starttime,$endtime,$coursepk,$language,$subcate,$wilayat,$regpk,$numberofassessor);
        
        if($batch['status'] == 1 )
         {
            $data = $batch['data'];
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }
        else if($batch['status'] == 3 )
        {
            $data = $batch['data'];
            return ['msg' => 'assigned', 'status' => 3, 'flag' => 'A', 'data' => $data];
        }
        else if($batch['status'] == 4 )
        {
        
            return ['msg' => 'assigned', 'status' => 4, 'flag' => 'A', 'data' => ''];
        }
         else if($batch['status'] == 5 )
        {
        
            return ['msg' => 'failure', 'status' => 5, 'flag' => 'NAIA', 'data' => ''];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
        
           }
   
     public function actionGetTevalutioncentres(){

        $model = OpalmemberregmstTbl::getTrainingEvalutionCentres();

         if($model)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
         
    }

    public function actionGetAllStandardCourses()
    {
        $data = StandardcoursemstTbl::getallstandardcourses();


      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetAllStandardCoursesByRegPk()
    {
        $appPk = isset($_GET['appPk']) ? $_GET['appPk'] : 0;
        $decryptedId = Security::decrypt($appPk);

        $data = StandardcoursemstTbl::getallstandardcoursesByAppPk($decryptedId);


      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }


     public function actionGetcatlist() {
        $categories = CoursecategorymstTbl::getCourseCategories();

        if ($categories) {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $categories];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetsubcatlistbycatpk()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $catPk = $request['catPk'];
        $decryptedId = Security::decrypt($catPk);
        $appPk = $request['apppk'];
        $decryAppPk = Security::decrypt($appPk);


        $subcategories = CoursecategorymstTbl::getCoursesubCategoryById($decryptedId,$decryAppPk);
      
      if($subcategories)
         {
              return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $subcategories ];
         }
         
          return [ 'msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => '' ];   
     }
     
     public function actionGetCourseDtlsbysubcatpk()
     {
         $subcatpk = isset($_GET['subcatpk'])? $_GET['subcatpk'] : 0;
         $decryptedId = Security::decrypt($subcatpk);
         
        
         $coursedlts = StandardcoursedtlsTbl::getCourseDtlsbysubcatpk($decryptedId);
         
      if($coursedlts)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $coursedlts];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }


      public function actionSavebatchdtls() {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $requestdata = $request['centerdtls'];
        $transaction = \Yii::$app->db->beginTransaction();
        $SaveBatchdtls = Batch::saveBatchDtls($requestdata);
        if($SaveBatchdtls)
        {
            $model = BatchmgmtdtlsTbl::findOne($SaveBatchdtls['batchpk']);
            if($model->bmd_Batchno == 'batchnum')
            {
                $model->bmd_Batchno = BatchmgmtdtlsTbl::newBatchRefNo($model->bmd_standardcoursedtls_fk, $model->bmd_batchtype,$model->bmd_opalmemberregmst_fk);
                $model->bmd_createdon = date('Y-m-d H:i:s');
            }
            
            if(!$model->save() || $model->bmd_Batchno == 'batchnum')
            { 
               $transaction->rollBack();
              return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
            } 
        }
          if($SaveBatchdtls && ($SaveBatchdtls['thhdrpk'] =="statusNT" || $SaveBatchdtls['prhdrpk'] =="statusNT" || $SaveBatchdtls['asmnthdrpk'] =="statusNT")){
            $transaction->rollBack();
            return ['msg' => 'Attention: There is no Staff available on the selected duration. Please check the availability of the Staff.', 'status' => 3, 'flag' => 'f', 'data' => ''];
        }
        $saveBatchTrnDtls = Batch::saveBatchtrnDtls($requestdata, $SaveBatchdtls);
        if($SaveBatchdtls && $saveBatchTrnDtls)
        {
            $transaction->commit();
            $batchpk = $SaveBatchdtls['batchpk'];
            $theorypk = $SaveBatchdtls['thhdrpk'];      
            $practicalpkArray = $SaveBatchdtls['prhdrpk']; 
            $firstPracticalpk = $practicalpkArray[0]; 
            $accessmentArray = $SaveBatchdtls['asmnthdrpk'];
            $firstAsseccorpk = $accessmentArray[0];

                $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['scm_assessmentin','scd_ispratclass','bmd_batchtype'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->where(['batchmgmtdtls_pk' => $batchpk])
                ->asArray()
                ->one();
                
                $accessmentdc = $batchDet['scm_assessmentin'];
                $practical = $batchDet['scd_ispratclass'];
                $batchtyp = $batchDet['bmd_batchtype'];

            if($theorypk){
                \api\components\Mail::batchDtls($batchpk,$theorypk,'batchcreated'); 
            }
             $tutor = \app\models\BatchmgmtdtlsTbl::find()
            ->select (['oum_firstname','oum_emailid'])
            ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
            ->leftJoin('opalusermst_tbl', 'batchmgmtpracthdr_tbl.bmph_tutor = opalusermst_tbl.opalusermst_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
           ->asArray()
            ->all();
    
            $tutormail = [];
            $tutorname = [];
              foreach ($tutor as $tutordet) {
                  $tutormail = $tutordet['oum_emailid'];
                  $tutorname = $tutordet['oum_firstname'];
                
                   if($practical == 1 && $batchtyp == 24){
                         \api\components\Mail::tutbatchDtls($batchpk,$theorypk,$tutormail,$tutorname,'batchcreatedpt'); 
                    }
                  
              }
    
            
           
            
            
            if($accessmentdc ==17){
                \api\components\Mail::batchDtls($batchpk,$theorypk,'diffassessment'); 
            }
            if($accessmentdc ==16){
                \api\components\Mail::batchDtls($batchpk,$theorypk,'sameassessar'); 
                \api\components\Mail::batchDtls($batchpk,$theorypk,'sameassessqc'); 
            }
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $SaveBatchdtls['batchpk']];
            
        }
        else
        {
       
             $transaction->rollBack();
              return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
        }  
    }

    public function actionGetbranchlistbyregpk()
    {
        $regpk = isset($_GET['regpk']) ? $_GET['regpk'] : 0;
        $decryptedId = Security::decrypt($regpk);
        $branches = OpalmemberregmstTbl::getTrngEvalCentresBranchByRegPk($decryptedId);
        

      if($branches)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $branches];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }


    public function actionGetTutorsList()
    {

        $regpk = isset($_GET['regpk']) ? $_GET['regpk'] : 0;
        $decryptedId = Security::decrypt($regpk);
        $tutors = AppstaffinfomainTbl::getTutorsListByRegPk($decryptedId);
        $accessors = AppstaffinfomainTbl::getAssesorsList();


      if($tutors || $accessors)
         {
            $data['tutors'] = $tutors;
            $data['accessors'] = $accessors;
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }
    
    public function actionGettutoravailabilitylist()
    {
       $request_body	= file_get_contents('php://input');
       $request = json_decode($request_body, true);
      
       
       if($request)
       {
           $tutorlist  = AppstaffinfomainTbl::getTutorsListForBatch($request);
            if($tutorlist)
              {
                 $data['tutors'] = $tutorlist;

                 return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
             }
              return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
       }
 
       

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
       
    }
    

    public function actionGetIvqastafflist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $regpk = $request['pk'];
        $decryptedId = Security::decrypt($regpk);
        $coursepk = $request['coursepk'];
        $subcate = $request['subcate'];
        $wilayat = $request['wilayat'];
        $language = $request['language'];
      
        $accessors = AppstaffinfomainTbl::getIVQAStaffbyaccessorpk($decryptedId,$coursepk,$subcate,$language,$wilayat);


      if($accessors['status'] == 1 )
         {
            $data = $accessors['data'];
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }
        else if($accessors['status'] == 2 )
        {
            $data = $accessors['data'];
            return ['msg' => 'assigned', 'status' => 3, 'flag' => 'A', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }



    public function actionGetMastersList()
    {
        $excludepks = [29,32];
        $batchtypelist = ReferencemstTbl::getMastersListByTypePk(9);
        $tutorlanglist = ReferencemstTbl::getMastersListByTypePk(10);
        $dayschedulelist = ReferencemstTbl::getMastersListByTypePk(11,$excludepks);
        

        $data['batch'] = $batchtypelist;
        $data['lang'] = $tutorlanglist;
        $data['dayschedule'] = $dayschedulelist;

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetCategoryforgridlist()
    {
        $data = Batch::getCategoryforgridlist();

      if($data)
         {
            return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetlearnerlist()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];

        $batch = BatchmgmtdtlsTbl::find()->where(["bmd_Batchno" => $params->bid])->one();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);


        $data = Yii::$app->db->createCommand("select bmtd_learnerreghrddtls_fk, bmth_tutor, bmpd_learnerreghrddtls_fk, bmph_tutor, bmad_learnerreghrddtls_fk, bmah_assessor, bmah_ivqastaff from batchmgmtdtls_tbl
        JOIN learnerreghrddtls_tbl on lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk
        left join batchmgmtthydtls_tbl on bmtd_learnerreghrddtls_fk = learnerreghrddtls_pk
        left join batchmgmtthyhdr_tbl on batchmgmtthyhdr_pk = bmtd_batchmgmtthyhdr_fk and bmth_batchmgmtdtls_fk = batchmgmtdtls_pk
        left join batchmgmtpractdtls_tbl on bmpd_learnerreghrddtls_fk = learnerreghrddtls_pk
        left join batchmgmtpracthdr_tbl on batchmgmtpracthdr_pk = bmpd_batchmgmtpracthdr_fk and bmph_batchmgmtdtls_fk = batchmgmtdtls_pk 
        left join batchmgmtasmtdtls_tbl on batchmgmtasmtdtls_tbl.bmad_learnerreghrddtls_fk = learnerreghrddtls_pk
        left join batchmgmtasmthdr_tbl on batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk and bmah_batchmgmtdtls_fk = batchmgmtdtls_pk
        where batchmgmtdtls_pk = $batch->batchmgmtdtls_pk")
        ->queryAll();

        $learnerlist = [];
        foreach($data as $d){
           
            if($d['bmth_tutor'] == $userPk){
                array_push($learnerlist, $d['bmtd_learnerreghrddtls_fk'] );
            }
            if($d['bmph_tutor'] == $userPk){
                array_push($learnerlist, $d['bmpd_learnerreghrddtls_fk'] );
            }
            if($d['bmah_assessor'] == $userPk){
                array_push($learnerlist, $d['bmad_learnerreghrddtls_fk'] );
            }
            if($d['bmah_ivqastaff'] == $userPk){
                array_push($learnerlist, $d['bmad_learnerreghrddtls_fk'] );
            }
        }
       
        if(count($learnerlist) == 0){
            $loginuserdtls = \app\models\OpalusermstTbl::findOne($userPk);
            $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
            
            if(($batch->bmd_opalmemberregmst_fk == $regPk &&  ($loginuserdtls->oum_isfocalpoint == 1 || $batch->bmd_createdby == $userPk))  || $stktype == 1){
                $learner =\app\models\LearnerreghrddtlsTblQuery::getlearnerassessment($batch->batchmgmtdtls_pk );
            }
            else{
                $dd = Yii::$app->db->createCommand("select bmad_learnerreghrddtls_fk, bmah_assessor, bmah_ivqastaff from batchmgmtdtls_tbl 
                JOIN learnerreghrddtls_tbl on lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk
                left join batchmgmtasmtdtls_tbl on batchmgmtasmtdtls_tbl.bmad_learnerreghrddtls_fk = learnerreghrddtls_pk
                left join batchmgmtasmthdr_tbl on batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk and bmah_batchmgmtdtls_fk = batchmgmtdtls_pk
                left join opalusermst_tbl on opalusermst_pk = bmah_assessor 
                where oum_opalmemberregmst_fk = $regPk and batchmgmtdtls_pk = $batch->batchmgmtdtls_pk
                ")->queryAll();
                foreach($dd as $d){
                    array_push($learnerlist, $d['bmad_learnerreghrddtls_fk'] );
                    array_unique($learnerlist);
                    $learnerid =  implode(",",$learnerlist);
                    $learner =\app\models\LearnerreghrddtlsTblQuery::getlearnerassessment($batch->batchmgmtdtls_pk, $learnerid );
                }
            }
        } else{
           
            array_unique($learnerlist);
            $learnerid =  implode(",",$learnerlist);
            $learner =\app\models\LearnerreghrddtlsTblQuery::getlearnerassessment($batch->batchmgmtdtls_pk, $learnerid );
            
        }
        
        

        return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $learner];

        if($learner)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $learner];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
        
    }

    public function actionLearnerattendance()
    {

        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];

        $attend = "";

        foreach($params->tad_learnerreghrddtls_fk as $tad_learnerreghrddtls_fk)
        {
            $check = null;
            if($params->tad_batchstatus == 2){
                
                $check = TrngattdntdtlsTbl::find()->where(["tad_trngdate" => date("Y-m-d"), "tad_learnerreghrddtls_fk" => $tad_learnerreghrddtls_fk, "tad_batchmgmtthyhdr_fk"=>$params->tad_batchmgmtthyhdr_fk])->one();
            }
            if($params->tad_batchstatus == 3){
                
                $check = TrngattdntdtlsTbl::find()->where(["tad_trngdate" => date("Y-m-d"), "tad_learnerreghrddtls_fk" => $tad_learnerreghrddtls_fk, "tad_batchmgmtpracthdr_fk"=>$params->tad_batchmgmtpracthdr_fk])->one();
            }

            // return $check;

            if($check)
            {
                $data[] = $tad_learnerreghrddtls_fk;
                // return ['msg' => 'Attendance already marked', 'status' => 2, 'flag' => 'f'];
            }else{
                $params->tad_learnerreghrddtls_fk = $tad_learnerreghrddtls_fk;
                $attend = TrngattdntdtlsTbl::saveLearnerAttendance($params);
            }

          
        }
        
        if(count($check) == count($params->tad_learnerreghrddtls_fk))
        {
            return ['msg' => 'Attendance already marked', 'status' => 2, 'flag' => 'f'];
        }
        if($attend)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $attend];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f'];

    }

    public function actionLearnermovestatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $batchno = $params->batchno;
        $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['batchmgmtdtls_pk','bmd_status','scd_ispratclass','bmd_reqstatus','bmd_batchtype'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->where(['bmd_batchno' => $batchno])
                ->asArray()
                ->one();
        $batchstatus = $batchDet['bmd_status']; 
        $batchpk = $batchDet['batchmgmtdtls_pk'];   
        $practical = $batchDet['scd_ispratclass'];
         $batchtyp = $batchDet['bmd_batchtype'];
        $learnerlst = \app\models\BatchmgmtdtlsTbl::find()
            ->select(['Irhd_emailid', 'sir_name_en'])
            ->leftJoin('learnerreghrddtls_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
            ->leftJoin('staffinforepo_tbl', 'learnerreghrddtls_tbl.lrhd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
            ->asArray()
            ->all();
       
            $learnerId = [];
            $learnerName = [];

           
        $data = [];
        $status = LearnerreghrddtlsTbl::statusUpdate($params);

        if($status)
        {
             foreach ($learnerlst as $learnerlstrow) {
                    $learnerId = [$learnerlstrow['Irhd_emailid']];
                    $learnerName = [$learnerlstrow['sir_name_en']];
                if($batchstatus == 2){
                    if($practical == 1 && $batchtyp == 24){
                       \api\components\Mail::learnBulk($batchpk,$learnerId,$learnerName,'movetoprac'); 
                    }else{
                        \api\components\Mail::learnBulk($batchpk,$learnerId,$learnerName,'movetoaccess');  
                    }             
                }elseif($batchstatus == 3){
                    \api\components\Mail::learnBulk($batchpk,$learnerId,$learnerName,'movetoaccess'); 
                }

                }
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S'];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f'];

    }

    public function actionMoveBatchToTheory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
        
        $status = Batch::MoveBatchToTheory($batchno);

        if($status)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S'];
        }

        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f'];

    }

    public function actionlearnerfeestatus()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];

        $learner = LearnerreghrddtlsTbl::find()->where(["lrhd_staffinforepo_fk" => $data["staffinfo_id"]])->one();

        return $params;
    }


    public function actionGetbranchinfo()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);

        // return $params->bid;

        $regPk =  ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);

        $userPk =  ActiveRecord::getTokenData('opalusermst_pk', true);

        // return $userPk;

        // $details = \app\models\OpalusermstTbl::find()->select(['opalusermst_pk','oum_opalmemberregmst_fk'])->where(['opalusermst_pk' => $userPk])->one();

        // $branch = \app\models\OpalmemberregmstTbl::find()->where(["opalmemberregmst_pk"=>$details->oum_opalmemberregmst_fk])->one();

        $branch = BatchmgmtdtlsTbl::find()
            ->where(["bmd_Batchno" => $params->bid])
            ->select([
                'batchmgmtdtls_tbl.bmd_opalmemberregmst_fk','batchmgmtdtls_tbl.batchmgmtdtls_pk', 'batchmgmtdtls_tbl.bmd_Batchno',
                'batchmgmtdtls_tbl.bmd_batchtype', 'b.rm_name_en', 'b.referencemst_pk'
            ])
            ->leftJoin('referencemst_tbl b', 'b.referencemst_pk=bmd_batchtype')
            ->one();

        $branchinfo = OpalmemberregmstTbl::find()->where(["opalmemberregmst_pk" => $branch->bmd_opalmemberregmst_fk])->one();

        $data = array(
            "branch_info" => $branchinfo,
            "batch_info" => $branch
        );

        if($branchinfo)    
        {
            // $branchinfo->batch_no = $branch->bmd_Batchno;

            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $data];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];

    }


    public function actionLearnerRegister()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];
        $stafflist = StaffinforepoTbl::saveLearner($params);
        if($stafflist) {
//            \api\components\Mail::learnDtls($batchpk,$learnerpk,'learnreg'); 
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $stafflist];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionLearnerupdate()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];

        $stafflist = StaffinforepoTbl::updatelearner($params);

        if($stafflist) {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $stafflist];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionLearneracademics()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);

        // return $params->sacd_staffinforepo_fk;

        $education = StaffacademicsTbl::saveAcademics($params);

        if($education)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $education];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetlearnerfee()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        
        $getmemberBatch = BatchmgmtdtlsTbl::find()->where(["bmd_Batchno" => $params->bid])->one();
        
        $appInsInfo = AppinstinfomainTbl::find()->where(["appinstinfomain_pk" => $getmemberBatch->bmd_appinstinfomain_fk])->one();
       
        $fsmapptype = '';
        if($getmemberBatch->bmd_batchtype == '24'){
            $fsmapptype = '1';
        } else if($getmemberBatch->bmd_batchtype == '25'){
            $fsmapptype = '4';
        }
        $feetype = [$appInsInfo->appiim_officetype,3];
        $fees = FeeSubscriptionmstTbl::find()
                        ->where(["fsm_standardcoursedtls_fk"=>$getmemberBatch->bmd_standardcoursedtls_fk])
                        ->andWhere(["fsm_feestype"=> '4'])
                        ->andWhere(["fsm_applicationtype"=>$fsmapptype])
                        //->andWhere(["fsm_officetype"=>$appInsInfo->appiim_officetype])
                        ->andWhere(['in', 'fsm_officetype', $feetype])
                        ->one();
        
        if($fees)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' =>  $fees ];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
        
    }

    public function actionSaveworkexplist()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];

        $workexp = StaffworkexpTbl::saveWorkexp($params);

        // return ['data' => $params];
        if($workexp)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $workexp];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetworkexplist()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);

        $workexplist = StaffworkexpTbl::getExpList($params->id);

        if($workexplist)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $workexplist];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetlearneredulist()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);

        $academiclist = StaffinforepoTbl::getLearnerEduList($params->id);

        if($academiclist)
        {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $academiclist];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionChecklearner()
    {
        $response = [];
        $request_body    = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $lnrrcard_exp_before = \Yii::$app->params['learnercard_expiry_days']['before'];
        $lnrrcard_exp_after = \Yii::$app->params['learnercard_expiry_days']['after'];
        
        if (!empty($request['repo'])) {
            $data = StaffinforepoTbl::find()
                ->select(['*', 'license.*','learn_course.*'])
                ->leftJoin("stafflicensedtls_tbl license", "license.sld_staffinforepo_fk=staffinforepo_pk") //learner license
                ->leftJoin('learnerreghrddtls_tbl as learn_course','learn_course.lrhd_staffinforepo_fk=staffinforepo_pk')
                ->Where(['sir_idnumber' => $request['civilnumval'],'learn_course.lrhd_feestatus'=>1])
                ->andWhere(['!=', 'sir_idnumber', ""])
                ->andWhere(['!=', 'staffinforepo_pk', $request['repo']])
                ->asArray()
                ->all();
        } else {
            $data = StaffinforepoTbl::find()
                ->select(['*', 'license.*'])
                ->leftJoin("stafflicensedtls_tbl license", "license.sld_staffinforepo_fk=staffinforepo_pk") //learner license
                ->leftJoin('learnerreghrddtls_tbl as learn_course','learn_course.lrhd_staffinforepo_fk=staffinforepo_pk')
                ->Where(['sir_idnumber' => $request['civilnumval']])
                ->andWhere(['!=', 'sir_idnumber', ""])
                ->asArray()
                ->all();
        }

        // $dataStaff = StaffinforepoTbl::find()
        //         ->select(['*'])
        //         ->innerJoin('learnerreghrddtls_tbl','learnerreghrddtls_tbl.lrhd_staffinforepo_fk=staffinforepo_pk')
        //         ->innerJoin('batchmgmtdtls_tbl','batchmgmtdtls_tbl.batchmgmtdtls_pk=learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
        //         ->leftJoin('referencemst_tbl','referencemst_tbl.referencemst_pk=batchmgmtdtls_tbl.bmd_batchtype')
        //         ->Where(['sir_idnumber' => $request['civilnumval']])
        //         ->orderBy(['learnerreghrddtls_pk' => SORT_DESC])
        //         ->asArray()
        //         ->one();

        $dataStaff = StaffinforepoTbl::find()
                ->select(['*'])
                ->innerJoin('learnerreghrddtls_tbl','learnerreghrddtls_tbl.lrhd_staffinforepo_fk=staffinforepo_pk')
                ->innerJoin('batchmgmtdtls_tbl','batchmgmtdtls_tbl.batchmgmtdtls_pk=learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
                ->leftJoin('referencemst_tbl','referencemst_tbl.referencemst_pk=batchmgmtdtls_tbl.bmd_batchtype')
                ->Where(['sir_idnumber' => $request['civilnumval']])
                ->andWhere(['bmd_standardcoursedtls_fk' => $request['cour']])
                ->orderBy(['learnerreghrddtls_pk' => SORT_DESC])
                ->asArray()
                ->one();

        //echo '<pre>';print_r($dataStaff);exit;
        // Input Batch Details
        $dataBatch = BatchmgmtdtlsTbl::find()
        ->select(['*'])
        ->Where(['bmd_Batchno' => $request['batchno']])
        ->asArray()
        ->one();
        
        $validation_status = '';
        $batch_type = '';
        // Check same course Validation other course Mean Allow Regitration
        if($dataBatch['bmd_standardcoursedtls_fk'] == $dataStaff['bmd_standardcoursedtls_fk']){
            if(!empty($dataStaff)){
                if($dataStaff['lrhd_status'] == 1 
                    || $dataStaff['lrhd_status'] == 2 
                    || $dataStaff['lrhd_status'] == 3
                    || $dataStaff['lrhd_status'] == 4
                    || $dataStaff['lrhd_status'] == 5
                    || $dataStaff['lrhd_status'] == 6
                    || $dataStaff['lrhd_status'] == 7
                    || $dataStaff['lrhd_status'] == 8
                    || $dataStaff['lrhd_status'] == 9
                    || $dataStaff['lrhd_status'] == 12){
                        if($dataStaff['bmd_status'] < 7){
                            $validation_status = 1; // Already In Some Batch
                        }
                }
                
                if($dataStaff['lrhd_status'] == 10 || $dataStaff['lrhd_status'] == 11){
                    
                    $lerCard = LearnercarddtlsTbl::find()
                                    ->select(['*'])
                                    ->Where(['lcd_staffinforepo_fk' => $dataStaff['staffinforepo_pk']])
                                    ->andWhere(['lcd_batchmgmtdtls_fk' => $dataStaff['batchmgmtdtls_pk']])
                                    ->andWhere(['lcd_learnerreghrddtls_fk' => $dataStaff['learnerreghrddtls_pk']])
                                    ->andWhere(['lcd_standardcoursedtls_fk' => $request['cour']])
                                    ->orderBy(['learnercarddtls_pk' => SORT_DESC])
                                    ->asArray()
                                    ->one();

                    $bthAssmt = BatchmgmtasmthdrTbl::find()
                                    ->select(['*'])
                                    ->Where(['bmah_batchmgmtdtls_fk' => $dataBatch['batchmgmtdtls_pk']])
                                    ->orderBy(['batchmgmtasmthdr_pk' => SORT_DESC])
                                    ->asArray()
                                    ->one();

                    $today = $bthAssmt['bmah_assessmentdate'];
                    $futureDate = $lerCard['lcd_cardexpiry'];
                    $difference = strtotime($today) - strtotime($futureDate);
                    $days = $difference/(60 * 60)/24;
                    $expired_date =$days;
                    
                    
                    if($dataStaff['bmd_status'] == 8){
                        //if($dataStaff['bmd_batchtype'] == $dataBatch['bmd_batchtype']){
                            if($expired_date < $lnrrcard_exp_before){ // 31
                                if($dataBatch['bmd_batchtype'] == 24){
                                    $validation_status = 2;
                                    $batch_type = 3;
                                } else if($dataBatch['bmd_batchtype'] == 25){
                                    $validation_status = '';
                                    $batch_type = '';
                                }
                            }
                            
                            if($expired_date > $lnrrcard_exp_after){ // 30
                                // $validation_status = 2;
                                // $batch_type = 4;
                                if($dataBatch['bmd_batchtype'] == 24){
                                    $validation_status ='';
                                    $batch_type = '';
                                } else if($dataBatch['bmd_batchtype'] == 25){
                                    $validation_status = 2;
                                    $batch_type = 4;
                                }
                            }
                        //}

                        // if($dataStaff['bmd_batchtype'] != $dataBatch['bmd_batchtype']){
                            
                        //     if($expired_date < 31){
                        //         if($dataBatch['bmd_batchtype'] == 24){
                        //             $validation_status = '';
                        //             $batch_type = '';
                        //         } else if($dataBatch['bmd_batchtype'] == 25){
                        //             $validation_status = '';
                        //         }
                        //     }

                        //     if($expired_date > 31){
                        //         if($dataBatch['bmd_batchtype'] == 24){
                        //             $validation_status = 2;
                        //             $batch_type = 3;
                        //         } else if($dataBatch['bmd_batchtype'] == 25){
                        //             $validation_status = 2;
                        //             $batch_type = 4;
                        //         }
                        //     }
                        // }
                    } 
                }

                

                if($dataStaff['lrhd_status'] == 12){
                    if($dataStaff['bmd_status'] == 8){
                        if($dataStaff['bmd_batchtype'] != $dataBatch['bmd_batchtype']){
                            //$validation_status = 3; // Allowed Only Ini Cancel mean Ini/Ref canl mean Ref
                            if($dataStaff['bmd_batchtype'] == 24){
                                $validation_status = 3;
                                $batch_type = 1;
                            } else if($dataStaff['bmd_batchtype'] == 25){
                                $validation_status = 3;
                                $batch_type = 2;
                            }
                        }
                    }
                }

            
                if($dataStaff['lrhd_status'] == 13){
                        if($dataStaff['bmd_batchtype'] != $dataBatch['bmd_batchtype']){
                            //$validation_status = 3; // Allowed Only Ini Cancel mean Ini/Ref canl mean Ref
                            if($dataStaff['bmd_batchtype'] == 24){
                                $validation_status = 3;
                                $batch_type = 1;
                            } else if($dataStaff['bmd_batchtype'] == 25){
                                $validation_status = 3;
                                $batch_type = 2;
                            }
                        }
                }

            }

            if(!empty($request['civilnumval'])){
                $response = [
                    'status' => 1, 'valstatus' => $validation_status, 'batch_type' => $batch_type, 'lnrrcard_exp_days' => $lnrrcard_exp_after, 'data' => $data, 'dataStaff' => $dataStaff, 'msg' => 'Success',
                ];
            }else{
                $response = [
                    'status' => 1, 'valstatus' => '', 'batch_type' => '', 'lnrrcard_exp_days' => '', 'data' => '', 'dataStaff' => '', 'msg' => 'Success',
                ];
            }
            

            return $this->asJson($response);

        }else{
            
            if(empty($dataStaff) && $dataBatch['bmd_batchtype'] == 25){//new learner adding to refresher batch
                $validation_status = 5;
        }
            if(!empty($request['civilnumval'])){
                $response = [
                    'status' => 1, 'valstatus' => $validation_status, 'batch_type' => $batch_type, 'lnrrcard_exp_days' => $lnrrcard_exp_after, 'data' => $data, 'dataStaff' => $dataStaff, 'msg' => 'Success',
                ];
            }else{
                $response = [
                    'status' => 1, 'valstatus' => '', 'batch_type' => '', 'lnrrcard_exp_days' => '', 'data' => '', 'dataStaff' => '', 'msg' => 'Success',
                ];
            }
            return $this->asJson($response);
        }
        if ($data) {
            $response = [
                'status' => 1, 'valstatus' =>0, 'data' => $data, 'msg' => 'Success',
            ];
        } else {
            if($dataBatch['bmd_batchtype'] == 25){
                $response = [
                    'status' => 1, 'valstatus' =>5, 'data' => $data, 'msg' => 'Success',
                ];
            }else{
                $response = [
                    'status' => 2, 'valstatus' =>0, 'data' => '', 'msg' => 'Failure',
                ];
            }
        }
        return $this->asJson($response);
    }
    public function actionDownloadattendance(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchdata = isset($request['batchno'])? $request['batchno'] : null;
        if(!empty($batchdata))
        {
            $data = Batch::downloadAttendance($batchdata);
            if($data['status']=='success')
            {
                $response = ['msg' => 'sucess', 'status' => 1, 'attend' =>$data['attend'], 'flag' => 'S'];
            }else{
                $response = ['msg' => 'failure', 'status' => 2, 'flag' => 'F'];
            }
        }
        return $response;
    }
    public function actionDownloadattend(){
        if($_REQUEST['id']){
            $trackpk = Security::decrypt($_REQUEST['id']);
            $trackinfo = BatchattdntdwldtrackTbl::findOne($trackpk);
            $zipfilename = $trackinfo->badt_filenamepath.'.zip';
            $fol = $trackinfo->badt_batchmgmtdtls_fk.'/';
            $dir = \Yii::$app->params['srcDirectory'];
            $zipfilepath = $dir.'web/exports/'.$fol.$zipfilename;
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
    
    public function actionChangeBatchstatus(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
        $status = isset($request['status'])? $request['status'] : null;
        $comments = isset($request['comments'])? $request['comments'] : null;
        
          $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['batchmgmtdtls_pk','scm_assessmentin','scd_ispratclass','bmd_reqstatus','bmd_batchtype'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->where(['bmd_Batchno' => $batchno])
                ->asArray()
                ->one();
          $batchpk = $batchDet['batchmgmtdtls_pk'];
          $practical = $batchDet['scd_ispratclass'];
          $batchtyp = $batchDet['bmd_batchtype'];
          $accessmentdc = $batchDet['scm_assessmentin'];
          $backtrackreq = $batchDet['bmd_reqstatus'];
          $learnerlst = \app\models\BatchmgmtdtlsTbl::find()
            ->select(['staffinforepo_pk','Irhd_emailid', 'sir_name_en'])
            ->leftJoin('learnerreghrddtls_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
            ->leftJoin('staffinforepo_tbl', 'learnerreghrddtls_tbl.lrhd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
            ->asArray()
            ->all();
            $learnerId = [];
            $learnerName = [];
            $learnerpk = [];
        if($status )
        {
            $data = Batch::ChangeBatchstatus($batchno,$status,$comments);
            if($data)
            {
                if($backtrackreq == NULL){
                    
                 
                 foreach ($learnerlst as $learnerlstrow) {
                    $learnerId = [$learnerlstrow['Irhd_emailid']];
                    $learnerName = [$learnerlstrow['sir_name_en']];
                    \api\components\Mail::learnBulk($batchpk,$learnerId,$learnerName,'cancelreg');    
                    }
                 
                    \api\components\Mail::learnqc($batchpk,'theorycancel'); 
                    
                    
                
                $tutor = \app\models\BatchmgmtdtlsTbl::find()
                  ->select (['oum_firstname','oum_emailid'])
                  ->leftJoin('batchmgmtpracthdr_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtpracthdr_tbl.bmph_batchmgmtdtls_fk')
                  ->leftJoin('opalusermst_tbl', 'batchmgmtpracthdr_tbl.bmph_tutor = opalusermst_tbl.opalusermst_pk')
                  ->where(['batchmgmtdtls_pk' => $batchpk])
                 ->asArray()
                  ->all();

                  $tutormail = [];
                  $tutorname = [];
                    foreach ($tutor as $tutordet) {
                        $tutormail = $tutordet['oum_emailid'];
                        $tutorname = $tutordet['oum_firstname'];

                         if($practical == 1 && $batchtyp == 24){
                               \api\components\Mail::tutbatchDtls($batchpk,$theorypk,$tutormail,$tutorname,'practicancel'); 
                          }

                    }
                    
                    if($accessmentdc == 17){
                       \api\components\Mail::learnqc($batchpk,'accesscentcancel');  
                    }
                    if($accessmentdc == 16){
                        \api\components\Mail::learnqc($batchpk,'accesscancel'); 
                        \api\components\Mail::learnqc($batchpk,'ivqacancel');  
                    }
                    }
                    
                  
                    
                if($backtrackreq == 1){
                   
                    \api\components\Mail::learnqc($batchpk,'backtrackaccept');        
                }
   
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S'];
                 
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F'];
        }
        
        
    }
    
    public function actionRequestforbacktrack(){
        
      
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
      
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
        $comments = isset($request['comments'])? $request['comments'] : null;
     
          $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['batchmgmtdtls_pk','scm_assessmentin','scd_ispratclass'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->where(['bmd_Batchno' => $batchno])
                ->asArray()
                ->one();
        $batchpk=$batchDet['batchmgmtdtls_pk'];
       
        
            $data = Batch::Requestforbacktrack($batchno,$comments);
            if($data)
            {
                \api\components\Mail::learnqc($batchpk,'backtrackreq');
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S'];
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F'];
        
    }
    
    public function actionCancelbacktrack(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
     
           $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['batchmgmtdtls_pk','bmd_reqstatus'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->where(['bmd_Batchno' => $batchno])
                ->asArray()
                ->one();
           
            $batchpk = $batchDet['batchmgmtdtls_pk'];
            $data = Batch::Cancelbacktrack($batchno);
            if($data)
            {
                \api\components\Mail::learnqc($batchpk,'backtrackcancel');
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S'];
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F'];
        
    }
    
     public function actionChangeassesor(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
        $newstff = isset($request['newstff'])? $request['newstff'] : null;
        $oldstff = isset($request['oldstff'])? $request['oldstff'] : null;
        $comments = isset($request['comments'])? $request['comments'] : null;
        $newivqa = isset($request['newivqa'])? $request['newivqa'] : null;
        
        $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['batchmgmtdtls_pk','bmah_reqstatus','scm_assessmentin'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->where(['bmd_Batchno' => $batchno])
                ->asArray()
                ->one();
  
        $batchpk = $batchDet['batchmgmtdtls_pk'];
        $assessmentcentre = $batchDet['scm_assessmentin'];
        $reqstatus = $batchDet['bmah_reqstatus'];
        $oldaccessor = $oldstff['assessorname'];
        $oldaccesspk = $oldstff['assesorpk'];
        $oldivpk = $oldstff['ivqastaffpk'];
        $newaccessor =$newstff['assessorname']; 
        $newaccesspk = $newstff['assesorpk'];
        $newivpk =$newivqa['pk'];
  
 
      
            $data = Batch::Changeassesor($batchno,$oldstff,$newstff,$comments,$newivqa);
            if($data)
            {
               
                 if($assessmentcentre==17){
                    \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'oldaccessor');
                    \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'oldivsatff');
                    \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'newaccessorch');
                    \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'newivsatffch');
                    \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'oldaccesscentre');
                    \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'newaccesscentre');
                    }
                
                
                if($assessmentcentre == 16) {
                   
                \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'changeaccess');
                \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'newaccessor');
                }
               
                
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S'];
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F'];
        
    }
    public function actionRequesttochangeassesor(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
        $oldstff = isset($request['oldstff'])? $request['oldstff'] : null;
        $comments = isset($request['comments'])? $request['comments'] : null;
        
        
            $batchDet = \app\models\BatchmgmtdtlsTbl::find()
                ->select(['batchmgmtdtls_pk','bmah_reqstatus'])
                ->leftJoin('standardcoursedtls_tbl', 'batchmgmtdtls_tbl.bmd_standardcoursedtls_fk = standardcoursedtls_tbl.standardcoursedtls_pk')
                ->leftJoin('standardcoursemst_tbl', 'standardcoursedtls_tbl.scd_standardcoursemst_fk = standardcoursemst_tbl.standardcoursemst_pk')
                ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtdtls_tbl.batchmgmtdtls_pk = batchmgmtasmthdr_tbl.bmah_batchmgmtdtls_fk')
                ->where(['bmd_Batchno' => $batchno])
                ->asArray()
                ->one();
            
            $batchpk = $batchDet['batchmgmtdtls_pk'];
            $oldaccesspk = $oldstff['assesorpk'];
        
       
        
            $data = Batch::Requesttochangeassesor($batchno,$oldstff,$comments);
            if($data)
            {
                \api\components\Mail::accessor($batchpk,$oldaccesspk,$newaccesspk,$oldivpk,$newivpk,'accesschgreq');
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S'];
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F'];
        
    }
    
    public function actionGetassessorlistbybatchpk(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;
        $staffpk = isset($request['staffpk'])? $request['staffpk'] : null;
        $asscentrepk = isset($request['asscentrepk'])? $request['asscentrepk'] : null;
        

        $assessorlist = [];
            $data = Batch::getassessorlistbybatchpk($batchno,$staffpk ,$asscentrepk);
         
         
            if($data)
            {
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S','data'=> $data];
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F','data'=>''];
        
    }
    
    public function actionGetchangeassesorreq(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $batchno = isset($request['batchno'])? $request['batchno'] : null;

        $assessorlist = [];
            $data = Batch::getchangeassesorreq($batchno);
         
            if($data)
            {
                return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S','data'=> $data];
            }
            return ['msg' => 'failure', 'status' => 2, 'flag' => 'F','data'=>''];
        
    }

    public function actionRegisterlearnerfinal()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];
        $batchpk = $params->form->batchmgmtdtls;
        $staffpk =  $params->staff_repo;
        $stafflist = StaffinforepoTbl::registerlearnerfinal($params);
        
       
        
        if(!empty($stafflist['valstatus'])){
            return $stafflist;
        } else {
          \api\components\Mail::learnDtls($batchpk,$staffpk,'learnreg'); 
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $stafflist];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionGetcertified(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $stfcivilno=$request['sir_idnumber'];
        
        // $certReturn = \Yii::$app->db->createCommand("SELECT * from learnercarddtls_tbl 
        // join staffinforepo_tbl on staffinforepo_tbl.staffinforepo_pk = learnercarddtls_tbl.lcd_staffinforepo_fk
        // join learnerreghrddtls_tbl on staffinforepo_tbl.staffinforepo_pk = learnerreghrddtls_tbl.lrhd_staffinforepo_fk
        // left join batchmgmtdtls_tbl on learnercarddtls_tbl.lcd_batchmgmtdtls_fk = batchmgmtdtls_tbl.batchmgmtdtls_pk
        // left join opalmemberregmst_tbl on batchmgmtdtls_tbl.bmd_opalmemberregmst_fk = opalmemberregmst_tbl.opalmemberregmst_pk
        // left join standardcoursedtls_tbl on standardcoursedtls_tbl.standardcoursedtls_pk =  batchmgmtdtls_tbl.bmd_standardcoursedtls_fk
        // left join standardcoursemst_tbl on standardcoursemst_tbl.standardcoursemst_pk = standardcoursedtls_tbl.scd_standardcoursemst_fk
        // left join coursecategorymst_tbl on coursecategorymst_tbl.coursecategorymst_pk= standardcoursedtls_tbl.scd_subcoursecategorymst_fk
        // left join batchmgmtasmtdtls_tbl on learnerreghrddtls_tbl.learnerreghrddtls_pk = batchmgmtasmtdtls_tbl.bmad_learnerreghrddtls_fk
        // left join batchmgmtasmthdr_tbl on batchmgmtasmthdr_tbl.batchmgmtasmthdr_pk = batchmgmtasmtdtls_tbl.bmad_batchmgmtasmthdr_fk
        // left join opalusermst_tbl on batchmgmtasmthdr_tbl.bmah_assessor = opalusermst_tbl.opalusermst_pk
        // left join opalmemberregmst_tbl as assessment_centre on opalusermst_tbl.oum_opalmemberregmst_fk = assessment_centre.opalmemberregmst_pk
        // left join opalcountrymst_tbl on staffinforepo_tbl.sir_nationality = opalcountrymst_tbl.opalcountrymst_pk
        // WHERE lcd_status in (1,2) and sir_idnumber='$stfcivilno' group by learnercarddtls_pk")->queryAll();

        $certReturn = \Yii::$app->db->createCommand("select *,
                    e.omrm_tpname_en as 'traningprovider',
                    e.omrm_tpname_ar as 'traningprovider_ar',
                    f.omrm_tpname_en as 'assesscenter',
                    f.omrm_tpname_ar as 'assesscenter_ar' from batchmgmtdtls_tbl
                    join opalmemberregmst_tbl e on e.opalmemberregmst_pk = bmd_opalmemberregmst_fk 
                    join learnerreghrddtls_tbl on lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk
                    join learnercarddtls_tbl on lcd_learnerreghrddtls_fk = learnerreghrddtls_pk
                    join staffinforepo_tbl on staffinforepo_pk = lrhd_staffinforepo_fk
                    LEFT JOIN batchmgmtasmtdtls_tbl ON learnerreghrddtls_tbl.learnerreghrddtls_pk = batchmgmtasmtdtls_tbl.bmad_learnerreghrddtls_fk
                    LEFT JOIN batchmgmtasmthdr_tbl ON batchmgmtasmthdr_tbl.batchmgmtasmthdr_pk = batchmgmtasmtdtls_tbl.bmad_batchmgmtasmthdr_fk
                    left join standardcoursedtls_tbl on standardcoursedtls_tbl.standardcoursedtls_pk = batchmgmtdtls_tbl.bmd_standardcoursedtls_fk
                    left join standardcoursemst_tbl on standardcoursemst_tbl.standardcoursemst_pk = standardcoursedtls_tbl.scd_standardcoursemst_fk
                    left join coursecategorymst_tbl on coursecategorymst_tbl.coursecategorymst_pk=standardcoursedtls_tbl.scd_subcoursecategorymst_fk
                    left join opalusermst_tbl c on c.opalusermst_pk = bmah_assessor
                    left join opalmemberregmst_tbl f on f.opalmemberregmst_pk = c.oum_opalmemberregmst_fk
                    left JOIN memcompfiledtls_tbl ON staffinforepo_tbl.sir_photo = memcompfiledtls_tbl.memcompfiledtls_pk
                    where sir_idnumber = '$stfcivilno' group by learnerreghrddtls_pk")->queryAll();
        
        return $this->asJson($certReturn);

    }

    public function actionUpdatepaymentstatus()
    {  
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $learner = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk'=> $data['learnid']])->one();
        $learner->lrhd_feestatus = 1;
        $learner_update->lrhd_updatedon=date('Y-m-d H:i:s');          
        $learner_update->lrhd_updatedby=$userPk;

        if($learner->save()) {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => "Payment status updated sucessfully"];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionLearnerage()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $data = [];
        
        $stafflist = StaffinforepoTbl::Learnerage($params);

        if($stafflist) {
            return ['msg' => 'success', 'status' => 1, 'flag' => 'S', 'data' => $stafflist];
        }
        return ['msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => ''];
    }

    public function actionViewlearner()
    {
        $response = [];
        $request_body    = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $data = LearnerreghrddtlsTbl::find()
            ->select(['*', 'license.*'])
            ->leftJoin("staffinforepo_tbl staff", "staff.staffinforepo_pk=lrhd_staffinforepo_fk") //learner license
            ->leftJoin("stafflicensedtls_tbl license", "license.sld_staffinforepo_fk=staff.staffinforepo_pk") //learner license
            ->Where(['learnerreghrddtls_pk' => $request['learpk']])
            ->asArray()
            ->one();
       
        if ($data) {
            $response = [
                'status' => 1, 'valstatus' =>0, 'data' => $data, 'msg' => 'Success',
            ];
        } else {
            $response = [
                'status' => 2, 'valstatus' =>0, 'data' => '', 'msg' => 'Failure',
            ];
        }
        return $this->asJson($response);
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
