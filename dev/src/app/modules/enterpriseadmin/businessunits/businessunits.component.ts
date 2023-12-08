import { HttpClient } from "@angular/common/http";
import { ChangeDetectorRef, Component, HostListener, Input, OnInit, ViewChild, ViewEncapsulation } from "@angular/core";
import { FormBuilder, FormGroup } from "@angular/forms";
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { ActivatedRoute, Router } from "@angular/router";
import { AddsectoractivitiesComponent } from '@app/@shared/sidepanel/addsectoractivities/addsectoractivities.component';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { environment } from '@env/environment';
import "rxjs/add/observable/of";
import { Observable } from "rxjs/Observable";
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { map } from 'rxjs/operators/map';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import swal from "sweetalert";
import { ProfileService } from '../../profilemanagement/profile.service';
import { ActivityfilterComponent } from "../activityfilter/activityfilter.component";
import { AddbusinessunitComponent } from '../addbusinessunit/addbusinessunit.component';
import { AddingdetailssidenavComponent } from "../addingdetailssidenav/addingdetailssidenav.component";
import { SlideInOutAnimation } from "../animation";
import { BusinessunitfilterComponent } from "../businessunitfilter/businessunitfilter.component";
import { EnterpriseService } from "../enterprise.service";
import { UsereachcountsComponent } from "../usereachcounts/usereachcounts.component";
import {ToastrService} from 'ngx-toastr'
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

export interface Element {
  businessunitid: string;
  businessunits: string;
  businessunitname: string;
  departments: string;
  users: string;
}

