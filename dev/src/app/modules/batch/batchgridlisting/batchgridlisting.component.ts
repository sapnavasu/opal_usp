import { animate, state, style, transition, trigger } from '@angular/animations';
import { SelectionModel } from '@angular/cdk/collections';
import { Component, ElementRef, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { DateAdapter, MAT_DATE_FORMATS } from '@angular/material/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { ActivatedRoute, Router } from '@angular/router';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { Encrypt } from '@app/common/class/encrypt';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { RemoteService } from '@app/remote.service';
import { BatchService } from '@app/services/batch.service';
import { TranslateService } from '@ngx-translate/core';
import moment from 'moment';
import { CookieService } from 'ngx-cookie-service';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { ToastrService } from 'ngx-toastr';
import swal from 'sweetalert';
import { commentmodal } from '../modal/commentmodal';

export interface BatchData {
  batch_no: any;
  batch_type: any;
  office_type: any;
  branch_name: any;
  assessment_center: any;
  total_leaners: any;
  remaining_capacity: any;
  training_duration: any;
  trainingdurationp: any;
  assessment_datetime: any;
  assessment_wilayat: any;
  categories: any;
  language: any;
  status: any;
  req_status: any;
  id: any;
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

const FILTERDATA = {
  batchno: [],
  batchtype: [],
  trainingprovider: [],					   
  officetype: [],
  branchname: [],
  asssessmentcenter: [],
  totallearning: [],
  remainingcapacity: [],
  trainingduration: [],
  coursepartical: [],
  assessmentdatetime: [],
  assessmentwilayat: [],
  assessmentstate: [],
  categories: [],
  language: [],
  status: [],
  serach_civil: [],
  trainingdurationpr: [],
  formcontrolname: [],
  fsgrid: [],
}

@Component({
  selector: 'app-batchgridlisting',
  templateUrl: './batchgridlisting.component.html',
  styleUrls: ['./batchgridlisting.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({ height: '*', display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class BatchgridlistingComponent implements OnInit {
  regpk: any;
  batchid: any;
  disableSubmitButton: boolean = false;
  userPk: any;
  stktype: any;
  role: any;
  isfocalpoint: any;
  searchdatacmt: boolean;
  batchlength: any;
  tutorlanglist: any = [];
  batchtypelist: any = [];
  categorylist: any = [];
  t: any;
  p: any;
  filterdata : { batchno: any[]; batchtype: any[]; trainingprovider: any[];  officetype: any[]; branchname: any[]; asssessmentcenter: any[]; totallearning: any[]; remainingcapacity: any[]; trainingduration: any[]; coursepartical: any[]; assessmentdatetime: any[]; assessmentwilayat: any[]; assessmentstate: any[]; categories: any[]; language: any[]; status: any[]; serach_civil: any[]; trainingdurationpr: any[]; formcontrolname: any[]; fsgrid: any[];};
  index = 0;
  paramstype  = null;
  roles: any;
  rolearray: any;
  isStudentregStaff: boolean = false;
  assessorTutor: boolean = false;
  learnercreateaccess: boolean = false;
  learnerreadaccess: boolean = false;
  learnerdownloadaccess: boolean = false;
  batchdeleteaccess: boolean = false;
  batchupdateaccess: boolean = false;
  batchcreateaccess: boolean = false;
  batchreadaccess: boolean = false;
  batchapproveaccess: boolean;
  assesmentcrete: boolean;
  sortting: { dir: any; key: any; };
  sorting: { dir: any; key: any; };
  
  i18n(key) {
    return this.translate.instant(key);
  }
  BatchData = ['batchno', 'batchtype', 'officetype', 'branchname', 'asssessmentcenter', 'totalleaners', 'remainingcapacity', 'trainingdurationth', 'trainingdurationpr', 'assessmentdatetime', 'assessmentwilayat', 'categories', 'language', 'req_status', 'status', 'action'];
  batchdata_data: BatchData[];
  batchdata: MatTableDataSource<BatchData>;
  governoratelist: any;
  public creationpageshow: boolean = true;
  selection = new SelectionModel<BatchData>(true, []);
  wilayatlist: any;
  memshpverify: boolean;
  ShowHide: boolean = true;
  operatcont: boolean = false;
  international: boolean = false;
  courses: boolean = false;
  staffform: boolean = false;
  selectedEstGovernorate: any;
  selectedEstGovernorateAr: any;
  Submitted: boolean = true;
  renewal: boolean = true;
  decline: boolean = true;
  maxDate = new Date();
  scrollTop: number;
  resultsLength: number;
  pageEvent: any;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  length = '';
  second = '';
  third = '';
  four = '';
  editOption: boolean = true;
  updated: boolean = true;
  isValid: boolean = true;
  isValided: boolean = true;
  valided: boolean = true;
  validture: boolean = true;
  perpage =
    BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;
  public pages: any;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  dataSourceforpermission: any;
  public projectName: string
  public useraccess: any = '';
  permissionarray: any;
  finalpermissionarray: any = [];
  page: number = 10;
  public companyinfocert: boolean = false;
  public isUserHaveDownAccess: boolean = false;
  public reglandingpage: boolean = true;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;

  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;

  tblplaceholder: boolean = false;
  expandedElement: any;
  constructor(
    private el: ElementRef,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private profileService: ProfileService,
    private cookieService: CookieService,
    private toastr: ToastrService,
    private batchService: BatchService,
    private router: Router,
    private localstorage: AppLocalStorageServices,
    private security: Encrypt, private dialog: MatDialog,
    public routeid: ActivatedRoute
  ) { }

  //filterformcontral name

  batchno = new FormControl('');
  batchtype = new FormControl('');
  trainingprovider = new FormControl('');									 
  officetype = new FormControl('');
  branchname = new FormControl('');
  asssessmentcenter = new FormControl('');
  totallearning = new FormControl('');
  remainingcapacity = new FormControl('');
  trainingduration = new FormControl('');
  coursepartical = new FormControl('');
  assessmentdatetime = new FormControl('');
  assessmentwilayat = new FormControl('');
  assessmentstate = new FormControl('');
  categories = new FormControl('');
  language = new FormControl('');
  status = new FormControl('');
  serach_civil = new FormControl('');
  trainingdurationpr = new FormControl('');

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
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
  ngAfterViewInit() {
    // setInterval(() => this.transFun(), 1000)
    this.routeid.queryParams.subscribe(params => {
      this.paramstype = params['tye'];
      this.p = params['p'];
      this.t = params['t'];
      setTimeout(() => {
        if (this.paramstype == 'N' || this.paramstype == 'A' || this.paramstype == 'P' || this.paramstype == 'T' || this.paramstype == 'YMFA' || this.paramstype == 'OGT' || this.paramstype == 'YMQC' || this.paramstype == 'RCRR' || this.paramstype == 'RFBT') {

          this.searchbatchgrid(this.paramstype, 'formcontrolname');
        }
        if (this.t == 'fsgrid') {
          this.searchbatchgrid(this.p, this.t);
        }
      }, 3000);

    })
  }
  ngOnInit(): void {
    if (localStorage.getItem('v3logindata') == null) {
      this.router.navigate(['/admin/login']);
    }
    
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.stktype = this.localstorage.getInLocal('stktype');
    if (this.stktype == 1) {
      this.BatchData = ['batchno', 'batchtype','trainingprovider', 'officetype', 'branchname', 'asssessmentcenter', 'totalleaners', 'remainingcapacity', 'trainingdurationth', 'trainingdurationpr', 'assessmentdatetime', 'assessmentstate', 'assessmentwilayat', 'categories', 'language', 'req_status', 'status', 'action'];
      this.searchdatacmt = false;
    }
    else {
      this.BatchData = ['batchno', 'batchtype', 'officetype', 'branchname', 'asssessmentcenter', 'totalleaners', 'remainingcapacity', 'trainingdurationth', 'trainingdurationpr', 'assessmentdatetime', 'assessmentstate', 'assessmentwilayat', 'categories', 'language', 'status', 'action'];
      this.searchdatacmt = true;
    }
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
        if(element == 12 || element == 12)
        {
          this.assessorTutor = true;
        }
        
      });
    }

    this.useraccess = this.localstorage.getInLocal('uerpermission');

    if(this.isfocalpoint == 1){
      this.learnerdownloadaccess = true;
      this.learnerreadaccess = true;
      this.learnercreateaccess = true;
      this.assesmentcrete = true;
      this.batchdeleteaccess = true;
      this.batchupdateaccess = true; 
      this.batchcreateaccess = true;
      this.batchreadaccess = true;
      this.batchapproveaccess = true;
    }

    if(this.isfocalpoint == 2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      let submodulebatch = this.stktype == 1 ? 4 : 21 ;
      let submodulelearner = this.stktype == 1 ? 5 : 22 ;
      let submodulelearnerdownload = this.stktype == 1 ? 6 : 23 ;
      let submodulelearnerassessment = this.stktype == 1 ? 7 : 24 ;

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].read == 'Y'){
        this.batchreadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].create == 'Y'){
        this.batchcreateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].update == 'Y'){
        this.batchupdateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].delete == 'Y'){
        this.batchdeleteaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].approval == 'Y'){
        this.batchapproveaccess = true;
      }

      console.log(this.useraccess)


      
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerdownload] && this.useraccess[moduleid][submodulelearnerdownload].download == 'Y'){
        this.learnerdownloadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].read == 'Y'){
        this.learnerreadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].create == 'Y'){
        this.learnercreateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerassessment] && this.useraccess[moduleid][submodulelearnerassessment].create == 'Y'){
        this.assesmentcrete = true;
      }
    }

    if (!this.batchreadaccess) {
       swal({
      title:"You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
      icon:'warning',
      closeOnClickOutside: false,
      closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (this.stktype == 1) {
      this.router.navigate(['dashboard/portaladmin']);
    }
    else{
      this.router.navigate(['dashboard/centre']);
    }
     }

      });

    }

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
        } else {
          this.filtername = "إخفاء التصفية";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
    });
    this.getmasterlist();
    this.getCategorylistforlist();
    this.disableSubmitButton = true;
    this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
    if (this.isfocalpoint == 2) {
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      if (this.useraccess[moduleid] && this.useraccess[moduleid].download == 'Y') {
        this.isUserHaveDownAccess = true;
      }
    }
    this.clearFilter();

  }
  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.batchdata.data.length;
    return numSelected === numRows;
  }
  getmasterlist() {
    this.batchService.getmasterlist().subscribe(response => {
      if (response.data.status == 1) {
        this.batchtypelist = response.data.data.batch;
        this.tutorlanglist = response.data.data.lang;
        // this.dayschedulelist = response.data.data.dayschedule;

      }
      else {
        this.batchtypelist = [];
        this.tutorlanglist = [];
        // this.dayschedulelist = [];
      }
    });
  }

  getCategorylistforlist() {
    this.batchService.getCategoryforgridlist().subscribe(res => {
      if (res.data.status == 1) {
        this.categorylist = res.data.data.categories;
       
      }
    });
  }

  creationpageshowdata() {

    this.creationpageshow = false;
    this.companyinfocert = true;
    this.scrollTo('pagescroll');
  }

  /** Selects all rows if they are not all selected; otherwise clear selection. */
  masterToggle() {
    this.isAllSelected() ?
      this.selection.clear() :
      this.batchdata.data.forEach(row => this.selection.select(row));
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

  searchbatchgrid(searckkey, formcontrolname) {

    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    if(this.paginator?.pageIndex)
    {
      this.paginator.pageIndex = 0;
      this.index = 0;
    }
    this.filterdata = this.preparedata(data);
    this.getbatchdtls( this.page, this.index,  this.filterdata,this.sorting)
  }

  preparedata(data) {

    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTERDATA;
    }
    else{
      filterdata = this.filterdata;
    }
    
   
    Object.keys(filterdata).forEach(keys => {
      if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });

    return filterdata;
  }

  serachAssessmentDateTime(event) {
    
    var assessmentdata;
    if (event.startDate) {
      assessmentdata = {
        start: moment(event.startDate._d).format('YYYY-MM-DD'),
        end: moment(event.endDate._d).format('YYYY-MM-DD')
      };
    }
    else {
      assessmentdata  = [];
    }
      
      this.searchbatchgrid(assessmentdata, 'assessmentdatetime');
    

  }

  serachTrainingTimeTheo(event, formcontrolname) {
    if (event) {
    
      var trainigtime = moment(event.value).format('YYYY-MM-DD');
      this.searchbatchgrid(trainigtime, formcontrolname);
    }
  }
  serachTrainingTimePract(event, formcontrolname) {
    if (event) {

      var trainigtime = moment(event.value).format('YYYY-MM-DD');
      this.searchbatchgrid(trainigtime, formcontrolname);
    }
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.tblplaceholder = true;
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.index = event.pageIndex;
    this.getbatchdtls(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata,this.sorting)
  }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
     
    } catch (error) {
      // console.log('page-content')
    }
  }
  clickfilterEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('course.showfilt');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('course.hidefilt');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  reglandingpagedata(event) {
    this.creationpageshow = event;
  }

  certifyhidedata(event) {
    this.companyinfocert = event;
    this.disableSubmitButton = true;
    this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
  }

  getbatchdtls(limit, index, searchkey,sorting) {

    let enRegPk = this.security.encrypt(this.regpk);
    this.tblplaceholder = true;
    this.batchService.getbatchdtls(enRegPk, limit, index, searchkey ,sorting).subscribe(data => {
      this.batchdata_data = data.data.batches;
      this.batchlength = data.data.totalcount;
      this.batchdata = new MatTableDataSource<BatchData>(this.batchdata_data);
      this.tblplaceholder = false;
      this.disableSubmitButton = false;
    });
  }

  sortingfunc(event,key){

    console.log(event)
    
    this.sorting = {
      'dir':event.direction,
      'key':event.active
    }
    this.tblplaceholder=true;
    setTimeout(() => {
      this.getbatchdtls(this.page, this.index, this.filterdata, this.sorting);
     
    }, 2000);
// console.log(event)
  }

  editData(data) {
    this.batchdata_data.forEach(y => {
      if (y.id == data.id) {
        this.batchid = data.batch_no;
        this.creationpageshowdata();
      }

    });
  }
  downloadAttenance(data) {
    this.batchService.downloadattendance(data.batch_no).subscribe(res => {
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
      }
    });
  }

  RegisterLearner(data) {
      this.router.navigate(['/candidatemanagement/learner-register/' + data.batch_no]);
  }

  ViewLearners(data) {
    this.router.navigate(['/candidatemanagement/viewlearner/' + data.batch_no]);
  }

  ChangeAssessor(data) {
    this.router.navigate(['/assessmentreport/changeassessor/'+data.batch_no+'/false']);
  }

  ChangeAssessorReq(data) {
    this.router.navigate(['/assessmentreport/changeassessor/'+data.batch_no+'/true']);
  }

 
  Requestforbacktrack(data, comments) {

    this.disableSubmitButton = true;
    this.batchService.Requestforbacktrack(data.batch_no, comments).subscribe(res => {
      if (res.data.status == 1) {
        this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
        this.toastr.success(this.i18n('common.requback'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
      else {
        this.disableSubmitButton = true;
      }

    });
  }
  UpdateStatus(data, newstatus) {
    this.batchService.ChangeBatchStatus(data.batch_no, newstatus).subscribe(res => {
      if (res.data.status == 1) {
        this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
        this.toastr.success(this.i18n('common.batcstat'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });
  }


  ViewBatch(data) {
    this.batchdata_data.forEach(y => {
      if (y.id == data.id) {
        this.router.navigate(['/batchindex/batchviewpage/'+data.batch_no]);

      }
    });
  }

  CancelBatch(data): void {

    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field1', batchid: data.batch_no },
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.batchdata_data.forEach(y => {
          if (y.id == data.id) {
            this.disableSubmitButton = true;
            this.batchService.ChangeBatchStatus(data.batch_no, 'cancel', result.data.comments).subscribe(res => {
              if (res.data.status == 1) {
                this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
                this.toastr.success(this.i18n('common.batchcanc'), ''), {
                  timeOut: 2000,
                  closeButton: false,
                };
              }

            });

          }
        });
      }

    });

  }

  requesttrack(batchdata) {
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field2', batchid: batchdata.batch_no },
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.Requestforbacktrack(batchdata, result.data.comments);
      }
    });
  }

  updatestatus(batchdata) {
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field3', batchid: batchdata.batch_no, currentstatus: batchdata.status },
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.UpdateStatus(batchdata, result.data.status );
      }
    });
  }
  cancelbacktrack(batchdata) {
    this.batchService.cancelbacktrack(batchdata.batch_no).subscribe(res => {
      if (res.data.status == 1) {
        this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
        this.toastr.success(this.i18n('common.requforback'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
    // this.expandedElement = false;

  }

  clearFilter() {
    this.clearfilterdata();
    if (this.t == 'fsgrid') {
      this.searchbatchgrid(this.p, this.t);
    } 
    else {
      if (this.paramstype) {
        this.router.navigate(['/batchindex/batchgridlisting']);
      }
      this.paginator.pageIndex = 0;
      this.paginator.pageSize = 10;
      this.batchno.reset();
      this.batchtype.reset();
      this.trainingprovider.reset();
      this.officetype.reset();
      this.branchname.reset();
      this.asssessmentcenter.reset();
      this.totallearning.reset();
      this.remainingcapacity.reset();
      this.trainingduration.reset();
      this.coursepartical.reset();
      this.assessmentdatetime.reset();
      this.assessmentwilayat.reset();
      this.assessmentstate.reset();
      this.categories.reset();
      this.language.reset();
      this.status.reset();
      this.serach_civil.reset();
      this.trainingdurationpr.reset();
      this.getbatchdtls(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata,this.sortting)
    }
  }

  clearfilterdata() {
    let value = {
      batchno: [] = [],
      batchtype: []= [],
      trainingprovider: [] = [],
      officetype: []= [],
      branchname: []= [],
      asssessmentcenter: []= [],
      totallearning: []= [],
      remainingcapacity: []= [],
      trainingduration: []= [],
      coursepartical: []= [],
      assessmentdatetime: [] = [],
      assessmentwilayat: [] = [],
      assessmentstate: [] = [],
      categories: [] = [],
      language: [] = [],
      status: [] = [],
      serach_civil: [] = [],
      trainingdurationpr: [] = [],
      formcontrolname: [] = [],
      fsgrid: [] = [],
    };
    this.filterdata = value ;
  }

  MovebatchToTheory(batchdata) {
    swal({
      title: this.i18n('Do you want to Move this Batch to Teaching (Theory)?'),
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.batchService.MovebatchToTheory(batchdata.batch_no).subscribe(res => {
          if (res.data.status == 1) {
            this.getbatchdtls(this.page, this.index, this.filterdata,this.sorting);
            this.toastr.success(this.i18n('common.batcstat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
        });
      }

    });

  }

  viewSchedule(){
    
    this.batchService.getCivino().subscribe(res => {
      if (res.data.status == true) {
        this.router.navigate(['approvalstaffmanagement/trainingavailability'], { queryParams: { id: btoa(res.data?.civilno) } });
        localStorage.setItem('typeView', 'viewAvailabilty')
      }
    });
  }

}



