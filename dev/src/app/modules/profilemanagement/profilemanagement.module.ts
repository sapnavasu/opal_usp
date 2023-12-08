import { MatGoogleMapsAutocompleteModule } from '@angular-material-extensions/google-maps-autocomplete';
import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { FlexLayoutModule } from '@angular/flex-layout';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { DateAdapter } from '@angular/material/core';
import { RouterModule } from '@angular/router';
import { SharedModule } from '@app/@shared';
import { Util } from '@app/@shared/util';
import { CityService } from '@app/common/city/service/city.service';
import { CKEditorModule } from '@app/common/ckeditor';
import { ScriptService } from '@app/common/class/script.load';
import { CurrrencyService } from '@app/common/currency/createcurrency/currrency.service';
import { DateFormat } from '@app/common/directives/date_format';
import { StateService } from '@app/common/state/service/state.service';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { QRCodeModule } from 'angularx-qrcode';
import { PopoverModule } from 'ngx-smart-popover';
import { ImageCropperModule } from '../image-cropper/image-cropper.module';
import { DeptComponent } from './contactinfo/dept/dept.component';
import { ProfileService } from './profile.service';
import { ProfilemanagementRouting } from './profilemanagement-routing.module';
import { WelcomebackComponent } from './welcomeback/welcomeback.component';
import { ContactinformationComponent } from './contactinformation/contactinformation.component';
import { AddcontactComponent } from './contactinformation/addcontact/addcontact.component';

import { NgxDaterangepickerMd } from 'ngx-daterangepicker-material';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';

// AoT requires an exported function for factories
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/profilemanagement/', '.json');
}
@NgModule({
  imports: [
    CommonModule,
    SharedModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule,
    PopoverModule,
    FlexLayoutModule,
    ImageCropperModule,
    MatGoogleMapsAutocompleteModule,
    CKEditorModule,
    RouterModule.forChild(ProfilemanagementRouting),
    QRCodeModule,
    NgxDaterangepickerMd,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  exports: [
    DeptComponent,
  ],
  declarations: [
    DeptComponent,
    WelcomebackComponent,
    ContactinformationComponent,
    AddcontactComponent,

],

  entryComponents: [],
  providers: [
    ProfileService,
    Util,
    CurrrencyService,
    StateService,
    CityService,
    ScriptService, 
    {
      provide: DateAdapter,
      useClass: DateFormat
    },
  ],
})
export class ProfilemanagementModule {
  constructor(private dateAdapter: DateAdapter<Date>) {
    dateAdapter.setLocale('en-in'); // DD/MM/YYYY
  }
}
