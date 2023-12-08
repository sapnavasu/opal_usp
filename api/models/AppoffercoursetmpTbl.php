<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoffercoursetmp_tbl".
 *
 * @property int $appoffercoursetmp_pk Primary Key
 * @property int $appoct_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property string $appoct_coursename_en
 * @property string $appoct_coursename_ar
 * @property string $appoct_courseduration
 * @property int $appoct_foundationprog 1-Yes, 2-No
 * @property int $appoct_courselevel Reference to referencemst_pk where rm_mastertype=3
 * @property int $appoct_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $appoct_coursesubcategorymst_fk Reference to coursecategorymst_pk
 * @property string $appoct_coursetested Reference to referencemst_pk where rm_mastertype=8
 * @property string $appoct_appintrecogtmp_fk Reference to appintrecogtmp_pk,separated by comma Enable this only when at least one International recognition and accreditation added.
 * @property string $appoct_createdon
 * @property int $appoct_createdby
 * @property string $appoct_updatedon
 * @property int $appoct_updatedby
 * @property int $appoct_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appoct_appdecon
 * @property int $appoct_appdecby
 * @property string $appoct_appdeccomment
 *
 * @property ApplicationdtlstmpTbl $appoctApplicationdtlstmpFk
 * @property CoursecategorymstTbl $appoctCoursecategorymstFk
 * @property CoursecategorymstTbl $appoctCoursesubcategorymstFk
 * @property AppoffercourseunittmpTbl[] $appoffercourseunittmpTbls
 * @property AppstaffinfotmpTbl[] $appstaffinfotmpTbls
 * @property StaffinfotmpTbl[] $staffinfotmpTbls
 */
class AppoffercoursetmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoffercoursetmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appoct_applicationdtlstmp_fk', 'appoct_coursename_en', 'appoct_coursename_ar', 'appoct_courseduration', 'appoct_courselevel', 'appoct_coursecategorymst_fk', 'appoct_coursesubcategorymst_fk', 'appoct_coursetested', 'appoct_createdon', 'appoct_createdby', 'appoct_status'], 'required'],
            [['appoct_applicationdtlstmp_fk', 'appoct_foundationprog', 'appoct_courselevel', 'appoct_coursecategorymst_fk', 'appoct_createdby', 'appoct_updatedby', 'appoct_status', 'appoct_appdecby'], 'integer'],
            [['appoct_appintrecogtmp_fk', 'appoct_appdeccomment'], 'string'],
            [['appoct_createdon', 'appoct_updatedon', 'appoct_appdecon'], 'safe'],
            [['appoct_coursename_en', 'appoct_coursename_ar', 'appoct_courseduration'], 'string', 'max' => 255],
            [['appoct_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appoct_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['appoct_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['appoct_coursecategorymst_fk' => 'coursecategorymst_pk']],
            [['appoct_coursesubcategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['appoct_coursesubcategorymst_fk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appoffercoursetmp_pk' => 'Appoffercoursetmp Pk',
            'appoct_applicationdtlstmp_fk' => 'Appoct Applicationdtlstmp Fk',
            'appoct_coursename_en' => 'Appoct Coursename En',
            'appoct_coursename_ar' => 'Appoct Coursename Ar',
            'appoct_courseduration' => 'Appoct Courseduration',
            'appoct_foundationprog' => 'Appoct Foundationprog',
            'appoct_courselevel' => 'Appoct Courselevel',
            'appoct_coursecategorymst_fk' => 'Appoct Coursecategorymst Fk',
            'appoct_coursesubcategorymst_fk' => 'Appoct Coursesubcategorymst Fk',
            'appoct_coursetested' => 'Appoct Coursetested',
            'appoct_appintrecogtmp_fk' => 'Appoct Appintrecogtmp Fk',
            'appoct_createdon' => 'Appoct Createdon',
            'appoct_createdby' => 'Appoct Createdby',
            'appoct_updatedon' => 'Appoct Updatedon',
            'appoct_updatedby' => 'Appoct Updatedby',
            'appoct_status' => 'Appoct Status',
            'appoct_appdecon' => 'Appoct Appdecon',
            'appoct_appdecby' => 'Appoct Appdecby',
            'appoct_appdeccomment' => 'Appoct Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoctApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appoct_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoctCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'appoct_coursecategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoctCoursesubcategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'appoct_coursesubcategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercourseunittmpTbls()
    {
        return $this->hasMany(AppoffercourseunittmpTbl::className(), ['appocut_appoffercoursetmp_fk' => 'appoffercoursetmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfotmpTbls()
    {
        return $this->hasMany(AppstaffinfotmpTbl::className(), ['appsit_applicationdtlstmp_fk' => 'appoffercoursetmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffinfotmpTbls()
    {
        return $this->hasMany(StaffinfotmpTbl::className(), ['sit_opalmemberregmst_fk' => 'appoffercoursetmp_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercoursetmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoffercoursetmpTblQuery(get_called_class());
    }

    public static function saveCourse($requestdata){
        $model = new AppoffercoursetmpTbl();
        $model->appoct_opalmemberregmst_fk = $requestdata['appoct_opalmemberregmst_fk'];
        $model->appoct_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        $model->appoct_coursename_en = $requestdata['course_titleen'];
        $model->appoct_coursename_ar = $requestdata['course_titlear'];
        $model->appoct_courseduration = $requestdata['course_durat'];
        $model->appoct_foundationprog = ($requestdata['slider']==1)? 1: 2;
        $model->appoct_courselevel = $requestdata['cour_level'];
        $model->appoct_coursecategorymst_fk = $requestdata['cour_cate'];

        // $cour_sub = "";
        // if(!empty($requestdata['cousesub_category'])){
        //     $cour_sub = implode(',', $requestdata['cousesub_category']);
        // }

        $model->appoct_coursesubcategorymst_fk = $requestdata['cousesub_category'];
        
        $model->appoct_coursetested = $requestdata['cour_tested'];
        $inter_organ = "";
        if(!empty($requestdata['inter_organ'])){
            $inter_organ = implode(',', $requestdata['inter_organ']);
        }
        $model->appoct_appintrecogtmp_fk = $inter_organ;
        $model->appoct_status = 1;
        $model->appoct_createdon = date("Y-m-d H:i:s");
        $model->appoct_createdby = $requestdata['appoct_createdby'];
        
        
            if($model->save()){
                if(!empty($requestdata['Referrals'])){
                    foreach($requestdata['Referrals'] as $requestdataVal){ 
                    //start for loop
                    $modelOffUnt = new AppoffercourseunittmpTbl();
                    $modelOffUnt->appocut_appoffercoursetmp_fk = $model->appoffercoursetmp_pk;
                    $modelOffUnt->appocut_status = 1;
                    $modelOffUnt->appocut_unitcode = $requestdataVal['unit_titl'];
                    $modelOffUnt->appocut_unittitle = $requestdataVal['unit_code'];
                    $modelOffUnt->appocut_createdon = date("Y-m-d H:i:s");
                    $modelOffUnt->appocut_createdby = $requestdata['appoct_createdby'];
                    $modelOffUnt->save();
                    //end for loop
                    }
                }

                //update status for re submit starts
                $resStsApp = AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlstmp_id']);
              //  $resStsAppUpdate = AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'],$requestdata['appdtlstmp_id']);
                //update status for re submit ends

                return $model->appoffercoursetmp_pk;
                
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            } 
        }

        public static function updateCourse($requestdata){

            $resSts = AppoffercoursetmpTbl::changeStatus($requestdata['appoffercoursetmp_pk']);

            $model = AppoffercoursetmpTbl::find()->where(['appoffercoursetmp_pk' => $requestdata['appoffercoursetmp_pk']])->one();
            $model->appoffercoursetmp_pk = $requestdata['appoffercoursetmp_pk'];

            $model->appoct_opalmemberregmst_fk = $requestdata['appoct_opalmemberregmst_fk'];
            $model->appoct_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
            $model->appoct_coursename_en = $requestdata['course_titleen'];
            $model->appoct_coursename_ar = $requestdata['course_titlear'];
            $model->appoct_courseduration = $requestdata['course_durat'];
            $model->appoct_foundationprog = ($requestdata['slider']==1)? 1: 2;
            $model->appoct_courselevel = $requestdata['cour_level'];
            $model->appoct_coursecategorymst_fk = $requestdata['cour_cate'];
            // $cour_sub = "";
            // if(!empty($requestdata['cousesub_category'])){
            //     $cour_sub = implode(',', $requestdata['cousesub_category']);
            // }
            $model->appoct_coursesubcategorymst_fk = $requestdata['cousesub_category'];
            // $cour_tested = "";
            // if(!empty($requestdata['cour_tested'])){
            //     $cour_tested = implode(',', $requestdata['cour_tested']);
            // }
            $model->appoct_coursetested = $requestdata['cour_tested'];
            $inter_organ = "";
            if(!empty($requestdata['inter_organ'])){
                $inter_organ = implode(',', $requestdata['inter_organ']);
            }
            $model->appoct_appintrecogtmp_fk = $inter_organ;
            //$model->appoct_status = 1;
            if(!empty($resSts)){
                $model->appoct_status = 2;
                //$model->appoct_appdeccomment = "";
            }
            $model->appoct_updatedon = date("Y-m-d H:i:s");
            $model->appoct_updatedby = $requestdata['appoct_createdby'];
            
            
            if($model->save()){
                if(!empty($requestdata['Referrals'])){
                    
                    $courDelRes = \Yii::$app->db->createCommand("select appoffercourseunittmp_pk from appoffercourseunittmp_tbl where appocut_appoffercoursetmp_fk=$model->appoffercoursetmp_pk")->queryAll();
                    
                    $arrayUntPk = [];
                    if(!empty($courDelRes)){
                        foreach($courDelRes as $courDelInfo){
                            $arrayUntPk[$courDelInfo['appoffercourseunittmp_pk']] = $courDelInfo['appoffercourseunittmp_pk'];
                        }
                    }

                    $arrayUntFormPk = [];
                    if(!empty($requestdata['Referrals'])){
                        foreach($requestdata['Referrals'] as $requestdataValForm){
                            if(!empty($requestdataValForm['unit_pk'])){
                                $arrayUntFormPk[$requestdataValForm['unit_pk']] = $requestdataValForm['unit_pk'];
                            }
                        }
                    }

                    $resultArray=array_diff($arrayUntPk,$arrayUntFormPk);
                    
                    if(!empty($resultArray)){
                        foreach($resultArray as $resultDtls){
                            \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                            \app\models\AppoffercourseunittmpTbl::findOne($resultDtls)->delete();
                            \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                        }
                    }
                    
                    foreach($requestdata['Referrals'] as $requestdataVal){ 
                        //start for loop
                        //echo '<pre>';print_r($requestdataVal);exit;
                        if(!empty($requestdataVal['unit_pk'])){
                            //$modelOffUnt = new AppoffercourseunittmpTbl();
                            $modelOffUnt = AppoffercourseunittmpTbl::find()->where(['appoffercourseunittmp_pk' => $requestdataVal['unit_pk']])->one();
                            //$modelOffUnt->appocut_appoffercoursetmp_fk = $model->appoffercoursetmp_pk;
                            $modelOffUnt->appocut_status = 2;
                            $modelOffUnt->appocut_unitcode = $requestdataVal['unit_code'];
                            $modelOffUnt->appocut_unittitle = $requestdataVal['unit_titl'];
                            $modelOffUnt->appocut_updatedon = date("Y-m-d H:i:s");
                            $modelOffUnt->appocut_updatedby = $requestdata['appoct_createdby'];
                            $modelOffUnt->save();
                        }else{
                            $modelOffUnt = new AppoffercourseunittmpTbl();
                            $modelOffUnt->appocut_appoffercoursetmp_fk = $model->appoffercoursetmp_pk;
                            $modelOffUnt->appocut_status = 1;
                            $modelOffUnt->appocut_unitcode = $requestdataVal['unit_code'];
                            $modelOffUnt->appocut_unittitle = $requestdataVal['unit_titl'];
                            $modelOffUnt->appocut_createdon = date("Y-m-d H:i:s");
                            $modelOffUnt->appocut_createdby = $requestdata['appoct_createdby'];
                            $modelOffUnt->save();
                        }
                        
                        
                        //end for loop
                    }
                }
                
                //update status for re submit starts
                $resStsApp = AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlstmp_id']);
              //  $resStsAppUpdate = AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'],$requestdata['appdtlstmp_id']);
                //update status for re submit ends

                return $model->appoffercoursetmp_pk;
                
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            } 
        }

        public static function updateResbmtAppTmp($resStsApp,$apTmp){
            if(!empty($resStsApp)){
                if($resStsApp >= 5){
                    $modelApup = ApplicationdtlstmpTbl::find()->where("applicationdtlstmp_pk = $apTmp")->one();
                    $modelApup->appdt_status = 1;
                    $modelApup->save();
                }
            } 
        }

        public static function checkStatusAppTmp($appDtlsPk){
            $model = ApplicationdtlstmpTbl::find()
                    ->select(['appdt_status'])
                    ->where("applicationdtlstmp_pk = $appDtlsPk")
                    ->asArray()
                    ->one();
            
            if(!empty($model)){
                return $model;
            }else{
                return false;
            }
        }

        public static function getCourDtls($ipArray) {
            //echo '<pre>';print_r($ipArray);exit;
            $model = AppoffercoursetmpTbl::find()
                    ->select(['*',
                                'DATE_FORMAT(appoct_createdon,"%d-%m-%Y") AS created_on',
                                'DATE_FORMAT(appoct_appdecon,"%d-%m-%Y") AS appdecon',
                                'DATE_FORMAT(appoct_updatedon,"%d-%m-%Y") AS updated_on'])
                    ->leftJoin('referencemst_tbl ref','ref.referencemst_pk = appoffercoursetmp_tbl.appoct_courselevel')
                    ->leftJoin('coursecategorymst_tbl cat','cat.coursecategorymst_pk = appoffercoursetmp_tbl.appoct_coursecategorymst_fk')
                    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appoffercoursetmp_tbl.appoct_appdecby')
                    ->where("appoct_applicationdtlstmp_fk =".$ipArray['appdtlssavetmp_id']);
                    //->asArray()
                    //->all();
            

            if($ipArray['gridsearchValues'] != ''){
                $gridsearchValues = json_decode($ipArray['gridsearchValues'],true);  
                
                $course_title = $gridsearchValues['course_title'];
                $course_dura = $gridsearchValues['course_dura'];
                $course_level = $gridsearchValues['course_level'];
                $course_cate = $gridsearchValues['course_cate'];
                $course_test = $gridsearchValues['course_test'];
                $StatusCour = $gridsearchValues['StatusCour'];
                $adddoncour = $gridsearchValues['adddoncour'];
                $LastUpdatedcour = $gridsearchValues['LastUpdatedcour'];
                            
                if($course_title){
                    $model->andFilterWhere(['AND', ['LIKE', 'appoct_coursename_en', $course_title],]);
                }
    
                if($course_dura){
                    $model->andFilterWhere(['AND', ['LIKE', 'appoct_courseduration', $course_dura],]);
                }

                if($course_level){
                    $model->andFilterWhere(['AND', ['IN', 'appoct_courselevel', $course_level],]);
                }

                if($course_cate){
                    $model->andFilterWhere(['AND', ['IN', 'appoct_coursecategorymst_fk', $course_cate],]);
                }

                if($course_test){
                    $model->andFilterWhere(['AND', ['LIKE', 'appoct_coursetested', $course_test],]);
                }

                if($StatusCour){
                    $model->andFilterWhere(['AND',['IN', 'appoct_status', $StatusCour],]);
                }
    
                if($adddoncour['startDate'] && $adddoncour['endDate']){
                    $model->andFilterWhere(['between', 'date(appoct_createdon)', date('Y-m-d',strtotime($adddoncour['startDate'])), date('Y-m-d',strtotime($adddoncour['endDate']))]);
                }
    
                if($LastUpdatedcour['startDate'] && $LastUpdatedcour['endDate']){
                    $model->andFilterWhere(['between', 'date(appoct_updatedon)', date('Y-m-d',strtotime($LastUpdatedcour['startDate'])), date('Y-m-d',strtotime($LastUpdatedcour['endDate']))]);
                }
            }
            $sort_column = (strpos($ipArray['sort'],"-") !== false) ? explode("-",$ipArray['sort'])[1] : $ipArray['sort'];
            $order_by = ($ipArray['order']=='asc')? 'asc': 'desc';
            $model->orderBy("$sort_column $order_by");
            $model->asArray();
            $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10 ;  
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $ipArray['page']
                ],
            ]);

            $data = $provider->getModels();
           
            $resAry = array();
            $finalAry = array();
            if(!empty($data)){
                foreach($data as $courInfo){
                    $resAry=$courInfo;
                    $resAry['courUnit']= AppoffercourseunittmpTbl::find()->where(['appocut_appoffercoursetmp_fk'=>$courInfo['appoffercoursetmp_pk']])->asArray()->all();
                    $crVal=$courInfo['appoct_coursetested'];
                    $courTstRes = \Yii::$app->db->createCommand("SELECT * from referencemst_tbl where referencemst_pk IN ($crVal)")->queryAll();
                    $ctStr=$ctStrVal=$ctStrAr=$ctStrValAr=array();
                    if(!empty($courTstRes)){
                        foreach($courTstRes as $courTstVal){
                            $ctStr['crEn']=$courTstVal['rm_name_en'];
                            $ctStrVal[]=$courTstVal['rm_name_en'];

                            $ctStrAr['crAr']=$courTstVal['rm_name_ar'];
                            $ctStrValAr[]=$courTstVal['rm_name_ar'];
                        }
                        $resAry['courEn']=implode(",",$ctStrVal);
                        $resAry['courAr']=implode(",",$ctStrValAr);
                    }   

                    $coursemodeldata     =   \app\models\AppoffercoursemainTbl::find()->where("appocm_appoffercoursetmp_fk =:pk", [':pk' => $courInfo['appoffercoursetmp_pk']])->one();
                    $resAry['approval'] = ($coursemodeldata)?1:0;
                    $finalAry[]=$resAry;
                } 
            }

            $response = array();
            $response['data'] = $finalAry ;
            $response['totalcount'] = $provider->getTotalCount();
            $response['size'] = $page;
            return $response;

            // if($finalAry){
            //      return $finalAry; 
            // } else{
            //      return false;
            // }  
        }

        public static function getCourseDtlsFlt(){
            $requestParam = $_GET;
            ini_set ( 'max_execution_time', 1200);
            $query = self::find();
            $statusFilter = $requestParam['statusFilter'];
    
             $query->select(['*',
             'DATE_FORMAT(appoct_createdon,"%d-%m-%Y") AS appoct_createdon',
             'DATE_FORMAT(appoct_updatedon,"%d-%m-%Y") AS appoct_updatedon' ,'DATE_FORMAT(appoct_appdecon,"%d-%m-%Y") AS appoct_appdecon']);
              $query->leftJoin('referencemst_tbl  ref','ref.referencemst_pk = appoffercoursetmp_tbl.appoct_courselevel');
            // $query->leftJoin('appoffercourseunittmp_tbl  unit','unit.appocut_appoffercoursetmp_fk = appoffercoursetmp_tbl.appoffercoursetmp_pk');
             $query->leftJoin('coursecategorymst_tbl  category','category.coursecategorymst_pk = appoffercoursetmp_tbl.appoct_coursecategorymst_fk');
            // $query->leftJoin('referencemst_tbl test','find_in_set(test.referencemst_pk, appoffercoursetmp_tbl.appoct_coursetested)');
           
            
             $query->where([
                'appoct_applicationdtlstmp_fk'=> $requestParam['appid'],
            ]);
            if($requestParam['gridsearchValues'] != ''){
    
                $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
             
                $coursename= $gridsearchValues['appoct_coursename_en'];
                $courseduration = $gridsearchValues['appoct_courseduration'];
                $courselevel = $gridsearchValues['appoct_courselevel'];
                $categorty = $gridsearchValues['appoct_coursecategorymst_fk'];
                $coursetested = $gridsearchValues['appoct_coursetested'];
                $status = $gridsearchValues['appoct_status'];
                $createdon = $gridsearchValues['appoct_createdon'];
                $updatedon = $gridsearchValues['appoct_updatedon'];
               
    
                        
            if($coursename) //course name  filter
        {
                $query->andFilterWhere(['AND',
                ['LIKE', 'appoct_coursename_en', $coursename],
            ]);
        }
           
            if($courseduration) //course  Name filter
            {
                $query->andFilterWhere(['AND',
                ['LIKE', 'appoct_courseduration', $courseduration],
            ]);
            }

            // if($courselevel) //course level  Name filter
            // {
            //     $query->andFilterWhere(['AND',
            //     ['LIKE', 'appoct_courselevel', $courselevel],
            // ]);
            // }

            
            if($courselevel)  //course level  Name filter
              
            {

            if(count($courselevel) >1){
                $appcond ="";
                foreach($courselevel as $test){
               if(in_array($test, $courselevel)){ 
                   $appcond .= "appoct_courselevel='$test' ||";
               }
               }


               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
               }else{
                if(in_array($courselevel[0], $courselevel)){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $courselevel[0];
                    $query->andWhere("appoct_courselevel='$pymt_sts' ");
                }
            }
            }

    


            if($categorty)   //category Name filter
              
            {

            if(count($categorty) >1){
                $appcond ="";
                foreach($categorty as $test){
               if(in_array($test, $categorty)){ 
                   $appcond .= "appoct_coursecategorymst_fk='$test' ||";
               }
               }


               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
               }else{
                if(in_array($categorty[0], $categorty)){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $categorty[0];
                    $query->andWhere("appoct_coursecategorymst_fk='$pymt_sts' ");
                }
            }
            }

           
            if($coursetested)   //course tested  Name filter
              
            {

            if(count($coursetested) >1){
                $appcond ="";
                foreach($coursetested as $test){
               if(in_array($test, $coursetested)){ 
                   $appcond .= "appoct_coursetested='$test' ||";
               }
               }


               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
               }else{
                if(in_array($coursetested[0], $coursetested)){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $coursetested[0];
                    $query->andWhere("appoct_coursetested='$pymt_sts' ");
                }
            }
            }
    
         
            if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
            {
                $query->andFilterWhere(['between', 'date(appoct_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
            }
    
         

            if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
            {
                $query->andFilterWhere(['between', 'date(appoct_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
            }

        

            if($status){  // Status Filter
                if(count($status) >1){
                    $appcond ="";
                   if(in_array(1, $status)){ //new
                       $appcond .= "appoct_status='1' ||";
                   }
                   if(in_array(2, $status)){ //updated
                    $appcond .= "appoct_status='2' ||";
                   }
                   if(in_array(3, $status)){ //Approved
                    $appcond .= "appoct_status='3' ||";
                   }
                   if(in_array(4, $status)){ //Declined
                    $appcond .= "appoct_status='4' ||";
                   }
                   
                   $paymentstscond = rtrim($appcond, "||");
                   $query->andWhere($paymentstscond);
                }else{
                    if(in_array($status[0], [1,2,3,4])){ //Validation new/updated/Approved/Declined
                        $pymt_sts = $status[0];
                        $query->andWhere("appoct_status='$pymt_sts' ");
                    }
                }
            }



        


            }
    
           // $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
              $sort_column = 'appoffercoursetmp_pk';
            // if($sort_column=='invoicedays')
            // {
            //     $sort_column='mcid.mcid_generatedon';
            // }
            // if($sort_column == 'MCM_JSRSRegistrationNo'){
            //     $sort_column = "cast(MCM_JSRSRegistrationNo as unsigned)";
            // }
           // $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
            
               // $query->orderBy(["$sort_column" => $order_by]);
               
               
       $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
       $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
       $query->orderBy(["$sort_column" => $order_by]);
            $query->asArray();
    
          
        //     $raw = $query->createCommand()->getRawSql();
        //    echo "<pre>"; print_r($raw); exit;
            $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $requestParam['page']
                ]
            ]);

         $data = \app\models\ReferencemstTbl::find()->where(['rm_mastertype' => 8])->asArray()->all();
         foreach($data as $value){
            $aMemberships[$value['referencemst_pk']] = $value['rm_name_en'];
           
         }
       
        foreach ($provider->getModels() as $key => $favResData) {
            $histmodel     =   \app\models\AppoffercoursehstyTbl::find()->where("appoch_AppOfferCoursetmp_FK =:pk", [':pk' => $favResData['appoffercoursetmp_pk']])->orderBy(["AppOfferCourseHsty_PK" => SORT_DESC])->limit(2)->asArray()->all();
            $favData[$key] = $favResData;
            $favData[$key]['hisstatus'] = $histmodel[1]['appoch_status'];
            $favData[$key]['coursetested'] = $aMemberships[$favResData['appoct_coursetested']];
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appoct_appdecby']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['appoct_updatedon'] = ($favResData['appoct_updatedon'])?$favResData['appoct_updatedon']:"-";
            $favData[$key]['status'] = ($favResData['appoct_appdeccomment'])?$favResData['appoct_appdeccomment']:'Nil';
           }

           $condata  =  \app\models\AppoffercoursetmpTbl::find()->where("appoct_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])->asArray()->All();
           foreach($condata as $key => $value){
   
               $docarray[] = $value['appoct_status'];
           }
   
           if (count(array_unique($docarray)) === 1) {
               $datastatus=$docarray[0];
               } else {
               if(in_array(3,$docarray)){
                   $datastatus=3;
   
               }
               if(in_array(4,$docarray)){
                   $datastatus=4;
   
               }elseif(in_array(1,$docarray)){
                   $datastatus=1;
   
               }elseif(in_array(2,$docarray)){
                   $datastatus=2;
   
               }
               }
           // $data = $provider->getModels();
            $response = array();
            $response['data'] = $favData;
            $response['appstatus'] = $datastatus;
            $response['totalcount'] = $provider->getTotalCount();
            $response['size'] = $page;
            return $response;
    }

    public static function changeStatus($appDtlsPk){
        $model = AppoffercoursetmpTbl::find()
                ->select(['appoct_status'])
                ->where("appoffercoursetmp_pk = $appDtlsPk")
                ->andWhere("appoct_status = 2 OR appoct_status = 3 OR appoct_status = 4")
                ->asArray()
                ->one();

        if(!empty($model)){
            return true;
        }else{
            return false;
        } 
    }

    public static function fetchFavResult($courseid, $pageSize , $page){
  
        $favQuery = self::find();
        $favQuery->select([
                        '*','DATE_FORMAT(appoct_appdecon,"%d-%m-%Y") AS appoct_appdecon'
                    ])
                    // ->leftJoin('appoffercoursetmp_tbl  temp','temp.appoffercoursetmp_pk = appocut_appoffercoursetmp_fk')
                    ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = appoct_applicationdtlstmp_fk')
                    ->leftJoin('coursecategorymst_tbl main','main.coursecategorymst_pk = appoct_coursecategorymst_fk');
                   
        $favQuery->where([
                        'appoffercoursetmp_pk'=> $courseid,
                    ]);
        $favQry = $favQuery->orderBy(['appoffercoursetmp_pk'=>SORT_DESC])
                    ->asArray();
        $favProvider = new \yii\data\ActiveDataProvider([
            'query' => $favQry,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
        ]);
        foreach ($favProvider->getModels() as $key => $favResData) {
           
            $favData[$key] = $favResData;
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appoct_appdecby']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
           }

        $favouriteRes['data'] = $favData;
        $favouriteRes['totalcount'] = $favProvider->getTotalCount();
        $favouriteRes['size'] = $pageSize;
        $favouriteRes['page'] = $page;
    
        return $favouriteRes;
    }

    
    

}
