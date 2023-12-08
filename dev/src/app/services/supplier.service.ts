import { Injectable } from '@angular/core';
import { RemoteService } from '../../remote.service';

@Injectable({
  providedIn: 'root'
})
export class SupplierService {
  _url = 'nbf/';
  constructor(public http: RemoteService) { }

  getsupplierinfo() {
    return this.http.get(this._url + 'stakeholder/getsupplierinfo').map(res => res.json());
  }

}
