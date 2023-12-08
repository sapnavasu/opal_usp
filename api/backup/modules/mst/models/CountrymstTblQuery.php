<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[CountrymstTbl]].
 *
 * @see CountrymstTbl
 */
class CountrymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CountrymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CountrymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function countrylist(){
        return CountrymstTbl::find()
                        ->select(['CountryMst_Pk', 'CyM_CountryName_en'])
                        ->where(['CyM_Status' => 'A'])
                        ->orderBy(['CyM_CountryName_en'=>SORT_ASC])
                        ->asArray()->all();
    }

    public function getcountry($pk){
        $model = CountrymstTbl::find()
                        ->select(['CyM_CountryName_en'])
                        ->where(['CountryMst_Pk' => $pk])
                        ->one();
        return $model->CyM_CountryName_en;
    }
    public function getCountryArrayData($data){
        $model = CountrymstTbl::find()
            ->select(['CyM_CountryName_en'])
            ->where("CountryMst_Pk IN ($data)")
            ->asArray()->all();
        return $model;
    }
    public function countrydetails(){
        $countrylist = [];
        $countrydialcode = [];
        $model = CountrymstTbl::find()
                        ->select(['CountryMst_Pk', 'CyM_CountryName_en','CyM_CountryDialCode'])
                        ->where(['CyM_Status' => 'A'])
                        ->orderBy(['CountryMst_Pk'=>SORT_ASC])
                        ->asArray()->all();
        if(!empty($model)){
            foreach ($model as $value) {
                $countrylist[$value['CountryMst_Pk']] = $value['CyM_CountryName_en'];
            }
            foreach ($model as $value) {
                $countrydialcode[$value['CountryMst_Pk']] = $value['CyM_CountryDialCode'];
            }
        }
        return ['countrylist'=>$countrylist,'countrydialcode'=>$countrydialcode];
//        echo '<pre>';
//        print_r($countrylist[31]);
//        echo '<pre>';
//        print_r($countrydialcode[104]);
//        exit;
    }
}
