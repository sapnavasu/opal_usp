import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class MasterDataConfigurationService{
  _url = 'mdc/master-data-configuration/';
  constructor(public http: RemoteService) { }

  //feesubscribtion
  getfeeslist(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getfeeslist', body).map(res => res.json());
  }

  getfeesubscription(id){
    return this.http.get(this._url + 'getfeesubscription?id='+id).map(res => res.json());
  }

  savefeesubscription(data) {
    return this.http.post(this._url + 'savefeesubscription', data).map(res => res.json());
  }

  getProject(){
    return this.http.get(this._url + 'getproject').map(res => res.json());
  }


  //Course category
  getcoursecategorylist(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getcoursecategorylist', body).map(res => res.json());
  }

  getcoursecategory(id){
    return this.http.get(this._url + 'getcoursecategory?id='+id).map(res => res.json());
  }

  savecoursecategory(data) {
    return this.http.post(this._url + 'savecoursecategory', data).map(res => res.json());
  }

  updatecoursecategory(data) {
    return this.http.post(this._url + 'editcoursecategory', data).map(res => res.json());
  }

  updatestatuscourse(data) {
    return this.http.post(this._url + 'updatecoursestatus', data).map(res => res.json());
  }

  //Course Sub Category

  getcoursesubcategorylist(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getcoursesubcategorylist', body).map(res => res.json());
  }

  savecoursesubcategory(data) {
    return this.http.post(this._url + 'savecoursesubcategory', data).map(res => res.json());
  }

  updatecoursesubcategory(data) {
    return this.http.post(this._url + 'editcoursesubcategory', data).map(res => res.json());
  }

  updatestatuscoursesubcategory(data) {
    return this.http.post(this._url + 'updatecoursesubcategorystatus', data).map(res => res.json());
  }

  getcourselist(){
    return this.http.get(this._url + 'getcoursecategories').map(res => res.json());
  }


  //Moheri Grade

  getmoherigradelist(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getmoherigradelist', body).map(res => res.json());
  }
  
  getmoherigrade(id){
    return this.http.get(this._url + 'getmoherigrade?id='+id).map(res => res.json());
  }

  addmoherigrade(data) {
    return this.http.post(this._url + 'addmoherigrade', data).map(res => res.json());
  }

  editmoherigrade(data) {
    return this.http.post(this._url + 'editmoherigrade', data).map(res => res.json());
  }

  updatmoherigradestatus(data) {
    return this.http.post(this._url + 'updatmoherigradestatus', data).map(res => res.json());
  }

  //Reference

  getreferencelist(mastertype,limit,index,searchkey,sorting){
    let body = JSON.stringify({ mastertype:mastertype, limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getreferencelist', body).map(res => res.json());
  }
  
  getreference(id){
    return this.http.get(this._url + 'getreference?id='+id).map(res => res.json());
  }

  addreference(data) {
    return this.http.post(this._url + 'addreference', data).map(res => res.json());
  }

  editreference(data) {
    return this.http.post(this._url + 'editreference', data).map(res => res.json());
  }

  updatreferencestatus(data) {
    return this.http.post(this._url + 'updatreferencestatus', data).map(res => res.json());
  }

  //vehicle

  getvehiclelist(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getvehiclecategorylist', body).map(res => res.json());
  }
  
  getvehicle(id){
    return this.http.get(this._url + 'getvehiclecategory?id='+id).map(res => res.json());
  }

  addvehicle(data) {
    return this.http.post(this._url + 'savevehiclecategory', data).map(res => res.json());
  }

  editvehicle(data) {
    return this.http.post(this._url + 'editvehiclecategory', data).map(res => res.json());
  }

  updatvehiclestatus(data) {
    return this.http.post(this._url + 'updatevehiclestatus', data).map(res => res.json());
  }


  //vehicle sub category

  getvehiclesubcategorylist(limit,index,searchkey,sorting){
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey, sort:sorting});
    return this.http.post(this._url + 'getvehiclesubcategorylist', body).map(res => res.json());
  }
  
  getvehiclesubcategory(id){
    return this.http.get(this._url + 'getvehiclesubcategory?id='+id).map(res => res.json());
  }

  addvehiclesubcategory(data) {
    return this.http.post(this._url + 'savevehiclesubcategory', data).map(res => res.json());
  }

  editvehiclesubcategory(data) {
    return this.http.post(this._url + 'editvehiclesubcategory', data).map(res => res.json());
  }

  updatevehiclesubcategorystatus(data) {
    return this.http.post(this._url + 'updatevehiclesubcategorystatus', data).map(res => res.json());
  }
  
}