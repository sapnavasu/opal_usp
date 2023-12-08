import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '@app/@shared';
import { AssessmentreportRoutingModule } from './assessmentreport-routing.module';
import { ViewlearnersComponent } from './viewlearners/viewlearners.component';
import { MatSortModule } from '@angular/material/sort';
import { FlexLayoutModule } from '@angular/flex-layout';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { AssessmentreportComponent } from './assessmentreport/assessmentreport.component';
import { ViewandapproveComponent } from './viewandapprove/viewandapprove.component';
import { ChangeassessorComponent } from './changeassessor/changeassessor.component';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { LearnerfeedbacktableComponent } from './learnerfeedbacktable/learnerfeedbacktable.component';
import { LearnerfeedbackviewComponent } from './learnerfeedbackview/learnerfeedbackview.component';
import { LearnerreglistComponent } from './learnerreglist/learnerreglist.component';
import { LearnerregstrnComponent } from './learnerregstrn/learnerregstrn.component';
import { MatTabsModule } from '@angular/material/tabs'; 
import { MatTableModule } from '@angular/material/table';
import { MatSelectSearchModule } from '../mat-select-search/mat-select-search.module';
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
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatTooltipModule } from '@angular/material/tooltip';
import { MatStepperModule } from '@angular/material/stepper';
import { changecommentmodal } from './modal/changecommentmodal';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { commentmodal } from '../batch/modal/commentmodal';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/maincenter/', '.json');
}

@NgModule({
  declarations: [ViewlearnersComponent, AssessmentreportComponent, ViewandapproveComponent, ChangeassessorComponent,changecommentmodal, LearnerfeedbacktableComponent, LearnerfeedbackviewComponent, LearnerreglistComponent, LearnerregstrnComponent],
  imports: [
    CommonModule,
    SharedModule,
    AssessmentreportRoutingModule,
    MatSortModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    HttpClientModule,
    MatTabsModule,
    MatTableModule,
    MatSelectSearchModule,
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
    CKEditorModule,
    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createTranslateLoader,
          deps: [HttpClient]
      }
  }),
  
  ],
  entryComponents:[commentmodal],
  // exports: [Modalquicksetup,commentmodal]
})
export class AssessmentreportModule { }
