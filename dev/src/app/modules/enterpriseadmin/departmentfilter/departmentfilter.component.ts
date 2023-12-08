import { ChangeDetectorRef, Component, ElementRef, EventEmitter, Input, OnInit, Output, Renderer2, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { Encrypt } from '@app/common/class/encrypt';
import { atLeastOne } from '@app/common/directives/atleastone';
import { CountryList } from '@app/common/interfaces/supplier';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { ReplaySubject, Subject } from 'rxjs';
import 'rxjs/add/observable/of';
import { SlideInOutAnimation } from '../animation';
import { EnterpriseService } from '../enterprise.service';
import { HttpClient } from '@angular/common/http';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-departmentfilter',
  templateUrl: './departmentfilter.component.html',
  styleUrls: ['./departmentfilter.component.scss'],
  animations: [SlideInOutAnimation]
})
export class DepartmentfilterComponent implements OnInit {
  animationState = 'out';
  animationState1 = 'out';
  filterform: FormGroup;
  searchDivision: string = '';
  searchDepartment: string = '';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @Input() filterFor: string;
  @Input() recentSearchType: any;
  public recentSearch:any=[];
  @Input() filterType:number; /* 1 - UserActivty 2 - Enterprise Admin User */
  @Output() userFilterData:any = new EventEmitter<any>();
  @Output() moitorFilterData:any = new EventEmitter<any>();
  @Output() emitFilterData:any  = new EventEmitter<any>();
  @Output() hideResponseLoader: any = new EventEmitter<any>();
  @Output() showLoaderviewdept: any = new EventEmitter<any>(); 
  @Input() sortBy:string;
  public postParams:any;
  public postUrl:any;
  public departmentData:any;
  public oninitdepartmentData:any;
  public departmentDataTemp:any = '';
  public businessUnitDataTemp:any = '';
  public filterValue:any = 0;
  public search:any = '';
  public showSearchIcon:boolean =true;
  public filterCombination:any = [];
  public perpage = BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;

  Department = new FormControl('');
  Module = new FormControl('');
  Submodule = new FormControl('');
  filtercount: number = 0;
  livecount: number = 0;
  statusCount: number = 0;
  businessunitlist: any;
  oninitbusinessunitlist: any;
  branchnamelist: any;
  showInvitedUser: boolean = false;
  checkedFilterArr: any = []
  public paginatorDataArray:any;
  @Input() public set paginatorData(value: any) {
    this.paginatorDataArray = value;
  }
  public get paginatorData() {
    return this.paginatorDataArray;
  }
  filteredCountry: ReplaySubject<CountryList[]> = new ReplaySubject<CountryList[]>(1);
  private _onDestroy = new Subject<void>();

