import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { StandardcoursesComponent } from './standardcourses.component';
import { AssessorComponent } from './assessor/assessor.component';
const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'home',
      component: StandardcoursesComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home' },
          // { title: ' ', url: '/standardcourse/home' }
        ]
      },
    },
    {
      path: 'assessoravailability',
      component: AssessorComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Schedule Assessor Availability',
        urls: [
          { title: 'Schedule Assessor Availability', url: '/standardcourse/assessoravailability' },
          // { title: ' ', url: '/standardcourse/home' }
        ]
      },
    },
    {
      path: 'assessoravailability/add',
      component: AssessorComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Staff Availability',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'Add Staff Availability', url: '',last:true },

          // { title: ' ', url: '/standardcourse/home' }
        ]
      },
    },
    {
      path: 'assessoravailability/edit',
      component: AssessorComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Staff Availability',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'Edit Staff Availability', url: '',last:true },

          // { title: ' ', url: '/standardcourse/home' }
        ]
      },
    },
    {
      path: 'assessoravailability/edita',
      component: AssessorComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Staff Availability',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'View Availability', url: '/approvalstaffmanagement/trainingavailability',id:true },
          { title: 'Edit Staff Availability', url: '' ,last:true},

          // { title: ' ', url: '/standardcourse/home' }
        ]
      },
    },
  ],
 
},];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StandardcoursesRoutingModule { }
