import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class BatchService{
  _url = 'bm/batchmanagement/';
  constructor(public http: RemoteService) { }

  getbatchdtls(regpk,limit,index,searchkey,sorting) {

    let body = JSON.stringify({ regpk : regpk, limit:limit ,index: index ,searchkey:searchkey,sort:sorting});
    return this.http.post(this._url + 'get-batch-dtls',body).map(res => res.json());
  }

  

  getTrainingEvalutionCentres()
  {
    return this.http.get(this._url + 'get-tevalutioncentres').map(res => res.json());
  }

  getStdCourses()
  {
    return this.http.get(this._url + 'get-all-standard-courses').map(res => res.json());
  }

  getStdCoursesByAppPk(appPk)
  {
    return this.http.get(this._url + 'get-all-standard-courses-by-reg-pk?appPk=' + appPk).map(res => res.json());
  }

  getsubcatlistbycatpk(catPk,apppk)
  {
    let body = JSON.stringify({ catPk : catPk, apppk:apppk });
    return this.http.post(this._url + 'getsubcatlistbycatpk',body).map(res => res.json());
  }

  getCourseDtlsbysubcatpk(subcatpk)
  {
    return this.http.get(this._url + 'get-course-dtlsbysubcatpk?subcatpk=' + subcatpk).map(res => res.json());
  }

  checkassessoravailabilty(body)
  {
    
    return this.http.post(this._url + 'checkavailabilityassessor',body).map(res => res.json());
  }

  getBranchlistbyregpk(regPk)
  {
    return this.http.get(this._url + 'getbranchlistbyregpk?regpk=' + regPk).map(res => res.json());
  }

  getcatlist()
  {
    return this.http.get(this._url + 'getcatlist').map(res => res.json());
  }

  checkifstaffselected(body)
  {
    return this.http.post(this._url+'checkifstaffselected',body).map(response => response.json());
  }

  gettutorlist(regPk)
  {
    return this.http.get(this._url + 'get-tutors-list?regpk=' + regPk).map(res => res.json());
  }

  gettutoravailabilitylist(data)
  {
   
    return this.http.post(this._url+'gettutoravailabilitylist',data).map(response => response.json());
  }

  getIVQAStaffByAssessor(body)
  {
    
    return this.http.post(this._url+'get-ivqastafflist',body).map(response => response.json());
  }

  getmasterlist()
  {
    return this.http.get(this._url + 'get-masters-list').map(res => res.json());
  }
  saveBatchData(formValue)
  {
    
      let body = JSON.stringify({ centerdtls: formValue });
      return this.http.post(this._url+'savebatchdtls',body).map(response => response.json());
    
  }

  fetchBatchdetails(bid)
   {
     return this.http.get(this._url + 'fetch-batchdetails?bid='+bid).map(res => res.json());
  }  

  downloadattendance(data)
  {
    
      let body = JSON.stringify({ batchno : data});
      return this.http.post(this._url+'downloadattendance',body).map(response => response.json());
    
  }
  ChangeBatchStatus(data, status, comments?:any)
  {
    
      let body = JSON.stringify({ batchno : data, status:status ,comments: comments });
      return this.http.post(this._url+'change-batchstatus',body).map(response => response.json());
    
  }
  cancelbacktrack(data)
  {
    
      let body = JSON.stringify({ batchno : data });
      return this.http.post(this._url+'cancelbacktrack',body).map(response => response.json());
    
  }
  MovebatchToTheory(data)
  {
      let body = JSON.stringify({ batchno : data });
      return this.http.post(this._url+'move-batch-to-theory',body).map(response => response.json()); 
  }

  Requestforbacktrack(data,comments)
  {
    let body = JSON.stringify({ batchno : data , comments:comments});
    return this.http.post(this._url+'requestforbacktrack',body).map(response => response.json());
  }

  requesttochangeassesor(data ,oldstff,comments)
  {
    let body = JSON.stringify({ batchno : data,oldstff:oldstff,comments: comments});
    return this.http.post(this._url+'requesttochangeassesor',body).map(response => response.json());
  }
  changeassesor(data ,oldstff, newstff,comments,newivqa)
  {
    let body = JSON.stringify({ batchno : data,oldstff:oldstff,newstff:newstff ,comments: comments,newivqa:newivqa});
    return this.http.post(this._url+'changeassesor',body).map(response => response.json());
  }

  getassessorlistbybatchpk(batchno,staffpk,asscentrepk)
  {
    let body = JSON.stringify({ batchno : batchno , staffpk : staffpk,asscentrepk : asscentrepk});
    return this.http.post(this._url+'getassessorlistbybatchpk',body).map(response => response.json());
  }

  getchangeassesorReq(batchno)
  {
    let body = JSON.stringify({ batchno : batchno });
    return this.http.post(this._url+'getchangeassesorreq',body).map(response => response.json());
  }

  updatepaymentstatus(id)
  {
    let body = JSON.stringify({ learnid : id });
    return this.http.post(this._url+'updatepaymentstatus',body).map(response => response.json());
  }

  getCategoryforgridlist()
  {
    return this.http.get(this._url + 'get-categoryforgridlist').map(res => res.json());
  }

  getCivino()
  {
    let body = JSON.stringify({});
    return this.http.post(this._url+'get-civilno',body).map(response => response.json());
  }

}