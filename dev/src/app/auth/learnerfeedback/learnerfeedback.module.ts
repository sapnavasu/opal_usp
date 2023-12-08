import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '@app/@shared';
import { FlexLayoutModule } from '@angular/flex-layout';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';

import { LearnerfeedbackRoutingModule } from './learnerfeedback-routing.module';
import { LearnerfeedbackComponent } from './learnerfeedback/learnerfeedback.component';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/maincenter/', '.json');
}
@NgModule({
  declarations: [LearnerfeedbackComponent],
  imports: [
    CommonModule,
    LearnerfeedbackRoutingModule,
    SharedModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createTranslateLoader,
          deps: [HttpClient]
      }
  }),
  TranslateHttpLoader,
  HttpClientModule,


  ]
})
export class LearnerfeedbackModule { }
