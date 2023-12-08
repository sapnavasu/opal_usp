import { Component, EventEmitter, Input, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { MatDialog } from '@angular/material/dialog';
import { MatTabGroup } from '@angular/material/tabs';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { AfterloginService } from '../afterlogin.service';
import { Paymentnotedialog } from '../modalpaymentnote/paymentnote';
import { Confirmationalert } from './modal/confirmationinfo';
import { Clipboard } from '@angular/cdk/clipboard';
import { MatSnackBar, MatSnackBarConfig } from '@angular/material/snack-bar';
@Component({
  selector: 'app-payonlinedetailtab',
  templateUrl: './payonlinedetailtab.component.html',
  styleUrls: ['./payonlinedetailtab.component.scss']
})
export class PayonlinedetailtabComponent {
  @Input('omannet_apistatus') omannet_apistatus: boolean=true;
  @Input('cybersource_apistatus') cybersource_apistatus: boolean=true;
  @Input('thawani_apistatus') thawani_apistatus: boolean=true;
  @Input('ottu_apistatus') ottu_apistatus: boolean=true;
  @Input('smartpay_apistatus') smartpay_apistatus: boolean=true;
  @Input('discount') discount: boolean=false;
  @Input('paymentDetails') paymentDetails: any;
  @Input('contactusData') contactusData: any;
  @Output('showOrRemoveLoader') showOrRemoveLoader: any = new EventEmitter<any>();
  @Output('updatePayDtls') updatePayDtls: any = new EventEmitter<any>();
  @ViewChild('tabGroup') tabGroup: MatTabGroup;
  @ViewChild('popupData') popupData: Confirmationalert;
  tabSet: boolean = false;
  public cardType: string;
  public dcvalidBtn: boolean = true;
  public ccvalidBtn: boolean = true;
  public debit_url: any;
  public credit_url: any;
  public oman_access: boolean = true;
  public dcBtnName: string='Generate';
  public ccBtnName: string='Generate';
  public module_type: any= 'REG';
  ottuInfoForm: FormGroup;
  showLoader:boolean=false;
  constructor(private fb: FormBuilder,private clipboard: Clipboard, private afterloginService: AfterloginService, private security: Encrypt, private router: Router,private dialog: MatDialog,private snackBar: MatSnackBar) { }

  ngOnInit(){
    this.ottuInfoForm = this.fb.group({
      credit_link: ['',''],
      debit_link: ['',''],
  })
}
ngOnChanges() {
  this.module_type = 'REG';
  if(this.paymentDetails){
    if(this.paymentDetails.memberStatus=='A'){
      this.module_type = 'RENEW';
    }
  }
  this.checkOttuLink();
}
  copyText(debit_link) {
    this.clipboard.copy(debit_link);
    // const selBox = document.createElement('textarea');
    // selBox.style.position = 'fixed';
    // selBox.style.left = '0';
    // selBox.style.top = '0';
    // selBox.style.opacity = '0';
    // selBox.value = debit_link;
    // document.body.appendChild(selBox);
    // selBox.focus();
    // selBox.select();
    // document.execCommand('copy');
    // document.body.removeChild(selBox);
  }
  openSnackBar() {
    const config = new MatSnackBarConfig();
    config.duration = 1500;
    config.panelClass = ['copyurlsnackbar'],
    config.verticalPosition = 'top';
    this.snackBar.open('Link Copied!', '', config);
  }
  openDialog(): void {
    let dialogRef = this.dialog.open(Paymentnotedialog,{ disableClose: true });

    dialogRef.afterClosed().subscribe(result => {
      
    });
  }
  ottuPayment(cardType: string){
    let url = '';
    if(cardType==='cc'){
      url = this.credit_url;
    } else if(cardType==='dc'){
      url = this.debit_url;
    }
    if(url){
      window.open(url,"_self");
    }
  }
  proceedToPay(cardType: string) {
    this.showOrRemoveLoader.emit(true);
    let url = '';
    const payurl = url;
    const {companyPk, countryPk} = this.paymentDetails;
    const {packageBaseCurrencySymbol, packageBasePrice} = this.paymentDetails['packageDtl']['subscription'];
    const paymentDtl = {
      cardType,
      packageBaseCurrencySymbol,
      packageBasePrice,
      companyPk, 
      countryPk, payurl
    }
    if(payurl){
      window.open(payurl,"_self");
      return false;
    }
    this.afterloginService.payOnline(this.security.encrypt(JSON.stringify(paymentDtl))).subscribe(data => {
      this.showOrRemoveLoader.emit(false);
      if(cardType === 'T') {
        window.open(data['data'].payurl,"_self");
      } else if(cardType === 'OC') {
        let response = data['data'];
        let formData = new FormData();
        for(const val in response) {
          if(val !== 'onlineorder'){
            formData.append(val,response[val]);
          }
        }
        fetch(response['onlineorder'],{
          method: 'POST',
          body: formData
        });
      } else if(cardType === 'ODC') {
        window.open(data['data'].payurl,"_self");
      } else if(cardType === 'OTO' || cardType === 'OTC'){
          window.open(data['data'].payurl,"_self");
      } else if(cardType === 'SP'){
       
        let response = data['data'];
       
        //return false;
        let formData = new FormData();
        for(const val in response) {
          if(val !== 'formurl'){
            formData.append(val,response[val]);
          }
        }
        // fetch(response['formurl'],{
        //   method: 'POST',
        //   body: formData
        // });
        //alert(response['encRequest'])
        var mapForm = document.createElement("form");
        mapForm.method = "POST"; // or "post" if appropriate
        mapForm.action = response['formurl'];
        
        var mapInput = document.createElement("input");
        mapInput.type = "hidden";
        mapInput.name = "encRequest";
        mapInput.setAttribute("value", response['encRequest']);
        mapForm.appendChild(mapInput);

        var mapInput = document.createElement("input");
        mapInput.type = "hidden";
        mapInput.name = "access_code";
        mapInput.setAttribute("value", response['access_code']);
        mapForm.appendChild(mapInput);
        document.body.appendChild(mapForm);
        mapForm.submit();
        this.showLoader = true;
      }
    });

  }
  updatePayment(event) {
    if(event) {
      this.updatePayDtls.emit(true);
    }
  }
  ConfirmationDialog(data): void {
    if(typeof this.paymentDetails!=='undefined'){
      const module_type = this.module_type;
      const card_type = data;
      const debiturl =  this.debit_url;
      const crediturl =  this.credit_url;
      const regenerate =  '';
      const {companyPk, countryPk, classificationType, companyName, countryName, regno} = this.paymentDetails;
      const {packageBaseCurrencySymbol, packageBasePrice, additionalPrice} = this.paymentDetails['packageDtl']['subscription'];
      const paymentDtl = {
        packageBaseCurrencySymbol,
        packageBasePrice,
        additionalPrice,
        companyPk, 
        countryPk, classificationType, companyName, countryName, regno, module_type, card_type, debiturl, crediturl, regenerate
      }
      let dialogRef = this.dialog.open(Confirmationalert, { disableClose: true, data: paymentDtl });
      dialogRef.afterClosed().subscribe(result => {
        if(result){
          if(result.card_type==='cc' && result.payurl){
            this.ottuInfoForm.controls['credit_link'].setValue(result.payurl);
            this.credit_url = result.payurl;
            this.ccvalidBtn = false;
            this.ccBtnName = 'Re-generate';
          }  
          if(result.card_type==='dc' && result.payurl){
            this.ottuInfoForm.controls['debit_link'].setValue(result.payurl); 
            this.debit_url = result.payurl;
            this.dcvalidBtn = false;
            this.dcBtnName = 'Re-generate';
          } 
        } else {
            if(!this.credit_url){
              this.ccBtnName = 'Generate';
              this.ccvalidBtn = true;
              this.ottuInfoForm.controls['credit_link'].disable();
            }
            if(!this.debit_url){
              this.dcBtnName = 'Generate';
              this.dcvalidBtn = true;
              this.ottuInfoForm.controls['debit_link'].disable();  
            }
        }
      });
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

    checkOttuLink(){
        const module_type = this.module_type;
        const payment_platform = '1';
        const paymentDtls = {
          module_type,
          payment_platform
        }
        this.afterloginService.checkottuvalidlink(this.security.encrypt(JSON.stringify(paymentDtls))).subscribe(data => {
          
          if(data['data'].ccurl){
            this.ottuInfoForm.controls['credit_link'].setValue(data['data'].ccurl);
            this.credit_url = data['data'].ccurl;
            this.ccvalidBtn = false;
            this.ccBtnName = 'Re-generate';
          } else {
            this.ccBtnName = 'Generate';
            this.ccvalidBtn = true;
            this.ottuInfoForm.controls['credit_link'].setValue('');
            this.ottuInfoForm.controls['credit_link'].disable();
          }    
          if(data['data'].dcurl){
            this.ottuInfoForm.controls['debit_link'].setValue(data['data'].dcurl); 
            this.debit_url = data['data'].dcurl;
            this.dcvalidBtn = false;
            this.dcBtnName = 'Re-generate';
          } else {
            this.dcBtnName = 'Generate';
            this.dcvalidBtn = true;
            this.ottuInfoForm.controls['debit_link'].setValue('');
            this.ottuInfoForm.controls['debit_link'].disable();  
          }
          this.oman_access = data['data'].oman_access;
        });
    }
}
