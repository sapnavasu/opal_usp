<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[SpecificationmstTbl]].
 *
 * @see SpecificationmstTbl
 */
class SpecificationmstTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return SpecificationmstTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SpecificationmstTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function active($db = null) {
        return $this->andWhere(['SpM_Status' => 'A']);
    }

    public static function GetUserDefSpecmst($catPk, $type) {
        if ($type == 'P') {
            $returnSpecMSt = \common\models\SpecificationmstTbl::find()
                            ->select(['SpecificationMst_Pk', 'SpM_Specification', 'SpM_SpecDesc'])
                            ->leftJoin(\common\models\MemcompspecprodvaldtlsTbl::tableName(), 'SpecificationMst_Pk=mcspvd_specificationmst_fk')
                            ->where('SpM_SpecCategory="P" and SpM_Status="I" and SpM_SpecDesc !="" and mcspvd_productmst_fk="' . $catPk . '"')->asArray()->all();
        } else if ($type == 'S') {
            $returnSpecMSt = \common\models\SpecificationmstTbl::find()
                            ->select(['SpecificationMst_Pk', 'SpM_Specification', 'SpM_SpecDesc'])
                            ->leftJoin(\common\models\MemcompspecservvaldtlsTbl::tableName(), 'SpecificationMst_Pk=mcssvd_specificationmst_fk')
                            ->where('SpM_SpecCategory="S" and SpM_Status="I" and SpM_SpecDesc !="" and mcssvd_servicemst_fk="' . $catPk . '"')->asArray()->all();
        }
        return \GuzzleHttp\json_decode($returnSpecMSt);
    }

}
