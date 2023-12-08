<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[BgimpurposemstTbl]].
 *
 * @see BgimpurposemstTbl
 */
class BgimpurposemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BgimpurposemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BgimpurposemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
