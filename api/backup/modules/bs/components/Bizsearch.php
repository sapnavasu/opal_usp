<?php

namespace api\modules\bs\components;
use Yii;
use common\components\Security;
use \common\models\MembercompanymstTbl;
use \common\models\UsermstTbl;
use \common\models\MemberregistrationmstTbl;
use \common\models\MemcompsectordtlsTbl;
use \common\models\UsermonitorlogTbl;
use \common\models\MemcompproddtlsTbl;
use \common\models\MemcompservicedtlsTbl;
use \common\models\MemcompmplocationdtlsTbl;
use \common\models\DepartmentmstTbl;
use \common\models\BasemodulemstTbl;
use \common\models\BusinesssourcemstTbl;
use \api\modules\mst\models\SectormstTbl;
use \api\modules\bs\components\Internalsearch;
use \api\modules\pd\models\ProjectdtlsTbl;
use \yii\data\ActiveDataProvider;
use common\components\Drive;
use \api\modules\bs\components\Domainsearch;
use \api\modules\bs\components\B2bsearch;
use \api\modules\bs\components\Domainsuppliersearch;
use \api\modules\bs\components\Domaincontractorsearch;
use \api\modules\bs\components\Domainbuyersearch;

class Bizsearch {
    //{"savedata":{"searchType":1,"criteriaType":"2","keyword":[],"filterData":"","saveName":"ttt","queryAll":true}}
    public static function saveResult($requestData, $filterData){
        
        $regpk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);

        //print_r($requestData);die();
        
        if($filterData->savedata->searchType == 1){ // Internal
            $bizSearchTypeArr = ['1' => 'All', '2' => 'U', '3' => 'BU', '4' => 'ML', '5' => 'P', '6' => 'S', '7' => 'MP'];
        }elseif($filterData->savedata->searchType == 3){ // B2B
            $bizSearchTypeArr = ['1' => 'All', '2' => 'SU', '3' => 'P', '4' => 'S', '5' => 'PL'];
        }

        $querySplitter = '#';
        if($requestData !='') {
            $saveFormName = $requestData['savedata']['saveName'];
            $requestVal = $requestData['savedata'];
            $criteriaType = $requestData['savedata']['criteriaType'];
            $searchKey = $requestData['savedata']['keyword'];
            $searchFrom = 2;
            $searchSort = 'DESC';
            $filterSrh = $filterData->savedata->filterData;
            $smartSrh = $filterData->savedata->smartFilterData;

            $saveCriteriaFlag = $requestData['savedata']['saveCriteriaFlag'];

            $smartLabels = [];
            foreach ($smartSrh as $key => $smartSrhDt) {
                $smartLabels[] = $key;
            }

            $tryFormGroup = $filterData->savedata->tryFormGroup;
            $searchCriteriaShortCode = $bizSearchTypeArr[$criteriaType];
            $searchQuery = '';

            //print_r($criteriaType);die();
            if($criteriaType == 1) {
                $rawQuery['rawQuery'] = ''; $rawQuery['totalRes'] = 0;
                
                for($i = 2; $i <= count($bizSearchTypeArr); $i++) {
                    $searchQuery = '';

                    if($filterData->savedata->searchType == 1){
                        $searchQuery = self::internalSearch($i, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                    }elseif($filterData->savedata->searchType == 2) {
                        $searchQuery = Domainsearch::domainSearch($i, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                    } elseif($filterData->savedata->searchType == 3) {
                        if(!$saveCriteriaFlag) {
                            $searchQuery = B2bsearch::b2bsearch($i, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);

                            $rawQuery['rawQuery'] .= $searchQuery->createCommand()->getRawSql();
                            $rawQuery['totalRes'] += count($searchQuery->createCommand()->queryAll());
                        }
                    }
                    if($i != 7){
                        $rawQuery['rawQuery'] .= $querySplitter;
                    }
                }
                // print_r($rawQuery['rawQuery']);die();
            } else {
                //print_r($filterData->savedata->searchType);die();
                //print_r($criteriaType);die();
                if($filterData->savedata->searchType == 1) {
                    $searchQuery = self::internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                }elseif($filterData->savedata->searchType == 2) {
                    $searchQuery = Domainsearch::domainSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                }elseif($filterData->savedata->searchType == 3) {
                    //print_r($criteriaType);die();
                    $searchQuery = B2bsearch::b2bsearch($filterData->savedata->searchType,$criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                }

                $rawQuery['rawQuery'] = $searchQuery->createCommand()->getRawSql();
                $rawQuery['totalRes'] = count($searchQuery->createCommand()->queryAll());
            }
            $requestData['savedata']['smartLabel'] = $smartLabels;
            // $nameExists = \api\modules\mst\models\FavsrchmstTbl::find()->where(['fsm_srchname' => $saveFormName, 'fsm_memberregmst_fk' => $regpk])->one();
            // if($nameExists!= '' && $nameExists->favsrchmst_pk !=''){
            //     return [
            //         'msg' => "warning",
            //         'status' => 2,
            //         ];
            // }
            $srcMstObj = new \api\modules\mst\models\FavsrchmstTbl;
            $srcMstObj->fsm_srchname = $saveFormName;
            $srcMstObj->fsm_memberregmst_fk = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
            $srcMstObj->fsm_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $srcMstObj->fsm_createdon = date('Y-m-d H:i:s');
            if($srcMstObj->save()){
                $srcMstPk = $srcMstObj->favsrchmst_pk;
                $srcMstdtlObj = new \api\modules\mst\models\FavsrchdtlsTbl;
                $srcMstdtlObj->fsd_favsrchmst_fk = $srcMstPk;
                $srcMstdtlObj->fsd_srchtype = $searchCriteriaShortCode;
                $srcMstdtlObj->fsd_criteria = Security::encrypt($rawQuery['rawQuery']);
                $srcMstdtlObj->fsd_criteriabag = json_encode($requestData);
                $srcMstdtlObj->fsd_prevsrchcnt = $rawQuery['totalRes'];
                if($srcMstdtlObj->save()) {
                    return [
                    'msg' => "success",
                    'status' => 1,
                    ];
                } else{
                    return [
                    'msg' => "error",
                    'status' => 2,
                    ];
                }
            }else{
                return [
                    'msg' => "error",
                    'status' => 2,
                    ];
            }
            
        }
    }
	public static function saveTargetResults($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh, $smartSrh, $favsrchmst_edit_pk){
		
      
			
			$requestData2['savedata']['saveName']='';            
            $requestData2['savedata']['criteriaType'] = $criteriaType;
            $requestData2['savedata']['keyword'] = '';
            $requestData2['savedata']['filterSrh'] = json_encode($filterSrh);
			$requestData2['savedata']['smartSrh'] = json_encode($smartSrh);
			$requestData2['savedata']['saveCriteriaFlag'] ='';

		
		 switch ($searchType) {
            case '1': // Internal SearchgetBizSearchData
                $finalQuery = self::internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '2': // Domain Search
                $finalQuery = Domainsearch::domainSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh);
                break;
            case '3': // B2B
                $finalQuery = B2bsearch::b2bsearchtarget($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '5': // Domain Supplier
                $finalQuery = Domainsuppliersearch::domainSupplierSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '6': // Domain Contractor
                $finalQuery = Domaincontractorsearch::domainContractorSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '7': // Domain Buyer
                $finalQuery = Domainbuyersearch::domainBuyerSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
        }

        if($triggerFrom == 1) {
            $pageSize = 4;
            $page = 0;
        } else {
            $pageSize = (isset($_REQUEST['pageSize']) && $_REQUEST['pageSize'] > 0)?$_REQUEST['pageSize']:'100000';
            $page = ($searchPage > 0)?$searchPage:'0';
        }

        //echo $finalQuery->createCommand()->getRawSql();die(); 

        
        $searchProvider = new ActiveDataProvider([
            'query' => $finalQuery,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
        ]);

        $count = Yii::$app->db->createCommand($finalQuery->createCommand()->getRawSql())->queryAll();
        $searchRes['data'] = $providerData = $searchProvider->getModels();

     

        //print_r($searchProvider->getTotalCount());die;
        
        if($searchType == 1) {

            $driveCmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
            $driveUserpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
            if($criteriaType == 2 || $criteriaType == 4){
                $searchData = [];
                foreach ($providerData as $key => $userData) {
                    $driveImg = Drive::generateUrl($userData['imagePk'],$driveCmpPK,$driveUserpk);
                    $searchData[$key] = $userData;
                    $searchData[$key]['coverImg'] = $driveImg;
                }
                $searchRes['data'] = $searchData;
            } elseif($criteriaType == 3){ // Business Unit
                $businessUnitArr = [];
                foreach($providerData as $key => $businessUnit){
                    $businessUnitArr[$key] = $businessUnit;
                    $userCount = Internalsearch::businessUnitUserCount($businessUnit['bUnitPk']);
                    $businessUnitArr[$key]['userCount'] = (isset($userCount['userCount']) && ($userCount['userCount'] > 0))?$userCount['userCount']:'-';

                    $bSourceCount = Internalsearch::divisionBsourceCount($businessUnit['bUnitPk']);
                    $businessUnitArr[$key]['bsourceCount'] = (isset($bSourceCount['bSourceCount']) && ($bSourceCount['bSourceCount'] > 0))?$bSourceCount['bSourceCount']:'Nil'; 
                }
     
                $searchRes['data'] = $businessUnitArr;
            } elseif($criteriaType == 5 || $criteriaType == 6){ // Product & Service
                $searchData = [];
                foreach ($providerData as $key => $pdtSerData) {
                    $driveImg = Drive::generateUrl($pdtSerData['imagePK'],$driveCmpPK,$driveUserpk);
                    $searchData[$key] = $pdtSerData;
                    $searchData[$key]['coverImg'] = $driveImg;
                }
                $searchRes['data'] = $searchData;
            }
        }
		
		
		$rawQuery['rawQuery'] = Security::encrypt($finalQuery->createCommand()->getRawSql());
        $rawQuery['totalRes'] =  count($count);		
        $searchRes['totalcount'] = count($count);
        $searchRes['size'] = $pageSize;
        $searchRes['page'] = $page;
        $searchRes['favmstname'] = '';
        $searchRes['fav_json_criteria'] = Security::encrypt($rawQuery['rawQuery']);	;
        $searchRes['fav_criteria_bag'] = json_encode($requestData2);
        $searchRes['fav_prevsrchcnt'] = $rawQuery['totalRes'];
		return $searchRes;
    }
    public static function updateSavedName($requestData){
        if($requestData != ''){
            $name = $requestData['params']['name'];
            $pk = $requestData['params']['pk'];
            $nameExists = \api\modules\mst\models\FavsrchmstTbl::find()->where(['fsm_srchname' => $name, 'fsm_memberregmst_fk' => \yii\db\ActiveRecord::getTokenData('reg_pk',true)])->andWhere(['<>','favsrchmst_pk',$pk])->one();
            if($nameExists!= '' && $nameExists->favsrchmst_pk !=''){
                return [
                    'msg' => "warning",
                    'status' => 2,
                    ];
            }
            $searchObj = \api\modules\mst\models\FavsrchmstTbl::find()->where(['favsrchmst_pk'=>$pk])->one();
            $searchObj->fsm_srchname = $name;
            if($searchObj->save()){
                 return [
                    'msg' => "success",
                    'status' => 1,
                    ];
            }else{
                return [
                    'msg' => "error",
                    'status' => 2,
                    ];
            }
        }
    }
    public static function deleteSavedResult($requestData){
        if($requestData != ''){
            $pk = $requestData['pk'];
            $dtlsTbl = \api\modules\mst\models\FavsrchdtlsTbl::find()->where(['fsd_favsrchmst_fk'=>$pk])->one();
            if($dtlsTbl != ''){
                $dtlsTbl->fsd_status = 2;
                $dtlsTbl->fsd_deletedon = date('Y-m-d H:i:s');
                $dtlsTbl->fsd_deletedby = \yii\db\ActiveRecord::getTokenData('user_pk', true);
                if(!$dtlsTbl->save()){
                    return [
                    'msg' => "error",
                    'status' => 2,
                    ];
                }
            }
            //\api\modules\mst\models\FavsrchmstTbl::find()->where(['favsrchmst_pk'=>$pk])->one()->delete();
            return [
                    'msg' => "success",
                    'status' => 1,
                    ];
        }
    }
    public static function getBsearchList($request){
        $request['keyword'] = Security::sanitizeArr($request['keyword'], "string_spl_char");
        $request['page'] = isset($request['page'])?$request['page']:0;
        $request['size'] = isset($request['size'])?$request['size']:10;
        switch ($request['searchby']){
            case 1: 
                return MembercompanymstTbl::getBserachCompanyList($request);
            case 2: 
                return \common\models\MemcompproddtlsTbl::getBsearchProductList($request);
            case 3: 
                return \common\models\MemcompservicedtlsTbl::getBsearchServiceList($request);
            case 4: 
                //TODO: Supplier Certification Implementation
                return [];
        }
    }
    
    public function getAdvancedFilterData($requestdata) {
        
        if (!empty($requestdata['companypks'])) {
            $companyPks = explode(",", Security::decrypt($requestdata['companypks']));
            $advancefilterdata = \common\models\MembercompanymstTbl::advancedFilterData($companyPks);
        } else {
            $userPks = explode(",", Security::decrypt($requestdata['userpks']));
            $advancefilterdata = \common\models\UsermstTblQuery::peopleAdvanceFilterData($userPks);
        }
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($advancefilterdata) ? $advancefilterdata : []
        ];
    }

    public function getSearchCriteria($criteraType, $isDemo){
        switch ($criteraType) {
            case '1': // Internal Criteria
                $finalQuery = self::internalCriteria();
                break;
            case '2': // Domain Criteria
                $finalQuery = Domainsearch::domainCriteria();
                break;
            case '3': // B2B
                $finalQuery = B2bsearch::b2bCriteria();
                break;
            case '5': // Domain Supplier
                $finalQuery = Domainsuppliersearch::domainSupplierCriteria($isDemo);
                break;
            case '6': // Domain Contractor
                $finalQuery = Domaincontractorsearch::domainContractorCriteria($isDemo);
                break;
            case '7': // Domain Buyer
                $finalQuery = Domainbuyersearch::domainBuyerCriteria($isDemo);
                break;
        }
        return $finalQuery;
    }

    /*Internal Search Starts*/
    function internalCriteria(){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);

        // stakeholder user count
        // $userQuery = self::companyUserCount($regPK);

        // // Stakeholder business unit count
        // $businessUnitQuery = self::companyBusinessUnitCount($cmpPK);

        // // Stakeholder monitor log count
        // $monitorLogQuery = self::companyMonitorLogUserCount($cmpPK);

        // // stakeholder product count
        // $productQuery = self::companyProductCount($cmpPK);

        // // stakeholder service count
        // $serviceQuery = self::companyServiceCount($cmpPK);

        // // Stakeholder market presence count
        // $marketPresenceQuery = self::companyMarketPresenceCount($cmpPK);
        // // stakeholder final query
        // $companyQuery = MembercompanymstTbl::find()
        //                     ->where(['MemberCompMst_Pk'=>$cmpPK])
        //                     ->addSelect([
        //                         'userCount'=>'('.$userQuery->createCommand()->getRawSql().')',
        //                         'businessUnitCount'=>'('.$businessUnitQuery->createCommand()->getRawSql().')',
        //                         'logCount'=>'('.$monitorLogQuery->createCommand()->getRawSql().')',
        //                         'productCount'=>'('.$productQuery->createCommand()->getRawSql().')',
        //                         'serviceCount'=>'('.$serviceQuery->createCommand()->getRawSql().')',
        //                         'marketPresenceCount'=>'('.$marketPresenceQuery->createCommand()->getRawSql().')',
        //                     ]);
        // $companyResult = $companyQuery->asArray()->one();

        // $overAllCount = $companyResult['userCount'] + $companyResult['businessUnitCount'] + $companyResult['logCount'] + $companyResult['productCount'] + $companyResult['serviceCount'] + $companyResult['marketPresenceCount'];

        return [
            /*[
                'criteriaType'=>'1',
                'criteriaName'=>'All',
                'criteriaCount'=>str_pad($overAllCount, 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>[],
            ],*/
            [
                'criteriaType'=>'2',
                'criteriaName'=>'Users',
                // 'criteriaCount'=>str_pad($companyResult['userCount'], 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>['1', '2', '3','4', '6', '7', '9', '11'],
            ],
            [
                'criteriaType'=>'3',
                'criteriaName'=>'Divisions',
                // 'criteriaCount'=>str_pad($companyResult['businessUnitCount'], 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>['6', '7', '9', '11'],
            ],
            [
                'criteriaType'=>'4',
                'criteriaName'=>'Monitor User Log',
                // 'criteriaCount'=>str_pad($companyResult['logCount'], 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>['1', '2', '3','4', '6', '7', '9', '11'],
            ],
            [
                'criteriaType'=>'5',
                'criteriaName'=>'Products',
                // 'criteriaCount'=>str_pad($companyResult['productCount'], 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>['6'],
            ],
            [
                'criteriaType'=>'6',
                'criteriaName'=>'Services',
                // 'criteriaCount'=>str_pad($companyResult['serviceCount'], 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>['6'],
            ]
            ,[
                'criteriaType'=>'7',
                 'criteriaName'=>'Market Presence',
                // 'criteriaCount'=>str_pad($companyResult['marketPresenceCount'], 2, '0', STR_PAD_LEFT),
                'stakeholderType'=>['6', '7', '9', '11']
            ],
        ];
    }

