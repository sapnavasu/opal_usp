import { Component, OnInit, Input, OnChanges } from '@angular/core';
import { Router, RouterLink } from '@angular/router';
import swal from 'sweetalert';
import { AfterloginService } from '../afterlogin.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Component({
  selector: 'app-payofflinesuccesslistview',
  templateUrl: './payofflinesuccesslistview.component.html',
  styleUrls: ['./payofflinesuccesslistview.component.scss']
})
export class PayofflinesuccesslistviewComponent implements OnInit, OnChanges {

  @Input('paymentDetails') paymentDetails: any;
  @Input('offlineFormValue') offlineFormValue: any;
  @Input('paymentMode') paymentMode: any;
  @Input('paymentStatus') paymentStatus: any;
  @Input('paymentConfirm') paymentConfirm: any;
  @Input('paymentModule') paymentModule: any;
  @Input('contactusData') contactusData: any;
  hideChangeSubscription: boolean = false;
  paymentStatusPage: boolean = true;
  public compPk:number;
  public userPk:number;
  public payModule:any;
  public showLoader: boolean = false;
  public subscriptionFee:any;
  constructor(private afterloginService: AfterloginService, private router: Router, private localstorageservice: AppLocalStorageServices) { }

  ngOnInit() {
      
    }
    ngOnChanges() {
    this.compPk = this.localstorageservice.getInLocal('companyPk');
    this.userPk = this.localstorageservice.getInLocal('userPk');
      this.afterloginService.checkforeignclassification(this.compPk).subscribe(data => {
        if (data['data'].status == 1) {
          this.hideChangeSubscription = true;
        }
      });
    // if(this.paymentDetails?.payStatus && this.paymentDetails?.payStatus == '1') {
    //   this.hideChangeSubscription = false;
    // }
    if(this.paymentDetails?.memberStatus=='A'){
      this.payModule = "2";
      this.subscriptionFee = 'Kindly confirm if the JSRS Subscription Fee has been debited from your bank account';
    } else {
      this.payModule = "1";
      this.subscriptionFee = 'Kindly confirm if the JSRS Certification Fee has been debited from your bank account';
    }
    //2-Payment In-progress / 6-Failed
    if(this.paymentDetails?.payStatus && this.paymentDetails?.payStatus == '6' && this.paymentDetails?.payConfirm == '2') {
      //payment inprogress mail to admin team
      this.afterloginService.sendPaymentInprogressMail(this.compPk, this.userPk, this.payModule).subscribe(data => {
      });
    }  
    //confirmation popup for unknown response from payment gateways
    if(this.paymentDetails?.payStatus && this.paymentDetails?.payStatus == '2' && this.paymentDetails?.payConfirm == '2') {      
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
            this.afterloginService.updatePaymentStatus(this.compPk, this.userPk,this.payModule).subscribe(data => {
              this.paymentStatusPage = true;
            });
          }else{
            this.showLoader = true;
            this.afterloginService.revertPayment(this.compPk, this.userPk, this.payModule).subscribe(data => {
            this.paymentStatusPage = true;
            this.showLoader = false;
            swal({
              title: "Thanks for confirming",
              text: 'You will be redirected to Payment page to try the payment again',
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
    this.router.navigate(['/afterlogin/certificationpaymentdetail'], {
      state: {
        paymentDeclined: true
      }
    });
  }

  navigateToSCF() {
    this.router.navigate(['/scf/scfform/24/1'], {
      state: {
        paymentDeclined: true
      }
    });
  }

}
