<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjinvinfohstyTbl]].
 *
 * @see ProjinvinfohstyTbl
 */
class ProjinvinfohstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvinfohstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvinfohstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
