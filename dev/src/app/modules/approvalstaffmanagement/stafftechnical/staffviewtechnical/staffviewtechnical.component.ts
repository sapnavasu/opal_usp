import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Location } from '@angular/common';
import { TechnicalstaffService } from '@app/services/technicalStaff.service';
import { environment } from '@env/environment';

@Component({
  selector: 'app-staffviewtechnical',
  templateUrl: './staffviewtechnical.component.html',
  styleUrls: ['./staffviewtechnical.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class StaffviewtechnicalComponent implements OnInit {
  civilNumber: any;
  viewStaffResponse: any;
  staffinforepo_pk: any;
  edulimit: number = 5;
  worklimit: number = 5;
  i18n(key) {
    return this.translate.instant(key);
  }
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginatortwo") paginatortwo: MatPaginator;
  public fullPageLoaders: boolean = false;
  public receivedValue: any;
  public page: number = 10;
  public eduresultLength: any = 0;
  public workresultLength: any = 0;
  public dffValues: string;
  public commonAvailabilty: boolean = false;
  public showPersonalInfo: boolean = true;
  public showHide: string = 'Show Project Information'
  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    private technicalstaff: TechnicalstaffService,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService,
    private activeRoute: ActivatedRoute,
    protected security: Encrypt, private _location: Location,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  ngOnInit(): void {
    this.fullPageLoaders = true;
    this.activeRoute.queryParamMap.subscribe((data: any) => {
      this.civilNumber = data.get("id");
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

    });
    this.eduresultLength = this.education.length
    this.workresultLength = this.workexperience.length;
    this.getLocalstorageValue()

  }
  roleofcourse = ['Assessor', 'Programer', 'Manager', 'Tester']
  assessorlocate = [
    { Governate: 'Governate 1', Wilayat: 'Wilayat 1' },
    { Governate: 'Governate 2', Wilayat: 'Wilayat 2' },
    { Governate: 'Governate 3', Wilayat: 'Wilayat 3' },
  ]
  education = [
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },

  ]
  workexperience = [
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' },
    { comapnyname: 'National Training Institute' }
  ]

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    // this.eduresultLength = this.education.length
    this.paginator.length = this.eduresultLength
    this.educationApi(this.staffinforepo_pk, this.paginator.pageSize, this.paginator.pageIndex)
  }

  workPaginator(event: PageEvent) {
    this.paginatortwo.pageIndex = event.pageIndex;
    this.paginatortwo.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.paginatortwo.length = this.workresultLength
    this.workApi(this.staffinforepo_pk, this.paginatortwo.pageSize, this.paginatortwo.pageIndex)
  }
  backBtn() {
    this._location.back();
  }
  getLocalstorageValue() {
    this.dffValues = localStorage.getItem('typeView')
    if (this.dffValues == 'viewStaff') {
      this.commonAvailabilty = false;
    } else {
      this.commonAvailabilty = true;
      this.showPersonalInfo = false;
    }
  }
  hideShowBtn() {
    console.log(this.showPersonalInfo)
    this.showPersonalInfo = !this.showPersonalInfo;
    if (!this.showPersonalInfo) {
      this.showHide = 'Show Project Information'
    } else {
      this.showHide = 'Hide Project Information'

    }

    console.log(this.showPersonalInfo,'--',this.showHide)

  }
  recData(value: any) {
    this.receivedValue = value;
  }

  // View API Call
  getDataViaCivil() {
    this.technicalstaff.viewStaff(atob(this.civilNumber))
      .subscribe((data) => {
        this.viewStaffResponse = data?.data;
        this.fullPageLoaders = false;
        this.staffinforepo_pk = data?.data?.staffinforepo_pk;
        this.educationApi(this.staffinforepo_pk, this.edulimit, 0);
        this.workApi(this.staffinforepo_pk, this.worklimit, 0);
      })
  }

  // Educational Qualification API
  educationApi(id: any, limit: any, index: any,) {
    this.technicalstaff.educationDetail(id, limit, index)
      .subscribe((data) => {
        this.education = data?.data?.data;
        this.eduresultLength = data?.data?.totalcount;
        // console.log(this.eduresultLength)
        // console.log(this.education)
      });
  }

  // Work Experience API
  workApi(id: any, limit: any, index: any,) {
    this.technicalstaff.workDetail(id, limit, index)
      .subscribe((data) => {
        this.workexperience = data?.data?.data;
        this.workresultLength = data?.data?.totalcount;
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


