<?php

namespace api\modules\gcc\models;

/**
 * This is the ActiveQuery class for [[GcctendsubsdtlsTbl]].
 *
 * @see GcctendsubsdtlsTbl
 */
class GcctendsubsdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GcctendsubsdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GcctendsubsdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
