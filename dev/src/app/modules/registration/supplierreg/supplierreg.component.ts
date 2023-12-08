import {
  ChangeDetectorRef, Component, ElementRef, EventEmitter, HostListener, Inject, Input,
  OnDestroy, OnInit, Output, Renderer2, ViewChild, ViewEncapsulation
} from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { MatInput } from '@angular/material/input';
import { MatTabGroup } from '@angular/material/tabs';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { DriveInput } from '@app/common/classes/driveInput';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { AfterloginService } from '@app/modules/afterlogin/afterlogin.service';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { RemoteService } from '@app/remote.service';
import { environment } from '@env/environment';
import { TranslateService } from '@ngx-translate/core';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { CookieService } from 'ngx-cookie-service';
import { ReplaySubject } from 'rxjs/internal/ReplaySubject';
import { Subscription } from 'rxjs/internal/Subscription';
import { Subject } from 'rxjs/Subject';
import swal from 'sweetalert';
import { Paymentnotedialog } from '../modalpaymentnote/paymentnote';
import { OfflineProcess } from '../offline-process';
import { RegistrationService } from '../registration.service';
import { DirtyComponent } from './dirty-component';
// import { FileInput } from 'ngx-material-file-input';
export interface Howdidyouknow {
  value: string;
  viewValue: string;
}

