import { Component, OnInit, Input, ViewChild, ViewEncapsulation } from '@angular/core';
import {ApprovalService} from './../approval.service';
import { Observable } from 'rxjs/Observable';
import { HttpClient } from '@angular/common/http';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import {of as observableOf} from 'rxjs/observable/of';
import {Router,ActivatedRoute} from '@angular/router';
import { FormControl,FormArray,FormBuilder,FormGroup } from '@angular/forms';
import swal from 'sweetalert';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
import { DeactivatesuppliersidenavdetailComponent } from '../deactivatesuppliersidenavdetail/deactivatesuppliersidenavdetail.component';
import { DeletesuppliersidenavdetailComponent } from '../deletesuppliersidenavdetail/deletesuppliersidenavdetail.component';
import { ToastrService } from 'ngx-toastr';
import { OrganiserdetailtrackersidenavlistComponent } from '../organiserdetailtrackersidenavlist/organiserdetailtrackersidenavlist.component';
import * as _moment from 'moment';
import { default as _rollupMoment } from 'moment';
import { MatSelect } from '@angular/material/select';
import { UpdatesuppliersidenavdetailComponent } from '../updatesuppliersidenavdetail/updatesuppliersidenavdetail.component';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

const moment = _rollupMoment || _moment;

export interface LocaleConfig {
  direction?: string;
  separator?: string;
  weekLabel?: string;
  applyLabel?: string;
  cancelLabel?: string;
  clearLabel?: string;
  customRangeLabel?: string;
  daysOfWeek?: string[];
  monthNames?: string[];
  firstDay?: number;
  format?: string;
  displayFormat?: string;
}

