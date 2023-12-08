<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnercarddtlshstyTbl]].
 *
 * @see LearnercarddtlshstyTbl
 */
class LearnercarddtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnercarddtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnercarddtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
