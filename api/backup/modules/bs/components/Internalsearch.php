<?php

namespace api\modules\bs\components;
use common\components\Security;
use \common\models\UsermstTbl;
use \common\models\MemcompsectordtlsTbl;
use \common\models\MemcompproddtlsTbl;
use \common\models\MemcompservicedtlsTbl;
use \common\models\MemcompmplocationdtlsTbl;
use \common\models\MemcompbussrcdtlsTbl;
use \api\modules\bs\components\Userfilter;
use \api\modules\bs\components\Monitorlogfilter;
use \api\modules\bs\components\Productfilter;
use \api\modules\bs\components\Servicefilter;
use \api\modules\bs\components\Businessunitfilter;
use \api\modules\bs\components\Marketpresencefilter;
use \api\modules\bs\components\Domainsearch;
use yii\db\Expression;
use Yii;
class Internalsearch {

    public static function userSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        // basedd on accordion choosen
        $searchKeyArr = [];
        if(!empty($filterSrh)){
            foreach ($filterSrh as $fskey => $filterType) {
                if(is_array($filterType)){
                    if($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal){
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        //print_r($searchKeyArr);die();
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);

        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['division'] = $smartSrh->division;
            $smartFilter['department'] = $smartSrh->department;
            $smartFilter['designationLevel'] = $smartSrh->designationLvl;
        }
        $userSearchQuery = UsermstTbl::find()
                            ->select([
                                'UserMst_Pk as userPk',
                                'mcfd.mcfd_origfilename as userImage',
                                'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ") as fullName',
                                'um.um_firstname as firstName',
                                'um.um_middlename as middleName',
                                'um.um_lastname as lastName',
                                'dsg.dsg_designationname as designation',
                                'um.UM_EmpId as employeeId',
                                'group_concat(DISTINCT dm.DM_Name) as departmentName',
                                'um.um_primobno as mobileNo',
                                'um.UM_EmailID as emailId',
                                'group_concat(DISTINCT mcsd.mcsd_businessunitrefname)  as businessUnit',
                                '(case um.UM_Status when "A" then "Active" when "I" then "InActive" end) as status',
                                'mcuf.mcpsfd_status as followStatus',
                                'um.um_userdp as imagePk',
                                'REPLACE(cmt.CyM_CountryDialCode,"00","+") as mobileCountryCode',
                            ])
                            ->from('usermst_tbl um')
                            ->leftJoin('memcompfiledtls_tbl mcfd',' mcfd.memcompfiledtls_pk = um.um_userdp')
                            ->leftJoin('countrymst_tbl cmt','um.um_primobnocc = cmt.CountryMst_Pk')
                            //->leftJoin('departmentmst_tbl dm','dm.DepartmentMst_Pk = um.um_departmentmst_fk')
                            ->leftJoin('departmentmst_tbl dm','find_in_set(dm.DepartmentMst_Pk, um.um_departmentmst_fk)')
                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk=mrm.MemberRegMst_Pk')
                            ->leftJoin('designationmst_tbl dsg','dsg.designationmst_pk = um.UM_Designation')
                            ->leftJoin('designationlevelmst_tbl dlm','dlm.designationlevelmst_pk = um.um_desiglevel')
                            ->leftJoin('memcompsectordtls_tbl mcsd','find_in_set(MemCompSecDtls_Pk, um_busunit)')
                            ->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')
                            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf','um.UserMst_Pk = mcuf.mcpsfd_shared_fk and mcpsfd_followtype = 5 and mcpsfd_type = 10 and mcpsfd_usermst_fk='.$userpk);

        if(in_array('marketPresenceFilter', $searchKeyArr)){
            $userSearchQuery->leftJoin('memcompmplocationdtls_tbl mcp','mcm.MemberCompMst_Pk = mcp.mcmpld_membercompmst_fk')
                            ->leftJoin('countrymst_tbl mcp_cym','mcp_cym.CountryMst_Pk = mcp.mcmpld_countrymst_fk');
        }

        if(in_array('productFilter', $searchKeyArr)){
            $userSearchQuery->leftJoin('memcompproddtls_tbl mcprdu','find_in_set(um.UserMst_Pk,mcprdu.mcprd_contactinfo)');
        }

        if(in_array('serviceFilter', $searchKeyArr)){
            $userSearchQuery->leftJoin('memcompservicedtls_tbl mcsdu','find_in_set(um.UserMst_Pk,mcsdu.mcsvd_contactinfo)');
        }

        if(in_array('monitorLogFilter', $searchKeyArr)){
            $userSearchQuery->leftJoin('usermonitorlog_tbl uml','uml.uml_usermst_fk = um.usermst_pk')
                            ->leftJoin('basemodulemst_tbl as bmm','bmm.basemodulemst_pk = uml.uml_basemodulemst_fk');
        }

        if(in_array('ProjectsFilter', $searchKeyArr)){ // doubt
            $userSearchQuery->leftJoin('projectdtls_tbl prjd','mcm.MCM_MemberRegMst_Fk = prjd.prjd_memberregmst_fk');
        }

        $userSearchQuery->where([
                            'mcm.MemberCompMst_Pk'=>$cmpPK,
                            //'um.UM_Type'=>'U',
                            'um.UM_Status'=>'A', 
                            'um_emailconfirmstatus'=>1    
                        ]);
        //$userSearchQuery->andWhere(['um.UM_Type'=>'U','um.UM_Type'=>'A']);
        $userSearchQuery->andWhere(['not', ['um_emailconfirmstatus' => null,'um.UM_Type' =>'PA']]);

        if(isset($smartFilter['division']) && !empty($smartFilter['division'])){
            $userSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['division']]);
        }

        if(isset($smartFilter['department']) && !empty($smartFilter['department'])){
            $userSearchQuery->andWhere(['in', 'dm.DepartmentMst_Pk', $smartFilter['department']]);
        }

        if(isset($smartFilter['designationLevel']) && !empty($smartFilter['designationLevel'])){
            $userSearchQuery->andWhere(['in', 'um.um_desiglevel', $smartFilter['designationLevel']]);
        }

