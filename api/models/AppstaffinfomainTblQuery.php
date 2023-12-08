<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppstaffinfomainTbl]].
 *
 * @see AppstaffinfomainTbl
 */
class AppstaffinfomainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppstaffinfomainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppstaffinfomainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
