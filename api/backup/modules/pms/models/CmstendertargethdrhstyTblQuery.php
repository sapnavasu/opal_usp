<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmstendertargethdrhstyTbl]].
 *
 * @see CmstendertargethdrhstyTbl
 */
class CmstendertargethdrhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstendertargethdrhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstendertargethdrhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
