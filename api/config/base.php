<?php
$hostName = $_SERVER['HTTP_HOST'];
$dirName = dirname($_SERVER['PHP_SELF']);
$rootDirectory=explode('/',$dirName);
$rootDirectory=$rootDirectory[1];
 
if($hostName=='usp.opaloman.om'  && $rootDirectory=='uat8686'){
    $DBFile = '/DB-demo.json';
    $env = 'demo';
}elseif($hostName=='usp.opaloman.om' && $rootDirectory=='prelive0805'){
    $DBFile = '/DB-uat.json';
    $env = 'uat';
}elseif($hostName=='usp.opaloman.om'){
    $DBFile = '/DB-live.json';
    $env = 'live';	
}elseif($hostName=='192.168.1.200'){
    $DBFile = '/DB.json';
    $env = 'demo';
}else{
    $DBFile = '/DB.json';
    $env = '';
}

$jsonBasePath = dirname(__DIR__).'/';

$filepath= $jsonBasePath.'json'.$DBFile;
$fp = fopen($filepath, 'r');
$arr = fread($fp, filesize($filepath));
$arr = json_decode($arr,TRUE);

$dns ='mysql:host='.$arr['dbHostName'].';port='.$arr['dbPort'].';dbname='.$arr['dbName'];

 $typeError=['error', 'warning'];
    $logConfig['targets'][]=[
                       'class' => 'yii\log\FileTarget',
                       'levels' => $typeError,
                       'logFile' => '@runtime/logs/customerror.log',
                   ];
$config = [
    'name' => 'LyPIS',
    'vendorPath' => __DIR__ . '/../../vendor/',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'sourceLanguage' => 'en-US',
    'language' => 'en-US',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
     'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'components' => [
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],
        'urlManager' => require(__DIR__ . '/_urlManager.php'),
        'cache' => require(__DIR__ . '/_cache.php'),
        'ip2location' => [
            'class' => '\api\components\IP2Location\Geolocation',
            'database' => dirname(__FILE__) . '/../../api/components' . DIRECTORY_SEPARATOR . 'IP2Location' . DIRECTORY_SEPARATOR . 'IP2LOCATION-LITE-DB1.BIN',
            'mode' => 'FILE_IO',
        ],
        'log'=>$logConfig, 	
        'cache' => [
            'class' => yii\caching\FileCache::class,
            'cachePath' => '@api/runtime/cache'
        ],

        'commandBus' => [
            'class' => trntv\bus\CommandBus::class,
            'middlewares' => [
                [
                    'class' => trntv\bus\middlewares\BackgroundCommandMiddleware::class,
                    'backgroundHandlerPath' => '@console/yii',
                    'backgroundHandlerRoute' => 'command-bus/handle',
                ]
            ]
        ],

        'formatter' => [
            'class' => yii\i18n\Formatter::class
        ],

        'glide' => [
            'class' => trntv\glide\components\Glide::class,
            'sourcePath' => '@storage/web/source',
            'cachePath' => '@storage/cache',
            'urlManager' => 'urlManagerStorage',
            'maxImageSize' => env('GLIDE_MAX_IMAGE_SIZE'),
            'signKey' => env('GLIDE_SIGN_KEY')
        ],
        'mailer' => [
		'class' => 'yii\swiftmailer\Mailer',
		'transport' => [
		'class' => 'Swift_SmtpTransport',
		'host' => 'mail.opaloman.om',
        'username' => 'maillocal@usp.opaloman.om',
        'password' => 'Dirv7142*',		'port' => '25',
		'encryption' => '',
	   ],
	   'useFileTransport' => false,
	],
	
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => $dns,
            'username' => $arr['dbUsername'],
            'password' => $arr['dbPassword'],
            'tablePrefix' => '',
            'charset' => env('DB_CHARSET', 'utf8'),
            'enableSchemaCache' => false,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache'
    ],

//        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
//            'targets' => [
//                'db' => [
//                    'class' => 'yii\log\DbTarget',
//                    'levels' => ['error', 'warning'],
//                    'except' => ['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
//                    'prefix' => function () {
//                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
//                        return sprintf('[%s][%s]', Yii::$app->id, $url);
//                    },
//                    'logVars' => [],
//                    'logTable' => '{{%system_log}}'
//                ]
//            ],
//        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                        'backend' => 'backend.php',
                        'frontend' => 'frontend.php',
                    ],
                    'on missingTranslation' => [backend\modules\translation\Module::class, 'missingTranslation']
                ],
                /* Uncomment this code to use DbMessageSource
                '*'=> [
                    'class' => yii\i18n\DbMessageSource::class,
                    'sourceMessageTable'=>'{{%i18n_source_message}}',
                    'messageTable'=>'{{%i18n_message}}',
                    'enableCaching' => YII_ENV_DEV,
                    'cachingDuration' => 3600,
                    'on missingTranslation' => [backend\modules\translation\Module::class, 'missingTranslation']
                ],
                */
            ],
        ],

        'fileStorage' => [
            'class' => trntv\filekit\Storage::class,
            'baseUrl' => '@storageUrl/source',
            'filesystem' => [
                'class' => api\components\filesystem\LocalFlysystemBuilder::class,
                'path' => '@storage/web/source'
            ],
            'as log' => [
                'class' => api\behaviors\FileStorageLogBehavior::class,
                'component' => 'fileStorage'
            ]
        ],

        'keyStorage' => [
            'class' => api\components\keyStorage\KeyStorage::class
        ],

        
        'urlManagerStorage' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => env('STORAGE_HOST_INFO'),
                'baseUrl' => env('STORAGE_BASE_URL'),
            ],
            require(Yii::getAlias('@storage/config/_urlManager.php'))
        ),

        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'path' => '@common/runtime/queue',
        ],
    ],
    'params' => [
        'adminEmail' => env('ADMIN_EMAIL'),
        'robotEmail' => env('ROBOT_EMAIL'),
		'phpexepath'=>'D:/xampp/php/php.exe',
        'availableLocales' => [
            'en-US' => 'English (US)',
            'ru-RU' => 'Русский (РФ)',
            'uk-UA' => 'Українська (Україна)',
            'es' => 'Español',
            'fr' => 'Français',
            'vi' => 'Tiếng Việt',
            'zh-CN' => '简体中文',
            'pl-PL' => 'Polski (PL)',
        ],
    ],
];

if (YII_ENV_PROD) {
    $config['components']['log']['targets']['email'] = [
        'class' => yii\log\EmailTarget::class,
        'except' => ['yii\web\HttpException:*'],
        'levels' => ['error', 'warning'],
        'message' => ['from' => env('ROBOT_EMAIL'), 'to' => env('ADMIN_EMAIL')]
    ];
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class
    ];

    $config['components']['cache'] = [
        'class' => yii\caching\DummyCache::class
    ];
//    $config['components']['mailer']['transport'] = [
//        'class' => 'Swift_SmtpTransport',
//        'host' => env('SMTP_HOST'),
//        'port' => env('SMTP_PORT'),
//    ];
}

return $config;
