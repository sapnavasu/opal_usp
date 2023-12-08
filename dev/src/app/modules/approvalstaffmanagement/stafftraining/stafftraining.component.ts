import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort, Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { MatSortModule } from '@angular/material/sort';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatCheckbox } from '@angular/material/checkbox';
import { TrainingStaffService } from '@app/services/trainingStaff.service';
import { MatDialog } from '@angular/material/dialog';
import { Datepickermodal } from '@app/@shared/datepickermodal/datepickermodal';

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
  trainigCentre_en: any;
  trainigCentre_ar: any;
  branchName_en: any;
  branchName_ar: any;
  state_ar: any;
  state_en: any;
  city_en: any;
  city_ar: any;
  sub_categories_ar: any;
  sub_categories_en: any;
  civil_number: any;
  staffName_en: any;
  staffName_ar: any;
  email_id: any;
  role_en: any;
  role_ar: any;
  language_en: any;
  language_ar: any;
  categories_en: any;
  categories_ar: any;
  competency_card: any;
  dateofexp: any;
  last_approved: any;
  account_status: any;
}

const FILTERDATA = {
  member_number: [],
  company_name: [],
  training_centre: [],
  officetype: [],
  branch_name: [],
  site_locaton: [],
  course: [],
  civil_number: [],
  staff_name: [],
  email_id: [],
  roLes: [],
  language: [],
  approvewilayat: [],
  course_sub: [],
  competency_card: [],
  dateofexp: [],
  last_approved: [],
  account_status: [],
  available_Date: []
}

