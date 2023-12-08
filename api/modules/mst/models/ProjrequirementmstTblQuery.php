<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[ProjrequirementmstTbl]].
 *
 * @see ProjrequirementmstTbl
 */
class ProjrequirementmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjrequirementmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjrequirementmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getrequiments(){
        $model = ProjrequirementmstTbl::find()
                ->select(['projrequirementmst_pk','prm_projrequirement'])
                ->andWhere('prm_status=1')
                ->asArray()->All();
        return $model;
    }
}
