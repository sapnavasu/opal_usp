<?php

namespace api\modules\bs\components;

use api\modules\mst\models\CitymstTbl;
use api\modules\mst\models\CountrymstTbl;
use api\modules\mst\models\SectormstTblQuery;
use api\modules\mst\models\StatemstTbl;
use Codeception\Lib\Connector\Yii1;
use common\components\Drive;
use common\models\MembercompanymstTbl;
use Yii;
use common\components\Security;
use common\models\DesignationlevelmstTblQuery;
use common\models\MemberregistrationmstTbl;
use common\models\MemcompproddtlsmainTbl;
use common\models\MemcompproddtlsTbl;
use common\models\MemcompservicedtlsTbl;
use commogn\models\MemcompsectordtlsTbl;
use common\models\MemcompservicedtlsmainTbl;
use common\models\PdocategorymstTbl;
use common\models\PdocategorymstTblQuery;
use common\models\TendbrdgrademstTblQuery;
use common\models\TendbrdsecmstTblQuery;
use common\models\UsermstTbl;
use common\models\UserpermtrnTbl;
use common\models\WalivlgblockmapTblQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class B2bsearch
{
    //{"savedata":{"searchType":2,"criteriaType":"2","keyword":[],"filterData":"","saveName":"ttt","queryAll":true}}

    public function b2bCriteria()
    {
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type', true);


        // stakeholder product count
        // $suppcnt = self::companyCount();
        // // stakeholder product count
        // $productcnt = self::companyProductCount();
        // // stakeholder service count
        // $servicecnt = self::companyServiceCount();
        // // stakeholder people count
        // $peoplecnt = self::companyPeopleCount();
        return [
            /*[
                'criteriaType' => '1',
                'criteriaName' => 'All',
                'criteriaCount' => str_pad(($productcnt + $servicecnt + $suppcnt + $peoplecnt), 2, '0', STR_PAD_LEFT),
                'stakeholderType' => [],
            ],*/
            [
                'criteriaType' => '2',
                'criteriaName' => 'Suppliers',
                // 'criteriaCount' => str_pad($suppcnt, 2, '0', STR_PAD_LEFT),
                'stakeholderType' => ['1', '2', '3', '4', '6', '7', '9', '11'],
            ],
            [
                'criteriaType' => '3',
                'criteriaName' => 'Products',
                // 'criteriaCount' => str_pad($productcnt, 2, '0', STR_PAD_LEFT),
                'stakeholderType' => ['1', '2', '3', '4', '6', '7', '9', '11'],
            ],
            [
                'criteriaType' => '4',
                'criteriaName' => 'Services',
                // 'criteriaCount' => str_pad($servicecnt, 2, '0', STR_PAD_LEFT),
                'stakeholderType' => ['1', '2', '3', '4', '6', '7', '9', '11'],
            ],
            [
                'criteriaType' => '5',
                'criteriaName' => 'People',
                // 'criteriaCount' => str_pad($peoplecnt, 2, '0', STR_PAD_LEFT),
                'stakeholderType' => ['1', '2', '3', '4', '6', '7', '9', '11'],
            ],
            // [
            //     'criteriaType'=>'6',
            //     'criteriaName'=>'Partnerships',
            //     'criteriaCount'=> 1,
            //     'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
            // ],
            // [
            //     'criteriaType'=>'7',
            //     'criteriaName'=>'Events',
            //     'criteriaCount'=> 1,
            //     'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
            // ],
        ];
    }
    public function companyCount()
    {
        $suppcnt = MemberregistrationmstTbl::find()
            ->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A'
            ])->count();
        return $suppcnt;
    }
    public function companyPeopleCount()
    {
        $usercnt = UserpermtrnTbl::find()
            ->innerJoin('usermst_tbl', 'UPT_UserMst_Fk=UserMst_Pk')
            ->innerJoin('memberregistrationmst_tbl', 'UM_MemberRegMst_Fk=MemberRegMst_Pk')
            ->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'UM_Status' => 'A',
                'upt_basemodulemst_fk' => '54' //jsearch access
            ])->count();
        return $usercnt;
    }
    public function companyProductCount()
    {
        $productQuery = MemcompproddtlsTbl::find()
            ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = MCPrD_MemberCompMst_Fk')
            ->innerJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
            ->where([
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'mrm_stkholdertypmst_fk' => '6',
                'mcprd_isdeleted' => '2'
            ])->andWhere(['not', ['MCPrD_CreatedOn' => null]])
            ->andWhere(['!=', 'mcprd_isdeleted', 1])->count();
        return $productQuery;
    }
    public function companyServiceCount()
    {
        $serviceQuery = MemcompservicedtlsTbl::find()
            ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = MCSvD_MemberCompMst_Fk')
            ->innerJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
            ->where([
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'mrm_stkholdertypmst_fk' => '6',
                'mcsvd_isdeleted' => '2'
            ])->andWhere(['not', ['mcsvd_CreatedOn' => null]])->andWhere(['!=', 'mcsvd_isdeleted', 1])->count();

        return $serviceQuery;
    }
    public function formFilterCondition($filterSrh)
    {
        $filterSrh = json_decode(json_encode($filterSrh), true);
        $categorylist = array_keys($filterSrh);
        if (in_array('Supplier', $categorylist)) {
            $queryObject = new SupplierFilterQueryGen($filterSrh['Supplier']);
            $query['Supplier'] = $queryObject->getQuery();
        }
        if (in_array('Product', $categorylist)) {
            $queryObject = new ProductFilterQueryGen($filterSrh['Product']);
            $query['Product'] = $queryObject->getQuery();
        }
        if (in_array('Service', $categorylist)) {
            $queryObject = new ProductFilterQueryGen($filterSrh['Service']);
            $query['Service'] = $queryObject->getQuery();
        }
        echo '<pre>';
        print_r($query);
        exit;
    }
    public function b2bsearch($searchType,$criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh = '', $smartSrh = '')
    {
        

        if (empty($filterSrh)) { 
            switch ($criteriaType) {
                case '2': // Supplier
                    $finalQuery = self::supplierSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '3': // Product
                    $finalQuery = self::productSearch($searchType,$searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '4': // Service
                    $finalQuery = self::serviceSearch($searchType,$searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '5': // People
                    $finalQuery = self::peopleSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
            }
        } else { 


            $finalQuery=Querybuilder::combinationFilterSrc($searchType,$searchKey, $searchSort, $filterSrh, $smartSrh, $criteriaType);
            // $filterSrh = json_decode(json_encode($filterSrh), true);
            // $finalQuery = (new \yii\db\Query);
            // $categorylist = array_keys($filterSrh);
            // $filtercomcnt = count($categorylist);
            // if (in_array('Supplier', $categorylist) || $criteriaType == 2) {
            //     $sQuery = self::supplierSearch($searchKey, $searchSort, $filterSrh, $smartSrh, 1);
            //     $queryArr['Supplier'] = $sQuery['ActiveQuery'];
            //     if ($criteriaType == 2) {
            //         $groupBy = $sQuery['ActiveQuery']->groupBy;
            //         $orderBy = $sQuery['ActiveQuery']->orderBy;
            //     }
            //     if (isset($filterSrh['Supplier'])) {
            //         $conditionArr['Supplier'] = end($filterSrh['Supplier']);
            //     }
            // }
            // if (in_array('Product', $categorylist) || $criteriaType == 3) {
            //     $pQuery = self::productSearch($searchKey, $searchSort, $filterSrh, $smartSrh, 1);
            //     $queryArr['Product'] = $pQuery['ActiveQuery'];
            //     if ($criteriaType == 3) {
            //         $groupBy = $pQuery['ActiveQuery']->groupBy;
            //         $orderBy = $pQuery['ActiveQuery']->orderBy;
            //     }
            //     if (isset($filterSrh['Product'])) {
            //         $conditionArr['Product'] = end($filterSrh['Product']);
            //     }
            // }
            // if (in_array('Services', $categorylist) || $criteriaType == 4) {
            //     $sQuery = self::serviceSearch($searchKey, $searchSort, $filterSrh, $smartSrh, 1);
            //     $queryArr['Services'] = $sQuery['ActiveQuery'];
            //     if ($criteriaType == 4) {
            //         $groupBy = $sQuery['ActiveQuery']->groupBy;
            //         $orderBy = $sQuery['ActiveQuery']->orderBy;
            //     }
            //     if (isset($filterSrh['Services'])) {
            //         $conditionArr['Services'] = end($filterSrh['Services']);
            //     }
            // }
            // if (in_array('User', $categorylist) || $criteriaType == 5) {
            //     $peoQuery = self::peopleSearch($searchKey, $searchSort, $filterSrh, $smartSrh, 1);
            //     $queryArr['User'] = $peoQuery['ActiveQuery'];
            //     if ($criteriaType == 4) {
            //         $groupBy = $peoQuery['ActiveQuery']->groupBy;
            //         $orderBy = $peoQuery['ActiveQuery']->orderBy;
            //     }
            // }
            // $catArr = [2 => 'Supplier', 3 => 'Product', 4 => 'Services', 5 => 'User'];
            // $selArr = [2 => 'supplier.*', 3 => 'product.*', 4 => 'services.*', 5 => 'user.*'];
            // if ($filtercomcnt == 1) {
            //     $currentCategory = $catArr[$criteriaType];
            //     $finalQuery->from([$currentCategory => "(" . $queryArr[$currentCategory]->createCommand()->getRawSql() . ")"]);
            //     if ($currentCategory != $categorylist[0]) {
            //         $finalQuery->innerJoin([$categorylist[0] => "(" . $queryArr[$categorylist[0]]->createCommand()->getRawSql() . ")"], "{$currentCategory}.joinCompPk={$categorylist[0]}.joinCompPk");
            //         $finalQuery->groupBy = $groupBy;
            //         $finalQuery->orderBy = $orderBy;
            //     }
            //     $finalQuery->select($selArr[$criteriaType]);
            // } else {
            //     $currentCategory = $catArr[$criteriaType];
            //     if (!in_array('Supplier', $categorylist) && $currentCategory == 'Supplier')
            //         $categorylist[] .= 'Supplier';
            //     array_pop($conditionArr);
            //     $isOrCondition = false;
            //     if (in_array(2, $conditionArr)) {
            //         $isOrCondition = true;
            //     }
            //     if ($isOrCondition) {
            //         $currentCategory = $catArr[$criteriaType];
            //         $queryArrTemp = $queryArr;
            //         $previousJoin = '';
            //         $JoinConditionArr = ['Supplier' => 'MemberCompMst_Pk', 'Product' => 'MCPrD_MemberCompMst_Fk', 'Services' => 'MCSvD_MemberCompMst_Fk', 5 => 'user.*'];
            //         $GroupByArr = ['Supplier' => 'MemberCompMst_Pk', 'Product' => 'MemCompProdDtls_Pk', 'Services' => 'MemCompServDtls_Pk'];
            //         $OrderByArr = ['Supplier' => 'MCM_CompanyName', 'Product' => 'MCPrD_DisplayName', 'Services' => 'MCSvD_DisplayName'];
            //         $nextConditionRel = 1;
            //         foreach ($categorylist as  $catkey => $category) {
            //             $where = '';
            //             $isSelectEdit=false;
            //             if ($currentCategory == $category) {
            //                 $isSelectEdit=true;
            //                 $finalQuery->select = $queryArrTemp[$category]->select;
            //                 $finalQuery->groupBy = [$GroupByArr[$category]];
            //                 if ($searchSort == 'Desc') {
            //                     $finalQuery->orderBy([$OrderByArr[$category] => SORT_DESC]);
            //                 } else {
            //                     $finalQuery->orderBy([$OrderByArr[$category] => SORT_ASC]);
            //                 }
            //             }
            //             if ($category == 'Supplier') {
            //                 $queryArrTemp[$category]->select = ['*'];
            //                 $queryArrTemp[$category]->groupBy = ['MemberCompMst_Pk'];
            //                 $queryArrTemp[$category]->orderBy = ['MCM_CompanyName' => 4];
            //                 $where = $queryArrTemp[$category]->where[2];
            //                 unset($queryArrTemp[$category]->where[2]);
            //                 if($isSelectEdit)
            //                     $finalQuery->select[12] = "IFNULL({$category}.mcpsfd_status, 0) AS isFav";
            //             } elseif ($category == 'Product') {
            //                 $queryArrTemp[$category]->select = ['*'];
            //                 $queryArrTemp[$category]->groupBy = '';
            //                 $queryArrTemp[$category]->from['produnion']->groupBy = '';
            //                 $queryArrTemp[$category]->orderBy = '';
            //                 $queryArrTemp[$category]->from['produnion']->union[0]['query']->groupBy = '';
            //                 $where = $queryArrTemp[$category]->from['produnion']->where[4];
            //                 unset($queryArrTemp[$category]->from['produnion']->where[4]);
            //                 unset($queryArrTemp[$category]->from['produnion']->union[0]['query']->where[2]);
            //                 if($isSelectEdit)
            //                     $finalQuery->select[15] = "IFNULL({$category}.mcpsfd_status, 0) AS followStatus";
            //             } elseif ($category == 'Services') {
            //                 $queryArrTemp[$category]->select = ['*'];
            //                 $queryArrTemp[$category]->from['servunion']->groupBy = '';
            //                 $queryArrTemp[$category]->orderBy = '';
            //                 $queryArrTemp[$category]->from['servunion']->union[0]['query']->groupBy = '';
            //                 $where = $queryArrTemp[$category]->from['servunion']->where[5];
            //                 unset($queryArrTemp[$category]->from['servunion']->where[5]);
            //                 unset($queryArrTemp[$category]->from['servunion']->union[0]['query']->where[2]);
            //                 if($isSelectEdit)
            //                     $finalQuery->select[20] = "IFNULL({$category}.mcpsfd_status, 0) AS followStatus";
            //             }
            //             // $virtualTable[$category] = $queryArrTemp[$category]->createCommand()->getRawSql();
            //             $whereArr[$category]['where'] = $where;
            //             $whereArr[$category]['condition'] = $conditionArr[$category];
            //             if (empty($finalQuery->from)) {
            //                 $finalQuery->from([$category => "(" . $queryArrTemp[$category]->createCommand()->getRawSql() . ")"]);
            //                 $finalQuery->andWhere($where);
            //                 $previousJoin = $category;
            //                 $nextConditionRel = $conditionArr[$category];
            //             } else {
            //                 if (key($finalQuery->from) != $currentCategory) {
            //                     $finalQuery->leftJoin([key($finalQuery->from) => "(" . $finalQuery->from[key($finalQuery->from)] . ")"], "{$JoinConditionArr[$previousJoin]}={$JoinConditionArr[$category]}");
            //                     $finalQuery->from([$category => "(" . $queryArrTemp[$category]->createCommand()->getRawSql() . ")"]);
            //                 } else {
            //                     $finalQuery->leftJoin([$category => "(" . $queryArrTemp[$category]->createCommand()->getRawSql() . ")"], "{$JoinConditionArr[$previousJoin]}={$JoinConditionArr[$category]}");
            //                 }
            //                 if ($nextConditionRel == 2)
            //                     $finalQuery->orWhere($where);
            //                 else
            //                     $finalQuery->andWhere($where);

            //                 $nextConditionRel = $conditionArr[$category];
            //             }
            //         }
            //         if (count($categorylist) > 2) {
            //             $conditionOprArr = [1 => 'AND', 2 => 'OR'];
            //             $whereArr = array_values($whereArr);
            //             $wArr = [$conditionOprArr[$whereArr[0]['condition']], $whereArr[0]['where'], [$conditionOprArr[$whereArr[1]['condition']], $whereArr[1]['where'], $whereArr[2]['where']]];
            //             $finalQuery->where = $wArr;
            //         }
            //          echo '<pre>';
            //          print_r($finalQuery->select);
            //          exit;
            //     } else {
            //         foreach ($categorylist as  $catkey => $category) {
            //             if ($currentCategory == $category) {
            //                 $finalQuery->from([$currentCategory => "(" . $queryArr[$currentCategory]->createCommand()->getRawSql() . ")"]);
            //                 $finalQuery->groupBy = $groupBy;
            //                 $finalQuery->orderBy = $orderBy;
            //             } else {
            //                 $finalQuery->innerJoin([$category => "(" . $queryArr[$category]->createCommand()->getRawSql() . ")"], "{$currentCategory}.joinCompPk={$category}.joinCompPk");
            //             }
            //         }
            //         $finalQuery->select($selArr[$criteriaType]);
            //     }
            // }
        }
        //print_r("expression");die();
        if (isset($_REQUEST['isquery'])) {

            echo '<pre>';
            print_r($finalQuery->createCommand()->getRawSql());
            exit;
        }
        //print_r("ISQuery");die();
        return $finalQuery;
    }

    public function b2bsearchtarget($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh = '', $smartSrh = '')
    {
		
        if (empty($filterSrh)) { 
            switch ($criteriaType) {
                case '2': // Supplier
                    $finalQuery = self::supplierTargetSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '3': // Product()
                    $finalQuery = self::productSearch($criteriaType,$searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '4': // Service
                    $finalQuery = self::serviceSearch($criteriaType,$searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '5': // People
                    $finalQuery = self::peopleSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
            }
        } else {
             
            $finalQuery=Querybuildertarget::combinationFilterSrc($searchKey, $searchSort, $filterSrh, $smartSrh, $criteriaType);
            
        }
        if (isset($_REQUEST['isquery'])) {

            echo '<pre>';
            print_r($finalQuery->createCommand()->getRawSql());
            exit;
        }
        //print_r("ISQuery");die();
        return $finalQuery;
    }

    public static function peopleSearch($searchKey, $searchSort, $filterSrh = '', $smartSrh = '', $withFilterCondtion = Null)
    {

        $searchKeyArr = [];
        if (!empty($filterSrh)) {
            foreach ($filterSrh as $fskey => $filterType) {
                if (is_array($filterType)) {
                    if ($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal) {
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);

        $smartFilter = [];
        if (!empty($smartSrh)) {
            $smartFilter['country'] = $smartSrh->country;
            $smartFilter['designationLevel'] = $smartSrh->designationLvl;
        }

        $userSearchQuery = UsermstTbl::find()
            ->select([
                'UserMst_Pk as userPk',
                'mcfd.mcfd_origfilename as userImage',
                'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ") as fullName',
                'um.um_firstname as firstName',
                'um.um_middlename as middleName',
                'um.um_lastname as lastName',
                'dsg.dsg_designationname as designation',
                'um.UM_EmpId as employeeId',
                'um_userdp as udp',
                'MemberCompMst_Pk as joinCompPk',
                'MemberCompMst_Pk as compid',
                // 'group_concat(DISTINCT dm.DM_Name) as departmentName',
                'um.um_primobnocc as mobileCountryCode',
                'trim(concat(CyM_CountryDialCode," ",um.um_primobno)) as mobileNo',
                'um.UM_EmailID as emailId',
                // 'group_concat(DISTINCT mcsd.mcsd_businessunitrefname)  as businessUnit',
                // '(case um.UM_Status when "A" then "Active" when "I" then "InActive" end) as status',
                'mcuf.mcpsfd_status as isFav',
                new Expression("$userpk as luid")
            ])
            ->from('usermst_tbl um')
            ->innerJoin('memberregistrationmst_tbl mrm', 'mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
            ->innerJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
            ->innerJoin('userpermtrn_tbl up', 'UserMst_Pk = UPT_UserMst_Fk')
            ->leftJoin('memcompfiledtls_tbl mcfd', ' mcfd.memcompfiledtls_pk = um.um_userdp')
            ->leftJoin('designationmst_tbl dsg', 'dsg.designationmst_pk = UM_Designation')
            ->leftJoin('designationlevelmst_tbl dlm', 'dlm.designationlevelmst_pk = um.um_desiglevel')
            ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', 'um.UserMst_Pk = mcuf.mcpsfd_shared_fk and mcpsfd_followtype = 5 and mcpsfd_type = 10 and mcpsfd_usermst_fk=' . $userpk);
        $joinArrLst['suppliername'] = 1;
        $joinArrLst['desiglevel'] = 1;
        $userSearchQuery->where([
            'mrm_stkholdertypmst_fk' => '6',
            'MRM_MemberStatus' => 'A',
            'MRM_ValSubStatus' => 'A',
            'UM_Status' => 'A',
            'um_emailconfirmstatus' => '1',
            'upt_basemodulemst_fk' => '54' //jsearch access
        ]);

        if (!empty($searchKey)) {
            $joinArrLst['usector'] = 1;
            $joinArrLst['designation'] = 1;
            $joinArrLst['department'] = 1;
            $userSearchQuery->leftJoin('departmentmst_tbl dm', 'find_in_set(dm.DepartmentMst_Pk, um.um_departmentmst_fk)')
                //->leftJoin('designationmst_tbl dsg', 'dsg.designationmst_pk = um.UM_Designation')
                ->leftJoin('memcompsectordtls_tbl mcsd', 'find_in_set(MemCompSecDtls_Pk, um_busunit)')
                ->leftJoin('sectormst_tbl sm', 'sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');
        }

        if (isset($smartFilter['country']) && !empty($smartFilter['country'])) {
            //$joinArrLst['country'] = 1;
            //$userSearchQuery->leftJoin('memcompmplocationdtls_tbl', 'um_address = memcompmplocationdtls_pk')
            $userSearchQuery->andWhere(['in', 'MCM_Source_CountryMst_Fk', $smartFilter['country']]);
        }

        if (isset($smartFilter['designationLevel']) && !empty($smartFilter['designationLevel'])) {
            $userSearchQuery->andWhere(['in', 'um.um_desiglevel', $smartFilter['designationLevel']]);
        }

        if (!empty($searchKey)) {
            $userSearchQuery->andWhere([
                'OR',
                ['OR LIKE', 'um_userrefno', $searchKey],
                ['OR LIKE', 'UM_EmpId', $searchKey],
                ['OR LIKE', 'um_division', $searchKey],
                ['OR LIKE', 'dsg.dsg_designationname', $searchKey],
                ['OR LIKE', 'um_desiglevel', $searchKey],
                ['OR LIKE', 'dm.DM_Name', $searchKey],
                ['OR LIKE', 'um_gender', $searchKey],
                ['OR LIKE', 'um_dob', $searchKey],
                ['OR LIKE', 'UM_EmailID', $searchKey],
                ['OR LIKE', 'um_primobno', $searchKey],
                ['OR LIKE', 'um_landlineno', $searchKey],
                ['OR LIKE', 'um_socialmedia', $searchKey],
                ['OR LIKE', 'UM_ExternalLink', $searchKey],
                ['OR LIKE', 'um_busunit', $searchKey],
                ['OR LIKE', 'dlm.dlm_desglevelname', $searchKey],
                ['OR LIKE', 'mcsd.mcsd_businessunitrefname', $searchKey],
                ['OR LIKE', 'sm.SecM_SectorName', $searchKey],
                ['OR LIKE', 'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")', $searchKey],
            ]);
        }

        $advanceFilterData = json_decode(json_encode($filterSrh), true);
        if (!empty($advanceFilterData['User'])) {
            $queryObject = new UserFilterQueryGen($advanceFilterData['User'], $joinArrLst);
            $query = $queryObject->getQuery();
            if (!empty($query['where']))
                $userSearchQuery->andWhere($query['where']);
            if (!empty($query['join'])) {
                $userSearchQuery->join = array_merge($userSearchQuery->join, $query['join']);
            }
        }



        if ($searchSort == 'Desc') {
            $userSearchQuery->orderBy(['um_firstname' => SORT_DESC]);
        } else {
            $userSearchQuery->orderBy(['um_firstname' => SORT_ASC]);
        }
        $userSearchQuery->groupBy('UserMst_Pk');
        $userSearchQueryResult = $userSearchQuery->asArray();
        if (is_null($withFilterCondtion)) {
            return $userSearchQueryResult;
        } else {
            $query['ActiveQuery'] = $userSearchQueryResult;
            $query['FilterCondition'] = $query;
            return $query;
        }
    }

    public static function supplierTargetSearch($searchKey, $searchSort, $filterSrh, $smartSrh = '', $withFilterCondtion = Null)
    {

       
        
        $searchKeyArr = [];

        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);

        $smartFilter = [];
        if (!empty($smartSrh)) {
            $smartFilter['jsrsStat'] = $smartSrh->jsrsStat;
            $smartFilter['classification'] = $smartSrh->classification;
            $smartFilter['splStatus'] = $smartSrh->splStatus;
            $smartFilter['country'] = $smartSrh->country;
        }
        $supplierQuery = MembercompanymstTbl::find()
            ->select([
                'MemberCompMst_Pk as comppk',
                'MemberCompMst_Pk as joinCompPk',
                'MCM_MemberRegMst_Fk as regpk',
                'MCM_CompanyName as companyName',
                'mcm_complogo_memcompfiledtlsfk as logoid',
                'MCM_Origin as orgin',
                'MCM_Source_CountryMst_Fk as sCountryId',
                'CyM_CountryName_en as country',
                "case when `MCM_Origin`='I' then 'International' else ClM_ClassificationType end as compClass",
                'mcm_externalproflink as extkey',
                'MCM_SupplierCode as scode',
                'mcm_accexpirydate as expdate',
                'if(mcm_accexpirydate >= current_date(),1,0) as comsts',
                'ifnull(mcuf.mcpsfd_status,0) as isFav'

            ])
            ->innerJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk=MemberRegMst_Pk')
            ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk=ClassificationMst_Pk')
            ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk=CountryMst_Pk')
            // ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk=MemberRegMst_Pk')
            ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', "MemberCompMst_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 1 and mcuf.mcpsfd_type = 1 and mcpsfd_usermst_fk={$userpk}")
            ->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                
            ]);  
        
           
        if (isset($smartFilter['classification']) && !empty($smartFilter['classification'])) {
            if (in_array('International', $smartFilter['classification'])) {
                $clsarr = array_diff($smartFilter['classification'], ['International']);
                $supplierQuery->andWhere(['or', ['in', 'ClM_ClassificationType', $clsarr], ['=', 'MCM_Origin', 'I']]);
            } else {
                $supplierQuery->andWhere(['in', 'ClM_ClassificationType', $smartFilter['classification']]);
            }
        }

        if (isset($smartFilter['splStatus']) && !empty($smartFilter['splStatus'])) {
            $supplierQuery->andWhere(['in', 'mclch_lcctype', $smartFilter['splStatus']]);
        }

        if (isset($smartFilter['country']) && !empty($smartFilter['country'])) {
            $supplierQuery->andWhere(['in', 'MCM_Source_CountryMst_Fk', $smartFilter['country']]);
        }

        if (!empty($searchKey)) {
            $supplierQuery->andWhere([
                'OR',
                ['OR LIKE', 'MCM_CompanyName', $searchKey],
                ['OR LIKE', 'MCM_SupplierCode', $searchKey],
                ['OR LIKE', 'CyM_CountryName_en', $searchKey]
            ]);
        }
       

        $supplierQuery->groupBy('comppk');

        if (isset($smartFilter['jsrsStat']) && !empty($smartFilter['jsrsStat'])) {
            if (in_array('A', $smartFilter['jsrsStat']) && in_array('E', $smartFilter['jsrsStat'])) {
            } elseif (in_array('A', $smartFilter['jsrsStat'])) {
                $supplierQuery->having('comsts = 1');
            } elseif (in_array('E', $smartFilter['jsrsStat'])) {
                $supplierQuery->having('comsts = 0');
            }
        }
        if ($searchSort == 'Desc') {
            $supplierQuery->orderBy(['companyName' => SORT_DESC]);
        } else {
            $supplierQuery->orderBy(['companyName' => SORT_ASC]);
        }
        $advanceFilterData = json_decode(json_encode($filterSrh), true);
        if (!empty($advanceFilterData['Supplier'])) {
            $queryObject = new SupplierFilterQueryGen($advanceFilterData['Supplier']);
            $query = $queryObject->getQuery();
            if (!empty($query['where'])) {                
                $supplierQuery->andWhere($query['where']);
                $supplierQuery->andWhere(['or', ['is', 'MRM_RenewalStatus', NULL], ['=', 'MRM_RenewalStatus', 'GE']]);
            }
               
            if (!empty($query['join'])) {
                $supplierQuery->join = array_merge($supplierQuery->join, $query['join']);
            }
        }
        $supplierQuery->asArray();
        // if(isset($_REQUEST['isquery'])){
        //     echo'<pre>';print_r($supplierQuery->createCommand()->getRawSql());exit;
        // }
        if (is_null($withFilterCondtion)) {
            return $supplierQuery;
        } else {
            $query['ActiveQuery'] = $supplierQuery;
            $query['FilterCondition'] = $query;
            return $query;
        }
    }

    public static function supplierSearch($searchKey, $searchSort, $filterSrh, $smartSrh = '', $withFilterCondtion = Null)
    {
        
        $searchKeyArr = [];

        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $stk_type = \yii\db\ActiveRecord::getTokenData('reg_type',true);
        $companyCountry =  \yii\db\ActiveRecord::getTokenData('MCM_Source_CountryMst_Fk',true);

        $smartFilter = [];
        if($stk_type == 8)
        {
            $premiumpack = Yii::$app->db->createCommand("SELECT gcpd_currpackagetype from gcpremiumdtls_tbl where gcpd_memberregmst_fk =".$regPK)->queryOne();

            if($premiumpack)
            {
                if($premiumpack['gcpd_currpackagetype'] == 2)
                    $country = ['31',$companyCountry];
                elseif($premiumpack['gcpd_currpackagetype'] == 3)
                    $country = ['31',$companyCountry,'91','108','121','124','134'];
            }
            $smartFilter['country'] = $country;
            
           if (!empty($smartSrh)) {
                $smartFilter['jsrsStat'] = $smartSrh->jsrsStat;
                $smartFilter['classification'] = $smartSrh->classification;
                $smartFilter['splStatus'] = $smartSrh->splStatus;
            }
            if($smartSrh->country)
            {
                 $smartFilter['country'] = $smartSrh->country;
            }
        }
        else
        {
            if (!empty($smartSrh)) {
                $smartFilter['jsrsStat'] = $smartSrh->jsrsStat;
                $smartFilter['classification'] = $smartSrh->classification;
                $smartFilter['splStatus'] = $smartSrh->splStatus;
                $smartFilter['country'] = $smartSrh->country;
            }
        }
        
        $supplierQuery = MembercompanymstTbl::find()
            ->select([
                'MemberCompMst_Pk as comppk',
                'MemberCompMst_Pk as joinCompPk',
                'MCM_MemberRegMst_Fk as regpk',
                'MCM_CompanyName as companyName',
                'mcm_complogo_memcompfiledtlsfk as logoid',
                'MCM_Origin as orgin',
                'MCM_Source_CountryMst_Fk as sCountryId',
                'CyM_CountryName_en as country',
                "case when `MCM_Origin`='I' then 'International' else ClM_ClassificationType end as compClass",
                'mcm_externalproflink as extkey',
                'MCM_SupplierCode as scode',
                'mcm_accexpirydate as expdate',
                'if(mcm_accexpirydate >= current_date(),1,0) as comsts',
                'ifnull(mcuf.mcpsfd_status,0) as isFav'

            ])
            ->innerJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk=MemberRegMst_Pk')
            ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk=ClassificationMst_Pk')
            ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk=CountryMst_Pk')
            // ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk=MemberRegMst_Pk')
            ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
            ->leftJoin('incorpstylemst_tbl', 'mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
            ->leftJoin('sectormst_tbl', 'mrm_compsector = SectorMst_Pk')
            ->leftJoin('memcompsectordtls_tbl', 'MemberCompMst_Pk=MCSD_MemberCompMst_Fk')
            ->leftJoin('businesssourcemst_tbl', 'mrm_businsrc = businesssourcemst_pk')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', "MemberCompMst_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 1 and mcuf.mcpsfd_type = 1 and mcpsfd_usermst_fk={$userpk}");
            if($stk_type == 8)
            {
            $supplierQuery->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
            ]);
            }
            else
            {
             $supplierQuery->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A'
            ]);
            }

            
           
        if (isset($smartFilter['classification']) && !empty($smartFilter['classification'])) {
            if (in_array('International', $smartFilter['classification'])) {
                $clsarr = array_diff($smartFilter['classification'], ['International']);
                $supplierQuery->andWhere(['or', ['in', 'ClM_ClassificationType', $clsarr], ['=', 'MCM_Origin', 'I']]);
            } else {
                $supplierQuery->andWhere(['in', 'ClM_ClassificationType', $smartFilter['classification']]);
            }
        }

        if (isset($smartFilter['splStatus']) && !empty($smartFilter['splStatus'])) {
            $supplierQuery->andWhere(['in', 'mclch_lcctype', $smartFilter['splStatus']]);
        }

        if (isset($smartFilter['country']) && !empty($smartFilter['country'])) {
            $supplierQuery->andWhere(['in', 'MCM_Source_CountryMst_Fk', $smartFilter['country']]);
        }

        if (!empty($searchKey)) {
            $flag = false;
            foreach ($searchKey as $key => $value) {
                if (strpos('active', strtolower($value)) !== false) {
                   
                    $supplierQuery->having('comsts = 1');
                    $flag = true;
                }
                if(strpos('expired', strtolower($value)) !== false) {
                    //print_r('expired');die;
                    $supplierQuery->having('comsts = 0');
                    $flag = true;
                } 
            }

            if(!$flag) {
                $supplierQuery->andWhere([
                    'OR',
                    ['OR LIKE', 'MCM_CompanyName', $searchKey],
                    ['OR LIKE', 'MCM_SupplierCode', $searchKey],
                    ['OR LIKE', 'CyM_CountryName_en', $searchKey],
                    ['OR LIKE', 'ClM_ClassificationType', $searchKey],
                    ['OR LIKE', 'ISM_IncorpStyleEntity', $searchKey],


                    ['OR LIKE', 'mcsd_businessunitrefname', $searchKey],
                    ['OR LIKE', 'SecM_SectorName', $searchKey],
                    ['OR LIKE', 'bsm_bussrcname', $searchKey],
                    
                    
                ]);
            }

            
            
        }
       

        $supplierQuery->groupBy('comppk');

        if (isset($smartFilter['jsrsStat']) && !empty($smartFilter['jsrsStat'])) {
            if (in_array('A', $smartFilter['jsrsStat']) && in_array('E', $smartFilter['jsrsStat'])) {
            } elseif (in_array('A', $smartFilter['jsrsStat'])) {
                $supplierQuery->having('comsts = 1');
            } elseif (in_array('E', $smartFilter['jsrsStat'])) {
                $supplierQuery->having('comsts = 0');
            }
        }
        if ($searchSort == 'Desc') {
            $supplierQuery->orderBy(['companyName' => SORT_DESC]);
        } else {
            $supplierQuery->orderBy(['companyName' => SORT_ASC]);
        }
        $advanceFilterData = json_decode(json_encode($filterSrh), true);
        //print_r($advanceFilterData);die();
        if (!empty($advanceFilterData['Supplier'])) {
            $queryObject = new SupplierFilterQueryGen($advanceFilterData['Supplier']);
            $query = $queryObject->getQuery();
            if (!empty($query['where']))
                $supplierQuery->andWhere($query['where']);
            if (!empty($query['join'])) {
                $supplierQuery->join = array_merge($supplierQuery->join, $query['join']);
            }
        }
        $supplierQuery->asArray();
        // if(isset($_REQUEST['isquery'])){
        //     echo'<pre>';print_r($supplierQuery->createCommand()->getRawSql());exit;
        // }
        if (is_null($withFilterCondtion)) {
            return $supplierQuery;
        } else {
            $query['ActiveQuery'] = $supplierQuery;
            $query['FilterCondition'] = $query;
            return $query;
        }
    }



    public static function productSearch($searchType,$searchKey, $searchSort, $filterSrh = '', $smartSrh = '', $withFilterCondtion = Null)
    {   
        $searchKeyArr = [];
        $isFilter = false;
        if (!empty($searchKey)) {
            $isFilter = true;
        }
        if (!empty($filterSrh)) {
            $isFilter = true;
            foreach ($filterSrh as $fskey => $filterType) {
                if (is_array($filterType)) {
                    if ($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal) {
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $smartFilter = [];
        
        if (!empty($smartSrh)) {
            $isFilter = true;
            $smartFilter['pdtDivision'] = $smartSrh->division;
            $smartFilter['pdtBSource'] = $smartSrh->bSource;
            $smartFilter['jsrsStatus'] = $smartSrh->jsrsStatus;
            $smartFilter['sezdStatus'] = $smartSrh->sezdStatus;
            $smartFilter['olngPrequalified'] = $smartSrh->olngPrequalified;
            $smartFilter['pdtRating'] = $smartSrh->pdtRating;
            $smartFilter['nationalPdt'] = $smartSrh->nationalPdt;
        }
       
        if (!empty($searchKey)) {
           
            $divSector = "group_concat(distinct `mcsd_businessunitrefname`) as division";
            $divSector1 = "group_concat(distinct `SecM_SectorName`) as sectorname";

            $divSectorColumn = "`mcsd_businessunitrefname`";
            $divSectorColumn1  = "`SecM_SectorName`";

            $divSectorAlias = "`mcsd_businessunitrefname` as division";
            $divSectorAlias1 = "`SecM_SectorName` as sectorname";
        }

        $appexp = new Expression("'A' as productStatus");
        $notappexp = new Expression("'D' as productStatus");
        $tempexp = new Expression("'T' as pFrom");
        $mainexp = new Expression("'M' as pFrom");

        $tempSelectArr = [
            'pFrom',
            'MemCompProdDtls_Pk as pdtPk',
            'MCPrD_MemberCompMst_Fk as compk',
            'MCPrD_MemberCompMst_Fk as joinCompPk',
            'MCPrD_DisplayName as displayName',
            'mcfd_uploadedby as uupk',
            'memcompfiledtls_pk as imagePK',
            'mcprd_prodmodelno as pdtRefNo',
            'mcprd_prodrefno as pdtModelNo',
            'productStatus',
            'MCPrD_ProdDesc as pdtDesc',
            'MCPrD_NationalProdStatus as nationalPdt',
            'PrdM_ProductCode as productCode',
            'PrdM_ProductName as productName',
            'mcor_overallrating as overAllRating',
            'ifnull(mcpsfd_status,0) as followStatus',
            'mcprd_sezadstatus as sezdsts'
        ];

        $tempQuerySelectArr = [
            $tempexp,
            'MemCompProdDtls_Pk',
            'MCPrD_MemberCompMst_Fk',
            'MCPrD_DisplayName',
            'mcfd_uploadedby',
            'memcompfiledtls_pk',
            'mcprd_prodmodelno',
            'mcprd_prodrefno',
            $notappexp,
            'MCPrD_ProdDesc',
            'MCPrD_NationalProdStatus',
            'pm.PrdM_ProductCode',
            'pm.PrdM_ProductName',
            'mcor_overallrating',
            'mcuf.mcpsfd_status',
            'mcprd_sezadstatus'
        ];

        $mainSelectArr = [
            $mainexp,
            'mcprdm_memcompproddtls_fk as pdtPk',
            'mcprdm_membercompmst_fk as compk',
            'mcprdm_displayname as displayName',
            'mcfd_uploadedby as uupk',
            'memcompfiledtls_pk as imagePK',
            'mcprdm_prodmodelno as pdtRefNo',
            'mcprdm_prodrefno as pdtModelNo',
            $appexp,
            'mcprdm_proddesc as pdtDesc',
            'mcprdm_nationalprodstatus as nationalPdt',
            'pm.PrdM_ProductCode as productCode',
            'pm.PrdM_ProductName as productName',
            'mcor_overallrating as overAllRating',
            'ifnull(mcuf.mcpsfd_status,0) as followStatus',
            'mcprdm_sezadstatus as sezdsts'
        ];

        if ($isFilter) {
            $tempSelectArr = [
                'pFrom',
                'MemCompProdDtls_Pk as pdtPk',
                'MCPrD_MemberCompMst_Fk as compk',
                'MCPrD_MemberCompMst_Fk as joinCompPk',
                'MCPrD_DisplayName as displayName',
                'mcfd_uploadedby as uupk',
                'memcompfiledtls_pk as imagePK',
                'mcprd_prodmodelno as pdtRefNo',
                'mcprd_prodrefno as pdtModelNo',
                'productStatus',
                'MCPrD_ProdDesc as pdtDesc',
                'MCPrD_NationalProdStatus as nationalPdt',
                'PrdM_ProductCode as productCode',
                'PrdM_ProductName as productName',
                'mcor_overallrating as overAllRating',
                'ifnull(mcpsfd_status,0) as followStatus',
                'group_concat(distinct bsm_bussrcname) as businessSource',
                'bicpm_productcode as bgiUnpscCode',
                'MCPrD_SearchKeyword as keywords',
                'mcprd_sezadstatus as sezdsts'
            ];

            if(isset($divSector)) {
                array_push($tempSelectArr,$divSector);
                array_push($tempSelectArr,$divSector1);
            }

            $tempQuerySelectArr = [
                $tempexp,
                'MemCompProdDtls_Pk',
                'MCPrD_MemberCompMst_Fk',
                'MCPrD_MemberCompMst_Fk',
                'MCPrD_DisplayName',
                'mcfd_uploadedby',
                'memcompfiledtls_pk',
                'mcprd_prodmodelno',
                'mcprd_prodrefno',
                $notappexp,
                'MCPrD_ProdDesc',
                'MCPrD_NationalProdStatus',
                'pm.PrdM_ProductCode',
                'pm.PrdM_ProductName',
                'mcor_overallrating',
                'mcuf.mcpsfd_status',
                'bsm.bsm_bussrcname',
                'bicpm_productcode',
                'MCPrD_SearchKeyword',
                'mcprd_sezadstatus',
                'businesssourcemst_pk',
                'mcprd_bgiindcodecateg_fk',
                'mcprd_bgiindcodesubcateg_fk',
                'mcprd_bgiinduscodeprodmst_fk',
                'mcprd_productmst_fk',
                'MCPrD_SVFAdminApprovalStatus',
                'MCPrD_CreatedOn'
            ];

            if(isset($divSectorColumn)) {
                array_push($tempQuerySelectArr,$divSectorColumn);
                array_push($tempQuerySelectArr,$divSectorColumn1);
                
            }
            $mainSelectArr = [
                $mainexp,
                'mcprdm_memcompproddtls_fk as pdtPk',
                'mcprdm_membercompmst_fk as compk',
                'mcprdm_displayname as displayName',
                'mcfd_uploadedby as uupk',
                'memcompfiledtls_pk as imagePK',
                'mcprdm_prodmodelno as pdtRefNo',
                'mcprdm_prodrefno as pdtModelNo',
                $appexp,
                'mcprdm_proddesc as pdtDesc',
                'mcprdm_nationalprodstatus as nationalPdt',
                'pm.PrdM_ProductCode as productCode',
                'pm.PrdM_ProductName as productName',
                'mcor_overallrating as overAllRating',
                'ifnull(mcuf.mcpsfd_status,0) as followStatus',
                'bsm.bsm_bussrcname as businessSource',
                'bicpm_productcode as bgiUnpscCode',
                'mcprdm_searchkeyword as keywords',
                'mcprdm_sezadstatus as sezdsts',
                'businesssourcemst_pk',
                'mcprdm_bgiindcodecateg_fk',
                'mcprdm_bgiindcodesubcateg_fk',
                'mcprdm_bgiinduscodeprodmst_fk',
                'mcprdm_productmst_fk',
                new Expression("'A' as MCPrD_SVFAdminApprovalStatus"),
                'mcprdm_prodviewcount'

            ];
            if(isset($divSectorAlias)) {
                array_push($mainSelectArr,$divSectorAlias);
                array_push($mainSelectArr,$divSectorAlias1);
            }
        }
        $productUnionSelectArr = $tempSelectArr;

        $tempProductSearchQuery = MemcompproddtlsTbl::find()
            ->select($tempQuerySelectArr)
            ->from('memcompproddtls_tbl as mcprd')

            ->leftJoin('ProductMst_tbl', 'productmst_pk = MCPrD_ProductMst_Fk')
            ->leftJoin('membercompanymst_tbl as mcm', 'mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
            ->leftJoin('memcompproddtlsmain_tbl as mcprdm', 'MemCompProdDtls_Pk = mcprdm_memcompproddtls_fk')
            ->leftJoin('memberregistrationmst_tbl as mrm', ' mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
            ->leftJoin('memcompfiledtls_tbl as mcfd', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
            ->leftJoin('productmst_tbl as pm', 'pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', "mcprd.MemCompProdDtls_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 2 and mcuf.mcpsfd_type = 3 and mcpsfd_usermst_fk ={$userpk}")
            ->leftJoin('memcompoverallreview_tbl', 'MemCompProdDtls_Pk = mcor_shared_fk and mcor_type = 1');
        
        $mainProductSearchQuery = MemcompproddtlsmainTbl::find()
            ->select($mainSelectArr)
            ->from('memcompproddtlsmain_tbl as mcprdm')
            ->innerJoin('membercompanymst_tbl as mcm', 'mcm.MemberCompMst_Pk = mcprdm_membercompmst_fk')
            ->innerJoin('memberregistrationmst_tbl as mrm', ' mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
            // ->innerJoin('memcompproddtlsmain_tbl mcprdm', 'MemCompProdDtls_Pk = mcprdm_memcompproddtls_fk')
            ->leftJoin('ProductMst_tbl as pm', 'productmst_pk = mcprdm_productmst_fk')
            ->leftJoin('memcompfiledtls_tbl as mcfd', 'mcprdm_prodcoverimgfile=memcompfiledtls_pk')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', "mcprdm_memcompproddtls_fk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 2 and mcuf.mcpsfd_type = 3 and mcpsfd_usermst_fk={$userpk}")
            ->leftJoin('memcompoverallreview_tbl', 'mcprdm_memcompproddtls_fk = mcor_shared_fk and mcor_type = 1');

        $tempProductSearchQuery->where([
            'mrm_stkholdertypmst_fk' => '6',
            'MRM_MemberStatus' => 'A',
            'MRM_ValSubStatus' => 'A',
            'mcprd_isdeleted' => '2',
            'memcompproddtlsmain_pk' => null,
        ])->groupBy('MemCompProdDtls_Pk');


		if(isset($searchType) && $searchType == 3) {
            $tempProductSearchQuery->andWhere(['not', ['MemberCompMst_Pk' => $cmpPK]]);
        }
        
        $tempProductSearchQuery->andWhere(['not', ['MCPrD_CreatedOn' => null]]);
        $tempProductSearchQuery->andWhere(['or', ['not in', 'MCPrD_SVFAdminApprovalStatus', ['A']], ['is', 'MCPrD_SVFAdminApprovalStatus', null]]);

        $mainProductSearchQuery->where([
            'mrm_stkholdertypmst_fk' => '6',
            'MRM_MemberStatus' => 'A',
            'MRM_ValSubStatus' => 'A',
        ])->groupBy('mcprdm_memcompproddtls_fk');

		if(isset($searchType) && $searchType == 3) {
            $mainProductSearchQuery->andWhere(['not', ['MemberCompMst_Pk' => $cmpPK]]);
        }

        if ($isFilter || !empty($searchKey)) {
            $tempProductSearchQuery->leftJoin('bgiinduscodeprodmst_tbl', 'mcprd_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk')
                ->leftJoin('bgiindcodesubcateg_tbl', 'mcprd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
                ->leftJoin('bgiindcodecateg_tbl', 'mcprd_bgiindcodecateg_fk = bgiindcodecateg_pk')
                ->leftJoin('memcompprodbussrcmap_tbl mcpbsm', 'mcprd.MemCompProdDtls_Pk = mcpbsm_memcompproddtls_fk')
                ->leftJoin('memcompbussrcdtls_tbl as mcb', 'mcpbsm.mcpbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk')

                //->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                //->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')
                
                ->leftJoin('businesssourcemst_tbl as bsm', 'bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk');

            $mainProductSearchQuery->leftJoin('bgiinduscodeprodmst_tbl', 'mcprdm_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk')
                ->leftJoin('bgiindcodesubcateg_tbl', 'mcprdm_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
                ->leftJoin('bgiindcodecateg_tbl', 'mcprdm_bgiindcodecateg_fk = bgiindcodecateg_pk')
                ->leftJoin('memcompprodbussrcmapmain_tbl as mcpbsm', 'mcprdm_memcompproddtls_fk = mcpbsmm_memcompproddtls_fk')
                ->leftJoin('memcompbussrcdtlsmain_tbl as mcb', 'mcpbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk')

                //->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsdm_memcompsecdtls_fk')
                //->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')

                ->leftJoin('businesssourcemst_tbl bsm', 'mcbsdm_businesssourcemst_fk = businesssourcemst_pk');

            if(!empty($searchKey) && empty($smartFilter['pdtDivision'])) {

                $tempProductSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                ->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');

                $mainProductSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsdm_memcompsecdtls_fk')
                ->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');

            }    

            if ((isset($smartFilter['pdtDivision']) && !empty($smartFilter['pdtDivision']))) {

                $tempProductSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                    ->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');

                $tempProductSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['pdtDivision']]);

                $mainProductSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsdm_memcompsecdtls_fk')
                    ->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');
                $mainProductSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['pdtDivision']]);
            }
            if (isset($smartFilter['pdtBSource']) && !empty($smartFilter['pdtBSource'])) {

                $tempProductSearchQuery->andWhere(['in', 'bsm.businesssourcemst_pk', $smartFilter['pdtBSource']]);
                $mainProductSearchQuery->andWhere(['in', 'bsm.businesssourcemst_pk', $smartFilter['pdtBSource']]);
            }
        }
        if (!empty($filterSrh)) {
            $advanceFilterData = json_decode(json_encode($filterSrh), true);
            if (!empty($advanceFilterData['Product'])) {
                $queryObject = new ProductFilterQueryGen($advanceFilterData['Product'], 'T');
                $tempQuery = $queryObject->getQuery();
                if (!empty($tempQuery['where']))
                    $tempProductSearchQuery->andWhere($tempQuery['where']);
                if (!empty($tempQuery['join'])) {
                    $tempProductSearchQuery->join = array_merge($tempProductSearchQuery->join, $tempQuery['join']);
                }
                $MainqueryObject = new ProductFilterQueryGen($advanceFilterData['Product'], 'M');
                $mainQuery = $MainqueryObject->getQuery();
                if (!empty($mainQuery['where']))
                    $mainProductSearchQuery->andWhere($mainQuery['where']);
                if (!empty($mainQuery['join'])) {
                    $mainProductSearchQuery->join = array_merge($mainProductSearchQuery->join, $mainQuery['join']);
                }
            }
        }
        if (!empty($tempProductSearchQuery->join)) {

            $listOfTables = array_column($tempProductSearchQuery->join, 1, 1);
            if (in_array('memcompsectordtls_tbl as mcsd', $listOfTables) || in_array('memcompsectordtls_tbl', $listOfTables)) {
                $tempProductSearchQuery->select[] .= 'MemCompSecDtls_Pk';
                $tempProductSearchQuery->select[] .= 'SectorMst_Pk';
                //$tempProductSearchQuery->select[] .= 'SecM_SectorName';
                //Main table
                $mainProductSearchQuery->select[] .= 'MemCompSecDtls_Pk';
                $mainProductSearchQuery->select[] .= 'SectorMst_Pk';
                //$mainProductSearchQuery->select[] .= 'SecM_SectorName';
            }
        }

        $productSearchQuery = (new \yii\db\Query())
            ->from(['produnion' => $tempProductSearchQuery->union($mainProductSearchQuery, true)])
            ->orderBy(["displayName" => SORT_ASC]);

        $productSearchQuery->select($productUnionSelectArr);
        $productSearchQuery->groupBy('pdtPk');
        
        if (isset($smartFilter['jsrsStatus']) && !empty($smartFilter['jsrsStatus'])) {

            if(in_array('A', $smartFilter['jsrsStatus'])) {
                $str .= "`MCPrD_SVFAdminApprovalStatus` = 'A'";    
            }

            if(in_array('D', $smartFilter['jsrsStatus'])) {
               
                if(isset($str)){
                    $str .= ' OR ';
                }
                $str .= "`MCPrD_SVFAdminApprovalStatus` = 'D'";    
            }

            if(in_array('N', $smartFilter['jsrsStatus'])) {

                if(isset($str)){
                    $str .= ' OR ';
                }
                $str .= "(`MCPrD_SVFAdminApprovalStatus` = 'N' OR `MCPrD_SVFAdminApprovalStatus` = 'U')";
            }
            if(in_array('Y', $smartFilter['jsrsStatus'])) {

                if(isset($str)){
                    $str .= ' OR ';
                }
                $str .= "(`MCPrD_SVFAdminApprovalStatus` IS NULL AND `MCPrD_CreatedOn` IS NOT NULL)";

            }
            if(isset($str)) {
                $productSearchQuery->andWhere($str);
            }
        }

        if (isset($smartFilter['sezdStatus']) && !empty($smartFilter['sezdStatus'])) {
    
             if (in_array('A', $smartFilter['sezdStatus'])) {

                $sezdStatusString .= "`mcprd_sezadstatus` = 'A'"; 

            } if (in_array('D', $smartFilter['sezdStatus'])) {
                if(isset($sezdStatusString)){
                    $sezdStatusString .= ' OR ';
                }
                $sezdStatusString .= "`mcprd_sezadstatus` = 'D'"; 

            } if (in_array('N', $smartFilter['sezdStatus'])) {

                if(isset($sezdStatusString)){
                    $sezdStatusString .= ' OR ';
                }
                $sezdStatusString .= "`mcprd_sezadstatus` = 'N'";

            } if (in_array('Y', $smartFilter['sezdStatus'])) {

                if(isset($sezdStatusString)){
                    $sezdStatusString .= ' OR ';
                }
                $sezdStatusString .= "`mcprd_sezadstatus` IS NULL";
            }
            if(isset($sezdStatusString)) {
                $productSearchQuery->andWhere($sezdStatusString);
            }
        }

        // if (isset($smartFilter['olngPrequalified']) && !empty($smartFilter['olngPrequalified'])) {
        //     if (in_array('Y', $smartFilter['olngPrequalified']) && in_array('N', $smartFilter['olngPrequalified'])) {
        //     } elseif (in_array('Y', $smartFilter['olngPrequalified'])) {
        //         $productSearchQuery->andWhere(['MCPrD_NationalProdStatus' => 'Y']);
        //     } elseif (in_array('N', $smartFilter['olngPrequalified'])) {
        //         $productSearchQuery->andWhere(['MCPrD_NationalProdStatus' => null]);
        //     }
        // }

        if (isset($smartFilter['pdtRating']) && !empty($smartFilter['pdtRating'])) {
            $pdtRatingData = '';
            foreach ($smartFilter['pdtRating'] as $key => $pdtRating) {
                if ($pdtRatingData != '') {
                    $pdtRatingData .= ' OR ';
                }
                if (($pdtRating + 1) == 5) {
                    $pdtRat = 5;
                } else {
                    $pdtRat = ($pdtRating + 0.99);
                }
                $pdtRatingData .= '(mcor_overallrating BETWEEN ' . $pdtRating . ' AND ' . $pdtRat . ')';
            }
            $productSearchQuery->andWhere($pdtRatingData);
        }

        if (isset($smartFilter['nationalPdt']) && !empty($smartFilter['nationalPdt'])) {
            if (in_array('Y', $smartFilter['nationalPdt']) && in_array('N', $smartFilter['nationalPdt'])) {
            } elseif (in_array('Y', $smartFilter['nationalPdt'])) {
                $productSearchQuery->andWhere(['MCPrD_NationalProdStatus' => 'Y']);
            } elseif (in_array('N', $smartFilter['nationalPdt'])) {
                $productSearchQuery->andWhere(['MCPrD_NationalProdStatus' => null]);
            }
        }

        if (!empty($searchKey)) {

            // $flag = false;
            // foreach ($searchKey as $key => $value) {

            //     $str = str_replace(' ', '', $value);

            //     if (strpos('approved', strtolower($str)) !== false) {

            //        $productSearchQuery->orWhere(['productStatus' => 'A']);
            //        $flag = true;
            //     }
            //     if(strpos('notapproved', strtolower($str)) !== false) {
            //         $productSearchQuery->orWhere(['productStatus' => 'NA']);
            //         $flag = true;
            //     }  
            // }
            
            //if(!$flag) {
                $productSearchQuery->having([
                    'OR',
                    ['OR LIKE', 'displayName', $searchKey],
                    ['OR LIKE', 'pdtDesc', $searchKey],
                    ['OR LIKE', 'pdtRefNo', $searchKey],
                    ['OR LIKE', 'pdtModelNo', $searchKey],
                    ['OR LIKE', 'productCode', $searchKey],
                    ['OR LIKE', 'productName', $searchKey],
                    ['OR LIKE', 'businessSource', $searchKey],
                    ['OR LIKE', 'keywords', $searchKey],
                    ['OR LIKE', 'division', $searchKey],
                    ['OR LIKE', 'sectorname', $searchKey],
                ]);
            //} 
        }

        $finalFormation = '';

        if ($finalFormation != '') {
            $finalFormation .= ')';
            $productSearchQuery->andWhere($finalFormation);
        }

        if ($searchSort == 'Desc') {
            $productSearchQuery->orderBy(['displayName' => SORT_DESC]);
        } else {
            $productSearchQuery->orderBy(['displayName' => SORT_ASC]);
        }

        // $productSearchQueryResult = $productSearchQuery;
        // if(isset($_REQUEST['isquery'])){
        //    echo'<pre>';print_r($productSearchQuery->createCommand()->getRawSql());exit;
        // }
        //print_r(is_null($withFilterCondtion));die();

        if (is_null($withFilterCondtion)) {
            return $productSearchQuery;
        } else {
            $query['ActiveQuery'] = $productSearchQuery;
            $query['FilterCondition']['temp'] = $tempQuery;
            $query['FilterCondition']['main'] = $mainQuery;
            return $query;
        }
    }

    public static function serviceSearch($searchType,$searchKey, $searchSort, $filterSrh = '', $smartSrh = '', $withFilterCondtion = null)
    {
        
        $searchKeyArr = [];
        $isFilter = false;
        if (!empty($searchKey)) {
            $isFilter = true;
        }
        if (!empty($filterSrh)) {
            $isFilter = true;
            foreach ($filterSrh as $fskey => $filterType) {
                if (is_array($filterType)) {
                    if ($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal) {
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }

        if (!empty($searchKey)) {
           
            $divSector = "group_concat(distinct `mcsd_businessunitrefname`) as division";
            $divSector1 = "group_concat(distinct `SecM_SectorName`) as sectorname";

            $divSectorColumn = "`mcsd_businessunitrefname`";
            $divSectorColumn1  = "`SecM_SectorName`";

            $divSectorAlias = "`mcsd_businessunitrefname` as division";
            $divSectorAlias1 = "`SecM_SectorName` as sectorname";
        }

        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $smartFilter = [];
        if (!empty($smartSrh)) {
            $isFilter = true;
            $smartFilter['serDivision'] = $smartSrh->division;
            $smartFilter['serBSource'] = $smartSrh->bSource;
            $smartFilter['jsrsStatus'] = $smartSrh->jsrsStatus;
            $smartFilter['serRating'] = $smartSrh->serRating;
        }
        $appexp = new Expression("'A' as serviceStatus");
        $notappexp = new Expression("'NA' as serviceStatus");
        $tempexp = new Expression("'T' as sFrom");
        $mainexp = new Expression("'M' as sFrom");

        $tempSelectArr = [
            'sFrom',
            'MemCompServDtls_Pk as servicePk',
            'MCSvD_MemberCompMst_Fk as compk',
            'MCSvD_MemberCompMst_Fk as joinCompPk',
            'mcfd_uploadedby as uupk',
            'memcompfiledtls_pk as imagePK',
            'MCSvD_DisplayName as displayName',
            'mcsvd_servrefno as serviceModelNo',
            'mcsvd_servmodelno as serviceRefNo',
            'serviceStatus',
            'MCSvD_ServDesc as serviceDescription',
            'mcor_overallrating as overAllRating',
            'ifnull(mcpsfd_status,0) as followStatus'
        ];

        $tempQuerySelectArr = [
            $tempexp,
            'MemCompServDtls_Pk',
            'MCSvD_MemberCompMst_Fk',
            'mcfd_uploadedby',
            'memcompfiledtls_pk',
            'MCSvD_DisplayName',
            'mcsvd_servrefno',
            'mcsvd_servmodelno',
            $notappexp,
            'MCSvD_ServDesc',
            'mcor_overallrating',
            'mcuf.mcpsfd_status',
            'mcsvd_sezadstatus'
        ];

        $mainSelectArr = [
            $mainexp,
            'mcsvdm_memcompservdtls_fk as servicePk',
            'mcsvdm_membercompmst_fk as compk',
            'mcfd_uploadedby as uupk',
            'memcompfiledtls_pk as imagePK',
            'mcsvdm_displayname as displayName',
            'mcsvdm_servrefno as serviceModelNo',
            'mcsvdm_servmodelno as serviceRefNo',
            $appexp,
            'mcsvdm_servdesc as serviceDescription',
            'mcor_overallrating as overAllRating',
            'ifnull(mcuf.mcpsfd_status,0) as followStatus',
            'mcsvdm_sezadstatus as sezdsts'
        ];
        if ($isFilter) {
            $tempSelectArr = [
                'sFrom',
                'MemCompServDtls_Pk as servicePk',
                'MCSvD_MemberCompMst_Fk as compk',
                'MCSvD_MemberCompMst_Fk as joinCompPk',
                'mcfd_uploadedby as uupk',
                'memcompfiledtls_pk as imagePK',
                'MCSvD_DisplayName as displayName',
                'mcsvd_servrefno as serviceModelNo',
                'mcsvd_servmodelno as serviceRefNo',
                'serviceStatus',
                'MCSvD_ServDesc as serviceDescription',
                'SrvM_ServiceCode as serviceCode',
                'SrvM_ServiceName as serviceName',
                //'ClsM_ClassCode as sClsCode',
                //'ClsM_ClassName as sClsName',
                //'FamM_FamilyCode as sFamCode',
                //'FamM_FamilyName as sFamName',
                //'SegM_SegCode as sSegCode',
                //'SegM_SegName as sSegName',
                'mcor_overallrating as overAllRating',
                'ifnull(mcpsfd_status,0) as followStatus',
                'group_concat(distinct bsm_bussrcname) as businessSource',
                'bicsm_servicecode as bgiUnpscCode',
                'MCSvD_ServSearchKeyword as keywords'
            ];


            if(isset($divSector)) {
                array_push($tempSelectArr,$divSector);
                array_push($tempSelectArr,$divSector1);
            }

            $tempQuerySelectArr = [
                $tempexp,
                'MemCompServDtls_Pk',
                'MCSvD_MemberCompMst_Fk',
                'mcfd_uploadedby',
                'memcompfiledtls_pk',
                'MCSvD_DisplayName',
                'mcsvd_servrefno',
                'mcsvd_servmodelno',
                $notappexp,
                'MCSvD_ServDesc',
                'SrvM_ServiceCode',
                'SrvM_ServiceName',
                //'ClsM_ClassCode',
                //'ClsM_ClassName',
                //'FamM_FamilyCode',
                //'FamM_FamilyName',
                // 'SegM_SegCode',
                // 'SegM_SegName',
                'mcor_overallrating',
                'mcuf.mcpsfd_status',
                'bsm.bsm_bussrcname',
                'bicsm_servicecode',
                'MCSvD_ServSearchKeyword',
                'mcsvd_sezadstatus',
                'businesssourcemst_pk',
                'mcsvd_bgiindcodecateg_fk',
                'mcsvd_bgiindcodesubcateg_fk',
                'mcsvd_bgiinduscodeservmst_fk',
                'MCSvD_ServiceMst_Fk',
                'MCSvD_SVFAdminApprovalStatus',

                //'mcsd.mcsd_businessunitrefname',
                //'secm.SecM_SectorName'
            ];

            if(isset($divSectorColumn)) {
                array_push($tempQuerySelectArr,$divSectorColumn);
                array_push($tempQuerySelectArr,$divSectorColumn1);  
            }

            $mainSelectArr = [
                $mainexp,
                'mcsvdm_memcompservdtls_fk as servicePk',
                'mcsvdm_membercompmst_fk as compk',
                //'mcsvdm_membercompmst_fk as joinCompPk',
                'mcfd_uploadedby as uupk',
                'memcompfiledtls_pk as imagePK',
                'mcsvdm_displayname as displayName',
                'mcsvdm_servrefno as serviceModelNo',
                'mcsvdm_servmodelno as serviceRefNo',
                $appexp,
                'mcsvdm_servdesc as serviceDescription',
                'SrvM_ServiceCode as serviceCode',
                'SrvM_ServiceName as serviceName',
                //'ClsM_ClassCode as sClsCode',
                //'ClsM_ClassName as sClsName',
                //'FamM_FamilyCode as sFamCode',
                //'FamM_FamilyName as sFamName',
                // 'SegM_SegCode as sSegCode',
                // 'SegM_SegName as sSegName',
                'mcor_overallrating as overAllRating',
                'ifnull(mcuf.mcpsfd_status,0) as followStatus',
                'bsm.bsm_bussrcname as businessSource',

                //'mcsd.mcsd_businessunitrefname as division',
                //'secm.SecM_SectorName as sectorname',

                'mcsvdm_sezadstatus as sezdsts',
                'bicsm_servicecode as bgiUnpscCode',
                'mcsvdm_servsearchkeyword as keywords',
                'businesssourcemst_pk',
                'mcsvdm_bgiindcodecateg_fk',
                'mcsvdm_bgiindcodesubcateg_fk',
                'mcsvdm_bgiinduscodeservmst_fk',
                'mcsvdm_servicemst_fk',
                new Expression("'A' as MCSvD_SVFAdminApprovalStatus")
            ];
            if(isset($divSectorAlias)) {
                array_push($mainSelectArr,$divSectorAlias);
                array_push($mainSelectArr,$divSectorAlias1);
            }
        }
        $serviceUnionSelect = $tempSelectArr;

        $tempServiceSearchQuery = MemcompservicedtlsTbl::find()
            ->select($tempQuerySelectArr)
            ->from('memcompservicedtls_tbl mcsvd')
            ->leftJoin('membercompanymst_tbl mcm', 'mcm.MemberCompMst_Pk = mcsvd.MCSvD_MemberCompMst_Fk')
            ->leftJoin('memcompservicedtlsmain_tbl mcsvdm', 'MemCompServDtls_Pk = mcsvdm_memcompservdtls_fk')
            ->leftJoin('memberregistrationmst_tbl mrm', 'mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
            ->leftJoin('memcompfiledtls_tbl mcfd', 'memcompfiledtls_pk=mcsvd_servcoverimgfile')
            ->leftJoin('servicemst_tbl sm', 'sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', "MemCompServDtls_Pk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 3 and mcuf.mcpsfd_type = 5 and mcpsfd_usermst_fk={$userpk}")
            ->leftJoin('memcompoverallreview_tbl', 'MemCompServDtls_Pk = mcor_shared_fk and mcor_type = 2');

        $mainServiceSearchQuery = MemcompservicedtlsmainTbl::find()
            ->select($mainSelectArr)
            ->from('memcompservicedtlsmain_tbl mcsvdm')
            ->innerJoin('membercompanymst_tbl mcm', 'mcm.MemberCompMst_Pk = mcsvdm_membercompmst_fk')
            // ->innerJoin('0 mcsvdm', 'mcm.MemberCompMst_Pk = mcsvdm_memcompservdtls_fk')
            ->innerJoin('memberregistrationmst_tbl mrm', 'mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk')
            ->leftJoin('servicemst_tbl sm', 'sm.ServiceMst_Pk = mcsvdm_servicemst_fk')
            ->leftJoin('memcompfiledtls_tbl mcfd', 'memcompfiledtls_pk=mcsvdm_servcoverimgfile')
            ->leftJoin('memcompprdserfollowdtls_tbl as mcuf', "mcsvdm_memcompservdtls_fk = mcuf.mcpsfd_shared_fk and mcuf.mcpsfd_followtype = 3 and mcuf.mcpsfd_type = 5 and mcpsfd_usermst_fk={$userpk}")
            ->leftJoin('memcompoverallreview_tbl', 'mcsvdm_memcompservdtls_fk = mcor_shared_fk and mcor_type = 2');

        $tempServiceSearchQuery->where([
            'mrm_stkholdertypmst_fk' => '6',
            'MRM_MemberStatus' => 'A',
            'MRM_ValSubStatus' => 'A',
            'mcsvd_isdeleted' => '2',
            'memcompservdtlsmain_pk' => null,
        ])->groupBy('MemCompServDtls_Pk');

        if(isset($searchType) && $searchType == 3) {
            $tempServiceSearchQuery->andWhere(['not', ['MemberCompMst_Pk' => $cmpPK]]);
        }
        
        $tempServiceSearchQuery->andWhere(['not', ['mcsvd_CreatedOn' => null]]);
        $tempServiceSearchQuery->andWhere(['or', ['not in', 'MCSvD_SVFAdminApprovalStatus', ['A']], ['is', 'MCSvD_SVFAdminApprovalStatus', null]]);

        $mainServiceSearchQuery->where([
            'mrm_stkholdertypmst_fk' => '6',
            'MRM_MemberStatus' => 'A',
            'MRM_ValSubStatus' => 'A'
        ])->groupBy('mcsvdm_memcompservdtls_fk');

        if(isset($searchType) && $searchType == 3) {
            $mainServiceSearchQuery->andWhere(['not', ['MemberCompMst_Pk' => $cmpPK]]);
        }
        
        if ($isFilter  || !empty($searchKey)) {
            $tempServiceSearchQuery->leftJoin('bgiinduscodeservmst_tbl', ' mcsvd_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk')
                ->leftJoin('bgiindcodesubcateg_tbl', 'mcsvd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
                ->leftJoin('bgiindcodecateg_tbl', 'mcsvd_bgiindcodecateg_fk = bgiindcodecateg_pk')
                ->leftJoin('memcompservbussrcmap_tbl mcsbsm', 'MemCompServDtls_Pk = mcsbsm_memcompservdtls_fk')
                ->leftJoin('memcompbussrcdtls_tbl mcb', 'mcsbsm.mcsbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk')
                ->leftJoin('businesssourcemst_tbl bsm', 'bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk')
                ->leftJoin('classmst_tbl cm', 'ClassMst_Pk = SrvM_ClassMst_Fk')
                ->leftJoin('familymst_tbl fm', 'FamilyMst_Pk = SrvM_FamilyMst_Fk')


                //->leftJoin('memcompsectordtls_tbl mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                //->leftJoin('sectormst_tbl secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')


                ->leftJoin('segmentmst_tbl sgm', 'SegmentMst_Pk = SrvM_SegmentMst_Fk');

            $mainServiceSearchQuery->leftJoin('bgiinduscodeservmst_tbl', 'mcsvdm_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk')
                ->leftJoin('bgiindcodesubcateg_tbl', 'mcsvdm_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk')
                ->leftJoin('bgiindcodecateg_tbl', 'mcsvdm_bgiindcodecateg_fk = bgiindcodecateg_pk')
                ->leftJoin('memcompservbussrcmapmain_tbl mcsbsmm', 'mcsvdm_memcompservdtls_fk = mcsbsmm_memcompservdtls_fk')
                ->leftJoin('memcompbussrcdtlsmain_tbl mcb', 'mcsbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk')

                //->leftJoin('memcompsectordtls_tbl mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsdm_memcompsecdtls_fk')
                //->leftJoin('sectormst_tbl secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')

                ->leftJoin('businesssourcemst_tbl bsm', 'mcbsdm_businesssourcemst_fk = businesssourcemst_pk');
                // ->innerJoin('classmst_tbl cm', 'ClassMst_Pk = SrvM_ClassMst_Fk')
                // ->innerJoin('familymst_tbl fm', 'FamilyMst_Pk = SrvM_FamilyMst_Fk')
                // ->innerJoin('segmentmst_tbl sgm', 'SegmentMst_Pk = SrvM_SegmentMst_Fk');

            if(!empty($searchKey) && empty($smartFilter['serDivision'])) {

                $tempServiceSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                ->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');

                $mainServiceSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsdm_memcompsecdtls_fk')
                ->leftJoin('sectormst_tbl as secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');

            }   

            if ((isset($smartFilter['serDivision']) && !empty($smartFilter['serDivision']))) {

                $tempServiceSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsd_memcompsecdtls_fk')
                ->leftJoin('sectormst_tbl secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');
                $tempServiceSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['serDivision']]);

                $mainServiceSearchQuery->leftJoin('memcompsectordtls_tbl as mcsd', 'mcsd.MemCompSecDtls_Pk = mcb.mcbsdm_memcompsecdtls_fk')
                ->leftJoin('sectormst_tbl secm', 'secm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk');
                $mainServiceSearchQuery->andWhere(['in', 'mcsd.MemCompSecDtls_Pk', $smartFilter['serDivision']]);
            }
            if (isset($smartFilter['serBSource']) && !empty($smartFilter['serBSource'])) {
                $tempServiceSearchQuery->andWhere(['in', 'bsm.businesssourcemst_pk', $smartFilter['serBSource']]);
                $mainServiceSearchQuery->andWhere(['in', 'bsm.businesssourcemst_pk', $smartFilter['serBSource']]);
            }
        }
        if (!empty($filterSrh)) {
            $advanceFilterData = json_decode(json_encode($filterSrh), true);
            if (!empty($advanceFilterData['Services'])) {
                $queryObject = new ServiceFilterQueryGen($advanceFilterData['Services'], 'T');
                $tempQuery = $queryObject->getQuery();
                if (!empty($tempQuery['where']))
                    $tempServiceSearchQuery->andWhere($tempQuery['where']);
                if (!empty($tempQuery['join'])) {
                    $tempServiceSearchQuery->join = array_merge($tempServiceSearchQuery->join, $tempQuery['join']);
                }
                $MainqueryObject = new ServiceFilterQueryGen($advanceFilterData['Services'], 'M');
                $mainQuery = $MainqueryObject->getQuery();
                if (!empty($mainQuery['where']))
                    $mainServiceSearchQuery->andWhere($mainQuery['where']);
                if (!empty($mainQuery['join'])) {
                    $mainServiceSearchQuery->join = array_merge($mainServiceSearchQuery->join, $mainQuery['join']);
                }
            }
        }
        if (!empty($tempServiceSearchQuery->join)) {

            $listOfTables = array_column($tempServiceSearchQuery->join, 1, 1);
            if (in_array('memcompsectordtls_tbl mcsd', $listOfTables) || in_array('memcompsectordtls_tbl', $listOfTables)) {
                $tempServiceSearchQuery->select[] .= 'MemCompSecDtls_Pk';
                $tempServiceSearchQuery->select[] .= 'SectorMst_Pk';
                //$tempServiceSearchQuery->select[] .= 'SecM_SectorName';
                //Main table
                $mainServiceSearchQuery->select[] .= 'MemCompSecDtls_Pk';
                $mainServiceSearchQuery->select[] .= 'SectorMst_Pk';
                //$mainServiceSearchQuery->select[] .= 'SecM_SectorName';
            }
        }

        $serviceSearchQuery = (new \yii\db\Query())
            ->from(['servunion' => $tempServiceSearchQuery->union($mainServiceSearchQuery, true)])
            ->orderBy(["displayName" => SORT_ASC]);

        $serviceSearchQuery->select($serviceUnionSelect);
        
        if(!empty($smartFilter) || !empty($searchKey)) {
            $serviceSearchQuery->groupBy('servicePk');    
        }
        
        
        if (isset($smartFilter['jsrsStatus']) && !empty($smartFilter['jsrsStatus'])) {
            if (in_array('A', $smartFilter['jsrsStatus']) && in_array('NA', $smartFilter['jsrsStatus'])) {
            } elseif (in_array('A', $smartFilter['jsrsStatus'])) {
                $serviceSearchQuery->andWhere(['serviceStatus' => 'A']);
            } elseif (in_array('NA', $smartFilter['jsrsStatus'])) {
                $serviceSearchQuery->andWhere(['serviceStatus' => 'NA']);
            }
        }

        if (isset($smartFilter['serRating']) && !empty($smartFilter['serRating'])) {
            $serRatingData = '';
            foreach ($smartFilter['serRating'] as $key => $serRating) {
                if ($serRatingData != '') {
                    $serRatingData .= ' OR ';
                }
                if (($serRating + 1) == 5) {
                    $serRat = 5;
                } else {
                    $serRat = ($serRating + 0.99);
                }
                $serRatingData .= '(mcor_overallrating BETWEEN ' . $serRating . ' AND ' . $serRat . ')';
            }
            $serviceSearchQuery->andWhere($serRatingData);
        }

        if (!empty($searchKey)) {

            $flag = false;
            foreach ($searchKey as $key => $value) {

                $str = str_replace(' ', '', $value);

                if (strpos('approved', strtolower($str)) !== false) {

                   $serviceSearchQuery->orWhere(['serviceStatus' => 'A']);
                   $flag = true;
                }
                if(strpos('notapproved', strtolower($str)) !== false) {
                    $serviceSearchQuery->orWhere(['serviceStatus' => 'NA']);
                    $flag = true;
                }  
            }
            if(!$flag) {
                $serviceSearchQuery->having([
                    'OR',
                    ['OR LIKE', 'displayName', $searchKey],
                    ['OR LIKE', 'serviceDescription', $searchKey],
                    ['OR LIKE', 'serviceModelNo', $searchKey],
                    ['OR LIKE', 'serviceRefNo', $searchKey],
                    ['OR LIKE', 'keywords', $searchKey],
                    //['OR LIKE', 'sSegName', $searchKey],
                    //['OR LIKE', 'sFamName', $searchKey],
                    //['OR LIKE', 'sClsName', $searchKey],
                    ['OR LIKE', 'serviceName', $searchKey],
                    ['OR LIKE', 'businessSource', $searchKey],
                    ['OR LIKE', 'keywords', $searchKey],
                    ['OR LIKE', 'division', $searchKey],
                    ['OR LIKE', 'sectorname', $searchKey]
                ]);
            }
            
        }

        $finalFormation = '';
        // if (!empty($filterSrh)) {
        //     $finalFormation = self::advanceCoditionFormation($filterSrh, 1, 6);
        // }


        if ($finalFormation != '') {
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $serviceSearchQuery->andWhere($finalFormation);
        }


        if ($searchSort == 'Desc') {
            $serviceSearchQuery->orderBy(['displayName' => SORT_DESC]);
        } else {
            $serviceSearchQuery->orderBy(['displayName' => SORT_ASC]);
        }
        
        // $serviceSearchQueryResult = $serviceSearchQuery->groupBy('sm.ServiceMst_Pk')
        //     ->asArray();
        // if(isset($_REQUEST['isquery'])){
        //     echo'<pre>';print_r($serviceSearchQuery->createCommand()->getRawSql());exit;
        // }

        
        if (is_null($withFilterCondtion)) {
            return $serviceSearchQuery;
        } else {
            $query['ActiveQuery'] = $serviceSearchQuery;
            $query['FilterCondition']['temp'] = $tempQuery;
            $query['FilterCondition']['main'] = $mainQuery;
            return $query;
        }
    }

    public function advanceCoditionFormation($filterSrh, $searchType, $criteriaType)
    {
        $gParentPrevDataType = $currentDataType = $gParentOrBracket = $parentDataType = $childDataType = $filterField = $filterCombination = $filterValue = $parentFormation = $childFormation = $finalFormation = '';
        $gpKey = 0;
        foreach ($filterSrh as $fsKey => $filterType) {
            $parentPrevDataType = $parentFormation = '';
            $gpKey += 1;
            foreach ($filterType as $ftKey => $parentArr) {
                $childPrevDataType = $childFormation = $parentOrBracket = '';
                $parentCount = 0;
                foreach ($parentArr->parent as $pKey => $childArr) {
                    if ($childArr->type > 0 && $childArr->combination && $childArr->dataVal) {
                        $parentCount += 1;
                        $filterField = $filterCombination = $filterValue = $startsWith = $endsWith = $childOrBracket = '';

                        switch ($searchType) {
                            case '1':
                                $filterFieldCombination = self::internalFieldSearch($criteriaType, $fsKey, $childArr->type);
                                break;
                            case '2':
                                $filterFieldCombination = Domainsearch::domainFieldSearch($criteriaType, $fsKey, $childArr->type);
                                break;
                        }



                        $filterField = $filterFieldCombination['fieldName'];

                        $filterCombination = $filterFieldCombination['combination'][$childArr->combination];

                        if ($childArr->combination == 3) {
                            $startsWith = '%';
                        } elseif ($childArr->combination == 4) {
                            $endsWith = '%';
                        } elseif ($childArr->combination == 5 || $childArr->combination == 6) {
                            $startsWith = '%';
                            $endsWith = '%';
                        }

                        if ($childArr->combination == 9) {
                            $startValue = date('Y-m-d', strtotime($childArr->dataVal->startDate)) . ' 00:00:00';
                            $endValue = date('Y-m-d', strtotime($childArr->dataVal->endDate)) . ' 00:00:00';
                        } else {
                            $filterValue = $endsWith . $childArr->dataVal . $startsWith;
                        }

                        if ($pKey == 0) {
                            $childFormation .= '(';
                        }

                        if ($pKey > 0 && $childPrevDataType == ' OR ') {
                            $childOrBracket = '(';
                        }

                        if ($childArr->combination == 9) {
                            $childFormation .= $childPrevDataType . $childOrBracket . ' (' . $filterField . ' >= "' . $startValue . '" AND ' . $filterField . ' <= "' . $endValue . '") ';
                        } else {
                            $childFormation .= $childPrevDataType . $childOrBracket . ' (' . $filterField . ' ' . $filterCombination . ' "' . $filterValue . '") ';
                        }

                        $childPrevDataType = ($childArr->dataType == '' || $childArr->dataType == "1") ? ' AND ' : ' OR ';

                        if ($childPrevDataType ==  ' OR ') {
                            $childFormation .= ')';
                        }
                    }
                }

                if ($childFormation != '') {
                    $childFormation .= ')';

                    if ($ftKey == 0) {
                        $parentOrBracket .= '(';
                    }

                    if ($ftKey > 0 && $parentPrevDataType == ' OR '  && ($parentArr->parentDataType == '1' || $parentArr->parentDataType == '')) {
                        $parentOrBracket = '(';
                    }

                    $parentFormation .= $parentPrevDataType . $parentOrBracket . ' (' . $childFormation . ') ';
                    $parentPrevDataType = ($parentArr->parentDataType == '' || $parentArr->parentDataType == "1") ? ' AND ' : ' OR ';

                    if ($parentPrevDataType ==  ' OR ') {
                        $parentFormation .= ')';
                    }
                }
            }

            if ($parentFormation != '' || (($filterType == 1 || $filterType == 2) && $finalFormation != '')) {
                if ($parentFormation != '') {
                    $parentFormation .= ')';
                }


                if (($gpKey % 2) == 1 && $gpKey > 1) {
                    $currentDataType = ($filterType == 1) ? ' AND ' : ' OR ';
                    $gParentOrBracket = '';
                }

                if ($finalFormation == '') {
                    $gParentOrBracket = '(';
                }

                if (($gpKey % 2) == 0 && $currentDataType == ' OR ' && $finalFormation != '') {
                    $gParentOrBracket = '(';
                }

                if (($gpKey % 2) == 0 && $currentDataType == ' OR ') {
                    $gParentOrCloseBracket = ')';
                } else {
                    $gParentOrCloseBracket = '';
                }

                if (($gpKey % 2) == 0 && $parentFormation != '' && $parentCount > 0) {
                    $finalFormation .= $gParentOrCloseBracket . $currentDataType . $gParentOrBracket . ' (' . $parentFormation . ') ';
                }
            }
        }
        return $finalFormation;
    }
    public static function getPeopleDetails($userPk)
    {
        $loginusrpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $userDetails = UsermstTbl::find()
            ->select([
                'UserMst_Pk as userPk',
                'MemberCompMst_Pk as companyPk',
                "concat_ws(' ',um_firstname,um_middlename, um_lastname) as 'employeeName'",
                'UM_EmpId as empId',
                'group_concat(DISTINCT DM_Name SEPARATOR ", ") as departmentName',
                'um_primobnocc',
                'um_secmobnocc',
                "concat_ws(' ',prmc.CyM_CountryDialCode,um_primobno) as 'primobno'",
                "concat_ws(' ',smc.CyM_CountryDialCode,um_secmobno) as 'secmobno'",
                'UM_EmailID as emailID',
                'um_secemailid as secEmail',
                'dsg.dsg_designationname as designation',
                'group_concat(DISTINCT sm.SecM_SectorName SEPARATOR ", ") as sectors',
                // 'tz_countrynDISTINCTame as timeZoneCountry',
                '(case um_desiglevel when "1" then "Senior Management" when "2" then "Professional" when "3" then "Supervisory" when "4" then "Skilled" when "5" then "Semi-skilled" when "6" then "Unskilled" end) as designationLevel',
                // "year(curdate()) - year(up_dateofjoin) - (date_format(curdate(),'%m%d') < date_format(up_dateofjoin,'%m%d')) as yearsOfExperience",
                'up_dateofjoin as dateOfJoin',
                'up_reportingto as reportTo',
                'um_supervisor as supervisorTo',
                //'up_yrsofexperience as yearsOfExperience',
                'up_rolesnresp as roles',
                'mcpsfd_status as isFav',
                'um_socialmedia as socialMedia',
                'mcmpld_officename as officeadd',
                'um_postalcode as pin',
                'um_userdp as dp',
                'c.CyM_CountryName_en as country',
                'SM_StateName_en as state',
                'CM_CityName_en as city',
                'group_concat(DISTINCT mcsd.mcsd_businessunitrefname SEPARATOR ", ")  as businessUnit',
            ])
            ->leftJoin('departmentmst_tbl', 'find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
            // ->leftJoin('timezone_tbl','UM_TimeZone = timezone_pk')
            ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
            ->leftJoin('designationmst_tbl dsg', 'dsg.designationmst_pk = UM_Designation')
            ->leftJoin('memcompsectordtls_tbl mcsd', 'find_in_set(MemCompSecDtls_Pk, um_busunit)')
            ->leftJoin('sectormst_tbl sm', 'sm.SectorMst_Pk = mcsd.MCSD_SectorMst_Fk')
            ->leftJoin('memcompprdserfollowdtls_tbl', 'UserMst_Pk = mcpsfd_shared_fk  and mcpsfd_followtype = 5 and mcpsfd_type = 10 and mcpsfd_usermst_fk=' . $loginusrpk)
            ->leftJoin('memcompmplocationdtls_tbl', 'um_address = memcompmplocationdtls_pk')
            ->leftJoin('countrymst_tbl c', 'c.CountryMst_Pk = mcmpld_countrymst_fk')
            ->leftJoin('countrymst_tbl prmc', 'prmc.CountryMst_Pk = um_primobnocc')
            ->leftJoin('countrymst_tbl smc', 'smc.CountryMst_Pk = um_secmobnocc')
            ->leftJoin('statemst_tbl', 'StateMst_Pk = mcmpld_statemst_fk')
            ->leftJoin('citymst_tbl', 'CityMst_Pk = mcmpld_citymst_fk')
            ->where(['UserMst_Pk' => $userPk])
            ->asArray()->one();

            //print_r($userDetails->createCommand()->getRawSql());die();

        $userDetails['dp'] = Drive::generateUrl($userDetails['dp'], $userDetails['companyPk'], $loginusrpk) . '&noimg=2';

//        print_r($userDetails['socialMedia']);
        
        if (!empty($userDetails['socialMedia']) && $userDetails['socialMedia'] != '"[]"') {
            $socialMedia = json_decode($userDetails['socialMedia'],true);
            $userDetails['socialFacebook'] = $socialMedia['facebook'];
            $userDetails['socialInstagram'] = $socialMedia['instagram'];
            $userDetails['socialTwitter'] = $socialMedia['twitter'];
            $userDetails['socialLinkedin'] = $socialMedia['linkedin'];
        } else {
            $userDetails['socialFacebook'] = $userDetails['socialInstagram'] = $userDetails['socialTwitter'] = $userDetails['socialLinkedin'] = '';
        }

        //print_r($userDetails);die();
        return $userDetails;
    }


    //Smart Filter start
    public static function getDivision()
    {
        $divisionDtls = UsermstTbl::find()
            ->select([
                'MemCompSecDtls_Pk as divisionPk',
                'mcsd_businessunitrefname as divRefName',
                'mcsd_referenceno as divRefNo',
            ])
            ->innerJoin('userpermtrn_tbl', 'UPT_UserMst_Fk = UserMst_Pk')
            ->innerJoin('memberregistrationmst_tbl', 'UM_MemberRegMst_Fk = MemberRegMst_Pk')
            ->innerJoin('memcompsectordtls_tbl', 'find_in_set(MemCompSecDtls_Pk,um_busunit)')
            ->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'UM_Status' => 'A',
                'upt_basemodulemst_fk' => '54' //jsearch access
            ])
            ->asArray()->all();
        return $divisionDtls;
    }
    public function getDesignationLevel($type = null)
    {
        $selectArr = [
            'designationlevelmst_pk as designationPk',
            'designationlevelmst_pk as filterPk',
            'dlm_desglevelname as filterName',
        ];
        if ($type == 'desiglevel') {
            $selectArr = [
                'designationlevelmst_pk as value',
                'dlm_desglevelname as name',
            ];
        }
        $desigationLevel = UsermstTbl::find()
            ->select($selectArr)
            ->innerJoin('userpermtrn_tbl', 'UPT_UserMst_Fk = UserMst_Pk')
            ->innerJoin('memberregistrationmst_tbl', 'UM_MemberRegMst_Fk = MemberRegMst_Pk')
            ->innerJoin('designationlevelmst_tbl', 'designationlevelmst_pk = um_desiglevel')
            ->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'UM_Status' => 'A',
                'upt_basemodulemst_fk' => '54' //jsearch access
            ])
            ->andWhere(['not', ['dlm_desglevelname' => null]])
            ->groupBy('designationlevelmst_pk')
            ->asArray()->all();
        return $desigationLevel;
    }

    public function getPopleCountry()
    {
        $desigationLevel = UsermstTbl::find()
            ->select([
                'CountryMst_Pk as countryid',
                'CountryMst_Pk as filterPk',
                'CyM_CountryName_en as filterName',
            ])
            ->innerJoin('userpermtrn_tbl', 'UPT_UserMst_Fk = UserMst_Pk')
            ->innerJoin('memberregistrationmst_tbl', 'UM_MemberRegMst_Fk = MemberRegMst_Pk')
            ->innerJoin('memcompmplocationdtls_tbl', 'um_address = memcompmplocationdtls_pk')
            ->innerJoin('countrymst_tbl', 'CountryMst_Pk = mcmpld_countrymst_fk')
            ->where([
                'mrm_stkholdertypmst_fk' => '6',
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'UM_Status' => 'A',
                'upt_basemodulemst_fk' => '54' //jsearch access
            ])
            ->andWhere(['not', ['CyM_CountryName_en' => null]])
            ->groupBy('CountryMst_Pk')
            ->orderBy(['CyM_CountryName_en'=>SORT_ASC])
            ->asArray()->all();

            //print_r($desigationLevel->createCommand()->getRawSql());die();
        return $desigationLevel;
    }
    public static function organizeFilterData($searchType, $type)
    {
        switch ($searchType) {
            case '1': // Supplier Filter
            case '2': // Supplier Filter
            case '3': // product Filter
            case '4': // server Filter
            case '5': // user Filter
                $filterResult = self::organizeSupplierFilterData($type);
                break;
        }
        return $filterResult;
    }
    public function organizeSupplierFilterData($type)
    {
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);

        $filterDataArr = [];
        switch ($type) {
            case 'country':
                $filterDataArr = self::getCountry();
                break;
            case 'state':
                $filterDataArr = self::getState();
                break;
            case 'city':
                $filterDataArr = self::getCity();
                break;
            case 'pdolcc':
                $filterDataArr = PdocategorymstTblQuery::getCategory();
                break;
            case 'drpiclcc':
                $filterDataArr = WalivlgblockmapTblQuery::getDRPICWilayat();
                break;
            case 'nationality':
                $filterDataArr = self::getCountry();
                break;
            case 'desglevel':
            case 'desglevelml':
                $filterDataArr = DesignationlevelmstTblQuery::getLevel();
                break;
            case 'ssector':
            case 'psector':
            case 'sersector':
            case 'usector':
                $filterDataArr = SectormstTblQuery::getActSector();
                break;
            case 'pbussource':
            case 'sbussource':
                $filterDataArr = self::getBusinesssource($type);
                break;
            case 'desiglevel':
                $filterDataArr = self::getDesignationLevel($type);
                break;
            case 'section':
                $filterDataArr = TendbrdsecmstTblQuery::getActSection();
                break;
            case 'grade':
                $filterDataArr = TendbrdgrademstTblQuery::getActGrade();
                break;
        }
        $jwt = Yii::$app->jwt;
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        $filterDataArr = $jwt->getBuilder()
            ->setIssuer($_SERVER['SERVER_NAME']) // Configures the issuer (iss claim)
            ->setAudience($_SERVER['SERVER_NAME']) // Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set($type, $filterDataArr) // Configures a new claim, called "uid"
            ->sign($signer, $jwt->key) // creates a signature using [[Jwt::$key]]
            ->getToken(); // Retrieves the generated token

        return (string)$filterDataArr;
    }
    public function getBusinesssource($type)
    {
        if ($type == 'pbussource') {
            $productBsource = MembercompanymstTbl::find()
                ->select([
                    'businesssourcemst_pk as value',
                    'bsm_bussrcname as name'
                ])
                ->from('membercompanymst_tbl mcm')
                ->innerJoin('memcompproddtls_tbl mcprd', 'mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
                ->innerJoin('memcompprodbussrcmap_tbl mcpbm', 'mcpbm.mcpbsm_memcompproddtls_fk = mcprd.MemCompProdDtls_Pk')
                ->innerJoin('memcompbussrcdtls_tbl mcbsd', 'mcbsd.memcompbussrcdtls_pk = mcpbm.mcpbsm_memcompbussrcdtls_fk')
                ->innerJoin('businesssourcemst_tbl bsm', 'bsm.businesssourcemst_pk = mcbsd.mcbsd_businesssourcemst_fk');
            $productBsource->innerJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk');
            $productBsource->where([
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'mrm_stkholdertypmst_fk' => '6',
                'mcprd_isdeleted' => '2'
            ])->andWhere(['not', ['MCPrD_CreatedOn' => null]]);
            $productBsource->groupBy('businesssourcemst_pk')
                ->orderBy(['bsm_bussrcname' => SORT_ASC])
                ->asArray();
            $result = $productBsource->createCommand()->queryAll();
        } elseif ($type = 'sbussource') {
            $serviceBsource = MembercompanymstTbl::find()
                ->select([
                    'businesssourcemst_pk as value',
                    'bsm_bussrcname as name',
                ])
                ->from('membercompanymst_tbl mcm')
                ->innerJoin('memcompservicedtls_tbl mcsvd', 'mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                ->innerJoin('memcompservbussrcmap_tbl mcsbm', 'mcsbm.mcsbsm_memcompservdtls_fk = mcsvd.MemCompServDtls_Pk')
                ->innerJoin('memcompbussrcdtls_tbl mcbsd', 'mcbsd.memcompbussrcdtls_pk = mcsbm.mcsbsm_memcompbussrcdtls_fk')
                ->innerJoin('businesssourcemst_tbl bsm', 'bsm.businesssourcemst_pk = mcbsd.mcbsd_businesssourcemst_fk');
            $serviceBsource->innerJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk');
            $serviceBsource->where([
                'MRM_MemberStatus' => 'A',
                'MRM_ValSubStatus' => 'A',
                'mrm_stkholdertypmst_fk' => '6',
                'MCSvD_isdeleted' => '2'
            ])->andWhere(['not', ['MCSvD_CreatedOn' => null]]);
            $serviceBsource->groupBy('businesssourcemst_pk')
                ->orderBy(['bsm_bussrcname' => SORT_ASC])
                ->asArray();
            $result = $serviceBsource->createCommand()->queryAll();
        }
        return $result;
    }
    public static function getCountry()
    {
        $db = Yii::$app->db;
        // Create a dependency on updated_at field
        $dependency = new \yii\caching\DbDependency(['sql' => "select max(CyM_CreatedOn)  from countrymst_tbl where CyM_Status='A'"]);
        $duration = 600;     // cache query results for 50 days
        $result = $db->cache(function ($db) {
            $countrylst = CountrymstTbl::find()
                ->select(['CountryMst_Pk as value', 'CyM_CountryName_en as name'])
                ->where("CyM_Status='A'")
                ->orderBy('CyM_CountryName_en asc')
                ->asArray()->all();

            return $countrylst;
        }, $duration, $dependency);

        return $result;
    }
    public static function getState()
    {
        $db = Yii::$app->db;
        $dependency = new \yii\caching\DbDependency(['sql' => "select max(SM_CreatedOn)  from statemst_tbl where SM_Status='A'"]);
        $duration = 600;
        $result = $db->cache(function ($db) {
            $statelst = StatemstTbl::find()
                ->select(['SM_CountryMst_Fk as countryid', 'StateMst_Pk as value', 'SM_StateName_en as name'])
                ->where("SM_Status='A'")
                ->asArray()->all();
            $result = ArrayHelper::index($statelst, null, 'countryid');
            return $result;
        }, $duration, $dependency);

        return $result;
    }
    public static function getCity()
    {
        $db = Yii::$app->db;
        $dependency = new \yii\caching\DbDependency(['sql' => "select max(CM_CreatedOn) from citymst_tbl where CM_Status='A'"]);
        $duration = 600;
        $result = $db->cache(function ($db) {
            $citylst = CitymstTbl::find()
                ->select(['CM_StateMst_Fk as stateid', 'CityMst_Pk as value', 'CM_CityName_en as name'])
                ->where("CM_Status='A'")
                ->asArray()->all();
            $result = ArrayHelper::index($citylst, null, 'stateid');
            return $result;
        }, $duration, $dependency);

        return $result;
    }
}
