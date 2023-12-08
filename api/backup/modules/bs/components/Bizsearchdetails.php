<?php

namespace api\modules\bs\components;

use common\components\Security;
use api\modules\svf\controllers\SvfController;
use \api\modules\bs\components\Bizsearch;
use \common\models\UsermstTbl;
use \common\models\MemcompacomplishdtlsTbl;
use \common\models\MemcompmplocationdtlsTbl;
use \common\models\MemcompsectordtlsTbl;
use \common\models\MemcompproddtlsTbl;
use \common\models\MembercompanymstTbl;
use \common\models\MemcompprdserfollowdtlsTbl;
use \common\models\MemcompquantitypriceTbl;
use \common\models\MemcompprodspecdtlsTbl;
use common\components\Drive;
use common\models\MemcompproddtlsmainTbl;
use common\models\MemcompservspecdtlsTbl;
use common\models\SezadecertitrackingTbl;
use common\models\SezadregtmpTbl;
use yii\db\Expression;
use api\modules\mst\models\UnspcbipcmappingTbl;

use Yii;


class Bizsearchdetails {

    public static function getUserDetails($userPk){
        $loginusrpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $userDetails = UsermstTbl::find()
                        ->select([
                            'UserMst_Pk as userPk',
                            'MemberCompMst_Pk as companyPk',
                            "concat_ws(' ',um_firstname,um_middlename, um_lastname) as 'employeeName'",
                            'MCM_CompanyName as companyName',
                            'mcm_complogo_memcompfiledtlsfk as comlogo',
                            'UM_EmpId as empId',
                            'group_concat(DISTINCT DM_Name SEPARATOR ", ") as departmentName',
                            'REPLACE(CyM_CountryDialCode,"00","+") as mobileCountyCode',
                            'um_primobno as mobileNumber',
                            'UM_EmailID as emailID',
                            "group_concat(DISTINCT concat_ws(' - ', mcsd_referenceno, mcsd.mcsd_businessunitrefname) SEPARATOR ', ')  as businessUnit",
                            'mcm_aboutus as aboutUs',
                            'ClM_ClassificationType as classification',
                            'date_format(UM_CreatedOn,\'%M %Y\') as membersince',
                            'year(curdate()) - year(UM_CreatedOn) - (date_format(curdate(),\'%m%d\') < date_format(UM_CreatedOn, \'%m%d\')) as membersinceyearcount',
                            'dsg.dsg_designationname as designation',
                            'group_concat(SecM_SectorName SEPARATOR ", ") as sectors',
                            'CyM_CountryName_en as country',
                            'SM_StateName_en as state',
                            'date_format(up_dateofjoin,\'%d-%m-%Y\') as dateOfJoining',
                            'tz_countryname as timeZoneCountry',
                            '(case um_desiglevel when "1" then "Senior Management" when "2" then "Professional" when "3" then "Supervisory" when "4" then "Skilled" when "5" then "Semi-skilled" when "6" then "Unskilled" end) as designationLevel',
                            'year(curdate()) - year(up_dateofjoin) - (date_format(curdate(),\'%m%d\') < date_format(up_dateofjoin, \'%m%d\')) as yearsOfExperience',
                            'up_reportingto as reportTo',
                            'um_supervisor as supervisorTo',
                            'up_yrsofexperience as yearsOfExperience',
                            'up_rolesnresp as roles',
                            'mcpsfd_status as followStatus',
                            'um_socialmedia as socialMedia',
                            'um_userdp as imagePk'
                        ])
                        ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
                        ->leftJoin('timezone_tbl','UM_TimeZone = timezone_pk')
                        ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
                        ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                        ->leftJoin('designationmst_tbl dsg','dsg.designationmst_pk = UM_Designation')
                        //->leftJoin('countrymst_tbl', 'CountryMst_Pk = MCM_Source_CountryMst_Fk')
                        ->leftJoin('statemst_tbl', 'StateMst_Pk = MCM_StateMst_Fk')
                        ->leftJoin('memcompsectordtls_tbl mcsd','find_in_set(MemCompSecDtls_Pk, um_busunit)')
                        ->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')
                        ->leftJoin('memcompprdserfollowdtls_tbl','UserMst_Pk = mcpsfd_shared_fk and mcpsfd_followtype = 5 and mcpsfd_type = 10 and mcpsfd_usermst_fk='.$loginusrpk)
                        ->where(['UserMst_Pk'=>$userPk])
                        ->asArray()->one();

        $companyDetail['companylogo'] = Drive::generateUrl($userDetails['comlogo'],$userDetails['companyPk'], $loginusrpk).'&noimg=1';

        $userDetails['userImage'] = Drive::generateUrl($userDetails['imagePk'],$userDetails['companyPk'],$loginusrpk);
        $userDetails['aboutUs'] = strip_tags(html_entity_decode($userDetails['aboutUs']));
        $userDetails['certifiacationCount'] = MemcompacomplishdtlsTbl::getCertificateCountByCompany($userDetails['companyPk']);
        $userDetails['reportTo'] = UsermstTbl::getReportingUser($userDetails['reportTo']);
        $userDetails['supervisorTo'] = UsermstTbl::getSupervisorUser($userDetails['supervisorTo']);
        if(!empty($userDetails['socialMedia']) && $userDetails['socialMedia'] != '"[]"'){
            $socialMedia = json_decode(json_decode($userDetails['socialMedia']));
            $userDetails['socialFacebook'] = $socialMedia->facebook;
            $userDetails['socialInstagram'] = $socialMedia->instagram;
            $userDetails['socialTwitter'] = $socialMedia->twitter;
            $userDetails['socialLinkedin'] = $socialMedia->linkedin;
        }else{
            $userDetails['socialFacebook'] = $userDetails['socialInstagram'] = $userDetails['socialTwitter'] = $userDetails['socialLinkedin'] = '';
        }
        return $userDetails;
    }

    public static function getMarketPresenceDetails($mpId){
        $mpDetails = MemcompmplocationdtlsTbl::find()
                        ->select([
                            'mcmpld_officename as organizationName',
                            'mcmpld_branchid as branchId',
                            'mcmpld_crregno as crNo',
                            'mcmpld_membercompmst_fk as companyPk',
                            'mcmpld_address as address',
                            'cym.CyM_CountryName_en as country',
                            'SM_StateName_en as state',
                            'CM_CityName_en as city',
                            'mcmpld_landlinenocc as landlineNoCC',
                            'mcmpld_landlineno as landlineNo',
                            'mcmpld_emailid as emailId',
                            'mcmpld_website as website',
                            'mcm_aboutus as aboutUs',
                            'ClM_ClassificationType as classification',
                            'MCM_CompanyName as companyName',
                            'MCM_SupplierCode as suppliercode',
                            'MCM_crnumber as regno',
                            'MCM_crnumber as crnumber',
                            //'MCM_CoC_CtftNo as cocno',
                            'cnt.CyM_CountryName_en as companyCountry',
                            'date_format(MRM_CreatedOn,\'%M %Y\') as membersince',
                            'year(curdate()) - year(MRM_CreatedOn) - (date_format(curdate(),\'%m%d\') < date_format(MRM_CreatedOn, \'%m%d\')) as membersinceyearcount',
                        ])
                        ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                        ->leftJoin('Memberregistrationmst_tbl', 'MCM_Memberregmst_Fk = MemberRegMst_Pk')
                        ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                        ->leftJoin('countrymst_tbl cym','cym.CountryMst_Pk = mcmpld_countrymst_fk')
                        ->leftJoin('countrymst_tbl cnt', 'cnt.CountryMst_Pk=MCM_Source_CountryMst_Fk')
                        ->leftJoin('statemst_tbl','StateMst_Pk = mcmpld_statemst_fk')
                        ->leftJoin('citymst_tbl','CityMst_Pk = mcmpld_citymst_fk')
                        ->where(['memcompmplocationdtls_pk'=>$mpId])
                        ->asArray()->one();

        $mpDetails['aboutUs'] = strip_tags(html_entity_decode($mpDetails['aboutUs']));
        $mpDetails['certifiacationCount'] = MemcompacomplishdtlsTbl::getCertificateCountByCompany($mpDetails['companyPk']);
        return $mpDetails;
    }

    public static function getBunitMappedUsers($businessUnitId, $cmpPK){
        $bunitMappedUsers = UsermstTbl::find()
                                ->select([
                                    'concat_ws(" ", um_firstname, um_middlename, um_lastname) as userName',
                                    'dsg_designationname as designation',
                                ])
                                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                                ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
                                ->where(['MemberCompMst_Pk'=>$cmpPK,'UM_Status'=>'A'])
                                ->andWhere(new \yii\db\Expression('FIND_IN_SET(:bUnit,um_busunit)'))
                                ->addParams([':bUnit' => $businessUnitId])
                                ->asArray()->all();
        return $bunitMappedUsers;
    }

    public static function getBunitMappedProducts($businessUnitId, $cmpPK){
        $bunitMappedProducts = MemcompproddtlsTbl::find()
                                ->select([
                                    'MCPrD_DisplayName as productName',
                                    'mcprd_prodrefno as pdtRefNo',
                                    'PrdM_ProductCode as unspsc_code'
                                ])
                                ->leftJoin('memcompprodbussrcmap_tbl','MemCompProdDtls_Pk = mcpbsm_memcompproddtls_fk')
                                ->leftJoin('memcompbussrcdtls_tbl','mcpbsm_memcompbussrcdtls_fk = memcompbussrcdtls_pk')
                                ->innerJoin('memcompsectordtls_tbl','mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk')
                                ->leftJoin('ProductMst_tbl', 'productmst_pk = MCPrD_ProductMst_Fk')
                                ->where([
                                    'MemCompSecDtls_Pk'=>$businessUnitId,
                                    'MCPrD_MemberCompMst_Fk'=>$cmpPK
                                ])
                                ->andWhere(['!=', 'mcprd_isdeleted', 1])
                                ->asArray()->all();
        return $bunitMappedProducts;
    }

    public static function getMonitorLogDetail($userPk){

        $monitorLog = UsermstTbl::find()
                        ->select([
                            "mcfd.mcfd_origfilename as userImage",
                            'MemberCompMst_Pk as companyPk',
                            'um.usermst_pk as userPk',
                            "um.um_firstname as firstName",
                            "um.um_middlename as middleName",
                            "um.um_lastname as lastName",
                            'MCM_CompanyName as companyName',
                            "um.UM_EmpId as empId",
                            "(case um.UM_Status when 'A' then 'Active' when 'I' then 'InActive' end) as status",
                            "(substring_index(group_concat(bm.bmm_name order by usermonitorlog_pk desc),',',1)) as lastVisitedModule",
                            "count(distinct uml_basemodulemst_fk) as visitedModuleCount",
                            "concat_ws(' ',um_firstname, um_middlename, um_lastname) as employeeName",
                            'date_format(UM_CreatedOn,\'%M %Y\') as membersince',
                            'year(curdate()) - year(UM_CreatedOn) - (date_format(curdate(),\'%m%d\') < date_format(UM_CreatedOn, \'%m%d\')) as membersinceyearcount',
                            'DM_Name as departmentName',
                            'um_primobnocc as mobileCountyCode',
                            'um_primobno as mobileNumber',
                            'UM_EmailID as emailID',
                            'um_division as branchName',
                            'mcm_aboutus as aboutUs',
                            'ClM_ClassificationType as classification',
                            'group_concat(distinct SecM_SectorName) as businessUnit',
                            'dsg.dsg_designationname as designation',
                            'CyM_CountryName_en as country',
                            'SM_StateName_en as state'
                        ])
                        ->from('usermst_tbl um')
                        ->leftJoin('memcompfiledtls_tbl mcfd','mcfd.memcompfiledtls_pk = um.um_userdp')
                        ->leftJoin('usermonitorlog_tbl uml','uml.uml_usermst_fk = um.usermst_pk')
                        ->leftJoin('basemodulemst_tbl bm','bm.basemodulemst_pk = uml.uml_basemodulemst_fk')
                        ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                        ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                        ->leftJoin('departmentmst_tbl','DepartmentMst_Pk = um.um_departmentmst_fk')
                        ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                        ->leftJoin('memcompsectordtls_tbl mcsd','find_in_set(MemCompSecDtls_Pk, um_busunit)')
                        ->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')
                        ->leftJoin('designationmst_tbl dsg','dsg.designationmst_pk = um.UM_Designation')
                        ->leftJoin('countrymst_tbl', 'CountryMst_Pk = MCM_Source_CountryMst_Fk')
                        ->leftJoin('statemst_tbl', 'StateMst_Pk = MCM_StateMst_Fk')
                        ->where(['UserMst_Pk'=>$userPk])
                        ->asArray()->one();

        $monitorLog['aboutUs'] = strip_tags(html_entity_decode($monitorLog['aboutUs']));
        $monitorLog['certifiacationCount'] = MemcompacomplishdtlsTbl::getCertificateCountByCompany($monitorLog['companyPk']);

        return $monitorLog;
    }

    public static function getBusinessDetails($businessUnitId){
        $businessUnitDetail = MemcompsectordtlsTbl::find()
                                ->select([
                                    'MemCompSecDtls_Pk as bUnitPk',
                                    'mcsd_referenceno as businessRefNo',
                                    'mcsd_bunitdesc as description',
                                    'group_concat(DISTINCT sm.SecM_SectorName SEPARATOR ", ") as sectorName',
                                    'mcsd_businessunitrefname as businessUnitRefName',
                                ])
                                ->from('memcompsectordtls_tbl mcsd')
                                ->leftJoin('sectormst_tbl sm','find_in_set(sm.SectorMst_Pk, mcsd.MCSD_SectorMst_Fk)')
                                ->where(['MemCompSecDtls_Pk'=>$businessUnitId])
                                ->asArray()->one();
        return $businessUnitDetail;
    }

