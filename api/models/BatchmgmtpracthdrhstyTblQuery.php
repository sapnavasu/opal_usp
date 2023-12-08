<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtpracthdrhstyTbl]].
 *
 * @see BatchmgmtpracthdrhstyTbl
 */
class BatchmgmtpracthdrhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtpracthdrhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtpracthdrhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
