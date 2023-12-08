<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalauditlogTbl]].
 *
 * @see OpalauditlogTbl
 */
class OpalauditlogTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalauditlogTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalauditlogTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
