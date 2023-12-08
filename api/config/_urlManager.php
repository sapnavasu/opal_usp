<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
            'mst/socialmedia',
            'mst/country',
            'mst/statemaster',
            'mst/citymaster',
            'mst/userroleadmin',
            'mst/modulemaster',
            'mst/submodulemaster',
            'mst/adminsubmodulemaster',
            'mst/currencymaster',
            'mst/segmentmaster',
            'mst/familymaster',
            'mst/classmaster',
            'mst/servicemaster',
            'mst/adminusermst',
            'mst/sectormst',
            'mst/industrymst',
            'mst/productmst',
            'mst/specmst',
            'mst/bgieventcategory',
            'mst/activites',
            'mst/purposemst',
            'mst/eventupload',
            'mst/natlookoutcatmst',
            'mst/natlookoutsubcatmst',
            'mst/tbsecmst',
            'mst/tbgrademst',
            'mst/domainmst',
            'mst/memsubscriptionmst',
            'mst/adminmodulemaster',
            'mst/userroleadmin',
            'mst/offermst',
            'mst/areamst',
            'mst/languagemst',
            'mst/keymst',
            'mst/translate',
            'mst/department',
            'mst/profilemanagement',
            'mst/classification',
            'mst/natlookoutsubcat',
            'mst/incorp',
            'mst/incorpstyle',
            'mst/bgiindcodecateg',
            'mst/bgiinduscodeprod',
            'mst/bgiinduscodeservmst',
            'mst/subcategory',
            'mst/unspcbipcmapping',
            'mst/unsscbiscmapping',
            'mst/licensemst',
            'mst/subsectormst',
            'pd/projectdtls',
            'mst/bgiindtender',
            'mst/tender',
            'mst/formmaster',
            'bussrc/bussource',
            'ep/epmaster',
            'ep/exprofile',
            'mst/workflowmgmt',
            'pms/pms',
            'ct/collaborate',
            'int/commmon',
			],
            'pluralize' => false,
            'tokens' => [
                '{id}' => '<id:\d+>',
            ]
        ],
        'wsdl/<opr:\w+>/supplierlist'=>'wsdl/supplierdata/supplierlist',
        'wsdl/<opr:\w+>/updatedsupplierlist'=>'wsdl/supplierdata/updatedsupplierlist',
        'wsdl/<opr:\w+>/daleelclient'=>'wsdl/supplierdata/supplierdlt',
        'import/xml'=>'wsdl/supplierdata/xml',
        'sendmailtotargetsupplier'=>'wsdl/supplierdata/sendmailtotargetsupplier',
        'sendimporterrorlog'=>'wsdl/supplierdata/sendimporterrorlog',
        'import/newcontractxml'=>'wsdl/supplierdata/xmlimport',
        'import/updatecontractxml'=>'wsdl/supplierdata/xmlimport',
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ],
];