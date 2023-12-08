import { Component, HostListener, OnInit, ViewChild } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AfterloginService } from '../afterlogin.service';
import swal from 'sweetalert';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { AccountsettingsService } from '@app/modules/accountsettings/accountsettings.service';
import {ToastrService} from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
@Component({
  selector: 'app-certificationpaymentdetail',
  templateUrl: './certificationpaymentdetail.component.html',
  styleUrls: ['./certificationpaymentdetail.component.scss'],
  providers: [AccountsettingsService],
})
export class CertificationpaymentdetailComponent implements OnInit {
  public certificateForm: FormGroup;
  drv_companylogo: any='';
  companyDetails: any;
  contactusData: {};
  showLoader: boolean = true;
  omannet_apistatus: boolean = true;
  cybersource_apistatus: boolean = true;
  thawani_apistatus: boolean = true;
  ottu_apistatus: boolean = true;
  smartpay_apistatus: boolean = true;
  online_payment: boolean = true;
  offline_payment: boolean = true;
  discount: boolean = false;
  paymentStatus: any='';
  expdays: any='';
  @ViewChild('companylogo') companylogo: Filee;
  warnUserBeforeLeavingPage = true;
  @HostListener("window:beforeunoad", ["$event"]) unloadHandler(event: Event) {
      if (this.warnUserBeforeLeavingPage) {
          event.returnValue = false;
      }
  }
  constructor(private fb: FormBuilder, private router: Router, private service: AfterloginService, private accSettingsService: AccountsettingsService,public toastr: ToastrService, private localstorage: AppLocalStorageServices) { }

  ngOnInit() {
    this.online_payment = this.localstorage.getInLocal('online_payment');
    this.offline_payment = this.localstorage.getInLocal('offline_payment');
    this.omannet_apistatus = this.localstorage.getInLocal('omannet_apistatus');
    this.cybersource_apistatus = this.localstorage.getInLocal('cybersource_apistatus');
    this.thawani_apistatus = this.localstorage.getInLocal('thawani_apistatus');
    this.ottu_apistatus = this.localstorage.getInLocal('ottu_apistatus');
    this.smartpay_apistatus = this.localstorage.getInLocal('smartpay_apistatus');
    this.discount = this.localstorage.getInLocal('discount');
    this.certificateForm = this.fb.group({
      upload: [null, Validators.required],
    });
    // this.drv_companylogo = {
    //   fileMstPk: 5,
    //   selectedFilesPk: []
    // }
    this.service.getPaymentDetails().subscribe(data => {
      this.showLoader = false;
      this.companyDetails = data['data'];
      this.paymentStatus = this.companyDetails.payStatus;
      this.drv_companylogo = this.companyDetails.logo;
      this.expdays = this.companyDetails.exdays;
      let primaryContactData = this.companyDetails.primaryContact;
      let username = primaryContactData.firstname + ' ' + primaryContactData.lastname;
      let useremail = primaryContactData.emailid;
      this.contactusData = { companyname: this.companyDetails.companyName, username: username, useremail: useremail };      
      let payStatus = 'IP';
      if(this.companyDetails['payStatus']) {
        if(this.companyDetails['payStatus'] == 1){
          payStatus = 'S';
        } else if(this.companyDetails['payStatus'] == 6 || this.companyDetails['payStatus'] == 7) {
          payStatus = 'F';
        } else if(this.companyDetails['payStatus'] == 2) {
          payStatus = 'IP';
        } else if(this.companyDetails['payStatus'] == 4) {
          payStatus = 'D';
        } else if(this.companyDetails['payStatus'] == 3) {
        //  this.router.navigate(['dashboard/supplier']);
        }

        if(!['F','D'].includes(payStatus) && this.companyDetails['payStatus'] != 3 && this.companyDetails['payStatus'] != 8 && this.companyDetails['payStatus'] != 6) {
          this.router.navigate(['afterlogin/paymentsuccesslistview'], {
            state: {
              paymentDetails: this.companyDetails,
              offlineFormValue: '',
              paymentMode: this.companyDetails['payType'],
              paymentStatus: payStatus
            } 
          });
        }
      }
      // if(this.companyDetails.logo.length > 0){
      //   this.drv_companylogo.selectedFilesPk = this.companyDetails.logo;
      //   setTimeout(() => this.companylogo.triggerChange(), 1000);
      // }
    });
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    this.accSettingsService.saveLogo(file).subscribe(data => {
      if (data['data'].status == 1) {
        console.log("Logo updated successfully");
      }
    })
  }

  getPaymentDetails(event) {
    if(event) {
      this.service.getPaymentDetails().subscribe(data => {
        this.showLoader = false;
        this.companyDetails = data['data'];
      });
    }
  }

  showSuccess(){
    this.toastr.success('Deleted Successfully', '', {
        timeOut: 3000,
        "positionClass":"toast-bottom-left",
    });
}
}
