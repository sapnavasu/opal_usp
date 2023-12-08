<?php
return [
        [
            'menu_pk'=>38,
            'module_id'=>0,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Dashboard',
            'menu_icon'=>'bgi-menu menu-dashboard',
            'menu_url'=>'GLOBECONNECT',
            'order'=>1,
            'external_link'=>true
        ],

        [
            'menu_pk'=>10,
            'module_id'=>179,
            'submodule_id'=>1,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Enterprise Admin',
            'menu_icon'=>'bgi-menu menu-Enterprise-Admin',
            'menu_url'=>'',
            'order'=>2
        ],
         [
            'menu_pk'=>11,
            'module_id'=>179,
            'submodule_id'=>0,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Introduction',
            'menu_icon'=>'',
            'menu_url'=>'enterpriseadmin/landingpage',
            'order'=>1
        ],
         [
            'menu_pk'=>12,
            'module_id'=>179,
            'submodule_id'=>180,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Divisions',
            'menu_icon'=>'',
            'menu_url'=>'enterpriseadmin/divisions',
            'order'=>2
        ],
         [
            'menu_pk'=>13,
            'module_id'=>179,
            'submodule_id'=>181,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Departments',
            'menu_icon'=>'',
            'menu_url'=>'enterpriseadmin/department',
            'order'=>3
        ],
        [
            'menu_pk'=>14,
            'module_id'=>179,
            'submodule_id'=>182,
            'menu_to'=>10,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Users',
            'menu_icon'=>'',
            'menu_url'=>'enterpriseadmin/usermanagement',
            'order'=>4
        ],
            [
            'menu_pk'=>15,
            'module_id'=>184,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Profile Management',
            'menu_icon'=>'bgi bgi-profile_management',
            'menu_url'=>'',
            'order'=>3,
        ],
      [
            'menu_pk'=>16,
            'module_id'=>184,
            'submodule_id'=>0,
            'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Introduction',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/landingpage',
            'order'=>1,
        ],
          [
            'menu_pk'=>17,
            'module_id'=>184,
            'submodule_id'=>185,
            'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Company Information',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/companyinformation',
            'order'=>2
              
        ],   
      [
            'menu_pk'=>50,
            'module_id'=>184,
            'submodule_id'=>186,
            'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'About Company',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/aboutcompany',
            'order'=>3
        ],
    
      [
                'menu_pk'=>19,
                'module_id'=>184,
                'submodule_id'=>187,
                'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
                'menu_name'=>'Accomplishments',
                'menu_icon'=>'',
                'menu_url'=>'profilemanagement/masteraccomplishment',
                'order'=>4
            ],
         [
            'menu_pk'=>20,
            'module_id'=>184,
            'submodule_id'=>189,
            'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Market Presence',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/marketpresence',
            'order'=>5
        ],
        [
            'menu_pk'=>21,
            'module_id'=>184,
            'submodule_id'=>190,
            'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Web Presence',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/webpresence',
            'order'=>6
        ],
         [
            'menu_pk'=>22,
            'module_id'=>184,
            'submodule_id'=>191,
            'menu_to'=>15,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Board & Management',
            'menu_icon'=>'',
            'menu_url'=>'profilemanagement/boardmembers',
            'order'=>7
        ],
         [
            'menu_pk'=>23,
            'module_id'=>192,
            'submodule_id'=>193,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'BIZ Search',
            'menu_icon'=>'bgi bgi-biz_search',
            'menu_url'=>'bizsearchnew/home',
            'order'=>4
        ],
        [
            'menu_pk'=>24,
            'module_id'=>194,
            'submodule_id'=>0,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Opportunities',
            'menu_icon'=>'bgi bgi-Opportunities',
            'menu_url'=>'',
            'order'=>5
        ],
    
          [
            'menu_pk'=>25,
            'module_id'=>194,
            'submodule_id'=>195,
            'menu_to'=>24,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'GCC Tenders',
            'menu_icon'=>'',
            'menu_url'=>'dashboard/gcctenderlandingpage',
            'order'=>1,
        ],
          [
            'menu_pk'=>26,
            'module_id'=>196,
            'submodule_id'=>197,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Globeconnect Partners',
            'menu_icon'=>'bgi bgi-sectorpartner',
            'menu_url'=>'globeconnectpartners',
            'order'=>6,
               'external_link'=>true
        ],
        [
            'menu_pk'=>27,
            'module_id'=>198,
            'submodule_id'=>199,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Connected Companies',
            'menu_icon'=>'bgi bgi-jsrs_connect',
            'menu_url'=>'connectedcompanies',
            'order'=>7,
            'external_link'=>true
            
        ],
    
        [
            'menu_pk'=>28,
            'module_id'=>200,
            'submodule_id'=>201,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'JSRS B2B Events',
            'menu_icon'=>'bgi bgi-Completed_event',
            'menu_url'=>'jsrsevent',
            'order'=>8,
            'external_link'=>true
        ],
          [
            'menu_pk'=>29,
            'module_id'=>202,
            'submodule_id'=>203,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'The Stage Events',
            'menu_icon'=>'bgi bgi-Meeting_Sheduler',
            'menu_url'=>'speakatstage',
            'order'=>9,
              'external_link'=>true
        ],
          [
            'menu_pk'=>30,
            'module_id'=>204,
            'submodule_id'=>205,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'News Feed',
            'menu_icon'=>'bgi bgi-news_feeds',
            'menu_url'=>'newsfeedgc',
            'order'=>10,
            'external_link'=>true
        ],
        [
            'menu_pk'=>31,
            'module_id'=>208,
            'submodule_id'=>209,
            'menu_to'=>0,//null-->mainmenu, menuPk --> submenu
            'menu_name'=>'Contact Us',
            'menu_icon'=>'bgi bgi-contact-book',
            'menu_url'=>'contactj2',
            'order'=>11,
            'external_link'=>true
        ],
    ];