import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AuthGuard } from '@app/auth/auth.guard';

import { DashboardComponent } from './dashboard/dashboard.component';
import { MasterdatadashboardComponent } from './masterdatadashboard/masterdatadashboard.component';
import { ConfigurecentredashboardComponent } from './configurecentredashboard/configurecentredashboard.component';
import { ChecklistconfigdashboardComponent } from './checklistconfigdashboard/checklistconfigdashboard.component';





const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: '', component: DashboardComponent, canActivate: [AuthGuard],
        data: {
          title: 'Configuration',
          breadcrumb: 'Configuration',
          urls: [
            { title: 'Configuration', url: '/configuration' }
          ]
        }
      },
      {
        path: 'master_data_dashaboard', component: MasterdatadashboardComponent, canActivate: [AuthGuard],
        data: {
          title: 'Master Data Configuration',
          breadcrumb: 'Master Data Configuration',
          urls: [
            { title: 'Configuration', url: '/configuration' },
            { title: 'Master Data Configuration', url: '/configuration/master_data_dashaboard' }
          ]
        }
      },
      {
        path: 'configure_centre_dashboard', component: ConfigurecentredashboardComponent, canActivate: [AuthGuard],
        data: {
          title: 'Configure Centre Application Form',
          breadcrumb: 'Configure Centre Application Form',
          urls: [
            { title: 'Configuration', url: '/configuration' },
            { title: 'Configure Centre Application Form', url: '/configuration/configure_centre_dashboard' }
          ]
        }
      },
      {
        path: 'checklist_dashboard', component: ChecklistconfigdashboardComponent, canActivate: [AuthGuard],
        data: {
          title: 'Checklist Configuration',
          breadcrumb: 'Checklist Configuration',
          urls: [
            { title: 'Configuration', url: '/configuration' },
            { title: 'Checklist Configuration', url: '/configuration/checklist_dashboard' }
          ]
        }
      },
    ]
      
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ConfigurationRoutingModule { }
