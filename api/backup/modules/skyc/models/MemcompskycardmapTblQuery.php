<?php

namespace api\modules\skyc\models;

/**
 * This is the ActiveQuery class for [[MemcompskycardmapTbl]].
 *
 * @see MemcompskycardmapTbl
 */
class MemcompskycardmapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompskycardmapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycardmapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
