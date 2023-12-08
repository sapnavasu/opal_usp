import { COMMA, ENTER } from "@angular/cdk/keycodes";
import { Component, Input, OnInit, Inject, ViewEncapsulation} from '@angular/core';
import { NavigationExtras, Router } from '@angular/router';
import { DashboardService } from '../dashboard.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { FormControl, FormGroup, Validators } from "@angular/forms";
import {MatDialogRef, MAT_DIALOG_DATA, MatDialog} from "@angular/material/dialog";
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from "ngx-toastr";
import { common_var } from '@env/common_veriables';
import swal from "sweetalert";

@Component({
  selector: 'app-supplier',
  templateUrl: './supplier.component.html',
  styleUrls: ['./supplier.component.scss'],
  encapsulation: ViewEncapsulation.None,
})

export class SupplierComponent implements OnInit {
  /** Front end Control**/
  public trainingEvaluationCentreshowhide = common_var.maincentre.maintab.trainingEvaluationCentre;
  public technicalEvaluationCentrehowhide = common_var.maincentre.maintab.technicalEvaluationCentre;
  public commignsoonhide = common_var.maincentre.maintab.trainingEvaluationCentre;

  
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  public rightSideSpinner;
  DashboardCounts: any;
  centredtls: any;
  BatchDataTP: any;
  BatchTPData: any;
  BatchACData: any;
  web_url: any;
  disableSubmitButton: boolean;
regtype: any;
  rascompanydtls: any;
  rasroles: any;
  rasBranchdata: any;
  rasVehicleData: any;
  userprojectpk: any;
  rascentercertified: any;
  maincentercertified: any;
  trainingctrshow: boolean = false;
  technicalctrshow: boolean = false;
  hide_tabs :boolean = false;isfocalpoint: any;
  useraccess: any;
  constructor( private translate: TranslateService,
    private remoteService: RemoteService, public toastr: ToastrService, 
    private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,private dashboardService: DashboardService, private router: Router, private applocal: AppLocalStorageServices) { }
  ngOnInit() {  
    if (localStorage.getItem('v3logindata') == null) {
      this.router.navigate(['/admin/login'])
    }
    this.regtype = this.localstorage.getInLocal('regtype'); 
    this.userprojectpk = this.localstorage.getInLocal('oum_projectmst_fk');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
   

    
    // if(this.regtype == 1)
    // {
    //   this.trainingEvaluationCentreshowhide = true;
    //   this.technicalEvaluationCentrehowhide = false;
    // }
    // else if(this.regtype == 2)
    // {
    //   this.trainingEvaluationCentreshowhide = false;
    //   this.technicalEvaluationCentrehowhide = true;
    // }
    // else if(this.regtype == 3)
    // {
    //   this.trainingEvaluationCentreshowhide = true;
    //   this.technicalEvaluationCentrehowhide = true;
    // }
     
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    if(this.isfocalpoint == 2)
    {
      if(this.userprojectpk == 1 || this.userprojectpk == null)
      {
        let moduleid = this.localstorage.getaccessmoduleid(2, 'Batch Management');
        if (this.useraccess[moduleid] && this.useraccess[moduleid][21] && this.useraccess[moduleid][21].read == 'Y') {
          this.router.navigate(['/batchindex/batchgridlisting']);
        }
        else
        {
          this.router.navigate(['/admin/login']);
        }
        
      }
      else if(this.userprojectpk == 4){
        let moduleid = this.localstorage.getaccessmoduleid(2, 'Vehicle Inspection and Approval');
        
        if (this.useraccess[moduleid] && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].read == 'Y') {
          this.router.navigate(['/vehiclemanagement/vehiclelisting']);
        }
        else
        {
          this.router.navigate(['/admin/login']);
        }
        
      }
    }
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.disableSubmitButton = true;
    this.dashboardService.getGetDashboardData().subscribe(res => {
      this.centredtls = res.data.centredtls;
      this.disableSubmitButton = false;
      this.DashboardCounts = res.data.counts;
      this.BatchTPData = res.data.batchTPData;
      this.BatchACData = res.data.batchACData;
      this.web_url = res.data.website_url;
      this.rascentercertified = res.data.rascentercertified;
      this.maincentercertified = res.data.maincentercertified;

       if(this.maincentercertified == 'yes' && !this.userprojectpk ){
          this.trainingctrshow = true;
       }
       if(this.rascentercertified == 'yes' && !this.userprojectpk ){
         this.technicalctrshow = true;
       }
       if(this.maincentercertified == 'yes' && this.userprojectpk == 1){
         this.trainingctrshow = true;
         this.technicalctrshow = false;
      }
       if(this.rascentercertified == 'yes' && this.userprojectpk == 4 ){
         this.trainingctrshow = false;
         this.technicalctrshow = true;
     }
    });

    if(this.technicalEvaluationCentrehowhide == true)
    {
      this.dashboardService.getGetDashboardTechData(4).subscribe(res => {
        this.rascompanydtls = res.data.company;
        this.rasroles = res.data.Roles;
        this.rasBranchdata = res.data.branchData;
        this.rasVehicleData = res.data.rasData;
      });
    }

  }
  
  
}
 
