import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AuthGuard } from '@app/auth/auth.guard';


import { GridlistComponent } from './gridlist/gridlist.component';
import { EditComponent } from './edit/edit.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: '',
      component: GridlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Fee Subscription',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Fee Subscription', url: '/configuration/masterdataconfiguration/feesubscribtion' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: EditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Fee Subscription',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Fee Subscription', url: '/configuration/masterdataconfiguration/feesubscribtion' },
          { title: 'Update Fee Subscription', url: '/configuration/masterdataconfiguration/feesubscribtion/edit/:id' }
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
export class FeesubscriptionRoutingModule { }
