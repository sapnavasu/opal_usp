import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { RemoteService } from '@app/remote.service';

@Injectable()
export class AuthService {
  public redirectUrl: any = '';
  constructor(
    private myRoute: Router,
    public http: RemoteService
  ) { }
  sendToken(token: string) {
    localStorage.setItem('v3logindata', token);
  }
  getToken() {
    return localStorage.getItem('v3logindata');
  }
  isLoggednIn() {
    if (localStorage.getItem('v3logindata')) {
      return true;
    } else {
      return false;
    }
  }
  logout() {
    localStorage.removeItem('v3logindata');
    this.myRoute.navigate(['login']);
  }

  accessService(postParams: any, href: any) {
    const formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href, formParam).map(res => res.json());
  }
}
