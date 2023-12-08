import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { MaincentreComponent } from './maincentre/maincentre.component';
import { TrainingcentremanagementComponent } from './trainingcentremanagement.component';
import { BranchcentreComponent } from './branchcentre/branchcentre.component';
import { CourseviewComponent } from './courseview/courseview.component';
import { SchedulesiteComponent } from './schedulesite/schedulesite.component';
import { ChangeanotherComponent } from './changeanother/changeanother.component';
import { ViewmaincentreComponent } from '@app/modules/trainingcentremanagement/viewmaincentre/viewmaincentre.component';
import { ViewrascentreComponent } from './viewrascentre/viewrascentre.component';
const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'home',
      component: TrainingcentremanagementComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'trainingcentremanagement',
        urls: [
          { title: 'trainingcentremanagement', url: '/trainingcentremanagement/home',last:'true' }
        ]
      },
    },
    {
      path: 'maincentre',
      component: MaincentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Certification Form (Main Office)',
        urls: [
          { title: 'Training Centre Certification Form (Main Office)', url: '/trainingcentremanagement/maincentre',last:'true' },
          // { title: 'Company Details', url: '/trainingcentremanagement/maincentre' }
        ]
      },
    },
    {
      path: 'maincentrepay',
      component: MaincentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Certification Form (Main Office)',
        urls: [
          { title: 'Training Centre Certification Form (Main Office)', url: '/trainingcentremanagement/maincentre' },
          // { title: 'Company Details', url: '/trainingcentremanagement/maincentre' }
        ]
      },
    },
    {
      path: 'rascentre',
      component: MaincentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Inspection Centre Certification Form (Primary Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Primary Office Certification)', url: '/trainingcentremanagement/rascentre',last:'true' },
          // { title: 'Company Details', url: '/trainingcentremanagement/maincentre' }
        ]
      },
    },
    {
      path: 'rascentrepay',
      component: MaincentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Inspection Centre Certification Form (Primary Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Primary Office Certification)', url: '/trainingcentremanagement/rascentre',last:'true' },
          // { title: 'Company Details', url: '/trainingcentremanagement/maincentre' }
        ]
      },
    },
    {
      path: 'branchcentre',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre',last:'true' }
        ]
      },
    },
   
    {
      path: 'branchcentrepay',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre',last:'true' }
        ]
      },
    },
    {
      path: 'branchcentre/:pkValue',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/:pkValue',last:'true' }
        ]
      },
    },
    {
      path: 'branchcentrefromview/:pkValue',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre',last:'true' },
          { title: 'Training Centre Certification Form view', url: '/trainingcentremanagement/branchcentrefromview',last:'true' }
        ]
      },
    },
    {
      path: 'rasbranchcentre',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: '/trainingcentremanagement/rasbranchcentre' ,last:'true' }
        ]
      },
    },
    {
      path: 'rasbranchcentrepay',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: '/trainingcentremanagement/rasbranchcentre',last:'true' }
        ]
      },
    },
    {
      path: 'rasbranchcentre/:pkValue',
      component: BranchcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: '/trainingcentremanagement/rasbranchcentre/:pkValue',last:'true' }
        ]
      },
    },
    {
      path: 'courseview/:id/:type/:viewtype',
      component: CourseviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype',last:'true' }
        ]
      },
    },
    {
      path: 'courseviewras/:id/:type/:viewtype/:assessmenttype/:fromview',
      component: CourseviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Staff View', url: '/trainingcentremanagement/courseviewras/:id/:type/:viewtype/:assessmenttype/:fromview',last:'true' }
        ]
      },
    },
    {
      path: 'courseviewrassite/:id/:type/:viewtype/:assessmenttype/:fromview',
      component: CourseviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View', url: '/trainingcentremanagement/courseview/:id/:type/:viewtype',
        urls: [
          { title: 'RAS Technical Evaluation Centre Approval', },
          { title: 'View Site Audit Report', url: '/centrecertification/desktopreview',href:'true'},
          { title: 'Staff View', url: '/trainingcentremanagement/courseviewrassite/:id/:type/:viewtype/:assessmenttype/:fromview',last:'true' }
        ]
      },
    },
    {
      path:'schedulesite',
      component:SchedulesiteComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Schedule site audit',
        urls: [
          {
            title:'Schedule site audit', url:'/trainingcentremanagement/schedulesite',last:'true'
          }
        ]
      },
    },
    {
      path:'changeanother',
      component:ChangeanotherComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Change Another staff',
        urls: [
          {
            title:'Change Another staff', url:'/trainingcentremanagement/changeanother',last:'true'
          }
        ]
      },
    },
    {
      path:'ViewMaincentre',
      component:ViewmaincentreComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Profile View',
        urls: [
          {
            title:'Profile View', url:'/trainingcentremanagement/viewmaincentre',last:'true'
          }
        ]
      },
    },
    {
      path: 'courseviewtab/:id/:type/:viewtype',
      component: CourseviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Course View', url: '/trainingcentremanagement/courseviewtab/:id/:type/:viewtype',
        urls: [
          { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
          { title: 'View Certification Form', url: '/centrecertification/desktopreview'},
          { title: 'Course View', url: '/trainingcentremanagement/courseviewrassite/:id/:type/:viewtype',last:'true' }
        ]
      },
    },
    {
      path: 'viewras',
      component: ViewrascentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Profile View', url: '/vehiclemanagement/viewras',
        urls: [
          { title: 'Profile View', url: '/vehiclemanagement/viewras'},
        ]
      },
    },
  ],
 
},];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TrainingcentremanagementRoutingModule { }
