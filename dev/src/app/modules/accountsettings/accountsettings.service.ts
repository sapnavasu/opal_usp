import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';


@Injectable({
  providedIn: 'root'
})
export class AccountsettingsService {
  _acsURL = 'acs/accountsettings/';
  constructor(private http: RemoteService) { }
  
  accountsettingsdata(editdataview){
    return this.http.get(this._acsURL+'accsettingsdata?editdata='+editdataview).map(res => res.json());
  }

  saveUserDtls(formvalue){
    const body = JSON.stringify({ form: formvalue });
    return this.http.post(this._acsURL+'saveuserdtls',body).map(res => res.json());
  }

  saveEmailPref(selectedList){
    const body = JSON.stringify({ emailpref: selectedList });
    return this.http.post(this._acsURL+'updateemailpref',body).map(res => res.json());
  }

  saveSecurityQA(formval){
    const body = JSON.stringify({ qa: formval });
    return this.http.post(this._acsURL+'savesecurityquestion',body).map(res => res.json());
  }

  saveLogo(filePk){
    const body = JSON.stringify({ filePk: filePk });
    return this.http.post(this._acsURL+'savelogo',body).map(res => res.json());
  }

  saveUserDp(filePk){
    const body = JSON.stringify({ filePk: filePk });
    return this.http.post(this._acsURL+'saveuserdp',body).map(res => res.json());
  }

  removeDp(){
    const body = JSON.stringify({ filePk: 'false' });
    return this.http.post(this._acsURL+'saveuserdp',body).map(res => res.json());
  }

  changeUser(newAdminUserPk, userPermission, department, userPk){
    const body = JSON.stringify({ newAdminUserPk: newAdminUserPk, userPermission: userPermission, department: department, userPk: userPk });
    return this.http.post(this._acsURL+'changeuser',body).map(res => res.json());
  }

  changeAuthorizeUser(adminPks) {
    return this.http.post(this._acsURL+'changeuserauthorize', adminPks).map(res => res.json());
  }
}
