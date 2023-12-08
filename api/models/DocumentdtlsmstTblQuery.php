<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DocumentdtlsmstTbl]].
 *
 * @see DocumentdtlsmstTbl
 */
class DocumentdtlsmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DocumentdtlsmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DocumentdtlsmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