        if(!empty($searchKey)){
            
           $userSearchQuery->andWhere(['OR',
                                ['OR LIKE','um_userrefno',$searchKey],
                                ['OR LIKE','UM_EmpId',$searchKey],
                                ['OR LIKE','um_division',$searchKey],
                                ['OR LIKE','dsg.dsg_designationname',$searchKey],
                                ['OR LIKE','um_desiglevel',$searchKey],
                                ['OR LIKE','dm.DM_Name',$searchKey],
                                ['OR LIKE','um_gender',$searchKey],
                                ['OR LIKE','um_dob',$searchKey],
                                ['OR LIKE','UM_EmailID',$searchKey],
                                ['OR LIKE','um_primobno',$searchKey],
                                ['OR LIKE','um_landlineno',$searchKey],
                                //['OR LIKE','um_faxno',$searchKey],
                                ['OR LIKE','um_socialmedia',$searchKey],
                                ['OR LIKE','UM_ExternalLink',$searchKey],
                                ['OR LIKE','um_busunit',$searchKey],
                                //['OR LIKE','um_branchname',$searchKey],
                                ['OR LIKE','dlm.dlm_desglevelname',$searchKey],
                                ['OR LIKE','mcsd.mcsd_businessunitrefname',$searchKey],
                                ['OR LIKE','sm.SecM_SectorName',$searchKey],
                                ['OR LIKE','REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',$searchKey],
                            ]);
        }

