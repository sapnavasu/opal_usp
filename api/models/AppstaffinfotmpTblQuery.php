<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppstaffinfotmpTbl]].
 *
 * @see AppstaffinfotmpTbl
 */
class AppstaffinfotmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppstaffinfotmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppstaffinfotmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
