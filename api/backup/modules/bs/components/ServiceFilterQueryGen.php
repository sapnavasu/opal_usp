<?php

namespace api\modules\bs\components;

use api\modules\bs\components\Querybuilder;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ServiceFilterQueryGen extends Querybuilder
{

    /*
    $data->will have filter input
    $table-will used for which table we create condition T-Temp,M-Main
    */
    function __construct($data, $table = 'M')
    {
        $this->userFilter = $data;
        $this->tableConditionType = $table;
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
    This function will generate the join for the given filter
    */
    public function formJoin()
    {
        if (!empty($this->filterJoin)) {
            foreach ($this->filterJoin as $key => $data) {
                if (isset($this->joinArr[$key])) {
                    $joinDtl = $this->joinArr[$key];
                    if(!in_array($key,['sersector','tsersector'])){
                        $this->FinalQuery['join'][] = [$joinDtl['join'], $joinDtl['table'], $joinDtl['condition']];
                    }else{
                        $joinDtl=array_values(ArrayHelper::map($joinDtl,'table',function ($element) {
                            return array_values($element);
                        }));
                        if(!empty($this->FinalQuery['join']))
                            $this->FinalQuery['join'] = array_merge($this->FinalQuery['join'],$joinDtl);
                        else
                            $this->FinalQuery['join'] = $joinDtl;
                    }
                }
            }
        }
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
                if (in_array($filterkey, ['service'])) {
                    $result[] = $this->fieldCondtion($comKey, $filterkey, $array);
                    break;
                } else {
                    $result[] = $this->fieldCondtion($comKey, $filterkey, $value);
                }
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
                case 'service':
                    $result = $this->Productilter($userInput);
                    break;
                case 'sjsrssts':
                    $result = $this->jsrsFilter($combinationKey, $dbFieldColKey, $userInput);
                    break;
                case 'ssezd':
                    $result = $this->sezdFilter($combinationKey, $dbFieldColKey, $userInput);
                    break;
                case 'sersector':
                    if ($this->tableConditionType == 'T'){
                        // $this->filterJoin['tsersector_secmap'] = 1;
                        $this->filterJoin['tsersector'] = 1;
                    }else{
                        // $this->filterJoin['sersector_secmap'] = 1;
                        $this->filterJoin['sersector'] = 1;
                    }
                    $result = [$this->combination[$combinationKey], $this->generateDBCol($combinationKey, $dbFieldColKey), $userInput];
                    break;
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

    public function Productilter($data)
    {
        $ProductArr = $data['service']['dataVal'];
        $macthCriteria = $ProductArr['matchcriteria'];
        $ProductFilterInputArr = $ProductArr['selectedValArr'];
        if (!empty($ProductFilterInputArr)) {
            if ($macthCriteria == 1)
                $lis[] = $this->AND;
            else
                $lis[] = $this->OR;
            foreach ($ProductFilterInputArr as $key => $list) {
                $list = array_filter($list);
                if (in_array($this->tableConditionType, ['B', 'T'])) {
                    $lis[] = array_merge([$this->AND], [ArrayHelper::map($list, function ($element) {
                        $DbColArr = [1 => 'mcsvd_bgiindcodecateg_fk', 2 => 'mcsvd_bgiindcodesubcateg_fk', 3 => 'mcsvd_bgiinduscodeservmst_fk', 4 => 'MCSvD_ServiceMst_Fk'];
                        return $DbColArr[$element['uid']];
                    }, 'id')]);
                }
                if (in_array($this->tableConditionType, ['B', 'M'])) {
                    $lis[] = array_merge([$this->AND], [ArrayHelper::map($list, function ($element) {
                        $DbColArr = [1 => 'mcsvdm_bgiindcodecateg_fk', 2 => 'mcsvdm_bgiindcodesubcateg_fk', 3 => 'mcsvdm_bgiinduscodeservmst_fk', 4 => 'mcsvdm_servicemst_fk'];
                        return $DbColArr[$element['uid']];
                    }, 'id')]);
                }
            }
        }
        return $lis;
    }

    public function jsrsFilter($combinationKey, $dbFieldColKey, $userInput)
    {
        $dbColumnName = $this->generateDBCol($combinationKey, $dbFieldColKey);
        if (count($userInput) == 1) {
            if ($combinationKey == 1) {
                $JSRS_Sts = ['=',  $dbColumnName, 'A'];
                if ($userInput[0] == 2)
                    $JSRS_Sts = [$this->OR,['<>', $dbColumnName, 'A'],['is', $dbColumnName, new Expression('null')]];
            } else {
                $JSRS_Sts = [$this->OR,['<>', $dbColumnName, 'A'],['is', $dbColumnName, new Expression('null')]];
                if ($userInput[0] == 2)
                    $JSRS_Sts = ['=',  $dbColumnName, 'A'];
            }
        } else {
            $JSRS_Sts = ['is not', $dbColumnName, new Expression('null')];
        }
        return  $JSRS_Sts;
    }
    public function sezdFilter($combinationKey, $dbFieldColKey, $userInput)
    {
        $dbColumnName = $this->generateDBCol($combinationKey, $dbFieldColKey);
        if ($this->tableConditionType == 'M') {
            if (count($userInput) == 1) {
                if ($combinationKey == 1) {
                    if ($userInput[0] == 2)
                        $JSRS_Sts = ['is', $dbColumnName, new Expression('null')];
                    else
                        $JSRS_Sts = ['is not', $dbColumnName, new Expression('null')];
                }else{
                    if ($userInput[0] == 1)
                        $JSRS_Sts = ['is', $dbColumnName, new Expression('null')];
                    else
                        $JSRS_Sts = ['is not', $dbColumnName, new Expression('null')];
                }
            }
        } else {
            if (count($userInput) == 1) {
                if ($combinationKey == 1) {
                    if ($userInput[0] == 2)
                        $JSRS_Sts = [$this->OR,['<>', $dbColumnName, 'A'],['is', $dbColumnName, new Expression('null')]];
                    else 
                        $JSRS_Sts = ['=',  $dbColumnName, 'A'];   
                } else {
                    if ($userInput[0] == 2)
                        $JSRS_Sts = ['=',  $dbColumnName, 'A'];
                    else
                        $JSRS_Sts = [$this->OR,['<>', $dbColumnName, 'A'],['is', $dbColumnName, new Expression('null')]];
                }
            } 
        }
        return  $JSRS_Sts;
    }

    public function generateDBCol($combination, $type)
    {
        if ($this->tableConditionType == 'T')
            $type = 't' . $type;
        $col = $this->dbColMap[$type];
        if (in_array($combination, [3, 4, 5, 6])) {
            $fieldKey = $type . "_text";
            if (isset($this->joinArr[$fieldKey]))
                $this->filterJoin[$fieldKey] = 1;
            $col = $this->dbColMap[$fieldKey];
        }
        return $col;
    }
}
