<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppcoursetrnsmainTbl]].
 *
 * @see AppcoursetrnsmainTbl
 */
class AppcoursetrnsmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppcoursetrnsmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppcoursetrnsmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
