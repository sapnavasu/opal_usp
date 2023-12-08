<?php

namespace api\modules\mst\components;
use Yii;
use \common\models\UserpermtrnTbl;

class Permission {
    
    public $stakeHolderModules=[];
    public $commonUrl=[];
    public $moduleIdsUrl=[];
    public $combinedUrls=[];
    public $accessType = [
        '1' => 'C', // Create
        '2' => 'R', // Read
        '3' => 'U', // Update
        '4' => 'D', // Delete
        '5' => 'A', // Approval
        '6' => 'DL' // Download
    ];


    public function __construct(){
        $this->stakeHolderModules = [
            '1' => self::superAdminModule(),
            '6' => self::supplierModule(),
            '7' => self::buyerModule(),
        ];
        $this->moduleIdsUrl = self::moduleIdsUrl();
        $this->commonUrl = self::commonUrls();
    }

    public function commonUrls(){
        $moduleUrls = ['admin/login','home/dashboard','profile/logout','stkholderaccessmaster/getstkholdertypes','menu/getmenulist','drive/view', 'businessunit/bunit-filter-initial-data', 'user/recentsearch', 'user/getinsight', 'businessunit/list-bunit','user/fetch-user-company-details','user/list-stakholder-users','user/get-stakholder-department','user/fetch-user-details','country/countrylist', 'sectormst/businessunitlist', 'timezone/timezonelist','businessunit/fetch-bunit-data','user/enterprise-filter-initial-data', 'user/branchnamelist','user/fetch-user-details','country/countrylist', 'menu/user-access-check','drive/filemst'];

        return $moduleUrls;
    }

    public function superAdminModule(){
        $moduleIds = ['2','5','6','8'];

        return $moduleIds;
    }

    public function buyerModule(){
        $moduleIds = ['2','5','6','8'];

        return $moduleIds;
    }
    
    public function supplierModule(){
        $moduleIds = ['19','20','21','22','23','46','47','48','45'];

        return $moduleIds;
    }

