<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppcompanydtlstmpTbl]].
 *
 * @see AppcompanydtlstmpTbl
 */
class AppcompanydtlstmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppcompanydtlstmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppcompanydtlstmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
