<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmthstyTbl]].
 *
 * @see BatchmgmthstyTbl
 */
class BatchmgmthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
