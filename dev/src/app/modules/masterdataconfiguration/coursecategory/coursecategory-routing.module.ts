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
        title: 'Course Categories',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Course Categories', url: '/configuration/masterdataconfiguration/coursecategory' }
        ]
      },
    },
    {
      path: 'add',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Course Category',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Course Categories', url: '/configuration/masterdataconfiguration/coursecategory' },
          { title: 'Add Course Category', url: '/configuration/masterdataconfiguration/coursecategory/add' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Course Category',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Course Categories', url: '/configuration/masterdataconfiguration/coursecategory' },
          { title: 'Update Course Category', url: '/configuration/masterdataconfiguration/coursecategory/edit/:id' }
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
export class CoursecategoryRoutingModule { }
