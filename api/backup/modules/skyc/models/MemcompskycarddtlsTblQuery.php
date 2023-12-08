<?php

namespace api\modules\skyc\models;

/**
 * This is the ActiveQuery class for [[MemcompskycarddtlsTbl]].
 *
 * @see MemcompskycarddtlsTbl
 */
class MemcompskycarddtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompskycarddtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycarddtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
