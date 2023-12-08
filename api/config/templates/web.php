<?php
$params = array_merge(
    require(__DIR__ . '/payment-params.php')
    // require($paramFile)
);
$config = [
    'homeUrl' => Yii::getAlias('@apiUrl'),
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'site/index',
	'timeZone' => 'Asia/Calcutta',
//    'bootstrap' => ['maintenance'],
    'modules' => [
        'gii'=>'yii\gii\Module',
        'mws' => \api\modules\mws\Module::class, // mws Provider
        'lgn' => \api\modules\lgn\Module::class, // Login
        'sv' => \api\modules\sv\Module::class, // sv Provider
		'gcctend' => \api\modules\gcctend\Module::class, // Login
        'dshbrd' => \api\modules\dshbrd\Module::class, // DashBoard
        'mst' => \api\modules\mst\Module::class, // Masters
        'pm' => \api\modules\pm\Module::class, // Profile Management
	    'ea' => \api\modules\ea\Module::class, // Enterprise Admin
        'drv' => \api\modules\drv\Module::class, // Drive
        'ws' => \api\modules\ws\Module::class, // WorkSpace
        'bs' => \api\modules\bs\Module::class, // Biz Search
        'bz' => \api\modules\bz\Module::class, // Buyer Zone
        'awd' => \api\modules\awd\Module::class, //Award Contract
        'backend' => \api\modules\backend\Module::class, // Backend
        'acs' => \api\modules\acs\Module::class, // Account Settings
        'shp' => \api\modules\shp\Module::class, // Stakeholder Propagation
        'acm' => \api\modules\acm\Module::class, // Access Module
        'pd' => \api\modules\pd\Module::class, // Project Details
        'cm' => \api\modules\cm\Module::class, // Content Management
        'stkreg' => \api\modules\stkreg\Module::class,
        'tend' => \api\modules\tend\Module::class,
        'mcp' => \api\modules\mcp\Module::class,
        'bussrc' => \api\modules\bussrc\Module::class,
        'inv' => \api\modules\inv\Module::class, // Investor Hub
        'trade' => \api\modules\trade\Module::class, //Supplier profle-> Trade details,
        'svf' => \api\modules\svf\Module::class, //Supplier validation form
        'lic' => \api\modules\lic\Module::class, //License Tracker
        'ep' => \api\modules\ep\Module::class, //External Profile
        'review' => \api\modules\review\Module::class, //Review
        'apr'=>\api\modules\apr\Module::class, // Registration Approval
        'cc' => \api\modules\cc\Module::class, //Country Configuration
        'al' => \api\modules\al\Module::class, //After Login
        'pms' => \api\modules\pms\Module::class, //PMS
        'mda' => \api\modules\mda\Module::class, //Media
        'pay' => \api\modules\pay\Module::class, //Payment
        'icv' => \api\modules\icv\Module::class, //ICV
        'ma' => \api\modules\mail\Module::class, //Mail
        'stat' => \api\modules\stat\Module::class, //Statistics
        'ct' => \api\modules\ct\Module::class, //Collaborate
        'quot' => \api\modules\quot\Module::class, //Quotations
        'rfx' => \api\modules\rfx\Module::class, //Rfx
        'cache' => \api\modules\cache\Module::class, //Cache
        'skyc' => \api\modules\skyc\Module::class, //Skycard module
        'wsdl' => \api\modules\supplierdata\Module::class, //Supplierlist
        'gcc' => \api\modules\gcc\gcc::class, //GCC Tenders
        'nty' => \api\modules\nty\Module::class, // Notification Module
        'int' => \api\modules\int\Module::class, // Webserive Module
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key'   => 'BGI@1690',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'cache'  => $config['params']['rediscache'],
//        'maintenance' => [
////            'class' => common\components\maintenance\Maintenance::class,
////            'enabled' => function ($app) {
////                if (env('APP_MAINTENANCE') === '1') {
////                    return true;
////                }
////                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
////            }
////        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
             ]
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => \common\models\User::class,
            'loginUrl' => ['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
		'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
				
                $response = $event->sender;
                if($response->format == 'html') {
                    return $response;
                }

                $responseData = $response->data;

                if(is_string($responseData) && json_decode($responseData)) {
                    $responseData = json_decode($responseData, true);
                }
                
                if($response->statusCode >= 200 && $response->statusCode <= 299) {
                    $response->data = [
                        'success'   => true,
                        'status'    => $response->statusCode,
                        'data'      => $responseData,
                    ];
                } else {
                    $response->data = [
                        'success'   => false,
                        'status'    => $response->statusCode,
                        'data'      => $responseData,
                    ];

                }
                return $response;
            },
        ]        
    ],
    'params' => $params,
    
];
return $config;
