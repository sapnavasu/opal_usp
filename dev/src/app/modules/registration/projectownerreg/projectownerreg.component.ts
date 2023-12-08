import {
  Component,
  OnInit,
  ChangeDetectorRef,
  Input,
  ViewChild,
  OnDestroy,
  Output,
  EventEmitter,
  ElementRef,
  ViewEncapsulation
} from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormGroupDirective, FormControl } from '@angular/forms';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import swal from 'sweetalert';
import { Router } from '@angular/router';
import { Subject } from 'rxjs/Subject';
import { RegistrationService } from '../registration.service';
import { debounceTime } from 'rxjs/operators/debounceTime';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { MustMatch } from '@app/common/directives/must-match.validator';
import { ReplaySubject } from 'rxjs/internal/ReplaySubject';
import {BgiJsonconfigServices} from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { Encrypt } from '@app/common/class/encrypt';
import { OfflineProcess } from '../offline-process';
import { Subscription, interval } from 'rxjs';
import { distinctUntilChanged } from 'rxjs/internal/operators/distinctUntilChanged';
import { MatInput } from '@angular/material/input';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatSelectChange } from '@angular/material/select';

export interface Howdidyouknow {
  value: string;
  viewValue: string;
}


@Component({
  selector: 'app-projectownerreg',
  templateUrl: './projectownerreg.component.html',
  styleUrls: ['./projectownerreg.component.scss'],
  encapsulation: ViewEncapsulation.None
})


export class ProjectownerregComponent extends OfflineProcess implements OnInit, OnDestroy {
  howdoyouArr: Howdidyouknow[] = [
    { value: '1', viewValue: 'Call Centre' },
    { value: '2', viewValue: 'Exhibition / Conference' },
    { value: '3', viewValue: 'Lypis Events' },
    { value: '4', viewValue: 'Lypis Email / SMS' },
    { value: '5', viewValue: 'Newspapers / Magazines' },
    { value: '6', viewValue: 'Seminar / Roadshow' },
    { value: '7', viewValue: 'Social Media' },
    { value: '8', viewValue: 'Stakeholders Advisory' },
    { value: '9', viewValue: 'Webinar' },
    { value: '10', viewValue: 'Web Search / Google Ads' },
    { value: '11', viewValue: 'Others' },
  ];

  expectationsArr: Howdidyouknow[] = [
    {value: '1', viewValue: 'Looking for Projects'},
    {value: '2', viewValue: 'Looking for Tenders'},
    {value: '3', viewValue: 'Looking for Procurement Activities'},
    {value: '3', viewValue: 'Looking for Investment Activities'},
  ];

  @Input() countrylist: any = [];
  @Input() rightSideCardCounts: any = [];
  @Input() userGeoDialCode: string;
  @Input() userGeoCountryPk: number;
  @ViewChild('regForm') regForm: FormGroupDirective;
  @ViewChild('landlinenumber') landlinenumber: MatInput;
  @Output() goBack: any = new EventEmitter<any>();
  @Output() regDone: any = new EventEmitter<any>();
  prjoectOwnerForm: FormGroup;
  @Input() socialmedialist: any = [];
  @Input() userIPcountryName: string;
  mobilecode: string;
  landlinecode: string;
  landline_country_code_flag: number;
  mobile_country_code_flag: number;
  searchCountry: string = '';
  searchMobileCC: string = '';
  searchLandLineCC: string = '';
  searchIncorp: string = '';
  searchSector: string = '';
  searchDept: string = '';
  refno: string = '';
  expectationsNameDataTemp: any;
  selectedExpectationsStr: string;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  disableSubmitButton: boolean = false;
  showWelcomeCard: boolean = false;
  showNameCard: boolean = false;
  showEmailCard: boolean = false;
  showThankYouCard: boolean = false;
  showThankYouForRegPage: boolean = false;
  destroy$: Subject<boolean> = new Subject<boolean>();
  otherInputPlaceholder: string = 'Others';
  selectedEstCountry: string;
  selectedIncorpStyle: string;
  selectedSectorStr: string;
  selectedDepartmentStr: string;
  selectedHowDoyouKnow: string;
  selectedSubMasterStr: string;
  intervalSubscription: Subscription;
  maxDate = new Date();
  incorpstylelist: any[] = [];
  @Input() sectorlist: any[] = [];
  @Input() deptlist: any = [];
  filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  sectorFilter: FormControl = new FormControl();
  sectorNameDataTemp: any;
  sectorname:any;
  portalName = BgiJsonconfigServices.bgiConfigData.configuration.projectName;
  intervalDuration = BgiJsonconfigServices.bgiConfigData.configuration.offlineRegDataTrackDuration;
  masterSelectList: any = [];
  masterSelectValidation: any;
  termsacceptvalue:boolean = false;
  isChecked:any = 'accept';

