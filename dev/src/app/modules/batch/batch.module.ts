import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { BatchRoutingModule } from './batch-routing.module';
import { BatchcreationpageComponent, Modalquicksetup } from './batchcreationpage/batchcreationpage.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { MaterialModule } from '@app/material.module';
import { FlexLayoutModule } from '@angular/flex-layout';
import { SharedModule } from '@app/@shared';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { PerfectScrollbarModule } from 'ngx-perfect-scrollbar';
import { PopoverModule } from 'ngx-smart-popover';
import { GalleryModule } from '@ngx-gallery/core';
import { Ng5SliderModule } from 'ng5-slider';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { BatchviewpageComponent } from './batchviewpage/batchviewpage.component';
import { BatchgridlistingComponent } from './batchgridlisting/batchgridlisting.component';
import { CKEditorModule } from '@app/common/ckeditor';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/batch/', '.json');
}

@NgModule({
  declarations: [BatchgridlistingComponent, BatchcreationpageComponent, BatchviewpageComponent,Modalquicksetup],
  imports: [
    CommonModule,
    BatchRoutingModule,
    ReactiveFormsModule,
    FormsModule,
    HttpClientModule,
    FlexLayoutModule,
    SharedModule,
    CarouselModule,
    PerfectScrollbarModule,
    PopoverModule,
    GalleryModule,
    Ng5SliderModule,
    CKEditorModule,

    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  ],
  entryComponents:[Modalquicksetup],
  exports: [Modalquicksetup],
})
export class BatchModule { }
