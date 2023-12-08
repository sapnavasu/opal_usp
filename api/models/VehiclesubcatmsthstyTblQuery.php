<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VehiclesubcatmsthstyTbl]].
 *
 * @see VehiclesubcatmsthstyTbl
 */
class VehiclesubcatmsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VehiclesubcatmsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VehiclesubcatmsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
