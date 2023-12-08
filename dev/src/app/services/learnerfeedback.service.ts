import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class LearnerFeedbackService{
  _url = 'lf/learnerfeedback/';
  constructor(public http: RemoteService) { }

  // getlearnerfeedbackquestion(learnerId) {
  //   return this.http.get(this._url + 'getfeedbackquestion?learnerId=' + learnerId).map(res => res.json());
  // }

  // savefeedbackquestion(data){
  //   return this.http.post(this._url + 'savefeedbackquestion', data).map(res => res.json());
  // }

  getfeedbackquestionanswer(learnerId) {
    return this.http.get(this._url + 'getfeedbackquestionanswer?learnerid=' + learnerId).map(res => res.json());
  }

}