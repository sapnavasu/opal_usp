<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ApplicationdtlsmainTbl]].
 *
 * @see ApplicationdtlsmainTbl
 */
class ApplicationdtlsmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ApplicationdtlsmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ApplicationdtlsmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
