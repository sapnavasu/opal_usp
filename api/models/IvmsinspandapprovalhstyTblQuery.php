<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsinspandapprovalhstyTbl]].
 *
 * @see IvmsinspandapprovalhstyTbl
 */
class IvmsinspandapprovalhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsinspandapprovalhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspandapprovalhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
