import { Component, Input, OnInit , ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
export interface Tbranchoffice {
  ttotal: string;
  tcertify: string;
  tactive: string;
  tnearingexpiry: string;
  texpired: string;
  tsuspended: string;
}

const TELEMENT_DATA: Tbranchoffice[] = [
  {ttotal: '30',tcertify: '07',tactive: '24',tnearingexpiry: '12',texpired: '05',tsuspended: '01'}
];

@Component({
  selector: 'app-tbranchofficecertificate',
  templateUrl: './tbranchofficecertificate.component.html',
  styleUrls: ['./tbranchofficecertificate.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class TbranchofficecertificateComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private myRoute: Router,private secuirty: Encrypt) { }

  tdisplayedColumns: string[] = ['ttotal', 'tcertify', 'tactive', 'tnearingexpiry', 'texpired', 'tsuspended'];
  tdataSource = TELEMENT_DATA;
  @Input('rasBranchdata') rasBranchdata: any;

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
  navigate(count,value){
     if(count>0){
        this.myRoute.navigate(['/trainingcentremanagement/rasbranchcentre'],{ queryParams: {p:this.secuirty.encrypt(4), type:value }} );
     }
    }

}
