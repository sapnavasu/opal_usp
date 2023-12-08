import { Injectable } from '@angular/core';
import { Headers, RequestOptions } from '@angular/http';
import { RemoteService } from '@app/remote.service';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Currency } from '../models/currency';
let _url: string;
@Injectable()
export class CurrrencyService {
  _url = 'mst/currencymaster/';
  filterurl = 'mst/currencymaster/index';

  constructor(public http: RemoteService) { }
  getcurrency(): Observable<Currency[]> {
    return this.http.get(this.filterurl).map(res => res.json()) as Observable<Currency[]>;
  }
  create(postval, moduleID, accessType) {
    const body	=	JSON.stringify({'currencymaster': postval});
    return this.http.post(`${this._url}newcurrency?uac=f3f86bb473399a2239202c31420a1ee1&uam=${moduleID}&uat=${accessType}`, body).map(res => res.json());
  }
  update(id, postval, moduleID, accessType) {
    const body	=	JSON.stringify({'currencymaster': postval});
    return this.http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
  }
  editcurrency(id, moduleID, accessType) {
    return this.http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
  }
  updatestatus(id) {
    const body	=	JSON.stringify({'updatestatus': id});
    return this.http.put(this._url + id, body).map(res => res.json());
  }
  deletecurrency(id, moduleID, accessType) {
    return this.http.delete(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType);
  }
  filtertable(filterpagestring: string, symbol: any, name: any, status: any) {
    const options = new RequestOptions({
      headers: new Headers({})
    });
    const f_url = `${this.filterurl}?${filterpagestring}&CurM_CurrSymbol=${symbol}&CurM_CurrencyName_en=${name}&CurM_Status=${status}&type=${'filter'}`;
    return this.http.get(f_url, options).map(res => res.json());
  }
}
