<?php

namespace api\components;

use api\components\Common;
use api\components\Security;
use app\models\AppcoursedtlsmainTbl;
use app\models\AppstaffinfomainTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\BatchattdntdwldtrackTbl;
use app\models\BatchmgmtasmthdrTbl;
use app\models\BatchmgmtdtlshstyTbl;
use app\models\BatchmgmtdtlsTbl;
use app\models\BatchmgmtdurationdtlsTbl;
use app\models\BatchmgmtpracthdrTbl;
use app\models\BatchmgmtthyhdrTbl;
use app\models\LearnerreghrddtlsTbl;
use app\models\OpalusermstTbl;
use app\models\TrngattdntdtlsTbl;
use yii\base\BaseObject;
use yii\db\ActiveRecord;

class Batch extends BaseObject{
      
    public static function saveBatchDtls($requestdata)
    {
            $batchpk = BatchmgmtdtlsTbl::saveBatchDtls($requestdata);
            $batchthryhdrpk = BatchmgmtthyhdrTbl::saveBatchThryHdr($batchpk, $requestdata);
            $batchprachdrpk = BatchmgmtpracthdrTbl::saveBatchPracHdr($batchpk, $requestdata);
            $batchasmnthdrpk = BatchmgmtasmthdrTbl::saveBatchAssmntHdr($batchpk, $requestdata);

            $data = [
                'batchpk' => $batchpk,
                'thhdrpk' => $batchthryhdrpk,
                'prhdrpk' => $batchprachdrpk,
                'asmnthdrpk' => $batchasmnthdrpk
            ];

            return $data;
        }
        
    public static function saveBatchtrnDtls($requestdata, $batchdtls)
    {
        $batchmanagemntTrnc = BatchmgmtdurationdtlsTbl::saveBatchdurations($requestdata,$batchdtls);
        
        if($batchmanagemntTrnc)
        {
            foreach($batchmanagemntTrnc as $key => $record)
            {
                foreach($record as $data)
                {
                    if($data)
                    {
                        $model = BatchmgmtdurationdtlsTbl::findOne($data);
                        
                        
                        $date = $model->bmdd_date;
                        $start = $model->bmdd_starttime;
                        $end = $model->bmdd_endtime;
                        $tutorpk = ($key == 'practical') ? $model->bmddBatchmgmtpracthdrFk->bmph_tutor : $model->bmddBatchmgmtthyhdrFk->bmth_tutor ;
                        
                        $assesorChange = AppstaffscheddtlsTbl::ChangeSchedule($tutorpk,$date,$start,$end,32 ,1);
                       
                        
                    }
                }
            }
        }
      
        return $batchmanagemntTrnc;
    }
    
    public static function CheckStaffAvailability($requestdata )
    {
        $thytutor = self::checkbystaffrole($requestdata,'theorytutor');
        $practtutuor = self::checkbystaffrole($requestdata,'practtutor');
        $assessor = self::checkbystaffrole($requestdata,'assessor');
        
        if($thytutor && $thytutor && $thytutor)
        {
            return true;
        }
        $data = [
            'theory' => $thytutor,
            'practical' => $practtutuor,
            'assessor' => $assessor,
        ];
        return $data;
    }
    
    public function checkbystaffrole($requestdata , $type)
    {
        if($type == 'theorytutor')
        {
            $data = [
                'subcategory' => $requestdata['cour_subcate'],
                'language' => $requestdata['assmntlanauge'],
                'regpk' => $requestdata['trainingevlocenter'],
                'duration' => $requestdata['slots'] 
            ];
            $tutor = AppstaffinfomainTbl::getTutorsListForBatch($data);
         
            foreach($tutor as $staff)
            {
                $tutors[] =  $staff['pk'];
            }
            if(in_array($requestdata['tutor'], $tutors))
            {
                
                return true;
            }
        }
        
        if($type == 'practtutor')
        {
            $data = [
                'subcategory' => $requestdata['cour_subcate'],
                'language' => $requestdata['assmntlanauge'],
                'regpk' => $requestdata['trainingevlocenter'],
                'duration' => $requestdata['practslots'] 
            ];
            $tutor = AppstaffinfomainTbl::getTutorsListForBatch($data);
         
            foreach($tutor as $staff)
            {
                $tutorspract[] =  $staff['pk'];
            }
            if(!is_array($requestdata['tutorone']) )
            {
                $requestdata['tutorone'] = (array)$requestdata['tutorone'];
            }
            
            if(array_diff($tutorspract,$requestdata['tutorone']))
            {
                
                return true;
            }
            
        }
        
                if ($type == 'assessor') {
           
                    $date = date('Y-m-d', strtotime($requestdata['assessmentdate']));
            $tutor = Batch::checkavailabilityassessor($date, $requestdata['coursedtlmainpk'], $requestdata['cour_subcate'],$requestdata['assmntlanauge'],$requestdata['wilayat'],$requestdata['trainingevlocenter'],[],1);

          
            foreach ($tutor['data'] as $staff) {
                $tutorsassessor[] = $staff['pk'];
            }
            
            foreach ($requestdata['assessorarr'] as $assessor) {
                $assessorarray[] = $assessor['assessor'];
            }
            
             if(count(array_intersect( $assessorarray,$tutorsassessor)) == count($assessorarray))
            {
                return true;
            }
        }
    }
    
     public static function getCategoryforgridlist()
    {
         $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       
        $allocatedprj = explode(',',\yii\db\ActiveRecord::getTokenData('oum_allocatedproject', true));
        $allocatecategory = explode(',',\yii\db\ActiveRecord::getTokenData('oum_standcoursemst_fk', true));
        $loginuserdtls = OpalusermstTbl::findOne($userpk);

       $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
        $model = BatchmgmtdtlsTbl::find()
                ->select(['ccm_catname_en as category_en','ccm_catname_ar as category_ar','scd_subcoursecategorymst_fk'])
                ->leftJoin('batchmgmtthyhdr_tbl',' bmth_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('batchmgmtpracthdr_tbl','bmph_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('batchmgmtasmthdr_tbl','bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('standardcoursedtls_tbl','standardcoursedtls_pk = bmd_standardcoursedtls_fk')
                ->leftJoin('coursecategorymst_tbl','scd_subcoursecategorymst_fk = coursecategorymst_pk')
                ->leftJoin('opalusermst_tbl','opalusermst_pk = bmah_assessor')
                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk');
       
        if ($stktype == 2) {
            if ($loginuserdtls['oum_isfocalpoint'] == 1 && $loginuserdtls['oum_opalmemberregmst_fk'] == $regPk) {
                $model->having('(FIND_IN_SET('.$regPk.', assessmentcentre)) or bmd_opalmemberregmst_fk ='.$regPk);
            } else {
                $model->andWhere('bmth_tutor =' . $userpk . ' || bmph_tutor =' . $userpk . ' || bmah_assessor =' . $userpk . ' || bmah_ivqastaff =' . $userpk . ' || bmd_createdby =' . $userpk);
                
            }
        }
        
        
        else if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 2 && in_array(2,$allocatedprj))
        {
            
            $model->andWhere(['IN','scd_standardcoursemst_fk',$allocatecategory]);
        }
        else if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 2 && !in_array(2,$allocatedprj))
        {
            $model->andWhere(0);
        }
         else if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 1 )
        {
            $model->andWhere(1);
        }
        
      
       $batches = $model->orderBy('ccm_catname_en')
                ->groupBy('batchmgmtdtls_pk')
                ->asArray()->all();
       
      
        
