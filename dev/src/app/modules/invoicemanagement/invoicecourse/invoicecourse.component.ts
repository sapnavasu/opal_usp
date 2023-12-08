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
import { MatSort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { MatCheckbox } from '@angular/material/checkbox';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { Observable } from 'rxjs/Observable';
import { merge } from 'rxjs/observable/merge';
import { catchError, map, startWith} from 'rxjs/operators';
import { switchMap } from 'rxjs/operators/switchMap';
import { of as observableOf } from 'rxjs/observable/of';
import { Encrypt } from '@app/common/class/encrypt';
import { InvoiceService } from '@app/services/invoice.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

// table
export interface technicalEvaluationData {
  apid_invoiceno: any;
  pm_projectname_en: any;
  omrm_companyname_en: any;
  omrm_tpname_en: any;
  appiim_officetype: any;
  appiim_branchname_en: any;
  omrm_opalmembershipregnumber: any;
  scm_coursename_en: any;
  catstden: any;
  subcaten: any;
  fsm_feestype: any;
  apid_noofstaffeval: any;
  total: any;
  apid_invoicestatus: any;
  apid_paymenttype: any;
  invdate: any;
  agedate: any;
  pymtdate: any;
}
const TechnicalList_Data: technicalEvaluationData[] = [
  // { invoiceno: 'General Electric', coursetype: 'Standard course', compannyname: 'Al Khelijan Techical service', omrm_tpname_en: 'Ahmed Bin', appiim_officetype: 'Main Branch', appiim_branchname_en: 'Direct Contract', omrm_opalmembershipregnumber: 'cyber Security', scm_coursename_en: 'Project Management - PMP', catstden: 'Procurement', subcaten: 'Fire and Safety', fsm_feestype: 'Standard', apid_noofstaffeval: '3', total: 'computer sicence', apid_invoicestatus: 'R', apid_paymenttype: 'O', pymtdate: '23-04-2024', apid_invoicestatus: '20 Days', paymentdate: 20 - 1 - 2023 },
  // { invoiceno1: 'General Electric', coursetype: 'Standard course', compannyname: 'Al Khelijan Techical service', omrm_tpname_en: 'Ahmed Bin', appiim_officetype: 'Main Branch', appiim_branchname_en: 'Direct Contract', omrm_opalmembershipregnumber: 'cyber Security', scm_coursename_en: 'Project Management - PMP', catstden: 'Procurement', subcaten: 'Fire and Safety', fsm_feestype: 'Standard', apid_noofstaffeval: '4', total: 'computer sicence', apid_invoicestatus: 'P', apid_paymenttype: 'CH', pymtdate: '23-04-2024', apid_invoicestatus: '20 Days', paymentdate: 20 - 1 - 2023 },
];
@Component({
  selector: 'app-invoicecourse',
  templateUrl: './invoicecourse.component.html',
  styleUrls: ['./invoicecourse.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class InvoicecourseComponent implements OnInit {
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public pageEvent: any;
  public page: number = 10;
  public resultsLength: number;
  public courseloader: boolean = false;
  public ifarabic: boolean;
  public pageloader: boolean;
  public selectCourChkbox: boolean = true;
  @ViewChild('courchkBox') courchkBox: MatCheckbox;
  mainIntrGridDatas: MainInsPagination;
  private querystr: string;
  searchControl: FormControl = new FormControl('');
  interreccount :any = false;
  public interRecListData: MatTableDataSource<any>;
  noData: any = '';
  filtersts:boolean = true;
  coursesubcategory: any[]=[];
  category_remove: any;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;
  accessproject: any = false;
  // table

  TechnicalListData = [
    { courlist: "apid_invoiceno", searchflt: "row-first", label: "invoice.invonumb", courhide: true, header: "" },
    { courlist: "pm_projectname_en", searchflt: "row-second", label: "invoice.courtype", courhide: true, header: "" },
    { courlist: "omrm_companyname_en", searchflt: "row-three", label: "invoice.companyname", courhide: true, header: "" },
    { courlist: "omrm_tpname_en", searchflt: "row-four", label: "invoice.trainname", courhide: true, header: "" },
    { courlist: "appiim_officetype", searchflt: "row-five", label: "invoice.offitype", courhide: true, header: "" },
    { courlist: "appiim_branchname_en", searchflt: "row-six", label: "invoice.branchname", courhide: true, header: "" },
    { courlist: "omrm_opalmembershipregnumber", searchflt: "row-seven", label: "invoice.opalmemb", courhide: true, header: "" },
    { courlist: "scm_coursename_en", searchflt: "row-eight", label: "invoice.courtitle", courhide: true, header: "" },
    { courlist: "catstden", searchflt: "row-nine", label: "invoice.courcate", courhide: true, header: "" },
    { courlist: "subcaten", searchflt: "row-ten", label: "invoice.coursubcate", courhide: true, header: "" },
    { courlist: "fsm_feestype", searchflt: "row-eleven", label: "invoice.fee", courhide: true, header: "" },
    { courlist: "apid_noofstaffeval", searchflt: "row-twelve", label: "invoice.nostaff", courhide: true, header: "" },
    { courlist: "total", searchflt: "row-thirteen", label: "invoice.invoamount", courhide: true, header: "" },
    { courlist: "apid_invoicestatus", searchflt: "row-fourteen", label: "invoice.status", courhide: true, header: "" },
    { courlist: "apid_paymenttype", searchflt: "row-fifteen", label: "invoice.paymtype", courhide: true, header: "" },
    { courlist: "invdate", searchflt: "row-sixteen", label: "invoice.invodate", courhide: true, header: "" },
    { courlist: "agedate", searchflt: "row-seventeen", label: "invoice.invoage", courhide: true, header: "" },
    { courlist: "pymtdate", searchflt: "row-eighteen", label: "invoice.paydate", courhide: true, header: "" },
    { courlist: "action", searchflt: "row-refresh", label: "invoice.action", courhide: true, header: "" },

  ];
  // displayed column
  TechnicalListDatafun(): string[] {
    return this.TechnicalListData.filter(courlist => courlist.courhide).map(courlist => courlist.courlist);
  }
  // displayed search
  TechnicalListDatasear(): string[] {
    return this.TechnicalListData.filter(courlist => courlist.courhide).map(courlist => courlist.searchflt);
  }// TechnicalListData = ['invoiceno', 'coursetype' , 'compannyname' , 'omrm_tpname_en' , 'appiim_officetype','appiim_branchname_en','omrm_opalmembershipregnumber' , 'scm_coursename_en' , 'catstden' , 'subcaten' , 'fsm_feestype' , 'apid_noofstaffeval' , 'total' , 'apid_invoicestatus', 'apid_paymenttype' ,  'pymtdate',  'apid_invoicestatus', 'paymentdate', 'action'];

  TechnicalData = new MatTableDataSource<technicalEvaluationData>(TechnicalList_Data);

  constructor(private translate: TranslateService, public routeid: ActivatedRoute, private route: Router,
    private remoteService: RemoteService, public toastr: ToastrService,
    private cookieService: CookieService,
    private security: Encrypt,
    private invoiceService : InvoiceService,
    private http: HttpClient,
    private localstorage: AppLocalStorageServices,
    ) { }

  i18n(key) {
    return this.translate.instant(key);
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

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
      let submodule = 14 ;

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

   

    // user permission End Here


    this.pageloader = true;

    this.pageloader = true;
    setTimeout(() => {
      this.getInvoiceDtls();
      // this.pageloader = false;
    }, 2000);
    

    //Search starts here
    this.invoice_no = new FormControl('');
    this.invoice_no.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.course_type = new FormControl('');
    this.course_type.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.company_name = new FormControl('');
    this.company_name.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.training_provider = new FormControl('');
    this.training_provider.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.office_type = new FormControl('');
    this.office_type.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.bran_name = new FormControl('');
    this.bran_name.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.opal_membership = new FormControl('');
    this.opal_membership.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.course_title = new FormControl('');
    this.course_title.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.course_cate = new FormControl('');
    this.course_cate.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.course_sub = new FormControl('');
    this.course_sub.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.Fee_type = new FormControl('');
    this.Fee_type.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.noof_staff = new FormControl('');
    this.noof_staff.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.pay_status = new FormControl('');
    this.pay_status.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.pay_type = new FormControl('');
    this.pay_type.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.invoice_date = new FormControl('');
    this.invoice_date.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.invoice_age = new FormControl('');
    this.invoice_age.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )

    this.payment_date = new FormControl('');
    this.payment_date.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getInvoiceDtls();   
        }    
      }
    )
    //Search ends here

    // accessproject
    this.getaccessproject();
  }

  ngAfterViewInit(){
    this.routeid.queryParams.subscribe(params => {
      if(params['statusVal']){
         this.pay_status.setValue([params['statusVal']]);
     }
   });
  
 }

  // ngAfterViewInit() {
  //   this.TechnicalData.sort = this.sort;
  //   this.TechnicalData.paginator = this.paginator;
  // }
  // column edit function
  selectAlltablelable(event: any) {
    this.selectCourChkbox = event.checked;
    this.TechnicalListData.forEach(item => {
      item.courhide = this.selectCourChkbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // column edit function
  updateSelectAllcourhide(item: any) {
    const CheckedAll = this.TechnicalListData.every(item => item.courhide);
    if (CheckedAll) {
      this.courchkBox.checked = true;
    } else {
      this.courchkBox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // search field form con trol
  invoice_no = new FormControl('');
  course_type = new FormControl('');
  company_name = new FormControl('');
  training_provider = new FormControl('');
  office_type = new FormControl('');
  bran_name = new FormControl('');
  opal_membership = new FormControl('');
  course_title = new FormControl('');
  course_cate = new FormControl('');
  course_sub = new FormControl('');
  Fee_type = new FormControl('');
  noof_staff = new FormControl('');
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

  
  //  filter clear fumction
  clearFilter() {
    this.invoice_no.reset()
    this.course_type.reset()
    this.company_name.reset()
    this.training_provider.reset()
    this.office_type.reset()
    this.bran_name.reset()
    this.Fee_type.reset()
    this.opal_membership.reset()
    this.course_title.reset()
    this.course_cate.reset()
    this.course_sub.reset()
    this.noof_staff.reset()
    this.pay_status.reset()
    this.pay_type.reset()
    this.invoice_date.reset()
    this.invoice_age.reset()
    this.payment_date.reset()
  
      $(".clear").trigger("click");
    
  }

  getInvoiceDtls() {
    console.log('inside the ivoice info')
    // this.pageloader = true;
    this.courseloader = true;
    
    this.mainIntrGridDatas = new MainInsPagination(this.http);
    this.sort?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = {invoice_no:this.invoice_no.value,course_type:this.course_type.value,company_name:this.company_name.value,training_provider:this.training_provider.value,office_type:this.office_type.value,
      bran_name:this.bran_name.value,opal_membership:this.opal_membership.value,course_title:this.course_title.value,course_cate:this.course_cate.value,course_sub:this.course_sub.value,
      Fee_type:this.Fee_type.value,noof_staff:this.noof_staff.value,pay_status:this.pay_status.value,pay_type:this.pay_type.value,invoice_date:this.invoice_date.value,invoice_age:this.invoice_age.value,payment_date:this.payment_date.value};
    merge(this.sort?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {

          this.querystr = '';
            return this.mainIntrGridDatas.interRecGridUtil(this.sort.active, this.sort.direction,  this.paginator.pageIndex - 1,
              this.page, this.querystr, this.searchControl.value,JSON.stringify(gridsearchvalue));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          if(this.resultsLength != 0){
            this.interreccount = true;
          }
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListData = new MatTableDataSource(data);
        this.interRecListData.filterPredicate = this.createFilter();
        // this.Contentplaceloader = false;
        this.pageloader = false;
        this.filtersts = true;
        this.noData = this.interRecListData.connect().pipe(map(data => data.length === 0));
        this.courseloader = false;
        // this.LoaderForNorecord = false;
      });
  }
  
  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.mcm_RegistrationNo.toLowerCase().indexOf(searchTerms.mcm_RegistrationNo) !== -1 &&
        data.MCM_SupplierCode.toLowerCase().indexOf(searchTerms.MCM_SupplierCode) !== -1 &&
        data.MCM_CompanyName.toLowerCase().indexOf(searchTerms.MCM_CompanyName) !== -1 &&
        data.CyM_CountryName_en.toLowerCase().indexOf(searchTerms.CyM_CountryName_en) !== -1 &&
        //data.MRM_RenewalStatus.toLowerCase().indexOf(searchTerms.MRM_RenewalStatus) !== -1 &&
        data.UM_EmailID.toLowerCase().indexOf(searchTerms.UM_EmailID) !== -1 &&
        data.MRM_CreatedOn.toLowerCase().indexOf(searchTerms.MRM_CreatedOn) !== -1 &&
        data.invoicedays.toLowerCase().indexOf(searchTerms.invoicedays) !== -1 &&
        data.membersts.toLowerCase().indexOf(searchTerms.membersts) !== -1 &&
        data.subscriptionstatus.toLowerCase().indexOf(searchTerms.subscriptionstatus) !== -1 &&
        data.mcpd_pymtapprovalstatus.toLowerCase().indexOf(searchTerms.mcpd_pymtapprovalstatus) !== -1;
    }
    return filterFunction;
  }

  //  paginator
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getInvoiceDtls();
  }

  
  // next button
  next() {
  }
  // view button
  view(pk) {
    this.route.navigate(['/invoicemanagement/payment'],{ queryParams: { inv_pk: this.security.encrypt(pk) }});
  }



  exportData(){

    var gridsearchvalue = {};
    gridsearchvalue = {invoice_no:this.invoice_no.value,course_type:this.course_type.value,company_name:this.company_name.value,training_provider:this.training_provider.value,office_type:this.office_type.value,
        bran_name:this.bran_name.value,opal_membership:this.opal_membership.value,course_title:this.course_title.value,course_cate:this.course_cate.value,course_sub:this.course_sub.value,
        Fee_type:this.Fee_type.value,noof_staff:this.noof_staff.value,pay_status:this.pay_status.value,pay_type:this.pay_type.value,invoice_date:this.invoice_date.value,invoice_age:this.invoice_age.value,payment_date:this.payment_date.value};
    const sign = (this.sort.direction === 'desc') ? '-' : '';    
    //const href = environment.baseUrl + 'cm/coursemanagement/Exportdata';
    
    //this.fullPageLoaders = true;
    const showCol = [];
    this.TechnicalListData.forEach( (col) => {
      if(col.courhide){
        showCol.push(col.courlist)
      }
    });
    // console.log(showCol);
    this.invoiceService.exportData(sign+this.sort.active,this.sort.direction,this.paginator.pageIndex - 1,this.page,gridsearchvalue,this.TechnicalListData, showCol).subscribe(res => {
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
        //this.fullPageLoaders = false;
      }

    });
  }
  splitCourseFunction(data) {
    this.coursesubcategory = data.split(',');
    this.category_remove = data.split(',');
    this.category_remove.shift();
    return this.coursesubcategory[0];
  }
  getaccessproject( ) {
    this.invoiceService.getaccessproject().subscribe((res:any) => {
      this.accessproject = res.data;
      if(this.readaccess == false || this.accessproject == false){
        this.pageloader = false;
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
    });
  }
}

export class MainInsPagination {
  constructor(private http?: HttpClient
    ) {
  }
  interRecGridUtil(sort: string, order: string, page: number, 
      size: number, query: string, search?: string,gridsearchValues?:string): Observable<any> { 
        
    const sign = (order === 'desc') ? '-' : '';    
    const href = environment.baseUrl + 'cm/coursemanagement/getinvdtls';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}


