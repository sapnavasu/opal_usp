<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GrademsthstyTbl]].
 *
 * @see GrademsthstyTbl
 */
class GrademsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GrademsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrademsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
