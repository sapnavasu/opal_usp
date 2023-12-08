<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AuditanswerdtlsTbl]].
 *
 * @see AuditanswerdtlsTbl
 */
class AuditanswerdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AuditanswerdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AuditanswerdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
