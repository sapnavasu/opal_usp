import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class DashboardService {
  _url = 'dshbrd/dashboard/';
  constructor(public http: RemoteService) { }

  getWidgetSupplierInfo() {
    return this.http.get(this._url + 'getcompanydetails').map(res => res.json());
  }

  getMyWidgetList() {
    return this.http.get(this._url + 'primaryworkspacedtls').map(res => res.json());
  }
  getWorkspaceWidgetList(workspace_pk) {
    return this.http.get(this._url + 'primaryworkspacedtls?workspace_pk=' + workspace_pk).map(res => res.json());
  }
  getProductServiceCount() {
    return this.http.get(this._url + 'getprodservcount').map(res => res.json());
  }
  getEntAdmindtls() {
    return this.http.get(this._url + 'entadminwidget').map(res => res.json());
  }
}
