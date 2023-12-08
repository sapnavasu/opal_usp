<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffacademicsTbl]].
 *
 * @see StaffacademicsTbl
 */
class StaffacademicsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffacademicsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffacademicsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
