<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[NatlookoutsubcatmstTbl]].
 *
 * @see NatlookoutsubcatmstTbl
 */
class NatlookoutsubcatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return NatlookoutsubcatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NatlookoutsubcatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
