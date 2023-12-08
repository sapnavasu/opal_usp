<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompfinancialapprovalmainTbl]].
 *
 * @see MemcompfinancialapprovalmainTbl
 */
class MemcompfinancialapprovalmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompfinancialapprovalmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompfinancialapprovalmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
