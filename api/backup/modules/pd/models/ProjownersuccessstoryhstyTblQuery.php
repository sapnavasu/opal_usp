<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjownersuccessstoryhstyTbl]].
 *
 * @see ProjownersuccessstoryhstyTbl
 */
class ProjownersuccessstoryhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjownersuccessstoryhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjownersuccessstoryhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
