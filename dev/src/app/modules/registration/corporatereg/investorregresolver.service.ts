import { Injectable } from '@angular/core';
import { Resolve, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { registerwithopalComponent } from '../registerwithopal/registerwithopal.component';
import { Observable } from 'rxjs/Observable';
import { RegistrationService } from '../registration.service';
import { CountryService } from '@app/common/newcountry/service/country.service';

@Injectable({
  providedIn: 'root'
})
export class InvestorregresolverService implements Resolve<any> {

  constructor(private regService: RegistrationService,
    private countryService: CountryService) { }

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> {
    let countrylist = this.countryService.getCountry();
    let userIp = this.regService.getuserIp();
    let data = {countrylist: countrylist, userIP: userIp};
    return Observable.of(data);
  }
  
}
