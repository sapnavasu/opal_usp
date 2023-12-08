<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppoffercoursemainTbl]].
 *
 * @see AppoffercoursemainTbl
 */
class AppoffercoursemainTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppoffercoursemainTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercoursemainTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
