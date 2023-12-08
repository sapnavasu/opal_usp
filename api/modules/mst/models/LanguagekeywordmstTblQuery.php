<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[LanguagekeywordmstTbl]].
 *
 * @see LanguagekeywordmstTbl
 */
class LanguagekeywordmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LanguagekeywordmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LanguagekeywordmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
