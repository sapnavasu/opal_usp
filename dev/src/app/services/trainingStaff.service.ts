import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
    providedIn: 'root'
})
export class TrainingStaffService {
    _url = 'st/staff-training/';
    constructor(public http: RemoteService) { }

    getTrainingStaffList(regpk:any,limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({regpk : regpk, limit: limit, index: index, searchkey: searchkey, sort: filterDataPage.sortFiled, order: filterDataPage.order });
        return this.http.post(this._url + 'training-list', body).map(res => res.json());
    }

    exportoExcel(regpk:any,limit: any, index: any, searchkey: any, filterDataPage: any = null, showCol: any = null) {
        let body = JSON.stringify({
            regpk : regpk,
            limit: limit, index: index,
            sort: filterDataPage.sortFiled,
            order: filterDataPage.order,
            searchkey: searchkey,
            showCol: showCol
        });
        return this.http.post(this._url + 'export-training', body).map(res => res.json());
    }

    viewStaff(id: any,coursePk:any) {
        return this.http.get(this._url + "view?id=" + id+"&course="+coursePk).map(res => res.json());
    }

    educationDetail(id: any, limit: any, index: any) {
        let body = JSON.stringify({ id: id, limit: limit, index: index });
        return this.http.post(this._url + 'education-detail', body).map(res => res.json());
    }

    workDetail(id: any, limit: any, index: any) {
        let body = JSON.stringify({ id: id, limit: limit, index: index });
        return this.http.post(this._url + 'work-detail', body).map(res => res.json());
    }

    calenderview(id: any) {
        let body = JSON.stringify({ id: id });
        return this.http.post(this._url + 'calendar-schedule-list', body).map(res => res.json())
    }

    exportSingle(civil: any, staffinfo: any,date:any,coursePk:any) {
        let body = JSON.stringify({id:civil, staffinfo: staffinfo,date:date,coursePk:coursePk});
        return this.http.post(this._url + 'export-single-training', body).map(res => res.json());
    }

    getAddStaff(id:any, limit: any, index: any, searchkey: any, filterDataPage: any = null) {
        let body = JSON.stringify({id:id, limit: limit, index: index, searchkey: searchkey, sort: filterDataPage.sortFiled, order: filterDataPage.order });
        return this.http.post(this._url + 'booking-listing', body).map(res => res.json());
    }

    transferData(data: any) {
        let body = JSON.stringify(data);
        return this.http.post(this._url + 'save-booking', body).map(res => res.json())
    }

    removeStaffCentre(id:any) {
        let body = JSON.stringify({repo_pk: id});
        return this.http.post(this._url + 'remove-from-centre', body).map(res => res.json());
    }

    deleteCalBooking(id:any) {
        let body = JSON.stringify({id: id});
        return this.http.post(this._url + 'delete-booking', body).map(res => res.json());
    }

    updateStatus(id:any, status: any) {
        let body = JSON.stringify({id: id, status: status});
        return this.http.post(this._url + 'update-status', body).map(res => res.json());
    }
    
    editBooking(id:any) {
        let body = JSON.stringify({id: id});
        return this.http.post(this._url + 'update-data', body).map(res => res.json());
    }
    updateBooking(data:any) {
        let body = JSON.stringify({data});
        return this.http.post(this._url + 'edit-booking', body).map(res => res.json());
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

    getbatchids(staffinfotmppk,date){
        let body = JSON.stringify({ staffinfotmppk:staffinfotmppk,date:date });
        return this.http.post(this._url + 'getbatchids',body).map(response => response.json());
    }

    getaccessorscheduledtls(pk,pagesize,page,serachkey){

        let body = JSON.stringify({  pk:pk,limit:pagesize,page:page,serachkey:serachkey});
        return this.http.post('cm/coursemanagement/getaccessorscheduledtls',body).map(response => response.json());
    }

    getCategoryforgridlist()
    {
        return this.http.get('bm/batchmanagement/get-categoryforgridlist').map(res => res.json());
    }
    
    getCategorylist()
    {
        return this.http.get(this._url +'get-categorylist').map(res => res.json());
    }
}