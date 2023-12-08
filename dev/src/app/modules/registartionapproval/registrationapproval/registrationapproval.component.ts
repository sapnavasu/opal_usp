
import { Component, OnInit, Input, ViewChild, AfterViewInit } from '@angular/core';
import {ApprovalService} from './../approval.service';
import { ToastrService } from 'ngx-toastr'
import { Observable } from 'rxjs/Observable';
import { HttpClient } from '@angular/common/http';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import {of as observableOf} from 'rxjs/observable/of';
import {Route,Router} from '@angular/router';
import { FormControl,FormArray,FormBuilder,FormGroup } from '@angular/forms';
import {ViewEncapsulation } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
import { MatSelect } from '@angular/material/select';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { DeactivatesuppliersidenavdetailComponent } from '../deactivatesuppliersidenavdetail/deactivatesuppliersidenavdetail.component';
import { OrganiserdetailtrackersidenavlistComponent } from '../organiserdetailtrackersidenavlist/organiserdetailtrackersidenavlist.component';
import * as _moment from 'moment';
import { default as _rollupMoment } from 'moment';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
const moment = _rollupMoment || _moment;

const ELEMENT_DATA: any[] = [
  {position: 1, name: 'Business Gateways International', email:'vijay@businessgateways.com', country: 'Oman',register:'15-05-2020',validated:'15-05-2020',mode:'Online',appliactiontype:'Fresh',appliedon:'15-05-2020',subscriptiion:'1Yr',invoicedays:'32 Days'},
  {position: 2, name: 'Business Gateways International', email:'joseph@businessgateways.com', country: 'Libya',register:'15-05-2020',validated:'-',mode:'Online',appliactiontype:'Fresh',appliedon:'15-05-2020',subscriptiion:'1Yrs',invoicedays:'-'},
  {position: 3, name: 'Business Gateways International', email:'raj@businessgateways.com', country: 'Oman', register:'15-05-2020',validated:'15-05-2020',mode:'Online',appliactiontype:'Renewal',appliedon:'15-05-2020',subscriptiion:'1Yr',invoicedays:'-'},
  {position: 4, name: 'Business Gateways International', email:'bala@businessgateways.com', country: 'Libya' ,register:'15-05-2020',validated:'-',mode:'Online',appliactiontype:'Fresh',appliedon:'15-05-2020',subscriptiion:'3Yrs',invoicedays:'52 Days'},
  {position: 5, name: 'Business Gateways International', email:'sarvana@businessgateways.com', country: 'Libya',register:'15-05-2020',validated:'16-05-2020',mode:'Online',appliactiontype:'Renewal',appliedon:'15-05-2020',subscriptiion:'1Yr',invoicedays:'12 Days'},
  {position: 6, name: 'Business Gateways International', email:'baktha@businessgateways.com', country: 'India',register:'15-05-2020',validated:'15-05-2020',mode:'Online',appliactiontype:'Fresh',appliedon:'15-05-2020',subscriptiion:'2Yrs',invoicedays:'60 Days'},
];

