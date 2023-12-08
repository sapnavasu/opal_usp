<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtthyhdrTbl]].
 *
 * @see BatchmgmtthyhdrTbl
 */
class BatchmgmtthyhdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtthyhdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtthyhdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
