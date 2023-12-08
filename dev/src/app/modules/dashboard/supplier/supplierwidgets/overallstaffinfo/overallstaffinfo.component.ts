import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
@Component({
  selector: 'app-overallstaffinfo',
  templateUrl: './overallstaffinfo.component.html',
  styleUrls: ['./overallstaffinfo.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class OverallstaffinfoComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,private encrypt: Encrypt,
    private cookieService: CookieService,private myRoute: Router) { }
 @Input('DashboardCounts') DashboardCounts: any;
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
      this.patchbatchdetails(); 
    }

    patchbatchdetails()
    {
      console.log('+++++++++++++++++++++++++++++++++++++++')
      console.log(this.DashboardCounts);
    }
    navigate(count,role){
      var idName=this.encrypt.encrypt(role);
        this.myRoute.navigate(['newenterpriseadmin/addroles'],{ queryParams: { type: "Mw==", role: idName, id:'rd'}});
    }
}
