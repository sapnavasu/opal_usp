import { Component, OnInit, ViewEncapsulation, ViewChild, ElementRef, HostListener } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { LiveAnnouncer } from '@angular/cdk/a11y';
import { MatSort, Sort } from '@angular/material/sort';
import { SelectionModel } from '@angular/cdk/collections';
import { FormGroup, FormBuilder, FormControl, FormArray, Validators } from '@angular/forms';
import { LearnerService } from '@app/services/learner.service';
import { Subject } from 'rxjs';
import { Observable } from 'rxjs/Observable';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { SharedService } from '@app/@shared/shared.service';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { MatTableDataSource } from '@angular/material/table';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { ActivatedRoute, ParamMap, Router, RouterModule } from '@angular/router';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { MatCheckboxChange } from '@angular/material/checkbox';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import moment from 'moment';
import { ToastrService } from 'ngx-toastr';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { catchError, map, startWith, switchMap } from 'rxjs/operators';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { commentmodal } from '../../batch/modal/commentmodal';
import { BatchService } from '@app/services/batch.service';

// import { MatFileUploadQueueComponent } from 'angular-material-fileupload';


// export interface workInfo {

// }

const today = new Date();
const month = today.getMonth();
const year = today.getFullYear();
export interface Batchinfo {
  staffworkexp_pk: string;
  sexp_employername: string;
  sexp_doj: string;
  sexp_currentlyworking: string;
  sexp_eod: string;
  sexp_opalcountrymst_fk: string;
  sexp_opalstatemst_fk: string;
  sexp_opalcitymst_fk: string;
  sexp_designation: string;
  sexp_createdon: string;
  sexp_updatedon: string;
  action: number;
}

const ELEMENT_DATA: Batchinfo[] = [
  // { coursename: 'Standard Courses', ctotal: '18', ccertify: '07', cactive: '14', cnearingexpiry: '08', cexpired: '03', csuspended: '' },
  //   { coursename: 'Customized Courses', ctotal: '12', ccertify: '04', cactive: '10', cnearingexpiry: '04', cexpired: '02', csuspended: '' },
  //   { coursename: 'Customized Courses', ctotal: '12', ccertify: '04', cactive: '10', cnearingexpiry: '04', cexpired: '02', csuspended: '' }
];

export interface Tile {
  color: string;
  cols: number;
  rows: number;
  text: string;
}

export interface EduInfo {
  sacd_institutename: string;
  sacd_degorcert: string;
  edu_level: any;
  sacd_grade: string;
  grade: any;
  certificatedoc: any;
  sacd_createdon: string,
  sacd_updatedon: string
  action: number;
}
export interface batch_details {
  company_name: string;
}

export interface Learnerreg {
  coursepro:string;
  coursecat: string;
  traincent: string;
  assesscenter: string;
  expdate: string;  
  status: string;
  action: string;
}

