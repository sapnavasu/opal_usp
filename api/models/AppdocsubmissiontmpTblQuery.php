<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppdocsubmissiontmpTbl]].
 *
 * @see AppdocsubmissiontmpTbl
 */
class AppdocsubmissiontmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppdocsubmissiontmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppdocsubmissiontmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
