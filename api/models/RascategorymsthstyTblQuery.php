<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RascategorymsthstyTbl]].
 *
 * @see RascategorymsthstyTbl
 */
class RascategorymsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RascategorymsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RascategorymsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
