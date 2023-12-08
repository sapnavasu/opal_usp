<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

/**
 * This is the model class for table "incorpstylemst_tbl".
 *
 * @property int $IncorpStyleMst_Pk Primary key
 * @property int $ISM_CountryMst_Fk Reference to countrymst_tbl
 * @property string $ISM_IncorpStyleEntity_en Incorporation style entity in short form
 * @property string $ISM_IncorpStyleEntity_ar
 * @property string $ISM_IncorpStyleBrief_en Incorporation style entity in brief
 * @property string $ISM_IncorpStyleBrief_ar
 * @property string $ISM_Status Incorporation style statue. A - Active, I - Inactive
 * @property int $ism_ismandatory Does this incorpstyle is mandatory in SCF (Shareholder Information) 1 - Yes, 2 - No
 */
class Incorpstylemaster extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incorpstylemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ISM_CountryMst_Fk', 'ISM_IncorpStyleEntity_en'], 'required'],
            [['ISM_CountryMst_Fk', 'ism_ismandatory'], 'integer'],
            [['ISM_IncorpStyleBrief_en', 'ISM_IncorpStyleBrief_ar', 'ISM_Status'], 'string'],
            [['ISM_IncorpStyleEntity_en', 'ISM_IncorpStyleEntity_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IncorpStyleMst_Pk' => 'Incorp Style Mst  Pk',
            'ISM_CountryMst_Fk' => 'Ism  Country Mst  Fk',
            'ISM_IncorpStyleEntity_en' => 'Ism  Incorp Style Entity En',
            'ISM_IncorpStyleEntity_ar' => 'Ism  Incorp Style Entity Ar',
            'ISM_IncorpStyleBrief_en' => 'Ism  Incorp Style Brief En',
            'ISM_IncorpStyleBrief_ar' => 'Ism  Incorp Style Brief Ar',
            'ISM_Status' => 'Ism  Status',
            'ism_ismandatory' => 'Ism Ismandatory',
        ];
    }

        /**
     * {@inheritdoc}
     * @return IncorpstylemasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IncorpstylemasterQuery(get_called_class());
    }
    
    public function getIncorpstyle($country_pk, $stktype = ''){
        $query = self::find();
        if ($_REQUEST['type'] == 'filter') {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach (array_filter($_REQUEST) as $key => $val) {
                if (!is_null($val)) {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        
        // $cache = new \api\common\services\CacheBGI(); 
        // try{
        //     $cacheKey = 'incorpstyle'.$country_pk;
        //     if(empty($cache->retreive($cacheKey))){
        //         $cacheQuery = \api\modules\mst\models\IncorpstyleMasterQuery::incorpstyleCacheQuery();
        //         $provider = self::incorpstyleQuery($query, $country_pk, $stktype);
        //         $cache->store($cacheKey, $provider, $duration = 0 , $cacheQuery);
        //     } else {
        //         $provider = $cache->retreive($cacheKey);
        //     }

        // } 
        // catch(\Exception $e){
            $provider = self::incorpstyleQuery($query, $country_pk, $stktype);
        // }
        return $provider;
    }

    public static function incorpstyleQuery($query, $country_pk, $stktype){
        
        $query->select(['IncorpStyleMst_Pk','ISM_IncorpStyleEntity_en','ISM_IncorpStyleEntity_ar'])
        ->where('ISM_CountryMst_Fk = :ISM_CountryMst_Fk and ISM_Status =:stsISM',[':ISM_CountryMst_Fk'=> $country_pk, 'stsISM'=>'A'])
        ->orderBy(['ISM_IncorpStyleEntity_en' => SORT_ASC])
        ->asArray();

        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
             'pagination' => ['pageSize' => false]
        ]);

        return $provider;
    }
}