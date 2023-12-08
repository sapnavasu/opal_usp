import { Component, HostListener, Input, OnInit, ViewChild, ViewEncapsulation } from "@angular/core";
import { FormBuilder, FormGroup } from "@angular/forms";
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { ActivatedRoute, Router } from "@angular/router";
import { AdddepartmentComponent } from "@app/@shared/adddepartment/adddepartment.component";
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from "@app/config/BGIConfig/bgi-jsonconfig-services";
import "rxjs/add/observable/of";
import swal from "sweetalert";
import { AddingdetailssidenavComponent } from "../addingdetailssidenav/addingdetailssidenav.component";
import { SlideInOutAnimation } from "../animation";
import { DepartmentfilterComponent } from "../departmentfilter/departmentfilter.component";
import { EnterpriseService } from "../enterprise.service";
import { UsereachcountsComponent } from "../usereachcounts/usereachcounts.component";
import {ToastrService} from 'ngx-toastr';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';

export interface Element {
  departments: string;
  users: string;
  divisionname: any;
}
const ELEMENT_DATA: Element[] = [
  { departments: "Micro", users: "10", divisionname: "1" },
  { departments: "Small", users: "99", divisionname: "1" },
  { departments: "Medium", users: "499", divisionname: "1" },
  { departments: "Large", users: "999", divisionname: "1" },
  { departments: "Very Large", users: "999", divisionname: "1" },
];
@Component({
  selector: "app-departmentmanagement",
  templateUrl: "./departmentmanagement.component.html",
  styleUrls: ["./departmentmanagement.component.scss"],
  encapsulation: ViewEncapsulation.Emulated,
  animations: [SlideInOutAnimation],
})
export class DepartmentmanagementComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  displayedColumns = ["departments", "divisions", "users", "status", "action"];
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  divisionloadergrid: boolean = false;
  warnUserBeforeLeavingPage = true;
  @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
    if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
    }
  }

  pageEvent: any;
  resultsLength: number;
  perpage =
    BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;
    public pages: any;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  @Input() tog: any = "";
  dataSourceforpermission: any;
  public projectName: string
  permissionarray: any;
  finalpermissionarray: any = [];
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  showInvitedUserOnly: boolean = false;
  @ViewChild("enterpriseCountRef") enterpriseCountRef: UsereachcountsComponent;
  @ViewChild("draweruseranddepartment") draweruseranddepartment: MatDrawer;
  @ViewChild("configurebymodule") configurebymodule: MatDrawer;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public postUrl: any;
  public postParams: any;
  @ViewChild("updateStakeholderUser")
  updateStakeholderUser: AddingdetailssidenavComponent;
  @ViewChild("enterpriseFilter") departmentfilter: DepartmentfilterComponent;
  @ViewChild("draweraddingdep") draweraddingdep: MatDrawer;
  @ViewChild("drawerdepartment") drawerdepartment: MatDrawer;
  @ViewChild("draweruseractivitylisting") draweruseractivitylisting: MatDrawer;
  public moduleUserDetails: any;
  departmentloader:boolean = false;
  departmentgridloader: boolean =false;
  text: boolean = true;
  checked = true;
  indeterminate = false;
  labelPosition = "after";
  disabled = false;
  animal: string;
  name: string;
  adddepartmentForm: FormGroup;
  adduserForm: FormGroup;
  submitted = false;
  usersubmitted = false;
  disableResendBtn: boolean = false;
  showResponsiveLoader: boolean = false;
  public editaccess: boolean = false;
  public deleteaccess: boolean = false;
  public lusrtpye: string;
  public useraccess: any;
  toppingListdep = [
    "Extra cheese",
    "Mushroom",
    "Onion",
    "Pepperoni",
    "Sausage",
    "Tomato",
  ];
  selectedToppingsdep;

  toppingListdes = [
    "Extra cheese",
    "Mushroom",
    "Onion",
    "Pepperoni",
    "Sausage",
    "Tomato",
  ];
  selectedToppingsdes;

  toppingListmdle = [
    "Extra cheese",
    "Mushroom",
    "Onion",
    "Pepperoni",
    "Sausage",
    "Tomato",
  ];
  selectedToppingsmdle;

  toppingListsbmdle = [
    "Extra cheese",
    "Mushroom",
    "Onion",
    "Pepperoni",
    "Sausage",
    "Tomato",
  ];
  selectedToppingssbmdle;

  public userinfo: any;
  public companyName: any;
  public companyId: any;
  public noDataAvailable: string =
  this.i18n('enterpriseadmin.thernoth')	;
  public logoUrl: string;

  /* MegaMenu Vaarible*/
  public menuUserPk: any;
  public menuAdd: any;
  public menuModulePk: any;
  public menuModuleId: any;
  public menuUserEnable: boolean = false;
  paginatorDataArray: any;

  /*Sar Starts*/
  @ViewChild('refBunitDept') refBunitDept: AdddepartmentComponent;
  public deptSrhName: any = '';
  public deptSrhPks: any = '';
  public bunitSrhPks: any = '';
  public deptSrhStatus: any = '';
  public redirectToggle: any = '';
  public stkholdertype: any;

  constructor(
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private route: ActivatedRoute,
    private localstorage: AppLocalStorageServices,
    private router: Router,
    public toastr: ToastrService,
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
  ngOnInit() {
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
    this.lusrtpye = this.localstorage.getInLocal('usertype');
    if (this.lusrtpye == 'U') {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
    }
    this.projectName = this.bgiConfigJson.projectName;
    this.dataSource.sort = this.sort;
    this.postParams = {};
    this.stakeholderUserDetails(this.postParams);
    this.companyDetails();

    /*Bunit Department*/
    this.postParams = {}
    this.commonBunitDeptSearch(this.postParams);

    this.redirectToggle = window.history.state.redirectToggle;
    if (this.redirectToggle == 'yes') {
      setTimeout(() => {
        this.drawerdepartment.toggle();
        this.adddep()
      }, 1500);
    } else {
      this.redirectToggle = '';
    }
  }
  chkUserPermission(url,type){
    // type= 1-usermangemnet,2 department,3-divisions ,4-inviteduser
   
    if(type == 1){
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
    if(type == 2){
     if((this.lusrtpye == 'A') || (this.lusrtpye == 'U'  && this.useraccess[238] && this.useraccess[238].read == 'Y')||
     (this.lusrtpye == 'U'  && this.useraccess[260] && this.useraccess[260].read == 'Y')|| this.useraccess[282] && this.useraccess[282].read == 'Y'){
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
     (this.lusrtpye == 'U'  && this.useraccess[259] && this.useraccess[259].read == 'Y') || this.useraccess[281] && this.useraccess[281].read){
       this.router.navigate([url]);
     }
     else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'),  this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
     }
   }
   if(type == 4){
    if((this.lusrtpye == 'A') || (this.lusrtpye == 'U'  && this.useraccess[239] && this.useraccess[239].read == 'Y')||
    (this.lusrtpye == 'U'  && this.useraccess[261] && this.useraccess[261].read == 'Y') || this.useraccess[283] && this.useraccess[283].read == 'Y'){
      this.router.navigate([url]);
    }
    else{
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'),  this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }
 
   }
  dashboardRedirect() {
    if (this.stkholdertype == 1) {
      this.router.navigate(['dashboard/portaladmin']);
    } else if (this.stkholdertype == 6) {
      this.router.navigate(['dashboard/supplier']);
    } else if (this.stkholdertype == 7) {
      this.router.navigate(['dashboard/operator']);
    }
  }

  ngAfterViewInit() {
    this.dataSource.sort = this.sort;
  }

  stakeholderUserDetails(postParam) {
    this.departmentloader=true;
    let accessModulePk = this.encrypt.encrypt("7");
    this.postUrl =
      "ea/user/list-stakholder-users?uac=f3f86bb473399a2239202c31420a1ee1&uam=" +
      accessModulePk;
    this.EnterpriseService.enterpriseService(postParam, this.postUrl).subscribe(
      function (data) {
        this.departmentloader=false;
        if (data["data"].status == 0) {
          swal({
            title: this.i18n('enterpriseadmin.warntitle'),
            text: data["data"].msg,
            icon: "warning",
          });
        } else {
          if (data["data"].status == 100) {
            this.userinfo = data["data"].data;
            this.logoUrl = data["data"].logo_url;
            // this.resultsLength = data["data"].totalcount;
            this.noDataAvailable =
            this.i18n('enterpriseadmin.thernoth') ;
          }
        }
      }.bind(this)
    );
  }

  animationState = "out";
  animationState1 = "out";

  toggle() {
    this.tog.toggle();
  }
  adddep() {
    this.departmentfilter.animationState = "out";
    this.departmentfilter.animationState1 = "out";
    this.departmentfilter.bunitDeptReset.reset();
  }
  UserPermissionaddDep(){
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[260] && this.useraccess[260].create == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[238] && this.useraccess[238].create == 'Y')|| this.useraccess[282] && this.useraccess[282].create == 'Y') {
      this.drawerdepartment.toggle();
      this.adddep();
    } else {
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'),  this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    } 
  }


  toggleShowDiv(divName: string) {
    if (divName === "descriptioncontent") {
      this.animationState = this.animationState === "out" ? "in" : "out";
    }
  }

  edit(userPk) {
    this.updateStakeholderUser.stakehlderUserUpdateDetails(userPk);
    this.draweruseranddepartment.toggle();
  }

  fetchSideNavDetails() {
    this.updateStakeholderUser.reloadUserDepartment();
  }

  companyDetails() {
    this.postParams = {};
    let accessModulePk = this.encrypt.encrypt("7");
    this.postUrl =
      "ea/user/fetch-user-company-details?uac=f3f86bb473399a2239202c31420a1ee1&uam=" +
      accessModulePk;
    this.EnterpriseService.enterpriseService(
      this.postParams,
      this.postUrl
    ).subscribe(
      function (data) {
        if (data["data"].status == 0) {
          swal({
            title: this.i18n('enterpriseadmin.warntitle'),
            text: data["data"].msg,
            icon: "warning",
          });
        } else {
          if (data["data"].status == 100) {
            this.companyName = data["data"].data.userCompanyDetails.cmpName;
            this.companyId = data["data"].data.userCompanyDetails.cmpRegNo;
            // this.updateStakeholderUser.companyUserDetails(
            //   this.companyName,
            //   this.companyId
            // );
          }
        }
      }.bind(this)
    );
  }

  update(userPk, status) {
    let statMsg = "";
    let statSuccessMsg = "";
    if (status == "D") {
      statMsg = this.i18n('enterpriseadmin.doyouwantuser');
      statSuccessMsg = this.i18n('enterpriseadmin.userdelesucc');
    } else {
      if (status == "I") {
        statMsg = this.i18n('enterpriseadmin.doyouwantactiuser');
        statSuccessMsg = this.i18n('enterpriseadmin.useractisucc');
      } else {
        statMsg = this.i18n('enterpriseadmin.doyouwantinacuser');
        statSuccessMsg = this.i18n('enterpriseadmin.userdeacsucc');
      }
    }
    let usrPk = this.encrypt.encrypt(userPk);
    swal({
      title: statMsg,
      icon: "warning",
      buttons: [this.i18n('enterpriseadmin.no'), this.i18n('enterpriseadmin.yes')],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false,
    }).then((willDelete) => {
      if (willDelete) {
        this.showResponsiveLoader = true;
        this.postParams = {
          userPk: usrPk,
          status: status,
        };
        this.postUrl = "ea/user/update-stakholder-users";
        this.EnterpriseService.enterpriseService(
          this.postParams,
          this.postUrl
        ).subscribe(
          function (data) {
            if (data["data"].status == 100) {
              swal({
                title: statSuccessMsg,
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false,
              }).then((value) => {
                this.showResponsiveLoader = false;
                if (value) {
                  this.postParams = {
                    size: this.perpage,
                    page: this.pages,
                  };
                  this.enterpriseCountRef.enterpriseCount();
                  this.stakeholderUserDetails(this.postParams);
                }
              });
            } else {
              swal({
                title: data["data"].msg,
                icon: "warning",
                closeOnClickOutside: false,
                closeOnEsc: false,
              });
            }
          }.bind(this)
        );
      }
    });
  }

  reloadGrid() {
    this.postParams = {
      size: this.perpage,
      page: this.pages,
    };
    // this.enterpriseFilter.getBranchNameList();
    // this.stakeholderUserDetails(this.postParams);
    // this.enterpriseFilter.advanceFilter(
    //   "",
    //   this.perpage,
    //   this.paginator.pageIndex,
    //   "out"
    // );
  }

  userFilterData(event) {
    if (event.resetPagination) {
      this.paginator.firstPage();
    }
    this.userinfo = event.data;
    this.resultsLength = event.totalcount;
    if (this.resultsLength == 0) {
      this.noDataAvailable = this.i18n('enterpriseadmin.thernoth');
    }
  }

  resendMail(pk: number, status: string) {
    if (status == "Expired" || status == "Invited") {
      this.disableResendBtn = this.showResponsiveLoader = true;
      this.EnterpriseService.resendInviteMail(
        this.encrypt.encrypt(pk)
      ).subscribe((data) => {
        swal({
          title:
            data["data"].status == 2
              ? data["data"].msg
              : data["data"].status == 1
                ? this.i18n('enterpriseadmin.mailresesucc')
                : this.i18n('enterpriseadmin.somewentwron'),
          icon:
            data["data"].status == 2
              ? "warning"
              : data["data"].status == 1
                ? "success"
                : "warning",
          closeOnClickOutside: false,
          closeOnEsc: false,
        });
        this.disableResendBtn = this.showResponsiveLoader = false;
        // if (data["data"].status == 1)
        //   this.enterpriseFilter.advanceFilter(
        //     "",
        //     this.perpage,
        //     this.paginator.pageIndex,
        //     "out"
        //   );
      });
    } else if (status == "Accepted") {
      swal({
        title: this.i18n('enterpriseadmin.thisuserhasalre'),
        icon: "warning",
        closeOnClickOutside: false,
        closeOnEsc: false,
      });
    }
  }

  deleteInvite(userpk: any) {
    swal({
      title: this.i18n('enterpriseadmin.doyouwantuser'),
      icon: "warning",
      buttons: [this.i18n('enterpriseadmin.no'), this.i18n('enterpriseadmin.yes')],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false,
    }).then((willDelete) => {
      if (willDelete) {
        this.showResponsiveLoader = true;
        this.EnterpriseService.deleteInvite(userpk).subscribe((data) => {
          swal({
            title: data["data"].msg,
            icon: data["data"].status == 1 ? "success" : "warning",
            closeOnClickOutside: false,
          }).then(() => {
            this.showResponsiveLoader = false;
            // this.enterpriseFilter.advanceFilter(
            //   "",
            //   this.perpage,
            //   this.paginator.pageIndex,
            //   "out"
            // );
          });
        });
      }
    });
  }

  toggleUserandInviteUser() {
    this.departmentfilter.showInvitedUser = !this.departmentfilter
      .showInvitedUser;
    if (!this.departmentfilter.showInvitedUser) {
      this.departmentfilter.checkedFilterArr = [];
      this.departmentfilter.filtercount = 0;
    }
    this.paginator.firstPage();
    // this.enterpriseFilter.advanceFilter(
    //   "",
    //   this.perpage,
    //   this.paginator.pageIndex,
    //   "out"
    // );
  }
  newModuleAllocation(menuModulePk, searchData = "") {
    this.menuModuleId = menuModulePk;
    this.postParams = {
      moduleId: menuModulePk,
      searchData: searchData,
    };
    this.postUrl =
      "ea/user/fetch-module-user-details?uac=f9d6c6ad2e0f8bfded8c4c37e4140629";
    this.EnterpriseService.enterpriseService(
      this.postParams,
      this.postUrl
    ).subscribe(
      function (data) {
        if (data["data"].status == 100) {
          this.moduleUserDetails = data["data"].data.userDetail;
        }
      }.bind(this)
    );
    if (!this.configurebymodule.opened) {
      this.configurebymodule.toggle();
    }
  }

  deptUserSearch(event) {
    this.newModuleAllocation(this.menuModuleId, event);
  }

  closeConfigureModule(event) {
    this.menuUserEnable = false;
  }

  /*Bunit Department*/
  deptReload(event) {
    this.postParams = {
      'size': this.perpage,
      'page': this.pages,
      'column': this.sort.active,
      'direction': this.sort.direction,
      'deptName': '',
      'deptStatus': '',
    };
    this.deptSrhName = '';
    this.deptSrhPks = '';
    this.bunitSrhPks = '';
    this.deptSrhStatus = '';

    this.departmentfilter.bunitFrmRst();
    this.commonBunitDeptSearch(this.postParams);
    this.enterpriseCountRef.enterpriseCount();
  }


  commonBunitDeptSearch(postParams) {
    // this.showResponsiveLoader = true;
    this.departmentloader=true;
    this.postUrl = 'ea/department/list-bunit-department';
    this.EnterpriseService.enterpriseService(postParams, this.postUrl).subscribe(
      function (data) {
        this.dataSource.data = data['data'].data;
        this.resultsLength = data['data'].totalcount;
        this.text = false;
        // this.showResponsiveLoader = false;
        setTimeout(() => {
          this.departmentloader=false;
        }, 3500);
      }.bind(this)
    );
  }
  adddepttog() {
        if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[260] && this.useraccess[260].create == 'Y'
    || (this.lusrtpye == 'U' && this.useraccess[238] && this.useraccess[238].create == 'Y')) || this.useraccess[282] && this.useraccess[282].create) {
      this.drawerdepartment.toggle();
    } else {
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }
  updateBunitDepartment(deptPk, usercount,divCount,deptUser) {

    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[260] && this.useraccess[260].update == 'Y'
    || (this.lusrtpye == 'U' && this.useraccess[238] && this.useraccess[238].update == 'Y')) ||this.useraccess[282] && this.useraccess[282].update == 'Y') {
      if (divCount > 0 && deptUser) { 
        swal({
          title: this.i18n('enterpriseadmin.youcanneditdepa'),
          icon: 'warning',
        });
      } else{
        this.refBunitDept.showprojlstcreate=true;
        this.refBunitDept.fetchBunitDept(deptPk);
        this.departmentfilter.animationState = "out";
        this.departmentfilter.animationState1 = "out";
      } 
    } else {
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }


  updateBunitStatus(deptPk, deptStatus,usercnt) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[260] && this.useraccess[260].update == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[238] && this.useraccess[238].update == 'Y')||this.useraccess[282] && this.useraccess[282].update == 'Y') {
    if(usercnt > 0 && deptStatus == 1){
      swal({
        title: this.i18n('enterpriseadmin.youcanndeacdepa'),
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      });
    }else{
        let deptStat = (deptStatus == 1) ? 2 : 1;
        this.changeBunitStatus(deptPk, deptStat);
        this.showResponsiveLoader = true;

    }
  } else {
    this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  } 
  }

  deleteBunitStatus(deptPk) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[46] && this.useraccess[46].delete == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[260] && this.useraccess[260].delete == 'Y')
    || (this.lusrtpye == 'U' && this.useraccess[238] && this.useraccess[238].delete == 'Y') || this.useraccess[282] && this.useraccess[282].delete == 'Y') {
      this.changeBunitStatus(deptPk, 3);
    } else {
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
    }
  }

  changeBunitStatus(deptPk, deptStat) {
    let deptWarningMsg = this.i18n('enterpriseadmin.areyousure');
    let deptErrorMsg = this.i18n('enterpriseadmin.delesucc');
    if (deptStat == 1) {
      deptWarningMsg = this.i18n('enterpriseadmin.areyousureacti');
      deptErrorMsg = this.i18n('enterpriseadmin.depaacttisucc');
    } else if (deptStat == 2) {
      deptWarningMsg = this.i18n('enterpriseadmin.doyouwantdeacdepa');
      deptErrorMsg = this.i18n('enterpriseadmin.depadeacsucc');
    }

    swal({
      title: deptWarningMsg,
      icon: 'warning',
      buttons: [this.i18n('enterpriseadmin.canc'), this.i18n('enterpriseadmin.ok')],
      dangerMode: true,
    }).then((afterUpdate) => {
      if (afterUpdate) {
        this.showResponsiveLoader = true;
        this.postParams = {
          'deptPk': this.encrypt.encrypt(deptPk),
          'deptStatus': deptStat,
        };
        this.postUrl = 'ea/department/change-bunit-dept-status';
        this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
          function (data) {
            this.showResponsiveLoader = false;

            if (data['data'].status == 105) {
              deptErrorMsg = data['data'].msg;
            }

            if (data['data'].status == 100) {
              this.postParams = {
                'size': this.perpage,
                'page': this.pages,
                'column': this.sort.active,
                'direction': this.sort.direction,
                'deptStatus': this.deptSrhStatus,
                'deptPks': this.deptSrhPks,
                'bunitPks': this.bunitSrhPks,
                'deptName': this.deptSrhName
              };
              this.commonBunitDeptSearch(this.postParams);
              this.enterpriseCountRef.enterpriseCount();
              // swal({
              //   title: deptErrorMsg,
              //   icon: 'success'
              // }).then((afterUpdate) => {
              
              // });
              this.showTSuccess(deptErrorMsg);
            } else {
              // swal({
              //   title: deptErrorMsg,
              //   icon: 'warning',
              //   closeOnClickOutside: false,
              //   closeOnEsc: false
              // });
              this.showWSuccess(deptErrorMsg);
            }
          }.bind(this)
        );
      } else {
        this.showResponsiveLoader = false;
      }
    });
  }

  syncPrimaryPaginatorBunit(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  onPaginateBunitChange(event) {
    this.perpage = event.pageSize;
    this.pages = event.pageIndex;
    this.postParams = {
      'size': this.perpage,
      'page': this.pages,
      'column': this.sort.active,
      'direction': this.sort.direction,
      'deptStatus': this.deptSrhStatus,
      'deptPks': this.deptSrhPks,
      'bunitPks': this.bunitSrhPks,
      'deptName': this.deptSrhName
    };
    this.commonBunitDeptSearch(this.postParams);
  }

  departmentFilter(event) {
   
    this.postUrl = 'ea/department/list-bunit-department';
    this.postParams = {
      'size': this.perpage,
      'page': this.pages,
      'column': this.sort.active,
      'direction': this.sort.direction,
      'deptName': event,
      'deptStatus': this.deptSrhStatus,
      'deptPks': this.deptSrhPks,
      'bunitPks': this.bunitSrhPks,
    };
    this.deptSrhName = event;
    this.departmentloader=false;
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.departmentloader=false;
        this.departmentgridloader = false;
        if (data['data'].status == 100) {
          this.dataSource.data = data['data'].data;
          this.resultsLength = data['data'].totalcount;
        }
      }.bind(this)
    );
  }

  advanceDepartmentFilter(event) {
    this.postUrl = 'ea/department/list-bunit-department';
    this.postParams = {
      'size': this.perpage,
      'page': this.pages,
      'column': this.sort.active,
      'direction': this.sort.direction,
      'deptPks': event.deptPks,
      'bunitPks': event.bunitPks,
      'deptName': event.keyworsSrh,
      'deptStatus': event.deptStatus,
    };
    this.deptSrhName = event.keyworsSrh;
    this.deptSrhPks = event.deptPks;
    this.bunitSrhPks = event.bunitPks;
    this.deptSrhStatus = event.deptStatus;
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.dataSource.data = data['data'].data;
          this.resultsLength = data['data'].totalcount;
        }
        this.departmentgridloader=false;
      }.bind(this)
    );
  }

  sortEvent(event) {
    this.postParams = {
      'size': this.perpage,
      'page': this.pages,
      'column': this.sort.active,
      'direction': this.sort.direction,
      'deptStatus': this.deptSrhStatus,
      'deptPks': this.deptSrhPks,
      'bunitPks': this.bunitSrhPks,
      'deptName': this.deptSrhName
    };

    this.commonBunitDeptSearch(this.postParams);
  }

  userDeptFilter(userCount, deptPk) {
    if (userCount > 0) {
      this.router.navigate(['enterpriseadmin/usermanagement'], { state: { deptFltr: deptPk } });
    }
  }
  outputloader(event) {
    this.showResponsiveLoader = event;
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
}
