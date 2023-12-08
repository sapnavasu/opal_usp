<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffevaluationhstyTbl]].
 *
 * @see StaffevaluationhstyTbl
 */
class StaffevaluationhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffevaluationhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffevaluationhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