@Component({
  selector: 'app-registrationapproval',
  templateUrl: './registrationapproval.component.html',
  styleUrls: ['./registrationapproval.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class RegistrationapprovalComponent implements OnInit, AfterViewInit {
  nameFilter = new FormControl('');
  onlyOne = false;
  @ViewChild('subcriptionpaytracker') subcriptionpaytracker: MatDrawer;
  @ViewChild('updatesupplierdrawer') updatesupplierdrawer: MatDrawer;
  @ViewChild('viewcredentaildrawer') viewcredentaildrawer: MatDrawer;
  @ViewChild('deactivatesupplierdrawer') deactivatesupplierdrawer: MatDrawer;
  @ViewChild('tempoparaylogindrawer') tempoparaylogindrawer: MatDrawer;
  @ViewChild('organisertrackerdrawer') organisertrackerdrawer: MatDrawer;
   @ViewChild('reneviewlistdrawer') reneviewlistdrawer: MatDrawer;
   @ViewChild('updatepaymentdrawer') updatepaymentdrawer: MatDrawer;
   @ViewChild('updatedeviationdrawer') updatedeviationdrawer: MatDrawer;
   @ViewChild('selectmember') selectmember: MatSelect;
   @ViewChild('selectsubscrip') selectsubscrip: MatSelect;
   @ViewChild('selectapprovalstatus') selectapprovalstatus: MatSelect;
   @ViewChild('deactivatesupplierref') deactivatesupplierref:DeactivatesuppliersidenavdetailComponent;
   @ViewChild('organlist') organlist:OrganiserdetailtrackersidenavlistComponent;
  @Input() type: any='6'; //stakeholder type
  selected = 'Search by';
  @ViewChild(MatSort) sort: MatSort;
  animationState = 'out';
  regpk: any='';
  paymentdata: any=[];
  @ViewChild(MatPaginator) paginator: MatPaginator;
  public supplierListData: MatTableDataSource<any>;
  supplierGridDatas: SupplierPagination;
  searchControl: FormControl = new FormControl('');
  displayedColumns = ['mcm_RegistrationNo', 'MCM_SupplierCode','MCM_CompanyName', 'CyM_CountryName_en', 'MRM_RenewalStatus', 'mcpid_submittedon','MCPD_YrsOfSubs', 'invoicedays','membersts', 'subscriptionstatus','mcpd_pymtapprovalstatus','Action'];
  resultsLength = 0;
  page:number=10;
  searchfilter: boolean = false;
  pageEvent: any;
  showAddPart: boolean = false;
  searchByValue: any;
  searchByText: any;
  hidefilder: boolean = true;
  public isshowdeactivateslider:boolean = false;
  filtername="Hide Filter";
  compdetails:any;
  tblplaceholder: boolean = false;
  selected2 = moment();

  private querystr: string;
  searchOptions=[
    {'value':1,'name':'JSRS Registration'},
    {'value':2,'name':'Supplier Code'},
    {'value':3,'name':'Organisation Name'}
  ];
  actionList = ['View & Validate','Resend Invoice','Resend Receipt'];
  //filterList = [{'id':1,'name':'Certified'},{'id':2,'name':'Yet to Certify'},{'id':3,'name':'Inactive'}];
  filterList = [
                {'id':1,'name':'Certified','statusChecked':false},
                {'id':2,'name':'Yet to Certify','statusChecked':false}
              ];
  paymentFilter = [
                  {'id':1,'name':'Yet to Validate','statusChecked':false},
                  {'id':4,'name':'Payment Pending','statusChecked':false},
                  {'id':2,'name':'Approved','statusChecked':false},
                  {'id':3,'name':'Declined','statusChecked':false}
                ];
  filterFormGroup : FormGroup;
  paymentFilterFormGroup: FormGroup;

  filterSelectedList = this.filterList.map(x => ({id:x.id,name:x.name,statusChecked:x.statusChecked}));
  paymentStatusSelectedList  = this.paymentFilter.map(x => ({id:x.id,name:x.name,statusChecked:x.statusChecked}));
  //noData = this.supplierListData.connect().pipe(map(data => data.length === 0));
  noData:any = '';
  subscriptiontracker: boolean = false;
  constructor(private approvalService:ApprovalService,
    private http: HttpClient,
    private router: Router,
    private security:Encrypt,
    private filterFormBuilder: FormBuilder,
    public toastr: ToastrService,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    ) { }

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr" 
  
  searchByTextChange(txtvalue){
    this.searchByText= txtvalue;
  }
  searchByChangeValue(byval){
    this.searchByValue = byval;
  }
  
  
  syncPrimaryPaginator(event: PageEvent) {    
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchSupplierData(); 
    //this.page = event.pageSize;
    // this.paginator.page.emit(event);
  }

  getRegInfo(regpk) {
    this.getpaymenttrackerinfo(regpk);
    this.regpk = regpk;
  }
  getpaymenttrackerinfo(regpk){
    this.approvalService.getpaymenttracker(regpk).subscribe(res => {
      this.paymentdata = res['data'];
    });
  }
  loadsubscriptiontracker(){    
    setTimeout(() => {
      this.subscriptiontracker = true;
    }, 500); 
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
  ngOnInit() {
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
    certifiedFilterVal:  this.filterFormBuilder.array([]) 
   });
   this.paymentFilterFormGroup = this.filterFormBuilder.group({
    paymentFilterVal: this.filterFormBuilder.array([])
   });
   
   if(this.type && this.type!=''){
      if(this.type=='6'){
            this.fetchSupplierData();
      } else if(this.type=='15'){
          this.fetchSupplierData();
      } 
   }
    this.mcm_RegistrationNo.valueChanges.debounceTime(400).subscribe(
      
      register => {  
        if (register != null && register.length >= 3) {
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
        if (supcode != null && supcode.length >= 3) {
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
        if (company != null && company.length >= 3) {
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
        if (country != null && country.length >= 3) {
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }else if(country == ''){
          this.paginator.pageIndex = 0;
          this.fetchSupplierData();
        }
      }
    )
    this.MRM_RenewalStatus.valueChanges.debounceTime(400).subscribe(
      type => {   
        this.paginator.pageIndex = 0;      
        this.fetchSupplierData(); 
      }
    )
    this.mcpid_submittedon.valueChanges.debounceTime(400).subscribe(
      appion => {     
        this.paginator.pageIndex = 0;    
        this.fetchSupplierData(); 
      }
    )
    this.MCPD_YrsOfSubs.valueChanges.debounceTime(400).subscribe(
      subscription => {    
        this.paginator.pageIndex = 0;     
        this.fetchSupplierData(); 
      }
    )
    this.invoicedays.valueChanges.debounceTime(400).subscribe(
      invoiceday => { 
        this.paginator.pageIndex = 0;
        this.paginator.pageIndex = 0;        
        this.fetchSupplierData(); 
      }
    )
    // this.mcpid_pymtmode.valueChanges.debounceTime(400).subscribe(
    //   paymenttype => {    
    //     this.paginator.pageIndex = 0;     
    //     this.fetchSupplierData(); 
    //   }
    // )
    this.membersts.valueChanges.debounceTime(400).subscribe(
      subscription => {
        this.paginator.pageIndex = 0;
        //if (subscription != null) {
          this.fetchSupplierData();
        //}
        this.selectmember.close();
      }
    )
    this.subscriptionstatus.valueChanges.debounceTime(400).subscribe(
      invoiceday => {
        this.paginator.pageIndex = 0;
        //if (invoiceday != null) {
          this.fetchSupplierData();
        //}
        this.selectsubscrip.close();
      }
      )
      this.mcpd_pymtapprovalstatus.valueChanges.debounceTime(400).subscribe(
        pymtapprovalstatus => { 
          this.paginator.pageIndex = 0;        
          this.fetchSupplierData(); 
          this.selectapprovalstatus.close();
      }
    )
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
    MRM_RenewalStatus:'',
    mcpid_submittedon: '',
    MCPD_YrsOfSubs: '',
    invoicedays:'',
    membersts:'',
    subscriptionstatus:'',
    mcpd_pymtapprovalstatus:''
  };
  mcm_RegistrationNo = new FormControl('');
  MCM_SupplierCode = new FormControl('');
  MCM_CompanyName = new FormControl('');
  CyM_CountryName_en = new FormControl('');
  MRM_RenewalStatus = new FormControl('');
  mcpid_submittedon = new FormControl('');
  MCPD_YrsOfSubs = new FormControl('');
  invoicedays = new FormControl('');
  membersts = new FormControl('');
  subscriptionstatus = new FormControl('');
  //mcpid_pymtmode = new FormControl('');
  mcpd_pymtapprovalstatus = new FormControl('');

  ngAfterViewInit(){
   this.fetchSupplierData()
  }
  reloadgrid(){
    this.fetchSupplierData();
  }
  getdeacitvatedata(data,type){
    if(type == 1){
      setTimeout(() => {
        this.deactivatesupplierref.supplierdeactivatepatchvalue(data); 
      }, 500); 
    }         
  }
  clickEvent(){
    
    this.hidefilder = !this.hidefilder;   
    if(!this.hidefilder)
    {
      this.filtername="Show Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display ='none';
      
    }else{
      this.filtername="Hide Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display ='flex';
      
    }
}
  filterChange(event){
    const filterselectedValues = <FormArray>this.filterFormGroup.get('certifiedFilterVal') as FormArray;
    if(event.checked){
      filterselectedValues.push(new FormControl(event.source.value)) 
    }else{
      var i = filterselectedValues.controls.findIndex(x => x.value === event.source.value);
      filterselectedValues.removeAt(i);
    }
  }
  paymentFilterChange(event){
    const paymentFilterSelectedValues = <FormArray>this.paymentFilterFormGroup.get('paymentFilterVal') as FormArray;
    if(event.checked){
      
      paymentFilterSelectedValues.push(new FormControl(event.source.value)) 
    }else{
      var i = paymentFilterSelectedValues.controls.findIndex(x => x.value === event.source.value);
      paymentFilterSelectedValues.removeAt(i);
    }
  }
   viewpage(regpk){
    
    if(regpk){
      this.router.navigate(['regapproval/viewandvalidate/',this.security.encrypt(regpk),0]);
    }
  }
  renewalhistry(regpk)
  {
    this.approvalService.getrenewaldetails(regpk).subscribe(res=>{
     
    });
  }
  selectOptionClear(){
    this.filterSelectedList.forEach(status=>{
      status.statusChecked=false;
    });
    this.fetchSupplierData();
  }
  paymentStatusClear(){
    this.paymentStatusSelectedList.forEach(status=>{
      status.statusChecked=false;
    });
    this.fetchSupplierData();
  }
  clearFilter(){
    if(this.searchControl.value){
      this.searchControl.setValue('');
    }
    if(this.mcm_RegistrationNo.value){
    this.mcm_RegistrationNo.setValue("");
    }
    if(this.MCM_SupplierCode.value){
    this.MCM_SupplierCode.setValue("");
    }
    if(this.MCM_CompanyName.value){
    this.MCM_CompanyName.setValue("");
    }
    if(this.CyM_CountryName_en.value){
    this.CyM_CountryName_en.setValue("");
    }
    if(this.MRM_RenewalStatus.value){
    this.MRM_RenewalStatus.setValue("");
    }
    if(this.mcpid_submittedon.value){
    this.mcpid_submittedon.setValue("");
    }
    if(this.MCPD_YrsOfSubs.value){
    this.MCPD_YrsOfSubs.setValue("");
    }
    if(this.invoicedays.value){
    this.invoicedays.setValue("");
    }
    if(this.membersts.value){
    this.membersts.setValue("");
    }
    if(this.subscriptionstatus.value){
    this.subscriptionstatus.setValue("");
    }
    // if(this.mcpid_pymtmode.value){
    // this.mcpid_pymtmode.setValue("");
    // }
    if(this.mcpd_pymtapprovalstatus.value){
    this.mcpd_pymtapprovalstatus.setValue("");
    }
  }
  refeshgrid(){
    this.fetchSupplierData();
  }
  fetchSupplierData() {
    this.tblplaceholder = true;
    this.supplierGridDatas = new SupplierPagination(this.http);
    this.sort?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var statusSelectId = [];
    var statusSelectObj = {};
    var paymentStatusId = [];
    var paymentStatusObj = {};
    var gridsearchvalue = {};
    var gridSearch = {};
    this.filterSelectedList.forEach(status=>{
      if(status.statusChecked == true){
        statusSelectId.push(status.id);
      }
    });
    statusSelectObj = {'certifiedFilterVal':statusSelectId};
    gridSearch = [{
      'searchby': this.searchByValue,
    'searchTxt': this.searchByText}];

    this.paymentStatusSelectedList.forEach(status=>{
      if(status.statusChecked == true){
        paymentStatusId.push(status.id);
      }
    });
    paymentStatusObj = {'paymentFilterVal':paymentStatusId};
    gridsearchvalue = {mcm_RegistrationNo:this.mcm_RegistrationNo.value,MCM_SupplierCode:this.MCM_SupplierCode.value,MCM_CompanyName:this.MCM_CompanyName.value,CyM_CountryName_en:this.CyM_CountryName_en.value,MRM_RenewalStatus:this.MRM_RenewalStatus.value,mcpid_submittedon:this.mcpid_submittedon.value,MCPD_YrsOfSubs:this.MCPD_YrsOfSubs.value,invoicedays:this.invoicedays.value,mcpd_pymtapprovalstatus:this.mcpd_pymtapprovalstatus.value,membersts:this.membersts.value,subscriptionstatus:this.subscriptionstatus.value,stktype:this.type};
    merge(this.sort?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.supplierGridDatas.supplierGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page, this.querystr, this.searchControl.value,JSON.stringify(statusSelectObj),
             JSON.stringify(paymentStatusObj),JSON.stringify(gridSearch),JSON.stringify(gridsearchvalue),this.type);
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
        this.noData = this.supplierListData.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
       });
  }
  createFilter(): (data: any, filter: string) => boolean {
      let filterFunction = function(data, filter): boolean {
        let searchTerms = JSON.parse(filter);
        return data.mcm_RegistrationNo.toLowerCase().indexOf(searchTerms.mcm_RegistrationNo) !== -1 &&
               data.MCM_SupplierCode.toLowerCase().indexOf(searchTerms.MCM_SupplierCode) !== -1 &&
               data.MCM_CompanyName.toLowerCase().indexOf(searchTerms.MCM_CompanyName) !== -1 &&
               data.CyM_CountryName_en.toLowerCase().indexOf(searchTerms.CyM_CountryName_en) !== -1 &&
               data.MRM_RenewalStatus.toLowerCase().indexOf(searchTerms.MRM_RenewalStatus) !== -1 &&
               data.mcpid_submittedon.toLowerCase().indexOf(searchTerms.mcpid_submittedon) !== -1 &&
               data.MCPD_YrsOfSubs.toLowerCase().indexOf(searchTerms.MCPD_YrsOfSubs) !== -1 &&
               data.invoicedays.toLowerCase().indexOf(searchTerms.invoicedays) !== -1 &&
               data.membersts.toLowerCase().indexOf(searchTerms.membersts) !== -1 &&
               data.subscriptionstatus.toLowerCase().indexOf(searchTerms.subscriptionstatus) !== -1 &&               
               data.mcpd_pymtapprovalstatus.toLowerCase().indexOf(searchTerms.mcpd_pymtapprovalstatus) !== -1;
      }
    return filterFunction;    
  }
  showSuccess2(){
    this.toastr.success('Payment invoice sent successfully.', 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showSuccess1(){
    this.toastr.success('Payment receipt sent successfully.', 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  getcompanytrackingdata(data){
    //setTimeout(() => {
      this.organlist.organiserdetailloader=true;
      this.organlist.getcompanytrackerdata(data); 
    //}, 500); 
  }
  resendInvoice(companypk,regpk){
    this.approvalService.resendInvoice(companypk,regpk).subscribe(res=>{
      // swal({
      //   icon:'success',
      //   title:'Payment invoice sent successfully.'        
      // });
    });
  }
  resendReceipt(companypk,regpk){
    this.approvalService.resendReceipt(companypk,regpk).subscribe(res=>{
      // swal({
      //   icon:'success',
      //   title:'Payment receipt sent successfully.',
        
      // });
    });
  }
  getcompdetails(regpk)
  {
    this.approvalService.getcompdetails(regpk).subscribe(res=>{
      this.compdetails=res['data'];
      
    });
  }

}

export class SupplierPagination {
  constructor(private http?: HttpClient) {
  }

  supplierGridUtil(sort: string, order: string, page: number, size: number, query: string, search?: string,filterVals?:string,paymentfilter?:string,searchValues?:string,gridsearchValues?:string,stktype?:string): Observable<any> {
    const href = environment.baseUrl + 'apr/approval/supplierdata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&statusFilter=${filterVals}&payfilter=${paymentfilter}&searchValues=${searchValues}&gridsearchValues=${gridsearchValues}&stktype=${stktype}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
