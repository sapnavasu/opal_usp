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
import { RoyaltyService } from '@app/services/royalty.service';
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
//tab 1
export interface trainingEvaluationData {
  invoiceno: any;
  companyname_en: any;
  companyname_ar: any;
  trainingprovider_ar: any;
  roy_pk: any;
  trainingprovider_en: any;
  // coursetitle_en: any;
  // coursetitle_ar: any;
  appcdt_standardcoursemst_fk: any;
  appcdt_appoffercoursemain_fk: any;
  scm_coursename_en: any;
  scm_coursename_ar: any;
  appocm_coursename_en: any;
  appocm_coursename_ar: any;
  coursecate: any;
  officetype: any;
  branchname_en: any;
  branchname_ar: any;
  subcaten: any;
  subcatar: any;
  city_en: any;
  city_ar: any;
  state_en: any;
  state_ar: any;
  opalmember: any;
  invoice_month: any;
  totallearner: any;
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
  trainingprovider: [],
  coursetitle: [],
  coursecate: [],
  officetype: [],
  branchname: [],
  site_locate: [],
  opalmember: [],
  invoice_month: [],
  totallearner: [],
  invoiceamount: [],
  position: [],
  paymentstatus: [],
  invoiceage: [],
  invoicedate: [],
  paymentdate: [],
  genratedon: [],
  genratedby: [],
  lastupdate: [],
  lastupdateby: [],
}

