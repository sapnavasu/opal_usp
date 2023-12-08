<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RasvehinsponquesdtlshstyTbl]].
 *
 * @see RasvehinsponquesdtlshstyTbl
 */
class RasvehinsponquesdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RasvehinsponquesdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponquesdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
