<?php

namespace api\modules\bs\components;
use Yii;
use common\components\Security;
use \common\models\MembercompanymstTbl;
use \api\modules\bs\components\Internalsearch;
use \api\modules\pms\models\CmscontracthdrTbl;
use \api\modules\pms\models\CmsawarddtlsTbl;
use \api\modules\pms\models\CmstenderhdrTbl;

class Domainbuyersearch {
    //{"savedata":{"searchType":2,"criteriaType":"2","keyword":[],"filterData":"","saveName":"ttt","queryAll":true}}


    public function domainBuyerCriteria($isDemo){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        if($isDemo){

            // Projects
            // $projectQuery = self::projectCount($cmpPK);

            // Opportunities Created
            $opportunitiesCreatedQuery = self::opportunitiesCreatedCount($cmpPK);

            // Contracts Created
            $contractsCreatedQuery = self::contractsCreatedCount($cmpPK);

            // Awardees
            $awardeesQuery = self::awardeesCount($cmpPK);

            // Contractors - ICV Performance
            // $contractsIcvQuery = self::contractsIcvCount($cmpPK);

            // Invoices
            // $invoicesQuery = self::invoicesCount($cmpPK);


            // Doamin Buyer final query
            $domainBuyerQuery = MembercompanymstTbl::find()
                                ->where(['MemberCompMst_Pk'=>$cmpPK])
                                ->addSelect([
                                    // 'projectCount'=>'('.$projectQuery->createCommand()->getRawSql().')',
                                    'opportunitiesCreatedCount'=>'('.$opportunitiesCreatedQuery->createCommand()->getRawSql().')',
                                    'contractsCreatedCount'=>'('.$contractsCreatedQuery->createCommand()->getRawSql().')',
                                    'awardeesCount'=>'('.$awardeesQuery->createCommand()->getRawSql().')',
                                    // 'contractsIcvCount'=>'('.$contractsIcvQuery->createCommand()->getRawSql().')',
                                    // 'invoicesCount'=>'('.$invoicesQuery->createCommand()->getRawSql().')',
                                ]);
            $domainBuyerResult = $domainBuyerQuery->asArray()->one();

            $overAllCount = $domainBuyerResult['opportunitiesCreatedCount'] + $domainBuyerResult['contractsCreatedCount'] + $domainBuyerResult['awardeesCount'];

            return [
                [
                    'criteriaType'=>'1',
                    'criteriaName'=>'All',
                    'criteriaCount'=>$overAllCount,
                    'stakeholderType'=>[],
                ],
                [
                    'criteriaType'=>'3',
                    'criteriaName'=>'Opportunities Created',
                    'criteriaCount'=>$domainBuyerResult['opportunitiesCreatedCount'],
                    'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'4',
                    'criteriaName'=>'Contracts Created',
                    'criteriaCount'=>$domainBuyerResult['contractsCreatedCount'],
                    'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'5',
                    'criteriaName'=>'Awardees',
                    'criteriaCount'=>$domainBuyerResult['awardeesCount'],
                    'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                ],
            ];

        }else{
            return [
                [
                    'criteriaType'=>'1',
                    'criteriaName'=>'All',
                    'criteriaCount'=>41,
                    'stakeholderType'=>[],
                ],
                // [
                //     'criteriaType'=>'2',
                //     'criteriaName'=>'Projects',
                //     'criteriaCount'=>8,
                //     'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                // ],
                [
                    'criteriaType'=>'3',
                    'criteriaName'=>'Opportunities Created',
                    'criteriaCount'=>9,
                    'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'4',
                    'criteriaName'=>'Contracts Created',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                ],
                [
                    'criteriaType'=>'5',
                    'criteriaName'=>'Awardees',
                    'criteriaCount'=>8,
                    'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                ],
                // [
                //     'criteriaType'=>'6',
                //     'criteriaName'=>'Contractors - ICV Performance',
                //     'criteriaCount'=>1,
                //     'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                // ],
                // [
                //     'criteriaType'=>'6',
                //     'criteriaName'=>'Invoices',
                //     'criteriaCount'=>8,
                //     'stakeholderType'=>['1', '2', '3', '7', '9', '11'],
                // ],
            ];
        }        
    }

    public function projectCount($cmpPK){

    }

    public function opportunitiesCreatedCount($cmpPK){
        $opportunitiesCreatedQuery = CmstenderhdrTbl::find()
                                ->select([
                                    'COUNT(cmstenderhdr_pk) as ocCount'
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
                                ->leftJoin('usermst_tbl','UserMst_Pk = cmsch_createdby')
                                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
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
                                ->from('cmsawarddtls_tbl cmsad')
                                ->innerJoin('cmscontracthdr_tbl cmsch','cmsad.cmsad_cmscontracthdr_fk = cmsch.cmscontracthdr_pk')
                                ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk = MemberRegMst_Pk')
                                ->where([
                                    'cmsad_isdeactivated' => 0,
                                    'cmsch_memcompmst_fk' => $cmpPK,
                                ]);
        return $awardeesQuery;
    }

    public function domainBuyerSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh='', $smartSrh=''){
        switch ($criteriaType) {
            case '3': // Opportunities Received
                $finalQuery = self::opportunitiesCreatedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '4': // Contracts Created
                $finalQuery = self::contractsCreatedSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
            case '5': // Awardees
                $finalQuery = self::awardeesSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                break;
        }
        
        return $finalQuery;
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
                                    'date_format(COALESCE(cmsth_skdclosedate),\'%d-%m-%Y\') as closingDate'
                                ])
                                ->where([
                                    'cmsth_memcompmst_fk' => $cmpPK,
                                ]);

        if(isset($smartFilter['noticeType']) && !empty($smartFilter['noticeType'])){
            $opportunitiesCreatedQuery->andWhere(['in', 'cmsth_type', $smartFilter['noticeType']]);
        }

        if(isset($smartFilter['contractStatus']) && !empty($smartFilter['contractStatus'])){
            $opportunitiesCreatedQuery->andWhere(['in', 'cmsth_tenderstatus', $smartFilter['contractStatus']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,7,3);
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
        //echo'<pre>';print_r($opportunitiesCreatedQueryResult->createCommand()->getRawSql());exit;
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
            $smartFilter['awardedTo'] = $smartSrh->awardedTo;
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
                                    'cmsch.cmsch_issubcontrqmt as isContract',
                                    'date_format(COALESCE(cmsad.cmsad_awardedon),\'%d-%m-%Y\') as awardedOn',
                                    'cmsch.cmsch_contractperiod as duration',
                                    'cmsch.cmsch_contractvalue as contractValue',
                                    'mcm.MCM_CompanyName as compnayName',
                                ])
                                ->from('cmscontracthdr_tbl cmsch')
                                ->leftJoin('cmsawarddtls_tbl cmsad','cmsch.cmscontracthdr_pk = cmsad.cmsad_cmscontracthdr_fk')
                                ->leftJoin('usermst_tbl um','um.UserMst_Pk = cmsch.cmsch_createdby')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = um.UM_MemberRegMst_Fk')
                                ->where([
                                    'cmsad_memcompmst_fk' => $cmpPK
                                ]);

        if(isset($smartFilter['awardedTo']) && !empty($smartFilter['awardedTo'])){
            $contractReceivedQuery->andWhere(['in', 'MemberCompMst_Pk', $smartFilter['awardedTo']]);
        }

        if(isset($smartFilter['contractStatus']) && !empty($smartFilter['contractStatus'])){
            $contractReceivedQuery->andWhere(['in', 'cmsth_tenderstatus', $smartFilter['contractStatus']]);
        }

        if(isset($smartFilter['obligation']) && !empty($smartFilter['obligation'])){
            $contractReceivedQuery->andWhere(['in', 'cmsch_obligation', $smartFilter['obligation']]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,7,4);
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
                                    'MCM_CompanyName as companyName',
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
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,7,5);
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

        if($searchSort == 'Desc'){
            $awardeesQuery->orderBy(['cmsch_contracttitle'=>SORT_DESC]); 
        }else{
            $awardeesQuery->orderBy(['cmsch_contracttitle'=>SORT_ASC]);
        }
        
        if (isset($smartFilter['jsrsStatus']) && !empty($smartFilter['jsrsStatus'])) {
            if (in_array('A', $smartFilter['jsrsStatus']) && in_array('E', $smartFilter['jsrsStatus'])) {
            } elseif (in_array('A', $smartFilter['jsrsStatus'])) {
                $awardeesQuery->having('comsts = 1');
            } elseif (in_array('E', $smartFilter['jsrsStatus'])) {
                $awardeesQuery->having('comsts = 0');
            }
        }

        $awardeesQueryResult = $awardeesQuery->asArray();
        //echo'<pre>';print_r($awardeesQueryResult->createCommand()->getRawSql());exit;
        return $awardeesQueryResult;
    }
}
