<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsinspreqdochdrTbl]].
 *
 * @see CmsinspreqdochdrTbl
 */
class CmsinspreqdochdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function updateInspectionReq($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($formdata['headerPk']) && $formdata['headerPk'] != null) {
                $model = CmsinspreqdochdrTbl::find()->where("cmsinspreqdochdr_pk =:pk and cirdh_shared_fk = :sharedFk", [':pk' => $formdata['headerPk'], ':sharedFk' => $formdata['sharedFk']])->one();
                $flag = 'U';
                $comments = 'Updated Successfully!';
                $model->cirdh_updatedon = $date;
                $model->cirdh_updatedby = $userPK;
                $model->cirdh_updatedbyipaddr = $ip_address;
                $model->cirdh_technote = $formdata['techNotes'];
                $model->cirdh_generalnote = $formdata['generalNotes'];
                $model->cirdh_applspec = $formdata['appSpecifications'];
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments,
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
            }
            return $result;
        }
    }

    public function saveInspectionReq($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (empty($formdata['headerPk']) && $formdata['headerPk'] == null) {
                $model = new CmsinspreqdochdrTbl;
                $model->cirdh_createdon = $date;
                $model->cirdh_createdby = $userPK;
                $model->cirdh_createdbyipaddr = $ip_address;
                $model->cirdh_status = 1;
                $model->cirdh_cmstnchdr_fk = $formdata['dynmicPk'];
                $model->cirdh_shared_fk = $formdata['sharedFk'];
                $model->cirdh_shared_type = $formdata['formType'];
                $model->cirdh_itprefno = $formdata['itp_ref_num'];
                $model->cirdh_itpdate = $formdata['itp_date'];
                $model->cirdh_itpusermst_fk = $formdata['itp_issuedBy'];
                $model->cirdh_technote = $formdata['techNotes'];
                $model->cirdh_generalnote = $formdata['generalNotes'];
                $model->cirdh_applspec = $formdata['appSpecifications'];
                $flag = 'S';
                $comments = 'Created Successfully!';
                if ($model->save() === TRUE) {
                    if (empty($formdata['dtlsPk']) && $formdata['dtlsPk'] == null) {
                        $result = CmsinspreqdocdtlsTblQuery::saveInspectionReq($formdata, $model->cmsinspreqdochdr_pk);
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
            } else {
                $result = CmsinspreqdocdtlsTblQuery::saveInspectionReq($formdata, $formdata['headerPk']);
            }
            return $result;
        }
    }

    public function getInspectionRequirenmentList($sharedFk, $exSharedFk, $dataType, $exFormType, $formType) {
        if (!empty($sharedFk)) {
            $query = self::getInspReqData($sharedFk, $dataType, $formType, 1);
            if (empty($query) && !empty($exSharedFk)) {
                $query = self::getInspReqData($sharedFk, $dataType, $formType, 2);
                if (empty($query)) {
                    $query = self::getInspReqData($exSharedFk, $dataType, $exFormType, 1);
                    if (!empty($query)) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                        $model = new CmsinspreqdochdrTbl;
                        $model->cirdh_createdon = $date;
                        $model->cirdh_createdby = $userPK;
                        $model->cirdh_createdbyipaddr = $ip_address;
                        $model->cirdh_status = 1;
                        $model->cirdh_cmstnchdr_fk = $dataType;
                        $model->cirdh_shared_fk = $sharedFk;
                        $model->cirdh_shared_type = $formType;
                        $model->cirdh_itprefno = $query[0]['itp_ref_num'];
                        $model->cirdh_itpdate = $query[0]['itp_date'];
                        $model->cirdh_itpusermst_fk = $query[0]['itp_issuedBy'];
                        $model->cirdh_technote = $query[0]['cirdh_technote'];
                        $model->cirdh_generalnote = $query[0]['cirdh_generalnote'];
                        $model->cirdh_applspec = $query[0]['cirdh_generalnote'];
                        if ($model->save() === TRUE) {
                            foreach ($query as $kay => $dataVal) {
                                $result = CmsinspreqdocdtlsTblQuery::autoCreatInspectionReq($formdata, $model->cmsinspreqdochdr_pk);
                            }
                            $query = self::getInspReqData($sharedFk, $dataType, $formType, 1);
                        } else {
                            $result = array(
                                'status' => 200,
                                'msg' => 'warning',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'returndata' => $model->getErrors()
                            );
                        }
                    }
                } else {
                    $query = [];
                }
            }
            $finallData = [];
            if ($query) {
                foreach ($query as $key => $item) {
                    if (!empty($item['dtlsPk']) && $item['dtlsPk'] != null) {
                        $item['quontumChkArray'] = CmsinspreqdocactionmapTblQuery::getMapData($item['dtlsPk']);
                    }
                    $finallData[] = $item;
                }
            }
            $result = array(
                'status' => 200,
                'msg' => 'Success',
                'flag' => 'S',
                'returndata' => $finallData
            );
            return $result;
        }
    }

    public function getInspReqData($sharedFk, $dataType, $sharedType, $type) {

        if ($type == 1) {
            $query = CmsinspreqdochdrTbl::find()
                    ->select(['cmsinspreqdochdr_pk as headerPk', 'cirdh_cmstnchdr_fk as dynmicPk', 'cirdh_shared_fk as sharedFk', 'cirdh_itprefno as itp_ref_num', 'cirdh_itpdate as itp_date', 'cirdh_itpusermst_fk as itp_issuedBy', 'um_firstname as userName', 'cirdh_technote', 'cirdh_generalnote', 'cirdh_applspec', 'cirdh_createdon', 'cirdh_updatedon', 'cmsinspreqdocdtls_pk as dtlsPk', 'cirdd_activityno', 'cirdd_activitytitle', 'cirdd_refdoc', 'cirdd_remarks', 'cirdd_status', 'cirdd_createdon', 'cirdd_updatedon'])
                    ->leftJoin('cmsinspreqdocdtls_tbl', 'cirdd_cmsinspreqdochdr_fk = cmsinspreqdochdr_pk and cirdd_status = 1')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = cirdh_itpusermst_fk')
                    ->where("cirdh_cmstnchdr_fk=:dataType and cirdh_shared_fk = :sharedFk and cirdh_shared_type =:sharedType and cirdh_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                    ->orderBy([new \yii\db\Expression("coalesce(cirdd_createdon,cirdd_updatedon) DESC")])
                    ->asArray()
                    ->all();
        } else {
            $query = CmsinspreqdochdrTbl::find()
                    ->select(['cmsinspreqdochdr_pk as headerPk', 'cirdh_cmstnchdr_fk as dynmicPk', 'cirdh_shared_fk as sharedFk', 'cirdh_itprefno as itp_ref_num', 'cirdh_itpdate as itp_date', 'cirdh_itpusermst_fk as itp_issuedBy', 'um_firstname as userName', 'cirdh_technote', 'cirdh_generalnote', 'cirdh_applspec', 'cirdh_createdon', 'cirdh_updatedon', 'cmsinspreqdocdtls_pk as dtlsPk', 'cirdd_activityno', 'cirdd_activitytitle', 'cirdd_refdoc', 'cirdd_remarks', 'cirdd_status', 'cirdd_createdon', 'cirdd_updatedon'])
                    ->leftJoin('cmsinspreqdocdtls_tbl', 'cirdd_cmsinspreqdochdr_fk = cmsinspreqdochdr_pk and cirdd_status = 2')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = cirdh_itpusermst_fk')
                    ->where("cirdh_cmstnchdr_fk=:dataType and cirdh_shared_fk = :sharedFk and cirdh_shared_type =:sharedType and cirdh_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                    ->orderBy([new \yii\db\Expression("coalesce(cirdd_createdon,cirdd_updatedon) DESC")])
                    ->asArray()
                    ->all();
        }
        return $query;
    }

    public function getInspectionRequirenmentViewList($sharedFk, $dataType, $sharedType) {
        $query = CmsinspreqdochdrTbl::find()
                ->select(['cmsinspreqdochdr_pk as headerPk', 'cirdh_cmstnchdr_fk as dynmicPk', 'cirdh_shared_fk as sharedFk', 'cirdh_itprefno as itp_ref_num', 'cirdh_itpdate as itp_date', 'cirdh_itpusermst_fk as itp_issuedBy', 'um_firstname as userName', 'cirdh_technote', 'cirdh_generalnote', 'cirdh_applspec', 'cirdh_createdon', 'cirdh_updatedon', 'cmsinspreqdocdtls_pk as dtlsPk', 'cirdd_activityno', 'cirdd_activitytitle', 'cirdd_refdoc', 'cirdd_remarks', 'cirdd_status', 'cirdd_createdon', 'cirdd_updatedon'])
                ->leftJoin('cmsinspreqdocdtls_tbl', 'cirdd_cmsinspreqdochdr_fk = cmsinspreqdochdr_pk and cirdd_status = 1')
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cirdh_itpusermst_fk')
                ->where("cirdh_cmstnchdr_fk=:dataType and cirdh_shared_fk = :sharedFk and cirdh_shared_type =:sharedType and cirdd_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                ->orderBy([new \yii\db\Expression("coalesce(cirdd_createdon,cirdd_updatedon) DESC")])
                ->asArray()
                ->all();
        $finallData = [];
        if ($query) {
            foreach ($query as $key => $item) {
                if (!empty($item['dtlsPk']) && $item['dtlsPk'] != null) {
                    $item['quontumChkArray'] = CmsinspreqdocactionmapTblQuery::getMapData($item['dtlsPk']);
                }
                $finallData[] = $item;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $finallData ? $finallData : []
        );
        return $result;
    }

}
