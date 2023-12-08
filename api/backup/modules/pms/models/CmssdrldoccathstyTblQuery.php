<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmssdrldoccathstyTbl]].
 *
 * @see CmssdrldoccathstyTbl
 */
class CmssdrldoccathstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssdrldoccathstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssdrldoccathstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
