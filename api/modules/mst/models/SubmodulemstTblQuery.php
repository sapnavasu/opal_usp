<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[SubmodulemstTbl]].
 *
 * @see SubmodulemstTbl
 */
class SubmodulemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SubmodulemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SubmodulemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	 public function active($db = null)
    {
        return $this->andWhere(['SMM_Status' => 'A']);
    }
}
