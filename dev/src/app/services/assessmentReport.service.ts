import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class AssessmentReportService{
  _url = 'ar/assessmentreport/';
  constructor(public http: RemoteService) { }

  getbatchdtls(id) {
    return this.http.get(this._url + 'getbatchdata?batchID=' + id).map(res => res.json());
  }

  getleanersdtls(id) {
    return this.http.get(this._url + 'getlearnersdata?batchID=' + id).map(res => res.json());
  }

  getleanerdata(id) {
    return this.http.get(this._url + 'getlearnerdata?id=' + id).map(res => res.json());
  }

  saveassessmentreport(data) {
    return this.http.post(this._url + 'saveassessmentreport', data).map(res => res.json());
  }

  getassessmentreport(id){
    return this.http.get(this._url + 'getassessmentreport?id=' + id).map(res => res.json());
  }

  getlearnerstatus(){
    return this.http.get(this._url + 'getlearnerstatus').map(res => res.json());
  }


  savequalitycheckstatus(data){
    return this.http.put(this._url + 'savequalitycheckstatus', data).map(res => res.json());
  }
  
  updatelearnerstatus(id){
    return this.http.get(this._url + 'updatelearnerstatus?id=' + id).map(res => res.json());
  }

  getbatchdetails(batchNo){
    return this.http.get(this._url + 'getbatchdetails?batchID=' + batchNo).map(res => res.json());
  }

  getassessordetails(batchNo){
    return this.http.get(this._url + 'getassessordetails?batchNo=' + batchNo).map(res => res.json());
  }

  printcard(serialno, learnerid){
    return this.http.get(this._url + 'printcard?serialno=' + serialno +'&learnerid='+ learnerid).map(res => res.json());
  }

  viewcard(learnerid){
    return this.http.get(this._url + 'viewcard?learnerid='+ learnerid).map(res => res.json());
  }

  getuser(userid){
    return this.http.get(this._url + 'getuser?userid='+ userid).map(res => res.json());
  }

  registrationcancel(id){
    return this.http.get(this._url + 'registrationcancel?id=' + id).map(res => res.json());
  }

  deletelearner(id){
    return this.http.get(this._url + 'deletelearner?id=' + id).map(res => res.json());
  }

}