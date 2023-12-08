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
import { MatSort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { MatCheckbox } from '@angular/material/checkbox';
import {  MomentDateAdapter,  MAT_MOMENT_DATE_ADAPTER_OPTIONS,} from '@angular/material-moment-adapter';
import {  DateAdapter,  MAT_DATE_FORMATS,  MAT_DATE_LOCALE,} from '@angular/material/core';
import { MatDatepicker } from '@angular/material/datepicker';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';

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
export interface operatorlistData {
  invoiceno: any;
  trainingprovider: any;
  officetype: any;
  branchname: any;
  opalmember: any;
  operatorname: any;
  invoicemonth: any;
  totallearner: any;
  invoiceamount: any;
  paymentstatus: any;
  invoiceage: any;
  invoicedate: any;
  paymentdate: any;
}
const operator_Data: operatorlistData[] = [
  { invoiceno: 'General Electric', trainingprovider: 'Ahmed Bin', officetype: 'Main Branch', branchname: 'Al Khelijan Techical service', opalmember: 'cyber Security', operatorname: 'Main Office', invoicemonth: 'jan 2011', totallearner: '2', invoiceamount: '105.00', paymentstatus: '2', invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: '20-1-2023' },

];;
@Component({
  selector: 'app-trainingoperator',
  templateUrl: './trainingoperator.component.html',
  styleUrls: ['./trainingoperator.component.scss'],
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
export class TrainingoperatorComponent implements OnInit {
  public mattab = 0;
  public pageloader;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public page: number = 10;
  public resultsLength: number;
  public tablelodaerlist: boolean = false;
  ifarabic: boolean;
  @ViewChild(MatSort) sort: MatSort;
  public selecttrainChkbox: boolean = true;
  @ViewChild('trainchkBox') trainchkBox: MatCheckbox;
  constructor(private translate: TranslateService, public routeid: ActivatedRoute, private route: Router,
    private remoteService: RemoteService, public toastr: ToastrService,
    private cookieService: CookieService,) { }
    @ViewChild('invoice_picker') datepicker: MatDatepicker<any>;

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

  i18n(key) {
    return this.translate.instant(key);
  }
  // table
  TrainingListData = [
    { trainlabel: "invoiceno", searchflt: "row-first", label: "invoice.invonumb", trainhide: true },
    { trainlabel: "trainingprovider", searchflt: "row-second", label: "invoice.trainname", trainhide: true },
    { trainlabel: "officetype", searchflt: "row-three", label: "invoice.offitype", trainhide: true },
    { trainlabel: "branchname", searchflt: "row-four", label: "invoice.branchname", trainhide: true },
    { trainlabel: "opalmember", searchflt: "row-five", label: "invoice.opalmemb", trainhide: true },
    { trainlabel: "operatorname", searchflt: "row-six", label: "Operator Name", trainhide: true },
    { trainlabel: "invoicemonth", searchflt: "row-eight", label: "Invoice for the Month", trainhide: true },
    { trainlabel: "totallearner", searchflt: "row-nine", label: "Total Learners", trainhide: true },
    { trainlabel: "invoiceamount", searchflt: "row-ten", label: "invoice.invoamount", trainhide: true },
    { trainlabel: "paymentstatus", searchflt: "row-eleven", label: "invoice.status", trainhide: true },
    { trainlabel: "invoicedate", searchflt: "row-twelve", label: "invoice.invodate", trainhide: true },
    { trainlabel: "invoiceage", searchflt: "row-thirteen", label: "invoice.invoage", trainhide: true },
    { trainlabel: "paymentdate", searchflt: "row-fourteen", label: "invoice.paydate", trainhide: true },
    { trainlabel: "action", searchflt: "row-fifteen", label: "invoice.action", trainhide: true },
  ];
  // displayed column
  TrainingListDatafun(): string[] {
    return this.TrainingListData.filter(trainlist => trainlist.trainhide).map(trainlist => trainlist.trainlabel);
  }
  // displayed search
  TrainingListDatasear(): string[] {
    return this.TrainingListData.filter(trainlist => trainlist.trainhide).map(trainlist => trainlist.searchflt);
  }
  // TrainingListData = ['invoiceno', 'trainingprovider', 'officetype' , 'branchname'  ,  'opalmember'  , 'operatorname', 'invoicemonth' , 'totallearner'  , 'invoiceamount' , 'paymentstatus' ,  'invoicedate',  'invoiceage', 'paymentdate', 'action'];
  trainingData = new MatTableDataSource<operatorlistData>(operator_Data);

  ngOnInit(): void {
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
  }
  // column edit function
  updateSelectAlltrainhide(item: any) {
    const CheckedAll = this.TrainingListData.every(item => item.trainhide);
    if (CheckedAll) {
      this.trainchkBox.checked = true;
    } else {
      this.trainchkBox.checked = false;
    }
  }
  // search filter form control
  invoice_no = new FormControl('');
  training_provider = new FormControl('');
  office_type = new FormControl('');
  bran_name = new FormControl('');
  opal_member = new FormControl('');
  operator_name = new FormControl('');
  invoice_month = new FormControl('');
  paystatus = new FormControl('');
  invoicedate = new FormControl('');
  invoiceage = new FormControl('');
  paymentdate = new FormControl('');

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
    this.page = event.pageSize;
  }
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
  // filter clear filter
  clearFilter() {
    this.invoice_no.reset()
    this.training_provider.reset()
    this.office_type.reset()
    this.bran_name.reset()
    this.opal_member.reset()
    this.operator_name.reset()
    this.invoice_month.reset()
    this.paystatus.reset()
    this.invoicedate.reset()
    this.invoiceage.reset()
    this.paymentdate.reset()

  }
  // next button
  next() {
  }
  // view button
  viewoperatorFee() {
    this.route.navigate(['/invoicemanagement/trainingconductviw']);
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
    this.invoice_month.setValue(ctrlValue);
    this.datepicker?.close();
  }
}
