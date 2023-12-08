<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmssupdocumenthstyTbl]].
 *
 * @see CmssupdocumenthstyTbl
 */
class CmssupdocumenthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssupdocumenthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssupdocumenthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
