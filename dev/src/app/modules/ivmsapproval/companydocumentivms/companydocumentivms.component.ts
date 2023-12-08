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
import { ActivatedRoute } from '@angular/router';
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

export interface Documentrecorddata {
  documentname: any;
  documentprovided: any;
  status: any;
  showmoredata: any;
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
  selector: 'app-companydocumentivms',
  templateUrl: './companydocumentivms.component.html',
  styleUrls: ['./companydocumentivms.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({ height: '*', display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),
  ],
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})


export class CompanydocumentivmsComponent implements OnInit {

  i18n(key) {
    return this.translate.instant(key);
  }
  @ViewChild("dataChkBox") dataChkBox: QueryList<any>;
  @ViewChild("ChkBox") ChkBox: MatCheckbox;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  @ViewChild(MatSort) sort: MatSort;
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @Input() isValidated: boolean = false;
  public apptype: any;
  public updatevalidation: boolean = true;
  public appdt_apptype: any;
  public documentname = new FormControl('');
  public documentprovided = new FormControl('');
  public status = new FormControl('');
  public last_index = 100;
  public counter = 100;
  public apptempPk: any;
  public appdst_documentdtlsmst_fk: FormControl;
  public appdst_submissionstatus: FormControl;
  public appdst_status: FormControl;
  public appdst_updatedon: FormControl;
  public appdst_createdon: FormControl;
  public appdst_issue: FormControl;
  public appdst_expiry: FormControl;
  public appdst_appdecComments: any;
  public appdst_appdecby: any;
  public appdst_appdecon: any;
  public type: any;
  public postUrl: string;
  public postParams: { 'appid': any; };
  public disableSubmitButton: boolean;
  public documentListData: MatTableDataSource<any>;
  public GridDatas: DocumentPagination;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public resultsLength: number;
  public firstCount = 100
  public page: number = 10;
  private querystr: string;
  public searchControl: FormControl = new FormControl('');
  public arr = [];
  public dataforcheckbox: any[];
  public appstatus = [];
  public overallstatus: any;
  public overalltopstatus: 1222;
  public fileUploadedType: string;
  public noData: any = '';
  public tblplaceholder: boolean = false;
  public selectAllbranch: boolean = false;

  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;

