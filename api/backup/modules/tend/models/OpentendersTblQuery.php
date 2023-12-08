<?php

namespace api\modules\tend\models;

/**
 * This is the ActiveQuery class for [[OpentendersTbl]].
 *
 * @see OpentendersTbl
 */
class OpentendersTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpentendersTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpentendersTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
