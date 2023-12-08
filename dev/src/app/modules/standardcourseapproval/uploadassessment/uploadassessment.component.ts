import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { ErrorStateMatcher} from '@angular/material/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import moment from 'moment';
import { ApplicationService } from '@app/services/application.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';
import { Encrypt } from '@app/common/class/encrypt';
@Component({
  selector: 'app-uploadassessment',
  templateUrl: './uploadassessment.component.html',
  styleUrls: ['./uploadassessment.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class UploadassessmentComponent implements OnInit {

  uploadassessForm: FormGroup;
  drvInputed: DriveInput;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @ViewChild('awarddoc') awarddocFilee: Filee;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  upload: boolean = false;
  comments: boolean = false;
  showvalidation: boolean;
  staffevaluation_pk: any;
  staffAssessmentValues: any = {};
  disableSubmitButton: boolean;
  disableButton: boolean = false;
  application_id: any;
  previousValue: { selectstatus: number; file_award: any; assessmentcomment: any; };
  appstaffinfotmp_id: any;
  comm: any='';
  constructor(private formBuilder: FormBuilder,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private applicationService: ApplicationService,
    private route: ActivatedRoute,
    private _location: Location,
    private router:Router,
    private security:Encrypt
    ) { }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.route.queryParams.subscribe(param => {
      this.staffevaluation_pk = param['id'];
      this.application_id = param['a'];
      this.appstaffinfotmp_id = param['b'];
    })
    this.getStaffAssessmentStatus();
    this.initializeForm();
    this.drvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    };
    this.uploadassessForm.valueChanges.subscribe(res => {
      console.log(res);
        if(JSON.stringify(res) == JSON.stringify(this.previousValue)) {
          this.disableButton = true;
        }
    })
  }
  getStaffAssessmentStatus() {
    this.disableButton = true;
    this.disableSubmitButton = true;
    let set_id = this.staffevaluation_pk;
    let app_id = this.application_id;
    let asit_id = this.appstaffinfotmp_id;
    this.applicationService.getStaffAssessmentStatus(set_id,app_id,asit_id).subscribe((res:any) => {
      if(res['data']) {
        this.staffAssessmentValues = res['data']['data'];
        console.log(this.staffAssessmentValues);
        let staffevalu = this.security.decrypt(set_id);

        if(staffevalu != 'null' && staffevalu != null && staffevalu != '') {

            if(this.staffAssessmentValues['appsit_appdeccomment'] !=null) {
              this.upload= true;
              this.comments = true;
            }
            if(this.staffAssessmentValues['set_asmtupload'] != null) {
              // this.drvInputed['fileMstPk'] = this.staffAssessmentValues['set_asmtupload'];
              this.drvInputed['selectedFilesPk'] = [this.staffAssessmentValues['set_asmtupload']];
            } else {
              this.drvInputed['selectedFilesPk'] = [];
            }
            this.comm = this.removeTags(this.staffAssessmentValues['appsit_appdeccomment']);
            console.log(this.comm,"this.comm");
          
            let values = {'selectstatus':Number(this.staffAssessmentValues['set_asmtstatus']) ,'file_award':this.staffAssessmentValues['set_asmtupload'],'assessmentcomment':this.comm}
            this.previousValue = values;
            this.uploadassessForm.patchValue(values);
    
            console.log(values,"values");
        }
        
      }
      this.disableSubmitButton = false;
    })
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    
   }

   removeTags(str) {
    if ((str===null) || (str===''))
        return false;
    else
        str = str.toString();
          
    // Regular expression to identify HTML tags in
    // the input string. Replacing the identified
    // HTML tag with a null string.
    return str.replace( /(<([^>]+)>)/ig, '');
}
  initializeForm() {
    this.uploadassessForm = this.formBuilder.group({
      assessmentcomment: [null],
      file_award:[null],
      selectstatus: [null, Validators.required]
    });
  }
  selectedGovernorate(value) {
    if(value == 1 || value==3) {
      this.upload= true;
      this.comments= true;
      this.upassessform.file_award.setValidators([Validators.required]);
      this.upassessform.file_award.updateValueAndValidity();
    }else if (value == 2 || value == 4) {
      this.upload= false;
      this.comments= true;
      this.upassessform.file_award.setValidators(null);
      this.upassessform.file_award.updateValueAndValidity();
      this.upassessform.assessmentcomment.setValidators([Validators.required]);
      this.upassessform.assessmentcomment.updateValueAndValidity();
    }else {
      this.upload= false;
      this.comments= false;
      this.upassessform.assessmentcomment.setValidators(null);
      this.upassessform.assessmentcomment.updateValueAndValidity();
      this.upassessform.file_award.setValidators(null);
      this.upassessform.file_award.updateValueAndValidity();
    }

  }
  get upassessform() { 
    return this.uploadassessForm.controls;
  }

  selectstatusChange(val: any){
    let selectedOption = val.value;
    if(selectedOption == 1){
      this.upassessform.assessmentcomment.setValidators(null);
      this.upassessform.assessmentcomment.updateValueAndValidity();
    } else if(selectedOption == 2) {
      this.upassessform.assessmentcomment.setValidators([Validators.required]);
      this.upassessform.assessmentcomment.updateValueAndValidity();
    } else {
      this.upassessform.assessmentcomment.setValidators(null);
      this.upassessform.assessmentcomment.updateValueAndValidity();
    }
  }
  onCancel() {
    this.showvalidation = false;
    this.uploadassessForm.reset();
  }

  onSubmit() {
    this.showvalidation = true;
    this.disableButton = true;
    console.log(this.uploadassessForm.value);
    let staffevaluationtemp_pk= this.staffevaluation_pk;
    let appstaffinfotmp_id = this.appstaffinfotmp_id;
    this.applicationService.uploadAssessmentReport(staffevaluationtemp_pk,this.uploadassessForm.value,appstaffinfotmp_id).subscribe((res:any) => {
      console.log(res);
      this.disableButton = false;      
      // this._location.back();
      this.router.navigate(['standardcourseapproval/siteaudit'],{ queryParams: {id: this.application_id, tab:1} })
    })
  }

}
