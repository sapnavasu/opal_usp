import { Component, OnInit, Input } from '@angular/core';
import swal from 'sweetalert';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { ErrorStateMatcher } from '@angular/material/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-viewcredentialsidenavdetail',
  templateUrl: './viewcredentialsidenavdetail.component.html',
  styleUrls: ['./viewcredentialsidenavdetail.component.scss'],
  animations: [SlideInOutAnimation],
})
export class ViewcredentialsidenavdetailComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @Input('viewcredentaildrawer') viewcredentaildrawer: MatDrawer;
  animationState2 = 'out';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }
    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr"
  ngOnInit() {
  }

   viewcredentialalert() {
    swal({
      title: this.i18n('tsviewcredentialsidenavdetail.doyouwanttocan'),
      text: this.i18n('tsviewcredentialsidenavdetail.areyousure'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('tsviewcredentialsidenavdetail.canc'),this.i18n('tsviewcredentialsidenavdetail.ok')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.viewcredentaildrawer.toggle();
      }
    });
    this.animationState2 = 'out';
  }
  viewcredentailview(divName: string) {
    if (divName === 'viewcredentailviewlist') {
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
    
  }
}
