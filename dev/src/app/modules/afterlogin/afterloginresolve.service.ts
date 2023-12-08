import { Injectable } from '@angular/core';
import {ActivatedRouteSnapshot, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs/Observable';
import { AfterloginService } from './afterlogin.service';

@Injectable({
  providedIn: 'root'
})
export class AfterloginresolveService implements Resolve<any> {

  constructor(private afterloginService: AfterloginService) { }

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> {
    const stakeholderDtl = this.afterloginService.getStakeholderDtls();
    const subscriptionStatus = this.afterloginService.getSubscriptionStatus()
    return Observable.of({stakeholderDtl: stakeholderDtl, subscriptionStatus:subscriptionStatus});
  }
}
