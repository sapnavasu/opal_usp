import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TrainingcentreComponent } from './trainingcentre/trainingcentre.component';
import { AuthGuard } from '@app/auth/auth.guard';
import { TrainingstaffviewComponent } from './trainingcentre/trainingstaffview/trainingstaffview.component';
import { TechnicalcentreComponent } from './technicalcentre/technicalcentre.component';
import { TechnicalstaffviewComponent } from './technicalcentre/technicalstaffview/technicalstaffview.component';
import { StaffinfocardComponent } from './staffinfocard/staffinfocard.component';
import { CalendarviewComponent } from './calendarview/calendarview.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'trainingcentre',
      component: TrainingcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Staff',
        urls: [
          { title: 'Training Centre Staff', url: '/staffmanagement/trainingcentre' },
        ]
      },
    },
    {
      path: 'trainingcentreview',
      component: TrainingstaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Staff Details',
        urls: [
          { title: 'Training Centre Staff', url: '/staffmanagement/trainingcentre' },
          { title: 'View Staff Details', url: '/staffmanagement/trainingcentreview' },

        ]
      },
    },
    {
      path: 'trainingavailability',
      component: TrainingstaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Availabilability',
        urls: [
          { title: 'Training Centre Staff', url: '/staffmanagement/trainingcentre' },
          { title: 'View Availabilability', url: '/staffmanagement/trainingavailability' },

        ]
      },
    },
   
    {
      path: 'technicalcentre',
      component: TechnicalcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Technical Evaluation Centre',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/staffmanagement/technicalcentre' },
        ]
      },
    },
    {
      path: 'technicalviewschedule',
      component: TechnicalstaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Schedule',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/staffmanagement/technicalcentre' },
          { title: 'View Schedule', url: '/staffmanagement/technicalviewschedule' }
        ]
      },
    },
  
    {
      path: 'technicalstaffview',
      component: TechnicalstaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Staff Details',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/staffmanagement/technicalcentre' },
          { title: 'View Staff Details', url: '/staffmanagement/technicalstaffview' }

        ]
      },
    },
    {
      path: 'staffinfo',
      component: StaffinfocardComponent,
      canActivate: [AuthGuard],
    },
    {
      path: 'calendarview',
      component: CalendarviewComponent,
      canActivate: [AuthGuard],
    },
  ]
}
]


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StaffmanagementRoutingModule { }
