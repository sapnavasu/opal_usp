import { ChangeDetectorRef, Component, ElementRef, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA, MatDialog } from "@angular/material/dialog";
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from "ngx-toastr";
import swal from "sweetalert";
import { MatTableDataSource } from '@angular/material/table';
import { FormControl } from '@angular/forms';
import { MatPaginator, MatPaginatorModule, PageEvent } from '@angular/material/paginator';
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
import { AssessmentFeeService } from '@app/services/assessmentFee.service';
import * as XLSX from 'xlsx';
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

type AOA = any[];

export interface assessmentlistData {
  invoiceno: any;
  trainingprovider_ar: any;
  trainingprovider_en: any;
  officetype: any;
  branchname_en: any;
  branchname_ar: any;
  asmnt_pk: any;
  state_en: any;
  state_ar: any;
  city_en: any;
  city_ar: any;
  as_state_en: any;
  as_state_ar: any;
  as_city_en: any;
  as_city_ar: any;
  as_companyname_ar: any;
  as_companyname_en: any;
  invoicemonth: any;
  totallearner: any;
  invoiceamount: any;
  paymentstatus: any;
  invoicedate: any;
  genratedon: any;
  genratedby: any;
  lastupdate: any;
  lastupdateby: any;
}

const FILTERDATA = {
  invoiceno: [],
  training_provider: [],
  officetype: [],
  branchname: [],
  location: [],
  assessmentcentre: [],
  assessor_locate: [],
  invoice_month: [],
  totallearner: [],
  invoiceamount: [],
  paymentstatus: [],
  genratedon: [],
  genratedby: [],
  lastupdate: [],
  lastupdateby: [],
  invoicedate: [],
  paymentdate: [],
}

// const assessment_Data: assessmentlistData[] = [
//   { invoiceno: 'aeneral Electric',  trainingprovider: 'hmed Bin' ,officetype: 'vain Branch', branchname: 'Al Khelijan Techical service' ,   assessmentcentre: 'cyber Security', assessorofficetype: 'Main Office', assessorbranch: 'Procurement' , invoicemonth: 'jan 2011', totallearner: '2'  , invoiceamount : '105.00', paymentstatus: '2',  invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: '20-1-2023' },
//   { invoiceno: 'aeneral Electric',  trainingprovider: 'hmed Bin' ,officetype: 'vain Branch', branchname: 'Al Khelijan Techical service' ,   assessmentcentre: 'cyber Security', assessorofficetype: 'Main Office', assessorbranch: 'Procurement' , invoicemonth: 'jan 2011', totallearner: '2'  , invoiceamount : '105.00', paymentstatus: '2',  invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: '20-1-2023' },
// ];
@Component({
  selector: 'app-assessmentlist',
  templateUrl: './assessmentlist.component.html',
  styleUrls: ['./assessmentlist.component.scss'],
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
export class AssessmentlistComponent implements OnInit {
  [x: string]: any;
  public mattab = 0;
  public setMonthandYear: number;
  // public pageloader;
  filterDataPage: any = { sort: 'asc', order: '' };
  public pagefullloader: boolean = false;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public page: number = 10;
  public resultsLength: number;
  public tblplaceholder: boolean = false;
  ifarabic: boolean;
  @ViewChild(MatSort) sort: MatSort;
  public selectAllshowhide: boolean = true;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
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
  isData: boolean = false;
  YearMnthInvoice: any;
  dataLength: any;
  filterdata: {
    invoiceno: [],
    training_provider: [],
    officetype: [],
    branchname: [],
    assessmentcentre: [],
    // assessorofficetype: [],
    // assessorbranch: [],
    invoice_month: [],
    totallearner: [],
    invoiceamount: [],
    paymentstatus: [],
    invoiceage: [],
    invoicedate: [],
    paymentdate: [],
    genratedon: [],
    genratedby: [],
    lastupdate: [],
    lastupdateby: [],
  }
  start_Date: Date;
  end_Date: Date;
  selectedDateRange: any;
  @ViewChild('clear', { static: false }) clearButton: ElementRef;

  //  range date picker
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
  constructor(private translate: TranslateService, public routeid: ActivatedRoute, private route: Router,
    private remoteService: RemoteService, public toastr: ToastrService,
    private assessmentService: AssessmentFeeService,
    private cookieService: CookieService,private cdr: ChangeDetectorRef,
    private localstorage: AppLocalStorageServices,
  ) {   }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

  i18n(key) {
    return this.translate.instant(key);
  }
  // table
  AssessmentListData = [
    { tbllist: "invoiceno", searchrow: "row-first", label: "invoice.invonumb", showhide: true },
    { tbllist: "trainingprovider", searchrow: "row-second", label: "invoice.trainname", showhide: true },
    { tbllist: "officetype", searchrow: "row-three", label: "Trainer's Office Type", showhide: true },
    { tbllist: "branchname", searchrow: "row-four", label: "Trainer's Branch Name", showhide: true },
    { tbllist: "centrelocat", searchrow: "row-locat", label: "Training Centre's Location", showhide: true },
    { tbllist: "assessmentcentre", searchrow: "row-five", label: "Assessment Centre", showhide: true },
    { tbllist: "assessorlocat", searchrow: "row-assesslocat", label: "Assessment Centre's Location", showhide: true },
    { tbllist: "invoicemonth", searchrow: "row-eight", label: "Invoice for the Month", showhide: true },
    { tbllist: "totallearner", searchrow: "row-nine", label: "Total Learners", showhide: true },
    { tbllist: "invoiceamount", searchrow: "row-ten", label: "invoice.invoamount", showhide: true },
    // { tbllist: "paymentstatus", searchrow: "row-eleven", label: "invoice.status", showhide: true },
    { tbllist: "invoicedate", searchrow: "row-twelve", label: "invoice.invodate", showhide: true },
    { tbllist: "genratedon", searchrow: "row-thirteen", label: "Generated On", showhide: true },
    { tbllist: "genratedby", searchrow: "row-fourteen", label: "Generated By", showhide: true },
    { tbllist: "lastupdate", searchrow: "row-fifteen", label: "Last Updated On", showhide: true },
    { tbllist: "lastupdateby", searchrow: "row-sixteen", label: "Last Updated By", showhide: true },
    { tbllist: "action", searchrow: "row-seventeen", label: "invoice.action", showhide: true },
  ];
  // displayed column
  AssessmentListDatafun(): string[] {
    return this.AssessmentListData.filter(list => list.showhide).map(list => list.tbllist);
  }
  // displayed search
  AssessmentListDatas(): string[] {
    return this.AssessmentListData.filter(list => list.showhide).map(list => list.searchrow);
  }
  AssessmentData = new MatTableDataSource<assessmentlistData>();

  ngAfterViewInit() {
    this.AssessmentData.sort = this.sort;
    // this.AssessmentData.paginator = this.paginator;
    // this.setPerviousmonth()
  }

  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.page, 0, this.filterdata )
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

  getData(limit: any, index: any, searchkey: any) {
    this.tblplaceholder = true;
    this.assessmentService.getAssessmentFeeList(limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
      this.tblplaceholder = false;
      this.setMonthandYear =data.data?.month_count;
      this.pagefullloader = false;
      let response = data.data.data;
      this.resultsLength = data.data.totalcount;
      this.AssessmentData.data = response;
      if (response.length == 0) {
        this.isData = true;
      } else {
        this.isData = false;
      }
    });
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
        start_date: this.invoicedate?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.invoicedate?.value.endDate?.format('YYYY-MM-DD')
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

  invoiceMonthRangeFilter(event: any, formcontrolname: any) {
    var data = {
      searckkey: {
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
        start_date: this.paymentdate?.value.startDate?.format('YYYY-MM-DD'),
        end_date: this.paymentdate?.value.endDate?.format('YYYY-MM-DD')
      }
      ,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
  }

  ngOnInit(): void {
    this.pagefullloader = true;
     // user permission Start here
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
 
     if (this.isfocalpoint == 2  && this.useraccess[moduleid] != undefined) {
       let submodule = 17;
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y') {
         this.downloadaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y') {
         this.readaccess = true;
 console.log(this.readaccess+"s");

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
 console.log(this.readaccess+"readaccessAsse");
 
     if (this.readaccess == false) {
       this.pagefullloader = false;
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
 
     // user permission End Here
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
    this.AssessmentData.paginator = this.paginator;
    
  }

  // column edit function
  selectAll(event: any) {
    this.selectAllshowhide = event.checked;
    this.AssessmentListData.forEach(item => {
      item.showhide = this.selectAllshowhide;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);  }
  // column edit function
  updateSelectAllshowhide(item: any) {
    const allChecked = this.AssessmentListData.every(item => item.showhide);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
    setTimeout(() => {
     $(".clear").trigger("click");
    }, 
    500);
  }

  // search filter form control
  invoiceno = new FormControl('');
  training_provider = new FormControl('');
  office_type = new FormControl('');
  bran_name = new FormControl('');
  location = new FormControl('');
  assessorcenter = new FormControl('');
  assessor_offic_etype = new FormControl('');
  assessor_branch = new FormControl('');
  assessor_locate = new FormControl('');
  invoice_month = new FormControl('');
  paystatus = new FormControl('');
  invoicedate = new FormControl('');
  invoiceage = new FormControl('');
  paymentdate = new FormControl('');
  assessmentcentre = new FormControl('');
  genratedon = new FormControl(''); 
  genratedby = new FormControl('');
  lastupdate = new FormControl('');
  lastupdateby = new FormControl('');

  // filter hide show
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
  // paginator
  syncPrimaryPaginators(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.length = this.resultsLength;

    this.page = event.pageSize;
    this.getData(this.page, event.pageIndex, this.filterdata);
  }
  
  // filter clear filter

  clearFilter() {
    this.invoiceno.reset();
    this.training_provider.reset();
    this.office_type.reset();
    this.bran_name.reset();
    this.location.reset();
    this.assessorcenter.reset();
    this.assessor_offic_etype.reset();
    this.assessor_branch.reset();
    this.assessor_locate.reset();
    this.invoice_month.reset();
    this.paystatus.reset();
    this.invoicedate.reset();
    this.invoiceage.reset();
    this.paymentdate.reset();
    this.location.reset();
    this.assessmentcentre.reset();
    this.assessor_locate.reset();
    // this.genratedon.reset();
    this.genratedby.reset();
    // this.lastupdate.reset();
    // this.clearButton.nativeElement.click();
    $(".clear").trigger("click");
    this.lastupdateby.reset();
    this.getData(this.page, 0, this.preparedata([], true));
  }
  // next button
  next() {
  }

  // Regenrate Invoice
  reGenerate(asmnt_pk: any, opalmemberregmst_pk: any) {
    // this.regenerateinvoice = false;
    this.assessmentService.reGnerateinvoice(asmnt_pk, opalmemberregmst_pk).subscribe((data: any) => {
      if (data.data.status) {
        this.toastr.success(data.data.message);
      } else {
        this.toastr.warning(data.data.message);
      }
      this.getData(this.page, this.paginator?.pageIndex, this.filterdata);
    });
  }
  // view button
  viewAssessmentFee(id: any) {
    this.route.navigate(['/invoicemanagement/assessmentfee/'], { queryParams: { asmnt_pk: btoa(id) } });
  }
  receviceInvoiceData(Values) {
    if (Values) {
      this.regenerateinvoice = Values;
    }
  }

  // Download button
  listDownload(down_id: any) {
    this.assessmentService.downloadList(down_id).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
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
    this.invoice_month.setValue(moment(ctrlValue._d).format('YYYY-MM'));
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
  // Generate Invoice
  receviceDateValue(formData: any) {
    this.assessmentService.genrateInvoice(moment(formData._d).format('YYYY-MM')).subscribe((data: any) => {
      if (data.data.status) {
        this.toastr.success(data.data.message);
      } else {
        this.toastr.warning(data.data.message);
      }
      this.getData(this.page, this.paginator?.pageIndex, this.filterdata)

    })
  }

  //Export to Excel 
  exportExcel() {
    const showCol = [];
    this.AssessmentListData.forEach((col) => {
      if (col.showhide) {
        showCol.push(col.tbllist)
      }
    });
    this.assessmentService.exportoExcel(this.page, this.paginator.pageIndex, this.filterdata, this.filterDataPage, showCol).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response;
      link.click();
    })
  }

  // For sorting
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
