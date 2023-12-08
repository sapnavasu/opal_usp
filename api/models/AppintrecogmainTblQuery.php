<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppintrecogmainTbl]].
 *
 * @see AppintrecogmainTbl
 */
class AppintrecogmainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppintrecogmainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppintrecogmainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
