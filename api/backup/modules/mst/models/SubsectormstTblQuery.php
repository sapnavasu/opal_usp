<?php

namespace api\modules\mst\models;
use api\modules\mst\models\SubsectormstTbl;
use yii\data\ActiveDataProvider;
use common\components\Security;
/**
 * This is the ActiveQuery class for [[SubsectormstTbl]].
 *
 * @see SubsectormstTbl
 */
class SubsectormstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SubsectormstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SubsectormstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getsubsectorlist($sectorPk)
    {
      return new ActiveDataProvider([
        'query' => IndustrymstTbl::find()
            ->select(['IndustryMst_Pk','IndM_IndustryName'])
            ->where(['=','IndM_Status',1])
            ->orderBy('IndM_IndustryName ASC')
            ->andWhere('IndM_SectorMst_Fk=:pk',array(':pk'=>Security::sanitizeInput($sectorPk,"number")))

    ]);
    }
}