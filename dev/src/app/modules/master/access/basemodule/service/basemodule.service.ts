import { Injectable } from '@angular/core';
import { environment } from '../../../../../../environments/environment';
import { RemoteService } from '../../../../../remote.service';
import { Encrypt } from '@lypis_config/common/class/encrypt';

@Injectable({
  providedIn: 'root'
})
export class BasemoduleService {
  constructor(
    public _http: RemoteService,
    private encrypt: Encrypt,
  ) { }

  moduleFilter(filterParams){
    let formParam = JSON.stringify({ 'postParams': filterParams });
    const href = 'acm/basemodule/base-modules-list?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    return this._http.post(href,formParam).map(res => res.json());
  }

  getRootModule(formParms){
    let formParam = JSON.stringify({ 'postParams': formParms });
    const href = 'acm/basemodule/base-root-module?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    return this._http.post(href,formParam).map(res => res.json());
  }

  getRootModuleIniDatas(formParms){
    formParms = {};
    let formParam = JSON.stringify({ 'postParams': formParms });
    const href = 'acm/basemodule/initial-base-root-module?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    return this._http.post(href,formParam).map(res => res.json());
  }

  saveBaseModule(formParams, accessType){
    let formParam = JSON.stringify({ 'postParams':formParams });
    let accessModulePk = this.encrypt.encrypt('91,92');
    let accessModuleType = this.encrypt.encrypt(accessType);
    const href = 'acm/basemodule/base-module-save?uac=f3f86bb473399a2239202c31420a1ee1&uam='+accessModulePk+'&uat='+accessModuleType;
    return this._http.post(href,formParam).map(res => res.json());
  }

  getModuleBasedAccess(formParams){
    let formParam = JSON.stringify({ 'postParams':formParams });
    const href = 'acm/basemodule/get-module-based-access?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    return this._http.post(href,formParam).map(res => res.json());
  }

  fetchesBaseModuleAccess(formParams){
    let formParam = JSON.stringify({ 'postParams':formParams });
    let accessModulePk = this.encrypt.encrypt('91,92');
    let accessModuleType = this.encrypt.encrypt(3);
    const href = 'acm/basemodule/fetches-base-module?uac=f3f86bb473399a2239202c31420a1ee1&uam='+accessModulePk+'&uat='+accessModuleType;
    return this._http.post(href,formParam).map(res => res.json());
  }

  deleteBaseModuleAccess(formParams){
    let formParam = JSON.stringify({ 'postParams':formParams });
    let accessModulePk = this.encrypt.encrypt('91,92');
    let accessModuleType = this.encrypt.encrypt(4);
    const href = 'acm/basemodule/delete-base-module?uac=f3f86bb473399a2239202c31420a1ee1&uam='+accessModulePk+'&uat='+accessModuleType;
    return this._http.post(href,formParam).map(res => res.json());
  }

 changeStatusBaseModuleAccess(formParams){
    let formParam = JSON.stringify({ 'postParams':formParams });
    let accessModulePk = this.encrypt.encrypt('91,92');
    let accessModuleType = this.encrypt.encrypt(3);
    const href = 'acm/basemodule/change-status-base-module?uac=f3f86bb473399a2239202c31420a1ee1&uam='+accessModulePk+'&uat='+accessModuleType;
    return this._http.post(href,formParam).map(res => res.json());
  }
}
