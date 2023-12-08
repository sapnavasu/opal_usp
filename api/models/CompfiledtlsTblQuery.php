<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CompfiledtlsTbl]].
 *
 * @see CompfiledtlsTbl
 */
class CompfiledtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CompfiledtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompfiledtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