    public function moduleIdsUrl(){
        $moduleUrls = [
            // Company Profile
//            '2'=> [
//                    'C'=>['mastercompanyprofile/insertcontactus', 'mastercompanyprofile/savecrdetails', 'mastercompanyprofile/savecpbasicinfo', 'mastercompanyprofile/savebusinessunit', 'mastercompanyprofile/saveannualturnover', 'mastercompanyprofile/savebankdetails', 'mastercompanyprofile/saveauditordetails', 'mastercompanyprofile/sectordetails', 'mastercompanyprofile/auditorinformation', 'mastercompanyprofile/savewebpresenceinfo', 'mastercompanyprofile/save-board-of-director', 'mastercompanyprofile/savemarketpresence', 'mastercompanyprofile/savestockmarketdtls'],
//                    'R'=>['mastercompanyprofile/contactusmasterdata','mastercompanyprofile/companyinformation','mastercompanyprofile/viewsectordetails', 'mastercompanyprofile/auditorinfo', 'mastercompanyprofile/webpresence', 'mastercompanyprofile/board-of-directors', 'mastercompanyprofile/get-board-of-director', 'mastercompanyprofile/isvalidlink', 'mastercompanyprofile/marketpresencelist', 'mastercompanyprofile/getmarketpresence', 'mastercompanyprofile/isregionexist', 'mastercompanyprofile/bankinfolist', 'mastercompanyprofile/grpcmpnamesugg', 'mastercompanyprofile/grpcmpcodesugg', 'mastercompanyprofile/crinfo', 'mastercompanyprofile/contactinfolist', 'mastercompanyprofile/stockmarketdetails'],
//                    'U'=>['mastercompanyprofile/update-sort'],
//                    'D'=>['mastercompanyprofile/deleteauditor', 'mastercompanyprofile/deletesectordetails', 'mastercompanyprofile/delete-board-of-director', 'mastercompanyprofile/deletemarketpresence', 'mastercompanyprofile/deletebankerinfo'],
//                    'A'=>[],
//                    'DL'=>[],
//                ],
            //Company Information
            '18'=> [
                    'C'=>['mastercompanyprofile/insertcontactus','mastercompanyprofile/savecpbasicinfo','mastercompanyprofile/savebusinessunit'],
                    'R'=>['mastercompanyprofile/companyinformation','profile/currencylist','profile/getsectorlist','user/users-by-dept','mastercompanyprofile/contactusmasterdata','mastercompanyprofile/contactusccdata','drive/filemst','profile/getincorpstyle','mastercompanyprofile/businessunit','mastercompanyprofile/viewsectordetails'],
                    'U'=>[],
                    'D'=>['mastercompanyprofile/deletesectordetails'],
                    'A'=>[],
                    'DL'=>[],
                ],
//            About Company
            '19'=> [
                    'C'=>['aboutus/save-aboutus','aboutus/save-vission-mission','supportcollateral/save-sc','drive/upload'],
                    'R'=>['aboutus/fetch-about-company','supportcollateral/fetch-support-collateral','drive/filemst','drive/list','svf/logdata','drive/mapreference'],
                    'U'=>[],
                    'D'=>[],
                    'A'=>[],
                    'DL'=>[],
                ],
//            accomplishment
            '20'=> [
                    'C'=>['accomplishments/save-accomplishment'],
                    'R'=>['accomplishments/fetch-accomplishment','drive/filemst','accomplishments/fetch-acmp'],
                    'U'=>[],
                    'D'=>['accomplishments/delete-accomplishment'],
                    'A'=>[],
                    'DL'=>[],
                ],
//            market presence
             '21'=> [
                    'C'=>['mastercompanyprofile/savemarketpresence'],
                    'R'=>['mastercompanyprofile/marketpresencelist','statemaster/statelistbycountry','citymaster/getcitybystateid'],
                    'U'=>[],
                    'D'=>['mastercompanyprofile/deletemarketpresence'],
                    'A'=>[],
                    'DL'=>[],
                ],
//            web presence
                  '22'=> [
                    'C'=>['mastercompanyprofile/savewebpresenceinfo'],
                    'R'=>['mastercompanyprofile/checkalreadyexists','mastercompanyprofile/webpresence','mastercompanyprofile/isvalidlink'],
                    'U'=>[],
                    'D'=>[],
                    'A'=>[],
                    'DL'=>[],
                ],
//            board-of-directors
                  '23'=> [
                    'C'=>['mastercompanyprofile/save-board-of-director'],
                    'R'=>['mastercompanyprofile/board-of-directors','user/designationlist','drive/filemst','mastercompanyprofile/get-board-of-director'],
                    'U'=>[],
                    'D'=>['mastercompanyprofile/delete-board-of-director'],
                    'A'=>[],
                    'DL'=>[],
                ],
            // Department Mangement
            '46' => [
                    'C'=>['department/save-bunit-department',],
                    'R'=>['enterpriseadmin/department', 'department/fetch-department-by-bunit', 'department/list-bunit-department', 'department/fetch-business-unit','user/fetch-enterprise-count','department/fetch-bunit-department'],
                    'U'=>['department/change-bunit-dept-status'],
                    'D'=>['department/change-bunit-dept-status'],
                    'A'=>[],
                    'DL'=>[],
                ],
            // User Management
            '47' => [
                    'C'=>['department/save-bunit-department','user/save-user'],
                    'R'=>['enterpriseadmin/usermanagement','user/fetch-enterprise-count','department/fetch-department-by-bunit','user/stk-update-user-details','user/enterprise-filter','user/users-by-dept','profile/getsectorlist','department/fetch-business-unit','mastercompanyprofile/businessunit'],
                    'U'=>['user/update-stakholder-users'],
                    'D'=>['user/update-stakholder-users'],
                    'A'=>[],
                    'DL'=>[],
                ],
            // Division
            '45' => [
                    'C'=>['mastercompanyprofile/savebusinessunit'],
                    'R'=>['enterpriseadmin/usermanagement','user/fetch-enterprise-count','department/fetch-business-unit','user/users-by-dept','profile/getsectorlist','mastercompanyprofile/businessunit'],
                    'U'=>[],
                    'D'=>['businessunit/delete-bunit'],
                    'A'=>[],
                    'DL'=>[],
                ],
            // Monitor Log
            '48' => [
                    'C'=>[],
                    'R'=>['monitor/get-activity-log','monitor/fetch-user-login-details','user/fetch-enterprise-count'],
                    'U'=>[],
                    'D'=>[],
                    'A'=>[],
                    'DL'=>[],
                ],
            // business source
            '25' => [
                    'C'=>['mastercompanyprofile/savebusinessunit','bussource/createbusinesssource','bussource/savebussrcunitsectoractivty','bussource/savefactpermit','bussource/addmanufactdtls','bussource/mapcontactdetails','bussource/bussrcfinalsubmit'],
                    'R'=>['bussource/getbusrclist','bussource/getbsunitsector','bussource/listbusinesssource','bussource/getsectorlist','bussource/getbusrclist','bussource/getbussrcsectoractivity','bussource/getbusinesssource','bussource/getbussrcunitsector','bussource/getfactpermitdetails','profile/currencylist','profile/unitlist','profile/getfactoryinfo','user/users-by-dept','user/users-by-dept','user/get-stakholder-department','profile/getsectorlist','department/fetch-business-unit','user/fetch-user-details','sectormst/businessunitlist','mastercompanyprofile/businessunit','bussource/getcontactdata','mastercompanyprofile/companyinformation','mastercompanyprofile/contactusmasterdata','mastercompanyprofile/contactusccdata','mastercompanyprofile/businessunit','profile/getincorpstyle','bussource/getmanufacturerdetails','bussource/getbussrcunitsectoractlist','bussource/getcontactdetails','profile/getproductgroup','profile/getlookup','profile/getspecification','profile/prodspecdtbgi','profile/getuserdefspecmst','profile/unitlist','profile/getcategorylist','profile/businesssourcewithtrade','profile/productcount','supportcollateral/fetch-support-collateral-data','profile/getcontactdetails','profile/getproductlistkey'],
                    'U'=>['mastercompanyprofile/savebusinessunit','bussource/createbusinesssource','bussource/savebussrcunitsectoractivty','bussource/savefactpermit','bussource/addmanufactdtls','bussource/mapcontactdetails','bussource/bussrcfinalsubmit'],
                    'D'=>['bussource/deletebs'],
                    'A'=>[],
                    'DL'=>[],
                ],
            // product 
            '26' => [
                    'C'=>['profile/partisionsave','profile/addproductgroup','profile/addproductdocs','profile/faqsave','profile/map'],
                    'R'=>['profile/getattrlabel','profile/getprodlist','profile/getbusinesssource','profile/getunpsc','profile/getsector','profile/getbusinesssourcelist','bussource/getdivisionlist','profile/getproductgroup','profile/getlookup','profile/getspecification','profile/unitlist','profile/getcategorylist','profile/getsectorlist','profile/businesssourcewithtrade','profile/productcount','supportcollateral/fetch-support-collateral-data','profile/getcontactdetails','profile/getproductlistkey','profile/getsubcategory','profile/getbgiproduct','profile/getproductunpsc','profile/getwikipedia','profile/getrelatedproductsugg','profile/getfamilylist','profile/getproductonsearch','profile/getproductgroupid','profile/prodspecdtbgi','profile/getuserdefspecmst','bussource/getcontactdetailsmultiple','profile/getmappedbus','profile/generatekeywords','profile/getquantityprice','svf/logdata','user/users-by-dept','user/get-stakholder-department','profile/getsectorlist','department/fetch-business-unit','user/fetch-user-details','sectormst/businessunitlist','businessunit/fetch-bunit-data','mastercompanyprofile/businessunit'],
                    'U'=>['profile/partisionsave','profile/addproductgroup','profile/addproductdocs','profile/faqsave','profile/map'],
                    'D'=>['profile/deleteproduct'],
                    'A'=>[],
                    'DL'=>['profile/exportcsv'],
                ],
            //services
            '27' => [
                    'C'=>['profile/servicepartitionsave','profile/addservicedocs','profile/faqsave','profile/mapservice'],
                    'R'=>['profile/getattrlabel','profile/getservicelist','profile/getbusinesssourceforservice','profile/getbusinesssourcserviceelist','profile/getunpscforservice','profile/getsectorforservice','bussource/getdivisionlist','profile/getlookup','profile/getspecification','profile/unitlist','profile/getcategorylist','profile/getsegmentlist','profile/getsectorlist','profile/getsocialmedialist','profile/businesssourceforservice','supportcollateral/fetch-support-collateral-data','profile/servicecount','profile/sectormaping','profile/getcontactdetailsforservice','profile/getsubcategory','profile/getbgiservice','profile/getserviceunpsc','profile/getwikipedia','profile/getrelatedservicesugg','profile/getserviceonsearch','profile/getproductgroup','profile/getproductgroupid','profile/servicespec','profile/getuserdefspecmst','bussource/getcontactdetailsmultiple','profile/getmappedbus','profile/generatekeywords','svf/logdata','profile/getservicelistkey','user/users-by-dept','user/get-stakholder-department','profile/getsectorlist','department/fetch-business-unit','user/fetch-user-details','sectormst/businessunitlist','businessunit/fetch-bunit-data','mastercompanyprofile/businessunit'],
                    'U'=>['profile/servicepartitionsave','profile/addservicedocs','profile/faqsave','profile/mapservice'],
                    'D'=>['profile/deleteservice'],
                    'A'=>[],
                    'DL'=>['profile/exportcsv'],
                ]
            
        ];

        return $moduleUrls;
    }
    

