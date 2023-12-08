<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsrqprodservmapTbl]].
 *
 * @see CmsrqprodservmapTbl
 */
class CmsrqprodservmapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
