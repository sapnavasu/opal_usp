import { Component, OnInit, ChangeDetectorRef, Renderer2, Input, ViewChild, OnDestroy, ViewEncapsulation, Output, EventEmitter, ElementRef } from '@angular/core';
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
import { OfflineProcess } from '../offline-process';
import { Encrypt } from '@app/common/class/encrypt';
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
  selector: 'app-corporatereg',
  templateUrl: './corporatereg.component.html',
  styleUrls: ['./corporatereg.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class CorporateregComponent extends OfflineProcess implements OnInit, OnDestroy {
  howdoyouArr: Howdidyouknow[] = [
    {value: '1', viewValue: 'Call Centre'},
    {value: '2', viewValue: 'Exhibition / Conference'},
    {value: '3', viewValue: 'Lypis Events'},
    {value: '4', viewValue: 'Lypis Email / SMS'},
    {value: '5', viewValue: 'Newspapers / Magazines'},
    {value: '6', viewValue: 'Seminar / Roadshow'},
    {value: '7', viewValue: 'Social Media'},
    {value: '8', viewValue: 'Stakeholders Advisory'},
    {value: '9', viewValue: 'Webinar'},
    {value: '10', viewValue: 'Web Search / Google Ads'},
    {value: '11', viewValue: 'Others'},
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
  investorForm: FormGroup;
  @Input() socialmedialist: any = [];
  @Input() sectorlist: any = [];
  mobilecode: string;
  landlinecode: string;
  landline_country_code_flag: number;
  mobile_country_code_flag: number;
  searchCountry: string = '';
  searchMobileCC: string = '';
  searchLandLineCC: string = '';
  searchIncorp: string = '';
  refno: string = '';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  disableSubmitButton: boolean = false;
  showWelcomeCard: boolean = false;
  showNameCard: boolean = false;
  showEmailCard: boolean = false;
  showThankYouCard: boolean = false;
  showThankYouForRegPage: boolean = false;
  destroy$: Subject<boolean> = new Subject<boolean>();
  otherInputPlaceholder: string = 'Others';
  selectedEstCountry: string = null;
  errors: string[];
  incorpstylelist: any = [];
  @Input() deptlist: any = [];
  maxDate = new Date();
  filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  sectorFilter: FormControl = new FormControl();
  sectorNameDataTemp: any;
  sectorname:any;
  searchSector:any;
  expectationsNameDataTemp: any;
  portalName = BgiJsonconfigServices.bgiConfigData.configuration.projectName;
  masterSelectList: any = [];
  masterSelectValidation: any;
  termsacceptvalue:boolean = false;
  selectedIncorpStyle: string;
  selectedSectorStr: string;
  selectedExpectationsStr: string;
  selectedDepartmentStr: string;
  intervalSubscription: Subscription;
  selectedHowDoyouKnow: string;
  selectedSubMasterStr: string;
  oldFormValue: any;
  newFormValue: any;
  intervalDuration = BgiJsonconfigServices.bgiConfigData.configuration.offlineRegDataTrackDuration;
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
      this.sectorFilter.valueChanges
      .subscribe(() => {
        this.filterSector();
      });

      this.initializeFormValueChange();

      this.intervalSubscription = interval(this.intervalDuration).subscribe(data => super.runAtRegularIntervals());
  }

  setInitialValues() {
    this.mobilecode = this.userGeoDialCode;
    this.landlinecode = this.userGeoDialCode;
    this.setcountryFlag(this.userGeoCountryPk, 'mobile');
    this.setcountryFlag(this.userGeoCountryPk);
    this.investorForm.controls['est_country'].setValue(this.userGeoCountryPk);
    this.selectedCountry(this.userGeoCountryPk);
  }

  initializeForm() {
    this.investorForm = this.formBuilder.group({
      stakeholderType: ['Investor', ''],
      stkholder_type: [9, Validators.required],
      inv_identity: ['1', Validators.required],
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
      incorpstyle: ['', Validators.required],
      oprsector: ['', Validators.required],
      crregno: ['', Validators.required],
      mobilecc: [this.mobilecode, Validators.required],
      mobileno: ['',[ Validators.required, Validators.minLength(5)]],
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
          this.investorForm.controls['mobilecc'].setValue(x.dialcode);
          this.mobilecode = x.dialcode;
        }
      });
    } else {
      this.landline_country_code_flag = value;
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.investorForm.controls['landlinecc'].setValue(x.dialcode);
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
    if (this.investorForm.valid) {

      //if(this.form.captcha.value == null || this.form.captcha.value == ''){
        if(false){
        swal({
          title: 'Alert!',
          text: 'Kindly verify captcha before submitting the registration form.',
          icon: 'warning',
          closeOnClickOutside:false
        })
      }else{
        swal({
          title: 'Please confirm to proceed with your registration as a Investor. ',
          text: '',
          icon: 'success',
          buttons: ['Cancel', 'Proceed'],
          dangerMode: true,
          closeOnClickOutside:false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.recaptchaV3Service.execute('investorRegistration')
     .subscribe((token) => {
      this.investorForm.value['reCaptchaToken'] = token;
      this.investorForm.value['action'] = 'investorRegistration';
      this.disableSubmitButton = true;
      this.regService.submitInvestorRegistration(this.investorForm.value).
        takeUntil(this.destroy$).
        subscribe(data => {
          if(data['data'].status == 1){
            this.disableSubmitButton = false;
            super.clearLocallyStoredData();
            this.refno = data['data'].refno;
            this.showThankYouForRegPage = true;
            this.regDone.emit(true);
          }else {
            swal({
              title: data['data'].title,
              text: data['data'].msg,
              icon: 'warning',
              closeOnClickOutside:false
            }).then(() => {
              this.disableSubmitButton = false;
            })
          }
        });
     },(error) => {
       this.errors = ['reCaptcha V3 error'];
     });




            }
        });
      }
    }else {
      this.focusInvalidInput();
    }
  }

  checkByType(value: any, contorlName: string) {
    
  }

  initializeFormValueChange(){
    this.investorForm.valueChanges.pipe(debounceTime(1000), 
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

  }

  cancelAction() {
    swal({
      title: 'Cancel Registration!',
      text: 'Do you want to cancel your JSRS registration?',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside:false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.resetAll();
        this.router.navigate(['admin/login']);
      }
    })
  }

  switchInvestorType(oldType, newtype) {
    swal({
      text:'Are you sure you want to switch investor type?. If yes all the entered data will be lost',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside:false
    }).then((willGoBack) => {
      if(willGoBack){
        this.resetAll();
        this.investorForm.controls['inv_identity'].setValue(newtype);
        if(newtype == 1){
          this.form.company_name.setValidators([Validators.required]);
          this.form.crregno.setValidators([Validators.required]);
          this.form.incorpstyle.setValidators([Validators.required]);
          this.form.department.setValidators([Validators.required]);
          this.form.designation.setValidators([Validators.required]);
        }else{
          this.form.company_name.setValidators(null);
          this.form.crregno.setValidators(null);
          this.form.department.setValidators(null);
          this.form.designation.setValidators(null);
          this.form.incorpstyle.setValidators(null);
        }
  }else{
    this.investorForm.controls['inv_identity'].setValue(oldType);
    if(oldType == 1){
      this.form.company_name.setValidators([Validators.required]);
      this.form.crregno.setValidators([Validators.required]);
      this.form.incorpstyle.setValidators([Validators.required]);
      this.form.department.setValidators([Validators.required]);
      this.form.designation.setValidators([Validators.required]);
    }else{
      this.form.company_name.setValidators(null);
      this.form.department.setValidators(null);
      this.form.designation.setValidators(null);
      this.form.crregno.setValidators(null);
      this.form.incorpstyle.setValidators(null);
    }
  }
  this.form.company_name.updateValueAndValidity();
  this.form.crregno.updateValueAndValidity();
  this.form.incorpstyle.updateValueAndValidity();
  this.investorForm.controls['est_country'].setValue(this.userGeoCountryPk);
  this.selectedCountry(this.userGeoCountryPk);
  this.initializeFormValueChange();
    });
  }

  backToFirstPage(){
    if(this.dirtyControls().length > 0){
      swal({
        title: 'Cancel Registration!',
        text: 'Do you want to cancel your JSRS registration?',
        icon: 'warning',
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside:false
      }).then((willGoBack) => {
        if(willGoBack){
          this.goBack.emit(true);
        }
      });
    }else {
      this.goBack.emit(true);
    }
  }

  resetAll(){
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

  corporateInvestorSelected(event){
    if(this.dirtyControls().length > 0){
      this.switchInvestorType('2','1');
    }else{
      this.investorForm.controls['inv_identity'].setValue(event.value);
      this.investorForm.controls['est_country'].setValue(this.userGeoCountryPk);
      this.selectedCountry(this.userGeoCountryPk);
      this.form.company_name.setValidators([Validators.required])
      this.form.company_name.updateValueAndValidity();
      this.form.crregno.setValidators([Validators.required])
      this.form.crregno.updateValueAndValidity();
      this.form.incorpstyle.setValidators([Validators.required])
      this.form.incorpstyle.updateValueAndValidity();
      this.form.department.setValidators([Validators.required])
      this.form.department.updateValueAndValidity();
      this.form.designation.setValidators([Validators.required])
      this.form.designation.updateValueAndValidity();
    }
  }

  individualInvestorSelected(event){
    if(this.dirtyControls().length > 0){
      this.switchInvestorType('1','2');
    }else{
      this.investorForm.controls['inv_identity'].setValue(event.value);
      this.investorForm.controls['est_country'].setValue(this.userGeoCountryPk);
      this.selectedCountry(this.userGeoCountryPk);
      this.form.company_name.setValidators(null)
      this.form.company_name.updateValueAndValidity();
      this.form.crregno.setValidators(null)
      this.form.crregno.updateValueAndValidity();
      this.form.incorpstyle.setValidators(null)
      this.form.incorpstyle.updateValueAndValidity();
      this.form.department.setValidators(null)
      this.form.department.updateValueAndValidity();
      this.form.designation.setValidators(null)
      this.form.designation.updateValueAndValidity();
    }
  }



  dirtyControls(){
    return Object.keys(this.form).filter(control => {
      if(control !== 'inv_identity' && this.investorForm.controls[control].touched){
        return control;
      }
    })
  }

  focusInvalidInput(){
    for (const key of Object.keys(this.form)) {
      if (this.investorForm.controls[key].invalid) {
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
    return this.investorForm.controls;
  }

  get firstname() {
    return this.investorForm.controls['firstname'].value;
  }
  get lastname() {
    return this.investorForm.controls['lastname'].value;
  }
  get fullname() {
    return this.firstname + ' ' + this.lastname;
  }
  get orgname() {
    return this.investorForm.controls['company_name'].value;
  }
  get email() {
    return this.investorForm.controls['emailid'].value;
  }
  get investorType() {
    return this.investorForm.controls['inv_identity'].value;
  }
  get howdoyouknow() {
    return this.investorForm.controls['howdoyouknowaboutus'].value;
  }

  get nameofRegister() {
    if(this.investorType == 1){
      return this.orgname;
    }
    return this.fullname
  }

  set captcha(token: string) {
    this.form.captcha.setValue(token);
  }

  selectedCountry(value){
    this.countrylist.forEach(x => {
      if (x.CountryMst_Pk == value) {
        this.selectedEstCountry = x.CyM_CountryName_en;
        this.getIncorpStyleList(value, this.form.stkholder_type.value);
        this.checkByType(this.form.crregno.value, 'crregno');
      }
    });
  }

  selectedSector(event, value=''){
    if(value){
      let index = this.sectorlist.findIndex(x => x.SectorMst_Pk === value[0]);
      if(index !== -1){
        this.sectorNameDataTemp = this.sectorlist[index].SecM_SectorName;
      }
    }else{
      this.sectorNameDataTemp = '';
    }
    this.selectedSectorStr = event.source.selected.map(x => x.viewValue).join('#');
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
    if (this.orgname && this.investorType == 1) {
      this.showWelcomeCard = true;
    } else {
      this.showWelcomeCard = false;
    }
  }
  checkFirstAndLastNameHasValue() {
    if (this.investorType == 1 && this.firstname && this.email && this.form.emailid.valid) {
      this.showNameCard = true;
    } else if(this.investorType == 2){
      this.showWelcomeCard = true;
    }
    else {
      this.showNameCard = false;
    }
    this.checkHowDoYouKnowHasValue();
  }
  checkEmailHasValue() {
    if(this.investorType == 1 && this.firstname  && this.form.renteremailid.valid){
      this.showEmailCard = true;
      this.showNameCard = true;
    }else if(this.investorType == 2){
      if (this.form.renteremailid.valid) {
        this.showEmailCard = true;
      } else {
        this.showEmailCard = false;
      }
    }else {
      this.showEmailCard = false;
      this.showNameCard = false;
    }
    this.checkHowDoYouKnowHasValue();
  }

  checkHowDoYouKnowHasValue(){
    this.showThankYouCard = false;
    if(this.firstname && this.howdoyouknow && this.form.renteremailid.valid && !this.termsacceptvalue){
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

  changeCountryCode(pk: any){
    this.setcountryFlag(pk.value,'mobile');
    this.setcountryFlag(pk.value);
  }

  ngOnDestroy(): void {
    this.intervalSubscription.unsubscribe();
    this.destroy$.next(true);
    this.destroy$.unsubscribe();
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
    if (event.value == 0) {
      this.form.otherdept.setValue(null);
      this.form.otherdept.setValidators([Validators.required]);
      this.form.otherdept.markAsUntouched();
    }
    this.form.otherdept.updateValueAndValidity();
  }
}
