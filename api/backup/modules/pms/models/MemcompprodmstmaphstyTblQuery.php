<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[MemcompprodmstmaphstyTbl]].
 *
 * @see MemcompprodmstmaphstyTbl
 */
class MemcompprodmstmaphstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmaphstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmaphstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