  /*Sar Starts*/
  @ViewChild('bunitDeptReset') bunitDeptReset:FormGroupDirective;
  @Output() departmentFilter:any  = new EventEmitter<any>();
  @Output() advanceDepartmentFilter:any  = new EventEmitter<any>();
  @Output() departmentResetFilter:any  = new EventEmitter<any>();
  @ViewChild("inputClickdep") inputClickdep: ElementRef;
  @ViewChild("filterClick") filterClick: ElementRef;

  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private cdr: ChangeDetectorRef,
    private renderer?: Renderer2,
  ) 

  {
    this.renderer.listen("window", "click", (e: Event) => {
        if (e.target == this.inputClickdep.nativeElement) {
          this.animationState1 = "in";
          this.animationState = "out";
        }
        else
        {
          this.animationState1 = "out";
        }
    });
   }

   languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
   {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
   dir="ltr" 

  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  });
    this.filterform = new FormGroup({
      Department: new FormControl([]),
      businessUnit: new FormControl([]),
      Status: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });
    
    this.postParams = {
      'from':'2'
    };
    this.initialFilterDetails(this.postParams);

    this.getRecentSearch();
    this.filterform.valueChanges.subscribe(data => {
      let count = 0;
      for(let i in data){
        let type = typeof(data[i]);
        if((type == "string" && data[i]) || (type == "boolean" && data[i]) || (data[i] !== null && type == "object" && data[i].length > 0)){
          count++;
        }
      }
      this.livecount = count;
    })
    this.divFilterval.valueChanges
    .subscribe(() => {
      this.filterdivisonsearch();
    });
    this.depatFilterval.valueChanges
    .subscribe(() => {
      this.filterdepartmentsearch();
    });
  }

  getRecentSearch(){
    this.EnterpriseService.getRecentSearch('Enterprise Admin',this.recentSearchType).subscribe(data => {
      if(data.data.flag == 'S'){      
        this.recentSearch = data.data.returndata;
      }
    });
  }
  addRecentData(searchText){
    this.EnterpriseService.addRecentSearch('Enterprise Admin',this.recentSearchType,searchText).subscribe(data => {
      if(data.data.flag == 'S'){    
        this.getRecentSearch()  
      }
    });
  }
  recentDataSet(searchTxt){
    this.search=searchTxt;
  }
  public filterdDivisionval: ReplaySubject<any> = new ReplaySubject<any>(1);
  initialFilterDetails(postParams){
    this.postUrl = 'ea/user/enterprise-filter-initial-data';
    this.EnterpriseService.enterpriseService(postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              this.oninitdepartmentData = data['data'].data.departmentDetails;
              // this.departmentData = data['data'].data.departmentDetails;
              // this.filterddepartmentData.next(this.departmentData.slice()); 
              this.oninitbusinessunitlist = data['data'].data.bunitData;
              this.businessunitlist = data['data'].data.bunitData;
              this.filterdDivisionval.next(this.businessunitlist.slice());    
            }
        }.bind(this)
    );
  }
  
  public divFilterval: FormControl = new FormControl();
  filterdivisonsearch() {
    if (!this.businessunitlist) {
      return;
    }
    // get the search keyword
    let search = this.divFilterval.value;
    if (!search) {
      this.filterdDivisionval.next(this.businessunitlist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filterdDivisionval.next(
      this.businessunitlist.filter(bunitDataLst => bunitDataLst.bunitName.toLowerCase().indexOf(search) > -1)
    );
  }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentfilter') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
      this.animationState1 = 'out';
    }
    else if (divName === 'searchhistorydropdown') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
      this.animationState = 'out';
    }
  }
  closethefilter()
  {
    this.filtercount=0;
    this.bunitDeptReset.reset();
  }
  
  deptChange(event){
    this.departmentDataTemp = '';
    (this.departmentData).forEach((item,index)=>{
      if(item.deptPk == event.value[0]){
        this.departmentDataTemp = item.deptName;
      }
    });
    // if(event.value.length == 0){
    //   this.hideResponseLoader.emit(true);
    //   this.filterform.controls['businessUnit'].reset();
    //   this.businessunitlist = this.oninitbusinessunitlist;
    //   this.filterdDivisionval.next(this.businessunitlist.slice());   
    //   this.hideResponseLoader.emit(false);    
    // }else{
    //   // this.hideResponseLoader.emit(true);
    //   this.postParams = {
    //     'departmentPk':this.filterform.controls['Department'].value,
    //   }
    //   this.postUrl = 'ea/department/fetch-bunit-by-department';
    //   this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
    //       function(data){
    //           if(data['data'].status == 100){
    //             this.filterform.controls['businessUnit'].reset();
    //             this.businessunitlist = data['data'].divsions;
    //             this.filterdDivisionval.next(this.businessunitlist.slice()); 
    //             this.hideResponseLoader.emit(false);
    //           }
    //       }.bind(this)
    //   );
    // }    
  }

  bunitChange(event){
    this.businessUnitDataTemp = '';
    (this.businessunitlist).forEach((item,index)=>{
      if(item.bunitPk == event.value[0]){
        this.businessUnitDataTemp = item.bunitName;
      }
    });
    if(event.value.length == 0){
      this.hideResponseLoader.emit(true);
      this.showLoaderviewdept.emit(false);
      this.filterform.controls['Department'].reset();
      // this.departmentData = this.oninitdepartmentData;
      this.departmentData = [];
      this.filterddepartmentData.next(this.departmentData.slice());   
      this.hideResponseLoader.emit(false);    
      this.showLoaderviewdept.emit(false);
    }else{
      // this.hideResponseLoader.emit(true);
      this.postParams = {
        'bUnitPk':this.filterform.controls['businessUnit'].value,
        'from':2
      }
      this.postUrl = 'ea/department/fetch-department-by-bunit';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
              if(data['data'].status == 100){
                this.filterform.controls['Department'].reset();
                this.departmentData = data['data'].data.bunitDeptData;
                this.filterddepartmentData.next(this.departmentData.slice()); 
                this.hideResponseLoader.emit(false);
                this.showLoaderviewdept.emit(false);
              }
          }.bind(this)
      );
    }    
  }
  public filterddepartmentData: ReplaySubject<any> = new ReplaySubject<any>(1);
  public depatFilterval: FormControl = new FormControl();
  filterdepartmentsearch() {
    if (!this.departmentData) {
      return;
    }
    // get the search keyword
    let search = this.depatFilterval.value;
    if (!search) {
      this.filterddepartmentData.next(this.departmentData.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filterddepartmentData.next(
      this.departmentData.filter(deptData => deptData.deptName.toLowerCase().indexOf(search) > -1)
    );
    this.showLoaderviewdept.emit(false);
  }
  bunitFormReset(){
    this.bunitDeptReset.resetForm();
    this.filtercount = 0
    this.livecount = 0;
    this.departmentResetFilter.emit(true);
  }

  /*Sar Starts*/
  submitFilter(){
    
    if(this.paginatorDataArray){
      var pagesize = this.paginatorDataArray.pageSize
    }else{
      var pagesize=null;
    }
    this.postParams = {
      'keyworsSrh':this.search,
      'deptPks':this.filterform.controls['Department'].value,
      'bunitPks':this.filterform.controls['businessUnit'].value,
      'deptStatus':this.filterform.controls['Status'].value,
      'size':pagesize,
    };
    this.filtercount = this.livecount;
    this.advanceDepartmentFilter.emit(this.postParams);
    this.toggleShowDiv('descriptioncontentfilter');
    this.showLoaderviewdept.emit(true);
  }

  closeFilterForm(){
    this.toggleShowDiv('descriptioncontentfilter');
  }

   departdata(){
    if (this.search.length != null && this.search.length >= 3) {
      this.addRecentData(this.search);
      this.departmentFilter.emit(this.search);
      this.showLoaderviewdept.emit(true);
      this.submitFilter();
      this.closeFilterForm();

    }
    if (this.search.length != null && this.search.length == 0) {
      this.addRecentData(this.search);
      this.departmentFilter.emit(this.search);
      this.showLoaderviewdept.emit(true);
      this.submitFilter();
      this.closeFilterForm();

    }
    this.animationState1 = 'out';
   }


   keywordFilter(event){
    if (this.search.length >= 3 && this.search.length != null) {
      this.addRecentData(this.search);
    }
    this.animationState1 = 'out';
    this.departmentFilter.emit(this.search);
  }
  bunitFrmRst(){
    this.bunitDeptReset.resetForm();
    this.filtercount = 0
    this.livecount = 0;
  }
}