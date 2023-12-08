<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalcitymstTbl]].
 *
 * @see OpalcitymstTbl
 */
class OpalcitymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalcitymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalcitymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
