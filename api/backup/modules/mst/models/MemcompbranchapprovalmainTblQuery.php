<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompbranchapprovalmainTbl]].
 *
 * @see MemcompbranchapprovalmainTbl
 */
class MemcompbranchapprovalmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompbranchapprovalmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompbranchapprovalmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
