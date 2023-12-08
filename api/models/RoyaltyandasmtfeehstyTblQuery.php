<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RoyaltyandasmtfeehstyTbl]].
 *
 * @see RoyaltyandasmtfeehstyTbl
 */
class RoyaltyandasmtfeehstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RoyaltyandasmtfeehstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RoyaltyandasmtfeehstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
