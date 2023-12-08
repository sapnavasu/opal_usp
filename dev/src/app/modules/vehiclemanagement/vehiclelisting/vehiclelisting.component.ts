import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort,Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { ServiceVehiclemanagementService } from '../service-vehiclemanagement.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { environment } from '@env/environment';
import {MatSortModule} from '@angular/material/sort';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatCheckbox } from '@angular/material/checkbox';

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

export interface Element {
  offitype: any;
  branch: any;
  owner: any;
  vreg_num: any;
  chassnumb: any;
  vType: any;
  rType: any;
  inspectorname: any;
  inspectionDate: any;
  application: any;
  insStatus: any;
  perStatus: any;
  Dateofexp: any;
}

const FILTERDATA = {
  centrename:[],
  rasicnum: [],
  officetype: [],
  branch_name: [],
  time_Date: [],
  appl_form_filter: [],
  officetype_filter:[],
  trainingprovide_filter: [],
  odometerfilter: [],
  branch_filter: [],
  cour_type_filter: [],
  course_titles_filter: [],
  course_cat_filter: [],
  cour_subcate_filter: [],
  appl_type_filter: [],
  appl_status_filter: [],
  cert_status_filter: [],
  lastUpdated_branch_filter: []
}
const ELEMENT_DATA: Element[] = [
  {offitype: '' , branch: '' ,owner: 'NABET', vreg_num: '10-1-2023', chassnumb: 'PDF', vType: 'A', rType: '10-1-2023', inspectorname: 20 - 1 - 2023  ,inspectionDate: 20-3-2022, application: 'New' ,insStatus: 'Completed' , perStatus: 'New' , Dateofexp: 34-6-2034},
];
@Component({
  selector: 'app-vehiclelisting',
  templateUrl: './vehiclelisting.component.html',
  styleUrls: ['./vehiclelisting.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class VehiclelistingComponent implements OnInit {
  griddata: any =[];
  roadtype: any =[];
  tblplaceholder: boolean = false;
  url: string;
  search: {
    // serchkey: serch,
    // name: key,
    centrename:any;rasicnum: any; officetype: any; branch_name: any; time_Date: any; appl_form_filter: any; officetype_filter: any; trainingprovide_filter: any;  odometerfilter: any; branch_filter: any; cour_type_filter: any; course_titles_filter: any; course_cat_filter: any; cour_subcate_filter: any; appl_type_filter: any; appl_status_filter: any; cert_status_filter: any; lastUpdated_branch_filter: any;
  };
  roles: any;
  paramstype  = null;
  isVerifier: boolean = false;
  isSupervisor: boolean = false;
  isInspector: boolean = false;
  isfocalpoint: any;
  userPk: any;
  useraccess: any;
  filterdata: any;
  stktype: any;
  approvalaccess: boolean  = false;
  downloadaccess: boolean  = false;
  readaccess: boolean  = false;
  updateaccess: boolean  = false;
  printstickeraccess: boolean  = false;
  viewstickeraccess: boolean  = false;
  createaccess: boolean  = false;
  adminapprovalaccess: boolean  = false;
  adminreadaccess: boolean  = false;
  adminupdateaccess: boolean  = false;
  admincreateaccess: boolean  = false;
  admindownloadaccess : boolean = false;

  updateaccesss: boolean;
   allways = false;
  version: number = 0;


  // search: { serchkey: any; name: any; rasicnum: any; officetype: any; branch_name: any; time_Date: any; appl_form_filter: any; officetype_filter: any; trainingprovide_filter: any; branch_filter: any; cour_type_filter: any; course_titles_filter: any; course_cat_filter: any; cour_subcate_filter: any; appl_type_filter: any; appl_status_filter: any; cert_status_filter: any; lastUpdated_branch_filter: any; };
  i18n(key) {
    return this.translate.instant(key);
  }
  public fullPageLoaders: boolean = false;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  public selectAllVisible: boolean = false;
  page: number = 10;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  // displayedColumns = ['owner', 'vreg_num', 'chassnumb', 'vType', 'rType', 'inspectorname', 'inspectionDate','application','insStatus','perStatus', 'Dateofexp', 'action'];
  displayedColumns = [  
    { def: "centre_name",search: "row-firstonewone", label: "Centre Name", visible: true,disabled: true },
    { def: "rvrd_applicationrefno",search: "row-firstnew", label: "RASIC Number", visible: true,disabled: true },
    { def: "appiim_officetype",search: "row-new", label: "Office Type", visible: false ,disabled: false},
    { def: "appiim_branchname_en",search: "row-newone", label: "Branch Name", visible: false,disabled: false },
    { def: "owner_en",search: "row-first", label: "Owner Name", visible: false,disabled: false },
    { def: "rvrd_vechicleregno",search: "row-second", label: "Vehicle Reg. Number", visible: true,disabled: true },
    { def: "rvrd_chassisno",search: "row-three", label: "Chassis Number", visible: false,disabled: false },
    { def: "rvrd_odometerreading",search: "row-three-one", label: "Odometer Reading (in km)", visible: false,disabled: false },
    { def: "vehtype_en",search: "row-four", label: "Vehicle Category", visible: true,disabled: true },
    { def: "roadtype_en",search: "row-five", label: "Road Type", visible: false ,disabled: false},
    { def: "inspectorname",search: "row-six", label: "Inspector Name", visible: true,disabled: true },
    { def: "dateofinspetcion",search: "row-seven", label: "Inspection Date and Time", visible: true ,disabled: true},
    { def: "rvrd_applicationtype",search: "row-eight", label: "Applicant Type", visible: false ,disabled: false},
    { def: "rvrd_inspectionstatus",search: "row-nine", label: "Inspection Status", visible: true,disabled: true },
    { def: "rvrd_permitstatus",search: "row-ten", label: "Permit Status", visible: true,disabled: true },
    { def: "dateofexp",search: "row-eleven", label: "Date of Expiry", visible: false ,disabled: false},
    { def: "action",search: "row-twelve", label: "Action", visible: true ,disabled: true}];
    

  constructor( private fb: FormBuilder,public router: Router,
    private formBuilder: FormBuilder, 
    private el: ElementRef, 
    
    private translate: TranslateService, 
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private appservice: ApplicationService,
    private toastr: ToastrService, 
    public routeid: ActivatedRoute,
    private rasservice: ServiceVehiclemanagementService, 
    protected security: Encrypt,) { }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
    today = new Date();
   
    locale: LocaleConfig = {
      format:'DD-MM-YYYY',
    }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
    @ViewChild(MatSort) sort: MatSort;
    public ifarbic: boolean = false;
    @ViewChild('editchkbox') editchkbox: MatCheckbox;
  ngOnInit(): void {
    
     this.url = environment.baseUrl;
     this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
     this.userPk = this.localstorage.getInLocal('userPk');
     this.roles = this.localstorage.getInLocal('role');
     this.stktype = this.localstorage.getInLocal('stktype');
     if(this.isfocalpoint == 2)
     {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      console.log(this.useraccess);
      this.SetUseraccess();
     }
     
     
     

     if(this.isfocalpoint == 2)
     {
      console.log(this.roles);
      if(this.roles.includes(17))
      {
        this.isVerifier = true;
      }
      if(this.roles.includes(16))
      {
        this.isInspector = true;
      }
      if(this.roles.includes(18))
      {
        this.isSupervisor = true;
      }
     }

     if(!this.readaccess && !this.adminreadaccess  && this.isfocalpoint==2)
     {
       swal({
      title:"You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
      icon:'warning',
      closeOnClickOutside: false,
      closeOnEsc: false 
    }).then((willGoBack) => {
      if (willGoBack) {
        if(this.stktype == 1)
        {
          this.router.navigate(['dashboard/portaladmin']);
        }
        else{
          this.router.navigate(['dashboard/centre']);
        }
      }
    });
    
     }
     this.clearFilter();
      this.fullPageLoaders = true;
      this.getrasgriddata(this.page,0,null);
     
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
     
       }else{
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
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.filtername = "Hide Filter";
        ;
         }else{
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
      
    });
    
    
    if (this.stktype == 1) {
      this.displayedColumns = [
        { def: "centre_name",search: "row-firstonewone", label: "centre_name", visible: true,disabled: true },
        { def: "rvrd_applicationrefno",search: "row-firstnew", label: "RASIC Number", visible: true,disabled: true },
        { def: "appiim_officetype",search: "row-new", label: "Office Type", visible: false ,disabled: false},
        { def: "appiim_branchname_en",search: "row-newone", label: "Branch Name", visible: false,disabled: false },
        { def: "owner_en",search: "row-first", label: "Owner Name", visible: false,disabled: false },
        { def: "rvrd_vechicleregno",search: "row-second", label: "Vehicle Reg. Number", visible: true,disabled: true },
        { def: "rvrd_chassisno",search: "row-three", label: "Chassis Number", visible: false,disabled: false },
        { def: "rvrd_odometerreading",search: "row-three-one", label: "Odometer Reading (in km)", visible: false,disabled: false },
        { def: "vehtype_en",search: "row-four", label: "Vehicle Category", visible: true,disabled: true },
        { def: "roadtype_en",search: "row-five", label: "Road Type", visible: false ,disabled: false},
        { def: "inspectorname",search: "row-six", label: "Inspector Name", visible: true,disabled: true },
        { def: "dateofinspetcion",search: "row-seven", label: "Inspection Date and Time", visible: true ,disabled: true},
        { def: "rvrd_applicationtype",search: "row-eight", label: "Applicant Type", visible: false ,disabled: false},
        { def: "rvrd_inspectionstatus",search: "row-nine", label: "Inspection Status", visible: true,disabled: true },
        { def: "rvrd_permitstatus",search: "row-ten", label: "Permit Status", visible: true,disabled: true },
        { def: "dateofexp",search: "row-eleven", label: "Date of Expiry", visible: false ,disabled: false},
        { def: "action",search: "row-twelve", label: "Action", visible: true ,disabled: true}];
    }
    else {
      this.displayedColumns = [
        { def: "rvrd_applicationrefno",search: "row-firstnew", label: "RASIC Number", visible: true,disabled: true },
        { def: "appiim_officetype",search: "row-new", label: "Office Type", visible: false ,disabled: false},
        { def: "appiim_branchname_en",search: "row-newone", label: "Branch Name", visible: false,disabled: false },
        { def: "owner_en",search: "row-first", label: "Owner Name", visible: false,disabled: false },
        { def: "rvrd_vechicleregno",search: "row-second", label: "Vehicle Reg. Number", visible: true,disabled: true },
        { def: "rvrd_chassisno",search: "row-three", label: "Chassis Number", visible: false,disabled: false },
        { def: "rvrd_odometerreading",search: "row-three-one", label: "Odometer Reading (in km)", visible: false,disabled: false },
        { def: "vehtype_en",search: "row-four", label: "Vehicle Category", visible: true,disabled: true },
        { def: "roadtype_en",search: "row-five", label: "Road Type", visible: false ,disabled: false},
        { def: "inspectorname",search: "row-six", label: "Inspector Name", visible: true,disabled: true },
        { def: "dateofinspetcion",search: "row-seven", label: "Inspection Date and Time", visible: true ,disabled: true},
        { def: "rvrd_applicationtype",search: "row-eight", label: "Applicant Type", visible: false ,disabled: false},
        { def: "rvrd_inspectionstatus",search: "row-nine", label: "Inspection Status", visible: true,disabled: true },
        { def: "rvrd_permitstatus",search: "row-ten", label: "Permit Status", visible: true,disabled: true },
        { def: "dateofexp",search: "row-eleven", label: "Date of Expiry", visible: false ,disabled: false},
        { def: "action",search: "row-twelve", label: "Action", visible: true ,disabled: true}];
    }
    
  }

  ngAfterViewInit() {
    // setInterval(() => this.transFun(), 1000)
    this.routeid.queryParams.subscribe(params => {
      this.paramstype = params['grid'];
      setTimeout(() => {
        if (this.paramstype == 'In' ){

          this.appl_status_filter.setValue(['1','7']);
          this.applyFilter(['1','7'],'appl_status_filter');
        }
        else if(this.paramstype == 'Vf' )
        {
          this.appl_status_filter.setValue(['2']);
          this.applyFilter(['2'],'appl_status_filter');
        }
        else if(this.paramstype == 'Ap' )
        {
          this.appl_status_filter.setValue(['4']);
          this.applyFilter(['4'],'appl_status_filter');
        }
      }, 3000);

    })
  }

  centrename = new FormControl('');
  rasicnum = new FormControl('');
  officetype = new FormControl('');
  branch_name = new FormControl('');
  time_Date = new FormControl('');
  appl_form_filter = new FormControl('');
  officetype_filter = new FormControl('');
  trainingprovide_filter = new FormControl('');
  odometerfilter = new FormControl('');
  branch_filter = new FormControl('');
  cour_type_filter = new FormControl('');
  course_titles_filter = new FormControl('');
  course_cat_filter = new FormControl('');
  cour_subcate_filter = new FormControl('');
  appl_type_filter = new FormControl('');
  appl_status_filter = new FormControl('');
  cert_status_filter = new FormControl('');
  lastUpdated_branch_filter = new FormControl('');
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('table.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  clearfilterdata() {
    let value = {
      centrename:[] = [],
      rasicnum: [] = [],
      officetype: []= [],
      branch_name: []= [],
      time_Date: []= [],
      appl_form_filter: []= [],
      officetype_filter: []= [],
      trainingprovide_filter: []= [],
      odometerfilter: []= [],
      branch_filter: []= [],
      cour_type_filter: []= [],
      course_titles_filter: [] = [],
      course_cat_filter: [] = [],
      cour_subcate_filter: [] = [],
      appl_type_filter: [] = [],
      appl_status_filter: [] = [],
      cert_status_filter: [] = [],
      lastUpdated_branch_filter: [] = [],
    };
    this.filterdata = value ;
  }

  clearFilter(){
    $(".clear").trigger("click");
    this.clearfilterdata();
    this.centrename.reset();
    this.rasicnum.reset();
    this.officetype.reset();
    this.branch_name.reset();
    this.time_Date.reset();
    this.appl_form_filter.reset();
    this.officetype_filter.reset();
    this.trainingprovide_filter.reset();
    this.odometerfilter.reset();
    this.branch_filter.reset();
    this.cour_type_filter.reset();
    this.course_titles_filter.reset();
    this.course_cat_filter.reset();
    this.cour_subcate_filter.reset();
    this.appl_type_filter.reset();
    this.appl_status_filter.reset();
    this.cert_status_filter.reset();
    this.lastUpdated_branch_filter.reset();
    $(".clear").trigger("click");

    setTimeout(() => {
      this.getrasgriddata(this.page,0,this.filterdata);
    }, 2000);
    
    // this.cour_subcate_filter.reset();
    // this.lastUpdated_branch_filter.reset();
    
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getrasgriddata(this.paginator.pageSize, this.paginator.pageIndex, this.search)
    this.dataSource.sort = this.sort;
  }
  registerNow() {
    this.router.navigate(['/vehiclemanagement/vehicleregister']);
  }
  registerview(data) {
    this.router.navigate(['/vehiclemanagement/vehicleregister'],{ queryParams: { type: 'view',data:data },skipLocationChange: true});
  }
  inspectNow(data,type=1) {
    let pk = this.security.encrypt(data.rasvehicleregdtls_pk);
    if(type ==1 )
    {
      this.router.navigate(['/vehiclemanagement/vehicleinspection/'+ pk]);
    }
    else
    {
      this.router.navigate(['/vehiclemanagement/vehicleinspection/edit/'+ pk]);
    }
   
  }
  
  
  view(data) {
    let encregpk = this.security.encrypt(data.rasvehicleregdtls_pk);
    this.router.navigate(['/vehiclemanagement/vehicleinspectionstatus/view'],{ queryParams: { bc: 'spym',p:encregpk }});
  }
  renewNow(data) {
    let encregpk = this.security.encrypt(data.rasvehicleregdtls_pk);
    this.rasservice.getVehicleRegistrationStatus(encregpk).subscribe(res => {
     if(res.data.data == 3)
     {
      this.router.navigate(['/vehiclemanagement/vehicleinspection_info/'+encregpk]);
     }
     else{
      swal({
        title: this.i18n('The Application Has been Already Renewed'),
        icon: 'warning',
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })
      this.getrasgriddata(this.page, 0, this.search);
     }

    })
   
    
  }

  EditVehiclDtls(data)
  {
    let encregpk = this.security.encrypt(data.rasvehicleregdtls_pk);
    this.router.navigate(['/vehiclemanagement/editVehicle/'+encregpk]);
  }

  getrasgriddata(limit,page,searchkey){
    this.tblplaceholder = true;
    this.rasservice.getrasgriddata(limit,page,searchkey).subscribe(res => {
      if (res.status == 200) {
      this.resultsLength = res['data']['dataset']['totalcount'];
      this.griddata = res['data']['dataset']['griddata'];
      this.dataSource = new MatTableDataSource<Element>(this.griddata);
      this.tblplaceholder = false;
      this.dataSource.sort = this.sort;
      this.roadtype = res['data']['dataset']['roadtype'];
      }
      this.fullPageLoaders = false;
    });
  }

  changeDateInsp(serch, key)
  {
    var assessmentdata;
    if (serch.startDate) {
      assessmentdata = {
        startDate: moment(serch.startDate._d).format('YYYY-MM-DD'),
        endDate: moment(serch.endDate._d).format('YYYY-MM-DD')
      };
    }
    else
    {
      assessmentdata  = [];
    }
      
   
    this.applyFilter(assessmentdata, 'cour_subcate_filter');

  }
  changeDateExp(serch, key)
  {
   
    var assessmentdata;
    if (serch.startDate) {
      assessmentdata = {
        startDate: moment(serch.startDate._d).format('YYYY-MM-DD'),
        endDate: moment(serch.endDate._d).format('YYYY-MM-DD')
      };
    }
    else
    {
      assessmentdata  = [];
    }
      
    
    this.applyFilter(assessmentdata, 'lastUpdated_branch_filter');

  }

  applyFilter(searckkey, formcontrolname) {

    console.log(searckkey)

    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
   
    this.filterdata = this.preparedata(data);
    console.log(this.filterdata);
    this.getrasgriddata(this.page, 0, this.filterdata)
  }

  preparedata(data) {

    let filterdata;
    if(!this.filterdata)
    {
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
  


  generatesticker(element)
  {
    this.version = this.version +1;
    let encpk = this.security.encrypt(element.rasvehicleregdtls_pk);
    this.tblplaceholder = true;
    this.rasservice.rassticker(encpk,1).subscribe(res => {
      if(res.data.status == 1)
      {
        this.toastr.success(this.i18n('Sticker Re-generated Successfully'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.getrasgriddata(this.page,0,null);
      }
      else
      {
        swal({
          title: this.i18n('There was a problem while generating Sticker.'),
          icon: 'warning',
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
      }
    });
  }

  printorviewsticker(element,type)
  {
    let encpk = this.security.encrypt(element.rasvehicleregdtls_pk);
    this.tblplaceholder = true;
    this.rasservice.printorviewrassticker(encpk,type).subscribe(res => {
      if(res.data.status == 1)
      {
        this.getrasgriddata(this.page,0,null);
      }
    });
  }

  CancelVehicle(element)
  {
    let encpk = this.security.encrypt(element.rasvehicleregdtls_pk);
    this.tblplaceholder = true;
    this.rasservice.cancelvehicle(encpk).subscribe(res => {
      if(res.data.status == 1)
      {
        this.toastr.success(this.i18n('Vehicle Registration Cancelled Successfully'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.getrasgriddata(this.page,0,null);
      }
    });
  }

 
  // displayed column
  getdisplayedColumns(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
  }
  // displayed search
  getdisplayedsearch(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.search);
  }
  SetUseraccess()
  {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Vehicle Inspection and Approval');
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].approval == 'Y'){
      this.approvalaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].read == 'Y'){
      this.readaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].create == 'Y'){
      this.createaccess = true;
      console.log(this.createaccess);
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].update == 'Y'){
      this.updateaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][28] && this.useraccess[moduleid][28].create == 'Y'){
      this.printstickeraccess = true;
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][28] && this.useraccess[moduleid][28].read == 'Y'){
      this.viewstickeraccess = true;
    }
    
    let moduleidadmin = this.localstorage.getaccessmoduleid(this.stktype, 'RAS Vehicle Management');
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][30]  && this.useraccess[moduleidadmin][30].create == 'Y'){
      this.admincreateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][30] && this.useraccess[moduleidadmin][30].read == 'Y'){
      this.adminreadaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][30] && this.useraccess[moduleidadmin][30].update == 'Y'){
      this.adminupdateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][30] && this.useraccess[moduleidadmin][30].download == 'Y'){
      this.admindownloadaccess = true;
    }

    if(!this.adminreadaccess && !this.readaccess && this.stktype==2)
     {
       if(this.stktype == 1)
       {
         this.router.navigate(['/dashboard/portaladmin'])
       }
       else
       {
        this.router.navigate(['/dashboard/centre'])
       }
     }
    
  }
   // column edit function
   selectAllFun(event: any) {
    this.selectAllVisible = event.checked;
    this.displayedColumns.forEach(item => {
     
      // Only modify the visible property if the item is not disabled
        item.visible = this.selectAllVisible;
      
    });
    setTimeout(function () {
      $(".clear").trigger("click");
    }, 500);
  }
  // column edit function
  updateSelectAllVisible(item: any) {
      const allChecked = this.displayedColumns.every(item => item.visible);
      if (allChecked) {
        this.editchkbox.checked = true;
    }else {
      this.editchkbox.checked = false;
    }
    setTimeout(function () {
      $(".clear").trigger("click");
    }, 500);
  }
  

  exportgridData()
  {
    this.fullPageLoaders = true;
    let visiblearray = [];
    this.displayedColumns.forEach(element => {
      if(element.visible == true)
      {
        visiblearray.push(element.def)
      }
    });
    this.rasservice.exportGridData(null, null, this.filterdata,visiblearray).subscribe(res => {
      
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
        this.fullPageLoaders = false;
      }

    });
  }

  viewstatus(data , status){
    let encpk = this.security.encrypt(this.userPk);
    console.log(data)
    let rascategorypk = this.security.encrypt(data.category);
    let vehiclepk = this.security.encrypt(data.rasvehicleregdtls_pk);
    this.fullPageLoaders = true;
    this.rasservice.getstaffdetailsoncompetancyras(encpk,rascategorypk,vehiclepk).subscribe(res => {
      this.fullPageLoaders = false;
      if(res.data.flag == 'S')
      {
        let result = res.data.data;

        
        if(result.is_expired == 1)
        {
          let texted = "The 30 days grace period given for renewing your Staff Competency Card has expired on "+result.expireddate+". Hence, you cannot Approve the Inspected Vehicles on the OPAL USP."
          swal({
            title: this.i18n(texted),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
       }
        else{
          let swaltext = null;
          if(result.is_nearingexpiry == 1 && result.renewed ==0)
          {
            
            swaltext = "Your Competency Card is going to expire on "+result.nearingdate+". Kindly inform your RAS Inspection Centre’s Focal Point to Submit the Certification Form for the Competency Card renewal. If not, you will be unable to Approve the Inspected Vehicles on the OPAL USP. "
          }
          else if(result.graceperiod == 1 && result.renewed ==0){
            
            swaltext = "Your Competency Card has expired on "+result.nearingdate+" and we have given a grade period of 30 days for renewal. Kindly inform your RAS Inspection Centre’s Focal Point to Submit the Certification Form for the Competency Card renewal and get it renewed on or before "+result.graceperioddate+". If not, you will be unable to Approve the Inspected Vehicles on the OPAL USP. ";
          }

          swal({
            title: this.i18n(swaltext),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('Ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              let encregpk = this.security.encrypt(data.rasvehicleregdtls_pk);
              this.router.navigate(['/vehiclemanagement/vehicleinspectionstatus/approved'],{ queryParams: {p:encregpk,sts:status }});
            }
          });
          
        }
      }
      else
      {
        let encregpk = this.security.encrypt(data.rasvehicleregdtls_pk);
        this.router.navigate(['/vehiclemanagement/vehicleinspectionstatus/approved'],{ queryParams: {p:encregpk,sts:status }});
      }
    });
    
  }
  // Saff View Schedule
  viewSchedule(){
    this.rasservice.getCivino().subscribe(res => {
      if (res.data.status == true) {
        this.router.navigate(['approvalstaffmanagement/technicalviewschedule'], { queryParams: { id: btoa(res.data?.civilno) } });
        localStorage.setItem('typeView', 'viewAvailabilty')
      }
    });
  }
}
