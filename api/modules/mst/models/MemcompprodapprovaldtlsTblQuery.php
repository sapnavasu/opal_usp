<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompprodapprovaldtlsTbl]].
 *
 * @see MemcompprodapprovaldtlsTbl
 */
class MemcompprodapprovaldtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodapprovaldtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodapprovaldtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
