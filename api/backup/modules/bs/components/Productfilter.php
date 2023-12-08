<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;

class Productfilter{

    public static function filterQueryFieldTypeFormation($fsKey, $typeKey){

        switch ($fsKey) {

            case 'productFilter':
                switch ($typeKey) {
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcprd.MCPrD_NationalProdStatus',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'concat_ws(" ", um_firstname, um_middlename, um_lastname)',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'businessUnitFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'sm.SecM_SectorName',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'businessSourceFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'bsm.bsm_bussrcname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'userFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'dm.DM_Name',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'dlm.dlm_desglevelname',
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
                            'fieldName'=>'mcpld.mcmpld_locationtype',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'cntry.CyM_CountryName_en',
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
            case '1': // User Filter // Completed
                $filterResult = self::organizeUserFilter($searchType);
                break;
            case '2': // Business Unit Filter // Completed
                $filterResult = self::organizeBusinessUnitFilter($searchType);
                break;
            case '3': // Market Presence Filter // Completed
                $filterResult = self::organizeMarketPresenceFilter($searchType);
                break;
            case '4': // Product Filter
                $filterResult = self::productsFilter($searchType);
                break;
            case '7': // Business Source Filter // Completed
                $filterResult = self::bsourceFilter($searchType);
                break;
        }
        return $filterResult;
    }

    public function organizeUserFilter($searchType){
        switch ($searchType) {
            case '1': // Department
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '2': // Designation Level
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '3': // Status
                $combinationArr = [
                    ['type'=>'7','name'=>'Is','displayType'=>'1'],
                    ['type'=>'8','name'=>'Is not','displayType'=>'1']
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
        }
        return $combinationArr;
    }

    public function organizeMarketPresenceFilter($searchType){
        switch ($searchType) {
            case '1': // Type of Presence
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

    public function bsourceFilter($searchType){
        switch ($searchType) {
            case '1': // Business Source
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

    public function productsFilter($searchType){
        switch ($searchType) {
            case '2': // Products
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '3': // Contact Person
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
            case '1': // User Filter
                $filterResult = self::organizeUserFilterData($searchType);
                break;
            case '2': // Business Unit Filter
                $filterResult = self::organizeBusinessUnitFilterData($searchType);
                break;
            case '3': // Market Presence Filter
                $filterResult = self::organizeMarketPresenceFilterData($searchType);
                break;
            case '4': // Product Filter
                $filterResult = self::productsFilterData($searchType);
                break;
            case '7': // Business Source Filter
                $filterResult = self::bsourceFilterData($searchType);
                break;
        }
        return $filterResult;
    }

    public function organizeUserFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Department Details
                $filterDataArr = Bizsearch::getProductDepartment($cmpPK);
                break;
            case '2':
                $filterDataArr = Bizsearch::getProductDesignationLevel($cmpPK);
                break;
            case '3': // User Status
                $filterDataArr = [
                    ['filterPk'=>'A','filterName'=>'Active'],
                    ['filterPk'=>'I','filterName'=>'Inactive']
                ];
                break;
        }
        return $filterDataArr;
    }

    public function organizeBusinessUnitFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Business Unit
                $filterDataArr = Bizsearch::getProductBusinessUnit($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function organizeMarketPresenceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Types of Presence
                $filterDataArr = Bizsearch::getMarketTypePresence($cmpPK);
                break;
            case '2': // Country
                $filterDataArr = Bizsearch::getMarketPresnceCountryDetails($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function bsourceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Business Source
                $filterDataArr = Bizsearch::getProductBusinessSource($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function productsFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '2': // National Product
                $filterDataArr = [
                    ['filterPk'=>'Y','filterName'=>'Yes'],
                    ['filterPk'=>'N','filterName'=>'No']
                ];
                break;
            case '3': // Contact Person
                $filterDataArr = Bizsearch::getProductUsers($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    
    public function saveSearchDtls() {
        $formDataArr = [
            'productFilter' => [
                'labelName' => 'Products',
                'filterType' => 4,
                'filterData' => [ 
                    '2' => 'National Product', 
                    '3' => 'Contact Person'
                ]
            ],
            'businessUnitFilter' => [
                'labelName' => 'Business Unit',
                'filterType' => 2,
                'filterData' => [ 
                    '1' => 'Business Unit'
                ]
            ],
            'businessSourceFilter' => [
                'labelName' => 'Business Source',
                'filterType' => 7,
                'filterData' => [ 
                    '1' => 'Business Source'
                ]
            ],
            'userFilter' => [
                'labelName' => 'Users',
                'filterType' => 1,
                'filterData' => [ 
                    '1' => 'Department', 
                    '2' => 'Designation Level'
                ]
            ]
        ];
        return $formDataArr;
    }
}
