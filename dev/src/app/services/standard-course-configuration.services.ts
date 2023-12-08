import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class StandardCourseConfigurationService{
  _url = 'scc/standard-course-configuration/';
  constructor(public http: RemoteService) { }

  getCourseList(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getcourselist', body).map(res => res.json());
  }

  getcourserelateddata(){
    return this.http.get(this._url + 'getcourserelateddata').map(res => res.json());
  }

  saveCourse(data) {
    return this.http.post(this._url + 'savecourse', data).map(res => res.json());
  }

  getCourse(id){
    return this.http.get(this._url + 'getcourse?id='+ id).map(res => res.json());
  }

  editCourse(data) {
    return this.http.post(this._url + 'editcourse', data).map(res => res.json());
  }

  getallsubcourse(id, courseid){
    return this.http.get(this._url + 'getallsubcourse?standmstid='+id+'&courseid='+courseid).map(res => res.json());
  }

  getprereqlist(id){
    return this.http.get(this._url + 'getprereqlist?id='+id).map(res => res.json());
  }

  saveSubCourse(data) {
    return this.http.post(this._url + 'savecoursedtls', data).map(res => res.json());
  }

  getsubcourse(id){
    return this.http.get(this._url + 'getsubcourse?id='+id).map(res => res.json());
  }

  editSubCourse(data){
    return this.http.post(this._url + 'editcoursedtls', data).map(res => res.json());
  }

  getAllsubcourselist(){
    return this.http.get(this._url + 'getallsubcourselist').map(res => res.json());
  }

  changecoursestatus(id,status){
    let body = JSON.stringify({ id:id ,status: status});
    return this.http.post(this._url + 'changecoursestatus', body).map(res => res.json());
  }

  getsubcourselist(id,limit,index,searchkey,sort){
    let body = JSON.stringify({ id:id, limit:limit, index: index, searchkey:searchkey,sort:sort});
    return this.http.post(this._url + 'getsubcourselist', body).map(res => res.json());
  }

  getdocumentList(id, limit,index,searchkey, sort){
    let body = JSON.stringify({id:id, limit:limit ,index: index ,searchkey:searchkey, sort:sort});
    return this.http.post(this._url + 'getdocumentlist', body).map(res => res.json());
  }

  savedocument(data) {
    return this.http.post(this._url + 'savedocument', data).map(res => res.json());
  }

  editdocument(data) {
    return this.http.post(this._url + 'editdocument', data).map(res => res.json());
  }

  changesubcoursestatus(id,status){
    let body = JSON.stringify({ id:id ,status: status});
    return this.http.post(this._url + 'changesubcoursestatus', body).map(res => res.json());
  }

  changedocumentstatus(id,status){
    let body = JSON.stringify({ id:id ,status: status});
    return this.http.post(this._url + 'changedocumentstatus', body).map(res => res.json());
  }

}