    public function getBunitBsourceDetails($businessUnitId){
        $bSourceDetails = MemcompsectordtlsTbl::find()
                            ->select([
                                'bsm_bussrcname as bSourceName',
                                'mcbsd_uid as bSourceId',
                                'mcbsd_refname as bSourceRefName',
                                'count(mcbsd_usermst_fk) as userCount',
                                'count(distinct mcpbsm_memcompproddtls_fk) as productCount',
                                'count(distinct mcsbsm_memcompservdtls_fk) as serviceCount'
                            ])
                            ->innerJoin('memcompbussrcdtls_tbl','mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk')
                            ->innerJoin('businesssourcemst_tbl','mcbsd_businesssourcemst_fk = businesssourcemst_pk')
                            ->leftJoin('memcompprodbussrcmap_tbl','memcompbussrcdtls_pk = mcpbsm_memcompbussrcdtls_fk')
                            ->leftJoin('memcompservbussrcmap_tbl','memcompbussrcdtls_pk = mcsbsm_memcompbussrcdtls_fk')
                            ->where([
                                'MemCompSecDtls_Pk'=>$businessUnitId,
                                'bsm_status'=>1
                            ])
                            ->groupBy('memcompbussrcdtls_pk')
                            ->asArray()->all();
        return $bSourceDetails;   
    }

