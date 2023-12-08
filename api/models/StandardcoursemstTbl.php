<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\FeesubscriptionmsthstyTbl;
use app\models\FeeSubscriptionmstTbl;

/**
 * This is the model class for table "standardcoursemst_tbl".
 *
 * @property int $standardcoursemst_pk
 * @property int $scm_projectmst_fk reference to projectmst_pk
 * @property int $scm_opalmemberregmst_fk reference to opalmemberregmst_pk
 * @property int $scm_coursetype 1-Standard Course, 2-Customized Course, by default 2. If course created by opalstkholdertypmst_pk = 1 then 1 if opalstkholdertypmst_pk = 2 then 2
 * @property int $scm_appoffercoursemain_fk Reference to appoffercoursemain_pk, not null when scm_coursettype=2 else NULL
 * @property string $scm_coursename_en
 * @property string $scm_coursename_ar
 * @property int $scm_assessmentin Reference to referencemst_pk where rm_mastertype=14
 * @property int $scm_requestfor 1-Training, 2-Assessment, 3-Training & Assessment, by default 1
 * @property int $scm_courselevel Reference to referencemst_pk where rm_mastertype=3
 * @property int $scm_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $scm_status 1-Active, 2-Inactive, 3-suspend if no more training providers allowed to register for the course approval
 * @property string $scm_createdon
 * @property int $scm_createdby
 * @property string $scm_updatedon
 * @property int $scm_updatedby
 *
 * @property AppcoursedtlshstyTbl[] $appcoursedtlshstyTbls
 * @property AppcoursedtlsmainTbl[] $appcoursedtlsmainTbls
 * @property AppcoursedtlstmpTbl[] $appcoursedtlstmpTbls
 * @property AssessmentmstTbl[] $assessmentmstTbls
 * @property FeedbackmstTbl[] $feedbackmstTbls
 * @property StandardcoursedtlsTbl[] $standardcoursedtlsTbls
 * @property AppoffercoursemainTbl $scmAppoffercoursemainFk
 * @property CoursecategorymstTbl $scmCoursecategorymstFk
 * @property OpalmemberregmstTbl $scmOpalmemberregmstFk
 * @property ProjectmstTbl $scmProjectmstFk
 */
class StandardcoursemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'standardcoursemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scm_projectmst_fk', 'scm_opalmemberregmst_fk', 'scm_coursetype', 'scm_coursename_en', 'scm_coursename_ar', 'scm_assessmentin', 'scm_courselevel', 'scm_coursecategorymst_fk', 'scm_status', 'scm_createdby'], 'required'],
            [['scm_projectmst_fk', 'scm_opalmemberregmst_fk', 'scm_coursetype', 'scm_appoffercoursemain_fk', 'scm_assessmentin', 'scm_courselevel', 'scm_coursecategorymst_fk', 'scm_status', 'scm_createdby', 'scm_updatedby'], 'integer'],
            [['scm_createdon', 'scm_updatedon'], 'safe'],
            [['scm_coursename_en', 'scm_coursename_ar','scm_requestfor'], 'string', 'max' => 255],
            [['scm_appoffercoursemain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['scm_appoffercoursemain_fk' => 'appoffercoursemain_pk']],
            [['scm_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['scm_coursecategorymst_fk' => 'coursecategorymst_pk']],
            [['scm_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['scm_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['scm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['scm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'standardcoursemst_pk' => 'Standardcoursemst Pk',
            'scm_projectmst_fk' => 'Scm Projectmst Fk',
            'scm_opalmemberregmst_fk' => 'Scm Opalmemberregmst Fk',
            'scm_coursetype' => 'Scm Coursetype',
            'scm_appoffercoursemain_fk' => 'Scm Appoffercoursemain Fk',
            'scm_coursename_en' => 'Scm Coursename En',
            'scm_coursename_ar' => 'Scm Coursename Ar',
            'scm_assessmentin' => 'Scm Assessmentin',
            'scm_requestfor' => 'Scm Requestfor',
            'scm_courselevel' => 'Scm Courselevel',
            'scm_coursecategorymst_fk' => 'Scm Coursecategorymst Fk',
            'scm_status' => 'Scm Status',
            'scm_createdon' => 'Scm Createdon',
            'scm_createdby' => 'Scm Createdby',
            'scm_updatedon' => 'Scm Updatedon',
            'scm_updatedby' => 'Scm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlshstyTbls()
    {
        return $this->hasMany(AppcoursedtlshstyTbl::className(), ['appcdh_StandardCourseMst_FK' => 'standardcoursemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlsmainTbls()
    {
        return $this->hasMany(AppcoursedtlsmainTbl::className(), ['appcdm_StandardCoursemst_FK' => 'standardcoursemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlstmpTbls()
    {
        return $this->hasMany(AppcoursedtlstmpTbl::className(), ['appcdt_standardcoursemst_fk' => 'standardcoursemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentmstTbls()
    {
        return $this->hasMany(AssessmentmstTbl::className(), ['asmtm_StandardCourseMst_FK' => 'standardcoursemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackmstTbls()
    {
        return $this->hasMany(FeedbackmstTbl::className(), ['fdbkm_StandardCourseMst_FK' => 'standardcoursemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStandardcoursedtlsTbls()
    {
        return $this->hasMany(StandardcoursedtlsTbl::className(), ['scd_standardcoursemst_fk' => 'standardcoursemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmAppoffercoursemainFk()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'scm_appoffercoursemain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'scm_coursecategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'scm_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'scm_projectmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StandardcoursemstTblQuery(get_called_class());
    }


    
    public static function getallstandardcourses(){
        return self::find()
                ->select(['standardcoursemst_pk as pk','scm_coursename_en as course_en','scm_coursename_ar as course_ar','scm_coursecategorymst_fk','ccm_catname_en as catname_en','ccm_catname_ar as catname_ar','scd_thyclasslimit as batchlimit'])
                ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = scm_coursecategorymst_fk')
                ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = standardcoursemst_pk')
                ->where(['=','scm_status',1])
                ->asArray()
                ->all();
        
    }
    
    public static function getallstandardcoursesByAppPk($instinfopk){
        
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
         $allocatedprj = explode(',',\yii\db\ActiveRecord::getTokenData('oum_allocatedproject', true));
        $allocatecategory = explode(',',\yii\db\ActiveRecord::getTokenData('oum_standcoursemst_fk', true));
        
        $loginuserdtls = OpalusermstTbl::findOne($userpk);
       
       $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
       
       $model =   self::find()
                ->select(['standardcoursemst_pk as pk','standardcoursedtls_pk as stdcoursedtlsmainpk','AppCourseDtlsMain_PK as appcoursemainpk','trim(scm_coursename_en) as course_en','trim(scm_coursename_ar) as course_ar','scm_coursecategorymst_fk','ccm_catname_en as catname_en','ccm_catname_ar as catname_ar','if(DATE_ADD(now(),interval +1 month) > appdm_certificateexpiry and now() <= appdm_certificateexpiry , 1 , 0) as is_nearingexpiry',
    'if(DATE_ADD(now(),interval -1 month) <= appdm_certificateexpiry and now()  >  appdm_certificateexpiry , 1 , 0) as graceperiod',
    'if(DATE_ADD(now(),interval -1 month) > appdm_certificateexpiry , 1 , 0) as is_expired','DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") as nearingdate','DATE_FORMAT(DATE_ADD(appdm_certificateexpiry,interval +1 month),"%d-%m-%Y") as graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk','appdt_status as appstatus','appdt_apptype as apptype'])
                ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = scm_coursecategorymst_fk')
                ->leftJoin('appcoursedtlsmain_tbl','standardcoursemst_pk = appcdm_standardcoursemst_fk')
                ->leftJoin('applicationdtlsmain_tbl','appcdm_ApplicationDtlsMain_FK = applicationdtlsmain_pk')
                ->leftJoin('applicationdtlstmp_tbl', 'appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = standardcoursemst_pk')
                ->where(['=','scm_status',1])
                ->andWhere(['=','appdm_issuspended',2])
                ->andWhere('appcdm_appinstinfomain_fk in (select appcdm_appinstinfomain_fk from appcoursedtlsmain_tbl where appcdm_appinstinfomain_fk ='.$instinfopk.')');
       
        if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 2 && in_array(2,$allocatedprj))
        {
             $model->andWhere(['IN','scd_standardcoursemst_fk',$allocatecategory]);
        }
         else if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 2 && !in_array(2,$allocatedprj))
        {
            $model->andWhere(0);
        }
       
       
              $data = $model->groupBy('standardcoursemst_pk')
                ->asArray()
                ->all();
       
       
       
       foreach( $data as $key => $record)
       {
           $invoicechk = self::CheckInvoiceDueCourse($record['appcoursemainpk']);
           
           $data[$key]['isOverdue'] = $invoicechk ? 1 : 2 ;
           
       }
       
       return $data;
    }

    public function getCourse($limit, $index, $searchkey, $sort){
        $courses = StandardcoursemstTbl::find()
         ->select(['standardcoursemst_pk as id','scm_coursename_en as courseTitle', 'scm_coursename_ar as coursetitle_ar','RM.rm_name_en as assessmentIn','RM.rm_name_ar as assessmentin_ar','RMMM.rm_name_en as courseLevel','RMMM.rm_name_ar as courselevel_ar', 'CCM.ccm_catname_en as courseCategory','CCM.ccm_catname_ar as coursecategory_ar', 'scm_status as status', 'scm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'scm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy',"GROUP_CONCAT(Distinct(RMM.rm_name_en) ORDER BY RMM.rm_name_en ASC SEPARATOR '**') as requestFor", "GROUP_CONCAT(Distinct(RMM.rm_name_ar) ORDER BY RMM.rm_name_ar ASC SEPARATOR '**') as requestfor_ar", "GROUP_CONCAT(Distinct(CCMM.ccm_catname_en) ORDER BY CCMM.ccm_catname_en ASC SEPARATOR '**') as courseSubcategory", "GROUP_CONCAT(Distinct(CCMM.ccm_catname_ar) ORDER BY CCMM.ccm_catname_ar ASC SEPARATOR '**') as subcategory_ar"])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = scm_createdby')
         ->leftJoin('referencemst_tbl as RM', 'RM.referencemst_pk = scm_assessmentin')
         ->leftJoin('referencemst_tbl as RMM', 'find_in_set(RMM.referencemst_pk,scm_requestfor)')
         ->leftJoin('referencemst_tbl as RMMM', 'RMMM.referencemst_pk = scm_courselevel')
         ->leftJoin('coursecategorymst_tbl as CCM', 'CCM.coursecategorymst_pk = scm_coursecategorymst_fk')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = scm_updatedby')
         ->leftJoin('standardcoursedtls_tbl as SC', 'SC.scd_standardcoursemst_fk = standardcoursemst_pk')
         ->leftJoin('coursecategorymst_tbl as CCMM', 'CCMM.coursecategorymst_pk = scd_subcoursecategorymst_fk');
         if(!empty($searchkey['courseTitle'])){
            $courses->andWhere(['Like', 'scm_coursename_en', $searchkey['courseTitle']]);
         }
         if(!empty($searchkey['assessmentIn'])){
            $courses->andWhere(['IN', 'scm_assessmentin', $searchkey['assessmentIn']]);
         }

         if(!empty($searchkey['requestFor'])){
            $courses->andwhere('find_in_set('.$searchkey['requestFor'].', scm_requestfor)');
         }
         if(!empty($searchkey['courseLevel'])){
            $courses->andwhere(['IN', 'scm_courselevel', $searchkey['courseLevel']]);
         }
         if(!empty($searchkey['courseCategory'])){
            $courses->andwhere(['IN', 'scm_coursecategorymst_fk', $searchkey['courseCategory']]);
         }
         if(!empty($searchkey['courseSubcategory'])){
            $courses->andwhere(['IN', 'SC.scd_subcoursecategorymst_fk', $searchkey['courseSubcategory']]);
         }
         if(!empty($searchkey['status'])){
            $courses->andwhere(['IN', 'scm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $courses->andWhere('scm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $courses->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $courses->andWhere('scm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $courses->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         $courses->groupBy('standardcoursemst_pk');
         if(!empty($sort)){
            if($sort['key'] == 'courseTitle'){
                $courses->orderby('scm_coursename_en '.$sort['dir']);
            }
            if($sort['key'] == 'assessmentIn'){
                $courses->orderby('RM.rm_name_en '.$sort['dir']);
            }
            if($sort['key'] == 'requestFor'){
                $courses->orderby('scm_requestfor '.$sort['dir']);
            }
            if($sort['key'] == 'courseLevel'){
                $courses->orderby('RMMM.rm_name_en '.$sort['dir']);
            }
            if($sort['key'] == 'courseCategory'){
                $courses->orderby('CCM.ccm_catname_en '.$sort['dir']);
            }
            if($sort['key'] == 'courseSubcategory'){
                $courses->orderby('SC.scd_subcoursecategorymst_fk '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $courses->orderby('scm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $courses->orderby('scm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $courses->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $courses->orderby('scm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $courses->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $courses->orderby('scm_createdon desc');
         }
         
         $courses->asArray();
        // print_r($sort);

         $dataProvider = new ActiveDataProvider([
            'query' => $courses,
            'pagination' => [
               'pageSize' =>$limit,
               'page'=>$index
            ]
         ]);
          
         $card = $dataProvider->getModels();
   
         $recodsset =[];
         $recodsset['courses'] = $card;
         $recodsset['pagesize'] = $limit;
         $recodsset['totalcount'] = $dataProvider->getTotalCount();
   
         return $recodsset;

    }

    public function alreadyExist($name)
    {
        return self::find()->where('UPPER(scm_coursename_en) = UPPER("'.$name.'")')->one();
    }

    public function savestandardcourse($data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $requestfor = '';
        foreach($data['requestfor'] as $key => $item){
            if((count($data['requestfor'])-1) == $key ){
                $requestfor .= $item; 
            }else{

                $requestfor .= $item .',';
            }
        }
        
        $details = [
            'scm_projectmst_fk' => 2,
            'scm_opalmemberregmst_fk' => 1,
            'scm_coursetype' => 1,
            'scm_appoffercoursemain_fk' => null,
            'scm_coursename_en' => $data['title_en'],
            'scm_coursename_ar' => $data['title_ar'],
            'scm_coursecertcontent' => 'is an approved OPAL STAR Provider to deliver and/or assess for the Unified Defensive Driving Training as per the provisions of the OPAL Road Safety Standard.',
            'scm_assessmentin' => $data['assessmentin'],
            'scm_requestfor' => $requestfor,
            'scm_courselevel' => $data['courselevel'],
            'scm_coursecategorymst_fk' => $data['coursecategory'],
            'scm_isintlreorgreq' => $data['interreg'],
            'scm_status' => 3,
            'scm_createdon' => date('Y-m-d H:i:s'),
            'scm_createdby' => $userPk
        ];
        $course = new StandardcoursemstTbl($details);
        if($course->save()){
            $feesub = [];
            $datafee_cfi =  [
                'fsm_projectmst_fk' => 2,
                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                'fsm_standardcoursedtls_fk'=> null,
                'fsm_feestype' => 1,
                'fsm_rolemst_fk' => null,
                'fsm_fee'=>0,
                'fsm_officetype'=>0,
                'fsm_applicationtype'=> 1,
                'fsm_status' => 1,
                'fsm_createdon' => date('Y-m-d H:i:s'),
                'fsm_createdby' => $userPk,
            ];
            if($data['samefee']){
                $datafee_cfi['fsm_fee'] = $data['main_cfi'];
                $datafee_cfi['fsm_officetype'] = 3;
                array_push($feesub,$datafee_cfi);
            }else{
                $datafee_cfi['fsm_fee'] = $data['main_cfi'];
                $datafee_cfi['fsm_officetype'] = 1;
                array_push($feesub,$datafee_cfi);
                $datafee_cfi['fsm_fee'] = $data['branch_cfi'];
                $datafee_cfi['fsm_officetype']= 2;
                array_push($feesub,$datafee_cfi);
            }

            $datafee_cfr =  [
                'fsm_projectmst_fk' => 2,
                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                'fsm_standardcoursedtls_fk'=> null,
                'fsm_feestype' => 1,
                'fsm_rolemst_fk' => null,
                'fsm_fee'=>0,
                'fsm_officetype'=>0,
                'fsm_applicationtype'=> 3,
                'fsm_status' => 1,
                'fsm_createdon' => date('Y-m-d H:i:s'),
                'fsm_createdby' => $userPk,
            ];
            if($data['samefee']){
                $datafee_cfr['fsm_fee'] = $data['main_cfr'];
                $datafee_cfr['fsm_officetype'] = 3;
                array_push($feesub,$datafee_cfr);
            }else{
                $datafee_cfr['fsm_fee'] = $data['main_cfr'];
                $datafee_cfr['fsm_officetype'] = 1;
                array_push($feesub,$datafee_cfr);
                $datafee_cfr['fsm_fee'] = $data['branch_cfr'];
                $datafee_cfr['fsm_officetype'] = 2;
                array_push($feesub,$datafee_cfr);
            }

            $datafee_sefi =  [
                'fsm_projectmst_fk' => 2,
                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                'fsm_standardcoursedtls_fk'=> null,
                'fsm_feestype' => 2,
                'fsm_rolemst_fk' => null,
                'fsm_fee'=>0,
                'fsm_officetype'=>0,
                'fsm_applicationtype'=> 1,
                'fsm_status' => 1,
                'fsm_createdon' => date('Y-m-d H:i:s'),
                'fsm_createdby' => $userPk,
            ];
            if($data['samefee']){
                $datafee_sefi['fsm_fee'] = $data['main_sefi'];
                $datafee_sefi['fsm_officetype'] = 3;
                array_push($feesub,$datafee_sefi);
            }else{
                $datafee_sefi['fsm_fee'] = $data['main_sefi'];
                $datafee_sefi['fsm_officetype'] = 1;
                array_push($feesub,$datafee_sefi);
                $datafee_sefi['fsm_fee'] = $data['branch_sefi'];
                $datafee_sefi['fsm_officetype'] = 2;
                array_push($feesub,$datafee_sefi);
            }

            $datafee_sefu =  [
                'fsm_projectmst_fk' => 2,
                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                'fsm_standardcoursedtls_fk'=> null,
                'fsm_feestype' => 2,
                'fsm_rolemst_fk' => null,
                'fsm_fee'=>0,
                'fsm_officetype'=>0,
                'fsm_applicationtype'=> 3,
                'fsm_status' => 1,
                'fsm_createdon' => date('Y-m-d H:i:s'),
                'fsm_createdby' => $userPk,
            ];
            if($data['samefee']){
                $datafee_sefu['fsm_fee'] = $data['main_sefi'];
                $datafee_sefu['fsm_officetype'] = 3;
                array_push($feesub,$datafee_sefu);
            }else{
                $datafee_sefu['fsm_fee'] = $data['main_sefu'];
                $datafee_sefu['fsm_officetype'] = 1;
                array_push($feesub,$datafee_sefu);
                $datafee_sefu['fsm_fee'] = $data['branch_sefu'];
                $datafee_sefu['fsm_officetype'] = 2;
                array_push($feesub,$datafee_sefu);
            }

            $datafee_srefi =  [
                'fsm_projectmst_fk' => 2,
                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                'fsm_standardcoursedtls_fk'=> null,
                'fsm_feestype' => 6,
                'fsm_rolemst_fk' => null,
                'fsm_fee'=>0,
                'fsm_officetype'=>0,
                'fsm_applicationtype'=> 1,
                'fsm_status' => 1,
                'fsm_createdon' => date('Y-m-d H:i:s'),
                'fsm_createdby' => $userPk,
            ];
            if($data['samefee']){
                $datafee_srefi['fsm_fee'] = $data['main_srefi'];
                $datafee_srefi['fsm_officetype'] = 3;
                array_push($feesub,$datafee_srefi);
            }else{
                $datafee_srefi['fsm_fee'] = $data['main_srefi'];
                $datafee_srefi['fsm_officetype'] = 1;
                array_push($feesub,$datafee_srefi);
                $datafee_srefi['fsm_fee'] = $data['branch_srefi'];
                $datafee_srefi['fsm_officetype'] = 2;
                array_push($feesub,$datafee_srefi);
            }

            $datafee_srefu =  [
                'fsm_projectmst_fk' => 2,
                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                'fsm_standardcoursedtls_fk'=> null,
                'fsm_feestype' => 6,
                'fsm_rolemst_fk' => null,
                'fsm_fee'=>0,
                'fsm_officetype'=>0,
                'fsm_applicationtype'=> 3,
                'fsm_status' => 1,
                'fsm_createdon' => date('Y-m-d H:i:s'),
                'fsm_createdby' => $userPk,
            ];
            if($data['samefee']){
                $datafee_srefu['fsm_fee'] = $data['main_srefu'];
                $datafee_srefu['fsm_officetype'] = 3;
                array_push($feesub,$datafee_srefu);
            }else{
                $datafee_srefu['fsm_fee'] = $data['main_srefu'];
                $datafee_srefu['fsm_officetype'] = 1;
                array_push($feesub,$datafee_srefu);
                $datafee_srefu['fsm_fee'] = $data['branch_srefu'];
                $datafee_srefu['fsm_officetype'] = 2;
                array_push($feesub,$datafee_srefu);
            }

            if($data['royal']){
                $royal =  [
                    'fsm_projectmst_fk' => 2,
                    'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                    'fsm_standardcoursedtls_fk'=> null,
                    'fsm_feestype' => 3,
                    'fsm_rolemst_fk' => null,
                    'fsm_fee'=>$data['royal'],
                    'fsm_officetype'=>3,
                    'fsm_applicationtype'=> 0,
                    'fsm_status' => 1,
                    'fsm_createdon' => date('Y-m-d H:i:s'),
                    'fsm_createdby' => $userPk,
                ];

                array_push($feesub,$royal);
            }

            foreach($feesub as $item){
                $fee = new FeeSubscriptionmstTbl($item);
                if ($fee->save()) {
                    
                } else {
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($fee->getErrors());
                    die; 
                }
            }
            $transaction->commit();
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($course->getErrors());
            die;
        }
        return $course;
    }

    public function editstandardcourse($data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $requestfor = '';

        foreach ($data['requestfor'] as $key => $item) {
            if ((count($data['requestfor']) - 1) == $key) {
                $requestfor .= $item;
            } else {
                $requestfor .= $item . ',';
            }
        }

        $course = StandardcoursemstTbl::findOne($data['id']);

        $hisdata =  [
            'scmh_standardcoursemst_fk' => $course->standardcoursemst_pk,
            'scmh_projectmst_fk' => $course->scm_projectmst_fk,
            'scmh_opalmemberregmst_fk' => $course->scm_opalmemberregmst_fk,
            'scmh_coursetype' => $course->scm_coursetype,
            'scmh_appoffercoursemain_fk' => $course->scm_appoffercoursemain_fk,
            'scmh_coursename_en' => $course->scm_coursename_en,
            'scmh_coursename_ar' => $course->scm_coursename_ar,
            'scmh_coursecertcontent' => $course->scm_coursecertcontent,
            'scmh_assessmentin' => $course->scm_assessmentin,
            'scmh_isintlreorgreq' => $course->scm_isintlreorgreq,
            'scmh_requestfor' => $course->scm_requestfor,
            'scmh_courselevel' => $course->scm_courselevel,
            'scmh_coursecategorymst_fk' => $course->scm_coursecategorymst_fk,
            'scmh_status' => $course->scm_status,
            'scmh_createdon' => $course->scm_createdon,
            'scmh_createdby' => $course->scm_createdby,
            'scmh_updatedon' => $course->scm_updatedon,
            'scmh_updatedby' => $course->scm_updatedby,
        ];
        $history = new \app\models\StandardcoursemsthstyTbl($hisdata);
        if ($history->save()) {
            $course->scm_coursename_en = $data['title_en'];
            $course->scm_coursename_ar = $data['title_ar'];
            $course->scm_assessmentin = $data['assessmentin'];
            $course->scm_requestfor = $requestfor;
            $course->scm_courselevel = $data['courselevel'];
            $course->scm_coursecategorymst_fk = $data['coursecategory'];
            $course->scm_isintlreorgreq = $data['interreg'];
            $course->scm_updatedon = date('Y-m-d H:i:s');
            $course->scm_updatedby = $userPk;
    
            if ($course->save()) {
                if($data['feechange']){
                    $arr_his = [];
                    $arr_upd = [];
                    $fee_cfi = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',3])
                            ->andwhere(['=','fsm_feestype',1])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                    if($fee_cfi){
                        if(round($fee_cfi->fsm_fee) != $data['main_cfi']){
                            array_push($arr_his, self::returnhistory($fee_cfi));
                            $fee_cfi->fsm_fee = $data['main_cfi'];
                            array_push($arr_upd, $fee_cfi);
                        }
                    }else{
                        $fee_cfi_1 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',1])
                            ->andwhere(['=','fsm_feestype',1])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                        if($fee_cfi_1){
                            if($fee_cfi_1->fsm_fee != $data['main_cfi']){
                                array_push($arr_his, self::returnhistory($fee_cfi_1));
                                $fee_cfi_1->fsm_fee = $data['main_cfi'];
                                array_push($arr_upd, $fee_cfi_1);
                            }
                        }
                        $fee_cfi_2 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',2])
                            ->andwhere(['=','fsm_feestype',1])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                        if($fee_cfi_2){
                            if($fee_cfi_2->fsm_fee != $data['branch_cfi']){
                                array_push($arr_his, self::returnhistory($fee_cfi_2));
                                $fee_cfi_2->fsm_fee = $data['branch_cfi'];
                                array_push($arr_upd, $fee_cfi_2);
                            }
                        }
                    }

                    $fee_cfu = FeeSubscriptionmstTbl::find()
                        ->where(['=','fsm_applicationtype',2])
                        ->orwhere(['=','fsm_applicationtype',3])
                        ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                        ->andwhere(['=','fsm_projectmst_fk',2])
                        ->andwhere(['=','fsm_officetype',3])
                        ->andwhere(['=','fsm_feestype',1])
                        ->one();
                    if($fee_cfu){
                        if($fee_cfu->fsm_fee != $data['main_cfr']){
                            array_push($arr_his, self::returnhistory($fee_cfu));
                            $fee_cfu->fsm_fee = $data['main_cfr'];
                            array_push($arr_upd, $fee_cfu);
                        }
                    }else{
                        $fee_cfu_1 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_applicationtype',2])
                            ->orwhere(['=','fsm_applicationtype',3])
                            ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',1])
                            ->andwhere(['=','fsm_feestype',1])
                            ->one();
                        if($fee_cfu_1){
                            if($fee_cfu_1->fsm_fee != $data['main_cfr']){
                                array_push($arr_his, self::returnhistory($fee_cfu_1));
                                $fee_cfu_1->fsm_fee = $data['main_cfr'];
                                array_push($arr_upd, $fee_cfu_1);
                            }
                        }
                        $fee_cfu_2 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_applicationtype',2])
                            ->orwhere(['=','fsm_applicationtype',3])
                            ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',2])
                            ->andwhere(['=','fsm_feestype',1])
                            ->one();
                        if($fee_cfu_2){
                            if($fee_cfu_2->fsm_fee != $data['branch_cfr']){
                                array_push($arr_his, self::returnhistory($fee_cfu_2));
                                $fee_cfu_2->fsm_fee = $data['branch_cfr'];
                                array_push($arr_upd, $fee_cfu_2);
                            }
                        }
                    }

                    ///

                    $fee_sefi = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',3])
                            ->andwhere(['=','fsm_feestype',2])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                    if($fee_sefi){
                        if($fee_sefi->fsm_fee != $data['main_sefi']){
                            array_push($arr_his, self::returnhistory($fee_sefi));
                            $fee_sefi->fsm_fee = $data['main_sefi'];
                            array_push($arr_upd, $fee_sefi);
                        }
                    }else{
                        $fee_sefi_1 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',1])
                            ->andwhere(['=','fsm_feestype',2])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                        if($fee_sefi_1){
                            if($fee_sefi_1->fsm_fee != $data['main_sefi']){
                                array_push($arr_his, self::returnhistory($fee_sefi_1));
                                $fee_sefi_1->fsm_fee = $data['main_sefi'];
                                array_push($arr_upd, $fee_sefi_1);
                            }
                        }
                        $fee_sefi_2 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',2])
                            ->andwhere(['=','fsm_feestype',2])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                        if($fee_sefi_2){
                            if($fee_sefi_2->fsm_fee != $data['branch_sefi']){
                                array_push($arr_his, self::returnhistory($fee_sefi_2));
                                $fee_sefi_2->fsm_fee = $data['branch_sefi'];
                                array_push($arr_upd, $fee_sefi_2);
                            }
                        }
                    }

                    $fee_sefu = FeeSubscriptionmstTbl::find()
                        ->where(['=','fsm_applicationtype',2])
                        ->orwhere(['=','fsm_applicationtype',3])
                        ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                        ->andwhere(['=','fsm_projectmst_fk',2])
                        ->andwhere(['=','fsm_officetype',3])
                        ->andwhere(['=','fsm_feestype',2])
                        ->one();
                    if($fee_sefu){
                        if($fee_sefu->fsm_fee != $data['main_sefu']){
                            array_push($arr_his, self::returnhistory($fee_sefu));
                            $fee_sefu->fsm_fee = $data['main_sefu'];
                            array_push($arr_upd, $fee_sefu);
                        }
                    }else{
                        $fee_sefu_1 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_applicationtype',2])
                            ->orwhere(['=','fsm_applicationtype',3])
                            ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',1])
                            ->andwhere(['=','fsm_feestype',2])
                            ->one();
                        if($fee_sefu_1){
                            if($fee_sefu_1->fsm_fee != $data['main_sefu']){
                                array_push($arr_his, self::returnhistory($fee_sefu_1));
                                $fee_sefu_1->fsm_fee = $data['main_sefu'];
                                array_push($arr_upd, $fee_sefu_1);
                            }
                        }
                        $fee_sefu_2 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_applicationtype',2])
                            ->orwhere(['=','fsm_applicationtype',3])
                            ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',2])
                            ->andwhere(['=','fsm_feestype',2])
                            ->one();
                        if($fee_sefu_2){
                            if($fee_sefu_2->fsm_fee != $data['branch_sefu']){
                                array_push($arr_his, self::returnhistory($fee_sefu_2));
                                $fee_sefu_2->fsm_fee = $data['branch_sefu'];
                                array_push($arr_upd, $fee_sefu_2);
                            }
                        }
                    }

                    ///

                    $fee_srefi = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',3])
                            ->andwhere(['=','fsm_feestype',6])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                    if($fee_srefi){
                        if($fee_srefi->fsm_fee != $data['main_srefi']){
                            array_push($arr_his, self::returnhistory($fee_srefi));
                            $fee_srefi->fsm_fee = $data['main_srefi'];
                            array_push($arr_upd, $fee_srefi);
                        }
                    }else{
                        $fee_srefi_1 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',1])
                            ->andwhere(['=','fsm_feestype',6])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                        if($fee_srefi_1){
                            if($fee_srefi_1->fsm_fee != $data['main_srefi']){
                                array_push($arr_his, self::returnhistory($fee_srefi_1));
                                $fee_srefi_1->fsm_fee = $data['main_srefi'];
                                array_push($arr_upd, $fee_srefi_1);
                            }
                        }
                        $fee_srefi_2 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',2])
                            ->andwhere(['=','fsm_feestype',6])
                            ->andwhere(['=','fsm_applicationtype',1])
                            ->one();
                        if($fee_srefi_2){
                            if($fee_srefi_2->fsm_fee != $data['branch_srefi']){
                                array_push($arr_his, self::returnhistory($fee_srefi_2));
                                $fee_srefi_2->fsm_fee = $data['branch_srefi'];
                                array_push($arr_upd, $fee_srefi_2);
                            }
                        }
                    }

                    $fee_srefu = FeeSubscriptionmstTbl::find()
                        ->where(['=','fsm_applicationtype',2])
                        ->orwhere(['=','fsm_applicationtype',3])
                        ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                        ->andwhere(['=','fsm_projectmst_fk',2])
                        ->andwhere(['=','fsm_officetype',3])
                        ->andwhere(['=','fsm_feestype',6])
                        ->one();
                    if($fee_srefu){
                        if($fee_srefu->fsm_fee != $data['main_srefu']){
                            array_push($arr_his, self::returnhistory($fee_srefu));
                            $fee_srefu->fsm_fee = $data['main_srefu'];
                            array_push($arr_upd, $fee_srefu);
                        }
                    }else{
                        $fee_srefu_1 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_applicationtype',2])
                            ->orwhere(['=','fsm_applicationtype',3])
                            ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',1])
                            ->andwhere(['=','fsm_feestype',6])
                            ->one();
                        if($fee_srefu_1){
                            if($fee_srefu_1->fsm_fee != $data['main_srefu']){
                                array_push($arr_his, self::returnhistory($fee_srefu_1));
                                $fee_srefu_1->fsm_fee = $data['main_srefu'];
                                array_push($arr_upd, $fee_srefu_1);
                            }
                        }
                        $fee_srefu_2 = FeeSubscriptionmstTbl::find()
                            ->where(['=','fsm_applicationtype',2])
                            ->orwhere(['=','fsm_applicationtype',3])
                            ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                            ->andwhere(['=','fsm_projectmst_fk',2])
                            ->andwhere(['=','fsm_officetype',2])
                            ->andwhere(['=','fsm_feestype',1])
                            ->one();
                        if($fee_srefu_2){
                            if($fee_srefu_2->fsm_fee != $data['branch_srefu']){
                                array_push($arr_his, self::returnhistory($fee_srefu_2));
                                $fee_srefu_2->fsm_fee = $data['branch_srefu'];
                                array_push($arr_upd, $fee_srefu_2);
                            }
                        }
                    }

                    $royal = FeeSubscriptionmstTbl::find()
                        ->where(['=','fsm_applicationtype',0])
                        ->andwhere(['=','fsm_standardcoursemst_fk',$data['id']])
                        ->andwhere(['=','fsm_projectmst_fk',2])
                        ->andwhere(['=','fsm_officetype',3])
                        ->andwhere(['=','fsm_feestype',3])
                        ->one();
                    if($royal){
                        if($data['royal']){
                            if($royal->fsm_fee != $data['royal']){
                                array_push($arr_his, self::returnhistory($royal));
                                $royal->fsm_fee = $data['royal'];
                                array_push($arr_upd, $royal);
                            }
                        }else{
                            array_push($arr_his, self::returnhistory($royal));
                            $royal->fsm_status = 2;
                            $royal->fsm_updatedon = date('Y-m-d H:i:s');
                            $royal->fsm_updatedby = $userPk;
                            array_push($arr_upd, $royal);
                        }
                    }else{
                        if($data['royal']){
                            $royal =  [
                                'fsm_projectmst_fk' => 2,
                                'fsm_standardcoursemst_fk'=>$course->standardcoursemst_pk,
                                'fsm_standardcoursedtls_fk'=> null,
                                'fsm_feestype' => 3,
                                'fsm_rolemst_fk' => null,
                                'fsm_fee'=>$data['royal'],
                                'fsm_officetype'=>3,
                                'fsm_applicationtype'=> 0,
                                'fsm_status' => 1,
                                'fsm_createdon' => date('Y-m-d H:i:s'),
                                'fsm_createdby' => $userPk,
                            ];

                            $fee = new FeeSubscriptionmstTbl($royal);
                            if ($fee->save()) {
                                
                            } else {
                                echo "<pre>";
                                $transaction->rollBack();
                                print_r($fee->getErrors());
                                die; 
                            }
                        }
                    }

                    //print_r($arr_his);
                    //print_r($arr_upd);
                    //exit;

                    foreach($arr_his as $item){
                        if ($item->save()) {
                                
                        } else {
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($feehistory->getErrors());
                            die; 
                        }
                    }

                    foreach($arr_upd as $item){
                        $item->fsm_updatedon = date('Y-m-d H:i:s');
                        $item->fsm_updatedby = $userPk;
                        if ($item->save()) {
                                
                        } else {
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($item->getErrors());
                            die; 
                        }
                    }
                    
                }
                $transaction->commit();
            } else {
                echo "<pre>";
                $transaction->rollBack();
                print_r($course->getErrors());
                die; 
            }

        } else {
            echo "<pre>";
            $transaction->rollBack();
            print_r($history->getErrors());
            die; 
        }
        return 1;    

    }


    public function returnhistory($item){
        $fee_his =  [
            'fsmh_feesubscriptionmst_fk' => $item['feesubscriptionmst_pk'],
            'fsmh_projectmst_fk' => $item['fsm_projectmst_fk'],
            'fsmh_standardcoursemst_fk' => $item['fsm_standardcoursemst_fk'],
            'fsmh_standardcoursedtls_fk' => $item['fsm_standardcoursedtls_fk'],
            'fsmh_officetype' => $item['fsm_officetype'],
            'fsmh_feestype' => $item['fsm_feestype'],
            'fsmh_rolemst_fk' => $item['fsm_rolemst_fk'],
            'fsmh_applicationtype' => $item['fsm_applicationtype'],
            'fsmh_headcount' => $item['fsm_headcount'],
            'fsmh_fee' => $item['fsm_fee'],
            'fsmh_validityinyrs' => $item['fsm_validityinyrs'],
            'fsmh_status' => $item['fsm_status'],
            'fsmh_createdon' => $item['fsm_createdon'],
            'fsmh_createdby' => $item['fsm_createdby'],
            'fsmh_updatedon' => $item['fsm_updatedon'],
            'fsmh_updatedby' => $item['fsm_updatedby'],
        ];
        $feehistory = new FeesubscriptionmsthstyTbl($fee_his);
        return $feehistory;
    }

    public function changestandardcoursestatus($data)
    {
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $requestfor = '';

        $course = StandardcoursemstTbl::findOne($data['id']);
        $course->scm_status = $data['status'];
        $course->scm_updatedon = date('Y-m-d H:i:s');
        $course->scm_updatedby = $userPk;

        if ($course->save()) {

        } else {
            echo "<pre>";
            print_r($course->getErrors());
            die; 
        }
            return 1;

    }

    public function getstandardcourse($id)
    {
        $data = self::find()
            ->select([
                'scm_assessmentin',
                'scm_requestfor',
                'scm_courselevel',
                'scm_coursecategorymst_fk',
                'scm_isintlreorgreq',
                'scm_coursename_en as title',
                'scm_coursename_ar as title_ar',
                'RM.rm_name_en as assessmentin',
                'RM.rm_name_ar as assessmentin_ar',
                'RMMM.rm_name_en as courselevel',
                'CCM.ccm_catname_en as coursecategory',
                'CCM.ccm_catname_ar as coursecategory_ar',
                "(SELECT GROUP_CONCAT(RMM.rm_name_en ORDER BY RMM.rm_name_en ASC SEPARATOR ', ') FROM referencemst_tbl as RMM WHERE FIND_IN_SET(RMM.referencemst_pk, scm_requestfor)) AS requestfor",
            ])
            ->leftJoin('referencemst_tbl as RM', 'RM.referencemst_pk = scm_assessmentin')
            ->leftJoin('referencemst_tbl as RMM', 'find_in_set(RMM.referencemst_pk,scm_requestfor)')
            ->leftJoin('referencemst_tbl as RMMM', 'RMMM.referencemst_pk = scm_courselevel')
            ->leftJoin('coursecategorymst_tbl as CCM', 'CCM.coursecategorymst_pk = scm_coursecategorymst_fk')
            ->where(['=', 'standardcoursemst_pk',$id])
            ->asArray()
            ->one();
        
        $fee = FeeSubscriptionmstTbl::find()->where(['=','fsm_standardcoursemst_fk',$id])->andwhere(['=','fsm_projectmst_fk',2])->asArray()->all();

        
        $result = [
            'course' => $data,
            'fee'=>$fee
        ];
        
        return $result;
    }
    
    public function getrequestfor($id)
    {
        $data = StandardcoursemstTbl::findOne($id);
    
        $requestForIds = explode(',', $data->scm_requestfor);
    
        $courseQuery = \app\models\ReferencemstTbl::find()
            ->select(['referencemst_pk as id','rm_name_en as requestfor','rm_name_ar as requestfor_ar'])
            ->where(['IN', 'referencemst_pk', $requestForIds])
            ->asArray()
            ->all();
    
        return $courseQuery;
    }
    
    public static function CheckInvoiceDueCourse($coursepk)
    {
        $model = RoyaltyandasmtfeeTbl::find()
                ->where(['=','rasf_appcoursedtlsmain_fk',$coursepk])
                ->andWhere(['=','rasf_projectmst_fk',2])
                ->andWhere(['=','rasf_feetype',1])
                ->andWhere(['IN','rasf_pymtstatus',[3]])
                ->andWhere(['=','rasf_invoicestatus',1])
                ->exists();
        
        if(!$model)
        {
            $model = RoyaltyandasmtfeehstyTbl::find()
                    ->where(['=','rasfh_appcoursedtlsmain_fk',$coursepk])
                    ->andWhere(['=','rasfh_projectmst_fk',2])
                    ->andWhere(['=','rasfh_feetype',1])
                    ->andWhere(['IN','rasfh_pymtstatus',[3]])
                    ->andWhere(['=','rasfh_invoicestatus',1])
                    ->exists();
        }
        
        return $model;
               
    }
}
