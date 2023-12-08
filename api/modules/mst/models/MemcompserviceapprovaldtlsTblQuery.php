<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompserviceapprovaldtlsTbl]].
 *
 * @see MemcompserviceapprovaldtlsTbl
 */
class MemcompserviceapprovaldtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompserviceapprovaldtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompserviceapprovaldtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
