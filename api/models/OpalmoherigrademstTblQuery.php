<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalmoherigrademstTbl]].
 *
 * @see OpalmoherigrademstTbl
 */
class OpalmoherigrademstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalmoherigrademstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalmoherigrademstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
