<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[UserrolemstTbl]].
 *
 * @see UserrolemstTbl
 */
class UserrolemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserrolemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserrolemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
