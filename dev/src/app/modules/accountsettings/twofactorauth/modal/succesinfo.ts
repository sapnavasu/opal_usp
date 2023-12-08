import { Inject, Component, OnInit, ViewEncapsulation } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { ErrorStateMatcher } from '@angular/material/core';
import { Encrypt } from "@app/common/class/encrypt";
import { AppLocalStorageServices } from "@app/common/localstorage/applocalstorage.services";
import { RegistrationService } from "@app/modules/registration/registration.service";
import { CookieService } from 'ngx-cookie-service';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { MatProgressButtonOptions } from "mat-progress-buttons";
import { ToastrService } from 'ngx-toastr';
import { MatSpinner } from "@angular/material/progress-spinner";
@Component({
    selector: "successmodal",
    templateUrl: "successmodal.html",
    styleUrls: ["successmodal.scss"],
    encapsulation: ViewEncapsulation.None
  })
export class succesinfo implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  otpverified: any;
  projcount: any;
  tendercount: any;
  contractcount: any;
  awardcount: any;
  Submitted: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  encryptedUserPk: string;
  OTPForm: FormGroup;
  duration: any;
  disableSubmitButton: boolean;
  newemail: any;
  timersec: any;
  countDown: string;
  disableResend: boolean;
  spinnerButtonOptionsproced: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    text: 'Proceed',
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  Days: number;
  string: string;
  public partitioned: boolean = true;
    constructor(public dialogRef: MatDialogRef<succesinfo>, public toastr: ToastrService,
       private security: Encrypt,
       private regService: RegistrationService,
       private fb: FormBuilder,
       private applocalstorage: AppLocalStorageServices,
       private translate: TranslateService,
       private remoteService: RemoteService,
       private cookieService: CookieService,
        @Inject(MAT_DIALOG_DATA) public data: any) {
      

         }
        
         languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
         { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
         dir = "ltr"
    ngOnInit() {
      
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.spinnerButtonOptionsproced.text = "Proceed";
          this.partitioned = true;
        }
        else {
          this.spinnerButtonOptionsproced.text = "تابع";
          this.partitioned = false;
        }
        
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.spinnerButtonOptionsproced.text = "Proceed";
        this.partitioned = true;

      }
      this.remoteService.getLanguageCookie().subscribe(data => {
        this.translate.setDefaultLang(this.cookieService.get('languageCode'));
        if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
          const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          if (toSelect.languagecode == 'en') {
            this.spinnerButtonOptionsproced.text = "Proceed";
            this.partitioned = true;
          }
          else {
            this.spinnerButtonOptionsproced.text = "تابع";
            this.partitioned = false;

          }
        }else{      
          const toSelect = this.languagelist.find(c => c.id == '1');
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          this.spinnerButtonOptionsproced.text = "Proceed";
          this.partitioned = true;

        }
    });
      this.newemail = this.data.email;

      this.encryptedUserPk = this.security.encrypt(this.applocalstorage.getInLocal('opalusermst_pk'));
      this.OTPForm = this.fb.group({
        email:['',Validators.required],
        otp: ['', Validators.required],
      });

      console.log(this.newemail);
      this.OTPForm.controls['email'].setValue(this.newemail);
      this.OTPForm.controls['email'].updateValueAndValidity();
      this.sendverifyotp(this.OTPForm.controls.email.value, 'email', this.encryptedUserPk);

    }
    get ot() { return this.OTPForm.controls; }
    sendverifyotp(value: any, type: any,pk :any) {
      this.disableSubmitButton = true;
      this.disableResend = true;
      this.regService.sendverifyotpdb(value, type, pk).subscribe(data => {
        console.log(data);
        var date1 = new Date(data['data'].expiry);
          var date2 = new Date();
          var Time = date1.getTime() - date2. getTime();
          var Days = Time / (1000 * 60 ); //Diference in Days.
          console.info(date1);
          console.info(date1.getTime());
          this.timer(Days,date1);
        this.disableSubmitButton = false;
        console.log(data.data);
      }); 
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
          console.log('time cleared' + date2)
          clearInterval(this.timersec);
        }
      }, 1000);
    }

    resendOtp(){
      this.sendverifyotp(this.OTPForm.controls.email.value, 'email', this.encryptedUserPk); 
    }
    submitOtp() {
      this.verifyotpdata(this.OTPForm.controls.email.value, this.OTPForm.controls.otp.value, 'email', this.encryptedUserPk);
      
    }
    

    verifyotpdata(value, otp, type , usrPk) {
      this.spinnerButtonOptionsproced.active = true;
      this.Submitted = true;
      this.regService.verifyotpdatadb(value, otp, type,usrPk).subscribe(data => {
        if (data['data'].flag == 1) {
          this.disableResend = false;
          this.closeModalPopup();
          this.toastr.success(this.i18n('successmodel.otpverif'),	'',  {
            timeOut: 3000,
            closeButton: false,
          });
        }
        else if (data['data'].flag == 2) {
          if(type == 'email'){
            this.OTPForm.controls.otp.reset();
            this.spinnerButtonOptionsproced.active = false;
            this.Submitted = false;
          this.OTPForm.controls.otp.setErrors({ invalidOTP: true });
          }
          this.toastr.warning(this.i18n('successmodel.reenteotpverif'),'', {
            timeOut: 3000,
            closeButton: false,
          });
        }
        else{
          if(type == 'email'){
            this.OTPForm.controls.otp.reset();
            this.spinnerButtonOptionsproced.active = false;
            this.Submitted = false;
            this.OTPForm.controls.otp.setErrors({ expiredOTP: true });
            }
            this.toastr.warning(this.i18n('successmodel.resendotpandretry'), '', {
              timeOut: 3000,
              closeButton: false,
            });
        }
      });
      
    }
    
    closeModalPopup(): void{
        clearInterval(this.timersec);
        this.dialogRef.close({ data: true });
      }
 
}