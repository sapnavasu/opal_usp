<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffevaluationtmpTbl]].
 *
 * @see StaffevaluationtmpTbl
 */
class StaffevaluationtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffevaluationtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffevaluationtmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
