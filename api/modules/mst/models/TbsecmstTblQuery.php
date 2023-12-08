<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[TbsecmstTbl]].
 *
 * @see TbsecmstTbl
 */
class TbsecmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TbsecmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TbsecmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
    {
        return $this->andWhere(['SegM_Status' => 'A']);
    }
}
