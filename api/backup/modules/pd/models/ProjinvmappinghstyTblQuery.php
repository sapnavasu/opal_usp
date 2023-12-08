<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjinvmappinghstyTbl]].
 *
 * @see ProjinvmappinghstyTbl
 */
class ProjinvmappinghstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvmappinghstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvmappinghstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
