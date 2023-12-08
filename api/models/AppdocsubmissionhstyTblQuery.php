<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppdocsubmissionhstyTbl]].
 *
 * @see AppdocsubmissionhstyTbl
 */
class AppdocsubmissionhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppdocsubmissionhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppdocsubmissionhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
