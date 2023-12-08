<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IndustrialzonemstTbl]].
 *
 * @see IndustrialzonemstTbl
 */
class IndustrialzonemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return IndustrialzonemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IndustrialzonemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
