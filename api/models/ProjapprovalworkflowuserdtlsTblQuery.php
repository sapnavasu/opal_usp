<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjapprovalworkflowuserdtlsTbl]].
 *
 * @see ProjapprovalworkflowuserdtlsTbl
 */
class ProjapprovalworkflowuserdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowuserdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowuserdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
