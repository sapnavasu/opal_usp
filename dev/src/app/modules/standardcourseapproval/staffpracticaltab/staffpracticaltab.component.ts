import { SelectionModel } from '@angular/cdk/collections';
import { AfterViewInit, Component, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import {animate, state, style, transition, trigger} from '@angular/animations';
import { ActivatedRoute, Router } from "@angular/router";
import moment from 'moment';
import { ApplicationService } from '@app/services/application.service';
import { catchError, map, startWith, switchMap } from 'rxjs/operators';
import { merge, Observable } from 'rxjs';
import { MatSort } from '@angular/material/sort';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
import {of as observableOf} from 'rxjs/observable/of';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ToastrService } from 'ngx-toastr';
import { IfStmt } from '@angular/compiler';
import { Location } from '@angular/common';
import { LocaleConfig } from 'ngx-daterangepicker-material';

export interface Staffrecorddata {
  civilnumber: any;
  staffname:any;
  age:any;
  roleforcourse:any;
  cour_subcate:any;
  competencycard:any;
  status:any;
  addedon:any;
  lastupdated:any;
}

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
  selector: 'app-staffpracticaltab',
  templateUrl: './staffpracticaltab.component.html',
  styleUrls: ['./staffpracticaltab.component.scss'],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
    
  ],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ]
})
export class StaffpracticaltabComponent implements OnInit,AfterViewInit {

  page: number = 10;
  documentname = new FormControl('');
  documentprovided = new FormControl('');
  tblplaceholder: boolean=false;
  noData: any;
  overallstatus: any;
  dataforcheckbox: any[];
  appstatus: any;
  GridDatas: StaffEvaluationPagination;
  civil_number: FormControl;
  staff_name: FormControl;
  ag_e: FormControl;
  rolecourse: FormControl;
  coursesubcate: FormControl;
  stat_us: FormControl;
  last_audit: FormControl;
  addedon: FormControl;
  comp: FormControl;
  apptempPk: any;
  @Output() previous: EventEmitter<any> = new EventEmitter<any>();
  @Input() viewapproveaudit:boolean;
  // type: any;
  @Input() application_id:any;
  @Input() project_id:any;
  @Input() clickDisable: boolean = false;
  clickableBtn: boolean;
  @Output() moveToNextLevelApproval: EventEmitter<any> = new EventEmitter<any>();
  stktype: any;
  isfocalpoint: any;
  useraccess: any;
  isUserApprovalAccess: boolean = false;
  isUserUpdateAccess: boolean = false;
  isUserReadAccess: boolean = false;
  isUserDeleteAccess: boolean = false;
  isUserCreateAccess: boolean = false;
  isUserDownloadAccess: boolean = false;
  coursesubcategory: any[]=[];
  category_remove: any;
  ifarabic: boolean = false;
  rolesubcategory: any[] = [];
  rolecategory_remove: any;
  projectid: string;
  practicalstatus: any;
  disableSubmitButton: boolean;
  i18n(key) {
    return this.translate.instant(key);
  }
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
  newone: boolean = true;
  update: boolean = false;
  decline: boolean = false;
  approval: boolean = false;

