import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { ProfilecreationlistComponent } from './profilecreationlist/profilecreationlist.component';
import { ProfilelistviewComponent } from './profilelistview/profilelistview.component';
const routes: Routes = [
  {
    path: '',
    children: [
      
      {
        path: 'profilecreationlist',
        component: ProfilecreationlistComponent,
        canActivate:[AuthGuard],
         data:{
          title: 'User Profile | OPAL',
        },
      },
      {
        path: 'profilelistview',
        component: ProfilelistviewComponent,
        canActivate:[AuthGuard],
        data:{
          title: 'User Profile | OPAL',
        },
      },
      {
        path: 'profilelistview/:id',
        component: ProfilelistviewComponent,
        canActivate:[AuthGuard]
      },
     
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ProfilecreationRoutingModule { }
