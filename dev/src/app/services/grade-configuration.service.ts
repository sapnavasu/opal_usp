import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';
@Injectable({
  providedIn: 'root'
})
export class GradeConfigurationService {

  public url = 'gc/grade-configuration/';
  constructor(private http: RemoteService) { }

  getgrades(sort){
    let body = JSON.stringify({ sort: sort});
    return this.http.post(this.url + 'getgrades', body).map(res => res.json());
  }

  getgrade(id){
    return this.http.get(this.url + 'getgrade?id='+ id).map(res => res.json());
  }

  getgradelog(id, sort){
    let body = JSON.stringify({ id:id ,sort: sort});
    return this.http.post(this.url + 'getgradeslog', body).map(res => res.json());
  }

  savegrade(data) {
    return this.http.post(this.url + 'editgrade', data).map(res => res.json());
  }
}