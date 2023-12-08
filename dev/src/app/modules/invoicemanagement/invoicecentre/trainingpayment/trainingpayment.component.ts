import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { RemoteService } from '@app/remote.service';
import { CenterCertificationService } from '@app/services/center-certification.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from 'ngx-toastr';
import { Location } from '@angular/common';

@Component({
  selector: 'app-trainingpayment',
  templateUrl: './trainingpayment.component.html',
  styleUrls: ['./trainingpayment.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class TrainingpaymentComponent implements OnInit {
  public pending: boolean = false;
  public approved: boolean = false;
  public bronze: boolean = false;
  public gold:boolean = false;
  public ifarabic: boolean;
  public fullpageloading: boolean = false;
  centerData: any;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService, public toastr: ToastrService, 
    private cookieService: CookieService,
    private route: ActivatedRoute,
    private security : Encrypt,
    private certService : CenterCertificationService,private _location:Location) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.ifarabic = false;
      } else {
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
        } else {
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.ifarabic = false;
      }
    });

    this.route.queryParams.subscribe(params => {

      if(this.security.decrypt(params['id'])){
        this.fullpageloading = true;
        this.certService.viewtraingingcenter(this.security.decrypt(params['id'])).subscribe(res => {
            this.fullpageloading = false;
            this.centerData = res?.data;
         
        });
      }
    });
  }

  goBack() {
    this._location.back(); 
  }

}

