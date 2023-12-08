import { NgModule } from '@angular/core';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { CommonModule } from '@angular/common';
import { FlexLayoutModule } from '@angular/flex-layout';
import { RegistrationRoutingModule } from './registration-routing.module';
import { RegsitrationComponent } from './regsitration.component';
import { UserdetailsComponent } from './userreg/userreg.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { SharedModule } from '@app/@shared/shared.module';
//import { DeveloperkitModule } from '@lypis_core/developerkit/developerkit.module';
import { ModalDialogReginfo } from './modal/reginfo';
import { InvalidpageComponent } from './invalidpage/invalidpage.component';
import { registerwithopalComponent } from './registerwithopal/registerwithopal.component';
import { InvestorcontentComponent } from './investorcontent/investorcontent.component';
import { CorporateregComponent } from './corporatereg/corporatereg.component';
import { HttpClientModule } from '@angular/common/http';
import { InvestorregresolverService } from './corporatereg/investorregresolver.service';
import { ThankyouComponent } from './thankyou/thankyou.component';
import { ProjectownerregComponent } from './projectownerreg/projectownerreg.component';
import { WelcomecardComponent } from './rightsidecard/welcomecard/welcomecard.component';
import { NamecardComponent } from './rightsidecard/namecard/namecard.component';
import { ThankyoucardComponent } from './rightsidecard/thankyoucard/thankyoucard.component';
import { SupplierregComponent } from './supplierreg/supplierreg.component';
import { MatSelectSearchModule } from '@app/modules/mat-select-search/mat-select-search.module';
import { BuyerregComponent } from './buyerreg/buyerreg.component';
import { ViewOfflineRegdataComponent } from './view-offline-regdata/view-offline-regdata.component';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatButtonModule } from '@angular/material/button';
import { MatButtonToggleModule } from '@angular/material/button-toggle';
import { MatCardModule } from '@angular/material/card';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { MatChipsModule } from '@angular/material/chips';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatDialogModule } from '@angular/material/dialog';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatIconModule } from '@angular/material/icon';
import { MatGridListModule } from '@angular/material/grid-list';
import { MatInputModule } from '@angular/material/input';
import { MatListModule } from '@angular/material/list';
import { MatMenuModule } from '@angular/material/menu';
import { MatNativeDateModule, MatRippleModule } from '@angular/material/core';
import { MatProgressBarModule } from '@angular/material/progress-bar';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { MatRadioModule } from '@angular/material/radio';
import { MatSelectModule } from '@angular/material/select';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatSliderModule } from '@angular/material/slider';
import { MatSlideToggleModule } from '@angular/material/slide-toggle';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { MatSortModule } from '@angular/material/sort';
import { MatTableModule } from '@angular/material/table';
import { MatTabsModule } from '@angular/material/tabs';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatTooltipModule } from '@angular/material/tooltip';
import { MatStepperModule } from '@angular/material/stepper';
import { BlanklayoutComponent } from '@app/layouts/blanklayout/blanklayout.component';
import { PopoverModule } from 'ngx-smart-popover';
import { RegistrationheaderComponent } from './registrationheader/registrationheader.component';
import { RegistrationfooterComponent } from './registrationfooter/registrationfooter.component';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { RestrictInputDirective } from '@app/common/directives/common.directive';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/registration/', '.json');
}

import { Paymentnotedialog} from './modalpaymentnote/paymentnote';
import { RecaptchaV3Module, ReCaptchaV3Service, RECAPTCHA_V3_SITE_KEY } from 'ng-recaptcha';
import { MatProgressButtonsModule } from 'mat-progress-buttons';
@NgModule({
  declarations: [RegsitrationComponent,UserdetailsComponent,ModalDialogReginfo, 
    Paymentnotedialog,
    InvalidpageComponent, registerwithopalComponent, InvestorcontentComponent, 
    CorporateregComponent, ThankyouComponent, ProjectownerregComponent, WelcomecardComponent, NamecardComponent, ThankyoucardComponent, SupplierregComponent, BuyerregComponent, ViewOfflineRegdataComponent, BlanklayoutComponent, RegistrationheaderComponent, RegistrationfooterComponent],
  imports: [
    CommonModule,
    MatProgressButtonsModule,
    RegistrationRoutingModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    SharedModule,
    //DeveloperkitModule,
    MatAutocompleteModule,
    MatButtonModule,
    MatButtonToggleModule,
    MatCardModule,
    MatCheckboxModule,
    MatChipsModule,
    MatDatepickerModule,
    MatDialogModule,
    MatExpansionModule,
    MatGridListModule,
    MatIconModule,
    MatInputModule,
    MatListModule,
    MatMenuModule,
    MatNativeDateModule,
    MatPaginatorModule,
    MatProgressBarModule,
    MatProgressSpinnerModule,
    MatRadioModule,
    MatRippleModule,
    MatSelectModule,
    MatSidenavModule,
    MatSliderModule,
    MatSlideToggleModule,
    MatSnackBarModule,
    MatSortModule,
    MatTableModule,
    MatTabsModule,
    MatToolbarModule,
    MatTooltipModule,
    MatStepperModule,
    HttpClientModule,
    CarouselModule,
    MatSelectSearchModule,
    PopoverModule,
    RecaptchaV3Module,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  entryComponents:[ModalDialogReginfo,Paymentnotedialog],
  providers: [InvestorregresolverService,ReCaptchaV3Service,
    {
      provide: RECAPTCHA_V3_SITE_KEY,
      useValue: '6Ldec7AZAAAAADAY53ZvWGUq34shU6KR-R-uZrjD'
    },
  
  ],
  exports: [NamecardComponent,
  RegistrationheaderComponent,
RegistrationfooterComponent]
})
export class RegistrationModule { }
