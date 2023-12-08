import * as $ from 'jquery';
import { MediaMatcher } from '@angular/cdk/layout';
import { ChangeDetectorRef, Component, OnDestroy, AfterViewInit, ViewChild, ElementRef, Renderer2, DoCheck, EventEmitter, Output} from '@angular/core';
import { MenuItems } from '@shared/menu-items/menu-items';
import { PerfectScrollbarConfigInterface } from 'ngx-perfect-scrollbar';
import { SharedService } from '@shared/shared.service';
import { Router, NavigationEnd } from '@angular/router';
/** @title Responsive sidenav */
import {TranslateService} from '@ngx-translate/core';
import { SuperadminsidebarComponent } from './superadminsidebar/superadminsidebar.component';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import {FormGroup,FormControl, FormBuilder, Validators} from '@angular/forms';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { MatDrawer } from '@angular/material/sidenav';
import { ContactusnavComponent } from '@app/@shared/contactusnav/contactusnav.component';

@Component({
  selector: 'app-superadminlayout',
  templateUrl: './superadminlayout.component.html',
  styleUrls: []
})
export class SuperadminlayoutComponent implements OnDestroy, AfterViewInit {
  public showLoader: boolean = true;
  @ViewChild('contactusdataupdate') contactusdataupdate: ContactusnavComponent;
  mobileQuery: MediaQueryList;
  maxmobileQuery: MediaQueryList;
  maxmobileQuerytab: MediaQueryList;
  dir = 'ltr';
  green: boolean = false;
  blue: boolean = false;
  dark: boolean = false;
  minisidebar: boolean;
  horizontal: boolean = false;
  boxed: boolean = false;
  danger: boolean = false;
  showHide: boolean = false;
  sidebarOpened: any = false;
  status = false;
  public alljson: any;
  public stakeHolderType: any;
  public stakeholderChangePk: number;
  public dashboardLink='/dashboard/supplier';
  isthemeChecked = false;
  //countrylist: any = [];
  CountryMst_Pk = 31;
  myFormGroup: FormGroup;
  navlistformgroup:FormGroup;
  text: string;

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
                  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  patientCategory: FormGroup;

  @ViewChild('sdbar') sidebar: SuperadminsidebarComponent;
  @ViewChild('drawercontactus') drawercontactus: MatDrawer;
  public config: PerfectScrollbarConfigInterface = {};
  message: string;
  scrollTop: number;
  scrolstatus: boolean;
  public menustatu:boolean = false;
  public contactusData = {};
  compName: any='';
  userName: any='';
  userEmail: any='';
  public current_URL:any = '';
  public currenturlarr:any = '';
  lang = '1';
  languagetext = "عربى";
  flagid= "31";

  private _mobileQueryListener: () => void;
  @ViewChild('pageScroll') private scr: ElementRef;
  constructor(private localstorageservice: AppLocalStorageServices,changeDetectorRef: ChangeDetectorRef, public translate: TranslateService,
              private router: Router, private cookieService: CookieService,private remoteService: RemoteService,
              media: MediaMatcher, public menuItems: MenuItems,private formBuilder: FormBuilder, public shared: SharedService,private renderer: Renderer2,private fb: FormBuilder) {

    this.mobileQuery = media.matchMedia('(min-width: 768px)');
    this.maxmobileQuery = media.matchMedia('(max-width: 767px)');
    this.maxmobileQuerytab = media.matchMedia('(max-width: 1024px)');
    this._mobileQueryListener = () => changeDetectorRef.detectChanges();
    this.mobileQuery.addListener(this._mobileQueryListener);
    this.router.events.subscribe((e) => {
      if (e instanceof NavigationEnd) {
        this.scrollTo('page-content'); //Function that you want to call
        this.showLoader = false;
      }
    });
    
    this.navlistformgroup = this.formBuilder.group({
      showtooltip: false,
      text: [
        {
          value: false,
          disabled: true,
        },
      ],
    });
  
  }
  
