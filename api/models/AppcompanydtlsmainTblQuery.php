<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppcompanydtlsmainTbl]].
 *
 * @see AppcompanydtlsmainTbl
 */
class AppcompanydtlsmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppcompanydtlsmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppcompanydtlsmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
