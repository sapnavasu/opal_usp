<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppintrecogtmpTbl]].
 *
 * @see AppintrecogtmpTbl
 */
class AppintrecogtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppintrecogtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppintrecogtmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
