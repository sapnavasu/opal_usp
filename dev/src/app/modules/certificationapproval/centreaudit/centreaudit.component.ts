import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ApplicationService } from '@app/services/application.service';
import {  Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { MatSort } from '@angular/material/sort';
import { MatCheckbox } from '@angular/material/checkbox';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import { ActivatedRoute } from '@angular/router';
import {map} from 'rxjs/operators/map'
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { P } from '@angular/cdk/keycodes';
import { Location } from '@angular/common';
import { DatePipe } from '@angular/common';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { MatSelect } from '@angular/material/select';

export const MY_FORMATS = {
  parse: {
      dateInput: 'DD-MM-YYYY',
  },
  display: {
      dateInput: 'DD-MM-YYYY',
      monthYearLabel: 'MMM YYYY',
      dateA11yLabel: 'LL',
      monthYearA11yLabel: 'MMMM YYYY',
  },
};
@Component({
  selector: 'app-centreaudit',
  templateUrl: './centreaudit.component.html',
  styleUrls: ['./centreaudit.component.scss'],
  providers: [DatePipe,
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
  encapsulation: ViewEncapsulation.None,

})
export class CentreauditComponent implements OnInit {
  apptempPk: any;
  type: any;
  auditcomdata: any ={};
  isexpired: number;
  tblplaceholder: boolean;

  i18n(key) {
    return this.translate.instant(key);

  }
  resultsLength: number;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page: number = 10;
  // resultsLength: number;
  @ViewChild("paginator") paginator: MatPaginator;
  public auditData: MatTableDataSource<any>;
  GridDatas: AppTempPagination;
  @ViewChild(MatSort) sort: MatSort;
  private querystr: string;
  exportlink:string;
  popupnoaccsite: any;
  auditdatalist = ['applstatus', 'appdh_appdecon', 'comment',  'action'];
  applstatus:  FormControl;
  date_expiry: FormControl;
  appdh_appdecon:  FormControl;
  certificatestatus: number;
  noData: any = '';
  popupcontent: any;
  buttoncont: any;
 disabledloader: boolean = false;
 @ViewChild(MatSelect) select: MatSelect;

  constructor(private translate: TranslateService,private _location:Location,
    private remoteService: RemoteService,private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,private appservice : ApplicationService,private route: Router,private security: Encrypt,private http: HttpClient,public routeid: ActivatedRoute  ) { }
    ifarabic: boolean = false;
    ifarabicpop: boolean = false;
    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
    locale: LocaleConfig = {
      format: 'DD-MM-YYYY',
    }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  dataSource;
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
        this.ifarabicpop = false;
      }else{
        this.filtername = "إخفاء التصفية";

        this.ifarabicpop = true;  }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;
      this.ifarabicpop = false; 
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
          this.filtername = "Hide Filter";
          this.ifarabicpop = false; 
        }
        else {
          this.ifarabic = true;
          this.filtername = "إخفاء التصفية";

          this.ifarabicpop = true; 
        }

      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabicpop = false; 
      }
    });

    this.applstatus = new FormControl('');
    this.appdh_appdecon = new FormControl('');
    this.applstatus.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.appdh_appdecon.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    this.date_expiry = new FormControl('');
  }

  ngAfterViewInit(){
     this.routeid.params.subscribe(params => {
      this.apptempPk = params['id'];
      this.type = params['type'];

    });
     this.getAppTempDtls();
   }


  clickEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('company.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('company.hitefil');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getAppTempDtls();
  }

 
  getAppTempDtls() {
     this.disabledloader = true;
     this.tblplaceholder = true;
    this.GridDatas = new AppTempPagination(this.http);
    this.select.close();
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
   gridsearchvalue = {applstatus:this.applstatus.value,
    appdh_appdecon:this.appdh_appdecon.value,
    };
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
         
          return this.GridDatas.appGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue) , this.apptempPk , this.type);
        }),
        map(data => {
          this.auditcomdata = data.data.data.auditdata;
          if(this.auditcomdata.appdt_certificateexpiry != null){
          var current_date = new Date();
          var specific_date = new Date(this.auditcomdata.appdt_certificateexpiry_org); //Year, Month, Date
          console.log(current_date,'current date');
          console.log(specific_date,'specific date');
          this.isexpired =  moment(current_date).isAfter(specific_date, 'day') ? 1 : 0;
          // if (current_date.toDateString() > specific_date.toDateString()) {    
          // this.isexpired = 1; 
          // }else {    
          // this.isexpired = 0;   
          // } 
          console.log(this.isexpired , 'expi');
          }
          this.resultsLength = data.data.data.totalcount;
          return data.data.data.records;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.auditData = new MatTableDataSource<any>(data);
        this.auditData.filterPredicate = this.createFilter();
        this.noData = this.auditData.connect().pipe(map(data => data.length === 0));
          this.disabledloader = false;
          this.tblplaceholder = false;
       });
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
             return data.applstatus.toLowerCase().indexOf(searchTerms.applstatus) !== -1 &&
             data.appdh_appdecon.toLowerCase().indexOf(searchTerms.appdh_appdecon) !== -1;
        
    }
  return filterFunction;    
  }
 

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      // console.log(123)
    } catch (error) {
      console.log('page-content')
    }
  }
  goBack() {
    this._location.back(); 
  }
  clearFilter() {
    this.date_expiry.reset()
    this.applstatus.reset()
    $(".clear").trigger("click");
    this.getAppTempDtls();

  }
}

export class AppTempPagination {
  constructor(private http?: HttpClient) {
  }

  appGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string ,appid?:number,type?:number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getauditdata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}&type=${type}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
