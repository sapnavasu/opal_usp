<?php

namespace api\modules\mst\models;

use common\components\Drive;

/**
 * This is the ActiveQuery class for [[ApprovalworkflowuserconfigTbl]].
 *
 * @see ApprovalworkflowuserconfigTbl
 */
class ApprovalworkflowuserconfigTblQuery extends \yii\db\ActiveQuery {

    /**
     * {@inheritdoc}
     * @return ApprovalworkflowuserconfigTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ApprovalworkflowuserconfigTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function getLevelOfAuthorityUserdata($form, $compk) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $query = ApprovalworkflowuserconfigTbl::find()
                ->select([
                    'approvalworkflowuserconfig_pk',
                    'awfct_level level',
                    'awfct_minactionreq minactionreq',
                    'awfuc_isfinalapprauthority isfinalapprauthority',
                    'awfuc_orderofapp order',
                    'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                    'UM_EmpId empid',
                    'DM_Name division',
                    'dsg_designationname designation',
                    'CyM_CountryDialCode countrycode',
                    'um_primobno contact',
                    'UM_EmailID email',
                    'UM_Status usersts',
                    'awfuc_usermst_fk as userPk',
                    'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) last_validated_by',
                    'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                    'certapprovaldtls_pk',
                    'awfuc_approvallevel as approvalLevel'
                ])
                ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                ->leftJoin('certapprovaldtls_tbl','approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk')
                ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                ->leftJoin('countrymst_tbl', 'um_primobnocc = CountryMst_Pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk=awfuc_departmentmst_fk')
                ->leftJoin('designationmst_tbl', 'designationmst_pk=UM_Designation')
                ->where([
                    'awfcd_formmst_fk' => $form,
                    'frm_isworkflowapprapplicable' => 1,
                ])
                ->andWhere("UM_Status='A' AND UM_MemberRegMst_Fk = 1")
                ->orderBy('awfct_level, awfuc_orderofapp')
                ->asArray();
        
        $result = $query->all();  
        $count = count($result);              
        foreach ($result as $key => $dataVal) {
            if ($dataVal['userPk'] == $userPK) {     
                $dataVal['userlevel'] = $dataVal['level'];
                 $current_user = $dataVal;
                 break;
            }
        }

        if ($current_user['approvalLevel']) {
            $current_user['canvalidate'] = 1;
        } else {
            $current_user['canvalidate'] = 0;
        }
        $currentuserValidationSts = \api\modules\mst\models\CertapprovaldtlsTbl::find()
                ->select([
                    "cad_actioncompleted as actionCompleted",
                    "cad_updatedon as actionDoneOn"
                ])
                ->leftJoin('approvalworkflowuserconfig_tbl','approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk')
                ->where(['cad_membercompanymst_fk' => $compk,'awfuc_usermst_fk' => $userPK])
                ->orderBy('certapprovaldtls_pk DESC')
                ->asArray()
                ->one();
        if ($count) {
            $result = array_map(function($val) {
                $dpObj = json_decode($val['userdp']);
                $val['userdp'] = Drive::generateUrl($dpObj->pk, $dpObj->comp_pk, $dpObj->uploadedby);
                return $val;
            }, $result);
        }

        return [
            'count' => $count,
            'result' => $result,
            'current_user' => $current_user,
            'currentuserValidationSts' => $currentuserValidationSts
        ];
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function getValidateHistory($formData) {
        $formpk = \common\components\Security::sanitizeInput($formData['form'], "number");
        $companypk = \common\components\Security::decrypt($formData['compid']);
        $formdesc = \common\components\Security::sanitizeInput($formData['formdesc'], "number");
        $category = \common\components\Security::sanitizeInput($formData['category'], "number");
        $subcategory = \common\components\Security::sanitizeInput($formData['subcategory'], "number");
        $type = \common\components\Security::sanitizeInput($formData['type'], "string");
        $paramvalP = \common\components\Security::sanitizeInput($formData['paramvalP'], "number");
        $srcPk = \common\components\Security::sanitizeInput($formData['srcPk'], "number");
        
        if ($type == 'SCT') {
            $query = ApprovalworkflowuserconfigTbl::find()
                    ->select([
                        'awfct_level level',
                        'awfct_minactionreq minactionreq',
                        'awfuc_isfinalapprauthority isfinalapprauthority',
                        'awfuc_orderofapp order',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                        'DATE_FORMAT(ccscad_updatedon, "%d-%m-%Y") validated_on',
                        'ccscad_status status',
                        'ccscad_comments comment'
                    ])
                    ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                    ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                    ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                    ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                    ->innerJoin('certcatsubcatapprovaldtls_tbl', 'ccscad_certapprovaldtls_fk=certapprovaldtls_pk')
                    ->innerJoin('suppcertformtrntmp_tbl', 'ccscad_suppcertformtrntmp_fk=suppcertformtrntmp_pk')
                    ->innerJoin('suppcertformcattmp_tbl', 'ccscad_suppcertformcattmp_fk = suppcertformcattmp_pk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                    ->where([
                        'awfcd_formmst_fk' => $formpk,
                        'cad_membercompanymst_fk' => $companypk,
                        'scftt_bgivaldocformdescmst_fk' => $formdesc,
                        'frm_isworkflowapprapplicable' => 1
                    ])
                    ->andWhere('ccscad_isvalidated = 1')
                    ->asArray();
        }
        elseif ($type == 'CT') {
            $query = ApprovalworkflowuserconfigTbl::find()
                    ->select([
                        'awfct_level level',
                        'awfct_minactionreq minactionreq',
                        'awfuc_isfinalapprauthority isfinalapprauthority',
                        'awfuc_orderofapp order',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                        'DATE_FORMAT(ccscad_updatedon, "%d-%m-%Y") validated_on',
                        'ccscad_status status',
                        'ccscad_comments comment'
                    ])
                    ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                    ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                    ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                    ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                    ->innerJoin('certcatsubcatapprovaldtls_tbl', 'ccscad_certapprovaldtls_fk=certapprovaldtls_pk')
                    ->innerJoin('suppcertformcattmp_tbl', 'ccscad_suppcertformcattmp_fk=suppcertformcattmp_pk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                    ->where([
                        'awfcd_formmst_fk' => $formpk,
                        'cad_membercompanymst_fk' => $companypk,
                        'scfct_bgivaldoccatmst_fk' => $category,
                        'frm_isworkflowapprapplicable' => 1
                    ])
                    ->andWhere('ccscad_suppcertformtrntmp_fk IS NULL AND ccscad_isvalidated = 1')
                    ->asArray();
        }
        elseif ($type == 'P') {
            $getparameters = CertapprovalpardtlsTbl::find()
                    ->select('certapprovaltrndtls_pk')
                    ->leftJoin('suppcertformpartrntmp_tbl', 'catd_suppcertformpartrntmp_fk = suppcertformpartrntmp_pk')
                    ->leftJoin('suppcertformtrntmp_tbl', 'scfptt_suppcertformtrntmp_fk = suppcertformtrntmp_pk')
                    ->leftJoin('suppcertformcattmp_tbl', 'scftt_suppcertformcattmp_fk = suppcertformcattmp_pk')
                    ->leftJoin('suppcertformmembtmp_tbl', 'scfct_suppcertformmembtmp_fk = suppcertformmembtmp_pk')
                    ->where('scfmt_membercompmst_fk = :comPk AND scfct_bgivaldoccatmst_fk = :cat', [':comPk' => $companypk, ':cat' => $category]);
            if (!empty($subcategory)) {
                $getparameters->andWhere('scfptt_bgivaldocsubcatmst_fk =:subcat', [':subcat' => $subcategory]);
            }
            $getparameters = $getparameters->asArray()->all();

            $query = ApprovalworkflowuserconfigTbl::find()
                    ->select([
                        'awfct_level level',
                        'awfct_minactionreq minactionreq',
                        'awfuc_isfinalapprauthority isfinalapprauthority',
                        'awfuc_orderofapp order',
                        'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                        'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                        'DATE_FORMAT(catd_updatedon, "%d-%m-%Y") validated_on',
                        'catd_status status',
                        'catd_comments comment'
                    ])
                    ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                    ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                    ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                    ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                    ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                    ->innerJoin('certapprovalpardtls_tbl', 'catd_certapprovaldtls_fk = certapprovaldtls_pk')
                    ->where(['IN', 'certapprovaltrndtls_pk', $getparameters])
                    ->andWhere('catd_isvalidated = 1')
                    ->asArray();
        } elseif ($type == 'PPV') {
            if ($category == 3) {
                $query = ApprovalworkflowuserconfigTbl::find()
                        ->select([
                            'awfct_level level',
                            'awfct_minactionreq minactionreq',
                            'awfuc_isfinalapprauthority isfinalapprauthority',
                            'awfuc_orderofapp order',
                            'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                            'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                            'DATE_FORMAT(mctbad_updatedon, "%d-%m-%Y") validated_on',
                            'mctbad_status status',
                            'mctbad_comments comment'
                        ])
                        ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                        ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                        ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                        ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                        ->innerJoin('memcomptendbrdapprovalmain_tbl', 'mctbam_certapprovaldtls_fk=certapprovaldtls_pk')
                        ->innerJoin('memcomptendbrdapprovaldtls_tbl', 'mctbad_memcomptendbrdapprovalmain_fk=memcomptendbrdapprovalmain_pk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                        ->where([
                            'awfcd_formmst_fk' => $formpk,
                            'cad_membercompanymst_fk' => $companypk,
                            'frm_isworkflowapprapplicable' => 1,
                            'mctbad_memcomptendbrdtemp_fk' => $paramvalP
                        ])
                        ->andWhere('mctbad_isvalidated = 1')
                        ->asArray();
            }
            if ($category == 4) {
                $query = ApprovalworkflowuserconfigTbl::find()
                        ->select([
                            'awfct_level level',
                            'awfct_minactionreq minactionreq',
                            'awfuc_isfinalapprauthority isfinalapprauthority',
                            'awfuc_orderofapp order',
                            'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                            'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                            'DATE_FORMAT(mcbad_updatedon, "%d-%m-%Y") validated_on',
                            'mcbad_status status',
                            'mcbad_comments comment'
                        ])
                        ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                        ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                        ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                        ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                         ->innerJoin('memcompbranchapprovalmain_tbl', 'mcbam_certapprovaldtls_fk=certapprovaldtls_pk')
                        ->innerJoin('memcompbranchapprovaldtls_tbl', 'mcbad_memcompbranchapprovalmain_fk=memcompbranchapprovalmain_pk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                        ->where([
                            'awfcd_formmst_fk' => $formpk,
                            'cad_membercompanymst_fk' => $companypk,
                            'frm_isworkflowapprapplicable' => 1,
                            'mcbad_memcompbranchdtlstemp_fk' => $paramvalP
                        ])
                        ->andWhere('mcbad_isvalidated = 1')
                        ->asArray();
            }
            if ($category == 5) {
                $query = ApprovalworkflowuserconfigTbl::find()
                        ->select([
                            'awfct_level level',
                            'awfct_minactionreq minactionreq',
                            'awfuc_isfinalapprauthority isfinalapprauthority',
                            'awfuc_orderofapp order',
                            'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                            'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                            'DATE_FORMAT(mcfad_updatedon, "%d-%m-%Y") validated_on',
                            'mcfad_status status',
                            'mcfad_comments comment'
                        ])
                        ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                        ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                        ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                        ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                        ->innerJoin('memcompfinancialapprovalmain_tbl', 'mcfam_certapprovaldtls_fk=certapprovaldtls_pk')
                        ->innerJoin('memcompfinancialapprovaldtls_tbl', 'mcfad_memcompfinancialapprovalmain_fk=memcompfinancialapprovalmain_pk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                        ->where([
                            'awfcd_formmst_fk' => $formpk,
                            'cad_membercompanymst_fk' => $companypk,
                            'frm_isworkflowapprapplicable' => 1,
                            'mcfad_memcompfinancialtemp_fk' => $paramvalP
                        ])
                        ->andWhere('mcfad_isvalidated = 1')
                        ->asArray();
            }
            if ($category == 10) {
                $query = ApprovalworkflowuserconfigTbl::find()
                        ->select([
                            'awfct_level level',
                            'awfct_minactionreq minactionreq',
                            'awfuc_isfinalapprauthority isfinalapprauthority',
                            'awfuc_orderofapp order',
                            'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                            'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                            'DATE_FORMAT(mcshad_updatedon, "%d-%m-%Y") validated_on',
                            'mcshad_status status',
                            'mcshad_comments comment'
                        ])
                        ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
                        ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
                        ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
                        ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
                        ->innerJoin('memcompshareholderapprovalmain_tbl', 'mcsham_certapprovaldtls_fk=certapprovaldtls_pk')
                        ->innerJoin('memcompshareholderapprovaldtls_tbl', 'mcshad_memcompshareholderapprovalmain_fk=memcompshareholderapprovalmain_pk')
                        ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
                        ->where([
                            'awfcd_formmst_fk' => $formpk,
                            'cad_membercompanymst_fk' => $companypk,
                            'frm_isworkflowapprapplicable' => 1,
                            'mcshad_memcompshareholderdtls_fk' => $paramvalP
                        ])
                        ->andWhere('mcshad_isvalidated = 1')
                        ->asArray();
            }
        }  
        elseif ($type == 'BV') {
            $query = ApprovalworkflowuserconfigTbl::find()
            ->select([
                'awfct_level level',
                'awfct_minactionreq minactionreq',
                'awfuc_isfinalapprauthority isfinalapprauthority',
                'awfuc_orderofapp order',
                'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                'DATE_FORMAT(mcbsad_updatedon, "%d-%m-%Y") validated_on',
                'mcbsad_status status',
                'mcbsad_comments comment'
            ])
            ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
            ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
            ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
            ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
            ->InnerJoin('memcompbussrcapprovalmain_tbl','mcbsam_certapprovaldtls_fk=certapprovaldtls_pk')
            ->InnerJoin('memcompbussrcapprovaldtls_tbl','mcbsad_memcompbussrcapprovalmain_fk=memcompbussrcapprovalmain_pk')
            ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
            ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
            ->where([
                'awfcd_formmst_fk' => $formpk,
                'cad_membercompanymst_fk' => $companypk,
                'mcbsad_memcompbussrcdtls_fk' => $srcPk,
                'frm_isworkflowapprapplicable' => 1,
            ])
                    ->andWhere('mcbsad_isvalidated = 1')
                    ->asArray();
        }
        elseif ($type == 'PV') {
            $query = ApprovalworkflowuserconfigTbl::find()
            ->select([
                'awfct_level level',
                'awfct_minactionreq minactionreq',
                'awfuc_isfinalapprauthority isfinalapprauthority',
                'awfuc_orderofapp order',
                'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                'DATE_FORMAT(mcpad_updatedon, "%d-%m-%Y") validated_on',
                'mcpad_status status',
                'mcpad_comments comment'
            ])
            ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
            ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
            ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
            ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
            ->InnerJoin('memcompprodapprovalmain_tbl','mcpam_certapprovaldtls_fk=certapprovaldtls_pk')
            ->InnerJoin('memcompprodapprovaldtls_tbl','mcpad_memcompprodapprovalmain_fk=memcompprodapprovalmain_pk')
            ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
            ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
            ->where([
                'awfcd_formmst_fk' => $formpk,
                'cad_membercompanymst_fk' => $companypk,
                'mcpad_memcompproddtls_fk' => $srcPk,
                'frm_isworkflowapprapplicable' => 1,
            ])
                    ->andWhere('mcpad_isvalidated = 1')
                    ->asArray();
        } 
        elseif ($type == 'SV') {
            $query = ApprovalworkflowuserconfigTbl::find()
            ->select([
                'awfct_level level',
                'awfct_minactionreq minactionreq',
                'awfuc_isfinalapprauthority isfinalapprauthority',
                'awfuc_orderofapp order',
                'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                'DATE_FORMAT(mcsad_updatedon, "%d-%m-%Y") validated_on',
                'mcsad_status status',
                'mcsad_comments comment'
            ])
            ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
            ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
            ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
            ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
            ->InnerJoin('memcompserviceapprovalmain_tbl','mcsam_certapprovaldtls_fk=certapprovaldtls_pk')
            ->InnerJoin('memcompserviceapprovaldtls_tbl','mcsad_memcompserviceapprovalmain_fk=memcompserviceapprovalmain_pk')
            ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
            ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
            ->where([
                'awfcd_formmst_fk' => $formpk,
                'cad_membercompanymst_fk' => $companypk,
                'mcsad_memcompservicedtls_fk' => $srcPk,
                'frm_isworkflowapprapplicable' => 1,
            ])
                    ->andWhere('mcsad_isvalidated = 1')
                    ->asArray();
        } 
        else{
            $query = ApprovalworkflowuserconfigTbl::find()
            ->select([
                'awfct_level level',
                'awfct_minactionreq minactionreq',
                'awfuc_isfinalapprauthority isfinalapprauthority',
                'awfuc_orderofapp order',
                'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) name',
                'JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby) userdp',
                'DATE_FORMAT(ccscad_updatedon, "%d-%m-%Y") validated_on',
                'ccscad_status status',
                'ccscad_comments comment'
            ])
            ->innerJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk=awfuc_approvalworkflowconfigtrns_fk')
            ->innerJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk=awfct_approvalworkflowconfigdtls_fk')
            ->innerJoin('formmst_tbl', 'formmst_pk=awfcd_formmst_fk')
            ->innerJoin('certapprovaldtls_tbl', 'cad_approvalworkflowuserconfig_fk=approvalworkflowuserconfig_pk')
            ->innerJoin('certcatsubcatapprovaldtls_tbl', 'ccscad_certapprovaldtls_fk=certapprovaldtls_pk')
            ->innerJoin('suppcertformcattmp_tbl', 'ccscad_suppcertformcattmp_fk=suppcertformcattmp_pk')
            ->leftJoin('usermst_tbl', 'UserMst_Pk=awfuc_usermst_fk')
            ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=um_userdp')
            ->where([
                'awfcd_formmst_fk' => $formpk,
                'cad_membercompanymst_fk' => $companypk,
                'scfct_bgivaldoccatmst_fk' => $category,
                'frm_isworkflowapprapplicable' => 1
            ])
            ->groupBy("scfct_bgivaldoccatmst_fk")
            ->asArray();
        }
        $count = $query->count();
        $result = $query->all();
        if ($count) {
            $result = array_map(function($val) {
                $dpObj = json_decode($val['userdp']);
                $val['userdp'] = Drive::generateUrl($dpObj->pk, $dpObj->comp_pk, $dpObj->uploadedby);
                return $val;
            }, $result);
        }
        $total_levels_configrd = \api\modules\mst\models\ApprovalworkflowconfigtrnsTbl::find()->select(['awfct_level as totalLevels'])->asArray()->all();
        $totalLevels = max($total_levels_configrd);
        return [
            'count' => $count,
            'result' => $result,
            'totalLevels' => $totalLevels
        ];
    }

    public function getusers($level, $formid) {
        $query = \api\modules\mst\models\ApprovalworkflowuserconfigTbl::find()
                ->select([
                    'CONCAT_WS(" ", um_firstname, um_middlename, um_lastname) as levelusername',
                    'UserMst_Pk as userpk'
                ])
                ->leftJoin('approvalworkflowconfigtrns_tbl', 'approvalworkflowuserconfigtrns_pk = awfuc_approvalworkflowconfigtrns_fk')
                ->leftJoin('approvalworkflowconfigdtls_tbl', 'approvalworkflowconfigdtls_pk = awfct_approvalworkflowconfigdtls_fk')
                ->leftJoin('usermst_tbl', 'UserMst_Pk = awfuc_usermst_fk')
                ->where(['awfct_level' => $level, 'awfcd_formmst_fk' => $formid])
                ->andWhere("UM_Status='A' AND UM_MemberRegMst_Fk = 1")
                ->asArray()
                ->all();
        return $query;
    }

    public function getleveldata($formpk, $userPK, $compkarr, $catsubcatPkarr) {
        $result = [];
        for ($pk = 0; $pk < count($compkarr); $pk++) {
            $compk = $compkarr[$pk];
            $catsubcatPk = $catsubcatPkarr[$pk];
            $suppformid = \common\models\SuppcertformmembtmpTbl::find()
                    ->where('scfmt_formmst_fk=:formid and scfmt_membercompmst_fk=:company', [':company' => $compk, ':formid' => $formpk])
                    ->one();
            $levelusersconfig = \api\modules\mst\models\ApprovalworkflowuserconfigTblQuery::getLevelOfAuthorityUserdata($formpk, $compk);
            $currentUserData = $levelusersconfig['current_user'];
            if (!empty($suppformid) && !empty($currentUserData)) {   
                $movetonextuser = \api\modules\mst\models\CertapprovaldtlsTbl::find()
                        ->select([
                            '*'
                        ])
                        ->leftJoin('certcatsubcatapprovaldtls_tbl', "ccscad_certapprovaldtls_fk = certapprovaldtls_pk")
                        ->leftJoin('approvalworkflowuserconfig_tbl',"cad_approvalworkflowuserconfig_fk = approvalworkflowuserconfig_pk")
                        ->where(['cad_membercompanymst_fk' => $compk, 'cad_suppcertformmembtmp_fk' => $suppformid['suppcertformmembtmp_pk']])
                        ->andWhere('awfuc_usermst_fk =:userpk',[':userpk' => $userPK])
                        ->one();
                $apprdclnby = \api\modules\mst\models\CertcatsubcatapprovaldtlsTbl::find()
                                ->leftJoin('certapprovaldtls_tbl', "ccscad_certapprovaldtls_fk = certapprovaldtls_pk")
                                ->where(['cad_membercompanymst_fk' => $compk, 'cad_suppcertformmembtmp_fk' => $suppformid['suppcertformmembtmp_pk']])
                                ->one();
                $certpk = $movetonextuser->certapprovaldtls_pk;
                $compOrg = \api\modules\mst\models\MembercompanymstTbl::find()
                        ->where(['MemberCompMst_Pk' => $compk])
                        ->one();
                $overallcount = \api\modules\mst\models\CertcatsubcatapprovaldtlsTbl::find()
                        ->where('ccscad_certapprovaldtls_fk =:certpk AND ccscad_suppcertformtrntmp_fk IS NULL AND ccscad_status IN (1,2)', [':certpk' => $certpk])
                        ->count();
                $specificcount = \api\modules\mst\models\ApprovalworkflowspecTbl::find()
                        ->where(['approvalworkflowspec_pk' => $currentUserData['approvalworkflowuserconfig_pk']])
                        ->count();
                
                if ($compOrg['MCM_Origin'] == 'N') { //National
                    if (($currentUserData['approvalLevel'] == 1 && ($overallcount == 9)) || ($currentUserData['approvalLevel'] == 2 && $specificcount)) {
                        $movetonextuser->cad_actioncompleted = 2;
                        $movetonextuser->cad_updatedon = date('Y-m-d H:i:s');
                        $apprdclnby->ccscad_apprdclnby = $userPK;
                        $movetonextuser->save();
                        $apprdclnby->save();
                        $certpk = $movetonextuser->certapprovaldtls_pk;
                        if (!empty($movetonextuser)) {                           
                            $nextleveluserpk = \common\components\Suppcertform::getuseridfornextuser($userPK, $currentUserData['userlevel'], $formpk);
                            if ($currentUserData['order'] == $currentUserData['minactionreq']) {
                                 \common\components\Suppcertform::changevalidationsts($compk,$certpk,$userPK,$movetonextuser->cad_approvalworkflowuserconfig_fk);
                                $dataresult = \api\modules\mst\models\CertapprovaldtlsTblQuery::movenextlevel($compk, $catsubcatPk);
                                \common\components\Suppcertform::scfauditloginsertion($compk, 6, "", $userPK,$certpk);
                                \common\components\Suppcertform::datainsertiontofinaluser($compk, $formpk, $nextleveluserpk, $certpk);
                                $result = $dataresult;
                            } else {
                                \common\components\Suppcertform::datainsertiontofinaluser($compk, $formpk, $nextleveluserpk, $certpk);
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'Success',
                                    'flag' => 'S'
                                );
                            }
                        }
                    }
                } elseif ($compOrg['MCM_Origin'] == 'I') { //International
                    if (($currentUserData['approvalLevel'] == 1 && $overallcount == 3) || ($currentUserData['approvalLevel'] == 2 && $specificcount)) {
                        $movetonextuser->cad_actioncompleted = 2;
                        $movetonextuser->cad_updatedon = date('Y-m-d H:i:s');
                        $apprdclnby->ccscad_apprdclnby = $userPK;
                        $movetonextuser->save();
                        $apprdclnby->save();
                        $certpk = $movetonextuser->certapprovaldtls_pk;
                        if (!empty($movetonextuser)) {
                            $nextleveluserpk = \common\components\Suppcertform::getuseridfornextuser($userPK, $currentUserData['userlevel'], $formpk);
                            if ($currentUserData['order'] == $currentUserData['minactionreq']) {
                                 \common\components\Suppcertform::changevalidationsts($compk,$certpk,$userPK,$movetonextuser->cad_approvalworkflowuserconfig_fk);
                                $dataresult = \api\modules\mst\models\CertapprovaldtlsTblQuery::movenextlevel($compk, $catsubcatPk);
                                \common\components\Suppcertform::scfauditloginsertion($compk,6,"",$userPK,$certpk);
                                \common\components\Suppcertform::datainsertiontofinaluser($compk, $formpk, $nextleveluserpk, $certpk);
                                return $dataresult;
                            }
                            $result = array(
                                'status' => 200,
                                'msg' => 'Success',
                                'flag' => 'S'
                            );
                        }
                    }
                }
            }
        }
        if(!empty($result)){
            return $result;
        }  else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E'
            );
        }
    }

}
