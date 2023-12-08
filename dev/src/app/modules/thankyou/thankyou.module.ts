import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ThankyouRoutingModule } from './thankyou-routing.module';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { FlexLayoutModule } from '@angular/flex-layout';
import { ThankyoupageviewComponent } from './thankyoupageview/thankyoupageview.component';
import { ApprovechangeComponent } from './approvechange/approvechange.component';
import { InviteexpiredComponent } from './inviteexpired/inviteexpired.component';
import { RegisterationconfirmedComponent } from './registerationconfirmed/registerationconfirmed.component';
import { SharedModule } from '@app/@shared';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';


// AoT requires an exported function for factories
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/dashboard/', '.json');
}
@NgModule({
  declarations: [ThankyoupageviewComponent,ApprovechangeComponent, InviteexpiredComponent, RegisterationconfirmedComponent],
  imports: [
    CommonModule,
    ThankyouRoutingModule,
    ReactiveFormsModule,
    FlexLayoutModule,
    FormsModule,
    SharedModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  exports:[
    ThankyoupageviewComponent,ApprovechangeComponent
  ]
})
export class ThankyouModule { }
