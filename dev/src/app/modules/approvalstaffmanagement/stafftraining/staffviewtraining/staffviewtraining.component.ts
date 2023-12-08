import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Location } from '@angular/common';
import { TrainingStaffService } from '@app/services/trainingStaff.service';
import { environment } from '@env/environment';

@Component({
  selector: 'app-staffviewtraining',
  templateUrl: './staffviewtraining.component.html',
  styleUrls: ['./staffviewtraining.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class StaffviewtrainingComponent implements OnInit {
  civil_number: any;
  coursePk: any;
  edulimit: number = 5;
  worklimit: number = 5;
  staffinforepo_pk:any;
  viewStaffResponse: any;
  workData: any;
  educationData: any;
  ifarbic: boolean = false;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;

  i18n(key) {
    return this.translate.instant(key);
  }
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginatortwo") paginatortwo: MatPaginator;

  public fullPageLoaders: boolean = false;
  public page: number = 10;
  public eduresultLength: any = 0;
  public workresultLength: any = 0;
  public dffValues: string;
  public commonAvailabilty:boolean = false;
  public showPersonalInfo: boolean = true;
  public receivedValue: any;
  public showHide: string = 'Show Course Information'
  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,

    private translate: TranslateService,
    private remoteService: RemoteService,
    private trainingstaff: TrainingStaffService, 
    private activeRoute: ActivatedRoute,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService,
    protected security: Encrypt, private _location:Location,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  ngOnInit(): void {
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    console.log(this.useraccess,'this.useraccess');
     this.stktype = this.localstorage.getInLocal('stktype');
     this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
     let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Staff Management');
    console.log(this.stktype,'moduleid');
 
     if (this.isfocalpoint == 1) {
       this.downloadaccess = true;
       this.readaccess = true;
       this.createaccess = true;
       this.updateaccess = true;
       this.deleteaccess = true;
     }
     let submodule = this.stktype == 1 ? 32 : 38 ;
 
     if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y') {
         this.downloadaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y') {
         this.readaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].create == 'Y') {
         this.createaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].update == 'Y') {
         this.updateaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].delete == 'Y') {
         this.deleteaccess = true;
       }
     }
    console.log(this.readaccess+'readaccess'); 
    
    if (this.readaccess == false) {
       swal({
         title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
         text: '',
         icon: 'warning',
         buttons: [false, this.i18n('Ok')],
         dangerMode: true,
         className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
         closeOnClickOutside: false
       }).then((willGoBack) => {
         if (willGoBack) {
           this.router.navigate(['/dashboard/portaladmin'])
         }
       });
     }
    this.fullPageLoaders = true;
    this.activeRoute.queryParamMap.subscribe((data: any) => {
      this.civil_number = data.get("id");
      this.coursePk = data.get("course");
    });
    this.getDataViaCivil();

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
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
    });
    this.getLocalstorageValue()

  }
  
  assessorlocate(Governate,Wilayat){
    if(Governate == null){
      return [];
    }
    Governate = Governate.split(',');
    Wilayat = Wilayat.split(',');
    let result = Governate.map((val, key) => { 
      
        return {
          Governate: val,
          Wilayat: Wilayat[key] ? Wilayat[key] : null,
        };
    });

    return result
  };
  education = [];
  workexperience = [];
 
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.paginator.length = this.eduresultLength
    this.educationApi(this.staffinforepo_pk,this.paginator.pageSize,this.paginator.pageIndex)

  }

  workPaginator(event: PageEvent) {
    this.paginatortwo.pageIndex = event.pageIndex;
    this.paginatortwo.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.paginatortwo.length = this.workresultLength
    this.workApi(this.staffinforepo_pk,this.paginatortwo.pageSize,this.paginatortwo.pageIndex)
  }
  backBtn() {
    this._location.back();
  }
  getLocalstorageValue() {
    this.dffValues = localStorage.getItem('typeView')
    if(this.dffValues == 'viewstaff') {
      this.commonAvailabilty = false;
    }else if(this.dffValues == 'viewStaff') {
      this.commonAvailabilty = false;
    }else if(this.dffValues == 'viewAvailabilty'){
      this.commonAvailabilty = true;
      this.showPersonalInfo = false;
    }else if(this.dffValues == 'viewSchedule'){
      this.commonAvailabilty = true;
    } else {
      this.commonAvailabilty = true;
    }
  }
  hideShowBtn() {
    this.showPersonalInfo = !this.showPersonalInfo;
    if(!this.showPersonalInfo) {
      this.showHide = 'Show Course Information'
    }else {
      this.showHide = 'Hide Course Information'

    }
  }
  recData(value: any) {
    this.receivedValue = value;
  }

  // View API Call
  getDataViaCivil(){
    this.trainingstaff.viewStaff(atob(this.civil_number),atob(this.coursePk))
    .subscribe((data)=>{
      this.fullPageLoaders = false;
      this.viewStaffResponse = data.data;
      this.staffinforepo_pk = data?.data?.staffinforepo_pk;
      this.educationApi(this.staffinforepo_pk,this.edulimit,0);
      this.workApi(this.staffinforepo_pk,this.worklimit,0);
    })
  }
 
 // education detail api
  educationApi(id: any,limit: any, index: any,) {
    this.trainingstaff.educationDetail(id,limit,index)
    .subscribe((data)=>{
      this.education = data.data.data;
      this.eduresultLength = data.data.totalcount;
      console.log(this.eduresultLength)
      console.log( this.education)
    });
  }

   // work detail api
  workApi(id: any,limit: any, index: any,) {
    this.trainingstaff.workDetail(id,limit,index)
    .subscribe((data)=>{
      this.workexperience =data.data.data;
      this.workresultLength = data.data.totalcount;
      // console.log(this.workData);
    });
  }

  // onclick and view cv
  ViewCV(cv: any) {
    this.router.navigate([]).then(result => { window.open(cv, '_blank'); });
  }
  staffCv(sir_staffcv) {
    window.open(environment.baseUrl + 'web/cv/' + sir_staffcv, "_blank");
  }
}
