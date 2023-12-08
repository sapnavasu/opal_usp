<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FdbkquestmstTbl]].
 *
 * @see FdbkquestmstTbl
 */
class FdbkquestmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FdbkquestmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FdbkquestmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
