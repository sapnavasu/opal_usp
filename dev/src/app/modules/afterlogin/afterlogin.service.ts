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
   getoperator()
  {
    return this.http.get(this.url + 'getoprdetails').map(res => res.json());
  }
  revertPayment(compPk: number, userPk: number, payModule: any) {
    const body = JSON.stringify({ revert: { compPk: compPk, userPk: userPk, payModule: payModule } });
    return this.http.post(this.url + 'revertpayment', body).map(res => res.json());
  }
  updatePaymentStatus(compPk: number, userPk: number, payModule: any) {
    const body = JSON.stringify({ paystatus: { compPk: compPk, userPk: userPk, payModule: payModule } });
    return this.http.post(this.url + 'updatepaymentstatus', body).map(res => res.json());
  }
  sendPaymentInprogressMail(compPk: number, userPk: number, payModule: any) {
    const body = JSON.stringify({ paymail: { compPk: compPk, userPk: userPk, payModule: payModule } });
    return this.http.post(this.url + 'sendpymtinprogressmail', body).map(res => res.json());
  }
  checkforeignclassification(compPk: number) {
    const body = JSON.stringify({ comp: { compPk: compPk} });
    return this.http.post(this.url + 'checkforeignclassification', body).map(res => res.json());
  }
  getottulink(encryptedPaymentDtl: string) {
    const body = JSON.stringify({ paymentDtl: encryptedPaymentDtl  });
    return this.http.post(this.url+'getottulink',body).map(res => res.json());
  }
  checkottuvalidlink(encryptedPaymentDtl: string) {
    const body = JSON.stringify({ paymentDtl: encryptedPaymentDtl  });
    return this.http.post(this.url+'checkottuvalidlink',body).map(res => res.json());
  }
  getcontractpaymentinfo() {
    return this.http.get(this.url+'contractpaymentinfo').map(res => res.json());
  }
}
