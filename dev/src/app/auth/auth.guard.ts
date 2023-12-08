import { Injectable } from '@angular/core';
import { ActivatedRoute, ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Observable } from 'rxjs/Observable';
import { AuthService } from './auth.service';

@Injectable()
export class AuthGuard implements CanActivate {

  public postParams: any;
  public postUrl: any;
  public isAccessAvailable = true;

  constructor(
    private auth: AuthService,
    private myRoute: Router,
    private applocal: AppLocalStorageServices,
    private secuirty: Encrypt,public routeid: ActivatedRoute,
  ) {
    
  }
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {
    if (localStorage.getItem('v3logindata') !== null) { 

      let stateurl = state.url.split('?');   
      if(state.url == '/trainingcentremanagement/branchcentre'){
        if(localStorage.getItem('mainorbranch') == '2'){
          this.myRoute.navigate(['trainingcentremanagement/branchcentre'],{ queryParams: { rt: "no"}});
          return true;
        }else{
          this.myRoute.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { rt: "no"}});
          return true;
        }
     
      } else if(state.url == '/standardcourse/home'){
        
        if(localStorage.getItem('mainorbranch') == '2'){
          
          this.myRoute.navigate(['standardcourse/home'],{ queryParams: { rt: "no"}});
          return true;
        }else{
          this.myRoute.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { rt: "no"}});
          return true;
        }
      }
      else if(state.url == '/batchindex/batchgridlisting'){
      
        if(this.applocal.getInLocal("stktype") == '1'){
          this.myRoute.navigate(['batchindex/batchgridlisting'],{ queryParams: { rt: "no"}});
          return true;
        } else if(localStorage.getItem('mainorbranch') == '2'){
          this.myRoute.navigate(['batchindex/batchgridlisting'],{ queryParams: { rt: "no"}});
        }else{
          this.myRoute.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { rt: "no"}});
          return true;
        }
       
      }
      else{
        return true;
      }
    } else {
      this.myRoute.navigate(['admin/login'], { queryParams: { returnUrl: state.url }});
      const url: string = state.url;
      this.auth.redirectUrl = url;
      return false;      
    }
  }
}
