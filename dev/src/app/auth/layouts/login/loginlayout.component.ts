import { Component, OnInit } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import {FormGroup,FormControl,FormBuilder} from '@angular/forms';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
@Component({
  selector: 'app-loginlayout',
  templateUrl: './loginlayout.component.html',
  styleUrls: ['./loginlayout.component.scss']
})
export class LoginlayoutComponent implements OnInit {
  currentlink = 'https://bgi.businessgateways.net/jsrs';
  animationState1 = 'out';
  animationState2 = 'out';
  animationState3 = 'out';
  animationState4 = 'out';
  CountryMst_Pk = 31;
  public visitor:string = "VISITORS";
  public visitorcount:string = '3,983,915';
  public som:string = 'Sultanate of Oman';
  public hotline:string = 'Hotline';
  public hotlinenumber:string = '+968 24166123';
  public support:string = 'Support';
  public supportnumber:string = '+968 52451256';

  constructor(private translate: TranslateService,private cookieService: CookieService,private fb: FormBuilder,private remoteService: RemoteService,) { 
    //this.translate.setDefaultLang('en'); 
    
    //this.translate.use(this.cookieService.get('languageCode') || 'en');
    //const browserLang = translate.getBrowserLang();
    //translate.use(browserLang.match(/en|/ar)? browserLang :  'en');
  }

  

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
                  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  myFormGroup: FormGroup;
  patientCategory: FormGroup;
  dir = 'ltr';

  ngOnInit() {
    this.patientCategory = this.fb.group({
			patientCategory: [null, '']
		});
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
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
  
  setLanguageFlag(value) {           
    this.cookieService.set('languageCookieId', value.id);  
    this.cookieService.set('languageCode', value.languagecode); 
    this.translate.setDefaultLang(value.languagecode);
    this.dir = value.dir;
}

  useLanguage(language: string) {
    this.translate.use(language);
  }
  toggleShowDiv(divName: string) {
    if (divName === 'platformdropdown') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
      this.animationState4 = 'out';
    }
  }
  toggleview(divName: string) {
    if (divName === 'toggleaboutview') {
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
  }
  viewmedia(divName: string) {
    if (divName === 'viewevent') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
    }
  }
  Aboutusdata(divName: string) {
    if (divName === 'aboutuslist') {
      this.animationState4 = this.animationState4 === 'out' ? 'in' : 'out';
      this.animationState1 = 'out';
    }
  }
}
