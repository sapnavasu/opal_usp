<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtdurationdtlsTbl]].
 *
 * @see BatchmgmtdurationdtlsTbl
 */
class BatchmgmtdurationdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtdurationdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtdurationdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
