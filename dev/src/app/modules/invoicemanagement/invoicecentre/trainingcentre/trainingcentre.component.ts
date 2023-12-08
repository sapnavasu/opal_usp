import { Component, OnInit, ViewChild, ViewEncapsulation } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { MatDialogRef, MAT_DIALOG_DATA, MatDialog } from "@angular/material/dialog";
import { TranslateService } from "@ngx-translate/core";
import { RemoteService } from "@app/remote.service";
import { CookieService } from "ngx-cookie-service";
import { ToastrService } from "ngx-toastr";
import swal from "sweetalert";
import { MatTableDataSource } from "@angular/material/table";
import { FormControl } from "@angular/forms";
import { MatPaginator, PageEvent } from "@angular/material/paginator";
import { MatTabGroup } from "@angular/material/tabs";
import { LocaleConfig } from "ngx-daterangepicker-material";
import moment from "moment";
import { MatSort, Sort } from "@angular/material/sort";
import { ActivatedRoute, Router } from "@angular/router";
import { MatCheckbox } from "@angular/material/checkbox";
import { environment } from "@env/environment";
import { Encrypt } from "@app/common/class/encrypt";
import { CenterCertificationService } from "@app/services/center-certification.service";
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatDatepickerInput } from "@angular/material/datepicker";

//tab 1
export interface trainingEvaluationData {
  apid_invoiceno: any;
  omrm_companyname_en: any;
  omrm_companyname_ar: any;
  omrm_tpname_en: any;
  omrm_tpname_ar: any;
  appiim_officetype: any;
  appiim_branchname_en: any;
  omrm_opalmembershipregnumber: any;
  fsm_feestype: any;
  total: any;
  apid_invoicestatus: any;
  apid_paymenttype: any;
  invdate: any;
  pymtdate: any;
  agedate: any;
}

const FILTER_DATA = {
  invoice_no: [],
  company_name: [],
  training_provider: [],
  officetype: [],
  bran_name: [],
  opal_membership: [],
  Fee_type: [],
  pay_status: [],
  pay_type: [],
  invoice_date: [],
  invoice_age: [],
  payment_date: [],
};

//tab 1
// const TraingList_Data: trainingEvaluationData[] = [
//   { invoiceno: 'INV-999-CRI-2022-32', compannyname: 'Al Khelijan Techical service', trainingprovider: 'Ahmed Bin', officetype: 'Main Branch', branchname: 'Direct Contract', opalmember: 'cyber Security', Feetype: 'Centre Recognisation(Initial)', invoiceamount: '105.000', paymentstatus: 'R', paymenttype: 'O', invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: 20 - 1 - 2023 },
//   { invoiceno: 'INV-999-CRI-2022-32', compannyname: 'Al Khelijan Techical service', trainingprovider: 'Ahmed Bin', officetype: 'Main Branch', branchname: 'Direct Contract', opalmember: 'cyber Security', Feetype: 'Centre Recognisation(Initial)', invoiceamount: '105.000', paymentstatus: 'P', paymenttype: 'CH', invoicedate: '23-04-2024', invoiceage: '20 Days', paymentdate: 20 - 1 - 2023 },

// ];

@Component({
  selector: "app-trainingcentre",
  templateUrl: "./trainingcentre.component.html",
  styleUrls: ["./trainingcentre.component.scss"],
  encapsulation: ViewEncapsulation.None,
})
export class TrainingcentreComponent implements OnInit {
  public loaderfullpage: boolean = false;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild("MatTabGroup") tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public centerCert: any;
  public filterDataPage: any;
  public searchKey: {} = {};
  public page: number = 10;
  public resultsLength: number;
  public trainingtableload: boolean = false;
  public ifarabic: boolean;
  public TraingList_Data!: trainingEvaluationData[];
  public tablelodaerlist: boolean = false;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;

  invoice_no = new FormControl("");
  company_name = new FormControl("");
  training_provider = new FormControl("");
  officetype = new FormControl("");
  bran_name = new FormControl("");
  opal_membership = new FormControl("");
  Fee_type = new FormControl("");
  pay_status = new FormControl("");
  pay_type = new FormControl("");
  invoice_date = new FormControl("");
  invoice_age = new FormControl("");
  payment_date = new FormControl("");

