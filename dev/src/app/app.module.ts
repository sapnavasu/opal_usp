import { Location, LocationStrategy, PathLocationStrategy } from '@angular/common';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { APP_INITIALIZER, NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatPaginatorIntl } from '@angular/material/paginator';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ServiceWorkerModule } from '@angular/service-worker';
import { AuthModule } from '@app/auth';
import { RemoteService } from '@app/remote.service';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { CoreModule } from '@core';
import { environment } from '@env/environment';
import { PerfectScrollbarConfigInterface, PerfectScrollbarModule, PERFECT_SCROLLBAR_CONFIG } from 'ngx-perfect-scrollbar';
import { ToastrModule } from 'ngx-toastr';
import { MenuItems } from './@shared/menu-items/menu-items';
import { SharedService } from './@shared/shared.service';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthGuard } from './auth/auth.guard';
import { AuthService } from './auth/auth.service';
import { AppLocalStorageServices } from './common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from './config/BGIConfig/bgi-jsonconfig-services';
import { CustomMatPaginatorIntl } from './config/BGIConfig/custom-mat-paginator-int';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { MenuService } from '@app/services/menu.service';
import { AppBreadcrumbComponent } from './@shared/breadcrumb/breadcrumb.component';
import { DashboardModule } from './modules/dashboard/dashboard.module';
import { MatProgressButtonsModule } from 'mat-progress-buttons';
import { ReactiveFormsModule } from '@angular/forms';
import { MatInputModule } from '@angular/material/input';
import { MatFormFieldModule } from "@angular/material/form-field";
import { LearnerfeedbackComponent } from './modules/assessmentreport/learnerfeedback/learnerfeedback.component';
// export function HttpLoaderFactory(http: HttpClient): any {
//   return new TranslateHttpLoader(http, './assets/i18n/', '.json');
// }



export function bgiConfigInitFn(bgiJsonService: BgiJsonconfigServices) {
  return () => {
    return bgiJsonService.load();
  };
}
const DEFAULT_PERFECT_SCROLLBAR_CONFIG: PerfectScrollbarConfigInterface = {
  suppressScrollX: true,
  wheelSpeed: 2,
  wheelPropagation: true,
};
@NgModule({
  imports: [
    BrowserModule,
    CKEditorModule,
    ServiceWorkerModule.register('./ngsw-worker.js', { enabled: environment.production }),
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    MatInputModule,
     //TranslateModule.forRoot(),
     TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      },
      isolate: true
    }),
    /* TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      },
      isolate: true
    }), */
    // TranslateModule.forRoot({
    //   loader: {
    //     provide: TranslateLoader,
    //     useFactory: HttpLoaderFactory,
    //     deps: [HttpClient],
    //   },
    // }),
    ToastrModule.forRoot(),
    BrowserAnimationsModule,
    CoreModule,
    AuthModule,
    PerfectScrollbarModule,
    DashboardModule,
    AppRoutingModule, // must be imported as the last module as it contains the fallback route
    MatProgressButtonsModule.forRoot()
  ],
  declarations: [AppComponent, LearnerfeedbackComponent],
  providers: [
    Location, {provide: LocationStrategy, useClass: PathLocationStrategy},
    {
      provide: PERFECT_SCROLLBAR_CONFIG, 
      useValue: DEFAULT_PERFECT_SCROLLBAR_CONFIG,
      useClass: CustomMatPaginatorIntl
    },
    { provide: MatPaginatorIntl, useClass: CustomMatPaginatorIntl },
      AuthService, AuthGuard, RemoteService, AppLocalStorageServices, BgiJsonconfigServices, MenuItems, SharedService,
    {
      provide: APP_INITIALIZER,
      multi: true,
      deps: [BgiJsonconfigServices],
      useFactory: bgiConfigInitFn
    },
    MenuService, TranslateModule
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
/* export function HttpLoaderFactory(http: HttpClient) {
  return new TranslateHttpLoader(http);
} */
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/app/', '.json');
 } 