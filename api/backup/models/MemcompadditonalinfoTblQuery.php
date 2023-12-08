<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MemcompadditonalinfoTbl]].
 *
 * @see MemcompadditonalinfoTbl
 */
class MemcompadditonalinfoTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompadditonalinfoTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompadditonalinfoTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
