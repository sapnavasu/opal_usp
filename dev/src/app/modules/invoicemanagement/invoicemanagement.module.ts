import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { InvoicemanagementRoutingModule } from './invoicemanagement-routing.module';
import { RoyaltyfeeComponent } from './royaltyfee/royaltyfee.component';
import { PaymentmanagementComponent } from './paymentmanagement/paymentmanagement.component';
import { InvoicecentreComponent } from './invoicecentre/invoicecentre.component';
import { InvoicecourseComponent } from './invoicecourse/invoicecourse.component';
import { SharedModule } from '@app/@shared';
import { MatTabsModule } from '@angular/material/tabs'; 
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { FlexLayoutModule } from '@angular/flex-layout';
import { RoyaltypaymentComponent } from './royaltypayment/royaltypayment.component';
import { AssessmentlistComponent } from './assessmentlist/assessmentlist.component';
import { AsseeementfeeComponent } from './asseeementfee/asseeementfee.component';
import { ValidationComponent } from './validation/validation.component';
import { PopoverModule } from 'ngx-smart-popover';
import { CKEditorModule } from '@app/common/ckeditor';
import { TrainingoperatorComponent } from './trainingoperator/trainingoperator.component';
import { TrainingoperatorpaymentComponent } from './trainingoperatorpayment/trainingoperatorpayment.component';
import { TrainingcentreComponent } from './invoicecentre/trainingcentre/trainingcentre.component';
import { TechnicalcentreComponent } from './invoicecentre/technicalcentre/technicalcentre.component';
import { TrainingpaymentComponent } from './invoicecentre/trainingpayment/trainingpayment.component';
import { TechnicalpaymentComponent } from './invoicecentre/technicalpayment/technicalpayment.component';
import { TrainingroyaltyComponent } from './royaltyfee/trainingroyalty/trainingroyalty.component';
import { TechnicalroyaltyComponent } from './royaltyfee/technicalroyalty/technicalroyalty.component';
import { RoyaltytechpayComponent } from './royaltyfee/royaltytechpay/royaltytechpay.component';
import { GenerateinvoiceComponent } from './generateinvoice/generateinvoice.component';
import { TechnicalivmsComponent } from './royaltyfee/technicalivms/technicalivms.component';
import { TechnicalviewivmsComponent } from './royaltyfee/technicalviewivms/technicalviewivms.component';
import { IvmscentreComponent } from './invoicecentre/ivmscentre/ivmscentre.component';
import { TechnicalpaymentivmsComponent } from './invoicecentre/technicalpaymentivms/technicalpaymentivms.component';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/invoicemanagement/', '.json');
}
@NgModule({
  declarations: [TechnicalviewivmsComponent,TechnicalivmsComponent,RoyaltyfeeComponent, PaymentmanagementComponent, InvoicecentreComponent, InvoicecourseComponent, RoyaltypaymentComponent, AssessmentlistComponent, AsseeementfeeComponent, ValidationComponent, TrainingoperatorComponent, TrainingoperatorpaymentComponent, TrainingcentreComponent, TechnicalcentreComponent, TrainingpaymentComponent, TechnicalpaymentComponent, TrainingroyaltyComponent, TechnicalroyaltyComponent, RoyaltytechpayComponent, GenerateinvoiceComponent, IvmscentreComponent, TechnicalpaymentivmsComponent],
  imports: [
    CommonModule,
    InvoicemanagementRoutingModule,
    SharedModule,
    MatTabsModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    PopoverModule,
    CKEditorModule,
    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createTranslateLoader,
          deps: [HttpClient]
      }
  }),
  ]
})
export class InvoicemanagementModule { }