    function companyUserCount($regPK){
        $userQuery = UsermstTbl::find()
                        ->select([
                            'COUNT(UserMst_Pk) as userCount'
                        ])
                        ->where([
                            'UM_MemberRegMst_Fk'=>$regPK,
                            'UM_Status'=>'A',
                            'UM_Type'=>'U'
                        ]);
        return $userQuery;
    }

    public function companyBusinessUnitCount($cmpPK){
        $businessUnitQuery = MemcompsectordtlsTbl::find()
                                ->select([
                                    'COUNT(MemCompSecDtls_Pk) as businessUnitCount'
                                ])
                                ->where([
                                    'MCSD_MemberCompMst_Fk'=>$cmpPK
                                ]);
        return $businessUnitQuery;
    }

    public function companyMonitorLogUserCount($cmpPK){
        $monitorLogQuery = UsermstTbl::find()
                            ->select([
                                'COUNT(DISTINCT(UserMst_Pk)) as logCount'
                            ])
                            ->where([
                                'MemberCompMst_Pk'=>$cmpPK,
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])
                            ->innerJoin('usermonitorlog_tbl','uml_usermst_fk = UserMst_Pk')
                            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->groupBy('MemberCompMst_Pk');
        return $monitorLogQuery;
    }

    public function companyProductCount($cmpPK){
        $productQuery = MemcompproddtlsTbl::find()
                            ->select([
                                'COUNT(MemCompProdDtls_Pk) as productCount'
                            ])
                            ->where([
                                'MCPrD_MemberCompMst_Fk'=>$cmpPK,
                            ])
                            ->andWhere(['not',['MCPrD_CreatedOn'=>null]])
                            ->andWhere(['!=', 'mcprd_isdeleted', 1]);
        return $productQuery;
    }

    public function companyServiceCount($cmpPK){
        $serviceQuery = MemcompservicedtlsTbl::find()
                            ->select([
                                'COUNT(MemCompServDtls_Pk) as serviceCount'
                            ])
                            ->where([
                                'MCSvD_MemberCompMst_Fk'=>$cmpPK
                            ])->andWhere(['!=', 'mcsvd_isdeleted', 1])
                            ->andWhere(['not',['MCSvD_CreatedOn'=>null]]);
        return $serviceQuery;
    }

    public function companyMarketPresenceCount($cmpPK){
        $marketPresenceQuery = MemcompmplocationdtlsTbl::find()
                                ->select([
                                    'COUNT(memcompmplocationdtls_pk) as marketPresenceCount'
                                ])
                                ->where([
                                    'mcmpld_membercompmst_fk'=>$cmpPK
                                ])
                                ->andWhere(['OR',
                                    ['in','mcmpld_locationtype',[1,2,3,4,6,7,8,11,12]]
                                ]);
        return $marketPresenceQuery;
    }

    public function getBizSearchData($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh='', $smartSrh =''){
        //print_r("Hello");die();
        switch ($searchType) {
            case '1': // Internal SearchgetBizSearchData
                $finalQuery = self::internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '2': // Domain Search
                $finalQuery = Domainsearch::domainSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh);
                break;
            case '3': // B2B
                $finalQuery = B2bsearch::b2bsearch($searchType,$criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '5': // Domain Supplier
                $finalQuery = Domainsuppliersearch::domainSupplierSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '6': // Domain Contractor
                $finalQuery = Domaincontractorsearch::domainContractorSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
            case '7': // Domain Buyer
                $finalQuery = Domainbuyersearch::domainBuyerSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh, $smartSrh);
                break;
        }

        if($triggerFrom == 1) {
            $pageSize = 4;
            $page = 0;
        } else {
            $pageSize = (isset($_REQUEST['pageSize']) && $_REQUEST['pageSize'] > 0)?$_REQUEST['pageSize']:'16';
            $page = ($searchPage > 0)?$searchPage:'0';
        }

    //echo $finalQuery->createCommand()->getRawSql();die(); 
  
        $searchProvider = new ActiveDataProvider([
            'query' => $finalQuery,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
        ]);

        $count = Yii::$app->db->createCommand($finalQuery->createCommand()->getRawSql())->queryAll();

        $searchRes['data'] = $providerData = $searchProvider->getModels();

        if($searchType == 1) {

            $driveCmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
            $driveUserpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
            if($criteriaType == 2 || $criteriaType == 4){
                $searchData = [];
                foreach ($providerData as $key => $userData) {
                    $driveImg = Drive::generateUrl($userData['imagePk'],$driveCmpPK,$driveUserpk);
                    $searchData[$key] = $userData;
                    $searchData[$key]['coverImg'] = $driveImg;
                }
                $searchRes['data'] = $searchData;
            } elseif($criteriaType == 3){ // Business Unit
                $businessUnitArr = [];
                foreach($providerData as $key => $businessUnit){
                    $businessUnitArr[$key] = $businessUnit;
                    $userCount = Internalsearch::businessUnitUserCount($businessUnit['bUnitPk']);
                    $businessUnitArr[$key]['userCount'] = (isset($userCount['userCount']) && ($userCount['userCount'] > 0))?$userCount['userCount']:'-';

                    $bSourceCount = Internalsearch::divisionBsourceCount($businessUnit['bUnitPk']);
                    $businessUnitArr[$key]['bsourceCount'] = (isset($bSourceCount['bSourceCount']) && ($bSourceCount['bSourceCount'] > 0))?$bSourceCount['bSourceCount']:'Nil'; 
                }
     
                $searchRes['data'] = $businessUnitArr;
            } elseif($criteriaType == 5 || $criteriaType == 6){ // Product & Service
                $searchData = [];
                foreach ($providerData as $key => $pdtSerData) {
                    $driveImg = Drive::generateUrl($pdtSerData['imagePK'],$driveCmpPK,$driveUserpk);
                    $searchData[$key] = $pdtSerData;
                    $searchData[$key]['coverImg'] = $driveImg;
                }
                $searchRes['data'] = $searchData;
            }
        }
        
        //print_r("kh");die();

