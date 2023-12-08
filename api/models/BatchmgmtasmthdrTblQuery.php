<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtasmthdrTbl]].
 *
 * @see BatchmgmtasmthdrTbl
 */
class BatchmgmtasmthdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmthdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmthdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
