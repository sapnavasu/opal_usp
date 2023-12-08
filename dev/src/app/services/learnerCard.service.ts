import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class LearnerCardService{
  _url = 'lc/learnercard/';
  constructor(public http: RemoteService) { }

  getlearnercard(limit,index,searchkey) {
    let body = JSON.stringify({ limit:limit ,index: index ,searchkey:searchkey});
    return this.http.post(this._url + 'getlearnercard', body).map(res => res.json());
  }

  getstandardcourse(){
    return this.http.get(this._url + 'getstandardcourse').map(res => res.json());
  }

  getsinglelearnercard(staffid, courseid) {
    let body = JSON.stringify({ staffid:staffid ,courseid: courseid});
    return this.http.post(this._url + 'getsinglelearnercard', body).map(res => res.json());
  }
  
  carddetails(staffid, courseid,limit,index,searchkey) {
    let body = JSON.stringify({ staffid:staffid ,courseid: courseid, limit:limit ,index: index ,searchkey:searchkey});
    return this.http.post(this._url + 'carddetails', body).map(res => res.json());
  }

  getsubcategories(courseid){
    return this.http.get(this._url + 'getsubcategories?courseid='+ courseid).map(res => res.json());

  }

  existcivilnumber(civilnumber){
    return this.http.get(this._url + 'existcivilnumber?civilnumber='+ civilnumber).map(res => res.json());
  }

  getnationality(){
    return this.http.get(this._url + 'getnationality').map(res => res.json());
  }

  saveandgeneratercard(data) {
    
    return this.http.post(this._url + 'saveandgeneratercard', data).map(res => res.json());
  }

  getbatchnumber(batchno, courseid){
    return this.http.get(this._url + 'getbatchnumber?batchno='+batchno+'&courseid='+courseid).map(res => res.json());
  }

  gettrainingcenter(batchid = null){
    return this.http.get(this._url + 'gettrainingcenter?batchid='+ batchid).map(res => res.json());
  }

  alreadyexistsubcategorycard(staffid, categoryid){
    return this.http.get(this._url + 'alreadyexistsubcategorycard?staffid='+ staffid + '&categoryid='+categoryid).map(res => res.json());
  }

  editcard(data){
    return this.http.post(this._url + 'editcard', data).map(res => res.json());
  }

  addsubcategory(data){
    return this.http.post(this._url + 'addsubcategory', data).map(res => res.json());
  }

  getstaffdata(data){
    return this.http.get(this._url + 'getstaffdata?civilnumber='+ data).map(res => res.json());
  }

  addstaff(data){
    return this.http.post(this._url + 'addstaff', data).map(res => res.json());
  }

  addLearnerwithnewcatergory(data){
    return this.http.post(this._url + 'addlearnerwithnewcatergory', data).map(res => res.json());
  }

  alreadybatchnoexist(batchno, subcateid){
    return this.http.get(this._url + 'alreadybatchnoexist?batchno='+ batchno + '&subcateid='+subcateid).map(res => res.json());
  }

  deactivecard(cardid){
    return this.http.get(this._url + 'deactivecard?cardid='+ cardid).map(res => res.json());
  }
}