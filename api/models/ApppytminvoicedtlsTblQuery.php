<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ApppytminvoicedtlsTbl]].
 *
 * @see ApppytminvoicedtlsTbl
 */
class ApppytminvoicedtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ApppytminvoicedtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ApppytminvoicedtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
