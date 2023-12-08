<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "referencemst_tbl".
 *
 * @property int $referencemst_pk
 * @property int $rm_mastertype 1-Contract Type master, 2-Operator master, 3-Course Level master, 4-OPAL Star Staff Role master, 5-RAS, 6-OPAL Admin staff role, 7-Staff Contract Type, 8-Course Tested
 * @property string $rm_name_en
 * @property string $rm_name_ar
 * @property int $srm_status 1-Active, 2-Inactive
 * @property string $srm_createdon
 * @property int $srm_createdby
 * @property string $srm_updatedon
 * @property int $srm_updatedby
 */
class ReferencemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referencemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_mastertype', 'rm_name_en', 'srm_status', 'srm_createdby'], 'required'],
            [['rm_mastertype', 'srm_status', 'srm_createdby', 'srm_updatedby'], 'integer'],
            [['srm_createdon', 'srm_updatedon'], 'safe'],
            [['rm_name_en', 'rm_name_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'referencemst_pk' => 'Referencemst Pk',
            'rm_mastertype' => 'Rm Mastertype',
            'rm_name_en' => 'Rm Name En',
            'rm_name_ar' => 'Rm Name Ar',
            'srm_status' => 'Srm Status',
            'srm_createdon' => 'Srm Createdon',
            'srm_createdby' => 'Srm Createdby',
            'srm_updatedon' => 'Srm Updatedon',
            'srm_updatedby' => 'Srm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ReferencemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReferencemstTblQuery(get_called_class());
    }
    
    public static function getMastersListByTypePk($mstTypPk,$excludepks = [])
    {
        $model = self::find()
                ->select(['referencemst_pk as pk','rm_name_en as name_en','rm_name_ar as name_ar'])
                ->where(['=','srm_status',1])
                ->andWhere(['=','rm_mastertype',$mstTypPk])
                ->andWhere(['NOT IN','referencemst_pk',$excludepks])
                ->asArray()
                ->all();
      
        return $model;
    }

    public static function getReferrenceBasedMasterType($mastertype){
        $data = self::find()
                ->select(['referencemst_pk as pk','rm_name_en as name_en','rm_name_ar as name_ar'])
                ->where(['=','rm_mastertype',$mastertype])
                ->andwhere(['=','srm_status',1])
                ->orderBy('referencemst_pk asc')
                ->asArray()
                ->all();
        return $data;
    }
   
    public static function getRefPkByTypePkandName($mstTypPk,$name)
    {
        $model = self::find()
                ->select(['referencemst_pk as pk'])
                ->where(['=','rm_mastertype',$mstTypPk])
                ->andWhere(['OR',['=','rm_name_en',$name],['=','rm_name_ar',$name]])
                ->asArray()
                ->one()['pk'];
      
        return $model;    
   }
    public static function getNameByTypePkandRefPk($mstTypPk,$refPk)
    {
        $model = self::find()
                ->select(['rm_name_en as name_en','rm_name_ar as name_ar'])
                ->where(['=','rm_mastertype',$mstTypPk])
                ->andWhere(['=','referencemst_pk',$refPk])
                ->asArray()
                ->one();
      
        return $model;    
   }
    public function getreferencelist($mastertype, $limit, $index, $searchkey, $sort){
        $refer = self::find()
         ->select(['rm_mastertype as mastertype','rm_name_en as name_en','rm_name_ar as name_ar','srm_status as status', 'srm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'srm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','referencemst_pk as pk'])
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = srm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = srm_updatedby')
         ->where(['=','rm_mastertype',$mastertype]);
         if(!empty($searchkey['name'])){
            $refer->andWhere(['Like', 'rm_name_en', $searchkey['name']]);
         }
         if(!empty($searchkey['status'])){
            $refer->andwhere(['IN', 'srm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $refer->andWhere('srm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $refer->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $refer->andWhere('srm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $refer->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'name'){
                $refer->orderby('rm_name_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $refer->orderby('srm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $refer->orderby('srm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $refer->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $refer->orderby('srm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $refer->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $refer->orderby('srm_createdon desc');
         }
         $refer->asArray();
         $dataProvider = new ActiveDataProvider([
            'query' => $refer,
            'pagination' => [
               'pageSize' =>$limit,
               'page'=>$index
            ]
         ]);
          
         $card = $dataProvider->getModels();
   
         $recodsset =[];
         $recodsset['refer'] = $card;
         $recodsset['pagesize'] = $limit;
         $recodsset['totalcount'] = $dataProvider->getTotalCount();
         return $recodsset;
    }

    public function getreference($id){
        return self::find()->where(['=','referencemst_pk', $id])->one();
    }

    public function alreadyExist($name){
        return self::find()->where('UPPER(rm_name_en) = UPPER("'.$name.'")')->one();
    }
    
    public function addreference($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $referdata = [
            'rm_mastertype' => $data['mastertype'],
            'rm_name_en' => $data['name_en'],
            'rm_name_ar' => $data['name_ar'],
            'srm_status' => 1,
            'srm_createdon' => date('Y-m-d H:i:s'),
            'srm_createdby' => $userPk
        ];

        $refer = new ReferencemstTbl($referdata);
        if($refer->save()){
            return $refer;
        }else{
            echo "<pre>";
            print_r($refer->getErrors());
            die;
        }

    }
    
    public function updatereference($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $refer = self::find()->where(['=','referencemst_pk', $data['id']])->one();
        $referdata = [
            'rmh_referencemst_fk' => $data['id'],
            'rmh_mastertype' => $refer->rm_mastertype,
            'rmh_name_en' => $refer->rm_name_en,
            'rmh_name_ar' => $refer->rm_name_ar,
            'rmh_status' => $refer->srm_status,
            'rmh_createdon' => $refer->srm_createdon,
            'rmh_createdby' => $refer->srm_createdby,
            'rmh_updatedon' => $refer->srm_updatedon,
            'rmh_updatedby' => $refer->srm_updatedby
        ];

        $referhis = new ReferencemsthstyTbl($referdata);
        if($referhis->save()){
            $refer->rm_name_en = $data['name_en'];
            $refer->rm_name_ar = $data['name_ar'];
            $refer->srm_updatedon = date('Y-m-d H:i:s');
            $refer->srm_updatedby = $userPk;
            if($refer->save()){
                $transaction->commit();
                return $refer;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($refer->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($referhis->getErrors());
            die;
        }
    }

    public function updatereferencestatus($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $refer = self::find()->where(['=','referencemst_pk', $data['id']])->one();
        $referdata = [
            'rmh_referencemst_fk' => $data['id'],
            'rmh_mastertype' => $refer->rm_mastertype,
            'rmh_name_en' => $refer->rm_name_en,
            'rmh_name_ar' => $refer->rm_name_ar,
            'rmh_status' => $refer->srm_status,
            'rmh_createdon' => $refer->srm_createdon,
            'rmh_createdby' => $refer->srm_createdby,
            'rmh_updatedon' => $refer->srm_updatedon,
            'rmh_updatedby' => $refer->srm_updatedby
        ];

        $referhis = new ReferencemsthstyTbl($referdata);
        if($referhis->save()){
            $refer->srm_status = $data['status'];
            $refer->srm_updatedon = date('Y-m-d H:i:s');
            $refer->srm_updatedby = $userPk;
            if($refer->save()){
                $transaction->commit();
                return $refer;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($refer->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($referhis->getErrors());
            die;
        }
    }
}
