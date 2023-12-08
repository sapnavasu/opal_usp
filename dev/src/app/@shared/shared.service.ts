import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Headers, RequestOptions } from '@angular/http';
import { RemoteService } from '@app/remote.service';
import { NgDynamicBreadcrumbService } from 'ng-dynamic-breadcrumb';
import { Observable, of } from 'rxjs';
import { Encrypt } from '../common/class/encrypt';
import { MatDialog } from '@angular/material/dialog';
import { finalize, share, tap } from 'rxjs/operators';
let options: any;
export interface Captcha {
  responsecode: number;
  responsemsg: string;
}

@Injectable()
export class SharedService {
 
  public configurationjson = 'backend/configuration/formdata';
  Stakeholderstatus: Function;
  private countryCache: any;
  private countryCachedObservable: Observable<any>;
  private postresdata: Observable<object>;
  constructor(private dialog: MatDialog,public http: HttpClient, public _http: RemoteService, public encryptwrapper: Encrypt,private ngDynamicBreadcrumbService: NgDynamicBreadcrumbService) {
    const headers = new Headers();
    headers.append('Access-Control-Allow-Origin', 'http://' + window.location.hostname + ':4200');
    headers.append('Content-Type', 'application/json');
    headers.append('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token');
    options = new RequestOptions({headers});
  }

  getbreadcrumb(breadcrumb){
    this.ngDynamicBreadcrumbService.updateBreadcrumb(breadcrumb);
  }

  getproductmap() {
    return this._http.get('pm/profile/getproductgroup').map(res => res.json());
  }
  getMyname() {
    return 'https://www.google.co.in/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png';
  }

  getCaptcha(): Observable<Captcha[]> {
    return this.http.get<Captcha[]>('http://' + window.location.hostname + '/phpcaptcha/captcha.php');
  }


  captchavalidate(formval: any) {
    const posturl = 'http://' + window.location.hostname + '/phpcaptcha/demo.php';
    let response: any;
    return this.http.post(posturl, formval, options);
  }

  getmenulist(stkPk?: number) {
    const menuurl = 'mst/menu/getmenulist?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    const formParam = JSON.stringify({'uac': 'f9d6c6ad2e0f8bfded8c4c37e4140629', 'postParams': {'stkPk': stkPk} });
    return this._http.post(menuurl, formParam).map(res => res.json());
  }

  getfilemst(fileRefNo: number, selectedFilePks: number[] = []) {
    const menuurl = 'drv/drive/filemst?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    const formParam = JSON.stringify({'uac': 'f9d6c6ad2e0f8bfded8c4c37e4140629', 'postParams': {
      'fileRefNo': fileRefNo,
      'selectedPks': selectedFilePks,
    } });
    return this._http.post(menuurl, formParam).map(res => res.json());
  }

  getmenulistfromfile(userpk: any) {
    const menuurl = `Menus/menu_${userpk}.json`;
    return this._http.get(menuurl).map(res => res.json());
  }
  getUserData(userPk) {
    let body = JSON.stringify({ 'userPk': userPk });
    return this._http.post( "ea/user/getuserdata", body).map(res => res.json());
  }

  responseHandling(res: any) {
    return res.returncode;
  }
  getlocaldatas() {
    const dataurl = 'pm/profile/localstoragefiles';
    return this._http.get(dataurl).map(res => res.json());
  }

  changecheckservice(data: any) {
    const dataurl = 'pm/profile/';
    const body = JSON.stringify({ 'check_date': data });
    return this._http.post(dataurl + 'filemdate', body).map(res => res.json());
  }
  submitFaq(data: any) {
    const dataurl = 'pm/profile/';
    const body = JSON.stringify({ 'formData': data });
    return this._http.post(dataurl + 'submitfaqdata', body).map(res => res.json());
  }
  companyjson() {
    return this._http.get(this.configurationjson + '?type=Company').map(res => res.json());
  }

  getStakeholder(postParams: any, href: any) {
    const formParam = JSON.stringify({ 'postParams': postParams });
    return this._http.post(href, formParam).map(res => res.json());
  }

  saveExcel(data?: any,errorsData?:any,successData?:any,fileData?:any) {
    const formParam = JSON.stringify({ 'data': data,'errorsData':errorsData,'successData':successData,'fileData':fileData});
    return this._http.post('pms/pms/saveexcel', formParam).map(res => res.json());
  }
  BackendValidate(data?: any) {
    const formParam = JSON.stringify({'data': data});
    return this._http.post('pms/pms/validate-exel', formParam).map(res => res.json());
  }
  getAuditTrialData(sortDirection){
    const dataurl = 'pms/pms/';
    return this._http.get(dataurl + 'getaudittrialdata?sort='+sortDirection).map(res => res.json());
  }
  createExcel(data:any,originalFileName:any){
    const formParam = JSON.stringify({ 'data': data,'originalFileName':originalFileName });
    return this._http.post('pms/pms/createexcel', formParam).map(res => res.json());
  }
  getStakeholderstatus() {
    const dataurl = 'inv/investorhub/';
    return this._http.get(dataurl + 'stakeholderstatus').map(res => res.json());
  }
  getFaqdetailsOfDetails(module: any, details: any) {
    const faqurl = 'pm/profile/';
    const moduleen = this.encryptwrapper.encrypt(module);
    const detailscrypt = details;
    return this._http.get(faqurl + 'getfaqdata?module=' + moduleen + '&detail=' + detailscrypt).map(res => res.json());
  }
  getrelateddata(detailpk: any, type: any) {
    const prdrelurl = 'pm/profile/';
    return this._http.get(prdrelurl + 'getrelatedproduct?detailpk=' + detailpk + '&type=' + type).map(res => res.json());
  }
  
  getCountryList(): Observable<any> {
    let observable: Observable<any>;
    if (this.countryCache) {
      observable = of(this.countryCache);
    }  else if (this.countryCachedObservable) {
      observable = this.countryCachedObservable;
    } else {
      this.countryCachedObservable = this._http.get('mst/country/countrylist')
        .pipe(
          tap(res => {
            this.countryCache = res;
          }),
          share(),
          finalize(() => this.countryCachedObservable = null)
        );
      observable = this.countryCachedObservable;
    }
    return observable;
  }

  getCountries(){
   return this._http.get('mst/country/getcountries').map(response => response.json());;
  }
}
 