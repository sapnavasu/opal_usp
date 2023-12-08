import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';

import { GradeconfigurationComponent } from './gradeconfiguration/gradeconfiguration.component';
import { EditgradeconfigurationComponent } from './editgradeconfiguration/editgradeconfiguration.component';
import { ViewlogComponent } from './viewlog/viewlog.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'gradelist',
      component: GradeconfigurationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Grade Configuration',
        urls: [
          { title: 'Configuration', url: '' },
          { title: 'Grade Configuration', url: '/gradeconfiguration/gradelist' }
        ]
      },
    },
    {
      path: 'editgrade/:id',
      component: EditgradeconfigurationComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Grade Configuration',
        urls: [
          { title: 'Configuration', url: '' },
          { title: 'Grade Configuration', url: '/gradeconfiguration/gradelist' },
          { title: 'Edit Grade Configuration', url: '/gradeconfiguration/editgrade/:id' }
        ]
      },
    },
    {
      path: 'viewlog/:id',
      component: ViewlogComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Log',
        urls: [
          { title: 'Configuration', url: '' },
          { title: 'Grade Configuration', url: '/gradeconfiguration/gradelist' },
          { title: 'View Log', url: '/gradeconfiguration/viewlog/:id' }
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
export class GradeconfigurationRoutingModule { }
