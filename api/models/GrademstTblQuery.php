<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GrademstTbl]].
 *
 * @see GrademstTbl
 */
class GrademstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GrademstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrademstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
