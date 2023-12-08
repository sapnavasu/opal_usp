import { Injectable, OnInit } from '@angular/core';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

let subfolder = '';
export interface BadgeItem {
  type: string;
  value: string;
}
export interface Saperator {
  name: string;
  type?: string;
}
export interface SubChildren {
  state: string;
  name: string;
  type?: string;
}
export interface ChildrenItems {
  state: string;
  name: string;
  type?: string;
  child?: SubChildren[];
}

export interface Menu {
  state: string;
  name: string;
  type: string;
  icon: string;
  badge?: BadgeItem[];
  saperator?: Saperator[];
  children?: ChildrenItems[];
}
export const MENUITEMS_SUPERADMIN = [
  {
    state: '..'+subfolder+'/dashboard/portaladmin',
    name: 'Dashboard',
    type: 'link',
    icon: 'opal-Dashboard',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageroles?type=MQ==',
    name: 'Manage Roles',
    type: 'link',
    icon: 'opal-Manage-Roles',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mg==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'configuration',
    name: 'Configuration',
    type: 'sub',
    icon: 'opal-gear',
    children: [
      { state: '../configuration/maintenance', name: 'Maintenance Configuration', type: 'link' },
      
    ],
  },
  // {
  //   state: '..'+subfolder+'/newenterpriseadmin/addroles?type=Mg==',
  //   name: 'Manage Users',
  //   type: 'link',
  //   icon: 'opal-Manage-Users',
  // },
  {
    state: 'trainingcentremanagement',
    name: 'Approval Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../centrecertification/home/MQ==', name: 'Training Evaluation Centre Approval', type: 'link' },
      { state: '../standardcourseapproval/approvaldetails', name: 'Standard & Customized Course Approval', type: 'link' },
      { state: '../centrecertification/rashome/NA==', name: 'RAS Technical Evaluation Centre Approval', type: 'link' },
      /*   { state: '../batchindex/batchgridlisting', name: 'Technical Inspection Centre Approval', type: 'link' }, */
      
    ],
  },
  {
    state: 'invoicemanagement',
    name: 'Invoice Management',
    type: 'sub-inc',
    icon: 'opal-Invoice-Management',
    children: [
     
      { state: '../invoicemanagement/centrecertificate', name: 'Centre Certification', type: 'link' },
      { state: '../invoicemanagement/coursecertificate', name: 'Course Certification', type: 'link' },
      { state: '../invoicemanagement/royaltyfee', name: 'Royalty Fee', type: 'link' },
      { state: '../invoicemanagement/listassessment', name: 'Assessment Fee', type: 'link' },  
    ],
  },
//  {
//     state: 'configuration',
//     name: 'Configuration',
//     type: 'sub',
//     icon: 'opal-Approval-Management',
//     children: [
//       { state: '../standardcourseconfiguration/sccgridlist', name: 'Standard Course Configuration', type: 'link' },
      
//     ],
//   },
  /* {
    state: '../assessmentreport/viewlearner',
    name: 'Invoice Management',
    type: 'link',
    icon: 'opal-Invoice-Management',
  },
  {
    state: '../assessmentreport/viewlearner',
    name: 'Learner Card Log',
    type: 'link',
    icon: 'opal-Learner-Card-Log',
  }, */
  {
    state: '..'+subfolder+'/batchindex/batchgridlisting',
    name: 'Batch Management',
    type: 'link',
    icon: 'opal-Batch-Management',
  },
  {
   
    state: '..'+subfolder+'/vehiclemanagement/list',
    name: 'RAS Vehicle Management',
    type: 'link',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
  },
{
    state: '..'+subfolder+'/manageivms/ivmslist',
    name: 'Manage IVMS Device Installed Vehicles',
    type: 'link',
    icon: 'opal-Invoice-Management',
  },
  {
    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/trainingcentre', name: 'Training Centre Staff', type: 'link' },
      { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    // state: '..'+subfolder+'/assessmentreport/learnerfeedbacklist',
    state: '..'+subfolder+'/configuration',
    name: 'Configuration',
    type: 'link',
    icon: 'opal-Learner-Card-Log',
  },
  {
    state: '..'+subfolder+'/assessmentreport/learnerfeedbacklist',
    name: 'Learner Feedback',
    type: 'link',
    icon: 'opal-Learner-Feedback',
  },
  {
    state: '..'+subfolder+'/learnercardmanagement/learnergridlist',
    name: 'Learner Card Log',
    type: 'link',
    icon: 'opal-Learner-Card-Log',
  },
  /* {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  }, */

];


