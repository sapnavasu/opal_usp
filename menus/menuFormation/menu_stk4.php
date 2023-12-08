<?php
return [
    [
        'menu_pk'=>30,
        'module_id'=>1,
        'submodule_id'=>1,
        'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Dashboard',
        'menu_icon'=>'bgi-menu menu-dashboard',
        'menu_url'=>'dashboard/memdashboard',
        'order'=>1
    ],
        // [
        //     'menu_pk'=>1,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Master Company Profile4',
        //     'menu_icon'=>'bgi-menu menu-Master-Company-Profile',
        //     'menu_url'=>'',
        //     'order'=>1
        // ],
        // [
        //     'menu_pk'=>2,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Company Information',
        //     'menu_icon'=>'',
        //     'menu_url'=>'profilemanagement/companyinformation',
        //     'order'=>1
        // ],
        // [
        //     'menu_pk'=>4,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'About Company',
        //     'menu_icon'=>'',
        //     'menu_url'=>'profilemanagement/aboutcompany',
        //     'order'=>3
        // ],
        // [
        //     'menu_pk'=>5,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Accomplishments',
        //     'menu_icon'=>'',
        //     'menu_url'=>'profilemanagement/masteraccomplishment',
        //     'order'=>4
        // ],
        // [
        //     'menu_pk'=>6,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Market Presence',
        //     'menu_icon'=>'',
        //     'menu_url'=>'profilemanagement/marketpresence',
        //     'order'=>5
        // ],
        // [
        //     'menu_pk'=>7,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Web Presence',
        //     'menu_icon'=>'',
        //     'menu_url'=>'profilemanagement/webpresence',
        //     'order'=>6
        // ],
        // [
        //     'menu_pk'=>8,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Board & Management Team',
        //     'menu_icon'=>'',
        //     'menu_url'=>'profilemanagement/boardmembers',
        //     'order'=>7
        // ],
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
        'menu_pk'=>30,
        'module_id'=>1,
        'submodule_id'=>1,
        'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Introduction',
        'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
        'menu_url'=>'enterpriseadmin/landingpage',
        'order'=>1,
        'menu_highlight_url'=>['/enterpriseadmin/landingpage']
    ],
        [
            'menu_pk'=>31,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Divisions',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/divisions',
            'order'=>2
        ],
        [
            'menu_pk'=>32,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Departments',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'enterpriseadmin/department',
            'order'=>3
        ],
        [
            'menu_pk'=>33,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Users',
            'menu_icon'=>'',
            'menu_url'=>'enterpriseadmin/usermanagement',
            'order'=>4,
            'menu_highlight_url'=>['/enterpriseadmin/usermanagement']
        ],
     
      
        // [
        //     'menu_pk'=>34,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Invited Users',
        //     'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
        //     'menu_url'=>'enterpriseadmin/inviteduser',
        //     'order'=>5
        // ],
        // [
        //     'menu_pk'=>12,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Monitor Users Log',
        //     'menu_icon'=>'',
        //     'menu_url'=>'enterpriseadmin/useractivity',
        //     'order'=>2
        // ],
        // [
        //     'menu_pk'=>13,
        //     'module_id'=>1,
        //     'submodule_id'=>1,
        //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        //     'menu_name'=>'Module',
        //     'menu_icon'=>'bgi-cmsicon',
        //     'menu_url'=>'',
        //     'order'=>3
        // ],
        [
            'menu_pk'=>14,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contracts Management System (CMS)',
            'menu_icon'=>'bgi-menu   menu-Contracts-Management-System',
            'menu_url'=>'',
            'order'=>5
        ],
        [
            'menu_pk'=>47,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>14,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Analytics',
            'menu_icon'=>'',
            'menu_url'=>'cms/analytics',
            'order'=>2
        ],
        [
            'menu_pk'=>15,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'jSearch',
            'menu_icon'=>'bgi-menu menu-Jsearch',
            'menu_url'=>'bizsearchnew/home',
            'order'=>4
        ],
        [
            'menu_pk'=>29,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contact Us',
            'menu_icon'=>'bgi-menu menu-Contact',
            'menu_url'=>'contact',
            'order'=>18
        ],
    ];