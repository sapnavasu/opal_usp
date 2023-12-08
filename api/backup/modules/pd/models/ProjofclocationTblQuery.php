<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjofclocationTbl]].
 *
 * @see ProjofclocationTbl
 */
class ProjofclocationTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjofclocationTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjofclocationTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
