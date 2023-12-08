import { Component, ElementRef, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { AfterloginModule } from '@app/modules/afterlogin/afterlogin.module';
// import { ConsoleReporter } from 'jasmine';
import * as jwtDecode from 'jwt-decode';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { OwlOptions } from 'ngx-owl-carousel-o';
import { Observable, Subscription } from 'rxjs';
import Keyboard from 'simple-keyboard';
import { Encrypt } from '../common/class/encrypt';
import { BgiJsonconfigServices } from '../config/BGIConfig/bgi-jsonconfig-services';
import { AdminService } from './admin.service';
import { AuthService } from './auth.service';
import { VirtualKeyboardComponent } from './virtual-keyboard/virtual-keyboard.component';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { RegistrationService } from '@app/modules/registration/registration.service';
import {ErrorStateMatcher} from '@angular/material/core';
import { formatDate } from '@angular/common';
import { ApplicationService } from '@app/services/application.service';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: [
    './login.component.scss',
    // '.../node_modules/simple-keyboard/build/css/index.css'
  ],
  encapsulation:ViewEncapsulation.None
})
export class LoginComponent implements OnInit {
  userAddressValidations: FormGroup;
  currentyear: number = new Date().getFullYear();
  public showLoader: boolean = false;
  @ViewChild('vk') vk: VirtualKeyboardComponent;
  @ViewChild('vk1') vk1: VirtualKeyboardComponent;
  public projectName: string;
  value = '';
  keyboard: Keyboard;
  showKeyboard = false;
  customOptions: OwlOptions = {
    loop: false,
    // autoplay:true,
    // autoplayTimeout:10000,
    // autoplayHoverPause:true,
    mouseDrag: false,
    touchDrag: true,
    pullDrag: false,
    center: true,
    margin: 0,
    autoWidth: true,
    autoHeight: true,
    items: 1,
    dots: true,
    navSpeed: 1000,
    nav: false
  };

  @Input() name: string;
  loginTemplate = 'contactus';
  loginInnerTemplate = 'usernameshow';
  forgotTemplate = 'getemail';
  public loginForm: FormGroup;
  public OTPform: FormGroup;
  public forgotForm: FormGroup;
  public setpasswordForm: FormGroup;
  public isInputTextType = false;
  public alljson: any;
  public forgotMail: FormControl = new FormControl('', Validators.required);
  public loginOtp: FormControl = new FormControl('', Validators.required);
  public showCountDown = false;
  public attemptCount: number;
  public fgtemailID: string;
  public stopTimer: Subscription;
  public otptimer: Subscription;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  public countDown: any = '00:00';
  public suppOrg: any;
  public lgnpk:any;
  public a:Date;
  public b:Date;
  public memReg: any;
  logincountdown: number = this.bgiConfigJson.fgtMailResendDurationSeconds;
  spinnerButtonOptions: MatProgressButtonOptions = {
    active: false,
    text: 'Next',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,    
    mode: 'indeterminate',
  };

