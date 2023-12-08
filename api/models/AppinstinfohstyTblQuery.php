<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppinstinfohstyTbl]].
 *
 * @see AppinstinfohstyTbl
 */
class AppinstinfohstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppinstinfohstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppinstinfohstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
