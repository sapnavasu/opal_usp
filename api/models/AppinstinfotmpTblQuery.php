<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppinstinfotmpTbl]].
 *
 * @see AppinstinfotmpTbl
 */
class AppinstinfotmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppinstinfotmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppinstinfotmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
