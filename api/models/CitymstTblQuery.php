<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CitymstTbl]].
 *
 * @see CitymstTbl
 */
class CitymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CitymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CitymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
