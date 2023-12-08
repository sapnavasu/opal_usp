<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalsitecategoryTbl]].
 *
 * @see OpalsitecategoryTbl
 */
class OpalsitecategoryTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalsitecategoryTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalsitecategoryTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
