import { HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { environment } from '@env/environment';
import { BehaviorSubject, Observable } from 'rxjs';
import { filter } from 'rxjs/internal/operators/filter';
import { take } from 'rxjs/internal/operators/take';
import { switchMap } from 'rxjs/operators/switchMap';
import { SessionExpiredComponent } from './session-expired/session-expired.component';
 
@Injectable({
  providedIn: 'root'
})
export class TokenInterceptorService implements HttpInterceptor {
  private baseUrl: string = environment.baseUrl;
  private isRefreshing = false;
  private refreshTokenSubject: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  constructor(private localStorage: AppLocalStorageServices, private service: ProfileService, private dialog: MatDialog) { }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    
    const ACCESS_TOKEN = this.localStorage.getAccessToken();
    if (ACCESS_TOKEN && request.url.indexOf("assets/") === -1) {
      request = this.addToken(request, ACCESS_TOKEN);
    }
    
    if (request.url.indexOf("assets/") === -1 
    && (request.url.indexOf("http:") === -1 && request.url.indexOf("https:") === -1)) {
      request = this.concatenateBaseUrl(request);
    }

    // return next.handle(request).pipe(catchError(error => {
    //   if (error instanceof HttpErrorResponse && error.status === 401) {
    //     return this.handle401Error(request, next);
    //   } else {
    //     return throwError(error);
    //   }
    // }));
  }

  private concatenateBaseUrl(request: HttpRequest<any>): HttpRequest<any> {
    return request.clone({
      url: this.baseUrl + request.url
    }); 
  }

  private addToken(request: HttpRequest<any>, token: string) {
    return request.clone({
      setHeaders: {
        'Authorization': `Bearer ${token}`
      }
    });
  }

  private handle401Error(request: HttpRequest<any>, next: HttpHandler) {
    if (!this.isRefreshing) {
      this.isRefreshing = true;
      this.refreshTokenSubject.next(null);
  
      return this.service.refreshToken().pipe(
        switchMap((token: any) => {
          this.isRefreshing = false;
          localStorage.setItem('v3logindata', token['data'].token);
          localStorage.setItem('v3logindatarefresh', token['data'].refreshToken);
          this.refreshTokenSubject.next(token['data']);
          if(!token['data'].token){
            this.openDialog();
          }
          return next.handle(this.addToken(request, token['data'].token));
        }));
  
    } else {
      return this.refreshTokenSubject.pipe(
        filter(token => token != null),
        take(1),
        switchMap(jwt => {
          localStorage.setItem('v3logindata', jwt.token);
          localStorage.setItem('v3logindatarefresh', jwt.refreshToken);
          return next.handle(this.addToken(request, jwt.token));
        }));
    }
  }

  openDialog(): void {
    localStorage.removeItem('v3logindata');
    localStorage.removeItem('v3logindatarefresh');
    let dialogRef = this.dialog.open(SessionExpiredComponent, { disableClose: true });
    dialogRef.afterClosed().subscribe(result => {

    });
  }
}
