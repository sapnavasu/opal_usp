<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffevaluationmainTbl]].
 *
 * @see StaffevaluationmainTbl
 */
class StaffevaluationmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffevaluationmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffevaluationmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
