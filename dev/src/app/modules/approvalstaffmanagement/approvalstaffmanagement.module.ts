import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ApprovalstaffmanagementRoutingModule } from './approvalstaffmanagement-routing.module';
import { StafftrainingComponent } from './stafftraining/stafftraining.component';
import { StafftechnicalComponent } from './stafftechnical/stafftechnical.component';
import { MatTabsModule } from '@angular/material/tabs'; 
import { FlexLayoutModule } from '@angular/flex-layout';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { MatProgressButtonsModule } from 'mat-progress-buttons';
import { RegistrationRoutingModule } from '../registration/registration-routing.module';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatButtonModule } from '@angular/material/button';
import { MatButtonToggleModule } from '@angular/material/button-toggle';
import { MatCardModule } from '@angular/material/card';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { MatChipsModule } from '@angular/material/chips';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatDialogModule } from '@angular/material/dialog';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatGridListModule } from '@angular/material/grid-list';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatListModule } from '@angular/material/list';
import { MatMenuModule } from '@angular/material/menu';
import { MatNativeDateModule, MatRippleModule } from '@angular/material/core';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatProgressBarModule } from '@angular/material/progress-bar';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { MatRadioModule } from '@angular/material/radio';
import { MatSelectModule } from '@angular/material/select';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatSliderModule } from '@angular/material/slider';
import { MatSlideToggleModule } from '@angular/material/slide-toggle';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { MatSortModule } from '@angular/material/sort';
import { MatTableModule } from '@angular/material/table';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatTooltipModule } from '@angular/material/tooltip';
import { MatStepperModule } from '@angular/material/stepper';
import { HttpClientModule } from '@angular/common/http';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { MatSelectSearchModule } from '../mat-select-search/mat-select-search.module';
import { PopoverModule } from 'ngx-smart-popover';
import { RecaptchaV3Module } from 'ng-recaptcha';
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { SharedModule } from '@app/@shared/shared.module';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { StaffviewtrainingComponent } from './stafftraining/staffviewtraining/staffviewtraining.component';
import { StaffviewtechnicalComponent } from './stafftechnical/staffviewtechnical/staffviewtechnical.component';
import { StaffinfocardComponent } from './staffinfocard/staffinfocard.component';
import { TransferstaffComponent } from './stafftraining/transferstaff/transferstaff.component';
import { TarnsfertechnicalComponent } from './stafftechnical/tarnsfertechnical/tarnsfertechnical.component';
import { CalendarviewComponent } from './calendarview/calendarview.component';
import { ApprovalcalendarviewComponent } from './approvalcalendarview/approvalcalendarview.component';
import { CalendarModule, DateAdapter } from 'angular-calendar';
import { adapterFactory } from 'angular-calendar/date-adapters/date-fns';
import { AssessoravailabilityComponent } from './assessoravailability/assessoravailability.component';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/staffmanagement/', '.json');
}
export function createdTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/standardcourse/', '.json');
}

@NgModule({
  declarations: [StafftrainingComponent, StafftechnicalComponent, StaffviewtrainingComponent, StaffviewtechnicalComponent, StaffinfocardComponent, TransferstaffComponent, TarnsfertechnicalComponent, CalendarviewComponent, ApprovalcalendarviewComponent, AssessoravailabilityComponent],
  imports: [
    CommonModule,
    ApprovalstaffmanagementRoutingModule,
    MatTabsModule,
    FlexLayoutModule,
    MatProgressButtonsModule,
    RegistrationRoutingModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
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
    MatToolbarModule,
    MatTooltipModule,
    MatStepperModule,
    HttpClientModule,
    CarouselModule,
    MatSelectSearchModule,
    PopoverModule,
    RecaptchaV3Module,
    SharedModule,
    CKEditorModule,
    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createTranslateLoader,
          deps: [HttpClient]
      }
      }),
    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createdTranslateLoader,
          deps: [HttpClient]
      }
      }),
      CalendarModule.forRoot({
        provide: DateAdapter,
        useFactory: adapterFactory,
      }),
  ]
})
export class ApprovalstaffmanagementModule { }
