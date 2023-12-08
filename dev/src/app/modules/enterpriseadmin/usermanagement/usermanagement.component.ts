import { AfterViewInit, Component, HostListener, Inject, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { UserallocationComponent } from '@app/@shared/sidepanel/userallocation/userallocation.component';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { AccountsettingsService } from '@app/modules/accountsettings/accountsettings.service';
import { NgDynamicBreadcrumbService } from 'ng-dynamic-breadcrumb';
import { ToastrService } from 'ngx-toastr';
import 'rxjs/add/observable/of';
import { Observable } from 'rxjs/Observable';
import swal from 'sweetalert';
import { ActivityfilterComponent } from '../activityfilter/activityfilter.component';
import { AddingdetailssidenavComponent } from '../addingdetailssidenav/addingdetailssidenav.component';
//import { ActivitylistingComponent } from '../activitylisting/activitylisting.component';
import { AddusersidenavComponent } from '../addusersidenav/addusersidenav.component';
// import { MatDrawer, MatPaginator, MatSort, PageEvent } from '@angular/material';
import { SlideInOutAnimation } from '../animation';
import { EnterpriseService } from '../enterprise.service';
import { UsereachcountsComponent } from '../usereachcounts/usereachcounts.component';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';
import { AddinguserComponent } from '@app/@shared/addinguser/addinguser.component';
export interface DialogData {
  animal: string;
  name: string;
}

@Component({
  selector: 'app-usermanagement',
  templateUrl: './usermanagement.component.html',
  styleUrls: ['./usermanagement.component.scss'],
   encapsulation: ViewEncapsulation.Emulated,
  animations: [SlideInOutAnimation]
})
export class UsermanagementComponent implements OnInit, AfterViewInit {
  
 i18n(key){
  return this.translate.instant(key);
}
  public userPermission: any = [];
  @ViewChild("userview") userview: MatDrawer;
  @ViewChild('addUpdateAccess') addUpdateAccess: UserallocationComponent;
  @ViewChild('draweruserallocation') draweruserallocation: MatDrawer;
  animationState3 = 'out';
  gridtype:any='list';
  warnUserBeforeLeavingPage = true;
  url: string;
  registerPk: any;
  @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
      if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
      }
  }

  pageEvent: any;
  resultsLength: number;
  validcount:number;
  totalusercount:number;
  perpage = BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;
  @Input() tog: any = "";
  dataSourceforpermission: any;
  permissionarray: any;
  finalpermissionarray: any = [];
  paginationSet = BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPaginatonSet;
  showInvitedUserOnly: boolean = false;
  @ViewChild('draweruseranddepartment') draweruseranddepartment: MatDrawer;
  @ViewChild('configurebymodule') configurebymodule: MatDrawer;
  @ViewChild('paginator') paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public postUrl:any;
  public postParams:any;
  @ViewChild('updateStakeholderUser') updateStakeholderUser:AddingdetailssidenavComponent;
  @ViewChild('enterpriseFilter') enterpriseFilter:ActivityfilterComponent;
  @ViewChild('draweraddinguser') draweraddinguser: MatDrawer;
  @ViewChild('draweruseractivitylisting') draweruseractivitylisting: MatDrawer;
  public moduleUserDetails:any;
  public triggercountryser:number =1;
   
  text:boolean=true;
  checked = true;
  indeterminate = false;
  labelPosition = 'after';
  disabled = false;
  animal: string;
  name: string;
  adddepartmentForm: FormGroup;
  adduserForm:FormGroup;
  submitted = false;
  usersubmitted = false;
  disableResendBtn: boolean = false;
  showResponsiveLoader: boolean = false;
  isUserMapped: boolean = false;

  toppingListdep = ['Extra cheese', 'Mushroom', 'Onion', 'Pepperoni', 'Sausage', 'Tomato'];
  selectedToppingsdep;

  toppingListdes = ['Extra cheese', 'Mushroom', 'Onion', 'Pepperoni', 'Sausage', 'Tomato'];
  selectedToppingsdes;

  toppingListmdle = ['Extra cheese', 'Mushroom', 'Onion', 'Pepperoni', 'Sausage', 'Tomato'];
  selectedToppingsmdle;

  toppingListsbmdle = ['Extra cheese', 'Mushroom', 'Onion', 'Pepperoni', 'Sausage', 'Tomato'];
  selectedToppingssbmdle;

  public userinfo:any;
  public companyName:any;
  public companyId:any;
  public noDataAvailable:string = this.i18n('enterpriseadmin.thernoth');
  public logoUrl: string;

  /* MegaMenu Vaarible*/
  public menuUserPk:any;
  public menuAdd:any;
  public menuModulePk:any;
  public menuModuleId:any;
  public menuUserEnable:boolean = false;
  @ViewChild('addUpdateUserRef') addUpdateUserRef:AddusersidenavComponent;
  @ViewChild('refUserCount') refUserCount:UsereachcountsComponent;
  public sortBy: number = 1;
  public addUserFromType:number = 1; // 1 - Add, 2- Update, 3 - Approve
  public editaccess:boolean = false;
  public approveaccess:boolean = false;
  public deleteaccess:boolean = false;
  public monitorlogacc:boolean = false;
  public lusrtpye:string;
  public useraccess:any;
  public routeRedirectFrom:any = '';
  public user_pk: any;

  /*Sar Starts*/
  public searchStatus:any = '';
  public redirectToggle:any = '';
  public searchDeptFltr:any = '';
  Contentplaceloader:boolean = false;
  public stkholdertype: any;
  public editdata:any = 'yes';
  public accSettingsData:any = [];
  constructor(
    public dialog: MatDialog,
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private route:ActivatedRoute,
    private localstorage: AppLocalStorageServices,
    private ngDynamicBreadcrumbService: NgDynamicBreadcrumbService,
    private router:Router,
    public toastr: ToastrService,
    private accSettingsService: AccountsettingsService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    
  ) { 
    this.stkholdertype = this.localstorage.getInLocal('reg_type');
  }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 
  
  isExtendedRow = (index, item) => item.extend;

  ngAfterViewInit(){
    if(this.searchStatus == 'A' || this.searchStatus == 'I' || this.searchDeptFltr){
      this.landingFilterFn();
    }else{
      this.searchStatus = this.searchDeptFltr = '';
    }
  }

  landingFilterFn(){
    setTimeout(() => { 
      if(this.searchDeptFltr){
        this.enterpriseFilter.landingFilter(this.searchDeptFltr, 'department');
        this.searchDeptFltr = '';
      }else{
        this.enterpriseFilter.landingFilter(this.searchStatus, 'status');
        this.searchStatus  = '';
      }
    }, 2500);
  }
  
  ngOnInit() {
    this.user_pk = this.localstorage.getInLocal('userPk');         
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
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
    // this.accSettingsService.accountsettingsdata(this.editdata).subscribe(data => {
    //   if(data) {
    //     this.accSettingsData = data['data'];
    //   }
    // })
    
    this.lusrtpye = this.localstorage.getInLocal('usertype');      
    this.registerPk = this.localstorage.getInLocal('registerPk');     
    if(this.lusrtpye == 'U'){
      this.useraccess = this.localstorage.getInLocal('uerpermission');
    }  
    this.stkholdertype = this.localstorage.getInLocal('reg_type');

    if(this.stkholdertype == 8)
    {
      this.getValidCount(this.registerPk);
    }

    this.postParams = {};    
    this.companyDetails();
    setTimeout(() => { this.text = false},1000);
    this.route.paramMap.pipe((data) => {
      this.menuUserPk = window.history.state.menuUserPk;
      this.menuModulePk = window.history.state.menuModulePk;
      if(this.menuUserPk > 0){
        this.edit(this.menuUserPk);
        this.menuUserPk = '';
      }

      if(this.menuModulePk > 0){
        this.newModuleAllocation(this.menuModulePk);
        this.menuModulePk = '';
        this.menuUserEnable = true;
      }

      this.searchStatus = window.history.state.status;
      if(this.searchStatus == 'A' || this.searchStatus == 'I'){
        this.showResponsiveLoader=true;
      }else{
        this.searchStatus  = '';
      }

      this.redirectToggle = window.history.state.redirectToggle;
      if(this.redirectToggle == 'yes'){
        setTimeout(() => {
          this.addUserFromType=1;
          this.addusertog();  
        }, 1500);
      }else{
        this.redirectToggle  = '';
      }

      this.searchDeptFltr = window.history.state.deptFltr;
      if(this.searchDeptFltr){
        this.showResponsiveLoader=true;
      }else{
        this.searchDeptFltr  = '';
      }

      setTimeout(() => { 
        this.menuAdd = window.history.state.menuAdd;
        if(this.menuAdd == 'yes'){
          this.fetchSideNavDetails();
          this.draweruseranddepartment.toggle();
        }
      },1500);
      return Observable.from([])
    });
    // if(this.searchStatus == ''){
      this.stakeholderUserDetails(this.postParams);
    // }

    this.route.params.subscribe(params => {
      if (params['redirectFrom']) {
        this.routeRedirectFrom = params['redirectFrom'];
      }
    });
    if(this.routeRedirectFrom){
      setTimeout(() => {
        this.updateBreadcrumb();  
      }, 1500);
      
    }
    
  }
  updateBreadcrumb(): void {
    const breadcrumbs  =  [
      {
        label: 'Enterprise Admin',
        url: '/enterpriseadmin/landing page'
      },
      {
        label: 'User Management',
        url: ''
      },
    ];
    this.ngDynamicBreadcrumbService.updateBreadcrumb(breadcrumbs);
  }
  getValidCount(regpk)
  {
    this.url = 'ea/user/getmaxusercount';
    this.EnterpriseService.enterpriseService(regpk,this.url).subscribe(
      function(data){
        if(data['data'].status == 0){
          swal({
            title: this.i18n('enterpriseadmin.warntitle'),
            text: data['data'].msg,
            icon: 'warning',
          });
        }else{
          if(data['data'].status == 100){
            this.validcount = data['data'].data.maxuser;
            this.totalusercount = data['data'].data.totalcount;
          
          }
        }
      }.bind(this)
  );
  }
  dashboardRedirect(){
    if(this.stkholdertype == 1){
      this.router.navigate(['dashboard/portaladmin']);
    }else if(this.stkholdertype == 6){
      this.router.navigate(['dashboard/supplier']);
    }else if(this.stkholdertype == 7){
      this.router.navigate(['dashboard/operator']);
    }
  }
  
  stakeholderUserDetails(postParam){
    this.Contentplaceloader=true;
    this.showResponsiveLoader=true;
    // this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');

    this.postUrl = 'ea/user/list-stakholder-users';
    this.EnterpriseService.enterpriseService(postParam,this.postUrl).subscribe(
        function(data){
          if(data['data'].status == 0){
         
            swal({
              title: this.i18n('enterpriseadmin.warntitle'),
              text: data['data'].msg,
              icon: 'warning',
            });
          }else{
            if(data['data'].status == 100){
              this.userinfo = data['data'].data;
              this.logoUrl = data['data'].logo_url;
              this.resultsLength = data['data'].totalcount;
              if(this.resultsLength == 0){
                this.noDataAvailable = this.i18n('enterpriseadmin.youcompdoesnotuser');
              }else{
                this.noDataAvailable = this.i18n('enterpriseadmin.thernoth');
              }
            }
          }
          this.Contentplaceloader=false;
          this.showResponsiveLoader=false;
        }.bind(this)
        
    );

  }

  onPaginateChange(event) {
    this.perpage = event.pageSize;

    // this.postParams = {
    //   'size':this.perpage,
    //   'page':this.paginator.pageIndex,
    // };
    // this.stakeholderUserDetails(this.postParams);
    this.enterpriseFilter.advanceFilter('', this.sortBy,this.perpage, this.paginator.pageIndex,'out');
  }


  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);

    // this.postParams = {
    //   'size':this.perpage,
    //   'page':this.paginator.pageIndex,
    // };
    // this.stakeholderUserDetails(this.postParams);
    this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
  }

  animationState = 'out';
  animationState1 = 'out';

  toggle() {
    this.tog.toggle();
  }

  adddivision()
  {
    this.enterpriseFilter.animationState = "out";
    this.enterpriseFilter.animationState1 = "out";
    // this.enterpriseFilter.filterform.reset();
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontent') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  edit(userPk){
    setTimeout(() => { 
      this.triggercountryser = 2;
      this.draweraddinguser.toggle();
      this.addUserFromType = 2;
      this.addUpdateUserRef.stakehlderUserUpdateDetails(userPk);
    },1500);
  }

  fetchSideNavDetails(){
    this.updateStakeholderUser.reloadUserDepartment();
  }

  companyDetails(){
    this.postParams = {};
    this.postUrl = 'ea/user/fetch-user-company-details';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        if(data['data'].status == 0){
          swal({
            title: this.i18n('enterpriseadmin.warntitle'),
            text: data['data'].msg,
            icon: 'warning',
          });
        }else{
          if(data['data'].status == 100){
            this.companyName = data['data'].data.userCompanyDetails.cmpName;
            this.companyId = data['data'].data.userCompanyDetails.cmpRegNo;
            //this.updateStakeholderUser.companyUserDetails(this.companyName, this.companyId);
          }
        }
      }.bind(this)
    );
  }
  deactoractiuser(userPk, status){
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[47] && this.useraccess[47].update == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].update == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].update == 'Y') || this.useraccess[283] && this.useraccess[283].update == 'Y'){
      this.update(userPk, status);
    }else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }
  deleteuser(userPk, status){
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[47] && this.useraccess[47].delete == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].delete == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].delete == 'Y')||this.useraccess[283] && this.useraccess[283].delete == 'Y'){
      this.update(userPk, status);
    }else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }
  update(userPk, status){
      let statMsg = '';
      let statSuccessMsg = '';
      let usrPk = this.encrypt.encrypt(userPk);
      if(status == 'D'){
        statMsg = this.i18n('enterpriseadmin.doyouwantuser');
        statSuccessMsg = this.i18n('enterpriseadmin.userdelesucc');
      }else{
        if(status == 'I'){
          statMsg = this.i18n('enterpriseadmin.doyouwantactiuser');
          statSuccessMsg = this.i18n('enterpriseadmin.useractisucc');
        }else{
          statMsg = this.i18n('enterpriseadmin.doyouwantinacuser');
          statSuccessMsg = this.i18n('enterpriseadmin.userdeacsucc');
          this.isUserMapped = true;
        }
      }
      if(this.isUserMapped){
        this.EnterpriseService.checkUserismapped(usrPk).subscribe(
          function(data){            
            if(data['data'].status==100){
              if(data['data'].data){
                swal({
                  title: this.i18n('enterpriseadmin.youcanndeleordeac'),
                  icon:'warning',
                  closeOnClickOutside: false,
                  closeOnEsc: false
                });
              } else {
                this.deletepopup(statMsg, usrPk, status, statSuccessMsg);
              }  
            } else {
              swal({
                title: data['data'].msg,
                icon:'warning',
                closeOnClickOutside: false,
                closeOnEsc: false
              });
            }       
          }.bind(this)
        );
      } else {
        this.deletepopup(statMsg, usrPk, status, statSuccessMsg);
      }
  }
  chkUserPermission(url,type){
    // type= 1-usermangemnet,2 department,3-divisions ,4-inviteduser
    
    if(type == 1){
     if((this.lusrtpye == 'A') || (this.lusrtpye == 'U'  && this.useraccess[239] && this.useraccess[239].read == 'Y')||
       (this.lusrtpye == 'U'  && this.useraccess[261] && this.useraccess[261].read == 'Y')||  this.useraccess[283] && this.useraccess[283].read == 'Y'){
         this.router.navigate([url]);
       }
       else{
        this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
          timeOut: 3000,
          closeButton: true,
        });
       }
 
    }
    if(type == 2){
     if((this.lusrtpye == 'A') || (this.lusrtpye == 'U'  && this.useraccess[238] && this.useraccess[238].read == 'Y')||
     (this.lusrtpye == 'U'  && this.useraccess[260] && this.useraccess[260].read == 'Y')||this.useraccess[282] && this.useraccess[282].read == 'Y'){
       this.router.navigate([url]);
     }
     else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
     }
   }
   if(type == 3){
     if((this.lusrtpye == 'A') || (this.lusrtpye == 'U'  && this.useraccess[237] && this.useraccess[237].read == 'Y')||
     (this.lusrtpye == 'U'  && this.useraccess[259] && this.useraccess[259].read == 'Y')|| this.useraccess[281] && this.useraccess[281].read == 'Y'){
       this.router.navigate([url]);
     }
     else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
     }
   }
   if(type == 4){
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U'  && this.useraccess[239] && this.useraccess[239].read == 'Y')||
    (this.lusrtpye == 'U'  && this.useraccess[261] && this.useraccess[261].read == 'Y')||this.useraccess[283] && this.useraccess[283].read == 'Y'){
      this.router.navigate([url]);
    }
    else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }
 
   }
  deletepopup(statMsg, usrPk, status, statSuccessMsg){
    swal({
      title:statMsg,
      icon:'warning',
      buttons: [this.i18n('enterpriseadmin.no'), this.i18n('enterpriseadmin.yes')],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if(willDelete){
        this.showResponsiveLoader=true;
        this.postParams = {
          "userPk":usrPk,
          "status":status
        };
        this.postUrl = 'ea/user/update-stakholder-users';
        this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
            if(data['data'].status == 100){
              this.refUserCount.enterpriseCount();
              this.showResponsiveLoader=false;
              this.showTSuccess (statSuccessMsg);   
              if(status != 'D'){
                   this.paginator.pageIndex = 0;
                }

                this.postParams = {
                       'size':this.perpage,
                       'page':this.paginator.pageIndex,
                   };
                //this.stakeholderUserDetails(this.postParams);
                  this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
              // swal({
              //   title:statSuccessMsg,
              //   icon:'success',
              //   closeOnClickOutside: false,
              //   closeOnEsc: false
              // }).then((value)=>{
              //   this.showResponsiveLoader=false;
              // 
              //   if(value){
              //    
              //   }
              // });
            }else{
              this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
              this.showResponsiveLoader=false;
              swal({
                title: data['data'].msg,
                icon:'warning',
                closeOnClickOutside: false,
                closeOnEsc: false
              });
            }
          }.bind(this)
        );
      }
    }); 
  }

  reloadGrid(){
    this.refUserCount.enterpriseCount();
    this.paginator.pageIndex = 0;
    this.postParams = {
      'size':this.perpage,
      'page':this.paginator.pageIndex,
    };
    //this.enterpriseFilter.getBranchNameList();
    // this.stakeholderUserDetails(this.postParams);
    this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
  }

  userFilterData(event){ 
    if(event.resetPagination){
      this.paginator.firstPage();
    }
    this.userinfo = event.data;
    this.resultsLength = event.totalcount;
    if(this.resultsLength == 0){
      this.noDataAvailable =this.i18n('enterpriseadmin.thernoth');
    }
    this.showResponsiveLoader=false;
    this.Contentplaceloader=false;
  }

  resendMail(pk: number, status: string){
    if(status == 'Expired' || status == 'Invited'){
      this.disableResendBtn = this.showResponsiveLoader = true;
      this.EnterpriseService.resendInviteMail(this.encrypt.encrypt(pk)).subscribe(data => {
        swal({
          title: (data['data'].status == 2) ? data['data'].msg : (data['data'].status == 1) ? this.i18n('enterpriseadmin.mailresesucc') : this.i18n('enterpriseadmin.somewentwron'),
          icon: (data['data'].status == 2) ? 'warning' : (data['data'].status == 1) ?  'success' : 'warning',
          closeOnClickOutside: false,
          closeOnEsc: false
        });
        this.disableResendBtn = this.showResponsiveLoader = false;
        if((data['data'].status == 1))
        this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
        });
    }else if(status == 'Accepted'){
      swal({
        title: this.i18n('enterpriseadmin.thisuserhasalre'),
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      });
    }
  }

  deleteInvite(userpk: any){
    swal({
      title:this.i18n('enterpriseadmin.doyouwant'),
      icon:'warning',
      buttons: [this.i18n('enterpriseadmin.nomodal'), this.i18n('enterpriseadmin.yesmodal')],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if(willDelete){
        this.showResponsiveLoader=true;
        this.EnterpriseService.deleteInvite(userpk).subscribe(data => {
          swal({
            title: data['data'].msg,
            icon: (data['data'].status == 1) ? 'success' : 'warning',
            closeOnClickOutside: false
          }).then(() => {
            this.showResponsiveLoader=false;
            this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
          });
        });
        
      }
    });
  }

  toggleUserandInviteUser(){
    this.enterpriseFilter.showInvitedUser = !this.enterpriseFilter.showInvitedUser;
    if(!this.enterpriseFilter.showInvitedUser){
      this.enterpriseFilter.checkedFilterArr = [];
      this.enterpriseFilter.filtercount = 0;
    }
    this.paginator.firstPage();
    this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out')
  }
  newModuleAllocation(menuModulePk, searchData = ''){
    this.menuModuleId = menuModulePk;
    this.postParams = {
      'moduleId':menuModulePk,
      'searchData':searchData
    };
    this.postUrl = 'ea/user/fetch-module-user-details';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        if(data['data'].status == 100){
          this.moduleUserDetails = data['data'].data.userDetail;
        }
      }.bind(this)
    );
    if(!this.configurebymodule.opened){
      this.configurebymodule.toggle();
    }
  }

  deptUserSearch(event){
    this.newModuleAllocation(this.menuModuleId, event);
  }

  closeConfigureModule(event){
    this.menuUserEnable = false;
  }

  monitorLog(userPk){
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[48] && this.useraccess[48].read == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[262] && this.useraccess[262].read == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[240] && this.useraccess[240].read == 'Y') || this.useraccess[284] && this.useraccess[284].read == 'Y'){
      this.postParams = {
        'userPk':this.encrypt.encrypt(userPk),
        'page':0,
      };
     
  
      this.postUrl = 'ea/user/fetch-user-data';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          if(data['data'].status == 100){
            this.activitylistRef.userDetails = data['data'].data.data;
            this.activitylistRef.userProfileImage = data['data'].data.uploadUrl;
          }
        }.bind(this)
      ); 
  
      this.postUrl = 'ea/monitor/fetch-user-login-details';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          if(data['data'].status == 100){
            this.activitylistRef.displayLoginReportData(data['data'].data.loginData);
            this.activitylistRef.loginCount = data['data'].data.loginDataCount;
            this.draweruseractivitylisting.toggle();
          }
        }.bind(this)
      ); 
      
  
      this.postUrl = 'ea/monitor/get-activity-log';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          if(data['data'].status == 100){
            this.activitylistRef.displayActivityLogData(data['data'].data.activityData.tabledata);
            this.activitylistRef.activityCount = data['data'].data.activityDataCount;
          }
        }.bind(this)
      ); 
    }else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }    
  }
  filterstatusviacnt(eventdata){
    this.searchStatus = eventdata;
    if(this.searchStatus == 'A' || this.searchStatus == 'I'){
      this.showResponsiveLoader=true;
    }else{
      this.searchStatus  = '';
    }
    this.enterpriseFilter.landingFilter(this.searchStatus, 'status',true);
  }
  approveUser(userPk){
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[47] && this.useraccess[47].approval == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].approval == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].approval == 'Y')||this.useraccess[283] && this.useraccess[283].approval == 'Y'){
      this.addUserFromType = 3;
      this.triggercountryser = 2;
      this.draweraddinguser.toggle();
      this.addUpdateUserRef.stakehlderUserUpdateDetails(userPk);
    }else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }    
  }
  addusertog(){
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].create == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].create == 'Y')) {
      this.triggercountryser = 2;
      this.draweraddinguser.toggle();
      this.addUpdateUserRef.userstkholder();
    }else{
        this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }
  
  showLoader: boolean = false;
  // viewuserdetails: any = [];
  viewUser(userPk){ 
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].read == 'Y') || 
    (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].read == 'Y')||this.useraccess[283] && this.useraccess[283].read == 'Y'){ 
    this.userview.toggle();    
    
    this.animationState3 = 'out';
  }else{
    this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }
  editUser(userPk){
    
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[47] && this.useraccess[47].update == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].update == 'Y') || 
    (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].update == 'Y')||this.useraccess[283] && this.useraccess[283].update == 'Y'){
      this.addUserFromType = 2;
      this.triggercountryser = 2;
      this.draweraddinguser.toggle();
      this.addUpdateUserRef.stakehlderUserUpdateDetails(userPk);
      this.addUpdateUserRef.addUpdateText=this.i18n('enterpriseadmin.upda');
      this.enterpriseFilter.animationState = "out";
      this.enterpriseFilter.animationState1 = "out";
      this.addUpdateUserRef.addupdateemailuser.showeditbtn = true;
      this.addUpdateUserRef.addupdateemailuser.showeditbtnmobile = true;
      this.addUpdateUserRef.addupdateemailuser.verfiedtagshow = false;
      this.addUpdateUserRef.addupdateemailuser.verfiedtagshowmobile = false;
      this.addUpdateUserRef.addupdateemailuser.otpviewfield = false;
      this.addUpdateUserRef.addupdateemailuser.otpshowmobile = false;
      this.addUpdateUserRef.addupdateemailuser.verfiy = false;
      this.addUpdateUserRef.addupdateemailuser.verfiymobile = false;
      this.addUpdateUserRef.addupdateemailuser.addreadonlyMobile = false;
      // this.addUpdateUserRef.addupdateemailuser.addreadonlyMobile = false;
      // this.addUpdateUserRef.addupdateemailuser.iseditdisable1 = false;
      // this.addUpdateUserRef.addupdateemailuser.checknationaluser = true;
      
      
      
    }else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }

  sortEventChange(event){
    this.sortBy = event;
    this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
  }
  delteUserPopupWithComments(userPk, status): void {
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[47] && this.useraccess[47].delete == 'Y') ||
    (this.lusrtpye == 'U' && this.useraccess[261] && this.useraccess[261].delete == 'Y') || 
    (this.lusrtpye == 'U' && this.useraccess[239] && this.useraccess[239].delete == 'Y')||this.useraccess[283] && this.useraccess[283].delete == 'Y'){
      const dialogRef = this.dialog.open(Modalcommentpop, {
        data:{userPk: userPk, status: status},
        disableClose:true,
      });
  
      dialogRef.afterClosed().subscribe((result) => {
        if(result == 'yes'){
          this.refUserCount.enterpriseCount();

          this.showResponsiveLoader=false;
          this.paginator.pageIndex = 0;
          this.postParams = {
            'size':this.perpage,
            'page':this.paginator.pageIndex,
          };
          this.enterpriseFilter.advanceFilter('', this.sortBy, this.perpage, this.paginator.pageIndex,'out');
        }else{

        }
      });
    }else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }

    
  }
  viewBunit(){
    this.userview.toggle();
    this.animationState3 = 'out';
  }

  closeView(){
    this.userview.toggle();
  }
  
  showTSuccess(data){
    this.toastr.success(data, this.i18n('enterpriseadmin.succ'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.warning(data, this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  userdropdown(divName: string) {
    if (divName === 'userviewlist') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
    }
    
  }
  outputloader(event){
    this.showLoader=event;
  }

  public showLoaderviewpermission: boolean = false;

  viewmoduleaccess(userDetails){
    this.showLoaderviewpermission=true;
    let userpk = this.encrypt.encrypt(userDetails.userPk);
    this.EnterpriseService.getUserpermission(userpk,this.stkholdertype).subscribe(
      function(data){
        if(data['data'].status == 100){
          this.draweruserallocation.toggle();          
          setTimeout(() => {        
            this.addUpdateAccess.usedatamoduleaccess(userDetails);
            this.addUpdateAccess.userAccessview(data['data'].data.baseModulesAccess);  
               
          }, 100);
        }
      }.bind(this)
    );     
  }

  // getuserpermissiondet(userper) {
  
  // }
  showloader(event) {
    this.showLoaderviewpermission = event;    
  }
  userPermData(event) {
    let userPermission = event;
    
  }

  public avoidmultiv: boolean = false;

  avoidmulti() {
    this.avoidmultiv = true;
  }
}



@Component({
  selector: "Modalcommentpop",
  templateUrl: "Modalcommentpop.html",
  styleUrls: ["Modalcommentpop.scss"]
})

export class Modalcommentpop {
  i18n(key){
    return this.translate.instant(key);
  }
  public commentform: FormGroup;
  public showResponsiveLoader = false;
  constructor(
    public dialogRef: MatDialogRef<Modalcommentpop>,
    @Inject(MAT_DIALOG_DATA) public data: DialogData,private fb: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,public toastr: ToastrService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
  ) {
  }
  submitApprovePopup(userPk, status): void {
    let postParams = {
      "userPk":this.encrypt.encrypt(userPk),
      "status":status,
      "comments":this.commentform.controls['comments'].value
    };
    this.showResponsiveLoader=true;
    let postUrl = 'ea/user/update-stakholder-users';
    this.EnterpriseService.enterpriseService(postParams, postUrl).subscribe(
      function(data){
        if(data['data'].status == 100){
          // swal({
          //   title:'User deleted successfully',
          //   icon:'success',
          //   closeOnClickOutside: false,
          //   closeOnEsc: false
          // }).then((value)=>{
          //   if(value){
          //     this.dialogRef.close('yes');
          //   }
          // });
          this.dialogRef.close('yes');
          this.showSuccess()
        }else{
          this.dialogRef.close('yes');
          swal({
            title: data['data'].msg,
            icon:'warning',
            closeOnClickOutside: false,
            closeOnEsc: false
          });
        }
        this.showResponsiveLoader=false;
      }.bind(this)
    );
  }
  showSuccess(){
    this.toastr.success(this.i18n('enterpriseadmin.succ'), this.i18n('enterpriseadmin.userdelesucc'), {
        timeOut: 3000,
    });
}
  closeModalPopup(): void{
    this.dialogRef.close('no');
  }



  ngOnInit() {
    this.commentform = this.fb.group({
      comments:["",Validators.required],
    });
  }

 
}