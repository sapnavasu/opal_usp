import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FlexLayoutModule } from '@angular/flex-layout';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { DateAdapter } from '@angular/material/core';
import { RouterModule } from '@angular/router';
import { MaterialModule } from '@app/material.module';
import { GalleryModule } from '@ngx-gallery/core';
import { Ng5SliderModule } from "ng5-slider";
import { SharedModule } from '@shared/shared.module';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { PerfectScrollbarModule } from 'ngx-perfect-scrollbar';
import { PopoverModule } from "ngx-smart-popover";
import { DashboardeRouting } from './dashboard-routing.module';
import { SupplierComponent } from './supplier/supplier.component';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { MainofficecertificateComponent } from './supplier/supplierwidgets/mainofficecertificate/mainofficecertificate.component';
import { BranchofficecertificateComponent } from './supplier/supplierwidgets/branchofficecertificate/branchofficecertificate.component';
import { CourseinformationComponent } from './supplier/supplierwidgets/courseinformation/courseinformation.component';
import { OverallstaffinfoComponent } from './supplier/supplierwidgets/overallstaffinfo/overallstaffinfo.component';
import { BatchmanagmentComponent } from './supplier/supplierwidgets/batchmanagment/batchmanagment.component';
import { InvoicemanagmentComponent } from './supplier/supplierwidgets/invoicemanagment/invoicemanagment.component';
import { RoyaltyfreeinvoiceComponent } from './supplier/supplierwidgets/royaltyfreeinvoice/royaltyfreeinvoice.component';
import { PendinglistaccordionComponent } from './supplier/supplierwidgets/pendinglistaccordion/pendinglistaccordion.component';
import { TmainofficecertificateComponent } from './supplier/supplierwidgets/tmainofficecertificate/tmainofficecertificate.component';
import { ToverallstaffinfoComponent } from './supplier/supplierwidgets/toverallstaffinfo/toverallstaffinfo.component';
import { IvmspendinglistaccordionComponent } from './supplier/supplierwidgets/ivmspendinglistaccordion/ivmspendinglistaccordion.component';
import { TbranchofficecertificateComponent } from './supplier/supplierwidgets/tbranchofficecertificate/tbranchofficecertificate.component';
import { PortaladminComponent } from './portaladmin/portaladmin.component';
import { TrainingcertifyComponent } from './portaladmin/portalwidgets/trainingcertify/trainingcertify.component';
import { StandardcertifyComponent } from './portaladmin/portalwidgets/standardcertify/standardcertify.component';
import { PortalinvoicemngmntComponent } from './portaladmin/portalwidgets/portalinvoicemngmnt/portalinvoicemngmnt.component';
import { PortalbatchmngmntComponent } from './portaladmin/portalwidgets/portalbatchmngmnt/portalbatchmngmnt.component';
import { CentrecertifyComponent } from './portaladmin/portalwidgets/centrecertify/centrecertify.component';
import { PortaltechbatchmngmntComponent } from './portaladmin/portalwidgets/portaltechbatchmngmnt/portaltechbatchmngmnt.component';
import { JourneymapComponent } from './journeymap/journeymap.component';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/dashboard/', '.json');
}

@NgModule({
  declarations: [SupplierComponent, MainofficecertificateComponent, BranchofficecertificateComponent, CourseinformationComponent, OverallstaffinfoComponent, BatchmanagmentComponent, InvoicemanagmentComponent, RoyaltyfreeinvoiceComponent, PendinglistaccordionComponent, TmainofficecertificateComponent, ToverallstaffinfoComponent, IvmspendinglistaccordionComponent, TbranchofficecertificateComponent, PortaladminComponent, TrainingcertifyComponent, StandardcertifyComponent, PortalinvoicemngmntComponent, PortalbatchmngmntComponent, CentrecertifyComponent, PortaltechbatchmngmntComponent, JourneymapComponent],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    FormsModule,
    HttpClientModule,
    MaterialModule,
    FlexLayoutModule,
    RouterModule.forChild(DashboardeRouting),
    SharedModule,
    CarouselModule,
    PerfectScrollbarModule,
    PopoverModule,
    GalleryModule,
    Ng5SliderModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
    // ScfModule
],
exports: [],

entryComponents: [],

providers: [],

})
export class DashboardModule {
  constructor(private dateAdapter: DateAdapter<Date>) {
		dateAdapter.setLocale('en-in'); // DD/MM/YYYY
	}
 }
