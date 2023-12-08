import { EventEmitter, Injectable, OnInit, Output } from '@angular/core';
import {
  Http, Headers, RequestOptions, Response,
  RequestOptionsArgs
} from '@angular/http';
import { HttpClient, HttpHeaders, HttpParams, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/Rx';
import { Router } from '@angular/router';
import { environment } from '../environments/environment';
import { CookieService } from 'ngx-cookie-service';
import { Encrypt } from './common/class/encrypt';
import { v4 as uuidv4 } from 'uuid';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';

@Injectable()
export class RemoteService implements OnInit {

  public fullurl: any = location.protocol + '//' + location.hostname + (location.port ? ':' + 81 : '');
  public appBaseUrl = environment.baseUrl;
  public accesstoken = '';
  public ipaddressdetails: any;
  public randomVal: any;
  private tooltipCookie = new BehaviorSubject<String>('false');
  private currencyCookie = new BehaviorSubject<any>({"curid":2,"currancyName":"USD","currancycode":"usd","CountryMst_Pk":136});
  private languageCookie = new BehaviorSubject<any>({"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"});
  private ipdtlsCookie = new BehaviorSubject<any>(null);
  stktype: any;
  ipaddressdetailsnew= new BehaviorSubject<any>(null);
  regtype: any;
  breadcrumCookie =new BehaviorSubject<any>({ title: 'Training Centre Certification',
  urls: [
    { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre',last:'true' },
  ]}); ;
  breadcrumoutputCookie = new BehaviorSubject<any>(null);
  constructor(
    protected oldhttp: Http,
    protected newhttp: HttpClient,private security: Encrypt,
    // protected localstorage: AppLocalStorageServices,
    protected route: Router,private cookieService: CookieService
  ) {

  }

  ngOnInit() {
    this.newhttp.get<{ip: string}>('https://jsonip.com')
    .subscribe( data => {
      this.ipaddressdetails = data.ip;
      //
    });
  }

  get(url: string, options?: RequestOptionsArgs): Observable<Response> {
    return this.oldhttp.get(this.makeFullUrl(url), this.addHeaders(options))
      .catch(this.handleError.bind(this)) as Observable<Response>;
  }

  post(url: string, body: string, options?: RequestOptions): Observable<Response> {
    return this.oldhttp.post(this.makeFullUrl(url), body, this.addHeaders(options))
      .catch(this.handleError.bind(this)) as Observable<Response>;
  }
  fileupload(url: string, body: FormData, options?: any): Observable<Response> {
    return this.oldhttp.post(this.makeFullUrl(url), body, this.fileaddHeaders(options))
      .catch(this.handleError.bind(this)) as Observable<Response>;
  }

  filepost(url: string, body: FormData, options?: any): Observable<Response> {
    return this.oldhttp.post(this.makeFullUrl(url), body, this.filepostHeaders(options))
      .catch(this.handleError.bind(this)) as Observable<Response>;
  }
  put(url: string, body: string, options?: RequestOptions): Observable<Response> {
    return this.oldhttp.put(this.makeFullUrl(url), body, this.addHeaders(options))
      .catch(this.handleError.bind(this)) as Observable<Response>;
  }

  delete(url: string, options?: RequestOptionsArgs): Observable<Response> {
    return this.oldhttp.delete(this.makeFullUrl(url), this.addHeaders(options))
      .catch(this.handleError.bind(this)) as Observable<Response>;
  }

  protected handleError(error: any): Observable<any> {
    if (error.status !== 422) {
      // Handle error responses
    }
    return Observable.throw(error);
  }

  protected addHeaders(options?: RequestOptionsArgs): RequestOptionsArgs {
    options =  new RequestOptions();
    options.headers = new Headers();
    options.headers.set('Content-Type', 'application/json; charset=UTF-8');
    if (localStorage.getItem('v3logindata') != '') {
        options.headers.set('Authorization', 'Bearer ' + localStorage.getItem('v3logindata'));
        options.headers.set('currenturl', this.route.url);
      }
    options.headers.set('ipaddress', this.ipaddressdetails);
    if(environment.production == true){
      this.randomVal = '';
      this.randomVal= this.security.encrypt(uuidv4());
      const now = new Date();
      now.setHours(now.getHours() + 3);
      // this.cookieService.set('csrf_'+this.randomVal, this.randomVal,now,'/');
      // const headerval:any = JSON.stringify({value:this.randomVal,label:'csrf_'+this.randomVal})
      // options.headers.set('csrf', headerval);
    }
    return options;
  }
  private setCookie(name: string, value: string, expireDays: any, path: string = '') {
      let d:Date = new Date();
      d.setTime(d.getTime() + expireDays * 24 * 60 * 60 * 1000);
      let expires:string = `expires=${d.toUTCString()}`;
      let cpath:string = path ? `; path=${path}` : '';
      document.cookie = `${name}=${value}; ${expires}${cpath}`;
  }
  protected fileaddHeaders(options?: RequestOptionsArgs): RequestOptionsArgs {
    options = options || new RequestOptions();
    if (!options.headers) {
      options.headers = new Headers();
      if (localStorage.getItem('v3logindata') != '') {
        options.headers.set('Authorization', 'Bearer ' + localStorage.getItem('v3logindata'));
        options.headers.set('currenturl', this.route.url);
      }
    } else {

    }
    return options;
  }
  protected filepostHeaders(options?: RequestOptionsArgs): RequestOptionsArgs {
    options = options || new RequestOptions();
    if (!options.headers) {
      options.headers = new Headers();
      options.headers.set('Content-Type', 'text/plain');
      if (localStorage.getItem('v3logindata') != '') {
        options.headers.set('Authorization', 'Bearer ' + localStorage.getItem('v3logindata'));
        options.headers.set('currenturl', this.route.url);
      }
    } else {

    }
    return options;
  }

  protected addNewHeaders(options?: HttpHeaders): HttpHeaders {
    options = options || new HttpHeaders();
    options.append('Content-Type', 'application/json');
    return options;
  }

  protected makeFullUrl(url: any) {
    if (url != '') {
      // return url;
      return this.appBaseUrl + url;
    }
  }
  languageCookieValue(value) {
    this.languageCookie.next(value);
  }
  getLanguageCookie() {
    return this.languageCookie.asObservable();
  }
  breadcrumCookieValue(value) {
    this.breadcrumCookie.next(value);
  }
  getbreadcrumCookie() {
    return this.breadcrumCookie.asObservable();
  }
  breadcrumCookieValueoutput(value) {
    this.breadcrumoutputCookie.next(value);
  }
  getbreadcrumCookieoutput() {
    return this.breadcrumoutputCookie.asObservable();
  }
  setipdtlsCookieValue(value:any) {
    this.ipdtlsCookie.next(value);
  }
  
  getipdtlsCookie() {
    return this.ipdtlsCookie.asObservable();
  }
  currencyCookieValue(value) {
    this.currencyCookie.next(value);
  }  
  getCurrencyCookie() {
    return this.currencyCookie.asObservable();
  }
  setstakeholdertypereg(stkpk:any,registeras:any) {
    this.stktype = stkpk;
    this.regtype = registeras;
  }
  getstakeholdertypereg() {
    let response = [];
    response['stkpk'] = this.stktype;
    response['registeras'] = this.regtype;
    return response;
  }
  
  showtooltipCookieValue(value){
    this.tooltipCookie.next(value);
  }
  getShowtooltipCookie() {
    return this.tooltipCookie.asObservable();
  }

  getipdetail()
  {
    return this.newhttp.get<any>('https://api.ipdata.co/?api-key=0c2da7407889a3791f64747ca59ee1b2af9ee83aaaadf4b0ea2915a8')
    .map( data => data);
  }
}
