import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LearnerslistComponent } from './learnerslist/learnerslist.component';
import { AuthGuard } from '@app/auth/auth.guard';
import { LearnerRegisterComponent } from './learner-register/learner-register.component';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'learnerlist', component: LearnerslistComponent, canActivate: [AuthGuard],
        data: {
          title: 'View Learners 1',
          breadcrumb: 'View Learners',
          urls: [
            { title: 'View Learners', url: '/candidatemanagement/learnerlist' }
          ]
        }
      },
      // {
      //   path: 'learnerlist/:batch', component: LearnerslistComponent, canActivate: [AuthGuard],
      //   data: {
      //     title: 'View Learners',
      //     urls: [
      //       { title: 'View Learners', url: '/candidatemanagement/learnerlist' },
      //     ]
      //   }
      // },

      {
        path:'viewlearner/:batch',
        component:LearnerslistComponent,
        canActivate:[AuthGuard],
        data: {
          title:'View Learners',
          urls: [
            { title:'Batch Management', url:'/batchindex/batchgridlisting'},
            {title:'View Learners', url:'/candidatemanagement/viewlearner/:batch'}
          ]
        },
      },
      {
        path: 'learner-register/:batch', component: LearnerRegisterComponent, canActivate: [AuthGuard],
        data: {
          title: 'Learner Registration',
          urls: [
            { title:'Batch Management', url:'/batchindex/batchgridlisting'},
            { title: 'Learner Registration', url: '/candidatemanagement/learner-register/:batch' },
          ]
        }
        
      },
      {
        path: 'learner-register/:batch/:learner', component: LearnerRegisterComponent, canActivate: [AuthGuard],
        data: {
          title: 'Learner Registration',
          urls: [
            { title:'Batch Management', url:'/batchindex/batchgridlisting'},
            { title: 'Learner Registration', url: '/candidatemanagement/learner-register/:batch/:learner' },
          ]
        }
        
      },
      {
        path: 'learner-detail/:id', component: LearnerRegisterComponent, canActivate: [AuthGuard],
        data: {
          title: 'Learners Detail',
          breadcrumb: 'Learners Detail'
        },
        
      },

    ], data: {
      title: 'Batch Management',
      breadcrumb: 'Batch Management'
    }
  }
];


@NgModule({
  declarations: [],
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CandidatemanagementRoutingModule { }
