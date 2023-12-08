<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[AdminuserrolemstTbl]].
 *
 * @see AdminuserrolemstTbl
 */
class AdminuserrolemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AdminuserrolemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AdminuserrolemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
