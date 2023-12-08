<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsvehicleregdtlsTbl]].
 *
 * @see IvmsvehicleregdtlsTbl
 */
class IvmsvehicleregdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsvehicleregdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsvehicleregdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
