import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort,Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Router, ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { environment } from '@env/environment';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { E } from '@angular/cdk/keycodes';
import { MatCheckbox } from '@angular/material/checkbox';
import { StandardCourseConfigurationService } from '@app/services/standard-course-configuration.services';


export interface SubcategoryDetails {
  coursesubcategory: any;
  isprint: any;
  thyclasslimit: any;
  praclasslimit: any;
  asclasslimit: any;
  status: any;
  createdOn: any;
  createdBy: any;
  lastUpdatedOn: any;
  lastUpdatedBy: any;
}
const FILTERDATA = {
  coursesubcategory : '',
  isprint : '',
  thyclasslimit : '',
  praclasslimit : '',
  asclasslimit : '',
  status : '',
  createdOn : '',
  createdBy : '',
  lastUpdatedOn : '',  
  lastUpdatedBy : ''
}

@Component({
  selector: 'app-viewcoursegridlist',
  templateUrl: './viewcoursegridlist.component.html',
  styleUrls: ['./viewcoursegridlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewcoursegridlistComponent implements OnInit {

  i18n(key) {
    return this.translate.instant(key);
  }
  public fullPageLoaders: boolean = false;
  tblplaceholder = false;
  public selectAllVisible: boolean = false;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  page: number = 5;
 

  index = 0;
  dataSource : MatTableDataSource<SubcategoryDetails>;
  project;
  standcourse;
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;
  downloadaccess = false;
  refresh = false;

  // mockData =[{coursesubcategory:'Light vechical', isprint:'Yes', thyclasslimit:'6', 
  // praclasslimit:'3', asclasslimit:'6', status:'Active', createdOn:'July 2023',
  // createdBy:'Thomas',lastUpdatedOn:'July 2023',lastUpdatedBy:'Clare'}]
  filterdata : {  
    coursesubcategory : any,
    isprint : any,
    thyclasslimit : any,
    praclasslimit : any,
    asclasslimit : any,
    status : any,
    createdOn : any,
    createdBy : any,
    lastUpdatedOn : any, 
    lastUpdatedBy : any,  
  };
  displayedColumns = [  
    { def: "coursesubcategory",search: "row-one", label: "Course Sub-category", visible: true,disabled: false },
    { def: "isprint",search: "row-two", label: "Is Final Permit Card issued ?", visible: true ,disabled: false},
    { def: "thyclasslimit",search: "row-three", label: "Theory Class Limit", visible: true,disabled: false },
    { def: "praclasslimit",search: "row-four", label: "Practical Class Limit", visible: true,disabled: false },
    { def: "asclasslimit",search: "row-five", label: "Assessment Class Limit", visible: true,disabled: false },
    { def: "status",search: "row-six", label: "Status", visible: true,disabled: false },
    { def: "createdOn",search: "row-seven", label: "Created On", visible: false,disabled: false },
    { def: "createdBy",search: "row-eight", label: "Created By", visible: false ,disabled: false},
    { def: "lastUpdatedOn",search: "row-nine", label: "Last Updated On", visible: false,disabled: false },
    { def: "lastUpdatedBy",search: "row-ten", label: "Last Updated By", visible: false ,disabled: false},
    { def: "action",search: "row-eleven", label: "action", visible: true ,disabled: false},
    ];

    coursesubcategory = new FormControl('');
    isprint = new FormControl('');
    thyclasslimit = new FormControl('');
    praclasslimit = new FormControl('');
    asclasslimit = new FormControl('');
    status = new FormControl('');
    createdOn = new FormControl('');
    createdBy = new FormControl('');
    lastUpdatedOn = new FormControl('')
    lastUpdatedBy = new FormControl('')
  

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
    subcourselist_length;
    subcourselist;
    smstid;
    coursedata;
    subcategorylist;
    
  feedetails;
  public hideviewfee: boolean = true;
  viewname = 'View Fee Subscription';
  main_cfi;
  main_cfr;
  main_sefi;
  main_srefi;
  main_sefu;
  main_srefu;
  branch_cfi;
  branch_cfr;
  branch_sefi;
  branch_srefi;
  branch_sefu;
  branch_srefu;
  isroyal = "2";
  royal;
    
  

  constructor( private fb: FormBuilder,
    public router: Router,
    private formBuilder: FormBuilder, 
    private el: ElementRef, 
    private translate: TranslateService, 
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private appservice: ApplicationService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService, 
    private route: ActivatedRoute,
    protected security: Encrypt,
    private services: StandardCourseConfigurationService) {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
     }

  ngOnInit(): void {
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
    if(this.isfocalpoint == 1 && this.stktype == 1){
      this.createaccess = true;
      this.viewacess = true;
      this.updateaccess = true;
    };
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Configuration');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].create == 'Y'){
      this.createaccess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].read == 'Y'){
      this.viewacess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].update == 'Y'){
      this.updateaccess = true;
    }
    this.smstid = this.route.snapshot.paramMap.get('id');
    this.getcourse();
    this.getprereqlist();
    this.getsubcourselist(this.page,this.index,this.filterdata);
  }

  // displayed column
  getdisplayedColumns(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
  }

  // displayed search
  getdisplayedsearch(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.search);
  } 
  
  selectAllFun(event: any) {
    this.selectAllVisible = event.checked;
    this.displayedColumns.forEach(item => {
     
      // Only modify the visible property if the item is not disabled
        item.visible = this.selectAllVisible;
      
    });
  }

  // column edit function
  updateSelectAllVisible(item: any) {
      const allChecked = this.displayedColumns.every(item => item.visible);
      if (allChecked) {
        this.editchkbox.checked = true;
    }else {
      this.editchkbox.checked = false;
    }
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

  searchbatchgrid(searckkey, formcontrolname) {
    console.log(2);
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getsubcourselist(this.page,this.index,this.filterdata);
  }

  serachdate(event, formcontrolname) {
    var expirydate;
    if (event.startDate) {
      expirydate = {
        start: moment(event.startDate._d).format('YYYY-MM-DD'),
        end: moment(event.endDate._d).format('YYYY-MM-DD')
      };
      this.refresh = false;
    }
    else
    {
      expirydate  = [];
    }

    if(!this.refresh){
      this.searchbatchgrid(expirydate, formcontrolname);
    }
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
  
  clearFilter(){
    if(this.paginator){
      this.paginator.pageIndex = 0;
      this.paginator.pageSize = 5;
    }
    this.refresh = true;
    this.coursesubcategory.reset();
    this.isprint.reset();
    this.thyclasslimit.reset();
    this.praclasslimit.reset();
    this.asclasslimit.reset();
    this.status.reset();
    this.createdOn.reset();
    this.createdBy.reset();
    this.lastUpdatedOn.reset();
    this.lastUpdatedBy.reset();
    this.filterdata = { 
      coursesubcategory : '',
      isprint : '',
      thyclasslimit : '',
      praclasslimit : '',
      asclasslimit : '',
      status : '',
      createdOn : '',
      createdBy : '',
      lastUpdatedOn : '',  
      lastUpdatedBy : '',    
    };      
    this.dataSource = new MatTableDataSource<SubcategoryDetails>([]);
    this.tblplaceholder = false;
    
    this.subcourselist_length = 0;
    this.getsubcourselist(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
    $(".clear").trigger("click");
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getsubcourselist(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
  }

  viewfee() {

    this.hideviewfee = !this.hideviewfee;
    if (!this.hideviewfee) {
      this.viewname = this.ifarbic ? 'Hide Fee Subscription' : 'Hide Fee Subscription';
      const id = document.getElementById('feediv') as HTMLElement;
      id.style.display = 'block';
    } else {
      this.viewname = this.ifarbic ? 'View Fee Subscription' : 'View Fee Subscription';
      const id = document.getElementById('feediv') as HTMLElement;
      id.style.display = 'none';

    }
  }

  getcourse(){
    this.services.getCourse(this.smstid).subscribe(res=>{
      this.coursedata = res.data.data.course;
      this.feedetails = res.data.data.fee;
      console.log('coursedata', this.coursedata);
      console.log('feedetails', this.feedetails);
      let fee_main_cfi = this.feedetails.filter((item)=>(item.fsm_feestype == 1 && item.fsm_applicationtype == 1))
      if(fee_main_cfi.length > 1){
        let main_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 1);
        let branch_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 2);
        this.main_cfi = main_cfi_ar[0]?.fsm_fee
        this.branch_cfi = branch_cfi_ar[0]?.fsm_fee
      }else if(fee_main_cfi.length == 1){
        let main_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 3);
        this.main_cfi = main_cfi_ar[0]?.fsm_fee
        this.branch_cfi = main_cfi_ar[0]?.fsm_fee
      }

      let fee_main_cfr = this.feedetails.filter((item)=>(item.fsm_feestype == 1 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2) ))
      if(fee_main_cfr.length > 1){
        let main_cfr_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 1);
        let branch_cfr_ar = fee_main_cfr.filter((item)=>item.fsm_officetype == 2);
        this.main_cfr = main_cfr_ar[0]?.fsm_fee;
        this.branch_cfr = branch_cfr_ar[0]?.fsm_fee;
      }else if(fee_main_cfr.length == 1){
        let main_cfr_ar = fee_main_cfr.filter((item)=>item.fsm_officetype == 3);
        this.main_cfr = main_cfr_ar[0]?.fsm_fee;
        this.branch_cfr = main_cfr_ar[0]?.fsm_fee;
      }

      let fee_main_sefi = this.feedetails.filter((item)=>(item.fsm_feestype == 2 && item.fsm_applicationtype == 1))
      
      if(fee_main_sefi.length > 1){
        let main_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 1);
        let branch_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 2);
        this.main_sefi = main_sefi_ar[0]?.fsm_fee;
        this.branch_sefi = branch_sefi_ar[0]?.fsm_fee;
      }else if(fee_main_sefi.length == 1){
        let main_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 3);
        this.main_sefi = main_sefi_ar[0]?.fsm_fee;
        this.branch_sefi = main_sefi_ar[0]?.fsm_fee;
      }

      let fee_main_sefu = this.feedetails.filter((item)=>(item.fsm_feestype == 2 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2)))
      if(fee_main_sefi.length > 1){
        let main_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 1);
        let branch_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 2);
        this.main_sefu = main_sefu_ar[0]?.fsm_fee;
        this.branch_sefu = branch_sefu_ar[0]?.fsm_fee;
      }else if(fee_main_sefi.length == 1){
        let main_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 3);
        this.main_sefu = main_sefu_ar[0]?.fsm_fee;
        this.branch_sefu = main_sefu_ar[0]?.fsm_fee;
      }

      let fee_main_srefi = this.feedetails.filter((item)=>(item.fsm_feestype == 6 && item.fsm_applicationtype == 1))
      if(fee_main_srefi.length > 1){
        let main_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 1);
        let branch_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 2);
        this.main_srefi = main_srefi_ar[0]?.fsm_fee;
        this.branch_srefi = branch_srefi_ar[0]?.fsm_fee;
      }else if(fee_main_srefi.length == 1){
        let main_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 3);
        this.main_srefi = main_srefi_ar[0]?.fsm_fee;
        this.branch_srefi = main_srefi_ar[0]?.fsm_fee;
      }

      let fee_main_srefu = this.feedetails.filter((item)=>(item.fsm_feestype == 6 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2)))
      if(fee_main_srefu.length > 1){
        let main_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 1);
        let branch_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 2);
        this.main_srefu = main_srefu_ar[0]?.fsm_fee;
        this.branch_srefu = branch_srefu_ar[0]?.fsm_fee;
      }else if(fee_main_srefu.length == 1){
        let main_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 3);
        this.main_srefu = main_srefu_ar[0]?.fsm_fee;
        this.branch_srefu = main_srefu_ar[0]?.fsm_fee;
      }

      let royal = this.feedetails.filter((item)=>(item.fsm_feestype == 3))
      if(royal.length >= 1){
        this.isroyal = "1";
        this.royal = royal[0]?.fsm_fee;
      }
    })
  }

  getsubcourselist(limit,index,searchkey,sorting=null){
    this.tblplaceholder = true;
    this.services.getsubcourselist(this.smstid, limit,index,searchkey,sorting).subscribe(res=>{
      this.tblplaceholder = false;
      this.subcourselist = res.data.data.courses;
      this.subcourselist_length = res.data.data.totalcount;
      console.log('this.subcourselist_length', this.subcourselist_length);
      this.dataSource = new MatTableDataSource<SubcategoryDetails>(this.subcourselist);
      this.dataSource.sort = this.sort;
    })
  }

  addsubcourse() {
    this.router.navigate(['/standardcourseconfiguration/subcategorys/add/1/'+ this.smstid]);
  }

  viewsubcourse(id) {
    this.router.navigate(['/standardcourseconfiguration/subcategory/view/3/'+ id]);
  }

  editsubcourse(id) {
    this.router.navigate(['/standardcourseconfiguration/subcategory/edit/2/'+ id]);
  }

  getprereqlist(){
    this.services.getprereqlist(this.smstid).subscribe(res=>{
      this.subcategorylist = res.data.data;
      console.log('sadfdf', this.subcategorylist);
    })
  }

  changestatus(id, status){
    let msg  = '';
    if(status == 1){
      msg = 'Are you sure, you want to  Activate this sub course?'
    }else{
      msg = 'Are you sure, you want to Suspend this sub course?'
    }
    swal({
      title: msg,
      // text: 'You can still recover the file from the JSRS drive.',
      icon: "warning",
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      // className: "swal-delete",
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willGoBack) => {
      if(willGoBack){
        this.services.changesubcoursestatus(id, status).subscribe(res=>{
          this.toastr.success(this.i18n('Status updated Successfully'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.getsubcourselist(this.page, this.index, this.filterdata);
        })
      }
    });
  }

  sorting(event,key){
    console.log(event)
    console.log(key)
    var sorting = {
      'dir':event.direction,
      'key':event.active
    }
   
    //setTimeout(() => {
      this.getsubcourselist(this.page,this.index, this.filterdata, sorting);
 
   // }, 2000);
 
  }

}
