import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';

import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort,Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import swal from 'sweetalert';
import { Router, ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatCheckbox } from '@angular/material/checkbox';
import { GradeConfigurationService } from '@app/services/grade-configuration.service';

export interface GradeDetails {
  grade: any;
  grade_ar: any;
  percentageFromTotalValue: any;
  fromPercentage: any;
  toPercentage: any;
  lastUpdatedOn: any;
  lastUpdatedBy: any;
}
const FILTERDATA = {
  grade: '',
  percentageFromTotalValue: '',
  fromPercentager:'',
  toPercentage: '',
  lastUpdatedOn : '',  
  lastUpdatedBy : ''
}

@Component({
  selector: 'app-viewlog',
  templateUrl: './viewlog.component.html',
  styleUrls: ['./viewlog.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class ViewlogComponent implements OnInit {
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
  page: number = 10;
  filterdata : {  
    grade: any;
    percentageFromTotalValue: any;
    fromPercentage: any;
    toPercentage: any;
    lastUpdatedOn: any;
    lastUpdatedBy: any;  };

  index = 0;
  dataSource : MatTableDataSource<GradeDetails>;
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

  mockData =[{grade:'Bronze', percentageFromTotalValue:50, fromPercentage:50, toPercentage:74,lastUpdatedOn:'July 2023',lastUpdatedBy:'Clare'},
  {grade:'Silver', percentageFromTotalValue:75, fromPercentage:75, toPercentage:84,lastUpdatedOn:'July 2023',lastUpdatedBy:'Clare'}]
  //displayedColumns = ['course_Title', 'assessment_In','request_For', 'course_Level','course_Category','course_Sub_Category', 'status', 'created_On', 'created_By','last_Updated_On','last_Updated_By', 'action'];
  displayedColumns = [  
    { def: "grade",search: "row-one", label: "Grade", visible: true,disabled: false },
    { def: "percentageFromTotalValue",search: "row-two", label: "Percentage from Total Value", visible: true ,disabled: false},
    { def: "fromPercentage",search: "row-three", label: "From Percentage", visible: true,disabled: false },
    { def: "toPercentage",search: "row-four", label: "To Percentage", visible: true,disabled: false },
    { def: "lastUpdatedOn",search: "row-five", label: "Last Update on", visible: true,disabled: false },
    { def: "lastUpdatedBy",search: "row-six", label: "Last Updated By", visible: true ,disabled: false},
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
    
    grade= new FormControl('');
    percentageFromTotalValue= new FormControl('');
    fromPercentage= new FormControl('');
    toPercentage= new FormControl('');
  lastUpdatedOn = new FormControl('')
  lastUpdatedBy = new FormControl('')
  gradelog;
  gradelog_length;
  gradeid;

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
    protected security: Encrypt,
    public routeid: ActivatedRoute,
    private service: GradeConfigurationService) {
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
      this.viewacess = true;
      this.updateaccess = true;
    };
    console.log('this.isfocalpoint', this.isfocalpoint);
    console.log('this.stktype', this.stktype);
    console.log('this.useraccess', this.useraccess);
    //let moduleid = this.useraccess.filter(item => item.modules == "Learner Card Log");
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Configuration');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][35] && this.useraccess[moduleid][35].read == 'Y'){
      this.viewacess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][35] && this.useraccess[moduleid][35].update == 'Y'){
      this.updateaccess = true;
    }

    if (!this.viewacess) {
      swal({
        title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (this.stktype == 1) {
            this.router.navigate(['dashboard/portaladmin']);
          }
          else {
            this.router.navigate(['dashboard/centre']);
          }
        }

      });

    }else{

      this.gradeid = this.routeid.snapshot.paramMap.get('id');
      
      this.getgradelogs(this.gradeid);
    }
    // this.dataSource = new MatTableDataSource<GradeDetails>(this.mockData);
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
      this.paginator.pageSize = 10;
    }
    this.refresh = true;
    this.grade.reset();
    this.percentageFromTotalValue.reset();
    this.fromPercentage.reset();
    this.toPercentage.reset();
    this.lastUpdatedOn.reset();
    this.lastUpdatedBy.reset();
    this.filterdata = { 
      grade: '',
    percentageFromTotalValue: '',
    fromPercentage:'',
    toPercentage: '',
    lastUpdatedOn : '',  
    lastUpdatedBy : '' };      
    this.dataSource = new MatTableDataSource<GradeDetails>([]);
    this.tblplaceholder = false;
    
    this.gradelog_length = 0;
    //this.getlearnercard(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
    
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    //this.getlearnercard(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
  }

  getgradelogs(id, sorting = null){
    this.tblplaceholder = true;
    this.service.getgradelog(id, sorting).subscribe(res=>{
      let data = res.data.data;
      this.gradelog = data
      this.gradelog_length = data.length;
      this.dataSource = new MatTableDataSource<GradeDetails>(data);
      this.dataSource.sort = this.sort;
      this.tblplaceholder = false;
    })

  }

  sorting(event,key){
    console.log(event)
    console.log(key)
    var sorting = {
      'dir':event.direction,
      'key':event.active
    }
   
    //setTimeout(() => {
      this.getgradelogs(this.gradeid,sorting);
 
   // }, 2000);
 
  }

}
