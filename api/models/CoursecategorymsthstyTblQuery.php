<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CoursecategorymsthstyTbl]].
 *
 * @see CoursecategorymsthstyTbl
 */
class CoursecategorymsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CoursecategorymsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CoursecategorymsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