const LEARNERREG_DATA: Learnerreg[] = [
  {coursepro:'Cyber Security', coursecat: 'Computer Science', traincent: 'Al Aradoom Trading Co. LLC', assesscenter: 'Fortune Prommosveen LLC', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Database Administration', coursecat: 'Cobots', traincent: 'Fortune Prommosveen LLC', assesscenter: 'Alixir Medical System LLC', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Computer Programming Language', coursecat: 'Computer Science', traincent: 'Alixir Medical System LLC', assesscenter: 'Oriental Control System', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Artificial Intelligence', coursecat: 'Cobots', traincent: 'Oriental Control System', assesscenter: 'Oriental Control System', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Cyber Security', coursecat: 'Cobots', traincent: 'Al Aradoom Trading Co. LLC', assesscenter: 'Al Aradoom Trading Co. LLC', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Computer Programming Language', coursecat: 'Computer Science', traincent: 'Fortune Prommosveen LLC', assesscenter: 'Fortune Prommosveen LLC', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Database Administration', coursecat: 'Computer Science', traincent: 'Oriental Control System', assesscenter: 'Al Aradoom Trading Co. LLC', expdate: '15-2-2023', status: 'Active', action:''},
  // {coursepro:'Database Administration', coursecat: 'Computer Science', traincent: 'Fortune Prommosveen LLC', assesscenter: 'Oriental Control System', expdate: '15-2-2023', status: 'Active', action:''},
];

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
  selector: 'app-learner-register',
  templateUrl: './learner-register.component.html',
  styleUrls: ['./learner-register.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class LearnerRegisterComponent implements OnInit {
  tblplaceholder: boolean;
  educationformshow: any = false;
  workexpformshow: any = false; 
  fileeselectederror: boolean = false; 
  i18n(key) {
    return this.translate.instant(key);
  }
  disableSubmitButton: boolean;
  displayedColumns2: string[] = ['sexp_employername', 'sexp_doj', 'sexp_currentlyworking', 'sexp_designation', 'sexp_createdon', 'sexp_updatedon', 'action'];

  displayEducation: string[] = ['sacd_institutename', 'sacd_degorcert', 'sacd_startdate', 'sacd_enddate', 'sacd_grade', 'added_on', 'last_updated_on', 'action'];
  // educationList = ['sacd_institutename', 'sacd_degorcert', 'sacd_startdate', 'sacd_enddate', 'sacd_grade', 'sacd_createdon', 'sacd_updatedon', 'action'];
  // workExperienceList = ['sexp_employername', 'sexp_doj', 'sexp_currentlyworking', 'sexp_designation', 'sexp_createdon', 'sexp_updatedon', 'action'];
  educationList = ['sacd_institutename', 'sacd_degorcert','rm_name_en', 'end_date', 'sacd_grade', 'certificatedoc','created_on', 'updated_on', 'action'];
  workExperienceList = ['sexp_employername', 'start_date', 'sexp_currentlyworking','ocym_countryname_en', 'osm_statename_en', 'ocim_cityname_en', 'sexp_designation', 'upload_certificate' , 'created_on', 'updated_on', 'action'];
  opaldisplayedColumns = ['scm_coursename_en', 'ccm_catname_en', 'traningprovider', 'assesscenter', 'lcd_cardexpiry', 'lcd_status'];
  learnerregdataSource = new MatTableDataSource<Learnerreg>(LEARNERREG_DATA);
  postCreated: any;
  Post: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  ifarabic: boolean = false;
  public interRecListDataStaffbas: MatTableDataSource<any>;
  page: number = 10;
  public interRecListDataStaffwork: MatTableDataSource<any>;
  searchcountry: string = '';
  stafflevel_list:any[] = [];
  showpayment: boolean = false;
  showpaymentdone: boolean = false;
  public opr_list: any;
  batch_number: any;
 course_no: any;learner_pk: any;learviewstatus: boolean = false;  default: boolean = true;
  @ViewChild('photodoc') photodoc: Filee;
  @ViewChild('cividoc') cividoc: Filee;
  @ViewChild('licensedoc') licensedoc: Filee;
  @ViewChild('table1') sort: MatSort;
  public loaderformlearner: boolean = false;
 civilstatus: any;   public deleteicon: boolean = true;
  public viewform: boolean = false;  locale: LocaleConfig = {
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

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }



  tiles: Tile[] = [
    { text: 'Training Evaluation Center: National Training Institute', cols: 1, rows: 1, color: 'lightblue' },
    { text: 'Batch No: 126465', cols: 1, rows: 1, color: 'lightpink' },
    { text: 'Batch Type: Initial', cols: 1, rows: 1, color: '#DDBDF1' },
  ];

  batchdata_data = null;
  company: string;
  batch_no: string;
  batchmgmtdtls: string;

  search: Tile[] = [
    { text: '', cols: 1, rows: 1, color: 'lightblue' },
    { text: '', cols: 1, rows: 1, color: 'lightpink' },
    { text: '', cols: 1, rows: 1, color: '#DDBDF1' },
  ];


  @ViewChild('exppaginator') exppaginator: MatPaginator;
  @ViewChild('edu_paginator') edu_paginator: MatPaginator;
  @ViewChild('learnerpaginator') learnerpaginator: MatPaginator;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) edusort: MatSort;
  @ViewChild('table1', { read: MatSort, static: true }) expsort: MatSort;

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  value!: any;
  filter: any = false;
  expFilter: any = false;
  edufilter: any = false;
  hidefilder: boolean = true;
  shownotetext: boolean = true;
  filtername = 'show filter';
  profilePhoto: DriveInput;
  educationInput: DriveInput;
  cividId: DriveInput;
  licenseCard: DriveInput;
  WorkInput: DriveInput;
  countrylist: any[] = [];
  stateList: any[] = [];
  cityList: any[] = [];
  eStateList: any[] = [];
  expStateList: any[] = [];
  eCityList: any[] = [];
  expCityList: any[] = [];
  searchstate: string = '';
  searchcity: string = '';
  esearchcountry: string = '';
  esearchstate: string = '';
  esearchcity: string = '';
  edu_page: number = 5;
  exp_page: number = 5;
  notAllow: boolean = false;
  showroplicense: boolean = false;
  lightlicenseradio: boolean = false;
  heavylicenseradio: boolean = false;
  selection = new SelectionModel<Batchinfo>(true, []);

  maxDate = new Date();

  issueDate = new Date();

  learner_fees:string = "";

  filterValues = {
    sacd_enddate: "",
    sacd_startdate: "",
    added_on: "",
    last_updated_on: ""
  }
  worktilled: boolean = true;

  staffrep_id: any;
  country_list: any;
  state_list: any;
  city_list: any;
  state_tut_list: any;
  city_tut_list: any;
  state_work_list: any;
  city_work_list: any;
  staffeduedit: boolean = false;
  staffworkedit: boolean = false;
  nonoman: boolean = true;
  oman: boolean = true;
  public finalsavedata: any;
  public age: any;
  getcert: any;
  @ViewChild('table5', {read: MatSort}) sortEdu: MatSort;
  @ViewChild('table6', {read: MatSort}) sortWork: MatSort;
  selectedDate: any;
  filter1:string;
  // public notallowedone: boolean = false;
  warnUserBeforeLeavingPage = true;
  @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
    if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
    }
  }
  

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService, private _liveAnnouncer: LiveAnnouncer,
    private formBuilder: FormBuilder,
    private learnerService: LearnerService,
    public sharedservice: SharedService,
    public appService: ApplicationService,
    private route: ActivatedRoute,
    private assessmentService: AssessmentReportService,
    private routes: ActivatedRoute,
    private router: Router,
    public toastr: ToastrService,
    private appservice : ApplicationService,
    private el: ElementRef,
    private http: HttpClient,
    private localStorage: AppLocalStorageServices,
    public dialog: MatDialog,
    private batchService: BatchService,
  ) { }

  formGroup: FormGroup;
  learnerdata_data: Batchinfo[];
  learnerdata: MatTableDataSource<Batchinfo>;
  educationdata_data: EduInfo[];
  educationdata: MatTableDataSource<EduInfo>;

  sel_sacd_startdate: string = "";
  sel_sacd_enddate: string = "";
  sel_added_on: string = "";
  sel_last_updated_on: string = "";

  filterForm = new FormGroup({
    sacd_institutename: new FormControl(),
    sacd_degorcert: new FormControl(),
    sacd_startdate: new FormControl(),
    sacd_enddate: new FormControl(),
    sacd_grade: new FormControl(),
    added_on: new FormControl(),
    last_updated_on: new FormControl(),
  });

  public staffFormedu: FormGroup;
  public staffworkexperienceForm: FormGroup;
  public courseselectForm: FormGroup;
  public Contentplaceloader: boolean = false;
  public updatesupplierinfo: boolean = false;
  mainIntrGridDatasStaffbas: MainStaffbasPagination;
  mainIntrGridDatasStaffwork: MainStaffworkPagination;
  private querystr: string;
  searchControl: FormControl = new FormControl('');
  public memReg: any;
  public appdtlssavetmp_id: any;
  resultsLengthStaffbas: number;
  resultsLengthStaff: number;
  resultsLengthStaffwork: number;
  resultsLengthLearner:number ;
  filtersts:boolean = true;
  noDataone:  any = '';
  noDatatwo:  any = '';
  noDatathree:  any = '';
  noDatafour:  any = '';
  noDatafive:  any = '';
  fileeselect:boolean = false;
  get sacd_startdate() {
    return this.filterForm.get('sacd_startdate');
  }

  get sacd_enddate() {
    return this.filterForm.get('sacd_enddate');
  }

  get added_on() {
    return this.filterForm.get('added_on');
  }

  get sacd_updatedon() {
    return this.filterForm.get('sacd_updatedon');
  }

  isfocalpoint;
  stktype;
  role;
  regpk;
  userPk;
  batchreadaccess: boolean = false;
  batchdeleteaccess: boolean = false;
  batchupdateaccess: boolean = false;
  learnercreateaccess: boolean = false;
  batchapproveaccess: boolean = false;
  learnerdownloadaccess: boolean = false;
  userassessment: boolean = false;
  useraccess;

  ngOnInit() {

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
       }else{
        this.filtername = "إخفاء التصفية"
             }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.filtername = "Hide Filter";
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.filtername = "Hide Filter";
         }else{
          this.filtername = "إخفاء التصفية"
         }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
    });
    this.memReg = this.localStorage.getInLocal('reg_pk');
    this.regpk = this.localStorage.getInLocal('registerPk');
    this.userPk = this.localStorage.getInLocal('userPk');
    this.stktype = this.localStorage.getInLocal('stktype');
    this.role = this.localStorage.getInLocal('role');
    this.isfocalpoint = this.localStorage.getInLocal('isfocalpoint');
    this.useraccess = this.localStorage.getInLocal('uerpermission');

    if(this.isfocalpoint == 1){
      this.batchreadaccess = true;
      this.batchdeleteaccess = true;
      this.batchupdateaccess = true;
      this.learnercreateaccess = true;
      this.batchapproveaccess = true;
      this.learnerdownloadaccess = true;
      this.userassessment = true;
    }
    if(this.isfocalpoint == 2){
      let moduleid = this.localStorage.getaccessmoduleid(this.stktype, 'Batch Management');
      let submodulebatch = this.stktype == 1 ? 4 : 21 ;
      let submodulelearner = this.stktype == 1 ? 5 : 22 ;
      let submodulelearnerattendence = this.stktype == 1 ? 6 : 23 ;
      let submodulelearnerassessment = this.stktype == 1 ? 7 : 24 ;
      

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerattendence] && this.useraccess[moduleid][submodulelearnerattendence].download == 'Y'){//Learner Attendance
        this.learnerdownloadaccess = true;
      }

      //batch
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].read == 'Y'){
        this.batchreadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].delete == 'Y'){
        this.batchdeleteaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].update == 'Y'){
        this.batchupdateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].approval == 'Y'){
        this.batchapproveaccess = true;
      }

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].create == 'Y'){
        this.learnercreateaccess = true;
      }

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerassessment] && this.useraccess[moduleid][submodulelearnerassessment].create == 'Y'){//Learner Assessment
        this.userassessment = true;
      }
      // if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].download == 'Y'){
      //   this.learnerdownloadaccess = true;
      // }
    }

    this.reactiveForm();

    

    this.profilePhoto = {
      fileMstPk: 17,
      selectedFilesPk: []
    };

    this.cividId = {
      fileMstPk: 13,
      selectedFilesPk: []
    }

    this.licenseCard = {
      fileMstPk: 13,
      selectedFilesPk: []
    }

    this.getCountry();

    this.getbranchinfo();

    this.routes.paramMap.subscribe((params: ParamMap) => {
      let param: any = {
        bid: params.get('batch')
      }
      this.batch_number = params.get('batch');
      this.course_no = params.get('course');
      this.learner_pk = params.get('learner');      
      this.getbatchdtls(params.get('batch'));

      this.getLearnerCourseFee(param);
      //this.disableSubmitButton = true;
      this.learnerService.getbranchinfo(param).subscribe(data => {
        // this.batchDetail = data.data.data
        this.disableSubmitButton = false;
        this.company = data.data.data.branch_info.omrm_companyname_en
        this.batch_no = data.data.data.batch_info.bmd_Batchno;
        this.batchmgmtdtls = data.data.data.batch_info.batchmgmtdtls_pk;
      })
    })
    this.educationInput = {
      fileMstPk: 16,
      selectedFilesPk: []
    };
    this.WorkInput = {
      fileMstPk: 16,
      selectedFilesPk: []
    };
    this.maxDate.setFullYear(new Date().getFullYear() - 18);

    this.issueDate.setFullYear(new Date().getFullYear());

    this.getState(31);

    this.egetState(31)

    this.formSubscribe();
    // this.getEduList(293);
    // this.getExpList(293);
    this.staffleveldropdown();

    this.formvalidated();

    this.countrydropdown();

    this.gerOpr();

    //Staff Edu th tab Search starts here
    this.institute = new FormControl('');
    this.institute.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.degree = new FormControl('');
    this.degree.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.year_join = new FormControl('');
    this.year_join.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.edu_level_search = new FormControl('');
    this.edu_level_search.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.year_pass = new FormControl('');
    this.year_pass.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.grade = new FormControl('');
    this.grade.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.add_On = new FormControl('');
    this.add_On.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )

    this.Last_Date = new FormControl('');
    this.Last_Date.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);   
        }    
      }
    )
    //Staff Edu th tab Search Ends here

    //Staff Work th tab Search starts here
    this.oranisation = new FormControl('');
    this.oranisation.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.date_joined = new FormControl('');
    this.date_joined.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.work_till = new FormControl('');
    this.work_till.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.count = new FormControl('');
    this.count.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )
    this.gover = new FormControl('');
    this.gover.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )
    this.wilaya = new FormControl('');
    this.wilaya.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.designation = new FormControl('');
    this.designation.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.add_edOn = new FormControl('');
    this.add_edOn.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.add_On = new FormControl('');
    this.add_On.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )

    this.date_last = new FormControl('');
    this.date_last.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);   
        }    
      }
    )
    //Staff Work th tab Search Ends here

    if(this.learner_pk && this.learner_pk != null){
      //this.formGroup.controls['sir_idnumber'].setValue('qeqe');
      this.learview(this.learner_pk);
      this.learviewstatus = true;
      this.deleteicon = false;
      this.viewform = true;
      setTimeout(() => {
        this.formGroup.disable();
        this.staffFormedu.disable();
        this.staffworkexperienceForm.disable();
        this.courseselectForm.disable();
      },1000);
    }

    

  }

  institute = new FormControl('');
  degree = new FormControl('');
  year_join = new FormControl('');
  year_pass = new FormControl('');
  edu_level_search = new FormControl('');
  yearpass = new FormControl('');
  grade = new FormControl('');
  add_On = new FormControl('');
  Last_Date = new FormControl('');

  oranisation = new FormControl('');
  date_joined = new FormControl('');
  work_till = new FormControl('');
  designation = new FormControl('');
  add_edOn = new FormControl('');
  count = new FormControl('');
  gover = new FormControl('');
  wilaya = new FormControl('');
  date_last = new FormControl('');

  backtoviewlear(){
    if(this.learviewstatus == false){
      swal({
        title: this.i18n('Changes you made may not be saved.'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('Cancel'), this.i18n('Ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.router.navigate(['/candidatemanagement/viewlearner/' + this.batch_number])        
        }
      });
    }
    else{
      this.router.navigate(['/candidatemanagement/viewlearner/' + this.batch_number])
    }
      
  }
  fileeSelectededucate(file, fileId) {
    //alert(file)
    fileId.selectedFilesPk = file;
    
    this.staffFormedu.controls['education_files'].setValue(file[0]);
   }
   workedfileeSelected(file, fileId) {
    //alert(file)
    fileId.selectedFilesPk = file;
    
    this.staffworkexperienceForm.controls['file_workexperience'].setValue(file[0]);
   }
  formvalidated() {
      this.staffFormedu = this.formBuilder.group({
        institute_name: ['', Validators.required],
        degree_cert: ['', Validators.required],  
        edut_level:  ['', Validators.required],
        GradeDate:  ['', Validators.required],
        gpa_grade: ['', Validators.required],

        education_files:  ['', Validators.required],
        stfrepo: ['', ''],
        staffacademics_pk: ['', ''],
        learner: ['1', ''],
       
      }),

      this.staffworkexperienceForm = this.formBuilder.group({
        'oragn_name': ['', Validators.required],
        'date_join': ['', Validators.required],

        'workdate': ['', ],
        //selectcourses: ['', Validators.required],
        'curr_work': [''],
        // employ_locate:  ['', Validators.required],
        'employ_country': ['', Validators.required],
        'employ_state': ['', Validators.required],
        'employ_city': ['', Validators.required],
        'designat': ['', Validators.required],
        'file_workexperience': [''],
        'sexp_staffinforepo_fk': ['', ''],
        'staffworkexp_pk': ['', ''],
        'learnerwork': ['1', ''],
      }),
      this.courseselectForm = this.formBuilder.group({
        'learner_fee': ['', Validators.required],
        'learner_fee_status': ['', Validators.required],
        'paid_by': ['', ''],
        'total_year': ['', Validators.required],
        'company_name': ['', ''],
        'learnerreghrddtls_pk': ['', ''],
        'staff_repo': ['', ''],
      })
  }
  get stafedu() { if(this.staffFormedu != undefined) { return this.staffFormedu.controls; } }
  get work() { if(this.staffworkexperienceForm != undefined) { return this.staffworkexperienceForm.controls; } }
  get course() { if(this.courseselectForm != undefined) { return this.courseselectForm.controls; } }

  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        console.log(key);
        if (invalidControl)
        {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  cityselect(country) {
    // this.citylabel = this.staffForm.controls.inst_city.value == 1 ? this.i18n('staff.gove') : this.i18n('staff.state');
    if(country == 31) {
     this.oman =  true;
     console.log(true)
    }
    else  if(country = 31) {
      this.oman =  false;
      // console.log(false)
    }
  }

  cityselecttwo(countrytwo) {
    if(countrytwo == 31) {
      this.nonoman =  true;
     }
     else if(countrytwo != 31){
       this.nonoman =  false;
     }
  }
  isCheckboxDisabled: boolean = false;
  cleardate: boolean = false;
  dateSelected(event: MatDatepickerInputEvent<Date>) {
    const selectedDate: Date = event.value;
  if (selectedDate) {
     this.isCheckboxDisabled = true;
     this.cleardate = true;
     this.worktilled = true;
    }
  }
  clearDate() {
   this.staffworkexperienceForm.controls.workdate.reset();
   this.isCheckboxDisabled = false;
   this.cleardate = false;
  }
  notallowed: boolean = false;
//  notallowed: boolean = false;
onCheckboxChange(event: MatCheckboxChange) {
  if (event.checked) {
   this.notallowed = true;
   this.staffworkexperienceForm.controls.workdate.reset();
   this.worktilled = false;
   this.staffworkexperienceForm.controls['workdate'].setErrors(null);
   this.cleardate = false;

  } else {
    this.notallowed = false;
    this.staffworkexperienceForm.controls['workdate'].setErrors({'incorrect': true });
    this.worktilled = true;
  }
}
  // sixthPaginator(event: PageEvent) {
  //   this.paginator.pageIndex = event.pageIndex;
  //   this.paginator.pageSize = event.pageSize;
  //   this.page = event.pageSize;
  // }
  getLearnerCourseFee(data)
  {
      this.learnerService.learnercoursefee(data).subscribe(data=>{
        this.learner_fees = data.data.data.fsm_fee;
        this.courseselectForm.controls['learner_fee'].setValue(data.data.data.fsm_fee);
        //this.courseselectForm.controls['learner_fee'].setValue('1');
      })
  }
 clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('table.hide');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  clickfilterEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('table.hide');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  clicklearnerfilterEvent() {
    
    this.hidefilder = !this.hidefilder;
    // if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('learnerfiltershow') as HTMLElement;
      id.style.display = 'none';

    // } else {
    //   this.filtername = this.i18n('table.hide');
    //   const id = document.getElementById('learnerfiltershow') as HTMLElement;
    //   id.style.display = 'flex';

    // }
  }
  getbatchdtls(id) {
    this.disableSubmitButton = true;
    this.assessmentService.getbatchdtls(id).subscribe(data => {
    this.disableSubmitButton = false;

      this.batchdata_data = data.data.data;
      //console.log("this.batchdata_data",this.batchdata_data);
    });
  }

  currentlyWorking(event: MatCheckboxChange) {
    // console.log("events",event.checked);
    if (event.checked == true) {
      console.log("true")
      this.notAllow = true;
      this.formGroup.controls['sexp_eod'].setValue(' ');
    }
    else if (event.checked == false) {
      console.log("false")
      this.notAllow = false;
    }

  }

  learview(learpk) {

    this.getState(31);
    let repo = "";
    this.disableSubmitButton = true;
    this.learnerService.viewLearner(learpk, repo).subscribe(data => {
      
      if (data.data.status == 1) {
        let lrnr_data = data.data.data;
        this.getCity(lrnr_data.sir_opalstatemst_fk, 31);
        // this.disableSubmitButton = false;
        this.formGroup.controls['sir_idnumber'].setValue(lrnr_data.sir_idnumber);
        this.formGroup.controls['sir_emailid'].setValue(lrnr_data.sir_emailid);
        this.formGroup.controls['sir_name_en'].setValue(lrnr_data.sir_name_en);
        this.formGroup.controls['mnumber'].setValue(lrnr_data.sir_mobnum);
        this.formGroup.controls['mnumber2'].setValue(lrnr_data.sir_altmobnum);
        this.formGroup.controls['sir_gender'].setValue(lrnr_data.sir_gender);
        this.formGroup.controls['sir_name_ar'].setValue(lrnr_data.sir_name_ar);
        this.formGroup.controls['sir_dob'].setValue(moment(lrnr_data.sir_dob).format('YYYY-MM-DD').toString());
        this.formGroup.controls['sir_nationality'].setValue(lrnr_data.sir_nationality);
        this.formGroup.controls['sir_addrline1'].setValue(lrnr_data.sir_addrline1);
        this.formGroup.controls['sir_addrline2'].setValue(lrnr_data.sir_addrline2);
        this.formGroup.controls['state'].setValue(lrnr_data.sir_opalstatemst_fk);
        this.formGroup.controls['city'].setValue(lrnr_data.sir_opalcitymst_fk);
        this.courseselectForm.controls['total_year'].setValue(lrnr_data.lrhd_totalyearexp);
        this.courseselectForm.controls['learner_fee'].setValue(lrnr_data.lrhd_learnerfee);
        this.courseselectForm.controls['learner_fee_status'].setValue(lrnr_data.lrhd_feestatus);
        this.courseselectForm.controls['paid_by'].setValue(lrnr_data.lrhd_paidby);
        this.formGroup.controls['license_number'].setValue(lrnr_data.sld_ROPlicense);
        this.formGroup.controls['light_issue_date'].setValue(lrnr_data.sld_ROPlightlicense);
        this.formGroup.controls['heavy_issue_date'].setValue(lrnr_data.sld_ROPheavylicense);
        this.getEduList(lrnr_data.staffinforepo_pk);
        this.getExpList(lrnr_data.staffinforepo_pk);
        this.changeFormAddressFromDb(lrnr_data.sir_gender);
        this.getage(lrnr_data.sir_dob);
        

        // enable edu work

        this.staffrep_id = lrnr_data.staffinforepo_pk;
        this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
        console.log("lrnr_data",lrnr_data);
        this.courseselectForm.controls['learnerreghrddtls_pk'].setValue(lrnr_data.learnerreghrddtls_pk);
        this.formGroup.controls['staffinforepo_fk'].setValue(data);
        this.finalsavedata = '1';

        setTimeout(() => {
          this.getStaffbasDtls(this.staffrep_id)
        },2000);
        setTimeout(() => {
          this.getStaffworkDtls(this.staffrep_id)
        },2000);

        let postParams = {
          sir_idnumber: this.formGroup.controls['sir_idnumber'].value,
        }
        this.disableSubmitButton = false;

        this.learnerService.getcertified(postParams).subscribe(rescert => {
          this.disableSubmitButton = false;
          this.getcert= rescert.data;
          this.getcert = new MatTableDataSource<any>(rescert.data);
          this.getcert.sort = this.sort;
          //this.clicklearnerfilterEvent();

        });

        // enable edu work
        
      
        //radio button
        if(lrnr_data.sld_ROPlicense) {
          this.formGroup.controls.radion_button.setValue(1);
          this.radion_buttonGroup == 1;
          this.formGroup.controls['license_card'].setValue(lrnr_data.sld_ROPlicenseupload);
          
        }else {
          this.formGroup.controls.radion_button.setValue(2);
          this.radion_buttonGroup == 2;
          this.formGroup.controls['license_card'].setValue('');
        }

        this.onradion_buttonGroupChange();

        if(lrnr_data.sld_hasROPlightlicense == "1") {
          this.formGroup.controls.light_license.setValue(1);
        }else {
          this.formGroup.controls.light_license.setValue(2);
        }
        if(lrnr_data.sld_hasROPheavylicense == "1") {
          this.formGroup.controls.heavy_license.setValue(1);
        }else {
          this.formGroup.controls.heavy_license.setValue(2);
        }

        
        if(lrnr_data.sir_photo){
          this.profilePhoto.selectedFilesPk = [lrnr_data.sir_photo];
          this.photodoc.triggerChange();
        }else{
          this.profilePhoto.selectedFilesPk = [];
          this.photodoc.triggerChange();
        }
     

        if(lrnr_data.sir_civilidfront){
          this.cividId.selectedFilesPk = [lrnr_data.sir_civilidfront,lrnr_data.sir_civilidback];
          this.cividoc.triggerChange();
        }else{
          this.cividId.selectedFilesPk = [];
          this.cividoc.triggerChange();
        }

        if(lrnr_data.sld_ROPlicenseupload){
          this.licenseCard.selectedFilesPk = lrnr_data.sld_ROPlicenseupload.split(",");
          this.licensedoc.triggerChange();
        }else{
          this.licenseCard.selectedFilesPk = [];
          this.licensedoc.triggerChange();
        }
       
        
        this.disableSubmitButton = false;
       
      }
    });
      
  }

  checkCivilNum() {
    
    this.getState(31);
    let repo = "";

    let civilnum: any = this.formGroup.controls['sir_idnumber'].value;
    this.disableSubmitButton = false;
    
    this.learnerService.checkLearner(civilnum, repo, this.batch_number, this.batchdata_data.course, this.batchdata_data.btype).subscribe(data => {
      this.civilstatus = false;
      
      if(data.data.valstatus == 1){
        this.civilstatus = true;
        if(this.batch_number == data.data.dataStaff.bmd_Batchno){
          swal({
            title: this.i18n('This Learner is already registered.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }

        if(this.batch_number != data.data.dataStaff.bmd_Batchno){
          swal({
            title: this.i18n('If the Learner wishes to attend Training here, please ensure they cancel their Registration with the respective Centre as they are already registered on OPAL USP in another Batch.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        this.formGroup.controls['sir_idnumber'].setValue('');
        this.resetLearner();
        return false;

      }

      if(data.data.valstatus == 2){
        this.civilstatus = true;
        if(data.data.batch_type == 3){
          swal({
            title: this.i18n('Please register this Learner in the Batch as a "Refresher" since they have already completed the course and the Permit Card is not expired / not crossed '+ data.data.lnrrcard_exp_days +' days from the date of expiry.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }

        // Not In Use
        if(data.data.batch_type == 4){
          swal({
            title: this.i18n('Please register this Learner in the Batch as "Initial" since they have already completed the course and the Permit Card is expired and crossed '+ data.data.lnrrcard_exp_days +' days from the date of expiry.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }

        if(data.data.batch_type == 5){
          swal({
            title: this.i18n('Please register this Learner in the Batch as a "Refresher" since they have already completed the course and the Permit Card is not expired / not crossed '+ data.data.lnrrcard_exp_days +' days from the date of expiry.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        this.formGroup.controls['sir_idnumber'].setValue('');
        this.resetLearner();
        return false;
      }

      if(data.data.valstatus == 3){
        this.civilstatus = true;
        if(data.data.batch_type == 1){
          swal({
            title: this.i18n('Please Register this Learner in the Batch as "Initial" since they have not completed the Course.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        if(data.data.batch_type == 2){
          swal({
            title: this.i18n('Please register this Learner in the Batch as a "Refresher" since they have already completed the course and the Permit Card is not expired / not crossed '+ data.data.lnrrcard_exp_days +' days from the date of expiry.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        this.formGroup.controls['sir_idnumber'].setValue('');
        this.resetLearner();
        return false;
      }

      if(data.data.valstatus == 4){
        this.civilstatus = true;
        if(data.data.batch_type == 1){
          swal({
            title: this.i18n('Allowed Only Initial.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        if(data.data.batch_type == 2){
          swal({
            title: this.i18n('Allowed Only Referesher.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        this.formGroup.controls['sir_idnumber'].setValue('');
        this.resetLearner();
        return false;
      }

      if(data.data.valstatus == 5){
        this.civilstatus = true;
        swal({
          title: this.i18n('Please Register this Learner in the Batch as "Initial" since they have not completed the Course.'),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('learnerregister.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
        
        this.formGroup.controls['sir_idnumber'].setValue('');
        this.resetLearner();
        return false;

      }

      if ( data.data.status == 1 && data.data.valstatus == 0 ) {
        console.log(data.data.data[0])
        if(data.data.data.length == 0){
          this.resetLearner();
          this.disableSubmitButton = false;
        }else{

          let lrnr_data = data.data.data[0];
          this.getCity(lrnr_data.sir_opalstatemst_fk, 31);
          //alert(lrnr_data.sir_opalstatemst_fk)
         // this.formGroup.controls['sir_idnumber'].setErrors({ alreadyavailable: true });
         //get learner fee starts
          let ipParams = {
            bid: this.batch_number,
          }
          this.getLearnerCourseFee(ipParams);
        //get learner fee ends
          this.disableSubmitButton = false;
          this.formGroup.controls['sir_emailid'].setValue(lrnr_data.sir_emailid);
          this.formGroup.controls['sir_name_en'].setValue(lrnr_data.sir_name_en);
          this.formGroup.controls['mnumber'].setValue(lrnr_data.sir_mobnum);
          this.formGroup.controls['mnumber2'].setValue(lrnr_data.sir_altmobnum);
          this.formGroup.controls['sir_gender'].setValue(lrnr_data.sir_gender);
          this.formGroup.controls['sir_name_ar'].setValue(lrnr_data.sir_name_ar);
          this.formGroup.controls['sir_dob'].setValue(moment(lrnr_data.sir_dob).format('YYYY-MM-DD').toString());
          this.formGroup.controls['sir_nationality'].setValue(lrnr_data.sir_nationality);
          this.formGroup.controls['sir_addrline1'].setValue(lrnr_data.sir_addrline1);
          this.formGroup.controls['sir_addrline2'].setValue(lrnr_data.sir_addrline2);
          this.formGroup.controls['state'].setValue(lrnr_data.sir_opalstatemst_fk);
          this.formGroup.controls['city'].setValue(lrnr_data.sir_opalcitymst_fk);
          this.formGroup.controls['learner_fee'].setValue(lrnr_data.lrhd_learnerfee);
          this.formGroup.controls['learner_fee_status'].setValue(lrnr_data.lrhd_feestatus);
          this.formGroup.controls['paid_by'].setValue(lrnr_data.lrhd_paidby);
          this.formGroup.controls['license_number'].setValue(lrnr_data.sld_ROPlicense);
          this.formGroup.controls['light_issue_date'].setValue(lrnr_data.sld_ROPlightlicense);
          this.formGroup.controls['heavy_issue_date'].setValue(lrnr_data.sld_ROPheavylicense);
          this.getEduList(lrnr_data.staffinforepo_pk);
          this.getExpList(lrnr_data.staffinforepo_pk);
          this.changeFormAddressFromDb(lrnr_data.sir_gender);
          this.getage(lrnr_data.sir_dob);
          
          // enable edu work
  
          this.staffrep_id = lrnr_data.staffinforepo_pk;
          this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
          console.log("lrnr_data",lrnr_data);
          this.courseselectForm.controls['learnerreghrddtls_pk'].setValue(lrnr_data.learnerreghrddtls_pk);
          this.formGroup.controls['staffinforepo_fk'].setValue(data);
          this.finalsavedata = '1';
  
          setTimeout(() => {
            this.getStaffbasDtls(this.staffrep_id)
          },2000);
          setTimeout(() => {
            this.getStaffworkDtls(this.staffrep_id)
          },2000);
  
          let postParams = {
            sir_idnumber: this.formGroup.controls['sir_idnumber'].value,
          }
          this.disableSubmitButton = false;
          this.learnerService.getcertified(postParams).subscribe(rescert => {
            this.disableSubmitButton = false;
            this.getcert= rescert.data;
  
          });
  
          // enable edu work
          
        
          //radio button
          if(lrnr_data.sld_ROPlicense) {
            this.formGroup.controls.radion_button.setValue(1);
            this.radion_buttonGroup == 1;
            this.formGroup.controls['license_card'].setValue(lrnr_data.sld_ROPlicenseupload);
            
          }else {
            this.formGroup.controls.radion_button.setValue(2);
            this.radion_buttonGroup == 2;
            this.formGroup.controls['license_card'].setValue('');
          }
  
          this.onradion_buttonGroupChange();
  
          if(lrnr_data.sld_hasROPlightlicense == "1") {
            this.formGroup.controls.light_license.setValue(1);
          }else {
            this.formGroup.controls.light_license.setValue(2);
          }
          if(lrnr_data.sld_hasROPheavylicense == "1") {
            this.formGroup.controls.heavy_license.setValue(1);
          }else {
            this.formGroup.controls.heavy_license.setValue(2);
          }
  
          
  
          if(lrnr_data.sir_photo){
            this.profilePhoto.selectedFilesPk = [lrnr_data.sir_photo];
            this.photodoc.triggerChange();
          }else{
            this.profilePhoto.selectedFilesPk = [];
            this.photodoc.triggerChange();
          }
      //radio button end 
  
          if(lrnr_data.sir_civilidfront){
            this.cividId.selectedFilesPk = [lrnr_data.sir_civilidfront,lrnr_data.sir_civilidback];
            this.cividoc.triggerChange();
          }else{
            this.cividId.selectedFilesPk = [];
            this.cividoc.triggerChange();
          }
  
          if(lrnr_data.sld_ROPlicenseupload){
            this.licenseCard.selectedFilesPk = lrnr_data.sld_ROPlicenseupload.split(",");
            this.licensedoc.triggerChange();
          }else{
            this.licenseCard.selectedFilesPk = [];
            this.licensedoc.triggerChange();
          }
         
          
          this.disableSubmitButton = false;
        }
       
      }
      else {
        this.resetLearner();
      }
      //this.FormMainTemplate='success';
      // this.mattab = 6;

    });
  }

  resetLearner(){
    this.staffrep_id = '';
        this.courseselectForm.controls['staff_repo'].setValue('');
        this.courseselectForm.controls['learnerreghrddtls_pk'].setValue('');
        this.formGroup.controls['staffinforepo_fk'].setValue('');
        this.finalsavedata = '';
        //let lrnr_data = data.data.data[0];
        //this.formGroup.controls['sir_idnumber'].setErrors({ alreadyavailable: true });
        
        this.formGroup.controls['sir_emailid'].setValue('');
        this.formGroup.controls['sir_name_en'].setValue('');
        this.formGroup.controls['mnumber'].setValue('');
        this.formGroup.controls['mnumber2'].setValue('');
        this.formGroup.controls['sir_gender'].setValue('');
        this.formGroup.controls['sir_name_ar'].setValue('');
        this.formGroup.controls['sir_dob'].setValue('');
        this.formGroup.controls['sir_nationality'].setValue('31');
        this.formGroup.controls['country'].setValue('31');
        this.formGroup.controls['sir_addrline1'].setValue('');
        this.formGroup.controls['sir_addrline2'].setValue('');
        this.formGroup.controls['state'].setValue('');
        this.formGroup.controls['city'].setValue('');
        this.formGroup.controls['learner_fee'].setValue('');
        this.formGroup.controls['learner_fee_status'].setValue('');
        this.formGroup.controls['paid_by'].setValue('');
        this.formGroup.controls['savefinal'].setValue('1');
        this.formGroup.controls['light_issue_date'].setValue('');
        this.formGroup.controls['heavy_issue_date'].setValue('');
        this.formGroup.controls['license_number'].setValue('');
        
        this.getEduList('');
        this.getExpList('');
        this.changeFormAddressFromDb('');
        this.getage('');
        this.formGroup.controls.radion_button.setValue(2);
        this.formGroup.controls.light_license.setValue(2);
        this.formGroup.controls.heavy_license.setValue(2);
        this.radion_buttonGroup == 2;
        this.formGroup.controls['license_card'].setValue('');
        this.onradion_buttonGroupChange();
        
        this.profilePhoto.selectedFilesPk = [];
        this.photodoc.triggerChange();

        this.cividId.selectedFilesPk = [];
        this.cividoc.triggerChange();

        this.licenseCard.selectedFilesPk = [];
        this.licensedoc.triggerChange();
  }


  syncPrimaryPaginator(event: PageEvent) {
    this.edu_paginator.pageIndex = event.pageIndex;
    this.edu_paginator.pageSize = event.pageSize;
    this.edu_page = event.pageSize;
  }

  syncExperiencePaginator(event: PageEvent) {
    // exppaginator
    this.exppaginator.pageIndex = event.pageIndex;
    this.exppaginator.pageSize = event.pageSize;
    this.edu_page = event.pageSize;
  }

  syncLearnerPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  getbranchinfo() {
    // this.learnerService.getbranhinfo().subscribe(data=>{
    //   console.log("details", data);
    // })
  }

  getEduList(id: any) {
    let data = {
      id: id
    }
    this.learnerService.getEduList(data).subscribe(res => {
      // console.log("education details", data.data.data);
      this.educationdata_data = res.data.data;
      this.educationdata = new MatTableDataSource<EduInfo>(res.data.data);
      this.educationdata.paginator = this.edu_paginator
      //this.educationdata.sort = this.edusort;
      console.log("testung education", this.educationdata);
      console.log("testung educationdata_data", this.educationdata_data);
      this.getFormsValue();
    })
  }


  getExpList(id: any) {
    let data = {
      id: id
    }
    this.learnerService.getExpList(data).subscribe(res => {
      this.learnerdata_data = res.data.data;
      this.learnerdata = new MatTableDataSource<Batchinfo>(res.data.data);
      this.learnerdata.paginator = this.exppaginator;
      //this.learnerdata.sort = this.expsort;
      this.getFormsValue();
    });
  }



  announceSortChange(sortState: Sort) {
    console.log(sortState.direction, "sorting");
    if (sortState.direction) {
      this._liveAnnouncer.announce(`Sorted ${sortState.direction}ending`);
    } else {
      this._liveAnnouncer.announce('Sorting cleared');
    }
  }


  applyFilterEdu(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.educationdata.filter = filterValue.trim().toLowerCase();
  }

  experienceSortChange(sortState: Sort) {
    console.log(sortState.direction, "sorting");
    if (sortState.direction) {
      this._liveAnnouncer.announce(`Sorted ${sortState.direction}ending`);
    } else {
      this._liveAnnouncer.announce('Sorting cleared');
    }
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.learnerdata.filter = filterValue.trim().toLowerCase();
  }

  getCountry() {
    this.appService.getcountry().subscribe(data => {
      // console.log("country",data.data);
      this.countrylist = data.data;
    })
  }

  staffleveldropdown() {
    this.appService.getref(12).subscribe(data => {
      this.stafflevel_list = data.data;
    });
  }

  getState(event: any) {
    // console.log(event.value);
    event = event.value ? event.value : event;
    this.appService.getstate(event).subscribe(data => {
      // console.log("states",data.data);
      this.stateList = data.data;
    })
  }

  getCity(event: any, city: any) {
    console.log("city",event);
    this.appService.getcity(event, city).subscribe(data => {
      this.cityList = data.data
      console.log("this.cityList",this.cityList);
    })
  }

  egetState(event: any) {
    event = event.value ? event.value : event;
    this.appService.getstate(event).subscribe(data => {
      // console.log("states",data.data);
      this.eStateList = data.data;
    })
  }

  egetCity(event: any, city: any) {
    event = event.value ? event.value.opalstatemst_pk : event;
    this.appService.getcity(event, city).subscribe(data => {
      this.eCityList = data.data
    })
  }

  expgetState(event: any)
  {
    console.log("exp events",event);
    event = event.value ? event.value.opalcountrymst_pk : event;
    this.appService.getstate(event).subscribe(data => {
      // console.log("states",data.data);
      this.expStateList = data.data;
    })
  }

  expgetCity(event: any, city: any) {
    console.log(city,"exp city events");
    event = event.value ? event.value.opalstatemst_pk : event;
    this.appService.getcity(event, city.opalcountrymst_pk).subscribe(data => {
      console.log("city",data.data);
      this.expCityList = data.data
    })
  }

  reactiveForm() {
    this.formGroup = this.formBuilder.group({
      'sir_idnumber': [null, Validators.required],
      'sir_name_en': [null, Validators.required],
      'sir_name_ar': [null, Validators.required],
      'sir_emailid': ['', [Validators.required, Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]],
      'sir_gender': [null, Validators.required],
      'sir_dob': [null, Validators.required],
      'sir_nationality': ['31', Validators.required],
      'form_address': [null],
      "age": [null],
      "sir_photo": [null, Validators.required],
      "sir_civilidfront": [null, Validators.required],
      'sir_addrline1': [null],
      'sir_addrline2': [null],
      'country': ['31'],
      'state': [null],
      'city': [null],
      // 'sacd_staffinforepo_fk': [null],
      // 'staffacademics_pk': [null],
      // 'year_join': [null],
      // 'year_pass': [null],
      // 'institute_name': [null],
      // 'institue_country': ['31'],
      // 'inst_state': [null],
      // 'inst_city': [null],
      // 'edut_level': [null],
      // 'degree_cert': [null],
      // 'gpa_grade': [null],
      // 'sir_createdby': [null],
      'mnumber': [null,''],
      'mnumber2': [null, ''],
      'picker': [null],
      'radion_button': ["2",''],
      "license_card": [null],
      'license_number': [null],
      'light_license': ["2",''],
      'heavy_license': ["2",''],
      'light_issue_date': [null],
      'heavy_issue_date': [null],
      'staffworkexp_pk': [null],
      'sexp_employername': [null,''],
      'sexp_doj': [null,''],
      'sexp_currentlyworking': [null,''],
      'sexp_eod': [null],
      'sexp_designation': [null,''],
      'sexp_opalcountrymst_fk': [null],
      'sexp_opalstatemst_fk': [null],
      'sexp_opalcitymst_fk': [null],
      'staffinforepo_fk': [null],
      'learner_fee_status': [null],
      'paid_by': [null],
      'learner_fee': [5000],
      'finalsave': ['', ''],
      'savefinal': [null, ''],
      
    });
  }
  get form() { return this.formGroup.controls; }


  getage(dob: any) {

    dob = dob.target ? dob.target.value : dob;
    // var date1 = new Date();
    // var date2 = new Date(dob);
    // var diff = Math.floor(date1.getTime() - date2.getTime());
    // var day = 1000 * 60 * 60 * 24;

    // var days = Math.floor(diff / day);
    // var months = Math.floor(days / 31);
    // var years = Math.floor(months / 12);

    // var message = years;
    // console.log(message, "dob");

    let age;
    if (dob) {
      var timeDiff = Math.abs(Date.now() - new Date(dob).getTime());
      age = Math.floor(timeDiff / (1000 * 3600 * 24) / 365.25);
        }

    //return age;

    this.formGroup.controls['age'].setValue(age);

    // this.formGroup.patchValue({
    //   'age':message
    // });


  }

  changeFormAddressFromDb(event) {
    if (event == 1) {
      this.formGroup.controls['form_address'].setValue('Mr');
    }
    else if(event == 2) {
      this.formGroup.controls['form_address'].setValue('Ms');
    }
  }

  changeFormAddress(event: any) {
    console.log("gender", event.value);
    if (event.value == 1) {
      this.formGroup.controls['form_address'].setValue('Mr');
    }
    else {
      this.formGroup.controls['form_address'].setValue('Ms');
    }
  }

  submitForm(value) {
    
    let postParams = {
      sir_idnumber: value.sir_idnumber,
      sir_name_en: value.sir_name_en,
      sir_name_ar: value.sir_name_ar,
      sir_emailid: value.sir_emailid,
      sir_gender: value.sir_gender,
      sir_nationality: value.sir_nationality,
      country: value.country,
      state: value.state,
      city: value.city,
      mnumber: value.mnumber,
      mnumber2: value.mnumber2,
      picker: value.picker,
      sir_dob: moment(value.sir_dob).format('YYYY-MM-DD').toString(),
      form_address: value.form_address,
      driving_license: value.driving_license,
      age: value.age,
      sir_photo: value.sir_photo,
      radion_button: value.radion_button,
      sir_civilidfront: value.sir_civilidfront,
      license_card: value.license_card,
      light_license: value.light_license,
      heavy_license: value.heavy_license,
      // light_issue_date: value.light_issue_date,
      // heavy_issue_date: value.heavy_issue_date,
      light_issue_date: moment(value.light_issue_date).format('YYYY-MM-DD').toString(),
      heavy_issue_date: moment(value.heavy_issue_date).format('YYYY-MM-DD').toString(),
      license_number: value.license_number,
      sir_addrline1: value.sir_addrline1,
      sir_addrline2: value.sir_addrline2,
      learner_fee: value.learner_fee,
      learner_fee_status: value.learner_fee_status,
      paid_by: value.paid_by,
      batchmgmtdtls: this.batchmgmtdtls,
      finalsave: this.finalsavedata
    }
    // if(this.formGroup['sir_photo'].value) {
    //    console.log('fine error')
    // }else {
    //   console.log(this.formGroup['sir_photo'].value)
    // }
    if(this.formGroup.valid) {

      this.learnerService.learnerage(this.courseselectForm.value,postParams).subscribe(resdata => {
        this.age = resdata.data.data.scd_agelimit;
      });
      
      this.fileeselect = false;
      this.loaderformlearner = true;
      this.learnerService.registerLearner(postParams).subscribe(res => {
      this.loaderformlearner = false;
      if (res.success) {
        if(res.data.data == 'already_registered'){
          swal({
            title: this.i18n('learnerregister.alrregis'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        else if(res.data.data == 'same_course'){
          swal({
            title: this.i18n('learnerregister.alredregfor'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
        else if(res.data.data == 'age_limit'){
          swal({
            title: this.i18n('Age of Learner should be greater than ') + this.age + this.i18n(' Years.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }else if(res.data.data == 'card_limit'){
          swal({
            title: this.i18n('learnerregister.thiscourhav'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }else if(res.data.data == 'batch_notnew'){
          swal({
            title: this.i18n('This batch not In new Status'),
            text: " ",
            icon: 'warning',
            buttons: [false,this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        } else{
          let data = res.data.data;
          this.staffrep_id = data.sld_staffinforepo_fk;
          this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
          this.courseselectForm.controls['learnerreghrddtls_pk'].setValue(data.learnerreghrddtls_pk);
          this.formGroup.controls['staffinforepo_fk'].setValue(data);
          
          this.learnerService.getcertified(postParams).subscribe(rescert => {
            this.getcert= rescert.data;
          });
          this.shownotetext = false;
          // this.toastr.success('Learner Registered Successfully.', ''), {
          //   timeOut: 2000,
          //   closeButton: false,
          // };
          
        }
      }
    });
  }else {
    this.fileeselect = true;
   this.focusInvalidInput(this.formGroup);

  }

  }

  academicSubmit(value) {
    let learner_id = this.formGroup.controls['staffinforepo_fk'].value;

   

    let postParams = {
      staffacademics_pk: this.formGroup.controls['staffacademics_pk'].value,
      sacd_staffinforepo_fk: learner_id,
      year_join: value.year_join,
      year_pass: value.year_pass,
      institute_name: value.institute_name,
      institue_country: value.institue_country,
      inst_state: value.inst_state.opalstatemst_pk,
      inst_city: value.inst_city.opalcitymst_pk,
      edut_level: value.edut_level,
      degree_cert: value.degree_cert,
      gpa_grade: value.gpa_grade,
    }

    console.log("academics", postParams);

  

    this.learnerService.saveAcademics(postParams).subscribe(res => {
      if (res.success) {
        this.formGroup.patchValue({
          staffacademics_pk: '',
          sacd_staffinforepo_fk: '',
          year_join: '',
          year_pass: '',
          institute_name: '',
          institue_country: '',
          inst_state: '',
          inst_city: '',
          edut_level: '',
          degree_cert: '',
          gpa_grade: '',
        });
        this.getEduList(learner_id);
        swal(
          'Academics data submitted Successfully',
          'Success'
        )
      }
    })
  }

  deleteStaffedu(element){

    swal({
      title: this.i18n('learnerregister.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('changeassesor.no'), this.i18n('changeassesor.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteStaffedu(element,'learner').subscribe(data => {
        if(data.data.status=='1'){
          //this.disableSubmitButton = true;
          //this.getDeclinedStatus(this.appdtlssavetmp_id);
          //this.getCenterStatus(this.appdtlssavetmp_id);
          this.staffFormedu.controls['institute_name'].reset();
          this.staffFormedu.controls['degree_cert'].reset();
          this.staffFormedu.controls['education_files'].reset();
          //this.staffFormedu.controls['year_join'].reset();
          // this.staffFormedu.controls['year_pass'].reset();
          this.staffFormedu.controls['gpa_grade'].reset();
          //this.staffFormedu.controls['institue_country'].reset();
          this.staffFormedu.controls['edut_level'].reset();
          //this.staffFormedu.controls['inst_city'].reset();
          //this.staffFormedu.controls['inst_state'].reset();
          this.staffFormedu.controls['staffacademics_pk'].reset();
          this.staffeduedit = false;
          this.toastr.success(this.i18n('learnerregister.griddele'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          setTimeout(() => {
            this.getStaffbasDtls(element.sacd_staffinforepo_fk);
          },2000);
          setTimeout(() => {
            //this.disableSubmitButton = false;
            },2000);
        } 
      });  
      }                 
    });
  }
  deleteStaffwork(element){

    swal({
      title: this.i18n('learnerregister.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('changeassesor.no'), this.i18n('changeassesor.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteStaffwork(element,'learner').subscribe(data => {
        if(data.data.status=='1'){
          //this.disableSubmitButton = true;
          //this.getDeclinedStatus(this.appdtlssavetmp_id);
          //this.getCenterStatus(this.appdtlssavetmp_id);
          this.staffworkexperienceForm.controls['oragn_name'].reset();
          this.staffworkexperienceForm.controls['workdate'].reset();
          this.staffworkexperienceForm.controls['designat'].reset();
          this.staffworkexperienceForm.controls['date_join'].reset();
          this.staffworkexperienceForm.controls['curr_work'].reset();
          this.staffworkexperienceForm.controls['employ_country'].reset();
          this.staffworkexperienceForm.controls['employ_state'].reset();
          this.staffworkexperienceForm.controls['employ_city'].reset();
          this.staffworkexperienceForm.controls['staffworkexp_pk'].reset();
          this.staffworkedit = false;
          this.toastr.success(this.i18n('learnerregister.griddele'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          setTimeout(() => {
            this.getStaffworkDtls(element.sexp_staffinforepo_fk);
          },2000);
          setTimeout(() => {
            //this.disableSubmitButton = false;
            },2000);
        }  
        
      });
      }
    });

    
      
                     
    
  }

  editEduList(data) {
    
    this.staffleveldropdown();
    this.formGroup.patchValue({
      staffacademics_pk: data.staffacademics_pk,
      sacd_staffinforepo_fk: data.sacd_staffinforepo_fk,
      //year_join: data.sacd_startdate,
      GradeDate: data.sacd_enddate,
      institute_name: data.sacd_institutename,
      //institue_country: Number(data.sacd_opalcountrymst_fk),
      //inst_state: Number(data.sacd_opalstatemst_fk),
      //inst_city: Number(data.sacd_opalcitymst_fk),
      edut_level: data.edut_level,
      degree_cert: data.sacd_degorcert,
      gpa_grade: data.sacd_grade,
    });
  }

  delEduList(data) {

  }

  hasLicense(event: any) {
    console.log("events", event.value);
  }

  submitForm2(value) {
    let learner_id = this.formGroup.controls['staffinforepo_fk'].value;

    let postParams2 = {
      staffworkexp_pk: this.formGroup.controls['staffworkexp_pk'].value,
      stafrep_id: learner_id,
      oragn_name: value.sexp_employername,
      date_join: value.sexp_doj,
      curr_work: value.sexp_currentlyworking,
      workdate: value.sexp_eod,
      employ_country: value.sexp_opalcountrymst_fk.opalcountrymst_pk,
      employ_state: value.sexp_opalstatemst_fk.opalstatemst_pk,
      employ_city: value.sexp_opalcitymst_fk.opalcitymst_pk,
      designat: value.sexp_designation,
    }
    this.learnerService.saveWorkexp(postParams2).subscribe(res => {
      if (res.success) {
        this.formGroup.controls["staffworkexp_pk"].setValue('')
        this.formGroup.controls['sexp_employername'].setValue('');
        this.formGroup.controls['sexp_doj'].setValue('');
        this.formGroup.controls['sexp_currentlyworking'].setValue('');
        this.formGroup.controls['sexp_eod'].setValue('');
        this.formGroup.controls['sexp_opalcountrymst_fk'].setValue('');
        this.formGroup.controls['sexp_opalstatemst_fk'].setValue('');
        this.formGroup.controls['sexp_opalcitymst_fk'].setValue('');
        this.formGroup.controls['sexp_designation'].setValue('');
        this.selectedDate = null;
        this.getExpList(learner_id);
        swal(
          'Experience data submitted Successfully',
          'Success'
        )
      }
    });
  }

  getassessmentstatus(no) {
    //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
    if (no == 1) {
      return 'New'
    } else if (no == 2) {
      return 'Teaching(theory)'
    }
    else if (no == 3) {
      return 'Teaching(practical)'
    }
    else if (no == 4) {
      return 'Assessment'
    }
    else if (no == 5) {
      return 'Requested for Back Track'
    }
    else if (no == 6) {
      return 'Quality Check'
    }
    else if (no == 7) {
      return 'Cancelled'
    }
    else if (no == 8) {
      return 'Print'
    }
    else if (no == 9) {
      return 'Requested for Assessor change'
    }
    else {
      return ''
    }
  }

  editExpList(data) {
    let value = this.countrylist.filter(item => item.opalcountrymst_pk == data.sexp_opalcountrymst_fk)
    let eod = data.sexp_currentlyworking == 1 ? "" : data.sexp_eod;

    let state = this.egetState(data.sexp_opalcountrymst_fk);

    let selectState = this.eStateList.filter(item => item.opalstatemst_pk == data.sexp_opalstatemst_fk);

    this.formGroup.controls['sexp_opalstatemst_fk'].setValue(selectState[0]);

    let city = this.egetCity(data.sexp_opalcountrymst_fk, data.sexp_opalstatemst_fk);

    let selectCity = this.eCityList.filter(item => item.opalcitymst_pk == data.sexp_opalcitymst_fk);

    this.formGroup.controls['sexp_opalcitymst_fk'].setValue(selectCity[0]);

    this.formGroup.controls["staffworkexp_pk"].setValue(data.staffworkexp_pk)
    this.formGroup.controls['sexp_employername'].setValue(data.sexp_employername);
    this.formGroup.controls['sexp_doj'].setValue(data.sexp_doj);
    this.formGroup.controls['sexp_currentlyworking'].setValue(data.sexp_currentlyworking);
    this.formGroup.controls['sexp_eod'].setValue(eod);
    // this.formGroup.controls['sexp_opalcountrymst_fk'].setValue(data.sexp_opalcountrymst_fk);
    this.formGroup.controls['sexp_opalcountrymst_fk'].setValue(value[0]);


    this.formGroup.controls['sexp_designation'].setValue(data.sexp_designation);

  }

  radion_buttonGroup = 2;
  light_licenseGroup = 2;
  heavy_licenseGroup = 2;

  onradion_buttonGroupChange() {
    if(this.radion_buttonGroup === 1 ) {
      this.showroplicense = true;
      this.formGroup.controls['license_number'].setValidators([Validators.required]);
      this.formGroup.controls['license_number'].updateValueAndValidity();

      this.formGroup.controls['license_card'].setValidators([Validators.required]);
      this.formGroup.controls['license_card'].updateValueAndValidity();

    } else {
      this.showroplicense = false;
      this.licenseCard.selectedFilesPk = [];
      this.formGroup.controls['license_number'].reset();
      this.formGroup.controls['license_card'].reset();
      this.formGroup.controls['license_number'].setValidators(null);
      this.formGroup.controls['license_number'].updateValueAndValidity();

      this.formGroup.controls['license_card'].setValidators(null);
      this.formGroup.controls['license_card'].updateValueAndValidity();
    }
  }

  onlight_licenseGroupChange() {
    if(this.light_licenseGroup === 1 ) {
      this.lightlicenseradio = true;
      this.formGroup.controls['light_issue_date'].setValidators([Validators.required]);
      this.formGroup.controls['light_issue_date'].updateValueAndValidity();
    } else {
      this.lightlicenseradio = false;
      this.formGroup.controls['light_issue_date'].reset();
      this.formGroup.controls['light_issue_date'].setValidators(null);
      this.formGroup.controls['light_issue_date'].updateValueAndValidity();
    }
  }

  onheavy_licenseGroupChange() {
    if(this.heavy_licenseGroup === 1 ) {
      this.heavylicenseradio = true;
      this.formGroup.controls['heavy_issue_date'].setValidators([Validators.required]);
      this.formGroup.controls['heavy_issue_date'].updateValueAndValidity();
    } else {
      this.heavylicenseradio = false;
      this.formGroup.controls['heavy_issue_date'].reset();
      this.formGroup.controls['heavy_issue_date'].setValidators(null);
      this.formGroup.controls['heavy_issue_date'].updateValueAndValidity();
    }
  }

  delExpList(data) {

  }

  formSubscribe() {
    this.sacd_startdate.valueChanges.subscribe((positionValue) => {
      this.filterValues['sacd_startdate'] = positionValue;
      this.educationdata.filter = JSON.stringify(this.filterValues);
    });
  }

  getDate(date: any) {
    if (date) {
      date = date.split(" ");

      return date[0];
    }
    return;
  }
  getFormsValue() {
    // this.educationdata.filterPredicate = (data, filter: string): boolean => {
    // let searchString = JSON.parse(filter);
    // console.log("filters check", searchString);

    // let resultValue;
    // // isPositionAvailable && 
    // // data.sacd_startdate.includes(searchString.sacd_startdate)
    // if(searchString.sacd_startdate?.startDate){
    //   resultValue = moment(data.sacd_startdate).format("YYYY-MM-DD, h:mm:ss") >= moment(searchString.sacd_startdate.startDate).format("YYYY-MM-DD, h:mm:ss") && moment(data.sacd_startdate).format("YYYY-MM-DD, h:mm:ss") <= moment(searchString.sacd_startdate.endDate).format("YYYY-MM-DD, HH:mm:ss");
    // } else {
    //   resultValue = true;
    // }

    //   return resultValue;
    // };
    // this.learnerdata.filter = JSON.stringify(this.filterValues);
  }
  /**
   * This functions is show filter display and hide
   */
  showExpFilter() {
    this.expFilter = !this.expFilter;

    if (!this.expFilter) {
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';
    }
    else {
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    }
  }

  showEduFilter() {
    this.edufilter = !this.edufilter;

    if (!this.edufilter) {
      const id = document.getElementById('edusearchrow') as HTMLElement;
      id.style.display = 'flex';
    }
    else {
      const id = document.getElementById('edusearchrow') as HTMLElement;
      id.style.display = 'none';

    }
  }


  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.learnerdata_data?.length;
    return numSelected === numRows;
  }

  toggleAllRows() {
    if (this.isAllSelected()) {
      this.selection.clear();
      return;
    }

    this.selection.select(...this.learnerdata_data);
  }

  //get country starts
  countrydropdown() {
    this.appservice.getcountry().subscribe(data => {
      this.country_list = data.data;
    });
  }
  //get country ends
  
  //get state starts
  statedropdown(param) {
    this.appservice.getstate(param).subscribe(data => {
      this.state_list = data.data;
    });
  }
  //get state ends

  //get city starts
  citydropdown(state,country) {
    this.appservice.getcity(state,country).subscribe(data => {
      this.city_list = data.data;
    });
  }
  //get city ends

  //get state tut starts
  statetutdropdown(param) {
    this.appservice.getstate(param).subscribe(data => {
      this.state_tut_list = data.data;
    });
  }
  //get state tut ends

  //get city tut starts
  citytutdropdown(state,country) {
    this.appservice.getcity(state,country).subscribe(data => {
      this.city_tut_list = data.data;
    });
  }
  //get city tut ends

  //get state tut starts
  stateworkdropdown(param) {
    this.appservice.getstate(param).subscribe(data => {
      this.state_work_list = data.data;
    });
  }
  //get state tut ends

  //get city tut starts
  cityworkdropdown(state,country) {
    this.appservice.getcity(state,country).subscribe(data => {
      this.city_work_list = data.data;
    });
  }
  //get city tut ends

  saveStaffedu(){
    //alert(this.staffrep_id)
    if(this.staffFormedu.valid){
      //this.pageScrolltopedu();
      
     
      this.disableSubmitButton = true;
      //this.tblplaceholder = true;
      let appdtlssavetmp_id=0;
      this.appService.saveStaffedu(this.staffFormedu.value,appdtlssavetmp_id,this.staffrep_id).subscribe(data => {
        //this.staffrep_id = data['data'].data;
        //alert(this.staffFormedu.get('stfrepo').value)
        this.disableSubmitButton = false;
        this.staffFormedu.controls['stfrepo'].setValue(this.staffrep_id);
        
        if(data.data.status=='1'){
          //this.getDeclinedStatus(this.appdtlssavetmp_id);
          //this.getCenterStatus(this.appdtlssavetmp_id);
          this.staffeduedit=false;
          this.educationformshow = false;
          this.staffFormedu.controls['institute_name'].reset();
          this.staffFormedu.controls['degree_cert'].reset();
          this.staffFormedu.controls['education_files'].reset();
          //this.staffFormedu.controls['year_join'].reset();
          //this.staffFormedu.controls['year_pass'].reset();
          this.staffFormedu.controls['gpa_grade'].reset();
          //this.staffFormedu.controls['institue_country'].reset();
          this.staffFormedu.controls['edut_level'].reset();
          //this.staffFormedu.controls['inst_city'].reset();
          //this.staffFormedu.controls['inst_state'].reset();
          // this.staffFormedu.markAsUntouched();
          if(this.staffFormedu.get('staffacademics_pk').value){
            this.toastr.success('Educational Qualification Updated Successfully.', ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.staffFormedu.controls['staffacademics_pk'].reset();
          }else{
            this.toastr.success(this.i18n('learnerregister.educaquaadd'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
         
          setTimeout(() => {
            // if(this.staffrep_id){
            //   this.getStaffbasDtls(this.staffFormedu.get('stfrepo').value);
            // }else{
              // do stuff
              this.getStaffbasDtls(this.staffrep_id);
            // }
            
          }, 2000);

          //this.staffFormedu.reset();

        }
        // this.disableSubmitButton = false;
        //this.tblplaceholder = false;
        //this.mattab = 7;
      });
    }else{
      // do stuff
      this.fileeselectederror = true;
      this.focusInvalidInput(this.staffFormedu);
    }
  }
  cancelstaff(){
    this.staffFormedu.controls['institute_name'].reset();
    this.staffFormedu.controls['degree_cert'].reset();
    this.staffFormedu.controls['GradeDate'].reset();
    // this.staffFormedu.controls['year_pass'].reset();
    this.staffFormedu.controls['gpa_grade'].reset();
    // this.staffFormedu.controls['institue_country'].reset();
    this.staffFormedu.controls['edut_level'].reset();
    // this.staffFormedu.controls['inst_city'].reset();
    // this.staffFormedu.controls['inst_state'].reset();
    this.educationformshow = false;
  this.fileeselectederror = false;
  }
  cancelworkstaff(){
    this.staffworkexperienceForm.controls['oragn_name'].reset();
    this.staffworkexperienceForm.controls['workdate'].reset();
    this.staffworkexperienceForm.controls['designat'].reset();
    this.staffworkexperienceForm.controls['date_join'].reset();
    this.staffworkexperienceForm.controls['curr_work'].reset();
    this.staffworkexperienceForm.controls['employ_country'].reset();
    this.staffworkexperienceForm.controls['employ_state'].reset();
    this.staffworkexperienceForm.controls['employ_city'].reset();
    this.workexpformshow = false;
  }
  scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('#' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        console.log('page-content')
        }
  }
  saveWorkExp(){
    if(this.staffworkexperienceForm.get('curr_work').value == 1) {
      this.staffworkexperienceForm.controls['curr_work'].setErrors(null);
      this.notallowed = true;
      this.staffworkexperienceForm.controls.workdate.reset();
      this.worktilled = false;
      this.cleardate = false;
      this.staffworkexperienceForm.controls['workdate'].setErrors(null);
     } else {
      this.staffworkexperienceForm.controls['curr_work'].setErrors(null);
      if(!this.staffworkexperienceForm.controls['workdate'].valid){
       this.notallowed = false;
       this.staffworkexperienceForm.controls['workdate'].setErrors({'incorrect': true });
       this.worktilled = true;
       this.isCheckboxDisabled = true;
      this.cleardate = true;

      }
      
     }
    // if(this.staffworkexperienceForm.get('curr_work').value == 1) {
    //   this.staffworkexperienceForm.controls['curr_work'].setErrors(null);
    //   this.notallowed = true;
    //   this.staffworkexperienceForm.controls.workdate.reset();
    //   this.worktilled = false;
    //   this.staffworkexperienceForm.controls['workdate'].setErrors(null);
    //  } else {
    //    this.notallowed = false;
    //    this.staffworkexperienceForm.controls['workdate'].setErrors({'incorrect': true });
    //    this.worktilled = true;
    //  }
    if(this.staffworkexperienceForm.valid){
      this.disableSubmitButton = true;
      // this.disableSubmitButton = true;
      //this.added = true;
      // do stuff
      //this.pageScrolltopwork();

      //this.tblplaceholder = true;
//this.spinnerButtonOptionsverified.active = true;
      let appdtlssavetmp_id=0;
      this.appService.saveWorkExp(this.staffworkexperienceForm.value,this.staffrep_id,appdtlssavetmp_id).subscribe(data => {
        this.disableSubmitButton = false;
        //this.appdtlstmp_id = data['data'].data;
        this.staffworkexperienceForm.controls['sexp_staffinforepo_fk'].setValue(this.staffrep_id);
        if(data.data.status=='1'){
          this.workexpformshow = false;
          //this.getDeclinedStatus(this.appdtlssavetmp_id);
          //this.getCenterStatus(this.appdtlssavetmp_id);

          //this.staffworkedit=false;
          this.staffworkexperienceForm.controls['oragn_name'].reset();
          this.staffworkexperienceForm.controls['workdate'].reset();
          this.staffworkexperienceForm.controls['designat'].reset();
          this.staffworkexperienceForm.controls['date_join'].reset();
          this.staffworkexperienceForm.controls['curr_work'].reset();
          this.staffworkexperienceForm.controls['employ_country'].reset();
          this.staffworkexperienceForm.controls['employ_state'].reset();
          this.staffworkexperienceForm.controls['employ_city'].reset();
          this.selectedDate = null;
          if(this.staffworkexperienceForm.get('staffworkexp_pk').value){
            this.toastr.success('Work Experience Updated Successfully.', ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.staffworkexperienceForm.controls['staffworkexp_pk'].reset();
          }else{
            this.toastr.success(this.i18n('learnerregister.workexpadd'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          setTimeout(() => {
            // do stuff
            this.getStaffworkDtls(this.staffrep_id)
          }, 2000);

          //this.staffFormedu.reset();

        }
        // this.disableSubmitButton = false;
        //this.mattab = 7;
        //this.scrollTo('workgrid');
        //this.tblplaceholder = false;
// this.spinnerButtonOptionsverified.active = false;

        // this.staffformshow = false;
        // this.ShowHide = true;               
      });
    }else{
      this.focusInvalidInput(this.staffworkexperienceForm);
    }
  }
  gerOpr(){
    this.appservice.getref(2).subscribe(data => {
      this.opr_list = data.data;
      //this.level_list = this.level_list.pipe(map(level_list => level_list.sort((a,b) => a > b)));
    });
  }
  

  saveLear(){

    //this.formGroup.controls['savefinal'].setValue('');
    let postParams = {
      sir_idnumber: this.formGroup.controls['sir_idnumber'].value,
      sir_name_en: this.formGroup.controls['sir_name_en'].value,
      sir_name_ar: this.formGroup.controls['sir_name_ar'].value,
      sir_emailid: this.formGroup.controls['sir_emailid'].value,
      sir_gender: this.formGroup.controls['sir_gender'].value,
      sir_nationality: this.formGroup.controls['sir_nationality'].value,
      country: this.formGroup.controls['country'].value,
      state: this.formGroup.controls['state'].value,
      city: this.formGroup.controls['city'].value,
      mnumber: this.formGroup.controls['mnumber'].value,
      mnumber2: this.formGroup.controls['mnumber2'].value,
      picker: this.formGroup.controls['picker'].value,
      sir_dob: moment(this.formGroup.controls['sir_dob'].value).format('YYYY-MM-DD').toString(),
      form_address: this.formGroup.controls['form_address'].value,
      //driving_license: this.formGroup.controls['driving_license'].value,
      age: this.formGroup.controls['age'].value,
      sir_photo: this.formGroup.controls['sir_photo'].value,
      radion_button: this.formGroup.controls['radion_button'].value,
      sir_civilidfront: this.formGroup.controls['sir_civilidfront'].value,
      license_card: this.formGroup.controls['license_card'].value,
      light_license: this.formGroup.controls['light_license'].value,
      heavy_license: this.formGroup.controls['heavy_license'].value,
      light_issue_date: moment(this.formGroup.controls['light_issue_date'].value).format('YYYY-MM-DD').toString(),
      heavy_issue_date: moment(this.formGroup.controls['heavy_issue_date'].value).format('YYYY-MM-DD').toString(),
      // light_issue_date: ,
      // heavy_issue_date: ,
      license_number: this.formGroup.controls['license_number'].value,
      sir_addrline1: this.formGroup.controls['sir_addrline1'].value,
      sir_addrline2: this.formGroup.controls['sir_addrline2'].value,
      learner_fee: this.formGroup.controls['learner_fee'].value,
      learner_fee_status: this.formGroup.controls['learner_fee_status'].value,
      paid_by: this.formGroup.controls['paid_by'].value,
      batchmgmtdtls: this.batchmgmtdtls,
      finalsave: 1,
      cour:this.batchdata_data.course,
      batchno:this.batch_number
    }
    
    if(this.formGroup.valid && this.courseselectForm.valid){
      //if(this.courseselectForm.valid){
            this.learnerService.learnerage(this.courseselectForm.value,postParams).subscribe(res => {
              this.age = res.data.data.scd_agelimit;
            });
            this.disableSubmitButton = true;
            this.learnerService.registerLearnerFinal(this.courseselectForm.value,postParams).subscribe(res => {
            this.disableSubmitButton = false;
            
            // Check Cilvil Validation ends Here
            if(res.data.valstatus == 1){
              this.civilstatus = true;
              if(this.batch_number == res.data.dataStaff.bmd_Batchno){
                swal({
                  title: this.i18n('This Learner is already registered.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
      
              if(this.batch_number != res.data.dataStaff.bmd_Batchno){
                swal({
                  title: this.i18n('If the Learner wishes to attend Training here, please ensure they cancel their Registration with the respective Centre as they are already registered on OPAL USP in another Batch.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
              
              //this.resetLearner();
              //return false;
      
            }
      
            if(res.data.valstatus == 2){
              this.civilstatus = true;
              if(res.data.batch_type == 3){
                swal({
                  title: this.i18n('Please register this Learner in the Batch as a "Refresher" since they have already completed the course and the Permit Card is not expired / not crossed '+ res.data.lnrrcard_exp_days +' days from the date of expiry.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
      
              // Not In Use
              if(res.data.batch_type == 4){
                swal({
                  title: this.i18n('Please register this Learner in the Batch as "Initial" since they have already completed the course and the Permit Card is expired and crossed '+ res.data.lnrrcard_exp_days +' days from the date of expiry.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
      
              if(res.data.batch_type == 5){
                swal({
                  title: this.i18n('Please register this Learner in the Batch as a "Refresher" since they have already completed the course and the Permit Card is not expired / not crossed '+ res.data.lnrrcard_exp_days +' days from the date of expiry.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
              //this.resetLearner();
              //return false;
            }
      
            if(res.data.valstatus == 3){
              this.civilstatus = true;
              if(res.data.batch_type == 1){
                swal({
                  title: this.i18n('Please Register this Learner in the Batch as "Initial" since they have not completed the Course.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
              if(res.data.batch_type == 2){
                swal({
                  title: this.i18n('Please register this Learner in the Batch as a "Refresher" since they have already completed the course and the Permit Card is not expired / not crossed '+ res.data.lnrrcard_exp_days +' days from the date of expiry.'),
                  text: " ",
                  icon: 'warning',
                  buttons: [false, this.i18n('learnerregister.ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                })
              }
              //this.resetLearner();
              //return false;
            }
            
            if(res.data.valstatus == 5){
              this.civilstatus = true;
              swal({
                title: this.i18n('Please Register this Learner in the Batch as "Initial" since they have not completed the Course.'),
                text: " ",
                icon: 'warning',
                buttons: [false, this.i18n('learnerregister.ok')],
                dangerMode: true,
                className: this.dir =='ltr'?'swalEng':'swalAr',
                closeOnClickOutside: false
              })
              //this.resetLearner();
              //return false;
      
            }



            // Check Cilvil Validation ends Here

              if (res.success) {
                if(res.data.data == 'already_registered'){
                  swal({
                    title: this.i18n('learnerregister.alredreg'),
                    text: " ",
                    icon: 'warning',
                    buttons: [false, this.i18n('learnerregister.ok')],
                    dangerMode: true,
                    className: this.dir =='ltr'?'swalEng':'swalAr',
                    closeOnClickOutside: false
                  })
                }else if(res.data.data == 'same_course'){
                  swal({
                    title: this.i18n('learnerregister.alredregfor'),
                    text: " ",
                    icon: 'warning',
                    buttons: [false, this.i18n('learnerregister.alredregfor')],
                    dangerMode: true,
                    className: this.dir =='ltr'?'swalEng':'swalAr',
                    closeOnClickOutside: false
                  })
                }else if(res.data.data == 'age_limit'){
                  swal({
                    title: this.i18n('Age of Learner should be greater than ') +  this.age  + this.i18n(' Years.'),
                    text: " ",
                    icon: 'warning',
                    buttons: [false,this.i18n('learnerregister.ok')],
                    dangerMode: true,
                    className: this.dir =='ltr'?'swalEng':'swalAr',
                    closeOnClickOutside: false
                  })
                } else if(res.data.data == 'card_limit'){
                  swal({
                    title: this.i18n('learnerregister.thiscour'),
                    text: " ",
                    icon: 'warning',
                    buttons: [false,this.i18n('learnerregister.ok')],
                    dangerMode: true,
                    className: this.dir =='ltr'?'swalEng':'swalAr',
                    closeOnClickOutside: false
                  })
                } else if(res.data.data == 'batch_notnew'){
                  swal({
                    title: this.i18n('This batch not In new Status'),
                    text: " ",
                    icon: 'warning',
                    buttons: [false,this.i18n('learnerregister.ok')],
                    dangerMode: true,
                    className: this.dir =='ltr'?'swalEng':'swalAr',
                    closeOnClickOutside: false
                  })
                } else{
                  let data = res.data.data;
                  this.staffrep_id = data.lrhd_staffinforepo_fk;
                  this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
                  this.courseselectForm.controls['learnerreghrddtls_pk'].setValue(data.learnerreghrddtls_pk);
                  this.formGroup.controls['staffinforepo_fk'].setValue(data);
                  
                  this.toastr.success(this.i18n('learnerregister.learregsucc'), ''), {
                          timeOut: 2000,
                          closeButton: false,
                        };

                        this.learnerService.getcertified(postParams).subscribe(rescert => {
                          this.getcert= rescert.data;
                        });
                        //candidatemanagement/viewlearner/LVI-2023-029
                        this.router.navigate(['/candidatemanagement/viewlearner/' + this.batch_number])
                  
                }
              }
              // if(data.data.status=='1'){
              //     this.toastr.success('Learner Registered Successfully.', ''), {
              //       timeOut: 2000,
              //       closeButton: false,
              //     };
              //     //candidatemanagement/viewlearner/LVI-2023-029
              //     this.router.navigate(['/candidatemanagement/viewlearner/' + this.batch_number])
              //   }else{
              //     this.toastr.success('Learner Registered Successfully.', ''), {
              //       timeOut: 2000,
              //       closeButton: false,
              //     };
              //   } 

            });
        // }else{
        //   this.focusInvalidInput(this.courseselectForm);
        // }
    }else{
       this.focusInvalidInput(this.formGroup);
       this.fileeselect = true;
    }
    
  }


  editStaffedu(element){
    this.staffeduedit=true;
    // this.disableSubmitButton = true;
    //this.ShowHide = false;
    //this.staffformshow = true;
    this.staffleveldropdown();
    this.statetutdropdown(element.sacd_opalcountrymst_fk);
    this.citytutdropdown(element.sacd_opalstatemst_fk,element.sacd_opalcountrymst_fk);
    this.educationformshow = true;
    if(element.sacd_certupload){
      this.educationInput.selectedFilesPk = [element.sacd_certupload];
    }else{
      this.educationInput.selectedFilesPk = [];
    }
    this.staffFormedu.patchValue({
        //cont_type: ['', Validators.required],
        institute_name: element.sacd_institutename,
        degree_cert: element.sacd_degorcert,
        education_files: element.sacd_certupload,
        //year_join: element.sacd_startdate,
        GradeDate: element.sacd_enddate,
        gpa_grade: element.sacd_grade,
        // instute_locate:  ['', Validators.required],
        edut_level:  element.sacd_edulevel,
        institue_country:  element.sacd_opalcountrymst_fk,
        inst_city:  element.sacd_opalcitymst_fk,
        inst_state:  element.sacd_opalstatemst_fk,
        staffacademics_pk: element.staffacademics_pk,
      //file_award : element.appintit_doc,
     });
     setTimeout(() => {
      // this.disableSubmitButton = false;
      },2000);
   //this.pageScrolltopeduform()
  }

  editStaffwork(element){
    this.staffworkedit=true;
    //this.ShowHide = false;
    //this.staffformshow = true;
    //this.added = false;
    //this.staffleveldropdown();
    //alert(element.sexp_opalstatemst_fk)
    this.stateworkdropdown(element.sexp_opalcountrymst_fk);
    this.cityworkdropdown(element.sexp_opalstatemst_fk,element.sexp_opalcountrymst_fk);
    if(element.sexp_profdocupload){
      this.WorkInput.selectedFilesPk = [element.sexp_profdocupload];
    }else{
      this.WorkInput.selectedFilesPk = [];
    }
    this.workexpformshow = true;
    this.staffworkexperienceForm.patchValue({
      oragn_name: element.sexp_employername,
      //workdate: element.sexp_eod,
      designat: element.sexp_designation,
      date_join: element.sexp_doj,
      file_workexperience: element.sexp_profdocupload,
      //curr_work: element.sexp_currentlyworking,
      employ_country: element.sexp_opalcountrymst_fk,
      employ_state: element.sexp_opalstatemst_fk,
      employ_city: element.sexp_opalcitymst_fk,
      //sexp_staffinforepo_fk: element.test,
      staffworkexp_pk: element.staffworkexp_pk,
     });
     setTimeout(() => {
      // this.disableSubmitButton = false;
      },2000);

      if(element.sexp_currentlyworking == 1) {
        this.staffworkexperienceForm.controls['curr_work'].setValue(1);
        this.staffworkexperienceForm.controls['workdate'].reset();
        this.staffworkexperienceForm.controls['workdate'].setValidators(null);
        this.notallowed = true;
        this.worktilled = false;
        this.selectedDate = null;
        this.cleardate = false;
        this.isCheckboxDisabled = false;
        if(this.staffworkexperienceForm.disabled) {
          this.worktilled = true;
         }
        // alert('')
      }else {
        this.staffworkexperienceForm.controls['workdate'].setValue(element.sexp_eod);
      this.staffworkexperienceForm.controls['curr_work'].setValue(null);
        this.selectedDate = element.sexp_eod;
        this.notallowed = false;
        this.worktilled = true;
        this.cleardate = true;
        this.notallowed = true;
        this.worktilled = false;
        this.selectedDate = null;
        this.cleardate = false;
        this.isCheckboxDisabled = false;
        if(this.staffworkexperienceForm.disabled) {
          this.cleardate = false;
         }
      }
      if(this.staffworkexperienceForm.get('curr_work').value == 1) {
        this.staffworkexperienceForm.controls['curr_work'].setErrors(null);
        this.notallowed = true;
        this.staffworkexperienceForm.controls.workdate.reset();
        this.worktilled = false;
        this.cleardate = false;
        this.staffworkexperienceForm.controls['workdate'].setErrors(null);
       } else {
        // if(!this.staffworkexperienceForm.controls['workdate'].valid){
         this.notallowed = false;
         this.staffworkexperienceForm.controls['workdate'].setErrors({'incorrect': true });
         this.worktilled = true;
         this.isCheckboxDisabled = true;
        this.cleardate = true;
  
        // }
       }
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.mcm_RegistrationNo.toLowerCase().indexOf(searchTerms.mcm_RegistrationNo) !== -1 &&
        data.MCM_SupplierCode.toLowerCase().indexOf(searchTerms.MCM_SupplierCode) !== -1 &&
        data.MCM_CompanyName.toLowerCase().indexOf(searchTerms.MCM_CompanyName) !== -1 &&
        data.CyM_CountryName_en.toLowerCase().indexOf(searchTerms.CyM_CountryName_en) !== -1 &&
        //data.MRM_RenewalStatus.toLowerCase().indexOf(searchTerms.MRM_RenewalStatus) !== -1 &&
        data.UM_EmailID.toLowerCase().indexOf(searchTerms.UM_EmailID) !== -1 &&
        data.MRM_CreatedOn.toLowerCase().indexOf(searchTerms.MRM_CreatedOn) !== -1 &&
        data.invoicedays.toLowerCase().indexOf(searchTerms.invoicedays) !== -1 &&
        data.membersts.toLowerCase().indexOf(searchTerms.membersts) !== -1 &&
        data.subscriptionstatus.toLowerCase().indexOf(searchTerms.subscriptionstatus) !== -1 &&
        data.mcpd_pymtapprovalstatus.toLowerCase().indexOf(searchTerms.mcpd_pymtapprovalstatus) !== -1;
    }
    return filterFunction;
  }

  getStaffbasDtls(stfrepo) {
      
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo=false;
    this.mainIntrGridDatasStaffbas = new MainStaffbasPagination(this.http);
    this.sortEdu?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = {institute:this.institute.value,degree:this.degree.value,year_join:this.year_join.value,year_pass:this.year_pass.value,edu_level_search:this.edu_level_search.value,grade:this.grade.value,add_On:this.add_On.value,Last_Date:this.Last_Date.value};
     
    merge(this.sortEdu?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          
            return this.mainIntrGridDatasStaffbas.interStaffbasGridUtil(this.sortEdu.active, this.sortEdu.direction,  this.paginator.pageIndex - 1,
              this.page, this.querystr, this.searchControl.value,JSON.stringify(gridsearchvalue),this.appdtlssavetmp_id,this.memReg,stfrepo);
        }),
        map(data => {
          this.resultsLengthStaffbas = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataStaffbas = new MatTableDataSource(data);
        this.interRecListDataStaffbas.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDatathree = this.interRecListDataStaffbas.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
      });
  }

  getStaffworkDtls(stfrepo) {
    
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo=false;
    this.mainIntrGridDatasStaffwork = new MainStaffworkPagination(this.http);
    this.sortWork?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = {oranisation:this.oranisation.value,date_joined:this.date_joined.value,work_till:this.work_till.value,designation:this.designation.value,count:this.count.value,gover:this.gover.value,wilaya:this.wilaya.value,add_edOn:this.add_edOn.value,date_last:this.date_last.value};
    //alert(this.paginator.pageIndex - 1);
    merge(this.sortWork?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
            return this.mainIntrGridDatasStaffwork.interStaffworkGridUtil(this.sortWork.active, this.sortWork.direction,  this.paginator.pageIndex - 1,
              this.page, this.querystr, this.searchControl.value,JSON.stringify(gridsearchvalue),this.appdtlssavetmp_id,this.memReg,stfrepo);
        }),
        map(data => {
          this.resultsLengthStaffwork = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataStaffwork = new MatTableDataSource(data);
        this.interRecListDataStaffwork.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDatafour = this.interRecListDataStaffwork.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
      });
  }

  fifthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getStaffbasDtls(this.staffrep_id);
    this.Contentplaceloader=true;
  }

  sixthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getStaffworkDtls(this.staffrep_id);
    this.Contentplaceloader=true;
  }

  seventhPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }

  clearFiltereducation() {
    this.institute.setValue("");
    this.degree.setValue("");
    this.year_join.setValue("");
    // this.year_pass.setValue("");
    this.edu_level_search.reset()
    this.grade.setValue("");
    if(this.year_pass.touched || this.year_pass.value !== null) {
      this.year_pass.reset()
    }
    if(this.add_On.touched || this.add_On.value !== null) {
      this.add_On.reset()
    }
    if(this.Last_Date.touched || this.Last_Date.value !== null) {
      this.Last_Date.reset()
    }
    // this.getStaffworkDtls();
  }
  
  clearFilterework() {
    this.oranisation.setValue("");
     this.date_joined.setValue("");
    this.work_till.setValue("");
    this.designation.setValue("");
    this.count.setValue("");
    this.gover.reset();
    this.wilaya.reset();
    if(this.date_joined.value !== null) {
      // alert(this.date_joined.value)
      this.work_till.reset()
    }
    if(this.work_till.value != null) {
      this.work_till.reset()
    }
    if(this.add_edOn.value != null) {
      this.add_edOn.reset()
    }
    if(this.date_last.value != null) {
      this.date_last.reset()
    }
    // if(this.work_till.value != null) {
    //   this.work_till.reset()
    // }
    // if(this.add_edOn.value != null) {
    //   this.add_edOn.reset()
    // }
    // if(this.date_last.value != null) {
    //   this.date_last.reset()
    // }
  }

  changefee(value){
    if(value=='2'){
      this.showpayment=true;
    }else{
      this.showpayment=false;
      this.showpaymentdone=false;
      //this.courseselectForm.controls['learner_fee_status'].reset();
      this.courseselectForm.controls['company_name'].reset();
      this.courseselectForm.controls['paid_by'].reset();
    }
  }

  changefeedone(value){
    if(value=='2'){
      this.showpaymentdone=true;
    }else{
      this.showpaymentdone=false;
      this.courseselectForm.controls['company_name'].reset();
    }
  }

  backtobatch() {
    // this.router.navigate(['/candidatemanagement/viewlearner/' + this.batch_number])
  }

  viewcard(id) {
    this.assessmentService.viewcard(id).subscribe(data => {
      let pdfUrl = data.data.data;
      console.log(pdfUrl)
      window.open(pdfUrl, '_blank');
    });
   
  }

  gobatch(){
    
      swal({
        title: this.i18n('Changes you made may not be saved.'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('Cancel'), this.i18n('Ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.router.navigate(['/batchindex/batchgridlisting/'], { queryParams: { rt: 'no'} });        
        }
      });
    
  }

    showhideeducationform(value) {
    this.educationformshow = value;
    if(value == true){
      this.staffFormedu.controls['GradeDate'].reset();
      this.educationInput.selectedFilesPk = [];
    }
  }
  showhideworkexpform(value) {
    this.staffworkedit = false;
    this.workexpformshow = value;
    this.WorkInput.selectedFilesPk = [];
    this.staffworkexperienceForm.controls['file_workexperience'].reset();
    this.selectedDate = null;
    this.cleardate = false;
    this.isCheckboxDisabled = false;
    this.notallowed = false;
    this.worktilled = true;
  }
  viewbatch(){
    this.router.navigate(['/batchindex/batchviewpage/'+this.batch_number]);
  }
  cancelbatch(){
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field1', batchid: this.batch_number },
    });
    dialogRef.afterClosed().subscribe(result => {
      if(result.data)
      {
        this.batchService.ChangeBatchStatus(this.batch_number, 'cancel', result.data.comments).subscribe(res => {
          if (res.data.status == 1) {
            this.router.navigate(['/batchindex/batchgridlisting?rt=no']);
            this.toastr.success(this.i18n('learnerregister.batchcansucc'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
        });
      }
    });
  }

  MovebatchToTheory() {
    swal({
      title: 'Do you want to Move this Batch to Teaching (Theory)?',
      icon: 'warning',
      buttons: [this.i18n('viewlearners.no'), this.i18n('viewlearners.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.batchService.MovebatchToTheory(this.batch_number).subscribe(res => {
          if (res.data.status == 1) {
            this.router.navigate(['/candidatemanagement/viewlearner/'+this.batch_number]);
            this.toastr.success(this.i18n('viewlearners.batcstat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
        });
      }

    });

  }

  ViewLearners() {
    this.router.navigate(['/candidatemanagement/viewlearner/' + this.batch_number]);
  }

  ChangeAssessor() {
    this.router.navigate(['/assessmentreport/changeassessor/'+this.batch_number+'/false']);
  }
  ChangeAssessorReq() {
    this.router.navigate(['/assessmentreport/changeassessor/'+this.batch_number+'/true']);
  }
  downloadAttenance() {
    this.batchService.downloadattendance(this.batch_number).subscribe(res => {
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
      }
    });
  }

}



export class MainStaffbasPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffbasGridUtil(sort: string, order: string, page: number, 
      size: number, query: string, search?: string,gridsearchValues?:string, appdtlssavetmp_id?: number, memregPk?: number, stfrepo?: number): Observable<any> { 
    const sign = (order === 'desc') ? '-' : '';    
    const href = environment.baseUrl + 'center/app-center/getstaffbas';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}&memRegPk=${memregPk}&stfrepo=${stfrepo}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainStaffworkPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffworkGridUtil(sort: string, order: string, page: number, 
      size: number, query: string, search?: string,gridsearchValues?:string, appdtlssavetmp_id?: number, memregPk?: number, stfrepo?: number): Observable<any> { 
    const sign = (order === 'desc') ? '-' : '';    
    const href = environment.baseUrl + 'center/app-center/getstaffwork';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}&memRegPk=${memregPk}&stfrepo=${stfrepo}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}


