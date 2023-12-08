import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { ManagebasemoduleComponent } from './basemodule/managebasemodule/managebasemodule.component';
import { ManagemenuComponent } from './menumaster/managemenu/managemenu.component';
import { ManagestkholderaccessComponent } from './stkholderaccess/managestkholderaccess/managestkholderaccess.component';
import { StkholdregComponent } from './stkholdreg/stkholdreg.component';


const routes: Routes = [
  {
    path:'manage-base-module',
    component:ManagebasemoduleComponent,
    canActivate: [AuthGuard],
    data:{
      accessmodule:[91,92],
      title: 'Base Module Master',
      breadcrumb:'Manage Base Module'
    }
  },
  {
    path: 'managestkholdaccess',
    component: ManagestkholderaccessComponent,
    canActivate: [AuthGuard],
    data:{
      accessmodule:[93],
      title: 'Stakeholder Access',
      breadcrumb:'Manage Stakeholder Access'
    }
  },
  {
    path: 'stkholdreg',
    component: StkholdregComponent,
    data:{
      title: 'Stakeholder Registration',
      breadcrumb:'Stakeholder Registration'
    }
  },
  {
    path:'manage-menu',
    component:ManagemenuComponent,
    data:{
      title: 'Menu Master',
      breadcrumb:'Manage Menu'
    }
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AccessRoutingModule { }
