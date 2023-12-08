<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TrngattdntdtlsTbl]].
 *
 * @see TrngattdntdtlsTbl
 */
class TrngattdntdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TrngattdntdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TrngattdntdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
