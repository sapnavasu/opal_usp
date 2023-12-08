<?php

return [
        [
            'menu_pk'=>30,
            'module_id'=>1,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Dashboard',
            'menu_icon'=>'bgi-menu menu-dashboard',
            'menu_url'=>'dashboard/supplier',
            'order'=>1
        ],
        [
            'menu_pk'=>10,
            'module_id'=>258,
            'submodule_id'=>259,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Enterprise Admin',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'',
            'order'=>2
        ],
        [
            'menu_pk'=>1,
            'module_id'=>263,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Master Company Profile',
            'menu_icon'=>'bgi-menu menu-Master-Company-Profile',
            'menu_url'=>'',
            'order'=>3
        ],
            [
                'menu_pk'=>2,
                'module_id'=>263,
                'submodule_id'=>0,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Introduction',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/landingpage',
                'order'=>1
            ],
            [
                'menu_pk'=>2,
                'module_id'=>263,
                'submodule_id'=>264,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Company Information',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/companyinformation',
                'order'=>1
            ],
            [
                'menu_pk'=>4,
                'module_id'=>263,
                'submodule_id'=>265,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'About Company',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/aboutcompany',
                'order'=>3
            ],
            [
                'menu_pk'=>6,
                'module_id'=>263,
                'submodule_id'=>267,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Market Presence',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/marketpresence',
                'order'=>5
            ],
        
        [
            'menu_pk'=>11,
            'module_id'=>1,
            'submodule_id'=>24,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Supplier Profile',
            'menu_icon'=>'bgi-menu  menu-supplier-profile',
            'menu_url'=>'',
            'order'=>4
        ],
            [
                'menu_pk'=>12,
                'module_id'=>270,
                'submodule_id'=>271,
                'menu_to'=>11,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Business Source',
                'menu_icon'=>'',
                'menu_url'=>'source/bsourcelist',
                'order'=>1
            ],
            [
                'menu_pk'=>13,
                'module_id'=>270,
                'submodule_id'=>272,
                'menu_to'=>11,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Products',
                'menu_icon'=>'',
                'menu_url'=>'products/productlist',
                'order'=>2
            ],
            [
                'menu_pk'=>14,
                'module_id'=>270,
                'submodule_id'=>273,
                'menu_to'=>11,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Services',
                'menu_icon'=>'',
                'menu_url'=>'services/servicelist',
                'order'=>3
            ],
        [
            'menu_pk'=>16,
            'module_id'=>274,
            'submodule_id'=>275,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'RABT Certification Management',
            'menu_icon'=>'bgi-menu  menu-Supplier-Certification-Form',
            'menu_url'=>'',
            'order'=>5
        ],
            [
                'menu_pk'=>17,
                'module_id'=>274,
                'submodule_id'=>275,
                'menu_to'=>16,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Introduction',
                'menu_icon'=>'bgi-menu  menu-Supplier-Certification-Form',
                'menu_url'=>'cert/scintro/dashboardintro',
                'order'=>1
            ],      
            [
                'menu_pk'=>17,
                'module_id'=>274,
                'submodule_id'=>275,
                'menu_to'=>16,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Supplier Certification Form',
                'menu_icon'=>'bgi-menu  menu-Supplier-Certification-Form',
                'menu_url'=>'cert/scdash/dashboard',
                'order'=>1
            ],
            [
                'menu_pk'=>21,
                'module_id'=>274,
                'submodule_id'=>275,
                'menu_to'=>19,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Local Community Contractors (LCC)',
                'menu_icon'=>'',
                'menu_url'=> '',
                'order'=>2,
                // 'external_link'=>true
            ],
            [
                'menu_pk'=>53,
                'module_id'=>274,
                'submodule_id'=>275,
                'menu_to'=>19,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Zonal Certifications',
                'menu_icon'=>'',
                'menu_url'=> 'SEZD',
                'order'=>2,
                'external_link'=>true
            ],
        [
            'menu_pk'=>51,
            'module_id'=>1,
            'submodule_id'=>43,
            'menu_to'=>50,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'GCC Tenders',
            'menu_icon'=>'bgi-menu   menu-Contracts-Management-System',
            'menu_url'=>'dashboard/gcctenderlandingpage',
            'order'=>1
        ],
        [
            'menu_pk'=>52,
            'module_id'=>1,
            'submodule_id'=>215,
            'menu_to'=>50,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'JSRS Tenders',
            'menu_icon'=>'bgi-menu   menu-Contracts-Management-System',
            'menu_url'=>'',
            'order'=>2
        ],
    [
            'menu_pk'=>52,
            'module_id'=>1,
            'submodule_id'=>0,
            'menu_to'=>50,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'CMS Enquiries',
            'menu_icon'=>'',
            'menu_url'=>'pms/rfxlist',
            'order'=>3
        ],
            [
                'menu_pk'=>47,
                'module_id'=>1,
                'submodule_id'=>134,
                'menu_to'=>22,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Analytics',
                'menu_icon'=>'',
                'menu_url'=>'cms/analytics',
                'order'=>3
            ],
    [
                'menu_pk'=>48,
                'module_id'=>1,
                'submodule_id'=>132,
                'menu_to'=>22,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Supplier Zone',
                'menu_icon'=>'',
                'menu_url'=>'cms/supplier',
                'order'=>1
            ],
    [
                'menu_pk'=>49,
                'module_id'=>1,
                'submodule_id'=>133,
                'menu_to'=>22,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Contractor Zone',
                'menu_icon'=>'',
                'menu_url'=>'cms/contractor',
                'order'=>2
            ],
        [
            'menu_pk'=>29,
            'module_id'=>276,
            'submodule_id'=>277,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contact Us',
            'menu_icon'=>'bgi-menu menu-Contact',
            'menu_url'=>'contact',
            'order'=>18
        ],
[
    'menu_pk'=>30,
    'module_id'=>258,
    'submodule_id'=>0,
    'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
    'menu_name'=>'Introduction',
    'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
    'menu_url'=>'enterpriseadmin/landingpage',
    'order'=>1,
    'menu_highlight_url'=>['/enterpriseadmin/landingpage']
],
        [
    'menu_pk'=>31,
    'module_id'=>258,
    'submodule_id'=>259,
    'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
    'menu_name'=>'Divisions',
    'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
    'menu_url'=>'enterpriseadmin/divisions',
    'order'=>2
        ],
        [
            'menu_pk'=>32,
            'module_id'=>258,
            'submodule_id'=>260,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Departments',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/department',
            'order'=>3
        ],
     
        [
            'menu_pk'=>33,
            'module_id'=>258,
            'submodule_id'=>261,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Users',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/usermanagement',
            'order'=>4,
            'menu_highlight_url'=>['/enterpriseadmin/usermanagement']
        ],
    ];