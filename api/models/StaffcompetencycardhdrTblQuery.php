<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffcompetencycardhdrTbl]].
 *
 * @see StaffcompetencycardhdrTbl
 */
class StaffcompetencycardhdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffcompetencycardhdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffcompetencycardhdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
