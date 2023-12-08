import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '@app/@shared';
import { CandidatemanagementRoutingModule } from './candidatemanagement-routing.module';
import { Modalprintsetup, LearnerslistComponent } from './learnerslist/learnerslist.component';
import { MatSortModule } from '@angular/material/sort';
import { LearnerRegisterComponent } from './learner-register/learner-register.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
//import { MatFileUploadModule } from 'angular-material-fileupload';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { FlexLayoutModule } from '@angular/flex-layout';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/candidatemanagement/', '.json');
}



@NgModule({
  declarations: [Modalprintsetup,LearnerslistComponent, LearnerRegisterComponent],
  imports: [
    CommonModule,
    SharedModule,
    CandidatemanagementRoutingModule,
    MatSortModule,
    ReactiveFormsModule,
    FormsModule,
    MatDatepickerModule,
    FlexLayoutModule,
    //MatFileUploadModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }) 
  ]
})
export class CandidatemanagementModule { }
