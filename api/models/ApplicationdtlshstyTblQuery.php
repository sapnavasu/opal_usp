<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ApplicationdtlshstyTbl]].
 *
 * @see ApplicationdtlshstyTbl
 */
class ApplicationdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ApplicationdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ApplicationdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