  spinnerButtonOptionsForgrt: MatProgressButtonOptions = {
    active: false,
    text: 'Submit',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  
  spinnerButtonOptionsotp: MatProgressButtonOptions = {
    active: false,
    text: 'Next',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };

  spinnerButtonOptionsLogin: MatProgressButtonOptions = {
    active: false,
    text: 'Login',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  enableloginbtn: boolean = true;
  validusermismatch = false;
  disableResend = true;
  encryptedUserID: any;
  OTPControl: FormControl = new FormControl('', Validators.compose([Validators.required, Validators.minLength(4)]));
  wrongAttemptLeftCount: any;
  hasAfterLogin: boolean;
  afterloginParams: object;
  passwordpageshow: boolean = false;
  chooseaccount: boolean = false;
  usernameshow: boolean = true;
  userslist: any;
  userlogindata: any;
  logincountdowns: string;
  resultafterlogin: any;
  emailaccountlist: any;
  public userpk: any;
  pk: any;
  setpassdtls: any;
  forgettitle: string = "Reset password";
  linktype: string = 'reset';
  showid: any;
  otptype: string;
  forgtdata: any;
  lastattempt: number = 0;
  disablesubmit: boolean = false;
  countrycode: any = 31;
  lgnemailid:any;
  timersec: any;
  maskemail:any;
  countDown1: string;
  user_pk:any;
  focalpoint: any;
	userdatalist =[];
	registertype: any;
  title: string = 'OPAL - Set Password';
  oum_projectmst_fk: any;
  projectpk: number;

	constructor(private fb: FormBuilder,
    private formBuilder: FormBuilder,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private adminservice: AdminService,
    protected regService: RegistrationService,
    private auth: AuthService,
    private router: Router,
    private route: ActivatedRoute,
    private el: ElementRef,
    private recaptchaV3Service: ReCaptchaV3Service,
    private localStorage: AppLocalStorageServices,
    private appservice : ApplicationService,
    private secuirty: Encrypt, private titleService: Title,) {
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr"

  openuserKeyboard() {

    this.vk.showKeyboard = !this.vk.showKeyboard;
    this.vk.initializeKeyboard();

    if (this.vk.showKeyboard) {
      this.vk1.showKeyboard = false;
    }
  }
  openpasswordKeyboard() {

    this.vk1.showKeyboard = !this.vk1.showKeyboard;
    this.vk1.initializeKeyboard();

    if (this.vk1.showKeyboard) {
      this.vk.showKeyboard = false;
    }
  }
  chooseanotheraccount() {
    this.loginInnerTemplate = 'chooseaccountshow';
    this.loginForm.controls.password.reset();
    this.loginForm.controls.accountselected.reset();
    this.loginForm.controls.stktype.reset();
  }
  resetback() {
    this.loginForm.controls.password.reset();
  }

  get userNameControl() {
    return this.loginForm.controls.username;
  }
  get passwordControl() {
    return this.loginForm.controls['password'];
  }
  set username(uesrname: any) {
    this.loginForm.controls.username.setValue(uesrname);
  }
  public pid: any;
  public scfid: any;
  public rfxid: any;
  public rfxtype: any;
  public compid: any;
  public valid: any;
  public afterloginpage: string = null;
  public noticePk: string;


  ngOnInit() {
    this.userAddressValidations = this.formBuilder.group({
      email: ['', [Validators.required, Validators.minLength(4), Validators.maxLength(20), Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]]
    });
    this.route.queryParams.subscribe(params => {
      this.pid = params['pid'];
      this.scfid = params['scfid'];
      this.rfxid = params['rfxid'];
      this.rfxtype = params['rfxtype'];
      this.compid = params['compid'];
      this.valid = params['valid'];
      this.afterloginpage = params['afterlogin'];
      this.noticePk = params['noticePk'];
      let islogindata = localStorage.getItem('v3logindata') != null ? 1 : 2;
      if(this.afterloginpage && this.afterloginpage != null && this.afterloginpage != undefined && islogindata == 1){
        this.showLoader = true;
        if(this.afterloginpage == "MAILLOGIN"){   
          if(this.localStorage.getInLocal('reg_type') == 1){
            this.router.navigate(['/regapproval/registeredstakeholder']);
            return false;
          }else if (this.localStorage.getInLocal('reg_type') == 6){
            this.router.navigate(['/cert/scdash/dashboard']);
            return false;
          }else{
            this.router.navigate(['/cert/oissrdash/dashboard']);
            return false;
          }    
        }else if(this.afterloginpage == "LOGINBACKEND"){
          if(this.localStorage.getInLocal('reg_type') == 1){
            this.router.navigate(['/regapproval/registeredstakeholder']);
            return false;
          }else{
            this.router.navigate(['/dashboard/centre']);
            return false;
          }      
        }
      } /* else{
        window.history.replaceState({}, document.URL, '/admin/login');
      }  */
    });    
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.spinnerButtonOptions.text = 'Next';
        this.spinnerButtonOptionsForgrt.text = 'Submit';
        this.spinnerButtonOptionsotp.text = 'Next',
      this.spinnerButtonOptionsLogin.text = "LOGIN";

      } else {
        this.spinnerButtonOptions.text = 'التالي';
        this.spinnerButtonOptionsForgrt.text = 'إرسال';
        this.spinnerButtonOptionsotp.text = 'التالي';
        this.spinnerButtonOptionsLogin.text = "تسجيل الدخول";
      }

    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.cookieService.set('languageCookieId', toSelect.id);
      this.cookieService.set('languageCode', toSelect.languagecode);
      this.cookieService.set('dir', toSelect.dir);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.remoteService.languageCookieValue(toSelect);
      this.spinnerButtonOptions.text = 'Next';
      this.spinnerButtonOptionsForgrt.text = 'Submit';
      this.spinnerButtonOptionsotp.text = 'Next';
      this.spinnerButtonOptionsLogin.text = "LOGIN";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        console.log('this.translate=>',this.translate)
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.spinnerButtonOptions.text = 'Next';
          this.spinnerButtonOptionsForgrt.text = 'Submit';
          this.spinnerButtonOptionsotp.text = 'Next';
          this.spinnerButtonOptionsLogin.text = "LOGIN";
        } else {
          this.spinnerButtonOptions.text = 'التالي';
          this.spinnerButtonOptionsForgrt.text = 'إرسال';
          this.spinnerButtonOptionsotp.text = 'التالي';
          this.spinnerButtonOptionsLogin.text = "تسجيل الدخول";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.spinnerButtonOptions.text = 'Next';  
        this.spinnerButtonOptionsForgrt.text = 'Submit';
        this.spinnerButtonOptionsotp.text = 'Next';
        this.spinnerButtonOptionsLogin.text = "LOGIN";
      }
    });
   
