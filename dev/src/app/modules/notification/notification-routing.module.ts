import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { NotificationComponent } from './notification/notification.component';


const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'notification',
        canActivate: [AuthGuard],
        component: NotificationComponent,
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class NotificationRoutingModule { }