  constructor(private formBuilder: FormBuilder,
    private profileService: ProfileService,
    private cdr: ChangeDetectorRef,
    private router: Router,
    protected regService: RegistrationService,
    protected security: Encrypt,
    private el: ElementRef,
    private recaptchaV3Service: ReCaptchaV3Service) {
      super(security, regService);
    }

  ngOnInit() {

    this.initializeForm();
    this.setInitialValues();

    this.form.howdoyouknowaboutus.valueChanges.takeUntil(this.destroy$).subscribe(type => {
      this.howDoYouKnowChangeListener(type);
    });

    this.form.emailid.valueChanges
      .takeUntil(this.destroy$).pipe(debounceTime(500)).subscribe(value => {
        this.checkByType(value, 'emailid');
      })

    this.form.mobileno.valueChanges
      .takeUntil(this.destroy$).pipe(debounceTime(500)).subscribe(value => {
        this.checkByType(value, 'mobileno');
      })

    this.form.company_name.valueChanges
      .takeUntil(this.destroy$).pipe(debounceTime(500)).subscribe(value => {
        this.checkByType(value, 'company_name');
      });

    this.form.crregno.valueChanges
      .takeUntil(this.destroy$).pipe(debounceTime(500)).subscribe(value => {
        this.checkByType(value, 'crregno');
      });

      this.filteredSector.next(this.sectorlist.slice());
      this.form.oprsector.valueChanges.subscribe(value => {
        if(value){
          let index = this.sectorlist.findIndex(x => x.SectorMst_Pk === value[0]);
          if(index !== -1){
            this.sectorNameDataTemp = this.sectorlist[index].SecM_SectorName;
          }
        }else{
          this.sectorNameDataTemp = '';
        }
      })
      this.sectorFilter.valueChanges
      .subscribe(() => {
        this.filterSector();
      });

      this.prjoectOwnerForm.valueChanges.pipe(debounceTime(1000), 
        distinctUntilChanged((oldval, newval) => {
            this.oldFormValue = oldval;
            this.newFormValue = newval;
            this.oldFormValue['country'] = this.newFormValue['country'] = this.selectedEstCountry;
            this.oldFormValue['incorpstylestr'] = this.newFormValue['incorpstylestr'] = this.selectedIncorpStyle;
            this.oldFormValue['sector'] = this.newFormValue['sector'] = this.selectedSectorStr;
            this.oldFormValue['departmentstr'] = this.newFormValue['departmentstr'] = this.selectedDepartmentStr;
            this.oldFormValue['howdoyouknowstr'] = this.newFormValue['howdoyouknowstr'] = this.selectedHowDoyouKnow;
            this.oldFormValue['othersstr'] = this.newFormValue['othersstr'] = this.selectedSubMasterStr;
            this.oldFormValue['expectationsstr'] = this.newFormValue['expectationsstr'] = this.selectedExpectationsStr;
            return JSON.stringify(oldval) === JSON.stringify(newval);
        })).subscribe(data => super.writeIntoLocalStorage(this.oldFormValue, this.newFormValue,data));

      this.intervalSubscription = interval(this.intervalDuration).subscribe(data => super.runAtRegularIntervals());
  }

  setInitialValues() {
    this.mobilecode = this.userGeoDialCode;
    this.landlinecode = this.userGeoDialCode;
    this.setcountryFlag(this.countrylist[0]['CountryMst_Pk'], 'mobile');
    this.setcountryFlag(this.countrylist[0]['CountryMst_Pk']);
    this.prjoectOwnerForm.controls['est_country'].setValue(this.countrylist[0]['CountryMst_Pk']);
    this.prjoectOwnerForm.controls['est_country'].disable();
    this.selectedCountry(this.countrylist[0]['CountryMst_Pk']);
  }

