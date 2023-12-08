import { Component, ElementRef, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ApplicationService } from '@app/services/application.service';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import moment from 'moment';
import { ActivatedRoute } from '@angular/router';

import * as XLSX from 'xlsx';
import { environment } from '@env/environment';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { data } from 'jquery';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
import { MatSort, Sort } from '@angular/material/sort';

export interface BranchData {
  applictionno: any;
  offictype: any;
  trainprovname: any;
  branchname: any;
  sitelocan: any;
  coursetype: any;
  coursetitle: any;
  coursecate: any;
  coursesubcate: any;
  applytype: any;
  position: any;
  applicationstatus: any;
  certification: any;
  addedon: any;
  dateofexpiry: any;
  lastUpdated: any;
}
const BranchList_Data: BranchData[] = [
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', trainprovname: 'knowledge grid academy', branchname: 'Direct Contract', sitelocan: 'Site location', coursetype: 'Standard course', coursetitle: 'Career GuidanceBooklet', coursecate: 'Technical', coursesubcate: 'First Aid', applytype: '2', applicationstatus: '1', certification: '1', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', trainprovname: 'knowledge grid academy', branchname: 'Direct Contract', sitelocan: 'Site location', coursetype: 'Standard course', coursetitle: 'Career GuidanceBooklet', coursecate: 'Technical', coursesubcate: 'First Aid', applytype: '3', applicationstatus: '2', certification: '2', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', trainprovname: 'knowledge grid academy', branchname: 'Direct Contract', sitelocan: 'Site location', coursetype: 'Standard course', coursetitle: 'Career GuidanceBooklet', coursecate: 'Technical', coursesubcate: 'First Aid', applytype: '1', applicationstatus: '3', certification: '3', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', trainprovname: 'knowledge grid academy', branchname: 'Direct Contract', sitelocan: 'Site location', coursetype: 'Standard course', coursetitle: 'Career GuidanceBooklet', coursecate: 'Technical', coursesubcate: 'First Aid', applytype: '2', applicationstatus: '4', certification: '1', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', trainprovname: 'knowledge grid academy', branchname: 'Direct Contract', sitelocan: 'Site location', coursetype: 'Standard course', coursetitle: 'Career GuidanceBooklet', coursecate: 'Technical', coursesubcate: 'First Aid', applytype: '3', applicationstatus: '5', certification: '2', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
  { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', trainprovname: 'knowledge grid academy', branchname: 'Direct Contract', sitelocan: 'Site location', coursetype: 'Standard course', coursetitle: 'Career GuidanceBooklet', coursecate: 'Technical', coursesubcate: 'First Aid', applytype: '1', applicationstatus: '6', certification: '1', dateofexpiry: '23-04-2024', addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
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
  selector: 'app-approvaldetails',
  templateUrl: './approvaldetails.component.html',
  styleUrls: ['./approvaldetails.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class ApprovaldetailsComponent implements OnInit {
  filterDataPage: any = { sort: 'asc', order: '' };
  applictionno: any;
  stktype: any;
  isfocalpoint: any;
  useraccess: any;
  isUserHaveAccess: boolean=false;
  accessRights: any = {};
  isUserViewAcccess: boolean = false;
  desktopfilter:any= '';
  userpk: any;
  search: { appl_form: any; trainingprovider: any; officetype: any; branch: any; cour_type: any; course_title: any; course_cat: any; cour_subcate: any; appl_type: any; appdt_status: any; cert_status: any; site_audit_filter: any; date_expiry_filter: any; addedon_branch_filter: any; lastUpdated_branch_filter: any; };
  roleaccess: boolean = false;
  memReg: any;
  regpk: any;
  userPk: any;
  role: any;
  accesssuperadmin: any;


  i18n(key) {
    return this.translate.instant(key);
  }


  coursesubcategory: [];

  appl_form_filter = new FormControl('');
  officetype_filter = new FormControl('');
  trainingprovide_filter = new FormControl('');
  branch_filter = new FormControl('');
  cour_type_filter = new FormControl('');
  course_titles_filter = new FormControl('');
  course_cat_filter = new FormControl('');
  cour_subcate_filter = new FormControl('');
  appl_type_filter = new FormControl('');
  appl_status_filter = new FormControl('');
  cert_status_filter = new FormControl('');
  site_audit_filter = new FormControl('');
  date_expiry_filter = new FormControl('');
  addedon_branch_filter = new FormControl('');
  lastUpdated_branch_filter = new FormControl('');
  exportlink:string;

  public filterValues = {
    appl_form: '',
    officetype: '',
    trainingprovider: '',
    branch: '',
    cour_type: '',
    course_title: '',
    course_cat: '',
    cour_subcate: '',
    appl_type: '',
    appl_status: '',
    cert_status: '',
    addedon_branch:'',
    date_expiry:'',
    lastUpdated_branch:'',


  };

  category_remove: [];

  responsedasta: any;
  approvalaccess: boolean = false;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;

  resultsLength1: number = 0;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page: number = 10;
  disableSubmitButton:boolean = false;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;

  @ViewChild("paginator") paginator: MatPaginator;
  BranchListData = ['applictionno', 'trainprovname', 'offictype', 'branchname', 'sitelocan', 'coursetype', 'coursetitle', 'coursecate', 'coursesubcate', 'applytype', 'applicationstatus', 'certification', 'siteaudit' , 'dateofexpiry', 'addedon', 'lastUpdated', 'action'];

  TrainingBranchData = new MatTableDataSource();

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
     private appservice: ApplicationService,
      private route: Router, 
      private security: Encrypt,
    private activatedRoute: ActivatedRoute,public toastr: ToastrService,

      private localstorage:AppLocalStorageServices) {

  }
  ifarabic: boolean = false;
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
  active:boolean= false;
decline:boolean= false;
new:boolean = false;
@ViewChild ('TABLE')tables:ElementRef;
tblplaceholder: boolean = false;
  ngOnInit(): void {

    
    
        
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.userpk = this.localstorage.getInLocal('opalusermst_pk');
    this.useraccess = this.localstorage.getInLocal('uerpermission');    
    // console.log(this.useraccess,this.isfocalpoint,this.stktype);

      if(this.isfocalpoint==2){
        let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
        if(this.useraccess[moduleid][11] && this.useraccess[moduleid][11].approval == 'Y'){
          this.isUserHaveAccess = true;
        }
      }

      if(this.isfocalpoint==1){
        this.isUserViewAcccess = true;
      }

      this.memReg = this.localstorage.getInLocal('reg_pk');
      this.regpk = this.localstorage.getInLocal('registerPk');
      this.userPk = this.localstorage.getInLocal('userPk');
      this.stktype = this.localstorage.getInLocal('stktype');
      this.role = this.localstorage.getInLocal('role');
      this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      if(this.isfocalpoint == 1){
        this.approvalaccess = true;
        this.downloadaccess = true;
        this.readaccess = true;
        this.createaccess = true;
        this.updateaccess = true;
      }
      if(this.isfocalpoint == 2){
        let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
        if(this.useraccess[moduleid]  && this.useraccess[moduleid][11]?.submodules == 'Standard & Customized Course Approval' && this.useraccess[moduleid][11].approval == 'Y'){
          this.approvalaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][11]?.submodules == 'Standard & Customized Course Approval' && this.useraccess[moduleid][11].download == 'Y'){
          this.downloadaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][11]?.submodules == 'Standard & Customized Course Approval' && this.useraccess[moduleid][11].read == 'Y'){
          this.readaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][11]?.submodules == 'Standard & Customized Course Approval' && this.useraccess[moduleid][11].create == 'Y'){
          this.createaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][11]?.submodules == 'Standard & Customized Course Approval' && this.useraccess[moduleid][11].update == 'Y'){
          this.updateaccess = true;
        }
       }
       
      this.appservice.roleaccess().subscribe(response => {
        if(response.status == 200){
         this.roleaccess =response.data.admin;
         console.log( this.roleaccess  , 'roleaccess');
         this.accesssuperadmin = response.data.superadmin;
        }
      });
     
    this.disableSubmitButton = true;
    this.activatedRoute.queryParams.subscribe((params) => {
      if(params['desktopfilter'])
     {
   this.desktopfilter = params['desktopfilter'];
   if(this.desktopfilter == '2,4,20'){
    this.appl_status_filter.setValue(['2,4']);
   }else if(this.desktopfilter == '6'){
    this.appl_status_filter.setValue(['6']);
   }else if(this.desktopfilter == '9,13'){
    this.appl_status_filter.setValue(['9','13']);
   }else if(this.desktopfilter == '10,11,12,14,15,16'){
    this.appl_status_filter.setValue(['10,14','11,15']);
   }

     }
     else{
   this.desktopfilter = '';

     }
      
    })
    this.getapprovalgriddata(10,0,null)
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
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
          this.filtername = "Hide Filter";

        }
        else {
          this.ifarabic = true;
          
          this.filtername = "إخفاء التصفية";

        }

      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      }
    });


      this.getapprovalsitedata()


  }

   // For sorting
   announceSortChange(sortState: Sort) {
    this.filterDataPage = {
      sortFiled: sortState.direction,
      order: sortState.active
    }
  
    this.getapprovalgriddata(this.paginator.pageSize, this.paginator.pageIndex, this.search); 


  }
