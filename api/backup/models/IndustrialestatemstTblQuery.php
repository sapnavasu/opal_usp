<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IndustrialestatemstTbl]].
 *
 * @see IndustrialestatemstTbl
 */
class IndustrialestatemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IndustrialestatemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IndustrialestatemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
