<?php

namespace api\modules\bs\components;

use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

abstract class Querybuilder
{

    public $dbColMap = [
        'country' => 'MCM_Source_CountryMst_Fk',
        'country_text' => 'CyM_CountryName_en',
        'state' => 'MCM_StateMst_Fk',
        'state_text' => 'SM_StateName_en',
        'city' => 'MCM_CityMst_Fk',
        'city_text' => 'CM_CityName_en',
        'class' => 'mcm_classificationmst_fk',
        'sezad' => 'srd_isprioritysme',
        'sezd' => 'srd_isprioritysme',
        'drpiclcc' => 'mclcd_wilayatmst_fk',
        'oxylcc' => 'mclcd_blockno',
        'pdolcc' => 'scfpcdm_pdocategorymst_fk',
        'riyada' => 'mclch_lcctype',
        'pqs' => 'pqd_suppmemberregmst_fk',
        'ssector' => 'mrm_compsector',
        'jsrssts' => 'MRM_ValSubStatus',
        'tregno' => 'mctbsgd_gtbregno',
        'dateexpiry' => 'mctbsgd_regexpiryDdte',
        'section' => 'tbgm_tendbrdsecmst_fk',
        'grade' => 'tendbrdgrademst_pk',
        'nationality' => 'mcshd_countrymst_fk',
        'stakeholdertype' => 'mcshd_type',
        'perstake' => 'mcshd_percentofstake',
        'icvper' => 'scficvbd_totomanihc',
        'icvper_text' => 'scficvbd_totomanihc',
        'icvperml' => 'momp_totalomani',
        'icvperml_text' => 'momp_totalomani',
        //Product Filter
            // temp table (memcompproddtls_tbl)
            'tpsector'=>'SectorMst_Pk',
            'tpsector_text'=>'SecM_SectorName',
            'tpbussource'=>'businesssourcemst_pk',
            'tpbussource_text'=>'bsm_bussrcname',
            'tpjsrssts'=>'MCPrD_SVFAdminApprovalStatus', 
            'tpsezd'=>'mcprd_sezadstatus', 
            //maintable (memcompproddtlsmain_tbl)
            'psector'=>'SectorMst_Pk',
            'psector_text'=>'SecM_SectorName',
            'pbussource'=>'businesssourcemst_pk',
            'pbussource_text'=>'bsm_bussrcname',
            'pjsrssts'=>'memcompproddtlsmain_pk', 
            'psezd'=>'mcprdm_sezadstatus', 
        //Service Filter
            // temp table (memcompservicedtls_tbl)
            'tsersector'=>'SectorMst_Pk',
            'tsersector_text'=>'SecM_SectorName',
            'tsbussource'=>'businesssourcemst_pk',
            'tsbussource_text'=>'bsm_bussrcname',
            'tsjsrssts'=>'MCSvD_SVFAdminApprovalStatus', 
            'tssezd'=>'mcsvd_sezadstatus', 
            //maintable (memcompservicedtlsmain_tbl)
            'sersector'=>'SectorMst_Pk',
            'sersector_text'=>'SecM_SectorName',
            'sbussource'=>'businesssourcemst_pk',
            'sbussource_text'=>'bsm_bussrcname',
            'sjsrssts'=>'memcompservdtlsmain_pk', 
            'ssezd'=>'mcsvdm_sezadstatus', 
        //User Filter
            'usector'=>'SectorMst_Pk',
            'usector_text'=>'SecM_SectorName',
            'department'=>'DM_Name',
            'department_text'=>'DM_Name',
            'designation'=>'dsg_designationname',
            'designation_text'=>'dsg_designationname',
            'desiglevel'=>'um_desiglevel',
            'desiglevel_text'=>'dlm_desglevelname',
            'suppliername' => 'MCM_CompanyName',
            'suppliername_text' => 'MCM_CompanyName',
    ];
    public $combination = [
        '1' => '=', // Equals to
        '2' => '<>', // Not equals to
        '3' => 'LIKE', // Starts With
        '4' => 'LIKE', // Ends With
        '5' => 'LIKE', // Contains
        '6' => 'Not LIKE', // Not Contains
        '7' => 'Between', // Is
        '8' => '=',
        '9' => '=',
        '10' => '<>',
        '11' => '<',
        '12' => '>',
    ];
    public $inArr = [
        '1' => 'in', // Equals to
        '2' => 'not in', // Not equals to
    ];
    public $operator = [1 => 'and', 2 => 'or'];
    public $notIn = 'Not In';
    public $In = 'In';
    public $AND = 'AND';
    public $OR = 'OR';
    public $joinArr = [
        'sezad' => ['join' => 'left join', 'table' => 'sezadregdtls_tbl', 'condition' => 'MemberCompMst_Pk=srd_memcompmst_fk'],
        'pdolcc' => ['join' => 'left join', 'table' => 'scfpdocatdtlsmain_tbl', 'condition' => 'MemberCompMst_Pk=scfpcdm_memcompmst_fk'],
        // 'lcchrd' => ['join' => 'left join', 'table' => 'memcomplcccerthdr_tbl', 'condition' => 'MemberCompMst_Pk=mclch_membercompmst_fk'],
        'lcc' => ['join' => 'left join', 'table' => 'memcomplcccertdtls_tbl', 'condition' => 'memcomplcccerthdr_pk=mclcd_memcomplcccerthdr_fk'],
        'pqs' => ['join' => 'left join', 'table' => 'prequalifieddtls_tbl', 'condition' => 'MemberRegMst_Pk=pqd_suppmemberregmst_fk and mrm_stkholdertypmst_fk=6'],
        'tregno' => ['join' => 'left join', 'table' => 'memcomptendbrdsecgrddtls_tbl', 'condition' => 'MemberCompMst_Pk=mctbsgd_membercompmst_fk'],
        'tsecgrade' => ['join' => 'left join', 'table' => 'tendbrdgrademst_tbl', 'condition' => 'mctbsgd_tendbrdgrademst_fk=tendbrdgrademst_pk'],
        'shareholder' => ['join' => 'left join', 'table' => 'memcompshareholderdtls_tbl', 'condition' => 'MemberCompMst_Pk=mcshd_memcompmst_fk'],
        'icv' => ['join' => 'left join', 'table' => 'scficvbreakdown_tbl', 'condition' => 'MemberCompMst_Pk=scficvbd_memcompmst_fk'],
        'icvml' => ['join' => 'left join', 'table' => 'ministofmanpower_tbl', 'condition' => 'MemberCompMst_Pk=momp_membercompmst_fk'],
        'ssector' => ['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'mrm_compsector=SectorMst_Pk'],
        'state_text' => ['join' => 'left join', 'table' => 'statemst_tbl', 'condition' => 'MCM_StateMst_Fk=StateMst_Pk'],
        'city_text' => ['join' => 'left join', 'table' => 'citymst_tbl', 'condition' => 'MCM_CityMst_Fk=CityMst_Pk'],
        // 'psector_secmap' => [['join' => 'left join', 'table' => 'memcompprodbussrcmapmain_tbl', 'condition' => 'mcprdm_memcompproddtls_fk = mcpbsmm_memcompproddtls_fk'],['join' => 'left join', 'table' => 'memcompbussrcdtlsmain_tbl', 'condition' => 'memcompbussrcdtlsmain_pk = mcbssm_memcompbussrcdtls_fk'],['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'MemCompSecDtls_Pk = mcbsdm_memcompsecdtls_fk'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'find_in_set(SectorMst_Pk, mcsd.MCSD_SectorMst_Fk)']],
        'psector' => [['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'MemCompSecDtls_Pk = mcbsdm_memcompsecdtls_fk'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)']],
        // 'tpsector_secmap' => [['join' => 'left join', 'table' => 'memcompbussrcdtls_tbl', 'condition' => 'memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk'],['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk']],
        'tpsector' => [['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)']],
        // 'sersector_secmap' => ['join' => 'left join', 'table' => 'memcompbussrcsectormap_tbl', 'condition' => 'memcompbussrcdtlsmain_pk = mcbssm_memcompbussrcdtls_fk'],
        'sersector' =>[['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'MemCompSecDtls_Pk = mcbsdm_memcompsecdtls_fk'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)']],
        // 'tsersector_secmap' => ['join' => 'left join', 'table' => 'memcompbussrcsectormap_tbl', 'condition' => 'memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk'],
        'tsersector' =>[['join' => 'left join', 'table' => 'memcompsectordtls_tbl', 'condition' => 'MemCompSecDtls_Pk = mcbsd_memcompsecdtls_fk'],['join' => 'left join', 'table' => 'sectormst_tbl', 'condition' => 'find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)']],
    ];
    public $filterJoin = [];
    protected $conditionClasses = [];
    abstract public function getQuery();
     /*
    This function will generate the final where clause in for the given filter
    */
    abstract public function formWhereClause($where);

    /*
    This function will generate the join for the given filter
    */
    abstract public function formJoin();

    public function formWhere($whereArr, $conditionType)
    {
        return trim(str_replace('SELECT * WHERE', '', $whereArr));
    }
    
    public static function combinationFilterSrc($searchType,$searchKey, $searchSort, $filterSrh, $smartSrh, $criteriaType) {

$catArr = [2 => 'Supplier', 3 => 'Product', 4 => 'Services', 5 => 'User'];
$selArr = [2 => 'supplier.*', 3 => 'product.*', 4 => 'services.*', 5 => 'user.*'];
$currentCategory = $catArr[$criteriaType];
$selectArrLst=[ 2=>[$currentCategory.'.MemberCompMst_Pk as comppk',$currentCategory.'.MemberCompMst_Pk as joinCompPk',$currentCategory.'.MCM_MemberRegMst_Fk as regpk',$currentCategory.'.MCM_CompanyName as companyName',$currentCategory.'.mcm_complogo_memcompfiledtlsfk as logoid',$currentCategory.'.MCM_Origin as orgin',$currentCategory.'.MCM_Source_CountryMst_Fk as sCountryId',$currentCategory.'.CyM_CountryName_en as country',"case when `$currentCategory`.`MCM_Origin`='I' then 'International' else `$currentCategory`.`ClM_ClassificationType` end as compClass",$currentCategory.'.mcm_externalproflink as extkey',$currentCategory.'.MCM_SupplierCode as scode',$currentCategory.'.mcm_accexpirydate as expdate',"if($currentCategory.mcm_accexpirydate >= current_date(),1,0) as comsts","ifnull($currentCategory.mcpsfd_status,0) as isFav"],
                3=>[$currentCategory.".pFrom",$currentCategory.".MemCompProdDtls_Pk as pdtPk",$currentCategory.".MCPrD_MemberCompMst_Fk as compk",$currentCategory.".MCPrD_MemberCompMst_Fk as joinCompPk",$currentCategory.".MCPrD_DisplayName as displayName",$currentCategory.".mcfd_uploadedby as uupk",$currentCategory.".memcompfiledtls_pk as imagePK",$currentCategory.".mcprd_prodmodelno as pdtRefNo",$currentCategory.".mcprd_prodrefno as pdtModelNo",$currentCategory.".productStatus",$currentCategory.".MCPrD_ProdDesc as pdtDesc",$currentCategory.".MCPrD_NationalProdStatus as nationalPdt",$currentCategory.".PrdM_ProductCode as productCode",$currentCategory.".PrdM_ProductName as productName",$currentCategory.".mcor_overallrating as overAllRating","IFNULL($currentCategory.mcpsfd_status, 0) AS followStatus","group_concat(distinct $currentCategory.bsm_bussrcname) as businessSource",$currentCategory.".bicpm_productcode as bgiUnpscCode",$currentCategory.".MCPrD_SearchKeyword as keywords",$currentCategory.".mcprd_sezadstatus as sezdsts"],
                4=>[$currentCategory.".sFrom",$currentCategory.".MemCompServDtls_Pk as servicePk",$currentCategory.".MCSvD_MemberCompMst_Fk as compk",$currentCategory.".MCSvD_MemberCompMst_Fk as joinCompPk",$currentCategory.".mcfd_uploadedby as uupk",$currentCategory.".memcompfiledtls_pk as imagePK",$currentCategory.".MCSvD_DisplayName as displayName",$currentCategory.".mcsvd_servrefno as serviceModelNo",$currentCategory.".mcsvd_servmodelno as serviceRefNo",$currentCategory.".serviceStatus",$currentCategory.".MCSvD_ServDesc as serviceDescription",$currentCategory.".SrvM_ServiceCode as serviceCode",$currentCategory.".SrvM_ServiceName as serviceName",$currentCategory.".ClsM_ClassCode as sClsCode",$currentCategory.".ClsM_ClassName as sClsName",$currentCategory.".FamM_FamilyCode as sFamCode",$currentCategory.".FamM_FamilyName as sFamName",$currentCategory.".SegM_SegCode as sSegCode",$currentCategory.".SegM_SegName as sSegName",$currentCategory.".mcor_overallrating as overAllRating","ifnull($currentCategory.mcpsfd_status,0) as followStatus","group_concat(distinct $currentCategory.bsm_bussrcname) as businessSource",$currentCategory.".bicsm_servicecode as bgiUnpscCode",$currentCategory.".MCSvD_ServSearchKeyword as keywords"]
    ]   ;
            $filterSrh = json_decode(json_encode($filterSrh), true);
            $finalQuery = (new \yii\db\Query);
            $categorylist = array_keys($filterSrh);
            $filtercomcnt = count($categorylist);

            if (in_array('Supplier', $categorylist) || $criteriaType == 2) {
                $sQuery = B2bsearch::supplierSearch($searchKey, $searchSort, $filterSrh, $smartSrh, 1);
                $queryArr['Supplier'] = $sQuery['ActiveQuery'];
                if ($criteriaType == 2) {
                    $groupBy = $sQuery['ActiveQuery']->groupBy;
                    $orderBy = $sQuery['ActiveQuery']->orderBy;
                }
                if (isset($filterSrh['Supplier'])) {
                    $conditionArr['Supplier'] = end($filterSrh['Supplier']);
                }
            }
            if (in_array('Product', $categorylist) || $criteriaType == 3) {
                $pQuery = B2bsearch::productSearch($searchType,$searchKey, $searchSort, $filterSrh, $smartSrh, 1);
                
                
                $queryArr['Product'] = $pQuery['ActiveQuery'];

                if ($criteriaType == 3) {
                    $groupBy = $pQuery['ActiveQuery']->groupBy;
                    $orderBy = $pQuery['ActiveQuery']->orderBy;
                }
                if (isset($filterSrh['Product'])) {
                    $conditionArr['Product'] = end($filterSrh['Product']);
                }
            }
            if (in_array('Services', $categorylist) || $criteriaType == 4) {
                $sQuery = B2bsearch::serviceSearch($searchType,$searchKey, $searchSort, $filterSrh, $smartSrh, 1);
                $queryArr['Services'] = $sQuery['ActiveQuery'];
                if ($criteriaType == 4) {
                    $groupBy = $sQuery['ActiveQuery']->groupBy;
                    $orderBy = $sQuery['ActiveQuery']->orderBy;
                }
                if (isset($filterSrh['Services'])) {
                    $conditionArr['Services'] = end($filterSrh['Services']);
                }
            }
            if (in_array('User', $categorylist) || $criteriaType == 5) {
                $peoQuery = B2bsearch::peopleSearch($searchKey, $searchSort, $filterSrh, $smartSrh, 1);
                $queryArr['User'] = $peoQuery['ActiveQuery'];
                if ($criteriaType == 4) {
                    $groupBy = $peoQuery['ActiveQuery']->groupBy;
                    $orderBy = $peoQuery['ActiveQuery']->orderBy;
                }
            }

            //print_r($queryArrTemp);die();

            if ($filtercomcnt == 1) {
                
                $finalQuery->from([$currentCategory => "(" . $queryArr[$currentCategory]->createCommand()->getRawSql() . ")"]);
                if ($currentCategory != $categorylist[0]) {
                    $finalQuery->innerJoin([$categorylist[0] => "(" . $queryArr[$categorylist[0]]->createCommand()->getRawSql() . ")"], "{$currentCategory}.joinCompPk={$categorylist[0]}.joinCompPk");
                    $finalQuery->groupBy = $groupBy;
                    $finalQuery->orderBy = $orderBy;
                }
                $finalQuery->select($selArr[$criteriaType]);
            } else {
                if (!in_array('Supplier', $categorylist) && $currentCategory == 'Supplier')
                    $categorylist[] .= 'Supplier';
                array_pop($conditionArr);
                $isOrCondition = false;
                if (in_array(2, $conditionArr)) {
                    $isOrCondition = true;
                }

                $isOrCondition = true;

                if ($isOrCondition) {

                    $currentCategory = $catArr[$criteriaType];
                    $queryArrTemp = $queryArr;
                    $previousJoin = '';
                    $JoinConditionArr = ['Supplier' => 'MemberCompMst_Pk', 'Product' => 'MCPrD_MemberCompMst_Fk', 'Services' => 'MCSvD_MemberCompMst_Fk', 5 => 'user.*'];
                    $GroupByArr = ['Supplier' => 'MemberCompMst_Pk', 'Product' => 'MemCompProdDtls_Pk', 'Services' => 'MemCompServDtls_Pk'];
                    $OrderByArr = ['Supplier' => 'MCM_CompanyName', 'Product' => 'MCPrD_DisplayName', 'Services' => 'MCSvD_DisplayName'];
                    $nextConditionRel = 1;

                   
                    foreach ($categorylist as  $catkey => $category) {
                        $where = '';
                        if ($currentCategory == $category) {
                            $finalQuery->select = $selectArrLst[$criteriaType];
                            $finalQuery->groupBy = [$GroupByArr[$category]];
                            if ($searchSort == 'Desc') {
                                $finalQuery->orderBy([$OrderByArr[$category] => SORT_DESC]);
                            } else {
                                $finalQuery->orderBy([$OrderByArr[$category] => SORT_ASC]);
                            }
                        }
                        if ($category == 'Supplier') {
                            $queryArrTemp[$category]->select = ['*'];
                            $queryArrTemp[$category]->groupBy = ['MemberCompMst_Pk'];
                            $queryArrTemp[$category]->orderBy = ['MCM_CompanyName' => 4];
                            $where = $queryArrTemp[$category]->where[2];
                            unset($queryArrTemp[$category]->where[2]);
                            // if($isSelectEdit)
                            //     $finalQuery->select[12] = "IFNULL({$category}.mcpsfd_status, 0) AS isFav";
                        } elseif ($category == 'Product') {
                            $queryArrTemp[$category]->select = ['*'];
                            $queryArrTemp[$category]->groupBy = '';
                            $queryArrTemp[$category]->from['produnion']->groupBy = '';
                            $queryArrTemp[$category]->orderBy = '';
                            $queryArrTemp[$category]->from['produnion']->union[0]['query']->groupBy = '';
                            $where = $queryArrTemp[$category]->from['produnion']->where[4];
                            unset($queryArrTemp[$category]->from['produnion']->where[4]);
                            unset($queryArrTemp[$category]->from['produnion']->union[0]['query']->where[2]);
                            // if($isSelectEdit)
                            //     $finalQuery->select[15] = "IFNULL({$category}.mcpsfd_status, 0) AS followStatus";
                        } elseif ($category == 'Services') {
                            $queryArrTemp[$category]->select = ['*'];
                            $queryArrTemp[$category]->from['servunion']->groupBy = '';
                            $queryArrTemp[$category]->orderBy = '';
                            $queryArrTemp[$category]->from['servunion']->union[0]['query']->groupBy = '';
                            $where = $queryArrTemp[$category]->from['servunion']->where[5];
                            unset($queryArrTemp[$category]->from['servunion']->where[5]);
                            unset($queryArrTemp[$category]->from['servunion']->union[0]['query']->where[2]);
                            // if($isSelectEdit)
                            //     $finalQuery->select[20] = "IFNULL({$category}.mcpsfd_status, 0) AS followStatus";
                        }
                        // $virtualTable[$category] = $queryArrTemp[$category]->createCommand()->getRawSql();
                        $whereArr[$category]['where'] = $where;
                        $whereArr[$category]['condition'] = $conditionArr[$category];
                        
                        if (empty($finalQuery->from) && isset($queryArrTemp[$category])) {                      
                            $finalQuery->from([$category => "(" . $queryArrTemp[$category]->createCommand()->getRawSql() . ")"]);
                            $finalQuery->andWhere($where);
                            $previousJoin = $category;
                            $nextConditionRel = $conditionArr[$category];
                        } else { 
                            
                            $fromKey=key($finalQuery->from);
                            if ($fromKey != $currentCategory) {
                                $finalQuery->leftJoin([$fromKey => "(" . $finalQuery->from[$fromKey] . ")"], "{$JoinConditionArr[$fromKey]}={$JoinConditionArr[$currentCategory]}");
                                $finalQuery->from([$category => "(" . $queryArrTemp[$category]->createCommand()->getRawSql() . ")"]);
                            } else {
                                if(isset($queryArrTemp[$category])) {
                                    $finalQuery->leftJoin([$category => "(" . $queryArrTemp[$category]->createCommand()->getRawSql() . ")"], "{$JoinConditionArr[$previousJoin]}={$JoinConditionArr[$category]}");    
                                }
                            }
                            if ($nextConditionRel == 2) {

                                if(trim($where)!=''){
                                    $finalQuery->orWhere($where);
                                }
                               
                            }                               
                            else {
                                if(trim($where)!=''){
                                  $finalQuery->andWhere($where);    
                                }
                            }
                                

                            $nextConditionRel = $conditionArr[$category];
                        }
                    }
                    if ($filtercomcnt > 2) {

                        $conditionOprArr = [1 => 'AND', 2 => 'OR'];
                        $whereArr = array_values($whereArr);
                       /* below code commented and newly added */
                        if($conditionOprArr[$whereArr[0]['condition']]!='') {
                            $wArr[0] = $conditionOprArr[$whereArr[0]['condition']];
                            $wArr[1] = $whereArr[0]['where'];
                        }
                        if($conditionOprArr[$whereArr[1]['condition']]!='') {
                            $wArr[2][0] = $conditionOprArr[$whereArr[1]['condition']];
                            $wArr[2][1] = $whereArr[1]['where'];
                        }
                        if($conditionOprArr[$whereArr[2]['condition']]!='') {
                            $wArr[3][0] = $whereArr[2]['where'];
                        }
                         /* below code commented and newly added */
                        
                       // $wArr = [$conditionOprArr[$whereArr[0]['condition']], $whereArr[0]['where'], [$conditionOprArr[$whereArr[1]['condition']], $whereArr[1]['where'], $whereArr[2]['where']]];
                      
                        $finalQuery->where = $wArr;

                    }else{
                       $finalQuery->where=array_filter($finalQuery->where);
                    }
                } else {

                    foreach ($categorylist as  $catkey => $category) {
                       
                        if ($currentCategory == $category) {                            
                            $finalQuery->from([$currentCategory => "(" . $queryArr[$currentCategory]->createCommand()->getRawSql() . ")"]);
                            $finalQuery->groupBy = $groupBy;
                            $finalQuery->orderBy = $orderBy;
                        } else {
                            $finalQuery->innerJoin([$category => "(" . $queryArr[$category]->createCommand()->getRawSql() . ")"], "{$currentCategory}.joinCompPk={$category}.joinCompPk");
                        }
                    }
                    
                    $finalQuery->select($selArr[$criteriaType]); 
                }
            }
            //echo $finalQuery->createCommand()->getRawSql();die();
        return  $finalQuery;
    }
}
