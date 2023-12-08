import { Component, OnInit, ViewChild, ChangeDetectorRef, OnDestroy, ɵbypassSanitizationTrustStyle, ViewEncapsulation, Output } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { CorporateregComponent } from '../corporatereg/corporatereg.component';
import { Subject } from 'rxjs/Subject';
import { ActivatedRoute } from '@angular/router';
import { OwlOptions } from 'ngx-owl-carousel-o';

import swal from 'sweetalert';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { RegistrationService } from '../registration.service';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registerwithlypis',
  templateUrl: './registerwithlypis.component.html',
  styleUrls: ['./registerwithlypis.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class RegisterwithlypisComponent implements OnInit, OnDestroy {
  scrollTop: number;
  currentyear: number = new Date().getFullYear();
  animationState = 'out';
  externalProfile = "home";
  stkpk: any = 15;
  paymentdisable: boolean = true;
  showHide() {}
  breadcrums = [
    {
        'url': '/registration/index', 'params': 'Home', 'label': 'Registration'
    }
];
  isShowHideFlag = "over";
  customOptions: OwlOptions = {
    loop: true,
    autoplay:true,
    autoplayTimeout:10000,
    autoplayHoverPause:true,
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    center: true,
    margin: 10,
    autoWidth: false,
    items:1,
    dots: true,
    navSpeed: 1000,
    nav: false
  }
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];

  //variables
  stakeholderType: FormControl = new FormControl('1', Validators.required);
  startRegistrationCliked: boolean = false;
  public countrylist: any = [];
  userGeoDialCode: string = '';
  userGeoCountryPk: number;
  destroy$: Subject<boolean> = new Subject<boolean>();
  userIPcountryName: string;
  removeGoBack: boolean = false;
  @ViewChild('corporatereg') corporatereg: CorporateregComponent;
  deptlist: any = [];
  sectorlist: any = [];
  rightSideCardCounts: any = [];
  showLoader: boolean = true;
  public companyinfocert: boolean = false;
  public reglandingpage: boolean = true;
  public mattab: any = 0;
  public stk: any = 6;
  public ifarabic: boolean = true;
  paymenttab: any;
  constructor(private profileService: ProfileService,
    private route: ActivatedRoute,
    private router: Router,
    private enterpriseService: EnterpriseService,
    private regService: RegistrationService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    ) { }
   dir="ltr";
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en')
      {
        this.ifarabic = false;
      }
         else
         {
          this.ifarabic = true;
        }
    
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en')
      {
        this.ifarabic = false;
      }
         else
         {
          this.ifarabic = true;
        }
    
    }
   
    
    this.remoteService.getLanguageCookie().subscribe(data => {
      if(data.languagecode == 'ar')
      this.ifarabic = true;
      else
      this.ifarabic = false;
      
    });

    this.getCountryList();
    this.logOut();
    setTimeout(() => {
      this.route.queryParams.subscribe(params => {
        this.paymenttab = (params['tab'] == 'payment') ? true : false;
        this.stk = params['stk'];
      });
      if (this.paymenttab) {        
        this.mattab = 2;
        this.paymentdisable = false;
        this.remoteService.setstakeholdertypereg(this.stk,this.regtype);
        this.companyinfocert = true;
        this.reglandingpage = false;
      }
    }, 1000);
  }
  regtype(stk: any, regtype: any) {
    throw new Error('Method not implemented.');
  }
  changestk(value)
  {
    this.stkpk = value ;
  }
  logOut() {
    if (localStorage.getItem('v3logindata') !== null) {
      this.profileService.logout().takeUntil(this.destroy$).subscribe(data => {
        localStorage.removeItem('v3logindata');
        localStorage.removeItem('v3logindatarefresh');
      })
    }
  }
  toggleShowDiv(divName: string) {
    if (divName === 'aboutusdropitems') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  getCountryList() {
    this.profileService.getcountrylist('oman').subscribe(data => this.countrylist = data.data);
  }
  

  getIP() {
    this.route.snapshot.data['data']['userIP'].takeUntil(this.destroy$).subscribe(data => {
      this.userGeoDialCode = data['country_calling_code'];
     
      this.userIPcountryName = this.countrylist[0]['CyM_CountryName_en'];
      let countrydtl = this.countrylist.filter(x => x.dialcode == this.userGeoDialCode);
      this.userGeoCountryPk = countrydtl[0]['CountryMst_Pk'];
    },(error) => console.log(error),
    () => {
      this.showLoader = false;
      this.getRightSideCardCounts();
      this.getSectorList();
      this.getDeptList();
    });
  }

  backToHome() {
    if (this.corporatereg) {
      this.corporatereg.cancelAction();
    }
  }

  ngOnDestroy(): void {
    this.destroy$.next(true);
    this.destroy$.unsubscribe();
  }

  tabChange(event) {
    this.stakeholderType.setValue('1');
    if (event.index == 1) {
      this.stakeholderType.setValue('3');
    }
  }

  disableAndEnableRegButton(event) {
    if (event) {
      this.startRegistrationCliked = false;
    }
  }

  selectedStakeholder(stakeholderTypeSelected: any) {
    this.stakeholderType.setValue(stakeholderTypeSelected);
      this.startRegistrationCliked = true;
      window.scroll(0, 0);
  }
  goback(event)
  {
    this.removeGoBack = event;
    window.scroll(0, 0);
  }

  getSectorList() {
    this.profileService.getsectorlist('P')
    .takeUntil(this.destroy$).subscribe(data => {
      this.sectorlist = data['data'].items
    })
  }

  getRightSideCardCounts() {
    this.regService.getrightsidecardcounts()
    .takeUntil(this.destroy$).subscribe(data => {
      this.rightSideCardCounts = data['data']
    })
  }

  getDeptList() {
    this.enterpriseService.getDefaultDeptList()
    .takeUntil(this.destroy$).subscribe(data => this.deptlist = data['data'].items)
  }
  public isShowBtnScrollTop: boolean;
  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        console.log('page-content')
        }
    }
  pageonScroll(event: any) {
    // visible height + pixel scrolled >= total height       
    if (event.target.scrollTop <= 1) {
      this.isShowBtnScrollTop = false;
    } else {
      this.isShowBtnScrollTop = true;
    }
  }
  compcertpaydata(stk,regtype){
      this.remoteService.setstakeholdertypereg(stk,regtype);
      this.companyinfocert = true;
      this.reglandingpage = false;
  }

  reglandingpagedata(event){
    this.reglandingpage = event;
  }

  certifyhidedata(event){
    this.companyinfocert = event;
  }
  lang = '1';
  setLanguageFlag(value) {  
    this.lang =  value=='1'? '2': '1'; 
    const toSelect = this.languagelist.find(c => c.id === this.lang);
    this.cookieService.set('languageCookieId', toSelect.id);  
    this.cookieService.set('languageCode', toSelect.languagecode); 
    this.cookieService.set('dir', toSelect.dir); 
    this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    this.remoteService.languageCookieValue(toSelect);
}
}
