import {Component, OnInit, ChangeDetectionStrategy, Input, EventEmitter, Output} from '@angular/core';
import {FormGroup, FormBuilder, Validators, FormControl} from '@angular/forms';
import { Viewdialog } from '../modal/viewdialog';
import { Paymentdialog } from './modal/paymentdialog';
import { AfterloginService } from '../afterlogin.service';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE, ErrorStateMatcher } from '@angular/material/core';
import { Router } from '@angular/router';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';
import swal from 'sweetalert';
import { Subject } from 'rxjs/internal/Subject';
import { MatDialog } from '@angular/material/dialog';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { DriveInput } from '@app/common/classes/driveInput';
import {ToastrService} from 'ngx-toastr'

declare var $;

const moment = _rollupMoment || _moment;

// See the Moment.js docs for the meaning of these formats:
// https://momentjs.com/docs/#/displaying/format/
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
  selector: 'app-payment',
  templateUrl: './payment.component.html',
  styleUrls: ['./payment.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
],
})
export class PaymentComponent implements OnInit {
  @Input() stakeholderDtl: any = [];
  @Input() packageDtl: any = [];
  @Input() promoDtl: any = [];
  @Input() selectedAddnlPackage: any = [];
  @Input() promoApplied: boolean = false;
  @Input() promoCodeCtrl: FormControl;
  @Input() subTotal: number;
  @Input() invoiceref: any;
  @Input() invoiceDownloadLink: any;
  @Input() additionalPackageTotalPrice: number;
  @Output() showPaymentSuccess: EventEmitter<any> = new EventEmitter<any>();
  
  public afterform: FormGroup;
  checkform: FormGroup;
  drv_proofdoc: DriveInput;
  maxDate = new Date();
  selectedPaymentType: string;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  destroy$: Subject<boolean> = new Subject<boolean>();

  constructor(private formBuilder: FormBuilder,  
    private dialog: MatDialog,
    private afterloginService: AfterloginService,
    private profileService: ProfileService,
    private router: Router,public toastr: ToastrService) {
    
  }

  ngOnInit() {
    this.checkform = this.formBuilder.group({
      paymentType: ['', Validators.required],
      bankName: ['', Validators.required],
      transcdate: ['', Validators.required],
      refno: ['', Validators.required],
      proofdoc: ['', Validators.required],
      invoice: [this.invoiceref, ''],
      stakeholderType: [this.stakeholderDtl['stakeholderType'], ''],
      companyName: [this.stakeholderDtl['companyName'], ''],
      currency: [this.packageDtl['subscription']['packageBaseCurrencyPk'], '']
    });
    this.drv_proofdoc = {
      fileMstPk: 52,
      selectedFilesPk: []
    };

  }

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  openDialog(): void {
    const dialogRef = this.dialog.open(Viewdialog);
    dialogRef.afterClosed().subscribe(result => {
    });
  }
  paymentdialog(): void {
    const dialogRef = this.dialog.open(Paymentdialog);
    dialogRef.afterClosed().subscribe(result => {
    });
  }
  saveOfflinePaymentdtl() {
    if(this.checkform.valid) {
      this.checkform.value['transactionDate'] = moment(this.checkform.controls['transcdate'].value).format('YYYY-MM-DD').toString();
      this.checkform.value['amount'] = this.subTotal + this.additionalPackageTotalPrice;
      this.checkform.value['selectedpaymentType'] = this.selectedPaymentType;
      this.afterloginService.saveOfflinePayDtls(this.checkform.value).subscribe(data => {
        this.showPaymentSuccess.emit(this.checkform.value);
        if(data['data'].status == 1){
          this.showPaymentSuccess.emit(this.checkform.value);
        }
      })
    }
  }

  cancelPayment() {
    swal({
      text: 'Are you sure, you want to cancel the subscription',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((cancelPayment) => {
      if(cancelPayment) {
        this.logOut();
        this.showSuccess()
      }
    });
  }
  showSuccess(){
    this.toastr.success('everything is broken', 'Success !', {
        timeOut: 3000,
        "positionClass":"toast-bottom-left",
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
    return this.checkform.controls['paymentType'].value;
  }
}
