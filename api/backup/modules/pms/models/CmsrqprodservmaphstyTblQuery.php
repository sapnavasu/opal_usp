<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsrqprodservmaphstyTbl]].
 *
 * @see CmsrqprodservmaphstyTbl
 */
class CmsrqprodservmaphstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmaphstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmaphstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
