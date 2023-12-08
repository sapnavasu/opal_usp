import { SelectionModel } from '@angular/cdk/collections';
import { Component, OnInit, ViewChild, ViewEncapsulation, QueryList, Input, Output, EventEmitter } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { animate, state, style, transition, trigger } from '@angular/animations';
import { MatCheckbox } from '@angular/material/checkbox';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { MatSort } from '@angular/material/sort';
import { merge } from 'rxjs/observable/merge';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ApplicationService } from '@app/services/application.service';
import { map } from 'rxjs/operators/map'
import { catchError } from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import { of as observableOf } from 'rxjs/observable/of';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';

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
  selector: 'app-ivmsstaff',
  templateUrl: './ivmsstaff.component.html',
  styleUrls: ['./ivmsstaff.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({ height: '*', display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),
  ],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})

export class IvmsstaffComponent implements OnInit {
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("dataChkBox") dataChkBox: QueryList<any>;
  @ViewChild("ChkBox") ChkBox: MatCheckbox;
  @ViewChild(MatSort) sort: MatSort;
  @Input() isValidated: boolean = false;
  public staffListData: MatTableDataSource<any>;
  public documentname = new FormControl('');
  public documentprovided = new FormControl('');
  public sir_idnumber: any;
  public sir_name_en: any;
  public sir_emailid: any;
  public sir_gender: any;
  public natioanl_filt: any;
  public appsit_updatedon: any;
  public appsit_createdon: any;
  public sir_dob: any;
  public inspect_ion: any;
  public appsit_contracttype: any;
  public appsit_mainrole: any;
  public appsit_apprasvehinspcattmp_fk: any;
  public ocym_countryname_en: any;
  public appsit_roleforcourse: any;
  public compcardfilt: any;
  public appsit_status: any;
  public type: any;
  public disableSubmitButton: boolean;
  public mainrolearray: any;
  public projectpk: any;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public resultsLength: number;
  public firstCount = 100
  public page: number = 10;
  private querystr: string;
  searchControl: FormControl = new FormControl('');
  public arr = [];
  public dataforcheckbox: any[];
  public appstatus = [];
  public overallstatus: any;
  public GridDatas: StaffPagination;
  public apptempPk: any;
  public tblplaceholder: boolean = false;
  // staff
  @ViewChild('staffChkbox') staffChkbox: MatCheckbox;
  public selectAllStaff: boolean = false;
  // selected2 = moment();

  i18n(key) {
    return this.translate.instant(key);
  }
  status = new FormControl('');
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  // expandedElement: Staffrecorddata | null;
  expandedElement: boolean = false;

