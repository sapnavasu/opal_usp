<?php
$today = date('d/m/Y');
$yesterdayDate =   date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))));
return [
    'ver'=>3,
    'vatpercentage'=>5, //vat percent 5%
    'omr_currency_convert_amt_for_usd'=>2.60080, //Currency conversion from OMR to USD
    'additional_processing_charge'=>2.31, //for National suppliers collect the additional processing charge is 2.31% OMR
    'additional_processing_charge_international'=>25, //for International supplier to collect the additional processing charge is 25 USD
    'online_payment'=>true, //To disable online payment, change it to false
    'offline_payment'=>true, //To disable offline payment, change it to false
    'Currentdate' => date('Y-m-d H:i:s'),
    'baseurl'=>[
        'env'=>'demo',  
        'local'=>'http://192.168.1.31/j3/j3/api/',
        //  'local'=>'http://192.168.1.73:4200/',  
         'demo'=>'https://bgi.businessgateways.net/j3/app/',  
         'live'=>'https://businessgateways.com/',  
        ],
    'LCC' => [
        // 1=>Petroleum Development Oman LLC,
        // 2=>Consolidated Contractors Energy Development,
        // 3=>DUQM REFINERY,
        // 4=>OCCIDENTAL OMAN INCORPORATED --,4=>'17035'

        'OperatorBuyerRegPk' => [1 => '17603', 2 => '17094', 3 => '19371',4 => '17035'],
        'OxyOperatorRegPk' => '17035', //memberregistrationmst_tbl->MemberRegMst_Pk
    ],
    'WS_List_Opr'=>[ // key->operator/buyer regpk, Value->operator short name 
        'pdo'=>17603,
        'daleel'=>17601
        
    ],
    'WS_Url_Arr'=>['daleel'=>'daleelclient'],
    'config'=>[
        'pdo'=>[]
    ],
    'OprDetails'=>[ // key->operator/buyer compk, Value->Operator / Buyer Details
        // 22=>[
        //     'shortName'=>'omanlng',
        //     'regPk'=>17598,
        //     'openTender_WS_MailId_Notify_list'=>[
        //             'to'=>array('karthick@businessgateways.com'),
        //             'cc'=>array('kirubanithi@businessgateways.com'),
        //             'bcc'=>array('sudhakar@businessgateways.com')
        //         ],
        //     'openTender_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetTendersDetails?Publishing_date='.$yesterdayDate,
        //     'openContract_WS_MailId_Notify_list'=>[
        //             'to'=>array('kirubanithi@businessgateways.com','praveen@businessgateways.com'),
        //             'cc'=>array(),
        //             'bcc'=>array()
        //         ],
        // ],  
        15=>[
            'shortName'=>'omanlng',
            'regPk'=>15,
            'openTender_WS_MailId_Notify_list'=>[
                    'to'=>array('dineshkumar@businessgateways.com'),
                    'cc'=>array('dineshkumar@businessgateways.com'),
                ],
            'openTender_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetTendersDetails?Publishing_date='.$yesterdayDate,
            'openContract_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetContractsDetails?Actual_Date='.$yesterdayDate,
            // 'openContract_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetContractsDetails?Actual_Date=07/04/2016',
            // 'openTender_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetTendersDetails?Publishing_date=07/04/2016', 
            'openContract_WS_MailId_Notify_list'=>[
                    'to'=>array('dineshkumar@businessgateways.com','dineshkumar@businessgateways.com'),
                    'cc'=>array(),
                    'bcc'=>array()
                ],
        ],
        7=>[
            'shortName'=>'pdo',
            'regPk'=>17,
            'openTender_WS_MailId_Notify_list'=>[
                'to'=>array('dineshkumar@businessgateways.com'),
                'cc'=>array('dineshkumar@businessgateways.com'),
                'bcc'=>array('dineshkumar@businessgateways.com')
                ],
            'openContract_WS_MailId_Notify_list'=>[
                    'to'=>array('dineshkumar@businessgateways.com','dineshkumar@businessgateways.com'),
                    'cc'=>array(),
                    'bcc'=>array()
                ],
        ],
        20=>[
            'shortName'=>'cced',
            'regPk'=>17094,
            'openTender_WS_MailId_Notify_list'=>[
                'to'=>array('dineshkumar@businessgateways.com'),
                'cc'=>array('dineshkumar@businessgateways.com'),
                'bcc'=>array('dineshkumar@businessgateways.com')
                ],
            'openContract_WS_MailId_Notify_list'=>[
                    'to'=>array('dineshkumar@businessgateways.com','dineshkumar@businessgateways.com'),
                    'cc'=>array(),
                    'bcc'=>array()
                ],
        ],
       /* 1271=>[
            'shortName'=>'omanlng',
            'regPk'=>1299,
            'openTender_WS_MailId_Notify_list'=>[
                    'to'=>array('jeeva@businessgateways.com'),
                    'cc'=>array('praveen@businessgateways.com'),
                    'bcc'=>array('chandru@businessgateways.com')
                ],
            'openTender_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetTendersDetails?Publishing_date='.$yesterdayDate,
            // 'openTender_WS_XML_URL'=>'http://46.40.237.170:443/WebService.asmx/GetTendersDetails?Publishing_date=07/04/2016',
            'openContract_WS_MailId_Notify_list'=>[
                    'to'=>array('jeeva@businessgateways.com','praveen@businessgateways.com'),
                    'cc'=>array(),
                    'bcc'=>array()
                ],
        ],
        1270=>[
            'shortName'=>'pdo',
            'regPk'=>1298,
            'openTender_WS_MailId_Notify_list'=>[
                'to'=>array('jeeva@businessgateways.com'),
                'cc'=>array('praveen@businessgateways.com'),
                'bcc'=>array('chandru@businessgateways.com')
                ],
            'openContract_WS_MailId_Notify_list'=>[
                    'to'=>array('jeeva@businessgateways.com','praveen@businessgateways.com'),
                    'cc'=>array(),
                    'bcc'=>array()
                ],
        ],
        1227=>[
            'shortName'=>'cced',
            'regPk'=>1255,
            'openTender_WS_MailId_Notify_list'=>[
                'to'=>array('jeeva@businessgateways.com'),
                'cc'=>array('praveen@businessgateways.com'),
                'bcc'=>array('chandru@businessgateways.com')
                ],
            'openContract_WS_MailId_Notify_list'=>[
                    'to'=>array('jeeva@businessgateways.com','praveen@businessgateways.com'),
                    'cc'=>array(),
                    'bcc'=>array()
                ],
        ],*/
    ],
    "GOV_PROJECT_ENABLE" => false,  // TRUE => PROJECT GOV MANDATORY, FALSE => NOT MANDATORY
    'PG' => [
        'cybersource' => [
            'apistatus' => false,
            'access_key' => "f694e9e6138434ac895d8b54de7369b5",
            'profile_id' => "A4F8A334-8B16-4DB1-BF4D-B01A77CA0BA3",//crm#6459
            'signed_field_names' => "access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,payment_method,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_city,bill_to_address_country,bill_to_address_postal_code,merchant_defined_data1,consumer_id,customer_ip_address",
            'SECRET_KEY' => 'd90d1edb5a264ad38d306e0c82e7d748bc3dd776d4a64d7482040be9d7f1011cb147d37e745b4343924bac2f882815cf7721bc7d080a4ac1b1212a298f6fdb7967736bc7c0e04aeba23e3aa8385a657f6065c8ffcf1f489e8d95821728630c0b3b4c54323a39405799cc7cc1120cc2af4246617bd4654234adaba097917b297c',
            'paymenttoken' => '40000098745632196374150002'
        ],
        'omannet' => [
            'apistatus' => false,
            'current' => 'demo',
            'demo' => [
                'tran_currency' => 512,
                'consumer_language' => 'USA',
                'tran_action' => 1, // 1 – Purchase, 2 – Authorization, 4 – Pre Auth, 8 – Inquiry, 11 – Token Registration, 12 – Token De-Registration
                'token_action' => 11, // 1 – Purchase, 2 – Authorization, 4 – Pre Auth, 8 – Inquiry, 11 – Token Registration, 12 – Token De-Registration
                'merchant_receiptURL' => 'https://bgi.businessgateways.net/j3/app/afterlogin/paymentsuccesslistview',
                'merchant_errorURL' => 'https://bgi.businessgateways.net/j3/app/afterlogin/paymentsuccesslistview',
                'gateway_resource_path' => 'D:\\xampp7.3\\htdocs\\vhost\\businessgateways.in\\ipay\\iPAYPlugin\\',
                'gateway_terminal_tranportalid' => 'ipay705329903073',
                'gateway_terminal_alias' => 'BGATEWAYS',
                'php_java_bridge_url' => 'http://businessgateways.in:8080/JavaBridge/java/Java.inc',
                'aliasName' => 'BGATEWAYS',
                'tokenFlag' => '2', // tokenFlag value will be 2 for Transaction using Token
                'javabridge_file_path'=>'http://businessgateways.in:8080/JavaBridge/java/Java.inc',
                'resourcePath' => 'D:\\xampp7.3\\htdocs\\vhost\\businessgateways.in\\ipay\\iPAYPlugin\\',
		'keystorePath' => 'D:\\xampp7.3\\htdocs\\vhost\\businessgateways.in\\ipay\\iPAYPlugin\\',
            ],
            'live' => [
                'tran_currency' => 512,
                'consumer_language' => 'USA',
                'tran_action' => 1, // 1 – Purchase, 2 – Authorization, 4 – Pre Auth, 8 – Inquiry, 11 – Token Registration, 12 – Token De-Registration
                'token_action' => 11, // 1 – Purchase, 2 – Authorization, 4 – Pre Auth, 8 – Inquiry, 11 – Token Registration, 12 – Token De-Registration
                'merchant_receiptURL' => 'https://businessgateways.com/index.php?r=pay/onpayment',
                'merchant_errorURL' => 'https://businessgateways.com/index.php?r=pay/onpayment',
//                'gateway_resource_path' =>  $_SERVER[DOCUMENT_ROOT].'D:\\xampp\\htdocs\\samples\\PG\\iPAYPlugin\\',
                'gateway_resource_path' =>  'K:\\xampp\\htdocs\\ipay\\iPAYPlugin\\',
                'gateway_terminal_tranportalid' => 'ipay705329903073',
                'gateway_terminal_alias' => 'BGATEWAYS',
//                'php_java_bridge_url' => 'http://localhost:8080/JavaBridge/java/Java.inc',
                'aliasName' => 'BGATEWAYS',
                'tokenFlag' => '2', // tokenFlag value will be 2 for Transaction using Token
                'javabridge_file_path'=>"'http://localhost:8080/JavaBridge/java/Java.inc'",
//                'resourcePath'=>'K:\\xampp\\htdocs\\ipay\\iPAYPlugin\\',
//                'keystorePath'=>'K:\\xampp\\htdocs\\ipay\\iPAYPlugin\\',
                
            ],
        ],
        'ottu' => [
            'apistatus' => true,
            'ottulinkexpirytime'=>'90', //90 mins
            'current' => 'demo',
            'demo' => [
                'dc' => 'omannetdemo',
                'cc' => 'cybersourcedemo',
                'disclosure_url' => 'https://bgi.businessgateways.net/j3/backend/configuration/paystatus',
                'redirect_url' => 'https://bgi.businessgateways.net/j3/app/transaction/transactionlandingpage',
                'pg_url' => 'https://pay.businessgateways.com/pos/d/crt/'
            ],
            'live' => [
                'dc' => 'omannetdemo',
                'cc' => 'cybersourcedemo',
                'disclosure_url' => 'http://businessgateways.in/j3/backend/configuration/paystatus',
                'redirect_url' => 'http://businessgateways.in/j3/app/transaction/transactionlandingpage',
                'pg_url' => 'https://pay.businessgateways.com/pos/d/crt/'
            ],
        ],
        'thawani' => [
            'apistatus' => false,
            'current' => 'demo',
            'demo' => [
                'api_key' => 'a4HSVJIoRGvuTghu5hvyh2H3l3ThofuydKjBdpPSL4c=',
                'public_key' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCyvh+QLg34bJiad5j7FafjD00wd2tzR/DtOiGZir/7k3CcvOJAY/d4XSIlYdWFLZ/THIA0lvin84AI7h41CAIhyGfPvNjalYK8X8Fl0X1qeUW17XZQiHCxJdMM3YQCrGzEQrHjSrGRDNMNcyJ4DpRrhkN5mGUx+a83UFVXQbvz0wIDAQAB',
                'merchant_reference' => '20200403234700',
            ],
            'live' => [
                'api_key' => '',
                'public_key' => '',
                'merchant_reference' => '20200403234700',
            ],
        ],
        'smartpay' => [
            'apistatus' => true,
            'current' => 'demo',
            'demo' => [
               'merchant_id' => '133',
               //local
            //    'access_code' => 'AVON00JD14CC10NOCC',
            //    'working_key' => 'D5F25C0DDC27B4BE9D14BDEF63780B09',
                //demo
               'access_code' => 'AVXN00JE14BT45NXTB',
               'working_key' => 'EB0065BB3C847DF4AD93BFCC1C951473',
               'payment_url' => 'https://mti.bankmuscat.com:6443/transaction.do?command=initiateTransaction',
              
               //Demo
               'request_url' => 'https://bgi.businessgateways.net/j3/app/afterlogin/paymentsuccesslistview',
               'redirect_url' => 'https://bgi.businessgateways.net/j3/smartPay.php',
               //Local
            //    'request_url' => 'http://localhost/afterlogin/paymentsuccesslistview',
            //    'redirect_url' => 'http://localhost:82/j3/smartPay.php',
            ],
            'live' => [
                'merchant_id' => '',
                'access_code' => '',
                'working_key' => '',
                'payment_url' => '',
                'request_url' => '',
                'redirect_url' => '',
            ],
        ],
        'renewalonly-to-comppk'=>36,
        'onlinepaymaintanence'=>549,
//        'renewalonly-to-comppk'=>549,
        'REG' => [
                'payment' => true,
                'online' => true,
                'offline' => TRUE            
            ], 
            'RENEW' => [
                'payment' => false,
                'online' => false,
                'offline' => TRUE            
            ], 
            'TENDER' => [
                'payment' => false,
                'online' => false,
                'offline' => TRUE            
            ], 
            'CMS' => [
                'payment' => TRUE,
                'online' => false,
                'offline' => true            
            ], 
            'GCC' => [
                'payment' => TRUE,
                'online' => false,
                'offline' => true            
            ], 
            'PERMIT' => [
                'payment' => true,           
            ],          
    ],
      'vatper'=>5,
    'registrationurl'=>[
         'local'=>'http://192.168.1.57/jsrslive/index.php?r=register/j3reg',  
         'demo'=>'https://bgi.businessgateways.net/jsrs/index.php?r=register/j3reg',  
         'live'=>'https://businessgateways.com/',  
        ],
    'registerpackurl'=>[
         'local'=>'http://192.168.1.57/jsrslive/index.php?r=',  
         'demo'=>'https://bgi.businessgateways.net/jsrs/index.php?r=',  
         'live'=>'https://businessgateways.com/',  
        ],
            
];
