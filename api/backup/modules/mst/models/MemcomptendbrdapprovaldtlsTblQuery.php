<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcomptendbrdapprovaldtlsTbl]].
 *
 * @see MemcomptendbrdapprovaldtlsTbl
 */
class MemcomptendbrdapprovaldtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcomptendbrdapprovaldtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcomptendbrdapprovaldtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