@Component({
  selector: 'app-stafftraining',
  templateUrl: './stafftraining.component.html',
  styleUrls: ['./stafftraining.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class StafftrainingComponent implements OnInit {
  isData: boolean = false;
  filterDataPage: any = { sort: 'asc', order: '' };
  tblplaceholder: boolean = false;
  public PageLoaders: boolean = false;
  staffmanagement: any[] = [];
  staffremove: any;
  i18n(key) {
    return this.translate.instant(key);
  }

  filterdata: {
    member_number: [],
    company_name: [],
    training_centre: [],
    office_type: [],
    branch_name: [],
    site_locaton: [],
    course: [],
    civil_number: [],
    staff_name: [],
    email_id: [],
    roLes: [],
    language: [],
    approvewilayat: [],
    course_sub: [],
    competency_card: [],
    dateofexp: [],
    last_approved: [],
    account_status: [],
    available_Date: [],
  }

  public fullPageLoaders: boolean = false;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  public selectAllVisible: boolean;
  page: number = 10;
  dataSource = new MatTableDataSource<Element>();
  public availabledate: FormGroup;
  public clearClose: boolean = false;
  public subcategorylist: boolean = false;
  public categorylist: boolean = false;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  public regpk: any;
  public role: any;
  roles: any;
  rolearray: any;
  isStudentregStaff: boolean = false;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;
  displayedColumns  = [];

  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    public commonDialog: MatDialog,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService,
    private trainingstaff: TrainingStaffService,
    protected security: Encrypt,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();

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
  @ViewChild(MatSort) sort: MatSort;
  public ifarbic: boolean = false;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  
  openDatepickerDialog(civil:any,staffInfoTemp:any,staff:any,course:any,coursePk: any) {
    const dialogRef = this.commonDialog.open(Datepickermodal, {
      panelClass: 'availabiltyModel',
      data: {
        title: 'Select Date To Export Data',
        inputName: 'Folder Name',
        noButtonText: 'Cancel',
        submitButtonText: 'Export',
        civil: civil,
        staffInfoTemp: staffInfoTemp,
        staff: staff,
        course: course,
        coursePk: coursePk,
      }
    });
    dialogRef.afterClosed().subscribe(result => {
      this.fullPageLoaders = true;
      if(result?.civil){
        this.trainingstaff.exportSingle(result.civil, result.staffInfoTemp,result.dateRange,result.coursePk).subscribe((data: any) => {
          if(data.data.status == 3){
            swal({
              title: this.i18n("No records are available for download within the selected date range."),
              text: '',
              icon: 'warning',
              buttons: [false, this.i18n('Ok')],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            }).then((willGoBack) => {
              this.fullPageLoaders = false;
            });
            return false;
          }

        let response = data.data.attend;
        var link = document.createElement('a');
        link.href = response
        link.click();
        this.fullPageLoaders = false;
        })
      }else{
        this.fullPageLoaders = false;
      }
    });
  }

  ngOnInit(): void {


    this.role = this.localstorage.getInLocal('role');
    if(this.role != null){
      this.rolearray = this.role.split(",");
      this.rolearray.forEach(element => {
        if(element == 14){
          this.isStudentregStaff = true;
        }
        if(element == 15)
        {
          this.isStudentregStaff = true;
        }else{
          this.isStudentregStaff = false;
          return false;
        }
        
      });
    }
      console.log(this.role,'rolearray');
      console.log(this.isStudentregStaff+' isStudentregStaff');

    this.useraccess = this.localstorage.getInLocal('uerpermission');
    console.log(this.useraccess,'this.useraccess');
     this.stktype = this.localstorage.getInLocal('stktype');
     this.regpk = this.localstorage.getInLocal('registerPk');
     this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
     let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Staff Management');
 
     if (this.isfocalpoint == 1) {
       this.downloadaccess = true;
       this.readaccess = true;
       this.createaccess = true;
       this.updateaccess = true;
       this.deleteaccess = true;
     }
     let submodule = this.stktype == 1 ? 32 : 38;
     console.log('moduleid',moduleid);
     console.log('submodule',submodule);
     console.log('stktype',this.stktype);
     
     if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y') {
         this.downloadaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y') {
         this.readaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].create == 'Y') {
         this.createaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].update == 'Y') {
         this.updateaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].delete == 'Y') {
         this.deleteaccess = true;
       }
     }
    console.log(this.readaccess+'readaccess'); 
    
    if (this.readaccess == false) {
       swal({
         title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
         text: '',
         icon: 'warning',
         buttons: [false, this.i18n('Ok')],
         dangerMode: true,
         className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
         closeOnClickOutside: false
       }).then((willGoBack) => {
         if (willGoBack) {
           this.router.navigate(['/dashboard/portaladmin'])
         }
       });
     }
  this.displayedColumns = this.stktype == 1 ?[
    { def: "member_number", search: "row-membernumber", label: "OPAL Membership No. ", visible: false, disabled: true },
    { def: "company_name", search: "row-companyname", label: "Company Name ", visible: false, disabled: true },
    { def: "training_centre", search: "row-training", label: "Training Centre Name", visible: true, disabled: true },
    { def: "office_type", search: "row-office", label: "Office Type", visible: false, disabled: true },
    { def: "branch_name", search: "row-branch", label: "Branch Name", visible: true, disabled: false },
    { def: "site_locaton", search: "row-location", label: "Site Location", visible: false, disabled: false },
    { def: "course", search: "row-course", label: "Course", visible: true, disabled: false },
    { def: "civil_number", search: "row-civil", label: "Civil Number", visible: true, disabled: true },
    { def: "staff_name", search: "row-staffname", label: "Staff Name", visible: true, disabled: false },
    { def: "email_id", search: "row-email", label: "Email ID", visible: false, disabled: true },
    { def: "roles", search: "row-roles", label: "Roles", visible: false, disabled: false },
    { def: "language", search: "row-languages", label: "Languages", visible: false, disabled: true },
    { def: "approvewilayat", search: "row-wilayat", label: "Approved Wilayat", visible: false, disabled: true },
    { def: "course_sub", search: "row-subcategories", label: "Course Sub-categories", visible: false, disabled: true },
    { def: "competency_card", search: "row-compcard", label: "Competency Card Status", visible: false, disabled: false },
    { def: "dateofexp", search: "row-expiry", label: "Date of Expiry", visible: false, disabled: false },
    { def: "last_approved", search: "row-approvedon", label: "Last Approved On", visible: false, disabled: false },
    { def: "account_status", search: "row-accountstatus", label: "Account Status", visible: false, disabled: false },
    { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }
  ]: [
    { def: "member_number", search: "row-membernumber", label: "OPAL Membership No. ", visible: false, disabled: true },
    { def: "company_name", search: "row-companyname", label: "Company Name ", visible: false, disabled: true },
    { def: "office_type", search: "row-office", label: "Office Type", visible: true, disabled: true },
    { def: "branch_name", search: "row-branch", label: "Branch Name", visible: true, disabled: false },
    { def: "site_locaton", search: "row-location", label: "Site Location", visible: false, disabled: false },
    { def: "course", search: "row-course", label: "Course", visible: true, disabled: false },
    { def: "civil_number", search: "row-civil", label: "Civil Number", visible: true, disabled: true },
    { def: "staff_name", search: "row-staffname", label: "Staff Name", visible: true, disabled: false },
    { def: "email_id", search: "row-email", label: "Email ID", visible: false, disabled: true },
    { def: "roles", search: "row-roles", label: "Roles", visible: false, disabled: false },
    { def: "language", search: "row-languages", label: "Languages", visible: false, disabled: true },
    { def: "approvewilayat", search: "row-wilayat", label: "Approved Wilayat", visible: false, disabled: true },
    { def: "course_sub", search: "row-subcategories", label: "Course Sub-categories", visible: false, disabled: true },
    { def: "competency_card", search: "row-compcard", label: "Competency Card Status", visible: false, disabled: false },
    { def: "dateofexp", search: "row-expiry", label: "Date of Expiry", visible: false, disabled: false },
    { def: "last_approved", search: "row-approvedon", label: "Last Approved On", visible: false, disabled: false },
    { def: "account_status", search: "row-accountstatus", label: "Account Status", visible: false, disabled: false },
    { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }
  ];
    this.getData('10','','')
    this.getCategorylistforlist();
    this.getCategorylist();
    this.fullPageLoaders = true;
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

    this.remoteService.getLanguageCookie().subscribe(data => {
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          ;
        } else {
          this.filtername = "إخفاء التصفية";

        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }

    });
    this.availabledate = this.formBuilder.group({
      available_Date: ['', '']
    })
    setTimeout(() => {
      this.updateSelectAllVisible();

    }, 1000);
  }

  member_number = new FormControl('');
  company_name = new FormControl('');
  training_centre = new FormControl('');
  officetype = new FormControl('');
  branch_name = new FormControl('');
  site_locaton = new FormControl('');
  course = new FormControl('');
  civil_number = new FormControl('');
  staff_name = new FormControl('');
  email_id = new FormControl('');
  roLes = new FormControl('');
  language = new FormControl('');
  approvewilayat = new FormControl('');
  course_sub = new FormControl('');
  competency_card = new FormControl('');
  dateofexp = new FormControl('');
  last_approved = new FormControl('');
  account_status = new FormControl('');
  available_Date = new FormControl('');

  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('Show Filter');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('Hide Filter');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  clearFilter() {
    this.member_number.reset();
    this.company_name.reset();
    this.training_centre.reset();
    this.officetype.reset();
    this.branch_name.reset();
    this.site_locaton.reset();
    this.course.reset();
    this.civil_number.reset();
    this.staff_name.reset();
    this.email_id.reset();
    this.roLes.reset();
    this.language.reset();
    this.approvewilayat.reset();
    this.course_sub.reset();
    this.competency_card.reset();
    this.dateofexp = new FormControl('');
    this.last_approved = new FormControl('');
    this.last_approved.reset();
    this.account_status.reset();
    this.getData(this.page, 0, this.preparedata([], true));

  }

  syncPrimaryPaginator(event: PageEvent) {
    console.log(event);

    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.length = this.resultsLength;
    this.page = event.pageSize;
    this.getData(this.page, event.pageIndex, this.filterdata)
  }

  // displayed column
  getdisplayedColumns(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
  }
  // displayed search
  getdisplayedsearch(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.search);
  }

  // column edit function
  selectAllFun(event: any) {
    this.selectAllVisible = event.checked;
    this.displayedColumns.forEach(item => {

      // Only modify the visible property if the item is not disabled
      item.visible = this.selectAllVisible;

    });
  }
  // column edit function
  updateSelectAllVisible() {
    const allChecked = this.displayedColumns.every(item => item.visible);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
  }
  dateChange() {
    this.clearClose = true;
    // alert()
  }
  clearDate() {
    this.availabledate.controls.available_Date.reset()
    this.clearClose = false;
    let filterdata;
    filterdata = this.filterdata;
    filterdata['available_Date'] = []

    this.getData(this.page, 0, filterdata);

  }
  //for sub category
  getCategorylistforlist() {
    this.trainingstaff.getCategoryforgridlist().subscribe(res => {
      if (res.data.status == 1) {
        this.subcategorylist = res.data.data.categories;
      }
    });
  }

  //for category
  getCategorylist() {
    this.trainingstaff.getCategorylist().subscribe(res => {
      this.categorylist = res.data;
    });
  }
  viewButton(type, id: any, course: any) {
    if (type == 'viewstaff') {
      this.router.navigate(['/approvalstaffmanagement/trainingcentreview'], { queryParams: { id: btoa(id),'course': btoa(course) } });
      localStorage.setItem('typeView', type)
    } else if (type == 'viewAvailabilty') {
      this.router.navigate(['approvalstaffmanagement/trainingavailability'], { queryParams: { id: btoa(id),'course': btoa(course) } });
      localStorage.setItem('typeView', type)
    } else if (type == 'addStaff') {
      this.router.navigate(['/standardcourse/assessoravailability/add'], { queryParams: { id: btoa(id)} });
      // localStorage.setItem('typeView', type)
      // this.trainingstaff.getaccessorscheduledtls(id,10, 0, null).subscribe(res => {
      //     if (res.status == 200) {
      //       this.accessordata = res['data'];
      //          }
      //   });
    }
  }
  staffTransfer(id: any) {
    this.router.navigate(['/approvalstaffmanagement/transferstaff'], { queryParams: { id: btoa(id) } });
  }

  // API calling 
  getData(limit: any, index: any, searchkey: any) {
    this.tblplaceholder = true;
    let enRegPk = this.security.encrypt(this.regpk);
    this.trainingstaff.getTrainingStaffList(enRegPk,limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
      this.tblplaceholder = false;
      this.fullPageLoaders = false;
      let response = data.data.data;
      this.resultsLength = data.data.totalcount;
      this.dataSource.data = response;
      if (response.length == 0) {
        this.isData = true;
      } else {
        this.isData = false;
      }
    });
  }

  // Download button
  // download(civil: any, staffinfo: any) {
  //   this.trainingstaff.exportSingle(civil, staffinfo).subscribe((data: any) => {
  //     let response = data.data.attend;
  //     var link = document.createElement('a');
  //     link.href = response
  //     link.click();
  //   })
  // }

  preparedata(data, isReset: boolean = false) {
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTERDATA;
    }
    else {
      filterdata = this.filterdata;
    }
    Object.keys(filterdata).forEach(keys => {
      if (isReset) {
        filterdata[keys] = "";
      } else if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });
    return filterdata;
  }

  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.page, 0, this.filterdata)
  }

  changeDateInsp(event: any, formcontrolname: any) {
    var data = {
      searckkey: {
        start_date: this.dateofexp?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.dateofexp?.value.endDate?.format('YYYY-MM-DD')
      },
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  checkAvail(event: any, formcontrolname: any) {
    var data = {
      searckkey: moment(this.availabledate?.value.available_Date).format('YYYY-MM-DD').toString(),
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.clearClose = true;
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }
  //last approved
  lastApproved(event: any, formcontrolname: any) {
    var data = {
      searckkey: {
        start_date: this.last_approved?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.last_approved?.value.endDate?.format('YYYY-MM-DD')
      },
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  mltiSelectBranch(event: any, formcontrolname: any) {
    var data = {
      searckkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)

  }

  // For sorting
  announceSortChange(sortState: Sort) {
    this.filterDataPage = {
      sortFiled: sortState.direction,
      order: sortState.active
    }
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  // Export
  exportExcel() {
    this.fullPageLoaders = true;
    const showCol = [];
    this.displayedColumns.forEach((col) => {
      if (col.visible) {
        showCol.push(col.def)
      }
    });
    let enRegPk = this.security.encrypt(this.regpk);
    this.trainingstaff.exportoExcel(enRegPk,this.page, this.paginator.pageIndex, this.filterdata, this.filterDataPage, showCol).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response;
      link.click();
      this.fullPageLoaders = false;
    })
  }
  // Split sum
  splitSum(data) {
    if (data == null || data == undefined || data == "") {
      this.staffmanagement = [];
      return "";
    }
    this.staffmanagement = data.split(',');
    this.staffremove = data.split(',');
    this.staffremove.shift();
    return this.staffmanagement[0];
  }

  // Remove from center
  removeCenter(id: any) {
    swal({
      title: this.i18n('Do you want to remove from this Centre?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.trainingstaff.removeStaffCentre(id).subscribe((data: any) => {
          this.tblplaceholder = false;
          if (data?.data?.status == true) {
            // this.toastr.success(data?.data?.message);
            this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }

  // Genrate Competency
  genrateCompetency(id: any) {
    swal({
      title: this.i18n('Do you want to generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.fullPageLoaders = true;
        this.trainingstaff.genrateCompCrad(id).subscribe((data: any) => {
          console.log("Data", data);
          this.tblplaceholder = false;
          this.fullPageLoaders = false;
          if (data?.data?.status == true) {
            // this.toastr.success(data?.data?.message);
            this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
            // this.toastr.warning(data?.data?.message);
          }
        })
      }
    });
  }
  // Re-Genrate Competency
  reGenrateCompetency(id: any) {
    swal({
      title: this.i18n('Do you want to re-generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.fullPageLoaders = true;
        this.trainingstaff.reGenrateCompCrad(id).subscribe((data: any) => {
          console.log("Data", data);
          this.tblplaceholder = false;
          this.fullPageLoaders = false;
          if (data?.data?.status == true) {
            this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }
  // Print Competency
  printCompetency(id: any) {
    this.trainingstaff.printCompCrad(id).subscribe((data: any) => {
      if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
        this.toastr.error("Please generate competancy card!");
        return;
      } else {
        this.tblplaceholder = false;
        let response = data.data?.attend;
        var link = document.createElement('a');
        link.target = "_blank";
        link.href = response
        link.click();
      }
    })
  }
  // View Competency
  viewCompetency(id: any) {
    this.trainingstaff.viewCompCrad(id).subscribe((data: any) => {
      if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
        this.toastr.error("Please generate competancy card!");
        return;
      } else {
        this.tblplaceholder = false;
        let response = data.data?.attend;
        var link = document.createElement('a');
        link.target = "_blank";
        link.href = response
        link.click();
      }
    })
  }
}

