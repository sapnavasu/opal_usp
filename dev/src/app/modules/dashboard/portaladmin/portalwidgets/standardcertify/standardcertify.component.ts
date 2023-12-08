import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

export interface Standardcertify {
  desktopreview: string;
  confirmpayment: string;
  auditready: string;
  auditreport: string;
}

const ELEMENT_DATA: Standardcertify[] = [
  {desktopreview: '30',confirmpayment: '07',auditready: '24',auditreport: '12'}
];

@Component({
  selector: 'app-standardcertify',
  templateUrl: './standardcertify.component.html',
  styleUrls: ['./standardcertify.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class StandardcertifyComponent implements OnInit {

  
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
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
  disableSubmitButton: boolean;
  role: any;
  apparray: any = [];
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router, private appservice: ApplicationService, public localstorage: AppLocalStorageServices,) { }
    @Input('DashboardCounts') DashboardCounts :any;
    @Input('courseaccess') courseaccess :any;

  displayedColumns: string[] = ['desktopreview', 'confirmpayment', 'auditready', 'auditreport'];
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
    
   
      var displayedColumns = [];

      if (this.courseaccess['approval'] && this.courseaccess['accessdesktop'] ) {
        displayedColumns.push('desktopreview');
      }
      
      if (this.courseaccess['approval'] && this.courseaccess['accesspayment']) {
        displayedColumns.push('confirmpayment');
      }
      
      if (this.courseaccess['approval'] && this.courseaccess['accessauditor']) {
        displayedColumns.push('auditready');
      }
      
      if (this.courseaccess['approval'] && (this.courseaccess['accessqualitymanager']|| this.courseaccess['accessAuthority'] ||  this.courseaccess['accessceo'])) {
        displayedColumns.push('auditreport');
      }
      
      this.displayedColumns = displayedColumns;

      console.log(displayedColumns)
    
    this.patchdetails();
  }

  patchdetails()
  {
     let obj = {
      desktopreview: this.DashboardCounts.Desktop_Review_of_course,
      confirmpayment: this.DashboardCounts.Confirm_Payment_of_course,
      auditready:this.DashboardCounts.Ready_for_Audit_of_course,
      auditreport:this.DashboardCounts.Audit_Report_Approval_of_course,
     };
     
     this.dataSource_data.push(obj);
     console.log(this.dataSource_data)
  }
  navigate(count,type){

   
    if(type == 'd')
    {
    
      if(count>0){
        this.myRoute.navigate(['/standardcourseapproval/approvaldetails'],{ queryParams: {desktopfilter:'2,4,20'}});
      }
    }
    else if(type == 'c')
    {
     
      if(count>0){
        this.myRoute.navigate(['/standardcourseapproval/approvaldetails'],{ queryParams: {desktopfilter:'6'}});
      }
    }
    else if(type == 'ar')
    {
      
      if(count>0){
        this.myRoute.navigate(['/standardcourseapproval/approvaldetails'],{ queryParams: {desktopfilter:'9,13'}});
      }
    }
    else if(type == 'arep')
    {
     
      if(count>0){
        this.role = this.localstorage.getInLocal('role');
        this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
      
        if(this.isfocalpoint == 1){
          this.myRoute.navigate(['/standardcourseapproval/approvaldetails'],{ queryParams: {desktopfilter:'10,11,12,14,15,16'}});
       }else{
        if (this.role.indexOf("3") !== -1) {
          this.apparray.push("10");
          this.apparray.push("14");
        }
        if (this.role.indexOf("4") !== -1) {
          this.apparray.push("11");
          this.apparray.push("15");
        }
        if (this.role.indexOf("7") !== -1) {
          this.apparray.push("12");
          this.apparray.push("16");
        }
        var filter = this.apparray.join(',');
        this.myRoute.navigate(['/standardcourseapproval/approvaldetails'],{ queryParams: {desktopfilter:filter}});
       }
      }
    }


 

  }
  SetUseraccess()
  {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
    // 10 - Training Evaluation Centre Approval 11- Standard & Customized Course Approval 12 - Technical Inspection Centre Approval
    if(this.useraccess[moduleid] && this.useraccess[moduleid][11] && this.useraccess[moduleid][11].approval == 'Y'){
      this.approval = true;
    }
   
  }

}
