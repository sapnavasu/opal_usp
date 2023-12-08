import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { MatTableDataSource } from '@angular/material/table';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { EnterpriseadminService } from '../enterpriseadmin.service';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { environment } from '@env/environment';
import { FormControl } from '@angular/forms';
import {of as observableOf} from 'rxjs/observable/of';
import {merge} from 'rxjs/observable/merge';
import { MatSort } from '@angular/material/sort';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map'
import {catchError} from 'rxjs/operators/catchError';
import { ApplicationService } from '@app/services/application.service';




export interface Roledata {
  stktype: any;
  civilnumber:any;
  stafname:any;
  emailid:any;
  mobilenumber:any;
  role:any;
  thirdpartyagent:any;
  status:any;
  added_on:any;
  lastupdated:any;

 
}
// const roledata_data: Roledata[] = [
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Abdul Aziz Al Ghurair',emailid:'Abdulaziz@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Mohammed Al Issa',emailid:'mohammedal@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'yes',status:'I',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saif Ahmed Belhasa',emailid:'saifahmed@gmail.com',mobilenumber:'+968 78754655',role:'Tutor/Trainer',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Mohamed Mansour',emailid:'mohamed@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'No',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saleh Abdullah Kamel',emailid:'abdullahkamel@gmail.com',mobilenumber:'+968 78754655',role:'Tutor/Trainer',thirdpartyagent:'yes',status:'P',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Aziz Akhannouch',emailid:'akhannouch@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'No',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saif Al Ghurair',emailid:'saifalghurair@gmail.com',mobilenumber:'+968 78754655',role:'Tutor',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saif Al Ghurair',emailid:'abdulla@gmail.com',mobilenumber:'+968 78754655',role:'Assessor',thirdpartyagent:'No',status:'I',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Majid Al Futtaim',emailid:'majidal@gmail.com',mobilenumber:'+968 78754655',role:'Tutor/Trainer',thirdpartyagent:'yes',status:'I',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Mohamed Al Fayed',emailid:'mohamed@gmail.com',mobilenumber:'+968 78754655',role:'Assessor',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'}
// ];
@Component({
  selector: 'app-manageusers',
  templateUrl: './manageusers.component.html',
  styleUrls: ['./manageusers.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ManageusersComponent implements OnInit {
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public Usersrecord: MatTableDataSource<any>;
  public addrolecreationpage: boolean = false;
  public rolegridlistpage: boolean = true;
  public  userdata :any= [];
  public  userCenter :any= [];
  public  resultsLength :Number;
  public refname:any;
  public refnameCenter: boolean = true;
 UsersGridDatas: ManageUserGlistPagination;
  
  // Usersrecord: MatTableDataSource<Userdata>;
  // public userdata : Userdata[];
  rolesrecordcolumn = ['oshm_stakeholdertype','oum_idnumber','stafname','emailid','mobilenumber','role','thirdpartyagent','status','added_on','lastupdated','action'];
  

stafName:  FormControl;
emailid:  FormControl;
stakeholdertype:  FormControl;
civilNo:  FormControl;
mobilno:  FormControl;
roleName_en:  FormControl;
status:  FormControl;
addedOn:  FormControl;
lastUpdateOn:  FormControl;
isthirdPartyAgent:  FormControl;

  // Rolesrecord = new MatTableDataSource<Roledata>(this.userdata);
  // resultsLength = this.Rolesrecord.data.length;

  
  hidefilder: boolean = true;
  filtername = "Hide Filter";
  page: number = 10;
  pageEvent: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private enterprise: EnterpriseadminService,
    public routeid: ActivatedRoute,
    private http: HttpClient,
    private appservice : ApplicationService,

  ) { }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  ngOnInit(): void {
    // this.routeid.queryParams.subscribe(params => {
    //   this.refname = params['type'];
    // });
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
    if(this.refname ==3){
      this.getusercentergriddata();
      // this.refnameCenter =true;
    }else{
      // this.getusergriddata();
    }
    
    this.stafName= new FormControl('');
    this.emailid= new FormControl('');
    this.stakeholdertype= new FormControl('');
    this.civilNo= new FormControl('');
    this.mobilno= new FormControl('');
    this.roleName_en= new FormControl('');
    this.status= new FormControl('');
    this.addedOn= new FormControl('');
    this.lastUpdateOn= new FormControl('');
    this.isthirdPartyAgent= new FormControl('');


    this.stafName.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.emailid.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.stakeholdertype.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.civilNo.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }
        else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.mobilno.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.roleName_en.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.status.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.addedOn.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.lastUpdateOn.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
    this.isthirdPartyAgent.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getManageUserDtls();   
        }    
      }
    )
   
  }
  ngAfterViewInit():void {
    this.getManageUserDtls();
  
      this.Usersrecord.sort = this.sort;
      this.Usersrecord.paginator = this.paginator;
    
   }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  gridlistdata(event){
    this.rolegridlistpage = event;
  }

  addrolecreationdata(event){
    this.addrolecreationpage = event;
  }
  routeToadduser() {
      this.addrolecreationpage = true;
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
      this.filtername = "Show Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = "Hide Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
 
  // getusergriddata(){
  //   this.enterprise.getusersgriddtls().subscribe(data=>{
  //     this.userdata.data = data['data'].userList;
  //     // this.Rolesrecord = new MatTableDataSource<Roledata>(this.userdata);
  //     // this.resultsLength = this.userdata.data.length;
  //   });
  // }
  getusercentergriddata(){
    this.enterprise.getUserCenterlistDtls().subscribe(data=>{
      this.userCenter.data = data['data'].centerList;
      this.resultsLength = this.userCenter.data.length;
    });
  }
  noData: any = '';
  getManageUserDtls() {
    this.UsersGridDatas = new ManageUserGlistPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
   

    gridsearchvalue = {stafName:this.stafName.value,
      emailid:this.emailid.value,
      oshm_stakeholdertype:this.stakeholdertype.value,
      oum_idnumber:this.civilNo.value,
      mobilno:this.mobilno.value,
      roleName_en:this.roleName_en.value,
      status:this.status.value,
      isthirdPartyAgent:this.isthirdPartyAgent.value,
      addedOn:this.status.value,
      lastUpdateOn:this.status.value
    };
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.UsersGridDatas.usersGridList(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          // console.log(data['data'].data.data,'data.data.data123');
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.Usersrecord = new MatTableDataSource<any>(data);
        this.Usersrecord.filterPredicate = this.createFilter();
        this.noData = this.Usersrecord.connect().pipe(map(data => data.length === 0));
        console.log(this.noData)
        // console.log(this.Usersrecord,'this.Usersrecord');

       });
  }
 
  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
             return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
             data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
             data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
             data.civilNo.toLowerCase().indexOf(searchTerms.civilNo) !== -1 &&
             data.mobilno.toLowerCase().indexOf(searchTerms.mobilno) !== -1 && 
            data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 && 
            data.status.toLowerCase().indexOf(searchTerms.status) !== -1 && 
            data.isthirdPartyAgent.toLowerCase().indexOf(searchTerms.isthirdPartyAgent) !== -1 && 
            data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 && 
            data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1 ;
        
    }
  return filterFunction;    
  }
  
}
export class ManageUserGlistPagination {
  constructor(private http?: HttpClient) {
  }

usersGridList(sort: string, order: string, page: number, size: number,gridsearchValues?:string): Observable<any> {
  const href = environment.baseUrl + 'ea/enterpriseadmin/getusersdtls';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
