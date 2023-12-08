<?php

namespace api\modules\bs\components;
use common\components\Security;
use \api\modules\bs\components\Bizsearch;
use \api\modules\bs\components\Userfilter;

class Monitorlogfilter{

	public static function filterQueryFieldTypeFormation($fsKey, $typeKey){

        switch ($fsKey) {
            case 'monitorLogFilter':
                switch ($typeKey) {
                    case '1':
                        $result = [
                            'type'=>1,
                            'fieldName'=>'um.UM_Status',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'bm.bmm_name',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>3,
                            'fieldName'=>'bm.bmm_name',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                    case '4':
                        $result = [
                            'type'=>4,
                            'fieldName'=>'act.acm_actionname',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                    case '5':
                        $result = [
                            'type'=>5,
                            'fieldName'=>'uml.uml_viewedon',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
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
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                    case '2':
                        $result = [
                            'type'=>2,
                            'fieldName'=>'dlm.dlm_desglevelname',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                    case '3':
                        $result = [
                            'type'=>3,
                            'fieldName'=>'um.UM_Status',
                            'combination'=>Userfilter::fieldCombination(),
                            'dataType'=>Userfilter::fieldDataType()
                        ];
                        break;
                }
                break;
        }
        return $result;
    }

	public static function organizeFilter($filterType, $searchType){
        //print_r($filterType);die();
        switch ($filterType) {
            case '1': 
                $filterResult = self::organizeUserFilter($searchType);
                break;
            case '3': // Monitor Log Filter
                $filterResult = self::monitorLogFilter($searchType);
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
            case '3': // Sub Module Names
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1'],
                    ['type'=>'3','name'=>'Starts With','displayType'=>'2'],
                    ['type'=>'4','name'=>'Ends With','displayType'=>'2'],
                    ['type'=>'5','name'=>'Contains','displayType'=>'2'],
                    ['type'=>'6','name'=>'Not Contains','displayType'=>'2']
                ];
                break;
            case '4': // Action
                $combinationArr = [
                    ['type'=>'1','name'=>'Equals to','displayType'=>'1'],
                    ['type'=>'2','name'=>'Not equals to','displayType'=>'1']
                ];
                break;
            case '5': // Module Names
                $combinationArr = [
                    ['type'=>'9','name'=>'Between','displayType'=>'3']
                ];
                break;
        }
        return $combinationArr;
    }

    public static function organizeFilterData($filterType, $searchType){
        //print_r($filterType);die();
        switch ($filterType) {
            case '1':
                $filterResult = self::organizeUserFilterData($searchType);
                break;
            case '3': // Monitor Log Filter
                $filterResult = self::monitorLogFilterData($searchType);
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
            case '3': // Sub Modules
                $filterDataArr = Bizsearch::getSubModulesDetails($cmpPK);
                break;
            case '4': // Action
                $filterDataArr = Bizsearch::getActionDetails($cmpPK);
                break;
        }
        return $filterDataArr;
    }
    
    public function saveSearchDtls() {
        $formDataArr = [
            'monitorLogFilter' => [
                'labelName' => 'Monitor Log',
                'filterType' => 6,
                'filterData' => [ 
                    '2' => 'Module Names', 
                    '3' => 'Sub Module Names',
                    '4' => 'Action',
                    '5' => 'Log Date',
                ]
            ]
        ];
        return $formDataArr;
    }
}
