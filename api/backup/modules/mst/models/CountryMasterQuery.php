<?php

namespace api\modules\mst\models;

use yii\data\ActiveDataProvider;
use api\modules\mst\models\CountryMaster;
use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[CountryMaster]].
 *
 * @see CountryMaster
 */
class CountryMasterQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CountryMaster[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CountryMaster|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return CountryMaster|array|null
     */
    public function active($db = null) {
        return $this->andWhere(['CyM_Status' => 'A']);
    }

    public function getDialCodeByCountry($pk) {
//        return new ActiveDataProvider([
        $query = CountryMaster::find()
                ->select(['CountryMst_Pk', 'concat("+",trim(leading "00" from CyM_CountryDialCode)) as dialcode'])
                ->where(['=', 'CountryMst_Pk', $pk])
                ->asArray();
//            'pagination' =>false
//        ]);
        $provider = new ActiveDataprovider([
            'query' => $query,
            'pagination' => false
        ]);

        return [
            "msg" => "success",
            "status" => 1,
            "dialcode" => $provider->getModels()[0]['dialcode']
        ];
    }

    public function chkCountry($countryName) {
        $countryTblFind = CountryMaster::find()->select(['CountryMst_Pk'])->where("CyM_CountryName_en ='$countryName'")->asArray()->one();
        $countryPk = $countryTblFind['CountryMst_Pk'];
        return $countryPk;
    }

    public function getCountryListwithDialCode($deployCountry = null, $type = null) {
        $countryCacheValues = '';
//        $memcacheObj        =   \common\components\BGIMemcache::getMemcacheInstance();
//        if(!empty($memcacheObj)){
//            $countryCacheValues =   $memcacheObj->fetchValueFromCache('BGI_COUNTRY_VALUES');
//            
//        }
        if ($countryCacheValues == '') {
            $query = CountryMaster::find()
                    ->select(['CountryMst_Pk', 'CyM_CountryName_en', 'CyM_CountryCode_en', 'CyM_CountryName_ar', 'CyM_CountryCode_ar', 'CyM_CountryDialCode', 'CyM_CountryDialCode as dialcode'])
                    ->where(['=', 'CyM_Status', 'A']);
            if ($type == 'ex-oman') {
                $query->where(['<>', 'CountryMst_Pk', 31]);
            }
            if ($type == 'oman-only') {
                $query->where(['=', 'CountryMst_Pk', 31]);
            }
            $query->orderBy(new \yii\db\Expression("CountryMst_Pk = $deployCountry desc"))
                    ->asArray();
            if (\Yii::$app->params['setglobalforall']) {
                $query = CountryMaster::find()
                        ->select(['CountryMst_Pk', 'CyM_CountryName_en', 'CyM_CountryCode_en', 'CyM_CountryName_ar', 'CyM_CountryCode_ar', 'CyM_CountryDialCode', 'CyM_CountryDialCode as dialcode'])
                        ->where(['=', 'CyM_Status', 'A']);
                if ($type == 'ex-oman') {
                    $query->where(['<>', 'CountryMst_Pk', 31]);
                }
                if ($type == 'oman-only') {
                $query->where(['=', 'CountryMst_Pk', 31]);
              }
                $query->andWhere(['=', 'cym_globalportalmst_fk', \Yii::$app->params['globalportalmst_pk']])
                        ->orderBy(new \yii\db\Expression("CountryMst_Pk = $deployCountry desc"))
                        ->asArray();
            }

            $provider = new ActiveDataprovider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['CyM_CountryName_en' => SORT_ASC]],
                'pagination' => false
            ]);
            $data = $provider->getModels();
            foreach ($data as $key => $val) {
                $data[$key]['CountryMst_Pk'] = (int) $val['CountryMst_Pk'];
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
//        return $data;
    }

    public function getCountryPkByDialCode($dialcode) {
        return CountryMaster::find()
                        ->select(['CountryMst_Pk'])
                        ->where('CyM_CountryDialCode = :dialcode', [':dialcode' => $dialcode])
                        ->asArray()->one();
    }

    public function getCountryWithoutLibya() {
        $model = CountryMaster::find()
                        ->select(['CountryMst_Pk as value', 'CyM_CountryName_en as display', "IF(CyM_CountryName_en = 1, 'false', 'false') AS isSelected"])
                        ->where(['=', 'CyM_Status', 'A'])
                        ->andWhere(['!=', 'CountryMst_Pk', 245])
                        ->orderBy(['CyM_CountryName_en' => SORT_ASC])
                        ->asArray()->All();
        return $model;
    }

    public function getActiveCountry() {
        $model = CountryMaster::find()
                        ->select(['CountryMst_Pk as value', 'CyM_CountryName_en as display'])
                        ->where(['=', 'CyM_Status', 'A'])
                        ->orderBy(new \yii\db\Expression('CountryMst_Pk=31 desc,CyM_CountryName_en asc'))
                        ->asArray()->All();
        return $model;
    }

    public function getregCountrymst() {
        $model = CountryMaster::find()
                        ->where(['=', 'CyM_Status', 'A'])
                        ->andWhere(['!=', 'CountryMst_Pk', 31])
                        ->orderBy(['CyM_CountryName_en' => SORT_ASC])
                        ->asArray()->All();
        return $model;
    }

    public static function getCountryDtlByPk($countryPk) {
        return CountryMaster::findOne($countryPk);
    }

    public static function getCountryByCountryCode($countryCode) {
        $Country = (empty($countryCode) || $countryCode == '-') ? 'OM' : $countryCode;
        if (!empty($Country)) {
            return CountryMaster::find()->where("CyM_CountryCode_en=:CyM_CountryCode_en", [":CyM_CountryCode_en" => $Country])->one();
        } else {
            return CountryMaster::find("CyM_CountryCode_en=:CyM_CountryCode_en", [":CyM_CountryCode_en" => 'OM'])->one();
        }
    }

    public function getCountryDialCodeByPk($countrypk) {
        return CountryMaster::find()
                        ->select(['CyM_CountryDialCode'])
                        ->where('CountryMst_Pk = :countrypk', [':countrypk' => $countrypk])
                        ->asArray()->one();
    }

    public function getActiveCountryCache() {
        return CountryMaster::find()
                        ->select(['max(CyM_UpdatedOn), count(*)'])
                        ->createCommand()
                        ->getRawSql();
    }

    public function getCountryListwithDialCodeCache() {
        return CountryMaster::find()
                        ->select(['max(CyM_UpdatedOn), count(*)'])
                        ->where('CountryMst_Pk <> 31')
                        ->createCommand()
                        ->getRawSql();
    }

}
