import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class RoyaltyService {
  _url = 'im/royalty-fee/';

  //   http://192.168.1.189:81/opal_usp/api/im/royalty-fee/royaltyfee-view/?roy_pk=1

  constructor(public http: RemoteService) { }

  getRolayFeeList(limit: any, index: any, searchkey: any, filterDataPage: any = null) {
    let body = JSON.stringify({
      limit: limit, index: index,
      sort: filterDataPage.sortFiled, order: filterDataPage.order, searchkey: searchkey
    });
    return this.http.post(this._url + 'royaltyfeelist', body).map(res => res.json());
  }

  viewInvoice(inv_pk: any) {
    return this.http.get(this._url + "royaltyfee-view/?roy_pk=" + inv_pk).map(res => res.json());
  }

  lernerDetailsView(inv_pk: any, limit: any, index: any, searchkey: any) {
    let body = JSON.stringify({ roy_pk: inv_pk, limit: limit, index: index, searchkey: searchkey });
    return this.http.post(this._url + "learner-listing", body).map(res => res.json());
  }

  viewConfirmPayment(body: any) {
    return this.http.post(this._url + "payment-comment", body).map(res => res.json());
  }

  viewConfirmPaymentAssessmentFee(body: any) {
    return this.http.post(this._url + "payment-comment", body).map(res => res.json());
  }

  exportToExcel(limit: any, index: any, searchkey: any, filterDataPage: any = null, showCol:any = null) {
    let body = JSON.stringify({
      limit: limit, index: index,
      sort: filterDataPage.sortFiled, order: filterDataPage.order, searchkey: searchkey,
      showCol : showCol
    });
    return this.http.post(this._url + 'exportdata', body).map(res => res.json());
  }

  downloadList(down_id: any) {
    return this.http.get(this._url + "download-single-royalty?roy_pk=" + down_id).map(res => res.json());
  }

  generateinvoice(body: any) {
    return this.http.get(this._url + "generate-invoice?month=" + body).map(res => res.json());
  }

  reGnerateinvoice(roy_pk: any) {
    return this.http.get(this._url + "regenerate-invoice?roy_pk="+roy_pk).map(res => res.json());
  }
}