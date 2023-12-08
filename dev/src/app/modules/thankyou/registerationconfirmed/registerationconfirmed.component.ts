import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registerationconfirmed',
  templateUrl: './registerationconfirmed.component.html',
  styleUrls: ['./registerationconfirmed.component.scss']
})
export class RegisterationconfirmedComponent implements OnInit {
  currentyear: number = new Date().getFullYear();
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private router: Router,
  ) { }
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
dir = 'ltr';
  ngOnInit() {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.cookieService.set('languageCookieId', toSelect.id);
      this.cookieService.set('languageCode', toSelect.languagecode);
      this.cookieService.set('dir', toSelect.dir);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
     
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        
      }
    });
   
  }
  lang = '1';
  setLanguageFlag(value) {
    this.lang = value == '1' ? '2' : '1';
    const toSelect = this.languagelist.find(c => c.id === this.lang);
    this.cookieService.set('languageCookieId', toSelect.id);
    this.cookieService.set('languageCode', toSelect.languagecode);
    this.cookieService.set('dir', toSelect.dir);
    this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    this.remoteService.languageCookieValue(toSelect);
  }
  navigate() {
    this.router.navigate(['/admin/login']);
  }
  
}
