import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})
export class EnterpriseadminService {
  _url = 'ea/enterpriseadmin/';
  constructor(private http: RemoteService) { }

  enterpriseService(postParams, href) {
    let formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href, formParam).map(res => res.json());
  }
  saverolesdata(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('ea/enterpriseadmin/saveroledata',body).map(response => response.json());
  }
  stafffetchdata(value){
    return this.http.post('ea/enterpriseadmin/userstafffetchdata',value).map(response => response.json());
  }
  stafffetchdata1(value){
    return this.http.post('ea/enterpriseadmin/userstafffetchdata1',value).map(response => response.json());
  }
  
  stafffetchcentredata(statefk){
    let body = JSON.stringify({ statefk: statefk });
    console.log(body, "body")
    return this.http.post('ea/enterpriseadmin/userstafffetchcentredata',body).map(response => response.json());
  }
  highrolefetchdata(value){
    return this.http.post('ea/enterpriseadmin/highrolefectdata',value).map(response => response.json());
  }
  getstktypeuserddtls(){
    return this.http.get(this._url+'get-userstktype-dtls').map(res => res.json());
  }
  getroledtls(type){
    let body = JSON.stringify({type : type});
    return this.http.post(this._url+'get-role-dtls',body).map(res => res.json());
  }
  getcentrelistdtls(){
    return this.http.get(this._url+'get-centrelist-dtls').map(res => res.json());
  }
  getstafflistdata(){
    return this.http.get(this._url+'get-centreliststaff-dtls').map(res => res.json());
  }
  getstafflistdata1(data){
    return this.http.post(this._url+'get-centreliststaff-dtls1',data).map(res => res.json());
  }
  gethighrolefetchlist(a){
    return this.http.post(this._url+'get-highroledata-dtls',a).map(res => res.json());
  }
  gethigherrolesdtls(){
    return this.http.get(this._url+'gethigherrolesdtls').map(res => res.json());
  }
  getusersgriddtls(){
    return this.http.get(this._url+'get-users-data-dtls').map(res => res.json());
  }
  getrolestktypedata(){
    return this.http.get(this._url+'get-rolestktype-dtls').map(res => res.json());
  }
  checkEmailExistOrNot(href, postData) {
    // console.log(href,'checkEmailExistOrNot');
    return this.http.post(href, postData).map(res => res.json());
  }
  saveuserdata(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('ea/enterpriseadmin/saveusersdata',body).map(response => response.json());
  }
  savecentredata(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('ea/enterpriseadmin/savecentresdata',body).map(response => response.json());
 }
  checkstaffuser(data:any){
    
    let body = JSON.stringify({ data:data});
    return this.http.post('ea/enterpriseadmin/getcheckstaffuser', body).map(res => res.json());
 }
 getrolegriddtls(){
  return this.http.get(this._url+'get-roledata-dtls').map(res => res.json());
}
  statusthirdparty(dataVal) {
    let body = JSON.stringify({ dataVal: dataVal })
    return this.http.post('ea/enterpriseadmin/thirdpartstatusdata', body).map(res => res.json());
  }
  getUserCenterlistDtls(){
    return this.http.get(this._url+'get-user-centerlist-dtls').map(res => res.json());
  }
  checkRoleName(rolename: string, stkholderType?: any, type?:any ){
    var responseBody = JSON.stringify({ data: rolename,stkholderType: stkholderType, type: type})
    return this.http.post(this._url+'check-is-role-already-exists',responseBody).map(res => res.json());
  }
  checkUserscivilOremailId(rolename: string, stkholderType?: any, type?:any ){
    var responseBody = JSON.stringify({ data: rolename,stkholderType: stkholderType, type: type})
    return this.http.post(this._url+'check-is-user-civil-or-email-already-exists',responseBody).map(res => res.json());
  }
  getprojectdtls(projectidarray){
    var responseBody = JSON.stringify({ data: projectidarray})
    return this.http.post(this._url+'get-project-dtls',responseBody).map(res => res.json());
}
  getcoursetls(){
    return this.http.get(this._url+'get-course-dtls').map(res => res.json());
  }
  
}
