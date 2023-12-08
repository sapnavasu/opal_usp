import { Component, OnInit, Inject, Output, EventEmitter, ChangeDetectorRef, ViewChild } from '@angular/core';
import { PerfectScrollbarConfigInterface } from 'ngx-perfect-scrollbar';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '@env/environment';
import { DOCUMENT } from '@angular/common';
import {TranslateService} from '@ngx-translate/core';
import { SharedService } from '@shared/shared.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatTabGroup } from '@angular/material/tabs';
import { Encrypt } from '@app/common/class/encrypt';
import { Successdialog } from '@app/@shared/modal/successdialog';
import { MatDialog } from '@angular/material/dialog';
import {ViewEncapsulation } from '@angular/core';
import {FormGroup,FormControl} from '@angular/forms';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-superadminheader',
  templateUrl: './superadminheader.component.html',
  styleUrls: ['./superadminheader.component.scss'],
  encapsulation: ViewEncapsulation.None,
})

export class SuperadminheaderComponent {
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
 panel = 1;
 selectedli = 'byuser';
  animationState = 'out';
  public showhidemegamenu = true;
  public config: PerfectScrollbarConfigInterface = {};
  public postUrl: any;
  public postParams: any;
  public stakeholderDropDown: any;
  public investorstatus: any;
  public stakeHolderPk: any;
  public stakeHolderType: any;
  public industryType: any;
  public usertype: any;
  public buyerId: any;
  public supplierId: any;
  public companyname: any;
  public designation: any = '';
  public logo_url: any;
  public user_name: any;
  public user_logo_url: any;
  @Output() stakeholderDropDownPk = new EventEmitter<number>();
  @ViewChild('megamenutab')megamenutab: MatTabGroup;
  public jsrsstatus:any;
  public mcm_RegistrationNo:any;
  public mcpbutton:boolean = false;
  public profilebutton:boolean = false;
  public accsettbutton:boolean = false;
  public MRM_MemberStatus:any;
  public MRM_OrderConfrmStat:any;
  public MRM_AFVPStatus:any;
  public lusrtpye:any=null;

  
  fullscreen = true;
  CountryMst_Pk = 31;
    elem: any;
  // This is for Notifications
  // tslint:disable-next-line - Disables all
  notifications: Object[] = [
    {
    round: 'round-danger',
    icon: 'ti-link',
      title: 'Launch Admin',
    subject: 'Just see the my new admin!',
      time: '9:30 AM',
    },
    {
    round: 'round-success',
    icon: 'ti-calendar',
    title: 'Event today',
    subject: 'Just a reminder that you have event',
      time: '9:10 AM',
    },
    {
    round: 'round-info',
    icon: 'ti-settings',
    title: 'Settings',
    subject: 'You can customize this template as you want',
      time: '9:08 AM',
    },
    {
    round: 'round-primary',
    icon: 'ti-user',
    title: 'Pavan kumar',
    subject: 'Just see the my admin!',
      time: '9:00 AM',
    },
  ];

  // This is for Mymessages
  // tslint:disable-next-line - Disables all
  mymessages: Object[] = [
    {
    useravatar: 'assets/images/users/1.jpg',
    status: 'online',
    from: 'Pavan kumar',
    subject: 'Just see the my admin!',
      time: '9:30 AM',
    },
    {
    useravatar: 'assets/images/users/2.jpg',
    status: 'busy',
    from: 'Sonu Nigam',
    subject: 'I have sung a song! See you at',
      time: '9:10 AM',
    },
    {
    useravatar: 'assets/images/users/2.jpg',
    status: 'away',
    from: 'Arijit Sinh',
    subject: 'I am a singer!',
      time: '9:08 AM',
    },
    {
    useravatar: 'assets/images/users/4.jpg',
    status: 'offline',
    from: 'Pavan kumar',
    subject: 'Just see the my admin!',
     time: '9:00 AM',
    },
  ];
    public selectedLanguage: any = {
    language: 'English',
    code: 'en',
    type: 'US',
    icon: 'us',
  };
      public languages: any[] = [
    {
      language: 'English',
      code: 'en',
      type: 'US',
      icon: 'us',
    },
    {
      language: 'Arabic',
      code: 'ar',
      icon: 'ar',
    },
    {
      language: 'Français',
      code: 'fr',
      icon: 'fr',
    },
    {
      language: 'German',
      code: 'de',
      icon: 'de',
    },
  ];
  tooltipType: boolean;
  userpk: any;
  useraccess: any;
  isadmin: any;
  companylogo: any;
  constructor(
    private localstorageservice: AppLocalStorageServices,
    public translate: TranslateService,
    private router: Router,
    private http: HttpClient,
    @Inject(DOCUMENT) private document: any,
    private shared: SharedService,
    private security: Encrypt,
    public changeDetector: ChangeDetectorRef,
    private dialog: MatDialog,
    private cookieService: CookieService,
    private remoteService: RemoteService,
    public toastr: ToastrService,
    private localstorage: AppLocalStorageServices
  ) {
      translate.setDefaultLang('en');
      this.companylogo = this.localstorageservice.getInLocal('companylogo');
     }

