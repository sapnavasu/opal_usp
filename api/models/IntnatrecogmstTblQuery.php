<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IntnatrecogmstTbl]].
 *
 * @see IntnatrecogmstTbl
 */
class IntnatrecogmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IntnatrecogmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IntnatrecogmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
