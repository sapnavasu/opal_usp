import { Injectable } from '@angular/core';
import 'rxjs/add/observable/of';
import { RemoteService } from './../../../remote.service';

let _url: string;
@Injectable()
export class UsermanagementService {
  _url = 'pm/profile/';
  _workspaceurl = 'ws/workspace/';
  _departmenturl = 'ea/department/';
  _usermanagementurl = 'ea/user/';
  filterurl = 'mst/profilemanagement/index';
  constructor(public http: RemoteService) { }

  getdeparmentlist() {
    return this.http.get(this._url + 'getdeparmentlist').map(res => res.json());
  }


 create(postval) {
    const body = JSON.stringify({ 'memcompprofachvdtls': postval });
    return this.http.post(this._url + 'createachvmt', body).map(res => res.json());
  }
  getachvmt(id: number) {
    return this.http.get(this._url + 'getachvmt?id=' + id).map(res => res.json());
  }

  getincorpstyle() {
    return this.http.get(this._url + 'getincorpstyle').map(res => res.json());
  }
  corporatedata(table: string, formdata: any) {
    if (table == 'memcompmarpreimgdtls') {
      const body = JSON.stringify({ 'memcompmarpreimgdtls': formdata });
    } else if (table == 'membercompanymst') {
      const body = JSON.stringify({ 'membercompanymst': formdata });
    } else if (table == 'memcompgendtls') {
      const body = JSON.stringify({ 'memcompgendtls': formdata });
    } else if (table == 'memcompprofcertfdtls') {
      const body = JSON.stringify({ 'memcompprofcertfdtls': formdata });
    }
    return this.http.post(this._url + 'createcorporate', body).map(res => res.json());
  }
  addaccomplishment(formdata: any) {
    const body = JSON.stringify({ 'memcompacomplishdtls': formdata }); 

    return this.http.post(this._url + 'createaccomplishemnt', body).map(res => res.json());

  }
  adddepartment(formdata: any) {
    const body = JSON.stringify({ 'departmentmst': formdata }); 

    return this.http.post(this._departmenturl + 'deptcreate', body).map(res => res.json());

  }
  getaccomplishment(requesturls?: string) {
    if (typeof requesturls == 'undefined') {
      return this.http.get(this._url + 'getaccomplishment?company_id=' + 549).map(res => res.json());
    } else {
      return this.http.get(this._url + 'getaccomplishment?company_id=' + 549 + requesturls).map(res => res.json());
    }

  }
  getcorpprofile() {
    return this.http.get(this._url + 'getcorporateprofile').map(res => res.json());
  }
  accomplishmentordering(data) {
    const body = JSON.stringify({ 'orderlist': data }); 
    return this.http.post(this._url + 'accomplishmentpriority', body).map(res => res.json());
  }
  getsegmentlist() {
    return this.http.get(this._url + 'getsegmentlist').map(res => res.json());
  }
  getsegmentlistforservice() {
    return this.http.get(this._url + 'getsegmentlist?type=' + 'S').map(res => res.json());
  }
  getfamilybaedonsegment(segmentid) {
    return this.http.get(this._url + 'getfamilylist?segment=' + segmentid).map(res => res.json());
  }
  getclassbyfamilyid(family, segment) {
    return this.http.get(this._url + 'getclass?family=' + family + '&segment=' + segment).map(res => res.json());
  }
  getproductlist(classvalue, familyvalue, segmentvalue) {
    return this.http.get(this._url + 'getproductlist?class=' + classvalue + '&family=' + familyvalue + '&segment=' + segmentvalue).map(res => res.json());
  }

  getservicelist(classvalue, familyvalue, segmentvalue) {
    return this.http.get(this._url + 'getservlist?class=' + classvalue + '&family=' + familyvalue + '&segment=' + segmentvalue).map(res => res.json());
  }
  getsectorlist() {
    return this.http.get(this._url + 'getsectorlist').map(res => res.json());
  }
  getindustrylist(sector: any) {
    return this.http.get(this._url + 'getindustrylist?sector=' + sector).map(res => res.json());
  }
  getactivitylist(sector, industry) {
    return this.http.get(this._url + 'activitylist?sector=' + sector + '&industry=' + industry).map(res => res.json());
  }
  getspecification() {
    return this.http.get(this._url + 'getspecification').map(res => res.json());
  }
  getspecificationforservice() {
    return this.http.get(this._url + 'getspecification?type=' + 'S').map(res => res.json());
  }
  getlookup() {
    return this.http.get(this._url + 'getlookup').map(res => res.json());
  }
  addproduct(body) {
    return this.http.post(this._url + 'addproduct', body).map(res => res.json());
  }
  addservice(body) {
    return this.http.post(this._url + 'addservice', body).map(res => res.json());
  }
  wikicontent(content: any) {
    return this.http.get(this._url + 'getwikipedia?iname=' + content + '&type=p').map(res => res.json());
  }
  autocomplete(value, searchby, type) {
    return this.http.get(this._url + 'getsugglist?term=' + value + '&searchby=' + searchby + '&type=' + type).map(res => res.json());
  }
  searchclick(termid, searchby, type) {
    return this.http.get(this._url + 'searchclick?termid=' + termid + '&searchby=' + searchby + '&type=' + type).map(res => res.json());
  }
  getfamilybasedonsegmentforservice(segmentid) {
    return this.http.get(this._url + 'getfamilylist?segment=' + segmentid + '&type=S').map(res => res.json());
  }
  getclassbyfamilyforservice(family, segment) {
    return this.http.get(this._url + 'getclass?family=' + family + '&segment=' + segment + '&type=S').map(res => res.json());
  }
  wikicontentforservice(content: any) {
    return this.http.get(this._url + 'getwikipedia?iname=' + content + '&type=s').map(res => res.json());
  }
  activitysearchclick(termid, searchby, type) {
    return this.http.get(this._url + 'activitysearchclick?termid=' + termid + '&searchby=' + searchby + '&type=' + type).map(res => res.json());
  }
  autocompleteactivity(value, searchby, type) {
    return this.http.get(this._url + 'getsectorsugglist?term=' + value + '&searchby=' + searchby).map(res => res.json());
  }
  adduser(body) {
    return this.http.post(this._usermanagementurl + 'createuser', body).map(res => res.json());
  }
  userfilter(filterpagestring, username) {
    const requeststring = `${filterpagestring}&search=${username}&type=${'filter'}`;
    return this.http.get('ea/user/getuser?' + requeststring).map(res => res.json());

  }
  userdelete(userMstpk: any) {
    return this.http.get('ea/user/deleteuser?pk=' + userMstpk).map(res => res.json());

  }
  updateuser(pk: any) {
    return this.http.get('ea/user/getuserdetails?pk=' + pk).map(res => res.json());
  }
  updatestatus(pk: any, status: any) {
    const bodycontent = {'pk': pk, 'status': status};
    const josndata = JSON.stringify({'usermanagent': bodycontent});
    return this.http.post('ea/user/changeuserstatus', josndata).map(res => res.json());
  }
  inviteuser(formvalue: any) {
    const body = JSON.stringify({'inviteuser': formvalue});
    return this.http.post('ea/user/inviteuser', body).map(res => res.json());
  }

  getModulesSubModulesByDept(deptpk: number) {
    return this.http.get('ea/userpermission/getsubmodpermbydept?dept_pk=' + 3).map(res => res.json());
  }

}
