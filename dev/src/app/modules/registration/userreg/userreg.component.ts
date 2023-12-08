import { Component, OnInit, ChangeDetectorRef, ViewChild, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { CountryService } from '@app/common/newcountry/service/country.service';
import { RegistrationService } from '../registration.service';
import moment from 'moment';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';
import { debounceTime } from 'rxjs/operators/debounceTime';
import { ModalDialogReginfo as RegInfo } from '../modal/reginfo';
import { Router, ActivatedRoute } from '@angular/router';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatSelectChange } from '@angular/material/select';
import { MatDialog } from '@angular/material/dialog';
import { SharedService } from '@app/@shared/shared.service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
@Component({
  selector: 'app-userreg',
  templateUrl: './userreg.component.html',
  styleUrls: ['./userreg.component.scss'],
  providers: [CountryService, ProfileService]
})
export class UserdetailsComponent implements OnInit {

  userRegForm: FormGroup;
  userinvitepk: string;
  countrylist: any[] = [];
  mobile_country_code_flag: number = 31;
  landline_country_code_flag: number = 31;
  mobilecode: string = '+986';
  landlinecode: string = '+986';
  timezonelist: any[] = [];
  searchTimezone: string = '';
  currentlyOpenedPanel: number = 0;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  userName: string = '';
  companyName: string = '';
  public userFetchMailId: string = '';
  searchMobileCC: string;
  searchlandlineCC: string;
  regPk: number;
  //@ViewChild('recaptcha') recaptcha: RecaptchaComponent;
  maxDate: any = new Date();
  disableSubmitButton: boolean = false;
  showNameCard: boolean = false;
  isUrlValid: string = '';
  @Output() redirectTo: any = new EventEmitter<any>();
  invalidType: string;
  // setPasswordLink: any;
  postParams: any;
  postUrl: string;
  departmentList: any;
  searchDepartment: any;
  compPk: any;
  showThankYouForRegPage: boolean = false;
  mobileQuery: MediaQueryList;
  constructor(private routerID: ActivatedRoute,
    private formBuilder: FormBuilder,
    private countryService: CountryService,
    private regService: RegistrationService,
    private enterpriseService: EnterpriseService,
    private security: Encrypt,
    private cdr: ChangeDetectorRef,
    private dialog: MatDialog,
    private router: Router,
    private profileService: ProfileService,
    public sharedservice: SharedService,
    private recaptchaV3Service: ReCaptchaV3Service,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }

  ngOnInit() {
   
    this.logOut();
    this.setDefaultValues(this.routerID);
    this.maxDate.setFullYear(new Date().getFullYear() - 18);
    this.initializeForm();
    this.getInviteData(this.userinvitepk);

    this.userRegForm.controls['emp_id'].valueChanges
    .pipe(debounceTime(500)).subscribe(val => {
      this.checkAlreadyExists('emp_id');
    });
    this.userRegForm.controls['username'].valueChanges
    .pipe(debounceTime(500)).subscribe(val => {
      this.checkAlreadyExists('username');
    });
    this.userRegForm.controls['mobileno'].valueChanges
    .pipe(debounceTime(500)).subscribe(val => {
      this.checkAlreadyExists('mobileno');
    });
   
  }

  ngAfterViewInit() {
    this.dialCode = this.mobilecode;
    this.cdr.detectChanges();
  }


  logOut() {
    if (localStorage.getItem('v3logindata') !== null) {
      this.profileService.logout().subscribe(data => {
        localStorage.removeItem('v3logindata');
      })
    }
  }

  setDefaultValues(route: ActivatedRoute){
    route.queryParams.subscribe(data => {
      this.userinvitepk = data.pk;
    });
  }

  initializeForm() {
    this.userRegForm = this.formBuilder.group({
      userpk: ['', ''],
      userinvite_pk: ['', ''],
      companypk: ['', ''],
      emp_id: ['', Validators.required],
      username: ['', Validators.required],
      firstname: ['', Validators.required],
      middlename: ['', ''],
      lastname: ['', Validators.required],
      // department: ['', Validators.required],
      otherdept: ['', ''],
      // designation: ['', Validators.required],
      // dob: ['', Validators.required],
      email: ['', Validators.required],
      mobilecode: ['', ''],
      mobileno: ['', Validators.required],
      landlinecode: ['', ''],
      landlineextn: ['', ''],
      landlinno: [''],
      // timezone: ['', Validators.required],
      termsandconditions: ['', Validators.requiredTrue],
      //captcha: ['', Validators.required]
    });
  }

