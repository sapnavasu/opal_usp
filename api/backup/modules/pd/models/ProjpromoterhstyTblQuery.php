<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjpromoterhstyTbl]].
 *
 * @see ProjpromoterhstyTbl
 */
class ProjpromoterhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjpromoterhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjpromoterhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
