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
import { Router, ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { environment } from '@env/environment';
import { LearnerCardService } from '@app/services/learnerCard.service';
import { StandardCourseConfigurationService } from '@app/services/standard-course-configuration.services';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { E } from '@angular/cdk/keycodes';
import { MatCheckbox } from '@angular/material/checkbox';

export interface StandardCourseDetails {
  coursetitle: any;
  assessmentin: any;
  requestfor: any;
  courselevel: any;
  coursecategory: any;
  coursesubcategory: any;
  status: any;
  createdOn: any;
  createdBy: any;
  lastUpdatedOn: any;
  lastUpdatedBy: any;
}
const FILTERDATA = {
  courseTitle : '',
  assessmentIn : [],
  requestFor : '',
  courseLevel : [],
  courseCategory : [],
  courseSubcategory : [],
  status : [],
  createdOn : [],
  createdBy : [],
  lastUpdatedOn : [],  
  lastUpdatedBy : []
}

@Component({
  selector: 'app-sccgridlist',
  templateUrl: './sccgridlist.component.html',
  styleUrls: ['./sccgridlist.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class SccgridlistComponent implements OnInit {
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
  filterdata : {  
  courseTitle : any,
  assessmentIn : any,
  requestFor : any,
  courseLevel : any,
  courseCategory : any,
  courseSubcategory : any,
  status : any,
  createdOn : any,
  createdBy : any,
  lastUpdatedOn : any,  lastUpdatedBy : any,  };

  index = 0;
  dataSource : MatTableDataSource<StandardCourseDetails>;
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

  // mockData =[{coursetitle:'Web Developement Program', assessmentin:'Program', requestfor:'Module', 
  // courselevel:'Experienced', coursecategory:'Development', coursesubcategory:'Frontend',status:'Wailtlist', createdOn:'July 2023',
  // createdBy:'Thomas',lastUpdatedOn:'July 2023',lastUpdatedBy:'Clare'}]
  //displayedColumns = ['course_Title', 'assessment_In','request_For', 'course_Level','course_Category','course_Sub_Category', 'status', 'created_On', 'created_By','last_Updated_On','last_Updated_By', 'action'];
  displayedColumns = [  
    { def: "courseTitle",search: "row-one", label: "Course Title", visible: true,disabled: false },
    { def: "assessmentIn",search: "row-two", label: "Assessment in", visible: true ,disabled: false},
    { def: "requestFor",search: "row-three", label: "Request For", visible: false,disabled: false },
    { def: "courseLevel",search: "row-four", label: "Course Level", visible: false,disabled: false },
    { def: "courseCategory",search: "row-five", label: "Course Category", visible: false,disabled: false },
    { def: "courseSubcategory",search: "row-six", label: "Course Sub Category", visible: true,disabled: false },
    { def: "status",search: "row-seven", label: "Status", visible: true,disabled: false },
    { def: "createdOn",search: "row-eight", label: "Created On", visible: false ,disabled: false},
    { def: "createdBy",search: "row-nine", label: "Created By", visible: false,disabled: false },
    { def: "lastUpdatedOn",search: "row-ten", label: "Last Updated On", visible: false ,disabled: false},
    { def: "lastUpdatedBy",search: "row-eleven", label: "Last Updated By", visible: false ,disabled: false},
    { def: "action",search: "row-twelve", label: "Action", visible: true,disabled: false },
  ];
  

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
  courselist = [];
  courselist_length : number;
  courseTitle = new FormControl('');
  assessmentIn = new FormControl('');
  requestFor = new FormControl('');
  courseLevel = new FormControl('');
  courseCategory = new FormControl('');
  courseSubcategory = new FormControl('');
  status = new FormControl('');
  createdOn = new FormControl('');
  createdBy = new FormControl('');
  lastUpdatedOn = new FormControl('')
  lastUpdatedBy = new FormControl('')
  coursesubcategorylist = [];
  category_remove;
  assessmentinlist = [];
  requestforlist = [];
  courselevellist = [];
  coursecategorylist = [];
  coursecategory_search;
  subcoursecategory_search;
  courselevel_search;
  subcategotylist  = [];
  reqlist = [];
  req_remove;
  status1;


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
    private sccservice: StandardCourseConfigurationService,
    protected security: Encrypt) {
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

    this.getcourse(this.page,this.index, this.filterdata);
    this.getinitialdata();

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
      this.filtername = this.ifarbic ? 'إظهار عامل التصفية' : 'Show Filter';
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.ifarbic ? 'إخفاء التصفية' : 'Hide Filter';
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
    this.getcourse(this.page, this.index, this.filterdata)
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
    this.courseTitle.reset();
    this.assessmentIn.reset();
    this.requestFor.reset();
    this.courseLevel.reset();
    this.courseCategory.reset();
    this.courseSubcategory.reset();
    this.status.reset();
    this.createdOn.reset();
    this.createdBy.reset();
    this.lastUpdatedOn.reset();
    this.lastUpdatedBy.reset();
    this.filterdata = { 
      courseTitle : '',
      assessmentIn : '',
      requestFor : '',
      courseLevel : '',
      courseCategory : '',
      courseSubcategory : '',
      status : '',
      createdOn : '',
      createdBy : '',
      lastUpdatedOn : '',  
      lastUpdatedBy : '',   
    };      
    this.dataSource = new MatTableDataSource<StandardCourseDetails>([]);
    this.tblplaceholder = false;
    this.courselist_length = 0;
    this.getcourse(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
      
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getcourse(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
  }

  addcourse() {
    this.router.navigate(['/standardcourseconfiguration/course/add']);
  }

  viewcourse(id) {
    this.router.navigate(['/standardcourseconfiguration/viewcourse/'+ id]);
  }

  editcourse(id) {
    this.router.navigate(['/standardcourseconfiguration/course/edit/'+ id]);
  }

  addsubcourse(id) {
    this.router.navigate(['/standardcourseconfiguration/subcategory/add/1/'+ id]);
  }

  documentreq(id) {
    this.router.navigate(['/standardcourseconfiguration/coursedocument/'+ id]);
  }

  getcourse(limit,index,searchkey, sorting = null){
    this.tblplaceholder = true;
    this.sccservice.getCourseList(limit,index,searchkey, sorting).subscribe(res=>{
      this.tblplaceholder = false;
      this.courselist = res.data.data.courses;
      this.courselist_length = res.data.data.totalcount;  
      this.dataSource = new MatTableDataSource<StandardCourseDetails>(this.courselist);
      this.dataSource.sort = this.sort;
      console.log('dsfsdfd',res);
    })
  }

  splitFunction(data) {
    this.coursesubcategorylist = data.split('**');
   // console.log('data', this.coursesubcategorylist);

    this.category_remove = data.split('**');

    this.category_remove.shift();

    return this.coursesubcategorylist[0];

  }

  splitFunctionreq(data) {
    this.reqlist = data.split('**');

    this.req_remove = data.split('**');

    this.req_remove.shift();

    return this.reqlist[0];

  }

  getinitialdata(){
    this.sccservice.getcourserelateddata().subscribe(res=>{
      console.log(res);
      let data = res.data.data;
      this.assessmentinlist = data.assessmentin;
      this.requestforlist = data.requestfor;
      this.courselevellist = data.courseLevel;
      this.coursecategorylist = data.coursecategory;
    })
    this.sccservice.getAllsubcourselist().subscribe(res=>{
      this.subcategotylist = res.data.data;
    })
  }

  changestatus(id, status){
    let msg  = '';
    if(status == 1){
      msg = 'Are you sure, you want to  activate this ?'
    }else{
      msg = 'Are you sure, you want to Suspend this ?'
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
        this.sccservice.changecoursestatus(id, status).subscribe(res=>{
          this.toastr.success(this.i18n('Status updated Successfully'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.getcourse(this.page,this.index, this.filterdata);
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
      this.getcourse(this.page,this.index, this.filterdata, sorting);
 
   // }, 2000);
 
  }

}
