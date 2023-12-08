<?php

namespace api\modules\gcc\models;

/**
 * This is the ActiveQuery class for [[gcctendcontdocdtlsTbl]].
 *
 * @see gcctendcontdocdtlsTbl
 */
class gcctendcontdocdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return gcctendcontdocdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return gcctendcontdocdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
