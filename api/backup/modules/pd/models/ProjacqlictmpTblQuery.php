<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
/**
 * This is the ActiveQuery class for [[ProjacqlictmpTbl]].
 *
 * @see ProjacqlictmpTbl
 */
class ProjacqlictmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjacqlictmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjacqlictmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function addlicense($license,$projectpk){
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        
        foreach ($license as $key => $value) {
            $projaccquiremodels=new ProjacqlictmpTbl;
            $projaccquiremodels->palt_projecttmp_fk=$projectpk;
            $projaccquiremodels->palt_licensinginfo_fk=Security::sanitizeInput($value['licenseid'],'number');
            $projaccquiremodels->palt_order=$key;
            $projaccquiremodels->palt_submittedon=date('Y-m-d H:i:s');
            $projaccquiremodels->palt_submittedby=$userPk;
            $projaccquiremodels->palt_submittedbyipaddr = \common\components\Common::getIpAddress();
            $projaccquiremodels->save();
            
        }
    }
}
