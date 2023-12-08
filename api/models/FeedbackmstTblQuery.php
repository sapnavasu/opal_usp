<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeedbackmstTbl]].
 *
 * @see FeedbackmstTbl
 */
class FeedbackmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FeedbackmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FeedbackmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
