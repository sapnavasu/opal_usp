import { Routes } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { ContactinformationComponent } from './contactinformation/contactinformation.component';
export const ProfilemanagementRouting: Routes = [
  {
    path: '',
    children: [
     
      {
        path: 'contactinfo',
        component: ContactinformationComponent,
        data: {
          accessmodule: [19],
          title: 'Contactinfo',
          breadcrumb: 'Contactinfo'
        },
        canActivate: [AuthGuard],
      },
      
    ]
  },

];

