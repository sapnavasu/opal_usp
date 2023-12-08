import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { ApprovaldetailsComponent } from './approvaldetails/approvaldetails.component';
import { CoursedetailsComponent } from './coursedetails/coursedetails.component';
import { DesktopreviewComponent } from './desktopreview/desktopreview.component';
import { ScsiteauditComponent } from './scsiteaudit/scsiteaudit.component';
import { StaffviewComponent } from './staffview/staffview.component';
import { UploadassessmentComponent } from './uploadassessment/uploadassessment.component';
import { ViewassessmentComponent } from './viewassessment/viewassessment.component';

const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'desktopreview',
      component: DesktopreviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Standard & Customized Course Approval',
        breadcrumb: 'Standard & Customized Course',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Certification Form', url: '/standardcourseapproval/desktopreview',href:'true' }
        ]
      },
    },
    {
      path: 'coursedetails',
      component: CoursedetailsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Standard & Customized Course Approval',
        breadcrumb: 'Standard & Customized Course',
        urls: [
          { title: 'View Certification Form', url: '/standardcourseapproval/coursedetails' ,last:'true'}
        ]
      },
    },
    {
      path: 'approvaldetails',
      component: ApprovaldetailsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Standard & Customized Course Approval',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails',last:'true' }
        ]
      },
    },
    {
      path: 'siteaudit',
      component: ScsiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Site Audit Report',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Site Audit Report', url: '/standardcourseapproval/siteaudit' ,last:'true' }
        ]
      },
    },
    {
      path: 'rassiteaudit',
      component: ScsiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Site Audit Report',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome/:id' },
          { title: 'View Site Audit Report', url: '/standardcourseapproval/rassiteaudit',last:'true' }
        ]
      },
    },
    {
      path: 'rassiteauditview',
      component: ScsiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Site Audit Report',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome/:id' },
          { title: 'View Site Audit Report', url: '/standardcourseapproval/rassiteauditview',last:'true' }
        ]
      },
    },
    {
      path: 'uploadassessment',
      component: UploadassessmentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Site Audit Report', url: '/standardcourseapproval/siteaudit',href:'true' },
          { title: 'Staff View', url: '/standardcourseapproval/uploadassessment' ,last:'true'}
        ]
      },
    },
    {
      path: 'viewassessment',
      component: ViewassessmentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Site Audit Report', url: '/standardcourseapproval/siteaudit',href:'true' },
          { title: 'Staff View', url: '/standardcourseapproval/viewassessment',last:'true' }
        ]
      },
    },
      {
      path: 'staffview',
      component: StaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'View Certification Form', url: '/standardcourseapproval/desktopreview',href:'true' },
          { title: 'Staff View', url: '/standardcourseapproval/staffview',last:'true' }
        ]
      },
    },
    {
      path: 'siteauditapproval',
      component: ScsiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Approve Site Audit Report',
        urls: [
          { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
          { title: 'Approve Site Audit Report', url: '/standardcourseapproval/siteauditapproval',last:'true' }
        ]
      },
    },
   
  ],
 
},];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StandardcourseapprovalRoutingModule { }
