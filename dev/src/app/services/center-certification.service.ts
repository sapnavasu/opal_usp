import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CenterCertificationService {
  _url = 'im/center-certification/';
  constructor(public http: RemoteService) { }



  getcentercertidtls(data : any) {
    return this.http.post(this._url+ 'getcentercertidtls',data).map(res => res.json());
  }

  viewtraingingcenter(id : string) {
    return this.http.get(this._url+ `gettraingcenterdtls?id=${id}`).map(res => res.json());
  }

  exportData(sort,order,page,size,gridsearchValues,headerdata, showColumn?: any) {
    let body = JSON.stringify({ 'sort': sort,'order': order,'page': page + 1,'size': size,'searchkey': gridsearchValues,'headerdata':headerdata, 'showColumn': showColumn });
    return this.http.post(this._url + "exporttrainingdata", body).map(res => res.json());
  }
}
