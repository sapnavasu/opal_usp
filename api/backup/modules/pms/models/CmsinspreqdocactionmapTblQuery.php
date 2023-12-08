<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsinspreqdocactionmapTbl]].
 *
 * @see CmsinspreqdocactionmapTbl
 */
class CmsinspreqdocactionmapTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmapTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmapTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function saveInspectionReqMap($formdata, $dtlsPk) {
        if (!empty($formdata)) {
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            foreach ($formdata as $key => $item) {
                if (!empty($item['dataPK']) && $item['dataPK'] != null) {
                    $model = CmsinspreqdocactionmapTbl::find()->where("cmsinspreqdocactionmap_pk =:pk and cirdam_cmsinspreqdocdtls_fk = :dtlsPk", [':pk' => $item['dataPK'], ':dtlsPk' => $dtlsPk])->one();
                } else {
                    $model = new CmsinspreqdocactionmapTbl;
                    $model->cirdam_cmsinspreqdocdtls_fk = $dtlsPk;
                    $model->cirdam_cmsinspreqdocactionmaptemp_fk = null;
                }
                $model->cirdam_quancheck_mcm_fk = $item['companyPk'] ? $item['companyPk'] : null;
                $model->cirdam_quancheckname = !$item['companyPk'] ? $item['quontum'] : null;
                $model->cirdam_actions = $item['action'];
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => 'Data Added',
                    );
                }  else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );                  
                }
            }
            return $result;
        }
    }

    public function autoCreatInspectionReqMap($formdata, $dtlsPk) {
        if (!empty($formdata)) {
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            foreach ($formdata as $key => $item) {
                $model = new CmsinspreqdocactionmapTbl;
                $model->cirdam_cmsinspreqdocdtls_fk = $dtlsPk;
                $model->cirdam_quancheck_mcm_fk = $item['cirdam_quancheck_mcm_fk'];
                $model->cirdam_quancheckname = $item['cirdam_quancheckname'];
                $model->cirdam_actions = $item['cirdam_actions'];
                $model->save();
            }
        }
    }

    public function getMapData($dtlsPk) {
        $query = [];
        if (!empty($dtlsPk)) {
            $query = CmsinspreqdocactionmapTbl::find()
                    ->select(['cmsinspreqdocactionmap_pk', 'cirdam_cmsinspreqdocdtls_fk', 'cirdam_quancheck_mcm_fk', 'cirdam_quancheckname', 'cirdam_actions', 'MCM_CompanyName', 'cirdam_quancheck_mcm_fk'])
                    ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cirdam_quancheck_mcm_fk')
                    ->where("cirdam_cmsinspreqdocdtls_fk=:dataPk", [':dataPk' => $dtlsPk])
                    ->orderBy(['cmsinspreqdocactionmap_pk' => SORT_DESC])
                    ->asArray()
                    ->all();
        }
        return $query;
    }

    public function deleteiInspecationMapData($dataPk) {
        if (!empty($dataPk)) {
            $model = CmsinspreqdocactionmapTbl::findOne($dataPk)->delete();
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
