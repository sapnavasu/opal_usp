import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TransactionlandingpageComponent } from './transactionlandingpage/transactionlandingpage.component';


const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'transactionlandingpage',
        component: TransactionlandingpageComponent,
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TransactionstatusRoutingModule { }
