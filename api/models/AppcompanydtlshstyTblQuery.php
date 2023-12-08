<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppcompanydtlshstyTbl]].
 *
 * @see AppcompanydtlshstyTbl
 */
class AppcompanydtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppcompanydtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppcompanydtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
