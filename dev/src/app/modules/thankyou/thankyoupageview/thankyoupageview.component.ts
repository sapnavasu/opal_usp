import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
@Component({
  selector: 'app-thankyoupageview',
  templateUrl: './thankyoupageview.component.html',
  styleUrls: ['./thankyoupageview.component.scss']
})
export class ThankyoupageviewComponent implements OnInit {

  @Input('type') type: any;
  @Input('oldUser') oldUser: any;
  @Input('newUser') newUser: any;

  constructor(private router: Router,  private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }

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


  navigate() {
    this.router.navigate(['/admin/login']);
  }
  

}
