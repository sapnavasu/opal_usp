import { Component, Input, OnInit } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '../animation';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-adddepartmentnav',
  templateUrl: './adddepartmentnav.component.html',
  styleUrls: ['./adddepartmentnav.component.scss'],
  animations: [SlideInOutAnimation]
})
export class AdddepartmentnavComponent implements OnInit {
  animationState = 'out';
  @Input('draweraddingdep') draweraddingdep: MatDrawer;
  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    
  ) { 
  }

  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  }); 
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentuserrole') {
        this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
}

}
