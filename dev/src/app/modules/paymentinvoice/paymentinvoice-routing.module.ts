
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PaymentprofileComponent } from './paymentprofile/paymentprofile.component';


const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'invoice',
        component: PaymentprofileComponent,
        data: {
          title: 'View Payment Details',
          urls: [
            { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/invoice',last:'true' }
          ]
        },
      },
      {
        path: 'invoice/details',
        component: PaymentprofileComponent,
        data: {
          title: 'View Payment Details',
          urls: [
            { title: 'Training Evaluation Centre Approval', url: '/centrecertification/home' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/invoice/details',last:'true' }          ]
        },
      },
      {
        path: 'rasinvoice',
        component: PaymentprofileComponent,
        data: {
          title: 'View Payment Details',
          urls: [
            { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/rasinvoice',last:'true' }
          ]
        },
      },
      {
        path: 'invoice/rasdetails',
        component: PaymentprofileComponent,
        data: {
          title: 'View Payment Details',
          urls: [
            { title: 'RAS Technical Evaluation Centre Approval', url: '/centrecertification/rashome' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/invoice/rasdetails',last:'true' }
          ]
        },
      },
      {
        path: 'invoiceconfirm',
        component: PaymentprofileComponent,
        data: {
          title: 'View Payment Details',
          urls: [
            { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/invoiceconfirm',last:'true' }
          ]
        },
      },
      {
        path: 'invoicestand',
        component: PaymentprofileComponent,
        data: {
          title: 'View Payment Details',
          urls: [
            { title: 'Standard & Customized Course Approval', url: '/standardcourseapproval/approvaldetails' },
            { title: 'View Payment Details', url: '/paymentinvoiceindex/invoicestand',last:'true' }
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
export class PaymentinvoiceRoutingModule { }
