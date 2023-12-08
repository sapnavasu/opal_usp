<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VehicleinspandapprovalhstyTbl]].
 *
 * @see VehicleinspandapprovalhstyTbl
 */
class VehicleinspandapprovalhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VehicleinspandapprovalhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VehicleinspandapprovalhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
