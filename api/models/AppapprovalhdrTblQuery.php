<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppapprovalhdrTbl]].
 *
 * @see AppapprovalhdrTbl
 */
class AppapprovalhdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppapprovalhdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppapprovalhdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
