<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[LicauthusersTbl]].
 *
 * @see LicauthusersTbl
 */
class LicauthusersTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicauthusersTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicauthusersTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}