<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ApplicationdtlstmpTbl]].
 *
 * @see ApplicationdtlstmpTbl
 */
class ApplicationdtlstmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ApplicationdtlstmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ApplicationdtlstmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
