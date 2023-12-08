<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;
use common\models\MemcompsectordtlsTbl;
use api\modules\pms\models\CmsawarddtlsTbl;
use api\modules\pms\models\CmscontracthdrTbl;
use Yii;

class Smartfilter{
    public static function fetchSmarFilterInitiliazeData($searchType, $criteriaType){
        //print_r($searchType);die();
         switch ($searchType) {
            case '1': // Internal Search
                $smartFilterResult = self::orgInternalSmartFilter($criteriaType);
                break;
            case '3': // B2B Search
                $smartFilterResult = self::orgB2bSmartFilter($criteriaType);
                break;
            case '5': // Domain Supplier
                $smartFilterResult = self::orgDomainSupplierSmartFilter($criteriaType);
                break;
            case '6': // Domain Contractor
                $smartFilterResult = self::orgDomainContractorSmartFilter($criteriaType);
                break;
            case '7': // Domain Buyer
                $smartFilterResult = self::orgDomainBuyerSmartFilter($criteriaType);
                break;
        }
        return $smartFilterResult;
    }

    public static function orgInternalSmartFilter($criteriaType){
        //print_r($criteriaType);die();
        switch ($criteriaType) {
            case '2': // User
                $internalFilterResult = self::orgInternalSmartUserFilter();
                break;
            case '3': // Division
                $internalFilterResult = self::orgInternalSmartDivisionFilter();
                break;
            case '4': // MonitorLog
                $internalFilterResult = self::orgInternalSmartUserFilter();
                break;
            case '5': // Product
                $internalFilterResult = self::orgInternalSmartProductFilter();
                break;
            case '6': // Service
                $internalFilterResult = self::orgInternalSmartServiceFilter();
                break;
        }
        return $internalFilterResult;
    }

    public static function orgB2bSmartFilter($criteriaType){
        switch ($criteriaType) {
            case '2': // Supplier
                $b2bFilterResult = self::orgB2bSmartSupplierFilter();
                break;
            case '3': // Product
                $b2bFilterResult = self::orgInternalSmartB2BProductFilter();
                break;
            case '4': // Service
                $b2bFilterResult = self::orgInternalSmartB2bServiceFilter();
                break;
            case '5': // People
                $b2bFilterResult = self::b2bPeopleFilter();
                break;
        }
        return $b2bFilterResult;
    }

    public static function orgB2bSmartSupplierFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        $companyCountry =  \yii\db\ActiveRecord::getTokenData('MCM_Source_CountryMst_Fk',true);
        
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'Active'],
                                ['filterPk'=>'E','filterName'=>'Expired']
                            ];
        $data['classificationData'] = [
                                ['filterPk'=>'MSME - Micro','filterName'=>'MSME - Micro'],
                                ['filterPk'=>'MSME - Small','filterName'=>'MSME - Small'],
                                ['filterPk'=>'MSME - Medium','filterName'=>'MSME - Medium'],
                                ['filterPk'=>'Large','filterName'=>'Large'],
                                ['filterPk'=>'International','filterName'=>'International']
                            ];
        $data['splStatusData'] = [
                                ['filterPk'=>'1','filterName'=>'CCED'],
                                ['filterPk'=>'2','filterName'=>'DUQM'],
                                ['filterPk'=>'3','filterName'=>'OXY'],
                                ['filterPk'=>'4','filterName'=>'PDO']  
                            ];
        if($stkType == 8)
        {
            $premiumpack = Yii::$app->db->createCommand("SELECT gcpd_currpackagetype from gcpremiumdtls_tbl where gcpd_memberregmst_fk =".$regPK)->queryOne();

            if($premiumpack)
            {
                if($premiumpack['gcpd_currpackagetype'] == 2)
                    $country = ['31',$companyCountry];
                elseif($premiumpack['gcpd_currpackagetype'] == 3)
                    $country = ['31',$companyCountry,'91','108','121','124','134'];
            }
        
          $data['countryData'] = Bizsearch::getCountryGCE($stkType,$country);   
        }
        else
        {
            $data['countryData'] = Bizsearch::getCountry($stkType);
        }

        return $data;
    }

    public static function orgInternalSmartUserFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['divisionData'] = Bizsearch::getDivision($cmpPK);
        $data['designationLevel'] = Bizsearch::getDesignationLevel($cmpPK);
        $data['departmentData'] = Bizsearch::getDepartment($cmpPK);
        return $data;
    }
    public static function b2bPeopleFilter(){
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        
        $data['countryData'] = Bizsearch::getCountry($stkType);
        $data['designationLevel'] = B2bsearch::getDesignationLevel();
        return $data;
    }

    public static function orgInternalSmartDivisionFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['divisionRefData'] = Bizsearch::getDivision($cmpPK);
        $data['sectorData'] = Bizsearch::getDivisionSector($cmpPK);
        return $data;   
    }

    public static function orgInternalSmartProductFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['divisionData'] = Bizsearch::getProductBusinessUnit($cmpPK);
        $data['bSourceData'] = Bizsearch::getProductBusinessSource($cmpPK);
        
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'JSRS Certified Product'],
                                ['filterPk'=>'N','filterName'=>'Applied for JSRS Certification'],
                                ['filterPk'=>'D','filterName'=>'Declined for JSRS Certification'],
                                ['filterPk'=>'Y','filterName'=>'Yet to apply for JSRS Certification']
                            ];

        $data['sezdStatus'] = [
                                ['filterPk'=>'A','filterName'=>'SEZD Certified Product'],
                                ['filterPk'=>'N','filterName'=>'Applied for SEZD Certification'],
                                ['filterPk'=>'D','filterName'=>'Declined for SEZD Certification'],
                                ['filterPk'=>'Y','filterName'=>'Yet to apply for SEZD Certification']
                            ];

        $data['olngPrequalified'] = [
                                ['filterPk'=>'Y','filterName'=>'Yes'],
                                ['filterPk'=>'N','filterName'=>'No']
                            ];

        $data['productRating'] = [
                                ['filterPk'=>'1','filterName'=>'1 & above'],
                                ['filterPk'=>'2','filterName'=>'2 & above'],
                                ['filterPk'=>'3','filterName'=>'3 & above'],
                                ['filterPk'=>'4','filterName'=>'4 & above']
                            ];
        $data['nationalProduct'] = [
                                ['filterPk'=>'Y','filterName'=>'Yes'],
                                ['filterPk'=>'N','filterName'=>'No']
                            ];
        return $data;
    }
    public static function orgInternalSmartB2BProductFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['divisionData'] = Bizsearch::getProductBusinessUnit($cmpPK,'b2b');
        $data['bSourceData'] = Bizsearch::getProductBusinessSource($cmpPK,'b2b');
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'JSRS Certified Product'],
                                ['filterPk'=>'N','filterName'=>'Applied for JSRS Certification'],
                                ['filterPk'=>'D','filterName'=>'Declined for JSRS Certification'],
                                ['filterPk'=>'Y','filterName'=>'Yet to apply for JSRS Certification']
                            ];

        $data['sezdStatus'] = [
                                ['filterPk'=>'A','filterName'=>'SEZD Certified Product'],
                                ['filterPk'=>'N','filterName'=>'Applied for SEZD Certification'],
                                ['filterPk'=>'D','filterName'=>'Declined for SEZD Certification'],
                                ['filterPk'=>'Y','filterName'=>'Yet to apply for SEZD Certification']
                            ];

        $data['olngPrequalified'] = [
                                ['filterPk'=>'Y','filterName'=>'Yes'],
                                ['filterPk'=>'N','filterName'=>'No']
                            ];

        $data['productRating'] = [
                                ['filterPk'=>'1','filterName'=>'1 & above'],
                                ['filterPk'=>'2','filterName'=>'2 & above'],
                                ['filterPk'=>'3','filterName'=>'3 & above'],
                                ['filterPk'=>'4','filterName'=>'4 & above']
                            ];
        $data['nationalProduct'] = [
                                ['filterPk'=>'Y','filterName'=>'Yes'],
                                ['filterPk'=>'N','filterName'=>'No']
                            ];
        return $data;
    }

    public static function orgInternalSmartServiceFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['divisionData'] = Bizsearch::getServiceBusinessUnit($cmpPK);
        $data['bSourceData'] = Bizsearch::getServiceBusinessSource($cmpPK);
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'Approved'],
                                ['filterPk'=>'Y','filterName'=>'Not Approved']
                            ];
        $data['serviceRating'] = [
                                ['filterPk'=>'1','filterName'=>'1 & above'],
                                ['filterPk'=>'2','filterName'=>'2 & above'],
                                ['filterPk'=>'3','filterName'=>'3 & above'],
                                ['filterPk'=>'4','filterName'=>'4 & above']
                            ];
        return $data;   
    }
    public static function orgInternalSmartB2bServiceFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['divisionData'] = Bizsearch::getServiceBusinessUnit($cmpPK,'b2b');
        $data['bSourceData'] = Bizsearch::getServiceBusinessSource($cmpPK,'b2b');
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'Approved'],
                                ['filterPk'=>'NA','filterName'=>'Not Approved']
                            ];
        $data['serviceRating'] = [
                                ['filterPk'=>'1','filterName'=>'1 & above'],
                                ['filterPk'=>'2','filterName'=>'2 & above'],
                                ['filterPk'=>'3','filterName'=>'3 & above'],
                                ['filterPk'=>'4','filterName'=>'4 & above']
                            ];
        return $data;
    }

    public static function orgDomainSupplierSmartFilter($criteriaType){
        switch ($criteriaType) {
            case '2': // Opportunities Received
                $domainSupplierFilterResult = self::orgDsSmartOpportunitiesReceivedFilter();
                break;
            case '3': // RFx Responded
                $domainSupplierFilterResult = self::orgDsSmartRfxRespondFilter();
                break;
            case '4': // Awarded Contracts
                $domainSupplierFilterResult = self::orgDsSmartAwardedContractsFilter();
                break;
            case '5': // GCC Tenders
                $domainSupplierFilterResult = self::orgDsSmartGccTendersFilter();
                break;
            case '6': // Buyer's Opportunities
                $domainSupplierFilterResult = self::orgDsSmartBuyerOpportunitiesFilter();
                break;
        }
        return $domainSupplierFilterResult;

    }

    public static function orgDsSmartOpportunitiesReceivedFilter(){
        $data['noticeType'] = [
                                ['filterPk'=>'1','filterName'=>'RFI'],
                                ['filterPk'=>'2','filterName'=>'EOI'],
                                ['filterPk'=>'3','filterName'=>'RFP'],
                                ['filterPk'=>'4','filterName'=>'RFQ'],
                                ['filterPk'=>'5','filterName'=>'PQ'],
                                ['filterPk'=>'6','filterName'=>'RFT']
                            ];

        usort($data['noticeType'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['noticeStatus'] = [
                                ['filterPk'=>'1','filterName'=>'Yet to Submit'],
                                ['filterPk'=>'2','filterName'=>'Submitted'],
                                ['filterPk'=>'3','filterName'=>'Shortlisted'],
                                ['filterPk'=>'4','filterName'=>'Rejected'],
                                ['filterPk'=>'5','filterName'=>'Awarded'],
                                ['filterPk'=>'6','filterName'=>'Terminated'],
                                ['filterPk'=>'7','filterName'=>'Closed'],
                                ['filterPk'=>'8','filterName'=>'Yet to Award'],
                                ['filterPk'=>'9','filterName'=>'Yet to Shortlist'],
                                ['filterPk'=>'10','filterName'=>'Shortlisting']
                            ];

        usort($data['noticeStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }

    public static function orgDsSmartRfxRespondFilter(){
        $data['noticeType'] = [
                                ['filterPk'=>'1','filterName'=>'RFI'],
                                ['filterPk'=>'2','filterName'=>'EOI'],
                                ['filterPk'=>'3','filterName'=>'RFP'],
                                ['filterPk'=>'4','filterName'=>'RFQ'],
                                ['filterPk'=>'5','filterName'=>'PQ'],
                                ['filterPk'=>'6','filterName'=>'RFT']
                            ];

        usort($data['noticeType'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['noticeStatus'] = [
                                ['filterPk'=>'1','filterName'=>'Yet to Submit'],
                                ['filterPk'=>'2','filterName'=>'Submitted'],
                                ['filterPk'=>'3','filterName'=>'Shortlisted'],
                                ['filterPk'=>'4','filterName'=>'Rejected'],
                                ['filterPk'=>'5','filterName'=>'Awarded'],
                                ['filterPk'=>'6','filterName'=>'Terminated'],
                                ['filterPk'=>'7','filterName'=>'Closed'],
                                ['filterPk'=>'8','filterName'=>'Yet to Award'],
                                ['filterPk'=>'9','filterName'=>'Yet to Shortlist'],
                                ['filterPk'=>'10','filterName'=>'Shortlisting']
                            ];

        usort($data['noticeStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }

    public static function orgDsSmartAwardedContractsFilter(){
        $data['awardedBy'] = CmsawarddtlsTbl::getContractAwardedBy();
        $data['contractStatus'] = [
                                    ['filterPk'=>'1','filterName'=>'Active'],
                                    ['filterPk'=>'2','filterName'=>'Inactive'],
                                    ['filterPk'=>'3','filterName'=>'Terminated'],
                                    ['filterPk'=>'4','filterName'=>'Suspended'],
                                    ['filterPk'=>'5','filterName'=>'Ongoing'],
                                    ['filterPk'=>'6','filterName'=>'Floated'],
                                    ['filterPk'=>'7','filterName'=>'Completed'],
                                    ['filterPk'=>'8','filterName'=>'Closed']
                                ];
        usort($data['contractStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['obligation'] = [
                                ['filterPk'=>'1','filterName'=>'MSME'],
                                ['filterPk'=>'2','filterName'=>'LCC'],
                                ['filterPk'=>'3','filterName'=>'MSME & LCC'],
                                ['filterPk'=>'4','filterName'=>'Others'],
                                ['filterPk'=>'5','filterName'=>'Not Applicable']
                            ];
        usort($data['obligation'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }

    public static function orgDsSmartGccTendersFilter(){
        return [];
    }

    public static function orgDsSmartBuyerOpportunitiesFilter(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $data['division'] = MemcompsectordtlsTbl::fetchBunitSmartFilterData($cmpPK);
        return $data;
    }


    public static function orgDomainContractorSmartFilter($criteriaType){
        switch ($criteriaType) {
            case '2': // Contracts Received
                $domainContractorFilterResult = self::orgDcSmartContractsReceivedFilter();
                break;
            case '3': // Awardees
                $domainContractorFilterResult = self::orgDcSmartAwardeesFilter();
                break;
            case '5': // Opportunities Created
                $domainContractorFilterResult = self::orgDcSmartOpportunitiesCreatedFilter();
                break;
            case '6': // Contracts Created
                $domainContractorFilterResult = self::orgDcSmartContractsCreatedFilter();
                break;
        }
        return $domainContractorFilterResult;

    }

    public static function orgDcSmartContractsReceivedFilter(){
        $data['awardedBy'] = CmscontracthdrTbl::getContractReceivedBy();
        $data['contractStatus'] = [
                                    ['filterPk'=>'1','filterName'=>'Active'],
                                    ['filterPk'=>'2','filterName'=>'Inactive'],
                                    ['filterPk'=>'3','filterName'=>'Terminated'],
                                    ['filterPk'=>'4','filterName'=>'Suspended'],
                                    ['filterPk'=>'5','filterName'=>'Ongoing'],
                                    ['filterPk'=>'6','filterName'=>'Floated'],
                                    ['filterPk'=>'7','filterName'=>'Completed'],
                                    ['filterPk'=>'8','filterName'=>'Closed']
                                ];
        usort($data['contractStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['obligation'] = [
                                ['filterPk'=>'1','filterName'=>'MSME'],
                                ['filterPk'=>'2','filterName'=>'LCC'],
                                ['filterPk'=>'3','filterName'=>'MSME & LCC'],
                                ['filterPk'=>'4','filterName'=>'Others'],
                                ['filterPk'=>'5','filterName'=>'Not Applicable']
                            ];
        usort($data['obligation'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }

    public static function orgDcSmartAwardeesFilter(){
        $data['awardedTo'] = CmsawarddtlsTbl::awardeesAwardedTo();
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'Active'],
                                ['filterPk'=>'E','filterName'=>'Expired']
                            ];
        return $data;
    }

    public static function orgDcSmartOpportunitiesCreatedFilter(){
        $data['noticeType'] = [
                                ['filterPk'=>'1','filterName'=>'RFI'],
                                ['filterPk'=>'2','filterName'=>'EOI'],
                                ['filterPk'=>'3','filterName'=>'RFP'],
                                ['filterPk'=>'4','filterName'=>'RFQ'],
                                ['filterPk'=>'5','filterName'=>'PQ'],
                                ['filterPk'=>'6','filterName'=>'RFT']
                            ];
        usort($data['noticeType'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['noticeStatus'] = [
                                ['filterPk'=>'1','filterName'=>'Yet to Submit'],
                                ['filterPk'=>'2','filterName'=>'Submitted'],
                                ['filterPk'=>'3','filterName'=>'Shortlisted'],
                                ['filterPk'=>'4','filterName'=>'Rejected'],
                                ['filterPk'=>'5','filterName'=>'Awarded'],
                                ['filterPk'=>'6','filterName'=>'Terminated'],
                                ['filterPk'=>'7','filterName'=>'Closed'],
                                ['filterPk'=>'8','filterName'=>'Yet to Award'],
                                ['filterPk'=>'9','filterName'=>'Yet to Shortlist'],
                                ['filterPk'=>'10','filterName'=>'Shortlisting']
                            ];
        usort($data['noticeStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }

    public static function orgDcSmartContractsCreatedFilter(){
        
        $data['contractStatus'] = [
                                    ['filterPk'=>'1','filterName'=>'Active'],
                                    ['filterPk'=>'2','filterName'=>'Inactive'],
                                    ['filterPk'=>'3','filterName'=>'Terminated'],
                                    ['filterPk'=>'4','filterName'=>'Suspended'],
                                    ['filterPk'=>'5','filterName'=>'Ongoing'],
                                    ['filterPk'=>'6','filterName'=>'Floated'],
                                    ['filterPk'=>'7','filterName'=>'Completed'],
                                    ['filterPk'=>'8','filterName'=>'Closed']
                                ];
        usort($data['contractStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['awardedTo'] = CmscontracthdrTbl::contractCreatedAwardedTo();

        $data['obligation'] = [
                                ['filterPk'=>'1','filterName'=>'MSME'],
                                ['filterPk'=>'2','filterName'=>'LCC'],
                                ['filterPk'=>'3','filterName'=>'MSME & LCC'],
                                ['filterPk'=>'4','filterName'=>'Others'],
                                ['filterPk'=>'5','filterName'=>'Not Applicable']
                            ];
        usort($data['obligation'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }


    public static function orgDomainBuyerSmartFilter($criteriaType){
        switch ($criteriaType) {
            case '3': // Opportunities Received
                $domainBuyerFilterResult = self::orgDbSmartOpportunitiesReceivedFilter();
                break;
            case '4': // Contracts Created
                $domainBuyerFilterResult = self::orgDbSmartContractsCreatedFilter();
                break;
            case '5': // Awardees
                $domainBuyerFilterResult = self::orgDbSmartAwardeesFilter();
                break;
        }
        return $domainBuyerFilterResult;

    }

    public static function orgDbSmartOpportunitiesReceivedFilter(){
        $data['noticeType'] = [
                                ['filterPk'=>'1','filterName'=>'RFI'],
                                ['filterPk'=>'2','filterName'=>'EOI'],
                                ['filterPk'=>'3','filterName'=>'RFP'],
                                ['filterPk'=>'4','filterName'=>'RFQ'],
                                ['filterPk'=>'5','filterName'=>'PQ'],
                                ['filterPk'=>'6','filterName'=>'RFT']
                            ];

        usort($data['noticeType'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['noticeStatus'] = [
                                ['filterPk'=>'1','filterName'=>'Yet to Submit'],
                                ['filterPk'=>'2','filterName'=>'Submitted'],
                                ['filterPk'=>'3','filterName'=>'Shortlisted'],
                                ['filterPk'=>'4','filterName'=>'Rejected'],
                                ['filterPk'=>'5','filterName'=>'Awarded'],
                                ['filterPk'=>'6','filterName'=>'Terminated'],
                                ['filterPk'=>'7','filterName'=>'Closed'],
                                ['filterPk'=>'8','filterName'=>'Yet to Award'],
                                ['filterPk'=>'9','filterName'=>'Yet to Shortlist'],
                                ['filterPk'=>'10','filterName'=>'Shortlisting']
                            ];

        usort($data['noticeStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        return $data;
    }

    public static function orgDbSmartContractsCreatedFilter(){
        $data['awardedTo'] = CmscontracthdrTbl::contractCreatedAwardedTo();
        $data['contractStatus'] = [
                                    ['filterPk'=>'1','filterName'=>'Active'],
                                    ['filterPk'=>'2','filterName'=>'Inactive'],
                                    ['filterPk'=>'3','filterName'=>'Terminated'],
                                    ['filterPk'=>'4','filterName'=>'Suspended'],
                                    ['filterPk'=>'5','filterName'=>'Ongoing'],
                                    ['filterPk'=>'6','filterName'=>'Floated'],
                                    ['filterPk'=>'7','filterName'=>'Completed'],
                                    ['filterPk'=>'8','filterName'=>'Closed']
                                ];
        usort($data['contractStatus'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });

        $data['obligation'] = [
                                ['filterPk'=>'1','filterName'=>'MSME'],
                                ['filterPk'=>'2','filterName'=>'LCC'],
                                ['filterPk'=>'3','filterName'=>'MSME & LCC'],
                                ['filterPk'=>'4','filterName'=>'Others'],
                                ['filterPk'=>'5','filterName'=>'Not Applicable']
                            ];
        usort($data['obligation'], function($x, $y) {
           return strcasecmp($x['filterName'] , $y['filterName']);
        });
        
        return $data;
    }

    public static function orgDbSmartAwardeesFilter(){
        $data['awardedTo'] = CmsawarddtlsTbl::awardeesAwardedTo();
        $data['jsrsStatus'] = [
                                ['filterPk'=>'A','filterName'=>'Active'],
                                ['filterPk'=>'E','filterName'=>'Expired']
                            ];
        return $data;
    }
}