//tab 1
// const TraingList_Data: trainingEvaluationData[] = [
//   { position: 1, invoiceno: 'INV-999-CRI-2022-3222', compannyname: 'Al Khelijan Techical service', trainingprovider: 'Ahmed Bin', coursetitle: 'Rescue From Height', coursecate: 'Fire ans Safety', officetype: 'Main Branch', branchname: 'Direct Contract', opalmember: 'cyber Security', invoicemonth: 'Jan 2023', totallearner: '2', invoiceamount: '105.000', paymentstatus: 'R', invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: 20 - 1 - 2023 },
//   { position: 2, invoiceno: 'INV-999-CRI-2022-32', compannyname: 'Al Khelijan Techical service', trainingprovider: 'Ahmed Bin', coursetitle: 'Rescue From Height', coursecate: 'Fire ans Safety', officetype: 'Main Branch', branchname: 'Direct Contract', opalmember: 'cyber Security', invoicemonth: 'Jan 2023', totallearner: '2', invoiceamount: '105.000', paymentstatus: 'O', invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: 20 - 1 - 2023 },
// ]
@Component({
  selector: 'app-trainingroyalty',
  templateUrl: './trainingroyalty.component.html',
  styleUrls: ['./trainingroyalty.component.scss'],
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


export class TrainingroyaltyComponent implements OnInit {

  filterdata: {
    invoice_no: any[]; company_name: any[];
    trainingprovider: any[]; officetype: any[]; branchname: any[]; asssessmentcenter: any[]; totallearning: any[]; remainingcapacity: any[]; trainingduration: any[]; coursepartical: any[]; assessmentdatetime: any[]; assessmentwilayat: any[]; assessmentstate: any[]; categories: any[]; language: any[]; status: any[]; serach_civil: any[]; trainingdurationpr: any[]; formcontrolname: any[]; fsgrid: any[];
  };
  filterDataPage: any = { sort: 'asc', order: '' };

  public setMonthandYear: number;
  public pageloader: boolean = false;
  public tbleloader: boolean = false;
  public filtername = "Hide Filter";
  listLength: any;
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public page: number = 10;
  public resultsLength: number;
  public trainingtableload: boolean = false;
  public ifarabic: boolean;
  @ViewChild(MatSort) sort: MatSort;
  sortFiled: any;
  order: any;
  public selecttrainChkbox: boolean = true;
  @ViewChild('trainchkBox') trainchkBox: MatCheckbox;
  isData: boolean = false;

  constructor(private translate: TranslateService, public routeid: ActivatedRoute, private route: Router,
    private remoteService: RemoteService, public toastr: ToastrService,
    private service: RoyaltyService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
  ) {
  }
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

  //table
  TrainingListData = [
    { trainlabel: "invoiceno", searchflt: "row-first", label: "invoice.invonumb", trainhide: true },
    { trainlabel: "company_name", searchflt: "row-second", label: "invoice.companyname", trainhide: true },
    { trainlabel: "trainingprovider", searchflt: "row-three", label: "invoice.trainname", trainhide: true },
    { trainlabel: "coursetitle", searchflt: "row-four", label: "invoice.courtitle", trainhide: true },
    { trainlabel: "coursecate", searchflt: "row-five", label: "invoice.courcate", trainhide: true },
    { trainlabel: "officetype", searchflt: "row-six", label: "invoice.offitype", trainhide: true },
    { trainlabel: "branchname", searchflt: "row-seven", label: "invoice.branchname", trainhide: true },
    { trainlabel: "locate", searchflt: "row-locate", label: "Site Location", trainhide: true },
    { trainlabel: "opalmember", searchflt: "row-eight", label: "invoice.opalmemb", trainhide: true },
    { trainlabel: "invoicemonth", searchflt: "row-nine", label: "invoice.invoofthemon", trainhide: true },
    { trainlabel: "totallearner", searchflt: "row-ten", label: "invoice.totalear", trainhide: true },
    { trainlabel: "invoiceamount", searchflt: "row-eleven", label: "invoice.invoamount", trainhide: true },
    { trainlabel: "paymentstatus", searchflt: "row-twelve", label: "invoice.status", trainhide: true },
    { trainlabel: "invoicedate", searchflt: "row-thirteen", label: "invoice.invodate", trainhide: true },
    { trainlabel: "invoiceage", searchflt: "row-fourteen", label: "invoice.invoage", trainhide: true },
    { trainlabel: "genratedon", searchflt: "row-fifteen", label: "Generated On", trainhide: true },
    { trainlabel: "genratedby", searchflt: "row-sixteen", label: "Generated By", trainhide: true },
    { trainlabel: "paymentdate", searchflt: "row-seventeen", label: "invoice.paydate", trainhide: true },
    { trainlabel: "lastupdate", searchflt: "row-eighteen", label: "Last Updated On", trainhide: true },
    { trainlabel: "lastupdateby", searchflt: "row-nineteen", label: "Last Updated By", trainhide: true },
    { trainlabel: "action", searchflt: "row-refresh", label: "invoice.action", trainhide: true },
  ];
  // displayed column
  TrainingListDatafun(): string[] {
    return this.TrainingListData.filter(trainlist => trainlist.trainhide).map(trainlist => trainlist.trainlabel);
  }
  // displayed search
  TrainingListDatasear(): string[] {
    return this.TrainingListData.filter(trainlist => trainlist.trainhide).map(trainlist => trainlist.searchflt);
  }
  // TrainingListData = ['invoiceno', 'compannyname', 'trainingprovider', 'coursetitle', 'coursecate', 'officetype', 'branchname', 'opalmember', 'invoicemonth', 'totallearner', 'invoiceamount', 'paymentstatus', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
  TrainingData = new MatTableDataSource<trainingEvaluationData>();
  i18n(key) {
    return this.translate.instant(key);
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

  announceSortChange(sortState: Sort) {
    console.log("sortState", sortState);
    // this.sortFiled= sortState.direction
    // this.order = sortState.active

    this.filterDataPage = {
      sortFiled: sortState.direction,
      order: sortState.active
    }
    this.getData(this.page, this.paginator?.pageIndex, this.filterdata)

  }

  // Payment Date range Filter
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
  // Invoice Date range Filter
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

  getData(limit: any, index: any, searchkey: any) {
    this.tbleloader = true;
    this.service.getRolayFeeList(limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
    setTimeout(() => {
      this.tbleloader = false;
      
    }, 1000);
      this.pageloader = false;
      let response = data.data.data;
      this.listLength = data.data.totalcount;
      // response.compannyname = 'fff';
      this.setMonthandYear =data.data?.month_count;
            
      if (response.length == 0) {
        this.isData = true;
      } else {
        this.isData = false;
      }

      this.TrainingData = response;
      // console.log(response);
    });
  }

  mltiSelectBranchredt(event: any, formcontrolname: any) {
    var data = {
      searckkey: event,
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
  searchbatchgrid(searckkey, formcontrolname) {

    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.page, 0, this.filterdata)
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

  ngOnInit(): void {
      this.pageloader = true;
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
     }else{
      this.getData(this.page, 0, "");
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

  }
  // column edit function
  selecttraintablelable(event: any) {
    this.selecttrainChkbox = event.checked;
    this.TrainingListData.forEach(item => {
      item.trainhide = this.selecttrainChkbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // column edit function
  updateSelectAlltrainhide(item: any) {
    const CheckedAll = this.TrainingListData.every(item => item.trainhide);
    if (CheckedAll) {
      this.trainchkBox.checked = true;
    } else {
      this.trainchkBox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  ngAfterViewInit() {
    this.TrainingData.sort = this.sort;
    this.TrainingData.paginator = this.paginator;

    this.routeid.queryParams.subscribe(params => {
      if(params['statusVal']){
         this.paymentstatus.setValue([params['statusVal']]);
         this.mltiSelectBranchredt([params['statusVal']],'paymentstatus');
     }
   });
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
  //tab 1 FORM CONTROL SEARCH FILTER  
  invoice_no = new FormControl('');
  company_name = new FormControl('');
  training_provider = new FormControl('');
  course_title = new FormControl('');
  course_cate = new FormControl('');
  office_type = new FormControl('');
  bran_name = new FormControl('');
  site_locate = new FormControl('');
  opal_membership = new FormControl('');
  paymentstatus = new FormControl('');
  invoicedate = new FormControl('');
  invoice_age = new FormControl('');
  paymentdate = new FormControl('');
  invoice_month = new FormControl('')
  genratedon = new FormControl(''); 
  genratedby = new FormControl('');
  lastupdate = new FormControl('');
  lastupdateby = new FormControl('');
  // paginator
  syncPrimaryPaginator(event: PageEvent) {
    console.log(event);

    this.paginator.pageIndex = event?.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.length = this.listLength;
    this.page = event.pageSize;
    this.getData(this.page, event?.pageIndex, this.filterdata)
  }
  // filter clear filter
  clearFilter() {
    this.invoice_no.reset()
    this.company_name.reset()
    this.training_provider.reset()
    this.course_title.reset()
    this.course_cate.reset()
    this.office_type.reset()
    this.bran_name.reset()
    this.site_locate.reset()
    this.opal_membership.reset()
    this.invoice_month.reset()
    this.paymentstatus.reset()
    this.invoicedate.reset()
    this.invoice_age.reset()
    this.paymentdate.reset()
    this.genratedon.reset();
    this.genratedby.reset();
    this.lastupdate.reset();
    this.lastupdateby.reset();
    $(".clear").trigger("click");
    this.getData(this.page, 0, this.preparedata([], true));
  }
  // next button
  next() {
  }
  // view button
  view(id: any) {
    this.route.navigate(['/invoicemanagement/royaltyfeepayment/'], { queryParams: { roy_pk: btoa(id) } });
  }
  chosenYearHandler(normalizedYear: Moment) {
    const ctrlValue = this.invoice_month.value || moment(); // Initialize with current moment if null
    ctrlValue.set('year', normalizedYear.year());
    this.invoice_month.setValue(ctrlValue);
  }

  // Download button
  download(down_id: any) {
    this.service.downloadList(down_id).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
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
  
  chosenMonthHandler(
    normalizedMonth: Moment,
    picker: any) {
    const ctrlValue = this.invoice_month.value || moment();;
    ctrlValue.month(normalizedMonth.month());
    this.invoice_month.setValue(moment(ctrlValue._d)?.format('YYYY-MM'));
    this.datepicker?.close();
    this.filterByMonthAndYear(picker);
  }
  InvoiceData(Values) {
    this.regenerateinvoice = true;
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

  // Export to excel 
  ExportExcel() {
    const showCol = [];
     this.TrainingListData.forEach( (col) => {
     if(col.trainhide){
      showCol.push(col.trainlabel)
     }
   });
    this.service.exportToExcel(this.page, this.paginator?.pageIndex, this.filterdata, this.filterDataPage, showCol).subscribe((data: any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    });
  }

  // Generate Invoice 
  receviceDateValue(formData: any) {
    this.service.generateinvoice(moment(formData._d)?.format('YYYY-MM')).subscribe((data: any) => {
      if (data.data.status) {
        this.toastr.success(data.data.message);
        // window.location.reload();
      } else {
        this.toastr.warning(data.data.message);
      }
      this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
    });
  }

  //Re Generate Invoice 
  reGenInvoice(roy_pk: any) {
    this.service.reGnerateinvoice(roy_pk).subscribe((data: any) => {
      if (data.data.status) {
        this.toastr.success(data.data.message);
        // window.location.reload();
      } else {
        this.toastr.warning(data.data.message);
      }
      this.getData(this.page, this.paginator?.pageIndex, this.filterdata)
    });
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
    $(document).ready(function() {
      $(".regappLastmonth .ranges ul li:nth-child(6) button").trigger("click"); 
  });
  }
}
