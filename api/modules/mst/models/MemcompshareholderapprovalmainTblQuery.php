<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompshareholderapprovalmainTbl]].
 *
 * @see MemcompshareholderapprovalmainTbl
 */
class MemcompshareholderapprovalmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompshareholderapprovalmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompshareholderapprovalmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
