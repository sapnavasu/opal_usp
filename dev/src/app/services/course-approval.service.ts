import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})
export class CourseApprovalService {
  _url='scca/appcourse/';
  constructor(public http: RemoteService) { }

  getstandardcourselist(temp_pk,type) {
    let body = JSON.stringify({ temp_pk: temp_pk,type: type });
    return this.http.post(this._url+'getstandardcourselist',body).map(response => response.json());
  }
}
