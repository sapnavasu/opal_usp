import { Component, Input, OnInit, ViewChild, ViewEncapsulation, SimpleChanges } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { MatTableDataSource } from '@angular/material/table';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import {ApprovalService} from './../approval.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import {Router,ActivatedRoute} from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';

export interface Element {
  
  date: any;
  subscriptionname: string;
  subscriptionfee: string;
  invoiceamount: string;
  status: string;
}
const ELEMENT_DATA: Element[] = [];

@Component({
  selector: 'app-subscriptionpaytracker',
  templateUrl: './subscriptionpaytracker.component.html',
  styleUrls: ['./subscriptionpaytracker.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class SubscriptionpaytrackerComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @Input('subcriptionpaytracker') subcriptionpaytracker: MatDrawer;
  @ViewChild('subcriptionpaydetail') subcriptionpaydetail: MatDrawer;
  @ViewChild('paymentproofdrawer') paymentproofdrawer: MatDrawer;
  @Input('regpk') regpk: any;
  @Input('paymentdata') paymentdata: any=[];
  @Input('type') type:any;
  compdetails:any = [];
  invoiceinfo:any = [];
  paymentsubdata:any = [];
  loadpaymentinvoiceinfo: boolean=false;
  animationState5 = 'out';
  displayedColumns = [
    "date",
    "subscription_name",
    "classification",
    "subscription_fee",
    "invoice_amount",
    "paymentstatus",
    "action",
  ];
  dataSource = new MatTableDataSource<Element>();
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private approvalService: ApprovalService,public localstorage: AppLocalStorageServices,  private router: Router,public toastr: ToastrService) { }
  public lusrtpye:any=null;
  public useraccess:any;

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"

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
    this.lusrtpye = this.localstorage.getInLocal('usertype');
    if(this.lusrtpye == 'U'){
        this.useraccess = this.localstorage.getInLocal('uerpermission');
    }    
  }
  ngOnChanges(changes: SimpleChanges): void {
    this.compdetails = this.paymentdata?.data?.compinfo;
    this.invoiceinfo = this.paymentdata?.data?.invoiceinfo;
    this.dataSource = this.invoiceinfo;
  }
  checkpermission(url){
   
    if(this.type == 6){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[289] &&  this.useraccess[289].download == 'Y') {
      window.open(url, "_blank");
      // this.router.navigate([url]);
    }else{
      this.toastr.warning(this.i18n('subscriptionpaytracker.youdonthaveperm'), this.i18n('subscriptionpaytracker.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }else if(this.type == 15){
    if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[290] &&  this.useraccess[290].download == 'Y') {
      window.open(url, "_blank");
      // this.router.navigate([url]);
    }else{
      this.toastr.warning(this.i18n('subscriptionpaytracker.youdonthaveperm'), this.i18n('subscriptionpaytracker.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

  }

  }
  subcriptionclosedrawer(){
      this.subcriptionpaytracker.toggle();
      this.animationState5 = 'out';
  }
  getPaymentInfo(invpk) {
    this.loadpaymentinvoiceinfo = true;
    this.approvalService.getsubpaymentdetails(invpk).subscribe(res => {
      this.paymentsubdata = res['data'];
    });
  }
  subscriptionpaylist(divName: string) {
    if (divName === 'subscriptionpaylistview') {
      this.animationState5 = this.animationState5 === 'out' ? 'in' : 'out';
    }
  }
}
