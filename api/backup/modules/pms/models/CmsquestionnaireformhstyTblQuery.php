<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsquestionnaireformhstyTbl]].
 *
 * @see CmsquestionnaireformhstyTbl
 */
class CmsquestionnaireformhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
