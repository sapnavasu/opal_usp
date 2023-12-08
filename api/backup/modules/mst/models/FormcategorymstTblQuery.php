<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[FormcategorymstTbl]].
 *
 * @see FormcategorymstTbl
 */
class FormcategorymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FormcategorymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FormcategorymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
