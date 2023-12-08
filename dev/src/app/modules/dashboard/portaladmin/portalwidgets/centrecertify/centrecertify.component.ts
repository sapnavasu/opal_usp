import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Encrypt } from '@app/common/class/encrypt';
import { Router } from '@angular/router';
export interface Centercertify {
  desktopreview: string;
  confirmpayment: string;
  auditready: string;
  auditreport: string;
}

const ELEMENT_DATA: Centercertify[] = [
  {desktopreview: '30',confirmpayment: '07',auditready: '24',auditreport: '12'}
];

@Component({
  selector: 'app-centrecertify',
  templateUrl: './centrecertify.component.html',
  styleUrls: ['./centrecertify.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class CentrecertifyComponent implements OnInit {

  
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService, private myRoute: Router,private security: Encrypt) { }

  displayedColumns: string[] = ['desktopreview', 'confirmpayment', 'auditready', 'auditreport'];
  dataSource = ELEMENT_DATA;
  @Input('certifycounts') certifycounts: any;
  @Input('rasaccess') rasaccess: any;
  // @Input() public set rasaccess(value: any) {
  //   this.rasaccess = value;     
  // }
  // public get rasaccess() {
  //   return this.rasaccess;
  // }

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
    var displayedColumns = [];
    if (this.rasaccess['approval'] && this.rasaccess['accessdesktop'] ) {
      displayedColumns.push('desktopreview');
    }
    
    if (this.rasaccess['approval'] && this.rasaccess['accesspayment']) {
      displayedColumns.push('confirmpayment');
    }
    
    if (this.rasaccess['approval'] && this.rasaccess['accessauditor']) {
      displayedColumns.push('auditready');
    }
    
    if (this.rasaccess['approval'] && (this.rasaccess['accessqualitymanager']|| this.rasaccess['accessAuthority'] ||  this.rasaccess['accessceo'])) {
      displayedColumns.push('auditreport');
    }
    
    this.displayedColumns = displayedColumns;

  }

  navigate(count,value){
    if(count>0){
      this.myRoute.navigate(['/centrecertification/rashome/'+this.security.encrypt(4)],{ queryParams: { type:value }});
    }
  }
}
