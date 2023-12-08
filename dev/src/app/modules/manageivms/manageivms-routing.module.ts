import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { IvmsinstallationlistComponent } from './ivmsinstallationlist/ivmsinstallationlist.component';
import { IvmsViewComponent } from './ivms-view/ivms-view.component';
import { IvmsImportViewComponent } from './ivms-import-view/ivms-import-view.component';
import { DeviceregistrationComponent } from './deviceregistration/deviceregistration.component';
import { UploadreportComponent } from './uploadreport/uploadreport.component';
import { IvmsrenewComponent } from './ivmsrenew/ivmsrenew.component';
import { ViewandapproveComponent } from './viewandapprove/viewandapprove.component';

const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'ivmslist',
      component: IvmsinstallationlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Manage IVMS Device Installed Vehicles',
        urls: [
          { title: 'Manage IVMS Device Installed Vehicles', url: '/manageivms/ivmslist' },
        ]
      },
    },
    {
      path: 'ivmscentrelist',
      component: IvmsinstallationlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'IVMS Device Installation and Approval',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
        ]
      },
    },
    {
      path: 'ivmsdevicereg',
      component: DeviceregistrationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'IVMS Device Installation and Approval',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'Register New Vehicle', url: '/manageivms/ivmscentrelist' }
        ]
      },
    },
    {
      path: 'view',
      component: IvmsViewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Import Vehicle Details',
        urls: [
          { title: 'Manage IVMS Device Installed Vehicles', url: '/manageivms/ivmslist' },
          { title: 'Import Vehicle Details', url: '/manageivms/view' },
        ]
      },
    },
    {
      path: 'importexcel',
      component: IvmsImportViewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Import Vehicle Details',
        urls: [
          { title: 'Manage IVMS Device Installed Vehicles', url: '/manageivms/ivmslist' },
          { title: 'Import Vehicle Details', url: '/manageivms/import-view' },
        ]
      },
    },
    {
      path: 'uploadreports/:dev_id',
      component: UploadreportComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Upload Installation Report',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'Upload Installation Report', url: '/manageivms/uploadreports' },
        ]
      },
    },
    {
      path: 'updatereports/:dev_id',
      component: UploadreportComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Installation Report',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'Update Installation Report', url: '/manageivms/updatereports' },
        ]
      },
    },
    {
      path: 'ivmsrenewnow/:dev_id',
      component: IvmsrenewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Renew Now',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'Renew Now', url: '' },
        ]
      },
    },
    {
      path: 'viewandapproved/:dev_id',
      component: ViewandapproveComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View & Approve',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'View & Approve', url: '' },
        ]
      },
    },
    {
      path: 'viewapprove/:dev_id',
      component: ViewandapproveComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Details',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'View Details', url: '' },
        ]
      },
    },
    {
      path: 'sheducledevice/:dev_id',
      component: DeviceregistrationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Schedule for Device Replacement',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'Schedule for Device Replacement', url: '' },
        ]
      },
    },
    {
      path: 'editivmsvehicle/:dev_id',
      component: DeviceregistrationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Vehicle Details',
        urls: [
          { title: 'IVMS Device Installation and Approval', url: '/manageivms/ivmscentrelist' },
          { title: 'Edit Vehicle Details', url: '' },
        ]
      },
    },
  ]
}]
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ManageivmsRoutingModule { }
