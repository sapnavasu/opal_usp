<?php
return [
        [
            'menu_pk'=>1,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Master Company Profile',
            'menu_icon'=>'bgi-menu menu-Master-Company-Profile',
            'menu_url'=>'',
            'order'=>1
        ],
        [
            'menu_pk'=>2,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Company Information',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/companyinformation',
            'order'=>1
        ],
        [
            'menu_pk'=>4,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'About Company',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/aboutcompany',
            'order'=>3
        ],
        [
            'menu_pk'=>5,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Accomplishment',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/masteraccomplishment',
            'order'=>4
        ],
        [
            'menu_pk'=>6,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Market Presence',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/marketpresence',
            'order'=>5
        ],
        [
            'menu_pk'=>7,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Web Presence',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/webpresence',
            'order'=>6
        ],
        [
            'menu_pk'=>8,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>1,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Board & Management Team',
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
            'menu_url'=>'enterpriseadmin/landingpage',
            'order'=>2
        ],
        [
            'menu_pk'=>11,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Users',
            'menu_icon'=>'',
            'menu_url'=>'enterpriseadmin/usermanagement',
            'order'=>1
        ],
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
        [
            'menu_pk'=>13,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Module',
            'menu_icon'=>'bgi-cmsicon',
            'menu_url'=>'',
            'order'=>3
        ],
        [
            'menu_pk'=>14,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>13,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contract Management System',
            'menu_icon'=>'bgi-menu   menu-Contracts-Management-System',
            'menu_url'=>'pms/cmsdashboard',
            'order'=>1
        ],
    ];