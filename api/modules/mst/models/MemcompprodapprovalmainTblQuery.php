<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompprodapprovalmainTbl]].
 *
 * @see MemcompprodapprovalmainTbl
 */
class MemcompprodapprovalmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodapprovalmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodapprovalmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