export const MY_FORMATS = {
  parse: {
    dateInput: 'DD-MM-YYYY',
  },
  display: {
    dateInput: 'DD-MM-YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};

@Component({
  selector: 'app-supplierreg',
  templateUrl: './supplierreg.component.html',
  styleUrls: ['./supplierreg.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class SupplierregComponent extends OfflineProcess implements OnInit, OnDestroy, DirtyComponent {
  ReadOnlyStyleGuideNotes: boolean;
  dir: string;
  readaccept: any;
  userGeoDialCode: any;
  scrollTop: number;
  ifopalstar: boolean;
  nextbutton1: boolean;
  configurationlist: any;
  crnumverify: boolean;
  memshpverify: boolean;
  registeras: any;
  moherigradinglist: any;
  controls: any;
  @Output() DirtyControl: EventEmitter<Boolean> = new EventEmitter<Boolean>();
  isDirty = false;
  i18n(key) {
    return this.translate.instant(key);
  }
  emailotp: any = null;
  showeditbuttonemail = false;
  emailcount: number = 0;
  verifiedmobilecc: any;
  verifiedemail: any;
  timersecmail: any;
  disableResendemail: boolean = false;
  public countDown: any = '00:00';
  userGeoCountryPk: any = 31;
  ifresend: boolean = false;
  timestamp: any;
  currentip: any;
  countrylist: any = [];
  generalContactValue: boolean = false;
  trainCompValue: boolean = false;
  userpk: any;
  isDisable: boolean = true;
  invoicelink: any;
  @Input() myModel;
  popupcontent: any;
  public formSubmitted = false;
  requiredstar: any = [];
  file_store: FileList;
  file_list: Array<string> = [];
  stkpk: any;
  panel: number = 1;
  panelcert: number = 1;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  public drv_omanorg: DriveInput;
  // @ViewChild('drv_omanorgcert') drv_omanorgcert: Filee;
  classificationdetails: any;
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  internationaldetails: any;
  date_expiry: boolean = false;
  ifnational: boolean = true;
  viewinternal = 'internal';
  foreignbranch: boolean = false;
  public companyinfodata: any = [{ dataName: 'Supply Chain Certification (Supplier)', dataPk: 1 }, { dataName: 'OISSR  Certification (Industrial Organization)', dataPk: 2 }];

  @ViewChild('formFocus') scrollElement: ElementRef;
  @Input('countrylist') countrylistnew: any = [];
  @ViewChild('regSupplierForm') regSupplierForm: FormGroupDirective;
  @ViewChild('landlinenumber') landlinenumber: MatInput;
  @Output() goBack: any = new EventEmitter<any>();
  @Output() regDone: any = new EventEmitter<any>();
  ifarabic: boolean = false;
  supplierForm: FormGroup;
  public agreeData: boolean = false;
  @Input('paymentdisable') paymentdisable: boolean = true;
  searchCountry: string = '';
  searchState: string = '';
  searchCity: string = '';
  refno: string = '';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  disableSubmitButton: boolean = false;
  showWelcomeCard: boolean = false;
  showNameCard: boolean = false;
  showEmailCard: boolean = false;
  showThankYouCard: boolean = false;
  showThankYouForRegPage: boolean = false;
  otpshow: boolean = false;
  disableemail: boolean = false;
  verfiy: boolean = true;
  date_exp: boolean = false;
  verfiedtagshow: boolean = false;
  destroy$: Subject<boolean> = new Subject<boolean>();
  otherInputPlaceholder: string = 'Others';
  selectedEstCountry: string;
  selectedEstCountryAr: string;
  intervalSubscription: Subscription;
  maxDate = new Date();
  incorpstylelist: any[] = [];
  @Input() sectorlist: any[] = [];
  @Input() rightSideCardCounts: any = [];
  @Input() userIPcountryName: string;
  @Input() mattab: number = 0;
  @Output() supplieregdata: any = new EventEmitter<any>();
  @Output() certificatehide: any = new EventEmitter<any>();
  sectorNameDataTemp: any;
  filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  sectorFilter: FormControl = new FormControl();
  filteredBussrc: ReplaySubject<any> = new ReplaySubject<any>(1);
  bussrcFilter: FormControl = new FormControl();
  bussrcNameDataTemp: any;
  portalName = BgiJsonconfigServices.bgiConfigData.configuration.projectName;
  intervalDuration = BgiJsonconfigServices.bgiConfigData.configuration.offlineRegDataTrackDuration;
  masterSelectList: any = [];
  masterSelectValidation: any;
  termsacceptvalue: boolean = false;
  isChecked: any = 'accept';
  countrycode: any;
  statelist: any;
  governoratelist: any;
  branchType: any;
  isBranchOfficType: boolean;
  isMainOfficType: boolean;
  citylist: any;
  wilayatlist: any;
  companylabel: any;
  selectedEstState: any;
  selectedEstStateAr: any;
  selectedEstGovernorate: any;
  selectedEstGovernorateAr: any;
  selectedEstZone: any;
  encryptedUserPk: any;
  compname: any;
  deptlist: any;
  officelist: any;
  constructor(private formBuilder: FormBuilder,
    private profileService: ProfileService,
    private enterpriseService: EnterpriseService,
    private cdr: ChangeDetectorRef,
    private router: Router,
    protected security: Encrypt,
    private activatedRoute: ActivatedRoute,
    private afterloginService: AfterloginService,
    protected regService: RegistrationService,
    private renderer: Renderer2,
    private remoteService: RemoteService,
    private el: ElementRef,
    private translate: TranslateService,
    private cookieService: CookieService,
    public dialog: MatDialog,
    private recaptchaV3Service: ReCaptchaV3Service) {
    super(security, regService)
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  ngOnInit() {
    this.branchType = [
      { "id": 1, "branch": this.i18n('supplierreg.mainbranch') },
      { "id": 2, "branch": this.i18n('supplierreg.officbranch')}
    ]
    // this.pageScrolltop();'mainbranch':"Main Branch"
    this.ReadOnlyStyleGuideNotes = true;
    this.activatedRoute.queryParams.subscribe(data => {
      this.encryptedUserPk = data.pk;
      this.remoteService.getLanguageCookie().subscribe(data => {
        this.translate.setDefaultLang(this.cookieService.get('languageCode'));
        if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
          const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
          //this.patientCategory.get('patientCategory').setValue(toSelect);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          if (toSelect.languagecode == 'en') {
            this.ifarabic = false;
            this.spinnerButtonOptionsEmail.text = "Verify";
            this.spinnerButtonOption.text = "Verified";
            this.spinnerButtonOptions.text = "Verified";
            this.spinnerButtonOptionsmobile.text = "Verify";
          }
          else {
            this.ifarabic = true;
            this.spinnerButtonOptionsEmail.text = "Verify";
            this.spinnerButtonOption.text = "Verified";
            this.spinnerButtonOptions.text = "Verified";
            this.spinnerButtonOptionsmobile.text = "Verify";
          }

        } else {
          const toSelect = this.languagelist.find(c => c.id == '1');
          //this.patientCategory.get('patientCategory').setValue(toSelect);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          this.spinnerButtonOptionsEmail.text = "Verify";
          this.spinnerButtonOption.text = "Verified";
          this.spinnerButtonOptions.text = "Verified";
          this.spinnerButtonOptionsmobile.text = "Verify";
        }
        this.remoteService.getLanguageCookie().subscribe(data => {
          this.translate.setDefaultLang(this.cookieService.get('languageCode'));
          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
            if (toSelect.languagecode == 'en') {
              this.ifarabic = false;
              this.spinnerButtonOptionsEmail.text = "Verify";
              this.spinnerButtonOption.text = "Verified";
              this.spinnerButtonOptions.text = "Verified";
              this.spinnerButtonOptionsmobile.text = "Verify";
            }
            else {
              this.ifarabic = true;
              this.spinnerButtonOptionsEmail.text = "Verify";
              this.spinnerButtonOption.text = "Verified";
              this.spinnerButtonOptions.text = "Verified";
              this.spinnerButtonOptionsmobile.text = "Verify";
            }

          } else {
            const toSelect = this.languagelist.find(c => c.id == '1');
            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
            this.spinnerButtonOptionsEmail.text = "Verify";
            this.spinnerButtonOption.text = "Verified";
            this.spinnerButtonOptions.text = "Verified";
            this.spinnerButtonOptionsmobile.text = "Verify";
          }
        });
      });
    });
    const currentDate = new Date();
    this.timestamp = currentDate.getTime();

    this.regService.agreeData.subscribe((data: any) => {
      if (data) {
        this.agreeData = data;
        this.readaccept = data;
        this.form.userCheck.setValue(1);
      }
      else {
        this.form.userCheck.setValue(null);
      }
    })

    this.regService.readaccept.subscribe((data: any) => {
      if (data) {
        this.readaccept = data;
      }
    })
    this.stkpk = this.remoteService.getstakeholdertypereg()['stkpk'];
    this.registeras = this.remoteService.getstakeholdertypereg()['registeras'];

    this.countrycode = 31;

    this.initializeForm();
    this.getconfigurations();
    this.getMoherigradinglist();
    this.getGoverenoratelist();
    this.selectedStktype();
    this.supplierForm.valueChanges.subscribe(e => {
      this.isDirty = true;
      this.DirtyControl.emit(this.isDirty);
    });
  }

  canDeactivate() {
    return this.isDirty;
  }

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  verifybtn() {
    this.date_exp = true;
  }
  verify() {
    this.date_expiry = true;
  }
  ngAfterViewInit() {
    this.stkpk = this.remoteService.getstakeholdertypereg()['stkpk'];
    this.registeras = this.remoteService.getstakeholdertypereg()['registeras'];
    this.selectedStktype();
    this.pageScrolltop();
  }
  getconfigurations() {
    this.regService.getConfiguration().subscribe(res => {
      this.configurationlist = res.data;
      this.crnumverify = (this.configurationlist['CR Integration'] == 'A') ? true : false;
      this.memshpverify = (this.configurationlist['OPAL Membership Integration'] == 'A') ? true : false;

    });
  }
  getMoherigradinglist() {
    this.regService.getMoherigradinglist().subscribe(data => {
      this.moherigradinglist = data.data;

    });
  }
  onKeyUp(event: KeyboardEvent): void {
    if (event.key === 'Backspace') {
      const input = event.target as HTMLInputElement;
      input.value = input.value.slice(0, -1);
    }
  }
  checkfile(files, filepk) {
    if (filepk == 1) {
      let value = JSON.stringify(files);
      console.log(value);
      this.form.company_logo.setValue(value);
      this.form.company_logo.updateValueAndValidity();
    }

    if (filepk == 2) {
      let value = JSON.stringify(files);
      console.log(value);
      this.form.cr_activity.setValue(value);
      this.form.cr_activity.updateValueAndValidity();
    }

  }

  getGoverenoratelist() {
    this.profileService.getstatebyid(31).subscribe(data => {
      this.governoratelist = data.data;

    });
  }

  getwilayatbyid(country, state) {
    this.profileService.getcity(country, state).subscribe(data => this.wilayatlist = data.data);
  }

  public regestrationType: any = null;


  selectedType(regitertype: any) {
    this.form.stkholder_type.setValue(this.stkpk);
    this.regestrationType = regitertype;
    if (regitertype == 1) {
      this.form.registeras.setValue('1');
      this.form.projectpk.setValidators(null);
      this.form.branch_name_en.setValidators(null);
      this.form.branch_name_ar.setValidators(null);
      this.form.moheri_grade.setValidators([Validators.required]);
      this.form.tp_name_ar.setValidators([Validators.required]);
      this.form.tp_name_en.setValidators([Validators.required]);
      this.form.branchname_en.setValidators(null);
      this.form.branchname_ar.setValidators(null);
      this.form.cr_activity.setValidators(null);
      // this.form.Course_offered.setValidators([Validators.required]);

    }
    if (regitertype == 2) {
      this.form.registeras.setValue('2');
      // this.form.Course_offered.setValidators(null);
      this.form.projectpk.setValidators([Validators.required]);
      this.form.moheri_grade.setValidators(null);
      this.form.branch_name_en.setValidators([Validators.required]);
      this.form.branch_name_ar.setValidators([Validators.required]);
      this.form.tp_name_ar.setValidators(null);
      this.form.tp_name_en.setValidators(null);
      this.form.branchname_en.setValidators(null);
      this.form.branchname_ar.setValidators(null);
      this.form.cr_activity.setValidators([Validators.required]);
    }
    this.form.registeras.updateValueAndValidity();
    this.form.projectpk.updateValueAndValidity();
    this.form.moheri_grade.updateValueAndValidity();
    this.form.branch_name_en.updateValueAndValidity();
    this.form.branch_name_ar.updateValueAndValidity();
    this.form.tp_name_ar.updateValueAndValidity();
    this.form.tp_name_en.updateValueAndValidity();
    this.form.branchname_en.updateValueAndValidity();
    this.form.branchname_ar.updateValueAndValidity();
    this.form.cr_activity.updateValueAndValidity();

  }

  selectedStktype() {

    if (this.registeras == '2') {
      this.ifopalstar = false;
      this.popupcontent = this.i18n('supplierreg.pleaconftoproctech');
    }
    else {
      this.ifopalstar = true;
      this.popupcontent = this.i18n('supplierreg.pleaconftrain');
    }
    this.form.stkholder_type.setValue(this.stkpk);
    this.selectedType(this.registeras);
    this.form.stkholder_type.updateValueAndValidity();
  }

  initializeForm() {
    this.supplierForm = this.formBuilder.group({
      stkholder_type: ['', Validators.required],
      registeras: ['', Validators.required],
      projectpk: ['', Validators.required],
      opal_memb_no: ['', Validators.required],
      opal_memb_expiry: ['', Validators.required],
      comp_cr_no: ['', Validators.required],
      comp_cr_expiry: ['', Validators.required],
      company_name_en: ['', Validators.required],
      company_name_ar: ['', Validators.required],
      tp_name_en: ['', Validators.required],
      tp_name_ar: ['', Validators.required],
      branchtype: [''],
      branch_name_en: ['', Validators.required],
      branch_name_ar: ['', Validators.required],
      branchname_en: [''],
      branchname_ar: [''],
      // Course_offered: ['', Validators.required],
      governorate: ['', Validators.required],
      wilayat: ['', Validators.required],
      address1: ['', Validators.required],
      address2: ['', ''],
      gm_name: ['', Validators.required],
      gm_emailid: ['', Validators.required],
      gm_mobnum: ['', Validators.required],
      moheri_grade: ['', Validators.required],
      focalpoint_name: ['', Validators.required],
      focalpoint_desig: ['', Validators.required],
      focalpoint_emailid: ['', Validators.required],
      focalpoint_mobno: ['', Validators.required],
      multiplefile: ['', ''],
      company_logo: ['', ''],
      cr_activity: ['', Validators.required],
      userCheck: ['', Validators.required],
      files: ['', ''],
      isCompNameSame: [''],
      ifFpSameAsGm: ['', ''],
      // contnum: ['', Validators.required]
    });

  }
  get form() {
    return this.supplierForm.controls;
  }

  setCaptcha(token: string) {
    this.captcha = token;
    this.cdr.detectChanges();
  }

  setOpen(i) {
    this.panel = i;
  }

  checkByType(value: any, contorlName: string) {
    switch (contorlName) {
      case 'comp_cr_no':
        this.regService.checkCRNumber(value, '1').subscribe(data => {
          if (data['data'].available) {
            this.supplierForm.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;
      case 'opal_memb_no':
        this.regService.checkOpalMemNumber(value, '1').subscribe(data => {
          if (data['data'].available) {
            this.supplierForm.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;
      case 'company_name_en':
        this.regService.checkCompanyNameEn(value, '', this.form.stkholder_type.value).subscribe(data => {
          if (data['data'].available) {
            this.supplierForm.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;
      case 'company_name_ar':
        this.regService.checkCompanyNameAr(value, '', this.form.stkholder_type.value).subscribe(data => {
          if (data['data'].available) {
            this.supplierForm.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;
      case 'focalpoint_emailid':
        this.regService.checkEmail(value, '', this.form.stkholder_type.value).subscribe(data => {
          if (data['data'].available) {
            this.supplierForm.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;

    }
  }

  submitRegistration() {
    
    // alert(this.scrollTo('pagescroll') + "top1");
    // console.log(this.supplierForm.controls.formSubmitted);
    if (this.supplierForm.valid) {
      swal({
        title: this.popupcontent,
        text: '',
        icon: 'success',
        buttons: [this.i18n('registration.no'), this.i18n('registration.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.recaptchaV3Service.execute('supplierRegistration')
            .subscribe((token) => {
              this.supplierForm.value['reCaptchaToken'] = token;
              this.supplierForm.value['action'] = 'supplierRegistration';
              this.disableSubmitButton = true;
              this.regService.submitSupplierRegistration(this.supplierForm.value).
                takeUntil(this.destroy$).
                subscribe(data => {
                  this.form.cr_activity.setValue(null);
                  this.form.cr_activity.updateValueAndValidity();
                  this.form.company_logo.setValue(null);
                  this.form.company_logo.updateValueAndValidity();
                  if (data['data'].status == 1) {
                    this.disableSubmitButton = false;
                    this.refno = data['data'].refno.regno;
                    this.userpk = data['data'].refno.userpk;
                    // this.save(value);
                    this.isDirty = false;
                    this.DirtyControl.emit(this.isDirty);
                    this.showThankYouForRegPage = true;
                    this.paymentdisable = false;
                    this.scrollTo('pagescroll');
                    // super.writeregFormDatajson(this.supplierForm.value, this.currentip + '_' + this.timestamp);
                    this.regDone.emit(true);
                  } else if (data['data'].status == 2) {
                    this.disableSubmitButton = false;
                    this.controls = data['data'].controls;
                    this.controls.forEach(x => {
                      this.checkByType(this.form[x].value, x);
                    });
                    this.focusInvalidInput(this.supplierForm);
                    // this.scrollTo('pagescroll');


                  } else {
                    swal({
                      title: data['data'].title,
                      text: data['data'].msg,
                      icon: 'warning',
                      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                      closeOnClickOutside: false
                    }).then(() => {
                      this.disableSubmitButton = false;
                    })
                    this.scrollTo('pagescroll');
                  }
                }, (error) => this.disableSubmitButton = false);
            });
        }
      });
    }
    else {
      console.log("agjhfjhkjfjajgfgajf "+ this.supplierForm.errors);
      
      this.focusInvalidInput(this.supplierForm);
      // console.log(this.focusInvalidInput())

    }
  }
  spinnerButtonOptionsEmail: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  spinnerButtonOption: MatProgressButtonOptions = {
    active: false,
    text: 'Verified',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  spinnerButtonOptions: MatProgressButtonOptions = {
    active: false,
    text: 'Verified',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  spinnerButtonOptionsmobile: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  spinnerButtonfileadd: MatProgressButtonOptions = {
    active: false,
    text: 'Add',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  backtocanc() {
    swal({
      title: this.i18n('supplierreg.doyouwantregis'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('supplierreg.no'), this.i18n('supplierreg.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.backtolandingpage();
        this.isDirty = false;
        this.DirtyControl.emit(this.isDirty);
        this.goBack.emit(true);
      }
    });
  }
  cancelreg() {
    swal({
      title: this.i18n('supplierreg.docancregis'),
      text: this.i18n('supplierreg.doyouwantnote'),
      icon: 'warning',
      buttons: [this.i18n('supplierreg.no'), this.i18n('supplierreg.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.scrollTo('pagescroll');
        this.isDirty = false;
        this.DirtyControl.emit(this.isDirty);
        this.backtolandingpage();

      }
    });
  }


  resetAll() {
    this.regSupplierForm.resetForm();
    this.initializeForm();
    this.disableSubmitButton = false;
    this.showWelcomeCard = false;
    this.showNameCard = false;
    this.showEmailCard = false;
    this.showThankYouCard = false;
    this.showThankYouForRegPage = false;
  }

  dirtyControls() {
    return Object.keys(this.form).filter(control => {
      if (control !== 'inv_identity' && this.supplierForm.controls[control].touched) {
        return control;
      }
    })
  }

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {
      // console.log('page-content')
    }
  }

  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  // focusInvalidInput() {
  //   for (const key of Object.keys(this.form)) {
  //     if (this.supplierForm.controls[key].invalid) {
  //       const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
  //       if (invalidControl) {
  //         invalidControl.focus();          
  //       }
  //       if (key == 'userCheck') {
  //         swal({
  //           title: this.i18n('supplierreg.readandaccep'),
  //           text: '',
  //           icon: 'warning',
  //           dangerMode: true,
  //           closeOnClickOutside: false
  //         });
  //         break;
  //       }
  //       break;
  //     }
  //   }
  // }



  backtolandingpage() {
    this.supplieregdata.emit(true);
    this.certificatehide.emit(false);

  }


  focusInvalidKeys(keys, form, panel = null) {
    if (form == 'form') {
      for (const key of keys) {
        console.log(key);
        if (this.supplierForm.controls[key].invalid) {
          this.supplierForm.controls[key].setErrors({ required: true });
          this.supplierForm.controls[key].markAsTouched();
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

  set captcha(token: string) {
    this.form.captcha.setValue(token);
  }

  selectedBranchType(event) {
    if (event.value == this.branchType[0].id) {
      this.isBranchOfficType = false;
      this.isMainOfficType = true;
      this.form.branchname_en.setValidators(null);
      this.form.branchname_ar.setValidators(null);
    }
    if (event.value == this.branchType[1].id) {
      this.isBranchOfficType = true;
      this.isMainOfficType = false;
      this.form.branchname_en.setValidators([Validators.required]);
      this.form.branchname_ar.setValidators([Validators.required]);
    }
    this.form.branchname_en.updateValueAndValidity();
    this.form.branchname_ar.updateValueAndValidity();

  }

  selectedGovernorate(value) {
    this.governoratelist.forEach(y => {
      if (y.opalstatemst_pk == value) {
        this.selectedEstGovernorate = y.osm_statename_en;
        this.selectedEstGovernorateAr = y.osm_statename_ar;
        this.getwilayatbyid(31, value);
      }
    });
  }
  regex = /[???? ?????????????????????????????????????????]|\.|\s/;

  ngOnDestroy(): void {
    this.destroy$.next(true);
    this.destroy$.unsubscribe();
  }



  ifcompnamesame(value) {
    if (value === true) {
      this.changeincompname();
    }
    else {
      if (this.ifopalstar) {
        this.supplierForm.patchValue({
          tp_name_en: null,
          tp_name_ar: null,
        });
      }
      else {
        this.supplierForm.patchValue({
          branch_name_en: null,
          branch_name_ar: null,
        });
      }
    }
  }

  changeincompname() {
    if (this.form.isCompNameSame.value == true) {
      if (this.form.company_name_en.valid && this.form.company_name_ar.valid) {
        if (this.ifopalstar) {
          this.supplierForm.patchValue({
            tp_name_en: this.form.company_name_en.value,
            tp_name_ar: this.form.company_name_ar.value,
          });
        }
        else {
          this.supplierForm.patchValue({
            branch_name_en: this.form.company_name_en.value,
            branch_name_ar: this.form.company_name_ar.value,
          });

        }
      }
      else {
        this.form.isCompNameSame.setValue(false);
        swal({
          title: this.i18n('supplierreg.pleafillallmandcomp'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('supplierreg.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
      }
    }
  }

  ifgmsameasfp(value) {
    if (value === true) {
      this.changeingmdtls();
    }
    else {
      this.supplierForm.patchValue({
        focalpoint_name: null,
        focalpoint_mobno: null,
        focalpoint_emailid: null,
      });
    }
  }

  changeingmdtls() {
    if (this.form.ifFpSameAsGm.value == true) {
      if (this.form.gm_name.valid && this.form.gm_mobnum.valid && this.form.gm_emailid.valid) {
        this.supplierForm.patchValue({
          focalpoint_name: this.form.gm_name.value,
          focalpoint_mobno: this.form.gm_mobnum.value,
          focalpoint_emailid: this.form.gm_emailid.value,
        });
        this.checkByType(this.form.gm_emailid.value, 'focalpoint_emailid');
      }
      else {
        this.form.ifFpSameAsGm.setValue(false);
        swal({
          title: this.i18n('supplierreg.pleafillallmanagene'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('supplierreg.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
      }
    }
  }

  openDialognotes(): void {
    let dialogRef = this.dialog.open(Paymentnotedialog, { disableClose: true });

    dialogRef.afterClosed().subscribe(result => {

    });
  }
  public myModelerror = true;
  opendialogterms() {
    const dialogRef = this.dialog.open(Modaltermscondition, {
      disableClose: true,
      panelClass: 'regtermscondition',
      data: { 'myModel': this.myModel, }
    });
    //dialogRef.componentInstance.drawer = this.drawercontactus;
    dialogRef.afterClosed().subscribe((result) => {

    });
  }
  pageScrolltop() {

    document.getElementById('centreregistration').scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest"
    });
  }
  @HostListener('keydown.backspace', ['$event'])
  onBackspaceKeyDown(event: KeyboardEvent): void {
    const value = this.el.nativeElement.value;
    const selectionStart = this.el.nativeElement.selectionStart;
    const selectionEnd = this.el.nativeElement.selectionEnd;

    if (selectionStart === 0 && selectionEnd === value.length) {
      this.el.nativeElement.value = '';
      this.el.nativeElement.dispatchEvent(new Event('input'));
      event.preventDefault();
    }
  }
}

export interface Datadialog {
  myModel: boolean
}
@Component({
  selector: 'modaltermscondition',
  templateUrl: './modaltermscondition.html',
  styleUrls: ['./modaltermscondition.scss']
})

export class Modaltermscondition {
  constructor(
    public dialogRef: MatDialogRef<Modaltermscondition>,
    private remoteService: RemoteService,
    private el: ElementRef,
    private translate: TranslateService,
    protected regService: RegistrationService,
    private cookieService: CookieService,
    @Inject(MAT_DIALOG_DATA) public data: Datadialog
  ) {
  }
  lang = '1';
  dir = 'ltr';
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  ngOnInit() {
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
  }
  @ViewChild('scroll', { read: ElementRef }) public scroll: ElementRef<any>;

  public onPreviousSearchPosition() {
    this.scroll.nativeElement.scrollTop -= 20;
  }
  public onNextSearchPosition() {
    this.scroll.nativeElement.scrollTop += 20;
  }
  closedialog(): void {
    this.dialogRef.close();
  }
  acceptdata() {
    this.dialogRef.close();
    this.regService.agreeFuncation(true)
    this.regService.agreeFuncationreadaccept(true)
  }
}