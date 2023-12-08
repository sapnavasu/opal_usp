<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MemcompprodbussrcfctymapTbl]].
 *
 * @see MemcompprodbussrcfctymapTbl
 */
class MemcompprodbussrcfctymapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodbussrcfctymapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodbussrcfctymapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
