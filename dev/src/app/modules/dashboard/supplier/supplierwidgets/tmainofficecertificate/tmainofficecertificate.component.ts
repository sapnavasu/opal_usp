import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
@Component({
  selector: 'app-tmainofficecertificate',
  templateUrl: './tmainofficecertificate.component.html',
  styleUrls: ['./tmainofficecertificate.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class TmainofficecertificateComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private route: Router,private security: Encrypt) { }

    @Input('rascompanydtls') rascompanydtls: any;
    ngOnInit() { 
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
      this.remoteService.getLanguageCookie().subscribe(data => {
        this.translate.setDefaultLang(this.cookieService.get('languageCode'));
        if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
          const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
          //this.patientCategory.get('patientCategory').setValue(toSelect);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
        } else {
          const toSelect = this.languagelist.find(c => c.id == '1');
          //this.patientCategory.get('patientCategory').setValue(toSelect);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
        }
      });    
    }
    renew(data){
      if(data.appstatus == 1 || data.appstatus == 3 || data.appstatus == 17){
        this.route.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),dash:'ys' }});
      } else if(data.appstatus == 2 || data.appstatus == 4 ){
        this.route.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: { p: this.security.encrypt(4),renew: this.security.encrypt(3),dash:'ys' }});
      }else {
        this.route.navigate(['trainingcentremanagement/rascentre'], { queryParams: { p: this.security.encrypt(data.project), t: this.security.encrypt(data.apptype), s: this.security.encrypt(data.appstatus), at: this.security.encrypt(data.applicationdtlstmp_pk), bc: 'paycnt', f: 'mc',nwrn: 'rnj',dash:'ys'} });    
    }
  }
  showprofile(){
    this.route.navigate(['/vehiclemanagement/viewras'],{ queryParams: { app_pk: this.security.encrypt(this.rascompanydtls.applicationdtlsmain_pk) }});
  }
}
