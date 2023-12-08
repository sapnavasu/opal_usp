<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjpromoterdtlsTbl]].
 *
 * @see ProjpromoterdtlsTbl
 */
class ProjpromoterdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjpromoterdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjpromoterdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
