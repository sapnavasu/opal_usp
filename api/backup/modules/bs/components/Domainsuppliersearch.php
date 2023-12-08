<?php

namespace api\modules\bs\components;
use Yii;
use common\components\Security;
use \common\models\MembercompanymstTbl;
use \api\modules\bs\components\Internalsearch;
use \api\modules\pms\models\CmstenderhdrTbl;
use \api\modules\pms\models\CmsawarddtlsTbl;

class Domainsuppliersearch {
    //{"savedata":{"searchType":2,"criteriaType":"2","keyword":[],"filterData":"","saveName":"ttt","queryAll":true}}

    

    public function domainSupplierCriteria($isDemo){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        if($isDemo){
            // Opportunities Received
            $opportunitiesReceivedQuery = self::opportinitesReceivedCount($regPK);

            // RFx Responded
            // $rfxRespondedQuery = self::rfxRespondedCount($cmpPK);

            // Awarded Contracts
            $awardedContractsQuery = self::awardedContractsCount($cmpPK);

            // GCC Tenders
            // $gccTendersQuery = self::gccTendersCount($cmpPK);

            // Buyers Opportunities
            $buyersOpportunitiesQuery = self::buyersOpportunitiesCount($regPK);

            // Doamin Supplier final query
            $domainSupplierQuery = MembercompanymstTbl::find()
                                ->where(['MemberCompMst_Pk'=>$cmpPK])
                                ->addSelect([
                                    'opportunitiesReceivedCount'=>'('.$opportunitiesReceivedQuery->createCommand()->getRawSql().')',
                                    //'rfxRespondedCount'=>'('.$rfxRespondedQuery->createCommand()->getRawSql().')',
                                    'awardedContractsCount'=>'('.$awardedContractsQuery->createCommand()->getRawSql().')',
                                    //'gccTendersCount'=>'('.$gccTendersQuery->createCommand()->getRawSql().')',
                                    'buyersOpportunitiesCount'=>'('.$buyersOpportunitiesQuery->createCommand()->getRawSql().')',
                                ]);
            $domainSupplierResult = $domainSupplierQuery->asArray()->one();

            $overAllCount = $domainSupplierResult['opportunitiesReceivedCount'] + $domainSupplierResult['awardedContractsCount'] + $domainSupplierResult['buyersOpportunitiesCount'];

            return [
                [
                    'criteriaType'=>'1',
                    'criteriaName'=>'All',
                    'criteriaCount'=>$overAllCount,
                    'stakeholderType'=>[],
                ],
                [
                    'criteriaType'=>'2',
                    'criteriaName'=>'Opportunities Received',
                    'criteriaCount'=>$domainSupplierResult['opportunitiesReceivedCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                ],
                [
                    'criteriaType'=>'4',
                    'criteriaName'=>'Awarded Contracts',
                    'criteriaCount'=>$domainSupplierResult['awardedContractsCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                ],
                [
                    'criteriaType'=>'6',
                    'criteriaName'=>'Buyers Opportunities',
                    'criteriaCount'=>$domainSupplierResult['buyersOpportunitiesCount'],
                    'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                ],
            ];
        }else{
            return [
                [
                    'criteriaType'=>'1',
                    'criteriaName'=>'All',
                    'criteriaCount'=>40,
                    'stakeholderType'=>[],
                ],
                [
                    'criteriaType'=>'2',
                    'criteriaName'=>'Opportunities Received',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                ],
                // [
                //     'criteriaType'=>'3',
                //     'criteriaName'=>'RFx Responded',
                //     'criteriaCount'=>8,
                //     'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                // ],
                [
                    'criteriaType'=>'4',
                    'criteriaName'=>'Awarded Contracts',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                ],
                // [
                //     'criteriaType'=>'5',
                //     'criteriaName'=>'GCC Tenders',
                //     'criteriaCount'=>8,
                //     'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                // ],
                [
                    'criteriaType'=>'6',
                    'criteriaName'=>'Buyers Opportunities',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '6', '9', '11'],
                ],
            ];
        }
    }

    public function opportinitesReceivedCount($regPK){
        $opportunitiesReceivedQuery = CmstenderhdrTbl::find()
                                        ->select([
                                            'COUNT(cmstenderhdr_pk) as orCount',
                                        ])
                                        ->innerJoin('cmstendertargethdr_tbl','cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                                        ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsth_memcompmst_fk')
                                        ->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                        ->where([
                                            'cmstth_memberregmst_fk' => $regPK,
                                        ]);
        return $opportunitiesReceivedQuery;
    }

    public function rfxRespondedCount($cmpPK){

    }

    public function awardedContractsCount($cmpPK){
        $awardedContractsQuery = CmsawarddtlsTbl::find()
                                        ->select([
                                            'COUNT(cmsawarddtls_pk) as acCount'
                                        ])
                                        ->innerJoin('cmscontracthdr_tbl','cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                                        ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                                        ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                        ->where([
                                            'cmsad_isdeactivated' => 0,
                                            'cmsad_memcompmst_fk' => $cmpPK,
                                        ]);
        return $awardedContractsQuery;
    }

    public function gccTendersCount($cmpPK){

    }

    public function buyersOpportunitiesCount($regPK){
        $opportunitiesReceivedQuery = CmstenderhdrTbl::find()
                                        ->select([
                                            'COUNT(cmstenderhdr_pk) as acCount'
                                        ])
                                        ->innerJoin('cmstendertargethdr_tbl','cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                                        ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsth_memcompmst_fk')
                                        ->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk and mrm_stkholdertypmst_fk = 7 and mrm_industrytype <> 1')
                                        ->leftJoin('incorpstylemst_tbl','mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
                                        ->leftJoin('memcompsectordtls_tbl','MCSD_MemberCompMst_Fk = MemberCompMst_Pk')
                                        ->where([
                                            'cmstth_memberregmst_fk' => $regPK,
                                        ]);
        return $opportunitiesReceivedQuery;
    }

    public function domainSupplierSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh='', $smartSrh=''){
        switch ($criteriaType) {
            case '2': // Opportunities Received
                $finalQuery = self::opportunitiesReceivedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '3': // RFx Responded
                $finalQuery = self::rfxRespondedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '4': // Awarded Contracts
                $finalQuery = self::awardedContractsSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '5': // GCC Tenders
                $finalQuery = self::gccTenderSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '6': // Buyer's Opportunities
                $finalQuery = self::buyerOpportunitiesSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
        }
        
        return $finalQuery;
    }

    public static function opportunitiesReceivedSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
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
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);

        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['noticeType'] = $smartSrh->noticeType;
            $smartFilter['noticeStatus'] = $smartSrh->noticeStatus;
        }

        $opportunitiesReceivedQuery = CmstenderhdrTbl::find()
                                        ->select([
                                            'cmsth_refno as oppRefNo',
                                            'cmsth_title as oppTitle',
                                            '(case cmsth_obligation when 1 then "MSME" when 2 then "LCC" when 3 then "MSME & LCC" when 4 then "Others" when 5 then "Not Applicable" end) as  obligation',
                                            'cmsth_issubcontrqmt as  isContract',
                                            '(case cmsth_type when 1 then "RFI" when 2 then "EOI" when 3 then "RFP" when 4 then "RFQ" when 5 then "PQ" when 6 then "RFT" end) as  noticeType',
                                            'date_format(COALESCE(cmsth_skdclosedate),\'%d-%m-%Y %H:%I %p\') as closingDateTime',
                                            'date_format(COALESCE(cmsth_createdon),\'%d-%m-%Y\') as postedDate',
                                            '(case cmsth_tenderstatus when 1 then "Yet to Submit" when 2 then "Submitted" when 3 then "Shortlisted" when 4 then "Rejected" when 5 then "Awarded" when 6 then "Terminated" when 7 then "Closed" when 8 then "Yet to Award" when 9 then "Yet to Shortlist" when 10 then "Shortlisting in Progress" end) as  tenderStatus',
                                            'MCM_CompanyName as companyName',
                                            '(case mrm_stkholdertypmst_fk when 1 then "Portal Admin" when 6 then "Supplier" when 7 then "Buyer" when 11 then "Project Owner" end) as  memberType'
                                        ])
                                        ->innerJoin('cmstendertargethdr_tbl','cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                                        ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsth_memcompmst_fk')
                                        ->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                        ->where([
                                            'cmstth_memberregmst_fk' => $regPK,
                                        ]);

        if(isset($smartFilter['noticeType']) && !empty($smartFilter['noticeType'])){
            $opportunitiesReceivedQuery->andWhere(['in', 'cmsth_type', $smartFilter['noticeType']]);
        }

        if(isset($smartFilter['noticeStatus']) && !empty($smartFilter['noticeStatus'])){
            $opportunitiesReceivedQuery->andWhere(['in', 'cmsth_type', $smartFilter['noticeStatus']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,2);
        }

        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $opportunitiesReceivedQuery->andWhere($finalFormation);
        }

        if(!empty($searchKey)){
           $opportunitiesReceivedQuery->andWhere(['OR',
                                ['OR LIKE','cmsth_refno',$searchKey],
                                ['OR LIKE','cmsth_title',$searchKey],
                                ['OR LIKE','MCM_CompanyName',$searchKey]
                            ]);
        }
        
        if($searchSort == 'Desc'){
            $opportunitiesReceivedQuery->orderBy(['cmsth_title'=>SORT_DESC]); 
        }else{
            $opportunitiesReceivedQuery->orderBy(['cmsth_title'=>SORT_ASC]);
        }

        $opportunitiesReceivedQueryResult = $opportunitiesReceivedQuery->asArray();
        //echo'<pre>';print_r($opportunitiesReceivedQueryResult->createCommand()->getRawSql());exit;
        return $opportunitiesReceivedQueryResult;
    }

