<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SubscriptionmstTbl]].
 *
 * @see SubscriptionmstTbl
 */
class SubscriptionmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SubscriptionmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SubscriptionmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
