import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
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
import { VehiclemanagementRoutingModule } from './vehiclemanagement-routing.module';
import { VehiclelistingComponent } from './vehiclelisting/vehiclelisting.component';
import { VehicleregisterComponent } from './vehicleregister/vehicleregister.component';
import { VehicleinfoboxComponent } from './vehicleinfobox/vehicleinfobox.component';
import { VehicleinspectionComponent } from './vehicleinspection/vehicleinspection.component';
import { CKEditorModule } from '@app/common/ckeditor';
import { InspectiondetialsComponent } from './inspectiondetials/inspectiondetials.component';
import { ViewapprovalComponent } from './viewapproval/viewapproval.component';
import { VehicleyearpickerComponent } from './vehicleyearpicker/vehicleyearpicker.component';
import { DatePipe } from '@angular/common';
import { VehicleimportComponent } from './vehicleimport/vehicleimport.component';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/vehiclemanagement/', '.json');
}

@NgModule({
  declarations: [VehiclelistingComponent, VehicleregisterComponent, VehicleinfoboxComponent, VehicleinspectionComponent, InspectiondetialsComponent, ViewapprovalComponent, VehicleyearpickerComponent, VehicleimportComponent],
  imports: [
    CommonModule,
    VehiclemanagementRoutingModule,
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
    
],
providers: [DatePipe], 
})
export class VehiclemanagementModule { }
