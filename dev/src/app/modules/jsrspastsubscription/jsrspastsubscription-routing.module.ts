import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SubscriptionlandingpageComponent } from './subscriptionlandingpage/subscriptionlandingpage.component';



const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'subscriptionlandingpage',
        component: SubscriptionlandingpageComponent,
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class JsrspastsubscriptionRoutingModule { }
