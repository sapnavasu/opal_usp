<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalstkholdertypmstTbl]].
 *
 * @see OpalstkholdertypmstTbl
 */
class OpalstkholdertypmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalstkholdertypmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalstkholdertypmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
