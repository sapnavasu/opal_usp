import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { InvoiceService } from '@app/services/invoice.service';
import { Location } from '@angular/common';

@Component({
  selector: 'app-paymentmanagement',
  templateUrl: './paymentmanagement.component.html',
  styleUrls: ['./paymentmanagement.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class PaymentmanagementComponent implements OnInit {
  public filtername = "Hide Filter";
  public pending: boolean = false;
  public approved: boolean = false;
  public bronze: boolean = false;
  public gold:boolean = false;
  public pageloader: boolean = false;
  resdata: any;
  public ifarabic: boolean;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService, 
    public toastr: ToastrService,
    public routeid: ActivatedRoute,
    private security: Encrypt,
    private invoiceService : InvoiceService,
    private cookieService: CookieService,private _location:Location) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  ngOnInit(): void {
    this.pageloader = true;
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      } else {
        this.filtername = "إخفاء التصفية";
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          this.ifarabic = false;
        } else {
          this.filtername = "إخفاء التصفية";
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      }
    });

    this.routeid.queryParams.subscribe(params => {
      
      if(this.security.decrypt(params['inv_pk'])){
        this.pageloader = true;
        this.invoiceService.viewinvoice(this.security.decrypt(params['inv_pk'])).subscribe(res => {
          this.pageloader = false;
          this.resdata = res.data.data.data;
            
        });
      }
      
    });
  }
  goBack() {
    this._location.back(); 
  }
}
