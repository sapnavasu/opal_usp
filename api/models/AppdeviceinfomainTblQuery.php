<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppdeviceinfomainTbl]].
 *
 * @see AppdeviceinfomainTbl
 */
class AppdeviceinfomainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppdeviceinfomainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppdeviceinfomainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
