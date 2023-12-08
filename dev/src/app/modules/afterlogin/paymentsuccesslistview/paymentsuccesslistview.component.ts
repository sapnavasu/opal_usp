import { Component, OnInit, OnChanges, ViewChild } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { AfterloginService } from '../afterlogin.service';
import swal from 'sweetalert';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { Encrypt } from '@app/common/class/encrypt';
import { AccountsettingsService } from '@app/modules/accountsettings/accountsettings.service';
import {ToastrService} from 'ngx-toastr';
import { Http } from '@angular/http';

@Component({
  selector: 'app-paymentsuccesslistview',
  templateUrl: './paymentsuccesslistview.component.html',
  styleUrls: ['./paymentsuccesslistview.component.scss'],
  providers: [AccountsettingsService]
})
export class PaymentsuccesslistviewComponent implements OnInit, OnChanges {

  @ViewChild('companylogo') companylogo: Filee;
  drv_companylogo: any='';
  paymentDetails: any;
  offlineFormValue: any;
  upload: FormControl = new FormControl('');
  paymentMode: any;
  paymentStatus: any;
  paymentConfirm: any;
  paymentModule: any='';
  public showLoader: boolean = true;
  contactusData = {};
  constructor(private http: Http,private afterloginService: AfterloginService,private security: Encrypt,private activatedRoute: ActivatedRoute, private accSettingsService: AccountsettingsService,public toastr: ToastrService) { }

  ngOnInit() {
    
    this.getStateValue();
        this.activatedRoute.queryParams.subscribe((request) => {
        if(!this.paymentMode  && !this.paymentStatus){
          this.afterloginService.getOnlinePaymentStatus(this.security.encrypt(JSON.stringify(request))).subscribe(data => {
            if(data['data'] && data['data'].statusCode == 'E001'){
              this.paymentStatus = '1'
            }else if(data['data'] && data['data'].statusCode == 'E004'){
              this.paymentStatus = '6';
            }
          })
        } 
        
        

        this.afterloginService.getPaymentDetails().subscribe(data => {
          this.paymentDetails = data['data'];
          let primaryContactData = this.paymentDetails.primaryContact;
          let username = primaryContactData.firstname + ' ' + primaryContactData.lastname;
          let useremail = primaryContactData.emailid;
          this.contactusData = { companyname: this.paymentDetails.companyName, username: username, useremail: useremail };
          this.paymentMode = data['data'].payType;
          this.paymentStatus = data['data'].payStatus;
          this.paymentConfirm = data['data'].payConfirm;
          this.paymentModule = data['data'].paymentModule;          
          this.showLoader = false;
          this.drv_companylogo = data['data'].logo;
        })
        
      });      
    
  }

  ngOnChanges() {
    
  } 

  getStateValue() {
    this.paymentDetails = window.history.state.paymentDetails;
    this.offlineFormValue = window.history.state.offlineFormValue;
    this.paymentMode = window.history.state.paymentMode;
    this.paymentStatus = window.history.state.paymentStatus;
    this.paymentConfirm = window.history.state.paymentConfirm;
    this.drv_companylogo = this.paymentDetails?.logo;
  }  
}
