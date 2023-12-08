<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MinistrypscodemstTbl]].
 *
 * @see MinistrypscodemstTbl
 */
class MinistrypscodemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MinistrypscodemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MinistrypscodemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
