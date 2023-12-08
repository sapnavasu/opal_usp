import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Encrypt } from '@app/common/class/encrypt';@Component({
  selector: 'app-trainingcertify',
  templateUrl: './trainingcertify.component.html',
  styleUrls: ['./trainingcertify.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class TrainingcertifyComponent implements OnInit {

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  disableSubmitButton: boolean;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router, private appservice: ApplicationService, public localstorage: AppLocalStorageServices,private security: Encrypt) { }    @Input('DashboardCounts') DashboardCounts :any;
    @Input('trainaccess') trainaccess :any;
  displayedColumns: string[] = ['desktopreview', 'confirmpayment', 'auditready', 'auditreport'];
  
  dataSource_data: any = [];
  isfocalpoint: any;
  stktype: any;
  public useraccess:any;
  approval = false;

  accessdesktop: boolean  = false;
  accesspayment: boolean = false;
  accessauditor: boolean = false;
  accessqualitymanager: boolean = false;
  accessAuthority: boolean = false;
  accessceo: boolean = false;

  accessadmin:boolean = false;
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
    // this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    // this.stktype = this.localstorage.getInLocal('stktype');

    //  this.useraccess = this.localstorage.getInLocal('uerpermission');
    //  this.SetUseraccess();


    console.log(this.trainaccess)
      var displayedColumns = [];

      if (this.trainaccess['approval'] && this.trainaccess['accessdesktop'] ) {
        displayedColumns.push('desktopreview');
      }
      
      if (this.trainaccess['approval'] && this.trainaccess['accesspayment']) {
        displayedColumns.push('confirmpayment');
      }
      
      if (this.trainaccess['approval'] && this.trainaccess['accessauditor']) {
        displayedColumns.push('auditready');
      }
      
      if (this.trainaccess['approval'] && (this.trainaccess['accessqualitymanager']|| this.trainaccess['accessAuthority'] ||  this.trainaccess['accessceo'])) {
        displayedColumns.push('auditreport');
      }
      
      this.displayedColumns = displayedColumns;

      console.log(displayedColumns)
    
    this.patchdetails();  
   
  }
  SetUseraccess()
    {
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
      // 10 - Training Evaluation Centre Approval 11- Standard & Customized Course Approval 12 - Technical Inspection Centre Approval
      if(this.useraccess[moduleid] && this.useraccess[moduleid][10] && this.useraccess[moduleid][10].approval == 'Y'){
        this.approval = true;
      }
     
    }
  patchdetails()
  {
     let obj = {
      desktopreview: this.DashboardCounts.Desktop_Review_of_Center,
      confirmpayment: this.DashboardCounts.Confirm_Payment_of_center,
      auditready:this.DashboardCounts.Ready_for_Audit_of_center,
      auditreport:this.DashboardCounts.Audit_Report_Approval_of_center,
     };
     
     this.dataSource_data.push(obj);
     console.log(this.dataSource_data)
  }
  
  navigate(count,value){

    if(count>0){
      this.myRoute.navigate(['/centrecertification/home/'+this.security.encrypt(1)],{ queryParams: { type:value }});
    }

  }

}
