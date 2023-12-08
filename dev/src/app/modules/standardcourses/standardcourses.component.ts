import { Component, ViewEncapsulation, OnInit, Inject, ElementRef, ViewChild, Input, EventEmitter, Output, AfterViewInit, ViewChildren, QueryList } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl, FormGroupDirective, RequiredValidator, FormArray, AbstractControl } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute, ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { ReplaySubject } from 'rxjs/internal/ReplaySubject';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { BgiJsonconfigServices } from "@app/config/BGIConfig/bgi-jsonconfig-services";
import { MatTabGroup } from '@angular/material/tabs';
import { MatSort } from '@angular/material/sort';
import { MatTable, MatTableDataSource } from '@angular/material/table';
import { RegistrationService } from '@app/modules/registration/registration.service';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { Datadialog } from '../registration/supplierreg/supplierreg.component';
import { ApplicationService } from '@app/services/application.service';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BatchService } from '@app/services/batch.service';
import { formatDate } from '@angular/common';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { MatRadioChange } from '@angular/material/radio';
import { MatCheckboxChange } from '@angular/material/checkbox';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { ToastrService } from 'ngx-toastr';
import { Coords } from 'ngx-owl-carousel-o/lib/services/carousel.service';
import { environment } from '@env/environment';


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
export interface BranchData {
  applictionno: any;
  offictype: any;
  branchname: any;
  courtype: any;
  coursetitle: any;
  coursecate: any;
  requestfor: any;
  coursedeliver: any;
  position: any;
  applicationstatus: any;
  certification: any;
  addedon: any;
  dateofexpiry: any;
  lastUpdated: any;
}
export interface Element {
  awarding: any;
  position: any;
  lastaudited: any;
  document: any;
  addedon: any;
  status: any;
  lastupdated: any;
}
export interface courseList {
  coursetitle: any;
  courseduration: any;
  position: any;
  courselevel: any;
  coursetest: any;
  add: any;
  status: any;
  coursecat: any;
  lastUpdated: any;
}
export interface staffData {
  civilnumb: any;
  staffname: any;
  position: any;
  age: any;
  rolecourse: any;
  coursesubcat: any;
  add: any;
  // competcard: any;
  status: any;
  lastUpdated: any;
}

