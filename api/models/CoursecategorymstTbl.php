<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\CoursecategorymsthstyTbl;
use app\models\StandardcoursemstTbl;
use app\models\AppoffercoursetmpTbl;
use app\models\StandardcoursedtlsTbl;

/**
 * This is the model class for table "coursecategorymst_tbl".
 *
 * @property int $coursecategorymst_pk
 * @property int $ccm_coursecategorymst_pk If there is a subcategory for a category then this column should refer to coursecategorymst_pk
 * @property string $ccm_catname_en if ccm_coursecategorymst_pk is not null then this column should hold Sub category name
 * @property string $ccm_catname_ar
 * @property int $ccm_status 1-Active, 2-Inactive
 * @property string $ccm_createdon
 * @property int $ccm_createdby
 * @property string $ccm_updatedon
 * @property int $ccm_updatedby
 *
 * @property AppoffercoursetmpTbl[] $appoffercoursetmpTbls
 * @property AppoffercoursetmpTbl[] $appoffercoursetmpTbls0
 * @property CoursecategorymstTbl $ccmCoursecategorymstFk
 * @property CoursecategorymstTbl[] $coursecategorymstTbls
 * @property StandardcoursemstTbl[] $standardcoursemstTbls
 */
class CoursecategorymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coursecategorymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ccm_coursecategorymst_pk', 'ccm_status', 'ccm_createdby', 'ccm_updatedby'], 'integer'],
            [['ccm_catname_en', 'ccm_catname_ar', 'ccm_createdon', 'ccm_createdby'], 'required'],
            [['ccm_createdon', 'ccm_updatedon'], 'safe'],
            [['ccm_catname_en', 'ccm_catname_ar'], 'string', 'max' => 255],
            [['ccm_coursecategorymst_pk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['ccm_coursecategorymst_pk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coursecategorymst_pk' => 'Coursecategorymst Pk',
            'ccm_coursecategorymst_pk' => 'Ccm Coursecategorymst Fk',
            'ccm_catname_en' => 'Ccm Catname En',
            'ccm_catname_ar' => 'Ccm Catname Ar',
            'ccm_status' => 'Ccm Status',
            'ccm_createdon' => 'Ccm Createdon',
            'ccm_createdby' => 'Ccm Createdby',
            'ccm_updatedon' => 'Ccm Updatedon',
            'ccm_updatedby' => 'Ccm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercoursetmpTbls()
    {
        return $this->hasMany(AppoffercoursetmpTbl::className(), ['appoct_coursecategorymst_fk' => 'coursecategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercoursetmpTbls0()
    {
        return $this->hasMany(AppoffercoursetmpTbl::className(), ['appoct_coursesubcategorymst_fk' => 'coursecategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcmCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'ccm_coursecategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursecategorymstTbls()
    {
        return $this->hasMany(CoursecategorymstTbl::className(), ['ccm_coursecategorymst_pk' => 'coursecategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStandardcoursemstTbls()
    {
        return $this->hasMany(StandardcoursemstTbl::className(), ['scm_coursecategorymst_fk' => 'coursecategorymst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CoursecategorymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoursecategorymstTblQuery(get_called_class());
    }
    
    public static function getCoursesubCategoryById($catPk,$AppPk) {
     
        
       return CoursecategorymstTbl::find()
                        ->innerJoin('appcoursetrnsmain_tbl','appctm_coursecategorymst_fk = coursecategorymst_pk')
                        ->where(['=', 'ccm_coursecategorymst_pk', $catPk])
                        ->andWhere(['=', 'appctm_AppCourseDtlsMain_FK', $AppPk])
                        ->asArray()
                        ->all();
             
        
    }

    public static function getCourseCategories() {
        return  CoursecategorymstTbl::find()
                ->where('ccm_coursecategorymst_pk is NULL')
                ->andwhere(['=','ccm_status', 1])
                ->orderBy('ccm_catname_en asc')
                ->asArray()
                ->all();
    }

    public static function getSubCourseCategoriesList() {
        return  CoursecategorymstTbl::find()
                ->where('ccm_coursecategorymst_pk is NOT NULL')
                ->andwhere(['=','ccm_status', 1])
                ->orderBy('ccm_catname_en asc')
                ->asArray()
                ->all();
    }

    public static function getSubcourseCategories($id)
    {
        return  CoursecategorymstTbl::find()
                ->where(['=', 'ccm_coursecategorymst_pk', $id])
                ->andwhere(['=','ccm_status', 1])
                ->asArray()
                ->all();
    }

    public function getAllSubcourseCategories($standmstid, $courseid){

        $subcat = "select * from coursecategorymst_tbl where coursecategorymst_pk not in(
            select scd_subcoursecategorymst_fk from standardcoursedtls_tbl join standardcoursemst_tbl on scd_standardcoursemst_fk=standardcoursemst_pk
            where standardcoursemst_pk=$standmstid) and ccm_coursecategorymst_pk=$courseid";
            $result = Yii::$app->db->createCommand($subcat)->queryAll();
            // print_r($result);
            // exit;
        return $result;
    }

    public function getprereqlist($id){
        $courseid = \app\models\StandardcoursemstTbl::findOne($id);
       
        $subcat =  self::find()
                    ->where(['=','ccm_coursecategorymst_pk', $courseid->scm_coursecategorymst_fk])
                    ->orderBy('ccm_catname_en asc')
                    ->asArray()
                    ->all();
        return $subcat;
    }


    public function getCourseCategorylist($limit, $index, $searchkey, $sort){
        $course = self::find()
         ->select(['ccm_catcode as code','ccm_catname_en as course_en','ccm_catname_ar as course_ar','ccm_status as status', 'ccm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'ccm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','coursecategorymst_pk as pk'])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = ccm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = ccm_updatedby')
         ->where('ccm_coursecategorymst_pk is NULL');
         if(!empty($searchkey['code'])){
            $course->andWhere(['Like', 'ccm_catcode', $searchkey['code']]);
         }
         if(!empty($searchkey['course'])){
            $course->andWhere(['Like', 'ccm_catname_en', $searchkey['course']]);
         }
         if(!empty($searchkey['status'])){
            $course->andwhere(['IN', 'ccm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $course->andWhere('ccm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $course->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $course->andWhere('ccm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $course->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'code'){
                $course->orderby('ccm_catcode '.$sort['dir']);
            }
            if($sort['key'] == 'course'){
                $course->orderby('ccm_catname_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $course->orderby('ccm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $course->orderby('ccm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $course->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $course->orderby('ccm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $course->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $course->orderby('ccm_createdon desc');
         }
         
         $course->asArray();


         $dataProvider = new ActiveDataProvider([
            'query' => $course,
            'pagination' => [
               'pageSize' =>$limit,
               'page'=>$index
            ]
         ]);
          
         $card = $dataProvider->getModels();
   
         $recodsset =[];
         $recodsset['course'] = $card;
         $recodsset['pagesize'] = $limit;
         $recodsset['totalcount'] = $dataProvider->getTotalCount();
   
         return $recodsset;
    }

    public function getCoursecategory($id){
        return self::find()->where(['=','coursecategorymst_pk', $id])->one();
    }

    public function alreadyExist($name){
        return self::find()->where('UPPER(ccm_catname_en) = UPPER("'.$name.'")')->one();
    }

    public function addCourseCategory($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);


       $coursedata = [
            'ccm_coursecategorymst_pk' => null,
            'ccm_catname_en' => $data['categoty_en'],
            'ccm_catname_ar' => $data['categoty_ar'],
            'ccm_catcode' => $data['code'],
            'ccm_status' => 1,
            'ccm_createdon' => date('Y-m-d H:i:s'),
            'ccm_createdby' => $userPk
        ];

        $course = new CoursecategorymstTbl($coursedata);
        if($course->save()){
            return $course;
        }else{
            echo "<pre>";
            print_r($course->getErrors());
            die;
        }

    }

    public function updateCourseCategory($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $course = self::find()->where(['=','coursecategorymst_pk', $data['id']])->one();
        

        $coursedata = [
            'ccmh_coursecategorymst_fk' => $data['id'],
            'ccmh_coursecategorymst_pk' => $course->ccm_coursecategorymst_pk,
            'ccmh_catname_en' => $course->ccm_catname_en,
            'ccmh_catname_ar' => $course->ccm_catname_ar,
            'ccmh_catcode' => $course->ccm_catcode,
            'ccmh_subcatcode' => $course->ccm_subcatcode,
            'ccmh_status' => $course->ccm_status,
            'ccmh_createdon' => $course->ccm_createdon,
            'ccmh_createdby' => $course->ccm_createdby,
            'ccmh_updatedon' => $course->ccm_updatedon,
            'ccmh_updatedby' => $course->ccm_updatedby,
        ];

        $coursehis = new CoursecategorymsthstyTbl($coursedata);
        if($coursehis->save()){
            $course->ccm_catname_en = $data['categoty_en'];
            $course->ccm_catname_ar = $data['categoty_ar'];
            $course->ccm_catcode = $data['code'];
            $course->ccm_updatedon = date('Y-m-d H:i:s');
            $course->ccm_updatedby = $userPk;
            if($course->save()){
                $transaction->commit();
                return $course;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($course->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($coursehis->getErrors());
            die;
        }
    }

    public function updatecoursestatus($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $course = self::find()->where(['=','coursecategorymst_pk', $data['id']])->one();
        if($data['status'] == 1){
            $coursedata = [
                'ccmh_coursecategorymst_fk' => $data['id'],
                'ccmh_coursecategorymst_pk' => $course->ccm_coursecategorymst_pk,
                'ccmh_catname_en' => $course->ccm_catname_en,
                'ccmh_catname_ar' => $course->ccm_catname_ar,
                'ccmh_catcode' => $course->ccm_catcode,
                'ccmh_subcatcode' => $course->ccm_subcatcode,
                'ccmh_status' => $course->ccm_status,
                'ccmh_createdon' => $course->ccm_createdon,
                'ccmh_createdby' => $course->ccm_createdby,
                'ccmh_updatedon' => $course->ccm_updatedon,
                'ccmh_updatedby' => $course->ccm_updatedby,
            ];
    
            $coursehis = new CoursecategorymsthstyTbl($coursedata);
            if($coursehis->save()){
                $course->ccm_status = $data['status'];
                $course->ccm_updatedon = date('Y-m-d H:i:s');
                $course->ccm_updatedby = $userPk;
                if($course->save()){
                    $transaction->commit();
                    return $course;
                }else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($course->getErrors());
                    die;
                }
                
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($coursehis->getErrors());
                die;
            }
        }else{
            $subcat = self::find()->where(['=','ccm_coursecategorymst_pk', $data['id']])->andwhere(['=','ccm_status', 1])->all();
            if($subcat){
                return 1;
            }else{
                $standardcoursemst = StandardcoursemstTbl::find()->where(['=','scm_coursecategorymst_fk',$data['id']])->all();
                if($standardcoursemst){
                    return 2;
                }else{
                    $centre = AppoffercoursetmpTbl::find()->where(['=','appoct_coursecategorymst_fk',$data['id']])->all();
                    if($centre){
                        return 3;
                    }else{
                        $coursedata = [
                            'ccmh_coursecategorymst_fk' => $data['id'],
                            'ccmh_coursecategorymst_pk' => $course->ccm_coursecategorymst_pk,
                            'ccmh_catname_en' => $course->ccm_catname_en,
                            'ccmh_catname_ar' => $course->ccm_catname_ar,
                            'ccmh_catcode' => $course->ccm_catcode,
                            'ccmh_subcatcode' => $course->ccm_subcatcode,
                            'ccmh_status' => $course->ccm_status,
                            'ccmh_createdon' => $course->ccm_createdon,
                            'ccmh_createdby' => $course->ccm_createdby,
                            'ccmh_updatedon' => $course->ccm_updatedon,
                            'ccmh_updatedby' => $course->ccm_updatedby,
                        ];
                
                        $coursehis = new CoursecategorymsthstyTbl($coursedata);
                        if($coursehis->save()){
                            $course->ccm_status = $data['status'];
                            $course->ccm_updatedon = date('Y-m-d H:i:s');
                            $course->ccm_updatedby = $userPk;
                            if($course->save()){
                                $transaction->commit();
                                return $course;
                            }else{
                                echo "<pre>";
                                $transaction->rollBack();
                                print_r($course->getErrors());
                                die;
                            }
                            
                        }else{
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($coursehis->getErrors());
                            die;
                        }
                    }
                }
            }
        }
    }

    public function getCourseSubCategorylist($limit, $index, $searchkey, $sort){
        $course = self::find()
         ->select(['CC.ccm_catname_en as course_en', 'CC.ccm_catname_ar as course_ar','coursecategorymst_tbl.ccm_subcatcode as code','coursecategorymst_tbl.ccm_catname_en as subcourse_en','coursecategorymst_tbl.ccm_catname_ar as subcourse_ar','coursecategorymst_tbl.ccm_status as status', 'coursecategorymst_tbl.ccm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'coursecategorymst_tbl.ccm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','coursecategorymst_tbl.coursecategorymst_pk as pk'])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = ccm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = ccm_updatedby')
         ->leftJoin('coursecategorymst_tbl as CC', 'CC.coursecategorymst_pk = coursecategorymst_tbl.ccm_coursecategorymst_pk')
         ->where('coursecategorymst_tbl.ccm_coursecategorymst_pk is Not NULL');;
         if(!empty($searchkey['course'])){
            $course->andWhere(['IN', 'CC.coursecategorymst_pk', $searchkey['course']]);
         }
         if(!empty($searchkey['code'])){
            $course->andWhere(['Like', 'coursecategorymst_tbl.ccm_subcatcode', $searchkey['code']]);
         }
         if(!empty($searchkey['subcourse'])){
            $course->andWhere(['Like', 'coursecategorymst_tbl.ccm_catname_en', $searchkey['subcourse']]);
         }
         if(!empty($searchkey['status'])){
            $course->andwhere(['IN', 'coursecategorymst_tbl.ccm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $course->andWhere('coursecategorymst_tbl.ccm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $course->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $course->andWhere('coursecategorymst_tbl.ccm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $course->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'course'){
                $course->orderby('CC.ccm_catname_en '.$sort['dir']);
            }
            if($sort['key'] == 'code'){
                $course->orderby('coursecategorymst_tbl.ccm_catcode '.$sort['dir']);
            }
            if($sort['key'] == 'subcourse'){
                $course->orderby('coursecategorymst_tbl.ccm_catname_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $course->orderby('coursecategorymst_tbl.ccm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $course->orderby('coursecategorymst_tbl.ccm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $course->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $course->orderby('coursecategorymst_tbl.ccm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $course->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $course->orderby('coursecategorymst_tbl.ccm_createdon desc');
         }
         $course->asArray();
         $dataProvider = new ActiveDataProvider([
            'query' => $course,
            'pagination' => [
               'pageSize' =>$limit,
               'page'=>$index
            ]
         ]);
         $card = $dataProvider->getModels();
         $recodsset =[];
         $recodsset['course'] = $card;
         $recodsset['pagesize'] = $limit;
         $recodsset['totalcount'] = $dataProvider->getTotalCount();
         return $recodsset;
    }

    public function addCourseSubCategory($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $coursedata = [
            'ccm_coursecategorymst_pk' => $data['course'],
            'ccm_catname_en' => $data['subcategoty_en'],
            'ccm_catname_ar' => $data['subcategoty_ar'],
            'ccm_subcatcode' => $data['code'],
            'ccm_status' => 1,
            'ccm_createdon' => date('Y-m-d H:i:s'),
            'ccm_createdby' => $userPk
        ];

        $course = new CoursecategorymstTbl($coursedata);
        if($course->save()){
            return $course;
        }else{
            echo "<pre>";
            print_r($course->getErrors());
            die;
        }

    }

    public function updateCourseSubCategory($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $course = self::find()->where(['=','coursecategorymst_pk', $data['id']])->one();
        $coursedata = [
            'ccmh_coursecategorymst_fk' => $data['id'],
            'ccmh_coursecategorymst_pk' => $course->ccm_coursecategorymst_pk,
            'ccmh_catname_en' => $course->ccm_catname_en,
            'ccmh_catname_ar' => $course->ccm_catname_ar,
            'ccmh_catcode' => $course->ccm_catcode,
            'ccmh_subcatcode' => $course->ccm_subcatcode,
            'ccmh_status' => $course->ccm_status,
            'ccmh_createdon' => $course->ccm_createdon,
            'ccmh_createdby' => $course->ccm_createdby,
            'ccmh_updatedon' => $course->ccm_updatedon,
            'ccmh_updatedby' => $course->ccm_updatedby,
        ];

        $coursehis = new CoursecategorymsthstyTbl($coursedata);
        if($coursehis->save()){
            $course->ccm_coursecategorymst_pk = $data['course'];
            $course->ccm_catname_en = $data['subcategoty_en'];
            $course->ccm_catname_ar = $data['subcategoty_ar'];
            $course->ccm_catcode = $data['code'];
            $course->ccm_updatedon = date('Y-m-d H:i:s');
            $course->ccm_updatedby = $userPk;
            if($course->save()){
                $transaction->commit();
                return $course;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($course->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($coursehis->getErrors());
            die;
        }
    }

    public function updatecoursesubcategorystatus($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $course = self::find()->where(['=','coursecategorymst_pk', $data['id']])->one();
        if($data['status'] == 1){
            $coursedata = [
                'ccmh_coursecategorymst_fk' => $data['id'],
                'ccmh_coursecategorymst_pk' => $course->ccm_coursecategorymst_pk,
                'ccmh_catname_en' => $course->ccm_catname_en,
                'ccmh_catname_ar' => $course->ccm_catname_ar,
                'ccmh_catcode' => $course->ccm_catcode,
                'ccmh_subcatcode' => $course->ccm_subcatcode,
                'ccmh_status' => $course->ccm_status,
                'ccmh_createdon' => $course->ccm_createdon,
                'ccmh_createdby' => $course->ccm_createdby,
                'ccmh_updatedon' => $course->ccm_updatedon,
                'ccmh_updatedby' => $course->ccm_updatedby,
            ];
    
            $coursehis = new CoursecategorymsthstyTbl($coursedata);
            if($coursehis->save()){
                $course->ccm_status = $data['status'];
                $course->ccm_updatedon = date('Y-m-d H:i:s');
                $course->ccm_updatedby = $userPk;
                if($course->save()){
                    $transaction->commit();
                    return $course;
                }else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($course->getErrors());
                    die;
                }
                
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($coursehis->getErrors());
                die;
            }
        }else{
            $standardcoursemst = StandardcoursedtlsTbl::find()->where(['=','scd_subcoursecategorymst_fk',$data['id']])->all();
            if($standardcoursemst){
                return 2;
            }else{
                $centre = AppoffercoursetmpTbl::find()->where(['=','appoct_coursesubcategorymst_fk',$data['id']])->all();
                if($centre){
                    return 3;
                }else{
                    $coursedata = [
                        'ccmh_coursecategorymst_fk' => $data['id'],
                        'ccmh_coursecategorymst_pk' => $course->ccm_coursecategorymst_pk,
                        'ccmh_catname_en' => $course->ccm_catname_en,
                        'ccmh_catname_ar' => $course->ccm_catname_ar,
                        'ccmh_catcode' => $course->ccm_catcode,
                        'ccmh_subcatcode' => $course->ccm_subcatcode,
                        'ccmh_status' => $course->ccm_status,
                        'ccmh_createdon' => $course->ccm_createdon,
                        'ccmh_createdby' => $course->ccm_createdby,
                        'ccmh_updatedon' => $course->ccm_updatedon,
                        'ccmh_updatedby' => $course->ccm_updatedby,
                    ];
            
                    $coursehis = new CoursecategorymsthstyTbl($coursedata);
                    if($coursehis->save()){
                        $course->ccm_status = $data['status'];
                        $course->ccm_updatedon = date('Y-m-d H:i:s');
                        $course->ccm_updatedby = $userPk;
                        if($course->save()){
                            $transaction->commit();
                            return $course;
                        }else{
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($course->getErrors());
                            die;
                        }
                        
                    }else{
                        echo "<pre>";
                        $transaction->rollBack();
                        print_r($coursehis->getErrors());
                        die;
                    }
                }
            }
        }
    }

}
