<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsrqtendermapTbl]].
 *
 * @see CmsrqtendermapTbl
 */
class CmsrqtendermapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrqtendermapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqtendermapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
