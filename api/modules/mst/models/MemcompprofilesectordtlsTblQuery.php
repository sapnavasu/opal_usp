<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompprofilesectordtlsTbl]].
 *
 * @see MemcompprofilesectordtlsTbl
 */
class MemcompprofilesectordtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprofilesectordtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprofilesectordtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
