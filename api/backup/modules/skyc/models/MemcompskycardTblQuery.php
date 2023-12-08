<?php

namespace api\modules\skyc\models;

/**
 * This is the ActiveQuery class for [[MemcompskycardTbl]].
 *
 * @see MemcompskycardTbl
 */
class MemcompskycardTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompskycardTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycardTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