    public function checkPermission($stkType, $userPk){
        $currentPage = strtolower(Yii::$app->controller->id . '/' . Yii::$app->controller->action->id);
        $userPermission = self::fetchUserPermission($userPk);
//        $stakeHolderModules[$stkType] = [];
        $accessedUrl = [];
        foreach ($this->stakeHolderModules[$stkType] as $moduleId) {
            $usrAccessPermission = $userPermission[$moduleId];
            if(!empty($usrAccessPermission)){      
                $userperarr = json_decode($usrAccessPermission);
                foreach ($userperarr as $permissions) {
                    $accessKey = $this->accessType[$permissions];
                    $moduleUrls = $this->moduleIdsUrl[$moduleId][$accessKey];
                    foreach ($moduleUrls as $moduleUrl) {
                        $accessedUrl[] = $moduleUrl;
                    }
                }
            }
        }
        foreach ($this->commonUrl as $commonModuleUrl) {
            $accessedUrl[] = $commonModuleUrl;
        }
        if(in_array($currentPage, $accessedUrl)){
            return true;
        }else{
            return false;
        }
    }

    public function fetchUserPermission($userPk){
        $userAccess = UserpermtrnTbl::getUserPermission($userPk,'2');
        $userAccessFormatin = [];
        foreach ($userAccess as $key => $ua) {
            $userAccessFormatin[$ua['upt_basemodulemst_fk']] = json_decode($ua['upt_access']);
        }
        return $userAccessFormatin;
    }
}
