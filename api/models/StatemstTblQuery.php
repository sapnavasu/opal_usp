<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StatemstTbl]].
 *
 * @see StatemstTbl
 */
class StatemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StatemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StatemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
