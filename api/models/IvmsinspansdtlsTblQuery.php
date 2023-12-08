<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsinspansdtlsTbl]].
 *
 * @see IvmsinspansdtlsTbl
 */
class IvmsinspansdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsinspansdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspansdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