  @ViewChild(MatSort) sort: MatSort;
  public selectChkbox: boolean = true;
  @ViewChild("trainchkbox") trainchkbox: MatCheckbox;
  filterdata = FILTER_DATA;
  start_invoice_date: any;
  end_invoice_date: any;
  norecord: boolean;
  public trainingtbleload: boolean = false;
  @ViewChild('datepicker') datepicker: MatDatepickerInput<any>;
  constructor(
    private translate: TranslateService,
    public routeid: ActivatedRoute,
    private route: Router,
    private remoteService: RemoteService,
    public toastr: ToastrService,
    private cookieService: CookieService,
    private certService: CenterCertificationService,
    private http: HttpClient,
    private security: Encrypt,
    private localstorage: AppLocalStorageServices,
  ) {}

  languagelist = [
    { id: "1", languageName: "English", languagecode: "en", CountryMst_Pk: "136", dir: "ltr" },
    { id: "2", languageName: "Arabic", languagecode: "ar", CountryMst_Pk: "31", dir: "rtl" },
  ];
  dir = "ltr";

  i18n(key) {
    return this.translate.instant(key);
  }
  //tab 1
  // TrainingListData = ['invoiceno', 'compannyname', 'trainingprovider', 'officetype', 'branchname', 'opalmember','Feetype', 'invoiceamount', 'paymentstatus', 'paymenttype', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];

  TrainingListData = [
    { trainlist: "invoiceno", searchflt: "row-first", label: "invoice.invonumb", tarinhide: true },
    { trainlist: "compannyname", searchflt: "row-second", label: "invoice.companyname", tarinhide: true },
    { trainlist: "trainingprovider", searchflt: "row-three", label: "invoice.trainname", tarinhide: true },
    { trainlist: "officetype", searchflt: "row-four", label: "invoice.offitype", tarinhide: true }  ,
    { trainlist: "branchname", searchflt: "row-five", label: "invoice.branchname", tarinhide: false },
    { trainlist: "opalmember", searchflt: "row-six", label: "invoice.opalmemb", tarinhide: true },
    { trainlist: "fsm_feestype", searchflt: "row-seven", label: "invoice.fee", tarinhide: true },
    { trainlist: "invoiceamount", searchflt: "row-eight", label: "invoice.invoamount", tarinhide: true },
    { trainlist: "paymentstatus", searchflt: "row-nine", label: "invoice.status", tarinhide: true },
    { trainlist: "paymenttype", searchflt: "row-ten", label: "invoice.paymtype", tarinhide: true },
    { trainlist: "invoicedate", searchflt: "row-eleven", label: "invoice.invodate", tarinhide: true },
    { trainlist: "invoiceage", searchflt: "row-twelve", label: "invoice.invoage", tarinhide: true },
    { trainlist: "paymentdate", searchflt: "row-thirteen", label: "invoice.paydate", tarinhide: true },
    { trainlist: "action", searchflt: "row-fifteen", label: "invoice.action", tarinhide: true },
  ];
  // displayed column
  TrainingListDatafun(): string[] {
    return this.TrainingListData.filter((tablelable) => tablelable.tarinhide).map((tablelable) => tablelable.trainlist);
  }
  // displayed search
  TrainingListDatasear(): string[] {
    return this.TrainingListData.filter((tablelable) => tablelable.tarinhide).map((tablelable) => tablelable.searchflt);
  }

  TrainingData = new MatTableDataSource<trainingEvaluationData>(this.TraingList_Data);

  // range date picker
  locale: LocaleConfig = {
    format: "DD-MM-YYYY",
  };

  announceSortChange(sortState: Sort) {
    console.log("sortState", sortState);
    // this.sortFiled= sortState.direction
    // this.order = sortState.active

    this.filterDataPage = {
      sortFiled: sortState.active,
      order: sortState.direction,
    };
    this.getData(null, this.page, this.paginator.pageIndex, this.filterdata, this.filterDataPage);
  }