  Documentrecordcolumn = [
    { branchColumn: "checkbox", filtsearch: "row-first", label: "CheckBox", HideVisible: true, disoperate: true },
    { branchColumn: "appdst_documentdtlsmst_fk", filtsearch: "row-second", label: "documentrequired.documentname", HideVisible: true, disoperate: false },
    { branchColumn: "appdst_submissionstatus", filtsearch: "row-three", label: "documentrequired.documentprovided", HideVisible: true, disoperate: false },
    { branchColumn: "appdst_remarks", filtsearch: "row-four", label: "documentrequired.documentremark", HideVisible: true, disoperate: false },
    { branchColumn: "date_issue", filtsearch: "row-issue", label: "Date of Isssue", HideVisible: true, disoperate: false },
    { branchColumn: "date_expiry", filtsearch: "row-expiry", label: "Date of Expiry", HideVisible: true, disoperate: false },
    { branchColumn: "appdst_status", filtsearch: "row-six", label: "documentrequired.status", HideVisible: true, disoperate: true },
    { branchColumn: "appdst_createdon", filtsearch: "row-seven", label: "documentrequired.addeon", HideVisible: true, disoperate: false },
    { branchColumn: "appdst_updatedon", filtsearch: "row-eight", label: "documentrequired.lastupdaon", HideVisible: true, disoperate: false },
    { branchColumn: "action", filtsearch: "row-nine", label: "Action", HideVisible: true, disoperate: false },
  ];
  // displayed column
  getDocumentrecordcolumn(): string[] {
    return this.Documentrecordcolumn.filter(branch_list => branch_list.HideVisible).map(branch_list => branch_list.branchColumn);
  }
  // displayed search
  getDocumentrecordcolumnsearch(): string[] {
    return this.Documentrecordcolumn.filter(branch_list => branch_list.HideVisible).map(branch_list => branch_list.filtsearch);
  }
  // column edit function
  selectAllDocumentrecordcolumnFun(event: any) {
    this.selectAllbranch = event.checked;
    this.Documentrecordcolumn.forEach(item => {
      item.HideVisible = this.selectAllbranch;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllBranchListData(item: any) {
    const courseChecked = this.Documentrecordcolumn.every(item => item.HideVisible);
    if (courseChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }

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

  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService, private cookieService: CookieService,
    private http: HttpClient, public routeid: ActivatedRoute, private security: Encrypt, private appservice: ApplicationService
  ) {

    this.onValidation = this.onValidation.bind(this);
  }
  expandedElement: boolean = false;
  showTxt = this.i18n('documentrequired.showmore');
  info = "In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.";
  ngOnInit(): void {
    this.last_index = (this.info.substring(0, 100)).lastIndexOf(' ');
    if (this.last_index > 100)
      this.last_index = 100;
    this.counter = this.last_index;
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
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";

        }
        else {
          this.filtername = "إخفاء التصفية";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
    });

    this.appdst_documentdtlsmst_fk = new FormControl('');
    this.appdst_submissionstatus = new FormControl('');
    this.appdst_status = new FormControl('');
    this.appdst_updatedon = new FormControl('');
    this.appdst_createdon = new FormControl('');

    this.appdst_documentdtlsmst_fk.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        }
      }
    )
    this.appdst_submissionstatus.valueChanges.debounceTime(400).subscribe(

      register => {
        this.paginator.pageIndex = 0;
        this.fetchDocumentData();
      }
    )

    this.appdst_status.valueChanges.debounceTime(400).subscribe(

      register => {

        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        }
      }
    )
    this.appdst_createdon.valueChanges.debounceTime(400).subscribe(

      register => {

        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        }
      }
    )
    this.appdst_updatedon.valueChanges.debounceTime(400).subscribe(

      register => {

        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.fetchDocumentData();
        }
      }
    )

    this.routeid.params.subscribe(params => {
      this.apptempPk = this.security.decrypt(params['id']);
      this.type = params['type'];
    });
    this.fileUploadedType = 'pdf';

    if (this.type == 'view') {
      this.Documentrecordcolumn = [
        { branchColumn: "checkbox", filtsearch: "row-first", label: "CheckBox", HideVisible: true, disoperate: true },
        { branchColumn: "appdst_documentdtlsmst_fk", filtsearch: "row-second", label: "documentrequired.documentname", HideVisible: true, disoperate: false },
        { branchColumn: "appdst_submissionstatus", filtsearch: "row-three", label: "documentrequired.documentprovided", HideVisible: true, disoperate: false },
        { branchColumn: "appdst_remarks", filtsearch: "row-four", label: "documentrequired.documentremark", HideVisible: true, disoperate: false },
        { branchColumn: "date_issue", filtsearch: "row-issue", label: "Date of Isssue", HideVisible: true, disoperate: false },
        { branchColumn: "date_expiry", filtsearch: "row-expiry", label: "Date of Expiry", HideVisible: true, disoperate: false },
        { branchColumn: "appdst_status", filtsearch: "row-six", label: "documentrequired.status", HideVisible: true, disoperate: true },
        { branchColumn: "appdst_createdon", filtsearch: "row-seven", label: "documentrequired.addeon", HideVisible: true, disoperate: false },
        { branchColumn: "appdst_updatedon", filtsearch: "row-eight", label: "documentrequired.lastupdaon", HideVisible: true, disoperate: false },
        { branchColumn: "action", filtsearch: "row-nine", label: "Action", HideVisible: true, disoperate: false },
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
    }
  }


  showfulldata: boolean[] = [];
  showdata: boolean[] = [];
  toggleSkil(index: number) {
    this.showdata[index] = !this.showdata[index];
    this.showfulldata[index] = !this.showfulldata[index];

    console.log(index)
    if (this.counter < 101) {
      this.counter = this.info.length;
      this.showTxt = this.i18n('documentrequired.showless')
    }
    else {
      this.counter = this.last_index;
      this.showTxt = this.i18n('documentrequired.showmore')
    }
  }

  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('company.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('company.hitefil');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.appdst_submissionstatus.toLowerCase().indexOf(searchTerms.appdst_submissionstatus) !== -1 &&
        data.appdst_remarks.toLowerCase().indexOf(searchTerms.appdst_remarks) !== -1 &&
        data.appdst_status.toLowerCase().indexOf(searchTerms.appdst_status) !== -1 &&
        data.appdst_appdecon.toLowerCase().indexOf(searchTerms.appdst_appdecon) !== -1 &&
        data.appdst_appdecby.toLowerCase().indexOf(searchTerms.appdst_appdecby) !== -1;

    }
    return filterFunction;
  }

  selectAllFun(data) {
    if (data == true) {
      this.dataforcheckbox.forEach((data, index) => {
        this.arr.push(data.appdocsubmissiontmp_pk);
      })
    } else {

      this.dataforcheckbox.forEach((data, index) => {
        const PrdIndex = this.arr.indexOf(data.appdocsubmissiontmp_pk);
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

  ngAfterViewInit() {
    this.fetchDocumentData();
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchDocumentData();
  }
  fetchDocumentData() {
    this.tblplaceholder = true;
    this.GridDatas = new DocumentPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};


    gridsearchvalue = { appdst_documentdtlsmst_fk: this.appdst_documentdtlsmst_fk.value, appdst_submissionstatus: this.appdst_submissionstatus.value, appdst_status: this.appdst_status.value, appdst_createdon: this.appdst_createdon.value, appdst_updatedon: this.appdst_updatedon.value };
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
          this.appdt_apptype = data['data'].data.appdt_apptype;

          if (this.appdt_apptype == 3 || this.appdt_apptype == undefined) {
            this.updatevalidation = false;
          }
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.documentListData = new MatTableDataSource<any>(data);
        this.documentListData.filterPredicate = this.createFilter();
        this.dataforcheckbox = Object.keys(data || {}).map(function (index) {
          let dataList = data[index];
          return dataList;
        });
        this.appstatus = Object.keys(data || {}).map(function (index) {
          let dataList = data[index];
          let status = dataList.appdst_status;

          return status;
        });

        this.noData = this.documentListData.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;

      });

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

  onValidation(form, resetForm) {
    this.disableSubmitButton = true;
    this.appservice.updateDocument(form.value, this.arr).subscribe(data => {
      if (data.data.msg == 'success') {
        this.disableSubmitButton = false;
        swal({
          title: this.i18n('company.docuvalidation'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.arr.length = 0;
          this.ChkBox.checked = false;
          resetForm();
        });
        this.fetchDocumentData();

      } else {
        this.disableSubmitButton = false;
        swal({
          title: data.data.comments,
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.arr.length = 0;
          this.ChkBox.checked = false;
          resetForm();
        });
        this.fetchDocumentData();

      }
    });
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
  }
  clearFilter() {
    this.appdst_documentdtlsmst_fk.setValue("");
    this.appdst_submissionstatus.setValue("");
    this.appdst_issue.setValue("");
    this.appdst_expiry.setValue("");
    this.appdst_status.setValue("");
    this.appdst_createdon.setValue("");
    this.appdst_updatedon.setValue("");

    this.fetchDocumentData();
    $(".clear").trigger("click");
  }
}




export class DocumentPagination {
  constructor(private http?: HttpClient) {
  }

  documentGridUtil(sort: string, order: string, page: number, size: number, gridsearchValues?: string, appid?: number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getdocument';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
