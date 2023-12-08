<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[AdminmodulemstTb]].
 *
 * @see AdminmodulemstTb
 */
class AdminmodulemstTbQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AdminmodulemstTb[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AdminmodulemstTb|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
