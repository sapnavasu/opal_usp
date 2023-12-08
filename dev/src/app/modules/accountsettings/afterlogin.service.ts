import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})
export class AfterloginService {

  url = 'al/afterlogin/';
  mstUrl = 'mst/classification/';
  paymentUrl = 'pay/payment/'
  constructor(private http: RemoteService) { }
  
  getStakeholderDtls() {
    return this.http.get(this.url + 'stakeholderdtls').map(res => res.json());
  }

  getClassificationList() {
    return this.http.get(this.mstUrl + 'classificationlist').map(res => res.json());
  }

  getSubscriptionStatus() {
    return this.http.get(this.url + 'substatus').map(res => res.json());
  }

  getPackage(headcount: any, annualsales: any) {
    const body = JSON.stringify({ classification: { headCount: headcount, annualSales: annualsales } });
    return this.http.post(this.url + 'getpackage', body).map(res => res.json());
  }
  getPackageBystktype(headcount: any, annualsales: any, stktype: any) {
    const body = JSON.stringify({ classification: { headCount: headcount, annualSales: annualsales, stktype: stktype } });
    return this.http.post(this.url + 'getpackage', body).map(res => res.json());
  }

  generateInvoice() {
    const body = JSON.stringify({});
    return this.http.post(this.url + 'generateinvoice', body).map(res => res.json());
  }

  addOrMapPayContact(formValue?: any) {
    const body = JSON.stringify({ pymtcontact: formValue } );
    return this.http.post(this.url + 'savepaycontact', body).map(res => res.json());
  }

  saveOfflinePayDtls(formValue?: any) {
    const body = JSON.stringify({ offlinepymt: formValue } );
    return this.http.post(this.url + 'offlinepymtdtl', body).map(res => res.json());
  }
  saveOfflineContractPayDtls(formValue?: any) {
    const body = JSON.stringify({ offlinepymt: formValue } );
    return this.http.post(this.url + 'offlinecontractpymtdtl', body).map(res => res.json());
  }

  applyPromoCode(dtls: any) {
    const body = JSON.stringify({ promocodedtls: dtls });
    return this.http.post(this.url + 'applypromo', body).map(res => res.json());
  }

  getPaymentDetails() {
    return this.http.get(this.url+'paymentdetail').map(res => res.json());
  }

  getOnlinePaymentStatus(encryptedPaymentDtl) {
    const body = JSON.stringify({ paymentDtl: encryptedPaymentDtl  });
    return this.http.post(this.url+'paymentstatus',body).map(res => res.json());
  }
  
  payOnline(encryptedPaymentDtl: string) {
    const body = JSON.stringify({ paymentDtl: encryptedPaymentDtl  });
    return this.http.post(this.url+'onlinepayment',body).map(res => res.json());
  }
  payOnlineContract(encryptedPaymentDtl: string) {
    const body = JSON.stringify({ paymentDtl: encryptedPaymentDtl  });
    return this.http.post(this.url+'onlinepaymentcontract',body).map(res => res.json());
  }
  
  changeClassification(requestValues: any) {
    const body = JSON.stringify({ change: requestValues  });
    return this.http.post(this.url+'changeclassification',body).map(res => res.json());
  }

  getClassificationDetails() {
    return this.http.get(this.url+'classificationdtl').map(res => res.json());
  }

  getInternationalSubscription() {
    return this.http.get(this.url+'getintlsubcription?origin=I').map(res => res.json());
  }
  
  getInvoicedtls() {
    return this.http.get(this.url + 'invoicedtls').map(res => res.json());
  }

  changePaymentContact(newPayContactPk: number, exisitingPayContactPk: number) {
    const body = JSON.stringify({ changepaycontact: { newPayContactPk, exisitingPayContactPk } });
    return this.http.post(this.url+'changepaycontact',body).map(res => res.json());
  }
  formsubmit(subscriptiondtls) {
    const body = JSON.stringify({ subscription: subscriptiondtls  });
    return this.http.post(this.url+'updatesubscription',body).map(res => res.json());
  }
  getuserdtls(userpk)
  {
    const body = JSON.stringify({ userpk: userpk  });
    return this.http.post(this.url+'getuserdtls',body).map(res => res.json());
  }
  contractpaymentdetails(contpk)
  {
    const body = JSON.stringify({ contpk: contpk  });
    return this.http.post(this.url+'contractpaymentdetails',body).map(res => res.json());
  }
  contractpaymenthistorydetails(comppk)
  {
    const body = JSON.stringify({ comppk: comppk  });
    return this.http.post(this.url+'contractpaymenthistorydetails',body).map(res => res.json());
  }
  checkcompanynameandemailvalid(value,regpk,type,stktype) {
    const body = JSON.stringify({ valuedata: value ,idno:regpk, type:type, sttype:stktype});
    return this.http.post(this.url+'checkcompanynameandemailvalid',body).map(res => res.json());
  }
  getrenewtemp(comppk: number) {
    return this.http.get(this.url + 'getrenewtemp?comppk=' + comppk).map(res => res.json());
  }
 
}
