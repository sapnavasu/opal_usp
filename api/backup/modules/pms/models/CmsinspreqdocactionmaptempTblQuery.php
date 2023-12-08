<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsinspreqdocactionmaptempTbl]].
 *
 * @see CmsinspreqdocactionmaptempTbl
 */
class CmsinspreqdocactionmaptempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmaptempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmaptempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function saveInspectionReqMaptemp($formdata, $dtlsPk) {
        if (!empty($formdata)) {
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            foreach ($formdata as $key => $item) {
                if (!empty($item['dataPK']) && $item['dataPK'] != null) {
                    $model = CmsinspreqdocactionmaptempTbl::find()->where("cmsinspreqdocactionmaptemp_pk =:pk and cirdamt_cmsinspreqdocdtlstemp_fk = :dtlsPk", [':pk' => $item['dataPK'], ':dtlsPk' => $dtlsPk])->one();
                } else {
                    $model = new CmsinspreqdocactionmaptempTbl;
                    $model->cirdamt_cmsinspreqdocdtlstemp_fk = $dtlsPk;
                }
                $model->cirdamt_quancheck_mcm_fk = $item['companyPk'] ? $item['companyPk'] : null;
                $model->cirdamt_quancheckname = !$item['companyPk'] ? $item['quontum'] : null;
                $model->cirdamt_actions = $item['action'];
                $model->save();
            }
        }
    }

    public function autoCreatInspectionReqMap($formdata, $dtlsPk) {
        if (!empty($formdata)) {
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            foreach ($formdata as $key => $item) {
                $model = new CmsinspreqdocactionmaptempTbl;
                $model->cirdamt_cmsinspreqdocdtlstemp_fk = $dtlsPk;
                $model->cirdamt_quancheck_mcm_fk = $item['cirdamt_quancheck_mcm_fk'];
                $model->cirdamt_quancheckname = $item['cirdamt_quancheckname'];
                $model->cirdamt_actions = $item['cirdamt_actions'];
                $model->save();
            }
        }
    }

    public function getMapData($dtlsPk) {
        $query = [];
        if (!empty($dtlsPk)) {
            $query = CmsinspreqdocactionmaptempTbl::find()
                    ->select(['cmsinspreqdocactionmaptemp_pk', 'cirdamt_cmsinspreqdocdtlstemp_fk', 'cirdamt_quancheck_mcm_fk', 'cirdamt_quancheckname', 'cirdamt_actions', 'MCM_CompanyName', 'cirdamt_quancheck_mcm_fk'])
                    ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cirdamt_quancheck_mcm_fk')
                    ->where("cirdamt_cmsinspreqdocdtlstemp_fk=:dataPk", [':dataPk' => $dtlsPk])
                    ->orderBy(['cmsinspreqdocactionmaptemp_pk' => SORT_DESC])
                    ->asArray()
                    ->all();
        }
        return $query;
    }

    public function deleteiInspecationMapData($dataPk) {
        if (!empty($dataPk)) {
            $model = CmsinspreqdocactionmaptempTbl::findOne($dataPk)->delete();
            if ($model) {
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }
}
