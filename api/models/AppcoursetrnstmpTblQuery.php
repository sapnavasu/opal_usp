<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppcoursetrnstmpTbl]].
 *
 * @see AppcoursetrnstmpTbl
 */
class AppcoursetrnstmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppcoursetrnstmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppcoursetrnstmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
