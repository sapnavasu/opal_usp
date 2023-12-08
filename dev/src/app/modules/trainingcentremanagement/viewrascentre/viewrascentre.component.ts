import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import moment from 'moment';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { ApplicationService } from '@app/services/application.service';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { Observable, merge } from 'rxjs';
import { catchError, map, startWith, switchMap } from 'rxjs/operators';
import { of as observableOf } from 'rxjs/observable/of';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { CookieService } from 'ngx-cookie-service';
export interface Element {
  scm_coursename_en: string;
  rm_name_en: string;
  appdm_certificateexpiry: string;
}
export interface ofrcourdtls {
  appocm_coursename_en: string;
  appocm_courseduration: string;
  ccm_catname_en: string;
}

const ELEMENT_DATA: Element[] = [
  {
    scm_coursename_en: "Defensive Driving",
    rm_name_en: "Training & Assessment",
    appdm_certificateexpiry: "30-03-2022",
  },
];


@Component({
  selector: 'app-viewrascentre',
  templateUrl: './viewrascentre.component.html',
  styleUrls: ['./viewrascentre.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewrascentreComponent implements OnInit {
  public drvInputed: DriveInput;
  public enabled: boolean = true;
  public userList: any;
  @ViewChild('awarddoc') awarddocFilee: Filee;
  public mapMarkerLocation: string = '';
  public trainingprovform: FormGroup;
  public latitude: number;
  public longitude: number;
  http: HttpClient;
  public compdtls: any;
  public ofrcourdtls: any;
  public ofrcourdtls_cat: any;
  public stdcourdtls: any;
  public appstatus: any;
  public offdtls: any;
  public disableSubmitButton: boolean;
  drv_logo: DriveInput;
  @ViewChild('logo') logo: Filee;
  @ViewChild('changebannerlogo') changebannerlogo: Filee;
  public isChangebanneredit: boolean = true;
  @ViewChild(Filee) filees: Filee;
  ifarabic: any;
  emptyimgenable: boolean = true;
  rascategory: any;

  constructor(
    private appservice: ApplicationService,
    private fb: FormBuilder,
    public routeid: ActivatedRoute, private route: Router, private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
  ) { }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
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
    this.trainingprovform = this.fb.group({
      Upload: ['', ''],
      lat: ['', ''],
      lang: ['', ''],
    });
    this.drvInputed = {
      fileMstPk: 15,
      selectedFilesPk: []
    };

    this.drv_logo = {
      fileMstPk: 8,
      selectedFilesPk: []
    };

    this.routeid.queryParams.subscribe(params => {
      if (params['app_pk']) {

        this.appservice.getviewdetailsras(params['app_pk']).subscribe(data => {
          this.stdcourdtls = data.data.data.stdcour;
          this.compdtls = data.data.data.comp;
          this.appstatus = data.data.data.appstatus;
          this.rascategory = data.data.data.category;
          if (this.appstatus == 19) {
            this.isChangebanneredit = false;
          }

          if (this.compdtls.omrm_cmplogo && this.compdtls.omrm_cmplogo != 'null') {
            this.drv_logo.selectedFilesPk = [this.compdtls.omrm_cmplogo];
            setTimeout(() => {
              this.logo.triggerChange();
            }, 1000);
          }

          if (this.compdtls.omrm_cmpbanner && this.compdtls.omrm_cmpbanner != 'null') {

            this.drvInputed.selectedFilesPk = [this.compdtls.omrm_cmpbanner];
            this.emptyimgenable = false;
            setTimeout(() => {
              this.changebannerlogo.triggerChange();
            }, 1000);
          }

        })
      }
    });
  }

  getLocationDetails(value) {
    this.trainingprovform.controls['lat'].setValue(100);
    this.trainingprovform.controls['lang'].setValue(200);
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    this.appservice.savebannerimg(file,).subscribe(data => {
      if (data['data'].status == 1) {
        this.emptyimgenable = false;
      }
    })
    setTimeout(() => {
      this.changebannerlogo.triggerChange();
    }, 1000);

  }

  deletebanner() {
    this.drvInputed.selectedFilesPk = [];
    setTimeout(() => {
      this.changebannerlogo.triggerChange();
    }, 1000);
    this.appservice.deletebannerimg().subscribe(data => {
      if (data['data'].status == 1) {
        this.emptyimgenable = true;
      }
    })
  }

  opendrive(data) {
    this.filees.openDrive(data)
  }
}

export class MainStaffPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getstaff';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainStaffworkPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffworkGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getstaffwork';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}