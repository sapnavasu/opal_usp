<?php 
namespace api\modules\mst\components;
use Yii;
use \common\models\OpalusermstTbl;

class Permission {

private $accessibleModules=[];

public $subModules=[
    
    'Batch Management'=>[
    'linkedModules'=>[4,11,21,22,23,24,25,5,6,7,8], 
    'accessUrls'=>[
      'R'=>[
          'batchmanagement/get-batch-dtls',
          'batchmanagement/fetch-batchdetails',
          'batchmanagement/checkavailabilityassessor',
          'batchmanagement/get-tevalutioncentres',
          'batchmanagement/get-all-standard-courses',
          'batchmanagement/get-all-standard-courses-by-reg-pk',
          'batchmanagement/getcatlist',
          'batchmanagement/getsubcatlistbycatpk',
          'batchmanagement/get-course-dtlsbysubcatpk',
          'batchmanagement/getbranchlistbyregpk',
          'batchmanagement/get-tutors-list',
          'batchmanagement/gettutoravailabilitylist',
          'batchmanagement/get-ivqastafflist',
          'batchmanagement/get-masters-list',
          'batchmanagement/get-categoryforgridlist',
          'batchmanagement/getlearnerlist',
          'batchmanagement/getassessorlistbybatchpk',
          'batchmanagement/getchangeassesorreq',
          'batchmanagement/getchangeassesorreq',
          'batchmanagement/getlearnerlist',
          'batchmanagement/getbranchinfo',
          'assessmentreport/getlearnerdata',
          'assessmentreport/getassessmentreport',
          'assessmentreport/getlearnerstatus',
          'batchmanagement/viewlearner',
          'app-center/getstaffbas',
          'batchmanagement/getlearneredulist',
          'batchmanagement/getworkexplist',
          'batchmanagement/getcertified',
          'app-center/getreference',
          'batchmanagement/getlearnerfee',
          'assessmentreport/getbatchdata',
          'assessmentreport/getbatchdetails',
          'assessmentreport/getassessordetails',
          'assessmentreport/viewcard',
          'assessmentreport/getuser',

          ],
      'C'=>['batchmanagement/savebatchdtls',
            'assessmentreport/saveassessmentreport',
            'assessmentreport/savequalitycheckstatus',
            'assessmentreport/printcard'
            ],
      'U'=>[
          'batchmanagemnet/move-batch-to-theory',
          'batchmanagemnet/change-batchstatus',
          'batchmanagemnet/requestforbacktrack',
          'batchmanagemnet/cancelbacktrack',
          'batchmanagemnet/changeassesor',
          'batchmanagemnet/requesttochangeassesor',
          'assessmentreport/updatelearnerstatus',
          'assessmentreport/registrationcancel',

          ],
      'D' =>[
        'assessmentreport/deletelearner',

          ],
      'A'=>[],
      'DW'=>[
          'batchmanagement/downloadattendance',
          'batchmanagement/downloadattend',
      ],
    ]
    ],
    
    'Training Centre Staff'=>[
    'linkedModules'=>[20], 
    'accessUrls'=>[
      'R'=>['coursemanagement/saveaccessorscheduledtls','app-center/userterevedtls'],
      'C'=>[''],
      'U'=>[],
      'D' =>[''],
      'A'=>[],
      'DW'=>[],
    ]
    ],
      
    'Staff Management'=>[
    'linkedModules'=>[20], 
    'accessUrls'=>[
      'R'=>['coursemanagement/saveaccessorscheduledtls','appcenter/userterevedtls'],
      'C'=>[''],
      'U'=>[],
      'D' =>[''],
      'A'=>[],
      'DW'=>[],
    ]
    ],
      
    'Account Settings'=>[
    'linkedModules'=>[9], 
    'accessUrls'=>[
      'R'=>['coursemanagement/saveaccessorscheduledtls','appcenter/userterevedtls'],
      'C'=>[''],
      'U'=>[],
      'D' =>[''],
      'A'=>[],
      'DW'=>[],
    ]
    ],
      
    'Learner Feedback'=>[
    'linkedModules'=>[12], 
    'accessUrls'=>[
      'R'=>['coursemanagement/saveaccessorscheduledtls','appcenter/userterevedtls'],
      'C'=>[''],
      'U'=>[],
      'D' =>[''],
      'A'=>[],
      'DW'=>[],
    ]
    ],
    'Learner Card Log'=>[
      'linkedModules'=>[18], 
      'accessUrls'=>[
        'R'=>['learnercard/getstandardcourse','learnercard/getlearnercard'],
        'C'=>['learnercard/getnationality',
            'learnercard/gettrainingcenter',
            'learnercard/carddetails',
            'learnercard/getbatchnumber',
            'learnercard/getsinglelearnercard',
            'learnercard/getsubcategories',
            'learnercard/addstaff',
            'learnercard/addsubcategory'
          ],
        'U'=>['learnercard/editcard'],
        'D' =>[''],
        'A'=>[],
        'DW'=>[],
      ]
    ],
    'Learner Feedback'=>[
      'linkedModules'=>[5,12], 
      'accessUrls'=>[
        'R'=>['learnerfeedback/getfeedbacklist',
              'learnerfeedback/getfeedbackquestionanswer'
              ],
        'C'=>[ ],
        'U'=>[],
        'D' =>[],
        'A'=>[],
        'DW'=>[],
      ]
    ],
      
    'Approval Management'=>[
      'linkedModules'=>[10,12,11], 
      'accessUrls'=>[
        'R'=>[
            'app-center/getdesktop',
            'app-center/getcompany',
            'app-center/getinsinfrdtl',
            'app-center/getmainrole',
            'app-center/getdocument',
            'app-center/getinspection',
            'app-center/getstaffvalidation',
            'app-center/getcourse',
            'app-center/getstaffvalidation',
            'app-center/getmainrole',
            'app-center/getcoursecategory',
            'app-center/getinspectiondata',
            'app-center/fetch-favourite-staffdata',
            'app-center/fetch-favourite-staffwrk',
            'app-center/fetch-favourite-staffacd',
            'app-center/getreferance',
            'app-center/getsubcoursecategory',
            'app-center/getpayment',
            'app-center/getstaffschedule',
            'app-center/getauditdata',
            'app-center/getgrademst',
            'app-center/getsitedata',
            'app-center/getsitequestionsdata',
            'app-center/updateapproval1',
            'app-center/getintenational',
            'app-center/getoperator',
            'app-center/updatepayment',
            'app-center/getsccsitedata','app-center/getstaffpracticalassessmentlist',
             'app-center/getappapprovalhrd',
             'app-center/getstandardcourselist',
             'app-center/getapprovalsitedata',
             'app-center/standaradcustomize',
             'app-center/checkallapprovedornot',
             'app-center/getdocumenttab',
             'app-center/getinternational',
             'app-center/getonerecordstandaradcustomize',
             'app-center/getstaffttab',
             'app-center/getstaffttabdata',
             'app-center/geteducationqulification',
             'app-center/getstaffassesorloca',
             'app-center/getstaffavailabledate',
             'app-center/getvaluestaffview',
             'app-center/getworkexp',
             'app-center/getstaffassessmentstatus'
            
            ],
        'C'=>['app-center/savescheduledate',],
        'U'=>[
            'app-center/updateapplication',
            'app-center/updateapproval',
            'app-center/updatesite',
            'app-center/updatepayment',
            'app-center/savenextlevelapprovalstatus',
            'app-center/changesiteauditstatus',
            ],
        'D' =>[
            
            ],
        'A'=>[
          'app-center/desktopreviewstatuschanged',
          'app-center/interstatuschanged',
          'app-center/docstatuschanged',
          'app-center/staffapprodecproce',
          'app-center/overallapprovdec',
          'app-center/updatepayment',
          'app-center/savescsiteaudit',
          'app-center/savestaffevaluationtmp',
          'app-center/savenextlevelapprovalstatus',
          'app-center/changesiteauditstatus'
        ],
        'DW'=>[
            'app-center/downloadlist',
            'app-center/downloadlistras',
            'app-center/coursedownloadlist'
        ],
      ]
      ], 
      
      
     

];

public function __construct($res){ 
  $this->accessibleModules=$res;
  $this->isAdmin= \yii\db\ActiveRecord::getTokenData('oum_isfocalpoint',true);
}

// Return true - The user is having access, Returns false - The user is not having access
public function isAccessGiven($url,$res){
  $isAllowed=false;

   if($this->isAdmin == 1)
  {
    return true;
  }
  
 
foreach ($this->subModules as $key => $submodule) {
    foreach ($submodule['linkedModules'] as $moduleId) {
        
        $allowedModules=$this->accessibleModules[$moduleId];

        if(in_array($url,$submodule['accessUrls']['R']) && $allowedModules["read"]=='Y'){
          $isAllowed=true;
        }
        if(in_array($url,$submodule['accessUrls']['C']) && $allowedModules["create"]=='Y'){
          $isAllowed=true;
        }
        if(in_array($url,$submodule['accessUrls']['U']) && $allowedModules["update"]=='Y'){
          $isAllowed=true;
        }
        if(in_array($url,$submodule['accessUrls']['D']) && $allowedModules["delete"]=='Y'){
          $isAllowed=true;
        }
        if(in_array($url,$submodule['accessUrls']['A']) && $allowedModules["approval"]=='Y'){
          $isAllowed=true;
        }
        if(in_array($url,$submodule['accessUrls']['DW']) && $allowedModules["download"]=='Y'){
          $isAllowed=true;
       }
   
    }
}

    if($isAllowed){
      return true;
    }else{
        return false;
    }
}
}

   


  
