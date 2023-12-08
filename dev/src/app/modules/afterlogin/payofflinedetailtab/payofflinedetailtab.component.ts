import {Component, OnInit, OnChanges, Input, EventEmitter, Output, ViewChild} from '@angular/core';
import {FormGroup, FormBuilder, Validators} from '@angular/forms';
import { AfterloginService } from '../afterlogin.service';
import {  DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { Router } from '@angular/router';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';
import swal from 'sweetalert';
import { Subject } from 'rxjs/internal/Subject';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { DriveInput } from '@app/common/classes/driveInput';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { Filee } from '@app/@shared/filee/filee';

declare var $;

const moment = _rollupMoment || _moment;

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
  selector: 'app-payofflinedetailtab',
  templateUrl: './payofflinedetailtab.component.html',
  styleUrls: ['./payofflinedetailtab.component.scss'],
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ]
})
export class PayofflinedetailtabComponent implements OnInit, OnChanges {
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @Input('paymentDetails') paymentDetails: any;
  @Input('contactusData') contactusData: any;
  @Input('discount') discount: boolean=false;
  @Output() showPaymentSuccess: EventEmitter<any> = new EventEmitter<any>();
  @Output('updatePayDtls') updatePayDtls: any = new EventEmitter<any>();
  @ViewChild('photoRef') photoRef: Filee;
  
  disableBtn: boolean = false;
  public afterform: FormGroup;
  checkform: FormGroup;
  drv_proofdoc: DriveInput;
  maxDate = new Date();
  selectedPaymentType: string;
  destroy$: Subject<boolean> = new Subject<boolean>();
  showDeclineComments: boolean = false;

  constructor(private formBuilder: FormBuilder,  
    private afterloginService: AfterloginService,
    private profileService: ProfileService,
    private router: Router) {
    
  }

  ngOnInit() {
    this.showDeclineComments = window.history.state.paymentDeclined;
    this.checkform = this.formBuilder.group({
      bankName: ['', Validators.required],
      transcdate: ['', Validators.required],
      // trasactionid: ['', Validators.required],
      // banktransfer: ['', Validators.required],
      checkno:['', Validators.required],
      paymentmode:['', Validators.required],
      proofdoc:['', Validators.required],
      currency: ['',''],
      amount: ['','']
    });
    this.drv_proofdoc = {
      fileMstPk: 52,
      selectedFilesPk: []
    };

    
  }
  
  ngOnChanges() {
    if(this.paymentDetails) {
      this.checkform.controls['currency'].setValue(this.paymentDetails.packageDtl.subscription.packageBaseCurrencyPk);
      this.checkform.controls['amount'].setValue(this.paymentDetails.packageDtl.subscription.packageBasePrice);
      if(this.paymentDetails.origin === 'INTERNATIONAL'){
        this.checkform.controls['paymentmode'].setValue('1');
        this.checkform.controls['paymentmode'].disable();
      }
    }
  }

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  selectiondata(){
   
    this.checkform.controls['bankName'].reset();
    this.checkform.controls['transcdate'].reset();
    this.checkform.controls['checkno'].reset();
   

    this.drv_proofdoc = {
      fileMstPk: 52,
      selectedFilesPk: []
    };
    setTimeout(() => {
      if(this.photoRef){
          this.photoRef.triggerChange();
      }
  }, 500);
   // this.financialdoc.triggerChange();
  }
  saveOfflinePaymentDetails() {
    if(this.checkform.valid) {
      this.disableBtn = true;
      this.checkform.controls['transcdate'].setValue(moment(this.checkform.controls['transcdate'].value).format('YYYY-MM-DD').toString());
      this.afterloginService.saveOfflinePayDtls(this.checkform.getRawValue()).subscribe(data => {
        if(data['data'].status == 1){
          this.paymentDetails['proofdoc'] =  data['data'].proofdoc;
          this.router.navigate(['afterlogin/paymentsuccesslistview'], {
            state: {
              paymentDetails: this.paymentDetails,
              offlineFormValue: this.checkform.getRawValue(),
              paymentMode: 'offline',
              paymentStatus: 'S'
            } 
          });
        }
        this.disableBtn = false;
     });
   } 
  }
  

  cancelPayment() {
    swal({
      title: 'Do you want to cancel your Offline JSRS Subscription Payment?',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((cancelPayment) => {
      if(cancelPayment) {
        this.logOut();
      }
    });
  }

  logOut() {
    if (localStorage.getItem('v3logindata') !== null) {
      this.profileService.logout().subscribe(data => {
        localStorage.removeItem('v3logindata');
        localStorage.removeItem('v3logindatarefresh');
      },
        () => '',
        () => {
          this.router.navigate(['admin/login']);
        });
    }
  }

  get paymentType() {
    return this.checkform.controls['paymentmode'].value;
  }

  updatePayment(event) {
    if(event) {
      this.updatePayDtls.emit(true);
    }
  }
  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        console.log('page-content')
        }
    }
}
