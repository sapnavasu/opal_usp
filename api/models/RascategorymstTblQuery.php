<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RascategorymstTbl]].
 *
 * @see RascategorymstTbl
 */
class RascategorymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RascategorymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RascategorymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
