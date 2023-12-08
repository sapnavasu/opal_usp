import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
@Component({
  selector: 'app-mainofficecertificate',
  templateUrl: './mainofficecertificate.component.html',
  styleUrls: ['./mainofficecertificate.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class MainofficecertificateComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr";
  
  @Input() centredtls: any;
  @Input() web_url: any;
  memReg: any;
  ifarabic: boolean  = false;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private localStorage: AppLocalStorageServices,
    private cookieService: CookieService,
    public routeid: ActivatedRoute,private route: Router,private security: Encrypt) { }

    ngOnInit() { 
      
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.ifarabic = false;
         }else{
           this.ifarabic = true;
         }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.ifarabic = false;
      }
      this.remoteService.getLanguageCookie().subscribe(data => {
        this.translate.setDefaultLang(this.cookieService.get('languageCode'));
        if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
          const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
          //this.patientCategory.get('patientCategory').setValue(toSelect);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          if(toSelect.languagecode == 'en'){
            this.ifarabic = false;
           }else{
             this.ifarabic = true;
           }
        } else {
          const toSelect = this.languagelist.find(c => c.id == '1');
          //this.patientCategory.get('patientCategory').setValue(toSelect);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          this.ifarabic = false;
        }
      }); 
      
      this.memReg = this.localStorage.getInLocal('reg_pk');
      setTimeout(() => {
        console.log("centredtls",this.centredtls.applicationdtlsmain_pk);
        },1000);
      
    }

    showprofile(){
      
      this.route.navigate(['/trainingcentremanagement/ViewMaincentre'] ,{ queryParams: { app_pk: this.security.encrypt(this.centredtls.applicationdtlsmain_pk) }});
      //window.open(this.web_url+'view-profile/?view_id='+this.memReg, "_blank");
    }
    renew(data){
      if(data.appstatus == 1 || data.appstatus == 3 || data.appstatus == 17){
        this.route.navigate(['/trainingcentremanagement/maincentre'] ,{ queryParams: {p: this.security.encrypt(1), renew: this.security.encrypt(1) ,dash:'ys'}});
      } else if(data.appstatus == 2 || data.appstatus == 4 ){
        this.route.navigate(['/trainingcentremanagement/maincentre'] ,{ queryParams: { p: this.security.encrypt(1),renew: this.security.encrypt(3),dash:'ys' }});
      }else {
        this.route.navigate(['trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(data.project), t: this.security.encrypt(data.apptype), s: this.security.encrypt(data.appstatus), at: this.security.encrypt(data.applicationdtlstmp_pk), bc: 'paycnt', f: 'mc',nwrn: 'rnj',dash:'ys'} });    
    }
  }
}