   /*  if(this.cookieService.get('ipCountryCookie') && this.cookieService.get('ipCountryCookie') != "undefined" && this.cookieService.get('ipCountryCookie') != null && this.cookieService.get('ipCountryCookie') != ''){
       this.countrycode = this.cookieService.get('ipCountryCookie');
    }
    else{
      this.remoteService.getipdetail().subscribe(res => {
        this.regService.getIPdetails(res.country_code).subscribe(data => {
          this.countrycode =  data['data'].dialCode.CountryMst_Pk ;
        this.cookieService.set('ipCountryCookie',this.countrycode ,100,'/');
        });
      });
    } */
    this.projectName = this.bgiConfigJson.projectName;
    this.route.paramMap.pipe((data) => {
      this.loginTemplate = (window.history.state.template) ? window.history.state.template : 'login';
      return Observable.from([]);
    });
    this.loginForm = this.fb.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required]],
      accountselected: ['', ''],
      stktype: ['', ''],
      isdemo: ['', '']
    });
    this.forgotForm = this.fb.group({
      forgotselectaccount: [],
    });

    this.setpasswordForm = this.fb.group({
      newpassword: [null, [Validators.required]],
      confirmpassword: [null, [Validators.required]],
    });

   if (localStorage.getItem('v3logindata') && this.afterloginpage != "MAILLOGIN" && this.afterloginpage != "LOGINBACKEND") {
      localStorage.clear();
      this.router.navigate(['/admin/login']);
    }
    
    this.adminservice.configurjson().subscribe(data => {
      this.alljson = data;
    });

    //afterlogin
    this.route.queryParams.subscribe(params => {
      if (params['afterlogin'] !== undefined) {
        this.hasAfterLogin = true;
        this.afterloginParams = params;
      }
    });   

    this.title = 'OPAL - Login' ;
    this.titleService.setTitle(this.title);
  }

  ngAfterViewInit(){
    this.route.queryParams.subscribe(params => {  
      if(params['fpval'] == 'forgot'){
        this.checkinter1(params['maskmail']);
        this.user_pk = params['pk'];
        this.lgnemailid=params['maill'];
      }
    }) 

  }

  checkinter1(mail) {
    // if (this.userlogindata.mobileorigin == 'N') {

      this.loginTemplate = 'forgot';
      this.enableloginbtn =false;
      this.lgnemailid =mail;
      // console.log(mail)
      this.userAddressValidations.controls['email'].setValue(mail);
      this.userAddressValidations.controls['email'].disable();
    // }
    // else {
      // this.selectedfrgtemailaccount(1);
      // this.loginTemplate = 'resetpassword';
    // }
  }

  onSubmitusername() {
    if (this.loginForm.controls.username.valid) {

      this.vk.showKeyboard = false;
      this.showKeyboard = false;
      this.spinnerButtonOptions.active = true;
      const username = this.loginForm.controls.username.value;
      this.adminservice.getusers(username, 'loginid').subscribe(res => {
        let userdata = res.data['data'];
        if (res.data['flag'] == "SR") {
          this.loginInnerTemplate = 'singlepasswordpageshow';
          this.enableloginbtn = true;
          this.lgnpk=userdata.pk;
          this.user_pk =userdata.pk;
          this.userlogindata = userdata;
          this.linktype = "reset";
          this.lgnemailid =userdata.email;
          this.maskemail = userdata.maskedemail;
          this.loginForm.controls.accountselected.setValue(userdata.pk);
          this.loginForm.controls.stktype.setValue(userdata.stktyppk);
        }
        else if (res.data['flag'] == "MR") {
          this.loginInnerTemplate = 'chooseaccountshow';
          this.userslist = userdata;

        }
        else if (res.data['flag'] == "NR") {
          this.loginInnerTemplate = 'usernameshow';
          this.loginForm.controls['username'].setErrors({ notavailable: true });
        }
        else if (res.data['flag'] == "SP") {
          this.setpassdtls = userdata;
          this.userlogindata = userdata;
          this.user_pk = this.userlogindata.pk;
          this.forgettitle = "Set password";
          this.linktype = "set"
          this.otptype = 'email';
          this.selectedfrgtemailaccountt(userdata.email, this.linktype );
        } else if(res.data['flag'] == "ml"){
          this.loginInnerTemplate = 'accountLink';
          this.userdatalist = res.data['data'];
          this.lgnemailid = this.userdatalist[0]['oum_emailid'];
        }
        this.spinnerButtonOptions.active = false;
      });

    }
  }

  sendSetPassMail(userpk, email) {
    this.showLoader = true;
    this.resettimer();
    this.adminservice.sendForgotMail(email, userpk, this.linktype).subscribe(data => {
      if (data.data.status == 1) {
        this.loginTemplate = 'resetpassword';
        this.attemptCount = data.data.attemptCount;
        this.fgtemailID = data.data.emailID;
        this.timer(data.data.time);
        this.encryptedUserID = data.data.id;
        if (this.attemptCount && this.attemptCount < 3) {
        }
      } else if (data.data.status == 2) {
        this.forgotMail.setErrors({ limitReached: true });
      } else {
        this.forgotMail.setErrors({ invalidEmail: true });
      }
      this.showLoader = false;
    });
  }

  checkinter() {
    // if (this.userlogindata.mobileorigin == 'N') {

      this.loginTemplate = 'forgot';
      this.enableloginbtn =false;
      console.log(this.lgnemailid)
      this.userAddressValidations.controls['email'].setValue(this.maskemail);
      this.userAddressValidations.controls['email'].disable();
    // }
    // else {
      // this.selectedfrgtemailaccount(1);
      // this.loginTemplate = 'resetpassword';
    // }
  }

  redirecttoforgot() {
    this.resettimer();
    if (this.forgettitle == "Set password") {
      this.loginTemplate = 'login';
      return;
    }
    if (this.userlogindata.mobileorigin == 'N') {

      this.loginTemplate = 'forgot';
    }
    else {
      this.loginTemplate = 'login';
      this.loginInnerTemplate = 'singlepasswordpageshow';
     
    }
  }
  selectedfrgtemailaccount(value: any) {
   
    this.disableResend = true; 
    this.showLoader = true;
    this.disablesubmit = true;
    let email = '';
    if (value == 2) {
      this.forgtdata = this.userlogindata.mobile_no;
      this.otptype = 'mobile';
    }
    else {
      // this.forgtdata = this.userlogindata.email;
      this.otptype = 'email';
    }
    this.adminservice.getuserssendemail(this.forgtdata, this.user_pk, this.otptype).subscribe(data => {
      if (data.data.status == 1) {
        if (data.data.msg == 'SR') {

          value = data.data.id;
          email = data.data.email;
          this.sendMail(value, email, this.otptype);

        }
        else {

          value = data.data.id;
          email = data.data.email;
          this.sendMail(value, email, this.otptype);
          this.loginTemplate = 'resetpassword';
        }
      }
      this.disablesubmit = false;
    });
  }
  selectedfrgtemailaccountt(value:any,rest){

    let maiiid =value;
    this.spinnerButtonOptionsForgrt.active = true;
    this.otptype = 'email';
    if(rest == 'reset'){
      this.showLoader =true;
      this.resettimer();
    }
    this.resettimer();
    this.adminservice.getuserssendemail(maiiid, this.user_pk, this.otptype).subscribe(data => {
    
      if(data.data.msg == 'Forgot Mail Sent Successfully'){
        this.loginTemplate = 'otptemplate';
        // this.timer(15);
        var date1 = new Date(data.data.expdate);
        var date2 = new Date();
        var Time = date1.getTime() - date2.getTime();
        var Days = Time / (1000 * 60 ); //Diference in Days.
    
        // this.timer1(Days,date1);
        this.timer(15);
        this.showLoader =false;
      }
    });
  }
  isValidOTP() {
this.spinnerButtonOptionsotp.active = true;
   const pk=this.user_pk;
    this.adminservice.checkValidOTP(pk, this.OTPControl.value, this.otptype).subscribe(data => {
      if (data.data.status == 1) {
        this.resettimer();
        this.disableResend = true;
        this.attemptCount = data.data.frgtattempt;
        if (this.linktype == "set") {
          this.spinnerButtonOptionsotp.active = false;
          this.router.navigate(['/admin/setpassword'], { queryParams: { pk: this.secuirty.encrypt(data.data.userpk), f: data.data.f, t: data.data.t, type: 'set' } });
        }
        else {
          this.spinnerButtonOptionsotp.active = false;
          this.router.navigate(['/admin/setpassword'], { queryParams: { pk: this.secuirty.encrypt(data.data.userpk), f: data.data.f, t: data.data.t, type: 'reset' } });
        }


      } else if (data.data.status == 2) {
        this.attemptCount = data.data.frgtattempt;
        this.OTPControl.setErrors({ invalidOTP: true });
        this.spinnerButtonOptionsotp.active = false;
      } else if (data.data.status == 3) {
        this.spinnerButtonOptionsotp.active = false;
        this.attemptCount = data.data.frgtattempt;
        this.OTPControl.setErrors({ expiredOTP: true });
      }
    });
  }

  sendMail(value: any, email: any, type: any = null) {
    this.showLoader = true;
    this.spinnerButtonOptionsForgrt.active = true;
    let userpk = value;
    this.pk = value;
    this.forgotMail.setErrors(null);
    this.resettimer();
    this.disableResend = true;
    this.adminservice.sendForgotMail(email, userpk, type).subscribe(data => {
      if (data.data.status == 1) {
        this.showLoader = false;
        this.timer(data.data.time);
        
        this.loginTemplate = 'resetpassword';
        this.attemptCount = data.data.attemptCount;
        this.fgtemailID = data.data.emailID;
        this.encryptedUserID = data.data.id;
        if (this.attemptCount && this.attemptCount < 3) {
        
        }
      } else if (data.data.status == 2) {
        this.forgotMail.setErrors({ limitReached: true });
      } else {
        this.forgotMail.setErrors({ invalidEmail: true });
      }
      this.spinnerButtonOptionsForgrt.active = false;
    });
  }    

  resendMail(value) {
    this.resettimer();
    this.showLoader = true; 
    this.disableResend = true;
    let type
    if (value == 'login') {
      this.adminservice.sendLoginOtp(this.encryptedUserID).subscribe(response => {
        if (response.data['status'] == 1) {
          this.lastattempt = this.lastattempt + 1;
          this.loginTemplate = 'otptemplate';
          this.logincountdown = this.logincountdown * response.data['time'];
          this.timer(response.data['time']);
          this.showLoader = false;
        }
        else {
          return false;
        }
      }
      );
    }
    else {
      type = this.otptype;
      this.adminservice.sendForgotMail(this.forgtdata, this.user_pk, type).subscribe(data => {
        this.attemptCount = data.data.attemptCount;
        this.timer(data.data.time);
        this.showLoader = false;
      },
        () => '',
        () => {
          if (this.attemptCount <= 3) {
          } else if (this.attemptCount > 3) {
            this.showCountDown = false;
          }
        });
    }

  }

  resettimer() {
    this.OTPControl.reset();
    this.countDown ='00.00';
    this.disableResend = true;
    this.attemptCount = 0;
    this.lastattempt = 0;
    clearInterval(this.timersec);
  }

  timer1(minutes, time) {
    this.timersec = setInterval(() => {
      var date1 = new Date(time);
      var date2 = new Date();
     
      if (date1.getTime() >= date2.getTime()) { 
        let Days = (date1.getTime() - date2.getTime());
     var minute = Days / (1000 * 60 ); 
      let seconds: number = minute * 60;
      let textSec: any = "0";
      let statSec: number = 60;
      const prefix = minute < 10 ? "0" : "";seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;
      const prefixsec = (Math.floor( seconds % 60 ) < 10)? "0" : "";
      this.countDown1 = `${prefix}${Math.floor(seconds / 60)}:${prefixsec}${Math.floor( seconds % 60 )}`;
      if (seconds <= 0 || date1.getTime() <= date2.getTime() || !this.timersec) {
        this.disableResend = false;
        this.countDown1 = "00:00";
        clearInterval(this.timersec);
        this.timersec = null;
      }
      
      }
      else{
        this.disableResend = false;
        this.countDown = "00:00";
        console.log('time cleared' + date2 )
        clearInterval(this.timersec);
      }
    }, 1000);
  }
  

  timer(minute) {
    // let minute = 1;
    let seconds: number = minute * 60;
    let textSec: any = "0";
    let statSec: number = 60;

    const prefix = minute < 10 ? "0" : "";

    this.timersec = setInterval(() => {
      seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;

      if (statSec < 10) {
        textSec = "0" + statSec;
      } else textSec = statSec;

      this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;

      if (seconds == 0) {
        this.disableResend = false;
        clearInterval(this.timersec);
      }
    }, 1000);
  }

  selectedAccount(value?: any) {
    // alert(value);
    this.adminservice.getusers(value, 'userpk').subscribe(res => {
      let userdata = res.data['data'];
    
      if (res.data['flag'] == "SR") {
        this.loginInnerTemplate = 'passwordpageshow';
        this.userlogindata = userdata;
       
        this.loginForm.controls.accountselected.setValue(userdata.pk);
        this.loginForm.controls.stktype.setValue(userdata.stktyppk);
      }
      else if (res.data['flag'] == "SP") {
        this.setpassdtls = userdata;
        this.userlogindata = userdata;
        this.forgettitle = "Set password";
        this.linktype = "set"
        this.otptype = 'email';
        this.sendSetPassMail(userdata.pk, userdata.email);
      }
    });
  }


  onSubmit() {
    if (this.loginForm.valid) {
      this.vk1.showKeyboard = false;
      this.showKeyboard = false;
      this.spinnerButtonOptionsLogin.active = true;
      const username = this.loginForm.controls.username.value;
      const password = this.secuirty.aesencrypt(this.loginForm.controls.password.value);
      const userpk = this.loginForm.controls.accountselected.value;
      const stktype = this.loginForm.controls.stktype.value;
      const isDemo = this.loginForm.controls.isdemo.value ? true : false;
      this.adminservice.adminlogin(username, password, isDemo, userpk, stktype,this.countrycode).subscribe(res => {
        res = res.data;
       
        const success = res.success;
        console.log('hi login succccscscscsc')
        if (res.flag === 'PO') {
          this.router.navigate(['/admin/setpassword'], { queryParams: { pk: res.pk, f: 'outdate', t: res.t } });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.flag === 'SL') {
          this.wrongAttemptLeftCount = res.attemptCount;
          this.loginForm.setErrors({ wrongAttemptError: true });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.flag === 'AO') {
          this.loginForm.setErrors({ attemptReachedError: true });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.flag === 'NR') {
          this.loginForm.setErrors({ notRegisteredError: true });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.flag === 'SD') {
          this.spinnerButtonOptionsLogin.active = false;
          this.router.navigate(['/thanksubscription/subscriptionlandingpage'], { queryParams: { date: res.sub_period_end, de_period: res.deactivation_period } });
        } else if (res.flag === 'SP') {
          this.loginForm.setErrors({ setPasswordError: true });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.flag === 'CU') {
          this.loginForm.setErrors({ changeUserError: true });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.flag === 'C') {
          this.loginForm.setErrors({ captchaError: true });
          this.spinnerButtonOptionsLogin.active = false;
        } else if (res.token != '' && success != false) {
         
          const decoded: any = jwtDecode(res.token);
          localStorage.setItem('v3logindata', res.token);
          localStorage.setItem('v3logindatarefresh', res.refreshToken);
          if (res.flag === 'S') {
           
           if(res.passwordexpired == 'yes'){
            this.router.navigate(['/admin/setpassword'], { queryParams: { pk: this.secuirty.encrypt(this.lgnpk) } });
           }else{
            this.memReg = this.localStorage.getInLocal('reg_pk');
             this.registertype = this.localStorage.getInLocal("regtype"); 
            this.oum_projectmst_fk = this.localStorage.getInLocal("oum_projectmst_fk");
           if(this.registertype == 2){
            
             this.projectpk = this.oum_projectmst_fk;
           }else if(this.registertype == 3){
              if(this.oum_projectmst_fk){
                this.projectpk = this.oum_projectmst_fk;
              }else{
                this.projectpk = 1;
              }
           
           }else{
              this.projectpk = 1;
           }            //do Stuff Dashboard
            console.log('entered in the service');
             this.adminservice.getuserpermissionaccess(userpk).subscribe(data => {
              localStorage.setItem('uerpermission', this.secuirty.encrypt(JSON.stringify(data['data'])));
             });
            this.adminservice.userterevedtls(this.memReg,this.projectpk).subscribe(data => {   
                if(this.localStorage.getInLocal('omrm_stkholdertypmst_fk') == 1){
                  this.router.navigate(['/dashboard/portaladmin']);
                }else{
 
                  if (data.data.status == '1') {
                    this.localStorage.setInLocal('mainorbranch', '2');
                    this.focalpoint = this.localStorage.getInLocal("isadmin");
                    this.registertype = this.localStorage.getInLocal("regtype");

                    if (this.focalpoint == 1) {
                      // this.registertype  1-opal star, 2.technical assessment, 3-both'


                      if (this.registertype == 2) {

                        if (this.focalpoint == 1) {
                          // this.router.navigate(['/dashboard/centre']);
                          if (this.oum_projectmst_fk == 5) {
                            this.router.navigate(['/manageivms/ivmscentrelist']);
                          }
                          else {
                            this.router.navigate(['/dashboard/centre']);
                          }

                        } else {
                          if (this.oum_projectmst_fk == 5) {
                            this.router.navigate(['/manageivms/ivmscentrelist']);
                          }
                          else {
                            this.router.navigate(['/vehiclemanagement/vehiclelisting']);
                          }
                        }
                      }
                      else if (this.registertype == 3) {
                        if (this.focalpoint == 1) {
                          // this.router.navigate(['/dashboard/centre']);
                          if (this.oum_projectmst_fk == 5) {
                            this.router.navigate(['/manageivms/ivmscentrelist']);
                          }
                          else {
                            this.router.navigate(['/dashboard/centre']);
                          }

                        } else {
                          if (this.oum_projectmst_fk == 5) {
                            this.router.navigate(['/manageivms/ivmscentrelist']);
                          }
                          else if (this.oum_projectmst_fk == 4) {
                            this.router.navigate(['/vehiclemanagement/vehiclelisting']);
                          }
                          else {
                            this.router.navigate(['/batchindex/batchgridlisting']);
                          }
                        }
                      } else {
                        this.router.navigate(['/dashboard/centre']);
                      }
                    } else {
                        if (this.oum_projectmst_fk == 5) {
                          this.router.navigate(['/manageivms/ivmscentrelist']);
                        }
                        else if (this.oum_projectmst_fk == 4) {
                          this.router.navigate(['/vehiclemanagement/vehiclelisting']);
                        }
                        else
                        {
                          this.router.navigate(['/batchindex/batchgridlisting']);
                        }
                    }
                      

                    
                  } else {
                    if(this.registertype == 1 || this.registertype == 2 ){
                      this.localStorage.setInLocal('mainorbranch','1')
                    }
                    const statusarr: any[] = [5,6,7,8,9,10,11,12,13,14,18]; 
                    var status = data.data.data1.appdt_status;
                    var projectpk = data.data.data1.appdt_projectmst_fk;
                    var apptype = data.data.data1.appdt_apptype; 
                    var apptemppk = data.data.data1.applicationdtlstmp_pk;
                  // alert(statusarr.includes('5')+''+data.data.data1.appdt_status+''+this.localStorage.getInLocal('apptype')+''+this.localStorage.getInLocal('projectpk')) 
                  if(apptype==1 && ( projectpk ==1  ||  projectpk== 4) && (status == 5 || status == 6  || status == 7  || status == 8  || status == 9  || status == 10  || status == 11  || status == 12  || status == 13  || status == 14  || status == 18 )){                    

                    // if(this.localStorage.getInLocal('apptype')==1 && ( this.localStorage.getInLocal('projectpk')==1 ||  this.localStorage.getInLocal('projectpk')== 4) && statusarr.includes()){                    
                       console.log('inside the', this.localStorage.getInLocal('projectpk'));
                      //  document.querySelector('.breadcrumb-item.active').innerHTML = 'Institute Information'; 
                    if(this.projectpk == 1){
                      this.router.navigate(['trainingcentremanagement/maincentre'], { queryParams: { p: this.secuirty.encrypt(this.projectpk), t: this.secuirty.encrypt(apptype), s: this.secuirty.encrypt(status), at: this.secuirty.encrypt(apptemppk), bc: 'paycnt', f: 'mc'} });                              

                    }else{
                      this.router.navigate(['trainingcentremanagement/rascentre'], { queryParams: { p: this.secuirty.encrypt(this.projectpk), t: this.secuirty.encrypt(apptype), s: this.secuirty.encrypt(status), at: this.secuirty.encrypt(apptemppk), bc: 'paycnt', f: 'mc'} });                              

                    }
                    }else{
                      console.log('inside the center');
                      this.registertype = this.localStorage.getInLocal("regtype");
                      if (this.registertype == 2) {
                        this.router.navigate(['trainingcentremanagement/rascentre'],{ queryParams: { p: this.secuirty.encrypt(4),s: this.secuirty.encrypt(1)}});

                      }else{
                        this.router.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { p: this.secuirty.encrypt(1)}});

                      }
                     
                      // if (this.registertype == 2) {
                      //   this.router.navigate(['trainingcentremanagement/rascentre']);
                      // }else{
                      //   this.router.navigate(['trainingcentremanagement/maincentre']);
                      // }
                      
                    }
                  }
                }
                  
            });
            
           }
          }
          // if (decoded.uid.um_lastvisitded != '') {
          //   localStorage.setItem('userlastvisit', '1');
          // }
          // if (decoded.uid.UM_Type == 'U') {
          //   let userid = this.secuirty.encrypt(decoded.uid.UserMst_Pk);
          //   this.adminservice.getuserpermission(userid).subscribe(userres => {
          //     if (userres['data'].status == 1) {
          //       localStorage.setItem('uerpermission', this.secuirty.encrypt(JSON.stringify(userres['data'].data)));
          //     }
          //   });
          // }
        
          if (res.flag === 'AL') {
            this.router.navigate(['/afterlogin/subscription']);
          } else if (res.flag === 'GCS') {
            this.globeconnectredi(res.j2link);
          }
          //  else if (res.flag === 'S') {
            
            // if (res.isotpenable != 1) {
            //   if (res.remider == 1) {
            //     this.resultafterlogin = res;
            //     this.loginTemplate = 'twofactor';
            //     this.encryptedUserID = res.enuserpk;
            //   }
            //   else {
                              
            //   }
            // }
            // else {
            //   this.resultafterlogin = res;
            //   this.loginTemplate = 'otptemplate';
            //   this.showLoader = true;
            //   this.sendLoginOtp(res);
            // }
          //    setTimeout(() => {
          //         this.redirectsuccesspage(res);
          //       }, 1500);  

          // }
          this.spinnerButtonOptionsLogin.active = false;
        } else {
         
          if (res.flag !== 'AO' && res.flag !== 'SL') { this.loginForm.setErrors({ invalidError: true }); }
          this.spinnerButtonOptionsLogin.active = false;
        }
      }, error => {
        this.loginForm.setErrors({ invalidError: true });
        this.spinnerButtonOptionsLogin.active = false;
      });
    } else {
      this.spinnerButtonOptionsLogin.active = false;
    }
  }
  twoFactorEnable(data) {
    if(data == true){
      this.redirectsuccesspage(this.resultafterlogin);
    }
  }
  globeconnectredi(j2link) {
    window.location.href = j2link.j2UserEncryptLink + '&afterlogin=GLOBECONNECT';
    return false;
  }
  oprolngredir(j2link, noticepk) {
    window.location.href = j2link.j2UserEncryptLink + '&' + 'afterlogin=oprolng&noticePk=' + noticepk;
    return false;
  }
  afterlogin(j2link, frmwhere = 2) {
    if (frmwhere == 1) {
      if (this.hasAfterLogin) {
        let strParams = '';
        for (let key in this.afterloginParams) {
          strParams += key + '=' + this.afterloginParams[key];
        }
        window.location.href = j2link.j2UserEncryptLink + '&' + strParams;
        return false;
      } else { return true; }
    } else {
      if (this.hasAfterLogin) {
        let strParams = '';
        for (let key in this.afterloginParams) {
          strParams += key + '=' + this.afterloginParams[key] + '&';
        }
        window.location.href = j2link + '&' + strParams;
        return false;
      } else { return true; }
    }

  }

  sendLoginOtp(res: any) {
    this.showLoader = true;
    this.encryptedUserID = res.enuserpk;
    this.showid = res.otpid;
    this.resettimer();
    this.disableResend = true;
    this.adminservice.sendLoginOtp(this.encryptedUserID).subscribe(response => {
      if (response.data['status'] == 1) {
        this.loginTemplate = 'otptemplate';
        this.lastattempt = 0;
        this.attemptCount = response.data['attempt'];
        this.timer(response.data['time']);
        this.showLoader = false;
      }
      else {
        return false;
      }
    }
    );
  }
  isValidLoginOTP() {
    if (this.OTPControl.valid) {
      this.adminservice.validateloginotp(this.encryptedUserID, this.OTPControl.value, 'login').subscribe(data => {
        if (data.data.status == 1) {
          this.redirectsuccesspage(this.resultafterlogin)
        } else if (data.data.status == 2) {
          this.OTPControl.setErrors({ invalidOTP: true });
        } else if (data.data.status == 3) {
          this.OTPControl.setErrors({ expiredOTP: true });
        }
      });
    }
  }

  handleKeyUp(e) {
    if (e.keyCode === 13) {
      this.isValidLoginOTP();
    }
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

  redirectsuccesspage(res) {
    const decoded: any = jwtDecode(res.token);
    if (res.MRM_RenewalStatus == 'I') {
      this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription" } });
    } else if ((parseInt(res.expdays) > parseInt(res.graceperiod)) && res.MRM_RenewalStatus == 'D') { // Expiry date crossed 10 days and renewal status is Declined
      this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription" } });
    } else if ((parseInt(res.expdays) < parseInt(res.graceperiod)) && res.MRM_RenewalStatus == 'D') {
      if (res.regType == 6) {
        this.router.navigate(['/dashboard/centre'], { state: { showRenewalPopup: res.showRenewalPopup, expdays: res.expdays, beforeexpdays: res.beforeexpdays, graceperiod: res.graceperiod, graceperiodend: res.graceperiodend } });
      }
      else {
        this.router.navigate(['/dashboard/centre']);
      }
    } else if (res.MRM_RenewalStatus == 'GE') {
      this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription" } });

    } else if (res.MRM_RenewalStatus == 'RW' && (parseInt(res.expdays) < parseInt(res.graceperiod))) {
      if (res.regType == 6) {
        this.router.navigate(['/dashboard/centre']);
      }
      else {
        this.router.navigate(['/dashboard/centre']);
      }
    } else if (res.MRM_RenewalStatus == 'RW' && (parseInt(res.expdays) > parseInt(res.graceperiod))) {
      this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription" } });
    } else if (this.auth.redirectUrl != '') {
      this.router.navigate([this.auth.redirectUrl], { state: { showRenewalPopup: res.showRenewalPopup, expdays: res.expdays } });
    } else {
      if (this.afterloginpage == "JEXPORTDWLD") { // J- search export download
        this.router.navigate(['/bizsearchnew/jexportdwnld'], { queryParams: { pid: this.pid } });
      }
      else if (this.afterloginpage == "UPDPYMTSTS") {
        this.router.navigate(['/regapproval/supplierapprovaltab']);
      }
      else if (this.afterloginpage == "REWPYMTPAGE") {
        this.router.navigate(['afterlogin/certificationpaymentdetail']);
      }
      else if(this.afterloginpage == "MAILLOGIN"){
        if(this.localStorage.getInLocal('reg_type') == 1){
          this.router.navigate(['/regapproval/registeredstakeholder']);
          return false;
        }else if (this.localStorage.getInLocal('reg_type') == 6){
          this.router.navigate(['/cert/scdash/dashboard']);
          return false;
        }else{
          this.router.navigate(['/cert/oissrdash/dashboard']);
          return false;
        }       
      }
      else if ((this.afterloginpage == "SCFS" && res.regType == 6 )||(this.afterloginpage == "SCFIB" && res.regType == 15 )) { // SCF supplier end SCFS
        this.suppOrg = this.afterloginpage == "SCFS" ? 'sccert' : 'oissrcert';
        let createlink = 'cert/'+this.suppOrg+'/1';
        this.router.navigate([createlink]);
      }
      else if (this.afterloginpage == "SCFB" || this.afterloginpage == "SCFIB" ) { // SCF backend end 
        if (this.valid != undefined && this.valid != null) {
          this.valid = this.valid;
        } else {
          if (decoded.uid.reg_type == 1) {
            this.valid = 1;
          } else {
            this.valid = 4;
          }
        }
        this.suppOrg = this.afterloginpage == "SCFIB" ? 'oissrcert' : 'sccert';
        let createlink = 'cert/'+this.suppOrg+'/' + this.scfid + '/' + this.compid + '/1';
        this.router.navigate([createlink]);
      }
      else if (this.afterloginpage == "RFXEVALDETL") {
        this.router.navigate(['pms/rfxlist'], {
          queryParams: {
            rfxid: this.rfxid,
            rfxtype: this.rfxtype
          }
        });
      }      
      else {
        if (res.regType == 6) {
          this.router.navigate(['/dashboard/centre'], { state: { showRenewalPopup: res.showRenewalPopup, expdays: res.expdays, beforeexpdays: res.beforeexpdays, graceperiod: res.graceperiod, graceperiodend: res.graceperiodend } });
        } else if (res.regType == 7) {
          this.router.navigate(['/dashboard/operator'], { state: { showRenewalPopup: res.showRenewalPopup } });
        } else if (res.regType == 1) {
          this.router.navigate(['/regapproval/registeredstakeholder']);
        } else if (res.regType == 4) {
          this.router.navigate(['/dashboard/memdashboard']);
        } else if (res.regType == 15) {
          this.router.navigate(['/dashboard/centre'], { state: { showRenewalPopup: res.showRenewalPopup, expdays: res.expdays, beforeexpdays: res.beforeexpdays, graceperiod: res.graceperiod, graceperiodend: res.graceperiodend } });
        } else {
          console.log('safsa');
          this.router.navigate(['/home/dashboard']);
        }
      }
    }
    console.log('safsffsfddfa');
  }
  password(userdata) {
    this.loginInnerTemplate = 'singlepasswordpageshow';
    this.loginForm.controls.accountselected.setValue(userdata.opalusermst_pk);
  
    this.maskemail =userdata.maskedemail;
    this.lgnemailid = userdata.oum_emailid;
    this.user_pk = userdata.opalusermst_pk;
  }

}
