<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpaluserlogintrackTbl]].
 *
 * @see OpaluserlogintrackTbl
 */
class OpaluserlogintrackTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpaluserlogintrackTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpaluserlogintrackTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
