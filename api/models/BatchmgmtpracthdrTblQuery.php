<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtpracthdrTbl]].
 *
 * @see BatchmgmtpracthdrTbl
 */
class BatchmgmtpracthdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtpracthdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtpracthdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
