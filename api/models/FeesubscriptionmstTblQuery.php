<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeesubscriptionmstTbl]].
 *
 * @see FeesubscriptionmstTbl
 */
class FeesubscriptionmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FeesubscriptionmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FeesubscriptionmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