export const MENUITEMS_CENTER = [
  {
    state: '..'+subfolder+'/dashboard/centre',
    name: 'Dashboard',
    type: 'link',
    icon: 'opal-Dashboard',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'trainingcentremanagement',
    name: 'Training Evaluation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../trainingcentremanagement/branchcentre/MQ==', name: 'Training Evaluation Centre Certification', type: 'link' },
      { state: '../standardcourse/home', name: 'Standard & Customized Course Certification', type: 'link' },
      { state: '../batchindex/batchgridlisting', name: 'Batch Management', type: 'link' },
    ],
  },
  {
    state: 'vehiclemanagement',
    name: 'Technical Inspection Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../vehiclemanagement/rasbranchcentre/NA==', name: 'RAS Inspection Centre Certification', type: 'link' },
      // { state: '../vehiclemanagement/vehiclelisting', name: 'Vehicle Inspection and Approval', type: 'link' },
     
    ],
  },
{




    state: 'manageivms',
    name: 'Technical Installation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../manageivms/ivmscentrelist', name: 'IVMS Device Installation and Approval', type: 'link' },
    ],
  },
  {
    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/trainingcentre', name: 'Training Centre Staff', type: 'link' },
    ],
  },
  {
    state: '..'+subfolder+'/assessmentreport/learnerfeedbacklist',
    name: 'Learner Feedback',
    type: 'link',
    icon: 'opal-Learner-Feedback',
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];

export const MENUITEMS_IVMS_ONLY = [
  
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  
  {
    state: 'manageivms',
    name: 'Technical Installation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../manageivms/ivmscentrelist', name: 'IVMS Device Installation and Approval', type: 'link' },
    ],
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];

