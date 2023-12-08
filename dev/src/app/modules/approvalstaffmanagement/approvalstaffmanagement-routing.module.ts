import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { StafftrainingComponent } from './stafftraining/stafftraining.component';
import { StafftechnicalComponent } from './stafftechnical/stafftechnical.component';
import { StaffviewtrainingComponent } from './stafftraining/staffviewtraining/staffviewtraining.component';
import { StaffviewtechnicalComponent } from './stafftechnical/staffviewtechnical/staffviewtechnical.component';
import { TransferstaffComponent } from './stafftraining/transferstaff/transferstaff.component';
import { TarnsfertechnicalComponent } from './stafftechnical/tarnsfertechnical/tarnsfertechnical.component';
import { AssessoravailabilityComponent } from './assessoravailability/assessoravailability.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'trainingcentre',
      component: StafftrainingComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Training Centre Staff',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
        ]
      },
    },
    {
      path: 'technicalcentre',
      component: StafftechnicalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Technical Evaluation Centre',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/approvalstaffmanagement/technicalcentre' },
        ]
      },
    },
    {
      path: 'trainingcentreview',
      component: StaffviewtrainingComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Staff Details',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'View Staff Details', url: '/approvalstaffmanagement/trainingcentreview' },

        ]
      },
    },
    {
      path: 'trainingavailability',
      component: StaffviewtrainingComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Availability',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'View Availability', url: '/approvalstaffmanagement/trainingavailability',last:true },

        ]
      },
    },
    {
      path: 'technicalviewschedule',
      component: StaffviewtechnicalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Schedule',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/approvalstaffmanagement/technicalcentre' },
          { title: 'View Schedule', url: '/approvalstaffmanagement/technicalviewschedule' }
        ]
      },
    },
  
    {
      path: 'technicalstaffview',
      component: StaffviewtechnicalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Staff Details',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/approvalstaffmanagement/technicalcentre' },
          { title: 'View Staff Details', url: '/approvalstaffmanagement/technicalstaffview' }

        ]
      },
    },
    {
      path: 'transferstaff',
      component: TransferstaffComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Transfer Staff Within Centre',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'Transfer Staff Within Centre', url: '/approvalstaffmanagement/transferstaff' }

        ]
      },
    },
    {
      path: 'transferstafftech',
      component: TarnsfertechnicalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Transfer Staff Within Centre',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/approvalstaffmanagement/technicalcentre' },
          { title: 'Transfer Staff Within Centre', url: '/approvalstaffmanagement/transferstafftech' }

        ]
      },
    },
    {
      path: 'availabilty',
      component: AssessoravailabilityComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Staff Availability',
        urls: [
          { title: 'Training Centre Staff', url: '/approvalstaffmanagement/trainingcentre' },
          { title: 'Schedule Assessor Availability', url: '/approvalstaffmanagement/availabilty' }

        ]
      },
    },
  ]
}
]


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ApprovalstaffmanagementRoutingModule { }
