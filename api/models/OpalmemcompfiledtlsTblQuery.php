<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalmemcompfiledtlsTbl]].
 *
 * @see OpalmemcompfiledtlsTbl
 */
class OpalmemcompfiledtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalmemcompfiledtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalmemcompfiledtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
