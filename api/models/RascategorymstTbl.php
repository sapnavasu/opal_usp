<?php

namespace app\models;

use Yii;
use app\models\VehiclesubcatmstTbl;

/**
 * This is the model class for table "rascategorymst_tbl".
 *
 * @property int $rascategorymst_pk primary key
 * @property int $rcm_projectmst_fk Reference to projectmst_pk
 * @property int $rcm_coursecategorymst_fk Reference to coursecategorymst_pk Stores the sub-category of defensive driving
 * @property int $rcm_status 1-Active, 2-Inactive, by default 1
 * @property string $rcm_createdon
 * @property int $rcm_createdby
 * @property string $rcm_updatedon
 * @property int $rcm_updatedby
 *
 * @property CoursecategorymstTbl $rcmCoursecategorymstFk
 * @property ProjectmstTbl $rcmProjectmstFk
 * @property StaffcompetencycarddtlsTbl[] $staffcompetencycarddtlsTbls
 * @property StaffevaluationhstyTbl[] $staffevaluationhstyTbls
 * @property StaffevaluationmainTbl[] $staffevaluationmainTbls
 * @property StaffevaluationtmpTbl[] $staffevaluationtmpTbls
 */
class RascategorymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rascategorymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rcm_projectmst_fk', 'rcm_coursecategorymst_fk', 'rcm_createdby'], 'required'],
            [['rcm_projectmst_fk', 'rcm_coursecategorymst_fk', 'rcm_status', 'rcm_createdby', 'rcm_updatedby'], 'integer'],
            [['rcm_createdon', 'rcm_updatedon'], 'safe'],
            [['rcm_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['rcm_coursecategorymst_fk' => 'coursecategorymst_pk']],
            [['rcm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['rcm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rascategorymst_pk' => 'primary key',
            'rcm_projectmst_fk' => 'Reference to projectmst_pk',
            'rcm_coursecategorymst_fk' => 'Reference to coursecategorymst_pk Stores the sub-category of defensive driving',
            'rcm_status' => '1-Active, 2-Inactive, by default 1',
            'rcm_createdon' => 'Rcm Createdon',
            'rcm_createdby' => 'Rcm Createdby',
            'rcm_updatedon' => 'Rcm Updatedon',
            'rcm_updatedby' => 'Rcm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRcmCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'rcm_coursecategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRcmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'rcm_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffcompetencycarddtlsTbls()
    {
        return $this->hasMany(StaffcompetencycarddtlsTbl::className(), ['sccd_rascategorymst_fk' => 'rascategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationhstyTbls()
    {
        return $this->hasMany(StaffevaluationhstyTbl::className(), ['seh_rascategorymst_fk' => 'rascategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationmainTbls()
    {
        return $this->hasMany(StaffevaluationmainTbl::className(), ['sem_rascategorymst_fk' => 'rascategorymst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationtmpTbls()
    {
        return $this->hasMany(StaffevaluationtmpTbl::className(), ['set_rascategorymst_fk' => 'rascategorymst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return RascategorymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RascategorymstTblQuery(get_called_class());
    }

    public function getVehicleCategorylist($limit, $index, $searchkey, $sort){
        $vehicle = self::find()
         ->select(['rcm_vehiclecode as code','rcm_coursesubcatname_en as vehicle_en','rcm_coursesubcatname_ar as vehicle_ar','rcm_status as status', 'rcm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'rcm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','rascategorymst_pk as pk'])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = rcm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = rcm_updatedby');
         if(!empty($searchkey['code'])){
            $vehicle->andWhere(['Like', 'rcm_vehiclecode', $searchkey['code']]);
         }
         if(!empty($searchkey['vehicle'])){
            $vehicle->andWhere(['Like', 'rcm_coursesubcatname_en', $searchkey['vehicle']]);
         }
         if(!empty($searchkey['status'])){
            $vehicle->andwhere(['IN', 'rcm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $vehicle->andWhere('rcm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $vehicle->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $vehicle->andWhere('rcm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $vehicle->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'code'){
                $vehicle->orderby('rcm_vehiclecode '.$sort['dir']);
            }
            if($sort['key'] == 'course'){
                $vehicle->orderby('rcm_coursesubcatname_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $vehicle->orderby('rcm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $vehicle->orderby('rcm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $vehicle->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $vehicle->orderby('rcm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $vehicle->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $vehicle->orderby('rcm_createdon desc');
         }
         
         $vehicle->asArray();


         $dataProvider = new ActiveDataProvider([
            'query' => $vehicle,
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

    public function getVehiclecategory($id){
        return self::find()->where(['=','rascategorymst_pk', $id])->one();
    }

    public function alreadyExist($name){
        return self::find()->where('UPPER(rcm_coursesubcatname_en) = UPPER("'.$name.'")')->one();
    }

    public function addVehicleCategory($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicledata = [
            'rcm_coursesubcatname_en' => $data['vehicle_en'],
            'rcm_coursesubcatname_ar' => $data['vehicle_ar'],
            'rcm_vehiclecode' => $data['code'],
            'rcm_status' => 1,
            'rcm_createdon' => date('Y-m-d H:i:s'),
            'rcm_createdby' => $userPk
        ];

        $vehicle = new RascategorymstTbl($vehicledata);
        if($vehicle->save()){
            return $vehicle;
        }else{
            echo "<pre>";
            print_r($vehicle->getErrors());
            die;
        }
    }

    public function updateVehicleCategory($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = self::find()->where(['=','rascategorymst_pk', $data['id']])->one();
        $vehicledata = [
            'rcmh_rascategorymst_fk' => $data['id'],
            'rcmh_coursesubcatname_en' => $vehicle->rcm_coursesubcatname_en,
            'rcmh_coursesubcatname_ar' => $vehicle->rcm_coursesubcatname_ar,
            'rcmh_vehiclecode' => $vehicle->rcm_vehiclecode,
            'rcmh_status' => $vehicle->rcm_status,
            'rcmh_createdon' => $vehicle->rcm_createdon,
            'rcmh_createdby' => $vehicle->rcm_createdby,
            'rcmh_updatedon' => $vehicle->rcm_updatedon,
            'rcmh_updatedby' => $vehicle->rcm_updatedby,
        ];
        $vehiclehis = new RascategorymsthstyTbl($vehicledata);
        if($vehiclehis->save()){
            $vehicle->rcm_coursesubcatname_en = $data['vehicle_en'];
            $vehicle->rcm_coursesubcatname_ar = $data['vehicle_ar'];
            $vehicle->rcm_vehiclecode = $data['code'];
            $vehicle->rcm_updatedon = date('Y-m-d H:i:s');
            $vehicle->rcm_updatedby = $userPk;
            if($vehicle->save()){
                $transaction->commit();
                return $vehicle;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($vehicle->getErrors());
                die;
            }
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($vehiclehis->getErrors());
            die;
        }
    }

    public function updatevehiclestatus($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = self::find()->where(['=','rascategorymst_pk', $data['id']])->one();
        if($data['status'] == 1){
            $vehicledata = [
                'rcmh_rascategorymst_fk' => $data['id'],
                'rcmh_coursesubcatname_en' => $vehicle->rcm_coursesubcatname_en,
                'rcmh_coursesubcatname_ar' => $vehicle->rcm_coursesubcatname_ar,
                'rcmh_vehiclecode' => $vehicle->rcm_vehiclecode,
                'rcmh_status' => $vehicle->rcm_status,
                'rcmh_createdon' => $vehicle->rcm_createdon,
                'rcmh_createdby' => $vehicle->rcm_createdby,
                'rcmh_updatedon' => $vehicle->rcm_updatedon,
                'rcmh_updatedby' => $vehicle->rcm_updatedby,
            ];
    
            $vehiclehis = new RascategorymsthstyTbl($vehicledata);
            if($vehiclehis->save()){
                $vehicle->rcm_status = $data['status'];
                $vehicle->rcm_updatedon = date('Y-m-d H:i:s');
                $vehicle->rcm_updatedby = $userPk;
                if($vehicle->save()){
                    $transaction->commit();
                    return $vehicle;
                }else{
                    echo "<pre>";
                    $transaction->rollBack();
                    print_r($vehicle->getErrors());
                    die;
                }
                
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($vehiclehis->getErrors());
                die;
            }
        }else{
            $subcat = VehiclesubcatmstTbl::find()->where(['=','vscm_rascategorymst_fk', $data['id']])->andwhere(['=','vscm_status', 1])->all();
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
                        $vehicledata = [
                            'rcmh_rascategorymst_fk' => $data['id'],
                            'rcmh_coursesubcatname_en' => $vehicle->rcm_coursesubcatname_en,
                            'rcmh_coursesubcatname_ar' => $vehicle->rcm_coursesubcatname_ar,
                            'rcmh_vehiclecode' => $vehicle->rcm_vehiclecode,
                            'rcmh_status' => $vehicle->rcm_status,
                            'rcmh_createdon' => $vehicle->rcm_createdon,
                            'rcmh_createdby' => $vehicle->rcm_createdby,
                            'rcmh_updatedon' => $vehicle->rcm_updatedon,
                            'rcmh_updatedby' => $vehicle->rcm_updatedby,
                        ];
                
                        $vehiclehis = new RascategorymsthstyTbl($vehicledata);
                        if($vehiclehis->save()){
                            $vehicle->rcm_status = $data['status'];
                            $vehicle->rcm_updatedon = date('Y-m-d H:i:s');
                            $vehicle->rcm_updatedby = $userPk;
                            if($vehicle->save()){
                                $transaction->commit();
                                return $vehicle;
                            }else{
                                echo "<pre>";
                                $transaction->rollBack();
                                print_r($vehicle->getErrors());
                                die;
                            }
                            
                        }else{
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($vehiclehis->getErrors());
                            die;
                        }
                    }
                }
            }
        }
    }
}
