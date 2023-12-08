
import { Injectable } from '@angular/core';
import { Headers, RequestOptions } from '@angular/http';
import { RemoteService } from '@app/remote.service';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Country } from '../models/country';
let _url: string;
@Injectable()
export class CountryService {
  constructor(public _http: RemoteService) { }
  _url: string ='mst/country/';
  filterurl: string ='mst/country/index';
  /* create country service */
  createCountry(formvalues: any){
    let body	=	JSON.stringify({'countrymaster':formvalues});
    return this._http.post(this._url+"newcountry", body).map(res=>res.json());
  }
  /* get list service */
  getCountry():Observable<Country[]>{
    return this._http.get(this._url+"countrylist").map(res=>res.json());
  }
  /* update data fetch service */
  updateCountry(id:number,formvalues:any)
  {
    let body	=	JSON.stringify({'countrymaster':formvalues});
    return this._http.put(this._url+id, body).map(res=>res.json());
  }
  /* update  service */
  editCountry(id){
    return this._http.get(this._url+id).map(res=>res.json());
  }
  /* delete service */
  deletecountry(id)
  {
    return this._http.delete(this._url+id);
  }
  /* status update service */
  updatestatus(id)
  {
    let body	=	JSON.stringify({'updatestatus':id});
    return this._http.put(this._url+id, body).map(res=>res.json());
  }
  /* filter service */
  countrytablefilter(filterpagestring:string,name: any, code: any, dialcode: any,status:string){
    var options = new RequestOptions({
      headers: new Headers({})
    });
    const urlwithparam = `${this.filterurl}?${filterpagestring}&CyM_CountryName_en=${name}&CyM_CountryCode_en=${code}&CyM_CountryDialCode=${dialcode}&CyM_Status=${status}&type=${'filter'}`;
    return this._http.get(urlwithparam, options).map(res => res.json());
  }
}