    public static function awardedContractsSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
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
            $smartFilter['contractUs'] = $smartSrh->contractUs;
            $smartFilter['obligation'] = $smartSrh->obligation;
        }

        $awardedContractsQuery = CmsawarddtlsTbl::find()
                                        ->select([
                                            'count(cmsawarddtls_pk) as contractsAwarded',
                                            'sum(cmsad_awardamt) as totalContractValue',
                                            'AVG(cmsad_avgappraisal) as performanceApprisal',
                                            'cmsch_contractstatus as awardeeStatus',
                                            'MCM_CompanyName as companyName',
                                            '(case mrm_stkholdertypmst_fk when 1 then "Portal Admin" when 6 then "Supplier" when 7 then "Buyer" when 11 then "Project Owner" end) as  memberType',
                                            'COALESCE(mrm_supplierid, mrm_buyerid) as supBuyId',
                                            'cmsch.cmsch_contracttitle as title',
                                            'cmsch.cmsch_contractrefno as refNo',
                                            '(case cmsch.cmsch_obligation when 1 then "MSME" when 2 then "LCC" when 3 then "MSME & LCC" when 4 then "Others" when 5 then "Not Applicable" end) as  obligation',
                                            'cmsch.cmsch_issubcontrqmt as  isContract',
                                            'date_format(COALESCE(cmsad.cmsad_awardedon),\'%d-%m-%Y\') as awardedOn',
                                            'cmsch.cmsch_contractperiod as duration'
                                        ])
                                        ->from('cmsawarddtls_tbl cmsad')
                                        ->innerJoin('cmscontracthdr_tbl cmsch','cmsad.cmsad_cmscontracthdr_fk = cmsch.cmscontracthdr_pk')
                                        ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                                        ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                        ->where([
                                            'cmsad_isdeactivated' => 0,
                                            'cmsad_memcompmst_fk' => $cmpPK,
                                        ]); 

        if(isset($smartFilter['awardedTo']) && !empty($smartFilter['awardedTo'])){
            $awardedContractsQuery->andWhere(['in', 'MemberCompMst_Pk', $smartFilter['awardedTo']]);
        }

        if(isset($smartFilter['contractUs']) && !empty($smartFilter['contractUs'])){
            $awardedContractsQuery->andWhere(['in', 'cmsch_contractstatus', $smartFilter['contractUs']]);
        }

        if(isset($smartFilter['obligation']) && !empty($smartFilter['obligation'])){
            $awardedContractsQuery->andWhere(['in', 'cmsch_obligation', $smartFilter['obligation']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,2);
        }

        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $awardedContractsQuery->andWhere($finalFormation);
        }

        if(!empty($searchKey)){
           $awardedContractsQuery->andWhere(['OR',
                                ['OR LIKE','cmsch_contracttitle',$searchKey],
                                ['OR LIKE','cmsch_contractrefno',$searchKey],
                                ['OR LIKE','MCM_CompanyName',$searchKey]
                            ]);
        }
        
        $awardedContractsQuery->groupBy('cmsawarddtls_pk');

        if($searchSort == 'Desc'){
            $awardedContractsQuery->orderBy(['MCM_CompanyName'=>SORT_DESC]); 
        }else{
            $awardedContractsQuery->orderBy(['MCM_CompanyName'=>SORT_ASC]);
        }

        $awardedContractsQueryResult = $awardedContractsQuery->asArray();
        //echo'<pre>';print_r($awardedContractsQueryResult->createCommand()->getRawSql());exit;
        return $awardedContractsQueryResult;
    }

    public static function buyerOpportunitiesSearch($searchKey, $searchSort, $filterSrh='', $smartSrh=''){
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
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);

        $smartFilter = [];
        if(!empty($smartSrh)){
            $smartFilter['division'] = $smartSrh->division;
        }

        $opportunitiesReceivedQuery = CmstenderhdrTbl::find()
                                        ->select([
                                            'cmsth_refno as oppRefNo',
                                            'cmsth_title as oppTitle',
                                            '(case cmsth_obligation when 1 then "MSME" when 2 then "LCC" when 3 then "MSME & LCC" when 4 then "Others" when 5 then "Not Applicable" end) as  obligation',
                                            'cmsth_issubcontrqmt as  isContract',
                                            '(case cmsth_type when 1 then "RFI" when 2 then "EOI" when 3 then "RFP" when 4 then "RFQ" when 5 then "PQ" when 6 then "RFT" end) as  noticeType',
                                            'date_format(COALESCE(cmsth_skdclosedate),\'%d-%m-%Y %H:%I %p\') as closingDateTime',
                                            'date_format(COALESCE(cmsth_createdon),\'%d-%m-%Y\') as postedDate',
                                            '(case cmsth_tenderstatus when 1 then "Yet to Submit" when 2 then "Submitted" when 3 then "Shortlisted" when 4 then "Rejected" when 5 then "Awarded" when 6 then "Terminated" when 7 then "Closed" when 8 then "Yet to Award" when 9 then "Yet to Shortlist" when 10 then "Shortlisting in Progress" end) as  tenderStatus',
                                            'MCM_CompanyName as companyName',
                                            '(case mrm_stkholdertypmst_fk when 1 then "Portal Admin" when 6 then "Supplier" when 7 then "Buyer" when 11 then "Project Owner" end) as  memberType',
                                            'MCM_crnumber as crNo',
                                            'date_format(COALESCE(MCM_RegistrationYear),\'%d-%m-%Y\') as establishedOn',
                                            'ISM_IncorpStyleBrief as incropStyle',
                                            'group_concat(DISTINCT mcsd_businessunitrefname) as division'
                                        ])
                                        ->innerJoin('cmstendertargethdr_tbl','cmstenderhdr_pk = cmstth_cmstenderhdr_fk')
                                        ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsth_memcompmst_fk')
                                        ->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk and mrm_stkholdertypmst_fk = 7 and mrm_industrytype <> 1')
                                        ->leftJoin('incorpstylemst_tbl','mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
                                        ->leftJoin('memcompsectordtls_tbl','MCSD_MemberCompMst_Fk = MemberCompMst_Pk')
                                        ->where([
                                            'cmstth_memberregmst_fk' => $regPK,
                                        ]);

        if(isset($smartFilter['division']) && !empty($smartFilter['division'])){
            $opportunitiesReceivedQuery->andWhere(['in', 'mcsd_businessunitrefname', $smartFilter['division']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,6,2);
        }

        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $opportunitiesReceivedQuery->andWhere($finalFormation);
        }

        if(!empty($searchKey)){
           $opportunitiesReceivedQuery->andWhere(['OR',
                                ['OR LIKE','cmsth_refno',$searchKey],
                                ['OR LIKE','cmsth_title',$searchKey],
                                ['OR LIKE','MCM_CompanyName',$searchKey],
                                ['OR LIKE','MCM_crnumber',$searchKey],
                                ['OR LIKE','ISM_IncorpStyleBrief',$searchKey]
                            ]);
        }
        
        if($searchSort == 'Desc'){
            $opportunitiesReceivedQuery->orderBy(['cmsth_title'=>SORT_DESC]); 
        }else{
            $opportunitiesReceivedQuery->orderBy(['cmsth_title'=>SORT_ASC]);
        }

        $opportunitiesReceivedQueryResult = $opportunitiesReceivedQuery->asArray();
        //echo'<pre>';print_r($opportunitiesReceivedQueryResult->createCommand()->getRawSql());exit;
        return $opportunitiesReceivedQueryResult;
    }
}
