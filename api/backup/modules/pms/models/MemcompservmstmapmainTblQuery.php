<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[MemcompservmstmapmainTbl]].
 *
 * @see MemcompservmstmapmainTbl
 */
class MemcompservmstmapmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompservmstmapmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompservmstmapmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
