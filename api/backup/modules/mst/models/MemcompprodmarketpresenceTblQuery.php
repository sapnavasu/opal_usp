<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompprodmarketpresenceTbl]].
 *
 * @see MemcompprodmarketpresenceTbl
 */
class MemcompprodmarketpresenceTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodmarketpresenceTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmarketpresenceTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
