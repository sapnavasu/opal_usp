<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjapprovalworkflowhrdTbl]].
 *
 * @see ProjapprovalworkflowhrdTbl
 */
class ProjapprovalworkflowhrdTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowhrdTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowhrdTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
