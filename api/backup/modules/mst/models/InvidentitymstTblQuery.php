<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[InvidentitymstTbl]].
 *
 * @see InvidentitymstTbl
 */
class InvidentitymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InvidentitymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InvidentitymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
