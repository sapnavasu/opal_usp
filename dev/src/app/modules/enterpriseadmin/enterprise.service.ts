import { Injectable } from '@angular/core';
import { RemoteService } from '../../remote.service';
import { Encrypt } from '../../common/class/encrypt';

@Injectable({
  providedIn: 'root'
})
export class EnterpriseService {

  constructor(
    public http: RemoteService,
    private encrypt: Encrypt,
  ) { }

  enterpriseService(postParams, href) {
    let formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href, formParam).map(res => res.json());
  }

  checkEmailExistOrNot(href, postData) {
    return this.http.post(href, postData).map(res => res.json());
  }
  checksamemailid(href, postData) {
    return this.http.post(href, postData).map(res => res.json());
  }

  aleadyverifiedmob(href, postData){
    return this.http.post(href, postData).map(res => res.json());
  }

  checkEmpIdExistOrNot(href, postData) {
    return this.http.post(href, postData).map(res => res.json());
  }

  checkUsernameExistOrNot(href, postData) {
    return this.http.post(href, postData).map(res => res.json());
  }

  getUserActivityData(arg?: any, offset?: any) {
    let getUrl = 'ea/monitor/get-monitor-user';
    if (arg != '' && arg != undefined) {
      getUrl = getUrl + '&sortby=' + arg + '&offset=' + offset;
    }

    return this.http.get(getUrl).map(res => res.json());
  }
  getUserActivityList(userId) {
    return this.http.get('ea/monitor/getactivitylist?userId=' + userId).map(res => res.json());
  }

  resendInviteMail(pk: string) {
    let body = JSON.stringify({ userinvite_pk: pk })
    return this.http.post('ea/user/resendinvitemail', body).map(res => res.json());
  }
  getRecentSearch(baseModule, searchType) {
    let body = JSON.stringify({ baseModule: baseModule, searchType: searchType })
    return this.http.post('ea/user/recentsearch', body).map(res => res.json());
  }
  dontShowAgain(dataVal) {
    let body = JSON.stringify({ dataVal: dataVal })
    return this.http.post('ea/user/enterpriseadmindashbord', body).map(res => res.json());
  }
  addRecentSearch(baseModule, searchType, searchTxt) {
    let body = JSON.stringify({ baseModule: baseModule, searchType: searchType, searchTxt: searchTxt })
    return this.http.post('ea/user/addrecentsearch', body).map(res => res.json());
  }

  getBusinessList() {
    return this.http.get('mst/sectormst/businessunitlist').map(res => res.json());
  }
  getfilterBusinessList() {
    return this.http.get('mst/sectormst/filterbusinessunitlist').map(res => res.json());
  }
  chkdontshow() {
    return this.http.get('ea/user/dontshowstatus').map(res => res.json());
  }
  getInsight() {
    return this.http.get('ea/user/getinsight').map(res => res.json());
  }

  getbranchNameList() {
    return this.http.get('ea/user/branchnamelist').map(res => res.json());
  }

  getActiveDeptList() {
    return this.http.get('ea/department/getactivedept').map(res => res.json());
  }
  getDefaultDeptList() {
    return this.http.get('ea/department/getdefaultdept').map(res => res.json());
  }
  getDesignationList() {
    return this.http.get('ea/user/designationlist').map(res => res.json());
  }

  deleteInvite(pk: any) {
    let body = JSON.stringify({ userinvite_pk: pk })
    return this.http.post('ea/user/deleteinvite', body).map(res => res.json());
  }
  getUserpermission(userId, stktype) {
    let formParam = JSON.stringify({ 'idsno': userId, 'stktype': stktype });
    return this.http.post('ea/user/getuserpermissiondet', formParam).map(res => res.json());
  }
  checkUserismapped(userId) {
    let formParam = JSON.stringify({ 'userId': userId });
    return this.http.post('ea/user/checkuserismapped', formParam).map(res => res.json());
  }
}
