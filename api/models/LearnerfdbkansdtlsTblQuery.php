<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnerfdbkansdtlsTbl]].
 *
 * @see LearnerfdbkansdtlsTbl
 */
class LearnerfdbkansdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnerfdbkansdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnerfdbkansdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
