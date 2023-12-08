<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[LanguagetranslateTbl]].
 *
 * @see LanguagetranslateTbl
 */
class LanguagetranslateTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LanguagetranslateTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LanguagetranslateTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
