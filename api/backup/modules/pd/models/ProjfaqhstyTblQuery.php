<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjfaqhstyTbl]].
 *
 * @see ProjfaqhstyTbl
 */
class ProjfaqhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjfaqhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjfaqhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