        $searchRes['totalcount'] = count($count);
        $searchRes['size'] = $pageSize;
        $searchRes['page'] = $page;
        return $searchRes;
    }

    public function internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh='', $smartSrh=''){

        switch ($criteriaType) {
                case '2': // Users
                    $finalQuery = Internalsearch::userSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '3': // Business Unit
                    $finalQuery = Internalsearch::bunitSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '4': // Monitor Logs
                    $finalQuery = Internalsearch::monitorLogSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '5': // Products
                    $finalQuery = Internalsearch::productSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '6': // Services
                    $finalQuery = Internalsearch::serviceSearch($searchKey, $searchSort, $filterSrh, $smartSrh);
                    break;
                case '7': // Market Presence
                    $finalQuery = Internalsearch::marketPresenceSearch($searchKey, $searchSort, $filterSrh);
                    break;
            }
        // } else {
        //     $finalQuery=Querybuilder::combinationFilterSrc($searchKey, $searchSort, $filterSrh, $smartSrh, $criteriaType);
        // }
        
        
        return $finalQuery;
    }

    public function getDivision($cmpPK){
        $divisionDtls = MemcompsectordtlsTbl::find()
                                ->select([
                                    'MemCompSecDtls_Pk as divisionPk',
                                    'mcsd_businessunitrefname as divRefName',
                                    'mcsd_referenceno as divRefNo',
                                    'MCSD_SectorMst_Fk as sectorPk',
                                ])
                                ->where([
                                    'MCSD_MemberCompMst_Fk'=>$cmpPK
                                ])
                                ->orderBy(['mcsd_businessunitrefname'=>SORT_ASC])
                                ->asArray()->all();
        return $divisionDtls;
    }

    public function getDivisionSector($cmpPK){
        $sectorDtls = MemcompsectordtlsTbl::find()
                                ->select([
                                    'SectorMst_Pk as sectorPk',
                                    'SecM_SectorName as sectorName',
                                    'SectorMst_Pk as filterPk',
                                    'SecM_SectorName as filterName',
                                ])
                                ->leftJoin('sectormst_tbl','find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)')
                                ->where([
                                    'MCSD_MemberCompMst_Fk'=>$cmpPK
                                ])
                                ->groupBy('SectorMst_Pk')
                                ->orderBy(['SecM_SectorName'=>SORT_ASC])
                                ->asArray()->all();
        return $sectorDtls;
    }

    public function getDepartment($cmpPK){
        //print_r($cmpPK);die();
        $deptDetails = DepartmentmstTbl::find()
                        ->select([
                            'DepartmentMst_Pk as filterPk',
                            'DM_Name as filterName'
                        ])
                        ->where([
                            'DM_MembCompMst_Fk'=>$cmpPK,
                            'DM_Status'=>'1'
                        ])
                        ->orderBy(['filterName' => SORT_ASC])
                        ->asArray()->all();

        return $deptDetails;
    }

    public function getBusinessUnit($cmpPK) {
        // $bunitDetails = MemcompsectordtlsTbl::find()
        //                     ->select([
        //                         'MemCompSecDtls_Pk as sectorPk',
        //                         'SecM_SectorName as filterPk',
        //                         'SecM_SectorName as filterName'
        //                     ])
        //                     ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = MCSD_MemberCompMst_Fk')
        //                     ->leftJoin('sectormst_tbl','SectorMst_Pk = MCSD_SectorMst_Fk')
        //                     ->where([
        //                         'MemberCompMst_Pk'=>$cmpPK,
        //                         'SecM_Status'=>'A'
        //                     ])
        //                     ->asArray()->all();

        $bunitDetails = MemcompsectordtlsTbl::find()
                                ->select([
                                    'MemCompSecDtls_Pk as divisionPk',
                                    'mcsd_businessunitrefname as filterPk',
                                    'mcsd_businessunitrefname as filterName',
                                ])
                                ->where([
                                    'MCSD_MemberCompMst_Fk'=>$cmpPK
                                ])
                                ->asArray()->all();

        return $bunitDetails;
    }

    public function getMarketPresnceDetails($cmpPK){
        $marketPresenceDetails = MemcompmplocationdtlsTbl::find()
                                    ->select([
                                        'memcompmplocationdtls_pk as locPk',
                                        'mcmpld_officename as filterPk',
                                        'mcmpld_officename as filterName'
                                    ])
                                    ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                                    ->where([
                                        'MemberCompMst_Pk'=>$cmpPK
                                    ])
                                    ->asArray()->all();
        return $marketPresenceDetails;
    }

    public function getMarketPresnceCountryDetails($cmpPK){
        $marketPresenceDetails = MemcompmplocationdtlsTbl::find()
                                    ->select([
                                        'CountryMst_Pk as cntryPk',
                                        'CountryMst_Pk as filterPk',
                                        'CyM_CountryName_en as filterName'
                                    ])
                                    ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                                    ->leftJoin('countrymst_tbl','CountryMst_Pk = mcmpld_countrymst_fk')
                                    ->where([
                                        'MemberCompMst_Pk'=>$cmpPK,
                                        'CyM_Status'=>'A',
                                    ])
                                    ->groupBy('mcmpld_countrymst_fk')
                                    ->asArray()->all();
        return $marketPresenceDetails;
    }

    public function getProductDetails($cmpPK){
        $productDetails = MemcompproddtlsTbl::find()
                            ->select([
                                'MemCompProdDtls_Pk as pdtPk',
                                'MCPrD_DisplayName as filterPk',
                                'MCPrD_DisplayName as filterName'
                            ])
                            ->where([
                                'MCPrD_MemberCompMst_Fk'=>$cmpPK,
                                'MCPrD_SVFAdminApprovalStatus'=>'A',
                            ])
                            ->andWhere(['!=', 'mcprd_isdeleted', 1])
                            ->asArray()->all();
        return $productDetails;
    }

    public function getServiceDetails($cmpPK){
        $serviceDetails = MemcompservicedtlsTbl::find()
                            ->select([
                                'MemCompServDtls_Pk as servicePk',
                                'MCSvD_DisplayName as filterPk',
                                'MCSvD_DisplayName as filterName'
                            ])
                            ->where([
                                'MCSvD_MemberCompMst_Fk'=>$cmpPK,
                                'MCSvD_SVFAdminApprovalStatus'=>'A',
                            ])->andWhere(['!=', 'mcsvd_isdeleted', 1])
                            ->asArray()->all();
        return $serviceDetails;
    }

    public function getModulesDetails($cmpPK){
        $modulesDetails = BasemodulemstTbl::find()
                            ->select([
                                'bm.basemodulemst_pk as baseModPk',
                                'bm.bmm_name as filterPk',
                                'bm.bmm_name as filterName'
                            ])
                            ->from('basemodulemst_tbl bsm')
                            ->innerJoin('basemodulemst_tbl bm',' bm.basemodulemst_pk = bsm.bmm_basemodulemst_fk')
                            ->innerJoin('usermonitorlog_tbl','bsm.basemodulemst_pk = uml_basemodulemst_fk')
                            ->innerJoin('usermst_tbl','uml_usermst_fk = usermst_pk')
                            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->where([
                                'MemberCompMst_Pk'=>$cmpPK,
                                'bm.bmm_status'=>'1',
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])
                            ->groupBy('bm.basemodulemst_pk')
                            ->asArray()->all();
        return $modulesDetails;
    }

    public function getSubModulesDetails($cmpPK){
        $subModulesDetails = BasemodulemstTbl::find()
                            ->select([
                                'basemodulemst_pk as baseModPk',
                                'bmm_name as filterPk',
                                'bmm_name as filterName'
                            ])
                            ->innerJoin('usermonitorlog_tbl','basemodulemst_pk = uml_basemodulemst_fk')
                            ->innerJoin('usermst_tbl','uml_usermst_fk = usermst_pk')
                            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->where([
                                'MemberCompMst_Pk'=>$cmpPK,
                                'bmm_status'=>'1',
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])
                            ->groupBy('basemodulemst_pk')
                            ->asArray()->all();
        return $subModulesDetails;
    }

    public function getActionDetails($cmpPK){
        $actionDetails = UsermonitorlogTbl::find()
                            ->select([
                                'actionmst_pk as actionPk',
                                'acm_actionname as filterPk',
                                'acm_actionname as filterName'
                            ])
                            ->innerJoin('actionmst_tbl','uml_actperformed = actionmst_pk')
                            ->innerJoin('usermst_tbl','uml_usermst_fk = usermst_pk')
                            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->where([
                                'MemberCompMst_Pk'=>$cmpPK,
                                'acm_status'=>'1',
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])
                            ->groupBy('actionmst_pk')
                            ->asArray()->all();
        return $actionDetails;
    }

    public function getProductUsers($cmpPK){
        $productUsers = MembercompanymstTbl::find()
                            ->select([
                                'UserMst_Pk as userPk',
                                'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ") as filterPk',
                                'REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ") as filterName',
                            ])
                            ->from('membercompanymst_tbl mcm')
                            ->innerJoin('memcompproddtls_tbl mcprd','mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
                            ->innerJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcprd.mcprd_contactinfo)')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK,
                                'MCPrD_SVFAdminApprovalStatus'=>'A',
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])
                            ->groupBy('UserMst_Pk')
                            ->asArray()->all();
        return $productUsers;
    }

    public function getServiceUsers($cmpPK){
        $serviceUsers = MembercompanymstTbl::find()
                            ->select([
                                'UserMst_Pk as userPk',
                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterPk',
                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterName',
                            ])
                            ->from('membercompanymst_tbl mcm')
                            ->innerJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                            ->innerJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcsvd.mcsvd_contactinfo)')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK,
                                'MCSvD_SVFAdminApprovalStatus'=>'A',
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])
                            ->groupBy('UserMst_Pk')
                            ->asArray()->all();
        return $serviceUsers;
    }

    

    public function getServiceUser($cmpPK){
        $productUsers = MemcompservicedtlsTbl::find()
                            ->select([
                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterPk',
                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterName',
                            ])
                            ->leftJoin('usermst_tbl','find_in_set(UserMst_Pk,mcsvd_contactinfo)')
                            ->where([
                                'MCSvD_MemberCompMst_Fk'=>$cmpPK,
                                'MCSvD_SVFAdminApprovalStatus'=>'A',
                                'UM_Status'=>'A',
                                'UM_Type'=>'U'
                            ])->andWhere(['!=', 'mcsvd_isdeleted', 1])
                            ->groupBy('UserMst_Pk')
                            ->asArray()->all();
        return $productUsers;
    }

    public function getDesignationLevel($cmpPK){
        $desigationLevel = UsermstTbl::find()
                            ->select([
                                'designationlevelmst_pk as designationPk',
                                'dlm_desglevelname as filterPk',
                                'dlm_desglevelname as filterName',
                            ])
                            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                            ->leftJoin('designationlevelmst_tbl','designationlevelmst_pk = um_desiglevel')
                            ->where([
                                'MemberCompMst_Pk'=>$cmpPK,
                                'UM_Type'=>'U',
                                'UM_Status'=>'A'
                            ])
                            ->andWhere(['not',['dlm_desglevelname'=>null]])
                            ->groupBy('designationlevelmst_pk')
                            ->orderBy(['dlm_desglevelname'=>SORT_ASC])
                            ->asArray()->all();
        return $desigationLevel;
    }

    public function getProductDepartment($cmpPK){
        $productDepartment = MembercompanymstTbl::find()
                                ->select([
                                    'DepartmentMst_Pk as deptPk',
                                    'dm.DM_Name as filterPk',
                                    'dm.DM_Name as filterName'
                                ])
                                ->from('membercompanymst_tbl mcm')
                                ->innerJoin('memcompproddtls_tbl mcprd','mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
                                ->innerJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcprd.mcprd_contactinfo)')
                                ->innerJoin('departmentmst_tbl dm','dm.DepartmentMst_Pk = um.um_departmentmst_fk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'UM_Type'=>'U',
                                    'UM_Status'=>'A'
                                ])
                                ->groupBy('dm.DepartmentMst_Pk')
                                ->asArray()->all();
        return $productDepartment;
    }

    public function getServiceDepartment($cmpPK){
        $serviceDepartment = MembercompanymstTbl::find()
                                ->select([
                                    'DepartmentMst_Pk as deptPk',
                                    'dm.DM_Name as filterPk',
                                    'dm.DM_Name as filterName'
                                ])
                                ->from('membercompanymst_tbl mcm')
                                ->innerJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                ->innerJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcsvd.mcsvd_contactinfo)')
                                ->innerJoin('departmentmst_tbl dm','dm.DepartmentMst_Pk = um.um_departmentmst_fk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'UM_Type'=>'U',
                                    'UM_Status'=>'A'
                                ])
                                ->groupBy('dm.DepartmentMst_Pk')
                                ->asArray()->all();
        return $serviceDepartment;
    }

    public function getProductDesignationLevel($cmpPK){
        $productDesignationLevel = MembercompanymstTbl::find()
                                    ->select([
                                        'designationlevelmst_pk as designationPk',
                                        'dlm_desglevelname as filterPk',
                                        'dlm_desglevelname as filterName',
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->innerJoin('memcompproddtls_tbl mcprd','mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
                                    ->innerJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcprd.mcprd_contactinfo)')
                                    ->innerJoin('designationlevelmst_tbl dlm','dlm.designationlevelmst_pk = um.um_desiglevel')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK,
                                        'UM_Type'=>'U',
                                        'UM_Status'=>'A'
                                    ])
                                    ->groupBy('dlm.designationlevelmst_pk')
                                    ->asArray()->all();
        return $productDesignationLevel;
    }

    public function getServiceDesignationLevel($cmpPK){
        $serviceDesignationLevel = MembercompanymstTbl::find()
                                    ->select([
                                        'designationlevelmst_pk as designationPk',
                                        'dlm_desglevelname as filterPk',
                                        'dlm_desglevelname as filterName',
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->innerJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                    ->innerJoin('usermst_tbl um','find_in_set(um.UserMst_Pk,mcsvd.mcsvd_contactinfo)')
                                    ->innerJoin('designationlevelmst_tbl dlm','dlm.designationlevelmst_pk = um.um_desiglevel')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK,
                                        'UM_Type'=>'U',
                                        'UM_Status'=>'A'
                                    ])
                                    ->groupBy('dlm.designationlevelmst_pk')
                                    ->asArray()->all();
        return $serviceDesignationLevel;
    }

    public function getProductBusinessUnit($cmpPK,$srcType=null){
        $productBusinessUnit = MemcompproddtlsTbl::find()
                                ->select([
                                    'MemCompSecDtls_Pk as sectorPk',
                                    'mcsd_businessunitrefname as filterPk',
                                    'concat_ws(" - ", mcsd_businessunitrefname, mcsd_referenceno) as filterName',
                                ])
                                ->from('memcompproddtls_tbl mcprd')
                                ->innerJoin('memcompprodbussrcmap_tbl mcpbm','mcpbm.mcpbsm_memcompproddtls_fk = mcprd.MemCompProdDtls_Pk')
                                ->innerJoin('memcompbussrcdtls_tbl mcbsd','mcbsd.memcompbussrcdtls_pk = mcpbm.mcpbsm_memcompbussrcdtls_fk')
                                ->leftJoin('memcompsectordtls_tbl mcsd','mcsd.MemCompSecDtls_Pk = mcbsd.mcbsd_memcompsecdtls_fk');
                                if(is_null($srcType)){
                                    $productBusinessUnit->where([
                                        'mcprd.MCPrD_MemberCompMst_Fk'=>$cmpPK
                                    ])->andWhere(['!=', 'mcprd_isdeleted', 1]);
                                }elseif($srcType=='b2b'){
                                    $productBusinessUnit->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = MCPrD_MemberCompMst_Fk')
                                    ->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk');
                                    $productBusinessUnit->where([
                                    'MRM_MemberStatus' => 'A',
                                    'MRM_ValSubStatus' => 'A',
                                    'mrm_stkholdertypmst_fk' => '6',
                                    'MCPrD_isdeleted' => '2'
                                    ])->andWhere(['not',['MCPrD_CreatedOn'=>null]])->andWhere(['!=', 'mcprd_isdeleted', 1])->andWhere(['!=', 'mcprd_isdeleted', 1]);
                                }
                                $productBusinessUnit->groupBy('MemCompSecDtls_Pk')
                                ->orderBy(['mcsd_businessunitrefname'=>SORT_ASC])
                                ->asArray();
                                $productBusinessUnit=$productBusinessUnit->createCommand()->queryAll();

        return $productBusinessUnit;
    }

    public function getServiceBusinessUnit($cmpPK,$srcType=null){
        $serviceBusinessUnit = MemcompservicedtlsTbl::find()
                                ->select([
                                        'MemCompSecDtls_Pk as sectorPk',
                                        'mcsd_businessunitrefname as filterPk',
                                        'concat_ws(" - ", mcsd_businessunitrefname, mcsd_referenceno) as filterName',
                                    ])
                                ->from('memcompservicedtls_tbl mcs')
                                ->innerJoin('memcompservbussrcmap_tbl mcsbm','mcsbm.mcsbsm_memcompservdtls_fk = mcs.MemCompServDtls_Pk')
                                ->innerJoin('memcompbussrcdtls_tbl mcbsd','mcbsd.memcompbussrcdtls_pk = mcsbm.mcsbsm_memcompbussrcdtls_fk')
                                ->leftJoin('memcompsectordtls_tbl mcsd','mcsd.MemCompSecDtls_Pk = mcbsd.mcbsd_memcompsecdtls_fk');
                                if(is_null($srcType)){
                                    $serviceBusinessUnit->where([
                                    'mcs.MCSvD_MemberCompMst_Fk'=>$cmpPK
                                    ]);
                                }elseif($srcType=='b2b'){
                                    $serviceBusinessUnit->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = MCSvD_MemberCompMst_Fk')
                                    ->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk');
                                    $serviceBusinessUnit->where([
                                    'MRM_MemberStatus' => 'A',
                                    'MRM_ValSubStatus' => 'A',
                                    'mrm_stkholdertypmst_fk' => '6',
                                    'MCSvD_isdeleted' => '2'
                                    ])->andWhere(['not',['MCSvD_CreatedOn'=>null]])->andWhere(['!=', 'mcsvd_isdeleted', 1]);
                                    
                                }
                                $serviceBusinessUnit->groupBy('MemCompSecDtls_Pk')
                                ->orderBy(['mcsd_businessunitrefname'=>SORT_ASC])
                                ->asArray();
                                $serviceBusinessUnit=$serviceBusinessUnit->createCommand()->queryAll();
        return $serviceBusinessUnit;
    }

    public function getMarketTypePresence($cmpPK){
        $productMarketPresence = MembercompanymstTbl::find()
                                    ->select([
                                        'mcmpld_locationtype as filterPk',
                                        '(case mcmpld_locationtype when 1 then "Primary" when 2 then "Branch Office" when 3 then "Representative" when 4 then "Factory/Manufacture" when 5 then "Trading" when 6 then "Wholesale/Distributor" when 7 then "Retailer" when 8 then "Agent" when 9 then "Government Agency/Organization" when 10 then "Stockist" when 11 then "Trade House" when 13 then "Port" when 14 then "Clientele" when 15 then "Principle" when 12 then "Other Market Presence" end) as filterName'
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK
                                    ])
                                    ->andWhere(['OR',
                                        ['in','mcmpld_locationtype',[1,2,3,4,6,7,8,11,12]]
                                    ])
                                    ->groupBy('mcmpld_locationtype')
                                    ->asArray()->all();
        return $productMarketPresence;
    }

    public function getProductBusinessSource($cmpPK,$srcType=null){
        $productBsource = MembercompanymstTbl::find()
                            ->select([
                                'businesssourcemst_pk as bSourcePk',
                                'bsm_bussrcname as filterPk',
                                'bsm_bussrcname as filterName',
                            ])
                            ->from('membercompanymst_tbl mcm')
                            ->innerJoin('memcompproddtls_tbl mcprd','mcm.MemberCompMst_Pk = mcprd.MCPrD_MemberCompMst_Fk')
                            ->innerJoin('memcompprodbussrcmap_tbl mcpbm','mcpbm.mcpbsm_memcompproddtls_fk = mcprd.MemCompProdDtls_Pk')
                            ->innerJoin('memcompbussrcdtls_tbl mcbsd','mcbsd.memcompbussrcdtls_pk = mcpbm.mcpbsm_memcompbussrcdtls_fk')
                            ->innerJoin('businesssourcemst_tbl bsm','bsm.businesssourcemst_pk = mcbsd.mcbsd_businesssourcemst_fk');
                            if(is_null($srcType)){
                            $productBsource->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK
                            ]);
                            }elseif($srcType=='b2b'){
                                $productBsource->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk');
                                $productBsource->where([
                                    'MRM_MemberStatus' => 'A',
                                    'MRM_ValSubStatus' => 'A',
                                    'mrm_stkholdertypmst_fk' => '6',
                                    'mcprd_isdeleted' => '2'
                                ])->andWhere(['not',['MCPrD_CreatedOn'=>null]]);
                            }
                            $productBsource->groupBy('businesssourcemst_pk')
                            ->orderBy(['bsm_bussrcname'=>SORT_ASC])
                            ->asArray();
                            $productBsource=$productBsource->createCommand()->queryAll();
            return $productBsource;
    }

    public function getServiceBusinessSource($cmpPK,$srcType=null){
        $serviceBsource = MembercompanymstTbl::find()
                            ->select([
                                'businesssourcemst_pk as bSourcePk',
                                'bsm_bussrcname as filterPk',
                                'bsm_bussrcname as filterName',
                            ])
                            ->from('membercompanymst_tbl mcm')
                            ->innerJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                            ->innerJoin('memcompservbussrcmap_tbl mcsbm','mcsbm.mcsbsm_memcompservdtls_fk = mcsvd.MemCompServDtls_Pk')
                            ->innerJoin('memcompbussrcdtls_tbl mcbsd','mcbsd.memcompbussrcdtls_pk = mcsbm.mcsbsm_memcompbussrcdtls_fk')
                            ->innerJoin('businesssourcemst_tbl bsm','bsm.businesssourcemst_pk = mcbsd.mcbsd_businesssourcemst_fk');
                            if(is_null($srcType)){
                                $serviceBsource->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK
                                ]);
                            }elseif($srcType=='b2b'){
                                $serviceBsource->innerJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk');
                                $serviceBsource->where([
                                    'MRM_MemberStatus' => 'A',
                                    'MRM_ValSubStatus' => 'A',
                                    'mrm_stkholdertypmst_fk' => '6',
                                    'MCSvD_isdeleted' => '2'
                                ])->andWhere(['not',['MCSvD_CreatedOn'=>null]]);
                            }
                            $serviceBsource->groupBy('businesssourcemst_pk')
                            ->orderBy(['bsm_bussrcname'=>SORT_ASC])
                            ->asArray();
                            $serviceBsource=$serviceBsource->createCommand()->queryAll();
        return $serviceBsource;
    }

    public function getBunitBusinessSource($cmpPK){

        $bunitBsource = BusinesssourcemstTbl::find()
                            ->select([
                                'bsm_bussrcname as filterPk',
                                'bsm_bussrcname as filterName',
                            ])
                            ->from('businesssourcemst_tbl bsm')
                            ->leftJoin('memcompbussrcdtls_tbl mcbsd','mcbsd.mcbsd_businesssourcemst_fk = bsm.businesssourcemst_pk')
                            ->where([
                                'mcbsd.mcbsd_membercompanymst_fk'=>$cmpPK,
                                'bsm.bsm_status'=>1
                            ])
                            ->groupBy('bsm.businesssourcemst_pk')
                            ->asArray()->all();

            
                            //print_r($bunitBsource);die();
        return $bunitBsource;
    }

    public function getBunitDepartment($cmpPK){
        $bunitDepartment = UsermstTbl::find()
                            ->select([
                                'DepartmentMst_Pk as deptPk',
                                'DM_Name as filterPk',
                                'DM_Name as filterName'
                            ])
                            ->from('usermst_tbl um')
                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                            ->leftJoin('departmentmst_tbl dm','um.um_departmentmst_fk = dm.DepartmentMst_Pk')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK,
                                'DM_Status'=>'1'
                            ])
                            ->groupBy('dm.DepartmentMst_Pk')
                            ->asArray()->all();
        return $bunitDepartment;
    }

    public function getBunitDesignation($cmpPK){
        $bunitDesignation= UsermstTbl::find()
                            ->select([
                                'dsg.designationmst_pk as designationPk',
                                'dsg.dsg_designationname as filterPk',
                                'dsg.dsg_designationname as filterName',
                            ])
                            ->from('usermst_tbl um')
                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                            ->leftJoin('designationmst_tbl dsg','dsg.designationmst_pk = um.UM_Designation')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK,
                                'UM_Type'=>'U',
                                'UM_Status'=>'A'
                            ])
                            ->groupBy('dsg.designationmst_pk')
                            ->asArray()->all();
        return $bunitDesignation;
    }

    public function getProjectBusinessunit($cmpPK){
        $projectBunit = SectormstTbl::find()
                            ->select([
                                'sm.SectorMst_Pk as sectorPk',
                                'sm.SecM_SectorName as filterPk',
                                'sm.SecM_SectorName as filterName',
                            ])
                            ->from('sectormst_tbl sm')
                            ->leftJoin('projectdtls_tbl prjd','prjd.prjd_sectormst_fk = sm.SectorMst_Pk')
                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = prjd.prjd_memberregmst_fk')
                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK,
                                'sm.SecM_Status'=>'A'
                            ])
                            ->asArray()->all();
        return $projectBunit;
    }

    public function getProjectSelection($cmpPK){
        $projectSelection = SectormstTbl::find()
                                ->select([
                                    'prjd.projectdtls_pk as projectPk',
                                    'prjd.prjd_projname as filterPk',
                                    'prjd.prjd_projname as filterName',
                                ])
                                ->from('sectormst_tbl sm')
                                ->leftJoin('projectdtls_tbl prjd','prjd.prjd_sectormst_fk = sm.SectorMst_Pk')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = prjd.prjd_memberregmst_fk')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'sm.SecM_Status'=>'A'
                                ])
                                ->asArray()->all();
        return $projectSelection;
    }

    public function getProjectStatus($cmpPK){
        $projectSelection = SectormstTbl::find()
                                ->select([
                                    'prjd.projectdtls_pk as projectPk',
                                    'prjd.prjd_projstatus as filterPk',
                                    '(case prjd.prjd_projstatus when "1" then "Yet to Submit" when "2" then "Posted for Validation" when "3" then "Approved" when "4" then "Declined" when "5" then "Re-Submitted" end) as filterName',

                                ])
                                ->from('sectormst_tbl sm')
                                ->leftJoin('projectdtls_tbl prjd','prjd.prjd_sectormst_fk = sm.SectorMst_Pk')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = prjd.prjd_memberregmst_fk')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'sm.SecM_Status'=>'A'
                                ])
                                ->asArray()->all();
        return $projectSelection;
    }

    public function getLicenseBusinessunit($cmpPK){
        $lisenceBunit = SectormstTbl::find()
                                ->select([
                                    'sm.SectorMst_Pk as sectorPk',
                                    'sm.SecM_SectorName as filterPk',
                                    'sm.SecM_SectorName as filterName',
                                ])
                                ->from('sectormst_tbl sm')
                                ->leftJoin('licensinginfo_tbl li','li.li_sectormst_fk = sm.SectorMst_Pk')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = li.li_memberregmst_fk')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'sm.SecM_Status'=>'A'
                                ])
                                ->asArray()->all();
        return $lisenceBunit;
    }

    public function getProductSelection($cmpPK){
        $productSelection = MembercompanymstTbl::find()
                                ->select([
                                    'pm.PrdM_ProductName as filterPk',
                                    'pm.PrdM_ProductName as filterName',
                                ])
                                ->from('membercompanymst_tbl mcm')
                                ->leftJoin('memcompproddtls_tbl mcprd','mcprd.MCPrD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('productmst_tbl pm','pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'MCPrD_SVFAdminApprovalStatus'=>'A'
                                ])
                                ->groupBy('pm.ProductMst_Pk')
                                ->asArray()->all();

                                //print_r($productSelection);die();
        return $productSelection;
    }

    public function getServiceSelection($cmpPK){
        $serviceSelection = MembercompanymstTbl::find()
                                ->select([
                                    'sm.SrvM_ServiceName as filterPk',
                                    'sm.SrvM_ServiceName as filterName',
                                ])
                                ->from('membercompanymst_tbl mcm')
                                ->leftJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('servicemst_tbl sm','sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK,
                                    'MCSvD_SVFAdminApprovalStatus'=>'A'
                                ])
                                ->groupBy('sm.ServiceMst_Pk')
                                ->asArray()->all();
        return $serviceSelection;
    }

    public function getMarketPresenceState($cmpPK){
        $marketPresenceDetails = MemcompmplocationdtlsTbl::find()
                                    ->select([
                                        'StateMst_Pk as statePk',
                                        'StateMst_Pk as filterPk',
                                        'SM_StateName_en as filterName'
                                    ])
                                    ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                                    ->leftJoin('statemst_tbl','StateMst_Pk = mcmpld_statemst_fk')
                                    ->where([
                                        'MemberCompMst_Pk'=>$cmpPK,
                                        'SM_Status'=>'A',
                                    ])
                                    ->groupBy('StateMst_Pk')
                                    ->asArray()->all();
        return $marketPresenceDetails;
    }

    public function getMarketPresenceCity($cmpPK){
        $marketPresenceDetails = MemcompmplocationdtlsTbl::find()
                                    ->select([
                                        'CityMst_Pk as cityPk',
                                        'CityMst_Pk as filterPk',
                                        'CM_CityName_en as filterName'
                                    ])
                                    ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                                    ->leftJoin('citymst_tbl','CityMst_Pk = mcmpld_citymst_fk')
                                    ->where([
                                        'MemberCompMst_Pk'=>$cmpPK,
                                        'CM_Status'=>'A',
                                    ])
                                    ->groupBy('CityMst_Pk')
                                    ->asArray()->all();
        return $marketPresenceDetails;
    }

    public function getMarketPresenceBranchId($cmpPK){
        $marketPresenceDetails = MemcompmplocationdtlsTbl::find()
                                    ->select([
                                        'memcompmplocationdtls_pk as locationPk',
                                        'mcmpld_branchid as filterPk',
                                        'mcmpld_branchid as filterName'
                                    ])
                                    ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                                    ->where([
                                        'MemberCompMst_Pk'=>$cmpPK,
                                        'mcmpld_locationtype'=>'2'
                                    ])
                                    ->groupBy('memcompmplocationdtls_pk')
                                    ->asArray()->all();
        return $marketPresenceDetails;
    }

    public function getProductMarketType($cmpPK){
        $productMarketPresence = MembercompanymstTbl::find()
                                    ->select([
                                        'mcmpld_locationtype as filterPk',
                                        '(case mcmpld_locationtype when 1 then "Primary" when 2 then "Branch Office" when 3 then "Representative" when 4 then "Factory / Manufacture" when 5 then "Trading" when 6 then "Wholesale / Distributor" when 7 then "Retailer" when 8 then "Agent" when 9 then "Government Agency / Organization" when 10 then "Stockist" when 11 then "Trade House" when 13 then "Port" when 14 then "Clientele" when 15 then "Principle" when 12 then "Others" end) as filterName'
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->leftJoin('memcompproddtls_tbl mcprd','mcprd.MCPrD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('productmst_tbl pm','pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK
                                    ])
                                    ->groupBy('mcmpld_locationtype')
                                    ->asArray()->all();
        return $productMarketPresence;
    }

    public function getMarketPresenceProduct($cmpPK){
        $productMarketPresence = MembercompanymstTbl::find()
                                    ->select([
                                        'PrdM_ProductName as filterPk',
                                        'PrdM_ProductName as filterName'
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->leftJoin('memcompproddtls_tbl mcprd','mcprd.MCPrD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('productmst_tbl pm','pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK
                                    ])
                                    ->groupBy('pm.ProductMst_Pk')
                                    ->asArray()->all();
        return $productMarketPresence;
    }

    public function getServiceMarketType($cmpPK){
        $serviceMarketPresence = MembercompanymstTbl::find()
                                    ->select([
                                        'mcmpld_locationtype as filterPk',
                                        '(case mcmpld_locationtype when 1 then "Primary" when 2 then "Branch Office" when 3 then "Representative" when 4 then "Factory / Manufacture" when 5 then "Trading" when 6 then "Wholesale / Distributor" when 7 then "Retailer" when 8 then "Agent" when 9 then "Government Agency / Organization" when 10 then "Stockist" when 11 then "Trade House" when 13 then "Port" when 14 then "Clientele" when 15 then "Principle" when 12 then "Others" end) as filterName'
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->leftJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('servicemst_tbl sm','sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK
                                    ])
                                    ->groupBy('mcmpld_locationtype')
                                    ->asArray()->all();
        return $serviceMarketPresence;
    }

    public function getMarketPresenceService($cmpPK){
        $serviceMarketPresence = MembercompanymstTbl::find()
                                    ->select([
                                        'SrvM_ServiceName as filterPk',
                                        'SrvM_ServiceName as filterName'
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->leftJoin('memcompservicedtls_tbl mcsvd','mcsvd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('memcompmplocationdtls_tbl mcld','mcld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('servicemst_tbl sm','sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk')
                                    ->where([
                                        'mcm.MemberCompMst_Pk'=>$cmpPK
                                    ])
                                    ->groupBy('sm.ServiceMst_Pk')
                                    ->asArray()->all();
        return $serviceMarketPresence;
    }

    public function projectTeamMembers($cmpPK){
        $projectTeamMember = UsermstTbl::find()
                                ->select([
                                    'UserMst_Pk as userPk',
                                    'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterPk',
                                    'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterName',
                                ])
                                ->from('usermst_tbl um')
                                ->innerJoin('projectdtls_tbl prjd','find_in_set(um.UserMst_Pk,prjd.prjd_projteam)')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK
                                ])
                                ->groupBy('UserMst_Pk')
                                ->asArray()->all();
        return $projectTeamMember;
    }

    public function projectContactMembers($cmpPK){
        $projectContactMember = UsermstTbl::find()
                                ->select([
                                    'UserMst_Pk as userPk',
                                    'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterPk',
                                    'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterName',
                                ])
                                ->from('usermst_tbl um')
                                ->innerJoin('projectdtls_tbl prjd','find_in_set(um.UserMst_Pk,prjd.prjd_contactinfo)')
                                ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                                ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                ->where([
                                    'mcm.MemberCompMst_Pk'=>$cmpPK
                                ])
                                ->groupBy('UserMst_Pk')
                                ->asArray()->all();
        return $projectContactMember;
    }

    public function userProjectSelection($regPK){
        $userProject = ProjectdtlsTbl::find()
                        ->select([
                            'prjd_projname as filterPk',
                            'prjd_projname as filterName',
                        ])
                        ->from('projectdtls_tbl prjd')
                        ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = prjd.prjd_memberregmst_fk')
                        ->where([
                            'prjd_memberregmst_fk'=>$regPK
                        ])
                        ->asArray()->all();
        return $userProject;
    }

    public function userProjectStatus($cmpPK){
        $projectStatus = UsermstTbl::find()
                            ->select([
                                'prjd.projectdtls_pk as projectPk',
                                'prjd.prjd_projstatus as filterPk',
                                '(case prjd.prjd_projstatus when "1" then "Yet to Submit" when "2" then "Posted for Validation" when "3" then "Approved" when "4" then "Declined" when "5" then "Re-Submitted" end) as filterName',
                            ])
                            ->from('usermst_tbl um')
                            ->innerJoin('projectdtls_tbl prjd','find_in_set(um.UserMst_Pk,prjd.prjd_contactinfo)')
                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK
                            ])
                            ->groupBy('UserMst_Pk')
                            ->asArray()->all();
        return $projectStatus;
    }

    public function svfValidationProcessContact($cmpPK){
        $svfContactUser = UsermstTbl::find()
                            ->select([
                                'UserMst_Pk as userPk',
                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterPk',
                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterName',
                            ])
                            ->from('usermst_tbl um')
                            ->leftJoin('suppcertformpartrntmp_tbl cvpc','cvpc.scfptt_paramvalue = um.UserMst_Pk and cvpc.scfptt_bgivaldocsubcatmst_fk = 98')
                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                            ->where([
                                'mcm.MemberCompMst_Pk'=>$cmpPK
                            ])
                            ->groupBy('UserMst_Pk')
                            ->asArray()->all();
        return $svfContactUser;
    }

    public function svfBusinessDevelopmentContact($cmpPK){
        $BusinessDevelopmentContactUser = UsermstTbl::find()
                                            ->select([
                                                'UserMst_Pk as userPk',
                                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterPk',
                                                'concat_ws(" ", um_firstname, um_middlename, um_lastname) as filterName',
                                            ])
                                            ->from('usermst_tbl um')
                                            ->leftJoin('suppcertformpartrntmp_tbl bdc','bdc.scfptt_paramvalue = um.UserMst_Pk and bdc.scfptt_bgivaldocsubcatmst_fk = 99')
                                            ->leftJoin('memberregistrationmst_tbl mrm','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk')
                                            ->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                                            ->where([
                                                'mcm.MemberCompMst_Pk'=>$cmpPK
                                            ])
                                            ->groupBy('UserMst_Pk')
                                            ->asArray()->all();
        return $BusinessDevelopmentContactUser;
    }
    
    public static function getSavedResult($request) {
        //ini_set('max_execution_time', -1);
        $response = [];
        $regPk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $regPk = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        
        $searchType = ['1' => 'Internal', '2' => 'Domain','3' => 'Suppliers Network','4' => 'Universal'];
        $bizSearchTypeArr = ['1' => 'All', '2' => 'Users', '3' => 'Divisions', '4' => 'Monitor User Log', 
         '5' => 'Products', '6' => 'Services', '7' => 'Market presence'];

        $b2bSearchTypeArr = ['1' => 'All', '2' => 'Supplier', '3' => 'Product', '4' => 'Service', 
         '5' => 'People'];

        $data = \api\modules\mst\models\FavsrchmstTbl::getSavedResults($request, $regPk, $userPk);
        

        $response['count'] = $data['totalCount'];
        foreach($data['data'] as $key => $val) {

            $savedOn = \common\components\Common::convertDateTimeToUserTimezone($val->fsm_createdon, 'd-m-Y');
            if($savedOn == ''){
                $savedOn = date('d-m-Y',strtotime($val->fsm_createdon));
            }

            $response['data'][$key]['pk'] = $val->favsrchmst_pk;
            $response['data'][$key]['searchName'] = $val->fsm_srchname;
            $response['data'][$key]['savedOn'] = $savedOn;
            $response['data'][$key]['previousCount'] = $val->favsrchdtl->fsd_prevsrchcnt;
            $response['data'][$key]['currentCount'] = 0;

            $response['data'][$key]['criteriaBag'] = json_decode($val->favsrchdtl->fsd_criteriabag, true)['savedata'];

            $response['data'][$key]['searchType'] = $searchType[$response['data'][$key]['criteriaBag']['searchType']];

            if($response['data'][$key]['searchType'] == 'Internal') {

                $response['data'][$key]['criteriaType'] = $bizSearchTypeArr[$response['data'][$key]['criteriaBag']['criteriaType']];


            } else if($response['data'][$key]['searchType'] == 'Suppliers Network') {

                $response['data'][$key]['criteriaType'] = $b2bSearchTypeArr[$response['data'][$key]['criteriaBag']['criteriaType']];

            } 
            $response['data'][$key]['criteriaType'] = $bizSearchTypeArr[$response['data'][$key]['criteriaBag']['criteriaType']];

            $response['data'][$key]['fieldFormationValue'] = [];
            if($response['data'][$key]['criteriaType'] !== 1){
                $response['data'][$key]['fieldFormationValue'] = self::savedResultFieldFormation($response['data'][$key]['criteriaBag']['searchType'],$response['data'][$key]['criteriaBag']['criteriaType']);
            }
            $keyword = $response['data'][$key]['criteriaBag']['keyword'];
            $response['data'][$key]['keyword'] = (count($keyword) > 0) ? $keyword : !empty($keyword) ? $keyword : '';
            if($val->favsrchdtl->fsd_srchtype == 'ALL') {
                $fullQuery = Security::decrypt($val->favsrchdtl->fsd_criteria);
                $queries = !empty($fullQuery) ? explode('#', $fullQuery) : [];
                foreach($queries as $query) {
                    $response['data'][$key]['currentCount'] += !empty($query) ? count(Yii::$app->db->createCommand($query)->queryAll()) : 0;
                }
            } else {
                $query = Security::decrypt($val->favsrchdtl->fsd_criteria);
                // $response['data'][$key]['currentCount'] = !empty($query) ? count(Yii::$app->db->createCommand($query)->queryAll()) : 0;
            }
        }
        return $response;
    }

    public static function savedResultFieldFormation($searchType, $criteriaType) {
        switch ($searchType) {
            case 1: // Internal
                switch ($criteriaType) {
                    case 1:
                        break;
                    case 2:
                        $ret = Userfilter::saveSearchDtls();
                        break;
                    case 3:
                        $ret = Businessunitfilter::saveSearchDtls();
                        break;
                    case 4:
                        $ret = Monitorlogfilter::saveSearchDtls();
                        break;
                    case 5:
                        $ret = Productfilter::saveSearchDtls();
                        break;
                    case 6:
                        $ret = Servicefilter::saveSearchDtls();
                        break;
                    case 7:
                        $ret = Marketpresencefilter::saveSearchDtls();
                        break;
                }
                break;
            case 2: // Domain
                switch ($criteriaType) {
                    case 2:
                        $ret = Companyprofilefilter::saveSearchDtls();
                        break;
                }
                break;
        }
        return $ret;
    }
    
    public function saveHistory($criteriaType, $searchType, $searchKey, $searchFrom, $searchSort, $filterSrh, $historyType) {
        $detailsToSave = [];
        $bizSearchTypeArr = ['1' => 'All', '2' => 'U', '3' => 'BU', '4' => 'ML', 
         '5' => 'P', '6' => 'S', '7' => 'MP'];
        $searchTypeAbbreviated = ['1' => 'Internal', '2' => 'Domain','3' => 'B2B','4' => 'Universal'];
        $bizSearchTypeAbbreviatedArr = ['1' => 'All', '2' => 'Users', '3' => 'Division', '4' => 'Monitor Logs', 
         '5' => 'Products', '6' => 'Services', '7' => 'Market presence','8'=>'Company'];
        if (isset($searchSort) && $searchSort == 'Desc') {
            $searchSort = 'Desc';
        } else {
            $searchSort = 'ASC';
        }
        $querySplitter = '#';
        $critype = $bizSearchTypeAbbreviatedArr[$criteriaType];
        if($searchTypeAbbreviated[$searchType] == 'Domain'){
            $critype = 'Company';
        }
        $detailsToSave['criteriaBag'] = [
            'searchType' => $searchType,
            'criteriaType' => $criteriaType,
            'searchTypeStr' => $searchTypeAbbreviated[$searchType],
            'criteriaTypeStr' => $critype,
            'keyword' => $searchKey,
            'filterData' => $filterSrh
        ];
        
        $detailsToSave['searchType'] = $bizSearchTypeArr[$criteriaType];
        if($historyType == 'all'){
            $detailsToSave['searchType'] = 'ALL';
            $detailsToSave['criteriaBag']['criteriaType'] = 1;
            $detailsToSave['criteriaBag']['criteriaTypeStr'] = 'ALL';
        }
        
//        $detailsToSave['criteriaBag'] = json_encode($detailsToSave['criteriaBag'], JSON_UNESCAPED_SLASHES);
        
        if ($criteriaType == 1) {
            for ($i = 2; $i <= 7; $i++) {
                $searchQuery = '';
                $searchQuery = self::internalSearch($i, $searchKey, $searchFrom, $searchSort, $filterSrh);
                $detailsToSave['rawQuery'] .= $searchQuery->createCommand()->getRawSql();
                if ($i != 7) {
                    $detailsToSave['rawQuery'] .= $querySplitter;
                }
            }
            $detailsToSave['rawQuery'] = Security::encrypt($detailsToSave['rawQuery']);
        } else {
            $searchQuery = self::internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh);
            $detailsToSave['rawQuery'] = Security::encrypt($searchQuery->createCommand()->getRawSql());
        }
             
        $detailsToSave['searchBy'] = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $detailsToSave['comp_pk'] = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        
        return \common\models\BizsearchhstyTbl::saveSearchHistory($detailsToSave);
               
    }
    
    public function getSavedHistory() {
        $response = [];
        $searchType = ['1' => 'Internal', '2' => 'Domain','3' => 'B2B','4' => 'Universal'];
        $bizSearchTypeArr = ['1' => 'All', '2' => 'Users', '3' => 'Division', '4' => 'Monitor Logs', 
         '5' => 'Products', '6' => 'Services', '7' => 'Market presence'];
        $historyDtls = \common\models\BizsearchhstyTbl::getSavedHistory();
        
        $historyDates = array_map(function($hsty){
            return date('d-m-Y', strtotime($hsty['bsh_searchon']));
        },$historyDtls);
        
        $historyDates = array_values(array_unique($historyDates));
        $response['data'] = [];
        foreach($historyDates as $key => $hstryDate) {
            $i = 0;
            $response['data'][$key]['date'] = self::checkDateisTodayorYesterday($hstryDate).date('l, d-m-Y', strtotime($hstryDate));
            foreach($historyDtls as $history) {
                if($hstryDate == date('d-m-Y', strtotime($history['bsh_searchon']))){
                    $response['data'][$key]['history'][$i]['time'] = date('H:i', strtotime($history['bsh_searchon']));
                    $jsondata = json_decode($history['bsh_criteriabag'], true);
                    $srchType = $searchType[$jsondata['searchType']];
                    $criteriaType = $bizSearchTypeArr[$jsondata['criteriaType']];
                    if($srchType == 'Domain'){
                        $criteriaType = 'Company';
                    }
                    $response['data'][$key]['history'][$i]['name'] = $srchType. " - ".$criteriaType;
                    $response['data'][$key]['history'][$i]['history_pk'] = $history['bizsearchhsty_pk'];
                    $i++;
                }
            }
        }
        $response['allHistory'] = Security::encrypt(json_encode(array_column($historyDtls,'bizsearchhsty_pk')));
        return $response;
    }

    public static function checkDateisTodayorYesterday($historyDate) {
        $historyDate = date('d-m-Y', strtotime($historyDate));
        $today = date('d-m-Y', strtotime('today'));
        $yesterday = date('d-m-Y', strtotime('yesterday'));
        if($historyDate == $today) {
            return 'Today - ';
        } else if($historyDate == $yesterday) {
            return 'Yesterday - ';
        }
        return '';
    }

    public static function getCountry($stkType){
        $countryData = MemberregistrationmstTbl::find()
                        ->select([
                            'CountryMst_Pk as cntryPk',
                            'CountryMst_Pk as filterPk',
                            'CyM_CountryName_en as filterName'
                        ])
                        ->innerJoin('membercompanymst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                        ->innerJoin('countrymst_tbl','CountryMst_Pk = MCM_Source_CountryMst_Fk')
                        ->where([
                            'mrm_stkholdertypmst_fk'=>'6',
                            'CyM_Status'=>'A',
                        ])
                        ->groupBy('CountryMst_Pk')
                        ->orderBy(['CyM_CountryName_en'=>SORT_ASC])
                        ->asArray()->all();
        return $countryData;
    }
    
    public static function getCountryGCE($stkType,$country){
       
        
        $countryData = MemberregistrationmstTbl::find()
                        ->select([
                            'CountryMst_Pk as cntryPk',
                            'CountryMst_Pk as filterPk',
                            'CyM_CountryName_en as filterName'
                        ])
                        ->innerJoin('membercompanymst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                        ->innerJoin('countrymst_tbl','CountryMst_Pk = MCM_Source_CountryMst_Fk')
                        ->where([
                            'mrm_stkholdertypmst_fk'=>'6',
                            'CyM_Status'=>'A',
                        ])
                       ->andWhere(['in','CountryMst_Pk',$country])
                        ->groupBy('CountryMst_Pk')
                        ->orderBy(['CyM_CountryName_en'=>SORT_ASC])
                    ->asArray()->all();
        return $countryData;
    }
    public function Jsearchexportqueryexce($sql){
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        return $query;
    }
    public function Jsearchexportqueryform($reqdata){
        $select = '';
        $join = '';
        if(isset($reqdata['sezdspecialstatus']) && $reqdata['sezdspecialstatus'] == 'yes' ){
            $select  .= " case when srd_isprioritysme =1 then 'Priority SME' else '-' end as sezardsplsts,";
            $join .= " LEFT JOIN sezadregdtls_tbl  ON srd_memcompmst_fk = MemberCompMst_Pk";
        }
        if(isset($reqdata['specialstatus']) && $reqdata['specialstatus'] == 'yes'){
            $select  .= " coalesce(group_concat(distinct case spl.mclch_lcctype when 1 then 'CCED' when 2 then 'DUQM' when 3 then 'OXY' when 4 then 'PDO' end),'-') as splsts,";
            $join .= "  LEFT JOIN memcomplcccerthdr_tbl spl ON spl.mclch_membercompmst_fk = MemberCompMst_Pk  and spl.mclch_status =1";
        }
        if(isset($reqdata['pdolcc']) && $reqdata['pdolcc']== 'yes'){
            $select  .= " coalesce(DATE_FORMAT(pdo.mclch_lcccerton, '%d-%m-%Y'),'-') as pdoapprovedon, case WHEN pdo.mclch_pdodivision = 1 then 'North' WHEN pdo.mclch_pdodivision = 2  then 'South' else '-' END as pdoconcessionarea, coalesce(pdodtls.mclcd_pdoaddress,'-') as pdopermanentadds,";
            $join .= "  LEFT JOIN memcomplcccerthdr_tbl pdo ON pdo.mclch_membercompmst_fk = MemberCompMst_Pk and pdo.mclch_lcctype = 4 and pdo.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl pdodtls ON pdodtls.mclcd_memcomplcccerthdr_fk =pdo.memcomplcccerthdr_pk and pdodtls.mclcd_status =1";
        }
        if(isset($reqdata['ccedlcc']) && $reqdata['ccedlcc']== 'yes'){
            $select  .= " coalesce(DATE_FORMAT(cced.mclch_lcccerton, '%d-%m-%Y'),'-') as ccedapprovedon, coalesce(cceddtls.mclcd_blockno,'-') as ccedblock, cceddtls.mclcd_wilayatmst_fk as ccedwillayat, cceddtls.mclcd_villagemst_fk as ccedvillage,";
            $join .= "  LEFT JOIN memcomplcccerthdr_tbl cced ON cced.mclch_membercompmst_fk = MemberCompMst_Pk and cced.mclch_lcctype = 1 and cced.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl cceddtls ON cceddtls.mclcd_memcomplcccerthdr_fk = cced.memcomplcccerthdr_pk and cceddtls.mclcd_status =1";
        }
        if(isset($reqdata['oxylcc']) && $reqdata['oxylcc']== 'yes'){
            $select  .= " coalesce(DATE_FORMAT(oxy.mclch_lcccerton, '%d-%m-%Y'),'-') as oxyapprovedon, coalesce(oxydtls.mclcd_blockno,'-') as oxyblock, oxydtls.mclcd_wilayatmst_fk as oxywillayat, oxydtls.mclcd_villagemst_fk as oxyvillage,";
            $join .= "  LEFT JOIN memcomplcccerthdr_tbl oxy ON oxy.mclch_membercompmst_fk = MemberCompMst_Pk and oxy.mclch_lcctype = 3 and oxy.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl oxydtls ON oxydtls.mclcd_memcomplcccerthdr_fk =oxy.memcomplcccerthdr_pk and oxydtls.mclcd_status =1";
        }
        if(isset($reqdata['drpiclcc']) && $reqdata['drpiclcc']== 'yes'){
            $select  .= " coalesce(DATE_FORMAT(duqum.mclch_lcccerton, '%d-%m-%Y'),'-') as duqumapprovedon, duqumdtls.mclcd_wilayatmst_fk as duqumwillayat,";
            $join .= "  LEFT JOIN memcomplcccerthdr_tbl duqum ON duqum.mclch_membercompmst_fk = MemberCompMst_Pk and duqum.mclch_lcctype = 2 and duqum.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl duqumdtls ON duqumdtls.mclcd_memcomplcccerthdr_fk =duqum.memcomplcccerthdr_pk and duqumdtls.mclcd_status =1";
        }
        if(isset($reqdata['pdolcccategorydetails']) && $reqdata['pdolcccategorydetails']== 'yes'){
            $select  .= " json_arrayagg(json_object ('categoryname',pdocat.scfpcdm_pdocategorymst_fk,'yearofexp', pdocat.scfpcdm_yrofexp, 'contractvalue', pdocat.scfpcdm_totcontvalue)) as pdocategory,";
            $join .= "  LEFT JOIN scfpdocatdtlsmain_tbl pdocat ON pdocat.scfpcdm_memcompmst_fk = MemberCompMst_Pk";
        }
        if(isset($reqdata['omanisationpercentageasperjsrs']) && $reqdata['omanisationpercentageasperjsrs']== 'yes'){
            $select  .= " coalesce(brkdown.scficvbdt_totomanihcpct,'-') as omaizationpercntage,";
            $join .= "  LEFT JOIN scficvbreakdowntmp_tbl brkdown ON brkdown.scficvbdt_memcompmst_fk = MemberCompMst_Pk";
        }
        if(isset($reqdata['omanisationpercentageasperministry']) && $reqdata['omanisationpercentageasperministry']== 'yes'){
            $select  .= " coalesce(mmp.momp_specialistomani,'-') as specialistomani,
                coalesce(mmp.momp_specialistexpats,'-') as specialistexpats,
                coalesce(mmp.momp_totalspecialist,'-') as totalspecialist,
                coalesce(mmp.momp_techomani,'-') as techomani,
                coalesce(mmp.momp_techexpats,'-') as techexpats,
                coalesce(mmp.momp_totaltech,'-') as totaltech,
                coalesce(mmp.momp_occupantomani,'-') as occupantomani,
                coalesce(mmp.momp_occupantexpat,'-') as occupantexpat,
                coalesce(mmp.momp_totaloccupant,'-') as totaloccupant,
                coalesce(mmp.momp_skilledomani,'-') as skilledomani,
                coalesce(mmp.momp_skilledexpat,'-') as skilledexpat,
                coalesce(mmp.momp_totalskilled,'-') as totalskilled,
                coalesce(mmp.momp_lowskilledomani,'-') as lowskilledomani,
                coalesce(mmp.momp_lowskilledexpat,'-') as lowskilledexpat,
                coalesce(mmp.momp_totallowskilled,'-') as totallowskilled,
                mmp.momp_omanisation as percentage,
                coalesce(mmp.momp_totalomani,'-') as totalomani,
                coalesce(mmp.momp_totalexpat,'-') as totalexpat,";            
            $join .= "  LEFT JOIN ministofmanpower_tbl mmp ON mmp.momp_membercompmst_fk = MemberCompMst_Pk";
        }
        if(isset($reqdata['jsrscontactdetails']) && $reqdata['jsrscontactdetails']== 'yes'){
            if(isset($reqdata['jsrsname']) && $reqdata['jsrsname']== 'yes'){
                $select  .= " concat_ws(' ',jsrscont.um_firstname,jsrscont.um_middlename, jsrscont.um_lastname) as jsrsName,";
            }
            if(isset($reqdata['jsrsemail']) && $reqdata['jsrsemail']== 'yes'){
                $select  .= " coalesce(jsrscont.UM_EmailID,'-') as jsrsemailid,";
            }
            if(isset($reqdata['jsrsphone']) && $reqdata['jsrsphone']== 'yes'){
                $select  .= " jsrscont.um_landlinecc as jsrslandlinecc, concat_ws(' ',jsrscont.um_landlineno, jsrscont.um_landlineext) as jsrslandline,";
            }
            if(isset($reqdata['jsrsmobile']) && $reqdata['jsrsmobile']== 'yes'){
                $select  .= " jsrscont.um_primobnocc as jsrscc,  jsrscont.um_primobno as jsrsmobile,";
            }
            $join .= "  LEFT JOIN suppcertformpartrn_tbl jsrscontact ON jsrscontact.scfpt_membercompmst_fk = MemberCompMst_Pk and jsrscontact.scfpt_bgivaldocsubcatmst_fk =98 LEFT JOIN usermst_tbl jsrscont ON jsrscont.UserMst_Pk = jsrscontact.scfpt_paramvalue";
        }
        if(isset($reqdata['primarycontactdetails']) && $reqdata['primarycontactdetails']== 'yes'){
            if(isset($reqdata['primaryname']) && $reqdata['primaryname']== 'yes'){
                $select  .= " concat_ws(' ',prim.um_firstname,prim.um_middlename, prim.um_lastname) as primaryName,";
            }
            if(isset($reqdata['primaryemail']) && $reqdata['primaryemail']== 'yes'){
                $select  .= " coalesce(prim.UM_EmailID,'-') as primaryemailid,";
            }
            if(isset($reqdata['primaryphone']) && $reqdata['primaryphone']== 'yes'){
                $select  .= " prim.um_landlinecc as landlinecc,  concat_ws(' ',prim.um_landlineno,prim.um_landlineext) as primarylandline,";
            }
            if(isset($reqdata['primarymobile']) && $reqdata['primarymobile']== 'yes'){
                $select  .= " prim.um_primobnocc as primarycc,  prim.um_primobno as primarymobile,";
            }
            $join .= "  INNER JOIN usermst_tbl prim ON prim.UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk and prim.um_pymtcontact = 1";
        }
         if(isset($reqdata['incorporatestyle']) && $reqdata['incorporatestyle']== 'yes'){
            $select  .= " coalesce(ISM_IncorpStyleEntity,'-') as incorpstyle,";
            $join .= "  LEFT JOIN incorpstylemst_tbl ON mrm_incorpstylemst_fk = IncorpStyleMst_Pk";
        }
         if(isset($reqdata['classification']) && $reqdata['classification']== 'yes'){
            $select  .= "  coalesce(ClM_ClassificationType,'-') as classiciation,";
            $join .= "  LEFT JOIN classificationmst_tbl ON mcm_classificationmst_fk = ClassificationMst_Pk";
        }
         if(isset($reqdata['establishmentyear']) && $reqdata['establishmentyear']== 'yes'){
            $select  .= "  coalesce(DATE_FORMAT(MCM_RegistrationYear,'%d-%m-%Y'),'-') as establismentyr,";
        }
        if(isset($reqdata['commercialregistrationno']) && $reqdata['commercialregistrationno']== 'yes'){
            $select  .= "  coalesce(commno.scfpt_paramvalue,'-') as commercialnumb,";
            $join .= "  LEFT JOIN suppcertformpartrn_tbl commno ON commno.scfpt_membercompmst_fk = MemberCompMst_Pk and commno.scfpt_bgivaldocsubcatmst_fk =2 
           and commno.scfpt_bgivaldocsubcatpardtls_fk = 397";
        }
        if(isset($reqdata['commercialregistrationexpiry']) && $reqdata['commercialregistrationexpiry']== 'yes' ){
            $select  .= "  coalesce(DATE_FORMAT(commex.scfpt_paramvalue,'%d-%m-%Y'),'-') as commercialexpiredate,";
            $join .= "  LEFT JOIN suppcertformpartrn_tbl commex ON commex.scfpt_membercompmst_fk = MemberCompMst_Pk and commex.scfpt_bgivaldocsubcatmst_fk =2 
           and commex.scfpt_bgivaldocsubcatpardtls_fk = 9";
        }            
        if(isset($reqdata['chamberofcommercecertificateno']) && $reqdata['chamberofcommercecertificateno']== 'yes'){
            $select  .=  "  coalesce(chamberno.scfpt_paramvalue,'-') as chambernumber,";
            $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberno ON chamberno.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberno.scfpt_bgivaldocsubcatmst_fk =30  and chamberno.scfpt_bgivaldocsubcatpardtls_fk  = 398";
        }
        if(isset($reqdata['chamberofcommercecertificateexpiry']) && $reqdata['chamberofcommercecertificateexpiry']== 'yes' ){
            $select  .= "  coalesce(DATE_FORMAT(chamberex.scfpt_paramvalue,'%d-%m-%Y'),'-') as chamberexpiredate,";
            $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberex ON chamberex.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberex.scfpt_bgivaldocsubcatmst_fk =30 and chamberex.scfpt_bgivaldocsubcatpardtls_fk = 151";
        }            
        if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' || isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' || isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' || isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
            $join .= "  LEFT JOIN memcompmplocationdtls_tbl ON mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1";
            if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' ){
                $select  .= "  mcmpld_address as officeaddress, mcmpld_countrymst_fk as officeaddcountry, mcmpld_statemst_fk as officeaddstate, mcmpld_citymst_fk as officeaddcity,";
            }
            if(isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' ){
                $select  .= " mcmpld_postaladdress as postaladdress, mcmpld_postalcountrymst_fk as postalcountyfk, mcmpld_postalstatemst_fk as postalstate, mcmpld_postalcitymst_fk as postalcity,";
            }
            if(isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' ){
                $select  .= " mcmpld_landlinenocc as companylandlinecc, concat_ws(' ',mcmpld_landlineno,mcmpld_landlineext) as companylandline,";
            }
            if(isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' ){
                $select  .= " coalesce(mcmpld_website,'-') as compwebsite,";
            }
            if(isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                $select  .= " coalesce(mcmpld_emailid,'-') as compemail,";
            }
        }
        if(isset($reqdata['orgin']) && $reqdata['orgin']== 'yes' ){
            $select  .= " case when MCM_Origin ='I' then 'International' else 'National' end as origin,";
        }
        if(isset($reqdata['division']) && $reqdata['division']== 'yes' ){
            $select  .= " json_arrayagg(json_object('division', coalesce(mcsd_businessunitrefname,'-'), 'sector', MCSD_SectorMst_Fk)) as divisionsector,";
            $join .= "  LEFT JOIN memcompsectordtls_tbl ON MCSD_MemberCompMst_Fk = MemberCompMst_Pk LEFT JOIN sectormst_tbl ON find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)";
        }
        if(isset($reqdata['shareholdersinformation']) && $reqdata['shareholdersinformation']== 'yes' ){
            $select  .= " count(sharehold.memcompshareholderdtlsmain_pk) as totalshareholder, json_arrayagg(json_object('type',case when sharehold.mcshdm_type =1 then 'Organization' else 'Individual' end, 'name', coalesce(sharehold.mcshdm_name,'-'),  'idnumber', coalesce(sharehold.mcshdm_regno,'-'), 'countryval', sharehold.mcshdm_countrymst_fk, 'percenatge', coalesce(sharehold.mcshdm_percentofstake,'-'))) as shareholderdetail,";
            $join .= " LEFT JOIN memcompshareholderdtlsmain_tbl sharehold ON sharehold.mcshdm_memcompmst_fk = MemberCompMst_Pk";
        }
        $query = "SELECT 
                distinct MemberCompMst_Pk,
                coalesce(mcm_RegistrationNo,'-') as regno,
                coalesce(MCM_SupplierCode,'-') as suppliercode,
                case WHEN (mcm_accexpirydate) < current_date() then 'Expired' WHEN (mcm_accexpirydate) >= current_date()  then 'Active' END as jsrsstatus,
                coalesce(DATE_FORMAT(mcm_accexpirydate, '%d-%m-%Y'),'-') as expiredate,
                MCM_CompanyName as companyname, $select  MCM_RegistrationExpiry as crstatusdate 
                FROM membercompanymst_tbl 
                INNER JOIN memberregistrationmst_tbl ON MemberRegMst_Pk = MCM_MemberRegMst_Fk $join
                WHERE mrm_stkholdertypmst_fk = 6 and MRM_MemberStatus = 'A'  
                group by MemberCompMst_Pk";
        return $query;
    }
    public function Jsearchexportunmergequeryform($reqdata){
        if(isset($reqdata['products']) && $reqdata['products']== 'yes' ){
            $select = '';
            $join = '';
            if(isset($reqdata['sezdspecialstatus']) && $reqdata['sezdspecialstatus'] == 'yes' ){
                $select  .= " case when srd_isprioritysme =1 then 'Priority SME' else '-' end as sezardsplsts,";
                $join .= " LEFT JOIN sezadregdtls_tbl  ON srd_memcompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['specialstatus']) && $reqdata['specialstatus'] == 'yes'){
                $select  .= " coalesce(group_concat(distinct case spl.mclch_lcctype when 1 then 'CCED' when 2 then 'DUQM' when 3 then 'OXY' when 4 then 'PDO' end),'-') as splsts,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl spl ON spl.mclch_membercompmst_fk = MemberCompMst_Pk  and spl.mclch_status =1";
            }
            if(isset($reqdata['pdolcc']) && $reqdata['pdolcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(pdo.mclch_lcccerton, '%d-%m-%Y'),'-') as pdoapprovedon, case WHEN pdo.mclch_pdodivision = 1 then 'North' WHEN pdo.mclch_pdodivision = 2  then 'South' else '-' END as pdoconcessionarea, coalesce(pdodtls.mclcd_pdoaddress,'-') as pdopermanentadds,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl pdo ON pdo.mclch_membercompmst_fk = MemberCompMst_Pk and pdo.mclch_lcctype = 4 and pdo.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl pdodtls ON pdodtls.mclcd_memcomplcccerthdr_fk =pdo.memcomplcccerthdr_pk and pdodtls.mclcd_status =1";
            }
            if(isset($reqdata['ccedlcc']) && $reqdata['ccedlcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(cced.mclch_lcccerton, '%d-%m-%Y'),'-') as ccedapprovedon, coalesce(cceddtls.mclcd_blockno,'-') as ccedblock, cceddtls.mclcd_wilayatmst_fk as ccedwillayat, cceddtls.mclcd_villagemst_fk as ccedvillage,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl cced ON cced.mclch_membercompmst_fk = MemberCompMst_Pk and cced.mclch_lcctype = 1 and cced.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl cceddtls ON cceddtls.mclcd_memcomplcccerthdr_fk = cced.memcomplcccerthdr_pk and cceddtls.mclcd_status =1";
            }
            if(isset($reqdata['oxylcc']) && $reqdata['oxylcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(oxy.mclch_lcccerton, '%d-%m-%Y'),'-') as oxyapprovedon, coalesce(oxydtls.mclcd_blockno,'-') as oxyblock, oxydtls.mclcd_wilayatmst_fk as oxywillayat, oxydtls.mclcd_villagemst_fk as oxyvillage,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl oxy ON oxy.mclch_membercompmst_fk = MemberCompMst_Pk and oxy.mclch_lcctype = 3 and oxy.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl oxydtls ON oxydtls.mclcd_memcomplcccerthdr_fk =oxy.memcomplcccerthdr_pk and oxydtls.mclcd_status =1";
            }
            if(isset($reqdata['drpiclcc']) && $reqdata['drpiclcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(duqum.mclch_lcccerton, '%d-%m-%Y'),'-') as duqumapprovedon, duqumdtls.mclcd_wilayatmst_fk as duqumwillayat,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl duqum ON duqum.mclch_membercompmst_fk = MemberCompMst_Pk and duqum.mclch_lcctype = 2 and duqum.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl duqumdtls ON duqumdtls.mclcd_memcomplcccerthdr_fk =duqum.memcomplcccerthdr_pk and duqumdtls.mclcd_status =1";
            }
            if(isset($reqdata['omanisationpercentageasperjsrs']) && $reqdata['omanisationpercentageasperjsrs']== 'yes'){
                $select  .= " coalesce(brkdown.scficvbdt_totomanihcpct,'-') as omaizationpercntage,";
                $join .= "  LEFT JOIN scficvbreakdowntmp_tbl brkdown ON brkdown.scficvbdt_memcompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['omanisationpercentageasperministry']) && $reqdata['omanisationpercentageasperministry']== 'yes'){
                $select  .= " coalesce(mmp.momp_specialistomani,'-') as specialistomani,
                    coalesce(mmp.momp_specialistexpats,'-') as specialistexpats,
                    coalesce(mmp.momp_totalspecialist,'-') as totalspecialist,
                    coalesce(mmp.momp_techomani,'-') as techomani,
                    coalesce(mmp.momp_techexpats,'-') as techexpats,
                    coalesce(mmp.momp_totaltech,'-') as totaltech,
                    coalesce(mmp.momp_occupantomani,'-') as occupantomani,
                    coalesce(mmp.momp_occupantexpat,'-') as occupantexpat,
                    coalesce(mmp.momp_totaloccupant,'-') as totaloccupant,
                    coalesce(mmp.momp_skilledomani,'-') as skilledomani,
                    coalesce(mmp.momp_skilledexpat,'-') as skilledexpat,
                    coalesce(mmp.momp_totalskilled,'-') as totalskilled,
                    coalesce(mmp.momp_lowskilledomani,'-') as lowskilledomani,
                    coalesce(mmp.momp_lowskilledexpat,'-') as lowskilledexpat,
                    coalesce(mmp.momp_totallowskilled,'-') as totallowskilled,
                    mmp.momp_omanisation as percentage,
                    coalesce(mmp.momp_totalomani,'-') as totalomani,
                    coalesce(mmp.momp_totalexpat,'-') as totalexpat,";            
                $join .= "  LEFT JOIN ministofmanpower_tbl mmp ON mmp.momp_membercompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['jsrscontactdetails']) && $reqdata['jsrscontactdetails']== 'yes'){
                if(isset($reqdata['jsrsname']) && $reqdata['jsrsname']== 'yes'){
                    $select  .= " concat_ws(' ',jsrscont.um_firstname,jsrscont.um_middlename, jsrscont.um_lastname) as jsrsName,";
                }
                if(isset($reqdata['jsrsemail']) && $reqdata['jsrsemail']== 'yes'){
                    $select  .= " coalesce(jsrscont.UM_EmailID,'-') as jsrsemailid,";
                }
                if(isset($reqdata['jsrsphone']) && $reqdata['jsrsphone']== 'yes'){
                    $select  .= " jsrscont.um_landlinecc as jsrslandlinecc, concat_ws(' ',jsrscont.um_landlineno, jsrscont.um_landlineext) as jsrslandline,";
                }
                if(isset($reqdata['jsrsmobile']) && $reqdata['jsrsmobile']== 'yes'){
                    $select  .= " jsrscont.um_primobnocc as jsrscc,  jsrscont.um_primobno as jsrsmobile,";
                }
                $join .= "  LEFT JOIN suppcertformpartrn_tbl jsrscontact ON jsrscontact.scfpt_membercompmst_fk = MemberCompMst_Pk and jsrscontact.scfpt_bgivaldocsubcatmst_fk =98 LEFT JOIN usermst_tbl jsrscont ON jsrscont.UserMst_Pk = jsrscontact.scfpt_paramvalue";
            }
            if(isset($reqdata['primarycontactdetails']) && $reqdata['primarycontactdetails']== 'yes'){
                if(isset($reqdata['primaryname']) && $reqdata['primaryname']== 'yes'){
                    $select  .= " concat_ws(' ',prim.um_firstname,prim.um_middlename, prim.um_lastname) as primaryName,";
                }
                if(isset($reqdata['primaryemail']) && $reqdata['primaryemail']== 'yes'){
                    $select  .= " coalesce(prim.UM_EmailID,'-') as primaryemailid,";
                }
                if(isset($reqdata['primaryphone']) && $reqdata['primaryphone']== 'yes'){
                    $select  .= " prim.um_landlinecc as landlinecc,  concat_ws(' ',prim.um_landlineno,prim.um_landlineext) as primarylandline,";
                }
                if(isset($reqdata['primarymobile']) && $reqdata['primarymobile']== 'yes'){
                    $select  .= " prim.um_primobnocc as primarycc,  prim.um_primobno as primarymobile,";
                }
                $join .= "  INNER JOIN usermst_tbl prim ON prim.UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk and prim.um_pymtcontact = 1";
            }
             if(isset($reqdata['incorporatestyle']) && $reqdata['incorporatestyle']== 'yes'){
                $select  .= " coalesce(ISM_IncorpStyleEntity,'-') as incorpstyle,";
                $join .= "  LEFT JOIN incorpstylemst_tbl ON mrm_incorpstylemst_fk = IncorpStyleMst_Pk";
            }
             if(isset($reqdata['classification']) && $reqdata['classification']== 'yes'){
                $select  .= "  coalesce(ClM_ClassificationType,'-') as classiciation,";
                $join .= "  LEFT JOIN classificationmst_tbl ON mcm_classificationmst_fk = ClassificationMst_Pk";
            }
             if(isset($reqdata['establishmentyear']) && $reqdata['establishmentyear']== 'yes'){
                $select  .= "  coalesce(DATE_FORMAT(MCM_RegistrationYear,'%d-%m-%Y'),'-') as establismentyr,";
            }
            if(isset($reqdata['commercialregistrationno']) && $reqdata['commercialregistrationno']== 'yes'){
                $select  .= "  coalesce(commno.scfpt_paramvalue,'-') as commercialnumb,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl commno ON commno.scfpt_membercompmst_fk = MemberCompMst_Pk and commno.scfpt_bgivaldocsubcatmst_fk =2 
               and commno.scfpt_bgivaldocsubcatpardtls_fk = 397";
            }
            if(isset($reqdata['commercialregistrationexpiry']) && $reqdata['commercialregistrationexpiry']== 'yes' ){
                $select  .= "  coalesce(DATE_FORMAT(commex.scfpt_paramvalue,'%d-%m-%Y'),'-') as commercialexpiredate,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl commex ON commex.scfpt_membercompmst_fk = MemberCompMst_Pk and commex.scfpt_bgivaldocsubcatmst_fk =2 
               and commex.scfpt_bgivaldocsubcatpardtls_fk = 9";
            }            
            if(isset($reqdata['chamberofcommercecertificateno']) && $reqdata['chamberofcommercecertificateno']== 'yes'){
                $select  .=  "  coalesce(chamberno.scfpt_paramvalue,'-') as chambernumber,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberno ON chamberno.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberno.scfpt_bgivaldocsubcatmst_fk =30  and chamberno.scfpt_bgivaldocsubcatpardtls_fk  = 398";
            }
            if(isset($reqdata['chamberofcommercecertificateexpiry']) && $reqdata['chamberofcommercecertificateexpiry']== 'yes' ){
                $select  .= "  coalesce(DATE_FORMAT(chamberex.scfpt_paramvalue,'%d-%m-%Y'),'-') as chamberexpiredate,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberex ON chamberex.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberex.scfpt_bgivaldocsubcatmst_fk =30 and chamberex.scfpt_bgivaldocsubcatpardtls_fk = 151";
            }            
            if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' || isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' || isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' || isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                $join .= "  LEFT JOIN memcompmplocationdtls_tbl ON mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1";
                if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' ){
                    $select  .= "  mcmpld_address as officeaddress, mcmpld_countrymst_fk as officeaddcountry, mcmpld_statemst_fk as officeaddstate, mcmpld_citymst_fk as officeaddcity,";
                }
                if(isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' ){
                    $select  .= " mcmpld_postaladdress as postaladdress, mcmpld_postalcountrymst_fk as postalcountyfk, mcmpld_postalstatemst_fk as postalstate, mcmpld_postalcitymst_fk as postalcity,";
                }
                if(isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' ){
                    $select  .= " mcmpld_landlinenocc as companylandlinecc, concat_ws(' ',mcmpld_landlineno,mcmpld_landlineext) as companylandline,";
                }
                if(isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' ){
                    $select  .= " coalesce(mcmpld_website,'-') as compwebsite,";
                }
                if(isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                    $select  .= " coalesce(mcmpld_emailid,'-') as compemail,";
                }
            }
            if(isset($reqdata['orgin']) && $reqdata['orgin']== 'yes' ){
                $select  .= " case when MCM_Origin ='I' then 'International' else 'National' end as origin,";
            }
            $query = "SELECT * FROM
                ((SELECT 
                MemberCompMst_Pk,
                coalesce(mcm_RegistrationNo,'-') as regno,
                coalesce(MCM_SupplierCode,'-') as suppliercode,
                case WHEN (mcm_accexpirydate) < current_date() then 'Expired' WHEN (mcm_accexpirydate) >= current_date()  then 'Active' END as jsrsstatus,
                coalesce(DATE_FORMAT(mcm_accexpirydate, '%d-%m-%Y'),'-') as expiredate,
                MCM_CompanyName as companyname, $select  MCM_RegistrationExpiry as crstatusdate,
                `MemCompProdDtls_Pk` AS `pdtPk`,
                `MCPrD_DisplayName` AS `displayName`,
                'Not Approved' AS `productStatus`,
                GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
                GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `pdivision`,
                GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `psector`,
                GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `pactivity`,
                bicc_categoryname AS `groupcategory`,
                bicsc_subcategoryname AS `maincategory`, 
                bicpm_productname AS `subcategory`,
                concat(PrdM_ProductCode, ' - ', PrdM_ProductName) AS `categorycode`
                FROM
                membercompanymst_tbl
                INNER JOIN `memberregistrationmst_tbl` ON MemberRegMst_Pk = MCM_MemberRegMst_Fk $join
                LEFT JOIN `memcompproddtls_tbl` `mcprd` ON mcprd.MCPrD_MemberCompMst_Fk = MemberCompMst_Pk
                LEFT JOIN `memcompproddtlsmain_tbl` `mcprdm` ON MemCompProdDtls_Pk = mcprdm_memcompproddtls_fk
                LEFT JOIN `productmst_tbl` `pm` ON pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk
                LEFT JOIN `bgiinduscodeprodmst_tbl` ON mcprd_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk
                LEFT JOIN `bgiindcodesubcateg_tbl` ON mcprd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk
                LEFT JOIN `bgiindcodecateg_tbl` ON mcprd_bgiindcodecateg_fk = bgiindcodecateg_pk
                LEFT JOIN `memcompprodbussrcmap_tbl` `mcpbsm` ON mcprd.MemCompProdDtls_Pk = mcpbsm_memcompproddtls_fk
                LEFT JOIN `memcompbussrcdtls_tbl` `mcb` ON mcpbsm.mcpbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk
                LEFT JOIN `businesssourcemst_tbl` `bsm` ON bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk
                LEFT JOIN `memcompsectordtls_tbl`  ON mcb.mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk
                LEFT JOIN `memcompbussrcsectormap_tbl`  ON mcb.memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk
                LEFT JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
                LEFT JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
                LEFT JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk
                WHERE mrm_stkholdertypmst_fk = 6 and MRM_MemberStatus = 'A'  
                GROUP BY `MemberCompMst_Pk`,`MemCompProdDtls_Pk`) UNION ALL (SELECT 
                MemberCompMst_Pk,
                coalesce(mcm_RegistrationNo,'-') as regno,
                coalesce(MCM_SupplierCode,'-') as suppliercode,
                case WHEN (mcm_accexpirydate) < current_date() then 'Expired' WHEN (mcm_accexpirydate) >= current_date()  then 'Active' END as jsrsstatus,
                coalesce(DATE_FORMAT(mcm_accexpirydate, '%d-%m-%Y'),'-') as expiredate,
                MCM_CompanyName as companyname, $select  MCM_RegistrationExpiry as crstatusdate,
                `mcprdm_memcompproddtls_fk` AS `pdtPk`,
                `mcprdm_displayname` AS `displayName`,
                'Approved' AS `productStatus`,
                GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
                GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `pdivision`,
                GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `psector`,
                GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `pactivity`,
                bicc_categoryname AS `groupcategory`,
                bicsc_subcategoryname AS `maincategory`, 
                bicpm_productname AS `subcategory`,
                concat(PrdM_ProductCode, ' - ', PrdM_ProductName) AS `categorycode`
                FROM
                membercompanymst_tbl
                INNER JOIN `memberregistrationmst_tbl` ON MemberRegMst_Pk = MCM_MemberRegMst_Fk $join
                LEFT JOIN `memcompproddtlsmain_tbl` `mcprdm` ON mcprdm.mcprdm_membercompmst_fk = MemberCompMst_Pk
                INNER JOIN `ProductMst_tbl` `pm` ON productmst_pk = mcprdm_productmst_fk
                INNER JOIN `bgiinduscodeprodmst_tbl` ON mcprdm_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk
                INNER JOIN `bgiindcodesubcateg_tbl` ON mcprdm_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk
                INNER JOIN `bgiindcodecateg_tbl` ON mcprdm_bgiindcodecateg_fk = bgiindcodecateg_pk
                INNER JOIN `memcompprodbussrcmapmain_tbl` `mcpbsm` ON mcprdm_memcompproddtls_fk = mcpbsmm_memcompproddtls_fk
                INNER JOIN `memcompbussrcdtlsmain_tbl` `mcb` ON mcpbsm.mcpbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk
                INNER JOIN `businesssourcemst_tbl` `bsm` ON mcbsdm_businesssourcemst_fk = businesssourcemst_pk
                INNER JOIN `memcompsectordtls_tbl`  ON mcb.mcbsdm_memcompsecdtls_fk = MemCompSecDtls_Pk
                INNER JOIN `memcompbussrcsectormap_tbl`  ON mcb.mcbsdm_memcompbussrcdtls_fk = mcbssm_memcompbussrcdtls_fk
                INNER JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
                INNER JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
                INNER JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk
                WHERE mrm_stkholdertypmst_fk = 6 and MRM_MemberStatus = 'A'  
                GROUP BY `MemberCompMst_Pk`,`mcprdm_memcompproddtls_fk`)) `produnion`
                ORDER BY `MemberCompMst_Pk` ";
        } 
        elseif(isset($reqdata['services']) && $reqdata['services']== 'yes' ){
            $select = '';
            $join = '';
            if(isset($reqdata['sezdspecialstatus']) && $reqdata['sezdspecialstatus'] == 'yes' ){
                $select  .= " case when srd_isprioritysme =1 then 'Priority SME' else '-' end as sezardsplsts,";
                $join .= " LEFT JOIN sezadregdtls_tbl  ON srd_memcompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['specialstatus']) && $reqdata['specialstatus'] == 'yes'){
                $select  .= " coalesce(group_concat(distinct case spl.mclch_lcctype when 1 then 'CCED' when 2 then 'DUQM' when 3 then 'OXY' when 4 then 'PDO' end),'-') as splsts,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl spl ON spl.mclch_membercompmst_fk = MemberCompMst_Pk  and spl.mclch_status =1";
            }
            if(isset($reqdata['pdolcc']) && $reqdata['pdolcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(pdo.mclch_lcccerton, '%d-%m-%Y'),'-') as pdoapprovedon, case WHEN pdo.mclch_pdodivision = 1 then 'North' WHEN pdo.mclch_pdodivision = 2  then 'South' else '-' END as pdoconcessionarea, coalesce(pdodtls.mclcd_pdoaddress,'-') as pdopermanentadds,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl pdo ON pdo.mclch_membercompmst_fk = MemberCompMst_Pk and pdo.mclch_lcctype = 4 and pdo.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl pdodtls ON pdodtls.mclcd_memcomplcccerthdr_fk =pdo.memcomplcccerthdr_pk and pdodtls.mclcd_status =1";
            }
            if(isset($reqdata['ccedlcc']) && $reqdata['ccedlcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(cced.mclch_lcccerton, '%d-%m-%Y'),'-') as ccedapprovedon, coalesce(cceddtls.mclcd_blockno,'-') as ccedblock, cceddtls.mclcd_wilayatmst_fk as ccedwillayat, cceddtls.mclcd_villagemst_fk as ccedvillage,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl cced ON cced.mclch_membercompmst_fk = MemberCompMst_Pk and cced.mclch_lcctype = 1 and cced.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl cceddtls ON cceddtls.mclcd_memcomplcccerthdr_fk = cced.memcomplcccerthdr_pk and cceddtls.mclcd_status =1";
            }
            if(isset($reqdata['oxylcc']) && $reqdata['oxylcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(oxy.mclch_lcccerton, '%d-%m-%Y'),'-') as oxyapprovedon, coalesce(oxydtls.mclcd_blockno,'-') as oxyblock, oxydtls.mclcd_wilayatmst_fk as oxywillayat, oxydtls.mclcd_villagemst_fk as oxyvillage,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl oxy ON oxy.mclch_membercompmst_fk = MemberCompMst_Pk and oxy.mclch_lcctype = 3 and oxy.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl oxydtls ON oxydtls.mclcd_memcomplcccerthdr_fk =oxy.memcomplcccerthdr_pk and oxydtls.mclcd_status =1";
            }
            if(isset($reqdata['drpiclcc']) && $reqdata['drpiclcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(duqum.mclch_lcccerton, '%d-%m-%Y'),'-') as duqumapprovedon, duqumdtls.mclcd_wilayatmst_fk as duqumwillayat,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl duqum ON duqum.mclch_membercompmst_fk = MemberCompMst_Pk and duqum.mclch_lcctype = 2 and duqum.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl duqumdtls ON duqumdtls.mclcd_memcomplcccerthdr_fk =duqum.memcomplcccerthdr_pk and duqumdtls.mclcd_status =1";
            }
            if(isset($reqdata['omanisationpercentageasperjsrs']) && $reqdata['omanisationpercentageasperjsrs']== 'yes'){
                $select  .= " coalesce(brkdown.scficvbdt_totomanihcpct,'-') as omaizationpercntage,";
                $join .= "  LEFT JOIN scficvbreakdowntmp_tbl brkdown ON brkdown.scficvbdt_memcompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['omanisationpercentageasperministry']) && $reqdata['omanisationpercentageasperministry']== 'yes'){
                $select  .= " coalesce(mmp.momp_specialistomani,'-') as specialistomani,
                    coalesce(mmp.momp_specialistexpats,'-') as specialistexpats,
                    coalesce(mmp.momp_totalspecialist,'-') as totalspecialist,
                    coalesce(mmp.momp_techomani,'-') as techomani,
                    coalesce(mmp.momp_techexpats,'-') as techexpats,
                    coalesce(mmp.momp_totaltech,'-') as totaltech,
                    coalesce(mmp.momp_occupantomani,'-') as occupantomani,
                    coalesce(mmp.momp_occupantexpat,'-') as occupantexpat,
                    coalesce(mmp.momp_totaloccupant,'-') as totaloccupant,
                    coalesce(mmp.momp_skilledomani,'-') as skilledomani,
                    coalesce(mmp.momp_skilledexpat,'-') as skilledexpat,
                    coalesce(mmp.momp_totalskilled,'-') as totalskilled,
                    coalesce(mmp.momp_lowskilledomani,'-') as lowskilledomani,
                    coalesce(mmp.momp_lowskilledexpat,'-') as lowskilledexpat,
                    coalesce(mmp.momp_totallowskilled,'-') as totallowskilled,
                    mmp.momp_omanisation as percentage,
                    coalesce(mmp.momp_totalomani,'-') as totalomani,
                    coalesce(mmp.momp_totalexpat,'-') as totalexpat,";            
                $join .= "  LEFT JOIN ministofmanpower_tbl mmp ON mmp.momp_membercompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['jsrscontactdetails']) && $reqdata['jsrscontactdetails']== 'yes'){
                if(isset($reqdata['jsrsname']) && $reqdata['jsrsname']== 'yes'){
                    $select  .= " concat_ws(' ',jsrscont.um_firstname,jsrscont.um_middlename, jsrscont.um_lastname) as jsrsName,";
                }
                if(isset($reqdata['jsrsemail']) && $reqdata['jsrsemail']== 'yes'){
                    $select  .= " coalesce(jsrscont.UM_EmailID,'-') as jsrsemailid,";
                }
                if(isset($reqdata['jsrsphone']) && $reqdata['jsrsphone']== 'yes'){
                    $select  .= " jsrscont.um_landlinecc as jsrslandlinecc, concat_ws(' ',jsrscont.um_landlineno, jsrscont.um_landlineext) as jsrslandline,";
                }
                if(isset($reqdata['jsrsmobile']) && $reqdata['jsrsmobile']== 'yes'){
                    $select  .= " jsrscont.um_primobnocc as jsrscc,  jsrscont.um_primobno as jsrsmobile,";
                }
                $join .= "  LEFT JOIN suppcertformpartrn_tbl jsrscontact ON jsrscontact.scfpt_membercompmst_fk = MemberCompMst_Pk and jsrscontact.scfpt_bgivaldocsubcatmst_fk =98 LEFT JOIN usermst_tbl jsrscont ON jsrscont.UserMst_Pk = jsrscontact.scfpt_paramvalue";
            }
            if(isset($reqdata['primarycontactdetails']) && $reqdata['primarycontactdetails']== 'yes'){
                if(isset($reqdata['primaryname']) && $reqdata['primaryname']== 'yes'){
                    $select  .= " concat_ws(' ',prim.um_firstname,prim.um_middlename, prim.um_lastname) as primaryName,";
                }
                if(isset($reqdata['primaryemail']) && $reqdata['primaryemail']== 'yes'){
                    $select  .= " coalesce(prim.UM_EmailID,'-') as primaryemailid,";
                }
                if(isset($reqdata['primaryphone']) && $reqdata['primaryphone']== 'yes'){
                    $select  .= " prim.um_landlinecc as landlinecc,  concat_ws(' ',prim.um_landlineno,prim.um_landlineext) as primarylandline,";
                }
                if(isset($reqdata['primarymobile']) && $reqdata['primarymobile']== 'yes'){
                    $select  .= " prim.um_primobnocc as primarycc,  prim.um_primobno as primarymobile,";
                }
                $join .= "  INNER JOIN usermst_tbl prim ON prim.UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk and prim.um_pymtcontact = 1";
            }
             if(isset($reqdata['incorporatestyle']) && $reqdata['incorporatestyle']== 'yes'){
                $select  .= " coalesce(ISM_IncorpStyleEntity,'-') as incorpstyle,";
                $join .= "  LEFT JOIN incorpstylemst_tbl ON mrm_incorpstylemst_fk = IncorpStyleMst_Pk";
            }
             if(isset($reqdata['classification']) && $reqdata['classification']== 'yes'){
                $select  .= "  coalesce(ClM_ClassificationType,'-') as classiciation,";
                $join .= "  LEFT JOIN classificationmst_tbl ON mcm_classificationmst_fk = ClassificationMst_Pk";
            }
             if(isset($reqdata['establishmentyear']) && $reqdata['establishmentyear']== 'yes'){
                $select  .= "  coalesce(DATE_FORMAT(MCM_RegistrationYear,'%d-%m-%Y'),'-') as establismentyr,";
            }
            if(isset($reqdata['commercialregistrationno']) && $reqdata['commercialregistrationno']== 'yes'){
                $select  .= "  coalesce(commno.scfpt_paramvalue,'-') as commercialnumb,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl commno ON commno.scfpt_membercompmst_fk = MemberCompMst_Pk and commno.scfpt_bgivaldocsubcatmst_fk =2 
               and commno.scfpt_bgivaldocsubcatpardtls_fk = 397";
            }
            if(isset($reqdata['commercialregistrationexpiry']) && $reqdata['commercialregistrationexpiry']== 'yes' ){
                $select  .= "  coalesce(DATE_FORMAT(commex.scfpt_paramvalue,'%d-%m-%Y'),'-') as commercialexpiredate,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl commex ON commex.scfpt_membercompmst_fk = MemberCompMst_Pk and commex.scfpt_bgivaldocsubcatmst_fk =2 
               and commex.scfpt_bgivaldocsubcatpardtls_fk = 9";
            }            
            if(isset($reqdata['chamberofcommercecertificateno']) && $reqdata['chamberofcommercecertificateno']== 'yes'){
                $select  .=  "  coalesce(chamberno.scfpt_paramvalue,'-') as chambernumber,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberno ON chamberno.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberno.scfpt_bgivaldocsubcatmst_fk =30  and chamberno.scfpt_bgivaldocsubcatpardtls_fk  = 398";
            }
            if(isset($reqdata['chamberofcommercecertificateexpiry']) && $reqdata['chamberofcommercecertificateexpiry']== 'yes' ){
                $select  .= "  coalesce(DATE_FORMAT(chamberex.scfpt_paramvalue,'%d-%m-%Y'),'-') as chamberexpiredate,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberex ON chamberex.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberex.scfpt_bgivaldocsubcatmst_fk =30 and chamberex.scfpt_bgivaldocsubcatpardtls_fk = 151";
            }            
            if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' || isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' || isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' || isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                $join .= "  LEFT JOIN memcompmplocationdtls_tbl ON mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1";
                if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' ){
                    $select  .= "  mcmpld_address as officeaddress, mcmpld_countrymst_fk as officeaddcountry, mcmpld_statemst_fk as officeaddstate, mcmpld_citymst_fk as officeaddcity,";
                }
                if(isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' ){
                    $select  .= " mcmpld_postaladdress as postaladdress, mcmpld_postalcountrymst_fk as postalcountyfk, mcmpld_postalstatemst_fk as postalstate, mcmpld_postalcitymst_fk as postalcity,";
                }
                if(isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' ){
                    $select  .= " mcmpld_landlinenocc as companylandlinecc, concat_ws(' ',mcmpld_landlineno,mcmpld_landlineext) as companylandline,";
                }
                if(isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' ){
                    $select  .= " coalesce(mcmpld_website,'-') as compwebsite,";
                }
                if(isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                    $select  .= " coalesce(mcmpld_emailid,'-') as compemail,";
                }
            }
            if(isset($reqdata['orgin']) && $reqdata['orgin']== 'yes' ){
                $select  .= " case when MCM_Origin ='I' then 'International' else 'National' end as origin,";
            }            
            $query = "SELECT *
                FROM
                ((SELECT 
                MemberCompMst_Pk,
                coalesce(mcm_RegistrationNo,'-') as regno,
                coalesce(MCM_SupplierCode,'-') as suppliercode,
                case WHEN (mcm_accexpirydate) < current_date() then 'Expired' WHEN (mcm_accexpirydate) >= current_date()  then 'Active' END as jsrsstatus,
                coalesce(DATE_FORMAT(mcm_accexpirydate, '%d-%m-%Y'),'-') as expiredate,
                MCM_CompanyName as companyname, $select  MCM_RegistrationExpiry as crstatusdate,
                `MemCompServDtls_Pk` AS `servicePk`,
                `MCSvD_DisplayName` AS `displayName`,
                'Not Approved' AS `serviceStatus`,
                GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
                GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `sdivision`,
                GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `ssector`,
                GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `sactivity`,
                bicc_categoryname AS `groupcategory`,
                bicsc_subcategoryname AS `maincategory`, 
                bicsm_servicename AS `subcategory`,
                concat(SrvM_ServiceCode, ' - ', SrvM_ServiceName) AS `categorycode`
                FROM
                membercompanymst_tbl
                INNER JOIN `memberregistrationmst_tbl` ON MemberRegMst_Pk = MCM_MemberRegMst_Fk $join
                LEFT JOIN `memcompservicedtls_tbl` `mcsvd` ON mcsvd.MCSvD_MemberCompMst_Fk = MemberCompMst_Pk 
                LEFT JOIN `memcompservicedtlsmain_tbl` `mcsvdm` ON MemCompServDtls_Pk = mcsvdm_memcompservdtls_fk 
                LEFT JOIN `servicemst_tbl` `sm` ON sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk 	
                LEFT JOIN `bgiinduscodeservmst_tbl` ON mcsvd_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk
                LEFT JOIN `bgiindcodesubcateg_tbl` ON mcsvd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk
                LEFT JOIN `bgiindcodecateg_tbl` ON mcsvd_bgiindcodecateg_fk = bgiindcodecateg_pk
                LEFT JOIN `memcompservbussrcmap_tbl` `mcpbsm` ON mcsvd.MemCompServDtls_Pk = mcsbsm_memcompservdtls_fk
                LEFT JOIN `memcompbussrcdtls_tbl` `mcb` ON mcpbsm.mcsbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk	
                LEFT JOIN `businesssourcemst_tbl` `bsm` ON bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk
                LEFT JOIN `memcompsectordtls_tbl`  ON mcb.mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk
                LEFT JOIN `memcompbussrcsectormap_tbl`  ON mcb.memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk
                LEFT JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
                LEFT JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
                LEFT JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk	
                WHERE mrm_stkholdertypmst_fk = 6 and MRM_MemberStatus = 'A'  
                GROUP BY `MemberCompMst_Pk`,`MemCompServDtls_Pk`) UNION ALL (SELECT 
                MemberCompMst_Pk,
                coalesce(mcm_RegistrationNo,'-') as regno,
                coalesce(MCM_SupplierCode,'-') as suppliercode,
                case WHEN (mcm_accexpirydate) < current_date() then 'Expired' WHEN (mcm_accexpirydate) >= current_date()  then 'Active' END as jsrsstatus,
                coalesce(DATE_FORMAT(mcm_accexpirydate, '%d-%m-%Y'),'-') as expiredate,
                MCM_CompanyName as companyname, $select  MCM_RegistrationExpiry as crstatusdate,
                `mcsvdm_memcompservdtls_fk` AS `servicePk`,
                `mcsvdm_displayname` AS `displayName`,
                'Approved' AS `serviceStatus`,
                GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
                GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `sdivision`,
                GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `ssector`,
                GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `sactivity`,
                bicc_categoryname AS `groupcategory`,
                bicsc_subcategoryname AS `maincategory`, 
                bicsm_servicename AS `subcategory`,
                concat(SrvM_ServiceCode, ' - ', SrvM_ServiceName) AS `categorycode`
                FROM
                membercompanymst_tbl
                INNER JOIN `memberregistrationmst_tbl` ON MemberRegMst_Pk = MCM_MemberRegMst_Fk $join
                LEFT JOIN `memcompservicedtlsmain_tbl` `mcsvdm` ON mcsvdm.mcsvdm_membercompmst_fk = MemberCompMst_Pk
                INNER JOIN `servicemst_tbl` `sm` ON sm.ServiceMst_Pk = mcsvdm_servicemst_fk
                INNER JOIN `bgiinduscodeservmst_tbl` ON mcsvdm_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk
                INNER JOIN `bgiindcodesubcateg_tbl` ON mcsvdm_bgiindcodesubcateg_fk  = bgiindcodesubcateg_pk
                INNER JOIN `bgiindcodecateg_tbl` ON mcsvdm_bgiindcodecateg_fk = bgiindcodecateg_pk
                INNER JOIN `memcompservbussrcmapmain_tbl` `mcpbsm` ON mcsvdm_memcompservdtls_fk = mcsbsmm_memcompservdtls_fk
                INNER JOIN `memcompbussrcdtlsmain_tbl` `mcb` ON mcpbsm.mcsbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk	
                INNER JOIN `businesssourcemst_tbl` `bsm` ON mcb.mcbsdm_businesssourcemst_fk = businesssourcemst_pk
                INNER JOIN `memcompsectordtls_tbl`  ON mcb.mcbsdm_memcompsecdtls_fk = MemCompSecDtls_Pk
                INNER JOIN `memcompbussrcsectormap_tbl`  ON mcb.mcbsdm_memcompbussrcdtls_fk = mcbssm_memcompbussrcdtls_fk
                INNER JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
                INNER JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
                INNER JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk
                WHERE mrm_stkholdertypmst_fk = 6 and MRM_MemberStatus = 'A'  
                GROUP BY `MemberCompMst_Pk`,`mcsvdm_memcompservdtls_fk`)) `produnion`
                ORDER BY `MemberCompMst_Pk`";
        } else{
            $select = '';
            $join = '';
            $groupby = "";
            if(isset($reqdata['sezdspecialstatus']) && $reqdata['sezdspecialstatus'] == 'yes' ){
                $select  .= " case when srd_isprioritysme =1 then 'Priority SME' else '-' end as sezardsplsts,";
                $join .= " LEFT JOIN sezadregdtls_tbl  ON srd_memcompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['specialstatus']) && $reqdata['specialstatus'] == 'yes'){
                $select  .= " coalesce(group_concat(distinct case spl.mclch_lcctype when 1 then 'CCED' when 2 then 'DUQM' when 3 then 'OXY' when 4 then 'PDO' end),'-') as splsts,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl spl ON spl.mclch_membercompmst_fk = MemberCompMst_Pk  and spl.mclch_status =1";
            }
            if(isset($reqdata['pdolcc']) && $reqdata['pdolcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(pdo.mclch_lcccerton, '%d-%m-%Y'),'-') as pdoapprovedon, case WHEN pdo.mclch_pdodivision = 1 then 'North' WHEN pdo.mclch_pdodivision = 2  then 'South' else '-' END as pdoconcessionarea, coalesce(pdodtls.mclcd_pdoaddress,'-') as pdopermanentadds,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl pdo ON pdo.mclch_membercompmst_fk = MemberCompMst_Pk and pdo.mclch_lcctype = 4 and pdo.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl pdodtls ON pdodtls.mclcd_memcomplcccerthdr_fk =pdo.memcomplcccerthdr_pk and pdodtls.mclcd_status =1";
            }
            if(isset($reqdata['ccedlcc']) && $reqdata['ccedlcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(cced.mclch_lcccerton, '%d-%m-%Y'),'-') as ccedapprovedon, coalesce(cceddtls.mclcd_blockno,'-') as ccedblock, cceddtls.mclcd_wilayatmst_fk as ccedwillayat, cceddtls.mclcd_villagemst_fk as ccedvillage,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl cced ON cced.mclch_membercompmst_fk = MemberCompMst_Pk and cced.mclch_lcctype = 1 and cced.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl cceddtls ON cceddtls.mclcd_memcomplcccerthdr_fk = cced.memcomplcccerthdr_pk and cceddtls.mclcd_status =1";
            }
            if(isset($reqdata['oxylcc']) && $reqdata['oxylcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(oxy.mclch_lcccerton, '%d-%m-%Y'),'-') as oxyapprovedon, coalesce(oxydtls.mclcd_blockno,'-') as oxyblock, oxydtls.mclcd_wilayatmst_fk as oxywillayat, oxydtls.mclcd_villagemst_fk as oxyvillage,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl oxy ON oxy.mclch_membercompmst_fk = MemberCompMst_Pk and oxy.mclch_lcctype = 3 and oxy.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl oxydtls ON oxydtls.mclcd_memcomplcccerthdr_fk =oxy.memcomplcccerthdr_pk and oxydtls.mclcd_status =1";
            }
            if(isset($reqdata['drpiclcc']) && $reqdata['drpiclcc']== 'yes'){
                $select  .= " coalesce(DATE_FORMAT(duqum.mclch_lcccerton, '%d-%m-%Y'),'-') as duqumapprovedon, duqumdtls.mclcd_wilayatmst_fk as duqumwillayat,";
                $join .= "  LEFT JOIN memcomplcccerthdr_tbl duqum ON duqum.mclch_membercompmst_fk = MemberCompMst_Pk and duqum.mclch_lcctype = 2 and duqum.mclch_status =1 LEFT JOIN memcomplcccertdtls_tbl duqumdtls ON duqumdtls.mclcd_memcomplcccerthdr_fk =duqum.memcomplcccerthdr_pk and duqumdtls.mclcd_status =1";
            }
            if(isset($reqdata['pdolcccategorydetails']) && $reqdata['pdolcccategorydetails']== 'yes'){
                $select  .= " pdocat.scfpcdm_pdocategorymst_fk as categoryname, pdocat.scfpcdm_yrofexp as yearofexp,  pdocat.scfpcdm_totcontvalue as contractvalue,";
                $join .= "  LEFT JOIN scfpdocatdtlsmain_tbl pdocat ON pdocat.scfpcdm_memcompmst_fk = MemberCompMst_Pk";
                if(isset($reqdata['specialstatus']) && $reqdata['specialstatus'] == 'yes'){
                    $groupby = "group by MemberCompMst_Pk,pdocat.scfpcdm_pdocategorymst_fk";
                }
            }
            if(isset($reqdata['omanisationpercentageasperjsrs']) && $reqdata['omanisationpercentageasperjsrs']== 'yes'){
                $select  .= " coalesce(brkdown.scficvbdt_totomanihcpct,'-') as omaizationpercntage,";
                $join .= "  LEFT JOIN scficvbreakdowntmp_tbl brkdown ON brkdown.scficvbdt_memcompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['omanisationpercentageasperministry']) && $reqdata['omanisationpercentageasperministry']== 'yes'){
                $select  .= " coalesce(mmp.momp_specialistomani,'-') as specialistomani,
                    coalesce(mmp.momp_specialistexpats,'-') as specialistexpats,
                    coalesce(mmp.momp_totalspecialist,'-') as totalspecialist,
                    coalesce(mmp.momp_techomani,'-') as techomani,
                    coalesce(mmp.momp_techexpats,'-') as techexpats,
                    coalesce(mmp.momp_totaltech,'-') as totaltech,
                    coalesce(mmp.momp_occupantomani,'-') as occupantomani,
                    coalesce(mmp.momp_occupantexpat,'-') as occupantexpat,
                    coalesce(mmp.momp_totaloccupant,'-') as totaloccupant,
                    coalesce(mmp.momp_skilledomani,'-') as skilledomani,
                    coalesce(mmp.momp_skilledexpat,'-') as skilledexpat,
                    coalesce(mmp.momp_totalskilled,'-') as totalskilled,
                    coalesce(mmp.momp_lowskilledomani,'-') as lowskilledomani,
                    coalesce(mmp.momp_lowskilledexpat,'-') as lowskilledexpat,
                    coalesce(mmp.momp_totallowskilled,'-') as totallowskilled,
                    mmp.momp_omanisation as percentage,
                    coalesce(mmp.momp_totalomani,'-') as totalomani,
                    coalesce(mmp.momp_totalexpat,'-') as totalexpat,";            
                $join .= "  LEFT JOIN ministofmanpower_tbl mmp ON mmp.momp_membercompmst_fk = MemberCompMst_Pk";
            }
            if(isset($reqdata['jsrscontactdetails']) && $reqdata['jsrscontactdetails']== 'yes'){
                if(isset($reqdata['jsrsname']) && $reqdata['jsrsname']== 'yes'){
                    $select  .= " concat_ws(' ',jsrscont.um_firstname,jsrscont.um_middlename, jsrscont.um_lastname) as jsrsName,";
                }
                if(isset($reqdata['jsrsemail']) && $reqdata['jsrsemail']== 'yes'){
                    $select  .= " coalesce(jsrscont.UM_EmailID,'-') as jsrsemailid,";
                }
                if(isset($reqdata['jsrsphone']) && $reqdata['jsrsphone']== 'yes'){
                    $select  .= " jsrscont.um_landlinecc as jsrslandlinecc, concat_ws(' ',jsrscont.um_landlineno, jsrscont.um_landlineext) as jsrslandline,";
                }
                if(isset($reqdata['jsrsmobile']) && $reqdata['jsrsmobile']== 'yes'){
                    $select  .= " jsrscont.um_primobnocc as jsrscc,  jsrscont.um_primobno as jsrsmobile,";
                }
                $join .= "  LEFT JOIN suppcertformpartrn_tbl jsrscontact ON jsrscontact.scfpt_membercompmst_fk = MemberCompMst_Pk and jsrscontact.scfpt_bgivaldocsubcatmst_fk =98 LEFT JOIN usermst_tbl jsrscont ON jsrscont.UserMst_Pk = jsrscontact.scfpt_paramvalue";
            }
            if(isset($reqdata['primarycontactdetails']) && $reqdata['primarycontactdetails']== 'yes'){
                if(isset($reqdata['primaryname']) && $reqdata['primaryname']== 'yes'){
                    $select  .= " concat_ws(' ',prim.um_firstname,prim.um_middlename, prim.um_lastname) as primaryName,";
                }
                if(isset($reqdata['primaryemail']) && $reqdata['primaryemail']== 'yes'){
                    $select  .= " coalesce(prim.UM_EmailID,'-') as primaryemailid,";
                }
                if(isset($reqdata['primaryphone']) && $reqdata['primaryphone']== 'yes'){
                    $select  .= " prim.um_landlinecc as landlinecc,  concat_ws(' ',prim.um_landlineno,prim.um_landlineext) as primarylandline,";
                }
                if(isset($reqdata['primarymobile']) && $reqdata['primarymobile']== 'yes'){
                    $select  .= " prim.um_primobnocc as primarycc,  prim.um_primobno as primarymobile,";
                }
                $join .= "  INNER JOIN usermst_tbl prim ON prim.UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk and prim.um_pymtcontact = 1";
            }
             if(isset($reqdata['incorporatestyle']) && $reqdata['incorporatestyle']== 'yes'){
                $select  .= " coalesce(ISM_IncorpStyleEntity,'-') as incorpstyle,";
                $join .= "  LEFT JOIN incorpstylemst_tbl ON mrm_incorpstylemst_fk = IncorpStyleMst_Pk";
            }
             if(isset($reqdata['classification']) && $reqdata['classification']== 'yes'){
                $select  .= "  coalesce(ClM_ClassificationType,'-') as classiciation,";
                $join .= "  LEFT JOIN classificationmst_tbl ON mcm_classificationmst_fk = ClassificationMst_Pk";
            }
             if(isset($reqdata['establishmentyear']) && $reqdata['establishmentyear']== 'yes'){
                $select  .= "  coalesce(DATE_FORMAT(MCM_RegistrationYear,'%d-%m-%Y'),'-') as establismentyr,";
            }
            if(isset($reqdata['commercialregistrationno']) && $reqdata['commercialregistrationno']== 'yes'){
                $select  .= "  coalesce(commno.scfpt_paramvalue,'-') as commercialnumb,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl commno ON commno.scfpt_membercompmst_fk = MemberCompMst_Pk and commno.scfpt_bgivaldocsubcatmst_fk =2 
               and commno.scfpt_bgivaldocsubcatpardtls_fk = 397";
            }
            if(isset($reqdata['commercialregistrationexpiry']) && $reqdata['commercialregistrationexpiry']== 'yes' ){
                $select  .= "  coalesce(DATE_FORMAT(commex.scfpt_paramvalue,'%d-%m-%Y'),'-') as commercialexpiredate,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl commex ON commex.scfpt_membercompmst_fk = MemberCompMst_Pk and commex.scfpt_bgivaldocsubcatmst_fk =2 
               and commex.scfpt_bgivaldocsubcatpardtls_fk = 9";
            }            
            if(isset($reqdata['chamberofcommercecertificateno']) && $reqdata['chamberofcommercecertificateno']== 'yes'){
                $select  .=  "  coalesce(chamberno.scfpt_paramvalue,'-') as chambernumber,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberno ON chamberno.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberno.scfpt_bgivaldocsubcatmst_fk =30  and chamberno.scfpt_bgivaldocsubcatpardtls_fk  = 398";
            }
            if(isset($reqdata['chamberofcommercecertificateexpiry']) && $reqdata['chamberofcommercecertificateexpiry']== 'yes' ){
                $select  .= "  coalesce(DATE_FORMAT(chamberex.scfpt_paramvalue,'%d-%m-%Y'),'-') as chamberexpiredate,";
                $join .= "  LEFT JOIN suppcertformpartrn_tbl chamberex ON chamberex.scfpt_membercompmst_fk = MemberCompMst_Pk and chamberex.scfpt_bgivaldocsubcatmst_fk =30 and chamberex.scfpt_bgivaldocsubcatpardtls_fk = 151";
            }            
            if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' || isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' || isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' || isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                $join .= "  LEFT JOIN memcompmplocationdtls_tbl ON mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1";
                if(isset($reqdata['officeaddress']) && $reqdata['officeaddress']== 'yes' || isset($reqdata['country']) && $reqdata['country']== 'yes' ){
                    $select  .= "  mcmpld_address as officeaddress, mcmpld_countrymst_fk as officeaddcountry, mcmpld_statemst_fk as officeaddstate, mcmpld_citymst_fk as officeaddcity,";
                }
                if(isset($reqdata['postaladdress']) && $reqdata['postaladdress']== 'yes' ){
                    $select  .= " mcmpld_postaladdress as postaladdress, mcmpld_postalcountrymst_fk as postalcountyfk, mcmpld_postalstatemst_fk as postalstate, mcmpld_postalcitymst_fk as postalcity,";
                }
                if(isset($reqdata['phoneno']) && $reqdata['phoneno']== 'yes' ){
                    $select  .= " mcmpld_landlinenocc as companylandlinecc, concat_ws(' ',mcmpld_landlineno,mcmpld_landlineext) as companylandline,";
                }
                if(isset($reqdata['companywebsite']) && $reqdata['companywebsite']== 'yes' ){
                    $select  .= " coalesce(mcmpld_website,'-') as compwebsite,";
                }
                if(isset($reqdata['companyemail']) && $reqdata['companyemail']== 'yes' ){
                    $select  .= " coalesce(mcmpld_emailid,'-') as compemail,";
                }
            }
            if(isset($reqdata['orgin']) && $reqdata['orgin']== 'yes' ){
                $select  .= " case when MCM_Origin ='I' then 'International' else 'National' end as origin,";
            }
            if(isset($reqdata['division']) && $reqdata['division']== 'yes' ){
                $select  .= " coalesce(mcsd_businessunitrefname,'-') as division,  group_concat(distinct SecM_SectorName)  as sector,";
                $join .= "  LEFT JOIN memcompsectordtls_tbl ON MCSD_MemberCompMst_Fk = MemberCompMst_Pk  LEFT JOIN sectormst_tbl ON find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)";
//                if(isset($reqdata['specialstatus']) && $reqdata['specialstatus'] == 'yes'){
                    $groupby = "group by MemberCompMst_Pk,MemCompSecDtls_Pk";
//                }
            }
            if(isset($reqdata['shareholdersinformation']) && $reqdata['shareholdersinformation']== 'yes' ){
                $select  .= " count(sharehold.memcompshareholderdtlsmain_pk) as totalshareholder, case when sharehold.mcshdm_type =1 then 'Organization' else 'Individual' end as type, coalesce(sharehold.mcshdm_name,'-') as name, coalesce(sharehold.mcshdm_regno,'-') as idnumber,  sharehold.mcshdm_countrymst_fk as countryval,  coalesce(sharehold.mcshdm_percentofstake,'-') as percenatge,";
                $join .= " LEFT JOIN memcompshareholderdtlsmain_tbl sharehold ON sharehold.mcshdm_memcompmst_fk = MemberCompMst_Pk";
                $groupby = "group by MemberCompMst_Pk,memcompshareholderdtlsmain_pk";
            }
            $query = "SELECT 
                    MemberCompMst_Pk,
                    coalesce(mcm_RegistrationNo,'-') as regno,
                    coalesce(MCM_SupplierCode,'-') as suppliercode,
                    case WHEN (mcm_accexpirydate) < current_date() then 'Expired' WHEN (mcm_accexpirydate) >= current_date()  then 'Active' END as jsrsstatus,
                    coalesce(DATE_FORMAT(mcm_accexpirydate, '%d-%m-%Y'),'-') as expiredate,
                    MCM_CompanyName as companyname, $select  MCM_RegistrationExpiry as crstatusdate 
                    FROM membercompanymst_tbl 
                    INNER JOIN memberregistrationmst_tbl ON MemberRegMst_Pk = MCM_MemberRegMst_Fk $join
                    WHERE mrm_stkholdertypmst_fk = 6 and MRM_MemberStatus = 'A'  $groupby";
        }        
        return $query;
    }
    public function getSavedSearchInfo($compPk){
        $favsrchinfo = [];
	if($compPk != ''){
            $favsrchinfo = \api\modules\mst\models\FavsrchmstTbl::find()
                ->select(['fsd_criteriabag','fsd_srchtype','fsd_prevsrchcnt','fsm_srchname'])
                ->innerJoin('favsrchdtls_tbl','fsd_favsrchmst_fk = favsrchmst_pk')
                ->where([
                        'fsm_memberregmst_fk'=>$compPk,
                        'fsd_status'=>1
                ])
                ->asArray()->all();
	}
        return $favsrchinfo;
}

public function getSezadStatusValue(){
     return $sezad_status_array = array("1"=>"New","2"=>"Updated","3"=>"Renewed","4"=>"Change in Company Name","5"=>"Classification Change","6"=>"Change in Company name and classification","7"=>"Uploaded via back-end");;
    }

public function getSezadApplStatusValue(){
    return $sezad_appl_status_array = array("1"=>"New","2"=>"Updated","3"=>"Renewed","4"=>"Change in Company Name","5"=>"Classification Change","6"=>"Change in Company name and classification","7"=>"Uploaded via back-end");;
    }




}
