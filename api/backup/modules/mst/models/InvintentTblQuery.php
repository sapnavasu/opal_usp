<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[InvintentTbl]].
 *
 * @see InvintentTbl
 */
class InvintentTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InvintentTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InvintentTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