        foreach ($batches as $key => $batch) {
            
            if($batch['scd_subcoursecategorymst_fk'] != null)
            {
                $categorylist[$key]['pk'] = $batch['scd_subcoursecategorymst_fk'];
                $categorylist[$key]['name_en'] = $batch['category_en'];
                $categorylist[$key]['name_ar'] = $batch['category_ar'];
            }
         
        }
       
    
        
        $categorylist2 =  array_map("unserialize", array_unique(array_map("serialize", $categorylist)));
         
        foreach($categorylist2 as $categories)
        {
            $categorylistfinal[] = $categories;
        }
        
    $recodsset =[];
    $recodsset['categories'] = $categorylistfinal;

    return $recodsset;
             
    }
    
    public static function checkavailabilityassessor($assessmentdate,$start,$end,$coursepmainpk,$language,$subcate,$wilayat,$asscentrepk=null,$numberofassessor = 1,$oldstaff = [],$checkall = 2){
    
        
        
        $regpk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
         
        $coursedtls = AppcoursedtlsmainTbl::find()
                ->select(['acdm_citymst_fk','appiim_citymst_fk','scm_assessmentin'])
                ->leftJoin('appinstinfomain_tbl','appcdm_appinstinfomain_fk = appinstinfomain_pk')
                ->leftJoin('applicationdtlsmain_tbl','appiim_applicationdtlsmain_fk = applicationdtlsmain_pk')
                ->leftJoin('appcompanydtlsmain_tbl','acdm_applicationdtlsmain_fk = appiim_applicationdtlsmain_fk')
                ->leftJoin('standardcoursemst_tbl','appcdm_StandardCoursemst_FK = standardcoursemst_pk')
                ->where(['=','appcoursedtlsmain_pk',$coursepmainpk])
                ->andWhere(['=','appdm_issuspended',2])
                ->asArray()->one();

        $citypk = $wilayat;
        
       
        
        $data = AppstaffscheddtlsTbl::find()
        ->select(['appstaffscheddtls_pk','opalusermst_pk as pk', 'sir_name_en as staffname_en', 'sir_name_ar as staffname_ar', 'omrm_companyname_en as companyname_en', 'omrm_companyname_ar as companyname_ar', 'appsim_roleforcourse', 'assd_dayschedule', 'oum_status', 'assd_date', 'appsim_language', 'aslm_opalcitymst_fk', 'AppStaffInfoMain_PK','aslm_opalcitymst_fk','appstaffinfomain_pk','sccd_cardexpiry','IF(DATE_ADD(NOW(), INTERVAL + 1 MONTH) > sccd_cardexpiry AND NOW() <= sccd_cardexpiry, 1, 0) AS is_nearingexpiry',' IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) <= sccd_cardexpiry AND NOW() > sccd_cardexpiry, 1,  0) AS graceperiod',' IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) > sccd_cardexpiry,  1, 0) AS is_expired','staffcompetencycarddtls_pk AS competancy_pk','DATE_FORMAT(sccd_cardexpiry,"%d-%m-%Y") AS nearingdate','DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 1 MONTH),"%d-%m-%Y") AS graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk','appdt_status as appstatus','appdt_apptype as apptype','standardcoursedtls_pk'])
        ->leftJoin('appstaffinfomain_tbl', 'assd_appstaffinfotmp_fk = appsim_AppStaffInfotmp_FK')
        ->leftJoin('staffinforepo_tbl', 'appsim_StaffInfoRepo_FK = staffinforepo_pk')
        ->leftJoin('opalusermst_tbl', 'staffinforepo_pk = oum_staffinforepo_fk')
        ->leftJoin('opalmemberregmst_tbl', 'oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->leftJoin('appstaffLocationmain_tbl', 'aslm_appstaffinfomain_fk = AppStaffInfoMain_PK')
        ->leftJoin('appcoursetrnsmain_tbl','FIND_IN_SET(appcoursetrnsmain_pk, appsim_appcoursetrnsmain_fk)')
        ->leftJoin('appcoursedtlsmain_tbl','appcoursedtlsmain_pk = appctm_AppCourseDtlsMain_FK')
        ->leftJoin('applicationdtlsmain_tbl a','a.applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
        ->leftJoin('applicationdtlstmp_tbl', 'a.appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('standardcoursedtls_tbl','scd_subcoursecategorymst_fk = '.$subcate.' and scd_standardcoursemst_fk = appcdm_StandardCoursemst_FK')
        ->leftJoin('staffcompetencycardhdr_tbl','staffinforepo_pk = scch_staffinforepo_fk and appcdm_StandardCoursemst_FK = scch_standardcoursemst_fk')
        ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk AND standardcoursedtls_pk = sccd_standardcoursedtls_fk')
        ->leftJoin('applicationdtlsmain_tbl b','a.appdm_opalmemberregmst_fk = b.appdm_opalmemberregmst_fk and b.appdm_projectmst_fk = 1')
        ->where(['IN','sir_type',[1,3]])
        ->andWhere("((FIND_IN_SET('13', appsim_roleforcourse)) || (appsim_roleforcourse = 13 ))")
        ->andWhere(['=', 'oum_status', 'A'])
        ->andWhere(['=', 'a.appdm_issuspended', 2])
        ->andWhere(['=', 'b.appdm_issuspended', 2])
        ->andWhere(['=', 'assd_date', $assessmentdate])
        ->andWhere(['=','assd_dayschedule',64])
        ->andWhere("(FIND_IN_SET('".$subcate."', appctm_coursecategorymst_fk)) || (appctm_coursecategorymst_fk = '".$subcate."' )")
        ->andWhere("(FIND_IN_SET('".$language."', appsim_language)) || (appsim_language = '".$language."' )");


        if($citypk && $coursedtls['scm_assessmentin'] == '17')
        {
           $data->andWhere("(FIND_IN_SET('".$citypk."', aslm_opalcitymst_fk)) || (aslm_opalcitymst_fk = '".$citypk."' )");
        }
        else if(!$citypk && $coursedtls['scm_assessmentin'] == '17')
        {
            $data->andWhere('aslm_opalcitymst_fk is null');
        }
        if($coursedtls['scm_assessmentin'] == '16' && $asscentrepk != 1 )
        {
             $data->andWhere(['=', 'opalmemberregmst_pk', $asscentrepk]);
        }
        else if($regpk == $oldstaff['assessmentcentre'])
        {
              $data->andWhere(['=', 'opalmemberregmst_pk', $regpk]);
        }
        else
        {
            $data->andWhere('opalmemberregmst_pk <>'.$asscentrepk); 
        }
        if($start && $end)
        {
            $data->andWhere("('".$start."'  BETWEEN assd_starttime AND assd_endtime)AND('".$end."'   BETWEEN assd_starttime AND assd_endtime)");

        }
      
        $model = $data->groupBy('staffcompetencycarddtls_pk')
                ->asArray()
                ->all();
       
       
        foreach($model as $record)
        {
           $ivqastaff = AppstaffinfomainTbl::getIVQAStaffbyaccessorpk($record['pk'],$coursepmainpk,$subcate,$language,$wilayat);
           
       
          
           if($ivqastaff['data'])
           {
               $filteredarray[] = $record;
               $staffarray[] = $ivqastaff['data'];
           }
        }
       
       
        if ($staffarray ) {
            $keys = array_rand($filteredarray, $numberofassessor);
            if ($numberofassessor > 1 && $keys) {
                foreach ($keys as $key) {
                    $resarray[] = $filteredarray[$key];
                }
            } else {
        
                $key = array_rand($filteredarray, 1);
                $resarray[] = $filteredarray[$key];
            }
        }
        

    if($model)
    {    
        if($coursedtls['scm_assessmentin'] == '16' || $regpk == 1 || $regpk == $oldstaff['assessmentcentre'] ||$checkall==1)
         {
            
           return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model];
         }
         else if($numberofassessor > 1 && count($resarray) == $numberofassessor && $resarray)
         {
               return ['msg' => 'sucess', 'status' => 3, 'flag' => 'A', 'data' => $resarray];
         }
         else if($numberofassessor > 1 && count($resarray) != $numberofassessor && $resarray)
         {
               return ['msg' => 'sucess', 'status' => 4, 'flag' => 'NL', 'data' => ''];
         }
         else if($resarray)
         {
            return ['msg' => 'assigned', 'status' => 3, 'flag' => 'A', 'data' => $resarray];
         }
         else
         {
              return ['msg' => 'failure', 'status' => 5, 'flag' => 'NAIA', 'data' => '']; // no assessor and ivqa staff available
         }
    }
     return ['msg' => 'failure', 'status' => 2, 'flag' => 'F', 'data' => ''];

         
    }
    public function getAttendanceDetailInfo($batchno){
        $theoryClass = TrngattdntdtlsTbl::find()
            ->select(['batchmgmtdtls_pk','trngattdntdtls_pk','tad_trngdate'])
            ->leftJoin('batchmgmtdtls_tbl','batchmgmtdtls_pk = tad_batchmgmtdtls_fk')
            ->where(['bmd_Batchno'=> $batchno])    
            ->groupBy('tad_trngdate')
            ->orderBy('tad_trngdate ASC')
            ->asArray()
            ->all();
        return $theoryClass;
    }
    public function getTheoryAttendanceForBatch($batchno){
        $theoryClass = TrngattdntdtlsTbl::find()
            ->select(['batchmgmtdtls_pk','trngattdntdtls_pk','tad_trngdate'])
            ->leftJoin('batchmgmtdtls_tbl','batchmgmtdtls_pk = tad_batchmgmtdtls_fk')
            ->where(['bmd_Batchno'=> $batchno])   
            ->andWhere(['not', ['tad_batchmgmtthyhdr_fk' => null]])  
            ->groupBy('tad_trngdate')
            ->orderBy('tad_trngdate ASC')
            ->asArray()
            ->all();
        return $theoryClass;
    }
    public function getPracticalAttendanceForBatch($batchno){
        $practicalClass = TrngattdntdtlsTbl::find()
            ->select(['batchmgmtdtls_pk','trngattdntdtls_pk','tad_trngdate'])
            ->leftJoin('batchmgmtdtls_tbl','batchmgmtdtls_pk = tad_batchmgmtdtls_fk')
            ->where(['bmd_Batchno'=> $batchno])   
            ->andWhere(['not', ['tad_batchmgmtpracthdr_fk' => null]])  
            ->groupBy('tad_trngdate')
            ->orderBy('tad_trngdate ASC')
            ->asArray()
            ->all(); 
        return $practicalClass;
    }
    public function getAttendanceInfo($batchno){
        $attendinfo = TrngattdntdtlsTbl::find()
            ->select(['batchmgmtdtls_pk','bmd_opalmemberregmst_fk','appiim_officetype as officetype','appiim_branchname_en as branchname',
            'bmd_Batchno','omrm_tpname_en as trainingprovider','bmd_batchtype as batchtype','CASE when lrhd_status=1 THEN "New" when lrhd_status=2 THEN "Teaching(theory)"
             when lrhd_status=3 THEN "Teaching(practical)" when lrhd_status=4 THEN "No Show(theory)" when lrhd_status=5 THEN "No Show(practical)" when lrhd_status=6 THEN "Assessment" 
             when lrhd_status=7 THEN "Quality Check" when lrhd_status=8 THEN "Declined during Quality Check" when lrhd_status=9 THEN "Resubmitted for Quality Check" 
             when lrhd_status=10 THEN "Print" when lrhd_status=11 THEN "Completed" when lrhd_status=12 THEN "Re-take Assessment" END AS status',
            'sir_idnumber as civilid','sir_name_en as learnername','thy.oum_firstname as theory_trainer','pract.oum_firstname as pract_trainer',
            'tad_batchmgmtthyhdr_fk as batchmgmtthyhdr_pk','tad_batchmgmtpracthdr_fk as batchmgmtpracthdr_pk','tad_learnerreghrddtls_fk as learnerreghrddtls_pk'])
            ->leftJoin('batchmgmtdtls_tbl','tad_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = bmd_opalmemberregmst_fk')
            ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = bmd_appinstinfomain_fk')
            ->leftJoin('learnerreghrddtls_tbl','lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftJoin('staffinforepo_tbl','staffinforepo_pk = lrhd_staffinforepo_fk')
            ->leftJoin('batchmgmtthydtls_tbl','bmtd_learnerreghrddtls_fk = learnerreghrddtls_pk')
            ->leftJoin('batchmgmtthyhdr_tbl','batchmgmtthyhdr_pk = bmtd_batchmgmtthyhdr_fk')
            ->leftJoin('opalusermst_tbl thy','thy.opalusermst_pk = bmth_tutor')
            ->leftJoin('batchmgmtpractdtls_tbl','bmpd_learnerreghrddtls_fk = learnerreghrddtls_pk')
            ->leftJoin('batchmgmtpracthdr_tbl','batchmgmtpracthdr_pk = bmpd_batchmgmtpracthdr_fk')
            ->leftJoin('opalusermst_tbl pract','pract.opalusermst_pk = bmph_tutor')
            ->where(['bmd_Batchno'=> $batchno])
            ->groupBy('sir_idnumber')    
            ->orderBy('batchmgmtdtls_pk DESC')
            ->asArray()
            ->all();
        return $attendinfo;
    }
    public function downloadAttendance($batchno){
        $userPk =  ActiveRecord::getTokenData('opalusermst_pk', true);
        $theoryClass = self::getTheoryAttendanceForBatch($batchno);
        $practicalClass = self::getPracticalAttendanceForBatch($batchno);      
        if(!empty($theoryClass) && count($theoryClass)>0){
            $batchinfo = BatchmgmtdtlsTbl::find()
                ->select(['bmd_Batchno','rm_name_en','batchmgmtdtls_pk'])
                ->leftJoin('referencemst_tbl','referencemst_pk = bmd_batchtype')
                ->where(['bmd_Batchno'=> $batchno])    
                ->andWhere(['=', 'rm_mastertype', 9])
                ->orderBy('batchmgmtdtls_pk DESC')
                ->asArray()
                ->one();
        $attendinfo = self::getAttendanceInfo($batchno);
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $fol=$batchinfo['batchmgmtdtls_pk'].'/';
        $folder=$srcUrl.'web/exports/'.$fol;
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='Attendance_Report_'.$time;        
        $trackpk = '';
        $downtrack = new BatchattdntdwldtrackTbl();
        $downtrack->badt_batchmgmtdtls_fk = $batchinfo['batchmgmtdtls_pk'];
        $downtrack->badt_opalusermst_fk = $userPk;
        $downtrack->badt_downloadedon = date('Y-m-d H:i:s');
        $downtrack->badt_downloadipaddr = Common::getIpAddress();
        $downtrack->badt_filenamepath = $exeFileName;
        if(!$downtrack->save()){
            print_r($downtrack->getErrors()); exit;
        }else{
            $trackpk = $downtrack->batchattdntdwldtrack_pk;
        }
        $datetime = date("Y-m-d H:i:s");
        $timestamp = strtotime($datetime);
        $dateString = date("d F, Y - h:i A", $timestamp);
        $dateformat='dd\-mm\-yyyy';
        if (extension_loaded('zip')) {
            $zip =new \ZipArchive();
            if ($zip->open($folder.$exeFileName.".zip", \ZipArchive::CREATE) !== TRUE) {
                $error = "* Sorry ZIP creation failed at this time<br/>";
            }  
            // style="mso-number-format:'.$dateformat.'"
            $value = '<table border="1">';
            $value .= '<tr>';
            $value .= '<td colspan="1" style="font-weight:bold;"> Downloaded On </td><td colspan="1"> '.$dateString.' </td>';
            $value .= '</tr>';
            $value .= '</table>';
            $value .= '<table border="1">';
            $value .= '<tr><td colspan="1" style="font-weight:bold;"> Batch Number </td><td colspan="1" > '.$batchinfo['bmd_Batchno'].' </td><td colspan="1" style="font-weight:bold;"> Batch Type </td><td colspan="1" > '.$batchinfo['rm_name_en'].' </td></tr>';
            $value .= '</table><table><tr><td></td></tr></table>';        
            $value .= '<style>.text{mso-number-format:\"\@\";} </style><table border="1" style="border-collapse:collapse;width:100%;">';

                $value .= '<tr style="background-color:#E7E7E7;height:40px">';
                    $value .= '<th>Sl. No</th>';
                    $value .= '<th>Training Provider</th>';
                    $value .= '<th>Office Type</th>';
                    $value .= '<th>Branch Name</th>';
                    $value .= '<th>Tutor/Trainer (Theory)</th>';
                    if(count($practicalClass)>0){
                        $value .= '<th>Tutor/Trainer (Practical)</th>';
                    }
                    $value .= '<th>Civil Number</th>';
                    $value .= '<th>Learner Name</th>';
                    $value .= '<th>Status</th>';
                if(count($theoryClass)>0){
                    $theoryCount = count($theoryClass);
                    $value .= '<th colspan='.$theoryCount.'>';
                    $value .= '<table border="1" style="border-collapse:collapse;width:100%;">';
                    $value .= '<tr><th colspan='.$theoryCount.'>Theory Class Attendance</th></tr>';
                    $value .= '<tr>';
                    foreach($theoryClass as $tvalue){
                        $value .= '<th>'.date("d-M-y", strtotime($tvalue["tad_trngdate"])).'</th>';
                    }
                    $value .= '</tr>';
                    $value .= '</table>';
                    $value .= '</th>';
                }
                if(count($practicalClass)>0){
                    $pracCount = count($practicalClass);
                    $value .= '<th colspan='.$pracCount.'>';
                    $value .= '<table border="1" style="border-collapse:collapse;width:100%;">';
                    $value .= '<tr><th colspan='.$pracCount.'>Practical Class Attendance</th></tr>';
                    $value .= '<tr>';
                    foreach($practicalClass as $pvalue){
                        $value .= '<th>'.date("d-M-y", strtotime($pvalue["tad_trngdate"])).'</th>';
                    }
                    $value .= '</tr>';
                    $value .= '</table>';
                    $value .= '</th>';
                }
                $value .= '</tr>';
                $i=1;
                foreach($attendinfo as $attend){
                    $value .= '<tr>';
                        $value .= '<td valing="top">'.$i++.'</td>';
                        $value .= '<td valing="top">'.$attend["trainingprovider"].'</td>';
                        if($attend["officetype"]==1){
                            $value .= '<td valing="top">Main Office</td>';
                            $value .= '<td valing="top">-</td>';
                        }elseif($attend["officetype"]==2){
                            $value .= '<td valing="top">Branch Office</td>';
                            $value .= '<td valing="top">'.$attend["branchname"].'</td>';
                        }
                        $value .= '<td valing="top">'.$attend["theory_trainer"].'</td>';
                        if(count($practicalClass)>0){
                            $value .= '<td valing="top">'.$attend["pract_trainer"].'</td>';
                        }
                        $value .= '<td valing="top">'.$attend["civilid"].'</td>';
                        $value .= '<td valing="top">'.$attend["learnername"].'</td>';
                        $value .= '<td valing="top">'.$attend["status"].'</td>';
                        if(count($theoryClass)>0){
                            foreach($theoryClass as $tvalue){
                                $theory_data = self::getTheoryAttendByDate($tvalue['tad_trngdate'],$attend['batchmgmtdtls_pk'],$attend['batchmgmtthyhdr_pk'],$attend['learnerreghrddtls_pk']);
                                $value .= '<td valing="top">'.$theory_data.'</td>';
                            }
                        }
                        if(count($practicalClass)>0){
                            foreach($practicalClass as $pvalue){
                                $practical_data = self::getPractAttendByDate($pvalue['tad_trngdate'],$attend['batchmgmtdtls_pk'],$attend['batchmgmtpracthdr_pk'],$attend['learnerreghrddtls_pk']);
                                $value .= '<td valing="top">'.$practical_data.'</td>';
                            }
                        }
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
            $zipfilepath = dirname(__FILE__).'/../web/exports/'.$fol.$exeFileName. '.zip';
            
            $return['status'] = 'success';
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/bm/batchmanagement/downloadattend?id='.Security::encrypt($trackpk)]);;
            return $return;
        }else{
            $return['status'] = 'failure';    
            return $return; 
        }
        }else{
            $return['status'] = 'failure';    
            return $return; 
        }
    }
    public function getTheoryAttendByDate($date, $batchpk, $theorypk, $learnerpk){
        $theoryinfo = TrngattdntdtlsTbl::find()
            ->select(['tad_attended'])
            ->where(['=', 'tad_trngdate', $date])
            ->andWhere(['=', 'tad_batchmgmtdtls_fk', $batchpk])
            ->andWhere(['=', 'tad_batchmgmtthyhdr_fk', $theorypk])
            ->andWhere(['=', 'tad_learnerreghrddtls_fk', $learnerpk])
            ->asArray()
            ->one();
        $return = 'No Show';
        if(count($theoryinfo)>0){
            $return = $theoryinfo['tad_attended']==1? 'Present': 'No Show';
        }
        return $return;
    }
    public function getPractAttendByDate($date, $batchpk, $practpk, $learnerpk){
        $practinfo = TrngattdntdtlsTbl::find()
            ->select(['tad_attended'])
            ->where(['=', 'tad_trngdate', $date])
            ->andWhere(['=', 'tad_batchmgmtdtls_fk', $batchpk])
            ->andWhere(['=', 'tad_batchmgmtpracthdr_fk', $practpk])
            ->andWhere(['=', 'tad_learnerreghrddtls_fk', $learnerpk])
            ->asArray()
            ->one();
        $return = 'No Show';
        if(count($practinfo)>0){
            $return = $practinfo['tad_attended']==1? 'Present': 'No Show';
        }
        return $return;
    }
    
    public static function getassessorlistbybatchpk($batchno, $staffpk, $asscentrepk) {

        $model = BatchmgmtdtlsTbl::find()->where(['=', 'bmd_Batchno', $batchno])->one();
        
        $assmnthdr = BatchmgmtasmthdrTbl::find()
                ->where(['=', 'bmah_batchmgmtdtls_fk', $model->batchmgmtdtls_pk])
                ->andWhere(['=', 'bmah_assessor', $staffpk['assesorpk']])
                ->asArray()
                ->one();

        $exstngassessorpks = BatchmgmtasmthdrTbl::find()
                        ->select(['group_concat(bmah_assessor) as assessorpk'])
                        ->where(['=', 'bmah_batchmgmtdtls_fk', $model->batchmgmtdtls_pk])
                        ->asArray()
                        ->one()['assessorpk'];

        $exstngassessorpksarray = explode(',', $exstngassessorpks);
        
        $subcategory = \app\models\StandardcoursedtlsTbl::findOne($model['bmd_standardcoursedtls_fk'])['scd_subcoursecategorymst_fk'];


        if ($assmnthdr) {
            $list = self::checkavailabilityassessor($assmnthdr['bmah_assessmentdate'],$assmnthdr['bmah_assessstarttime'] ,$assmnthdr['bmah_assessendtime'], $model['bmd_appcoursedtlsmain_fk'], $model['bmd_traininglang'],$subcategory,$model['bmd_citymst_fk'], $asscentrepk ,$staffpk);
           
         
            $assessorlist = [];
            if ($list['status'] == 1) {
                $i = 0;
               
                foreach ($list['data'] as $record) {
               
                    if (!in_array($record['pk'], $exstngassessorpksarray)) {
                    
                        

                        $assessor = OpalusermstTbl::findOne($record['pk']);
                        $ivqastaff = OpalusermstTbl::findOne($staffpk['ivqastaffpk']);
                      
                       
                        if ($assessor->oum_opalmemberregmst_fk == $ivqastaff->oum_opalmemberregmst_fk) {
                            $assessorlist[$i]['assesorpk'] = $record['pk'];
                            $assessorlist[$i]['assessorname'] = $record['staffname_en'];
                            $assessorlist[$i]['ivqastaffpk'] = $staffpk['ivqastaffpk'];
                            $assessorlist[$i]['ivstaffname'] = $staffpk['ivstaffname'];
                            $assessorlist[$i]['assessmentcentre'] = $staffpk['assessmentcentre'];
                            $assessorlist[$i]['assessmentcentrename'] = $staffpk['assessmentcentrename'];
                        } else {
                            $ivqastaff = AppstaffinfomainTbl::getIVQAStaffbyaccessorpk($record['pk'],$model['bmd_appcoursedtlsmain_fk'],$subcategory ,$model['bmd_traininglang'],$model['bmd_citymst_fk']);
                         
                            if (!$ivqastaff['data']) {
                                $assessorlist[$i]= [];
                                $i--;
                            } else {
                                $assessorlist[$i]['assesorpk'] = $record['pk'];
                                $assessorlist[$i]['assessorname'] = $record['staffname_en'];
                                $assessorlist[$i]['ivqastaffpk'] = $ivqastaff['data']['pk'];
                                $assessorlist[$i]['ivstaffname'] = $ivqastaff['data']['staffname_en'];
                                $assessorlist[$i]['assessmentcentre'] = $ivqastaff['data']['comppk'];
                                $assessorlist[$i]['assessmentcentrename'] = $ivqastaff['data']['companyname_en'];
                            }
                        }
                        $i++;
                    }
                  
                }
            } else if ($list['status'] == 3) {
                
                $record = $list['data'];
                if (!in_array($record['pk'], $exstngassessorpksarray)) {
                    $assessor = OpalusermstTbl::findOne($record['pk']);
                    $ivqastaff = OpalusermstTbl::findOne($staffpk['ivqastaffpk']);
                   
                    if ($assessor->oum_opalmemberregmst_fk == $ivqastaff->oum_opalmemberregmst_fk) {
                        $assessorlist[0]['assesorpk'] = $record['pk'];
                        $assessorlist[0]['assessorname'] = $record['staffname_en'];
                        $assessorlist[0]['ivqastaffpk'] = $staffpk['ivqastaffpk'];
                        $assessorlist[0]['ivstaffname'] = $staffpk['ivstaffname'];
                        $assessorlist[0]['assessmentcentre'] = $staffpk['assessmentcentre'];
                        $assessorlist[0]['assessmentcentrename'] = $staffpk['assessmentcentrename'];
                    } else {
                        $ivqastaff = AppstaffinfomainTbl::getIVQAStaffbyaccessorpk($record['pk'],$model['bmd_appcoursedtlsmain_fk'],$subcategory ,$model['bmd_traininglang'],$model['bmd_citymst_fk']);

                        if (!$ivqastaff['data']) {
                            $assessorlist[0]= [];
                            return false;
                        } else {
                            $assessorlist[0]['assesorpk'] = $record['pk'];
                            $assessorlist[0]['assessorname'] = $record['staffname_en'];
                            $assessorlist[0]['ivqastaffpk'] = $ivqastaff['data']['pk'];
                            $assessorlist[0]['ivstaffname'] = $ivqastaff['data']['staffname_en'];
                            $assessorlist[0]['assessmentcentre'] = $ivqastaff['data']['comppk'];
                            $assessorlist[0]['assessmentcentrename'] = $ivqastaff['data']['companyname_en'];
                        }
                    }
                }
                $assessorlist = array_filter($assessorlist);
                
            }
           
           
            return $assessorlist;
        }

        return false;
    }

//    public static function getchangeassesorreq($batchno) {
//        $model = BatchmgmtdtlsTbl::find()->where(['=', 'bmd_Batchno', $batchno])->andWhere(['=', 'bmd_reqstatus',2])->one();
//
//        
//        if($model)
//        {
//             $assmnthdr = BatchmgmtasmthdrTbl::find()
//                ->select(['a.opalusermst_pk as asspk','c.opalusermst_pk as ivqastaffpk','b.sir_name_en as assname_en','d.sir_name_en as ivqastaaname_en','b.sir_name_ar as assname_ar','d.sir_name_ar as ivqastaaname_ar','omrm_companyname_en as compname'])
//                ->leftJoin('batchmgmtdtls_tbl','batchmgmtdtls_pk = bmah_batchmgmtdtls_fk')
//                ->leftJoin('opalusermst_tbl a','a.opalusermst_pk = bmah_assessor')
//                ->leftJoin('staffinforepo_tbl b','b.staffinforepo_pk = a.opalusermst_pk')
//                ->leftJoin('opalusermst_tbl c','c.opalusermst_pk = bmah_ivqastaff')
//                ->leftJoin('staffinforepo_tbl d','d.staffinforepo_pk = c.opalusermst_pk')
//                ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = bmd_opalmemberregmst_fk')
//                ->where(['=', 'bmah_batchmgmtdtls_fk', $model->batchmgmtdtls_pk])
//                ->andWhere(['=', 'bmah_reqstatus',1])
//                ->asArray()
//                ->one();
//      
//        }
//        $exstngassessorpksarray = explode(',', $assmnthdr['bmah_assessor']);
//      
//      
//        if ($assmnthdr && $model) {
//           
//            $i = 0;
//            
//                if (!in_array($assmnthdr['asspk'], $exstngassessorpksarray)) {
//                    $assessorlist[$i]['id'] = $assmnthdr['asspk'];
//                    $assessorlist[$i]['assessorname'] = $assmnthdr['assname_en'];
//                    $assessorlist[$i]['ivstaffname'] = $assmnthdr['ivqastaaname_en'];
//                    $assessorlist[$i]['branchname'] = $assmnthdr['compname'];
//
//                    $assessor = OpalusermstTbl::findOne($assmnthdr['pk']);
//
////                    if ($assessor->oum_opalmemberregmst_fk == $model['bmd_opalmemberregmst_fk']) {
////                        $assessorlist[$i]['ivstaffname'] = $staffpk['id'];
////                        $assessorlist[$i]['branchname'] = $staffpk['branchname'];
////                    }
//                    $i++;
//                }
//           
//            return $assessorlist;
//        }
//        return false;
//    }

    public static function ChangeBatchstatus($batchno,$status,$comments = null){
        
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $batchstatus = $status == 'cancel' ? 7 : $status ;
       
        if($batchstatus)
        {
            $model = BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
           $transaction = \Yii::$app->db->beginTransaction();
         
            $historymodel = BatchmgmtdtlshstyTbl::movetohistory($model);
            if($batchstatus == 7)
            {
                 $cancelbatch = self::Cancelbatch($model->batchmgmtdtls_pk ,$historymodel);
            }
           
            $model->bmd_reqstatus = $batchstatus == 7 ? null : 5;
            $model->bmd_status = $batchstatus;
            $model->bmd_comment = $comments ;
            $model->bmd_updatedon = date('Y-m-d H:i:s');
            $model->bmd_updatedby = $userpk;
            
            if($model->save() && (($batchstatus == 7 && $cancelbatch) || ($batchstatus != 7 )))
            {
                if($batchstatus != 7 ){
                    $learners = \app\models\LearnerreghrddtlsTbl::find()->orwhere(['=','lrhd_status',2])->orwhere(['=','lrhd_status',3])->orwhere(['=','lrhd_status',6])->andwhere(['=','lrhd_batchmgmtdtls_fk',$model->batchmgmtdtls_pk])->all();
                    
                    foreach($learners as $learner){
                        $learnerhistvalue = [
                            'lrhh_learnerreghrddtls_fk' => $learner['learnerreghrddtls_pk'],
                            'lrhh_opalmemberregmst_fk' => $learner['lrhd_opalmemberregmst_fk'],
                            'lrhh_batchmgmtdtls_fk' => $learner['lrhd_batchmgmtdtls_fk'],
                            'lrhh_staffinforepo_fk' => $learner['lrhd_staffinforepo_fk'],
                            'Irhh_emailid' => $learner['Irhd_emailid'],
                            'Irhh_projectmst_fk' => $learner['Irhd_projectmst_fk'],
                            'lrhh_leanerfee' => $learner['lrhd_learnerfee'],
                            'lrhh_feestatus' => $learner['lrhd_feestatus'],
                            'lrhh_paidby' => $learner['lrhd_paidby'],
                            'lrhh_operatorname' => $learner['lrhd_operatorname'],
                            'lrhh_status' => $learner['lrhd_status'],
                            'lrhh_createdon' => $learner['lrhd_createdon'],
                            'lrhh_createdby' => $learner['lrhd_createdby'],
                            'lrhh_updatedby' => $learner['lrhd_updatedby'],
                            'lrhh_updatedon' => $learner['lrhd_updatedon'],
                            'lrhh_appdecon' => $learner['lrhd_appdecon'],
                            'lrhh_appdecby' => $learner['lrhd_appdecby'],
                            'lrhh_appdeccomments' => $learner['lrhd_appdeccomments'],
                        ];
                        $learnerhist = new \app\models\LearnerreghrddtlshstyTbl($learnerhistvalue);
                       
                        if($learnerhist->save()) {
                            $learner->lrhd_status = $batchstatus; 
                            $learner->lrhd_updatedby = $userpk; 
                            $learner->lrhd_updatedon = date('Y-m-d H:i:s');
                            if($learner->save()) {
        
                            }
                            else
                            {
                                $transaction->rollBack();
                                echo "<pre>";
                                var_dump($learner->getErrors());
                                exit;
                            }
                        }
                        else
                        {
                            $transaction->rollBack();
                            echo "<pre>";
                            var_dump($learnerhist->getErrors());
                            exit;
                        }
                    }
                }
                $transaction->commit();
                return true;
            }
            else
            {
                $transaction->rollBack();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
        
        return false;
    }
    public static function Cancelbatch($batchid,$historymodel) {
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $modelthy = \app\models\BatchmgmtthyhdrTbl::find()->where(['=', 'bmth_batchmgmtdtls_fk', $batchid])->one();
        $modeltpr = \app\models\BatchmgmtpracthdrTbl::find()->where(['=', 'bmph_batchmgmtdtls_fk', $batchid])->all();
        $modeltas = \app\models\BatchmgmtasmthdrTbl::find()->where(['=', 'bmah_batchmgmtdtls_fk', $batchid])->all();
        $modeltlrnr = \app\models\LearnerreghrddtlsTbl::find()->where(['=', 'lrhd_batchmgmtdtls_fk', $batchid])->one();
        
        if ($modelthy) {
            $historytheory = \app\models\BatchmgmtthyhdrhstyTbl::movetohistory($modelthy, $historymodel);
            $modelthy->bmth_status = 3;
            $modelthy->bmth_updatedby = $userpk;
            $modelthy->bmth_updatedon = date('Y-m-d H:i:s');
            if ($modelthy->save()) {
                $data['theory'] = $modelthy->batchmgmtthyhdr_pk;
            } else {
                echo "<pre>";
                var_dump($modelthy->getErrors());
                exit;
            }
        }

        if ($modeltpr) {
            foreach($modeltpr as $modelpracteach)
            {
                 $historypractical = \app\models\BatchmgmtpracthdrhstyTbl::movetohistory($modelpracteach, $historymodel);
            $modelpracteach->bmph_status = 3;
            $modelpracteach->bmph_updatedby = $userpk;
            $modelpracteach->bmph_updatedon = date('Y-m-d H:i:s');
            if ($modelpracteach->save()) {
                $data['practical'][] = $modelpracteach->batchmgmtpracthdr_pk;
                
            } else {
                echo "<pre>";
                var_dump($modelpracteach->getErrors());
                exit;
            }
            }
           
        }
    
        $schedulestaff = self::Tutorsunschedule($data);
     
        
      
       
        if($modeltas) {
            foreach($modeltas as $modelasseach)
            {
                 $historyassessment = \app\models\BatchmgmtasmthdrhstyTbl::movetohistory($modelasseach, $historymodel);
               
            $modelasseach->bmah_status = 3;
                $modelasseach->bmah_updatedby = $userpk;
                $modelasseach->bmah_updatedon = date('Y-m-d H:i:s');
                if ($modelasseach->save()) {
                  $data['assessment'][] = $modelasseach->batchmgmtasmthdr_pk;  
                } else {
                    echo "<pre>";
                    var_dump($modeltas->getErrors());
                    exit;
                }
            }
           
        }
        if($data['assessment'])
        {
             foreach($data['assessment'] as $record)
       {
           $modelassesor = BatchmgmtasmthdrTbl::findOne($record);
           $batchdlst = BatchmgmtdtlsTbl::findOne($modelassesor->bmah_batchmgmtdtls_fk);
           
           $staffpk = AppstaffinfomainTbl::find()
                   ->select(['distinct(appsim_AppStaffInfotmp_FK) as staffinfopk'])
                   ->leftJoin('opalusermst_tbl','oum_staffinforepo_fk = appsim_staffinforepo_fk')
                   ->leftJoin('appcoursetrnsmain_tbl','FIND_IN_SET(appcoursetrnsmain_pk, appsim_appcoursetrnsmain_fk)')
                   ->leftJoin('appcoursedtlsmain_tbl','appctm_AppCourseDtlsMain_FK = appcoursedtlsmain_pk')
                   ->leftJoin('standardcoursedtls_tbl','appcdm_StandardCoursemst_FK = scd_standardcoursemst_fk')
                   ->where(['=','opalusermst_pk',$modelassesor->bmah_assessor])
                   ->andWhere(['=','standardcoursedtls_pk',$batchdlst->bmd_standardcoursedtls_fk])
                   ->asArray()
                   ->one()['staffinfopk'];
 
           
            if($staffpk)
            {

                $schedule = AppstaffscheddtlsTbl::find()
                ->where(['=','assd_appstaffinfotmp_fk',$staffpk])
                ->andWhere(['=','assd_date',$modelassesor->bmah_assessmentdate])
                ->andWhere("date_format(assd_starttime,'%H:%i') <= date_format('".$modelassesor->bmah_assessstarttime."','%H:%i')")
                ->andWhere("date_format(assd_endtime,'%H:%i') >= date_format('".$modelassesor->bmah_assessendtime."','%H:%i')")
                ->all();
            
                foreach($schedule as $schedulerecord)
                {
                    $model = $schedulerecord;
                    $model->assd_dayschedule = 64;
                    $model->assd_bookedfor = null;
                  if($model->save())
                  {
                       $data['assessor'][] = $model->appstaffscheddtls_pk;
                       
                  }
                  else
                  {
                      echo "<pre>";
                      var_dump($model->getErrors());
                      exit;
                  }
                }
            }     
       }
        }
        

        return $data;
    }

    public static function Requestforbacktrack($batchno ,$comments){
        
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        
            $model = BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
            $transaction = \Yii::$app->db->beginTransaction();
            $historymodel = BatchmgmtdtlshstyTbl::movetohistory($model);
            $model->bmd_reqstatus = 1;
            $model->bmd_comment = $comments;
            $model->bmd_updatedon = date('Y-m-d H:i:s');
            $model->bmd_updatedby = $userpk;
            
            if($model->save())
            {
                $transaction->commit();
                return true;
            }
            else
            {
                $transaction->rollBack();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        
        return false;
    }
    
    public static function UnscheduleTutors($tutorpk,$date,$start, $end)
    {
        
    }
    public static function Tutorsunschedule($tutorpk)
    {
        $modeltheo = BatchmgmtthyhdrTbl::findOne($tutorpk['theory']);
        $batchdlst = BatchmgmtdtlsTbl::findOne($modeltheo->bmth_batchmgmtdtls_fk);

        $staffpk = AppstaffinfomainTbl::find()
                        ->select(['distinct(appsim_AppStaffInfotmp_FK) as staffinfopk'])
                        ->leftJoin('opalusermst_tbl', 'oum_staffinforepo_fk = appsim_staffinforepo_fk')
                        ->leftJoin('appcoursetrnsmain_tbl', 'FIND_IN_SET(appcoursetrnsmain_pk, appsim_appcoursetrnsmain_fk)')
                        ->leftJoin('appcoursedtlsmain_tbl', 'appctm_AppCourseDtlsMain_FK = appcoursedtlsmain_pk')
                        ->leftJoin('standardcoursedtls_tbl', 'appcdm_StandardCoursemst_FK = scd_standardcoursemst_fk')
                        ->where(['=', 'opalusermst_pk', $modeltheo->bmth_tutor])
                        ->andWhere(['=', 'standardcoursedtls_pk', $batchdlst->bmd_standardcoursedtls_fk])
                        ->asArray()
                        ->one()['staffinfopk'];

        $durationtr = BatchmgmtdurationdtlsTbl::find()
                        ->leftJoin('batchmgmtthyhdr_tbl', 'batchmgmtthyhdr_pk = bmdd_batchmgmtthyhdr_fk')
                        ->asArray()->all();

        foreach ($durationtr as $theo) {
            if ($staffpk) {

                $schedule = AppstaffscheddtlsTbl::find()
                        ->where(['=', 'assd_appstaffinfotmp_fk', $staffpk])
                        ->andWhere(['=', 'assd_date', $theo['bmdd_date']])
                        ->andWhere("date_format(assd_starttime,'%H:%i') <= date_format('" . $theo['bmdd_starttime'] . "','%H:%i')")
                        ->andWhere("date_format(assd_endtime,'%H:%i') >= date_format('" . $theo['bmdd_endtime'] . "','%H:%i')")
                        ->andWhere(['=', 'assd_bookedfor', 1])
                        ->all();

                foreach ($schedule as $schedulerecord) {
                    $stafftheorecord = self::CheckifstaffrecordsPresentTheo($schedulerecord, $modeltheo->bmth_tutor);
                    if ($stafftheorecord) {
                        $model = $schedulerecord;
                        $model->assd_dayschedule = 64;
                        $model->assd_bookedfor = null;
                        if ($model->save()) {
                            $data['assessor'][] = $model->appstaffscheddtls_pk;
                        } else {
                            echo "<pre>";
                            var_dump($model->getErrors());
                            exit;
                        }
                    }
                }
            }
        }

        foreach ($data['practical'] as $tutorpkpract) {
            $modelprac = BatchmgmtpracthdrTbl::findOne($tutorpkpract);
            $batchdlstpract = BatchmgmtdtlsTbl::findOne($modelprac->bmph_batchmgmtdtls_fk);

            $staffpkpract = AppstaffinfomainTbl::find()
                            ->select(['distinct(appsim_AppStaffInfotmp_FK) as staffinfopk'])
                            ->leftJoin('opalusermst_tbl', 'oum_staffinforepo_fk = appsim_staffinforepo_fk')
                            ->leftJoin('appcoursetrnsmain_tbl', 'FIND_IN_SET(appcoursetrnsmain_pk, appsim_appcoursetrnsmain_fk)')
                            ->leftJoin('appcoursedtlsmain_tbl', 'appctm_AppCourseDtlsMain_FK = appcoursedtlsmain_pk')
                            ->leftJoin('standardcoursedtls_tbl', 'appcdm_StandardCoursemst_FK = scd_standardcoursemst_fk')
                            ->where(['=', 'opalusermst_pk', $modelprac->bmph_tutor])
                            ->andWhere(['=', 'standardcoursedtls_pk', $batchdlstpract->bmd_standardcoursedtls_fk])
                            ->asArray()
                            ->one()['staffinfopk'];

            $durationpract = BatchmgmtdurationdtlsTbl::find()
                            ->where(['=', 'bmdd_batchmgmtprachdr_fk', $tutorpkpract])
                            ->asArray()->all();

            foreach ($durationpract as $pract) {
                if ($staffpkpract) {

                    $schedule2 = AppstaffscheddtlsTbl::find()
                            ->where(['=', 'assd_appstaffinfotmp_fk', $staffpk])
                            ->andWhere(['=', 'assd_date', $pract['bmdd_date']])
                            ->andWhere("date_format(assd_starttime,'%H:%i') <= date_format('" . $pract['bmdd_starttime'] . "','%H:%i')")
                            ->andWhere("date_format(assd_endtime,'%H:%i') >= date_format('" . $pract['bmdd_endtime'] . "','%H:%i')")
                            ->andWhere(['=', 'assd_bookedfor', 1])
                            ->all();

                    foreach ($schedule2 as $schedulerecordss) {

                        $staffpractrecord = self::CheckifstaffrecordsPresentPract($schedulerecordss, $modelprac->bmph_tutor);

                        if ($stafftheorecord) {
                            $model2 = $schedulerecordss;
                            $model2->assd_dayschedule = 64;
                            $model2->assd_bookedfor = null;
                            if ($model->save()) {
                                $data['assessor'][] = $model2->appstaffscheddtls_pk;
                            } else {
                                echo "<pre>";
                                var_dump($model2->getErrors());
                                exit;
                            }
                        }
                    }
                }
            }
        }
    }

    public static function CheckifstaffrecordsPresentTheo($record,$pk)
    {
        $recorddata = BatchmgmtdurationdtlsTbl::find()
                ->leftJoin('batchmgmtthyhdr_tbl','batchmgmtthyhdr_pk = bmdd_batchmgmtthyhdr_fk')
                ->where('bmth_tutor ='.$pk)
                ->andWhere(['=', 'bmdd_date', $date])
                ->andWhere(['<>','bmth_status',3])
                ->andWhere("(bmdd_starttime  BETWEEN '".$record->assd_starttime."' AND '".$record->assd_endtime."')OR(bmdd_endtime   BETWEEN '".$record->assd_starttime."' AND '".$record->assd_endtime."')")
                ->count();
        
       
        return ($recorddata > 0 ) ? false :true;
    }
    
    public static function CheckifstaffrecordsPresentPract($record,$pk)
    {
        $recorddata = BatchmgmtdurationdtlsTbl::find()
               
                ->leftJoin('batchmgmtpracthdr_tbl','batchmgmtpracthdr_pk = bmdd_batchmgmtpracthdr_fk')
                ->where('bmth_tutor ='.$pk)
                ->andWhere(['<>','bmph_status',3])
                ->andWhere(['=', 'bmdd_date', $date])
                ->andWhere("(bmdd_starttime  BETWEEN '".$record->assd_starttime."' AND '".$record->assd_endtime."')OR(bmdd_endtime   BETWEEN '".$record->assd_starttime."' AND '".$record->assd_endtime."')")
                ->count();
        
       
        return ($recorddata > 0 ) ? false :true;
    }

    public static function Cancelbacktrack($batchno){
        
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        
         
            $model = BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
            $transaction = \Yii::$app->db->beginTransaction();
            $historymodel = BatchmgmtdtlshstyTbl::movetohistory($model);
            $model->bmd_reqstatus = 4;
            $model->bmd_updatedon = date('Y-m-d H:i:s');
            $model->bmd_updatedby = $userpk;
            
            if($model->save())
            {
                $transaction->commit();
                return true;
            }
            else
            {
                $transaction->rollBack();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        
        return false;
    }
    
    public static function Requesttochangeassesor($batchno,$oldstff,$comments){
        
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        

            $model = BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
            $transaction = \Yii::$app->db->beginTransaction();
         
            $historypk = BatchmgmtdtlshstyTbl::movetohistory($model);
            
            $batchasshdr = BatchmgmtasmthdrTbl::changeassesor($model->batchmgmtdtls_pk,$oldstff,null,$historypk,1,null);
            $model->bmd_reqstatus = 2;
            $model->bmd_comment = $comments;
            $model->bmd_updatedon = date('Y-m-d H:i:s');
            $model->bmd_updatedby = $userpk;
            
            if($model->save() && $batchasshdr)
            {
                $transaction->commit();
                return $model->batchmgmtdtls_pk;
            }
            else
            {
                $transaction->rollBack();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        
        return false;
    }
    public static function Changeassesor($batchno,$oldstff,$newstff,$comments,$newivqa){
        
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        
            $model = BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
            $transaction = \Yii::$app->db->beginTransaction();
            $historypk = BatchmgmtdtlshstyTbl::movetohistory($model);
            $batchasshdr = BatchmgmtasmthdrTbl::changeassesor($model->batchmgmtdtls_pk,$oldstff,$newstff,$historypk,2,$newivqa);
            $model->bmd_reqstatus = 3;
            $model->bmd_comment = null;
            $model->bmd_updatedon = date('Y-m-d H:i:s');
            $model->bmd_updatedby = $userpk;
            
            if($model->save() && $batchasshdr)
            {
                $transaction->commit();
                return $model->batchmgmtdtls_pk;
            }
            else
            {
                $transaction->rollBack();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        
        return false;
    }
    
    public static function MoveBatchToTheory($batchno)
    {
      
         $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
         $transaction = \Yii::$app->db->beginTransaction();
        $historypk = BatchmgmtdtlshstyTbl::movetohistory($model);
        
        $learnermodel = LearnerreghrddtlsTbl::MoveLearnersToTheory($model->batchmgmtdtls_pk);
        
        $learnerscheck = self::updatehdrtbls($model->batchmgmtdtls_pk);
        
            $model->bmd_reqstatus = $model->bmd_reqstatus == 5 ? null :  $model->bmd_reqstatus;
            $model->bmd_status = 2;
            $model->bmd_updatedon = date('Y-m-d H:i:s');
            $model->bmd_updatedby = $userpk;
            
            if($model->save() && $learnermodel && $historypk)
            {
                $transaction->commit();
                return $model->batchmgmtdtls_pk;
            }
            else
            {
                $transaction->rollBack();
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        
        return false;
       
    }
    
    public static function updatehdrtbls($batchpk)
    {
        $batchthyhdr = BatchmgmtthyhdrTbl::find()
                ->where('batchmgmtthyhdr_pk NOT IN (SELECT DISTINCT
            bmtd_batchmgmtthyhdr_fk
        FROM
            batchmgmtthydtls_tbl where bmtd_batchmgmtthyhdr_fk = batchmgmtthyhdr_pk)')
                ->andWhere(['=','bmth_batchmgmtdtls_fk',$batchpk])
                ->one();
        
        if($batchthyhdr)
        {
            $batchthyhdr->bmth_status = 3;
            if(!$batchthyhdr->save())
            {
                echo "<pre>";
                var_dump($batchthyhdr->getErrors());
                exit;
        }
        }
        
        $batchpracthdr = BatchmgmtpracthdrTbl::find()
                ->where('batchmgmtpracthdr_pk NOT IN (SELECT DISTINCT
            bmpd_batchmgmtpracthdr_fk
        FROM
            batchmgmtpractdtls_tbl where bmpd_batchmgmtpracthdr_fk = batchmgmtpracthdr_pk)')
                ->andWhere(['=','bmph_batchmgmtdtls_fk',$batchpk])
                ->one();
        
        if($batchpracthdr)
        {
            $batchpracthdr->bmph_status = 3;
            if(!$batchpracthdr->save())
            {
                echo "<pre>";
                var_dump($batchpracthdr->getErrors());
                exit;
        }
        }
        
        $batchasshdr = BatchmgmtasmthdrTbl::find()
                ->where('batchmgmtasmthdr_pk NOT IN (SELECT DISTINCT
            bmad_batchmgmtasmthdr_fk
        FROM
            batchmgmtasmtdtls_tbl where bmad_batchmgmtasmthdr_fk = batchmgmtasmthdr_pk)')
                ->andWhere(['=','bmah_batchmgmtdtls_fk',$batchpk])
                ->one();
        
        if($batchasshdr)
        {
            $batchasshdr->bmah_status = 3;
            $batchasshdr->save();
        }
        
        
         return true;
    }
        
    
   
       
}
?>