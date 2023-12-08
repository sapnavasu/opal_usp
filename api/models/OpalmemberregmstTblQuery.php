<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalmemberregmstTbl]].
 *
 * @see OpalmemberregmstTbl
 */
class OpalmemberregmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalmemberregmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalmemberregmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
