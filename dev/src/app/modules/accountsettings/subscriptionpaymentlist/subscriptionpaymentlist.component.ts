import { Component, Input, OnInit ,ViewChild} from '@angular/core';

import {ViewEncapsulation } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import {ApprovalService} from './../../registartionapproval/approval.service';
import { ActivatedRoute,Router } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Component({
  selector: 'app-subscriptionpaymentlist',
  templateUrl: './subscriptionpaymentlist.component.html',
  styleUrls: ['./subscriptionpaymentlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SubscriptionpaymentlistComponent implements OnInit {
  panelOpenState: boolean = false;
  panel: number = 1;
  @Input() panelNo: number;
  @ViewChild('drawercontactus') drawercontactus: MatDrawer;
  animationState = 'out';
  animationState1 = 'out';
  animationState2 = 'out';
  orginstatus: any;
  @Input() settingsData: any;
  @Input() compPk: any;
  @Input() contactusData: any;
  @Input() openonlyRenewal: boolean;
  @Input() isGraceExpired: boolean;
  @ViewChild('certificaterenewaldrawer') certificaterenewaldrawer: MatDrawer;
  @ViewChild('changesubscriptiondrawer') changesubscriptiondrawer: MatDrawer;
  public hideChangeSubscription: boolean = false;
  public drtrenew: boolean=false;
  renewalDays: any='';
  constructor(private approvalservice: ApprovalService, private myRoute: Router, public routeid: ActivatedRoute,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localStorage: AppLocalStorageServices,
    ) { }

  ngOnInit() { 
    this.orginstatus = this.localStorage.getInLocal('origin');
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
    });
    this.getForeignClassification();   
    this.routeid.queryParams.subscribe(params => {
      this.drtrenew = (params['nav'] == 'yes') ? true : false;
    });
   
  }
  ngAfterViewInit(){
    
  }
  
  showdropdown(divName: string) {
    if (divName === 'businessunitinfo') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  showdropdowndownload(divName: string) {
    if (divName === 'securityinfo') {
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
  }
  clickdropdown(divName: string) {
    if (divName === 'paymentinfo') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
  getForeignClassification(){
    this.approvalservice.checkforeignclassification(this.compPk).subscribe(data => {
      if (data['data'].status == 1) {
        this.hideChangeSubscription = true;        
      }
    });
  }

  downloadInvoice(){
    window.open(this.settingsData.invoiceLink,'_blank');
  }

  downloadReceipt(){
    window.open(this.settingsData.receiptLink,'_blank');
  }
  setOpen(i) {
    this.panel = i;
  }
  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
    } catch (error) {
        console.log('page-content')
        }
    }
}
