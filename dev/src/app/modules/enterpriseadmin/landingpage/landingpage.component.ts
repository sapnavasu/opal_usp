import { Component, OnInit,Inject } from "@angular/core";
import { EnterpriseService } from "../enterprise.service";
import { DOCUMENT } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { AppLocalStorageServices } from "@app/common/localstorage/applocalstorage.services";
import {ToastrService} from 'ngx-toastr';
@Component({
  selector: "app-landingpage",
  templateUrl: "./landingpage.component.html",
  styleUrls: ["./landingpage.component.scss"],
})
export class LandingpageComponent implements OnInit {
  public insightArray:any;
  public postUrl: any;
  public postParams: any;
  fromid:number;
  datachecked:number =2
  public enterpriseCnt: any;
  public landEnableDisable:boolean = false;
  public getlocalstgdata: any;
  public loginTypeUser:any;
  public userAccess:any;
  constructor(
    @Inject(DOCUMENT) private document: Document,
    private service: EnterpriseService,
   public routeid: ActivatedRoute,
    private router:Router,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    public localstorage: AppLocalStorageServices,
    public toastr: ToastrService,
  ) { 
  }
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  });
  if (localStorage.getItem('v3logindata')) {
    this.getlocalstgdata = this.localstorage.getInLocal();
    this.loginTypeUser = this.localstorage.getInLocal('usertype');
    if (this.loginTypeUser== 'U') {
      this.userAccess = this.localstorage.getInLocal('uerpermission');
    }  
  }


    this.routeid.queryParams.subscribe(params => {
      this.fromid = params['fromid'];
    });
    this.enterpriseCount();
    this.service.chkdontshow().subscribe(data => {
      
      if(data.data.status == 1){
        this.datachecked = data.data.status;
        if(this.fromid == 1){
          
          if ((this.loginTypeUser == 'A') || this.userAccess[237] &&  this.userAccess[237].read == 'Y' || this.userAccess[238] &&  this.userAccess[238].read == 'Y' || this.userAccess[239] &&  this.userAccess[239].read == 'Y'
  || this.userAccess[259] &&  this.userAccess[259].read == 'Y' || this.userAccess[260] &&  this.userAccess[260].read == 'Y' || this.userAccess[261] &&  this.userAccess[261].read == 'Y' || this.userAccess[262] &&  this.userAccess[262].read == 'Y') {
   
    if(this.loginTypeUser == 'A'){ 
      this.router.navigate(['enterpriseadmin/usermanagement']); // Hided for don't show again condition restricted
     }
   else if(this.userAccess[239] || this.userAccess[261]){
      this.router.navigate(['enterpriseadmin/usermanagement']);
        }
       else if(this.userAccess[238] || this.userAccess[260]){
          this.router.navigate(['enterpriseadmin/department']);
        }
       else if(this.userAccess[237] || this.userAccess[259]){
            this.router.navigate(['enterpriseadmin/divisions']);
          }
        
  }else{
    this.toastr.warning('You don\'t have permission to access', 'Warning !', {
      timeOut: 3000,
      closeButton: true,
    });
    this.router.navigate(['dashboard/supplier']); 
  }
        }else{
          this.landEnableDisable = true;
        }   
      }else{
        this.landEnableDisable = true;
      }
    });
  }

  enterpriseCount(){
    this.postUrl = 'ea/user/fetch-enterprise-count';
    this.postParams = {};
    this.service.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        this.enterpriseCnt = data['data'].data;
      }.bind(this)
    );
  }

  dontShowAgain(event){
    var dataVal =null;
    if(event.checked) {
      dataVal =1
    }else{      
      dataVal =2
    }
    this.service.dontShowAgain(dataVal).subscribe(data => {
      if(data.data.flag == 'S'){      
      }
    });
  }

  userRedirect(event){
    if ((this.loginTypeUser == 'A')||(this.loginTypeUser == 'U' && this.userAccess[239] && this.userAccess[239].read == 'Y') ||
    (this.loginTypeUser == 'U' && this.userAccess[261] && this.userAccess[261].read == 'Y') || this.userAccess[283] && this.userAccess[283].read == 'Y'  ) { 
    if(event == 'A' && this.enterpriseCnt.activeUser < 1){
      this.router.navigate(['enterpriseadmin/usermanagement'], { state: { redirectToggle: 'yes' } });
    }else{
      this.router.navigate(['enterpriseadmin/usermanagement'], { state: { status: event } });
    }
  }else{
    this.toastr.warning('You don\'t have permission to access', 'Warning !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }

  divisionRedirect(){
    if ((this.loginTypeUser == 'A')||(this.loginTypeUser == 'U' && this.userAccess[237] && this.userAccess[237].read == 'Y') ||
    (this.loginTypeUser == 'U' && this.userAccess[259] && this.userAccess[259].read == 'Y') || this.userAccess[281] && this.userAccess[281].read == 'Y') {  
    if(this.enterpriseCnt.division < 1){
      this.router.navigate(['enterpriseadmin/divisions'], { state: { redirectToggle: 'yes' } });
    }else{
      this.router.navigate(['enterpriseadmin/divisions']);
    }
  }else{
    this.toastr.warning('You don\'t have permission to access', 'Warning !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }

  departmentRedirect(){
    if ((this.loginTypeUser == 'A')||(this.loginTypeUser == 'U' && this.userAccess[238] && this.userAccess[238].read == 'Y') ||
    (this.loginTypeUser == 'U' && this.userAccess[260] && this.userAccess[260].read == 'Y') || this.userAccess[282] && this.userAccess[282].read == 'Y') {
    if(this.enterpriseCnt.department < 1){
      this.router.navigate(['enterpriseadmin/department'], { state: { redirectToggle: 'yes' } });
    }else{
      this.router.navigate(['enterpriseadmin/department']);
    }
  }else{
    this.toastr.warning('You don\'t have permission to access', 'Warning !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }

  invitedRedirect(){
    if ((this.loginTypeUser == 'A')||(this.loginTypeUser == 'U' && this.userAccess[239] && this.userAccess[239].read == 'Y') ||
    (this.loginTypeUser == 'U' && this.userAccess[261] && this.userAccess[261].read == 'Y')|| this.userAccess[283] && this.userAccess[283].read == 'Y') {
    if(this.enterpriseCnt.invitedUser < 1){
      this.router.navigate(['enterpriseadmin/inviteduser'], { state: { redirectToggle: 'yes' } });
    }else{
      this.router.navigate(['enterpriseadmin/inviteduser']);
    }
  }else{
    this.toastr.warning('You don\'t have permission to access', 'Warning !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }
  chkUserPermission(){

  if ((this.loginTypeUser == 'A') || this.userAccess[237] &&  this.userAccess[237].read == 'Y' || this.userAccess[238] &&  this.userAccess[238].read == 'Y' || this.userAccess[239] &&  this.userAccess[239].read == 'Y'
      || this.userAccess[259] &&  this.userAccess[259].read == 'Y' || this.userAccess[260] &&  this.userAccess[260].read == 'Y' || this.userAccess[261] &&  this.userAccess[261].read == 'Y' || this.userAccess[262] &&  this.userAccess[262].read == 'Y'|| this.userAccess[281] &&  this.userAccess[281].read == 'Y'||this.userAccess[282] &&  this.userAccess[282].read == 'Y'||this.userAccess[283] &&  this.userAccess[283].read == 'Y') {
       if(this.loginTypeUser == 'A'){
        this.router.navigate(['enterpriseadmin/usermanagement']);
       }
        else if(this.userAccess[239] || this.userAccess[261] || this.userAccess[283]){
      this.router.navigate(['enterpriseadmin/usermanagement']);
        }
      else  if(this.userAccess[238] || this.userAccess[260] || this.userAccess[282]){
          this.router.navigate(['enterpriseadmin/department']);
        }
    else  if(this.userAccess[237] || this.userAccess[259] || this.userAccess[281]){
            this.router.navigate(['enterpriseadmin/divisions']);
          }
   
  }else{
    this.toastr.warning('You don\'t have permission to access', 'Warning !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }
}
