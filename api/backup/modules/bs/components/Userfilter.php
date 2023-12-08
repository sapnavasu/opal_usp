<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;

class Userfilter{

    public static function filterQueryFieldTypeFormation($fsKey, $typeKey){

        switch ($fsKey) {
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
                            'type'=>2,
                            'fieldName'=>'dlm.dlm_desglevelname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>3,
                            'fieldName'=>'um.UM_Status',
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
                            'fieldName'=>'mcsd.mcsd_businessunitrefname',
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
                            'fieldName'=>'mcp.mcmpld_officename',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'mcp_cym.CyM_CountryName_en',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'productFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'mcprdu.MCPrD_DisplayName',
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
                            'fieldName'=>'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'mcsdu.MCSvD_DisplayName',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'monitorLogFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'um.UM_Status',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'bmm.bmm_name',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>3,
                            'fieldName'=>'uml.uml_viewedon',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'ProjectsFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>3,
                            'fieldName'=>'prjd.prjd_projname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '4':
                        $result = [
                            'type'=>4,
                            'fieldName'=>'prjd.prjd_projstatus',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'svfFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',
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
            case '1': // User Filter
                $filterResult = self::organizeUserFilter($searchType);
                break;
            case '2': // Business Unit Filter
                $filterResult = self::organizeBusinessUnitFilter($searchType);
                break;
            case '6': // Market Presence Filter
                $filterResult = self::organizeMarketPresenceFilter($searchType);
                break;
            case '4': // Product Filter
                $filterResult = self::productFilter($searchType);
                break;
            case '5': // Service Filter
                $filterResult = self::serviceFilter($searchType);
                break;
            case '3': // Monitor Log Filter
                $filterResult = self::monitorLogFilter($searchType);
                break;
            case '7': // Project Filter
                $filterResult = self::projectFilter($searchType);
                break;
            case '8': // SVF Filter
                $filterResult = self::svfFilter($searchType);
                break;
        }
        return $filterResult;
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
            case '1': // Types of Presense
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '2': // Country
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                ];
                break;
        }
        return $combinationArr;
    }

    public function productFilter($searchType){
        switch ($searchType) {
            case '1': // Select Users
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2']
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
            case '3': // Product Status
                $combinationArr = [
                    ['type'=>'7','name'=>'Is','displayType'=>'1'],
                    ['type'=>'8','name'=>'Is not','displayType'=>'1']
                ];
                break;
        }
        return $combinationArr;
    }

    public function serviceFilter($searchType){
        switch ($searchType) {
            case '1': // Select Users
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2']
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
            case '3': // Service Status
                $combinationArr = [
                    ['type'=>'7','name'=>'Is','displayType'=>'1'],
                    ['type'=>'8','name'=>'Is not','displayType'=>'1']
                ];
                break;
        }
        return $combinationArr;
    }

    public function monitorLogFilter($searchType){
        switch ($searchType) {
            case '1': // User Status
                $combinationArr = [
                    ['type'=>'7','name'=>'Is','displayType'=>'1'],
                    ['type'=>'8','name'=>'Is not','displayType'=>'1']
                ];
                break;
            case '2': // Module Names
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '3': // User Log
                $combinationArr = [
                    ['type'=>'9','name'=>'Between','displayType'=>'3']
                ];
                break;

        }
        return $combinationArr;
    }

    public function projectFilter($searchType){
        switch ($searchType) {
            case '1': // Users mapped to project team members
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '2': // Users mapped to project contact members
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '3': // Project selection
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '4': // Project status
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;

        }
        return $combinationArr;
    }

    public function svfFilter($searchType){
        switch ($searchType) {
            case '1': // User mapped to validation process contact
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '2': // Users mapped to business development contact
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

    public static function organizeFilterData($filterType, $searchType){
        //print_r($filterType);die();
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
                $filterResult = self::productFilterData($searchType);
                break;
            case '5': // Service Filter
                $filterResult = self::serviceFilterData($searchType);
                break;
            case '6': // Monitor Log Filter
                $filterResult = self::monitorLogFilterData($searchType);
                break;
            case '7': // Project Filter
                $filterResult = self::projectFilterData($searchType);
                break;
            case '8': // SVF Filter
                $filterResult = self::svfFilterData($searchType);
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
                $filterDataArr = Bizsearch::getDepartment($cmpPK);
                break;
            case '2':
                $filterDataArr = Bizsearch::getDesignationLevel($cmpPK);
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
                $filterDataArr = Bizsearch::getBusinessUnit($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function organizeMarketPresenceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Type of Presence
                $filterDataArr = Bizsearch::getMarketPresnceDetails($cmpPK);
                break;
            case '2': // Country
                $filterDataArr = Bizsearch::getMarketPresnceCountryDetails($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function productFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Select Users
                $filterDataArr = Bizsearch::getProductUsers($cmpPK);
                break;
            case '2': // Product Selection
                $filterDataArr = Bizsearch::getProductDetails($cmpPK);
                break;
            case '3': // Product Status
                $filterDataArr = [
                    ['filterPk'=>'A','filterName'=>'Active']
                ];
                break;
        }
        return $filterDataArr;
    }

    public function serviceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Select Users
                $filterDataArr = Bizsearch::getServiceUser($cmpPK);
                break;
            case '2': // Service Selection
                $filterDataArr = Bizsearch::getServiceDetails($cmpPK);
                break;
            case '3': // Service Status
                $filterDataArr = [
                    ['filterPk'=>'A','filterName'=>'Active']
                ];
                break;
        }
        return $filterDataArr;
    }

    public function monitorLogFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // User Status
                $filterDataArr = [
                    ['filterPk'=>'A','filterName'=>'Active']
                ];
                break;
            case '2': // Modules
                $filterDataArr = Bizsearch::getModulesDetails($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function projectFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Users mapped to project team members
                $filterDataArr = Bizsearch::projectTeamMembers($cmpPK);
                break;
            case '2': // Users mapped to project contact members
                $filterDataArr = Bizsearch::projectContactMembers($cmpPK);
                break;
            case '3': // Project selection
                $filterDataArr = Bizsearch::userProjectSelection($regPK);
                break;
            case '4': // Project status
                $filterDataArr = Bizsearch::userProjectStatus($cmpPK);
                break;
        }
        return $filterDataArr;
    }

    public function svfFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // User mapped to validation process contact
                $filterDataArr = Bizsearch::svfValidationProcessContact($cmpPK);
                break;
            case '2': // Users mapped to business development contact
                $filterDataArr = Bizsearch::svfBusinessDevelopmentContact($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    
    public function saveSearchDtls() {
        $formDataArr = [
            'userFilter' => [
                'labelName' => 'Users',
                'filterType' => 1,
                'filterData' => [ 
                    '1' => 'Department', 
                    '2' => 'Designation Level'
                ]
            ],
            'businessUnitFilter' => [
                'labelName' => 'Business Unit',
                'filterType' => 2,
                'filterData' => [ 
                    '1' => 'Business Unit'
                ]
            ],
            'productFilter' => [
                'labelName' => 'Products',
                'filterType' => 4,
                'filterData' => [ 
                    '1' => 'Select Users', 
                    '2' => 'Product Selection'
                ]
            ],
            'serviceFilter' => [
                'labelName' => 'Services',
                'filterType' => 5,
                'filterData' => [ 
                    '1' => 'Select Users', 
                    '2' => 'Service Selection'
                ]
            ],
            'monitorLogFilter' => [
                'labelName' => 'Monitor Log',
                'filterType' => 6,
                'filterData' => [ 
                    '1' => 'Module Names', 
                    '2' => 'Log Date'
                ]
            ],
            'ProjectsFilter' => [
                'labelName' => 'Projects',
                'filterType' => 7,
                'filterData' => [ 
                    '1' => 'Users mapped to team members', 
                    '2' => 'Users mapped to contact',
                    '3' => 'Project Selection',
                    '4' => 'Project Stage'
                ]
            ],
            'svfFilter' => [
                'labelName' => 'SVF',
                'filterType' => 8,
                'filterData' => [ 
                    '1' => 'Users mapped to validation process contact', 
                    '2' => 'Users mapped to business development contact'
                ]
            ],
        ];
        return $formDataArr;
    }
}
