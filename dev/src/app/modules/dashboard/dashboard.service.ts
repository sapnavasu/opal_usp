import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})

export class DashboardService {
  public dshbrdUrl = 'dshbrd/dashboard';
  constructor(private http: RemoteService) { }

  supplierDashboard() {
    return this.http.get(`${this.dshbrdUrl}/supplierdashboard`).map(res => res.json());
  }
  getOBGReportData() {
    return this.http.get(`${this.dshbrdUrl}/getobgreportdata`).map(res => res.json());
  }
  getbasicdetails(compid) {
    let body	=	JSON.stringify({'compid':compid});
    return this.http.post(`${this.dshbrdUrl}/getcompbasicdetails`, body).map(res => res.json());
  }
  accessReport(dataType) {
    let body	=	JSON.stringify({'dataType':dataType});
    return this.http.post(`${this.dshbrdUrl}/accessreport`, body).map(res => res.json());
  }
  getPDOLccData(dataType) {
    let body	=	JSON.stringify({'dataType':dataType});
    return this.http.post(`${this.dshbrdUrl}/getpdolccdata`, body).map(res => res.json());
  }

  operatorDashboard() {
    return this.http.get(`${this.dshbrdUrl}/operatordashboard`).map(res => res.json());
  }

  operatorJsearchcnt(){
    return this.http.get('bs/bizsearch/getsuppcnt').map(res => res.json());
  }
  gcctenderintrodata(){
    return this.http.get(`${this.dshbrdUrl}/gcctenderintrodata`).map(res => res.json());
  }
  getcertificationdata(){
    return this.http.get(`${this.dshbrdUrl}/certificationdata`).map(res => res.json());
  }

  getadvisorydata(){
    return this.http.get(`${this.dshbrdUrl}/advisorydata`).map(res => res.json());
  }
  getGetDashboardData() {
    return this.http.get(`${this.dshbrdUrl}/get-centredashboarddata`).map(res => res.json());
  }
  getGetDashboardTechData(prjPk) {
    return this.http.get(`${this.dshbrdUrl}/gettechnicaldashboarddata?prjPk=`+prjPk).map(res => res.json());
  }
  getAdminDashboardData() { 
    return this.http.get(`${this.dshbrdUrl}/get-admindashboarddata`).map(res => res.json());
  }
 getAdminRasDashboardData(prjPk) { 
    return this.http.get(`${this.dshbrdUrl}/get-admin-rasdashboarddata?prjPk=`+prjPk).map(res => res.json());
  }
  getAdminUserDashboardData() { 
    return this.http.get(`${this.dshbrdUrl}/get-adminuserdashboarddata`).map(res => res.json());
  }
}
