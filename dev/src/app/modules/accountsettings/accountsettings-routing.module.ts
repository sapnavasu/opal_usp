import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { AccountsettingsComponent } from './accountsettings.component';
import { TwofactorauthComponent } from './twofactorauth/twofactorauth.component';
import { ChangepasswordbackendComponent } from './changepasswordbackend/changepasswordbackend.component';
const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'home',
        component: AccountsettingsComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'Account Settings',
          urls: [
            { title: 'Account Settings', url: '/accountsettings/home' }
          ]
        },
      },
      {
        path: 'twofactorauth',
        component: TwofactorauthComponent,
         data: {
          title: 'Account Settings',
          urls: [
            { title: 'Edit - Account Information', 
              url: '/accountsettings/twofactorauth',
              breadcrumb: 'Invited User'
          }
          ]
            },
      },
      {
        path: 'changepassword',
        component: ChangepasswordbackendComponent,
         data: {
          title: 'Account Setting',
         
            },
      }
    ],
   
  },
 
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AccountsettingsRoutingModule { }
