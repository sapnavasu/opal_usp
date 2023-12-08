<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchattdntdwldtrackTbl]].
 *
 * @see BatchattdntdwldtrackTbl
 */
class BatchattdntdwldtrackTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchattdntdwldtrackTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchattdntdwldtrackTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
