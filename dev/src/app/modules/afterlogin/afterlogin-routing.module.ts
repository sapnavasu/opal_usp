import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SubscriptionComponent } from './subscription/subscription.component';
import { SubcriptioncorporateinvestorComponent } from './subcriptioncorporateinvestor/subcriptioncorporateinvestor.component';
import { PaymentComponent } from './payment/payment.component';
import { InvoicetemplateComponent } from './invoicetemplate/invoicetemplate.component';
import { PaymentsuccessComponent } from './paymentsuccess/paymentsuccess.component';
import { CertificationpaymentdetailComponent } from './certificationpaymentdetail/certificationpaymentdetail.component';
import { PaymentsuccesslistviewComponent } from './paymentsuccesslistview/paymentsuccesslistview.component';
import { InvoicelistviewComponent } from './invoicelistview/invoicelistview.component';
import { ReceiptlistviewComponent } from './receiptlistview/receiptlistview.component';
import { AuthGuard } from '@app/auth/auth.guard';
import { AfterloginresolveService } from './afterloginresolve.service';
import { LandingpageComponent } from './landingpage/landingpage.component';
const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'subscription',
        component: SubscriptionComponent,
        canActivate: [AuthGuard],
        resolve: {
          data: AfterloginresolveService
        },
      },
      {
        path: 'subcriptioncorporateinvestor',
        component: SubcriptioncorporateinvestorComponent, canActivate: [AuthGuard],
      },
      {
        path: 'payment',
        component: PaymentComponent, canActivate: [AuthGuard],
      },
      {
        path: 'invoicetemplate',
        component: InvoicetemplateComponent, canActivate: [AuthGuard],
      },
      {
        path: 'paymentsuccess',
        component: PaymentsuccessComponent, canActivate: [AuthGuard],
      },
      {
        path: 'certificationpaymentdetail',
        component: CertificationpaymentdetailComponent, 
       // canActivate: [AuthGuard],
      },
      {
        path: 'paymentsuccesslistview',
        component: PaymentsuccesslistviewComponent,
      },
      {
        path: 'receiptlistview',
        component: ReceiptlistviewComponent,
      },
      {
        path: 'invoicelistview',
        component: InvoicelistviewComponent,
      },
      {
        path: 'landingpage',
        component: LandingpageComponent,
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AfterloginRoutingModule { }