  getCountryList() {
    this.sharedservice.getCountryList().subscribe(data => {
      this.countrylist=data.json().data;
    });
  }

  setcountryFlag(value,dataType) {
    if(dataType == 'mobile'){
      this.mobile_country_code_flag = value;
      if (this.mobile_country_code_flag != 31) {
        this.userRegForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(5), Validators.maxLength(20)])
      } else {
        this.userRegForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(5), Validators.maxLength(8)])
      }
      this.userRegForm.controls['mobileno'].updateValueAndValidity();
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.userRegForm.controls['mobilecode'].setValue(x.CountryMst_Pk);
          this.mobilecode = x.dialcode;
        }
      });
    }else if(dataType == 'landline'){
      this.landline_country_code_flag = value;
      if (this.landline_country_code_flag != 31) {
        this.userRegForm.controls['landlinno'].setValidators([Validators.minLength(5), Validators.maxLength(20)])
      } else {
        this.userRegForm.controls['landlinno'].setValidators([Validators.minLength(5), Validators.maxLength(8)])
      }
      this.userRegForm.controls['landlinno'].updateValueAndValidity();
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.userRegForm.controls['landlinecode'].setValue(x.CountryMst_Pk);
          this.landlinecode = x.dialcode;
        }
      });
    }
  }

  deptChanges(event: MatSelectChange) {
    this.userRegForm.controls.otherdept.setValidators(null);
    if(event.value == 0) {
      this.userRegForm.controls.otherdept.setValue(null);
      this.userRegForm.controls.otherdept.setValidators([Validators.required]);
      this.userRegForm.controls.otherdept.markAsUntouched();
    }
    this.userRegForm.controls.otherdept.updateValueAndValidity();
  }

  getTimeZoneList() {
   // this.stkholdRegService.getTimeZoneList().subscribe(data => this.timezonelist = data['data']);
  }
  userid:number;
  getInviteData(pk: string) {
    this.regService.inviteData(pk).subscribe(data => {
      this.isUrlValid = data['data'].flag;
      this.emailID = (data['data'].flag == 'S' || data['data'].flag == 'AR') ?  data['data'].items.data.uid_emailid : null;
      if(data['data'].flag == 'S'){
        this.companyName = data['data'].items.companyName;
        this.regPk = data['data'].items.regPk;
        this.compPk = data['data'].items.regPk;
        if(data['data'].items.from == 1){
          this.userid = data['data'].items.data.uid_usermst_fk;
          this.mobile_country_code_flag = Number(data['data'].items.countryPk);
          this.userRegForm.controls['firstname'].setValue(data['data'].items.firstname);
          this.userRegForm.controls['middlename'].setValue(data['data'].items.middlename);
          this.userRegForm.controls['lastname'].setValue(data['data'].items.lastname);
          this.userRegForm.controls['mobileno'].setValue(data['data'].items.mobileno);
          this.userRegForm.controls['landlinno'].setValue(data['data'].items.landlinno);
          this.userRegForm.controls['mobilecode'].setValue(data['data'].items.countryPk);
          this.userRegForm.controls['landlinecode'].setValue(data['data'].items.countryPk1);
          this.userRegForm.controls['landlineextn'].setValue(data['data'].items.landlineext);
          this.mobilecode = data['data'].items.countryCode;
          this.landline_country_code_flag = Number(data['data'].items.countryPk1);
          this.landlinecode = data['data'].items.countryCode1;
          this.userName = this.userRegForm.controls['email'].value.split("@")[0];
          this.userRegForm.controls['email'].disable();
        }else{
          this.mobile_country_code_flag = Number(data['data'].items.countryPk);
          this.userRegForm.controls['mobilecode'].setValue(data['data'].items.countryPk);
          this.userRegForm.controls['landlinecode'].setValue(data['data'].items.countryPk);
          this.mobilecode = data['data'].items.countryCode;
          this.landline_country_code_flag = Number(data['data'].items.countryPk);
          this.landlinecode = data['data'].items.countryCode;
          this.userName = this.userRegForm.controls['email'].value.split("@")[0];
          this.userRegForm.controls['email'].disable();
        }        
        this.userinvite_pk = Number(this.security.decrypt(pk));
        // this.getUserDepartmentList();
        this.getCountryList();
        this.getTimeZoneList();
      }else {
        this.routeTo(this.isUrlValid, this.emailID);
      }
    })
  }


  // getUserDepartmentList(){
  //   this.postParams = { compPk: this.security.encrypt(this.compPk)};
  //   this.postUrl = 'ea/user/get-stakholder-department?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
  //   this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(data => {
  //           if(data['data'].status == 100){
  //             this.departmentList = data['data'].data.departmentDetails;
  //           } else if (data['data'].status == 104) {
  //             this.getDefaultDeptList();
  //           }
  //       }
  //   );
  // }

  // getDefaultDeptList() {
  //   this.enterpriseService.getDefaultDeptList().subscribe(data => this.departmentList = data['data'].items)
  // }

  submitUserForm() {
    if (this.userRegForm.valid) {
      swal({
        title: 'Do you want to proceed with the registration?',
        text:'',
        icon: 'warning',
        buttons: ['Cancel', 'Proceed'],
        dangerMode: true,
      }).then((willGoBack) => {
        if(willGoBack){
          this.disableSubmitButton = true;
          //this.dateOfBirth = moment(this.dateOfBirth).format('YYYY-MM-DD').toString();
          // this.recaptchaV3Service.execute('userRegistration')
          // .subscribe((token) => { 
            
          // })
          this.userRegForm.value['compPk'] = this.security.encrypt(this.compPk);
          this.userRegForm.value['userid'] = this.userid;
            //this.userRegForm.value['reCaptchaToken'] = token;
          this.userRegForm.value['action'] = 'userRegistration';
          
          this.regService.submitUserInformation(this.userRegForm.value, this.userFetchMailId).subscribe(data => {
            if (data['data'].flag == 'S') {
              // this.setPasswordLink = data['data'].setPasswordLink;
              // this.openDialog();
              // this.showThankYouForRegPage = true;
              this.openDialog();
            } /*else if (data['data'].flag == 'C') {
              swal({
                text: 'Captcha Expired, Try Again!',
                icon: 'warning'
              })
            }*/ else if (data['data'].flag == 'E') {
              swal({
                text: 'Something went wrong',
                icon: 'warning'
              })
              this.showThankYouForRegPage = false;
            }
            this.disableSubmitButton = false;
        });
        }
      })


    }
  }

  cancelAction() {
    swal({
      title:'Are you sure you want to cancel?',
      text:'If yes all the data will be lost',
      icon: 'warning',
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willGoBack) => {
      if(willGoBack){
        this.userRegForm.reset();
        //this.recaptcha.resetCaptcha();
        this.disableSubmitButton = false;
        this.router.navigate(['/home/dashboard/'])
      }
    })
  }

  openDialog(): void {
    let dialogRef = this.dialog.open(RegInfo, { disableClose: true, panelClass: "userregpop_class", data: {userName: this.userName} 
    });
    dialogRef.afterClosed().subscribe(result => {
        
    });
  }

  checkAlreadyExists(contorlName: string) {
    let value = this.userRegForm.controls[contorlName].value;
    if (value) {
      this.checkByType(value,contorlName);
    }
  }

  checkByType(value: any,contorlName: string) {
   
  }

  setOpened(index: number) {
    this.currentlyOpenedPanel = index;
  }

  setClosed(index: number) {
    if (this.currentlyOpenedPanel == index)
      this.currentlyOpenedPanel = -1;
  }

  setCaptcha(token: string) {
    this.cdr.detectChanges();
  }

  set emailID(mailID: string) {
    this.userRegForm.controls['email'].setValue(mailID);
    this.userFetchMailId = mailID;
  }

  set dialCode(dialcode: string) {
    this.userRegForm.controls['mobilecode'].setValue(dialcode);
  }

  set userinvite_pk(pk: number) {
    this.userRegForm.controls['userinvite_pk'].setValue(pk);
  }

  get firstName() {
    return this.userRegForm.controls['firstname'].value;
  }

  get emailID() {
    return this.userRegForm.controls['email'].value;
  }

  // get dateOfBirth() {
  //   return this.userRegForm.controls['dob'].value;
  // }

  routeTo(event, emailID?: string){
    this.invalidType = event;
    this.router.navigate(['registration/invalidpage'], { queryParams: { type: event, m: this.security.encrypt(emailID) } });
  }
}
