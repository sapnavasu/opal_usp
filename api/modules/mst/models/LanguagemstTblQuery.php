<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[LanguagemstTbl]].
 *
 * @see LanguagemstTbl
 */
class LanguagemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LanguagemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LanguagemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
