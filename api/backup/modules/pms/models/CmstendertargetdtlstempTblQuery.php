<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmstendertargetdtlstempTbl]].
 *
 * @see CmstendertargetdtlstempTbl
 */
class CmstendertargetdtlstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstendertargetdtlstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstendertargetdtlstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
