<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[LicauthdtlsTbl]].
 *
 * @see LicauthdtlsTbl
 */
class LicauthdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicauthdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicauthdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
