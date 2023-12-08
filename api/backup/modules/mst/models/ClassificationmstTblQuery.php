<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[ClassificationmstTbl]].
 *
 * @see ClassificationmstTbl
 */
class ClassificationmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClassificationmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClassificationmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null) {
        return $this->andWhere(['ClM_Status' => 'A']);
    }

    public function getClassification($requestdata) {
        return ClassificationmstTbl::find()
                ->where('ClM_HeadCount =:ClM_HeadCount and ClM_AnnualSales =:ClM_AnnualSales and CIM_stkholdertypmst_fk =:stktype',
                        [':ClM_HeadCount' => $requestdata['headCount'], ':ClM_AnnualSales' => $requestdata['annualSales'],':stktype' => $requestdata['stktype']])
                ->one();
    }

    public function getClassificationByPk($requestdata) {
        return ClassificationmstTbl::find()
                ->where('ClassificationMst_Pk =:classificationPk',
                        [':classificationPk' => $requestdata['classificationPk']])
                ->one();
    }
  
    public static function classificationQueryCache(){
        return ClassificationmstTbl::find()
        ->select(['max(ClM_UpdatedOn), count(*)'])
        ->createCommand()
        ->getRawSql();
    }
}
