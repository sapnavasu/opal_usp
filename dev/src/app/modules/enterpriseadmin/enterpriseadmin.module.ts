import { ScrollingModule } from '@angular/cdk/scrolling';
import { CommonModule, DatePipe} from '@angular/common';
import { NgModule } from '@angular/core';
import { FlexLayoutModule } from '@angular/flex-layout';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CKEditorModule } from '@app/common/ckeditor';
import { SharedModule } from '@shared/shared.module';
import { LocaleService, NgxDaterangepickerMd } from "ngx-daterangepicker-material";
import { PerfectScrollbarConfigInterface, PerfectScrollbarModule, PERFECT_SCROLLBAR_CONFIG } from 'ngx-perfect-scrollbar';
import { PopoverModule } from "ngx-smart-popover";
import { MatSelectSearchModule } from '../mat-select-search/mat-select-search.module';
import { ProfileService } from '../profilemanagement/profile.service';
import { ActivityfilterComponent } from './activityfilter/activityfilter.component';
import { AddbusinessunitComponent } from './addbusinessunit/addbusinessunit.component';
import { AdddepartmentnavComponent } from './adddepartmentnav/adddepartmentnav.component';
import { AddingdetailssidenavComponent } from './addingdetailssidenav/addingdetailssidenav.component';
import { BusinessunitfilterComponent } from './businessunitfilter/businessunitfilter.component';
import { BusinessunitsComponent } from './businessunits/businessunits.component';
import { CollaboratefiltercardComponent } from './collaboratefiltercard/collaboratefiltercard.component';
import { ConfigurebymoduleComponent } from './configurebymodule/configurebymodule.component';
import { DepartmentallocationComponent } from './departmentallocation/departmentallocation.component';
import { DepartmentfilterComponent } from './departmentfilter/departmentfilter.component';
import { DepartmentmanagementComponent } from './departmentmanagement/departmentmanagement.component';
import { DropdownelementcardComponent } from './dropdownelementcard/dropdownelementcard.component';
import { EnterpriseadminRoutingModule } from './enterpriseadmin-routing.module';
import { InviteuserComponent } from './inviteuser/inviteuser.component';
import { Inviteinfo } from './inviteuser/modal/inviteinfo';
import { InviteuserfilterComponent } from './inviteuserfilter/inviteuserfilter.component';
import { InviteusermanagementComponent } from './inviteusermanagement/inviteusermanagement.component';
import { LandingpageComponent } from './landingpage/landingpage.component';
import { Inviteuserdialog } from './modal/inviteuserdialog';
import { ReassignHistoryComponent } from './reassign-history/reassign-history.component';
import { UsereachcountsComponent } from './usereachcounts/usereachcounts.component';
import { UsermanagementComponent,Modalcommentpop,} from './usermanagement/usermanagement.component';
import { UsermoduleallocationComponent } from './usermoduleallocation/usermoduleallocation.component';
import {NgDynamicBreadcrumbModule} from 'ng-dynamic-breadcrumb';
import { DocumentstabComponent } from './documentstab/documentstab.component';
import { ViewpermissionsidenavComponent } from './viewpermissionsidenav/viewpermissionsidenav.component';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/enterpriseadmin/', '.json');
}
const DEFAULT_PERFECT_SCROLLBAR_CONFIG:
PerfectScrollbarConfigInterface = {
 suppressScrollX: true
};
@NgModule({
 declarations: [DepartmentmanagementComponent,
  
   Modalcommentpop,
    UsermanagementComponent,
      AddingdetailssidenavComponent, 
      DepartmentallocationComponent, 
      ActivityfilterComponent, 
      InviteuserComponent,
    Inviteinfo,Inviteuserdialog, ConfigurebymoduleComponent, UsermoduleallocationComponent, LandingpageComponent, UsereachcountsComponent, 
    DepartmentfilterComponent, BusinessunitsComponent, BusinessunitfilterComponent, AdddepartmentnavComponent, InviteusermanagementComponent, 
    InviteuserfilterComponent, AddbusinessunitComponent, 
   DropdownelementcardComponent, 
    CollaboratefiltercardComponent,
    ReassignHistoryComponent, DocumentstabComponent,ViewpermissionsidenavComponent],
 imports: [
   CommonModule,
   PopoverModule,
   EnterpriseadminRoutingModule,
   FlexLayoutModule,
   FormsModule,
   ReactiveFormsModule,
   SharedModule,
   ScrollingModule,
   PerfectScrollbarModule,
   MatSelectSearchModule,
   CKEditorModule,
   NgxDaterangepickerMd.forRoot(),
   TranslateModule.forChild({
    loader: {
      provide: TranslateLoader,
      useFactory: createTranslateLoader,
      deps: [HttpClient]
    }
  }),
   
 ],
 exports:[
   DepartmentallocationComponent,
  Modalcommentpop,ViewpermissionsidenavComponent
 ],
 providers: [
  ProfileService,
  LocaleService,
  DatePipe,
   {
     provide: PERFECT_SCROLLBAR_CONFIG,
     useValue: DEFAULT_PERFECT_SCROLLBAR_CONFIG
   },
 ],
 entryComponents: [Inviteinfo,Inviteuserdialog]
})
export class EnterpriseadminModule { }

