import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { BusinessunitsComponent } from './businessunits/businessunits.component';
import { DepartmentmanagementComponent } from './departmentmanagement/departmentmanagement.component';
import { DropdownelementcardComponent } from './dropdownelementcard/dropdownelementcard.component';
import { InviteusermanagementComponent } from './inviteusermanagement/inviteusermanagement.component';
import { LandingpageComponent } from './landingpage/landingpage.component';
import { UsermanagementComponent } from './usermanagement/usermanagement.component';
const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'usermanagement',
        component: UsermanagementComponent,
        data:{
          accessmodule:[47],
          title: 'Enterprise Admin',
          urls: [
            { title: 'Enterprise Admin', url: '/enterpriseadmin/landingpage' },
            { title: 'Users'}
          ]
        },
        canActivate:[AuthGuard]
      },
      {
        path: 'usermanagement/:redirectFrom',
        component: UsermanagementComponent,
        data:{
          accessmodule:[47],
          title: 'Enterprise Admin',
          //breadcrumb: 'User Management',
          urls: [
            { title: 'Enterprise Admin', url: '/enterpriseadmin/landingpage' },
            { title: 'Department'}
          ]
        }
      },
      {
        path: 'department',
        component: DepartmentmanagementComponent,
        data:{
          accessmodule:[46],
          title: 'Enterprise Admin',
          urls: [
            { title: 'Enterprise Admin', url: '/enterpriseadmin/landingpage' },
            { title: 'Department'}
          ]
        },
        canActivate:[AuthGuard]
      },
      {
        path: 'divisions',
        component: BusinessunitsComponent,
        data:{
          accessmodule:[45],
          title: 'Enterprise Admin | OPAL',
          urls: [
            { title: 'Enterprise Admin', url: '/enterpriseadmin/landingpage' },
            { title: 'Divisions'}
          ]
        },
        canActivate:[AuthGuard]
      },
      {
        path: 'inviteduser',
        component: InviteusermanagementComponent,
        data:{
          accessmodule:[47],
          title: 'Enterprise Admin | OPAL',
          breadcrumb: 'Invited User'
        },
        canActivate:[AuthGuard]
      },
    
      {
        path: 'landingpage',
        component: LandingpageComponent,
        canActivate:[AuthGuard],
        data:{
          title: 'Enterprise Admin',
          urls: [
            { title: 'Enterprise Admin', url: '/enterpriseadmin/landingpage' },
            { title: 'Introduction'}
          ]
        },
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class EnterpriseadminRoutingModule { }
