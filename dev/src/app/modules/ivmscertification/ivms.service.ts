import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})
export class IvmsService {
  url ='ivms/ivms/';
  constructor(public http: RemoteService) { }


  getivmsgrid(pagesize,page,serachkey,sort){
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey,sort:sort});
    return this.http.post(this.url+'getivmsgrid',body).map(response => response.json());
  }

  getivmsoperatorgrid(apppk,pagesize,page,serachkey,sort){
    let body = JSON.stringify({ apppk:apppk,limit:pagesize,page:page,serachkey:serachkey,sort:sort});
    return this.http.post(this.url+'getivmsoperatorgrid',body).map(response => response.json());
  }

  getmaincertificaterecored(){
    let body = JSON.stringify({ });
    return this.http.post(this.url+'getmaincertificaterecored',body).map(response => response.json());
  }

  getcompanydetails(apppk){
    let body = JSON.stringify({apppk:apppk });
    return this.http.post(this.url+'getivmscompanydtls',body).map(response => response.json());
  }
  getivmsinstituedata(apppk){
    let body = JSON.stringify({apppk:apppk });
    return this.http.post(this.url+'getivmsinstituedata',body).map(response => response.json());
  }

  saveivmscompaydtls(apppk,formvalue,apptype){
    let body = JSON.stringify({apppk:apppk,formvalue:formvalue,apptype:apptype });
    return this.http.post(this.url+'saveivmscompaydtls',body).map(response => response.json());
  }
  saveivmsinstitue(apppk,formvalue,apptype){
    let body = JSON.stringify({apppk:apppk,formvalue:formvalue,apptype:apptype });
    return this.http.post(this.url+'saveivmsinstitue',body).map(response => response.json());
  }


}
