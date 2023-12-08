<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DocumentdtlsmsthstyTbl]].
 *
 * @see DocumentdtlsmsthstyTbl
 */
class DocumentdtlsmsthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DocumentdtlsmsthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DocumentdtlsmsthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
