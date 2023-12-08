<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsinspandapprovalTbl]].
 *
 * @see IvmsinspandapprovalTbl
 */
class IvmsinspandapprovalTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsinspandapprovalTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspandapprovalTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
