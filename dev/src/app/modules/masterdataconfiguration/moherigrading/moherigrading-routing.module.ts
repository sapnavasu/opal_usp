import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AuthGuard } from '@app/auth/auth.guard';

import { GridlistComponent } from './gridlist/gridlist.component';
import { AddComponent } from './add/add.component';

const routes: Routes = [{
  path: '',
  children: [
    {
      path: '',
      component: GridlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'MOHERI Grading',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'MOHERI Grading', url: '/configuration/masterdataconfiguration/moherigrading' }
        ]
      },
    },
    {
      path: 'add',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add MOHERI Grading',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'MOHERI Grading', url: '/configuration/masterdataconfiguration/moherigrading' },
          { title: 'Add MOHERI Grading', url: '/configuration/masterdataconfiguration/moherigrading/add' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update MOHERI Grading',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'MOHERI Grading', url: '/configuration/masterdataconfiguration/moherigrading' },
          { title: 'Update MOHERI Grading', url: '/configuration/masterdataconfiguration/moherigrading/edit/:id' }
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
export class MoherigradingRoutingModule { }