  status = new FormControl('');
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
      expandedElement: Staffrecorddata | null;
  @ViewChild("paginator") paginator: MatPaginator;
  staffrecordcolumn = ['civil_number', 'staff_name','age','roleforcourse','cour_subcate','status', 'competencycard' , 'added_on','last_updatedon','action'];
  staffrecorddata: MatTableDataSource<any>;
  public staffListData: MatTableDataSource<any>;
  @ViewChild(MatSort) sort: MatSort;

  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    protected router: Router,
    private applicationservice:ApplicationService,
    private http: HttpClient,
    private security: Encrypt,
    private route: ActivatedRoute,private _location:Location,
    public toastr: ToastrService,
    private localstorage: AppLocalStorageServices
  ) { }

  ngOnInit(): void {
    this.projectid = this.security.decrypt(this.project_id);
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    if(this.isfocalpoint==2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
     
      // if(this.useraccess[moduleid] && this.useraccess[moduleid].approval == 'Y') {
        this.isUserApprovalAccess = true;
      // }
      // if(this.useraccess[moduleid] && this.useraccess[moduleid].update == 'Y') {
        this.isUserUpdateAccess = true;
      // }
      // if(this.useraccess[moduleid] && this.useraccess[moduleid].read == 'Y') {
        this.isUserReadAccess = true;
      // }
      // if(this.useraccess[moduleid] && this.useraccess[moduleid].download == 'Y') {
        this.isUserDownloadAccess = true;
      // }
      // if(this.useraccess[moduleid] && this.useraccess[moduleid].delete == 'Y') {
        this.isUserDeleteAccess = true;
      // }
      // if(this.useraccess[moduleid] && this.useraccess[moduleid].create == 'Y') {
        this.isUserCreateAccess = true;
      // }
    }
    
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.ifarabic = false;

      } else {
        this.filtername = "إخفاء التصفية";
        this.ifarabic = true;

      }
      
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;

    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          this.ifarabic = false;
        } else {
          this.filtername = "إخفاء التصفية";
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;

      }
    });
    // this.route.params.subscribe(params => {
    //   this.apptempPk = this.security.decrypt(params['id']);
    //   console.log(this.apptempPk);
      
    //   this.type = params['type'];
    //   });
    this.apptempPk = this.security.decrypt(this.application_id);
    this.civil_number = new FormControl('');
    this.staff_name = new FormControl('');
    this.ag_e = new FormControl('');
    this.rolecourse = new FormControl('');
    this.coursesubcate = new FormControl('');
    this.stat_us = new FormControl('');
    this.last_audit = new FormControl('');
    this.addedon = new FormControl('');
    this.comp = new FormControl('');
      this.civil_number.valueChanges.debounceTime(400).subscribe(
        register => {    
          console.log(register,"register");
              
          if (register != null && register.length >= 3 ) {
            this.paginator.pageIndex = 0;
            this.fetchStaffData();   
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            // this.fetchStaffData();   
          }    
      })
      this.staff_name.valueChanges.debounceTime(400).subscribe(
        register => {        
          if (register != null  && register.length >= 3  ) {
            this.paginator.pageIndex = 0;
            this.fetchStaffData();   
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            // this.fetchStaffData();   
          }    
        })
        this.ag_e.valueChanges.debounceTime(400).subscribe(
          register => {        
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.fetchStaffData();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              // this.fetchStaffData();   
            }    
        })
        this.rolecourse.valueChanges.debounceTime(400).subscribe(
          register => {        
            if (register != null  && register.length >= 3  ) {
              this.paginator.pageIndex = 0;
              this.fetchStaffData();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              // this.fetchStaffData();   
            }    
          })
          this.coursesubcate.valueChanges.debounceTime(400).subscribe(
            register => {        
              if (register != null  && register.length >= 3 ) {
                this.paginator.pageIndex = 0;
                this.fetchStaffData();   
              }else if(register == ''){
                this.paginator.pageIndex = 0;
                // this.fetchStaffData();   
              }    
          })
          this.stat_us.valueChanges.debounceTime(400).subscribe(
            register => {        
              if (register != null ) {
                this.paginator.pageIndex = 0;
                this.fetchStaffData();   
              }else if(register == ''){
                this.paginator.pageIndex = 0;
                // this.fetchStaffData();   
              }    
            })
            this.last_audit.valueChanges.debounceTime(400).subscribe(
              register => {        
                if (register != null ) {
                  this.paginator.pageIndex = 0;
                  this.fetchStaffData();    
                }else if(register == ''){
                  this.paginator.pageIndex = 0;
                  // this.fetchStaffData();   
                }    
              })
              this.addedon.valueChanges.debounceTime(400).subscribe(
                register => {        
                  if (register != null ) {
                    this.paginator.pageIndex = 0;
                    this.fetchStaffData();   
                  }else if(register == ''){
                    this.paginator.pageIndex = 0;
                    // this.fetchStaffData();   
                  }    
                })
                this.comp.valueChanges.debounceTime(400).subscribe(
                  register => {        
                    if (register != null ) {
                      this.paginator.pageIndex = 0;
                      this.fetchStaffData();   
                    }else if(register == ''){
                      this.paginator.pageIndex = 0;
                      // this.fetchStaffData();   
                    }    
                  })
                  if(this.projectid == '4') {
                    this.staffrecordcolumn = ['civil_number', 'staff_name','age','roleforcourse','status', 'competencycard' , 'added_on','last_updatedon','action'];

                  } else {
                     this.staffrecordcolumn = ['civil_number', 'staff_name','age','roleforcourse','cour_subcate','status', 'competencycard' , 'added_on','last_updatedon','action'];
                  }
  }
  ngAfterViewInit(){
    this.fetchStaffData();
   }
  uploadassessementroute(data ,  view){
    if(this.projectid == '4'){
      this.router.navigate(['trainingcentremanagement/courseviewrassite/'+this.security.encrypt(data.asitpk)+'/staff/view/'+this.security.encrypt(2) + '/'+this.security.encrypt(view)]);
    }else{
      this.router.navigate(['standardcourseapproval/uploadassessment'],{ queryParams: {id: this.security.encrypt(data.setpk), a:this.application_id,b:this.security.encrypt(data.asitpk) } });
    }
 
  }
  viewassessementroute(data , view){
    if(this.projectid == '4'){
      this.router.navigate(['trainingcentremanagement/courseviewrassite/'+this.security.encrypt(data.asitpk)+'/staff/view/'+this.security.encrypt(2)+ '/'+this.security.encrypt(view)]);
    }else{
    this.router.navigate(['standardcourseapproval/viewassessment'],{ queryParams: { id: this.security.encrypt(data.setpk), a:this.application_id,b:this.security.encrypt(data.asitpk)}});
    }
  }

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      console.log('page-content')
    } catch (error) {
      // console.log('page-content')
    }
  }
  
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('staff.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('staff.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
 
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  fetchStaffData() {
    this.tblplaceholder = true;
    this.GridDatas = new StaffEvaluationPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};

    gridsearchvalue = {
        civilnumber:this.civil_number.value,
        staffname:this.staff_name.value,
        age:this.ag_e.value,
        roleforcourse:this.rolecourse.value,
        cour_subcate:this.coursesubcate.value,
        competencycard:this.comp.value,
        ass_status:this.stat_us.value,
        createdon:this.addedon.value,
        lastupdated:this.last_audit.value
    };
 
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.GridDatas.documentGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue), this.apptempPk,this.project_id);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          this.overallstatus  = data['data'].data.appstatus;
          this.practicalstatus = data['data'].data.practicalstatus;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
          this.staffListData = new MatTableDataSource<any>(data);
          this.staffListData.filterPredicate = this.createFilter();
          this.noData = this.staffListData.connect().pipe(map(data => data?.length === 0));
     
        if(data != null) {
          this.appstatus= Object.keys(data).map(function(index){
           let dataList = data[index];
           let status = dataList.app_status;
           return status;
           });
        }

        this.tblplaceholder = false;
       });
  }
  deleteStaffEvaluation(set_id) {
    if(this.isUserDeleteAccess) {
      this.applicationservice.deleteStaffEvaluation(this.security.encrypt(set_id)).subscribe((res:any) => {
        console.log(res);
        if(res['success']) {
          this.showTSuccess('Staff deleted!');

          this.fetchStaffData();   
        }
      })
    } else {
      this.security.userpermissionpop();
    }
  }
  previousBtn() {
    this.clickDisable = false;
    this.previous.emit(true);
  }
  clearFilter() {
    this.civil_number.setValue("");
    this.staff_name.setValue("");
    // this.ag_e.setValue("");
    this.rolecourse.setValue("");
    this.coursesubcate.setValue("");
    this.last_audit.setValue("");
    this.stat_us.setValue("");
    this.addedon.setValue("");
    this.comp.setValue("");
    this.fetchStaffData();
   
  }
  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
             return data.civilnumber.toLowerCase().indexOf(searchTerms.civilnumber) !== -1 &&
             data.staffname.toLowerCase().indexOf(searchTerms.staffname) !== -1 &&
             data.age.toLowerCase().indexOf(searchTerms.age) !== -1 &&
             data.roleforcourse.toLowerCase().indexOf(searchTerms.roleforcourse) !== -1 &&
             data.cour_subcate.toLowerCase().indexOf(searchTerms.cour_subcate) !== -1 &&
             data.competencycard.toLowerCase().indexOf(searchTerms.competencycard) !== -1&&
             data.status.toLowerCase().indexOf(searchTerms.status) !== -1&&
             data.addedon.toLowerCase().indexOf(searchTerms.addedon) !== -1&&
             data.lastupdated.toLowerCase().indexOf(searchTerms.lastupdated) !== -1           
    }
  return filterFunction;    
  }
  nextLevelApproval() {
    this.moveToNextLevelApproval.emit(true);
    // this.applicationservice.saveAppApprovalNextLevel(this.application_id,{type:10,role_id:1}).subscribe((res:any) => {
    //   console.log(res);
      
    // })
  }
  
  splitRoleFunction(data) {
    if (data && typeof data === 'string') {
      this.rolesubcategory = data.split(',');
      this.rolecategory_remove = data.split(',');
      this.rolecategory_remove.shift();
      return this.rolesubcategory[0];
    } else {
      return '';
    }
    
  }
  splitCourseFunction(data) { 
    this.coursesubcategory = data.split(',');
    this.category_remove = data.split(','); 
    this.category_remove.shift();
    return this.coursesubcategory[0]; 
  }
  showTSuccess(data){
    this.toastr.show(data, '', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.show(data, '', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  goBack() {
    this._location.back(); 
  }
  downLoadPdf(){
    this.disableSubmitButton = true;  
       this.applicationservice.ApprovalSiteauditras(this.apptempPk).subscribe(data => {
      this.disableSubmitButton = false;
      if(data.data.url){
         window.open(environment.baseUrl+data.data.url, "_blank");

      }
    });
  }
}

export class StaffEvaluationPagination {
  constructor(private http?: HttpClient) {
  }

  documentGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,appid?:number,project_id?:string): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getstaffpracticalassessmentlist';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}&project_id=${project_id}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}