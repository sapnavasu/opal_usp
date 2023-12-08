import { Component, ElementRef, EventEmitter, Inject, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { ErrorStateMatcher, ThemePalette } from '@angular/material/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { MatPaginator } from '@angular/material/paginator';
import { MatTableDataSource, MatTable } from '@angular/material/table';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { Datadialog } from '@app/modules/registration/supplierreg/supplierreg.component';
import { RemoteService } from '@app/remote.service';
import { BatchService } from '@app/services/batch.service';
import { TranslateService } from '@ngx-translate/core';
import { event } from 'jquery';
import moment from 'moment';
import { CookieService } from 'ngx-cookie-service';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { ToastrService } from 'ngx-toastr';
import { exit } from 'process';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';

export interface BatchtrainingData {
  selecteddate: string;
  id: number;
  schedule: number;
  start: string;
  end: string;
  hrs: string;
}
export interface BatchtrainingDatapract {
  selecteddate: string;
  id: number;
  schedule: number;
  start: string;
  end: string;
  hrs: string;
}
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


import swal from 'sweetalert';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { MatSelect } from '@angular/material/select';
@Component({
  selector: 'app-batchcreationpage',
  templateUrl: './batchcreationpage.component.html',
  styleUrls: ['./batchcreationpage.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class BatchcreationpageComponent implements OnInit {
  stktype: any;
  regpk: any;
  regtype: any;
  branchlist: any;
  tutorlist: any = [];
  dayschedulelist: any;
  accessorslist: any = [];
  branchmainPk: any;
  branchappmainPk: any;
  mainoffappmainPk: any;
  batchtypelist: any = [];
  tutorlanglist: any;
  dateDayArray = [];
  ivqastafflist: any = [];
  ivqastafflistpract: any;
  arr: FormArray;
  assessorcount: number = 0;
  tutorcount: number = 0;
  disableSubmitButton: boolean = false;
  @Input('batchid') batchid: string;
  assigned: any = [];
  userFormPract: FormGroup;
  coursesubcate: any;
  theoryendDate: Date;
  assessostartdate: any = moment();
  assessorDate: Date = new Date();
  mySelections: any;
  practDate: any = moment();
  edit: boolean = false;
  tutorlistpract: any = [];
  theoryschedule: boolean = false;
  practschedule: boolean = false;
  ispracticalenabled: boolean = false;
  assignediv: any = [];
  governoratelist: any = [];
  selectedEstGovernorate: any;
  selectedEstGovernorateAr: any;
  wilayatlist: any = [];
  assessmentin: any;
  assessmentindiff: boolean = false;
  accessorslistall: any = [];
  practtuorvalue: any = [];
  refresher: number = 1;
  minValue: any = new Date();
  maxValue: any = new Date();
  expiry: number = 1;
  ifarabic: boolean = false;

  table1msg: string;
  table2msg: string;
  maininfopk: any;
  branchinfoPk: any;
  maxValueAssessment: any = new Date();
  swaltext: any;
  textexpire: any;
  textexpirecourse: string;
  textexpirebranch: any;
  swaltextcourse: string;
  isfocalpoint: any;
  temppk: any;
  appstatus: any;
  notetext: string;

  i18n(key) {
    return this.translate.instant(key);
  }
  submited: boolean = false;
  @Output() supplieregdata: any = new EventEmitter<any>();
  @Output() certificatehide: any = new EventEmitter<any>();
  //@ViewChildren(MatSelect) selectElements: QueryList<MatSelect>;
  @ViewChild('selectElements', { static: false }) selectElements: MatSelect;
  values = [];
  defaultValue = { hour: 13, minute: 30 };
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;

  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatTable) table: MatTable<any>;
  @ViewChild(MatTable) tablepract: MatTable<any>;
  MRM_CreatedOn = new FormControl('');
  public batchform: FormGroup;
  public timeform: FormGroup;
  public userForm: FormGroup;
  userpractForm: FormGroup;
  batchtraningdata_data: any = [];
  batchtraningdatapract_data: any = [];
  BatchtrainingData = ['selecteddate', 'schedule', 'startendtime'];
  batchtrainingdata: MatTableDataSource<BatchtrainingData>;
  availablepk = 64;
  BatchtrainingDatapract = ['selecteddate', 'schedule', 'startendtime'];
  batchtrainingdatapract: MatTableDataSource<BatchtrainingDatapract>;
  selected2 = moment();
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  alwaysShowCalendars: boolean;
  updated: boolean = true;

  /* Override the label of the ok button. */
  @Input() okLabel = 'Ok';

  /* Override the label of the cancel button. */
  @Input() cancelLabel = 'Cancel';

  /** Override the ante meridiem abbreviation. */
  @Input() anteMeridiemAbbreviation = 'am';

  /** Override the post meridiem abbreviation. */
  @Input() postMeridiemAbbreviation = 'pm';

  /* Sets the clock mode, 12-hour or 24-hour clocks are supported. */
  @Input() mode: '12h' | '24h' = '24h';

  /* Set the color of the timepicker control */
  @Input() color: ThemePalette = 'primary';

  /* Set the value of the timepicker control */
  /* ⚠️(when using template driven forms then you should use [ngModel]="someValue")⚠️ */
  @Input() value: Date = new Date();

  /* Minimum time to pick from */
  @Input() minDate: Date;

  /* Maximum time to pick from */
  @Input() maxDate: Date;

  /* Disables the dialog open when clicking the input field */
  @Input() disableDialogOpenOnClick = false;

  /* Input that allows you to control when the control is in an errored state */
  /* (check out the demo app) */
  @Input() errorStateMatcher: ErrorStateMatcher;

  /* Strict mode checks the full date (Day/Month/Year Hours:Minutes) when doing the minDate maxDate validation. If you need to check only the Hours:Minutes then you can set it to false */
  @Input() strict = true;

  /* Emits when time has changed */
  @Output() timeChange: EventEmitter<any> = new EventEmitter<any>();

  /* Emits when the input is invalid */
  @Output() invalidInput: EventEmitter<any> = new EventEmitter<any>();
  locale: LocaleConfig = {
    format: 'DD-MM-YYYY',
  }
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  date = new FormControl('');
  select = new FormControl('');
  @Input() startDateInput;
  trainingEvalutionCentrelist: any;
  selectedTrCentr: any;
  courselist: any;
  subcategorylist: any;
  categorylist: any;
  days: string;
  minValueDateRange = moment();
  maxValueDateRangetheory = moment();
  maxValueDateRangepractAss = moment();

  startDate = new Date();
  endDate = new Date();
  days2 = ['Sunday', 'Wednesday'];
  startTime = '10:30';
  endTime = '11:30';

  constructor(private fb: FormBuilder,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute,
    private profileService: ProfileService,
    private router: Router,
    protected security: Encrypt,
    private batchService: BatchService,
    private el: ElementRef,
    public dialog: MatDialog,
    private toastr: ToastrService,
    private localstorage: AppLocalStorageServices,
  ) {
    this.alwaysShowCalendars = true;

    this.timeform = this.fb.group({
      employees: this.fb.array([this.newEmployee()])
    });

    this.userForm = this.fb.group({
      phones: this.fb.array([
        this.fb.control(null)
      ])
    })
    this.userpractForm
      = this.fb.group({
        pract: this.fb.array([
          this.fb.control(null)
        ])
      })
    this.minValue.setHours(6, 0, 0);
    this.maxValue.setHours(18, 0, 0);
  }

  ngOnInit(): void {
    this.disableSubmitButton = true;
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.getlastdayofmonth();
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (this.cookieService.get('languageCookieId') == '1') {
        this.ifarabic = false;
      }
      else {
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (this.cookieService.get('languageCookieId') == '1') {
        this.ifarabic = false;
      }
      else {
        this.ifarabic = true;
      }
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (this.cookieService.get('languageCookieId') == '1') {
          this.ifarabic = false;
        }
        else {
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (this.cookieService.get('languageCookieId') == '1') {
          this.ifarabic = false;
        }
        else {
          this.ifarabic = true;
        }
      }
    });
    this.batchform = this.fb.group({
      office_type: ['', Validators.required],
      bran_ch: ['', ''],
      stdcoursedtlsmstpk: ['', Validators.required],
      stdcoursedtlsdltspk: ['', Validators.required],
      coursedtlmainpk: ['', Validators.required],
      stdcoursedtlsmainpk: ['', Validators.required],
      trainingevlocenter: ['', Validators.required],
      applicatiomainpk: ['', Validators.required],
      instinfopk: ['', Validators.required],
      cour_cate: ['', ''],
      cour_subcate: ['', Validators.required],
      batchtype: ['', Validators.required],
      assmntlanauge: ['', Validators.required],
      governorate: ['', ''],
      wilayat: ['', ''],
      theorybatchlimit: ['', Validators.required],
      particalbatchlimit: ['', Validators.required],
      assesmentbatchlimit: ['', Validators.required],
      days: ['', Validators.required],
      dayspract: ['', ''],

      tutor: ['', Validators.required],
      tutorone: ['', Validators.required],
      assessor: ['', ''],
      assessorarr: this.fb.array([this.createItem()]),
      ivqastaff: ['', ''],
      assessmentdate: ['', Validators.required],
      starttimeassessment: ['', Validators.required],
      endtimeasssessment: ['', Validators.required],
      assDate: ['', Validators.required],
      assStartTime: ['', Validators.required],
      assEndTime: ['', Validators.required],
      slots: ['', Validators.required],
      practslots: ['', Validators.required],
      available: ['', ''],
      availabledates: ['', ''],
    });

    this.userForm = this.fb.group({
      sstartdata: [''],
      senddata: [''],
    });

    this.userpractForm = this.fb.group({
      sstarttimepract: [''],
      sendtimepract: [''],
    });

    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
    this.batchtrainingdatapract = new MatTableDataSource<BatchtrainingDatapract>(this.batchtraningdatapract_data);

    this.stktype = this.localstorage.getInLocal('omrm_stkholdertypmst_fk');
    this.regtype = this.localstorage.getInLocal('regtype');
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.disableSubmitButton = true;
    this.getTrainingEvalutionCentres();
    this.getCoursesCatagories();
    this.getTutorslist();
    this.getGoverenoratelist();
    this.getmasterlist();

    if (this.batchid) {
      this.edit = true;

      // this.getBatchdetails(this.batchid);
    }
    this.batchform.controls['tutorone'].valueChanges.subscribe(value => {

      if (value) {

        let index = this.tutorlist.findIndex(x => x.pk == value[0]);

        if (index !== -1) {

          this.coursesubcate = this.tutorlist[index].staffname_en;


        }

      } else {
        this.coursesubcate = '';
      }

    });
  }

  setassessmenttimes() {
    this.setAssessmentDate(this.cour.assessmentdate.value);
    this.setstarttime(this.cour.starttimeassessment.value);
    this.setendtime(this.cour.endtimeasssessment.value);
  }

  setAssessmentDate(value) {
    let assessmentdate = moment(value).format('YYYY-MM-DD').toString();
    this.cour.assDate.setValue(assessmentdate);

  }
  setstarttime(value) {
    if (this.cour.assDate.value) {
      let timeStart = moment(value).format('HH:mm:00').toString();
      this.cour.assStartTime.setValue(this.cour.assDate.value + ' ' + timeStart);

    }

  }
  setendtime(value) {
    if (this.cour.assDate.value) {
      let timeEnd = moment(value).format('HH:mm:00').toString();
      this.cour.assEndTime.setValue(this.cour.assDate.value + ' ' + timeEnd);
    }

  }



  getGoverenoratelist() {
    this.profileService.getstatebyid(31).subscribe(data => {
      this.governoratelist = data.data;

    });
  }

  selectedGovernorate(value) {
    this.governoratelist.forEach(y => {
      if (y.opalstatemst_pk == value) {
        this.selectedEstGovernorate = y.osm_statename_en;
        this.selectedEstGovernorateAr = y.osm_statename_ar;
        this.getwilayatbyid(31, value);
      }
    });
  }

  getwilayatbyid(country, state) {
    this.profileService.getcity(country, state).subscribe(data => this.wilayatlist = data.data);
  }

  createItem() {
    return this.fb.group({
      assessor: ['', Validators.required],
      IVQAStaff: ['', Validators.required]
    })
  }

  addItem() {
    this.arr = this.batchform.get('assessorarr') as FormArray;
    this.arr.push(this.createItem());
  }

  resetassessorArray() {
    this.arr = this.batchform.get('assessorarr') as FormArray;
    this.arr.clear();
    this.arr.push(this.createItem());
    if (this.assessorcount > 1) {
      for (let i = 1; i < this.assessorcount; i++) {
        this.addItem();
      }
    }
  }

  addPhone(rowindex): void {
    const dataArray: any[] = this.batchtrainingdata.data;
    this.batchtrainingdata.data = dataArray;
    this.table.renderRows();
    var selectedindex = dataArray[rowindex];
    selectedindex.subarr.push({
      sstartdata: null,
      senddata: null
    })
    this.batchtrainingdata.data = dataArray;
    this.table.renderRows();
    var subarraypusshedid = selectedindex.subarr.length - 1;
    setTimeout(function () {
      (<HTMLInputElement>document.getElementById('form' + (selectedindex.id - 1) + subarraypusshedid)).value = " ";
      (<HTMLInputElement>document.getElementById('to' + (selectedindex.id - 1) + subarraypusshedid)).value = " ";
    }, 50);

  }


  removePhone(index, rowindex) {
    const dataArray: any[] = this.batchtrainingdata.data;
    var selectedindex = dataArray[rowindex];
    var subselectedindex = selectedindex.subarr;

    selectedindex.subarr.splice(index, 1);
    this.batchtrainingdata.data = dataArray;
    this.table.renderRows();
  }

  getPhonesFormControls(): AbstractControl[] {
    return (<FormArray>this.userForm.get('phones')).controls
  }

  formattedTime = '00:00';
  calculateTimeDifference(z, i, id) {

    var excel = this.batchtraningdata_data;
    setTimeout(function () {
      var endMilliseconds = (<HTMLInputElement>document.getElementById('to' + z + i)).value;
      var startMilliseconds = (<HTMLInputElement>document.getElementById('form' + z + i)).value;
      document.getElementById('difference' + z + i).innerHTML = '00:00';
      const timeParts = startMilliseconds.split(':');
      const timetwo = endMilliseconds.split(':');

      var startTime = new Date();
      startTime.setHours(parseInt(timeParts[0], 10));
      startTime.setMinutes(parseInt(timeParts[1], 10));

      var endTime = new Date();
      endTime.setHours(parseInt(timetwo[0], 10));
      endTime.setMinutes(parseInt(timetwo[1], 10));

      var totalMilliseconds = endTime.getTime() - startTime.getTime();
      const hours = Math.floor(totalMilliseconds / 3600000);
      const minutes = Math.floor((totalMilliseconds % 3600000) / 60000);
      this.formattedTime = `${hours}:${minutes}`;
      document.getElementById('difference' + z + i).innerHTML = this.formattedTime;

      excel[id - 1].subarr[i].sstartdata = startTime.getTime();
      excel[id - 1].subarr[i].senddata = endTime.getTime();
      excel[id - 1].subarr[i].startTime = (moment(excel[id - 1].date).format('YYYY-MM-DD') + ' ' + moment(startTime).format('HH:mm:00'));
      excel[id - 1].subarr[i].endTime = (moment(excel[id - 1].date).format('YYYY-MM-DD') + ' ' + moment(endTime).format('HH:mm:00'));
      excel[id - 1].datestring = (moment(excel[id - 1].date).format('YYYY-MM-DD'));
      this.batchtraningdata_data = excel;

      return false;
    }, 300);

  }

  get cour() { return this.batchform.controls; }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {

    }
  }
  /*createPtGroup() {
    return this.fb.group({
      date:[null],
      available: [null],
      starttime: [null],
    });
  }*/
  checkData(id, value, type) {
    if (type == 'theory') {
      if (value != this.availablepk) {
        this.clearRecordData(id);
      }
      this.batchtraningdata_data[id - 1].schedule = value;
      this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);

      this.table.renderRows();

    }
    if (type == 'pract') {
      if (value != this.availablepk) {
        this.clearRecordDataPract(id);
      }
      this.batchtraningdatapract_data[id - 1].schedule = value;
      this.batchtrainingdatapract = new MatTableDataSource<BatchtrainingDatapract>(this.batchtraningdatapract_data);
      this.tablepract.renderRows();
    }
  }
  employees(value): FormArray {
    return this.timeform.get('employees') as FormArray;
  }

  newEmployee(): FormGroup {
    return this.fb.group({
      pslabel: [null],
    });
  }

  addEmployee(value) {

    this.employees(value).push(this.newEmployee());
  }

  getDateArray(start, end) {
    const arr = [];

    const dt = new Date(start);
    while (dt <= end) {
      arr.push(new Date(dt));
      dt.setDate(dt.getDate() + 1);
    }
    let i = 1;
    for (const val of arr) {
      const fullDateFormat = val;
      let obj = {
        date: fullDateFormat.getTime(),
        day: val.toLocaleDateString('en-US', { weekday: 'long' }),
        selecteddate: val.toLocaleDateString('en-US', { weekday: 'short' }) + ' ' + moment(fullDateFormat).format('DD-MM-YYYY'),
        id: i,
        schedule: 0,
        subarr: [],
      };
      this.batchtraningdata_data.push(obj);
      this.cour.slots.setValue(this.batchtraningdata_data);

      i++;
    }

    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
    this.batchform.controls['days'].setValue(this.batchtraningdata_data.length);
    this.cour.slots.setValue(this.batchtraningdata_data);
    this.getSelectedDayArray();
  }

  getSelectedDayArray() {

    const selectedDayArray = [];
    for (const day of this.days2) {
      for (const val of this.batchtraningdata_data) {
        if (val.day == day) {
          const obj: any = {
            startDateTime: val.date + 'T' + this.startTime,
            endDateTime: val.date + 'T' + this.endTime,
            day: val.day,
          };
          selectedDayArray.push(obj);
        }
      }
    }

  }




  get lessons() {
    return this.batchform.controls["lessons"] as FormArray;
  }


  addLesson(i, event) {

    (<FormArray>this.batchform.get('lessons')).at(i).get('title').setValue(event.value);
  }

  deleteLesson(lessonIndex: number) {
    this.lessons.removeAt(lessonIndex);
  }
  public dateFilterSt: any = '';
  public dateFilterEd: any = '';
  daterange = new FormControl('', Validators.required);
  myForm = new FormGroup({
    daterange: new FormControl('', [Validators.required]),

  });
  dateFltrChange(event) {
    let stDate = '';
    let edDate = '';
    this.dateFilterSt = '';
    this.dateFilterEd = '';
    this.batchform.controls['available'].setValue(null);
    if (this.daterange.value) {
      this.batchtraningdata_data = [];
      let startvaldate = new Date(moment(this.daterange.value.startDate).format('YYYY-MM-DD'));
      let endvaldate = new Date(moment(this.daterange.value.endDate).format('YYYY-MM-DD'));
      // this.assessostartdate = moment(endvaldate).add(1, 'days');
      // this.assessorDate = new Date(this.assessostartdate);
      // this.practDate = this.assessostartdate;
      this.getDateArray(startvaldate, endvaldate);
    }
  }
  cleartableTheory() {
    this.daterange.setValue(null);
    this.cour.days.setValue(null);
    this.cour.slots.setValue(null);
    this.batchtraningdata_data = [];
    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
  }

  backdata() {
    swal({
      title: this.i18n('course.doyouwant'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');
        this.supplieregdata.emit(true);
        this.certificatehide.emit(false);
      }
    });

  }

  getmasterlist() {
    this.batchService.getmasterlist().subscribe(response => {
      if (response.data.status == 1) {
        this.batchtypelist = response.data.data.batch;
        this.tutorlanglist = response.data.data.lang;
        this.dayschedulelist = response.data.data.dayschedule;
        this.dayschedulelist.forEach(element => {
          if (element.name_en == 'Available')
            this.availablepk = element.pk;
        });
      }
      else {
        this.batchtypelist = [];
        this.tutorlanglist = [];
        this.dayschedulelist = [];
      }
    });
  }

  getTutorslist() {
    let encregpk = this.security.encrypt(this.regpk);
    this.batchService.gettutorlist(encregpk).subscribe(response => {
      if (response.data.status == 1) {
        this.tutorlist = response.data.data.tutors;
        this.tutorlistpract = response.data.data.tutors;
        this.accessorslistall = response.data.data.accessors;
        if (this.accessorslistall) {
          this.cour.assessorarr.setErrors([Validators.required]);
        }
      }
      else {
        this.tutorlist = [];
        this.tutorlistpract = [];
        this.accessorslistall = [];
      }
    });
  }

  validateTable(type) {
    let tabledata;
    let flag = '';
    let msg = '';
    let nametype = type == 1 ? 'Theory' : 'Practical';
    let columnname = type == 1 ? 'subarr' : 'subarrpract';
    let slotsname = type == 1 ? 'slots' : 'practslots';
    let daysname = type == 1 ? 'days' : 'dayspract';
    if (this.cour[daysname].value && this.cour[slotsname].value) {
      tabledata = this.cour[slotsname].value;


      Object.keys(tabledata).forEach(keys => {

        if (tabledata[keys].schedule == 0) {
          flag = 'S';
          msg = this.i18n('Please select the Day Schedule in Training Duration (' + nametype + ') table');
        }
        else if ((tabledata[keys].schedule == this.availablepk) && tabledata[keys][columnname].length == 0) {
          flag = 'TA';
          msg = this.i18n('Please add Time slot in Training Duration (' + nametype + ')  table');
        }
        else if ((tabledata[keys].schedule == this.availablepk) && tabledata[keys][columnname].length > 0) {
          tabledata[keys][columnname].forEach(element => {
            if ((element.sstartdata == null || element.sstartdata == 'NaN') || (element.senddata == null || element.senddata == 'NaN')) {
              flag = 'STET';
              msg = this.i18n('Please add Start and End time for the slot in Training Duration (' + nametype + ')  table');
              exit;
            }
          });
        }
      });

    }
    if (flag) {
      if (type == 1) {
        this.table1msg = msg;
      }
      else {
        this.table2msg = msg;
      }
      return false;
    }
    else {
      if (type == 1) {
        this.table1msg = '';
      }
      else {
        this.table2msg = '';
      }
      return true;
    }



  }


  getTutorAvailabilityList(type) {
    if (this.validateTable(type)) {

      var body;

      if (type == 1) {
        body = JSON.stringify({ language: this.cour.assmntlanauge.value, subcategory: this.cour.cour_subcate.value, duration: this.cour.slots.value, coursemainpk: this.cour.coursedtlmainpk.value, regpk: this.cour.trainingevlocenter.value, type: type });
      }
      else {
        body = JSON.stringify({ language: this.cour.assmntlanauge.value, subcategory: this.cour.cour_subcate.value, duration: this.cour.practslots.value, coursemainpk: this.cour.coursedtlmainpk.value, regpk: this.cour.trainingevlocenter.value, type: type });
      }
      this.disableSubmitButton = true;
      this.batchService.gettutoravailabilitylist(body).subscribe(response => {
        this.disableSubmitButton = false;
        if (response.data.status == 1) {

          if (type == 1) {
            this.theoryschedule = true;
            this.tutorlist = response.data.data.tutors;

            this.toastr.success(this.i18n('common.traiduratheo'), ''), {
              timeOut: 2000,
              closeButton: false,
            };

          }
          else {
            this.practschedule = true;
            this.tutorlistpract = response.data.data.tutors;
            this.toastr.success(this.i18n('common.traiduraptac'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }

        }
        else {
          if (type == 1) {
            this.theoryschedule = false;
            this.tutorlist = null;
            this.notheoryselect();
          }
          else {
            this.practschedule = false;
            this.tutorlistpract = null;
            this.nopractselect();
          }
        }
      });
    }

  }

  selectIVQAStaff(value, key) {

    let encregpk = this.security.encrypt(value);
    let body = JSON.stringify({
      pk: encregpk,
      coursepk: this.cour.coursedtlmainpk.value,
      subcate: this.cour.cour_subcate.value,
      language: this.cour.assmntlanauge.value,
      wilayat: this.cour.wilayat.value
    });
    this.batchService.getIVQAStaffByAssessor(body).subscribe(response => {
      if (response.data.status == 1) {
        this.ivqastafflist = response.data.data;
        this.assignediv = [];
      }
      else if (response.data.status == 3) {
        this.ivqastafflist.push(response.data.data);

        let array = this.cour.assessorarr.value;
        Object.keys(array).forEach(keys => {
          if (keys == key) {
            array[key].IVQAStaff = response.data.data.pk;
            this.assignediv[key] = true;
          }

        });
        this.cour.assessorarr.setValue(array);
      }
      else {
        this.staffedselect();
        this.resetassessorArray();
        this.accessorslist = [];
        this.ivqastafflist = [];
        let array = this.cour.assessorarr.value;
        Object.keys(array).forEach(keys => {
          array[keys].IVQAStaff = null;
          this.assignediv[keys] = false;
          array[keys].assessor = null;
          this.assigned[keys] = false;
          // this.checkassessoravailabilty(this.cour.assessmentdate.value);
        });

        this.cour.assessorarr.setValue(array);
        this.accessorslist = [];
        this.ivqastafflist = [];

      }
    });
  }

  


  batchAdd() {
    this.submited = true;
    if (this.tutorcount > 1) {
      if (this.cour.tutorone.value != null && this.tutorcount != this.cour.tutorone.value.length) {
        this.cour.tutorone.setErrors({ count: true });

      }
    }

    if (this.ispracticalenabled == false) {
      this.cour.practslots.setValidators(null);
      this.cour.dayspract.setValue(0);
      this.cour.dayspract.setValidators(null);
      this.cour.tutorone.setValidators(null);
      this.cour.practslots.updateValueAndValidity();
      this.cour.dayspract.updateValueAndValidity();
      this.cour.tutorone.updateValueAndValidity();
      this.cour.particalbatchlimit.setValue(0);
    }
    this.cour.assessorarr.value.forEach(element => {
      if (element.assessor == null || element.IVQAStaff == null) {
        this.cour.assessorarr.setErrors({ required: true })
      }
    });
    if (this.cour.office_type.value == 2) {

      this.cour.bran_ch.setValidators([Validators.required]);
    }
    else {
      this.cour.bran_ch.reset();
      this.cour.bran_ch.setValidators(null);
    }
    if (this.batchform.valid) {
      swal({
        title: this.i18n('course.doyouwantsubm'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('course.no'), this.i18n('course.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.submitData(this.batchform.value);
        }
      });
      return;
    }
    else {
      this.focusInvalidInput(this.batchform);
    }
    this.scrollTo('pagescroll');
  }

  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');

        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  checkifexpiry(value, type, index) {

    let list;
    if (type == 'tutor') {
      list = this.tutorlist;
    }
    else if (type == 'tutorone') {
      list = this.tutorlistpract;
    }
    else if (type == 'assessor') {
      list = this.accessorslist;
    }
    else if (type == 'IVQAStaff') {
      list = this.ivqastafflist;
    }
    list.forEach(z => {
      let notetext = "";
      if(this.isfocalpoint == 2)
        {
          notetext =  this.i18n("Note: Contact your Centre's Focal Point to renew the Staff’s Competency Card.")
        }
      let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
      if(this.isfocalpoint == 2 || this.stktype == 1)
      {
        buttonarray = [false, this.i18n('Ok')];
      }
      else if( this.stktype == 1 || ((type == 'assessor' || type == 'IVQAStaff') && this.assessmentindiff == true) ){
        buttonarray = [false, this.i18n('Ok')];
      }

      if (z.pk == value){

        if (z.is_expired == 1) {
          
            let text = "The 30 days grace period given for renewing the Staff Competency card has expired on "+ z.graceperioddate + ". Hence, you cannot assign the selected staff for this Batch on the OPAL USP.";
          swal({
            title: this.i18n(text),
            text: notetext,
            icon: 'warning',
            dangerMode: true,
            buttons: buttonarray,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (!willGoBack){
              this.router.navigate(['/standardcourse/home'],{ queryParams: 
                {ap: this.security.encrypt(z.temppk),
                renew: this.security.encrypt(1) ,
                pr: this.security.encrypt(2) ,
                ty: this.security.encrypt('renew') ,
                as: this.security.encrypt(z.appstatus) ,
                at: this.security.encrypt(z.apptype)
              }});
            }
          });

          if (type == 'tutor' || type == 'tutorone') {
            this.cour[type].setValue(null);
            this.cour[type].updateValueAndValidity();
          }
          else if (type == 'assessor') {

            let array = this.cour.assessorarr.value;
            console.log(array[index]['assessor']);
            console.log(array[index]);
            array[index]['assessor'] = null;
            this.cour.assessorarr.setValue(array);
            this.cour.assessorarr.updateValueAndValidity();
            console.log(array[index]['assessor']);

          }
          else if (type == 'IVQAStaff') {
            let arrayy = this.cour.assessorarr.value;
            arrayy[index]['IVQAStaff'] = null;
            this.cour.assessorarr.setValue(arrayy);
            this.cour.assessorarr.updateValueAndValidity();
          }


        }
        else {
          let tutortext = '';
          if ((z.is_nearingexpiry == 1 || z.graceperiod == 1)&& z.renewed == 0) {
            
            if (z.graceperiod == 1) {
              tutortext = "The Staff's Competency Card has expired. We have provided a grace period of 30 days to renew the Staff Competency Card. Kindly renew it on or before " + z.graceperioddate + ". If not, you cannot select the staff to conduct any Training/Assessment on the OPAL USP.";
            }
            else if (z.is_nearingexpiry == 1) {
              tutortext = "The selected Staff's Competency Card is going to expire on " + z.nearingdate + ". Kindly submit  the selected Course Certification Form for the Competency Card renewal. If not, you cannot select the staff to conduct any Training/Assessment on the OPAL USP.";
            }
            swal({
              title: this.i18n(tutortext),
              text: notetext,
              icon: 'warning',
              buttons:buttonarray,
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            }).then((willGoBack) => {
              if (!willGoBack){
                this.router.navigate(['/standardcourse/home'],{ queryParams: 
                  {ap: this.security.encrypt(z.temppk),
                  renew: this.security.encrypt(1) ,
                  pr: this.security.encrypt(2) ,
                  ty: this.security.encrypt('renew') ,
                  as: this.security.encrypt(z.appstatus) ,
                  at: this.security.encrypt(z.apptype)
                }});
              }
            });
          }
        }
      }
    });
  }

  checkifstaffselected(value, type, index?: number) {
    this.checkifexpiry(value, type, index);
    let notassessor = false;
    let nottutuor = false;
    let nottutuorpract = false;
    if (type == 'tutor' || type == 'tutorone') {
      notassessor = this.checkifnotassessor(value);
    }
    else if (type == 'assessor' || type == 'IVQAStaff') {
      nottutuorpract = this.checkifnotpracttutor(value);

      if (this.cour.tutor.value == value) {
        nottutuor = true;
      }

    }
    if (notassessor == true || nottutuor == true || nottutuorpract == true) {
      this.samestaff();

      if (type == 'assessor' || type == 'IVQAStaff') {
        let array = this.cour.assessorarr.value;
        Object.keys(array).forEach(keys => {
          if (Number(keys) == Number(index)) {
            array[index][type] = null;
          }
        });
        this.cour.assessorarr.setValue(array);
      }
      this.batchform.controls[type].setValue(null);
    }

  }
  checkifnotpracttutor(value) {
    let variable = false;

    if (Array.isArray(this.cour.tutorone.value)) {
      this.cour.tutorone.value.forEach(element => {

        if (element == value) {
          variable = true;
          exit;
        }

      });
    }
    else {
      if (this.cour.tutorone.value == value) {
        variable = true;
        exit;
      }
    }





    return variable;
  }

  checkifnotassessor(value) {
    let variable = false;
    this.cour.assessorarr.value.forEach(element => {


      if (element.assessor == value) {
        variable = true;
        exit;
      }
      else if (element.IVQAStaff == value) {
        variable = true;
        exit;
      }

    });
    return variable;
  }
  public selectedelement;
  clearRecordData(value) {

    this.batchtraningdata_data.forEach(z => {
      if (z.id === value) {

        this.batchtraningdata_data[value - 1].schedule = 0;
        this.batchtraningdata_data.splice(value - 1, 1);
        let obj = {
          date: z.date,
          day: z.day,
          selecteddate: z.selecteddate,
          id: value,
          schedule: z.schedule,
          subarr: [],
        };
        this.batchtraningdata_data.splice(value - 1, 0, obj);
        this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
        this.batchform.controls['days'].setValue(this.batchtraningdata_data.length);
        this.cour.slots.setValue(this.batchtraningdata_data);

        this.getSelectedDayArray();
        this.table.renderRows();
      }
    });

  }
  clearRecordDataPract(value) {
    this.batchtraningdatapract_data.forEach(z => {
      if (z.id === value) {
        this.batchtraningdatapract_data[value - 1].schedule = 0;
        this.batchtraningdatapract_data.splice(value - 1, 1);
        let obj = {
          date: z.date,
          day: z.day,
          selecteddate: z.selecteddate,
          id: value,
          schedule: z.schedule,
          subarrpract: [],
        };
        this.batchtraningdatapract_data.splice(value - 1, 0, obj);
        this.batchtrainingdatapract = new MatTableDataSource<BatchtrainingDatapract>(this.batchtraningdatapract_data);
        this.batchform.controls['dayspract'].setValue(this.batchtraningdatapract_data.length);
        this.cour.practslots.setValue(this.batchtraningdatapract_data);

        this.getSelectedDayArraypract();
        this.tablepract.renderRows();
      }
    });

  }


  submitData(formvalue) {
    this.cour.slots.setValue(this.batchtraningdata_data);
    this.cour.practslots.setValue(this.batchtraningdatapract_data);


    this.disableSubmitButton = true;
    this.batchService.saveBatchData(formvalue).subscribe(data => {
      if (data.data.status == 1) {
        if (this.edit == true) {
          this.toastr.success(this.i18n('common.btachupdated'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        } else {
          this.toastr.success(this.i18n('common.batccreat'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }

        this.supplieregdata.emit(true);
        this.certificatehide.emit(false);
      } else {
        swal({
          title: this.i18n('common.therprob'),
          text: data['data'].msg,
          icon: 'warning',
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        })
      }

      this.disableSubmitButton = false;
    });
  }

  getCoursesCatagories() {
    this.batchService.getcatlist().subscribe(response => {
      if (response.data.status == 1) {
        this.categorylist = response.data.data;
      }
      else {
        this.categorylist = null;
      }
    });
  }

  getTrainingEvalutionCentres() {

    this.batchService.getTrainingEvalutionCentres().subscribe(response => {
      if (response.data.status == 1) {
        this.disableSubmitButton = false;
        this.trainingEvalutionCentrelist = response.data.data;
        this.trainingEvalutionCentrelist.forEach(z => {
          if (z.regpk == this.regpk) {
            this.cour.trainingevlocenter.setValue(z.regpk);
            this.cour.applicatiomainpk.setValue(z.appmainpk);
            this.cour.instinfopk.setValue(z.instinfopk);
            this.getBranchlist(z.regpk);
            this.mainoffappmainPk = z.appmainpk;
            this.maininfopk = z.instinfopk;
            this.temppk = z.temppk;
            this.appstatus = z.status;

            this.notetext = "";
            if(this.isfocalpoint == 2)
            {
              this.notetext = this.i18n("Note: Contact your Centre's Focal Point to renew the Centre Certification.")
            }

            if (z.issuspended == 1 || z.is_expired == 1) {
              this.maininfopk = null;
              if (z.is_expired == 1) {
                this.swaltext = "The 30 days grace period to renew your Centre Certification has expired. Hence, you cannot create any batches on the OPAL USP.";
              }
              else if (z.issuspended == 1) {
                this.notetext = "";
                this.swaltext = "Centre Certification is Suspended. No New Batch can be created. For queries, contact us at 'usp@opaloman.com'.";
              }
              else {
                this.swaltext = null;
              }
            }

            this.textexpire = null;
            if ((z.is_nearingexpiry == 1 || z.graceperiod == 1) && z.renewed == 0) {
              if (z.graceperiod == 1) {
                this.textexpire = "The Centre Certification has expired. We have provided a grace period of 30 days to renew your Centre Certification. Kindly renew it on or before " + z.graceperioddate + ". If not, you will be unable to create any batches on the OPAL USP until the Centre Certification is renewed.";
              }
              else if (z.is_nearingexpiry == 1) {
                this.textexpire = "The Centre Certification is going to expire on " + z.nearingdate + ". Kindly renew your Centre Certification on or before the specified expiry date. If not, you will be unable to create any batches on the OPAL USP until the Centre Certification is renewed.";
              }
            }
            this.disableSubmitButton = false;

          }
        });
      }
      else {
        this.trainingEvalutionCentrelist = [];
      }
    });
  }

  selectedBranchDtl(value) {
    let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
    if(this.isfocalpoint == 2 || this.stktype == 1)
    {
      buttonarray = [false, this.i18n('Ok')];
    }
    this.branchlist.forEach(z => {
      if (z.appmainpk === value) {
        this.cour.applicatiomainpk.setValue(z.appmainpk);
        this.cour.instinfopk.setValue(z.instinfopk);
        this.branchappmainPk = z.appmainpk;
        this.branchinfoPk = z.instinfopk;
        
        let notetext = "";
          if(this.isfocalpoint == 2)
            {
              notetext = this.i18n("Note: Contact your Centre's Focal Point to renew the Centre Certification.")
            }

        if (z.issuspended == 1 || z.is_expired == 1) {
          let text;
          
           if (z.issuspended == 1) {
            notetext = "";
            this.i18n("Centre Certification is Suspended. No New Batch can be created. For queries, contact us at 'usp@opaloman.com'.")
          }
          else if (z.is_expired == 1) {
            text = this.i18n("The 30 days grace period to renew your Centre Certification has expired. Hence, you cannot create any batches on the OPAL USP.");
          }
          this.branchinfoPk = null;
          swal({
            title: this.i18n(text),
            text: notetext,
            icon: 'warning',
            dangerMode: true,
            buttons:buttonarray,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false,
          }).then((willGoBack) => {
            if (!willGoBack){
              this.router.navigate(['/trainingcentremanagement/branchcentre/MQ=='],{ queryParams: {renew: this.security.encrypt(1), ap: this.security.encrypt(z.temppk) , st: this.security.encrypt(z.status) }});
            }
          });
          this.cour.office_type.setValue(null);
          this.cour.bran_ch.setValue(null);
          this.cour.bran_ch.setValidators(null);
        }
        else {
          this.textexpirebranch = null;
          if ((z.is_nearingexpiry == 1 || z.graceperiod == 1) && z.renewed == 0) {
            if (z.graceperiod == 1) {
              this.textexpirebranch = "The Centre Certification has expired. We have provided a grace period of 30 days to renew your Centre Certification. Kindly renew it on or before " + z.graceperioddate + ". If not, you will be unable to create any batches on the OPAL USP until the Centre Certification is renewed.";
            }
            else if (z.is_nearingexpiry == 1) {
              this.textexpirebranch = "The Centre Certification is going to expire on " + z.nearingdate + ". Kindly renew your Centre Certification on or before the specified expiry date. If not, you will be unable to create any batches on the OPAL USP until the Centre Certification is renewed.";
            }
            if (this.textexpirebranch) {
              swal({
                title: this.i18n(this.textexpirebranch),
                text: notetext,
                icon: 'warning',
                buttons:buttonarray,
                dangerMode: true,
                className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                closeOnClickOutside: false
                
              }).then((willGoBack) => {
                if (!willGoBack){
                  this.router.navigate(['/trainingcentremanagement/branchcentre/MQ=='],{ queryParams: {renew: this.security.encrypt(1), ap: this.security.encrypt(z.temppk) , st: this.security.encrypt(z.status) }});
                }
              });
            }
          }
          this.selectOffice(2);
        }

      }
    });

  }

  selectOffice(value) {

    this.cour.stdcoursedtlsmstpk.setValue(null);
    this.cour.coursedtlmainpk.setValue(null);
    this.cour.cour_cate.setValue(null);
    this.cour.stdcoursedtlsmainpk.setValue(null);

    if (value == 1) {
      if (!this.maininfopk) {
        let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
        if(this.isfocalpoint == 2 || this.stktype == 1)
        {
          buttonarray = [false, this.i18n('Ok')];
        }
        swal({
          title: this.swaltext,
          text: this.notetext,
          icon: 'warning',
          buttons: buttonarray,
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.cour.office_type.setValue(null);
            this.cour.bran_ch.setValue(null);
            this.cour.bran_ch.setValidators(null);
          }
          else {
            this.router.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(1), renew: this.security.encrypt(1) ,ap: this.security.encrypt(this.temppk) ,st: this.security.encrypt(this.appstatus)} });
          }
        });
      }
      else {

        let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
        if(this.isfocalpoint == 2 || this.stktype == 1)
        {
          buttonarray = [false, this.i18n('Ok')];
        }
        if (this.textexpire) {
          swal({
            title: this.i18n(this.textexpire),
            text: '',
            buttons: buttonarray,
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false,
            content: {
              element: 'div',
              attributes: {
                innerHTML: this.notetext,
              }
            }
          }).then((willGoBack) => {
            if (!willGoBack) {
              this.router.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(1), renew: this.security.encrypt(1),ap: this.security.encrypt(this.temppk) ,st: this.security.encrypt(this.appstatus)}  });
            }
          });
        }

        this.getStdCourses(this.maininfopk);
        this.cour.instinfopk.setValue(this.maininfopk);
        this.cour.applicatiomainpk.setValue(this.mainoffappmainPk);
      }

    }
    else {

      if (this.branchinfoPk && this.branchinfoPk != undefined) {
        this.getStdCourses(this.branchinfoPk);
        this.cour.instinfopk.setValue(this.branchinfoPk);
        this.cour.applicatiomainpk.setValue(this.branchappmainPk);
      }

    }
  }

  getBranchlist(regpk) {
    let encregpk = this.security.encrypt(regpk);
    this.batchService.getBranchlistbyregpk(encregpk).subscribe(response => {
      if (response.data.status == 1) {
        this.branchlist = response.data.data;
      }
      else {
        this.branchlist = null;
      }
    })
  }

  getStdCourses(value) {
    let encregpk = this.security.encrypt(value);
    this.courselist = null;
    this.batchService.getStdCoursesByAppPk(encregpk).subscribe(response => {
      if (response.data.status == 1) {

        this.courselist = response.data.data;

      }
      else {
        this.courselist = null;
        swal({
          title: this.i18n('common.noacticour'),
          text: '',
          icon: 'warning',
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
      }
    });
  }

  selectedCourseDtls(value) {
    this.courselist.forEach(z => {
      if (z.pk == value) {
        this.selectedTrCentr = z.course_en;
        this.cour.coursedtlmainpk.setValue(z.appcoursemainpk);
        this.cour.cour_cate.setValue(z.scm_coursecategorymst_fk);
        this.cour.stdcoursedtlsmainpk.setValue(z.stdcoursedtlsmainpk);
        let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
          let notetext = "";
          if(this.isfocalpoint == 2 || this.stktype == 1)
          {
            buttonarray = [false, this.i18n('Ok')];
            notetext = this.i18n(" Note: Contact your Centre's Focal Point to renew the Course Certification.")
          }
        

        if (z.issuspended == 1 || z.isOverdue == 1 || z.is_expired == 1) {
          this.maininfopk = null;
          
           if (z.issuspended == 1) {
            notetext = "";
            buttonarray = [false, this.i18n('Ok')];
            this.swaltextcourse = "Course Certification is Suspended. New Batch can be created towards this Course.For queries, contact us at 'usp@opaloman.com'.";
          }
          else if (z.isOverdue == 1) {
            notetext = "";
            buttonarray = [false, this.i18n('Ok')];
            this.swaltextcourse = "A Batch cannot be created for this selected Course at the Centre because the Royalty Fee Payment is Overdue.";
          }
          else if (z.is_expired == 1) {
            this.swaltextcourse = "The 30 days grace period to renew your Course Certification has expired on "+ z.graceperioddate + ". Hence, you cannot create any batches on the OPAL USP.";
          }
          else {
            this.swaltextcourse = null;
          }
        
          
        swal({
          title:this.i18n(this.swaltextcourse),
          text: notetext,
          icon: 'warning',
          buttons: buttonarray,
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.cour.stdcoursedtlsmstpk.setValue(null);
            this.cour.coursedtlmainpk.setValue(null);
            this.cour.cour_cate.setValue(null);
            this.cour.stdcoursedtlsmainpk.setValue(null);
          }
          else {
            this.router.navigate(['/standardcourse/home'],{ queryParams: 
              {ap: this.security.encrypt(z.temppk),
              renew: this.security.encrypt(1) ,
              pr: this.security.encrypt(2) ,
              ty: this.security.encrypt('renew') ,
              as: this.security.encrypt(z.appstatus) ,
              at: this.security.encrypt(z.apptype)
            }});
          }
        });

        }
        else {
          
          this.textexpirecourse = null;
          if ((z.is_nearingexpiry == 1 || z.graceperiod == 1) && z.renewed==0) {
            if (z.graceperiod == 1) {
              this.textexpirecourse = "The Course Certification has expired. We have provided a grace period of 30 days to renew your Course Certification. Kindly renew it on or before " + z.graceperioddate + ". If not, you will be unable to create any batches on the OPAL USP until the Course Certification is renewed.";
            }
            else if (z.is_nearingexpiry == 1) {
              this.textexpirecourse = "The Course Certification is going to expire on " + z.nearingdate + ". Kindly renew your Course Certification on or before the specified expiry date. If not, you will be unable to create any batches on the OPAL USP until the Course Certification is renewed.";
            }

            if (this.textexpirecourse) {
              swal({
                title:this.i18n(this.textexpirecourse),
                text: notetext,
                icon: 'warning',
                buttons: buttonarray,
                dangerMode: true,
                className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                closeOnClickOutside: false
              }).then((willGoBack) => {
                if (!willGoBack) {
                  this.router.navigate(['/standardcourse/home'],{ queryParams: 
                    {ap: this.security.encrypt(z.temppk),
                    renew: this.security.encrypt(1) ,
                    pr: this.security.encrypt(2) ,
                    ty: this.security.encrypt('renew') ,
                    as: this.security.encrypt(z.appstatus) ,
                    at: this.security.encrypt(z.apptype)
                  }});
                }
              });
            }
          }
          this.getsubcategorylist(z.scm_coursecategorymst_fk, z.appcoursemainpk);
        }
      }
    });


  }

  getsubcategorylist(value, apppk) {
    let catPk = this.security.encrypt(value);
    let enapppk = this.security.encrypt(apppk);
    this.batchService.getsubcatlistbycatpk(catPk, enapppk).subscribe(response => {
      if (response.data.status == 1) {
        this.subcategorylist = response.data.data;
        if (this.cour.cour_cate.value) {
          this.selectedSubCat(this.cour.cour_cate.value);
        }
      }
      else {
        this.subcategorylist = null;
      }
    });
  }

  selectedSubCat(value) {

    this.subcategorylist.forEach(z => {

      if (z.coursecategorymst_pk == value) {
        this.cour.cour_subcate.setValue(value);
        this.getcoursedtls(value);
      }
    });


  }



  resetstaffs() {
    this.cour.tutor.reset();
    this.cour.tutorone.reset();
    this.resetassessorArray();
    this.coursesubcate = null;
    this.assigned = [];
    this.assignediv = [];
    this.tutorcount = 0;
    this.practschedule = false;
    this.theoryschedule = false;
  }

  checkcount() {
    if (this.cour.tutorone.value.length <= this.tutorcount) {
      this.practtuorvalue = this.cour.tutorone.value;
    }
    else {
      if (this.practtuorvalue) {
        this.cour.tutorone.setValue(this.practtuorvalue);
      }
    }
  }
  getcoursedtls(subcatpk) {
    let ensubcatpk = this.security.encrypt(subcatpk);
    this.batchService.getCourseDtlsbysubcatpk(ensubcatpk).subscribe(res => {
      if (res.data.status == 1) {
        this.resetstaffs();
        this.cour.stdcoursedtlsdltspk.setValue(res.data.data.pk);

        let theorylimit = Number(res.data.data.thyclasslimit);
        let practcallimit = Number(res.data.data.practclasslimit);
        let assessmentlimit = Number(res.data.data.asmtbatchlimit);
        this.expiry = 1;
        this.refresher = 1;
        this.refresher = Number(res.data.data.isrefresherpract);
        this.expiry = Number(res.data.data.iscertexpiry);
        this.batchtypelist = res.data.data.batchtypelist;
        this.cour.batchtype.setValue(null);
        this.assessmentindiff = res.data.data.scm_assessmentin == '17' ? true : false;

        if (this.assessmentindiff == true) {
          this.cour.governorate.setValidators([Validators.required]);
          this.cour.wilayat.setValidators([Validators.required]);
        }
        else {
          this.cour.governorate.setValidators(null);
          this.cour.wilayat.setValidators(null);
        }
        this.cour.governorate.updateValueAndValidity();
        this.cour.wilayat.updateValueAndValidity();
        this.ispracticalenabled = true;

        if (practcallimit > 0) {
          this.ispracticalenabled = true;
          this.cour.practslots.setValidators([Validators.required]);
          this.cour.dayspract.setValidators([Validators.required]);
          this.cour.tutorone.setValidators([Validators.required]);
        }
        else {
          this.ispracticalenabled = false;
          this.cour.practslots.setValidators(null);
          this.cour.dayspract.setValue(0);
          this.cour.dayspract.setValidators(null);
          this.cour.tutorone.setValidators(null);
        }
        this.cour.practslots.updateValueAndValidity();
        this.cour.practslots.updateValueAndValidity();
        this.cour.tutorone.updateValueAndValidity();
        this.batchform.patchValue({
          stdcoursedtlsdltspk: res.data.data.pk,
          theorybatchlimit: theorylimit,
          particalbatchlimit: practcallimit,
          assesmentbatchlimit: assessmentlimit,

        });

        this.resetassessorArray();
        this.assessorcount = 1;
        if (theorylimit / assessmentlimit != 1) {
          this.assessorcount = ((theorylimit % assessmentlimit) == 0 ? (theorylimit / assessmentlimit) : (theorylimit / assessmentlimit) + 1);
          for (let i = 1; i < this.assessorcount; i++) {
            this.addItem();
          }
        }
        this.resetassessorArray();
        if (theorylimit / practcallimit != 1) {
          this.tutorcount = ((theorylimit % practcallimit) == 0 ? (theorylimit / practcallimit) : (theorylimit / practcallimit) + 1);

          if (this.tutorcount > this.tutorlist.length && practcallimit > 0) {
            swal({
              title: this.i18n('common.thernotenou'),
              text: '',
              icon: 'warning',
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            });
          }
        }
        else {
          this.tutorcount = 1;
        }
      }
      else {
        swal({
          title: this.i18n('common.nocourfoun'),
          text: '',
          icon: 'warning',
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
      }
    });
  }

  selectedTrainingCentre(value) {

    this.mainoffappmainPk = null;
    this.branchappmainPk = null;
    this.trainingEvalutionCentrelist.forEach(z => {
      if (Number(z.regpk) == value) {

        this.cour.trainingevlocenter.setValue(value);
        this.cour.applicatiomainpk.setValue(z.appmainpk);
        this.cour.instinfopk.setValue(z.instinfopk);
        this.getBranchlist(value);
        this.mainoffappmainPk = z.appmainpk;
        this.maininfopk = z.instinfopk;
        this.selectedTrCentr = z.compname_en;
        // this.getStdCourses(z.instinfopk);
      }
    });
  }

  addbatchdatatime(data, ps) {

  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('course.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('course.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  opendialogquicksetup() {
    const dialogRef = this.dialog.open(Modalquicksetup, {
      disableClose: true,
      panelClass: 'quicksetuplist',
    });
    //dialogRef.componentInstance.drawer = this.drawercontactus;
    dialogRef.afterClosed().subscribe((result) => {

    });
  }
  //practical
  getDateArraypract(startvaldatepract, endvaldatepract) {

    const arr = [];

    const dt = new Date(startvaldatepract);
    while (dt <= endvaldatepract) {
      arr.push(new Date(dt));
      dt.setDate(dt.getDate() + 1);
    }
    let i = 1;
    for (const val of arr) {
      const fullDateFormat = val;
      let obj = {
        date: fullDateFormat.getTime(),
        day: val.toLocaleDateString('en-US', { weekday: 'long' }),
        selecteddate: val.toLocaleDateString('en-US', { weekday: 'short' }) + ' ' + moment(fullDateFormat).format('DD-MM-YYYY'),
        id: i,
        schedule: 0,
        subarrpract: [],
      };
      this.batchtraningdatapract_data.push(obj);
      this.cour.practslots.setValue(this.batchtraningdatapract_data);
      i++;
    }


    this.batchtrainingdatapract = new MatTableDataSource<BatchtrainingDatapract>(this.batchtraningdatapract_data);
    this.batchform.controls['dayspract'].setValue(this.batchtraningdatapract_data.length);
    this.cour.practslots.setValue(this.batchtraningdatapract_data);
    this.getSelectedDayArraypract();
  }
  getSelectedDayArraypract() {

    const selectedDayArray = [];
    for (const day of this.days2) {
      for (const val of this.batchtraningdatapract_data) {
        if (val.day == day) {
          const obj: any = {
            startDateTime: val.date + 'T' + this.startTime,
            endDateTime: val.date + 'T' + this.endTime,
            day: val.day,
          };
          selectedDayArray.push(obj);
        }
      }
    }

  }



  public dateFilterStpractical: any = '';
  public dateFilterEdpractical: any = '';
  daterangepractical = new FormControl('', Validators.required);
  dateFltrChangepractical(event) {

    let stDate = '';
    let edDate = '';
    this.dateFilterStpractical = '';
    this.dateFilterEdpractical = '';
    if (this.daterangepractical.value) {

      this.batchtraningdatapract_data = [];
      let startvaldatepract = new Date(moment(this.daterangepractical.value.startDate).format('YYYY-MM-DD'));
      let endvaldatepract = new Date(moment(this.daterangepractical.value.endDate).format('YYYY-MM-DD'));
      // this.assessostartdate = moment(endvaldatepract).add(1, 'days');
      // this.assessorDate = new Date(this.assessostartdate);
      this.getDateArraypract(startvaldatepract, endvaldatepract);
    }
  }
  cleartablepractical() {
    this.daterangepractical.setValue(null);
    this.cour.dayspract.setValue(null);
    this.cour.practslots.setValue(null);
    this.batchtraningdatapract_data = [];
    this.batchtrainingdatapract = new MatTableDataSource<BatchtrainingDatapract>(this.batchtraningdatapract_data);

  }
  formattedTimed = '00:00';
  calculateTimeDifferencepract(p, i, id) {
    var excelpract = this.batchtraningdatapract_data;
    setTimeout(function () {
      var endMilliseconds = (<HTMLInputElement>document.getElementById('topract' + p + i)).value;
      var startMilliseconds = (<HTMLInputElement>document.getElementById('formpract' + p + i)).value;
      document.getElementById('differencepract' + p + i).innerHTML = '00:00';
      const timeParts = startMilliseconds.split(':');
      const timetwo = endMilliseconds.split(':');

      var startTime = new Date();
      startTime.setHours(parseInt(timeParts[0], 10));
      startTime.setMinutes(parseInt(timeParts[1], 10));

      var endTime = new Date();
      endTime.setHours(parseInt(timetwo[0], 10));
      endTime.setMinutes(parseInt(timetwo[1], 10));
      var totalMilliseconds = endTime.getTime() - startTime.getTime();
      const hours = Math.floor(totalMilliseconds / 3600000);
      const minutes = Math.floor((totalMilliseconds % 3600000) / 60000);
      this.formattedTimed = `${hours}:${minutes}`;
      document.getElementById('differencepract' + p + i).innerHTML = this.formattedTimed;

      excelpract[id - 1].subarrpract[i].sstartdata = startTime.getTime();
      excelpract[id - 1].subarrpract[i].senddata = endTime.getTime();
      excelpract[id - 1].subarrpract[i].startTime = (moment(excelpract[id - 1].date).format('YYYY-MM-DD') + ' ' + moment(startTime).format('HH:mm:00'));
      excelpract[id - 1].subarrpract[i].endTime = (moment(excelpract[id - 1].date).format('YYYY-MM-DD') + ' ' + moment(endTime).format('HH:mm:00'));
      excelpract[id - 1].datestring = (moment(excelpract[id - 1].date).format('YYYY-MM-DD'));

      this.batchtraningdatapract_data = excelpract;

      return false;
    }, 300);
  }

  addPract(rowindex): void {
    const dataArray: any[] = this.batchtrainingdatapract.data;
    var selectedindex = dataArray[rowindex];
    selectedindex.subarrpract.push({
      sstartdata: null,
      senddata: null
    })
    this.batchtrainingdatapract.data = dataArray;
    this.tablepract.renderRows();
  }

  removePract(index, rowindex) {
    const dataArray: any[] = this.batchtrainingdatapract.data;
    var selectedindex = dataArray[rowindex];
    var subselectedindex = selectedindex.subarrpract;

    selectedindex.subarrpract.splice(index, 1);
    this.batchtrainingdatapract.data = dataArray;
    this.tablepract.renderRows();
  }

  getpractFormControls(): AbstractControl[] {
    return (<FormArray>this.userpractForm.get('pract')).controls
  }

  validatepractical() {
    if (this.ispracticalenabled == false) {
      this.cour.practslots.setValidators(null);
      this.cour.dayspract.setValue(0);
      this.cour.dayspract.setValidators(null);
      this.cour.tutorone.setValidators(null);
    }
    else {
      this.cour.practslots.setValidators([Validators.required]);
      this.cour.dayspract.setValue(0);
      this.cour.dayspract.setValidators([Validators.required]);
      this.cour.tutorone.setValidators([Validators.required]);
    }
    this.cour.practslots.updateValueAndValidity();
    this.cour.dayspract.updateValueAndValidity();
    this.cour.tutorone.updateValueAndValidity();
  }

  checkassessoravailabilty(datevalue) {
    let date = moment(datevalue).format('YYYY-MM-DD');
    this.validatepractical();
    this.setassessmenttimes();
    if (date && datevalue && this.batchform['controls'].starttimeassessment.valid && this.batchform['controls'].endtimeasssessment.valid) {

      let encdate = this.security.encrypt(date);

      if (this.cour.wilayat.valid) {
        if (this.cour.coursedtlmainpk.valid && this.cour.assmntlanauge.valid) {
          let body = JSON.stringify({
            assdate: encdate,
            coursepk: this.cour.coursedtlmainpk.value,
            languagepk: this.cour.assmntlanauge.value,
            regpk: this.regpk,
            subcate: this.cour.cour_subcate.value,
            wilayat: this.cour.wilayat.value,
            start: this.cour.assStartTime.value,
            end: this.cour.assEndTime.value,
            numberofassessor: this.assessorcount
          });
          this.batchService.checkassessoravailabilty(body).subscribe(response => {

            if (response.data.status == 1) {

              this.accessorslist = response.data.data;

              this.assigned = [];

            }
            else if (response.data.status == 3) {
              let key = 0;
              this.accessorslist = response.data.data;
              let array = this.cour.assessorarr.value;
              Object.keys(array).forEach(keys => {
                if (Number(keys) == Number(key)) {

                  array[key].assessor = response.data.data[Number(key)].pk;
                  this.assigned[key] = true;
                  this.selectIVQAStaff(response.data.data[Number(key)].pk, keys);
                }
                key = Number(key) + 1;
              });
              this.cour.assessorarr.setValue(array);

            }
            else if (response.data.status == 4) {
              this.durationselect2();
              this.resetassessorArray();
              this.assigned = [];
              this.accessorslist = [];

            }
            else if (response.data.status == 5) {
              this.assessorivqa();
              this.resetassessorArray();
              this.assigned = [];
              this.accessorslist = [];
            }
            else {
              this.durationselect();
              this.resetassessorArray();
              this.assigned = [];
              this.accessorslist = [];
            }
          });
        }
        else {
          swal({
            title: this.i18n(' Select the Course Title and Tutoring & Assessment Language'),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
        }
      }
      else {
        swal({
          title: this.i18n('Select the Wilayat'),
          text: '',
          icon: 'warning',
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
      }

    }

  }


  duration() {
    this.toastr.success(this.i18n('common.setupcon'), ''), {
      timeOut: 2000,
      closeButton: false,
    };
  }
  cancduration() {
    swal({
      title: this.i18n('common.durasetup'),
      text: this.i18n('common.ifyes'),
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');

      }
    });
  }
  samestaff() {
    swal({
      title: this.i18n('The same personnel cannot be selected as a Tutor/Trainer, Assessor, IV/QA Staff. Please select a different personnel.'),
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');

      }
    });
  }
  alreadyselect() {
    swal({
      title: this.i18n('common.contone'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }

  assignedselect() {
    swal({
      title: this.i18n('common.conttwo'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  //changes
  staffedselect() {
    swal({
      title: this.i18n('common.contthree'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  theoryselect() {
    swal({
      title: 'Attention: The Trainers (<Trainer A>, <Trainer B>) who were allocated to conduct the theory class have been assigned to another Batch. Please select a different Trainer.',
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  notheoryselect() {
    swal({
      title: this.i18n('common.notrailer'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  nopractselect() {
    swal({
      title: this.i18n('common.attennotrail'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  Practicalselect() {
    swal({
      title: 'Attention: The Trainers (<Trainer A>, <Trainer B>) who were allocated to conduct the Practical Class have been assigned to another Batch. Please select a different Trainer.',
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  durationselect() {
    swal({
      title: this.i18n('common.attennoasses'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  assessorivqa() {
    swal({
      title: this.i18n('There are no Assessor and IV/QA Staff available in the Same Centre on the Portal.'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  durationselect2() {
    swal({
      title: this.i18n('common.attennoassesnew'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  datetimeselect() {
    swal({
      title: this.i18n('common.attentime'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('course.ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    })
  }
  submission() {
    swal({
      title: this.i18n('common.doyouwant'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');

      }
    });
  }
  batchcreat() {
    swal({
      title: this.i18n('common.doyoucancel'),
      text: this.i18n('common.ifyes'),
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');

      }
    });
  }
  notify() {
    swal({
      title: this.i18n('common.batchcan'),
      text: this.i18n('common.doyouwantlear'),
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');

      }
    });
  }

  getlastdayofmonth() {
    var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var nextmonthlastDay = new Date(date.getFullYear(), date.getMonth() + 2, 0);
    this.maxValueAssessment = nextmonthlastDay;
    this.maxValueDateRangetheory = moment(lastDay);
    this.maxValueDateRangepractAss = moment(nextmonthlastDay);
  }


  selectedBatchtype(value) {
    console.log(value);
    console.log(this.refresher);
    console.log(this.expiry);
    console.log(this.ispracticalenabled);
    if (this.ispracticalenabled == true) {
      if (value == 25 && this.refresher != 1) {
        this.ispracticalenabled = false;
        this.cour.practslots.setValidators(null);
        this.cour.dayspract.setValue(0);
        this.cour.dayspract.setValidators(null);
        this.cour.tutorone.setValidators(null);
      }
      else {
        this.ispracticalenabled = true;
        this.cour.practslots.setValidators([Validators.required]);
        this.cour.dayspract.setValidators([Validators.required]);
        this.cour.tutorone.setValidators([Validators.required]);
      }
      this.cour.practslots.updateValueAndValidity();
      this.cour.practslots.updateValueAndValidity();
      this.cour.tutorone.updateValueAndValidity();
    }

    else if (this.ispracticalenabled == false && value == 24 && this.refresher == 2 && this.expiry == 1) {
      this.ispracticalenabled = true;
      this.cour.practslots.setValidators([Validators.required]);
      this.cour.dayspract.setValidators([Validators.required]);
      this.cour.tutorone.setValidators([Validators.required]);
      this.cour.practslots.updateValueAndValidity();
      this.cour.practslots.updateValueAndValidity();
      this.cour.tutorone.updateValueAndValidity();
    }
  }
}

const quickset_data: quicksetupdatalist[] = [
  { position: 1 },
];



export interface quicksetupdatalist {
  position: any;

}


@Component({
  selector: 'modalquicksetup',
  templateUrl: './modalquicksetup.html',
  styleUrls: ['./modalquicksetup.scss'],
  encapsulation: ViewEncapsulation.None,
})



export class Modalquicksetup {
  public batchform: FormGroup;
  quicksetupdatalist = new MatTableDataSource<quicksetupdatalist>(quickset_data);
  quicksetupcolumn = ['days', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
  constructor(
    public dialogRef: MatDialogRef<Modalquicksetup>,
    private remoteService: RemoteService,
    private el: ElementRef,
    private translate: TranslateService,
    private cookieService: CookieService,
    private fb: FormBuilder,
    @Inject(MAT_DIALOG_DATA) public data: Datadialog
  ) {
  }
  lang = '1';
  get cour() { return this.batchform.controls; }
  dir = 'ltr';
  selectedItems: any;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  ngOnInit() {
    this.batchform = this.fb.group({
      starttime: ['', Validators.required],
      endtime: ['', Validators.required],
      employees: ['', ''],


    })
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
  }

  employees(): FormArray {
    return this.batchform.get('employees') as FormArray;
  }

  newEmployee(): FormGroup {
    return this.fb.group({
      starttime: [null, ''],
      endtime: [null, ''],
      weekend: ['', '']
    });
  }
  @ViewChild('scroll', { read: ElementRef }) public scroll: ElementRef<any>;
  closedialog(): void {
    this.dialogRef.close();
  }
  addEmployee() {
    this.employees().push(this.newEmployee());
  }

  removeEmployee(empIndex: number) {
    this.employees().removeAt(empIndex);
  }
}

function getDay() {
  throw new Error('Function not implemented.');
}
