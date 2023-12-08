import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Router, NavigationEnd, ActivatedRoute, Data, Params } from '@angular/router';
import { filter, map, mergeMap } from 'rxjs/operators';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Location } from '@angular/common';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { environment } from '@env/environment';

@Component({
  selector: 'app-breadcrumb',
  templateUrl: './breadcrumb.component.html',
  styleUrls: [],
  encapsulation: ViewEncapsulation.None
})
export class AppBreadcrumbComponent implements OnInit {
  // @Input() layout;
  // public paymentbreadcrumb: boolean = true;
  data: any;
  @Input('paymentbreadcrumb') paymentbreadcrumb: boolean = false;
  pageInfo: Data = Object.create(null);
  paramId:string = null;
  prepageInfo = [];
  parampage: any;
  parampagetype: any;
  paymentpages = true;
  homeicon = true;
  pkvalue: any;
  stvalue: any;
  stktypebc: any='';
  focalpoint: any;
 bookId: any = '';
 coursePk: any = '';
  apptempPk: any;
  type: any;
  approval: string;
  projectpk: string;
  desktopreview = false;
  paymentview = false;
  siteaudit = false;
  // baseurl = environment?.baseUrlbeadcrumb;
  partAfterFourthSlash: string;
  urlstashandquesionmark: string;
  gobackinbread: boolean = true;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private router: Router,
  
    private activatedRoute: ActivatedRoute,private _location: Location,
    private titleService: Title,private security: Encrypt, private localStorages: AppLocalStorageServices
  ) {
    this.activatedRoute.queryParams
    .subscribe(params => {
      this.parampage = params.bc,
      this.pkvalue = this.security.decrypt(params.p),
      this.stvalue = this.security.decrypt(params.s),
      this.parampagetype = params.type; 
      this.focalpoint = this.localStorages.getInLocal("isadmin");
      const url = window.location.href;
      const lastSlashIndex = url.lastIndexOf('/');
      const firstQuestionMarkIndex = url.indexOf('?');

      console.log('lastSlashIndex', lastSlashIndex);
      console.log('firstQuestionMarkIndex', firstQuestionMarkIndex);
      
      if (lastSlashIndex !== -1 && firstQuestionMarkIndex !== -1) {
        var extractedText = url.substring(lastSlashIndex + 1, firstQuestionMarkIndex);
        console.log('extractedText', extractedText);
        this.urlstashandquesionmark = extractedText;
      }
      if(extractedText == 'siteaudit' || extractedText == 'rassiteaudit' || extractedText == 'rassiteauditview'){
      if(params.id){
        // alert(1)
        localStorage.setItem('siteauditid',params.id);
        localStorage.setItem('siteauditview',params.view);
      }
      }
      if(extractedText == 'desktopreview'){
      if(params.id){
        localStorage.setItem('desktopid',params.id);
      }
      }
      if(extractedText == 'invoice' || extractedText == 'details' || extractedText == 'rasdetails'){
        if(params.id){
          localStorage.setItem('paymentid',params.id);
        }
        }
      if(params.app_ref_id){
        localStorage.setItem('app_ref_id',params.app_ref_id);
      }
      if(params.view){
        localStorage.setItem('view',params.view);
      }
      if(params.type){
        localStorage.setItem('type',params.type);
      }

    }
  );
 
    this.router.events
      .pipe(filter((event) => event instanceof NavigationEnd))
      .pipe(map(() => this.activatedRoute))
      .pipe(map((route) => {this.paramId = this.security.decrypt(route.queryParams['_value'].id);
      
          while (route.firstChild) {
            route = route.firstChild;
          }
          return route;
        }),
      )
      .pipe(filter((route) => route.outlet === 'primary'))
      .pipe(mergeMap((route) => route.data))
      .subscribe((event) => {
        this.prepageInfo = [];
        this.titleService.setTitle(event['title']);
        this.pageInfo.title;
        this.pageInfo = event;
        console.log(event)
        console.log('+++++++++++++++++++++++')
        const url = window.location.href;
        const parts = url.split('/');
        if (parts) {
            this.partAfterFourthSlash = parts[7];        
        }
        if(this.urlstashandquesionmark == 'maincentre' || this.partAfterFourthSlash == 'maincentre' || this.urlstashandquesionmark == 'branchcentre' || this.partAfterFourthSlash == 'branchcentre' || this.urlstashandquesionmark == 'rascentre' || this.partAfterFourthSlash == 'rascentre' || this.partAfterFourthSlash == 'rasbranchcentre' || this.urlstashandquesionmark == 'rasbranchcentre' || this.urlstashandquesionmark == 'home'){
            this.gobackinbread = false;
        }else{
            this.gobackinbread = true;
        }
        // alert(partAfterFourthSlash)
        if(this.urlstashandquesionmark == 'maincentre' || this.partAfterFourthSlash == 'maincentre' || this.urlstashandquesionmark == 'branchcentre' || this.partAfterFourthSlash == 'branchcentre' || this.urlstashandquesionmark == 'rascentre' || this.partAfterFourthSlash == 'rascentre' || this.partAfterFourthSlash == 'rasbranchcentre' || this.urlstashandquesionmark == 'rasbranchcentre' || this.urlstashandquesionmark == 'home'){
          this.remoteService.getbreadcrumCookie().subscribe(data => {
            console.log('---****-----')
            console.log(data)
            this.pageInfo  = data;
            console.log('---****-----')
          });

        }
        this.activatedRoute.firstChild?.firstChild?.paramMap.subscribe(
          (params: Params) => {
          console.log(params.params)
          console.log('partAfterFourthSlash', this.partAfterFourthSlash)
        if(this.partAfterFourthSlash == 'rasdesktopreview' || this.partAfterFourthSlash == 'desktopreview'){ 
          localStorage.setItem('apptempPk_bread',params.params.id);
          localStorage.setItem('type_bread',params.params.type);
          localStorage.setItem('approval_bread',params.params.approval);
          localStorage.setItem('projectpk_bread',params.params.projectpk); 
          localStorage.setItem('siteauditid','null'); 

          }
          if(this.partAfterFourthSlash == 'courseviewras' || this.partAfterFourthSlash == 'courseviewrassite'){ 
            localStorage.setItem('param1',params.params.id);
            localStorage.setItem('param2',params.params.type);
            localStorage.setItem('param3',params.params.viewtype);
            localStorage.setItem('param4',params.params.assessmenttype); 
            localStorage.setItem('param5',params.params.fromview); 

          }
          if(this.partAfterFourthSlash == 'viewcourse'){
            localStorage.setItem('stdcourseid',params.params.id);
          }
          
           
         
          }
        );
  console.log('apppk',this.projectpk)
          for (let i = 0; i < this.pageInfo.urls.length; i++) {
            console.log('url',this.pageInfo.urls[i].url)
            if (this.pageInfo.urls[i].url === '/centrecertification/desktopreview') {
              var pk = this.security.decrypt(localStorage.getItem("projectpk_bread"));
              if(pk == '4'){
              var datatype = '/centrecertification/rasdesktopreview/'+ localStorage.getItem("apptempPk_bread")+'/'+localStorage.getItem("type_bread")+'/'+localStorage.getItem("approval_bread")+'/'+localStorage.getItem("projectpk_bread") ;
              }else{
                var datatype = '/centrecertification/desktopreview/'+ localStorage.getItem("apptempPk_bread")+'/'+localStorage.getItem("type_bread")+'/'+localStorage.getItem("approval_bread")+'/'+localStorage.getItem("projectpk_bread") ;
              }
              this.pageInfo.urls[i].url = datatype;   
            }
            if(this.pageInfo.urls[i].url == '/standardcourseconfiguration/viewcourse'){
              this.pageInfo.urls[i].url = '/standardcourseconfiguration/viewcourse/'+localStorage.getItem("stdcourseid");  
            }
            if (this.pageInfo.urls[i].url === '/standardcourseapproval/desktopreview') {
              if(localStorage.getItem("view") && localStorage.getItem("view") != 'null'){
                var datatype1 = '/standardcourseapproval/desktopreview?id='+ localStorage.getItem("desktopid")+'&app_ref_id='+localStorage.getItem("app_ref_id")+'&view='+localStorage.getItem("view")+'&type='+localStorage.getItem("type") ;
              }else{
                var datatype1 = '/standardcourseapproval/desktopreview?id='+ localStorage.getItem("desktopid")+'&app_ref_id='+localStorage.getItem("app_ref_id") ;
              }
              this.pageInfo.urls[i].url = datatype1;   
            }
            if(this.pageInfo.urls[i].title === 'RAS Technical Evaluation Centre Approval'){
              const url = '/centrecertification/rashome/'+this.security.encrypt(4);
              this.pageInfo.urls[i].url = url;
            } 
            if(this.pageInfo.urls[i].title === 'Training Evaluation Centre Approval'){
              const url = '/centrecertification/home/'+this.security.encrypt(1);
              this.pageInfo.urls[i].url = url;
            } 
            if(this.pageInfo.urls[i].title === 'Staff View'){
              const urlview = '/trainingcentremanagement/courseviewras/'+ localStorage.getItem("param1")+'/'+localStorage.getItem("param2")+'/'+localStorage.getItem("param3")+'/'+localStorage.getItem("param4")+'/'+localStorage.getItem("param5") ;
              this.pageInfo.urls[i].url = urlview;
            } 
            if(this.pageInfo.urls[i].title === 'View Invoice' || this.pageInfo.urls[i].title === 'View Payment Details'){
              const urlview = this.pageInfo.urls[i].url+'?id='+localStorage.getItem("paymentid") ;
              this.pageInfo.urls[i].url = urlview;
            }
            if(this.pageInfo.urls[i].title === 'View Site Audit Report'){
              var pk = this.security.decrypt(localStorage.getItem("projectpk_bread"));
              if(pk == '4'){
              if(localStorage.getItem("siteauditview")){
                var urlview = '/standardcourseapproval/rassiteaudit?id='+ localStorage.getItem("siteauditid")+'&view='+localStorage.getItem("siteauditview");
              }else{
                var urlview = '/standardcourseapproval/rassiteaudit?id='+ localStorage.getItem("siteauditid");
              }
            }else{
              if(localStorage.getItem("siteauditview")){
                var urlview = '/standardcourseapproval/siteaudit?id='+ localStorage.getItem("siteauditid")+'&view='+localStorage.getItem("siteauditview");
              }else{
                var urlview = '/standardcourseapproval/siteaudit?id='+ localStorage.getItem("siteauditid");
              }
            }
              this.pageInfo.urls[i].url = urlview;
            }  
          } 
          for (let i = 0; i < this.pageInfo.urls.length; i++) {
                if(localStorage.getItem("siteauditid") && localStorage.getItem("siteauditid") != 'null'){
                  if(this.pageInfo.urls[i].title === 'RAS Technical Evaluation Centre Approval'){
                    var projpk = 4;
                  } else if('Training Evaluation Centre Approval'){
                    var projpk = 1;
                  }
                  // alert(projpk)   

                  if(projpk == 1 || projpk == 4){
                  if (this.pageInfo.urls[i].title === 'View Certification Form') {
                    this.pageInfo.urls[i].title = 'View Site Audit Report'
                    if(localStorage.getItem("siteauditview")){
                      var urlview = '/standardcourseapproval/rassiteaudit?id='+ localStorage.getItem("siteauditid")+'&view='+localStorage.getItem("siteauditview");
                    }else{
                      var urlview = '/standardcourseapproval/rassiteaudit?id='+ localStorage.getItem("siteauditid");
                    }                 
                    this.pageInfo.urls[i].url = urlview;  
                    this.pageInfo.urls[i].href = 'true';  

                   }
                }
                }
          }
        if((this.paramId=='2' || this.paramId=='3') && this.pageInfo?.urls && this.pageInfo.urls.length==1 && this.pageInfo.urls[0].url == '/centrecertification/schedulesiteaudit' && ( this.pageInfo.title=='Configure Site Audit Date - Customized Course' || this.pageInfo.title=='Schedule Site Audit' || this.pageInfo.title=='Configure Site Audit Date - Standard Course')){
          this.pageInfo.title =  this.paramId=='2' ? 'Configure Site Audit Date - Standard Course' : 'Configure Site Audit Date - Customized Course';
          this.prepageInfo.push({url:'/standardcourseapproval/approvaldetails',title: 'Standard & Customized Course Approval'});
          this.titleService.setTitle(this.paramId=='2' ? 'Configure Site Audit Date - Standard Course' : 'Configure Site Audit Date - Customized Course');
        }
        else if(this.paramId=='1'&& this.pageInfo?.urls && this.pageInfo.urls.length==1 && this.pageInfo.urls[0].url == '/centrecertification/schedulesiteaudit' && this.pageInfo.title=='Schedule Site Audit'){
      
          this.prepageInfo.push({url:'/centrecertification/home',title: 'Training Evaluation Centre Approval'});
       
      //  }else if(this.parampage == 'spym' && this.pkvalue == 2 ) {
      //   this.pageInfo.title = 'Standard  Course Certification - Payment'
      //   }else if(this.parampage == 'spym' && this.pkvalue == 3 ) {
      //     this.pageInfo.title = 'Customized  Course Certification - Payment'
      //     }
        }
        else if(this.parampage == 'spym' && this.pkvalue == 2 && (this.stvalue == 5 || this.stvalue == 6 )) {
          this.pageInfo.title = 'Standard Course Certification - Payment'
          this.prepageInfo.push({url:'/standardcourse/home',title: 'Standard Course Certification'});
        }
        else if(this.parampage == 'spym' && this.pkvalue == 2 && (this.stvalue == 7|| this.stvalue == 8 || this.stvalue == 9) ) {
          this.pageInfo.title = 'Standard Course Certification - Audit Date Selection'
          this.prepageInfo.push({url:'/standardcourse/home',title: 'Standard Course Certification'});
        }
        else if(this.parampage == 'spym' && this.pkvalue == 3 && (this.stvalue == 5 || this.stvalue == 6 )) {
          this.pageInfo.title = 'Customized Course Certification - Payment'
          this.prepageInfo.push({url:'/standardcourse/home',title: 'Customized Course Certification'});
        }
        else if(this.parampage == 'spym' && this.pkvalue == 3 && (this.stvalue == 7|| this.stvalue == 8 || this.stvalue == 9)) {
          this.pageInfo.title = 'Customized Course Certification - Audit Date Selection'
          this.prepageInfo.push({url:'/standardcourse/home',title: 'Customized Course Certification'});
        }
        else if(this.parampage == 'stpym') {
          this.pageInfo.title = 'Standard & Customized Course Certification'
        }
        // pk = 1
        else if(this.parampage == 'tcm') {
          this.pageInfo.title = 'Training Centre Certification Form (Main Office)'
        }else if(this.parampage == 'paycnt' && this.pkvalue == 1 && (this.stvalue == 5 || this.stvalue == 6 || this.stvalue == 18) ) {
          this.pageInfo.title = 'Training Evaluation Centre Certification - Payment'
        }
        else if(this.parampage == 'tnbc' && this.pkvalue == 1 && (this.stvalue == 5 || this.stvalue == 6 || this.stvalue == 18)) {
          this.pageInfo.title = 'Training Centre Certification - Payment'
          this.prepageInfo.push({url:'/trainingcentremanagement/branchcentre',title: 'Training Centre Certification'});

        }
        else if(this.parampage == 'paycnt' && this.pkvalue == 1 && (this.stvalue == 7|| this.stvalue == 8 || this.stvalue == 9)) {
          this.pageInfo.title = 'Training Evaluation Centre Certification - Audit Date Selection'
        }
        else if(this.parampage == 'tnbc' && this.pkvalue == 1 && (this.stvalue == 7|| this.stvalue == 8 || this.stvalue == 9) ) {
          this.pageInfo.title = 'Training Centre Certification - Audit Date Selection'
          this.prepageInfo.push({url:'/trainingcentremanagement/branchcentre',title: 'Training Centre Certification'});

        }
        // pk = 4
        else if(this.parampage == 'tcm') {
          this.pageInfo.title = 'RAS Inspection Centre Certification Form (Primary Office Certification)'
        }else if(this.parampage == 'paycnt' && this.pkvalue == 4 && (this.stvalue == 5 || this.stvalue == 6 || this.stvalue == 18) ) {
          this.pageInfo.title = 'RAS Inspection Centre Certification Form - Payment'
        }
        else if(this.parampage == 'tnbc' && this.pkvalue == 4 && (this.stvalue == 5 || this.stvalue == 6 || this.stvalue == 18)) {
          this.pageInfo.title = 'RAS Inspection Centre Certification Form - Payment'
          this.prepageInfo.push({url:'//trainingcentremanagement/rasbranchcentre',title: 'RAS Inspection Centre Certification Form'});

        }
        else if(this.parampage == 'paycnt' && this.pkvalue == 4 && (this.stvalue == 7|| this.stvalue == 8 || this.stvalue == 9)) {
          this.pageInfo.title = 'RAS Inspection Centre Certification Form - Audit Date Selection'
        }
        else if(this.parampage == 'tnbc' && this.pkvalue == 4 && (this.stvalue == 7|| this.stvalue == 8 || this.stvalue == 9) ) {
          this.pageInfo.title = 'RAS Inspection Centre Certification Form - Audit Date Selection'
          this.prepageInfo.push({url:'//trainingcentremanagement/rasbranchcentre',title: 'RAS Inspection Centre Certification Form'});

        }
        // end
        else if(this.parampagetype == 'MQ=='){
          this.pageInfo.title = 'Manage Roles'
        }else if(this.parampagetype == 'Mg=='){
          this.pageInfo.title = 'Manage Users'
        }else if(this.parampagetype == 'MQ=='){
          this.pageInfo.title = 'Manage Users'
        }
        // Staff Tech booking route
        // console.log('pageInfo?.urls', this.pageInfo);
        if(localStorage.getItem('civil')){
          this.bookId = localStorage.getItem('civil')
          this.coursePk = localStorage.getItem('course')
          

          // localStorage.removeItem('civil');
        }
        // console.log('this.pageInfo?.urls[1]?.url updated', this.pageInfo?.urls[1]?.url);
      });
      this.stktypebc = this.localStorages.getInLocal('stktype');
  }
  // Breadcurmb back
  
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  ngOnInit() {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });    


   
   
    
  }goback() {
    this._location.back();
  }
  gobackhideandshow(){
    var lastValue =this.pageInfo.urls[this.pageInfo.urls.length - 1];

      // Get the previous value
      if (this.pageInfo.urls.length > 1) {
          var previousValue = this.pageInfo.urls[this.pageInfo.urls.length - 2];
          if(previousValue.page){
            this.breadcurumfrontend(previousValue.page);
          }
          console.log("Previous Value:", previousValue);
      } else {
          console.log("There is no previous value.");
      }
  }
  tabRedirect(event){
    if(event.title=="Technical Inspection Centre" || event.title=="Technical Installaion Centre"){
      localStorage.setItem("tab-switch",event.title)
    }
    
    this.router.navigate(event.url)
  }

  breadcurumfrontend(page){
    // branch center component

    if((this.partAfterFourthSlash == 'branchcentre' || this.urlstashandquesionmark == 'branchcentre' || this.partAfterFourthSlash == 'rasbranchcentre' || this.urlstashandquesionmark == 'rasbranchcentre') && (this.urlstashandquesionmark != 'home')){
      if(page == 1){
        if(this.partAfterFourthSlash == 'branchcentre' || this.urlstashandquesionmark == 'branchcentre'){
        var breadCrumb ={
      
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          ]
        
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);

    }else{
      const breadCrumb ={
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: '/trainingcentremanagement/rasbranchcentre' ,last:'true' }
        ]
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);

    }
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 2){
        const breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
            { title: 'View Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
          ] 
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 3){
        const breadCrumb ={
          title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
            urls: [
              { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: '/trainingcentremanagement/rasbranchcentre',page:1 },
              { title: 'Certification Form ', url: '/trainingcentremanagement/rasbranchcentre'+this.security.encrypt(4),last:'true' },
            ]
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      // ras branch
      if(page == 4){
        const breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
            { title: 'View Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
          ] 
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
    }
    // main center component
  if((this.partAfterFourthSlash == 'maincentre' || this.urlstashandquesionmark == 'maincentre' || this.partAfterFourthSlash == 'rascentre' || this.urlstashandquesionmark == 'rascentre') && (this.urlstashandquesionmark != 'home')){
      if(page == 1){
        var breadCrumb ={
      
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification Form (Main Office)', url: '/trainingcentremanagement/maincentre/'+this.security.encrypt(1) ,page:1},
          ]
        
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 2){
        const breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification Form (Main Office)', url: '/trainingcentremanagement/maincentre/'+this.security.encrypt(1) ,page:1},
            { title: 'View Certification Form ', url: '/trainingcentremanagement/maincentre'+this.security.encrypt(1),last:'true' }
          ] 
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 3){
        const breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification Form (Main Office)', url: '/trainingcentremanagement/maincentre/'+this.security.encrypt(1) ,page:1},
            { title: 'View Certification Form ', url: '/trainingcentremanagement/maincentre'+this.security.encrypt(1),last:'true' }
          ] 
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 4){
        const breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification Form (Main Office)', url: '/trainingcentremanagement/maincentre/'+this.security.encrypt(1) ,page:1},
            { title: 'View Certification Form ', url: '/trainingcentremanagement/maincentre'+this.security.encrypt(1),last:'true' }
          ] 
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 5){
        const breadCrumb ={
          title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
          urls: [
            { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: '/trainingcentremanagement/rasbranchcentre' ,last:'true' }
          ]   
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);
      }
      if(page == 6){
        this.remoteService.breadcrumCookieValueoutput(page);
      }
  }
  //course
  if(this.urlstashandquesionmark == 'home'){
    if(page == 1){
      var breadCrumb ={
    
        title: 'Standard & Customized Course Certification',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
        ]
      
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);
    this.remoteService.breadcrumCookieValueoutput(page);
    }
    if(page == 2){
      const breadCrumb ={
    
        title: 'Certification Form ',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          { title: 'Certification Form ', url: '/trainingcentremanagement/maincentre'+this.security.encrypt(1),last:'true' }

        ]
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);

    }
    if(page == 3){
      const breadCrumb ={
    
        title: 'Certification Form ',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          { title: 'Certification Form ', url: '/trainingcentremanagement/maincentre'+this.security.encrypt(1),last:'true' }

        ]
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);

    }
    if(page == 4){
      const breadCrumb ={
    
        title: 'Certification Form ',
        urls: [
          { title: 'Standard & Customized Course Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          { title: 'Certification Form ', url: '/trainingcentremanagement/maincentre'+this.security.encrypt(1),last:'true' }

        ]
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);
      this.remoteService.breadcrumCookieValueoutput(page);

    }


  }

    
  }

}
