<?php
return [
    // [
    //     'menu_pk'=>95,
    //     'module_id'=>1,
    //     'submodule_id'=>1,
    //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
    //     'menu_name'=>'Dashboard',
    //     'menu_icon'=>'bgi-menu menu-dashboard',
    //     'menu_url'=>'dashboard/portaladmin',
    //     'order'=>1
    // ],
	// [
    //     'menu_pk'=>96,
    //     'module_id'=>1,
    //     'submodule_id'=>1,
    //     'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
    //     'menu_name'=>'Content Management System',
    //     'menu_icon'=>'bgi bgi-Content-Management-System',
    //     'menu_url'=>'',
    //     'order'=>3
    // ],
//	[
//            'menu_pk'=>94,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Meeting Requests',
//            'menu_icon'=>'bgi bgi-Meeting-Requests',
//            'menu_url'=>'MEETINGREQUESTADMIN',
//            'order'=>4,
//            'external_link'=>true
//    ],
	[
            'menu_pk'=>98,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>96,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'News & Events',
            'menu_icon'=>'',
            'menu_url'=>'newsandevents',
            'order'=>1,
            'external_link'=>true

    ],
	[
            'menu_pk'=>99,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>96,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'BGI Events (jConnect)',
            'menu_icon'=>'',
            'menu_url'=>'JSRSEVENTADMIN',
            'order'=>2,
			'external_link'=>true
    ],
	
//	[
//            'menu_pk'=>15,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'jSearch',
//            'menu_icon'=>'bgi-menu  menu-Jsearch',
//            'menu_url'=>'bizsearchnew/home',
//            'order'=>7
//        ],
	[
        'menu_pk'=>76,
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
    'submodule_id'=>0,
    'menu_to'=>76,//null-->mainmenu, menuPk --> submenu
    'menu_name'=>'Introduction',
    'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
    'menu_url'=>'enterpriseadmin/landingpage',
    'order'=>1,
    'menu_highlight_url'=>['/enterpriseadmin/landingpage']
],
	
	[
        'menu_pk'=>115,
        'module_id'=>1,
        'submodule_id'=>281,
        'menu_to'=>76,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Divisions',
        'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
        'menu_url'=>'enterpriseadmin/divisions',
        'order'=>2
    ],
	[
        'menu_pk'=>89,
        'module_id'=>282,
        'submodule_id'=>282,
        'menu_to'=>76,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Departments',
        'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
        'menu_url'=>'enterpriseadmin/department',
        'order'=>3
    ],[
        'menu_pk'=>88,
        'module_id'=>1,
        'submodule_id'=>283,
        'menu_to'=>76,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Users',
        'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
        'menu_url'=>'enterpriseadmin/usermanagement',
        'order'=>4,
        'menu_highlight_url'=>['/enterpriseadmin/usermanagement']
    ],
	//  [
    //     'menu_pk'=>91,
    //     'module_id'=>1,
    //     'submodule_id'=>1,
    //     'menu_to'=>76,//null-->mainmenu, menuPk --> submenu
    //     'menu_name'=>'Invited Users',
    //     'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
    //     'menu_url'=>'enterpriseadmin/inviteduser',
    //     'order'=>5
    // ],
	/*[
        'menu_pk'=>116,
        'module_id'=>1,
        'submodule_id'=>1,
        'menu_to'=>76,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Monitor Logs',
        'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
        'menu_url'=>'',
        'order'=>5
    ],*/
	[
        'menu_pk'=>97,
        'module_id'=>285,
        'submodule_id'=>1,
        'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
        'menu_name'=>'Approval Management',
        'menu_icon'=>'bgi bgi-Approval-Management',
        'menu_url'=>'',
        'order'=>5
    ],
	
	[
            'menu_pk'=>101,
            'module_id'=>1,
            'submodule_id'=>287,
            'menu_to'=>97,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'RABT Industrial Organisation (OISSR) Certification Approval',
            'menu_icon'=>'',
            'menu_url'=>'cert/oissr/prioritylisting',
            'order'=>2,
			'external_link'=>true
    ],
        [
            'menu_pk'=>100,
            'module_id'=>1,
            'submodule_id'=>286,
            'menu_to'=>97,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'RABT Supply Chain Certification Approval',
            'menu_icon'=>'',
            'menu_url'=>'cert/suppchain/prioritylisting',
            'order'=>3,
    ],
	// [
    //     'menu_pk'=>100,
    //     'module_id'=>1,
    //     'submodule_id'=>1,
    //     'menu_to'=>97,//null-->mainmenu, menuPk --> submenu
    //     'menu_name'=>'Supplier Registration Approval',
    //     'menu_icon'=>'',
    //     'menu_url'=>'regapproval/supplierapprovaltab',
    //     'order'=>1,
    // ],
	[
            'menu_pk'=>105,
            'module_id'=>1,
            'submodule_id'=>290,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Stakeholder Management',
            'menu_icon'=>'bgi-saicon bgi-SaStakeHolderManagement',
            'menu_url'=>'regapproval/registeredstakeholder',
            'order'=>6,
    ],
	// [
    //         'menu_pk'=>106,
    //         'module_id'=>1,
    //         'submodule_id'=>1,
    //         'menu_to'=>105,//null-->mainmenu, menuPk --> submenu
    //         'menu_name'=>'Registered Suppliers',
    //         'menu_icon'=>'',
    //         'menu_url'=>'regapproval/registeredstakeholder',
    //         'order'=>1,
    // ],
    // [
    //     'menu_pk'=>106,
    //     'module_id'=>1,
    //     'submodule_id'=>1,
    //     'menu_to'=>105,//null-->mainmenu, menuPk --> submenu
    //     'menu_name'=>'Registered Industrial Organisations',
    //     'menu_icon'=>'',
    //     'menu_url'=>'regapproval/registeredstakeholder',
    //     'order'=>2,
    // ],
	/*[
            'menu_pk'=>109,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Temporary Login',
            'menu_icon'=>'bgi bgi-login',
            'menu_url'=>'',
            'order'=>8,
    ],*/
//	[
//            'menu_pk'=>110,
//            'module_id'=>1,
//            'submodule_id'=>1,
//            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
//            'menu_name'=>'Reports',
//            'menu_icon'=>'bgi bgi-Reports',
//            'menu_url'=>'backendadmin/reports',
//            'order'=>8,
//    ],
	// [
    //         'menu_pk'=>111,
    //         'module_id'=>1,
    //         'submodule_id'=>1,
    //         'menu_to'=>110,//null-->mainmenu, menuPk --> submenu
    //         'menu_name'=>'NBF Supplier Statistics',
    //         'menu_icon'=>'',
    //         'menu_url'=>'nbfsupplierstatistics',
    //         'order'=>9,
    //         'external_link'=>true
    // ],
    //     [
    //         'menu_pk'=>112,
    //         'module_id'=>1,
    //         'submodule_id'=>1,
    //         'menu_to'=>110,//null-->mainmenu, menuPk --> submenu
    //         'menu_name'=>'GCC Tender Report',
    //         'menu_icon'=>'',
    //         'menu_url'=>'gcctenderreport',
    //         'order'=>9,
    //         'external_link'=>true
    // ],
	/*[
            'menu_pk'=>113,
            'module_id'=>1,
            'submodule_id'=>1,
            'menu_to'=>110,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'CMS Report',
            'menu_icon'=>'',
            'menu_url'=>'CMSREPORT',
            'order'=>9,
            'external_link'=>true
    ],*/
	
];