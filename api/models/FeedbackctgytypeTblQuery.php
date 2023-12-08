<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeedbackctgytypeTbl]].
 *
 * @see FeedbackctgytypeTbl
 */
class FeedbackctgytypeTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FeedbackctgytypeTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FeedbackctgytypeTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
