<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;

class Marketpresencefilter{

    public static function filterQueryFieldTypeFormation($fsKey, $typeKey){
        switch ($fsKey) {
            case 'marketPresenceFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_locationtype',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_countrymst_fk',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_statemst_fk',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '4':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_citymst_fk',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '5':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_branchid',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'productsFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_locationtype',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'PrdM_ProductName',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'serviceFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcmpld_locationtype',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'SrvM_ServiceName',
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
            case '1': // Market Presence
                $filterResult = self::organizeBusinessSourceFilter($searchType);
                break;
            case '2': // Products
                $filterResult = self::organizeBusinessUnitFilter($searchType);
                break;
            case '3': // Service
                $filterResult = self::organizeServiceFilter($searchType);
                break;
        }
        return $filterResult;
    }

    public function organizeBusinessSourceFilter($searchType){
        switch ($searchType) {
            case '1': // Type
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
            case '3': // State
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '4': // City
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '5': // Branch Id
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

    public function organizeBusinessUnitFilter($searchType){
        switch ($searchType) {
            case '1': // Business Unit
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '2': // Product Selection
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

    public function organizeServiceFilter($searchType){
        switch ($searchType) {
            case '1': // Business Unit
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '2': // Service Selection
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
            case '1': // Business Unit Filter
                $filterResult = self::organizeBusinessSourceFilterData($searchType);
                break;
            case '2': // Product Filter
                $filterResult = self::organizeProductFilterData($searchType);
                break;
            case '3': // Service Filter
                $filterResult = self::organizeServiceFilterData($searchType);
                break;
        }
        return $filterResult;
    }

    public function organizeBusinessSourceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Type
                $filterDataArr = Bizsearch::getMarketTypePresence($cmpPK);
                break;
            case '2': // Country
                $filterDataArr = Bizsearch::getMarketPresnceCountryDetails($cmpPK);
                break;
            case '3': // State
                $filterDataArr = Bizsearch::getMarketPresenceState($cmpPK);
                break;
            case '4': // City
                $filterDataArr = Bizsearch::getMarketPresenceCity($cmpPK);
                break;
            case '5': // Branch Id
                $filterDataArr = Bizsearch::getMarketPresenceBranchId($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function organizeProductFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Product Market Presence
                $filterDataArr = Bizsearch::getProductMarketType($cmpPK);
                break;
            case '2': // Product Selection
                $filterDataArr = Bizsearch::getMarketPresenceProduct($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function organizeServiceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Service Market Presence
                $filterDataArr = Bizsearch::getServiceMarketType($cmpPK);
                break;
            case '2': // Service Selection
                $filterDataArr = Bizsearch::getMarketPresenceService($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    
    public function saveSearchDtls() {
        $formDataArr = [
            'marketPresenceFilter' => [
                'labelName' => 'Market Presence',
                'filterType' => 1,
                'filterData' => [ 
                    '1' => 'Type', 
                    '2' => 'Country', 
                    '3' => 'State',
                    '4' => 'City',
                    '5' => 'Branch ID',
                ]
            ]
        ];
        return $formDataArr;
    }
}
