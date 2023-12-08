<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtasmtdtlsTbl]].
 *
 * @see BatchmgmtasmtdtlsTbl
 */
class BatchmgmtasmtdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmtdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmtdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
