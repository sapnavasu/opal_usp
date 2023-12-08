import { Component, Input, OnInit, ViewEncapsulation  } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
export interface Batchtraininginfo {
  batchno: string;
  batchtype: string;
  batchduration: string;
  batchstatus: string;
}

export interface Batchassessmentinfo {
  assessmentno: string;
  assessmenttype: string;
  totallearners: string;
  assessmentduration: string;
  assessmentstatus: string;
}

@Component({
  selector: 'app-batchmanagment',
  templateUrl: './batchmanagment.component.html',
  styleUrls: ['./batchmanagment.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class BatchmanagmentComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  @Input('DashboardCounts') DashboardCounts: any;
  @Input('BatchTPData') BatchTPData: any;
  @Input('BatchACData') BatchACData: any;


 

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router) { }

    trainingdataSource: Batchtraininginfo[] ;
    trainingdisplayedColumns: string[] = ['batchno', 'batchtype', 'batchdurationth', 'batchstatus'];
 

  assessmetdisplayedColumns: string[] = ['assessmentno', 'assessmenttype', 'totallearners', 'assessmentduration', 'assessmentstatus'];
  assessmetdataSource : Batchassessmentinfo[];

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
    console.log(this.DashboardCounts);
    this.trainingdataSource = this.BatchTPData;
    this.assessmetdataSource = this.BatchACData;
  }
  navigate(count,type){

    if(count>0){
      this.myRoute.navigate(['/batchindex/batchgridlisting'],{ queryParams: { tye:type }} );
    }

  }

  viewBatchdtls(batchid)
  {
    this.myRoute.navigate(['/batchindex/batchviewpage/'+batchid]);
  }

}
