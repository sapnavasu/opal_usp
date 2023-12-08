import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { CentreauditComponent } from './centreaudit/centreaudit.component';
import { CentrecertificationComponent } from './centrecertification/centrecertification.component';
import { CentredesktopreviewComponent } from './centredesktopreview/centredesktopreview.component';
import { CentreinstituteinfoComponent } from './centreinstituteinfo/centreinstituteinfo.component';
import { QualitymanagerapprovalComponent } from './qualitymanagerapproval/qualitymanagerapproval.component';
import { SiteauditComponent } from './siteaudit/siteaudit.component';
import { SchedulesiteauditComponent } from './schedulesiteaudit/schedulesiteaudit.component';
import { CentrecompanydtlComponent } from './centrecompanydtl/centrecompanydtl.component';
import { ChangestaffComponent } from './changestaff/changestaff.component';
// import { CourseviewComponent } from '../trainingcentremanagement/courseview/courseview.component';
import { CoursetabdetailComponent } from './coursetabdetail/coursetabdetail.component';
import { TrainingcentremanagementComponent } from '../trainingcentremanagement/trainingcentremanagement.component';
import { AssessmentreportComponent } from './assessmentreport/assessmentreport.component';

const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'home/:id',
      component: CentrecertificationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Evaluation Centre Approval',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home/:id' }        ]
      },
    },
    {
      path: 'rashome/:id',
      component: CentrecertificationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Technical Evaluation Centre Approval',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval'},
          // { title: 'Approval', url: '/centrecertification/rashome/:id' } 
        ]
      },
    },
    {
      path: 'desktopreview/:id/:type/:approval/:projectpk',
      component: CentredesktopreviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Certification Form',
        urls: [
         // { title: 'Training Evaluation Centre Approval', url: '/centrecertification/desktopreview/:id/:type/:approval' },
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home/:id' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview/:id/:type/:approval/:projectpk',last:'true'}        ]
      },
    },
    {
      path: 'rasdesktopreview/:id/:type/:approval/:projectpk',
      component: CentredesktopreviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Certification Form',
        urls: [
         // { title: 'Training Evaluation Centre Approval', url: '/centrecertification/desktopreview/:id/:type/:approval' },
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome/:id' },
          { title: 'View Certification Form', url: '/centrecertification/rasdesktopreview/:id/:type/:approval/:projectpk',last:'true'}
        ]
      },
    },
    {
      path: 'certificateview/:id',
      component: CentredesktopreviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Certificate View',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/desktopreview/:id/view' },
          { title: 'Certificate View', url: '',last:'true'}
        ]
      },
    },
  
    {
      path: 'instituteinfo',
      component: CentreinstituteinfoComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Certification Form',
        urls: [
           { title: 'Training Evaluation Centre Approval', url: '/centrecertification/instituteinfo',last:'true' }
        ]      },
    },
    {
      path: 'auditlog/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'Audit Log',last:'true' }
        ]
      },
    },
    {
      path: 'auditlogdesk/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Audit Log',last:'true' }
        ]
      },
    },
    {
      path: 'auditlogpay/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'View Payment Details', url: '/paymentinvoiceindex/invoice',href:'true' },
          { title: 'Audit Log',last:'true' }
        ]
      },
    },
      {
        path: 'auditlogras/:id/:type',
        component: CentreauditComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'Audit Log',
          breadcrumb: 'Audit Log',
          urls: [
            { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
            { title: 'Audit Log',last:'true'}
          ]
        },
      },
      {
        path: 'auditlograsdesk/:id/:type',
        component: CentreauditComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'Audit Log',
          breadcrumb: 'Audit Log',
          urls: [
            { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
            { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
            { title: 'Audit Log',last:'true'}
          ]
        },
      },
      {
        path: 'auditlograspay/:id/:type',
        component: CentreauditComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'Audit Log',
          breadcrumb: 'Audit Log',
          urls: [
            { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/invoice/rasdetails',href:'true' },
            { title: 'Audit Log',last:'true'}
          ]
        },
      },
    {
      path: 'siteaudit',
      component: SiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Site Audit Report',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'View Site Audit Report',last:'true' }
        ]
      },
    },
     {
      path: 'qualitymanagerapproval',
      component: QualitymanagerapprovalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Site Audit Report',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/siteaudit' ,last:'true' }
        ]
      },
    },
    {
      path: 'schedulesiteaudit',
      component: SchedulesiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Schedule Site Audit',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'Schedule Site Audit', url: '/centrecertification/schedulesiteaudit',last:'true' }
        ]
      },
    },
    {
      path: 'rasschedulesiteaudit',
      component: SchedulesiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Schedule Site Audit',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
          { title: 'Schedule Site Audit', url: '/centrecertification/rasschedulesiteaudit',last:'true' }
        ]
      },
    },
    {
      path: 'changestaff',
      component: ChangestaffComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Change Another Staff',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'Schedule Site Audit', url: '/centrecertification/schedulesiteaudit' },
          { title: 'Change Another Staff', url: '/centrecertification/changestaff',last:'true' }
        ]
      },
    },
    {
      path: 'schedulesiteaudit/stand',
      component: SchedulesiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Schedule Site Audit',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'Schedule Site Audit', url: '/centrecertification/schedulesiteaudit/stand',last:'true' }
        ]
      },
    },
    {
      path: 'schedulesiteaudit/cour',
      component: SchedulesiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Schedule Site Audit',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'Schedule Site Audit', url: '/centrecertification/schedulesiteaudit/cour',last:'true' }
        ]
      },
    },
    {
      path: 'auditlogstand/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'Audit Log', url: '/centrecertification/auditlogstand/:id/:type',last:'true' }
        ]
      },
    },
    {
      path: 'auditlogstanddesk/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Certification Form', url: '/standardcourseapproval/desktopreview',href:'true' },
          { title: 'Audit Log', url: '/centrecertification/auditlogstand/:id/:type',last:'true' }
        ]
      },
    },
    {
      path: 'auditlogstandpay/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Payment Details', url: '/paymentinvoiceindex/invoicestand',href:'true' },          
          { title: 'Audit Log', url: '/centrecertification/auditlogstand/:id/:type',last:'true' }
        ]
      },
    },
    {
      path: 'uploadassessment/:id/:staffid/:catid/:assessmenttype',
      component: AssessmentreportComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff Assessment',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype' },
          { title: 'Staff Assessment', url: '/centrecertification/uploadassessment/:id/:staffid/:catid/:assessmenttype' ,last:'true'}
        ]
      },
    },
    {
      path: 'uploadassessmentupdate/:id/:staffid/:catid/:assessmenttype',
      component: AssessmentreportComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff Assessment',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype' },
          { title: 'Staff Assessment', url: '/centrecertification/uploadassessmentupdate/:id/:staffid/:catid/:assessmenttype',last:'true' }
        ]
      },
    },
    {
      path: 'uploadassessmentView/:id/:staffid/:catid/:assessmenttype',
      component: AssessmentreportComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff Assessment',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype' }, 
          { title: 'Staff Assessment', url: '/centrecertification/uploadassessmentView/:id/:staffid/:catid/:assessmenttype',last:'true' }
        ]
      },
    },
    {
      path: 'auditlogstand/:id/:type',
      component: CentreauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Audit Log',
        breadcrumb: 'Audit Log',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'Audit Log',last:'true' }
        ]
      },
    },
  ],
 
},];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CertificationapprovalRoutingModule { }
