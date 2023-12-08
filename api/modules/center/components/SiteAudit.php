<?php

namespace api\modules\center\components; 

use Yii;
use \app\models\AppauditschedtmpTbl;
use \app\models\AppsiteauditreportcattmpTbl;
use \app\models\AppsiteauditquestionmsttmpTbl;
use \app\models\AppsiteauditanswerdtlsTbl;
use \app\models\ApplicationdtlstmpTbl;
use \app\models\AppstaffinfotmpTbl;
use \app\models\StaffinforepoTbl;
use \app\models\StaffevaluationtmpTbl;
use \app\models\AppapprovalhdrTbl;
use \app\models\ProjapprovalworkflowhrdTbl;
use \app\models\ProjapprovalworkflowuserdtlsTbl;
use \app\models\ProjapprovalworkflowdtlsTbl;
use \app\models\AppoffercoursemainTbl;
use \app\models\StandardcoursemstTbl;
use \app\models\OpalmemberregmstTbl;
use \app\models\OpalInvoiceTbl;
use \yii\db\ActiveRecord;
use \api\components\Security;
use app\models\AppcoursedtlstmpTbl;
use app\models\AppcoursetrnsmainTbl;
use app\models\ApplicationdtlsmainTbl;
use app\models\AppstaffinfomainTbl;
use app\models\AppstafflocationtmpTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\OpalmodulemstTbl;
use app\models\StaffacademicsTbl;
use app\models\StafflicensedtlsTbl;
use app\models\OpalsubmodulemstTbl;
use app\models\RoleallocationdtlsTbl;
use app\models\StaffcompetencycarddtlsTbl;
use app\models\StaffcompetencycardhdrTbl;
use app\models\StaffworkexpTbl;
use app\models\FeesubscriptionmstTbl;
use app\models\ApprasvehinspcattmpTbl;
use Da\QrCode\QrCode;
use app\models\ProjectmstTbl;
use app\models\ OpalusermstTbl;

class SiteAudit {
    public static function siteauditstatus($id) {

        $newdata = AppauditschedtmpTbl::find()
        ->select(['*'])
        ->leftJoin('applicationdtlstmp_tbl app','app.applicationdtlstmp_pk = appasdt_applicationdtlstmp_fk')
        ->leftJoin('appinstinfotmp_tbl ins','ins.appiit_applicationdtlstmp_fk = appasdt_applicationdtlstmp_fk')
        ->leftJoin('opalmemberregmst_tbl mem','mem.opalmemberregmst_pk = app.appdt_opalmemberregmst_fk')
        ->leftJoin('auditscheddtls_tbl','auditscheddtls_pk = appasdt_auditscheddtls_fk')
        ->Where(['appasdt_applicationdtlstmp_fk'=>$id])
        ->asArray()
        ->all();
       
        $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $newdata[0]['appdt_appdecby']])->one();
        $newdata['firstname'] = $model['oum_firstname'];

        return $newdata;

    }

    public static function siteauditList($id) {
        $newdata = [];
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $data = AppsiteauditreportcattmpTbl::find()
        ->select(['appsiteauditreportcattmp_pk as cattmp_pk','asarct_appauditschedtmp_fk as schedtmp_fk','asarct_categorytitle_en as categorytitle','asarct_categorytitle_ar as categorytitle_ar'])
        ->where(['asarct_appauditschedtmp_fk'=>$id])
        ->orderBy('asarct_order asc')
        ->asArray()
        ->all();
        foreach ($data as $key => $value) {
            $data[$key]['title'] = false;
            $data[$key]['ques'] = self::siteauditQuestionList($value['cattmp_pk'],$companyPk,$userPk);
        }
        $newdata = $data;
        return $newdata;
    }

    public function siteauditQuestionList($id,$companyPk,$userPk) {
      
        $data = AppsiteauditquestionmsttmpTbl::find()
        ->select(['appsiteauditquestionmsttmp_pk as questionmst_pk','asaqm_appsiteauditreportcattmp_fk as cattmp_fk','asaqm_question_en as question','asaqm_quesdesc_en as quesdesc','asaqm_question_ar as question_ar','asaqm_quesdesc_ar as quesdesc_ar','asaqm_questiontype as questiontype','asaqm_comments as comments','asaqm_fileupload as fileupload'])
        ->where(['asaqm_appsiteauditreportcattmp_fk' => $id])
        ->orderBy('asaqm_order asc')
        ->asArray()
        ->all();
        foreach ($data as $key => $value) {
         $data[$key]['title'] = false;
         if(!empty($value['fileupload'])) {
             $data[$key]['fileupload'] = $value['fileupload'];
             $fileDtlsPk=$value['fileupload'];
             $data[$key]['link'] = \api\components\Drive::generateUrl($fileDtlsPk, $companyPk, $userPk);
         }
        $data[$key]['commentbox'] = $value['comments'] == '' ? false : true;
         $data[$key]['answer']= self::siteauditAnswerList($value['questionmst_pk']);
         if($data[$key]['answer']) {
          $data[$key]['isselected'] = $data[$key]['answer'][0]['isselected'] == 1 ? $data[$key]['answer'][0]['answer'] : ($data[$key]['answer'][1]['isselected'] == 1 ? $data[$key]['answer'][1]['answer'] : '') ;
         } else {
            $data[$key]['isselected'] = '';
         }

        }
        return $data;
    }

    public static function siteauditAnswerList($id) {
        $data = AppsiteauditanswerdtlsTbl::find()
        ->select(['appsiteauditanswerdtls_pk as answerdtls_pk','asaad_auditquestionmst_fk as questionmst_fk','asaad_answer_en as answer','asaad_answer_ar as answer_ar',"(CASE asaad_isselected WHEN '1' THEN 'true' WHEN '2' THEN 'false' ELSE 'false' END) as isselectedold",'asaad_isselected as isselected'])
        ->where(['asaad_auditquestionmst_fk' => $id])
        ->orderBy('asaad_order asc')
        ->asArray()
        ->all();

        return $data;
    }

    public static function siteAuditMstList($project_id) {
        $data = \app\models\AuditchklstmstTbl::find()
        ->select(['auditchklstmst_pk as cattmp_pk','aclm_projectmst_fk as projectmst_fk','aclm_categorytitle_en as categorytitle'])
        ->where(['aclm_status'=>1])
        ->andWhere(['aclm_projectmst_fk'=>$project_id])
        ->orderBy('aclm_order asc')
        ->asArray()
        ->all();
        foreach ($data as $key => $value) {
            $data[$key]['title'] = false;
            $data[$key]['ques'] = self::siteAuditMstQuestionList($value['cattmp_pk']);
        }
        return $data;

    }
    public static function siteAuditMstQuestionList($id) {
        $data = \app\models\AuditquestionmstTbl::find()
        ->select(['auditquestionmst_pk as questionmst_pk','aqm_auditchklstmst_fk as cattmp_fk','aqm_question_en as question','aqm_quesdesc_en as quesdesc','aqm_questiontype as questiontype'])
        ->where(['aqm_auditchklstmst_fk' => $id])
        ->andWhere(['aqm_status' => 1])
        ->orderBy('aqm_order asc')
        ->asArray()
        ->all();
        foreach ($data as $key => $value) {
         $data[$key]['title'] = false;
         $data[$key]['commentbox'] = false;
         $data[$key]['answer']= self::siteAuditMstAnswerList($value['questionmst_pk']);
        }
        return $data;
    }
    public static function siteAuditMstAnswerList($id) {
        $data = \app\models\AuditanswerdtlsTbl::find()
        ->select(['auditanswerdtls_pk as answerdtls_pk','aad_auditquestionmst_fk as questionmst_fk','aad_answer_en as answer','aad_answer_ar as answer_ar'])
        ->where(['aad_auditquestionmst_fk' => $id])
        ->andWhere(['aad_status' => 1])
        ->orderBy('aad_order asc')
        ->asArray()
        ->all();

        return $data;
    }
    public static function saveAppsiteaudit($response) {
        $msg = '';
        $userPk = '';
        $result= $response['result'];

       
        if(!empty($result)) {
            $siteaudit = self::saveAppsiteauditreportcattmp($result);
        }
        $msg = $siteaudit;
        return $msg;
    }
    public static function saveAppsiteauditreportcattmp($response) {
        $msg = '';
        foreach($response as $savekey => $savevalue) {
            $model = AppsiteauditreportcattmpTbl::findOne($savevalue['cattmp_pk']);
            // $model->asarct_appauditschedtmp_fk = $savevalue['schedtmp_fk'];
            $model->asarct_categorytitle_en = $savevalue['categorytitle'];
            $model->asarct_categorytitle_ar = $savevalue['categorytitle_ar'];
            // $model->asaclm_order = $savekey;
            // $model->appasdt_createdon = date('Y-m-d H:i:s');
            // $model->appasdt_createdby = $userPk;
            if($model->save()) {
                if(!empty($savevalue['ques'])) {
                    $auditquestionmst = self::saveAppsiteauditquestionmst($savevalue['ques']);
                }
            }
            if(!$model->save()) {
                print_r($model->getErrors()); exit;
           }
           $msg=$auditquestionmst;
        }
        return $msg;
    }
    public static function saveAppsiteauditquestionmst($response) {
         $userPk = '';
         $msg = '';
        if(!empty($response)) {
            foreach($response as $savekey => $savevalue) {
                $model = AppsiteauditquestionmsttmpTbl::findOne($savevalue['questionmst_pk']);
                // $model->asaqm_appsiteauditreportcattmp_fk = $savevalue['cattmp_pk'];
                $model->asaqm_question_en = $savevalue['question'];
                $model->asaqm_question_ar = $savevalue['question_ar'];

                // $model->asaqm_quesdesc = $savevalue['quesdesc'];
                // $model->asaqm_questiontype = $savevalue['questiontype'];
                // $model->asaqm_order = $savekey;
                $model->asaqm_comments = $savevalue['comments'];    
                if(!empty($savevalue['fileupload'])) {
                    $model->asaqm_fileupload = $savevalue['fileupload'][1];
                }
                // $model->asaqm_createdon = date('Y-m-d H:i:s');
                // $model->asaqm_createdby = $userPk;
                if($model->save()) {
                    if(!empty($savevalue['answer'])) {
                    $auditquestionmst = self::saveAppsiteauditanswerdtls($savevalue['answer'],$savevalue);
                    }
                }
                if(!$model->save()) {
                    print_r($model->getErrors()); exit;
               }
            }
            $msg=$auditquestionmst;
        }
        return $msg;
    }
    public static function saveAppsiteauditanswerdtls($response,$selected) {
        $userPk = '';
        $msg = '';

        if(!empty($response)){
            foreach($response as $savekey => $savevalue) {
                $model = AppsiteauditanswerdtlsTbl::findOne($savevalue['answerdtls_pk']);
                // $model->asaad_auditquestionmst_fk = $savevalue['cattmp_pk'];
                // $model->asaad_answer_en = $savevalue['answer'];
                // $model->asaad_answer_ar = $savevalue['answer_ar'];

                // $model->asaad_order = $savekey;
                if(!empty($selected['isselected']) && ($selected['questiontype'] == 1)) {
                    if(($selected['isselected'] == $savevalue['answer']) || ($selected['isselected'] == $savevalue['answer_ar'])) {
                        $model->asaad_isselected =  1;
                    } else {
                        $model->asaad_isselected =  2;
                    }
                          
                } else if(!empty($selected['isselected']) && $selected['questiontype'] == 2) {
                    $model->asaad_isselected = $savevalue['isselected'];    
                }
                // $model->asaad_createdon = date('Y-m-d H:i:s');
                // $model->asaad_createdby = $userPk;
                if(!$model->save()) {
                     print_r($model->getErrors()); exit;
                }
            }
         
            $msg='Success';
        }
        return $msg;
    }
    public static function deleteAppsiteauditreportcattmp($cattmp_pk) {
        $msg = '';
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model = AppsiteauditreportcattmpTbl::findOne($cattmp_pk);
        if($model) {
                $questionList = self::siteauditQuestionList($cattmp_pk,$companyPk,$userPk);
                if($questionList) {
                    foreach($questionList as $dkey => $dvalue) {
                        $answerList = self::siteauditAnswerList($dvalue['questionmst_pk']);
                        if($answerList) {
                            $deleteAnswerList = AppsiteauditanswerdtlsTbl::deleteAll('asaad_auditquestionmst_fk=:ques_fk',[':ques_fk' => $dvalue['questionmst_pk']]);
                        }
                        $deleteQuestions = AppsiteauditquestionmsttmpTbl::deleteAll('asaqm_appsiteauditreportcattmp_fk = :cattmp_fk', [':cattmp_fk' => $cattmp_pk]);
                    }
                }
            $model->delete();
            $msg='Success';
        } else {
            $msg='No Records Found';
        }
        return $msg;

    }
    public static function deleteAppsiteauditquestionmst($ques_id) {
        $msg = '';
        $ques_model = AppsiteauditquestionmsttmpTbl::findOne($ques_id);
        if($ques_model) {
            $answerList = self::siteauditAnswerList($ques_model['appsiteauditquestionmsttmp_pk']);
            if($answerList) {
                $deleteAnswerList = AppsiteauditanswerdtlsTbl::deleteAll('asaad_auditquestionmst_fk=:ques_fk',[':ques_fk' => $ques_model['appsiteauditquestionmsttmp_pk']]);
            }
            $ques_model->delete();
            $msg='Success';
        } else {
            $msg='No Records Found';
        }
        return $msg;
    }
  
    public static function staffinforepoList($id) {
        $result = StaffevaluationtmpTbl::find()
        ->select(['staffevaluationtmp_pk','sir_idnumber AS civilnumber',
        'sir_name_en AS staffname',
        'sir_name_ar as staffname_ar',
        "TIMESTAMPDIFF(YEAR, sir_dob, CURDATE()) AS age",
        'ccm_catname_en as cour_subcate',
        'ccm_catname_ar as cour_subcate_ar',
        'appsit_status AS status',
        'set_asmtstatus as ass_status',
        'appsit_createdon AS addedon',
        'appsit_updatedon AS lastupdated'])
         ->leftJoin('appstaffinfotmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
         ->leftJoin('staffinforepo_tbl','staffinforepo_pk = set_staffinforepo_fk')
         ->leftJoin('appcoursetrnstmp_tbl','appsit_appcoursetrnstmp_fk = appcoursetrnstmp_pk')
         ->leftJoin('rolemst_tbl','appsit_roleforcourse = rolemst_pk')
         ->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk AND ccm_status=1')
        ->where(['set_asmttype' => 1])
        ->asArray()
        ->all();
        
        return $result;
    }
    public static function getStaffPracticalAssessment() {
        $requestParam = $_GET;
        ini_set ( 'max_execution_time', 1200);
        $project_id = Security::decrypt($requestParam['project_id']);

        $query = StaffevaluationtmpTbl::find();
        
         $query->select(['*',
         'staffevaluationtmp_pk as setpk',
         'appostaffinfotmp_pk asitpk',
         'staffinforepo_pk sirpk',
         'appsit_roleforcourse as roleforcourse',
         "GROUP_CONCAT(DISTINCT rm_rolename_en SEPARATOR ', ') as roleforcourse_name",
         "GROUP_CONCAT(DISTINCT rm_rolename_ar SEPARATOR ', ') as roleforcourse_name_ar",
         'appsit_appcoursetrnstmp_fk as actfk', // null - standard course or offered course
         'sir_idnumber AS civilnumber',
         'sir_name_en AS staffname',
         'sir_name_ar AS staffname_ar',
         "TIMESTAMPDIFF(YEAR, sir_dob, CURDATE()) AS age",
         "GROUP_CONCAT(DISTINCT ccm_catname_en SEPARATOR ', ') as cour_subcate",
         "GROUP_CONCAT(DISTINCT ccm_catname_ar SEPARATOR ', ') as cour_subcate_ar",
         'appsit_status AS app_status',
         'set_asmtstatus AS ass_status',
         'set_apppytminvoicedtls_fk AS competencycard',
         'set_createdon AS addedon',
         'set_updatedon AS lastupdated',
         'appsit_appoffercoursetmp_fk aoctfk',
         'appctt_coursecategorymst_fk ccmfk',
         'appoct_coursename_en cnen',
         'appoct_coursename_ar cnar',
         'appoct_coursesubcategorymst_fk cscmfk',
         'set_asmtupload atupload'
         ]);
          $query->leftJoin('appstaffinfotmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk');
         $query->leftJoin('staffinforepo_tbl','staffinforepo_pk = set_staffinforepo_fk');
         $query->leftJoin('rolemst_tbl','find_in_set(rolemst_pk , appsit_roleforcourse)');
       
         $query->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)');
         $query->leftJoin('appoffercoursetmp_tbl','find_in_set(appoffercoursetmp_pk, appsit_appoffercoursetmp_fk)');
      
        if($project_id == '3') {
             
        $query->leftJoin('coursecategorymst_tbl','find_in_set(coursecategorymst_pk,appoct_coursesubcategorymst_fk)');
        
        } else {
        $query->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk AND ccm_status=1');

        }

         $query->where([
            'appsit_applicationdtlstmp_fk'=> $requestParam['appid'],
            'set_asmttype' => 2
        ]);
        if($requestParam['gridsearchValues'] != '') {

            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
            
            $civilid = $gridsearchValues['civilnumber'];
            $staffname = $gridsearchValues['staffname'];
            // $age = $gridsearchValues['age'];
            $role  = $gridsearchValues['roleforcourse'];
            $cour_subcate = $gridsearchValues['cour_subcate'];
            // $competencycard = $gridsearchValues['competencycard'];
            $ass_status  = $gridsearchValues['ass_status'];
            $createdon = $gridsearchValues['appsit_createdon'];
            
            $updatedon = $gridsearchValues['appsit_updatedon'];
        

            if($civilid)    //civil id
                {
                        $query->andFilterWhere(['AND',
                        ['LIKE', 'sir_idnumber', $civilid],
                    ]);
                }           
            if($staffname) //staff name filter
                {
                        $query->andFilterWhere(['AND',
                        ['LIKE', 'sir_name_en', $staffname],
                    ]);
                }
            // if($age) //age filter
            //     {
            //             $query->andFilterWhere(['AND',
            //             ['LIKE', 'sir_name_en', $age],
            //         ]);
            //     }
         
              if($ass_status) {  // Practical Assessment Status Filter
                $query->andFilterWhere(['AND',
                    ['LIKE', 'set_asmtstatus', $ass_status],
                ]);
                 
                }
                if($role) {
                    $query->andFilterWhere(['AND',
                        ['LIKE', 'rm_rolename_en', $role],
                    ]);
                    $query->orFilterWhere(['AND',
                    ['LIKE', 'rm_rolename_ar', $role],
                ]);
                }
                if($cour_subcate) {
                    $query->andFilterWhere(['AND',
                        ['LIKE', 'ccm_catname_en', $cour_subcate],
                    ]);
                    $query->orFilterWhere(['AND',
                        ['LIKE', 'ccm_catname_ar', $cour_subcate],
                    ]);
                }
                 if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
                {
                    $query->andFilterWhere(['between', 'date(set_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
                }
                 
                if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
                {
                    $query->andFilterWhere(['between', 'date(set_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
                }
        }

        $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
        $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
        $query->orderBy(["$sort_column" => $order_by]);
           
      // $query = $query->orderBy(['appostaffinfotmp_pk'=>'desc']);
        $query->asArray();
        // echo '<pre>'; print_r($query); exit;
        // echo 'success'; exit;
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
       $raw = $query->createCommand()->getRawSql();
    //    print_R($raw);
    //    exit;
     
        $data = $provider->getModels();
        foreach ($provider->getModels() as $key => $favResData) { 
            $favData[$key] = $favResData;
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appsit_appdecby']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['status'] = ($favResData['appsit_appdeccomment'])?$favResData['appsit_appdeccomment']:'Nil';
        }

        $condata  =  \app\models\AppstaffinfotmpTbl::find()
        ->select(['appostaffinfotmp_pk','staffevaluationtmp_pk','set_asmttype','set_asmtstatus'])
        ->innerJoin('staffevaluationtmp_tbl  set','set.set_appstaffinfotmp_fk = appstaffinfotmp_tbl.appostaffinfotmp_pk')
        ->where("appsit_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])->asArray()->All();
        foreach($condata as $key => $value) {
            $docarray[] = $value['set_asmtstatus'];
        }
        $datastatus = '';
        if (count(array_flip($docarray)) === 1 && end($docarray) === '1') {
            $datastatus=true;
        } else if (count(array_flip($docarray)) === 1 && end($docarray) === '2') {
            $datastatus=true;
        } else if (count(array_flip($docarray)) === 1 && end($docarray) === '3') {
            $datastatus=true;
        } else {
            if(in_array(4,$docarray)){
               $datastatus= false;
           } else if(in_array(3,$docarray) && in_array(1,$docarray)) {
              $datastatus= true;
           } else {
              $datastatus= (bool)array_intersect(array(4), $docarray);
           }
        }
        // if (array_unique($docarray) == 1) {
        //     $datastatus=$docarray;
        // } else {
        //     if(in_array(3,$docarray)){
        //         $datastatus=3;

        //     }
        //     if(in_array(4,$docarray)){
        //         $datastatus=4;

        //     }elseif(in_array(1,$docarray)){
        //         $datastatus=1;

        //     }elseif(in_array(2,$docarray)){
        //         $datastatus=2;

        //     } else {
        //     //   $datastatus=$docarray;

        //     }
        // }
        $response = array();
        $response['data'] = $favData;
        $response['appstatus'] = $datastatus;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
    }
    public static function getStaffPracticalAssessmentData() {
        $requestParam = $_GET;
        // ini_set ( 'max_execution_time', 1200);
        if(!empty($requestParam['project_id'])) {
            $project_id = Security::decrypt($requestParam['project_id']);
        } else {
            $project_id = 2;
        }
        $query = \app\models\AppstaffinfotmpTbl::find();
         $query->select([
            // '*',
         'appostaffinfotmp_pk asitpk',
         'set_asmttype',
        '(case when set_asmttype = 1  then "null"  when set_asmttype = 2 then set_asmtstatus  end) as ass_status',
        '(case when set_asmttype = 1  then "null"  when set_asmttype = 2 then staffevaluationtmp_pk  end) as setpk',
        //  'staffevaluationtmp_pk as setpk',
         'staffinforepo_pk sirpk',
         'appsit_roleforcourse as roleforcourse',
         "GROUP_CONCAT(DISTINCT rm_rolename_en SEPARATOR ', ') as roleforcourse_name",
         "GROUP_CONCAT(DISTINCT rm_rolename_ar SEPARATOR ', ') as roleforcourse_name_ar",
         'appsit_appcoursetrnstmp_fk as actfk', // null - standard course or offered course
         'sir_idnumber AS civilnumber',
         'sir_name_en AS staffname',
         'sir_name_ar AS staffname_ar',
         "TIMESTAMPDIFF(YEAR, sir_dob, CURDATE()) AS age",
         "GROUP_CONCAT(DISTINCT ccm_catname_en SEPARATOR ', ') as cour_subcate",
         "GROUP_CONCAT(DISTINCT ccm_catname_ar SEPARATOR ', ') as cour_subcate_ar",
         'appsit_status AS app_status',
         'set_asmtstatus',
         'appsit_iscarddetails AS competencycard',
         'appsit_createdon AS addedon',
         'appsit_updatedon AS lastupdated',
         'set_asmtupload atupload',
         'appdt_projectmst_fk',
         'appcdt_standardcoursemst_fk',
         'appcdt_appoffercoursemain_fk',
         'appsit_apprasvehinspcattmp_fk'
        //  'appostaffinfotmp_pk'
         ]);
         $query->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsit_staffinforepo_fk');
         $query->leftJoin('rolemst_tbl','find_in_set(rolemst_pk , appsit_roleforcourse)');
         $query->innerJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk=appostaffinfotmp_pk');
         $query->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk=appsit_applicationdtlstmp_fk');
         $query->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = appsit_applicationdtlstmp_fk');

        if($project_id == '3') {
         $query->leftJoin('appoffercoursetmp_tbl','find_in_set(appoffercoursetmp_pk, appsit_appoffercoursetmp_fk)');    
         $query->leftJoin('coursecategorymst_tbl','find_in_set(coursecategorymst_pk,appoct_coursesubcategorymst_fk)');
        } else {
         $query->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)');
         $query->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk AND ccm_status=1');
        }
        $query->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk');
        $query->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
        $query->where([
            'appsit_applicationdtlstmp_fk'=> $requestParam['appid']
        ]);
       

       //invoice number
        $invoicedata  = OpalInvoiceTbl::find()
        ->select(['*'])
        ->where('apid_applicationdtlstmp_fk = '.$requestParam['appid'])    
        ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
        $ass_status = '';
        if($requestParam['gridsearchValues'] != '') {

            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
            
            $civilid = $gridsearchValues['civilnumber'];
            $staffname = $gridsearchValues['staffname'];
            // $age = $gridsearchValues['age'];
            $role  = $gridsearchValues['roleforcourse'];
            $cour_subcate = $gridsearchValues['cour_subcate'];
            $competencycard = $gridsearchValues['competencycard'];
            $ass_status  = $gridsearchValues['ass_status'];
            $createdon = $gridsearchValues['createdon'];
            $updatedon = $gridsearchValues['lastupdated'];
      
            if($civilid)    //civil id
                {
                        $query->andFilterWhere(['AND',
                        ['LIKE', 'sir_idnumber', $civilid],
                    ]);
                }           
            if($staffname) //staff name filter
                {
                        $query->andFilterWhere(['AND',
                        ['LIKE', 'sir_name_en', $staffname],
                    ]);
                }
            if($competencycard){  // competency card

                if($competencycard == '1'){
                    $appcond = "appsit_iscarddetails='3' and staffcompetencycarddtls_pk is null";
                 }else if($competencycard == '2'){
                    $appcond = "sccd_status = '1' and appsit_iscarddetails = '2'";
                 }else if($competencycard == '3'){
                    $appcond = "sccd_status = '2'";
                 }else if($competencycard == '4'){
                    $appcond = "appsit_iscarddetails = '1'";
                 }
                 $query->andWhere($appcond);
                //  $query->andWhere($appcond);
                // if(count($competencycard) >1){
                // $appcond ="";
                // if(in_array(1, $competencycard)){ //new
                // $appcond .= "appsit_iscarddetails='1' ||";
                // }
                // if(in_array(2, $competencycard)){ //active
                // $appcond .= "appsit_iscarddetails='2' ||";
                // }
                // if(in_array(3, $competencycard)){ //expired
                //     $appcond .= "appsit_iscarddetails='3' ||";
                //     }
                // if(in_array(4, $competencycard)){ //posted for upgrade
                //     $appcond .= "appsit_iscarddetails='4' ||";
                //     }
            
            
                // $paymentstscond = rtrim($appcond, "||");
                // $query->andWhere($paymentstscond);
                // }else{
                // if(in_array($competencycard[0], [1,2,3,4])){ 
                // $pymt_sts = $competencycard[0];
                // $query->andWhere("appsit_iscarddetails='$pymt_sts' ");
                // }
                // }
                }

              
                if($ass_status) {  // Practical Assessment Status Filter
                    if($project_id != 4){
                        $query->andFilterWhere(['AND',
                        ['LIKE', 'set_asmtstatus', $ass_status],
                        ]);
                    }
                    if($project_id == 4){


                    }
                }

                
               
  
                if($role) {
                    $query->andFilterWhere(['AND',
                        ['LIKE', 'rm_rolename_en', $role],
                    ]);
                    $query->orFilterWhere(['AND',
                    ['LIKE', 'rm_rolename_ar', $role],
                ]);
                }
                if($cour_subcate) {
                    $query->andFilterWhere(['AND',
                        ['LIKE', 'ccm_catname_en', $cour_subcate],
                    ]);
                    $query->orFilterWhere(['AND',
                        ['LIKE', 'ccm_catname_ar', $cour_subcate],
                    ]);
                }
                 if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
                {
                    $query->andFilterWhere(['between', 'date(appsit_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
                }
                 
                if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
                {
                    $query->andFilterWhere(['between', 'date(appsit_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
                }
        }
      
        $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
        $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
      
        if($project_id == 2 || $project_id == 3){
            $query->groupBy(['staffevaluationtmp_pk']);
        }else{
            $query->groupBy(['appostaffinfotmp_pk']);
        }
        if($sort_column == 'civil_number'){
            $sort_column1 = 'sir_idnumber';
        }else if($sort_column == 'staff_name'){
            $sort_column1 = 'sir_name_en';
        }else if($sort_column == 'status'){
            $sort_column1 = 'set_asmtstatus';
        }else if($sort_column == 'added_on'){
            $sort_column1 = 'appsit_createdon';
        } else if($sort_column == 'last_updatedon'){
            $sort_column1 = 'appsit_updatedon';
        }else{
            $sort_column1 =  $sort_column;
        }
    
        $query->orderBy(["$sort_column1" => $order_by]);
           
      // $query = $query->orderBy(['appostaffinfotmp_pk'=>'desc']);
        $query->asArray();
        $raw = $query->createCommand()->getRawSql();
      //  print_R($raw);
        // exit;
        // echo '<pre>'; print_r($query); exit;
        // echo 'success'; exit;
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
   
        $allrecode = $provider->getModels();
        // Create a new array to store the filtered results
        $dataFiltered = [];
        // Loop through the data array
        foreach ($allrecode as $row) {
            $asitpk = $row['asitpk'];
            // Check if a row with the same asitpk has already been added
            if (!isset($dataFiltered[$asitpk])) {
                $dataFiltered[$asitpk] = $row;
            } else {
                // Check if set_asmttype is 2, if so, replace the existing row
                if ($row['set_asmttype'] == 2) {
                    $dataFiltered[$asitpk] = $row;
                }
            }
        } 
        // Convert the filtered array back to indexed array if needed
        $dataFiltered = array_values($dataFiltered);
        $totalcount = count($dataFiltered);
        // $provider->getTotalCount()
        foreach ($dataFiltered as $key => $favResData) { 
            $favData[$key] = $favResData;
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appsit_appdecby']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['status'] = ($favResData['appsit_appdeccomment'])?$favResData['appsit_appdeccomment']:'Nil';
            $comptcard = AppstaffinfotmpTbl::find()
            ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' 
            when appsit_iscarddetails = 1 then '4'
            when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
            ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
            ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
            if($favResData['appdt_projectmst_fk'] == 2){
                $comptcard->where(['scch_standardcoursemst_fk'=>$favResData['appcdt_standardcoursemst_fk']]);
            }else{
                $comptcard->where(['scch_appoffercoursemain_fk'=>$favResData['appcdt_appoffercoursemain_fk']]);

            }
            $comptcard->andWhere(['appostaffinfotmp_pk'=>$favResData['asitpk']]);
            $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
            $compt =  $comptcard->asArray()->one();
            $favData[$key]['competencycard'] =  empty($compt['competcard'])?'1':$compt['competcard'];
            //practical assessment status
            $categoryarray = explode(',',$favResData['appsit_apprasvehinspcattmp_fk']);
            foreach($categoryarray as $data){
            $rascategory = ApprasvehinspcattmpTbl::find()->where(['apprasvehinspcattmp_pk' => $data])->asArray()->one();
            $staffevaluation = StaffevaluationtmpTbl::find()->where(['set_appstaffinfotmp_fk' => $favResData['asitpk'],'set_staffinforepo_fk'=>$favResData['sirpk'],'set_asmttype' =>'2', 'set_rascategorymst_fk' => $rascategory['arvict_rascategorymst_fk']]);
            if($favResData['competencycard'] == 1){
                $staffevaluation->andWhere(['set_apppytminvoicedtls_fk'=>$invoicedata['apppytminvoicedtls_pk']]);
            }
            $staffevaluation->orderBy(['staffevaluationtmp_pk' => SORT_DESC]);
            $staffevaluation =  $staffevaluation->asArray()->one();
            $cat[$favResData['asitpk']][$rascategory['arvict_rascategorymst_fk']] = $staffevaluation['set_asmtstatus'];
            }
            $practstatus = $cat[$favResData['asitpk']];   
            if(count(array_filter($practstatus)) == count($practstatus) && !in_array(4, $practstatus)  && !in_array(7, $practstatus)) {
            $favData[$key]['overallstatus'] = 'Completed';
            } else {
            $favData[$key]['overallstatus'] = 'Pending';
            }
        }
        $condata  =  AppstaffinfotmpTbl::find()
        ->select(['appostaffinfotmp_pk','set_appstaffinfotmp_fk','set_staffinforepo_fk','staffevaluationtmp_pk','set_asmtstatus','set_asmttype'])
        ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk=appostaffinfotmp_pk AND set_asmttype=2')
        ->where("appsit_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])
        ->asArray()->all();
        foreach($favData as $key => $value) {
            if($value['overallstatus'] == 'Pending' && $ass_status == '5'){
                $favData1 = $favData;  
            }
            else if($value['overallstatus'] == 'Completed' && $ass_status == '6'){
                $favData1 = $favData;  
            }else if($ass_status == ''){
                $favData1 = $favData;
            }
            $docarray[] = $value['ass_status'];
            $statusarray[] = $value['overallstatus'];
        }
        $datastatus = '';
        // if (count(array_flip($docarray)) === 1 && end($docarray) === '1') {
        //     $datastatus=true;
        // } else if (count(array_flip($docarray)) === 1 && end($docarray) === '2') {
        //     $datastatus=true;
        // } else if (count(array_flip($docarray)) === 1 && end($docarray) === '3') {
        //     $datastatus=true;
        // } else {
           
        // }
        if(in_array(4,$docarray) || in_array(null,$docarray) || in_array('null',$docarray) ){
            $datastatus= false;
        } else if(in_array(3,$docarray) || in_array(1,$docarray) || in_array(2,$docarray)) {
           $datastatus= true;
        } else {
           $datastatus= (bool)array_intersect(array(4), $docarray);
        }

        $practicalstatus = '';
        if(in_array('Pending',$statusarray)){
            $practicalstatus= false;
        } else if(in_array('Completed',$statusarray)) {
           $practicalstatus= true;
        }
        $response = array();
        $response['data'] = ($project_id == 4)?$favData1:$favData;
        $response['appstatus'] = $datastatus;
        $response['practicalstatus'] = $practicalstatus;
        $response['totalcount'] = $totalcount;
        $response['size'] = $page;
        return $response;
    }
    public static function saveStaffevaluationnewtmp($data) {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $status = "success";
            $isExists = StaffevaluationtmpTbl::find()->where(['set_appstaffinfotmp_fk' => $data['appostaffinfotmp_pk'],'set_staffinforepo_fk'=>$data['appsit_staffinforepo_fk']])->asArray()->all();
            // For new insertion  appostaffinfo_pk
            if(count($isExists) == 0) {

                $newmodel = new  StaffevaluationtmpTbl();
                $newmodel->set_appstaffinfotmp_fk = $data['appostaffinfotmp_pk'];
                $newmodel->set_staffinforepo_fk = $data['appsit_staffinforepo_fk'];
                $newmodel->set_asmtmode = 1;
                $newmodel->set_asmttype = 2;               
                $newmodel->set_asmtstatus = 1;
                
                $newmodel->set_createdon = date('Y-m-d H:i:s');
                $newmodel->set_createdby = $userPk;
                
                if(!$newmodel->save()) {
                    $status = "failed";
                }
            }

     return $status;
    }
    public static function saveStaffevaluationtmp($data,$id,$sitid) {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $status = "";
        // print_r($id);exit;
        if(!empty($id) && isset($id) && $id != "null") {
               
            if(!empty($data)) {
                
                $model = StaffevaluationtmpTbl::findOne($id);
                if(!empty($data['assessmentcomment'])) {
                    $appstaffinfotmp_model = AppstaffinfotmpTbl::findOne($model->set_appstaffinfotmp_fk);
                    $appstaffinfotmp_model->appsit_appdeccomment = $data['assessmentcomment']; 
                    if($appstaffinfotmp_model->save()) {
                    $status = "Updated";
                    }
                    
                }
                if(!empty($model)) {
                
                $model->set_appstaffinfotmp_fk = $model->set_appstaffinfotmp_fk;
                $model->set_staffinforepo_fk = $model->set_staffinforepo_fk;

                if(!empty($data['file_award'])) {
                    $model->set_asmtupload = $data['file_award'][0];
                }
                $model->set_asmtmode = 1;
                $model->set_asmttype = 2;               
                $model->set_asmtstatus = $data['selectstatus'];
                
                $model->set_updatedon = date('Y-m-d H:i:s');
                $model->set_updatedby = $userPk;
                
                if($model->save()) {
                    $status = "Updated";
                }
            }
            }
        } else {

               $appstaffinfotmp = ($sitid);
           
            $staffInfoTempData = AppstaffinfotmpTbl::find()->where(['appostaffinfotmp_pk' => $appstaffinfotmp])->asArray()->one();
        
            if($staffInfoTempData) {
                if(!empty($data['assessmentcomment'])) {
                    $appstaffinfotmp_model = AppstaffinfotmpTbl::findOne($staffInfoTempData['appostaffinfotmp_pk']);
                    $appstaffinfotmp_model->appsit_appdeccomment = $data['assessmentcomment']; 
                    if($appstaffinfotmp_model->save()) {
                      $status = "Updated";
                    }
                    
                }
                  // For new insertion 
                $newmodel = new  StaffevaluationtmpTbl();
                $newmodel->set_appstaffinfotmp_fk = $staffInfoTempData['appostaffinfotmp_pk'];
                $newmodel->set_staffinforepo_fk = $staffInfoTempData['appsit_staffinforepo_fk'];

                if(!empty($data['file_award'])) {
                    $newmodel->set_asmtupload = $data['file_award'][0];
                }
                $newmodel->set_asmtmode = 1;
                $newmodel->set_asmttype = 2;               
                $newmodel->set_asmtstatus = $data['selectstatus'];
                
                $newmodel->set_createdon = date('Y-m-d H:i:s');
                $newmodel->set_createdby = $userPk;
                if(!$newmodel->save()) {
                    print_r($newmodel->getErrors()); exit;
                   }
                if($newmodel->save()) {
                    $status = "Updated";
                }
              
            }

          }
          
        return $status;
    }

    public static function getStaffAssessmentStatus($id,$app_id,$asit_id) {
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $project_id = 2;
        if(!empty($id) && ($id != 'null')) {
            $result = StaffevaluationtmpTbl::find()
            ->select(['*','appoct_coursename_en','appoct_coursename_ar','sir_name_en as staffname','sir_name_ar as staffname_ar', 'sir_idnumber as civilnumber','appsit_roleforcourse','appsit_appcoursetrnstmp_fk','set_createdon as createdon','set_updatedon as updatedon','appsit_status as app_status','set_asmtupload','appsit_appdeccomment','set_asmtstatus',
            "GROUP_CONCAT(DISTINCT rm_rolename_en SEPARATOR ', ') as roleforcourse_name",
            "GROUP_CONCAT(DISTINCT rm_rolename_ar SEPARATOR ', ') as roleforcourse_name_ar",
            'appsit_appcoursetrnstmp_fk as actfk', // null - standard course or offered cours
            "GROUP_CONCAT(DISTINCT ccm_catname_en SEPARATOR ', ') as cour_subcate",
            "GROUP_CONCAT(DISTINCT ccm_catname_ar SEPARATOR ', ') as cour_subcate_ar",
            'appsit_status AS app_status',
            'set_asmtstatus AS ass_status',
            'appsit_iscarddetails AS competencycard',"(CASE
        WHEN set_asmttype = 1 THEN 'null'
        WHEN set_asmttype = 2 THEN set_asmtstatus
    END) AS ass_status1"])
            ->leftJoin('appstaffinfotmp_tbl','appostaffinfotmp_pk=set_appstaffinfotmp_fk')
            ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk=appsit_applicationdtlstmp_fk')
            ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk=appsit_applicationdtlstmp_fk')
            ->leftJoin('staffinforepo_tbl','staffinforepo_pk=set_staffinforepo_fk')
            ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk , appsit_roleforcourse)')    
            ->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)')
            ->leftJoin('appoffercoursetmp_tbl','find_in_set(appoffercoursetmp_pk, appsit_appoffercoursetmp_fk)')  
            ->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk AND ccm_status=1')          
            ->where(['set_asmttype' => 2])
            ->andWhere(['staffevaluationtmp_pk' => $id])
            ->asArray()
            ->one();
        } else {

         $result = AppstaffinfotmpTbl::find()
        ->select(['*','appoct_coursename_en','appoct_coursename_ar','sir_name_en as staffname','sir_name_ar as staffname_ar', 'sir_idnumber as civilnumber','appsit_roleforcourse','appsit_appcoursetrnstmp_fk','set_createdon as createdon','set_updatedon as updatedon','appsit_status as app_status','set_asmtupload','appsit_appdeccomment','set_asmtstatus',
        "GROUP_CONCAT(DISTINCT rm_rolename_en SEPARATOR ', ') as roleforcourse_name",
        "GROUP_CONCAT(DISTINCT rm_rolename_ar SEPARATOR ', ') as roleforcourse_name_ar",
        'appsit_appcoursetrnstmp_fk as actfk', // null - standard course or offered cours
        "GROUP_CONCAT(DISTINCT ccm_catname_en SEPARATOR ', ') as cour_subcate",
        "GROUP_CONCAT(DISTINCT ccm_catname_ar SEPARATOR ', ') as cour_subcate_ar",
        'appsit_status AS app_status',
        'appsit_status AS ass_status',
        'appsit_iscarddetails AS competencycard',"(CASE
        WHEN set_asmttype = 1 THEN 'null'
        WHEN set_asmttype = 2 THEN set_asmtstatus
    END) AS ass_status1"])
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsit_staffinforepo_fk')
        ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk=appsit_applicationdtlstmp_fk')
        ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk=appsit_applicationdtlstmp_fk')
        ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk=appostaffinfotmp_pk')
        ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk , appsit_roleforcourse)')    
        ->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)')
        ->leftJoin('appoffercoursetmp_tbl','find_in_set(appoffercoursetmp_pk, appsit_appoffercoursetmp_fk)')  
        ->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk AND ccm_status=1')           
        ->where(['appostaffinfotmp_pk' => $asit_id])
        ->asArray()->one();
        
    }
    // $raw = $result->createCommand()->getRawSql();
    //     print_R($raw);
    //     exit;
    $comptcard = AppstaffinfotmpTbl::find()
    ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' 
    when appsit_iscarddetails = 1 then '4'
    when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
    ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
    ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
    if($result['appdt_projectmst_fk'] == 2){
        $comptcard->where(['scch_standardcoursemst_fk'=>$result['appcdt_standardcoursemst_fk']]);
    }else{
        $comptcard->where(['scch_appoffercoursemain_fk'=>$result['appcdt_appoffercoursemain_fk']]);

    }
    $comptcard->andWhere(['appostaffinfotmp_pk'=>$result['appostaffinfotmp_pk']]);
    $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
    $compt =  $comptcard->asArray()->one();
    // $compt =  $comptcard->createCommand()->getRawSql();
// print_r($result['appdt_projectmst_fk']);exit;
    $result['competencycard'] =  empty($compt['competcard'])?'1':$compt['competcard'];
		$fileDtlsPk=$result['set_asmtupload'];
        // api\components\Drive.php
		$result['link'] = \api\components\Drive::generateUrl($fileDtlsPk, $companyPk, $userPk);
                         
        return $result;
    }

    public static function deleteStaffEvaluation($id) {
        $set_model = StaffevaluationtmpTbl::findOne($id);
        if($set_model) {
          $staffworkexp = StaffworkexpTbl::find()->where(['sexp_staffinforepo_fk' => $set_model->set_staffinforepo_fk])->asArray()->all();
            if(count($staffworkexp) > 0) {
                foreach ($staffworkexp as $swkey => $swvalue) {
                    $staffworkexp[$swkey]->delete();
                }
            }
        
           $appstaffschedule = AppstaffscheddtlsTbl::find()->where(['assd_appstaffinfotmp_fk' => $set_model->set_appstaffinfotmp_fk])->asArray()->all();
          if(count($appstaffschedule) > 0) {
              foreach ($appstaffschedule as $asskey => $assvalue) {
               $appstaffschedule[$asskey]->delete();
               }
           }
       
           $appstafflocation =  AppstafflocationtmpTbl::find()->where(['aslt_appostaffinfotmp_fk' => $set_model->set_appstaffinfotmp_fk])->asArray()->all();
           if(count($appstafflocation) >0) {
               foreach ($appstafflocation as $aslkey => $aslvalue) {
                     $appstafflocation[$aslkey]->delete();
                }
           }
           $staffacademics = StaffacademicsTbl::find()->where(['sacd_staffinforepo_fk' => $set_model->set_staffinforepo_fk])->asArray()->all();
           if(count($staffacademics) >0) {
               foreach ($staffacademics as $sakey => $savalue) {
                $staffacademics[$sakey]->delete();
               }
           }
           $setValues = StaffevaluationtmpTbl::find()->where(['set_staffinforepo_fk' => $set_model->set_staffinforepo_fk, 'set_appstaffinfotmp_fk' => $set_model->set_appstaffinfotmp_fk])->asArray()->all();
           if(count($setValues) > 0) {
             foreach ($setValues as $setkey => $setvalue) {
                 $setValues[$setkey]->delete();
             }
           }
          
          // appstaffscheddtls_tbl appstaffLocationtmp_tbl staffinforepo_tbl staffacademics_tbl staffworkexp_tbl stafflicensedtls_tbl staffcompetencycardhdr_tbl 
          //   scch_staffinforepo_fk 
            $appstaff = AppstaffinfotmpTbl::findOne($set_model->set_appstaffinfotmp_fk);
            if($appstaff) {
                $appstaff->delete();
            }
            
            
            $status='Success';
        } 
        return $status;
    }
    public static function getApprovalworkflow($project_id,$role_id) {
        $data = [];
            $data['pawht'] = ProjapprovalworkflowhrdTbl::find()->where(['pawfh_projectmst_fk'=>$project_id,'pawfh_formstatus' => 1,'pawfh_status'=>1])->asArray()->all();

            $data['pawfdt'] =  ProjapprovalworkflowdtlsTbl::find()->where(['pawfd_projapprovalworkflowhrd_fk'=>$data['pawht']->projapprovalworkflowhrd_pk])->asArray()->all();
            $data['pawfudt'] = ProjapprovalworkflowuserdtlsTbl::find()->where(
                ['pawfud_projapprovalworkflowhrd_fk'=>$data['pawht']->pawfd_projapprovalworkflowhrd_fk]
            )->asArray()->all();
           return $data;
    }
    public static function updateAppApprovalHDR($app_id,$formstatus,$appdeccomments,$app_status,$dec=false) {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $status='';
        if($app_id != null) {
            $lastInsert = AppapprovalhdrTbl::find()
              ->where(['aah_applicationdtlstmp_fk' => $app_id])
              ->orderBy(['appapprovalhdr_pk' => SORT_DESC])
              ->asArray()->one(); 
            if($lastInsert) {
                $lastInsert->aah_formstatus = $formstatus;
                $lastInsert->aah_status = $app_status;
                if(!empty($appdeccomments)) {
                    $lastInsert->aah_appdecComments = $appdeccomments;
                }
                if($dec) {
                    $lastInsert->aah_appdecon = date('Y-m-d H:i:s');
                    $lastInsert->aah_appdecby = $userPk ;
                }


                if($lastInsert->save()) {
                    $status = "Success";
                }
            }
        }
        return $status;
    }
    public static function saveAppApprovalHDR($app_id,$hrd_fk,$dtls_fk,$userdtls_fk,$comments='',$formstatus=1,$sts=null,$dec=false) {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $status='';
        $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $app_id])->orderBy('appapprovalhdr_pk desc')->one();
        $model_ApplicationdtlstmpTbl =  ApplicationdtlstmpTbl::findOne(['applicationdtlstmp_pk' => $app_id]);
        $updatemodel->aah_status = $sts;
        if(!empty($comments)) {
            $updatemodel->aah_appdecComments = $comments;
        }        $updatemodel->aah_appdecon = date("Y-m-d H:i:s");
        $updatemodel->aah_appdecby = $userPk;
        $updatemodel->save();
if($model_ApplicationdtlstmpTbl->appdt_status != 17 ){
            $apptype = $model_ApplicationdtlstmpTbl->appdt_apptype;
            if($apptype == 1){
                $approvaltype = 1;
            }else if($apptype == 2){
                $approvaltype = 4;
            }else if($apptype == 3){
                $approvaltype = $updatemodel->aah_formstatus;
            }
            if($model_ApplicationdtlstmpTbl->appdt_status == 10 || $model_ApplicationdtlstmpTbl->appdt_status == 14 ){
                $roletype = 3;
               }elseif($model_ApplicationdtlstmpTbl->appdt_status == 11 || $model_ApplicationdtlstmpTbl->appdt_status == 15 ){
                $roletype = 4;
               }elseif($model_ApplicationdtlstmpTbl->appdt_status == 12 || $model_ApplicationdtlstmpTbl->appdt_status == 16 ){
                $roletype = 7;
               }else{
                $roletype = 5;
               }
            $info = SiteAudit::getApprovalHdrInfo($model_ApplicationdtlstmpTbl->appdt_projectmst_fk, $approvaltype, $roletype);
           

        if($app_id != null && $model_ApplicationdtlstmpTbl->appdt_status != 17) {   
            $aahdr = new AppapprovalhdrTbl();
            $aahdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
            $aahdr->aah_projapprovalworkflowdtls_fk =$info['projapprovalworkflowdtls_pk'];
            $aahdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
            $aahdr->aah_applicationdtlstmp_fk = $app_id;
            $aahdr->aah_formstatus = $updatemodel->aah_formstatus;
            // $aahdr->aah_status = $sts;
            $aahdr->aah_status = null;
            // if(!empty($comments)) {
                // $aahdr->aah_appdecComments = $comments;
            // }
            // if($dec) {
            //     $aahdr->aah_appdecon = date('Y-m-d H:i:s');
            //     $aahdr->aah_appdecby = $userPk;
            // }
            // if(!$aahdr->save()) {
            //     print_r($aahdr->getErrors()); exit;
            // }
            if($aahdr->save()) {
                $status = "Success";
            }
        }
    }
        return $status;
    }
    public static function saveAppApprovalNextLevel($app_id,$request_data) {
        $status = "";
        $userPk =  ActiveRecord::getTokenData('opalusermst_pk', true);
        $proj_pk = Security::decrypt($request_data['course_type']);
       
        $formstatus = 1;
        $sts = 1;
        $app_model = ApplicationdtlstmpTbl::findOne($app_id);
        if($app_model) {
            $app_model->appdt_appdecby = $userPk;
            $app_model->appdt_appdecon = date('Y-m-d H:i:s');
            $app_model->appdt_status = $request_data['type'];
            $app_model->appdt_appdeccomment = '';
            if($app_model->save()) {
                
                $status = "Success";
            }
        $siteaudittbl = AppauditschedtmpTbl::find()->Where(['appasdt_applicationdtlstmp_fk'=>$app_id])->one();
        $siteaudittbl->appasdt_status = 3;
        $siteaudittbl->save();
            $appapproval = self::saveAppApprovalHDR($app_id,$request_data['hrd_fk'],$request_data['dtls_fk'],$request_data['userdtls_fk'],'',$formstatus,$sts,true);
            if($proj_pk == '4'){
                \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $app_id)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 4)
                    ->execute();
                    $generate = SiteAudit::generatesiteauditreportras($app_id);

            }else{
                \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                ->bindValue(':p1' , $app_id)
                ->bindValue(':p2' , '')
                ->bindValue(':p3' , $proj_pk)
                ->execute();

            }
           
        }
        return $status;
    }

    public static function changeApprovalStatus($app_id,$sts) {
        $status = "";
         
        $lastInsert = AppapprovalhdrTbl::findOne('aah_applicationdtlstmp_fk=:aah_applicationdtlstmp_fk',['aah_applicationdtlstmp_fk' => $app_id]); 
        // $lastInsert = AppapprovalhdrTbl::find()->where(['aah_applicationdtlstmp_fk' => $app_id])->asArray()->one(); 
        if($lastInsert) {
            $lastInsert->aah_formstatus = 1;
            $lastInsert->aah_status = $sts;
            $lastInsert->save();
            $status="success";
        }
        return $status;
    }
  
    public static function approveOrDeclineProcess($app_id, $request_data) {
        $status = "";
        $userPk =  ActiveRecord::getTokenData('opalusermst_pk', true);
        $course_type = Security::decrypt($request_data['course_type']);
        $app_model = ApplicationdtlstmpTbl::findOne($app_id);
        $projectpk = $app_model->appdt_projectmst_fk;
        $formstatus = 1;
        $appsts = 1;
        if($app_model) {
            $app_model->appdt_appdecby = $userPk;
            $app_model->appdt_appdecon = date('Y-m-d H:i:s');
            $app_model->appdt_appdeccomment = $request_data['comments'];
            if($projectpk != 4){
            if($app_model->appdt_status == 10) {
            //QA Approval
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '11';
            } 
            // else if($app_model->appdt_status == 11) {
            //     //CEO Approval
            //     $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '9' : '12';
            // } 
            else if($app_model->appdt_status == 11) {
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '17';
            } else if($app_model->appdt_status == 13) {
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '14';
            } else if($app_model->appdt_status == 14) {
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '15';
            } 
            // else if($app_model->appdt_status == 15) {
            //     $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '16';
            // }
            else if($app_model->appdt_status == 15) {
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '17';
            } else if($app_model->appdt_status == 17) {
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '18' : '17';
            } else if($app_model->appdt_status == 18) {
            $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '18' : '17';
            }
            }
            if($projectpk == 4){

                if($app_model->appdt_status == 10) {
                    //QA Approval
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '11';
                } 
                else if($app_model->appdt_status == 11) {
                    if($app_model->appdt_apptype == 3){
                        $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '17';
                    }else{
                        $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '12';
                    }
                   
                } else if($app_model->appdt_status == 12) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '17';
                } else if($app_model->appdt_status == 13) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '14';
                } else if($app_model->appdt_status == 14) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '11';
                } 
                 else if($app_model->appdt_status == 15) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '16';
                } else if($app_model->appdt_status == 16) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '13' : '17';
                } else if($app_model->appdt_status == 17) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '18' : '17';
                } else if($app_model->appdt_status == 18) {
                    $app_model->appdt_status = $request_data['appapprovalstatus'] == '4' ? '18' : '17';
                }

            }
            if($app_model->save()) {
               
                if($request_data['appapprovalstatus'] == '4') {
                    $appapproval = self::saveAppApprovalHDR($app_id,$request_data['hrd_fk'],$request_data['dtls_fk'],$request_data['userdtls_fk'],$request_data['comments'],$formstatus,2,true);
                }
                if($request_data['appapprovalstatus'] == '3') {
                    $appapproval = self::saveAppApprovalHDR($app_id,$request_data['hrd_fk'],$request_data['dtls_fk'],$request_data['userdtls_fk'],$request_data['comments'],$formstatus,$appsts,true);
                }
             
                if(($app_model->appdt_status ==  11 || $app_model->appdt_status == 12 || $app_model->appdt_status == 14 || $app_model->appdt_status ==  15 || $app_model->appdt_status == 16) && $app_model->appdt_projectmst_fk != 4) {
                    // self::updateAppApprovalHDR($app_id,3,$request_data['comments'],1,true);
                    \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $app_id)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 2)
                    ->execute();
                }
                // When Certification Form is declined by Reviewer
                if(($app_model->appdt_status == 13 || $app_model->appdt_status == 18) && $app_model->appdt_projectmst_fk != 4) {
                    // self::updateAppApprovalHDR($app_id,3,$request_data['comments'],2,true);
                    \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $app_id)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 2)
                    ->execute();
                       
                }
                //project pk 2 and 3
                if($app_model->appdt_status == 17 && $request_data['comments'] != '4' && $app_model->appdt_projectmst_fk != 4) {
                    // $appapproval = self::updateAppApprovalHDR($app_id,3,$request_data['comments'],1,true);
                    self::iscadstschaned($app_id);
                    self::getfinalcerificategeneration($app_id);
                    \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $app_id)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 2)
                    ->execute();
                    // if($appapproval) {
                        self::appstaffinfomain($app_id , $projectpk);
                    // }
                }
               
                if($app_model->appdt_status == 17 && $request_data['comments'] != '4' && $app_model->appdt_projectmst_fk == 4) {
                    self::iscadstschaned($app_id);
                    self::getfinalcerificat($app_id);
                    self::appstaffuserupdate($app_id , $projectpk);
    
                }
                 //ras project pk 4
                 if($app_model->appdt_projectmst_fk == 4){
                    \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $app_id)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 4)
                    ->execute();
                    self::appstaffinfomain($app_id , $projectpk);
                    $generate = SiteAudit::generatesiteauditreportras($app_id);
                    if($app_model->appdt_status == 17){
                        $del = self::deleteaudit($app_id);
                        }

                }
                $status = "Success";
            }
        }
        return $status;
    }
    public  function deleteaudit($app_pk) {
        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $model =  \app\models\AppauditreportlogTbl::deleteAll('aarl_applicationdtlstmp_fk = '.$app_pk);
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
    }
    public   function iscadstschaned($app_id){
     
        $appsta = AppstaffinfotmpTbl::find()
        ->where(['appsit_applicationdtlstmp_fk' => $app_id])
        ->asArray()->all();
        if(!empty($appsta)){
        foreach($appsta as $app){
            $appstaf = AppstaffinfotmpTbl::find()
            ->where(['appostaffinfotmp_pk' => $app['appostaffinfotmp_pk']])
            ->one();
            $appstaf->appsit_iscarddetails = 2;
            $appstaf->save();

        }
    }

    }

    function generateRandomString($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function getfinalcerificategeneration($apppk){
        $applicatonpk = $apppk;
 
        $ckeckfinalauthorityapproval = appapprovalhdrtbl::find()->where('aah_status =1 and aah_applicationdtlstmp_fk = '.$applicatonpk)
        ->orderBy(['appapprovalhdr_pk' => SORT_DESC])->asArray()->one();

        $finalauthoriy = ProjapprovalworkflowdtlsTbl::find()->where('projapprovalworkflowdtls_pk = '.$ckeckfinalauthorityapproval['aah_projapprovalworkflowdtls_fk'])
         ->orderBy(['projapprovalworkflowdtls_pk' => SORT_DESC])->asArray()->one(); 
       
        // if($finalauthoriy['pawfh_Isfinalauthority'] == '1'){

            $applictioninfo = ApplicationdtlstmpTbl::find()
            ->select(['applicationdtlstmp_tbl.*','appcoursedtlstmp_tbl.*','reqfor.rm_name_en','appiim_officetype'])
            ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
            ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
            ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();

            $year  = OpalInvoiceTbl::find()
                ->select(['feesubscriptionmst_tbl.*'])
                ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
                ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
                ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
                if($applictioninfo['appiim_officetype'] == 1){
                    $companyinfo = OpalmemberregmstTbl::find()
                    ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                    ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
                    ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
                    ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                        ->asArray()->one();
                       }else{
                           $companyinfo = ApplicationdtlstmpTbl::find()
                           ->select(['applicationdtlstmp_tbl.*','opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                           ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
                           ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
                           ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
                           ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiim_statemst_fk')
                           ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiim_citymst_fk')
                           ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
                       }
                    
           

            if(empty($applictioninfo['appdt_verificationno'])){
                $varificationcode = 'TPC'.self::generateRandomString();
            }else{
                $varificationcode = $applictioninfo['appdt_verificationno'];
            }
          
            if(empty($applictioninfo['appdt_certificateexpiry'])){
               
                $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
                $end = date('Y-m-d', strtotime($increasedate));
                // $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end)); 

            }else{
               
                $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
                $end = date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry'].$increasedate));
                // $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end)); 
                
            }

            $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];  
           // $applictioninfo['appdt_projectmst_fk']  = 2;    
            if($applictioninfo['appdt_projectmst_fk'] == 2){
                $cousre_list = StandardcoursemstTbl::find()->where('standardcoursemst_pk = '. $applictioninfo['appcdt_standardcoursemst_fk'])->asArray()->one();
                $text = $cousre_list['scm_coursecertcontent']; 
            }else{
                $cousre_list = AppoffercoursemainTbl::find()->where('appoffercoursemain_pk = '. $applictioninfo['appcdt_appoffercoursemain_fk'])->asArray()->one();
                $text = 'is an approved OPAL STAR Provider <br> to deliver and assess for the '.$cousre_list['appocm_coursename_en'].' as per the provisions of OPAL Customized Course '.$cousre_list['appocm_coursename_en'] .'    '.     $applictioninfo['rm_name_en']. ' Standard.';
            }
 
            $path = "../api/web/certificate/$regPk/";
            $path1 = "/web/certificate/$regPk/";

            if(!is_dir($path)){
                mkdir($path, 0777, true);
            }  
            $baseUrl = \Yii::$app->params['baseUrl'];
            $mPDF1 = new \Mpdf\Mpdf([
                'mode' => '',
                'format' => 'A4-L',
                'margin_left' => '15',
                'margin_right' => '15',
                'margin_top' => '35', 
                'margin_bottom' => '16',
                'margin_header' => '9',
                'margin_footer' => '9',
                'default_font_size' => '0', 
                'orientation' => 'L',
                'default_font' => 'futurastdmedium']);
       
            $cerpath = dirname(__FILE__).'../../../../../certicate/cert.pdf';
        
            $pagecount = $mPDF1->SetSourceFile($cerpath);
            $tplId = $mPDF1->ImportPage($pagecount);
            $mPDF1->UseTemplate($tplId);
            $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_tpname_en']  . ' </div>', 50, 88, 450, 20);
            
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 16pt;text-align: center;color:#1C1C1B ">' . $text . ' </div>', 50, 103, 200, 20);

            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">CR No.: ' . $companyinfo['omrm_crnumber'] . ' </div>', 25, 135, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">OPAL Membership No.: ' . $companyinfo['omrm_opalmembershipregnumber'] . ' </div>', 25, 142, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Verification Code: ' . $varificationcode . ' </div>', 205, 135, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Expiry Date: ' . $end_format . ' </div>', 205, 142, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Governorate: ' . $companyinfo['osm_statename_en'] . ' </div>', 25, 149, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Wilayat: ' . $companyinfo['ocim_cityname_en'] . ' </div>', 25, 156, 200, 20);

            $mPDF1->Output($path .$applictioninfo['appdt_appreferno'].'.pdf', 'F');
            $model = ApplicationdtlstmpTbl::find() ->where('applicationdtlstmp_pk = '.$applicatonpk)->one();
            $model->appdt_verificationno =  $varificationcode;
            $model->appdt_certificategenon = date("Y-m-d H:i:s");
            $model->appdt_certificatepath = $path1 .$applictioninfo['appdt_appreferno'].'.pdf';
            $model->appdt_certificateexpiry = $end;
            if(!$model->save()){ 
            
                return $model->getErrors();  
            }else{
               
            return 'success';
            }
      
        // }else{
        //     return 'fail';
        // }
 }
 
     
     public static function getAppApprovalworkFlow($project_id=2,$formstatus=1) {
        $app_model = [];
        $project_id = $project_id;
        $formstatus = $formstatus;
        // projapprovalworkflowhrd_tbl Initial
        $projectApprData = ProjapprovalworkflowhrdTbl::find()
        ->select(['*'])
        ->where(['pawfh_projectmst_fk' => $project_id,'pawfh_status'=>1])
        ->andWhere(['pawfh_formstatus' => $formstatus])
        ->asArray()
        ->one();
      
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $model = ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['projapprovalworkflowuserdtls_pk','pawfud_opalusermst_fk','pawfud_projapprovalworkflowdtls_fk','pawfud_projapprovalworkflowhrd_fk','pawfd_rolemst_fk'])
            ->leftJoin('projapprovalworkflowdtls_tbl', 'projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')
            ->where("pawfud_opalusermst_fk = $userPk")
            ->andWhere("pawfh_status = 1")
            ->asArray()
            ->all();

            $accessproject = OpalusermstTbl::find()
            ->select(['opalusermst_pk' , 'oum_standcoursemst_fk' , 'oum_allocatedproject'])
            ->where("opalusermst_pk = '$userPk'")
            ->andWhere("FIND_IN_SET('2', oum_allocatedproject) OR FIND_IN_SET('3', oum_allocatedproject)")
            ->andWhere("oum_status = 'A'")
            ->asArray()
            ->one();
            $pro_arary =  explode(",", $accessproject['oum_allocatedproject']);
    
            if(in_array('2',$pro_arary)  && $accessproject['oum_standcoursemst_fk'] == ''){
      
                 $accessproject  = '';
            }
           
          
            $accessdesktop = false;
            $accesspayement = false;
            $accessauditor = false;
            $accessqualitymanager = false;
            $accessAuthority =false;
            $accessceo = false;
            $hrd_fk = '';
            $workflowuserdtls_fk='';
            $workflowdtls_fk='';

            $desktop =  \Yii::$app->params['project']['course']['desktop_id'];
            $payment =  \Yii::$app->params['project']['course']['payment_id'];
            $auditor =   \Yii::$app->params['project']['course']['auditor_id'];
            $qualitymanager =  \Yii::$app->params['project']['course']['qualitymanager_id'];
            $authority =   \Yii::$app->params['project']['course']['authority_id'];
            $ceo =   \Yii::$app->params['project']['course']['ceo_id'];
            $accesssuperadmin = OpalusermstTbl::find()
            ->select(['opalusermst_pk'])
            ->where("opalusermst_pk = '$userPk'")
            ->andWhere("oum_isfocalpoint = '1'")
            ->andWhere("oum_opalmemberregmst_fk = '1'")
            ->andWhere("oum_status = 'A'")
            ->asArray()
            ->one();
            foreach($model as $role){
            if($role['pawfud_projapprovalworkflowhrd_fk'] == $projectApprData['projapprovalworkflowhrd_pk']) {
                if($role['pawfd_rolemst_fk'] ==  $desktop ){
                    $accessdesktop = true;
                }
                if($role['pawfd_rolemst_fk'] == $payment){
                    $accesspayement = true;
                }  
                if($role['pawfd_rolemst_fk'] == $auditor){
                    $accessauditor = true;
                } 
                if($role['pawfd_rolemst_fk'] == $qualitymanager){
                    $accessqualitymanager = true;
                } 
                if($role['pawfd_rolemst_fk'] == $authority){
                    $accessAuthority = true;
                }
                if($role['pawfd_rolemst_fk'] == $ceo){
                    $accessceo = true;
                }  
                $hrd_fk = $role['pawfud_projapprovalworkflowhrd_fk'];
                $workflowuserdtls_fk=$role['projapprovalworkflowuserdtls_pk'];
                $workflowdtls_fk=$role['pawfud_projapprovalworkflowdtls_fk'];
            }
            

        }
        $app_model['hrd_fk'] = $hrd_fk;
        $app_model['workflowuserdtls_fk'] = $workflowuserdtls_fk;
        $app_model['workflowdtls_fk'] = $workflowdtls_fk;
        $app_model['projectApprData'] = $projectApprData;
        // $app_model['model'] = $model;
        $app_model['accessdesktop'] = $accessdesktop;
        $app_model['accessauditor'] = $accessauditor;
        $app_model['accesspayement'] = $accesspayement;
        $app_model['accessqualitymanager'] = $accessqualitymanager;
        $app_model['accessAuthority'] = $accessAuthority;
        $app_model['accessproject'] =  ($accessproject)?true:false;
        if($accesssuperadmin){
            $app_model['accessproject'] = true;
        }else{
            $app_model['accessproject'] = ($accessproject)?true:false;
        }
        $app_model['accessceo'] = $accessceo;
        return $app_model;
     } 
    public static function getAppApprovalHrd($app_id,$app_status) {
        $app_model = '';
        if(!empty($app_id) && !empty($app_status)) {

            $app_model = ApplicationdtlstmpTbl::find()
                            ->select(['appapprovalhdr_tbl.*','appdt_projectmst_fk'])
                            ->leftJoin('appapprovalhdr_tbl','applicationdtlstmp_pk=aah_applicationdtlstmp_fk')
                            ->where(['applicationdtlstmp_pk' => $app_id])
                            ->orderBy(['appapprovalhdr_pk' => SORT_DESC])
                            ->asArray()->one();
            
            $opal_user =  \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $app_model['aah_appdecby']])->one();
            $app_model['appdec_by'] = $opal_user['oum_firstname'];
            if(!empty($app_model['appdt_projectmst_fk'])) {
                $app_model['appworkflow'] = self::getAppApprovalworkFlow($app_model['appdt_projectmst_fk'],1);
            }
            // $data = AppstaffinfotmpTbl::find()->where(['appsit_applicationdtlstmp_fk'=>$app_id])->asArray()->one();
        }

        return $app_model;
    }
    public function getApprovalHdrInfo($projPk,$formStatus,$rolePk){
        $model = ProjapprovalworkflowhrdTbl::find()
            ->select(['projapprovalworkflowhrd_pk','projapprovalworkflowdtls_pk','projapprovalworkflowuserdtls_pk'])
            ->leftJoin('projapprovalworkflowdtls_tbl','pawfd_projapprovalworkflowhrd_fk  = projapprovalworkflowhrd_pk')
            ->leftJoin('projapprovalworkflowuserdtls_tbl','pawfud_projapprovalworkflowdtls_fk = projapprovalworkflowdtls_pk')
            ->leftJoin('rolemst_tbl','rolemst_pk = pawfd_rolemst_fk')
            ->where(['pawfh_projectmst_fk' => $projPk])
            ->andWhere(['pawfh_formstatus' => $formStatus])
            ->andWhere(['rolemst_pk' => $rolePk])
            ->asArray()
            ->one();
        return $model;
    }



    //compantacy card


    
    public static function getModuleSubModule() {
        $llist= OpalmodulemstTbl::find()->where(['omm_opalstkholdertypmst_fk' => 1])->asArray()->all();
        foreach ($llist as $lkey => $value) {
            $llist[$lkey]['submodules'] = self::getSubModule($value['opalmodulemst_pk']);
            $llist[$lkey]['rolelist'] = explode(",",$value['omm_crudaccess']);
        }
        return $llist;
    }
    public static function getSubModule($pk) {
        $lslist= OpalsubmodulemstTbl::find()->where(['osmm_opalstkholdertypmst_fk' => 1,'osmm_opalmodulemst_fk'=>$pk,'osmm_status'=>1])->asArray()->all();
        foreach ($lslist as $lskey => $value) {
            $lslist[$lskey]['rolelist'] = explode(",",$value['osmm_crudaccess']);
            $lslist[$lskey]['createaccess'] = (bool)in_array('1',$lslist[$lskey]['rolelist']);
            $lslist[$lskey]['viewaccess']= (bool)in_array('2',$lslist[$lskey]['rolelist']);
            $lslist[$lskey]['updateaccess']=(bool)in_array('3',$lslist[$lskey]['rolelist']);
            $lslist[$lskey]['deleteaccess']= (bool)in_array('4',$lslist[$lskey]['rolelist']);
            $lslist[$lskey]['approvalaccess']= (bool)in_array('5',$lslist[$lskey]['rolelist']);
            $lslist[$lskey]['downloadaccess']= (bool)in_array('6',$lslist[$lskey]['rolelist']);
        }
        return $lslist;
    }
    public static function getRoleAllocationDtls() {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $rolemst_fk =  \yii\db\ActiveRecord::getTokenData('oum_rolemst_fk', true);
        $rolelist = [];
        $rolelist['rolemst_fk']= $rolemst_fk;
        // $rolemst_fk = OpalusermstTbl::findOne($userPk);
        // $rolelist = '';
        // $rolelist['rolemst_fk']= $rolemst_fk;
        if(!empty($rolemst_fk)) {
            $rolelistv = explode(",",$rolemst_fk);
            // foreach ($rolelistv as $rlkey => $rlvalue) {
            //     $rolelist[$rlkey]['rolevalue'] = $rlvalue;
               
            // }
        }
        $rolelist['rolelistv'] = $rolelistv;
        return $rolelist;
    }
   
    public static function appstaffinfomain($id = '' ,$projectpk) {
      $staffinfomaindata = '';
        if(!empty($id)) {
         $application =  ApplicationdtlstmpTbl::find()->where("appdt_appreferno = '$id'")->one();  
            if($projectpk == '2' || $projectpk == '3'){      
            if($application->appdt_status == 3){
            $staffinfomaindata = AppstaffinfomainTbl::find()
            ->select(['appostaffinfotmp_pk','appsim_StaffInfoRepo_FK as staffinforepo_pk','appcdt_appoffercoursemain_fk as appoffercoursemain_fk','appcdt_standardcoursemst_fk as standardcoursemst_fk','appdm_projectmst_fk as projectmst_fk','appsim_roleforcourse as roleforcourse','appsim_language as language','appsim_appcoursetrnsmain_fk as appcoursetrnsmain_fk','appsim_ApplicationDtlsMain_FK as ApplicationDtlsMain_FK','appdm_opalmemberregmst_fk as opalmemberregmst_fk','appdm_apptype as apptype','GROUP_CONCAT(DISTINCT appctm_coursecategorymst_fk) as coursecategorymst_fk','appsit_appcoursetrnstmp_fk as appcoursetrnstmp_fk','GROUP_CONCAT(DISTINCT standardcoursedtls_pk) as standardcoursedtls'])
            ->leftJoin('applicationdtlsmain_tbl','appsim_ApplicationDtlsMain_FK=applicationdtlsmain_pk')
            ->leftJoin('appcoursedtlstmp_tbl','appdm_applicationdtlstmp_fk=appcdt_applicationdtlstmp_fk')
            ->leftJoin('appstaffinfotmp_tbl','appostaffinfotmp_pk=appsim_AppStaffInfotmp_FK')
            ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk=appostaffinfotmp_pk')
            ->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)')
            ->leftJoin('standardcoursedtls_tbl','scd_subcoursecategorymst_fk=appctt_coursecategorymst_fk')
            ->leftJoin('appcoursetrnsmain_tbl','find_in_set(AppCourseTrnsMain_pk,appsim_appcoursetrnsmain_fk)')
            ->where(['appdm_applicationdtlstmp_fk' => $id])
            ->groupBy('AppStaffInfoMain_PK,scd_standardcoursemst_fk')
            ->orderBy(['AppStaffInfoMain_PK' => SORT_DESC, 'applicationdtlsmain_pk' => SORT_DESC])
            ->asArray()->all();
            }else{
            $staffinfomaindata = AppstaffinfomainTbl::find()
            ->select(['appostaffinfotmp_pk','appsim_StaffInfoRepo_FK as staffinforepo_pk','appcdt_appoffercoursemain_fk as appoffercoursemain_fk','appcdt_standardcoursemst_fk as standardcoursemst_fk','appdm_projectmst_fk as projectmst_fk','appsim_roleforcourse as roleforcourse','appsim_language as language','appsim_appcoursetrnsmain_fk as appcoursetrnsmain_fk','appsim_ApplicationDtlsMain_FK as ApplicationDtlsMain_FK','appdm_opalmemberregmst_fk as opalmemberregmst_fk','appdm_apptype as apptype','GROUP_CONCAT(DISTINCT appctm_coursecategorymst_fk) as coursecategorymst_fk','appsit_appcoursetrnstmp_fk as appcoursetrnstmp_fk','GROUP_CONCAT(DISTINCT standardcoursedtls_pk) as standardcoursedtls'])
            ->leftJoin('applicationdtlsmain_tbl','appsim_ApplicationDtlsMain_FK=applicationdtlsmain_pk')
            ->leftJoin('appcoursedtlstmp_tbl','appdm_applicationdtlstmp_fk=appcdt_applicationdtlstmp_fk')
            ->leftJoin('appstaffinfotmp_tbl','appostaffinfotmp_pk=appsim_AppStaffInfotmp_FK')
            ->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)')
            ->leftJoin('standardcoursedtls_tbl','scd_subcoursecategorymst_fk=appctt_coursecategorymst_fk')
            ->leftJoin('appcoursetrnsmain_tbl','find_in_set(AppCourseTrnsMain_pk,appsim_appcoursetrnsmain_fk)')
            ->where(['appdm_applicationdtlstmp_fk' => $id])
            ->groupBy('AppStaffInfoMain_PK,scd_standardcoursemst_fk')
            ->orderBy(['AppStaffInfoMain_PK' => SORT_DESC, 'applicationdtlsmain_pk' => SORT_DESC])
            ->asArray()->all();
            }
            if(!empty($staffinfomaindata)) {
                self::staffcompetencycardhdr($staffinfomaindata);
            }
            }
            if($projectpk == '4'){
                    $staffinfomaindata = AppstaffinfomainTbl::find()
                    ->select(['appsim_StaffInfoRepo_FK as staffinforepo_pk','appdm_projectmst_fk as projectmst_fk','appsim_roleforcourse as roleforcourse','appsim_language as language','appsit_apprasvehinspcattmp_fk'])
                    ->leftJoin('applicationdtlsmain_tbl','appsim_ApplicationDtlsMain_FK=applicationdtlsmain_pk')
                    ->leftJoin('appstaffinfotmp_tbl','appostaffinfotmp_pk=appsim_AppStaffInfotmp_FK')
                    ->where(['appsit_applicationdtlstmp_fk' => $id])
                    ->groupBy('AppStaffInfoMain_PK')
                    ->orderBy(['AppStaffInfoMain_PK' => SORT_DESC, 'applicationdtlsmain_pk' => SORT_DESC])
                    ->asArray()->all();
                    if(!empty($staffinfomaindata)) {
                        self::staffcompetencycardhdrras($staffinfomaindata);
        
                }
            }
           
        }

        return $staffinfomaindata;
    }
   
    public static function staffcompetencycardhdr($data) {
       foreach($data as $data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $new_staff_comp_card =  StaffcompetencycardhdrTbl::find()->where(['scch_staffinforepo_fk'=>$data['staffinforepo_pk'],'scch_standardcoursemst_fk'=>$data['standardcoursemst_fk']])->one(); 
        if(empty($new_staff_comp_card)){
            $new_staff_comp_card = new StaffcompetencycardhdrTbl(); 
            $new_staff_comp_card->scch_staffinforepo_fk = $data['staffinforepo_pk'];
            $new_staff_comp_card->scch_projectmst_fk  = $data['projectmst_fk'];
            $new_staff_comp_card->scch_standardcoursemst_fk  = $data['standardcoursemst_fk'];
            $new_staff_comp_card->scch_appoffercoursemain_fk  = $data['appoffercoursemain_fk'];
            $new_staff_comp_card->scch_rolemst_fk  = $data['roleforcourse'];
            $new_staff_comp_card->scch_language  = $data['language'];
            $new_staff_comp_card->scch_cardissuedate = date('Y-m-d H:i:s');
            $new_staff_comp_card->scch_status  = '1';
            // $new_staff_comp_card->scch_printedon  = '';
            // $new_staff_comp_card->scch_printedby  = '';
            $new_staff_comp_card->scch_createdon  = date('Y-m-d H:i:s');
            $new_staff_comp_card->scch_createdby  = $userPk;
        }else{
            $new_staff_comp_card->scch_staffinforepo_fk = $data['staffinforepo_pk'];
            $new_staff_comp_card->scch_projectmst_fk  = $data['projectmst_fk'];
            $new_staff_comp_card->scch_standardcoursemst_fk  = $data['standardcoursemst_fk'];
            $new_staff_comp_card->scch_appoffercoursemain_fk  = $data['appoffercoursemain_fk'];
            $new_staff_comp_card->scch_rolemst_fk  = $data['roleforcourse'];
            $new_staff_comp_card->scch_language  = $data['language'];
            $new_staff_comp_card->scch_cardissuedate = date('Y-m-d H:i:s');
            $new_staff_comp_card->scch_status  = '1';
            $new_staff_comp_card->scch_createdon  = date('Y-m-d H:i:s');
            $new_staff_comp_card->scch_createdby  = $userPk;

        }
 
        if($new_staff_comp_card->save()) {
        //    print_r($new_staff_comp_card->getErrors()); exit;
             $LastInsertedId = $new_staff_comp_card->staffcompetencycardhdr_pk;
             if(!empty($LastInsertedId)) {
                 self::staffcompetencycarddtls($data,$LastInsertedId);
             }
        }
    }
        return 'Success';

    }

    public static function staffcompetencycardhdrras($data) {
        foreach($data as $data){
         $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
         $new_staff_comp_card =  StaffcompetencycardhdrTbl::find()->where(['scch_staffinforepo_fk'=>$data['staffinforepo_pk']])->one(); 
         if(empty($new_staff_comp_card)){
             $new_staff_comp_card = new StaffcompetencycardhdrTbl(); 
             $new_staff_comp_card->scch_staffinforepo_fk = $data['staffinforepo_pk'];
             $new_staff_comp_card->scch_projectmst_fk  = $data['projectmst_fk'];
             $new_staff_comp_card->scch_rolemst_fk  = $data['roleforcourse'];
             $new_staff_comp_card->scch_language  = $data['language'];
             $new_staff_comp_card->scch_cardissuedate = date('Y-m-d H:i:s');
             $new_staff_comp_card->scch_status  = '1';
             $new_staff_comp_card->scch_createdon  = date('Y-m-d H:i:s');
             $new_staff_comp_card->scch_createdby  = $userPk;
         }else{
             $new_staff_comp_card->scch_staffinforepo_fk = $data['staffinforepo_pk'];
             $new_staff_comp_card->scch_projectmst_fk  = $data['projectmst_fk'];
             $new_staff_comp_card->scch_rolemst_fk  = $data['roleforcourse'];
             $new_staff_comp_card->scch_language  = $data['language'];
             $new_staff_comp_card->scch_cardissuedate = date('Y-m-d H:i:s');
             $new_staff_comp_card->scch_status  = '1';
             $new_staff_comp_card->scch_createdon  = date('Y-m-d H:i:s');
             $new_staff_comp_card->scch_createdby  = $userPk;
         }
         if($new_staff_comp_card->save()) {
              $LastInsertedId = $new_staff_comp_card->staffcompetencycardhdr_pk;
              if(!empty($LastInsertedId)) {
                  self::staffcompetencycarddtls($data,$LastInsertedId);
              }
         }
     }
         return 'Success';
 
     }
    public static function staffcompetencycarddtls($data,$LastInsertedId) {
        // staffcompetencycarddtls_tbl
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $data['standardcoursedtls_id'] = explode(',' ,$data['standardcoursedtls']);
        if(!empty($data['appcoursetrnstmp_fk'])) {
            $data['appcoursetrnstmp_id'] = explode(',' ,$data['appcoursetrnstmp_fk']);
        }
        if(!empty($data['appsit_apprasvehinspcattmp_fk'])) {
            $data['appsit_apprasvehinspcattmp_fk'] = explode(',' ,$data['appsit_apprasvehinspcattmp_fk']);
        }

        if(!empty($data['standardcoursedtls_id']) && ($data['projectmst_fk'] == 2)) {
            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = 2 and fsm_applicationtype =1  and fsm_status =1  and fsm_feestype =2")
            ->andWhere("fsm_standardcoursemst_fk = ".$data['standardcoursemst_fk']) 
            ->asArray()->one();  
            $expyear =  empty($feerec['fsm_validityinyrs'])?1:$feerec['fsm_validityinyrs'];
            $expdate = date('Y-m-d H:i:s', strtotime('+'.$expyear.' year'));
            // print_r($expdate);exit;
        foreach ($data['standardcoursedtls_id'] as $key => $value) {
            $new_staff_comp_card_dtls =  StaffcompetencycarddtlsTbl::find()->where(['sccd_staffcompetencycardhdr_fk'=> $LastInsertedId,'sccd_standardcoursedtls_fk'=>$value])->one();           
            if(empty($new_staff_comp_card_dtls)){
            $new_staff_comp_card_dtls = new StaffcompetencycarddtlsTbl();
            $new_staff_comp_card_dtls->sccd_staffcompetencycardhdr_fk = $LastInsertedId;
            $new_staff_comp_card_dtls->sccd_standardcoursedtls_fk = $value;
            // $new_staff_comp_card_dtls->sccd_appcoursetrnstmp_fk  = $data['appcoursetrnstmp_fk'];
            // $new_staff_comp_card_dtls->sccd_rascategorymst_fk  = '';
            $new_staff_comp_card_dtls->sccd_cardexpiry  = $expdate;
            $new_staff_comp_card_dtls->sccd_status   = '1';
            $new_staff_comp_card_dtls->sccd_createdon  = date('Y-m-d H:i:s');
            $new_staff_comp_card_dtls->sccd_createdby  =  $userPk;
    
            $new_staff_comp_card_dtls->save();
           
            }else{
                $new_staff_comp_card_dtls->sccd_staffcompetencycardhdr_fk = $LastInsertedId;
                $new_staff_comp_card_dtls->sccd_standardcoursedtls_fk = $value;
                // $new_staff_comp_card_dtls->sccd_appcoursetrnstmp_fk  = $data['appcoursetrnstmp_fk'];
                // $new_staff_comp_card_dtls->sccd_rascategorymst_fk  = '';
                $new_staff_comp_card_dtls->sccd_cardexpiry  = $expdate;
                $new_staff_comp_card_dtls->sccd_status   = '1';
                $new_staff_comp_card_dtls->sccd_createdon  = date('Y-m-d H:i:s');
                $new_staff_comp_card_dtls->sccd_createdby  =  $userPk;
    
                $new_staff_comp_card_dtls->save();
              

            }
        }
       }
       if(!empty($data['appcoursetrnstmp_id']) && ($data['projectmst_fk']==3)) {
        $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = 3 and fsm_applicationtype =1 and fsm_status =1 and fsm_feestype =2")
        ->asArray()->one();  
        $expyear =  empty($feerec['fsm_validityinyrs'])?1:$feerec['fsm_validityinyrs'];
        foreach ($data['appcoursetrnstmp_id'] as $key => $value) {
            $new_staff_comp_card_dtls =  StaffcompetencycarddtlsTbl::find()->where(['sccd_staffcompetencycardhdr_fk'=> $LastInsertedId,'sccd_appcoursetrnstmp_fk'=>$value])->one();
            if(empty($new_staff_comp_card_dtls)){
            $new_staff_comp_card_dtls = new StaffcompetencycarddtlsTbl();
            $new_staff_comp_card_dtls->sccd_staffcompetencycardhdr_fk = $LastInsertedId;
            // $new_staff_comp_card_dtls->sccd_standardcoursedtls_fk = $value;
            $new_staff_comp_card_dtls->sccd_appcoursetrnstmp_fk  = $value;
            // $new_staff_comp_card_dtls->sccd_rascategorymst_fk  = '';
            $new_staff_comp_card_dtls->sccd_cardexpiry  = date('Y-m-d H:i:s', strtotime(' +  '.$expyear.' year'));
            $new_staff_comp_card_dtls->sccd_status   = '1';
            $new_staff_comp_card_dtls->sccd_createdon  = date('Y-m-d H:i:s');
            $new_staff_comp_card_dtls->sccd_createdby  =  $userPk;

            $new_staff_comp_card_dtls->save();
            }else{
                $new_staff_comp_card_dtls->sccd_staffcompetencycardhdr_fk = $LastInsertedId;
                // $new_staff_comp_card_dtls->sccd_standardcoursedtls_fk = $value;
                $new_staff_comp_card_dtls->sccd_appcoursetrnstmp_fk  = $value;
                // $new_staff_comp_card_dtls->sccd_rascategorymst_fk  = '';
                $new_staff_comp_card_dtls->sccd_cardexpiry  = date('Y-m-d H:i:s', strtotime(' +  '.$expyear.' year'));
                $new_staff_comp_card_dtls->sccd_status   = '1';
                $new_staff_comp_card_dtls->sccd_createdon  = date('Y-m-d H:i:s');
                $new_staff_comp_card_dtls->sccd_createdby  =  $userPk;
    
                $new_staff_comp_card_dtls->save();
            }

        }
       }
       if(!empty($data['appsit_apprasvehinspcattmp_fk']) && ($data['projectmst_fk']==4)) {
        $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = 4 and fsm_applicationtype =1 and fsm_status =1 and fsm_feestype =2")
        ->asArray()->one();  
        $expyear =  empty($feerec['fsm_validityinyrs'])?1:$feerec['fsm_validityinyrs'];
        foreach ($data['appsit_apprasvehinspcattmp_fk'] as $key => $value) {
            $rascategory = ApprasvehinspcattmpTbl::find()->where(['apprasvehinspcattmp_pk' => $value])->asArray()->one();
            $new_staff_comp_card_dtls =  StaffcompetencycarddtlsTbl::find()->where(['sccd_staffcompetencycardhdr_fk'=> $LastInsertedId,'sccd_rascategorymst_fk'=>$rascategory['arvict_rascategorymst_fk']])->one();
            if(empty($new_staff_comp_card_dtls)){
            $new_staff_comp_card_dtls = new StaffcompetencycarddtlsTbl();
            $new_staff_comp_card_dtls->sccd_staffcompetencycardhdr_fk = $LastInsertedId;
            $new_staff_comp_card_dtls->sccd_rascategorymst_fk  = $rascategory['arvict_rascategorymst_fk'];
            $new_staff_comp_card_dtls->sccd_cardexpiry  =  date('Y-m-d H:i:s', strtotime(' +  '.$expyear.' year'));
            $new_staff_comp_card_dtls->sccd_status   = '1';
            $new_staff_comp_card_dtls->sccd_createdon  = date('Y-m-d H:i:s');
            $new_staff_comp_card_dtls->sccd_createdby  =  $userPk;
            $new_staff_comp_card_dtls->save();
            }else{
                $new_staff_comp_card_dtls->sccd_staffcompetencycardhdr_fk = $LastInsertedId;
                $new_staff_comp_card_dtls->sccd_rascategorymst_fk  = $rascategory['arvict_rascategorymst_fk'];
                $new_staff_comp_card_dtls->sccd_cardexpiry  = date('Y-m-d H:i:s', strtotime(' +  '.$expyear.' year'));
                $new_staff_comp_card_dtls->sccd_status   = '1';
                $new_staff_comp_card_dtls->sccd_createdon  = date('Y-m-d H:i:s');
                $new_staff_comp_card_dtls->sccd_createdby  =  $userPk;
                $new_staff_comp_card_dtls->save();
            }

        }
       }
       return 'success';
        
    }

    public static function getstaffcompetencycardhdr($id) {
        $resdata = StaffcompetencycardhdrTbl::find()->where(['scch_staffinforepo_fk'=>$id])->asArray()->all();
        foreach ($resdata as $key => $value) {
            self::updateStaffComptencyCardhdr($value['staffcompetencycardhdr_pk']);
        }
        return $resdata;
    }
    public static function updateStaffComptencyCardhdr($id) {

        $staffcompcard = StaffcompetencycardhdrTbl::findOne($id);
        $staffcompcard->scch_status = 1;
        if(!$staffcompcard->save()) {
            print_r($staffcompcard->getErrors()); exit;
        }
        return 'success';
    }
   
    public static function getUpdateStaffCompCardDtls($scc_id) {
        $resultData = StaffcompetencycarddtlsTbl::find()->where(['sccd_staffcompetencycardhdr_fk' => $scc_id])->asArray()->all();
        foreach ($resultData as $sccdkey => $sccdvalue) {
            self::updateStaffCompCardDtls($sccdvalue['staffcompetencycarddtls_pk']);
        }
        return 'success';
    }
    public static function updateStaffCompCardDtls($id) {
        $resultData = StaffcompetencycarddtlsTbl::findOne($id);
        $resultData->sccd_cardexpiry =  date('Y-m-d H:i:s', strtotime(' + 1 year'));
        $resultData->sccd_status = 1;
        $resultData->save();
        return 'success';
    }
    public static function deletestaffcards($staff_id) {
       $resData = StaffcompetencycardhdrTbl::find()->where(['scch_staffinforepo_fk' => $staff_id])->asArray()->all();
       foreach ($resData as $skey => $svalue) {
           self::deleteStaffComptencyCardhdr($svalue['staffcompetencycardhdr_pk']);
       }
    }
    public static function deleteStaffComptencyCardhdr($id) {
        $staffcompcard = StaffcompetencycardhdrTbl::findOne($id);
        if(!empty($staffcompcard)) {
            self::deleteStaffCompCardDtls($id);

            $staffcompcard->delete();
        }
        return 'success';

    }
    public static function deleteStaffCompCardDtls($scc_id) {
        $resultData = StaffcompetencycarddtlsTbl::deleteAll(['sccd_staffcompetencycardhdr_fk' => $scc_id]);
        return 'success';
    }
    public static function checkstaffupdate($id) {
        $resdata = StaffcompetencycardhdrTbl::find()->where(['scch_staffinforepo_fk'=>$id])->asArray()->all();
        foreach ($resdata as $skey => $svalue) {
          $resdata[$skey]['compcarddtls'] = StaffcompetencycarddtlsTbl::find()
          ->select(['GROUP_CONCAT(DISTINCT sccd_appcoursetrnstmp_fk) as appcoursetrnstmp_fk'])
          ->where(['sccd_staffcompetencycardhdr_fk' => $svalue['staffcompetencycardhdr_pk']])
          ->groupBy('sccd_staffcompetencycardhdr_fk')
          ->asArray()->one();

        }
        return $resdata;
    }


    public static function generatesiteauditreport($app_pk) {
        $applicationid = $app_pk;

        $Appmodel = \app\models\ApplicationdtlstmpTbl::find()
        ->select(['applicationdtlstmp_tbl.*','appiit_addrline1','appiit_addrline2','appiit_officetype','osm_statename_en','ocim_cityname_en','DATE_FORMAT(appdt_appdecon,"%d-%m-%Y") AS appdtappdecon','oum_firstname','appiit_noofomani','appiit_noofexpat'])
        ->leftJoin('opalusermst_tbl','opalusermst_pk = appdt_appdecby')
        ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk')
        ->where("applicationdtlstmp_pk =:pk", [':pk' => $applicationid])->asArray()->one();
        
        $total = $Appmodel['appiit_noofomani'] + $Appmodel['appiit_noofexpat'];
        $omanpercentage = $Appmodel['appiit_noofomani']/$total *100;
        $Appmodel['totalemployee'] = $total;
        if($total != 0 ){
        $Appmodel['omanpercentage'] = round($omanpercentage);
        }else{
            $Appmodel['omanpercentage'] = 0;  
        }
        // echo $total;exit;
        $memberreg =  \app\models\OpalmemberregmstTbl::find()
        ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
        ->where(['opalmemberregmst_pk'=>$Appmodel['appdt_opalmemberregmst_fk']])->asArray()->one();

        $schedulemodel = \app\models\AppauditschedtmpTbl::find()->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $applicationid])->asArray()->one();  
        $data = \app\models\Appsiteauditreportcattmptbl::find()
        ->select(['appsiteauditreportcattmp_tbl.*','grademst_tbl.*'])
        ->leftJoin('grademst_tbl','grademst_pk = asarct_grademst_fk')
        ->where('asarct_appauditschedtmp_fk ='.$schedulemodel['appauditschedtmp_pk'])
        ->asArray()->all();

        $model_1 = \app\models\OpalusermstTbl::find()
        ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omgm_gradename_en','omgm_gradename_ar'])
        ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
        ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
        ->leftJoin('Opalmoherigrademst_Tbl','opalmoherigradingmst_pk=omrm_opalmoherigradingmst_pk')
        ->where('oum_opalmemberregmst_fk ='.$Appmodel['appdt_opalmemberregmst_fk'].' and oum_status = "A" and oum_isfocalpoint = 1 and oum_projectmst_fk is null' )
        ->asArray()
        ->one();

        $model_2 = \app\models\OpalusermstTbl::find()
        ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omgm_gradename_en','omgm_gradename_ar'])
        ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
        ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
        ->leftJoin('Opalmoherigrademst_Tbl','opalmoherigradingmst_pk=omrm_opalmoherigradingmst_pk')
        ->where('oum_opalmemberregmst_fk ='.$Appmodel['appdt_opalmemberregmst_fk'].' and oum_status = "A" and oum_isfocalpoint = 1 and oum_projectmst_fk = 1' )
        ->asArray()
        ->one();
        
        if(!empty($model_1)){
            $model= $model_1;
        }else{
            $model= $model_2;
        }
        
        $address =[];
        if($Appmodel['appiit_officetype'] == 1){
            $address['address1'] = $memberreg['omrm_address1'];
            $address['address2'] = $memberreg['omrm_address2'];
            $address['statename_en'] = $memberreg['osm_statename_en'];
            $address['cityname_en'] = $memberreg['ocim_cityname_en'];

        }else{
            $address['address1'] = $Appmodel['appiit_addrline1'];
            $address['address2'] = $Appmodel['appiit_addrline2'];
            $address['statename_en'] = $memberreg['osm_statename_en'];
            $address['cityname_en'] = $memberreg['ocim_cityname_en'];

        }

        $gradedata =\app\models\GrademstTbl::find()
        ->select(['*'])
        ->where('gm_status = :gm_status',[ ':gm_status' => 1])
        ->orderBy('grademst_pk asc')
        ->asArray()->all();
        $bronzepercentage = $gradedata[0]['gm_scoreinpercent'];
        $bronzescorefrom = $gradedata[0]['gm_scorefrom'];
        $bronzescoreto = $gradedata[0]['gm_scoreto'];
        $silverpercentage = $gradedata[1]['gm_scoreinpercent'];
        $silverscorefrom = $gradedata[1]['gm_scorefrom'];
        $silverscoreto = $gradedata[1]['gm_scoreto'];
        $goldpercentage = $gradedata[2]['gm_scoreinpercent'];
        $goldscorefrom = $gradedata[2]['gm_scorefrom'];
        $goldscoreto = $gradedata[2]['gm_scoreto'];

        $summarydata =[];
        $superover = 0;
         foreach($data as $category){
            $total =  $category['asarct_totalques']? $category['asarct_totalques']:0; 
            $bronze =  $category['asarct_bronze']? $category['asarct_bronze']:0; 
            $silver = $category['asarct_silver']? $category['asarct_silver']:0;
            $gold =  $category['asarct_gold']? $category['asarct_gold']:0;
            
            $bronzeper = round(($bronze / $total) * $bronzepercentage);
            $silverper = round(($silver / $total) * $silverpercentage);
            $goldper = round(($gold / $total) * $goldpercentage);

            $overall = $bronzeper + $silverper + $goldper;
            $superover = $superover + $overall ;
            array_push($summarydata,['grade'=>$category['asarct_grademst_fk'],'cat_name'=>$category['asarct_categorytitle_en'],'percenteage'=>  $overall,'gradename'=>$category['gm_gradename_en']]);

         
         }
        //  print_r( $superover /count($data));
        //  exit;
         $superover = $superover /count($data);
         $correspondingGrade = null;
        foreach ($gradedata as $grade) {
         if ($superover >= $grade["gm_scorefrom"] && $superover <= $grade["gm_scoreto"]) {
             $correspondingGrade = $grade;
            
             break;
         }
        }
        $correspondingGrade['percentage'] = round($superover);
        //  print_r($correspondingGrade);
        //  exit;
        $historydata = \app\models\AppauditreportlogTbl::find()
        ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
        ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status in(1,2)')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk ASC')->asArray()->all();

        $siteauditor = \app\models\AppauditreportlogTbl::find()
        ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
        ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 3')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

        $qualitimanager = \app\models\AppauditreportlogTbl::find()
        ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
        ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 4')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

        $authoriy  = \app\models\AppauditreportlogTbl::find()
        ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
        ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 5')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

        $ceo = \app\models\AppauditreportlogTbl::find()
        ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
        ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 6')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

        if($Appmodel['appdt_status'] == 17){
        $varificationcode = $Appmodel['appdt_verificationno'];
        $websiteurl = \Yii::$app->params['website_url'];
        $qrCode = (new QrCode(''))
        ->setText($websiteurl."/verify-product/?verificationno=$varificationcode");
        $qrCode->writeFile(__DIR__ .'../../../web'.'/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:120px;">';
        }else{
            $qrcode = '' ;
        }
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 
            'margin_top' => 70,
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_bottom' => 30,
        'autoPageBreak' => true,
        'default_font' => 'segoeregular',
        // 'format' => 'A3'
        'format' => [250, 330]]);
        $footer = '{PAGENO}/{nbpg}';
        $baseUrl = \Yii::$app->params['baseUrl'];
        // $mpdf->SetWatermarkImage($baseUrl.'assets/images/opalimages/opalpdflogo.png',.03, 1, 100, '', '', '', true, true);
        $mpdf->SetWatermarkImage($baseUrl.'assets/images/opalimages/backbanner.svg',0.2, [250, 80], [0, 250], 100, 'auto', true);
        $mpdf->watermarkImageAlpha = .1;
        $mpdf->showWatermarkImage = true;
        $mpdf->SetHTMLHeader(  '<table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td style="padding: 0px;border-width: 0px;color: #666666;width: 75%;text-align: left;font-size: 14px">Revision: <span style="color: #262626">1.0</span></td>
                <td style="padding: 0px 0 0 20px;border-width: 0px;color: #666666;text-align: left;font-size: 14px;width: 25%;">DOC. No: <span style="color: #262626;font-size: 14px">OPAL-STD-QA-101</span></td>
            </tr>
        </tbody>
    </table>    
        <div style=" background-color: #ffffff;padding: 5px 5px;width: 100%;">
                                    <table style="table-layout: fixed; width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 15%;border-width: 0px;"> 
                                                    <img src="'.$baseUrl.'assets/images/opalimages/opalproviderNew.svg" style="width: 120px">
                                                </td>
                                                <td  style="border-width: 0px;padding: 0 20px;width: 70%;"> 
                                                    <div class="contactinfo">
                                                      <h4 style="font-weight: 400;font-size: 17px;color: #0c4b9a;margin:0px;padding-left:20px;">'.$memberreg['omrm_companyname_en'].'</h4>
                                                      <table style="table-layout: fixed; width: 100%;margin-top: 15px">
                                                           <tbody>
                                                               <tr>
                                                                  <td style="padding: 0px;border-width: 0px;color: #666666;width: 40%;text-align: left;font-size: 14px">OPAL Membership Number</td>
                                                                  <td style="padding: 0px 5px 0 0;border-width: 0px;color: #666666;width: 3px;text-align: left;font-size: 14px">:</td>
                                                                  <td style="padding: 0px;border-width: 0px;color: #262626;text-align: left;font-size: 14px">'.$memberreg['omrm_opalmembershipregnumber'] .'</td>
                                                               </tr>
                                                               <tr style="background-color: transparent;">
                                                                  <td style="padding: 5px 0;border-width: 0px;color: #666666;width: 40%;text-align: left;font-size: 14px">Company Registration Number</td>
                                                                  <td style="padding: 5px 5px 5px 0;border-width: 0px;color: #666666;width: 3px;text-align: left;font-size: 14px">:</td>
                                                                  <td style="padding: 5px 0;border-width: 0px;color: #262626;text-align: left;font-size: 14px">'.$memberreg['omrm_crnumber'] .'</td>
                                                               </tr>
                                                               <tr>
                                                                  <td style="padding: 0px;border-width: 0px;color: #666666;width: 40%;text-align: left;font-size: 14px">Date of Report</td>
                                                                  <td style="padding: 0px 5px 0 0;border-width: 0px;color: #666666;width: 3px;text-align: left;font-size: 14px">:</td>
                                                                  <td style="padding: 0px;border-width: 0px;color: #262626;text-align: left;font-size: 14px">'.date('d-m-Y').'</td>
                                                               </tr>
                                                           </tbody>
                                                       </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <td style="width: 15%;border-width: 0px;"> 
                                            '.$qrcode.'
                                                </td>
                                        </tbody>    
                                    </table>   
                                    <table>
                                       <tbody>
                                            <tr>
                                                <td style="border-radius: 4px;color: #ffffff;font-size: 18px width: 100%;padding: 10px;text-align: center;background-color: #0c4b9a;">
                                                Training Provider Certification - Site Audit Report
                                                </td>
                                            </tr>
                                       </tbody>
                                    </table>   
                                </div>');
        $mpdf->SetHTMLFooter('  <div style="position: relative; padding: 20px;">
                                        <table style="table-layout: fixed; width: 100%;margin-top: 15px">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0px;border-width: 0px;color: #666666;width: 45%;text-align: left;font-size: 14px"></td>
                                                    <td style="padding: 0px 5px 0 0;border-width: 0px;width: 60%;text-align: left;font-size: 17px"><span style="color: #666666;font-size: 17px">www.</span><span style="color: #ED1C27;font-size: 17px">usp.opaloman</span><span style="color: #666666;font-size: 17px">.om</span></td>
                                                    <td style="padding: 0px;border-width: 0px;color: #262626;text-align: left;font-size: 17px;width: 5%;">{PAGENO}/{nbpg}</td>
                                                </tr>
                                            </tbody>
                                        </table>    
                                </div>');
         $mpdf->WriteHTML(Yii::$app->controller->renderPartial('../../../al/views/afterlogin/siteauditreport',['data'=>$data,'address'=>$address,'userdata'=>$model,'summarydata'=>$summarydata,'overall'=>$correspondingGrade,'appdata'=> $Appmodel,'desktopreview'=>$historydata ,'siteauditor'=>$siteauditor,'qualitimanager'=>$qualitimanager,'authoriy'=>$authoriy,'ceo'=>$ceo,'qrcode'=>$qrcode]));
         $regPk = $Appmodel['appdt_opalmemberregmst_fk'];
         $path = "../api/web/siteauditreport/$regPk/";
         $path1 = "/web/siteauditreport/$regPk/";
         $formattedDate = date('Y-m-d H:i:s');
         $formattedDateWithoutSpaces = str_replace([' ', ':', '-'], '', $formattedDate);       
         $filename='siteauditreport_'.$Appmodel['applicationdtlstmp_pk'].'+++'.$formattedDateWithoutSpaces.'+++'.'.pdf';
         $filename1='siteauditreport_'.$Appmodel['applicationdtlstmp_pk'].'original'.'.pdf';
         if(!is_dir($path)){
             mkdir($path, 0777, true);
         } 
          $mpdf->Output($path.$filename,'F');

          if($Appmodel['appdt_status'] == 17){
            
            if(!is_dir($path)){
                mkdir($path, 0777, true);
            } 
             $mpdf->Output($path.$filename1,'F');
             $maintable = ApplicationdtlsmainTbl::find()->where("appdm_applicationdtlstmp_fk = '$applicationid'")->one(); 
             $maintable->appdm_auditedreport = $path1.$filename1;
             $maintable->save();
          }

          $application =  ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk = '$applicationid'")->one(); 
          $application->appdt_auditedreport =  $path1.$filename;   
          $application->save();
    }










































































































    public function getfinalcerificat($apppk){
        $applicatonpk = $apppk;
        $websiteurl = \Yii::$app->params['website_url'];
        $ckeckfinalauthorityapproval = appapprovalhdrtbl::find()->where('aah_status =1 and aah_applicationdtlstmp_fk = '.$applicatonpk)
        ->orderBy(['appapprovalhdr_pk' => SORT_DESC])->asArray()->one();

        $finalauthoriy = ProjapprovalworkflowdtlsTbl::find()->where('projapprovalworkflowdtls_pk = '.$ckeckfinalauthorityapproval['aah_projapprovalworkflowdtls_fk'])
         ->orderBy(['projapprovalworkflowdtls_pk' => SORT_DESC])->asArray()->one(); 
       
        // if($finalauthoriy['pawfh_Isfinalauthority'] == '1'){

            $applictioninfo = ApplicationdtlstmpTbl::find()
            ->select(['applicationdtlstmp_tbl.*','opalstatemst_tbl.*','opalcitymst_tbl.*'])
            ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
            ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk') 
            ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
         
            $course = AppstaffinfotmpTbl::find()->Select('group_concat(appsit_apprasvehinspcattmp_fk) as cat')->where('appsit_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();

            $subcat = ApprasvehinspcattmpTbl::find()->Select('group_concat(rcm_coursesubcatname_en) as subcat')->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvict_rascategorymst_fk')->where('apprasvehinspcattmp_pk in ('.$course['cat'].')')->asArray()->one();
           
            $year  = OpalInvoiceTbl::find()
                ->select(['feesubscriptionmst_tbl.*'])
                ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
                ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
                ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
                // if($applictioninfo['appdt_isprimarycert'] == 1){
                //     $companyinfo = OpalmemberregmstTbl::find()
                //     ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                //     ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
                //     ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
                //     ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                //         ->asArray()->one();
                //        }else{
                           $companyinfo = ApplicationdtlstmpTbl::find()
                           ->select(['applicationdtlstmp_tbl.*','opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                           ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
                           ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
                           ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
                           ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk')
                           ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
                  //     }

                      
                    
           

            if(empty($applictioninfo['appdt_verificationno'])){
                $varificationcode = 'TPC'.self::generateRandomString();
            }else{
                $varificationcode = $applictioninfo['appdt_verificationno'];
            }
            if(empty($applictioninfo['appdt_certificateexpiry'])){
               
                $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
                $end = date('Y-m-d', strtotime($increasedate));
                // $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end)); 

            }else if($applictioninfo['appdt_apptype'] == '2'){
               
                $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
                $end = date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry'].$increasedate));
                // $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end)); 
                
            }else{
                $end_format = date("d-m-Y", strtotime($applictioninfo['appdt_certificateexpiry'])); 

            }

            $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];  
           // $applictioninfo['appdt_projectmst_fk']  = 2;    
           
           $contentinfo = ProjectmstTbl::find()
           ->select(['pm_certcontent'])
           ->where('projectmst_pk = 4')
               ->asArray()->one();   
            $text = $contentinfo['pm_certcontent'];
 
 
            $path = "../api/web/certificate/$regPk/";
            $path1 = "/web/certificate/$regPk/";

            if(!is_dir($path)){
                mkdir($path, 0777, true);
            }  
            $baseUrl = \Yii::$app->params['baseUrl'];
            $mPDF1 = new \Mpdf\Mpdf([
                'mode' => '',
                'format' => 'A4-L',
                'margin_left' => '15',
                'margin_right' => '15',
                'margin_top' => '35', 
                'margin_bottom' => '16',
                'margin_header' => '9',
                'margin_footer' => '9',
                'default_font_size' => '0', 
                'orientation' => 'L',
                'default_font' => 'futurastdmedium']);
       
            $cerpath = dirname(__FILE__).'../../../../../certicate/rascert.pdf';
            $pagecount = $mPDF1->SetSourceFile($cerpath);
            $tplId = $mPDF1->ImportPage($pagecount);
            $mPDF1->UseTemplate($tplId);
            $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_branch_en'] . ' </div>', 50, 88, 430, 20);
            // if($applictioninfo['appdt_isprimarycert'] == 1){
            // $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$companyinfo['osm_statename_en'].','.$companyinfo['ocim_cityname_en']  .')'. '</div>',  50, 90, 460, 20);
            // }else{
            // $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$applictioninfo['osm_statename_en'].','.$applictioninfo['ocim_cityname_en']  .')'. '</div>',50, 90, 460, 20);
            // }
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 16pt;text-align: center;color:#1C1C1B ">' . $text . ' </div>', 50, 103, 200, 20);

            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Categories: ' . $subcat['subcat'] . ' </div>', 25, 135, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">CR No.: ' . $companyinfo['omrm_crnumber'] . ' </div>', 25, 142, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Verification Code: ' . $varificationcode . ' </div>', 25, 149, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Expiry Date: ' . $end_format . ' </div>', 25, 156, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Governorate: ' . $companyinfo['osm_statename_en'] . ' </div>', 25, 163, 200, 20);
            $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Wilayat: ' . $applictioninfo['ocim_cityname_en'] . ' </div>', 25, 170, 200, 20);
            $qrCode = (new QrCode(''))
            ->setText($websiteurl."/verify-product/?verificationras=$varificationcode".'#ras');
            
            $qrCode->writeFile(__DIR__ . '/code.png'); 
            $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:55pt; height:55pt;">';

        
            $mPDF1->WriteFixedPosHTML($qrcode, 255, 165, 290, 50);
            
            $rand = rand(10,100);
            $mPDF1->Output($path .$applictioninfo['appdt_appreferno'].'.pdf', 'F');
            $model = ApplicationdtlstmpTbl::find() ->where('applicationdtlstmp_pk = '.$applicatonpk)->one();
            $model->appdt_verificationno =  $varificationcode;
            $model->appdt_certificategenon = date("Y-m-d H:i:s");
            $model->appdt_certificatepath = $path1 .$applictioninfo['appdt_appreferno'].'.pdf'.'?v='.$rand;
            if($applictioninfo['appdt_apptype'] == '1' || $applictioninfo['appdt_apptype'] == '2'){
                $model->appdt_certificateexpiry = $end;
            }
         
            if(!$model->save()){ 
            
                return $model->getErrors();  
            }else{
               
            return 'success';
            }
      
        // }else{
        //     return 'fail';
        // }
 }

public static function generatesiteauditreportras($app_pk) {
    $applicationid = $app_pk;

    $Appmodel = \app\models\ApplicationdtlstmpTbl::find()
        ->select(['applicationdtlstmp_tbl.*','appiit_addrline1','appiit_addrline2','appiit_officetype','osm_statename_en','ocim_cityname_en','DATE_FORMAT(appdt_appdecon,"%d-%m-%Y") AS appdtappdecon','oum_firstname','appiit_noofomani','appiit_noofexpat'])
        ->leftJoin('opalusermst_tbl','opalusermst_pk = appdt_appdecby')
        ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk')
        ->where("applicationdtlstmp_pk =:pk", [':pk' => $applicationid])->asArray()->one();
        
        $total = $Appmodel['appiit_noofomani'] + $Appmodel['appiit_noofexpat'];
        $omanpercentage = $Appmodel['appiit_noofomani']/$total*100;
        $Appmodel['totalemployee'] = $total;
        if($total != 0 ){
        $Appmodel['omanpercentage'] = round($omanpercentage);
        }
    $memberreg =  \app\models\OpalmemberregmstTbl::find()
    ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
    ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
    ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
    ->where(['opalmemberregmst_pk'=>$Appmodel['appdt_opalmemberregmst_fk']])->asArray()->one();

    $schedulemodel = \app\models\AppauditschedtmpTbl::find()->where("appasdt_applicationdtlstmp_fk =:pk", [':pk' => $applicationid])->asArray()->one();  
    $data = \app\models\Appsiteauditreportcattmptbl::find()
    ->select(['appsiteauditreportcattmp_tbl.*','grademst_tbl.*'])
    ->leftJoin('grademst_tbl','grademst_pk = asarct_grademst_fk')
    ->where('asarct_appauditschedtmp_fk ='.$schedulemodel['appauditschedtmp_pk'])
    ->asArray()->all();

    $summary =[];
    foreach($data as $singledata){

        $answerdata = \app\models\OpalsiteanswerTbl::find()
        ->select(['*'])
        ->leftJoin('appsiteauditquestionmsttmp_tbl ques','ques.appsiteauditquestionmsttmp_pk = asaad_auditquestionmst_fk')
        ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = asaqm_fileupload')
        ->leftJoin('appsiteauditreportcattmp_tbl  category','category.appsiteauditreportcattmp_pk = asaqm_appsiteauditreportcattmp_fk') 
        ->leftJoin('grademst_tbl','grademst_pk = asaad_grademst_fk')
        ->Where(['asaqm_appsiteauditreportcattmp_fk'=>$singledata['appsiteauditreportcattmp_pk']])
        ->orderBy('asaqm_order asc')
        ->asArray()
        ->all();
        foreach($answerdata as $answer){
            if($answer['asaad_isselected']== 1){
                $ans = 'Approved';
                if($answer['asaad_answer_en'] == 'Not Approved'){
                    $ans = 'Not Approved';
                    break;
                }
            }
        }
        array_push($summary,['category'=>$singledata['asarct_categorytitle_en'],'status'=>$ans]);
    }
    // print_r($summary);exit;

    $model_1 = \app\models\OpalusermstTbl::find()
    ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omgm_gradename_en','omgm_gradename_ar'])
    ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
    ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
    ->leftJoin('Opalmoherigrademst_Tbl','opalmoherigradingmst_pk=omrm_opalmoherigradingmst_pk')
    ->where('oum_opalmemberregmst_fk ='.$Appmodel['appdt_opalmemberregmst_fk'].' and oum_status = "A" and oum_isfocalpoint = 1 and oum_projectmst_fk is null' )
    ->asArray()
    ->one();

    $model_2 = \app\models\OpalusermstTbl::find()
    ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omgm_gradename_en','omgm_gradename_ar'])
    ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
    ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
    ->leftJoin('Opalmoherigrademst_Tbl','opalmoherigradingmst_pk=omrm_opalmoherigradingmst_pk')
    ->where('oum_opalmemberregmst_fk ='.$Appmodel['appdt_opalmemberregmst_fk'].' and oum_status = "A" and oum_isfocalpoint = 1 and oum_projectmst_fk = 4' )
    ->asArray()
    ->one();

    if(empty($model_1)){
        $model= $model_2;
    }else{
        $model= $model_1;
    }
    
    $address =[];
    if($Appmodel['appiit_officetype'] == 1){
        $address['address1'] = $Appmodel['appiit_addrline1'];
        $address['address2'] =  $Appmodel['appiit_addrline2'];
        $address['statename_en'] = $Appmodel['osm_statename_en'];
        $address['cityname_en'] = $Appmodel['ocim_cityname_en'];

    }else{
        $address['address1'] = $Appmodel['appiit_addrline1'];
        $address['address2'] = $Appmodel['appiit_addrline2'];
        $address['statename_en'] = $Appmodel['osm_statename_en'];
        $address['cityname_en'] = $Appmodel['ocim_cityname_en'];

    }

    // $gradedata =\app\models\GrademstTbl::find()
    // ->select(['*'])
    // ->where('gm_status = :gm_status',[ ':gm_status' => 1])
    // ->orderBy('grademst_pk asc')
    // ->asArray()->all();
    // $bronzepercentage = $gradedata[0]['gm_scoreinpercent'];
    // $bronzescorefrom = $gradedata[0]['gm_scorefrom'];
    // $bronzescoreto = $gradedata[0]['gm_scoreto'];
    // $silverpercentage = $gradedata[1]['gm_scoreinpercent'];
    // $silverscorefrom = $gradedata[1]['gm_scorefrom'];
    // $silverscoreto = $gradedata[1]['gm_scoreto'];
    // $goldpercentage = $gradedata[2]['gm_scoreinpercent'];
    // $goldscorefrom = $gradedata[2]['gm_scorefrom'];
    // $goldscoreto = $gradedata[2]['gm_scoreto'];

    // $summarydata =[];
    // $superover = 0;
    //  foreach($data as $category){
    //     $total =  $category['asarct_totalques']? $category['asarct_totalques']:0; 
    //     $bronze =  $category['asarct_bronze']? $category['asarct_bronze']:0; 
    //     $silver = $category['asarct_silver']? $category['asarct_silver']:0;
    //     $gold =  $category['asarct_gold']? $category['asarct_gold']:0;
        
    //     $bronzeper = round(($bronze / $total) * $bronzepercentage);
    //     $silverper = round(($silver / $total) * $silverpercentage);
    //     $goldper = round(($gold / $total) * $goldpercentage);

    //     $overall = $bronzeper + $silverper + $goldper;
    //     $superover = $superover + $overall ;
    //     array_push($summarydata,['grade'=>$category['asarct_grademst_fk'],'cat_name'=>$category['asarct_categorytitle_en'],'percenteage'=>  $overall,'gradename'=>$category['gm_gradename_en']]);

     
    //  }
    // //  print_r( $superover /count($data));
    // //  exit;
    //  $superover = $superover /count($data);
    //  $correspondingGrade = null;
    // foreach ($gradedata as $grade) {
    //  if ($superover >= $grade["gm_scorefrom"] && $superover <= $grade["gm_scoreto"]) {
    //      $correspondingGrade = $grade;
        
    //      break;
    //  }
    // }
    // $correspondingGrade['percentage'] = round($superover);
    //  print_r($correspondingGrade);
    //  exit;
    $historydata = \app\models\AppauditreportlogTbl::find()
    ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
    ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status in(1,2)')
    ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk ASC')->asArray()->all();

    $siteauditor = \app\models\AppauditreportlogTbl::find()
    ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
    ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 3')
    ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

    $qualitimanager = \app\models\AppauditreportlogTbl::find()
    ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
    ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 4')
    ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

    $authoriy  = \app\models\AppauditreportlogTbl::find()
    ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
    ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 5')
    ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

    $ceo = \app\models\AppauditreportlogTbl::find()
    ->select(['aarl_status','oum_firstname','aarl_appdeccomments','DATE_FORMAT(aarl_appdecon,"%d-%m-%Y") AS aarlappdecon'])
    ->where(['aarl_applicationdtlstmp_fk'=>$Appmodel['applicationdtlstmp_pk']])->andWhere('aarl_status = 6')
    ->leftJoin('opalusermst_tbl','opalusermst_pk = aarl_appdecby')->orderBy('appauditreportlog_pk desc')->asArray()->one();

    if($Appmodel['appdt_status'] == 17){
        $varificationcode = $Appmodel['appdt_verificationno'];
        $websiteurl = \Yii::$app->params['website_url'];
        $qrCode = (new QrCode(''))
        ->setText($websiteurl."/verify-product/?verificationras=$varificationcode".'#ras');
        $qrCode->writeFile(__DIR__ .'../../../web'.'/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:120px;">';
        }else{
            $qrcode = '' ;
        }
       
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'margin_top' => 70,
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_bottom' => 30,
    'autoPageBreak' => true,
    'default_font' => 'segoeregular',
    // 'format' => 'A3'
    'format' => [250, 330]]);
    $footer = '{PAGENO}/{nbpg}';
    $baseUrl = \Yii::$app->params['baseUrl'];
    // $mpdf->SetWatermarkImage($baseUrl.'assets/images/opalimages/opalpdflogo.png',.03, 1, 100, '', '', '', true, true);
    $mpdf->SetWatermarkImage($baseUrl.'assets/images/opalimages/backbanner.svg',0.2, [250, 80], [0, 250], 100, 'auto', true);
    $mpdf->watermarkImageAlpha = .1;
    $mpdf->showWatermarkImage = true;
    $mpdf->SetHTMLHeader(  '<table style="table-layout: fixed; width: 100%;">
    <tbody>
        <tr>
            <td style="padding: 0px;border-width: 0px;color: #666666;width: 70%;text-align: left;font-size: 14px">Revision: <span style="color: #262626">1.0</span></td>
            <td style="padding: 0px 0 0 20px;border-width: 0px;color: #666666;text-align: left;font-size: 14px;width: 30%;">DOC. No: <span style="color: #262626;font-size: 14px">OPAL-STD-HSE--01 Rev 2</span></td>
        </tr>
    </tbody>
</table>    
    <div style=" background-color: #ffffff;padding: 5px 5px;width: 100%;">
                                <table style="table-layout: fixed; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%;border-width: 0px;"> 
                                                <img src="'.$baseUrl.'assets/images/opalimages/opal-inspection.svg" style="width: 120px">
                                            </td>
                                            <td  style="border-width: 0px;padding: 0 20px;width: 70%;"> 
                                                <div class="contactinfo">
                                                  <h4 style="font-weight: 400;font-size: 17px;color: #0c4b9a;margin:0px;padding-left:20px;">'.$memberreg['omrm_companyname_en'].'</h4>
                                                  <table style="table-layout: fixed; width: 100%;margin-top: 15px">
                                                       <tbody>
                                                           <tr>
                                                              <td style="padding: 0px;border-width: 0px;color: #666666;width: 40%;text-align: left;font-size: 14px">OPAL Membership Number</td>
                                                              <td style="padding: 0px 5px 0 0;border-width: 0px;color: #666666;width: 3px;text-align: left;font-size: 14px">:</td>
                                                              <td style="padding: 0px;border-width: 0px;color: #262626;text-align: left;font-size: 14px">'.$memberreg['omrm_opalmembershipregnumber'] .'</td>
                                                           </tr>
                                                           <tr style="background-color: transparent;">
                                                              <td style="padding: 5px 0;border-width: 0px;color: #666666;width: 40%;text-align: left;font-size: 14px">Company Registration Number</td>
                                                              <td style="padding: 5px 5px 5px 0;border-width: 0px;color: #666666;width: 3px;text-align: left;font-size: 14px">:</td>
                                                              <td style="padding: 5px 0;border-width: 0px;color: #262626;text-align: left;font-size: 14px">'.$memberreg['omrm_crnumber'] .'</td>
                                                           </tr>
                                                           <tr>
                                                              <td style="padding: 0px;border-width: 0px;color: #666666;width: 40%;text-align: left;font-size: 14px">Date of Report</td>
                                                              <td style="padding: 0px 5px 0 0;border-width: 0px;color: #666666;width: 3px;text-align: left;font-size: 14px">:</td>
                                                              <td style="padding: 0px;border-width: 0px;color: #262626;text-align: left;font-size: 14px">'.date('d-m-Y').'</td>
                                                           </tr>
                                                       </tbody>
                                                   </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <td style="width: 15%;border-width: 0px;"> 
                                            '.$qrcode.'
                                                </td>
                                    </tbody>    
                                </table>   
                                <table>
                                   <tbody>
                                        <tr>
                                            <td style="border-radius: 4px;color: #ffffff;font-size: 18px width: 100%;padding: 10px;text-align: center;background-color: #0c4b9a;">
                                            Roadworthiness Assurance Standards - RAS Inspection Centre Feedback Report
                                            </td>
                                        </tr>
                                   </tbody>
                                </table>    
                            </div>');
    $mpdf->SetHTMLFooter('  <div style="position: relative; padding: 20px;">
                                    <table style="table-layout: fixed; width: 100%;margin-top: 15px">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 0px;border-width: 0px;color: #666666;width: 45%;text-align: left;font-size: 14px"></td>
                                                <td style="padding: 0px 5px 0 0;border-width: 0px;width: 60%;text-align: left;font-size: 17px"><span style="color: #666666;font-size: 17px">www.</span><span style="color: #ED1C27;font-size: 17px">usp.opaloman</span><span style="color: #666666;font-size: 17px">.om</span></td>
                                                <td style="padding: 0px;border-width: 0px;color: #262626;text-align: left;font-size: 17px;width: 5%;">{PAGENO}/{nbpg}</td>
                                            </tr>
                                        </tbody>
                                    </table>    
                            </div>');
     $mpdf->WriteHTML(Yii::$app->controller->renderPartial('../../../al/views/afterlogin/siteauditreportras',['data'=>$data,'address'=>$address,'userdata'=>$model,'appdata'=> $Appmodel,'desktopreview'=>$historydata ,'siteauditor'=>$siteauditor,'qualitimanager'=>$qualitimanager,'authoriy'=>$authoriy,'ceo'=>$ceo,'summary'=>$summary]));
     $regPk = $Appmodel['appdt_opalmemberregmst_fk'];
     $path = "../api/web/siteauditreport/$regPk/";
     $path1 = "/web/siteauditreport/$regPk/";
     $formattedDate = date('Y-m-d H:i:s');
     $formattedDateWithoutSpaces = str_replace([' ', ':', '-'], '', $formattedDate);       
     $filename='siteauditreport_'.$Appmodel['applicationdtlstmp_pk'].'+++'.$formattedDateWithoutSpaces.'+++'.'.pdf';
     $filename1='siteauditreport_'.$Appmodel['applicationdtlstmp_pk'].'original'.'.pdf';
     if(!is_dir($path)){
         mkdir($path, 0777, true);
     } 
      $mpdf->Output($path.$filename,'F');

      if($Appmodel['appdt_status'] == 17){
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        } 
         $mpdf->Output($path.$filename1,'F');
         $maintable = ApplicationdtlsmainTbl::find()->where("appdm_applicationdtlstmp_fk = '$applicationid'")->one(); 
         $maintable->appdm_auditedreport = $path1.$filename1;
         $maintable->save();
      }

      $application =  ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk = '$applicationid'")->one(); 
      $application->appdt_auditedreport =  $path1.$filename;   
      $application->save();
}

public static function appstaffuserupdate($id = '' ,$projectpk) {
    $staffinfomaindata = '';
      if(!empty($id)) {
          if($projectpk == '4'){
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
                $condata  =  \app\models\AppstaffinfotmpTbl::find()
                ->select(['appostaffinfotmp_pk','appsit_staffinforepo_fk','appsit_roleforcourse','appsit_emailid'])
                ->where("appsit_applicationdtlstmp_fk =:pk", [':pk' => $id])->asArray()->All();
         
                  if(!empty($condata)) {
                    foreach ($condata  as $key => $value) {
                    $model = \app\models\OpalusermstTbl::find()->where("oum_staffinforepo_fk =:pk", [':pk' => $value['appsit_staffinforepo_fk']])->one();
                
                    if($model){
                    $model->oum_rolemst_fk = $value['appsit_roleforcourse'];
                    $model->oum_emailid = $value['appsit_emailid'];
                    $model->oum_projectmst_fk = $projectpk;
                    $model->oum_updatedon = date("Y-m-d H:i:s");
                    $model->oum_updatedby = $userPk;
                    if ($model->save() === TRUE) {
                            $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'data' => $model,
                            'comments' => 'user Updated Successfully!'
                            );
                    } else {
                    $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                    );
                    }
                    }
                    }    
      
              }
          }
         
      }
      return $result;
  }
}
