import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ApprovechangeComponent } from './approvechange/approvechange.component';
import { InviteexpiredComponent } from './inviteexpired/inviteexpired.component';
import { RegisterationconfirmedComponent } from './registerationconfirmed/registerationconfirmed.component';
const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'approvechange',
        component: ApprovechangeComponent,
      },
      {
        path: 'inviteexpired',
        component: InviteexpiredComponent,
      },
      {
        path: 'regisconfirm',
        component: RegisterationconfirmedComponent,
      },
     
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ThankyouRoutingModule { }
