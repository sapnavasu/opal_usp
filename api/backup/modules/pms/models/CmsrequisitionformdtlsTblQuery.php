<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use api\modules\pms\models\CmssupdocumentTblQuery;
use api\modules\pms\components\pmsSuppDoc;
use common\models\UsermstTbl;
use common\models\StkholdertypmstTbl;

/**
 * This is the ActiveQuery class for [[CmsrequisitionformdtlsTbl]].
 *
 * @see CmsrequisitionformdtlsTbl
 */
class CmsrequisitionformdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsrequisitionformdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrequisitionformdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function addRequisition($data) {
        if (!empty($data)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $reqData = $data['requistitionData'];    
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);


            if ($reqData['req_pk'] != 0 && !empty($reqData['req_pk'])) {
                $model = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $reqData['req_pk']])->one();
                if (!empty($model->crfd_createdon)) {
                    $model->crfd_updatedon = $date;
                    $model->crfd_updatedby = $userPK;
                    $model->crfd_updatedbyipaddr = $ip_address;
                }
            } else {
                $model = new CmsrequisitionformdtlsTbl();               
                $model->crfd_rqid = Common::getUniqueId('cmsReq');
                $model->crfd_createdby = $userPK;
                $model->crfd_createdbyipaddr = $ip_address;
                $model->crfd_createdon = $date;
            }
            if ($reqData['req_type'] == 'req_Card') {
                $model->crfd_rqtitle = $reqData['req_cardtitle'];
                $model->crfd_rqrefno = $reqData['req_refno'];
                $model->crfd_requester = $reqData['req_requester'];
                $model->crfd_rqpriority = $reqData['req_priority'];
                $model->crfd_rqprocesstype = $reqData['req_protype'];
                $model->crfd_rqtype = $reqData['req_require'];
                $model->crfd_memcompmst_fk = $company_id;
                $model->crfd_rqstatus = 1; //default value (Draft)
                
                if($reqData['req_discipline'] != '' && $reqData['req_discipline'] != null) {
                   $disciplinepk = \app\models\CmsdisciplinedtlsTblQuery::adddisciplinedtls($reqData['req_discipline']);
                    // if($disciplinepk['code'] == '202') {
                    //     // return $result = array(
                    //     //     'status' => 202,
                    //     //     'msg' => 'failure',
                    //     //     'flag' => 'U',
                    //     //     'comments' => 'Discipline name duplicate error occurred',
                    //     //     'moduleData' => $model,
                    //     // );
                    // } else {
                    //     $model->crfd_cmsdisciplinedtls_fk = $disciplinepk;
                    // }
                    $model->crfd_cmsdisciplinedtls_fk = $disciplinepk;
                }
                //  else {
                //     $model->crfd_cmsdisciplinedtls_fk = $reqData['req_disciplinepk'];
                // }

                if($reqData['cost_centre'] != '' && $reqData['cost_centre'] != null) {
                     $costcentrepk = \app\models\CmscostcenterdtlsTblQuery::addcostcentredtls($reqData['cost_centre']);
                    //  if($costcentrepk['code'] == '202') {
                    //     //  return $result = array(
                    //     //      'status' => 202,
                    //     //      'msg' => 'failure',
                    //     //      'flag' => 'U',
                    //     //      'comments' => 'Cost centre name duplicate error occurred',
                    //     //      'moduleData' => $model,
                    //     //  );
                    //  } else {
                    //      $model->crfd_cmscostcenterdtls_fk = $costcentrepk;
                    //     }
                        $model->crfd_cmscostcenterdtls_fk = $costcentrepk;
                 } 
                //  else {
                //      $model->crfd_cmscostcenterdtls_fk = $reqData['cost_centrepk'];
                //  }

                $model->crfd_departmentmst_fk = implode(',',$reqData['req_departcode']);
                // $model->crfd_rqdate = Common::convertDateTimeToServerTimezone($reqData['req_date']);
                $model->crfd_rqdate = $reqData['req_date'];
                if($reqData['reqdocument'] != null) {
                    $model->crfd_rqprocesstypefile = implode(',',$reqData['reqdocument']);
                }
                $model->crfd_remarks = $reqData['reqremarks'];
                $model->crfd_rqrevisionno = $reqData['req_revisionno'];
                // $model->crfd_rqdisciplinename = $reqData['req_discipline'];
                // $model->crfd_rqrevisionno = $reqData['crfd_rqrevisionno'];
                $model->crfd_type = $reqData['formdtls_type'];
                if($reqData['project_pk'] != 'undefined') {
                    $model->crfd_projectdtls_fk = Security::decrypt($reqData['project_pk']);
                }
            } elseif ($reqData['req_type'] == 'req_info') {
                $model->crfd_projectdtls_fk = $reqData['project_pk'];
                // $model->crfd_memcompsecdtls_fk = $reqData['bus_unit'];
                // $model->crfd_rqcreationtype = $reqData['create_type'];
                // $model->crfd_rqstatus = $reqData['rq_status'];
                $model->crfd_departmentmst_fk = $reqData['dept_code'];
                // $model->crfd_category_fk = $reqData['pro_cate'];
            } elseif ($reqData['req_type'] == 'req_details') {
                $model->crfd_rqdesc = $reqData['requisi_desc'];
                $model->crfd_rqstatement = $reqData['requisi_state'];
                $model->crfd_isblanketrq = $reqData['isblanket'];
                $model->crfd_recurinterval = $reqData['req_intervalcnt'];
                $model->crfd_recurintervaltype = $reqData['req_interval'];
                $model->crfd_rqclassification = $reqData['req_classification'];
                $model->crfd_reqpercent = $reqData['req_percentage'];
            } elseif ($reqData['req_type'] == 'req_delivery') {
                // $model->crfd_isdropship = $reqData['isdropship'];
                // $model->crfd_suplier_mcm_fk = $reqData['sel_Pk_supplier'];
                $model->crfd_deliv_mcmpld_fk = $reqData['locationPk'];
                $model->crfd_delivreqdate = Common::convertDateTimeToServerTimezone($reqData['delivery_date']);
                $model->crfd_delivdeferreddate = Common::convertDateTimeToServerTimezone($reqData['before_date']);
                $model->crfd_delivmodeoftrans = $reqData['mode_transport'];
                $model->crfd_delivfreightterms = $reqData['term_fright'];
                $model->crfd_delivremarks = $reqData['remark'];
                $model->crfd_delivloctype = $reqData['deliveryPk'];
                $model->crfd_delivtac = $reqData['terms_conditi'];
            } elseif ($reqData['req_type'] == 'req_proservice') {
                if ($reqData['isdeliver'] == true) {
                    $reqData['isdeliver'] = 1;
                } else {
                    $reqData['isdeliver'] = 2;
                }

                $model->crfd_reqdeliverable = $reqData['isdeliver'];
                $model->crfd_document = $reqData['req_document'];
                $model->crfd_spares = implode(",", $reqData['Commissioning_Spares']);
                $model->crfd_sparesothers = $reqData['requisi_other'];
                $model->crfd_rqapproxvalue = $reqData['requisi_approxi'];
            } elseif ($reqData['req_type'] == 'req_support_doc') {
                $model->crfd_remarks = $reqData['remark_disc'];
            }
            if ($model->save() === TRUE) {
                if ($reqData['req_pk'] != 0 && !empty($reqData['req_pk'])) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Requisition Update Successfully',
                        'moduleData' => $model,
                        'cmsdd_name' => $reqData['req_discipline'],
                        'cmsccd_name' => $reqData['cost_centre'],
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => 'Requisition Created Successfully',
                        'moduleData' => $model,
                        'cmsdd_name' => $reqData['req_discipline'],
                        'cmsccd_name' => $reqData['cost_centre'],
                    );
                }
                $reqData['subdocument'][0]['shared_fk'] = $model->cmsrequisitionformdtls_pk;
                $reqData['subdocument'][0]['docname'] = $reqData['subdocumentname'];
                $reqData['subdocument'][0]['type'] = 1;
                if($reqData['subdocument'][0]['docname']) {
                    $save_data =  CmssupdocumentTblQuery::adddocument($reqData['subdocument'][0]);
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

    public function getReqData($reqPk) {
        $model = CmsrequisitionformdtlsTbl::find()
            ->select(['crfd_delivreqdate','crfd_deliv_mcmpld_fk','crfd_shared_agreetype', 'crfd_shared_agreefk', 'crfd_rqstatus','crfd_type','cmsccd_name', 'cmsdd_name','crfd_sparesothers','crfd_rqclassification','crfd_reqpercent','crfd_rqrevisionno','crfd_cmsdisciplinedtls_fk','crfd_rqapproxvalue','crfd_rqprocesstype', 'crfd_rqprocesstypefile', 'crfd_rqtype', 'crfd_cmscostcenterdtls_fk', 'UserMst_Pk', 'um_firstname', 'UM_EmpId', 'cmsrequisitionformdtls_pk', 'crfd_rqid', 'crfd_rqtitle', 'crfd_rqrefno', 
                'crfd_requester', 'crfd_rqpriority', "date_format(crfd_rqdate,'%Y-%m-%d') as crfd_rqdate", 'crfd_projectdtls_fk', 'crfd_departmentmst_fk', 'DM_Name', 'crfd_rqdesc', 'crfd_rqstatement', 
                'crfd_isblanketrq', 'crfd_recurinterval', 'crfd_recurintervaltype', 'cmsdd_name',
                // 'crfd_delivreqdate', 'crfd_delivdeferreddate', 'crfd_delivmodeoftrans', 'crfd_delivfreightterms', 'crfd_delivremarks', 
                // 'crfd_delivloctype', 'mcmpld_address', 'crfd_delivtac', 
                'crfd_reqdeliverable', 'crfd_document', 
                'crfd_spares','crfd_remarks', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prjd_projstatus', 
                'CASE WHEN `prjd_projstatus` = 1 then "Yet to Submit for Validation"  
                WHEN `prjd_projstatus` = 2 then "Posted for Validation"  
                WHEN `prjd_projstatus` = 3 then "Approved"  
                WHEN `prjd_projstatus` = 4 then "Declined"  
                WHEN `prjd_projstatus` = 5 then "Re-Submitted"  
                ELSE "" END as prostatus',
                'CASE WHEN `crfd_rqstatus` = 1 then "Draft"  
                WHEN `crfd_rqstatus` = 2 then "Submitted"  
                WHEN `crfd_rqstatus` = 3 then "Approved"  
                WHEN `crfd_rqstatus` = 4 then "Declined"  
                WHEN `crfd_rqstatus` = 5 then "In-progress"  
                WHEN `crfd_rqstatus` = 6 then "Completed"  
                WHEN `crfd_rqstatus` = 7 then "Terminated"  
                WHEN `crfd_rqstatus` = 8 then "Suspended"  
                ELSE "" END as reqstatus',
                'CASE WHEN `crfd_rqpriority` = 1 then "Low"
                WHEN `crfd_rqpriority` = 2 then "Medium"
                WHEN `crfd_rqpriority` = 3 then "High" ELSE "" END as priority_string', 
                "case
                    when crfd_rqprocesstype in (1,2,4) and find_in_set(5, group_concat(distinct cmsth_tenderstatus)) then 'Awarded' 
                    when crfd_rqprocesstype = 3 and count(distinct cmstenderhdr_pk) = 0 then 'Yet to Start'
                    when crfd_rqprocesstype = 3 and group_concat(distinct cmsth_tenderstatus) = '6' then 'Yet to Start' 
                    when crfd_rqprocesstype = 3 and find_in_set(1, group_concat(distinct cmsth_tenderstatus)) then 'Yet to Start' 
                    when crfd_rqprocesstype in (1,2,4) and count(distinct cmscontracthdr_pk) = 0 then 'Yet to Start' 
                    when crfd_rqprocesstype = 3 and group_concat(distinct cmsth_tenderstatus) <> '6' then 'In-progress' 
                    when crfd_rqprocesstype = 3 and count(distinct cmscontracthdr_pk) = 0 then 'In-progress' 
                else 'Yet to Start' end as 'tenderstatus'",
            'um_departmentmst_fk'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = crfd_requester')
            ->leftJoin('cmstenderhdr_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
            ->leftJoin('cmscontracthdr_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
            // ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = crfd_suplier_mcm_fk')
            // ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk = crfd_deliv_mcmpld_fk')
            ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
            // ->leftJoin('memcompsectordtls_tbl', 'MemCompSecDtls_Pk = crfd_memcompsecdtls_fk')
            // ->leftJoin('sectormst_tbl', 'SectorMst_Pk = MCSD_SectorMst_Fk')
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
            ->leftJoin('cmsdisciplinedtls_tbl', 'cmsdisciplinedtls_pk = crfd_cmsdisciplinedtls_fk')
            ->leftJoin('cmscostcenterdtls_tbl', 'cmscostcenterdtls_pk = crfd_cmscostcenterdtls_fk')
            // ->leftJoin('formcategorymst_tbl', 'formcategorymst_pk = crfd_category_fk')
            ->where('cmsrequisitionformdtls_pk=:pk', array(':pk' => $reqPk))
            ->asArray()->one();
        $model['crfd_spares'] = explode(',', $model['crfd_spares']);

        $dept_model = \common\models\DepartmentmstTbl::findOne($model['um_departmentmst_fk']);
        $model['user_dept'] =  $dept_model['DM_Name']; 

        // if($model['crfd_rqrevisionno'] == null) {
        //     $getrequistioncount = CmsrequisitionformdtlsTbl::find()
        //         ->select(['crfd_projectdtls_fk'])
        //         ->where('crfd_projectdtls_fk=:ppk', array(':ppk' => $model['crfd_projectdtls_fk']))
        //         ->asArray()->all();
        //     $req_count = count($getrequistioncount);
        //     $model['crfd_rqrevisionno'] = $req_count;
        // } 

        return $model;
    }

    public static function GetTenderDataArray($data) {
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $size = Security::sanitizeInput($data['size'], "number");
        $proPk = $data['proPk'];
        $contract_id = $data['contract_id'];
        $endDate = $data['endDate'];
        $startDate = $data['startDate'];
        $processtype = $data['processtype'];
        $priority = $data['priority'];
        $tendertype = $data['tendertype'];
        $status = $data['status'];
        $from_page = $data['from_page_value'];
        $obligation = $data['obligationtype'];
        $blanketval = $data['isblanket'];
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        if($from_page == 1) {
            $type = 2;
        } else if($from_page == 2) {
            $type = 3;
        }
        
        $query = CmsrequisitionformdtlsTbl::find();

        if ($data['crfd_requester'] != 'null') {
            $query->andOnCondition("crfd_requester IN ({$data['crfd_requester']})");
        }

        $query->select([
            'crfd_rqprocesstypefile as proof_doc','doc.mcfd_origfilename', 'doc.mcfd_sysgenerfilename', 'doc.mcfd_filetype as uploadtype', 'doc.mcfd_uploadedon', 'doc.mcfd_uploadedby', 'doc.mcfd_actualfilesize',
            'ptf.mcfd_origfilename as proof_originalfilename', 'ptf.mcfd_sysgenerfilename as proof_sysfilename', 'ptf.mcfd_filetype as proof_uploadedtype', 'ptf.mcfd_uploadedon as proof_uploadedon', 'ptf.mcfd_uploadedby as proof_uploadedby', 'ptf.mcfd_actualfilesize as proof_actualsize','crfd_tenderstatus',
            'crfd_isblanketrq',"date_format(crfd_delivreqdate,'%d-%m-%Y') as crfd_delivreqdate", 'cmsccd_name', 'crfd_remarks', 'um_firstname as username', 'dsg_designationname as user_designation', 'UserMst_Pk as userPk',
            "date_format(crfd_rqdate,'%d-%m-%Y') as crfd_rqdate", 'crfd_spares','crfd_reqdeliverable', 
            'crfd_document', 'crfd_deliv_mcmpld_fk', 'crfd_shared_agreetype', 'crfd_shared_agreefk',
            'crfd_formtype as form_type','cmsrequisitionformdtls_pk', 'cmsrequisitionformdtls_pk as req_id', 
            'crfd_rqtitle', 'crfd_rqid', 'crfd_rqrefno', 'crfd_rqpriority', 'DM_Name', 'crfd_rqdesc','crfd_rqtype',
            'crfd_rqprocesstype','cmsdd_name','crfd_projectdtls_fk', 'crfd_rqstatus',
            'count(distinct cmstenderhdr_pk) as enquiery_count', 'count(distinct cmscontracthdr_pk) as contract_count',
             "case  when crfd_rqprocesstype in (1,2,4) and find_in_set(5, group_concat(distinct cmsth_tenderstatus)) then 'Awarded'  when crfd_rqprocesstype = 3 and count(distinct cmstenderhdr_pk) = 0 then 'Yet to Start' when crfd_rqprocesstype = 3 and group_concat(distinct cmsth_tenderstatus) = '6' then 'Yet to Start' when crfd_rqprocesstype = 3 and find_in_set(1, group_concat(distinct cmsth_tenderstatus)) then 'Yet to Start' when crfd_rqprocesstype in (1,2,4) and count(distinct cmscontracthdr_pk) = 0 then 'Yet to Start' when crfd_rqprocesstype = 3 and group_concat(distinct cmsth_tenderstatus) <> '6' then 'In-progress' when crfd_rqprocesstype = 3 and count(distinct cmscontracthdr_pk) = 0 then 'In-progress' else 'Yet to Start'end as 'tenderstatus'", 
            //Awared and Partial Awared concept need to implement
            "CASE WHEN `crfd_rqclassification` = 1 then 'MSME Obligation' WHEN `crfd_rqclassification` = 2 then 'LCC Obligation' WHEN `crfd_rqclassification` = 3 then 'MSME & LCC Obligation' WHEN `crfd_rqclassification` = 4 then 'Others' WHEN `crfd_rqclassification` = 5 then 'Not Applicable' END as req_classification",
            'CyM_CountryDialCode as dialcode', 'CyM_CountryName_en as countury_name', 'mcmpld_address', 'mcmpld_countrymst_fk', 'mcmpld_emailid', 'mcmpld_landlinenocc', 'mcmpld_landlineno'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = crfd_requester')
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
            ->leftJoin('cmsdisciplinedtls_tbl', 'cmsdisciplinedtls_pk = crfd_cmsdisciplinedtls_fk')
            ->leftJoin('cmscostcenterdtls_tbl', 'cmscostcenterdtls_pk = crfd_cmscostcenterdtls_fk') 
            ->leftJoin('cmstenderhdr_tbl', 'cmsrequisitionformdtls_pk = cmsth_cmsrequisitionformdtls_fk')
            ->leftJoin('cmscontracthdr_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
            ->leftJoin('designationmst_tbl', 'UM_Designation = designationmst_pk')
            ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk = crfd_deliv_mcmpld_fk')
            ->leftJoin('countrymst_tbl', 'mcmpld_countrymst_fk = CountryMst_Pk')
            ->leftJoin('memcompfiledtls_tbl as doc', 'doc.memcompfiledtls_pk = crfd_document') 
            ->leftJoin('memcompfiledtls_tbl as ptf', 'ptf.memcompfiledtls_pk = crfd_rqprocesstypefile');
            
        if($from_page == 1) {
            $query->where('crfd_memcompmst_fk=:compk and crfd_projectdtls_fk=:pk and crfd_isdeleted = 2 and crfd_type =:type', array(':compk' => $company_id, ':pk' => $proPk, ':type' => $type));
        } else if($from_page == 2) {
            $query->where('crfd_memcompmst_fk=:compk and crfd_cmscontracthdr_fk=:conpk and crfd_isdeleted = 2 and crfd_type =:type', array(':compk' => $company_id, ':conpk' => Security::decrypt($contract_id), ':type' => $type));
        }

        if($startDate && $endDate) {
            $query->andWhere(['between', 'crfd_createdon', trim($startDate), trim($endDate)]);
        }
        
        if($searchTxt) {
            $query->andFilterWhere([
                'or',
                ['like', 'crfd_rqtitle', $searchTxt],
                ['like', 'crfd_rqid', $searchTxt],
                ['like', 'crfd_rqrefno', $searchTxt]
            ]);
        }
        
        if($priority) {
            $query->andWhere(['IN', 'crfd_rqpriority', explode(',',$priority)]);
        }

        if($tendertype) {
            $query->andWhere(['IN', 'crfd_rqtype',  explode(',',$tendertype)]);
        }

        if($processtype) {
            $query->andWhere(['IN', 'crfd_rqprocesstype',  explode(',',$processtype)]);
        }

        if($obligation != '') {
            $query->andWhere('crfd_rqclassification=:rqcl', array(':rqcl' => $obligation));
        }

        if($blanketval != '') {
            $query->andWhere('crfd_isblanketrq=:isblanket', array(':isblanket' => $blanketval));
        }
        
        if (!empty($status) && $status != null) {
            $query->andWhere(['IN', 'crfd_tenderstatus', explode(',', $$status)]);
        }            
        $query->groupBy(['cmsrequisitionformdtls_pk'])
            ->orderBy(['crfd_latesttime' => SORT_DESC])
            ->asArray();

        $page = (!empty($size)) ? $size : 5;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $tender_detials = [];
        foreach($provider->getModels() as $key => $value) {
            $query1 = CmsrequisitionformdtlsTbl::findOne($value['cmsrequisitionformdtls_pk']);
            $rfx_list = $query1->cmstenderhdrtempTbls;
            $tender_detials[$key] = $rfx_list;
            if(count($rfx_list) > 0) {
                $status_value = [];
                foreach($rfx_list as $rfxkey => $rfx_value) {
                    $rfx_status = \api\modules\pms\models\CmstenderhdrtempTblQuery::getrfxstatusvalue($rfx_value);
                    $status_value[$rfxkey] = $rfx_status;
                }
                $tender_detials[$key]['derived_status'] = $status_value;
            }
        }

        return [
            'tender_detials' => $tender_detials,
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }

    public function getrequisitionlist($data) {

        // $propk = Security::decrypt($data['projectpk']);
        // $propk = Security::sanitizeInput($propk, "number");
        $searchstring = $data['searchstring'];
        $sortorder = $data['sortorder'];
        $filterval = $data['filterval'];

        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $model = CmsrequisitionformdtlsTbl::find()
            ->select(['crfd_rqclassification','crfd_rqstatus','cmsccd_name','cmsdd_name','crfd_sparesothers','crfd_rqclassification','crfd_reqpercent','crfd_rqrevisionno',
                'crfd_cmsdisciplinedtls_fk','crfd_rqapproxvalue','crfd_rqprocesstype', 'crfd_rqprocesstypefile', 'crfd_rqtype', 
                'crfd_cmscostcenterdtls_fk', 'UserMst_Pk', 'um_firstname', 'UM_EmpId', 'cmsrequisitionformdtls_pk', 'crfd_rqid', 'crfd_rqtitle', 'crfd_rqrefno', 
                'crfd_requester', 'crfd_rqpriority', "date_format(crfd_rqdate,'%d-%m-%Y') as crfd_rqdate", 'crfd_projectdtls_fk', 
                'crfd_departmentmst_fk', 'DM_Name', 'crfd_rqdesc', 'crfd_rqstatement', 
                'crfd_isblanketrq', 'crfd_recurinterval', 'crfd_recurintervaltype', 'cmsdd_name',
                'crfd_reqdeliverable', 'crfd_document', 
                'crfd_spares','crfd_remarks', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prjd_projstatus', 
                'CASE WHEN `crfd_rqtype` = 1 then "Product" ELSE "Service" END as req_type',
                'CASE WHEN `crfd_rqpriority` = 1 then "Low" 
                WHEN `crfd_rqpriority` = 2 then "Medium"
                WHEN `crfd_rqpriority` = 3 then "High"
                ELSE "" END as req_priority',
                'CASE WHEN `crfd_rqclassification` = 1 then "MSME Obligation"
                WHEN `crfd_rqclassification` = 2 then "LCC Obligation"
                WHEN `crfd_rqclassification` = 3 then "MSME & LCC Obligation"
                WHEN `crfd_rqclassification` = 4 then "Others"
                WHEN `crfd_rqclassification` = 5 then "Not Applicable" END as req_classification',
                'CASE WHEN `prjd_projstatus` = 1 then "Yet to Submit for Validation"  
                WHEN `prjd_projstatus` = 2 then "Posted for Validation"  
                WHEN `prjd_projstatus` = 3 then "Approved"  
                WHEN `prjd_projstatus` = 4 then "Declined"  
                WHEN `prjd_projstatus` = 5 then "Re-Submitted"  
                ELSE "" END as prostatus',
                'CASE WHEN `crfd_rqstatus` = 1 then "Draft"  
                WHEN `crfd_rqstatus` = 2 then "Submitted"  
                WHEN `crfd_rqstatus` = 3 then "Approved"  
                WHEN `crfd_rqstatus` = 4 then "Declined"  
                WHEN `crfd_rqstatus` = 5 then "In-progress"  
                WHEN `crfd_rqstatus` = 6 then "Completed"  
                WHEN `crfd_rqstatus` = 7 then "Terminated"  
                WHEN `crfd_rqstatus` = 8 then "Suspended"  
                ELSE "" END as reqstatus', 'dsg_designationname as user_designation'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = crfd_requester')
            ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
            ->leftJoin('cmsdisciplinedtls_tbl', 'cmsdisciplinedtls_pk = crfd_cmsdisciplinedtls_fk')
            ->leftJoin('cmscostcenterdtls_tbl', 'cmscostcenterdtls_pk = crfd_cmscostcenterdtls_fk')
            ->leftJoin('designationmst_tbl', 'UM_Designation = designationmst_pk')
            ->where('crfd_memcompmst_fk=:pk', array(':pk' => $company_id))
            ->andWhere(['!=', 'crfd_isdeleted', 1])
            ->andWhere(['=', 'crfd_type', 1]);

            if($filterval) {
                if($filterval['depart']) {
                    $sql_query = '';
                    foreach($filterval['depart'] as $key => $value) {
                        if($key != (count($filterval['depart']) - 1)) {
                            $sql_query .= ' crfd_departmentmst_fk like "%' . $value . '%" or ';
                        } else {
                            $sql_query .= ' crfd_departmentmst_fk like "%' . $value . '%"';
                        }
                    }
                    $model->andWhere($sql_query);
                }

                if($filterval['discipline']) {
                    $model->andWhere(['in', 'crfd_cmsdisciplinedtls_fk', $filterval['discipline']]);
                }

                if($filterval['priority']) {
                    $model->andWhere(['in', 'crfd_rqpriority', $filterval['priority']]);
                }

                if($filterval['requester']) {
                    $model->andWhere(['in', 'crfd_requester', $filterval['requester']]);
                }

                if($filterval['project']) {
                    $model->andWhere(['in', 'crfd_projectdtls_fk', $filterval['project']]);
                }

                if($filterval['status']) {
                    $model->andWhere(['in', 'crfd_rqstatus', $filterval['status']]);
                }

                if($filterval['type']) {
                    if(in_array(3, $filterval['type'])) {
                        $filterval['type'] = [1,2];
                    }
                    $model->andWhere(['in', 'crfd_rqtype', $filterval['type']]);
                }

                if($filterval['requisition_range'][0]) {
                    $model->andWhere(['between', 'STR_TO_DATE(crfd_rqdate,"%Y-%m-%d")', $filterval['requisition_range'][0], $filterval['requisition_range'][1]]);
                }

                if($filterval['obligation_range']) {
                    $model->andWhere(['between', 'crfd_reqpercent', $filterval['obligation_range'][0], $filterval['obligation_range'][1]]);
                }
                
            }

            if($searchstring) {
                $model->andFilterWhere([
                    'or',
                    ['like', 'crfd_rqtitle', $searchstring],
                    ['like', 'crfd_rqid', $searchstring]
                ]);
            }

            if($sortorder) {
                if($sortorder == 'new') {
                    $model->orderBy(['crfd_latesttime' => SORT_DESC]);
                } else {
                    $model->orderBy(['crfd_latesttime' => SORT_ASC]);
                }
            } else {
                $model->orderBy(['crfd_latesttime' => SORT_DESC]);
            }
            $model->asArray();

            $page = (!empty($size)) ? $size : 9;
            $provider = new ActiveDataProvider(['query' => $model, 'pagination' => ['pageSize' => $page]]);

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];

    }

    public function deleterequisition($pk) {
        try {
            $requisitiondet = CmsrequisitionformdtlsTbl::findOne($pk);
            if($requisitiondet) {
                $requisitiondet->crfd_isdeleted = 1;
                $requisitiondet->crfd_updatedon = date('Y-m-d H:i:s');
                $requisitiondet->crfd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                if($requisitiondet->save()) {
                    return [
                        "msg" => "Requisition Deleted Successfully", // Requisition and Tender both are same, different in type
                        "status" => 1
                    ];
                }
            }
        } catch (\yii\base\Exception $ex) {
            return [
                "msg" => $ex->getMessage(),
                "status" => $ex->getCode()
            ];
        }
    }
    
    public function submitrequisition($reqpk) {
        try {
            $pk = Security::decrypt($reqpk);
            if($pk) {
                $requisitiondet = CmsrequisitionformdtlsTbl::findOne($pk);
                if($requisitiondet) {
                    $requisitiondet->crfd_rqstatus = 2;
                    $requisitiondet->crfd_updatedon = date('Y-m-d H:i:s');
                    $requisitiondet->crfd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                    if($requisitiondet->save()) {
                        return [
                            "msg" => "Requisition Submitted Successfully",
                            "status" => 1
                        ];
                    }
                }
            }
        } catch (\yii\base\Exception $ex) {
            return [
                "msg" => $ex->getMessage(),
                "status" => $ex->getCode()
            ];
        }
    }

    public function getfilterdeptlist($company_id) {
        // $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $depart_array = [];
        try {

            $model = CmsrequisitionformdtlsTbl::find()
                ->select(['crfd_departmentmst_fk'])
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                ->where('crfd_memcompmst_fk=:pk', array(':pk' => $company_id))
                ->andWhere(['!=', 'crfd_isdeleted', 1])->asArray()->all();
            
            foreach ($model as $key => $value) {
                $departmentlist = explode(',' , $value['crfd_departmentmst_fk']);
                foreach ($departmentlist as $dkey => $dvalue) {
                    if(!in_array($dvalue, $depart_array)) {
                        array_push($depart_array, $dvalue);
                    }
                }
            }
            $dmodel = \common\models\DepartmentmstTbl::find()
                ->select('DepartmentMst_Pk as deptPk, DM_Name as deptName')
                ->where(['IN', 'DepartmentMst_Pk', $depart_array])
                ->asArray()->all();

            $pmodel = \api\modules\pd\models\ProjectdtlsTbl::find()
                ->select(['prjd_projname as projectName', 'projectdtls_pk as projectPK'])
                ->andWhere('prjd_memberregmst_fk=:regPK',array(':regPK' => $company_id))
                ->orderBy('prjd_projname ASC')
                ->asArray()
                ->all(); 
            $return['departlist'] = $dmodel;
            $return['projectlist'] = $pmodel;

            if($dmodel) {
                return $return;
            }
        } catch (\yii\base\Exception $ex) {
            return [
                "msg" => $ex->getMessage(),
                "status" => $ex->getCode()
            ];
        }
    }

    public function addquicktender($data) {
        if (!empty($data)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $reqData = $data['quicktender'];    
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            if($reqData['project_pk'] != 'undefined') {
                $project_status = \api\modules\pd\models\ProjectdtlsTbl::find()->select(['prjd_projstatus', 'prjd_projstage'])
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk=prjd_projstage')
                    ->where('projectdtls_pk=:proPK', array(':proPK' => Security::decrypt($reqData['project_pk'])))
                    ->asArray()
                    ->one();
                    if($project_status['prjd_projstage'] == 3) {
                        return $result = array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong',
                        );
                    }
            }


            if ($reqData['ten_pk'] != 0 && !empty($reqData['ten_pk'])) {
                $model = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $reqData['ten_pk']])->one();
                if (!empty($model->crfd_createdon)) {
                    $model->crfd_updatedon = $date;
                    $model->crfd_updatedby = $userPK;
                    $model->crfd_updatedbyipaddr = $ip_address;
                    $msg = 'Tender Notice Updated Successfully.';
                }
            } else {
                $model = new CmsrequisitionformdtlsTbl();               
                $model->crfd_createdby = $userPK;
                $model->crfd_createdbyipaddr = $ip_address;
                $model->crfd_createdon = $date;
                $msg = 'Tender Notice Created Successfully.';
                if($reqData['from_page'] == 1) {
                    $model->crfd_rqid = Common::getUniqueId('tender', 2);
                } else if($reqData['from_page'] == 2) {
                    $model->crfd_rqid = Common::getUniqueId('tender', 3);
                }
            }

            $model->crfd_type = 2; //tender

            if($reqData['project_pk'] != 'undefined') {
                $model->crfd_projectdtls_fk = Security::decrypt($reqData['project_pk']);
            }
            
            if($reqData['from_page'] == 2) {
                $contractdata = \api\modules\pms\models\CmscontracthdrTbl::find()
                ->select(['cmsch_cmsrequisitionformdtls_fk'])
                    ->where("cmscontracthdr_pk =:pk", [':pk' => $reqData['contract_pk']])
                    ->one();
                $model->crfd_cmscontracthdr_fk = $reqData['contract_pk'];

                $contractreq_data = CmsrequisitionformdtlsTbl::find()
                    ->select(['crfd_projectdtls_fk'])
                    ->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $contractdata['cmsch_cmsrequisitionformdtls_fk']])
                    ->one();
                $model->crfd_projectdtls_fk =  $contractreq_data['crfd_projectdtls_fk'];
                $model->crfd_type = 3; //Supplier Tender (when created from cmscontracthdr_tbl)
            }

            $model->crfd_rqtitle = $reqData['title'];
            $model->crfd_rqrefno = $reqData['refno'];
            $model->crfd_requester = $reqData['req_requester'];
            $model->crfd_rqpriority = $reqData['priority'];
            $model->crfd_rqprocesstype = $reqData['processtype'];
            $model->crfd_rqtype = $reqData['tendertype']; 
            $model->crfd_memcompmst_fk = $company_id;
            // $model->crfd_rqstatus = 5; //default value (In-Progress)
            $model->crfd_tenderstatus = 1;
            // $model->crfd_rqrevisionno = $reqData['rivno'];
            $model->crfd_rqdesc = $reqData['prjt_summary'];
            
            if($reqData['req_discipline'] != '' && $reqData['req_discipline'] != null) {
                $disciplinepk = \app\models\CmsdisciplinedtlsTblQuery::adddisciplinedtls($reqData['req_discipline']);
                $model->crfd_cmsdisciplinedtls_fk = $disciplinepk;
            } else {
                $model->crfd_cmsdisciplinedtls_fk = null;
            }

            if($reqData['cost_centre'] != '' && $reqData['cost_centre'] != null) {
                $costcentrepk = \app\models\CmscostcenterdtlsTblQuery::addcostcentredtls($reqData['cost_centre']);
                $model->crfd_cmscostcenterdtls_fk = $costcentrepk;
            } else {
                $model->crfd_cmscostcenterdtls_fk = null;
            }

            // $model->crfd_departmentmst_fk = implode(',',$reqData['req_departcode']);
            $model->crfd_rqdate = Common::convertDateTimeToServerTimezone($reqData['dateofreq']); 
            $model->crfd_delivreqdate = Common::convertDateTimeToServerTimezone($reqData['rosdate']);
            $model->crfd_formtype = 1;
            $model->crfd_shared_agreefk = $reqData['agreementSelecatedPk'];
            $model->crfd_shared_agreetype = $reqData['agreementSelecatedtype'];
            $model->crfd_rqclassification = $reqData['obligation'];

            $model->crfd_deliv_mcmpld_fk = $reqData['locationpk'];
            $model->crfd_remarks = $reqData['remarks'];

            if ($reqData['isdeliver'] == true) {
                $reqData['isdeliver'] = 1;
            } else {
                $reqData['isdeliver'] = 2;
            }
            
            $model->crfd_isblanketrq = $reqData['isblanket'] ? 1 : 2;
            $model->crfd_reqdeliverable = $reqData['isdeliver'];
            $model->crfd_document = $reqData['req_document'];
            if(!is_null($reqData['Commissioning_Spares'])) {
                $model->crfd_spares = implode(",", $reqData['Commissioning_Spares']);
            } else {
                $model->crfd_spares = null;
            }
            
            $model->crfd_sparesothers = $reqData['requisi_other'];
            if(!is_null($reqData['uploadexcel'])) {
                $model->crfd_rqprocesstypefile = implode(",", $reqData['uploadexcel']);
            } else {
                $model->crfd_rqprocesstypefile = null;
            }
            if ($model->save() === TRUE) {
                $reqData['subdocument'][0]['shared_fk'] = $model->cmsrequisitionformdtls_pk;
                $reqData['subdocument'][0]['docname'] = $reqData['docname'];
                $reqData['subdocument'][0]['type'] = 1;
                $reqData['subdocument'][0]['filePk'] = $reqData['upload'][0];
                if($reqData['subdocument'][0]['docname']) {
                    $save_data =  CmssupdocumentTblQuery::adddocument($reqData['subdocument'][0]);
                }
                if($reqData['mapped_req']) {
                    foreach($reqData['mapped_req'] as $key => $value) {
                        $rqmap_model = new CmsrqtendermapTbl();
                        $rqmap_model->crqtm_tender_cmsrequisitionformdtls_fk = $model->cmsrequisitionformdtls_pk;
                        $rqmap_model->crqtm_rq_cmsrequisitionformdtls_fk = $value;
                        
                        if($rqmap_model->save() !== TRUE) {
                            $result = array(
                                'status' => 200,
                                'msg' => 'warning',
                                'flag' => 'E',
                                'comments' => 'Something went wrong',
                                'returndata' => $rqmap_model->getErrors()
                            );
                        }
                    }
                } else {
                    $rqmap_model = new CmsrqtendermapTbl();
                    $rqmap_model->crqtm_tender_cmsrequisitionformdtls_fk = $model->cmsrequisitionformdtls_pk;
                    $rqmap_model->crqtm_rq_cmsrequisitionformdtls_fk = $model->cmsrequisitionformdtls_pk;
                }

                if($rqmap_model->save() !== TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $rqmap_model->getErrors()
                    );
                }

                if ($reqData['ten_pk'] != 0 && !empty($reqData['ten_pk'])) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => $msg,
                        'moduleData' => $model,
                        'cmsdd_name' => $reqData['req_discipline'],
                        'cmsccd_name' => $reqData['cost_centre'],
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $msg,
                        'moduleData' => $model,
                        'cmsdd_name' => $reqData['req_discipline'],
                        'cmsccd_name' => $reqData['cost_centre'],
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
    public function getProjectBasedTenderArray($dataPk, $dataType) {
        if ($dataType == 'CO' || $dataType == 'SC') {
            $getDataType = 2;
        } elseif ($dataType == 'PO' || $dataType == 'SO') {
            $getDataType = 1;
        } else {
            $getDataType = 0;
        }
        if ($getDataType != 0) {
            if ($dataType == 'CO' || $dataType == 'PO') {
                $module = CmsrequisitionformdtlsTbl::find()
                                ->select(['cmsrequisitionformdtls_pk as dataPk', 'crfd_rqtitle as dataName', 'crfd_rqrefno as dataRef', 'crfd_rqprocesstype as processType','crfd_rqtype as dataType'])
                                ->where('crfd_projectdtls_fk=:fk and crfd_rqtype =:dataType and crfd_type = 2 and crfd_rqprocesstype IS NOT NULL and crfd_tenderstatus != 4', [':fk' => $dataPk, ':dataType' => $getDataType])
                                ->andWhere(['<>', 'crfd_isblanketrq', 1])
                                ->orderBy('dataName ASC')
                                ->groupBy('cmsrequisitionformdtls_pk')
                                ->asArray()->All();
            } elseif ($dataType == 'SC' || $dataType == 'SO') {
                $module = CmsrequisitionformdtlsTbl::find()
                                ->select(['cmsrequisitionformdtls_pk as dataPk', 'crfd_rqtitle as dataName', 'crfd_rqrefno as dataRef', 'crfd_rqprocesstype as processType','crfd_rqtype as dataType'])  
                                ->leftJoin('cmscontracthdr_tbl', 'crfd_cmscontracthdr_fk = cmscontracthdr_pk')
                                ->where('crfd_cmscontracthdr_fk=:fk and crfd_rqtype =:dataType and crfd_type = 3 and crfd_rqprocesstype IS NOT NULL and cmsch_issubcontrqmt = 1 and crfd_tenderstatus != 4', [':fk' => $dataPk, ':dataType' => $getDataType])
                                ->andWhere(['<>', 'crfd_isblanketrq', 1])
                                ->orderBy('dataName ASC')
                                ->groupBy('cmsrequisitionformdtls_pk')
                                ->asArray()->All();
            }
        } elseif ($getDataType == 0) {
            $module = CmsrequisitionformdtlsTbl::find()
                            ->select(['cmsrequisitionformdtls_pk as dataPk', 'crfd_rqtitle as dataName', 'crfd_rqrefno as dataRef', 'crfd_rqprocesstype as processType','crfd_rqtype as dataType'])
                            ->where('crfd_projectdtls_fk=:fk and crfd_isblanketrq = 1 and crfd_type = 2 and crfd_rqprocesstype IS NOT NULL and crfd_tenderstatus != 4', [':fk' => $dataPk])
                            ->andWhere(['<>', 'crfd_rqprocesstype', 4])
                            ->orderBy('dataName ASC')
                            ->groupBy('cmsrequisitionformdtls_pk')
                            ->asArray()->All();
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module ? $module : [],
        );
        return $result;
    }

    public function autoCreatTender($formData,$proFk) {
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $dataType= $formData['dataType'];
        $processType= $formData['processType'];
        $module = CmsrequisitionformdtlsTbl::find()
                        ->select(['cmsrequisitionformdtls_pk'])
                        ->where('crfd_memcompmst_fk=:fk and crfd_projectdtls_fk = :proFk and crfd_rqprocesstype = :process and crfd_rqtype = :dataType', [':fk' => $compPK,':proFk'=> $proFk ,':process'=>$processType,':dataType'=>$dataType])->one();
        if (!empty($module)) {
            $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Tender Already Exist',
                    'tenderPk' => $module->cmsrequisitionformdtls_pk,
                );
        } elseif (empty($module)) {
            $model = new CmsrequisitionformdtlsTbl;
            $model->crfd_memcompmst_fk = $compPK;
            $model->crfd_type = 2;
            $model->crfd_rqtitle = '00**00';
            $model->crfd_rqid = Common::getUniqueId('cmsReq');
            $model->crfd_rqrefno = '00**00';
            $model->crfd_requester = $userPK;
            $model->crfd_rqprocesstype = $processType;
            $model->crfd_rqtype = $dataType;
            $model->crfd_rqdate = $date;
            $model->crfd_projectdtls_fk = $proFk;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'New Tender Created',
                    'tenderPk' => $model->cmsrequisitionformdtls_pk,
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
        }
        return $result;
    }
    public static function getTenderCount($dataPk, $dataType) {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        if ($dataType == 1) {
            $dataArray = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(cmsrequisitionformdtls_pk) as totalTender", "count(if(crfd_rqtype = 1, 1,null)) as 'productsCount'", "count(if(crfd_rqtype = 2, 1,null)) as 'serviceCount'", "count(if(crfd_rqpriority = 1, 1,null)) as 'lowPriorityCount'", "count(if(crfd_rqpriority = 2, 1,null)) as 'mediumPriorityCount'", "count(if(crfd_rqpriority = 3, 1,null)) as 'highPriorityCount'","count(if(crfd_isblanketrq = 1, 1,null)) as 'blanketCount'"])
                    ->where('crfd_projectdtls_fk=:pk and crfd_isdeleted = 2 and crfd_memcompmst_fk =:compPk and crfd_type = 2', array(':pk' => $dataPk, ':compPk' => $compPK))
                    ->asArray()
                    ->one();
        } elseif ($dataType == 2) {
            $dataArray = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(cmsrequisitionformdtls_pk) as totalTender", "count(if(crfd_rqtype = 1, 1,null)) as 'productsCount'", "count(if(crfd_rqtype = 2, 1,null)) as 'serviceCount'", "count(if(crfd_rqpriority = 1, 1,null)) as 'lowPriorityCount'", "count(if(crfd_rqpriority = 2, 1,null)) as 'mediumPriorityCount'", "count(if(crfd_rqpriority = 3, 1,null)) as 'highPriorityCount'","count(if(crfd_isblanketrq = 1, 1,null)) as 'blanketCount'"])
                    ->where('crfd_cmscontracthdr_fk=:pk and crfd_isdeleted = 2 and crfd_memcompmst_fk =:compPk and crfd_type = 3', array(':pk' => $dataPk, ':compPk' => $compPK))
                    ->asArray()
                    ->one();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'dataArray' => $dataArray,
        );
        return $result;
    }

    public function getrequisitionlistbyids($reqpk) { 
        
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $model = CmsrequisitionformdtlsTbl::find()
            ->select(['crfd_rqclassification','crfd_rqstatus','cmsccd_name','cmsdd_name','crfd_sparesothers','crfd_rqclassification','crfd_reqpercent','crfd_rqrevisionno',
                'crfd_cmsdisciplinedtls_fk','crfd_rqapproxvalue','crfd_rqprocesstype', 'crfd_rqprocesstypefile', 'crfd_rqtype', 
                'crfd_cmscostcenterdtls_fk', 'UserMst_Pk', 'um_firstname', 'UM_EmpId', 'cmsrequisitionformdtls_pk', 'crfd_rqid', 'crfd_rqtitle', 'crfd_rqrefno', 
                'crfd_requester', 'crfd_rqpriority', "date_format(crfd_rqdate,'%d-%m-%Y') as crfd_rqdate", 'crfd_projectdtls_fk', 
                'crfd_departmentmst_fk', 'DM_Name', 'crfd_rqdesc', 'crfd_rqstatement', 
                'crfd_isblanketrq', 'crfd_recurinterval', 'crfd_recurintervaltype', 'cmsdd_name',
                'crfd_reqdeliverable', 'crfd_document', 
                'crfd_spares','crfd_remarks', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prjd_projstatus', 
                'CASE WHEN `crfd_rqtype` = 1 then "Product" ELSE "Service" END as req_type',
                'CASE WHEN `crfd_rqpriority` = 1 then "Low" 
                WHEN `crfd_rqpriority` = 2 then "Medium"
                WHEN `crfd_rqpriority` = 3 then "High"
                ELSE "" END as req_priority',
                'CASE WHEN `crfd_rqclassification` = 1 then "MSME Obligation"
                WHEN `crfd_rqclassification` = 2 then "LCC Obligation"
                WHEN `crfd_rqclassification` = 3 then "MSME & LCC Obligation"
                WHEN `crfd_rqclassification` = 4 then "Others" END as req_classification',
                'CASE WHEN `prjd_projstatus` = 1 then "Yet to Submit for Validation"  
                WHEN `prjd_projstatus` = 2 then "Posted for Validation"  
                WHEN `prjd_projstatus` = 3 then "Approved"  
                WHEN `prjd_projstatus` = 4 then "Declined"  
                WHEN `prjd_projstatus` = 5 then "Re-Submitted"  
                ELSE "" END as prostatus',
                'CASE WHEN `crfd_rqstatus` = 1 then "Draft"  
                WHEN `crfd_rqstatus` = 2 then "Submitted"  
                WHEN `crfd_rqstatus` = 3 then "Approved"  
                WHEN `crfd_rqstatus` = 4 then "Declined"  
                WHEN `crfd_rqstatus` = 5 then "In-progress"  
                WHEN `crfd_rqstatus` = 6 then "Completed"  
                WHEN `crfd_rqstatus` = 7 then "Terminated"  
                WHEN `crfd_rqstatus` = 8 then "Suspended"  
                ELSE "" END as reqstatus', 'dsg_designationname as user_designation'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = crfd_requester')
            ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
            ->leftJoin('cmsdisciplinedtls_tbl', 'cmsdisciplinedtls_pk = crfd_cmsdisciplinedtls_fk')
            ->leftJoin('cmscostcenterdtls_tbl', 'cmscostcenterdtls_pk = crfd_cmscostcenterdtls_fk')
            ->leftJoin('designationmst_tbl', 'UM_Designation = designationmst_pk')
            ->where('crfd_memcompmst_fk=:pk', array(':pk' => $company_id))
            ->andWhere(['IN', 'cmsrequisitionformdtls_pk', $reqpk]);
            // ->andWhere(['!=', 'crfd_isdeleted', 1])
            // ->andWhere(['=', 'crfd_type', 1]);

            if($sortorder) {
                if($sortorder == 'new') {
                    $model->orderBy(['crfd_latesttime' => SORT_DESC]);
                } else {
                    $model->orderBy(['crfd_latesttime' => SORT_ASC]);
                }
            } else {
                $model->orderBy(['crfd_latesttime' => SORT_DESC]);
            }
            $req_list = $model->asArray()->all();

        return  $req_list;
    }

    public function checkduplicaterefid($data) {
        $refid = $data['refid'];
        $type = $data['type'];

        if($refid) {
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            $dataArray = CmsrequisitionformdtlsTbl::find()
                ->select(["count(cmsrequisitionformdtls_pk) as totalcount"])
                ->where('crfd_rqrefno=:refid and crfd_type=:type and crfd_isdeleted != 1', array(':refid' => $refid, ':type' => $type))
                ->andWhere('crfd_memcompmst_fk=:compk', array(':compk' => $company_id))
                ->asArray()
                ->one();  

            if($dataArray) {
                return $dataArray;
            } else {
                return false;
            }
        }

    }

    public function getClosureReport($reqpk, $download=null){
        $data = [];
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => $data
        );
      
        if($reqpk){
            $types = array('1' => 'RFI', '2'=> 'EOI', '3' => 'PQ', '4' => 'RFP', '5' => 'RFQ', '6' => 'RFT', '7' => 'eTender', '8' => 'eAuction');
            $projStatus = array(1 => 'Yet to Submit for Validation', 2 => 'Posted for Validation', 3 => 'Approved', 4 => 'Declined', 5 => 'Re-Submitted');
            $requisition = CmsrequisitionformdtlsTbl::findOne($reqpk);
            // get total tenders floated //
            $rfxCount = CmstenderhdrTbl::find()->select('cmsth_type, count(*) as rfxCount')->where(['cmsth_cmsrequisitionformdtls_fk' => $reqpk])->groupBy(['cmsth_type'])
            ->asArray()->all();
            $totalTenders = [];
            if(!empty($rfxCount)){
                foreach($rfxCount as $rfx){
                    if(!empty($types[$rfx['cmsth_type']])){
                        $configStatus = \Yii::$app->params['etender'][$types[$rfx['cmsth_type']]];
                        if($configStatus){
                            $totalTenders[$types[$rfx['cmsth_type']]] = $rfx['rfxCount'];
                        }
                    }
                }
            }
         
            $contractAwardedCount = 0;
            if(!empty($requisition)){
                $data = [
                    'requisition' => [
                        'title' => $requisition->crfd_rqtitle,
                        'id' => $requisition->crfd_rqid, 
                        'refno' => $requisition->crfd_rqrefno,
                        'process_type' => $requisition->crfd_rqprocesstype,
                        'notice_type'=> $requisition->crfd_rqtype,
                        'tender_date' => $requisition->crfd_rqdate,
                        'priority' => $requisition->crfd_rqpriority,
                        'status' => $requisition->crfd_tenderstatus
                    ]   
                ];
           
                if(!empty($requisition->crfdProjectdtlsFk)){
                    $project = $requisition->crfdProjectdtlsFk;
                    $data['project'] = [
                        'name' => $project->prjd_projname,
                        'id' => $project->prjd_projectid,
                        'refno' => $project->prjd_referenceno,
                        'status' => !empty($projStatus[$project->prjd_projstatus]) ? $projStatus[$project->prjd_projstatus] : ''
                    ];
                }
                if(!empty($requisition->cmscontracthdrTbls)){
                    foreach($requisition->cmscontracthdrTbls as $contract){
                        if(!empty($contract->cmsawarddtlsTbls)){
                            $contractAwardedCount += $contract->getCmsawarddtlsTbls()->count();
                        }
                    }
                }
                
                $subcontract = $requisition->getCmscontracthdrTbls()->where(['cmsch_type' => 1, 'cmsch_contracttype' => 2])->one();
                if(!empty($subcontract)){
                    $data['subcontract'] = [
                        'title' => $subcontract->cmsch_contracttitle,
                        'id' => $subcontract->cmsch_uid,
                        'refno' => $subcontract->cmsch_contractrefno,
                        'status' => $subcontract->cmsch_contractstatus,
                        'obligation' => $subcontract->cmsch_obligation
                    ];
                    
                    if(!empty($subcontract->cmschMemcompmstFk->mCMMemberRegMstFk)){
                       $memReg =  $subcontract->cmschMemcompmstFk->mCMMemberRegMstFk;
                       $compType = 'Contractor';//Supplier
                       if($memReg->mrm_stkholdertypmst_fk == 7){
                            $compType = 'Operator';
                       }
                    }
                    
                    $data['subcontract']['award'] = [];
                    if($compType == 'Contractor' && !empty($subcontract->cmsawarddtlsTo)){
                        $award = $subcontract->cmsawarddtlsTo;
                        if($award){
                            $userpk = $award->cmsadMemcompmstFk->mCMMemberRegMstFk->mrm_createdby;
                            $company_logo = \common\components\Drive::generateUrl($award->cmsadMemcompmstFk->mcm_complogo_memcompfiledtlsfk,$award->cmsadMemcompmstFk->MemberCompMst_Pk, $userpk);
                            $awardArr = [ 
                                'company' => $award->cmsadMemcompmstFk->MCM_CompanyName ? $award->cmsadMemcompmstFk->MCM_CompanyName: null,
                                'company_logo' => $company_logo,
                                'company_type' => $compType
                            ];
                            $data['subcontract']['award'] = $awardArr;
                        }      
                    }
                }

                $data['contractAwardedCount'] = $contractAwardedCount;
            }
            $data['total_tenders'] = $totalTenders;
            if($download){
                return $data;
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

    public function getTenderRfx($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $resdata = [];
        $rfxdata = [];
        if($data){
            $types = array('1' => 'RFI', '2'=> 'EOI', '3' => 'PQ', '4' => 'RFP', '5' => 'RFQ', '6' => 'RFT', '7' => 'eTender', '8' => 'eAuction');
            $tenderStatus = array( 1 => 'Yet to Submit', 2 => 'Submitted', 3 => 'Shortlisted', 4 => 'Rejected', 5 => 'Awarded', 6 => 'Terminated', 7 => 'Closed');
           
            $rfxType = $types[$data['rfxtype']];
            $configStatus = \Yii::$app->params['etender'][$rfxType];
            // $recent = !empty($data['recentRfx']) ? $data['recentRfx']: false;
        
            if($configStatus){
                $tenders = CmstenderhdrTbl::find()->where(['cmsth_cmsrequisitionformdtls_fk' => $data['reqpk'], 'cmsth_type' => $data['rfxtype']])->all();
                // if($recent){
                //     $tenders = CmstenderhdrTbl::find()->where(['cmsth_cmsrequisitionformdtls_fk' => $data['reqpk'], 'cmsth_type' => $data['rfxtype']])->orderBy(['cmstenderhdr_pk' => SORT_DESC])->groupBy('cmsth_type')->all();
                // }

                if(!empty($tenders)){
                    foreach($tenders as $tender){
                        $rfx = $types[$tender->cmsth_type];
                        $bidder_invited = !empty($tender->cmstenderresponse) ? $tender->getCmstenderresponse()->count() : 0;
                        $bidder_interested = !empty($tender->cmstenderresponse) ? $tender->getCmstenderresponse()->where(['ctr_status' => 2])->count() : 0;
                        $bidder_notinterested = !empty($tender->cmstenderresponse) ? $tender->getCmstenderresponse()->where(['ctr_status' => 8])->count() : 0;
                        $bidders_participated = !empty($tender->cmstenderresponse) ?  $tender->getCmstenderresponse()->where(['ctr_status' => 7])->count() : 0;
                        $bidders_shortlisted = !empty($tender->cmstenderresponse) ?  $tender->getCmstenderresponse()->where(['ctr_status' => 5])->count() : 0;
                        $bidders_rejected = !empty($tender->cmstenderresponse) ?  $tender->getCmstenderresponse()->where(['ctr_status' => 6])->count() : 0;

                        if(isset($resdata[$rfx])){
                            $rfxdata[] = [
                                'type' => $rfx,
                                'title' => $tender->cmsth_title,
                                'refno' => $tender->cmsth_refno,
                                'publish_date' => $tender->cmsth_initiateddate,
                                'closing_date' => $tender->cmsth_skdclosedate,
                                'status' =>  !empty($tenderStatus[$tender->cmsth_tenderstatus]) ? $tenderStatus[$tender->cmsth_tenderstatus]: '',
                                'bidders_invited' => $bidder_invited,
                                'bidders_interested' => $bidder_interested,
                                'bidders_not_interested' => $bidder_notinterested,
                                'bidders_participated' => $bidders_participated,
                                'bidders_shortlisted' => $bidders_shortlisted,
                                'bidders_rejected' => $bidders_rejected
                            ];
                        } else {
                            $rfxdata[] = [
                                'type' => $rfx,
                                'title' => $tender->cmsth_title,
                                'refno' => $tender->cmsth_refno,
                                'publish_date' => $tender->cmsth_initiateddate,
                                'closing_date' => $tender->cmsth_skdclosedate,
                                'status' =>  !empty($tenderStatus[$tender->cmsth_tenderstatus]) ? $tenderStatus[$tender->cmsth_tenderstatus]: '',
                                'bidders_invited' => $bidder_invited,
                                'bidders_interested' => $bidder_interested,
                                'bidders_not_interested' => $bidder_notinterested,
                                'bidders_participated' => $bidders_participated,
                                'bidders_shortlisted' => $bidders_shortlisted,
                                'bidders_rejected' => $bidders_rejected
                            ];
                        }    
                    }
                    $resdata['rfxdata'] = $rfxdata;
                    $resdata['contract_awards'] = self::getReqContractAwards($data);
                }
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $resdata
            );
       }
        return  $result;
    }

    public function getTenderRfxDownload($data){
        $resdata = [];
        $rfxdata = [];
        if($data){
            // $recent = !empty($data['recentRfx']) ? $data['recentRfx']: false;
            $tenders = CmstenderhdrTbl::find()->where(['cmsth_cmsrequisitionformdtls_fk' => $data['reqpk']])->all();
            // if($recent){
            //     $tenders = CmstenderhdrTbl::find()->where(['cmsth_cmsrequisitionformdtls_fk' => $data['reqpk']])->orderBy(['cmstenderhdr_pk' => SORT_DESC])->groupBy('cmsth_type')->all();
            // }
        
            if(!empty($tenders)){
                foreach($tenders as $tender){
                    $rfx = $types[$tender->cmsth_type];
                    $bidder_invited = !empty($tender->cmstenderresponse) ? $tender->getCmstenderresponse()->count() : 0;
                    $bidder_interested = !empty($tender->cmstenderresponse) ? $tender->getCmstenderresponse()->where(['ctr_status' => 2])->count() : 0;
                    $bidder_notinterested = !empty($tender->cmstenderresponse) ? $tender->getCmstenderresponse()->where(['ctr_status' => 8])->count() : 0;
                    $bidders_participated = !empty($tender->cmstenderresponse) ?  $tender->getCmstenderresponse()->where(['ctr_status' => 7])->count() : 0;
                    if(isset($resdata[$rfx])){
                        $rfxdata[] = [
                            'type' => $rfx,
                            'title' => $tender->cmsth_title,
                            'refno' => $tender->cmsth_refno,
                            'publish_date' => $tender->cmsth_initiateddate,
                            'closing_date' => $tender->cmsth_skdclosedate,
                            'status' => $tender->cmsth_tenderstatus,
                            'bidders_invited' => $bidder_invited,
                            'bidders_interested' => $bidder_interested,
                            'bidders_not_interested' => $bidder_notinterested,
                            'bidders_participated' => $bidders_participated
                        ];
                    } else {
                        $rfxdata[] = [
                            'type' => $rfx,
                            'title' => $tender->cmsth_title,
                            'refno' => $tender->cmsth_refno,
                            'publish_date' => $tender->cmsth_initiateddate,
                            'closing_date' => $tender->cmsth_skdclosedate,
                            'bidders_invited' => $bidder_invited,
                            'bidders_interested' => $bidder_interested,
                            'bidders_not_interested' => $bidder_notinterested,
                            'bidders_participated' => $bidders_participated
                        ];
                    }    
                }
                $resdata['rfxdata'] = $rfxdata;
                $resdata['contract_awards'] = self::getReqContractAwardsdownload($data['reqpk'], $data['rfxtype']);
            }
        }
        return  $resdata;
    }

    public function getReqContractAwards($data){
        $reqpk = $data['reqpk'];
        $rfxtype = $data['rfxtype'];
        $size = Security::sanitizeInput($data['size'], "number");
        $page = Security::sanitizeInput($data['page'], "number");
        
        $searchTxt = Security::sanitizeInput($data['search'], "string_spl_char");
        $jsrsQ = "(CASE WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate >= DATE(NOW())) THEN 'Active' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate < DATE(NOW())) THEN 'Expired' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'V' AND MRM_ValSubStatus <> 'A' AND MRM_OrderConfrmStat = 'A') THEN 'Yet to Certify' WHEN (cmsnjsd_memberregmst_fk = 0 OR (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'I' AND MRM_OrderConfrmStat <> 'A')) THEN 'Yet to Register' ELSE 'In-active' END)";
        
        $query = CmscontracthdrTbl::find()
        ->select(['cmsch_uid','MCM_CompanyName as jsrsCompanyName', 'MemberCompMst_Pk', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'MCM_SupplierCode', 'cmsad_awardedon', 'cmsad_classification', $jsrsQ.' AS jsrsstatus'])
        ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsch_initiatedby')
        ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
        ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
        ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = prjd_memberregmst_fk')
        ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_pk = cmsch_cmstenderhdr_fk')
        ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk=cmsad_memcompmst_fk')
        ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmsad_cmsnonjsrssupmap_fk')
        ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
        ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = MCM_Source_CountryMst_Fk')
        ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
        ->where('cmsch_cmsrequisitionformdtls_fk=:pk', array(':pk' => $reqpk))
        ->andwhere('cmsth_type=:type', array(':type' => $rfxtype));
        
        $provider = new ActiveDataProvider(['query' => $query]);
        $count = $provider->getTotalCount();

        if($searchTxt){
            $query->andFilterWhere(['like', 'MCM_SupplierCode', $searchTxt])
            ->orFilterWhere(['like', 'MCM_CompanyName', $searchTxt])
            ->orFilterWhere(['like', 'cnjsm_orgname', $searchTxt])
            ->orFilterWhere(['like', 'jsrsCountry.CyM_CountryName_en', $searchTxt])
            ->orFilterWhere(['like', 'nonjsrsCountry.CyM_CountryName_en', $searchTxt])
            ->orFilterWhere(['like', 'cmsad_awardedon', $searchTxt]);
        }
        
        $query->asArray();
       
        $page = (!empty($size)) ? $size : 5;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['page' => $data['page'], 'pageSize' => $data['size']]]);
       
        $finalData = [];
        foreach ($provider->getModels() as $listData){
            $finalData[] = [ 
                'jsrs_supplier_code' =>  $listData['MCM_SupplierCode'],
                'company' => $listData['jsrsCompanyName'] ? $listData['jsrsCompanyName'] : $listData['nonJsrsCompanyName'],
                'country' => $listData['jsrsCountryname'] ? $listData['jsrsCountryname'] : $listData['nonjsrsCountryname'],
                'classification' => $listData['cmsad_classification'],
                'jsrs_status' => $listData['jsrsstatus'],
                'awarded_on' => $listData['cmsad_awardedon']
            ];
        }
        return [
            'list' => $finalData,
            'total_count' => $count
        ];
    }

    public function getReqContractAwardsdownload($reqpk){
        $contractArr = [];
        $obligation = [1 => 'MSME', 2 => 'LCC', 3 => 'MSME & LCC', 4 => 'Others', 5 => 'Not Applicable'];
        if($reqpk){
            $contracts = \api\modules\pms\models\CmscontracthdrTbl::find()
                ->where("cmsch_cmsrequisitionformdtls_fk =:pk", [':pk' => $reqpk])
                ->all();

            if(!empty($contracts)){
                foreach($contracts as $contract){
                    $awardedArr = [];
                    if(!empty($contract->cmsawarddtlsTbls)){
                        foreach($contract->cmsawarddtlsTbls as $award){
                            if($award->cmsadMemcompmstFk->MCM_CountryMst_Fk){
                                $awarded_country = $award->cmsadMemcompmstFk->mCMCountryMstFk;
                            }
                            $awardedArr[] = [ 
                                'jsrs_supplier_code' =>  $award->cmsadMemcompmstFk->MCM_SupplierCode ?  $award->cmsadMemcompmstFk->MCM_SupplierCode: null,
                                'company' => $award->cmsadMemcompmstFk->MCM_CompanyName ? $award->cmsadMemcompmstFk->MCM_CompanyName: null,
                                'country' => $awarded_country ? $awarded_country->CyM_CountryName_en:'',
                                'classification' => $award->cmsad_classification ? $award->cmsad_classification : null,
                                'jsrs_status' =>  ($award->cmsadMemcompmstFk) ?$award->cmsadMemcompmstFk->getJsrsstatus('awarded'): '',
                                'awarded_on' => $award->cmsad_awardedon
                            ];
                        }
                        $contractArr[] = [ 
                            'contract_id' => $contract->cmsch_uid,
                            'contract_refno' =>  $contract->cmsch_contractrefno,
                            'contract_title' => $contract->cmsch_contracttitle,
                            'obligation' => !empty($obligation[$contract->cmsch_obligation]) ? $obligation[$contract->cmsch_obligation] : '',
                            'awarded' => $awardedArr
                        ];
                       
                    }
                }
            }
        }
        return  $contractArr;
    }

    public static function getTotalRequisition($dataPk, $dataType) {
        if ($dataType == 1) {
            $obligatedEnquiries = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(if(crfd_isblanketrq = 1, 1,null)) as 'blankt'",
                        "count(cmsrequisitionformdtls_pk) as 'totalReq'",
                        "count(if(crfd_rqtype = 1, 1,null)) as 'reqProduct'",
                        "count(if(crfd_rqtype = 2, 1,null)) as 'reqService'", 
                        "ROUND(SUM(crfd_rqapproxvalue * 2.60080),2) as 'reqValueUSD'",
                        "ROUND(SUM(crfd_rqapproxvalue / 2.60080),3) as 'reqValueOMR'",
                        "count(if(crfd_isblanketrq = 1 and crfd_rqtype = 1, 1,null)) as 'blanktProduct'",
                        "count(if(crfd_isblanketrq = 1 and crfd_rqtype = 2, 1,null)) as 'blanktService'",])
                    ->where('crfd_memcompmst_fk=:pk and crfd_isdeleted = 2 and crfd_type = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        } 
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'obligatedEnquiries' => $obligatedEnquiries,
        );
        return $result;
    }

    public function downloadClosureReport($data){
        $resdata = [];
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => $data
        );
        $download = true;
        if($data['reqpk']){
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $user = UsermstTbl::findOne($userPK);
            $resdata = self::getClosureReport($data['reqpk'], $download);
            $resdata['tenderRfx'] = self::getTenderRfxDownload($data);
            $resdata['downloaded_date'] = date('d-m-Y H:i:s');
            $resdata['downloaded_by'] = $user->um_firstname.' '.$user->um_lastname;
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $resdata
            );
        }
        return $result;
    }
}
