<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalmoherigrademsthstyTbl]].
 *
 * @see OpalmoherigrademsthstyTbl
 */
class OpalmoherigrademsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalmoherigrademsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalmoherigrademsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
