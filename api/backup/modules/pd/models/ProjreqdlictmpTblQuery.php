<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjreqdlictmpTbl]].
 *
 * @see ProjreqdlictmpTbl
 */
class ProjreqdlictmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjreqdlictmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjreqdlictmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
