<?php

namespace api\modules\bs\components;
use Yii;
use common\components\Security;
use \common\models\MembercompanymstTbl;
use \api\modules\pms\models\CmscontracthdrTbl;
use \api\modules\pms\models\CmsawarddtlsTbl;
use \api\modules\pms\models\CmstenderhdrTbl;
use \api\modules\bs\components\Internalsearch;

class Domaincontractorsearch {
    //{"savedata":{"searchType":2,"criteriaType":"2","keyword":[],"filterData":"","saveName":"ttt","queryAll":true}}

    public function domainContractorCriteria($isDemo){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        if($isDemo){
            // Contracts Received
            $contractsReceivedQuery = self::contractsReceivedCount($cmpPK);

            // Awardees
            $awardeesQuery = self::awardeesCount($cmpPK);

            // Opportunities Created
            $opportunitiesCreatedQuery = self::opportunitiesCreatedCount($cmpPK);

            // Contracts Created
            $contractsCreatedQuery = self::contractsCreatedCount($cmpPK);


            // Doamin Contractor final query
            $domainContractorQuery = MembercompanymstTbl::find()
                                ->where(['MemberCompMst_Pk'=>$cmpPK])
                                ->addSelect([
                                    'contractsReceivedCount'=>'('.$contractsReceivedQuery->createCommand()->getRawSql().')',
                                    'awardeesCount'=>'('.$awardeesQuery->createCommand()->getRawSql().')',
                                    'opportunitiesCreatedCount'=>'('.$opportunitiesCreatedQuery->createCommand()->getRawSql().')',
                                    'contractsCreatedCount'=>'('.$contractsCreatedQuery->createCommand()->getRawSql().')',
                                ]);
            $domainContractorResult = $domainContractorQuery->asArray()->one();

            $overAllCount = $domainContractorResult['contractsReceivedCount'] + $domainContractorResult['awardeesCount'] + $domainContractorResult['opportunitiesCreatedCount'] + $domainContractorResult['contractsCreatedCount'];

            return [
                [
                    'criteriaType'=>'1',
                    'criteriaName'=>'All',
                    'criteriaCount'=>$overAllCount,
                    'stakeholderType'=>[],
                ],
                [
                    'criteriaType'=>'2',
                    'criteriaName'=>'Contracts Received',
                    'criteriaCount'=>$domainContractorResult['contractsReceivedCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'3',
                    'criteriaName'=>'Awardees',
                    'criteriaCount'=>$domainContractorResult['awardeesCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'5',
                    'criteriaName'=>'Opportunities Created',
                    'criteriaCount'=>$domainContractorResult['opportunitiesCreatedCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'6',
                    'criteriaName'=>'Contracts Created',
                    'criteriaCount'=>$domainContractorResult['contractsCreatedCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
            ];
        }else{
            return [
                [
                    'criteriaType'=>'1',
                    'criteriaName'=>'All',
                    'criteriaCount'=>49,
                    'stakeholderType'=>[],
                ],
                [
                    'criteriaType'=>'2',
                    'criteriaName'=>'Contracts Received',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'3',
                    'criteriaName'=>'Awardees',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                // [
                //     'criteriaType'=>'4',
                //     'criteriaName'=>'My Invoices',
                //     'criteriaCount'=>8,
                //     'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                // ],
                [
                    'criteriaType'=>'5',
                    'criteriaName'=>'Opportunities Created',
                    'criteriaCount'=>9,
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'6',
                    'criteriaName'=>'Contracts Created',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                ],
                // [
                //     'criteriaType'=>'7',
                //     'criteriaName'=>'Contractors - ICV Performance',
                //     'criteriaCount'=>1,
                //     'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                // ],
                // [
                //     'criteriaType'=>'8',
                //     'criteriaName'=>'Invoices',
                //     'criteriaCount'=>8,
                //     'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
                // ],
            ];
        }        
    }

    public function contractsReceivedCount($cmpPK){
        $contractReceivedQuery = CmscontracthdrTbl::find()
                                ->select([
                                    'COUNT(cmscontracthdr_pk) as crCount'
                                ])
                                ->innerJoin('cmsawarddtls_tbl','cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                                ->leftJoin('usermst_tbl','UserMst_Pk = cmsch_createdby')
                                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                ->where([
                                    'cmsad_memcompmst_fk' => $cmpPK
                                ]);
        return $contractReceivedQuery;
    }

    public function awardeesCount($cmpPK){
        $awardeesQuery = CmsawarddtlsTbl::find()
                                ->select([
                                    'COUNT(cmsawarddtls_pk) as awdCount'
                                ])
                                ->innerJoin('cmscontracthdr_tbl','cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                                ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk = MemberRegMst_Pk')
                                ->where([
                                    'cmsad_isdeactivated' => 0,
                                    'cmsch_memcompmst_fk' => $cmpPK,
                                ]);
        return $awardeesQuery;
    }

    public function opportunitiesCreatedCount($cmpPK){
        $opportunitiesCreatedQuery = CmstenderhdrTbl::find()
                                ->select([
                                    'COUNT(cmstenderhdr_pk) as awdCount'
                                ])
                                ->where([
                                    'cmsth_memcompmst_fk' => $cmpPK,
                                ]);
        return $opportunitiesCreatedQuery;
    }

    public function contractsCreatedCount($cmpPK){
        $contractReceivedQuery = CmscontracthdrTbl::find()
                                ->select([
                                    'COUNT(cmscontracthdr_pk) as ccCount'
                                ])
                                ->leftJoin('cmsawarddtls_tbl','cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                                ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                                ->where([
                                    'cmsch_memcompmst_fk' => $cmpPK
                                ]);
        return $contractReceivedQuery;
    }

    public function domainContractorSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh='', $smartSrh=''){
        switch ($criteriaType) {
            case '2': // Contracts Received
                $finalQuery = self::contractsReceivedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '3': // Awardees
                $finalQuery = self::awardeesSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '5': // Opportunities Created
                $finalQuery = self::opportunitiesCreatedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '6': // Contracts Created
                $finalQuery = self::contractsCreatedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
        }
        return $finalQuery;
    }

    public static function contractsReceivedSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
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
            $smartFilter['contractReceived'] = $smartSrh->contractReceived;
            $smartFilter['contractStatus'] = $smartSrh->contractStatus;
            $smartFilter['obligation'] = $smartSrh->obligation;
        }

        $contractReceivedQuery = CmscontracthdrTbl::find()
                                ->select([
                                    'UM_EmpId as employeeId',
                                    'cmsch_contractrefno as contractRefNo',
                                    'cmsch_contracttitle as contrctTitle',
                                    '(case cmsch.cmsch_obligation when 1 then "MSME" when 2 then "LCC" when 3 then "MSME & LCC" when 4 then "Others" when 5 then "Not Applicable" end) as  obligation',
                                    '(case cmsch.cmsch_issubcontrqmt when 1 then "Contract" when 2 then "Sub Contract" end) as  contractType',
                                    'cmsch.cmsch_issubcontrqmt as  isContract',
                                    'date_format(COALESCE(cmsad.cmsad_awardedon),\'%d-%m-%Y\') as awardedOn',
                                    'cmsch.cmsch_contractperiod as duration',
                                    'cmsch.cmsch_contractvalue as contractValue',
                                    'mcm.MCM_CompanyName as compnayName',
                                    '(case mrm.mrm_stkholdertypmst_fk when 1 then "Portal Admin" when 6 then "Supplier" when 7 then "Buyer" when 11 then "Project Owner" end) as  memberType'
                                ])
                                ->from('cmscontracthdr_tbl cmsch')
                                ->innerJoin('cmsawarddtls_tbl cmsad','cmsch.cmscontracthdr_pk = cmsad.cmsad_cmscontracthdr_fk')
                                ->leftJoin('usermst_tbl um','um.UserMst_Pk = cmsch.cmsch_createdby')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = um.UM_MemberRegMst_Fk')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
                                ->where([
                                    'cmsad_memcompmst_fk' => $cmpPK
                                ]);

        if(isset($smartFilter['contractReceived']) && !empty($smartFilter['contractReceived'])){
            $contractReceivedQuery->andWhere(['in', 'MemberCompMst_Pk', $smartFilter['contractReceived']]);
        }

        if(isset($smartFilter['contractStatus']) && !empty($smartFilter['contractStatus'])){
            $contractReceivedQuery->andWhere(['in', 'cmsch_contractstatus', $smartFilter['contractStatus']]);
        }

        if(isset($smartFilter['obligation']) && !empty($smartFilter['obligation'])){
            $contractReceivedQuery->andWhere(['in', 'cmsch_obligation', $smartFilter['obligation']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,2);
        }

        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $contractReceivedQuery->andWhere($finalFormation);
        }
        

        if(!empty($searchKey)){
           $contractReceivedQuery->andWhere(['OR',
                                ['OR LIKE','UM_EmpId',$searchKey],
                                ['OR LIKE','cmsch_contractrefno',$searchKey],
                                ['OR LIKE','cmsch_contracttitle',$searchKey],
                                ['OR LIKE','MCM_CompanyName',$searchKey],
                            ]);
        }

        if($searchSort == 'Desc'){
            $contractReceivedQuery->orderBy(['cmsch_contracttitle'=>SORT_DESC]); 
        }else{
            $contractReceivedQuery->orderBy(['cmsch_contracttitle'=>SORT_ASC]);
        }

        $contractReceivedQueryResult = $contractReceivedQuery->asArray();
        //echo'<pre>';print_r($contractReceivedQueryResult->createCommand()->getRawSql());exit;
        return $contractReceivedQueryResult;
    }

    public static function awardeesSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){

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
            $smartFilter['awardedTo'] = $smartSrh->awardedTo;
            $smartFilter['jsrsStatus'] = $smartSrh->jsrsStatus;
        }

        $awardeesQuery = CmsawarddtlsTbl::find()
                                ->select([
                                    'count(cmsawarddtls_pk) as contractsAwarded',
                                    'sum(cmsad_awardamt) as totalContractValue',
                                    'AVG(cmsad_avgappraisal) as performanceApprisal',
                                    'cmsch_contractstatus as awardeeStatus',
                                    'MCM_CompanyName as companyName',
                                    '(case mrm_stkholdertypmst_fk when 1 then "Portal Admin" when 6 then "Supplier" when 7 then "Buyer" when 11 then "Project Owner" end) as  memberType',
                                    'COALESCE(mrm_supplierid, mrm_buyerid) as supBuyId',
                                    'mcm_externalproflink as profileLink',
                                    'if(max(mcaah_expirydate) >= current_date(),1,0) as comsts',
                                ])
                                ->from('cmsawarddtls_tbl cmsad')
                                ->innerJoin('cmscontracthdr_tbl cmsch','cmsad.cmsad_cmscontracthdr_fk = cmsch.cmscontracthdr_pk')
                                ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk = MemberRegMst_Pk')
                                ->where([
                                    'cmsad_isdeactivated' => 0,
                                    'cmsch_memcompmst_fk' => $cmpPK,
                                ]);

        if(isset($smartFilter['awardedTo']) && !empty($smartFilter['awardedTo'])){
            $awardeesQuery->andWhere(['in', 'MemberCompMst_Pk', $smartFilter['awardedTo']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,3);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $awardeesQuery->andWhere($finalFormation);
        }

        if(!empty($searchKey)){
           $awardeesQuery->andWhere(['OR',
                                ['OR LIKE','MCM_CompanyName',$searchKey],
                                ['OR LIKE','mrm_supplierid',$searchKey],
                                ['OR LIKE','mrm_buyerid',$searchKey]
                            ]);
        }

        $awardeesQuery->groupBy('cmsad_memcompmst_fk');

        if (isset($smartFilter['jsrsStatus']) && !empty($smartFilter['jsrsStatus'])) {
            if (in_array('A', $smartFilter['jsrsStatus']) && in_array('E', $smartFilter['jsrsStatus'])) {
            } elseif (in_array('A', $smartFilter['jsrsStatus'])) {
                $awardeesQuery->having('comsts = 1');
            } elseif (in_array('E', $smartFilter['jsrsStatus'])) {
                $awardeesQuery->having('comsts = 0');
            }
        }

        if($searchSort == 'Desc'){
            $awardeesQuery->orderBy(['cmsch_contracttitle'=>SORT_DESC]); 
        }else{
            $awardeesQuery->orderBy(['cmsch_contracttitle'=>SORT_ASC]);
        }
        
        $awardeesQueryResult = $awardeesQuery->asArray();
        //echo'<pre>';print_r($awardeesQueryResult->createCommand()->getRawSql());exit;
        return $awardeesQueryResult;
    }    

    public static function opportunitiesCreatedSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){

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
            $smartFilter['noticeType'] = $smartSrh->noticeType;
            $smartFilter['noticeStatus'] = $smartSrh->noticeStatus;
        }

        $opportunitiesCreatedQuery = CmstenderhdrTbl::find()
                                ->select([
                                    'cmsth_refno as oppRefNo',
                                    'cmsth_title as oppTitle',
                                    '(case cmsth_obligation when 1 then "MSME" when 2 then "LCC" when 3 then "MSME & LCC" when 4 then "Others" when 5 then "Not Applicable" end) as  obligation',
                                    'cmsth_issubcontrqmt as  isContract',
                                    '(case cmsth_type when 1 then "RFI" when 2 then "EOI" when 3 then "RFP" when 4 then "RFQ" when 5 then "PQ" when 6 then "RFT" end) as  noticeType',
                                    'date_format(COALESCE(cmsth_skdstartdate),\'%d-%m-%Y\') as publishedOn',
                                    'cmsth_tgtmailcount as targetedSuppliers',
                                    'date_format(COALESCE(cmsth_skdclosedate),\'%d-%m-%Y\') as closingDate',
                                    '(case cmsth_tenderstatus when 1 then "Yet to Submit" when 2 then "Submitted" when 3 then "Shortlisted" when 4 then "Rejected" when 5 then "Awarded" when 6 then "Terminated" when 7 then "Closed" when 8 then "Yet to Award" when 9 then "Yet to Shortlist" when 10 then "Shortlisting in Progress" end) as  tenderStatus'
                                ])
                                ->where([
                                    'cmsth_memcompmst_fk' => $cmpPK,
                                ]);

        if(isset($smartFilter['noticeType']) && !empty($smartFilter['noticeType'])){
            $opportunitiesCreatedQuery->andWhere(['in', 'cmsth_type', $smartFilter['noticeType']]);
        }

        if(isset($smartFilter['noticeStatus']) && !empty($smartFilter['noticeStatus'])){
            $opportunitiesCreatedQuery->andWhere(['in', 'cmsth_tenderstatus', $smartFilter['noticeStatus']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,5);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $opportunitiesCreatedQuery->andWhere($finalFormation);
        }

        if(!empty($searchKey)){
           $opportunitiesCreatedQuery->andWhere(['OR',
                                ['OR LIKE','cmsth_refno',$searchKey],
                                ['OR LIKE','cmsth_title',$searchKey]
                            ]);
        }

        if($searchSort == 'Desc'){
            $opportunitiesCreatedQuery->orderBy(['cmsth_title'=>SORT_DESC]); 
        }else{
            $opportunitiesCreatedQuery->orderBy(['cmsth_title'=>SORT_ASC]);
        }
        
        $opportunitiesCreatedQueryResult = $opportunitiesCreatedQuery->asArray();
        // echo'<pre>';print_r($opportunitiesCreatedQueryResult->createCommand()->getRawSql());exit;
        return $opportunitiesCreatedQueryResult;
    }


    public static function contractsCreatedSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){

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
            $smartFilter['contractStatus'] = $smartSrh->contractStatus;
            $smartFilter['awardedTo'] = $smartSrh->awardedTo;
            $smartFilter['obligation'] = $smartSrh->obligation;
        }

        $contractReceivedQuery = CmscontracthdrTbl::find()
                                ->select([
                                    'UM_EmpId as employeeId',
                                    'cmsch_contractrefno as contractRefNo',
                                    'cmsch_contracttitle as contrctTitle',
                                    '(case cmsch.cmsch_obligation when 1 then "MSME" when 2 then "LCC" when 3 then "MSME & LCC" when 4 then "Others" when 5 then "Not Applicable" end) as  obligation',
                                    '(case cmsch.cmsch_issubcontrqmt when 1 then "Contract" when 2 then "Sub Contract" end) as  contractType',
                                    'cmsch.cmsch_issubcontrqmt as isContract',
                                    'date_format(COALESCE(cmsad.cmsad_awardedon),\'%d-%m-%Y\') as awardedOn',
                                    'cmsch.cmsch_contractperiod as duration',
                                    'cmsch.cmsch_contractvalue as contractValue',
                                    'mcm.MCM_CompanyName as compnayName',
                                ])
                                ->from('cmscontracthdr_tbl cmsch')
                                ->leftJoin('cmsawarddtls_tbl cmsad','cmsch.cmscontracthdr_pk = cmsad.cmsad_cmscontracthdr_fk')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MemberCompMst_Pk = cmsad.cmsad_memcompmst_fk')
                                ->where([
                                    'cmsch_memcompmst_fk' => $cmpPK
                                ]);

        if(isset($smartFilter['contractStatus']) && !empty($smartFilter['contractStatus'])){
            $contractReceivedQuery->andWhere(['in', 'cmsth_tenderstatus', $smartFilter['contractStatus']]);
        }

        if(isset($smartFilter['awardedTo']) && !empty($smartFilter['awardedTo'])){
            $contractReceivedQuery->andWhere(['in', 'MemberCompMst_Pk', $smartFilter['awardedTo']]);
        }

        if(isset($smartFilter['obligation']) && !empty($smartFilter['obligation'])){
            $contractReceivedQuery->andWhere(['in', 'cmsch_obligation', $smartFilter['obligation']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,6);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $contractReceivedQuery->andWhere($finalFormation);
        }

        if(!empty($searchKey)){
           $contractReceivedQuery->andWhere(['OR',
                                ['OR LIKE','UM_EmpId',$searchKey],
                                ['OR LIKE','cmsch_contractrefno',$searchKey],
                                ['OR LIKE','cmsch_contracttitle',$searchKey],
                                ['OR LIKE','MCM_CompanyName',$searchKey]
                            ]);
        }
        
        if($searchSort == 'Desc'){
            $contractReceivedQuery->orderBy(['cmsch_contracttitle'=>SORT_DESC]); 
        }else{
            $contractReceivedQuery->orderBy(['cmsch_contracttitle'=>SORT_ASC]);
        }

        $contractReceivedQueryResult = $contractReceivedQuery->asArray();
        // echo'<pre>';print_r($contractReceivedQueryResult->createCommand()->getRawSql());exit;
        return $contractReceivedQueryResult;
    }
}
