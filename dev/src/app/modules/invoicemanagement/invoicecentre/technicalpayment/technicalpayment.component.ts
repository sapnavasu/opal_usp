import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { RemoteService } from '@app/remote.service';
import { TechnicalCenterService } from '@app/services/technical-center.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from 'ngx-toastr';
import { Location } from '@angular/common';


@Component({
  selector: 'app-technicalpayment',
  templateUrl: './technicalpayment.component.html',
  styleUrls: ['./technicalpayment.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class TechnicalpaymentComponent implements OnInit {
  public pending: boolean = false;
  public bronze: boolean = false;
  public gold:boolean = false;
  public approved: boolean = true;
  public loaderpage: boolean = false;
  public ifarabic: boolean;
  technicalData: any;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService, public toastr: ToastrService, 
    private security : Encrypt,
    private technicalService: TechnicalCenterService,
    private route: ActivatedRoute,
    private cookieService: CookieService,private _location:Location,) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });

    this.route.queryParams.subscribe(params => {
      if(this.security.decrypt(params['id'])){
          this.loaderpage = true;
        this.technicalService.viewtechnicalcenter(this.security.decrypt(params['id'])).subscribe(res => {
          this.loaderpage = false;
          this.technicalData = res?.data;
         
        });
      }
    });
  }
  goBack(event) {
    this._location.back(); 
    localStorage.setItem('matTab', event);
  }
}
