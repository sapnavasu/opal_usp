import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '@app/@shared';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { CertificationapprovalRoutingModule } from './certificationapproval-routing.module';
import { CentrecertificationComponent } from './centrecertification/centrecertification.component';
import { CentredesktopreviewComponent } from './centredesktopreview/centredesktopreview.component';
import { MatTabsModule } from '@angular/material/tabs'; 
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { DocumentsrequiredComponent } from './documentsrequired/documentsrequired.component';
import { FlexLayoutModule } from '@angular/flex-layout';
import { CentrecompanydtlComponent } from './centrecompanydtl/centrecompanydtl.component';
import { CentreinstituteinfoComponent } from './centreinstituteinfo/centreinstituteinfo.component';
import { CentreinternationalComponent } from './centreinternational/centreinternational.component';
import { CentreoperatorcontactsComponent } from './centreoperatorcontacts/centreoperatorcontacts.component';
import { CoursetabdetailComponent } from './coursetabdetail/coursetabdetail.component';
import { StaffdetailtabsComponent } from './staffdetailtabs/staffdetailtabs.component';
import { CentreauditComponent } from './centreaudit/centreaudit.component';
import { SiteauditComponent } from './siteaudit/siteaudit.component';
import { OrganisationComponent } from './siteaudit/organisation/organisation.component';
import { QualitymanagerapprovalComponent } from './qualitymanagerapproval/qualitymanagerapproval.component';
import { OrgansationoverviewComponent } from './organsationoverview/organsationoverview.component';
import { SchedulesiteauditComponent } from './schedulesiteaudit/schedulesiteaudit.component';

import { FinalgradeComponent } from './siteaudit/finalgrade/finalgrade.component';
import { ChangestaffComponent } from './changestaff/changestaff.component';
import { OrganisationqaComponent } from './siteaudit/organisationqa/organisationqa.component';
import { FileuploadwrapperComponent } from './siteaudit/fileuploadwrapper/fileuploadwrapper.component';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { AssessmentreportComponent } from './assessmentreport/assessmentreport.component';
import { InspectioncategoriesComponent } from './inspectioncategories/inspectioncategories.component';
// import { CourseviewComponent } from '../trainingcentremanagement/courseview/courseview.component';
export function createTranslateLoader(http: HttpClient) {
  const timestamp = Date.now();
  return new TranslateHttpLoader(http, './assets/i18n/certificationapproval/', '.json?cache='+timestamp);
}

@NgModule({
  declarations: [CentrecertificationComponent, CentredesktopreviewComponent, DocumentsrequiredComponent,CentrecompanydtlComponent, CentreinstituteinfoComponent, CentreinternationalComponent, CentreoperatorcontactsComponent,CoursetabdetailComponent, StaffdetailtabsComponent, CentreauditComponent, SiteauditComponent, OrganisationComponent,QualitymanagerapprovalComponent, OrgansationoverviewComponent,FinalgradeComponent,SchedulesiteauditComponent, ChangestaffComponent, OrganisationqaComponent, FileuploadwrapperComponent, AssessmentreportComponent, InspectioncategoriesComponent],
  imports: [
    CommonModule,
    CertificationapprovalRoutingModule,
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

  ],
  exports: [
    AssessmentreportComponent
  ]
})
export class CertificationapprovalModule { }
