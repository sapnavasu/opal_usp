import { Component, OnInit, ViewChild, AfterViewInit, ViewEncapsulation } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import {MatTableDataSource} from '@angular/material/table';
import { FormControl, FormGroup } from '@angular/forms';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { LiveAnnouncer } from '@angular/cdk/a11y';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { Observable } from 'rxjs/Observable';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { map } from 'rxjs/operators/map';
import { catchError } from 'rxjs/operators/catchError';
import { MatSort } from '@angular/material/sort';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';
import { ActivatedRoute, Router } from '@angular/router';
export interface PeriodicElement {
  civilnumber: string;
  learnername: string;
  batchnumber: string;
  trainingprovider: string;
  assessmentcentre: string;
  feedback: string;
}
@Component({
  selector: 'app-learnerfeedbacktable',
  templateUrl: './learnerfeedbacktable.component.html',
  styleUrls: ['./learnerfeedbacktable.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class LearnerfeedbacktableComponent implements OnInit {
  displayedColumns: string[] = ['sir_idnumber', 'sir_name_en', 'bmd_Batchno', 'Tomrm_tpname_en', 'Aomrm_tpname_en', 'feedback', 'action'];
  displaySearchColumns: string[] = ['row-one', 'row-two', 'row-three', 'row-four', 'row-five', 'row-six', 'row-seven'];
  public dataSource: MatTableDataSource<any>;
  feedbackGridDatas: FeedbackdataPagination;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  page: number = 10;
  private querystr: string;
  filter: any = false;
  resultsLength = 0; 
  ifarabic: boolean = false;
  noData: any = '';
  civilnumber = new FormControl('');
  learnername = new FormControl('');
  batchnumber = new FormControl('');
  trainingprovider = new FormControl('');
  assessmentcentre = new FormControl('');
  filtersts:boolean = true;
  filtername = "Hide Filter";
  isfocalpoint;
  viewacess;
  stktype;
  useraccess;

  hidefilder: boolean = true;
  i18n(key) {
    return this.translate.instant(key);
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private _liveAnnouncer: LiveAnnouncer,
    private localstorage: AppLocalStorageServices,
    private http: HttpClient,
    private router: Router,
  ) { 
    
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
  }
  // ngAfterViewInit() {
  //   this.dataSource.paginator = this.paginator;
  // }
  ngOnInit(): void {
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
        if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'en') {
          this.ifarabic = false;
        }
        else {
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'en') {
          this.ifarabic = false;
        }
        else {
          this.ifarabic = true;
        }
      }
    });
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    
    this.civilnumber = new FormControl('');
    this.civilnumber.valueChanges.debounceTime(400).subscribe(
      cvnumb => {  
        if (cvnumb != null ) {
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }else if(cvnumb == ''){
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }    
      }
    )
    this.learnername = new FormControl('');
    this.learnername.valueChanges.debounceTime(400).subscribe(
      lername => {  
        if (lername != null ) {
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }else if(lername == ''){
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }    
      }
    )
    this.batchnumber = new FormControl('');
    this.batchnumber.valueChanges.debounceTime(400).subscribe(
      btnumb => {  
        if (btnumb != null ) {
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }else if(btnumb == ''){
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }    
      }
    )
    this.trainingprovider = new FormControl('');
    this.trainingprovider.valueChanges.debounceTime(400).subscribe(
      trpro => {  
        if (trpro != null ) {
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }else if(trpro == ''){
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }    
      }
    )
    this.assessmentcentre = new FormControl('');
    this.assessmentcentre.valueChanges.debounceTime(400).subscribe(
      asscent => {  
        if (asscent != null ) {
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }else if(asscent == ''){
          this.paginator.pageIndex = 0;
          this.getfeedbackdata();   
        }    
      }
    )
    
    if(this.isfocalpoint == 1){
      this.viewacess = true;
    };
    console.log('this.isfocalpoint', this.isfocalpoint);
    console.log('this.stktype', this.stktype);
    console.log('this.useraccess', this.useraccess);
    //let moduleid = this.useraccess.filter(item => item.modules == "Learner Card Log");
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Learner Feedback');
    let submodulefeedback = this.stktype == 1 ? 9 : 26;
    if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulefeedback] && this.useraccess[moduleid][submodulefeedback].read == 'Y'){
      this.viewacess = true;
    }

   


  }
  ngAfterViewInit():void {
    if (!this.viewacess) {
      swal({
        title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (this.stktype == 1) {
            this.router.navigate(['dashboard/portaladmin']);
          }
          else {
            this.router.navigate(['dashboard/centre']);
          }
        }

      });

    }else{
      this.getfeedbackdata();
    }
  }
  clearFilter() {
    this.civilnumber.setValue("");
    this.learnername.setValue("");
    this.batchnumber.setValue("");
    this.trainingprovider.setValue("");
    this.assessmentcentre.setValue("");
    this.getfeedbackdata();   
  }
  getfeedbackdata(){
    this.feedbackGridDatas = new FeedbackdataPagination(this.http);
    this.sort?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue =  {civil_numb:this.civilnumber.value,learner_name:this.learnername.value,batchnumber:this.batchnumber.value,trainingprovider:this.trainingprovider.value,assessmentcentre:this.assessmentcentre.value};
    merge(this.sort?.sortChange)
    .pipe(
      startWith({}),
      switchMap(() => { 
        this.querystr = '';
          return this.feedbackGridDatas.feedbackdGridUtil(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
            this.page,JSON.stringify(gridsearchvalue));
      }),
      map(data => {
        this.resultsLength = data['data'].data.totalcount;
        return data['data'].data.data;
      }),
      catchError(() => {
        return observableOf('failure');
      })
    ).subscribe(data => {
      this.dataSource = new MatTableDataSource(data);
      this.filtersts = true;
      this.noData = this.dataSource.connect().pipe(map(data => data.length === 0));
    });
  }
  showFilter() {
    this.filter = !this.filter;
    if (!this.filter) {
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';
    }
    else {
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';
    }
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getfeedbackdata();
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('Show Filter');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('Hide Filter');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
}
export class FeedbackdataPagination {
  constructor(private http?: HttpClient) {
  }
  feedbackdGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string): Observable<any> { 
    const sign = (order === 'desc') ? '-' : '';    
    const href = environment.baseUrl + 'lf/learnerfeedback/getfeedbacklist';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
