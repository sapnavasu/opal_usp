<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StafflicensedtlsTbl]].
 *
 * @see StafflicensedtlsTbl
 */
class StafflicensedtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StafflicensedtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StafflicensedtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
