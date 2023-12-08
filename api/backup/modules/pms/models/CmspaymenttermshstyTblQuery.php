<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmspaymenttermshstyTbl]].
 *
 * @see CmspaymenttermshstyTbl
 */
class CmspaymenttermshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmspaymenttermshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmspaymenttermshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
