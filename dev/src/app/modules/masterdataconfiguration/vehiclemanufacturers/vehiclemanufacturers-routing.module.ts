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
        title: 'Vehicle Manufacturers',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Vehicle Manufacturers', url: '/configuration/masterdataconfiguration/vehiclemanufacturers' }
        ]
      },
    },
    {
      path: 'add',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Vehicle Manufacturers',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Vehicle Manufacturers', url: '/configuration/masterdataconfiguration/vehiclemanufacturers' },
          { title: 'Add Vehicle Manufacturers', url: '/configuration/masterdataconfiguration/vehiclemanufacturers/add' }
        ]
      },
    },
    {
      path: 'edit/:id',
      component: AddComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Update Vehicle Manufacturers',
        urls: [
          { title: 'Configuration', url: '/configuration' },
          { title: 'Master data Configuration', url: '/configuration/master_data_dashaboard' },
          { title: 'Vehicle Manufacturers', url: '/configuration/masterdataconfiguration/vehiclemanufacturers' },
          { title: 'Update Vehicle Manufacturers', url: '/configuration/masterdataconfiguration/vehiclemanufacturers/edit/:id' }
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
export class VehiclemanufacturersRoutingModule { }
