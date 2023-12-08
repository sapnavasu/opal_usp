<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;

class Businessunitfilter{

    public static function filterQueryFieldTypeFormation($fsKey, $typeKey){

        switch ($fsKey) {
            case 'businessUnitFilter':
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
                            'fieldName'=>'dsg.dsg_designationname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'projectsFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'sm.SecM_SectorName',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'prjd.prjd_projname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'prjd.prjd_projstatus',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                }
                break;
            case 'licenseFilter':
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
            case 'productsFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'mcsd_businessunitrefname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'pm.PrdM_ProductName',
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
                            'fieldName'=>'mcsd_businessunitrefname',
                            'combination'=>self::fieldCombination(),
                            'dataType'=>self::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'smt.SrvM_ServiceName',
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
            case '2': // Business Source
                $filterResult = self::organizeBsourceFilter($searchType);
                break;
            case '1': // User Filter
                $filterResult = self::organizeUserFilter($searchType);
                break;
            case '3': // Project Filter
                $filterResult = self::organizeProjectFilter($searchType);
                break;
            case '6': // License Filter
                $filterResult = self::organizeLicenseFilter($searchType);
                break;
            case '4': // Product Filter
                $filterResult = self::organizeProductFilter($searchType);
                break;
            case '5': // Service Filter
                $filterResult = self::organizeServiceFilter($searchType);
                break;

        }
        return $filterResult;
    }

    public function organizeBsourceFilter($searchType){
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
        }
        return $combinationArr;
    }

    public function organizeProjectFilter($searchType){
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
            case '2': // Project Selection
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '3': // Project Status
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
        }
        return $combinationArr;
    }
    public function organizeLicenseFilter($searchType){
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
    public function organizeProductFilter($searchType){
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
            case '3': // Product Status
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
        }
        return $combinationArr;
    }
    public function organizeServiceFilter($searchType){
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
            case '2': // Business Source
                $filterResult = self::organizeBsourceFilterData($searchType);
                break;
            case '1': // User Filter
                $filterResult = self::organizeUserFilterData($searchType);
                break;
            case '3': // Project Filter
                $filterResult = self::organizeProjectFilterData($searchType);
                break;
            case '6': // License Filter
                $filterResult = self::organizeLicenseFilterData($searchType);
                break;
            case '4': // Product Filter
                $filterResult = self::organizeProductFilterData($searchType);
                break;
            case '5': // Service Filter
                $filterResult = self::organizeServiceFilterData($searchType);
                break;
        }
        return $filterResult;
    }


    public function organizeBsourceFilterData($searchType){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Business Source
                $filterDataArr = Bizsearch::getBunitBusinessSource($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    public function organizeUserFilterData($searchType){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Department
                $filterDataArr = Bizsearch::getBunitDepartment($cmpPK);
                break;
            case '2': // Designation Level
                $filterDataArr = Bizsearch::getBunitDesignation($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    public function organizeProjectFilterData($searchType){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Project Business unit
                $filterDataArr = Bizsearch::getProjectBusinessunit($cmpPK);
                break;
            case '2': // Project selection
                $filterDataArr = Bizsearch::getProjectSelection($cmpPK);
                break;
            case '3': // Project status
                $filterDataArr = Bizsearch::getProjectStatus($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    public function organizeLicenseFilterData($searchType){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Lisence Business unit
                $filterDataArr = Bizsearch::getLicenseBusinessunit($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    public function organizeProductFilterData($searchType){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Product Business unit
                $filterDataArr = Bizsearch::getProductBusinessunit($cmpPK);
                break;
            case '2': // Product Selection
                $filterDataArr = Bizsearch::getProductSelection($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    public function organizeServiceFilterData($searchType){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $filterDataArr = [];
        switch ($searchType) {
            case '1': // Service Business unit
                $filterDataArr = Bizsearch::getServiceBusinessunit($cmpPK);
                break;
            case '2': // Service Selection
                $filterDataArr = Bizsearch::getServiceSelection($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    
    public function saveSearchDtls() {
        $formDataArr = [
            'businessSourceFilter' => [
                'labelName' => 'Business Source',
                'filterType' => 1,
                'filterData' => [ 
                    '1' => 'Business Source'
                ]
            ],
            'userFilter' => [
                'labelName' => 'Users',
                'filterType' => 2,
                'filterData' => [ 
                    '1' => 'Department', 
                    '2' => 'Designation Level'
                ]
            ],
            'ProjectsFilter' => [
                'labelName' => 'Projects',
                'filterType' => 3,
                'filterData' => [ 
                    '1' => 'Business Unit',
                    '2' => 'Project Selection',
                    '3' => 'Project Status',
                ]
            ],
            'licenseFilter' => [
                'labelName' => 'License',
                'filterType' => 4,
                'filterData' => [ 
                    '1' => 'Business Unit', 
                    '2' => 'Product Selection'
                ]
            ],
            'productFilter' => [
                'labelName' => 'Products',
                'filterType' => 5,
                'filterData' => [ 
                    '1' => 'Business Unit', 
                    '2' => 'Product Selection'
                ]
            ],
            'serviceFilter' => [
                'labelName' => 'Services',
                'filterType' => 6,
                'filterData' => [ 
                    '1' => 'Business Unit', 
                    '2' => 'Service Selection'
                ]
            ]
        ];
        return $formDataArr;
    }
}
