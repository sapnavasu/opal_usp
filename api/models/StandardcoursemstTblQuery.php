<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StandardcoursemstTbl]].
 *
 * @see StandardcoursemstTbl
 */
class StandardcoursemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StandardcoursemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
