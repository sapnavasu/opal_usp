<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjacqlichstyTbl]].
 *
 * @see ProjacqlichstyTbl
 */
class ProjacqlichstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjacqlichstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjacqlichstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
