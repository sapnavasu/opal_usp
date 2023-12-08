import { Component, Input, OnInit } from '@angular/core';
import { AfterloginService } from '@app/modules/afterlogin/afterlogin.service';
import swal from 'sweetalert';
import { Router } from '@angular/router';

@Component({
  selector: 'app-transactionsucess',
  templateUrl: './transactionsucess.component.html',
  styleUrls: ['./transactionsucess.component.scss']
})
export class TransactionsucessComponent implements OnInit {
  @Input('pymtResponseDtls') pymtResponseDtls: any;
  @Input('classification') classification: any;
  @Input('country') country: any;
  @Input('module') module: any;
  @Input('sameUser') sameUser: any;
  @Input('error_type') error_type: any = '';
  public compPk:number;
  public userPk:number;
  public payModule:any;
  public showLoader: boolean = false;
  public subscriptionFee:any;
  thanksContent: any='';
  paymentStatus: any;
  paymentStatusPage: boolean = true;
  redirectto: any = '';
  constructor(private afterloginService: AfterloginService, private router: Router) { }

  ngOnInit() {
    this.thanksContent = 'Please login to make payment';
    if(this.sameUser){
      this.thanksContent = 'You will be redirected to Payment page to try the payment again';
      if(this.module==='REG'){
        this.redirectto = '/afterlogin/certificationpaymentdetail';
      } else if(this.module==='RENEW'){
        this.redirectto = '/afterlogin/certificationpaymentdetail';
      }
    }else{
      this.redirectto = '/admin/login';
    }
  }
  ngOnChanges(){
    this.compPk = this.pymtResponseDtls?.comppk;
    this.userPk = this.pymtResponseDtls?.userpk;
    this.paymentStatus = this.pymtResponseDtls?.payment_status;
    if(this.module==='RENEW'){
      this.payModule = "2";
      this.subscriptionFee = 'Kindly confirm if the JSRS Subscription Fee has been debited from your bank account';
    } else {
      this.payModule = "1";
      this.subscriptionFee = 'Kindly confirm if the JSRS Certification Fee has been debited from your bank account';
    }

    if(this.paymentStatus && this.paymentStatus == '2' && this.pymtResponseDtls?.pymtconfirm == '2') {      
      this.paymentStatusPage = false;
        swal({
          title: this.subscriptionFee,
          text: '',
          icon: "warning",
          buttons: ['Not Debited', 'Yes, Debited'],
          dangerMode: true,
          className: "swal-warning",
          closeOnClickOutside: false,
          closeOnEsc: false
        }).then((willDelete) => {
          if(willDelete) {
            //Payment is debited
            this.afterloginService.updatePaymentStatus(this.compPk, this.userPk, this.payModule).subscribe(data => {
              this.paymentStatusPage = true;
            });
          }else{
            //Payment is not debited
            this.showLoader = true;
            this.afterloginService.revertPayment(this.compPk, this.userPk, this.payModule).subscribe(data => {
            this.paymentStatusPage = true;
            this.showLoader = false;
            this.paymentStatus = 6; //For failed status
            swal({
              title: "Thanks for confirming",
              text: this.thanksContent,
              icon: "success",
              closeOnClickOutside: false,
              closeOnEsc: false
            }).then((willConfirm) => { 
              if(willConfirm){
                this.navigateTo();
              }                
            })            
            });
          }
        })
    }
  }
  navigateTo() {
    if(this.redirectto){
      this.router.navigate([this.redirectto]);
    }
    // this.router.navigate(['/admin/login'], {
    //   state: {
    //     paymentDeclined: true
    //   }
    // });
  }

}
