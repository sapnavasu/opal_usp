import { HttpClient } from '@angular/common/http';
import { ChangeDetectorRef, Component, EventEmitter, Input, OnInit, Output, SimpleChanges, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { CountryService } from '@app/common/newcountry/service/country.service';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { common_var } from '@env/common_veriables';
import { environment } from '@env/environment'; 
import { Observable, of } from 'rxjs';
import 'rxjs/add/observable/of';
import { map } from 'rxjs/internal/operators/map';

import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import swal from 'sweetalert';
import { UserallocationComponent } from '../sidepanel/userallocation/userallocation.component';
import { AdddepartmentComponent } from '@app/@shared/adddepartment/adddepartment.component';
import { SharedService } from '../shared.service';
import { ToastrService } from 'ngx-toastr'
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { Router } from '@angular/router';
import { MatProgressButtonOptions } from 'mat-progress-buttons';

export interface countryflag {
  value: string;
  viewValue: string;
}
export interface status {
  value: string;
  viewValue: string;
}

export interface genderselect {
  value: string;
  viewValue: any;
}
export interface designationselect {
  value: string;
  viewValue: any;
}

interface Deplist {
  value: string;
  viewValue: string;
}

interface Deplistgroup {
  disabled?: boolean;
  name: string;
  department: Deplist[];
}
@Component({
  selector: 'app-addinguser',
  templateUrl: './addinguser.component.html',
  styleUrls: ['./addinguser.component.scss'],
  providers: [CountryService],
  encapsulation: ViewEncapsulation.None,
  styles: [
    `      
      img.ng-lazyloaded {
        animation: fadein 0.5s;
      }     
      @keyframes fadein {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
    `
  ],
})



export class AddinguserComponent implements OnInit {
  iseditdisableforflag: boolean = false;
  userPermissionsActivityLogs: any[] = [];
  i18n(key){
    return this.translate.instant(key);
  }
  spinnerButtonOptions: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  spinnerButtonOptionsmobile: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  public Ucontentplaceloader = false;
  public submiteddataotp: boolean = false;
  public verfiedtagshowmobile: boolean = false;
  public timeremail;
  public timermobile;
  depgroups: Deplistgroup[] = [
    {
      name: 'Grass',
      department: [
        { value: 'bulbasaur-0', viewValue: 'Bulbasaur' },
        { value: 'oddish-1', viewValue: 'Oddish' },
        { value: 'bellsprout-2', viewValue: 'Bellsprout' }
      ]
    },
    {
      name: 'Water',
      department: [
        { value: 'squirtle-3', viewValue: 'Squirtle' },
        { value: 'psyduck-4', viewValue: 'Psyduck' },
        { value: 'horsea-5', viewValue: 'Horsea' }
      ]
    },
    {
      name: 'Fire',
      disabled: true,
      department: [
        { value: 'charmander-6', viewValue: 'Charmander' },
        { value: 'vulpix-7', viewValue: 'Vulpix' },
        { value: 'flareon-8', viewValue: 'Flareon' }
      ]
    },
    {
      name: 'Psychic',
      department: [
        { value: 'mew-9', viewValue: 'Mew' },
        { value: 'mewtwo-10', viewValue: 'Mewtwo' },
      ]
    }
  ];
  public dataSource2 = new MatTableDataSource();
  animationState = "out";
  animationState1 = "out";
  public userdetailsformval: any = [];
  public contentinputloader = false;
  public submitbtnhide: boolean = true;
  searchMobileCC: any;
  @Input() yesornoshow: boolean = false;
  mobilecode: any = common_var.libyaDialCode;
  landlinecode: any = common_var.libyaDialCode;
  @ViewChild('draweruserallocation') draweruserallocation: MatDrawer;
  @ViewChild("addbusinessunitmcp") addbusinessunitmcp: MatDrawer;
  @ViewChild("drawerdepartment") drawerdepartment: MatDrawer;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('refBunitDept') refBunitDept: AdddepartmentComponent;
  public postParams: any;
  public postUrl: any;
  public mcpPk: any = '';
  public departmentList: any = [];
  public designationlist: any;
  countrylist: any[] = [];
  mobile_country_code_flag: number = common_var.libyaPk;
  public editDepartment: boolean = true;
  searchDepartment: string;
  searchCountryFlag: string;
  landline_country_code_flag: number;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  searchLandLineCC: string = '';
  selectedEstCountry: string;
  public maxLen: number;
  countryflag: countryflag[] = [
    { value: 'Oman', viewValue: './assets/images/companyprofile.png' },
    { value: 'India', viewValue: 'India' },
  ];
  status: status[] = [
    { value: 'active', viewValue: 'Active' },
    { value: 'inactive', viewValue: 'Inactive' },
  ];
  genderselect: genderselect[] = [
    { value: 'male', viewValue: 'Male' },
    { value: 'inactive', viewValue: 'Female' },
  ];

  designationselect: designationselect[] = [
    { value: 'Asst. Prof', viewValue: 'Asst. Prof' },
    { value: 'HOD', viewValue: 'HOD' },
  ];
  searchDept: string = '';
  adduserForm: FormGroup;
  @Output() addUserData: any = new EventEmitter<any>();
  @Output() reloadAccountsetting:any = new EventEmitter<any>();
  @Output() toggleModulepermission: any = new EventEmitter<any>();
  @Output() updateUserData: any = new EventEmitter<any>();
  @Output() change: any = new EventEmitter<any>();
  @Output() closeSideNav: any = new EventEmitter<any>();
  @Output() hideResponseLoader: any = new EventEmitter<any>();
  @Output('showLoaderview') showLoaderview: any = new EventEmitter<any>();
  public userPermission: any = [];
  public swalData: any;
  @ViewChild('addUpdateAccess') addUpdateAccess: UserallocationComponent;
  @Output() editDeptData: any = new EventEmitter<any>();
  @Output() isdisableclosebtn: any = new EventEmitter<any>();
  @Output() openDeptSideNav: any = new EventEmitter<any>();
  @Input() forContact: boolean = false;
  @Input() hideBusinessUnit: boolean = false;
  @Input() showAddDept: boolean = false;
  @Input() hideUserSuccessPopup: boolean = false;
  @Input() businessUnitContact: any;
  @Input() userGeoDialCode: string;
  @Input() userGeoCountryPk: number;
  @Input() hideModuleAccess: boolean = false;
  loadUserAllocation: boolean = true;
  @Input() compid: any;
  @Input()fromwhere:number=2;
  @Input()fromwheremobile:number=2;
  @Input() requesterType: any = 'Requester';
  @Input() stkholdertype: any;
  @Input() valid: any;
  @Input() nameofvalidation: any = 0;
  public deptPk: any = '';
  businessunitlist: any;
  timezonelist: any;
  searchTimezone: string = '';
  businessUnitDataTemp: any;
  deptDataTemp: any;
  previousFormValue: any[] = [];
  @Input() popupContentPrefix: string;
  iseditdisable: boolean = false;
  iseditdisable1: boolean = false;// deprecated
  isshowadddivordept: boolean = true;
  disableResendemail :boolean = false;
  disableResendmob :boolean = false;
  public countDown:any='00:00';
  public countDownMob:any='00:00';
  public duration:any;
  @Input() lusrtpye :any;
  /*Sar Starts*/
  public bunitData: any;
  @Input() addUserFromType: number = 1;
  @Input() triggercountrymst: number;
  public userType: any = '';
  fromstake: number;
  businessUnitDetails: BusinessUnitDetails;
  resultsLength: any;
  companypk: any;
  public currentUserPk: any = '';
  public emailMobileOtpdisabled : boolean = false;
  public showeditbtn: boolean = true;
  public showeditbtnmobile: boolean = true;
  public checknationaluser: boolean = true;
  public disableuserformval: boolean = true;
  public otpviewfield: boolean = false;
  @Input() enableformvalue: boolean = false;
  public addreadonly:boolean = false;
  public addreadonlyMobile:boolean = false;
  public disableSubmitButton:boolean = false;
  public iferrorotpmail  : boolean = false;
  verfiy: boolean = false;
  verfiedtagshow: boolean = false;
  otpshowmobile: boolean = false;
  verfiymobile: boolean = false;
  iferrorotp  : boolean = false;
  public formSubmitted = false;

  constructor(
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private localstorage: AppLocalStorageServices,
    private encrypt: Encrypt,
    private countryService: CountryService,
    private cdr: ChangeDetectorRef,
    private http: HttpClient,
    public sharedservice: SharedService,
    public toastr: ToastrService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private myRoute: Router,
    protected regService: RegistrationService,
  ) { 
  }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 
 
  setcountryFlag(value, type?: string) {

    if(value == 31){
      this.maxLen = 8;
    } else {
      this.maxLen = 20;
    }

   

    if (type == 'mobile') {
      if(this.userType == 'A') {
          this.iseditdisableforflag = false;
          this.adduserForm.controls['mobileno'].setValue('');
      }
      if(this.addUserFromType == 1) {
        this.iseditdisableforflag = false;
        this.adduserForm.controls['mobileno'].setValue('');
      }
      this.mobile_country_code_flag = value;
      if(this.mobile_country_code_flag != 31){
        this.adduserForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(5), Validators.maxLength(20)])
        this.verfiymobile = false;
        this.addreadonlyMobile = false;
       this.showeditbtnmobile = false;
       
      }else{
        this.adduserForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(8), Validators.maxLength(8)])
        this.verfiymobile = false;
        this.addreadonlyMobile = false;
        this.showeditbtnmobile = false;
      }

      this.adduserForm.controls['mobileno'].updateValueAndValidity();

      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.adduserForm.controls['mobilecc'].setValue(x.CountryMst_Pk);
          this.mobilecode = x.dialcode;
        }
      });
    } else {
      this.adduserForm.controls['landlineno'].setValue('');
      this.landline_country_code_flag = value;

      if(this.landline_country_code_flag != 31){
        this.adduserForm.controls['landlineno'].setValidators([Validators.minLength(5), Validators.maxLength(20)])
      }else{
        this.adduserForm.controls['landlineno'].setValidators([Validators.minLength(8), Validators.maxLength(8)])
      }
      
      this.adduserForm.controls['landlineno'].updateValueAndValidity();

      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.adduserForm.controls['landlinecc'].setValue(x.CountryMst_Pk);
          this.landlinecode = x.dialcode;
        }
      });
    }
  }
  public ngOnChanges(changes: SimpleChanges) {
    this.userPermissionsActivityLogs = [];

    if(changes['triggercountrymst'] != undefined) {
      if (this.triggercountrymst == 2) {
        this.getCountryList();
      }
    }
    if(changes['addUserFromType'] != undefined && changes['addUserFromType'].firstChange == false) {
      this.userPermissionsActivityLogs.length == 0 && this.userType != 'A' ? this.setCustomInputEable():'';
      this.userType == 'A' ? this.setCustomInputEable():'';
    }
  }
  setCustomInputEable() {
    if(this.adduserForm != undefined) {
      if(this.addUserFromType != 1)  {
        this.adduserForm.controls['mobileno'].disable();
        this.iseditdisableforflag = true;
        this.adduserForm.controls['email'].disable();
      } 
      else {
        this.adduserForm.controls['mobileno'].enable();
        this.iseditdisableforflag = false;
        this.adduserForm.controls['email'].enable();
      } 
    }
  }
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
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
    if (this.valid == 1 || this.valid == 2 || this.valid == 3 || this.valid == 4) {
      this.fromstake = 1;
      this.iseditdisable = true;
      this.isshowadddivordept = false;
    } else {
      this.fromstake = 2; // other than superadmin
      this.iseditdisable = false;
      this.isshowadddivordept = true;
    }
    this.dataSource2.sort = this.sort;
    if (this.compid) {
      this.mcpPk = this.encrypt.encrypt(this.compid);
    } else {
      this.mcpPk = this.encrypt.encrypt(this.localstorage.getInLocal('comp_pk'));
    }

    this.adduserForm = this.formBuilder.group({
      userPk: [null, null],
      employeeid: [null, [Validators.required]],
      username: [null, [Validators.required]],
      firstName: [null, Validators.required],
      lastName: [null, Validators.required],
      middleName: [null, null],
      email: [{value:null, disabled:false}, [Validators.required]],
      departmentId: [null, Validators.required],
      designation: [null, Validators.required],
      division: [null, null],
      designationLevel: [null, null],
      businessunit: [null, Validators.required],
      branchname: [null, null],
      timezone: [null, null],
      mobilecc: [{value:this.mobilecode, disabled:false}, Validators.required],
      mobileno: [{value:null, disabled:false}, [Validators.required]],
      landlinecc: [this.landlinecode, ''],
      landlineno: [''],
      landlineext: ['', ''],
      mobileotp: ['', ''],
      emailotp: ['', '']
    });
    this.setcountryFlag(31, 'mobile');
    this.setcountryFlag(31);
    this.adduserForm.controls['mobilecc'].setValue(31);
    this.adduserForm.controls['landlinecc'].setValue(31);
    this.mobilecode = '+968';
    this.landlinecode = '+968';  
    this.getBusinessList();
    this.getTimeZoneList();
    this.getDivisionData();
    
    this.adduserForm.controls['employeeid'].valueChanges.debounceTime(400).subscribe(data => {
      if (data && data != null && data.length != 0) {
        this.chkValidEmployeeId(data);
      }
    });
    this.adduserForm.controls['email'].valueChanges.debounceTime(400).subscribe(data => {
      if (data && data != null && data.length != 0 && (this.adduserForm.controls['email'].errors?.pattern==null || this.adduserForm.controls['email'].errors?.pattern==undefined)) {
        this.chkValidemailId(data);
      }
    });
    this.adduserForm.controls['username'].valueChanges.debounceTime(400).subscribe(data => {
      if (data && data != null && data.length != 0) {
        this.chkUserName(data);
      }
    });
    this.adduserForm.valueChanges.subscribe(
      function (data) {
          this.customValidationCheck();
      }.bind(this)
    );

    this.adduserForm.controls['departmentId'].valueChanges.subscribe(value => {
      setTimeout(function () {
        if (value) {
          let index = this.departmentList.findIndex(x => x.deptPk == value[0]);
          if (index !== -1) {
            this.deptDataTemp = this.departmentList[index].deptName;
          }
        }
      }.bind(this), 1000);
    });

    this.adduserForm.controls['businessunit'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.bunitData.findIndex(x => x.bunitPk == value[0]);
        if (index !== -1) {
          this.businessUnitDataTemp = this.bunitData[index].bunitName;
        }
        this.adduserForm.controls['departmentId'].reset();
        this.contentinputloader = true;
        this.postParams = {
          'bUnitPk': value
        };
        this.postUrl = 'ea/department/fetch-department-by-bunit';
        this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
          function (data) {
            if (data['data'].status == 100) {
              this.departmentList = data['data'].data.bunitDeptData;
              if (this.userdetailsformval && this.nameofvalidation != 0) {
                this.adduserForm.controls['departmentId'].setValue((this.userdetailsformval.departmentPk !== null) ? this.userdetailsformval.departmentPk.split(",") : []);
              }
              this.contentinputloader = false;
            } else {
              this.contentinputloader = false;
            }
          }.bind(this)
        );
      } else {
        this.businessUnitDataTemp = '';
      }
    });
    if (this.compid) {
      this.companypk = this.compid;
    } else {
      this.companypk = this.localstorage.getInLocal('comp_pk');
    }
    this.getbusinessInput();
  }
  submitdtataotp(){
    this.verifyotpdata(this.adduserForm.controls.email.value, this.adduserForm.controls.emailotp.value, 'email', this.encrypt.encrypt(this.adduserForm.controls.userPk.value));
  }

  verifyotpdata(value, otp, type , usrPk) {
    this.regService.verifyotpdatadb(value, otp, type,usrPk).subscribe(data => {
      if (data['data'].flag == 1) {
          if(type == 'email'){
            this.verfiedtagshow = true;   
            this.otpviewfield = false;
            this.countDown ='00:00';
            this.timerStopEmail();
            this.adduserForm.controls.emailotp.setValue('');
            this.showeditbtn = true;
            this.addreadonly = true;
            this.disableResendemail = false;
            if( this.verfiy != true){
              this.addUserData.emit(1);
          }
            
          }
          if(type == 'mobile'){
          this.otpshowmobile = false;
          this.verfiedtagshowmobile = true;
          this.addreadonlyMobile = true;
          this.showeditbtnmobile=true;
          this.disableResendmob = false;
          this.countDown ='00:00';
          this.adduserForm.controls.mobileotp.setValue('');

          this.timerStopMobile();
          if(this.verfiymobile != true){
            this.addUserData.emit(1);
          }
        }
      }
      else {
        if(type == 'email'){
        this.iferrorotpmail =true;
        this.adduserForm.controls.emailotp.setErrors({ invalidOTP: true });
        }
        if(type == 'mobile'){
          this.iferrorotp = true;
          this.adduserForm.controls.mobileotp.setErrors({ invalidOTP: true });
        }

      }
    });
  }
  


  otpshowdatamobiledata() {
  if (1) {
    this.spinnerButtonOptionsmobile.active = true;
    this.sendverifyotp(this.adduserForm.controls.mobileno.value, 'mobile', this.encrypt.encrypt(this.adduserForm.controls.userPk.value));
    this.formSubmitted = false;
    this.addreadonlyMobile = true;
    this.addUserData.emit('I');
  }
  else {
    this.adduserForm.controls.email.setErrors({ required: true });
    this.formSubmitted = true;
  }

  }
  editdataotp(){
     
        if(this.userType == 'A'){
          this.adduserForm.controls['email'].enable();
          this.showeditbtn = false;
          this.addreadonly = false;
          this.addUserData.emit('I');
       }
  }
  submitdatamobile() {
    this.verifyotpdata(this.adduserForm.controls.mobileno.value, this.adduserForm.controls.mobileotp.value, 'mobile', this.encrypt.encrypt(this.adduserForm.controls.userPk.value));

  }
  editdatamobileotp(){
    if(this.userType == 'A'){
      this.iseditdisableforflag = false;
      this.adduserForm.controls['mobileno'].enable();
      this.addreadonlyMobile = false;
      this.showeditbtnmobile = false;
      this.addUserData.emit('I');
    
   }
  
  }

  otpshowdata() {
    if (1) {
      this.spinnerButtonOptions.active = true;
      this.sendverifyotp(this.adduserForm.controls.email.value, 'email', this.encrypt.encrypt(this.adduserForm.controls.userPk.value));
      this.formSubmitted = false;
      this.addreadonly = true;
      this.addUserData.emit('I');
      
    }
    else {
      this.adduserForm.controls.email.setErrors({ required: true });
     this.formSubmitted = true;

    }

  }

  sendverifyotp(value: any, type: any,pk :any) {

    this.regService.sendverifyotpdb(value, type, pk).subscribe(data => {
      this.duration = data.data.duration;
      
      if(type == 'email'){
      this.timer(15,type);
      this.verfiy = false;
      this.disableResendemail = true;
      this.otpviewfield = true;
      this.spinnerButtonOptions.active = false; 
      }
      if(type == 'mobile'){
        this.timermob(15,type);
        this.verfiymobile = false;
        this.disableResendmob  = true;
        this.otpshowmobile = true;
        this.spinnerButtonOptionsmobile.active = false;
      }
    });

  }

  timer(minute,type) {
    let seconds: number = minute * 60;
    let textSec: any = "0";
    let statSec: number = 60;

    const prefix = minute < 10 ? "0" : "";
    this.timeremail = setInterval(() => {
      seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;

      if (statSec < 10) {
        textSec = "0" + statSec;
      } else textSec = statSec;

      // if(type == 'mobile')
      //   {
      //     this.countDownMob = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
      //   }
        // else if(type == 'mobile'){
          this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
        // }
      

      if (seconds == 0) {
        // if(type == 'mobile')
        // {
        //   this.disableResendmob = false;
        // }
        // else{
          this.disableResendemail = false;
        // }
       
        clearInterval(this.timeremail);
      }
    }, 1000);
  }


  timermob(minute,type) {
    let seconds: number = minute * 60;
    let textSec: any = "0";
    let statSec: number = 60;

    const prefix = minute < 10 ? "0" : "";
    this.timermobile = setInterval(() => {
      seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;

      if (statSec < 10) {
        textSec = "0" + statSec;
      } else textSec = statSec;

      if(type == 'mobile')
        {
          this.countDownMob = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
        }
        // else{
        //   this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
        // }
      

      if (seconds == 0) {
        if(type == 'mobile')
        {
          this.disableResendmob = false;
        }
      
       
        clearInterval(this.timermobile);
      }
    }, 1000);
  }
  timerStopEmail() {
    clearInterval(this.timeremail);
  }
  timerStopMobile() {
    clearInterval(this.timermobile);
  }
  chkValidEmployeeId(dataValue) {
    let postData = {
      'employeeid': dataValue,
      'usrid':this.adduserForm.controls['userPk'].value,
      'stktype':this.stkholdertype
    }
    this.EnterpriseService.checkEmpIdExistOrNot('ea/user/check-emp-id-exist', postData).subscribe(response => {
      if (response?.success) {
        if (response?.data?.data) {
          this.adduserForm.controls.employeeid.setErrors({ empAlreadyExist: true });
        } else {
          this.adduserForm.controls.employeeid.setErrors(null);
        }
      }
    })
  }
  chkValidemailId(dataValue) {
    let postData = {
      'email': dataValue,
      'usrid':this.adduserForm.controls['userPk'].value,
      'stktype':this.stkholdertype
    }
    this.EnterpriseService.checkEmailExistOrNot('ea/user/check-email-exist', postData).subscribe(response => {
      if (response?.success) {
        if (response?.data?.data) {
          this.adduserForm.controls.email.setErrors({ alreadyExist: true });
        } else {
          this.adduserForm.controls.email.setErrors(null);
        }
      }
    })
  }
  chkUserName(dataValue) {
    let postData = {
      'username': dataValue,
      'usrid':this.adduserForm.controls['userPk'].value,
      'stktype':this.stkholdertype
    }
    this.EnterpriseService.checkUsernameExistOrNot('ea/user/check-username-exist', postData).subscribe(response => {
      if (response?.success) {
        if (response?.data?.data) {
          this.adduserForm.controls.username.setErrors({ userAlreadyExist: true });
        } else {
          this.adduserForm.controls.username.setErrors(null);
        }
      }
    })
  }
  getbusinessInput() {
    this.getSectorDtls(this.encrypt.encrypt(this.companypk));
  }

  getSectorDtls(companypk) {
    this.businessUnitDetails = new BusinessUnitDetails(this.http, companypk);
    // If the user changes the sort order, reset back to the first page.
    // this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
    merge()
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.businessUnitDetails!.businessUnitData();
        }),
        map(data => {
          this.resultsLength = data['data'].items.totalcount;
          return data['data'].items.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.dataSource2.data = data;
      });
  }
  get f1() { return this.adduserForm.controls; }
  
  getUserDepartmentList() {
    if (this.stkholdertype == 1) {
      this.postParams = {
        "compPk": this.encrypt.encrypt(this.compid)
      };
    } else {
      this.postParams = {};
    }
    this.postUrl = 'ea/user/get-stakholder-department';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.departmentList = data['data'].data.departmentDetails;
        }
      }.bind(this)
    );
    this.editDepartment = true;
    this.cdr.detectChanges();
    this.addUpdateAccess?.emptyUserNameandRole();
  }

  getCountryList() {
    this.sharedservice.getCountryList().subscribe(data => {
      this.countrylist = data.json().data;
    });
  }

  getBusinessList() {
    this.EnterpriseService.getBusinessList().subscribe(data => {
      this.businessunitlist = data['data'].items;
    })
  }

  getTimeZoneList() {
    //this.stkholdRegService.getTimeZoneList().subscribe(data => this.timezonelist = data['data']);

  }

  onSubmit(addUserFromType = 1) {
    if (this.userPermission.length > 0 || this.userType == 'A' || this.stkholdertype == 1) {
      this.contentinputloader = true;
      this.postParams = {
        "mcpPk": this.mcpPk,
        "empId": this.adduserForm.controls['employeeid'].value,
        "userPk": this.adduserForm.controls['userPk'].value,
        "userName": this.adduserForm.controls['username'].value,
        "fName": this.adduserForm.controls['firstName'].value,
        "lName": this.adduserForm.controls['lastName'].value,
        "mName": this.adduserForm.controls['middleName'].value,
        "emailId": this.adduserForm.controls['email'].value,
        "phCntryCode": this.adduserForm.controls['mobilecc'].value,
        "phoneNumber": this.adduserForm.controls['mobileno'].value,
        "lnPhoneCode": this.adduserForm.controls['landlinecc'].value,
        "lnPhoneNumber": this.adduserForm.controls['landlineno'].value,
        "lnPhoneExt": this.adduserForm.controls['landlineext'].value,
        "department": this.adduserForm.controls['departmentId'].value,
        "division": this.adduserForm.controls['division'].value,
        "designationLevel": this.adduserForm.controls['designationLevel'].value,
        "businessUnit": this.adduserForm.controls['businessunit'].value,
        "branchName": this.adduserForm.controls['branchname'].value,
        "timezone": this.adduserForm.controls['timezone'].value,
        "designation": this.adduserForm.controls['designation'].value,
        "userAccess": this.userPermission,
        
        "forContact": this.forContact,
        "addUserFromType": addUserFromType,
        "fromstake": this.fromstake,
        "nameofvalidation": this.nameofvalidation
      }
      let successMsg = this.popupContentPrefix ? this.popupContentPrefix + this.i18n('commonuser.creasucc')  : this.i18n('commonuser.usercreasucc');

      if (addUserFromType == 3) {
        successMsg = this.popupContentPrefix ? this.popupContentPrefix + this.i18n('commonuser.apprsucc')  :  this.i18n('commonuser.userapprsucc');
      } else if (this.adduserForm.controls['userPk'].value > 0) {
        successMsg = this.popupContentPrefix ? this.popupContentPrefix + this.i18n('commonuser.updasucc') : this.i18n('commonuser.userdetaupda');
      }
      this.postUrl = 'ea/user/save-user';
      this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
        function (data) {
          if (data['data'].status == 0) {
            this.showWSuccess(this.i18n('commonuser.somewentwrong'));
          } else {

            if (data['data'].status == 100) {
              
              this.swalData = {
                "msg": successMsg,
                "status": 'success'
              }
              this.currentUserPk = '';
              this.adduserForm.reset();
              this.setcountryFlag(31, 'mobile');
              this.setcountryFlag(31);
              
              this.departmentList = [];
              if (this.stkholdertype == 1) {
                this.fromstake = 1;
                this.iseditdisable = true;
                this.isshowadddivordept = false;
              }
              if(data['data'].data.twofwarning)
              {
                 swal({
                   title: this.i18n('enterpriseadmin.savewarntitle'),
                   text: this.i18n('enterpriseadmin.savewantext'),
                //  title:  'Update Configuration for Two Factor Authentication',
                //  text: 'Please note that since you have changed the Country Code for your Mobile Number from National (Omani) to International, the Two Factor Authentication has been disabled. You can configure Two Factor Authentication preference as email via ‘Account Settings’.',
                 icon: 'warning',
                 buttons: [false,'Ok']
               })
              }
              this.showTSuccess(successMsg);
              this.closeSideNav.emit(data['data'].data['usermst_pk']);
              this.updateUserData.emit();
              this.showLoaderview.emit(false);
              this.userPermission = [];
              this.moduleClear();
              this.contentinputloader = false;
              this.disableSubmitButton = true;
            
            } else if (data['data'].status == 107) {
              this.currentUserPk = '';
              this.adduserForm.reset();
              this.setcountryFlag(31, 'mobile');
              this.setcountryFlag(31);
              this.userPermission = [];
              this.departmentList = [];
              if (this.stkholdertype == 1) {
                this.fromstake = 1;
                this.iseditdisable = true;
                this.isshowadddivordept = false;
              }
              this.showWSuccess(data['data'].msg);
              this.closeSideNav.emit(1);
              this.updateUserData.emit();
              this.showLoaderview.emit(false);
              this.contentinputloader = false;
             

            } else if (data['data'].status == 108) {

            } else if (data['data'].status == 109) {
              this.showTSuccess(data['data'].msg);
            }
            else {
              this.moduleClear();
              this.contentinputloader = false;
              this.showLoaderview.emit(false);
              if (data['data'].status == '100') {
                this.showTSuccess(data['data'].msg);
              } else {
                this.showWSuccess(data['data'].msg);
              }
              this.contentinputloader = false;
              this.showLoaderview.emit(false);
            }
           
          }
        }.bind(this)
      );
    } else {
      this.contentinputloader = false;
      this.showLoaderview.emit(false);
      this.showWSuccess(this.i18n('commonuser.plesseleuser'));
      this.contentinputloader = false;
      this.showLoaderview.emit(false);

    }
  }


  moduleClear() {
    if (this.addUpdateAccess) {
      this.addUpdateAccess?.fullMOduleCheck();
      this.previousmoduleValue = [];
      this.addUpdateAccess.finalpermissiontempinitialarray = [];
      this.addUpdateAccess.finalpermissiontemparray = [];
      this.addUpdateAccess.finalpermissionarray = [];
      this.userPermission = [];
      this.userPermissionsActivityLogs = [];
    }
  }

  checkIsFormValueEquals() {
    return ((JSON.stringify(this.adduserForm.value) === JSON.stringify(this.previousFormValue)));
  }
  customValidationCheck() {
   
    let isValid: string | number = 1;

    if((this.userdetailsformval.emailId != this.adduserForm.controls['email'].value) && ((this.otpviewfield != true) && (this.verfiedtagshow != true))) {     
      this.verfiy = true;
    } else {
      if(this.checkIsFormValueEquals()) {
        isValid = 'I';
      }
    }
  
 
    if(this.checkIsFormValueEquals() && this.adduserForm.invalid && this.userType == 'A' ) {
      isValid = 'I';      
    } else if(this.checkIsFormValueEquals() && this.adduserForm.valid && this.userType == 'A') {
      isValid = 'I';
    
    }

     if(this.adduserForm.valid && this.userType == 'A') {
    
      if(this.checkIsFormValueEquals() && this.userType == 'A') {
       isValid = 'I';
      }
     
    } else if(this,this.adduserForm.invalid && this.userType == 'A') {
      isValid = 'I';
    }
    if(this.userType == 'A') {

      if((this.userdetailsformval?.emailId == this.adduserForm.controls['email'].value)) {
        if((this.addreadonly && this.adduserForm.invalid) || (!this.addreadonly && this.adduserForm.valid && this.showeditbtn)) {
         
             isValid = 'I';
            
        } else if(!this.addreadonly && this.checkIsFormValueEquals()) {
          isValid = 'I';
        }
        if(this.checkIsFormValueEquals()) {
          isValid = 'I';
        }
        if(this.userdetailsformval?.emailVerfied == "1") {
          this.verfiy = false;
          this.verfiedtagshow = true;
        } else {
          this.verfiy = true;
          this.verfiedtagshow = false;

        }
      }
      if((this.userdetailsformval?.emailId != this.adduserForm.controls['email'].value)) {
        if(!this.addreadonly) {
          this.verfiedtagshow = false;
        }
        if(this.checkIsFormValueEquals()) {
          isValid = 'I';
        }
        if(!this.checkIsFormValueEquals() && this.userType == 'A') {
          isValid = 1;
        }
      }
      if((this.userdetailsformval?.mobileNo != this.adduserForm.controls['mobileno'].value) && (this.otpshowmobile != true) && (this.verfiedtagshowmobile != true)) {
        if(this.mobile_country_code_flag == 31){
        this.verfiymobile = true;
        }
        if(this.mobile_country_code_flag != 31) {
          this.verfiedtagshowmobile = false;
        }
        
        } else {
        if(this.checkIsFormValueEquals()) {
          isValid = 'I';
        }
      
        }
      if((this.userdetailsformval?.mobileNo == this.adduserForm.controls['mobileno'].value)) {

        if(this.mobile_country_code_flag == 31 && this.userdetailsformval?.mobileVerified){
          this.verfiedtagshowmobile = true;
        }
        this.verfiymobile = false;
        if(this.addreadonlyMobile && this.adduserForm.invalid) {

        isValid = 'I';
        }
        } 
         if((this.userdetailsformval.mobileNo != this.adduserForm.controls['mobileno'].value)) {
            if(this.mobile_country_code_flag == 31 && this.checkIsFormValueEquals()){
                isValid = 'I';
            }
            if(!this.addreadonlyMobile) {
              this.verfiedtagshowmobile = false;
            }

        }
      if(this.otpshowmobile == true || this.otpviewfield == true || this.verfiymobile == true || this.verfiy == true){
        isValid = 'I';
      }
      if(this.mobile_country_code_flag != 31){
        this.checknationaluser = false;
        this.verfiymobile = false;
        this.addreadonlyMobile = false;
        if(this.verfiy == true){
          isValid = 'I';
          
        }
      } 
    
    }
    
     // for add 
    if(this.userType != 'A' && this.addUserFromType == 1) {
      if(this.ismoduleUpdateValueChanged) {
        if(this.checkIsFormValueEquals() || this.adduserForm.invalid) {
          isValid = 'I';          
        } 
        else if(this.adduserForm.valid) {
          isValid = 1;          
        }
    } else {
      if(this.checkIsFormValueEquals() || this.adduserForm.invalid) {
        isValid = 'I';        
      } 
      else if(this.adduserForm.valid && !this.ismoduleUpdateValueChanged) {
        isValid = 'I';        
      } else if(this.adduserForm.valid && this.userPermissionsActivityLogs[0] != undefined) {
        isValid = 1;        
      }
    }
    }
    // for update
    if(this.userType != 'A' && this.addUserFromType != 1) {
      if(!this.checkIsFormValueEquals() && !this.ismoduleUpdateValueChanged && this.adduserForm.valid && this.isFormValueChanged) {
        isValid = 1;
      } else if(this.checkIsFormValueEquals() && !this.ismoduleUpdateValueChanged && this.adduserForm.valid) {
        isValid = 'I';
      } else if(!this.ismoduleUpdateValueChanged && this.adduserForm.valid && this.isFormValueChanged) {
        isValid = 1;
      } else if(this.ismoduleUpdateValueChanged && this.checkIsFormValueEquals() && this.adduserForm.invalid) {
        isValid = 'I';
      } else if(this.checkIsFormValueEquals() && !this.ismoduleUpdateValueChanged && this.adduserForm.invalid) {
        isValid = 'I';        
      } else if(this.checkIsFormValueEquals() && this.ismoduleUpdateValueChanged) {
        isValid = 1;
      } else if((this.checkIsFormValueEquals() && !this.ismoduleUpdateValueChanged && this.adduserForm.invalid)) {
         isValid = 'I';
        }else if(this.adduserForm.invalid) {
          isValid = 'I';
        }
      
    }      
     this.addUserData.emit(isValid);      
  }
  validationCheck() {
    let isValid: string | number = 'I';

    if ((this.adduserForm.valid && !this.previousFormValue) || (this.previousFormValue && !this.isFormValueChanged)) {
      isValid = this.adduserForm.invalid ? 'I' : 1;
    }

 
    if(this.otpshowmobile == true || this.otpviewfield == true || this.verfiymobile == true || this.verfiy == true){
      isValid = 'I';
    }
    
    if(this.showeditbtn == true  && this.showeditbtnmobile == true){
      
      isValid = 1;
    }
    if(this.mobile_country_code_flag != 31){
      this.checknationaluser = false;
      this.verfiymobile = false;
      this.addreadonlyMobile = false;
      isValid = 1;
      if(this.verfiy == true){
        isValid = 'I';

      }
      }

    this.addUserData.emit(isValid);

  }
  userpermvalidationCheck() {
    let isValid: string | number = 'I';
    if ((this.userType == 'A' && ((this.adduserForm.valid && !this.previousFormValue) || (this.previousFormValue && this.isFormValueChanged))) ||
      (this.userType != 'A' && ((this.adduserForm.valid && !this.previousFormValue && !this.previousmoduleValue) || ((this.previousFormValue && this.isFormValueChanged) || (this.previousmoduleValue && this.ismoduleValueChanged))))) {
      isValid = this.adduserForm.invalid ? 'I' : 1;
    }
    this.addUserData.emit(isValid);
  }

  enableedituser() {
    this.iseditdisable = false;
    this.adduserForm.enable();
  }
  backendusereditdata(userPk) {
    this.contentinputloader = true;
    this.getCountryList();
    this.stkUpdateUserDetails(userPk);
  }

  stkUpdate(value) {
    if(this.addUserFromType==1) {
      value = '';
      this.currentUserPk='';
    }
    this.contentinputloader = true;
    this.addUpdateAccess.Ucontentplaceloader = true;
    let len = this.userPermissionsActivityLogs.length;
    if(this.userPermissionsActivityLogs != undefined && len > 0 && this.addUserFromType!=1 && this.userType != 'A' && this.stkholdertype != 1) {
    
      this.addUpdateAccess?.userAccessModification(this.previousmoduleValue);
       
     } else
     if (value) {
      this.addUpdateAccess.dataSourceforpermission = [];
      let usrPk = this.encrypt.encrypt(value);
      this.postParams = {
        "userPk": usrPk
      }
      this.postUrl = 'ea/user/stk-update-user-details';
      this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
        function (data) {
          if (data['data'].status == 0) {
            this.showWSuccess(data['data'].msg);
            this.isdisableclosebtn.emit(true);
          } else {
            this.userdetailsformval = data['data'].data;

            this.userType = data['data'].data.userType;

            this.deptPk = data['data'].data.departmentPk;
            if (this.userType != 'A' && this.stkholdertype != 1) {
              this.addUpdateAccess?.userAccessModification(data['data']?.data?.baseModulesAccess);
              this.previousmoduleValue = data['data'].data.baseModulesAccess
            }
            this.userPermission = data['data'].data.checkedAccess;
            this.editDepartment = false;


            if (this.userType != 'A' && !this.hideModuleAccess) {
              this.addUpdateAccess?.allocationUSerDetails(data['data'].data.fName, data['data'].data.lName, data['data'].data.designation);
            }
            this.previousFormValue = this.adduserForm.value;
            this.setCustomInputEable();

           

          }
        }.bind(this)
      );
    }
    this.contentinputloader = false;
    this.addUpdateAccess.Ucontentplaceloader = false;
  }

  stkUpdateUserDetails(userPk) {
    if(this.addUpdateAccess) {
      this.addUpdateAccess.dataSourceforpermission = [];
    }
    this.isdisableclosebtn.emit(false);
    let usrPk = this.encrypt.encrypt(userPk);
    this.currentUserPk = userPk;
    this.postParams = {
      "userPk": usrPk
    }
    this.postUrl = 'ea/user/stk-update-user-details';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 0) {
          this.showWSuccess(data['data'].msg);
          this.isdisableclosebtn.emit(true);
        } else {
          this.userdetailsformval = data['data'].data;
          
          this.adduserForm.patchValue({
            userPk: data['data'].data.usrPk,
            employeeid: data['data'].data.empId,
            username: data['data'].data.userName,
            firstName: data['data'].data.fName,
            lastName: data['data'].data.lName,
            middleName: data['data'].data.mName,
            email: data['data'].data.emailId,
            mobileno: (data['data'].data.mobileNo == '0') ? '' : data['data'].data.mobileNo,
            landlineno: (data['data'].data.landlineno == '0') ? '' : data['data'].data.landlineno,
            landlineext: (data['data'].data.landlineext == '0') ? '' : data['data'].data.landlineext,
            designation: data['data'].data.designation,
            division: Number(data['data'].data.division),
            designationLevel: Number(data['data'].data.designationLevel),
            businessunit: (data['data'].data.businessUnit !== null) ? data['data'].data.businessUnit.split(",") : [],
            branchname: data['data'].data.branchName,
            timezone: data['data'].data.timezone,
          });
          setTimeout(() => {
            if (data['data'].data.departmentPk !== null) {
              this.adduserForm.controls['departmentId'].setValue((data['data'].data.departmentPk !== null) ? data['data'].data.departmentPk.split(",") : []);
            }
            this.addUserData.emit('I');
            if(this.disableuserformval) {
              this.disableuserformval = false;
            } else {
              this.disableuserformval = true;
            }
            this.previousFormValue = this.adduserForm.value;
          }, 500);
          this.userType = data['data'].data.userType;
          this.countrylist.forEach(x => {
            if (x.CountryMst_Pk == data['data'].data.cntryCode) {
              this.mobile_country_code_flag = x.CountryMst_Pk;
              this.mobilecode = x.dialcode;
              this.adduserForm.controls['mobilecc'].setValue(x.CountryMst_Pk);
            }
          });

          this.countrylist.forEach(x => {
            if (x.CountryMst_Pk == data['data'].data.landlinecc) {
              this.landline_country_code_flag = x.CountryMst_Pk;
              this.landlinecode = x.dialcode;
              this.adduserForm.controls['landlinecc'].setValue(x.CountryMst_Pk);
            }
          });

          this.deptPk = data['data'].data.departmentPk;
          if (this.userType != 'A' && this.stkholdertype != 1) {
            this.addUpdateAccess?.userAccessModification(data['data']?.data?.baseModulesAccess);
            this.previousmoduleValue = data['data'].data.baseModulesAccess
          }
          this.userPermission = data['data'].data.checkedAccess;
          this.editDepartment = false;

          if (this.addUserFromType == 3 && this.adduserForm.controls['departmentId'].value != '' && this.adduserForm.controls['departmentId'].value != null) {
            this.postParams = {
              'deptPk': this.encrypt.encrypt(this.adduserForm.controls['departmentId'].value)
            };
            this.postUrl = 'ea/department/get-register-department';
            this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
              function (data) {
                this.departmentList = data['data'].data.deptData;
                this.deptDataTemp = this.departmentList[0].deptName;
              }.bind(this)
            );
          }
          if (this.userType != 'A' && !this.hideModuleAccess) {
            this.addUpdateAccess?.allocationUSerDetails(data['data'].data.fName, data['data'].data.lName, data['data'].data.designation);
          }
          this.previousFormValue = this.adduserForm.value;
        
          this.setCustomInputEable();
          
          // land Mobile Validation Starts
          if(this.userdetailsformval.mobilecc != 31){
            this.adduserForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(5),Validators.maxLength(20)])
          }else{
            this.adduserForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(8), Validators.maxLength(8)])
          }
          this.adduserForm.controls['mobileno'].updateValueAndValidity();
          // land Mobile Validation Ends

          // land line Validation Ends
          if(this.userdetailsformval.mobilecc.landlinecc != 31){
            this.adduserForm.controls['landlineno'].setValidators([Validators.minLength(5), Validators.maxLength(20)])
          }else{
            this.adduserForm.controls['landlineno'].setValidators([Validators.minLength(8), Validators.maxLength(8)])
          }
          this.adduserForm.controls['landlineno'].updateValueAndValidity();
          // land line Validation Ends

          this.contentinputloader = false;
          this.validationCheck();
          this.isdisableclosebtn.emit(true);
          if(this.userType == 'A'){
            this.addreadonlyMobile = true;
            if(this.userdetailsformval?.emailVerfied == "1") {
              this.verfiedtagshow = true;
            }
            if(this.userdetailsformval?.mobileVerified == "1") {
              if(this.mobile_country_code_flag == 31){
                 this.verfiedtagshowmobile = true;
               }
            }
            this.addreadonly = true;
            }
        }
      }.bind(this)
    );

    
  }

  userPermData(event) {
    this.userPermission = event;
    this.userPermissionsActivityLogs = [];
    this.userPermissionsActivityLogs.push(this.userPermission);
    this.userpermvalidationCheck();
  }

  sweetalert(data) {
    swal({
      title: data.msg,
      icon: data.status,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((value) => {

    });
  }

  userCloseCheck() {
    return this.adduserForm.touched;
  }
  validateclearform() {
    this.iseditdisable = true;
    this.adduserForm.reset();
    this.adduserForm.controls['mobilecc'].setValue(common_var.omanPk);
    this.mobile_country_code_flag = common_var.omanPk;
    this.mobilecode = common_var.omanDialCode;
    this.cdr.detectChanges();
  }
  clearForm() {
    this.adduserForm.reset();
    this.adduserForm.controls['mobilecc'].setValue(common_var.omanPk);
    this.mobile_country_code_flag = common_var.omanPk;
    this.mobilecode = common_var.omanDialCode;
    this.userPermission = [];
    this.userPermissionsActivityLogs = [];
    this.cdr.detectChanges();
    this.addUpdateAccess?.initialDetailsFetch();
  }
  cleanForm(id) {
    this.adduserForm.reset();
    this.adduserForm.controls['userPk'].patchValue(id);
    this.userPermission = [];
    this.userPermissionsActivityLogs = [];
    this.cdr.detectChanges();
    this.addUpdateAccess?.initialDetailsFetch();
  }

  editViewDepartment() {
    if (this.adduserForm.controls['departmentId'].value > 0) {
      this.editDeptData.emit(this.adduserForm.controls['departmentId'].value);
    } else {
      this.editDeptData.emit(this.deptPk);
    }
  }

  getDepartmentAccess() {
    this.cdr.detectChanges();
    if (this.adduserForm.controls['departmentId'].value) {
      this.postParams = {
        "deptPk": this.adduserForm.controls['departmentId'].value,
        "uac": "f9d6c6ad2e0f8bfded8c4c37e4140629"
      };
      this.postUrl = 'ea/department/update-department-details';
      this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
        function (data) {
          this.addUpdateAccess?.userAccessModification(data['data']?.data?.baseModulesAccess);
        }.bind(this)
      );

      if (this.adduserForm.controls['departmentId'].value > 0) {
        this.editDepartment = false;
      } else {
        this.editDepartment = true;
      }
    }

  }

  openDeptSide() {
    this.refBunitDept.triggerdivisionlisit();
    this.openDeptSideNav.emit(true);
  }

  ifchange() {
    this.change.emit();
  }

  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.adduserForm.value);
  }
  previousmoduleValue: any;
  get ismoduleValueChanged() {
    if (this.userType != 'A') {
      if (this.userPermission.length > 0) {
        return JSON.stringify(this.previousmoduleValue) !== JSON.stringify(this.userPermission);
      } else {
        return false;
      }
    } else {
        return true;
    }
  }
  get ismoduleUpdateValueChanged() {
 
    if(this.userPermissionsActivityLogs != undefined || this.userPermissionsActivityLogs.length > 0) {
      if((JSON.stringify(this.userPermissionsActivityLogs[0]) === JSON.stringify(this.userPermission)) && this.userPermissionsActivityLogs[0] != undefined) {
        return true;
      }
    }
   return false;
    
  }
  getDivisionData() {
    if (this.stkholdertype == 1) {
      this.postParams = {
        "compPk": this.encrypt.encrypt(this.compid)
      };
    } else {
      this.postParams = {};
    }
    this.postUrl = 'ea/businessunit/fetch-bunit-data';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.bunitData = data['data'].data.bunitData;
        }
      }.bind(this)
    );
  }

  deptReload(event) {
    this.postParams = {
      "bUnitPk": this.adduserForm.controls['businessunit'].value,
    };
    this.postUrl = 'ea/department/fetch-department-by-bunit';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.departmentList = data['data'].data.bunitDeptData;
        }
      }.bind(this)
    );
  }

  bunitReload(event) {
    this.getDivisionData();
    this.getSectorDtls(this.encrypt.encrypt(this.companypk));
    this.refBunitDept.initiateBusinessUnit();
  }

  showTSuccess(data) {
    this.toastr.success(data, this.i18n('commonuser.succ'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  showWSuccess(data) {
    this.toastr.warning(data, this.i18n('commonuser.warn'), {
      timeOut: 3000,
      closeButton: true,
    });
  }

  ngOnDestroy() {
    this.adduserForm.reset();
  }
}


export class BusinessUnitDetails {
  companypk: any;
  constructor(private http: HttpClient, companypk: any) {
    this.companypk = companypk;
  }

  businessUnitData(): Observable<any> {
    const href = environment.baseUrl + "mcp/mastercompanyprofile/businessunit?companypk=" + this.companypk;
    const sign = 'desc';
    const requestUrl =
      `${href}&sort=${sign}-MemCompSecDtls_Pk&order=${sign}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }

  
}