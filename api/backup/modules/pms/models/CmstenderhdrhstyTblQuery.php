<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmstenderhdrhstyTbl]].
 *
 * @see CmstenderhdrhstyTbl
 */
class CmstenderhdrhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstenderhdrhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderhdrhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
