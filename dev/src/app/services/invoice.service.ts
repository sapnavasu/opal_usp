import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';
@Injectable({
  providedIn: 'root'
})
export class InvoiceService {

  public url = 'cm/coursemanagement/';
  constructor(private http: RemoteService) { }

  viewinvoice(inv_pk) {
   
    let body = JSON.stringify({ 'inv_pk': inv_pk });
    return this.http.post(this.url + "invoiceview", body).map(res => res.json());
  }

  exportData(sort,order,page,size,gridsearchValues,headerdata, showColumn?: any) {
    let body = JSON.stringify({ 'sort': sort,'order': order,'page': page + 1,'size': size,'gridsearchValues': gridsearchValues,'headerdata':headerdata, 'showColumn': showColumn });
    return this.http.post(this.url + "exportdata", body).map(res => res.json());
  }

  getaccessproject() {
    return this.http.get(this.url + 'getaccessproject').map(res => res.json());
  } 

  
}

