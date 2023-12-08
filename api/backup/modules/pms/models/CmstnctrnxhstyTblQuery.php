<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmstnctrnxhstyTbl]].
 *
 * @see CmstnctrnxhstyTbl
 */
class CmstnctrnxhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstnctrnxhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstnctrnxhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
