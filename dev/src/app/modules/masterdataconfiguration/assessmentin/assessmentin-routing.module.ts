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
        title: 'Assessment In',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Assessment In', url: '/configuration/masterdataconfiguration/assessmentin' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: EditComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Assessment In',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Assessment In', url: '/configuration/masterdataconfiguration/assessmentin' },
          { title: 'Update Assessment In', url: '/configuration/masterdataconfiguration/assessmentin/edit/:id' }
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
export class AssessmentinRoutingModule { }
