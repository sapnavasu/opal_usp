<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjtendtmpTbl]].
 *
 * @see ProjtendtmpTbl
 */
class ProjtendtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtendtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtendtmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
