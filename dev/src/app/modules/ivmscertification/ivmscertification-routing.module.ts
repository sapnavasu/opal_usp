import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { IvmscentrelistComponent } from './ivmscentrelist/ivmscentrelist.component';
import { IvmstabComponent } from './ivmscentrelist/ivmstab/ivmstab.component';
import { CompanyivmsComponent } from './companyivms/companyivms.component';
import { OperatorformComponent } from './operatorform/operatorform.component';
import { StaffformComponent } from './staffform/staffform.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'ivmsdevice',
      component: IvmscentrelistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'IVMS Device Certification Form',
        urls: [
          { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice' }
        ]
      },
  },
  
  {
    path: 'ivmsdevice/:type',
    component: IvmstabComponent,
    canActivate: [AuthGuard],
    data: {
      title: 'IVMS Device Certification Form',
      urls: [
        { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice' },
        { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice/:type' }
      ]
    },
  },
  {
    path: 'company',
    component: CompanyivmsComponent,
    canActivate: [AuthGuard],
    data: {
      title: 'IVMS Device Certification Form',
      urls: [
        { title: 'Company Details', url: ' ' }
      ]
    },
  },
  {
    path: 'vendor',
    component: CompanyivmsComponent,
    canActivate: [AuthGuard],
    data: {
      title: 'IVMS Device Certification Form',
      urls: [
        { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice' },
        { title: 'IVMS Vendor Information', url: ' ' }
      ]
    },
  },
  {
    path: 'compdocument',
    component: CompanyivmsComponent,
    canActivate: [AuthGuard],
    data: {
      title: 'IVMS Device Certification Form',
      urls: [
        { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice' },
        { title: 'Company Documents Required', url: ' ' }
      ]
    },
  },
  {
    path: 'operatorform',
    component: OperatorformComponent,
    canActivate: [AuthGuard],
    data: {
      title: 'IVMS Device Certification Form',
      urls: [
        { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice' },
        { title: 'Add Operator Contract Details', url: ' ' }
      ]
    },
  },
  {
    path: 'ivmsdevice/:type/ivmsstaff',
    component: StaffformComponent,
    canActivate: [AuthGuard],
    data: {
      title: 'IVMS Device Certification Form',
      urls: [
        { title: 'IVMS Device Certification Form', url: '/ivmscertification/ivmsdevice' },
        { title: 'Add Operator Contract Details', url: ' ' }
      ]
    },
  },
  ]
}]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class IvmscertificationRoutingModule { }
