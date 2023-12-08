<?php

namespace api\modules\cm\controllers;
use setasign\Fpdi\Fpdi;
// require_once(__DIR__.'\fpdf\fpdf.php');
// require_once(__DIR__.'\fpdi\autoload.php');
use DateTime;
use DateTimeZone;
use Yii;
use api\modules\mst\controllers\MasterController;
use api\modules\center\controllers\AppCenterController;
use yii\data\ActiveDataProvider;

use app\models\StandardcoursemstTbl;
use app\models\CoursecategorymstTbl;
use app\models\StaffinforepoTbl;
use app\models\StaffacademicsTbl;
use app\models\StaffworkexpTbl;
use app\models\IntnatrecogmstTbl;
use app\models\AppintrecogtmpTbl;
use app\models\ReferencemstTbl;
use app\models\ApplicationdtlstmpTbl;
use app\models\AppcoursedtlstmpTbl;
use app\models\AppcoursetrnstmpTbl;
use app\models\AppoffercoursemainTbl;
use app\models\opalcountrymsttbl;
use app\models\RolemstTbl;
use app\models\OpalstatemstTbl;
use  app\models\OpalcitymstTbl;
use app\models\AppoffercourseunitmainTbl;
use app\models\DocumentdtlsmstTbl;
use app\models\AppoprcontracttmpTbl;
use app\models\AppdocsubmissiontmpTbl;
use app\models\AppstafflocationtmpTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\AppstaffinfotmpTbl;
use app\models\ApppymtdtlstmpTbl;
use app\models\AppapprovalhdrTbl;
use app\models\OpalInvoiceTbl;
use \app\models\OpalusermstTbl;
use \app\models\AppstaffinfomainTbl;
use app\models\OpalmemberregmstTbl;
use \app\models\ProjapprovalworkflowdtlsTbl;
use app\models\StandardcoursedtlsTbl;
use app\models\AppintrecogmainTbl;
use api\modules\center\components\SiteAudit;
use app\models\AppinstinfomainTbl;
use app\models\BatchmgmtasmthdrTbl;
use app\models\BatchmgmtthyhdrTbl;
use app\models\BatchmgmtpracthdrTbl;
use app\models\StaffcourseconfigmstTbl;
use DatePeriod;
use api\modules\cm\components\Course;


class CoursemanagementController extends MasterController
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
    
             
    public function actionGetcourse(){
        // 16 - Same Centre 17 - different centre 
        $cousre_list = StandardcoursemstTbl::find()
        ->select(['standardcoursemst_pk as pk','scm_coursename_en as course_en','scm_coursename_ar as course_ar','scm_requestfor','level.rm_name_en as level','scm_coursecategorymst_fk','reqfor.rm_name_en','reqfor.rm_name_ar','ccm_catname_en','ccm_catname_ar','scm_assessmentin','scm_isintlreorgreq'])
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = scm_coursecategorymst_fk')
        ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = scm_requestfor')
        ->leftJoin('referencemst_tbl level','level.referencemst_pk = scm_courselevel')
        ->where(['scm_status'=>1])
        ->asArray()->All();

        $requestformst = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>13])
        ->asArray()->All();

        $deliverto = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>2])
        ->asArray()->All();



        return ['courselist'=>$cousre_list,'requestformst'=>$requestformst ,'deliverto'=>$deliverto];
    }

    public function actionGetcustomcourse(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);

        $cousre_list = AppoffercoursemainTbl::find()
        ->select(['appoffercoursemain_pk as pk','appocm_coursename_en as course_en','appocm_coursename_ar as course_ar','level.rm_name_en as level','appocm_coursesubcategorymst_fk','ccm_catname_en','ccm_catname_ar'])
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appocm_coursecategorymst_fk')
        ->leftJoin('referencemst_tbl level','level.referencemst_pk = appocm_courselevel')
        ->where(['appocm_opalmemberregmst_fk'=>$regPk])
        ->asArray()->All();

        $requestformst = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>13])
        ->asArray()->All();


        $deliverto = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>2])
        ->asArray()->All();

        return ['courselist'=>$cousre_list,'requestformst'=>$requestformst ,'deliverto'=>$deliverto];
    }
    public function actionChechalredyapply(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);

        $record = AppcoursedtlstmpTbl:: find()->where(['appcdt_standardcoursemst_fk' => $data['pk'],'appcdt_opalmemberregmst_fk'=>$regPk,'appcdt_appinstinfomain_fk'=>$data['appinstinfomain_pk'] ])
        ->asArray()->one();
        // ->createCommand()->getRawSql();
        // print_r($record);exit;

        if(empty($record)){
            $exists = 'no';
        $requestformst = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>13,'srm_status'=>1])
        ->andWhere("referencemst_pk in (".$data['reqforfk'].")")
        ->asArray()->All();

        }else{
            $exists = 'yes';

        }

        return ['exists'=> $exists , 'requestformst'=>$requestformst];
        
    }

    public function actionGetstaffsubcategory(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $staffsubcat = AppcoursetrnstmpTbl::find()
        ->select(['appcoursetrnstmp_pk','ccm_catname_en','ccm_catname_ar'])
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appctt_coursecategorymst_fk')
        ->where(['appctt_appcoursedtlstmp_fk' =>$data['fk']])
        ->asArray()->all();

        return ['staffsubcat'=>$staffsubcat];

    }

    public function actionGetseccategory(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pk = $data['pk'];
        $typ = $data['type']; //2 standard ,3 customizes
        $category = CoursecategorymstTbl::find()
        ->select(['ccm_coursecategorymst_pk as subpk','ccm_catname_en as subcategory_en','ccm_catname_ar as subcategory_ar'])
        ->where(['coursecategorymst_pk'=>$pk])
        ->asArray()->one();

        if($typ == 2){
            $subcatpk = StandardcoursedtlsTbl::find()->select('group_concat(scd_subcoursecategorymst_fk) as subcat')->where('scd_standardcoursemst_fk = '.$pk)->asArray()->one();

            $subcousre_list = CoursecategorymstTbl::find()
            ->select(['coursecategorymst_pk as subpk','ccm_catname_en as subcategory_en','ccm_catname_ar as subcategory_ar'])
            ->where('coursecategorymst_pk in ('.$subcatpk['subcat'].')'.' and  ccm_status = 1')
            ->asArray()
            ->All();

        }else{
            $subcousre_list = CoursecategorymstTbl::find()
            ->select(['coursecategorymst_pk as subpk','ccm_catname_en as subcategory_en','ccm_catname_ar as subcategory_ar'])
            ->where('coursecategorymst_pk in ('.$pk.')'.' and  ccm_status = 1')
            ->asArray()
            ->All();
        }
      
     
         
        

        // $subcousre_list = CoursecategorymstTbl::find()
        // ->select(['standardcoursemst_pk as pk','scm_coursename_en as sub_course_en','scm_coursename_ar as sub_course_ar'])
        // ->where(['ccm_coursecategorymst_pk'=>])
        // ->asArray()->all();
        
        return ['category'=>$category,'subcategory'=> $subcousre_list];
    }

    public function actionGetunit(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pk = $data['pk'];
        $limit = $data['limit'];
        $page =$data['page'];

        $unit=AppoffercourseunitmainTbl::find()
        ->select(['appocum_UnitCode','appocum_UnitTitle'])
        ->where(['appocum_AppOfferCourseMain_FK'=>$pk])
        ->asArray();

        $dataProvider = new ActiveDataProvider([
            'query' => $unit,
            'pagination' => [
                                'pageSize' =>$limit,
                                'page'=>$page
                            ]
                ]);
         
        $allrecords = $dataProvider->getModels();
        $total =$dataProvider->getTotalCount();

        return ['unit'=> $allrecords ,'total' => $total];
    }
    
  
    public function actionGetintnatrecogmst(){
        //get master info

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $regon= IntnatrecogmstTbl::find()
        ->select(['intnatrecogmst_pk as pk','irm_intlrecogname_en','irm_intlrecogname_ar'])
        ->where(['irm_status'=>1])
        ->asArray()
        ->All();

        $countrymst=
        // opalcountrymsttbl::find()
        // ->select(['opalcountrymst_pk','ocym_countryname_en','ocym_countryname_ar'])
        // ->asArray()->All();
         \Yii::$app->db->createCommand(" select opalcountrymst_pk,ocym_countryname_en,ocym_countryname_ar from  opalcountrymst_tbl where ocym_status = 1 order by ocym_countryname_en='Oman' desc, ocym_countryname_en;")
        ->queryAll();

        $rolemst= RolemstTbl::find()
        ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
        ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
        ->asArray()->All();

        $referencemst = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>7,'srm_status'=>1])
        ->asArray()->All();

        $statemst=OpalstatemstTbl::find()
        ->select(['opalstatemst_pk','osm_opalcountrymst_fk','osm_statename_en','osm_statename_ar'])
        ->where(['osm_opalcountrymst_fk'=>31,'osm_status'=>1])
        ->asArray()->All();

        $educationlvl =ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>12])
        ->asArray()->All();

        $languages = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>10])
        ->asArray()->All();
        
        $dayschedule = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>11])
        ->andWhere('referencemst_pk != 32')
        ->asArray()->All();

      

        return ['recogmst'=>$regon,'countrymst'=>$countrymst,'rolemst'=>$rolemst,'contacttypemst'=> $referencemst,'statemst'=>$statemst,
    'educationlvl'=>$educationlvl,'languages'=>$languages,'dayscheule'=> $dayschedule];
    }
    
    public function actionGetcountrymst(){
        // $country=OpalcountrymstTbl::find()
        // ->select(['opalcountrymst_pk','ocym_countryname_en','ocym_countryname_ar'])
        // ->where(['ocym_status'=>1])
        // ->orderBy(['ocym_countryname_en'=> 'Oman','ocym_countryname_en'=>SORT_DESC])
        $country=  \Yii::$app->db->createCommand(" select opalcountrymst_pk,ocym_countryname_en,ocym_countryname_ar from  opalcountrymst_tbl where ocym_status = 1 order by ocym_countryname_en='Oman' desc, ocym_countryname_en;")
        ->queryAll();
        
        return ['country' => $country];
    }

    public function actionGetstatemst(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $countryfk =$data['countryfk']; 
        
        $statemst=OpalstatemstTbl::find()
        ->select(['opalstatemst_pk','osm_opalcountrymst_fk','osm_statename_en','osm_statename_ar'])
        ->where(['osm_opalcountrymst_fk'=>$countryfk,'osm_status'=>1])
        ->asArray()->All();
        // print_r($statemst);exit;
        
        return ['state' => $statemst];
    }


    public function actionGetcitymst(){

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        // print_r($data['statefk']);exit;
        $citymst=OpalcitymstTbl::find()
        ->select(['opalcitymst_pk','ocim_opalstatemst_fk','ocim_cityname_en','ocim_cityname_ar'])
        ->where(['ocim_opalstatemst_fk'=>$data['statefk'],'ocim_status'=>1])
        ->asArray()->All();

        return['citymst'=>$citymst];
    }
    public function actionGetstaffinfo(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);

        $workexp = StaffworkexpTbl::find()
        ->select(['staffworkexp_pk','sexp_employername as organname','DATE_FORMAT(sexp_doj,"%d-%m-%Y") AS datejoin','DATE_FORMAT(sexp_eod,"%d-%m-%Y") AS worktill','sexp_designation as desig','DATE_FORMAT(sexp_createdon,"%d-%m-%Y") AS addedu','DATE_FORMAT(sexp_updatedon,"%d-%m-%Y") AS lastUpdated'])
        ->andWhere('sexp_staffinforepo_fk = "' . $data['fks'] . '"')
        ->asArray()
        ->all();

        $edudet = StaffacademicsTbl::find()
        ->select(['staffacademics_pk','sacd_institutename as institute','sacd_degorcert as degree','DATE_FORMAT(sacd_startdate,"%d-%m-%Y") AS yearjoin','DATE_FORMAT(sacd_enddate,"%d-%m-%Y") AS yearpass','sacd_grade as grade','DATE_FORMAT(sacd_createdon,"%d-%m-%Y") AS addedu','DATE_FORMAT(sacd_updatedon,"%d-%m-%Y") AS lastUpdated'])
        ->andWhere('sacd_staffinforepo_fk = "' . $data['fks'] . '"')
        ->asArray()
        ->all();

        return['education'=>$edudet,'workexp'=>$workexp];

        
    
    }

    public function actionGetstaffavialabe(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $isstaffavalaibe = AppstaffinfotmpTbl::find()
        ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appsit_applicationdtlstmp_fk')
        ->where('appdt_projectmst_fk in (2,3) and appsit_staffinforepo_fk = '.$data['fks'].' and appsit_applicationdtlstmp_fk ='.$data['referencek'])
        ->asArray()->one();

        if(empty($isstaffavalaibe)){
            $arreaymapped ='no';
        }else{
            $arreaymapped ='yes';
        }

        return['alreadymapped'=> $arreaymapped];
    
    }

    public function actionCheckcivilnum(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $isstaffavi = StaffinforepoTbl::find()
        ->where('sir_idnumber = '."'".$data['civilnum']."'" )
        ->asArray()->one();

        $arreaymapped = 'no';
        
        if(!empty($isstaffavi['staffinforepo_pk'])){

        $isstaffavalaibe = AppstaffinfotmpTbl::find()
        ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appsit_applicationdtlstmp_fk')
        ->where(' appsit_staffinforepo_fk = '. $isstaffavi['staffinforepo_pk'].' and appsit_applicationdtlstmp_fk ='.$data['referencek'])
        ->asArray()->one();
            if(!empty($isstaffavalaibe)){
                $arreaymapped = 'alreadyadded';
            }

        }

      
        if($arreaymapped == 'no' && !empty($isstaffavi['staffinforepo_pk'])){
        $samebranch =AppstaffinfomainTbl::find()
        // ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appsit_applicationdtlstmp_fk')
        ->where('appsim_StaffInfoRepo_FK = '. $isstaffavi['staffinforepo_pk'] .' and appsim_appinstinfomain_fk ='.$data['appinstinfomain_pk'])
        ->asArray()->one();
        if(!empty($samebranch)){
            $arreaymapped = 'list';
        }else{
            $othbrach =AppstaffinfomainTbl::find()
            // ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appsit_applicationdtlstmp_fk')
            ->where('appsim_StaffInfoRepo_FK = '. $isstaffavi['staffinforepo_pk'] )
            ->asArray()->one();
            if(!empty($othbrach)){
                if($othbrach['appsim_opalmemberregmst_fk'] == $regPk){
                $arreaymapped = 'samebranch';
                }else{
                    $arreaymapped = 'diffbranch';
                }
            }

        }
        }
        if($arreaymapped == 'no'){
            if(!empty($isstaffavi)){
                $dataavailable ='yes';
            }
        }
     

        return['alreadymapped'=> $arreaymapped,'isstaffavi'=>$isstaffavi,'dataavailable'=>$dataavailable];
    
    }
    public function actionApplycertificate(){

        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        
        $applicationno = ApplicationdtlstmpTbl::savecousre($requestdata);

        return ['applicationrefpk' => $applicationno];
    }

    public function actionAddcourse(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
       
        // applicationdtlstmp_tbl
        // appcoursedtlstmp_tbl
        // appcoursetrnstmp_tbl
        if($requestdata['type'] == 'new'){
            if($requestdata['data']['course_delivered'] == 'others'){

                $deliverdata = ReferencemstTbl::find()->where('rm_mastertype = 2 and rm_name_en = '."'".$requestdata['data']['course_delivered_new']."'")->one();
                if(empty($deliverdata)){

                $deliverto = new ReferencemstTbl();
                $deliverto->rm_mastertype = 2;
                $deliverto->rm_name_en = $requestdata['data']['course_delivered_new'];
                $deliverto->rm_name_ar = $requestdata['data']['course_delivered_new'];
                $deliverto->srm_status = 1;
                $deliverto->srm_createdon = date("Y-m-d H:i:s");
                $deliverto->srm_createdby =  $userPk;
                if(!$deliverto->save()){
                    return $deliverto->getErrors();
                }else{
                    $delto =  $deliverto->referencemst_pk;
                }
            }else{
                $delto  = $deliverdata->referencemst_pk;
            }
            }
            $alreadyavilablee = null;
            if(!empty($requestdata['data']['appcoursedtlstmp_pk'])){
                $alreadyavilablee = AppcoursedtlstmpTbl::find()->where('appcoursedtlstmp_pk = '.$requestdata['data']['appcoursedtlstmp_pk'])->one();
                $alreadyavilablee->appcdt_standardcoursemst_fk = $requestdata['data']['course_titleen'];
                $alreadyavilablee->appcdt_requestfor =  $requestdata['data']['request_for'];
                if($alreadyavilablee->save()){
                    foreach($requestdata['data']['cour_subcate'] as $data){
                  
                        $model =  AppcoursetrnstmpTbl::find()->where('appctt_appcoursedtlstmp_fk = '.$requestdata['data']['appcoursedtlstmp_pk'].' and appctt_coursecategorymst_fk = '.$data )->one();
                       if(empty($model)){
                        $model_trns = new AppcoursetrnstmpTbl();
                        $model_trns->appctt_appcoursedtlstmp_fk  =  $requestdata['data']['appcoursedtlstmp_pk'];
                        $model_trns->appctt_coursecategorymst_fk = $data;
                        $model_trns->appctt_createdon =  date("Y-m-d H:i:s");
                        $model_trns->appctt_createdby =  $userPk ;
                        $model_trns->appctt_status = 5;
                        
                        if(!$model_trns->save()){
                            return $model_trns->getErrors();
                            exit;
                        }
                          }
                        }
                }

            }
           
            if(empty($alreadyavilablee)){
             $model_main = new AppcoursedtlstmpTbl();
            
             $model_main->appcdt_applicationdtlstmp_fk =  $requestdata['data']['referencepk'];
             if($requestdata['data']['standorcustom'] == 'standard'){
                $model_main->appcdt_standardcoursemst_fk = $requestdata['data']['course_titleen'];
                if(isset($requestdata['data']['bran_ch'])){
                    $model_main->appcdt_appinstinfomain_fk =  $requestdata['data']['bran_ch'];
                }else{
                    $model_main->appcdt_appinstinfomain_fk =  $requestdata['data']['institute'];
                }
                
             }else{
                $model_main->appcdt_appoffercoursemain_fk =  $requestdata['data']['course_titleen'];
                if(isset($requestdata['data']['bran_ch'])){
                    $model_main->appcdt_appinstinfomain_fk =  $requestdata['data']['bran_ch'];
                }else{
                    $model_main->appcdt_appinstinfomain_fk =  $requestdata['data']['institute'];
                }
                if($requestdata['data']['course_delivered'] == 'others'){
                     $model_main->appcdt_deliverto =$delto;
                }else{
                    $model_main->appcdt_deliverto =$requestdata['data']['course_delivered'];
                }
             }
            
             $model_main->appcdt_opalmemberregmst_fk =  $regPk;
            
             $model_main->appcdt_requestfor =  $requestdata['data']['request_for'];
             $model_main->appcdt_createdon = date("Y-m-d H:i:s");
             $model_main->appcdt_createdby =  $userPk;
             $model_main->appcdt_status = 2;

             if($model_main->save()){
                foreach($requestdata['data']['cour_subcate'] as $data){
                  
                $model_trns = new AppcoursetrnstmpTbl();
                $model_trns->appctt_appcoursedtlstmp_fk  =   $model_main->appcoursedtlstmp_pk;
                $model_trns->appctt_coursecategorymst_fk = $data;
                $model_trns->appctt_createdon =  date("Y-m-d H:i:s");
                $model_trns->appctt_createdby =  $userPk ;
                $model_trns->appctt_status = 2;
                
                if(!$model_trns->save()){
                    return $model_trns->getErrors();
                    exit;
                }
                  }
            return ['appcoursedtlstmp_pk' => $model_main->appcoursedtlstmp_pk];
             }else{
                return $model_main->getErrors();
                exit;
             }
            }else{
                return ['appcoursedtlstmp_pk' =>$requestdata['data']['appcoursedtlstmp_pk']];
            }
        }elseif($requestdata['type'] == 'edit'){
           // to check category delete start 
            $exitsting =  AppcoursetrnstmpTbl::find()->select(['appcoursetrnstmp_pk','appctt_coursecategorymst_fk'])->where('appctt_appcoursedtlstmp_fk = '.$requestdata['data']['appcoursedtlstmp_pk'])->asArray()->all();
            $arrive_data = $requestdata['data']['cour_subcate'];
            foreach ($exitsting as $item) {
                if (!in_array($item['appctt_coursecategorymst_fk'], $arrive_data)) {
                    $result[] = $item['appcoursetrnstmp_pk'];
                }
            }
            if(!empty($result)){
                $stafftmp =  AppstaffinfotmpTbl::find()->select(['GROUP_CONCAT(appsit_appcoursetrnstmp_fk) AS transfk'])->where('appsit_applicationdtlstmp_fk = '. $requestdata['data']['referencepk'])->asArray()->one();
                
                $distinctElements = array_unique(explode(',',$stafftmp['transfk']));
                foreach ($result as $value) {
                    if (in_array($value,$distinctElements)) {
                        $set[] = $value;
                    }
                }
                if(empty($set)){
                    // $model_trns =  AppcoursetrnstmpTbl::deleteAll('appctt_appcoursedtlstmp_fk = '.$requestdata['data']['appcoursedtlstmp_pk']);
                    \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                    AppcoursetrnstmpTbl::deleteAll('appcoursetrnstmp_pk in('.implode(',',$result).')');
                    \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                    $staffmap = 'no';
                    }else{
                        $staffmap = 'yes';
                    }
              
            }
            
        // to check category delete end 

            foreach($requestdata['data']['cour_subcate'] as $data){
                  
                $model =  AppcoursetrnstmpTbl::find()->where('appctt_appcoursedtlstmp_fk = '.$requestdata['data']['appcoursedtlstmp_pk'].' and appctt_coursecategorymst_fk = '.$data )->one();
               if(empty($model)){
                $model_trns = new AppcoursetrnstmpTbl();
                $model_trns->appctt_appcoursedtlstmp_fk  =  $requestdata['data']['appcoursedtlstmp_pk'];
                $model_trns->appctt_coursecategorymst_fk = $data;
                $model_trns->appctt_createdon =  date("Y-m-d H:i:s");
                $model_trns->appctt_createdby =  $userPk ;
                $model_trns->appctt_status = 5;
                
                if(!$model_trns->save()){
                    return $model_trns->getErrors();
                    exit;
                }
                  }
                }
                $modeldata = AppcoursedtlstmpTbl::find()->where('appcoursedtlstmp_pk = '.$requestdata['data']['appcoursedtlstmp_pk'])->one();
                $modeldata->appcdt_requestfor =  $requestdata['data']['request_for'];
                $modeldata->appcdt_status = 5;
                $modeldata->save();
                return ['appcoursedtlstmp_pk' => $requestdata['data']['appcoursedtlstmp_pk'] ,'staffmap'=>$staffmap]; 
        }
       
    

    }
    public function actionGetbranchlistbyregpk()
    {
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $regpk = isset($requestdata['regpk'])? $requestdata['regpk'] : 0;
        $offtype = isset($requestdata['officetype'])? $requestdata['officetype'] : 1;
        $decryptedId = \api\components\Security::decrypt($regpk);
// print_r(  $regpk);exit;
          $branches = \app\models\OpalmemberregmstTbl::getbranchinfo($regpk,$offtype);
      
        //   print_r($branches);exit;
     if($branches)
        {
             return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $branches ];
        }
        
         return [ 'msg' => 'failure', 'status' => 2, 'flag' => 'f', 'data' => '' ];   
    }
    public function actionSavestaff(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $model = new StaffinforepoTbl();
        $model->sir_opalmemberregmst_fk = $regPk;
        $model->sir_type = 1;
        $model->sir_idnumber = $requestdata['civil_num'];
        $model->sir_name_en = $requestdata['staffeng'];
        $model->sir_name_ar = $requestdata['staffarab'];
        $model->sir_emailid = $requestdata['email_id'];
        $model->sir_dob = $requestdata['date_birth'];
        $model->sir_gender = $requestdata['gend_er'];
        $model->sir_nationality = $requestdata['national'];

        $role = "";
        if(!empty($requestdata['role'])){
            $role = implode(',', $requestdata['role']);
        }

        $model->sir_addrline1 = $requestdata['house'];
        $model->sir_addrline2 = $requestdata['houseadd'];
        $model->sir_opalstatemst_fk = $requestdata['state'];
        $model->sir_opalcitymst_fk = $requestdata['city'];
        $model->sir_createdon = date("Y-m-d H:i:s");
        $model->sir_createdby =   $userPk;

         
        if($model->save()){

            return ['staffrepopk'=>$model->staffinforepo_pk];
        } else {
            var_dump($model->getErrors());
            exit;
        }  
     

    }
    public function actionSavestaffedu(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
// print_r( date("Y-m-d", strtotime($requestdata['data']['year_join'])));exit;
        if($requestdata['type'] ==  'new'){
            $modelAcc = new StaffacademicsTbl();
            $modelAcc->sacd_staffinforepo_fk = $requestdata['data']['staffrepopk'];
            $modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata['data']['year_join']));
            if(!empty($requestdata['data']['GradeDate'])){
                $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata['data']['GradeDate']));
            }
            $modelAcc->sacd_certupload = $requestdata['data']['education_files'];
            $modelAcc->sacd_institutename = $requestdata['data']['institute_name'];
            $modelAcc->sacd_opalcountrymst_fk = $requestdata['data']['institue_country'];
            $modelAcc->sacd_opalstatemst_fk = $requestdata['data']['inst_state'];
            $modelAcc->sacd_opalcitymst_fk = $requestdata['data']['inst_city'];
            $modelAcc->sacd_edulevel = $requestdata['data']['edut_level'];
            $modelAcc->sacd_degorcert = $requestdata['data']['degree_cert'];
            $modelAcc->sacd_grade = $requestdata['data']['gpa_grade'];
            $modelAcc->sacd_createdon = date("Y-m-d H:i:s");
            $modelAcc->sacd_createdby =   $userPk;
            if($modelAcc->save()){
                return true;
            }else{
                var_dump($modelAcc->getErrors());exit;
            }
        }elseif($requestdata['type'] ==  'edit'){
            $modelAcc =  StaffacademicsTbl::find()->where('staffacademics_pk = '.$requestdata['data']['staffacademics_pk'])->one();
            $modelAcc->sacd_staffinforepo_fk = $requestdata['data']['staffrepopk'];
            $modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata['data']['year_join']));
            if(!empty($requestdata['data']['GradeDate'])){
                $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata['data']['GradeDate']));
            }
            $modelAcc->sacd_certupload = $requestdata['data']['education_files'];
            $modelAcc->sacd_institutename = $requestdata['data']['institute_name'];
            $modelAcc->sacd_opalcountrymst_fk = $requestdata['data']['institue_country'];
            $modelAcc->sacd_opalstatemst_fk = $requestdata['data']['inst_state'];
            $modelAcc->sacd_opalcitymst_fk = $requestdata['data']['inst_city'];
            $modelAcc->sacd_edulevel = $requestdata['data']['edut_level'];
            $modelAcc->sacd_degorcert = $requestdata['data']['degree_cert'];
            $modelAcc->sacd_grade = $requestdata['data']['gpa_grade'];
            $modelAcc->sacd_createdon = date("Y-m-d H:i:s");
            $modelAcc->sacd_createdby =   $userPk;
            if($modelAcc->save()){
                return true;
            }else{
                var_dump($modelAcc->getErrors());exit;
            }
        }
          
    }
    public function actionSavestaffwork(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        if($requestdata['type'] ==  'new'){
        $modelExp = new StaffworkexpTbl();
        $modelExp->sexp_staffinforepo_fk = $requestdata['data']['staffrepopk'];
        $modelExp->sexp_employername = $requestdata['data']['oragn_name'];
        if(!empty($requestdata['data']['date_join'])){
            $modelExp->sexp_doj = $requestdata['data']['date_join'];
        }
       
        $curr_work=2;
        if(!empty($requestdata['data']['curr_work']) || $requestdata['data']['curr_work'] == true){ 
            $curr_work = 1;
        }
        // echo $curr_work;exit;
        $modelExp->sexp_currentlyworking = $curr_work;
        if($requestdata['data']['curr_work']==false){
        $modelExp->sexp_eod = $requestdata['data']['workdate'];
        }
        $modelExp->sexp_opalcountrymst_fk = $requestdata['data']['employ_country'];
        $modelExp->sexp_opalstatemst_fk = $requestdata['data']['employ_state'];
        $modelExp->sexp_opalcitymst_fk = $requestdata['data']['employ_city'];
        $modelExp->sexp_designation = $requestdata['data']['designat'];
        $modelExp->sexp_profdocupload = $requestdata['data']['work_files'];
        $modelExp->sexp_createdon = date("Y-m-d H:i:s");
        $modelExp->sexp_createdby =  $userPk;

        if($modelExp->save()){
            return $modelExp->staffworkexp_pk;
        }else{
           var_dump($modelExp->getErrors());exit;
        } 
        }elseif($requestdata['type'] ==  'edit'){
            $modelExp = StaffworkexpTbl::find()->where('staffworkexp_pk = '.$requestdata['data']['staffworkexp_pk'])->one();
            $modelExp->sexp_staffinforepo_fk = $requestdata['data']['staffrepopk'];
            $modelExp->sexp_employername = $requestdata['data']['oragn_name'];
            if(!empty($requestdata['data']['date_join'])){
                $modelExp->sexp_doj = $requestdata['data']['date_join'];
            }
            $curr_work=2;
            if(!empty($requestdata['data']['curr_work'])){
                $curr_work = $requestdata['data']['curr_work'];
            }
            $modelExp->sexp_currentlyworking = $curr_work;
            if($curr_work == 2){
            $modelExp->sexp_eod = $requestdata['data']['workdate'];
            }else{
                $modelExp->sexp_eod = '';
            }
            $modelExp->sexp_opalcountrymst_fk = $requestdata['data']['employ_country'];
            $modelExp->sexp_opalstatemst_fk = $requestdata['data']['employ_state'];
            $modelExp->sexp_opalcitymst_fk = $requestdata['data']['employ_city'];
            $modelExp->sexp_designation = $requestdata['data']['designat'];
            $modelExp->sexp_profdocupload = $requestdata['data']['work_files'];
            $modelExp->sexp_createdon = date("Y-m-d H:i:s");
            $modelExp->sexp_createdby =  $userPk;
    
            if($modelExp->save()){
                return $modelExp->staffworkexp_pk;
            }else{
               var_dump($modelExp->getErrors());exit;
            } 
    
            }  
  }
// public function actionSavestaffedu(){
//     $request_body = file_get_contents('php://input');
//     $requestdata = json_decode($request_body, true);
//     $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
//     $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
// // print_r( date("Y-m-d", strtotime($requestdata['data']['year_join'])));exit;
//     if($requestdata['type'] ==  'new'){
//         $modelAcc = new StaffacademicsTbl();
//         $modelAcc->sacd_staffinforepo_fk = $requestdata['data']['staffrepopk'];
//         $modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata['data']['year_join']));
//         $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata['data']['year_pass']));
//         $modelAcc->sacd_institutename = $requestdata['data']['institute_name'];
//         $modelAcc->sacd_opalcountrymst_fk = $requestdata['data']['institue_country'];
//         $modelAcc->sacd_opalstatemst_fk = $requestdata['data']['inst_state'];
//         $modelAcc->sacd_opalcitymst_fk = $requestdata['data']['inst_city'];
//         $modelAcc->sacd_edulevel = $requestdata['data']['edut_level'];
//         $modelAcc->sacd_degorcert = $requestdata['data']['degree_cert'];
//         $modelAcc->sacd_grade = $requestdata['data']['gpa_grade'];
//         $modelAcc->sacd_createdon = date("Y-m-d H:i:s");
//         $modelAcc->sacd_createdby =   $userPk;
//         if($modelAcc->save()){
//             return true;
//         }else{
//             var_dump($modelAcc->getErrors());exit;
//         }
//     }elseif($requestdata['type'] ==  'edit'){
//         $modelAcc =  StaffacademicsTbl::find()->where('staffacademics_pk = '.$requestdata['data']['staffacademics_pk'])->one();
//         $modelAcc->sacd_staffinforepo_fk = $requestdata['data']['staffrepopk'];
//         $modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata['data']['year_join']));
//         $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata['data']['year_pass']));
//         $modelAcc->sacd_institutename = $requestdata['data']['institute_name'];
//         $modelAcc->sacd_opalcountrymst_fk = $requestdata['data']['institue_country'];
//         $modelAcc->sacd_opalstatemst_fk = $requestdata['data']['inst_state'];
//         $modelAcc->sacd_opalcitymst_fk = $requestdata['data']['inst_city'];
//         $modelAcc->sacd_edulevel = $requestdata['data']['edut_level'];
//         $modelAcc->sacd_degorcert = $requestdata['data']['degree_cert'];
//         $modelAcc->sacd_grade = $requestdata['data']['gpa_grade'];
//         $modelAcc->sacd_createdon = date("Y-m-d H:i:s");
//         $modelAcc->sacd_createdby =   $userPk;
//         if($modelAcc->save()){
//             return true;
//         }else{
//             var_dump($modelAcc->getErrors());exit;
//         }
//     }
      
// }
// public function actionSavestaffwork(){
//     $request_body = file_get_contents('php://input');
//     $requestdata = json_decode($request_body, true);
//     $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
//     $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
//     if($requestdata['type'] ==  'new'){
//     $modelExp = new StaffworkexpTbl();
//     $modelExp->sexp_staffinforepo_fk = $requestdata['data']['staffrepopk'];
//     $modelExp->sexp_employername = $requestdata['data']['oragn_name'];
//     $modelExp->sexp_doj = date("Y-m-d", strtotime($requestdata['data']['date_join']));
//     $curr_work=2;
//     if(!empty($requestdata['data']['curr_work']) || $requestdata['data']['curr_work'] == true){
//         $curr_work = 1;
//     }
//     // echo $curr_work;exit;
//     $modelExp->sexp_currentlyworking = $curr_work;
//     if($requestdata['data']['curr_work']==false){
//     $modelExp->sexp_eod = date("Y-m-d", strtotime($requestdata['data']['workdate']));
//     }
//     $modelExp->sexp_opalcountrymst_fk = $requestdata['data']['employ_country'];
//     $modelExp->sexp_opalstatemst_fk = $requestdata['data']['employ_state'];
//     $modelExp->sexp_opalcitymst_fk = $requestdata['data']['employ_city'];
//     $modelExp->sexp_designation = $requestdata['data']['designat'];
//     $modelExp->sexp_createdon = date("Y-m-d H:i:s");
//     $modelExp->sexp_createdby =  $userPk;

//     if($modelExp->save()){
//         return $modelExp->staffworkexp_pk;
//     }else{
//        var_dump($modelExp->getErrors());exit;
//     } 
//     }elseif($requestdata['type'] ==  'edit'){
//         $modelExp = StaffworkexpTbl::find()->where('staffworkexp_pk = '.$requestdata['data']['staffworkexp_pk'])->one();
//         $modelExp->sexp_staffinforepo_fk = $requestdata['data']['staffrepopk'];
//         $modelExp->sexp_employername = $requestdata['data']['oragn_name'];
//         $modelExp->sexp_doj = date("Y-m-d", strtotime($requestdata['data']['date_join']));
//         $curr_work=2;
//         if(!empty($requestdata['data']['curr_work'])){
//             $curr_work = $requestdata['data']['curr_work'];
//         }
//         $modelExp->sexp_currentlyworking = $curr_work;
//         if($curr_work == 2){
//         $modelExp->sexp_eod = date("Y-m-d", strtotime($requestdata['data']['workdate']));
//         }else{
//             $modelExp->sexp_eod = '';
//         }
//         $modelExp->sexp_opalcountrymst_fk = $requestdata['data']['employ_country'];
//         $modelExp->sexp_opalstatemst_fk = $requestdata['data']['employ_state'];
//         $modelExp->sexp_opalcitymst_fk = $requestdata['data']['employ_city'];
//         $modelExp->sexp_designation = $requestdata['data']['designat'];
//         $modelExp->sexp_createdon = date("Y-m-d H:i:s");
//         $modelExp->sexp_createdby =  $userPk;

//         if($modelExp->save()){
//             return $modelExp->staffworkexp_pk;
//         }else{
//            var_dump($modelExp->getErrors());exit;
//         } 

//         }  
// }
  public function actionGetstaffdata(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);
    $stafftmp =  AppstaffinfotmpTbl::find()->where('appostaffinfotmp_pk = '.$requestdata['pk'])->asArray()->one();

    $staffloc = AppstafflocationtmpTbl::find()->where('aslt_appostaffinfotmp_fk = '.$requestdata['pk'])->asArray()->all();

    $staffschedule = AppstaffscheddtlsTbl::find()->where('assd_appstaffinfotmp_fk = '.$requestdata['pk'])->asArray()->all();
	
  

    $scheduleinfo = [];
    foreach ($staffschedule as $key => $data) {
        $dateExists = false;
        foreach ($scheduleinfo as $schedule) {
            if ($schedule['selecteddate'] == $data['assd_date']) {
                $dateExists = true;
                break;
            }
        }
    
        if (!$dateExists) {
            array_push($scheduleinfo, ['selecteddate' => $data['assd_date'], 'schedule' => $data['assd_dayschedule'], 'subarr' => []]);
            $index = array_search($data['assd_date'], array_column($scheduleinfo, 'selecteddate'));
            if(!empty($data['assd_endtime']) && !empty($data['assd_endtime'])){
            $datezonest = DateTime::createFromFormat('Y-n-j G:i:s', $data['assd_starttime'], new DateTimeZone('UTC'));
            $datezoneed = DateTime::createFromFormat('Y-n-j G:i:s', $data['assd_endtime'], new DateTimeZone('UTC'));
            $statformat = $datezonest->format('Y-m-d\TH:i:s.v\Z');
            $endformat = $datezoneed->format('Y-m-d\TH:i:s.v\Z');
            }
            array_push($scheduleinfo[$index]['subarr'], ['sstarttime' =>date("H:i", strtotime($data['assd_starttime'])),'sstarttimeZone'=>$statformat, 'sendtime' =>date("H:i", strtotime( $data['assd_endtime'])),'sendtimeZone'=>$endformat]);
     
        } else {
            // Date already exists in the schedule, add the start and end time
            $index = array_search($data['assd_date'], array_column($scheduleinfo, 'selecteddate'));
            if(!empty($data['assd_endtime']) && !empty($data['assd_endtime'])){
            $datezonest = DateTime::createFromFormat('Y-n-j G:i:s', $data['assd_starttime'], new DateTimeZone('UTC'));
            $datezoneed = DateTime::createFromFormat('Y-n-j G:i:s', $data['assd_endtime'], new DateTimeZone('UTC'));
            $statformat = $datezonest->format('Y-m-d\TH:i:s.v\Z');
            $endformat = $datezoneed->format('Y-m-d\TH:i:s.v\Z');
            }
            array_push($scheduleinfo[$index]['subarr'], ['sstarttime' =>date("H:i", strtotime($data['assd_starttime'])),'sstarttimeZone'=>$statformat, 'sendtime' =>date("H:i", strtotime( $data['assd_endtime'])),'sendtimeZone'=>$endformat]);
         
        
        }
    }



        $role =explode(',',$stafftmp['appsit_roleforcourse']);
        $stafftmp['appsit_roleforcourse1'] = $role;
        $lang =explode(',',$stafftmp['appsit_language']);
        $stafftmp['appsit_language1'] = $lang;
        $subcat =explode(',',$stafftmp['appsit_appcoursetrnstmp_fk']);
        $stafftmp['appsit_appcoursetrnstmp_fk1'] = $subcat;
        $mainrole =explode(',',$stafftmp['appsit_mainrole']);
        $stafftmp['appsit_mainrole1'] = $mainrole;
  
    // print_r($stafftmp);exit;

    foreach($staffloc as $key => $data){

        $arr = explode(',',$data['aslt_opalcitymst_fk']);
        $staffloc[$key]['aslt_opalcitymst'] =  $arr;
     
    }


    return['stafftmp'=>$stafftmp,'staffloc'=>$staffloc,'staffschedule'=>$scheduleinfo];
  }
  public function actionStafffinalsave(){
    $request_body = file_get_contents('php://input');
    $requestdatas = json_decode($request_body, true);
    $requestdata = $requestdatas['data'];
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $appinstituetmp = AppinstinfomainTbl::find()->where('appinstinfomain_pk = '.$requestdata['branchpk'])->asArray()->one();
    $date = date("Y-m-d H:i:s");
    if($requestdatas['type'] == 'new'){
        $model = new AppstaffinfotmpTbl();
        $model->appsit_opalmemberregmst_fk = $regPk;
        $model->appsit_applicationdtlstmp_fk = $requestdata['referencek'];
       $model->appsit_staffinforepo_fk =$requestdata['staffrepopk'];
       $model->appsit_appinstinfotmp_fk = $appinstituetmp['appiim_appinstinfotmp_fk']?$appinstituetmp['appiim_appinstinfotmp_fk']:$requestdata['branchpk'];
       $model->appsit_appcoursetrnstmp_fk = implode(',', $requestdata['courseselectForm']['select_coursubcate']);
       $model->appsit_mainrole =  implode(',', $requestdata['repo']['role']);
       $model->appsit_jobtitle = $requestdata['repo']['job_title'];
       $model->appsit_contracttype = $requestdata['repo']['cont_type'];
       $model->appsit_roleforcourse = implode(',',$requestdata['courseselectForm']['rolefor_cour']);
       $model->appsit_emailid =  $requestdata['repo']['email_id'];
       $model->appsit_language = implode(',', $requestdata['courseselectForm']['selectlanguage']);
       $model->appsit_createdon =  $date;
       $model->appsit_createdby = $userPk;
       $model->appsit_status = 1;
       if(!$model->save()){
        var_dump($model->getErrors());exit;
        }

      $cv = self::cvGeneration($requestdata['staffrepopk']);
    //  $tmp = array ();

    //  foreach ($requestdata['addressform']['Address'] as $row) {
    //      if (!in_array($row,$tmp)) array_push($tmp,$row);
    //  }
    $mergedArray = [];
    foreach ($requestdata['addressform']['Address'] as $element) {
        $governate = $element['governate'];
        $wilayat = $element['wilayat'];
    
        if (!isset($mergedArray[$governate])) {
            $mergedArray[$governate] = ['governate' => $governate, 'wilayat' => []];
        }
    
        $mergedArray[$governate]['wilayat'] = array_merge($mergedArray[$governate]['wilayat'], $wilayat);
    }
    
    $mergedArray = array_values($mergedArray);
   
     if(!empty($mergedArray[0]['governate'])){
        foreach($mergedArray as $address){

        $modelloc = new AppstafflocationtmpTbl();
        $modelloc->aslt_applicationdtlstmp_fk = $requestdata['referencek'];
        $modelloc->aslt_appostaffinfotmp_fk = $model->appostaffinfotmp_pk;
        $modelloc->aslt_opalstatemst_fk = $address['governate'];
        $modelloc->aslt_opalcitymst_fk =  implode(',',$address['wilayat']);
        $modelloc->aslt_status =2;
        $modelloc->aslt_staffstatus =1;
        $modelloc->aslt_createdon =  $date;
        $modelloc->aslt_createdby = $userPk;
        if(!$modelloc->save()){
                var_dump($modelloc->getErrors());exit;
                }
        }
    }
        $repo =  StaffinforepoTbl::find()->where('staffinforepo_pk = '.$requestdata['staffrepopk'])->one();
        $repo->sir_dob = $requestdata['repo']['date_birth'];
        // $repo->sir_dob =  date('Y-m-d', strtotime($requestdata['repo']['date_birth'] . ' +1 day'));
        $repo->sir_moheridoc = $requestdata['courseselectForm']['moheri_upload'];
        $repo->sir_name_ar =$requestdata['repo']['staffarab'];

        if(!$repo->save()){
            var_dump($repo->getErrors());exit;
        }
        // foreach($requestdata['calenderdata'] as $data){
        //     if(!empty($data['subarr'])){
        //     foreach($data['subarr'] as $subrr){
        //     $modelcal = new AppstaffscheddtlsTbl();
        //     $modelcal->assd_opalmemberregmst_fk = $regPk;
        //     $modelcal->assd_appstaffinfotmp_fk =  $model->appostaffinfotmp_pk;
        //     $modelcal->assd_date = $data['date'];
        //     $modelcal->assd_dayschedule =$data['schedule'];
        //     $date = $data['date'];
        //     $fromtime =  $subrr['sstarttime'];
        //     $totime = $subrr['sendtime'];
        //     if($data['schedule'] == 64){                
        //         $modelcal->assd_starttime= date('Y-m-d H:i:s', strtotime("$date $fromtime"));
        //         $modelcal->assd_endtime = date('Y-m-d H:i:s', strtotime("$date $totime")); 
        //     }
        //     $modelcal->assd_status = 1;
        //     $modelcal->assd_createdon =  $date;
        //     $modelcal->assd_createdby =  $userPk;

        //     if(!$modelcal->save()){
        //         var_dump($modelcal->getErrors());exit;
        //         }  
        //     } 
        //     }else{
        //         $modelcal = new AppstaffscheddtlsTbl();
        //         $modelcal->assd_opalmemberregmst_fk = $regPk;
        //         $modelcal->assd_appstaffinfotmp_fk =  $model->appostaffinfotmp_pk;
        //         $modelcal->assd_date = $data['date'];
        //         $modelcal->assd_dayschedule =$data['schedule'];
        //         $modelcal->assd_status = 1;
        //         $modelcal->assd_createdon =  $date;
        //         $modelcal->assd_createdby =  $userPk;    
        //         if(!$modelcal->save()){
        //             var_dump($modelcal->getErrors());exit;
        //             }  
        //     }                
        // }
        return 'added';
    }elseif($requestdatas['type'] == 'edit'){

     
        $appliactiondata = ApplicationdtlstmpTbl::find()
        ->select(['*'])
        ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->where('applicationdtlstmp_pk = '.$requestdata['referencek'])->asArray()->one();

         $comptcard = AppstaffinfotmpTbl::find()
                    ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' 
                    when appsit_iscarddetails = 1 then '4'
                    when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
                    ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
                    ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
                    if($appliactiondata['appdt_projectmst_fk'] == 2){
                        $comptcard->where(['scch_standardcoursemst_fk'=>$appliactiondata['appcdt_standardcoursemst_fk']]);
                    }else{
                        $comptcard->where(['scch_appoffercoursemain_fk'=>$appliactiondata['appcdt_appoffercoursemain_fk']]);

                    }
                    $comptcard->andWhere(['appostaffinfotmp_pk'=>$requestdata['appostaffinfotmp_pk']]);
                    $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
                    $compt =  $comptcard->asArray()->one();
                    $comptancycard = empty($compt['competcard'])?'1':$compt['competcard'];
                   
        $model =  AppstaffinfotmpTbl::find()->where('appostaffinfotmp_pk = '.$requestdata['appostaffinfotmp_pk'])->one();
                //1 -new ,2-active 3-expired 4-postforupgrade
              
                // if($staffinfo['competcard'] == 2 || $staffinfo['competcard'] == 3){
                if($requestdata['applicationtype'] == 'update' || $requestdata['applicationtype'] == 'renew'){
                    $role_new = $requestdata['courseselectForm']['rolefor_cour'];
                    $role_curr = explode(",",$model->appsit_roleforcourse);
                    $lang_new = $requestdata['courseselectForm']['selectlanguage'];
                    $lang_curr =  explode(",",$model->appsit_language);
                    $cour_new = $requestdata['courseselectForm']['select_coursubcate'];
                    $cour_curr = explode(",",$model->appsit_appcoursetrnstmp_fk);
                    $diff_role = array_diff($role_new, $role_curr);
                    $diff_lang = array_diff($lang_new, $lang_curr);
                    $diff_cour = array_diff($cour_new, $cour_curr);
                    if (!empty($diff_role) || !empty($diff_lang) || !empty($diff_cour)) {
                        $model->appsit_iscarddetails = 1;
                    }else{
                        if( $comptancycard == 3){
                            $model->appsit_iscarddetails = 3;
                        }
                    }
                }
     
        $model->appsit_opalmemberregmst_fk = $regPk;
        $model->appsit_applicationdtlstmp_fk = $requestdata['referencek'];
        $model->appsit_staffinforepo_fk =$requestdata['staffrepopk'];
        if(!empty($requestdata['courseselectForm']['select_coursubcate'])){
        $model->appsit_appcoursetrnstmp_fk = implode(',', $requestdata['courseselectForm']['select_coursubcate']);
        }
        
        $model->appsit_mainrole =  implode(',', $requestdata['repo']['role']);
        $model->appsit_jobtitle = $requestdata['repo']['job_title'];
        $model->appsit_contracttype = $requestdata['repo']['cont_type'];
        if(!empty($requestdata['courseselectForm']['rolefor_cour'])){
        $model->appsit_roleforcourse = implode(',',$requestdata['courseselectForm']['rolefor_cour']);
        }
        $model->appsit_emailid =  $requestdata['repo']['email_id'];
        if(!empty($requestdata['courseselectForm']['selectlanguage'])){
        $model->appsit_language = implode(',', $requestdata['courseselectForm']['selectlanguage']);
        }
        // $model->appsit_createdon =  $date;
        // $model->appsit_createdby = $userPk;
        $model->appsit_updatedon =  $date;
        $model->appsit_updatedby = $userPk;
       if($requestdata['applicationtype'] == 'update' || $requestdata['applicationtype'] == 'renew'){
        $model->appsit_status = 2 ;
       }else{
        $model->appsit_status = 1 ;
       } 

       if(!$model->save()){
        var_dump($model->getErrors());exit;
        }
        $repo =  StaffinforepoTbl::find()->where('staffinforepo_pk = '.$requestdata['staffrepopk'])->one();
        $repo->sir_moheridoc = $requestdata['courseselectForm']['moheri_upload'];
        $repo->sir_opalmemberregmst_fk = $regPk;
        $repo->sir_name_ar =$requestdata['repo']['staffarab'];
        if($repo->sir_type == 2){
            $repo->sir_type = 3;
        }
        $repo->sir_emailid = $requestdata['repo']['email_id'];
        $repo->sir_dob = $requestdata['repo']['date_birth'];
        // $repo->sir_dob = (new DateTime($requestdata['repo']['date_birth']))->modify('+1 day')->format('Y-m-d');

        $repo->sir_gender = $requestdata['repo']['gend_er'];
        $repo->sir_nationality = $requestdata['repo']['national'];
        $repo->sir_addrline1 = $requestdata['repo']['house'];
        $repo->sir_addrline2 = $requestdata['repo']['houseadd'];
        $repo->sir_createdon = $date;
        $repo->sir_createdby =   $userPk;
        if(!$repo->save()){
            var_dump($repo->getErrors());exit;
            }
            // $tmp = array ();

            // foreach ($requestdata['addressform']['Address'] as $row) {
            //     if (!in_array($row,$tmp)) array_push($tmp,$row);
            // } 
            $mergedArray = [];
            foreach ($requestdata['addressform']['Address'] as $element) {
                $governate = $element['governate'];
                $wilayat = $element['wilayat'];
            
                if (!isset($mergedArray[$governate])) {
                    $mergedArray[$governate] = ['governate' => $governate, 'wilayat' => []];
                }
            
                $mergedArray[$governate]['wilayat'] = array_merge($mergedArray[$governate]['wilayat'], $wilayat);
            }
            
            $mergedArray = array_values($mergedArray); // Optional: Re-index the array numerically
            

            if(!empty($mergedArray[0]['governate'])){
            foreach($mergedArray as $address){    
                
            $modelloc =  AppstafflocationtmpTbl::find()->where('aslt_appostaffinfotmp_fk =  '. $model->appostaffinfotmp_pk.' and  aslt_applicationdtlstmp_fk = '.$requestdata['referencek'].' and aslt_opalstatemst_fk = '. $address['governate'])->one();
        
            if(!empty($modelloc)){
            $modelloc->aslt_applicationdtlstmp_fk = $requestdata['referencek'];
            $modelloc->aslt_appostaffinfotmp_fk = $model->appostaffinfotmp_pk;
            $modelloc->aslt_opalstatemst_fk = $address['governate'];
            $old =  explode(",",$modelloc->aslt_opalcitymst_fk);
            $new = $address['wilayat'];
            $extraElements = [];

                foreach ($new as $element) {
                    if (!in_array($element, $old)) {
                        $extraElements[] = $element;
                    }
                }
            $removed_ornot= array_diff($new,$old);
            if (!empty($extraValues)) {
            $string = implode(',', $address['wilayat']).','.$modelloc->aslt_opalcitymst_fk;
            $numbers = explode(",", $string);
            $uniqueNumbers = array_unique($numbers);
            $resultString = implode(",", $uniqueNumbers);
            }else{
                $resultString =implode(',', $address['wilayat']);
            }
            $modelloc->aslt_opalcitymst_fk =  $resultString;
            if (count($extraElements) > 0) {
                $modelloc->aslt_staffstatus = 2;
            }
            // $modelloc->aslt_staffstatus = 1;
            // $modelloc->aslt_status =2;
            $modelloc->aslt_createdon =  $date;
            $modelloc->aslt_createdby = $userPk;
            if(!$modelloc->save()){
                    var_dump($modelloc->getErrors());exit;
                    }

                }else{
                
                $modelloc = new AppstafflocationtmpTbl();
                $modelloc->aslt_applicationdtlstmp_fk = $requestdata['referencek'];
                $modelloc->aslt_appostaffinfotmp_fk = $model->appostaffinfotmp_pk;
                $modelloc->aslt_opalstatemst_fk = $address['governate'];
                $modelloc->aslt_opalcitymst_fk =  implode(',', $address['wilayat']);
                $modelloc->aslt_staffstatus = 1;
                $modelloc->aslt_status =2;
                $modelloc->aslt_createdon =  $date;
                $modelloc->aslt_createdby = $userPk;
                if(!$modelloc->save()){
                        var_dump($modelloc->getErrors());exit;
                        }
              
              }

             
              }
              $allrec =  AppstafflocationtmpTbl::find()->where('aslt_appostaffinfotmp_fk = '.$model->appostaffinfotmp_pk)->asArray()->all();
             
              $governates = array_column($mergedArray, 'governate');
              $missingAppstaffLocationtmp = [];
              
              foreach ($allrec as $item) {
                  if (!in_array($item['aslt_opalstatemst_fk'], $governates)) {
                      $missingAppstaffLocationtmp[] = $item['appstaffLocationtmp_pk'];
                  }
              }
              
          
             \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
             AppstafflocationtmpTbl::deleteAll(['IN', 'appstaffLocationtmp_pk', $missingAppstaffLocationtmp]);
             \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
             $cv = self::cvGeneration($requestdata['staffrepopk']);             
             
        }
            return 'edited';

    }
 
}

public function cvGeneration($data){
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    
    $cv_path = "cv_".$regPk."_".$data.".pdf";
    $stfRepo = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk' => $data])->asArray()->one();

    $stfEdu = \app\models\StaffacademicsTbl::find()->where(['sacd_staffinforepo_fk' => $data])->asArray()->all();
    
    $stfEdu = \app\models\StaffacademicsTbl::find()
            ->select(['*'])
            ->leftJoin('referencemst_tbl ref','ref.referencemst_pk = staffacademics_tbl.sacd_edulevel')
            ->where(['sacd_staffinforepo_fk' => $data])
            ->asArray()
            ->all();

    $stfWork = \app\models\StaffworkexpTbl::find()->where(['sexp_staffinforepo_fk' => $data])->asArray()->all();
    //echo '<pre>';print_r($stfWork);exit;
    $path = "../api/web/cv/$regPk/";

    if(!is_dir($path)){
        mkdir($path, 0777, true);
    }             
            
    $baseUrl = \Yii::$app->params['baseUrl'];

    $name=$stfRepo['sir_name_en'];
    $namear=$stfRepo['sir_name_ar'];
    $number=$stfRepo['sir_idnumber'];
    $mail=$stfRepo['sir_emailid'];
    
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 50,
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_bottom' => 5,
    'autoPageBreak' => true,
    'default_font' => 'segoeregular',
    //'format' => 'A3'
    'format' => [250, 330]]);
    $mpdf->shrink_tables_to_fit = 1;		
    //$mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png',.1, 1, 200, '', '', '', true, true);
    $mpdf->SetWatermarkImage($baseUrl.'assets/images/opalimages/opalpdflogo.png',.1, 1, 100, '', '', '', true, true);
    //$mpdf->SetWatermarkImage('http://192.168.1.27:4200/assets/images/jsrs-logo-icon.png');
    $mpdf->watermarkImageAlpha = .2;
    $mpdf->showWatermarkImage = true;
    $mpdf->SetHTMLHeader('<div style=" background-color: #F6FAFF;padding: 5px 5px">
                        <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 700;margin:5px 10px 5px 10px"> '.$name.'</h4>
                        <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 700;margin:5px 10px 5px 10px"> '.$namear.'</h4>
                        <div class="contactinfo">
                            <div class="contdetails fs-14 border" style="border-left: 3px solid #0C4B9A;  background-repeat: no-repeat; ">
                                <p style="padding-left:20px;margin:5px 10px 5px 10px"> <span class="minwidth" style="margin-left: 30px;color: #848484;font-size: 16px;">Civil number </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="details" style="color: #262626;font-size: 16px;">'.$number.'</span></p>
                                <p style="padding-left:20px;margin:5px 10px 5px 10px"> <span class="minwidth" style="margin-left: 30px;color: #848484;font-size: 16px;margin-right: 30px;">Email</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="details" style="color: #262626;font-size: 16px;">'.$mail.'</span></p>
                            </div>

                        </div>
                    </div>');
    $mpdf->WriteHTML($this->renderPartial('../../../al/views/afterlogin/cv',['stfRepo'=>$stfRepo, 'stfEdu'=>$stfEdu, 'stfWork'=>$stfWork]));
    $mpdf->Output("../api/web/cv/$regPk/$cv_path",'F');

    $pdfPath = $regPk."/".$cv_path;
    
    $stfRepoModel = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk' => $data])->one();
    $stfRepoModel->sir_staffcv=$pdfPath;
    if($stfRepoModel->save()){
            
    }else{
        echo "<pre>";var_dump($stfRepoModel->getErrors());exit;
    }
    
}

public function actionGetpaymentinfo(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $total=0;
    $data = ApppymtdtlstmpTbl::find()
     ->select(['apppymtdtlstmp_tbl.*','apppytminvoicedtls_tbl.*','applicationdtlstmp_tbl.*',
     'omrm_companyname_en','omrm_companyname_ar','omrm_tpname_en','omrm_tpname_ar',
     'appiit_officetype','omrm_cmplogo','appiit_branchname_en','appiit_branchname_ar','omrm_branch_ar','omrm_branch_en'])
     ->leftJoin('apppytminvoicedtls_tbl','apppytminvoicedtls_pk = apppdt_apppytminvoicedtls_fk')
     ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = apppdt_applicationdtlstmp_fk')
     ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
     ->leftJoin('appinstinfotmp_tbl','applicationdtlstmp_pk = appiit_applicationdtlstmp_fk')
     ->where('apppdt_applicationdtlstmp_fk = '.$requestdata['data'])
     ->orderBy(['apppymtdtlstmp_pk' => SORT_DESC])
     ->asArray()->one();
    if($data['appdt_projectmst_fk']==1){
        $total =$data['apppdt_amount']+$data['apppdt_vatchrgs']+$data['apppdt_addchrgs'];        
    }else{
        $total =$data['apppdt_amount']+$data['apppdt_vatchrgs']+$data['apppdt_addchrgs']+$data['apppdt_staffevafee'];    
    }
     if($data['apppdt_currency']==1){
        $total = number_format($total,3, '.', '');
        $data['apppdt_amount'] = number_format($data['apppdt_amount'],3, '.', '');
        $data['apid_staffevalfee'] = ($data['apppdt_staffevafee']>0)? number_format($data['apppdt_staffevafee'],3, '.', ''): '0';
        $data['apppdt_vatchrgs'] = number_format($data['apppdt_vatchrgs'],3, '.', '');
     }else{
        $total = number_format($total,2, '.', '');
        $data['apppdt_amount'] = number_format($data['apppdt_amount'],2, '.', '');
        $data['apid_staffevalfee'] = ($data['apppdt_staffevafee']>0)? number_format($data['apppdt_staffevafee'],2, '.', ''): '0';
        $data['apppdt_vatchrgs'] = number_format($data['apppdt_vatchrgs'],2, '.', '');
     }
     $data['complogo'] = (!empty($data['omrm_cmplogo']))? \api\components\Drive::generateUrl($data['omrm_cmplogo'],$regPk,$userPk): null;
     $data['total_amount'] = $total;
     $proof=$filetype='';
     if($data['apppdt_status']==2){
        $proof = \api\components\Drive::generateUrl($data['apppdt_pymtproof'],$regPk,$userPk);
        $filetype = \api\models\MemcompfiledtlsTbl::getFileTypeByPk($data['apppdt_pymtproof']);
     }
     $data['proofdoc'] = $proof;    
     $data['filetype'] = $filetype;    
     $record=[];
     $record['total']=$total;
    return ['payment' =>  $data,'record'=> $record];
}
public function actionGetprojectinfo(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);    
    $data = ApplicationdtlstmpTbl::getProjectInfo($requestdata);
    return ['data' =>  $data];
}

public function actionSaveonlinepayment(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    
    $appdtpk =  \api\components\Security::decrypt($requestdata['appdtpk']);
    
    //$propk =  Security::decrypt($requestdata['propk']);
    //$apptypests =  Security::decrypt($requestdata['apptype']);
    $pymtres =  $requestdata['pymtres'];
    $pymttrkno =  $requestdata['pymttrkno'];
    $proof=$filetype='';
    //echo '<pre>';print_r($appdtpk);exit;
    if($pymtres == 'CAPTURED' || $pymtres == 'REGISTERED'){
        $modelRes =  ApppymtdtlstmpTbl::find()->where('apppymtdtlstmp_pk = '.$appdtpk)->one();
        
        $model =  ApppymtdtlstmpTbl::find()->where('apppymtdtlstmp_pk = '.$appdtpk)->one();
        $model->apppdt_paymenttype = 1;
        $model->apppdt_dateofpymt = date("Y-m-d H:i:s");
        $model->apppdt_updatedon = date("Y-m-d H:i:s");
        $model->apppdt_updatedby = $userPk;
        $model->apppdt_status = 2;

        $invoicemodel =  OpalInvoiceTbl::find()->where('apppytminvoicedtls_pk = '.$modelRes->apppdt_apppytminvoicedtls_fk)->one();
        $invoicemodel->apid_paymenttype = 1;
        $invoicemodel->apid_dateofpymt = date("Y-m-d H:i:s");
        $invoicemodel->apid_invoicestatus = 2;
        $proof=$filetype='';

        if($model->save() && $invoicemodel->save()){
            $modelmain = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '.$modelRes->apppdt_applicationdtlstmp_fk)->one();
            $modelmain->appdt_status = 6;
            $modelmain->appdt_updatedby = $userPk;
            $modelmain->appdt_updatedon = date("Y-m-d H:i:s");
            if(!$modelmain->save()){
                print_r($modelmain->getErrors());
                exit;   
            }
            $modelinv = OpalInvoiceTbl::find()->where('apid_applicationdtlstmp_fk = '.$modelmain->applicationdtlstmp_pk)->one();
            if(!empty($modelinv)){
                $modelinv->apid_invoicestatus = 2;
                if(!$modelinv->save()){
                    print_r($modelinv->getErrors());
                    exit;   
                }
            }
            if($modelmain->appdt_apptype == 1){
                $apptype = 1;
            }else if($modelmain->appdt_apptype == 2){
                $apptype = 4;
            }else{
                if($modelmain->appdt_projectmst_fk ==1){
                    $apptype = 2;
                }else{
                    $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $modelmain->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                    $apptype = $updatemodel->aah_formstatus;
                }
            }
            $info = SiteAudit::getApprovalHdrInfo($modelmain->appdt_projectmst_fk, $apptype, 6);
            
            $modelhdr = new AppapprovalhdrTbl;
            $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
            $modelhdr->aah_projapprovalworkflowdtls_fk = $info['projapprovalworkflowdtls_pk'];
            $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
            $modelhdr->aah_applicationdtlstmp_fk = $modelmain->applicationdtlstmp_pk;
            if($modelmain->appdt_apptype == 1){
                $modelhdr->aah_formstatus = 1;
            }else if($modelmain->appdt_apptype == 2){
                $modelhdr->aah_formstatus = 4;
            }else{
                if($modelmain->appdt_projectmst_fk == 1){
                    $modelhdr->aah_formstatus = 2;

                }else{
                    $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $modelmain->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                    $modelhdr->aah_formstatus = $updatemodel->aah_formstatus;

                }
            }
        
            $modelhdr->aah_status = null;
            $modelhdr->save();
            $projPk = ($modelmain->appdt_projectmst_fk==1)? 1: 2;
            //Update history table SP process
            \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                ->bindValue(':p1' , $modelmain->applicationdtlstmp_pk)
                ->bindValue(':p2' , '')
                ->bindValue(':p3' , $projPk)
                ->execute();
            //$proof = \api\components\Drive::generateUrl($model->apppdt_pymtproof,$regPk,$userPk);
            //$filetype = \api\models\MemcompfiledtlsTbl::getFileTypeByPk($model->apppdt_pymtproof);
            //$mail = Course::mailsendforcouresesubmission($modelmain->applicationdtlstmp_pk,'');
        }else{
            print_r($model->getErrors());exit;  
        }
    }else if($pymtres == 'IPAY0100048 - Cancelled'){
        $model =  ApppymtdtlstmpTbl::find()->where('apppymtdtlstmp_pk = '.$appdtpk)->one();
        $model->apppdt_paymenttype = 1;
        $model->apppdt_dateofpymt = date("Y-m-d H:i:s");
        $model->apppdt_updatedon = date("Y-m-d H:i:s");
        $model->apppdt_updatedby = $userPk;
        $model->apppdt_status = 6;
        if($model->save()){
        }else{
            print_r($model->getErrors());exit;  
        }
    }else{
        $model =  ApppymtdtlstmpTbl::find()->where('apppymtdtlstmp_pk = '.$appdtpk)->one();
        $model->apppdt_paymenttype = 1;
        $model->apppdt_dateofpymt = date("Y-m-d H:i:s");
        $model->apppdt_updatedon = date("Y-m-d H:i:s");
        $model->apppdt_updatedby = $userPk;
        $model->apppdt_status = 7;
        if($model->save()){
        }else{
            print_r($model->getErrors());exit;  
        }
    }
    
    $msg['msg'] = ($model) ? 'success' : 'failure';
    $msg['status'] = ($model) ? 200 : 0;
    $msg['data'] = $model;
    $msg['proofdoc'] = $proof;
    $msg['filetype'] = $filetype;
    return $msg;

}

public function actionSavepayment(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
   
    $model =  ApppymtdtlstmpTbl::find()->where('apppymtdtlstmp_pk = '.$requestdata['type']['apppymtdtlstmp_pk'])->one();
    $model->apppdt_paymenttype = 2;
    $model->apppdt_paymentmode = $requestdata['data']['choose_type'];
    $model->apppdt_bankname = $requestdata['data']['bankname'];
    $model->apppdt_dateofpymt = date("Y-m-d", strtotime( $requestdata['data']['paydate']));
    if(empty($requestdata['data']['cheque'])){
        $model->apppdt_offlinerefno = $requestdata['data']['transaction'];
    }else{
        $model->apppdt_offlinerefno = $requestdata['data']['cheque'];
    }
    $model->apppdt_pymtproof = $requestdata['data']['document_upload'][0];

    $model->apppdt_updatedon = date("Y-m-d H:i:s");
    $model->apppdt_updatedby = $userPk;
    $model->apppdt_status = 2;


    $invoicemodel =  OpalInvoiceTbl::find()->where('apppytminvoicedtls_pk = '.$requestdata['type']['apppdt_apppytminvoicedtls_fk'])->one();
    $invoicemodel->apid_paymenttype = 2;
    $invoicemodel->apid_paymentmode = $requestdata['data']['choose_type'];
    $invoicemodel->apid_bankname = $requestdata['data']['bankname'];
    $invoicemodel->apid_dateofpymt = date("Y-m-d", strtotime( $requestdata['data']['paydate']));
    if(empty($requestdata['data']['cheque'])){
        $invoicemodel->apid_offlinerefno = $requestdata['data']['transaction'];
    }else{
        $invoicemodel->apid_offlinerefno = $requestdata['data']['cheque'];
    }
    $invoicemodel->apid_pymtproof = $requestdata['data']['document_upload'][0];

    // $model->apppdt_updatedon = date("Y-m-d H:i:s");
    // $model->apppdt_updatedby = $userPk;
    $invoicemodel->apid_invoicestatus = 2;
    $proof=$filetype='';
    
    if($model->save() && $invoicemodel->save()){
        $modelmain = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '.$requestdata['type']['apppdt_applicationdtlstmp_fk'])->one();
        $apptmpPk = $model['apppdt_applicationdtlstmp_fk'];
        $regPk = $model['apppdt_opalmemberregmst_fk'];      

        $project = $modelmain->appdt_projectmst_fk;
        $appsts = $modelmain->appdt_status;
        $aptype = $modelmain->appdt_apptype;
        
        $finance = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 6 , 'oum_status' => 'A'])
                ->asArray()
                ->all();     
        $id = [];
        $name = [];    
        foreach ($finance as $rowfn) {
           $id = $rowfn['oum_emailid'];
           $name = $rowfn['oum_firstname'];
                if($aptype==1 && $appsts==5 && $project ==1){
                    \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'getPayment'); 
                }      
                if($aptype==1 && $appsts==18 && $project ==1){
                    \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'revergetPayment'); 
                }
        }
        
        $refinance = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 6 , 'oum_status' => 'A'])
                ->asArray()
                ->all();     
        $id = [];
        $name = [];    
        foreach ($refinance as $rerowfn) {
           $id = $rerowfn['oum_emailid'];
           $name = $rerowfn['oum_firstname'];
        
        if($aptype==2 && $appsts==5 && $project ==1){
            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'regetPayment');   
        }
        if($aptype==2 && $appsts==18 && $project ==1){
            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'renrevergetPayment');   
        }
        }
        
        
              if($project==2){ 
        
                $crfinancecommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 1 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 6 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                   
                    $crfinance = $crfinancecommand ->queryAll();  
                        $id = [];
                        $name = [];   
                    foreach ($crfinance as $crrowfn) {
                       $id = $crrowfn['oum_emailid'];
                       $name = $crrowfn['oum_firstname'];

                    if ($project ==2 or $project==3){
                          if($aptype==1 && $appsts==5){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crgetPayment'); 
                          }elseif($aptype==1 && $appsts==18){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crregetPay');   
                          }   
                    }
                    }  
            }
        
        
        if($project==3){
        
        $crfinance = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 6 , 'oum_status' => 'A'])
                ->asArray()
                ->all();     
        $id = [];
        $name = [];    
        foreach ($crfinance as $crrowfn) {
           $id = $crrowfn['oum_emailid'];
           $name = $crrowfn['oum_firstname'];
        
        if ($project ==2 or $project==3){
              if($aptype==1 && $appsts==5){
                \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crgetPayment'); 
              }elseif($aptype==1 && $appsts==18){
                \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'crregetPay');   
              }   
        }
        }
        }
        
        
         if($project==2){ 
        
                $rencrfinancecommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 4 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 6 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                   
                    $rencrfinance = $rencrfinancecommand ->queryAll();  
                        $id = [];
                        $name = [];  
               foreach ($rencrfinance as $rencrrowfn) {
                   $id = $rencrrowfn['oum_emailid'];
                   $name = $rencrrowfn['oum_firstname'];

                if ($project ==2 or $project==3){
                      if($aptype==2 && $appsts==5){
                        \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrgetPayment'); 
                      }elseif($aptype==2 && $appsts==18){
                        \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrregetPay');   
                      }   
                }
                }  
                        
                        
         }
        
           if($project==3){
                $rencrfinance = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                        ->select(['oum_emailid', 'oum_firstname'])
                        ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                        ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                        ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                        ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => [2, 3] , 'pawfd_rolemst_fk' => 6, 'oum_status' => 'A'])
                         ->groupBy(['opalusermst_pk'])
                        ->asArray()
                        ->all();     
                $id = [];
                $name = [];    
                foreach ($rencrfinance as $rencrrowfn) {
                   $id = $rencrrowfn['oum_emailid'];
                   $name = $rencrrowfn['oum_firstname'];

                if ($project ==2 or $project==3){
                      if($aptype==2 && $appsts==5){
                        \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrgetPayment'); 
                      }elseif($aptype==2 && $appsts==18){
                        \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'rencrregetPay');   
                      }   
                }
                }
           }
           
        if($project==2){ 
        
                $updcrfinancecommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 6 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                   
                    $updcrfinance = $updcrfinancecommand ->queryAll();  
                        $id = [];
                        $name = []; 
          foreach ($updcrfinance as $updcrrowfn) {
           $id = $updcrrowfn['oum_emailid'];
           $name = $updcrrowfn['oum_firstname'];
        
            if ($project ==2 or $project==3){
              if($aptype==3 && $appsts==5){
                \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrgetPayment'); 
              }elseif($aptype==3 && $appsts==18){
                \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrregetPay');   
              }   
        }
        }    
                        
                        
                        
        }
           
        if($project==3){
        $updcrfinance = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => [2, 3] , 'pawfd_rolemst_fk' => 6, 'oum_status' => 'A'])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();     
        $id = [];
        $name = [];    
        foreach ($updcrfinance as $updcrrowfn) {
           $id = $updcrrowfn['oum_emailid'];
           $name = $updcrrowfn['oum_firstname'];
        
        if ($project ==2 or $project==3){
              if($aptype==3 && $appsts==5){
              \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrgetPayment'); 
              }elseif($aptype==3 && $appsts==18){
              \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrregetPay');   
              }   
        }
        }
        }
        

        $modelmain->appdt_status = 6;
        $modelmain->appdt_updatedby = $userPk;
        $modelmain->appdt_updatedon = date("Y-m-d H:i:s");
        if(!$modelmain->save()){
            print_r($modelmain->getErrors());
            exit;   
        }
        $modelinv = OpalInvoiceTbl::find()->where('apid_applicationdtlstmp_fk = '.$modelmain->applicationdtlstmp_pk)->one();
        if(!empty($modelinv)){
            $modelinv->apid_invoicestatus = 2;
            if(!$modelinv->save()){
                print_r($modelinv->getErrors());
                exit;   
            }
        }
        if($modelmain->appdt_apptype == 1){
            $apptype = 1;
        }else if($modelmain->appdt_apptype == 2){
            $apptype = 4;
        }else{
            if($modelmain->appdt_projectmst_fk ==1){
                $apptype = 2;
            }else{
                $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $modelmain->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                $apptype = $updatemodel->aah_formstatus;
            }
        }
        $info = SiteAudit::getApprovalHdrInfo($modelmain->appdt_projectmst_fk, $apptype, 6);
        $modelhdr = new AppapprovalhdrTbl;
        $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
        $modelhdr->aah_projapprovalworkflowdtls_fk = $info['projapprovalworkflowdtls_pk'];
        $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
        $modelhdr->aah_applicationdtlstmp_fk = $modelmain->applicationdtlstmp_pk;
        if($modelmain->appdt_apptype == 1){
            $modelhdr->aah_formstatus = 1;
        }else if($modelmain->appdt_apptype == 2){
            $modelhdr->aah_formstatus = 4;
        }else{
            if($modelmain->appdt_projectmst_fk == 1){
                $modelhdr->aah_formstatus = 2;

            }else{
                $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $modelmain->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                $modelhdr->aah_formstatus = $updatemodel->aah_formstatus;

            }
        }
      
        $modelhdr->aah_status = null;
        $modelhdr->save();
        $projPk = ($modelmain->appdt_projectmst_fk==1)? 1: 2;
        //Update history table SP process
        if($modelmain->appdt_projectmst_fk == 4){
            \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
            ->bindValue(':p1' , $modelmain->applicationdtlstmp_pk)
            ->bindValue(':p2' , '')
            ->bindValue(':p3' , $modelmain->appdt_projectmst_fk)
            ->execute();
        }else{
            \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
            ->bindValue(':p1' , $modelmain->applicationdtlstmp_pk)
            ->bindValue(':p2' , '')
            ->bindValue(':p3' , $projPk)
            ->execute();
        }
       
        $proof = \api\components\Drive::generateUrl($model->apppdt_pymtproof,$regPk,$userPk);
        $filetype = \api\models\MemcompfiledtlsTbl::getFileTypeByPk($model->apppdt_pymtproof);
    }else{
        print_r($model->getErrors());
        exit;  
    }
    $msg['msg'] = ($model) ? 'success' : 'failure';
    $msg['status'] = ($model) ? 200 : 0;
    $msg['proofdoc'] = $proof;
    $msg['filetype'] = $filetype;
    return $msg;

}
public function actionOnlinepayment(){
    
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);
    
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    
    $pytmRefNoAndDate = time().'T'.rand(4,1000);
    //$pytmRefNoAndDate = substr(number_format(time() * rand(),0,'',''),0,10);
    //$model = new ApppymtdtlstmpTbl();
    //$model =  ApppymtdtlstmpTbl::find()->where('apppymtdtlstmp_pk = '.$requestdata['type']['apppymtdtlstmp_pk'])->one();
    $model = \app\models\ApppymtdtlstmpTbl::find()
            ->where(['apppymtdtlstmp_pk' => $requestdata['type']['apppymtdtlstmp_pk']])
            ->orderBy(['apppymtdtlstmp_pk' => SORT_DESC])
            ->one();
    
    // $model->apppdt_opalmemberregmst_fk = $requestdata['type']['apppdt_opalmemberregmst_fk'];
    // $model->apppdt_apppytminvoicedtls_fk = $requestdata['type']['apppdt_apppytminvoicedtls_fk'];
    // $model->apppdt_applicationdtlstmp_fk = $requestdata['type']['apppdt_applicationdtlstmp_fk'];
    //ONLY FOR COURSE
    //$model->apppdt_noofstaffeval = $regPk;
    $model->apppdt_paymenttype = 1;
    $model->apppdt_paymentmode = 2;
    $model->apppdt_dateofpymt = date("Y-m-d H:i:s");
    $model->apppdt_orderrefno = $pytmRefNoAndDate; // oredr no here
    //$model->apppdt_transuniqueId = $regPk; // oredr no here
    //$model->apppdt_currency = $requestdata['type']['apppdt_currency']; // currency / 1 omr 2 usd
    //$model->apppdt_amount = $requestdata['type']['apppdt_amount'];
    //$model->apppdt_staffevafee = $requestdata['type']['apppdt_staffevafee']; // only for cour
    //$model->apppdt_addchrgs = '';
    //$model->apppdt_vatchrgs = $requestdata['type']['apppdt_vatchrgs'];
    //$model->apppdt_vatpercent = $requestdata['type']['apppdt_vatpercent'];
    //$model->apppdt_requesttype = $requestdata['type']['apppdt_requesttype']; // Projectmst_pk
    $model->apppdt_opalusermst_fk = $requestdata['type']['apppdt_opalusermst_fk'];
    $model->apppdt_createdon = date("Y-m-d H:i:s");
    $model->apppdt_createdby = $userPk;
    //$model->apppdt_status = 1;

    // Set up payment configuration starts
    $current = \Yii::$app->params['PG']['omannet']['current']; //current environment
    $resourcePath = \Yii::$app->params['PG']['omannet'][$current]['resourcePath'];
    $keystorePath = \Yii::$app->params['PG']['omannet'][$current]['keystorePath'];
    $aliasName = \Yii::$app->params['PG']['omannet'][$current]['aliasName'];
    $action = \Yii::$app->params['PG']['omannet'][$current]['tran_action'];
    $currency = \Yii::$app->params['PG']['omannet'][$current]['tran_currency'];
    $language = \Yii::$app->params['PG']['omannet'][$current]['consumer_language'];
    $receiptURL = \Yii::$app->params['PG']['omannet'][$current]['merchant_receiptURL'];
    $errorURL = \Yii::$app->params['PG']['omannet'][$current]['merchant_receiptURL'];
    $tokenFlag = \Yii::$app->params['PG']['omannet'][$current]['tokenFlag'];
    $paymenttoken = \Yii::$app->params['PG']['omannet'][$current]['token_action'];

    $payment_url = \Yii::$app->params['PG']['omannet'][$current]['payment_url'];

    $data=$resourcePath.'|'.$keystorePath.'|'.$aliasName.'|'.$action.'|'.$currency.'|'.$language.'|'.$receiptURL.'|'.$errorURL.'|'.$tokenFlag.'|'.$paymenttoken.'|'.$payment_url.'|'.$pytmRefNoAndDate;
    
    $paydata = explode('|', $data);
     
    $py_arr = [
        'resourcePath' => $paydata[0],
        'keystorePath' => $paydata[1],
        'aliasName' => $paydata[2],
        'action' => $paydata[3],
        'currency' => $paydata[4],
        'language' => $paydata[5],
        'receiptURL' => $paydata[6],
        'errorURL' => $paydata[7],
        'tokenFlag' => $paydata[8],
        'paymenttoken' => $paydata[9],
        'payment_url' => $paydata[10],
        'trackId' => $paydata[11],
        'apppymtdtlstmp_pk' => $requestdata['type']['apppymtdtlstmp_pk'],
        'appdt_projectmst_fk' => $requestdata['type']['appdt_projectmst_fk'],
        'appdt_apptype' =>  $requestdata['type']['appdt_apptype'],
        'appdt_status' =>  $requestdata['type']['appdt_status'],
        'env_type' =>  $current
    ];

    //$result = $this->convertDataforSP($py_arr, 'E');

    // Set up payment configuration ends

    if($model->save()){
        return ['status'=>1,'data'=>$py_arr, 'url'=>$payment_url];
    } else {
        return ['status'=>2,'data'=>$model->getErrors()];
}
    // $pytmRefNoAndDate = time().'T'.rand(4,1000);
    // $userinfo = OpalusermstTbl::getUserInfoByReg($regPk);
    // $data = $regPk.'|'.$pymt_data['total_amount'].'|'.$pytmRefNoAndDate.'|'.$pymt_data['omrm_companyname_en'].'|'.$userinfo['firstname'].'|'.$userinfo['countryname'].'|'.$userinfo['statename'].'|'.$userinfo['cityname'].'|'.$userinfo['mobilecode'].' '.$userinfo['mobileno'];
    
    //$paymentdetials= \api\components\AfterLogin::paymentprocess($data);       
}

    public function convertDataforSP($_arr, $type="E") {
        if($type == 'E') {
            $merchant_data='';
            foreach ($_arr as $key => $value){
                if($value != '')
                    $merchant_data.=$key.'='.urlencode($value).'&';
            }
            return $merchant_data;
        } if($type == 'D') {				
            $dataArr = array();
            foreach ($_arr as $key => $value) {
                $orderdata = explode('=', $value);
                $dataArr[$orderdata[0]] = $orderdata[1];
            }
            return $dataArr;
        }
    }
    public function actionSavedocuments(){
       
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $total = $requestdata['data']['total_mst'];
        $refpk = $requestdata['referencepk'];

        for ($x = 1; $x <= $total; $x++) {
            if(empty($requestdata['data']['doc_'.$x])){
        //  $alerady =  AppdocsubmissiontmpTbl::find()->where('appdst_applicationdtlstmp_fk = '.$refpk)->one();
            //  if(empty($alerady)) {  
            $model = new AppdocsubmissiontmpTbl();
            $model->appdst_opalmemberregmst_fk = $regPk;
            $model->appdst_applicationdtlstmp_fk = $refpk;
            $model->appdst_documentdtlsmst_fk =  $requestdata['data']['referpk_'.$x];
            $model->appdst_submissionstatus =  $requestdata['data']['redio_'.$x];
            if($requestdata['data']['redio_'.$x] == 1){
                $model->appdst_memcompfiledtls_fk=$requestdata['data']['file_'.$x];
            }else{
                $model->appdst_remarks =$requestdata['data']['remark_'.$x];
            }
            
            
            $model->appdst_upload = $requestdata['data']['doc_'.$x];
          
            $model->appdst_status = 1;
            $model->appdst_createdon =  date("Y-m-d H:i:s");
            $model->appdst_createdby = $userPk;
            if(!$model->save()){
                var_dump($model->getErrors());
                exit;
            }
        // }
            }
            else{
                $model =  AppdocsubmissiontmpTbl::find()->where('appdocsubmissiontmp_pk = '.$requestdata['data']['doc_'.$x])->one();
                $model->appdst_opalmemberregmst_fk = $regPk;
                $model->appdst_applicationdtlstmp_fk = $refpk;
                $model->appdst_documentdtlsmst_fk =  $requestdata['data']['referpk_'.$x];
                if($requestdata['data']['redio_'.$x] != $model->appdst_submissionstatus){
                    $model->appdst_status = 2;
                }
                $model->appdst_submissionstatus =  $requestdata['data']['redio_'.$x];
                if($requestdata['data']['redio_'.$x] == 1){
                    $model->appdst_memcompfiledtls_fk=$requestdata['data']['file_'.$x];
                }else{
                    $model->appdst_remarks =$requestdata['data']['remark_'.$x];
                }
                
                $model->appdst_upload = $requestdata['data']['doc_'.$x];
                
                $model->appdst_updatedon =  date("Y-m-d H:i:s");
                $model->appdst_updatedby = $userPk;
                if(!$model->save()){
                    var_dump($model->getErrors());
                    exit;
                }

            }
          
            // echo $x;

          }
    // exit;
     return true;

    }
    public function actionSaveinternational(){
      
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       
    //    print_r($requestdata);exit;
       if($requestdata['type'] == 'new'){
        $model = new AppintrecogtmpTbl();
        $model->appintit_applicationdtlstmp_fk =$requestdata['data']['referencepk'] ;
        $model->appintit_opalmemberregmst_fk = $regPk;
        $model->appintit_intnatrecogmst_fk = $requestdata['data']['award_organ'];
        $model->appintit_lastauditdate = date("Y-m-d", strtotime($requestdata['data']['last_audit']));
        $model->appintit_doc =(string)$requestdata['data']['document_upload'];
        $model->appintit_status = 1;
        $model->appintit_createdon = date("Y-m-d H:i:s");
        $model->appintit_createdby = $userPk;
        
        if($model->save()){
            
            return $model->appintrecogtmp_pk;
        } else {
            var_dump($model->getErrors());
            exit;
        }  
    }elseif($requestdata['type'] == 'edit'){
        $model = AppintrecogtmpTbl::find()->where('appintrecogtmp_pk = '.$requestdata['data']['appintrecogtmp_pk'])->one();

        // $model->appintit_applicationdtlstmp_fk =$requestdata['data']['referencepk'] ;
        // $model->appintit_opalmemberregmst_fk = $regPk;
        $model->appintit_intnatrecogmst_fk = $requestdata['data']['award_organ'];
        $model->appintit_lastauditdate = date("Y-m-d", strtotime($requestdata['data']['last_audit']));
        $model->appintit_doc =(string)$requestdata['data']['document_upload'];
        if($requestdata['apptype'] == 'update'){
        $model->appintit_status = 2;
        $model->appintit_updatedon = date("Y-m-d H:i:s");
        $model->appintit_updatedby = $userPk;
        }else{
             $model->appintit_status = 1;
             
        }
        // $model->appintit_createdon = date("Y-m-d H:m:i  ");
        // $model->appintit_createdby = $userPk;

        if($model->save()){
            
            return $model->appintrecogtmp_pk;
        } else {
            var_dump($model->getErrors());
            exit;
        }  
    }
        
    }
    public function actionGetinterawardorgandata(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $awardpk = $requestdata['awardpk'];
        $inter = AppintrecogmainTbl::find()
        ->select(['appintim_IntnatRecogMst_FK','appintim_LastAuditDate','appintim_Doc'])
        ->where('appintim_IntnatRecogMst_FK = '.$awardpk.' and appintim_OpalMemberRegMst_FK = '.$regPk)
        ->orderBy(['AppIntRecogMain_PK' => SORT_DESC])->asArray()->one();

        $interdata=[];
        if(empty($inter)){
            $interdata['status'] = 'no';
        }else{
            $interdata['status'] = 'yes';
            $interdata['data'] =  $inter;
        }

        return $interdata;
    }
     public function actionGetinternational(){
       
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pageSize =empty($data['limit'])?10:$data['limit'];
        $page =empty($data['page'])?0:$data['page'];;
        $referencepk = $data['referencepk'];
        $internatdata = AppintrecogtmpTbl::find()
       ->select(['appintrecogtmp_pk','AppIntRecogMain_PK',
       'DATE_FORMAT(appintit_lastauditdate,"%d-%m-%Y") AS last_aud',
       'DATE_FORMAT(appintit_lastauditdate,"%Y-%m-%d") AS last_aud1',
       'DATE_FORMAT(appintit_createdon,"%d-%m-%Y") AS created_on',
       'DATE_FORMAT(appintit_updatedon,"%d-%m-%Y") AS updated_on','irm_intlrecogname_en','irm_intlrecogname_ar','appintit_doc',
       'mcfd_filetype','memcompfiledtls_pk','appintit_opalmemberregmst_fk','appintit_intnatrecogmst_fk'," (case when appintit_status =1 or appintit_status = 2 then 'N' when appintit_status = 3 then 'A' when appintit_status = 4 then 'D'  when appintit_status = 5 then 'U'  end) as status1",'appintit_status as status',
       'DATE_FORMAT(appintit_appdecon,"%d-%m-%Y") AS appintit_appdecon','oum_firstname','appintit_appdeccomment'])
       ->leftJoin('intnatrecogmst_tbl rec','rec.intnatrecogmst_pk = appintrecogtmp_tbl.appintit_intnatrecogmst_fk')
       ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = appintit_doc')
       ->leftJoin('opalusermst_tbl','opalusermst_pk = appintit_appdecby')
       ->leftJoin('appintrecogmain_tbl','appintim_AppIntRecogTmp_FK = appintrecogtmp_pk')
       ->where(" appintit_applicationdtlstmp_fk = ".$referencepk );
       if(!empty($data['serachkey'])){
        if($data['serachkey']['name'] == 'Awarding'){
            $internatdata->andwhere("irm_intlrecogname_en  like '%".$data['serachkey']['serchkey']."%'");
        }
        if($data['serachkey']['name'] == 'LastAudited'){
            $internatdata->andwhere("appintit_lastauditdate  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
        }
        if($data['serachkey']['name'] == 'Addedon'){
            $internatdata->andwhere("appintit_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
        }
        if($data['serachkey']['name'] == 'LastUpdated'){
            $internatdata->andwhere("appintit_updatedon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
        }
        if($data['serachkey']['name'] == 'Status'){
            $internatdata->andwhere("appintit_status in (".implode(",",$data['serachkey']['serchkey']).")");    
        }
     }
       //appintit_opalmemberregmst_fk =".$regPk." and
        $internatdata->orderBy(['appintrecogtmp_pk' => SORT_DESC]);
        $internatdata->asArray();
        
    //      $a = $internatdata->createCommand()->getRawSql();
    //    echo $a;
    // //    echo 'hii';
    //    exit;

       
     

       $dataProvider = new ActiveDataProvider([
        'query' => $internatdata,
        'pagination' => [
                            'pageSize' =>$pageSize,
                            'page'=>$page
                        ]
            ]);
    $allrecords = $dataProvider->getModels();

    $records=[];
    foreach($allrecords as $record ){
      
        $url['url'] = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['appintit_opalmemberregmst_fk'],$record['appintit_createdby']);
        $data=array_merge($record,$url);
      
        array_push($records,$data);
       
    }
  

    $recodsset =[];
    $recodsset['applydata'] = $records;
    $recodsset['pagesize'] = $pageSize;
    $recodsset['totalcount'] = $dataProvider->getTotalCount();

    return $recodsset;
   

    }
    public function actionInterdelete(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $model =  AppintrecogtmpTbl::deleteAll('appintrecogtmp_pk = '.$data['pk']);
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();

        return true;

    }
    public function actionDeletestaffgrid(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $model =  AppstaffinfotmpTbl::deleteAll('appostaffinfotmp_pk = '.$data['pk']);
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        return true;

    }
    public function actionDeletestaffedu(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $model =  StaffacademicsTbl::deleteAll('staffacademics_pk = '.$data['pk']);
        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        return true;

    }
    public function actionDeletestaffwork(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $model =  StaffworkexpTbl::deleteAll('staffworkexp_pk = '.$data['pk']);

        return true;

    }
    public function actionGetstaffgridlist(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pageSize =empty($data['limit'])?10:$data['limit'];
        $page =empty($data['page'])?0:$data['page'];;
        $referencepk = $data['referencepk'];
        $getstaffgridlist = AppstaffinfotmpTbl::find()
        ->select(['appostaffinfotmp_pk','appsit_appcoursetrnstmp_fk','appctt_coursecategorymst_fk','appsit_staffinforepo_fk'," DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),sir_dob)), '%Y') + 0 AS age",
        'GROUP_CONCAT(DISTINCT rm_rolename_en) AS rolename_en','GROUP_CONCAT(DISTINCT rm_rolename_ar) AS rolename_ar','GROUP_CONCAT(DISTINCT ccm_catname_en) as ccm_catname_en','GROUP_CONCAT(DISTINCT ccm_catname_ar) as ccm_catname_ar',"CONCAT(ccm_catname_en,'(+',(LENGTH(appsit_appcoursetrnstmp_fk) - LENGTH(REPLACE(appsit_appcoursetrnstmp_fk,',',''))  ) ,')') AS catname_en","CONCAT(ccm_catname_ar,'(+',(LENGTH(appsit_appcoursetrnstmp_fk) - LENGTH(REPLACE(appsit_appcoursetrnstmp_fk,',',''))  ),')') AS catname_ar",
        'appsit_status','DATE_FORMAT(appsit_createdon,"%d-%m-%Y") AS addedon','DATE_FORMAT(appsit_updatedon,"%d-%m-%Y") AS updatedon','appsit_contracttype','appsit_jobtitle','appsit_mainrole','appsit_roleforcourse','DATE_FORMAT(appsit_appdecon,"%d-%m-%Y") AS appsit_appdecby','oum_firstname','appsit_appdeccomment',
        'staffinforepo_tbl.*',"(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' when appsit_iscarddetails = 1 then '4'
        when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard",
        'scm_assessmentin','appdt_projectmst_fk','appcdt_standardcoursemst_fk','appcdt_appoffercoursemain_fk','AppStaffInfoMain_PK'])
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsit_staffinforepo_fk')
        ->leftJoin('appstaffinfomain_tbl','appsim_AppStaffInfotmp_FK = appostaffinfotmp_pk')
        ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk,appsit_roleforcourse)')
        ->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)')
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appctt_coursecategorymst_fk')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = appsit_appdecby')
        ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
        ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')
        ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = appsit_applicationdtlstmp_fk')
        ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
        ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appsit_applicationdtlstmp_fk')
        ->where(" appsit_applicationdtlstmp_fk = ".$referencepk )->groupBy('appostaffinfotmp_pk');  
      
        if(!empty($data['serachkey'])){
            if($data['serachkey']['name'] == 'civil_numb'){
                $getstaffgridlist->andwhere("sir_idnumber  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'staff_name'){
                $getstaffgridlist->andwhere("sir_name_en  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'role_course'){
                $getstaffgridlist->andwhere("rm_rolename_en  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'cours_sub_cate'){
                $getstaffgridlist->andwhere("ccm_catname_en  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'adddoncour'){
                $getstaffgridlist->andwhere("appsit_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'LastUpdatedcour'){
                $getstaffgridlist->andwhere("appsit_updatedon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'StatusCour'){
                $getstaffgridlist->andwhere("appsit_status in (".implode(",",$data['serachkey']['serchkey']).")");   
            }

        }
        $getstaffgridlist->orderBy(['appsit_createdon' => SORT_DESC,'appsit_updatedon'=>SORT_DESC]);
        $getstaffgridlist->asArray();
        $a =  $getstaffgridlist->createCommand()->getRawSql();
        // print_r($a);exit;

        $dataProvider = new ActiveDataProvider([
            'query' => $getstaffgridlist,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
                ]);

            $stafflist =  $dataProvider->getModels();
                foreach( $stafflist as $key => $data){

                    $comptcard = AppstaffinfotmpTbl::find()
                    ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' 
                    when appsit_iscarddetails = 1 then '4'
                    when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
                    ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
                    ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
                    if($data['appdt_projectmst_fk'] == 2){
                        $comptcard->where(['scch_standardcoursemst_fk'=>$data['appcdt_standardcoursemst_fk']]);
                    }else{
                        $comptcard->where(['scch_appoffercoursemain_fk'=>$data['appcdt_appoffercoursemain_fk']]);

                    }
                    $comptcard->andWhere(['appostaffinfotmp_pk'=>$data['appostaffinfotmp_pk']]);
                    $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
                    $compt =  $comptcard->asArray()->one();
                    // $compt =  $comptcard->createCommand()->getRawSql();

                    $stafflist[$key]['competcard'] =  empty($compt['competcard'])?'1':$compt['competcard'];
                    if(!empty($data['appsit_roleforcourse'])){
                    $role = RolemstTbl::find()->select('group_concat(rm_rolename_ar) as rmar , group_concat(rm_rolename_en) as rmen')->where('rolemst_pk in ('.$data['appsit_roleforcourse'].')')->asArray()->one();
                    }
                    $stafflist[$key]['rolecnt'] = count(explode(",",$role['rmar']))-1;
                    $stafflist[$key]['allrole'] = $role['rmar'];

                   $roleforcourse = explode(",",$data['appsit_roleforcourse']);

                   // accessor 
                    // 16 incenter
                   
                    if(in_array(13,$roleforcourse)){
                        $stafflist[$key]['showaccessor'] = 'show';  
                    }else{
                        $stafflist[$key]['showaccessor'] = 'notshow';  
                    }

                  

                }
    
        $recodsset['staffgrid'] = $stafflist;
        $recodsset['pagesize'] = $pageSize;
        $recodsset['totalcount'] = $dataProvider->getTotalCount();
    
        return $recodsset;
        
    }
    public function returnDates($strDateFrom, $strDateTo) {

       
        $step = '+1 day';
        $output_format = 'Y-m-d';
        $dates = array();
        $current = strtotime($strDateFrom);
        $last = strtotime($strDateTo);
    
        while( $current <= $last ) {
    
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
            return $dates;
    }

      public function actionSaveaccessorscheduledtls(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $date = date("Y-m-d H:i:s");

        $userdata =  AppstaffinfotmpTbl::find()->where('appostaffinfotmp_pk = '.$data['pk'])->asArray()->one();
        $userdata_other =  AppstaffinfotmpTbl::find()->select(['group_concat(appostaffinfotmp_pk) as pks'])->where('appsit_staffinforepo_fk = '.$userdata['appsit_staffinforepo_fk'].' and appostaffinfotmp_pk != '.$data['pk'])->asArray()->one();

    
       
        // print_r( $newInputTime);exit;    
        $isTimeAvailable = true; // Assume the time is available initially
   
        $datePeriodlist = $this->returnDates($data['data']['selectedDate']['startDate'],$data['data']['selectedDate']['endDate']);
       
        foreach($datePeriodlist as $startdate){

        $model = AppstaffscheddtlsTbl::find()->where('assd_appstaffinfotmp_fk = '.$data['pk'].' and assd_date = '.'"'.date('Y-m-d', strtotime($startdate)).'"')->asArray()->all();
   
         
        $newInputTime =date('Y-m-d', strtotime($startdate)).' '.$data['data']['startDate'];
        $newInputTimeend =date('Y-m-d', strtotime($startdate)).' '.$data['data']['EndDate'];
    
        $starttime_input_dt = new DateTime($newInputTime);
        $endtime_input_dt = new DateTime($newInputTimeend);
    //    var_dump($model);exit;

        foreach ($model as $schedule) {

        $startTime = strtotime($schedule['assd_starttime']);
        $endTime = strtotime($schedule['assd_endtime']);
        $existing_start_dt = new DateTime($schedule['assd_starttime']);
        $existing_end_dt = new DateTime($schedule['assd_endtime']);
        
        if (strtotime($newInputTime) >= $startTime && strtotime($newInputTime) < $endTime) {
            // The new input time falls within an existing schedule
            $isTimeAvailable = false;
            break; // Stop checking further schedules as we've found a conflict
        }
         if (strtotime($newInputTime) <= $startTime && $startTime < strtotime($newInputTimeend)) {
            $isTimeAvailable = false;
            break; 
        }
      

        // if ( $starttime_input_dt >= $existing_start_dt && $starttime_input_dt < $existing_end_dt) {
        //     // The new input time falls within an existing schedule
        //     $isTimeAvailable = false;
        //     break; // Stop checking further schedules as we've found a conflict
        // }
        //  if ($starttime_input_dt <= $existing_start_dt && $existing_start_dt < $endtime_input_dt) {
        //     $isTimeAvailable = false;
        //     break; 
        // }
        
        }

        $isTimeAvailable_other = true; // Assume the time is available initially
        if($userdata_other['pks']){
            $model_other = AppstaffscheddtlsTbl::find()->where('assd_appstaffinfotmp_fk in ('.$userdata_other['pks'].') and assd_dayschedule = 32  and assd_date = '.'"'.date('Y-m-d', strtotime($startdate)).'"')->asArray()->all();        
    }
        foreach ($model_other as $schedule) {
        $startTime = strtotime($schedule['assd_starttime']);
        $endTime = strtotime($schedule['assd_endtime']);
        if (strtotime($newInputTime) >= $startTime && strtotime($newInputTime) < $endTime) {
            // The new input time falls within an existing schedule
            $isTimeAvailable_other = false;
            break; // Stop checking further schedules as we've found a conflict
        }
        if (strtotime($newInputTime) <= $startTime && $startTime < strtotime($newInputTimeend)) {
            $isTimeAvailable_other = false;
            break; 
        }
        }
        }
        
        if ($isTimeAvailable && $isTimeAvailable_other) {
            $datePeriod = $this->returnDates($data['data']['selectedDate']['startDate'],$data['data']['selectedDate']['endDate']);
            // print_r($datePeriod);exit;
            foreach($datePeriod as $singledate) {
            $starttime = $singledate.' '.$data['data']['startDate'];
            $endtime = $singledate.' '.$data['data']['EndDate'];
            
            $modelcal = new AppstaffscheddtlsTbl();
            $modelcal->assd_opalmemberregmst_fk = $regPk;
            $modelcal->assd_appstaffinfotmp_fk =  $data['pk'];
            $modelcal->assd_date =$singledate;
            $modelcal->assd_dayschedule =64;            
            $modelcal->assd_starttime=  $starttime;
            $modelcal->assd_endtime = $endtime;
            $modelcal->assd_status = 1;
            $modelcal->assd_createdon =  $date;
            $modelcal->assd_createdby =  $userPk;
            
            if(!$modelcal->save()){
                var_dump($modelcal->getErrors());exit;
                }
                // else{
                //     return 'success';
                // }
            }
            // exit;
          } else {
            return ['isTimeAvailable'=>$isTimeAvailable,'isTimeAvailable_other'=>$isTimeAvailable_other];
          }

       
        
    }
  
    public function actionUpdateaccessorscheduledtls(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $date = date("Y-m-d H:i:s");

        $modelcal =  AppstaffscheddtlsTbl::find()->where('appstaffscheddtls_pk = '.$data['pk'])->one();
        $modelcal->assd_dayschedule =$data['value']; 
        $modelcal->assd_updatedon =  $date;
        $modelcal->assd_updatedby =  $userPk;
        
        if(!$modelcal->save()){
            var_dump($modelcal->getErrors());exit;
            } else{
                return 'success';
            }
        
    }
    public function actionGetaccessorscheduledtls(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pageSize =empty($data['limit'])?10:$data['limit'];
        $page =empty($data['page'])?0:$data['page'];
        
        // print_r($data);exit;
        $referencepk = $data['referencepk'];
        $stafflist = [];
        $getstaffgridlist = AppstaffinfotmpTbl::find()
        ->select([
        'staffinforepo_pk',
        'scch_verificationcode',
        'user.oum_status as oum_status',
        'appsim_emailid as email_id',
        "sccd_status as competency_card",
        'appostaffinfotmp_pk','appsit_appcoursetrnstmp_fk','appsit_staffinforepo_fk','sir_idnumber','sir_name_en','sir_name_ar'," DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),sir_dob)), '%Y') + 0 AS age",
        'rm_rolename_en','rm_rolename_ar',"CONCAT(ccm_catname_en,'(+',(LENGTH(appsit_appcoursetrnstmp_fk) - LENGTH(REPLACE(appsit_appcoursetrnstmp_fk,',',''))  ) ,')') AS catname_en","CONCAT(ccm_catname_ar,'(+',(LENGTH(appsit_appcoursetrnstmp_fk) - LENGTH(REPLACE(appsit_appcoursetrnstmp_fk,',',''))  ),')') AS catname_ar",
        'appsit_status','DATE_FORMAT(appsit_createdon,"%d-%m-%Y") AS addedon','DATE_FORMAT(appsit_updatedon,"%d-%m-%Y") AS updatedon',
        'staffinforepo_tbl.*','appsit_contracttype','appsit_jobtitle','appsit_mainrole','appsit_roleforcourse','DATE_FORMAT(appsit_appdecon,"%d-%m-%Y") AS appsit_appdecby','appde.oum_firstname as oum_firstname','appsit_appdeccomment',
        "(case  when appsit_iscarddetails = 2 and sccd_appcoursetrnstmp_fk is null then '1' 
        when sccd_status =1 then '2'  when sccd_status =2 then '3' when appsit_iscarddetails = 1 then '4' end) as competcard",
        'scm_coursename_en as categories_en','scm_coursename_ar as categories_ar',
        'scm_assessmentin','appdt_projectmst_fk','appcdt_standardcoursemst_fk','appcdt_appoffercoursemain_fk'])
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsit_staffinforepo_fk')
        ->leftJoin('rolemst_tbl','rolemst_pk in (appsit_roleforcourse)')
        ->leftJoin('appcoursetrnstmp_tbl','appcoursetrnstmp_pk =  appsit_appcoursetrnstmp_fk')
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appctt_coursecategorymst_fk')
        ->leftJoin('opalusermst_tbl appde','appde.opalusermst_pk = appsit_appdecby')
        ->leftJoin('opalusermst_tbl user','user.oum_staffinforepo_fk = appsit_staffinforepo_fk')
        ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
        ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')
        ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = appsit_applicationdtlstmp_fk')
        ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
        ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appsit_applicationdtlstmp_fk')
        ->leftJoin('appstaffinfomain_tbl','appsim_AppStaffInfotmp_FK = appostaffinfotmp_pk')
        ->where(" appostaffinfotmp_pk = ".$data['pk'] )
        ->asArray()->one();
        
        $comptcard = AppstaffinfotmpTbl::find()
        ->select(["DATE_FORMAT(sccd_createdon,'%d-%m-%Y') as last_approved,(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' when appsit_iscarddetails = 1 then '4'
        when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
        ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
        ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
        if($getstaffgridlist['appdt_projectmst_fk'] == 2){
            $comptcard->where(['scch_standardcoursemst_fk'=>$getstaffgridlist['appcdt_standardcoursemst_fk']]);
        }else{
            $comptcard->where(['scch_appoffercoursemain_fk'=>$getstaffgridlist['appcdt_appoffercoursemain_fk']]);

        }
        $comptcard->andWhere(['scch_staffinforepo_fk'=>$getstaffgridlist['appsit_staffinforepo_fk']]);
       
        $compt =  $comptcard->asArray()->one();
        $stafflist['competcard'] =  empty($compt['competcard'])?'1':$compt['competcard'];

        $stafflist['staffinforepo_pk'] =  $getstaffgridlist['staffinforepo_pk'];
        $stafflist['scch_verificationcode'] =  $getstaffgridlist['scch_verificationcode'];
        $stafflist['appostaffinfotmp_pk'] =  $getstaffgridlist['appostaffinfotmp_pk'];
        $stafflist['oum_status'] =  $getstaffgridlist['oum_status'];
        $stafflist['email_id'] =  $getstaffgridlist['email_id'];
        $stafflist['last_approved'] =  $compt['last_approved'];
        $stafflist['competency_card'] =  $getstaffgridlist['competency_card'];
        $stafflist['coursePk'] =  $getstaffgridlist['appcdt_standardcoursemst_fk'];

        $stafflist['sir_name_ar'] =  $getstaffgridlist['sir_name_ar'];
        $stafflist['categories_en'] =  $getstaffgridlist['categories_en'];
        $stafflist['categories_ar'] =  $getstaffgridlist['categories_ar'];
        $stafflist['sir_name_en'] =  $getstaffgridlist['sir_name_en'];
        $stafflist['sir_idnumber'] =  $getstaffgridlist['sir_idnumber'];
        $stafflist['appsit_status'] = $getstaffgridlist['appsit_status'];
        $stafflist['competcard'] = $getstaffgridlist['competcard'];
         $role = RolemstTbl::find()->select('rm_rolename_ar,rm_rolename_en,group_concat(rm_rolename_ar) as rmar , group_concat(rm_rolename_en) as rmen')
         ->where('rolemst_pk in ('.$getstaffgridlist['appsit_roleforcourse'].')')->asArray()->one();
// print_r($role);exit;
            $stafflist['rolecnt'] = count(explode(",",$role['rmar']))-1;
            $stafflist['allrole_ar'] = $role['rmar'];
            $stafflist['allrole_en'] = $role['rmen'];
            $stafflist['rm_rolename_en'] = $role['rm_rolename_en'];
            $stafflist['rm_rolename_ar'] = $role['rm_rolename_ar'];
      
          $staffsubcat = AppcoursetrnstmpTbl::find()
            ->select(['appcoursetrnstmp_pk','ccm_catname_en','ccm_catname_ar','group_concat(ccm_catname_en) as ccen','group_concat(ccm_catname_en) as ccar'])
            ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appctt_coursecategorymst_fk')
            ->where('appcoursetrnstmp_pk in ('.$getstaffgridlist['appsit_appcoursetrnstmp_fk'].')')
            // ->createCommand()->getRawSql();
            ->asArray()->one();

            $stafflist['subcat'] = count(explode(",",$staffsubcat['ccen']))-1;
            $stafflist['subcat_ar'] = $staffsubcat['ccar'];
            $stafflist['subcat_en'] = $staffsubcat['ccen'];
            $stafflist['ccm_catname_en'] = $staffsubcat['ccm_catname_en'];
            $stafflist['ccm_catname_ar'] = $staffsubcat['ccm_catname_ar'];
            

    
        $query = AppstaffscheddtlsTbl::find()
        ->select(['appstaffscheddtls_pk','assd_appstaffinfotmp_fk','DATE_FORMAT(assd_date,"%d-%m-%Y") AS date','assd_date','assd_dayschedule',
        'concat((DATE_FORMAT(assd_starttime, "%h:%i %p")),"-",(DATE_FORMAT(assd_endtime, "%h:%i %p"))) as times','rm_name_en','rm_name_ar',
        "if(assd_date >= CURDATE(),'yes','no') as dtype",
        "(CASE WHEN assd_bookedfor = 1 THEN (CASE WHEN bmth_status IS NOT NULL THEN bmth_status ELSE bmph_status END) WHEN assd_bookedfor = 2 THEN bmah_status ELSE null END) as batchStatus",
        ])
        ->leftJoin('referencemst_tbl','referencemst_pk = assd_dayschedule')
        ->leftjoin('appstaffinfotmp_tbl','appostaffinfotmp_pk = assd_appstaffinfotmp_fk')
        ->leftjoin('opalusermst_tbl','oum_staffinforepo_fk = appsit_staffinforepo_fk')
        
        ->leftjoin('batchmgmtasmthdr_tbl assessor','bmah_assessor = opalusermst_pk AND assd_date =bmah_assessmentdate')
        ->leftjoin('batchmgmtdtls_tbl assessorStatus','assessorStatus.batchmgmtdtls_pk = assessor.bmah_batchmgmtdtls_fk')
        
        ->leftjoin('batchmgmtthyhdr_tbl tutorT','bmth_tutor = opalusermst_pk AND assd_date =bmth_startdate') 
        ->leftjoin('batchmgmtdtls_tbl tutorStatusT','tutorStatusT.batchmgmtdtls_pk = tutorT.bmth_batchmgmtdtls_fk')
        
        ->leftjoin('batchmgmtpracthdr_tbl tutorP','bmph_tutor = opalusermst_pk AND assd_date =bmph_startdate') 
        ->leftjoin('batchmgmtdtls_tbl tutorStatusP','tutorStatusP.batchmgmtdtls_pk = tutorP.bmph_batchmgmtdtls_fk')
        ->where('assd_appstaffinfotmp_fk = '.$data['pk'])
        ->orderBy(['appstaffscheddtls_pk' => SORT_DESC])
        ->asArray();
        if(!empty($data['serachkey'])){
          
                if(!empty($data['serachkey']['startdate'])){
                $query->andwhere("assd_date  between '".$data['serachkey']['startdate']."' and '".$data['serachkey']['enddate']."'");
                }
          
          
                if(!empty($data['serachkey']['status'])){
                $query->andwhere("assd_dayschedule in (".implode(",",$data['serachkey']['status']).")");  
                } 
            

        }
        // $a = $query->createCommand()->getRawSql();
        // print_r($a);exit;

        // $dayschedule = ReferencemstTbl::find()
        // ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        // ->where(['rm_mastertype'=>11])
        // // ->andWhere('referencemst_pk != 32')
        // ->asArray()->All();

        $dataProvider = new ActiveDataProvider([
            'query' =>  $query,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
                ]);

        // $recodsset['schedulelist'] = $dayschedule;
        $recodsset['accessorlist'] =  $dataProvider->getModels();
        $recodsset['staffgrid'] = $stafflist;
        $recodsset['pagesize'] = $pageSize;
        $recodsset['totalcount'] = $dataProvider->getTotalCount();
    
        return $recodsset;
        
    }
  

    public function actionGetstaffedu(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pageSize =empty($data['limit'])?10:$data['limit'];
        $page =empty($data['page'])?0:$data['page'];;
        $referencepk = $data['referencepk'];
        // var_dump($referencepk);exit;

        $edudet = StaffacademicsTbl::find()
        ->select(['staffacademics_pk','sacd_institutename as institute','sacd_degorcert as degree',
        'DATE_FORMAT(sacd_startdate,"%d-%m-%Y") AS yearjoin','DATE_FORMAT(sacd_enddate,"%d-%m-%Y") AS yearpass',
        'sacd_grade as grade','DATE_FORMAT(sacd_createdon,"%d-%m-%Y") AS addedu',
        'DATE_FORMAT(sacd_updatedon,"%d-%m-%Y") AS lastUpdated','staffacademics_tbl.*','rm_name_ar as edulvl_ar','rm_name_en as edulvl_en',
        'mcfd_filetype','memcompfiledtls_pk','mcfd_opalmemberregmst_fk','mcfd_uploadedby'])
        ->leftJoin('referencemst_tbl','referencemst_pk = sacd_edulevel')
        ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sacd_certupload')
        ->andWhere('sacd_staffinforepo_fk = "' . $referencepk  . '"');
       
      
        if(!empty($data['serachkey'])){
            if($data['serachkey']['name'] == 'institute'){
                $edudet->andwhere("sacd_institutename  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'degree'){
                $edudet->andwhere("sacd_degorcert  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'year_join'){
                $edudet->andwhere("sacd_startdate  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'sacd_enddate'){
                $edudet->andwhere("sacd_startdate  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'grade'){
                $edudet->andwhere("sacd_grade  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'add_On'){
                $edudet->andwhere("sacd_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'Last_Date'){
                $edudet->andwhere("sacd_updatedon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            
        }
        $edudet->orderBy(['staffacademics_pk' => SORT_DESC]);
        $edudet->asArray();
       $dataProvider = new ActiveDataProvider([
        'query' => $edudet,
        'pagination' => [
                            'pageSize' =>$pageSize,
                            'page'=>$page
                        ]
            ]);

    $allrecords = $dataProvider->getModels();
    foreach($allrecords as $key => $record){
        $url = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['mcfd_opalmemberregmst_fk'],$record['mcfd_uploadedby']);
        $allrecords[$key]['url'] =  $url;
    }
    $recodsset['education'] = $allrecords;
    $recodsset['pagesize'] = $pageSize;
    $recodsset['totalcount'] = $dataProvider->getTotalCount();

    return $recodsset;
    }
    public function actionGetstaffwork(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pageSize =empty($data['limit'])?10:$data['limit'];
        $page =empty($data['page'])?0:$data['page'];;
        $referencepk = $data['referencepk'];

        $workexp = StaffworkexpTbl::find()
        ->select(['staffworkexp_pk','sexp_employername as organname','DATE_FORMAT(sexp_doj,"%d-%m-%Y") AS datejoin','DATE_FORMAT(sexp_eod,"%d-%m-%Y") AS worktill','sexp_designation as desig','DATE_FORMAT(sexp_createdon,"%d-%m-%Y") AS addedu','DATE_FORMAT(sexp_updatedon,"%d-%m-%Y") AS lastUpdated','staffworkexp_tbl.*',
        'ocym_countryname_en','ocym_countryname_ar','osm_statename_en','osm_statename_ar','ocim_cityname_en','ocim_cityname_ar',
        'sexp_profdocupload','mcfd_filetype','memcompfiledtls_pk','mcfd_opalmemberregmst_fk','mcfd_uploadedby'])
        ->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sexp_opalcountrymst_fk')
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sexp_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sexp_opalcitymst_fk')
        ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sexp_profdocupload')
        ->andWhere('sexp_staffinforepo_fk = "' . $referencepk  . '"');
        if(!empty($data['serachkey'])){
            if($data['serachkey']['name'] == 'oranisation'){
                $workexp->andwhere("sexp_employername  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'date_joined'){
                $workexp->andwhere("sexp_doj  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'work_till'){
                $workexp->andwhere("sexp_eod  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'designation'){
                $workexp->andwhere("sexp_designation like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'add_edOn'){
                $workexp->andwhere("sexp_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'count'){
                $workexp->andwhere("ocym_countryname_en  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'gover'){
                $workexp->andwhere("osm_statename_en  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'wilaya'){
                $workexp->andwhere("ocim_cityname_en  like '%".$data['serachkey']['serchkey']."%'");
            }
        }
        $workexp->orderBy(['staffworkexp_pk' => SORT_DESC]);
        $workexp->asArray();
       
        
       $dataProvider = new ActiveDataProvider([
        'query' =>  $workexp,
        'pagination' => [
                            'pageSize' =>$pageSize,
                            'page'=>$page
                        ]
            ]);

    $allrecords = $dataProvider->getModels();
    foreach($allrecords as $key => $record){
        $url = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['mcfd_opalmemberregmst_fk'],$record['mcfd_uploadedby']);
        $allrecords[$key]['url'] =  $url;
    }
    $recodsset['workexp'] = $allrecords;
    $recodsset['pagesize'] = $pageSize;
    $recodsset['totalcount'] = $dataProvider->getTotalCount();

    return $recodsset;
    }
    // public function actionGetstaffedu(){
    //     $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    //     $request_body = file_get_contents('php://input');
    //     $data = json_decode($request_body, true);
    //     $pageSize =empty($data['limit'])?10:$data['limit'];
    //     $page =empty($data['page'])?0:$data['page'];;
    //     $referencepk = $data['referencepk'];
    //     // var_dump($referencepk);exit;

    //     $edudet = StaffacademicsTbl::find()
    //     ->select(['staffacademics_pk','sacd_institutename as institute','sacd_degorcert as degree','DATE_FORMAT(sacd_startdate,"%d-%m-%Y") AS yearjoin','DATE_FORMAT(sacd_enddate,"%d-%m-%Y") AS yearpass','sacd_grade as grade','DATE_FORMAT(sacd_createdon,"%d-%m-%Y") AS addedu','DATE_FORMAT(sacd_updatedon,"%d-%m-%Y") AS lastUpdated','staffacademics_tbl.*'])
    //     ->andWhere('sacd_staffinforepo_fk = "' . $referencepk  . '"');
       
      
    //     if(!empty($data['serachkey'])){
    //         if($data['serachkey']['name'] == 'institute'){
    //             $edudet->andwhere("sacd_institutename  like '%".$data['serachkey']['serchkey']."%'");
    //         }
    //         if($data['serachkey']['name'] == 'degree'){
    //             $edudet->andwhere("sacd_degorcert  like '%".$data['serachkey']['serchkey']."%'");
    //         }
    //         if($data['serachkey']['name'] == 'year_join'){
    //             $edudet->andwhere("sacd_startdate  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //         if($data['serachkey']['name'] == 'sacd_enddate'){
    //             $edudet->andwhere("sacd_startdate  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //         if($data['serachkey']['name'] == 'grade'){
    //             $edudet->andwhere("sacd_grade  like '%".$data['serachkey']['serchkey']."%'");
    //         }
    //         if($data['serachkey']['name'] == 'add_On'){
    //             $edudet->andwhere("sacd_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //         if($data['serachkey']['name'] == 'Last_Date'){
    //             $edudet->andwhere("sacd_updatedon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //     }
    //     $edudet->orderBy(['staffacademics_pk' => SORT_DESC]);
    //     $edudet->asArray();
    //    $dataProvider = new ActiveDataProvider([
    //     'query' => $edudet,
    //     'pagination' => [
    //                         'pageSize' =>$pageSize,
    //                         'page'=>$page
    //                     ]
    //         ]);

    // $allrecords = $dataProvider->getModels();
    // $recodsset['education'] = $allrecords;
    // $recodsset['pagesize'] = $pageSize;
    // $recodsset['totalcount'] = $dataProvider->getTotalCount();

    // return $recodsset;
    // }
    // public function actionGetstaffwork(){
    //     $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    //     $request_body = file_get_contents('php://input');
    //     $data = json_decode($request_body, true);
    //     $pageSize =empty($data['limit'])?10:$data['limit'];
    //     $page =empty($data['page'])?0:$data['page'];;
    //     $referencepk = $data['referencepk'];

    //     $workexp = StaffworkexpTbl::find()
    //     ->select(['staffworkexp_pk','sexp_employername as organname','DATE_FORMAT(sexp_doj,"%d-%m-%Y") AS datejoin','DATE_FORMAT(sexp_eod,"%d-%m-%Y") AS worktill','sexp_designation as desig','DATE_FORMAT(sexp_createdon,"%d-%m-%Y") AS addedu','DATE_FORMAT(sexp_updatedon,"%d-%m-%Y") AS lastUpdated','staffworkexp_tbl.*'])
    //     ->andWhere('sexp_staffinforepo_fk = "' . $referencepk  . '"');
    //     if(!empty($data['serachkey'])){
    //         if($data['serachkey']['name'] == 'oranisation'){
    //             $workexp->andwhere("sexp_employername  like '%".$data['serachkey']['serchkey']."%'");
    //         }
    //         if($data['serachkey']['name'] == 'date_joined'){
    //             $workexp->andwhere("sexp_doj  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //         if($data['serachkey']['name'] == 'work_till'){
    //             $workexp->andwhere("sexp_eod  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //         if($data['serachkey']['name'] == 'designation'){
    //             $workexp->andwhere("sexp_designation  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //         if($data['serachkey']['name'] == 'add_edOn'){
    //             $workexp->andwhere("sexp_createdon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
    //         }
    //     }
    //     $workexp->orderBy(['staffworkexp_pk' => SORT_DESC]);
    //     $workexp->asArray();
       
        
    //    $dataProvider = new ActiveDataProvider([
    //     'query' =>  $workexp,
    //     'pagination' => [
    //                         'pageSize' =>$pageSize,
    //                         'page'=>$page
    //                     ]
    //         ]);

    // $allrecords = $dataProvider->getModels();
    // $recodsset['workexp'] = $allrecords;
    // $recodsset['pagesize'] = $pageSize;
    // $recodsset['totalcount'] = $dataProvider->getTotalCount();

    // return $recodsset;
    // }
    public function actionGetfirstgrid(){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pageSize =empty($data['limit'])?10:$data['limit'];
        $page =empty($data['page'])?0:$data['page'];;
       
    
        $datalist = ApplicationdtlstmpTbl::find()  
        ->select(['applicationdtlstmp_pk','appdt_projectmst_fk','appdt_appreferno as applictionno','pm_projectname_en','pm_projectname_ar',
        'appiim_officetype','appiim_branchname_en','appiim_branchname_ar','appdt_status','appdt_apptype',
        '(case when appcdt_standardcoursemst_fk IS not NULL THEN scm_coursename_en  when appcdt_appoffercoursemain_fk IS NOT NULL THEN appocm_coursename_en end)  as coursename_en',
        '(case when appcdt_standardcoursemst_fk IS not NULL THEN scm_coursename_ar when appcdt_appoffercoursemain_fk IS NOT NULL THEN appocm_coursename_ar end)  as coursename_ar',
        '(CASE WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN std.ccm_catname_en  when appcdt_appoffercoursemain_fk IS NOT NULL THEN cus.ccm_catname_en  END) AS courscat_en',
        '(CASE WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN std.ccm_catname_ar when appcdt_appoffercoursemain_fk IS NOT NULL THEN  cus.ccm_catname_ar  END) AS courscat_ar',
        'reqfor.rm_name_en as reqfor_en','reqfor.rm_name_ar as  reqfor_ar','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS dateofexpiry','appdt_status as  applicationstatus',
        '(case when appdt_certificateexpiry is null then "1"    when appdt_certificateexpiry is not null and  appdt_certificateexpiry >= CURDATE() then "2"
        when appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()  then "3"  end) as certification',
        'DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS dateofexpiry','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") as  addedon',
        'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") as  lastUpdated','delto.rm_name_en as delto_en','delto.rm_name_ar as delto_ar',
        "ABS(DATEDIFF(CURDATE(), DATE_FORMAT(appdt_certificateexpiry, '%Y-%m-%d'))) as days",'appdt_certificatepath'])
        ->leftjoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk =  applicationdtlstmp_pk')
        ->leftjoin('projectmst_tbl','projectmst_pk = appdt_projectmst_fk')
        ->leftjoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
        ->leftjoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
        ->leftjoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
        ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
        ->leftJoin('referencemst_tbl delto','delto.referencemst_pk = appcdt_deliverto')
        ->leftjoin('coursecategorymst_tbl std','std.coursecategorymst_pk = scm_coursecategorymst_fk')
        ->leftjoin('coursecategorymst_tbl cus','cus.coursecategorymst_pk = appocm_coursecategorymst_fk')
        ->where("appdt_opalmemberregmst_fk =".$regPk ."  and appdt_projectmst_fk in (2,3) and appcdt_appinstinfomain_fk is not null")
        ->orderBy(['appdt_updatedon' => SORT_DESC,'appdt_submittedon' => SORT_DESC]); 
        // $datalist->andwhere("applicationdtlstmp_pk in (626,533,648,1147,1253) ");
        // $a =  $datalist->createCommand()->getRawSql();
        // print($a);exit;
        if(!empty($data['serachkey']['serchkey'])){
            if($data['serachkey']['name'] == 'appl_form'){
                $datalist->andwhere("appdt_appreferno like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'officetype'){
                $datalist->andwhere("appiim_officetype in (".implode(",",$data['serachkey']['serchkey']).")");
            }
            if($data['serachkey']['name'] == 'bran_name'){
                $datalist->andwhere("appiim_branchname_en  like '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'coures_type'){
                $datalist->andwhere("appdt_projectmst_fk in( ".implode(",",$data['serachkey']['serchkey']).")");
            }
            if($data['serachkey']['name'] == 'course_titles'){
                $datalist->andwhere("scm_coursename_en  like '%".$data['serachkey']['serchkey']."%'");
                $datalist->orwhere("appocm_coursename_en  like '%".$data['serachkey']['serchkey']."%'");
                $datalist->andwhere("appdt_opalmemberregmst_fk =".$regPk ."");
            }
            if($data['serachkey']['name'] == 'course_cat'){
                $datalist->andwhere("cus.ccm_catname_en  like '%".$data['serachkey']['serchkey']."%'");
                $datalist->orwhere("std.ccm_catname_en  like '%".$data['serachkey']['serchkey']."%'");
                $datalist->andwhere("appdt_opalmemberregmst_fk =".$regPk ."");
            }
            if($data['serachkey']['name'] == 'requested'){
                $datalist->andwhere("scm_requestfor in (".implode(",",$data['serachkey']['serchkey']).")");
            }
            if($data['serachkey']['name'] == 'courdeliver'){
                $datalist->andwhere("delto.rm_name_en  like  '%".$data['serachkey']['serchkey']."%'");
            }
            if($data['serachkey']['name'] == 'date_expiry'){
                $datalist->andwhere("appdt_certificateexpiry  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
            }
            if($data['serachkey']['name'] == 'addedon_branch'){
                if(!empty($data['serachkey']['serchkey']['startDate'])){
                $datalist->andwhere("appdt_submittedon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
                }
            }
            if($data['serachkey']['name'] == 'lastUpdated_branch'){
                if(!empty($data['serachkey']['serchkey']['startDate'])){
                $datalist->andwhere("appdt_updatedon  between '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['startDate']))."' and '".date("Y-m-d", strtotime($data['serachkey']['serchkey']['endDate']))."'");
                }
            }
            if($data['serachkey']['name'] == 'appl_status'){
                $datalist->andwhere("appdt_status in (".implode(",",$data['serachkey']['serchkey']).")");
            }
            if($data['serachkey']['name'] == 'cert'){
                if($data['serachkey']['serchkey'] == 1){
                    $datalist->andwhere("appdt_certificateexpiry is null");
                }else if($data['serachkey']['serchkey'] == 2){
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry > CURDATE()");
                }else if($data['serachkey']['serchkey'] == 3){
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
                }
                
            }
            if($data['serachkey']['name'] == 's'){
                if($data['serachkey']['serchkey'] == 't'){
                    $datalist->andwhere("appdt_projectmst_fk in(2)");
                }
                if($data['serachkey']['serchkey'] == 'y'){
                    $datalist->andwhere("appdt_projectmst_fk in(2)");
                    $datalist->andwhere("appdt_status not in(1,17)");
                }
                if($data['serachkey']['serchkey'] == 'a'){
                    $datalist->andwhere("appdt_projectmst_fk in(2)");
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry >= CURDATE()");
                }
                if($data['serachkey']['serchkey'] == 'n'){
                    $datalist->andwhere("appdt_projectmst_fk in(2)");
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
                }
                if($data['serachkey']['serchkey'] == 'e'){
                    $datalist->andwhere("appdt_projectmst_fk in(2)");
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
                }
                if($data['serachkey']['serchkey'] == 's'){
                    $datalist->andwhere("appdt_projectmst_fk in(2)");
                    $datalist->andwhere("appdt_status in (19)");
                }
            }
            if($data['serachkey']['name'] == 'c'){
                if($data['serachkey']['serchkey'] == 't'){
                    $datalist->andwhere("appdt_projectmst_fk in(3)");
                }
                if($data['serachkey']['serchkey'] == 'y'){
                    $datalist->andwhere("appdt_projectmst_fk in(3)");
                    $datalist->andwhere("appdt_status not in(1,17)");
                }
                if($data['serachkey']['serchkey'] == 'a'){
                    $datalist->andwhere("appdt_projectmst_fk in(3)");
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry >= CURDATE()");
                }
                if($data['serachkey']['serchkey'] == 'n'){
                    $datalist->andwhere("appdt_projectmst_fk in(3)");
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
                }
                if($data['serachkey']['serchkey'] == 'e'){
                    $datalist->andwhere("appdt_projectmst_fk in(3)");
                    $datalist->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
                }
                if($data['serachkey']['serchkey'] == 's'){
                    $datalist->andwhere("appdt_projectmst_fk in(3)");
                    $datalist->andwhere("appdt_status in (19)");
                }
            }

        }
        $datalist->asArray();
    //  $a =  $datalist->createCommand()->getRawSql();
    // print_r( $a);exit;
        $dataProvider = new ActiveDataProvider([
            'query' =>  $datalist,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
                ]);
        $allrecords = $dataProvider->getModels();

        $recodsset =[];
        $recodsset['applydata'] = $allrecords;
        $recodsset['pagesize'] = $pageSize;
        $recodsset['totalcount'] = $dataProvider->getTotalCount();

        $requestformst = ReferencemstTbl::find()
        ->select(['referencemst_pk','rm_name_en','rm_name_ar'])
        ->where(['rm_mastertype'=>13])
        ->asArray()->All();
    
        return ['firstgrid' => $recodsset,'reqfor'=>$requestformst];
    }
    
    public function actionGetalldata(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $pk =$data['pk'];
        $projectfk =$data['projectfk'];
        $courese = AppcoursedtlstmpTbl::find();
        if($projectfk == 2){
            $courese ->select(['appcoursedtlstmp_tbl.*','appinstinfomain_tbl.*','standardcoursemst_tbl.*','coursecategorymst_tbl.*','referencemst_tbl.*','DATE_FORMAT(appcdt_appdecon,"%d-%m-%Y") AS appcdtappdecon','oum_firstname']);
        }else{
            $courese ->select(['appcoursedtlstmp_tbl.*','appinstinfomain_tbl.*','appoffercoursemain_tbl.*','coursecategorymst_tbl.*','referencemst_tbl.*','DATE_FORMAT(appcdt_appdecon,"%d-%m-%Y") AS appcdtappdecon','oum_firstname']);
        }
       
        $courese->leftjoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk');
        $courese->leftJoin('opalusermst_tbl','opalusermst_pk = appcdt_appdecby');
        if($projectfk == 2){
            $courese->leftjoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk');
            $courese->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = scm_coursecategorymst_fk');
            $courese->leftJoin('referencemst_tbl','referencemst_pk = scm_courselevel');
        }else{
            $courese->leftjoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk');
            $courese->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appocm_coursecategorymst_fk');
            $courese->leftJoin('referencemst_tbl','referencemst_pk = appocm_courselevel');
        }
        $courese->where('appcdt_applicationdtlstmp_fk = '.$pk);
        $courese->asArray();   
        $dataProvider = new ActiveDataProvider([
            'query' => $courese
        ]); 
        $allrecords = $dataProvider->getModels();
        // print_r($allrecords);exit;

       $appctt_appcoursedtlstmp_fk = $allrecords[0]['appcoursedtlstmp_pk'];

        $subcategory = Appcoursetrnstmptbl::find()
        ->where('appctt_appcoursedtlstmp_fk ='.$appctt_appcoursedtlstmp_fk)
        ->asArray()->all();  
        
        $categorys=[];
        
        foreach($subcategory as $data){
            array_push($categorys,$data['appctt_coursecategorymst_fk']);

        }
       

        return ['course'=>$allrecords,'category'=>$categorys];
        
    }
    public function actionGetsubactegoryarray(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $applioctionpk = $data['applicationpk'];

        $course =  AppcoursedtlstmpTbl::find()->where('appcdt_applicationdtlstmp_fk = '.$applioctionpk)->one();

        $staffsubcat = AppcoursetrnstmpTbl::find()
        ->select(['appcoursetrnstmp_pk','coursecategorymst_pk','ccm_catname_en','ccm_catname_ar'])
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appctt_coursecategorymst_fk')
        ->where(['appctt_appcoursedtlstmp_fk' =>$course->appcoursedtlstmp_pk])
        ->asArray()->all();

        $subcatarr=[];
            foreach($staffsubcat as $data){
                array_push($subcatarr,[$data['appcoursetrnstmp_pk'] => $data['coursecategorymst_pk']]);
            }

            return ['subcatarr'=>$subcatarr,'couresepk'=>$course['appcdt_standardcoursemst_fk']];
        }



    public function actionStaffconfigurationcheck(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $applioctionpk = $data['applicationpk'];
        $applicationtype = $data['apptype'];
        $stafftmp =  AppstaffinfotmpTbl::find()->where('appsit_applicationdtlstmp_fk = '.$applioctionpk)->asArray()->all();
        $course =  AppcoursedtlstmpTbl::find()->where('appcdt_applicationdtlstmp_fk = '.$applioctionpk)->one();

        $staffsubcat = AppcoursetrnstmpTbl::find()
        ->select(['appcoursetrnstmp_pk','coursecategorymst_pk','ccm_catname_en','ccm_catname_ar','sccm_trainer','sccm_assessor','sccm_trainerandassessor','sccm_coursetype','sccm_programmanager'])
        ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = appctt_coursecategorymst_fk')
        ->leftJoin('staffcourseconfigmst_tbl','sccm_coursecategorymst_fk = coursecategorymst_pk')
        ->where(['appctt_appcoursedtlstmp_fk' =>$course->appcoursedtlstmp_pk])
        ->asArray()->all();

        
            $counts = array();         
            foreach ($stafftmp as $item) {
                $appcoursetrnstmp_fk = explode(',', $item['appsit_appcoursetrnstmp_fk']);
                $roleforcourse = explode(',', $item['appsit_roleforcourse']);
                
                foreach ($appcoursetrnstmp_fk as $value) {
                    if (!isset($counts[$value])) {
                        $counts[$value] = array();
                    }
                    
                    foreach ($roleforcourse as $role) {
                        if (!isset($counts[$value][$role])) {
                            $counts[$value][$role] = 0;
                        }
                        
                        $counts[$value][$role]++;
                    }
                }
            }

            $newArray = array();

            foreach ($staffsubcat as $item) {
                $newKey = $item['coursecategorymst_pk'];
                $newArray[$newKey]['ccm_catname_en'] = $item['ccm_catname_en'];
                $newArray[$newKey]['ccm_catname_ar'] = $item['ccm_catname_ar'];
                $newArray[$newKey]['sccm_trainer'] = $item['sccm_trainer'];
                $newArray[$newKey]['sccm_assessor'] = $item['sccm_assessor'];
                $newArray[$newKey]['sccm_trainerandassessor'] = $item['sccm_trainerandassessor'];
                $newArray[$newKey]['sccm_programmanager'] = $item['sccm_programmanager'];
                $newArray[$newKey]['sccm_coursetype'] = $item['sccm_coursetype'];
                if (isset($counts[$item['appcoursetrnstmp_pk']])) {
                    foreach ($counts[$item['appcoursetrnstmp_pk']] as $countKey => $countValue) {
                        $newArray[$newKey][$countKey] = $countValue;
                    }
                }
            }
                    
          
           if($applicationtype == 2){
            $standerdcouredata = StandardcoursemstTbl::find()->where('standardcoursemst_pk = '. $course['appcdt_standardcoursemst_fk'])->asArray()->one();
             // 13 - Training , 14 - Assessment ,15 - Training & Assessment 
            //scm_assessmentin 17 -Different Centre 16 -Same Centre
                if($standerdcouredata['scm_assessmentin'] == 17){
                    if($course['appcdt_requestfor'] == 13){
                        foreach($newArray as $key=>$value){
                            $tuter_cnt = empty($value['sccm_trainer'])?$value['sccm_trainerandassessor']:$value['sccm_trainer'];
                            $assessor_cnt = empty($value['sccm_assessor'])?$value['sccm_trainerandassessor']:$value['sccm_assessor'];
                            $programmanager_cnt = $value['sccm_programmanager'];
    
                        if($value[12] >= $tuter_cnt){
                        
                            $newArray[$key]['status'.'_12'] = 'ok';
    
                        }else{
                            $newArray[$key]['remain'.'_12'] = abs($value[12]-$tuter_cnt);
                            $newArray[$key]['status'.'_12'] = 'notok';
                        }
                        
                    }
                    }elseif($course['appcdt_requestfor'] == 14){
                        foreach($newArray as $key=>$value){
                            $tuter_cnt = empty($value['sccm_trainer'])?$value['sccm_trainerandassessor']:$value['sccm_trainer'];
                            $assessor_cnt = empty($value['sccm_assessor'])?$value['sccm_trainerandassessor']:$value['sccm_assessor'];
                            $programmanager_cnt = $value['sccm_programmanager'];
    

                        if($value[13] >= $assessor_cnt){
                            $newArray[$key]['status'.'_13'] = 'ok';
    
                        }else{
                            $newArray[$key]['remain'.'_13'] = abs($value[13]-$assessor_cnt);
                            $newArray[$key]['status'.'_13'] = 'notok';
                        }
                        if($value[14] >= $programmanager_cnt){
                            $newArray[$key]['status'.'_14'] = 'ok';
    
                        }else{
                            $newArray[$key]['remain'.'_14'] = abs($value[14]-$programmanager_cnt);
                            $newArray[$key]['status'.'_14'] = 'notok';
                        }
                    }
                    }else{
                        foreach($newArray as $key=>$value){
                            $tuter_cnt = empty($value['sccm_trainer'])?$value['sccm_trainerandassessor']:$value['sccm_trainer'];
                            $assessor_cnt = empty($value['sccm_assessor'])?$value['sccm_trainerandassessor']:$value['sccm_assessor'];
                            $programmanager_cnt = $value['sccm_programmanager'];
    
                        if($value[12] >= $tuter_cnt){
                        
                            $newArray[$key]['status'.'_12'] = 'ok';
    
                        }else{
                            $newArray[$key]['remain'.'_12'] = abs($value[12]-$tuter_cnt);
                            $newArray[$key]['status'.'_12'] = 'notok';
                        }
                        if($value[13] >= $assessor_cnt){
                            $newArray[$key]['status'.'_13'] = 'ok';
    
                        }else{
                            $newArray[$key]['remain'.'_13'] = abs($value[13]-$assessor_cnt);
                            $newArray[$key]['status'.'_13'] = 'notok';
                        }
                        if($value[14] >= $programmanager_cnt){
                            $newArray[$key]['status'.'_14'] = 'ok';
    
                        }else{
                            $newArray[$key]['remain'.'_14'] = abs($value[14]-$programmanager_cnt);
                            $newArray[$key]['status'.'_14'] = 'notok';
                        }
                    }
                    }

                }else{
                foreach($newArray as $key=>$value){
                        $tuter_cnt = empty($value['sccm_trainer'])?$value['sccm_trainerandassessor']:$value['sccm_trainer'];
                        $assessor_cnt = empty($value['sccm_assessor'])?$value['sccm_trainerandassessor']:$value['sccm_assessor'];
                        $programmanager_cnt = $value['sccm_programmanager'];

                    if($value[12] >= $tuter_cnt){
                    
                        $newArray[$key]['status'.'_12'] = 'ok';

                    }else{
                        $newArray[$key]['remain'.'_12'] = abs($value[12]-$tuter_cnt);
                        $newArray[$key]['status'.'_12'] = 'notok';
                    }
                    if($value[13] >= $assessor_cnt){
                        $newArray[$key]['status'.'_13'] = 'ok';

                    }else{
                        $newArray[$key]['remain'.'_13'] = abs($value[13]-$assessor_cnt);
                        $newArray[$key]['status'.'_13'] = 'notok';
                    }
                    if($value[14] >= $programmanager_cnt){
                        $newArray[$key]['status'.'_14'] = 'ok';

                    }else{
                        $newArray[$key]['remain'.'_14'] = abs($value[14]-$programmanager_cnt);
                        $newArray[$key]['status'.'_14'] = 'notok';
                    }
                }
            }
           }else{
            $customizedcourseconfig =StaffcourseconfigmstTbl::find()->where(['sccm_coursetype'=>2])->asArray()->one();
            $tuter_cnt = empty($customizedcourseconfig['sccm_trainer'])?$customizedcourseconfig['sccm_trainerandassessor']:$customizedcourseconfig['sccm_trainer'];
            $assessor_cnt = empty($customizedcourseconfig['sccm_assessor'])?$customizedcourseconfig['sccm_trainerandassessor']:$customizedcourseconfig['sccm_assessor'];
            $programmanager_cnt = $customizedcourseconfig['sccm_programmanager'];
            foreach($newArray as $key=>$value){
             
                
            if($value[12] >= $tuter_cnt){
               
                $newArray[$key]['status'.'_12'] = 'ok';

            }else{
                $newArray[$key]['remain'.'_12'] = abs($value[12]-$tuter_cnt);
                $newArray[$key]['status'.'_12'] = 'notok';
            }
            if($value[13] >= $assessor_cnt){
                $newArray[$key]['status'.'_13'] = 'ok';

            }else{
                $newArray[$key]['remain'.'_13'] = abs($value[13]-$assessor_cnt);
                $newArray[$key]['status'.'_13'] = 'notok';
            }
            if($value[14] >= $programmanager_cnt){
                $newArray[$key]['status'.'_14'] = 'ok';

            }else{
                $newArray[$key]['remain'.'_14'] = abs($value[14]-$programmanager_cnt);
                $newArray[$key]['status'.'_14'] = 'notok';
            }
        }
           } 

           $isNotOkPresent = false;

            foreach ($newArray as $item) {
                if ($item['status_14'] === 'notok' || $item['status_12'] === 'notok' || $item['status_13'] === 'notok') {
                    $isNotOkPresent = true;
                    break;
                }
            }
// print_r($newArray);exit;

            if ($isNotOkPresent) {
                $string_en = '';
                $string_ar = '';
                $string_en .='
                <p style="min-height: 140px;">To proceed with the Desktop Review, it is necessary to ensure that the minimum required staff are added for all the selected course sub-categories. The table below displays the number of staff yet to be added under each category, based on the minimum staff requirements. Kindly add the required staff members before proceeding further.</p><table border="1"  style="border-collapse: collapse; width: 100%;text-align: left;">';
               /*  $string_en .='<tr>';
                $string_en .='<th>Sub Category</th>';
                $string_en .='<th>Program Manager</th>';
                $string_en .='<th>Tutor/Instructor</th>';
                $string_en .='<th>Assessor</th>';
                $string_en .='</tr>'; */
                foreach ($newArray as $item) {
                    $ccmCatnameEn = '<tr>'.'<td style="padding:5px 10px">'.$item['ccm_catname_en'].'</td>';
                    $ccmCatnameAr = $item['ccm_catname_ar'];
                    $two_en = 'Tutor/Instructor';
                    $three_en = 'Assessor';
                    $four_en = 'Program Manager';
                    $two_ar = 'المدرب';
                    $three_ar = 'المقيَم';
                    $four_ar = 'مدير البرنامج';
                    $string_en .=$ccmCatnameEn;
                    $string_ar .=$ccmCatnameAr;
                    //$string_en .='<td>'.' needs '.'</td>' ;
                   
                    if ($item['status_14'] === 'notok') {
                        $string_en .= '<td style="padding:5px 10px">'.$item['remain_14'] . ' ' . $four_en .'</td>';
                        $string_ar .= $item['remain_14'] . ' ' . $four_ar . ', ';
                    }else{
                        $string_en .= '<td style="padding:5px 10px"> - </td>';
                    }
                    if ($item['status_12'] === 'notok') {
                        $string_en .= '<td style="padding:5px 10px">'.$item['remain_12'] . ' ' . $two_en .'</td>';
                        $string_ar .= $item['remain_12'] . ' ' . $two_ar . ', ';

                    }else{
                        $string_en .= '<td style="padding:5px 10px"> - </td>';
                    }
                    if ($item['status_13'] === 'notok') {
                        $string_en .= '<td style="padding:5px 10px">'.$item['remain_13'] . ' ' . $three_en . '</td>';
                        $string_ar .= $item['remain_13'] . ' ' . $three_ar . ', ';

                    }else{
                        $string_en .= '<td style="padding:5px 10px"> - </td>';
                    }
                    // $string_en .="<br>";
                    $string_en .="</tr>";
                }
                $string_en .='</table>';
                // Remove the last comma and space from the string
                $string_en = rtrim($string_en, ', ');
                $string_ar = rtrim($string_en, ', ');

                $status = 'notok';
                
            } else {
                $status = 'ok';
            }
// echo $string_en;exit;
            return['status'=>$status,'msg_en'=>$string_en,'msg_ar'=>$string_ar];

    }

        // $pkValues = array_column($staffsubcat, "coursecategorymst_pk");
        // $pkArray = array_map("intval", $pkValues);
        // $categorys = implode(",",$pkArray);

        // $standardcoursedtls = StandardcoursedtlsTbl::find()
        // ->select(['sccm_trainer','sccm_assessor','sccm_trainerandassessor','sccm_programmanager'])
        // ->leftJoin('staffcourseconfigmst_tbl','sccm_standardcoursedtls_fk = standardcoursedtls_pk')
        // ->where('scd_subcoursecategorymst_fk in ('.$categorys.')')->asArray()->all();

        // $subcatarr=[];
        // foreach($staffsubcat as $data){
        //     array_push($subcatarr,[$data['appcoursetrnstmp_pk'] => $data['coursecategorymst_pk']]);
        // }
            
        // $counts = [];
        //     foreach ($stafftmp as $item) {
        //         $roles = explode(",", $item["appsit_roleforcourse"]);
        //         foreach ($roles as $role) {
        //             if (!isset($counts[$role])) {
        //                 $counts[$role] = 0;
        //             }
        //             $counts[$role]++;
        //         }
        //     }

  public function actionGetstaffcivilid(){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);

    $staffinfo = StaffinforepoTbl::find()
    ->select(['staffinforepo_pk','sir_idnumber','sir_name_en','sir_name_ar','sir_emailid','sir_dob','sir_gender','sir_nationality',
    'sir_addrline1','sir_addrline2','sir_opalstatemst_fk','sir_opalcitymst_fk','appsim_contracttype','appsim_jobtitle','appsim_mainrole','sir_moheridoc'])
    ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sir_opalstatemst_fk')
    ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sir_opalcitymst_fk')
    ->leftJoin('appstaffinfomain_tbl','appsim_staffinforepo_fk = staffinforepo_pk')
    ->andWhere('appsim_opalmemberregmst_fk = "' . $regPk . '"  and sir_type = 1  and appsim_appinstinfomain_fk ='.$data['institutepk'] )
    ->asArray()->all();

    foreach($staffinfo as $key => $staff){
        $role = explode(',',$staff['appsim_mainrole']);
        $staffinfo[$key]['appsim_mainrolearr'] = $role;
    }
  

    return ['staffinfo'=> $staffinfo ];
  }

 

  public function actionGetdocmstdata(){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);
    $standorcustom = $data['standorcustom'];

    if($standorcustom == 'standard'){
    $docmst = DocumentdtlsmstTbl::find()
    ->select(['documentdtlsmst_pk','ddm_documentname_en','ddm_documentname_ar','ddm_mandatestatus','ddm_projectmst_fk','ddm_status'])
    ->Where('ddm_projectmst_fk = 2  and ddm_status = 1 ')
    ->andWhere(['ddm_standardcoursemst_fk'=>$data['standpk'],'ddm_requestfor'=>$data['reqfor']])
    ->asArray()
    ->All();
    }else{
        $docmst = DocumentdtlsmstTbl::find()
        ->select(['documentdtlsmst_pk','ddm_documentname_en','ddm_documentname_ar','ddm_mandatestatus','ddm_projectmst_fk','ddm_status'])
        ->Where('ddm_projectmst_fk = 3  and ddm_status = 1 ')
        ->asArray()
        ->All();
    }

    $total = count($docmst);

    return ['docmst'=> $docmst ,'total'=> $total  ];
  }
  public function actionGetdocumentdata(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);
   

    $data = AppdocsubmissiontmpTbl::find()
         ->select(['documentdtlsmst_pk','ddm_documentname_en','ddm_documentname_ar','ddm_mandatestatus','appdst_status','ddm_projectmst_fk','ddm_status','appdocsubmissiontmp_pk','appdst_submissionstatus',
         'appdst_memcompfiledtls_fk','appdst_remarks','appdst_submissionstatus','DATE_FORMAT(appdst_appdecon,"%d-%m-%Y") AS appdst_appdecon','oum_firstname','appdst_appdeccomment'])
         ->leftJoin('documentdtlsmst_tbl','documentdtlsmst_pk = appdst_documentdtlsmst_fk')
         ->leftJoin('opalusermst_tbl','opalusermst_pk = appdst_appdecby')
         ->Where('appdst_applicationdtlstmp_fk = '.$requestdata['pk'])
         ->asArray()
         ->All();

         $total = count($data);
         $datapresented = 'yes';
         if(empty($data)){
            $datapresented = 'no';

            if($requestdata['type'] == 2){
                $data = DocumentdtlsmstTbl::find()
                ->select(['documentdtlsmst_pk','ddm_documentname_en','ddm_documentname_ar','ddm_mandatestatus','ddm_projectmst_fk','ddm_status'])
                ->Where('ddm_projectmst_fk = 2  and ddm_status = 1 ')
                ->andWhere(['ddm_standardcoursemst_fk'=>$requestdata['coursefk'],'ddm_requestfor'=>$requestdata['reqfor']])
                ->asArray()
                ->All();
                }else{
                    $data = DocumentdtlsmstTbl::find()
                    ->select(['documentdtlsmst_pk','ddm_documentname_en','ddm_documentname_ar','ddm_mandatestatus','ddm_projectmst_fk','ddm_status'])
                    ->Where('ddm_projectmst_fk = 3  and ddm_status = 1 ')
                    ->asArray()
                    ->All();
                }
         }
         $total = count($data);

         return ['docmst'=> $data ,'total'=> $total,'datapresented'=>$datapresented  ];
  }

  public function actionGetroleforcourse(){
    $request_body = file_get_contents('php://input');
    $requestdata = json_decode($request_body, true);

    $appliactiondata = ApplicationdtlstmpTbl::find()
    ->select(['*'])
    ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
    ->where('applicationdtlstmp_pk = '.$requestdata['pk'])->asArray()->one();
    // 13 - Training , 14 - Assessment ,15 - Training & Assessment 
    //scm_assessmentin 17 -Different Centre 16 -Same Centre
    if($appliactiondata['appdt_projectmst_fk'] == 2){
        $standerdcouredata = StandardcoursemstTbl::find()->where('standardcoursemst_pk = '. $appliactiondata['appcdt_standardcoursemst_fk'])->asArray()->one();
        if($standerdcouredata['scm_assessmentin'] == 17){
            if($appliactiondata['appcdt_requestfor'] == 13){
                $rolemst= RolemstTbl::find()
                ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
                ->andWhere('rolemst_pk not in (13,14)')
                ->asArray()->All();
            }elseif($appliactiondata['appcdt_requestfor'] == 14){
                $rolemst= RolemstTbl::find()
                ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
                ->andWhere('rolemst_pk not in (12)')
                ->asArray()->All();
            }elseif($appliactiondata['appcdt_requestfor'] == 15){
                $rolemst= RolemstTbl::find()
                ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
                ->asArray()->All();
            }else{
                $rolemst= RolemstTbl::find()
                ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
                ->asArray()->All();
            }
        }else{
            $rolemst= RolemstTbl::find()
                ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
                ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
                ->asArray()->All();
        }
      
    }else{
        $rolemst= RolemstTbl::find()
        ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar'])
        ->where(['rm_projectmst_fk' =>1,'rm_status'=>1])
        ->asArray()->All();
    }

  

    return ['roleforcourse'=> $rolemst   ];
  }
    public function actionGetstaffdetails(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $key = $data['key'];

        $staffinfo = StaffinforepoTbl::find()
        ->select(['sir_name_en','sir_name_ar','sir_emailid','sir_dob','sir_gender','sir_nationality'])
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sir_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sir_opalcitymst_fk')
        ->andWhere('sir_idnumber = "' . $key . '"')
        ->asArray()
        ->one();

        $stsff_accadamic = StaffacademicsTbl::find()
        ->andWhere('sacd_staffinforepo_fk = "' . $staffinfo['staffinforepo_pk'] . '"')
        ->asArray()
        ->all();

        $stsff_experience = StaffworkexpTbl::find()
        ->andWhere('sexp_staffinforepo_fk = "' . $staffinfo['staffinforepo_pk'] . '"')
        ->asArray()
        ->all();
        print_r($staffinfo);
        exit;
    }
    function staffstschange($pk){
        
        $appsta = AppstaffinfotmpTbl::find()
        ->where(['appsit_applicationdtlstmp_fk' => $pk])
        ->asArray()->all();
        $appliactiondata = ApplicationdtlstmpTbl::find()
        ->select(['*'])
        ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->where('applicationdtlstmp_pk = '.$pk)->asArray()->one();

        if(!empty($appsta)){
        foreach($appsta as $app){
            $appstaf = AppstaffinfotmpTbl::find()
            ->where(['appostaffinfotmp_pk' => $app['appostaffinfotmp_pk']])
            ->one();
            $comptcard = AppstaffinfotmpTbl::find()
            ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' 
            when appsit_iscarddetails = 1 then '4'
            when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
            ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
            ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
            if($appliactiondata['appdt_projectmst_fk'] == 2){
                $comptcard->where(['scch_standardcoursemst_fk'=>$appliactiondata['appcdt_standardcoursemst_fk']]);
            }else{
                $comptcard->where(['scch_appoffercoursemain_fk'=>$appliactiondata['appcdt_appoffercoursemain_fk']]);

            }
            $comptcard->andWhere(['appostaffinfotmp_pk'=> $app['appostaffinfotmp_pk']]);
            $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
            $compt =  $comptcard->asArray()->one();
            $comptancycard = empty($compt['competcard'])?'1':$compt['competcard'];
            if($comptancycard == 3){
                $appstaf->appsit_iscarddetails = 3;
            }
            $appstaf->appsit_status = 1;
            $appstaf->save();
            

        }
    }

    
    }
    public function actionSubmitdesktoreview(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $pk =$data['data'];
     
        $modelmain = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '.$pk)->one();
        if($data['apptype'] == 'update'){
           
            if($modelmain->appdt_status == 17){
             
                $modelmain->appdt_apptype = 3;
            }else{
                // $modelmain->appdt_apptype = 1;
            }
           
        }else if($data['apptype'] == 'renew'){
            $modelmain->appdt_apptype = 2;
            self::staffstschange($pk);
         
        }
        if($modelmain->appdt_status == 1){
            $modelmain->appdt_status = 2;
            $modelmain->appdt_submittedon =  date("Y-m-d H:i:s");
            $modelmain->appdt_submittedby = $userPk;
            $modelmain->appdt_updatedon = date("Y-m-d H:i:s");
            $modelmain->appdt_updatedby = $userPk;
        }elseif($modelmain->appdt_status == 3){
            $modelmain->appdt_status = 4;
            $modelmain->appdt_updatedon = date("Y-m-d H:i:s");
            $modelmain->appdt_updatedby = $userPk;
        }elseif($modelmain->appdt_status == 17){
            $modelmain->appdt_status = 2;
            $modelmain->appdt_updatedon = date("Y-m-d H:i:s");
            $modelmain->appdt_updatedby = $userPk;
        }
      
      
        if($modelmain->save()){
            \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
            ->bindValue(':p1' , $modelmain->applicationdtlstmp_pk)
            ->bindValue(':p2' , '')
            ->bindValue(':p3' , 2)
            ->execute();
        //    $dtlspk =  \Yii::$app->db->createCommand("select * from projapprovalworkflowhrd_tbl;
        //     select projapprovalworkflowhrd_pk,projapprovalworkflowdtls_pk,projapprovalworkflowuserdtls_pk  from projapprovalworkflowhrd_tbl
        //     left join projapprovalworkflowdtls_tbl on pawfd_projapprovalworkflowhrd_fk  = projapprovalworkflowhrd_pk
        //     left join projapprovalworkflowuserdtls_tbl on pawfud_projapprovalworkflowdtls_fk = projapprovalworkflowdtls_pk
        //     where pawfh_projectmst_fk =  $modelmain->appdt_projectmst_fk and pawfh_formstatus =1 and pawfh_status= 1 ;")
        //     ->one();
        $staffdata = AppstaffinfotmpTbl::find()->select(['group_concat(appsit_status) as status','group_concat(appsit_iscarddetails) as cardstatus'])
        ->where(['appsit_applicationdtlstmp_fk'=>$pk])->asArray()->one();
        $status =explode(',',$staffdata['status']);
        $isstatus =explode(',',$staffdata['cardstatus']);
        if($data['apptype'] == 'new' || $data['apptype'] == 'edit'){
            $apptype = 1;
            }
            if($data['apptype'] == 'update'){
                if(in_array(1,$status) || in_array(1,$isstatus)){
                    $apptype = 3;
                    }else{
                        $apptype = 2;
                    }
            }
            if($data['apptype'] == 'renew'){
                $apptype = 4;
            }
           
        $info = SiteAudit::getApprovalHdrInfo($modelmain->appdt_projectmst_fk, $apptype, 2);
        $modelhdr = new AppapprovalhdrTbl;
        $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];;
        $modelhdr->aah_projapprovalworkflowdtls_fk =  $info['projapprovalworkflowdtls_pk'];;
        $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
        $modelhdr->aah_applicationdtlstmp_fk = $modelmain->applicationdtlstmp_pk;
        $modelhdr->aah_formstatus =  $apptype;
        $modelhdr->aah_status = null;
        $modelhdr->save();
        // if(!$modelhdr->save()){
        //     var_dump($modelhdr->getErrors());exit;
        // }

        }else{
            var_dump($modelmain->getErrors());
            exit; 
        }
        $apptmpPk = $modelmain->applicationdtlstmp_pk;
        $appstatus = $modelmain->appdt_status;
        $apptyp = $modelmain->appdt_apptype;
        $projpk = $modelmain->appdt_projectmst_fk;
        
        if($projpk==2){
            
     

            $command = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 1 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 2 AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk
            ");
            $command->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
            $desrwmail = $command->queryAll();
 
        $id = [];
        $name = [];   
        
                foreach ($desrwmail as $row) {
                     $id = $row['oum_emailid'];
                     $name = $row['oum_firstname'];
                        if($apptyp == 1 && $appstatus ==2 && $projpk ==2 || $projpk ==3 ){
                        \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'courdesk');  
                        }elseif($apptyp == 1 && $appstatus ==4 && $projpk ==2 || $projpk ==3 ){
                        \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'recourdesk');     
                        }
                }
         
        }
        
        
         if($projpk==3){
            $desrwmail = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
           ->select(['oum_emailid', 'oum_firstname'])
           ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
           ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
           ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
           ->where(['pawfh_formstatus' => 1, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 2 ,'oum_status' => 'A'])
            ->groupBy(['opalusermst_pk'])
           ->asArray()
           ->all();
            $id = [];
            $name = [];   
                foreach ($desrwmail as $row) {
                     $id = $row['oum_emailid'];
                     $name = $row['oum_firstname'];
                if($apptyp == 1 && $appstatus ==2 && $projpk ==2 || $projpk ==3 ){
                \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'courdesk');  
                }elseif($apptyp == 1 && $appstatus ==4 && $projpk ==2 || $projpk ==3 ){
                \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'recourdesk');     
                }
                }
        } 
       
        
         if($projpk==2){

                 $commanda = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 4 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 2 AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk
            ");
            $commanda->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
            $rendesrwmail = $commanda->queryAll();   
             
             
        $id = [];
        $name = [];   
        
                    foreach ($rendesrwmail as $renrow) {
                         $id = $renrow['oum_emailid'];
                         $name = $renrow['oum_firstname'];
                            if($apptyp == 2 && $appstatus ==2 && $projpk ==2|| $projpk ==3 ){
                            \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'rencourdesk');  
                            }elseif($apptyp == 2 && $appstatus ==4 && $projpk ==2 || $projpk ==3){
                            \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'renrecourdesk');     
                            }
                    }   
         }
        
        
         if($projpk==3){
        $rendesrwmail = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
       ->select(['oum_emailid', 'oum_firstname'])
       ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
       ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
       ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
       ->where(['pawfh_formstatus' => 4, 'pawfh_projectmst_fk' => [2, 3] , 'pawfd_rolemst_fk' => 2 , 'oum_status' => 'A'])
       ->groupBy(['opalusermst_pk'])
       ->asArray()
       ->all();
        $id = [];
        $name = [];   
        
                    foreach ($rendesrwmail as $renrow) {
                         $id = $renrow['oum_emailid'];
                         $name = $renrow['oum_firstname'];
                            if($apptyp == 2 && $appstatus ==2 && $projpk ==2|| $projpk ==3 ){
                            \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'rencourdesk');  
                            }elseif($apptyp == 2 && $appstatus ==4 && $projpk ==2 || $projpk ==3){
                            \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'renrecourdesk');     
                            }
                    }   
         }
         
            if($projpk==2){ 
        
                    $commandb = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus in  (2,3) AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 2 AND applicationdtlstmp_pk = :apptmpPk
                GROUP BY opalusermst_pk
            ");
            $commandb ->bindParam(':apptmpPk', $apptmpPk, \PDO::PARAM_INT);
            $upddesrwmail = $commandb ->queryAll();  

                $id = [];
                $name = [];   
            
       
                    foreach ($upddesrwmail as $updrow) {
                            $id = $updrow['oum_emailid'];
                            $name = $updrow['oum_firstname'];
                               if($apptyp == 3 && $appstatus ==2 && $projpk ==2 || $projpk ==3){
                               \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'updcourdesk');  
                               }elseif($apptyp == 3 && $appstatus ==4 && $projpk ==2 || $projpk ==3){
                                 \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'reupdcourdesk');     
                               }
                    }
            } 
         
         
         
         
            if($projpk==3){ 
        
                $upddesrwmail = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
               ->select(['oum_emailid', 'oum_firstname'])
               ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
               ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
               ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
               ->where(['pawfh_formstatus' => [2,3], 'pawfh_projectmst_fk' => [2, 3] , 'pawfd_rolemst_fk' => 2 ,'oum_status' => 'A'])
               ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];   
            
       
                    foreach ($upddesrwmail as $updrow) {
                            $id = $updrow['oum_emailid'];
                            $name = $updrow['oum_firstname'];
                               if($apptyp == 3 && $appstatus ==2 && $projpk ==2 || $projpk ==3){
                               \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'updcourdesk');  
                               }elseif($apptyp == 3 && $appstatus ==4 && $projpk ==2 || $projpk ==3){
                                 \api\components\Mail::sprcourseDtls($apptmpPk,$regPk,$id,$name,'reupdcourdesk');     
                               }
                    }
            }    

        return true;
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
    //desktop review 
    public function actionFinalcerificategeneration(){
       //$applicatonpk = 1154;
       $applicatonpk =77;
        // $ckeckfinalauthorityapproval = appapprovalhdrtbl::find()->where('aah_status =1 and aah_applicationdtlstmp_fk = '.$applicatonpk)
        // ->orderBy(['appapprovalhdr_pk' => SORT_DESC])->asArray()->one();

        // $finalauthoriy = ProjapprovalworkflowdtlsTbl::find()->where('projapprovalworkflowdtls_pk = '.$ckeckfinalauthorityapproval['aah_projapprovalworkflowdtls_fk'])
        //  ->orderBy(['projapprovalworkflowdtls_pk' => SORT_DESC])->asArray()->one(); 

       //$finalauthoriy['pawfh_Isfinalauthority'] ==
        if( 1){
            $applictioninfo = ApplicationdtlstmpTbl::find()
            ->select(['applicationdtlstmp_tbl.*','appcoursedtlstmp_tbl.*','reqfor.rm_name_en'])
            ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
            ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
            ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();

            $year  = OpalInvoiceTbl::find()
                ->select(['feesubscriptionmst_tbl.*'])
                ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
                ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
                ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
            $companyinfo = OpalmemberregmstTbl::find()
            ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
            ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
            ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
            ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                ->asArray()->one();
           

            if(empty($applictioninfo['appdt_verificationno'])){
                $varificationcode = 'TPC'.$this->generateRandomString();
            }else{
                $varificationcode = $applictioninfo['appdt_verificationno'];
            }
            if(empty($applictioninfo['appdt_certificateexpiry'])){
               
                $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
                $end = date('Y-m-d', strtotime($increasedate));
                $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end)); 

            }else{
               
                $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
                $end = date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry'].$increasedate));
                $end = date('Y-m-d', strtotime($end . ' -1 day'));
                $end_format = date("d-m-Y", strtotime($end)); 
                
            }
        
            $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];  
           // $applictioninfo['appdt_projectmst_fk']  = 2;    
            if($applictioninfo['appdt_projectmst_fk'] == 2){
                $cousre_list = StandardcoursemstTbl::find()->where('standardcoursemst_pk = '. $applictioninfo['appcdt_standardcoursemst_fk'])->asArray()->one();
                if($applictioninfo['appcdt_standardcoursemst_fk'] = 1){
                    $text = 'is an approved OPAL STAR Provider <br> to deliver and Assess for the Unified Defensive Driving Training as per the provisions  of the OPAL Road safety Standard.';
                }elseif($applictioninfo['appcdt_standardcoursemst_fk'] = 2){
                    $text = 'is an approved OPAL STAR Provider <br> to deliver and assess for the Unified HSE Training as per the provisions of  OPAL Unified HSE Passport Training and Assessment Standard.';
                }elseif($applictioninfo['appcdt_standardcoursemst_fk'] = 3){
                    $text = 'is an approved OPAL STAR Provider <br> to deliver and Assess for the Unified Safe Journey Management Training as per the provisions of the OPAL Road safety Standard.';
                }
                // $text = 'is an approved OP$text = 'is an approved OPAL STAR Provider <br> to deliver and assess for the '.$cousre_list['scm_coursename_en'].' as per the provisions <br> of OPAL '.$cousre_list['scm_coursename_en'].' '.$applictioninfo['rm_name_en'].' Standard.';AL STAR Provider <br> to deliver and assess for the '.$cousre_list['scm_coursename_en'].' as per the provisions <br> of OPAL '.$cousre_list['scm_coursename_en'].' '.$applictioninfo['rm_name_en'].' Standard.';
            }else{
                $cousre_list = AppoffercoursemainTbl::find()->where('appoffercoursemain_pk = '. $applictioninfo['appcdt_appoffercoursemain_fk'])->asArray()->one();
                $text = 'is an approved OPAL STAR Provider <br> to deliver and assess for the '.$cousre_list['appocm_coursename_en'].' as per the provisions <br> of OPAL Customized Course '.$cousre_list['appocm_coursename_en'] .'    '.     $applictioninfo['rm_name_en']. ' Standard.';
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
            $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_tpname_en']  . ' </div>', 50, 88, 200, 20);
            
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
      
        }else{
            return 'fail';
        }
        exit;


    }
   	 public function actionGetbatchids(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $repopk = AppstaffinfotmpTbl::find()
        ->where('appostaffinfotmp_pk = '.$data['staffinfotmppk'])
        ->asArray()->one();
        $userpk =  OpalusermstTbl::find()
        ->where('oum_staffinforepo_fk = '.$repopk['appsit_staffinforepo_fk'])
        ->asArray()->one();

        $usrpk =  $userpk['opalusermst_pk'];

        $BatchmgmtasmthdrTbl = BatchmgmtasmthdrTbl::find()
        ->where('bmah_status != 3 and  bmah_assessor = '. $usrpk.' and bmah_assessmentdate = '.'"'.$data['date'].'"')
        ->asArray()->all();
        
        $BatchmgmtthyhdrTbl = BatchmgmtthyhdrTbl::find()
        ->where('bmth_status != 3 and  bmth_tutor = '. $usrpk.' and bmth_startdate = '.'"'.$data['date'].'"')
        ->asArray()->all();

        $BatchmgmtpracthdrTbl = BatchmgmtpracthdrTbl::find()
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
    public function actionSuspend(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $applioctionpk = $data['applicationpk'];
        $apptmpPk = $data['applicationpk'];
        $modelmain = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '. $applioctionpk)->one();
        $modelmain->appdt_status = 19;
       if(!$modelmain->save()){
         return $modelmain->getErrors();
       }else{
       \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
       ->bindValue(':p1' , $modelmain->applicationdtlstmp_pk)
       ->bindValue(':p2' , '')
       ->bindValue(':p3' , 2)
       ->execute();
       
       
         if($appStatus == 19 && $appType ==2){
           \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'suspensioncour');
         }
        
       
       
       
       
        return true;
       }

    }
    public function actionActivate(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $applioctionpk = $data['applicationpk'];
        $apptmpPk = $data['applicationpk'];
        $modelmain = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '. $applioctionpk)->one();
        $modelmain->appdt_status = 17;
       if(!$modelmain->save()){
         return $modelmain->getErrors();
       }else{
       \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
       ->bindValue(':p1' , $modelmain->applicationdtlstmp_pk)
       ->bindValue(':p2' , '')
       ->bindValue(':p3' , 2)
       ->execute();
       
       
         if($appStatus == 17 && $appType ==2){
           \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'activationmail');
         }
        
   
          return true;
       }

    }
    public function actionUpdateinternational(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'Please click on the Check Box and proceed further',
        );
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       
        foreach($formdata['appdtlstmp_id'] as $interId){
        if($interId){
            $model = AppintrecogtmpTbl::find()->where("appintrecogtmp_pk =:pk", [':pk' => $interId])->one();
            if($model){
                $model->appintit_status =  (int)$formdata['select_valitate'];
                $model->appintit_appdeccomment = strval($formdata['comments']);
                $model->appintit_appdecby = $userPk;
                $model->appintit_appdecon =  date("Y-m-d H:i:s");

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $formdata['select_valitate'],
                        'comments' => 'Status Updated Successfully!'
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
    }
    
    return $result;
    
    }

   
    public function actionUpdatecontract(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'Please click on the Check Box and proceed further',
        );
       
        foreach($formdata['appdtlstmp_id'] as $interId){
        if($interId){
            $model = AppoprcontracttmpTbl::find()->where("appoprcontracttmp_pk =:pk", [':pk' => $interId])->one();
           
            if($model){
                $model->appoprct_status =  (int)$formdata['select_valitate'];
                $model->appoprct_appdeccomment = strval($formdata['comments']);
                $model->appoprct_appdecon = date("Y-m-d H:i:s");
                $model->appoprct_appdecby = $userPk;

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $formdata['select_valitate'],
                        'comments' => 'Status Updated Successfully!'
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
    }
    
    return $result;
    
    }  

    public function actionGetinvdtls(){

        $response = [];
        $data = \app\models\ApppytminvoicedtlsTbl::getInvDtls($_REQUEST);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',
            ];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',
            ]; 
        }
        
        return $this->asJson($response);
    }

    public function actionInvoiceview(){
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $response = [];
        $data = \app\models\ApppytminvoicedtlsTbl::getInvoiceview($formdata);
        if($data){
            $response = ['status' => 1,'data' => $data,'msg' => 'Success',];
        } else{
           $response = ['status' => 2,'data' => '','msg' => 'Failure',]; 
        }
        
        return $this->asJson($response);
    }

    public function actionExportdata(){
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $showColumn = $formdata['showColumn'];
        $formdata['excel'] = 1;
        $response = [];
        $data = \app\models\ApppytminvoicedtlsTbl::getInvDtls($formdata);
        
        $srcUrl = \Yii::$app->params['srcDirectory'];
        $folder=$srcUrl.'web/exports/invice/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        
        $date = date('Y-m-d H:i:s');
        $time = strtotime($date);
        $exeFileName='CourseInvoice_'.$time;        
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
            $value .= '<table>
                        <tr >
                            <td colspan="1" rowspan="5" align="center">
                                <img width="120" height="120" alt="opal_logo" src="'.\Yii::$app->params['backendBaseUrl'].'/dev/src/assets/images/opalpdflogo.png">
                            </td>
                            <td colspan="3" rowspan="5" align="center">
                                <span style="font-size: 30px;">Course Certification</span>
                            </td>
                        </tr>
                        </table>';   
            //$value .= '<table><tr><td></td></tr></table>';  
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
                $value .= (in_array('apid_invoiceno',$showColumn)) ? '<th>Invoice Number</th>' : '';
                $value .= (in_array('pm_projectname_en',$showColumn)) ? '<th>Course Type</th>' : '';
                $value .= (in_array('omrm_companyname_en',$showColumn)) ? '<th>Company Name</th>' : '';
                $value .= (in_array('omrm_tpname_en',$showColumn)) ? '<th>Training Provider Name</th>' : '';
                $value .= (in_array('appiim_officetype',$showColumn)) ? '<th>Office Type</th>' : '';
                $value .= (in_array('appiim_branchname_en',$showColumn)) ? '<th>Branch Name</th>' : '';
                $value .= (in_array('omrm_opalmembershipregnumber',$showColumn)) ? '<th>OPAL Membership Number</th>' : '';
                $value .= (in_array('scm_coursename_en',$showColumn)) ? '<th>Course Title</th>' : '';
                $value .= (in_array('catstden',$showColumn)) ? '<th>Course Category</th>' : '';
                $value .= (in_array('subcaten',$showColumn)) ? '<th>Course Sub Category</th>' : '';
                $value .= (in_array('fsm_feestype',$showColumn)) ? '<th>Fee Type</th>' : '';
                $value .= (in_array('apid_noofstaffeval',$showColumn)) ? '<th>No. of staff Evaluated</th>' : '';
                $value .= (in_array('total',$showColumn)) ? '<th>Invoice Amount (OMR)</th>' : '';
                $value .= (in_array('apid_invoicestatus',$showColumn)) ? '<th>Status</th>' : '';
                $value .= (in_array('apid_paymenttype',$showColumn)) ? '<th>Payment Type</th>' : '';
                $value .= (in_array('invdate',$showColumn)) ? '<th>Invoice Date</th>' : '';
                $value .= (in_array('agedate',$showColumn)) ? '<th>Invoice Age</th>' : '';
                $value .= (in_array('pymtdate',$showColumn)) ? '<th>Payment Date</th>' : '';
            
                $value .= '</tr>';
                    $i=1;
                    foreach($data['data'] as $attend){
                            //Office Type
                            $ofType = "";
                            if($attend['appiim_officetype'] == '1'){
                                $ofType = "Main office";
                            }elseif($attend['appiim_officetype'] == '2'){
                                $ofType = "Branch office";
                            }

                            //Branch Name
                            $brName = "";
                            if($attend['appiim_officetype'] == '2'){
                                $brName = $attend['appiim_branchname_en'];
                            }

                            //Course Title
                            $curTle = "";
                            $curcat = "";
                            if(!empty($attend['appcdt_standardcoursemst_fk'])){
                                $curTle = $attend['scm_coursename_en'];
                                $curcat = $attend['catstden'];
                            }elseif(!empty($attend['appcdt_appoffercoursemain_fk'])){
                                $curTle = $attend['appocm_coursename_en'];
                                $curcat = $attend['catofren'];
                            }

                            //Fee Type
                            $feeType = "";
                            if($attend['fsm_feestype'] == '1'){
                                $feeType = "Certification Fee";
                            }elseif($attend['fsm_feestype'] == '2'){
                                $feeType = "Staff Evaluation Fee";
                            }elseif($attend['fsm_feestype'] == '3'){
                                $feeType = "Royalty Fee";
                            }elseif($attend['fsm_feestype'] == '4'){
                                $feeType = "Learner Training Fee";
                            }elseif($attend['fsm_feestype'] == '5'){
                                $feeType = "Learner Assessment Fee";
                            }elseif($attend['fsm_feestype'] == '6'){
                                $feeType = "Staff Re-Evaluation Fee";
                            }

                            $appType = "";
                            if($attend['fsm_applicationtype'] == '1'){
                                $appType = "(Initial)";
                            }elseif($attend['fsm_applicationtype'] == '2'){
                                $appType = "(Renewal)";
                            }elseif($attend['fsm_applicationtype'] == '3'){
                                $appType = "(Update)";
                            }elseif($attend['fsm_applicationtype'] == '4'){
                                $appType = "(Refresher)";
                            }elseif($attend['fsm_applicationtype'] == '5'){
                                $appType = "(Surveillance 1)";
                            }elseif($attend['fsm_applicationtype'] == '6'){
                                $appType = "(Surveillance 2)";
                            }

                            //Status
                            $status = "";
                            if($attend['apid_invoicestatus'] == '1'){
                                $status = "Pending";
                            }elseif($attend['apid_invoicestatus'] == '2'){
                                $status = "Paid - Verification Pending";
                            }elseif($attend['apid_invoicestatus'] == '3'){
                                $status = "Approved";
                            }elseif($attend['apid_invoicestatus'] == '4'){
                                $status = "Declined";
                            }

                            //Payment Type
                            $payType = "";
                            if($attend['apid_paymenttype'] == '1'){
                                $payType = "Online";
                            }elseif($attend['apid_paymenttype'] == '2'){
                                $payType = "Offline";
                            }

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
                            $value .= (in_array('apid_invoiceno',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_invoiceno"] ? $attend["apid_invoiceno"] : "-").'</td>' : '';
                            $value .= (in_array('pm_projectname_en',$showColumn)) ? '<td valing="top">'.(string)($attend["pm_projectname_en"] ? $attend["pm_projectname_en"] : "-").'</td>' : '';
                            $value .= (in_array('omrm_companyname_en',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_companyname_en"] ? $attend["omrm_companyname_en"] : "-").'</td>' : '';
                            $value .= (in_array('omrm_tpname_en',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_tpname_en"] ? $attend["omrm_tpname_en"] : "-").'</td>' : '';
                            $value .= (in_array('appiim_officetype',$showColumn)) ? '<td valing="top">'.(string)($ofType ? $ofType : "-").'</td>' : '';
                            $value .= (in_array('appiim_branchname_en',$showColumn)) ? '<td valing="top">'.(string)($brName ? $brName : "-").'</td>' : '';
                            $value .= (in_array('omrm_opalmembershipregnumber',$showColumn)) ? '<td valing="top">'.(string)($attend["omrm_opalmembershipregnumber"] ? $attend["omrm_opalmembershipregnumber"] : "-").'</td>' : '';
                            $value .= (in_array('scm_coursename_en',$showColumn)) ? '<td valing="top">'.(string)($curTle ? $curTle : "-").'</td>' : '';
                            $value .= (in_array('catstden',$showColumn)) ? '<td valing="top">'.(string)($curcat ? $curcat : "-").'</td>' : '';
                            $value .= (in_array('subcaten',$showColumn)) ? '<td valing="top">'.(string)($attend["subcaten"] ? $attend["subcaten"] : "-").'</td>' : '';
                            $value .= (in_array('fsm_feestype',$showColumn)) ? '<td valing="top">'.(string)($feeType ? $feeType : "-").(string)$appType.'</td>' : '';
                            $value .= (in_array('apid_noofstaffeval',$showColumn)) ? '<td valing="top">'.(string)($attend["apid_noofstaffeval"] ? $attend["apid_noofstaffeval"] : "-").'</td>' : '';
                            $value .= (in_array('total',$showColumn)) ? '<td valing="top">'.$amtVal.' &nbsp</td>' : '';
                            $value .= (in_array('apid_invoicestatus',$showColumn)) ? '<td valing="top">'.(string)($status ? $status : "-").'</td>' : '';
                            $value .= (in_array('apid_paymenttype',$showColumn)) ? '<td valing="top">'.(string)($payType ? $payType : "-").'</td>' : '';
                            $value .= (in_array('invdate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["invdate"] ? $attend["invdate"] : "-").'</td>' : '';
                            $value .= (in_array('agedate',$showColumn)) ? '<td valing="top">'.(string)($agedate ? $agedate : "-").'</td>' : '';
                            $value .= (in_array('pymtdate',$showColumn)) ? '<td valing="top" class="date">'.(string)($attend["pymtdate"] ? $attend["pymtdate"] : "-").'</td>' : '';
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
            $return['attend'] = \Yii::$app->urlManager->createAbsoluteUrl(['/cm/coursemanagement/downloaddata?filename='.\api\components\Security::encrypt($exeFileName)]);
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


    public function actionGetaccessproject()
    {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
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
        $data = ($accessproject)?true:false;
        return $data;   
     }
    
}