<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsinspansdtlshstyTbl]].
 *
 * @see IvmsinspansdtlshstyTbl
 */
class IvmsinspansdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsinspansdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspansdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
