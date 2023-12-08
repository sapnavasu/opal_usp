import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
export interface Branchoffice {
  total: string;
  certify: string;
  active: string;
  nearingexpiry: string;
  expired: string;
  suspended: string;
}

const ELEMENT_DATA: Branchoffice[] = [
  {total: '30',certify: '07',active: '24',nearingexpiry: '12',expired: '05',suspended: '01'}
];


@Component({
  selector: 'app-branchofficecertificate',
  templateUrl: './branchofficecertificate.component.html',
  styleUrls: ['./branchofficecertificate.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class BranchofficecertificateComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  @Input() DashboardCounts: any;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router,private secuirty: Encrypt) { }

  displayedColumns: string[] = ['total', 'certify', 'active', 'nearingexpiry', 'expired', 'suspended'];
  dataSource = ELEMENT_DATA;

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
  //  if(count>0){
      this.myRoute.navigate(['/trainingcentremanagement/branchcentre'],{ queryParams: {p:this.secuirty.encrypt(1),type:value }} );
   // }
  }

}
