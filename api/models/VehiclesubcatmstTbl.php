<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehiclesubcatmst_tbl".
 *
 * @property int $vehiclesubcatmst_pk
 * @property int $vscm_rascategorymst_fk Reference to rascategorymst_pk
 * @property string $vscm_vehiclename_en
 * @property string $vscm_vehiclename_ar
 * @property string $vscm_vehiclesubcatcode
 * @property int $vscm_status 1-Active, 2-Inactive, by default 1
 * @property string $vscm_createdon
 * @property int $vscm_createdby
 * @property string $vscm_updatedon
 * @property int $vscm_updatedby
 *
 * @property IvmsvehicleregdtlsTbl[] $ivmsvehicleregdtlsTbls
 * @property IvmsvehicleregdtlshstyTbl[] $ivmsvehicleregdtlshstyTbls
 * @property RascategorymstTbl $vscmRascategorymstFk
 * @property VehiclesubcatmsthstyTbl[] $vehiclesubcatmsthstyTbls
 */
class VehiclesubcatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehiclesubcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vscm_rascategorymst_fk', 'vscm_vehiclename_en', 'vscm_vehiclename_ar', 'vscm_status', 'vscm_createdby'], 'required'],
            [['vscm_rascategorymst_fk', 'vscm_status', 'vscm_createdby', 'vscm_updatedby'], 'integer'],
            [['vscm_vehiclename_en', 'vscm_vehiclename_ar'], 'string'],
            [['vscm_createdon', 'vscm_updatedon'], 'safe'],
            [['vscm_vehiclesubcatcode'], 'string', 'max' => 45],
            [['vscm_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['vscm_rascategorymst_fk' => 'rascategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehiclesubcatmst_pk' => 'Vehiclesubcatmst Pk',
            'vscm_rascategorymst_fk' => 'Vscm Rascategorymst Fk',
            'vscm_vehiclename_en' => 'Vscm Vehiclename En',
            'vscm_vehiclename_ar' => 'Vscm Vehiclename Ar',
            'vscm_vehiclesubcatcode' => 'Vscm Vehiclesubcatcode',
            'vscm_status' => 'Vscm Status',
            'vscm_createdon' => 'Vscm Createdon',
            'vscm_createdby' => 'Vscm Createdby',
            'vscm_updatedon' => 'Vscm Updatedon',
            'vscm_updatedby' => 'Vscm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsvehicleregdtlsTbls()
    {
        return $this->hasMany(IvmsvehicleregdtlsTbl::className(), ['ivrd_vehiclesubcat' => 'vehiclesubcatmst_pk']);
    }
	  /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsvehicleregdtlshstyTbls()
    {
        return $this->hasMany(IvmsvehicleregdtlshstyTbl::className(), ['ivrdh_vehiclesubcat' => 'vehiclesubcatmst_pk']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVscmRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'vscm_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehiclesubcatmsthstyTbls()
    {
        return $this->hasMany(VehiclesubcatmsthstyTbl::className(), ['vscmh_vehiclesubcatmst_fk' => 'vehiclesubcatmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return VehiclesubcatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehiclesubcatmstTblQuery(get_called_class());
    }
	public static function getVehicleSubcatListByCatpk($catPk)
    {
        $data = self::find()
                ->select(['vehiclesubcatmst_pk as pk', 'trim(vscm_vehiclename_en) as name_en', 'trim(vscm_vehiclename_ar) as name_ar'])
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = vscm_rascategorymst_fk')
                ->andWhere(['=', 'vscm_status', 1])
                ->andWhere(['=', 'vscm_rascategorymst_fk', $catPk])//->createCommand()->getRawSql();
//               ->groupBy('standardcoursemst_pk')
                ->asArray()
                ->all();

        return $data;
}
    public function getVehicleSubCategorylist($limit, $index, $searchkey, $sort){
        $vehicle = self::find()
         ->select(['vscm_vehiclesubcatcode as code','vscm_vehiclename_en as vehicle_en','vscm_vehiclename_ar as vehicle_ar','vscm_status as status', 'vscm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'vscm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','vehiclesubcatmst_pk as pk'])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = vscm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = vscm_updatedby');
         if(!empty($searchkey['code'])){
            $vehicle->andWhere(['Like', 'vscm_vehiclesubcatcode', $searchkey['code']]);
         }
         if(!empty($searchkey['vehicle'])){
            $vehicle->andWhere(['Like', 'vscm_vehiclename_en', $searchkey['vehicle']]);
         }
         if(!empty($searchkey['status'])){
            $vehicle->andwhere(['IN', 'vscm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $vehicle->andWhere('vscm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $vehicle->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $vehicle->andWhere('vscm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $vehicle->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'code'){
                $vehicle->orderby('vscm_vehiclesubcatcode '.$sort['dir']);
            }
            if($sort['key'] == 'course'){
                $vehicle->orderby('vscm_vehiclename_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $vehicle->orderby('vscm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $vehicle->orderby('vscm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $vehicle->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $vehicle->orderby('vscm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $vehicle->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $vehicle->orderby('vscm_createdon desc');
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

    public function getVehicleSubCategory($id){
        return self::find()->where(['=','vehiclesubcatmst_pk', $id])->one();
    }

    public function alreadyExist($name){
        return self::find()->where('UPPER(vscm_vehiclename_en) = UPPER("'.$name.'")')->one();
    }

    public function addVehicleSubCategory($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicledata = [
            'vscm_vehiclename_en' => $data['subcategoty_en'],
            'vscm_vehiclename_ar' => $data['subcategoty_ar'],
            'vscm_vehiclesubcatcode' => $data['code'],
            'vscm_status' => 1,
            'vscm_createdon' => date('Y-m-d H:i:s'),
            'vscm_createdby' => $userPk
        ];

        $vehicle = new VehiclesubcatmstTbl($vehicledata);
        if($vehicle->save()){
            return $vehicle;
        }else{
            echo "<pre>";
            print_r($vehicle->getErrors());
            die;
        }
    }

    public function updateVehicleSubCategory($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $vehicle = self::find()->where(['=','vehiclesubcatmst_pk', $data['id']])->one();
        $vehicledata = [
            'vscmh_vehiclesubcatmst_fk' => $data['id'],
            'vscmh_rascategorymst_fk' => $vehicle->vscm_rascategorymst_fk,
            'vscmh_vehiclename_en' => $vehicle->vscm_vehiclename_en,
            'vscmh_vehiclename_ar' => $vehicle->vscm_vehiclename_ar,
            'vscmh_vehiclesubcatcode' => $vehicle->vscm_vehiclesubcatcode,
            'vscmh_status' => $vehicle->vscm_status,
            'vscmh_createdon' => $vehicle->vscm_createdon,
            'vscmh_createdby' => $vehicle->vscm_createdby,
            'vscmh_updatedon' => $vehicle->vscm_updatedon,
            'vscmh_updatedby' => $vehicle->vscm_updatedby,
        ];
        $vehiclehis = new VehiclesubcatmsthstyTbl($vehicledata);
        if($vehiclehis->save()){
            $vehicle->vscm_rascategorymst_fk = $data['Vehicle'];
            $vehicle->vscm_vehiclename_en = $data['subcategoty_en'];
            $vehicle->vscm_vehiclename_ar = $data['subcategoty_ar'];
            $vehicle->vscm_vehiclesubcatcode = $data['code'];
            $vehicle->vscm_updatedon = date('Y-m-d H:i:s');
            $vehicle->vscm_updatedby = $userPk;
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
        $vehicle = self::find()->where(['=','vehiclesubcatmst_pk', $data['id']])->one();
        if($data['status'] == 1){
            $vehicledata = [
                'vscmh_vehiclesubcatmst_fk' => $data['id'],
                'vscmh_rascategorymst_fk' => $vehicle->vscm_rascategorymst_fk,
                'vscmh_vehiclename_en' => $vehicle->vscm_vehiclename_en,
                'vscmh_vehiclename_ar' => $vehicle->vscm_vehiclename_ar,
                'vscmh_vehiclesubcatcode' => $vehicle->vscm_vehiclesubcatcode,
                'vscmh_status' => $vehicle->vscm_status,
                'vscmh_createdon' => $vehicle->vscm_createdon,
                'vscmh_createdby' => $vehicle->vscm_createdby,
                'vscmh_updatedon' => $vehicle->vscm_updatedon,
                'vscmh_updatedby' => $vehicle->vscm_updatedby,
            ];
    
            $vehiclehis = new VehiclesubcatmsthstyTbl($vehicledata);
            if($vehiclehis->save()){
                $vehicle->vscm_status = $data['status'];
                $vehicle->vscm_updatedon = date('Y-m-d H:i:s');
                $vehicle->vscm_updatedby = $userPk;
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
            $standardcoursemst = StandardcoursemstTbl::find()->where(['=','scm_coursecategorymst_fk',$data['id']])->all();
            if($standardcoursemst){
                return 2;
            }else{
                $centre = AppoffercoursetmpTbl::find()->where(['=','appoct_coursecategorymst_fk',$data['id']])->all();
                if($centre){
                    return 3;
                }else{
                    $vehicledata = [
                        'vscmh_vehiclesubcatmst_fk' => $data['id'],
                        'vscmh_rascategorymst_fk' => $vehicle->vscm_rascategorymst_fk,
                        'vscmh_vehiclename_en' => $vehicle->vscm_vehiclename_en,
                        'vscmh_vehiclename_ar' => $vehicle->vscm_vehiclename_ar,
                        'vscmh_vehiclesubcatcode' => $vehicle->vscm_vehiclesubcatcode,
                        'vscmh_status' => $vehicle->vscm_status,
                        'vscmh_createdon' => $vehicle->vscm_createdon,
                        'vscmh_createdby' => $vehicle->vscm_createdby,
                        'vscmh_updatedon' => $vehicle->vscm_updatedon,
                        'vscmh_updatedby' => $vehicle->vscm_updatedby,
                    ];
            
                    $vehiclehis = new VehiclesubcatmsthstyTbl($vehicledata);
                    if($vehiclehis->save()){
                        $vehicle->vscm_status = $data['status'];
                        $vehicle->vscm_updatedon = date('Y-m-d H:i:s');
                        $vehicle->vscm_updatedby = $userPk;
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
