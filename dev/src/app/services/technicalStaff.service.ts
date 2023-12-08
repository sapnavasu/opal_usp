import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
    providedIn: 'root'
})
export class TechnicalstaffService {
    _url = 'st/staff-technical/';
    constructor(public http: RemoteService) { }

    getTechnicalStaffList(limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({ limit: limit, index: index, searchkey: searchkey, sort: filterDataPage.sortFiled, order: filterDataPage.order });
        return this.http.post(this._url + 'technical-list', body).map(res => res.json());
    }

    exportoExcel(limit: any, index: any, searchkey: any, filterDataPage: any = null, showCol: any = null) {
        let body = JSON.stringify({
            limit: limit, index: index,
            sort: filterDataPage.sortFiled,
            order: filterDataPage.order,
            searchkey: searchkey,
            showCol: showCol
        });
        return this.http.post(this._url + 'export-technical', body).map(res => res.json());
    }

    viewStaff(id: any) {
        return this.http.get(this._url + "view?id=" + id).map(res => res.json());
    }

    educationDetail(id: any, limit: any, index: any) {
        let body = JSON.stringify({ id: id, limit: limit, index: index });
        return this.http.post(this._url + 'education-detail', body).map(res => res.json());
    }

    workDetail(id: any, limit: any, index: any) {
        let body = JSON.stringify({ id: id, limit: limit, index: index });
        return this.http.post(this._url + 'work-detail', body).map(res => res.json());
    }

    removeStaffCentre(id:any) {
        let body = JSON.stringify({repo_pk: id});
        return this.http.post(this._url + 'remove-from-centre', body).map(res => res.json());
    }

    calenderview(id: any) {
        let body = JSON.stringify({ id: id });
        return this.http.post(this._url + 'calendar-schedule-list', body).map(res => res.json())
    }

    branchList() {
        let body = '';
        return this.http.post(this._url + 'branchlist', body).map(res => res.json());
    }

    genrateCompCrad(id: any) {
        let body = JSON.stringify({ staffinfo: id });
        return this.http.post(this._url + 'generate-competency', body).map(res => res.json());
    }
    reGenrateCompCrad(id: any) {
        let body = JSON.stringify({ staffinfo: id });
        return this.http.post(this._url + 'regenerate-competency', body).map(res => res.json());
    }
    printCompCrad(id: any) {
        let body = JSON.stringify({ staffinfo: id });
        return this.http.post(this._url + 'download-file', body).map(res => res.json());
    }

    viewCompCrad(id: any) {
        let body = JSON.stringify({ staffinfo: id });
        return this.http.post(this._url + 'view-file', body).map(res => res.json());
    }
}