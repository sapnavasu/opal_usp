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
import { TechnicalstaffService } from '@app/services/technicalStaff.service';

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
  projectName_en: any;
  centreName: any;
  officetype: any;
  branchName_en: any;
  site_locaton: any;
  civilNumber: any;
  staffName_en: any;
  email_id: any;
  roles: any;
  categories: any;
  competency_card: any;
  Dateofexp: any;
  // last_approved: any;
  accountstatus: any;
}

const FILTERDATA = {
  projectName: [],
  centreName: [],
  member_number: [],
  company_name: [],
  officetype: [],
  branchName: [],
  siteLocation: [],
  civilNumber: [],
  staffName: [],
  email_id: [],
  roLes: [],
  subCategories: [],
  compCard: [],
  expiryDate: [],
  approvedOn: [],
  accountstatus: [],
}

// const ELEMENT_DATA: Element[] = [
//   { project_name: 'Test', office_type: '1', branch_name: '', site_locaton: 'NABET', civil_number: 'PDF', staff_name: 'A', email_id: '10-1-2023', roles: 20 - 1 - 2023, categories: 'New', competency_card: 'Completed', Dateofexp: 34 - 6 - 2034, last_approved: 3-9-3034,account_status: 1 },
// ];
@Component({
  selector: 'app-stafftechnical',
  templateUrl: './stafftechnical.component.html',
  styleUrls: ['./stafftechnical.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class StafftechnicalComponent implements OnInit {
  tableplaceholder: boolean = false;
  categorylist: any = [
    {id: 5, name: 'Ambulance'},
    {id: 3, name: 'Bus'},
    {id: 6, name: 'Emergency Evacuation Vehicle'},
    {id: 9, name: 'Fire Tender'},
    {id: 2, name: 'Heavy Vehicle'},
    {id: 1, name: 'Light Vehicle'},
    {id: 4, name: 'Trailer/Tanker'},
    {id: 7, name: 'Tanker'},
    {id: 8, name: 'Trailer'},
  ];
  isData: boolean = false;
  staffmanagement: any[] = [];
  staffremove: any
  filterDataPage: any = { sort: 'asc', order: '' };
  i18n(key) {
    return this.translate.instant(key);
  }

  filterdata: {
    projectName: [],
    centreName: [],
    member_number: [],
    company_name: [],
    officetype: [],
    branchName: [],
    siteLocation: [],
    civilNumber: [],
    staffName: [],
    email_id: [],
    roLes: [],
    subCategories: [],
    compCard: [],
    expiryDate: [],
    approvedOn: [],
    accountstatus: [],
  }

  public PageLoaders: boolean = false;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number;
  public hidefilder: boolean = true;
  public selectAllVisible: boolean;
  page: number = 10;
  dataSource = new MatTableDataSource<Element>();
  public clearClose: boolean = false;
  displayedColumns  = [];

  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    private route: Router,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService,
    protected security: Encrypt,
    private technicalstaff: TechnicalstaffService
  ) { }

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
  public ifarbic: boolean = false;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  ngOnInit(): void {
    // user permission Start here
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Staff Management');

    if (this.isfocalpoint == 1) {
      this.downloadaccess = true;
      this.readaccess = true;
      this.createaccess = true;
      this.updateaccess = true;
      this.deleteaccess = true;
    }
    let submodule = this.stktype == 1 ? 33 : 39;
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
          this.route.navigate(['/dashboard/portaladmin'])
        }
      });
    }
    // user permission end here

    this.displayedColumns = this.stktype == 1 ?[
      { def: "project_name", search: "row-project", label: "Project Name", visible: true, disabled: true },
      { def: "centre_name", search: "row-centre", label: "Centre Name", visible: true, disabled: true },
      { def: "member_number", search: "row-membernumber", label: "OPAL Membership No. ", visible: false, disabled: true },
      { def: "company_name", search: "row-companyname", label: "Company Name ", visible: false, disabled: true },
      { def: "office_type", search: "row-training", label: "Office Type", visible: false, disabled: true },
      { def: "branch_name", search: "row-branch", label: "Branch Name", visible: true, disabled: false },
      { def: "site_locaton", search: "row-location", label: "Site Location", visible: false, disabled: false },
      { def: "civil_number", search: "row-civil", label: "Civil Number", visible: true, disabled: true },
      { def: "staff_name", search: "row-staffname", label: "Staff Name", visible: true, disabled: false },
      { def: "email_id", search: "row-email", label: "Email ID", visible: false, disabled: true },
      { def: "roles", search: "row-roles", label: "Roles", visible: false, disabled: false },
      { def: "categories", search: "row-subcategories", label: "Categories", visible: false, disabled: true },
      { def: "competency_card", search: "row-compcard", label: "Competency Card Status", visible: false, disabled: false },
      { def: "dateofexp", search: "row-expiry", label: "Date of Expiry", visible: false, disabled: false },
      { def: "last_approved", search: "row-approvedOn", label: "Last Approved On", visible: false, disabled: false },
      { def: "account_status", search: "row-accountstatus", label: "Account Status", visible: false, disabled: false },
      { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }
    ]:[
      { def: "project_name", search: "row-project", label: "Project Name", visible: true, disabled: true },
      { def: "member_number", search: "row-membernumber", label: "OPAL Membership No. ", visible: false, disabled: true },
      { def: "company_name", search: "row-companyname", label: "Company Name ", visible: false, disabled: true },
      { def: "office_type", search: "row-training", label: "Office Type", visible: true, disabled: true },
      { def: "branch_name", search: "row-branch", label: "Branch Name", visible: true, disabled: false },
      { def: "site_locaton", search: "row-location", label: "Site Location", visible: false, disabled: false },
      { def: "civil_number", search: "row-civil", label: "Civil Number", visible: true, disabled: true },
      { def: "staff_name", search: "row-staffname", label: "Staff Name", visible: true, disabled: false },
      { def: "email_id", search: "row-email", label: "Email ID", visible: false, disabled: true },
      { def: "roles", search: "row-roles", label: "Roles", visible: false, disabled: false },
      { def: "categories", search: "row-subcategories", label: "Categories", visible: false, disabled: true },
      { def: "competency_card", search: "row-compcard", label: "Competency Card Status", visible: false, disabled: false },
      { def: "dateofexp", search: "row-expiry", label: "Date of Expiry", visible: false, disabled: false },
      { def: "last_approved", search: "row-approvedOn", label: "Last Approved On", visible: false, disabled: false },
      { def: "account_status", search: "row-accountstatus", label: "Account Status", visible: false, disabled: false },
      { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }];

    this.getData(10, '', '')
    this.PageLoaders = true;
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

    setTimeout(() => {
      this.updateAllVisible();

    }, 1000);
  }
  projectName = new FormControl('');
  centreName = new FormControl('');
  member_number = new FormControl('');
  company_name = new FormControl('');
  traimigCentre = new FormControl('');
  officetype = new FormControl('');
  branchName = new FormControl('');
  siteLocation = new FormControl('');
  civilNumber = new FormControl('');
  staffName = new FormControl('');
  email_id = new FormControl('');
  roLes = new FormControl('');
  categor_ies = new FormControl('');
  compCard = new FormControl('');
  expiryDate = new FormControl('');
  approvedOn = new FormControl('');
  accountstatus = new FormControl('');
  subCategories = new FormControl('');


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
    this.projectName.reset();
    this.centreName.reset();
    this.member_number.reset();
    this.company_name.reset();
    this.traimigCentre.reset();
    this.branchName.reset();
    this.siteLocation.reset();
    this.civilNumber.reset();
    this.staffName.reset();
    this.email_id.reset();
    this.roLes.reset();
    this.categor_ies.reset();
    this.compCard.reset();
    // this.expiryDate.reset();
    this.expiryDate = new FormControl('');
    this.approvedOn = new FormControl('');
    // this.approvedOn.reset();
    this.accountstatus.reset();
    this.subCategories.reset();

    this.getData(this.page, 0, this.preparedata([], true));
  }
  syncPrimaryPaginator(event: PageEvent) {
    // console.log("Test Search Key"); 
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.dataSource.sort = this.sort;
    this.paginator.length = this.resultsLength;
    this.getData(this.page, event.pageIndex, this.filterdata);
  }

  // displayed column
  getdisplayedColumn(): string[] {
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
  updateAllVisible() {
    const allChecked = this.displayedColumns.every(item => item.visible);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
  }
  viewtechButton(type, id: any) {
    if (type == 'viewStaff') {
      this.router.navigate(['/approvalstaffmanagement/technicalstaffview'], { queryParams: { id: btoa(id) } });
      localStorage.setItem('typeView', type)
    } else {
      this.router.navigate(['approvalstaffmanagement/technicalviewschedule'], { queryParams: { id: btoa(id) } });
      localStorage.setItem('typeView', type)
    }
  }
  staffTransfer(id: any) {
    this.router.navigate(['/approvalstaffmanagement/transferstafftech'], { queryParams: { id: btoa(id) } });
  }

  // Searching start
  searchbatchgrid(searchkey, formcontrolname) {
    var data = {
      searchkey: searchkey,
      formcontrolname: formcontrolname
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.page, 0, this.filterdata)
  }

  // Date range filter
  changeDateInsp(event: any, formcontrolname: any) {
    if(this.expiryDate){
      console.log("this.expiryDate", this.expiryDate)
      var data = {
        searchkey: {
          start_date: this.expiryDate?.value.startDate?.format('YYYY-MM-DD'),
          end_date: this.expiryDate?.value.endDate?.format('YYYY-MM-DD')
        },
        formcontrolname: formcontrolname
      };
    }
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  changeDateApp(event: any, formcontrolname: any) {
    var data = {
      searchkey: {
        start_date: this.approvedOn?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.approvedOn?.value.endDate?.format('YYYY-MM-DD')
      },
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  preparedata(data, isReset: boolean = false) {
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTERDATA;
    }
    else {
      filterdata = this.filterdata;
    }
    Object.keys(filterdata).forEach(keys => {
      // debugger
      if (isReset) {
        filterdata[keys] = " ";
        this.filterdata[keys] = " ";

      } else if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searchkey'];
      }
    });
    filterdata = FILTERDATA;
    return filterdata;
  }

  // Office type search
  mltiSelectBranch(event: any, formcontrolname: any) {
    var data = {
      searchkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }
  // Roles search
  mltiSelectRole(event: any, formcontrolname: any) {
    var data = {
      searchkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }
  // Categories search
  mltiSelectCate(event: any, formcontrolname: any) {
    var data = {
      searchkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  // API calling
  getData(limit: any, index: any, searchkey: any) {
    this.tableplaceholder = true;
    this.technicalstaff.getTechnicalStaffList(limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
      this.tableplaceholder = false;
      this.PageLoaders = false;
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
    this.PageLoaders = true;
    const showCol = [];
    this.displayedColumns.forEach((col) => {
      if (col.visible) {
        showCol.push(col.def)
      }
    });
    this.technicalstaff.exportoExcel(this.page, this.paginator.pageIndex, this.filterdata, this.filterDataPage, showCol).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response;
      this.PageLoaders = false;
      link.click();
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
        this.technicalstaff.removeStaffCentre(id).subscribe((data: any) => {
          this.tableplaceholder = false;
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
        this.PageLoaders = true;
        this.technicalstaff.genrateCompCrad(id).subscribe((data: any) => {
          console.log("Data", data);
          this.tableplaceholder = false;
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
        this.PageLoaders = false;
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
      this.PageLoaders = true;
      if (willGoBack) {
        this.technicalstaff.reGenrateCompCrad(id).subscribe((data: any) => {
          console.log("Data", data);
          this.tableplaceholder = false;
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
      this.PageLoaders = false;
        })
      }
    });
  }

  // Print Competency
  printCompetency(id: any) {
    this.technicalstaff.printCompCrad(id).subscribe((data: any) => {
      if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
        this.toastr.error("Please generate competancy card!");
        return;
      } else {
        this.tableplaceholder = false;
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
    this.technicalstaff.viewCompCrad(id).subscribe((data: any) => {
      if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
        this.toastr.error("Please generate competancy card!");
        return;
      } else {
        this.tableplaceholder = false;
        let response = data.data?.attend;
        var link = document.createElement('a');
        link.target = "_blank";
        link.href = response
        link.click();
      }
    })
  }
}

