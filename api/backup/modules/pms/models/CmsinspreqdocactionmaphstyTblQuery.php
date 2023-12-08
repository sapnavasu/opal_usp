<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsinspreqdocactionmaphstyTbl]].
 *
 * @see CmsinspreqdocactionmaphstyTbl
 */
class CmsinspreqdocactionmaphstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmaphstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmaphstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
