import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { InvoicecentreComponent } from './invoicecentre/invoicecentre.component';
import { InvoicecourseComponent } from './invoicecourse/invoicecourse.component';
import { RoyaltyfeeComponent } from './royaltyfee/royaltyfee.component';
import { PaymentmanagementComponent } from './paymentmanagement/paymentmanagement.component';
import { AssessmentlistComponent } from './assessmentlist/assessmentlist.component';
import { AsseeementfeeComponent } from './asseeementfee/asseeementfee.component';
import { TrainingoperatorComponent } from './trainingoperator/trainingoperator.component';
import { TrainingoperatorpaymentComponent } from './trainingoperatorpayment/trainingoperatorpayment.component';
import { TrainingpaymentComponent } from './invoicecentre/trainingpayment/trainingpayment.component';
import { TechnicalpaymentComponent } from './invoicecentre/technicalpayment/technicalpayment.component';
import { RoyaltypaymentComponent } from './royaltypayment/royaltypayment.component';
import { RoyaltytechpayComponent } from './royaltyfee/royaltytechpay/royaltytechpay.component';
import { TechnicalcentreComponent } from './invoicecentre/technicalcentre/technicalcentre.component';
import { TechnicalviewivmsComponent } from './royaltyfee/technicalviewivms/technicalviewivms.component';
import { TechnicalpaymentivmsComponent } from './invoicecentre/technicalpaymentivms/technicalpaymentivms.component';


const routes: Routes = [{
  path: '',
  children: [
    // Assessment
    {
      path: 'listassessment',
      component: AssessmentlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Assessment Fee',
        urls: [
          { title: 'Invoice Management - Assessment Fee', url: '/invoicemanagement/listassessment' }
        ]
      },
    },
    {
      path: 'assessmentfee',
      component: AsseeementfeeComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Assessment Fee',
        urls: [
          { title: 'Invoice Management - Assessment Fee', url: '/invoicemanagement/listassessment' },
          { title: 'View', url: '/invoicemanagement/assessmentfee' }
        ]
      },
    },
    // Royalty
    {
      path: 'royaltyfee',
      component: RoyaltyfeeComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Royalty Fee',
        urls: [
          { title: 'Invoice Management - Royalty Fee', url: '/invoicemanagement/royaltyfee' }
        ]
      },
    },
    // centre
    {
      path: 'centrecertificate',
      component: InvoicecentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Centre Certification',
        urls: [
          { title: 'Invoice Management - Centre Certification', url: '/invoicemanagement/centrecertificate' }
        ]
      },
    },
    {
      path: 'centrecertification',
      component: TechnicalcentreComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Centre Certification',
        urls: [
          { title: 'Invoice Management - Centre Certification', url: '/invoicemanagement/centrecertification' },
          { title: 'Invoice Management - Centre Certification', url: '/invoicemanagement/centrecertificate' }
        ]
      },
    },
    // course
    {
      path: 'coursecertificate',
      component: InvoicecourseComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Course Certification',
        urls: [
          { title: 'Invoice Management - Course Certification', url: '/invoicemanagement/coursecertificate' }
        ]
      },
    },
    {
      path: 'payment',
      component: PaymentmanagementComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Course Certification',
        urls: [
          { title: 'Invoice Management - Course Certification', url: '/invoicemanagement/coursecertificate' },
          { title: 'View', url: '/invoicemanagement/payment' }
        ]
      },
    },
    // Training conduct operator
    {
      path: 'trainingconductlist',
      component: TrainingoperatorComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Training Conducted for the Operator',
        urls: [
          { title: 'Invoice Management - Training Conducted for the Operator', url: '/invoicemanagement/trainingconductlist' }
        ]
      },
    },
    {
      path: 'trainingconductviw',
      component: TrainingoperatorpaymentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Training Conducted for the Operator',
        urls: [
          { title: 'Invoice Management - Training Conducted for the Operator', url: '/invoicemanagement/trainingconductlist' }
        ]
      },
    },
    {
      path: 'tariningpayment',
      component: TrainingpaymentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Centre Certification',
        urls: [
          { title: 'Training Evaluation Centre', url: '/invoicemanagement/centrecertificate' },
          { title: 'Invoice Management - Centre Certification', url: '/invoicemanagement/tariningpayment' },
          { title: 'View', url: '/invoicemanagement/centrecertificate' }
        ]
      },
    },
    {
      path: 'technicalpayment',
      component: TechnicalpaymentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Centre Certification',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/invoicemanagement/centrecertificate' },
          { title: 'Invoice Management - Centre Certification', url: '/invoicemanagement/centrecertificate' },
          { title: 'View', url: '/invoicemanagement/technicalpayment' }
        ]
      },
    },

    {
      path: 'technicalpaymentivms',
      component: TechnicalpaymentivmsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Centre Certification',
        urls: [
          { title: 'Technical Installation Centre', url: '/invoicemanagement/centrecertificate' },
          { title: 'Invoice Management - Centre Certification', url: '/invoicemanagement/centrecertificate' },
          { title: 'View', url: '/invoicemanagement/technicalpaymentivms' }
        ]
      },
    },
    // Royalty
    {
      path: 'royaltyfeepayment',
      component: RoyaltypaymentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Royalty Fee',
        urls: [
          { title: 'Training Evaluation Centre', url: '/invoicemanagement/royaltyfee' },
          { title: 'Invoice Management - Royalty Fee', url: '/invoicemanagement/royaltyfee' },
          { title: 'View', url: '/invoicemanagement/royaltyfeepayment' }
        ]
      },
    },
    {
      path: 'rayoltytechfee',
      component: RoyaltytechpayComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Royalty Fee',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/invoicemanagement/royaltyfee' },
          { title: 'Invoice Management - Royalty Fee', url: '/invoicemanagement/royaltyfee' },
          { title: 'View', url: '/invoicemanagement/rayoltytechfee' }
        ]
      },
    },
    {
      path: 'rayoltytechivms',
      component: TechnicalviewivmsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Invoice Management - Royalty Fee',
        urls: [
          { title: 'Technical Installaion Centre', url: '/invoicemanagement/royaltyfee' },
          { title: 'Invoice Management - Royalty Fee', url: '/invoicemanagement/royaltyfee' },
          { title: 'View', url: '/invoicemanagement/rayoltytechivms' }
        ]
      },
    },
  ]
}]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class InvoicemanagementRoutingModule { }
