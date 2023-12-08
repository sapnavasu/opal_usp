<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompbussrcapprovaldtlsTbl]].
 *
 * @see MemcompbussrcapprovaldtlsTbl
 */
class MemcompbussrcapprovaldtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompbussrcapprovaldtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompbussrcapprovaldtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