  initializeForm() {
    this.prjoectOwnerForm = this.formBuilder.group({
      stakeholderType: ['Project Owner', ''],
      stkholder_type: [11, Validators.required],
      company_name: ['', Validators.required],
      est_country: ['', Validators.required],
      firstname: ['', Validators.required],
      lastname: ['', Validators.required],
      emailid: ["", [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      renteremailid: ["", [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      website: ["", Validators.pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
      department: ['', Validators.required],
      otherdept: ['', ''],
      designation: ['', Validators.required],
      oprsector: ['', Validators.required],
      incorpstyle: ['', Validators.required],
      crregno: ['', Validators.required],
      mobilecc: [this.mobilecode, Validators.required],
      mobileno: ['', [Validators.required, Validators.minLength(5)]],
      landlinecc: ['', ''],
      landlineno: ['', Validators.minLength(5)],
      landlineext: ['', ''],
      howdoyouknowaboutus: ['', Validators.required],
      others: ['', ''],
      comments: ['', ''],
      termsandconditions: ['', Validators.requiredTrue],
      captcha: ['', '']
    }, {
      validator: MustMatch('emailid', 'renteremailid')
  });

  }

  howDoYouKnowChangeListener(type: any) {
    if (type == 7) {
      this.form.others.setValidators([Validators.required]);
      this.form.others.updateValueAndValidity();
    } else {
      this.form.others.setValidators(null);
      this.form.others.updateValueAndValidity();
    }
    this.form.others.reset();
  }

  getSocialMediaList() {
    this.regService.getsocilalist()
      .takeUntil(this.destroy$).subscribe(data => {
      this.masterSelectList = data['data'];
    });
  }

  getWebinarExhibitionList(type?: number) {
    this.regService.getwebinarexhibitionist(type)
      .takeUntil(this.destroy$).subscribe(data => {
      this.masterSelectList = data['data'];
    });
  }

  setcountryFlag(value, type?: string) {
    if (type == 'mobile') {
      this.mobile_country_code_flag = value;
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.prjoectOwnerForm.controls['mobilecc'].setValue(x.dialcode);
          this.mobilecode = x.dialcode;
        }
      });
    } else {
      this.landline_country_code_flag = value;
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.prjoectOwnerForm.controls['landlinecc'].setValue(x.dialcode);
          this.landlinecode = x.dialcode;
        }
      });
    }
  }

  getIncorpStyleList(countrypk, stkholdertype) {
    this.profileService.getincorpstyle(countrypk, stkholdertype).subscribe(data => this.incorpstylelist = data['data'].items);
  }

  setCaptcha(token: string) {
    this.captcha = token;
    this.cdr.detectChanges();
  }

  submitRegistration() {
    if (this.prjoectOwnerForm.valid) {
      this.prjoectOwnerForm.controls['est_country'].enable();
      swal({
        title: 'Do you want to submit the Project Owner registration form?',
        text: 'On submission you will receive a verification email to your registered email ID',
        icon: 'success',
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.recaptchaV3Service.execute('projectOwnerRegistration')
            .subscribe((token) => {
              this.prjoectOwnerForm.value['reCaptchaToken'] = token;
              this.prjoectOwnerForm.value['action'] = 'projectOwnerRegistration';
              this.disableSubmitButton = true;
              this.regService.submitProjectOwnerRegistration(this.prjoectOwnerForm.value).
                takeUntil(this.destroy$).
                subscribe(data => {
                  if (data['data'].status == 1) {
                    this.disableSubmitButton = false;
                    this.refno = data['data'].refno;
                    super.clearLocallyStoredData();
                    this.showThankYouForRegPage = true;
                    this.regDone.emit(true);
                  } else {
                    swal({
                      title: data['data'].title,
                      text: data['data'].msg,
                      icon: 'warning',
                      closeOnClickOutside: false
                    }).then(() => {
                      this.prjoectOwnerForm.controls['est_country'].disable();
                      this.disableSubmitButton = false;
                    })
                  }
                },(error) => {this.disableSubmitButton = false; this.prjoectOwnerForm.controls['est_country'].disable();});
              });
            }
        });
    } else {
      this.focusInvalidInput();
    }
  }

  checkByType(value: any, contorlName: string) {
   
  }

  cancelAction() {
    swal({
      title: 'Cancel Registration!',
      text: 'Do you want to cancel your JSRS registration?',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.resetAll();
        this.router.navigate(['admin/login']);
      }
    })
  }

  backToFirstPage() {
    if (this.dirtyControls().length > 0) {
      swal({
        title: 'Cancel Registration!',
        text: 'Do you want to cancel your JSRS registration?',
        icon: 'warning',
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.goBack.emit(true);
        }
      });
    } else {
      this.goBack.emit(true);
    }
  }

  resetAll() {
    this.regForm.resetForm();
    this.initializeForm();
    this.disableSubmitButton = false;
    this.showWelcomeCard = false;
    this.showNameCard = false;
    this.showEmailCard = false;
    this.showThankYouCard = false;
    this.showThankYouForRegPage = false;
    this.setInitialValues();
  }

  dirtyControls() {
    return Object.keys(this.form).filter(control => {
      if (control !== 'inv_identity' && this.prjoectOwnerForm.controls[control].touched) {
        return control;
      }
    })
  }

  selectedSector(event){
    this.selectedSectorStr = event.source.selected.map(x => x.viewValue).join('#');
  }

  focusInvalidInput() {
    for (const key of Object.keys(this.form)) {
      if (this.prjoectOwnerForm.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        invalidControl.focus();
        break;
      }
    }
  }

  otherPlaceholderChange(val: any){
    let selectedOption = val.value;
    if(selectedOption != 7 && selectedOption != 2 && selectedOption != 9){
      let index = this.howdoyouArr.findIndex(x => x.value == selectedOption);
      if(index !== -1){
        this.otherInputPlaceholder = this.howdoyouArr[index].viewValue;
      }
      this.otherInputPlaceholder = this.otherInputPlaceholder + ' (Please specify)';
      this.form.others.setValidators(null);
      this.form.others.updateValueAndValidity();
      if(selectedOption == 11){
        this.form.others.setValidators([Validators.required]);
        this.form.others.updateValueAndValidity();
      }
    } else {
      this.masterSelectValidation = this.howdoyouArr.filter(x => x.value == selectedOption)[0]['viewValue'];
      if (selectedOption == 7) {
        this.getSocialMediaList();
      } else if (selectedOption == 2) {
        this.getWebinarExhibitionList(2);
      } else if (selectedOption == 9) {
        this.getWebinarExhibitionList(1);
      }
      this.form.others.setValidators([Validators.required]);
      this.form.others.updateValueAndValidity();
      this.form.others.reset();
    }
  }

  //Getters & Setters
  get form() {
    return this.prjoectOwnerForm.controls;
  }

  get firstname() {
    return this.prjoectOwnerForm.controls['firstname'].value;
  }
  get lastname() {
    return this.prjoectOwnerForm.controls['lastname'].value;
  }
  get fullname() {
    return this.firstname + ' ' + this.lastname;
  }
  get orgname() {
    return this.prjoectOwnerForm.controls['company_name'].value;
  }
  get email() {
    return this.prjoectOwnerForm.controls['emailid'].value;
  }
  get howdoyouknow() {
    return this.prjoectOwnerForm.controls['howdoyouknowaboutus'].value;
  }


  set captcha(token: string) {
    this.form.captcha.setValue(token);
  }

  selectedCountry(value) {
    this.countrylist.forEach(x => {
      if (x.CountryMst_Pk == value) {
        this.selectedEstCountry = x.CyM_CountryName_en;
        this.getIncorpStyleList(value, this.form.stkholder_type.value);
        this.checkByType(this.form.crregno.value, 'crregno');
      }
    });
  }

  selectedExpectations(value){
    if(value){
      let index = this.expectationsArr.findIndex(x => x.value === value[0]);
      if(index !== -1){
        this.expectationsNameDataTemp = this.expectationsArr[index].viewValue;
      }
    }else{
      this.expectationsNameDataTemp = '';
    }
  }

  checkOrgNameHasValue() {
    this.showWelcomeCard = false;
    if (this.orgname) {
      this.showWelcomeCard = true;
    }
  }
  checkFirstAndLastNameHasValue() {
    this.showNameCard = false;
    if (this.firstname &&  this.form.renteremailid.valid) {
      this.showNameCard = true;
    }
    this.checkHowDoYouKnowHasValue();
  }

  checkHowDoYouKnowHasValue() {
    this.showThankYouCard = false;
    if (this.firstname && this.howdoyouknow && this.form.renteremailid.valid && !this.termsacceptvalue) {
      this.showThankYouCard = true;
    }
  }
  checkValue(e){
    if(e == "accept"){
      this.termsacceptvalue = true;
      this.showThankYouCard = false;
    }else if(e == "notaccept" && this.firstname && this.howdoyouknow && this.form.renteremailid.valid){
      this.termsacceptvalue = false;
      this.showThankYouCard = true;
    }
  }
  changeCountryCode(pk: any) {
    this.setcountryFlag(pk.value, 'mobile');
    this.setcountryFlag(pk.value);
  }

  filterSector() {
    if (!this.sectorlist) {
      return;
    }
    // get the search keyword
    let search = this.sectorFilter.value;
    if (!search) {
      this.filteredSector.next(this.sectorlist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredSector.next(
      this.sectorlist.filter(sector => sector.SecM_SectorName.toLowerCase().indexOf(search) > -1)
    );
  }

  deptChanges(event: MatSelectChange) {
    this.form.otherdept.setValidators(null);
    if(event.value == 0) {
      this.form.otherdept.setValue(null);
      this.form.otherdept.setValidators([Validators.required]);
      this.form.otherdept.markAsUntouched();
    }
    this.form.otherdept.updateValueAndValidity();
  }

  ngOnDestroy(): void {
    this.intervalSubscription.unsubscribe();
    this.destroy$.next(true);
    this.destroy$.unsubscribe();
  }
}

