<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppoprcontracthstyTbl]].
 *
 * @see AppoprcontracthstyTbl
 */
class AppoprcontracthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppoprcontracthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppoprcontracthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
