<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmssuppdocreqlisthdrtempTbl]].
 *
 * @see CmssuppdocreqlisthdrtempTbl
 */
class CmssuppdocreqlisthdrtempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function submitSupplierDocumenttemp($formdata) {
        if (!empty($formdata)) {
        $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (empty($formdata['headerPk']) && $formdata['headerPk'] == null) {
                $model = new CmssuppdocreqlisthdrtempTbl;
                $comments = 'Created Successfully!';
                $model->csdrlht_createdon = $date;
                $model->csdrlht_createdby = $userPK;
                $model->csdrlht_createdbyipaddr = $ip_address;
                $model->csdrlht_status = 1;
                $model->csdrlht_cmstnchdr_fk = $formdata['dynmicPk'];
                $model->csdrlht_shared_fk = $formdata['sharedFk'];
                $model->csdrlht_shared_type = $formdata['formType'];
                $model->csdrlht_sdrlrefno = $formdata['ref_num'];
                $model->csdrlht_sdrldate = $formdata['date'];
                $model->csdrlht_sdrlusermst_fk = $formdata['issuedBy'];
                if ($model->save() === TRUE) {
                    $result = CmssuppdocreqlistdtlstempTblQuery::submitSupplierDocumenttemp($formdata, $model->cmssuppdocreqlisthdrtemp_pk);
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
                $result = CmssuppdocreqlistdtlstempTblQuery::submitSupplierDocumenttemp($formdata, $formdata['headerPk']);
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
                        $model = new CmssuppdocreqlisthdrtempTbl;
                        $model->csdrlht_createdon = $date;
                        $model->csdrlht_createdby = $userPK;
                        $model->csdrlht_createdbyipaddr = $ip_address;
                        $model->csdrlht_status = 1;
                        $model->csdrlht_cmstnchdr_fk = $query[0]['dynmicPk'];
                        $model->csdrlht_shared_fk = $sharedFk;
                        $model->csdrlht_shared_type = $formType;
                        $model->csdrlht_sdrlrefno = $query[0]['ref_num'];
                        $model->csdrlht_sdrldate = $query[0]['date'];
                        $model->csdrlht_sdrlusermst_fk = $query[0]['issuedBy'];
                        if ($model->save() === TRUE) {
                            foreach ($query as $kay => $dataVal) {
                                $result = CmssuppdocreqlistdtlstempTblQuery::autoCreatDocument($dataVal, $model->cmssuppdocreqlisthdr_pk);
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
                    ->select(['cmssuppdocreqlisthdr_pk as headerPk', 'csdrlht_cmstnchdr_fk as dynmicPk', 'csdrlht_shared_fk as sharedFk', 'csdrlht_sdrlrefno as ref_num', 'csdrlht_sdrldate as date', 'csdrlht_sdrlusermst_fk as issuedBy', 'um_firstname as userName', 'csdrlht_createdon', 'csdrlht_updatedon', 'cmssuppdocreqlistdtlstemp_pk', 'csdrldt_submittaltype', 'csdrldt_submittalqty', 'csdrldt_interval', 'csdrldt_intervaltype', 'csdrldt_reviewclass', 'csdrldt_remarks', 'csdrldt_createdon', 'csdrldt_updatedon', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc', 'csdrldt_cmssdrldoccat_fk'])
                    ->leftJoin('cmssuppdocreqlistdtls_tbl', 'csdrldt_cmssuppdocreqlisthdr_fk = cmssuppdocreqlisthdr_pk and csdrldt_status = 1')
                    ->leftJoin('cmssdrldoccat_tbl', 'cmssdrldoccat_pk = csdrldt_cmssdrldoccat_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = csdrlht_sdrlusermst_fk')
                    ->where("csdrlht_cmstnchdr_fk =:dataType and csdrlht_shared_fk = :sharedFk and csdrlht_shared_type = :sharedType and csdrlht_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                    ->orderBy([new \yii\db\Expression("coalesce(csdrldt_createdon,csdrldt_updatedon) DESC")])
                    ->asArray()
                    ->all();
        } else {
            $query = CmssuppdocreqlisthdrTbl::find()
                    ->select(['cmssuppdocreqlisthdr_pk as headerPk', 'csdrlht_cmstnchdr_fk as dynmicPk', 'csdrlht_shared_fk as sharedFk', 'csdrlht_sdrlrefno as ref_num', 'csdrlht_sdrldate as date', 'csdrlht_sdrlusermst_fk as issuedBy', 'um_firstname as userName', 'csdrlht_createdon', 'csdrlht_updatedon', 'cmssuppdocreqlistdtlstemp_pk', 'csdrldt_submittaltype', 'csdrldt_submittalqty', 'csdrldt_interval', 'csdrldt_intervaltype', 'csdrldt_reviewclass', 'csdrldt_remarks', 'csdrldt_createdon', 'csdrldt_updatedon', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc', 'csdrldt_cmssdrldoccat_fk'])
                    ->leftJoin('cmssuppdocreqlistdtls_tbl', 'csdrldt_cmssuppdocreqlisthdr_fk = cmssuppdocreqlisthdr_pk and csdrldt_status = 2')
                    ->leftJoin('cmssdrldoccat_tbl', 'cmssdrldoccat_pk = csdrldt_cmssdrldoccat_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = csdrlht_sdrlusermst_fk')
                    ->where("csdrlht_cmstnchdr_fk=:dataType and csdrlht_shared_fk = :sharedFk and csdrlht_shared_type = :sharedType and csdrlht_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
                    ->orderBy([new \yii\db\Expression("coalesce(csdrldt_createdon,csdrldt_updatedon) DESC")])
                    ->asArray()
                    ->all();
        }
        return $query;
    }

    public function getSupplierDocumentViewListtemp($sharedFk, $dataType, $sharedType) {
        $query = CmssuppdocreqlisthdrtempTbl::find()
            ->select(['cmssuppdocreqlisthdrtemp_pk as headerPk', 'csdrlht_cmstnchdr_fk as dynmicPk', 'csdrlht_shared_fk as sharedFk', 'csdrlht_sdrlrefno as ref_num', 'csdrlht_sdrldate as date', 'csdrlht_sdrlusermst_fk as issuedBy', 'um_firstname as userName', 'csdrlht_createdon', 'csdrlht_updatedon', 'cmssuppdocreqlistdtlstemp_pk', 'csdrldt_submittaltype', 'csdrldt_submittalqty', 'csdrldt_interval', 'csdrldt_intervaltype', 'csdrldt_reviewclass', 'csdrldt_remarks', 'csdrldt_createdon', 'csdrldt_updatedon', 'csdrldct_doccategory', 
            'csdrldct_doccode', 'csdrldct_docdesc', 'csdrldt_cmssdrldoccat_fk'])
            ->leftJoin('cmssuppdocreqlistdtlstemp_tbl', 'csdrldt_cmssuppdocreqlisthdrtemp_fk = cmssuppdocreqlisthdrtemp_pk ')
            ->leftJoin('cmssdrldoccattemp_tbl', 'cmssdrldoccattemp_pk = csdrldt_cmssdrldoccat_fk')
            ->leftJoin('usermst_tbl', 'UserMst_Pk = csdrlht_sdrlusermst_fk')
            ->where("csdrlht_cmstnchdr_fk =:dataType and csdrlht_shared_fk = :sharedFk and csdrlht_shared_type = :sharedType and csdrlht_status = 1 and csdrldt_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
            ->orderBy([new \yii\db\Expression("coalesce(csdrldt_createdon,csdrldt_updatedon) DESC")])
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
