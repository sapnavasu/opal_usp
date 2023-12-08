<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnerasmthdrhstyTbl]].
 *
 * @see LearnerasmthdrhstyTbl
 */
class LearnerasmthdrhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnerasmthdrhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnerasmthdrhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