  myFormGroup: FormGroup;
  language_code_flag: number = 1;
  setLanguageFlag(value) {        
      this.language_code_flag = value;    
      const now = new Date(); 
      this.cookieService.set('languageCookie', value.dir); 
  }
  ngOnInit() {

    this.lusrtpye = this.localstorage.getInLocal('usertype');
    this.companylogo = this.localstorageservice.getInLocal('companylogo');
    this.elem = document.documentElement;
    this.stakeHolderPk = this.localstorageservice.getInLocal('reg_type');
    this.stakeHolderType = this.localstorageservice.getInLocal('omrm_stkholdertypmst_fk');
    
    this.industryType = this.localstorageservice.getInLocal('industryType');
    this.usertype = this.localstorageservice.getInLocal('usertype');   
    if(this.usertype == 'U'){
      this.useraccess = this.localstorageservice.getInLocal('uerpermission');
    } 
    this.companyname = this.localstorageservice.getInLocal('companyname');
    this.designation = this.localstorageservice.getInLocal('designation');
    this.logo_url = this.localstorageservice.getInLocal('logo_url');
    this.user_logo_url = this.localstorageservice.getInLocal('user_logo_url');
    this.user_name = this.localstorageservice.getInLocal('user_name');
    this.userpk = this.localstorageservice.getInLocal('userPk');
    this.isadmin = this.localstorageservice.getInLocal('isadmin');
    
    this.postUrl = 'acm/stkholderaccessmaster/getstkholdertypes';
    this.postParams = {
    };
    this.shared.getStakeholder(this.postParams, this.postUrl).subscribe(data => {
      this.stakeholderDropDown = data.data;
    });
    // this.getStakeholderstatus();
    this.myFormGroup = new FormGroup({
      language: new FormControl('')
    });
  
    this.CountryMst_Pk = 31;
    if(this.localstorageservice.getInLocal('MRM_RenewalStatus')=='D' && (parseInt(this.localstorageservice.getInLocal('expdays')) > parseInt(this.localstorageservice.getInLocal('graceperiod')))){
      this.mcpbutton = true;
      this.profilebutton = true;
      this.accsettbutton = true;
    }else if(this.localstorageservice.getInLocal('MRM_RenewalStatus')=='RW' && (parseInt(this.localstorageservice.getInLocal('expdays')) > parseInt(this.localstorageservice.getInLocal('inactivationperiod')))){
      this.mcpbutton = true;
      this.profilebutton = true;
      this.accsettbutton = false;
    }else if(this.localstorageservice.getInLocal('MRM_RenewalStatus')=='RW' && (parseInt(this.localstorageservice.getInLocal('expdays')) > parseInt(this.localstorageservice.getInLocal('graceperiod')))){
      this.mcpbutton = true;
      this.profilebutton = true;
      this.accsettbutton = false;
    }else if(this.localstorageservice.getInLocal('MRM_RenewalStatus')=='I'){
      this.mcpbutton = true;
      this.profilebutton = true;
      this.accsettbutton = false;
    }else if(this.localstorageservice.getInLocal('MRM_RenewalStatus')=='GE'){
      this.mcpbutton = true;
      this.profilebutton = true;
      this.accsettbutton = false;
    }else{
      this.mcpbutton = false;
      this.profilebutton = false;
      this.accsettbutton = false;
    }

    this.remoteService.getShowtooltipCookie().subscribe(data => {
      
      if(data == 'true')
      this.tooltipType = true;
      else
      this.tooltipType = false;
    });
  }
  setOpen(i: any) {
    this.panel = i;
}
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentmegamenu') {
	    this.showhidemegamenu = false;
     this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  getStakeholderstatus(): any {
    this.shared.getStakeholderstatus().subscribe(data => {
      this.investorstatus = data.data[0].status;
    });
  }
  openFullscreen() {
    if (this.fullscreen == true) {
        if (this.elem.requestFullscreen) {
          this.elem.requestFullscreen();
        } else if (this.elem.mozRequestFullScreen) {
          /* Firefox */
          this.elem.mozRequestFullScreen();
        } else if (this.elem.webkitRequestFullscreen) {
          /* Chrome, Safari and Opera */
          this.elem.webkitRequestFullscreen();
        } else if (this.elem.msRequestFullscreen) {
          /* IE/Edge */
          this.elem.msRequestFullscreen();
        }
        this.fullscreen = false;
    } else if (this.fullscreen == false) {
      if (this.document.exitFullscreen) {
        this.document.exitFullscreen();
      } else if (this.document.mozCancelFullScreen) {
        /* Firefox */
        this.document.mozCancelFullScreen();
      } else if (this.document.webkitExitFullscreen) {
        /* Chrome, Safari and Opera */
        this.document.webkitExitFullscreen();
      } else if (this.document.msExitFullscreen) {
        /* IE/Edge */
        this.document.msExitFullscreen();
      }
      this.fullscreen = true;
    }
  }
  logout() {


    if (localStorage.getItem('v3logindata') !== null) {
      const href = environment.baseUrl + 'pm/profile/logout';
      const userpk = { id: this.security.encrypt(this.localstorageservice.getInLocal('opalusermst_pk')) };
      return this.http.post(href, userpk).subscribe(data => {
        localStorage.removeItem('uerpermission');
        localStorage.removeItem('v3logindata');
        localStorage.removeItem('mobileverified');
        localStorage.removeItem('v3logindatarefresh');
        this.router.navigate(['admin/login']);
      });

    }
  }
  chkUserPermission(){

    if ((this.lusrtpye == 'A')|| (this.stakeHolderType == 1) || this.lusrtpye == 'U' && this.useraccess[257] &&  this.useraccess[257].read == 'Y' || this.useraccess[235] &&  this.useraccess[235].read == 'Y' ) {
      this.router.navigate(['/accountsettings']);
    }else{
      this.toastr.warning('You don\'t have permission to access', 'Warning !', {
        timeOut: 3000,
        closeButton: true,
      });
     
    }


  }

  openDialog(): void {
    let dialogRef = this.dialog.open(Successdialog,{
      disableClose:true,
      panelClass: 'changeuserloaderview'
    });

    dialogRef.afterClosed().subscribe(result => {
      
    });
  }
  changeMenuByStkholder(event: any) {
    this.stakeholderDropDownPk.emit(event.target.value);
  }

  navigationUsrClose(event: any) {
      this.animationState = 'out';
  }
  mcpcheck(){
    if((this.usertype == 'A') || (this.usertype == 'U' && this.useraccess[182] && this.useraccess[182].read == 'Y')){
      this.router.navigate(['profilemanagement/landingpage']);
    }
    else{
      this.security.userpermissionpop();
    }
  }
  profile(){
    if((this.usertype == 'A') || (this.usertype == 'U' && this.useraccess[184] && this.useraccess[184].view == 'Y')){
      alert('Haiyya jolly');
    }
    else{
      this.security.userpermissionpop();
    }
  }

  changePassword(){
    this.router.navigate(['accountsettings/changebackend']);
  }
    changeLanguage(lang: any): void {
    this.translate.use(lang.code);
    this.selectedLanguage = lang;
  }
}