export const MENUITEMS_CENTER_ONLY = [
  {
    state: '..'+subfolder+'/dashboard/centre',
    name: 'Dashboard',
    type: 'link',
    icon: 'opal-Dashboard',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'trainingcentremanagement',
    name: 'Training Evaluation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../trainingcentremanagement/branchcentre/MQ==', name: 'Training Evaluation Centre Certification', type: 'link' },
      { state: '../standardcourse/home', name: 'Standard & Customized Course Certification', type: 'link' },
      { state: '../batchindex/batchgridlisting', name: 'Batch Management', type: 'link' },
    ],
  },
  {
    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/trainingcentre', name: 'Training Centre Staff', type: 'link' },
    ],
  },
  {
    state: '..'+subfolder+'/assessmentreport/learnerfeedbacklist',
    name: 'Learner Feedback',
    type: 'link',
    icon: 'opal-Learner-Feedback',
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];
export const MENUITEMS_CENTER_USER = [
  
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'trainingcentremanagement',
    name: 'Training Evaluation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../batchindex/batchgridlisting', name: 'Batch Management', type: 'link' },
    ],
  },
  {
    state: 'vehiclemanagement',
    name: 'Technical Inspection Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../vehiclemanagement/vehiclelisting', name: 'Vehicle Inspection and Approval', type: 'link' },
     
    ],
  },
  {
    state: 'manageivms',
    name: 'Technical Installation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../manageivms/ivmscentrelist', name: 'IVMS Device Installation and Approval', type: 'link' },
    ],
  },
  {
    state: '..'+subfolder+'/assessmentreport/learnerfeedbacklist',
    name: 'Learner Feedback',
    type: 'link',
    icon: 'opal-Learner-Feedback',
  },
{


    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/trainingcentre', name: 'Training Centre Staff', type: 'link' },
      // { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },
 
];
export const MENUITEMS_CENTER_BOTH  = [
  {
    state: '..'+subfolder+'/dashboard/centre',
    name: 'Dashboard',
    type: 'link',
    icon: 'opal-Dashboard',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'trainingcentremanagement',
    name: 'Training Evaluation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../trainingcentremanagement/branchcentre/MQ==', name: 'Training Evaluation Centre Certification', type: 'link' },
      { state: '../standardcourse/home', name: 'Standard & Customized Course Certification', type: 'link' },
      { state: '../batchindex/batchgridlisting', name: 'Batch Management', type: 'link' },
    ],
  },
  {
    state: 'vehiclemanagement',
    name: 'Technical Inspection Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../vehiclemanagement/rasbranchcentre/NA==', name: 'RAS Inspection Centre Certification', type: 'link' },
      { state: '../vehiclemanagement/vehiclelisting', name: 'Vehicle Inspection and Approval', type: 'link' },
     
    ],
  },
  {
    state: 'manageivms',
    name: 'Technical Installation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../manageivms/ivmscentrelist', name: 'IVMS Device Installation and Approval', type: 'link' },
    ],
  },
  {
    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/trainingcentre', name: 'Training Centre Staff', type: 'link' },
      { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    state: '..'+subfolder+'/assessmentreport/learnerfeedbacklist',
    name: 'Learner Feedback',
    type: 'check',
    icon: 'opal-Learner-Feedback',
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];
export const MENUITEMS_TECHNICAL  = [
  {
    state: '..'+subfolder+'/dashboard/centre',
    name: 'Dashboard',
    type: 'link',
    icon: 'opal-Dashboard',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'vehiclemanagement',
    name: 'Technical Inspection Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../vehiclemanagement/rasbranchcentre/NA==', name: 'RAS Inspection Centre Certification', type: 'link' },
      { state: '../vehiclemanagement/vehiclelisting', name: 'Vehicle Inspection and Approval', type: 'link' }
    ],
  },
  {
    state: 'manageivms',
    name: 'Technical Installation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../manageivms/ivmscentrelist', name: 'IVMS Device Installation and Approval', type: 'link' },
    ],
  },
  {
    state: 'trainingcentremanagement',
    name: 'Training Evaluation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../trainingcentremanagement/branchcentre/MQ==', name: 'Training Evaluation Centre Certification', type: 'link' },
  
    ],
  },
  {
    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];
export const MENUITEMS_TECHNICAL_ONLY  = [
  {
    state: '..'+subfolder+'/dashboard/centre',
    name: 'Dashboard',
    type: 'link',
    icon: 'opal-Dashboard',
  },
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'vehiclemanagement',
    name: 'Technical Inspection Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../vehiclemanagement/rasbranchcentre/NA==', name: 'RAS Inspection Centre Certification', type: 'link' },
      { state: '../vehiclemanagement/vehiclelisting', name: 'Vehicle Inspection and Approval', type: 'link' },
      // { state: '../trainingcentremanagement/branchcentre/MQ==', name: 'Training Evaluation Centre Certification', type: 'link' },

     
    ],
  },
  {


    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];
