<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsrqprodservmaptempTbl]].
 *
 * @see CmsrqprodservmaptempTbl
 */
class CmsrqprodservmaptempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmaptempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmaptempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
