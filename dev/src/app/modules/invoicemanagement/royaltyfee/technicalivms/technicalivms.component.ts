import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA, MatDialog } from "@angular/material/dialog";
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from "ngx-toastr";
import swal from "sweetalert";
import { MatTableDataSource } from '@angular/material/table';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTabGroup } from '@angular/material/tabs';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { MatSort, Sort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { MatCheckbox } from '@angular/material/checkbox';
import { MomentDateAdapter, MAT_MOMENT_DATE_ADAPTER_OPTIONS, } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE, } from '@angular/material/core';
import { MatDatepicker } from '@angular/material/datepicker';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';
import { RoyaltytechService } from '@app/services/royaltytech.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

const moment = _rollupMoment || _moment;
export const MY_FORMATS = {
  parse: {
    dateInput: 'MMM YYYY',
  },
  display: {
    dateInput: 'MMM YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};
//tab 2
export interface technicalEvaluationData {
  invoiceno: any;
  companyname_ar: any;
  companyname_en: any;
  centrename: any;
  officetype: any;
  branchname: any;
  opalmember: any;
  projectname: any;
  invoicemonth: any;
  totalvehicle: any;
  invoiceamount: any;
  position: any;
  paymentstatus: any;
  invoiceage: any;
  invoicedate: any;
  paymentdate: any;
  genratedon: any;
  genratedby: any;
  lastupdate: any;
  lastupdateby: any;
}

const FILTERDATA = {
  invoice_no: [],
  company_name: [],
  centre_name: [],
  office_type: [],
  bran_name: [],
  site_locate: [],
  opal_membership: [],
  project_type: [],
  pay_status: [],
  invoice_date: [],
  invoice_age: [],
  payment_date: [],
  invoice_month: [],
  genratedon: [],
  genratedby: [],
  lastupdate: [],
  lastupdateby: [],
}

@Component({
  selector: 'app-technicalivms',
  templateUrl: './technicalivms.component.html',
  styleUrls: ['./technicalivms.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {
      provide: DateAdapter,
      useClass: MomentDateAdapter,
      deps: [MAT_DATE_LOCALE],
    },

    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class TechnicalivmsComponent implements OnInit {
  filterDataPage: any = { sort: 'asc', order: '' };
  public tableloader: boolean = false;
  public pageloader: boolean = false;
  listLength: any;
  public setMonthandYear: number;
  isData: boolean = false;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public page: number = 10;
  public resultsLength: number;
  public trainingtableload: boolean = false;
  public ifarabic: boolean;
  @ViewChild(MatSort) sort: MatSort;
  public selecttechChkbox: boolean = true;
  @ViewChild('techkBox') techkBox: MatCheckbox;
  @ViewChild('invoice_picker') datepicker: MatDatepicker<any>;
  public regenerateinvoice: boolean = false;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;
  // table
  TechnicalListData = [
    { techlist: "invoiceno", searchfilt: "row-first", label: "invoice.invonumb", techhide: true },
    { techlist: "companyname", searchfilt: "row-second", label: "invoice.companyname", techhide: true },
    { techlist: "centrename", searchfilt: "row-three", label: "invoice.centrename", techhide: true },
    { techlist: "officetype", searchfilt: "row-four", label: "invoice.offitype", techhide: true },
    { techlist: "branchname", searchfilt: "row-five", label: "invoice.branchname", techhide: true },
    { techlist: "locate", searchfilt: "row-locate", label: "Site Location", techhide: true },
    { techlist: "opalmember", searchfilt: "row-six", label: "invoice.opalmemb", techhide: true },
    { techlist: "projectname", searchfilt: "row-seven", label: "invoice.projname", techhide: true },
    { techlist: "invoicemonth", searchfilt: "row-eight", label: "invoice.invoofthemon", techhide: true },
    { techlist: "totalVehicle", searchfilt: "row-nine", label: "invoice.totalveh", techhide: true },
    { techlist: "invoiceamount", searchfilt: "row-ten", label: "invoice.invoamount", techhide: true },
    { techlist: "paymentstatus", searchfilt: "row-eleven", label: "invoice.status", techhide: true },
    { techlist: "invoicedate", searchfilt: "row-twelve", label: "invoice.invodate", techhide: true },
    { techlist: "invoiceage", searchfilt: "row-thirteen", label: "invoice.invoage", techhide: true },
    { techlist: "genratedon", searchfilt: "row-fourteen", label: "Generated On", techhide: true },
    { techlist: "genratedby", searchfilt: "row-fifteen", label: "Generated By", techhide: true },
    { techlist: "paymentdate", searchfilt: "row-sixteen", label: "invoice.paydate", techhide: true },
    { techlist: "lastupdate", searchfilt: "row-seventeen", label: "Last Updated On", techhide: true },
    { techlist: "lastupdateby", searchfilt: "row-eighteen", label: "Last Updated By", techhide: true },
    { techlist: "action", searchfilt: "row-refresh", label: "invoice.action", techhide: true },

  ];

  filterdata: {
    invoice_no: [],
    company_name: [],
    centre_name: [],
    office_type: [],
    bran_name: [],
    site_locate: [],
    opal_membership: [],
    project_type: [],
    pay_status: [],
    invoice_date: [],
    invoice_age: [],
    payment_date: [],
    invoice_month: [],
    genratedon: [],
    genratedby: [],
    lastupdate: [],
    lastupdateby: [],
  }
  // displayed column
  TechnicalListDatafun(): string[] {
    return this.TechnicalListData.filter(tablelable => tablelable.techhide).map(tablelable => tablelable.techlist);
  }
  // displayed search
  TechnicalListDatasear(): string[] {
    return this.TechnicalListData.filter(tablelable => tablelable.techhide).map(tablelable => tablelable.searchfilt);
  }
  // TechnicalListData = ['invoiceno', 'compannyname', 'centrename', 'officetype', 'branchname','opalmember', 'projectname', 'invoicemonth', 'totallearner', 'invoiceamount', 'paymentstatus', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
  TechnicalData = new MatTableDataSource<technicalEvaluationData>();

  constructor(private translate: TranslateService, public routeid: ActivatedRoute, private route: Router,
    private remoteService: RemoteService, public toastr: ToastrService,
    private service: RoyaltytechService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    ) { }
  i18n(key) {
    return this.translate.instant(key);
  }
  // range date picker
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
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";


  Export() {
    const showCol = [];
    this.TechnicalListData.forEach((col) => {
      if (col.techhide) {
        showCol.push(col.techlist)
      }
    });
    this.service.exportTechIvms(this.page, this.paginator?.pageIndex, this.filterdata, this.filterDataPage, showCol).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
  }
  download(id: any) {
    this.service.downloadIvms(id).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
  }
  ngOnInit(): void {
    this.pageloader = true;
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Invoice Management');

    if (this.isfocalpoint == 1) {
      this.downloadaccess = true;
      this.readaccess = true;
      this.createaccess = true;
      this.updateaccess = true;
      this.deleteaccess = true;
    }

    if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
       console.log(this.useraccess);
      let submodule = 15;
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
          this.route.navigate(['/dashboard/portaladmin'])
        }
      });
    }
    
    this.getData(this.page, 0, "");
    console.log("here", this.TechnicalData.data);

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      } else {
        this.filtername = "إخفاء التصفية";
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          this.ifarabic = false;
        } else {
          this.filtername = "إخفاء التصفية";
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      }
    });
  }
  // column edit function
  selecttechtablelable(event: any) {
    this.selecttechChkbox = event.checked;
    this.TechnicalListData.forEach(item => {
      item.techhide = this.selecttechChkbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // column edit function
  updateSelectAlltechhide(item: any) {
    const CheckedAll = this.TechnicalListData.every(item => item.techhide);
    if (CheckedAll) {
      this.techkBox.checked = true;
    } else {
      this.techkBox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  ngAfterViewInit() {
    this.TechnicalData.sort = this.sort;
    // this.TechnicalData.paginator = this.paginator;
  }
  // tab 2 filter form control
  invoice_no = new FormControl('');
  company_name = new FormControl('');
  centre_name = new FormControl('');
  office_type = new FormControl('');
  bran_name = new FormControl('');
  site_locate = new FormControl('');
  opal_membership = new FormControl('');
  project_type = new FormControl('');
  pay_status = new FormControl('');
  invoice_date = new FormControl('');
  invoice_age = new FormControl('');
  payment_date = new FormControl('');
  invoice_month = new FormControl('');
  genratedon = new FormControl(''); 
  genratedby = new FormControl('');
  lastupdate = new FormControl('');
  lastupdateby = new FormControl('');


  // filter clear filter
  clearFilter() {
    this.invoice_no.reset()
    this.company_name.reset()
    this.centre_name.reset()
    this.office_type.reset()
    this.bran_name.reset()
    this.site_locate.reset()
    this.opal_membership.reset()
    this.project_type.reset()
    this.pay_status.reset()
    this.invoice_date.reset()
    this.invoice_age.reset()
    this.payment_date.reset()
    this.invoice_month.reset()
    this.genratedon.reset();
    this.genratedby.reset();
    this.lastupdate.reset();
    this.lastupdateby.reset();
    $(".clear").trigger("click");
    this.getData(this.page, 0, this.preparedata([], true));
  }
  // paginator
  syncPrimaryPaginator(event: PageEvent) {
    console.log(event);

    this.paginator.pageIndex = event?.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.length = this.listLength;
    this.page = event.pageSize;
    this.getData(this.page, event?.pageIndex, this.filterdata)
  }

  // filter hde and show
  clickedEvent() {
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
  // next button
  nextpayment() {
  }
  next() {
  }
  // view button
  viewTechRoyalty(id: any) {
    this.route.navigate(['/invoicemanagement/rayoltytechivms/'], { queryParams: { roy_pk: btoa(id) } });
  }
  chosenYearHandler(normalizedYear: Moment) {
    const ctrlValue = this.invoice_month.value || moment(); // Initialize with current moment if null
    ctrlValue.set('year', normalizedYear.year());
    this.invoice_month.setValue(ctrlValue);
  }

  chosenMonthHandler(
    normalizedMonth: Moment,
    picker: any) {
    const ctrlValue = this.invoice_month.value || moment();;
    ctrlValue.month(normalizedMonth.month());
    this.invoice_month.setValue(moment(ctrlValue._d)?.format('YYYY-MM'));
    this.datepicker?.close();
    this.filterByMonthAndYear(picker);
  }

  filterByMonthAndYear(formcontrolname: any) {
    var data = {
      searckkey:
      {
        invoice_month: this.invoice_month?.value
      }
      ,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  updatedOnDate(event: any, formcontrolname: any) {
    var data = {
      searckkey:
      {
        start_date: this.lastupdate?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.lastupdate?.value.endDate?.format('YYYY-MM-DD')
      }
      ,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  genrateOnDateFilter(event: any, formcontrolname: any) {
    var data = {
      searckkey:
      {
        start_date: this.genratedon?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.genratedon?.value.endDate?.format('YYYY-MM-DD')
      }
      ,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  InvoiceData(Values) {
    this.regenerateinvoice = true;
  }
  // Regenrate Invoice
  reGenerate(roy_pk: any) {
    // this.regenerateinvoice = false;
    this.service.IvmsreGnerateinvoice(roy_pk).subscribe((data: any) => {
      if (data.data.status) {
        this.toastr.success(data.data.message);
        // window.location.reload();
      } else {
        this.toastr.warning(data.data.message);
      }
      this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
    });
  }
  // Generate Invoice 
  receviceDateValue(formData: any) {
    this.service.IvmsGenerateinvoice(moment(formData._d)?.format('YYYY-MM')).subscribe((data: any) => {
      if (data.data.status) {
        this.toastr.success(data.data.message);
        // window.location.reload();
      } else {
        this.toastr.warning(data.data.message);
      }
      this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
    });
  }

  getData(limit: any, index: any, searchkey: any) {
    this.tableloader = true;
    this.service.getTechIvmsList(limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
      this.tableloader = false;
      this.pageloader = false;
      let response = data.data.data;
      this.listLength = data.data.totalcount;
      this.paginator.length = data.data.totalcount;
      this.setMonthandYear = data.data?.month_count;

      response.compannyname = 'fff';
      if (response.length == 0) {
        this.isData = true;
      } else {
        this.isData = false;
      }

      this.TechnicalData = response;
      // console.log(response);
    });
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
      if (isReset) {
        filterdata[keys] = "";
      } else if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });

    return filterdata;
  }

  // Search
  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  // Office type search
  mltiSelectBranch(event: any, formcontrolname: any) {
    var data = {
      searckkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)

  }
  // Date range Filter
  invoiceDateRangeFilter(event: any, formcontrolname: any) {
    var data = {
      searckkey:
      {
        start_date: this.invoice_date?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.invoice_date?.value.endDate?.format('YYYY-MM-DD')
      }
      ,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }
  invoiceMonthRangeFilter(event: any, formcontrolname: any) {
    var data = {
      searckkey:
      {
        start_date: this.invoice_month?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.invoice_month?.value.endDate?.format('YYYY-MM-DD')
      },
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }
  // Payment range Filter
  paymentDateRangeFilter(event: any, formcontrolname: any) {
    var data = {
      searckkey:
      {
        start_date: this.payment_date?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.payment_date?.value.endDate?.format('YYYY-MM-DD')
      }
      ,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  announceSortChange(sortState: Sort) {
    this.filterDataPage = {
      sortFiled: sortState.direction,
      order: sortState.active
    }
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }
   // setpervios month
   setPerviousmonth() {
    const currentDate = moment();
    const previousMonthStart = currentDate.clone().subtract(1, 'months').startOf('month');
    const previousMonthEnd = currentDate.clone().subtract(1, 'months').endOf('month');

    const initialDateRange = {
      startDate: previousMonthStart.toDate(),
      endDate: previousMonthEnd.toDate(),
    };

    this.invoice_month.setValue(initialDateRange);
       // trggerlast month
       $(document).ready(function() {
        $(".regappLastmonth .ranges ul li:nth-child(6) button").trigger("click"); 
    });
  }
}
