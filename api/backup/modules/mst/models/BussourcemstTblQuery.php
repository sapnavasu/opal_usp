<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[BussourcemstTbl]].
 *
 * @see BussourcemstTbl
 */
class BussourcemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BussourcemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BussourcemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
    {
        return $this->andWhere(['BSM_Status' => 'A']);
    }
}
