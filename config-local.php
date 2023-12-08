<?php
$hostName = $_SERVER['HTTP_HOST'];
$serverPath = 'J:/xampp7/';
$appPath = 'J:/xampp7/htdocs/opal_usp/';
return [
    'memcache_config' => [
        'MEMCACHE_HOST' => '192.168.1.200',
        'MEMCACHE_PORT' => 11211,
        'MEMCACHE_KEY_EXPIRY' => 3600,
    ],
    'menu_stk1' => require(__DIR__ . '/menus/menuFormation/menu_stk1.php'),
    'menu_stk2' => require(__DIR__ . '/menus/menuFormation/menu_stk2.php'),
    'menu_stk3' => require(__DIR__ . '/menus/menuFormation/menu_stk3.php'),
    'menu_stk4' => require(__DIR__ . '/menus/menuFormation/menu_stk4.php'),
    'menu_stk5' => require(__DIR__ . '/menus/menuFormation/menu_stk5.php'),
    'menu_stk6' => require(__DIR__ . '/menus/menuFormation/menu_stk6.php'),
    'menu_stk15' => require(__DIR__ . '/menus/menuFormation/menu_stk15.php'),
    'menu_stk7' => require(__DIR__ . '/menus/menuFormation/menu_stk7.php'),
    'menu_stk8' => require(__DIR__ . '/menus/menuFormation/menu_stk8.php'),
    'menu_stk9' => require(__DIR__ . '/menus/menuFormation/menu_stk9.php'),
    'menu_stk10' => require(__DIR__ . '/menus/menuFormation/menu_stk10.php'),
    'menu_stk11' => require(__DIR__ . '/menus/menuFormation/menu_stk11.php'),
    'menu_stk12' => require(__DIR__ . '/menus/menuFormation/menu_stk12.php'),
    'menu_stk13' => require(__DIR__ . '/menus/menuFormation/menu_stk13.php'),
    'timezone' => '74',
    'globalportalmst_pk' => '5',
    'sezadAnalyticsPk' => '548',
    'countrypk' => 31,
    'setglobalforall' => false,
    'srcDirectory'=>$appPath."api/",
    'uploadPath'=>"web/uploads",
    'tempDirectory'=>$appPath."web/temp",
    'loginExportPath' => $appPath.'loginReportTemplate.xlsx',
    'loginExportSavePath' => $appPath,
    'activityExportPath' => $appPath.'activityReportTemplate.xlsx',
    'activityExportSavePath' => $appPath,
    'consolePath' => $appPath."console/",
    'supplierStatExportPath' => $appPath.'supplierStatReportTemplate.xlsx',
    'multiprodNservmapPath' => $appPath.'multiprodNservmapTemplate.xlsx',
    'evaluationCompareListPath' => $appPath.'evaluationCompareListTemplate.xlsx',
    'supplierStatExportSavePath' => $appPath,
    'baseUrl' => 'http://'.$hostName.'/opal_usp/app/',
    'backendBaseUrl' => 'http://'.$hostName.'/opal_usp/',
    'APP_URL'=>'http://'.$hostName.'/opal_usp/', // for mail template 
    'baseMailPath'=>'http://'.$hostName.'/opal_usp/api/', // for mail template
    "JSRS_v2_baseURL" => "http://".$hostName."/jsrslive/", // JSRS J2 existing pack link
    'consoleCalling' => $serverPath.'php/php.exe',
    
    'supportCollateralMaxUpload'=>5,
    'productSupportCollateralMaxUpload'=>5,
    'productSupportCollateralURLMaxUpload'=>3,
    'supportCollateralNoteText'=>"You can upload 3 (.pdf, .jpeg, .jpg or .png) of max. size 5MB each.",
    'otherDocumentMaxUpload'=>3,
    'otherDocumentNoteText'=>"You can upload 3 (.pdf, .jpeg, .jpg or .png) of max. size 5MB each.",
    'testMailIDs' => ['sapna@businessgateways.com','manoj@businessgateways.com','jeeva@businessgateways.com','sophiya.redblox@businessgateways.com'],//jeeva@businessgateways.com
    'ccmailIDs' => [],
    'twofactorremainderduration' => 30, // days
    'fgtPwdMailAttemptLimit' => 3,
    'fgtPwdMailValidHrs' => 168,
    'paymentlinkvalidhours' => 168,
    'OTPExpiryDuration' => 15,
    'changeUserValidDays' => 1,
    'thisProjectFor' => 'JSRS',
    'accordionPerpage' => 3,
    'nonAccordionPerpage' => 9,
    'bizsearchHistoryDateLimit' => 10,
    'loginattemptcount'=>3,
    'OTP'=> array(
        'twofactor'=>array(
            'attempts' =>  3,
            'expiryduration'=>15, //mins
            'resendcount'=>3,
            ),
        'login'=>array(
            'attempts' =>  3,
            'expiryduration'=>15, //mins
            'resendcount'=>3,
            ),
        'setpassword'=>array(
            'attempts' =>  3,
            'expiryduration'=>15, //mins
            'resendcount'=>3,
            ),
        'emailverify'=>array(
            'attempts' =>  3,
            'expiryduration'=>15, //mins
            'resendcount'=>3,
            ),
        'mobileverify'=>array(
            'attempts' =>  3,
            'expiryduration'=>15, //mins
            'resendcount'=>3,
            ),
    ),
    'sms'=>[
        'Ooredoo'=>false,
        'iBulkSMS'=>false
        ],
    'smslog'=>true,
    'projectConfig' => array(
        'JSRS' => array(
            'name' => 'JSRS',
            'shortName' => 'JSRS',
            'projectCommonidMask' => '{SHORTNAME}-{COUNTRY}-{INCVAL}',
        ),'LyPIS'=>array(
            'name' => 'LyPIS',
            'shortName' => 'LIP',
            'projectCommonidMask' => '{SHORTNAME}-{COUNTRY}-{INCVAL}',
        ),
    ),
    'registration'=>[
        'blockCR'=>[
               0=>['CRNo'=>'1032897','expDate'=>'2021-02-03','comregnomessage'=>'Commercial Reg. No already registered'],// date format y-m-d
        ]
    ],
    'GOV_PROJECT_ENABLE' => false,
    'thisProjectName' => 'J3',
    'classificationdate' => '2022-10-18',
    'regConfirmDays' => 45,
    'owneridcardimportcount' => 15,
    'Payment_grace_period' => '10', // 10 days for payment grace period
    'Payment_grace_period_end' => '11', // 11th day payment grace period end date
    'Account_inactivation_period' => '30', // 11 th day to 30 days inactivated period
    'Account_inactivation_period_end' => '31', // 11 th day to 30 days inactivated period
    'Account_deactivation_period' => '180', // 180 days account activation period
    'Account_deactivate_from' => '181', // from 181th day account deactivated
    'Nearing_expiry' => '60', //Nearing Expiry 60 days
    'Discount' => true,
    'Promocode_enable' => true,
    'VAT' => [
        'Nat_vatpercent' => '5',
        'Intl_vatpercent' => '0',
        'to_be_generated_from' => '2021-04-15',
        'BGI_VAT_Info' => [
            'C.R.' => '1092611',
            'TaxCard' => '8058306',
            'VATIN' => 'OM1100015174'
        ],
        'invno_nomenclature' => 'R-'
    ],
    'eBid' => [
        'baseLink' => 'http://192.168.1.93:8081', //e-Tender base link
        'folderName' => 'eProcurementJ3', //e-Tender root Name
        'DB_Name' => 'jsrs_etendintegrationv3', //e-Tender DB Name
        // 'suppCMEnable'=>true, //Supplier end contract management module enable
        // 'etenderAward'=>false, //this paramter based only e-tender module will enable in JSRS system
        'access' => [
            'buyerEnd' => [
                'eTender' => FALSE, //etender alone module will enable
                'eAuction' => FALSE, //eauction alone module will enable
            ],
            'supplierEnd' => [
                'eTender' => True, //etender alone module will enable
                'eAuction' => True, //eauction alone module will enable
            ],
        ],
    ],
    'operatorDetials' => [
        'omanlng' => [
            'compPk' => 577,
            'regpk'=>584,
        ]
    ],
    'scficvexpiry' => 180,
    'scficvnearingexpiry' => 30,
    'MCPpoints' => [
        'Establishmentyr' => 10,
        'incorporatestyle' => 10,
        'division' => 10,
        'externalprof' => 10,
        'boardmember' => 20,
        'managementmember' => 20,
        'registeredoffice' => 20
    ],
    'Productspoints' => [
        'displayname' => 10,
        'contactinfo' => 10,
        'supportcoll' => 10,
        'productdesc' => 5,
        'productorgin' => 5,
        'productmode' => 5,
        'productordercap' => 5,
        'productminorder' => 5,
        'productmaxorder' => 5,
        'categoryinfo' => 20,
        'businesssrc' => 20
    ],
    'Servicesspoints' => [
        'displayname' => 20,
        'servicesdesc' => 20,
        'contactinfo' => 20,
        'servicescategory' => 20,
        'bussinessrc' => 20
    ],
    'Register' => [
        'incorpstyleForeignCompPk'=>492,//incorpstylemst_tbl->IncorpStyleMst_Pk (Foreign compamy incorprate style table Primary key) if we change this value here then we have to change the same in JSRSLIVE exiting config
        'classificationPk'=>58,//classificationmst_tbl->ClassificationMst_Pk (Foreign compamy classification table Primary key)) if we change this value here then we have to change the same in JSRSLIVE exiting config
    ],
    'lcc'=>[
        'compPk'=>[
            'pdo'=> 7,
            'cced'=>892,
            'duqm'=>610,
            'oxy'=>591,
        ]
    ],
    'Jsearch' => [
        'exportLimit' => '100',
        'biz_export_validity'=>'1' ,
    ],
    'scfautosubmit'=>7, // In renewal after paymnent approval, day count for SCF auto submit
    'sezardautosubmit'=>7, // In renewal after paymnent approval, day count for sezard auto submit
    'csrfToken'=>FALSE, // CSRF Token If true reply XHR will not work
    'rediscache' =>  [
        'class' => 'yii\caching\DummyCache', //disable cache
    ],
    'etender'=>[
        'RFI'=>false,
        'EOI'=>true,
        'PQ'=>true,
        'RFQ'=>true,
        'RFT'=>true,
        'RFP'=>false,
        'sealedbid'=>true,
        'eAuction'=>false,
    ],
    'CMS'=>[
       'Contract_success_fee_target_limit' => 39012,
    ],
    'FCBincorpstyle'=>492,
    "jsrs_connect_url" => "http://".$hostName."/jsrs/index.php?r=webservice/validateJ2&key=eyJjaXBoZXJ0ZXh0IjoiWDI3d3RGRHFQWG0yR09MXC90aVlOSXdTelZlWlwvcDY2Zlp5WkdzZzZoYVhRN3V2WlBvaGtLeDhiVUtXSURTZmxOK0RUNzMraUs5USsyN0Rqejc3dWs0NmdYMHJaZ1hMR1VYdGhNTTN4c2F2cGxDakNJUUFoNUl3aHZCZzdkXC9iY0pyNnNWY1o5YkZSMDlPd3RkSmJSRm12cnI2NmV3NU9XUkw3V1BxNmFUbGtWVnA0NE93eWtEQmJvT0JRWjRMK2pcL3dPcmRPT0p4aUFNOGhSbVIzTDNVV2RSMWlqUnZLb0pqM0VDU0FwaUgreURNeVpReGZHVjd3em9Ic0FCZU55SVBNY2syK2dLd2RoTmRqOGYxaTFVdWpUMmQ1N2Jwc2MyM0hZWUVUbVwvcFZGWTRPMXI0UDVXTTZVdjlyanZ5enM0aytcL3NHNVwvOVVqd215aUh5RGdOSHNxM0hyQW5zZXBiZjhQSkZxdGkyWE5HQytVYWRNU3R4WWNJQitsMmt6cFFvQXU4ZFwvdzJjVVNwM1VlQXRWTzRwUGFEdUJacUNtaW10TFwvMFlTVTFcL0g1V1ZxdlJob3lcL1NwNHo3NTlWamZCYnhjS1BzTm9oZXhPMUZjbmdXd1lnRjRZMVwvRHJZcStXNHd5QnpJdHE2WHMzWmFGbUJLbzFiRlZrajZ0Z2FnTERJVHF6OVNOZFBUZWJJN0lHWlhKS3VrKzlUK1JTS2I5M0hacmlKdktyZXNSVkNRbUYxTDZpZXM4Wk5qQ1ZMUmZxSDBSSUVRTXVtRVJRQmE0NXZHdHh4NWtjOTlkOUd4MTdFRTcwSGd4S2MwQ1BoTnQ5b3BDbDMwZExib3dCZThvSytPZGdERGlOZ3J5RDhFaU1lOG9RcWxxamlrSGhYcmpzSFdYVzdMSEJ6VitMTTlFTEl6ZGpDQ0d3THNKTDJkd3pwNk1tbVR4SGtoXC92ekgzWWVld0lqbEorUGJBWkhVbFJtU05nYmZNR3BTSjluWnJzWVY2VU9ZNlFQZWpUejhoNWQ2Qk5mRlBxRkhKZFlGc2hBb0Y0UXV4TjZnTFFkUkRsYksrSkFvTFV0RWRrVmNcL1J2eUx6aXM0UWl1VzR0YXBpM2RwazBBVjIydG0xSGZKVWhIdmdEcW5yVGFndjhWc2pLWDRCTVdEb1o1eXhJODROSkIrRW10OGcrTjUrXC9nRzh0N3g1YmNFeUVzOWhpUjFiYW9oSkNKQlJKbEJod3NJSzBGNnB2VlwvZGd0MzhWR0hcL1ZyTkdreFlyclNuOUJSM1U2d2pVQmRHcVJPaWxwWFJhdWFoRlVSU2dsMDNMaTRuOXR0VHlUZE1tM1UxUWVnZ2VTRnFaOGs3N09YWG14d29rOHpxZjNqcUlydFdXRDY2WHZURkU5cCt2K3FhVmFHS1dXR2dMMHltWFZaSnNBQ1dsTVpPaHZLTXZicEYyRWVQRllsVmVLcHlaV2xaYmNFU1VnQUF0Y242Z1E9PSIsIml2IjoiOTFiY2QyNDA1NjIzNGM0NTViMjNlNzNlOWU1MTNiMTQiLCJzYWx0IjoiMDY1N2I3Y2I1ZGViMzI2ODQ1ZGNmY2M1ZWE4YzhkNjUzMGE0YTM0MDE1NTJiNjI5ZWM5ODQxM2E3MjllZmE0OTdhOTRjOWE3M2ZjOWQ5ZWYyYTFhM2RiNzQ0NTI3ZTI1ZjU0MjllZTY1NTQ5MmNjMzdkZWU2OGI5ZjBhZDliNDdkM2I0Y2E2ZTVkYzNhNDQ1NjE3ZTAxYzYwZDM0YzEzZDJhNGEwYjNlNmJiYTZjYzJhZDIwNDdiMTNkYTc5MGRkODE1YTdmOGQwNzE3OWNjZTMyY2MxMDIzNWRjOTA3NDRiZWNhZmNlYjBmZjgwNTk2YTgwYWUwMDAyZDY3Y2FhYWY2MWRlYTZhM2U3Y2M3YjA4MzRjN2Q0ZDFiZjA5N2QwMjU4ZTM4OTUwMDNlNmU5YmJlMjQyNDQ1N2MxZmIxMDMwNDc5NjJmNjE2MmIwOGZjMGUyOGRhMWE0YTk1YmNiOTYyOTMwZmI5OTMyM2EyMjg0NTViMTc4NWU2YmM2ZjYyZTdjN2E4NjY2YTQ1MWJhYWM1NTUxYzM1YWQ1ZjcwNDFkZDk0ODIyNjE4ODczYWI1M2Y2MmVkNGU1MTQ3ZTI2ODRiZDg0YTg2NDZkMjI3NTEyOTljNWY4Mzg2ZDQ3NmMzZGZlNzUzZWQ5Zjg0MDM4MTQ1ZTFiYzU5ZTk4ZmVhYjYifQ==&afterlogin=JSRSCONNECT",
    'api_download_path' => [
        'tenderClosuerReport' => "web/generated/downloads/tenderClosuerReport",
        'rfxauditLog' => "web/generated/downloads/rfxauditLog"
    ],
    'supplier_profile_export' => [
        'link_expiry_hours' => 24
    ],
    'directlogin' => true,
    'discoutapplicable'=> false,
    'promoapplicable' => false,
    'reminderMailAfterPaymentApp'=>'3,10,20,35',//SCF reminder mail
    'reminderMailtToCrtScfToUpdateForm' =>'7,15,30,45' //SCF reminder mail
    
];

