import { Routes } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { SupplierComponent } from './supplier/supplier.component';
import { PortaladminComponent } from './portaladmin/portaladmin.component';
import { JourneymapComponent } from './journeymap/journeymap.component';

export const DashboardeRouting: Routes = [ {
  path: '',
  children: [
    {
      path: 'centre',
      component: SupplierComponent,
      canActivate: [AuthGuard],
      data:{
        accessmodule:[47],
        title: 'Centre Dashboard',
        // urls: [
        //     { title: 'Centre Dashboard', url: '/dashboard' }
        //   ]
      },
    },
    {
      path: 'portaladmin',
      component: PortaladminComponent,
      canActivate: [AuthGuard],
      data:{
        accessmodule:[47],
        title: 'Portal Admin Dashboard',
        urls: [
            { title: 'Portal Admin Dashboard', url: '/portaladmin' }
          ]
      },
    },
    {
      path: 'journeymap',
      component: JourneymapComponent,
      canActivate: [AuthGuard],
      data:{
        title: 'Journey Map',
        urls: [
            { title: 'Journey Map', url: '/journeymap' }
          ]
      },
    },
  ]
 }];
