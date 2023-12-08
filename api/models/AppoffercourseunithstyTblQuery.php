<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppoffercourseunithstyTbl]].
 *
 * @see AppoffercourseunithstyTbl
 */
class AppoffercourseunithstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppoffercourseunithstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercourseunithstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
