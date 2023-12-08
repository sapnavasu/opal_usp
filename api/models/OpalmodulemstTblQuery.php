<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalmodulemstTbl]].
 *
 * @see OpalmodulemstTbl
 */
class OpalmodulemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalmodulemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalmodulemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
