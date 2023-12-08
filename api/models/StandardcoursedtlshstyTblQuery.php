<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StandardcoursedtlshstyTbl]].
 *
 * @see StandardcoursedtlshstyTbl
 */
class StandardcoursedtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StandardcoursedtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursedtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
