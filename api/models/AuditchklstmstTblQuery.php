<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AuditchklstmstTbl]].
 *
 * @see AuditchklstmstTbl
 */
class AuditchklstmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AuditchklstmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AuditchklstmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
