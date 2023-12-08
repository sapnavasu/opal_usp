<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;
use \api\modules\bs\components\Domainsearchdata;

class Companyprofilefilter{

    public static function filterQueryFieldTypeFormation($fsKey, $typeKey){
        switch ($fsKey) {
            case 'companyProfileFilter':
                switch ($typeKey) {
                    case '1': // Status
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcm_stakeholderstatus',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2': // Country
                        $result = [
                            'type'=>1,
                            'fieldName'=>'cmt.CyM_CountryName_en',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3': // Style of Incorporation
                        $result = [
                            'type'=>1,
                            'fieldName'=>'ism.ISM_IncorpStyleEntity',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '4': // Sector
                        $result = [
                            'type'=>1,
                            'fieldName'=>'sm.SecM_SectorName',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '5': // Classification
                        $result = [
                            'type'=>1,
                            'fieldName'=>'cm.ClM_ClassificationType',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'marketPresenceFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld.mcmpld_locationtype',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'cmt.CyM_CountryName_en',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
        }
        return $result;
    }

    public function fieldCombination(){
        return [
            '1'=>'=', // Equals to
            '2'=>'<>', // Not equals to
            '3'=>'LIKE', // Starts With
            '4'=>'LIKE', // Ends With
            '5'=>'LIKE', // Contains
            '6'=>'Not LIKE', // Not Contains
            '7'=>'=', // Is
            '8'=>'<>', // Is not
        ];
    }

    public function fieldDataType(){
        return [
            '1'=>'AND',
            '2'=>'OR'
        ];
    }

    public static function organizeFilter($filterType, $searchType){
        switch ($filterType) {
            case '1': // Company Profile
                $filterResult = self::organizeCompanyProfileFilter($searchType);
                break;
            case '2': // Market Presence
                $filterResult = self::organizeMarketPresenceFilter($searchType);
                break;
        }
        return $filterResult;
    }

    public function organizeCompanyProfileFilter($searchType){
        switch ($searchType) {
            case '1': // Status
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '2': // Country
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '3': // Style of incorporation
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '4': // Sector
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '5': // Classification
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '6': // Review & Rating
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
        }
        return $combinationArr;
    }
    public function organizeMarketPresenceFilter($searchType){
        switch ($searchType) {
            case '1': // Type of presence
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '2': // Country
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
        }
        return $combinationArr;
    }

    /*
        1 - Equals to
        2 - Not equals to
        3 - Starts With
        4 - Ends With
        5 - Contains
        6 - Not Contains
        7 - Is
        8 - Is not
        9 - Between
    */

    /* Display Type
        1 - Dropdown
        2 - Textbox
        3 - DateRange
    */

    

    public static function organizeFilterData($filterType, $searchType){
        switch ($filterType) {
            case '1': // Company Profile
                $filterResult = self::organizeCompanyProfileFilterData($searchType);
                break;
            case '2': // Market Presence
                $filterResult = self::organizeMarketPresenceFilterData($searchType);
                break;
        }
        return $filterResult;
    }

    public function organizeCompanyProfileFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Status
                $filterDataArr = [
                    ['filterPk'=>'1','filterName'=>'Guest'],
                    ['filterPk'=>'2','filterName'=>'Explorer'],
                    ['filterPk'=>'3','filterName'=>'Family'],
                    ['filterPk'=>'4','filterName'=>'Champion'],
                ];
                break;
            case '2': // Country
                $filterDataArr = Domainsearchdata::getDomainCountry($stkType);
                break;
            case '3': // Style of Incorporation
                $filterDataArr = Domainsearchdata::getDomainStyleIncorporation($stkType);
                break;
            case '4': // Sector
                $filterDataArr = Domainsearchdata::getDomainSector($stkType);
                break;
            case '5': // Classification
                $filterDataArr = Domainsearchdata::getDomainClassification($stkType);
                break;
            case '6': // Review & Rating
                $filterDataArr = Domainsearchdata::getDomainReviewRating($stkType);
                break;
        }
        return $filterDataArr;
    }

    public function organizeMarketPresenceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Type of Presence
                $filterDataArr = Domainsearchdata::getDomainMarketPresence($stkType);
                break;
            case '2': // Country
                $filterDataArr = Domainsearchdata::getDomainMarketPresenceCountry($stkType);
                break;
        }
        return $filterDataArr;
    }
    
    public function saveSearchDtls() {
        $formDataArr = [
            'companyProfileFilter' => [
                'labelName' => 'Company Profile',
                'filterType' => 1,
                'filterData' => [ 
                    '1' => 'Status', 
                    '2' => 'Country', 
                    '3' => 'Style of Incorporation',
                    '4' => 'Sector',
                    '5' => 'Classification',
                ]
            ],
            'marketPresenceFilter' => [
                'labelName' => 'Market Presence',
                'filterType' => 2,
                'filterData' => [ 
                    '1' => 'Type of Presence', 
                    '2' => 'Country'
                ]
            ]
        ];
        return $formDataArr;
    }
}
