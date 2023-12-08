<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[JsrsnonbidderhstyTbl]].
 *
 * @see JsrsnonbidderhstyTbl
 */
class JsrsnonbidderhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return JsrsnonbidderhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JsrsnonbidderhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
