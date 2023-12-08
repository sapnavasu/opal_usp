<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppsiteauditquestionmsttmpTbl]].
 *
 * @see AppsiteauditquestionmsttmpTbl
 */
class AppsiteauditquestionmsttmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppsiteauditquestionmsttmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppsiteauditquestionmsttmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
