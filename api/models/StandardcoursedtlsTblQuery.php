<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StandardcoursedtlsTbl]].
 *
 * @see StandardcoursedtlsTbl
 */
class StandardcoursedtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StandardcoursedtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursedtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
