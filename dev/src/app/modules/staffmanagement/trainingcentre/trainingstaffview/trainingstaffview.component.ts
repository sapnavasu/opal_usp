import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort, Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { MatSortModule } from '@angular/material/sort';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatCheckbox } from '@angular/material/checkbox';
import { Location } from '@angular/common';

@Component({
  selector: 'app-trainingstaffview',
  templateUrl: './trainingstaffview.component.html',
  styleUrls: ['./trainingstaffview.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class TrainingstaffviewComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginatortwo") paginatortwo: MatPaginator;

  public page: number = 10;
  public eduresultLength: any = 0;
  public workresultLength: any = 0;
  public dffValues: string;
  public commonAvailabilty:boolean = false;
  public showPersonalInfo: boolean = true;
  public showHide: string = 'Hide Course Information';
  public receivedValue: any;
  
  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,

    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService,
    protected security: Encrypt, private _location:Location,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
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

    });
    this.eduresultLength = this.education.length
    this.workresultLength = this.workexperience.length;
    this.getLocalstorageValue()

  }
  roleofcourse= ['Assessor','Programer','Manager','Tester']
  assessorlocate=[
    { Governate: 'Governate 1', Wilayat: 'Wilayat 1' },
    { Governate: 'Governate 2', Wilayat: 'Wilayat 2' },
    { Governate: 'Governate 3', Wilayat: 'Wilayat 3' },
  ]
  education = [
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
   
  ]
  workexperience = [
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'},
    {comapnyname: 'National Training Institute'}
  ]
 
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.eduresultLength = this.education.length

  }

  workPaginator(event: PageEvent) {
    this.paginatortwo.pageIndex = event.pageIndex;
    this.paginatortwo.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  backBtn() {
    this._location.back();
  }
  getLocalstorageValue() {
    this.dffValues = localStorage.getItem('typeView')
    if(this.dffValues == 'viewstaff') {
      this.commonAvailabilty = false;
    }else if(this.dffValues == 'viewAvailabilty'){
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
}
