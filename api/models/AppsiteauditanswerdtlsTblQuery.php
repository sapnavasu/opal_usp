<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppsiteauditanswerdtlsTbl]].
 *
 * @see AppsiteauditanswerdtlsTbl
 */
class AppsiteauditanswerdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppsiteauditanswerdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppsiteauditanswerdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
