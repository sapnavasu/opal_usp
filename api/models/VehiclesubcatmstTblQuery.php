<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VehiclesubcatmstTbl]].
 *
 * @see VehiclesubcatmstTbl
 */
class VehiclesubcatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VehiclesubcatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VehiclesubcatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
