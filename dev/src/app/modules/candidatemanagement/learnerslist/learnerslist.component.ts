import { Component, OnInit, ViewEncapsulation, AfterViewInit, ViewChild, ElementRef } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { LiveAnnouncer } from '@angular/cdk/a11y';
import { MatSort, Sort } from '@angular/material/sort';
import { SelectionModel } from '@angular/cdk/collections';
import { LearnerService } from '@app/services/learner.service';
import { height } from '@fortawesome/free-brands-svg-icons/faFacebookF';
import { ActivatedRoute, ParamMap, Router, RouterModule } from '@angular/router';
import { L } from '@angular/cdk/keycodes';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import swal from 'sweetalert';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { commentmodal } from '../../batch/modal/commentmodal';
import { BatchService } from '@app/services/batch.service';
import { ToastrService } from 'ngx-toastr';
import moment from 'moment';
import { APP_DATE_FORMATS, AppDateAdapter } from '@app/@shared/format-datepicker';
import { DateAdapter, MAT_DATE_FORMATS } from '@angular/material/core';
import { DriveInput } from '@app/common/classes/driveInput';
import { ApplicationService } from '@app/services/application.service';
import { Filee } from '@app/@shared/filee/filee';


export interface Tile {
  color: string;
  cols: number;
  rows: number;
  text: string;
}

export interface Batchinfo {
  sir_idnumber: any;
  sir_name_en: any;
  sir_name_ar: any;
  sir_emailid: any;
  sir_dob: any;
  sir_gender: any;
  th_tutor: any;
  pra_tutor: any;
  asmt_staff: any;
  ivqastaff: any;
  lrhd_feestatus: any;
  kstatus: any; //knowledge
  pstatus: any;
  lrhd_status: number;
  action: any;
  tad_learnerreghrddtls_fk: number;
  tad_batchmgmtthyhdr_fk: number;
  tad_batchmgmtpracthdr_fk: number;
  tad_batchmgmtdtls_fk: number;
  tad_batchmgmtdurationdtls_fk: number;
  trngattdntdtls_pk:number;
  pra_tutorpk: number;
  th_tutorpk:number;
}

export interface batch_details {
  company_name: string;
}



