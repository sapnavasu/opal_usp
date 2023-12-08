<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsinspreqdocdtlsTbl]].
 *
 * @see CmsinspreqdocdtlsTbl
 */
class CmsinspreqdocdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function saveInspectionReq($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            if (!empty($formdata['dtlsPk']) && $formdata['dtlsPk'] != null) {
                $model = CmsinspreqdocdtlsTbl::find()->where("cmsinspreqdocdtls_pk =:pk and cirdd_cmsinspreqdochdr_fk = :headerPk", [':pk' => $formdata['dtlsPk'], ':headerPk' => $headerPk])->one();
                $flag = 'U';
                $comments = 'updated successfully!';
                $model->cirdd_updatedon = $date;
                $model->cirdd_updatedby = $userPK;
                $model->cirdd_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmsinspreqdocdtlsTbl;
                $flag = 'C';
                $comments = 'created successfully!';
                $model->cirdd_createdon = $date;
                $model->cirdd_createdby = $userPK;
                $model->cirdd_createdbyipaddr = $ip_address;
                $model->cirdd_cmsinspreqdochdr_fk = $headerPk;
                $model->cirdd_status = 1;
            }
            $model->cirdd_activityno = $formdata['activityNo'];
            $model->cirdd_activitytitle = $formdata['title'];
            $model->cirdd_refdoc = $formdata['refDoc'];
            $model->cirdd_remarks = $formdata['remarks'];
            if ($model->save() === TRUE) {
                if (!empty($formdata['quontumChkArray'])) {
                    $mapData = CmsinspreqdocactionmapTblQuery::saveInspectionReqMap($formdata['quontumChkArray'], $model->cmsinspreqdocdtls_pk);
                    if ($mapData['flag'] == 'S') {
                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => $flag,
                            'comments' => $comments,
                        );
                    } else {
                        $result = $mapData;
                    }
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments,
                    );
                }
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

    public function autoCreatInspectionReq($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $model = new CmsinspreqdocdtlsTbl;
            $model->cirdd_createdon = $date;
            $model->cirdd_createdby = $userPK;
            $model->cirdd_createdbyipaddr = $ip_address;
            $model->cirdd_cmsinspreqdochdr_fk = $headerPk;
            $model->cirdd_status = 1;
            $model->cirdd_activityno = $formdata['cirdd_activityno'];
            $model->cirdd_activitytitle = $formdata['cirdd_activitytitle'];
            $model->cirdd_refdoc = $formdata['cirdd_refdoc'];
            $model->cirdd_remarks = $formdata['cirdd_remarks'];
            if ($model->save() === TRUE) {
                $getMapData = CmsinspreqdocactionmapTblQuery::getMapData($formdata['dtlsPk']);
                if (!empty($getMapData)) {
                    $mapData = CmsinspreqdocactionmapTblQuery::autoCreatInspectionReqMap($getMapData, $model->cmsinspreqdocdtls_pk);
                }
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

    public function deleteInspecationData($dataPk) {
        if (!empty($dataPk)) {
            $model = CmsinspreqdocdtlsTbl::find()->where("cmsinspreqdocdtls_pk =:pk", [':pk' => $dataPk])->one();
            $model->cirdd_status = 2;
            if ($model->save() === TRUE) {
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

    public function getActivityNoArray() {
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $query = [];
        $module = [];
        if (!empty($compPk)) {
            $query = CmsinspreqdocdtlsTbl::find()
                    ->select(['cmsinspreqdocdtls_pk', 'cirdd_cmsinspreqdochdr_fk', 'cirdd_activityno', 'cirdd_activitytitle'])
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = cirdd_createdby')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->where("MemberCompMst_Pk=:compPk", [':compPk' => $compPk])
                    ->groupBy('cirdd_activityno')
                    ->orderBy(['cirdd_activityno' => SORT_ASC])
                    ->asArray()
                    ->all();
        }
        if (!empty($compPk)) {
            $module = CmsinspreqdocdtlsTbl::find()
                    ->select(['cmsinspreqdocdtls_pk', 'cirdd_cmsinspreqdochdr_fk', 'cirdd_refdoc'])
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = cirdd_createdby')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->where("MemberCompMst_Pk=:compPk", [':compPk' => $compPk])
                    ->groupBy('cirdd_refdoc')
                    ->orderBy(['cirdd_refdoc' => SORT_ASC])
                    ->asArray()
                    ->all();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'activityNoArray' => $query,
            'refNumArray' => $module,
        );
        return $result;
    }

}
