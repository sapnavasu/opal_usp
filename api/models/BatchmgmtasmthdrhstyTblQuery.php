<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtasmthdrhstyTbl]].
 *
 * @see BatchmgmtasmthdrhstyTbl
 */
class BatchmgmtasmthdrhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmthdrhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmthdrhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
