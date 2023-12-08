import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RegistrationapprovalComponent } from './registrationapproval/registrationapproval.component';
import { SupplierapprovaltabComponent } from './supplierapprovaltab/supplierapprovaltab.component';
import { RegistartionapprovalRoutingModule } from './registartionapproval-routing.module';
import { FlexLayoutModule } from '@angular/flex-layout';
import { AngularDoubleScrollModule } from 'angular-double-scroll';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { ViewandvalidateComponent } from './viewandvalidate/viewandvalidate.component';

import { ProjectownertabComponent } from './projectownertab/projectownertab.component';
import { SuppliertabComponent } from './suppliertab/suppliertab.component';
import { PopoverModule } from "ngx-smart-popover";
import {ViewResolverService} from './view.resolver.service';
import { BuyerComponent } from './buyer/buyer.component';
import { ProjectownercardComponent } from './projectownercard/projectownercard.component';
import { RenewalhistorylistviewComponent } from './renewalhistorylistview/renewalhistorylistview.component';
import { UpdatesuppliersidenavdetailComponent } from './updatesuppliersidenavdetail/updatesuppliersidenavdetail.component';
import { ViewcredentialsidenavdetailComponent } from './viewcredentialsidenavdetail/viewcredentialsidenavdetail.component';
import { DeactivatesuppliersidenavdetailComponent } from './deactivatesuppliersidenavdetail/deactivatesuppliersidenavdetail.component';
import { TemporaryloginsidenavdetailComponent } from './temporaryloginsidenavdetail/temporaryloginsidenavdetail.component';
import { OrganiserdetailtrackersidenavlistComponent } from './organiserdetailtrackersidenavlist/organiserdetailtrackersidenavlist.component';
import { PaymenttrackerComponent } from './paymenttracker/paymenttracker.component';
import { TrackhistorylistviewComponent } from './trackhistorylistview/trackhistorylistview.component';
import { TemporaryaudittrailComponent } from './temporaryaudittrail/temporaryaudittrail.component';
import { UpdatepaymentstatusComponent } from './updatepaymentstatus/updatepaymentstatus.component';
import { UpdatedeviationComponent } from './updatedeviation/updatedeviation.component';
import { SharedModule } from '@shared/shared.module';
import { Util } from '@app/@shared/util';
import { ContractsuccessfeeapprovalComponent } from './contractsuccessfeeapproval/contractsuccessfeeapproval.component';
import { CKEditorModule } from '@app/common/ckeditor';
import { OnlinepaymentstsComponent } from '@app/modules/registartionapproval/onlinepaymentsts/onlinepaymentsts.component';
import { ContractfeeApprovalComponent } from '@app/modules/registartionapproval/contractfee-approval/contractfee-approval.component';
import { PaymentmapuserComponent } from './paymentmapuser/paymentmapuser.component';
import { DeletesuppliersidenavdetailComponent } from './deletesuppliersidenavdetail/deletesuppliersidenavdetail.component';
import { RegisteredstakeholderlistComponent } from './registeredstakeholderlist/registeredstakeholderlist.component';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { SubscriptionpaytrackerComponent } from './subscriptionpaytracker/subscriptionpaytracker.component';
import { SubscriptionpaydetailComponent } from './subscriptionpaydetail/subscriptionpaydetail.component';
import { PaymentproofComponent } from './paymentproof/paymentproof.component';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/supplierlist/', '.json');
}
@NgModule({
  declarations: [SupplierapprovaltabComponent,RegistrationapprovalComponent,ProjectownertabComponent,SuppliertabComponent,ViewandvalidateComponent, BuyerComponent, ProjectownercardComponent, RenewalhistorylistviewComponent, UpdatesuppliersidenavdetailComponent, ViewcredentialsidenavdetailComponent, DeactivatesuppliersidenavdetailComponent, TemporaryloginsidenavdetailComponent, OrganiserdetailtrackersidenavlistComponent,PaymenttrackerComponent, TrackhistorylistviewComponent, TemporaryaudittrailComponent, UpdatepaymentstatusComponent, UpdatedeviationComponent,
    ContractsuccessfeeapprovalComponent,
    OnlinepaymentstsComponent,
    ContractfeeApprovalComponent,
    PaymentmapuserComponent,
    DeletesuppliersidenavdetailComponent,
    RegisteredstakeholderlistComponent,
    SubscriptionpaytrackerComponent,
    SubscriptionpaydetailComponent,
    PaymentproofComponent
],
  imports: [
    CommonModule,
    CommonModule,
    RegistartionapprovalRoutingModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    PopoverModule,
    SharedModule,
    CKEditorModule,
    AngularDoubleScrollModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  providers:[
    ViewResolverService,
    Util
  ]
})
export class RegistartionapprovalModule { }
