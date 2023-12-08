import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ManagerolesComponent } from './manageroles/manageroles.component';
import { ManageusersComponent } from './manageusers/manageusers.component';
import { AddrolesComponent } from './addroles/addroles.component';
import { AddusersComponent } from './addusers/addusers.component';
import { ViewrolesComponent } from './viewroles/viewroles.component';
import { ViewusersComponent } from './viewusers/viewusers.component';
import { AuthGuard } from '@app/auth/auth.guard';

const routes: Routes = [
  {
    path:'',
    children: [
      {
        path: 'manageroles',
        component: AddrolesComponent,
        data: {
          title: 'Manage Roles',
          formid:1,
          urls: [
            { title: 'Manage Roles', url: '/manageroles' }
          ]
        },canActivate: [AuthGuard]
      },
      {
        path: 'manageusers',
        component: AddrolesComponent,
        data:{
          title: 'Manage Users',
          urls: [
            { title: 'Manage Users', url: '/manageusers' }
          ]
        },canActivate: [AuthGuard]
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class NewenterpriseadminRoutingModule { }
