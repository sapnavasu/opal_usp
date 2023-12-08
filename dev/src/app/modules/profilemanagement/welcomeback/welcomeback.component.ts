import { Component, OnInit } from '@angular/core';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
@Component({
  selector: 'app-welcomeback',
  templateUrl: './welcomeback.component.html',
  styleUrls: ['./welcomeback.component.scss']
})
export class WelcomebackComponent implements OnInit {

  constructor(public localdata:AppLocalStorageServices,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }
  public localvisit=this.localdata.getInLocal('lastvisit');
  public showwelcomeback;
  public routerlink;
  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  });
    this.showwelcomeback=(localStorage.getItem('userlastvisit') !='0')?'1':'0';
    if(window.location.href.split('#')[1] ==this.localdata.getInLocal('lastvisit'))
    {
      this.showwelcomeback=0; 
    }
    else
    {
      this.routerlink=this.localdata.getInLocal('lastvisit');
    }
   
  }
  cancellastview()
  {
    localStorage.setItem('userlastvisit','0');
    this.showwelcomeback='0';
  }
  welcomeback()
  {
    localStorage.setItem('userlastvisit','0');
    this.showwelcomeback='0'; 
  }
}
