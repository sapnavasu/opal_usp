import { Injectable } from '@angular/core';
import { RemoteService } from '../../../../remote.service';
import { HttpParams } from '@angular/common/http';
import { RequestOptions } from '@angular/http';
import { Encrypt } from '@lypis_config/common/class/encrypt';

@Injectable({
  providedIn: 'root'
})
export class StkholderaccessService {
  
  _url = 'acm/stkholderaccessmaster';
  constructor(
    private http: RemoteService,
    private encrypt: Encrypt,
  ) { }


  getBaseModules(){
    return this.http.get(`${this._url}/getbasemodules?uac=f9d6c6ad2e0f8bfded8c4c37e4140629`).map(res => res.json());
  }

  getStkholderTypes(){
    return this.http.get(`${this._url}/getstkholdertypes?uac=f9d6c6ad2e0f8bfded8c4c37e4140629`).map(res => res.json());
  }
  
  deleteStkholderAccess(stkholdid){
    let accessModulePk = this.encrypt.encrypt('93');
    let accessModuleType = this.encrypt.encrypt(4);
    return this.http.get(`${this._url}/deletestkholderaccess?id=${stkholdid}&uac=f3f86bb473399a2239202c31420a1ee1&uam=${accessModulePk}&uat=${accessModuleType}`).map(res => res.json());
  }

  stkholdaccessfilter(filterpagestring:string,stkholdtypeid: any, basemoduleid: any, order: any){
    const url_params = `${this._url}/getstkholderaccessdata?${filterpagestring}&stkholdtypename=${stkholdtypeid}&basemodulename=${basemoduleid}&moduleorder=${order}&uac=f9d6c6ad2e0f8bfded8c4c37e4140629`;
    return this.http.get(url_params).map(res => res.json());
  }

  editStkholdaccess(stkholdid){
    let accessModulePk = this.encrypt.encrypt('93');
    let accessModuleType = this.encrypt.encrypt(3);
    return this.http.get(`${this._url}/getstkholderaccessbypk?id=${stkholdid}&uac=f3f86bb473399a2239202c31420a1ee1&uam=${accessModulePk}&uat=${accessModuleType}`).map(res => res.json());
  }

  createorEditStkholdaccess(formvalue, accessType){
    var params = JSON.stringify({ stkholderaccess: formvalue });
    let accessModulePk = this.encrypt.encrypt('93');
    let accessModuleType = this.encrypt.encrypt(accessType);
    return this.http.post(`${this._url}/createstkholderaccess&uac=f3f86bb473399a2239202c31420a1ee1&uam=${accessModulePk}&uat=${accessModuleType}`, params).map(res => res.json());
  }
}
