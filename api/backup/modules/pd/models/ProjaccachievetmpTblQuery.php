<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use \common\models\UsermstTbl;

/**
 * This is the ActiveQuery class for [[ProjaccachievetmpTbl]].
 *
 * @see ProjaccachievetmpTbl
 */
class ProjaccachievetmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjaccachievetmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccachievetmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function addAccreditation($accredition,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($accredition as $key => $value) {
            $projecacacivemodels=new ProjaccachievetmpTbl;
            $projecacacivemodels->paat_projecttmp_fk=$projectpk;
            $projecacacivemodels->paat_memcompacomplishdtls_fk=Security::sanitizeInput($value['accplishid'],'number');
            $projecacacivemodels->paat_type=1;
            $projecacacivemodels->paat_index=$key;
            $projecacacivemodels->paat_submittedon=date('Y-m-d H:i:s');
            $projecacacivemodels->paat_submittedby=$userPk;
            $projecacacivemodels->paat_submittedbyipaddr = \common\components\Common::getIpAddress();
            $projecacacivemodels->save();
            
        }
    }
    public function addAchievement($achievement,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($achievement as $key => $value) {
            $projecacacivemodels=new ProjaccachievetmpTbl;
            $projecacacivemodels->paat_projecttmp_fk=$projectpk;
            $projecacacivemodels->paat_memcompacomplishdtls_fk=Security::sanitizeInput($value['accplishid'],'number');
            $projecacacivemodels->paat_type=2;
            $projecacacivemodels->paat_index=$key;
            $projecacacivemodels->paat_submittedon=date('Y-m-d H:i:s');
            $projecacacivemodels->paat_submittedby=$userPk;
            $projecacacivemodels->paat_submittedbyipaddr = \common\components\Common::getIpAddress();
            $projecacacivemodels->save();
            
        }
    }
    public function addcertificate($certificate,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($certificate as $key => $value) {
            $projcertmodels=new ProjaccachievetmpTbl;
            $projcertmodels->paat_projecttmp_fk=$projectpk;
            $projcertmodels->paat_memcompacomplishdtls_fk=Security::sanitizeInput($value['accplishid'],'number');
            $projcertmodels->paat_type=4;
            $projcertmodels->paat_index=$key;
            $projcertmodels->paat_submittedon=date('Y-m-d H:i:s');
            $projcertmodels->paat_submittedby=$userPk;
            $projcertmodels->paat_submittedbyipaddr = \common\components\Common::getIpAddress();
            $projcertmodels->save();
            
        }
    }
    public function addAward($award,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($award as $key => $value) {
            $projawardmodels=new ProjaccachievetmpTbl;
            $projawardmodels->paat_projecttmp_fk=$projectpk;
            $projawardmodels->paat_memcompacomplishdtls_fk=Security::sanitizeInput($value['accplishid'],'number');
            $projawardmodels->paat_type=3;
            $projawardmodels->paat_index=$key;
            $projawardmodels->paat_submittedon=date('Y-m-d H:i:s');
            $projawardmodels->paat_submittedby=$userPk;
            $projawardmodels->paat_submittedbyipaddr = \common\components\Common::getIpAddress();
            $projawardmodels->save();
            
        }
    }
}