  // table stafff start
  staffrecordcolumn = [
    { staffcolumn: "sir_idnumber", srchFilt: "row-second", label: "staff.civinumb", DataVisible: true, disoperate: true },
    { staffcolumn: "sir_name_en", srchFilt: "row-three", label: "staff.stafname", DataVisible: true, disoperate: false },
    { staffcolumn: "sir_emailid", srchFilt: "row-four", label: "staff.emaiid", DataVisible: true, disoperate: false },
    { staffcolumn: "sir_dob", srchFilt: "row-five", label: "staff.age", DataVisible: true, disoperate: false },
    { staffcolumn: "sir_gender", srchFilt: "row-six", label: "staff.gend", DataVisible: true, disoperate: true },
    { staffcolumn: "ocym_countryname_en", srchFilt: "row-national", label: "Nationality", DataVisible: true, disoperate: false },
    { staffcolumn: "appsit_roleforcourse", srchFilt: "row-newone", label: "Roles", DataVisible: true, disoperate: false },
    { staffcolumn: "appsit_status", srchFilt: "row-nine", label: "staff.Stat", DataVisible: true, disoperate: false },
    { staffcolumn: "appsit_createdon", srchFilt: "row-ten", label: "staff.addeon", DataVisible: true, disoperate: true },
    { staffcolumn: "appsit_updatedon", srchFilt: "row-eleven", label: "staff.lastupdaon", DataVisible: true, disoperate: false },
    { staffcolumn: "action", srchFilt: "row-twelve", label: "staff.acti", DataVisible: true, disoperate: true },
  ];
  // displayed column
  getstaffListData(): string[] {
    return this.staffrecordcolumn.filter(staff_list => staff_list.DataVisible).map(staff_list => staff_list.staffcolumn);
  }
  // displayed search
  getstaffListDatasearch(): string[] {
    return this.staffrecordcolumn.filter(staff_list => staff_list.DataVisible).map(staff_list => staff_list.srchFilt);
  }
  // column edit function
  selectAllstaffListDataFun(event: any) {
    this.selectAllStaff = event.checked;
    this.staffrecordcolumn.forEach(item => {
      item.DataVisible = this.selectAllStaff;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
  }
  // column edit function
  updateSelectAllstaffListData(item: any) {
    const staffChecked = this.staffrecordcolumn.every(item => item.DataVisible);
    if (staffChecked) {
      this.staffChkbox.checked = true;
    } else {
      this.staffChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
  }
  // table staff end

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  locale: LocaleConfig = {
    format: 'DD-MM-YYYY',
  }
  ifarabic: boolean = false;
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  noData: any = '';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService, private http: HttpClient, private route: Router, public routeid: ActivatedRoute, private security: Encrypt, private appservice: ApplicationService
  ) {

    this.onValidation = this.onValidation.bind(this);
  }

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      } else {
        this.filtername = "إخ�?اء التص�?ية";
        this.ifarabic = true;
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
          this.filtername = "Hide Filter";
          this.ifarabic = false;

        }
        else {
          this.filtername = "إخ�?اء التص�?ية";
          this.ifarabic = true;

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

    this.routeid.params.subscribe(params => {
      console.log(params, 'params');
      this.apptempPk = this.security.decrypt(params['id']);
      this.type = params['type'];
      this.projectpk = this.security.decrypt(params['projectpk']);
    });

    this.appservice.getmainrole().subscribe(data => {
      this.mainrolearray = data.data.data;
    });
    this.sir_idnumber = new FormControl('');
    this.sir_name_en = new FormControl('');
    this.sir_emailid = new FormControl('');
    this.sir_gender = new FormControl('');
    this.natioanl_filt = new FormControl('');
    this.appsit_contracttype = new FormControl('');
    this.appsit_mainrole = new FormControl('');
    this.inspect_ion = new FormControl('');
    this.appsit_status = new FormControl('');
    this.compcardfilt = new FormControl('')
    this.appsit_createdon = new FormControl('');
    this.appsit_updatedon = new FormControl('');
    this.appsit_roleforcourse = new FormControl('');
    this.appsit_apprasvehinspcattmp_fk = new FormControl('');
    this.ocym_countryname_en = new FormControl('');


    this.sir_idnumber.valueChanges.debounceTime(400).subscribe(


      register => {

        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )
    this.sir_name_en.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )
    this.sir_emailid.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )
    this.sir_gender.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )
    this.appsit_contracttype.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.appsit_mainrole.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )
    this.appsit_roleforcourse.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.appsit_apprasvehinspcattmp_fk.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.appsit_status.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.appsit_createdon.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.appsit_updatedon.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.ocym_countryname_en.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )

    this.compcardfilt.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchStaffData();
        }
      }
    )
    if(this.type == 'view')  {
      this.staffrecordcolumn = [
        { staffcolumn: "sir_idnumber", srchFilt: "row-second", label: "staff.civinumb", DataVisible: true, disoperate: true },
        { staffcolumn: "sir_name_en", srchFilt: "row-three", label: "staff.stafname", DataVisible: true, disoperate: false },
        { staffcolumn: "sir_emailid", srchFilt: "row-four", label: "staff.emaiid", DataVisible: false, disoperate: false },
        { staffcolumn: "sir_dob", srchFilt: "row-five", label: "staff.age", DataVisible: false, disoperate: false },
        { staffcolumn: "sir_gender", srchFilt: "row-six", label: "staff.gend", DataVisible: true, disoperate: true },
        { staffcolumn: "ocym_countryname_en", srchFilt: "row-national", label: "Nationality", DataVisible: true, disoperate: false },
        { staffcolumn: "appsit_roleforcourse", srchFilt: "row-newone", label: "Roles", DataVisible: false, disoperate: false },
        { staffcolumn: "appsit_status", srchFilt: "row-nine", label: "staff.Stat", DataVisible: true, disoperate: false },
        { staffcolumn: "appsit_createdon", srchFilt: "row-ten", label: "staff.addeon", DataVisible: true, disoperate: true },
        { staffcolumn: "appsit_updatedon", srchFilt: "row-eleven", label: "staff.lastupdaon", DataVisible: false, disoperate: false },
        { staffcolumn: "action", srchFilt: "row-twelve", label: "staff.acti", DataVisible: true, disoperate: true },
      ];
    }
  }


  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      console.log('page-content')
    } catch (error) {
      // console.log('page-content')
    }
  }


  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchStaffData();
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

  ngAfterViewInit() {
    this.fetchStaffData();
  }
  fetchStaffData() {
    this.tblplaceholder = true;
    this.GridDatas = new StaffPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};


    gridsearchvalue = {
      sir_idnumber: this.sir_idnumber.value, sir_name_en: this.sir_name_en.value, sir_emailid: this.sir_emailid.value, sir_gender: this.sir_gender.value, appsit_contracttype: this.appsit_contracttype.value, appsit_mainrole: this.appsit_mainrole.value, appsit_apprasvehinspcattmp_fk: this.appsit_apprasvehinspcattmp_fk.value, appsit_roleforcourse: this.appsit_roleforcourse.value, appsit_status: this.appsit_status.value,
      appsit_createdon: this.appsit_createdon.value, appsit_updatedon: this.appsit_updatedon.value, ocym_countryname_en: this.ocym_countryname_en.value, compcardfilt: this.compcardfilt.value
    };
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {

          return this.GridDatas.documentGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
            this.page,
            JSON.stringify(gridsearchvalue), this.apptempPk);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          this.overallstatus = data['data'].data.appstatus;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.staffListData = new MatTableDataSource<any>(data);
        this.staffListData.filterPredicate = this.createFilter();
        this.noData = this.staffListData.connect().pipe(map(data => data.length === 0));
        console.log(this.noData)
        this.dataforcheckbox = Object.keys(data || {}).map(function (index) {
          let dataList = data[index];
          return dataList;
        });
        this.appstatus = Object.keys(data || {}).map(function (index) {
          let dataList = data[index];
          let status = dataList.appsit_status;
          return status;
        });

        this.tblplaceholder = false;

      });
  }

  selectAllFun(data) {
    if (data == true) {
      this.dataforcheckbox.forEach((data, index) => {
        this.arr.push(data.appostaffinfotmp_pk);
      })
    } else {

      this.dataforcheckbox.forEach((data, index) => {
        const PrdIndex = this.arr.indexOf(data.appostaffinfotmp_pk);
        this.arr.splice(PrdIndex, 1);
      })
    }

  }

  validationcheck($event, intpk) {

    if ($event.checked == true) {
      if (!this.arr.includes(intpk)) {
        this.arr.push(intpk)
      }
    } else {
      const index1 = this.arr.indexOf(intpk);
      if (index1 > -1) {
        this.arr.splice(index1, 1);
      }
    }
    if (this.arr.length == this.dataforcheckbox.length) {
      this.ChkBox.checked = true;
    } else {
      this.ChkBox.checked = false;
    }
  }

  checkArrayEqualElements(_array) {
    if (typeof _array !== 'undefined') {
      var firstElement = _array[0];
      return _array.every(function (element) {
        return element === firstElement;
      });
    }
    return "Array is Undefined";
  }

  action(id, type, view) {
    this.disableSubmitButton = true;
    if (this.projectpk == 1) {
      this.route.navigate(['trainingcentremanagement/courseview/' + this.security.encrypt(id) + '/staff/' + type]);
    } else {
      this.route.navigate(['trainingcentremanagement/courseviewras/' + this.security.encrypt(id) + '/staff/' + type + '/' + this.security.encrypt(1) + '/' + this.security.encrypt(view)]);

    }
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 5000);
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.sir_idnumber.toLowerCase().indexOf(searchTerms.sir_idnumber) !== -1 &&
        data.sir_name_en.toLowerCase().indexOf(searchTerms.sir_name_en) !== -1 &&
        data.sir_emailid.toLowerCase().indexOf(searchTerms.sir_emailid) !== -1 &&
        data.sir_dob.toLowerCase().indexOf(searchTerms.sir_dob) !== -1 &&
        data.sir_gender.toLowerCase().indexOf(searchTerms.sir_gender) !== -1 &&
        data.appsit_contracttype.toLowerCase().indexOf(searchTerms.appsit_contracttype) !== -1 &&
        data.appsit_mainrole.toLowerCase().indexOf(searchTerms.appsit_mainrole) !== -1 &&
        data.appsit_apprasvehinspcattmp_fk.toLowerCase().indexOf(searchTerms.appsit_apprasvehinspcattmp_fk) !== -1 &&
        data.ocym_countryname_en.toLowerCase().indexOf(searchTerms.ocym_countryname_en) !== -1 &&

        data.appsit_roleforcourse.toLowerCase().indexOf(searchTerms.appsit_roleforcourse) !== -1 &&

        data.appsit_status.toLowerCase().indexOf(searchTerms.appsit_status) !== -1 &&
        data.aappsit_createdon.toLowerCase().indexOf(searchTerms.aappsit_createdon) !== -1 &&
        data.appsit_updatedon.toLowerCase().indexOf(searchTerms.appsit_updatedon) !== -1;

    }
    return filterFunction;
  }


  onValidation(form, resetForm) {
    this.disableSubmitButton = true;
    this.appservice.updateStaff(form.value, this.arr).subscribe(data => {
      this.disableSubmitButton = false;
      if (data.data.msg == 'success') {
        swal({
          title: this.i18n('company.staffvalidation'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
        });
      } else {
        swal({
          title: data.data.comments,
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
        });


      }
      this.fetchStaffData();
      this.arr.length = 0;
      this.ChkBox.checked = false;
      resetForm();
    });

  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
  }
  clearFilter() {
    this.sir_idnumber.setValue("");
    this.sir_name_en.setValue("");
    this.sir_emailid.setValue("");
    this.sir_gender.setValue("");
    this.natioanl_filt.reset()
    this.appsit_contracttype.setValue("");
    this.appsit_mainrole.setValue("");
    this.appsit_apprasvehinspcattmp_fk.setValue("");
    this.ocym_countryname_en.setValue("");
    this.appsit_roleforcourse.setValue("");
    this.inspect_ion.reset()
    this.appsit_status.setValue("");
    this.compcardfilt.reset()
    this.appsit_createdon.setValue("");
    this.appsit_updatedon.setValue("");

    this.fetchStaffData();

  }
}

export class StaffPagination {
  constructor(private http?: HttpClient) {
  }

  documentGridUtil(sort: string, order: string, page: number, size: number, gridsearchValues?: string, appid?: number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getstaffvalidation';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

