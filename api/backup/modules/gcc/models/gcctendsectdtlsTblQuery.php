<?php

namespace api\modules\gcc\models;

/**
 * This is the ActiveQuery class for [[gcctendsubsdtlsTbl]].
 *
 * @see gcctendsubsdtlsTbl
 */
class gcctendsectdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return gcctendsubsdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return gcctendsubsdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
