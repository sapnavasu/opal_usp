<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StandardcoursemsthstyTbl]].
 *
 * @see StandardcoursemsthstyTbl
 */
class StandardcoursemsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StandardcoursemsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursemsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
