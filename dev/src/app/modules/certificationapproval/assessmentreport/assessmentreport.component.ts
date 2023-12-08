import { Component, ElementRef, EventEmitter, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { COMMA, ENTER } from '@angular/cdk/keycodes';
import moment from 'moment';
import { ActivatedRoute, Router } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { environment } from '@env/environment';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';
import { Location } from '@angular/common';
import { ToastrService } from 'ngx-toastr'

export const MY_FORMATS = {
  parse: {
    dateInput: 'DD-MM-YYYY',
  },
  display: {
    dateInput: 'DD-MM-YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};

@Component({
  selector: 'app-assessmentreport',
  templateUrl: './assessmentreport.component.html',
  styleUrls: ['./assessmentreport.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class AssessmentreportComponent implements OnInit {
  assessForm: FormGroup;
  @ViewChild('inputElement') inputElement: ElementRef;
  length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  comment: boolean = false;
  public updateAssessment: boolean = false;
  public approvedcmt: boolean = true;
  staffinspectionid: any;
  staffinspectiondata: any;
  disableLoader: boolean;
  staffid: string;
  declinedmessage: boolean;
  catid: string;
  staffeval: any;
  driveimg: any;
  driveimgp: any;
  assessmenttype: string;
  staffevalp: any;
  popContent: string;
  i18n(key) {
    return this.translate.instant(key);
  }
  contact: string = ``;
  assessmentReport: DriveInput;
  public done: boolean = true;
  public knowAssessment: boolean = true;
  public projectpk: any = 4;
  public assessmentState: any;
  public viewComments: boolean = false;
  public uploadAssessment: boolean = false;
  constructor(private translate: TranslateService, private formBuilder: FormBuilder,
    private remoteService: RemoteService,private route: Router,
    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute,
    private applicationservice: ApplicationService,
    public toastr: ToastrService,
    private security: Encrypt,
    private myRoute: Router, private _location: Location, private el: ElementRef,

  ) { }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  config = {
    toolbar: [
      'heading',
      '|',
      'bold',
      'italic',
      '|',
      'bulletedList',
      'numberedList',
      '|',
      'blockquote',
      '|',
      'undo',
      'redo',
    ],
    image: {
      toolbar: [
        'imageStyle:full',
        'imageStyle:side',
        'imageStyle:alignLeft',
        'imageStyle:alignRight',

        '|',
        'imageTextAlternative'
      ],
      styles: [
        // This option is equal to a situation where no style is applied.
        'full',

        'side',

        // This represents an image aligned to the left.
        'alignLeft',

        // This represents an image aligned to the right.
        'alignRight'
      ]
    },
    table: {
      contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties',]
    },
    placeholder: "Type the content here!"
  }
  ngOnInit(): void {
    this.disableLoader = true;
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
    this.assessmentForm();
    this.assessmentReport = {
      fileMstPk: 1,
      selectedFilesPk: []
    };
    this.assessmentState = localStorage.getItem('assessmentState');
    // alert( this.assessmentState)
    this.checkState();
    this.activatedRoute.params.subscribe(params => {
      this.staffinspectionid = this.security.decrypt(params['id']);
      this.staffid = this.security.decrypt(params['staffid']);
      this.catid = this.security.decrypt(params['catid']);
      this.assessmenttype = this.security.decrypt(params['assessmenttype']);
      if(this.assessmenttype == '1'){
        this.knowAssessment = true;
      }else{
        this.knowAssessment = false;
      }
      // this.disableLoader = true;
      this.applicationservice.getinspectionstaffdata(this.staffinspectionid ,this.staffid , this.catid , this.assessmenttype).subscribe(data => {
        this.disableLoader = false;
        this.staffinspectiondata = data.data.data;
        console.log(this.staffinspectiondata.appsit_iscarddetails , 'llsllslls');
       this.staffeval= data.data.staffdata;
       this.staffevalp= data.data.staffevalpractical;
       this.driveimg = data.data.driveimg;
       this.driveimgp = data.data.driveimgp;
       
      if (this.staffeval != null && this.staffeval.set_asmtstatus == 5 ) // approved
      {
        // this.appro = true;
         this.declinedmessage = false;
        // this.decline = false;

        // this.approval_btn = true;
        // this.decline_btn = false;
        // this.fail_btn = false;

        // this.staff_docs = res.data.staff_doc;
        // console.log(this.staff_docs);
        // this.card_percentage = res.data.set_percentage
        // this.card_mark = res.data.set_marksecured;

        // this.card_comments = res.data.appsit_appdeccomment;
        // this.appsit_appdecon = res.data.appsit_appdecon;
        // this.validated_by = res.data.updat_by;
      }
      if (this.staffinspectiondata.staffeval == 6) // approved
      {
         this.declinedmessage = true;
      }


      })
    });
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;

  }
  assessmentForm() {

    this.assessForm = this.formBuilder.group({
      status: ['', Validators.required],
      status_info: ['', ''],
      reportdocument: ['', ''],
      mark: ['', ''],
      percentage: ['', ''],
      comments: ['', Validators.required],
    })

  }
  get form() {
    return this.assessForm.controls;
  }

  editinfo() {
    this.edittechinfo = !this.edittechinfo;
  }
  get f() { return this.assessForm.controls; }

  resinfo() {
    this.assessForm.reset();
    this.assessForm.controls['comments'].reset();
    this.techinfo = "";
    this.contact = '';
    this.done = true;
    this.assessmentReport['selectedFilesPk'] = [];
  }
  addinfo() {
    this.techinfo = this.assessForm.controls['comments'].value;
  }
  messagedone() {
    this.addinfo();
    this.editinfo();
    this.done = false;
  }
  onChangeeditor(event) {
    this.length_Of_ck = $(this.assessForm.controls['comments'].value).text().length;
    this.comments = $(this.assessForm.controls['comments'].value).text();
    if (this.length_Of_ck > 1000) {
      this.assessForm.setErrors({ 'invalid': true });
      this.assessForm.controls['comments'].setErrors({ 'incorrect': true });
    }

  }
  cancelbtn() {
    // if (this.assessForm.touched) {
    //   swal({
    //     title: this.i18n('Do you want to back?'),
    //     text: this.i18n('desktop.doyouwantnote'),
    //     icon: 'warning',
    //     buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
    //     dangerMode: true,
    //     className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
    //     closeOnClickOutside: false
    //   }).then((willGoBack) => {
    //     if (willGoBack) {
    //       this._location.back()
    //       setTimeout(() => {
    //         this.resinfo()
    //        }, 100);
    //     }
    //   })
    // } else {
      this._location.back()
    // }
    // localStorage.setItem('reloadComponent', 'Reload');

  }
  checkValidation() {
    if (this.knowAssessment == true && this.assessForm.controls.status.value == '1') {
      this.assessForm.controls['status_info'].setValidators([Validators.required]);
      this.assessForm.controls['reportdocument'].setValidators([Validators.required]);
      this.assessForm.controls['mark'].setValidators([Validators.required]);
      this.assessForm.controls['percentage'].setValidators([Validators.required]);
    } else if (this.knowAssessment = true && this.assessForm.controls.status.value == '2') {
      this.assessForm.controls['status_info'].clearValidators();
      this.assessForm.controls['reportdocument'].clearValidators();
      this.assessForm.controls['mark'].clearValidators();
      this.assessForm.controls['percentage'].clearValidators();
    }  else if (this.knowAssessment = true && this.assessForm.controls.status.value == '3') {
      this.assessForm.controls['status_info'].clearValidators();
      this.assessForm.controls['reportdocument'].clearValidators();
      this.assessForm.controls['mark'].clearValidators();
      this.assessForm.controls['percentage'].clearValidators();
    }else if (this.knowAssessment == false && this.assessForm.controls.status.value == '4') {
      this.assessForm.controls['status_info'].clearValidators();
      this.assessForm.controls['reportdocument'].setValidators([Validators.required]);
      this.assessForm.controls['mark'].clearValidators();
      this.assessForm.controls['percentage'].clearValidators();
    }  else if (this.knowAssessment == false && this.assessForm.controls.status.value == '5') {
      this.assessForm.controls['status_info'].clearValidators();
      this.assessForm.controls['reportdocument'].clearValidators();
      this.assessForm.controls['mark'].clearValidators();
      this.assessForm.controls['percentage'].clearValidators();
    }  else if (this.knowAssessment == false && this.assessForm.controls.status.value == '6') {
      this.assessForm.controls['status_info'].clearValidators();
      this.assessForm.controls['reportdocument'].clearValidators();
      this.assessForm.controls['mark'].clearValidators();
      this.assessForm.controls['percentage'].clearValidators();
    }
    this.assessForm.controls['status_info'].updateValueAndValidity();
    this.assessForm.controls['reportdocument'].updateValueAndValidity();
    this.assessForm.controls['mark'].updateValueAndValidity();
    this.assessForm.controls['percentage'].updateValueAndValidity();
  }
  submit(types) {
    if (this.assessForm.valid) {
    //if (1) {
    const status = this.assessForm.controls['status'].value;
    const status_info = this.assessForm.controls['status_info'].value;
    const reportdocument = this.assessForm.controls['reportdocument'].value;
    const percentage = this.assessForm.controls['percentage'].value;
    const mark = this.assessForm.controls['mark'].value;
    const comments = this.assessForm.controls['comments'].value;
    if(this.knowAssessment == true) {
      this.popContent = this.i18n('The Knowledge Assessment details have been submitted successfully.')
    } else {
      this.popContent = this.i18n('The Practical Assessment details have been submitted successfully.')
    }
    swal({
      title:  this.popContent,
      text: " ",
      icon: 'success',
      buttons: [false, 'OK' ],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then(() => {
      
        this.disableLoader = true;
          this.applicationservice.inspectionapproved(this.staffinspectionid, this.staffinspectiondata['appostaffinfotmp_pk'], status, status_info, reportdocument, percentage, mark, comments , this.catid,this.staffinspectiondata.appsit_staffinforepo_fk , this.assessmenttype).subscribe(res => {
      this.disableLoader = false;
      //this.commentsandforms = 'commenttype';
    });
    setTimeout(() => {
        this.resinfo()
      }, 1000);
      this._location.back()
      localStorage.setItem('sendSubmitData', types); 
      // this.route.navigate(['trainingcentremanagement/courseviewras/'+this.security.encrypt(id)+'/staff/'+type+'/'+this.security.encrypt(1)]);
    }); 
      // this._location.back()
     

    }
    else {
      this.focusInvalidInput(this.assessForm)
      if (this.assessForm.controls.comments.invalid) {
        this.edittechinfo = true;
      }
    }
  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');

        console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  cancel() {
    if (this.assessForm.touched) {
      swal({
        title: this.i18n('Do you want to cancel?'),
        text: this.i18n('desktop.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.comment = false;
          this.cancelbtn()
          setTimeout(() => {
            this.resinfo();
          }, 100);
        }
      });

    } else {
      this.resinfo();
      this.cancelbtn()
    }
  }
  statustype(getData) {
     if(getData) {
     setTimeout(() => {
      this.techinfo = "";
      this.contact = '';
      this.done = true;
      this.assessmentReport['selectedFilesPk'] = [];
      this.assessForm.controls['status_info'].reset();
      this.assessForm.controls['mark'].reset();
      this.assessForm.controls['percentage'].reset();
      this.assessForm.controls['comments'].reset();
     }, 500);
      this.checkValidation()

     }
  }
  slectSatatus(getStatus) {
    if(getStatus) {
    setTimeout(() => {
      this.techinfo = "";
      this.contact = '';
      this.done = true;
      this.assessmentReport['selectedFilesPk'] = [];
      this.assessForm.controls['mark'].reset();
      this.assessForm.controls['percentage'].reset();
      this.assessForm.controls['comments'].reset();
    }, 500);
    }
  }
  checkState() {
    if(this.assessmentState == 'View') {
      this.viewComments = true;
      this.updateAssessment = false;
    }else if (this.assessmentState == 'Update'){
      this.viewComments = true;
      this.updateAssessment = true;
    }else {
      this.viewComments = false;
      this.updateAssessment = false;
      this.uploadAssessment = true;
    }
  }

 
}
