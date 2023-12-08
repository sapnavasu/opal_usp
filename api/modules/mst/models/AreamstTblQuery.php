<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[AreamstTbl]].
 *
 * @see AreamstTbl
 */
class AreamstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AreamstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AreamstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
