import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})
export class LearnerService {
  _url = 'bm/batchmanagement/';
  constructor(public http: RemoteService) {


  }

  getLearnerList() {
    return this.http.get(this._url + 'get-batch-dtls').map(res => res.json());
  }
}
