<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ReferencemsthstyTbl]].
 *
 * @see ReferencemsthstyTbl
 */
class ReferencemsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ReferencemsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ReferencemsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
