import { Injectable } from '@angular/core';
import { Headers, RequestOptions } from '@angular/http';
import { RemoteService } from '@app/remote.service';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { State } from '../models/State';

@Injectable()
export class StateService {
  _url = 'mst/statemaster/';
  filterurl = 'mst/statemaster/index';
  constructor(public _http: RemoteService) { }
  createState(formvalues: any, moduleID?: any, accessType?: any) {
    const body	=	JSON.stringify({'statemaster': formvalues});
    return this._http.post(this._url + 'newstate' + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
  }
  updateState(id: number, formvalues, moduleID?: any, accessType?: any) {
    const body	=	JSON.stringify({'statemaster': formvalues});
    return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
  }
  getState(offset: number, pageindex: number): Observable<State[]> {
    this._url = 'http://' + window.location.hostname + '/bgiv3/server/api/web/v1/statemsttbls?offset=' + offset + '&pageindex=' + pageindex;
    return this._http.get(this._url).map(res => res.json());
  }
  getstatebyid(id, moduleID?: any, accessType?: any) {
    return this._http.get(this._url + 'statelistbycountry?countryid=' + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  editState(id, moduleID?: any, accessType?: any) {
    return this._http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  updatestatus(id, moduleID?: any, accessType?: any) {
    const body	=	JSON.stringify({'updatestatus': id});
    return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body);
  }
  deletestate(id, moduleID?: any, accessType?: any) {
    return this._http.delete(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType);
  }
  statetablefilter(filterpagestring: string, countryname: any, statename: any, status: any) {
    const options = new RequestOptions({
      headers: new Headers({})
    });
    const urlparams = `${this.filterurl}?${filterpagestring}&CyM_CountryName_en=${countryname}&SM_StateName_en=${statename}&SM_Status=${status}&type=${'filter'}`;
    return this._http.get(urlparams, options).map(res => res.json());
  }
}
