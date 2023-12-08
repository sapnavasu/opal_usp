<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjaccachievehstyTbl]].
 *
 * @see ProjaccachievehstyTbl
 */
class ProjaccachievehstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjaccachievehstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccachievehstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
