import { Component, HostListener, OnInit, ViewChild, ViewEncapsulation, Input} from '@angular/core';

import { FormGroup, Validators, FormBuilder } from '@angular/forms';

import { AccountsettingsService } from './accountsettings.service';

import swal from 'sweetalert';

import { SubscriptionpaymentlistComponent } from './subscriptionpaymentlist/subscriptionpaymentlist.component';
import { FactorauthenticationComponent } from '@app/@shared/factorauthentication/factorauthentication.component';
import { DriveInput } from '@app/common/classes/driveInput';
import { Filee } from '@app/@shared/filee/filee';
import { MatTabGroup } from '@angular/material/tabs';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ActivatedRoute, Router, Route } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { MatDrawer } from '@angular/material/sidenav';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { Successdialog } from '@app/@shared/modal/successdialog';
import { TwofactorauthComponent } from './twofactorauth/twofactorauth.component';
import { TranslateService } from '@ngx-translate/core';
import { MatDialog } from '@angular/material/dialog';
import { Encrypt } from '@app/common/class/encrypt';

export interface PeriodicElement {
  name: string;
  type: number;
}
const ELEMENT_DATA: PeriodicElement[] = [
  { name: 'Enterprise Admin', type: 1 },
  { name: 'Divisions', type: 2 },
  { name: 'Departments', type: 2 },
  { name: 'User Creation', type: 2 },
  { name: 'Accounts Settings', type: 1 },
  { name: 'General Settings', type: 2 },
  { name: 'Manage Subscription', type: 2 },
  { name: 'Email Preference', type: 2 },
  { name: 'Master Company Profile', type: 1 },
  { name: 'Company Information', type: 2 },
  { name: 'About Company', type: 2 },
  { name: 'Accomplishments', type: 2 },
  { name: 'Market Presence', type: 2 },
  { name: 'Web Presence', type: 2 },
  { name: 'Board Members and Management Team', type: 2 },
  { name: 'Domain Profile', type: 1 },
  { name: 'Business Source', type: 2 },
  { name: 'Product Catalog', type: 2 },
  { name: 'Service Catalog', type: 2 },
  { name: 'jSearch', type: 1 },
  { name: 'Internal Search', type: 2 },
  { name: 'Domain Search', type: 2 },
  { name: 'JSRS Search', type: 2 },
  { name: 'Supplier Certification Management', type: 1 },
];
@Component({
  selector: 'app-accountsettings',
  templateUrl: './accountsettings.component.html',
  styleUrls: ['./accountsettings.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class AccountsettingsComponent implements OnInit {
  [x: string]: any;
  disableSubmitButton: boolean;
  i18n(key){
    return this.translate.instant(key);
  }
  public disableloader: boolean = true;

  text: boolean = true;
  public projectName: string;
  public MRM_ValSubStatus: any;
  public RegisteredOn: any;
  public UserCreatedOn: any;
  public mcm_RegistrationNo: number;
  public supplierId: any;
  public MRM_RenewalStatus: any;
  public industryType: any;
  public buyerId: any;
  public selectedtab: any = 0;
  public accountsettingForm: FormGroup;
  public companyPk: any;
  drv_logo: DriveInput;
  accSettingsData: any;
  public settData: any;
  userType: any;
  companytype: any;
  filemstPk: number = 10; // 5 - company filemst reference
  isForRenewal: any;
  showemailpref: any;
  isGraceExpired: any;
  contactusData = {};
  twofactorData = {};
  editdata: "";
  public lusrtpye:any=null;
  public useraccess:any;
  @ViewChild('logo') logo: Filee;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild('subscriptiontab') subscriptiontab: SubscriptionpaymentlistComponent;
  @ViewChild('twofactorauthtab') twofactorauthtab: TwofactorauthComponent;
  @ViewChild('factortab') factortab: FactorauthenticationComponent;
  @ViewChild('certificaterenewaldrawer') certificaterenewaldrawer: MatDrawer;
  warnUserBeforeLeavingPage = true;
  stakeHolderType: any;
  displayedColumns: string[] = ['module', 'create', 'update', 'read', 'delete', 'approval', 'download'];
  dataSource = ELEMENT_DATA;
  public buttonname: string = 'Request Access';
  public changeuserloader: boolean = false;
  dataSourceforpermission: any;
  animationState1 = 'out';
  public edit: any;
  public type: any;
  @HostListener("window:beforeunoad", ["$event"]) unloadHandler(event: Event) {
    if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
    }
  }
  openonlyRenewal: boolean;
  constructor(private fb: FormBuilder,
    private localstorage: AppLocalStorageServices,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private dialog: MatDialog,
    private security: Encrypt,
    public router:Router,
    private cookieService: CookieService,
    private accSettingsService: AccountsettingsService, public routeid: ActivatedRoute, public toastr: ToastrService) { }

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr" 

    ngAfterViewInit() {
      setInterval(() => this.transFun(), 100)
    }
    transFun(){
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
    }
  ngOnInit() {
    if (localStorage.getItem('v3logindata') == null) {
      this.router.navigate(['/admin/login'])
    }
   /*  if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } */
    this.remoteService.getLanguageCookie().subscribe(data => {
      console.log('test tespsdfsd dsfsdrap Prabu')
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
    if(this.lusrtpye == 'U'){
        this.useraccess = this.localstorage.getInLocal('uerpermission');
    } 
    this.stakeHolderType = this.localstorage.getInLocal('reg_type');
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
    });
    this.companyPk = this.localstorage.getInLocal('companyPk');
    this.companytype = this.localstorage.getInLocal('reg_type');
    this.industryType = this.localstorage.getInLocal('industryType');
    this.buyerId = this.localstorage.getInLocal('buyerId');
    this.isForRenewal = window.history.state.openRenewal;
    this.projectName = this.localstorage.getInLocal('projectName');
    this.RegisteredOn = this.localstorage.getInLocal('RegisteredOn');
    this.MRM_ValSubStatus = this.localstorage.getInLocal('MRM_ValSubStatus');
    this.mcm_RegistrationNo = this.localstorage.getInLocal('mcm_RegistrationNo');
    this.MRM_RenewalStatus = this.localstorage.getInLocal('MRM_RenewalStatus');
    this.supplierId = this.localstorage.getInLocal('supplierId');
    this.UserCreatedOn = this.localstorage.getInLocal('UserCreatedOn');
    this.focalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.filemstPk = this.focalpoint == 1 ? 8 : 10; // 10 - user file mst reference
    this.accountsettingForm = this.fb.group({
      upload: [null, Validators.required],
    });
    this.drv_logo = {
      fileMstPk: this.filemstPk,
      selectedFilesPk: []
    }
   
    this.isGraceExpired = (this.MRM_RenewalStatus=='I' || this.MRM_RenewalStatus=='GE') ? true : false;
    this.disableSubmitButton = true;
    this.getaccousettingsData();
    setTimeout(() => {
      this.text = false;
    }, 500);
   

  }

  getaccousettingsData()
  {
    this.accSettingsService.accountsettingsdata(this.editdata).subscribe(data => {
      this.accSettingsData = data['data'];
      console.log(this.accSettingsData);
      let primaryContactData = this.accSettingsData.primaryContact;
      this.userType = primaryContactData?.usertype;
      let username = primaryContactData.firstname + ' ' + primaryContactData.lastname;
      let useremail = primaryContactData.emailid;
      
      this.drv_logo.selectedFilesPk = this.focalpoint == 1 ? this.accSettingsData.logo :  this.accSettingsData.userdp;
      this.contactusData = { companyname: this.accSettingsData.companyName, username: username, useremail: useremail, subject:''};
      this.disableSubmitButton = false; 
      console.log(this.drv_logo);
    })
    this.viewinvoice();
    // this.editor();
  }
  

  initfunctions()
  {
    if(this.selectedtab != 0)
    {
      console.log('fsd')
      // this.twofactorauthtab.resetall();
    }
  }

  fileeSelected(file, fileId) {
  
    fileId.selectedFilesPk = file;
    this.accSettingsService.saveLogo(file).subscribe(data => {
      if (data['data'].status == 1) {
        console.log("Logo updated successfully");
      }
    })
  }

  deleteLogo(event: any) {
      swal({
        title: this.i18n('uploadfile.doyouimage'),
        // text: 'You can still recover the file from the JSRS drive.',
        icon: "warning",
        buttons: [this.i18n('uploadfile.cancle'), this.i18n('uploadfile.ok')],
        dangerMode: true,
        // className: "swal-delete",
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willDelete) => {
        if (willDelete) {
          this.accSettingsService.saveLogo([]).subscribe(data => {
            if (data['data'].status == 1) {
              this.drv_logo.selectedFilesPk = [];
              window.location.reload();
              this.toastr.success(this.i18n('uploadfile.imgdele'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
            }
          })

        }
      })
    }
  

  showSuccess() {
    this.toastr.success(this.i18n('accsettinglandingpage.delesucc'), '', {
      timeOut: 3000,
      closeButton: true,
    });
  }

  checkfile(files,key)
  {
    this.disableSubmitButton = true;
    let value = JSON.stringify(files[0]);
    console.log(value);
    this.accSettingsService.saveUserDp(value).subscribe(res => {
      if(res.success)
      {
        this.getaccousettingsData();
      }
    })
  }

  removeDp()
  { 
    this.disableSubmitButton = true;
    this.accSettingsService.removeDp().subscribe(res => {
      if(res.success)
      {
        this.getaccousettingsData();
      }
    })
  }

  openDialog(): void {
    let dialogRef = this.dialog.open(Successdialog, {
      disableClose: true,
      panelClass: 'changeuserloaderview'
    });

    dialogRef.afterClosed().subscribe(result => {

    });
  }
  viewinvoice() {
    this.routeid.queryParams.subscribe(params => {
      this.edit = this.security.decrypt(params['id']);
      this.type = this.security.decrypt(params['type']);
    });
   }
  
  editor() {
    if(this.edit == 3) {
      // console.log(1234)
      this.router.navigate(['/accountsettings/twofactorauth'] ,{ queryParams: { id:  this.security.encrypt(1) ,type:  this.security.encrypt(this.type)}});
      } else {
        this.router.navigate(['/accountsettings/twofactorauth']);
        // console.log(12345)

      }
  }
  //[routerLink]="'/accountsettings/twofactorauth'"
}
