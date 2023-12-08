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
        title: 'Vehicle Sub Categories',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Vehicle Sub Categories', url: '/configuration/masterdataconfiguration/vehiclesubcategories' }
        ]
      },
    },
    {
      path: 'add',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Vehicle Sub Categories',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Vehicle Sub Categories', url: '/configuration/masterdataconfiguration/vehiclesubcategories' },
          { title: 'Add Vehicle Sub Categories', url: '/configuration/masterdataconfiguration/vehiclesubcategories/add' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Vehicle Sub Categories',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Vehicle Sub Categories', url: '/configuration/masterdataconfiguration/vehiclesubcategories' },
          { title: 'Update Vehicle Sub Categories', url: '/configuration/masterdataconfiguration/vehiclesubcategories/edit/:id' }
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
export class VehiclesubcategoriesRoutingModule { }
