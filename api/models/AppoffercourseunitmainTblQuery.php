<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppoffercourseunitmainTbl]].
 *
 * @see AppoffercourseunitmainTbl
 */
class AppoffercourseunitmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppoffercourseunitmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercourseunitmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
