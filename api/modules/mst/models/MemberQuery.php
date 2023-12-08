<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompprofachvdtlsTbl]].
 *
 * @see MemcompprofachvdtlsTbl
 */
class MemberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprofachvdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprofachvdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
