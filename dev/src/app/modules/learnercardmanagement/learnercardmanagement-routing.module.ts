import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { LearnercardgridlistComponent } from './learnercardgridlist/learnercardgridlist.component';
import { LearnercardregComponent } from './learnercardreg/learnercardreg.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'learnergridlist',
      component: LearnercardgridlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Learner Card Log',
        urls: [
          { title: 'Learner Card Log', url: '/learnercardmanagement/learnergridlist' }
        ]
      },
    },
    // add 
    {
      path: 'learnercardreg/add/:id',
      component: LearnercardregComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Learner Information',
        urls: [
          { title: 'Learner Card Log', url: '/learnercardmanagement/learnergridlist' },
          { title: 'Add Learner Information', url: '/learnercardmanagement/learnercardreg' }
        ]
      },
    },
    {
      path: 'learnercardreg/edit/:id/:staffid/:courseid',
      component: LearnercardregComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Learner Information',
        urls: [
          { title: 'Learner Card Log', url: '/learnercardmanagement/learnergridlist' },
          { title: 'Edit Learner Information', url: '/learnercardmanagement/learnercardreg' }
        ]
      },
    },
    {
      path: 'learnercardreg/view/:id/:staffid/:courseid',
      component: LearnercardregComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Learner Information',
        urls: [
          { title: 'Learner Card Log', url: '/learnercardmanagement/learnergridlist' },
          { title: 'View Learner Information', url: '/learnercardmanagement/learnercardreg' }
        ]
      },
    }
  ]
 
},];
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class LearnercardmanagementRoutingModule { }
