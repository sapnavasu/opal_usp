<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsinspquesdtlshstyTbl]].
 *
 * @see IvmsinspquesdtlshstyTbl
 */
class IvmsinspquesdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsinspquesdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspquesdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
