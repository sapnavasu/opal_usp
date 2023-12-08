import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort, Sort } from '@angular/material/sort';
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
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { MatSortModule } from '@angular/material/sort';
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
  office_type: any;
  branch_name: any;
  site_locaton: any;
  course: any;
  civil_number: any;
  staff_name: any;
  email_id: any;
  roles: any;
  language: any;
  course_sub: any;
  competency_card: any;
  Dateofexp: any;
  last_approved: any;
  account_status: any;
}


const ELEMENT_DATA: Element[] = [
  { office_type: '1', branch_name: '', site_locaton: 'NABET', course: '10-1-2023', civil_number: 'PDF', staff_name: 'A', email_id: '10-1-2023', roles: 20 - 1 - 2023, language: 20 - 3 - 2022, course_sub: 'New', competency_card: 'Completed', Dateofexp: 34 - 6 - 2034, last_approved: 3-9-3034,account_status: 1 },
];
@Component({
  selector: 'app-trainingcentre',
  templateUrl: './trainingcentre.component.html',
  styleUrls: ['./trainingcentre.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class TrainingcentreComponent implements OnInit {
  tblplaceholder: boolean = false;
  i18n(key) {
    return this.translate.instant(key);
  }
  public fullPageLoaders: boolean = false;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  public selectAllVisible: boolean;
  page: number = 10;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  public availabledate: FormGroup;
  public clearClose: boolean = false;
  displayedColumns = [
    { def: "office_type", search: "row-training", label: "Office Type", visible: true, disabled: true },
    { def: "branch_name", search: "row-branch", label: "Branch name", visible: true, disabled: false },
    { def: "site_locaton", search: "row-location", label: "Site Location", visible: true, disabled: false },
    { def: "course", search: "row-course", label: "Course", visible: true, disabled: false },
    { def: "civil_number", search: "row-civil", label: "Civil Number", visible: true, disabled: true },
    { def: "staff_name", search: "row-staffname", label: "Staff Name", visible: true, disabled: false },
    { def: "email_id", search: "row-email", label: "Email ID", visible: true, disabled: true },
    { def: "roles", search: "row-roles", label: "Roles", visible: true, disabled: false },
    { def: "language", search: "row-languages", label: "Languages", visible: true, disabled: true },
    { def: "approvewilayat", search: "row-wilayat", label: "Approved Wilayat", visible: true, disabled: true },
    { def: "course_sub", search: "row-subcategories", label: "Course Sub-categories", visible: true, disabled: true },
    { def: "competency_card", search: "row-compcard", label: "Competency Card Status", visible: true, disabled: false },
    { def: "dateofexp", search: "row-expiry", label: "Date of Expiry", visible: true, disabled: false },
    { def: "last_approved", search: "row-approvedon", label: "Last Approved On", visible: true, disabled: false },
    { def: "account_status", search: "row-accountstatus", label: "Account Status", visible: true, disabled: false },
    { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }];


  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,

    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService,
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
  public ifarbic: boolean = false;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  ngOnInit(): void {
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
      available_Date: ['','']
    })
    setTimeout(() => {
    this.updateSelectAllVisible();
      
    }, 1000);

    // this.availabledate.controls.available_Date.valueChanges.subscribe(value =>{
    //   alert( this.availabledate.controls.available_Date.value)
    // })
  }
  traimigCentre = new FormControl('');
  branchName = new FormControl('');
  siteLocation = new FormControl('');
  cour_se = new FormControl('');
  civilNumber = new FormControl('');
  staffName = new FormControl('');
  email_id = new FormControl('');
  roLes = new FormControl('');
  languAge = new FormControl('');
  approvedWilayat = new FormControl('');
  subCategories = new FormControl('');
  compCard = new FormControl('');
  expiryDate = new FormControl('');
  approvedOn = new FormControl('');
  accountstatus = new FormControl('');
  

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

  clearFilter() {
    this.traimigCentre.reset();
    this.branchName.reset();
    this.siteLocation.reset();
    this.cour_se.reset();
    this.civilNumber.reset();
    this.staffName.reset();
    this.email_id.reset();
    this.roLes.reset();
    this.languAge.reset();
    this.approvedWilayat.reset();
    this.subCategories.reset();
    this.compCard.reset();
    this.expiryDate.reset();
    this.approvedOn.reset();
    this.accountstatus.reset();
   
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.dataSource.sort = this.sort;
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
  updateSelectAllVisible()  {
    const allChecked = this.displayedColumns.every(item => item.visible);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
        this.editchkbox.checked = false;
    }
  }
  dateChange() {
    this.clearClose = true;
  }
  clearDate() {
    this.availabledate.controls.available_Date.reset()
    this.clearClose = false;
  }
  viewButton(type) {
    if(type=='viewstaff') {
      this.router.navigate(['/staffmanagement/trainingcentreview']);
      localStorage.setItem('typeView', type)
    }else if(type == 'viewAvailabilty') {
      this.router.navigate(['staffmanagement/trainingavailability']);
      localStorage.setItem('typeView', type)
    }else if (type == 'addStaff') {
      this.router.navigate(['/staffmanagement/trainingavailability']);
      localStorage.setItem('typeView', type)
    }
  }
}
