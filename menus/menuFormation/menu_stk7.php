<?php
return [
        [
            'menu_pk'=>26,
            'module_id'=>0,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Dashboard',
            'menu_icon'=>'bgi-menu menu-dashboard',
            'menu_url'=>'dashboard/operator',
            'order'=>1
        ],
        [
            'menu_pk'=>1,
            'module_id'=>74,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Master Company Profile',
            'menu_icon'=>'bgi-menu menu-Master-Company-Profile',
            'menu_url'=>'',
            'order'=>3
        ],
            [
                'menu_pk'=>2,
                'module_id'=>0,
                'submodule_id'=>0,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Introduction',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/landingpage',
                'order'=>1
            ],   
            [
                'menu_pk'=>2,
                'module_id'=>1,
                'submodule_id'=>75,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Company Information',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/companyinformation',
                'order'=>1
            ],
            [
                'menu_pk'=>4,
                'module_id'=>1,
                'submodule_id'=>76,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'About Company',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/aboutcompany',
                'order'=>3
            ],
            [
                'menu_pk'=>5,
                'module_id'=>1,
                'submodule_id'=>77,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Accomplishments',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/masteraccomplishment',
                'order'=>4
            ],
            [
                'menu_pk'=>6,
                'module_id'=>1,
                'submodule_id'=>78,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Market Presence',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/marketpresence',
                'order'=>5
            ],
            [
                'menu_pk'=>7,
                'module_id'=>1,
                'submodule_id'=>79,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Web Presence',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/webpresence',
                'order'=>6
            ],
            [
                'menu_pk'=>8,
                'module_id'=>1,
                'submodule_id'=>80,
                'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Board & Management',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/boardmembers',
                'order'=>7
            ],
        [
            'menu_pk'=>10,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Enterprise Admin',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'',
            'order'=>2
        ],
        [
            'menu_pk'=>14,
            'module_id'=>0,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'jSearch',
            'menu_icon'=>'bgi-menu  menu-Jsearch',
            'menu_url'=>'bizsearchnew/home',
            'order'=>4
        ],
        [
            'menu_pk'=>15,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contracts Management System (CMS)',
            'menu_icon'=>'bgi-menu   menu-Contracts-Management-System',
            'menu_url'=>'',
            'order'=>5
        ],
            [
                'menu_pk'=>30,
                'module_id'=>0,
                'submodule_id'=>0,
                'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Dashboard',
                'menu_icon'=>'',
                'menu_url'=>'pms/cmsdashboard',
                'order'=>1
            ],
            [
                'menu_pk'=>31,
                'module_id'=>139,
                'submodule_id'=>141,
                'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Analytics',
                'menu_icon'=>'',
                'menu_url'=>'cms/analytics',
                'order'=>2
            ],
//        [
//            'menu_pk'=>17,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Broadcast',
//            'menu_icon'=>'bgi bgi-broadcast',
//            'menu_url'=>'propagation/broadcastlistview',
//            'order'=>11
//        ],
        // [
        //     'menu_pk'=>19,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'jDo',
        //     'menu_icon'=>'bgi-menu menu-JDo',
        //     'menu_url'=>'collaborativetool/landingpage',
        //     'order'=>9
        // ],
//        [
//            'menu_pk'=>20,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Analytics',
//            'menu_icon'=>'bgi bgi-analytics-new',
//            'menu_url'=>'',
//            'order'=>7
//        ],
//        [
//            'menu_pk'=>21,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Media',
//            'menu_icon'=>'bgi bgi-Media',
//            'menu_url'=>'propagation/propagationdetail',
//            'order'=>12
//        ],
        [
            'menu_pk'=>22,
            'module_id'=>90,
            'submodule_id'=>91,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'SkyCards Management',
            'menu_icon'=>'bgi-menu menu-Skycard',
            // 'menu_url'=>'enterpriseadmin/skycardlandingpage',
            'menu_url'=>'enterpriseadmin/viewskycarddetail',
            'order'=>12
        ],
        // [
        //     'menu_pk'=>32,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Tender Management',
        //     'menu_icon'=>'bgi bgi-tendermanagement',
        //     'menu_url'=>'',
        //     'order'=>5
        // ],
        // [
        //     'menu_pk'=>24,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Supplier Pre-Qualification (Tier 3)',
        //     'menu_icon'=>'bgi bgi-contractors-hub',
        //     'menu_url'=>'PREQUAL',
        //     'order'=>6,
        //     'external_link'=>true
        // ],
        [
            'menu_pk'=>33,
            'module_id'=>95,
            'submodule_id'=>145,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Supplier Certification Status',
            'menu_icon'=>'bgi-menu  menu-Supplier-Certification-Form',
            'menu_url'=>'',
            'order'=>7
        ],
    
        [
            'menu_pk'=>24,
            'module_id'=>58,
            'submodule_id'=>59,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Supplier Pre-Qualification (Tier 3)',
            'menu_icon'=>'bgi bgi-contractors-hub',
            'menu_url'=>'PREQUAL',
            'order'=>6,
            'external_link'=>true,
        ],
        [
            'menu_pk'=>34,
            'module_id'=>216,
            'submodule_id'=>217,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Operators / Buyers Zone',
            'menu_icon'=>'bgi-menu menu-operator',
            'menu_url'=>'buyerzone/buyerlistviewpage',
            'order'=>10
        ],
        [
            'menu_pk'=>35,
            'module_id'=>68,
            'submodule_id'=>69,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contact us',
            'menu_icon'=>'bgi-menu menu-Contact',
            'menu_url'=>'contact',
            'order'=>16
        ],
//        [
//            'menu_pk'=>18,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Supplier Performance Appraisal',
//            'menu_icon'=>'bgi-menu  menu-Supplier-Certification-Form',
//            'menu_url'=>'cms/performanceappraisal',
//            'order'=>11
//        ],
//		 [
//            'menu_pk'=>25,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Requisition Creation',
//            'menu_icon'=>'bgi-menu  menu-Supplier-Certification-Form',
//            'menu_url'=>'pms/createrequisition',
//            'order'=>12
//        ],
//        [
//            'menu_pk'=>23,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Contractors Hub',
//            'menu_icon'=>'bgi-contractors-hub',
//            'menu_url'=>'',
//            'order'=>13
//        ],
//        [
//            'menu_pk'=>16,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'ICV Management',
//            'menu_icon'=>'bgi-icvicon',
//            'menu_url'=>'',
//            'order'=>10
//        ],
//        [
//            'menu_pk'=>11,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Configuration',
//            'menu_icon'=>'bgi-settings',
//            'menu_url'=>'',
//            'order'=>3
//        ],
//            [
//                'menu_pk'=>12,
//                'module_id'=>1,
//                'submodule_id'=>1,
//                'menu_to'=>11,//null-->mainmenu, menuPk --> submenu
//                'menu_name'=>'Approval Workflow Configuration',
//                'menu_icon'=>'',
//                'menu_url'=>'pms/approvalworkflow',
//                'order'=>1
//            ],
//            [
//                'menu_pk'=>13,
//                'module_id'=>1,
//                'submodule_id'=>1,
//                'menu_to'=>11,//null-->mainmenu, menuPk --> submenu
//                'menu_name'=>'Centralization Configuration',
//                'menu_icon'=>'',
//                'menu_url'=>'cluster/centralization',
//                'order'=>2
//            ],
[
    'menu_pk'=>26,
    'module_id'=>0,
    'submodule_id'=>0,
    'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
    'menu_name'=>'Introduction',
    'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
    'menu_url'=>'enterpriseadmin/landingpage',
    'order'=>1,
    'menu_highlight_url'=>['/enterpriseadmin/landingpage']
],
        [
            'menu_pk'=>27,
            'module_id'=>1,
            'submodule_id'=>86,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Divisions',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/divisions',
            'order'=>2
        ],
        [
            'menu_pk'=>28,
            'module_id'=>1,
            'submodule_id'=>87,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Departments',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/department',
            'order'=>3
        ],
        [
            'menu_pk'=>29,
            'module_id'=>1,
            'submodule_id'=>88,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Users',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/usermanagement',
            'order'=>4,
            'menu_highlight_url'=>['/enterpriseadmin/usermanagement']
        ],
    //     [
    //     'menu_pk'=>30,
    //     'module_id'=>1,
    //     'submodule_id'=>1,
    //     'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
    //     'menu_name'=>'Invited Users',
    //     'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
    //     'menu_url'=>'enterpriseadmin/inviteduser',
    //     'order'=>5
    // ],
    ];