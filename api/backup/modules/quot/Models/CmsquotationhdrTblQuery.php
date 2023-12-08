<?php

namespace api\modules\quot\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use api\modules\pms\models\CmstenderpsmapTbl;
use api\modules\pms\models\CmstenderpschargesTbl;
use api\modules\pms\models\CmstenderagreehdrTbl;
use api\modules\pms\models\CmsquestionnaireformtrnxTbl;
use api\modules\pms\models\CmstenderhdrTbl;
use api\modules\pms\models\CmstenderhdrtempTbl;
use api\modules\pms\models\CmstenderresponseTbl;
use api\modules\pms\models\CmstenderresponseevalhstyTbl;

/**
 * This is the ActiveQuery class for [[CmsquotationhdrTbl]].
 *
 * @see CmsquotationhdrTbl
 */
class CmsquotationhdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsquotationhdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquotationhdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    /**
     * Get Quotation Details
     */
    public static function getFormData($dataPk, $currentPK) {
        if (empty($currentPK)) {
            $model = CmstenderhdrTbl::find()
                    ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'cmsth_type', 'cmsth_title', 'cmsth_uid', 'cmsth_refno', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqprocesstype', 'crfd_rqtype', 'crfd_rqdate', 'crfd_rqpriority', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prsm_projstage', 'cmsth_skdclosedate', 'cmsth_initiateddate', 'cmsth_tenderstatus', 'cmsth_issubcontrqmt', 'cmsth_obligation', 'cmsth_msmepercent', 'cmsth_lccpercent', 'cmsth_isetendmandate', 'mcm_complogo_memcompfiledtlsfk', 'MCM_CompanyName', 'cmsth_memcompmst_fk', 'mrm_createdby', 'cmsth_closeintvl', 'cmsth_closeintvltype', 'crfd_rqtitle', 'cmsth_isicv as icvStatus', 'tz_countryname','tz_utcoffset','cmsquestionnaireform_pk','cmsqf_cmsquestionnaireformtemp_fk','cmsqf_type','cmsqf_formname','cmsqf_formdesc','cmsqf_buildertemplate','cmsqf_formtype'])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                    ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = cmsth_cmsquestionnaireform_fk')
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                    ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                    ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                    ->leftJoin('timezone_tbl', 'timezone_pk = cmsth_skd_timezone_fk')
                    ->where('cmstenderhdr_pk=:dataPK', array(':dataPK' => $dataPk))
                    ->asArray()
                    ->one();
        } else {
            $model = CmsquotationhdrTbl::find()
                    ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'cmsth_type', 'cmsth_title', 'cmsth_uid', 'cmsth_refno', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqprocesstype', 'crfd_rqtype', 'crfd_rqdate', 'crfd_rqpriority', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prsm_projstage', 'cmsth_skdclosedate', 'cmsth_initiateddate', 'cmsth_tenderstatus', 'cmsth_issubcontrqmt', 'cmsth_obligation', 'cmsth_msmepercent', 'cmsth_lccpercent', 'cmsth_isetendmandate', 'mcm_complogo_memcompfiledtlsfk', 'MCM_CompanyName', 'cmsth_memcompmst_fk', 'mrm_createdby', 'cmsquotationhdr_pk', 'cmsqh_uid', 'cmsqh_quotationtitle', 'cmsqh_quotationrefno', 'um_firstname as initiatedUser', 'UM_EmpId as initiatedEmpId', 'cmsqh_initiatedby', 'cmsqh_secondary_memcompmst_fk', 'cmsqh_initiateddate', 'cmsqh_scopedesc', 'cmsqh_scope_currencymst_fk', 'cmsqh_suppdocremark', 'cmsqh_contact_usermst_fk', 'cmsqh_deviationcomment', 'cmsth_closeintvl', 'cmsth_closeintvltype', 'cmsqh_invoiceinterval', 'cmsqh_invoiceintervaltype', 'cmsqh_bidtncintervaltype', 'cmsqh_bidtncinterval', 'cmsqh_bidtncdate', 'crfd_rqtitle', 'cmsth_isicv as icvStatus', 'tz_countryname','tz_utcoffset','cmsquestionnaireform_pk','cmsqf_cmsquestionnaireformtemp_fk','cmsqf_type','cmsqf_formname','cmsqf_formdesc','cmsqf_buildertemplate','cmsqf_formtype'])
                    ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_pk = cmsqh_cmstenderhdr_fk')
                    ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = cmsth_cmsquestionnaireform_fk')
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                    ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsth_memcompmst_fk')
                    ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsqh_initiatedby')
                    ->leftJoin('timezone_tbl', 'timezone_pk = cmsth_skd_timezone_fk')
                    ->where('cmsquotationhdr_pk=:dataPK', array(':dataPK' => $currentPK))
                    ->asArray()
                    ->one();
        }
        if ($model['mcm_complogo_memcompfiledtlsfk'] != null) {
            $model['imgUrl'] = Drive::generateUrl($model['mcm_complogo_memcompfiledtlsfk'], $model['cmsth_memcompmst_fk'], $model['mrm_createdby']);
        } else {
            $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        }
        if ($model['cmsth_skdclosedate'] != null && $model['tz_utcoffset'] != null) {
            $date = new \DateTime();
            $timeZone = $date->getTimezone();
            $timeZone->getName();
            $model['timeZone'] = Common::convertTimezone($model['cmsth_skdclosedate'], $model['tz_utcoffset'], $timeZone->getName());
        } else {
            $model['timeZone'] = null;
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    /**
     * Get Quotation View Details
     */
    public static function getFormViewData($currentPK) {
        $model = CmsquotationhdrTbl::find()
                ->select(['cmstenderhdr_pk', 'cmsth_cmsrequisitionformdtls_fk', 'cmsqh_memcompmst_fk', 'cmsth_type', 'cmsth_title', 'cmsqh_status', 'cmsth_uid', 'cmsth_refno', 'crfd_rqid', 'crfd_rqrefno', 'crfd_tenderstatus', 'crfd_rqprocesstype', 'crfd_rqtype', 'crfd_rqdate', 'crfd_rqpriority', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prsm_projstage', 'cmsth_skdclosedate', 'cmsth_initiateddate', 'cmsth_tenderstatus', 'cmsth_issubcontrqmt', 'cmsth_obligation', 'cmsth_msmepercent', 'cmsth_lccpercent', 'cmsth_isetendmandate', 'MCM_CompanyName', 'cmsth_memcompmst_fk', 'mrm_createdby', 'cmsquotationhdr_pk', 'cmsqh_uid', 'cmsqh_quotationtitle', 'cmsqh_quotationrefno', 'um_firstname as initiatedUser', 'UM_EmpId as initiatedEmpId', 'cmsqh_initiatedby', 'cmsqh_secondary_memcompmst_fk', 'cmsqh_initiateddate', 'cmsqh_scopedesc', 'cmsqh_scope_currencymst_fk', 'cmsqh_suppdocremark', 'cmsqh_contact_usermst_fk', 'cmsqh_deviationcomment', 'cmsth_closeintvl', 'cmsth_closeintvltype', 'cmsqh_invoiceinterval', 'cmsqh_invoiceintervaltype', 'cmsqh_bidtncintervaltype', 'cmsqh_bidtncinterval', 'cmsqh_bidtncdate', 'prjd_projimg_fk', 'prjd_submittedby', 'CurM_CurrencyName_en', 'CurM_CurrSymbol', 'cmsqh_createdon', 'cmsqh_updatedon', 'cmsqh_updatedby', 'cmsqh_createdby', 'cmsth_isicv as icvStatus', 'crfd_rqtitle', 'tz_countryname','cmsqf_formname','cmsqf_buildertemplate','cmsqft_answer', 'cmstenderresponse_pk', 'ctr_status'])
                ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_pk = cmsqh_cmstenderhdr_fk')
                ->leftJoin('cmstenderresponse_tbl', 'ctr_memcompmst_fk = cmsqh_memcompmst_fk and ctr_cmstenderhdr_fk = cmsqh_cmstenderhdr_fk')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
                ->leftJoin('cmsquestionnaireform_tbl', 'cmsquestionnaireform_pk = cmsth_cmsquestionnaireform_fk')
                ->leftJoin('cmsquestionnaireformtrnx_tbl', 'cmsth_cmsquestionnaireform_fk = cmsqft_cmsquestionnaireform_fk')
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = prjd_projimg_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk = cmsqh_scope_currencymst_fk')
                ->leftJoin('timezone_tbl', 'timezone_pk = cmsth_skd_timezone_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsqh_initiatedby')
                ->where('cmsquotationhdr_pk=:dataPK', array(':dataPK' => $currentPK))
                ->asArray()
                ->one();
        if ($model['prjd_projimg_fk'] != null && $model['prjd_projimg_fk'] != 0) {
            $model['imgUrl'] = Drive::generateUrl($model['prjd_projimg_fk'], $model['cmsth_memcompmst_fk'], $model['prjd_submittedby']);
        } else {
            $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    /**
     * Save quotation detail
     */
    public function saveDetail($data) {
        if (!empty($data)) {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $lable = '';
            if ($data['dataType'] == 5) {
                $lable = 'Quotation';
            } elseif ($data['dataType'] == 6) {
                $lable = 'Offer';
            } elseif ($data['dataType'] == 4) {
                $lable = 'Proposal';
            }
            if (!empty($data['currentPk']) && $data['currentPk'] != null) {
                $model = CmsquotationhdrTbl::find()->where("cmsquotationhdr_pk =:pk", [':pk' => $data['currentPk']])->one();
                $comments = $lable . ' Information Updated Successfully';
                $flag = 'U';
            } else {
                $model = new CmsquotationhdrTbl;
                $flag = 'C';
                $comments = $lable . ' Information Added Successfully';
                if ($data['dataType'] == 5) {
                    $model->cmsqh_uid = Common::getUniqueId('Quotation');
                    $model->cmsqh_type = 1;
                } elseif ($data['dataType'] == 6) {
                    $model->cmsqh_uid = Common::getUniqueId('Offer');
                    $model->cmsqh_type = 2;
                } elseif ($data['dataType'] == 4) {
                    $model->cmsqh_uid = Common::getUniqueId('Proposal');
                    $model->cmsqh_type = 3;
                }
                $model->cmsqh_status = 1;
                $model->cmsqh_memcompmst_fk = $compPK;
                $model->cmsqh_cmstenderhdr_fk = $data['dataPk'];
            }
            $model->cmsqh_quotationtitle = $data['qd_title'];
            $model->cmsqh_quotationrefno = $data['qd_ref'];
            $model->cmsqh_initiatedby = $data['qd_initiate'];
            $model->cmsqh_initiateddate = $data['backendDate'];
            $model->cmsqh_secondary_memcompmst_fk = $data['secondaryPk'];
            $model->cmsqh_status = 1;
            $tender = CmstenderhdrTbl::findOne($data['dataPk']);
            $quotno = $tender->getCmsquotationhdrTbls()->count();
            if ($model->save() === TRUE) {
                if ($flag == 'C') {
                }

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => $comments,
                    'moduleData' => self::getFormData($formdata['dataPk'], $model->cmsquotationhdr_pk),
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

    /**
     * Chk quotation Ref detail
     */
    public function chkValidRefNumber($data) {
        if (!empty($data)) {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            if ($data['dataType'] == 5) {
                $dataType = 1;
            } elseif ($data['dataType'] == 6) {
                $dataType = 2;
            } else {
                $dataType = 3;
            }
            $model = CmsquotationhdrTbl::find()
                    ->select(['cmsquotationhdr_pk', 'cmsqh_quotationtitle'])
                    ->where("cmsqh_memcompmst_fk =:compPK and cmsqh_quotationrefno = :dataTitle and cmsqh_type = :dataType and cmsqh_isdeleted = 2", [':compPK' => $compPK, ':dataTitle' => $data['dataValue'], ':dataType' => $dataType])
                    ->andWhere(['<>', 'cmsquotationhdr_pk', $data['currentPk']])
                    ->asArray()
                    ->all();
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'moduleData' => $model ? $model : [],
            );
        }
        return $result;
    }

    /**
     * Data Final Save
     */
    public function dataFinalSave($currentPk) {
        if (!empty($currentPk)) {
            $model = CmsquotationhdrTbl::find()->where("cmsquotationhdr_pk =:pk", [':pk' => $currentPk])->one();
            if ($model) {
                $ip_address = Common::getIpAddress();
                $date = date('Y-m-d H:i:s');
                $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
                $lable = '';
                if ($model->cmsqh_type == 1) {
                    $lable = 'Quotation';
                } elseif ($model->cmsqh_type == 2) {
                    $lable = 'Offer';
                } elseif ($model->cmsqh_type == 3) {
                    $lable = 'Proposal';
                }
                if ($model->cmsqh_createdon != null) {
                    $comments = $lable . ' Updated Successfully';
                    $flag = 'U';
                    $model->cmsqh_updatedon = $date;
                    $model->cmsqh_updatedby = $userPK;
                    $model->cmsqh_updatedbyipaddr = $ip_address;
                } else {
                    $comments = $lable . ' Submitted Successfully';
                    $flag = 'C';
                    $model->cmsqh_createdon = $date;
                    $model->cmsqh_createdby = $userPK;
                    $model->cmsqh_createdbyipaddr = $ip_address;
                }
                $model->cmsqh_status = 2;
                if ($model->save() == TRUE) {
                    $tender = $model->cmstenderhdrtbl;
                    $tenderResponse = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $model->cmsqh_cmstenderhdr_fk, 'ctr_memcompmst_fk' => $compPK])->one();
                    if(!$tenderResponse) {
                        $tenderResponse = new CmstenderresponseTbl();
                        $tenderResponse->ctr_createdon = $date;
                        $tenderResponse->ctr_createdby = $userPK;
                        $tenderResponse->ctr_createdbyipaddr = $ip_address;
                    } else {
                        $tenderResponse->ctr_updatedon = $date;
                        $tenderResponse->ctr_updatedby = $userPK;
                        $tenderResponse->ctr_updatedbyipaddr = $ip_address;
                    }
                    $tenderResponse->ctr_memcompmst_fk = $compPK;
                    $tenderResponse->ctr_cmstenderhdr_fk = $tender->cmstenderhdr_pk;  
                    $tenderResponse->ctr_status = 2;                   
                    $tenderResponse->save();
                    
                    if(in_array($tender->cmsth_tenderstatus, [2,4,8])) {
                        $tender->cmsth_tenderstatus = $tender->cmsth_tenderstatus == 2 ? 9 : 10;
                        $tender->save();
                        
                        $tendertemp = CmstenderhdrtempTbl::findOne($tender->cmsth_cmstenderhdrtemp_fk); 
                        if($tendertemp) {
                            $tendertemp->cmstht_tenderstatus = $tender->cmsth_tenderstatus;
                            $tendertemp->save();
                        }
                    }
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $model->getErrors()
                    );
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }

            return $result;
        }
    }

    /**
     * Save quotation scope
     */
    public function saveScope($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'Something went wrong!',
        );
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($data) {
                $quotation_pk = $data['currentPk'];
                $model = CmsquotationhdrTbl::findOne($quotation_pk);
                if ($model) {
                    $lable = '';
                    if ($model->cmsqh_type == 1) {
                        $lable = 'Quotation';
                    } elseif ($model->cmsqh_type == 2) {
                        $lable = 'Offer';
                    } elseif ($model->cmsqh_type == 3) {
                        $lable = 'Proposal';
                    }
                    $model->cmsqh_scopedesc = $data['scope_desc'];
                    $model->cmsqh_scope_currencymst_fk = $data['currency_lst'];
                    $model->cmsqh_grandtotalamount = $data['datavalue'];
                    if ($model->save() === TRUE) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                        /* Saving data to  CmstenderpsmapTblQuery */
                        if (!empty($data['tableData'])) {
                            $DataType = $data['datatableType'];
                            $currencyPk = $data['currency_lst'];
                            foreach ($data['tableData'] as $dataVal) {
                                if ($dataVal['ctpsm_unitprice'] != 0) {
                                    if ($DataType == 1) {
                                        $tenderMapModel = CmstenderpsmapTbl::find()
                                                ->where(['cmstenderpsmap_pk' => $dataVal['cmstenderpsmap_pk']])
                                                ->one();
                                        $tenderMapModel->ctpsm_updatedon = $date;
                                        $tenderMapModel->ctpsm_updatedby = $userPK;
                                        $tenderMapModel->ctpsm_updatedbyipaddr = $ip_address;
                                    } else {
                                        $tenderMapModel = new CmstenderpsmapTbl();
                                        $tenderMapModel->ctpsm_shared_fk = $quotation_pk;
                                        $tenderMapModel->ctpsm_shared_type = 3;
                                        $tenderMapModel->ctpsm_cmsrqprodservdtls_fk = $dataVal['cmsrqprodservdtls_pk'];
                                        $tenderMapModel->ctpsm_createdon = $date;
                                        $tenderMapModel->ctpsm_createdby = $userPK;
                                        $tenderMapModel->ctpsm_createdbyipaddr = $ip_address;
                                    }
                                    if (empty($dataVal['ctpsm_quantity'])) {
                                        $tenderMapModel->ctpsm_quantity = $dataVal['crpsd_quantity'];
                                    } else {
                                        $tenderMapModel->ctpsm_quantity = $dataVal['ctpsm_quantity'];
                                    }
                                    $tenderMapModel->ctpsm_unitprice = $dataVal['ctpsm_unitprice'];
                                    $tenderMapModel->ctpsm_tax = $dataVal['ctpsm_tax'];
                                    $tenderMapModel->ctpsm_discount = $dataVal['ctpsm_discount'];
                                    $tenderMapModel->ctpsm_amount = $dataVal['ctpsm_amount'];
                                    $tenderMapModel->ctpsm_deviationcomment = $dataVal['ctpsm_deviationcomment'];
                                    $tenderMapModel->ctpsm_unitcurrency_fk = $currencyPk;
                                    $tenderMapModel->ctpsm_delivdate = $dataVal['crpsd_delivreqdate'];
                                    $tenderMapModel->ctpsm_deliv_mcmpld_fk = $dataVal['locationPk'];
                                    if (!$tenderMapModel->save()) {
                                        $result = array(
                                            'status' => 200,
                                            'msg' => 'Error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'moduleData' => $tenderMapModel->getErrors(),
                                        );
                                        break;
                                    } else {
                                        $result = array(
                                            'status' => true
                                        );
                                    }
                                }
                            }
                        }
                        /* Save Additional Tender charges to CmstenderpschargesTbl */
                        if ($result['status'] && !empty($data['additionalArray'])) {
                            foreach ($data['additionalArray'] as $val) {
                                if (($val['lableName'] != null && !empty($val['lableName'])) && ($val['lableVal'] != null && !empty($val['lableVal']))) {
                                    if ($val['dataPk'] != null) {
                                        $tenderCharges = CmstenderpschargesTbl::find()
                                                ->where(['cmstenderpscharges_pk' => $val['dataPk']])
                                                ->one();
                                        $tenderCharges->ctpsc_updatedon = $date;
                                        $tenderCharges->ctpsc_updatedby = $userPK;
                                        $tenderCharges->ctpsc_updatedbyipaddr = $ip_address;
                                    } else {
                                        $tenderCharges = new CmstenderpschargesTbl();
                                        $tenderCharges->ctpsc_shared_fk = $quotation_pk;
                                        $tenderCharges->ctpsc_shared_type = 1;
                                        $tenderCharges->ctpsc_createdon = $date;
                                        $tenderCharges->ctpsc_createdby = $userPK;
                                        $tenderCharges->ctpsc_createdbyipaddr = $ip_address;
                                    }
                                    $tenderCharges->ctpsc_type = $val['additionalVal'] == '+' ? 1 : 2;
                                    $tenderCharges->ctpsc_name = $val['lableName'];
                                    $tenderCharges->ctpsc_amount = $val['lableVal'];
                                    if (!$tenderCharges->save()) {
                                        $result = array(
                                            'status' => 200,
                                            'msg' => 'Error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'moduleData' => $tenderCharges->getErrors(),
                                        );
                                        break;
                                    } else {
                                        $result = array(
                                            'status' => true
                                        );
                                    }
                                }
                            }
                        }

                        if ($result['status']) {
                            $transaction->commit();
                            $result = array(
                                'status' => 200,
                                'msg' => 'success',
                                'flag' => 'S',
                                'comments' => $lable . ' scope saved successfully!',
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
                    $transaction->rollBack();
                }
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $result;
    }

    /**
     * Save quotation sepcification
     */
    public function saveSpecification($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($data['dataPk'])) {
                $tenderAgreeModel = CmstenderagreehdrTbl::find()->where("cmstenderagreehdr_pk =:pk", [':pk' => $data['dataPk']])->one();
                $tenderAgreeModel->ctah_updatedon = $date;
                $tenderAgreeModel->ctah_updatedby = $userPK;
                $tenderAgreeModel->ctah_updatedbyipaddr = $ip_address;
                $comments = 'Updated';
                $flag = 'U';
            } else {
                $tenderAgreeModel = new CmstenderagreehdrTbl();
                $tenderAgreeModel->ctah_createdon = $date;
                $tenderAgreeModel->ctah_createdby = $userPK;
                $tenderAgreeModel->ctah_createdbyipaddr = $ip_address;
                $comments = 'Added';
                $flag = 'C';
            }
            $tenderAgreeModel->ctah_cmsquotationhdr_fk = $data['currentPk'];
            $tenderAgreeModel->ctah_category = $data['dataType'];
            $tenderAgreeModel->ctah_type = $data['isAgreed'] == 'true' ? 1 : 2;
            $tenderAgreeModel->ctah_comments = $data['Comment'];
            $tenderAgreeModel->ctah_remarks = $data['Remarks'];

            if ($tenderAgreeModel->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => 'Specification & Drawing ' . $comments . ' Successfully!',
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $tenderAgreeModel->getErrors()
                );
            }
        }
        return $result;
    }

    /**
     * Save quotation Questionnaire
     */
    public function saveQuestionnaire($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $questionModel = new CmsquestionnaireformtrnxTbl();
            $questionModel->cmsqft_cmsquestionnaireform_fk = $data['formData']['form_id'];
            $questionModel->cmsqft_shared_fk = $data['formData']['quotationpk'];
            $questionModel->cmsqft_shared_type = $data['formData']['shared_type'];
            $questionModel->cmsqft_answer = $data['formData']['answer'];
            $questionModel->cmsqft_status = $data['formData']['status'];
            $questionModel->cmsqft_createdon = $date;
            $questionModel->cmsqft_createdby = $userPK;
            $questionModel->cmsqft_createdbyipaddr = $ip_address;

            if ($questionModel->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Quote Questionnaire added Successfully!',
                    'quotationpk' => $data['formData']['quotationpk'],
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $questionModel->getErrors()
                );
            }
        }
        return $result;
    }

    /**
     * Save quotation T&C
     */
    public function saveTerms($data) {
        $result = ['status' => true];
        if ($data) {
            $currentPk = $data['currentPk'];
            $quotation = CmsquotationhdrTbl::find()->where("cmsquotationhdr_pk =:pk", [':pk' => $currentPk])->one();
            $quotation->cmsqh_invoiceintervaltype = $data['reqintervaltype'];
            $quotation->cmsqh_invoiceinterval = $data['reqinterval'];
            $quotation->cmsqh_bidtncintervaltype = $data['valtype'];
            $quotation->cmsqh_bidtncinterval = $data['valinterval'];
            $quotation->cmsqh_bidtncdate = $data['reqintervaldate_Db'];
            if (!$quotation->save()) {
                $result = array(
                    'status' => 200,
                    'msg' => 'Error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $quotation->getErrors(),
                );
            }
        }

        return $result;
    }

    /**
     * Save quotation ccmmunication detail
     */
    public function saveCommDetail($data, $userPk) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        if ($data) {
            $quotation_pk = $data;
            $model = CmsquotationhdrTbl::findOne($quotation_pk);
            $comments = '';
            if ($model->cmsqh_contact_usermst_fk == null) {
                $comments = 'Communication Added Successfully!';
            } else {
                $comments = 'Communication Updated Successfully!';
            }
            $model->cmsqh_contact_usermst_fk = $userPk;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
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

    /**
     * Save quotation supporting docs
     */
    public function saveSupdocRemark($data) {
        $quotation_pk = $data['formData']['quotationpk'];
        $model = CmsquotationhdrTbl::findOne($quotation_pk);
        $model->cmsqh_suppdocremark = $data['formData']['remark'];
        $model->save();
    }

    /**
     * get quotation detail
     */
    public function getDetail($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );

        //print_r($data);die();

        if ($data) {
            $quotation_pk = $data['quotationpk'];
            $result = CmsquotationhdrTbl::find()
                    ->leftJoin('usermst_tbl', 'usermst_tbl.UserMst_Pk = cmsquotationhdr_tbl.cmsqh_initiatedby')
                    ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_tbl.cmstenderhdr_pk =  cmsquotationhdr_tbl.cmsqh_cmstenderhdr_fk')
                    ->where(['cmsquotationhdr_pk' => $quotation_pk])
                    ->one();

            //print_r($result);die();

            $data = array(
                'quot_id' => $result->cmsquotationhdr_pk,
                'quot_uid' => $result->cmsqh_uid,
                'quot_title' => $result->cmsqh_quotationtitle,
                'quot_refno' => $result->cmsqh_quotationrefno,
                'quot_initiateddate' => $result->cmsqh_initiateddate,
                'quot_initiatedby' => $result->cmsqh_initiatedby,

                'tender_id' => $result->cmstenderhdrtbl->cmstenderhdr_pk,
                'tender_title' => $result->cmstenderhdrtbl->cmsth_title,
                'tender_refno' => $result->cmstenderhdrtbl->cmsth_refno,
                'tender_obligation' => $result->cmstenderhdrtbl->cmsth_obligation,
                'tender_closeintvl' => $result->cmstenderhdrtbl->cmsth_closeintvl,
                'tender_joblocation' => $result->cmstenderhdrtbl->cmsth_joblocation,
                'contract_id' => $result->cmstenderhdrtbl->cmsth_contracthdr_fk,
                'tender_status' => $result->cmstenderhdrtbl->cmsth_tenderstatus,
                'icv_start_year' => $result->cmstenderhdrtbl->cmsth_icv_startyear,
                'icv_start_quarter' => $result->cmstenderhdrtbl->cmsth_icv_startquarter,
                'icv_end_year' => $result->cmstenderhdrtbl->cmsth_icv_endyear,
                'icv_end_quarter' => $result->cmstenderhdrtbl->cmsth_icv_endquarter,
                'quot_latesttime' => $result->cmsqh_latesttime
            );

            if ($result->cmstenderhdrtbl->cmsth_contact_usermst_fk) {
                $userpk = $result->cmstenderhdrtbl->cmsth_contact_usermst_fk;
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("select * from usermst_tbl 
                left join  countrymst_tbl ON countrymst_tbl.CountryMst_Pk = usermst_tbl.um_countrymst_fk 
                left join  designationmst_tbl ON designationmst_tbl.designationmst_Pk = usermst_tbl.UM_Designation
                where UserMst_Pk IN ($userpk)");
                $contacts = $command->queryAll();
                if (!empty($contacts)) {
                    foreach ($contacts as $contact) {
                        $data['company_contact'][] = array(
                            'firstname' => $contact['um_firstname'],
                            'middlename' => $contact['um_middlename'],
                            'lastname' => $contact['um_lastname'],
                            'designation' => $contact['dsg_designationname'],
                            'nationality' => $contact['CyM_CountryName_en'],
                            'email' => $contact['UM_EmailID']
                        );
                    }
                }
            }

            if ($result->cmstenderhdrtbl) {
                $membercompanymst = $result->cmstenderhdrtbl->membercompanymsttbl;
                $countrymsttbl = $membercompanymst->countrymsttbl;
                $classificationmstTbl = $membercompanymst->classificationmstTbl;

                $membercompany = $result->cmstenderhdrtbl->membercompanymsttbl;
                $data['company_info'] = array(
                    'id' => $membercompanymst->MemberCompMst_Pk,
                    'name' => $membercompanymst->MCM_CompanyName,
                    'reg_no' => $membercompanymst->MCM_crnumber,
                    'country' => !empty($countrymsttbl->CyM_CountryName_en) ? $countrymsttbl->CyM_CountryName_en : '',
                    'classification' => !empty($classificationmstTbl->ClM_ClassificationType) ? $classificationmstTbl->ClM_ClassificationType : ''
                );
            }

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }

        return $result;
    }

    public function getQuotation($data) {

        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        //print_r($data);die();
        if ($data) {
            $quotation_pk = $data['cmsqh_cmstenderhdr_fk'];
            $result = CmsquotationhdrTbl::find()
                    ->leftJoin('usermst_tbl', 'usermst_tbl.UserMst_Pk = cmsquotationhdr_tbl.cmsqh_initiatedby')
                    ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_tbl.cmstenderhdr_pk =  cmsquotationhdr_tbl.cmsqh_cmstenderhdr_fk')
                    ->where(['cmsqh_cmstenderhdr_fk' => $quotation_pk, 'cmsqh_status' => 7])
                    ->one();

            $data = array(
                'quot_id' => $result->cmsquotationhdr_pk,
                'quot_title' => $result->cmsqh_quotationtitle,
                'quot_refno' => $result->cmsqh_quotationrefno,
                'quot_initiateddate' => $result->cmsqh_initiateddate,
                'quot_initiatedby' => $result->cmsqh_initiatedby,
                'tender_id' => $result->cmstenderhdrtbl->cmstenderhdr_pk,
                'tender_title' => $result->cmstenderhdrtbl->cmsth_title,
                'tender_refno' => $result->cmstenderhdrtbl->cmsth_refno,
                'tender_obligation' => $result->cmstenderhdrtbl->cmsth_obligation,
                'tender_closeintvl' => $result->cmstenderhdrtbl->cmsth_closeintvl,
                'tender_joblocation' => $result->cmstenderhdrtbl->cmsth_joblocation,
                'tender_status' => $result->cmstenderhdrtbl->cmsth_tenderstatus,
                'icv_start_year' => $result->cmstenderhdrtbl->cmsth_icv_startyear,
                'icv_start_quarter' => $result->cmstenderhdrtbl->cmsth_icv_startquarter,
                'icv_end_year' => $result->cmstenderhdrtbl->cmsth_icv_endyear,
                'icv_end_quarter' => $result->cmstenderhdrtbl->cmsth_icv_endquarter,
                'quot_latesttime' => $result->cmsqh_latesttime
            );

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }

        return $result;
    }

    public function getScope($quot_pk) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $quotation = CmsquotationhdrTbl::findOne($quot_pk);
        $data = array(
            'scopeof_work' => $quotation->cmsqh_scopedesc
        );

        if (!empty($quotation->currencymsttbl)) {
            $data['scope_currency'] = array(
                'id' => $quotation->currencymsttbl->CurrencyMst_Pk,
                'symbol' => $quotation->currencymsttbl->CurM_CurrSymbol
            );
        }

        if (!empty($quotation->cmstenderpsmaptbl)) {
            foreach ($quotation->cmstenderpsmaptbl as $item) {

                $data['items'][] = array(
                    'item_pk' => $item->cmstenderpsmap_pk,
                    'quantity' => $item->ctpsm_quantity,
                    'unitprice' => $item->ctpsm_unitprice,
                    'amount' => $item->ctpsm_amount,
                    'tax' => $item->ctpsm_tax,
                    'discount' => $item->ctpsm_discount,
                    'delivdate' => $item->ctpsm_delivdate,
                    'shared_type' => $item->ctpsm_shared_type,
                    'unitcurrency_pk' => !empty($item->ctpsmUnitcurrencyFk) ? $item->ctpsmUnitcurrencyFk->CurrencyMst_Pk : '',
                    'currency_symbol' => !empty($item->ctpsmUnitcurrencyFk) ? $item->ctpsmUnitcurrencyFk->CurM_CurrSymbol : ''
                );
            }

            if (!empty($quotation->cmstenderpschargestbl)) {
                foreach ($quotation->cmstenderpschargestbl as $val) {

                    $data['tender_charges'][] = array(
                        'shared_type' => $val->ctpsc_shared_type,
                        'type' => $val->ctpsc_type,
                        'name' => $val->ctpsc_name,
                        'amount' => $val->ctpsc_amount
                    );
                }
            }

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

    public function getTermscondition($quotationpk) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $quotation = CmsquotationhdrTbl::findOne($quotationpk);
        if ($quotation) {
            $data = array(
                'bidterm_interval' => $quotation->cmsqh_bidtncinterval,
                'bidterm_intervaltype' => $quotation->cmsqh_bidtncintervaltype,
                'bidterm_date' => $quotation->cmsqh_bidtncdate,
                'invoiceinterval' => $quotation->cmsqh_invoiceinterval,
                'invoiceintervaltype' => $quotation->cmsqh_invoiceintervaltype
            );
            if (!empty($quotation->cmspaymenttermsTbl)) {
                foreach ($quotation->cmspaymenttermsTbl as $term) {
                    $data['payment_terms'] = array(
                        'paymentterm_pk' => $term->cmspaymentterms_pk,
                        'shared_fk' => $term->cmspt_shared_fk,
                        'shared_type' => $term->cmspt_type,
                        'type' => $term->cmspt_type,
                        'value' => $term->cmspt_value,
                    );
                }
            }

            if (!empty($quotation->cmstenderagreehdrTbl)) {
                foreach ($quotation->cmstenderagreehdrTbl as $term) {
                    $data['buyer_terms'] = array(
                        'buyerterm_pk' => $term->cmstenderagreehdr_pk,
                        'shared_fk' => $term->ctah_shared_fk,
                        'shared_type' => $term->ctah_shared_type,
                        'type' => $term->ctah_type,
                        'comments' => $term->ctah_comments,
                        'remarks' => $term->ctah_remarks
                    );
                }
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

    public function getCommunication($quotationpk) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $quotation = CmsquotationhdrTbl::findOne($quotationpk);
        $data = array();

        if ($quotation) {
            if ($quotation->cmsqh_contact_usermst_fk) {
                $userpk = $quotation->cmsqh_contact_usermst_fk;
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("select * from usermst_tbl 
                left join  countrymst_tbl ON countrymst_tbl.CountryMst_Pk = usermst_tbl.um_countrymst_fk 
                left join  designationmst_tbl ON designationmst_tbl.designationmst_Pk = usermst_tbl.UM_Designation
                where UserMst_Pk IN ($userpk)");
                $contacts = $command->queryAll();
                if (!empty($contacts)) {
                    foreach ($contacts as $contact) {
                        $data['comm_contact'][] = array(
                            'firstname' => $contact['um_firstname'],
                            'middlename' => $contact['um_middlename'],
                            'lastname' => $contact['um_lastname'],
                            'designation' => $contact['dsg_designationname'],
                            'nationality' => $contact['CyM_CountryName_en'],
                            'email' => $contact['UM_EmailID']
                        );
                    }
                }
            }

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

    /**
     * Save quotation detail
     */
    public function updateDetail($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsquotationhdrTbl::findOne($data['formData']['quotationpk']);
            if ($model) {
                $model->cmsqh_cmstenderhdr_fk = $data['formData']['tenderhdr_fk'];
                $model->cmsqh_quotationtitle = $data['formData']['quotationtitle'];
                $model->cmsqh_quotationrefno = $data['formData']['quotationrefno'];
                $model->cmsqh_initiatedby = $data['formData']['initiatedby'];
                $model->cmsqh_initiateddate = $data['formData']['initiateddate'];
                $model->cmsqh_secondary_memcompmst_fk = $data['formData']['secondary_memcompmst_fk'];
                $model->cmsqh_updatedon = $date;
                $model->cmsqh_updatedby = $userPK;
                $model->cmsqh_updatedbyipaddr = $ip_address;

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Quotation detail updated Successfully!',
                        'quotationpk' => $model->cmsquotationhdr_pk,
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
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Record not found!',
                    'returndata' => $model->getErrors()
                );
            }
        }
        return $result;
    }

    /**
     * Save quotation scope
     */
    public function updateScope($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($data) {
                $quotation_pk = $data['formData']['quotationpk'];
                $model = CmsquotationhdrTbl::findOne($quotation_pk);
                $model->cmsqh_scopedesc = $data['formData']['scopedesc'];
                $model->cmsqh_scope_currencymst_fk = $data['formData']['scope_currencymst_fk'];
                $model->cmsqh_grandtotalamount = $data['formData']['grandtotalamount'];
                $model->cmsqh_delivdate = $data['formData']['delivdate'];
                $model->cmsqh_scope_currencymst_fk = $data['formData']['scope_currencymst_fk'];

                if ($model->save() === TRUE) {
                    /* Saving data to  CmstenderpsmapTblQuery */
                    if (!empty($data['formData']['items'])) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                        $keepData = [];
                        foreach ($data['formData']['items'] as $item) {
                            if ($item['tendermap_pk']) {
                                $keepData[] = $item['tendermap_pk'];
                                $tenderMapModel = CmstenderpsmapTbl::findOne($item['tendermap_pk']);
                            } else {
                                $tenderMapModel = new CmstenderpsmapTbl();
                            }

                            $tenderMapModel->ctpsm_cmsrqprodservdtls_fk = $item['cmsrqprodservdtls_fk'];
                            $tenderMapModel->ctpsm_shared_fk = $model->cmsquotationhdr_pk;
                            $tenderMapModel->ctpsm_shared_type = $item['shared_type'];
                            $tenderMapModel->ctpsm_quantity = $item['quantity'];
                            $tenderMapModel->ctpsm_unitprice = $item['unitprice'];
                            $tenderMapModel->ctpsm_unitcurrency_fk = $item['unitcurrency_fk'];
                            $tenderMapModel->ctpsm_tax = $item['tax'];
                            $tenderMapModel->ctpsm_discount = $item['discount'];
                            $tenderMapModel->ctpsm_amount = $item['amount'];
                            $tenderMapModel->ctpsm_delivdate = $item['delivdate'];
                            $tenderMapModel->ctpsm_deliv_mcmpld_fk = $item['deliv_mcmpld_fk'];
                            $tenderMapModel->ctpsm_updatedon = $date;
                            $tenderMapModel->ctpsm_updatedby = $userPK;
                            $tenderMapModel->ctpsm_updatedbyipaddr = $ip_address;
                            if (!$tenderMapModel->save()) {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'Error',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong!',
                                    'moduleData' => $tenderMapModel->getErrors(),
                                );
                                break;
                            } else {
                                $keepData[] = $tenderMapModel->cmstenderpsmap_pk;
                                $result = array(
                                    'status' => true
                                );
                            }
                        }

                        if (!empty($keepData)) {
                            CmstenderpsmapTbl::deleteAll(['NOT IN', 'cmstenderpsmap_pk', $keepData]);
                        }
                    }
                    /* Save Additional Tender charges to CmstenderpschargesTbl */
                    if ($result['status'] && !empty($data['formData']['additional_charges'])) {
                        $keepData = [];
                        foreach ($data['formData']['additional_charges'] as $val) {
                            if ($val['tendercharges_pk']) {
                                $keepData[] = $val['tendercharges_pk'];
                                $tenderCharges = CmstenderpschargesTbl::findOne($val['tendercharges_pk']);
                            } else {
                                $tenderCharges = new CmstenderpschargesTbl();
                            }
                            $tenderCharges->ctpsc_shared_fk = $model->cmsquotationhdr_pk;
                            $tenderCharges->ctpsc_shared_type = $val['shared_type'];
                            $tenderCharges->ctpsc_type = $val['type'];
                            $tenderCharges->ctpsc_name = $val['name'];
                            $tenderCharges->ctpsc_amount = $val['amount'];
                            $tenderCharges->ctpsc_updatedon = $date;
                            $tenderCharges->ctpsc_updatedby = $userPK;
                            $tenderCharges->ctpsc_updatedbyipaddr = $ip_address;
                            if (!$tenderCharges->save()) {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'Error',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong!',
                                    'moduleData' => $tenderMapModel->getErrors(),
                                );
                                break;
                            } else {
                                $keepData[] = $tenderCharges->cmstenderpscharges_pk;
                                $result = array(
                                    'status' => true
                                );
                            }
                        }
                        if (!empty($keepData)) {
                            CmstenderpschargesTbl::deleteAll(['NOT IN', 'cmstenderpscharges_pk', $keepData]);
                        }
                    }

                    if ($result['status']) {
                        $transaction->commit();
                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => 'U',
                            'comments' => 'Quotation scope saved successfully!',
                            'quotationpk' => $data['formData']['quotationpk'],
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
                $transaction->rollBack();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $result;
    }
    
    /**
     * Get Audit Log List
     */
    public function getAuditList($data) {
        $list = [];
        $result = CmstenderresponseevalhstyTbl::find()->where(['ctreh_cmstenderresponse_fk' => $data['dataPk']])->all();

        foreach($result as $val) {
            $list[] = [
                'user' => $val->ctrehCreatedby->um_firstname . ' ' . ($val->ctrehCreatedby->um_middlename ? $val->ctrehCreatedby->um_middlename . ' ' : '') . $val->ctrehCreatedby->um_lastname,
                'validateon' => $val->ctreh_createdon,
                'status' => $val->ctreh_status,
                'commets' => $val->ctreh_comment
            ];
        }

        return [ 'list' => $list];
    }

    /**
     * update quotation Specification
     */
    public function updateSpecification($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $tenderAgreeModel = CmstenderagreehdrTbl::find()->where(['ctah_shared_fk' => $data['formData']['quotationpk']])->one();
            $tenderAgreeModel->ctah_cmstnctrnx_fk = $data['formData']['cmstnctrnx_fk'];
            $tenderAgreeModel->ctah_shared_fk = $data['formData']['quotationpk'];
            $tenderAgreeModel->ctah_shared_type = $data['formData']['shared_type'];
            $tenderAgreeModel->ctah_type = $data['formData']['type'];
            $tenderAgreeModel->ctah_comments = $data['formData']['comments'];
            $tenderAgreeModel->ctah_remarks = $data['formData']['remarks'];
            $tenderAgreeModel->ctah_updatedon = $date;
            $tenderAgreeModel->ctah_updatedby = $userPK;
            $tenderAgreeModel->ctah_updatedbyipaddr = $ip_address;
            if ($tenderAgreeModel->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Quote Specification updated Successfully!',
                    'quotationpk' => $data['formData']['quotationpk'],
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $tenderAgreeModel->getErrors()
                );
            }
        }
        return $result;
    }

    public function getQuotationArray($rftPk) {
        $model = CmsquotationhdrTbl::find()
                ->select(['cmsquotationhdr_pk', 'cmsqh_quotationtitle', 'cmsqh_uid', 'cmsqh_secondary_memcompmst_fk', 'cmsqh_createdon', 'cmsqh_initiateddate', 'MemberCompMst_Pk as primaryPk', 'cmsqh_scope_currencymst_fk as currencyPk', 'CurM_CurrencyName_en as currencyName', 'CurM_CurrSymbol as currencySymbol'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk=cmsqh_createdby')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk=UM_MemberRegMst_Fk')
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk=cmsqh_scope_currencymst_fk')
                ->where('cmsqh_cmstenderhdr_fk=:rftPk', array(':rftPk' => $rftPk))
                ->asArray()
                ->all();

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }
    public function getQuotationData($quotPk) {
        $model = CmsquotationhdrTbl::find()
                ->select(['cmsquotationhdr_pk', 'cmsqh_quotationtitle', 'cmsqh_uid', 'cmsqh_secondary_memcompmst_fk', 'cmsqh_createdon', 'cmsqh_initiateddate', 'cmsqh_memcompmst_fk as primaryPk', 'cmsqh_scope_currencymst_fk as currencyPk', 'CurM_CurrencyName_en as currencyName', 'CurM_CurrSymbol as currencySymbol','um_firstname as name','cmstenderhdr_pk', 'cmsth_title', 'cmsth_uid', 'cmsth_refno','cmsth_createdon','cmsth_initiateddate','cmsqh_quotationrefno','cmsth_type'])
                ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_pk=cmsqh_cmstenderhdr_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk=cmsqh_createdby')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk=UM_MemberRegMst_Fk')
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk=cmsqh_scope_currencymst_fk')
                ->where('cmsquotationhdr_pk=:quotPk', array(':quotPk' => $quotPk))
                ->asArray()
                ->one();

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public function getRFTDataPk($quotPk) {
        $model = CmsquotationhdrTbl::find()
                ->select(['cmsquotationhdr_pk', 'cmsqh_cmstenderhdr_fk', 'cmsqh_quotationtitle', 'cmsqh_scope_currencymst_fk as currencyPk', 'CurM_CurrencyName_en as currencyName', 'CurM_CurrSymbol as currencySymbol'])
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk=cmsqh_scope_currencymst_fk')
                ->where('cmsquotationhdr_pk=:quotPk', array(':quotPk' => $quotPk))
                ->asArray()
                ->one();

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    /**
     * Save quotation detail
     */
    public function deleteData($data) {
        if (!empty($data)) {
            $model = CmsquotationhdrTbl::findOne($data);
            $model->cmsqh_isdeleted = 1;
            $lable = '';
            if ($model->cmsqh_type == 1) {
                $lable = 'Quotation';
            } elseif ($model->cmsqh_type == 2) {
                $lable = 'Offer';
            } elseif ($model->cmsqh_type == 3) {
                $lable = 'Proposal';
            }
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => $lable . ' deleted successfully',
                    'moduleData' => $model,
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
