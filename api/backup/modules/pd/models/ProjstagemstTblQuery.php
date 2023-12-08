<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjstagemstTbl]].
 *
 * @see ProjstagemstTbl
 */
class ProjstagemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjstagemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjstagemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getProjectStage(){
        $model = ProjstagemstTbl::find()
                ->select(['projstagemst_pk as dataPk','prsm_projstage as dataValue'])
                ->where(['=','prsm_status',1])
                ->orderBy(['prsm_projstage'=> SORT_ASC])
                ->asArray()->All();
        return $model;
    }
}
