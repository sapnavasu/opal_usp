import { Injectable } from '@angular/core';
import { Headers, RequestOptions } from '@angular/http';
import { RemoteService } from '@app/remote.service';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { City } from '../models/city';
let _url: string;
@Injectable()
export class CityService {
  _url = 'mst/citymaster/';
  filterurl = 'mst/citymaster/index';
  constructor(public _http: RemoteService) { }

  createcity(formvalues: any, moduleID?: any, accessType?: any) {
        const body	=	JSON.stringify({'citymaster': formvalues});
        return this._http.post(this._url + 'newcity' + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
  }
  updatecity(id, formvalues: any, moduleID?: any, accessType?: any) {
    const body	=	JSON.stringify({'citymaster': formvalues});
    return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
}
  getcity(): Observable<City[]> {
        return this._http.get(this._url + 'citylist').map(res => res.json());
  }
  getcitybyid(id, moduleID?: any, accessType?: any) {
        return this._http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  getcitybystateid(id, moduleID?: any, accessType?: any) {
      return this._http.get(this._url + 'getcitybystateid?stateid=' + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  editcity(id, moduleID?: any, accessType?: any) {
        return this._http.get(this._url + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  updatestatus(id, moduleID?: any, accessType?: any) {
        const body	=	JSON.stringify({'updatestatus': id});
        return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
  }
  deletecity(id, moduleID?: any, accessType?: any) {
          return this._http.delete(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  citytablefilter(filterpagestring: string, name: any, status: string) {
        const options = new RequestOptions({
            headers: new Headers({})
        });
        const url_params      =     `${this.filterurl}?${filterpagestring}&CM_CityName_en=${name}&type=${'filter'}&CM_Status=${status}`;
        return this._http.get(url_params, options).map(res => res.json());
  }
  citylist() {
    return this._http.get(this._url + 'citylist').map(res => res.json());
  }
}
