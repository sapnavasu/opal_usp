<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompprofilesectoractivitydtlsTbl]].
 *
 * @see MemcompprofilesectoractivitydtlsTbl
 */
class MemcompprofilesectoractivitydtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprofilesectoractivitydtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprofilesectoractivitydtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
