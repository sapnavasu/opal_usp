<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnerreghrddtlshstyTbl]].
 *
 * @see LearnerreghrddtlshstyTbl
 */
class LearnerreghrddtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnerreghrddtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnerreghrddtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
