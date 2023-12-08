import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ViewlearnersComponent } from './viewlearners/viewlearners.component';
import { AuthGuard } from '@app/auth/auth.guard';
import { AssessmentreportComponent } from './assessmentreport/assessmentreport.component';
import { ViewandapproveComponent } from './viewandapprove/viewandapprove.component';
import { ChangeassessorComponent } from './changeassessor/changeassessor.component';
import { LearnerfeedbackComponent } from './learnerfeedback/learnerfeedback.component';
import { LearnerfeedbacktableComponent } from './learnerfeedbacktable/learnerfeedbacktable.component';
import { LearnerfeedbackviewComponent } from './learnerfeedbackview/learnerfeedbackview.component';
import { LearnerreglistComponent } from './learnerreglist/learnerreglist.component';
import { LearnerregstrnComponent } from './learnerregstrn/learnerregstrn.component';
const routes: Routes = [
  {path:'', 
  children: [
    {
      path:'assessmentreport/:id',
      component:AssessmentreportComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Assessment Report',
        urls: [
          {
            title:'Batch Management', url:'/batchindex/batchgridlisting'
          },
          // {
          //   title:'View Learners', url:'/candidatemanagement/viewlearner/:batch'
          // },
          {
            title:'Assessment Report', url:'/assessmentreport/assessmentreport'
          }
        ],
      },
    },
    {
     path:'viewandapprove/:id/:type',
     component:ViewandapproveComponent,
     canActivate:[AuthGuard],
     data: {
       title:'Assessment Report Approval',
       urls: [
         { title:'Batch Management', url:'/batchindex/batchgridlisting'},
         { title:'View & Approve Assessment Report', url:'/assessmentreport/viewandapprove/:id/:type'},
       ],
     },
   },
    {
      path:'changeassessor/:batch/:req', 
      component: ChangeassessorComponent, 
      canActivate: [AuthGuard],
      data: {
        title: 'Assessor Change Request to OPAL USP',
        urls: [
          { title:'Batch Management', url:'/batchindex/batchgridlisting'},
          { title:'Change Assessor', url:'/assessmentreport/changeassessor/:batch/:req'}
        ],
      }
    },
    {
      path:'learnerfeedback/:id',
      component:LearnerfeedbackComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Learner Feedback',
        urls: [
          {
            title:'Learner Feedback', url:'/learnerfeedback/:id'
          }
        ]
      },
    },
    {
      path:'learnerfeedbacklist',
      component:LearnerfeedbacktableComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Learner Feedback',
        urls: [
          {
            title:'Learner Feedback', url:'/learnerfeedbacklist'
          }
        ]
      },
    },
    {
      path:'learnerfeedbackview/:id',
      component:LearnerfeedbackviewComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Learner Feedback View',
        urls: [
          {
            title:'Learner Feedback View', url:'/learnerfeedbackview/:id'
          }
        ]
      },
    },{
      path:'learnerregistrationlist',
      component:LearnerreglistComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Learner Registration',
        urls: [
          {
            title:'Learner Registration', url:'/learnerregistrationlist'
          }
        ]
      },
    },
    {
      path:'learnerregistration',
      component:LearnerregstrnComponent,
      canActivate:[AuthGuard],
      data: {
        title:'Learner Registration',
        urls: [
          {
            title:'Learner Registration', url:'/learnerregistration'
          }
        ]
      },
    },
  ], data: {
    title: 'Batch Management',
    breadcrumb: 'Batch Management'
  }}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AssessmentreportRoutingModule { }
