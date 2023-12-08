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
import moment from 'moment';
import { MatSort, Sort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { MatCheckbox } from '@angular/material/checkbox';
import { TechnicalCenterService } from '@app/services/technical-center.service';
import { Encrypt } from "@app/common/class/encrypt";
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

//tab 2
export interface technicalEvaluationData {
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
  modelno:[],
  officetype: [],
  bran_name: [],
  opal_membership: [],
  Fee_type: [],
  pay_status: [],
  pay_type: [],
  invoice_date: [],
  invoice_age: [],
  payment_date: [],
  noof_staff: [],
  project_name: [],
};

@Component({
  selector: 'app-ivmscentre',
  templateUrl: './ivmscentre.component.html',
  styleUrls: ['./ivmscentre.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class IvmscentreComponent implements OnInit {
  public loaderforpage: boolean = false;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public centerCert: any;
  public filterDataPage: any;
  public searchKey: {} = {};
  public page: number = 10;
  public resultsLength: number;
  public trainingtableload: boolean = false;
  public ifarabic: boolean;
  public TechnicalList_Data!: technicalEvaluationData[];
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;

  @ViewChild(MatSort) sort: MatSort;
  public selectAllchkbox: boolean = true;
  @ViewChild('Allchkbox') Allchkbox: MatCheckbox;
  filterdata = FILTER_DATA;
  norecord: boolean;
  constructor(
    private translate: TranslateService,
    public routeid: ActivatedRoute,
    private route: Router,
    private remoteService: RemoteService, 
    public toastr: ToastrService, 
    private cookieService: CookieService,
    private technicalService: TechnicalCenterService,
    private security: Encrypt,
    private localstorage: AppLocalStorageServices,
    ) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

  i18n(key) {
    return this.translate.instant(key);
  }
  // table
  // TechnicalListData = ['invoiceno', 'compannyname', 'centrename', 'officetype', 'branchname', 'opalmember', 'projectname', 'Feetype', 'noofstaff', 'invoiceamount', 'paymentstatus', 'paymenttype', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
  TechnicalListData = [
    { tbllist: "invoiceno", searchrow: "row-first",label: "invoice.invonumb", showhide: true },
    { tbllist: "compannyname", searchrow: "row-second",label: "invoice.companyname",showhide: true},
    { tbllist: "trainingprovider", searchrow: "row-three",label: "invoice.trainname", showhide: true },
    { tbllist: "modelno", searchrow: "row-seventeen",label: "Device Model Number", showhide: true },
    { tbllist: "officetype", searchrow: "row-four",label: "invoice.offitype",showhide: true},
    { tbllist: "branchname", searchrow: "row-five",label: "invoice.branchname", showhide: false },
    { tbllist: "opalmember", searchrow: "row-six",label: "invoice.opalmemb",showhide: true},
    { tbllist: "projectname", searchrow: "row-seven",label: "invoice.projname",showhide: true},
    { tbllist: "fsm_feestype", searchrow: "row-eight",label: "invoice.fee",showhide: true},
    { tbllist: "apid_noofstaffeval", searchrow: "row-nine",label: "invoice.nostaff", showhide: true },
    { tbllist: "invoiceamount", searchrow: "row-ten",label: "invoice.invoamount",showhide: true},
    { tbllist: "paymentstatus", searchrow: "row-eleven",label: "invoice.status", showhide: true },
    { tbllist: "paymenttype", searchrow: "row-twelve",label: "invoice.paymtype",showhide: true},
    { tbllist: "invoicedate", searchrow: "row-thirteen",label: "invoice.invodate",showhide: true},
    { tbllist: "invoiceage", searchrow: "row-fourteen",label: "invoice.invoage", showhide: true },
    { tbllist: "paymentdate", searchrow: "row-fifteen",label: "invoice.paydate",showhide: true},
    { tbllist: "action", searchrow: "row-sixteen",label: "invoice.action",showhide: true},
  ];
    // displayed column
    TechnicalListDatafun(): string[] {
      return this.TechnicalListData.filter(item => item.showhide).map(item => item.tbllist);
    }
    // displayed search
    TechnicalListDatasear(): string[] {
      return this.TechnicalListData.filter(item => item.showhide).map(item => item.searchrow);
    }
    TechnicalData = new MatTableDataSource<technicalEvaluationData>(this.TechnicalList_Data);

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

    if(this.isfocalpoint == 2  && this.useraccess[moduleid] != undefined){
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
      this.loaderforpage = false;
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
       
    this.loaderforpage = true;
    this.trainingtableload = true;
    this.technicalService.gettechnicalIvms(data).subscribe((res) => {
      console.log(res.data.totalcount,'resres');
      
      this.loaderforpage = false;
      this.trainingtableload = false;
      this.TechnicalList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.paginator.length = res?.data?.totalcount;
      this.resultsLength = res?.data?.totalcount
      this.paginator.pageSize = res?.data?.size;
      this.TechnicalData = new MatTableDataSource<technicalEvaluationData>(this.TechnicalList_Data);
      // this.trainingtableload = false;

    });
    
  }

  ngAfterViewInit() {
    this.TechnicalData.sort = this.sort;
    this.TechnicalData.paginator = this.paginator;
  }
  // column edit function
  selectAllitem(event: any) {
    this.selectAllchkbox = event.checked;
    this.TechnicalListData.forEach(item => {
      item.showhide = this.selectAllchkbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // column edit function
  updateSelectAllshowhide(item: any) {
    const CheckedAll = this.TechnicalListData.every(item => item.showhide);
    if (CheckedAll) {
      this.Allchkbox.checked = true;
    } else {
      this.Allchkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // tab 2
  invoice_no = new FormControl('');
  company_name = new FormControl('');
  training_provider = new FormControl("");
  modelno = new FormControl("");
  office_type = new FormControl('');
  bran_name = new FormControl('');
  opal_membership = new FormControl('');
  Fee_type = new FormControl('');
  // project_type = new FormControl('');
  // noof_staff = new FormControl('');
  pay_status = new FormControl('');
  pay_type = new FormControl('');
  invoice_date = new FormControl('');
  invoice_age = new FormControl('');
  payment_date = new FormControl('');

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
  //  paginator
  syncPrimaryPaginators(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;

    let data = {
      sort: "asc",
      page: event.pageIndex,
      size: event.pageSize,
      searchKey: {},
    };

    this.loaderforpage = true;
    this.trainingtableload = true;
    this.technicalService.gettechnicalIvms(data).subscribe((res) => {
      this.loaderforpage = false;
      this.trainingtableload = false;
      this.TechnicalList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.paginator.length = res?.data?.totalcount;
      this.paginator.pageSize = res?.data?.size;
      this.resultsLength = res?.data?.totalcount
      this.TechnicalData = new MatTableDataSource<technicalEvaluationData>(this.TechnicalList_Data);

    });
  }
  //  filter clear fumction
  clearFilter() {
    this.invoice_no.reset()
    this.company_name.reset()
    // this.centre_name.reset()
    this.office_type.reset()
    this.bran_name.reset()
    this.opal_membership.reset()
    this.Fee_type.reset()
    // this.project_type.reset()
    // this.noof_staff.reset()
    this.pay_status.reset()
    this.pay_type.reset()
    this.invoice_age.reset()
    this.invoice_date.reset()
    this.payment_date.reset()
    $(".clear").trigger("click");
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTER_DATA;
    } else {
      filterdata = this.filterdata;
    }

    Object.keys(filterdata).forEach((keys) => {
      filterdata[keys] = "";
    });

    let data = {
      sort: "asc",
      page: 0,
      size: 10,
      searchKey: filterdata,
    };
    this.trainingtableload = true;
    // this.loaderforpage = true;
    this.technicalService.gettechnicalIvms(data).subscribe((res) => {
      // this.loaderforpage = false;
      this.trainingtableload = false;
      this.TechnicalList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.paginator.length = res?.data?.totalcount;
      this.paginator.pageSize = res?.data?.size;
      this.resultsLength = res?.data?.totalcount
      this.TechnicalData = new MatTableDataSource<technicalEvaluationData>(this.TechnicalList_Data);
    });

  }
  // next button
  next() {
  }
  // view button
  view(id: number) {
    this.route.navigate(['/invoicemanagement/technicalpaymentivms'], { queryParams: { id: this.security.encrypt(id) } });
  }

  announceSortChange(sortState: Sort) {
    // this.sortFiled= sortState.direction
    // this.order = sortState.active

    this.filterDataPage = {
      sortFiled: sortState.active,
      order: sortState.direction,
    };
    this.getData(null, this.page, this.paginator.pageIndex, this.filterdata, this.filterDataPage);
  }

  getData(sort: any, page: number, size: number, searchData: any, filterDataPage: any = null) {
    let data = {
      page: page,
      size: size,
      searchkey: searchData,
      sort: filterDataPage?.sortFiled,
      order: filterDataPage?.order,
    };

    this.trainingtableload = true;
    // this.loaderforpage = true;
    this.technicalService.gettechnicalIvms(data).subscribe((res) => {
      // this.loaderforpage = false;
      this.trainingtableload = false;
      this.TechnicalList_Data = res?.data?.data;
      this.norecord = res?.data?.totalcount > 0 ? false : true;
      this.paginator.length = res?.data?.totalcount;
      this.resultsLength = res?.data?.totalcount
      this.paginator.pageSize = res?.data?.size;
      this.TechnicalData = new MatTableDataSource<technicalEvaluationData>(this.TechnicalList_Data);

    });
  }

  dateClicked(event, formcontrolname) {
    if (!event.endDate) return;
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

  searchCenterCert(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
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

  exportData() {
    var gridsearchvalue = {};
    gridsearchvalue = {
      invoice_no: this.invoice_no.value,
      company_name: this.company_name.value,
      training_provider: this.training_provider.value,
      modelno: this.modelno.value,
      officetype: this.office_type.value,
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
    // const showCol = this.TechnicalListData.filter( (col) => {
    //   return col.showhide
    // })
    const showCol = [];
    this.TechnicalListData.forEach( (col) => {
      if(col.showhide){
        showCol.push(col.tbllist)
      }
    })
    this.technicalService.exportDataIvms(
      sign + this.sort.active,
      this.sort.direction,
      this.paginator.pageIndex - 1,
      this.page,
      gridsearchvalue,
      this.TechnicalList_Data,
      showCol
    ).subscribe((res) => {
      if (res.data.status == 1) {
        window.open(res.data.attend, "_blank");
        //this.fullPageLoaders = false;
      }
    });
  }

}