@Component({
  selector: "app-businessunits",
  templateUrl: "./businessunits.component.html",
  styleUrls: ["./businessunits.component.scss"],
  encapsulation: ViewEncapsulation.Emulated,
  animations: [SlideInOutAnimation],
})
export class BusinessunitsComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }

  displayedColumns = [
    "bUnitRefNo",
    "bUnitName",
    "bUnitSector",
    "action",
  ];

  warnUserBeforeLeavingPage = true;
  divisionloader: boolean = false;
  divisionloadergrid: boolean = false;
  businessUnitDetails: BusinessUnitDetails;
  companypk: any;
  @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
    if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
    }
  }

  pageEvent: any;
  resultsLength: number;
  overAllCount: number;
  perpage = 10;
  @Input() tog: any = "";
  dataSourceforpermission: any;
  permissionarray: any;
  paginatorDataArray: any;
  finalpermissionarray: any = [];
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  showInvitedUserOnly: boolean = false;
  @ViewChild("draweruseranddepartment") draweruseranddepartment: MatDrawer;
  @ViewChild("addbusinessunit") addbusinessunit: MatDrawer;
  @ViewChild("addbusinessunitmcp") addbusinessunitmcp: MatDrawer;
  @ViewChild("divisionView") divisionView: MatDrawer;
  @ViewChild("configurebymodule") configurebymodule: MatDrawer;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public postUrl: any;
  public postParams: any;
  @ViewChild("updateStakeholderUser")
  updateStakeholderUser: AddingdetailssidenavComponent;
  @ViewChild("enterpriseFilter") enterpriseFilter: ActivityfilterComponent;
  @ViewChild("businessFilter") businessFilter: BusinessunitfilterComponent;
  @ViewChild("enterpriseCountRef") enterpriseCountRef: UsereachcountsComponent;
  @ViewChild("draweraddinguser") draweraddinguser: MatDrawer;
  @ViewChild("draweruseractivitylisting") draweruseractivitylisting: MatDrawer;
  public moduleUserDetails: any;

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
  public editaccess: boolean = false;
  public deleteaccess: boolean = false;
  public lusrtpye: string;
  public useraccess: any;
  public noDataAvailable: string =
   this.i18n('enterpriseadmin.thernoth')
  public logoUrl: string;

  /*Sar Starts*/
  public dataSource = new MatTableDataSource();
  public dataSource2 = new MatTableDataSource();
  @ViewChild('refBunit') refBunit: AddbusinessunitComponent;

  @ViewChild('refBusinessunit') refBusinessunit: AddsectoractivitiesComponent;
  public stkholdertype: any;
  public redirectToggle: any = '';
  public viewBunitdt: any = '';

  constructor(
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    public encrypt: Encrypt,
    private route: ActivatedRoute,
    private localstorage: AppLocalStorageServices,
    private profileService: ProfileService,
    private cdr: ChangeDetectorRef,
    private http: HttpClient,
    private router: Router,
    public toastr: ToastrService,
    private translate: TranslateService,
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
    this.dataSource.sort = this.sort;
    this.postParams = {};
    this.stakeholderUserDetails(this.postParams);
    this.companyDetails();


    /*Sar Starts*/

    this.postParams = {};
    this.bUnitList(this.postParams);
    this.companypk = this.localstorage.getInLocal('comp_pk');

    this.redirectToggle = window.history.state.redirectToggle;
    if (this.redirectToggle == 'yes') {
      setTimeout(() => {
        this.addBunitsto();
        this.getbusinessInput();
        this.adddivision();
      }, 1500);
    } else {
      this.redirectToggle = '';
    }
  }
  toggle1: boolean = false;
  despchange() {
    this.toggle1 = !this.toggle1;
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

  getbusinessInput() {
    setTimeout(() => {

      this.getSectorDtls(this.encrypt.encrypt(this.companypk));
    }, 400)
  }
  getSectorDtls(companypk) {
    this.businessUnitDetails = new BusinessUnitDetails(this.http, companypk);
    // If the user changes the sort order, reset back to the first page.
    // this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.businessUnitDetails!.businessUnitData(
            this.sort.active, this.sort.direction);
        }),
        map(data => {
          this.resultsLength = data['data'].items.totalcount;
          return data['data'].items.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.dataSource2.data = data;
      });
  }

  stakeholderUserDetails(postParam) {
    this.divisionloader = true;
    let accessModulePk = this.encrypt.encrypt("7");
    this.postUrl =
      "ea/user/list-stakholder-users?uac=f3f86bb473399a2239202c31420a1ee1&uam=" +
      accessModulePk;
    this.EnterpriseService.enterpriseService(postParam, this.postUrl).subscribe(
      function (data) {
        this.divisionloader = false;
        this.divisionloadergrid =false;
        if (data["data"].status == 0) {
          swal({
            title:  this.i18n('enterpriseadmin.warntitle'),
            text: data["data"].msg,
            icon: "warning",
          });
        } else {
          if (data["data"].status == 100) {
            this.userinfo = data["data"].data;
            this.logoUrl = data["data"].logo_url;
            // this.resultsLength = data["data"].totalcount;
            this.noDataAvailable =
            this.i18n('enterpriseadmin.thernoth');
          }
        }
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
    this.enterpriseFilter.advanceFilter(
      "",
      1,
      this.perpage,
      this.paginator.pageIndex,
      "out"
    );
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
    this.enterpriseFilter.advanceFilter(
      "",
      1,
      this.perpage,
      this.paginator.pageIndex,
      "out"
    );
  }

  animationState = "out";
  animationState1 = "out";

  toggle() {
    this.tog.toggle();
  }
  adddivision() {
    this.businessFilter.animationState = "out";
    this.businessFilter.animationState1 = "out";
    this.businessFilter.bunitDivReset.reset();
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
  outputloader(event) {
    this.showResponsiveLoader = event;
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
      buttons: [ this.i18n('enterpriseadmin.no'),  this.i18n('enterpriseadmin.yes')],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false,
    }).then((willDelete) => {
      if (willDelete) {
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
                if (value) {
                  this.postParams = {
                    size: this.perpage,
                    page: this.paginator.pageIndex,
                  };
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
      page: this.paginator.pageIndex,
    };
    this.enterpriseFilter.getBranchNameList();
    // this.stakeholderUserDetails(this.postParams);
    this.enterpriseFilter.advanceFilter(
      "",
      1,
      this.perpage,
      this.paginator.pageIndex,
      "out"
    );
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
        if (data["data"].status == 1)
          this.enterpriseFilter.advanceFilter(
            "",
            1,
            this.perpage,
            this.paginator.pageIndex,
            "out"
          );
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
        this.EnterpriseService.deleteInvite(userpk).subscribe((data) => {
          swal({
            title: data["data"].msg,
            icon: data["data"].status == 1 ? "success" : "warning",
            closeOnClickOutside: false,
          }).then(() => {
            this.enterpriseFilter.advanceFilter(
              "",
              1,
              this.perpage,
              this.paginator.pageIndex,
              "out"
            );
          });
        });
      }
    });
  }

  toggleUserandInviteUser() {
    this.enterpriseFilter.showInvitedUser = !this.enterpriseFilter
      .showInvitedUser;
    if (!this.enterpriseFilter.showInvitedUser) {
      this.enterpriseFilter.checkedFilterArr = [];
      this.enterpriseFilter.filtercount = 0;
    }
    this.paginator.firstPage();
    this.enterpriseFilter.advanceFilter(
      "",
      1,
      this.perpage,
      this.paginator.pageIndex,
      "out"
    );
  }

  /*Sar Starts*/

  bUnitList(postParams) {
    // this.showResponsiveLoader=true;
    this.postUrl = 'ea/businessunit/list-bunit';
    this.EnterpriseService.enterpriseService(postParams, this.postUrl).subscribe(
      function (data) {
        this.dataSource.data = data['data'].data;
        this.resultsLength = data['data'].totalcount;
        this.overAllCount = data['data'].overAllCount;
        this.text = false;
         this.showResponsiveLoader=false;
        setTimeout(() => {
          this.divisionloader = false;
          this.divisionloadergrid =false;
        }, 3500);
        this.divisionloadergrid=false;
      }.bind(this)
    );
  }

  bunitReload(event) {
    let searkeywrd = '';
    let divisionkey = '';
    let sectorkey = '';
    if (this.filterval.length != 0) {
      searkeywrd = this.filterval.searchKey;
      divisionkey = this.filterval.division;
      sectorkey = this.filterval.sector;
    }
    this.postParams = {
      'size': this.perpage,
      'page': ((this.paginator) ? (this.paginator.pageIndex) : 0),
      'column': this.sort.active,
      'direction': this.sort.direction,
      'searchKey': searkeywrd,
      'division': divisionkey,
      'sector': sectorkey
    };
    this.businessFilter.clearFilterForm();
    this.enterpriseCountRef.enterpriseCount();
    this.bUnitList(this.postParams);
  }
  addBunitsto() {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[45] && this.useraccess[45].create == 'Y') 
    ||(this.lusrtpye == 'U' &&this.useraccess[237] && this.useraccess[237].create == 'Y')||(this.lusrtpye == 'U' && this.useraccess[259] && this.useraccess[259].create == 'Y')||this.useraccess[281] && this.useraccess[281].create == 'Y') {
      this.addbusinessunitmcp.toggle();
    } else {
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
      });
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
     (this.lusrtpye == 'U'  && this.useraccess[260] && this.useraccess[260].read == 'Y') || this.useraccess[282] && this.useraccess[282].read == 'Y'){
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
     (this.lusrtpye == 'U'  && this.useraccess[259] && this.useraccess[259].read == 'Y')||this.useraccess[281] && this.useraccess[281].read == 'Y'){
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
    (this.lusrtpye == 'U'  && this.useraccess[261] && this.useraccess[261].read == 'Y') ||  this.useraccess[283] && this.useraccess[283].read == 'Y'){
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

  viewBunit(bunitPk) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[45] && this.useraccess[45].read == 'Y')
    ||(this.lusrtpye == 'U' && this.useraccess[237] && this.useraccess[237].read == 'Y')||
    (this.lusrtpye == 'U' && this.useraccess[259] && this.useraccess[259].read == 'Y') || this.useraccess[281] && this.useraccess[281].read == 'Y') {
    this.showResponsiveLoader = true;
    this.postUrl = 'ea/businessunit/view-bunit-data';
    this.postParams = {
      'bunitPk': this.encrypt.encrypt(bunitPk)
    };

    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.showResponsiveLoader = false;
        this.viewBunitdt = data['data'].data.viewBunitData;
        this.divisionView.toggle();
      }.bind(this)
    );
  } else {
    this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
timeOut: 3000,
closeButton: true,
});
}
  }

  closeView() {
    this.divisionView.toggle();
  }

  editBunit(bunitPk) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[45] && this.useraccess[45].update == 'Y')
    ||(this.lusrtpye == 'U' && this.useraccess[237] && this.useraccess[237].update == 'Y')||(this.lusrtpye == 'U'&&this.useraccess[259] && this.useraccess[259].update == 'Y') || this.useraccess[281] && this.useraccess[281].update == 'Y') {
      this.refBusinessunit.showprojlstcreate = true;
      this.addbusinessunitmcp.toggle();
      this.refBusinessunit.secactbuttonname = this.i18n('enterpriseadmin.upda');
      let pk = this.encrypt.encrypt(bunitPk);
      this.profileService.viewSectorActivity(pk).subscribe(data => {
        this.refBusinessunit.patchBusinessUnitDetails(data['data'].items[0]);
      })
      this.businessFilter.animationState = "out";
      this.businessFilter.animationState1 = "out";
    } else {
      this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
    }
  }

  deleteBunit(bunitPk, isBunitChecked = false, isMappedUser = false, ismappeddepartment = false) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[45] && this.useraccess[45].delete == 'Y')
    ||(this.lusrtpye == 'U'&& this.useraccess[237] && this.useraccess[237].delete == 'Y')||
    (this.lusrtpye == 'U' &&this.useraccess[259] && this.useraccess[259].delete == 'Y') || this.useraccess[281] && this.useraccess[281].delete == 'Y') {
    if (!isBunitChecked && !isMappedUser && !ismappeddepartment) {
        swal({
          title: this.i18n('enterpriseadmin.doyouwandeledivi'),
          icon: 'warning',
          buttons: [this.i18n('enterpriseadmin.canc'), this.i18n('enterpriseadmin.ok')],
          dangerMode: true,
        }).then((afterUpdate) => {
          this.showResponsiveLoader = true;
          if (afterUpdate) {
            this.postParams = {
              "bunitPk": this.encrypt.encrypt(bunitPk)
            };
            this.postUrl = 'ea/businessunit/delete-bunit';
            this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
              function (data) {
                this.showResponsiveLoader = false;
                if (data['data'].status == 100) {
                     this.showTSuccess(this.i18n('enterpriseadmin.dividelesucc'));
                     let searkeywrd = '';
                     let divisionkey = '';
                     let sectorkey = '';
                     if (this.filterval.length != 0) {
                       searkeywrd = this.filterval.searchKey;
                       divisionkey = this.filterval.division;
                       sectorkey = this.filterval.sector;
                     }
                     this.postParams = {
                       'size': this.perpage,
                       'page': ((this.paginator) ? (this.paginator.pageIndex) : 0),
                       'column': this.sort.active,
                       'direction': this.sort.direction,
                       'searchKey': searkeywrd,
                       'division': divisionkey,
                       'sector': sectorkey
                     };
                     this.bUnitList(this.postParams);
                     this.enterpriseCountRef.enterpriseCount();
                  // swal({
                  //   title: 'Division deleted successfully.',
                  //   // text: 'Deleted successfully',
                  //   icon: 'success'
                  // }).then((afterUpdate) => {
                   
                  // });
                } else {
                  swal({
                    title: this.i18n('enterpriseadmin.warn'),
                    text: data['data'].msg,
                    icon: 'warning',
                    closeOnClickOutside: false,
                    closeOnEsc: false
                  });
                }
              }.bind(this)
            );
          } else {
            this.showResponsiveLoader = false;
          }
        });
    } else {
      let commonMsg = '';
      if (isBunitChecked && isMappedUser && ismappeddepartment) {
        commonMsg = this.i18n('enterpriseadmin.auserabusisour');
      } else if (isBunitChecked && ismappeddepartment) {
        commonMsg = this.i18n('enterpriseadmin.abusisouradepa');
      } else if (isBunitChecked && isMappedUser) {
        commonMsg = this.i18n('enterpriseadmin.auseransabusi');
      } else if (isMappedUser && ismappeddepartment) {
        commonMsg = this.i18n('enterpriseadmin.auserandadepa');
      } else if (isMappedUser) {
        commonMsg = this.i18n('enterpriseadmin.auser');
      } else if (isBunitChecked) {
        commonMsg = this.i18n('enterpriseadmin.abusisour');
      } else {
        commonMsg = this.i18n('enterpriseadmin.adepa');
      }
      swal({
        title: this.i18n('enterpriseadmin.youcanndelethis') + commonMsg,
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      });
    }
  } else {
    this.toastr.warning(this.i18n('enterpriseadmin.youdonthave'), this.i18n('enterpriseadmin.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  }

  onPaginateBunitChange(event) {
    this.paginatorDataArray = event;
    this.perpage = event.pageSize;
    let searkeywrd = '';
    let divisionkey = '';
    let sectorkey = '';
    if (this.filterval.length != 0) {
      searkeywrd = this.filterval.searchKey;
      divisionkey = this.filterval.division;
      sectorkey = this.filterval.sector;
    }
    this.postParams = {
      'size': this.perpage,
      'page': this.paginator.pageIndex,
      'column': this.sort.active,
      'direction': this.sort.direction,
      'searchKey': searkeywrd,
      'division': divisionkey,
      'sector': sectorkey
    };
    this.bUnitList(this.postParams);
  }


  showTSuccess(data) {
    this.toastr.success(data, this.i18n('enterpriseadmin.succ'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  showWSuccess(data) {
    this.toastr.warning(data, this.i18n('enterpriseadmin.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  }

  syncPrimaryPaginatorBunit(event: PageEvent) {
    this.paginatorDataArray = event;
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }
  filterval: any = [];
  bunitFilter(event) {
    this.filterval = event;
    let searkeywrd = this.filterval.searchKey;
    let divisionkey = this.filterval.division;
    let sectorkey = this.filterval.sector;
    this.postParams = {
      'size': this.perpage,
      'page': ((this.paginator) ? (this.paginator.pageIndex) : 0),
      'column': this.sort.active,
      'direction': this.sort.direction,
      'searchKey': searkeywrd,
      'division': divisionkey,
      'sector': sectorkey
    };
    this.bUnitList(this.postParams);
  }

  sortEvent(event) {
    let searkeywrd = '';
    let divisionkey = '';
    let sectorkey = '';
    if (this.filterval.length != 0) {
      searkeywrd = this.filterval.searchKey;
      divisionkey = this.filterval.division;
      sectorkey = this.filterval.sector;
    }
    this.postParams = {
      'size': this.perpage,
      'page': ((this.paginator) ? (this.paginator.pageIndex) : 0),
      'column': this.sort.active,
      'direction': this.sort.direction,
      'searchKey': searkeywrd,
      'division': divisionkey,
      'sector': sectorkey
    };
    this.bUnitList(this.postParams);
  }
}
export class BusinessUnitDetails {
  companypk: any;
  constructor(private http: HttpClient, companypk: any) {
    this.companypk = companypk;
  }

  businessUnitData(sort: string, order: string): Observable<any> {
    const href = environment.baseUrl + "mcp/mastercompanyprofile/businessunit?companypk=" + this.companypk;
    //const sign = (order == 'desc') ? '-' : 'desc';
    const requestUrl =
      `${href}&sort=-MemCompSecDtls_Pk&order=desc`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
