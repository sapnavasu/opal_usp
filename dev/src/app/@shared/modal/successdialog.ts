
import { Inject, Component, OnInit, HostListener, ViewChild, Output, EventEmitter, ViewEncapsulation } from "@angular/core";
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import swal from 'sweetalert';
import Keyboard from "simple-keyboard";

import { Router } from '@angular/router';
import { AdminService } from '@app/auth/admin.service';
import { VirtualKeyboardComponent } from '@app/auth/virtual-keyboard/virtual-keyboard.component';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Encrypt } from '@app/common/class/encrypt';
import { MustMatch } from '@app/common/directives/must-match.validator';
import { PasswordStrengthValidator } from "./passwordvalidator";
import { RemoteService } from "@app/remote.service";
import { TranslateService } from "@ngx-translate/core";
import { CookieService } from "ngx-cookie-service";

@Component({
  selector: './modal-dialog',
  templateUrl: './modal-dialog.html',
  styleUrls: ['./modal-dialog.scss'],
  providers: [AdminService],
  encapsulation: ViewEncapsulation.None,
})
export class Successdialog implements OnInit {
  
  @Output() valueChange = new EventEmitter();
  value = "";
  keyboard: Keyboard;
  showKeyboard: boolean = false;
  @ViewChild('vk') vk :VirtualKeyboardComponent;
  @ViewChild('vk1') vk1 :VirtualKeyboardComponent;
  @ViewChild('vk2') vk2 :VirtualKeyboardComponent;
  confirmationhide: boolean = false;
  public changePasswordForm: FormGroup;
  showPwdCtrl: FormControl = new FormControl();
  validationCount: number = 0;
  encryptedUserPk: any;
  disableButton: boolean = false;
  isnumber: boolean = false;
  public isInputTextTypefirst: boolean = false;
  public isInputTextsecondType: boolean = false;
  public isInputTextthirdType: boolean = false;
  public lusrtpye:string;
  public modydate:any;
  public stakeHolderType:number;
  issmallcase: boolean = false;
  isuppercase: boolean = false;
  issymbol: boolean = false;
  disableUpdateButton: boolean = false;
  disableSendOTPButton: boolean = false;
  otpResendAttemptCount: number = 0;
  public otpSucMsg:any;
  public comMsg:any;
  selected: string;
  otpsourcetype: string;
  disableResend: boolean;
  countDown: string = '00.00';
  timersec: any;
  encryptPassword: string;
  encryptnewPassword: string;
  constructor(private fb: FormBuilder,
    public dialogRef: MatDialogRef<Successdialog>,
    @Inject(MAT_DIALOG_DATA) public data: any,
    private security: Encrypt,
    private applocalstorage: AppLocalStorageServices,
    private adminservice: AdminService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private profileService: ProfileService, private router: Router,
    private snackBar: MatSnackBar) { }

    @HostListener('keydown', ['$event']) blockKeydown(e: KeyboardEvent) {
      var patt = new RegExp(/[^\s]+(\s+[^\s]+)*$/g);
      var res = patt.exec(e.key);
      if(res == null){
        e.stopImmediatePropagation();
        e.preventDefault();
      }
    }

