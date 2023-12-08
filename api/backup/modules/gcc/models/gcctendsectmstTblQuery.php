<?php

namespace api\modules\gcc\models;

/**
 * This is the ActiveQuery class for [[ggcctendsectmstTbl]].
 *
 * @see ggcctendsectmstTbl
 */
class gcctendsectmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ggcctendsectmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ggcctendsectmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
