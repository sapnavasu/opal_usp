import { Component, ElementRef, Input, OnInit, ViewEncapsulation, } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import swal from 'sweetalert';
import { CookieService } from 'ngx-cookie-service';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDialog } from '@angular/material/dialog';
import { succesinfo } from './modal/succesinfo';
import { AccountsettingsService } from '../accountsettings.service';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
@Component({
  selector: 'app-twofactorauth',
  templateUrl: './twofactorauth.component.html',
  styleUrls: ['./twofactorauth.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class TwofactorauthComponent implements OnInit {
  [x: string]: any;
  disableSubmitButton: boolean;
  email: any;
  train: any;
  i18n(key) {
    return this.translate.instant(key);
  }

  selectedtype: any = null;
  pk: any;
  showpanel: boolean = false;
  AccEditForm: FormGroup;
  @Input('accSettingsData') accSettingsData: [];
  matched: boolean = false;
  placeholder: string = this.i18n('tschangepassword.emaiadd');
  twofactor: any;
  inputenable: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  getPk: any;
  public isfocalpoint: any;
  public type: any;
  spinnerButtonOptionsverify: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    type:'button',
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate'
  };
  spinnerButtonOptionsverified: MatProgressButtonOptions = {
    active: false,
    text: 'Verified',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    type:'button',
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: true,
    mode: 'indeterminate'
  };
  spinnerButtonOptionssaveupdate: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    text: 'Save & Update',
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };

  constructor(private formBuilder: FormBuilder,
    protected regService: RegistrationService,
    protected accService: AccountsettingsService,
    private localStorage: AppLocalStorageServices,
    private localstorageservice: AppLocalStorageServices,
    private security: Encrypt,
    private router: Router,
    private el: ElementRef,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private dialog: MatDialog,public routeid: ActivatedRoute, private secuirty: Encrypt) {

    this.AccEditForm = this.formBuilder.group({
      name: ['', Validators.required],
      userdesig: ['', Validators.required],
      useremailid: ['', Validators.required],
      useremailcnfmon : ['',Validators.required],
      usercontact: ['', Validators.required],
      emailverified: ['', Validators.required]

    });
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr"
  ngOnInit(): void {
    if (localStorage.getItem('v3logindata') == null) {
      this.router.navigate(['/admin/login'])
    }
    this.isfocalpoint = this.localstorageservice.getInLocal('isfocalpoint');
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
     
      if (toSelect.languagecode == 'en') {
        this.spinnerButtonOptionsverify.text = 'Verify';
        this.spinnerButtonOptionsverified.text = 'Verified'
        this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
      }
      else {
        this.spinnerButtonOptionsverify.text = 'Verify';
        this.spinnerButtonOptionsverified.text = 'تم التحقق'
        this.spinnerButtonOptionssaveupdate.text = 'حفظ وتحديث';
      }
      
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.spinnerButtonOptionsverify.text = 'Verify';
      this.spinnerButtonOptionsverified.text = 'Verified'
      this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      console.log('toSelect.dir',this.cookieService.get('languageCode'))
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
      
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.spinnerButtonOptionsverify.text = 'Verify';
          this.spinnerButtonOptionsverified.text = 'Verified'
          this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
        }
        else {
          this.spinnerButtonOptionsverify.text = 'Verify';
          this.spinnerButtonOptionsverified.text = 'تم التحقق"'
          this.spinnerButtonOptionssaveupdate.text = 'حفظ وتحديث';
        }
     
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.spinnerButtonOptionsverify.text = 'Verify';
        this.spinnerButtonOptionsverified.text = 'Verified'
        this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
      }
  });
    this.pk = this.security.encrypt(this.localstorageservice.getInLocal('userPk'));
    this.getAccountsettingsdtls();
    this.viewinvoice();
    this.getDropData();
  }
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
  focusInvalidKeys(keys, form, panel = null) {
    if (form == 'form') {
      for (const key of keys) {
        if (this.AccEditForm.controls[key].invalid) {
          this.AccEditForm.controls[key].setErrors({ required: true });
          this.AccEditForm.controls[key].markAsTouched();
          const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
          if (invalidControl) {
            invalidControl.focus();
          }
          return false;
        }
      }
      return true;
    }
  }

  getAccountsettingsdtls() {
    this.disableSubmitButton = true;
    this.accService.accountsettingsdata("").subscribe(response => {
      if (response.success) {
        this.AccEditForm.patchValue(
          {
            name: response.data.primaryContact.firstname,
            userdesig: response.data.primaryContact.designation,
            useremailid: response.data.primaryContact.emailid,
            usercontact: response.data.primaryContact.mobileno,
            emailverified: response.data.primaryContact.confirmstatus,
            useremailcnfmon: response.data.primaryContact.emailpassseton,
          }
        );
        this.email = response.data.primaryContact.emailid;
      }
      this.disableSubmitButton = false;
    });

  }

  get form() { return this.AccEditForm.controls; }

  openDialog(): void {
    // this.spinnerButtonOptionsverify.active = true;
    // this.disableSubmitButton = true;
    if(this.form.useremailid.errors == null )
    {
      this.form.emailverified.setValue('2');
      this.form.emailverified.updateValueAndValidity();
      let dialogRef = this.dialog.open(succesinfo, { disableClose: true,   panelClass: 'otpfields',
        data: { 'email': this.form.useremailid.value } });
      dialogRef.afterClosed().subscribe(result => {
        console.log(result.data);

        // this.spinnerButtonOptionsverify.active = false;
        if (result.data == true) {
          var date1 = new Date();
          this.form.emailverified.setValue('1');
          this.form.useremailcnfmon.setValue(date1.getTime());
        }
        else {
          this.form.emailverified.setValue('2');
        }
        this.form.emailverified.updateValueAndValidity();
      });
    }
    // this.disableSubmitButton = false;
    
  }

  submitUserDtls() {
    this.spinnerButtonOptionssaveupdate.active = true;
    // console.log(this.form.emailverified.value);
    
    if(this.isfocalpoint == 2)
    {
      this.form.userdesig.setValidators(null);
      this.form.name.setValidators(null);
      this.form.usercontact.setValidators(null);
      this.form.useremailcnfmon.setValidators(null);
    }
    
    if (this.AccEditForm.valid && this.form.emailverified.value == 1) {
      this.disableSubmitButton = true;
      this.accService.saveUserDtls(this.AccEditForm.value).subscribe(response => {
         this.getAccountsettingsdtls();
         setTimeout(() => {
          this.disableSubmitButton = false;
          },2000);
        if(this.train == 1) {

          
         // this.router.navigate(['/trainingcentremanagement/maincentre'] ,{ queryParams: { id: 1 }});
            if(this.type == 0){
              if(this.getPk == 1) {
                this.router.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { p: this.secuirty.encrypt(1)}});
              }else {
                this.router.navigate(['trainingcentremanagement/rascentre'],{ queryParams: { p: this.secuirty.encrypt(4)}});
              }
              
            }else if(this.type ==1){
              if(this.getPk == 1) {
                this.router.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { p: this.secuirty.encrypt(1),renew:this.secuirty.encrypt(1)}});
    
              }else {
                this.router.navigate(['trainingcentremanagement/rascentre'],{ queryParams: { p: this.secuirty.encrypt(4),renew:this.secuirty.encrypt(1)}});
              }
                
            }
            // console.log(123456)
          } else {
            this.router.navigate(['accountsettings/home']);
            // console.log(1234567)
          }
      });
      
    }
    else if(this.form.emailverified.value != 1){
      this.form.emailverified.setErrors({ NotVerified: true });
    }
    this.spinnerButtonOptionssaveupdate.active = false;
  }

  checkemailexists(value)
  {
    if( this.email !== value)
    {
      this.regService.checkEmail(value, this.pk, '2').subscribe(data => {
        if (data['data'].available) {
          this.form.useremailid.setErrors({ alreadyavailable: true });
          return false;
        }
      });
    }
  }

  checkemail() {
    if( this.email !== this.form.useremailid.value)
    {
    this.form.emailverified.setValue('2');
    this.form.emailverified.updateValueAndValidity();
    }
    else{
      this.form.emailverified.setValue('1');
    this.form.emailverified.updateValueAndValidity();
    }
  }

  backtoaccount() {
    swal({
      title: this.i18n('twofactor.doyoucancl'),
      text: this.i18n('twofactor.ifyesanyunsave'),
      icon: 'warning',
      className: this.dir =='ltr'?'swalEng':'swalAr',
      buttons: [this.i18n('twofactor.no'), this.i18n('twofactor.yes')],
    }).then((willGoBack) => {
      if (willGoBack) {
        this.getAccountsettingsdtls();
        this.disableSubmitButton = true;
        // this.router.navigate(['accountsettings/home']);
        if(this.train == 1) {
          if(this.getPk == 1) {
            this.router.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { p: this.secuirty.encrypt(1),id:this.secuirty.encrypt(1)}});
          }else {
            this.router.navigate(['trainingcentremanagement/rascentre'],{ queryParams: { p: this.secuirty.encrypt(4),id:this.secuirty.encrypt(1)}});
          }
          } else {
            this.router.navigate(['accountsettings/home']);
          }
          setTimeout(() => {
            this.disableSubmitButton = false;
            },2000);
      }
    });
    
  
  }
  viewinvoice() {
    this.routeid.queryParams.subscribe(params => {
      this.train = this.security.decrypt(params['id']);
      this.type = this.security.decrypt(params['type']);
    });
   }
   getDropData() {
    this.getPk= localStorage.getItem('projectPk');
   }
}
