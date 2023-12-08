<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsrqprodservdtlshstyTbl]].
 *
 * @see CmsrqprodservdtlshstyTbl
 */
class CmsrqprodservdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
