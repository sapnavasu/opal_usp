<?php
return [
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => require(__DIR__ . '/_urlManager.php'),
        'cache' => require(__DIR__ . '/_cache.php'),
        'ip2location' => [
            'class' => '\common\components\IP2Location\Geolocation',
            'database' => dirname(__FILE__) . '/../../common/components' . DIRECTORY_SEPARATOR . 'IP2Location' . DIRECTORY_SEPARATOR . 'IP2LOCATION-LITE-DB1.BIN',
            'mode' => 'FILE_IO',
        ],
        'mailer' => [
		'class' => 'yii\swiftmailer\Mailer',
		'transport' => [
		 'class' => 'Swift_SmtpTransport',
		'host' => 'mail.businessgateways.com',
        'username' => 'maillocal@businessgateways.com',
        'password' => 'Maillocal@123',
		 'port' => '587',
		 'encryption' => '',
	   ],
	   'useFileTransport' => false,
	],
    ],
];
