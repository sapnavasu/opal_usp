<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SerialnomstTbl]].
 *
 * @see SerialnomstTbl
 */
class SerialnomstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SerialnomstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SerialnomstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
