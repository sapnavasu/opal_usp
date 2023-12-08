import { Component, OnInit, OnDestroy } from '@angular/core';
import { Router, NavigationEnd, ActivatedRoute } from '@angular/router';
import { Title } from '@angular/platform-browser';

import { merge } from 'rxjs';
import { filter, map, switchMap } from 'rxjs/operators';

import { environment } from '@env/environment';
import { Logger, untilDestroyed } from '@core';
import { I18nService } from '@app/i18n';
import { MenuService } from '@app/services/menu.service'; 
/*********Language**********/
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { SwUpdate } from '@angular/service-worker';
import { Injectable } from "@angular/core";
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { HttpClient, HttpHeaders } from '@angular/common/http';

const log = new Logger('App');


const MINUTES_UNITL_AUTO_LOGOUT = 60 // in mins
const CHECK_INTERVAL = 15000 // in ms
const STORE_KEY =  'lastAction';
@Injectable()

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})

export class AppComponent implements OnInit, OnDestroy {

  public getLastAction() {
    return parseInt(localStorage.getItem(STORE_KEY));
  }
  public setLastAction(lastAction: number) {
    localStorage.setItem(STORE_KEY, lastAction.toString());
  }

  name: string;
  menu: Array<any> = [];
  breadcrumbList: Array<any> = []; 
 /*  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
   {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}]; */
  dir = 'ltr';
  constructor(private security: Encrypt,private localstorageservice: AppLocalStorageServices,private http: HttpClient,private router: Router, private activatedRoute: ActivatedRoute, private titleService: Title, private translate: TranslateService, private i18nService: I18nService,  private menuService: MenuService,private remoteService: RemoteService,
    private cookieService: CookieService,
    private swUpdate: SwUpdate ) {
      translate.addLangs(['en', 'ar']);
      translate.setDefaultLang('en');
      translate.use('en');
      this.check();
      this.initListener();
      this.initInterval();
      localStorage.setItem(STORE_KEY,Date.now().toString());
    }
    initListener() {
      document.body.addEventListener('click', () => this.reset());
      document.body.addEventListener('mouseover',()=> this.reset());
      document.body.addEventListener('mouseout',() => this.reset());
      document.body.addEventListener('keydown',() => this.reset());
      document.body.addEventListener('keyup',() => this.reset());
      document.body.addEventListener('keypress',() => this.reset());
    }

    reset() {
      this.setLastAction(Date.now());
    }

    initInterval() {
      setInterval(() => {
        this.check();
      }, CHECK_INTERVAL);
    }

    check() {
      const now = Date.now();
      const timeleft = this.getLastAction() + MINUTES_UNITL_AUTO_LOGOUT * 60 * 1000;
      const diff = timeleft - now;
      const isTimeout = diff < 0;
      
      if (isTimeout)  {

        if (localStorage.getItem('v3logindata') !== null) {
          const href = environment.baseUrl + 'pm/profile/logout';
          const userpk = { id: this.security.encrypt(this.localstorageservice.getInLocal('opalusermst_pk')) };
          return this.http.post(href, userpk).subscribe(data => {
            localStorage.removeItem('uerpermission');
            localStorage.removeItem('v3logindata');
            localStorage.removeItem('mobileverified');
            localStorage.removeItem('v3logindatarefresh');
            this.router.navigate(['admin/login']);
          });
    
        }
        
        //localStorage.clear();
        //this.router.navigate(['./admin/login']);
      }
    }

  ngOnInit() {
    // Setup logger
   /*  if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.cookieService.set('languageCookieId', toSelect.id);
      this.cookieService.set('languageCode', toSelect.languagecode);
      this.cookieService.set('dir', toSelect.dir);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.remoteService.languageCookieValue(toSelect);
    } */
    if (environment.production) {
      Logger.enableProductionMode();
    }
 
    // Setup translations
    this.i18nService.init(environment.defaultLanguage, environment.supportedLanguages);

    const onNavigationEnd = this.router.events.pipe(filter(event => event instanceof NavigationEnd));

    // Change page title on navigation or language change, based on route data
    merge(this.translate.onLangChange, onNavigationEnd).pipe(
        map(() => {
          let route = this.activatedRoute;
          while (route.firstChild) {
            route = route.firstChild;
          }
          return route;
        }),
        filter(route => route.outlet === 'primary'),
        switchMap(route => route.data),
        untilDestroyed(this)
      )
      .subscribe(event => {
        const title = event.title;
        if (title) {
          this.titleService.setTitle(this.translate.instant(title));
        }
      });
      
     // this.menu = this.menuService.getMenu_en();
     // this.listenRouting(); 
     this.serviceWorkerUpdate();
    }
    serviceWorkerUpdate() {
        // if (this.swUpdate.isEnabled) {

        //   this.swUpdate.available.subscribe(() => {

        //       if(confirm("New version available. Load New Version?")) {

        //           window.location.reload();
        //       }
        //   });
        // }
    }
  ngOnDestroy() {
    this.i18nService.destroy();
  }

  listenRouting() {
    let routerUrl: string, routerList: Array<any>, target: any;
    this.router.events.subscribe((router: any) => {
      routerUrl = router.urlAfterRedirects;
      if (routerUrl && typeof routerUrl === 'string') {
        target = this.menu;
        this.breadcrumbList.length = 0;
        if(routerUrl!=undefined){
          routerUrl = routerUrl.split('?')[0];
          routerList = routerUrl.slice(1).split('/');
          routerList.forEach((router, index) => {
          if (target != undefined ){ 
            target = target.find(page => page.path.slice(2) === router);
            if(target!=undefined){
              let breadcrumb:any = {
                name: target.name,
                langkey: target.langkey,
                path: (index === 0) ? target.path : `${this.breadcrumbList[index-1].path}/${target.path.slice(2)}`,
                redirect: target.redirectTo,
                show: target.show,
                disablelink: target.disablelink,
              };
              if(target.portalName) {
                breadcrumb.portalName = target.portalName
              }
              if(target.portalRedirectTo) {
                breadcrumb.portalRedirect = target.portalRedirectTo
              }
              this.breadcrumbList.push(breadcrumb);
              if (index+1 !== routerList.length) {
                target = target.children;
              }
            }
          }
        });
      }
        this.menuService.breadcrumbArrayValue(this.breadcrumbList);
      }
    });
  } 
  
   removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts = url.split('?');   
    if (urlparts.length >= 2) {

        var prefix = encodeURIComponent(parameter) + '=';
        var pars = urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i = pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
    }
    return url;
}

}
