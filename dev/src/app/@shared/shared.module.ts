import { AgmCoreModule, GoogleMapsAPIWrapper } from '@agm/core';
import { MatGoogleMapsAutocompleteModule } from '@angular-material-extensions/google-maps-autocomplete';
import { CommonModule } from '@angular/common';
import { HttpClient } from '@angular/common/http';
import { APP_INITIALIZER, Injector, NgModule } from '@angular/core';
import { FlexLayoutModule } from '@angular/flex-layout';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { CKEditorModule } from '@app/common/ckeditor';
import { AlphabetonlyDirective } from '@app/common/directives/alphabetonly.directive';
import { AlphanumDirective } from '@app/common/directives/alphanum.directive';
import { AlphanumspecificsymDirective } from '@app/common/directives/alphanumspecificsym.directive';
import { AlphanumsymbDirective } from '@app/common/directives/alphanumsymb.directive';
import { AlphasymbDirective } from '@app/common/directives/alphasymb.directive';
import { ClickOutDirective } from '@app/common/directives/click-out.directive';
import { RestrictInputDirective } from '@app/common/directives/common.directive';
import { DecimalnumberDirective } from '@app/common/directives/decimalnumber.directive';
import { DecimalnumberonlyDirective } from '@app/common/directives/decimalnumberonly.directive';
import { InputFirstSpaceDirective } from '@app/common/directives/inputfirstspace';
import { NumberonlyDirective } from '@app/common/directives/numberonly.directive';
import { StringOnlyDirective } from '@app/common/directives/string.directive';
import { Cropdialog } from '@app/common/drive/cropdialog/crop-dialog';
import { DriveComponent, DriveModal } from '@app/common/drive/drive.component';
import { Uploaddialog } from '@app/common/drive/uploaddialog/upload-dialog';
import { MaterialModule } from '@app/material.module';
import { ImageCropperModule } from '@app/modules/image-cropper/image-cropper.module';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { TranslateLoader, TranslateModule, TranslateService } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { MatTimepickerModule } from "mat-timepicker";
import { NgDynamicBreadcrumbModule } from 'ng-dynamic-breadcrumb';
import { Attributes, IntersectionObserverHooks, LazyLoadImageModule, LAZYLOAD_IMAGE_HOOKS } from 'ng-lazyload-image';
import { NgxDaterangepickerMd } from "ngx-daterangepicker-material";
import { DndModule } from 'ngx-drag-drop';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { PerfectScrollbarConfigInterface, PerfectScrollbarModule } from 'ngx-perfect-scrollbar';
import { ShareModule } from 'ngx-sharebuttons';
import { PopoverModule } from 'ngx-smart-popover';
import { NgxSpinnerModule } from 'ngx-spinner';
import { Encrypt } from '../common/class/encrypt';
import { LoginnameDirective } from '../common/directives/loginname.directive';
import { AdddepartmentComponent } from './adddepartment/adddepartment.component';
import { AddinguserComponent } from './addinguser/addinguser.component';
import { AppBreadcrumbComponent } from './breadcrumb/breadcrumb.component';
import { ChangesubscriptionlistComponent } from './changesubscriptionlist/changesubscriptionlist.component';
import { CommonmatdialogComponent } from './commonmatdialog/commonmatdialog.component';
import { CommonpopdesignComponent } from './commonpopdesign/commonpopdesign.component';
import { ContactusnavComponent } from './contactusnav/contactusnav.component';
import { DebounceClickDirective } from './debounce-click.directive';
import { AccordionAnchorDirective, AccordionDirective, AccordionLinkDirective } from './directives/accordion';
import { CommonTextComponent } from './directives/common-text/common-text.component';
import { Filee } from './filee/filee';
import { FliptimerComponent } from './fliptimer/fliptimer.component';
import { FormbuilderComponent} from './formbuilder/formbuilder.component';
import { InviteexternallistComponent } from './inviteexternallist/inviteexternallist.component';
import { SuperadminfooterComponent } from './layouts/superadmin/superadminfooter/superadminfooter.component';
import { SuperadminheaderComponent } from './layouts/superadmin/superadminheader/superadminheader.component';
import { SuperadminlayoutComponent } from './layouts/superadmin/superadminlayout.component';
import { SuperadminsidebarComponent } from './layouts/superadmin/superadminsidebar/superadminsidebar.component';
import { LoaderComponent } from './loader/loader.component';
import { NumberDirective } from './numbers-only.directive';
import { PercentageDirective } from './percentage.directive';
import { BytesPipe } from './pipes/bytes.pipe';
import { BGIDateFormat } from './pipes/changeDateFormat.pipe';
import { BGIDateTimeFormat } from './pipes/changeDateTimeFormat.pipe';
import { CurrencyInputDirective } from './pipes/currency-input.directive';
import { DateDifference } from './pipes/date-difference.pipe';
import { DisableoptionsPipe } from './pipes/disableoptions.pipe';
import { FilterPipe } from './pipes/filter.pipe';
import { MpsfilterPipe } from './pipes/mpsfilter.pipe';
import { LabelPipe } from './pipes/label.pipe';
import { MinMaxDirective } from './pipes/min-max.directive';
import { MultisearchinputPipe } from './pipes/multisearchinput.pipe';
import { NumberSuffixPipe } from './pipes/number-suffix.pipe';
import { SearchPipe } from './pipes/search.pipe';
import { TruncatePipe } from './pipes/truncate.pipe';
import { ResizableDirective } from './resizable.directive';
import { ResponseloaderComponent } from './responseloader/responseloader.component';
import { AddsectoractivitiesComponent } from './sidepanel/addsectoractivities/addsectoractivities.component';
import { UserallocationComponent } from './sidepanel/userallocation/userallocation.component';
import { SimpleDialog } from './simple-dialog/simple-dialog';
import { SpinnerComponent } from './spinner.component';
import { SuggesttemplateComponent, SuggesttextComponent } from './suggesttext/suggesttext.component';
import { Util } from './util';
import { AcknowledgepaymentComponent } from './acknowledgepayment/acknowledgepayment.component';
import { AddusersidenavComponent } from '@app/modules/enterpriseadmin/addusersidenav/addusersidenav.component';
import { ProfilelistviewComponent } from '@app/modules/profilecreation/profilelistview/profilelistview.component';
import { ProfileviewdetailsComponent } from '@app/modules/profilecreation/profileviewdetails/profileviewdetails.component';
import { StripHtmlPipe } from './pipes/striphtml.pipe';
import { NumberConversionPipe } from './pipes/number-conversion.pipe';
import { Modaltermscondition } from '@app/modules/registration/supplierreg/supplierreg.component';
import { CustomScrollDirective } from '@app/modules/registration/custom-scroll.directive';
import { FactorauthenticationComponent } from './factorauthentication/factorauthentication.component';
import { MatProgressButtonsModule } from 'mat-progress-buttons';
import { FileuploadComponent } from './fileupload/fileupload.component';
 import { MultifileuploadComponent } from './multifileupload/multifileupload.component';
import { StafcvComponent } from './stafcv/stafcv.component';
import { CoursepaymentComponent } from './opalpayment/coursepayment/coursepayment.component';
import { PaymentcentreComponent } from './opalpayment/paymentcentre/paymentcentre.component';
import { OpalpaymentComponent } from './opalpayment/opalpayment.component';
import { ViewvalidationComponent } from './viewvalidation/viewvalidation.component';
import { CommoncommentsComponent } from './commoncomments/commoncomments.component';
import { BgimapComponent } from './bgimap/bgimap.component';
import { Modalpayment } from './opalpayment/paymentcentre/paymentcentre.component';
import { commentmodal } from '@app/modules/batch/modal/commentmodal';
import { ApplicationInitializerFactory } from './translation.config';
import { Datepickermodal } from './datepickermodal/datepickermodal';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/accountsettings/', '.json');
}

const DEFAULT_PERFECT_SCROLLBAR_CONFIG: 
PerfectScrollbarConfigInterface = {
 suppressScrollX: true
};
// AoT requires an exported function for factories
export function HttpLoaderFactory(httpClient: HttpClient) {
  return new TranslateHttpLoader(httpClient, './assets/i18n/app/', '.json');
}
export class LazyLoadImageHooks extends IntersectionObserverHooks {
  onAttributeChange(newAttributes: Attributes) {
  }
}
@NgModule({
  imports: [
    FlexLayoutModule,
    ShareModule,
    MatGoogleMapsAutocompleteModule,
    MaterialModule,
    CommonModule,
    ReactiveFormsModule,
    PopoverModule,
    ImageCropperModule,
    PerfectScrollbarModule,
    NgxDaterangepickerMd.forRoot(),
    AgmCoreModule.forRoot({apiKey: 'AIzaSyCTt5vrK08INU70Vn0_BwOaheHi722mrGI', libraries: ['places']}),
    CKEditorModule,
    InfiniteScrollModule,
    NgxSpinnerModule,
    MatTimepickerModule,
    FormsModule,
    MatProgressButtonsModule,
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory, 
        deps: [HttpClient]
      }
    }),
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
    
    RouterModule,
    DndModule,
    LazyLoadImageModule
  ],
  declarations: [
    AddusersidenavComponent,
    SuperadminlayoutComponent,
    SuperadminheaderComponent,
    SuperadminsidebarComponent,
    SuperadminfooterComponent,
    OpalpaymentComponent,
    SpinnerComponent,
    FliptimerComponent,
    CommonmatdialogComponent,
    AddsectoractivitiesComponent,
    UserallocationComponent,
    AppBreadcrumbComponent,
    AddinguserComponent,
    LoaderComponent,
    Cropdialog,
    ContactusnavComponent,
    SuggesttextComponent,
    SuggesttemplateComponent,
    CommonpopdesignComponent,
    ResponseloaderComponent,
    ChangesubscriptionlistComponent,
    SearchPipe,
    BytesPipe,
    StripHtmlPipe,
    DisableoptionsPipe,
    NumberSuffixPipe,
    TruncatePipe,
    MultisearchinputPipe,
    FilterPipe,
    MpsfilterPipe,
    LabelPipe,
    Filee,
    DriveComponent, 
    DriveModal,
    SimpleDialog,
    Datepickermodal,
    Uploaddialog,
    AdddepartmentComponent,
    AccordionAnchorDirective,
    DebounceClickDirective,
    PercentageDirective,
    AccordionLinkDirective,
    AccordionDirective,
    CommonTextComponent,
    NumberDirective,
    StringOnlyDirective, 
    BGIDateFormat,
    BGIDateTimeFormat,
    NumberonlyDirective,
    DateDifference,
    AlphanumsymbDirective,
    DecimalnumberDirective, 
    AlphabetonlyDirective,
    AlphanumDirective,
    AlphanumspecificsymDirective,
    AlphasymbDirective,
    NumberSuffixPipe, 
    InputFirstSpaceDirective,
    ClickOutDirective, 
    RestrictInputDirective,
    DecimalnumberonlyDirective,
    ResizableDirective,
    LoginnameDirective,
    FormbuilderComponent,
    InviteexternallistComponent,
    MinMaxDirective,
    CurrencyInputDirective,
    AcknowledgepaymentComponent,
    ProfileviewdetailsComponent,
    ProfilelistviewComponent,
    NumberConversionPipe,
    Modaltermscondition,
    CustomScrollDirective,
    FactorauthenticationComponent,
    FileuploadComponent,
     MultifileuploadComponent,
     StafcvComponent,
     CoursepaymentComponent,
     PaymentcentreComponent,
     ViewvalidationComponent,
     CommoncommentsComponent,
     BgimapComponent,
     Modalpayment,
     commentmodal,
],
  entryComponents: [
    CommonpopdesignComponent,
    SimpleDialog,
    SuggesttemplateComponent,
    CommonmatdialogComponent,
    Uploaddialog,
    Cropdialog,
    Modaltermscondition,
    CommoncommentsComponent,
    commentmodal
  ], 
  exports: [
    AddusersidenavComponent,
    FliptimerComponent,
    NgDynamicBreadcrumbModule,
    AddinguserComponent,
    UserallocationComponent,
    NgxDaterangepickerMd,
    LoaderComponent,
    ContactusnavComponent,
    CommonmatdialogComponent,
    SuggesttextComponent,
    SuggesttemplateComponent,
    AddinguserComponent,
    AccordionAnchorDirective,
    DebounceClickDirective,
    PercentageDirective,
    AccordionLinkDirective,
    AccordionDirective,
    CommonTextComponent,
    SearchPipe,
    DisableoptionsPipe,
    BytesPipe,
    StripHtmlPipe,
    AppBreadcrumbComponent,
    NumberDirective,
    StringOnlyDirective, 
    BGIDateFormat,
    BGIDateTimeFormat,
    NumberonlyDirective,
    DateDifference,
    AlphanumsymbDirective,
    DecimalnumberDirective, 
    AlphabetonlyDirective,
    AlphanumDirective, 
    AlphanumspecificsymDirective,
    AlphasymbDirective,
    NumberSuffixPipe, 
    InputFirstSpaceDirective,
    ClickOutDirective, 
    RestrictInputDirective,
    DecimalnumberonlyDirective,
    TruncatePipe,
    MultisearchinputPipe,
    FilterPipe,
    MpsfilterPipe,
    LabelPipe,
    CommonpopdesignComponent,
    ResponseloaderComponent,
    NumberSuffixPipe,
    MaterialModule,
    AddsectoractivitiesComponent,
    AdddepartmentComponent,
    Filee,
    InfiniteScrollModule,
    MatTimepickerModule,
    NgxSpinnerModule,
    MinMaxDirective,
    CurrencyInputDirective,
    ChangesubscriptionlistComponent,
    ResizableDirective,
    LoginnameDirective,
    InviteexternallistComponent,
    FormbuilderComponent,
    SuperadminlayoutComponent,
    SuperadminheaderComponent,
    SuperadminsidebarComponent,
    SuperadminfooterComponent,
    AcknowledgepaymentComponent,
    ProfileviewdetailsComponent,
    ProfilelistviewComponent,
    NumberConversionPipe,
    Modaltermscondition,
    CustomScrollDirective,
    FactorauthenticationComponent,
    FileuploadComponent,
     MultifileuploadComponent,
     StafcvComponent,
     CoursepaymentComponent,
     PaymentcentreComponent,
     OpalpaymentComponent,
     ViewvalidationComponent,
     BgimapComponent,
     Modalpayment,
     commentmodal

  ],
     
     providers: [Encrypt,GoogleMapsAPIWrapper, NgxDaterangepickerMd,Util,ProfileService,Modalpayment,commentmodal,{
      provide: APP_INITIALIZER,
      useFactory: ApplicationInitializerFactory,
      deps: [ TranslateService, Injector ],
      multi: true
    },
    { provide: LAZYLOAD_IMAGE_HOOKS, useClass: LazyLoadImageHooks   }
  ]
})
export class SharedModule { }
                                         