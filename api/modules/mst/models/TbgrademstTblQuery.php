<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[TbgrademstTbl]].
 *
 * @see TbgrademstTbl
 */
class TbgrademstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TbgrademstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TbgrademstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
