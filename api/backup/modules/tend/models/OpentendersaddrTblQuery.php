<?php

namespace api\modules\tend\models;

/**
 * This is the ActiveQuery class for [[OpentendersaddrTbl]].
 *
 * @see OpentendersaddrTbl
 */
class OpentendersaddrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpentendersaddrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpentendersaddrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
