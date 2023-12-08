<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "countrymst_tbl".
 *
 * @property int $CountryMst_Pk Primary key
 * @property int $cym_globalportalmst_fk Reference to globalportalmst_tbl
 * @property string $CyM_CountryName_en Country Name
 * @property string $cym_cntrylongname Long name of the country
 * @property string $CyM_CountryCode_en Country Code
 * @property string $cym_twodigitcountrycode Two digit country code
 * @property string $CyM_CountryDialCode Country Dial code
 * @property string $CyM_Status Country status. A - Active, I - Inactive
 * @property string $CyM_CreatedOn Datetime of creation
 * @property int $CyM_CreatedBy Reference to adminusermst_tbl
 * @property string $CyM_UpdatedOn Datetime of updation
 * @property int $CyM_UpdatedBy Reference to adminusermst_tbl
 *
 * @property CitymstTbl[] $citymstTbls
 * @property UsermstTbl $cyMCreatedBy
 * @property GlobalportalmstTbl $cymGlobalportalmstFk
 * @property UsermstTbl $cyMUpdatedBy
 * @property MembercompanymstTbl[] $membercompanymstTbls
 * @property MembercompanymstTbl[] $membercompanymstTbls0
 * @property MemcompmplocationdtlsTbl[] $memcompmplocationdtlsTbls
 * @property StatemstTbl[] $statemstTbls
 */
class CountryMaster extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countrymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cym_globalportalmst_fk', 'CyM_CountryName_en', 'CyM_CountryCode_en', 'cym_twodigitcountrycode', 'CyM_CountryDialCode', 'CyM_Status', 'CyM_CreatedBy'], 'required'],
            [['cym_globalportalmst_fk', 'CyM_CreatedBy', 'CyM_UpdatedBy'], 'integer'],
            [['cym_cntrylongname', 'CyM_Status'], 'string'],
            [['CyM_CreatedOn', 'CyM_UpdatedOn'], 'safe'],
            [['CyM_CountryName_en'], 'string', 'max' => 150],
            [['CyM_CountryCode_en'], 'string', 'max' => 45],
            [['cym_twodigitcountrycode'], 'string', 'max' => 2],
            [['CyM_CountryDialCode'], 'string', 'max' => 5],
            [['CyM_CreatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['CyM_CreatedBy' => 'UserMst_Pk']],
            [['cym_globalportalmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GlobalportalmstTbl::className(), 'targetAttribute' => ['cym_globalportalmst_fk' => 'globalportalmst_pk']],
            [['CyM_UpdatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['CyM_UpdatedBy' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CountryMst_Pk' => 'Country Mst  Pk',
            'cym_globalportalmst_fk' => 'Cym Globalportalmst Fk',
            'CyM_CountryName_en' => 'Cy M  Country Name',
            'cym_cntrylongname' => 'Cym Cntrylongname',
            'CyM_CountryCode_en' => 'Cy M  Country Code',
            'cym_twodigitcountrycode' => 'Cym Twodigitcountrycode',
            'CyM_CountryDialCode' => 'Cy M  Country Dial Code',
            'CyM_Status' => 'Cy M  Status',
            'CyM_CreatedOn' => 'Cy M  Created On',
            'CyM_CreatedBy' => 'Cy M  Created By',
            'CyM_UpdatedOn' => 'Cy M  Updated On',
            'CyM_UpdatedBy' => 'Cy M  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitymstTbls()
    {
        return $this->hasMany(CitymstTbl::className(), ['CM_CountryMst_Fk' => 'CountryMst_Pk']);
    }
     /** @inheritdoc */
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
                [
                     'class' => TimeBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['CyM_CreatedOn'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                     ],
                 ],
                [
                     'class' => UserBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['CyM_CreatedBy'],
//                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                     ],
                 ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompmarketpresencedtlsTbls()
    {
        return $this->hasMany(MemcompmarketpresencedtlsTbl::className(), ['MCMP_CountryMst_Fk' => 'CountryMst_Pk']);
    }
    /**
     * {@inheritdoc}
     * @return CountryMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountryMasterQuery(get_called_class());
    }
//  public function afterSave($insertUpdateFlag){
////       $data = CountryMaster::fetchCountryData();
////       
////        $cache = \common\components\BGIMemcache::getMemcacheInstance();
////        if(!empty($cache)){
////            $cache->deleteKeyInCache('BGI_COUNTRY_VALUES');
////            $cache->storeValueInCache('BGI_COUNTRY_VALUES',json_encode($data));
////        }
//              $cache = \common\components\BGIMemcache::getMemcacheInstance();
//        if(!empty($cache)){
//            $cache->deleteKeyInCache('BGI_COUNTRY_VALUES');
//        }
//    }
    public function afterDelete(){
       $data = CountryMaster::fetchCountryData();
       if(!empty($data)){
           $cache = \common\components\BGIMemcache::getMemcacheInstance();
           if(!empty($cache)){
            $cache->storeValueInCache('BGI_COUNTRY_VALUES', $data,true);
           }
       }
    }
    public function fetchCountryData(){
        $updatedData = CountryMaster::find()->select(['CountryMst_Pk', 'CyM_CountryName_en', 'CyM_CountryCode_en', 'CyM_CountryDialCode', 'concat("+",trim(leading "00" from CyM_CountryDialCode)) as dialcode'])
                ->where(['=', 'CyM_Status', 'A'])
                ->asArray();
         $provider = new \yii\data\ActiveDataProvider([
            'query' => $updatedData,
            'sort'=> ['defaultOrder' => ['CyM_CountryName_en'=>SORT_ASC]],
            'pagination' => false
        ]);
        $data = $provider->getModels();
        foreach($data as $key => $val){
            $data[$key]['CountryMst_Pk'] = (int) $val['CountryMst_Pk'];
        }
        return $data;
    }
}
