<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompserviceapprovalmainTbl]].
 *
 * @see MemcompserviceapprovalmainTbl
 */
class MemcompserviceapprovalmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompserviceapprovalmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompserviceapprovalmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
