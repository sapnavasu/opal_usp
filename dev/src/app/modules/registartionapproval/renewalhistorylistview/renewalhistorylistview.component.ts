import { Component, OnInit, ViewChild, Input,} from '@angular/core';
import swal from 'sweetalert';
import {ViewEncapsulation } from '@angular/core';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { MatDrawer } from '@angular/material/sidenav';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-renewalhistorylistview',
  templateUrl: './renewalhistorylistview.component.html',
  styleUrls: ['./renewalhistorylistview.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class RenewalhistorylistviewComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  renewallists = [
      {renewaltitle:'Renewal 2020',renewaldate:'23-12-2020',renewaltime:'08:24 am',expirydate:'Expiry Date',datediaveted:'22-12-2021',datecolor:'spandeviatecolor'},
      {renewaltitle:'Renewal 2019',renewaldate:'22-11-2019',renewaltime:'08:24 am',expirydate:'Expiry Date',datediaveted:'22-12-2021',datecolor:'spandeviatecolor'},
      {renewaltitle:'Renewal 2018',renewaldate:'25-11-2018',renewaltime:'10:02 am',expirydate:'Expiry Date',datediaveted:'22-12-2021',datecolor:'spandeviatecolor'},
      {renewaltitle:'Renewal 2017',renewaldate:'25-12-2017',renewaltime:'11:10 am',expirydate:'Expiry Date',datediaveted:'22-12-2021',datecolor:'spandeviatecolor'},
      {renewaltitle:'Renewal 2016',renewaldate:'20-12-2016',renewaltime:'09:15 am',expirydate:'Validation Status',datecountrenewal:'Deviated',deviated:'deviatedcolor'},
      {renewaltitle:'Registration 2015',renewaldate:'22-11-2015',renewaltime:'08:24 am',expirydate:'Expiry Date',datediaveted:'22-12-2021',datecolor:'spandeviatecolor'},
  ];
  animationState1 = 'out';
  @Input('reneviewlistdrawer') reneviewlistdrawer: MatDrawer;
  constructor( private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"

  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
   if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
	  
      });
  }
  toggleShowDivrenewalview(divName: string) {
    if (divName === 'renewallistview') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
  showSweetAlertrenewalview() {
    swal({
      title: this.i18n('doyouanttocanc.lostmsg'),
      text: this.i18n('renewalhistorylistview.areyousurewant'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('renewalhistorylistview.cancmodal'), this.i18n('renewalhistorylistview.okmodal')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.reneviewlistdrawer.toggle();
      }
    });
    this.animationState1 = 'out';
  }
  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        console.log('page-content')
        }
    }
}
