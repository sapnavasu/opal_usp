<?php

namespace api\modules\drv\models;

/**
 * This is the ActiveQuery class for [[MemcompfiledtlsTbl]].
 *
 * @see MemcompfiledtlsTbl
 */
class MemcompfiledtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompfiledtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompfiledtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