@Component({
  selector: 'app-learnerslist',
  templateUrl: './learnerslist.component.html',
  styleUrls: ['./learnerslist.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class LearnerslistComponent implements OnInit, AfterViewInit {
  @ViewChild("paginator") paginator: MatPaginator;
  tableloader: boolean = false;
  displayedColumns: string[] = ['checkbox','sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'kstatus', 'pstatus', 'lrhd_status', 'action'];

  displaySearchColumns: string[] = ['row-second', 'row-three', 'row-four', 'row-five',
    'row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-twelve', 'row-thirteen', 'row-fourteen', 'row-fifteen'];

  tiles: Tile[] = [
    { text: 'Training Evaluation Center: National Training Institute', cols: 1, rows: 1, color: 'lightblue' },
    { text: 'Batch No: 126465', cols: 1, rows: 1, color: 'lightpink' },
    { text: 'Batch Type: Initial', cols: 1, rows: 1, color: '#DDBDF1' },
  ];

  search: Tile[] = [
    { text: '', cols: 1, rows: 1, color: 'lightblue' },
    { text: '', cols: 1, rows: 1, color: 'lightpink' },
    { text: '', cols: 1, rows: 1, color: '#DDBDF1' },
  ];
  batchdata_data = null;

  attendance_data = [];
  move_data = [];
  attendance_other_data = [];

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

  value!: any;
  loading = true;
  param;
  filter: any = false;

  gen_selection: any = [];
  learner_selection: any = [];
  knowledge_selection: any = [];
  practical_selection: any = [];
  status_selection: any = [];
  showroplicense: boolean = false;
  lightlicenseradio: boolean = false;
  heavylicenseradio: boolean = false;
  gridlisting: boolean = true;
  // none value
  filterValues = {
    sir_gender: [],
    sir_emailid: '',
    sir_idnumber: '',
    sir_name_en: '',
    th_tutor: '',
    pra_tutor: '',
    asmt_staff: '',
    ivqastaff: '',
    lrhd_feestatus: [],
    kstatus: [],
    pstatus: [],
    lrhd_status: []
  };
  resultLenagth: number = 0;
  ifarbic: boolean = false;
  oman: boolean;
  rolearray: any = [];
  isStudentregStaff: boolean = false;
  approvalaccess: boolean = false;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;
  

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService, private _liveAnnouncer: LiveAnnouncer,
    private learnerService: LearnerService, public dialog: MatDialog, private router: Router,
    private routes: ActivatedRoute,
    private assessmentService: AssessmentReportService,
    private localstorage: AppLocalStorageServices,
    private batchService: BatchService,
    private toastr:ToastrService,
    private formBuilder: FormBuilder,
    private elementref: ElementRef,
    public appService: ApplicationService,

  ) { }

  formGroup: FormGroup;
  @ViewChild(MatSort) sort: MatSort;

  registerPage() {
    http://192.168.1.38:4200/candidatemanagement/learner-register/LVI-OPAL239-2023-004
    this.router.navigate(['/candidatemanagement/learner-register/'+this.param.bid]);
  }

  actionRoute(id, type){
    if(type=='assessment'){
      this.router.navigate(['/assessmentreport/assessmentreport/'+id]);
    }
    if(type=='view&approvel'){
      this.router.navigate(['/assessmentreport/viewandapprove/'+id+'/V']);
    }
    if(type=='ViewAssessmentReport'){
      this.router.navigate(['/assessmentreport/viewandapprove/'+id+'/NV']);
    }

    
  }

  i18n(key) {
    return this.translate.instant(key);
  }
  learnerdata_data: Batchinfo[];
  learnerdata: MatTableDataSource<any>;
  batchDetail: batch_details[];
  company: string;
  batch_no: string;
  selectAll: boolean = false;
  actionOption: string[] = ['Update Assessment Report', 'Retake Assessment', 'View Card', 'Print Card', 'View & Approve']
  page: number = 5;
  selectheader = false;
  fileeselect:boolean = false;

  filterForm = new FormGroup({
    sir_gender: new FormControl(''),
    sir_emailid: new FormControl(''),
    sir_idnumber: new FormControl(''),
    sir_name_en: new FormControl(''),
    th_tutor: new FormControl(''),
    pra_tutor: new FormControl(''),
    asmt_staff: new FormControl(''),

    ivqastaff: new FormControl(''),
    lrhd_feestatus: new FormControl(''),
    kstatus: new FormControl(''),
    pstatus: new FormControl(''),
    lrhd_status: new FormControl(''),
  });

  get sir_gender() {
    return this.filterForm.get('sir_gender');
  }

  get sir_emailid() {
    return this.filterForm.get('sir_emailid');
  }

  get sir_idnumber() {
    return this.filterForm.get('sir_idnumber');
  }

  get sir_name_en() {
    return this.filterForm.get('sir_name_en');
  }

  get th_tutor() {
    return this.filterForm.get('th_tutor');
  }

  get pra_tutor() {
    return this.filterForm.get('pra_tutor');
  }

  get asmt_staff() {
    return this.filterForm.get('asmt_staff');
  }

  get ivqastaff() {
    return this.filterForm.get('ivqastaff');
  }

  get lrhd_feestatus() {
    return this.filterForm.get('lrhd_feestatus');
  }

  get kstatus() {
    return this.filterForm.get('kstatus');
  }

  get pstatus() {
    return this.filterForm.get('pstatus');
  }

  get lrhd_status() {
    return this.filterForm.get('lrhd_status');
  }

  stktype;
  role;
  isfocalpoint;
  useraccess;
  regpk;
  pevent: PageEvent
  data5 = true;
  userPk=0;


  userattendance: boolean = false;
  userassessment: boolean = false;
  userassessmentview: boolean = false;
  userassessmentapprovel: boolean = false;
  createuseraccess: boolean = false;
  deleteuseraccess: boolean = false;
  printcardaccess: boolean = false;
  viewcardaccess: boolean = false;
  userattendancedownload: boolean = false;

  batchreadaccess: boolean = false;
  batchdeleteaccess: boolean = false;
  batchupdateaccess: boolean = false;
  learnercreateaccess: boolean = false;
  batchapproveaccess: boolean = false;
  learnerdownloadaccess: boolean = false;
  profilePhoto: DriveInput;
  cividId: DriveInput;
  licenseCard: DriveInput;
  stateList: any[] = [];
  cityList: any[] = [];
  countrylist: any[] = [];
  public memReg: any;
  public age: any;

  //radion_buttonGroup: any;
  @ViewChild('photodoc') photodoc: Filee;
  @ViewChild('cividoc') cividoc: Filee;
  @ViewChild('licensedoc') licensedoc: Filee;

  ngOnInit() {

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
    
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
    });
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }

    this.memReg = this.localstorage.getInLocal('reg_pk');
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.role = this.localstorage.getInLocal('role');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
   
    if(this.isfocalpoint == 2)
    {
      this.rolearray = this.role.split(",");
      this.rolearray.forEach(element => {
        if(element == 15)
        {
          this.isStudentregStaff = true;
        }
        
      });
    }
	
 this.useraccess = this.localstorage.getInLocal('uerpermission'); 
    if(this.isfocalpoint == 1){
      this.batchreadaccess = true;
      this.batchdeleteaccess = true;
      this.batchupdateaccess = true;
      this.learnercreateaccess = true;
      this.batchapproveaccess = true;
      this.learnerdownloadaccess = true;
      this.approvalaccess = true;
      this.downloadaccess = true;
      this.readaccess = true;
      this.createaccess = true;
      this.updateaccess = true;
      this.deleteaccess = true;
      this.userattendance = true;
      this.userattendancedownload = true;
      this.userassessment = true;
      this.userassessmentview = true;
      this.userassessmentapprovel = true;
      this.userassessment = true;
      this.printcardaccess = true;
      this.viewcardaccess = true;
      this.createuseraccess = true;
      this.deleteuseraccess = true;
    }
    console.log('regpk',this.regpk)
    console.log('userPk',this.userPk)
    console.log('stktype',this.stktype)
    console.log('role',this.role)
    console.log('isfocalpoint',this.isfocalpoint)
    console.log('useraccess',this.useraccess)
 if(this.isfocalpoint == 2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      let submodulebatch = this.stktype == 1 ? 4 : 21 ;
      let submodulelearner = this.stktype == 1 ? 5 : 22 ;
      let submodulelearnerattendence = this.stktype == 1 ? 6 : 23 ;
      let submodulelearnerassessment = this.stktype == 1 ? 7 : 24 ;
      let submodulelearnercard = this.stktype == 1 ? 8 : 25 ;
      console.log('moduleid', moduleid);

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerattendence] && this.useraccess[moduleid][submodulelearnerattendence].create == 'Y'){//Learner Attendance
        this.userattendance = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerattendence] && this.useraccess[moduleid][submodulelearnerattendence].download == 'Y'){//Learner Attendance
        this.userattendancedownload = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerassessment] && this.useraccess[moduleid][submodulelearnerassessment].create == 'Y'){//Learner Assessment
        this.userassessment = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerassessment] && this.useraccess[moduleid][submodulelearnerassessment].read == 'Y'){//Learner Assessment
        this.userassessmentview = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerassessment] && this.useraccess[moduleid][submodulelearnerassessment].approval == 'Y'){//Learner Assessment
        this.userassessmentapprovel = true;
      }

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnercard] && this.useraccess[moduleid][submodulelearnercard].create == 'Y'){//Learner Card
        this.printcardaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnercard] && this.useraccess[moduleid][submodulelearnercard].read == 'Y'){//Learner Card
        this.viewcardaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].create == 'Y'){//Manage Learners
        this.createuseraccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].delete == 'Y'){//Manage Learners
        this.deleteuseraccess = true;
      }

      //learner
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner]?.submodules == 'Manage Learners' && this.useraccess[moduleid][submodulelearner].approval == 'Y'){
        this.approvalaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner]?.submodules == 'Manage Learners' && this.useraccess[moduleid][submodulelearner].download == 'Y'){
        this.downloadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner]?.submodules == 'Manage Learners' && this.useraccess[moduleid][submodulelearner].read == 'Y'){
        this.readaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner]?.submodules == 'Manage Learners' && this.useraccess[moduleid][submodulelearner].create == 'Y'){
        this.createaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner]?.submodules == 'Manage Learners' && this.useraccess[moduleid][submodulelearner].update == 'Y'){
        this.updateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner]?.submodules == 'Manage Learners' && this.useraccess[moduleid][submodulelearner].delete == 'Y'){
        this.deleteaccess = true;
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
      // if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].download == 'Y'){
      //   this.learnerdownloadaccess = true;
      // }
    }
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



    this.routes.paramMap.subscribe((params: ParamMap) => {
      // console.log("params",);
      this.param = {
        bid: params.get('batch')
      }
      this.getbatchdtls(params.get('batch'));
      
      this.learnerService.getbranchinfo(this.param).subscribe(data => {
        // this.batchDetail = data.data.data
        this.company = data.data.data.branch_info?.omrm_companyname_en
        this.batch_no = data.data.data.batch_info?.bmd_Batchno;
      })

      

    })
    this.formSubscribe();
    // this.getFormsValue();
    this.getCountry();
    this.reactiveForm();
    
    this.formGroup.controls['sir_dob'].valueChanges.subscribe(value => {
        let m = moment();
          let years = m.diff(value, 'years');
          m.add(-years, 'years');
          let months = m.diff(value, 'months');
          m.add(-months, 'months');
          let days = m.diff(value, 'days');
         this.formGroup.controls.age.setValue(years)
        
      });
      
  
  }

  reactiveForm() {
    this.formGroup = this.formBuilder.group({
      'sir_idnumber': [null, Validators.required],
      'sir_name_en': [null, Validators.required],
      'sir_name_ar': [null, Validators.required],
      'sir_emailid': ['', [Validators.required, Validators.pattern(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)]],
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
      'lear_pk': [null,''],
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


  getageform(dob: any) {

    dob = dob.target ? dob.target.value : dob;
    var date1 = new Date();
    var date2 = new Date(dob);
    var diff = Math.floor(date1.getTime() - date2.getTime());
    var day = 1000 * 60 * 60 * 24;

    var days = Math.floor(diff / day);
    var months = Math.floor(days / 31);
    var years = Math.floor(months / 12);

    var message = years;
    // console.log(message, "dob");

    // this.formGroup.controls['age'].setValue(message);

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

  getlearner(param){
    this.learnerService.getLearnerList(param).subscribe(data => {
      this.learnerdata_data = data.data.data;      let data1 = this.data5 ? data.data?.data?.length > 5 ? data.data?.data.slice(0, 5) : data.data?.data : data.data?.data;
      console.log("data1", data1)
      this.data5 = false;
      this.learnerdata = new MatTableDataSource<any>(data1);
      console.log(this.learnerdata)

      this.learnerdata.paginator = this.paginator;
      this.learnerdata.sort = this.sort
      this.resultLenagth = data.data?.data?.length;
      console.log("this.resultLenagth",this.resultLenagth)
      this.selectAll = false;
      this.attendance_data = [];
      this.move_data = [];
      this.attendance_other_data = [];
      this.selectheader = false;
      this.getFormsValue();
    });
  }

  ngAfterViewInit() {
    this.getlearner(this.param);
  }
  // form subscribe
  formSubscribe() {
    this.sir_gender.valueChanges.subscribe((positionValue) => {
      this.filterValues['sir_gender'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });
    this.sir_emailid.valueChanges.subscribe((positionValue) => {
      console.log('this.learnerdata', this.learnerdata)
      this.filterValues['sir_emailid'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.sir_idnumber.valueChanges.subscribe((positionValue) => {
      this.filterValues['sir_idnumber'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.sir_name_en.valueChanges.subscribe((positionValue) => {
      this.filterValues['sir_name_en'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.th_tutor.valueChanges.subscribe((positionValue) => {
      this.filterValues['th_tutor'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.pra_tutor.valueChanges.subscribe((positionValue) => {
      this.filterValues['pra_tutor'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.asmt_staff.valueChanges.subscribe((positionValue) => {
      this.filterValues['asmt_staff'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.ivqastaff.valueChanges.subscribe((positionValue) => {
      this.filterValues['ivqastaff'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.lrhd_feestatus.valueChanges.subscribe((positionValue) => {
      this.filterValues['lrhd_feestatus'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.kstatus.valueChanges.subscribe((positionValue) => {
      this.filterValues['kstatus'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.pstatus.valueChanges.subscribe((positionValue) => {
      this.filterValues['pstatus'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });

    this.lrhd_status.valueChanges.subscribe((positionValue) => {
      this.filterValues['lrhd_status'] = positionValue;
      this.learnerdata.filter = JSON.stringify(this.filterValues);
    });
    // this.getlearner();
  }

  // create filter
  getFormsValue() {
    this.learnerdata.filterPredicate = (data, filter: string): boolean => {
      let searchString = JSON.parse(filter);
      let isPositionAvailable = false;
      if (this.gen_selection.length > 0) {
        isPositionAvailable = this.gen_selection.some(version => version == data.sir_gender);
      }
      else if (this.learner_selection.length > 0) {
        isPositionAvailable = this.learner_selection.some(version => version == data.lrhd_feestatus);
      }
      else if (this.knowledge_selection.length) {
        isPositionAvailable = this.knowledge_selection.some(version => version == data.kstatus);
      }
      else if (this.practical_selection.length) {
        isPositionAvailable = this.practical_selection.some(version => version == data.pstatus);
      }
      else if (this.status_selection.length) {
        isPositionAvailable = this.status_selection.some(version => version == data.lrhd_status);
      }
      else {
        isPositionAvailable = true;
      }
      let resultValue =
        isPositionAvailable &&
        (data?.sir_name_ar?.toString()
          .trim()
          .includes(searchString.sir_name_en?.toString().trim()) ||
          data?.sir_name_en?.toString()
            .trim()
            .toLowerCase()
            .indexOf(searchString.sir_name_en?.toLowerCase()) !== -1)&&
        data?.sir_idnumber?.toString()
          .trim()
          .toLowerCase()
          .indexOf(searchString.sir_idnumber?.toLowerCase()) !== -1
        &&
        data?.sir_emailid?.toString()
          .trim()
          .toLowerCase()
          .indexOf(searchString.sir_emailid?.toLowerCase()) !== -1
        &&
        data?.th_tutor?.toString()
          .trim()
          .toLowerCase()
          .indexOf(searchString.th_tutor?.toLowerCase()) !== -1
        &&
        data?.pra_tutor?.toString()
          .trim()
          .toLowerCase()
          .indexOf(searchString.pra_tutor?.toLowerCase()) !== -1
        &&
        data?.asmt_staff?.toString()
          .trim()
          .toLowerCase()
          .indexOf(searchString.asmt_staff?.toLowerCase()) !== -1
        &&
        data?.ivqastaff?.toString()
          .trim()
          .toLowerCase()
          .indexOf(searchString.ivqastaff?.toLowerCase()) !== -1

      return resultValue;
    };
    this.learnerdata.filter = JSON.stringify(this.filterValues);
  }

  clearFilter()
  {
     this.sir_name_en.setValue('');
     this.sir_gender.setValue('');
     this.sir_emailid.setValue('');
     this.sir_idnumber.setValue('');
     this.th_tutor.setValue('');
     this.pra_tutor.setValue('');
     this.asmt_staff.setValue('');
     this.ivqastaff.setValue('');
     this.lrhd_feestatus.setValue('');
     this.kstatus.setValue('');
     this.pstatus.setValue('');
     this.lrhd_status.setValue('');
    // this.status_selection = '';
    this.paginator.pageIndex = 0;
    this.paginator.pageSize = 5;
    this.getlearner(this.param)
  }

  syncPrimaryPaginator(event: PageEvent) {
    console.log("event", event)
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getlearner(this.param);
  }

  getbatchdtls(id) {
    this.loading = true;
    this.assessmentService.getbatchdtls(id).subscribe(data => {
      
      this.batchdata_data = data.data.data;
      if(this.batchdata_data?.isknw == 1 && this.batchdata_data?.ispra == 1){
          this.displayedColumns = ['checkbox','sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'kstatus', 'pstatus', 'lrhd_status', 'action'];
          this.displaySearchColumns = ['row-first','row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-twelve', 'row-thirteen', 'row-fourteen', 'row-fifteen'];
          if(!this.batchdata_data?.isthytutor && !this.batchdata_data?.ispratutor) {
            this.displayedColumns = ['sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'kstatus', 'pstatus', 'lrhd_status', 'action'];
            this.displaySearchColumns = ['row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-twelve', 'row-thirteen', 'row-fourteen', 'row-fifteen'];
            console.log('work fine')
          }
      }
      if(this.batchdata_data?.isknw == 2 && this.batchdata_data?.ispra == 2){
        this.displayedColumns = ['checkbox','sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'lrhd_status', 'action'];
        this.displaySearchColumns = ['row-first','row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven',  'row-fourteen', 'row-fifteen'];
        if(!this.batchdata_data?.isthytutor && !this.batchdata_data?.ispratutor) {
          this.displayedColumns = ['sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'lrhd_status', 'action'];
          this.displaySearchColumns = ['row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven',  'row-fourteen', 'row-fifteen'];
          console.log('work fine')
        }
      }
      if(this.batchdata_data?.isknw == 2 && this.batchdata_data?.ispra == 1){
        this.displayedColumns = ['checkbox','sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus',  'pstatus', 'lrhd_status', 'action'];
        this.displaySearchColumns = ['row-first','row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-thirteen', 'row-fourteen', 'row-fifteen'];
        if(!this.batchdata_data?.isthytutor && !this.batchdata_data?.ispratutor) {
          this.displayedColumns = ['sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus',  'pstatus', 'lrhd_status', 'action'];
          this.displaySearchColumns = ['row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-thirteen', 'row-fourteen', 'row-fifteen'];
          console.log('work fine')
        }
      }
      if(this.batchdata_data?.isknw == 1 && this.batchdata_data?.ispra == 2){
        this.displayedColumns = ['checkbox','sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'kstatus',  'lrhd_status', 'action'];
        this.displaySearchColumns = ['row-first','row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-twelve',  'row-fourteen', 'row-fifteen'];
        if(!this.batchdata_data?.isthytutor && !this.batchdata_data?.ispratutor) {
          this.displayedColumns = ['sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'kstatus',  'lrhd_status', 'action'];
          this.displaySearchColumns = ['row-second', 'row-three', 'row-four', 'row-five','row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-twelve',  'row-fourteen', 'row-fifteen'];
          console.log('work fine')
        }
      }
     
      this.loading = false;
    });
  }

  getassessmentstatus(no) {
    //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
    if (no == 1) {
      return 'New'
    } else if (no == 2) {
      return 'Teaching(Theory)'
    }
    else if (no == 3) {
      return 'Teaching(Practical)'
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

  /**
    * This functions is show filter display and hide
    */
  showFilter() {
    this.filter = !this.filter;

    if (!this.filter) {
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';
    }
    else {
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    }
  }

  getage(dob: any) {
    // var date1 = new Date();
    // var date2 = new Date(dob);
    // var diff = Math.floor(date1.getTime() - date2.getTime());
    // var day = 1000 * 60 * 60 * 24;

    // var days = Math.floor(diff / day);
    // var months = Math.floor(days / 31);
    // var years = Math.floor(months / 12);

    // var message = years;
  let age;
    if (dob) {
      var timeDiff = Math.abs(Date.now() - new Date(dob).getTime());
      age = Math.floor(timeDiff / (1000 * 3600 * 24) / 365.25);
        }

    return age;
  }

  getstatus(key: any) {
    key = parseInt(key);
    switch (key) {
      case 1:
        return 'New';
        break;
      case 2:
        return 'Teaching(Theory)';
        break;
      case 3:
        return 'Teaching(Practical)';
        break;
      case 4:
        return 'No Show(Theory)';
        break;
      case 5:
        return 'No Show(Practical)';
        break;
      case 6:
        return 'Assessment';
        break;
      case 7:
        return 'Quality Check';
        break;
      case 8:
        return 'Declined during Quality Check';
        break;
      case 9:
        return 'Resubmitted for Quality Check';
        break;
      case 10:
        return 'Print';
        break;
      case 11:
        return 'Completed';
        break;
      case 12:
        return 'Re-take Assesment';
        break;
      case 13:
        return 'Registration Cancelled';
        break;
      default:
        break;
    }
  }

  getstatuscolor(key: any) {
    key = parseInt(key);
    switch (key) {
      case 1:
        return '#ef3741';
        break;
      case 2:
        return '#59ca2a';
        break;
      case 3:
        return '#59ca2a';
        break;
      case 4:
        return '#ef3741';
        break;
      case 5:
        return '#ef3741';
        break;
      case 6:
        return '#C330CE';
        break;
      case 7:
        return '#0C4B9A';
        break;
      case 8:
        return '#0C4B9A';
        break;
      case 9:
        return '#0C4B9A';
        break;
      case 10:
        return '#0C4B9A';
        break;
      case 11:
        return '#00A551';
        break;
      case 12:
        return '#0C4B9A';
        break;
      case 13:
        return '#ef3741';
        break;
      default:
        break;
    }
  }

  announceSortChange(sortState: Sort) {

    if (sortState.direction) {
      this._liveAnnouncer.announce(`Sorted ${sortState.direction}ending`);
    } else {
      this._liveAnnouncer.announce('Sorting cleared');
    }
  }

  selectCheckbox(event: any, data) {
    let learner = this.attendance_data.length > 0 ? this.attendance_data : [];
    let movedata = this.move_data.length > 0 ? this.move_data : [];

    let attendance = this.attendance_other_data.length > 0 ? this.attendance_other_data : [];

    if (event.checked == true) {
      if(this.batchdata_data?.req_status==5){
        if(data.tad_learnerreghrddtls_fk && this.batchdata_data?.status==2 && data.lrhd_status == 2 ){
          learner.push(data.tad_learnerreghrddtls_fk);
         attendance.push(data);
        }
        if(data.tad_learnerreghrddtls_fk && this.batchdata_data?.status==3 && data.lrhd_status == 3 && data.pra_tutorpk == this.userPk){
          learner.push(data.tad_learnerreghrddtls_fk);
          attendance.push(data);
        }
      }else{
        learner.push(data.tad_learnerreghrddtls_fk);
        attendance.push(data);
      }
      if(data.tad_learnerreghrddtls_fk && this.batchdata_data?.status==2 && data.lrhd_status == 2 ){
        movedata.push(data.tad_learnerreghrddtls_fk);
      }
      if(data.tad_learnerreghrddtls_fk && this.batchdata_data?.status==3 && data.lrhd_status == 3 && data.pra_tutorpk == this.userPk){
        movedata.push(data.tad_learnerreghrddtls_fk);
      }
    }
    else if (event.checked == false) {
      learner = learner.filter(value => {
        if (value !== data.tad_learnerreghrddtls_fk) {
          return value;
        }
      })

      attendance = attendance.length > 0 && attendance.filter(value => {
        if (value.tad_learnerreghrddtls_fk !== data.tad_learnerreghrddtls_fk) {
          return value;
        }
      })
    }

    this.attendance_data = learner;
    this.move_data = movedata;
    this.attendance_other_data = attendance;

  }

  isAllSelected(event: any) {
    
    if (event.checked == true) {
      this.selectAll = true
      let learner: any = this.attendance_data.length > 0 ? this.attendance_data : [];
      let movedata = this.move_data.length > 0 ? this.move_data : [];
      let attendance: any = this.attendance_other_data.length > 0 ? this.attendance_other_data : [];
      console.log('attendance', attendance);
      let data = this.learnerdata.filteredData.map((value) => {
        //attendence
        if(this.batchdata_data?.req_status==5){
          if(value.tad_learnerreghrddtls_fk && this.batchdata_data?.status==2 && value.lrhd_status == 2 ){
            learner.push(value.tad_learnerreghrddtls_fk);
           attendance.push(value);
          }
          if(value.tad_learnerreghrddtls_fk && this.batchdata_data?.status==3 && value.lrhd_status == 3 && value.pra_tutorpk == this.userPk){
            learner.push(value.tad_learnerreghrddtls_fk);
            attendance.push(value);
          }
        }else{
          if(value.tad_learnerreghrddtls_fk && this.batchdata_data?.status==2 && (value.lrhd_status == 1 || value.lrhd_status == 2 || value.lrhd_status == 4)){
            learner.push(value.tad_learnerreghrddtls_fk);
            attendance.push(value);
          }
          if(value.tad_learnerreghrddtls_fk && this.batchdata_data?.status==3 && (value.lrhd_status == 3 || value.lrhd_status == 5) && value.pra_tutorpk == this.userPk){
            learner.push(value.tad_learnerreghrddtls_fk);
            attendance.push(value);
          }
        }
        //move status
        if(value.tad_learnerreghrddtls_fk && this.batchdata_data?.status==2 && value.lrhd_status == 2 ){
          movedata.push(value.tad_learnerreghrddtls_fk);
        }
        if(value.tad_learnerreghrddtls_fk && this.batchdata_data?.status==3 && value.lrhd_status == 3){
          movedata.push(value.tad_learnerreghrddtls_fk);
        }
      });
      this.attendance_data = learner;
      this.move_data = movedata;
      this.attendance_other_data = attendance;

      console.log(this.attendance_data);
      console.log(this.attendance_other_data);
    }
    else {
      this.selectAll = false;
      this.attendance_data = [];
      this.move_data = [];
      this.attendance_other_data = [];
    }
  }

  markAttendance(Status: any, data: any) {
    // console.log("status",Status+lid);
    let post_data = {
      tad_attended: Status,
      tad_trngdate: new Date(),
      tad_batchstatus: this.batchdata_data.status,
      tad_learnerreghrddtls_fk: [data.tad_learnerreghrddtls_fk],
      tad_batchmgmtthyhdr_fk: data.tad_batchmgmtthyhdr_fk,
      tad_batchmgmtpracthdr_fk: data.tad_batchmgmtpracthdr_fk,
      tad_batchmgmtdtls_fk: data.tad_batchmgmtdtls_fk,
      tad_batchmgmtdurationdtls_fk: data.tad_batchmgmtdurationdtls_fk
    }

    this.attendanceEndPoint(post_data);
  }

  

  bulkAttendance(status: any) {
    let data = this.attendance_other_data;

    if (data.length > 0) {
      let post_data = {
        tad_attended: status,
        tad_trngdate: new Date(),
        tad_batchstatus : this.batchdata_data.status,
        tad_learnerreghrddtls_fk: this.attendance_data,
        tad_batchmgmtthyhdr_fk: data[0].tad_batchmgmtthyhdr_fk,
        tad_batchmgmtpracthdr_fk: data[0].tad_batchmgmtpracthdr_fk,
        tad_batchmgmtdtls_fk: data[0].tad_batchmgmtdtls_fk,
        tad_batchmgmtdurationdtls_fk: data[0].tad_batchmgmtdurationdtls_fk
      }

      this.attendanceEndPoint(post_data);
    }
    else {
      swal({
        title: this.i18n('Please select atleast one learner'),
        // text: this.i18n('learnerregister.pleaseseleatl')
      })
    }
  }

  viewcard(id) {
    this.assessmentService.viewcard(id).subscribe(data => {
      let pdfUrl = data.data.data;
      console.log(pdfUrl)
      window.open(pdfUrl, '_blank');
    },error=>{
      swal({
        title: error.statusText,
        icon: 'warning',
        buttons: [false, 'OK'],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })
    });
   
  }

  printcard(id){
    this.assessmentService.printcard('100000001',id).subscribe(data => {
      let pdfUrl = data.data.data;
      console.log(pdfUrl)
      window.open(pdfUrl, '_blank');
    },error=>{
      swal({
        title: error.data,
        icon: 'warning',
        buttons: [false, 'OK'],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })
    });
  }

  attendanceEndPoint(post_data) {
    // foreach(){
    //   // learnerattendance  ad_learnerreghrddtls_fk
    // }
    this.learnerService.markattendance(post_data).subscribe(res => {
      if (res.data.msg == "success") {
        let msg = '';
        if(post_data.tad_learnerreghrddtls_fk.length == 1 && post_data.tad_attended == 1 ){
          msg = 'The selected Learner has been marked as Present';
        }else if(post_data.tad_learnerreghrddtls_fk.length > 1 && post_data.tad_attended == 1) {
          msg = 'All the selected Learners have been marked as Present';
        }else if(post_data.tad_learnerreghrddtls_fk.length == 1 && post_data.tad_attended == 2 ) {
          msg = "The selected Learner is Absent and has been marked as 'No Show'";
        }else if(post_data.tad_learnerreghrddtls_fk.length > 1 && post_data.tad_attended == 2) {
          msg = "All the selected Learners who are Absent have been marked as 'No Show'";
        }
        swal({
          title: msg,
          text: '',
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
        // swal(
        //   title: '',
        //   text: ' ',
        //   icon: 'warning',
        //   buttons: [false, this.i18n('company.ok')],
        //   dangerMode: true,
        //   className: this.dir =='ltr'?'swalEng':'swalAr',
        //   closeOnClickOutside: false
        // );
        // this.learnerdata_data.map((value, key) => {
        //   if (value.trngattdntdtls_pk==null && post_data.tad_learnerreghrddtls_fk.includes(value.tad_learnerreghrddtls_fk)) {
        //     this.learnerdata_data[key].trngattdntdtls_pk = 45;
        //   }
        // });
        //this.getlearner(this.param);
        this.clearFilter()
        //this.learnerdata = new MatTableDataSource<Batchinfo>(this.learnerdata_data);
      }
      else {
        // let msg = '';
        // console.log('post_data.tad_learnerreghrddtls_fk.length', post_data.tad_learnerreghrddtls_fk.length);
        // console.log('post_data.tad_batchstatus', post_data.tad_batchstatus);
        // // if(post_data.tad_learnerreghrddtls_fk.length == 1 && post_data.tad_attended == 1){
        // //   msg = 'The selected Learner has already marked as Present';
        // // }else if(post_data.tad_learnerreghrddtls_fk.length > 1 && post_data.tad_attended == 1) {
        // //   msg = 'All the selected Learners has been already marked as Present';
        // // }else if(post_data.tad_learnerreghrddtls_fk.length == 1 && post_data.tad_attended == 2) {
        // //   msg = 'The selected Learner has already been marked as No Show';
        // // }else if(post_data.tad_learnerreghrddtls_fk.length > 1 && post_data.tad_attended == 2) {
        // //   msg = 'All the selected Learners who are Absent have been already marked as No Show';
        // // }
        // if(post_data.tad_learnerreghrddtls_fk.length == 1){
        //   msg = 'The selected Learner attendence has been already marked';
        // }else if(post_data.tad_learnerreghrddtls_fk.length > 1) {
        //   msg = 'All the selected Learners attendence have been already marked';
        // }
        this.selectAll = false;
        this.attendance_data = [];
        this.attendance_other_data = [];
        this.selectheader  = false;
        swal({
          title: "The Attendance has already been Marked for the Day.",
          // text: this.i18n('learnerregister.attenalrereg'),
          icon: 'warning',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
      }
    })
  }

  moveStatus(status: any) {
    let post_data = {
      learnerreghrddtls_pk: this.move_data,
      lrhd_status: status,
      batchno:this.param.bid
    }
    if(post_data.learnerreghrddtls_pk.length == 0){

      let msg = '';

      if(post_data.lrhd_status == 3){
        msg = "The selected Learner has been Marked as 'No show'. Therefore, you cannot move this learner to the Practical Training";
      }
     
      if(post_data.lrhd_status == 6){
        msg = "The selected Learner has been Marked as 'No show'. Therefore, you cannot move this learner to the Assessment";
      }

      swal({
        title: msg,
        text: ' ',
        icon: 'warning',
        buttons: [false, this.i18n('company.ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })

    }else{
      this.statusEndPoint(post_data);
    }
  }

  statusEndPoint(post_data) {
    this.learnerService.learnerMoveStatus(post_data).subscribe(res => {
      if (res.data.msg == "success") {
        this.selectAll = false;
        this.attendance_data = [];
        this.move_data = [];
        this.attendance_other_data = [];
        this.selectheader  = false;
        this.getlearner(this.param);
        this.getbatchdtls(this.param.bid);
        let msg = '';

        if(post_data.learnerreghrddtls_pk.length == 1 && post_data.lrhd_status == 3){
          msg = 'The selected Learner has been moved to the Practical Training';
        }
        if(post_data.learnerreghrddtls_pk.length > 1 && post_data.lrhd_status == 3){
          msg = 'All the selected Learners have been moved to the Practical Training';
        }
        if(post_data.learnerreghrddtls_pk.length == 1 && post_data.lrhd_status == 6){
          msg = 'The selected Learner has been moved to the Assessment Stage';
        }
        if(post_data.learnerreghrddtls_pk.length > 1 && post_data.lrhd_status == 6){
          msg = 'All the selected Learners have been moved to the Assessment Stage';
        }


        swal({
          title: msg,
          text: ' ',
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
        // swal(
        //   '',
        //   ''
        // )
      }
      else {
        this.selectAll = false;
        this.attendance_data = [];
        this.move_data = [];
        this.attendance_other_data = [];
        this.selectheader  = false;
        swal({
          title: this.i18n('learnerregister.statnotupda'),
          // text: this.i18n('learnerregister.statnotupda'),
          icon: 'warning',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
        // swal({
        //   title: '',
        //   text: ''
        // })
      }
    })
  }

  opendialogprintsetup(id) {
    // const dialogRef = this.dialog.open(Modalprintsetup, {
    //   disableClose: true,
    //   panelClass: 'printsetuplist',
    // });
    // //dialogRef.componentInstance.drawer = this.drawercontactus;
    // dialogRef.afterClosed().subscribe((result) => {
      this.assessmentService.printcard('11',id).subscribe(data => {
        if(data.data.flag == 'S'){
          let pdfUrl = data.data.data;
          window.open(pdfUrl, '_blank');
          this.getlearner(this.param);
        } else{
          swal({
            title: this.i18n('learnerregister.error'),
            text: this.i18n('learnerregister.thatserianim'),
            icon: 'warning',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
          // swal({
          //   title: '',
          //   text: ''
          // })
        }
      },error=>{
        swal({
          title: error.statusText,
          icon: 'warning',
          buttons: [false, 'OK'],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
      });
    //});
  }

  viewbatch(){
    this.router.navigate(['/batchindex/batchviewpage/'+this.param.bid]);
  }

  cancelbatch(){
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field1', batchid: this.param.bid },
    });
    dialogRef.afterClosed().subscribe(result => {
      if(result.data)
      {
        this.batchService.ChangeBatchStatus(this.param.bid, 'cancel', result.data.comments).subscribe(res => {
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
        this.batchService.MovebatchToTheory(this.param.bid).subscribe(res => {
          if (res.data.status == 1) {
            this.getlearner(this.param);
            this.getbatchdtls(this.param.bid);
            this.toastr.success(this.i18n('viewlearners.batcstat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
        });
      }

    });

  }

  ChangeAssessor() {
    this.router.navigate(['/assessmentreport/changeassessor/'+this.param.bid+'/false']);
  }

  ChangeAssessorReq() {
    this.router.navigate(['/assessmentreport/changeassessor/'+this.param.bid+'/true']);
  }

  requesttrack() {
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field2', batchid: this.param.bid },
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.Requestforbacktrack(result.data.comments);
      }
    });
  }

  Requestforbacktrack(comments) {
   
    this.loading = true;
    this.batchService.Requestforbacktrack(this.param.bid, comments).subscribe(res => {
      if (res.data.status == 1) {
        this.toastr.success(this.i18n('learnerregister.reqforback'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
      else {
        this.loading = true;
      }

    });
  }

  updatestatus() {
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field3', batchid: this.param.bid, currentstatus: this.batchdata_data.status},
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.UpdateStatus(this.param.bid, result.data.status);
      }
    });
  }

  UpdateStatus(data, newstatus) {
    this.batchService.ChangeBatchStatus(data, newstatus).subscribe(res => {
      if (res.data.status == 1) {
        this.getlearner(this.param);
        this.getbatchdtls(this.param.bid);
        this.toastr.success(this.i18n('learnerregister.batchstaudasucc'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });
  }

  cancelbacktrack() {
    this.batchService.cancelbacktrack(this.param.bid).subscribe(res => {
      if (res.data.status == 1) {
        this.getbatchdtls(this.param.bid);
        this.toastr.success(this.i18n('viewlearners.requforback'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });
  }

  downloadAttenance() {
    this.batchService.downloadattendance(this.param.bid).subscribe(res => {
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
      }
    });
  }

 

  updatepaymentstaus(id){
    swal({
      title: this.i18n('learnerregister.areyousure'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('learnerregister.no'), this.i18n('learnerregister.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
     console.log("willGoBack",willGoBack)
     if(willGoBack){
      this.batchService.updatepaymentstatus(id).subscribe(res=>{
        this.getlearner(this.param);
        this.toastr.success(this.i18n('learnerregister.paystausupdat'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      })
     }
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
      this.cityList = data.data;
    })
  }

  editLear(learpk){
    this.gridlisting = false;

    this.getState(31);
    let repo = "";
    this.learnerService.viewLearner(learpk, '').subscribe(data => {
      if (data.data.status == 1) {
        console.log("data.data.data",data.data.data);
        let lrnr_data = data.data.data;
        this.getCity(lrnr_data.sir_opalstatemst_fk, 31);
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
        this.formGroup.controls['license_number'].setValue(lrnr_data.sld_ROPlicense);
        this.formGroup.controls['light_issue_date'].setValue(moment(lrnr_data.sld_ROPlightlicense).format('YYYY-MM-DD').toString());
        this.formGroup.controls['heavy_issue_date'].setValue(moment(lrnr_data.sld_ROPheavylicense).format('YYYY-MM-DD').toString());
        this.formGroup.controls['lear_pk'].setValue(learpk);
        
        this.changeFormAddressFromDb(lrnr_data.sir_gender);
        this.getage(lrnr_data.sir_dob);

        // enable edu work
        this.formGroup.controls['staffinforepo_fk'].setValue(data);
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

        //this.onradion_buttonGroupChange();
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
          this.profilePhoto.selectedFilesPk = [Number(lrnr_data.sir_photo)];
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
      }
    });

    this.formGroup.controls['sir_idnumber'].disable();
    //this.formGroup.controls['sir_name_en'].disable();
    //this.formGroup.controls['sir_name_ar'].disable();
  }

  getCountry() {
    this.appService.getcountry().subscribe(data => {
      // console.log("country",data.data);
      this.countrylist = data.data;
    })
  }


  gobatch() {
    if(this.formGroup.touched) {
      swal({
        title: this.i18n('Are you sure you want to cancel update this Learner Registration?'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('learnerregister.no'), this.i18n('learnerregister.yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
      
       if(willGoBack){
        this.gridlisting = true;
          // this.toastr.success(this.i18n('Successfilly Updated Learner Registration'), ''), {
          //   timeOut: 2000,
          //   closeButton: false,
          // };
       }
      });
    }else{
      this.gridlisting = true;
    }
  }
  submitForm(value) {
    //console.log("this.batchdata_datathis.batchdata_data",this.batchdata_data);
    this.formGroup.controls['sir_idnumber'].enable();
    this.formGroup.controls['sir_name_en'].enable();
    this.formGroup.controls['sir_name_ar'].enable();

    // this.formGroup.controls['sir_idnumber'].value;
    // this.formGroup.controls['sir_name_en'].value;
    // this.formGroup.controls['sir_name_ar'].value;

    let postParams = {
      sir_idnumber: this.formGroup.controls['sir_idnumber'].value,
      sir_name_en: this.formGroup.controls['sir_name_en'].value,
      sir_name_ar: this.formGroup.controls['sir_name_ar'].value,
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
      license_card: value.license_card,
      sir_civilidfront: value.sir_civilidfront,
      radion_button: value.radion_button,
      light_license: value.light_license,
      heavy_license: value.heavy_license,
      light_issue_date: moment(value.light_issue_date).format('YYYY-MM-DD').toString(),
      heavy_issue_date: moment(value.heavy_issue_date,).format('YYYY-MM-DD').toString(),
      license_number: value.license_number,
      sir_addrline1: value.sir_addrline1,
      sir_addrline2: value.sir_addrline2,
      lear_pk: value.lear_pk,
      // learner_fee: value.learner_fee,
      // learner_fee_status: value.learner_fee_status,
      // paid_by: value.paid_by,
      batchmgmtdtls: this.batchdata_data.batchmgmtdtls,
      //finalsave: this.finalsavedata
    }

    if(this.formGroup.valid) {
      this.loading = true;
      this.learnerService.learnerage(this.formGroup.value,postParams).subscribe(resdata => {
        this.age = resdata.data.data.scd_agelimit;

        this.fileeselect = false;
        this.loading = true;
        this.learnerService.updateLearner(postParams).subscribe(res => {
        this.loading = false;
      if(res.data.data == 'age_limit'){
          swal({
            title: this.i18n('Age of Learner should be greater than ') + this.age + this.i18n(' Years.'),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('learnerregister.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        } else {
          if (res.success) {
              let data = res.data.data;
              if(res.data.status == '1'){
                swal({
                  title: this.i18n('The Learner has been updated successfully.'),
                  text: '',
                  icon: 'success',
                  buttons: [false,this.i18n('Ok')],
                  dangerMode: true,
                  className: this.dir =='ltr'?'swalEng':'swalAr',
                  closeOnClickOutside: false
                }).then((willGoBack) => {
                
                if(willGoBack){
                  location.reload();
                }
                });
              }
          }
        }
      });
      });
      
    }else {
      this.fileeselect = true;
      this.focusInvalidInput(this.formGroup);
    }
  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.elementref.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        // console.log(key);
        if (invalidControl)
        {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  viewLear(lear){
    this.router.navigate(['candidatemanagement/learner-register/'+this.batchdata_data?.batach_no+'/'+lear]);
    
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
      this.formGroup.controls['light_issue_date'].reset('');
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
      this.formGroup.controls['heavy_issue_date'].reset('');
      this.formGroup.controls['heavy_issue_date'].setValidators(null);
      this.formGroup.controls['heavy_issue_date'].updateValueAndValidity();
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

  regicancel(id){
    swal({
      title: 'Are you sure you want to cancel Registering this Learner?',
      icon: 'warning',
      buttons: [this.i18n('viewlearners.no'), this.i18n('viewlearners.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if(willGoBack) {
        this.assessmentService.registrationcancel(id).subscribe(res=>{
          this.getlearner(this.param);
          this.toastr.success('This Learner has been Cancelled Successfully.', ''), {
            timeOut: 2000,
            closeButton: false,
          };
        })
      }
    });
  }
  deletelearner(id){
    swal({
      title: 'Are you sure you want to delete this Learner?',
      icon: 'warning',
      buttons: [this.i18n('viewlearners.no'), this.i18n('viewlearners.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if(willGoBack) {
        this.loading = true;
        this.assessmentService.deletelearner(id).subscribe(res=>{
          this.getbatchdtls(this.param.bid);
          this.getlearner(this.param);
          this.loading = false;
          this.toastr.success('This Learner has been Deleted Successfully.', ''), {
            timeOut: 2000,
            closeButton: false,
          };
        })
      }
    });
  }
}




@Component({
  selector: 'printquicksetup',
  templateUrl: './printquicksetup.html',
  styleUrls: ['./printquicksetup.scss'],
  encapsulation: ViewEncapsulation.None,
})

export class Modalprintsetup {
  public printform: FormGroup;
  constructor(
    public dialogRef: MatDialogRef<Modalprintsetup>,
    private remoteService: RemoteService,
    private translate: TranslateService,
    private cookieService: CookieService,
    private fb: FormBuilder
  ) {}
  lang = '1';
  dir = 'ltr';
  selectedItems: any;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  ngOnInit() {
   
    this.printform = this.fb.group({
      serialno: ['', Validators.required]
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
  closedialog(): void {
    this.dialogRef.close({ data: this.printform.controls['serialno'].value });
  }

  
}