  ngOnDestroy(): void {
    this.mobileQuery.removeListener(this._mobileQueryListener);
  }
  //currancy = new FormControl();
  currancylist = [{"curid":"1","currancyName":"OMR","currancycode":"","CountryMst_Pk":"31"},
                  {"curid":"2","currancyName":"USD","currancycode":"usd","CountryMst_Pk":"136"}];
  currancy_code_flag: number = 1;
  setcurrencyFlag(value) {              
      this.currancy_code_flag = value;    
      const now = new Date(); 
      this.cookieService.set('currancyCookie', value.curid,100,'/');     
      this.remoteService.currencyCookieValue(value);
  }
  
   menuclick(event):void{
    this.cookieService.set('menustatus',event); 
    if(this.cookieService.get('menustatus') == 'true'){
      this.menustatu = true
    }else{
      this.menustatu = false
    } 
   }  
   
   menuexpand(){
    this.menustatu = !this.menustatu;
    this.minisidebar = !this.minisidebar;
    if(this.menustatu){
      this.renderer.addClass(document.body,'menuopened'); 
    } else {
      this.renderer.removeClass(document.body,'menuopened');
    }    
   }
           
  ngOnInit() { 
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.id == '1'){
        this.languagetext = "عربى";
        this.flagid = "31";
      }else{
        this.languagetext = "English";
        this.flagid= "235";
      }

    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.id == '1'){
        this.languagetext = "عربى";
        this.flagid = "31";
      }else{
        this.languagetext = "English";
        this.flagid= "235";
      }
    }
    if(this.menustatu){
      this.renderer.addClass(document.body,'menuopened'); 
    } else {
      this.renderer.removeClass(document.body,'menuopened');
    }
   
    this.patientCategory = this.fb.group({
			patientCategory: [null, '']
		});

    if(!this.maxmobileQuery.matches){
      if(this.cookieService.get('menustatus') == 'true'){
        this.menustatu = true
      }else{
        this.menustatu = false
      }
    } else {
      if(this.cookieService.get('menustatus') == 'true'){
        this.menustatu = false;
      }else{
        this.menustatu = false;
      }
    }
    this.myFormGroup = new FormGroup({
      currancy: new FormControl('')
    })
  
     
  if( this.cookieService.get('tooltipCookie') != undefined && this.cookieService.get('tooltipCookie') != null && this.cookieService.get('tooltipCookie')=='true' ){
    this.remoteService.showtooltipCookieValue('true'); 
    this.navlistformgroup.get('showtooltip').setValue(true);
    this.navlistformgroup.get('text').setValue([{value: true,disabled: false}]);
  }
   
    this.CountryMst_Pk = 31;
    this.stakeHolderType = this.localstorageservice.getInLocal('reg_type');
    if(this.stakeHolderType==7){
      this.dashboardLink='/dashboard/operator';
    }
    this.compName = this.localstorageservice.getInLocal('companyname');
    this.userName = this.localstorageservice.getInLocal('username');
    this.userEmail = this.localstorageservice.getInLocal('username_mail');
    this.contactusData = { companyname: this.compName, username: this.userName, useremail: this.userEmail, subject:''};   
  }

  setLanguageFlag(value) { 
      this.lang =  value=='1'? '2': '1'; 
      const toSelect = this.languagelist.find(c => c.id === this.lang);
      this.cookieService.set('languageCookieId', toSelect.id);  
      this.cookieService.set('languageCode', toSelect.languagecode); 
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.remoteService.languageCookieValue(toSelect);
      console.log("this.lang",this.lang)
      if(this.lang == '1'){
        this.languagetext = "عربى";
        this.flagid = "31";
        console.log(' this.languagetext', this.languagetext) 
      }else{
        this.languagetext = "English";
        this.flagid= "235";
        console.log(' this.languagetext', this.languagetext) 
      }
      this.mediaScreenaddClass()
  }

  ngDoCheck(){
    if(document.getElementsByClassName("mat-drawer-opened").length > 0) { 
      this.renderer.addClass(document.body,'matdraweropened'); 
      //document.body.classList.add("home");     
    } else {     
      this.renderer.removeClass(document.body,'matdraweropened');
      //document.body.classList.remove("home"); 
    }
    if(this.stakeHolderType==1){
      this.renderer.addClass(document.body,'superadmin'); 
    } else {     
      this.renderer.removeClass(document.body,'superadmin');
    }
    this.current_URL =  window.location.pathname;
    this.currenturlarr = this.current_URL.split("/");
    if(this.currenturlarr[0]==='bgi.businessgateways.net'){

      if(this.currenturlarr[4] === 'skycardlandingpage' || this.currenturlarr[4]=== 'viewskycarddetail' || this.currenturlarr[4] === 'collaboratereceivedcarddetail'){
        this.renderer.addClass(document.body,'skycardlandingpage'); 
      } else {     
        this.renderer.removeClass(document.body,'skycardlandingpage');
      }

    }else{
        if(this.currenturlarr[2] === 'skycardlandingpage' || this.currenturlarr[2]=== 'viewskycarddetail' || this.currenturlarr[2] === 'collaboratereceivedcarddetail'){
          this.renderer.addClass(document.body,'skycardlandingpage'); 
        } else {     
          this.renderer.removeClass(document.body,'skycardlandingpage');
        }
    }

    if(document.getElementsByClassName("menuopened").length > 0) { 
      document.getElementById("sidmnutogglbtn").classList.add("moveicon");
    } else {
      document.getElementById("sidmnutogglbtn").classList.remove("moveicon");
    }    
  }

  ngAfterViewInit() {
    this.scrollTo('page-content'); 
    // This is for the topbar search
    ($('.srh-btn, .cl-srh-btn') as any).on('click', function() {
      ($('.app-search') as any).toggle(200);
    });
    // This is for the megamenu
  }
  onMouseenter() {
    if(document.getElementsByClassName("menuopened").length > 0 && document.getElementsByClassName("rtl").length == 0) {
      document.getElementById("maincontnr").classList.add("matsidenavcontnrhovr");
    }
    if(document.getElementsByClassName("menuopened").length > 0 && document.getElementsByClassName("rtl").length == 1) {
      document.getElementById("maincontnr").classList.add("matsidenavcontnrhovrrtl");
    }
  }
  onMouseleave() {
    if(document.getElementsByClassName("menuopened").length > 0 && document.getElementsByClassName("rtl").length == 0) {
      document.getElementById("maincontnr").classList.remove("matsidenavcontnrhovr");
    }
    if(document.getElementsByClassName("menuopened").length > 0 && document.getElementsByClassName("rtl").length == 1) {
      document.getElementById("maincontnr").classList.remove("matsidenavcontnrhovrrtl");
    }
  }

  // Mini sidebar
 /*  pageonScroll(e: Event) {
      // this.scrollTop = e.srcElement.scrollTop;
      if (this.scrollTop > 100) {
        this.scrolstatus = true;
      } else {
        this.scrolstatus = false;
      }
      // setTimeout(() => { this.scrolling = false;}, this.scrollTimeout);

  } */
  public isShowBtnScrollTop: boolean;
  pageonScroll(event: any) {
    // visible height + pixel scrolled >= total height 
    if (event.target.scrollTop <= 1) {
      this.isShowBtnScrollTop = false;
    } else {
      this.isShowBtnScrollTop = true; 
    }
    
  }
  public showshadow:boolean = false;
  pageonperfectScroll(event: any) { 
    if (event.target.scrollTop <= 1) {
      this.showshadow = false;
    } else { 
      this.showshadow = true;     
    }
    
  }
  
  public scrollTo(className: string): void {
    try {      
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {
     }
  }
  /* getstakeholderDropDownPk(event: any) {
    this.sidebar.getMenuitem();
  } */

  onChange(showtooltip: boolean) {
    const field = this.navlistformgroup.get('text');

    if (showtooltip) {
      field.enable();
    } else {
      field.disable();
    }
    this.updateText();
     

    
}
private updateText() {

  this.text = this.navlistformgroup.value.showtooltip ? 'true' : 'false';
 
    this.cookieService.set('tooltipCookie',this.text ,100,'/');     
    this.remoteService.showtooltipCookieValue(this.text);
  }

  clickEvent(): void {
    this.status = !this.status;
  }

  darkClick() {
    const body = document.getElementsByTagName('body')[0];
    body.classList.toggle('dark');
  }

  parentFun(drawercontactus){
    //alert("parent component function.");
    drawercontactus.toggle();
    this.contactusdataupdate.contactsubjectenabled();
  }
  mediaScreenaddClass() {
    
  }

}
