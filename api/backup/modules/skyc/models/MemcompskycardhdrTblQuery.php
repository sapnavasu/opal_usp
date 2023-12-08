<?php

namespace api\modules\skyc\models;

/**
 * This is the ActiveQuery class for [[MemcompskycardhdrTbl]].
 *
 * @see MemcompskycardhdrTbl
 */
class MemcompskycardhdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompskycardhdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycardhdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
