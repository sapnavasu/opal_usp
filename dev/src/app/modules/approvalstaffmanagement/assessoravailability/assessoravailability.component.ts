import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute, ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment, { Moment } from 'moment';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { MatSelect } from '@angular/material/select';
import { subscribeTo } from 'rxjs/internal-compatibility';
import { Location } from '@angular/common';
import { TrainingStaffService } from '@app/services/trainingStaff.service';

export interface TrainingData {
  date: Date;
  status: any;
  time: any;
  action: any;
}

const FILTERDATA = {
  addeddate: [],
  status: [],
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

@Component({
  selector: 'app-assessoravailability',
  templateUrl: './assessoravailability.component.html',
  styleUrls: ['./assessoravailability.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ],
})
export class AssessoravailabilityComponent implements OnInit {
  staffinfodata: any;
  viewStaffResponse: any;
  civilNumber: any;
  staffinforepo_pk: any;
  StaffInfotmp: any;
  griddata = [];
  isData: boolean = false;
  filterDataPage: any = { sort: 'asc', order: '' };
  selectedDaterange: any = '';
  // @Input() public set accessordata(value: any) {
  //   this.pk = value;

  // }
  public get accessordata() {
    return this.pk;
  }
  filterdata: {
    addeddate: [],
    status: [],

  }
  @ViewChild(MatSelect) select: MatSelect;
  @Input() applicationtype: any;
  TrainingDate = ['date', 'time', 'status', 'action'];
  TrainingtimeData = [];
  hidefilder: any;
  tblplaceholder: boolean;
  resultsLength: any;
  pk: any;
  staffpK: any;
  start: any;
  end: any;
  isDataUpdate : boolean= false;
  i18n(key) {
    return this.translate.instant(key);
  }
  filtername = "Hide Filter";
  availabelDate: FormGroup;
  today = new Date();
  updated: boolean = true;
  @ViewChild("paginator") paginator: MatPaginator;
  public page: any = 10;
  reqformst = [];
  @Output() cancle = new EventEmitter<void>();
  @Output() subdate = new EventEmitter<void>();
  minDate: Moment;
  @ViewChild('selectedDateInput', { static: false }) selectedDateInput: ElementRef;

  @ViewChild(MatSort) sort: MatSort;
  minTime: Date = new Date();
  maxTime: Date = new Date();
  minAfterTime: Date = new Date();
  maxAfterTime: Date = new Date();
  minselectTime: Date = new Date();
  public disableSubmitButton: boolean = false;
  constructor(private formBuilder: FormBuilder, private _location: Location, private el: ElementRef, private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private trainingstaff: TrainingStaffService,
    private secuirty: Encrypt, public toastr: ToastrService,
    private activeRoute: ActivatedRoute,
    public routeid: ActivatedRoute, public router: Router) {
    this.minTime.setHours(6, 0, 0);
    this.maxTime.setHours(12, 0, 0);
    this.minAfterTime.setHours(12, 0, 0);
    this.maxAfterTime.setHours(18, 0, 0);
    this.minselectTime.setHours(6, 0, 0);
    this.minDate = moment();

  }
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
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  @ViewChild('availabelFormRest') availabelFormRest: FormGroupDirective;
  ngOnInit(): void {
    // this.tblplaceholder = true;
    this.activeRoute.queryParamMap.subscribe((data: any) => {
      this.civilNumber = atob(data.get("civil"));
    });
    // this.getDataViaCivil();

    this.routeid.queryParams
      .subscribe(params => {

        this.pk = this.secuirty.decrypt(params.id),
        this.staffpK = this.secuirty.decrypt(params.staffpK),
        this.start = this.secuirty.decrypt(params.start)
        this.end = this.secuirty.decrypt(params.end)
        if(this.start != undefined && this.end != undefined){
          this.selectedDaterange = {
            startDate: new Date(this.start),
            endDate: new Date(this.end)
          };
        }
        if(params.start != undefined && params.start != ''){
          this.isDataUpdate = true
        }        
        // this.availabelDate.controls.selectedDate.value.startDate
        this.getData(this.pk, 10, 0, "")
      }
      );
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
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
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
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
    });
    this.FormValidate();
    this.availabelDate.controls['startDate'].valueChanges.subscribe(value => {
      this.availabelDate.controls['EndDate'].reset();
      // if(this.availabelDate.controls['startDate'].value == ) {

      // }
    })
  }
  updateTime() {
    //  this.
  }
  FormValidate() {
    this.availabelDate = this.formBuilder.group({
      selectedDate: ['', Validators.required],
      startDate: ['', Validators.required],
      EndDate: ['', Validators.required],
    })
  }
  get form() { return this.availabelDate.controls; }
  clear() {
    if (this.availabelDate.touched) {
      swal({
        title: this.i18n('Do you want cancel add Assessor Availability?'),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.availabelDate.reset();
        }
      });
    } else {
      this.availabelDate.reset();
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
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getData(this.pk, this.page, event.pageIndex, this.filterdata)
  }

  addeddate = new FormControl('');
  status = new FormControl('');
  clearFiltersecound() {
    this.addeddate.setValue("");
    this.status.setValue("");


  }
  // Submit button
  submitdata() {
    if (this.availabelDate.controls.selectedDate.value.startDate == 'null' || this.availabelDate.controls.selectedDate.value.startDate == null) {
      this.selectedDateInput.nativeElement.focus();
      return false;
    }
    if (this.availabelDate.valid) {
      let formvalue = this.availabelDate.value;
      formvalue.EndDate = moment(formvalue.EndDate).format('HH:mm:ss').toString();
      formvalue.startDate = moment(formvalue.startDate).format('HH:mm:ss').toString();
      formvalue.selectedDate.startDate = moment(formvalue.selectedDate.startDate).format('YYYY-MM-DD').toString();
      formvalue.selectedDate.endDate = moment(formvalue.selectedDate.endDate).format('YYYY-MM-DD').toString();
      formvalue.pk = this.StaffInfotmp;

      this.trainingstaff.transferData(formvalue).subscribe((data: any) => {
        if (data?.data?.status == true) {
          this.toastr.success(data?.data?.message);
          this.availabelFormRest.reset();
          this.getData(this.pk, this.page, this.paginator.pageIndex, this.filterdata)
        } else {
          this.toastr.warning(data?.data?.message);
        }

      })
    } else {
      this.focusInvalidInput(this.availabelDate);
    }
  }
// Update button
  updateData() {
    if (this.availabelDate.controls.selectedDate.value.startDate == 'null' || this.availabelDate.controls.selectedDate.value.startDate == null) {
      this.selectedDateInput.nativeElement.focus();
      return false;
    }
    if (this.availabelDate.valid) {
      let formvalue = this.availabelDate.value;
      formvalue.id = this.staffpK;
      formvalue.EndDate = moment(formvalue.EndDate).format('HH:mm:ss').toString();
      formvalue.startDate = moment(formvalue.startDate).format('HH:mm:ss').toString();
      formvalue.selectedDate.startDate = moment(formvalue.selectedDate.startDate).format('YYYY-MM-DD').toString();
      formvalue.selectedDate.endDate = moment(formvalue.selectedDate.endDate).format('YYYY-MM-DD').toString();
      formvalue.staffinfo = this.StaffInfotmp;

      this.trainingstaff.updateBooking(formvalue).subscribe((data: any) => {
        if (data?.data?.status == true) {
          this.toastr.success(data?.data?.message);
          this.availabelFormRest.reset();
        } else {
          this.toastr.warning(data?.data?.message);
        }
      })
    } else {
      this.focusInvalidInput(this.availabelDate);
    }
  }

  applyFilter(serch, key) {

    var search = {
      serchkey: serch,
      name: key
    };
    this.select.close();

  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  backBtn() {
    this._location.back();
  }

  getData(id: any, limit: any, index: any, searchkey: any) {
    this.tblplaceholder = true;
    this.trainingstaff.getAddStaff(id, limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
      this.tblplaceholder = false;
      this.TrainingtimeData = data.data.data;
      this.resultsLength = data.data.totalcount;
      if (this.TrainingtimeData.length == 0) {
        this.isData = true;
      } else {
        this.isData = false;
      }
    });
  }

  // Date range filter
  changeDateInsp(event: any, formcontrolname: any) {
    var data = {
      searchkey: {
        start_date: this.addeddate?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.addeddate?.value.endDate?.format('YYYY-MM-DD')
      },
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.pk, this.page, event.pageIndex, this.filterdata)
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
        filterdata[keys] = "";
        this.filterdata[keys] = "";

      } else if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searchkey'];
      }
    });
    return filterdata;
  }

  mltiSelect(event: any, formcontrolname: any) {
    var data = {
      searchkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.pk, this.page, event.pageIndex, this.filterdata)
  }

  // View API Call
  // getDataViaCivil() {
  //   this.trainingstaff.viewStaff(this.civilNumber)
  //     .subscribe((data) => {
  //       this.viewStaffResponse = data?.data;
  //       this.tblplaceholder = false;
  //       this.staffinforepo_pk = data?.data?.staffinforepo_pk;
  //       this.StaffInfotmp = data?.data?.StaffInfotmp;
  //     })
  // }

  updateStatus(id: any, status: any) {
    this.trainingstaff.updateStatus(id, status).subscribe((data: any) => {
      if (data?.data?.status == true) {
        this.toastr.success(data?.data?.message);
        this.getData(this.pk, 10, 0, "")
      } else {
        this.toastr.warning(data?.data?.message);
      }
    })
  }

  edit(civil: any, id: any, staffpK: any, start: any, end: any) {
    this.router.navigate(['/approvalstaffmanagement/availabilty'], { queryParams: { civil: btoa(civil), staffpK: btoa(staffpK), id: btoa(id), start: btoa(start), end: btoa(end) } });
    this.editbook(staffpK);
    console.log("staffpK", staffpK);
  }

  editbook(staffpK: any) {
    this.trainingstaff.editBooking(staffpK).subscribe((data: any) => {
      if (data?.data?.status == true) {
        // this.toastr.success(data?.data?.message);
      } else {
        this.toastr.warning(data?.data?.message);
      }

    })
  }

  navigatebatch(pk, date) {
    let encregstaffinfotmppk = this.secuirty.encrypt(pk);
    this.trainingstaff.getbatchids(pk, date).subscribe(res => {
      // this.disableSubmitButton = false;
      if (res.status == 200) {
        var batchpk = res.data.batchpk;
        this.router.navigate(['/batchindex/batchgridlisting'], { queryParams: { p: batchpk, t: 'fsgrid', d: date } });
      }
    });
  }
}
