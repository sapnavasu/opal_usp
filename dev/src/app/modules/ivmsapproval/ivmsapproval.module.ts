import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '@app/@shared';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { MatTabsModule } from '@angular/material/tabs'; 
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { FlexLayoutModule } from '@angular/flex-layout';
import { IvmsapprovalRoutingModule } from './ivmsapproval-routing.module';
import { ApprovallistComponent } from './approvallist/approvallist.component';
import { CompanyinfoivmsComponent } from './companyinfoivms/companyinfoivms.component';
import { IvmsdesktopComponent } from './ivmsdesktop/ivmsdesktop.component';
import { VendorinformationComponent } from './vendorinformation/vendorinformation.component';
import { CompanydocumentivmsComponent } from './companydocumentivms/companydocumentivms.component';
import { IvmsoperatorComponent } from './ivmsoperator/ivmsoperator.component';
import { IvmsdevicemodelComponent } from './ivmsdevicemodel/ivmsdevicemodel.component';
import { DevicedocumentComponent } from './devicedocument/devicedocument.component';
import { IvmsstaffComponent } from './ivmsstaff/ivmsstaff.component';
import { ValidationComponent } from './validation/validation.component';
import { PopoverModule } from 'ngx-smart-popover';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { StaffviewComponent } from './staffview/staffview.component';
import { IvmsinfocardComponent } from './ivmsinfocard/ivmsinfocard.component';
import { IvmdsiteauditComponent } from './ivmdsiteaudit/ivmdsiteaudit.component';
import { SiteaudittabComponent } from './siteaudittab/siteaudittab.component';
import { SitepracticalComponent } from './sitepractical/sitepractical.component';

export function createTranslateLoader(http: HttpClient) {
  const timestamp = Date.now();
return new TranslateHttpLoader(http, './assets/i18n/certificationapproval/', '.json?cache='+timestamp);
}

@NgModule({
  declarations: [ApprovallistComponent, CompanyinfoivmsComponent, IvmsdesktopComponent, VendorinformationComponent, CompanydocumentivmsComponent, IvmsoperatorComponent, IvmsdevicemodelComponent, DevicedocumentComponent, IvmsstaffComponent, ValidationComponent, StaffviewComponent, IvmsinfocardComponent, IvmdsiteauditComponent, SiteaudittabComponent, SitepracticalComponent],
  imports: [
    CommonModule,
    MatTabsModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    SharedModule,
    PopoverModule,
    IvmsapprovalRoutingModule,
    CKEditorModule,
    TranslateModule.forChild({
    loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
    }
    }),
],
})
export class IvmsapprovalModule { }
