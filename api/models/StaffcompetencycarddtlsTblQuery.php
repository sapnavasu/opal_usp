<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffcompetencycarddtlsTbl]].
 *
 * @see StaffcompetencycarddtlsTbl
 */
class StaffcompetencycarddtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffcompetencycarddtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffcompetencycarddtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
