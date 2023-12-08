<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnercertgendtlsTbl]].
 *
 * @see LearnercertgendtlsTbl
 */
class LearnercertgendtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnercertgendtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnercertgendtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
