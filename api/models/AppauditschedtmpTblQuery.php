<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppauditschedtmpTbl]].
 *
 * @see AppauditschedtmpTbl
 */
class AppauditschedtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppauditschedtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppauditschedtmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
