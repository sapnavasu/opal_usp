import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DesktopreviewComponent } from './desktopreview/desktopreview.component';
import { CoursedetailsComponent } from './coursedetails/coursedetails.component';
import { SharedModule } from '@app/@shared';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { MatTabsModule } from '@angular/material/tabs'; 
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { FlexLayoutModule } from '@angular/flex-layout';
import { StandardcourseapprovalRoutingModule } from './standardcourseapproval-routing.module';
import { ApprovaldetailsComponent } from './approvaldetails/approvaldetails.component';
import { InternationalrecognitionComponent } from './internationalrecognition/internationalrecognition.component';
import { DocumentrequiredComponent } from './documentrequired/documentrequired.component';
import { StaffapprovalComponent } from './staffapproval/staffapproval.component';
import { ScsiteauditComponent } from './scsiteaudit/scsiteaudit.component';
import { ScsiteaudittabComponent } from './scsiteaudittab/scsiteaudittab.component';
import { StaffpracticaltabComponent } from './staffpracticaltab/staffpracticaltab.component';
import { StaffviewComponent } from './staffview/staffview.component';
import { CKEditorModule } from '@app/common/ckeditor';
import { UploadassessmentComponent } from './uploadassessment/uploadassessment.component';
import { ViewassessmentComponent } from './viewassessment/viewassessment.component';
import { ApprovescsiteauditComponent } from './approvescsiteaudit/approvescsiteaudit.component';

export function createTranslateLoader(http: HttpClient) {
  const timestamp = Date.now(); // Get the current timestamp
  return new TranslateHttpLoader(http, './assets/i18n/standardcourseapproval/', '.json?cache='+timestamp);
}
@NgModule({
  declarations: [DesktopreviewComponent, CoursedetailsComponent, ApprovaldetailsComponent, InternationalrecognitionComponent, DocumentrequiredComponent, StaffapprovalComponent, ScsiteauditComponent, ScsiteaudittabComponent, StaffpracticaltabComponent ,StaffviewComponent, UploadassessmentComponent, ViewassessmentComponent, ApprovescsiteauditComponent],
  imports: [
    CommonModule,
    StandardcourseapprovalRoutingModule,
    SharedModule,
    MatTabsModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    CKEditorModule,

    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createTranslateLoader,
          deps: [HttpClient]
      }
  }),
  ]
})
export class StandardcourseapprovalModule { }
