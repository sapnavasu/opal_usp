import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from "@angular/router";
import { environment } from '@env/environment';
@Component({
  selector: 'app-registrationheader',
  templateUrl: './registrationheader.component.html',
  styleUrls: ['./registrationheader.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class RegistrationheaderComponent implements OnInit {
  @Input() usernameshow: string;
  public basePath
  eng: boolean = true;
  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    protected router: Router,
  ) { }
  isShowHideFlag = "over";
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
                  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir = 'ltr';
  ngOnInit(): void {
    console.log(this.usernameshow,'usernameshow');
    this.basePath = environment.basePath;
    console.log('this.basePath', this.basePath )
    // this.basePath = "https://opaloman.om/uat8686"
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.eng = true;
      }
      else {
        this.eng = false;
      }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.eng = true;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.eng = true;
        }
        else {
          this.eng = false;
        }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.eng = true;
      }
    });
  }
  routeTo() {
      //this.router.navigate(['admin/login']);
      location.href = "admin/login";
  }
   lang = '1';
  setLanguageFlag(value) {  
    this.lang =  value=='1'? '2': '1'; 
    const toSelect = this.languagelist.find(c => c.id === this.lang);
    this.cookieService.set('languageCookieId', toSelect.id);  
    this.cookieService.set('languageCode', toSelect.languagecode); 
    this.cookieService.set('dir', toSelect.dir); 
    this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    this.remoteService.languageCookieValue(toSelect);
} 

}
