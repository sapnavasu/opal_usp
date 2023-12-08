import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
    providedIn: 'root'
})
export class AssessmentFeeService {
    _url = 'im/assessment-fee/';
    constructor(public http: RemoteService) { }

    getAssessmentFeeList(limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({ limit: limit, index: index, searchkey: searchkey, sort: filterDataPage.sortFiled, order: filterDataPage.order });
        return this.http.post(this._url + 'assessmentfeelist', body).map(res => res.json());
    }

    viewAssessmentFee(asmnt_pk: any) {
        return this.http.get(this._url + "assessmentfee-view?asmnt_pk=" + asmnt_pk).map(res => res.json());
    }

    // exportoExcel() {
    //     return this.http.get(this._url + "exportassessmentdata").map(res => res.json());
    // }
    exportoExcel(limit: any, index: any, searchkey: any, filterDataPage: any = null, showCol: any = null) {
        let body = JSON.stringify({
            limit: limit, index: index,
            sort: filterDataPage.sortFiled,
            order: filterDataPage.order,
            searchkey: searchkey,
            showCol: showCol
        });
        return this.http.post(this._url + 'exportassessmentdata', body).map(res => res.json());
    }
    learnerListview(asmnt_pk: any, limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({ asmnt_pk: asmnt_pk, limit: limit, index: index, searchkey: searchkey, sort: filterDataPage.sortFiled, order: filterDataPage.order  });
        return this.http.post(this._url + "learner-listing", body).map(res => res.json());
    }

    genrateInvoice(body: any) {
        return this.http.get(this._url + "generate-invoice?month=" + body).map(res => res.json());
    }

    downloadList(down_id: any) {
        return this.http.get(this._url + "download-single-assessment?asmnt_pk=" + down_id).map(res => res.json());
    }

    reGnerateinvoice(asmnt_pk: any, opalmemberregmst_pk: any) {
        return this.http.get(this._url + "regenerate-invoice?asmnt_pk=" + asmnt_pk + "&opalmemberregmst_pk=" + opalmemberregmst_pk).map(res => res.json());
    }

    viewConfirmPaymentAssessmentFee(body: any) {
        return this.http.post(this._url + "payment-comment", body).map(res => res.json());
    }
    

}