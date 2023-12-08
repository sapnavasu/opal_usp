import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators,} from '@angular/forms';
import { AccountsettingsService } from '@app/modules/accountsettings/accountsettings.service';
import { AdminService } from '@app/auth/admin.service';
import { ErrorStateMatcher } from '@angular/material/core';
import { ConditionalExpr } from '@angular/compiler';
import { discardElement } from 'highcharts';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
@Component({
  selector: 'app-approvechange',
  templateUrl: './approvechange.component.html',
  styleUrls: ['./approvechange.component.scss'],
  providers:[AccountsettingsService, AdminService]
})
export class ApprovechangeComponent implements OnInit {
  currentyear: number = new Date().getFullYear();
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  createspecifys: string[] = ['We are not looking for business opportunities in Oman.', 'We are out of business at the moment.', 'The JSRS Certification fee is too expensive.', 'Others'];
  otherspecify:any;
  public adminPks: any = {};
  isAuthorized: boolean = false;
  isExpired: boolean = false;
  RegistercancelledForm: FormGroup;
  newUser: any;
  pageStatus: string
  pageFor: string;
  setPasswordLink: string;
  cancelcmt: string;
  willingon: any;
  public initSpinner: boolean = false;
  changetype: any;
  oldUser: any;
  constructor(private activatedRoute: ActivatedRoute,
    private accSettingsService: AccountsettingsService,
     private adminService: AdminService,
      private router: Router,
      private fb: FormBuilder,
      private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    ) { }
    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
dir = 'ltr';
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
        //this.patientCategory.get('patientCategory').setValue(toSelect);
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.RegistercancelledForm = this.fb.group({
      pleasespecify: ['', null],
      canceldata: ['', Validators.required],
      termsandcondition: ['', null],
    });
    
    this.activatedRoute.queryParams.subscribe(params => {
      
      if(params.type === 'accept' || params.type === 'cancel') {
        this.pageFor = 'accept_cancel_reg';
        let type = params.type;
        let regPk = params.reg_pk;
        let cancelcmt = '';
        let willingon = '';
        if(params.type === 'accept' || params.type === 'cancel'){
          this.adminService.acceptOrCancelReg(type,regPk,cancelcmt,willingon).subscribe(data => {
              this.pageStatus = data['data'].msg;
              this.setPasswordLink = data['data'].setpassword;
          });
        }
      } else {
        this.initSpinner = true;
        this.pageFor = 'change_user_authorise';
        this.adminPks['currentAdminPk'] = params.c;
        this.adminPks['newAdminPk'] = params.n;
        this.adminPks['t'] = params.t;
        this.adminPks['catype'] = params.catype;
        this.authorizeChangeUser();
      }
    });

  }

  lang = '1';
  setLanguageFlag(value) {
    this.lang = value == '1' ? '2' : '1';
    const toSelect = this.languagelist.find(c => c.id === this.lang);
    this.cookieService.set('languageCookieId', toSelect.id);
    this.cookieService.set('languageCode', toSelect.languagecode);
    this.cookieService.set('dir', toSelect.dir);
    this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    this.remoteService.languageCookieValue(toSelect);
  }
  redirectToSetPassword() {
    window.location.href = this.setPasswordLink;
  }

  navigateToLogin() {
    this.router.navigate(['/admin/login']);
  }

  authorizeChangeUser() {
    this.accSettingsService.changeAuthorizeUser(this.adminPks).subscribe(data => {
      this.isAuthorized = false;
      this.isExpired = false;  
      if (data['data'].status == 1) {
        this.isAuthorized = true;
        this.isExpired = false;
        this.changetype = data['data'].type;
        this.oldUser = data['data'].oldUser;
        this.newUser = data['data'].newUser;
        this.initSpinner = false;
      } else if (data['data'].status == 2) {
        this.isExpired = true;
        this.isAuthorized = false;
        this.initSpinner = false;
      }
    });
  }
  cancelRegistration(){
    this.activatedRoute.queryParams.subscribe(params => {
      if(params.type === 'cancel') {
        this.initSpinner = true;
        this.pageFor = 'accept_cancel_reg';
        let type = params.type;
        let regPk = params.reg_pk;
        if(this.RegistercancelledForm.value.canceldata == 'Other, please specify'){
          this.cancelcmt = this.RegistercancelledForm.value.pleasespecify;
        } else {
          this.cancelcmt = this.RegistercancelledForm.value.canceldata;
        }
        if(this.RegistercancelledForm.value.termsandcondition){
          this.willingon = '1';
        } else {
          this.willingon = '';
        }        
        if (this.RegistercancelledForm.valid) {
          this.adminService.acceptOrCancelReg(type,regPk, this.cancelcmt, this.willingon).subscribe(data => {
              this.pageStatus = data['data'].msg;
              this.setPasswordLink = data['data'].setpassword;
              this.initSpinner = false;
          });
        } else {
          this.initSpinner = false;
        }
      } 
    });
  }
  radioChange(){
    if(this.RegistercancelledForm.controls['canceldata'].value=='Other, please specify'){
      this.RegistercancelledForm.controls['pleasespecify'].setValidators([Validators.required]);
      this.RegistercancelledForm.controls['pleasespecify'].updateValueAndValidity();
    }else{
      this.RegistercancelledForm.controls['pleasespecify'].setValidators(null);
      this.RegistercancelledForm.controls['pleasespecify'].updateValueAndValidity();
    }
  }
}

