import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { ApprovallistComponent } from './approvallist/approvallist.component';
import { CompanyinfoivmsComponent } from './companyinfoivms/companyinfoivms.component';
import { IvmsdesktopComponent } from './ivmsdesktop/ivmsdesktop.component';
import { CompanydocumentivmsComponent } from './companydocumentivms/companydocumentivms.component';
import { IvmsoperatorComponent } from './ivmsoperator/ivmsoperator.component';
import { StaffviewComponent } from './staffview/staffview.component';
import { IvmdsiteauditComponent } from './ivmdsiteaudit/ivmdsiteaudit.component';

const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'approvallist',
      component: ApprovallistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'IVMS Device Certification Approval',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' }
        ]
      },
  },
    {
      path: 'companyinfo',
      component: CompanyinfoivmsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Desktop Review',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/approvallist' }
        ]
      },
  },
    {
      path: 'approvallist/desktopivms',
      component: IvmsdesktopComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Desktop Review',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'vendorivms',
      component: IvmsdesktopComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Desktop Review',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'companydocument',
      component: CompanydocumentivmsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Desktop Review',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'ivmsoperator',
      component: IvmsoperatorComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Desktop Review',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'ivmsdevicemodel',
      component: IvmsdesktopComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Desktop Review',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'desktopivms/staffviewevaluate',
      component: StaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View & Evaluate',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' },
          { title: 'Staff', url: '/ivmsapproval/desktopivms' },
          { title: 'View & Evaluate', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'desktopivms/staffview',
      component: StaffviewComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Staff View',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Desktop Review', url: '/ivmsapproval/desktopivms' },
          { title: 'Staff', url: '/ivmsapproval/desktopivms' },
          { title: 'Staff View', url: '/ivmsapproval/desktopivms' }
        ]
      },
  },
    {
      path: 'approvallist/siteaudit',
      component: IvmdsiteauditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Site Audit',
        urls: [
          { title: 'Approval Management', url: '/ivmsapproval/approval' },
          { title: 'IVMS Device Certification Approval', url: '/ivmsapproval/approvallist' },
          { title: 'Site Audit', url: '' }
        ]
      },
  },
]
}]
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class IvmsapprovalRoutingModule { }
