<?php
namespace api\modules\bs\components;

use api\modules\bs\components\Querybuilder;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

Class SupplierFilterQueryGen extends Querybuilder{
    function __construct($data)
    {
        $this->userData = $data;      

    }

    public function getQuery()
    {
        $dataType = '';
        foreach ($this->userData as $fskey => $filterType) {
            if (!empty($filterType)) {
                if (is_array($filterType)) {
                    $sql = (new \yii\db\Query);
                    foreach ($filterType as $key => $data) {
                        $conditiontype = $data['dataType'];
                        unset($data['dataType']);
                        $wheredata = $this->arraymap($data, 'atype', 'dataVal', 'combination');
                        if (!empty($wheredata)) {
                            if ($dataType == '' || $dataType == 1)
                                $sql->andWhere($wheredata);
                            elseif ($dataType == 2)
                                $sql->orWhere($wheredata);
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
                $finalwhere .= " (" . implode(' ', $condition) . ") " . $this->operator[$this->userData[$k . 'type']];;
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
            foreach ($this->filterJoin as $key => $data) {
                if (isset($this->joinArr[$key])) {
                    $joinDtl = $this->joinArr[$key];
                    $this->FinalQuery['join'][] = [$joinDtl['join'], $joinDtl['table'], $joinDtl['condition']];
                }
            }
        }
    }
    function  arraymap($array, $from, $to, $group = null)
    {
        $result[] = 'and';
        $isReturn = false;
        foreach ($array as $filterkey => $element) {
            $key = strtolower(ArrayHelper::getValue($element, $from));
            $value = ArrayHelper::getValue($element, $to);
            if (!empty($value)) {
                $isReturn = true;
                $comKey = ArrayHelper::getValue($element, $group);
                if (in_array($filterkey, ['lcc', 'tregno', 'nationality', 'icv', 'icvml'])) {
                    $result[] = $this->fieldCondtion($comKey, $filterkey, $array);
                    break;
                } else {
                    $result[] = $this->fieldCondtion($comKey, $filterkey, $value);
                }
                // $result[] = [$this->combination[ArrayHelper::getValue($element, $group)], $this->dbColMap[$filterkey], $value];
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
                case 'class':
                    $result = [$this->inArr[$combinationKey], $this->dbColMap[$dbFieldColKey], $userInput];
                    break;
                case 'sezad':
                    $result = $this->sezd($combinationKey, $dbFieldColKey, $userInput);
                    break;
                case 'sezd':
                    $result = $this->sezd($combinationKey, $dbFieldColKey, $userInput);
                    break;    
                case 'lcc':
                    $result = $this->formLccConditon($userInput);
                    break;
                case 'drpiclcc': //memcomplcccertdtls_tbl
                case 'oxylcc':
                case 'pdolcc': //scfpdocatdtlsmain_tbl
                    $result = [$this->inArr[$combinationKey], $this->dbColMap[$dbFieldColKey], $userInput];
                    break;
                case 'riyada': //memcomplcccertdtls_tbl  
                                  
                    if (count($userInput) == 1) {
                        $ryada_supplier = [95, 98, 112, 121, 124, 147, 199, 241, 283, 311, 473, 496, 512, 12860, 14914, 14974, 14975, 15040, 15043, 15061, 15069, 15111, 15129, 15166, 15174, 15200, 15201, 15249, 15271, 15304, 15351, 15363, 15365, 15393, 15433, 15484, 15502, 15505, 15512, 15521, 15537, 15615, 15634, 15660, 15736, 15742, 15753, 15760, 15761, 15790, 15897, 15966, 15984, 16016, 16035, 16050, 16085, 16155, 16171, 16183, 16209, 16232, 16301, 16368, 16429, 16517, 16579, 16591, 16618, 16645, 16712, 16745, 16832, 16860, 16875, 16894, 17025, 17035, 17081, 17119, 17127, 17147, 17151, 17154, 17171, 17178, 17193, 17219, 17225, 17271, 17288, 17310, 17340, 17387, 17434, 17443, 17448, 17507, 17526, 17532, 17551, 17572, 17579, 17618, 17675, 17684, 17711, 17749, 17756, 17785, 17803, 17811, 17813, 17821, 17896, 17918, 17928, 18002, 18025, 18038, 18049, 18094, 18170, 18219, 18290, 18295, 18302, 18410, 18427, 18443, 18458, 18503, 18513, 18520, 18522, 18534, 18602, 18637, 18641, 18651, 18668, 18671, 18724, 18727, 18798, 18839, 18854, 18860, 18908, 18909, 18915, 18917, 18926, 18928, 18929, 18935, 18990, 19019, 19062, 19077, 19110, 19167, 19206, 19254, 19269, 19277, 19303, 19330, 19397, 19401, 19439, 19467, 19478, 19549, 19552, 19555, 19566, 19572, 19635, 19644, 19656, 19667, 19679, 19695, 19706, 19717, 19741, 19755, 19766, 19782, 19788, 19793, 19838, 19841, 19850, 19878, 19911, 19919, 19920, 19923, 19933, 19934, 19988, 20021, 20023, 20036, 20044, 20067, 20081, 20091, 20123, 20146, 20173, 20178, 20200, 20225, 20226, 20282, 20330, 20379, 20391, 20470, 20513, 20523, 20543, 20553, 20592, 20659, 20684, 20716, 20722, 20747, 20771, 20816, 20823, 21144, 21205, 21216, 21245, 21320, 21334];
                        $this->filterJoin['lcchrd'] = 1;
                        $result = [$this->OR, [$this->combination[$userInput[0]], $this->dbColMap[$dbFieldColKey], 5], [$this->inArr[$userInput[0]], 'MemberCompMst_Pk', $ryada_supplier]];
                    }
                    break;
                case 'pqs':
                    $result = $this->preQualSupp($combinationKey, $dbFieldColKey, $userInput);
                    break;
                case 'ssector':
                    $result = $this->suppSector($combinationKey, $dbFieldColKey, $userInput);
                    break;
                case 'jsrssts':
                    $result = $this->suppJsrssts($combinationKey, $dbFieldColKey, $userInput);
                    break;
                case 'tregno':
                    $result = $this->tenderboard($userInput);
                    break;
                case 'nationality':
                    $result = $this->shareholder($userInput);
                    break;
                case 'icv':
                case 'icvml':
                    $result = $this->icv($userInput, $dbFieldColKey);
                    break;
                case 'desglevel':
                case 'desglevelml':
                    if ($dbFieldColKey == 'desglevel') {
                        $desDbField = [1 => 'scficvbd_totsmhc', 2 => 'scficvbd_totprohc', 3 => 'scficvbd_totsupvhc', 4 => 'scficvbd_totskdhc', 5 => 'scficvbd_totsskdhc', 6 => 'scficvbd_totuskdhc'];
                        $result = [$this->combination[$combinationKey], $desDbField[$extracPram], $userInput];;
                    } else {
                        $desDbField = [1 => 'momp_totalspecialist', 2 => 'momp_totaltech', 3 => 'momp_totaloccupant', 4 => 'momp_totalskilled', 5 => 'momp_totallowskilled'];
                        $result = [$this->combination[$combinationKey], $desDbField[$extracPram], $userInput];;
                    }
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
    /*
This function is used to generate supplier filter LCC
*/
    public function formLccConditon($lccArr)
    {
        $isLCCFilter = True;
        if ($lccArr['lcc']['dataVal'] != 'LCC') {
            $isLCCFilter = false;
        }
        $bpStaticList = Yii::$app->params['staticList']['BP'];  //Bp static supplier list
        if ($isLCCFilter) {
            $comSelection = $lccArr['lccstakeholder']['combination'];
            $listofOpr = $lccArr['lccstakeholder']['dataVal'];  // list of lcc selected
            if ($comSelection == 1) { // lcc applicable
                if (in_array(0, $listofOpr)) {
                    $listofOpr = array_filter($listofOpr);  // remove the zero value
                    $BPLCC = [$this->In, 'MemberRegMst_Pk', $bpStaticList];
                }
                if (in_array(1, $listofOpr)) {
                    $this->filterJoin['lcchrd'] = 1;
                    $CCEDLCC = ['mclch_lcctype' => 1, 'mclch_status' => 1];
                }
                if (in_array(2, $listofOpr) &&  !empty($lccArr['drpiclcc']['dataVal'])) {
                    $DRPICLCC = [$this->AND, $this->fieldCondtion($lccArr['drpiclcc']['combination'], 'drpiclcc', $lccArr['drpiclcc']['dataVal']), ['mclch_lcctype' => 2, 'mclch_status' => 1]];
                    $this->filterJoin['lcc'] = 1;
                } elseif (in_array(2, $listofOpr) &&  empty($lccArr['drpiclcc']['dataVal'])) {
                    $this->filterJoin['lcchrd'] = 1;
                    $DRPICLCC = ['mclch_lcctype' => 2, 'mclch_status' => 1];
                }
                if (in_array(3, $listofOpr) &&  !empty($lccArr['oxylcc']['dataVal'])) {
                    $OXYLCC = [$this->AND, $this->fieldCondtion($lccArr['oxylcc']['combination'], 'oxylcc', $lccArr['oxylcc']['dataVal']), ['mclch_lcctype' => 3, 'mclch_status' => 1]];
                    $this->filterJoin['lcc'] = 1;
                } elseif (in_array(3, $listofOpr) &&  empty($lccArr['oxylcc']['dataVal'])) {
                    $this->filterJoin['lcchrd'] = 1;
                    $OXYLCC = ['mclch_lcctype' => 3, 'mclch_status' => 1];
                }
                if (in_array(4, $listofOpr) &&  !empty($lccArr['pdolcc']['dataVal'])) {
                    $this->filterJoin['pdolcc'] = 1;
                    $PDOLCC = [$this->AND, $this->fieldCondtion($lccArr['pdolcc']['combination'], 'pdolcc', $lccArr['pdolcc']['dataVal']), ['mclch_lcctype' => 4, 'mclch_status' => 1]];
                } elseif (in_array(4, $listofOpr) &&  empty($lccArr['pdolcc']['dataVal'])) {
                    $this->filterJoin['lcchrd'] = 1;
                    $PDOLCC = ['mclch_lcctype' => 4, 'mclch_status' => 1];
                }
                $arr = array_filter([$this->OR, $BPLCC, $CCEDLCC, $DRPICLCC, $OXYLCC, $PDOLCC]);
            } else { // lcc not applicable
                $this->filterJoin['lcchrd'] = 1;
                if (in_array(0, $listofOpr)) {
                    $listofOpr = array_filter($listofOpr);
                    $arr = [
                        $this->AND,
                        [$this->notIn, 'mclch_lcctype', $listofOpr],
                        [$this->notIn, 'MemberRegMst_Pk', $bpStaticList]
                    ];
                } else {
                    $this->filterJoin['pqs'] = 1;
                    $arr = [$this->notIn, 'mclch_lcctype', $listofOpr];
                }
            }
        } else {
            $arr = [$this->AND, ['is', 'memcomplcccerthdr_pk', new Expression('null')], [$this->notIn, 'MemberRegMst_Pk', $bpStaticList]];
        }
        return $arr;
    }
    /*
This function is used to generate supplier filter JSRS active and expire condition 
*/
    public function suppJsrssts($combinationKey, $dbFieldColKey, $userInput)
    {

        if (count($userInput)==1) {
            $currentDate = new Expression('current_date()');
            if ($combinationKey == 1) {
                $JSRS_Sts = ['>=', 'mcm_accexpirydate', $currentDate];
                if ($userInput[0] == 2)
                    $JSRS_Sts = ['<', 'mcm_accexpirydate', $currentDate];
            } else {
                $JSRS_Sts = ['<', 'mcm_accexpirydate', $currentDate];
                if ($userInput[0] == 2)
                    $JSRS_Sts = ['>=', 'mcm_accexpirydate', $currentDate];
            }

           

        }else{
           
            $JSRS_Sts = ['is not', 'mcm_accexpirydate', new Expression('null')];
        }
        return [$this->AND, ['=', $this->dbColMap[$dbFieldColKey], 'A'], $JSRS_Sts];
    }
    /*
This function is used to generate supplier filter for sector
Table:sectormst_tbl (other than equal and not equal)
*/
    public function suppSector($combinationKey, $dbFieldColKey, $userInput)
    {
        if (in_array($combinationKey, [1, 2])) {
            $result = [$this->combination[$combinationKey], $this->dbColMap[$dbFieldColKey], $userInput];
        } else {
            $this->filterJoin['ssector'] = 1;
            $result = [$this->combination[$combinationKey], 'SecM_SectorName', $userInput];
        }
        return $result;
    }
    /*
This function is used to generate supplier filter for sector
Table:prequalifieddtls_tbl
*/
    public function preQualSupp($combinationKey, $dbFieldColKey, $userInput)
    {
        $this->filterJoin['pqs'] = 1;
        if (count($userInput) == 1) {
            if ($userInput[0] != 1)
                $result = ['IS', $this->dbColMap[$dbFieldColKey], new Expression('null')];
            else
                $result = ['IS NOT', $this->dbColMap[$dbFieldColKey], new Expression('null')];
            return $result;
        } else {
            return '';
        }
    }
    /*
    This function is used to generate supplier sezad filter for sector
    Table: sezadregdtls_tbl
    */
    public function sezd($combinationKey, $dbFieldColKey, $userInput)
    {
        $sme = [];
        if (in_array(1, $userInput)) {
            $sme[] = 1;
        }
        if (in_array(2, $userInput)) {
            $sme[] = 0;
        }
        if (!empty($sme)) {
            $smecontionArr = [$this->inArr[$combinationKey], $this->dbColMap[$dbFieldColKey], $sme];
        }
        if (in_array(3, $userInput)) {
            $result = [$this->OR, $smecontionArr, [$this->inArr[$combinationKey], 'MemberRegMst_Pk', [1, 2]]];
            if ($combinationKey == 2)
                $result = [$this->AND, $smecontionArr, [$this->inArr[$combinationKey], 'MemberRegMst_Pk', [1, 2]]];
            $result = array_filter($result);
        } else {
            $result = $smecontionArr;
        }
        $this->filterJoin['sezad'] = 1;
        return $result;
    }
    /*
    This function is used to generate supplier filter for Tender Board
    Table:  memcomptendbrdsecgrddtls_tbl(Tender Registration Number And Expiry)
            tendbrdgrademst_tbl(Section and Grade) 
    Condition: 'AND' is the condition between all tender board filter inputs        
    */
    public function tenderboard($Arr)
    {
        $this->filterJoin['tregno'] = 1;
        if (!empty($Arr['tregno']['dataVal'])) {
            $tendRegNo = [$this->combination[$Arr['tregno']['combination']], $this->dbColMap['tregno'], $Arr['tregno']['dataVal']];
        }
        if (!empty($Arr['dateexpiry']['dataVal'])) {
            $tendExpDate = [$this->combination[$Arr['dateexpiry']['combination']], $this->dbColMap['dateexpiry'], $Arr['dateexpiry']['dataVal']['startDate'], $Arr['dateexpiry']['dataVal']['endDate']];
        }
        if (!empty($Arr['grade']['dataVal'])) {
            $this->filterJoin['tsecgrade'] = 1;
            $tendSecGrade = [$this->combination[$Arr['grade']['combination']], $this->dbColMap['grade'], $Arr['grade']['dataVal']];
        } elseif (!empty($Arr['section']['dataVal'])) {
            $this->filterJoin['tsecgrade'] = 1;
            $tendSecGrade = [$this->combination[$Arr['section']['combination']], $this->dbColMap['section'], $Arr['section']['dataVal']];
        }
        $res = array_filter([$this->AND, $tendRegNo, $tendExpDate, $tendSecGrade]);
        return $res;
    }
    /*
    This function is used to generate supplier filter for shareholder
    Table:  memcompshareholderdtls_tbl
    Condition: 'AND' is the condition between all shareholder filter inputs        
    */
    public function shareholder($Arr)
    {
        $this->filterJoin['shareholder'] = 1;
        if (!empty($Arr['nationality']['dataVal'])) {
            $nationality = [$this->combination[$Arr['nationality']['combination']], $this->dbColMap['nationality'], $Arr['nationality']['dataVal']];
        }
        if (!empty($Arr['stakeholdertype']['dataVal'])) {
            $stkType = [$this->combination[$Arr['stakeholdertype']['combination']], $this->dbColMap['stakeholdertype'], $Arr['stakeholdertype']['dataVal']];
        }
        if (!empty($Arr['perstake']['dataVal'])) {
            $perstake = [$this->combination[$Arr['perstake']['combination']], $this->dbColMap['perstake'], $Arr['perstake']['dataVal']];
        }
        $res = array_filter([$this->AND, $nationality, $stkType, $perstake]);
        return $res;
    }
    /*
    This function is used to generate supplier filter for ICV
    Table:  scficvbreakdown_tbl
            ministofmanpower_tbl

    Condition: 'AND' is the condition between all icv filter inputs        
    */
    public function icv($Arr, $type)
    {
        if ($type == 'icv') {
            $this->filterJoin['icv'] = 1;
            $icvType = $Arr['icv']['dataVal'];
            if (!empty($Arr['desglevel']['dataVal']) && $icvType == 1) {
                $res = $this->fieldCondtion($Arr['desglevel']['combination'], 'desglevel', $Arr['desglevel']['dataVal'], $Arr['desglevel']['atype']);
            } elseif (!empty($Arr['icvper']['dataVal']) && $icvType == 2) {
                $val = $Arr['icvper']['dataVal'];
                $combination = $Arr['icvper']['combination'];
                if (in_array($Arr['icvper']['combination'], [1, 2])) {
                    $val = explode('-', $val);
                    $combination = 7;
                    $res = [$this->combination[7], $this->dbColMap['icvper'], $val[0], $val[1]];
                } else {
                    $res = $this->fieldCondtion($combination, 'icvper', $val);
                }
            }
        } elseif ($type == 'icvml') {
            $this->filterJoin['icvml'] = 1;
            $icvType = $Arr['icvml']['dataVal'];
            if (!empty($Arr['desglevelml']['dataVal']) && $icvType == 1) {
                $res = $this->fieldCondtion($Arr['desglevelml']['combination'], 'desglevelml', $Arr['desglevelml']['dataVal'], $Arr['desglevelml']['atype']);
            } elseif (!empty($Arr['icvperml']['dataVal']) && $icvType == 2) {
                $val = $Arr['icvperml']['dataVal'];
                $combination = $Arr['icvperml']['combination'];
                if (in_array($Arr['icvperml']['combination'], [1, 2])) {
                    $val = explode('-', $val);
                    $combination = 7;
                    $res = [$this->combination[7], $this->dbColMap['icvperml'], $val[0], $val[1]];
                } else {
                    $res = $this->fieldCondtion($combination, 'icvperml', $val);
                }
            }
        }
        return $res;
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
        }
        return $col;
    }
}