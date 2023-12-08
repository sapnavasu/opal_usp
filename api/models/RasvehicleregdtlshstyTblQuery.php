<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RasvehicleregdtlshstyTbl]].
 *
 * @see RasvehicleregdtlshstyTbl
 */
class RasvehicleregdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RasvehicleregdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RasvehicleregdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
