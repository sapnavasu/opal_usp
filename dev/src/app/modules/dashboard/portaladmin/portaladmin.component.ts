import { Component, Input, OnInit, Inject, ViewEncapsulation} from '@angular/core';
import { NavigationExtras, Router } from '@angular/router';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { DashboardService } from '../dashboard.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import swal from 'sweetalert';
@Component({
  selector: 'app-portaladmin',
  templateUrl: './portaladmin.component.html',
  styleUrls: ['./portaladmin.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class PortaladminComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  disableSubmitButton: boolean;
  DashboardCounts: any;
 public useraccess:any;
certifycounts: any;
  Invoicecounts: any; 
  trainaccess:any = [];
  courseaccess:any = [];
  rasaccess:any = [];
  approvaltrain: boolean;
  train: boolean;
  approvalcourse: boolean;
  course: boolean;
  ras: boolean;
  approvalras: boolean = false;
  trainingaccessproject:  boolean = false;
  courseaccessproject: boolean = false;
  rasaccessproject:  boolean = false;
  centreinvoicereadaccess: boolean;
  courseinvoicereadaccess: boolean;
  royalityinvoicereadaccess: boolean;
  batchreadaccess: boolean;
  DashboardcourseCounts: any;
   constructor( private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private dashboardService: DashboardService,
    private appservice:ApplicationService,
    private router: Router, public localstorage: AppLocalStorageServices,protected security: Encrypt) { }
    isfocalpoint: any;
    stktype: any;
    training_readaccess: boolean  = false;
    technical_readaccess: boolean  = false;
    course_readaccess: boolean  = false;
    i18n(key) {
      return this.translate.instant(key);
    }
    ngOnInit() {  
      this.disableSubmitButton = true;
      if (localStorage.getItem('v3logindata') == null) {
        this.router.navigate(['/admin/login'])
      }
      this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
      this.stktype = this.localstorage.getInLocal('stktype');

      setTimeout(() => {
        this.useraccess = this.localstorage.getInLocal('uerpermission');
        console.log(this.useraccess)
        if(this.isfocalpoint == 1){
          this.technical_readaccess = true;
          this.course_readaccess = true;
          this.training_readaccess = true;
          this.approvalras = true;
          this.batchreadaccess = true;
  
        }
        else{
          this.SetUseraccess();
        }
       
        // this.disableSubmitButton = true;
      this.dashboardService.getAdminDashboardData().subscribe(response => {
        
        this.DashboardCounts = response.data.counts;
        console.log(this.DashboardCounts);

        if(this.isfocalpoint == 2)
        {
          this.appservice.getroleaccess().subscribe(data => {
            console.log(data);
            this.trainaccess = [];
            this.trainaccess['accessdesktop']  = data.data.access.accessdesktop;
            this.trainaccess['accesspayment'] = data.data.access.accesspayment;
            this.trainaccess['accessauditor'] = data.data.access.accessauditor;
            this.trainaccess['accessqualitymanager'] = data.data.access.accessqualitymanager;
            this.trainaccess['accessAuthority'] = data.data.access.accessAuthority;
            this.trainaccess['accessceo'] = data.data.access.accessceo;
            this.trainaccess['accessadmin'] = data.data.access.accessadmin;
            this.trainaccess['approval'] = this.approvaltrain;
            this.trainingaccessproject = data.data.access.accessproject;
            this.train = true;
            
  
            this.appservice.getroleaccess_course().subscribe(res => {

              // alert()
              this.courseaccess = [];
              this.courseaccess['accessdesktop']  = res.data.access.accessdesktop;
              this.courseaccess['accesspayment'] = res.data.access.accesspayment;
              this.courseaccess['accessauditor'] = res.data.access.accessauditor;
              this.courseaccess['accessqualitymanager'] = res.data.access.accessqualitymanager;
              this.courseaccess['accessAuthority'] = res.data.access.accessAuthority;
              this.courseaccess['accessceo'] = res.data.access.accessceo;
              this.courseaccess['accessadmin'] = res.data.access.accessadmin;
              this.courseaccess['approval'] = this.approvalcourse;
              this.courseaccessproject = res.data.access.accessproject;
              this.course = true;
          });
          this.appservice.getroleaccess_ras().subscribe(res => {

          
            this.disableSubmitButton = false;
            this.rasaccess = [];
            this.rasaccess['accessdesktop']  = res.data.access.accessdesktop;
            this.rasaccess['accesspayment'] = res.data.access.accesspayment;
            this.rasaccess['accessauditor'] = res.data.access.accessauditor;
            this.rasaccess['accessqualitymanager'] = res.data.access.accessqualitymanager;
            this.rasaccess['accessAuthority'] = res.data.access.accessAuthority;
            this.rasaccess['accessceo'] = res.data.access.accessceo;
            this.rasaccess['accessadmin'] = res.data.access.accessadmin;
            this.rasaccess['approval'] = this.approvalras; 
            this.rasaccessproject = res.data.access.accessproject;
            this.ras = true;
          
        });

          if(!this.technical_readaccess && ! this.course_readaccess && !this.training_readaccess && this.useraccess == null){
            swal({
              title: this.i18n("You do not have the privilege to access any module. Kindly reach out to your Organisation's Administrator for assistance."),
              text: '',
              icon: 'warning',
              buttons: [false,this.i18n('Ok')],
              dangerMode: true,
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
            }).then((willGoBack) => {
              if (willGoBack) {
                this.router.navigate(['/admin/login'])        
              }
            });
          }
          else if(this.useraccess && !this.technical_readaccess && ! this.course_readaccess && !this.training_readaccess  && !this.batchreadaccess){
            Object.keys(this.useraccess).forEach(keys => {
              if(keys == '2')
              this.router.navigate(['/newenterpriseadmin/manageroles'],{ queryParams: { type: 'MQ=='}});
              else if(keys == '3')
              this.router.navigate(['/newenterpriseadmin/manageusers'],{ queryParams: { type: 'Mg=='}});
              else if(keys == '4')
              this.router.navigate(['/batchindex/batchgridlisting']);
              else if(keys == '5')
              this.router.navigate(['/assessmentreport/learnerfeedbacklist']);
              else if(keys == '8')
              this.router.navigate(['/learnercardmanagement/learnergridlist']);
              else if(keys == '9')
              this.router.navigate(['/vehiclemanagement/list']);
            });
          }
        });
        }
        else{
          
            this.trainaccess['accessdesktop']  = true;
            this.trainaccess['accesspayment'] = true;
            this.trainaccess['accessauditor'] = true;
            this.trainaccess['accessqualitymanager'] = true;
            this.trainaccess['accessAuthority'] = true;
            this.trainaccess['accessceo'] = true;
            this.trainaccess['accessadmin'] = true;
            this.trainaccess['approval'] = true;
            this.trainingaccessproject = true;
            this.train = true;
  

            this.courseaccess['accessdesktop']  = true;
            this.courseaccess['accesspayment'] = true;
            this.courseaccess['accessauditor'] = true;
            this.courseaccess['accessqualitymanager'] = true;
            this.courseaccess['accessAuthority'] = true;
            this.courseaccess['accessceo'] = true;
            this.courseaccess['accessadmin'] = true; 
            this.courseaccess['approval'] = true;
            this.courseaccessproject  = true;
            this.course = true;

            this.rasaccess['accessdesktop']  = true;
            this.rasaccess['accesspayment'] = true;
            this.rasaccess['accessauditor'] = true;
            this.rasaccess['accessqualitymanager'] = true;
            this.rasaccess['accessAuthority'] = true;
            this.rasaccess['accessceo'] = true;
            this.rasaccess['accessadmin'] = true; 
            this.rasaccess['approval'] = true;
            this.ras = true;
            this.rasaccessproject = true;
            this.disableSubmitButton = false;
        }
        
        
      });
      

      }, 2000);
  
  
        
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

      // this.disableSubmitButton = true;
      if(this.isfocalpoint == 1)
      {
      this.dashboardService.getAdminDashboardData().subscribe(res => {
        this.DashboardCounts = res.data.counts;
        this.DashboardcourseCounts = res.data.counts;
        console.log(this.DashboardCounts);
      });
    }

      this.dashboardService.getAdminRasDashboardData(4).subscribe(res => {
       
        this.Invoicecounts = res.data.invoicecounts;
        this.certifycounts = res.data.counts;
        // this.disableSubmitButton = false;
       
      });

      if(this.isfocalpoint == 2)
      {
          this.dashboardService.getAdminUserDashboardData().subscribe(res => {
          this.DashboardcourseCounts = res.data.counts;
          this.DashboardCounts = res.data.counts;
          console.log("DashboardCounts", this.DashboardCounts);
          console.log(this.DashboardcourseCounts);
      });
      }
      
    }

    SetUseraccess()
    {
      console.log('this.useraccess');
      console.log(this.useraccess);
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
      // 10 - Training Evaluation Centre Approval 11- Standard & Customized Course Approval 12 - Technical Inspection Centre Approval
      if(this.useraccess[moduleid] && this.useraccess[moduleid][10] && this.useraccess[moduleid][10].read == 'Y'){
        this.training_readaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][11] && this.useraccess[moduleid][11].read == 'Y'){
        this.course_readaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][12] && this.useraccess[moduleid][12].read == 'Y'){
        this.technical_readaccess = true;
      }
      if(this.useraccess[4] && this.useraccess[4][4] && this.useraccess[4][4].read == 'Y'){
        this.batchreadaccess = true;
      }

      // let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
      // 10 - Training Evaluation Centre Approval 11- Standard & Customized Course Approval 12 - Technical Inspection Centre Approval
      if(this.useraccess[moduleid] && this.useraccess[moduleid][10] && this.useraccess[moduleid][10].approval == 'Y'){

        // console.log(this.trainaccess['approval']);
        this.approvaltrain = true;

        
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][11] && this.useraccess[moduleid][11].approval == 'Y'){
        this.approvalcourse = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][12] && this.useraccess[moduleid][12].approval == 'Y'){
        this.approvalras = true;
      }
    
      if(this.isfocalpoint == 1){
        this.centreinvoicereadaccess = true;
        this.courseinvoicereadaccess = true;
        this.royalityinvoicereadaccess = true;
    }

      if(this.isfocalpoint == 2 && this.useraccess){
        let moduleid = this.localstorage.getaccessmoduleid(1, 'Invoice Management');
  
        let submodulecn = 13 ; //
        if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulecn] && this.useraccess[moduleid][submodulecn].read == 'Y'){
          this.centreinvoicereadaccess = true;
}
        
        let submoduleco = 14 ; //
        if(this.useraccess[moduleid] && this.useraccess[moduleid][submoduleco] && this.useraccess[moduleid][submoduleco].read == 'Y'){
          this.courseinvoicereadaccess = true;
        }

        let submodulerl = 15 ; //
        if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulerl] && this.useraccess[moduleid][submodulerl].read == 'Y'){
          this.royalityinvoicereadaccess = true;
        }
        
      }
    
    }

}
