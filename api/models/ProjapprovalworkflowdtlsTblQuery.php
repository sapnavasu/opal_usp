<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjapprovalworkflowdtlsTbl]].
 *
 * @see ProjapprovalworkflowdtlsTbl
 */
class ProjapprovalworkflowdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