    public static function getCompanyDetails($cmpPK){
        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        $ishowcertificatetab = 2;
        $jsrscertificatedetails = [];
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        //print_r($cmpPK);die();
        $companyDetail = MembercompanymstTbl::find()
                            ->select([
                                'MemberCompMst_Pk as companyPk',
                                'MCM_Memberregmst_Fk as rid', 
                                'mcm_aboutus as aboutUs',
                                "case when `MCM_Origin`='I' then 'International' else ClM_ClassificationType end as classification",
                                'mcm_complogo_memcompfiledtlsfk',
                                'MCM_CompanyName as companyName',
                                'MCM_SupplierCode as suppliercode',
                                'MCM_crnumber as regno',
                                'MCM_crnumber as crnumber',
                                'mcm_socialmedia as sm',
                                'MRM_MemberStatus as status' ,
                                'MRM_ValSubStatus' ,
                                'date_format(MRM_CreatedOn,\'%d-%m-%Y\') as regsince',
                                'date_format(MRM_CreatedOn,\'%M %Y\') as membersince',
                                'year(curdate()) - year(MRM_CreatedOn) - (date_format(curdate(),\'%m%d\') < date_format(MRM_CreatedOn, \'%m%d\')) as membersinceyearcount',
                                'CyM_CountryName_en as country',
                                'SM_StateName_en as state',
                                'MCM_Source_CountryMst_Fk as countrypk',
                                'ISM_IncorpStyleEntity as styleofincrop',
                                'SecM_SectorName as comp_sector',
                                'bsm_bussrcname as comp_bs',
                                'COUNT(distinct MemCompProdDtls_Pk) AS totProdCnt',
                                "count(distinct mcprdm_memcompproddtls_fk) as 'totJsrsProdCnt'",
                                "COUNT(distinct MemCompServDtls_Pk) AS totServCnt",
                                "count(distinct mcsvdm_memcompservdtls_fk) AS totJsrsServCnt",
	                            "group_concat(distinct concat_ws(' - ', mcsd_referenceno, mcsd_businessunitrefname) separator ', ') as 'Division'",
	                            "`mcmpld_address` as 'offAddres'",
                                'mrm_createdby',
                                'mcm_accexpirydate as expdate',
                                'if(mcm_accexpirydate >= current_date(),1,0) as comsts',
                                'mcm_externalproflink as profileLink',
                                'ifnull(mcuf.mcpsfd_status,0) as favsts',
                                'ifnull(mcufol.mcpsfd_status,0) as isFollowed',
                                "group_concat(distinct case mclch_lcctype when 1 then 'CCED' when 2 then 'DUQM' when 3 then 'OXY' when 4 then 'PDO' end separator ',') as 'splsts'",
                                // 'sezd_tbl.sezadecertitracking_pk',
                                // 'sezd_tbl.szct_issuedon',
                                // 'sezd_tbl.szct_expiry',
                                // 'sezd_tbl.szct_certissdfor',
                                // 'sezd_tbl.szct_crtfilepath',
                                // 'srt_applstatus',
                                'count(distinct mcufol.mcpsfd_usermst_fk) as followcnt'
                            ])
                            ->leftJoin('Memberregistrationmst_tbl', 'MCM_Memberregmst_Fk = MemberRegMst_Pk')
                            ->leftJoin('memcompproddtls_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk and MCPrD_CreatedOn is not null and mcprd_isdeleted=2')
                            ->leftJoin('memcompproddtlsmain_tbl', 'mcprdm_membercompmst_fk = MemberCompMst_Pk')
                            ->leftJoin('memcompservicedtls_tbl', 'MCSvD_MemberCompMst_Fk = MemberCompMst_Pk and MCSvD_CreatedOn is not null and mcsvd_isdeleted=2')
                            ->leftJoin('memcompservicedtlsmain_tbl', 'mcsvdm_membercompmst_fk = MemberCompMst_Pk')
                            ->leftJoin('incorpstylemst_tbl', 'mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
                            ->leftJoin('sectormst_tbl', 'mrm_compsector = SectorMst_Pk')
                            ->leftJoin('businesssourcemst_tbl', 'mrm_businsrc = businesssourcemst_pk')
                            ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
                            ->leftJoin('countrymst_tbl cnt', 'cnt.CountryMst_Pk=MCM_Source_CountryMst_Fk')
                            ->leftJoin('statemst_tbl offstate', 'offstate.StateMst_Pk=MCM_StateMst_Fk')
                            ->leftJoin('memcompsectordtls_tbl', 'MemberCompMst_Pk=MCSD_MemberCompMst_Fk')
                            ->leftJoin('memcompmplocationdtls_tbl', 'MemberCompMst_Pk=mcmpld_membercompmst_fk and mcmpld_locationtype = 1')
                            ->leftJoin('memcompaccactvnhstry_tbl','mcaah_memberregmst_fk=MemberRegMst_Pk')
                            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf',"MemberCompMst_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 1 and mcuf.mcpsfd_type = 1 and mcuf.mcpsfd_usermst_fk={$userpk} and mcuf.mcpsfd_status=1")
                            ->leftJoin('memcompprdserfollowdtls_tbl as mcufol',"MemberCompMst_Pk = mcufol.mcpsfd_shared_fk and mcufol.mcpsfd_followtype = 1 and mcufol.mcpsfd_type = 2 and mcufol.mcpsfd_usermst_fk={$userpk} and mcufol.mcpsfd_status=1")
                            ->leftJoin('memcomplcccerthdr_tbl mclch',"MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1")
                            // ->leftJoin('sezadecertitracking_tbl sezd_tmp',"MemberCompMst_Pk = sezd_tmp.szct_membercompmst_fk")
                            // ->leftJoin('sezadecertitracking_tbl sezd_tbl',"MemberCompMst_Pk = sezd_tbl.szct_membercompmst_fk and sezd_tmp.sezadecertitracking_pk < sezd_tbl.sezadecertitracking_pk")
                            // ->leftJoin('sezadregtmp_tbl',"MemberCompMst_Pk = srt_memcompmst_fk")
                            ->where(['MemberCompMst_Pk' => $cmpPK])
                            
                            //->andWhere(['not', ['MCPrD_SVFAdminApprovalStatus' => 'D']]);

                            ->groupBy('MemberCompMst_Pk')
                            ->asArray()->one();

                            //print_r($companyDetail->createCommand()->getRawSql());die();

        $companyDetail['companylogo'] = Drive::generateUrl($companyDetail['mcm_complogo_memcompfiledtlsfk'],$cmpPK, $userpk).'&noimg=logo';

       
        $companyDetail['aboutUs'] = strip_tags(html_entity_decode($companyDetail['aboutUs']));
       
        if (strpos($companyDetail['aboutUs'], '&amp;') !== false) { 
            $companyDetail['aboutUs'] = str_replace("&amp;","&",$companyDetail['aboutUs']);
        }

        $companyDetail['certifiacationCount'] = MemcompacomplishdtlsTbl::getCertificateCountByCompany($companyDetail['companyPk']);        
        if(!empty($companyDetail['MRM_ValSubStatus']) && $companyDetail['MRM_ValSubStatus'] == 'A' &&  $companyDetail['status'] != 'I'){
            $ishowcertificatetab = 1;           
            $jsrscertificatedetails = \common\components\Suppcertform::getcertificatedetails($companyDetail['companyPk']);      
        }

        $totalview = \common\models\HitcountmstTbl::find()
            ->where('hcm_pageviewed=:pageview and hcm_viewed_mcm_fk=:compk',[':pageview'=>'EP',':compk'=>$cmpPK])->count();
        if($totalview == "0") {
            $companyDetail['totalView'] = "00";
        } else {
            $val = (int)$totalview;
            if( $val >= 1 && $val <= 9) {
                $companyDetail['totalView'] = "0".$totalview;
            }else {
                $companyDetail['totalView'] = $totalview;    
            }
            
        }
        $companyDetail['ishowcertificatetab'] =  $ishowcertificatetab;        
        $companyDetail['jsrscertificatedetails'] = $jsrscertificatedetails;

        $certTrack = SezadecertitrackingTbl::find()
                    ->select(['sezadecertitracking_pk', 'szct_certissdfor', 'szct_certificateno', 'szct_crtfilepath', 'szct_issuedon', 'szct_expiry'])
                    ->Where('szct_membercompmst_fk = :szct_membercompmst_fk', ['szct_membercompmst_fk' => $cmpPK])
                    ->orderBy('sezadecertitracking_pk DESC')
                    ->asArray()
                    ->one();

        $certTrackStatus = SezadregtmpTbl::find()
                    ->select(['srt_applstatus'])
                    ->Where('srt_memcompmst_fk = :srt_memcompmst_fk', ['srt_memcompmst_fk' => $cmpPK])
                    ->orderBy('sezadregtmp_pk DESC')
                    ->asArray()
                    ->one();

                    

        
        if ($certTrackStatus['srt_applstatus'] == 1) { 
            $companyDetail['szct_certissdfor'] = 'Yet to apply';  
        } elseif (($certTrackStatus['srt_applstatus'] == 2 || $certTrackStatus['srt_applstatus'] == 6 || $certTrackStatus['srt_applstatus'] == 7 || $certTrackStatus['srt_applstatus'] == 8)) {
            $companyDetail['szct_certissdfor'] = 'Posted for Validation';
        } elseif ($certTrackStatus['srt_applstatus'] == 3 || $certTrackStatus['srt_applstatus'] == 4) {  
            $companyDetail['szct_certissdfor'] = 'Declined';
        } elseif (time() > strtotime(date('d-m-Y', strtotime($certTrack['szct_expiry'])))) {           
            $companyDetail['szct_certissdfor'] = 'Expired';           
        } elseif ($certTrackStatus['srt_applstatus'] == 5) {            
            $companyDetail['szct_certissdfor'] = 'Active';           
        } else {   
            $companyDetail['szct_certissdfor'] = 'Yet to apply'; 
        }
            
        
        $companyDetail['sezadecertitracking_pk'] = isset($certTrack['sezadecertitracking_pk'])?$certTrack['sezadecertitracking_pk']:"";
        $companyDetail['szct_issuedon'] = isset($certTrack['szct_issuedon'])?date("d-m-Y", strtotime($certTrack['szct_issuedon'])):"";
        $companyDetail['szct_expiry'] = isset($certTrack['szct_expiry'])?date("d-m-Y", strtotime($certTrack['szct_expiry'])):"";
        //$companyDetail['szct_certissdfor'] = isset($companyDetail['szct_certissdfor'])?Bizsearch::getSezadStatusValue()[$companyDetail['szct_certissdfor']]:"";
        
        $pathLink="";
        if(!empty($certTrack['szct_crtfilepath'])){
            $pathLink=substr($certTrack['szct_crtfilepath'], 0, -3);
        }
        $companyDetail['szct_path_link_qr'] = Yii::$app->params['JSRS_v2_baseURL']."images/sezad/cert/".$pathLink."png";
        $companyDetail['szct_path_link_jpg'] = Yii::$app->params['JSRS_v2_baseURL']."images/sezad/cert/".$pathLink."jpg";
        $companyDetail['szct_path_link_sezd'] = Yii::$app->params['JSRS_v2_baseURL']."images/email/images/sezdtemp.png";
        $companyDetail['szct_path_link_pdf'] = Yii::$app->params['JSRS_v2_baseURL']."images/sezad/cert/".$certTrack['szct_crtfilepath'];

        $imagePath = array();
        $imagePath['imagecert']=isset($certTrack['szct_crtfilepath'])?Yii::$app->params['JSRS_v2_baseURL']."images/sezad/cert/".$pathLink."jpg":"";
        $companyDetail['szct_crtfilepath'] = $imagePath;
        $companyDetail['suppextbase_link']=Yii::$app->params['baseUrl'];
        
        return $companyDetail;
    }

    public static function getProductDetail($productpk, $companypk,$from='T'){

        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        
        $dateFormat = \yii\db\ActiveRecord::getTokenData('dateFormatMysql', true);
        $comp_pk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        //print_r($from);die();
        if($from=='T'){
        $productList = MemcompproddtlsTbl::find()
                ->select(['MemCompProdDtls_Pk as pk',
                    'group_concat(distinct bsm_bussrcname) as bussrc',
                    'MCPrD_MemberCompMst_Fk', 
                    'MCPrD_MemberCompMst_Fk as compk', 
                    
                    'MCPrD_DisplayName as displayName',
                    'memcompfiledtls_pk as imagePK',
                    'mcfd_uploadedby as uupk',
                    'mcprd_prodmodelno as pdtRefNo',
                    'MCPrD_ProductMst_Fk', 
                    'MCPrD_ProdDesc as product_description',
                    'mcprd_prodrefno as prod_id',
                    'mcprd_prodbrochfile as broacher',
                    'PrdM_ProductCode as unspsc_code',
                    "if(MCPrD_NationalProdStatus = 'Y','Yes','No') as nationalproduct",
                    'concat(PrdM_ProductCode,"-",PrdM_ProductName) as product',
                    "COUNT(distinct MemProdServRevDtls_Pk) as reviewCnt",
                    "TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from ROUND(avg(MPSRD_RevPoint),1))) AS rating",
                    "ROUND(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from ROUND(avg(MPSRD_RevPoint),1)))/5 * 100,2) as star",
                    "date_format(MCPrD_Createdon,'{$dateFormat}') as date_of_upload", 'MCPrD_Createdon',
                    "group_concat(distinct concat_ws(' - ',mcsd_referenceno,mcsd_businessunitrefname) separator ', ') as 'division'",
                    "group_concat(distinct SecM_SectorName) as 'sectorname'",
                    "concat_ws(' > ', bicc_categoryname, bicsc_subcategoryname, bicpm_productname, concat(PrdM_ProductCode, ' - ', PrdM_ProductName)) as 'industrialcode'",
                    "mcor_overallrating as rating",
                    "mcor_ratingcount",
                    'if(char_length(mcprd_prodviewcount) = 1,lpad(mcprd_prodviewcount,2,0),mcprd_prodviewcount) as viewcnt',
                    'unm_namesg as productunitname',
                    'mcprd_contactinfo',
                    'ifnull(mcuf.mcpsfd_status,0) as favsts',
                    "group_concat(distinct profol.mcpsfd_usermst_fk) in({$userpk}) as isFollowed",
                    'count(distinct profol.mcpsfd_usermst_fk) as followcnt',
                     'CASE 
            WHEN `MCPrD_CreatedOn` is null THEN "Incomplete" 
            WHEN `MCPrD_SVFAdminApprovalStatus`="N" THEN "New"  
              WHEN `MCPrD_SVFAdminApprovalStatus` is null THEN "Yettoapply" 
            WHEN ((`MCPrD_SVFAdminApprovalStatus` is null and `MCPrD_CreatedOn` is not null) ) THEN "New" 
            WHEN `MCPrD_SVFAdminApprovalStatus`="A"   THEN "JSRS Approved" 
            WHEN `MCPrD_SVFAdminApprovalStatus`="U"   THEN "Updated" 
            WHEN `MCPrD_SVFAdminApprovalStatus`="D"  THEN "Declined" END as prductstatus',
            new Expression("'NA' as jsrssts")
                    ])
                ->leftJoin('ProductMst_tbl', 'productmst_pk = MCPrD_ProductMst_Fk')
                ->leftJoin('bgiinduscodeprodmst_tbl', 'mcprd_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk')
                ->leftJoin('bgiindcodesubcateg_tbl', 'mcprd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
                ->leftJoin('bgiindcodecateg_tbl', 'mcprd_bgiindcodecateg_fk = bgiindcodecateg_pk')
                ->leftJoin('memprodservrevdtls_tbl', 'MPSRD_MemCompProdDtls_Fk = memcompproddtls_pk')
                

                ->leftJoin('memcompprodbussrcmap_tbl','MemCompProdDtls_Pk = mcpbsm_memcompproddtls_fk')
                ->leftJoin('memcompbussrcdtls_tbl','mcpbsm_memcompbussrcdtls_fk = memcompbussrcdtls_pk')


                ->leftJoin('businesssourcemst_tbl','businesssourcemst_pk = mcbsd_businesssourcemst_fk')
                ->leftJoin('memcompfiledtls_tbl mcfd','memcompfiledtls_pk=mcprd_prodcoverimgfile')


                ->leftJoin('memcompsectordtls_tbl','mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk')



                ->leftJoin('memcompbussrcsectormap_tbl','memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk')
                ->leftJoin('sectormst_tbl','mcbssm_sectormst_fk = SectorMst_Pk')
                ->leftJoin('unitmst_tbl', 'mcprd_produnittype = unitmst_pk')
                ->leftJoin('memcompoverallreview_tbl','MemCompProdDtls_Pk = mcor_shared_fk and mcor_type = 1')
                ->leftJoin('memcompprdserfollowdtls_tbl as mcuf',"MemCompProdDtls_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 2 and mcuf.mcpsfd_type = 3 and mcuf.mcpsfd_usermst_fk={$userpk} and  mcuf.mcpsfd_status = 1")
                ->leftJoin('memcompprdserfollowdtls_tbl as profol',"MemCompProdDtls_Pk = profol.mcpsfd_shared_fk and profol.mcpsfd_followtype = 2 and profol.mcpsfd_type = 4 and  profol.mcpsfd_status = 1")
                ->where(['MCPrD_MemberCompMst_Fk' => $companypk, 'Memcompproddtls_Pk' => $productpk])
                ->andWhere(['!=', 'mcprd_isdeleted', 1])
                ->asArray()
                ->one();
        }else{
            $productList = MemcompproddtlsmainTbl::find()
            ->select(['mcprdm_memcompproddtls_fk as pk',
                'group_concat(distinct bsm_bussrcname) as bussrc',
                'mcprdm_membercompmst_fk as compk', 
                 
                'mcprdm_displayname as displayName',
                'memcompfiledtls_pk as imagePK',
                'mcfd_uploadedby as uupk',
                'mcprdm_prodrefno as prod_id',
                'mcprdm_productmst_fk as MCPrDm_ProductMst_Fk',
                'mcprdm_proddesc as product_description',
                'mcprdm_prodmodelno as pdtRefNo',
                'mcprdm_prodbrochfile as broacher',
                'PrdM_ProductCode as unspsc_code',
                "if(mcprdm_nationalprodstatus = 'Y','Yes','No') as nationalproduct",
                'concat(PrdM_ProductCode,"-",PrdM_ProductName) as product',
                "mcor_reviewcount as reviewCnt",
                "mcor_ratingcount AS ratingCnt",
                "date_format(mcprdm_createdon,'{$dateFormat}') as date_of_upload", 'mcprdm_createdon',
                "group_concat(distinct concat_ws(' - ',mcsd_referenceno,mcsd_businessunitrefname) separator ', ') as 'division'",
                "group_concat(distinct SecM_SectorName) as 'sectorname'",
                "concat_ws(' > ', bicc_categoryname, bicsc_subcategoryname, bicpm_productname) as 'industrialcode'",
                "mcor_overallrating as rating",
                'if(char_length(mcprdm_prodviewcount) = 1,lpad(mcprdm_prodviewcount,2,0),mcprdm_prodviewcount) as viewcnt',
                'unm_namesg as productunitname',
                'mcprdm_contactinfo as `mcprd_contactinfo`',
                'ifnull(mcuf.mcpsfd_status,0) as favsts',
                "group_concat(distinct profol.mcpsfd_usermst_fk) in({$userpk}) as isFollowed",
                'count(distinct profol.mcpsfd_usermst_fk) as followcnt',
                new Expression("'Approved' as prductstatus"),
                new Expression("'A' as jsrssts")
                ])
            ->leftJoin('ProductMst_tbl', 'productmst_pk = MCPrDm_ProductMst_Fk')
            ->leftJoin('bgiinduscodeprodmst_tbl', 'mcprdm_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk')
            ->leftJoin('bgiindcodesubcateg_tbl', 'mcprdm_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
            ->leftJoin('bgiindcodecateg_tbl', 'mcprdm_bgiindcodecateg_fk = bgiindcodecateg_pk')
            ->leftJoin('memcompprodbussrcmapmain_tbl','mcprdm_memcompproddtls_fk = mcpbsmm_memcompproddtls_fk')
            ->leftJoin('memcompbussrcdtlsmain_tbl','mcpbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk')
            ->leftJoin('businesssourcemst_tbl','businesssourcemst_pk = mcbsdm_businesssourcemst_fk')
            ->leftJoin('memcompfiledtls_tbl mcfd','memcompfiledtls_pk=mcprdm_prodcoverimgfile')
            ->leftJoin('memcompsectordtls_tbl','mcbsdm_memcompsecdtls_fk = MemCompSecDtls_Pk')
            ->leftJoin('memcompbussrcsectormap_tbl','mcbsdm_memcompbussrcdtls_fk = mcbssm_memcompbussrcdtls_fk')
            ->leftJoin('sectormst_tbl','mcbssm_sectormst_fk = SectorMst_Pk')
            ->leftJoin('unitmst_tbl', 'mcprdm_produnittype = unitmst_pk')
            ->leftJoin('memcompoverallreview_tbl','mcprdm_memcompproddtls_fk = mcor_shared_fk and mcor_type = 1')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf',"mcprdm_memcompproddtls_fk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 2 and mcuf.mcpsfd_type = 3 and mcuf.mcpsfd_usermst_fk={$userpk}")
            ->leftJoin('memcompprdserfollowdtls_tbl as profol',"mcprdm_memcompproddtls_fk = profol.mcpsfd_shared_fk and profol.mcpsfd_followtype = 2 and profol.mcpsfd_type = 4 and  profol.mcpsfd_status = 1")
            ->where(['mcprdm_membercompmst_fk' => $companypk, 'mcprdm_memcompproddtls_fk' => $productpk])

            ->asArray()
            ->one();     
        }

        

        if(isset($productList['pk'])) {
            
            $productmstlist = \api\modules\pms\models\MemcompprodmstmapTbl::find()->select(['mcpmm_productmst_fk as productmst_id', 'PrdM_ProductName as product_name', 'CONCAT(PrdM_ProductCode," - ",PrdM_ProductName) as productmst_names_unspc'])
                ->leftJoin('productmst_tbl', 'mcpmm_productmst_fk = productmst_pk')
                ->where('mcpmm_memcompproddtls_fk=:product_pk',[':product_pk'=>$productList['pk']])
                ->andWhere(['!=', 'mcpmm_isdeleted', '1']) 
                ->asArray()
                ->all();

            if(!empty($productmstlist)) {
                $productList['industrialcode'].= ' > ';
                foreach ($productmstlist as $key => $value) {      
                    $productList['industrialcode'].= $value['productmst_names_unspc'];
                    
                    if($key != count($productmstlist)-1) {
                        $productList['industrialcode'].= ', ';    
                    }
                }
            }    
        }
        

        $quantity_price = MemcompquantitypriceTbl::find()->select(['memcompquantityprice_pk as pricepk', 'mcqp_moq as countunit', 'mcqp_fobprice as priceunit'])
        ->where('mcqp_shared_fk=:product_pk', [':product_pk' => $productpk])
        ->andWhere('mcqp_type=:mcqp_type', [':mcqp_type' => 1])
        ->asArray()->all();
        $specification = MemcompprodspecdtlsTbl::getspecifcation($productpk,'');
        $memcompfile_pk = Security::encrypt($productList['imagePK']);
        $memcomp_pk = Security::encrypt($productList['compk']);
        $user_pk = Security::encrypt($productList['uupk']);
        $img_path=\Yii::$app->urlManager->createAbsoluteUrl(['drv/drive/view?f='.$memcompfile_pk.'&c='.$memcomp_pk.'&u='.$user_pk.'&noimg=1']);
        if ($productList['broacher'] != null) {
            $brochfile = Drive::generateUrl($productList['broacher'], $productList['compk'], $userpk, 1);
        } else {
            $brochfile = null;
        }
        $follow = MemcompprdserfollowdtlsTbl::getCountAndIsFollowing(2, $productpk, 4, $comp_pk);
        $SCFWholeStatus= \common\models\SuppcertformmembtmpTbl::find()
            ->where('scfmt_formmst_fk=2 and scfmt_membercompmst_fk=:company',[':company'=>$companypk])->one();

        $totalview = \common\models\HitcountmstTbl::find()
            ->where('hcm_pageviewed=:pageview and hcm_viewed_mcm_fk=:compk',[':pageview'=>'EP',':compk'=>$companypk])->count();
        if($totalview == "0") {
            $productList['viewedcnt'] = "00";
        } else {
            $val = (int)$totalview;
            if( $val >= 1 && $val <= 9) {
                $productList['viewedcnt'] = "0".$totalview;
            }else {
                $productList['viewedcnt'] = $totalview;    
            }
            
        }

        $reportOFprdSer =SvfController::statussection($SCFWholeStatus,$productList,'prductstatus');
        $productList['finalstatus'] = $reportOFprdSer['finalstatus'];
        $productList['class'] = $reportOFprdSer['class'];
        $productList['svg'] = $reportOFprdSer['svg'];
        $productList['count'] = $follow['count'];
        $productList['isAlready'] = $follow['isAlready'];
        $productList['desc'] = ($productList['product_description'] !== null) ? strip_tags($productList['product_description']) : 'NIL';
        $productList['product_description'] = strip_tags($productList['product_description']);
        // The below are kept as static, it will be changed to dynamic in future.
        $productList['star'] = ($productList['star'] == null) ? 0 : $productList['star'];
        $productList['coverImg'] = $img_path;
        $productList['rating'] = $productList['rating'];
        $productList['review_count'] = $productList['reviewCnt'];
        //$productList['viewedcnt'] = $productList['viewcnt'];
        $productList['viewed_by'] = 200;
        $productList['sharecount'] = 5;
        $productList['response_rate'] = 85.5;
        $productList['transactions'] = 65;
        $productList['on_time_delivery'] = 85;
        $productList['price'] = $quantity_price;
        $productList['specification'] = $specification;
        $productList['brochfile'] = $brochfile;
        $productList['prodextbase_link']=\Yii::$app->params['baseUrl'];

        // print_r($productList);die();
        return $productList;
    }

    public static function getServiceDetail($servicepk,$cmpPK,$from='T'){
        $dateFormat = \yii\db\ActiveRecord::getTokenData('dateFormatMysql',true);
        $comp_pk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        if($from!='M'){
            $serviceList = MembercompanymstTbl::find()
                ->select(['MemCompServDtls_Pk as pk','SrvM_ServiceName as serviceName',
                    'group_concat(distinct bsm_bussrcname) as bussrc',
                    'MCSvD_MemberCompMst_Fk',
                    'MCSvD_MemberCompMst_Fk as compk',
                    
                    'MCSvD_DisplayName as displayName',
                    'mcfd_uploadedby as uupk',
                    'memcompfiledtls_pk as imagePK',
                    'mcsvd_servbrochfile as brocher',
                    'MCSvD_ServDesc as service_description',
                    'mcsvd_servmodelno as serviceRefNo',
                    'mcsvd_servrefno as servId',
                    'SrvM_ServiceCode as unspsc_code',
                    'concat(ClsM_ClassCode,"-",ClsM_ClassName) as  class',
                    'concat(SegM_SegCode,"-",SegM_SegName) as segment',
                    'concat(FamM_FamilyCode,"-",FamM_FamilyName) as family',
                    'concat(SrvM_ServiceCode,"-",SrvM_ServiceName) as service',
                    "COUNT(distinct MemProdServRevDtls_Pk) as reviewCnt",
                    "TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from ROUND(avg(MPSRD_RevPoint),1))) AS rating",
                    "ROUND(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from ROUND(avg(MPSRD_RevPoint),1)))/5 * 100,2) as star",
                    "date_format(MCSvD_Createdon,'{$dateFormat}') as date_of_upload",
                    "group_concat(distinct concat_ws(' - ',mcsd_referenceno,mcsd_businessunitrefname) separator ', ') as 'division'",
                    "group_concat(distinct SecM_SectorName) as 'sectorname'",
                    "concat_ws(' > ', bicc_categoryname, bicsc_subcategoryname, bicsm_servicename) as 'industrialcode'",
                    "mcor_overallrating as rating",
                    "mcor_ratingcount",
                    "if(char_length(mcsvd_servviewcount) = 1,lpad(mcsvd_servviewcount,2,0),mcsvd_servviewcount) as viewcnt",
                    'unm_namesg as serviceunitname',
                    'mcsvd_contactinfo as contactinfo',
                    'ifnull(mcuf.mcpsfd_status,0) as favsts',
                    "group_concat(distinct profol.mcpsfd_usermst_fk) in({$userpk}) as isFollowed",
                    'count(distinct profol.mcpsfd_usermst_fk) as followcnt',
                            'CASE 
                WHEN `MCSvD_CreatedOn` is null THEN "Incomplete" 
                WHEN `MCSvD_SVFAdminApprovalStatus`="N" THEN "New"  
                WHEN `MCSvD_SVFAdminApprovalStatus` is null THEN "Yettoapply" 
                WHEN ((`MCSvD_SVFAdminApprovalStatus` is null and `MCSvD_CreatedOn` is not null) ) THEN "New" 
                WHEN `MCSvD_SVFAdminApprovalStatus`="A"   THEN "JSRS Approved" 
                WHEN `MCSvD_SVFAdminApprovalStatus`="U"   THEN "Updated" 
                WHEN `MCSvD_SVFAdminApprovalStatus`="D"  THEN "Declined" END as servicestatus',
                new Expression("'NA' as jsrssts"),
                    ])
                ->leftJoin('memcompservicedtls_tbl','mcsvd_membercompmst_fk = membercompmst_pk')
                ->leftJoin('ServiceMst_tbl','servicemst_pk = MCSvD_ServiceMst_Fk')
                ->leftJoin('bgiinduscodeservmst_tbl', 'mcsvd_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk')
                ->leftJoin('bgiindcodesubcateg_tbl', 'mcsvd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
                ->leftJoin('bgiindcodecateg_tbl', 'mcsvd_bgiindcodecateg_fk = bgiindcodecateg_pk')
                ->leftJoin('classmst_tbl','ClassMst_Pk = MCSvD_ServClassMst_Fk')
                ->leftJoin('familymst_tbl','MCSvD_ServFamilyMst_Fk = FamilyMst_Pk')
                ->leftJoin('segmentmst_tbl','SegmentMst_Pk = MCSvD_ServSegmentMst_Fk')
                ->leftJoin('memprodservrevdtls_tbl','MPSRD_MemCompServDtls_Fk = memcompservdtls_pk')
                ->leftJoin('memcompservbussrcmap_tbl','MemCompServDtls_Pk = mcsbsm_memcompservdtls_fk')
                ->leftJoin('memcompbussrcdtls_tbl','mcsbsm_memcompbussrcdtls_fk = memcompbussrcdtls_pk')
                ->leftJoin('businesssourcemst_tbl','businesssourcemst_pk = mcbsd_businesssourcemst_fk')
                ->leftJoin('memcompfiledtls_tbl mcfd','memcompfiledtls_pk=mcsvd_servcoverimgfile')
                ->leftJoin('memcompsectordtls_tbl','mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk')
                ->leftJoin('memcompbussrcsectormap_tbl','memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk')
                ->leftJoin('sectormst_tbl','mcbssm_sectormst_fk = SectorMst_Pk')
                ->leftJoin('unitmst_tbl', 'mcsvd_servunittype = unitmst_pk')
                ->leftJoin('memcompoverallreview_tbl','	MemCompServDtls_Pk = mcor_shared_fk and mcor_type = 2')
                ->leftJoin('memcompprdserfollowdtls_tbl as mcuf',"MemCompServDtls_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 3 and mcuf.mcpsfd_type = 5 and mcuf.mcpsfd_usermst_fk={$userpk} and mcuf.mcpsfd_status = 1 ")
                ->leftJoin('memcompprdserfollowdtls_tbl as profol',"MemCompServDtls_Pk = profol.mcpsfd_shared_fk and profol.mcpsfd_followtype = 3 and profol.mcpsfd_type = 6 and  profol.mcpsfd_status = 1")

                ->where(['MCSvD_MemberCompMst_Fk' => $cmpPK,'Memcompservdtls_Pk' => $servicepk])
                ->asArray()
                ->one();
        }else{
            $serviceList = MembercompanymstTbl::find()
            ->select(['mcsvdm_memcompservdtls_fk as pk',
                'SrvM_ServiceName as serviceName',
                'group_concat(distinct bsm_bussrcname) as bussrc',
                'MCSvDm_MemberCompMst_Fk',
                'MCSvDm_MemberCompMst_Fk as compk',
                
                'MCSvDm_DisplayName as displayName',
                'mcfd_uploadedby as uupk',
                'memcompfiledtls_pk as imagePK',
                'mcsvdm_servbrochfile as brocher',
                'MCSvDm_ServDesc as service_description',
                'mcsvdm_servmodelno as serviceRefNo',
                'mcsvdm_servrefno as servId',
                'SrvM_ServiceCode as unspsc_code',  
                "mcor_reviewcount as reviewCnt",
                "mcor_overallrating as star",
                "date_format(MCSvDm_Createdon,'{$dateFormat}') as date_of_upload",
                "group_concat(distinct concat_ws(' - ',mcsd_referenceno,mcsd_businessunitrefname) separator ', ') as 'division'",
                "group_concat(distinct SecM_SectorName) as 'sectorname'",
                "concat_ws(' > ', bicc_categoryname, bicsc_subcategoryname, bicsm_servicename) as 'industrialcode'",
                "mcor_overallrating as rating",
                "mcor_ratingcount",
                "if(char_length(mcsvdm_servviewcount) = 1,lpad(mcsvdm_servviewcount,2,0),mcsvdm_servviewcount) as viewcnt",
                'unm_namesg as serviceunitname',
                'mcsvdm_contactinfo as contactinfo',
                'ifnull(mcuf.mcpsfd_status,0) as favsts',
                "group_concat(distinct profol.mcpsfd_usermst_fk) in({$userpk}) as isFollowed",
                'count(distinct profol.mcpsfd_usermst_fk) as followcnt',
                new Expression("'Approved' as servicestatus"),
                new Expression("'A' as jsrssts"),
                ])
            ->leftJoin('memcompservicedtlsmain_tbl','mcsvdm_membercompmst_fk = membercompmst_pk')
            ->leftJoin('ServiceMst_tbl','servicemst_pk = mcsvdm_servicemst_fk')
            ->leftJoin('bgiinduscodeservmst_tbl', 'mcsvdm_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk')
            ->leftJoin('bgiindcodesubcateg_tbl', 'mcsvdm_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
            ->leftJoin('bgiindcodecateg_tbl', 'mcsvdm_bgiindcodecateg_fk = bgiindcodecateg_pk')
            ->leftJoin('memcompservbussrcmapmain_tbl','mcsvdm_memcompservdtls_fk = mcsbsmm_memcompservdtls_fk')
            ->leftJoin('memcompbussrcdtlsmain_tbl','mcsbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk')
            ->leftJoin('businesssourcemst_tbl','businesssourcemst_pk = mcbsdm_businesssourcemst_fk')
            ->leftJoin('memcompfiledtls_tbl mcfd','memcompfiledtls_pk=mcsvdm_servcoverimgfile')
            ->leftJoin('memcompsectordtls_tbl','mcbsdm_memcompsecdtls_fk = MemCompSecDtls_Pk')
            ->leftJoin('memcompbussrcsectormap_tbl','mcbsdm_memcompbussrcdtls_fk = mcbssm_memcompbussrcdtls_fk')
            ->leftJoin('sectormst_tbl','mcbssm_sectormst_fk = SectorMst_Pk')
            ->leftJoin('unitmst_tbl', 'mcsvdm_servunittype = unitmst_pk')
            ->leftJoin('memcompoverallreview_tbl','	mcsbsmm_memcompservdtls_fk = mcor_shared_fk and mcor_type = 2')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf',"mcsbsmm_memcompservdtls_fk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 3 and mcuf.mcpsfd_type = 5 and mcuf.mcpsfd_usermst_fk={$userpk}")
            ->leftJoin('memcompprdserfollowdtls_tbl as profol',"mcsbsmm_memcompservdtls_fk = profol.mcpsfd_shared_fk and profol.mcpsfd_followtype = 3 and profol.mcpsfd_type = 6 and  profol.mcpsfd_status = 1")
            ->where(['mcsvdm_membercompmst_fk' => $cmpPK,'mcsvdm_memcompservdtls_fk' => $servicepk])
            ->asArray()
            ->one();

        }

        if(isset($serviceList['pk'])) {
            $servicemstlist = \api\modules\pms\models\MemcompservmstmapTbl::find()->select(['mcsmm_servicemst_fk as servicemst_id', 'SrvM_ServiceName as service_name', 'CONCAT(SrvM_ServiceCode," - ",SrvM_ServiceName) as servicemst_names_unspc'])
            ->leftJoin('servicemst_tbl', 'mcsmm_servicemst_fk = servicemst_pk')
            ->where('mcsmm_memcompservdtls_fk=:service_pk',[':service_pk'=>$serviceList['pk']])
            ->andWhere(['!=', 'mcsmm_isdeleted', '1'])
            ->asArray()
            ->all();
           
            if(!empty($servicemstlist)) {
                $serviceList['industrialcode'].= ' > ';
                foreach ($servicemstlist as $key => $value) {      
                    $serviceList['industrialcode'].= $value['servicemst_names_unspc'];
                    
                    if($key != count($servicemstlist)-1) {
                        $serviceList['industrialcode'].= ', ';    
                    }
                }
            }    
        }


        $specification = MemcompservspecdtlsTbl::getspecifcation($servicepk,'');
        $memcompfile_pk = Security::encrypt($serviceList['imagePK']);
        $memcomp_pk = Security::encrypt($serviceList['MCSvD_MemberCompMst_Fk']);
        $user_pk = Security::encrypt($serviceList['uupk']);
        $img_path=\Yii::$app->urlManager->createAbsoluteUrl(['drv/drive/view?f='.$memcompfile_pk.'&c='.$memcomp_pk.'&u='.$user_pk.'&noimg=1']);
        if ($serviceList['brocher'] != null) {
            $brochfile = Drive::generateUrl($serviceList['brocher'], $serviceList['MCSvD_MemberCompMst_Fk'], $userpk, 1);
        } else {
            $brochfile = null;
        }

        

        $follow = MemcompprdserfollowdtlsTbl::getCountAndIsFollowing(3,$servicepk,6,$comp_pk);
        $SCFWholeStatus= \common\models\SuppcertformmembtmpTbl::find()
            ->where('scfmt_formmst_fk=2 and scfmt_membercompmst_fk=:company',[':company'=>$comp_pk])->one();
        $reportOFprdSer =SvfController::statussection($SCFWholeStatus,$serviceList,'servicestatus');
        $serviceList['finalstatus'] = $reportOFprdSer['finalstatus'];
        $serviceList['class'] = $reportOFprdSer['class'];
        $serviceList['svg'] = $reportOFprdSer['svg'];
        $serviceList['count'] = $follow['count'];
        $serviceList['isAlready'] = $follow['isAlready'];
        $serviceList['desc'] = ($serviceList['service_description'] !== null) ? strip_tags($serviceList['service_description']) : 'NIL';
        $serviceList['service_description'] = strip_tags($serviceList['service_description']);
        // The below are kept as static, it will be changed to dynamic in future.
        $serviceList['star'] = ($serviceList['star'] == null) ? 0 : $serviceList['star'];
        $serviceList['coverImg'] = $img_path;
        $serviceList['review_count'] = 500;
        $serviceList['viewed_by'] = 200;
        $serviceList['sharecount'] = 5;
        $serviceList['response_rate'] = 85.5;
        $serviceList['transactions'] = 65;
        $serviceList['on_time_delivery'] = 85;
        $serviceList['specification'] = $specification;
        $serviceList['brochfile'] = $brochfile;
        $serviceList['servextbase_link']=\Yii::$app->params['baseUrl'];
        return $serviceList;
    }

    public static function getpscontact($continfo){
        $contactDtls = [];
        if ($continfo != null && $continfo != '') {
            $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
            $contactDtls = UsermstTbl::find()
                    ->select(['um_firstname', 'um_middlename', 'um_lastname', 'UM_EmailID', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as um_primobno' ,'um_primobnocc', 'dsg_designationname', 'DM_Name', 'UserMst_Pk','DepartmentMst_Pk','MemberCompMst_Pk','um_userdp'])
                    ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
                    ->leftJoin('designationmst_tbl', 'designationmst_pk = UM_Designation')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
                    ->where("UserMst_Pk in ($continfo)")
                    ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
                    ->orderBy('DM_Name asc')
                    ->asArray()
                    ->all();
                $conArr=[];
            if(!empty($contactDtls)){
                foreach($contactDtls as $key=>$list){
                    $list['dp'] = Drive::generateUrl($list['um_userdp'],$list['MemberCompMst_Pk'], $userpk).'&noimg=2';                    
                    $conArr[$list['DepartmentMst_Pk']]['list'][]=$list;
                    $conArr[$list['DepartmentMst_Pk']]['cnt']++;
                    $conArr[$list['DepartmentMst_Pk']]['dep']=$list['DM_Name'];
                }
                $conArr=array_values($conArr);
            }        
            return $conArr;   
        }
    }
}
