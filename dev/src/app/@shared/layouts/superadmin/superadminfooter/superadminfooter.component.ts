import { Component, OnInit } from '@angular/core';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { ToastrService } from 'ngx-toastr';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-superadminfooter',
  templateUrl: './superadminfooter.component.html',
  styleUrls: ['./superadminfooter.component.scss']
})
export class SuperadminfooterComponent implements OnInit {
  eng: boolean = true;
  currentyear: number = new Date().getFullYear();
  constructor( private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
                  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
                  lang = '1';
                  dir = 'ltr';
  ngOnInit() {
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

}
