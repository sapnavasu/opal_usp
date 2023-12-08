<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalsitequestionTbl]].
 *
 * @see OpalsitequestionTbl
 */
class OpalsitequestionTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalsitequestionTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalsitequestionTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