export interface educationData {
  institute: any;
  degree: any;
  position: any;
  educatelevel: any;
  gradedate: any;
  grade: any;
  certificatedoc: any;
  addedu: any;
  lastUpdated: any;
}
export interface workexperienceData {
  organname: any;
  datejoin: any;
  position: any;
  worktill: any;
  country: any;
  governate: any;
  wilayat: any;
  desig: any;
  addedu: any;
  lastUpdated: any;
}
export interface BatchtrainingData {
  selecteddate: string;
  id: number;
  schedule: number;
  start: string;
  end: string;
  hrs: string;


}
const ELEMENT_DATA: Element[] = [
  { position: 1, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'A', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
  { position: 2, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'D', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
  { position: 3, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'U', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
  { position: 4, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'N', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },

  // { position: 2, Awarding: 'ISO', LastAudited: 10-1-2023, Document: 'PNG', Status: 'APPROVED' },

];
const BranchList_Data: BranchData[] = [
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', branchname: 'Direct Contract', courtype: 'Standard', coursetitle: 'cyber Security', coursecate: 'computer sicence', requestfor: 'Training', coursedeliver: 'Arabian Traning', applicationstatus: '2', certification: 'A', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 2, applictionno: 'General Electric', offictype: 'Main Branch', branchname: 'Direct Contract', courtype: 'Standard', coursetitle: 'cyber Security', coursecate: 'computer sicence', requestfor: 'Training', coursedeliver: 'Arabian Traning', applicationstatus: '8', certification: 'E', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 3, applictionno: 'General Electric', offictype: 'Main Branch', branchname: 'Direct Contract', courtype: 'Standard', coursetitle: 'cyber Security', coursecate: 'computer sicence', requestfor: 'Training', coursedeliver: 'Arabian Traning', applicationstatus: '3', certification: 'N', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 4, applictionno: 'General Electric', offictype: 'Main Branch', branchname: 'Direct Contract', courtype: 'Standard', coursetitle: 'cyber Security', coursecate: 'computer sicence', requestfor: 'Training', coursedeliver: 'Arabian Traning', applicationstatus: '5', certification: 'E', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 5, applictionno: 'General Electric', offictype: 'Main Branch', branchname: 'Direct Contract', courtype: 'Standard', coursetitle: 'cyber Security', coursecate: 'computer sicence', requestfor: 'Training', coursedeliver: 'Arabian Traning', applicationstatus: '7', certification: 'N', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 6, applictionno: 'General Electric', offictype: 'Main Branch', branchname: 'Direct Contract', courtype: 'Standard', coursetitle: 'cyber Security', coursecate: 'computer sicence', requestfor: 'Training', coursedeliver: 'Arabian Traning', applicationstatus: '9', certification: 'A', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },

];

const Course_DATA: courseList[] = [
  { position: 1, coursetitle: 'Workshop', courseduration: '1 year', courselevel: 'Level 1', coursecat: 'Fire and safety', coursetest: 'Fire and safety', status: 'APPROVED', add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
];
// const staff_DATA: staffData[] = [
//   { position: 1, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'A', competcard: 'P' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 2, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'U', competcard: 'E' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 3, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'D', competcard: 'EP' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 4, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'N', competcard: 'A' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },


// ];

const Eduction_DATA: educationData[] = [
  { position: 1, institute: 'National Training Institute (NTI)', degree: '', educatelevel: '10-10-2012', gradedate: '10-10-2014', grade: 'A Grade', certificatedoc: ' ', addedu: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
];
const Work_DATA: workexperienceData[] = [
  { position: 1, organname: 'KHDA', datejoin: '10-10-2015', worktill: '10-10-2022',country: '',governate:'',wilayat:'', desig: 'Tutor', addedu: '10-10-2022', lastUpdated: '20-1-2023' },
];
// const timetrack_Data: Timedata[] = [
//   { position: 1, selecteddate: 'Sun 01-Jan-2023', dayschedule:'' , start: '', },
// ];
@Component({
  selector: 'app-standardcourses',
  templateUrl: './standardcourses.component.html',
  styleUrls: ['./standardcourses.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ],
  // animations: [SlideInOutAnimation, trigger('detailExpand', [
  //   state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
  //   state('expanded', style({ height: '*', display: 'block' })),
  //   transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  // ]),
  animations: [
    trigger('fadeInOut', [
      state('void', style({ height: '0', opacity: 0 })),
      state('*', style({ height: '*', opacity: 1 })),
      transition(':enter', animate('300ms ease-out')),
      transition(':leave', animate('300ms ease-in')),
    ]),
    
],

})
export class StandardcoursesComponent implements OnInit, AfterViewInit {
  payment: any;
  record: any;
  appcoursedtlstmppk: any;
  staffsubcat = [];
  showbranch: boolean = false;
  public uploadlength = [];
  coursecommand: any;
  coursecommandsts: any;
  courseappon: any;
  courseappby: any;
  intercomment: any;
  interaddedon: any;
  interaddedby: any;
  interstatus: number;
  appostaffinfotmp_pk: any;
  applicationtype: any ;
  staffcommand: any;
  staffappon: any;
  staffappby: any;
  staffstatus: any;

  saveproceed: boolean = false;

  coursesavebtn: boolean = false;
  docsavebtn: boolean = false;
  appinstinfomain_pk: any;

  loaderformeducation: boolean = false;
  loaderformwork: boolean = false;
  unitlength: number = 0;
  unitpk: any;
  selectedOption1: boolean = true;
  selectedOption2: boolean = false;
  userpermission: any = [];
  accessoravilabe: boolean = false;
  educationformshow: boolean = false;
  workexpformshow: boolean = false;
  samecentrecourse: boolean = false;
  subcatarr: any;
  standardcoursepk: any;
  rolesubcategory: any[]=[];
  rolecategory_remove: any;
  coursesubcategory: any[]=[];
  category_remove: any;
  staffconfigstatus: any;
  staffconfigmsg_ar: any;
  staffconfigmsg_en: any;
  subcatemultiple: any;
  vievalue: boolean = false;
  NorecordFound: boolean = false;
  applicationstatus: any = 0;
  mainRoleListforPopup: any[];
  subcatecoryListforpopup: any;
  roleforcourseListforpop: any[];
  subcatmultipleforlist: any[];
  uploadfiles: boolean;
  appdt_apptype: any;
  intertabmanditoryornot: boolean = false;
  alltabsarefilled: boolean = true;
  tab3filled: boolean = false;
maincomment: void;
  mainapprovdecon: any;
  first_form_disbale = false;
  documenttabfilled: boolean=false;
  i18n(key) {
    return this.translate.instant(key);
  }
  displayedColumns = ['irm_intlrecogname_en', 'last_aud', 'url', 'status', 'created_on', 'updated_on', 'action'];
  BranchListData = ['applictionno', 'appiim_officetype', 'appiim_branchname_en', 'pm_projectname_en', 'coursename_en', 'courscat_en', 'reqfor_en', 'delto_en', 'dateofexpiry', 'applicationstatus', 'certification', 'addedon', 'lastUpdated', 'action']; 
  courseListData = ['coursetitle', 'courseduration', 'courselevel', 'coursecat', 'coursetest', 'status', 'add', 'lastUpdated', 'action'];
  staffListData = ['sir_idnumber', 'sir_name_en', 'age', 'rolename_en', 'ccm_catname_en', 'status', 'competcard', 'addedon', 'updatedon', 'action'];
  educationList = ['institute', 'degree', 'edulvl_en', 'yearpass', 'grade', 'url' , 'addedu', 'lastUpdated', 'action'];
  // educationList = ['institute', 'degree', 'yearjoin', 'yearpass', 'grade', 'addedu', 'lastUpdated', 'action'];

  workExperienceList = ['organname', 'datejoin', 'worktill', 'ocym_countryname_en', 'osm_statename_en', 'ocim_cityname_en', 'desig', 'certificate' ,'addedu', 'lastUpdated', 'action'];
  // workExperienceList = ['organname', 'datejoin', 'worktill', 'desig', 'addedu', 'lastUpdated', 'action'];

  // timeList  = ['selecteddate' , 'dayschedule' , 'start' ];
  // dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  TrainingBranchData;
  courseData = new MatTableDataSource<courseList>(Course_DATA);
  @ViewChild('staffWorkExperienceFormReset') staffWorkExperienceFormReset: FormGroupDirective;
  StaffList: any;
  education;
  workExperience;
  BatchtrainingData = ['selecteddate', 'schedule', 'start',];
  batchtrainingdata: MatTableDataSource<BatchtrainingData>;
  public instituteform: FormGroup;
  public awaredForm: FormGroup;
  public documentForm: FormGroup;
  public CourseForm: FormGroup;
  public staffForm: FormGroup;
  public staffworkexperienceForm: FormGroup;
  public courseselectForm: FormGroup;
  public educationForm
  standardTemplate = 'course';
  public apptype = 'new';
  public appdoctype = 'new';
  public staffapptype = 'new';
  public staffeduapptype = 'new';
  public staffworkapptype = 'new';
  public interapptype = 'new';
  public staffotherdetails: boolean = false;
  public saveandproceed: boolean = true;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  sectorFilter: FormControl = new FormControl();
  filteredBussrc: ReplaySubject<any> = new ReplaySubject<any>(1);
  bussrcFilter: FormControl = new FormControl();
  governoratelist: any;
  wilayatlist: any;
  hidden: boolean = false;
  memshpverify: boolean;
  ShowHide: boolean = true;
  add_btn: boolean = true;
  operatcont: boolean = false;
  international: boolean = false;
  courses: boolean = false;
  staffform: boolean = false;
  selectedEstGovernorate: any;
  selectedEstGovernorateAr: any;
  Submitted: boolean = true;
  renewal: boolean = true;
  decline: boolean = true;
  // maxDate = new Date();
  maximumdate = moment();
  scrollTop: number;
  resultsLength: number;
  secondaryLength: number = 0;
  thirdLength: number = 0;
  fourthLength: number;
  fifthLength: number;
  sixLength: number;
  pageEvent: any;
  filtername = "Hide Filter";
  countryselect = '1'
  hidefilder: boolean = true;
  length = '';
  second = '';
  third = '';
  four = '';
  // showassessor:boolean = false;
  accessordata:any;
  public appstatus: any = '';
  public app_type: any = '';
  public prodpk: any = '';
  public apptemppk: any = '';
  standardorcustomized: any;
  editOption: boolean = true;
  updated: boolean = true;
  isValid: boolean = true;
  isValided: boolean = true;
  valided: boolean = true;
  validture: boolean = true;
  others: boolean = false;
  disableSubmitButton: boolean;
  perpage =
    BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;
  public pages: any;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  @Input() tog: any = "";
  dataSourceforpermission: any;
  public projectName: string
  permissionarray: any;
  finalpermissionarray: any = [];
  page: number = 10;
  page1: number = 10;
  page2: number = 10;
  page3: number = 10;
  page4: number = 10;
  page5: number = 10;
  ageinput: boolean = false;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;

  @ViewChild('formFocus') scrollElement: ElementRef;
  @ViewChild('companylogo') companylogoFilee: Filee;
  @ViewChild('Intrecog') Intrecog: Filee;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginator") paginator1: MatPaginator;
  @ViewChild("paginatorthird") paginator2: MatPaginator;
  @ViewChild("paginatorfourth") paginator3: MatPaginator;
  @ViewChild("paginatorfifth") paginator4: MatPaginator;
  @ViewChild("paginator") paginator5: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('sortstaffgrid') sortstaffgrid = new MatSort();
  @ViewChild('sortworkgrid') sortworkgrid = new MatSort();

  newstaff: boolean = true;
  expandedElement: boolean = false;

  spinnerButtonOption: MatProgressButtonOptions = {
    active: false,
    text: 'Verified',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  companyLogoFilee: any;
  drvInputed: DriveInput;
  drvInputed1: DriveInput;
  drvInputedmoheri: DriveInput;
  educationInput: DriveInput;
  @Input() mattab: number = 0;
  companydtls: any;
  standorcustom:any='standard';
  configurationlist: any;
  crnumverify: boolean;
  moherigradinglist: any;
  addressForm: FormGroup;
  selectslotForm: FormGroup;
  genderselect: string;
  genderShow: boolean = false;
  courselist = [];
  subcategory = [];
  interreg = [];
  countrylist = [];
  rolemst = [];
  rolemst_course = [];
  contacttypemst = [];
  countrymst = [];
  statemst = [];
  educationlvl = [];
  languages = [];
  dayschedule = []
  state = [];
  citymst = [];
  citylist = [[]];
  unit = [];
  firstgrid = [];
  days: string;


  branchlist = [];
  reqformst = [];
  deliverto = [];
  staffs = [];
  applyinternatdata = [];
  regpk: any;
  dataSource;
  interdata = [];
  docmst = [];
  referencepk;
  public staffreferencepk;
  batchtraningdata_data: any = [];
  businessUnitDataTemp: any;
  mainroleUnitDataTemp: any;
  rolemultiple: any;
  public bunitData: any;
  public contentinputloader = false;
  public postParams: any;
  public postUrl: any;
  public mcpPk: any = '';
  public oman: boolean = true;
  public nonoman: boolean = true;
  public userForm: FormGroup;
  noteHideShow: boolean = false;
  @Output() maindata = new EventEmitter<any>();
  @ViewChild('breadactive') breadactiveref!: ElementRef;
  @ViewChild(MatTable) table: MatTable<any>;
  @ViewChild(MatTable) mtable: MatTable<any>;
  tblplaceholder: boolean = false;
  gendershow: boolean = true;
  ageShow: boolean = true;
  deleteicon: boolean = true;
  hiddenbtn: boolean = false;
  loaderform: boolean = false;
  fileerror: boolean = true;
  availablepk = 64;
  avaliabledate: boolean = true;
  weekend: boolean = true;
  holiday: boolean = true;
  finalsubmitbtn:boolean = true;
  public nodocumentopload: boolean = false;

  public dateFilterSt: any = '';
  public dateFilterEd: any = '';
  daterange = new FormControl('', Validators.required);
  
  @ViewChildren("dataSelect") dataSelect: QueryList<any>;

  public optionSelect = [];
  searchGovernorate:any='';
  searchCourseTitlelist:any='';
  searchDeliverTo:any='';
  searchGovernorate1:any='';
  @Output() onDataSent = new EventEmitter<any>();
  public resubmit_status: any = 1;
  requiredfieldshow: boolean = true;
  public workInput: DriveInput;
  public requiredwork: boolean = false;
  public uploadedufiles: boolean = false;
  public isopen: any = {};
  private isFilterCleared: boolean = true;

  constructor(private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService,
    private remoteService: RemoteService,
    private profileService: ProfileService,
    private cookieService: CookieService,
    private appservice: ApplicationService,
    private regService: RegistrationService,
    public dialog: MatDialog,
    protected security: Encrypt,
    private localstorage: AppLocalStorageServices,
    private myRoute: Router,
    private secuirty: Encrypt,
    private batchService: BatchService, public toastr: ToastrService,
    public routeid: ActivatedRoute
  ) {
  }

  spinnerButtonOptionsmem: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };

  spinnerButtonOptionscr: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };

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
  today = new Date();
  maxDate = new Date();
  startDate = new Date('2023-02-23');
  endDate = new Date('2023-02-28');
  days2 = ['Sunday', 'Wednesday'];
  startTime = '10:30';
  endTime = '11:30';
  public ifarbic: boolean = false;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  transFun() {
    this.translate.setDefaultLang(this.cookieService.get('languageCode'));
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
  }
  ngOnInit() {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',last:'true' },
        ]   
   };
   this.remoteService.getbreadcrumCookieoutput().subscribe(data => { 
      if(data == 1){
        var breadCrumb ={
          title: 'Standard & Customized Course Certification',
            urls: [
              { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',last:'true' },
            ]   
       };
       this.remoteService.breadcrumCookieValue(breadCrumb);

        this.standardTemplate = 'course';     
       }
       if(data == 2){
        this.awardcancel();
      }
      if(data == 3){
        this.canclstaff();
      }
   
    });

  this.remoteService.breadcrumCookieValue(breadCrumb);

    this.userForm = this.formBuilder.group({
      sstarttime: [''],
      sendtime: [''],
    });
    this.optionSelect = [null];
    this.userpermission = this.localstorage.getInLocal('uerpermission');
    this.checkQueryParams();
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
        } else {
          this.filtername = "إخفاء التصفية";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
      this.drvInputed = {
        fileMstPk: 2,
        selectedFilesPk: []
      };
      this.drvInputed1 = {
        fileMstPk: 4,
        selectedFilesPk: []
      };
      this.drvInputedmoheri = {
        fileMstPk: 2,
        selectedFilesPk: []
      };
      this.educationInput = {
        fileMstPk: 2,
        selectedFilesPk: []
      };
      this.workInput = {
        fileMstPk: 2,
        selectedFilesPk: []
      };
    });
    //testing purpose

    //  this.appservice.certificategeneration().subscribe(res => {
    //    });
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.Standardcourese();
    this.getGoverenoratelist();
    this.getconfigurations();
    this.getMoherigradinglist();

    this.getfirstgrid(this.page, 0, null);
    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);

    this.CourseForm.controls['cour_subcate'].valueChanges.subscribe(value => {
      this.subcatecoryListforpopup = [];
        if (value) {
  
          let index = this.subcategory.findIndex(x => x.subpk == value[0]);
  
          if (index !== -1) {
            this.businessUnitDataTemp = this.subcategory[index].subcategory_en;
          }
         
          if(value.length > 1)
          {
          value.forEach(element => {
            let indexnew = this.subcategory.findIndex(x => x.subpk == element);
            if (indexnew !== 0) {
            this.subcatecoryListforpopup.push(this.subcategory[indexnew].subcategory_en);
            }
          });
        }
        else{
          this.subcatecoryListforpopup = [];
        }
  
          console.log(this.subcatecoryListforpopup);
        } else {
          this.businessUnitDataTemp = '';
          this.subcatecoryListforpopup = [];
        }
  
  
      });
      this.staffForm.controls['role'].valueChanges.subscribe(value => {
        this.mainRoleListforPopup = [];
        if (value) {
          let index = this.rolemst.findIndex(x => x.rolemst_pk == value[0]);
          if (index !== -1) {
            this.mainroleUnitDataTemp = this.rolemst[index].rm_rolename_en;
          if(value.length > 1)
          {
            value.forEach(element => {
              let indexnew = this.rolemst.findIndex(x => x.rolemst_pk == element);
              if (indexnew !== 0) {
              this.mainRoleListforPopup.push(this.rolemst[indexnew].rm_rolename_en);
              }
            });
          }
          else{
            this.mainRoleListforPopup = [];
          }
            
      
          }
        } else {
          this.mainroleUnitDataTemp = '';
          this.mainRoleListforPopup = [];
        }
      });

    this.courseselectForm.controls['rolefor_cour'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.rolemst.findIndex(x => x.rolemst_pk == value[0]);
        if (index !== -1) {
          this.rolemultiple = this.rolemst[index].rm_rolename_en;

          if(value.length > 1)
          {
            value.forEach(element => {
              let indexnew = this.rolemst.findIndex(x => x.rolemst_pk == element);
              if (indexnew !== 0) {
              this.roleforcourseListforpop.push(this.rolemst[indexnew].rm_rolename_en);
        }
            });
          }
          else{
            this.roleforcourseListforpop = [];
          }
        }
      } else {
        this.rolemultiple = '';
        this.roleforcourseListforpop = []
      }
    });
    this.courseselectForm.controls['select_coursubcate'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.staffsubcat.findIndex(x => x.appcoursetrnstmp_pk == value[0]);
        if (index !== -1) {
          this.subcatemultiple = this.staffsubcat[index].ccm_catname_en;
          if(value.length > 1)
          {
            value.forEach(element => {
              let indexnew = this.staffsubcat.findIndex(x => x.appcoursetrnstmp_pk == element);
              if (indexnew !== 0) {
              this.subcatmultipleforlist.push(this.staffsubcat[indexnew].ccm_catname_en);
        }
            });
          }
          else{
            this.subcatmultipleforlist = [];
          }
        }
      } else {
        this.subcatemultiple = '';
        this.subcatmultipleforlist = [];
      }
    });

    this.getcountrymst();
    this.maxDate.setFullYear(new Date().getFullYear() - 18);

    this.staffForm.controls['date_birth'].valueChanges.subscribe(value => {

      let m = moment();
      let years = m.diff(value, 'years');
      m.add(-years, 'years');
      let months = m.diff(value, 'months');
      m.add(-months, 'months');
      let days = m.diff(value, 'days');

      this.staffForm.controls.age.setValue(years)
      // if(this.staffForm.controls.age.value == true) {
      this.ageShow = false;
      // }
    })
    this.staffForm.controls['gend_er'].valueChanges.subscribe(value => {
      if (this.staffForm.controls.gend_er.value == 1) {
        this.genderselect = '1';
        this.gendershow = false;
        this.staffForm.controls.gender_address.setValue(this.i18n('staff.mr'))
      }
      else if (this.staffForm.controls.gend_er.value == 2) {
        this.genderselect = '2';
        this.gendershow = false;
        this.staffForm.controls.gender_address.setValue(this.i18n('staff.ms'))
      }
      else {
        this.genderselect = ' ';
      }
    });
    this.onchangecount();
    // this.arrayformcontols.forEach(control => {
    //   control.valueChanges.subscribe(() => {
    //     this.isFilterCleared = false;
    //   });
    // });
  }
  ngAfterViewInit() {
    // setInterval(() => this.transFun(), 1000)
    this.routeid.queryParams.subscribe(params => {
      var type = params['tye'];
      var key = params['k'];
      console.log(params)
      var renew =this.security.decrypt(params['renew']);
      var ap = this.security.decrypt(params['ap']);
      var pr = this.security.decrypt(params['pr']);
      var ty = this.security.decrypt(params['ty']);
      var as = Number(this.security.decrypt(params['as']));
      var at = this.security.decrypt(params['at']);
      
      if(renew=='1' && as == 2 || as == 4 || as == 7 || as == 19 || (as >= 10 && as <= 16) || as == 20)
      {
        ty = 'view';
        this.editapplicationdata(ap,pr,ty,as,at);
      }
      else if(renew == '1' && as == 3)
      {
        ty = 'edit';
        this.editapplicationdata(ap,pr,ty,as,at);
      }
      else if(renew == '1' && ((as >= 5 && as <= 9) ||as == 18 ) )
      { 
        alert(as)
          this.myRoute.navigate(['standardcourse/home'],
          { queryParams: { p: this.secuirty.encrypt(2), t: this.secuirty.encrypt(at), s: this.secuirty.encrypt(as), at: this.secuirty.encrypt(ap), bc: 'spym', f: 'sc',nwrn: 'rnj' } });
      }
      else if(renew == '1' && as == 17){
        ty = 'renew';
        this.editapplicationdata(ap,pr,ty,as,at);
      }
      
      
      setTimeout(() => {
        if (type == 's') {
          this.coures_type.setValue(['2']);
          this.applyFilter(key, type)
        } else if (type == 'c') {
          this.coures_type.setValue(['3']);
          this.applyFilter(key, type)
        }
      }, 3000);

    })
    this.checkQueryParams();
  }
  birthdate: Date;
  aged: number;

  calculateAge(event: MatDatepickerInputEvent<Date>) {
    const birthDate = new Date(event.value);
    const today = new Date();
    const diffInMilliseconds = Math.abs(today.getTime() - birthDate.getTime());
    const age = Math.floor(diffInMilliseconds / (1000 * 3600 * 24 * 365));
    // console.log(age); // or set the age to a component variable to display in the template
  }
  getfirstgrid(limit, page, searchkey) {
    this.tblplaceholder = true;
    this.appservice.getfirstgrid(limit, page, searchkey).subscribe(res => {
      this.tblplaceholder = false;

      if (res.status == 200) {
        // this.applyinternatdata =res['data'];
        this.resultsLength = res['data']['firstgrid']['totalcount'];

        this.TrainingBranchData = new MatTableDataSource<BranchData>(res['data']['firstgrid']['applydata']);
        this.firstgrid = res['data']['firstgrid']['applydata'];
        this.reqformst = res['data']['reqfor'];
        this.TrainingBranchData.sort = this.sort;
      }
    });

  }
  getcoursedata() {

    this.appservice.getcoursedata().subscribe(res => {


      this.courselist = res.data.courselist;
      this.reqformst = res.data.requestformst;
      this.deliverto = res.data.deliverto;
     

    });



  }
  // formValue(label,pkey,doc) {
  //   let valuarr = this.documentForm.get('remark_'+label).patchValue(doc.documentdtlsmst_pk);
  //   let valuarr1 = this.documentForm.get('doc_'+label).patchValue(doc.documentdtlsmst_pk);

  // //  valuarr.matchcriteria = event.value;
  // //  (((this.documentForm.get(catkey) as FormGroup).get(fkey) as FormArray).at(0) as FormGroup).get(ftype).patchValue({ dataVal: valuarr })
  // }
  formParentArrayFormation(label, pkey, doc) {
    if (this.appdoctype == 'new') {
      this.documentForm.addControl('remark_' + label, new FormControl());
      this.documentForm.addControl('doc_' + label, new FormControl());
      this.documentForm.addControl('file_' + label, new FormControl('', Validators.required));
      // this.documentForm.addControl('file1_'+label, new FormControl('',Validators.required));
      this.documentForm.addControl('redio_' + label, new FormControl('1', []));
      this.documentForm.addControl('referpk_' + label, new FormControl(doc.documentdtlsmst_pk, []));
    } else {
      this.documentForm.addControl('remark_' + label, new FormControl(doc.appdst_remarks, []));
      this.documentForm.addControl('doc_' + label, new FormControl(doc.appdocsubmissiontmp_pk, []));
      this.documentForm.addControl('file_' + label, new FormControl(doc.appdst_memcompfiledtls_fk, []));
      if (doc.appdst_submissionstatus) {
        this.documentForm.addControl('redio_' + label, new FormControl(doc.appdst_submissionstatus, null));
      } else {
        this.documentForm.addControl('redio_' + label, new FormControl('1', null));
      }
      this.documentForm.addControl('referpk_' + label, new FormControl(doc.documentdtlsmst_pk, []));

      // this.changeValue(doc.appdst_submissionstatus,label,doc.documentdtlsmst_pk)
      let val = this.docmst.findIndex(x => x.documentdtlsmst_pk == doc.documentdtlsmst_pk);
      this.docmst[val]['ddm_status'] = doc.appdst_submissionstatus;
      this.drvInputed1.selectedFilesPk = [doc.appdst_memcompfiledtls_fk];
      // this.mark.redio_+id.setValue(valid);

      var ctralname = 'remark_' + label;
      var docctrlname = 'file_' + label;
      if (doc.appdst_submissionstatus == 1) {
        $('#doc_' + label).show();
        $('#re_' + label).hide();
        this.documentForm.controls[docctrlname].setValidators(Validators.required);
        this.documentForm.controls[ctralname].setValidators(null);
      } else if (doc.appdst_submissionstatus == 2) {

        $('#doc_' + label).hide();
        $('#re_' + label).show();
        this.documentForm.controls[docctrlname].setValidators(null);
        this.documentForm.controls[ctralname].setValidators(Validators.required);
      } else {
        $('#doc_' + label).show();
        $('#re_' + label).hide();
        this.documentForm.controls[docctrlname].setValidators(Validators.required);
        this.documentForm.controls[ctralname].setValidators(null);

      }
      this.isValid = doc.appdst_submissionstatus;
    }
    // this.formValue(label,pkey,doc);
    // Object.keys(this.tryFormGroup[pkey].category[0]).forEach(key => {
    //   (this.myFormGroup.get(this.tryFormGroup[pkey]['labelName']) as FormGroup).addControl(key + 'type', new FormControl('1', []))
    // })
  }
  onCommentChange(textValue: string, index) {
    this.uploadlength[index] = textValue.length;

  }

  nextCourse() {

    console.log(this.documentForm)
    if (this.documentForm.valid) {
      this.disableSubmitButton = true
      this.appservice.savedocuments(this.documentForm.value, this.referencepk, this.appdoctype).subscribe(res => {

        if (res.status == 200) {
          this.tab3filled= true;
          this.checkalltabsarefilled();
          this.disableSubmitButton = false;
          this.docmst = [];
          this.documentForm = new FormGroup({});
          this.documentForm.addControl('total_mst', new FormControl('', []));
          this.appdoctype = 'edit';
          this.appservice.getdocumentdata(this.referencepk, this.standardorcustomized, '', '').subscribe(res => {
            this.docmst = res.data.docmst;
            this.mark.total_mst.setValue(res.data.total);
            if(res.data.datapresented == 'yes'){
              this.documenttabfilled =true;
            }else{
              this.documenttabfilled =false;
            }
          });

        }
        this.mattab = 3;

      });
    }

    // const formdata = new FormData(this.documentForm);
    this.scrollTo('pagescroll');
    // this.focusInvalidInput(this.documentForm);
    // return false; 

  }

  docradiobtn(valid, id, idpk) {
    let val = this.docmst.findIndex(x => x.documentdtlsmst_pk == idpk);

    this.docmst[val]['ddm_status'] = Number(valid);
    this.docmst[val]['appdst_submissionstatus'] = Number(valid);
    // this.docmst.splice([val]['ddm_status'],1,valid)
    // this.mark.redio_+id.setValue(valid);
    var ctralname = 'remark_' + id;
    var docctrlname = 'file_' + id;
    if (valid == 1) {
      $('#doc_' + id).show();
      $('#re_' + id).hide();

      this.documentForm.controls[ctralname].reset()
      this.documentForm.controls[docctrlname].setValidators(Validators.required);
      this.documentForm.controls[ctralname].clearValidators();

    } else {
      this.documentForm.controls[docctrlname].clearValidators();
      this.documentForm.controls[ctralname].setValidators(Validators.required);
      $('#doc_' + id).hide();
      $('#re_' + id).show();


    }
    
    this.documentForm.controls[ctralname].updateValueAndValidity(); 
    this.documentForm.controls[docctrlname].updateValueAndValidity();
    this.isValid = valid;
  }

  getdocmstdata(standpk, reqfor) {
    this.appservice.getdocmstdata(this.standorcustom, standpk, reqfor).subscribe(res => {
      this.docmst = res.data.docmst;

      this.mark.total_mst.setValue(res.data.total);

    });
  }
  getroleforcourse(referencek,standaradcustomize,coursefk,reqfor){

    this.appservice.getroleforcourse(referencek,standaradcustomize,coursefk,reqfor).subscribe(res => {
      this.rolemst_course = res.data.roleforcourse;

    });
  }
  getcustomcourse() {

    this.appservice.getcustomcourse().subscribe(res => {

      this.courselist = res.data.courselist;
      this.reqformst = res.data.requestformst;
      this.deliverto = res.data.deliverto;

    });
  }
  getstaffsinfo(institutepk) {
    this.appservice.getstaffsinfo(institutepk).subscribe(res => {
      this.staffs = res.data.staffinfo;
    });
  }
  branchchoose(brancpk) {
    this.branchlist.forEach(z => {
      if(z.appinstinfomain_pk == brancpk){
          if(z.appdm_issuspended == 1){
            swal({
              title: this.i18n('A Course cannot be created for this Centre as the Centre Certification has been Suspended.'),
              text: '',
              icon: 'warning',
              buttons: [false, this.i18n('uploadfile.ok')],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            });
            this.CourseForm.controls['bran_ch'].reset();
          }
      }
    });
    this.appinstinfomain_pk = brancpk
  }
  selectedcourse(value) {


    this.courselist.forEach(z => {
      if (z.pk == value) {

        if (this.standorcustom == 'standard') {

          this.appservice.chechalredyapply(z.pk, z.scm_requestfor, this.appinstinfomain_pk).subscribe(res => {

            if (res.data.exists == 'yes') {
              swal({
                title: this.i18n('This course already applied choose another course'),
                text: '',
                icon: 'warning',
                buttons: [false, this.i18n('uploadfile.ok')],
                dangerMode: true,
                className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                closeOnClickOutside: false
              });
              this.cour.course_titleen.reset();
              this.cour.cour_cate.reset();
              this.cour.cour_level.reset();
            } else {
              this.reqformst = res.data.requestformst;
              this.cour.cour_cate.setValue(z.ccm_catname_en);
              this.cour.cour_level.setValue(z.level);
              // this.cour.request_for.setValue(Number(z.scm_requestfor));
            }
            this.cour.cour_subcate.reset();

          });

           // scm_assessmentin 16 - Same Centre ,17 - different centre 
           if(z.scm_assessmentin == 16){
            this.samecentrecourse = true;
           }
           // scm_isintlreorgreq  1-manditory 2 non manditory
           if(z.scm_isintlreorgreq == 1){
            this.intertabmanditoryornot = true;
           }else {
            this.intertabmanditoryornot = false;
           }
       
        } else {
          this.cour.cour_cate.setValue(z.ccm_catname_en);
          this.cour.cour_level.setValue(z.level);
          // this.cour.request_for.setValue(Number(z.scm_requestfor));

        }


        if (z.scm_coursecategorymst_fk) {
          this.appservice.getseccategory(z.pk, 2).subscribe(res => {

            this.subcategory = res.data.subcategory;

          });
        }
        if (z.appocm_coursesubcategorymst_fk) {
          this.appservice.getseccategory(z.appocm_coursesubcategorymst_fk, 3).subscribe(res => {

            this.subcategory = res.data.subcategory;

          });
        }
        if (this.standorcustom == 'custom') {
          this.unitpk = z.pk;
          this.appservice.getunit(z.pk, 10, 0).subscribe(res => {

            this.unit = res.data.unit;
            this.unitlength = this.unit.length;

          });
        }

      }
    });

    this.cour.cour_cate.disable();
    this.cour.cour_level.disable();
  }
  selectedreqfor(value) {

    this.getdocmstdata(this.cour.course_titleen.value, value);

  }

  delivertochange(value) {

    if (value == 'others') {
      this.others = true;
    } else {
      this.others = false;
    }

  }
  //check query params to redirect the pament page & site audit page   
  checkQueryParams() {
    this.routeid.queryParams.subscribe(params => {
      this.appstatus = this.security.decrypt(params['s']);
      this.app_type = this.security.decrypt(params['t']);
      this.prodpk = this.security.decrypt(params['p']);
      this.apptemppk = this.security.decrypt(params['at']);
      console.log('data for query', this.appstatus, this.app_type, this.prodpk, this.apptemppk)
      //const myArray: any[] = [5,6,7,8,9];
      //if(myArray.includes(this.appstatus)){
      if (this.appstatus == 5 || this.appstatus == 6 || this.appstatus == 7 || this.appstatus == 8 || this.appstatus == 9 || this.appstatus == 18) {
        if(this.appstatus == 5 || this.appstatus == 6 ||  this.appstatus == 18){
        this.disableSubmitButton = true;
        var breadCrumb ={
          title: 'Standard & Customized Course Certification',
            urls: [
              { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
              { title: 'Payment', url: '/standardcourse/home',last:'true' },
            ]   
       };
       this.remoteService.breadcrumCookieValue(breadCrumb);
      }else{
        var breadCrumb ={
          title: 'Standard & Customized Course Certification',
            urls: [
              { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
              { title: 'Site Audit', url: '/standardcourse/home',last:'true' },
            ]   
       };
       this.remoteService.breadcrumCookieValue(breadCrumb);
      }
        this.appservice.getpaymentinfo(this.apptemppk, 1).subscribe(res => {
          if (res.status == 200) {
            setTimeout(() => {
              this.payment = res.data.payment;
              this.record = res.data.record;
              // console.log('payment standard data', this.payment);
              this.standardTemplate = 'payment';

              // document.querySelector('.page-title.active').innerHTML = 'Standard & Customized Course Certification - Payment'; 

              this.disableSubmitButton = false;
            }, 1000);
          }
        });
      } else {
        this.getfirstgrid(this.page, 0, null);
        this.standardTemplate = 'course';
      }
    });

  }
  getstaffedu(limit, page, searchkey, referencepk) {
    this.tblplaceholder = true;
    this.appservice.getstaffedu(limit, page, searchkey, referencepk).subscribe(res => {
      this.tblplaceholder = false;

      if (res.status == 200) {
        this.education = new MatTableDataSource<educationData>(res.data.education);
        this.fourthLength = res['data']['totalcount'];
        this.education.sort = this.sort;
      }
    });
  }
  getstaffwork(limit, page, searchkey, referencepk) {
    this.NorecordFound = true;

    this.appservice.getstaffwork(limit, page, searchkey, referencepk).subscribe(res => {
      if (res.status == 200) {
        this.NorecordFound = false;

        this.workExperience = new MatTableDataSource<workexperienceData>(res.data.workexp);
        this.fifthLength = res['data']['totalcount'];
        this.workExperience.sort = this.sortworkgrid;
      }
    });
  }

  selectcivilid(value) {

    this.staffs.forEach(z => {
      if (z.staffinforepo_pk == value) {
        this.disableSubmitButton = true;
        this.appservice.getstaffavialabe(z.staffinforepo_pk, this.referencepk).subscribe(res => {
          if (res.status == 200) {
            this.disableSubmitButton = false;
            if (res.data.alreadymapped == 'yes') {
              swal({
                title: this.i18n('institute.first'),
                text: '',
                icon: 'warning',
                buttons: [false, this.i18n('uploadfile.ok')],
                dangerMode: true,
                className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                closeOnClickOutside: false
              });
              this.staf.civil_num.reset();

            } else {
              this.staffreferencepk = z.staffinforepo_pk;
              this.staf.staffeng.setValue(z.sir_name_en);
              this.staf.staffarab.setValue(z.sir_name_ar);
              this.staf.email_id.setValue(z.sir_emailid);
              this.staf.date_birth.setValue(z.sir_dob);
              this.staf.gend_er.setValue(z.sir_gender);
              this.staf.national.setValue(z.sir_nationality);
              this.staf.house.setValue(z.sir_addrline1);
              this.staf.houseadd.setValue(z.sir_addrline2);
              this.staf.state.setValue(z.sir_opalstatemst_fk);
              this.appservice.getcitymst(z.sir_opalstatemst_fk).subscribe(res => {
                if (res.status == 200) {

                  this.citymst = res.data.citymst;
                  this.staf.city.setValue(z.sir_opalcitymst_fk);
                }
              });
              this.edu.staffrepopk.setValue(z.staffinforepo_pk);
              this.work.staffrepopk.setValue(z.staffinforepo_pk);

              this.staf.role.setValue(z.appsim_mainrolearr);
              this.staf.job_title.setValue(z.appsim_jobtitle);
              this.staf.cont_type.setValue(z.appsim_contracttype);

              this.getstaffedu(this.page, 0, null, z.staffinforepo_pk)
              this.getstaffwork(this.page, 0, null, z.staffinforepo_pk)
              this.staffotherdetails = true;
              this.saveandproceed = false;
              this.drvInputedmoheri.selectedFilesPk = [z.sir_moheridoc];
              this.courseselectForm.controls['moheri_upload'].setValue(z.sir_moheridoc);
            }
          }

        });


        // this.appservice.getstaffinfo(z.staffinforepo_pk).subscribe(res => {
        //   if(res.status == 200){
        //   this.education = new MatTableDataSource<educationData>(res.data.education);
        //   this.workExperience =  new MatTableDataSource<workexperienceData>(res.data.workexp);
        //     } 
        // });
      }
    });

  }
  checkcivilnum(civilnum, formctrlname) {

    this.appservice.checkcivilnum(civilnum, this.appinstinfomain_pk, this.referencepk).subscribe(res => {
      if (res.data.alreadymapped == 'alreadyadded') {
        swal({
          title: this.i18n('institute.first'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.staffForm.reset();
      this.staffForm.controls['count_ry'].setValue('31');
       this.ageShow = true;
      }
      if (res.data.alreadymapped == 'list') {
        swal({
          title: this.i18n('institute.fourth'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.staffForm.reset();
      this.staffForm.controls['count_ry'].setValue('31');
      this.ageShow = true;

      }
      if (res.data.alreadymapped == 'samebranch') {
        swal({
          title: this.i18n('institute.second'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.staffForm.reset();
      this.staffForm.controls['count_ry'].setValue('31');
      this.ageShow = true;

      }
      if (res.data.alreadymapped == 'diffbranch') {
        swal({
          title: this.i18n('institute.third'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.staffForm.reset();
      this.staffForm.controls['count_ry'].setValue('31');
      this.ageShow = true;

      }
      if (res.data.dataavailable == 'yes') {
        this.stateselect(res.data.isstaffavi.sir_opalstatemst_fk);
        this.staffForm.patchValue({

          civil_num: res.data.isstaffavi.sir_idnumber,
          staffeng: res.data.isstaffavi.sir_name_en,
          staffarab: res.data.isstaffavi.sir_name_ar,
          email_id: res.data.isstaffavi.sir_emailid,
          date_birth: res.data.isstaffavi.sir_dob,
          gend_er: res.data.isstaffavi.sir_gender,
          national: res.data.isstaffavi.sir_nationality,


          house: res.data.isstaffavi.sir_addrline1,
          houseadd: res.data.isstaffavi.sir_addrline2,
          state: res.data.isstaffavi.sir_opalstatemst_fk,
          city: res.data.isstaffavi.sir_opalcitymst_fk,

          // role:res.data.isstaffavi.appsit_mainrole.split(','),
          job_title: res.data.isstaffavi.appsit_jobtitle,
          cont_type: res.data.isstaffavi.appsit_contracttype,



        });
        this.edu.staffrepopk.setValue(res.data.isstaffavi.staffinforepo_pk);
        this.work.staffrepopk.setValue(res.data.isstaffavi.staffinforepo_pk);
        this.staffreferencepk = res.data.isstaffavi.staffinforepo_pk;
        this.getstaffwork(this.page, 0, null, this.staffreferencepk)
        this.getstaffedu(this.page, 0, null, this.staffreferencepk);

        this.saveandproceed = false;
        this.staffotherdetails = true;


      }

    });
  }
  sample(index, sam) {


    this.appservice.getcitymst(sam.value).subscribe(res => {
      if (res.status == 200) {
        this.citylist[index] = res.data.citymst;

      }
    });
  }
  sample1(index, sam) {


    this.appservice.getcitymst(sam).subscribe(res => {
      if (res.status == 200) {
        this.citylist[index] = res.data.citymst;

      }
    });
  }
  getcountrymst() {
    this.appservice.getcountrymst().subscribe(res => {
      if (res.status == 200) {
        this.countrymst = res.data.country;
      }
    });
  }

  getintnatrecogmst() {

    this.appservice.getintnatrecogmst(this.standardorcustomized).subscribe(res => {
      this.interreg = res.data.recogmst;
      this.countrylist = res.data.countrymst;
      this.rolemst = res.data.rolemst;
      this.rolemst_course = res.data.rolemst;
      this.contacttypemst = res.data.contacttypemst;
      this.statemst = res.data.statemst;
      this.educationlvl = res.data.educationlvl;
      this.languages = res.data.languages;
      this.dayschedule = res.data.dayscheule;

      // this.pageScrolltop();
      this.scrollTo('pagescroll');
    });
  }

  savestaff() {
  
    if (this.staffForm.valid) {
      var breadCrumb ={
        title: 'Standard & Customized Course Certification',
          urls: [
            { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
            { title: 'Certification Form', url: '/standardcourse/home',last:'true' },
          ]   
     };
     this.remoteService.breadcrumCookieValue(breadCrumb);
      let staffForm =this.staffForm.value;
        staffForm.date_birth  = moment(staffForm.date_birth).format('YYYY-MM-DD').toString();
      this.loaderform = true;
      this.appservice.savestaff(staffForm).subscribe(res => {
        this.loaderform = false;
        this.saveproceed = true;
        this.staffreferencepk = res.data.staffrepopk;
        this.edu.staffrepopk.setValue(this.staffreferencepk);
        this.work.staffrepopk.setValue(this.staffreferencepk);
        this.saveandproceed = false;
        this.staffotherdetails = true;

        // this.pageScrolltop();
        this.scrollTo('editformeducation');
      });
    }
    else {
      this.focusInvalidInput(this.staffForm)
    }


  }
  savestaffedu() {
    if (this.educationForm.valid) {
      this.loaderformeducation = true;
      let educationForm =this.educationForm.value;
          educationForm.GradeDate  = moment(educationForm.GradeDate).format('YYYY-MM-DD').toString();
      this.appservice.savestaffedu(educationForm, this.staffeduapptype).subscribe(res => {

        if (res.status == 200) {
          this.loaderformeducation = false;
          this.educationformshow = false;
          // this.pageScrolltoptabletwo();
          this.scrollTo('tableedu');

          // this.educationForm.reset();
          this.edu.staffrepopk.setValue(this.staffreferencepk);
          this.staffeduapptype = 'new';
          this.getstaffedu(this.page, 0, null, this.staffreferencepk);
          //new
          this.educationForm.controls['institute_name'].reset();
          this.educationForm.controls['degree_cert'].reset();
          // this.educationForm.controls['education_files'].reset();
          // this.educationForm.controls['year_pass'].reset();
          this.educationForm.controls['gpa_grade'].reset();
          this.educationForm.controls['GradeDate'].reset();
          this.educationForm.controls['edut_level'].reset();
          this.educationInput.selectedFilesPk = [];
          // this.educationForm.controls['inst_city'].reset();
          // this.educationForm.controls['inst_state'].reset();
          //old
          // this.educationForm.controls['institute_name'].reset();
          // this.educationForm.controls['degree_cert'].reset();
          // this.educationForm.controls['year_join'].reset();
          // this.educationForm.controls['year_pass'].reset();
          // this.educationForm.controls['gpa_grade'].reset();
          // this.educationForm.controls['institue_country'].reset();
          // this.educationForm.controls['edut_level'].reset();
          // this.educationForm.controls['inst_city'].reset();
          // this.educationForm.controls['inst_state'].reset();
        }
        setTimeout(() => {
          this.loaderform = false;
        }, 2000);

      });
    } else {
      this.focusInvalidInput(this.educationForm);
      this.uploadedufiles = true;
    }

  }

  savestaffwork() {
    console.log(this.staffworkexperienceForm)
    if (this.staffworkexperienceForm.valid) {
      this.loaderformwork = true;
      let staffworkexperienceForm =this.staffworkexperienceForm.value;
          staffworkexperienceForm.date_join  = moment(staffworkexperienceForm.date_join).format('YYYY-MM-DD').toString();
          staffworkexperienceForm.workdate  = moment(staffworkexperienceForm.workdate).format('YYYY-MM-DD').toString();

      this.appservice.savestaffwork(staffworkexperienceForm, this.staffworkapptype).subscribe(res => {

        if (res.status == 200) {
          this.loaderformwork = false;
          this.workexpformshow = false; 
          // this.pageScrolltoptable();
          this.scrollTo('workedtable');
          this.staffworkexperienceForm.reset();
          this.work.staffrepopk.setValue(this.staffreferencepk);
          this.staffworkapptype = 'new';
          this.getstaffwork(this.page, 0, null, this.staffreferencepk)
          this.staffWorkExperienceFormReset.reset();
          this.worktilldate = null;
          this.clearDate();
          this.onCheckboxChange1(true)
          this.onCheckboxChange1(false)
          this.staffworkexperienceForm.controls['workdate'].setValidators(null);
          this.staffworkexperienceForm.controls['curr_work'].setValidators(null);
          this.staffworkexperienceForm.get('workdate').updateValueAndValidity();
          this.staffworkexperienceForm.get('curr_work').updateValueAndValidity();
          this.work.staffrepopk.setValue(this.staffreferencepk);
          this.workInput.selectedFilesPk = []
        }
        // else {
        //   this.disableSubmitButton = false;
        // }
      });
    }
    else {
      this.focusInvalidInput(this.staffworkexperienceForm)
    }
  }

  getstaffinfo(value) {

    this.appservice.getstaffdetails(value).subscribe(res => {

      this.subcategory = res.data.subcategory;

    });

  }

  checkfile(files, filepk) {

    if (filepk == 5) {

      // let value = JSON.stringify(files);

      this.awar.document_upload.setValue(files[0].filePk);
      this.awar.document_upload.updateValueAndValidity();

    }

 
  }
  showhideeducationform(value) {
    this.educationformshow = value;
  }
  showhideworkexpform(value) {
    this.workexpformshow = value;
  }
  getconfigurations() {
    this.regService.getConfiguration().subscribe(res => {
      this.configurationlist = res.data;
      this.crnumverify = (this.configurationlist['CR Integration'] == 'A') ? true : false;
      this.memshpverify = (this.configurationlist['OPAL Membership Integration'] == 'A') ? true : false;

    });
  }
  onselect() {
    if (this.staffForm.controls.gend_er.value == 1) {
      this.genderselect = '1';
      this.genderShow = true;
    }
    else if (this.staffForm.controls.gend_er.value == 2) {
      this.genderselect = '2';
      this.genderShow = true;
    }
    else {
      this.genderselect = ' ';
    }
  }
  fileData() {
    this.companyLogoFilee = {
      fileName: 'Company Logo',
      fileNote: '',
      fileFormat: 'jpg, jpeg',
      fileSize: '1 MB',
      fileMaxCount: 1,
      fileData: '',
      selectedFiles: [],
    };
  }

  ChangeValue(valid: boolean) {
    this.isValided = valid;
  }
  Changevalue(valid: boolean) {
    this.valided = valid;
  }
  changevalue(valid: boolean) {
    this.validture = valid;
  }
  radioButtonGroupChange(data: MatRadioChange) {
    if (data.value == 1) {
      this.newstaff = true;
      this.staffForm.reset();
      // this.educationForm.reset(); 
      // this.staffworkexperienceForm.reset(); 
      // this.addressForm.reset();
      // this.selectslotForm.reset(); 
      this.staffForm.controls['count_ry'].setValue('31');
      this.gendershow = true;
      this.ageShow = true;
      this.saveandproceed = false;
      this.staffotherdetails = false;
      this.workExperience = [];
      this.education = [];
      this.fourthLength = 0;
      this.fifthLength = 0;
      this.batchtraningdata_data = [];
      this.selectedOption1 = true;
      this.selectedOption2 = false;
      // this.staffForm.controls.civil_num.reset()
    }
    if (data.value == 2) {
      this.workExperience = [];
      this.education = [];
      this.fourthLength = 0;
      this.fifthLength = 0;
      this.batchtraningdata_data = [];
      this.newstaff = false;
      // this.staffForm.controls.civil_num.reset()
      this.selectedOption1 = false;
      this.selectedOption2 = true;
      // this.staffForm.reset(); 
      // this.educationForm.reset(); 
      // this.staffworkexperienceForm.reset(); 
      // this.addressForm.reset();
      // this.selectslotForm.reset(); 
      this.saveandproceed = true;
      this.staffotherdetails = false;

      this.gendershow = true;
      this.staffForm.reset();
      this.courseselectForm.reset();
      this.courseselectForm.controls['moheri_upload'].setValue(null);
      this.drvInputedmoheri.selectedFilesPk = [];
      // this.educationForm.reset();
      this.staffForm.controls['count_ry'].setValue('31');
      this.ageShow = true;

      //remove data in grid list


    }
  }
  Standardcourese() {
    this.instituteform = this.formBuilder.group({
      offtype: ['', Validators.required],
      exp_a: ['', Validators.required],
      oma_n: ['', Validators.required],
      tot_oman: [''],
      oman_percen: [''],
      site_search: [''],
      site_main: [''],
      molpercent: ['', Validators.required],
      no_techstaff: ['', Validators.required],
      curr_learn: ['', Validators.required],
      ratio_tech: ['', Validators.required],
      trainprovmax: ['', Validators.required],

    }),

      this.CourseForm = this.formBuilder.group({
        office_type: ['', Validators.required],
        bran_ch: ['', Validators.required],
        course_titleen: ['', Validators.required],
        // course_titlear: ['', Validators.required],
        // course_durat: ['', Validators.required],
        cour_cate: [''],
        cour_subcate: ['', Validators.required],
        cour_level: [''],
        request_for: ['', Validators.required],
        // unit_titl: ['', Validators.required],
        // unit_code: ['', Validators.required],
        course_delivered: ['', null],
        course_delivered_new: ['', null],
        referencepk: [null, null],
        standorcustom: [null, null],
        institute: [null, null],
        appcoursedtlstmp_pk: [null, null]
      }),
      this.documentForm = this.formBuilder.group({
        // remark_fst: ['', Validators.required],
        // remark_snd: ['', Validators.required],
        // remark_thrd: ['', Validators.required],
        // remark_ffth: ['', Validators.required],
        files: ["", null],
        // remark_fst: ['', Validators.required],
        'total_mst': [null, null]
      }),
      this.staffForm = this.formBuilder.group({
        civil_num: ['', Validators.required],
        staffeng: ['', Validators.required],
        staffarab: ['', Validators.required],
        email_id: ['', [Validators.required, Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]],
        age: [''],
        date_birth: ['', Validators.required],
        gend_er: [''],
        gender_address: [''],
        national: ['', Validators.required],
        role: ['', Validators.required],
        job_title: ['', Validators.required],
        cont_type: ['', Validators.required],
        house: [''],
        houseadd: [''],
        count_ry: [''],
        state: ['', Validators.required],
        city: ['', Validators.required],
      }),
      this.educationForm = this.formBuilder.group({
        institute_name: ['', Validators.required],
        degree_cert: ['', Validators.required],
        // year_join: ['', Validators.required],
        // year_pass: ['', Validators.required],
        gpa_grade: ['', Validators.required],
        GradeDate: ['', Validators.required],
        // instute_locate:  ['', Validators.required],
        // institue_country: ['', Validators.required],
        edut_level: ['', Validators.required],
        education_files: ['', Validators.required],
        // inst_state: ['', Validators.required],

        staffrepopk: [null, null],
        staffacademics_pk: [null, null]
      }),
      // this.educationForm = this.formBuilder.group({
      //   institute_name: ['', Validators.required],
      //   degree_cert: ['', Validators.required],
      //   year_join: ['', Validators.required],
      //   year_pass: ['', Validators.required],
      //   gpa_grade: ['', Validators.required],

      //   // instute_locate:  ['', Validators.required],
      //   institue_country: ['', Validators.required],
      //   edut_level: ['', Validators.required],
      //   inst_city: ['', Validators.required],
      //   inst_state: ['', Validators.required],

      //   staffrepopk: [null, null],
      //   staffacademics_pk: [null, null]
      // }),
      this.staffworkexperienceForm = this.formBuilder.group({
        oragn_name: ['', Validators.required],
        workdate: [''],
        designat: ['', Validators.required],
        date_join: ['',null],
        // selectcourses: ['', Validators.required],
        curr_work: [''],
        // employ_locate:  ['', Validators.required],
        employ_country: ['', Validators.required],
        employ_state: ['',null],
        employ_city: ['', null],
        work_files: ['', null],
        staffrepopk: [null, null],
        staffworkexp_pk: [null, null]
      }),
      // this.staffworkexperienceForm = this.formBuilder.group({
      //   oragn_name: ['', Validators.required],
      //   workdate: [''],
      //   designat: ['', Validators.required],
      //   date_join: ['', Validators.required],
      //   // selectcourses: ['', Validators.required],
      //   curr_work: [''],
      //   // employ_locate:  ['', Validators.required],
      //   employ_country: ['', Validators.required],
      //   employ_state: ['', Validators.required],
      //   employ_city: ['', Validators.required],
      //   staffrepopk: [null, null],
      //   staffworkexp_pk: [null, null]
      // }),
      this.courseselectForm = this.formBuilder.group({
        moheri_upload: ['', Validators.required],
        rolefor_cour: ['', Validators.required],
        select_coursubcate: ['', Validators.required],
        selectlanguage: ['', Validators.required],

      })
    this.addressForm = this.formBuilder.group({
      Address: this.formBuilder.array([this.createCountry()])
      // governate: ['', Validators.required],
      // wilayat: ['', Validators.required],

    }),
      this.awaredForm = this.formBuilder.group({
        award_organ: ['', Validators.required],
        last_audit: ['', Validators.required],
        document_upload: ['', Validators.required],
        referencepk: [null, null],
        appintrecogtmp_pk: [null, null]

      }),
      this.selectslotForm = this.formBuilder.group({
        daterange: ['', Validators.required],
        availablestatus: [''],
        starttime: ['', Validators.required],
        enDtime: ['', Validators.required],
        days: [0],
        sstartdata: [''],
        senddata: [''],

      })
  }
  get inst() { return this.instituteform.controls; }
  get awar() { return this.awaredForm.controls; }
  get cour() { return this.CourseForm.controls; }
  get mark() { return this.documentForm.controls; }
  get staf() { return this.staffForm.controls; }
  get edu() { return this.educationForm.controls; }
  get work() { return this.staffworkexperienceForm.controls; }
  get course() { return this.courseselectForm.controls; }
  get add() { return this.addressForm.controls; }
  get range() { return this.selectslotForm.controls; }
  //filterformcontral name
  Awarding = new FormControl('');
  appl_form = new FormControl('');
  officetype = new FormControl('');
  bran_name = new FormControl('');
  coures_type = new FormControl('');
  course_titles = new FormControl('');
  course_cat = new FormControl('');
  requested = new FormControl('');
  courdeliver = new FormControl('');
  appl_status = new FormControl('');
  cert = new FormControl('');
  date_expiry = new FormControl('');
  addedon_branch = new FormControl('');
  lastUpdated_branch = new FormControl('');
  Statusone = new FormControl('');
  LastAudited = new FormControl('');
  LastUpdated = new FormControl('');
  Status = new FormControl('');
  // private arrayformcontols: FormControl[] = [
  //   this.appl_form,
  //   this.officetype,
  //   this.bran_name,
  //   this.coures_type,
  //   this.course_titles,
  //   this.course_cat,
  //   this.requested,
  //   this.courdeliver,
  //   this.date_expiry,
  //   this.appl_status,
  //   this.cert,
  //   this.addedon_branch,
  //   this.lastUpdated_branch
  // ];
  course_title = new FormControl('');
  course_dura = new FormControl('');
  course_level = new FormControl('');
  course_cate = new FormControl('');
  course_test = new FormControl('');
  StatusCour = new FormControl('');
  adddoncour = new FormControl('');
  LastUpdatedcour = new FormControl('');

  civil_numb = new FormControl('');
  staff_name = new FormControl('');
  age = new FormControl('');
  role_course = new FormControl('');
  cours_sub_cate = new FormControl('');
  compcard = new FormControl('');

  institute = new FormControl('');
  degree = new FormControl('');
  year_join = new FormControl('');
  year_pass = new FormControl('');
  yearpass = new FormControl('');
  grade = new FormControl('');
  add_On = new FormControl('');
  Last_Date = new FormControl('');
  Addedon = new FormControl('');

  oranisation = new FormControl('');
  date_joined = new FormControl('');
  work_till = new FormControl('');
  count = new FormControl('');
  gover = new FormControl('');
  wilaya = new FormControl('');
  designation = new FormControl('');
  add_edOn = new FormControl('');
  date_last = new FormControl('');

  range_date = new FormControl('');
  // focusInvalidKeys(keys, form, panel = null) {
  //   if (form == 'form') {
  //     for (const key of keys) {
  //       if (this.comanydetialsform.controls[key].invalid) {
  //         this.comanydetialsform.controls[key].setErrors({ required: true });
  //         this.comanydetialsform.controls[key].markAsTouched();
  //         const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
  //         if (invalidControl) {
  //           invalidControl.focus();
  //         }
  //         return false;
  //       }
  //     }
  //     return true;
  //   }
  // }

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


  getMoherigradinglist() {
    this.regService.getMoherigradinglist().subscribe(data => {
      this.moherigradinglist = data.data;

    });
  }
  getGoverenoratelist() {
    this.profileService.getstatebyid(1).subscribe(data => {
      this.governoratelist = data.data;


    });
  }


  getwilayatbyid(country, state) {
    this.profileService.getcity(country, state).subscribe(data => this.wilayatlist = data.data);
  }
  syncPrimaryunitcde(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.appservice.getunit(this.unitpk, this.paginator.pageSize, this.paginator.pageIndex).subscribe(res => {

      this.unit = res.data.unit;
      this.unitlength = res.data.total;

    });
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;

    this.getfirstgrid(this.paginator.pageSize, this.paginator.pageIndex, null)
  }
  secondaryPaginator(event: PageEvent) {
    this.paginator1.pageIndex = event.pageIndex;
    this.paginator1.pageSize = event.pageSize;
    this.page1 = event.pageSize;
    this.getinternatinallist(this.paginator1.pageSize, this.paginator1.pageIndex, null)
  }
  thirdPaginator(event: PageEvent) {
    this.paginator2.pageIndex = event.pageIndex;
    this.paginator2.pageSize = event.pageSize;
    this.page2 = event.pageSize;
    this.getstaffgridlist(this.paginator2.pageSize, this.paginator2.pageIndex, null)
  }
  fourthPaginator(event: PageEvent) {
    console.log(event)
    this.paginator3.pageIndex = event.pageIndex; 
    this.paginator3.pageSize = event.pageSize;
    this.page3 = event.pageSize;
    this.getstaffedu(this.paginator3.pageSize, this.paginator3.pageIndex, null, this.staffreferencepk)

  }
  fifthPaginator(event: PageEvent) {
    this.paginator4.pageIndex = event.pageIndex;
    this.paginator4.pageSize = event.pageSize;
    this.page4 = event.pageSize;
    this.getstaffwork(this.paginator4.pageSize, this.paginator4.pageIndex, null, this.staffreferencepk)
  }
  sixthPaginator(event: PageEvent) {
    this.paginator5.pageIndex = event.pageIndex;
    this.paginator5.pageSize = event.pageSize;
    this.page5 = event.pageSize;

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
  hideEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('searchfilters') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('table.hide');;
      const id = document.getElementById('searchfilters') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  getAge(value) {

    let m = moment();
    let years = m.diff(value, 'years');
    m.add(-years, 'years');
    let months = m.diff(value, 'months');
    m.add(-months, 'months');
    let days = m.diff(value, 'days');


    this.staffForm.controls.age.setValue(years)
    if (years >= 5) {
      this.ageinput = true;
    }

  }

  offictypechange(value) {
    if (value == 1) {
      this.CourseForm.controls['bran_ch'].disable();
      this.showbranch = false;
      this.CourseForm.controls['bran_ch'].reset();
      let encregpk = this.security.encrypt(this.regpk);
      this.disableSubmitButton = true;
      this.appservice.getBranchlistbyregpk(this.regpk, value).subscribe(response => {
        this.disableSubmitButton = false;
        this.cour.institute.setValue(response.data.data[0].appinstinfomain_pk)
        this.getstaffsinfo(response.data.data[0].appinstinfomain_pk);
        this.appinstinfomain_pk = response.data.data[0].appinstinfomain_pk;
        if(response.data.data[0].appdm_issuspended == 1){
          swal({
            title: this.i18n('A Course cannot be created for this Centre as the Centre Certification has been Suspended.'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.CourseForm.controls['office_type'].reset();
        }
        if (this.standorcustom == 'standard') {
          this.getcoursedata();
        } else if(this.standorcustom == 'custom') {
          this.getcustomcourse();
        }

      })

    } else {
      this.showbranch = true;
      let encregpk = this.security.encrypt(this.regpk);
      this.appservice.getBranchlistbyregpk(this.regpk, value).subscribe(response => {
        if (response.data.status == 1) {
          this.cour.institute.setValue(response.data.data[0].appinstinfomain_pk)
          this.CourseForm.controls['bran_ch'].enable();
          this.branchlist = response.data.data;
          this.getstaffsinfo(response.data.data[0].appinstinfomain_pk);
          this.appinstinfomain_pk = response.data.data[0].appinstinfomain_pk;

          if (this.standorcustom == 'standard') {
            this.getcoursedata();
          } else if(this.standorcustom == 'custom') {
            this.getcustomcourse();
          }

        }
      })
    }

  }
  prev() {
    if (this.CourseForm.touched) {
      if (this.applicationtype == 'edit') {
        swal({
          title: this.i18n('maincenter.doyouwantcourse'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',

          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.standardTemplate = 'course';
            this.getfirstgrid(this.page, 0, null);
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
          }
          // this.pageScrolltop();
          this.scrollTo('pagescroll');

        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantcourseadd'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.standardTemplate = 'course';
            this.getfirstgrid(this.page, 0, null);
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
          }
          // this.pageScrolltop();
          this.scrollTo('pagescroll');

        });
      }

    }
    else {
      swal({
        title: this.i18n('uploadfile.doyouwantback'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          this.standardTemplate = 'course';
          this.getfirstgrid(this.page, 0, null);
          setTimeout(() => {
            this.disableSubmitButton = false;
          }, 2000);
        }
        // this.pageScrolltop();
        this.scrollTo('pagescroll');

      });
    }

  }
  //apply certificate


  ApplyCertificate(value) {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',last:'true' },
        ]   
   };
  this.remoteService.breadcrumCookieValue(breadCrumb);
    this.mattab = 0;
    this.disableSubmitButton = true;
    this.CourseForm.reset();
    this.awaredForm.reset();
    this.documentForm.reset();
    this.staffForm.reset();
    this.educationForm.reset();
    this.staffworkexperienceForm.reset();
    this.courseselectForm.reset();
    this.applicationtype = 'new';
    this.appdoctype = 'new';
    this.cour.office_type.enable()
    this.cour.course_titleen.enable()
    this.cour.request_for.enable()
    this.cour.course_delivered.enable()
    this.cour.bran_ch.enable()
    this.cour.cour_level.disable()
    this.cour.cour_cate.disable()
    this.cour.cour_subcate.enable()
    this.first_form_disbale = false;
    this.secondaryLength = 0;
    this.thirdLength = 0
    this.docmst = [];
    this.dataSource = [];
    this.StaffList = [];
    this.unit = [];
    this.resubmit_status = 1;
    this.onchangecount();
    if (value == 2) {
      // this.getcoursedata();
      this.standorcustom = 'standard';
      // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course',
      // document.getElementById( 'breadactive' ).style.display = 'block';
    } else {
      // this.getcustomcourse();
      this.standorcustom = 'custom';
      // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course',
      // document.getElementById( 'breadactive' ).style.display = 'block';
    }
    this.standardTemplate = 'standardFroms'; // inside application
    this.appservice.applycertificate(value).subscribe(res => {
      if (res.status == 200) {
        this.referencepk = res.data.applicationrefpk;
        this.cour.referencepk.setValue(this.referencepk);
        this.cour.standorcustom.setValue(this.standorcustom);
        this.awar.referencepk.setValue(this.referencepk);

        this.awaredForm.controls['referencepk'].setValue(this.referencepk);
      }
    });
    this.standardorcustomized = value;
    this.getintnatrecogmst();

    this.getinternatinallist(this.page, 0, null);
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }

  getstaffsubcategory() {
    this.appservice.getstaffsubcategory(this.appcoursedtlstmppk).subscribe(res => {
      this.staffsubcat = res.data.staffsubcat;

    });
  }

  getinternatinallist(limit, page, searchkey) {
    this.tblplaceholder = true;
    this.appservice.getinternational(limit, page, searchkey, this.referencepk).subscribe(res => {
     

      if (res.status == 200) {
        this.applyinternatdata = res['data'];
        this.secondaryLength = res['data']['totalcount'];
        this.dataSource = new MatTableDataSource<Element>(this.applyinternatdata['applydata']);
        this.interdata = this.applyinternatdata['applydata'];
        this.dataSource.sort = this.sort;
        this.checkalltabsarefilled();
        this.tblplaceholder = false;
      }
      
    });
    setTimeout(() => {
    this.tblplaceholder = false;
    }, 2000);

  }
  getstaffgridlist(limit, page, searchkey) {
    this.tblplaceholder = true;
    this.appservice.getstaffgridlist(limit, page, searchkey, this.referencepk).subscribe(res => {
      this.tblplaceholder = false;

      if (res.status == 200) {
        this.thirdLength = res['data']['totalcount'];
        this.StaffList = new MatTableDataSource<staffData>(res['data']['staffgrid']);
        this.StaffList.sort = this.sortstaffgrid;
        this.checkstaffconfiguration();

      }
    });
  }
  //institute detials
  addinstite() {
    this.mattab = 1;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');
  }

  addEvent(field, event) {
    this.awaredForm.controls[field].setValue(moment(event.value).format('YYYY-MM-DD').toString());
  }
  //international
  addData() {


    if (this.awaredForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveinternational(this.awaredForm.value, this.interapptype, this.applicationtype).subscribe(res => {
        var breadCrumb ={
          title: 'Standard & Customized Course Certification',
            urls: [
              { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
              { title: 'Certification Form', url: '/standardcourse/home',last:'true' },
            ]   
       };
      this.remoteService.breadcrumCookieValue(breadCrumb);
        if (res.status == 200) {
          this.checkalltabsarefilled();
          this.disableSubmitButton = false;
          // this.awaredForm.reset();
          if (this.interapptype == 'edit') {
            this.toastr.success(this.i18n('maincenter.interecoupdat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('maincenter.interecoadde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          this.getinternatinallist(this.page, 0, null);

        }


      });
      this.awaredForm.controls.award_organ.reset();
      this.awaredForm.controls.last_audit.reset();
      this.awaredForm.controls.document_upload.reset();
      this.ShowHide = true;
      this.international = false;
      this.mattab = 1;

      // this.pageScrolltop();
      this.scrollTo('pagescroll');
    } else {
      this.fileerror = false;
      this.focusInvalidInput(this.awaredForm);
    }

    this.cour.referencepk.setValue(this.referencepk);
    this.awar.referencepk.setValue(this.referencepk);

  }
  awardorganchoose(awardvalue) {
    this.drvInputed.selectedFilesPk = [];
    this.Intrecog.triggerChange();
    this.awaredForm.controls.last_audit.reset();
    this.awaredForm.controls.document_upload.reset();
    
    this.appservice.getinterawardorgandata(awardvalue).subscribe(res => {
      if (res.status == 200) {
        console.log(typeof(res.data.data.appintim_Doc))
        var dovc = res.data.data?.appintim_Doc;
        if (res.data.status == 'yes') {
          
          this.drvInputed.selectedFilesPk = [dovc];
          console.log( this.drvInputed.selectedFilesPk)
          setTimeout(() => {
            this.Intrecog.triggerChange();
            this.awaredForm.patchValue({

              last_audit: res.data.data?.appintim_LastAuditDate,
              document_upload: res.data.data?.appintim_Doc
            });                     
          }, 1000);
          
        }
      }

    });
  }
  awardcancel() {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',last:'true' },
        ]   
   };
  this.remoteService.breadcrumCookieValue(breadCrumb);
    if (this.awaredForm.touched) {
      if (this.awaredForm.get('appintrecogtmp_pk').value) {
        swal({
          title: this.i18n('maincenter.doyouwantupdate'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.disableSubmitButton = true;
            this.ShowHide = true;
            this.international = false;
            this.mattab = 1;

            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
            // this.pageScrolltop();
            this.scrollTo('pagescroll');
          }
        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantadd'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.ShowHide = true;
            this.international = false;
            this.mattab = 1;

            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
            // this.pageScrolltop();
            this.scrollTo('pagescroll');
          }
        });
      }

    }
    else {
      this.disableSubmitButton = true;

      this.ShowHide = true;
      this.international = false;
      this.mattab = 1;

      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
      // this.pageScrolltop();
      this.scrollTo('pagescroll');
    }


  }
  sHowhide() {
    // this.awaredForm.reset()
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',page:2 },
          { title: 'International Recognition and Accreditation', url: '/standardcourse/home',last:'true' },
        ]   
   };
   this.remoteService.breadcrumCookieValue(breadCrumb);

    this.drvInputed.selectedFilesPk = [];
    this.ShowHide = false;
    this.international = true;
    this.add_btn = true;
    this.interapptype = 'new';
    this.awaredForm.enable();
    this.awaredForm.controls['award_organ'].reset()
    this.awaredForm.controls['document_upload'].reset()
    this.awaredForm.controls['last_audit'].reset()
    // this.pageScrolltop();
    this.scrollTo('pagescroll');
  }
  interedit(value, oprtype) {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',page:2 },
          { title: 'International Recognition and Accreditation', url: '/standardcourse/home',last:'true' },
        ]   
   };
   this.remoteService.breadcrumCookieValue(breadCrumb);
    this.disableSubmitButton = true;
    this.interapptype = oprtype;
    this.deleteicon = true;
console.log(typeof(value.appintit_doc))
    this.scrollTo('pagescroll');
    if (oprtype == 'view') {

      this.deleteicon = false;
      this.hiddenbtn = false;
      this.awaredForm.disable();
    }
    if (oprtype == 'edit') {
      this.awaredForm.enable();
    }
    this.intercomment = value.appintit_appdeccomment;
    this.interaddedon = value.appintit_appdecon;
    this.interaddedby = value.oum_firstname;
    this.interstatus = value.status;
    this.ShowHide = false;
    this.international = true;
    this.add_btn = false;
    this.drvInputed.selectedFilesPk = [value.appintit_doc];
    console.log(this.drvInputed.selectedFilesPk)
    // let date =formatDate(value.last_aud,'yyyy-MM-dd','en-US');
    this.awaredForm.patchValue({
      award_organ: value.appintit_intnatrecogmst_fk,
      last_audit: value.last_aud1,
      appintrecogtmp_pk: value.appintrecogtmp_pk,
      document_upload: value.appintit_doc
    });

    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);

    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }
  interdelete(value, oprtype) {

    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.interdelete(value).subscribe(res => {
          if (res.status == 200) {

            this.getinternatinallist(this.page, 0, null);
            this.toastr.success(this.i18n('maincenter.interreco'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            // this.pageScrolltop();
            this.scrollTo('pagescroll');
          }
        });
      }
    });

  }
  editapplicationdata(applicationpk, projectfk, applicationtype,applicationstatus,appdt_apptype) {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',last:'true' },
        ]   
   };
  this.remoteService.breadcrumCookieValue(breadCrumb);

    this.applicationstatus = applicationstatus;
    this.applicationtype = applicationtype;
    this.appdt_apptype = appdt_apptype;
    this.standardorcustomized = projectfk;
    this.mattab = 0
    this.disableSubmitButton = true;
    this.requiredfieldshow = true;
    if(applicationstatus == 3) {
       this.resubmit_status = 2;
    }else{
      this.resubmit_status = 1;
    }
    if (this.applicationtype == 'view') {
      this.coursesavebtn = true;
      this.docsavebtn = true;
      this.cour.office_type.disable()
      this.cour.course_titleen.disable()
      // this.cour.request_for.disable()
      this.first_form_disbale = true;
      this.cour.course_delivered.disable()
      this.cour.bran_ch.disable()
      this.cour.cour_level.disable()
      this.cour.cour_cate.disable()
      this.cour.cour_subcate.disable()
      this.deleteicon = false;
       this.requiredfieldshow = false;
    }
    if (this.applicationtype == 'update' || this.applicationtype == 'edit' || this.applicationtype == 'renew') {
      this.cour.office_type.disable()
      this.cour.course_titleen.disable()
      // this.cour.request_for.disable()
      this.first_form_disbale = true;
      this.cour.course_delivered.disable()
      this.cour.bran_ch.disable()
      this.cour.cour_level.disable()
      this.cour.cour_cate.disable()
      if (this.applicationtype == 'edit' || this.applicationtype == 'renew') {
        this.cour.request_for.enable()
      }
      if((applicationstatus == 17 && this.applicationtype == 'update') || (this.applicationtype == 'update' && appdt_apptype == 3)){
    
        // this.cour.cour_subcate.disable()
        this.nodocumentopload = true;
        this.deleteicon =false;
      }else{ 
      //   this.cour.cour_subcate.enable()
        this.nodocumentopload = false;
        this.deleteicon =true;
      }
     
      this.coursesavebtn = false;
      // this.deleteicon = true;

    }
    if (projectfk == 2) {
      this.getcoursedata();
    } else if(projectfk == 3) {
      this.getcustomcourse();
    }
    // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course';
    // document.getElementById( 'breadactive' ).style.display = 'block';
    this.apptype = 'edit';
    this.appdoctype = 'edit';
    this.cour.cour_cate.enable();
    this.cour.cour_level.enable();
    this.appservice.getalldata(applicationpk, projectfk).subscribe(res => {
      this.referencepk = applicationpk;
      this.getsubcategoryarray();
      this.coursecommandsts = res.data.course[0].appcdt_status;
      this.coursecommand = res.data.course[0].appcdt_appdeccomment;
      this.courseappon = res.data.course[0].appcdtappdecon;
      this.courseappby = res.data.course[0].oum_firstname;
      this.maincomment = res.data.course[0].appdt_appdeccomment;
      this.mainapprovdecon = res.data.course[0].appdtappdecon;
      this.getinternatinallist(this.page, 0, null);
      this.getstaffgridlist(this.page, 0, null);
      this.getintnatrecogmst();
      this.awaredForm.controls['referencepk'].setValue(applicationpk);
      if (res.status == 200) {
        this.standardTemplate = 'standardFroms'; // inside application

        if (projectfk == 2) { //standard
          var coursefk = res.data.course[0].appcdt_standardcoursemst_fk
        
          if(res.data.course[0].scm_assessmentin == 16){
           
            this.samecentrecourse = true;
           }
          if(res.data.course[0].scm_isintlreorgreq == 1){
          
          this.intertabmanditoryornot = true;
          }
          else {
          this.intertabmanditoryornot = false;
          }
         
          this.appservice.getseccategory(res.data.course[0].appcdt_standardcoursemst_fk, projectfk).subscribe(res => {

            this.subcategory = res.data.subcategory;
           
          });
          
        } else {//customized
          var coursefk = res.data.course[0].appcdt_appoffercoursemain_fk
          this.appservice.getseccategory(res.data.course[0].appocm_coursesubcategorymst_fk, projectfk).subscribe(res => {
            this.standorcustom = 'custom';
            this.subcategory = res.data.subcategory;

          });
          this.unitpk = res.data.course[0].appoffercoursemain_pk;
          this.appservice.getunit(res.data.course[0].appoffercoursemain_pk, 10, 0).subscribe(res => {

            this.unit = res.data.unit;
            this.unitlength = res.data.total;
          });


        }
        var reqfor = res.data.course[0].appcdt_requestfor;
        this.appservice.getdocumentdata(this.referencepk, this.standardorcustomized, coursefk, reqfor).subscribe(res => {

          this.docmst = res.data.docmst;

          this.mark.total_mst.setValue(res.data.total);
          if(res.data.datapresented == 'yes'){
            this.documenttabfilled =true;
          }else{
            this.documenttabfilled =false;
          }
        });
        this.getroleforcourse(this.referencepk, this.standardorcustomized, coursefk, reqfor);
        if (res.data.course[0].appiim_officetype == 1) {
          this.CourseForm.controls['bran_ch'].disable();
        } else {
          this.offictypechange(2);
          if (this.applicationtype == 'update') {
            this.cour.bran_ch.disable() 
          }
        }
        this.getstaffsinfo(res.data.course[0].appcdt_appinstinfomain_fk)
        this.appinstinfomain_pk = res.data.course[0].appcdt_appinstinfomain_fk;
        setTimeout(() => {
          this.CourseForm.patchValue({
            'referencepk': applicationpk,
            'office_type': Number(res.data.course[0].appiim_officetype),
            'course_titleen': coursefk,
            'cour_level': this.dir == 'ltr' ? res.data.course[0].rm_name_en : res.data.course[0].rm_name_ar,
            'cour_cate': this.dir == 'ltr' ? res.data.course[0].ccm_catname_en : res.data.course[0].ccm_catname_ar,
            'request_for': res.data.course[0].appcdt_requestfor,
            'cour_subcate': res.data.category,
            'course_delivered': res.data.course[0].appcdt_deliverto,
            'appcoursedtlstmp_pk': res.data.course[0].appcoursedtlstmp_pk,
            'bran_ch': res.data.course[0].appcdt_appinstinfomain_fk,
          });
          this.disableSubmitButton = false;
          if (this.applicationtype == 'update' || this.applicationtype == 'renew') {
            this.alltabsarefilled =false;
          }else{
            this.tab3filled = true;
            this.checkalltabsarefilled();
          }
        }, 4000);


        this.appcoursedtlstmppk = res.data.course[0].appcoursedtlstmp_pk;

        this.getstaffsubcategory();

      }

    });
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }
  applyFilter(serch, key) {

    var search = {
      serchkey: serch,
      name: key
    };

    this.getfirstgrid(this.page, 0, search);

  }
  applyFilterforinter(serch, key) {

    var search = {
      serchkey: serch,
      name: key
    };

    this.getinternatinallist(this.page, 0, search);
  }

  applyFilterforstaff(serch, key) {

    var search = {
      serchkey: serch,
      name: key
    };


    this.getstaffgridlist(this.page, 0, search);
  }
  seracheducation(serch, key) {

    var search = {
      serchkey: serch,
      name: key
    };


    this.getstaffedu(this.page, 0, search, this.staffreferencepk)
  }
  serachwork(serch, key) {

    var search = {
      serchkey: serch,
      name: key
    };

    this.getstaffwork(this.page, 0, search, this.staffreferencepk)
  }
  changeingmdtls(){
    
  }
  splitRoleFunction(data) {
    this.rolesubcategory = data.split(',');
    this.rolecategory_remove = data.split(',');
    this.rolecategory_remove.shift();
    return this.rolesubcategory[0];
  }
  splitCourseFunction(data) {
    this.coursesubcategory = data.split(',');
    this.category_remove = data.split(',');
    this.category_remove.shift();
    return this.coursesubcategory[0];
  }
  editstaffgrid(element, oprtype) {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',page:3 },
          { title: 'Staff', url: '/standardcourse/home',last:'true' },
        ]   
   };
   this.remoteService.breadcrumCookieValue(breadCrumb);
    if(this.AddressFormArr.length > 1) {
      const formArray = this.AddressFormArr;
      formArray.clear();
      this.addReferral()
    }
    this.staffform = true;
    this.ShowHide = false;
    this.staffapptype = oprtype;
    this.staffotherdetails = true; //hide and show staff other details
    this.newstaff = false;
    this.staffcommand = element.appsit_appdeccomment;
    this.staffappon = element.appsit_appdecby;
    this.staffappby = element.oum_firstname;
    this.staffstatus = element.appsit_status;
    this.appostaffinfotmp_pk = element.appostaffinfotmp_pk;
    this.staffreferencepk = element.staffinforepo_pk;
    this.stateselect(element.sir_opalstatemst_fk);
    this.getstaffedu(this.page, 0, null, element.staffinforepo_pk)
    this.getstaffwork(this.page, 0, null, element.staffinforepo_pk)
    this.edu.staffrepopk.setValue(element.staffinforepo_pk);
    this.work.staffrepopk.setValue(element.staffinforepo_pk);
    this.saveandproceed = false;
   

    // this.staffForm.controls['staffarab'].disable()
    if(element.sir_dob != null && element.sir_dob != '0000-00-00'){
      this.staffForm.controls['date_birth'].setValue(element.sir_dob);
    }
    this.staffForm.patchValue({
      civil_num: element.sir_idnumber,
      staffeng: element.sir_name_en,
      staffarab: element.sir_name_ar,
      email_id: element.sir_emailid,
      // date_birth: element.sir_dob,
      gend_er: element.sir_gender,
      national: element.sir_nationality,
      job_title: element.appsit_jobtitle,
      cont_type: element.appsit_contracttype,
      house: element.sir_addrline1,
      houseadd: element.sir_addrline2,
      state: element.sir_opalstatemst_fk,
      city: element.sir_opalcitymst_fk,

    });
    this.drvInputedmoheri.selectedFilesPk = [element.sir_moheridoc];
    this.appservice.getstaffdata(element.appostaffinfotmp_pk).subscribe(res => {
      if (res.status == 200) {
        console.log('-------------')
        console.log(this.rolemst_course)
        console.log(res.data.stafftmp.appsit_roleforcourse1)
        const filteredArray = res.data.stafftmp.appsit_roleforcourse1.filter(item => {
          return this.rolemst_course.some(obj => obj.rolemst_pk === item);
        });
        this.courseselectForm.patchValue({
          moheri_upload: element.sir_moheridoc,
          rolefor_cour: filteredArray,
          select_coursubcate: res.data.stafftmp.appsit_appcoursetrnstmp_fk1,
          selectlanguage: res.data.stafftmp.appsit_language1,

        });
        this.coureserolecheck(res.data.stafftmp.appsit_roleforcourse1);
        this.staffForm.patchValue({
          role: res.data.stafftmp.appsit_mainrole1
        });

        res.data.staffloc.forEach((element, index) => {

          this.sample1(index, element.aslt_opalstatemst_fk);

        });

        if (res.data.staffloc.length != 0) {
          const termsFormArray = <FormArray>this.addressForm.controls.Address;
          while (termsFormArray.length !== 0) {
            termsFormArray.removeAt(0);
          }
          res.data.staffloc.forEach((data) => {
            city1 = []
            if (data.aslt_opalcitymst.length == 1) {
              city1 = data.aslt_opalcitymst;
            } else {
              var city1 = data.aslt_opalcitymst_fk.split(',');
            }
            this.AddressFormArr.push(this.formBuilder.group({
              governate: data.aslt_opalstatemst_fk.toString(),
              wilayat: [city1, '']
            }));
          });
        }
        if(res.data.staffschedule) {
          this.loadScheduleData(res.data.staffschedule);
        }
      }
    });
    if(this.staffapptype == 'view'){
      this.deleteicon = false;
      this.staffForm.controls['civil_num'].disable()
    this.staffForm.controls['staffeng'].disable()
    this.staffForm.controls['staffarab'].disable()
    this.staffForm.controls['staffeng'].disable()
    this.staffForm.controls['email_id'].disable()
    this.staffForm.controls['date_birth'].disable()
    this.staffForm.controls['age'].disable()
    this.staffForm.controls['gend_er'].disable()
    this.staffForm.controls['gender_address'].disable()
    this.staffForm.controls['role'].disable()
    this.staffForm.controls['job_title'].disable()
    this.staffForm.controls['national'].disable()
    this.staffForm.controls['cont_type'].disable()
    this.staffForm.controls['house'].disable()
    this.staffForm.controls['houseadd'].disable()
    // this.staffForm.controls['count_ry'].disable()
    this.staffForm.controls['state'].disable()
    this.staffForm.controls['city'].disable()
    this.courseselectForm.controls['moheri_upload'].disable()
    this.courseselectForm.controls['rolefor_cour'].disable()
    this.courseselectForm.controls['select_coursubcate'].disable()
    this.courseselectForm.controls['selectlanguage'].disable()
   this.vievalue = true;
    this.addressForm.disable()
    }else {
      {
        this.deleteicon = true;
        this.staffForm.controls['civil_num'].disable()
      this.staffForm.controls['staffeng'].disable()
      this.staffForm.controls['staffarab'].enable()
      this.staffForm.controls['email_id'].enable()
      this.staffForm.controls['date_birth'].enable()
      this.staffForm.controls['age'].enable()
      this.staffForm.controls['gend_er'].enable()
      this.staffForm.controls['gender_address'].enable()
      this.staffForm.controls['role'].enable()
      this.staffForm.controls['job_title'].enable()
      this.staffForm.controls['national'].enable()
      this.staffForm.controls['cont_type'].enable()
      this.staffForm.controls['house'].enable()
      this.staffForm.controls['houseadd'].enable()
      // this.staffForm.controls['count_ry'].enable()
      this.staffForm.controls['state'].enable()
      this.staffForm.controls['city'].enable()
      this.courseselectForm.controls['moheri_upload'].enable()
      if(this.applicationstatus == 17){
        // this.courseselectForm.controls['rolefor_cour'].disable()
        // this.courseselectForm.controls['select_coursubcate'].disable()
        // this.courseselectForm.controls['selectlanguage'].disable()
      }else{
        this.courseselectForm.controls['rolefor_cour'].enable()
        this.courseselectForm.controls['select_coursubcate'].enable()
        this.courseselectForm.controls['selectlanguage'].enable()
      }
      this.courseselectForm.controls['rolefor_cour'].enable()
      this.courseselectForm.controls['select_coursubcate'].enable()
      this.courseselectForm.controls['selectlanguage'].enable()
      this.addressForm.enable()
      this.vievalue = false;
      }
    }
    this.scrollTo('pagescroll');
    this.uploadfiles = false;
  }
  deletestaffgrid(appostaffinfotmp_pk) {
    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deletestaffgrid(appostaffinfotmp_pk).subscribe(res => {
          if (res.status == 200) {
            this.getstaffgridlist(this.page, 0, null)
            this.checkstaffconfiguration();
            this.toastr.success(this.i18n('maincenter.satffdele'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            // this.pageScrolltop();
            this.scrollTo('pagescroll');

          }
        });
      }
    });


  }
  deletestaffedu(staffacademics_pk) {
    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deletestaffedu(staffacademics_pk).subscribe(res => {
          if (res.status == 200) {
            this.getstaffedu(this.page, 0, null, this.staffreferencepk)
            this.toastr.success(this.i18n('maincenter.educqual'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            // this.pageScrolltop();
            this.scrollTo('pagescroll');

          }
        });
      }
    });
  }
  deletestaffwork(staffworkexp_pk) {
    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deletestaffwork(staffworkexp_pk).subscribe(res => {
          if (res.status == 200) {
            this.getstaffwork(this.page, 0, null, this.staffreferencepk);
            this.toastr.success(this.i18n('maincenter.workexpeir'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            // this.pageScrolltop();
            this.scrollTo('pagescroll');

          }
        });
      }
    });
  }
  opencertificate(url) {
    this.disableSubmitButton = true;
    window.open(environment.baseUrl + url, "_blank");
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }
  cancelstaffedu() {
    this.educationForm.controls['institute_name'].reset();
    this.educationForm.controls['degree_cert'].reset();
    this.educationForm.controls['GradeDate'].reset();
    // this.educationForm.controls['year_pass'].reset();
    this.educationForm.controls['gpa_grade'].reset();
    // this.educationForm.controls['institue_country'].reset();
    this.educationForm.controls['edut_level'].reset();
    // this.educationForm.controls['inst_city'].reset();
    // this.educationForm.controls['inst_state'].reset();
    this.staffeduapptype = 'new';
    this.educationForm.controls['education_files'].reset();
    this.educationInput.selectedFilesPk = [];
    this.educationformshow = false;
    this.scrollTo('editformeducation');
    this.uploadedufiles = false;
  }
  editstaffedu(educationData, educationtype) {
    this.staffeduapptype = educationtype;
    // this.pageScrolltoformtwo();
    this.educationformshow = true;
    this.educationformshow = true;
    this.staffreferencepk = educationData.sacd_staffinforepo_fk;
    this.ctrychoose(educationData.sacd_opalcountrymst_fk);
    this.stateselect(educationData.sacd_opalstatemst_fk);
    if(educationData.yearpass) {
      this.educationForm.controls['GradeDate'].setValue(educationData.sacd_enddate)
    }
    this.educationForm.patchValue({
      year_join: educationData.sacd_startdate,
      year_pass: educationData.sacd_enddate,
      institute_name: educationData.institute,
      institue_country: educationData.sacd_opalcountrymst_fk,
      inst_state: educationData.sacd_opalstatemst_fk,
      inst_city: educationData.sacd_opalcitymst_fk,
      edut_level: educationData.sacd_edulevel,
      // GradeDate:new Date(educationData.yearpass).toISOString(),
      // GradeDate:educationData.sacd_enddate,
      degree_cert: educationData.degree,
      gpa_grade: educationData.grade,
      education_files:educationData.memcompfiledtls_pk,
      staffacademics_pk: educationData.staffacademics_pk,
      staffrepopk: educationData.sacd_staffinforepo_fk
    });
   
    this.educationInput.selectedFilesPk = [educationData.memcompfiledtls_pk];
     if(this.staffeduapptype == 'view') {
      this.educationForm.disable();
    }else {
      this.educationForm.enable();
    }
    this.scrollTo('editformeducation');

  }
  editstaffwork(workexperienceData, worktype) {
    this.staffworkapptype = worktype;
    this.workexpformshow = true;
    this.workexpformshow = true;
    this.staffreferencepk = workexperienceData.sexp_staffinforepo_fk;
    this.ctrychoose(workexperienceData.sexp_opalcountrymst_fk);
    this.stateselect(workexperienceData.sexp_opalstatemst_fk);
    // this.pageScrolltoform();
    this.scrollTo('editdata')
    if (workexperienceData.sexp_currentlyworking == 1) {
      this.staffworkexperienceForm.controls['curr_work'].setValue(1);
      this.staffworkexperienceForm.controls['workdate'].reset();
      this.staffworkexperienceForm.controls['workdate'].setValidators(null);
    } else {
      this.worktilldate = workexperienceData.sexp_eod;
      // this.staffworkexperienceForm.controls['workdate'].setValue(null);
      // this.staffworkexperienceForm.controls['workdate'].setValue(workexperienceData.sexp_eod);
    }
    this.staffworkexperienceForm.patchValue({
      oragn_name: workexperienceData.organname,
      date_join: workexperienceData.sexp_doj,
      // workdate: workexperienceData.sexp_eod,
      // curr_work:workexperienceData.sexp_currentlyworking,
      employ_country: workexperienceData.sexp_opalcountrymst_fk,
      employ_state: workexperienceData.sexp_opalstatemst_fk,
      employ_city: workexperienceData.sexp_opalcitymst_fk,
      designat: workexperienceData.sexp_designation,
      work_files:workexperienceData.sexp_profdocupload,
      staffworkexp_pk: workexperienceData.staffworkexp_pk,
      staffrepopk: workexperienceData.sexp_staffinforepo_fk
    });
    this.workInput.selectedFilesPk = [workexperienceData.memcompfiledtls_pk];
    if(this.staffworkapptype == 'view') {
      this.staffworkexperienceForm.disable();
    }else {
      this.staffworkexperienceForm.enable();
    }
  }
  // editstaffedu(educationData, educationtype) {
  //   this.staffeduapptype = educationtype;
  //   // this.pageScrolltoformtwo();
  //   this.educationformshow = true;
  //   this.staffreferencepk = educationData.sacd_staffinforepo_fk;
  //   this.ctrychoose(educationData.sacd_opalcountrymst_fk);
  //   this.stateselect(educationData.sacd_opalstatemst_fk);
  //   this.educationForm.patchValue({
  //     year_join: educationData.sacd_startdate,
  //     year_pass: educationData.sacd_enddate,
  //     institute_name: educationData.institute,
  //     institue_country: educationData.sacd_opalcountrymst_fk,
  //     inst_state: educationData.sacd_opalstatemst_fk,
  //     inst_city: educationData.sacd_opalcitymst_fk,
  //     edut_level: educationData.sacd_edulevel,
  //     degree_cert: educationData.degree,
  //     gpa_grade: educationData.grade,

  //     staffacademics_pk: educationData.staffacademics_pk,
  //     staffrepopk: educationData.sacd_staffinforepo_fk
  //   });
  //   this.scrollTo('editformeducation');

  // }
  // editstaffwork(workexperienceData, worktype) {
  //   this.staffworkapptype = worktype;
  //   this.staffreferencepk = workexperienceData.sexp_staffinforepo_fk;
  //   this.ctrychoose(workexperienceData.sexp_opalcountrymst_fk);
  //   this.stateselect(workexperienceData.sexp_opalstatemst_fk);
  //   // this.pageScrolltoform();
  //   this.scrollTo('editdata')
  //   if (workexperienceData.sexp_currentlyworking == 1) {
  //     this.staffworkexperienceForm.controls['curr_work'].setValue(1);
  //     this.staffworkexperienceForm.controls['workdate'].reset();
  //     this.staffworkexperienceForm.controls['workdate'].setValidators(null);
  //   }else{
  //     this.staffworkexperienceForm.controls['workdate'].setValue(workexperienceData.sexp_eod);
  //   }
  //   this.staffworkexperienceForm.patchValue({
  //     oragn_name: workexperienceData.organname,
  //     date_join: workexperienceData.sexp_doj,
  //     // workdate: workexperienceData.sexp_eod,
  //     // curr_work:workexperienceData.sexp_currentlyworking,
  //     employ_country: workexperienceData.sexp_opalcountrymst_fk,
  //     employ_state: workexperienceData.sexp_opalstatemst_fk,
  //     employ_city: workexperienceData.sexp_opalcitymst_fk,
  //     designat: workexperienceData.sexp_designation,

  //     staffworkexp_pk: workexperienceData.staffworkexp_pk,
  //     staffrepopk: workexperienceData.sexp_staffinforepo_fk
  //   });

  // }
  previnst() {
    this.mattab = 0;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }
  nextOperate() {
    this.mattab = 2;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');
  }
  //document 
  prevoperat() {
    this.mattab = 1;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }

  //opearator contact

  showHidecourse() {
    this.courses = true;
    this.ShowHide = false;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

    // this.mattab = 5;
  }
  courseAdd() {


    if (this.CourseForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.addcourse(this.CourseForm.value, this.apptype).subscribe(res => {
        if (res.status == 200) {
          this.checkstaffconfiguration();
          this.getroleforcourse(this.referencepk, this.standardorcustomized, '', '');
          this.disableSubmitButton = false;
          this.getsubcategoryarray();
          this.checkalltabsarefilled();
          if (this.apptype == 'new') {
            this.toastr.success(this.i18n('maincenter.couradde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            if(res.data.staffmap != 'yes'){
            this.toastr.success(this.i18n('maincenter.courupdat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          } 
          this.appcoursedtlstmppk = res.data.appcoursedtlstmp_pk;
          this.CourseForm.controls['appcoursedtlstmp_pk'].setValue(res.data.appcoursedtlstmp_pk);
          this.getstaffsubcategory();
        } else {
          this.disableSubmitButton = false;
        }
        this.mattab = 1;
        // this.pageScrolltop();
        this.scrollTo('pagescroll');

        if(res.data.staffmap == 'yes'){
          swal({
            title: this.i18n('Please remove the Staff members from their respective Course Sub-Categories to exclude the Sub-Categories from the Course section.'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.mattab = 0;
          this.appservice.getalldata(this.referencepk, this.standardorcustomized).subscribe(res => {
            this.CourseForm.patchValue({
              'cour_subcate': res.data.category,
            });
              });
        }

      });

     
    }
    else {
      this.focusInvalidInput(this.CourseForm)
    }
  }
  stateselect(value) {
    this.appservice.getcitymst(value).subscribe(res => {
      if (res.status == 200) {
        this.citymst = res.data.citymst;

      }
    });

  }
  removevalidator(){
    const addressControls = this.addressForm.get('Address') as FormArray;

addressControls.controls.forEach((addressControl) => {
  const governateControl = addressControl.get('governate');
  const wilayatControl = addressControl.get('wilayat');

  governateControl.clearValidators(); // Remove validators
  wilayatControl.clearValidators(); // Remove validators

  governateControl.updateValueAndValidity(); // Update control's validity
  wilayatControl.updateValueAndValidity(); // Update control's validity
});
  }

  addvaildaors(){

    const addressControls = this.addressForm.get('Address') as FormArray;
    const validators = [Validators.required, Validators.required]; // Example validators
    
    addressControls.controls.forEach((addressControl) => {
      const governateControl = addressControl.get('governate') as FormControl;
      const wilayatControl = addressControl.get('wilayat') as FormControl;
    
      governateControl.setValidators(Validators.required); // Set validators
      wilayatControl.setValidators(Validators.required); // Set validators
    
      governateControl.updateValueAndValidity(); // Update control's validity
      wilayatControl.updateValueAndValidity(); // Update control's validity
    });
    

  }
  coureserolecheck(rolevalue) {
if(this.standardorcustomized == 2){
    if (rolevalue.includes('13') &&  this.samecentrecourse == false) {
  
      this.accessoravilabe = true;
      this.addvaildaors();
    } else {
      this.accessoravilabe = false;
    this.removevalidator();
    }
  }else{
    // if (rolevalue.includes('13')){
    //   this.accessoravilabe = true;
    //   this.addvaildaors();

    // }else{
      this.accessoravilabe = false;
      this.removevalidator();

    // }
  }
  }
  checkalltabsarefilled(){
   
    if(this.intertabmanditoryornot){
        if( this.secondaryLength != 0 && this.thirdLength != 0 && this.tab3filled){
          this.alltabsarefilled =false;
        }
    }else{
      if( this.thirdLength != 0 && this.tab3filled ){
        this.alltabsarefilled =false;
      }
    }
  }
  nextstaff() {
    this.mattab = 2;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }
  //staff

  canclstaff() {
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',last:'true' },
        ]   
   };
   this.remoteService.breadcrumCookieValue(breadCrumb);

    if (this.staffForm.touched || this.courseselectForm.touched) {
      if (this.staffapptype == 'new') {
        swal({
          title: this.i18n('maincenter.doyouwantdelestaffupdate'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.mattab = 3;
            this.staffform = false;
            this.ShowHide = true;
            // this.pageScrolltop();
            this.scrollTo('pagescroll');
            this.workexpformshow = false;
            this.educationformshow = false;
            this.staffForm.reset();
            this.educationForm.reset()
            this.staffworkexperienceForm.reset()
            this.addressForm.reset()
            this.courseselectForm.reset();
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);

          }
        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantdelestaffadd'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.mattab = 3;
            this.staffform = false;
            this.ShowHide = true;
            // this.pageScrolltop();
            this.scrollTo('pagescroll');
            this.workexpformshow = false;
            this.educationformshow = false;
            this.staffForm.reset();
            this.educationForm.reset()
            this.staffworkexperienceForm.reset()
            this.addressForm.reset()
            this.courseselectForm.reset();
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);

          }
        });
      }

    }
    else {
      this.disableSubmitButton = true;
      this.mattab = 3;
      this.staffform = false;
      this.ShowHide = true;
      // this.pageScrolltop();
      this.scrollTo('pagescroll');
      this.workexpformshow = false;
      this.educationformshow = false;
      this.staffForm.reset();
      this.educationForm.reset()
      this.staffworkexperienceForm.reset()
      this.addressForm.reset()
      this.courseselectForm.reset();
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
    }
    


  }

  getsubcategoryarray(){
    this.appservice.getsubactegoryarray(this.referencepk,this.standardorcustomized).subscribe(res => {
      this.subcatarr = res.data.subcatarr;
      this.standardcoursepk = res.data.couresepk;
    });
  }
  checkstaffconfiguration(){
    this.appservice.staffconfigurationcheck(this.referencepk,this.standardorcustomized).subscribe(res => {
      this.staffconfigstatus = res.data.status;
      this.staffconfigmsg_ar = res.data.msg_ar;
      this.staffconfigmsg_en = res.data.msg_en;
    });
  }

  checkroleforcourese(){
   this.checkstaffconfiguration();
    //12- tutor 13- assessor 14-prorammanager 15- student reg staff
    var defarr = ['12','13','14','15'];
    var arr = this.courseselectForm.controls['rolefor_cour'].value;
    var tut = 0;
    var acc = 0;
    var pro =0;
    var stud =0;

    if(arr.includes('12')){
      tut = 1;
    }
    if(arr.includes('13')){
      acc = 1;
    }
    if(arr.includes('14')){
      pro = 1;
    }
    if(arr.includes('15')){
      stud = 1;
    }
    
    var data ={
      'tut':tut,
      'acc':acc,
      'pro':pro,
      'stud':stud
    }
    return data;

  }

  staffAdd() {

   var responsevalue =  this.checkroleforcourese();
   console.log(responsevalue);
  
    console.log('staffform', this.staffForm.valid)
    console.log('courseform', this.courseselectForm.valid)
    console.log('addressform', this.addressForm.valid)
  //  if(this.courseselectForm.controls.moheri_upload.invalid) {
    this.uploadfiles = true;
  //  }else {
  //   this.uploadfiles = false;
  //  }
    // && this.addressForm.valid 
    if (this.staffForm.valid && this.courseselectForm.valid && this.addressForm.valid ) {
     
      if(this.standardcoursepk == 2 || this.standardcoursepk == 3 || this.standardorcustomized == 3 ){
        if(responsevalue.tut == 1 && responsevalue.stud == 0 && responsevalue.pro == 0 && responsevalue.acc == 0){
          swal({
            title: this.i18n('Should not allow to add staff in trainer role alone'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
  
          return false;
        }
        if(responsevalue.tut == 0 && responsevalue.stud == 0 && responsevalue.pro == 0 && responsevalue.acc == 1){
          swal({
            title: this.i18n('Should not allow to add staff in assessor role alone'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
  
          return false;
        }
  
     }
    //  if(this.staffapptype == 'edit') {
    //   // if(this.staffForm.touched || this.courseselectForm.touched || this.addressForm.touched || this.educationForm.touched || this.staffworkexperienceForm.touched) {
    //     if(this.staffForm.dirty || this.courseselectForm.dirty || this.addressForm.dirty || this.educationForm.dirty || this.staffworkexperienceForm.dirty) {
         
    //     }else {
    //       swal({
    //         title: this.i18n('Please Edit one of the fields and then click the Update button to save the changes.'),
    //         text: '',
    //         icon: 'warning',
    //         buttons: [false, this.i18n('uploadfile.ok')],
    //         dangerMode: true,
    //         className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
    //         closeOnClickOutside: false
    //       }).then(() => {
    //         // Reset the 'dirty' state of form controls
            
    //       });
  
    //       return false;
    //     }
    //   // }
    // } 
      let staffForm =this.staffForm.value; 
    staffForm.date_birth  = moment(staffForm.date_birth).format('YYYY-MM-DD').toString();   
       var data = {
        'repo': staffForm,
        'addressform': this.addressForm.value,
        'selectslotForm': this.selectslotForm.value,
        'userform': this.userForm.value,
        'courseselectForm': this.courseselectForm.value,
        'calenderdata': this.batchtraningdata_data,
        'referencek': this.referencepk,
        'staffrepopk': this.staffreferencepk,
        'courseform': this.CourseForm.value,
        'appostaffinfotmp_pk': this.appostaffinfotmp_pk,
        'applicationtype': this.applicationtype,
        'branchpk': this.appinstinfomain_pk
      };

      this.disableSubmitButton = true;
      this.appservice.stafffinalsave(data, this.staffapptype).subscribe(res => {
        this.disableSubmitButton = false;
        if (res.status == 200) {
          this.checkalltabsarefilled()
          this.getstaffgridlist(this.page, 0, null);
        }
        this.checkstaffconfiguration();

      });


      this.mattab = 3;
      this.staffform = false;
      this.ShowHide = true;
      // this.pageScrolltop();
      this.scrollTo('pagescroll');
      this.staffForm.markAsPristine();
      this.courseselectForm.markAsPristine();
      this.addressForm.markAsPristine();
      this.educationForm.markAsPristine();
      this.staffworkexperienceForm.markAsPristine();
    } else if (this.staffForm.invalid) {
      this.focusInvalidInput(this.staffForm);
      // }else if (this.educationForm.invalid) {
      //   this.focusInvalidInput(this.educationForm);

      // }else if (this.staffworkexperienceForm.invalid)  {
      //   this.focusInvalidInput(this.staffworkexperienceForm);
    }
    else if (this.courseselectForm.invalid) {
      this.focusInvalidInput(this.courseselectForm);
    }
    else if (this.selectslotForm.invalid) {
      this.focusInvalidInput(this.selectslotForm);
    } else {
      this.focusInvalidInput(this.addressForm)
    }

  }

  showHidestaff() { //staffadd
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',page:3 },
          { title: 'Staff', url: '/standardcourse/home',last:'true' },
        ]   
   };
   this.remoteService.breadcrumCookieValue(breadCrumb);
    if(this.AddressFormArr.length > 1) {
      const formArray = this.AddressFormArr;
      formArray.clear();
      this.addReferral()
    }
    this.staffapptype = 'new';
    this.staffform = true;
    this.ShowHide = false;
    this.newstaff = true;
    // this.pageScrolltop();
    this.staffstatus = 0
    this.scrollTo('pagescroll');
    this.selectedOption1 = true;
    this.selectedOption2 = false;
    this.accessoravilabe = false;
    this.drvInputedmoheri.selectedFilesPk = [];
    this.staffForm.reset();
    this.educationForm.reset()
    this.staffworkexperienceForm.reset()
    this.addressForm.reset()
    this.courseselectForm.reset();
    this.workExperience = [];
    this.education = [];
    this.fourthLength = 0;
    this.fifthLength = 0;
    this.batchtraningdata_data = [];
    this.staffForm.controls['civil_num'].enable()
    this.staffForm.controls['staffeng'].enable()
    this.staffForm.controls['staffarab'].enable()
    // this.staffForm.controls['count_ry'].setValue('31');
    this.staffForm.enable()
    this.educationForm.enable()
    this.staffworkexperienceForm.enable()
    this.addressForm.enable()
    this.deleteicon = true;
    this.vievalue = false;
    this.courseselectForm.enable()
    this.ageShow = true;
    this.gendershow = true;
    this.staffForm.controls['count_ry'].setValue('31');
    this.uploadfiles = false;
  }
  prevcourse() {
    this.mattab = 2;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');

  }
  finished() {
    // if(this.staffForm.valid || this.educationForm.valid || this.staffworkexperienceForm.valid) {
      if(this.staffconfigstatus == 'notok'){
        swal({
          // title: this.i18n('Kindly add the Minimum required Staff for all the selected Course Sub-categories to Submit for Desktop Review.'),
          title:'',
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false,
          content: {
            element: 'div',
            attributes: {
              innerHTML: this.staffconfigmsg_en
            }
          }
        });
        return false;
      }

    swal({
      title: this.i18n('maincenter.doyousubmt'),
      // text: 'You can still recover the file from the JSRS drive.',
      icon: 'success',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.appservice.submitdesktoreview(this.referencepk, this.apptype, this.applicationtype).subscribe(res => {
          if (res.status == 200) {
            this.getfirstgrid(this.page, 0, null);
            this.standardTemplate = 'course';
          }

        });
        setTimeout(() => {
          this.disableSubmitButton = false;
        }, 2000);
        if(this.standorcustom == 'standard'){
        this.toastr.success(this.i18n('Course Certification Form Submitted Successfully.'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }else{
        this.toastr.success(this.i18n('Course Certification Form Submitted Successfully.'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
      }
    });
    this.scrollTo('pagescroll');

  }
  makepayment(apppk, apptye, appstage, appsts, type) {
    this.disableSubmitButton = true;
    var pk = apppk;
    var type = type;
    console.log('encrypt data', apptye, appstage, appsts, apppk);
    if(this.applicationtype == 'renew') {
      this.myRoute.navigate(['standardcourse/home'],
      { queryParams: { p: this.secuirty.encrypt(apptye), t: this.secuirty.encrypt(appstage), s: this.secuirty.encrypt(appsts), at: this.secuirty.encrypt(apppk), bc: 'spym', f: 'sc',nwrn: 'rnj' } });
    }else if (this.applicationtype == 'update') {
      this.myRoute.navigate(['standardcourse/home'],
      { queryParams: { p: this.secuirty.encrypt(apptye), t: this.secuirty.encrypt(appstage), s: this.secuirty.encrypt(appsts), at: this.secuirty.encrypt(apppk), bc: 'spym', f: 'sc',nwrn: 'upd' } });
    }else {
      this.myRoute.navigate(['standardcourse/home'],
      { queryParams: { p: this.secuirty.encrypt(apptye), t: this.secuirty.encrypt(appstage), s: this.secuirty.encrypt(appsts), at: this.secuirty.encrypt(apppk), bc: 'spym', f: 'sc' } });
    }
  

    this.maindata;

  }

  canc() {
    swal({
      title: this.i18n("Do you want back to main centre"),
      text: " ",
      icon: 'warning',
      buttons: ["No", "Yes"],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then(() => {
      this.standardTemplate = 'MainCentre';
      // this.pageScrolltop();
      this.scrollTo('pagescroll');


    })
  }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {
      console.log('page-content')
    }
  }
  opendialogquicksetup() {
    const dialogRef = this.dialog.open(Modalavailabledate, {
      disableClose: true,
      panelClass: 'quicksetuplist',
    });
    //dialogRef.componentInstance.drawer = this.drawercontactus;
    dialogRef.afterClosed().subscribe((result) => {

    });
  }
  dateselect: boolean = true;
  checkData(availablecalender, index) {
    if (availablecalender == 64) {
      this.avaliabledate = false;
    } else if (availablecalender == 30) {
      this.weekend == false;
    } else if (availablecalender == 31) {
      this.holiday == false;
    }
    this.batchtraningdata_data[index].schedule = availablecalender;
  }


  dateFltrChange(event) {
    this.dateFilterSt = '';
    this.dateFilterEd = '';
    if (this.daterange.value) {
      let startvaldate = new Date(moment(this.daterange.value.startDate).format('YYYY-MM-DD'));
      let endvaldate = new Date(moment(this.daterange.value.endDate).format('YYYY-MM-DD'));
      this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>([]);
      this.batchtraningdata_data = [];
      this.getDateArray(startvaldate, endvaldate);
    }
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
      const year = val.getFullYear();
      const month = val.getMonth() + 1;
      const date = val.getDate();
      const fullDate = year + '-' + month + '-' + date;
      const fullDateFormat = val;

      let obj = {
        date: fullDate,
        day: val.toLocaleDateString('en-US', { weekday: 'long' }),
        selecteddate: val.toLocaleDateString('en-US', { weekday: 'short' }) + ' ' + moment(fullDateFormat).format('DD-MM-YYYY'),
        schedule: 1,
        subarr: [],
      };
      this.batchtraningdata_data.push(obj);
      i++;
    }
    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
    this.selectslotForm.controls['days'].setValue(this.batchtraningdata_data.length);
    this.sixLength = this.batchtraningdata_data.length;
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
  updateTime(firstindex, index, type, value) {
    if (type == 1) {
      this.batchtraningdata_data[firstindex].subarr[index].sstarttime = new Date(value).getHours() + ':' + new Date(value).getMinutes();
      this.batchtraningdata_data[firstindex].subarr[index].sstarttimeZone = value;
    } else {
      this.batchtraningdata_data[firstindex].subarr[index].sendtime = new Date(value).getHours() + ':' + new Date(value).getMinutes();
      this.batchtraningdata_data[firstindex].subarr[index].sendtimeZone = value;
    }
    this.calculateTimeDifference(firstindex, index)
  }

  addPhone(rowindex): void {
    const dataArray: any[] = this.batchtrainingdata.data;
    dataArray[rowindex].subarr.push({
      sstarttime: null,
      sstarttimeZone: null,
      sendtime: null,
      sendtimeZone: null
    })
    setTimeout(() => {
      this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(dataArray);
    }, 1000);
  }
  removePhone(index, rowindex) {
    const dataArray: any[] = this.batchtrainingdata.data;
    var selectedindex = dataArray[rowindex];
    selectedindex.subarr.splice(index, 1);
    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(dataArray);
  }
  get lessons() {
    return this.selectslotForm.controls["lessons"] as FormArray;
  }
  rowClear(index) {
    const dataArray: any[] = this.batchtrainingdata.data;
    var selectedindex = dataArray[index];
    selectedindex.subarr = [];
    selectedindex.schedule = null;
    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(dataArray);
  }

  addLesson(i, event) {
    // console.log(event + "valuearray");
    (<FormArray>this.selectslotForm.get('lessons')).at(i).get('title').setValue(event.value);
  }

  deleteLesson(lessonIndex: number) {
    this.lessons.removeAt(lessonIndex);
  }
  
  get AddressFormArr(): FormArray {
    return this.addressForm.get('Address') as FormArray;
  }
  getReferralsFormArr(index): FormGroup {
    const formGroup = this.AddressFormArr.controls[index] as FormGroup;
    return formGroup;
  }
  createCountry(): FormGroup {
    return this.formBuilder.group({
      governate: ['', Validators.required],//Validators.required   need to check
      wilayat: ['', Validators.required]
    });
  }
  addReferral(): void {
    // if (this.ReferralsFormArr.length < 10) {
    this.AddressFormArr.push(
      this.createCountry()
    );
  }
  // }
  removeReferral(index) {
    this.AddressFormArr.removeAt(index);
 this.citylist.splice(index, 1);
  }
  fileeSelectedmoheri(file, fileId) {
    console.log(file)
    console.log(fileId)
    fileId.selectedFilesPk = file;
    this.courseselectForm.controls['moheri_upload'].setValue(file[file.length - 1])
  }
  fileeSelected(file, fileId) {
    console.log(file)
    console.log(fileId)
    this.awaredForm.controls['document_upload'].setValue(file[0]);
    fileId.selectedFilesPk = [];
  }
  fileeSelected1(file, fileId, formctlname) {
    var filepk = file[file.length - 1]
    var ctrlname = 'file_' + formctlname
    this.documentForm.controls[ctrlname].setValue(filepk)
  }
  fileeSelectededucate(file, fileId) {
    this.educationForm.controls['education_files'].setValue(file[0]);
    fileId.selectedFilesPk = [];
  }
  fileeSelectwork(file, fileId) {
    this.staffworkexperienceForm.controls['work_files'].setValue(file[0]);
    fileId.selectedFilesPk = [];
  }
  ge
  getPhonesFormControls(): AbstractControl[] {
    return (<FormArray>this.userForm.get('phones')).controls
  }

  loadScheduleData(scheduledData) {
    const keysArray = Object.keys(scheduledData);
    const firstKey = scheduledData[0]['selecteddate'];
    const lastKey = scheduledData[keysArray.length - 1]['selecteddate'];
    let startDate = new Date(moment(firstKey).format('YYYY-MM-DD'));
    let endDate = new Date(moment(lastKey).format('YYYY-MM-DD'));
    this.daterange.patchValue({
      startDate: startDate,
      endDate: endDate
    });
    this.selectslotForm.controls['days'].setValue(scheduledData.length);
    this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(scheduledData);
    setTimeout(() => {

      if (this.dataSelect) {
        let dataAvailablestatus = this.dataSelect.toArray();
        scheduledData.forEach((data, i) => {
          this.optionSelect[i] = data.schedule;
          dataAvailablestatus[i].options._results.forEach((dataOption, xi) => {
            if (dataAvailablestatus[i].options._results[xi].value == data.schedule) {
              dataAvailablestatus[i].options._results[xi]._selected = true;
              dataAvailablestatus[i].options._results[xi]._active = true;
            }
          })
        });
        console.log(dataAvailablestatus)
      }
    }, 3000);
  }
  formattedTime = '00:00';
  calculateTimeDifference(z, i) {
    var endMilliseconds = this.batchtraningdata_data[z].subarr[i].sendtime;
    var startMilliseconds = this.batchtraningdata_data[z].subarr[i].sstarttime;
    if (endMilliseconds != null && startMilliseconds != null) {
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
      // this.formattedTime = `${hours}:${minutes}`;
      document.getElementById('difference' + z + i).innerHTML = `${hours}:${minutes}`;
      return false;
    }
  }
  cityselect(country) {
    // this.citylabel = this.staffForm.controls.inst_city.value == 1 ? this.i18n('staff.gove') : this.i18n('staff.state');
    if (country == 31) {
      this.oman = true;
    }
    else if (country = 31) {
      this.oman = false;
    }
  }
  cityselecttwo(countrytwo) {
    if (countrytwo == 31) {
      this.nonoman = true;
    }
    else if (countrytwo != 31) {
      this.nonoman = false;
    }
  }
  ctrychoose(countryfk) {

    this.appservice.getstatemst(countryfk).subscribe(res => {
      if (res.status == 200) {
        this.state = res.data.state;
      }
    });

  }
  isCheckboxDisabled: boolean = false;
  cleardate: boolean = false;
  worktilled: boolean = true;
  public selectedDate: any;
  public worktilldate: any;
  dateSelected(event: MatDatepickerInputEvent<Date>) {
    const selectedDate: Date = event.value;
    if (selectedDate) {
      this.isCheckboxDisabled = true;
      this.cleardate = true;
      this.worktilled = true;
    }
  }
  clearDate() {
    this.staffworkexperienceForm.controls['workdate'].reset();
    this.isCheckboxDisabled = false;
    this.cleardate = false;
  }
  notallowed: boolean = false;
  onCheckboxChange(event: MatCheckboxChange) {
    if (event.checked) {
      this.notallowed = true;
      this.staffworkexperienceForm.controls['workdate'].reset();
      this.staffworkexperienceForm.controls['workdate'].setErrors(null);
      this.worktilled = false;
    } else {
      this.staffworkexperienceForm.controls['workdate'].setErrors({ 'incorrect': true });
      this.worktilled = true;
      this.notallowed = false;

    }
  }
  onCheckboxChange1(truedata) {
    if (truedata) {
      this.notallowed = true;
      this.staffworkexperienceForm.controls['workdate'].reset();
      this.staffworkexperienceForm.controls['workdate'].setErrors(null);
      this.worktilled = false;
    } else {
      this.staffworkexperienceForm.controls['workdate'].setErrors({ 'incorrect': true });
      this.worktilled = true;
      this.notallowed = false;

    }
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
    // this.expandedElement = false;
  }
  Filterinternational() {
    this.Awarding.setValue("");
    this.LastAudited.setValue("");
    this.Status.setValue("");
    this.Addedon.setValue("");
    this.LastUpdated.setValue("");
    this.getinternatinallist(this.page, 0, null);



  }
  clearFiltersecound() {
    // if(this.arrayformcontols.touched) {
    //   this.getfirstgrid(this.page, 0, null);
    //   return false;
    // }
    if(this.appl_form.touched ||this.officetype.touched || this.bran_name.touched 
      || this.coures_type.touched ||this.course_titles.touched || this.course_cat.touched ||
      this.requested.touched ||this.courdeliver.touched || this.date_expiry.touched || 
      this.appl_status.touched ||this.cert.touched || this.addedon_branch.touched || this.lastUpdated_branch.touched )
{
    this.appl_form.reset();
  this.officetype.reset();
  this.bran_name.reset();
  this.coures_type.reset();
  this.course_titles.reset();
  this.course_cat.reset();
  this.requested.reset();
  this.courdeliver.reset();
  this.date_expiry.reset();
  this.appl_status.reset();
  this.cert.reset();
  this.addedon_branch.reset();
  this.lastUpdated_branch.reset();
  this.getfirstgrid(this.page, 0, null);
    }else {
      this.getfirstgrid(this.page, 0, null);
    }
  }

  clearFilterfour() {
    this.civil_numb.setValue("");
    this.staff_name.setValue("");
    this.role_course.setValue("");
    this.cours_sub_cate.setValue("");
    this.StatusCour.setValue("");
    this.adddoncour.setValue("");
    this.LastUpdatedcour.setValue("");

    this.getstaffgridlist(this.paginator2.pageSize, 0, null);
  }
  clearFiltereducation() {
    this.institute.setValue("");
    this.degree.setValue("");
    this.year_join.setValue("");
    this.year_pass.setValue("");
    this.grade.setValue("");
    this.add_On.setValue("");
    this.Last_Date.setValue("");

    this.getstaffedu(this.page, 0, null, this.staffreferencepk);
  }
  clearFilterework() {
    this.oranisation.setValue("");
    this.date_joined.setValue("");
    this.work_till.setValue("");
    this.count.setValue("");
    this.gover.setValue("");
    this.wilaya.setValue("");
    this.designation.setValue("");
    this.add_edOn.setValue("");
    this.add_On.setValue("");
    this.date_last.setValue("");
    
    this.getstaffwork(this.page, 0, null, this.staffreferencepk);

  }
  onchangecount() {
    this.staffForm.controls['count_ry'].enable();
    this.staffForm.controls['count_ry'].setValue('31');
    this.staffForm.controls['count_ry'].disable();

  }
  nexttab() {
    this.mattab = 1;
  }
  gotostaff() {
    this.mattab = 3;
  }
  canclework() {
    this.staffworkexperienceForm.controls['oragn_name'].reset();
    this.staffworkexperienceForm.controls['workdate'].reset();
    this.staffworkexperienceForm.controls['designat'].reset();
    this.staffworkexperienceForm.controls['date_join'].reset();
    this.staffworkexperienceForm.controls['curr_work'].reset();
    this.staffworkexperienceForm.controls['employ_country'].reset();
    this.staffworkexperienceForm.controls['employ_state'].reset();
    this.staffworkexperienceForm.controls['employ_city'].reset();
    this.staffworkapptype = 'new';
    this.workexpformshow = false;
    this.scrollTo('editdata')
    this.workInput.selectedFilesPk = []

  }
  oncHeckenable(event: MatCheckboxChange) {
    if (event.checked) { 
      this.finalsubmitbtn = false;
    }else {
      this.finalsubmitbtn = true;
    }
    }
  accessorschedule(appostaffinfotmp_pk){
    var breadCrumb ={
      title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/standardcourse/home',page:1 },
          { title: 'Certification Form', url: '/standardcourse/home',page:4 },
          { title: 'Schedule Assessor Availability', url: '/standardcourse/home',last:'true'},
        ]   
   };
   this.remoteService.breadcrumCookieValue(breadCrumb);
    var tmppk = this.secuirty.encrypt(appostaffinfotmp_pk);
    // this.appservice.getaccessorscheduledtls(appostaffinfotmp_pk,10, 0, null).subscribe(res => {
    //   if (res.status == 200) {
    //     this.accessordata = res['data'];
    //        }
    // });
    this.accessordata = appostaffinfotmp_pk;
    // this.showassessor = true;
    this.standardTemplate ='standardFroms';
    this.standardTemplate ='showassessor'
    // this.myRoute.navigate(['standardcourse/assessoravailability'],
    // { queryParams: { p:tmppk } });


  }
  documentpre() {
    console.log('testing breadcrumbs in assessor avillablity')
    this.remoteService.breadcrumCookieValueoutput(9);
    this.standardTemplate ='standardFroms';
    this.mattab = 3;
    this.scrollTo('pagescroll');

  }
  doneDate() {
    this.standardTemplate ='standardFroms';
    this.mattab = 3;

  }
  JoinList(value): string {
    // console.log(value);
    // if(value && value.lenght > 0)
    // {
      return value.join('\n');
    // }
    // else{
      // return "";
    // }
    
  }
  toggle(index: number): void {
    this.isopen[index] = !this.isopen[index];
  }
}


const quickset_data: quicksetupdatalist[] = [
  { position: 1 },
];



export interface quicksetupdatalist {
  position: any;

}

@Component({
  selector: 'modalavailabledate',
  templateUrl: './modalavailabledate.html',
  styleUrls: ['./modalavailabledate.scss'],
  encapsulation: ViewEncapsulation.None,
})



export class Modalavailabledate {
  public batchform: FormGroup;
  quicksetupdatalist = new MatTableDataSource<quicksetupdatalist>(quickset_data);
  quicksetupcolumn = ['days', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];



  constructor(
    private translate: TranslateService,
    private cookieService: CookieService,
    public dialogRef: MatDialogRef<Modalavailabledate>,
    private remoteService: RemoteService,
    private appservice: ApplicationService,
    private el: ElementRef,
    private fb: FormBuilder,
    @Inject(MAT_DIALOG_DATA) public data: Datadialog
  ) {
  }
  get cour() { return this.batchform.controls; }
  dir = 'ltr';
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  ngOnInit() {
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
    this.batchform = this.fb.group({
      starttime: ['', Validators.required],
      endtime: ['', Validators.required]

    })

  }
  @ViewChild('scroll', { read: ElementRef }) public scroll: ElementRef<any>;
  closedialog(): void {
    this.dialogRef.close();
  }

}
