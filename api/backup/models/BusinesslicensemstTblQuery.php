<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BusinesslicensemstTbl]].
 *
 * @see BusinesslicensemstTbl
 */
class BusinesslicensemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BusinesslicensemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinesslicensemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
