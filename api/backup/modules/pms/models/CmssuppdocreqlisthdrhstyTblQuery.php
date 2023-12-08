<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmssuppdocreqlisthdrhstyTbl]].
 *
 * @see CmssuppdocreqlisthdrhstyTbl
 */
class CmssuppdocreqlisthdrhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
