<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[NatlookoutcatmstTbl]].
 *
 * @see NatlookoutcatmstTbl
 */
class NatlookoutcatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return NatlookoutcatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NatlookoutcatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
