<?php

namespace api\modules\mst\models;
use yii\data\ActiveDataProvider;
use api\modules\mst\models\IncorpMaster;

/**
 * This is the ActiveQuery class for [[SocialmediaMaster]].
 *
 * @see SocialmediaMaster
 */
class IncorpMasterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IncorpMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IncorpMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * {@inheritdoc}
     * @return IncorpMaster|array|null
     */
   
    
	
    public function chkIncorp($incorpEntity) {
        $incorpTblFind = IncorpMaster::find()->select(['MemCompInCorpStyleMst_Pk'])->where("MCISM_IncorpStyleEntity ='$incorpEntity'")->asArray()->one();
        $incorpPk = $incorpTblFind['MemCompInCorpStyleMst_Pk'];
        return $incorpPk;
    }

}
