<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtpractdtlsTbl]].
 *
 * @see BatchmgmtpractdtlsTbl
 */
class BatchmgmtpractdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtpractdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtpractdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
