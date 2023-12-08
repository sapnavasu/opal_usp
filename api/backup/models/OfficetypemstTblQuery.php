<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OfficetypemstTbl]].
 *
 * @see OfficetypemstTbl
 */
class OfficetypemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OfficetypemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OfficetypemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
