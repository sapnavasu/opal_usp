<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IvmsdeviceinstallconfigmstTbl]].
 *
 * @see IvmsdeviceinstallconfigmstTbl
 */
class IvmsdeviceinstallconfigmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IvmsdeviceinstallconfigmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IvmsdeviceinstallconfigmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
