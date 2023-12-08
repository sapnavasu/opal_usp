<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsquestionnaireformtrnxtempTbl]].
 *
 * @see CmsquestionnaireformtrnxtempTbl
 */
class CmsquestionnaireformtrnxtempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