@Component({
  selector: 'app-registeredstakeholderlist',
  templateUrl: './registeredstakeholderlist.component.html',
  styleUrls: ['./registeredstakeholderlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class RegisteredstakeholderlistComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @ViewChild('refsupplierinfo') refsupplierinfo: UpdatesuppliersidenavdetailComponent;
  @ViewChild('updatesupplierdrawer') updatesupplierdrawer: MatDrawer;
  @ViewChild('subcriptionpaytracker') subcriptionpaytracker: MatDrawer;
  @ViewChild('viewcredentaildrawer') viewcredentaildrawer: MatDrawer;
  @ViewChild('deactivatesupplierdrawer') deactivatesupplierdrawer: MatDrawer;
  @ViewChild('deletesupplierdrawer') deletesupplierdrawer: MatDrawer;
  @ViewChild('tempoparaylogindrawer') tempoparaylogindrawer: MatDrawer;
  @ViewChild('organisertrackerdrawer') organisertrackerdrawer: MatDrawer;
  @ViewChild('reneviewlistdrawer') reneviewlistdrawer: MatDrawer;
  @ViewChild('updatepaymentdrawer') updatepaymentdrawer: MatDrawer;
  @ViewChild('updatedeviationdrawer') updatedeviationdrawer: MatDrawer;
  @ViewChild('selectmember') selectmember: MatSelect;
  @ViewChild('selectsubscrip') selectsubscrip: MatSelect;
  @ViewChild('selectapprovalstatus') selectapprovalstatus: MatSelect;
  selected = 'Search by';
  @ViewChild(MatSort) sort: MatSort;
  animationState = 'out';
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild('deactivatesupplierref') deactivatesupplierref:DeactivatesuppliersidenavdetailComponent;
  @ViewChild('deletesupplierref') deletesupplierref:DeletesuppliersidenavdetailComponent;
  @ViewChild('organlist') organlist:OrganiserdetailtrackersidenavlistComponent;

  onlyOne = false;
  public supplierListData: MatTableDataSource<any>;
  supplierGridDatas: SupplierPagination;
  searchControl: FormControl = new FormControl('');
  displayedColumns = ['mcm_RegistrationNo', 'MCM_SupplierCode','MCM_CompanyName', 'CyM_CountryName_en','UM_EmailID', 'MRM_CreatedOn', 'invoicedays','membersts', 'subscriptionstatus','mcpd_pymtapprovalstatus','Action'];
  resultsLength = 0;
  page:number=10;
  searchfilter: boolean = false;
  pageEvent: any;
  showAddPart: boolean = false;
  tblplaceholder: boolean = false;
  showLoader: boolean = false;
  searchByValue: any;
  searchByText: any;
  hidefilder: boolean = true;
  subscriptiontracker: boolean = false;
  updatesupplier: boolean = false;
  regpk: any='';
  paymentdata: any=[];
  filtername="Hide Filter";
  compdetails:any = [];
  selected2 = moment();
  selected3: any;
  alwaysShowCalendars: boolean;
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  invalidDates: moment.Moment[] = [moment().add(2, 'days'), moment().add(3, 'days'), moment().add(5, 'days')];
  isInvalidDate = (m: moment.Moment) =>  {
    return this.invalidDates.some(d => d.isSame(m, 'day') )
  }
  public dateFilterSt:any = '';
  public dateFilterEd:any = '';
  public dateFilterLogSt:any = '';
  public dateFilterLogEd:any = '';
  @Input() type: any='6'; //stakeholder type

  private querystr: string;
  searchOptions = [
    { 'value': 1, 'name': 'JSRS Registration' },
    { 'value': 2, 'name': 'Supplier Code' },
    { 'value': 3, 'name': 'Organisation Name' }
  ];
  actionList = ['View & Validate', 'Resend Invoice', 'Resend Receipt'];
  filterList = [
    { 'id': 1, 'name': 'Certified', 'statusChecked': false },
    { 'id': 2, 'name': '', 'statusChecked': false }
  ];
  paymentFilter = [
    { 'id': 1, 'name': 'Yet to Validate', 'statusChecked': false },
    { 'id': 4, 'name': 'Payment Pending', 'statusChecked': false },
    { 'id': 2, 'name': 'Approved', 'statusChecked': false },
    { 'id': 3, 'name': 'Declined', 'statusChecked': false }
  ];
  filterFormGroup: FormGroup;
  paymentFilterFormGroup: FormGroup;

  filterSelectedList = this.filterList.map(x => ({ id: x.id, name: x.name, statusChecked: x.statusChecked }));
  paymentStatusSelectedList = this.paymentFilter.map(x => ({ id: x.id, name: x.name, statusChecked: x.statusChecked }));
  noData: any = '';
  isshowdeactivateslider:boolean=false;
  isshowdeleteslider:boolean=false;
  public updatesupplierinfo: boolean = false;
  public Contentplaceloader: boolean = false;
  public lusrtpye:any=null;
  public useraccess:any;
  constructor(
    private approvalService: ApprovalService,
    private router: Router,
    private security: Encrypt,
    private filterFormBuilder: FormBuilder,
    public toastr: ToastrService,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private http: HttpClient,
    public localstorage: AppLocalStorageServices
  ) {
    this.alwaysShowCalendars = true;
   }


  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"

  searchByTextChange(txtvalue) {
    this.searchByText = txtvalue;
  }
  searchByChangeValue(byval) {
    this.searchByValue = byval;
  }


  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchSupplierData();
    this.Contentplaceloader=true;
    //this.page = event.pageSize;
    // this.paginator.page.emit(event);
  }

  onPaginateChange(event) {
    this.page = event.pageSize;
    //  this.fetchSupplierData(); 
    //   this.page = parseInt(event.pageIndex) + 1;
  }
  showdropdown(divName: string) {
    if (divName === 'businessunitinfo') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  filtersts:boolean = true;

  ngOnInit() {


    this.lusrtpye = this.localstorage.getInLocal('usertype');
    if(this.lusrtpye == 'U'){
        this.useraccess = this.localstorage.getInLocal('uerpermission');
    }  
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
   if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
	  
      });
    this.filterFormGroup = this.filterFormBuilder.group({
      certifiedFilterVal: this.filterFormBuilder.array([])
    });
    this.paymentFilterFormGroup = this.filterFormBuilder.group({
      paymentFilterVal: this.filterFormBuilder.array([])
    });
    
    this.mcm_RegistrationNo.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null && register.length >= 3 && this.filtersts) {
          this.paginator.pageIndex = 0;
            this.fetchSupplierData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }        
      }
    )
    this.MCM_SupplierCode.valueChanges.debounceTime(400).subscribe(
      supcode => {
        if (supcode != null && supcode.length >= 3 && this.filtersts) {
          this.paginator.pageIndex = 0;
            this.fetchSupplierData();
        }else if(supcode == ''){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }  
      }
    )
    this.MCM_CompanyName.valueChanges.debounceTime(400).subscribe(
      company => {
        if (company != null && company.length >= 3 && this.filtersts) {
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }else if(company == ''){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }  
      }
    )
    this.CyM_CountryName_en.valueChanges.debounceTime(400).subscribe(
      country => {
        if (country != null && country.length >= 3 && this.filtersts) {
          this.paginator.pageIndex = 0;
            this.fetchSupplierData();
        } else if(country == ''){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        } 
      }
    )
    // this.MRM_RenewalStatus.valueChanges.debounceTime(400).subscribe(
    //   renewal => {   
    //     this.paginator.pageIndex = 0;      
    //     this.fetchSupplierData(); 
    //   }
    // )
    this.UM_EmailID.valueChanges.debounceTime(400).subscribe(
      type => {
        if (type != null && type.length >= 3 && this.filtersts) {
          this.paginator.pageIndex = 0;
            this.fetchSupplierData();
        } else if(type == ''){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }
      }
    )
    this.MRM_CreatedOn.valueChanges.debounceTime(400).subscribe(
      appion => {
        if (appion != null && this.filtersts) {
          this.paginator.pageIndex = 0;
            this.fetchSupplierData();
        } 
      }
    )
    this.membersts.valueChanges.debounceTime(400).subscribe(
      subscription => {
        if (subscription != null && this.filtersts) {
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }
        this.selectmember.close();
      }
    )
    this.invoicedays.valueChanges.debounceTime(400).subscribe(
      invoiceday => { 
        this.paginator.pageIndex = 0;
        this.paginator.pageIndex = 0;        
        this.fetchSupplierData(); 
      }
    )
    this.subscriptionstatus.valueChanges.debounceTime(400).subscribe(
      invoiceday => {
        if (invoiceday != null && this.filtersts) {
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }
        this.selectsubscrip.close();
      }
    )
    this.mcpd_pymtapprovalstatus.valueChanges.debounceTime(400).subscribe(
      pymtapprovalstatus => {
        if(pymtapprovalstatus != null && this.filtersts){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }
        this.selectapprovalstatus.close();
      }
    )
  }
  checkpermission(key,regpk)
  {
    if(this.type == 6){
    if(key == 'viewsubpaytracker'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[289] &&  this.useraccess[289].read == 'Y') {
    this.getRegInfo(regpk);
    this.loadsubscriptiontracker();
    this.subcriptionpaytracker.toggle()
  }else{
    this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }
  else if(key == 'viewprofile'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[289] &&  this.useraccess[289].read == 'Y') {
      // window.open(regpk, "_blank");
      // this.router.navigate([regpk]);
    }else{
      this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }
  else if(key == 'upadteorg'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[289] &&  this.useraccess[289].update == 'Y') {
      this.updatesupplierdrawer.toggle();
      this.getcompdetails(regpk);
      this.loadupdatesupplierinfo();
    }else{
      this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }
  else if(key == 'deactivate'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[289] &&  this.useraccess[289].delete == 'Y') {
      this.isshowdeactivateslider=true;
      this.deactivatesupplierdrawer.toggle();
      this.getdeacitvatedata(regpk,1);
    }else{
      this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }
}else if(this.type == 15){

  if(key == 'viewsubpaytracker'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[290] &&  this.useraccess[290].read == 'Y') {
    this.getRegInfo(regpk);
    this.loadsubscriptiontracker();
    this.subcriptionpaytracker.toggle()
  }else{
    this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }
  else if(key == 'viewprofile'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[290] &&  this.useraccess[290].read == 'Y') {
      // window.open(regpk, "_blank");
      // this.router.navigate([regpk]);
    }else{
      this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }
  else if(key == 'upadteorg'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[290] &&  this.useraccess[290].update == 'Y') {
      this.updatesupplierdrawer.toggle();
      this.getcompdetails(regpk);
      this.loadupdatesupplierinfo();
    }else{
      this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }
  else if(key == 'deactivate'){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[290] &&  this.useraccess[290].delete == 'Y') {
      this.isshowdeactivateslider=true;
      this.deactivatesupplierdrawer.toggle();
      this.getdeacitvatedata(regpk,1);
    }else{
      this.toastr.warning(this.i18n('registeredstakeholderpage.youdonthaveperm'), this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }

}
  }

  changeList(data:string){
      this.type = data;
      this.fetchSupplierData();
  }

  filterValues = {
    mcm_RegistrationNo: '',
    MCM_SupplierCode: '',
    MCM_CompanyName: '',
    CyM_CountryName_en: '',
    //MRM_RenewalStatus: '',
    UM_EmailID: '',
    MRM_CreatedOn: '',
    invoicedays:'',
    membersts: '',
    subscriptionstatus: '',
    mcpd_pymtapprovalstatus: ''
  };
  mcm_RegistrationNo = new FormControl('');
  MCM_SupplierCode = new FormControl('');
  MCM_CompanyName = new FormControl('');
  CyM_CountryName_en = new FormControl('');
  //MRM_RenewalStatus = new FormControl('');
  UM_EmailID = new FormControl('');
  MRM_CreatedOn = new FormControl('');
  invoicedays = new FormControl('');
  membersts = new FormControl('');
  subscriptionstatus = new FormControl('');
  mcpd_pymtapprovalstatus = new FormControl('');

  ngAfterViewInit() {
    this.fetchSupplierData()
  }
  reloadgrid(){
    this.fetchSupplierData();
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('registeredstakeholderpage.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('registeredstakeholderpage.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  clickbuyerEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('registeredstakeholderpage.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('registeredstakeholderpage.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  filterChange(event) {
    const filterselectedValues = <FormArray>this.filterFormGroup.get('certifiedFilterVal') as FormArray;
    if (event.checked) {
      filterselectedValues.push(new FormControl(event.source.value))
    } else {
      var i = filterselectedValues.controls.findIndex(x => x.value === event.source.value);
      filterselectedValues.removeAt(i);
    }
  }
  paymentFilterChange(event) {
    const paymentFilterSelectedValues = <FormArray>this.paymentFilterFormGroup.get('paymentFilterVal') as FormArray;
    if (event.checked) {

      paymentFilterSelectedValues.push(new FormControl(event.source.value))
    } else {
      var i = paymentFilterSelectedValues.controls.findIndex(x => x.value === event.source.value);
      paymentFilterSelectedValues.removeAt(i);
    }
  }
  viewpage(regpk) {

    if (regpk) {
      this.router.navigate(['regapproval/viewandvalidate/', this.security.encrypt(regpk), 0]);
    }
  }
  renewalhistry(regpk) {
    this.approvalService.getrenewaldetails(regpk).subscribe(res => {

    });
  }
  selectOptionClear() {
    this.filterSelectedList.forEach(status => {
      status.statusChecked = false;
    });
    this.fetchSupplierData();
  }
  paymentStatusClear() {
    this.paymentStatusSelectedList.forEach(status => {
      status.statusChecked = false;
    });
    this.fetchSupplierData();
  }
  clearFilter() {
    this.searchControl.setValue('');
    this.searchByText = '';
    this.mcm_RegistrationNo.setValue("");
    this.MCM_SupplierCode.setValue("");
    this.MCM_CompanyName.setValue("");
    this.CyM_CountryName_en.setValue("");
    //this.MRM_RenewalStatus.setValue("");
    this.UM_EmailID.setValue("");
    this.MRM_CreatedOn.setValue("");
    if(this.invoicedays.value){
      this.invoicedays.setValue("");
    }
    this.membersts.setValue("");
    this.subscriptionstatus.setValue("");
    this.mcpd_pymtapprovalstatus.setValue("");
    this.fetchSupplierData();
  }
  clearbuyerFilter() {
    this.searchControl.setValue('');
    this.searchByText = '';
    this.mcm_RegistrationNo.setValue("");
    this.MCM_SupplierCode.setValue("");
    this.MCM_CompanyName.setValue("");
    this.CyM_CountryName_en.setValue("");
    //this.MRM_RenewalStatus.setValue("");
    this.UM_EmailID.setValue("");
    this.MRM_CreatedOn.setValue("");
    this.membersts.setValue("");
    this.subscriptionstatus.setValue("");
    this.mcpd_pymtapprovalstatus.setValue("");
  }
  refeshgrid(){
    this.fetchSupplierData();
  }
  fetchSupplierData() {
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo=false;
    this.supplierGridDatas = new SupplierPagination(this.http);
    this.sort?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = {mcm_RegistrationNo:this.mcm_RegistrationNo.value,MCM_SupplierCode:this.MCM_SupplierCode.value,MCM_CompanyName:this.MCM_CompanyName.value,CyM_CountryName_en:this.CyM_CountryName_en.value,UM_EmailID:this.UM_EmailID.value,MRM_CreatedOn:this.MRM_CreatedOn.value,invoicedays:this.invoicedays.value,mcpd_pymtapprovalstatus:this.mcpd_pymtapprovalstatus.value,membersts:this.membersts.value,subscriptionstatus:this.subscriptionstatus.value,stktype:this.type};
    merge(this.sort?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.supplierGridDatas.supplierGridUtil(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value,JSON.stringify(gridsearchvalue),this.type);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.supplierListData = new MatTableDataSource(data);
        this.supplierListData.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noData = this.supplierListData.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
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
  resendregconfirmation(regpk){
    swal({
      title: this.i18n('registeredstakeholderpage.doyouwanttoresen'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('registeredstakeholderpage.nomodal'), this.i18n('registeredstakeholderpage.yesmodal')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.showLoader = true;
        this.approvalService.resendregconfirmation(regpk).subscribe(res => {
          this.showLoader = false;
          if(res['data'].statuscode == 100){
            this.showTSuccess(res['data'].msg);
          }else{
            this.showWSuccess(res['data'].msg);
          }      
        });
      }
    });    
  }  
  getcompdetails(regpk) {
    //this.refsupplierinfo.updatesupplierinfo=true;
    this.approvalService.getcompdetails(regpk).subscribe(res => {
      this.compdetails = res['data'];
      //this.refsupplierinfo.updatesupplierinfo=false;
    });
  }
  getRegInfo(regpk) {

    this.getpaymenttrackerinfo(regpk);
    this.regpk = regpk;
 
  }
  getdeacitvatedata(data,type){
    this.updatesupplierinfo = true;
    // this.deactivatesupplierref.loader = true;
    if(type == 1){
      setTimeout(() => {
        this.deactivatesupplierref.supplierdeactivatepatchvalue(data); 
      }, 500); 
    }else{
      setTimeout(() => {
        this.deletesupplierref.deletesupplierdata(data); 
      }, 500); 
    }          
  }
  getcompanytrackerdata(data){
    this.organlist.organiserdetailloader=true;
    this.organlist.getcompanytrackerdata(data); 
  }
  supplierlistalert() {
    swal({
      title: this.i18n('registeredstakeholderpage.doyouwanttodeleupp'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('registeredstakeholderpage.nomodal'), this.i18n('registeredstakeholderpage.yesmodal')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
      }
    });
  }
  
  showTSuccess(data){
    this.toastr.success(data, this.i18n('registeredstakeholderpage.succ'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.warning(data, this.i18n('registeredstakeholderpage.warn'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  loadsubscriptiontracker(){    
    setTimeout(() => {
      this.subscriptiontracker = true;
    }, 500); 
  }
  loadupdatesupplierinfo(){
    this.updatesupplier = true;
  }
  getpaymenttrackerinfo(regpk){
    this.approvalService.getpaymenttracker(regpk).subscribe(res => {
      this.paymentdata = res['data'];
    });
  }
  dateFltrChange(event){ 
    let stDate = '';
    let edDate = '';
    this.dateFilterSt = '';
    this.dateFilterEd = '';
    if(this.MRM_CreatedOn.value){
      stDate = (this.MRM_CreatedOn.value.startDate)?moment(this.MRM_CreatedOn.value.startDate).format('YYYY/MM/DD'):'';
      edDate = (this.MRM_CreatedOn.value.endDate)?moment(this.MRM_CreatedOn.value.endDate).format('YYYY/MM/DD'):'';
      this.dateFilterSt = (this.MRM_CreatedOn.value.startDate)?moment(this.MRM_CreatedOn.value.startDate).format('DD-MM-YYYY'):'';
      this.dateFilterEd = (this.MRM_CreatedOn.value.endDate)?moment(this.MRM_CreatedOn.value.endDate).format('DD-MM-YYYY'):'';
    }
  }
}

export class SupplierPagination {
  constructor(private http?: HttpClient) {
  }
  supplierGridUtil(sort: string, order: string, page: number, 
    size: number, query: string, search?: string,gridsearchValues?:string,stktype?:string): Observable<any> { 
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'apr/approval/supplierregisterdata';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&stktype=${stktype}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
