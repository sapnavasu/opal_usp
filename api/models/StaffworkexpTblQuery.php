<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffworkexpTbl]].
 *
 * @see StaffworkexpTbl
 */
class StaffworkexpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffworkexpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffworkexpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
