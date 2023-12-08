import {Component, OnInit, OnDestroy} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators, FormArray} from '@angular/forms';
import {Subject } from 'rxjs';
import {ActivatedRoute, Router} from '@angular/router';
import { common_var as paramsValue } from '../../../../environments/common_veriables';

import { Viewdialog } from '../modal/viewdialog'
import swal from 'sweetalert';
import { debounceTime } from 'rxjs/internal/operators/debounceTime';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { MustMatch } from '@app/common/directives/must-match.validator';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { MatSelectChange } from '@angular/material/select';
import { CountryService } from '@app/common/newcountry/service/country.service';
import { ErrorStateMatcher } from '@angular/material/core';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { MatDialog } from '@angular/material/dialog';
import { AfterloginService } from '../afterlogin.service';

@Component({
  selector: 'app-subscription',
  templateUrl: './subscription.component.html',
  styleUrls: ['./subscription.component.scss']
})
export class SubscriptionComponent implements OnInit, OnDestroy {
  displayedColumns = ['position', 'name', 'weight', 'symbol'];
  public afterform: FormGroup;
  readonly STAKEHOLDERTYPE: number = 6;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  mobilecode: string = paramsValue.libyaDialCode;
  landlinecode: string = paramsValue.libyaDialCode;
  landline_country_code_flag: number = paramsValue.libyaPk;
  mobile_country_code_flag: number = paramsValue.libyaPk;
  countrylist: any = [];
  deptlist: any = [];
  searchCountry: string = '';
  searchMobileCC: string = '';
  searchLandLineCC: string = '';
  stakeholderDtl: any = [];
  destroy$: Subject<boolean> = new Subject<boolean>();
  classificationlist: any = [];
  mapToggle: FormControl = new FormControl(false);
  termsandconditions: FormControl = new FormControl(false, Validators.requiredTrue);
  showNameCard: boolean = false;
  bgiConfigAllowedStkholders = BgiJsonconfigServices.bgiConfigData.configuration.afterLoginStkholderTypePks;
  animationState = 'out';
  animationState1 = 'out';
  animationState2 = 'out';
  packageDtl: any = [];
  packageForm: FormGroup;
  selectedAddnlPackage: any = [];
  subTotal: number = 0;
  additionalPackageTotalPrice: number = 0;
  subTotalBeforePromo: number = 0;
  promoCodeCtrl: FormControl = new FormControl('');
  promoApplied: boolean = false;
  promoDtl: any = [];
  showPaymentPage: boolean = false;
  defaultdeptlist:any  = [];
  companydeptlist:any  = [];
  invoiceref: any;
  invoiceDownloadLink: any;
  showResponsiveLoader: boolean = false;
  paymentDtl: any;


  constructor(private formBuilder: FormBuilder,
      private countryService: CountryService,
      private enterpriseService: EnterpriseService,
      private afterloginService: AfterloginService,
      private profileService: ProfileService,
      private route: ActivatedRoute,
      private dialog: MatDialog,
      private router: Router) {

  }

  ngOnInit() {
    this.initializeForm();
    this.getStakeholderDtls();
    this.mapPrimaryContactAsPaymentContact();

    this.form.emailid.valueChanges
      .takeUntil(this.destroy$).pipe(debounceTime(1000)).subscribe(value => {
        this.checkByType(value, 'emailid');
      })

    this.form.mobileno.valueChanges
      .takeUntil(this.destroy$).pipe(debounceTime(1000)).subscribe(value => {
        this.checkByType(value, 'mobileno');
      })
  }
  
