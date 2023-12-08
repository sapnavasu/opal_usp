<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VehicleinspandapprovalTbl]].
 *
 * @see VehicleinspandapprovalTbl
 */
class VehicleinspandapprovalTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VehicleinspandapprovalTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VehicleinspandapprovalTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
