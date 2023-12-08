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
        title: 'Education Level',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Education Level', url: '/configuration/masterdataconfiguration/educationlevel' }
        ]
      },
    },
    {
      path: 'add',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Education Level',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Education Level', url: '/configuration/masterdataconfiguration/educationlevel' },
          { title: 'Add Education Level', url: '/configuration/masterdataconfiguration/educationlevel/add' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Education Level',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Education Level', url: '/configuration/masterdataconfiguration/educationlevel' },
          { title: 'Update Education Level', url: '/configuration/masterdataconfiguration/educationlevel/edit/:id' }
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
export class EducationlevelRoutingModule { }
