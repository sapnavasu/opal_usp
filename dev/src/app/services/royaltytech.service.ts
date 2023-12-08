import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
    providedIn: 'root'
})
export class RoyaltytechService {
    _url = 'im/royalty-fee/';
    constructor(public http: RemoteService) { }

    // export(){
    //     return this.http.get(this._url + 'export-techdata').map(res => res.json());
    // }
    export(limit: any, index: any, searchkey: any, filterDataPage: any = null,showCol:any = null) {
        let body = JSON.stringify({
            limit: limit, index: index,
            sort: filterDataPage.sortFiled,
            order: filterDataPage.order,
            searchkey: searchkey,
            showCol : showCol
        });
        return this.http.post(this._url + 'export-techdata', body).map(res => res.json());
    }
    exportTechIvms(limit: any, index: any, searchkey: any, filterDataPage: any = null,showCol:any = null) {
        let body = JSON.stringify({
            limit: limit, index: index,
            sort: filterDataPage.sortFiled,
            order: filterDataPage.order,
            searchkey: searchkey,
            showCol : showCol
        });
        return this.http.post(this._url + 'export-tech-ivms', body).map(res => res.json());
    }
    download(id:any){
        return this.http.get(this._url + 'export-single-tech-royalty?roy_pk='+id).map(res => res.json());
    }

    downloadIvms(id:any){
        return this.http.get(this._url + 'export-single-tech-ivms?roy_pk='+id).map(res => res.json());
    }

    getTechRolayFeeList(limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({
            limit: limit, index: index,
            sort: filterDataPage.sortFiled, order: filterDataPage.order, searchkey: searchkey
        });
        return this.http.post(this._url + 'tech-royaltyfeelist', body).map(res => res.json());
    }

    getTechIvmsList(limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({
            limit: limit, index: index,
            sort: filterDataPage.sortFiled, order: filterDataPage.order, searchkey: searchkey
        });
        return this.http.post(this._url + 'techivmslist', body).map(res => res.json());
    }

    viewRoyaltyTech(roy_pk: any) {
        return this.http.get(this._url + "tech-royaltyfee-view?roy_pk=" + roy_pk).map(res => res.json());
    }
    
    viewRoyaltyTechIvms(roy_pk: any) {
        return this.http.get(this._url + "tech-royaltyview-ivms?roy_pk=" + roy_pk).map(res => res.json());
    }

    vehicleDetails(inv_pk: any, limit: any, index: any, searchkey: any, filterDataPage:any) {
        let body = JSON.stringify({ roy_pk: inv_pk, limit: limit, index: index,sort: filterDataPage.sortFiled, order: filterDataPage.order,searchkey: searchkey});
        return this.http.post(this._url + "vehicle-listing", body).map(res => res.json());
    }

    ivmsvehicleDetails(inv_pk: any, limit: any, index: any, searchkey: any, filterDataPage:any) {
        let body = JSON.stringify({ roy_pk: inv_pk, limit: limit, index: index,sort: filterDataPage.sortFiled, order: filterDataPage.order,searchkey: searchkey});
        return this.http.post(this._url + "ivmsvehicle-listing", body).map(res => res.json());
    } 

    techGenerateinvoice(body: any) {
        return this.http.get(this._url + "generate-vehicle-invoice?month=" + body).map(res => res.json());
    }

    IvmsGenerateinvoice(body: any) {
        return this.http.get(this._url + "generate-ivmsinvoice?month=" + body).map(res => res.json());
    }

    reGnerateinvoice(roy_pk: any) {
        return this.http.get(this._url + "tech-regenerate-invoice?roy_pk=" + roy_pk).map(res => res.json());
    }

    IvmsreGnerateinvoice(roy_pk: any) {
        return this.http.get(this._url + "tech-regenerate-ivms?roy_pk=" + roy_pk).map(res => res.json());
    }
}