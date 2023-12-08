<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[BgieventcatmstTbl]].
 *
 * @see BgieventcatmstTbl
 */
class BgieventcatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BgieventcatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BgieventcatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
