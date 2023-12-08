<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RasvehinsponansdtlsTbl]].
 *
 * @see RasvehinsponansdtlsTbl
 */
class RasvehinsponansdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RasvehinsponansdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponansdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
