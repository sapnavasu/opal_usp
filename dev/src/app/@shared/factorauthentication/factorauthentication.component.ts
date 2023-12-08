import { Component, EventEmitter, Input, OnInit, Output, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';

@Component({
  selector: 'app-factorauthentication',
  templateUrl: './factorauthentication.component.html',
  styleUrls: ['./factorauthentication.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class FactorauthenticationComponent implements OnInit {
  timersec: any;
  i18n(key){
    return this.translate.instant(key);
  }
  @Output() private twoFactorEnable = new EventEmitter<any>();
  verifyenable: boolean = false;
  public primobile = '+968';
  otpshow: boolean = false;
  verfiy: boolean = false;
  verfiedtagshow: boolean = false;
  inputenable: boolean = false;
  verifyenablesetup: boolean = false;
  userdls: any;
  decrypdata: any = null;
  placeholder: string;

  public factorForm: FormGroup;
  public settData: any
  @Input() settingsData: any;
  matched: boolean = false;
  duration: any;
  countDown: string = '00:00';
  disableResend: boolean = false;

  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    protected regService: RegistrationService,
    private cookieService: CookieService,
    private security: Encrypt,
    private formBuilder: FormBuilder,
    private router: Router) {
      this.AuthenticationForm = this.formBuilder.group({
        authenfor: ['', Validators.required],
        inputauthenfor: ['', Validators.required],
        otp: ['', Validators.required],
      });
    }

  
  @Input('pk') pk: any = [];
  @Input('sourcetype') sourcetype: any = [];
  AuthenticationForm: FormGroup;
  mailcount: number = 0;
  spinnerButtonOptionsLogin: MatProgressButtonOptions = {
    active: false,
    text: 'Send OTP',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr"
  ngOnInit(): void {
    // this.AuthenticationForm = this.formBuilder.group({
    //   authenfor: ['', ''],
    //   otp: ['', ''],
    //   mobileotpver: ['', ''],
    //   emailotpver: ['', ''],
    //   inputauthenfor: ['', '']
    // });
    //  this.pk = 'MzY3MTA=';
    this.regService.getuserdetails(this.pk).subscribe(data => this.userdls = data['data']);
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
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
  }

  Onselecting(authenfor: any) {
    let value = authenfor == 1 ? this.userdls.emailid : this.userdls.mobileno;
    this.AuthenticationForm.controls['inputauthenfor'].reset();
    this.AuthenticationForm.controls['otp'].reset();
    this.placeholder = authenfor == 1 ? this.i18n('commonsetpassword.emaid') : this.i18n('commonsetpassword.mobno');
    this.decrypdata = this.security.decrypt(value);
    this.inputenable = true;
    this.verifyenable = false;
    this.otpshow = false;
    this.verfiy = false;
    this.verfiedtagshow = false;
    this.mailcount = 0;
    this.verifyenablesetup = true;
    this.matched = false;
    clearInterval(this.timersec);
    
  }

  onsetup() {
    if (this.decrypdata) {
      if (this.AuthenticationForm.controls['inputauthenfor'].value) {
        if (this.decrypdata === this.AuthenticationForm.controls['inputauthenfor'].value.trim()) {
          this.AuthenticationForm.controls['otp'].reset();
          this.AuthenticationForm.controls['otp'].updateValueAndValidity;
          this.matched = true;
          this.verifySource();
        }
        else {
          this.AuthenticationForm.controls['inputauthenfor'].setErrors({ invalid: true });
        }
      }
      else {
        this.AuthenticationForm.controls['inputauthenfor'].setErrors({ required: true });
      }
    }
    else {
      this.AuthenticationForm.controls['authenfor'].setErrors({ required: true });
    }
  }

  setupAuthentication() {
    swal({
      title: this.i18n('commonsetpassword.proceedhead'),
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        if (this.AuthenticationForm.controls['authenfor'].value) {
          let value = this.AuthenticationForm.controls['authenfor'].value;
          this.regService.setAuthentication(value, this.pk).subscribe(data => {
            if (data['data'].flag == 'S') {
              swal({
                title: this.i18n('commonsetpassword.sucesspop'),
                text: '',
                icon: 'success',
                closeOnClickOutside: true
              });
              if (this.sourcetype == 'login') {

                this.twoFactorEnable.emit(true);
              }
              else {
                this.router.navigate(['admin/login']);
              }
            }
          });
        }
        else {
          this.AuthenticationForm.controls['authenfor'].setErrors({ required: true });
        }

      }
      else {
        swal({
          title: this.i18n('commonsetpassword.unsucesspop'),
          text: '',
          icon: 'failure',
          closeOnClickOutside: true
        });
      }
    })


  }
  verifySource() {

    if (this.mailcount < 3) {
      this.spinnerButtonOptionsLogin.active = true;
      let value;
      if (this.AuthenticationForm.controls['authenfor'].value == 1) {
        value = 'email';
      }
      else if (this.AuthenticationForm.controls['authenfor'].value == 2) {
        value = 'mobile';
      }
      clearInterval(this.timersec);
      this.regService.sendverifyotpdb(this.userdls.emailid, value, this.pk,'twofactor').subscribe(data => {
        this.duration = data.data.duration;
        this.disableResend = true;
        this.timer(this.duration);
        this.mailcount = this.mailcount + 1;
        this.otpshow = true;
        this.verfiy = false;
        this.verifyenable = false;
        this.spinnerButtonOptionsLogin.active = false;
      });
    }
    else {
      swal({
        title: this.i18n('commonsetpassword.exeedhead'),
        text: this.i18n('commonsetpassword.exeedtext'),
        icon: 'success',
        closeOnClickOutside: true
      });
    }

  }
  verifyotpdata() {
    let type;
    let otp = this.AuthenticationForm.controls['otp'].value;
    let value;
    if (this.AuthenticationForm.controls['authenfor'].value == 1) {
      type = 'email';
      value = this.userdls.emailid;
    }
    else if (this.AuthenticationForm.controls['authenfor'].value == 2) {
      type = 'mobile'
      value = this.userdls.mobileno;
    }

    this.regService.verifyotpdatadb(value, otp, type, this.pk,'twofactor').subscribe(data => {
      if (data.data.flag == 1) {
        this.setupAuthentication();
      }
      else if (data.data.flag == 2) {
        this.AuthenticationForm.controls['otp'].setErrors({ invalidOTP: true });
      }
      else if (data.data.flag == 3) {
        this.AuthenticationForm.controls['otp'].setErrors({ expired: true });
      }
    });
  }
  Cancel() {
    swal({
      title: this.i18n('commonsetpassword.canotp'),
      text: this.i18n('commonsetpassword.doyouwantcan'),
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.resetAll();
      }
    })
  }
  resetAll() {
    clearInterval(this.timersec);
    this.AuthenticationForm.reset();
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

  remind() {
    this.regService.remindtwofactor(this.pk).subscribe(data => {
      if (data.data.status == 1) {
        swal({
          title: this.i18n('commonsetpassword.remidmelaterhead'),
          text: this.i18n('commonsetpassword.remidmelatertext'),
          icon: 'warning',
          dangerMode: true,
          closeOnClickOutside: true
        })
        if (this.sourcetype == 'login') {
          this.twoFactorEnable.emit(true);
        }
        else {
          this.router.navigate(['admin/login']);
        }

      }
    });
  }


}