  initializeForm() {
    this.packageForm = this.formBuilder.group({
      headCount: ['', Validators.required],
      annualSales: ['', Validators.required],
      addnlPackage: this.formBuilder.array([])
    });

    this.afterform = this.formBuilder.group({
      pk: ['',''],
      firstname: ['', Validators.required],
      lastname: ['', Validators.required],
      emailid: ['', [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      renteremailid: ['', [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      department: ['', Validators.required],
      designation: ['', Validators.required],
      mobileno: ['', [Validators.required, Validators.minLength(5)]],
      landlineno: ['', Validators.minLength(5)],
      mobilecc: ['', ''],
      landlinecc: ['', ''],
      landlineext: ['', ''],
      otherdept: ['','']
    },{
      validator: MustMatch('emailid', 'renteremailid')
    });
  }
  getCountryList() {
    this.countryService.getCountry().takeUntil(this.destroy$).subscribe(data => {
      this.countrylist = data['data'];
    });
  }
  getDefaultDeptList() {
    this.enterpriseService.getDefaultDeptList()
    .takeUntil(this.destroy$).subscribe(data => this.defaultdeptlist = this.deptlist = data['data'].items)
  }
  getCompanyDeptList() {
    this.enterpriseService.getActiveDeptList()
    .takeUntil(this.destroy$).subscribe(data => this.companydeptlist = data['data'].items)
  }
  setcountryFlag(value, type?: string) {
    if (type == 'mobile') {
      this.mobile_country_code_flag = value;
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.afterform.controls['mobilecc'].setValue(x.dialcode);
          this.mobilecode = x.dialcode;
        }
      });
    } else {
      this.landline_country_code_flag = value;
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.afterform.controls['landlinecc'].setValue(x.dialcode);
          this.landlinecode = x.dialcode;
        }
      });
    }
  }
  getStakeholderDtls() {
    this.route.snapshot.data['data'].subscriptionStatus.takeUntil(this.destroy$).subscribe(data => {
      if(data['data'] == 'AL') {
        this.route.snapshot.data['data'].stakeholderDtl.takeUntil(this.destroy$).subscribe(data => {
            this.stakeholderDtl = data['data'];
            if (!this.bgiConfigAllowedStkholders.includes(data['data'].stakeholderType)) {
              this.logOut();
            }

            if(!this.stakeholderDtl['invoiceGenerated'] && this.stakeholderDtl['origin'] == 'INTERNATIONAL'){
              this.packageDtl = this.stakeholderDtl['packageDtl'];
              this.subTotal = this.subTotalBeforePromo = Number(this.packageDtl.subscription.packageBasePrice);
              this.createAdditionalPackageFormArray();
              this.calculateSubTotal();
            } else if(this.stakeholderDtl['invoiceGenerated'] && this.stakeholderDtl['origin'] == 'INTERNATIONAL'){
              this.packageDtl = this.stakeholderDtl['packageDtl'];
              this.subTotal = this.subTotalBeforePromo = Number(this.packageDtl.subscription.packageBasePrice);
              this.selectedAddnlPackage = this.stakeholderDtl['selectedAddnlPackage'];
              this.createAdditionalPackageFormArray();
              this.calculateSubTotal();
              this.invoiceref = this.stakeholderDtl['invoice'];
              this.invoiceDownloadLink = this.stakeholderDtl['invoiceLink'];
              this.promoDtl = this.stakeholderDtl['promoDtl'];
              this.promoApplied = (this.stakeholderDtl['promoDtl'].length != 0) ? true : false;
              this.promoCodeCtrl.setValue(this.promoDtl['promoCodeText']);
              this.paymentDtl = this.stakeholderDtl['paymentDtl'];
              this.showPaymentPage = true;
            } 
            
            if(this.stakeholderDtl['invoiceGenerated'] && this.stakeholderDtl['origin'] != 'INTERNATIONAL') { 
             this.packageDtl = this.stakeholderDtl['packageDtl'];
             this.promoDtl = this.stakeholderDtl['promoDtl'];
             this.promoApplied = (this.promoDtl.length != 0) ? true : false;
             this.selectedAddnlPackage = this.stakeholderDtl['selectedAddnlPackage'];
             this.subTotal = this.subTotalBeforePromo = Number(this.packageDtl.subscription.packageBasePrice);
             this.subTotal = this.promoApplied ? this.promoDtl['total'] : this.subTotal;
             this.calculateSubTotal();
             this.promoCodeCtrl.setValue(this.promoDtl['promoCodeText']);
             this.invoiceref = this.stakeholderDtl['invoice'];
             this.invoiceDownloadLink = this.stakeholderDtl['invoiceLink'];
             this.paymentDtl = this.stakeholderDtl['paymentDtl'];
             this.showPaymentPage = true;

            }
          },
          (error) => '',
          () => {
            this.getDefaultDeptList();
            this.getCompanyDeptList();
            this.getClassificationlist();
            this.getCountryList();
          });
      } else {
        this.router.navigate(['admin/login']);
      }
    });
  }
  getClassificationlist() {
    this.afterloginService.getClassificationList().takeUntil(this.destroy$).subscribe(data => {
      this.classificationlist = data['data'];
    });
  }
  mapPrimaryContactAsPaymentContact() {
    this.mapToggle.valueChanges.subscribe(isToggled => {
      if (isToggled) {
        this.afterform.patchValue(this.stakeholderDtl['primaryContact']);
        this.mobile_country_code_flag = this.stakeholderDtl['primaryContact']['mobilecc'];
        this.landline_country_code_flag = this.stakeholderDtl['primaryContact']['landlinecc'];
        this.mobilecode = this.stakeholderDtl['primaryContact']['mobileDialCode'];
        this.landlinecode = this.stakeholderDtl['primaryContact']['landlineDialCode'];
        this.afterform.disable();
      } else {
        this.afterform.enable();
        this.formReset();
      }
      this.checkEmailHasValue();
    });
  }
  formReset() {
    this.afterform.reset();
    this.mobile_country_code_flag = paramsValue.libyaPk;
    this.landline_country_code_flag = paramsValue.libyaPk;
  }
  checkEmailHasValue() {
    this.showNameCard = false;
    if (this.firstname && this.renteremailid && this.form.renteremailid.valid){
      this.showNameCard = true;
    }
  }
  onCancellingSubscription() {
    swal({
      title: 'Warning',
      text: 'Do you want to cancel this subscription?',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((cancelSubscription) => {
      if (cancelSubscription) {
        this.logOut();
      }
    });
  }
  logOut() {
    if (localStorage.getItem('v3logindata') !== null) {
      this.profileService.logout().takeUntil(this.destroy$).subscribe(data => {
        localStorage.removeItem('v3logindata');
        localStorage.removeItem('v3logindatarefresh');
      },
        () => '',
        () => {
          this.router.navigate(['admin/login']);
        });
    }
  }
  checkByType(value: any, contorlName: string) {
   
  }

  get form() {
    return this.afterform.controls;
  }
  get firstname() {
    return this.form.firstname.value;
  }
  get renteremailid() {
    return this.form.renteremailid.value;
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

  openDialog(): void {
    const dialogRef = this.dialog.open(Viewdialog);
    dialogRef.afterClosed().subscribe(result => {
    });
  }

  getPackageDtls() {
    if(this.headCount && this.annualSales) {
      this.afterloginService.getPackage(this.headCount, this.annualSales).takeUntil(this.destroy$).subscribe(data => {
        this.packageDtl = data['data'];
        this.subTotal = this.subTotalBeforePromo = Number(this.packageDtl.subscription.packageBasePrice);
      },
      () => '',
      () => {
        this.createAdditionalPackageFormArray();
        this.calculateSubTotal();
      });
    }
  }

  createAdditionalPackageFormArray() {
    this.resetAdditionalPackageArr();
    if(this.packageDtl['additionalpackage'].length > 0) {
      this.packageDtl['additionalpackage'].forEach(index =>  this.addnlPackageFormArrControl.push(new FormControl(false)));
    }
  }

  resetAdditionalPackageArr() {
    let formArray = this.packageForm.controls['addnlPackage'] as FormArray;
      while(formArray.length !== 0) {
        formArray.removeAt(0);
      }
  }

  toggleShowDiv(divName: string) {
    if (divName === 'select') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
    
  }
  
  selectdecription(divName: string) {
    if (divName === 'all') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
    
  }
  businesssevice(divName: string) {
    if (divName === 'service') {
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
    
  }

  calculateSubTotal() {
    this.additionalPackageTotalPrice = 0;
    if(this.selectedAddnlPackage.length > 0) {
      this.selectedAddnlPackage.forEach(packagePk => {
        let index = this.packageDtl['additionalpackage'].findIndex(addnlpackage => addnlpackage.subscriptionPk == packagePk);
        this.additionalPackageTotalPrice +=  Number(this.packageDtl['additionalpackage'][index]['packageBasePrice']);
      })
    }
  }

  selectAdditionalPackage(event, pk: number) {
    if(event.checked) {
      this.selectedAddnlPackage.push(pk);
    } else {
      let index = this.selectedAddnlPackage.indexOf(pk);
      this.selectedAddnlPackage.splice(index, 1);
    }
    this.selectedAddnlPackage.sort();
  }

  removeAdditionalPackage(addnlpackagepk: number) {
    let index = this.selectedAddnlPackage.indexOf(addnlpackagepk);
    this.selectedAddnlPackage.splice(index, 1);
    this.calculateSubTotal();
  }

  applyPromoCode() {
    if (this.promoCodeCtrl.value) {
      this.promoApplied = false;
      let promodtls = { promoCode: this.promoCodeCtrl.value, subTotal: this.subTotal, 
        classification: this.packageDtl['classicationPk'], country: this.stakeholderDtl['countryPk']  };
      this.afterloginService.applyPromoCode(promodtls).takeUntil(this.destroy$).subscribe(data => {
        this.promoDtl = data['data'];
        this.promoCodeCtrl.setErrors({ invalidPromo: true });
        if(data['data'].total) {
          this.promoApplied = true;
          this.promoCodeCtrl.setErrors(null);
          this.subTotal = this.promoDtl['total'];
        }
      });
    }
  }

  cancelPromo() {
    this.promoCodeCtrl.setErrors(null);
    this.promoApplied = false;
    this.promoCodeCtrl.reset();
    this.promoDtl = [];
    this.subTotal = this.subTotalBeforePromo;
  }

  submitAndGenerateInvoice() {
    
    swal({
      title: "Do you want to generate an invoice for this subscription?",
      text: "You cannot edit the subscription once the invoice is generated.",
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((generateInvoice) => {
      if(generateInvoice) {
        this.showResponsiveLoader = true;
        this.afterform.enable();
        if(this.afterform.valid) {
          this.afterform.setErrors(null);
          this.afterform.value['classicationPk'] = this.packageDtl['classicationPk'];
          this.afterform.value['subscriptionPk'] = this.packageDtl['subscription']['subscriptionPk'];
          this.afterform.value['companyName'] = this.stakeholderDtl['companyName'];
          this.afterform.value['selectedAddnlPackage'] = this.selectedAddnlPackage;
          this.afterform.value['promoCode'] = this.promoApplied ? this.promoDtl['promoCode'] : null;
          this.afterform.value['amount'] = this.subTotal + this.additionalPackageTotalPrice;
          this.afterform.value['packageDtl'] = this.packageDtl;
          this.afterloginService.addOrMapPayContact(this.afterform.value).takeUntil(this.destroy$)
          .subscribe(data => {
            this.afterform.disable();
            if(data['data'].status == 1) {
              this.showPaymentPage = true;
              this.showResponsiveLoader = false;
              this.invoiceref = data['data'].invoice;
              this.invoiceDownloadLink = data['data'].invoiceLink;
            }
          },
          (error) => this.showResponsiveLoader = false);
        }
      }
    });

  }

  slideToggle(event) {
    this.deptlist = this.defaultdeptlist;
    if(event.checked) {
      this.deptlist = this.companydeptlist;
    }
  }

  get isPackageSelected() {
    return this.packageForm.controls['headCount'].value && this.packageForm.controls['annualSales'].value;
  }

  get designation() {
    return this.afterform.get('designation').value;
  }

  get headCount() {
    return this.packageForm.get('headCount').value;
  }

  get annualSales() {
    return this.packageForm.get('annualSales').value;
  }

  get addnlPackageFormArrControl() {
    return (this.packageForm.get('addnlPackage') as FormArray).controls;
  }

  ngOnDestroy(): void {
    this.destroy$.next(true);
    this.destroy$.unsubscribe();
  }
}
