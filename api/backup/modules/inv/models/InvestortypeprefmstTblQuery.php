<?php

namespace api\modules\inv\models;

/**
 * This is the ActiveQuery class for [[InvestortypeprefmstTbl]].
 *
 * @see InvestortypeprefmstTbl
 */
class InvestortypeprefmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InvestortypeprefmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InvestortypeprefmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function preferencelist(){
        $model = InvestortypeprefmstTbl::find()
        ->select(['investortypeprefmst_pk','itpm_investortype'])
        ->orderBy(['itpm_investortype' => SORT_ASC])
        ->asArray()->All();
        return $model;
    }
}
