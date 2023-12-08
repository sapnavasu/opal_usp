import { Component, EventEmitter, Input, OnInit, Output, SimpleChanges, ViewChild, ViewEncapsulation } from '@angular/core';
// import { Successdialog } from '../modal/successdialog';
import { FormBuilder, FormGroup } from '@angular/forms';
import { MatDialog } from '@angular/material/dialog';
import { MatDrawer } from '@angular/material/sidenav';
import { Router } from '@angular/router';
import { Successdialog } from '@app/@shared/modal/successdialog';
import { UserallocationComponent } from '@app/@shared/sidepanel/userallocation/userallocation.component';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { AddusersidenavComponent } from '@app/modules/enterpriseadmin/addusersidenav/addusersidenav.component';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from 'ngx-toastr';
import swal from 'sweetalert';
import { AccountsettingsService } from '../accountsettings.service';



@Component({
  selector: 'app-securitydetail',
  templateUrl: './securitydetail.component.html',
  styleUrls: ['./securitydetail.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SecuritydetailComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  disableSendOTPButton: boolean = false;
  @Input() userType: any;
  @Input() settingsData: any = [];
  @Input() companytype: any;
  @Input() isGraceExpired: boolean;
  @Output('showLoader') showLoader: any = new EventEmitter<any>();
  public accountsettingForm: FormGroup;
  animationState: string = "out";
  @ViewChild('drawer') drawer: MatDrawer;
  @ViewChild('viewpermissionsidenav') viewpermissionsidenav: MatDrawer;
  @ViewChild('drawer2') drawer2: MatDrawer;
  @ViewChild('addUpdateAccess') addUpdateAccess: UserallocationComponent;
  @ViewChild('draweruserallocation') draweruserallocation: MatDrawer;
  contentObj: any = {
    sideNavHeading: 'Select User',
    firstTabSubmitButtonName: 'Map',
    secondTabSubmitButtonName: 'Add',
    infoIconText: 'Transfer your Admin roles and rights in OPAL to another user of your Company.',
    firstTabSubText: 'Map an existing user for the OPAL admin role.',
    secondTabSubText: 'Add new user for the OPAL admin role.',
    clearText: 'Clear'
  }
  ischangeadmin: any;
  public triggercountryser:number =1;
  @ViewChild('draweraddinguser') draweraddinguser: MatDrawer;
  @ViewChild('addUpdateUserRef') addUpdateUserRef:AddusersidenavComponent;
  public addUserFromType:number = 1;
  public userPermission: any = [];
  stakeHolderType: any;
  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private fb: FormBuilder, private dialog: MatDialog, private accSettingsService: AccountsettingsService,
    private profileService: ProfileService, private router: Router, public toastr: ToastrService, public encrypt: Encrypt) { }
     public lusrtpye:any=null;
  public useraccess:any;
  
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr"

  ngOnInit() {
    this.stakeHolderType = this.localstorage.getInLocal('reg_type');
    
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      // if(toSelect.languagecode == 'en'){
      //   this.addUpdateUserRef.addUpdateText='Update';
      // }
      // else {
      //   this.addUpdateUserRef.addUpdateText='Update';
      // }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      // this.addUpdateUserRef.addUpdateText='Update';
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        // if(toSelect.languagecode == 'en'){
        //   this.addUpdateUserRef.addUpdateText='Update';
        // }
        // else {
        //   this.addUpdateUserRef.addUpdateText='Update';
        // }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        // this.addUpdateUserRef.addUpdateText='Update';
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
  }
  
  public ngOnChanges(changes: SimpleChanges) {
    if (this.settingsData && this.settingsData.primaryContact && this.settingsData.primaryContact.ischangeuser !== undefined) {
      this.ischangeadmin = this.settingsData.primaryContact.ischangeuser;      
    }
  }
  get f() { return this.accountsettingForm.controls; }

  openDialog(): void {
    let dialogRef = this.dialog.open(Successdialog, {
      disableClose: true,
      panelClass: 'changeuserloaderview'
    });

    dialogRef.afterClosed().subscribe(result => {

    });
  }

  toggleShowDiv(divName: string) {
    if (divName === "descriptioncontent") {
      this.animationState = this.animationState === "out" ? "in" : "out";
    }
  }


  clear() {
   
  }

  showSweetAlert() {
    this.animationState = "out";
  
  }
  showLoaderOutput(event) {
    this.showLoader.emit(event);
  }
  public avoidmultiv: boolean = false;
  public viewpermission: boolean = false;
  getuserpermissiondet(userper) {
    this.showLoader.emit(true);
    this.avoidmultiv = false;
    this.viewpermission = true;
    setTimeout(() => {                           // <<<---using ()=> syntax
      this.addUpdateAccess.userAccessview(userper);
    }, 100);

  }
  avoidmulti() {
    this.avoidmultiv = true;
    this.viewpermission = false;
  }
  userPermData(event) {
    let userPermission = event;
  }
  editUser(userPk){
   
  }
  showSuccess() {
    this.toastr.success(this.i18n('accountdetails.everisbrok'), this.i18n('accountdetails.succ'), {
      timeOut: 3000,
      closeButton: true,
    });
  }

  reload(event){
    if(event){
      this.accSettingsService.accountsettingsdata(event).subscribe(data => {
        this.settingsData = data['data'];
      });
   }
  }
}

