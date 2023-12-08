<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjreqdlicdtlsTbl]].
 *
 * @see ProjreqdlicdtlsTbl
 */
class ProjreqdlicdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjreqdlicdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjreqdlicdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