    localdatas:any='';
    user_origin: any;

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"166","dir":"rtl"}];
    dir="ltr" 
  ngOnInit() {
    if(this.timersec)
    {
      clearInterval(this.timersec);
    }
    this.selected = "1";
    if (localStorage.getItem('v3logindata')) {
      this.localdatas = this.applocalstorage.getInLocal();
      // this.user_origin = (this.localdatas.um_primobnocc == 31)?'N':'I';
    }
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
    this.encryptedUserPk = this.security.encrypt(this.applocalstorage.getInLocal('opalusermst_pk'));
    this.lusrtpye = this.applocalstorage.getInLocal('usertype');
    this.stakeHolderType = this.applocalstorage.getInLocal('reg_type');
      this.adminservice.getlastmodify(this.encryptedUserPk).subscribe(data => {
        if(data['data'].status == 1){
          this.modydate = data['data'].modydate;
          this.user_origin = data['data'].mobileorigin;
        }
      });
    this.changePasswordForm = this.fb.group({
      currentpassword: ['', [ Validators.required, Validators.minLength(8)]],
      newpassword: ['', [ Validators.required, Validators.minLength(8),this.validateInput.bind(this),PasswordStrengthValidator]],
      confirmnewpassword: ['', [Validators.required, Validators.minLength(8)]],
      otpcode: [null,[Validators.nullValidator, Validators.minLength(4), Validators.maxLength(4)]],
      otpType: [null, Validators.required],
    },{
      validator: MustMatch('newpassword', 'confirmnewpassword')
    });
    this.changePasswordForm.controls['otpType'].setValue('1');
  }
 
  closeDialog(): void {
    this.otpResendAttemptCount = 0;
    this.dialogRef.close();
  }

  currentpasswordKeyboard()
  {

    this.vk.showKeyboard = !this.vk.showKeyboard;
    this.vk.initializeKeyboard()

    if(this.vk.showKeyboard)
    {
      this.vk1.showKeyboard=false;
      this.vk2.showKeyboard=false;
    }
  }
  newpasswordKeyboard()
  {
    this.vk1.showKeyboard = !this.vk1.showKeyboard;
    this.vk1.initializeKeyboard()

    if(this.vk1.showKeyboard)
    {
      this.vk.showKeyboard=false;
      this.vk2.showKeyboard=false;
    }
  }
  confirmpasswordKeyboard()
  {

    this.vk2.showKeyboard = !this.vk2.showKeyboard;
    this.vk2.initializeKeyboard()

    if(this.vk2.showKeyboard)
    {
      this.vk.showKeyboard=false;
      this.vk1.showKeyboard=false;
    }
  }

  get currentpasswordControl() {
    return this.changePasswordForm.controls['currentpassword'];
  }
  get newpasswordControl() {
    return this.changePasswordForm.controls['newpassword'];
  }
  get confirmpasswordControl() {
    return this.changePasswordForm.controls['confirmnewpassword'];
  }

  confirmation() {
    console.log(this.changePasswordForm.controls['otpType'].value);
    if(this.changePasswordForm.valid && this.changePasswordForm.controls['otpType'].value){
      this.vk.showKeyboard = false;
      this.vk1.showKeyboard = false;
      this.vk2.showKeyboard = false;
      this.disableSendOTPButton = true;
      this.disableUpdateButton = true;
      this.encryptPassword = this.security.aesencrypt(this.password);
      this.encryptnewPassword = this.security.aesencrypt(this.newpassword);
      let otptype = this.changePasswordForm.controls['otpType'].value;
      
      if(otptype == '1'){
        this.otpSucMsg="OTP sent to your Email";
        this.comMsg="Email";
      } else if(otptype == '2'){
        this.otpSucMsg="OTP sent to your Mobile";
        this.comMsg="Mobile";
      }
      this.otpsourcetype = otptype == 2 ? 'mobile':'email';
      this.adminservice.sendOTP(this.encryptedUserPk,this.encryptPassword, this.otpsourcetype).subscribe(data => {
        this.disableSendOTPButton = false;
        this.disableResend = true;
        if(data['data'].status == 1){
          var date1 = new Date(data['data'].expiry);
          var date2 = new Date();
          var Time = date1.getTime() - date2. getTime();
          var Days = Time / (1000 * 60 ); //Diference in Days.
          console.info(date1);
          console.info(date1.getTime());
          this.timer(Days,date1);
          this.snackBar.open(this.otpSucMsg,'', {
            duration: 2000,
            panelClass:['success'],
            verticalPosition:'top'
          });
          this.confirmationhide = true;
          this.changePasswordForm.controls['otpcode'].setValidators([Validators.required]);
          this.changePasswordForm.controls['otpcode'].updateValueAndValidity();
        } else if (data['data'].status == 4) {
          this.disableUpdateButton = false;
          this.changePasswordForm.controls['currentpassword'].setErrors({invalidPassword: true});
        } else if (data['data'].status == 2) {
          this.disableUpdateButton = false;
          this.changePasswordForm.controls['confirmnewpassword'].setErrors({usernameSame: true});
        } else if (data['data'].status == 3) {
          this.disableUpdateButton = false;
          this.changePasswordForm.controls['confirmnewpassword'].setErrors({oldPassword: true});
        } 
      });
    }
    
  }

  resendOtp(){
    this.changePasswordForm.controls['otpcode'].reset();
    this.changePasswordForm.controls['otpcode'].updateValueAndValidity();
    if(this.otpResendAttemptCount !== 3) {
      clearInterval(this.timersec);
      this.disableResend = true;
      this.otpResendAttemptCount++;
      this.disableSendOTPButton = true;
      this.adminservice.resendOTP(this.encryptedUserPk,this.encryptPassword, this.encryptnewPassword,this.otpsourcetype).subscribe(data => {
        if(data['data'].status == 1){
          var date1 = new Date(data['data'].expiry);
          var date2 = new Date();
          var Time = date1.getTime() - date2. getTime();
          var Days = Time / (1000 * 60 ); //Diference in Days.
          this.timer(Days,date1);
          this.disableSendOTPButton = false;
          this.snackBar.open('OTP resent to your Email','', {
            duration: 2000,
            panelClass:['success'],
            verticalPosition:'top'
          });
        }
      });
    } else {
      this.snackBar.open('OTP resent limit reached','', {
        duration: 2000,
        panelClass:['error'],
        verticalPosition:'top'
      });
    }
  }
  confirmpopup(){
    swal({
      title: "You will be logged out of the portal after changing the password.",
      closeOnClickOutside: false,
      closeOnEsc: false,
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
    }).then(() => {
      this.profileService.logout().subscribe(d => this.router.navigate(['admin/login']));
    });
  }

  changePassword() {
    if(this.changePasswordForm.valid){
      
      this.disableButton = true;
      let encryptPassword = this.security.aesencrypt(this.newpassword);
      this.adminservice.resetPassword(this.encryptedUserPk, encryptPassword,this.otpsourcetype,'no').subscribe(data => {
        this.disableButton = false;
        this.changePasswordForm.setErrors(null);
        if (data['data'].status == 1) {
          this.closeDialog();
          swal({
            title: 'Password changed successfully.',
            text: "You will be logged out of the portal",
            icon: 'success',
            closeOnClickOutside: false,
            closeOnEsc: false
          }).then(() => {          
            this.profileService.logout().subscribe(d => this.router.navigate(['admin/login']));
          });
        } else if (data['data'].status == 2) {
          this.disableUpdateButton = false;
          this.changePasswordForm.controls['confirmpassword'].setErrors({usernameSame: true});
        } else if (data['data'].status == 3) {
          this.disableUpdateButton = false;
          this.changePasswordForm.controls['confirmpassword'].setErrors({oldPassword: true});
        } else if (data['data'].status == 5) {
          this.changePasswordForm.controls['otpcode'].setErrors({invalidotp: true});
        } else if (data['data'].status == 6) {
          this.changePasswordForm.controls['otpcode'].setErrors({expiredotp: true});
        }
      });
    }
  }

  showSweetAlert() {
    if (this.changePasswordForm.touched) {
      swal({
        title: 'Updated successfully.',
        icon: 'success',
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willDelete) => {
        this.closeDialog();

      });
    }
  }

  timer(minutes, time) {
    this.timersec = setInterval(() => {
      var date1 = new Date(time);
      var date2 = new Date();
     let Days = (date1.getTime() - date2.getTime());
     var minute = Days / (1000 * 60 ); 
      let seconds: number = minute * 60;
      let textSec: any = "0";
      let statSec: number = 60;
      const prefix = minute < 10 ? "0" : "";
      if (date1.getTime() > date2.getTime()) { seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;
      const prefixsec = (Math.floor( seconds % 60 ) < 10)? "0" : "";
      this.countDown = `${prefix}${Math.floor(seconds / 60)}:${prefixsec}${Math.floor( seconds % 60 )}`;
      if (seconds <= 0 || date1.getTime() <= date2.getTime()) {
        this.disableResend = false;
        this.countDown = "00:00";
        clearInterval(this.timersec);
      }
      }
      
    }, 1000);
  }

  validateInput(c: FormControl) {
    if (!c.value) {
      this.validationCount = 0;
      this.disableUpdateButton = true;
      this.isnumber=false;
      this.issymbol=false;
      this.isuppercase=false;
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
      if(this.validationCount == 4){
        this.disableUpdateButton = false;
      }else{
        this.disableUpdateButton = true;
      }
      return {};
    }
  }

  get password() {
    return this.changePasswordForm.controls['currentpassword'].value;
  }

  get newpassword() {
    return this.changePasswordForm.controls['newpassword'].value;
  }

  get otpcode() {
    return this.changePasswordForm.controls['otpcode'].value;
  }

  get passwordFieldCtrl() {
    return this.changePasswordForm.controls['newpassword'];
  }

  }


