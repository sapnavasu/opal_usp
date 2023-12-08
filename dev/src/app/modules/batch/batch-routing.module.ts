import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { BatchgridlistingComponent } from './batchgridlisting/batchgridlisting.component';
import { BatchviewpageComponent } from './batchviewpage/batchviewpage.component';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'batchgridlisting',
        component: BatchgridlistingComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'Batch Management',
          urls: [
            { title: 'Batch Management', url: '/batchindex/batchgridlisting' }
          ]
        },
      },
      {
        path: 'batchviewpage/:batch',
        component: BatchviewpageComponent,
        canActivate: [AuthGuard],
        data: {
          title: 'View Batch Details',
          urls: [
            { title: 'Batch Management', url: '/batchindex/batchgridlisting' },
            { title: 'View Batch Details', url: '/batchindex/batchviewpage/:batch' }
          ]
        },
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BatchRoutingModule { }

