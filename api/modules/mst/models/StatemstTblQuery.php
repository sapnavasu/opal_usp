<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[StatemstTbl]].
 *
 * @see StatemstTbl
 */
class StatemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CountryMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CountryMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * {@inheritdoc}
     * @return CountryMaster|array|null
     */
    public function active($db = null)
    {
        return $this->andWhere(['SM_Status' => 'A']);
    }
    public function chkState($stateName,$countryPk, $userPk = '')
    {
        if(empty($stateName)){
            $statTblFind= StatemstTbl::find()->select(['StateMst_Pk'])->where("SM_StateName_en =:state and SM_CountryMst_Fk=:country",array(":state"=>$stateName,":country"=>$countryPk))->asArray()->one();
            if(empty($statTblFind)){
                $state = new StatemstTbl();
                $state->SM_StateName_en = \common\components\Security::sanitizeInput($stateName, "string");
                $state->SM_Status = 'I';
                $state->SM_CountryMst_Fk = $countryPk;
                $state->SM_CreatedOn = date('Y-m-d H:i:s');
                $state->SM_CreatedBy = $userPk ?? 1;
                $state->save(false);
                $statPk= \Yii::$app->db->getLastInsertID();
            }  else {
                $statPk = $statTblFind['StateMst_Pk'];
            }
            return $statPk;
        }else{
            return '';
        }
    }
    
    public function checkStateExist($stateName,$countryPk)
    {
        $statTblFind= StatemstTbl::find()->select(['StateMst_Pk'])->where("SM_StateName_en =:state and SM_CountryMst_Fk=:country",array(":state"=>$stateName,":country"=>$countryPk))->asArray()->one();
        $statPk = $statTblFind['StateMst_Pk'];
        return $statPk ? $statPk : "0";
    }
    //for libia states onlyy
    public function statelist(){
        return StatemstTbl::find()
                        ->select(['StateMst_Pk', 'SM_StateName_en'])
                        ->where(['SM_Status' => 'A','SM_CountryMst_Fk' => 245])
                        ->orderBy(['SM_StateName_en'=>SORT_ASC])
                        ->asArray()->all();
    }
    public function getStateByCountryPk($countryPk){
        return StatemstTbl::find()
                        ->select(['StateMst_Pk', 'SM_StateName_en'])
                        ->where(['SM_Status' => 'A','SM_CountryMst_Fk' => $countryPk])
                        ->orderBy(['SM_StateName_en'=>SORT_ASC])
                        ->asArray()->all();
    }
    public function statelistbycntry(){
        return StatemstTbl::find()
                        ->select(['StateMst_Pk', 'SM_StateName_en'])
                        ->where(['SM_Status' => 'A','SM_CountryMst_Fk' => $_GET['stateid']])
                        ->orderBy(['SM_StateName_en'=>SORT_ASC])
                        ->asArray()->all();
    }
    public function getstate($pk){
        $model = StatemstTbl::find()
                        ->select(['SM_StateName_en'])
                        ->where(['StateMst_Pk' => $pk])
                        ->one();
        return $model->SM_StateName_en;
    }
    
    public function getStateAutoCompleteListForInternationCountries($stateName, $countryPk) {
        return StatemstTbl::find()
                ->select(['StateMst_Pk as id','SM_StateName_en as label','SM_StateName_en as value'])
                ->where(['LIKE','SM_StateName_en',$stateName])
                ->andWhere("SM_CountryMst_Fk=:country",[":country"=>$countryPk])
                ->asArray()->all();
    }
    public function getstatesdetails(){
        $statelist = [];
        $model = StatemstTbl::find()
                        ->select(['StateMst_Pk', 'SM_StateName_en'])
                        ->where(['SM_Status' => 'A'])
                        ->orderBy(['StateMst_Pk'=>SORT_ASC])
                        ->asArray()->all();
        if(!empty($model)){
            foreach ($model as $value) {
                $statelist[$value['StateMst_Pk']] = $value['SM_StateName_en'];
            }
        }
        return $statelist;
    }
}