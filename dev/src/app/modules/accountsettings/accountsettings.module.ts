import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { AccountsettingsRoutingModule } from './accountsettings-routing.module';
import { AccountsettingsComponent } from './accountsettings.component';
import { FlexLayoutModule } from '@angular/flex-layout';
import { SecuritydetailComponent } from './securitydetail/securitydetail.component';
// import { Successdialog } from './modal/successdialog';
import { PopoverModule } from "ngx-smart-popover";
import { SecurityquestionlistComponent } from './securityquestionlist/securityquestionlist.component';
import { EmailpreferenceslistComponent } from './emailpreferenceslist/emailpreferenceslist.component';
import { SubscriptionpaymentlistComponent } from './subscriptionpaymentlist/subscriptionpaymentlist.component';
import { ChangesubscriptionlistviewComponent } from './changesubscriptionlistview/changesubscriptionlistview.component';
import { SharedModule } from '@app/@shared';
import { ProfilemanagementModule } from '../profilemanagement/profilemanagement.module';
import { EnterpriseadminModule } from '../enterpriseadmin/enterpriseadmin.module';
import { AuthModule } from '@app/auth';
import { Successdialog } from '@app/@shared/modal/successdialog';
import { AudittrailsidenavComponent } from './audittrailsidenav/audittrailsidenav.component';
import { NgxDaterangepickerMd } from "ngx-daterangepicker-material";
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { ChangepasswordbackendComponent } from './changepasswordbackend/changepasswordbackend.component';
import { TwofactorauthComponent } from './twofactorauth/twofactorauth.component';
import { MatProgressButtonOptions, MatProgressButtonsModule } from 'mat-progress-buttons';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';

import { succesinfo } from './twofactorauth/modal/succesinfo';
// import { ModulepermissionnewComponent } from './modulepermissionnew/modulepermissionnew.component';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/accountsettings/', '.json');
}
@NgModule({
  declarations: [
    AccountsettingsComponent,SecuritydetailComponent, Successdialog, SecurityquestionlistComponent,
     EmailpreferenceslistComponent, SubscriptionpaymentlistComponent,  ChangesubscriptionlistviewComponent,
     AudittrailsidenavComponent, ChangepasswordbackendComponent, TwofactorauthComponent,succesinfo],
   imports: [
    CommonModule,
    AuthModule,
    AccountsettingsRoutingModule,
    MatProgressButtonsModule,
    CommonModule,
    PopoverModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    SharedModule,
    ProfilemanagementModule,
    EnterpriseadminModule,
    NgxDaterangepickerMd.forRoot(),
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  
  entryComponents: [Successdialog],
  exports: [
    ChangepasswordbackendComponent
  ],
  providers: [
    NgxDaterangepickerMd,
  ]
 
})
export class AccountsettingsModule { }
