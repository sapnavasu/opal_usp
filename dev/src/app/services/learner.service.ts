import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';
@Injectable({
  providedIn: 'root'
})
export class LearnerService {

  public url = 'bm/batchmanagement/';
  constructor(private http: RemoteService) { }

  getLearnerList(bid) {
    // return this.http.get(this.url + 'get-staff-detail').map(res => res.json());
    return this.http.post(this.url + 'getlearnerlist',bid).map(res => res.json());
  }

  registerLearner(data) {
    return this.http.post(this.url + 'learner-register', data).map(response => response.json());;
  }

  saveAcademics(data)
  {
    return this.http.post(this.url + 'learneracademics', data).map(response => response.json());
  }

  saveWorkexp(data){
    return this.http.post(this.url + 'saveworkexplist', data).map(response => response.json());
  }

  getEduList(data)
  {
   
    return this.http.post(this.url+'getlearneredulist',data).map(res=>res.json());
  }

  getExpList(data) {
    
    return this.http.post(this.url + 'getworkexplist',data).map(res => res.json());
  }

  getbranchinfo(data:any)
  {
    return this.http.post(this.url+'getbranchinfo',data).map(res=>res.json());
  }

  markattendance(data:any)
  {
      return this.http.post(this.url+'learnerattendance',data).map(res=>res.json());
  }

  learnerMoveStatus(data:any)
  {
      return this.http.post(this.url+'learnermovestatus',data).map(res=>res.json());
  }

  learnercoursefee(data)
  {
      return this.http.post(this.url+'getlearnerfee',data).map(res=>res.json());
  }

  checkLearner(civilnumval,repo,batchno,cour,btype) {
    //checklearner
    let body = JSON.stringify({ 'civilnumval': civilnumval,'repo':repo,'batchno':batchno,'cour':cour,'btype':btype }); 
    return this.http.post(this.url + "checklearner", body).map(res => res.json()); 
  }

  registerLearnerFinal(data,params){
    data['form'] = params;
    return this.http.post(this.url+'registerlearnerfinal',data).map(res=>res.json());
  }

  getcertified(data){
    return this.http.post(this.url+'getcertified',data).map(res=>res.json());
  }

  learnerage(data,params){
    data['form'] = params;
    return this.http.post(this.url+'learnerage',data).map(res=>res.json());
  }

  viewLearner(learpk,repo) {
    //checklearner
    let body = JSON.stringify({ 'learpk': learpk,'repo':repo });
    return this.http.post(this.url + "viewlearner", body).map(res => res.json());
  }

  updateLearner(data) {
    return this.http.post(this.url + 'learnerupdate', data).map(response => response.json());;
  }

  
}

