<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RasvehinsponquesdtlsTbl]].
 *
 * @see RasvehinsponquesdtlsTbl
 */
class RasvehinsponquesdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RasvehinsponquesdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponquesdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
