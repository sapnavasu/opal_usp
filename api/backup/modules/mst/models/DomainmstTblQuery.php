<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[DomainmstTbl]].
 *
 * @see DomainmstTbl
 */
class DomainmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DomainmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DomainmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
