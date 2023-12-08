<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsinspreqdocdtlshstyTbl]].
 *
 * @see CmsinspreqdocdtlshstyTbl
 */
class CmsinspreqdocdtlshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
