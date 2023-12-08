<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsconttypemstTbl]].
 *
 * @see CmsconttypemstTbl
 */
class CmsconttypemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsconttypemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsconttypemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
