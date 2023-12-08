import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-ivmstab',
  templateUrl: './ivmstab.component.html',
  styleUrls: ['./ivmstab.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class IvmstabComponent implements OnInit {
  
  @Input() mattab: number = 2;
  public doubleLoader: boolean;
  public projectpk: any = 'IVMS';
  public tab1: any;
  public tab2: string;
  public tab3: string;
  public tab4: string;
  public tab5: string;
  public tab6: string;
  public tab7: string;
  
  appdata: any;

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
    this.checkprojectpk();
  }
   
 checkprojectpk() {
  if(this.projectpk == 'IVMS') {
    this.tab1 = this.i18n('maincenter.compdeti');
    this.tab2 = this.i18n('IVMS Vendor Information');
    this.tab3 = this.i18n('Company Documents Required');
    this.tab4 = this.i18n('Operator Contact Details');
    this.tab5 = this.i18n('Device Model Information');
    this.tab6 = this.i18n('Device Document Required');
    this.tab7 = this.i18n('staff.staff');
  }
 }
  cancel() {
    this.mattab--;
  }

  next() {
    this.mattab++;
  }

  companyDetailsform(data: any) {
    console.log(data)
    this.mattab++
  }
  
  vendoryDetailsform(data: any) {
    console.log(data)
    this.mattab++
  }
  getapplicationdata(data){

    this.appdata = data

    // alert( this.appdata)

  }
  
  
}
