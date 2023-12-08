import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
export interface Batchinfo {
  coursename: string;
  ctotal: string;
  ccertify: string;
  cactive: string;
  cnearingexpiry: string;
  cexpired: string;
  csuspended: string;
}

const ELEMENT_DATA: Batchinfo[] = [
  {coursename:'Standard Courses', ctotal: '18',ccertify: '07',cactive: '14',cnearingexpiry: '08',cexpired: '03',csuspended: '00'},
  {coursename:'Customized Courses', ctotal: '12',ccertify: '04',cactive: '10',cnearingexpiry: '04',cexpired: '02',csuspended: '01'}
];

@Component({
  selector: 'app-courseinformation',
  templateUrl: './courseinformation.component.html',
  styleUrls: ['./courseinformation.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class CourseinformationComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  ifarabic: boolean;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router) { }
    @Input('DashboardCounts') DashboardCounts: any;
  displayedColumns: string[] = ['coursename', 'ctotal', 'ccertify', 'cactive', 'cnearingexpiry', 'cexpired', 'csuspended'];
  dataSource:any = [];

  ngOnInit() { 
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.ifarabic = false;
       }else{
         this.ifarabic = true;
       }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.ifarabic = false;
         }else{
           this.ifarabic = true;
         }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.ifarabic = false;
      }
    });    
    this.patchdetails();
  }
  patchdetails()
  {

     let obj = {
      coursename: 'Standard Courses',
      ctotal: this.DashboardCounts.Total_sc,
      ccertify:this.DashboardCounts.Yet_to_Certify_sc,
      cactive:this.DashboardCounts.Active_sc,
      cnearingexpiry: this.DashboardCounts.NearingExpiry_sc,
      cexpired:this.DashboardCounts.Expired_sc,
      csuspended:this.DashboardCounts.Suspended_sc,
     };
     
     this.dataSource.push(obj);

     let obj2 = {
      coursename: 'Customized Courses',
      ctotal: this.DashboardCounts.Total_cc,
      ccertify:this.DashboardCounts.YettoCertify_cc,
      cactive:this.DashboardCounts.Active_cc,
      cnearingexpiry: this.DashboardCounts.Nearing_Expiry_cc,
      cexpired:this.DashboardCounts.Expired_cc,
      csuspended:this.DashboardCounts.Suspended_cc,
     };
     
     this.dataSource.push(obj2);

     console.log(this.dataSource)
  }
  navigate(count,corsetye,serch){
   
    if(corsetye == 'Standard Courses'){
      var  tye='s';
    }else if(corsetye == 'Customized Courses'){
      var  tye='c';
    }else{
      var  tye='all';
    }
    if(count>0){
      this.myRoute.navigate(['/standardcourse/home'],{ queryParams: { tye:tye,k:serch } });
    }

  }

}
