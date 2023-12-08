<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsvehicleregdtlshstyTbl]].
 *
 * @see IvmsvehicleregdtlshstyTbl
 */
class IvmsvehicleregdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsvehicleregdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsvehicleregdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
