<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[CitymstTbl]].
 *
 * @see CitymstTbl
 */
class CitymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CitymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CitymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	 public function active($db = null)
    {
        return $this->andWhere(['CM_Status' => 'A']);
    }
    public function chkCity($cityName,$statePk,$countryPk, $userPk = '')
    {
        if(!empty($cityName)){
            $company_pk = ($userPk) ? $userPk : \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            $cityTblFind= CitymstTbl::find()->select(['CityMst_Pk'])->where("CM_CityName_en ='$cityName' and CM_StateMst_Fk=$statePk and CM_CountryMst_Fk =$countryPk")->asArray()->one();
            if(empty($cityTblFind)){
                $city = new CitymstTbl();
                $city->CM_CityName_en = \common\components\Security::sanitizeInput($cityName, "string");
                $city->CM_CountryMst_Fk = $countryPk;
                $city->CM_Status = 'I';
                $city->CM_StateMst_Fk = $statePk;
                $city->CM_CreatedOn = date('Y-m-d H:i:s');
                $city->CM_CreatedBy = $company_pk;
                $city->save(false);
                $cityPk= \Yii::$app->db->getLastInsertID(); 
            }  else {
                $cityPk = $cityTblFind['CityMst_Pk']; 
            }
            return $cityPk;
        }else{
            return '';
        }
    }
    
    public function checkCityExist($cityName,$statePk,$countryPk)
    {
        $cityTblFind= CitymstTbl::find()->select(['CityMst_Pk'])->where("CM_CityName_en ='$cityName' and CM_StateMst_Fk=$statePk and CM_CountryMst_Fk =$countryPk")->asArray()->one();
        $cityPk = $cityTblFind['CityMst_Pk']; 
        return $cityPk ? $cityPk : "0";
    }
    public function getcity($pk){
        $model = CitymstTbl::find()
                        ->select(['CM_CityName_en'])
                        ->where(['CityMst_Pk' => $pk])
                        ->one();
        return $model->CM_CityName_en;
    }
    
    public function getCityAutoCompleteListForInternationCountries($cityName, $countryPk) {
        return CitymstTbl::find()
                ->select(['CityMst_Pk as id','CM_CityName_en as label','CM_CityName_en as value'])
                ->where(['LIKE','CM_CityName_en',$cityName])
                ->andWhere(['CM_Status' => 'A'])
                ->andWhere("CM_CountryMst_Fk=:country",[":country"=>$countryPk])
                ->asArray()->all();
    }
    public function getCityByCountryPkStatePk($countryPk,$statePk) {
        return CitymstTbl::find()
                ->select(['CityMst_Pk as id','CM_CityName_en as label','CM_CityName_en as value'])
                ->where("CM_CountryMst_Fk=:country",[":country"=>$countryPk])
                ->andWhere(['CM_Status' => 'A'])
                ->andWhere("CM_StateMst_Fk=:state",[":state"=>$statePk])
                ->asArray()->all();
    }
    public function getcitydetails(){
        $citylist = [];
        $model = CitymstTbl::find()
                        ->select(['CityMst_Pk', 'CM_CityName_en'])
                        ->where(['CM_Status' => 'A'])
                        ->orderBy(['CityMst_Pk'=>SORT_ASC])
                        ->asArray()->all();
        if(!empty($model)){
            foreach ($model as $value) {
                $citylist[$value['CityMst_Pk']] = $value['CM_CityName_en'];
            }
        }
        return $citylist;
    }
}
