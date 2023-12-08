<?php

namespace api\modules\mst\models;

use app\commonfunction\Security;
use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "currencymst_tbl".
 *
 * @property int $CurrencyMst_Pk
 * @property string $CurM_CurrSymbol
 * @property string $CurM_CurrencyName_en
 * @property string $CurM_Status
 * @property string $CurM_CreatedOn
 * @property int $CurM_CreatedBy
 * @property string $CurM_UpdatedOn
 * @property int $CurM_UpdatedBy
 *
 * @property MemcompgendtlsTbl[] $memcompgendtlsTbls
 */
class CurrencymstTbl extends \yii\db\ActiveRecord
{
    static $table_prefix = 'CurM_';
    static $table_name   = 'currencymst_tbl';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CurM_CurrencyName_en', 'CurM_Status', 'CurM_CreatedOn', 'CurM_CreatedBy'], 'required'],
            [['CurM_Status'], 'string'],
            [['CurM_CreatedOn', 'CurM_UpdatedOn'], 'safe'],
            [['CurM_CreatedBy', 'CurM_UpdatedBy'], 'integer'],
            [['CurM_CurrSymbol'], 'string', 'max' => 45],
            [['CurM_CurrencyName_en'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CurrencyMst_Pk' => 'Currency Mst  Pk',
            'CurM_CurrSymbol' => 'Cur M  Curr Symbol',
            'CurM_CurrencyName_en' => 'Cur M  Currency Name',
            'CurM_Status' => 'Cur M  Status',
            'CurM_CreatedOn' => 'Cur M  Created On',
            'CurM_CreatedBy' => 'Cur M  Created By',
            'CurM_UpdatedOn' => 'Cur M  Updated On',
            'CurM_UpdatedBy' => 'Cur M  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompgendtlsTbls()
    {
        return $this->hasMany(MemcompgendtlsTbl::className(), ['MCGD_PaidUpCapitalCurr_Fk' => 'CurrencyMst_Pk']);
    }

    /**
     * {@inheritdoc}
     * @return CurrencymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencymstTblQuery(get_called_class());
    }
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
                [
                     'class' => TimeBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['CurM_CreatedOn'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CurM_UpdatedOn'],
                     ],
                 ],
                [
                     'class' => UserBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['CurM_CreatedBy'],
//                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                     ],
                 ],
        ];
    }
    
    public function activecurrency(){
        return new ActiveDataProvider([
            'query' => CurrencymstTbl::find()
                ->select(['CurrencyMst_Pk','CurM_CurrSymbol','CurM_CurrencyName_en'])
                ->where('CurM_Status = :CurM_Status',[':CurM_Status' => 'A'])
                ->orderBy('CurM_CurrSymbol ASC')
                ->asArray()
                ->active(),
             'pagination' => false   
        ]);
    }
    
    public function getCurrencyName($pk){
        $model = self::findOne($pk);
        return $model['CurM_CurrencyName_en'];
    }
    
    public function getCurrencylist() {
        $path = './../backend/json/Currency.json';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }

        $cache = new \api\common\services\CacheBGI();

        try{
            $filecachekey = 'currencyfile';
            if(empty($cache->retreive($filecachekey))){
                $fp = fopen($path, 'r');
                $arr = fread($fp, filesize($path));
                $jsondecode = json_decode($arr, true);
                $cache->store($filecachekey, $jsondecode, $duration = 0 , $cacheQuery='',$path);
            } else {
                $jsondecode = $cache->retreive($filecachekey);
            }

        } catch(\Exception $e){
            $fp = fopen($path, 'r');
            $arr = fread($fp, filesize($path));
            $jsondecode = json_decode($arr, true);
        }
      
        try{
            $cacheKey= 'currencylist';
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = CurrencymstTblQuery::getCurrencyCacheQuery();
                $currencylist = CurrencymstTbl::find()
                ->select(['CurrencyMst_Pk as cvalue','CurM_CurrSymbol as clabel','CurM_CurrencyName_en','CurM_CurrSymbol','CurrencyMst_Pk'])
                ->where('CurM_Status = :CurM_Status',[':CurM_Status' => 'A'])
                ->orderBy(new \yii\db\Expression("CurrencyMst_Pk = {$jsondecode['currencyName']} desc,CurM_CurrencyName_en ASC"))
                ->asArray()
                ->all();
                $cache->store($cacheKey, $currencylist, $duration = 0 , $cacheQuery);
            } else {
                $currencylist = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $currencylist = CurrencymstTbl::find()
            ->select(['CurrencyMst_Pk as cvalue','CurM_CurrSymbol as clabel','CurM_CurrencyName_en','CurM_CurrSymbol','CurrencyMst_Pk'])
            ->where('CurM_Status = :CurM_Status',[':CurM_Status' => 'A'])
            ->orderBy(new \yii\db\Expression("CurrencyMst_Pk = {$jsondecode['currencyName']} desc,CurM_CurrencyName_en ASC"))
            ->asArray()
            ->all();
        }
      
        return $currencylist;
    }
    
    public function getUnitlist() {
        $unitlist = UnitmstTbl::find()
                ->select(['unitmst_pk as mvalue','unm_namesg as mlabel'])
                ->where('unm_status = :unm_status',[':unm_status' => '1'])
                ->orderBy('unm_namesg ASC')
                ->asArray()
                ->all();
        return $unitlist;
    }
}
