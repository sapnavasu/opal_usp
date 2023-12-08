import { ChangeDetectorRef, Component, ElementRef, EventEmitter, Input, OnInit, Output, Renderer2, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { Encrypt } from '@app/common/class/encrypt';
import { CountryList } from '@app/common/interfaces/supplier';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { ReplaySubject, Subject } from 'rxjs';
import 'rxjs/add/observable/of';
import { SlideInOutAnimation } from '../animation';
import { EnterpriseService } from '../enterprise.service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-businessunitfilter',
  templateUrl: './businessunitfilter.component.html',
  styleUrls: ['./businessunitfilter.component.scss'],
  animations: [SlideInOutAnimation]
})
export class BusinessunitfilterComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @Output('showLoaderviewdivision') showLoaderviewdivision: any = new EventEmitter<any>();
  animationState = 'out';
  animationState1='out';
  filterform: FormGroup;
  searchSector: string = '';
  searchDepartment: string = '';
  searchDivision: string = '';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @Input() recentSearchType: any;
  public recentSearch:any=[];
  @Input() filterFor: string;
  public paginatorDataArray:any;
  @Input() public set paginatorData(value: any) {
    this.paginatorDataArray = value;
  }
  public get paginatorData() {
    return this.paginatorDataArray;
  }
  @Input() filterType:number; /* 1 - UserActivty 2 - Enterprise Admin User */
  @Output() userFilterData:any = new EventEmitter<any>();
  @Output() moitorFilterData:any = new EventEmitter<any>();
  @Output() emitFilterData:any  = new EventEmitter<any>();
  @Output() hideResponseLoader: any = new EventEmitter<any>();
  @Input() sortBy:string;
  public postParams:any;
  public postUrl:any;
  public departmentData:any;
  public departmentDataTemp:any = '';
  public moduleData:any;
  public moduleDataTemp:any = '';
  public submoduleData:any;
  public submoduleDataTemp:any = '';
  public businessUnitDataTemp:any = '';
  public branchNameDataTemp:any = '';
  public filterValue:any = 0;
  public search:any = '';
  public showSearchIcon:boolean =true;
  public mainSubmodule:any = '';
  public filterCombination:any = [];
  public branchFilter: FormControl = new FormControl();
  public perpage = BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;
  @ViewChild('bunitDivReset') bunitDivReset:FormGroupDirective;
  Department = new FormControl('');
  Module = new FormControl('');
  Submodule = new FormControl('');
  filtercount: number = 0;
  statusCount: number = 0;
  businessunitlist: any;
  branchnamelist: any;
  showInvitedUser: boolean = false;
  checkedFilterArr: any = []
  filteredCountry: ReplaySubject<CountryList[]> = new ReplaySubject<CountryList[]>(1);
  private _onDestroy = new Subject<void>();

  invitedFilterCheckBoxArr = [
    {
      value: '1',
      viewValue: this.i18n('enterpriseadmin.invi')
    },
    {
      value: '2',
      viewValue: this.i18n('enterpriseadmin.acce')
    },
    {
      value: '0',
      viewValue: this.i18n('enterpriseadmin.expi')
    }
  ];

  /*Sar Starts*/
  @Output() bunitFilter:any  = new EventEmitter<any>();
  public filterSector:any;
  public oninitfilterSector:any;
  public oninitfilterDivision:any;
  public filterDivision:any;
  @ViewChild("inputClickbus") inputClickbus: ElementRef;
  constructor(
    private translate : TranslateService,
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
        if (e.target == this.inputClickbus.nativeElement) {
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
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
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
      searchKey: new FormControl(''),
      sector: new FormControl(''),
      division: new FormControl(''),
    });
    
    this.initialFilterData();
    this.getRecentSearch();
    this.sectorFilterval.valueChanges
    .subscribe(() => {
      this.filterSectorsearch();
    });
    this.divFilterval.valueChanges
    .subscribe(() => {
      this.filterdivisonsearch();
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
        this.getRecentSearch();   
      }
    });
  }
  recentDataSet(searchTxt){
    this.search=searchTxt;
  }

  checkInvitedFilter(id: any) {
    if(this.checkedFilterArr.includes(id)) { 
      let index = this.checkedFilterArr.indexOf(id);
      this.checkedFilterArr.splice(index, 1);
    } else {
      this.checkedFilterArr.push(id);
    }

    this.filtercount = (this.checkedFilterArr.length > 0) ? 1 : 0;
  }

  initialFilterDetails(postParams){
    this.postUrl = 'ea/user/enterprise-filter-initial-data?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    this.EnterpriseService.enterpriseService(postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              this.departmentData = data['data'].data.departmentDetails;
              this.moduleData = data['data'].data.module;
              this.submoduleData = data['data'].data.subModule;
            }
        }.bind(this)
    );
  }

  fetchSubModule(event){
    this.postParams = {
      'modulePk': event.value
    };
    this.postUrl = 'ea/user/filter-submodule?uac=f9d6c6ad2e0f8bfded8c4c37e4140629&';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              this.submoduleData = data['data'].data.subModule;
              this.mainSubmodule = data['data'].data.subModule;
            }
        }.bind(this)
    );
  }

  advanceFilter(clear='', pageSize = this.perpage, page=0, fromFilter='in',isFilterClick = false){
    this.postParams = {
      'deptPks': this.filterform.controls['Department'].value,
      'modulePks': this.filterform.controls['Module'].value,
      'subModulePks':this.filterform.controls['Submodule'].value,
      'businessUnit':this.filterform.controls['businessUnit'].value,
      'branchName':this.filterform.controls['branchName'].value,
      'status':this.filterform.controls['Status'].value,
      'keyWord':this.search,
      'filterType':this.filterType,
      'inviteToggle': this.showInvitedUser,
      'invited': this.checkedFilterArr,
      'sortby':this.sortBy,
      'size':pageSize,
      'page':page
    };
    this.emitFilterData.emit(this.postParams);
    this.postUrl = 'ea/user/enterprise-filter?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              data['data']['resetPagination'] = false;
              if(this.filterType == 2){
                if(isFilterClick){
                  data['data']['resetPagination'] = true;
                }
                this.userFilterData.emit(data['data']);
              }
              if(this.filterType == 1){
                this.moitorFilterData.emit(data['data']);
              }
              if(clear == ''){
                this.animationState = 'out';
              }
              if(fromFilter == 'in'){
                if(this.filterType == 2){
                  this.filterValue = data['data'].totalcount;
                }
                if(this.filterType == 1){
                  let fromData = data['data'].data;
                  this.filterValue = fromData.length;
                }
              }else{
                this.filterValue = 0;
              }
            }
        }.bind(this)
    );
  }

  formreset(){
    this.filterform.reset();
    this.statusCount=0;
    this.filtercount = 0;
    this.checkedFilterArr = [];
    this.advanceFilter('yes',this.perpage,0,'out');
    this.filterCombination.length = 0;
  }

  searchByKeyword(){
    
  }

  getBranchNameList(){
    this.EnterpriseService.getbranchNameList().subscribe(data => {
      this.branchnamelist = data['data'].items;
      this.filteredCountry.next(this.branchnamelist.slice());
    })
  }

  getBusinessList(){
    this.EnterpriseService.getBusinessList().subscribe(data => {
      this.businessunitlist = data['data'].items;
    })
  }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentfilter') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
    else if (divName === 'searchhistorydropdown') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
  closethefilterdiv()
  {
    this.bunitDivReset.reset();
  }
  monitorLogFilter(sortByData){
    this.sortBy = sortByData;
    this.advanceFilter('', 8, 0, 'out');
  }
  
  filterModuleCountSelected(event){
    if(event.isUserInput){
      if(!event.source.selected){
        
          let unselectedMod = event.source.value;
           let formval = this.filterform.controls['Submodule'].value;
           
          let tempCombinData = this.filterCombination;
          
          for(var i=tempCombinData.length-1; i >= 0; --i){
            if(tempCombinData[i].modPk == unselectedMod){
              let ind:number = formval.indexOf(tempCombinData[i].subPk);
              if(ind !== -1){
                this.filterform.controls['Submodule'].value.splice(ind,1);
              }
               this.filterCombination.splice(i,1);
             }
          }
          if(this.filterCombination.length > 0){
            this.submoduleDataTemp = this.filterCombination[0].subName;
          }else{
            this.submoduleDataTemp = '';
          }
        }else{
        
      }
    }
  }

  filterCountry() {
    if (!this.branchnamelist) {
      return;
    }
    // get the search keyword
    let search = this.branchFilter.value;
    if (!search) {
      this.filteredCountry.next(this.branchnamelist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredCountry.next(
      this.branchnamelist.filter(branch => branch.toLowerCase().indexOf(search) > -1)
    );
  }

  onSelectSubMod(event,subName,modPk){
    if(event.isUserInput){
      let subPk = event.source.value;
      if(event.source.selected){
        this.filterCombination.push({"modPk":modPk,"subPk":subPk,"subName":subName});
      }else if(!event.source.selected){
        (this.filterCombination).forEach((com,index)=>{
          if(com.subPk == subPk){
            this.filterCombination.splice(index,1);
          }
        });
      }
    }
  }
  filterRadioSelected(event){
    // if(event.source.checked && this.statusCount == 0){
    //   this.statusCount = 1;
    //   this.filtercount = this.filtercount + this.statusCount;
    // }
  }
  subModChange(event,type){
    if(type == 1){
      this.departmentDataTemp = '';
      (this.departmentData).forEach((item,index)=>{
        if(item.deptPk == event.value[0]){
          this.departmentDataTemp = item.deptName;
        }
      });
    }else if(type == 2){
      this.moduleDataTemp = '';
      this.filterform.controls['Submodule'].value;
      (this.moduleData).forEach((item,index)=>{
        if(item.modulePk == event.value[0]){
          this.moduleDataTemp = item.moduleName;
        }
      });
      
    }else if(type == 3){
      this.submoduleDataTemp = '';
      (this.submoduleData).forEach((item,index)=>{
        (item.subModule).forEach((subItem,subi)=>{
          if(subItem.subModulePk == event.value[0]){
            this.submoduleDataTemp = subItem.subModuleName;
          }
        });
        
      });
    }
  }
  public filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  public filterdDivisionval: ReplaySubject<any> = new ReplaySubject<any>(1);
  /*Sar Starts*/
  initialFilterData(){
    this.postUrl = 'ea/businessunit/bunit-filter-initial-data?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    this.postParams = {};
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              this.oninitfilterSector = data['data'].data.sectorData;
              this.filterSector = data['data'].data.sectorData;
              this.filteredSector.next(this.filterSector.slice());
              this.oninitfilterDivision = data['data'].data.bunitData;      
              // this.filterDivision = data['data'].data.bunitData;      
              // this.filterdDivisionval.next(this.filterDivision.slice());        
            }
        }.bind(this)
    );
  }  
  public sectorFilterval: FormControl = new FormControl();
  public divFilterval: FormControl = new FormControl();
  filterdivisonsearch() {
    if (!this.filterDivision) {
      return;
    }
    // get the search keyword
    let search = this.divFilterval.value;
    if (!search) {
      this.filterdDivisionval.next(this.filterDivision.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filterdDivisionval.next(
      this.filterDivision.filter(filterDiv => filterDiv.bunitName.toLowerCase().indexOf(search) > -1)
    );
  }
  filterSectorsearch() {
    if (!this.filterSector) {
      return;
    }
    // get the search keyword
    let search = this.sectorFilterval.value;
    if (!search) {
      this.filteredSector.next(this.filterSector.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredSector.next(
      this.filterSector.filter(filterSec => filterSec.sectorName.toLowerCase().indexOf(search) > -1)
    );
  }


  
  submitFilter(data){

    if(this.filterform.controls['sector'].value && this.filterform.controls['division'].value){
      this.filtercount=2
    }else if(this.filterform.controls['sector'].value){
      this.filtercount=1
    }else if(this.filterform.controls['division'].value){
      this.filtercount=1
    }else{
      this.filtercount=0
    }
  
    if(this.paginatorDataArray){
      var pagesize = this.paginatorDataArray.pageSize
    }else{
      var pagesize=null;
    }
    this.postParams = {
      'searchKey':this.search,
      'sector':this.filterform.controls['sector'].value,
      'division':this.filterform.controls['division'].value,
      'size':pagesize,
    };
    this.bunitFilter.emit(this.postParams);
    if(data==true){
    this.toggleShowDiv('descriptioncontentfilter');
    }
    this.animationState1 = 'out';
    this.showLoaderviewdivision.emit(true);
  }

  businessunitfilter(data){
    if (this.search.length != null && this.search.length >= 3) {
      this.addRecentData(this.search);
      this.showLoaderviewdivision.emit(true);
      this.submitFilter(data);
    }
    if (this.search.length != null && this.search.length == 0) {
      this.addRecentData(this.search);
      this.showLoaderviewdivision.emit(true);
      this.submitFilter(data);
    }
  }
  closeFilterForm(){
    this.toggleShowDiv('descriptioncontentfilter');
  }

  keywordFilter(event){
    this.postParams = {
      'keyworsSrh':this.search,
    };
    if((event == '1' && this.search) || event == 2){
      this.bunitFilter.emit(this.postParams);
    } 
  }

  checkEnableDisable(){
    if(this.filterform.controls['sector'].value || this.filterform.controls['division'].value){
      return false;
    }else{
      return true;
    }
  }

  clearAdvanceForm(){
    this.initialFilterData();
    this.filterform.controls['sector'].setValue('');    
    this.filterform.controls['division'].setValue('');    
    this.submitFilter(true);
    this.filtercount=0
  }
  clearFilterForm(){
    this.filterform.controls['sector'].setValue('');    
    this.filterform.controls['division'].setValue('');    
    this.filtercount=0
  }
  changesector(event){
    if(event.value.length == 0){
      this.hideResponseLoader.emit(true);
      this.filterform.controls['division'].reset();
      // this.filterDivision = this.oninitfilterDivision;
      this.filterDivision = [];
      this.filterdDivisionval.next(this.filterDivision.slice());   
      this.hideResponseLoader.emit(false);    
      this.showLoaderviewdivision.emit(false);
    }else{
      // this.hideResponseLoader.emit(true);
      this.postParams = {
        'sectorPk':event.value,
      }
      this.postUrl = 'ea/businessunit/fetch-divison-by-sector?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
              if(data['data'].status == 100){
                this.filterform.controls['division'].reset();
                this.filterDivision = data['data'].divsions;
                this.filterdDivisionval.next(this.filterDivision.slice());   
                this.hideResponseLoader.emit(false);
                this.showLoaderviewdivision.emit(false);
              }
          }.bind(this)
      );
    }
  }
  changedivison(event){
    if(event.value.length == 0){
      this.hideResponseLoader.emit(true);
      this.filterform.controls['sector'].reset();
      this.filterSector = this.oninitfilterSector;
      this.filteredSector.next(this.filterSector.slice());   
      this.hideResponseLoader.emit(false);    
      this.showLoaderviewdivision.emit(false);
    }else{
      // this.hideResponseLoader.emit(true);
      this.postParams = {
        'divisionid':event.value,
      }
      this.postUrl = 'ea/businessunit/fetch-sector-by-division?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
              if(data['data'].status == 100){
                this.filterform.controls['sector'].reset();
                this.filterSector = data['data'].sectorData;
                this.filteredSector.next(this.filterSector.slice());
                this.hideResponseLoader.emit(false);
                this.showLoaderviewdivision.emit(false);
              }
          }.bind(this)
      );
    }
  }
}
