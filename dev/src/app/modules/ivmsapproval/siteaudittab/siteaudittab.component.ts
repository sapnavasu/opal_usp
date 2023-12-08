import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { MatCheckbox } from '@angular/material/checkbox';

interface TabList {
  tabtitle: string;
}
@Component({
  selector: 'app-siteaudittab',
  templateUrl: './siteaudittab.component.html',
  styleUrls: ['./siteaudittab.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SiteaudittabComponent implements OnInit {
  @Input() mattab: number = 0;
  public tab1: string = 'Site Audit';
  public tab2: string = 'Staff Practical Assessment';
  tabList: TabList[] = [
    {tabtitle:'30 Daye Pre-Evaluation'},
    {tabtitle:'30 Daye Pre-Evaluation'},
    {tabtitle:'30 Daye Pre-Evaluation'},
  ]
  constructor(private translate: TranslateService,
    private remoteService: RemoteService, 
    private cookieService: CookieService){}
 
    i18n(key) {
      return this.translate.instant(key);
    }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
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
  cancel() {
    this.mattab--;
  }

  next() {
    this.mattab++;
  }

  checkAllFun(evant: MatCheckbox) {
    if (event) {
      alert()
    }
  }
}
