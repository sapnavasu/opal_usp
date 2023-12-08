<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsawardhstyTbl]].
 *
 * @see CmsawardhstyTbl
 */
class CmsawardhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsawardhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsawardhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
