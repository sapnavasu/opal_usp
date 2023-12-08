import { Component, OnInit } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { environment } from '@env/environment';
@Component({
  selector: 'app-registrationfooter',
  templateUrl: './registrationfooter.component.html',
  styleUrls: ['./registrationfooter.component.scss']
})
export class RegistrationfooterComponent implements OnInit {
  eng: boolean = true;
  arabiclogo: boolean = false;
  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
  ) { }
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
                  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];

  ngOnInit(): void {
    const basePath = environment.basePath;
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.eng = true;
        this.arabiclogo = false;
      }
      else {
        this.eng = false;
        this.arabiclogo = true;
      }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.eng = true;
      this.arabiclogo = false;
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
          this.arabiclogo = false;
        }
        else {
          this.eng = false;
          this.arabiclogo = true;
        }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.eng = true;
        this.arabiclogo = false;
      }
    });
  }
  lang = '1';
  dir = 'ltr';
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
