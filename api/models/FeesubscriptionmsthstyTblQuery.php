<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeesubscriptionmsthstyTbl]].
 *
 * @see FeesubscriptionmsthstyTbl
 */
class FeesubscriptionmsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FeesubscriptionmsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FeesubscriptionmsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
