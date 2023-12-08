<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[ModulemstTbl]].
 *
 * @see ModulemstTbl
 */
class ModulemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ModulemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ModulemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	
        public function active($db = null)
            {
            return $this->andWhere(['MM_Status' => 'A']);
            }
}
