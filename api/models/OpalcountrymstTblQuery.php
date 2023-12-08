<?php

namespace app\models;
use yii\data\ActiveDataProvider;
/**
 * This is the ActiveQuery class for [[OpalcountrymstTbl]].
 *
 * @see OpalcountrymstTbl
 */
class OpalcountrymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalcountrymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalcountrymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getCountryListwithDialCode($deployCountry = null) {
         
        $countryCacheValues = '';
        if ($countryCacheValues == '') {
            $query = OpalcountrymstTbl::find()
                    ->select(['opalcountrymst_pk', 'ocym_countryname_en', 'ocym_countrycode_en', 'ocym_countryname_ar', 'ocym_countrycode_ar', 'ocym_countrydialcode', 'ocym_countrydialcode as dialcode'])
                    ->where(['=', 'ocym_status', 'A']);
            $query->orderBy(new \yii\db\Expression("opalcountrymst_pk = $deployCountry desc"))
                    ->asArray();
            $provider = new ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['ocym_countryname_en' => SORT_ASC]],
                'pagination' => false
            ]);
           
            
            $data = $provider->getModels();
            
            
            foreach ($data as $key => $val) {
                $data[$key]['opalcountrymst_pk'] = (int) $val['opalcountrymst_pk'];
            }
            if (!empty($memcacheObj)) {
                $countryCacheValues = $memcacheObj->storeValueInCache('BGI_COUNTRY_VALUES', json_encode($data));
                return $countryCacheValues;
            } else {
                return $data;
            }
             
        } else {
            return $countryCacheValues;
        }
    }
    public function getCountryListwithDialCodeCache() {
        return OpalcountrymstTbl::find()
                        ->select(['max(ocym_updatedon), count(*)'])
                        ->where('opalcountrymst_pk <> 31')
                        ->createCommand()
                        ->getRawSql();
    }
    
    public static function getCountryByCountryCode($countryCode) {
        $Country = (empty($countryCode) || $countryCode == '-') ? 'OM' : $countryCode;
        if (!empty($Country)) {
            return OpalcountrymstTbl::find()->where("ocym_countrycode_en=:ocym_countrycode_en", [":ocym_countrycode_en" => $Country])->one();
        } else {
            return OpalcountrymstTbl::find("CyM_CountryCode_en=:CyM_CountryCode_en", [":CyM_CountryCode_en" => 'OM'])->one();
        }
    }
    
     public function getCountryDialCodeByPk($countrypk) {
        return OpalcountrymstTbl::find()
                        ->select(['ocym_countrydialcode'])
                        ->where('opalcountrymst_pk = :countrypk', [':countrypk' => $countrypk])
                        ->asArray()->one();
    }
}
