<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppoprcontracttmpTbl]].
 *
 * @see AppoprcontracttmpTbl
 */
class AppoprcontracttmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppoprcontracttmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppoprcontracttmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
