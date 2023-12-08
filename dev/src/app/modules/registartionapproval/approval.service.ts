import { Injectable } from '@angular/core';
import {Router,Resolve,ActivatedRouteSnapshot} from '@angular/router';
import { Observable } from 'rxjs';
import { forkJoin } from 'rxjs';
import {ViewModelData} from './viewandvalidate/viewModel/view-model';
import {HttpClient} from '@angular/common/http';
import { SupplierList } from './model/supplierList';
import { RemoteService } from '@app/remote.service';

@Injectable({
  providedIn: 'root'
})
export class ApprovalService {
  private _url : string = "apr/approval/";
  constructor(private http: RemoteService, private httpc: HttpClient) { }

  fetchPaymentApprovalViewPageData(reqId:any):Observable<ViewModelData>{
    return this.http.get(this._url+'viewapproval'+'?reqId='+reqId).map(res => res.json());
  }
  fetchSupplierListData():Observable<SupplierList[]>{
    return this.http.get(this._url+'supplierdata').map(res => res.json());
  }
  statusChange(postdata:any){
    return this.http.post(this._url+'paymentstatuschange',postdata).map(res => res.json());
  }
  fetchProjectData(reqId:any):Observable<any>{
    return this.http.get(this._url+'getprojectdetails'+'?memberRegPk='+reqId).map(res=>res.json());
  }
  resendInvoice(companyPk:any,regPk:any):Observable<any>{
    return this.http.get(this._url+'resendinvoice'+'?companypk='+companyPk+'&regpk='+regPk).map(res=>res.json());
  }
  resendReceipt(companyPk:any,regPk:any):Observable<any>{
    return this.http.get(this._url+'resendreceipt'+'?companypk='+companyPk+'&regpk='+regPk).map(res=>res.json());
  }
  paymtupdyestatusChange(value:number,postdata:any){
    let body	=	JSON.stringify({'fdata':postdata,'id':value});
    return this.http.post(this._url+'updtepaymentstatuschange',body).map(res => res.json());
  }
  getcompdetails(regPk:any){
    let body	=	JSON.stringify({'regpk':regPk});
    return this.http.post(this._url+'getcompdetails',body).map(res=>res.json());
  }
  getpaymenttracker(regPk:any){
    let body	=	JSON.stringify({'regpk':regPk});
    return this.http.post(this._url+'getpaymenttrackerinfo',body).map(res=>res.json());
  }
  getsubpaymentdetails(invpk:any){
    let body	=	JSON.stringify({'invpk':invpk});
    return this.http.post(this._url+'getpaymentdetails',body).map(res=>res.json());
  }
  deactivateordeletesupplier(data){
    let body	=	JSON.stringify({'data':data});
    return this.http.post(this._url+'deletedeactivatesupp',body).map(res=>res.json());
  }
  deletesupplier(data){
    let body	=	JSON.stringify({'data':data});
    return this.http.post(this._url+'deletesupplier',body).map(res=>res.json());
  }
  getrenewaldetails(regPk:any)
  {
    let body	=	JSON.stringify({'regpk':regPk});
    return this.http.post(this._url+'getrenewaldtls',body).map(res => res.json());
  }
  checkforeignclassification(compPk: number) {
    const body = JSON.stringify({ comp: { compPk: compPk} });
    return this.http.post(this._url + 'checkforeignclassification', body).map(res => res.json());
  }
  getapprovaltemplate() {
    return this.http.get(this._url+'getapprovaltemplate').map(res => res.json());
  }
  getstkdeletetemplate() {
    return this.http.get(this._url+'getstkdeletetemplate').map(res => res.json());
  }
  getstkdeactivatetemplate() {
    return this.http.get(this._url+'getstkdeactivatetemplate').map(res => res.json());
  }
  resendregconfirmation(regPk:any):Observable<any>{
    return this.http.get(this._url+'resendregistrationconfirma'+'?registrationid='+regPk).map(res=>res.json());
  }
  changeUser(newAdminUserPk, regpk, userPk){
    const body = JSON.stringify({ newAdminUserPk: newAdminUserPk, regpk: regpk, userPk: userPk });
    return this.http.post(this._url+'changeuser',body).map(res => res.json());
  }
  gettrakerdetails(regPk:any,comppk:any){
    return this.http.get(this._url+'gettrakerdetails?id='+regPk+'&sid='+comppk).map(res=>res.json());
  }
}