        //Advance filter
        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = self::advanceCoditionFormation($filterSrh,1,2);
        }

        //print_r($finalFormation);die();
        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $userSearchQuery->andWhere($finalFormation);
        }

        if($searchSort == 'Desc'){
           $userSearchQuery->orderBy(['um_firstname'=>SORT_DESC]); 
        }else{
            $userSearchQuery->orderBy(['um_firstname'=>SORT_ASC]);
        }
        $userSearchQuery->groupBy('UserMst_Pk');
        $userSearchQueryResult = $userSearchQuery->asArray();
        //print_r($userSearchQueryResult->createCommand()->getRawSql());exit;
        return $userSearchQueryResult;
    }

    public static function bunitSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
        $searchKeyArr = [];
        if(!empty($filterSrh)){
            foreach ($filterSrh as $fskey => $filterType) {
                if(is_array($filterType)){
                    if($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal){
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['division'] = $smartSrh->division;
            $smartFilter['sector'] = $smartSrh->sector;
        }

        $bunitSearchQuery = MemcompsectordtlsTbl::find()
                                ->select([
                                    'MemCompSecDtls_Pk as bUnitPk',
                                    'mcsd_referenceno as businessUnitId',
                                    'mcsd_bunitdesc as description',
                                    'group_concat(DISTINCT sm.SecM_SectorName SEPARATOR ", ") as sectorName',
                                    'mcsd_businessunitrefname as businessUnitRefName',
                                ])
                                ->from('memcompsectordtls_tbl mcsd')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MemberCompMst_Pk = mcsd.MCSD_MemberCompMst_Fk')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
                                ->leftJoin('sectormst_tbl sm','find_in_set(sm.SectorMst_Pk, mcsd.MCSD_SectorMst_Fk)')
                                ->leftJoin('memcompbussrcdtls_tbl mcbsd','mcbsd.mcbsd_memcompsecdtls_fk = mcsd.MemCompSecDtls_Pk')
                                ->leftJoin('businesssourcemst_tbl bsm','bsm.businesssourcemst_pk = mcbsd.mcbsd_businesssourcemst_fk');
        
        if(in_array('userFilter', $searchKeyArr)){
            $bunitSearchQuery->leftJoin('usermst_tbl um','find_in_set(mcsd.MemCompSecDtls_Pk,um.um_busunit) and um.UM_Status = \'A\'')
                            ->leftJoin('departmentmst_tbl dm','um.um_departmentmst_fk = dm.DepartmentMst_Pk')
                            ->leftJoin('designationmst_tbl dsg','dsg.designationmst_pk = um.UM_Designation');
        }

        if(in_array('projectsFilter', $searchKeyArr)){
            $bunitSearchQuery->leftJoin('projectdtls_tbl prjd','prjd.prjd_sectormst_fk = sm.SectorMst_Pk');
        }

        if(in_array('productsFilter', $searchKeyArr)){
            $bunitSearchQuery->innerJoin('memcompprodbussrcmap_tbl mcpbm','mcbsd.memcompbussrcdtls_pk = mcpbm.mcpbsm_memcompbussrcdtls_fk')
                            ->leftJoin('memcompproddtls_tbl mcprd','mcpbm.mcpbsm_memcompproddtls_fk = mcprd.MemCompProdDtls_Pk')
                            ->leftJoin('productmst_tbl pm','pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk');
        }

        if(in_array('serviceFilter', $searchKeyArr)){
            $bunitSearchQuery->innerJoin('memcompservbussrcmap_tbl mcsbm','mcbsd.memcompbussrcdtls_pk = mcsbm.mcsbsm_memcompbussrcdtls_fk')
                            ->leftJoin('memcompservicedtls_tbl mcsvd','mcsbm.mcsbsm_memcompservdtls_fk = mcsvd.MemCompServDtls_Pk')
                            ->leftJoin('servicemst_tbl smt','smt.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk');
        }
                                
        $bunitSearchQuery->where(['mcsd.MCSD_MemberCompMst_Fk'=>$cmpPK]);

        if(isset($smartFilter['division']) && !empty($smartFilter['division'])){
            $bunitSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['division']]);
        }

        if(isset($smartFilter['sector']) && !empty($smartFilter['sector'])){
            $bunitSearchQuery->andWhere(['in', 'sm.SectorMst_Pk', $smartFilter['sector']]);
        }


        if(!empty($searchKey)){
            $bunitSearchQuery->andWhere(['OR',
                                    ['OR LIKE','mcsd_businessunitrefname',$searchKey],
                                    ['OR LIKE','sm.SecM_SectorName',$searchKey],
                                    ['OR LIKE','mcsd_bunitdesc',$searchKey],
                                    ['OR LIKE','mcsd_referenceno',$searchKey],
                                ]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = self::advanceCoditionFormation($filterSrh,1,3);
        }
        //print_r($finalFormation );die();

        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $bunitSearchQuery->andWhere($finalFormation);
        }

        if($searchSort == 'Desc'){
            $bunitSearchQuery->orderBy(['mcsd.mcsd_businessunitrefname'=>SORT_DESC]);
        }else{
            $bunitSearchQuery->orderBy(['mcsd.mcsd_businessunitrefname'=>SORT_ASC]);
        }
        $bunitSearchQuery->groupBy('mcsd.MemCompSecDtls_Pk');
        $bunitSearchQueryResult = $bunitSearchQuery->asArray();
        //echo'<pre>';print_r($bunitSearchQueryResult->createCommand()->getRawSql());exit;
        return $bunitSearchQueryResult;
    }

    public static function monitorLogSearch($searchKey, $searchSort, $filterSrh, $smartSrh=''){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['division'] = $smartSrh->division;
            $smartFilter['department'] = $smartSrh->department;
            $smartFilter['designationLevel'] = $smartSrh->designationLvl;
        }

        $monitorLogSearchQuery = UsermstTbl::find()
                                    ->select([
                                        'UserMst_Pk as userPk',
                                        'mcfd.mcfd_origfilename as userImage',
                                        'concat_ws(" ", um.um_firstname, um.um_middlename, um.um_lastname) as fullName',
                                        'um.um_firstname as firstName',
                                        'um.um_middlename as middleName',
                                        'um.um_lastname as lastName',
                                        'dsg.dsg_designationname as designation',
                                        'um.UM_EmpId as empId',
                                        'um.um_primobno as mobileNo',
                                        '(case um.UM_Status when "A" then "Active" when "I" then "InActive" end) as status',
                                        '(substring_index(group_concat(bm.bmm_name order by usermonitorlog_pk desc),",",1)) as LastVisitedModule',
                                        '(count(distinct uml_basemodulemst_fk)) as visitedModuleCount',
                                        'mcuf.mcpsfd_status as followStatus',
                                        'uml_basemodulemst_fk',
                                        'um.um_userdp as imagePk',
                                        'REPLACE(cmt.CyM_CountryDialCode,"00","+") as mobileCountryCode',
                                    ])
                                    ->from('usermst_tbl um')
                                    ->leftJoin('memcompfiledtls_tbl mcfd','mcfd.memcompfiledtls_pk = um.um_userdp')
                                    ->leftJoin('countrymst_tbl cmt','um.um_primobnocc = cmt.CountryMst_Pk')
                                    //->leftJoin('departmentmst_tbl dm','dm.DepartmentMst_Pk = um.um_departmentmst_fk')
                                    ->leftJoin('departmentmst_tbl dm','find_in_set(dm.DepartmentMst_Pk, um.um_departmentmst_fk)')
                                    ->innerJoin('usermonitorlog_tbl uml','uml.uml_usermst_fk=um.usermst_pk')
                                    ->leftJoin('basemodulemst_tbl bm','bm.basemodulemst_pk = uml.uml_basemodulemst_fk')
                                    ->leftJoin('actionmst_tbl act','uml.uml_actperformed = act.actionmst_pk')
                                    ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                                    ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                    ->leftJoin('designationmst_tbl dsg','dsg.designationmst_pk = um.UM_Designation')
                                    ->leftJoin('designationlevelmst_tbl dlm','dlm.designationlevelmst_pk = um.um_desiglevel')
                                    ->leftJoin('memcompsectordtls_tbl mcsd','find_in_set(MemCompSecDtls_Pk, um_busunit)')
                                    ->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')
                                    ->leftJoin('memcompprdserfollowdtls_tbl as mcuf','um.UserMst_Pk = mcuf.mcpsfd_shared_fk and mcpsfd_followtype = 5 and mcpsfd_type = 10 and mcpsfd_status = 1 and mcpsfd_usermst_fk='.$userpk)
                                    
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK,
                                        'um.UM_Status'=>'A',
                                        'um.UM_Type'=>'U'
                                    ]);

        if(isset($smartFilter['division']) && !empty($smartFilter['division'])){
            $monitorLogSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['division']]);
        }

        if(isset($smartFilter['department']) && !empty($smartFilter['department'])){
            $monitorLogSearchQuery->andWhere(['in', 'dm.DepartmentMst_Pk', $smartFilter['department']]);
        }

        if(isset($smartFilter['designationLevel']) && !empty($smartFilter['designationLevel'])){
            $monitorLogSearchQuery->andWhere(['um.um_desiglevel'=>$smartFilter['designationLevel']]);
        }

        
        if(!empty($searchKey)){
            $monitorLogSearchQuery->andWhere(['OR',
                                        ['OR LIKE','um.um_userrefno',$searchKey],
                                        ['OR LIKE','um.um_firstname',$searchKey],
                                        ['OR LIKE','um.um_middlename',$searchKey],
                                        ['OR LIKE','um.um_lastname',$searchKey],
                                        ['OR LIKE','um.UM_EmpId',$searchKey],
                                        ['OR LIKE','um.um_division',$searchKey],
                                        ['OR LIKE','dsg.dsg_designationname',$searchKey],
                                        ['OR LIKE','um.um_desiglevel',$searchKey],
                                        ['OR LIKE','dm.DM_Name',$searchKey],
                                        ['OR LIKE','um.um_gender',$searchKey],
                                        ['OR LIKE','um.um_dob',$searchKey],
                                        ['OR LIKE','um.UM_EmailID',$searchKey],
                                        ['OR LIKE','um.um_primobno',$searchKey],
                                        ['OR LIKE','um.um_landlineno',$searchKey],
                                        //['OR LIKE','um.um_faxno',$searchKey],
                                        ['OR LIKE','um.um_socialmedia',$searchKey],
                                        ['OR LIKE','um.UM_ExternalLink',$searchKey],
                                        ['OR LIKE','um.um_busunit',$searchKey],
                                        //['OR LIKE','um.um_branchname',$searchKey],
                                        ['OR LIKE','bm.bmm_name',$searchKey],
                                        ['OR LIKE','dlm.dlm_desglevelname',$searchKey],
                                        ['OR LIKE','mcsd.mcsd_businessunitrefname',$searchKey],
                                        ['OR LIKE','sm.SecM_SectorName',$searchKey],
                                        ['OR LIKE','REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',$searchKey]
                                    ]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = self::advanceCoditionFormation($filterSrh,1,4);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $monitorLogSearchQuery->andWhere($finalFormation);
        }

        if($searchSort == 'Desc'){
            $monitorLogSearchQuery->orderBy(['um.um_firstname'=>SORT_DESC]);
        }else{
            $monitorLogSearchQuery->orderBy(['um.um_firstname'=>SORT_ASC]);
        }
        
        $monitorLogSearchQuery->groupBy('usermst_pk');
        $monitorLogSearchQueryResult = $monitorLogSearchQuery->asArray();
        //echo'<pre>';
        //print_r($monitorLogSearchQueryResult->createCommand()->getRawSql());exit;
        return $monitorLogSearchQueryResult;
    }

    public static function productSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
        //echo"goinginner";
        $searchKeyArr = [];
        if(!empty($filterSrh)){
            foreach ($filterSrh as $fskey => $filterType) {
                if(is_array($filterType)){
                    if($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal){
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);

        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['pdtDivision'] = $smartSrh->division;
            $smartFilter['pdtBSource'] = $smartSrh->bSource;
            $smartFilter['jsrsStatus'] = $smartSrh->jsrsStatus;
            $smartFilter['pdtRating'] = $smartSrh->pdtRating;
            $smartFilter['nationalPdt'] = $smartSrh->nationalPdt;
        }

        $productSearchQuery = MemcompproddtlsTbl::find()
                                ->select([
                                    'MemCompProdDtls_Pk as pdtPk',
                                    'MCPrD_DisplayName as displayName',
                                    'group_concat(mcfd_origfilename) as coverImages',
                                    'memcompfiledtls_pk as imagePK',
                                    'mcprd_prodrefno as pdtRefNo',
                                    'mcprd_prodmodelno as pdtModelNo',
                                    'MCPrD_SVFAdminApprovalStatus as productStatus',
                                    'MCPrD_ProdDesc as pdtDesc',
                                    'MCPrD_NationalProdStatus as nationalPdt',
                                    'group_concat(distinct bsm.bsm_bussrcname) as businessSource',
                                    'bipm.bicpm_productcode as bgiUnpscCode',
                                    'sgm.SegM_SegCode as segmentCode',
                                    'sgm.SegM_SegName as segmentName',
                                    'fm.FamM_FamilyCode as familyCode',
                                    'fm.FamM_FamilyName as familyName',
                                    'cm.ClsM_ClassCode as classCode',
                                    'cm.ClsM_ClassName as className',
                                    'pm.PrdM_ProductCode as productCode',
                                    'pm.PrdM_ProductName as productName',
                                    'count(fd.mcpsfd_followmemcompmst_fk) as followCount',
                                    'mcor_overallrating as overAllRating',
                                    'mcuf.mcpsfd_status as followStatus'
                                ])
                                ->from('memcompproddtls_tbl mcprd')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
                                ->leftJoin('memberregistrationmst_tbl mrm',' mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
                                ->leftJoin('memcompfiledtls_tbl mcfd','find_in_set(memcompfiledtls_pk,mcprd_prodcoverimgfile)')
                                ->leftJoin('productmst_tbl pm','pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk')
                                ->leftJoin('classmst_tbl cm','cm.ClassMst_Pk = pm.PrdM_ClassMst_Fk')
                                ->leftJoin('familymst_tbl fm','fm.FamilyMst_Pk = pm.PrdM_FamilyMst_Fk')
                                ->leftJoin('segmentmst_tbl sgm','sgm.SegmentMst_Pk = pm.PrdM_SegmentMst_Fk')
                                ->leftJoin('unspcbipcmapping_tbl upm','upm.ubpm_productmst_fk = pm.ProductMst_Pk')
                                ->leftJoin('bgiinduscodeprodmst_tbl bipm','bipm.bgiinduscodeprodmst_pk = upm.ubpm_bgiinduscodeprodmst_fk')
                                ->leftJoin('memcompprodbussrcmap_tbl mcpbsm','mcprd.MemCompProdDtls_Pk = mcpbsm.mcpbsm_memcompproddtls_fk')
                                ->leftJoin('memcompbussrcdtls_tbl mcb','mcpbsm.mcpbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk')
                                ->leftJoin('businesssourcemst_tbl bsm','bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk')
                                ->leftJoin('memcompprdserfollowdtls_tbl as fd','fd.mcpsfd_followmemcompmst_fk = mcprd.MemCompProdDtls_Pk and mcpsfd_type = 4 and mcpsfd_followtype = 2')
                                ->leftJoin('memcompprdserfollowdtls_tbl as mcuf','mcprd.MemCompProdDtls_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 2 and mcuf.mcpsfd_type = 3 and mcuf.mcpsfd_usermst_fk='.$userpk)
                                ->leftJoin('memcompoverallreview_tbl', 'MemCompProdDtls_Pk = mcor_shared_fk and mcor_type = 1');

        if(in_array('businessUnitFilter', $searchKeyArr) || (isset($smartFilter['pdtDivision']) && !empty($smartFilter['pdtDivision']))){
            $productSearchQuery->leftJoin('memcompsectordtls_tbl mcsd','mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                                ->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');
        }
        
        if(in_array('userFilter', $searchKeyArr)){
            $productSearchQuery->leftJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcprd.mcprd_contactinfo)')
                                ->leftJoin('departmentmst_tbl dm','dm.DepartmentMst_Pk = um.um_departmentmst_fk')
                                ->leftJoin('designationlevelmst_tbl dlm','dlm.designationlevelmst_pk = um_desiglevel');
        }

        if(in_array('marketPresenceFilter', $searchKeyArr)){
            $productSearchQuery->leftJoin('memcompmplocationdtls_tbl mcpld','mcm.MemberCompMst_Pk = mcpld.mcmpld_membercompmst_fk')
                                ->leftJoin('countrymst_tbl cntry','cntry.CountryMst_Pk = mcpld.mcmpld_countrymst_fk');
        }
        $productSearchQuery->where([
                        'mcprd.MCPrD_MemberCompMst_Fk' =>$cmpPK,
                        'MCPrD_SVFAdminApprovalStatus' => 'A'
                    ]);
        $productSearchQuery->andWhere(['not',['MCPrD_CreatedOn'=>null]]);
        // nationalPdt

        if(isset($smartFilter['pdtDivision']) && !empty($smartFilter['pdtDivision'])){
            $productSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['pdtDivision']]);
        }

        if(isset($smartFilter['pdtBSource']) && !empty($smartFilter['pdtBSource'])){
            $productSearchQuery->andWhere(['in', 'bsm.businesssourcemst_pk', $smartFilter['pdtBSource']]);
        }

        if(isset($smartFilter['jsrsStatus']) && !empty($smartFilter['jsrsStatus'])){
            if(in_array('A', $smartFilter['jsrsStatus']) && in_array('Y', $smartFilter['jsrsStatus'])){
            }elseif(in_array('A', $smartFilter['jsrsStatus'])){
                $productSearchQuery->andWhere(['mcprd.MCPrD_SVFAdminApprovalStatus'=>'A']);
            }elseif(in_array('Y', $smartFilter['jsrsStatus'])){
                $productSearchQuery->andWhere(['OR',
                    ['<>','mcprd.MCPrD_SVFAdminApprovalStatus', 'A'],
                    ['mcprd.MCPrD_SVFAdminApprovalStatus'=>null],
                    ['mcprd.MCPrD_SVFAdminApprovalStatus'=>'']
                ]);
            }
        }
        
        if(isset($smartFilter['pdtRating']) && !empty($smartFilter['pdtRating'])){
            $pdtRatingData = '';
            foreach ($smartFilter['pdtRating'] as $key => $pdtRating) {
                if($pdtRatingData != ''){
                    $pdtRatingData .= ' OR ';    
                }
                if(($pdtRating + 1) == 5){
                    $pdtRat = 5;    
                }else{
                    $pdtRat = ($pdtRating + 0.99);
                }
                $pdtRatingData .= '(mcor_overallrating BETWEEN '.$pdtRating.' AND '.$pdtRat.')';
            }
            $productSearchQuery->andWhere($pdtRatingData);
        }

        if(isset($smartFilter['nationalPdt']) && !empty($smartFilter['nationalPdt'])){
            if(in_array('Y', $smartFilter['nationalPdt']) && in_array('N', $smartFilter['nationalPdt'])){
            }elseif(in_array('Y', $smartFilter['nationalPdt'])){
                $productSearchQuery->andWhere(['MCPrD_NationalProdStatus'=>'Y']);
            }elseif(in_array('N', $smartFilter['nationalPdt'])){
                $productSearchQuery->andWhere(['MCPrD_NationalProdStatus'=>null]);
            }
        }

        if(!empty($searchKey)){
            $productSearchQuery->andWhere(['OR',
                                    ['OR LIKE','MCPrD_DisplayName',$searchKey],
                                    ['OR LIKE','MCPrD_ProdDesc',$searchKey],
                                    ['OR LIKE','mcprd_prodrefno',$searchKey],
                                    ['OR LIKE','mcprd_prodmodelno',$searchKey],
                                    ['OR LIKE','MCPrD_SearchKeyword',$searchKey],
                                    ['OR LIKE','sgm.SegM_SegCode',$searchKey],
                                    ['OR LIKE','sgm.SegM_SegName',$searchKey],
                                    ['OR LIKE','fm.FamM_FamilyCode',$searchKey],
                                    ['OR LIKE','fm.FamM_FamilyName',$searchKey],
                                    ['OR LIKE','cm.ClsM_ClassCode',$searchKey],
                                    ['OR LIKE','cm.ClsM_ClassName',$searchKey],
                                    ['OR LIKE','pm.PrdM_ProductCode',$searchKey],
                                    ['OR LIKE','pm.PrdM_ProductName',$searchKey]
                                ]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = self::advanceCoditionFormation($filterSrh,1,5);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $productSearchQuery->andWhere($finalFormation);
        }
        
        $productSearchQuery->andWhere(['!=', 'mcprd_isdeleted', 1]);

        if($searchSort == 'Desc'){
            $productSearchQuery->orderBy(['MCPrD_DisplayName'=>SORT_DESC]);
        }else{
            $productSearchQuery->orderBy(['MCPrD_DisplayName'=>SORT_ASC]);
        }
        $productSearchQueryResult = $productSearchQuery->groupBy('mcprd.MemCompProdDtls_Pk')
                                        ->asArray();
        //echo'<pre>';print_r($productSearchQueryResult->createCommand()->getRawSql());exit;
        return $productSearchQueryResult;
    }

    public static function serviceSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
        $searchKeyArr = [];
        if(!empty($filterSrh)){
            foreach ($filterSrh as $fskey => $filterType) {
                if(is_array($filterType)){
                    if($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal){
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);

        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['serDivision'] = $smartSrh->division;
            $smartFilter['serBSource'] = $smartSrh->bSource;
            $smartFilter['jsrsStatus'] = $smartSrh->jsrsStatus;
            $smartFilter['serRating'] = $smartSrh->serRating;
        }


        $serviceSearchQuery = MemcompservicedtlsTbl::find()
                                ->select([
                                    'MemCompServDtls_Pk as servicePk',
                                    'group_concat(mcfd_origfilename) as coverImages',
                                    'memcompfiledtls_pk as imagePK',
                                    'MCSvD_DisplayName as displayName',
                                    'mcsvd_servrefno as serviceRefNo',
                                    'mcsvd_servmodelno as serviceModelNo',
                                    'MCSvD_SVFAdminApprovalStatus as serviceStatus',
                                    'MCSvD_ServDesc as serviceDescription',
                                    'group_concat(distinct bsm.bsm_bussrcname) as businessSource',
                                    'sgm.SegM_SegCode as segmentCode',
                                    'sgm.SegM_SegName as segmentName',
                                    'fm.FamM_FamilyCode as familyCode',
                                    'fm.FamM_FamilyName as familyName',
                                    'cm.ClsM_ClassCode as classCode',
                                    'cm.ClsM_ClassName as className',
                                    'sm.SrvM_ServiceCode as serviceCode',
                                    'sm.SrvM_ServiceName as serviceName',
                                    'count(fd.mcpsfd_followmemcompmst_fk) as followCount',
                                    'mcor_overallrating as overAllRating',
                                    'mcuf.mcpsfd_status as followStatus'
                                ])
                                ->from('memcompservicedtls_tbl mcsvd')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MemberCompMst_Pk = mcsvd.MCSvD_MemberCompMst_Fk')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
                                ->leftJoin('memcompfiledtls_tbl mcfd','find_in_set(memcompfiledtls_pk,mcsvd_servcoverimgfile)')
                                ->leftJoin('servicemst_tbl sm','sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk')
                                ->leftJoin('classmst_tbl cm','cm.ClassMst_Pk=sm.SrvM_ClassMst_Fk')
                                ->leftJoin('familymst_tbl fm','fm.FamilyMst_Pk=sm.SrvM_FamilyMst_Fk')
                                ->leftJoin('segmentmst_tbl sgm','sgm.SegmentMst_Pk=sm.SrvM_SegmentMst_Fk')
                                ->leftJoin('unsscbiscmapping_tbl usm','usm.ubsm_servicemst_fk=sm.ServiceMst_Pk')
                                ->leftJoin('bgiinduscodeservmst_tbl bism','bism.bgiinduscodeservmst_pk=usm.ubsm_bgiinduscodeservmst_fk')
                                ->leftJoin('memcompservbussrcmap_tbl mcsbsm','mcsvd.MemCompServDtls_Pk = mcsbsm.mcsbsm_memcompservdtls_fk')
                                ->leftJoin('memcompbussrcdtls_tbl mcb','mcsbsm.mcsbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk')
                                ->leftJoin('businesssourcemst_tbl bsm','bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk')
                                ->leftJoin('memcompprdserfollowdtls_tbl as fd','fd.mcpsfd_followmemcompmst_fk = mcsvd.MemCompServDtls_Pk and mcpsfd_type = 6 and mcpsfd_followtype = 3')
                                ->leftJoin('memcompprdserfollowdtls_tbl as mcuf','mcsvd.MemCompServDtls_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 3 and mcuf.mcpsfd_type = 5 and mcuf.mcpsfd_usermst_fk='.$userpk)
                                ->leftJoin('memcompoverallreview_tbl', '    MemCompServDtls_Pk = mcor_shared_fk and mcor_type = 2');

        if(in_array('businessUnitFilter', $searchKeyArr) || (isset($smartFilter['serDivision']) && !empty($smartFilter['serDivision']))){
            $serviceSearchQuery->leftJoin('memcompsectordtls_tbl mcsd','mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                                ->leftJoin('sectormst_tbl secm','secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');
        }

        if(in_array('userFilter', $searchKeyArr)){
            $serviceSearchQuery->leftJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcsvd.mcsvd_contactinfo)')
                                ->leftJoin('departmentmst_tbl dm','dm.DepartmentMst_Pk = um.um_departmentmst_fk')
                                ->leftJoin('designationlevelmst_tbl dlm','dlm.designationlevelmst_pk = um_desiglevel');
        }

        if(in_array('marketPresenceFilter', $searchKeyArr)){
            $serviceSearchQuery->leftJoin('memcompmplocationdtls_tbl mcpld','mcm.MemberCompMst_Pk = mcpld.mcmpld_membercompmst_fk')
                                ->leftJoin('countrymst_tbl cntry','cntry.CountryMst_Pk = mcpld.mcmpld_countrymst_fk');
        }

        $serviceSearchQuery->where([
                    'mcm.MemberCompMst_Pk'         => $cmpPK,
                    'MCSvD_SVFAdminApprovalStatus' => 'A'
                ])->andWhere(['!=', 'mcsvd_isdeleted', 1]);
        $serviceSearchQuery->andWhere(['not',['MCSvD_CreatedOn'=>null]]);


        if(isset($smartFilter['serDivision']) && !empty($smartFilter['serDivision'])){
            $serviceSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['serDivision']]);
        }

        if(isset($smartFilter['serBSource']) && !empty($smartFilter['serBSource'])){
            $serviceSearchQuery->andWhere(['in', 'bsm.businesssourcemst_pk', $smartFilter['serBSource']]);
        }

        if(isset($smartFilter['jsrsStatus']) && !empty($smartFilter['jsrsStatus'])){
            if(in_array('A', $smartFilter['jsrsStatus']) && in_array('Y', $smartFilter['jsrsStatus'])){
            }elseif(in_array('A', $smartFilter['jsrsStatus'])){
                $serviceSearchQuery->andWhere(['mcsvd.MCSvD_SVFAdminApprovalStatus'=>'A']);
            }elseif(in_array('Y', $smartFilter['jsrsStatus'])){
                $serviceSearchQuery->andWhere(['OR',
                    ['<>','mcsvd.MCSvD_SVFAdminApprovalStatus', 'A'],
                    ['mcsvd.MCSvD_SVFAdminApprovalStatus'=>null],
                    ['mcsvd.MCSvD_SVFAdminApprovalStatus'=>'']
                ]);
            }
        }
        
        if(isset($smartFilter['serRating']) && !empty($smartFilter['serRating'])){
            $serRatingData = '';
            foreach ($smartFilter['serRating'] as $key => $serRating) {
                if($serRatingData != ''){
                    $serRatingData .= ' OR ';    
                }
                if(($serRating + 1) == 5){
                    $serRat = 5;    
                }else{
                    $serRat = ($serRating + 0.99);
                }
                $serRatingData .= '(mcor_overallrating BETWEEN '.$serRating.' AND '.$serRat.')';
            }
            $serviceSearchQuery->andWhere($serRatingData);
        }

        if(!empty($searchKey)){
            $serviceSearchQuery->andWhere(['OR',
                                    ['OR LIKE','mcsvd.MCSvD_DisplayName',$searchKey],
                                    ['OR LIKE','mcsvd.MCSvD_ServDesc',$searchKey],
                                    ['OR LIKE','mcsvd.mcsvd_servrefno',$searchKey],
                                    ['OR LIKE','mcsvd.mcsvd_servmodelno',$searchKey],
                                    ['OR LIKE','mcsvd.MCSvD_ServSearchKeyword',$searchKey],
                                    ['OR LIKE','sgm.SegM_SegCode',$searchKey],
                                    ['OR LIKE','sgm.SegM_SegName',$searchKey],
                                    ['OR LIKE','fm.FamM_FamilyCode',$searchKey],
                                    ['OR LIKE','fm.FamM_FamilyName',$searchKey],
                                    ['OR LIKE','cm.ClsM_ClassCode',$searchKey],
                                    ['OR LIKE','cm.ClsM_ClassName',$searchKey],
                                    ['OR LIKE','sm.SrvM_ServiceCode',$searchKey],
                                    ['OR LIKE','sm.SrvM_ServiceName',$searchKey]
                                ]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = self::advanceCoditionFormation($filterSrh,1,6);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $serviceSearchQuery->andWhere($finalFormation);
        }


        if($searchSort == 'Desc'){
            $serviceSearchQuery->orderBy(['mcsvd.MCSvD_DisplayName'=>SORT_DESC]);
        }else{
            $serviceSearchQuery->orderBy(['mcsvd.MCSvD_DisplayName'=>SORT_ASC]);
        }
        $serviceSearchQueryResult = $serviceSearchQuery->groupBy('mcsvd.MemCompServDtls_Pk')
                                ->asArray();
        //echo'<pre>';
        //print_r($serviceSearchQueryResult->createCommand()->getRawSql());exit;
        return $serviceSearchQueryResult;
    }

    public static function marketPresenceSearch($searchKey, $searchSort, $filterSrh){
        $searchKeyArr = [];
        if(!empty($filterSrh)){
            foreach ($filterSrh as $fskey => $filterType) {
                if(is_array($filterType)){
                    if($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal){
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $marketPresenceSearchQuery = MemcompmplocationdtlsTbl::find()
                                        ->select([
                                            '(case mcp.mcmpld_locationtype when 1 then "Primary" when 2 then "Branch Office" when 3 then "Representative" when 4 then "Factory / Manufacture" when 5 then "Trading" when 6 then "Wholesale / Distributor" when 7 then "Retailer" when 8 then "Agent" when 9 then "Government Agency / Organization" when 10 then "Stockist" when 11 then "Trade House" when 12 then "Other Market Presence" end) as type',
                                            'mcp.memcompmplocationdtls_pk as bUnitPk',
                                            'mcp.mcmpld_officename as orgName',
                                            'mcp.mcmpld_branchid as branchId',
                                            'mcp.mcmpld_crregno as crNo',
                                            'mcp.mcmpld_address as address',
                                            'cym.CountryMst_Pk as countryPk',
                                            'cym.CyM_CountryName_en as country',
                                            'sm.SM_StateName_en as state',
                                            'cm.CM_CityName_en as city',
                                            'mcp.mcmpld_landlinenocc as countryCode',
                                            'mcp.mcmpld_landlineno as landlineNo',
                                            'mcp.mcmpld_landlineext as landlineExtension',
                                            'mcp.mcmpld_emailid as emailId'
                                        ])
                                        ->from('memcompmplocationdtls_tbl mcp')
                                        ->leftJoin('membercompanymst_tbl mcm','mcm.MemberCompMst_Pk = mcp.mcmpld_membercompmst_fk')
                                        ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
                                        ->leftJoin('countrymst_tbl cym','cym.CountryMst_Pk = mcp.mcmpld_countrymst_fk')
                                        ->leftJoin('statemst_tbl sm','sm.StateMst_Pk = mcp.mcmpld_statemst_fk')
                                        ->leftJoin('citymst_tbl cm','cm.CityMst_Pk = mcp.mcmpld_citymst_fk');

        if(in_array('productsFilter', $searchKeyArr)){
            $marketPresenceSearchQuery->leftJoin('memcompproddtls_tbl mcprd','mcprd.MCPrD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                        ->leftJoin('productmst_tbl pm','pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk');
        }

        if(in_array('serviceFilter', $searchKeyArr)){
            $marketPresenceSearchQuery->leftJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                        ->leftJoin('servicemst_tbl smt','smt.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk');
        }

        $marketPresenceSearchQuery->where(['mcm.MemberCompMst_Pk'=>$cmpPK])
                                    ->andWhere(['OR',
                                        ['in','mcmpld_locationtype',[1,2,3,4,6,7,8,11,12]]
                                    ]);
        if(!empty($searchKey)){
            $marketPresenceSearchQuery->andWhere(['OR',
                                            ['OR LIKE','mcmpld_locationtype',$searchKey],
                                            ['OR LIKE','mcmpld_otherloc',$searchKey],
                                            ['OR LIKE','mcmpld_nationality',$searchKey],
                                            ['OR LIKE','mcmpld_officename',$searchKey],
                                            ['OR LIKE','mcmpld_crregno',$searchKey],
                                            ['OR LIKE','mcmpld_description',$searchKey],
                                            ['OR LIKE','mcmpld_branchid',$searchKey],
                                            ['OR LIKE','mcmpld_address',$searchKey],
                                            ['OR LIKE','mcmpld_primobno',$searchKey],
                                            ['OR LIKE','mcmpld_landlineno',$searchKey],
                                            ['OR LIKE','mcp.mcmpld_landlineext',$searchKey],
                                            //['OR LIKE','mcmpld_faxno',$searchKey],
                                            ['OR LIKE','mcmpld_emailid',$searchKey],
                                            ['OR LIKE','mcmpld_website',$searchKey],
                                            ['OR LIKE','cym.CyM_CountryName_en',$searchKey],
                                            ['OR LIKE','sm.SM_StateName_en',$searchKey],
                                            ['OR LIKE','cm.CM_CityName_en',$searchKey],
                                        ]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = self::advanceCoditionFormation($filterSrh,1,7);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $marketPresenceSearchQuery->andWhere($finalFormation);
        }


        if($searchSort == 'Desc'){
            $marketPresenceSearchQuery->orderBy(['mcp.mcmpld_officename'=>SORT_DESC]);
        }else{
            $marketPresenceSearchQuery->orderBy(['mcp.mcmpld_officename'=>SORT_ASC]);
        }
        $marketPresenceSearchQuery->groupBy('mcp.memcompmplocationdtls_pk');
        $marketPresenceSearchQueryResult = $marketPresenceSearchQuery->asArray();
        //echo'<pre>';print_r($marketPresenceSearchQueryResult->createCommand()->getRawSql());exit;
        return $marketPresenceSearchQueryResult;
    }

    public function businessUnitUserCount($bUnitPk){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $userCount = MemcompsectordtlsTbl::find()
                        ->select('mcsd_businessunitrefname, count(1) as userCount')
                        ->leftJoin('usermst_tbl','find_in_set(MemCompSecDtls_Pk,um_busunit)')
                        ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                        ->where(['MemCompSecDtls_Pk'=>$bUnitPk,'UM_Status'=>'A','MemberCompMst_Pk'=>$cmpPK])
                        ->groupBy('mcsd_businessunitrefname')
                        ->asArray()->one();
        return $userCount;
    }

    public function divisionBsourceCount($bUnitPk){
        $bunitBsourceCount = MemcompsectordtlsTbl::find()
                                ->select('bsm_bussrcname, count(1) as bSourceCount')
                                ->innerJoin('memcompbussrcdtls_tbl','mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk')
                                ->innerJoin('businesssourcemst_tbl','mcbsd_businesssourcemst_fk = businesssourcemst_pk')
                                ->where([
                                    'MemCompSecDtls_Pk'=>$bUnitPk,
                                    'bsm_status'=>1
                                ])
                                ->asArray()->one();
        return $bunitBsourceCount;
    }

    public function advanceCoditionFormation($filterSrh,$searchType,$criteriaType) {
        $gParentPrevDataType = $currentDataType = $gParentOrBracket = $parentDataType = $childDataType = $filterField = $filterCombination = $filterValue = $parentFormation = $childFormation = $finalFormation = '';
        $gpKey = 0;
        foreach ($filterSrh as $fsKey => $filterType) {
            $parentPrevDataType = $parentFormation = '';
            $gpKey += 1;
            foreach ($filterType as $ftKey => $parentArr) {
                $childPrevDataType = $childFormation = $parentOrBracket = '';
                $parentCount = 0;
                foreach ($parentArr->parent as $pKey => $childArr) {
                    if($childArr->type > 0 && $childArr->combination && $childArr->dataVal){
                        $parentCount += 1;
                        $filterField = $filterCombination = $filterValue = $startsWith = $endsWith = $childOrBracket = '';
                        
                        switch ($searchType) {
                            case '1':
                                $filterFieldCombination = self::internalFieldSearch($criteriaType, $fsKey, $childArr->type);
                                break;
                            case '2':
                                $filterFieldCombination = Domainsearch::domainFieldSearch($criteriaType, $fsKey, $childArr->type);
                                break;
                        }

                        $filterField = $filterFieldCombination['fieldName'];
                        
                        $filterCombination = $filterFieldCombination['combination'][$childArr->combination];

                        if($childArr->combination == 3){
                            $startsWith = '%';
                        } elseif($childArr->combination == 4){
                            $endsWith = '%';
                        } elseif($childArr->combination == 5 || $childArr->combination == 6){
                            $startsWith = '%';
                            $endsWith = '%';
                        }

                        if($childArr->combination == 9){
                            $startValue = date('Y-m-d',strtotime($childArr->dataVal->startDate)).' 00:00:00';
                            $endValue = date('Y-m-d',strtotime($childArr->dataVal->endDate)).' 00:00:00';
                        }else{
                            $filterValue = $endsWith.$childArr->dataVal.$startsWith;
                        }

                        if($pKey == 0){
                            $childFormation .= '(';
                        } 

                        if($pKey > 0 && $childPrevDataType == ' OR '){
                            $childOrBracket = '(';
                        }

                        if($childArr->combination == 9){
                            $childFormation .= $childPrevDataType.$childOrBracket.' ('.$filterField.' >= "'.$startValue.'" AND '.$filterField.' <= "'.$endValue.'") ';
                        } else {
                            
                            if($filterField == 'dm.DM_Name' && $filterCombination == '=') {
   
                                $childFormation .= $childPrevDataType.$childOrBracket.' ( FIND_IN_SET('.$filterValue.' '.','.' um.um_departmentmst_fk) ) ';    

                            } elseif($filterField == 'dm.DM_Name' && $filterCombination == '<>'){

                                $childFormation .= $childPrevDataType.$childOrBracket.' (NOT FIND_IN_SET('.$filterValue.' '.','.' um.um_departmentmst_fk) ) ';    

                            } else {
                                $childFormation .= $childPrevDataType.$childOrBracket.' ('.$filterField.' '.$filterCombination.' "'.$filterValue.'") ';    
                            }
                            
                        }

                        $childPrevDataType = ($childArr->dataType == '' || $childArr->dataType == "1")?' AND ':' OR ';

                        if($childPrevDataType ==  ' OR '){
                            $childFormation .= ')';
                        }
                    }

                }

                if($childFormation != ''){
                    $childFormation .= ')';

                    if($ftKey == 0){
                        $parentOrBracket .= '(';
                    } 

                    if($ftKey > 0 && $parentPrevDataType == ' OR '  && ($parentArr->parentDataType == '1' || $parentArr->parentDataType == '')){
                        $parentOrBracket = '(';
                    }

                    $parentFormation .= $parentPrevDataType.$parentOrBracket.' ('.$childFormation.') ';
                    $parentPrevDataType = ($parentArr->parentDataType == '' || $parentArr->parentDataType == "1")?' AND ':' OR ';

                    if($parentPrevDataType ==  ' OR '){
                        $parentFormation .= ')';
                    }
                }
            }
            
            if($parentFormation != '' || (($filterType == 1 || $filterType == 2) && $finalFormation !='')){
                if($parentFormation != ''){
                    $parentFormation .= ')';
                }

                if(($gpKey % 2) == 1 && $gpKey > 1){
                    $currentDataType = ($filterType == 1)?' AND ':' OR ';
                    $gParentOrBracket = '';
                }
                
                if($finalFormation == ''){
                    $gParentOrBracket = '(';
                }

                if(($gpKey % 2) == 0 && $currentDataType == ' OR ' && $finalFormation != ''){
                    $gParentOrBracket = '(';
                }

                if(($gpKey % 2) == 0 && $currentDataType == ' OR '){
                    $gParentOrCloseBracket = ')';
                }else{
                    $gParentOrCloseBracket = '';
                }

                if(($gpKey % 2) == 0 && $parentFormation !='' && $parentCount > 0){
                    $finalFormation .= $gParentOrCloseBracket.$currentDataType.$gParentOrBracket.' ('.$parentFormation.') ';
                }
            }
        }
        return $finalFormation;
    }

    public function internalFieldSearch($criteriaType, $fsKey, $type){
    
        if($criteriaType == 2){
            $filterFieldCombination = Userfilter::filterQueryFieldTypeFormation($fsKey, $type);
        }elseif($criteriaType == 4){
            $filterFieldCombination = Monitorlogfilter::filterQueryFieldTypeFormation($fsKey, $type);
        }elseif($criteriaType == 5){
            $filterFieldCombination = Productfilter::filterQueryFieldTypeFormation($fsKey, $type);
        }elseif($criteriaType == 6){
            $filterFieldCombination = Servicefilter::filterQueryFieldTypeFormation($fsKey, $type);
        }elseif($criteriaType == 3){
            $filterFieldCombination = Businessunitfilter::filterQueryFieldTypeFormation($fsKey, $type);
        }elseif($criteriaType == 7){
            $filterFieldCombination = Marketpresencefilter::filterQueryFieldTypeFormation($fsKey, $type);
        }
        return $filterFieldCombination;
    }
}
