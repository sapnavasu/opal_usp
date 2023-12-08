<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjacqlicdtlsTbl]].
 *
 * @see ProjacqlicdtlsTbl
 */
class ProjacqlicdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjacqlicdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjacqlicdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