export const MENUITEMS_TECHNICAL_USER  = [
  {
    state: '..'+subfolder+'/newenterpriseadmin/manageusers?type=Mw==',
    name: 'Manage Users',
    type: 'link',
    icon: 'opal-Manage-Users',
  },
  {
    state: 'vehiclemanagement',
    name: 'Technical Inspection Centre Certification Management',
    type: 'sub',
    icon: 'opal-Technical-Inspection-Centre-Certification-Management-04',
    children: [
      { state: '../vehiclemanagement/vehiclelisting', name: 'Vehicle Inspection and Approval', type: 'link' },
     
    ],
  },
  {
    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];

export const MENUITEMS_TECHNICAL_IVMS_USER  = [
  // {
  //   state: '..'+subfolder+'/dashboard/centre',
  //   name: 'Dashboard',
  //   type: 'link',
  //   icon: 'opal-Dashboard',
  // },
  {
    state: 'manageivms',
    name: 'Technical Installation Centre Certification Management',
    type: 'sub',
    icon: 'opal-Training-Evaluation-Centre-Certification-Management',
    children: [
      { state: '../manageivms/ivmscentrelist', name: 'IVMS Device Installation and Approval', type: 'link' },
    ],
  },
{


    state: 'staffmanagement',
    name: 'Staff Management',
    type: 'sub',
    icon: 'opal-Approval-Management',
    children: [
      { state: '../approvalstaffmanagement/technicalcentre', name: 'Technical Evaluation Centre', type: 'link' },
    ],
  },
  {
    state: '',
    name: 'Contact Us',
    type: 'click',
    icon: 'opal-Contact-us',
  },

];

@Injectable()
export class MenuItems implements OnInit {
  public usertype: any;
  focalpoint: any;
  registertype: any;
  userprojectpk: any;


  constructor(private localstorage: AppLocalStorageServices) {
    //usertype 1 - backend  2-center
    this.usertype = this.localstorage.getInLocal("stktype");

  }
  ngOnInit(): void {

  }
  getMenuitem(): Menu[] {
    this.usertype = this.localstorage.getInLocal("stktype");
    this.focalpoint = this.localstorage.getInLocal("isadmin");
     // this.registertype  1-opal star, 2.technical assessment, 3-both'
    this.registertype = this.localstorage.getInLocal("regtype");
    this.userprojectpk = this.localstorage.getInLocal('oum_projectmst_fk');

    // this.usertype  1-SUPERADMIN 2- CENTER
    if (this.usertype == 1) {
      return MENUITEMS_SUPERADMIN;
    } else if (this.usertype == 2 && this.focalpoint == 1 && this.registertype == 1) {
          if(this.userprojectpk == 1){
            return MENUITEMS_CENTER_ONLY;
          }else if(this.userprojectpk == 4){
            return MENUITEMS_TECHNICAL_ONLY;
          }else if(this.userprojectpk == 5){
            return MENUITEMS_IVMS_ONLY;
          }else{
            return MENUITEMS_CENTER;
          }
     
    }else if (this.usertype == 2 && this.focalpoint == 1 && this.registertype == 2) {
      if(this.userprojectpk == 1){
        return MENUITEMS_CENTER_ONLY;
      }else if(this.userprojectpk == 4){
        return MENUITEMS_TECHNICAL_ONLY;
      }else if(this.userprojectpk == 5){
        return MENUITEMS_IVMS_ONLY;
      }
      else
      {
        return MENUITEMS_TECHNICAL;
      }
 
 
  }else if (this.usertype == 2 && this.focalpoint == 1 && this.registertype == 3) {
      if(this.userprojectpk == 1){
        return MENUITEMS_CENTER_ONLY;
      }else if(this.userprojectpk == 4){
        return MENUITEMS_TECHNICAL_ONLY;
      }else if(this.userprojectpk == 5){
        return MENUITEMS_IVMS_ONLY;
      }else{
        return MENUITEMS_CENTER_BOTH;
      }
      
    }else if (this.registertype == 2 && this.focalpoint == 1 ) {
      return MENUITEMS_TECHNICAL;
    }else if (this.registertype == 2 && this.focalpoint != 1 && this.userprojectpk == 4) {
      return MENUITEMS_TECHNICAL_USER;
    }else if (this.registertype == 2 && this.focalpoint != 1 && this.userprojectpk == 5) {
      return MENUITEMS_TECHNICAL_IVMS_USER;
    }else if (this.registertype == 3 && this.focalpoint != 1 && this.userprojectpk == 4) {
      return MENUITEMS_TECHNICAL_USER;
    }else if (this.registertype == 3 && this.focalpoint != 1 && this.userprojectpk == 5) {
      return MENUITEMS_TECHNICAL_IVMS_USER;
    }else if(this.usertype == 2 && (this.focalpoint == 2 || this.focalpoint == null || this.focalpoint == undefined )){
      return MENUITEMS_CENTER_USER;
    }

  }
}