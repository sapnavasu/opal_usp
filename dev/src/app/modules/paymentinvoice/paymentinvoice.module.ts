import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PaymentinvoiceRoutingModule } from './paymentinvoice-routing.module';
import { PaymentprofileComponent } from './paymentprofile/paymentprofile.component';
import { FlexLayoutModule } from '@angular/flex-layout';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { SharedModule } from '@app/@shared/shared.module';
import { CookieService } from 'ngx-cookie-service';
import { Title } from '@angular/platform-browser';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/payment/', '.json');
}

@NgModule({
  declarations: [PaymentprofileComponent],
  imports: [
    CommonModule,
    PaymentinvoiceRoutingModule,
    SharedModule,
    TranslateModule,
    FlexLayoutModule,
    HttpClientModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  providers: [
    RemoteService
    
  ]
})
export class PaymentinvoiceModule { }
