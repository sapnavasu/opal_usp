import { Component, OnInit, Input, ViewChild, ViewEncapsulation, OnChanges, AfterViewInit, Inject, EventEmitter, Output, ChangeDetectorRef } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { SlideInOutAnimation } from '../animation';
import { EnterpriseService } from '../enterprise.service';
import 'rxjs/add/observable/of';
import { Encrypt } from '@app/common/class/encrypt';
import { atLeastOne } from '@app/common/directives/atleastone';
import { ReplaySubject, Subject } from 'rxjs';
import { CountryList } from '@app/common/interfaces/supplier';
import { takeUntil } from 'rxjs/operators/takeUntil';
import {BgiJsonconfigServices} from '@app/config/BGIConfig/bgi-jsonconfig-services';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-inviteuserfilter',
  templateUrl: './inviteuserfilter.component.html',
  styleUrls: ['./inviteuserfilter.component.scss'],
  animations: [SlideInOutAnimation]
})

export class InviteuserfilterComponent implements OnInit {

  animationState = 'out';
  animationState1 = 'out';
  filterform: FormGroup;
  @Input() filterFor: string;
  @Input() filterType:number; /* 1 - UserActivty 2 - Enterprise Admin User */
  @Output() userFilterData:any = new EventEmitter<any>();
  @Output() moitorFilterData:any = new EventEmitter<any>();
  @Output() emitFilterData:any  = new EventEmitter<any>();
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
      viewValue: 'Invitation Sent'
    },
    {
      value: '2',
      viewValue: 'Invitation Accepted'
    },
    {
      value: '0',
      viewValue: 'Invitation Expired'
    }
  ]

  constructor(
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private cdr: ChangeDetectorRef,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
  ) {
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
      Department: new FormControl([]),
      Designation: new FormControl([]),
      Module: new FormControl([]),
      Submodule: new FormControl([]),
      businessUnit: new FormControl([]),
      branchName: new FormControl([]),
      showInvitedUser: new FormControl(false),
      Status: new FormControl(''),
      Invited: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });
    
    this.postParams = {};
    this.initialFilterDetails(this.postParams);
    this.getBusinessList();
    this.getBranchNameList();

    this.filterform.controls['showInvitedUser'].valueChanges.subscribe(data => {
      this.filterform.controls['Invited'].reset();
    })

    this.filterform.valueChanges.subscribe(data => {
      let count = 0;
      for(let i in data){
        let type = typeof(data[i]);
        if((type == "string" && data[i]) || (type == "boolean" && data[i]) || (data[i] !== null && type == "object" && data[i].length > 0)){
          count++;
        }
      }
      this.filtercount = count;
    })

    this.filterform.controls['businessUnit'].valueChanges.subscribe(value => {
      if(value){
        let index = this.businessunitlist.findIndex(x => x.SectorMst_Pk == value[0]);
        if(index !== -1){
          this.businessUnitDataTemp = this.businessunitlist[index].SecM_SectorName;
        }
      }else{
        this.businessUnitDataTemp = '';
      }
    });

    this.filterform.controls['branchName'].valueChanges.subscribe(value => {
      if(value){
        let index = this.branchnamelist.findIndex(x => x == value[0]);
        if(index !== -1){
          this.branchNameDataTemp = this.branchnamelist[index];
        }
      }else{
        this.branchNameDataTemp = '';
      }
    })

    this.branchFilter.valueChanges
      .pipe(takeUntil(this._onDestroy))
      .subscribe(() => {
        this.filterCountry();
      });

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
    if (divName === 'searchhistorydropdown') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
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

}
