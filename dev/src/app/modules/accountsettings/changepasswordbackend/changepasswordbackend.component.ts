import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, Validators } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { AdminService } from '@app/auth/admin.service';
import { Encrypt } from '@app/common/class/encrypt';
import { MustMatch } from '@app/common/directives/must-match.validator';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
@Component({
  selector: 'app-changepasswordbackend',
  templateUrl: './changepasswordbackend.component.html',
  styleUrls: ['./changepasswordbackend.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ChangepasswordbackendComponent implements OnInit {
  
  i18n(key) {
    return this.translate.instant(key);
  }
  public changePasswordForm:any;
  changePasswordTemplate = 'PassForm';
  FormTemplate = 'currentpass';
  encryptedUserPk: any;
  countDown: string;
  disableResend: boolean = false;
  disableSendOTPButton: boolean;
  encryptPassword: string;
  isnumber: boolean = false;
  issmallcase: boolean = false;
  isuppercase: boolean = false;
  issymbol: boolean = false;
  showPwdCtrl: FormControl = new FormControl();
  validationCount: number = 0;
  disableSubmitButton: boolean;
  spinnerButtonOptionssaveupdate: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    type:'button',
    text: 'Send OTP',
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };

  spinnerButtonOptionsproceed: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    text: 'Proceed',
    type:'button',
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };

  spinnerButtonOptions: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    text: 'Save and Update',
   
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  stktype: any;
  timersec: any;

  constructor(private formBuilder: FormBuilder, private translate: TranslateService,
    private remoteService: RemoteService,private profileService: ProfileService,
    private router: Router,
    private snackBar: MatSnackBar, 
    protected localstorage : AppLocalStorageServices,
    protected adminservice : AdminService,
    protected security : Encrypt,
    private cookieService: CookieService,public toastr: ToastrService, ) {}

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
    dir = "ltr"

  ngOnInit(): void {
    if (localStorage.getItem('v3logindata') == null) {
      this.router.navigate(['/admin/login'])
    }

    this.encryptedUserPk = this.security.encrypt(this.localstorage.getInLocal('opalusermst_pk')) ;
    this.stktype = this.localstorage.getInLocal('omrm_stkholdertypmst_fk');
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
        this.spinnerButtonOptionsproceed.text = 'Proceed'
        this.spinnerButtonOptions.text = 'Save and Update';
      }
      else {
        this.spinnerButtonOptionssaveupdate.text = 'إعادة إرسال رمز التفعيل ';
        this.spinnerButtonOptionsproceed.text = 'تابع'
        this.spinnerButtonOptions.text = 'حفظ وتحديث';
      }
      
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
      this.spinnerButtonOptionsproceed.text = 'Proceed'
      this.spinnerButtonOptions.text = 'Save and Update';
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
          this.spinnerButtonOptionsproceed.text = 'Proceed'
          this.spinnerButtonOptions.text = 'Save and Update';
        }
        else {
          this.spinnerButtonOptionssaveupdate.text = 'إعادة إرسال رمز التفعيل ';
          this.spinnerButtonOptionsproceed.text = 'تابع'
          this.spinnerButtonOptions.text = 'حفظ وتحديث';
        }
     
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
        this.spinnerButtonOptionsproceed.text = 'Proceed'
        this.spinnerButtonOptions.text = 'Save and Update';
      }
  });
    this.createForm();
  }
  createForm() {
    this.changePasswordForm = this.formBuilder.group ({
      currentpassword: ['', [ Validators.required, Validators.minLength(8)]],
      verifyotp: ['', [ Validators.required, Validators.maxLength(4)]],
      newpassword: ['', [Validators.required, Validators.minLength(8), this.validateInput.bind(this)]],
      confirmnewpassword: ['', [ Validators.required, Validators.minLength(8)]],
    },{
      validator: MustMatch('newpassword', 'confirmnewpassword')
    });
  }

  validateInput(c: FormControl) {
    if (!c.value) {
      this.validationCount = 0;
      return {};
    } else {
      const numbers = new RegExp(".*[0-9].*");
      const alphabets = new RegExp(".*[A-Z].*");
      const smallalphabets = new RegExp(".*[a-z].*");
      const symbols = new RegExp(".*[@'!#$%&':*+/=?^_`{|},<>;\")\\\\[\\](~.-\\s+].*");
      const validationArr = [smallalphabets.test(c.value),numbers.test(c.value), alphabets.test(c.value), symbols.test(c.value)];
      this.isnumber = numbers.test(c.value);
      this.issmallcase = smallalphabets.test(c.value);
      this.isuppercase = alphabets.test(c.value);
      this.issymbol = symbols.test(c.value);
      this.validationCount = validationArr.filter(isValid => isValid === true).length;

      return {};
    }
  }


  SendOTP(){
    if(this.changePasswordForm.controls.currentpassword.valid)
    {
      this.spinnerButtonOptionssaveupdate.active = true;
      this.disableResend = true;
      this.encryptPassword = this.security.aesencrypt(this.changePasswordForm.controls.currentpassword.value);
      this.adminservice.sendOTP(this.encryptedUserPk,this.encryptPassword,'email').subscribe(data => {
                console.log(data)
                this.disableSubmitButton = false;
                this.spinnerButtonOptionssaveupdate.active = false;
                this.timer(15,data.data.expiry);
                if(data['data'].status == 1){
                  this.toastr.success(this.i18n('changepassword.otpsendtoyou'),	'',  {
                    timeOut: 2000,
                    closeButton: false,
                  });
                  this.FormTemplate = 'otpscreen';
                  this.changePasswordForm.controls['verifyotp'].setValidators([Validators.required]);
                  this.changePasswordForm.controls['verifyotp'].updateValueAndValidity();
                } else if (data['data'].status == 4) {
                  // this.disableUpdateButton = false;
                  this.changePasswordForm.controls['currentpassword'].setErrors({invalidPassword: true});
                } else if (data['data'].status == 2) {
                  // this.disableUpdateButton = false;
                  // this.changePasswordForm.controls['confirmnewpassword'].setErrors({usernameSame: true});
                } else if (data['data'].status == 3) {
                  // this.disableUpdateButton = false;
                  this.changePasswordForm.controls['confirmnewpassword'].setErrors({oldPassword: true});
                } 
              });
    }
  }
  
  timer(minutes, time) {
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
      this.countDown = `${prefix}${Math.floor(seconds / 60)}:${prefixsec}${Math.floor( seconds % 60 )}`;
      if (seconds <= 0 || date1.getTime() <= date2.getTime() || !this.timersec) {
        this.disableResend = false;
        this.countDown = "00:00";
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
  

  resendOtp(){
      this.disableSubmitButton = true;
      this.SendOTP();
      }
  
  VerifyOTP(){
    if(this.changePasswordForm.controls.verifyotp.valid)
    {
      this.spinnerButtonOptionsproceed.active = true;
      let otp = this.changePasswordForm.controls.verifyotp.value;
      this.adminservice.verifyOTP(this.encryptedUserPk,otp,'email').subscribe(data => {
                console.log(data);
                this.disableSendOTPButton = false;
                 this.spinnerButtonOptionsproceed.active = false;
                if(data['data'].status == 1){
                  clearInterval(this.timersec);
                  this.disableResend = false;
                  this.toastr.success(this.i18n('changepassword.otpverisucc'),	'',  {
                    timeOut: 2000,
                    closeButton: false,
                  });
                  this.FormTemplate = 'newpasswords';
                }
                 else if (data['data'].status == 2) {
                   this.changePasswordForm.controls['verifyotp'].reset();
                  this.changePasswordForm.controls['verifyotp'].setErrors({invalidOTP: true});
                } else if (data['data'].status == 3) {
                  this.changePasswordForm.controls['verifyotp'].reset();
                  this.changePasswordForm.controls['verifyotp'].setErrors({ExpiredOTP: true});
                } 
              });
    }
  }

  saveNewPasswords()
  {
    if(this.changePasswordForm.valid)
    {
      this.spinnerButtonOptions.active =true;
      let newencpass = this.security.aesencrypt(this.changePasswordForm.controls.newpassword.value);
      this.adminservice.resetPassword(this.encryptedUserPk,newencpass,'email','no').subscribe(data=>{
        if(data.data.status == 1)
        {
           this.disableResend = false;
           clearInterval(this.timersec);
          this.FormTemplate = 'sucesspage';
          this.profileService.logout().subscribe(d => this.router.navigate(['admin/login']));
          // this.router.navigate(['accountsettings/home']);
        }
        else if (data['data'].status == 2) {
          // this.disableResend = false;
          this.changePasswordForm.controls['newpassword'].setErrors({username: true});
        } else if (data['data'].status == 3) {
          // this.disableResend = false;
          this.changePasswordForm.controls['newpassword'].setErrors({lastpass: true});
        } 
        this.spinnerButtonOptions.active =false;
      });
    }
        
  }
  resetAll()
  {
    clearInterval(this.timersec);
    this.disableResend = false;
    this.changePasswordTemplate = 'PassForm';
    this.FormTemplate = 'currentpass';
    this.changePasswordForm.reset();
  }

  backtoaccount() {
    swal({
      title: this.i18n('changepassword.doyouwantcanc'),
      text: this.i18n('changepassword.ifyesanyunsave'),
      icon: 'warning',
      buttons: [this.i18n('changepassword.no'), this.i18n('changepassword.yes')],
      className: this.dir =='ltr'?'swalEng':'swalAr',
    }).then((willGoBack) => {
      if (willGoBack) {
        this.resetAll();
        if(this.stktype == '1')
        {
          this.router.navigate(['dashboard/supplier']);
        }
        else
        {
          this.router.navigate(['accountsettings/home']);
        }
       
      }
    });
    

  }
  
  get newpassword() {
    return this.changePasswordForm.controls['newpassword'].value;
  }

  get passwordFieldCtrl() {
    return this.changePasswordForm.controls['newpassword'];
  }
}



















