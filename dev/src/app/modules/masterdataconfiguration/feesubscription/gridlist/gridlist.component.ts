import { Component, ElementRef, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl} from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort,Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import moment from 'moment';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatCheckbox } from '@angular/material/checkbox';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { MasterDataConfigurationService } from '@app/services/master-data-configuration.services';

export interface feedetails {
  project_en: any;
  officetype: any;
  feetype: any;
  applicanttype: any;
  headcount: any;
  fee: any;
  validity: any;
  status: any;
  createdOn: any;
  createdBy: any;
  lastUpdatedOn: any;
  lastUpdatedBy: any;
}
const FILTERDATA = {
  project : [],
  officetype : [],
  feetype : [],
  applicanttype : [],
  fee : '',
  validity : '',
  status : [],
  createdOn : [],
  createdBy : '',
  lastUpdatedOn : [],  
  lastUpdatedBy : ''
}

@Component({
  selector: 'app-gridlist',
  templateUrl: './gridlist.component.html',
  styleUrls: ['./gridlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class GridlistComponent implements OnInit {
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
    project : any,
    officetype : any,
    feetype : any,
    applicanttype : any,
    fee : any,
    validity : any,
    status : any,
    createdOn : any,
    createdBy : any,
    lastUpdatedOn : any,  
    lastUpdatedBy : any, 
 };
 status1;
  index = 0;
  dataSource : MatTableDataSource<feedetails>;
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;
  downloadaccess = false;

  mockData =[{project_en:'Traning Evaluation Centre Certification', officetype:'Main Office', feetype:'Certification Fee', 
  applicanttype:'Initial', headcount:'1', fee:'300', validity:'1',status:'Active', createdOn:'28-09-2023',
  createdBy:'Thomas',lastUpdatedOn:'28-09-2023',lastUpdatedBy:'Clare'}]
  displayedColumns = [  
    { def: "project",search: "row-one", label: "Project", visible: true,disabled: false },
    { def: "officetype",search: "row-two", label: "Office Type", visible: true ,disabled: false},
    { def: "feetype",search: "row-three", label: "Fee Type", visible: true,disabled: false },
    { def: "applicanttype",search: "row-four", label: "Applicant Type", visible: true,disabled: false },
    { def: "headcount",search: "row-thirteen", label: "Head Count and Type", visible: false,disabled: false },
    { def: "fee",search: "row-five", label: "Fee (OMR)", visible: true,disabled: false },
    { def: "validity",search: "row-six", label: "Validity", visible: true,disabled: false },
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

  project = new FormControl('');
  officetype = new FormControl('');
  feetype = new FormControl('');
  applicanttype = new FormControl('');
  fee = new FormControl('');
  validity = new FormControl('');
  status = new FormControl('');
  createdOn = new FormControl('');
  createdBy = new FormControl('');
  lastUpdatedOn = new FormControl('')
  lastUpdatedBy = new FormControl('')
  feelist = [];
  feelist_length;
  apptypelist;
  app_remove;
  projectlist;


  constructor( private fb: FormBuilder,
    public router: Router,
    private translate: TranslateService, 
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService, 
    private service: MasterDataConfigurationService,
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

   

    if(this.isfocalpoint == 1 && this.stktype == 1){
      this.createaccess = true;
      this.viewacess = true;
      this.updateaccess = true;
    };
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Master Data Configuration');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][41] && this.useraccess[moduleid][41].read == 'Y'){
      this.viewacess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][41] && this.useraccess[moduleid][41].update == 'Y'){
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
       //this.dataSource = new MatTableDataSource<feedetails>(this.mockData);
      this.getfeeslist(this.page,this.index, this.filterdata);
      this.getinitialdata();
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
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
    
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
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getfeeslist(this.page, this.index, this.filterdata)
  }

  serachdate(event, formcontrolname) {
    var expirydate;
    if (event.startDate) {
      expirydate = {
        start: moment(event.startDate._d).format('YYYY-MM-DD'),
        end: moment(event.endDate._d).format('YYYY-MM-DD')
      };
    }
    else
    {
      expirydate  = [];
    }
    this.searchbatchgrid(expirydate,formcontrolname);
    // this.getfeeslist(this.page,this.index, this.filterdata)
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
    this.project.reset();
    this.officetype.reset();
    this.feetype.reset();
    this.applicanttype.reset();
    this.fee.reset();
    this.validity.reset();
    this.status.reset();
    this.createdOn.reset();
    this.createdBy.reset();
    this.lastUpdatedOn.reset();
    this.lastUpdatedBy.reset();
    this.filterdata = { 
      project : [],
      officetype : [],
      feetype : [],
      applicanttype : [],
      fee : '',
      validity : '',
      status : '',
      createdOn : '',
      createdBy : '',
      lastUpdatedOn : '',  
      lastUpdatedBy : '',   
    };      
    $(".clear").trigger("click");
    this.dataSource = new MatTableDataSource<feedetails>([]);
    this.tblplaceholder = false;
    this.feelist_length = 0;
    this.getfeeslist(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
      
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getfeeslist(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
  }


  edit(id) {
    this.router.navigate(['/configuration/masterdataconfiguration/feesubscribtion/edit/'+id]);
  }


  getfeeslist(limit,index,searchkey, sorting = null){
    this.tblplaceholder = true;
    this.service.getfeeslist(limit,index,searchkey, sorting).subscribe(res=>{
      this.tblplaceholder = false;
      this.feelist = res.data.data.fee;
      this.feelist_length = res.data.data.totalcount;  
      this.dataSource = new MatTableDataSource<feedetails>(this.feelist);
      this.dataSource.sort = this.sort;
      console.log('dsfsdfd',res);
    })
  }



  getinitialdata(){
    this.service.getProject().subscribe(res=>{
      let data = res.data;
      this.projectlist = data;
      console.log('this.projectlist', this.projectlist);
      
    })
  }




  sorting(event,key){
    console.log(event)
    console.log(key)
    var sorting = {
      'dir':event.direction,
      'key':event.active
    }
   
    this.getfeeslist(this.page,this.index, this.filterdata, sorting);
 
 
  }

}
