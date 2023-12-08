<?php

namespace api\modules\pd\models;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjaccachievedtlsTbl]].
 *
 * @see ProjaccachievedtlsTbl
 */
class ProjaccachievedtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjaccachievedtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccachievedtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addAccreditation($accredition,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($accredition as $key => $value) {
            $projecacacivemodels=new ProjaccachievedtlsTbl;
            $projecacacivemodels->paad_projectdtls_fk=$projectpk;
            $projecacacivemodels->paad_memcompacomplishdtls_fk=Security::sanitizeInput($value['accplishid'],'number');
            $projecacacivemodels->paad_type=1;
            $projecacacivemodels->paad_index=$key;
            $projecacacivemodels->paad_createdon=date('Y-m-d H:i:s');
            $projecacacivemodels->paad_createdby=$userPk;
            $projecacacivemodels->save();
            
        }
    }
    public function addAchievement($achievement,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($achievement as $key => $value) {
            $projecacacivemodels=new ProjaccachievedtlsTbl;
            $projecacacivemodels->paad_projectdtls_fk=$projectpk;
            $projecacacivemodels->paad_memcompacomplishdtls_fk=Security::sanitizeInput($value['accplishid'],'number');
            $projecacacivemodels->paad_type=2;
            $projecacacivemodels->paad_index=$key;
            $projecacacivemodels->paad_createdon=date('Y-m-d H:i:s');
            $projecacacivemodels->paad_createdby=$userPk;
            $projecacacivemodels->save();
            
        }
    }
}
