import { Injectable } from '@angular/core';
import { Encrypt } from '@app/common/class/encrypt';
import { RemoteService } from '@app/remote.service';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class NotificationService {

  constructor(public http: HttpClient, public _http: RemoteService, private encryClass: Encrypt) { }
  _url = 'nty/notification';
  getnotification(datafor,filter,page,pageindex){
    let body	=	JSON.stringify({'datafor':datafor,'filter':filter});
    return this._http.post(`${this._url}/suppliernotices`+"?size="+page+"&page="+pageindex,body).map(res => res.json());
  }
  updatenotification(notifyPk,status,datafor,filter,page,pageindex){
    let body = JSON.stringify({ 'notif_pk': notifyPk,'status':status,'datafor':datafor,'filter':filter});
    return this._http.post(`${this._url}/supplierupdatenotices`, body).map(res => res.json());
  }

}
 