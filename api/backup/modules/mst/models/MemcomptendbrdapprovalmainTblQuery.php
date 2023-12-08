<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcomptendbrdapprovalmainTbl]].
 *
 * @see MemcomptendbrdapprovalmainTbl
 */
class MemcomptendbrdapprovalmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcomptendbrdapprovalmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcomptendbrdapprovalmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
