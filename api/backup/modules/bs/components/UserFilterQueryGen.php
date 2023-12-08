<?php
namespace api\modules\bs\components;

use api\modules\bs\components\Querybuilder;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

Class UserFilterQueryGen extends Querybuilder{
    function __construct($data, $joinArrLst)
    {
        $this->userFilter = $data;
        $this->existingJoinList = $joinArrLst;
        $this->dbColMap['country']='mcmpld_countrymst_fk';
        $this->dbColMap['country_text']='c.CyM_CountryName_en';
        $this->dbColMap['state']='mcmpld_statemst_fk';
        $this->dbColMap['state_text']='SM_StateName_en';
        $this->dbColMap['city']='mcmpld_citymst_fk';
        $this->dbColMap['city_text']='CM_CityName_en';
        $this->joinArr['usector'] = [['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'find_in_set(MemCompSecDtls_Pk, um_busunit)'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'SectorMst_Pk = MCSD_SectorMst_Fk']];
        $this->joinArr['usector_text'] = [['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'find_in_set(MemCompSecDtls_Pk, um_busunit)'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'SectorMst_Pk = MCSD_SectorMst_Fk']];
        $this->joinArr['country'] = ['join' => 'left join', 'table' => 'memcompmplocationdtls_tbl c', 'condition' => 'um_address = memcompmplocationdtls_pk'];
        $this->joinArr['country_text'] = ['join' => 'left join', 'table' => 'countrymst_tbl c', 'condition' => 'c.CountryMst_Pk = mcmpld_countrymst_fk'];
        $this->joinArr['state_text'] = ['join' => 'left join', 'table' => 'statemst_tbl', 'condition' => 'StateMst_Pk = mcmpld_statemst_fk'];
        $this->joinArr['city_text'] = ['join' => 'left join', 'table' => 'citymst_tbl', 'condition' => 'CityMst_Pk = mcmpld_citymst_fk'];
        $this->joinArr['designation'] = ['join' => 'left join', 'table' => 'designationmst_tbl dsg', 'condition' => 'dsg.designationmst_pk = um.UM_Designation'];
        $this->joinArr['designation_text'] = ['join' => 'left join', 'table' => 'designationmst_tbl dsg', 'condition' => 'dsg.designationmst_pk = um.UM_Designation'];
        $this->joinArr['department'] = ['join' => 'left join', 'table' => 'departmentmst_tbl dm', 'condition' => 'find_in_set(dm.DepartmentMst_Pk, um_departmentmst_fk)'];
        $this->joinArr['department_text'] = ['join' => 'left join', 'table' => 'departmentmst_tbl dm', 'condition' => 'find_in_set(dm.DepartmentMst_Pk, um_departmentmst_fk)'];
        $this->joinArr['desiglevel_text'] = ['join' => 'left join', 'table' => 'designationlevelmst_tbl dlm', 'condition' => 'dlm.designationlevelmst_pk = um_desiglevel'];
    }
    public function getQuery()
    {
        $dataType = '';
        foreach ($this->userFilter as $fskey => $filterType) {
            if (!empty($filterType)) {
                if (is_array($filterType)) {
                    $sql = (new \yii\db\Query);
                    foreach ($filterType as $key => $data) {
                        $catkey = key($data);
                        $conditiontype = $data['dataType'];
                        unset($data['dataType']);
                        $wheredata = $this->formConditionArr($data, 'atype', 'dataVal', 'combination');
                        if (!empty($wheredata)) {
                            if ($dataType == '' || $dataType == 1)
                                $sql->andWhere($wheredata);
                            elseif ($dataType == 2)
                                $sql->orWhere($wheredata);
                            else
                                $sql->where($wheredata);
                        }
                        $dataType = $conditiontype;
                    }
                    if (!empty($sql->where)) {
                        $wheredata = $sql->createCommand()->getRawSql();
                        if (!empty($wheredata)) {
                            $where[$fskey][] = "(" . $this->formWhere($wheredata, $dataType) . ")";
                            $where[$fskey][] = $this->operator[$dataType];
                        }
                        array_pop($where[$fskey]);
                    }
                }
            }
        }
        $this->formWhereClause($where);
        $this->formJoin();
        return $this->FinalQuery;
    }
     /*
    This function will generate the final where clause in for the given filter
    */
    public function formWhereClause($where)
    {
        if (!empty($where)) {
            $finalwhere = '';
            foreach ($where as $k => $condition) {
                $finalwhere .= " (" . implode(' ', $condition) . ") " . $this->operator[$this->userFilter[$k . 'type']];;
            }
            $finalwhere = trim($finalwhere, 'and');
            $finalwhere = trim($finalwhere, 'or');
            $this->FinalQuery['where'] = $finalwhere;
        }
    }

    /*
    This function will generate the join for the given filter
    */
    public function formJoin()
    {
        if (!empty($this->filterJoin)) {
            $existingLst=array_keys($this->existingJoinList);
            $textArr=ArrayHelper::getColumn($existingLst,function ($element) {
                return $element.'_text';
            });
            $existingLst=array_merge($existingLst,$textArr);
            foreach ($this->filterJoin as $key => $data) {
                if (isset($this->joinArr[$key]) && !in_array($key,$existingLst)) {
                    $joinDtl = $this->joinArr[$key];
                    if(!in_array($key,['usector','usector_text'])){
                        $this->FinalQuery['join'][] = [$joinDtl['join'], $joinDtl['table'], $joinDtl['condition']];
                    }else{
                        $this->FinalQuery['join'][] = array_values($joinDtl[0]);
                        $this->FinalQuery['join'][] = array_values($joinDtl[1]);
                    }
                }
            }
        }
    }    
    function  formConditionArr($array, $from, $to, $group = null)
    {
        $result[] = 'and';
        $isReturn = false;
        foreach ($array as $filterkey => $element) {
            $key = strtolower(ArrayHelper::getValue($element, $from));
            $value = ArrayHelper::getValue($element, $to);
            if (!empty($value)) {
                $isReturn = true;
                $comKey = ArrayHelper::getValue($element, $group);
                $result[] = $this->fieldCondtion($comKey, $filterkey, $value);
            }
        }
        if ($isReturn && !empty($result[1]))
            return $result;
        else
            return '';
    }
    public function fieldCondtion($combinationKey, $dbFieldColKey, $userInput, $extracPram = null)
    {
        if (!empty($dbFieldColKey)) {
            $isNotPartialLikeCondition = true;
            if (in_array($combinationKey, [3, 4]) && !is_array($userInput)) {
                $isNotPartialLikeCondition = false;
                if ($combinationKey == 3) {
                    $userInput = $userInput . '%';
                } elseif ($combinationKey == 4) {
                    $userInput = '%' . $userInput;
                }
            }
            switch ($dbFieldColKey) {
                default:
                    $result = [$this->combination[$combinationKey], $this->generateDBCol($combinationKey, $dbFieldColKey), $userInput];
                    break;
            }
            if ($isNotPartialLikeCondition === false) {
                $result[] = false;
            }
            return $result;
        }
    }    
    /*
    Form db column name
    */
    public function generateDBCol($combination, $type)
    {
        $col = $this->dbColMap[$type];
        if (in_array($combination, [3, 4, 5, 6])) {
            $fieldKey = $type . "_text";
            if (isset($this->joinArr[$fieldKey]))
                $this->filterJoin[$fieldKey] = 1;
            $col = $this->dbColMap[$fieldKey];
        }else{
            if (isset($this->joinArr[$type]))
                $this->filterJoin[$type] = 1;
        }
        return $col;
    }
}
