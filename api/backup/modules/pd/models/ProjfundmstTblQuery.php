<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjfundmstTbl]].
 *
 * @see ProjfundmstTbl
 */
class ProjfundmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjfundmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjfundmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function activefunder(){
        return ProjfundmstTbl::find()
                ->select(['projfundmst_pk','pfm_fundedby'])
                ->where('pfm_status = :pfm_status',[':pfm_status' => 1])
                ->orderBy('projfundmst_pk ASC')
                ->asArray()
                ->all();
    }
}
