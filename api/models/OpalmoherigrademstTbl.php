<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "opalmoherigrademst_tbl".
 *
 * @property int $opalmoherigradingmst_pk used as primary key
 * @property string $omgm_gradename_en grade name english
 * @property string $omgm_gradename_ar grade name arabic
 * @property int $omgm_status 1-active, 2-inactive
 * @property string $omgm_createdon datetime of creation
 * @property int $omgm_createdby reference to opalusemst_tbl
 * @property string $omgm_updatedon datetime of updation
 * @property int $omgm_updatedby reference to opalusermst_tbl
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 */
class OpalmoherigrademstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalmoherigrademst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['omgm_gradename_en', 'omgm_gradename_ar', 'omgm_status', 'omgm_createdon', 'omgm_createdby'], 'required'],
            [['omgm_status', 'omgm_createdby', 'omgm_updatedby'], 'integer'],
            [['omgm_createdon', 'omgm_updatedon'], 'safe'],
            [['omgm_gradename_en', 'omgm_gradename_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalmoherigradingmst_pk' => 'Opalmoherigradingmst Pk',
            'omgm_gradename_en' => 'Omgm Gradename En',
            'omgm_gradename_ar' => 'Omgm Gradename Ar',
            'omgm_status' => 'Omgm Status',
            'omgm_createdon' => 'Omgm Createdon',
            'omgm_createdby' => 'Omgm Createdby',
            'omgm_updatedon' => 'Omgm Updatedon',
            'omgm_updatedby' => 'Omgm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['omrm_opalmoherigradingmst_pk' => 'opalmoherigradingmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalmoherigrademstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalmoherigrademstTblQuery(get_called_class());
    }

    public function getMoherigradelist($limit, $index, $searchkey, $sort){
        $grade = self::find()
         ->select(['omgm_gradename_en as grade_en','omgm_gradename_ar as grade_ar','omgm_status as status', 'omgm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'omgm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','opalmoherigradingmst_pk as pk'])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = omgm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = omgm_updatedby');
         if(!empty($searchkey['grade'])){
            $grade->andWhere(['Like', 'omgm_gradename_en', $searchkey['grade']]);
         }
         if(!empty($searchkey['status'])){
            $grade->andwhere(['IN', 'omgm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $grade->andWhere('omgm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $grade->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $grade->andWhere('omgm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $grade->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'grade'){
                $grade->orderby('omgm_gradename_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $grade->orderby('omgm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $grade->orderby('omgm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $grade->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $grade->orderby('omgm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $grade->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $grade->orderby('omgm_createdon desc');
         }
         
         $grade->asArray();


         $dataProvider = new ActiveDataProvider([
            'query' => $grade,
            'pagination' => [
               'pageSize' =>$limit,
               'page'=>$index
            ]
         ]);
          
         $card = $dataProvider->getModels();
   
         $recodsset =[];
         $recodsset['grade'] = $card;
         $recodsset['pagesize'] = $limit;
         $recodsset['totalcount'] = $dataProvider->getTotalCount();
   
         return $recodsset;
    }

    public function getMoherigrade($id){
        return self::find()->where(['=','opalmoherigradingmst_pk', $id])->one();
    }

    
    public function alreadyExist($name){
        return self::find()->where('UPPER(omgm_gradename_en) = UPPER("'.$name.'")')->one();
    }

    public function addmoherigrade($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $gradedata = [
            'omgm_gradename_en' => $data['grade_en'],
            'omgm_gradename_ar' => $data['grade_ar'],
            'omgm_status' => 1,
            'omgm_createdon' => date('Y-m-d H:i:s'),
            'omgm_createdby' => $userPk
        ];

        $grade = new OpalmoherigrademstTbl($gradedata);
        if($grade->save()){
            return $grade;
        }else{
            echo "<pre>";
            print_r($grade->getErrors());
            die;
        }

    }

    public function updateMoherigrade($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $grade = self::find()->where(['=','opalmoherigradingmst_pk', $data['id']])->one();
        
        $gradedata = [
            'omgmh_opalmoherigradingmst_fk'=>$data['id'],
            'omgmh_gradename_en' => $grade->omgm_gradename_en,
            'omgmh_gradename_ar' => $grade->omgm_gradename_ar,
            'omgmh_status' =>  $grade->omgm_status,
            'omgmh_createdon' =>  $grade->omgm_createdon,
            'omgmh_createdby' =>  $grade->omgm_createdby,
            'omgmh_updatedon'=> $grade->omgm_updatedon,
            'omgmh_updatedby' => $grade->omgm_updatedby
        ];

        $gradehis = new OpalmoherigrademsthstyTbl($gradedata);
        if($gradehis->save()){
            $grade->omgm_gradename_en = $data['grade_en'];
            $grade->omgm_gradename_ar = $data['grade_ar'];
            $grade->omgm_updatedon = date('Y-m-d H:i:s');
            $grade->omgm_updatedby = $userPk;
            if($grade->save()){
                $transaction->commit();
                return $grade;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($grade->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($gradehis->getErrors());
            die;
        }
    }

    public function updatemoherigradestatus($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $grade = self::find()->where(['=','opalmoherigradingmst_pk', $data['id']])->one();
        
        $gradedata = [
            'omgmh_opalmoherigradingmst_fk'=>$data['id'],
            'omgmh_gradename_en' => $grade->omgm_gradename_en,
            'omgmh_gradename_ar' => $grade->omgm_gradename_ar,
            'omgmh_status' =>  $grade->omgm_status,
            'omgmh_createdon' =>  $grade->omgm_createdon,
            'omgmh_createdby' =>  $grade->omgm_createdby,
            'omgmh_updatedon'=> $grade->omgm_updatedon,
            'omgmh_updatedby' => $grade->omgm_updatedby
        ];

        $gradehis = new OpalmoherigrademsthstyTbl($gradedata);
        if($gradehis->save()){
            $grade->omgm_status = $data['status'];
            $grade->omgm_updatedon = date('Y-m-d H:i:s');
            $grade->omgm_updatedby = $userPk;
            if($grade->save()){
                $transaction->commit();
                return $grade;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($grade->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($gradehis->getErrors());
            die;
        }

    }
}
