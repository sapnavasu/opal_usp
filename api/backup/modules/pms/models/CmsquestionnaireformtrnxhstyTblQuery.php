<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsquestionnaireformtrnxhstyTbl]].
 *
 * @see CmsquestionnaireformtrnxhstyTbl
 */
class CmsquestionnaireformtrnxhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
