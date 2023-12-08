import {Component, HostListener, OnInit, ViewChild, ViewEncapsulation} from '@angular/core';
import { FormGroup, Validators, FormBuilder, FormControl } from '@angular/forms';
import {ActivatedRoute, Router} from '@angular/router';
import { OwlOptions } from 'ngx-owl-carousel-o';
import Keyboard from 'simple-keyboard';
import { MustMatch } from '@app/common/directives/must-match.validator';
import { Encrypt } from '@app/common/class/encrypt';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { VirtualKeyboardComponent } from '../virtual-keyboard/virtual-keyboard.component';
import { AdminService } from '../admin.service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Title } from '@angular/platform-browser';
import { RegistrationService } from '@app/modules/registration/registration.service';
@Component({
  selector: 'app-setpassword',
  templateUrl: './setpassword.component.html',
  styleUrls: ['./setpassword.component.scss'], 
  encapsulation: ViewEncapsulation.None,
})
export class SetpasswordComponent implements OnInit {
  currentyear: number = new Date().getFullYear();
  @ViewChild('vk') vk :VirtualKeyboardComponent;
  @ViewChild('vk1') vk1 :VirtualKeyboardComponent;
  keyboard: Keyboard;
  showKeyboard: boolean = false;
  languagecode: any = null;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  public projectName: string;
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
    autoHeight:true,
    items:1,
    dots: true,
    navSpeed: 1000,
    nav: false
  }
  difffocal: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  setpasswordForm: FormGroup;  
  template: string ;
  encryptedUserPk: string;
  encryptedDateTime: string;
  isnumber: boolean = false;
  issmallcase: boolean = false;
  isuppercase: boolean = false;
  issymbol: boolean = false;
  showPwdCtrl: FormControl = new FormControl();
  validationCount: number = 0;
  pageHeading: string = 'Set your password';
  pageFor: string;
  is2facpage: string;
  pwdChangedOn: any;
  setorreset:any = 'reset';
 mailid:any ;
 maskmail:any;
 pk_user:any;
  passwordbtn: string = 'Set Password';
  title: string = 'OPAL - Set Password';
  regpk: any;
  regcancel: any;
  constructor(private fb: FormBuilder,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute,
    private adminservice: AdminService,
    private regService: RegistrationService,
    private titleService: Title,
    private security: Encrypt,
    private router: Router) { 
    }
    spinnerButtonOptions: MatProgressButtonOptions = {
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

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr" 

  @HostListener('keydown', ['$event']) blockKeydown(e: KeyboardEvent) {
    var patt = new RegExp(/[^\s]+(\s+[^\s]+)*$/g);
    var res = patt.exec(e.key);
    if(res == null){
      e.stopImmediatePropagation();
      e.preventDefault();
    }
  }

  
  opennewpasswordKeyboard()
  {

    this.vk.showKeyboard = !this.vk.showKeyboard;
    this.vk.initializeKeyboard()

    if(this.vk.showKeyboard)
    {
      this.vk1.showKeyboard=false;
    }
  }
  openconfirmpasswordKeyboard()
  {
    this.vk1.showKeyboard = !this.vk1.showKeyboard;
    this.vk1.initializeKeyboard()

    if(this.vk1.showKeyboard)
    {
      this.vk.showKeyboard=false;
    }
  }
  
  get newPasswordControl() {
    return this.setpasswordForm.controls['password'];
  }

  get confirmPasswordControl() {
    return this.setpasswordForm.controls['confirmpassword'];
  }
  
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.languagecode = toSelect.languagecode;
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.spinnerButtonOptions.text = 'Submit';
      } else {
        this.spinnerButtonOptions.text = 'إرسال';
      }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.languagecode = toSelect.languagecode;
      this.spinnerButtonOptions.text = 'Submit';

    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.languagecode = toSelect.languagecode;
        if (toSelect.languagecode == 'en') {
          this.spinnerButtonOptions.text = 'Submit';
          this.pageHeading = (data.f == 'outdate') ? 'Change Password' : 'Reset your Password' ;
          this.pageHeading = (data.en) ? 'Set your Password' : 'Reset your Password' ;
         
          this.passwordbtn = (data.en) ? this.spinnerButtonOptions.text = 'Submit' :  this.spinnerButtonOptions.text = 'Submit' ;
       
        } else {
          // alert(toSelect.languagecode)
          this.spinnerButtonOptions.text = 'إرسال';
          this.pageHeading = (data.f == 'outdate') ? 'Change Password' : 'اعد ضبط كلمه السر' ;
          this.pageHeading = (data.en) ? 'تعيين كلمة المرور' : 'اعد ضبط كلمه السر' ;
          // this.title = this.setorreset == 'set'? 'OPAL - Set Password' : 'OPAL - Reset Password2' ;
          // this.titleService.setTitle(this.title);
          this.passwordbtn = (data.en) ? this.spinnerButtonOptions.text = 'إرسال' :  this.spinnerButtonOptions.text = 'إرسال' ;
       
        }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.languagecode = toSelect.languagecode;
        this.spinnerButtonOptions.text = 'Submit';
        this.pageHeading = (data.f == 'outdate') ? 'Change Password' : 'Reset your Password' ;
        this.pageHeading = (data.en) ? 'Set your Password' : 'Reset your Password' ;
        // this.title = (data.en)  ? 'OPAL - Set Password' : 'OPAL - Reset Password' ;
        // this.titleService.setTitle(this.title);
        this.passwordbtn = (data.en) ? this.spinnerButtonOptions.text = 'Submit' :  this.spinnerButtonOptions.text = 'Submit' ;
     
      }
  });
    this.projectName=this.bgiConfigJson.projectName;
    this.setpasswordForm = this.fb.group({
      password: ['', [Validators.required, Validators.minLength(8), this.validateInput.bind(this)]],
      confirmpassword: ['', Validators.required],
    }, {
      validator: MustMatch('password', 'confirmpassword')
    });

    this.activatedRoute.queryParams.subscribe(data => {
      this.encryptedUserPk = data.pk;
      this.encryptedDateTime = data.t;
      this.pageFor = data.f;
      this.is2facpage = data.en;
      this.regcancel = data.cancel;
      this.regpk = data.regpk;
      this.difffocal = data.diff;
      console.log(this.regcancel);
      if(this.regcancel)
      {
        console.log('dfgdf')
        this.regService.cancelRegistration(this.regpk).subscribe(res => {
                  if(res.data.status == 1)
                  {
                    this.template = 'cancelreg';
                  }
                  
        });
      }
      else
       {
            this.template = 'setpassword';
            }
      if(data.type == 'set'){
        this.setorreset = data.type;
      }else{
        this.setorreset ='reset';
      }
      this.title = this.setorreset == 'set'? 'OPAL - Set Password' : 'OPAL - Reset Password' ;
      this.titleService.setTitle(this.title);
      // console.log(this.languagecode)
      // if(this.languagecode == 'en'){
      //   this.pageHeading = (data.f == 'outdate') ? 'Change Password' : 'Reset your password' ;
      // this.pageHeading = (data.en) ? 'Set your password' : 'Reset your password' ;
      // this.title = (data.en)  ? 'OPAL - Set Password' : 'OPAL - Reset Password' ;
      // this.titleService.setTitle(this.title);
      // this.passwordbtn = (data.en) ? this.spinnerButtonOptions.text = 'Submit' :  this.spinnerButtonOptions.text = 'Submit' ;
      // }else{
      //   this.pageHeading = (data.f == 'outdate') ? 'Change Password' : 'Reset your password' ;
      // this.pageHeading = (data.en) ? 'Set your password' : '45' ;
      // this.passwordbtn = (data.en) ? this.spinnerButtonOptions.text = 'التقديم' :  this.spinnerButtonOptions.text = 'التقديم' ;
      // this.title = (data.en)  ? 'OPAL - Set Password' : 'OPAL - Reset Password' ;
      // this.titleService.setTitle(this.title);
      // }
      
    });
    if(this.encryptedUserPk && this.encryptedDateTime)
    {
      this.adminservice.checkValidResetLink(this.encryptedUserPk,this.encryptedDateTime).subscribe(data => {
        this.mailid = data['data'].email;
        this.maskmail=data['data'].maskemail;
        this.pk_user = data['data'].data;
        if (data['data'].status === 2) {
          this.template = 'expired';
        } else if (data['data'].status === 3) {
          this.template = 'already_reset';
        } else {
          this.template = 'setpassword';
          this.pwdChangedOn = data['data'].pwdchangedon;
        }
      });
    }
    
  }
  lang = '1';
  setLanguageFlag(value) {  
    this.lang =  value=='1'? '2': '1'; 
    const toSelect = this.languagelist.find(c => c.id === this.lang);
    this.cookieService.set('languageCookieId', toSelect.id);  
    this.cookieService.set('languageCode', toSelect.languagecode); 
    this.cookieService.set('dir', toSelect.dir); 
    this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    this.remoteService.languageCookieValue(toSelect);
}
  onSubmit() {
    if (this.setpasswordForm.valid) {
      this.spinnerButtonOptions.active = true;
      this.vk.showKeyboard = false;
      this.vk1.showKeyboard = false;
      let encryptPassword = this.security.aesencrypt(this.password);
      this.adminservice.resetPassword(this.encryptedUserPk, encryptPassword,'email',this.difffocal).subscribe(data => {
        this.setpasswordForm.setErrors(null);
        if (data['data'].status == 1) {
          this.template = 'successnew';
        } else if (data['data'].status == 2) {
          this.setpasswordForm.controls['confirmpassword'].setErrors({usernameSame: true});
        } else if (data['data'].status == 3) {
          this.setpasswordForm.controls['confirmpassword'].setErrors({oldPassword: true});
        }
        this.spinnerButtonOptions.active = false;
      });
    }
    else{
      this.spinnerButtonOptions.active = false;
    }
  }
  public forgotpassval = "forgot";
  routeTo() {
      this.router.navigate(['admin/login'], { queryParams: { fpval: this.forgotpassval,maill:this.mailid,maskmail:this.maskmail,pk:this.pk_user }});
  }
  checkfactor()
  {
    if(this.is2facpage)
    {
     
      this.template = 'weareenable';
    }
    else
    {
     
      this.router.navigate(['admin/login']);
    }
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
     console.log(this.validationCount);
      return {};
    }
  }

  get password() {
    return this.setpasswordForm.controls['password'].value;
  }

  get passwordFieldCtrl() {
    return this.setpasswordForm.controls['password'];
  }

}
