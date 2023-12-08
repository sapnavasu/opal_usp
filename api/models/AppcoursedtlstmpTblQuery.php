<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppcoursedtlstmpTbl]].
 *
 * @see AppcoursedtlstmpTbl
 */
class AppcoursedtlstmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppcoursedtlstmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppcoursedtlstmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
