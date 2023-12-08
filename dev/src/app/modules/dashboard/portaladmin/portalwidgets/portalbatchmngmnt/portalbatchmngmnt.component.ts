import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ApplicationService } from '@app/services/application.service';

@Component({
  selector: 'app-portalbatchmngmnt',
  templateUrl: './portalbatchmngmnt.component.html',
  styleUrls: ['./portalbatchmngmnt.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class PortalbatchmngmntComponent implements OnInit {

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  dataSource_data: any = [];
  isfocalpoint: any;
  stktype: any;
  public useraccess:any;
  ongoingtraining: boolean  = false;
  req_for_backtrack: boolean  = false;
  req_rec_to_cng_accessor: boolean  = false;

  accessdesktop: boolean  = false;
  accesspayment: boolean = false;
  accessauditor: boolean = false;
  accessqualitymanager: boolean = false;
  accessAuthority: boolean = false;
  accessceo: boolean = false;

  accessadmin:boolean = false;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router, public localstorage: AppLocalStorageServices,  private appservice: ApplicationService,) { }

    @Input('DashboardCounts') DashboardCounts :any;

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
  
      
      this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
      this.stktype = this.localstorage.getInLocal('stktype');

      if(this.isfocalpoint == 2)
      {
       this.useraccess = this.localstorage.getInLocal('uerpermission');
      
       this.SetUseraccess();
      }
      else{
        this.req_rec_to_cng_accessor = true;
        this.req_for_backtrack = true;
        this.ongoingtraining = true;
      }
     
    }
    SetUseraccess()
    {
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      // 10 - Training Evaluation Centre Approval 11- Standard & Customized Course Approval 12 - Technical Inspection Centre Approval
      if(this.useraccess[moduleid] && this.useraccess[moduleid][4] && this.useraccess[moduleid][4].read == 'Y'){
        this.ongoingtraining = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][4] && this.useraccess[moduleid][4].approval == 'Y'){
        this.req_for_backtrack = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][7] && this.useraccess[moduleid][7].create == 'Y'){
        this.req_rec_to_cng_accessor = true;
      }

    }
    navigate(count,type){

      if(count>0){
        this.myRoute.navigate(['/batchindex/batchgridlisting'],{ queryParams: { tye:type }} );
      }
  
    }


}
