<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CoursecategorymstTbl]].
 *
 * @see CoursecategorymstTbl
 */
class CoursecategorymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CoursecategorymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CoursecategorymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
