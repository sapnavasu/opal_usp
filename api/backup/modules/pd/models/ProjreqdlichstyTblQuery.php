<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjreqdlichstyTbl]].
 *
 * @see ProjreqdlichstyTbl
 */
class ProjreqdlichstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjreqdlichstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjreqdlichstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
