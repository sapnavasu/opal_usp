import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { Router } from "@angular/router";
import { EnterpriseadminService } from '../enterpriseadmin.service';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { environment } from '@env/environment';
import {of as observableOf} from 'rxjs/observable/of';
import {merge} from 'rxjs/observable/merge';
import { MatSort } from '@angular/material/sort';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map'
import {catchError} from 'rxjs/operators/catchError';
import { ApplicationService } from '@app/services/application.service';

export interface Roledata {
  // roleList: any;
  stakeholdertype: any;
  projectname_en:any;
  rolename_en:any;
  higherRole:any;
  status:any;
  addedOn:any;
  updatedOn:any;
  id:any;
}

// const roledata_data: Roledata[] = [
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Auditor",highrole:"CEO",status:"A",addedon:"24-01-2023",lastupdated:"24-03-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Assessor",highrole:"CEO",status:"I",addedon:"24-01-2023",lastupdated:"24-02-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Finance",highrole:"-",status:"A",addedon:"26-01-2023",lastupdated:"24-02-2023"},
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Authority",highrole:"Authority, CEO",status:"I",addedon:"24-01-2023",lastupdated:"29-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"Road Worthiness Assurance Standard (RAS)",role:"-",highrole:"Fire and Safety",status:"A",addedon:"24-01-2023",lastupdated:"28-01-2023"},
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Auditor",highrole:"CEO",status:"A",addedon:"24-01-2023",lastupdated:"27-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Assessor",highrole:"CEO",status:"I",addedon:"28-01-2023",lastupdated:"29-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Finance",highrole:"-",status:"A",addedon:"24-01-2023",lastupdated:"28-01-2023"},
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Authority",highrole:"Authority, CEO",status:"I",addedon:"26-01-2023",lastupdated:"27-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"Road Worthiness Assurance Standard (RAS)",role:"-",highrole:"Fire and Safety",status:"A",addedon:"24-01-2023",lastupdated:"28-01-2023"}
// ];

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
  selector: 'app-manageroles',
  templateUrl: './manageroles.component.html',
  styleUrls: ['./manageroles.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
],
})
export class ManagerolesComponent implements OnInit {
  stktypesearch = new FormControl('');
  projectsearch = new FormControl('');
  rolesearch = new FormControl('');
  highrolesearch = new FormControl('');
  statussearch = new FormControl('');
  addedonsearch = new FormControl('');
  updatedonsearch = new FormControl('');
  filterValues = {
    stktypesearch: '',
    projectsearch: '',
    rolesearch: '',
    highrolesearch: '',
    statussearch: '',
    addedonsearch: '',
    updatedonsearch: '',
  };
  i18n(key) {
    return this.translate.instant(key);
  }
  
  
  
 
  @ViewChild("MatPaginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  rolesrecordcolumn = ['stakeholdertype', 'projectname_en','rolename_en','higherRole','status','addedOn','updatedOn','action'];
  // Rolesrecord: MatTableDataSource<Roledata>;
  // roledata : Roledata[];
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page:number=10;
  pageEvent: any;
  resultsLength : number;
  UsersGridDatas: ManageRoleGlistPagination;
  public rolesrecord: MatTableDataSource<any>;

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private enterprise: EnterpriseadminService,
    protected router: Router,
    public routeid: ActivatedRoute,
    private http: HttpClient,
    private appservice : ApplicationService,
  ) { }

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
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.getuserroledata();
  }
  routeToroledata() {
    //this.router.navigate(['newenterpriseadmin/manageroles']);   
    this.addrolecreationpage = true;
  }
  viewroute(){
    this.router.navigate(['newenterpriseadmin/viewroles']);
  }
  public addrolecreationpage: boolean = false;
  public rolegridlistpage: boolean = true;

  gridlistdata(event){
    this.rolegridlistpage = event;
  }

  addrolecreationdata(event){
    this.addrolecreationpage = event;
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = "Show Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = "Hide Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  editBusinessSourceList() {
    this.router.navigate(['/newenterpriseadmin/addroles'],{queryParams : {type : 1}});
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
  onPaginateChange(event) {
    this.page = event.pageSize;
  }
  public  roledata :any= [];
  getuserroledata(){
    this.enterprise.getrolegriddtls().subscribe(data=>{
      this.roledata.data = data['data'].roleList;
      this.resultsLength = this.roledata.data.length;
    });
  }
  editData(data)
  {
    this.roledata.forEach(roledata => {
        if(roledata.id == data.id)
        {
           console.log('sdfsdsd'+ data.id);
        }
    });
  }
  getManageUserDtls() {
    this.UsersGridDatas = new ManageRoleGlistPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};

    // gridsearchvalue = {stafName:this.stafName.value,
    //   emailid:this.emailid.value,
    //   stakeholdertype:this.stakeholdertype.value,
    //   civilNo:this.civilNo.value,
    //   mobilno:this.mobilno.value,
    //   roleName_en:this.roleName_en.value,
    //   status:this.status.value,
    //   isthirdPartyAgent:this.isthirdPartyAgent.value,
    //   addedOn:this.status.value,
    //   lastUpdateOn:this.status.value
    // };
  console.log(gridsearchvalue ,'Archana12');
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.UsersGridDatas.rolesGridList(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          console.log(data['data'].data.data,'data.data.data123');
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.rolesrecord = new MatTableDataSource<any>(data);
        // this.Usersrecord.filterPredicate = this.createFilter();

       });
  }

  // createFilter(): (data: any, filter: string) => boolean {
  //   let filterFunction = function(data, filter): boolean {
  //     let searchTerms = JSON.parse(filter);
  //            return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
  //            data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
  //            data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
  //            data.civilNo.toLowerCase().indexOf(searchTerms.omrm_tpname_en) !== -1 &&
  //            data.mobilno.toLowerCase().indexOf(searchTerms.omrm_branch_en) !== -1 && 
  //           data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 && 
  //           data.status.toLowerCase().indexOf(searchTerms.status) !== -1 && 
  //           data.isthirdPartyAgent.toLowerCase().indexOf(searchTerms.isthirdPartyAgent) !== -1 && 
  //           data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 && 
  //           data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1 ;
        
  //   }
  // return filterFunction;    
  // }

}

export class ManageRoleGlistPagination {
  constructor(private http?: HttpClient) {
  }

rolesGridList(sort: string, order: string, page: number, size: number,gridsearchValues?:string): Observable<any> {
  const href = environment.baseUrl + 'ea/enterpriseadmin/getrolesdtls';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}