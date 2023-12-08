import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-paymentproof',
  templateUrl: './paymentproof.component.html',
  styleUrls: ['./paymentproof.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class PaymentproofComponent implements OnInit {
  @Input('paymentproofdrawer') paymentproofdrawer: MatDrawer;
  @Input('compdetails') compdetails: any=[];
  @Input('paymentsubdata') paymentdata: any=[];
  paymentsubdata: any=[];
  animationState7 = 'out';
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"

  ngOnInit(): void {
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
  }
  ngOnChanges(){
    this.paymentsubdata = this.paymentdata?.data?.invoiceinfo;
  }
  paymentproofclose(){
    this.paymentproofdrawer.toggle();
    this.animationState7 = 'out';
  }

paymentprooflist(divName: string) {
  if (divName === 'paymentprooflistdata') {
    this.animationState7 = this.animationState7 === 'out' ? 'in' : 'out';
  }
}
}
