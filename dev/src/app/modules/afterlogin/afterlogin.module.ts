import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AfterloginRoutingModule } from './afterlogin-routing.module';
import { SubscriptionComponent } from './subscription/subscription.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { FlexLayoutModule } from '@angular/flex-layout';
import { SubcriptioncorporateinvestorComponent } from './subcriptioncorporateinvestor/subcriptioncorporateinvestor.component';
import { PaymentComponent } from './payment/payment.component';
import { PopoverModule } from "ngx-smart-popover";
import { Viewdialog } from './modal/viewdialog'
import { Paymentnotedialog} from './modalpaymentnote/paymentnote';
import { Paymentdialog } from './payment/modal/paymentdialog';
import { InvoicetemplateComponent } from './invoicetemplate/invoicetemplate.component';
import { PaymentsuccessComponent } from './paymentsuccess/paymentsuccess.component';
import { CertificationpaymentdetailComponent } from './certificationpaymentdetail/certificationpaymentdetail.component';
import { PayonlinedetailtabComponent } from './payonlinedetailtab/payonlinedetailtab.component';
import { PayofflinedetailtabComponent } from './payofflinedetailtab/payofflinedetailtab.component';
import { PaymentsuccesslistviewComponent } from './paymentsuccesslistview/paymentsuccesslistview.component';
import { PayofflinesuccesslistviewComponent } from './payofflinesuccesslistview/payofflinesuccesslistview.component';
import { JsrsregisterdetaillistComponent } from './jsrsregisterdetaillist/jsrsregisterdetaillist.component';
import { ChangeclassifylistviewComponent } from './changeclassifylistview/changeclassifylistview.component';
import { InvoicelistviewComponent } from './invoicelistview/invoicelistview.component';
import { ReceiptlistviewComponent } from './receiptlistview/receiptlistview.component';
import { SharedModule } from '@app/@shared';
import { CountryService } from '@app/common/newcountry/service/country.service';
import { ProfileService } from '../profilemanagement/profile.service';
import { Util } from '@app/@shared/util';
import { LandingpageComponent } from './landingpage/landingpage.component';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { Confirmationalert} from './payonlinedetailtab/modal/confirmationinfo';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/afterlogin/', '.json');
}
@NgModule({
  declarations: [SubscriptionComponent, SubcriptioncorporateinvestorComponent, PaymentComponent,Viewdialog,Paymentdialog, InvoicetemplateComponent, PaymentsuccessComponent, CertificationpaymentdetailComponent, PayonlinedetailtabComponent, PayofflinedetailtabComponent, PaymentsuccesslistviewComponent, PayofflinesuccesslistviewComponent, JsrsregisterdetaillistComponent, ChangeclassifylistviewComponent, InvoicelistviewComponent, ReceiptlistviewComponent,Paymentnotedialog, LandingpageComponent,Confirmationalert],
  imports: [
    CommonModule,
    AfterloginRoutingModule,
    CommonModule,
    ReactiveFormsModule,
    PopoverModule,
    FlexLayoutModule,
    FormsModule,
    SharedModule,
    MatDatepickerModule,
    HttpClientModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
    
  ],
  entryComponents: [Viewdialog,Paymentdialog,Paymentnotedialog,Confirmationalert],
  providers: [

     CountryService,
     ProfileService,
     Util
 
  ],
  
})
export class AfterloginModule { }