  ranges: any = {
    Today: [moment(), moment()],
    Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
    "Last 7 Days": [moment().subtract(6, "days"), moment()],
    "Last 30 Days": [moment().subtract(29, "days"), moment()],
    "This Month": [moment().startOf("month"), moment().endOf("month")],
    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
  };
  ngOnInit(): void {
    this.loaderfullpage = true;
    if (
      this.cookieService.get("languageCookieId") &&
      this.cookieService.get("languageCookieId") != undefined &&
      this.cookieService.get("languageCookieId") != null
    ) {
      const toSelect = this.languagelist.find((c) => c.id === this.cookieService.get("languageCookieId"));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == "en") {
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      } else {
        this.filtername = "إخفاء التصفية";
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find((c) => c.id == "1");
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe((data) => {
      if (
        this.cookieService.get("languageCookieId") &&
        this.cookieService.get("languageCookieId") != undefined &&
        this.cookieService.get("languageCookieId") != null
      ) {
        const toSelect = this.languagelist.find((c) => c.id === this.cookieService.get("languageCookieId"));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == "en") {
          this.filtername = "Hide Filter";
          this.ifarabic = false;
        } else {
          this.filtername = "إخفاء التصفية";
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find((c) => c.id == "1");
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      }
    });

    // user permission Start here
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Invoice Management');

    if(this.isfocalpoint == 1){
      this.downloadaccess = true;
      this.readaccess = true;
      this.createaccess = true;
      this.updateaccess = true;
      this.deleteaccess = true;
    }

    if(this.isfocalpoint == 2){

      let submodule = 13 ;
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y'){
        this.downloadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y'){
        this.readaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].create == 'Y'){
        this.createaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].update == 'Y'){
        this.updateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].delete == 'Y'){
        this.deleteaccess = true;
      }
    }

    if(this.readaccess == false){
      this.loaderfullpage = false;
      swal({
        title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
        text: '',
        icon: 'warning',
        buttons: [false,this.i18n('Ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.route.navigate(['/dashboard/portaladmin'])        
        }
      });
    }

    // user permission End Here
    let data = {
      sort: "asc",
      page: 0,
      size: 10,
      searchKey: {},
    };
    this.trainingtbleload = true;
    this.certService.getcentercertidtls(data).subscribe((res) => {
    this.trainingtbleload = false;

      this.loaderfullpage = false;
      this.tablelodaerlist = true;
      this.TraingList_Data = res?.data?.data;
      this.resultsLength = res?.data?.totalcount;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.paginator.length = res?.data?.totalcount;
      this.paginator.pageSize = res?.data?.size;
      this.TrainingData = new MatTableDataSource<trainingEvaluationData>(this.TraingList_Data);
      this.tablelodaerlist = false;
    });
  }

  // column edit function
  selectAlltablelable(event: any) {
    this.selectChkbox = event.checked;
    this.TrainingListData.forEach((item) => {
      item.tarinhide = this.selectChkbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }

  // column edit function
  updateSelectAlltarinhide(item: any) {
    const CheckedAll = this.TrainingListData.every((item) => item.tarinhide);
    if (CheckedAll) {
      this.trainchkbox.checked = true;
    } else {
      this.trainchkbox.checked = false;
    }
    this.datepicker.value.clear();
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
           this.pay_status.setValue([params['statusVal']]);
           this.mltiSelectSearchredt([params['statusVal']],'pay_status');
       }
     });
  }

  searchCenterCert(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname,
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.sort, this.paginator.pageIndex, this.paginator.pageSize, this.filterdata);
  }

  dateClicked(event, formcontrolname) {
    if (!event.endDate) return;
    console.log("event", event);
    var data = {
      searckkey: {
        startDate: event?.startDate.format("DD-MM-YYYY"),
        endDate: event?.endDate.format("DD-MM-YYYY"),
      },
      formcontrolname: formcontrolname,
    };

    this.filterdata = this.preparedata(data);
    this.getData(this.sort, this.paginator.pageIndex, this.paginator.pageSize, this.filterdata);
  }

  mltiSelectSearchredt(event: any, formcontrolname: any) {
    var data = {
      searckkey: event,
      formcontrolname: formcontrolname,
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.sort, this.paginator.pageIndex, this.paginator.pageSize, this.filterdata);
  }

  mltiSelectSearch(event: any, formcontrolname: any) {
    var data = {
      searckkey: event.value,
      formcontrolname: formcontrolname,
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.sort, this.paginator.pageIndex, this.paginator.pageSize, this.filterdata);
  }

  preparedata(data) {
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTER_DATA;
    } else {
      filterdata = this.filterdata;
    }

    Object.keys(filterdata).forEach((keys) => {
      if (keys == data["formcontrolname"]) {
        filterdata[keys] = data["searckkey"];
      }
    });

    return filterdata;
  }

  getData(sort: any, page: number, size: number, searchData: any, filterDataPage: any = null) {
    console.log("getdata", filterDataPage);
    let data = {
      page: page,
      size: size,
      searchkey: searchData,
      sort: filterDataPage?.sortFiled,
      order: filterDataPage?.order,
    };

    console.log(data);
    this.trainingtbleload = true;
    this.certService.getcentercertidtls(data).subscribe((res) => {
      this.trainingtbleload = false;
      this.tablelodaerlist = true;
      this.TraingList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.resultsLength = res?.data?.totalcount;
      this.paginator.length = res?.data?.totalcount;
      this.paginator.pageSize = res?.data?.size;
      this.TrainingData = new MatTableDataSource<trainingEvaluationData>(this.TraingList_Data);
      this.tablelodaerlist = false;
    });
  }

  // filter hde and show
  clickedEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n("Show Filter");
      const id = document.getElementById("searchrow") as HTMLElement;
      id.style.display = "none";
    } else {
      this.filtername = this.i18n("Hide Filter");
      const id = document.getElementById("searchrow") as HTMLElement;
      id.style.display = "flex";
    }
  }

  // paginator
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;

    let data = {
      sort: "asc",
      page: event.pageIndex,
      size: event.pageSize,
      searchKey: {},
    };

    this.loaderfullpage = true;
     this.trainingtbleload = true;
    this.certService.getcentercertidtls(data).subscribe((res) => {
      this.trainingtbleload = false;
      this.loaderfullpage = false;
      this.tablelodaerlist = true;
      this.TraingList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.resultsLength = res?.data?.totalcount;
      this.paginator.length = res?.data?.totalcount;
      this.paginator.pageSize = res?.data?.size;
      this.TrainingData = new MatTableDataSource<trainingEvaluationData>(this.TraingList_Data);
      this.tablelodaerlist = false;
    });
  }
  //tab 1 filter form control

  // filter clear filter
  clearFilter() {
    this.invoice_no.reset();
    this.company_name.reset();
    this.training_provider.reset();
    this.officetype.reset();
    this.bran_name.reset();
    this.opal_membership.reset();
    this.Fee_type.reset();
    this.pay_status.reset();
    this.pay_type.reset();
    this.invoice_date.reset();
    this.invoice_age.reset();
    this.payment_date.reset();
    // this.filterdata = null;
    this.datepicker.value = null;
    
      $(".clear").trigger("click");
    
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTER_DATA;
    } else {
      filterdata = this.filterdata;
    }

    Object.keys(this.filterdata).forEach((keys) => {
      filterdata[keys] = "";
    });

    
    let data = {
      sort: "asc",
      page: 0,
      size: 10,
      searchKey: filterdata,
    };

    this.trainingtbleload = true;
    this.certService.getcentercertidtls(data).subscribe((res) => {
      this.trainingtbleload = false;
      this.tablelodaerlist = true;
      this.TraingList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.resultsLength = res?.data?.totalcount;
      this.paginator.length = res?.data?.totalcount;
      this.paginator.pageSize = res?.data?.size;
      this.TrainingData = new MatTableDataSource<trainingEvaluationData>(this.TraingList_Data);
      this.tablelodaerlist = false;
    });
  }
  // next button
  next() {}
  // view button
  view(id: number) {
    // console.log("view", id);
    this.route.navigate([`/invoicemanagement/tariningpayment/`], { queryParams: { id: this.security.encrypt(id) } });
  }

  exportData() {
    var gridsearchvalue = {};
    gridsearchvalue = {
      invoice_no: this.invoice_no.value,
      company_name: this.company_name.value,
      training_provider: this.training_provider.value,
      officetype: this.officetype.value,
      bran_name: this.bran_name.value,
      opal_membership: this.opal_membership.value,
      Fee_type: this.Fee_type.value,
      pay_status: this.pay_status.value,
      pay_type: this.pay_type.value,
      invoice_date: this.invoice_date.value,
      invoice_age: this.invoice_age.value,
      payment_date: this.payment_date.value
    };
    const sign = this.sort.direction === "desc" ? "-" : "";
    //const href = environment.baseUrl + 'cm/coursemanagement/Exportdata';

    //this.fullPageLoaders = true;

    const showCol = [];
    this.TrainingListData.forEach( (col) => {
      if(col.tarinhide){
        showCol.push(col.trainlist)
      }
    })

    this.certService.exportData(
      sign + this.sort.active,
      this.sort.direction,
      this.paginator.pageIndex - 1,
      this.page,
      gridsearchvalue,
      this.TraingList_Data,
      showCol,
    ).subscribe((res) => {
      if (res.data.status == 1) {
        window.open(res.data.attend, "_blank");
        //this.fullPageLoaders = false;
      }
    });
  }
}
