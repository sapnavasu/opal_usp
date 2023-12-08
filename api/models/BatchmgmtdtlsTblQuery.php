<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BatchmgmtdtlsTbl]].
 *
 * @see BatchmgmtdtlsTbl
 */
class BatchmgmtdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BatchmgmtdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function referenceType($type)
    {
        $query = (new \yii\db\Query())
        ->select(['rm_name_en', 'rm_name_ar'])
        ->from('referencemst_tbl')
        ->where(['referencemst_pk' => $type])
        ->all();
        return $query[0];
    }
}
