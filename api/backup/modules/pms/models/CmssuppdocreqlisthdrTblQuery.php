<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmssuppdocreqlisthdrTbl]].
 *
 * @see CmssuppdocreqlisthdrTbl
 */
class CmssuppdocreqlisthdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function submitSupplierDocument($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (empty($formdata['headerPk']) && $formdata['headerPk'] == null) {
                $model = new CmssuppdocreqlisthdrTbl;
                $model->csdrlh_createdon = $date;
                $model->csdrlh_createdby = $userPK;
                $model->csdrlh_createdbyipaddr = $ip_address;
                $model->csdrlh_status = 1;
                $model->csdrlh_cmstnchdr_fk = $formdata['dynmicPk'];
                $model->csdrlh_shared_fk = $formdata['sharedFk'];
                $model->csdrlh_shared_type = $formdata['formType'];
                $model->csdrlh_sdrlrefno = $formdata['ref_num'];
                $model->csdrlh_sdrldate = $formdata['date'];
                $model->csdrlh_sdrlusermst_fk = $formdata['issuedBy'];
                if ($model->save() === TRUE) {
                    $result = CmssuppdocreqlistdtlsTblQuery::submitSupplierDocument($formdata, $model->cmssuppdocreqlisthdr_pk);
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
                $result = CmssuppdocreqlistdtlsTblQuery::submitSupplierDocument($formdata, $formdata['headerPk']);
            }
            return $result;
        }
    }

    public function getSupplierDocumentList($sharedFk, $exSharedFk, $dataType, $exFormType, $formType) {
        if (!empty($sharedFk)) {
            $query = self::searchDynamicData($sharedFk, $dataType, $formType, 1);
            if (empty($query) && !empty($exSharedFk)) {
                $query = self::searchDynamicData($sharedFk, $dataType, $formType, 2);
                if (empty($query)) {
                    $query = self::searchDynamicData($exSharedFk, $dataType, $exFormType, 1);
                    if (!empty($query)) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                        $model = new CmssuppdocreqlisthdrTbl;
                        $model->csdrlh_createdon = $date;
                        $model->csdrlh_createdby = $userPK;
                        $model->csdrlh_createdbyipaddr = $ip_address;
                        $model->csdrlh_status = 1;
                        $model->csdrlh_cmstnchdr_fk = $query[0]['dynmicPk'];
                        $model->csdrlh_shared_fk = $sharedFk;
                        $model->csdrlh_shared_type = $formType;
                        $model->csdrlh_sdrlrefno = $query[0]['ref_num'];
                        $model->csdrlh_sdrldate = $query[0]['date'];
                        $model->csdrlh_sdrlusermst_fk = $query[0]['issuedBy'];
                        if ($model->save() === TRUE) {
                            foreach ($query as $kay => $dataVal) {
                                $result = CmssuppdocreqlistdtlsTblQuery::autoCreatDocument($dataVal, $model->cmssuppdocreqlisthdr_pk);
                            }
                            $query = self::searchDynamicData($sharedFk, $dataType, $formType, 1);
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
            $result = array(
                'status' => 200,
                'msg' => 'Success',
                'flag' => 'S',
                'returndata' => $query
            );
            return $result;
        }
    }

    public function searchDynamicData($sharedFk, $dataType, $sharedType, $type) {

        if ($type == 1) {
            $query = CmssuppdocreqlisthdrTbl::find()
                    ->select(['cmssuppdocreqlisthdr_pk as headerPk', 'csdrlh_cmstnchdr_fk as dynmicPk', 'csdrlh_shared_fk as sharedFk', 'csdrlh_sdrlrefno as ref_num', 'csdrlh_sdrldate as date', 'csdrlh_sdrlusermst_fk as issuedBy', 'um_firstname as userName', 'csdrlh_createdon', 'csdrlh_updatedon', 'cmssuppdocreqlistdtls_pk', 'csdrld_submittaltype', 'csdrld_submittalqty', 'csdrld_interval', 'csdrld_intervaltype', 'csdrld_reviewclass', 'csdrld_remarks', 'csdrld_createdon', 'csdrld_updatedon', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc', 'csdrld_cmssdrldoccat_fk'])
                    ->leftJoin('cmssuppdocreqlistdtls_tbl', 'csdrld_cmssuppdocreqlisthdr_fk = cmssuppdocreqlisthdr_pk and csdrld_status = 1')
                    ->leftJoin('cmssdrldoccat_tbl', 'cmssdrldoccat_pk = csdrld_cmssdrldoccat_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = csdrlh_sdrlusermst_fk')
                    ->where("csdrlh_cmstnchdr_fk =:dataType and csdrlh_shared_fk = :sharedFk and csdrlh_shared_type = :sharedType and csdrlh_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                    ->orderBy([new \yii\db\Expression("coalesce(csdrld_createdon,csdrld_updatedon) DESC")])
                    ->asArray()
                    ->all();
        } else {
            $query = CmssuppdocreqlisthdrTbl::find()
                    ->select(['cmssuppdocreqlisthdr_pk as headerPk', 'csdrlh_cmstnchdr_fk as dynmicPk', 'csdrlh_shared_fk as sharedFk', 'csdrlh_sdrlrefno as ref_num', 'csdrlh_sdrldate as date', 'csdrlh_sdrlusermst_fk as issuedBy', 'um_firstname as userName', 'csdrlh_createdon', 'csdrlh_updatedon', 'cmssuppdocreqlistdtls_pk', 'csdrld_submittaltype', 'csdrld_submittalqty', 'csdrld_interval', 'csdrld_intervaltype', 'csdrld_reviewclass', 'csdrld_remarks', 'csdrld_createdon', 'csdrld_updatedon', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc', 'csdrld_cmssdrldoccat_fk'])
                    ->leftJoin('cmssuppdocreqlistdtls_tbl', 'csdrld_cmssuppdocreqlisthdr_fk = cmssuppdocreqlisthdr_pk and csdrld_status = 2')
                    ->leftJoin('cmssdrldoccat_tbl', 'cmssdrldoccat_pk = csdrld_cmssdrldoccat_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = csdrlh_sdrlusermst_fk')
                    ->where("csdrlh_cmstnchdr_fk=:dataType and csdrlh_shared_fk = :sharedFk and csdrlh_shared_type = :sharedType and csdrlh_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                    ->orderBy([new \yii\db\Expression("coalesce(csdrld_createdon,csdrld_updatedon) DESC")])
                    ->asArray()
                    ->all();
        }
        return $query;
    }

    public function getSupplierDocumentViewList($sharedFk, $dataType, $sharedType) {
        $query = CmssuppdocreqlisthdrTbl::find()
                ->select(['cmssuppdocreqlisthdr_pk as headerPk', 'csdrlh_cmstnchdr_fk as dynmicPk', 'csdrlh_shared_fk as sharedFk', 'csdrlh_sdrlrefno as ref_num', 'csdrlh_sdrldate as date', 'csdrlh_sdrlusermst_fk as issuedBy', 'um_firstname as userName', 'csdrlh_createdon', 'csdrlh_updatedon', 'cmssuppdocreqlistdtls_pk', 'csdrld_submittaltype', 'csdrld_submittalqty', 'csdrld_interval', 'csdrld_intervaltype', 'csdrld_reviewclass', 'csdrld_remarks', 'csdrld_createdon', 'csdrld_updatedon', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc', 'csdrld_cmssdrldoccat_fk'])
                ->leftJoin('cmssuppdocreqlistdtls_tbl', 'csdrld_cmssuppdocreqlisthdr_fk = cmssuppdocreqlisthdr_pk and csdrld_status = 1')
                ->leftJoin('cmssdrldoccat_tbl', 'cmssdrldoccat_pk = csdrld_cmssdrldoccat_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk = csdrlh_sdrlusermst_fk')
                ->where("csdrlh_cmstnchdr_fk =:dataType and csdrlh_shared_fk = :sharedFk and csdrlh_shared_type = :sharedType and csdrlh_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                ->orderBy([new \yii\db\Expression("coalesce(csdrld_createdon,csdrld_updatedon) DESC")])
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $query ? $query : []
        );
        return $result;
    }

}
