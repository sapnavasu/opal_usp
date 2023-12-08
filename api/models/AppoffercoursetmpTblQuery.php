<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppoffercoursetmpTbl]].
 *
 * @see AppoffercoursetmpTbl
 */
class AppoffercoursetmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppoffercoursetmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercoursetmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
