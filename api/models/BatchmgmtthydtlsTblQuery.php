<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtthydtlsTbl]].
 *
 * @see BatchmgmtthydtlsTbl
 */
class BatchmgmtthydtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtthydtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtthydtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