getapprovalgriddata(limit, page, searchkey){
  // this.disableSubmitButton = true;
  this.tblplaceholder = true;
  this.appservice.getsccatabledata(this.desktopfilter,limit,page,searchkey , this.filterDataPage).subscribe(response => {
    if(response.status == 200){
    this.disableSubmitButton = false;
    this.responsedasta = response.data;
    this.TrainingBranchData = new MatTableDataSource<BranchData>(response.data.arr);
    this.tblplaceholder = false;
    this.resultsLength1 = response.data.totalcount;
    setTimeout(() => {
      this.tblplaceholder = false;
    }, 500);

    }
  });
}

  getapprovalsitedata() {
    this.appservice.getapprovalsitedata('1').subscribe((res:any) => {
      if(res['data']['data']) {
        this.accessRights = res['data']['data'];
        if(this.readaccess == false || this.accessRights.accessproject == false){

          swal({
            title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
            text: '',
            icon: 'warning',
            buttons: [false,this.i18n('Ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              this.route.navigate(['/dashboard/portaladmin'])        
            }
          });
        }
      }
      
    })
  }



  
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('staff.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('staff.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  applyFilter(serch, key) {
   this.search = {
       appl_form: this.appl_form_filter.value,
       trainingprovider:this.trainingprovide_filter.value,
       officetype:this.officetype_filter.value,
       branch:this.branch_filter.value,
       cour_type:this.cour_type_filter.value,
       course_title:this.course_titles_filter.value,
       course_cat:this.course_cat_filter.value,
       cour_subcate:this.cour_subcate_filter.value,
       appl_type:this.appl_type_filter.value,
       appdt_status:this.appl_status_filter.value,
       cert_status:this.cert_status_filter.value,
       site_audit_filter:this.site_audit_filter.value,
       date_expiry_filter:this.date_expiry_filter.value,
       addedon_branch_filter:this.addedon_branch_filter.value,
       lastUpdated_branch_filter:this.lastUpdated_branch_filter.value
      };
   // if(serch){
    this.getapprovalgriddata(this.paginator.pageSize, this.paginator.pageIndex, this.search); 
   // }
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getapprovalgriddata(this.paginator.pageSize, this.paginator.pageIndex,  this.search)

    // this.paginator.page.emit(event)
  }
  goToDesktopview(appdt) {
    this.route.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: this.security.encrypt(appdt.applicationdtlstmp_pk), app_ref_id: appdt.applictionno } });
  }

  goToviewsiteaudit(id) {
    this.disableSubmitButton = true;
    this.route.navigate(['/standardcourseapproval/siteaudit'],{ queryParams: { id: this.security.encrypt(id)}});
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  splitFunction(data) {

    this.coursesubcategory = data.split('**');

    this.category_remove = data.split('**');

    this.category_remove.shift();



  }

  cecrtifistat(e) {
      if(e == '' || e == null) {
        this.active= false;
        this.decline = false;
        this.new = true;
      } else if(e != '' || e != null) {
        this.new = false;
        const currdate = new Date();
        const expiry_date = new Date(e);
      if(currdate <= expiry_date) {
        this.active= true;
        this.decline = false;
      } else if(currdate > expiry_date) {
        this.active= false;
        this.decline = true;
      } else {
        this.active= false;
        this.decline = false;
        this.new = true;
      }
    }
  }



  applyaddondateFilter(dateVal)
  {
    if(dateVal._isValid){
      dateVal = moment(dateVal).format('DD-MM-YYYY').toString();
      console.log("add"+dateVal);
      this.filterValues.addedon_branch = dateVal.toString().trim().toLowerCase();
      this.TrainingBranchData.filter = JSON.stringify(this.filterValues);
    }
    else{
      this.filterValues.addedon_branch = '';
      this.TrainingBranchData.filter = JSON.stringify(this.filterValues);
    }
     
  }

  applydateofeoxdateFilter(dateVal)
  {
    console.log("isoosoosososo");
    if(dateVal._isValid){
      dateVal = moment(dateVal).format('DD-MM-YYYY').toString();
      this.filterValues.date_expiry = dateVal.toString().trim().toLowerCase();
      this.TrainingBranchData.filter = JSON.stringify(this.filterValues);
    }
    else{
      this.filterValues.date_expiry = '';
      this.TrainingBranchData.filter = JSON.stringify(this.filterValues);
    }
  }


  applylastupdateFilter(dateVal)
  {
    if(dateVal._isValid){
      dateVal = moment(dateVal).format('DD-MM-YYYY').toString();
      this.filterValues.lastUpdated_branch = dateVal.toString().trim().toLowerCase();
      this.TrainingBranchData.filter = JSON.stringify(this.filterValues);
    }
    else{
      this.filterValues.lastUpdated_branch = '';
      this.TrainingBranchData.filter = JSON.stringify(this.filterValues);
    }
  }

  saveexportdet(){
    this.disableSubmitButton = true;
    console.log(environment.baseUrl + 'center/app-center/coursedownloadlist');
    var a = JSON.stringify(this.search)
    this.exportlink =  environment.baseUrl + 'center/app-center/coursedownloadlist?search='+a;
      window.open(this.exportlink,'_self');
      setTimeout(() => {
       this.disableSubmitButton = false;
      }, 1000);
    }
    public scrollTo(className: string): void {
      try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth' });
        console.log(123)
      } catch (error) {
        console.log('page-content')
      }
    }
    clearFilter() {
      // this.route.navigate(['/standardcourseapproval/approvaldetails']);
      // setTimeout(() => {
      //   window.location.reload();

      // }, 1000);
      this.desktopfilter = '';
      if(this.appl_form_filter.value){
        this.appl_form_filter.setValue("");
      }
      if(this.trainingprovide_filter.value){
      this.trainingprovide_filter.setValue("");
      }
      if(this.officetype_filter.value){
      this.officetype_filter.setValue("");
      }
      if(this.branch_filter.value){
      this.branch_filter.setValue("");
      }
      if(this.cour_type_filter.value){
      this.cour_type_filter.setValue("");
      }
      if(this.course_titles_filter.value){
      this.course_titles_filter.setValue("");
      }
      if(this.course_cat_filter.value){
      this.course_cat_filter.setValue("");
      }
      if(this.cour_subcate_filter.value){
      this.cour_subcate_filter.setValue("");
      }
      if(this.appl_type_filter.value){
      this.appl_type_filter.setValue("");
      }
      if(this.appl_status_filter.value){
      this.appl_status_filter.setValue("");
      }
      if(this.cert_status_filter.value){
      this.cert_status_filter.setValue("");
      }
      if(this.site_audit_filter.value){
      this.site_audit_filter.setValue("");
      }
      if(this.date_expiry_filter.value){
      this.date_expiry_filter.setValue("");
      }
      if(this.addedon_branch_filter.value){
      this.addedon_branch_filter.setValue("");
      }
      if(this.lastUpdated_branch_filter.value){
      this.lastUpdated_branch_filter.setValue("");
      }
      // this.search.appl_form = '';
      // this.search.trainingprovider = '';
      // this.search.officetype = '';
      // this.search.branch = '';
      // this.search.cour_type = '';
      // this.search.course_title = '';
      // this.search.course_cat = '';
      // this.search.appl_type = '';
      // this.search.appdt_status = '';
      // this.search.site_audit_filter = '';
      // this.search. date_expiry_filter = '';
      // this.search.addedon_branch_filter = '';
      // this.search.lastUpdated_branch_filter = '';
      this.getapprovalgriddata(this.paginator.pageSize, this.paginator.pageIndex, null); 

     
    }
    suspend(data){
      swal({
        title: 'Do you want to confirm suspend the '+data.coursetitle+' Course Certification of '+data.omrm_companyname_en+'?',
        text: '',
        icon: 'warning',
        buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          this.appservice.suspend(data.applicationdtlstmp_pk).subscribe(res => {
            if(res.status == 200){
              this.disableSubmitButton = false;
              this.toastr.success('The Course Certification has been Suspended.', ''), {
                timeOut: 2000,
                closeButton: false,
              };
              this.ngOnInit();
            }
          });

         

        }
      })

    }
    activate(data){
      swal({
        title: 'Do you want to confirm Activate the '+data.coursetitle+' Course Certification of '+data.omrm_companyname_en+'?',
        text: '',
        icon: 'warning',
        buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          this.appservice.activate(data.applicationdtlstmp_pk).subscribe(res => {
            if(res.status == 200){
              this.disableSubmitButton = false;
              this.toastr.success('The Course Certification has been Re-activated.', ''), {
                timeOut: 2000,
                closeButton: false,
              };
              this.ngOnInit();
            }
          });

         

        }
      })

    }
    navigateAuditlog(id){
      // this.route.navigateByUrl('/centrecertification/schedulesiteaudit?id='+this.security.encrypt(2));
      if(id==2) {
        this.route.navigate(['/centrecertification/schedulesiteaudit/stand'],{ queryParams: { id: this.security.encrypt(id) }});
      }else if(id==3) {
        this.route.navigate(['/centrecertification/schedulesiteaudit/cour'],{ queryParams: { id: this.security.encrypt(id) }});
      }
    }
    siteauditapproval(appid)
    {

      this.appservice.getappapprovalhrd(this.security.encrypt(appid),this.security.encrypt('9')).subscribe((res:any) => {
        console.log(res);
      })
    this.route.navigate(['standardcourseapproval/siteaudit'], { queryParams: { id: this.security.encrypt(appid) } });
      
    }
    siteaudit(appid)
    {

    this.route.navigate(['standardcourseapproval/siteaudit'], { queryParams: { id: this.security.encrypt(appid) } });
      
    }
    viewsiteaudit(appid) {
      this.route.navigate(['standardcourseapproval/siteaudit'], { queryParams: { id: this.security.encrypt(appid) } });
    }
    viewinvoice(appdt)
    
    {
      
      this.route.navigate(['/paymentinvoiceindex/invoicestand'],{ queryParams: { id: this.security.encrypt(appdt) }});

    }

    paymentdetails(appdt)
    {
      console.log(appdt)
    
      this.route.navigate(['/paymentinvoiceindex/invoiceconfirm'],{ queryParams: { id: this.security.encrypt(appdt)}});

    }

    auditlog(appdt)
    {
      
      this.route.navigate(['/centrecertification/auditlog']);
      
    }

    opencertificate(url){
      this.disableSubmitButton = true;
      window.open(environment.baseUrl + url, "_blank");
      setTimeout(() => {
        this.disableSubmitButton = false;
        },2000);
    }


    viewcourse(data , type)
    {
      this.route.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: this.security.encrypt(data.applicationdtlstmp_pk), app_ref_id: data.applictionno,view: 'viewcourse',type:type } } );
    }
}

