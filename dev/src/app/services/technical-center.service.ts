import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';


@Injectable({
  providedIn: 'root'
})
export class TechnicalCenterService {

  _url = 'im/center-certification/';
  constructor(public http: RemoteService) { }

  gettechnicalcertidtls(data : any) {
    return this.http.post(this._url+ 'gettechnicalcentercertidtls',data).map(res => res.json());
  }
  

  gettechnicalIvms(data : any) {
    return this.http.post(this._url+ 'gettechnical-ivms',data).map(res => res.json());
  }

  viewtechnicalcenter(id : string) {
    return this.http.get(this._url+ `viewtechnicalcenterdtls?id=${id}`).map(res => res.json());
  }

  viewtechnicalivms(id : string) {
    return this.http.get(this._url+ `viewtechnical-ivms?id=${id}`).map(res => res.json());
  }

  exportData(sort,order,page,size,gridsearchValues,headerdata, showColumn?: any) {
    let body = JSON.stringify({ 'sort': sort,'order': order,'page': page + 1,'size': size,'searchkey': gridsearchValues,'headerdata':headerdata, 'showColumn': showColumn});
    return this.http.post(this._url + "exporttechnicaldata", body).map(res => res.json());
  }

  exportDataIvms(sort,order,page,size,gridsearchValues,headerdata, showColumn?: any) {
    let body = JSON.stringify({ 'sort': sort,'order': order,'page': page + 1,'size': size,'searchkey': gridsearchValues,'headerdata':headerdata, 'showColumn': showColumn});
    return this.http.post(this._url + "exporttechnical-ivms", body).map(res => res.json());
  }
}
