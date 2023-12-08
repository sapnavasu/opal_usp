<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[MemcompprodmstmapmainTbl]].
 *
 * @see MemcompprodmstmapmainTbl
 */
class MemcompprodmstmapmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmapmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmapmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
